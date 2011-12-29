<?php
// $Id: config_manage_2.php,v 1.1 2011/12/29 14:32:51 ohwada Exp $

// 2007-11-01 K.OHWADA
// _HAPPY_LINUX_CONF_BIN
// weblinks_admin_print_footer()

// 2007-09-20 K.OHWADA
// admin_header_config.php

// 2007-08-01 K.OHWADA
// divid from index.php

//=========================================================
// WebLinks Module
// porting form RSSC 
// 2006-05-15 K.OHWADA
//=========================================================

include_once 'admin_header.php';
include_once 'admin_header_config.php';

// class
$config_form  =& admin_config_form::getInstance();
$config_store =& admin_config_store::getInstance();

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
			redirect_header("config_manage_2.php", 1, _WLS_DBUPDATED);
		}
		else
		{
			xoops_cp_header();
			xoops_error("DB Error");
			echo $config_store->getErrors(1);
		}
	}
}
elseif ($op == 'template_compiled_clear')
{
	if( !$config_form->check_token() ) 
	{
		xoops_cp_header();
		$config_form->print_xoops_token_error();
	}
	else
	{
		$config_store->template_compiled_clear();
		redirect_header("config_manage_2.php", 1, _HAPPY_LINUX_CLEARED );
	}
}
else
{
	xoops_cp_header();
}

$config_store->print_style_sheet();

weblinks_admin_print_header();
weblinks_admin_print_menu();
$config_form->print_menu_2();

$config_form->set_submit_value( _WEBLINKS_UPDATE );
$config_form->init_form();

echo '<a name="form_acess"></a>'."\n";
echo "<h4>"._WEBLINKS_ADMIN_AUTH."</h4>\n";
echo "<ul><li>"._WEBLINKS_ADMIN_AUTH_TEXT."</li></ul><br />\n";
$config_form->show_form_auth( _WEBLINKS_ADMIN_AUTH );

echo '<a name="form_cat"></a>'."\n";
echo "<h4>"._WEBLINKS_ADMIN_CAT_SET."</h4>\n";
$config_form->show_by_catid( 2, _WEBLINKS_ADMIN_CAT_SET );

echo '<a name="form_view"></a>'."\n";
echo "<h4>"._AM_WEBLINKS_CONF_VIEW."</h4>\n";
$config_form->show_by_catid( 3, _AM_WEBLINKS_CONF_VIEW );

echo '<a name="form_index"></a>'."\n";
echo "<h4>"._AM_WEBLINKS_CONF_INDEX."</h4>\n";
$config_form->show_by_catid( 23, _AM_WEBLINKS_CONF_INDEX );

echo '<a name="form_cat_page"></a>'."\n";
echo "<h4>"._AM_WEBLINKS_CONF_CAT_PAGE."</h4>\n";
$config_form->show_by_catid( 26, _AM_WEBLINKS_CONF_CAT_PAGE );

echo '<a name="form_topten"></a>'."\n";
echo "<h4>"._AM_WEBLINKS_CONF_TOPTEN."</h4>\n";
$config_form->show_by_catid( 4, _AM_WEBLINKS_CONF_TOPTEN );

echo '<a name="form_seach"></a>'."\n";
echo "<h4>"._AM_WEBLINKS_CONF_SEARCH."</h4>\n";
$config_form->show_by_catid( 5, _AM_WEBLINKS_CONF_SEARCH );

echo '<a name="form_style"></a>'."\n";
echo "<h4>"._AM_WEBLINKS_CONF_HTML_STYLE."</h4>\n";
$config_form->show_by_catid( 33, _AM_WEBLINKS_CONF_HTML_STYLE );

echo '<a name="form_performance"></a>'."\n";
echo "<h4>"._AM_WEBLINKS_CONF_PERFORMANCE."</h4>\n";
echo _AM_WEBLINKS_CONF_PERFORMANCE_DSC."<br /><br />\n";
$config_form->show_by_catid( 6, _AM_WEBLINKS_CONF_PERFORMANCE );

echo '<a name="form_template"></a>'."\n";
echo "<h4>"._HAPPY_LINUX_CONF_TPL_COMPILED_CLEAR."</h4>\n";
$config_form->show_form_template_compiled_clear( _HAPPY_LINUX_CONF_TPL_COMPILED_CLEAR );

weblinks_admin_print_footer();
xoops_cp_footer();
exit();
// --- main end ---

?>