<?php
// $Id: bin_api.php,v 1.1 2011/12/29 14:32:59 ohwada Exp $

// 2008-02-17 K.OHWADA
// weblinks_link_check_base.php

// 2007-09-20 K.OHWADA
// weblinks_link_bin_hander.php

// 2007-08-01 K.OHWADA
// happy_linux/api/bin.php

// 2007-06-10 K.OHWADA
// bin_file.php

// 2007-03-01 K.OHWADA
// happy_linux global.php
// functions.php

// 2006-10-05 K.OHWADA
// use happy_linux
// use weblinks_locate

// 2006-05-15 K.OHWADA
// this is new file
// use new handler

//=========================================================
// WebLinks Module
// 2006-05-15 K.OHWADA
//=========================================================

$WEBLINKS_PATH    = dirname( dirname( __FILE__ ) );
$WEBLINKS_DIRNAME = basename( $WEBLINKS_PATH );
$XOOPS_ROOT_PATH  = dirname( dirname( $WEBLINKS_PATH ) );

// config files ( set XOOPS_ROOT_PATH )
if ( file_exists( $XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/cache/config.php' ) ) 
{
	include_once $XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/cache/config.php';
}
else
{
	die('require cache/config.php');
}

// system files
include_once XOOPS_ROOT_PATH.'/class/snoopy.php';

//---------------------------------------------------------
// happy_linux
//---------------------------------------------------------
if ( !file_exists(XOOPS_ROOT_PATH.'/modules/happy_linux/include/version.php') ) 
{
	die('require happy_linux module');
}

include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/version.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/api/bin.php';

include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/functions.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/multibyte.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/language.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/strings.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/post.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/system.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/remote_file.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/convert_encoding.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/pagenavi.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/search.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/basic_handler.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/object.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/object_handler.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/locate.php';

//---------------------------------------------------------
// weblinks
//---------------------------------------------------------
// dir name
if( !defined('WEBLINKS_DIRNAME') )
{
	define('WEBLINKS_DIRNAME', $WEBLINKS_DIRNAME );
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
include_once WEBLINKS_ROOT_PATH.'/include/functions.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_bin_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_check_base.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_check_handler.php';
include_once WEBLINKS_ROOT_PATH.'/bin/class.bin_link_check.php';

// main.php
if ( file_exists( WEBLINKS_ROOT_PATH.'/language/'.$xoops_language.'/main.php' ) ) 
{
	include_once WEBLINKS_ROOT_PATH.'/language/'.$xoops_language.'/main.php';
}
else 
{
	include_once WEBLINKS_ROOT_PATH.'/language/english/main.php';
}

// admin.php
if ( file_exists( WEBLINKS_ROOT_PATH.'/language/'.$xoops_language.'/admin.php' ) ) 
{
	include_once WEBLINKS_ROOT_PATH.'/language/'.$xoops_language.'/admin.php';
}
else 
{
	include_once WEBLINKS_ROOT_PATH.'/language/english/admin.php';
}

// compatible to old version
include_once WEBLINKS_ROOT_PATH.'/language/compatible.php';

// check happy_linux version
if ( HAPPY_LINUX_VERSION < WEBLINKS_HAPPY_LINUX_VERSION ) 
{
	$msg = 'require happy_linux module v'.WEBLINKS_HAPPY_LINUX_VERSION.' or later';
	die( $msg );
}

?>