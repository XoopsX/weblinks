<?php
// $Id: column_manage.php,v 1.1 2011/12/29 14:32:52 ohwada Exp $

//=========================================================
// WebLinks Module
// 2007-08-01 K.OHWADA
//=========================================================

include 'admin_header.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/config_base_handler.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/config_define_handler.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/config_store_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_config2_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_config2_define_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_linkitem_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_linkitem_define_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_linkitem_store_handler.php';

//=========================================================
// class admin_column_manage
//=========================================================
class admin_column_manage extends happy_linux_error
{
	var $_link_handler;
	var $_modify_handler;
	var $_config_handler;
	var $_linkitem_store_handler;
	var $_form;
	var $_post;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_column_manage()
{
	$this->_link_handler   =& weblinks_get_handler('link',    WEBLINKS_DIRNAME);
	$this->_modify_handler =& weblinks_get_handler('modify',  WEBLINKS_DIRNAME);
	$this->_config_handler =& weblinks_get_handler('config2', WEBLINKS_DIRNAME );
	$this->_linkitem_store_handler =& weblinks_get_handler('linkitem_store', WEBLINKS_DIRNAME );

	$this->_form     =& admin_column_form::getInstance();
	$this->_post     =& happy_linux_post::getInstance();
}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_column_manage();
	}
	return $instance;
}

//---------------------------------------------------------
// post parameter
//---------------------------------------------------------
function get_post_op()
{
	return $this->_post->get_post_text('op');
}

function get_post_num()
{
	return $this->_post->get_post_int('num');
}

//---------------------------------------------------------
// add_column
//---------------------------------------------------------
function add_column()
{
	$num = $this->get_post_num();

	if ( $num <= 0 )
	{
		$msg = sprintf(_HAPPY_LINUX_ERR_FILL, _AM_WEBLINKS_COLUMN_NUM);
		return $msg;
	}

	$etc_arr =& $this->_link_handler->get_field_name_etc_array();
	$count   = count($etc_arr);
	$start   = $count + 1;
	$end     = $count + $num;

	$ret = $this->_link_handler->add_column_table_etc($start, $end);
	if ( !$ret )
	{
		$this->_set_errors( $this->_link_handler->getErrors() );
	}

	$ret = $this->_modify_handler->add_column_table_etc($start, $end);
	if ( !$ret )
	{
		$this->_set_errors( $this->_modify_handler->getErrors() );
	}

	$ret = $this->_config_handler->update_by_name('link_num_etc', $end);
	if ( !$ret )
	{
		$this->_set_errors( $this->_config_handler->getErrors() );
	}

	$this->_linkitem_store_handler->set_num_etc($end);
	$ret = $this->_linkitem_store_handler->upgrade();
	if ( !$ret )
	{
		$this->_set_errors( $this->_config_linkitem_handler->getErrors() );
	}

	if ( ! $this->returnExistError() )
	{
		$msg  = "DB Error <br />\n";
		$msg .= $this->getErrors('s');
		return $msg;
	}

	redirect_header("column_manage.php", 1, _HAPPY_LINUX_ADDED);
	exit();
}

//---------------------------------------------------------
// form
//---------------------------------------------------------
function check_etc_column()
{
	$link_etc_arr   =& $this->_link_handler->get_field_name_etc_array();
	$modify_etc_arr =& $this->_modify_handler->get_field_name_etc_array();

	$count = count($link_etc_arr);

	echo sprintf(_AM_WEBLINKS_THERE_ARE_COLUMN, $count)." <br />\n";

	foreach ($link_etc_arr as $name)
	{
		echo "- ". $name ." <br />\n";
	}
	echo "<br />\n";

	if ($link_etc_arr != $modify_etc_arr)
	{
		
	}
}

function print_form()
{
	$link_etc_arr   =& $this->_link_handler->get_field_name_etc_array();
	$modify_etc_arr =& $this->_modify_handler->get_field_name_etc_array();

	$count = count($link_etc_arr);

	echo sprintf(_AM_WEBLINKS_THERE_ARE_COLUMN, $count)." <br />\n";

	foreach ($link_etc_arr as $name)
	{
		echo "- ". $name ." <br />\n";
	}
	echo "<br />\n";

	if ($link_etc_arr != $modify_etc_arr)
	{
		$msg  = _AM_WEBLINKS_COLUMN_UNMATCH ."<br />\n";
		$msg .= _AM_WEBLINKS_PHPMYADMIN ."<br />\n";
		$this->print_error_in_div( $msg, false );
	}

	$this->_form->print_form();
}

function check_token()
{
	$ret = $this->_form->check_token();
	return $ret;
}

// --- class end ---
}


//=========================================================
// class admin_column_manage
//=========================================================
class admin_column_form extends happy_linux_form_lib
{
	var $_link_handler;
	var $_system; 
	var $_post;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_column_form()
{
	$this->happy_linux_form_lib();

	$this->_link_handler =& weblinks_get_handler('link', WEBLINKS_DIRNAME);
	$this->_system       =& happy_linux_system::getInstance();
	$this->_post         =& happy_linux_post::getInstance();
}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_column_form();
	}
	return $instance;
}

//---------------------------------------------------------
// form
//---------------------------------------------------------
function print_form()
{
	$num = $this->_post->get_post_int('num');

	echo $this->build_form_begin( 'column_form' );
	echo $this->build_token();
	echo $this->build_html_input_hidden('op', 'add_column');
	echo $this->build_form_table_begin();
	echo $this->build_form_table_title( _AM_WEBLINKS_COLUMN_MANAGE );
	echo $this->build_form_table_text( _AM_WEBLINKS_COLUMN_NUM, 'num',  $num );
	echo $this->build_form_table_submit( '', 'submit', _HAPPY_LINUX_ADD );
	echo $this->build_form_table_end();
	echo $this->build_form_end();
}

// --- class end ---
}

//=========================================================
// main
//=========================================================
$manage =& admin_column_manage::getInstance();

$op = $manage->get_post_op();
$error = '';

if ( $op == 'add_column' ) 
{
	if ( !( $manage->check_token() ) )
	{
		redirect_header("column_manage.php", 5, "Token Error");
		exit();
	}

	$error = $manage->add_column();
}

xoops_cp_header();
weblinks_admin_print_header();
weblinks_admin_print_menu();
echo "<h4>". _AM_WEBLINKS_COLUMN_MANAGE ."</h4>\n";
echo _AM_WEBLINKS_COLUMN_MANAGE_DESC ."<br /><br />\n";

if ( WEBLINKS_USE_LINK_NUM_ETC )
{
	if ($error)
	{
		$manage->print_error_in_div($error, false);
	}
	$manage->print_form();
}
else
{
	echo '<h4 style="color: #ff0000;">'. _AM_WEBLINKS_COLUMN_MANAGE_NOT_USE ."</h4>\n";
}

xoops_cp_footer();
exit();

?>