<?php
// $Id: link_clone_class.php,v 1.1 2011/12/29 14:32:55 ohwada Exp $

// 2007-11-01 K.OHWADA
// set_edit_handler()

//=========================================================
// WebLinks Module
// 2007-09-10 K.OHWADA
//=========================================================

//=========================================================
// class admin_link_clone
//=========================================================
class admin_link_clone extends admin_link_base
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_link_clone()
{
	$this->admin_link_base();
	$this->set_edit_handler( 'link_add' );
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_link_clone();
	}
	return $instance;
}

//---------------------------------------------------------
// clone_link
//---------------------------------------------------------
function clone_link()
{
	$lid = $this->get_post_lid();

	if ( !$this->_get_obj() )
	{
		redirect_header("link_list.php", 3, _WLS_ERRORNOLINK);
		exit();
	}

	if ( !$this->_check_token() || !$this->_check_clone_link() )
	{
		$this->_print_clone_preview();
		exit();
	}

	if ( $this->_exec_clone_link( $lid ) )
	{

// finish
		$url  = $this->_build_url_mod_form( $this->_newid );
		$com  = 'admin clone link [' . $this->_newid . ']';
		$msg  = _WLS_NEWLINKADDED;
		$msg .= $this->_build_comment( $com );	// for test form
		redirect_header( $url, 1, $msg );
		exit();
	}
	else
	{
		$this->_print_clone_db_error();
		exit();
	}
}

function _exec_clone_link( $lid )
{
	$newid = $this->_edit_handler->admin_clone_link( $lid );
	if ( !$newid )
	{
		$this->_set_errors( $this->_edit_handler->getErrors() );
		return false;
	}

	$this->_newid = $newid;
	return $newid;
}

function _check_clone_link()
{
	return true;
}

function _print_clone_preview()
{
	$this->_print_cp_header();
	$this->_print_bread_op( $this->_LANG_TITLE_MOD, 'mod_form' );
	$this->_print_title(    $this->_LANG_TITLE_MOD );
	$this->_print_token_error(1);

	$this->_form->show_admin_form('modify_preview');

	$this->_print_cp_footer();
}

function _print_clone_db_error()
{
	return $this->_print_add_db_error();
}

function _build_url_mod_form( $lid )
{
	$url = 'link_manage.php?op=mod_form&amp;lid='.$lid;
	return $url;
}

//---------------------------------------------------------
// clone_module
//---------------------------------------------------------
function clone_module()
{
	$lid = $this->get_post_lid();

	if ( !$this->_get_obj() )
	{
		redirect_header("link_list.php", 3, _WLS_ERRORNOLINK);
		exit();
	}

	if ( !$this->_check_token() || !$this->_check_clone_link() )
	{
		$this->_print_clone_preview();
		exit();
	}

	$this->_print_cp_header();
	$this->_print_bread_op( $this->_LANG_TITLE_MOD, 'mod_form' );
	$this->_print_title(    $this->_LANG_TITLE_MOD );

	$this->_form->show_admin_clone_module_form( $lid );

	$this->_print_cp_footer();
}

//---------------------------------------------------------
// clone_module
//---------------------------------------------------------
function clone_module_to()
{
	$lid     = $this->get_post_lid();
	$dirname = $this->_post->get_post_text('dirname');

	if ( !$this->_check_token() )
	{
		$this->_print_clone_preview();
		exit();
	}

	if ( empty($lid) || empty($dirname) )
	{
		$this->_print_clone_preview();
		exit();
	}

	$this->_print_cp_header();
	$this->_print_bread_op( $this->_LANG_TITLE_MOD, 'mod_form' );
	$this->_print_title(    $this->_LANG_TITLE_MOD );

	$this->_form->show_admin_clone_module_confirm_form( $lid, $dirname );

	$this->_print_cp_footer();
}

//---------------------------------------------------------
// clone_module_from
//---------------------------------------------------------
function clone_module_from()
{
	$from = $this->_post->get_post_get_int('from');
	$lid  = $this->get_post_lid();

	if ( !$this->_check_token() )
	{
		redirect_header("link_list.php", 3, _WLS_ERRORNOLINK);
		exit();
	}

	if ( $this->_exec_clone_module_from( $from, $lid ) )
	{

// finish
		$url  = $this->_build_url_mod_form( $this->_newid );
		$com  = 'admin clone module from [' . $this->_newid . ']';
		$msg  = _WLS_NEWLINKADDED;
		$msg .= $this->_build_comment( $com );	// for test form
		redirect_header( $url, 1, $msg );
		exit();
	}
	else
	{
		$this->_print_clone_module_from_db_error();
		exit();
	}

}

function _exec_clone_module_from( $from, $lid )
{
	$newid = $this->_edit_handler->admin_clone_module_from( $from, $lid );
	if ( !$newid )
	{
		$this->_set_errors( $this->_edit_handler->getErrors() );
		return false;
	}

	$this->_newid = $newid;
	return $newid;
}

function _print_clone_module_from_db_error()
{
	return $this->_print_add_db_error();
}

// --- class end ---
}


?>