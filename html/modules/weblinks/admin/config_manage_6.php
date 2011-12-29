<?php
// $Id: config_manage_6.php,v 1.1 2011/12/29 14:32:51 ohwada Exp $

// 2008-02-17 K.OHWADA
// print_kml_list()

// 2007-11-11 K.OHWADA
// move form_locate from config_manage_4.php
// weblinks_admin_print_footer()

// 2007-09-20 K.OHWADA
// admin_header_config.php

// 2007-08-01 K.OHWADA
// divid from config_manage_4.php

//=========================================================
// WebLinks Module
// 2006-10-05 K.OHWADA
//=========================================================

include_once 'admin_header.php';
include_once 'admin_header_config.php';

// class
$config_form  =& admin_config_form::getInstance();
$config_store =& admin_config_store::getInstance();
$weblinks_header =& weblinks_header::getInstance( WEBLINKS_DIRNAME );
$weblinks_gmap   =& weblinks_gmap::getInstance(   WEBLINKS_DIRNAME );

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
			redirect_header("config_manage_6.php", 1, _WLS_DBUPDATED);
		}
		else
		{
			xoops_cp_header();
			xoops_error("DB Error");
			echo $config_store->getErrors(1);
		}
	}
}
elseif ($op == 'renew')
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
		$ret = $config_store->renew_config();
		if ($ret)
		{
			redirect_header("config_manage_6.php", 1, _WLS_DBUPDATED);
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

echo $weblinks_header->build_module_header_submit();

weblinks_admin_print_header();
weblinks_admin_print_menu();
$config_form->print_menu_6();
echo "<br />\n";
$config_form->set_submit_value( _WEBLINKS_UPDATE );
$config_form->init_form();

echo '<a name="form_locate"></a>'."\n";
echo "<h4>"._AM_WEBLINKS_CONF_LOCATE."</h4>\n";
$config_form->show_form_country_code( _AM_WEBLINKS_CONF_LOCATE );

echo '<a name="form_map"></a>'."\n";
echo "<h4>"._AM_WEBLINKS_CONF_MAP."</h4>\n";
$config_form->show_by_catid( 20, _AM_WEBLINKS_CONF_MAP );
echo "<br />\n";

echo '<a name="form_google_seach"></a>'."\n";
echo "<h4>"._AM_WEBLINKS_CONF_GOOGLE_SEARCH."</h4>\n";
$config_form->show_by_catid( 22, _AM_WEBLINKS_CONF_GOOGLE_SEARCH );

// google map: hacked by wye
echo '<a name="form_google_map"></a>'."\n";
echo "<h4>"._AM_WEBLINKS_CONF_GOOGLE_MAP."</h4>\n";

// BUG 4313: same browser like opera cannot show gm_get_location.php
echo $weblinks_gmap->build_form_desc();
echo "<br /><br />\n";
echo $weblinks_gmap->build_form_iframe();
echo "<br />\n";

$config_form->show_by_catid( 21, _AM_WEBLINKS_CONF_GOOGLE_MAP );

echo '<a name="form_index"></a>'."\n";
echo "<h4>"._AM_WEBLINKS_CONF_INDEX."</h4>\n";
$config_form->show_by_catid( 29, _AM_WEBLINKS_CONF_INDEX );

echo '<a name="form_cat_page"></a>'."\n";
echo "<h4>"._AM_WEBLINKS_CONF_CAT_PAGE."</h4>\n";
$config_form->show_by_catid( 30, _AM_WEBLINKS_CONF_CAT_PAGE );

print_kml_list();

weblinks_admin_print_footer();
xoops_cp_footer();
exit();
// --- main end ---


//=========================================================
// function
//=========================================================
function print_kml_list()
{
	$link_handler =& weblinks_get_handler( 'link_basic', WEBLINKS_DIRNAME );

	$kml_perpage = isset($_GET['kml_perpage']) ? intval($_GET['kml_perpage']) : WEBLINKS_C_KML_PERPAGE;

	$total     = $link_handler->get_count_gmap();
	$max_page  = $link_handler->get_gmap_kml_page( $total, $kml_perpage );

	echo '<a name="gm_kml_debug"></a>'."\n";
	echo '<h4>'._WEBLINKS_GM_KML_DEBUG.'</h4>'."\n";
	printf(_WLS_THEREARE, $total);
	echo "<br /><br />\n";

	echo '<form method="get">'."\n";
	echo _WEBLINKS_KML_PERPAGE;
	echo ' <input type="text" name="kml_perpage" value="'. $kml_perpage .'" />'."\n";
	echo ' <input type="submit" name="submit" value="' ._HAPPY_LINUX_EXECUTE. '" />'."\n";
	echo '</form>'."\n";
	echo "<br />\n";

	for ( $i=1; $i <= $max_page; $i++ )
	{
		echo '<a href="build_kml.php?page='. $i .'&amp;limit='. $kml_perpage .'" target="_blank" >';
		echo '[page '. $i .']</a> ';
	}

	echo "<br />\n";
}

?>