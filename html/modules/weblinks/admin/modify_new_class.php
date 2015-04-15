<?php
// $Id: modify_new_class.php,v 1.1 2011/12/29 14:32:53 ohwada Exp $

// 2007-11-01 K.OHWADA
// set_edit_handler()

// 2007-09-10 K.OHWADA
// general revision
// divid from modify_manage_class.php

//=========================================================
// admin modify
// 2006-09-01 K.OHWADA
//=========================================================

//=========================================================
// class admin_modify_new
//=========================================================
class admin_modify_new extends admin_modify_base
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_modify_new()
{
	$this->admin_modify_base();
	$this->set_edit_handler( 'link_add' );
}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_modify_new();
	}
	return $instance;
}

//---------------------------------------------------------
// list New Links
//---------------------------------------------------------
function list_new()
{
	$total = $this->_handler->get_count_new();
	$mid   = $this->get_post_mid();

	if ( $total > 0 ) 
	{
		if ( $mid > 0 )
		{
			$obj =& $this->_handler->get($mid);
			if ( !is_object($obj) )
			{
// goto list_new
				redirect_header( 'modify_list.php?op=list_new', 3, _WLS_ERRORNOLINK );
				exit();
			}
		}
		else
		{
			$mid_arr = $this->_handler->get_mid_array_new(1);
			if ( !isset($mid_arr[0]) )
			{
				redirect_header( 'modify_list.php', 3, _WLS_ERRORNOLINK );
				exit();
			}
			$mid = $mid_arr[0];
		}

		$total_s = $this->_form->build_html_highlight_number($total);

		$this->_print_cp_header();
		$this->_print_bread_op( _WLS_LINKSWAITING, 'list_new');
		echo "<h4>"._WLS_LINKSWAITING."</h4>\n";
		echo sprintf(_HAPPY_LINUX_THERE_ARE, $total_s)."<br /><br />\n";
		$this->_form->show_admin_form( WEBLINKS_OP_APPROVE_NEW, $mid);
		echo "<br /><br />\n";
	}
	else 
	{
// BUG: forget header
		$this->_print_cp_header();
		weblinks_admin_print_menu();
		echo "<h4>"._WLS_LINKSWAITING."</h4>\n";

		echo _WLS_NOSUBMITTED."<br />\n";
	}

	$this->_print_cp_footer();
}

//---------------------------------------------------------
// approve New Link
//---------------------------------------------------------
function approve_new()
{
	$mid      = $this->get_post_mid();
	$rss_flag = $this->get_post_rss_flag();

	if ( !$this->_get_obj() )
	{
		$redirect = $this->_get_redirect_at_new();
		redirect_header( $redirect, 3, _WLS_ERRORNOLINK );
		exit();
	}

	if ( !$this->_check_token() || !$this->_check_approve_new() )
	{
		$this->_print_approve_new_preview();
		exit();
	}

	if ( $this->_exec_approve_new( $mid ) )
	{

// show notification form
		if ( $this->_check_notification() )
		{
			$this->_print_notification_form_common( WEBLINKS_OP_APPROVE_NEW );
			exit();
		}

// show rssc form
		if ( WEBLINKS_RSSC_USE && $rss_flag )
		{
			$this->_rssc_manage->add_link( $this->_newid, WEBLINKS_OP_APPROVE_NEW );
			exit();
		}

		$com  = 'approve new link [' . $this->_newid . ']';
		$msg  = _WLS_NEWLINKADDED;
		$msg .= $this->build_comment( $com );	// for test form
		redirect_header( $this->_get_redirect_at_new(), 1, $msg );
		exit();
	}
	else
	{
		$this->_print_approve_new_error( "DB Error" );
		exit();
	}
}

function _exec_approve_new()
{
	$newid = $this->_edit_handler->admin_approve_new_link( $this->_obj );
	if ( !$newid )
	{
		$this->_set_errors( $this->_edit_handler->getErrors() );
		return false;
	}

	$this->_newid = $newid;
	return $newid;
}

function _check_approve_new()
{
	return $this->_check_handler->check_form_modlink_by_post();
}

function _print_approve_new_preview()
{
	$this->_print_cp_header();
	$this->_print_bread_op( _AM_WEBLINKS_APPROVE, 'list_new');
	$this->_print_title(    _AM_WEBLINKS_APPROVE );
	$this->_print_token_error(1);

	$error = $this->_check_handler->get_errors_modlink('s');
	if ( $error )
	{
		echo $this->_form->build_html_error_with_style( $error );
		echo "<br />\n";
	}

	$this->_form->show_admin_form('approve_preview');
	$this->_print_cp_footer();
}

function _print_approve_new_error( $title )
{
	$this->_print_cp_header();
	$this->_print_bread_op( _AM_WEBLINKS_APPROVE, 'list_new');
	$this->_print_title(    _AM_WEBLINKS_APPROVE );
	xoops_error( $title );
	$this->_print_error();
	$this->_print_cp_footer();
}

//---------------------------------------------------------
// refuse & delete New Link
//---------------------------------------------------------
function refuse_new()
{
	if ( !$this->_get_obj() )
	{
		$redirect = $this->_get_redirect_at_new();
		redirect_header($redirect, 3, _WLS_ERRORNOLINK );
		exit();
	}

	if( !$this->_check_token() ) 
	{
		redirect_header("link_list.php", 5, "Token Error");
		exit();
	}

	if ( $this->_delete_modify() )
	{

// show notification form
		if (  $this->_check_notification() )
		{
			$this->_print_notification_form_common( 'refuse_new' );
			exit();
		}

		$msg  = _WLS_LINKDELETED;
		$msg .= $this->build_comment( 'refuse new link' );	// for test form
		redirect_header( $this->_get_redirect_at_new(), 1, $msg );

	}
	else
	{
		$this->_print_refuse_new_error( "DB Error" );
	}
}

function _print_refuse_new_error( $title )
{
	$this->_print_cp_header();
	$this->_print_bread_op( _AM_WEBLINKS_APPROVE, 'list_new');
	$this->_print_title(    _AM_WEBLINKS_APPROVE );
	xoops_error( $title );
	$this->_print_error();
	$this->_print_cp_footer();
}

// --- class end ---
}

?>