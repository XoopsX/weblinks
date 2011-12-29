<?php
// $Id: weblinks120_to_rssc040.php,v 1.1 2011/12/29 14:32:53 ohwada Exp $

// 2006-09-20 K.OHWADA
// this is new file
// use rssc WEBLINKS_RSSC_EXIST

//================================================================
// WebLinks Module
// 2006-09-20 K.OHWADA
//================================================================

include 'admin_header.php';

//=========================================================
// class admin_export_rssc
//=========================================================
class admin_export_rssc extends happy_linux_basic_handler
{
	var $_LIMIT = 100;

	var $_FLAG_UPDATE_RSSC = true;

	var $_form;
	var $_system;
	var $_strings;
	var $_post;

	var $_weblinks_config_handler;
	var $_weblinks_link_handler;

	var $_weblinks_atomfeed_table;

	var $_weblinks_mid = 0;

// rssc handler
	var $_rssc_link_handler;
	var $_rssc_black_handler;
	var $_rssc_white_handler;
	var $_rssc_feed_handler;
	var $_rssc_parse_handler;

// conf
	var $_conf_rss_site_arr;
	var $_conf_rss_black_arr;
	var $_conf_rss_white_arr;

// local
	var $_rssc_lid_list_by_p1   = array();
	var $_rssc_lid_list_by_url  = array();
	var $_rssc_link_objs_by_lid = array();
	var $_rssc_exist_lid;

// post
	var $_op;
	var $_limit;
	var $_offset;
	var $_next;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_export_rssc()
{
	$this->happy_linux_basic_handler( WEBLINKS_DIRNAME );
	$this->set_debug_db_sql(   0 );
	$this->set_debug_db_error( 1 );

	$this->_system  =& happy_linux_system::getInstance();
	$this->_strings =& happy_linux_strings::getInstance();
	$this->_post    =& happy_linux_post::getInstance();
	$this->_form    =& happy_linux_form_lib::getInstance();

	$this->_weblinks_config_handler =& weblinks_get_handler( 'config2_basic', WEBLINKS_DIRNAME );
	$this->_weblinks_link_handler   =& weblinks_get_handler( 'link',          WEBLINKS_DIRNAME );

	$this->_weblinks_atomfeed_table = $this->prefix( 'atomfeed' );
	$this->_weblinks_mid            = $this->_system->get_mid();

	$conf = $this->_weblinks_config_handler->get_conf();
	$this->_conf_rss_site_arr  = $conf['rss_site_arr'];
	$this->_conf_rss_black_arr = $conf['rss_black_arr'];
	$this->_conf_rss_white_arr = $conf['rss_white_arr'];

	if ( WEBLINKS_RSSC_EXIST )
	{
		$this->_rssc_link_handler  =& rssc_get_handler( 'link',  WEBLINKS_RSSC_DIRNAME );
		$this->_rssc_black_handler =& rssc_get_handler( 'black', WEBLINKS_RSSC_DIRNAME );
		$this->_rssc_white_handler =& rssc_get_handler( 'white', WEBLINKS_RSSC_DIRNAME );
		$this->_rssc_feed_handler  =& rssc_get_handler( 'feed',  WEBLINKS_RSSC_DIRNAME );
		$this->_rssc_parse_handler =& rssc_parse_handler::getInstance();
	}

}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_export_rssc();
	}

	return $instance;
}

//---------------------------------------------------------
// POST param
//---------------------------------------------------------
function get_post_op()
{
	$this->_op = $this->_post->get_post_get('op');
	return $this->_op;
}

function get_post_limit()
{
	$this->_limit = $this->_post->get_post_get('limit');
	return $this->_limit;
}

function get_post_offset()
{
	$this->_offset = $this->_post->get_post_get('offset');
	$this->_next   = $this->_offset + $this->_LIMIT;
	return $this->_offset;
}

//---------------------------------------------------------
// menu
//---------------------------------------------------------
function menu()
{

?>
<br />
There are 5 steps. <br />
1. export rss site to link table <br />
2. export to black list <br />
3. export to white list <br />
4. export to link table <br />
5. export to feed table <br />
excute each <?php echo $this->_LIMIT; ?> records at a time <br />
<br />
<?php

	$this->_form_site();

}

//---------------------------------------------------------
// export_site
//---------------------------------------------------------
function export_site()
{
	echo "<h4>STEP 1: export rss site to link table </h4>\n";

	$offset = $this->get_post_offset();

// weblinks list
	$site_list = $this->_conf_rss_site_arr;
	$total     = count($site_list);

	echo "There are <b>".$total."</b> rss site in weblinks<br /><br />\n";

	$i = 0;

	foreach ($site_list as $site_url)
	{
		echo $i.": ".htmlspecialchars($site_url);
		$i ++;

		if ( $this->_exist_url_in_rssc($site_url) )
		{
			echo " <b>skip</b> <br />\n";
			continue;
		}

		echo " <br />\n";

		$title = '';
		$link  = '';

		$parse_obj = $this->_rssc_parse_handler->parse_by_url($site_url);
		if ( is_object($parse_obj) )
		{
			$title = $parse_obj->get_channel_by_key('title');
			$link  = $parse_obj->get_channel_by_key('link');
		}

		if ( empty($title) )
		{
			$title = 'RSS site '.$i;
		}

		$url      = $link;
		$rss_url  = $site_url;

		$rssc_link_obj =& $this->_rssc_link_handler->create();
		$rssc_link_obj->set('uid',      1 );	// admin
		$rssc_link_obj->set('mid',      $this->_weblinks_mid );
		$rssc_link_obj->set('ltype',    RSSC_C_LINK_LTYPE_SERACH );
		$rssc_link_obj->set('mode',     RSSC_C_MODE_RSS );
		$rssc_link_obj->set('refresh',  3600 );	// 1 hour
		$rssc_link_obj->setVar('title',    $title,    true );
		$rssc_link_obj->setVar('url',      $url,      true );
		$rssc_link_obj->setVar('rss_url',  $rss_url,  true );
		$this->_rssc_link_handler->insert($rssc_link_obj);

		unset($rssc_link_obj);
	}

	$this->_form_black();

}

//---------------------------------------------------------
// export_black
//---------------------------------------------------------
function export_black()
{
// === black table ===
// --- rssc ---
//  bid int(11)
//  lid int(11)
//  uid int(11)
//  mid int(11)
//  p1  int(11)
//  p2  int(11)
//  p3  int(11)
//  title  varchar(255)
//  url    varchar(255)
//  memo text
//  aux_int_1 int(5)
//  aux_int_2 int(5)
//  aux_text_1 varchar(255)
//  aux_text_2 varchar(255)

	echo "<h4>STEP 2: export to block list</h4>\n";

	$offset = $this->get_post_offset();

// weblinks list
	$site_list = $this->_conf_rss_black_arr;
	$total     = count($site_list);

	echo "There are <b>".$total."</b> black list in weblinks<br /><br />\n";

	$i = 0;

	foreach ($site_list as $site_url)
	{
		$title = '';

		$parse_obj =& $this->_rssc_parse_handler->discover_and_parse_by_html_url($site_url);
		if ( is_object($parse_obj) )
		{
			$title = $parse_obj->get_channel_by_key('title');
		}

		if ( empty($title) )
		{
			$title = 'Black '.$i;
		}

		$url = $site_url;

		echo $i.": ".htmlspecialchars($url)." <br />\n";

		$black_obj =& $this->_rssc_black_handler->create();

		$black_obj->set('uid',      1 );	// admin
		$black_obj->set('mid',      $this->_weblinks_mid );
		$black_obj->setVar('title',    $title,    true );
		$black_obj->setVar('url',      $url,      true );

		$this->_rssc_black_handler->insert($black_obj);
		unset($black_obj);

		$i ++;
	}

	$this->_form_white();

}

//---------------------------------------------------------
// export_white
//---------------------------------------------------------
function export_white()
{
// === white table ===
// --- rssc ---
//  wid int(11)
//  lid int(11)
//  uid int(11)
//  mid int(11)
//  p1  int(11)
//  p2  int(11)
//  p3  int(11)
//  title  varchar(255)
//  url    varchar(255)
//  memo text
//  aux_int_1 int(5)
//  aux_int_2 int(5)
//  aux_text_1 varchar(255)
//  aux_text_2 varchar(255)

	echo "<h4>STEP 3: export to white list</h4>\n";

	$offset = $this->get_post_offset();

// weblinks list
	$site_list = $this->_conf_rss_white_arr;
	$total     = count($site_list);

	echo "There are <b>".$total."</b> white list in weblinks<br /><br />\n";

	$i = 0;

	foreach ($site_list as $site_url)
	{
		$title = '';

		$parse_obj =& $this->_rssc_parse_handler->discover_and_parse_by_html_url($site_url);
		if ( is_object($parse_obj) )
		{
			$title = $parse_obj->get_channel_by_key('title');
		}

		if ( empty($title) )
		{
			$title = 'White '.$i;
		}

		$url = $site_url;

		echo $i.": ".htmlspecialchars($url)." <br />\n";

		$white_obj =& $this->_rssc_white_handler->create();

		$white_obj->set('uid',      1 );	// admin
		$white_obj->set('mid',      $this->_weblinks_mid );
		$white_obj->setVar('title',    $title,    true );
		$white_obj->setVar('url',      $url,      true );

		$this->_rssc_white_handler->insert($white_obj);
		unset($white_obj);

		$i ++;
	}

	$this->_form_link();

}

//---------------------------------------------------------
// export_link
//---------------------------------------------------------
function export_link()
{
// === link table ===

// --- weblinks ---
//  lid int(11)
//  cids  varchar(100) : use catlink
//  title varchar(100)
//  url varchar(255)
//  banner varchar(255) : full url
//  uid int(5) : submitter
//  time_create int(10)
//  time_update int(10)
//  hits int(11)
//  rating double(6,4)
//  votes int(11)
//  comments int(11)
//  description text
//  search text default
//  passwd varchar(255)
//  name varchar(255)
//  nameflag tinyint(2)
//  mail varchar(255)
//  mailflag tinyint(2)
//  company varchar(255)
//  addr varchar(255)
//  tel varchar(255)
//  admincomment text
//  width  int(5)
//  height int(5)
//  recommend tinyint(2)
//  mutual    tinyint(2)
//  broken int(11)
//  rss_url  varchar(255)
//  rss_flag tinyint(3)
//  rss_xml  mediumtext
//  rss_update int(10)
//  usercomment text
//  zip    varchar(100)
//  state  varchar(100)
//  city   varchar(100)
//  addr2  varchar(255)
//  fax    varchar(255)

// --- rssc ---
//  lid int(11)
//  uid int(11)
//  mid int(11)
//  p1  int(11)
//  p2  int(11)
//  p3  int(11)
//  title  varchar(255)
//  url    varchar(255)
//  refresh   mediumint(8)
//  headline  mediumint(8)
//  mode      tinyint(3)
//  rdf_url   varchar(255)
//  rss_url   varchar(255)
//  atom_url  varchar(255)
//  encoding  varchar(15)
//  updated_unix int(10)
//  channel text
//  xml  mediumtext
//  aux_int_1 int(5)
//  aux_int_2 int(5)
//  aux_text_1 varchar(255)
//  aux_text_2 varchar(255)

	echo "<h4>STEP 4: export to link table</h4>\n";

	$total = $this->_weblinks_link_handler->get_count_rss_flag_prev_ver();

	$offset = $this->get_post_offset();
	
	$next   = $this->_next;
	if ( $this->_next > $total )
	{
		$next = $total;
	}

	echo "There are <b>".$total."</b> rss links in weblinks<br />\n";
	echo "Transfer ".$offset." - ".$next." record <br /><br />\n";

	$weblinks_link_objs =& $this->_weblinks_link_handler->get_objects_rss_flag_prev_ver($this->_LIMIT, $offset);
	foreach ($weblinks_link_objs as $obj)
	{
		$lid      = $obj->get('lid');
		$title    = $obj->get('title');
		$uid      = $obj->get('uid');
		$url      = $obj->get('url');
		$rss_flag = $obj->get('rss_flag');
		$weblinks_rss_url = $obj->get('rss_url');

		echo $lid.": ".htmlspecialchars($title);

// if exist same url
		if ( $this->_exist_url_in_rssc($weblinks_rss_url) )
		{
			echo " <b>update</b> <br />\n";
			$rssc_lid = $this->_rssc_exist_lid;

// overwrite data in rssc link table
			if ( $this->_FLAG_UPDATE_RSSC )
			{
				$rssc_link_obj =& $this->_rssc_link_handler->get($lid);
				if ( is_object($rssc_link_obj) )
				{
					$rssc_link_obj->set('mid', $this->_weblinks_mid );
					$rssc_link_obj->set('p1',  $lid );	// store lid;
					$this->_rssc_link_handler->update($rssc_link_obj);
					unset($rssc_link_obj);
				}
			}
		}

// if not exist same url
		else
		{
			echo " insert <br />\n";

			$rss_url  = '';
			$atom_url = '';

			switch ( $rss_flag )
			{
				case 1:
					$mode    = 2;	// rss
					$rss_url = $weblinks_rss_url;
					break;

				case 2:
					$mode     = 3;	// atom
					$atom_url = $weblinks_rss_url;
					break;

				default:
					$mode = 4;	// auto
					break;
			}

			$rssc_link_obj =& $this->_rssc_link_handler->create();
			$rssc_link_obj->set('uid',      $uid );
			$rssc_link_obj->set('mid',      $this->_weblinks_mid );
			$rssc_link_obj->set('mode',     $mode );
			$rssc_link_obj->set('refresh',  86400 );	// 24 hours
			$rssc_link_obj->set('p1',       $lid ); 	// store lid;
			$rssc_link_obj->setVar('title',    $title,    true );
			$rssc_link_obj->setVar('url',      $url,      true );
			$rssc_link_obj->setVar('rss_url',  $rss_url,  true );
			$rssc_link_obj->setVar('atom_url', $atom_url,  true );
			$rssc_lid = $this->_rssc_link_handler->insert($rssc_link_obj);
			unset($rssc_link_obj);
		}

// weblinks link table
		if ( $rssc_lid )
		{
			$this->_weblinks_link_handler->update_rssc_lid( $lid, $rssc_lid );
		}

	}

	if ( $total > $next )
	{
		$this->_form_link($next);
	}
	else
	{
		$this->_form_feed();
	}

}

//---------------------------------------------------------
// export_feed
//---------------------------------------------------------
function export_feed()
{
// === feed table ===

// --- weblinks ---
//  aid int(11)
//  lid int(11)
//  site_title varchar(100)
//  site_url   varchar(255)
//  title varchar(100)
//  url   varchar(255)
//  entry_id   varchar(255)
//  guid       varchar(255)
//  time_modified int(10)
//  time_issued   int(10)
//  time_created  int(10)
//  author_name  varchar(100)
//  author_url   varchar(255)
//  author_email varchar(255)
//  content text

// --- rssc ---
//  fid int(11)
//  lid int(11)
//  uid int(11)
//  mid int(11)
//  p1  int(11)
//  p2  int(11)
//  p3  int(11)
//  site_title varchar(255)
//  site_link  varchar(255)
//  title  varchar(255)
//  link   varchar(255)
//  entry_id  varchar(255)
//  guid      varchar(255)
//  updated_unix   int(10)
//  published_unix int(10)
//  category  varchar(255)
//  author_name  varchar(255)
//  author_uri   varchar(255)
//  author_email varchar(255)
//  type_cont    varchar(255)
//  raws    text
//  content text
//  search  text
//  aux_int_1 int(5)
//  aux_int_2 int(5)
//  aux_text_1 varchar(255)
//  aux_text_2 varchar(255)

	echo "<h4>STEP 5: export to feed table</h4>\n";

	$offset = $this->get_post_offset();

	$total =  $this->_get_weblinks_atomfeed_count();
	$rows  =& $this->_get_weblinks_atomfeed_rows($this->_LIMIT, $offset);

	$next   = $this->_next;
	if ( $this->_next > $total )
	{
		$next = $total;
	}

	$this->_set_rssc_lid_list();

	echo "There are <b>".$total."</b> feeds in weblinks<br />\n";
	echo "Transfer ".$offset." - ".$next." record <br /><br />\n";

	foreach ($rows as $row)
	{
		$aid   = $row['aid'];
		$title = $row['title'];
		$link  = $row['url'];

		echo $aid.": ".htmlspecialchars($title);

		if ( $this->_exist_rssc_feed($link) )
		{
			echo " <b>skip</b> <br />\n";
			continue;
		}

		echo " <br />\n";

		$lid = $this->_get_rssc_feed_lid( $row );
		$uid = $this->_get_rssc_feed_uid( $lid );
		$p1  = $this->_get_rssc_feed_p1(  $lid );
		$site_title     = $row['site_title'];
		$site_link      = $row['site_url'];
		$entry_id       = $row['entry_id'];
		$guid           = $row['guid'];
		$updated_unix   = $row['time_modified'];
		$published_unix = $row['time_issued'];
		$author_name    = $row['author_name'];
		$author_uri     = $row['author_url'];
		$author_email   = $row['author_email'];
		$content        = $row['content'];

		$feed_obj =& $this->_rssc_feed_handler->create();

		$feed_obj->set('lid', $lid );
		$feed_obj->set('uid', $uid );
		$feed_obj->set('mid', $this->_weblinks_mid );
		$feed_obj->set('p1',  $p1 );
		$feed_obj->set('updated_unix',   $updated_unix );
		$feed_obj->set('published_unix', $published_unix );
		$feed_obj->setVar('site_title',   $site_title,   true );
		$feed_obj->setVar('site_link',    $site_link,    true );
		$feed_obj->setVar('title',        $title,        true );
		$feed_obj->setVar('link',         $link,         true );
		$feed_obj->setVar('entry_id',     $entry_id,     true );
		$feed_obj->setVar('guid',         $guid,         true );
		$feed_obj->setVar('author_name',  $author_name,  true );
		$feed_obj->setVar('author_uri',   $author_uri,   true );
		$feed_obj->setVar('author_email', $author_email, true );
		$feed_obj->setVar('content',      $content,      true );
		$feed_obj->set_search();

		$this->_rssc_feed_handler->insert($feed_obj);
		unset($feed_obj);
	}

	if ( $total > $next )
	{
		$this->_form_feed($next);
	}
	else
	{
		$this->_print_finish();
	}

}

//---------------------------------------------------------
// weblinks atomfeed table
//---------------------------------------------------------
function _get_weblinks_atomfeed_count()
{
	$sql   = "SELECT count(*) FROM ".$this->_weblinks_atomfeed_table;
	$count = $this->get_count_by_sql($sql);
	return $count;
}

function _get_weblinks_atomfeed_rows($limit=0, $offset=0)
{
	$sql  = "SELECT * FROM ".$this->_weblinks_atomfeed_table;
	$sql .= " ORDER BY aid";
	$rows  =& $this->get_rows_by_sql($sql, $limit, $offset);
	return $rows;
}

//---------------------------------------------------------
// rssc link_handler
//---------------------------------------------------------
function _exist_url_in_rssc($url)
{
	$this->_rssc_exist_lid = 0;
	$list =& $this->_rssc_link_handler->get_list_by_rssurl( $url );
	if ( is_array($list) && (count($list) > 0) )
	{
		$this->_rssc_exist_lid = $list[0];
		return true;
	}
	return false;
}

function _set_rssc_lid_list()
{
	$rssc_link_objs =& $this->_rssc_link_handler->getObjects();

	$arr1 = array();
	$arr2 = array();
	$arr3 = array();

	foreach ( $rssc_link_objs as $obj )
	{
		$lid = $obj->get('lid');
		$url = $obj->get('url');
		$p1  = $obj->get('p1');

		if ( $p1 )
		{
			$arr1[ $p1 ]  = $lid;
		}

		if ( $url )
		{
			$arr2[ $url ] = $lid;
		}

		$arr3[ $lid ] = $obj;
	}

	$this->_rssc_lid_list_by_p1   = $arr1;
	$this->_rssc_lid_list_by_url  = $arr2;
	$this->_rssc_link_objs_by_lid = $arr3;

}

function _get_rssc_feed_lid($arr)
{
	$lid = $arr['lid'];
	$url = $arr['site_url'];

	if ( isset( $this->_rssc_lid_list_by_p1[$lid] ) )
	{
		$val = $this->_rssc_lid_list_by_p1[$lid];
	}
	elseif ( isset( $this->_rssc_lid_list_by_url[$url] ) )
	{
		$val = $this->_rssc_lid_list_by_url[$url];
	}
	else
	{
		$val = 0;
	}

	return $val;
}

function _get_rssc_feed_uid($lid)
{
	$ret = 0;
	$obj =& $this->_get_rssc_link_obj_by_lid($lid);
	if ( is_object($obj) )
	{
		$ret = $obj->get('uid');
	}
	return $ret;
}

function _get_rssc_feed_p1($lid)
{
	$ret = 0;
	$obj =& $this->_get_rssc_link_obj_by_lid($lid);
	if ( is_object($obj) )
	{
		$ret = $obj->get('p1');
	}
	return $ret;
}

function &_get_rssc_link_obj_by_lid($lid)
{
	$obj = false;
	if ( isset($this->_rssc_link_objs_by_lid[$lid]) )
	{
		$obj = $this->_rssc_link_objs_by_lid[$lid];
	}
	return $obj;
}

function _exist_rssc_feed($link)
{
	$count =& $this->_rssc_feed_handler->get_count_by_link($link);
	if ( $count )
	{
		return true;
	}
	return false;
}

//---------------------------------------------------------
// print form
//---------------------------------------------------------
function _print_finish()
{
	echo "<br /><hr />\n";
	echo "<h4>FINISHED</h4>\n";
	echo "<a href='index.php'>GOTO Admin Menu</a><br />\n";
}

function _form_site()
{
	$title  = 'STEP 1 : export rss site to link table';
	$op     = 'export_site';
	$submit = 'GO STEP 1';

	$this->_print_form_next($title, $op, $submit);

}

function _form_black()
{
	$title  = 'STEP 2 : export to black list';
	$op     = 'export_black';
	$submit = 'GO STEP 2';

	$this->_print_form_next($title, $op, $submit);

}

function _form_white()
{
	$title  = 'STEP 3 : export to white list';
	$op     = 'export_white';
	$submit = 'GO STEP 3';

	$this->_print_form_next($title, $op, $submit);

}

function _form_link($offset=0)
{
	$title  = 'STEP 4 : export to link table';
	$op     = 'export_link';

	if ($offset)
	{
		$submit = "GO next $this->_LIMIT links";
	}
	else
	{
		$submit = 'GO STEP 4';
	}

	$this->_print_form_next($title, $op, $submit, $offset);

}

function _form_feed($offset=0)
{
	$title  = "STEP 5 : export to feed table";
	$op     = 'export_feed';

	if ($offset)
	{
		$submit = "GO next $this->_LIMIT feeds";
	}
	else
	{
		$submit = 'GO STEP 5';
	}

	$this->_print_form_next($title, $op, $submit, $offset);

}

function _print_form_next($title, $op, $submit, $offset=0)
{
	echo "<br /><hr />\n";
	echo "<h4>".$title."</h4>\n";

	if ($offset)
	{
		$next = $offset + $this->_LIMIT;
		echo "Exmport ".$offset." - ".$next." th record<br />\n";
	}

// show form
//	$this->_form->show($title, $op, $submit, $offset);

	$limit = 0;
	$desc  = '';
	$action = '';
	$text = $this->_form->build_lib_box_limit_offset($title, $desc, $limit, $offset, $op, $submit, $action);
	echo $text;
}

function check_token()
{
// ******
	return true;

	$ret = $this->_form->check_token();
	return $ret;
}


// --- class end ---
}

//=========================================================
// main
//=========================================================

xoops_cp_header();

weblinks_admin_print_bread( _AM_WEBLINKS_EXPORT_MANAGE, 'export_manage.php', 'rssc' );
echo "<h3>". 'Export to RSSC module' ."</h3>\n";
echo "Export DB weblinks 1.20 to rssc 0.40 <br /><br />\n";

if( WEBLINKS_RSSC_EXIST )
{
// check rssc version
	if ( RSSC_VERSION < WEBLINKS_RSSC_VERSION )
	{
		$msg = sprintf( _WEBLINKS_RSSC_REQUIRE, WEBLINKS_RSSC_VERSION );
		xoops_error( $msg );
		xoops_cp_footer();
		exit();
	}
	else
	{
		$msg = sprintf( _WEBLINKS_RSSC_INSTALLED, WEBLINKS_RSSC_DIRNAME, RSSC_VERSION );
		echo '<h4 style="color: #0000ff;">'.$msg."</h4>\n";
	}
}
else
{
	$msg = sprintf( _WEBLINKS_RSSC_NOT_INSTALLED, WEBLINKS_RSSC_DIRNAME );
	xoops_error( $msg );
	xoops_cp_footer();
	exit();
}

$export =& admin_export_rssc::getInstance();
$op = 'main';
if ( isset($_POST['op']) )  $op = $_POST['op'];

switch ($op) 
{
case "export_site":
	if( !$export->check_token() ) 
	{
		xoops_error("Token Error");
	}
	else
	{
		$export->export_site();
	}
	break;

case "export_black":
	if( !$export->check_token() ) 
	{
		xoops_error("Token Error");
	}
	else
	{
		$export->export_black();
	}
	break;

case "export_white":
	if( !$export->check_token() ) 
	{
		xoops_error("Token Error");
	}
	else
	{
		$export->export_white();
	}
	break;

case "export_link":
	if( !$export->check_token() ) 
	{
		xoops_error("Token Error");
	}
	else
	{
		$export->export_link();
	}
	break;

case "export_feed":
	if( !$export->check_token() ) 
	{
		xoops_error("Token Error");
	}
	else
	{
		$export->export_feed();
	}
	break;

case 'menu':
default:
	$export->menu();
	break;

}

xoops_cp_footer();
exit();

?>