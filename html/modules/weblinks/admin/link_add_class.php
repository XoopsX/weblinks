<?php
// $Id: link_add_class.php,v 1.1 2011/12/29 14:32:54 ohwada Exp $

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
// class admin_link_add
//=========================================================
class admin_link_add extends admin_link_base
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_link_add()
{
	$this->admin_link_base();
	$this->set_edit_handler( 'link_add' );
}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_link_add();
	}
	return $instance;
}

//---------------------------------------------------------
// add_form
//---------------------------------------------------------
function add_form()
{
	$this->_main_add_form();
}

function _print_add_form()
{
	$this->_form->show_admin_form('submit');
	return true;
}

//---------------------------------------------------------
// add_link
//---------------------------------------------------------
function add_link()
{
	$rss_flag = $this->get_post_rss_flag();

	if ( !$this->_check_token() || !$this->_check_add_link() )
	{
		$this->_print_add_preview();
		exit();
	}

	if ( $this->_exec_add_link() )
	{

// when set banner
		if ( $this->get_post_banner() )
		{
			$this->_print_add_banner_form( $this->_newid, 'add_banner' );
			exit();
		}
// when conf_cat_path
		elseif ( $this->_conf['cat_count'] )
		{
			$this->_print_update_cat_form(  $this->_newid, 'add_link' );
			exit();
		}
// when set rss flag
		elseif ( WEBLINKS_RSSC_USE && $rss_flag )
		{
			$this->_rssc_manage->add_link( $this->_newid, 'add_link' );
			exit();
		}

// finish
		$com  = 'admin add link [' . $this->_newid . ']';
		$msg  = _WLS_NEWLINKADDED;
		$msg .= $this->_build_comment( $com );	// for test form
		redirect_header($this->_redirect_desc, 1, $msg);
		exit();
	}
	else
	{
		$this->_print_add_db_error();
		exit();
	}
}

function _exec_add_link()
{
	$newid = $this->_edit_handler->admin_add_link();
	if ( !$newid )
	{
		$this->_set_errors( $this->_edit_handler->getErrors() );
		return false;
	}

	$this->_newid = $newid;
	return $newid;
}

function _check_add_link()
{
	$ret = $this->_check_handler->check_form_addlink_by_post();
	if (!$ret)
	{
		$this->_set_errors( $this->_check_handler->get_errors_addlink() );
		return false;
	}
	return true;
}

function _print_add_preview_form()
{
	$this->_form->show_admin_form('submit_preview');
}

function _print_add_preview()
{
	$this->_print_cp_header();
	$this->_print_bread_op( $this->_LANG_TITLE_ADD, 'add_form' );
	$this->_print_title(    $this->_LANG_TITLE_ADD );
	$this->_print_token_error(1);

	if ( $this->_error_title )
	{
		xoops_error( $this->_error_title );
		echo "<br />\n";
	}

	$err  = $this->getErrors(1);
	$err .= $this->_check_handler->get_formated_error_addlink();
	echo $this->_form->build_html_error_with_style( $err );
	echo "<br />\n";

	$this->_print_add_preview_form();
	$this->_print_cp_footer();
}

//---------------------------------------------------------
// add_banner
//---------------------------------------------------------
function _print_add_banner_form( $lid, $op_mode )
{
	$this->_print_cp_header();
	$this->_print_bread_op( $this->_LANG_TITLE_MOD, 'add_form', _AM_WEBLINKS_ADD_BANNER );

	if ( $op_mode == 'add_banner' )
	{
		echo '<h4 style="color: #0000ff;">'._WLS_NEWLINKADDED."</h4>\n";
		echo "<hr />\n";
	}

	$this->_print_title( _AM_WEBLINKS_ADD_BANNER );

	if ( $op_mode == 'add_banner_preview' )
	{
			$this->_print_token_error(1);
			$this->_print_error(1);
	}

	$this->_print_banner_form_common( $lid, $op_mode );

	$this->_print_cp_footer();
}

function add_banner()
{
	$lid      = $this->get_post_lid();
	$rss_flag = $this->get_post_rss_flag();
	$skip     = $this->get_post_skip();

	if ( !$this->_check_token() )
	{
		$this->_print_add_banner_form( $this->_lid, 'add_banner_preview' );
		exit();
	}

	if ( $skip || $this->_exec_banner_common() )
	{
// when conf_cat_path
		if ( $this->_conf['cat_count'] )
		{
			$this->_print_update_cat_form( $lid, 'add_banner' );
			exit();
		}
// when set rss flag
		elseif ( WEBLINKS_RSSC_USE && $rss_flag )
		{
			$this->_rssc_manage->add_link($lid, 'add_link');
			exit();
		}

// finish
		$msg  = _WLS_NEWLINKADDED;
		$msg .= $this->_build_comment('add banner');	// for test form
		redirect_header($this->_redirect_desc, 1, $msg);
		exit();
	}
	else
	{
		$this->_print_add_db_error();
		exit();
	}
}

// --- class end ---
}

?>