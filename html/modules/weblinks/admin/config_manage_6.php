<?php
// $Id: config_manage_6.php,v 1.2 2012/04/09 10:20:04 ohwada Exp $

// 2012-04-02 K.OHWADA
// admin_config_form_6
// weblinks_webmap

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
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_block_webmap.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_webmap.php';

//================================================================
// class admin_config_form_6
//================================================================
class admin_config_form_6 extends admin_config_form
{
	var $_webmap_class;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_config_form_6()
{
	$this->admin_config_form();

	$this->_webmap_class =& weblinks_webmap::getInstance( WEBLINKS_DIRNAME );
}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) {
		$instance = new admin_config_form_6();
	}
	return $instance;
}

//---------------------------------------------------------
// webmap
//---------------------------------------------------------
function print_webmap3_module_installed()
{
	$webmap_dirname = $this->_webmap_class->get_webmap_dirname();

	if ( $this->_webmap_class->check_installed() ) {
		if ( $this->_webmap_class->check_version() ) {
			$msg = sprintf( _WEBLINKS_WEBMAP3_INSTALLED, $webmap_dirname, _C_WEBMAP3_VERSION );
			echo '<h4 style="color: #0000ff;">'.$msg."</h4>\n";

		} else {
			$msg = sprintf( _WEBLINKS_WEBMAP3_REQUIRE, WEBLINKS_WEBMAP3_VERSION );
			xoops_error( $msg );
		}

	} elseif( $webmap_dirname ) {
		$msg = sprintf( _WEBLINKS_WEBMAP3_NOT_INSTALLED, $webmap_dirname );
		xoops_error( $msg );
	}
}

function webmap_init()
{
	$ret = $this->_webmap_class->init_html();
	if ( $ret == 1 ) {
		return true;
	}
	return false;
}

function build_webmap_iframe()
{
	return $this->_webmap_class->build_display_iframe();
}

//---------------------------------------------------------
// kml
//---------------------------------------------------------
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

// --- class end ---
}

//================================================================
// main
//================================================================

$config_form  =& admin_config_form_6::getInstance();
$config_store =& admin_config_store::getInstance();
$weblinks_header =& weblinks_header::getInstance( WEBLINKS_DIRNAME );

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

// google map
echo '<a name="form_google_map"></a>'."\n";
echo "<h4>"._AM_WEBLINKS_CONF_GOOGLE_MAP."</h4>\n";

$config_form->print_webmap3_module_installed();
$ret = $config_form->webmap_init();
if ( $ret ) {
	echo $config_form->build_webmap_iframe();
}

$config_form->show_by_catid( 21, _AM_WEBLINKS_CONF_GOOGLE_MAP );

echo '<a name="form_index"></a>'."\n";
echo "<h4>"._AM_WEBLINKS_CONF_INDEX."</h4>\n";
$config_form->show_by_catid( 29, _AM_WEBLINKS_CONF_INDEX );

echo '<a name="form_cat_page"></a>'."\n";
echo "<h4>"._AM_WEBLINKS_CONF_CAT_PAGE."</h4>\n";
$config_form->show_by_catid( 30, _AM_WEBLINKS_CONF_CAT_PAGE );

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

$config_form->print_kml_list();

weblinks_admin_print_footer();
xoops_cp_footer();
exit();
// --- main end ---

?>