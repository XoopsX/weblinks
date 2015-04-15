<?php
// $Id: broken_manage.php,v 1.1 2011/12/29 14:32:52 ohwada Exp $

// 2007-11-01 K.OHWADA
// link_vote_del_handler
// set_flag_execute_time()

// 2007-09-20 K.OHWADA
// Fatal error: Class 'weblinks_link_edit_base_handler' not found
// admin_header_link.php

// 2007-02-20 K.OHWADA
// hack for multi site

// 2006-09-20 K.OHWADA
// use happy_linux
// use XoopsGTicket

// 2006-05-15 K.OHWADA
// new handler
// add class admin_broken_manage
// use token ticket

// 2006-03-22 K.OHWADA
// new handler: broken

// 2005-10-14 K.OHWADA
// BUG 3095: the number of links does not change, if delete link
// use del_link_vote_comm_catlink_by_lid($lid)

// 2005-09-04 K.OHWADA
// BUG 2932: dont work correctly when register_long_arrays = off

//================================================================
// WebLinks Module
// 2006-09-01 K.OHWADA
//================================================================

include 'admin_header.php';
include 'admin_header_list.php';

//=========================================================
// class admin_broken_manage
//=========================================================
class admin_broken_manage extends happy_linux_manage
{
	var $_link_vote_handler;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_broken_manage()
{
	$this->happy_linux_manage( WEBLINKS_DIRNAME );
	$this->set_handler( 'broken', WEBLINKS_DIRNAME, 'weblinks' );
	$this->set_id_name( 'bid' );
	$this->set_form_class( 'admin_form_broken' );
	$this->set_script(   'broken_manage.php' );
	$this->set_redirect( 'broken_list.php', 'broken_list.php?sortid=1' );
	$this->set_list_id_name( 'broken_id' );
	$this->set_flag_execute_time( true );

	$this->_link_vote_handler =& weblinks_get_handler('link_vote_del', WEBLINKS_DIRNAME);

	$this->set_debug_check_token( false );
	$this->_handler->set_debug_delete(      false );
}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_broken_manage();
	}

	return $instance;
}

//---------------------------------------------------------
// POST
//---------------------------------------------------------
function get_post_bid()
{
	return $this->_post->get_post_get_int('bid');
}

function get_post_lid()
{
	return $this->_post->get_post_get_int('lid');
}

//---------------------------------------------------------
// main_mod_form()
//---------------------------------------------------------
function mod_form()
{
	$this->_main_mod_form();
}

//---------------------------------------------------------
// main_mod_table()
//---------------------------------------------------------
function mod_table()
{
	$this->_main_mod_table( true );
}

//---------------------------------------------------------
// main_del_table()
//---------------------------------------------------------
function del_table()
{
	if ( !$this->_get_obj() )
	{
		redirect_header( "broken_list.php", 3, $this->_LANG_ERR_NO_RECORD );
		exit();
	}

	if( !$this->_check_token() ) 
	{
		redirect_header("broken_list.php", 3, "Token Error");
		exit();
	}

	if ( $this->_exec_del_table() )
	{
	    redirect_header("broken_list.php", 1, _WLS_BROKENDELETED);
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
	$lid = $this->_obj->get('lid');

	$ret = $this->_handler->delete_by_lid($lid);
	if ( !$ret)
	{
		$this-_set_errors( $this->_handler->getErrors() );
		return false;
	}

	return true;
}

function _print_del_db_error()
{
	$this->_print_cp_header();
	$this->_bread( $this->_LANG_TITLE_DEL );
	xoops_error("DB Error");
	$this->_print_error();
	$this->_print_cp_footer();
}

//---------------------------------------------------------
// del_all
//---------------------------------------------------------
function del_all()
{
	$this->_clear_errors();

	if ( !$this->_check_token() )
	{
		redirect_header("broken_list.php", 3, "Token Error");
		exit();
	}

	if ( $this->_exec_del_all() )
	{
	    redirect_header("broken_list.php", 1, _WLS_BROKENDELETED);
		exit();
	}
	else
	{
		$this->_print_del_db_error();
		exit();
	}
}

function _exec_del_all()
{
	$id_arr = $this->_get_post_list_id();

	if ( !is_array($id_arr) || ( count($id_arr) == 0 ) )
	{	return true;	}

	foreach ($id_arr as $id)
	{
		$this->_id  =  $id;
		$this->_obj =& $this->_handler->get($id);

		if ( !is_object($this->_obj) )
		{	continue;	}

		$this->_exec_del_table();
	}

	return $this->returnExistError();
}

//---------------------------------------------------------
// del_by_link
//---------------------------------------------------------
function del_by_link()
{
	if( !$this->_check_token() ) 
	{
		redirect_header("broken_list.php", 5, "Token Error");
		exit();
	}

	if ( $this->_exec_del_by_link() )
	{
	    redirect_header("broken_list.php", 1, _WLS_BROKENDELETED);
		exit();
	}
	else
	{
		$this->_print_del_db_error();
		exit();
	}

	$this->_main_del_table();
}

function _exec_del_by_link()
{
	$lid = $this->get_post_lid();

	$ret = $this->_handler->delete_by_lid($lid);
	if ( !$ret)
	{
		$this-_set_errors( $this->_handler->getErrors() );
		return false;
	}

	return true;
}

//---------------------------------------------------------
// delBrokenLinks
//---------------------------------------------------------
function del_link()
{
	if( !$this->_check_token() ) 
	{
		redirect_header("broken_list.php", 3, "Token Error");
		exit();
	}

	if ( $this->_exec_del_link() )
	{
	    redirect_header("broken_list.php", 1, _WLS_LINKDELETED);
		exit();
	}
	else
	{
		$this->_print_del_db_error();
		exit();
	}
}

function _exec_del_link()
{
	$this->_clear_errors();

	$lid = $this->get_post_lid();

	$ret = $this->_handler->delete_by_lid($lid);
	if ( !$ret)
	{
		$this->_set_errors( $this->_handler->getErrors() );
	}

// BUG 3095: the number of links does not change, if delete link
	$ret = $this->_link_vote_handler->del_link_vote_comm_catlink_by_lid($lid);
	if (!$ret)
	{
		$this->_set_errors( $this->_link_vote_handler->getErrors() );
	}

	return $this->returnExistError();
}

// --- class end ---
}


//=========================================================
// class admin_form_broken
//=========================================================
class admin_form_broken extends happy_linux_form
{
	var $_link_handler;
	var $_system;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_form_broken()
{
	$this->happy_linux_form();

	$this->_link_handler =& weblinks_get_handler( 'link', WEBLINKS_DIRNAME );
	$this->_system =& happy_linux_system::getInstance();
}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_form_broken();
	}

	return $instance;
}

//---------------------------------------------------------
// show black & white
//---------------------------------------------------------
function _show(&$obj, $extra=null, $mode=0)
{
	$form_title = 'modify broken';
	$op         = 'mod_table';
	$button_val = _HAPPY_LINUX_MODIFY;

	$this->set_obj($obj);

	$lid = $obj->get('lid');

	$flag_link_exist = false;
	$title_s = '';
	$url_s   = '';
	$uid     = '';

	$link_obj =& $this->_link_handler->get($lid);
	if ( is_object($link_obj) )
	{
		$flag_link_exist = true;
		$title_s = $link_obj->getVar('title', 's');
		$url_s   = $link_obj->getVar('url',   's');
		$uid     = $link_obj->get('uid');
	}

	$user_param = $this->_system->get_user_by_uid( $uid );
	$owner      = $user_param['uname'];
	$owneremail = $user_param['email'];

// form start
	echo $this->build_form_begin();
	echo $this->build_token();
	echo $this->build_html_input_hidden('op', $op);
	echo $this->build_html_input_hidden('bid', $obj->get('bid') );

	echo $this->build_form_table_begin();
	echo $this->build_form_table_title($form_title);

	echo $this->build_obj_table_label('bid', 'bid');

	echo $this->build_obj_table_text(_WLS_LINKID, 'lid');
	echo $this->build_form_table_line(_WLS_SITETITLE,     $title_s);
	echo $this->build_form_table_line(_WLS_LINKSUBMITTER, $owner);

	echo $this->build_obj_table_text(_WLS_REPORTER, 'sender');
	echo $this->build_form_table_line('', $obj->get_uname() );

	echo $this->build_obj_table_text(_WLS_IP,  'ip');

	$ele_submit = $this->build_html_input_submit('submit', $button_val);
	echo $this->build_form_table_line('', $ele_submit, 'foot', 'foot');

	$ele_del    = $this->build_html_input_submit('del_table', _DELETE);
	$ele_cancel = $this->build_html_input_button_cancel('cancel', _CANCEL);
	echo $this->build_form_table_line('', $ele_del.'  '.$ele_cancel, 'foot', 'foot');

	echo $this->build_form_table_end();
	echo $this->build_form_end();
// --- form end ---

}

// --- class end ---
}

//=========================================================
// main
//=========================================================
// hack for multi site
weblinks_admin_multi_redirect_jp_site();

$manage =& admin_broken_manage::getInstance();

$op = $manage->_main_get_op();

switch ($op)
{
	case 'mod_form':
		$manage->mod_form();
		break;

	case 'mod_table':
		$manage->mod_table();
		break;

	case 'del_table':
		$manage->del_table();
		break;

	case 'del_all':
		$manage->del_all();
		break;

	default:
		xoops_cp_header();
		echo '<h4>No Action</h4>';
		break;
}

xoops_cp_footer();
exit();
// --- end of main ---

?>