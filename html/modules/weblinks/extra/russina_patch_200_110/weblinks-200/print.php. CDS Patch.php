<?php
// $Id: print.php.\040CDS\040Patch.php,v 1.1 2012/04/09 10:20:05 ohwada Exp $

// 2007-09-20 K.OHWADA
// BUG: Undefined index: flag_time_publish

// 2007-06-01 K.OHWADA
// header_oh.php

// 2006-12-10 K.OHWADA
// use time_publish time_expire

// 2006-10-30 K.OHWADA
// BUG 4349: IE cannot show google map

// 2006-10-14 K.OHWADA
// google map

// 2006-09-20 K.OHWADA
// use happy_linux
// use rssc

// 2006-05-15 K.OHWADA
// this is new file
// use class weblinks_singlelink

//================================================================
// WebLinks Module
// 2006-05-15 K.OHWADA
//================================================================

include 'header_oh.php';
include_once XOOPS_ROOT_PATH.'/class/template.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_singlelink.php';

$weblinks_singlelink =& weblinks_singlelink::getInstance( WEBLINKS_DIRNAME );
$weblinks_template   =& weblinks_template::getInstance(   WEBLINKS_DIRNAME );

$lid = $weblinks_singlelink->get_get_lid();

// link
$link_show =& $weblinks_singlelink->get_link($lid);
if ( !$link_show )
{
	redirect_header("index.php", 2, _WLS_NOMATCH);
	exit();
}

// BUG: Undefined index: flag_time_publish
if ( $link_show['warn_time_publish'] || $link_show['warn_time_expire'] )
{
	redirect_header('index.php', 2, _WLS_NOMATCH);
	exit();
}

$site_name   = $weblinks_singlelink->get_site_name();
$module_name = $weblinks_singlelink->get_module_name();
$title_s     = $link_show['title'];

// template
$WEBLINK_TEMPLATE_NAME = "db:".WEBLINKS_DIRNAME."_print.html";
/* CDS Patch. Weblinks. 2.00. 2. BOF */
include $GLOBALS['xoops']->path('header.php');
//$xoopsTpl = new XoopsTpl();
/* CDS Patch. Weblinks. 2.00. 2. EOF */

// index
$weblinks_template->assignPageTitle( $title_s, false );

$xoopsTpl->assign('xoops_sitename',  $site_name);
$xoopsTpl->assign('module_name',     $module_name);

// google map
$conf =& $weblinks_singlelink->get_conf();

// BUG 4349: IE cannot show google map
$xoopsTpl->assign('gm_use',    $link_show['flag_gm_use'] );
$xoopsTpl->assign('gm_server', $conf['gm_server'] );
$xoopsTpl->assign('gm_apikey', $conf['gm_apikey'] );

$catpath_arr =& $weblinks_singlelink->get_catpath_arr($lid);
foreach ($catpath_arr as $catpath)
{
	$xoopsTpl->append('catpaths', $catpath);
}

$weblinks_template->_assign_link_common( $xoopsTpl );
$xoopsTpl->assign('link', $link_show);

// atomfeed
$atomfeed = $weblinks_singlelink->get_atomfeed( $lid );

$xoopsTpl->assign('rss_num_content', $atomfeed['rss_num']  );
$xoopsTpl->assign('rss_flag',        $atomfeed['rss_flag'] );
$xoopsTpl->assign('rss_url',         $atomfeed['rss_url']  );
$xoopsTpl->assign('rss_update',      $atomfeed['rss_update'] );
$xoopsTpl->assign('rss_show',        $atomfeed['rss_show'] );

if ( is_array($atomfeed['feeds']) && ( count($atomfeed['feeds']) > 0 ))
{
	foreach ($atomfeed['feeds'] as $feed)
	{
		$xoopsTpl->append('feeds', $feed);
	}
}

$xoopsTpl->display( $WEBLINK_TEMPLATE_NAME );

?>