<?php
// $Id: admin_config_menu_class.php,v 1.2 2012/04/09 10:20:04 ohwada Exp $

// 2012-04-02 K.OHWADA
// changed _print_menu_list_6()

// 2008-02-17 K.OHWADA
// print_menu_7()

// 2007-11-01 K.OHWADA
// divid from admin_config_class.php

//=========================================================
// WebLinks Module
// 2006-05-15 K.OHWADA
//================================================================

//================================================================
// class admin_config_menu
//================================================================
class admin_config_menu
{
	var $_MENU_STYLE = "background-color: #E6E6E6; padding: 5px; border: 1px solid silver; ";

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_config_menu()
{
	// dummy
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_config_menu();
	}
	return $instance;
}

//---------------------------------------------------------
// print
//---------------------------------------------------------
function print_menu_0()
{
	echo "<h4>"._WEBLINKS_ADMIN_MODULE_CONFIG_2." ("._AM_WEBLINKS_MODULE_CONFIG_DESC_2.") </h4>\n";
	$this->_print_menu_list_2();

	echo "<h4>"._AM_WEBLINKS_MODULE_CONFIG_3." ("._AM_WEBLINKS_MODULE_CONFIG_DESC_3.") </h4>\n";
	$this->_print_menu_list_3();

	echo "<h4>"._AM_WEBLINKS_MODULE_CONFIG_4." ("._AM_WEBLINKS_MODULE_CONFIG_DESC_4.") </h4>\n";
	$this->_print_menu_list_4();

	echo "<h4>"._AM_WEBLINKS_MODULE_CONFIG_5." ("._AM_WEBLINKS_MODULE_CONFIG_DESC_5.") </h4>\n";
	$this->_print_menu_list_5();

	echo "<h4>"._AM_WEBLINKS_MODULE_CONFIG_6." ("._AM_WEBLINKS_MODULE_CONFIG_DESC_6.") </h4>\n";
	$this->_print_menu_list_6();

	echo "<h4>"._AM_WEBLINKS_MODULE_CONFIG_7." ("._AM_WEBLINKS_MODULE_CONFIG_DESC_7.") </h4>\n";
	$this->_print_menu_list_7();
}

function print_menu_2()
{
	echo "<h3>"._WEBLINKS_ADMIN_MODULE_CONFIG_2." ("._AM_WEBLINKS_MODULE_CONFIG_DESC_2.") </h3>\n";
	$this->_print_menu_list_2();
}

function print_menu_3()
{
	echo "<h3>"._AM_WEBLINKS_MODULE_CONFIG_3." ("._AM_WEBLINKS_MODULE_CONFIG_DESC_3.") </h3>\n";
	$this->_print_menu_list_3();
}

function print_menu_4()
{
	echo "<h3>"._AM_WEBLINKS_MODULE_CONFIG_4." ("._AM_WEBLINKS_MODULE_CONFIG_DESC_4.") </h3>\n";
	$this->_print_menu_list_4();
}

function print_menu_5()
{
	echo "<h3>"._AM_WEBLINKS_MODULE_CONFIG_5." ("._AM_WEBLINKS_MODULE_CONFIG_DESC_5.") </h3>\n";
	$this->_print_menu_list_5();
}

function print_menu_6()
{
	echo "<h3>"._AM_WEBLINKS_MODULE_CONFIG_6." ("._AM_WEBLINKS_MODULE_CONFIG_DESC_6.") </h3>\n";
	$this->_print_menu_list_6();
}

function print_menu_7()
{
	echo "<h3>"._AM_WEBLINKS_MODULE_CONFIG_7." ("._AM_WEBLINKS_MODULE_CONFIG_DESC_7.") </h3>\n";
	$this->_print_menu_list_7();
}

function _print_menu_list_0()
{
	echo '<div style="'.$this->_MENU_STYLE.'">';
	echo "<ul>\n";
	echo "</ul>\n";
	echo "</div>\n";
}

function _print_menu_list_2()
{
	echo '<div style="'.$this->_MENU_STYLE.'">';
	echo "<ul>\n";
	echo '<li><a href="config_manage_2.php#form_auth">'._WEBLINKS_ADMIN_AUTH."</a></li>\n";
	echo '<li><a href="config_manage_2.php#form_cat">'._WEBLINKS_ADMIN_CAT_SET."</a></li>\n";
	echo '<li><a href="config_manage_2.php#form_view">'._AM_WEBLINKS_CONF_VIEW."</a></li>\n";
	echo '<li><a href="config_manage_2.php#form_index">'._AM_WEBLINKS_CONF_INDEX."</a></li>\n";
	echo '<li><a href="config_manage_2.php#form_cat_paget">'._AM_WEBLINKS_CONF_CAT_PAGE."</a></li>\n";
	echo '<li><a href="config_manage_2.php#form_topten">'._AM_WEBLINKS_CONF_TOPTEN."</a></li>\n";
	echo '<li><a href="config_manage_2.php#form_search">'._AM_WEBLINKS_CONF_SEARCH."</a></li>\n";
	echo '<li><a href="config_manage_2.php#form_performance">'._AM_WEBLINKS_CONF_PERFORMANCE."</a></li>\n";
	echo '<li><a href="config_manage_2.php#form_template">'._HAPPY_LINUX_CONF_TPL_COMPILED_CLEAR."</a></li>\n";
	echo "</ul>\n";
	echo "</div>\n";
}

function _print_menu_list_3()
{
	echo '<div style="'.$this->_MENU_STYLE.'">';
	echo "<ul>\n";
	echo '<li><a href="config_manage_3.php#form_link_register">'._AM_WEBLINKS_LINK_REGISTER."</a></li>\n";
	echo '<li><a href="config_manage_3.php#form_link_register_1">'._AM_WEBLINKS_LINK_REGISTER_1."</a></li>\n";
	echo '<li><a href="config_manage_3.php#form_link_user">'._AM_WEBLINKS_CONF_LINK_USER."</a></li>\n";
	echo '<li><a href="config_manage_3.php#form_link_guest">'._AM_WEBLINKS_CONF_LINK_GUEST."</a></li>\n";
	echo '<li><a href="config_manage_3.php#form_submit">'._AM_WEBLINKS_CONF_SUBMIT."</a></li>\n";
	echo '<li><a href="config_manage_3.php#form_link">'._AM_WEBLINKS_CONF_LINK."</a></li>\n";
	echo '<li><a href="config_manage_3.php#form_link_image">'._AM_WEBLINKS_CONF_LINK_IMAGE."</a></li>\n";
	echo "</ul>\n";
	echo "</div>\n";
}

function _print_menu_list_4()
{
	echo '<div style="'.$this->_MENU_STYLE.'">';
	echo "<ul>\n";
	echo '<li><a href="config_manage_4.php#form_rss">'._WEBLINKS_ADMIN_RSS."</a></li>\n";
	echo '<li><a href="config_manage_4.php#form_rss_view">'._WEBLINKS_ADMIN_RSS_VIEW."</a></li>\n";
	echo '<li><a href="config_manage_4.php#form_cat_forum">'._AM_WEBLINKS_CONF_CAT_FORUM."</a></li>\n";
	echo '<li><a href="config_manage_4.php#form_link_forum">'._AM_WEBLINKS_CONF_LINK_FORUM."</a></li>\n";
	echo '<li><a href="config_manage_4.php#form_cat_album">'._AM_WEBLINKS_CONF_CAT_ALBUM."</a></li>\n";
	echo '<li><a href="config_manage_4.php#form_link_album">'._AM_WEBLINKS_CONF_LINK_ALBUM."</a></li>\n";
	echo '<li><a href="config_manage_4.php#form_d3forum">'._AM_WEBLINKS_CONF_D3FORUM."</a></li>\n";
	echo "</ul>\n";
	echo "</div>\n";
}

function _print_menu_list_5()
{
	echo '<div style="'.$this->_MENU_STYLE.'">';
	echo "<ul>\n";
	echo '<li><a href="config_manage_5.php#form_post">'._WEBLINKS_ADMIN_POST."</a></li>\n";
	echo "</ul>\n";
	echo "</div>\n";
}

function _print_menu_list_6()
{
	echo '<div style="'.$this->_MENU_STYLE.'">';
	echo "<ul>\n";
	echo '<li><a href="config_manage_6.php#form_google_map">'._AM_WEBLINKS_CONF_GOOGLE_MAP."</a></li>\n";
	echo '<li><a href="config_manage_6.php#form_index">'._AM_WEBLINKS_CONF_INDEX."</a></li>\n";
	echo '<li><a href="config_manage_6.php#form_cat_page">'._AM_WEBLINKS_CONF_CAT_PAGE."</a></li>\n";
	echo '<li><a href="config_manage_6.php#form_locate">'._AM_WEBLINKS_CONF_LOCATE."</a></li>\n";
	echo '<li><a href="config_manage_6.php#form_map">'._AM_WEBLINKS_CONF_MAP."</a></li>\n";
	echo '<li><a href="config_manage_6.php#form_google_seach">'._AM_WEBLINKS_CONF_GOOGLE_SEARCH."</a></li>\n";
	echo '<li><a href="config_manage_6.php#gm_kml_debug">'._WEBLINKS_GM_KML_DEBUG."</a></li>\n";
	echo "</ul>\n";
	echo "</div>\n";
}

function _print_menu_list_7()
{
	echo '<div style="'.$this->_MENU_STYLE.'">';
	echo "<ul>\n";
	echo '<li><a href="config_manage_7.php#form_menu">'._AM_WEBLINKS_CONF_MENU."</a></li>\n";
	echo '<li><a href="config_manage_7.php#form_title">'._AM_WEBLINKS_CONF_TITLE."</a></li>\n";
	echo "</ul>\n";
	echo "</div>\n";
}

// --- class end ---
}

?>