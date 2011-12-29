<?php
// $Id: command_manage.php,v 1.1 2011/12/29 14:32:54 ohwada Exp $

// 2007-11-01 K.OHWADA
// weblinks_admin_print_footer()

// 2007-10-10 K.OHWADA
// _HAPPY_LINUX_CONF_COMMAND_MANAGE

// 2007-02-20 K.OHWADA
// hack for multi site

// 2006-09-20 K.OHWADA
// this is new file
// move from other.php
// use bin_pass

//================================================================
// WebLinks Module
// 2006-09-20 K.OHWADA
//================================================================

include_once 'admin_header.php';
include_once 'admin_header_config.php';

// hack for multi site
weblinks_admin_multi_disable_feature();

// class
$config_form  =& admin_config_form::getInstance();
$config_store =& admin_config_store::getInstance();

$op = $config_form->get_post_get_op();

if ($op == 'save')
{
	if( !$config_form->check_token() ) 
	{
		xoops_cp_header();
		$config_form->print_xoops_token_error();
	}
	else
	{
		$config_store->save_config();
		redirect_header('command_manage.php', 1, _HAPPY_LINUX_UPDATED);
	}
}
else
{
	xoops_cp_header();
}

$pass = $config_form->get_value_by_name('bin_pass');
$url  = WEBLINKS_URL.'/bin/link_check.php?pass='.$pass.'&amp;limit=10';

weblinks_admin_print_header();
weblinks_admin_print_menu();

echo "<h4>"._HAPPY_LINUX_CONF_COMMAND_MANAGE."</h4>\n";
echo '<a href="create_config.php">'._HAPPY_LINUX_CONF_CREATE_CONFIG."</a><br /><br />\n";
echo '<a href="'.$url.'">'._HAPPY_LINUX_CONF_TEST_BIN.': bin/link_check.php</a>'."<br /><br/>\n";

echo "<h4>"._HAPPY_LINUX_CONF_BIN."</h4>\n";
echo _HAPPY_LINUX_CONF_BIN_DESC."<br /><br />\n";
$config_form->set_form_title( _HAPPY_LINUX_CONF_BIN );
$config_form->show_by_catid( 7 );

weblinks_admin_print_footer();
xoops_cp_footer();
exit();

?>