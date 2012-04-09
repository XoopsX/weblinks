<?php
// $Id: admin_functions.php,v 1.2 2012/04/09 10:20:04 ohwada Exp $

// 2012-03-01 K.OHWADA
// changed weblinks_admin_print_menu()

// 2008-02-17 K.OHWADA
// config_manage_7.php
// output_plugin_manage.php
// link_check_manage.php

// 2007-11-24 K.OHWADA
// _HAPPY_LINUX_CONF_TABLE_MANAGE

// 2007-11-11 K.OHWADA
// happy_linux_admin_menu
// happy_linux_basic_handler
// modules.php

// 2007-09-01 K.OHWADA
// waiting delele
// notification_manage.php

// 2007-07-22 K.OHWADA
// admin can add etc column

// 2007-06-01 K.OHWADA
// menu: preference.php blocks.php
// rssc_view_handler

// 2007-05-18 K.OHWADA
// XC 2.1: preferences

// 2007-02-20 K.OHWADA
// hack for multi site

// 2006-10-01 K.OHWADA
// use happy_linux
// use rssc WEBLINKS_RSSC_EXIST
// remove weblinks_admin_check_token()

// 2006-05-15 K.OHWADA
// weblinks_admin_print_header()
// weblinks_admin_print_menu()

// 2006-03-22 K.OHWADA
// use new handler: votedata

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication
// from include/functions

//=========================================================
// WebLinks Module
// admin functions
// 2004-12-05 K.OHWADA
//=========================================================

function weblinks_admin_print_header()
{
	$menu =& happy_linux_admin_menu::getInstance();
	echo $menu->build_header( WEBLINKS_DIRNAME, _MI_WEBLINKS_DESC );
}

function weblinks_admin_print_footer()
{
	$menu =& happy_linux_admin_menu::getInstance();
	echo $menu->build_footer();
}

function weblinks_admin_print_bread( $name1, $url1='', $name2='' )
{
	$system =& happy_linux_system::getInstance();
	$form   =& happy_linux_form::getInstance();

	$arr = array(
		array(
			'name' => $system->get_module_name(),
			'url'  => 'index.php',
		),
	);

	if ( $name1 )
	{
		$arr[] = array(
			'name' => $name1,
			'url'  => $url1,
		);
	}

	if ( $name2 )
	{
		$arr[] = array(
			'name' => $name2,
		);
	}

	echo $form->build_html_bread_crumb( $arr );
}

function weblinks_admin_print_menu()
{
	$MAX_COL = 4;

	$menu            =& happy_linux_admin_menu::getInstance();
	$handler         =& happy_linux_basic_handler::getInstance( WEBLINKS_DIRNAME );
	$link_handler    =& weblinks_get_handler('link_basic',   WEBLINKS_DIRNAME);
	$modify_handler  =& weblinks_get_handler('modify_basic', WEBLINKS_DIRNAME );

	$total_cat     = $handler->get_count_by_tablename( 'category' );
	$total_vote    = $handler->get_count_by_tablename( 'votedata' );
	$total_catlink = $handler->get_count_by_tablename( 'catlink' );
	$total_broken  = $handler->get_count_by_tablename( 'broken' );
	$total_link    = $link_handler->get_count_all();
	$total_nourl   = $link_handler->get_count_non_url();

	$total_brokenlinks = $link_handler->get_count_broken();
	$total_brokenlinks = $menu->highlight_number($total_brokenlinks);

	$total_newlinks = $modify_handler->get_count_new();
	$total_newlinks = $menu->highlight_number($total_newlinks);

	$total_modify = $modify_handler->get_count_mod();
	$total_modify = $menu->highlight_number($total_modify);

	$total_delete = $modify_handler->get_count_del();
	$total_delete = $menu->highlight_number($total_delete);

	$total_broken = $menu->highlight_number($total_broken);

	$link_list    = _WEBLINKS_ADMIN_LINK_LIST.     " ($total_link)";
	$cat_list     = _WEBLINKS_ADMIN_CATEGORY_LIST. " ($total_cat)";
	$vote_list    = _AM_WEBLINKS_VOTE_LIST.        " ($total_vote)";
	$catlink_list = _AM_WEBLINKS_CATLINK_LIST.     " ($total_catlink)";

	$title_link = _WEBLINKS_ADMIN_LINK_MANAGE."<br />"._WEBLINKS_ADMIN_ADD_LINK;

	$title_brokenlinks = _WEBLINKS_ADMIN_LINK_BROKEN." ($total_brokenlinks)";
	$title_newlinks    = _WLS_LINKSWAITING. " ($total_newlinks)";
	$title_modify      = _WLS_MODREQUESTS.  " ($total_modify)";
	$title_broken      = _WLS_BROKENREPORTS." ($total_broken)";
	$title_delete      = _AM_WEBLINKS_DEL_REQS. " ($total_delete)";

	$config_0 = _AM_WEBLINKS_MODULE_CONFIG_0 .  '<br /> ('._AM_WEBLINKS_MODULE_CONFIG_DESC_0.') '; 
	$config_2 = _WEBLINKS_ADMIN_MODULE_CONFIG_2.'<br /> ('._AM_WEBLINKS_MODULE_CONFIG_DESC_2.') '; 
	$config_3 = _AM_WEBLINKS_MODULE_CONFIG_3 .  '<br /> ('._AM_WEBLINKS_MODULE_CONFIG_DESC_3.') '; 
	$config_4 = _AM_WEBLINKS_MODULE_CONFIG_4 .  '<br /> ('._AM_WEBLINKS_MODULE_CONFIG_DESC_4.') '; 
	$config_5 = _AM_WEBLINKS_MODULE_CONFIG_5 .  '<br /> ('._AM_WEBLINKS_MODULE_CONFIG_DESC_5.') '; 
	$config_6 = _AM_WEBLINKS_MODULE_CONFIG_6 .  '<br /> ('._AM_WEBLINKS_MODULE_CONFIG_DESC_6.') '; 
	$config_7 = _AM_WEBLINKS_MODULE_CONFIG_7 .  '<br /> ('._AM_WEBLINKS_MODULE_CONFIG_DESC_7.') '; 

	$column = '('._AM_WEBLINKS_COLUMN_MANAGE.')';

	if ( WEBLINKS_RSSC_EXIST && WEBLINKS_RSSC_USE )
	{
		$total_feed = $handler->get_count_by_tablename( 'feed', WEBLINKS_RSSC_DIRNAME );
		$url_rssc_feed_list = WEBLINKS_RSSC_URL.'/admin/archive_manage.php';
	}
	else
	{
		$total_feed = 0;
		$url_rssc_feed_list = '';
	}

	$feed_list = _AM_WEBLINKS_RSSC_MANAGE.    " ($total_feed)";

	$menu_arr = array(

		$config_0                       => 'index.php',
		_WEBLINKS_ADMIN_MODULE_CONFIG_1 => 'preferences.php',
		$config_2                       => 'config_manage_2.php',
		$config_3                       => 'config_manage_3.php',

		$config_4                    => 'config_manage_4.php',
		$config_5                    => 'config_manage_5.php',
		$config_6                    => 'config_manage_6.php',
		$config_7                    => 'config_manage_7.php',

		$cat_list     => 'category_list.php',
		$link_list    => 'link_list.php',
		$vote_list    => 'votedata_list.php',
		$catlink_list => 'catlink_list.php',

		_AM_WEBLINKS_ADD_CATEGORY       => 'category_manage.php',
		_WEBLINKS_ADMIN_ADD_LINK        => 'link_manage.php',
		_AM_WEBLINKS_BULK_IMPORT        => 'bulk_manage.php',
		_AM_WEBLINKS_LINK_CHECK_MANAGE  => 'link_check_manage.php',

		$title_newlinks           => 'modify_list.php?op=list_new',
		$title_modify             => 'modify_list.php?op=list_mod',
		$title_delete             => 'modify_list.php?op=list_del',
		$title_brokenlinks        => 'link_list.php?op=list_broken',

		_WEBLINKS_ADMIN_USER_MANAGE      => 'user_list.php',
		_WEBLINKS_ADMIN_SENDMAIL         => 'mail_users.php',
		_AM_WEBLINKS_NOTIFICATION_MANAGE => 'notification_manage.php',
		$title_broken                    => 'broken_list.php',

		_HAPPY_LINUX_CONF_COMMAND_MANAGE => 'command_manage.php',
		_AM_WEBLINKS_IMPORT_MANAGE       => 'import_manage.php',
		_AM_WEBLINKS_EXPORT_MANAGE       => 'export_manage.php',
		_HAPPY_LINUX_CONF_RSS_MANAGE     => 'rss_build_manage.php',

		_AM_WEBLINKS_OUTPUT_PLUGIN_MANAGE => 'output_plugin_manage.php',
		_AM_WEBLINKS_MAP_JP_MANAGE        => 'map_jp_manage.php',
		$column     => 'column_manage.php',
		$feed_list  => 'rssc_manage.php',

		_HAPPY_LINUX_CONF_TABLE_MANAGE => 'table_manage.php',
		_HAPPY_LINUX_AM_MODULE         => 'modules.php',
		_HAPPY_LINUX_AM_BLOCK          => 'blocks.php',
		_HAPPY_LINUX_GOTO_MODULE       => '../index.php',

	);

	echo $menu->build_menu_table($menu_arr, $MAX_COL);
}

//---------------------------------------------------------
// hack for multi site
//---------------------------------------------------------
function weblinks_admin_multi_disable_feature()
{
	if ( weblinks_multi_is_english_site() )
	{
		redirect_header( 'index.php', 1, _WEBLINKS_DISABLE_FEATURE);
	}
}

function weblinks_admin_multi_redirect_jp_site()
{
	if ( weblinks_multi_is_english_site() )
	{
// Engilsh site goto Japanese site
		$url    = xoops_getenv('REQUEST_URI');
		$url_jp = str_replace('/en/', '/jp/', $url);
		redirect_header( $url_jp, 1, _WEBLINKS_REDIRECT_JP_SITE);
	}
}

?>