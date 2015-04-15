<?php
// $Id: weblinks_auth.php,v 1.1 2011/12/29 14:33:04 ohwada Exp $

// 2009-02-08 K.OHWADA
// Notice [PHP]: Only variables should be assigned by reference

// 2007-10-30 K.OHWADA
// move show_modify from weblinks_config2_basic_handler
// BUG: no action when click modify
// change request from int to text

// 2007-09-10 K.OHWADA
// divid from weblinks_auth.php

//=========================================================
// WebLinks Module
// 2006-05-15 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('weblinks_auth') ) 
{

//=========================================================
// class weblinks_auth
//=========================================================
class weblinks_auth extends happy_linux_error
{
	var $_config_handler;
	var $_menu;
	var $_post;
	var $_system;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_auth( $dirname )
{
	$this->happy_linux_error();

	$this->_config_handler =& weblinks_get_handler( 'config2_basic',  $dirname );
	$this->_menu           =& weblinks_menu::getInstance( $dirname );
	$this->_post           =& happy_linux_post::getInstance();
	$this->_system         =& happy_linux_system::getInstance();
}

public static function &getInstance( $dirname )
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new weblinks_auth( $dirname );
	}
	return $instance;
}

//---------------------------------------------------------
// public
//---------------------------------------------------------
function show_modify( $rec_uid )
{
	$uid_match   = $this->_check_uid_match( $rec_uid );
	$has_permit  = $this->_has_auth_modify_permit( $uid_match );
	$show_passwd = $this->_check_show_passwd();

	if ( $has_permit || $show_passwd )
	{	return true;	}

	return false;
}

function &get_auth_submit()
{
	$has_permit = $this->_menu->show_submit();
	$has_auto   = $this->_has_auth( 'auth_submit_auto' );
	$code       = $this->_get_submit_code( $has_permit );

	$arr = array( $code, $has_permit, $has_auto );
	return $arr;
}

function &get_auth_modify( $rec_uid, $rec_passwd )
{
	$request = $this->_post->get_post_text('request');

	$uid_match = $this->_check_uid_match( $rec_uid );

	list( $passwd_match, $passwd_incorrect ) = 
		$this->_check_passwd_match( $rec_passwd, $request );

	$has_permit = $this->_has_auth_modify_permit( $uid_match, $passwd_match );

	$arr = array(
		'code'                   => $this->_get_modify_code( $has_permit, $passwd_match, $request ),
		'has_auth_modify_permit' => $has_permit,
		'has_auth_modify_auto'   => $this->_has_auth_modify_auto(   $uid_match, $passwd_match ),
		'has_auth_delete_permit' => $this->_has_auth_delete_permit( $uid_match, $passwd_match ),
		'has_auth_delete_auto'   => $this->_has_auth_delete_auto(   $uid_match, $passwd_match ),
		'is_owner'               => $this->_is_owner(               $uid_match, $passwd_match ),
		'flag_passwd_incorrect'  => $passwd_incorrect,
	);

	return $arr;
}

function has_auth_ratelink()
{
	return $this->_has_auth( 'auth_ratelink' );
}

// Notice: Only variables should be assigned by reference in file class/weblinks_link.php
function &has_auth_desc_option()
{
	$arr = array(
		'dohtml'    => $this->_has_auth( 'auth_dohtml' ),
		'dosmiley'  => $this->_has_auth( 'auth_dosmiley' ),
		'doxcode'   => $this->_has_auth( 'auth_doxcode' ),
		'doimage'   => $this->_has_auth( 'auth_doimage' ),
		'dobr'      => $this->_has_auth( 'auth_dobr' ),

		'dohtml1'   => $this->_has_auth( 'auth_dohtml_1' ),
		'dosmiley1' => $this->_has_auth( 'auth_dosmiley_1' ),
		'doxcode1'  => $this->_has_auth( 'auth_doxcode_1' ),
		'doimage1'  => $this->_has_auth( 'auth_doimage_1' ),
		'dobr1'     => $this->_has_auth( 'auth_dobr_1' ),
	);
	return $arr;
}

//---------------------------------------------------------
// private
//---------------------------------------------------------
function _get_submit_code( $has_permit )
{
	$code = '';

// not permit
	if ( $has_permit ) 
	{
		$code = 'permit';
	}
// not permit
	else
	{
// login user
		$code = 'not_permit';

// guest
		if ( $this->_system->is_guest() ) 
		{
			$code = 'show_login';
		}
	}

	return $code;
}

function _get_modify_code( $has_permit, $passwd_match, $request )
{
	$show_passwd = $this->_check_show_passwd( $passwd_match, $request );

	$code = '';

// not permit
	if ( $has_permit ) 
	{
		$code = 'permit';
	}
// not permit
	else
	{
// login user
		$code = 'not_permit';

// guest
		if ( $this->_system->is_guest() ) 
		{
			$code = 'show_login';
		}
	}

	if ( $show_passwd )
	{
		$code = 'show_password';
	}

	return $code;
}

function _check_uid_match( $rec_uid )
{
	if ( $this->_system->is_user() && ($this->_system->get_uid() == $rec_uid ) )
	{	return true;	}
	return false;
}

function _check_passwd_match( $rec_passwd, $request )
{
	$passwd_match     = false;
	$passwd_incorrect = false;

	list($passwd, $flag_passwd, $flag_code)
		= $this->_post->get_post_get_passwd_old();

	if (( $request == 'password' ) || $flag_code )
	{
		if ( $rec_passwd == md5( $passwd )) {
			$passwd_match = true;
		} else {
			$passwd_incorrect = true;
		}
	}

	return array( $passwd_match, $passwd_incorrect );
}

function _check_show_passwd( $passwd_match=false, $request=null )
{
	if ( $passwd_match || ( $request == 'modify' ))
	{	return false;	}

	if ( $this->_system->is_guest() && $this->_get_conf('use_passwd') )
	{
		$has_auth_passwd = $this->_has_auth_passwd( 'auth_modify' );
		if ( $has_auth_passwd )
		{	return true;	}
	}

	return false;
}

function _is_owner( $uid_match, $passwd_match )
{
	if ( $uid_match || $passwd_match )
	{	return true;	}
	return false;
}

function _has_auth_modify_permit( $uid_match, $passwd_match=false )
{
	return $this->_has_modify_common( 'auth_modify', $uid_match, $passwd_match );
}

function _has_auth_modify_auto( $uid_match, $passwd_match )
{
	return $this->_has_modify_common( 'auth_modify_auto', $uid_match, $passwd_match );
}

function _has_auth_delete_permit( $uid_match, $passwd_match )
{
	return $this->_has_modify_common( 'auth_delete', $uid_match, $passwd_match );
}

function _has_auth_delete_auto( $uid_match, $passwd_match )
{
	return $this->_has_modify_common( 'auth_delete_auto', $uid_match, $passwd_match );
}

function _has_modify_common( $name, $uid_match, $passwd_match )
{
	$has_auth        = $this->_has_auth(        $name );
	$has_auth_uid    = $this->_has_auth_uid(    $name );
	$has_auth_passwd = $this->_has_auth_passwd( $name );

	if ( $has_auth )
	{	return true;	}

// user
	if ( $this->_system->is_user() ) 
	{
		if ( $has_auth_uid && $uid_match )
		{	return true;	}
	}
// guest
	else
	{
		if ( $has_auth_passwd && $passwd_match && $this->_get_conf('use_passwd') )
		{	return true;	}
	}

	return false;
}

function _has_auth_uid( $name )
{
	if ( in_array( WEBLINKS_ID_AUTH_UID, $this->_get_conf_array( $name ) ) )
	{	return true;	}
	return false;
}

function _has_auth_passwd( $name )
{
	if ( in_array( WEBLINKS_ID_AUTH_PASSWD, $this->_get_conf_array( $name ) ) )
	{	return true;	}
	return false;
}

function _has_auth( $name )
{
	if ( $this->_system->is_module_admin() )
	{	return true;	}

// BUG 4707: Only variables should be assigned by reference in weblinks
// modify happy_linux_basic_handler

	$auth_arr =& $this->_get_conf_array( $name );
	$groups   =& $this->_system->get_user_groups();

	if ( is_array($auth_arr) && count($auth_arr) &&
	     is_array($groups)   && count($groups) )
	{
		if ( array_intersect( $auth_arr, $groups ) )
		{	return true;	}
	}

	return false;
}

function &_get_conf_array( $name )
{
// Notice [PHP]: Only variables should be assigned by reference
	$arr = unserialize( $this->_get_conf( $name ) );
	return $arr;
}

function &_get_conf( $name )
{
// for debug: do not have a local variable
	return $this->_config_handler->get_conf_by_name($name);
}

// --- class end ---
}

// === class end ===
}

?>