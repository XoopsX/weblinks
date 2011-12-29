<?php
// $Id: admin_header_min.php,v 1.1 2011/12/29 14:32:52 ohwada Exp $

// 2008-02-16 K.OHWADA
// BUG: Fatal error, if not exist happy_linux

// 2007-11-11 K.OHWADA
// divid from admin_header.php
// minimum to necessary 

//=========================================================
// WebLinks Module
// admin header
// 2004-10-13 K.OHWADA
//=========================================================

//---------------------------------------------------------
// system
//---------------------------------------------------------
include '../../../include/cp_header.php';

$XOOPS_LANGUAGE = $xoopsConfig['language'];

// system user.php
if (file_exists( XOOPS_ROOT_PATH.'/language/'.$XOOPS_LANGUAGE.'/user.php' )) 
{
	include_once XOOPS_ROOT_PATH.'/language/'.$XOOPS_LANGUAGE.'/user.php';
}
else
{
	include_once XOOPS_ROOT_PATH.'/language/english/user.php';
}

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
	xoops_cp_header();
	xoops_error( 'require happy_linux module' );
	xoops_cp_footer();
	exit();
}

include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/version.php';

// check happy_linux version
if ( HAPPY_LINUX_VERSION < WEBLINKS_HAPPY_LINUX_VERSION ) 
{
	$msg = 'require happy_linux module v'.WEBLINKS_HAPPY_LINUX_VERSION.' or later';
	xoops_cp_header();
	xoops_error( $msg );
	xoops_cp_footer();
	exit();
}

// start execution time
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/time.php';
$happy_linux_time =& happy_linux_time::getInstance( true );
if ( WEBLINKS_DEBUG_TIME )
{
	$happy_linux_time->print_lap_time();
}

include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/memory.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/functions.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/multibyte.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/gtickets.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/api/language.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/api/locate.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/error.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/strings.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/system.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/basic_handler.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/admin_menu.php';

//---------------------------------------------------------
// weblinks
//---------------------------------------------------------
include_once WEBLINKS_ROOT_PATH.'/include/functions.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_bin_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_basic_handler.php';


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
	include_once WEBLINKS_ROOT_PATH.'/language/english/modinfo.php';
}

// compatible to old version
include_once WEBLINKS_ROOT_PATH.'/language/compatible.php';

include_once WEBLINKS_ROOT_PATH.'/admin/admin_functions.php';

//---------------------------------------------------------
// config
//---------------------------------------------------------
$weblinks_config_handler =& weblinks_get_handler( 'config2_basic', WEBLINKS_DIRNAME );
$weblinks_config_handler->init();
$rss_dirname  = $weblinks_config_handler->get_conf_by_name( 'rss_dirname' );
$rss_use      = $weblinks_config_handler->get_conf_by_name( 'rss_use' );

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
	xoops_cp_header();
	xoops_error( $msg );
	xoops_cp_footer();
	exit();
}

?>