<?php
// $Id: weblinks_rssc_handler.php,v 1.2 2011/12/29 19:54:56 ohwada Exp $

// 2011-12-29 K.OHWADA
// PHP 5.3 : Assigning the return value of new by reference is now deprecated.

// 2007-11-01 K.OHWADA
// WEBLINKS_RSSC_USE 

// 2007-09-10 K.OHWADA
// return error_code in mod_link() 

// 2007-06-01 K.OHWADA
// divid to weblinks_rssc_view_handler
// rssc_link_xml_handler

// 2007-05-06 K.OHWADA
// BUG 4564: Fatal error, when set rssc_use if not exist RSSC module
// Fatal error: Call to undefined function: rssc_get_handler()

// 2007-03-01 K.OHWADA
// weblinks_link_basic

// 2006-10-14 K.OHWADA
// add get_feeds_by_where()

// 2006-10-05 K.OHWADA
// this is new file

//=========================================================
// WebLinks Module
// 2006-10-05 K.OHWADA
//=========================================================

if( defined('WEBLINKS_RSSC_EXIST') && WEBLINKS_RSSC_EXIST && WEBLINKS_RSSC_USE )
{
	include_once WEBLINKS_RSSC_ROOT_PATH.'/api/lang_main.php';
	include_once WEBLINKS_RSSC_ROOT_PATH.'/api/refresh.php';
	include_once WEBLINKS_RSSC_ROOT_PATH.'/api/manage.php';
}

if( !defined('RSSC_CODE_NORMAL') )
{
	define('RSSC_CODE_NORMAL',                  0);
	define('RSSC_CODE_XML_ENCODINGS_DEFAULT',   101);
	define('RSSC_CODE_PARSE_NOT_READ_XML_URL',  111);
	define('RSSC_CODE_PARSE_NOT_FIND_ENCODING', 112);
	define('RSSC_CODE_PARSE_FAILED',            113);
	define('RSSC_CODE_DB_ERROR',                121);
	define('RSSC_CODE_PARSE_MSG',               122);
	define('RSSC_CODE_REFRESH_ERROR',           123);
	define('RSSC_CODE_DISCOVER_SUCCEEDED',      131);
	define('RSSC_CODE_DISCOVER_FAILED',         132);
	define('RSSC_CODE_LINK_NOT_EXIST',          141);
	define('RSSC_CODE_LINK_ALREADY',            142);
	define('RSSC_CODE_LINK_EXIST_MORE',         143);
}

// === class begin ===
if( !class_exists('weblinks_rssc_handler') ) 
{
//=========================================================
// class weblinks_rssc
//=========================================================
class weblinks_rssc extends happy_linux_basic
{
	var $_rssc_xml_utility;
	var $_post;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_rssc()
{
	$this->happy_linux_basic();

	$this->_post =& happy_linux_post::getInstance();

	if ( WEBLINKS_RSSC_EXIST && WEBLINKS_RSSC_USE )
	{
		$this->_rssc_xml_utility =& rssc_xml_utility::getInstance();
	}
}

//---------------------------------------------------------
// set
//---------------------------------------------------------
function build_rssc( $lid, $form_mode=null )
{
	$cur_rss_flag = $this->_post->get_post_int('rss_flag');

// refresh
	if ( $form_mode == 'add_rssc' )
	{
		$cur_rss_url = $this->_post->get_post_url('show_rss_url');
	}
// normal
	else
	{
		$cur_rss_url = $this->_post->get_post_url('rss_url');
	}

	$this->set('cur_rss_flag',  $cur_rss_flag );
	$this->set('cur_rss_url',   $cur_rss_url );
	$this->set('show_rss_url',  $cur_rss_url);
	$this->set('link_lid',      $lid);
	$this->set('auto_code',     0);
	$this->set('title',         $this->_post->get_post_text('title') );
	$this->set('url',           $this->_post->get_post_url('url') );

	if ( isset($_POST['rss_flag']) )
	{
		$this->set('rss_flag', $this->_post->get_post_int('rss_flag'));
	}

	if ( isset($_POST['rss_url']) )
	{
		$this->set('rss_url', $this->_post->get_post_url('rss_url'));
	}

	if ( isset($_POST['rdf_url']) )
	{
		$this->set('rdf_url', $this->_post->get_post_url('rdf_url'));
	}

	if ( isset($_POST['atom_url']) )
	{
		$this->set('atom_url', $this->_post->get_post_url('atom_url'));
	}

	switch ( $cur_rss_flag )
	{
		case RSSC_C_MODE_AUTO:
			$this->set_by_discover();
			break;

		case RSSC_C_MODE_RSS:
			$this->set('rss_url',  $cur_rss_url);
			break;

		case RSSC_C_MODE_RDF:
			$this->set('rdf_url',  $cur_rss_url);
			break;

		case RSSC_C_MODE_ATOM:
			$this->set('atom_url', $cur_rss_url);
			break;

		default:
			break;
	}
}

function set_by_discover()
{
	$sel = RSSC_C_SEL_ATOM;

	$url          = $this->get('url');
	$cur_rss_flag = $this->get('cur_rss_flag');
	$cur_rss_url  = $this->get('cur_rss_url');

	$mode_rss_url  = '';
	$mode_rdf_url  = '';
	$mode_atom_url = '';
	$show_rss_url      = '';

	switch ( $cur_rss_flag )
	{
		case RSSC_C_MODE_RDF:
			$mode_rdf_url = $cur_rss_url;
			break;

		case RSSC_C_MODE_ATOM:
			$mode_atom_url = $cur_rss_url;
			break;

		case RSSC_C_MODE_RSS:
		default:
			$mode_rss_url = $cur_rss_url;
			break;
	}

// RSS auto discovary
	$auto_code = $this->_rssc_xml_utility->discover_for_manage( $cur_rss_flag, $url, $mode_rdf_url, $mode_rss_url, $mode_atom_url, $sel );

	$auto_rss_flag = $this->_rssc_xml_utility->get_xml_mode();
	$auto_rdf_url  = $this->_rssc_xml_utility->get_rdf_url();
	$auto_rss_url  = $this->_rssc_xml_utility->get_rss_url();
	$auto_atom_url = $this->_rssc_xml_utility->get_atom_url();

	switch ( $auto_rss_flag )
	{
		case RSSC_C_MODE_RDF:
			$show_rss_url = $auto_rdf_url;
			break;

		case RSSC_C_MODE_ATOM:
			$show_rss_url = $auto_atom_url;
			break;

		case RSSC_C_MODE_RSS:
		default:
			$show_rss_url = $auto_rss_url;
			break;
	}

	$this->set('rss_flag',     $auto_rss_flag);
	$this->set('rss_url',      $auto_rss_url);
	$this->set('rdf_url',      $auto_rdf_url);
	$this->set('atom_url',     $auto_atom_url);
	$this->set('show_rss_url', $show_rss_url);
	$this->set('auto_code',    $auto_code);

}

function check_result( $mode='add' )
{
// check rss url
	$rdf_url  = $this->get('rdf_url');
	$rss_url  = $this->get('rss_url');
	$atom_url = $this->get('atom_url');
	$rss_flag = $this->get('rss_flag');

	switch ( $rss_flag )
	{
		case RSSC_C_MODE_RDF:
			if ( empty($rdf_url) )
			{
				return WEBLINKS_CODE_RSSC_NO_RDF_URL;
			}
			break;

		case RSSC_C_MODE_RSS:
			if ( empty($rss_url) )
			{
				return WEBLINKS_CODE_RSSC_NO_RSS_URL;
			}
			break;

		case RSSC_C_MODE_ATOM:
			if ( empty($atom_url) )
			{
				return WEBLINKS_CODE_RSSC_NO_ATOM_URL;
			}
			break;

		case RSSC_C_MODE_AUTO:
			return WEBLINKS_CODE_RSSC_MODE_AUTO;

		case 0;
		default:
// NOT allow rss_flag = 0, when add rssc
			if ( $mode == 'add' )
			{
				return WEBLINKS_CODE_RSSC_NO_RSS_FLAG;
			}
			break;
	}

	return 0;
}

function check_necessary_param( $mode='add' )
{
	$code = $this->get('auto_code');
	switch ( $code )
	{
		case RSSC_CODE_DISCOVER_FAILED:
			return $code;
	}

	if ( $this->check_result( $mode ) )
	{
		return WEBLINKS_CODE_RSSC_NOT_FIND_PARAM;
	}

	return 0;
}

// --- class end ---
}

//=========================================================
// class weblinks_rssc_handler
//=========================================================
class weblinks_rssc_handler extends happy_linux_error
{
// handler
	var $_weblinks_link_handler;

	var $_rssc_refresh_handler;
	var $_rssc_link_xml_handler;

	var $_conf;

// set variable
	var $_mid;

// result
	var $_lid_exist = 0;

	var $_error_code       = 0;
	var $_parse_error_code = 0;
	var $_parse_result     = null;
	var $_exist_list_msg   = null;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_rssc_handler( $dirname )
{
	$this->happy_linux_error();

	$weblinks_config_handler      =& weblinks_get_handler( 'config2_basic', $dirname );
	$this->_weblinks_link_handler =& weblinks_get_handler( 'link_basic',    $dirname );

// Fatal error: Call to undefined function: rssc_get_handler()
	if ( WEBLINKS_RSSC_EXIST && function_exists('rssc_get_handler') )
	{
		$this->_rssc_refresh_handler   =& rssc_get_handler('refresh',    WEBLINKS_RSSC_DIRNAME );
		$this->_rssc_link_xml_handler  =& rssc_get_handler('link_xml',   WEBLINKS_RSSC_DIRNAME );
	}

	global $xoopsModule;
	if ( is_object($xoopsModule) )
	{
		$this->set_mid( $xoopsModule->getVar('mid') );
	}

	$this->_conf = $weblinks_config_handler->get_conf();

}

//---------------------------------------------------------
// create
//---------------------------------------------------------
function &create()
{
	$obj = new weblinks_rssc();
	return $obj;
}

// caller : class/weblinks_link_edit_handler.php
function &create_new_rssc_obj( $lid=0, $form_mode=null )
{
	$obj = false;
	if ( WEBLINKS_RSSC_USE )
	{
		$obj =& $this->create();
		$obj->build_rssc( $lid, $form_mode );
	}
	return $obj;
}

function &create_rssc_obj_by_lid( $lid, $form_mode=null  )
{
	$obj =& $this->create();
	$obj->build_rssc( $lid, $form_mode );

	$rssc_lid = $this->_weblinks_link_handler->get_rssc_lid($lid);
	if ( $rssc_lid )
	{
		$obj->set('rssc_lid', $rssc_lid );
	}

	return $obj;
}

function &create_exist_rssc_obj_by_lid( $lid, $form_mode=null )
{
	$obj =& $this->create();
	$obj->build_rssc( $lid, $form_mode );

	$rssc_lid = $this->_weblinks_link_handler->get_rssc_lid($lid);
	if ( $rssc_lid )
	{
		$rssc_link_obj =& $this->get_rssc_link($rssc_lid);

		$obj->set('rssc_lid', $rssc_lid );

		if ( is_object($rssc_link_obj) )
		{
			$obj->set('rdf_url',  $rssc_link_obj->get('rdf_url') );
			$obj->set('rss_url',  $rssc_link_obj->get('rss_url') );
			$obj->set('atom_url', $rssc_link_obj->get('atom_url') );
		}
	}

	return $obj;
}

//---------------------------------------------------------
// get
//---------------------------------------------------------
function get_rssc_link( $rssc_lid )
{
	$obj =& $this->_rssc_link_xml_handler->get($rssc_lid);
	return $obj;
}

//---------------------------------------------------------
// check fill in rss_flag & rss_url
// it is OK that rss_flag is auto and rss_url is blank 
//---------------------------------------------------------
function check_post_param( &$rssc_obj )
{
	$rss_url  = $rssc_obj->get('cur_rss_url');
	$rss_flag = $rssc_obj->get('cur_rss_flag');

	$this->_clear_errors();

	if (( $rss_flag == RSSC_C_MODE_RDF)||( $rss_flag == RSSC_C_MODE_RSS )||( $rss_flag == RSSC_C_MODE_ATOM ))
	{
		if ( empty($rss_flag) )
		{
			$this->_set_errors( sprintf( _WLS_ERROR_FILL, _WEBLINKS_RSS_MODE ) );
		}

		if ( empty($rss_url) )
		{
			$this->_set_errors( sprintf( _WLS_ERROR_FILL, _WLS_RSS_URL ) );
		}
	}

	return $this->returnExistError();
}

//---------------------------------------------------------
// check exist_lid
//---------------------------------------------------------
function check_get_rssc_exist_lid( &$rssc_obj )
{
	$lid_exist = 0;
	$rssc_lid = $rssc_obj->get('rssc_lid');
	$rdf_url  = $rssc_obj->get('rdf_url');
	$rss_url  = $rssc_obj->get('rss_url');
	$atom_url = $rssc_obj->get('atom_url');

	$script  = XOOPS_URL.'/modules/'.WEBLINKS_RSSC_DIRNAME.'/admin/';
	$script .= 'link_manage.php?op=mod_form&amp;lid=';

	$this->_clear_errors();

	$list = $this->_rssc_link_xml_handler->get_list_by_rssurl( $rdf_url, $rss_url, $atom_url, $rssc_lid );
	if ( $list )
	{
		$this->_exist_list_msg = $this->_rssc_link_xml_handler->build_error_rssurl_list($list, $script);
		$lid_exist = $list[0];
	}

	$this->_lid_exist = $lid_exist;
	return $lid_exist;
}

function get_rssc_exist_lid()
{
	return $this->_lid_exist;
}

function get_exist_list_msg()
{
	return $this->_exist_list_msg;
}

//---------------------------------------------------------
// add link
//---------------------------------------------------------
function add_link( &$rssc_obj )
{
// disposing just in case
// SHOULD check, before call this function
	if ( $rssc_obj->check_result() != 0 )
	{
		$this->_set_errors( 'weblinks_rssc_handler: not correct rssc object' );
		return false;
	}

	$time = $this->_conf['rss_cache_time'] * 3600;	// hour -> sec

	$link_obj = $this->_rssc_link_xml_handler->create();
	$link_obj->setVar('title',     $rssc_obj->get('title') );
	$link_obj->setVar('url',       $rssc_obj->get('url') );
	$link_obj->setVar('rdf_url',   $rssc_obj->get('rdf_url') );
	$link_obj->setVar('rss_url',   $rssc_obj->get('rss_url') );
	$link_obj->setVar('atom_url',  $rssc_obj->get('atom_url') );
	$link_obj->setVar('mode',      $rssc_obj->get('rss_flag') );
	$link_obj->setVar('p1',        $rssc_obj->get('link_lid') );
	$link_obj->setVar('uid',       $this->get_xoops_uid() );
	$link_obj->setVar('mid',       $this->_mid);
	$link_obj->setVar('refresh',   $time );

	$newid = $this->_rssc_link_xml_handler->insert($link_obj);
	if ( !$newid ) 
	{
		$this->_set_errors( $this->_rssc_link_xml_handler->getErrors() );
		return false;
	}

	return $newid;
}

//---------------------------------------------------------
// mod link
//---------------------------------------------------------
function mod_link( &$rssc_obj )
{
// disposing just in case
// SHOULD check, before call this function
	if ( $rssc_obj->check_result( 'mod' ) != 0 )
	{
		$this->_set_error_code( RSSC_CODE_DB_ERROR );
		$this->_set_errors( 'weblinks_rssc_handler: not correct rssc object' );
		return false;
	}

	$rssc_lid = $rssc_obj->get('rssc_lid');
	$mode     = $rssc_obj->get('rss_flag');
	$rdf_url  = $rssc_obj->get('rdf_url');
	$rss_url  = $rssc_obj->get('rss_url');
	$atom_url = $rssc_obj->get('atom_url');

	$link_obj = $this->_rssc_link_xml_handler->get( $rssc_lid );
	if ( !is_object($link_obj) )
	{
		$this->_set_error_code( RSSC_CODE_LINK_NOT_EXIST );
		$msg = "no rssc link : rssc_lid = ".$rssc_lid;
		$this->_set_errors( $msg );
		return false;
	}

	$link_obj->setVar('title', $rssc_obj->get('title') );
	$link_obj->setVar('url',   $rssc_obj->get('url') );
	$link_obj->setVar('mode',  $mode );

	switch ( $mode )
	{
		case RSSC_C_MODE_AUTO:
			$link_obj->set('rdf_url',  $rdf_url );
			$link_obj->set('rss_url',  $rss_url );
			$link_obj->set('atom_url', $atom_url );

		case RSSC_C_MODE_RSS:
			$link_obj->set('rss_url',  $rss_url);
			break;

		case RSSC_C_MODE_RDF:
			$link_obj->set('rdf_url',  $rdf_url);
			break;

		case RSSC_C_MODE_ATOM:
			$link_obj->set('atom_url', $atom_url);
			break;

		default:
			break;
	}

	$ret = $this->_rssc_link_xml_handler->update($link_obj);
	if ( !$ret ) 
	{
		$this->_set_error_code( RSSC_CODE_DB_ERROR );
		$this->_set_errors( $this->_rssc_link_xml_handler->getErrors() );
		return false;
	}

	return $ret;
}

//---------------------------------------------------------
// link_handler object
//---------------------------------------------------------
function get_var( $lid, $key )
{
	switch ($key)
	{
		case 'cachetime':
			$key = 'refresh';
			break;
	}

	$link_obj =& $this->_rssc_link_xml_handler->get($lid);
	if ( is_object($link_obj) )
	{
		return $link_obj->getVar($key, 'n');
	}
	return false;
}

function get_var_rssurl( $lid )
{
	$link_obj =& $this->_rssc_link_xml_handler->get($lid);
	if ( !is_object($link_obj) )
	{
		return false;
	}

	$rss_url = $link_obj->get_rssurl_by_mode('n');
	return $rss_url;
}

//---------------------------------------------------------
// POST
//---------------------------------------------------------
function get_post_url($array, $key)
{
	if ( isset($array[$key]) && ( $array[$key] != 'http://' ) )
	{
		return $array[$key];
	}

	return '';
}

function get_post_encoding( $value )
{
	if ($value == 'auto')
	{
		return '';
	}

	return $value;
}

function get_xoops_uid()
{
	global $xoopsUser;

	$uid = 0;
	if ( is_object($xoopsUser) )
	{
		$uid = $xoopsUser->getVar('uid');
	}
	return $uid;
}

function set_mid($value)
{
	$this->_mid = intval($value);
}

function get_rss_url_flag( $rssc_lid=0 )
{
	$obj  =& $this->_rssc_link_xml_handler->create();
	$url  = '';
	$flag = RSSC_C_MODE_NON;

	if ( $rssc_lid )
	{
		$obj =& $this->_rssc_link_xml_handler->get( $rssc_lid );
		if ( is_object($obj) )
		{
			$url  = $obj->get_rssurl_by_mode('n');
			$flag = $obj->get('mode');
		}
	}

	return array($url, $flag);
}

function get_rss_flag_default()
{
	return RSSC_C_MODE_AUTO;
}

function get_rss_opt()
{
	$obj =& $this->_rssc_link_xml_handler->create();
	$opt = $obj->get_mode_option();
	return $opt;
}

function refresh_link( $rssc_lid )
{
	$ret = $this->_rssc_refresh_handler->refresh( $rssc_lid );
	if (!$ret)
	{
		$this->_set_errors( $this->_rssc_refresh_handler->getErrors() );
		return false;
	}
	return true;
}

function refresh_link_for_add_link( $rssc_lid )
{
	$this->_rssc_refresh_handler->set_force_refresh( true );

	$ret = $this->_rssc_refresh_handler->refresh_link_for_add_link( $rssc_lid );
	switch ( $ret )
	{
		case 0:
			break;

		case RSSC_CODE_PARSE_MSG:
			$this->_parse_result = $this->_rssc_refresh_handler->get_parse_result();
			break;

		case RSSC_CODE_PARSE_FAILED:
			$this->_parse_error_code = $this->_rssc_refresh_handler->get_parse_error_code();
			$this->_set_errors(        $this->_rssc_refresh_handler->getErrors() );
			break;

		case RSSC_CODE_DB_ERROR:
		case RSSC_CODE_REFRESH_ERROR:
		default:
			$this->_set_errors( $this->_rssc_refresh_handler->getErrors() );
			break;
	}

	return $ret;
}

function get_error_code()
{
	return $this->_error_code;
}

function get_parse_error_code()
{
	return $this->_parse_error_code;
}

function get_parse_result()
{
	return $this->_parse_result;
}

// --- class end ---
}

//=========================================================
// class weblinks_rssc_form
//=========================================================
// _RSSC_REFRESH_LINK, _RSSC_REFRESH_LINK_DSC
//---------------------------------------------------------
class weblinks_rssc_form extends happy_linux_form_lib
{
	var $_rssc_link_xml_handler;

	var $_post;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_rssc_form()
{
	$this->happy_linux_form_lib();

	$this->_post =& happy_linux_post::getInstance();

// Fatal error: Call to undefined function: rssc_get_handler()
	if ( WEBLINKS_RSSC_EXIST && function_exists('rssc_get_handler') )
	{
		$this->_rssc_link_xml_handler =& rssc_get_handler('link', WEBLINKS_RSSC_DIRNAME );
	}
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new weblinks_rssc_form();
	}
	return $instance;
}


//---------------------------------------------------------
// form
//---------------------------------------------------------
function show_add_rssc( &$obj, $op_mode )
{
	$this->set_obj( $obj );

	switch ($op_mode)
	{
		case 'mod_link':
		case 'approve_mod':
			$form_title = _AM_WEBLINKS_MOD_RSSC;
			$op         = 'mod_rssc';
			$url_cancel = 'link_list.php';
			break;

		case 'add_link':
		case 'approve_new':
		default:
			$form_title = _AM_WEBLINKS_ADD_RSSC;
			$op         = 'add_rssc';
			$url_cancel = 'link_list.php?sortid=1';
			break;
	}

// --- form start---
	echo $this->build_form_begin( 'add_rssc', 'link_manage.php' );
	echo $this->build_token();
	echo $this->build_html_input_hidden('op',       $op );
	echo $this->build_html_input_hidden('op_mode',  $op_mode );
	echo $this->build_html_input_hidden('rssc_lid', intval( $obj->get('rssc_lid') ) );
	echo $this->build_html_input_hidden('link_lid', intval( $obj->get('link_lid') ) );
	echo $this->build_html_input_hidden('title',    $this->sanitize_text( $obj->get('title') ) );
	echo $this->build_html_input_hidden('url',      $this->sanitize_url( $obj->get('url') ) );
	echo $this->build_html_input_hidden('rdf_url',  $this->sanitize_url( $obj->get('rdf_url') ) );
	echo $this->build_html_input_hidden('rss_url',  $this->sanitize_url( $obj->get('rss_url') ) );
	echo $this->build_html_input_hidden('atom_url', $this->sanitize_url( $obj->get('atom_url') ) );

	echo $this->build_form_table_begin();
	echo $this->build_form_table_title( $form_title );

	echo $this->build_obj_table_label(_WLS_LINKID,        'link_lid');
	echo $this->build_obj_table_label(_WEBLINKS_RSSC_LID, 'rssc_lid');
	echo $this->build_obj_table_label(_WLS_SITETITLE,     'title');
	echo $this->build_obj_table_label(_WLS_SITEURL,       'url');

	$ele_rss_url = $this->build_edit_url_with_visit('show_rss_url', $obj->get('show_rss_url') );
	echo $this->build_form_table_line(_WLS_RSS_URL, $ele_rss_url);

	$ele_mode = $this->build_html_input_radio_select('rss_flag', $obj->get('rss_flag'), $this->get_mode_option() );
	echo $this->build_form_table_line(_WEBLINKS_RSS_MODE, $ele_mode);

	$ele_submit   = $this->build_html_input_submit('submit', _HAPPY_LINUX_EXECUTE);
	$ele_cancel   = $this->build_html_input_button_location('cancel', _CANCEL, $url_cancel);
	$ele_button   = $ele_submit.' '.$ele_cancel;
	echo $this->build_form_table_line('', $ele_button, 'foot', 'foot');

	echo $this->build_form_table_end();
	echo $this->build_form_end();
// --- form end ---

}

function show_refresh_link($link_lid, $rssc_lid, $op_mode)
{
	switch ($op_mode)
	{
		case 'mod_link':
		case 'appove_mod':
			$location_url = 'link_list.php';
			break;

		case 'add_link':
		case 'appove_new':
		default:
			$location_url = 'link_list.php?sortid=1';
			break;
	}

	$arr = array(
		'op'       => 'refresh_link',
		'op_mode'  => $op_mode,
		'link_lid' => $link_lid,
		'rssc_lid' => $rssc_lid,
	);

	$form_name      = '';
	$action         = '';
	$submit_name    = 'submit';
	$submit_value   = _HAPPY_LINUX_EXECUTE;
	$cancel_name    = '';
	$cancel_value   = '';
	$location_name  = 'cancel';
	$location_value = _CANCEL;

	$val = $this->build_lib_button_hidden_array( $arr, $form_name, $action, $submit_name, $submit_value, $cancel_name, $cancel_value, $location_name, $location_value, $location_url );
	$text = $this->build_lib_box_style(_RSSC_REFRESH_LINK, _RSSC_REFRESH_LINK_DSC, $val );
	echo $text;

}

function get_mode_option()
{
	$obj =& $this->_rssc_link_xml_handler->create();
	$mode_opt = $obj->get_mode_option();
	return $mode_opt;
}

// --- class end ---
}

// === class end ===
}

?>