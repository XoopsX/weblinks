<?php
// $Id: weblinks_link_add_handler.php,v 1.1 2011/12/29 14:33:06 ohwada Exp $

// 2008-02-17 K.OHWADA
// _get_flag_pagerank()

// 2007-09-10 K.OHWADA
// divid from weblinks_link_edit_handler.php

//=========================================================
// WebLinks Module
// 2006-05-15 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('weblinks_link_add_handler') ) 
{

//=========================================================
// class weblinks_link_add_handler
//=========================================================
class weblinks_link_add_handler extends weblinks_link_edit_base_handler
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_link_add_handler( $dirname )
{
	$this->weblinks_link_edit_base_handler( $dirname );
}

//---------------------------------------------------------
// add link
//---------------------------------------------------------
function user_add_link()
{
	$newid = $this->_add_link_common( true );
	if ( !$newid )
	{
		return false;
	}

	if ( $this->_conf['cat_count'] )
	{
		$this->update_category_link_count();
	}

	global $xoopsUser;
	if ( $this->_conf['system_post_link'] && is_object($xoopsUser) ) 
	{
		$xoopsUser->incrementPost();
	}

	if ( WEBLINKS_RSSC_USE && $this->get_post_rss_flag() )
	{
		$ret = $this->_rssc_edit_handler->add_rssc( $newid );
		if ( $ret != 0 )
		{
			$this->_set_errors( $this->_rssc_edit_handler->getErrors() );
		}
		$this->_rssc_error_code = $ret;
	}

	$this->_notification->notify_newlink_admin( $newid, $this->_save_obj,  $this->_cid_array );

	return $newid;
}

function admin_add_link()
{
	return $this->_add_link_common( false );
}

function admin_approve_new_link( &$modify_obj )
{
	$newid = $this->_add_link_common( true );
	if ( !$newid )
	{
		return false;
	}

	$this->delete_modify( $modify_obj );

	if ( $this->_conf['cat_count'] )
	{
		$this->update_category_link_count();
	}

	$this->_newid = $newid;
	return $newid;
}

function admin_clone_link( $lid )
{
	$obj =& $this->_link_handler->get( $lid );
	if ( !is_object($obj) )
	{
		$this->_set_errors_not_exist($lid);
		return false;
	}

	$cid_arr =& $this->_catlink_handler->get_cid_array_by_lid( $lid );

	return $this->_clone_link_common( $obj, $cid_arr );
}

function admin_clone_module_from( $module_id, $lid )
{
	$module =& $this->_system->get_module_by_mid( $module_id );
	if ( !is_object($module) )
	{
		$msg = "no module module_id = ".$module_id;
		$this->_set_errors( $msg );
		return false;
	}

	$dirname = $module->getVar('dirname', 'n');

	$other_link_handler =& weblinks_get_handler( 'link', $dirname );

	$obj =& $other_link_handler->get( $lid );
	if ( !is_object($obj) )
	{
		$this->_set_errors_not_exist( $lid );
		return false;
	}

// category is unkonown because the module is different
	$cid_arr = array();

	return $this->_clone_link_common( $obj, $cid_arr );
}

//---------------------------------------------------------
// preview
//---------------------------------------------------------
function build_submit_preview()
{
	$this->_clear_errors();

	$rss_flag = 0;
	$rss_url  = '';

// create link object
	$obj =& $this->_create_add_link_by_arr( $_POST, false, true );

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
// add link & catlink & notify
function _add_link_common( $flag_banner=false )
{
	$newid = $this->_add_link_record( $flag_banner );
	if ( !$newid )
	{
		return false;
	}

	$ret = $this->_catlink_handler->add_link_by_lid_cid_array( $newid, $this->_cid_array );
	if ( !$ret )
	{
		$this->_set_errors( $this->_catlink_handler->getErrors() );
		return false;
	}

	if ( $this->_save_obj->check_public( $this->_conf['broken_threshold'] ) )
	{
		$this->_notification->notify_newlink( $newid, $this->_save_obj, $this->_cid_array );
	}

	return $newid;
}

function _clone_link_common( &$obj, &$cid_arr )
{
	$title = '[clone] '.$obj->get('title');

	$obj->setNew();
	$obj->setVar('lid',      0);
	$obj->setVar('rssc_lid', 0);
	$obj->setVar('title',    $title);

	$newid = $this->_link_handler->insert( $obj );
	if ( !$newid )
	{
		$this->_set_errors( $this->_link_handler->getErrors() );
		return false;
	}

	$this->_newid     =  $newid;
	$this->_save_obj  =& $obj;
	$this->_cid_array =& $cid_arr;

	$ret = $this->_catlink_handler->add_link_by_lid_cid_array( $newid, $this->_cid_array );
	if ( !$ret )
	{
		$this->_set_errors( $this->_catlink_handler->getErrors() );
		return false;
	}

	return $newid;
}

function _add_link_record( $flag_banner=false )
{
// modify
	$this->_mid = $this->get_post_mid();

	$save_obj =& $this->_create_add_link_by_arr( $_POST, false, $flag_banner );

	$newid = $this->_link_handler->insert( $save_obj );
	if ( !$newid )
	{
		$this->_set_errors( $this->_link_handler->getErrors() );
		return false;
	}

	$this->_newid    =  $newid;
	$this->_save_obj =& $save_obj;

	return $newid;
}

// $not_gpc for bulk manage
function &_create_add_link_by_arr( &$post, $not_gpc=false, $flag_banner=false )
{
	$save_obj =& $this->_create_link_save();
	$save_obj->assign_add_object(
		$post, $not_gpc, $flag_banner, $this->_get_flag_pagerank() );

	$this->_cid_array         =& $save_obj->get_cid_array();
	$this->_banner_error_code =  $save_obj->get_banner_error_code();
	$this->_banner_errors     =  $save_obj->get_banner_errors();

	return $save_obj;
}

// --- class end ---
}

// === class end ===
}

?>