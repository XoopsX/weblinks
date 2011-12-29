<?php
// $Id: table_manage.php,v 1.1 2011/12/29 14:32:55 ohwada Exp $

// 2007-12-24 K.OHWADA
// _print_menu_rebuild_search()

// 2007-11-24 K.OHWADA
// divid to table_manage_zombie.php
// move clean_xml() from table_clean_xml.php
// happy_linux_table_manage()

// 2007-11-01 K.OHWADA
// weblinks_admin_print_footer()

// 2007-10-10 K.OHWADA
// xoops block table

// 2007-02-20 K.OHWADA
// hack for multi site
// show_clean_xml()

// 2006-09-20 K.OHWADA
// use happy_linux

// 2006-05-15 K.OHWADA
// use weblinks_db_basic_base

// 2005-10-14 K.OHWADA
// corresponding to too many links

//================================================================
// WebLinks Module
// check table validation
// 2005-01-20 K.OHWADA
//================================================================

include 'admin_header.php';
include 'admin_header_config.php';

include_once XOOPS_ROOT_PATH.'/modules/happy_linux/api/module_install.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/table_manage.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/xoops_block_checker.php';

include_once WEBLINKS_ROOT_PATH.'/class/weblinks_modify.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_install.php';
include_once WEBLINKS_ROOT_PATH.'/admin/table_manage_zombie_class.php';

//================================================================
// class admin_table_manage
//================================================================
class admin_table_manage extends happy_linux_table_manage
{
	var $_zombie;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_table_manage()
{
	$this->happy_linux_table_manage( WEBLINKS_DIRNAME );

	$this->set_config_handler('config2', WEBLINKS_DIRNAME, 'weblinks');
	$this->set_config_define( weblinks_config2_define::getInstance( WEBLINKS_DIRNAME ) );
	$this->set_install_class( weblinks_install::getInstance( WEBLINKS_DIRNAME ) );
	$this->set_xoops_block_checker();

	$this->_zombie  =& admin_table_manage_zombie::getInstance();

}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_table_manage();
	}
	return $instance;
}

//---------------------------------------------------------
// menu
//---------------------------------------------------------
function menu()
{
	weblinks_admin_print_header();
	weblinks_admin_print_menu();

	$this->print_title();

// weblinks table
	$this->print_table_check( 'config2' );
	$this->check_config_table();
	$this->_check_table_for_weblinks( 'linkitem' );
	$this->_check_table_for_weblinks( 'category' );
	$this->_check_table_for_weblinks( 'link' );
	$this->_check_table_for_weblinks( 'modify' );
	$this->_check_table_for_weblinks( 'catlink' );
	$this->_check_table_for_weblinks( 'broken' );
	$this->_check_table_for_weblinks( 'votedata' );

// xoops block table
	$this->check_xoops_block_table();
	$this->print_form_remove_xoops_block_table();

// check zombie
	$this->_zombie->print_menu_zombie( 'table_manage_zombie.php' );

	$this->_print_menu_rssc();
	$this->_print_menu_xml();
	$this->_print_menu_rebuild_search();

}

function _check_table_for_weblinks( $table )
{
	$this->print_table_check( $table );
	$this->check_table_scheme_by_name( $table, WEBLINKS_DIRNAME, 'weblinks' );
}

function _print_menu_rssc()
{
	$title  = 'RSSC Check';

	echo "<h4>".$title."</h4>\n";

	echo $this->_form->build_lib_box_button_style(
		$title,
		'check adjustment of Weblinks link table and RSSC link table', 
		'check_link',
		_HAPPY_LINUX_EXECUTE,
		'table_manage_rssc.php'
	);
}

function _print_menu_xml()
{
	$title  = 'Clear xml in link table';

	echo "<h4>".$title."</h4>\n";

	echo $this->_form->build_lib_box_button_style(
		$title,
		'since v1.20, rss_xml field in link table became unnecessary', 
		'clean_xml',
		_HAPPY_LINUX_EXECUTE
	);

}

function _print_menu_rebuild_search()
{
	$title  = 'Rebuild search field';

	echo "<h4>".$title."</h4>\n";

	echo $this->_form->build_lib_box_button_style(
		$title,
		'Bug fix : necessary in the version up from v1.82 or before', 
		'rebuild',
		_HAPPY_LINUX_EXECUTE,
		'table_manage_search.php'
	);

}

//---------------------------------------------------------
// action
//---------------------------------------------------------
function clean_xml()
{
	if( !$this->check_token() ) 
	{
		xoops_cp_header();
		$this->print_bread( 'clean xml' );
		xoops_error("Token Error");
		xoops_cp_footer();
		exit();
	}

	$link_handler =& weblinks_get_handler( 'link', WEBLINKS_DIRNAME );

	$ret = $link_handler->clean_rss_xml();
	if ( $ret )
	{
		$time = 1;
		$msg  = _HAPPY_LINUX_EXECUTED;
	}
	else
	{
		$time = 3;
		$msg  = _HAPPY_LINUX_FAILED;
		$msg .= $link_handler->getErrors(1);
	}

	redirect_header( $this->_this_url, $time, $msg );
	exit();
}

// --- class end ---
}

//================================================================
// main
//================================================================
// hack for multi site
weblinks_admin_multi_disable_feature();

$manage =& admin_table_manage::getInstance();

$op = $manage->get_post_op();

switch ($op) 
{
case 'renew_config':
	$manage->renew_config();
	break;

case 'clean_xml':
	$manage->clean_xml();
	break;

case 'remove_block':
	xoops_cp_header();
	$manage->remove_block();
	break;

case 'menu':
default:
	xoops_cp_header();
	$manage->menu();
	break;

}

weblinks_admin_print_footer();
xoops_cp_footer();
exit();
// --- main end ---

?>