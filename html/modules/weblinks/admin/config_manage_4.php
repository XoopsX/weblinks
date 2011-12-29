<?php
// $Id: config_manage_4.php,v 1.1 2011/12/29 14:32:56 ohwada Exp $

// 2007-11-11 K.OHWADA
// move form_locate from config_manage_4.php
// weblinks_admin_print_footer()

// 2007-09-20 K.OHWADA
// admin_header_config.php

// 2007-08-01 K.OHWADA
// divid google map to config_manage_6.php

// 2007-06-10 K.OHWADA
// d3forum

// 2007-03-25 K.OHWADA
// form_cat_album

// 2007-02-20 K.OHWADA
// hack for multi site
// renew config table

// 2006-11-03 K.OHWADA
// google map inline mode

// 2006-10-15 wye & K.OHWADA
// BUG 4313: same browser like opera cannot show gm_get_location.php

// 2006-10-05 K.OHWADA
// this is new file
// devid from index.php
// use rssc WEBLINKS_RSSC_EXIST

//=========================================================
// WebLinks Module
// 2006-10-05 K.OHWADA
//=========================================================

//---------------------------------------------------------
// TODO
// make function RSSC installed
//---------------------------------------------------------

include_once 'admin_header.php';
include_once 'admin_header_config.php';

// class
$config_form  =& admin_config_form::getInstance();
$config_store =& admin_config_store::getInstance();
$link_form_handler =& weblinks_get_handler( 'link_form', WEBLINKS_DIRNAME );

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
			redirect_header("config_manage_4.php", 1, _WLS_DBUPDATED);
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
$config_form->print_menu_4();
echo "<br />\n";
$config_form->set_submit_value( _WEBLINKS_UPDATE );
$config_form->init_form();

echo '<a name="form_rss"></a>'."\n";
echo "<h4>"._WEBLINKS_ADMIN_RSS."</h4>\n";
$config_form->print_rssc_module_installed();
$config_form->show_by_catid( 15, _WEBLINKS_ADMIN_RSS );

echo '<a name="form_rss_view"></a>'."\n";
echo "<h4>"._WEBLINKS_ADMIN_RSS_VIEW."</h4>\n";
$config_form->show_by_catid( 16, _WEBLINKS_ADMIN_RSS_VIEW );

echo '<a name="form_cat_forum"></a>'."\n";
echo "<h4>"._AM_WEBLINKS_CONF_CAT_FORUM."</h4>\n";
$config_form->print_module_installed_by_conf( 'forum', 'cat_forum_dirname' );
$config_form->show_by_catid( 17, _AM_WEBLINKS_CONF_CAT_FORUM );

echo '<a name="form_link_forum"></a>'."\n";
echo "<h4>"._AM_WEBLINKS_CONF_LINK_FORUM."</h4>\n";
$config_form->print_module_installed_by_conf( 'forum', 'link_forum_dirname' );
$config_form->show_by_catid( 18, _AM_WEBLINKS_CONF_LINK_FORUM );

echo '<a name="form_cat_album"></a>'."\n";
echo "<h4>"._AM_WEBLINKS_CONF_CAT_ALBUM."</h4>\n";
$config_form->print_module_installed_by_conf( 'album', 'cat_album_dirname' );
$config_form->show_by_catid( 24, _AM_WEBLINKS_CONF_CAT_ALBUM );

echo '<a name="form_link_album"></a>'."\n";
echo "<h4>"._AM_WEBLINKS_CONF_LINK_ALBUM."</h4>\n";
$config_form->print_module_installed_by_conf( 'album', 'link_album_dirname' );
$config_form->show_by_catid( 25, _AM_WEBLINKS_CONF_LINK_ALBUM );

echo '<a name="form_d3forum"></a>'."\n";
echo "<h4>"._AM_WEBLINKS_CONF_D3FORUM."</h4>\n";
$config_form->print_d3forum_module_installed();
$config_form->show_by_catid( 27, _AM_WEBLINKS_CONF_D3FORUM );

// hack for multi site
//if ( WEBLINKS_FLAG_MULTI_SITE )
//{
//	echo '<a name="form_multi_site"></a>'."\n";
//	echo "<h4>".'multi site'."</h4>\n";
//	$config_form->show_by_catid( 23, 'multi site' );
//}

weblinks_admin_print_footer();
xoops_cp_footer();
exit();
// --- main end ---

?>