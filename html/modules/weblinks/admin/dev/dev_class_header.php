<?php
// $Id: dev_class_header.php,v 1.1 2011/12/29 14:32:58 ohwada Exp $

// 2008-02-17 K.OHWADA
// server.php -> browser.php

// 2007-10-30 K.OHWADA
// weblinks_auth

// 2007-09-20 K.OHWADA
// weblinks_link_bin_handler.php

// 2007-09-01 K.OHWADA
// remove weblinks_mailer.php

// 2007-06-01 K.OHWADA
// api/rss_parser.php

// 2007-02-20 K.OHWADA
// functions.php

//=========================================================
// WebLinks Module
// 2006-12-10 K.OHWADA
//=========================================================

if( !defined('WEBLINKS_ROOT_PATH') )
{	exit();	}

// --- system files ---
include_once XOOPS_ROOT_PATH.'/class/xoopstree.php';

//---------------------------------------------------------
// happy_linux
//---------------------------------------------------------
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/version.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/functions.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/search.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/gtickets.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/api/language.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/api/rss_parser.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/api/rss_viewer.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/language.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/post.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/dir.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/image_size.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/remote_image.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/pagenavi.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/search.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/html.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/form.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/form_lib.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/pagenavi.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/page_frame.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/manage.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/object.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/object_validater.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/object_handler.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/config_define_handler.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/browser.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/file.php';

//---------------------------------------------------------
// weblinks
//---------------------------------------------------------
// include files
include_once WEBLINKS_ROOT_PATH.'/include/weblinks_version.php';
include_once WEBLINKS_ROOT_PATH.'/include/weblinks_constant.php';
include_once WEBLINKS_ROOT_PATH.'/include/functions.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_menu.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_config2_basic_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_bin_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_basic_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_category_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_catlink_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_banner_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_auth.php';

global $xoopsConfig;
$XOOPS_LANGUAGE = $xoopsConfig['language'];

// for system user.php
if (file_exists( XOOPS_ROOT_PATH.'/language/'.$XOOPS_LANGUAGE.'/user.php' )) 
{
	include_once XOOPS_ROOT_PATH.'/language/'.$XOOPS_LANGUAGE.'/user.php';
}
else
{
	include_once XOOPS_ROOT_PATH.'/language/english/user.php';
}

// for main.php
if (file_exists( WEBLINKS_ROOT_PATH.'/language/'.$XOOPS_LANGUAGE.'/main.php' )) 
{
	include_once WEBLINKS_ROOT_PATH.'/language/'.$XOOPS_LANGUAGE.'/main.php';
}
else
{
	include_once WEBLINKS_ROOT_PATH.'/language/english/main.php';
}

// for modinfo.php
if (file_exists( WEBLINKS_ROOT_PATH.'/language/'.$XOOPS_LANGUAGE.'/modinfo.php' )) 
{
	include_once WEBLINKS_ROOT_PATH.'/language/'.$XOOPS_LANGUAGE.'/modinfo.php';
}
else
{
	include_once WEBLINKS_ROOT_PATH.'/language/english/main.php';
}

// compatible to old version
include_once WEBLINKS_ROOT_PATH.'/language/compatible.php';

//include_once WEBLINKS_ROOT_PATH.'/admin/admin_functions.php';

//---------------------------------------------------------
// locate
//---------------------------------------------------------
$weblinks_config_handler =& weblinks_get_handler( 'config2_basic', WEBLINKS_DIRNAME );
$weblinks_config_handler->init();
$country_code = $weblinks_config_handler->get_conf_by_name( 'country_code' );
$rss_dirname  = $weblinks_config_handler->get_conf_by_name( 'rss_dirname' );
$rss_use      = $weblinks_config_handler->get_conf_by_name( 'rss_use' );

include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/locate.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_locate.php';

//---------------------------------------------------------
// rssc
//---------------------------------------------------------
if( !defined('WEBLINKS_RSSC_DIRNAME') )
{
	define('WEBLINKS_RSSC_DIRNAME', $rss_dirname);
}

if( !defined('WEBLINKS_RSSC_ROOT_PATH') )
{
	define('WEBLINKS_RSSC_ROOT_PATH', XOOPS_ROOT_PATH.'/modules/'.WEBLINKS_RSSC_DIRNAME);
}

if( !defined('WEBLINKS_RSSC_URL') )
{
	define('WEBLINKS_RSSC_URL', XOOPS_URL.'/modules/'.WEBLINKS_RSSC_DIRNAME);
}

// rssc module install check
$module_handler =& xoops_gethandler('module');
$module =& $module_handler->getByDirname( WEBLINKS_RSSC_DIRNAME );
if ( is_object($module) )
{
	define('WEBLINKS_RSSC_EXIST', 1);
	if( $rss_use )
	{
		define('WEBLINKS_RSSC_USE', 1);
	}
}

if( defined('WEBLINKS_RSSC_EXIST') && WEBLINKS_RSSC_EXIST )
{
	include_once WEBLINKS_RSSC_ROOT_PATH.'/include/rssc_version.php';
	include_once WEBLINKS_RSSC_ROOT_PATH.'/api/view.php';
	include_once WEBLINKS_RSSC_ROOT_PATH.'/api/refresh.php';
	include_once WEBLINKS_RSSC_ROOT_PATH.'/class/rssc_error.php';
	include_once WEBLINKS_RSSC_ROOT_PATH.'/class/rssc_link_handler.php';
	include_once WEBLINKS_RSSC_ROOT_PATH.'/class/rssc_feed_handler.php';

// main.php
	if ( file_exists(WEBLINKS_RSSC_ROOT_PATH.'/language/'.$XOOPS_LANGUAGE.'/main.php') ) 
	{
		include_once WEBLINKS_RSSC_ROOT_PATH.'/language/'.$XOOPS_LANGUAGE.'/main.php';
	}
	else
	{
		include_once WEBLINKS_RSSC_ROOT_PATH.'/language/english/main.php';
	}

	include_once WEBLINKS_RSSC_ROOT_PATH.'/language/compatible.php';
}
else
{
	define('WEBLINKS_RSSC_EXIST', 0);
}

if( !defined('WEBLINKS_RSSC_USE') )
{
	define('WEBLINKS_RSSC_USE', 0);
}

include_once WEBLINKS_ROOT_PATH.'/class/weblinks_rssc_handler.php';

?>