<?php
// $Id: config_manage_3.php,v 1.1 2011/12/29 14:32:55 ohwada Exp $

// 2007-11-01 K.OHWADA
// form_link_user
// weblinks_admin_print_footer()

// 2007-09-20 K.OHWADA
// admin_header_config.php

// 2007-08-01 K.OHWADA
// divid form_post to config_manage_5.php

// 2007-02-20 K.OHWADA
// renew config table

// 2006-12-30 K.OHWADA
// _AM_WEBLINKS_POST_TEXT_4

// 2006-10-01 K.OHWADA
// this is new file
// devid from index.php

//=========================================================
// WebLinks Module
// 2006-09-20 K.OHWADA
//=========================================================

//---------------------------------------------------------
// TODO
// make function captcha
//---------------------------------------------------------

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
			redirect_header("config_manage_3.php", 1, _WLS_DBUPDATED);
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
$config_form->print_menu_3();

$config_form->set_submit_value( _WEBLINKS_UPDATE );
$config_form->init_form();

echo '<a name="form_link_register"></a>'."\n";
echo "<h4>"._AM_WEBLINKS_LINK_REGISTER."</h4>\n";
echo "<ul><li>"._AM_WEBLINKS_POST_TEXT."</li></ul><br />\n";
$config_form->show_form_link_register( _AM_WEBLINKS_LINK_REGISTER );
echo "<br />\n";

echo '<a name="form_link_register_1"></a>'."\n";
echo "<h4>"._AM_WEBLINKS_LINK_REGISTER_1."</h4>\n";
echo "<ul><li>"._AM_WEBLINKS_POST_TEXT."</li></ul><br />\n";
$config_form->show_form_link_register_1( _AM_WEBLINKS_LINK_REGISTER_1 );
echo "<br />\n";

echo '<a name="form_link_user"></a>'."\n";
echo "<h4>"._AM_WEBLINKS_CONF_LINK_USER."</h4>\n";
$config_form->show_by_catid( 35, _AM_WEBLINKS_CONF_LINK_USER );

echo '<a name="form_link_guest"></a>'."\n";
echo "<h4>"._AM_WEBLINKS_CONF_LINK_GUEST."</h4>\n";

if ( file_exists(XOOPS_ROOT_PATH.'/modules/captcha/include/version.php') ) 
{
	include_once XOOPS_ROOT_PATH.'/modules/captcha/include/version.php';
	$msg = sprintf( _AM_WEBLINKS_CAPTCHA_FINDED, CAPTCHA_VERSION );
	echo '<h4 style="color: #0000ff;">'.$msg."</h4>\n";
}
else
{
	echo '<h4 style="color: #ff0000;">'._AM_WEBLINKS_CAPTCHA_NOT_FINDED."</h4>\n";
}

$config_form->show_by_catid( 10, _AM_WEBLINKS_CONF_LINK_GUEST );

echo '<a name="form_submit"></a>'."\n";
echo "<h4>"._AM_WEBLINKS_CONF_SUBMIT."</h4>\n";
$config_form->show_by_catid( 11, _AM_WEBLINKS_CONF_SUBMIT );

echo '<a name="form_link"></a>'."\n";
echo "<h4>"._AM_WEBLINKS_CONF_LINK."</h4>\n";
$config_form->show_by_catid( 12, _AM_WEBLINKS_CONF_LINK );

echo '<a name="form_link_image"></a>'."\n";
echo "<h4>"._AM_WEBLINKS_CONF_LINK_IMAGE."</h4>\n";
$config_form->show_by_catid( 14, _AM_WEBLINKS_CONF_LINK_IMAGE );

weblinks_admin_print_footer();
xoops_cp_footer();
exit();
// --- main end ---

?>