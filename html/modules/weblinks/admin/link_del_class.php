<?php
// $Id: link_del_class.php,v 1.1 2011/12/29 14:32:55 ohwada Exp $

// 2007-11-01 K.OHWADA
// set_edit_handler()

// 2007-09-10 K.OHWADA
// general revision
// divid from link_manage.php

//=========================================================
// WebLinks Module
// 2004/01/14 K.OHWADA
//=========================================================

//=========================================================
// class admin_link_del
//=========================================================
class admin_link_del extends admin_link_base
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_link_del()
{
	$this->admin_link_base();
	$this->set_edit_handler( 'link_del' );
}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_link_del();
	}
	return $instance;
}

//---------------------------------------------------------
// del form
//---------------------------------------------------------
function del_form()
{
	$lid = $this->get_post_lid();

	if ( !$this->_get_obj() )
	{
		redirect_header("link_list.php", 3, _WLS_ERRORNOLINK);
		exit();
	}

	if ( !$this->_check_token() )
	{
		$this->_print_mod_preview();
		exit();
	}

	$this->_print_cp_header();
	$this->_print_bread_op( $this->_LANG_TITLE_MOD, 'mod_form', $this->_LANG_TITLE_DEL );
	$this->_print_title(    $this->_LANG_TITLE_DEL );

	echo $this->_edit_handler->build_style_sheet();
	echo $this->_edit_handler->build_show_link( $this->_lid );

	$this->_form->show_del_confirm_form( $lid, 0, 'delete_link' );

	$this->_print_cp_footer();
}

//---------------------------------------------------------
// delLink
//---------------------------------------------------------
function del_link()
{
	$this->_main_del_table();
}

function _main_del_table( $check_flag=false )
{
	$lid = $this->get_post_lid();

	if ( !$this->_get_obj() )
	{
		redirect_header( $this->_redirect_asc, 3, $this->_LANG_ERR_NO_RECORD );
		exit();
	}

	if( !$this->_check_token() ) 
	{
		redirect_header( $this->_build_script_mod_form(), 3, "Token Error");
		exit();
	}

	if ( !$this->_check_del_table() )
	{
		redirect_header( $this->_build_script_mod_form(), 3, $this->_get_del_error() );
		exit();
	}

	if ( $this->_exec_del_table() )
	{
// when conf_cat_path
		if ( $this->_conf['cat_count'] )
		{
			$this->_print_update_cat_form( $lid, 'del_link' );
			exit();
		}

		$msg  = _AM_WEBLINKS_DEL_LINK;
		$msg .= $this->_build_comment('del record');	// for test form
		redirect_header($this->_redirect_asc, 1, $msg);
		exit();
	}
	else
	{
		$this->_print_del_db_error();
		exit();
	}
}

function _exec_del_table()
{
	$lid = $this->get_post_lid();

// BUG 3095: the number of links does not change, if delete link
	$ret = $this->_edit_handler->del_link_vote_comm_catlink_by_lid($lid);
	if (!$ret)
	{
		$this->_set_errors( $this->_edit_handler->getErrors() );
		return false;
	}

	return true;
}

function _print_del_error()
{
	xoops_error("DB Error");
	echo $this->getErrors(1);
}

function _check_del_table()
{
	return true;
}

// --- class end ---
}

?>