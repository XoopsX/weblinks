<?php
// $Id: link_list.php,v 1.2 2012/04/09 10:20:04 ohwada Exp $

// 2012-04-02 K.OHWADA
// link_geocoding.php
// link_csv.php

// 2007-11-11 K.OHWADA
// set_config_google_server()
// set_flag_execute_time()

// 2007-09-01 K.OHWADA
// sortid:7 _AM_WEBLINKS_LINK_USERCOMMENT_DESC
// _get_op_sortid_array()

// 2007-03-17 K.OHWADA
// BUG 4506: expired links not listed

// 2007-02-20 K.OHWADA
// hack for multi site

// 2006-12-10 K.OHWADA
// use time_publish time_expire

// 2006-10-05 K.OHWADA
// use happy_linux

// 2006-05-15 K.OHWADA
// new handler
// add class admin_link_list

// 2006-03-15 K.OHWADA
// use weblinks_pagenavi_basic::getInstance()

// 2006-01-06 K.OHWADA
// weblinks ver 1.0
// module depulication

//================================================================
// WebLinks Module
// view link list 
// 2004-12-14 K.OHWADA
//================================================================

include 'admin_header.php';
include 'admin_header_list.php';

//=========================================================
// class admin_link_list
//=========================================================
class admin_link_list extends happy_linux_page_frame
{
	var $_modify_handler;
	var $_broken_handler;
	var $_strings;
	var $_locate;

	var $_conf;

	var $_count_all;
	var $_count_non_url;
	var $_count_rss_flag;
	var $_count_broken;
	var $_count_time_publish_before;
	var $_count_time_expire_after;
	var $_count_usercomment;
	
// hack for multi site
	var $_flag_show_etc1 = false;
	var $_flag_show_etc2 = false;

	var $_MAX_USERCOMMENT = 50;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_link_list()
{
	$this->happy_linux_page_frame();
	$this->set_handler('link', WEBLINKS_DIRNAME, 'weblinks');
	$this->set_id_name('lid');
	$this->set_max_sortid(8);
	$this->set_lang_no_item( _WEBLINKS_NO_LINK );
	$this->set_flag_execute_time( true );

	$config_handler        =& weblinks_get_handler( 'config2_basic', WEBLINKS_DIRNAME );
	$this->_modify_handler =& weblinks_get_handler( 'modify',        WEBLINKS_DIRNAME );
	$this->_broken_handler =& weblinks_get_handler( 'broken',        WEBLINKS_DIRNAME );

	$this->_strings    =& happy_linux_strings::getInstance();
	$this->_locate     =& weblinks_locate_factory::getInstance( WEBLINKS_DIRNAME );

// hack for multi site
	if ( weblinks_multi_is_japanese_site() )
	{
		$this->_flag_show_etc1 = true;
	}

	$this->_conf =& $config_handler->get_conf();
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_link_list();
	}
	return $instance;
}

//---------------------------------------------------------
// init
//---------------------------------------------------------
function _init()
{
	$this->_locate->weblinks_init();
	$this->_locate->set_config_google_server( $this->_conf['google_server'] );
}

//---------------------------------------------------------
// handler
//---------------------------------------------------------
function &_get_op_sortid_array()
{
	$arr = array(
		'list_asc'     => 0,
		'list_desc'    => 1,
		'list_broken'  => 2,
		'list_non'     => 3,
		'list_rss'     => 4,
		'list_publish' => 5,
		'list_expire'  => 6,
		'list_comment' => 7,
	);
	return $arr;
}

function &_get_table_header()
{
	$arr = array(
		_WLS_LINKID,
		_WLS_SITETITLE,
		_WLS_SITEURL,
	);

	if ( $this->_flag_show_etc1 )
	{
		array_push( $arr, _WEBLINKS_ETC.' 1' );
	}

	if ( $this->_flag_show_etc2 )
	{
		array_push( $arr, _WEBLINKS_ETC.' 2' );
	}

	if ($this->_sortid == 2)
	{
		array_push( $arr, _WEBLINKS_COUNT_BROKEN );
	}

	if ($this->_sortid == 7)
	{
		array_push( $arr, _WLS_USER_COMMENT );
	}

	return $arr;
}

function _get_total()
{
	$this->_count_all      = $this->_get_total_all();
	$this->_count_non_url  = $this->_handler->get_count_non_url();
	$this->_count_rss_flag = $this->_handler->get_count_rss_flag( false );
	$this->_count_broken   = $this->_handler->get_count_broken();
	$this->_count_time_publish_before = $this->_handler->get_count_time_publish_before();
	$this->_count_time_expire_after   = $this->_handler->get_count_time_expire_after();
	$this->_count_usercomment         = $this->_handler->get_count_usercomment();

	switch ($this->_sortid)
	{
		case 1:
			$total = $this->_count_all;
			break;

		case 2:
			$total = $this->_count_broken;
			break;

		case 3:
			$total = $this->_count_non_url;
			break;

		case 4:
			$total = $this->_count_rss_flag;
			break;

		case 5:
			$total = $this->_count_time_publish_before;
			break;

		case 6:
// BUG 4506: expired links not listed
			$total = $this->_count_time_expire_after;
			break;

		case 7:
			$total = $this->_count_usercomment;
			break;

		case 0:
		default:
			$total = $this->_count_all;
			break;
	}

	return $total;
}

function &_get_items($limit=0, $start=0)
{
	switch ($this->_sortid)
	{
		case 1:
			$objs =& $this->_handler->get_objects_desc($limit, $start);
			break;

		case 2:
			$objs =& $this->_handler->get_objects_broken($limit, $start);
			break;

		case 3:
			$objs =& $this->_handler->get_objects_non_url($limit, $start);
			break;

		case 4:
			$objs =& $this->_handler->get_objects_rss_flag($limit, $start);
			break;

		case 5:
			$objs =& $this->_handler->get_objects_time_publish_before($limit, $start);
			break;

		case 6:
			$objs =& $this->_handler->get_objects_time_expire_after($limit, $start);
			break;

		case 7:
			$objs =& $this->_handler->get_objects_usercomment_desc($limit, $start);
			break;

		case 0:
		default:
			$objs =& $this->_handler->get_objects_all($limit, $start);
			break;
	}

	return $objs;
}

function &_get_cols(&$obj)
{
	$lid     = $obj->getVar('lid',    'n');
	$broken  = $obj->getVar('broken', 'n');
	$title   = $obj->getVar('title',  'n');
	$title_s = $obj->getVar('title',  's');
	$url     = $obj->getVar('url',    'n');
	$url_s   = $obj->getVar('url',    's');
	$etc1_s  = $obj->getVar('etc1',   's');
	$etc2_s  = $obj->getVar('etc2',   's');

	$usercomment_short   = $obj->usercomment_short( $this->_MAX_USERCOMMENT );
	$usercomment_short_s = $this->sanitize_text( $usercomment_short );

	$jump_link  = 'link_manage.php?op=mod_form&lid=';
	$link_link  = $this->_build_page_id_link_by_obj( $obj, 'lid', $jump_link);
	$url_view_lid = WEBLINKS_URL."/singlelink.php?lid=".$lid;
	$url_text_gif = WEBLINKS_URL."/images/text.gif";

	$google_url = $this->_locate->weblinks_build_google_search_url($title);
	$link_title = $this->build_html_a_href_name($google_url, $title_s, '_blank');

	$link_url  = $this->build_html_a_href_name($url, $url_s, '_blank');
	$img_link  = $this->build_html_img_tag($url_text_gif, 0, 0, 0, 'link');
	$view_link = $this->build_html_a_href_name($url_view_lid, $img_link, '', false);

	$arr = array(
		$view_link.'&nbsp;&nbsp;'.$link_link,
		$link_title,
		$link_url,
	);

	if ( $this->_flag_show_etc1 )
	{
		array_push( $arr, $etc1_s );
	}

	if ( $this->_flag_show_etc2 )
	{
		array_push( $arr, $etc2_s );
	}

	if ($this->_sortid == 2)
	{
		array_push( $arr, $broken );
	}

	if ($this->_sortid == 7)
	{
		array_push( $arr, $usercomment_short_s );
	}

	return $arr;
}

//---------------------------------------------------------
// print
//---------------------------------------------------------
function _print_top()
{
	$total_broken = $this->build_html_highlight_number($this->_count_broken);
	$total_time_publish_before = $this->build_html_highlight_number($this->_count_time_publish_before, 0, '#0000ff', '', 'bold' );
	$total_time_expire_after   = $this->build_html_highlight_number($this->_count_time_expire_after,   0, '#0000ff', '', 'bold' );

	switch ($this->_sortid)
	{
		case 1:
			$title = _WEBLINKS_ADMIN_LINK_ALL_DESC;
			break;

		case 2:
			$title = _WEBLINKS_ADMIN_LINK_BROKEN;
			break;

		case 3:
			$title = _WEBLINKS_ADMIN_LINK_NOURL;
			break;

		case 4:
			$title = _WLS_SITE_RSS;
			break;

		case 5:
			$title = _AM_WEBLINKS_LINK_TIME_PUBLISH_BEFORE;
			break;

		case 6:
			$title = _AM_WEBLINKS_LINK_TIME_EXPIRE_AFTER;
			break;

		case 7:
			$title = _AM_WEBLINKS_LINK_USERCOMMENT_DESC;
			break;

		case 0:
		default:
			$title = _WEBLINKS_ADMIN_LINK_ALL_ASC;
			break;
	}

	echo "<h4>"._WEBLINKS_ADMIN_LINK_LIST."</h4>\n";
	printf(_WLS_THEREARE, $this->_count_all);
	echo "<br /><br />\n";

	echo "<table width='80%' border='0' cellspacing='1' class='outer'>";
	echo "<tr class='odd'><td><ul>";
	echo "<li><a href='link_list.php?sortid=0'>"._WEBLINKS_ADMIN_LINK_ALL_ASC."</a> ($this->_count_all) </li>\n";
	echo "<li><a href='link_list.php?sortid=1'>"._WEBLINKS_ADMIN_LINK_ALL_DESC."</a> ($this->_count_all) </li>\n";
	echo "<li><a href='link_list.php?sortid=2'>"._WEBLINKS_ADMIN_LINK_BROKEN."</a> ($total_broken) </li>\n";
	echo "<li><a href='link_list.php?sortid=3'>"._WEBLINKS_ADMIN_LINK_NOURL."</a> ($this->_count_non_url) </li>\n";
	echo "<li><a href='link_list.php?sortid=4'>"._WLS_SITE_RSS."</a> ($this->_count_rss_flag) </li>\n";
	echo "<li><a href='link_list.php?sortid=5'>"._AM_WEBLINKS_LINK_TIME_PUBLISH_BEFORE."</a> ($total_time_publish_before) </li>\n";
	echo "<li><a href='link_list.php?sortid=6'>"._AM_WEBLINKS_LINK_TIME_EXPIRE_AFTER."</a> ($total_time_expire_after) </li>\n";
	echo "<li><a href='link_list.php?sortid=7'>"._AM_WEBLINKS_LINK_USERCOMMENT_DESC."</a> ($this->_count_usercomment) </li>\n";
	echo "<li><a href='link_geocoding.php'>"._AM_WEBLINKS_TITLE_LINK_GEOCODING.'</a> ('. _AM_WEBLINKS_GEO_ADD .") </li>\n";
	echo"</ul></td></tr>\n";

	echo"<tr><td>\n";
	echo "<a href='link_csv.php'>";
	echo "<span class='font-size:120%'>";
	echo _AM_WEBLINKS_TITLE_LINK_CSV
	echo "</span></a>\n";
	echo"</td></tr></table>\n";

	echo "<h4>".$title."</h4>\n";
	echo _WEBLINKS_ADMIN_LINK_BROKEN_CHECK_NOTICE;
	echo _WEBLINKS_ADMIN_LINK_BROKEN_CHECK_GOOGLE."<br />\n";
	echo "<br />\n";
}

// --- class end ---
}


//=========================================================
// main
//=========================================================
xoops_cp_header();

weblinks_admin_print_header();
weblinks_admin_print_menu();

$list =& admin_link_list::getInstance();
$list->_show();

xoops_cp_footer();
exit();
// --- end of main ---

?>