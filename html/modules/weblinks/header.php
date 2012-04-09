<?php
// $Id: header.php,v 1.2 2012/04/09 10:20:04 ohwada Exp $

// 2012-04-02 K.OHWADA
// weblinks_webmap.php

// 2008-02-17 K.OHWADA
// weblinks_htmlout.php
// weblinks_link_view_basic.php

// 2008-02-16 K.OHWADA
// check happy_linux version in the beginning

// 2007-11-11 K.OHWADA
// weblinks_auth
// weblinks_cat_view_handler
// linkitem_handler->init()
// api/locate.php

// 2007-09-20 K.OHWADA
// weblinks_link_bin_hander.php
// dir.php

// 2007-08-01 K.OHWADA
// weblinks_gmap
// weblinks_map_jp

// 2007-06-01 K.OHWADA
// api/view.php api/refresh.php
// weblinks_link_catlink_basic_handler.php

// 2007-05-06 K.OHWADA
// 4564: Fatal error, when set rssc_use if not exist RSSC module
// rssc module exists check

// 2007-03-25 K.OHWADA
// album_sel.php

// 2007-03-01 K.OHWADA
// happy_linux_time.php
// weblinks_category_basic_handler
// weblinks_link_basic_handler

// 2006-12-10 K.OHWADA
// use object_validater.php
// use weblinks_banner_handler.php

// 2006-10-05 K.OHWADA
// use happy_linux
// config init in here

// 2006-05-15 K.OHWADA
// new handler
// use constant WEBLINKS_ROOT_PATH

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication

//================================================================
// WebLinks Module
// use weblinks_link_basic_handler
// 2004/01/23 K.OHWADA
//================================================================

//---------------------------------------------------------
// system
//---------------------------------------------------------
include '../../mainfile.php';

include_once XOOPS_ROOT_PATH.'/class/xoopstree.php';
include_once XOOPS_ROOT_PATH.'/class/snoopy.php';

//---------------------------------------------------------
// weblinks constant
//---------------------------------------------------------
if( !defined('WEBLINKS_DIRNAME') )
{
	define('WEBLINKS_DIRNAME', $xoopsModule->dirname() );
}

if( !defined('WEBLINKS_ROOT_PATH') )
{
	define('WEBLINKS_ROOT_PATH', XOOPS_ROOT_PATH.'/modules/'.WEBLINKS_DIRNAME );
}

if( !defined('WEBLINKS_URL') )
{
	define('WEBLINKS_URL', XOOPS_URL.'/modules/'.WEBLINKS_DIRNAME );
}

include_once WEBLINKS_ROOT_PATH.'/include/weblinks_version.php';
include_once WEBLINKS_ROOT_PATH.'/include/weblinks_constant.php';

//---------------------------------------------------------
// happy_linux
//---------------------------------------------------------
if ( !file_exists(XOOPS_ROOT_PATH.'/modules/happy_linux/include/version.php') ) 
{
	include XOOPS_ROOT_PATH.'/header.php';
	xoops_error( 'require happy_linux module' );
	include XOOPS_ROOT_PATH.'/footer.php';
	exit();
}

include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/version.php';

// check happy_linux version
if ( HAPPY_LINUX_VERSION < WEBLINKS_HAPPY_LINUX_VERSION ) 
{
	$msg = 'require happy_linux module v'.WEBLINKS_HAPPY_LINUX_VERSION.' or later';
	include XOOPS_ROOT_PATH.'/header.php';
	xoops_error( $msg );
	include XOOPS_ROOT_PATH.'/footer.php';
	exit();
}

// start execution time
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/time.php';
$happy_linux_time =& happy_linux_time::getInstance( true );
if ( WEBLINKS_DEBUG_TIME )
{
	$happy_linux_time->print_lap_time();
}

include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/functions.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/search.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/memory.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/api/language.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/api/local.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/api/locate.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/error.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/strings.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/highlight.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/post.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/system.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/dir.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/image_size.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/remote_file.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/remote_image.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/html.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/form.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/form_lib.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/pagenavi.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/keyword.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/search.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/basic_handler.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/plugin.php';

//---------------------------------------------------------
// weblinks
//---------------------------------------------------------
$XOOPS_LANGUAGE   = $xoopsConfig['language'];

// include file
include_once WEBLINKS_ROOT_PATH.'/include/functions.php';
include_once WEBLINKS_ROOT_PATH.'/plugins/forum_sel.php';
include_once WEBLINKS_ROOT_PATH.'/plugins/album_sel.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_menu.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_template.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_block_view.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_block_webmap.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_webmap.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_config2_basic_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_linkitem_basic_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_category_basic_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_bin_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_basic_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_catlink_basic_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_catlink_basic_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_count_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_cat_view_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_view_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_view_basic.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_view.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_banner_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_auth.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_plugin.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_header.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_map_jp.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_htmlout.php';
include_once WEBLINKS_ROOT_PATH.'/htmlout/weblinks_htmlout_base.php';

// search.php
if ( file_exists(XOOPS_ROOT_PATH.'/language/'.$XOOPS_LANGUAGE.'/search.php') ) 
{
	include_once XOOPS_ROOT_PATH.'/language/'.$XOOPS_LANGUAGE.'/search.php';
}
else
{
	include_once XOOPS_ROOT_PATH.'/language/english/search.php';
}

// user.php
if ( file_exists(XOOPS_ROOT_PATH.'/language/'.$XOOPS_LANGUAGE.'/user.php') ) 
{
	include_once XOOPS_ROOT_PATH.'/language/'.$XOOPS_LANGUAGE.'/user.php';
}
else
{
	include_once XOOPS_ROOT_PATH.'/language/english/user.php';
}

if ( file_exists(WEBLINKS_ROOT_PATH.'/language/'.$XOOPS_LANGUAGE.'/map_jp.php') ) 
{
	include_once WEBLINKS_ROOT_PATH.'/language/'.$XOOPS_LANGUAGE.'/map_jp.php';
}
else
{
	include_once WEBLINKS_ROOT_PATH.'/language/english/map_jp.php';
}

// compatible to old version
include_once WEBLINKS_ROOT_PATH.'/language/compatible.php';



//---------------------------------------------------------
// config
//---------------------------------------------------------
$weblinks_config_handler =& weblinks_get_handler( 'config2_basic', WEBLINKS_DIRNAME );
$weblinks_config_handler->init();
$rss_dirname  = $weblinks_config_handler->get_conf_by_name( 'rss_dirname' );
$rss_use      = $weblinks_config_handler->get_conf_by_name( 'rss_use' );

//---------------------------------------------------------
// linkitem
//---------------------------------------------------------
$weblinks_linkitem_handler =& weblinks_get_handler( 'linkitem_basic', WEBLINKS_DIRNAME );
$weblinks_linkitem_handler->init();

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
// rssc module exists check, if missed to remove files
	if ( file_exists(WEBLINKS_RSSC_ROOT_PATH.'/include/rssc_version.php') ) 
	{
		include_once WEBLINKS_RSSC_ROOT_PATH.'/include/rssc_version.php';

		define('WEBLINKS_RSSC_EXIST', 1);
		if( $rss_use )
		{
			define('WEBLINKS_RSSC_USE', 1);
		}
	}
}

if( !defined('WEBLINKS_RSSC_EXIST') )
{
	define('WEBLINKS_RSSC_EXIST', 0);
}

if( !defined('WEBLINKS_RSSC_USE') )
{
	define('WEBLINKS_RSSC_USE', 0);
}

// check rssc version
if ( WEBLINKS_RSSC_USE && ( RSSC_VERSION < WEBLINKS_RSSC_VERSION ) )
{
	$msg = 'require rssc module v'.WEBLINKS_RSSC_VERSION.' or later';
	include XOOPS_ROOT_PATH.'/header.php';
	xoops_error( $msg );
	include XOOPS_ROOT_PATH.'/footer.php';
	exit();
}

if( WEBLINKS_RSSC_EXIST && WEBLINKS_RSSC_USE )
{
	include_once WEBLINKS_RSSC_ROOT_PATH.'/api/view.php';
}

include_once WEBLINKS_ROOT_PATH.'/class/weblinks_rssc_view_handler.php';

?>