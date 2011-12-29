<?php
// $Id: header_basic.php,v 1.1 2011/12/29 14:32:27 ohwada Exp $

// 2007-02-20 K.OHWADA
// functions.php

// 2006-12-20 K.OHWADA
// use object_validater.php

// 2006-10-11 K.OHWADA
// BUG 4312: Fatal error: Class 'happy_linux_language_factory' not found

// 2006-09-30 K.OHWADA
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
// header_basic
// for visit.php, myheader.php, comment_new.php
// 2004/08/10 K.OHWADA
//================================================================

include '../../mainfile.php';

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

include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/functions.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/api/language.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/language.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/error.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/strings.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/post.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/system.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/remote_file.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/html.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/form.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/search.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/server.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/basic_handler.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/object.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/object_validater.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/object_handler.php';

//---------------------------------------------------------
// weblinks
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

$XOOPS_LANGUAGE   = $xoopsConfig['language'];

// include file
include_once WEBLINKS_ROOT_PATH.'/include/weblinks_constant.php';
include_once WEBLINKS_ROOT_PATH.'/include/functions.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_handler.php';

// compatible to old version
include_once WEBLINKS_ROOT_PATH.'/language/compatible.php';

// config init
$weblinks_config_handler =& weblinks_get_handler( 'config2_basic', WEBLINKS_DIRNAME );
$weblinks_config_handler->init();

?>