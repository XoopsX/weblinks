<?php
// $Id: link_base_class.php,v 1.1 2011/12/29 14:32:55 ohwada Exp $

// 2007-11-01 K.OHWADA
// set_edit_handler()
// set_flag_execute_time()

// 2007-09-20 K.OHWADA
// get_post_rssc_lid_flag_update()

// 2007-09-10 K.OHWADA
// general revision
// divid from link_manage.php

//=========================================================
// WebLinks Module
// 2004/01/14 K.OHWADA
//=========================================================

//=========================================================
// class admin_link_base
//=========================================================
class admin_link_base extends happy_linux_manage
{
	var $_config_handler;
	var $_edit_handler;
	var $_check_handler;
	var $_votedata_handler;
	var $_broken_handler;
	var $_form;
	var $_rssc_manage;
	var $_time_class;

	var $_lid;
	var $_error_title  = null;

	var $_conf;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_link_base()
{
	$this->happy_linux_manage( WEBLINKS_DIRNAME );
	$this->set_handler(      'link',            WEBLINKS_DIRNAME, 'weblinks' );
	$this->set_form_handler( 'link_form_admin', WEBLINKS_DIRNAME, 'weblinks' );
	$this->set_id_name( 'lid' );
	$this->set_script(   'link_manage.php' );
	$this->set_redirect( 'link_list.php', 'link_list.php?sortid=1' );
	$this->set_title( _WEBLINKS_ADMIN_ADD_LINK, _WLS_MODLINK, _AM_WEBLINKS_DEL_LINK );
	$this->set_err_no_record( _WLS_ERRORNOLINK );
	$this->set_module_dirname( 'weblinks' );
	$this->set_flag_execute_time( true );

	$this->_config_handler =& weblinks_get_handler('config2_basic',   WEBLINKS_DIRNAME );
	$this->_check_handler  =& weblinks_get_handler('link_form_check', WEBLINKS_DIRNAME);
	$this->_time_class     =& happy_linux_time::getInstance();

	if ( WEBLINKS_RSSC_USE )
	{
		$this->_rssc_manage =& admin_rssc_manage::getInstance();
	}

	$this->_conf = $this->_config_handler->get_conf();
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_link_base();
	}
	return $instance;
}

function set_edit_handler( $table )
{
	$this->_edit_handler =& weblinks_get_handler( $table, WEBLINKS_DIRNAME );
}

//---------------------------------------------------------
// POST param
//---------------------------------------------------------
function get_post_lid()
{
	$lid = 0;
	if     ( isset($_POST['link_lid']) )  $lid = $_POST['link_lid'];
	elseif ( isset($_POST['lid']) )       $lid = $_POST['lid'];
	elseif ( isset($_GET['lid']) )        $lid = $_GET['lid'];
	$this->_lid = intval($lid);
	return $this->_lid;
}

function get_post_mid()
{
	return $this->_post->get_post_get_int('mid');
}

function get_post_rssc_lid()
{
	return $this->_post->get_post_get_int('rssc_lid');
}

function get_post_rssc_lid_flag_update()
{
	return $this->_post->get_post_int('rssc_lid_flag_update');
}

function get_post_rss_flag()
{
	return $this->_post->get_post_get_int('rss_flag');
}

function get_post_op_mode()
{
	return $this->_post->get_post_get_text('op_mode');
}

function get_post_skip()
{
	return $this->_post->get_post_text('skip');
}

function get_post_banner()
{
	return $this->_post->get_post_url('banner');
}

//---------------------------------------------------------
// banner
//---------------------------------------------------------
function _print_banner_form_common( $lid, $op_mode )
{
	switch ($op_mode)
	{
		case 'add_banner_preview':
		case 'mod_banner_preview':
			$this->_print_token_error(1);
			$this->_print_error(1);
			break;
	}

	$banner = $this->get_post_banner();
	$width  = 0;
	$height = 0;

	$size =& $this->_edit_handler->get_remote_banner_size($banner);
	if ( is_array($size) && isset($size[0]) && isset($size[1]) )
	{
		$width  = $size[0];
		$height = $size[1];
	}
	elseif ( !$size )
	{
		$this->_set_error_title( _WEBLINKS_WARN_BANNER_NOT_GET_SIZE );
		$this->_set_errors( $this->_edit_handler->get_banner_errors() );
		$this->_print_error(1);
	}

	$this->_form->show_admin_banner_form( $lid, $width, $height, $op_mode );

}

function _exec_banner_common()
{
	$ret = $this->_edit_handler->update_banner_and_size_by_post();
	if (!$ret)
	{
		$this->_set_errors( $this->_edit_handler->getErrors() );
		return false;
	}
	return true;
}

//---------------------------------------------------------
// update_category_link_count
//---------------------------------------------------------
function update_cat_form()
{
	$this->_print_update_cat_form( 0, 'update_cat' );
}

function _print_update_cat_form( $link, $op_mode )
{
	$name = _AM_WEBLINKS_UPDATE_CAT_COUNT;

	switch ($op_mode)
	{
		case 'add_link':
			$title = _WEBLINKS_ADMIN_ADD_LINK;
			$op    = 'add_form';
			break;

		case 'mod_link':
			$title = _WLS_MODLINK;
			$op    = 'mod_form';
			break;

		case 'del_link':
			$title = _AM_WEBLINKS_DEL_LINK;
			$op    = 'del_form';
			break;

		case 'add_banner':
			$title = _WEBLINKS_ADMIN_ADD_LINK;
			$op    = 'add_banner_form';
			break;

		case 'mod_banner':
			$title = _WLS_MODLINK;
			$op    = 'mod_banner_form';
			break;

		default:
		case 'update_cat':
			$title = _AM_WEBLINKS_UPDATE_CAT_COUNT;
			$op    = 'update_cat_form';
			$name  = '';
			break;
	}

	$this->_print_cp_header();
	$this->_print_bread_op( $title, $op, $name );
	$this->_print_title( _AM_WEBLINKS_UPDATE_CAT_COUNT );
	$this->_form->show_admin_update_cat_form( $link, $op_mode );
	$this->_print_cp_footer();
}

function update_cat()
{
	$lid      = $this->get_post_lid();
	$rss_flag = $this->get_post_rss_flag();
	$op_mode  = $this->get_post_op_mode();
	$skip     = $this->get_post_skip();
	$rssc_lid_flag_update = $this->get_post_rssc_lid_flag_update();

	$url_end = 'link_list.php';
	$url_err = 'link_manage.php?op=update_cat_form';

	$flag_add_rssc = false;
	$flag_mod_rssc = false;

	switch ($op_mode)
	{
		case 'add_link':
		case 'add_banner':
			$msg     = _WLS_NEWLINKADDED."<br />\n";
			$url_end = $this->_redirect_desc;
			if ( WEBLINKS_RSSC_USE && $rss_flag )
			{
				$flag_add_rssc = true;
			}
			break;

		case 'mod_link':
		case 'mod_banner':
			$msg     = _WLS_DBUPDATED."<br />\n";
			$url_end = $this->_redirect_asc;
			if ( WEBLINKS_RSSC_USE && !$rssc_lid_flag_update )
			{
				$flag_mod_rssc = true;
			}
			break;

		case 'del_link':
			$msg     = _AM_WEBLINKS_DEL_LINK."<br />\n";
			$url_end = $this->_redirect_asc;
			break;

		default:
		case 'update_cat':
			$msg = '';
			$url_end = $this->_redirect_asc;
			break;
	}

	if( !( $this->_check_token() ) ) 
	{
		redirect_header( $url_err, 3, "Token Error");
		exit();
	}

	if ( $skip || $this->_exec_update_cat() )
	{
		if ( $flag_add_rssc )
		{
			$this->_rssc_manage->add_link($lid, 'add_link');
			exit();
		}
		elseif ( $flag_mod_rssc )
		{
			$this->_rssc_manage->mod_link('mod_link');
			exit();
		}

		$time  = $this->_time_class->get_elapse_time();
		$msg  .= _AM_WEBLINKS_CAT_COUNT_UPDATED." : $time sec \n";
		$msg  .= $this->_build_comment('update cat');	// for test form
		redirect_header( $url_end, 3, $msg );
		exit();
	}

	xoops_cp_header();
	$this->_print_bread_op( _AM_WEBLINKS_UPDATE_CAT_COUNT );
	$this->_print_title(    _AM_WEBLINKS_UPDATE_CAT_COUNT );
	xoops_error("DB Error");
	echo $this->getErrors(1);
	xoops_cp_footer();
}

function _exec_update_cat()
{
	$ret = $this->_edit_handler->update_category_link_count();
	return $ret;
}

//---------------------------------------------------------
// handler
//---------------------------------------------------------
function _get_obj()
{
	$lid = $this->get_post_lid();
	$obj = $this->_handler->get($lid);
	if ( is_object($obj) ) 
	{
		$this->_obj =& $obj;
	}
	return $obj;
}

//---------------------------------------------------------
// private print
//---------------------------------------------------------
function _print_menu()
{
	weblinks_admin_print_header();
	weblinks_admin_print_menu();
}

// --- class end ---
}

?>