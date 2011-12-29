<?php
// $Id: index.php,v 1.1 2011/12/29 14:32:53 ohwada Exp $

// 2008-12-20 K.OHWADA
// get_error_str()

// 2007-11-01 K.OHWADA
// admin_header_min.php
// weblinks_admin_print_powerdby()
// remove print_style_sheet()

// 2007-09-20 K.OHWADA
// admin_header_config.php
// check image work

// 2007-08-01 K.OHWADA
// divid to config_manage_2.php
// email linkbroken_notify

// 2007-06-10 K.OHWADA
// WEBLINKS_DEBUG_LINK_CATLINK_BASIC_SQL
// form_cat_page

// 2007-03-25 K.OHWADA
// form_index

// 2007-03-01 K.OHWADA
// renew config table
// WEBLINKS_DEBUG_CATEGORY_BASIC_SQL

// 2006-12-10 K.OHWADA
// use happy_linux_debug

// 2006-10-01 K.OHWADA
// use happy_linux
// divid to config_manage_3.php
// google map

// 2006-05-15 K.OHWADA
// renewal

//=========================================================
// WebLinks Module
// porting form RSSC 
// 2006-05-15 K.OHWADA
//=========================================================

include_once 'admin_header_min.php';

include_once XOOPS_ROOT_PATH.'/modules/happy_linux/api/module_install.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/dir.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/debug.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/server_info.php';

include_once WEBLINKS_ROOT_PATH.'/class/weblinks_locate.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_config2_define_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_linkitem_define_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_install.php';

include_once WEBLINKS_ROOT_PATH.'/admin/admin_config_menu_class.php';

//=========================================================
// main
//=========================================================

// PHP 5.2 + XC 2.1
$MEMORY_WEBLINKS_REQUIRE = 8;	// 8 MB

$DIR_CONFIG = WEBLINKS_ROOT_PATH.'/cache';

// class
$class_debug   =& happy_linux_debug::getInstance();
$class_info    =& happy_linux_server_info::getInstance();
$admin_menu    =& happy_linux_admin_menu::getInstance();
$config_menu   =& admin_config_menu::getInstance();
$install       =& weblinks_install::getInstance( WEBLINKS_DIRNAME );

$op = $install->get_post_op();

// email linkbroken_notify
if ($op == 'listBrokenLinks')
{
	redirect_header("broken_list.php", 1, _WLS_BROKENREPORTS);
}
elseif ($op == 'init')
{
	if( !$admin_menu->check_token() ) 
	{
		xoops_cp_header();
		$admin_menu->print_xoops_token_error();
	}
	else
	{
		$ret = $install->install();
		if ($ret)
		{
			redirect_header("index.php", 1, _WLS_DBUPDATED);
		}
		else
		{
			xoops_cp_header();
			xoops_error("DB Error");
			echo $install->get_message();
		}
	}
}
elseif ($op == 'upgrade')
{
	if( !$admin_menu->check_token() ) 
	{
		xoops_cp_header();
		$admin_menu->print_xoops_token_error();
	}
	else
	{
		$ret = $install->update();
		if ($ret)
		{
			redirect_header("index.php", 1, _WLS_DBUPDATED);
		}
		else
		{
			xoops_cp_header();
			xoops_error("DB Error");
			echo $install->get_message();
		}
	}
}
else
{
	xoops_cp_header();
}

weblinks_admin_print_header();

if ( !$install->check_install() )
{
	$admin_menu->print_form_init( 'admin/index.php' );
}
elseif ( !$install->check_update() )
{
	$admin_menu->print_form_upgrade(
		WEBLINKS_VERSION, $install->get_error_str() );
}
else
{
	if ( !is_writable( $DIR_CONFIG ) )
	{
		xoops_error( _HAPPY_LINUX_AM_DIR_NOT_WRITABLE );
		echo "<br />\n";
		echo $DIR_CONFIG."<br /><br />\n";
	}

	weblinks_admin_print_menu();

	$config_menu->print_menu_0();

	echo $class_info->build_server_env();
	echo $class_info->build_check_dir_work();

	echo "<h4>". _AM_WEBLINKS_DEBUG_CONF ."</h4>\n";
	$debug_arr = array(
		'WEBLINKS_DEBUG_ERROR',
		'WEBLINKS_DEBUG_CONFIG2_SQL',
		'WEBLINKS_DEBUG_LINKITEM_SQL',
		'WEBLINKS_DEBUG_CATEGORY_SQL',
		'WEBLINKS_DEBUG_CATLINK_SQL',
		'WEBLINKS_DEBUG_LINK_SQL',
		'WEBLINKS_DEBUG_MODIFY_SQL',
		'WEBLINKS_DEBUG_BROKEN_SQL',
		'WEBLINKS_DEBUG_VOTEDATA_SQL',
		'WEBLINKS_DEBUG_TABLE_CHECK_SQL',
		'WEBLINKS_DEBUG_CONFIG2_BASIC_SQL',
		'WEBLINKS_DEBUG_LINKITEM_BASIC_SQL',
		'WEBLINKS_DEBUG_CATEGORY_BASIC_SQL',
		'WEBLINKS_DEBUG_CATLINK_BASIC_SQL',	
		'WEBLINKS_DEBUG_LINK_BASIC_SQL',	
		'WEBLINKS_DEBUG_LINK_CATLINK_BASIC_SQL',
		'WEBLINKS_DEBUG_TIME',
		'WEBLINKS_DEV_PERMIT',
		'WEBLINKS_DEV_PERMIT_GUEST',
	);

	$class_debug->print_constant_by_array( $debug_arr, _AM_WEBLINKS_ALL_GREEN );
}

echo $class_info->build_check_memory_limit( $MEMORY_WEBLINKS_REQUIRE );
weblinks_admin_print_footer();
echo $admin_menu->build_powerdby();
xoops_cp_footer();
exit();
// --- main end ---

?>