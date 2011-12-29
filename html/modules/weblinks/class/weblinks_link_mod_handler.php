<?php
// $Id: weblinks_link_mod_handler.php,v 1.1 2011/12/29 14:33:03 ohwada Exp $

// 2008-02-17 K.OHWADA
// _get_flag_pagerank()

// 2007-11-01 K.OHWADA
// broken_handler

// 2007-09-10 K.OHWADA
// divid from weblinks_link_edit_handler.php

//=========================================================
// WebLinks Module
// 2006-05-15 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('weblinks_link_mod_handler') ) 
{

//=========================================================
// class weblinks_link_mod_handler
//=========================================================
class weblinks_link_mod_handler extends weblinks_link_edit_base_handler
{
	var $_broken_handler;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_link_mod_handler( $dirname )
{
	$this->weblinks_link_edit_base_handler( $dirname );

	$this->_broken_handler =& weblinks_get_handler( 'broken', $dirname );
}

//---------------------------------------------------------
// modify link
//---------------------------------------------------------
function user_mod_link( $lid )
{
	$ret = $this->_mod_link_common( $lid, true );
	if ( !$ret )
	{
		return false;
	}

	if ( $this->_conf['cat_count'] )
	{
		$this->update_category_link_count();
	}

	if ( WEBLINKS_RSSC_USE )
	{
		$ret = $this->_rssc_edit_handler->mod_rssc( $lid );
		if ( $ret != 0 )
		{
			$this->_set_errors( $this->_rssc_edit_handler->getErrors() );
		}
		$this->_rssc_error_code = $ret;
	}

	return true;
}

function admin_mod_link( $lid )
{
	$ret = $this->_mod_link_common( $lid, false );
	if ( !$ret )
	{
		return false;
	}

// delete broken
	$ret = $this->_delete_broken_by_lid( $lid );

	return true;
}

function admin_approve_mod_link( &$modify_obj )
{
	$lid = $modify_obj->get('lid');
	$this->_mod_link_common( $lid, true );

// delete modify
	$this->delete_modify( $modify_obj );

	if ( $this->_conf['cat_count'] )
	{
		$this->update_category_link_count();
	}

	return $this->returnExistError();
}

//---------------------------------------------------------
// preview
//---------------------------------------------------------
function build_modify_preview( $lid )
{
	$this->_clear_errors();

	$rss_flag = 0;
	$rss_url  = '';

// create link object
	$obj =& $this->_create_mod_link_by_post( $lid, true );

// check url, banner & check rss url
	list($rss_flag, $rss_url) = $this->_check_url_banner_rssurl( $obj );

// create edit object
	$edit_obj =& $this->_create_edit();
	$edit_obj->set_object($obj);
	$edit_obj->build_preview_for_template( $this->_cid_array );

	$edit_obj->set('rss_flag', $rss_flag);
	$edit_obj->set('rss_url',  $this->_strings->sanitize_url($rss_url) );

	$show =& $edit_obj->get_vars();

	return $show;
}

//---------------------------------------------------------
// private
//---------------------------------------------------------
// mod link & catlink
function _mod_link_common( $lid, $flag_banner=false )
{
	$this->_clear_errors();

	$ret = $this->_mod_link_record( $lid, $flag_banner );
	if ( !$ret )
	{
		return false;
	}

	$ret = $this->_catlink_handler->delete_by_lid($lid);
	if ( !$ret )
	{
		$this->_set_errors( $this->_catlink_handler->getErrors() );
	}

	$ret = $this->_catlink_handler->add_link_by_lid_cid_array( $lid, $this->_cid_array );
	if ( !$ret )
	{
		$this->_set_errors( $this->_catlink_handler->getErrors() );
	}

	return $this->returnExistError();
}

function _mod_link_record( $lid, $flag_banner=false )
{
	$save_obj =& $this->_create_mod_link_by_post( $lid, $flag_banner );
	if ( !is_object($save_obj) )
	{
		$this->_set_errors_not_exist($lid);
		return false;
	}

	$ret = $this->_link_handler->update($save_obj);
	if ( !$ret )
	{
		$this->_set_errors( $this->_link_handler->getErrors() );
		return false;
	}

	$this->_save_obj =& $save_obj;
	return true;
}

function &_create_mod_link_by_post( $lid, $flag_banner=false )
{
	$link_obj =& $this->get($lid);
	if ( !is_object($link_obj) )
	{
		$false = false;
		return $false;
	}

	$save_obj =& $this->_create_link_save();
	$save_obj->assignVars( $link_obj->gets() );
	$save_obj->assign_mod_object(
		$_POST, false, $flag_banner, $this->_get_flag_pagerank() );

	$this->_cid_array         =& $save_obj->get_cid_array();
	$this->_banner_error_code =  $save_obj->get_banner_error_code();
	$this->_banner_errors     =  $save_obj->get_banner_errors();

	return $save_obj;
}

function _delete_broken_by_lid( $lid )
{
	$broken_count = $this->_broken_handler->get_count_by_lid( $lid );
	if ( $broken_count > 0 )
	{
		$ret = $this->_broken_handler->delete_by_lid( $lid );
		if ( !$ret )
		{
			$this->_set_errors( $this->_broken_handler->getErrors() );
			return false;
		}
	}
	return true;
}

// --- class end ---
}

// === class end ===
}

?>