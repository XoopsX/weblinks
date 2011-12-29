<?php
// $Id: weblinks_link_form_check_handler.php,v 1.1 2011/12/29 14:33:03 ohwada Exp $

// 2007-11-01 K.OHWADA
// _check_length()

// 2007-09-20 K.OHWADA
// flag_usercomment_indispensable

// 2007-09-12 K.OHWADA
// check_form_approve_mod()

// 2007-09-11 K.OHWADA
// BUG 4702: Notice [PHP]: Use of undefined constant HAPPY_LINUX_RSS_MODE_RDF

// 2007-08-25 K.OHWADA
// _check_rss_url_by_post()

// 2007-07-14 K.OHWADA
// _check_mail_by_post()

// 2007-05-18 K.OHWADA
// show raw HTML as <h4 style="color: #ff0000;">xxx<br /></h4> 
// get_error_msg_addlink() -> get_errors_addlink()
// get_error_msg_modlink() -> get_errors_modlink()

// 2007-05-06 K.OHWADA
// Notice [PHP]: Use of undefined constant WLS_ERROR_ILLEGAL

// 2007-02-20 K.OHWADA
// check_captcha_by_post()

// 2006-12-03 K.OHWADA
// small change _build_html_error_msg() _check_desc_by_post()

// 2006-10-14 K.OHWADA
// BUG: check_url_double dont work correctly

// 2006-09-20 K.OHWADA
// this is new file
// move from weblinks_link_edit_handler.php

//=========================================================
// WebLinks Module
// 2006-05-20 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('weblinks_link_form_check_handler') ) 
{

//=========================================================
// class weblinks_link_form_check_handler
//=========================================================
class weblinks_link_form_check_handler extends happy_linux_error
{
	var $_DIRNAME;

	var $_config_handler;
	var $_link_handler;
	var $_linkitem_handler;

	var $_system;
	var $_post;

// config
	var $_conf;
	var $_conf_desc_option = array();

// error message
	var $error_msg_flag_lid_full = 0;
	var $error_msg_flag_lid_part = 0;
	var $error_msg_lid_arr_full  = array();
	var $error_msg_lid_arr_part  = array();
	var $_formated_error_addlink;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_link_form_check_handler( $dirname )
{
	$this->happy_linux_error();

	$this->_DIRNAME = $dirname;

	$this->_config_handler   =& weblinks_get_handler( 'config2_basic',   $dirname );
	$this->_link_handler     =& weblinks_get_handler( 'link',            $dirname );
	$this->_linkitem_handler =& weblinks_get_handler( 'linkitem_define', $dirname );

	$this->_system  =& happy_linux_system::getInstance();
	$this->_post    =& happy_linux_post::getInstance();

	$this->_conf = $this->_config_handler->get_conf();

}

//---------------------------------------------------------
// POST param
//---------------------------------------------------------
function get_post_url()
{
	$url = $this->_post->get_post_text('url');
	return $url;
}

//---------------------------------------------------------
// check form
//---------------------------------------------------------
function check_form_addlink_by_post()
{
	return $this->_check_form_common( true, true, false );
}

function check_form_modlink_for_owner_by_post()
{
	return $this->_check_form_common( true, false, false );
}

// modlink.php
function check_form_modlink_by_post( $is_owner=true, $has_auth_modify_auto=false )
{
	$flag_usercomment_indispensable = false;

// not owner and not auto
	if ( !$is_owner && !$has_auth_modify_auto )
	{
		$flag_usercomment_indispensable = true;
	}

	return $this->_check_form_common( $is_owner, false, $flag_usercomment_indispensable );
}

function check_form_approve_mod()
{
	$this->_check_form_common( true, false, false );
	$this->_check_form_approve_mod_user();
	return $this->returnExistError();
}

function _check_form_common( $is_owner=true, $flag_new=true, $flag_usercomment_indispensable=false  )
{
	$linkitem_arr =& $this->_get_linkitem_load();

	$this->_clear_errors();

	foreach ($linkitem_arr as $id => $v )
	{
		$name  = $this->_get_linkitem_by_itemid($id, 'name');
		$mode  = $this->_get_linkitem_by_itemid($id, 'user_mode');
		$form  = $this->_get_linkitem_by_itemid($id, 'user_form');
		$title = $this->_get_linkitem_by_itemid($id, 'title');

		switch ($name)
		{
			case 'usercomment':
// check if owner, or modify if not owner
				if ( ( $is_owner && ( $mode == 2 ) ) ||
				       $flag_usercomment_indispensable )
				{
					$this->_check_fill_by_post( $name, $title);
				}
				break;

			case 'name':
// check if owner
				if ( $is_owner && ( $mode == 2 ) )
				{
					$this->_check_fill_by_post( $name, $title);
				}
				break;

			case 'mail':
				$this->_check_mail_by_post( $name, $title, $mode, $is_owner );
				break;

			case 'url':
				$this->_check_url_by_post( $name, $title, $mode, $flag_new);
				break;

			case 'banner':
				$this->_check_banner_by_post( $name, $title, $mode);
				break;

			case 'rss_url':
// BUG 4702: Notice [PHP]: Use of undefined constant HAPPY_LINUX_RSS_MODE_RDF
				if ( WEBLINKS_RSSC_USE )
				{
					$this->_check_rss_url_by_post( $name, $title, $mode);
				}
				break;

			case 'description':
				$this->_check_desc_by_post( $name, $title, $mode);
				break;

			case 'textarea1':
				$this->_check_textarea1_by_post( $name, $title, $mode);
				break;

			case 'cat':
				$this->_check_cat_by_post( $name, $title, $mode);
				break;

			case 'passwd':
				$this->_check_passwd_by_post( $name, $title, $flag_new);
				break;

			case 'captcha':
				$this->_check_captcha_by_post();
				break;

			default:
				if ( $mode == 2 )
				{
					$this->_check_fill_by_post( $name, $title);
				}
				break;
		}
	}

	return $this->returnExistError();
}

//---------------------------------------------------------
// check routine
//---------------------------------------------------------
function _check_fill_by_post($name, $title)
{
	if ( !$this->_post->is_post_fill($name) )
	{
		$msg = sprintf(_WLS_ERROR_FILL, $title);
		$this->_set_errors( $msg );
		return false;
	}

	return true;
}

function _check_desc_by_post($name, $title, $mode)
{
	$desc = '';
	if ( isset($_POST['weblinks_description']) )
	{
		$desc = $_POST['weblinks_description'];
	}

	if ( ( $mode == 2 ) && ($desc === '') )
	{
		$msg = sprintf(_WLS_ERROR_FILL, $title);
		$this->_set_errors( $msg );
	}

	$this->_check_length( $title, $desc, $this->_conf['desc_length'] );
}

function _check_textarea1_by_post($name, $title, $mode)
{
	$desc = '';
	if ( isset($_POST['weblinks_textarea1']) )
	{
		$desc = $_POST['weblinks_textarea1'];
	}

	$this->_check_length( $title, $desc, $this->_conf['desc_length_1'] );
}

function _check_length( $title, $str, $max )
{
// user & guest
	if ( !$this->_system->is_module_admin() &&( $max > 0 )&&( strlen($str) > $max ) ) 
	{
		$msg = sprintf( _WEBLINKS_ERROR_LENGTH, $title, $max );
		$this->_set_errors( $msg );
	}
}

function _check_cat_by_post( $name, $title, $mode)
{
	$flag_cid = false;
	foreach ($_POST['cid'] as $cid)
	{
		if ( intval($cid) != 0 )
		{	$flag_cid = true;	}
	}

	if ( !$flag_cid )
	{
		$msg = sprintf(_WLS_ERROR_FILL, $title);
		$this->_set_errors( $msg );
	}
}

function _check_mail_by_post( $name, $title, $mode, $is_owner=true )
{
	$flag_err = false;

	if (( $mode == 2 )&& $is_owner )
	{
		if ( !$this->_post->is_post_url_fill($name) )
		{
			$msg1 = sprintf( _WLS_ERROR_FILL, $title);
			$this->_set_errors( $msg1 );
			$flag_err = true;
		}
	}

	if ( $this->_conf['check_mail'] )
	{
		if ( !$this->_post->is_post_email_format($name) )
		{
			$msg1 = sprintf( _WLS_ERROR_ILLEGAL, $title);
			$this->_set_errors( $msg1 );
			$flag_err = true;
		}
	}

	if ( $flag_err )
	{
		return false;
	}
	return true;
}

function _check_passwd_by_post( $name, $title, $flag_new )
{
	$name1 = 'passwd_new';
	$name2 = 'passwd_2';

	if ( !isset( $_POST[$name1] ) || ( $_POST[$name1] == '') )
	{
		if ( $flag_new && $this->_conf['use_passwd'] && $this->_system->is_guest() )
		{
			$msg = sprintf(_WLS_ERROR_FILL, $title);
			$this->_set_errors( $msg );
			return false;
		}

		return true;	// no check
	}

	$pass1 = $this->_post->get_post_text( $name1 );
	$pass2 = $this->_post->get_post_text( $name2 );

	if ( strlen($pass1) < $this->_conf['passwd_min'] ) 
	{
		$msg = _WEBLINKS_ERROR.": ".sprintf(_US_PWDTOOSHORT, $this->_conf['passwd_min'] );
		$this->_set_errors( $msg );
		return false;
	}

	if ($pass1 != $pass2) 
	{
		$msg = _WEBLINKS_ERROR.": "._US_PASSNOTSAME;
		$this->_set_errors( $msg );
		return false;
	}

	return true;
}

function _check_captcha_by_post()
{
// check if geust
	if ( $this->_conf['use_captcha'] && file_exists(XOOPS_ROOT_PATH.'/modules/captcha/include/api.php') ) 
	{
		include_once XOOPS_ROOT_PATH.'/modules/captcha/include/api.php';
		if ( !$captcha_api->validate_post_if_guest() )
		{
			$this->_set_errors( _WEBLINKS_ERROR_CAPTCHA );
			return false;
		}
	}
	return true;
}

//---------------------------------------------------------
// check url
//---------------------------------------------------------
function _check_url_by_post( $name, $title, $mode, $flag_new)
{
	$this->_check_url_fill(   $name, $title, $mode );
	$this->_check_url_llegal( $name, $title, $mode );

	if ($flag_new)
	{
		$url = $this->get_post_url();
		$this->_check_url_double($url);
	}
}

function _check_banner_by_post( $name, $title, $mode )
{
	$this->_check_url_fill(   $name, $title, $mode );
	$this->_check_url_llegal( $name, $title, $mode );
}

// execute when use rssc module
function _check_rss_url_by_post( $name, $title, $mode )
{
	$flag_check_fill = false;

	switch ( $this->_post->get_post_int('rss_flag') )
	{
		case HAPPY_LINUX_RSS_MODE_RDF:
		case HAPPY_LINUX_RSS_MODE_RSS:
		case HAPPY_LINUX_RSS_MODE_ATOM:
		case HAPPY_LINUX_RSS_MODE_AUTO:
			$flag_check_fill = true;
			break;

		case HAPPY_LINUX_RSS_MODE_NON:
		default:
			$flag_check_fill = false;
			break;
	}

	if ( $flag_check_fill )
	{
		$this->_check_url_fill( $name, $title, $mode );
	}

	$this->_check_url_llegal( $name, $title, $mode );
}

function _check_url_fill( $name, $title, $mode )
{
	if ( $mode == 2 )
	{
		if ( !$this->_post->is_post_url_fill($name) )
		{
			$msg = sprintf( _WLS_ERROR_FILL, $title );
			$this->_set_errors( $msg );
			return false;
		}
	}
	return true;
}

function _check_url_llegal( $name, $title, $mode )
{
	if ( !$this->_post->is_post_url_llegal($name) )
	{
		$msg = sprintf( _WLS_ERROR_ILLEGAL, $title );
		$this->_set_errors( $msg );
		return false;
	}
	return true;
}

function _check_url_double($url)
{
	$this->error_msg_flag_lid_full = 0;
	$this->error_msg_flag_lid_part = 0;
	$this->error_msg_lid_arr_full  = array();
	$this->error_msg_lid_arr_part  = array();

	if ( $this->_conf['check_double'] >= 1 )
	{
		$ret = $this->_check_url_full( $url );
		if ( !$ret )
		{
			return false;	// error
		}
	}

	if ( $this->_conf['check_double'] == 2 )
	{
		$ret = $this->_check_url_part( $url );
		if ( !$ret )
		{
			return false;	// warning
		}
	}

	return true;	// OK
}

function _check_url_full($url)
{
	if (( $url == "" )||( $url == "http://" ))
	{	return true;	}	// no check

	$this->error_msg_lid_arr_full =& $this->_get_link_lid_array_by_url($url);

	if ( count($this->error_msg_lid_arr_full) ) 
	{

// BUG: check_url_double dont work correctly
		$this->_set_error_flag();

		$this->error_msg_flag_lid_full = 1;
		return false;	// NG
	}

	return true;	// OK
}

function _check_url_part($url)
{
	if (( $url == "" )||( $url == "http://" ))
	{	return true;	}	// no check

	$arr_out = array();

	$lid_arr =& $this->_get_link_lid_array();

	foreach ($lid_arr as $lid)
	{
		$flag = 0;

		$obj = $this->get($lid);
		if ( !is_object($obj) )  { continue; }

		$url_db   = $obj->get('url');
		$url_db_r = str_replace("|", '\|', $url_db);
		$url_r    = str_replace("|", '\|', $url);

		if ( preg_match("|$url_db_r|", $url) )
		{	$flag = 1;	}

		if ( preg_match("|$url_r|", $url_db) )
		{	$flag = 1;	}

		if ($flag)
		{
			$arr_out[] = $lid;
		}
	}

	$this->error_msg_lid_arr_part = $arr_out;
	if ( count($this->error_msg_lid_arr_part) > 0 ) 
	{
		$this->_set_error_flag();
		$this->error_msg_flag_lid_part = 1;
		return false;	// NG
	}

	return true;	// OK
}

//---------------------------------------------------------
// approve_mod
//---------------------------------------------------------
function _check_form_approve_mod_user()
{
	$lid =  $this->_post->get_post_int('lid');
	$obj =& $this->_link_handler->get( $lid );
	if ( !is_object($obj) )
	{
		$msg = _NO_LINK .': lid = '. $lid;
		$this->_set_errors( $msg );
		return false;
	}

	$this->_check_confirm( 'uid',  $obj );
	$this->_check_confirm( 'name', $obj );
	$this->_check_confirm( 'mail', $obj );
}

function _check_confirm( $name, &$obj )
{
	$confirm_name = $name.'_confirm';

// the post value is different from the value in link table
	if ( !$this->_post->get_post_int( $confirm_name ) &&
	   (  $this->_post->get_post_text( $name ) != $obj->get( $name ) )) 
	{
		$title = $this->_get_linkitem_by_name( $name, 'title' );
		$msg   = sprintf( _AM_WEBLINKS_WARN_CONFIRM, $title );
		$this->_set_errors( $msg );
		return false;
	}

	return true;
}

//---------------------------------------------------------
// error message
//---------------------------------------------------------
function &get_errors_addlink( $format='n' )
{
	$ret  = null;
	if ( $this->_error_flag )
	{
		$ret = $this->getErrors( $format );
	}

	$text = '';
	if ( $this->error_msg_flag_lid_full ) 
	{
		$text .= "<br />" . _WLS_ERROR_URL_EXIST . "<br />\n";
		$text .= $this->_build_html_error_url( $this->error_msg_lid_arr_full );
	}
	if ( $this->error_msg_flag_lid_part ) 
	{
		$text .= "<br />" . _WLS_WARNING_URL_EXIST . "<br />\n";
		$text .= $this->_build_html_error_url( $this->error_msg_lid_arr_part );
	}
	$this->_formated_error_addlink = $text;

	return $ret;
}

function get_formated_error_addlink()
{
	return $this->_formated_error_addlink;
}

function &get_errors_modlink( $format='n' )
{
	$ret = $this->getErrors( $format );
	return $ret;
}

function _build_html_error_url($lid_arr)
{
	$text = "<ul>";

	foreach( $lid_arr as $lid )
	{
		$text .= $this->_build_html_error_url_single($lid);
	}

	$text .= "</ul>\n";

	return $text;
}

function _build_html_error_url_single($lid)
{
	$obj = $this->_link_handler->get($lid);
	if ( !is_object($obj) )  { return ''; }

	$title_s = $obj->getVar('title');
	$lid_s   = sprintf("%03d", $lid);
	$url_single = WEBLINKS_URL.'/singlelink.php?lid='.$lid;
	$text = '<li><a href="'.$url_single.'" target="_blank">'.$lid_s.': '.$title_s."</a></li>\n";
	return $text;
}

//---------------------------------------------------------
// link_handler
//---------------------------------------------------------
function &_get_link_lid_array()
{
	$ret =& $this->_link_handler->getList();
	return $ret;
}

function &_get_link_lid_array_by_url($url)
{
	$criteria = new criteriaCompo();
	$criteria->add( new criteria('url', $url, '=') );
	$ret =& $this->_link_handler->getList($criteria);
	return $ret;
}

//---------------------------------------------------------
// linkitem_define_handler
//---------------------------------------------------------
function &_get_linkitem_load()
{
	$ret =& $this->_linkitem_handler->load();
	return $ret;
}

function _get_linkitem_by_itemid($id, $key)
{
	return $this->_linkitem_handler->get_by_itemid($id, $key);
}

function _get_linkitem_by_name($name, $key)
{
	return $this->_linkitem_handler->get_by_name($name, $key);
}

// --- class end ---
}

// === class end ===
}

?>