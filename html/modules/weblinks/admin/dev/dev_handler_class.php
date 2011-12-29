<?php
// $Id: dev_handler_class.php,v 1.1 2011/12/29 14:32:58 ohwada Exp $

// 2008-02-17 K.OHWADA
// pagerank, pagerank_update in link, modify

// 2007-09-01 K.OHWADA
// assign_link()

// 2007-03-07 K.OHWADA
// return newid from insert_category

// 2007-02-20 K.OHWADA
// get_config_by_name()

//================================================================
// WebLinks Module
// 2006-09-20 K.OHWADA
//================================================================

//=========================================================
// class weblinks_dev_handler
//=========================================================
class weblinks_dev_handler extends happy_linux_basic_handler
{
	var $_LINK_FIELDS = array(
		'lid', 'uid', 'cids', 'title', 'url', 'banner', 'description', 'name',
		'nameflag', 'mail', 'mailflag', 'company', 'addr', 'tel', 'search',
		'passwd', 'admincomment', 'mark', 'time_create', 'time_update', 'hits',
		'rating', 'votes', 'comments','recommend', 'mutual', 'broken',
		'rss_url', 'rss_flag', 'rss_xml', 'rss_update', 'usercomment', 'zip',
		'state', 'city', 'addr2', 'fax', 'rssc_lid', 'map_use', 'forum_id',
		'comment_use','album_id', 
		'gm_latitude', 'gm_longitude', 'gm_zoom', 'gm_type',
		'time_publish', 'time_expire', 'textarea1', 'textarea2', 
		'dohtml', 'dosmiley', 'doxcode', 'doimage', 'dobr',
		'dohtml1', 'dosmiley1', 'doxcode1', 'doimage1', 'dobr1',
		'etc1', 'etc2', 'etc3', 'etc4', 'etc5',
		'aux_int_1', 'aux_int_2', 'aux_text_1', 'aux_text_2',
		'width', 'height', 
		'pagerank', 'pagerank_update',
	);

	var $_MODIFY_FIELDS = array(
		'lid', 'uid', 'cids', 'title', 'url', 'banner', 'description', 'name',
		'nameflag', 'mail', 'mailflag', 'company', 'addr', 'tel', 'search',
		'passwd', 'admincomment', 'mark', 'time_create', 'time_update', 'hits',
		'rating', 'votes', 'comments','recommend', 'mutual', 'broken',
		'rss_url', 'rss_flag', 'rss_xml', 'rss_update', 'usercomment', 'zip',
		'state', 'city', 'addr2', 'fax', 'rssc_lid', 'map_use', 'forum_id',
		'comment_use','album_id', 
		'gm_latitude', 'gm_longitude', 'gm_zoom', 'gm_type',
		'time_publish', 'time_expire', 'textarea1', 'textarea2', 
		'dohtml', 'dosmiley', 'doxcode', 'doimage', 'dobr',
		'dohtml1', 'dosmiley1', 'doxcode1', 'doimage1', 'dobr1',
		'etc1', 'etc2', 'etc3', 'etc4', 'etc5',
		'aux_int_1', 'aux_int_2', 'aux_text_1', 'aux_text_2',
		'mid', 'muid', 'mode', 'notify',
		'pagerank', 'pagerank_update',
	);

	var $_xoopscomments_table;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_dev_handler()
{
	$this->happy_linux_basic_handler( WEBLINKS_DIRNAME );
	$this->set_debug_db_sql(   true );
	$this->set_debug_db_error( true );

	$this->_xoopscomments_table = $this->db_prefix("xoopscomments");
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new weblinks_dev_handler();
	}
	return $instance;
}

//---------------------------------------------------------
// category table
//---------------------------------------------------------
// --- category table ---
//  cid int(5)
//  pid int(5)
//  title varchar(50)
//  imgurl varchar(150)

function insert_category($pid, $title, $imgurl, $orders)
{
	$lflag  = 1;	// allow link 

	$cflag = 0;
	$tflag = 0;
	$displayimg     = '';
	$description    = '';
	$catdescription = '';
	$catfooter      = '';
	$groupid        = '';
	$editaccess     = '';

// table name
	$category_table = $this->prefix("category");

// category table
	$sql  = 'INSERT INTO '.$category_table.' (';
	$sql .= 'pid, ';
	$sql .= 'title, ';
	$sql .= 'imgurl, ';
	$sql .= 'cflag, ';
	$sql .= 'lflag, ';
	$sql .= 'tflag, ';
	$sql .= 'displayimg, ';
	$sql .= 'description, ';
	$sql .= 'catdescription, ';
	$sql .= 'catfooter, ';
	$sql .= 'groupid, ';
	$sql .= 'orders, ';
	$sql .= 'editaccess ';
	$sql .= ') VALUES (';
	$sql .= intval($pid).', ';
	$sql .= $this->quote($title).', ';
	$sql .= $this->quote($imgurl).', ';
	$sql .= intval($cflag).', ';
	$sql .= intval($lflag).', ';
	$sql .= intval($tflag).', ';
	$sql .= intval($displayimg).', ';
	$sql .= $this->quote($description).', ';
	$sql .= $this->quote($catdescription).', ';
	$sql .= $this->quote($catfooter).', ';
	$sql .= $this->quote($groupid).', ';
	$sql .= intval($orders).', ';
	$sql .= $this->quote($editaccess).' ';
	$sql .= ')';

	$this->query($sql);
	$newid = $this->getInsertId();
	return $newid;
}

function &get_category($cid)
{
	$category_table = $this->prefix("category");
	$sql = "SELECT * FROM ".$category_table." WHERE cid=".intval($cid);
	$row =& $this->get_row_by_sql($sql);
	return $row;
}

//---------------------------------------------------------
// link table
//---------------------------------------------------------
// --- link table ---
//  lid int(11)
//  uid int(11)
//  title varchar(100)
//  url   varchar(250)
//  time_create int(10)
//  time_update int(10)
//  hits int(11)
//  rating double(6,4)
//  votes int(11)
//  comments int(11)
//  width  int(5)
//  height int(5)

// --- catlink table ---
//  jid int(11)
//  cid int(4)
//  lid int(11)

function &assign_link( $values )
{
	$arr = array();
	foreach ( $this->_LINK_FIELDS as $k )
	{
		if ( isset( $values[$k]) ) {
			$arr[ $k ] = $values[ $k ];
		} else {
			$arr[ $k ] = null;
		}
	}
	return $arr;
}

function insert_randum_link($title='', $rss_flag=0, $rss_url='')
{
	if ( $title == '' )
	{
		$title = $this->get_randum_title();
	}

	$hits      = rand(0, 100);
	$title     = $this->get_randum_title();
	$banner    = $this->get_randum_banner( 5 );
	$passwd    = $this->get_randum_passwd_md5();
	$recommend = $this->get_randum_mark();
	$mutual    = $this->get_randum_mark();

	list($time_create, $time_update) = $this->get_randum_create_time();

	$description = "$title\n $time_create\n";

// no url per 10
	$url = "http://$title/";
	if (( $rss_flag == 0 ) && ( rand(0, 9) == 0 ))
	{
		$url = '';
	}

// name
	$name     = '';
	$mail     = '';
	$nameflag = 0;
	$mailflag = 0;

	$uid = rand(0, 10);
	if ($uid)
	{
		$user =& $this->_system->get_user_by_uid($uid);
		$name = $user['uname'];
		$mail = $user['email'];
		$nameflag = rand(0, 1);
		$mailflag = rand(0, 1);
	}

// broken per 10
	$broken = 0;
	if ( rand(0, 9) == 0 )
	{
		$broken = rand(1, 10);
	}

// figures image
	$width    = 20;
	$height   = 27;

	$cids     = '';
	$company  = '';
	$addr     = '';
	$tel      = '';
	$admincomment = '';
	$mark        = 0;
	$rating      = 0;
	$votes       = 0;
	$comments    = 0;
	$rss_xml     = '';
	$rss_update  = 0;
	$usercomment = '';
	$zip      = '';
	$state    = '';
	$city     = '';
	$addr2    = '';
	$fax      = '';
	$dohtml   = 0;
	$dosmiley = 1;
	$doxcode  = 1;
	$doimage  = 1;
	$dobr     = 1;
	$etc1 = '';
	$etc2 = '';
	$etc3 = '';
	$etc4 = '';
	$etc5 = '';
	$rssc_lid   = '';
	$aux_int_1  = 0;
	$aux_int_2  = 0;
	$aux_text_1 = '';
	$aux_text_2 = '';

	$search = "$title $url $description";

// insert
	$link_table = $this->prefix("link");

	$sql  = 'INSERT INTO '.$link_table.' (';
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
	$sql .= 'dohtml, ';
	$sql .= 'dosmiley, ';
	$sql .= 'doxcode, ';
	$sql .= 'doimage, ';
	$sql .= 'dobr, ';
	$sql .= 'etc1, ';
	$sql .= 'etc2, ';
	$sql .= 'etc3, ';
	$sql .= 'etc4, ';
	$sql .= 'etc5, ';
	$sql .= 'rssc_lid, ';
	$sql .= 'aux_int_1, ';
	$sql .= 'aux_int_2, ';
	$sql .= 'aux_text_1, ';
	$sql .= 'aux_text_2 ';
	$sql .= ') VALUES (';
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
	$sql .= intval($dohtml).', ';
	$sql .= intval($dosmiley).', ';
	$sql .= intval($doxcode).', ';
	$sql .= intval($doimage).', ';
	$sql .= intval($dobr).', ';
	$sql .= $this->quote($etc1).', ';
	$sql .= $this->quote($etc2).', ';
	$sql .= $this->quote($etc3).', ';
	$sql .= $this->quote($etc4).', ';
	$sql .= $this->quote($etc5).', ';
	$sql .= intval($rssc_lid).', ';
	$sql .= intval($aux_int_1).', ';
	$sql .= intval($aux_int_2).', ';
	$sql .= $this->quote($aux_text_1).', ';
	$sql .= $this->quote($aux_text_2).' ';
	$sql .= ')';

	$this->query($sql);
	$newid = $this->getInsertId();
	return $newid;
}

function update_link_rating_by_lid($sum, $count, $lid)
{
	$link_table = $this->prefix("link");
	$rating = $sum / $count;

	$sql = "UPDATE $link_table SET rating=$rating, votes=$count WHERE lid=".intval($lid);;
	$this->query($sql);
}

function update_link_comments( $lid, $comments )
{
	$link_table = $this->prefix("link");

	$sql= "UPDATE $link_table SET comments=$comments WHERE lid=".intval($lid);;
	$this->query($sql);
}

function &get_link($lid)
{
	$link_table = $this->prefix("link");
	$sql = "SELECT * FROM ".$link_table." WHERE lid=".intval($lid);
	$row =& $this->get_row_by_sql($sql);
	return $row;
}

//---------------------------------------------------------
// modify table
//---------------------------------------------------------
function &assign_modify( $values )
{
	$arr = array();
	foreach ( $this->_MODIFY_FIELDS as $k )
	{
		if ( isset( $values[$k]) ) {
			$arr[ $k ] = $values[ $k ];
		} else {
			$arr[ $k ] = null;
		}
	}
	return $arr;
}

function &get_modify($mid)
{
	$modify_table = $this->prefix("modify");
	$sql = "SELECT * FROM ".$modify_table." WHERE mid=".intval($mid);
	$row =& $this->get_row_by_sql($sql);
	return $row;
}

//---------------------------------------------------------
// catlink table
//---------------------------------------------------------
//  jid int(11) unsigned NOT NULL auto_increment,
//  cid int(4)  unsigned NOT NULL default '0',
//  lid int(11) unsigned NOT NULL default '0',

function insert_catlink($cid, $lid)
{
	$catlink_table = $this->prefix("catlink");

	$sql  = "INSERT INTO ".$catlink_table." (";
	$sql .= "cid, lid";
	$sql .= ") VALUES (";
	$sql .= "$cid, $lid";
	$sql .= ")";

	$this->query($sql);
}

//---------------------------------------------------------
// votedata table
//---------------------------------------------------------
// --- votedata table ---
//  ratingid int(11)
//  lid int(11)
//  ratinguser int(11)
//  rating tinyint(3)
//  ratinghostname varchar(60)
//  ratingtimestamp int(10)

function insert_votedata($lid, $ratinguser, $rating, $ratinghostname, $ratingtimestamp)
{
	$votedata_table = $this->prefix("votedata");

	$sql  = "INSERT INTO $votedata_table ";
	$sql .= "(lid, ratinguser, rating, ratinghostname, ratingtimestamp)";
	$sql .= "VALUES ";
	$sql .= "($lid, $ratinguser, $rating, '$ratinghostname', $ratingtimestamp)";

	$this->query($sql);
}

function &get_votedata_rows_groupby_lid()
{
	$votedata_table = $this->prefix("votedata");
	$sql  = "SELECT lid, count(lid) as c, sum(rating) as s FROM $votedata_table GROUP BY lid ";
	$rows =& $this->get_rows_by_sql($sql);
	return $rows;
}

//---------------------------------------------------------
// config
//---------------------------------------------------------
//  id      smallint(5) unsigned NOT NULL auto_increment,
//  conf_id smallint(5) unsigned NOT NULL default 0,
//  conf_name      varchar(255) NOT NULL default '',
//  conf_valuetype varchar(255) NOT NULL default '',
//  conf_value text NOT NULL,
//  aux_int_1 int(5) default '0',
//  aux_int_2 int(5) default '0',
//  aux_text_1 varchar(255) default '',
//  aux_text_2 varchar(255) default '',

function get_config_by_name($name)
{
	$config_table = $this->prefix("config2");

	$sql  = 'SELECT * FROM '.$config_table;
	$sql .= ' WHERE conf_name='.$this->quote($name);
	$row =& $this->get_row_by_sql($sql);

	$val = false;
	if ( isset($row['conf_value']) )
	{
		$val = $row['conf_value'];
	}

	return $val;
}

function update_config_by_name_array($name, $value)
{
	$this->update_config_by_name($name, serialize($value) );
}

function update_config_by_name($name, $value)
{
	$config_table = $this->prefix("config2");

	$sql = 'UPDATE '.$config_table.' SET ';
	$sql .= 'conf_value='.$this->quote($value).' ';
	$sql .= 'WHERE conf_name='.$this->quote($name);
	$this->query($sql);
}

//---------------------------------------------------------
// linkitem table
//---------------------------------------------------------
//  id      smallint(5) unsigned NOT NULL auto_increment,
//  item_id smallint(5) unsigned NOT NULL default 0,
//  name      varchar(255) NOT NULL default '',
//  title     varchar(255) NOT NULL default '',
//  user_mode int(5) default '0',
//  aux_int_1 int(5) default '0',
//  aux_int_2 int(5) default '0',
//  aux_text_1 varchar(255) default '',
//  aux_text_2 varchar(255) default '',

function update_linkitem_user_mode_by_name($name, $value)
{
	$linkitem_table = $this->prefix("linkitem");

	$sql = 'UPDATE '.$linkitem_table.' SET ';
	$sql .= 'user_mode='.$this->quote($value).' ';
	$sql .= 'WHERE name='.$this->quote($name);
	$this->query($sql);
}

//---------------------------------------------------------
// rssc link table
//---------------------------------------------------------
function &get_rssc_link($rssc_lid)
{
	$rssc_link_table  = $this->db_prefix("rssc_link");
	$sql = "SELECT * FROM ".$rssc_link_table." WHERE lid=".intval($rssc_lid);
	$row =& $this->get_row_by_sql($sql);
	return $row;
}

//---------------------------------------------------------
// rssc link table
//---------------------------------------------------------
function get_rssc_feed_count_by_rssc_link($rssc_lid)
{
	$rssc_feed_table  = $this->db_prefix("rssc_feed");
	$sql = "SELECT count(*) FROM ".$rssc_feed_table." WHERE lid=".intval($rssc_lid);
	return $this->get_count_by_sql($sql);
}

//---------------------------------------------------------
// xoopscomments table
//---------------------------------------------------------
// com_id   mediumint(8)
// com_pid  mediumint(8)
// com_rootid  mediumint(8)
// com_modid   smallint(5)
// com_itemid  mediumint(8)
// com_icon    varchar(25)
// com_created  int(10)
// com_modified int(10)
// com_uid    mediumint(8)
// com_ip     varchar(15)
// com_title  varchar(255)
// com_text   text
// com_sig    tinyint(1)
// com_status tinyint(1)
// com_exparams  varchar(255)
// dohtml   tinyint(1)
// dosmiley tinyint(1)
// doxcode  tinyint(1)
// doimage  tinyint(1)
// dobr     tinyint(1)

function create_randum_comment( $i, $mid, $MAX_ITEMID )
{

// table name
	$com_table  = $this->db_prefix("xoopscomments");

// constant
	$com_icon = '';
	$com_sig  = 0;
	$dohtml   = 0;
	$dosmiley = 1;
	$doxcode  = 1;
	$doimage  = 1;
	$dobr     = 1;
	$com_status   = 2;
	$com_exparams = '';
	$com_modid    = $mid;

// randum data
	$com_itemid   = rand(1, $MAX_ITEMID);
	$com_uid      = rand(1, 10);
	$com_ip       = $this->get_randum_ip();
	$com_title    = $this->get_randum_title();
	$com_created  = $this->get_randum_time();
	$com_modified = $com_created;

// other
	$com_text  = "$com_title\n $com_created\n";

// xoopscomments table
	$sql  = "INSERT INTO ".$this->_xoopscomments_table." ";
	$sql .= "(com_modid, com_itemid, com_icon, com_created, com_modified, com_uid, com_ip, com_title, com_text, com_sig, com_status, com_exparams, dohtml, dosmiley, doxcode, doimage, dobr)";
	$sql .= "VALUES ";
	$sql .= "($com_modid, $com_itemid, '$com_icon', $com_created, $com_modified, $com_uid, '$com_ip', '$com_title', '$com_text', $com_sig, $com_status, '$com_exparams', $dohtml, $dosmiley, $doxcode, $doimage, $dobr)";
	$this->query($sql);
	$newid = $this->getInsertId();

// pid: 1 per 2
	$com_id     = $newid;
	$com_rootid = $newid;
	$com_pid    = 0;

	if ($i % 2 == 0)
	{
		if ( isset( $this->_com_itemid_arr[$com_itemid] ) )
		{
			$pid_arr = $this->_com_itemid_arr[$com_itemid];
			$count   = count($pid_arr) - 1;

			if ( $count < 0 )
			{
				$count = 0;
			}

			$id = rand(0, $count);

			if ( isset( $pid_arr[$id] ))
			{
				$com_pid    = $pid_arr[$id];
				$com_rootid = $this->_com_id_arr[$com_pid]['com_rootid'];
			}
		}
	}

	$sql2  = "UPDATE ".$this->_xoopscomments_table." SET ";
	$sql2 .= "com_rootid=$com_rootid, ";
	$sql2 .= "com_pid=$com_pid ";
	$sql2 .= "WHERE com_id=$com_id";
	$this->query($sql2);

	$this->_com_id_arr[$com_id]['com_rootid'] = $com_rootid;
	$this->_com_itemid_arr[$com_itemid][]     = $com_id;
}

function &get_comment_rows( $mid )
{
	$sql  = "SELECT com_itemid, count(com_itemid) as c ";
	$sql .= "FROM ".$this->_xoopscomments_table." ";
	$sql .= "WHERE com_modid=".$mid." GROUP BY com_itemid ";
	$rows =& $this->get_rows_by_sql($sql);
	return $rows;
}

//---------------------------------------------------------
// module_handler
//---------------------------------------------------------
function is_exist_module( $dirname )
{
	$module =& $this->_system->get_module_by_dirname( $dirname );
	if ( is_object($module) )
	{
		return true;
	}
	return false;
}

function get_mid_by_dirname( $dirname )
{
	$mid = $this->_system->get_mid_by_dirname( $dirname );
	return $mid;
}

// --- class end ---
}

?>