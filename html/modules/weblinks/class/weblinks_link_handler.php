<?php
// $Id: weblinks_link_handler.php,v 1.2 2011/12/29 19:54:56 ohwada Exp $

// 2010-03-31 K.OHWADA
// get_objects_broken()

// 2008-02-17 K.OHWADA
// pagerank, pagerank_update in link, modify

// 2007-11-01 K.OHWADA
// divid to weblinks_link_def_handler
// move get_count_non_url() to weblinks_link_basic_handler
// remove happy_linux_search

// 2007-09-01 K.OHWADA
// get_objects_usercomment_desc()

// 2007-08-01 K.OHWADA
// admin can add etc column

// 2007-05-06 K.OHWADA
// BUG 4565: cannot show user manage, when too many links or users
// BUG: dont work limit 

// 2007-04-08 K.OHWADA
// gm_type

// 2007-03-25 K.OHWADA
// album_id

// 2007-03-01 K.OHWADA
// divid to weblinks_link_basic_handler
// hack for multi site
// add forum_id comment_use field
// add clean_rss_xml()

// 2006-12-17 K.OHWADA
// add time_publish textarea1
// add add_column_table_130()
// add build_sql_where_exclude()

// 2006-12-17 K.OHWADA
// BUG 4417: language singleton done not work correctly

// 2006-10-14 K.OHWADA
// add get_objects_by_where()

// 2006-10-05 K.OHWADA
// use happy_linux
// use rssc
// divided weblinks_link to weblinks_link_handler
// add get_objects_latest() isset_rss_flag()
// reomove rss_update()
// google map

// 2006-07-15 K.OHWADA
// BUG 4130: cannot show recommend mark

// 2006-06-10 K.OHWADA
// BUG 4030: cannot change recommend, mutual
//   add set_checkbox()

// 2006-05-15 K.OHWADA
// new handler
// not use weblinks_module_base
// NOT use other handler

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication

//=========================================================
// WebLinks Module
// 2004/01/14 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('weblinks_link_handler') ) 
{

//=========================================================
// class weblinks_link_handler
// NOT use other handler
//=========================================================
class weblinks_link_handler extends happy_linux_object_handler
{
	var $_link_basic_handler;

	var $_lid_array_with_email;

// config
	var $_conf_use_ratelink  = 0;	// not use
	var $_conf_broken        = WEBLINKS_LINK_BROKEN_DEFAULT;
	var $_conf_link_num_etc  = WEBLINKS_LINK_NUM_ETC;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_link_handler( $dirname )
{
	$this->happy_linux_object_handler( $dirname, 'link', 'lid', 'weblinks_link' );

	$this->set_debug_db_sql(     WEBLINKS_DEBUG_LINK_SQL );
	$this->set_debug_db_error(   WEBLINKS_DEBUG_ERROR );
	$this->set_debug_print_time( WEBLINKS_DEBUG_TIME );
	$this->set_debug_db_max_sql( WEBLINKS_DEBUG_MAX_SQL );

// hack for multi site
	if ( WEBLINKS_FLAG_MULTI_SITE )
	{
		$this->renew_prefix( WEBLINKS_DB_PREFIX );
	}

	$config_handler            =& weblinks_get_handler( 'config2_basic', $dirname );
	$this->_link_basic_handler =& weblinks_get_handler( 'link_basic',    $dirname );

	$conf =& $config_handler->get_conf();
	if ( is_array($conf) && (count($conf) > 0) )
	{
		$this->_conf_use_ratelink = $conf['use_ratelink'];
		$this->_conf_broken       = $conf['broken_threshold'];
		if ( WEBLINKS_USE_LINK_NUM_ETC )
		{
			$this->_conf_link_num_etc = $conf['link_num_etc'];
		}
	}
}

//---------------------------------------------------------
// insert
// $flag_lid : for import from mylinks
//---------------------------------------------------------
function _build_insert_sql(&$obj, $flag_lid=false)
{
	foreach ($obj->gets() as $k => $v) 
	{	${$k} = $v;	}

	$sql_lid_name  = '';
	$sql_lid_value = '';
	$sql_etc_name  = '';
	$sql_etc_value = '';

	if ( $flag_lid )
	{
		$sql_lid_name  = 'lid, ';
		$sql_lid_value = intval($lid).', ';
	}

// etc1 .. etci
	if ( $this->_conf_link_num_etc > 0 )
	{
		for ($i = 1; $i <= $this->_conf_link_num_etc; $i++)
		{
			$etc_name = 'etc'. $i;
			$etc_val  = $obj->get($etc_name);
			$sql_etc_name  .= $etc_name. ', ';
			$sql_etc_value .= $this->quote($etc_val).', ';
		}
	}

	$sql  = 'INSERT INTO '.$this->_table.' (';

	$sql .= $sql_lid_name;

	$sql .= 'uid, ';
	$sql .= 'cids, ';
	$sql .= 'title, ';
	$sql .= 'url, ';
	$sql .= 'banner, ';
	$sql .= 'description, ';
	$sql .= 'name, ';
	$sql .= 'nameflag, ';
	$sql .= 'mail, ';
	$sql .= 'mailflag, ';
	$sql .= 'company, ';
	$sql .= 'addr, ';
	$sql .= 'tel, ';
	$sql .= 'search, ';
	$sql .= 'passwd, ';
	$sql .= 'admincomment, ';
	$sql .= 'mark, ';
	$sql .= 'time_create, ';
	$sql .= 'time_update, ';
	$sql .= 'hits, ';
	$sql .= 'rating, ';
	$sql .= 'votes, ';
	$sql .= 'comments, ';
	$sql .= 'width, ';
	$sql .= 'height, ';
	$sql .= 'recommend, ';
	$sql .= 'mutual, ';
	$sql .= 'broken, ';
	$sql .= 'rss_url, ';
	$sql .= 'rss_flag, ';
	$sql .= 'rss_xml, ';
	$sql .= 'rss_update, ';
	$sql .= 'usercomment, ';
	$sql .= 'zip, ';
	$sql .= 'state, ';
	$sql .= 'city, ';
	$sql .= 'addr2, ';
	$sql .= 'fax, ';

// html
	$sql .= 'dohtml, ';
	$sql .= 'dosmiley, ';
	$sql .= 'doxcode, ';
	$sql .= 'doimage, ';
	$sql .= 'dobr, ';
	$sql .= 'map_use, ';

// rssc
	$sql .= 'rssc_lid, ';

// google map
	$sql .= 'gm_latitude, ';
	$sql .= 'gm_longitude, ';
	$sql .= 'gm_zoom, ';
	$sql .= 'gm_type, ';

// publish
	$sql .= 'time_publish, ';
	$sql .= 'time_expire, ';
	$sql .= 'textarea1, ';
	$sql .= 'textarea2, ';
	$sql .= 'dohtml1, ';
	$sql .= 'dosmiley1, ';
	$sql .= 'doxcode1, ';
	$sql .= 'doimage1, ';
	$sql .= 'dobr1, ';

// forum
	$sql .= 'forum_id, ';
	$sql .= 'comment_use, ';

//etc
	$sql .= $sql_etc_name;

	$sql .= 'album_id, ';

// pagerank
	$sql .= 'pagerank, ';
	$sql .= 'pagerank_update, ';

// aux
	$sql .= 'aux_int_1, ';
	$sql .= 'aux_int_2, ';
	$sql .= 'aux_text_1, ';
	$sql .= 'aux_text_2 ';

	$sql .= ') VALUES (';

	$sql .= $sql_lid_value;

	$sql .= intval($uid).', ';
	$sql .= $this->quote($cids).', ';
	$sql .= $this->quote($title).', ';
	$sql .= $this->quote($url).', ';
	$sql .= $this->quote($banner).', ';
	$sql .= $this->quote($description).', ';
	$sql .= $this->quote($name).', ';
	$sql .= intval($nameflag).', ';
	$sql .= $this->quote($mail).', ';
	$sql .= intval($mailflag).', ';
	$sql .= $this->quote($company).', ';
	$sql .= $this->quote($addr).', ';
	$sql .= $this->quote($tel).', ';
	$sql .= $this->quote($search).', ';
	$sql .= $this->quote($passwd).', ';
	$sql .= $this->quote($admincomment).', ';
	$sql .= $this->quote($mark).', ';
	$sql .= intval($time_create).', ';
	$sql .= intval($time_update).', ';
	$sql .= intval($hits).', ';
	$sql .= floatval($rating).', ';
	$sql .= intval($votes).', ';
	$sql .= intval($comments).', ';
	$sql .= intval($width).', ';
	$sql .= intval($height).', ';
	$sql .= intval($recommend).', ';
	$sql .= intval($mutual).', ';
	$sql .= intval($broken).', ';
	$sql .= $this->quote($rss_url).', ';
	$sql .= intval($rss_flag).', ';
	$sql .= intval($rss_xml).', ';
	$sql .= intval($rss_update).', ';
	$sql .= $this->quote($usercomment).', ';
	$sql .= $this->quote($zip).', ';
	$sql .= $this->quote($state).', ';
	$sql .= $this->quote($city).',';
	$sql .= $this->quote($addr2).', ';
	$sql .= $this->quote($fax).', ';

// html
	$sql .= intval($dohtml).', ';
	$sql .= intval($dosmiley).', ';
	$sql .= intval($doxcode).', ';
	$sql .= intval($doimage).', ';
	$sql .= intval($dobr).', ';
	$sql .= intval($map_use).', ';

// rssc
	$sql .= intval($rssc_lid).', ';

// google map
	$sql .= floatval($gm_latitude).', ';
	$sql .= floatval($gm_longitude).', ';
	$sql .= intval($gm_zoom).', ';
	$sql .= intval($gm_type).', ';

// publish
	$sql .= intval($time_publish).', ';
	$sql .= intval($time_expire).', ';
	$sql .= $this->quote($textarea1).', ';
	$sql .= $this->quote($textarea2).', ';
	$sql .= intval($dohtml1).', ';
	$sql .= intval($dosmiley1).', ';
	$sql .= intval($doxcode1).', ';
	$sql .= intval($doimage1).', ';
	$sql .= intval($dobr1).', ';

// forum
	$sql .= intval($forum_id).', ';
	$sql .= intval($comment_use).', ';

// etc
	$sql .= $sql_etc_value;

	$sql .= intval($album_id).', ';

// pagerank
	$sql .= intval($pagerank).', ';
	$sql .= intval($pagerank_update).', ';

// aux
	$sql .= intval($aux_int_1).', ';
	$sql .= intval($aux_int_2).', ';
	$sql .= $this->quote($aux_text_1).', ';
	$sql .= $this->quote($aux_text_2).' ';

	$sql .= ')';

	return $sql;
}

//---------------------------------------------------------
// update
//---------------------------------------------------------
function _build_update_sql(&$obj)
{
	foreach ($obj->gets() as $k => $v) 
	{	${$k} = $v;	}

	$sql_etc_set = '';

// etc1 .. etci
	if ( $this->_conf_link_num_etc > 0 )
	{
		for ($i = 1; $i <= $this->_conf_link_num_etc; $i++)
		{
			$etc_name = 'etc'. $i;
			$etc_val  = $obj->get($etc_name);
			$sql_etc_set .= $etc_name.'='.$this->quote($etc_val).', ';
		}
	}

	$sql = 'UPDATE '.$this->_table.' SET ';

	$sql .= 'uid='.intval($uid).', ';
	$sql .= 'cids='.$this->quote($cids).', ';
	$sql .= 'title='.$this->quote($title).', ';
	$sql .= 'url='.$this->quote($url).', ';
	$sql .= 'banner='.$this->quote($banner).', ';
	$sql .= 'description='.$this->quote($description).', ';
	$sql .= 'name='.$this->quote($name).', ';
	$sql .= 'nameflag='.intval($nameflag).', ';
	$sql .= 'mail='.$this->quote($mail).', ';
	$sql .= 'mailflag='.intval($mailflag).', ';
	$sql .= 'company='.$this->quote($company).', ';
	$sql .= 'addr='.$this->quote($addr).', ';
	$sql .= 'tel='.$this->quote($tel).', ';
	$sql .= 'search='.$this->quote($search).', ';
	$sql .= 'passwd='.$this->quote($passwd).', ';
	$sql .= 'admincomment='.$this->quote($admincomment).', ';
	$sql .= 'mark='.$this->quote($mark).', ';
	$sql .= 'time_create='.intval($time_create).', ';
	$sql .= 'time_update='.intval($time_update).', ';
	$sql .= 'hits='.intval($hits).', ';
	$sql .= 'rating='.floatval($rating).', ';
	$sql .= 'votes='.intval($votes).', ';
	$sql .= 'comments='.intval($comments).', ';
	$sql .= 'width='.intval($width).', ';
	$sql .= 'height='.intval($height).', ';
	$sql .= 'recommend='.intval($recommend).', ';
	$sql .= 'mutual='.intval($mutual).', ';
	$sql .= 'broken='.intval($broken).', ';
	$sql .= 'rss_url='.$this->quote($rss_url).', ';
	$sql .= 'rss_flag='.intval($rss_flag).', ';
	$sql .= 'rss_update='.intval($rss_update).', ';
	$sql .= 'rss_xml='.$this->quote($rss_xml).', ';
	$sql .= 'usercomment='.$this->quote($usercomment).', ';
	$sql .= 'zip='.$this->quote($zip).', ';
	$sql .= 'state='.$this->quote($state).', ';
	$sql .= 'city='.$this->quote($city).', ';
	$sql .= 'addr2='.$this->quote($addr2).', ';
	$sql .= 'fax='.$this->quote($fax).', ';

// html
	$sql .= 'dohtml='.intval($dohtml).', ';
	$sql .= 'dosmiley='.intval($dosmiley).', ';
	$sql .= 'doxcode='.intval($doxcode).', ';
	$sql .= 'doimage='.intval($doimage).', ';
	$sql .= 'dobr='.intval($dobr).', ';
	$sql .= 'map_use='.intval($map_use).', ';

// rssc
	$sql .= 'rssc_lid='.intval($rssc_lid).', ';

// google map
	$sql .= 'gm_latitude='.floatval($gm_latitude).', ';
	$sql .= 'gm_longitude='.floatval($gm_longitude).', ';
	$sql .= 'gm_zoom='.intval($gm_zoom).', ';
	$sql .= 'gm_type='.intval($gm_type).', ';

// publish
	$sql .= 'time_publish='.intval($time_publish).', ';
	$sql .= 'time_expire='.intval($time_expire).', ';
	$sql .= 'textarea1='.$this->quote($textarea1).', ';
	$sql .= 'textarea2='.$this->quote($textarea2).', ';
	$sql .= 'dohtml1='.intval($dohtml1).', ';
	$sql .= 'dosmiley1='.intval($dosmiley1).', ';
	$sql .= 'doxcode1='.intval($doxcode1).', ';
	$sql .= 'doimage1='.intval($doimage1).', ';
	$sql .= 'dobr1='.intval($dobr1).', ';

// forum
	$sql .= 'forum_id='.intval($forum_id).', ';
	$sql .= 'comment_use='.intval($comment_use).', ';

// etc
	$sql .= $sql_etc_set;

	$sql .= 'album_id='.intval($album_id).', ';

// pagerank
	$sql .= 'pagerank='.intval($pagerank).', ';
	$sql .= 'pagerank_update='.intval($pagerank_update).', ';

// aux
	$sql .= 'aux_int_1='.intval($aux_int_1).', ';
	$sql .= 'aux_int_2='.intval($aux_int_2).', ';
	$sql .= 'aux_text_1='.$this->quote($aux_text_1).', ';
	$sql .= 'aux_text_2='.$this->quote($aux_text_2).' ';

	$sql .= ' WHERE lid='.intval($lid);

	return $sql;
}

//---------------------------------------------------------
// update
//---------------------------------------------------------
// for link_check.php
function countup_broken($lid)
{
	$sql = 'UPDATE '.$this->_table.' SET broken = broken+1 WHERE lid='.intval($lid);
	$ret = $this->queryF($sql);
	return $ret;
}

// for admin/link_check.php
function clean_rss_xml()
{
	$sql = "UPDATE ".$this->_table." SET rss_xml = '' ";
	$ret = $this->query($sql);
	return $ret;
}

// for ratelink.php, admin/votedate.php
function update_rating($lid, $rating, $votes)
{
	if ( !$this->_conf_use_ratelink )
	{
		return true;	// no action
	}

	$lid = intval($lid);

	$obj =& $this->get($lid);
	if ( !is_object($obj) )
	{
		return true;	// no action
	}

	$obj->setVar('rating', $rating);
	$obj->setVar('votes',  $votes);
	$ret = $this->update($obj);
	return $ret;
}

function update_rssc_lid( $lid, $rssc_lid )
{
	$obj =& $this->get( $lid );
	if ( !is_object($obj) )
	{
		return true;	// no action
	}

	$obj->setVar('rssc_lid', $rssc_lid);
	$ret = $this->update($obj);
	return $ret;
}

//---------------------------------------------------------
// delete
//---------------------------------------------------------
function delete_by_lid($lid)
{
	$obj = $this->get($lid);
	if ( is_object($obj) )
	{
		$ret = $this->delete($obj);
		return $ret;
	}

	return true;	// no action
}

//---------------------------------------------------------
// get count for admin link list
//---------------------------------------------------------
function get_count_time_publish_before()
{
	$time  = time();
	$where = '( time_publish <> 0 AND time_publish > '. $time .' ) ';
	$count = $this->get_count_by_where($where);
	return $count;
}

function get_count_time_expire_after()
{
	$time  = time();
	$where = '( time_expire <> 0 AND time_expire < '. $time .' ) ';
	$count = $this->get_count_by_where($where);
	return $count;
}

function get_count_usercomment()
{
	$where = "(usercomment <> '')";
	$count = $this->get_count_by_where($where);
	return $count;
}

//---------------------------------------------------------
// get count for other
//---------------------------------------------------------
// for admin user manage
function get_count_by_uid($uid)
{
	$uid = intval($uid);
	$criteria = new CriteriaCompo();
	$criteria->add( new criteria('uid', $uid, '=') );
	$count = $this->getCount($criteria);
	return $count;
}

// for admin user manage
function get_count_with_email()
{
	$sql  = "SELECT COUNT(DISTINCT mail) FROM ".$this->_table." ";
	$sql .= "WHERE mail <> '' ";
	$count = $this->get_count_by_sql($sql);
	return $count;
}

// --- previous version 1.10 ---
// for admin export to rssc
function get_count_rss_flag_prev_ver()
{
	$sql  = "SELECT COUNT(*) FROM ".$this->_table." ";
	$sql .= "WHERE ( rss_url != '' AND rss_flag != 0 AND broken < ". $this->_conf_broken ." ) ";
	$count = $this->get_count_by_sql($sql);
	return $count;
}

//---------------------------------------------------------
// get object for admin link list
//---------------------------------------------------------
function &get_objects_all($limit=0, $start=0)
{
	$criteria = new CriteriaCompo();
	$criteria->setStart($start);
	$criteria->setLimit($limit);
	$objs =& $this->getObjects($criteria);
	return $objs;
}

function &get_objects_desc($limit=0, $start=0)
{
	$criteria = new CriteriaCompo();
	$criteria->setSort( 'lid DESC' );
	$criteria->setStart($start);
	$criteria->setLimit($limit);
	$objs =& $this->getObjects($criteria);
	return $objs;
}

function &get_objects_non_url($limit=0, $start=0)
{
// XOOPS 2.2.3 dont accept value = ''
// BUG: dont work limit 
	$where = "url = ''";
	$objs =& $this->get_objects_orderby_lid_by_where($where, $limit, $start);
	return $objs;
}

function &get_objects_broken($limit=0, $start=0)
{
// broken DESC
	$criteria = new CriteriaCompo();
	$criteria->add( new criteria('broken', '0', '>') );
	$criteria->setSort( 'broken DESC' );
	$criteria->setStart($start);
	$criteria->setLimit($limit);
	$objs =& $this->getObjects($criteria);
	return $objs;
}

function &get_objects_broken_lid($limit=0, $start=0)
{
// BUG: dont work limit 
	$where = 'broken > 0';
	$objs =& $this->get_objects_orderby_lid_by_where($where, $limit, $start);
	return $objs;
}

function  &get_objects_rss_flag($limit=0, $start=0)
{
	$criteria = new CriteriaCompo();
	$criteria->add( new criteria('rssc_lid', 0, '<>') );
	$criteria->setStart($start);
	$criteria->setLimit($limit);
	$objs =& $this->getObjects($criteria);
	return $objs;
}

function  &get_objects_rssc_lid($lid, $rssc_lid, $limit=0, $start=0)
{
	if ( $rssc_lid == 0 )
	{
		$false = false;
		return $false;
	}

	$criteria = new CriteriaCompo();
	$criteria->add( new criteria('lid',      $lid,      '<>') );
	$criteria->add( new criteria('rssc_lid', $rssc_lid, '=') );
	$criteria->setStart($start);
	$criteria->setLimit($limit);
	$objs =& $this->getObjects($criteria);
	return $objs;
}

function &get_objects_time_publish_before($limit=0, $start=0)
{
// BUG: dont work limit
	$time  = time();
	$where = '( time_publish <> 0 AND time_publish > '. $time .' ) ';
	$objs =& $this->get_objects_orderby_lid_by_where($where, $limit, $start);
	return $objs;
}

function &get_objects_time_expire_after($limit=0, $start=0)
{
// BUG: dont work limit
	$time  = time();
	$where = '( time_expire <> 0 AND time_expire < '. $time .' ) ';
	$objs =& $this->get_objects_orderby_lid_by_where($where, $limit, $start);
	return $objs;
}

function &get_objects_usercomment_desc($limit=0, $start=0)
{
	$criteria = new CriteriaCompo();
	$criteria->add( new criteria('usercomment', '', '<>') );
	$criteria->setSort( 'lid DESC' );
	$criteria->setStart($start);
	$criteria->setLimit($limit);
	$objs =& $this->getObjects($criteria);
	return $objs;
}

function &get_objects_orderby_lid_by_where($where, $limit=0, $start=0)
{
	$sql  = 'SELECT * FROM '. $this->_table .' WHERE '. $where .' ORDER BY lid';
	$objs =& $this->get_objects_by_sql($sql, $limit, $start);
	return $objs;
}

//---------------------------------------------------------
// get objects for other
//---------------------------------------------------------
// for admin user manage
function &get_objects_by_uid($uid, $limit=0, $start=0)
{
	$uid = intval($uid);
	$criteria = new CriteriaCompo();
	$criteria->add( new criteria('uid', $uid, '=') );
	$criteria->setStart($start);
	$criteria->setLimit($limit);
	$objs =& $this->getObjects($criteria);
	return $objs;
}

// for admin user manage
function &get_objects_with_email($limit=0, $start=0)
{
	$sql  = "SELECT * FROM ".$this->_table." ";
	$sql .= "WHERE mail <> '' ";
	$sql .= "GROUP BY mail ";
	$sql .= "ORDER BY lid";
	$objs =& $this->get_objects_by_sql($sql, $limit, $start);
	return $objs;
}

// --- previous version 1.10 ---
// for admin export to rssc
function &get_objects_rss_flag_prev_ver($limit=0, $start=0)
{
	$sql  = "SELECT * FROM ".$this->_table." ";
	$sql .= "WHERE ( rss_url != '' AND rss_flag != 0 AND broken < ". $this->_conf_broken ." ) ";
	$sql .= "ORDER BY lid";
	$objs =& $this->get_objects_by_sql($sql, $limit, $start);
	return $objs;
}

//---------------------------------------------------------
// get lid list
//---------------------------------------------------------
// for randum jump
function &get_lid_array_by_random($limit=0, $start=0)
{
// XOOPS 2.2.3 dont accept value = ''
	$sql  = "SELECT lid FROM ". $this->_table ." WHERE ";
	$sql .= $this->build_sql_where_exclude();
	$sql .= "AND url <> '' ";
	$sql .= "ORDER BY rand()";
	$arr  =& $this->get_first_rows_by_sql($sql, $limit, $start);
	return $arr;
}

// for link_check
function &get_lid_array($limit=0, $start=0)
{
	$limit = intval($limit);
	$start = intval($start);
	$criteria = new CriteriaCompo();
	$criteria->setStart($start);
	$criteria->setLimit($limit);
	$arr =& $this->getList($criteria);
	return $arr;
}

//---------------------------------------------------------
// this function dont work well, when too much links
//---------------------------------------------------------
// for admin user manage
function &get_lid_array_with_email($limit=0, $start=0)
{
	$user_list            = array();
	$lid_array_with_email = array();
	$email_store          = array();

	$objs =& $this->get_objects_all($limit, $start);
	foreach ($objs as $obj)
	{
		$lid = $obj->get('lid');
		$user_list[$lid] = $obj->user_mail('n');
	}

	foreach ($user_list as $lid => $email)
	{
// check duplication
		if ( empty($email) )  continue;

		if ( in_array($email, $email_store) )
		{
//			echo "omit $lid $email <br />\n";
			continue;
		}

		$email_store[]  = $email;
		$lid_array_with_email[] = $lid;
	}

	return $lid_array_with_email;
}

//---------------------------------------------------------
// field
//---------------------------------------------------------
function &get_field_name_etc_array()
{
	$arr_name = array();

	$arr_meta =& $this->get_field_meta_name_array();
	if ( !is_array($arr_meta) || (count($arr_meta) == 0) )
	{
		return $arr_name;
	}

	foreach ($this->get_field_name_array() as $name)
	{
		if ( preg_match('/^etc/', $name) )
		{
			$arr_name[] = $name;
		}
	}

	return $arr_name;
}

//---------------------------------------------------------
// add_column_table
//---------------------------------------------------------
function add_column_table_etc($start, $end)
{
	if ( $end < $start )
	{
		$end = $start;
	}

	$comma = ' ';
	if ($start != $end)
	{
		$comma = ', ';
	}

	$sql  = "ALTER TABLE ". $this->_table ." ADD COLUMN (";

// etci .. etcj
	for ($i = $start; $i <= $end; $i++)
	{
		$etc_name = 'etc'. $i;
		$sql .= $etc_name ." varchar(255) default NULL". $comma;
	}

	$sql .= ")";

	$ret = $this->query($sql);
	return $ret;
}

//=========================================================
// link_basic_handler
//=========================================================
function get_count_rss_flag( $flag_exclude=true )
{
	return $this->_link_basic_handler->get_count_rss_flag( $flag_exclude );
}

function get_count_non_url()
{
	return $this->_link_basic_handler->get_count_non_url();
}

function get_count_broken()
{
	return $this->_link_basic_handler->get_count_broken();
}

function get_count_gmap()
{
	return $this->_link_basic_handler->get_count_gmap();
}

function get_count_by_where($where)
{
	return  $this->_link_basic_handler->get_count_by_where($where);
}

function build_sql_where_exclude()
{
	return $this->_link_basic_handler->build_sql_where_exclude();
}

function get_title($lid, $format='n')
{
	return $this->_link_basic_handler->get_title($lid, $format);
}

// --- class end ---
}

// === class end ===
}

?>