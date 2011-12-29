<?php
// $Id: config_manage_7.php,v 1.1 2011/12/29 14:32:54 ohwada Exp $

//=========================================================
// WebLinks Module
// 2008-02-17 K.OHWADA
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
			redirect_header("config_manage_7.php", 1, _WLS_DBUPDATED);
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

$config_form->print_menu_7();

echo "<br />\n";

$config_form->set_submit_value( _WEBLINKS_UPDATE );
$config_form->init_form();

echo '<a name="form_menu"></a>'."\n";
echo "<h4>"._AM_WEBLINKS_CONF_MENU."</h4>\n";
echo _AM_WEBLINKS_CONF_MENU_DESC."<br /><br />\n";
$config_form->show_by_catid( 36, _AM_WEBLINKS_CONF_MENU );

echo '<a name="form_title"></a>'."\n";
echo "<h4>"._AM_WEBLINKS_CONF_TITLE."</h4>\n";
$config_form->show_by_catid( 37, _AM_WEBLINKS_CONF_TITLE );

weblinks_admin_print_footer();
xoops_cp_footer();
exit();
// --- main end ---

?>