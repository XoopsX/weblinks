<?php
// $Id: modify_mod_class.php,v 1.1 2011/12/29 14:32:52 ohwada Exp $

// 2007-11-01 K.OHWADA
// set_edit_handler()
// WEBLINKS_OP_APPROVE_MOD

// 2007-09-10 K.OHWADA
// general revision
// divid from modify_manage_class.php

//=========================================================
// admin modify
// 2006-09-01 K.OHWADA
//=========================================================

//=========================================================
// class admin_modify_mod
//=========================================================
class admin_modify_mod extends admin_modify_base
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_modify_mod()
{
	$this->admin_modify_base();
	$this->set_edit_handler( 'link_mod' );
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_modify_mod();
	}
	return $instance;
}

//---------------------------------------------------------
// list Modify Request
//---------------------------------------------------------
function list_mod()
{
	$total = $this->_handler->get_count_mod();
	$mid   = $this->get_post_mid();

	if ( $total > 0 ) 
	{
		if ( $mid > 0 )
		{
			$obj =& $this->_handler->get($mid);
			if ( !is_object($obj) )
			{
// goto list_mod
				redirect_header("modify_list.php?op=list_mod", 3, _WLS_ERRORNOLINK );
				exit();
			}
		}
		else
		{
			$mid_arr = $this->_handler->get_mid_array_mod(1);
			if ( !isset($mid_arr[0]) )
			{
				redirect_header("modify_list.php", 3, _WLS_ERRORNOLINK );
				exit();
			}
			$mid = $mid_arr[0];
		}

		$total_s = $this->_form->build_html_highlight_number($total);

		$this->_print_cp_header();
		$this->_print_bread_op( _WLS_MODREQUESTS, 'list_mod');
		echo "<h4>"._WLS_MODREQUESTS."</h4>\n";
		echo sprintf(_HAPPY_LINUX_THERE_ARE, $total_s)."<br /><br />\n";
		$this->_form->show_admin_mod_approve_form( WEBLINKS_OP_APPROVE_MOD, $mid);
		echo "<br /><br />\n";
	}
	else 
	{
// BUG: forget header
		$this->_print_cp_header();
		weblinks_admin_print_menu();
		echo "<h4>"._WLS_MODREQUESTS."</h4>\n";

		echo _WLS_NOMODREQ."<br />\n";
	}

	$this->_print_cp_footer();
}

//---------------------------------------------------------
// approve Modify Request
// modLinkS and ignoreModReq
//---------------------------------------------------------
function approve_mod()
{
	$mid = $this->get_post_mid();

	if ( !$this->_get_obj() )
	{
		$redirect = $this->_get_redirect_at_mod();
		redirect_header( $redirect, 3, _WLS_ERRORNOLINK );
		exit();
	}

	if ( !$this->_check_token() || !$this->_check_approve_mod() )
	{
		$this->_print_approve_mod_preview( $mid );
		exit();
	}

	if ( $this->_exec_approve_mod( $mid ) )
	{

// show notification form
		if ( $this->_check_notification() )
		{
			$this->_print_notification_form_common( WEBLINKS_OP_APPROVE_MOD );
			exit();
		}

// show rssc form
		if ( WEBLINKS_RSSC_USE )
		{
			$this->_rssc_manage->mod_link( WEBLINKS_OP_APPROVE_MOD );
			exit();
		}

		$msg  = _WLS_DBUPDATED;
		$msg .= $this->build_comment( 'approve mod link' );	// for test form
		redirect_header( $this->_get_redirect_at_mod(), 1, $msg );
		exit();

	}
	else
	{
		$this->_print_approve_mod_error( "DB Error" );
		exit();
	}
}

function _exec_approve_mod()
{
	$ret = $this->_edit_handler->admin_approve_mod_link( $this->_obj );
	if ( !$ret )
	{
		$this->_set_errors( $this->_edit_handler->getErrors() );
	}
	return true;
}

function _check_approve_mod()
{
	return $this->_check_handler->check_form_approve_mod();
}

function _print_approve_mod_preview( $mid )
{
	$this->_print_cp_header();
	$this->_print_bread_op( _WLS_MODREQUESTS, 'list_mod');
	$this->_print_title(    _WLS_MODREQUESTS );
	$this->_print_token_error(1);

	$error = $this->_check_handler->get_errors_modlink('s');
	if ( $error )
	{
		echo $this->_form->build_html_error_with_style( $error );
		echo "<br />\n";
	}

	$this->_form->show_admin_mod_approve_form('preview', $mid);
	$this->_print_cp_footer();
}

function _print_approve_mod_error( $title )
{
	$this->_print_cp_header();
	$this->_print_bread_op( _WLS_MODREQUESTS, 'list_mod');
	$this->_print_title(    _WLS_MODREQUESTS );
	xoops_error( $title );
	$this->_print_error();
	$this->_print_cp_footer();
}

//---------------------------------------------------------
// ignore Modify Request
//---------------------------------------------------------
function refuse_mod()
{
	if ( !$this->_get_obj() )
	{
		$redirect = $this->_get_redirect_at_mod();
		redirect_header( $redirect, 3, _WLS_ERRORNOLINK );
		exit();
	}

	if( !$this->_check_token() ) 
	{
		$redirect = $this->_get_redirect_at_mod();
		redirect_header( $redirect, 3, _WLS_ERRORNOLINK );
		exit();
	}

	if ( $this->_delete_modify() )
	{

// show notification form
		if ( $this->_check_notification() )
		{
			$this->_print_notification_form_common( 'refuse_mod' );
			exit();
		}

		$msg  = _WLS_MODREQDELETED;
		$msg .= $this->build_comment( 'refuse mod link' );	// for test form
		redirect_header( $this->_get_redirect_at_mod(), 1, $msg );

	}
	else
	{
		$this->_print_del_mod_error( "DB Error" );
	}
}

function _print_del_mod_error( $title )
{
	$this->_print_cp_header();
	$this->_print_bread_op( _WLS_MODREQUESTS, 'list_mod');
	$this->_print_title(    _WLS_MODREQUESTS );
	xoops_error( $title );
	$this->_print_error();
	$this->_print_cp_footer();
}

// --- class end ---
}

?>