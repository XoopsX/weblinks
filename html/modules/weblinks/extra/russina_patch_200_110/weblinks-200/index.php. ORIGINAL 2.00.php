<?php
// $Id: index.php.\040ORIGINAL\0402.00.php,v 1.1 2012/04/09 10:20:05 ohwada Exp $

// 2009-02-08 K.OHWADA
// Notice [PHP]: Only variables should be assigned by reference

// 2007-11-11 K.OHWADA
// remove config check
// happy_linux_get_memory_usage_mb()

// 2007-09-01 K.OHWADA
// waiting list

// 2007-08-01 K.OHWADA
// weblinks_gmap
// weblinks_map_jp

// 2007-07-14 K.OHWADA
// use_highlight

// 2007-06-10 K.OHWADA
// rssc_view_handler
// cat_sub -> index_cat_sub

// 2007-04-08 K.OHWADA
// change fetch_gm_list()

// 2007-03-25 K.OHWADA
// change get_category_list_by_pid()

// 2007-03-18 wye & K.OHWADA
// google map

// 2007-03-01 K.OHWADA
// assign weblinks_category_navi
// expand subcategories
// happy_linux_time

// 2006-10-14 K.OHWADA
// show execution time

// 2006-10-01 K.OHWADA
// use happy_linux
// use rssc WEBLINKS_RSSC_USE

// 2006-09-24 K.OHWADA
// BUG 4278: cannot set no link list on the top page

// 2006-05-15 K.OHWADA
// new handler

// 2006-03-26 K.OHWADA
// REQ 3807: Description in main page

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication

//================================================================
// WebLinks Module
// 2004/01/14 K.OHWADA
//================================================================

include 'header.php';

include_once WEBLINKS_ROOT_PATH.'/api/waiting.php';

$weblinks_view_handler  =& weblinks_get_handler( 'link_view',  WEBLINKS_DIRNAME );
$weblinks_rssc_handler  =& weblinks_get_handler( 'rssc_view',  WEBLINKS_DIRNAME );
$weblinks_template      =& weblinks_template::getInstance( WEBLINKS_DIRNAME );
$weblinks_header        =& weblinks_header::getInstance(   WEBLINKS_DIRNAME );
$weblinks_gmap          =& weblinks_gmap::getInstance(     WEBLINKS_DIRNAME );
$weblinks_map_jp        =& weblinks_map_jp::getInstance(   WEBLINKS_DIRNAME );

//---------------------------------------------------------
// main
//---------------------------------------------------------
// --- template start ---
// xoopsOption[template_main] should be defined before including header.php
$xoopsOption['template_main'] = WEBLINKS_DIRNAME."_index.html";
include XOOPS_ROOT_PATH.'/header.php';

$conf = $weblinks_view_handler->get_config();
$conf_new_link = $conf['index_new_link'];
$conf_new_rss  = $conf['index_new_rss'];

$weblinks_template->set_keyword_by_request();

//Notice [PHP]: Only variables should be assigned by reference
$keyword_array       =  $weblinks_template->get_keyword_array();

$keywords_urlencoded =  $weblinks_template->get_keywords_urlencode();

$show_gm  = false;
$gm_param = array();

if ( $conf['gm_use'] )
{
	switch( $conf['index_gm_mode'] )
	{
		case 1:
			$show_gm  = true;
			$gm_param = array(
				'gm_latitude'  => $conf['gm_latitude'],
				'gm_longitude' => $conf['gm_longitude'],
				'gm_zoom'      => $conf['gm_zoom'],
				'gm_type'      => 0,
			);
			break;

		case 2:
			$show_gm  = true;
			$gm_param = array(
				'gm_latitude'  => $conf['index_gm_latitude'],
				'gm_longitude' => $conf['index_gm_longitude'],
				'gm_zoom'      => $conf['index_gm_zoom'],
				'gm_type'      => 0,
			);
			break;
	}
}

$weblinks_view_handler->set_highlight( $conf['use_highlight'] );
$weblinks_view_handler->set_keyword_array( $keyword_array );

// Index
$weblinks_header->assign_module_header( true );
$weblinks_template->assignIndex();
$weblinks_template->assignDisplayLink();
$weblinks_template->assignSearch();

// REQ 3807: Description in main page
$weblinks_template->assignHeader( $conf['index_description'] );

$xoopsTpl->assign('keywords',  $keywords_urlencoded);

// --- category list ---
$weblinks_view_handler->init();

$pid          = 0;
$flag_catpath = 0;
$category_list = $weblinks_view_handler->get_category_list_by_pid($pid, $flag_catpath, $conf['index_cat_sub_num'], $conf['index_cat_sub_mode']);

$show_category_navi = false;
$category_navi      = '';
if ( is_array($category_list) && count($category_list) )
{
	$show_category_navi = true;
	$category_navi = $weblinks_template->fetch_category_navi( $category_list, $conf['index_cat_img_mode'], $conf['index_cat_cols'], $keywords_urlencoded );
}

$xoopsTpl->assign('show_category_navi',     $show_category_navi);
$xoopsTpl->assign('weblinks_category_navi', $category_navi);

// --- map jp ---
$show_map_jp = false;
$map_jp      = '';

if ( $conf['map_jp_show_index'] )
{
	$show_map_jp = true;
	$map_jp      = $weblinks_map_jp->fetch_template();
}

$xoopsTpl->assign('show_map_jp',     $show_map_jp );
$xoopsTpl->assign('weblinks_map_jp', $map_jp );

// --- link list ---
$total_link = $weblinks_view_handler->get_link_count_public();
$xoopsTpl->assign('lang_thereare', sprintf(_WLS_THEREARE, $total_link));

// BUG 4278: cannot set no link list on the top page
$show_links_list = false;
$links_list      = '';
$show_gm_list    = false;
$gm_list         = '';

if ($conf_new_link)
{
	if ( $conf['index_mode_latest'] ) {
		$link_list =& $weblinks_view_handler->get_link_list_create( $conf_new_link );
	} else {
		$link_list =& $weblinks_view_handler->get_link_list_latest( $conf_new_link );
	}

	if ( is_array($link_list) && count($link_list) )
	{
		$show_links_list = true;
		$links_list = $weblinks_template->fetch_links_list( $link_list );

// google map
		if ( $show_gm )
		{
			$show_gm_list = true;
			$gm_list = $weblinks_gmap->fetch_list( $link_list, $gm_param, 'weblinks_gm_map_index' );
		}
	}
}

$xoopsTpl->assign('show_links_list',     $show_links_list);
$xoopsTpl->assign('weblinks_links_list', $links_list);

// google map
$xoopsTpl->assign('show_gm_list',     $show_gm_list );
$xoopsTpl->assign('weblinks_gm_list', $gm_list);

// --- atomfeed list ---
$show_new_atomfeed = false;
$show_feeds_list   = false;

if ( WEBLINKS_RSSC_USE && $conf_new_rss )
{
	$show_new_atomfeed = true;
	$weblinks_rssc_handler->set_feed_max_summary(   $conf['rss_max_summary'] );
	$weblinks_rssc_handler->set_feed_highlight(     $conf['use_highlight'] );
	$weblinks_rssc_handler->set_feed_keyword_array( $keyword_array );
	$feed_list = $weblinks_rssc_handler->get_feed_list_latest( $conf_new_rss );

	if ( is_array($feed_list) && count($feed_list) )
	{
		foreach ($feed_list as $feed) 
		{
			$xoopsTpl->append('feeds', $feed);
		}

		$show_feeds_list = true;
	}
}

$xoopsTpl->assign('show_new_atomfeed', $show_new_atomfeed);
$xoopsTpl->assign('show_feeds_list',   $show_feeds_list);

// --- waiting list ---
$show_admin_waiting_list = false;
$show_user_waiting_list  = false;
$show_user_owner_list    = false;
$admin_waiting_list      = null;
$user_waiting_list       = null;
$user_owner_list         = null;

if ( $conf['index_admin_waiting_show'] )
{
	$admin_waiting_list = weblinks_admin_waiting_base( WEBLINKS_DIRNAME );
}

$uid = $weblinks_view_handler->get_system_uid();
if ( $conf['index_user_waiting_num'] && $uid )
{
	$user_waiting_list = weblinks_user_waiting_base( WEBLINKS_DIRNAME, $uid, $conf['index_user_waiting_num'] );
}

if ( $conf['index_user_owner_num'] && $uid )
{
	$user_owner_list = $weblinks_view_handler->get_owner_list_by_uid( $uid, $conf['index_user_owner_num'] );
}

if ( is_array($admin_waiting_list) && count($admin_waiting_list) )
{
	$show_admin_waiting_list = true;
}

if ( is_array($user_waiting_list) && count($user_waiting_list) )
{
	$show_user_waiting_list = true;
}

if ( is_array($user_owner_list) && count($user_owner_list) )
{
	$show_user_owner_list = true;
}

$xoopsTpl->assign('lang_waitings',  _WEBLINKS_PI_WAITING_WAITINGS );
$xoopsTpl->assign('lang_modreqs',   _WEBLINKS_PI_WAITING_MODREQS );
$xoopsTpl->assign('lang_delreqs',   _WEBLINKS_PI_WAITING_DELREQS );
$xoopsTpl->assign('lang_admin_waiting_list', _WEBLINKS_ADMIN_WAITING_LIST );
$xoopsTpl->assign('lang_user_waiting_list',  _WEBLINKS_USER_WAITING_LIST );
$xoopsTpl->assign('lang_user_owner_list',    _WEBLINKS_USER_OWNER_LIST );
$xoopsTpl->assign('lang_warn_time_publish',  _WEBLINKS_WARN_TIME_PUBLISH );
$xoopsTpl->assign('lang_warn_time_expire',   _WEBLINKS_WARN_TIME_EXPIRE );
$xoopsTpl->assign('lang_warn_broken',        _WEBLINKS_WARN_BROKEN );
$xoopsTpl->assign('show_admin_waiting_list', $show_admin_waiting_list);
$xoopsTpl->assign('admin_waiting_list',      $admin_waiting_list);
$xoopsTpl->assign('show_user_waiting_list',  $show_user_waiting_list);
$xoopsTpl->assign('user_waiting_list',       $user_waiting_list);
$xoopsTpl->assign('show_user_owner_list',    $show_user_owner_list);
$xoopsTpl->assign('user_owner_list',         $user_owner_list);

$xoopsTpl->assign('happy_linux_url', get_happy_linux_url() );
$xoopsTpl->assign('execution_time',  happy_linux_get_execution_time() );
$xoopsTpl->assign('memory_usage',    happy_linux_get_memory_usage_mb() );
include XOOPS_ROOT_PATH.'/footer.php';
exit();
// --- main end ---

?>