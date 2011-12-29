<?php
// $Id: weblinks_link_edit_base_handler.php,v 1.1 2011/12/29 14:33:06 ohwada Exp $

// 2008-02-17 K.OHWADA
// _get_flag_pagerank()

// 2007-11-20 K.OHWADA
// BUG : Fatal error: Call to a member function create_new_rssc_obj() on a non-object

// 2007-11-01 K.OHWADA
// get_token_pair()
// link_view_handler => link_view

// 2007-09-20 K.OHWADA
// remote_image -> remote_file

// 2007-09-10 K.OHWADA
// divid from weblinks_link_edit_handler.php

//=========================================================
// WebLinks Module
// 2006-05-15 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('weblinks_link_edit_base_handler') ) 
{

//=========================================================
// class weblinks_link_edit_base
//=========================================================
class weblinks_link_edit_base_handler extends happy_linux_error
{
	var $_DIRNAME;

	var $_config_handler;
	var $_link_catlink_handler;
	var $_link_handler;
	var $_category_handler;
	var $_catlink_handler;
	var $_banner_handler;

	var $_rssc_edit_handler;
	var $_notification;

	var $_system;
	var $_post;
	var $_form;
	var $_strings;
	var $_remote_file;

	var $_conf;

// result
	var $_newid;
	var $_save_obj  = null;
	var $_cid_array = array();

	var $_banner_error_code = 0;
	var $_banner_errors     = null;
	var $_rssc_error_code   = 0;

	var $_DEBUG_MODIFY_DELETE = true;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_link_edit_base_handler( $dirname )
{
	$this->_DIRNAME = $dirname;

	$this->happy_linux_error();

	$this->_config_handler       =& weblinks_get_handler( 'config2_basic',      $dirname );
	$this->_link_catlink_handler =& weblinks_get_handler( 'link_catlink_basic', $dirname );
	$this->_category_handler     =& weblinks_get_handler( 'category',  $dirname );
	$this->_link_handler         =& weblinks_get_handler( 'link',      $dirname );
	$this->_catlink_handler      =& weblinks_get_handler( 'catlink',   $dirname );
	$this->_banner_handler       =& weblinks_get_handler( 'banner',    $dirname );
	$this->_notification         =& weblinks_notification::getInstance( $dirname );

	$this->_system       =& happy_linux_system::getInstance();
	$this->_post         =& happy_linux_post::getInstance();
	$this->_form         =& happy_linux_form::getInstance();
	$this->_strings      =& happy_linux_strings::getInstance();
	$this->_remote_file  =& happy_linux_remote_file::getInstance();

	if ( WEBLINKS_RSSC_USE )
	{
		$this->_rssc_edit_handler =& weblinks_get_handler( 'rssc_edit', $dirname );
	}

	$this->_conf = $this->_config_handler->get_conf();
}

//---------------------------------------------------------
// POST param
//---------------------------------------------------------
function get_post_lid()
{
	return $this->_post->get_post_int('lid');
}

function get_post_mid()
{
	return $this->_post->get_post_get_int('mid');
}

function get_post_url()
{
	return $this->_post->get_post_text('url');
}

function get_post_rss_flag()
{
	return $this->_post->get_post_int('rss_flag');
}


//---------------------------------------------------------
// wrapper of link_handler
//---------------------------------------------------------
function &get($lid)
{
	$lid = intval($lid);
	$obj =& $this->_link_handler->get($lid);
	return $obj;
}

function check_exist_link($lid)
{
	$obj =& $this->get($lid);
	if ( is_object($obj) )
	{
		return true;
	}
	return false;
}

function getCount()
{
	$count = $this->_link_handler->getCount();
	return $count;
}

function insert( &$obj )
{
	$newid = $this->_link_handler->insert( $obj );
	return $newid;
}

//---------------------------------------------------------
// update banner size
//---------------------------------------------------------
// link_manage_class.php
function update_banner_and_size_by_post()
{
	$lid = $this->get_post_lid();

	$obj =& $this->get($lid);
	if ( !is_object($obj) )
	{	return false;	}

	$obj->set_var_by_global_post('banner');
	$obj->set_var_by_global_post('width');
	$obj->set_var_by_global_post('height');

	$ret = $this->_link_handler->update($obj);
	return $ret;
}

// link_manage_class.php
function &get_remote_banner_size($banner)
{
	$size =& $this->_banner_handler->get_remote_banner_size( $banner );
	if (!$size)
	{
		$this->_banner_error_code = $this->_banner_handler->getErrorCode();
		$this->_banner_errors     = $this->_banner_handler->getErrors();
	}
	return $size;
}

//---------------------------------------------------------
// get param
//---------------------------------------------------------
function get_banner_error_code()
{
	return $this->_banner_error_code;
}

function get_banner_errors()
{
	return $this->_banner_errors;
}

function get_rssc_error_code()
{
	return $this->_rssc_error_code;
}

function check_preview_result()
{
	return $this->returnExistError();
}

function get_error_msg_preview( $format='s' )
{
	return $this->getErrors($format);
}

//---------------------------------------------------------
// check POST param & set error
//---------------------------------------------------------
function build_comment($str)
{
	$text = ' <!-- weblinks : '.$str.' -->'."\n";
	return $text;
}

//---------------------------------------------------------
// category table
//---------------------------------------------------------
function init()
{
	$this->_category_handler->load();
}

// link_manage_class
function update_category_link_count()
{
	$cat_objs = $this->_category_handler->get_objects_all();

	foreach ($cat_objs as $obj) 
	{
		$cid   =  $obj->getVar('cid');
		$arr   =& $this->_category_handler->get_parent_and_all_child_id($cid);
		$count =  $this->_link_catlink_handler->get_count_by_cid_array($arr);

		$obj->setVar('link_count', $count);

		$ret =  $this->_category_handler->update($obj);
		if (!$ret)
		{
			$this->_set_errors( $this->_category_handler->getErrors() );
		}
	}

	return $this->returnExistError();
}

//---------------------------------------------------------
// modify table
//---------------------------------------------------------
// modify_new_class.
function delete_modify( &$modify_obj )
{
	if ( $this->_DEBUG_MODIFY_DELETE )
	{
		$modify_handler =& weblinks_get_handler( 'modify', $this->_DIRNAME );
		$ret = $modify_handler->delete( $modify_obj );
		if ( !$ret )
		{
			$this->_set_errors( $modify_handler->getErrors() );
			return $false;
		}
	}
	return true;
}

//---------------------------------------------------------
// link view
// caller : modify.php admin/link_del.php
//---------------------------------------------------------
function build_show_link( $lid )
{
	$link_view =& weblinks_link_view::getInstance( $this->_DIRNAME );
	$template  =& weblinks_template::getInstance(  $this->_DIRNAME );
	$link =& $link_view->get_show_by_lid( $lid );
	$text =  $template->fetch_link_single( $link );
	return $text;
}

function build_style_sheet()
{
	$url  = XOOPS_URL.'/modules/'.$this->_DIRNAME.'/'.'weblinks.css';
	$text = $this->_form->build_html_link_stylesheet( $url );
	return $text;
}

//---------------------------------------------------------
// token ticket
//---------------------------------------------------------
// return html format
function build_token()
{
	return $this->_form->build_token();
}

// return ( name, value )
function &get_token_pair()
{
	return $this->_form->get_token_pair();
}

function check_token()
{
	return $this->_form->check_token();
}

//=========================================================
// protected
//=========================================================
function &_create()
{
	return $this->_link_handler->create();
}

function &_create_view()
{
	$view_obj =& new weblinks_link_view( $this->_DIRNAME );
	return $view_obj;
}

function &_create_edit()
{
	$edit_obj =& new weblinks_link_edit( $this->_DIRNAME );
	return $edit_obj;
}

function &_create_link_save($isNew = true)
{
	$obj =& new weblinks_link_save( $this->_DIRNAME );
	if ($isNew)
	{	$obj->setNew();	}
	return $obj;
}

//---------------------------------------------------------
// check url banner rssurl
//---------------------------------------------------------
function _check_url_banner_rssurl( &$obj )
{
	$this->_clear_errors();

	$url = $obj->get('url');

// check connect url
	if ( $url )
	{
		if ( !$this->_remote_file->check_url($url) )
	 	{
	 		$this->_set_errors( '<span style="color: #ff0000;">'._WEBLINKS_WARN_NOT_READ_URL."</span>" );
	 	}
	}

// banner error
	if ( $this->_banner_error_code )
	{
 		$this->_set_errors( '<span style="color: #ff0000;">'._WEBLINKS_WARN_BANNER_NOT_GET_SIZE."</span>" );
	}

	$rss_flag = 0;
	$rss_url  = '';

// BUG : Fatal error: Call to a member function create_new_rssc_obj() on a non-object
	if ( WEBLINKS_RSSC_USE )
	{
		list($rss_flag, $rss_url) = $this->_check_rssurl();
	}

	return array($rss_flag, $rss_url);
}

//---------------------------------------------------------
// pagrank
//---------------------------------------------------------
function _get_flag_pagerank()
{
	if ( $this->_conf['use_pagerank'] > 0 )
	{	return true;	}
	return false;
}

//---------------------------------------------------------
// rssc_edit_handler
//---------------------------------------------------------
function _check_rssurl()
{
	$rss_flag = 0;
	$rss_url  = '';

// create rssc object
	$rssc_obj =& $this->_rssc_edit_handler->create_new_rssc_obj();
	if ( is_object($rssc_obj) )
	{
		$code     = $rssc_obj->get('auto_code');
		$rss_flag = $rssc_obj->get('rss_flag');
		$rss_url  = $rssc_obj->get('show_rss_url');

// discover
		switch ( $code )
		{
			case RSSC_CODE_DISCOVER_SUCCEEDED:
				 $this->_set_errors( '<b>'._RSSC_DISCOVER_SUCCEEDED."</b>" );
				break;

			case RSSC_CODE_DISCOVER_FAILED:
				 $this->_set_errors( '<span style="color: #ff0000;">'._RSSC_DISCOVER_FAILED."</span>" );
				break;
		}

// check connect rss url
		if ( $rss_url )
		{
			if ( !$this->_remote_file->check_url($rss_url) )
		 	{
		 		$this->_set_errors( '<span style="color: #ff0000;">'._RSSC_PARSE_NOT_READ_XML_URL."</span>" );
		 	}
		}
	}

	return array($rss_flag, $rss_url);
}

function _set_errors_not_exist($lid)
{
	$msg = _NO_LINK .': lid = '. $lid;
	$this->_set_errors( $msg );
}

// --- class end ---
}

// === class end ===
}

?>