<?php
// $Id: dev_header.php,v 1.1 2011/12/29 14:32:57 ohwada Exp $

// 2007-02-20 K.OHWADA
// language/xx/user.php

// 2006-12-10 K.OHWADA
// use WEBLINKS_DEV_PERMIT

//================================================================
// WebLinks Module
// 2006-09-20 K.OHWADA
//================================================================

include_once '../../../../mainfile.php';

//===== cp_header.php begin =====
include_once XOOPS_ROOT_PATH . "/include/cp_functions.php";
$moduleperm_handler = & xoops_gethandler( 'groupperm' );
if ( $xoopsUser ) {
    $url_arr = explode('/',strstr($xoopsRequestUri,'/modules/'));
    $module_handler =& xoops_gethandler('module');
    $xoopsModule =& $module_handler->getByDirname($url_arr[2]);
    unset($url_arr);
    
    if ( !$moduleperm_handler->checkRight( 'module_admin', $xoopsModule->getVar( 'mid' ), $xoopsUser->getGroups() ) ) {
        redirect_header( XOOPS_URL . "/user.php", 1, _NOPERM );
        exit();
    } 
} else {
    redirect_header( XOOPS_URL . "/user.php", 1, _NOPERM );
    exit();
}
// set config values for this module
if ( $xoopsModule->getVar( 'hasconfig' ) == 1 || $xoopsModule->getVar( 'hascomments' ) == 1 ) {
    $config_handler = & xoops_gethandler( 'config' );
    $xoopsModuleConfig = & $config_handler->getConfigsByCat( 0, $xoopsModule->getVar( 'mid' ) );
}

// include the default language file for the admin interface
if ( file_exists( "../language/" . $xoopsConfig['language'] . "/admin.php" ) ) {
    include "../language/" . $xoopsConfig['language'] . "/admin.php";
}
elseif ( file_exists( "../language/english/admin.php" ) ) {
    include "../language/english/admin.php";
}
//===== cp_header.php end =====

include_once XOOPS_ROOT_PATH.'/class/snoopy.php';

if ( file_exists( XOOPS_ROOT_PATH."/language/" . $xoopsConfig['language'] . "/user.php" ) ) {
    include_once XOOPS_ROOT_PATH."/language/" . $xoopsConfig['language'] . "/user.php";
}
elseif ( file_exists( XOOPS_ROOT_PATH."/language/english/user.php" ) ) {
    include_once XOOPS_ROOT_PATH."/language/english/user.php";
}

//---------------------------------------------------------
// happy_linux
//---------------------------------------------------------
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/system.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/error.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/strings.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/basic_handler.php';

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

// include file
include_once WEBLINKS_ROOT_PATH.'/include/weblinks_constant.php';

//---------------------------------------------------------
// dev
//---------------------------------------------------------
include_once 'dev_functions.php';
include_once 'dev_handler_class.php';
include_once 'gen_record_class.php';

if ( WEBLINKS_DEV_PERMIT != 1 )
{
	dev_header();
	echo '<h1 style="color: #ff0000;">not permit</h1>'."\n";
	dev_footer();
}

?>