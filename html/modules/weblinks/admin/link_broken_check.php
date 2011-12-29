<?php
// $Id: link_broken_check.php,v 1.1 2011/12/29 14:32:52 ohwada Exp $

// 2007-11-01 K.OHWADA
// set_flag_execute_time()

// 2007-06-10 K.OHWADA
// bin_file.php

// 2007-02-20 K.OHWADA
// hack for multi site

// 2006-10-01 K.OHWADA
// use happy_linux
// use XoopsGTicket
// use weblinks_locate

// 2006-05-15 K.OHWADA
// new handler
// add class admin_form_link_broken_check
// use token ticket

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication

//=========================================================
// WebLinks Module
// check link broken
// 2004-10-20 K.OHWADA
//=========================================================

include 'admin_header.php';

include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/file.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/bin_file.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/locate.php';

include_once WEBLINKS_ROOT_PATH.'/class/weblinks_locate.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_check_handler.php';
include_once WEBLINKS_ROOT_PATH.'/admin/admin_functions.php';

//=========================================================
// class link_broken_check manage
//=========================================================
class admin_manage_link_broken_check extends happy_linux_manage
{
	var $_post;

	var $_limit;
	var $_offset;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_manage_link_broken_check()
{
	$this->happy_linux_manage( WEBLINKS_DIRNAME );

	$this->set_handler( 'link_check', WEBLINKS_DIRNAME, 'weblinks' );
	$this->set_id_name( 'lid' );
	$this->set_form_class( 'admin_form_link_broken_check' );
	$this->set_script('link_broken_check.php' );
	$this->set_flag_execute_time( true );

	$this->_post =& happy_linux_post::getInstance();
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_manage_link_broken_check();
	}

	return $instance;
}

//---------------------------------------------------------
// POST
//---------------------------------------------------------
function get_post_op()
{
	return $this->_post->get_post_get('op');
}

function get_post_limit()
{
	$this->_limit  = $this->_post->get_post_int('limit');	
	if ($this->_limit  < 0)  $this->_limit  = 0;
	return $this->_limit;
}

function get_post_offset()
{
	$this->_offset  = $this->_post->get_post_int('offset');	
	if ($this->_offset < 0)  $this->_offset = 0;
	return $this->_offset;
}

//---------------------------------------------------------
// main_form()
//---------------------------------------------------------
function main_form()
{
	$total_link = $this->_handler->get_link_count_all();

	$this->_print_cp_header();
	$this->_print_bread_op( _WEBLINKS_ADMIN_LINK_BROKEN_CHECK, 'main_form');

	weblinks_admin_print_header();
	weblinks_admin_print_menu();

	echo "<h4>"._WEBLINKS_ADMIN_LINK_BROKEN_CHECK."</h4>\n";
	printf(_WLS_THEREARE, $total_link);
	echo "<br /><br />\n";
	echo _WEBLINKS_ADMIN_LINK_BROKEN_CHECK_CAUTION."<br />\n";

	$this->_print_form();
	$this->_print_cp_footer();
}

function _print_form()
{
	$limit  = $this->get_post_limit();
	$offset = $this->get_post_offset();

	$this->_form->show_first($limit, $offset);
}

//---------------------------------------------------------
// check_link
//---------------------------------------------------------
function check_link()
{
	$limit  = $this->get_post_limit();
	$offset = $this->get_post_offset();

	$total_link  = $this->_handler->get_link_count_all();

	$this->_print_cp_header();
	$this->_print_bread_op( _WEBLINKS_ADMIN_LINK_BROKEN_CHECK, 'main_form');

	if ( !$this->_check_token() )
	{
		$this->_print_preview();
		exit();
	}

	$this->_handler->check($limit, $offset);

	$next  = $offset + $limit;
	if (($limit > 0) && ($next < $total_link))
	{
		echo "<br />\n";
		$this->_form->show_next($limit, $next);
	}
	else
	{
		echo "<h4>"._HAPPY_LINUX_EXECUTED."</h4>\n";
	}

	$this->_print_cp_footer();

}

function _print_preview()
{
	$this->_print_token_error(1);
	$this->_print_form();
	$this->_print_cp_footer();
}

// --- class end ---
}

//=========================================================
// class admin_form_link_broken_check
//=========================================================
class admin_form_link_broken_check extends happy_linux_form_lib
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_form_link_broken_check()
{
	$this->happy_linux_form_lib();
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_form_link_broken_check();
	}
	return $instance;
}

//---------------------------------------------------------
// function
//---------------------------------------------------------
function show_first($limit=0, $offset=0)
{
	echo $this->build_form_begin( 'check' );
	echo $this->build_token();
	echo $this->build_html_input_hidden('op',  'check');
	echo $this->build_form_table_begin();
	echo $this->build_form_table_title( _WEBLINKS_ADMIN_LINK_BROKEN_CHECK );

	echo $this->build_form_table_text(_WEBLINKS_ADMIN_LIMIT,  'limit',  $limit);
	echo $this->build_form_table_text(_WEBLINKS_ADMIN_OFFSET, 'offset', $offset);
	echo $this->build_form_table_submit( '', 'post', _WEBLINKS_CHECK );

	echo $this->build_form_table_end();
	echo $this->build_form_end();

}

function show_next($limit=0, $offset=0)
{
	$submit = sprintf(_WEBLINKS_ADMIN_CHECK_NEXT, $limit);

	$desc  = '';
	$action = '';
	$text = $this->build_lib_box_limit_offset(_WEBLINKS_ADMIN_LINK_BROKEN_CHECK, $desc, $limit, $offset, 'check', $submit, $action);
	echo $text;
}

// --- class end ---
}


//=========================================================
// main
//=========================================================
// hack for multi site
weblinks_admin_multi_disable_feature();

$manage =& admin_manage_link_broken_check::getInstance();
$op     = $manage->get_post_op();

switch($op)
{
	case 'check':
		$manage->check_link();
		break;

	default:
		$manage->main_form();
		break;
}

xoops_cp_footer();
exit();
// --- end of main ---

?>