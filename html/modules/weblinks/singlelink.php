<?php
// $Id: singlelink.php,v 1.1 2011/12/29 14:32:31 ohwada Exp $

// 2010-01-24 K.OHWADA
// Notice [PHP]: Only variables should be assigned by reference

// 2007-11-01 K.OHWADA
// happy_linux_get_memory_usage_mb()

// 2007-09-01 K.OHWADA
// REQ 4359: countup hits in singlelink.php
// REQ 4514: user can view his link before time_publish

// 2007-08-01 K.OHWADA
// weblinks_gmap

// 2007-07-14 K.OHWADA
// use_highlight

// 2007-06-10 K.OHWADA
// header_oh.php
// d3forum_comment

// 2007-03-25 K.OHWADA
// get_link_album_photos_by_lid

// 2007-03-18 K.OHWADA
// fetch_gm_single

// 2007-03-01 K.OHWADA
// assign weblinks_forum_list
// weblinks_plugin.php

// 2006-12-10 K.OHWADA
// use time_publish time_expire

// 2006-11-04 K.OHWADA
// use lang_js_invalid

// 2006-10-01 K.OHWADA
// use happy_linux
// use rssc
// highlight_keyword
// google map

// 2006-05-15 K.OHWADA
// move function to class/singlelink.php
// use new handler

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication

//================================================================
// WebLinks Module
// view single link information
// 2004/01/14 K.OHWADA
//================================================================

include 'header_oh.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_singlelink.php';

$weblinks_singlelink =& weblinks_singlelink::getInstance( WEBLINKS_DIRNAME );
$weblinks_template   =& weblinks_template::getInstance(   WEBLINKS_DIRNAME );
$weblinks_header     =& weblinks_header::getInstance(     WEBLINKS_DIRNAME );
$weblinks_gmap       =& weblinks_gmap::getInstance(       WEBLINKS_DIRNAME );

// BUG 2932: dont work correctly when register_long_arrays = off
$lid = $weblinks_singlelink->get_get_lid();

$conf =& $weblinks_singlelink->get_conf();
$is_module_admin = $weblinks_singlelink->is_module_admin();

$weblinks_template->set_keyword_by_request();

// Notice [PHP]: Only variables should be assigned by reference 
$keyword_array       =  $weblinks_template->get_keyword_array();

$keywords_urlencoded =  $weblinks_template->get_keywords_urlencode();

$weblinks_singlelink->set_highlight( $conf['use_highlight'] );
$weblinks_singlelink->set_keyword_array( $keyword_array );

// link
$link_show =& $weblinks_singlelink->get_link($lid);
if ( !$link_show )
{
	redirect_header('index.php', 3, _WLS_NOMATCH);
	exit();
}

// user can view his link before time_publish
if ( !$is_module_admin &&
     !$link_show['is_owner'] &&
    ( $link_show['warn_time_publish'] || $link_show['warn_time_expire'] ) )
{
	redirect_header('index.php', 3, _WLS_NOMATCH);
	exit();
}

$title_s     = $link_show['title'];
$comment_use = $link_show['comment_use'];

// --- template start ---
// xoopsOption[template_main] should be defined before including header.php
$xoopsOption['template_main'] = WEBLINKS_DIRNAME."_singlelink.html";
include XOOPS_ROOT_PATH.'/header.php';

// REQ 4359: countup hits in singlelink.php
if ( $conf['use_hits_singlelink'] )
{
	$weblinks_singlelink->countup_hits($lid);
}

// index
$weblinks_header->assign_module_header( true );
$weblinks_template->assignPageTitle( $title_s, false );
$weblinks_template->assignIndex();
$weblinks_template->assignHeader();
$weblinks_template->assignSearch();

$xoopsTpl->assign('link',     $link_show);
$xoopsTpl->assign('keywords', $keywords_urlencoded);

// warning
$xoopsTpl->assign('lang_warn_time_publish', _WEBLINKS_WARN_TIME_PUBLISH);
$xoopsTpl->assign('lang_warn_time_expire',  _WEBLINKS_WARN_TIME_EXPIRE);
$xoopsTpl->assign('lang_warn_broken',       _WEBLINKS_WARN_BROKEN);
$xoopsTpl->assign('lang_broken_counter',    _WLS_BROKEN_COUNTER);

$weblinks_template->assignDisplayLink();

$catpath_arr =& $weblinks_singlelink->get_catpath_arr($lid);
foreach ($catpath_arr as $catpath)
{
	$xoopsTpl->append('catpaths', $catpath);
}

$single = $weblinks_template->fetch_link_single( $link_show );
$xoopsTpl->assign('weblinks_link_single', $single);

// google map: hacked by wye
$gm_single = $weblinks_gmap->fetch_single( $link_show );
$xoopsTpl->assign('show_gm_single',     $link_show['flag_gm_use'] );
$xoopsTpl->assign('weblinks_gm_single', $gm_single);

// atomfeed
$atomfeed = $weblinks_singlelink->get_atomfeed( $lid );

$xoopsTpl->assign('rss_num_content', $atomfeed['rss_num']  );
$xoopsTpl->assign('rss_flag',        $atomfeed['rss_flag'] );
$xoopsTpl->assign('rss_url',         $atomfeed['rss_url']  );
$xoopsTpl->assign('rss_update',      $atomfeed['rss_update'] );
$xoopsTpl->assign('rss_show',        $atomfeed['rss_show'] );

if ( is_array($atomfeed['feeds']) && count($atomfeed['feeds']) )
{
	foreach ($atomfeed['feeds'] as $feed)
	{
		$xoopsTpl->append('feeds', $feed);
	}
}

// forum
$show_forum_list     = false;
$weblinks_forum_list = '';

$threads =& $weblinks_singlelink->get_link_forum_threads_by_lid($lid);
if ( is_array($threads) && count($threads) )
{
	$show_forum_list     = true;
	$weblinks_forum_list = $weblinks_template->fetch_forum_list( $threads );
}

$xoopsTpl->assign('show_forum_list',     $show_forum_list);
$xoopsTpl->assign('weblinks_forum_list', $weblinks_forum_list);
$xoopsTpl->assign('lang_latest_forum',   _WEBLINKS_LATEST_FORUM);

// album
$show_photo_list    = false;
$photo_list         = '';

$photos =& $weblinks_singlelink->get_link_album_photos_by_lid($lid);
if ( is_array($photos) && count($photos) )
{
	$show_photo_list = true;
	$photo_list      = $weblinks_template->fetch_photo_list( $photos );
}

$xoopsTpl->assign('weblinks_photo_list',    $photo_list );
$xoopsTpl->assign('show_photo_list',        $show_photo_list );

// d3forum_comment
$xoopsTpl->assign('d3forum_comment',  $weblinks_template->fetch_d3forum_comment( $lid, $title_s ) );

$xoopsTpl->assign('show_comment', $comment_use);
include XOOPS_ROOT_PATH.'/include/comment_view.php';

$xoopsTpl->assign('execution_time', happy_linux_get_execution_time() );
$xoopsTpl->assign('memory_usage',   happy_linux_get_memory_usage_mb() );
include XOOPS_ROOT_PATH.'/footer.php';
exit();
// --- main end ---

?>