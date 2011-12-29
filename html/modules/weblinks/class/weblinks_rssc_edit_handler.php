<?php
// $Id: weblinks_rssc_edit_handler.php,v 1.1 2011/12/29 14:33:07 ohwada Exp $

// 2007-09-10 K.OHWADA
// create_new_rssc_obj()
// return error_code in mod_link() 
// BUG: add rssc link double

// 2007-06-01 K.OHWADA
// api/refresh.php

// 2006-10-05 K.OHWADA
// this is new file

//=========================================================
// WebLinks Module
// 2006-10-05 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('weblinks_rssc_edit_handler') ) 
{

//=========================================================
// class weblinks_rssc_edit_handler
//=========================================================
// _RSSC_REFRESH_FINISHED
//---------------------------------------------------------
class weblinks_rssc_edit_handler extends happy_linux_error
{
	var $_FLAG_DEBUG = false;

// handler
	var $_link_handler;
	var $_rssc_handler;
	var $_rssc_form;

	var $_link_obj;
	var $_rssc_obj;

	var $_ret_check_param   = false;
	var $_ret_check_exist   = false;
	var $_ret_code_discover = 0;
	var $_rssc_exist_lid    = 0;
	var $_rssc_newid        = 0;
	var $_parse_result      = null;
	var $_exist_list_msg    = null;

	var $_form_mode = null;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_rssc_edit_handler( $dirname )
{
	$this->happy_linux_error();

	$this->_link_handler =& weblinks_get_handler('link', $dirname );
	$this->_rssc_handler =& weblinks_get_handler('rssc', $dirname );
	$this->_rssc_form    =& weblinks_rssc_form::getInstance();

}

//---------------------------------------------------------
// create rssc object
//---------------------------------------------------------
function _set_form_mode( $val )
{
	$this->_form_mode = $val;
}

function &create_new_rssc_obj( $lid=0, $form_mode=null )
{
	return $this->_rssc_handler->create_new_rssc_obj( $lid, $form_mode );
}

//---------------------------------------------------------
// user submit
//---------------------------------------------------------
function add_rssc( $lid )
{
// create object
	$rssc_obj =& $this->create_new_rssc_obj( $lid );

// if already exist in rssc module
	$rssc_lid = $this->_rssc_handler->check_get_rssc_exist_lid( $rssc_obj );
	if ( $rssc_lid )
	{

// --- update existed rssc_lid to link ---	
		$ret = $this->_link_handler->update_rssc_lid( $lid, $rssc_lid );
		if ( !$ret )
		{
			$this->_set_errors( $this->_link_handler->getErrors() );
			return WEBLINKS_CODE_DB_ERROR;
		}

// BUG: add rssc link double
		return RSSC_CODE_LINK_ALREADY;
	}

// check param
	$code = $rssc_obj->check_necessary_param();
	if ( $code != 0 )
	{
		return $code;
	}

// === add new record to rssc link table ===
	$rssc_newid = $this->_rssc_handler->add_link( $rssc_obj );
	if ( !$rssc_newid )
	{
		$this->_set_errors( $this->_rssc_handler->getErrors() );
		return WEBLINKS_CODE_DB_ERROR;
	}

// --- update new rssc_lid to link ---
	$ret = $this->_link_handler->update_rssc_lid( $lid, $rssc_newid );
	if ( !$ret )
	{
		$this->_set_errors( $this->_link_handler->getErrors() );
		return WEBLINKS_CODE_DB_ERROR;
	}

// refresh rss feeds
	$ret = $this->_refresh_link( $rssc_newid );
	return $ret;	// dummy
}


function _refresh_link( $rssc_lid )
{

// === refresh rss feeds ===
	$ret = $this->_rssc_handler->refresh_link_for_add_link( $rssc_lid );
	switch ( $ret )
	{
		case 0:
			break;

		case RSSC_CODE_PARSE_MSG:
			$this->_parse_result = $this->_rssc_handler->get_parse_result();
			if ( $this->_FLAG_DEBUG )
			{
				echo _RSSC_REFRESH_FINISHED."<br />\n";
			}
			break;

		case RSSC_CODE_DB_ERROR:
			$ret = WEBLINKS_CODE_DB_ERROR;
			$this->_set_errors( $this->_rssc_handler->getErrors() );
			break;

		case RSSC_CODE_PARSE_FAILED:
		case RSSC_CODE_REFRESH_ERROR:
		default:
			$this->_set_errors( $this->_rssc_handler->getErrors() );
			break;
	}

	if ( $this->_FLAG_DEBUG && ($ret != 0) )
	{
		echo $this->getErrors(1);
	}

	return $ret;
}

function get_parse_result()
{
	return $this->_parse_result;
}

//---------------------------------------------------------
// user modify
//---------------------------------------------------------
function mod_rssc( $lid )
{
// create object
	$rssc_obj =& $this->_rssc_handler->create_rssc_obj_by_lid( $lid );

// when not set rssc_lid
	$rssc_lid_saved = $rssc_obj->get('rssc_lid');
	if ( $rssc_lid_saved == 0 )
	{

// if already exist in rssc module
		$rssc_lid_exist = $this->_rssc_handler->check_get_rssc_exist_lid( $rssc_obj );
		if ( $rssc_lid_exist )
		{

// --- update existed rssc_lid to link ---	
			$ret = $this->_link_handler->update_rssc_lid( $lid, $rssc_lid_exist );
			if ( !$ret )
			{
				$this->_set_errors( $this->_link_handler->getErrors() );
				return WEBLINKS_CODE_DB_ERROR;
			}

// BUG: add rssc link double
			return RSSC_CODE_LINK_ALREADY;
		}
	}

// when set rssc_lid
	if ( $rssc_lid_saved )
	{
// check param
		$code = $rssc_obj->check_necessary_param( 'mod' );
		if ( $code != 0 )
		{
			return $code;
		}

// === add new record to rssc link table ===
		$rssc_newid = $this->_rssc_handler->mod_link( $rssc_obj );
		if ( !$rssc_newid )
		{
			$this->_set_errors( $this->_rssc_handler->getErrors() );
			return $this->_rssc_handler->get_error_code();
		}
	}

// when not set rssc_lid
	else
	{
// check param
		$code = $rssc_obj->check_necessary_param( 'add' );
		if ( $code != 0 )
		{
			return $code;
		}

// === add new record to rssc link table ===
		$rssc_newid = $this->_rssc_handler->add_link( $rssc_obj );
		if ( !$rssc_newid )
		{
			$this->_set_errors( $this->_rssc_handler->getErrors() );
			return WEBLINKS_CODE_DB_ERROR;
		}

// --- update new rssc_lid to link ---
		$ret = $this->_link_handler->update_rssc_lid( $lid, $rssc_newid );
		if ( !$ret )
		{
			$this->_set_errors( $this->_link_handler->getErrors() );
			return WEBLINKS_CODE_DB_ERROR;
		}

// refresh rss feeds
		$ret = $this->_refresh_link( $rssc_newid );
		return $ret;	// dummy
	}

	return 0;	// dummy
}

//---------------------------------------------------------
// link_handler
//---------------------------------------------------------
function get_title_rssurl( $lid )
{
	$title_s = '';
	$rss_url = '';
	$link_obj =& $this->_link_handler->get( $lid );
	if ( is_object($link_obj) )
	{
		$title_s  = $link_obj->getVar('title', 's');
		$rssc_lid = $link_obj->get('rssc_lid');
		$rssc_link_obj =& $this->get_rssc_link_obj( $rssc_lid );
		if ( is_object($rssc_link_obj) )
		{
			$rss_url = $rssc_link_obj->get_rssurl_by_mode();
		}
	}
	return array($title_s, $rss_url);
}

function &get_rssc_link_obj( $rssc_lid )
{
	$obj =& $this->_rssc_handler->get_rssc_link($rssc_lid);
	return $obj;
}


function _update_rssc_lid_by_new_rssc_lid()
{
	$lid = $this->_rssc_obj->get('link_lid');
	$ret = $this->_update_rssc_lid( $lid, $this->_rssc_newid );
	if (!$ret)
	{
		return false;
	}
	return true;
}

function _update_rssc_lid( $lid, $rssc_lid )
{
	$obj =& $this->get_link_obj( $lid );
	if ( !is_object($obj) )
	{
		return false;
	}

	$obj->setVar('rssc_lid', $rssc_lid);

	$ret = $this->_link_handler->update($obj);
	if ( !$ret )
	{
		$this->_set_errors( $this->_link_handler->getErrors() );
		return false;
	}

// set new object value
	$this->_link_obj =& $obj;
	$this->_create_rssc_obj_by_lid( $lid );

	return true;
}

//---------------------------------------------------------
// show form
//---------------------------------------------------------
function show_form_add_rssc( $op_mode )
{
	$this->_rssc_form->show_add_rssc( $this->_rssc_obj, $op_mode );
}

function show_form_refresh_link( $op_mode )
{
	$this->_rssc_form->show_refresh_link( $this->_rssc_newid, $op_mode );
}

// --- class end ---
}

// === class end ===
}

?>