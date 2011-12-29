<?php
// $Id: config_manage_5.php,v 1.1 2011/12/29 14:32:56 ohwada Exp $

// 2007-11-01 K.OHWADA
// weblinks_admin_print_footer()

// 2007-09-20 K.OHWADA
// admin_header_config.php

// 2007-08-01 K.OHWADA
// divid from config_manage_3.php
// admin can add etc column

//=========================================================
// WebLinks Module
// 2006-09-20 K.OHWADA
//=========================================================

include_once 'admin_header.php';
include_once 'admin_header_config.php';

// class
$config_form  =& admin_config_form::getInstance();
$config_store =& admin_config_store::getInstance();
$link_handler =& weblinks_get_handler('link', WEBLINKS_DIRNAME);

$op = $config_form->get_post_get_op();

if ($op == 'save')
{
	if( !$config_form->check_token() ) 
	{
		xoops_cp_header();
		xoops_error("Token Error");
		echo "<br />\n";
		echo $config_form->get_token_error(1);
		echo "<br />\n";
	}
	else
	{
		$ret = $config_store->save_config();
		if ($ret)
		{
			redirect_header("config_manage_5.php", 1, _WLS_DBUPDATED);
		}
		else
		{
			xoops_cp_header();
			xoops_error("DB Error");
			echo $config_store->getErrors(1);
		}
	}
}
else
{
	xoops_cp_header();
}

$config_store->print_style_sheet();

weblinks_admin_print_header();
weblinks_admin_print_menu();
$config_form->print_menu_5();

$config_form->set_submit_value( _WEBLINKS_UPDATE );
$config_form->init_form();

$link_etc_arr   =& $link_handler->get_field_name_etc_array();
$link_etc_count = count($link_etc_arr);
$text_link_num_etc = sprintf( _AM_WEBLINKS_THERE_ARE_COLUMN, $link_etc_count );
$conf_link_num_etc = $config_form->get_value_by_name( 'link_num_etc' );

echo '<a name="form_post"></a>'."\n";
echo "<h4>". _WEBLINKS_ADMIN_POST ."</h4>\n";
echo "<ul>\n";
echo "<li>". _WEBLINKS_ADMIN_POST_TEXT_1 ."</li>\n";
echo "<li>". _WEBLINKS_ADMIN_POST_TEXT_2 ."</li>\n";
echo "<li>". _WEBLINKS_ADMIN_POST_TEXT_3 ."</li>\n";
echo "<li>". _AM_WEBLINKS_POST_TEXT_4 ."</li>\n";
echo "<li>". $text_link_num_etc ."</li>\n";
echo "<br /><ul>\n";

if ( WEBLINKS_USE_LINK_NUM_ETC )
{
	if ( $conf_link_num_etc > $link_etc_count )
	{
		$msg = sprintf(_AM_WEBLINKS_COLUMN_BIGGER_USE, $link_etc_count);
		echo $config_form->build_html_error_with_style($msg);
		echo "<br />\n";
	}

	$config_form->show_by_catid( 29, _WEBLINKS_ADMIN_POST );
	echo "<br />\n";
}

$config_form->show_form_linkitem( _WEBLINKS_ADMIN_POST );

weblinks_admin_print_footer();
xoops_cp_footer();
exit();
// --- main end ---

?>