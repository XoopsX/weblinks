<?php
// $Id: oninstall.php,v 1.1 2011/12/29 14:32:31 ohwada Exp $

// 2008-02-17 K.OHWADA
// happy_linux global.php

// 2008-02-16 K.OHWADA
// BUG: Fatal error, if not exist happy_linux

//=========================================================
// WebLinks Module
// 2007-11-11 K.OHWADA
//=========================================================

$WEBLINKS_DIRNAME = basename( dirname( __FILE__ ) );

global $xoopsConfig;
$XOOPS_LANGUAGE = $xoopsConfig['language'];

// === xoops_module_install_weblinks ===
// BUG: Fatal error, if not exist happy_linux
// no action here, if not exist
// same process in admin/index.php
if ( file_exists( XOOPS_ROOT_PATH.'/modules/happy_linux/api/module_install.php' ) ) 
{

include_once XOOPS_ROOT_PATH.'/modules/happy_linux/api/locate.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/api/module_install.php';

include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/class/weblinks_locate.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/class/weblinks_config2_define_handler.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/class/weblinks_linkitem_define_handler.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/class/weblinks_install.php';

// system user.php
if (file_exists( XOOPS_ROOT_PATH.'/language/'.$XOOPS_LANGUAGE.'/user.php' )) 
{
	include_once XOOPS_ROOT_PATH.'/language/'.$XOOPS_LANGUAGE.'/user.php';
}
else
{
	include_once XOOPS_ROOT_PATH.'/language/english/user.php';
}

// happy_linux global.php
if (file_exists( XOOPS_ROOT_PATH.'/modules/happy_linux/language/'.$XOOPS_LANGUAGE.'/global.php' )) 
{
	include_once XOOPS_ROOT_PATH.'/modules/happy_linux/language/'.$XOOPS_LANGUAGE.'/global.php';
}
else
{
	include_once XOOPS_ROOT_PATH.'/modules/happy_linux/language/english/global.php';
}

// weblinks main.php
if (file_exists( XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/language/'.$XOOPS_LANGUAGE.'/main.php' )) 
{
	include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/language/'.$XOOPS_LANGUAGE.'/main.php';
}
else
{
	include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/language/english/main.php';
}

// weblinks admin.php
if (file_exists( XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/language/'.$XOOPS_LANGUAGE.'/admin.php' )) 
{
	include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/language/'.$XOOPS_LANGUAGE.'/admin.php';
}
else
{
	include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/language/english/admin.php';
}

// --- eval begin ---
eval( '

function xoops_module_install_'. $WEBLINKS_DIRNAME .'( $module )
{
	return weblinks_install_base( "'. $WEBLINKS_DIRNAME .'" ,  $module );
}

function xoops_module_update_'. $WEBLINKS_DIRNAME .'( $module, $prev_version )
{
	return weblinks_update_base( "'. $WEBLINKS_DIRNAME .'" ,  $module, $prev_version );
}

' );
// --- eval end ---

}
// === xoops_module_install_weblinks end ===

// === weblinks_oninstall_base ===
if( ! function_exists( 'weblinks_install_base' ) ) 
{

function weblinks_install_base( $DIRNAME, $module )
{
// prepare for message
	global $msgs, $ret ; // TODO :-D

// for Cube 2.1
	if( defined( 'XOOPS_CUBE_LEGACY' ) ) 
	{
		$root =& XCube_Root::getSingleton();
		$root->mDelegateManager->add( 'Legacy.Admin.Event.ModuleInstall.' . ucfirst($DIRNAME) . '.Success' , 'weblinks_message_append_oninstall' ) ;
		$ret = array() ;
	}
	else 
	{
		if( ! is_array( $ret ) ) $ret = array() ;
	}

// main
	$weblinks =& weblinks_install::getInstance( $DIRNAME );
	$code = $weblinks->install();
	$ret[] = $weblinks->get_message();

	return $code;
}

function weblinks_update_base( $DIRNAME, $module, $prev_version )
{
// prepare for message
	global $msgs ; // TODO :-D

// for Cube 2.1
	if( defined( 'XOOPS_CUBE_LEGACY' ) ) 
	{
		$root =& XCube_Root::getSingleton();
		$root->mDelegateManager->add( 'Legacy.Admin.Event.ModuleUpdate.' . ucfirst($DIRNAME) . '.Success', 'weblinks_message_append_onupdate' ) ;
		$msgs = array() ;
	}
	else 
	{
		if( ! is_array( $msgs ) ) $msgs = array() ;
	}

// main
	$weblinks = new weblinks_install( $DIRNAME );
	$code = $weblinks->update();
	$msgs[] = $weblinks->get_message();

	return $code;
}

// for Cube 2.1
function weblinks_message_append_oninstall( &$module_obj , &$log )
{
	if( is_array( @$GLOBALS['ret'] ) ) {
		foreach( $GLOBALS['ret'] as $message ) {
			$log->add( strip_tags( $message ) ) ;
		}
	}

	// use mLog->addWarning() or mLog->addError() if necessary
}

// for Cube 2.1
function weblinks_message_append_onupdate( &$module_obj , &$log )
{
	if( is_array( @$GLOBALS['msgs'] ) ) {
		foreach( $GLOBALS['msgs'] as $message ) {
			$log->add( strip_tags( $message ) ) ;
		}
	}

	// use mLog->addWarning() or mLog->addError() if necessary
}

// === weblinks_oninstall_base end ===
}

?>