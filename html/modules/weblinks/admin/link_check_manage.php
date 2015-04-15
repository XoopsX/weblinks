<?php
// $Id: link_check_manage.php,v 1.1 2011/12/29 14:32:52 ohwada Exp $

// 2008-02-17 K.OHWADA
// change file name link_broken_check.php -> link_check_manage.php
// update_pagerank()

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
// 2004-10-20 K.OHWADA
//=========================================================

include 'admin_header.php';

include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/file.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/bin_file.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/locate.php';

include_once WEBLINKS_ROOT_PATH.'/class/weblinks_locate.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_check_base.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_check_handler.php';
include_once WEBLINKS_ROOT_PATH.'/admin/admin_functions.php';

//=========================================================
// class link_check_manage
//=========================================================
class admin_link_check_manage extends happy_linux_manage
{
	var $_config_handler;
	var $_check_handler;
	var $_update_handler;

	var $_post;

	var $_conf   = null;
	var $_limit  = 0;
	var $_offset = 0;

	var $_TITLE_UPDATE = 'PageRank Update';

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_link_check_manage()
{
	$this->happy_linux_manage( WEBLINKS_DIRNAME );

	$this->set_handler( 'link', WEBLINKS_DIRNAME, 'weblinks' );
	$this->set_id_name( 'lid' );
	$this->set_form_class( 'admin_form_pagerank' );
	$this->set_script('link_check_manage.php' );
	$this->set_flag_execute_time( true );

	$this->_config_handler =& weblinks_get_handler( 'config2_basic',   WEBLINKS_DIRNAME );
	$this->_check_handler  =& weblinks_get_handler( 'link_check',      WEBLINKS_DIRNAME );
	$this->_update_handler =& weblinks_get_handler( 'pagerank_update', WEBLINKS_DIRNAME );

	$this->_post =& happy_linux_post::getInstance();
	
	$this->_conf = $this->_config_handler->get_conf();
}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_link_check_manage();
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
	$total = $this->_check_handler->get_link_count_all();

	$this->_print_cp_header();
	$this->_print_bread_op( _AM_WEBLINKS_LINK_CHECK_MANAGE, 'main_form');

	weblinks_admin_print_header();
	weblinks_admin_print_menu();

	echo "<h4>". _AM_WEBLINKS_LINK_CHECK_MANAGE ."</h4>\n";
	printf(_WLS_THEREARE, $total);
	echo "<br /><br />\n";
	echo _WEBLINKS_ADMIN_LINK_BROKEN_CHECK_CAUTION;
	echo "<br /><br />\n";

	$this->_print_form( 'check', _WEBLINKS_ADMIN_LINK_BROKEN_CHECK );
	echo "<br /><br />\n";

	$this->_print_form( 'update', $this->_TITLE_UPDATE );
	echo "<br /><br />\n";

	$this->_print_cp_footer();
}

function _print_form( $op, $title )
{
	$limit  = $this->get_post_limit();
	$offset = $this->get_post_offset();

	$this->_form->show_first( $op, $title, $limit, $offset );
}

//---------------------------------------------------------
// update_pagerank
//---------------------------------------------------------
function check_link()
{
	$this->_print_header();

	$this->_check_handler->check($this->_limit, $this->_offset);

	$this->_print_footer( 'check', _WEBLINKS_ADMIN_LINK_BROKEN_CHECK );
}

function update_pagerank()
{
	$this->_print_header();

	$this->_update_handler->update($this->_limit, $this->_offset);

	$this->_print_footer( 'update', $this->_TITLE_UPDATE );
}

function _print_header()
{
	$limit  = $this->get_post_limit();
	$offset = $this->get_post_offset();

	$this->_print_cp_header();
	$this->_print_bread_op( _AM_WEBLINKS_LINK_CHECK_MANAGE, 'main_form');

	if ( !$this->_check_token() )
	{
		$this->_print_preview();
		exit();
	}
}

function _print_footer( $op, $title )
{
	$limit  = $this->_limit;
	$offset = $this->_offset;
	$next   = $offset + $limit;

	$total  = $this->_check_handler->get_link_count_all();

	if (($limit > 0) && ($next < $total))
	{
		echo "<br />\n";
		$this->_form->show_next( $op, $title, $limit, $next );
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
// class admin_form_pagerank
//=========================================================
class admin_form_pagerank extends happy_linux_form_lib
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_form_pagerank()
{
	$this->happy_linux_form_lib();
}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_form_pagerank();
	}
	return $instance;
}

//---------------------------------------------------------
// function
//---------------------------------------------------------
function show_first($op, $title, $limit=0, $offset=0)
{
	echo $this->build_form_begin();
	echo $this->build_token();
	echo $this->build_html_input_hidden('op', $op);
	echo $this->build_form_table_begin();
	echo $this->build_form_table_title( $title );

	echo $this->build_form_table_text(_WEBLINKS_ADMIN_LIMIT,  'limit',  $limit);
	echo $this->build_form_table_text(_WEBLINKS_ADMIN_OFFSET, 'offset', $offset);
	echo $this->build_form_table_submit( '', 'post', _HAPPY_LINUX_EXECUTE );

	echo $this->build_form_table_end();
	echo $this->build_form_end();

}

function show_next($op, $title, $limit=0, $offset=0)
{
	$submit = sprintf( 'Next %s link', $limit);

	$desc  = '';
	$action = '';
	$text = $this->build_lib_box_limit_offset( $title, $desc, $limit, $offset, $op, $submit, $action);
	echo $text;
}

// --- class end ---
}


//=========================================================
// main
//=========================================================
// hack for multi site
weblinks_admin_multi_disable_feature();

$manage =& admin_link_check_manage::getInstance();
$op     =  $manage->get_post_op();

switch($op)
{
	case 'check':
		$manage->check_link();
		break;

	case 'update':
		$manage->update_pagerank();
		break;

	default:
		$manage->main_form();
		break;
}

xoops_cp_footer();
exit();
// --- end of main ---

?>