<?php
// $Id: weblinks_modify_handler.php,v 1.1 2011/12/29 14:33:04 ohwada Exp $

// 2008-02-17 K.OHWADA
// pagerank, pagerank_update in link, modify

// 2007-11-01 K.OHWADA
// divid to weblinks_modify_basic_handler
// divid to weblinks_modify_def_handler

// 2007-09-01 K.OHWADA
// use can delete link
// get_objects_del()

// 2007-08-01 K.OHWADA
// admin can add etc column

// 2007-04-08 K.OHWADA
// gm_type

// 2007-03-25 K.OHWADA
// album_id

// 2007-02-18 K.OHWADA
// hack for multi site
// add forum_id comment_use field

// 2006-12-10 K.OHWADA
// move to weblinks_modify.php
// add time_publish textarea1
// add add_column_table_130()

// 2006-10-01 K.OHWADA
// use happy_linux
// use rssc
// google map

// 2006-05-15 K.OHWADA
// new handler
// not use weblinks_module_base

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication

//=========================================================
// WebLinks Module
// this file contain 1 class
//   weblinks_modify_handler
// 2004/01/14 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('weblinks_modify_handler') ) 
{

//=========================================================
// class weblinks_modify_handler
//=========================================================
class weblinks_modify_handler extends happy_linux_object_handler
{
	var $_modify_basic_handler;

	var $_conf_link_num_etc = WEBLINKS_LINK_NUM_ETC;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_modify_handler( $dirname )
{
	$this->happy_linux_object_handler( $dirname, 'modify', 'mid', 'weblinks_modify' );

	$this->set_debug_db_sql(   WEBLINKS_DEBUG_MODIFY_SQL );
	$this->set_debug_db_error( WEBLINKS_DEBUG_ERROR );

// hack for multi site
	if ( WEBLINKS_FLAG_MULTI_SITE )
	{
		$this->renew_prefix( WEBLINKS_DB_PREFIX );
	}

	$this->_modify_basic_handler =& weblinks_get_handler( 'modify_basic', $dirname );

	if ( WEBLINKS_USE_LINK_NUM_ETC )
	{
		$config_handler  =& weblinks_get_handler( 'config2_basic', $dirname );
		$conf =& $config_handler->get_conf();
		$this->_conf_link_num_etc = $conf['link_num_etc'];
	}
}

//---------------------------------------------------------
// insert
//---------------------------------------------------------
function _build_insert_sql(&$obj)
{
	foreach ($obj->gets() as $k => $v) 
	{	${$k} = $v;	}

	$sql_etc_name  = '';
	$sql_etc_value = '';

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

	$sql .= 'mode, ';
	$sql .= 'muid, ';
	$sql .= 'lid, ';

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
//	$sql .= 'width, ';
//	$sql .= 'height, ';
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
	$sql .= 'notify, ';
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

// etc
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

	$sql .= intval($mode).', ';
	$sql .= intval($muid).', ';
	$sql .= intval($lid).', ';

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
//	$sql .= intval($width).', ;
//	$sql .= intval($height).', ';
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
	$sql .= intval($notify).', ';
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

	$sql .= 'mode='.intval($mode).', ';
	$sql .= 'muid='.intval($muid).', ';
	$sql .= 'lid='.intval($lid).', ';

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
//	$sql .= 'width='.intval($width).', ';
//	$sql .= 'height='.intval($height).', ';
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
	$sql .= 'notify='.intval($notify).', ';
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

	$sql .= ' WHERE mid='.intval($mid);

	return $sql;
}

//---------------------------------------------------------
// delete
//---------------------------------------------------------
function delete_by_lid($lid)
{
	$sql = 'DELETE FROM '.$this->_table.' WHERE lid='.intval($lid);

	if ( !$this->query($sql) )
	{	return false;	}

	return true;
}

//---------------------------------------------------------
// get object
//---------------------------------------------------------
function &get_objects_by_mode($mode, $limit=0, $start=0)
{
	$mode = intval($mode);
	$criteria = new CriteriaCompo();
	$criteria->add( new criteria('mode', $mode, '=') );
	$criteria->setStart($start);
	$criteria->setLimit($limit);
	$objs =& $this->getObjects($criteria);
	return $objs;
}

function &get_objects_new($limit=0, $start=0)
{
	return $this->get_objects_by_mode( WEBLINKS_C_MODIFY_NEW, $limit, $start );
}

function &get_objects_mod($limit=0, $start=0)
{
	return $this->get_objects_by_mode( WEBLINKS_C_MODIFY_MOD, $limit, $start );
}

function &get_objects_del($limit=0, $start=0)
{
	return $this->get_objects_by_mode( WEBLINKS_C_MODIFY_DEL, $limit, $start );
}

//---------------------------------------------------------
// get mid list
//---------------------------------------------------------
function &get_mid_array_by_mode($mode, $limit=0, $start=0)
{
	$mode = intval($mode);
	$criteria = new CriteriaCompo();
	$criteria->add( new criteria('mode', $mode, '=') );
	$criteria->setStart($start);
	$criteria->setLimit($limit);
	$list =& $this->getList($criteria);
	return $list;
}

function &get_mid_array_new($limit=0, $start=0)
{
	return $this->get_mid_array_by_mode( WEBLINKS_C_MODIFY_NEW, $limit, $start );
}

function &get_mid_array_mod($limit=0, $start=0)
{
	return $this->get_mid_array_by_mode( WEBLINKS_C_MODIFY_MOD, $limit, $start);
}

function &get_mid_array_del($limit=0, $start=0)
{
	return $this->get_mid_array_by_mode( WEBLINKS_C_MODIFY_DEL, $limit, $start );
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

//=========================================================
// alter table
//=========================================================
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
// modify_basic_handler
//=========================================================
function get_count_new()
{
	return $this->_modify_basic_handler->get_count_new();
}

function get_count_mod()
{
	return $this->_modify_basic_handler->get_count_mod();
}

function get_count_del()
{
	return $this->_modify_basic_handler->get_count_del();
}

// --- class end ---
}

// === class end ===
}

?>