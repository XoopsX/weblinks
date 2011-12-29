<?php
// $Id: weblinks_header.php,v 1.1 2011/12/29 14:33:07 ohwada Exp $

// 2009-01-25 K.OHWADA
// happy_linux_check_once_gmap_api()

// 2008-10-18 K.OHWADA
// $_GOOGLE_MAP_HL

// 2008-02-01 K.OHWADA
// _assign_xoops_module_header()

//================================================================
// WebLinks Module
// 2007-08-01 K.OHWADA
//================================================================

// === class begin ===
if( !class_exists('weblinks_header') ) 
{

include_once WEBLINKS_ROOT_PATH.'/include/gmap_api.php';

//=========================================================
// class weblinks_header
//=========================================================
class weblinks_header
{
// dirname
	var $_DIRNAME;
	var $_WEBLINKS_URL;

	var $_conf;
	var $_header_mode = false;

// you can set 'en' or other
	var $_GOOGLE_MAP_HL = _LANGCODE ;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_header( $dirname )
{
	$this->_DIRNAME = $dirname ;
	$this->_WEBLINKS_URL = XOOPS_URL .'/modules/'. $dirname;

	$config_handler =& weblinks_get_handler( 'config2_basic',  $dirname );
	$this->_conf = $config_handler->get_conf();
	$this->_header_mode = $this->_conf['header_mode'];
}

function &getInstance( $dirname )
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new weblinks_header( $dirname );
	}
	return $instance;
}

//-------------------------------------------------------------------
// public
//-------------------------------------------------------------------
// index.php etc
function assign_module_header( $flag_gmap=false )
{
	$header = $this->_build_module_header( $flag_gmap );

	if ( $this->_header_mode == 1 ) {
		$this->_assign_xoops_module_header( $header );
		$this->_assign_weblinks_module_header( '' );
	} else {
		$this->_assign_weblinks_module_header( $header );
	}
}

// submit.php modify.php
function assign_module_header_submit()
{
	if ( $this->_header_mode == 1 )
	{
		$this->_assign_xoops_module_header( $this->build_module_header_submit() );
	}
}

// submit.php modify.php
function get_module_header_submit()
{
	$text = '';
	if ( $this->_header_mode == 0 )
	{
		$text = $this->build_module_header_submit();
	}
	return $text;
}

// category_manage.php weblinks_link_form_admin_handler.php
function build_module_header_submit()
{
	$temp  = $this->_build_visit_js();
	$temp .= $this->_build_iframe_js();

	$text  = $this->_build_weblinks_css();
	$text .= $this->_envelop_script( $temp );
	return $text;
}

// map_jp_manage.php
function build_module_header_map_jp()
{
	$text  = $this->_build_weblinks_css();
	$text .= $this->_build_map_jp_css();
	return $text;
}

//-------------------------------------------------------------------
// private
//-------------------------------------------------------------------
function _build_module_header( $flag_gmap=false )
{
	$text  = $this->_build_weblinks_css();
	$text .= $this->_build_map_jp_css();
	if ( $flag_gmap )
	{
		$text .= $this->_build_once_google_server_js();
		$text .= $this->_build_once_weblinks_gmap_js();
	}
	$text .= $this->_envelop_script( $this->_build_visit_js() );
	return $text;
}

function _build_module_header_submit()
{
	$temp  = $this->_build_visit_js();
	$temp .= $this->_build_iframe_js();

	$text  = $this->_build_weblinks_css();
	$text .= $this->_envelop_script( $temp );
	return $text;
}

function _build_weblinks_css()
{
	return $this->_build_css( 'weblinks.css' );
}

function _build_map_jp_css()
{
	return $this->_build_css( 'include/weblinks_map_jp.css' );
}

function _build_once_weblinks_gmap_js()
{
	$text = '';
	if ( $this->_conf['gm_use'] && !defined('WEBLINKS_GM_LOCAL_LOADED') )
	{
		define('WEBLINKS_GM_LOCAL_LOADED', 1 );
		$text = $this->_build_weblinks_gmap_js();
	}
	return $text;
}

function _build_weblinks_gmap_js()
{
	return $this->_build_js( 'include/weblinks_gmap.js' );
}

function _build_css( $file )
{
	$text = '<link href="'. $this->_WEBLINKS_URL .'/' .$file. '" rel="stylesheet" type="text/css" media="all" />' . "\n";
	return $text;
}

function _build_js( $file )
{
	$text = '<script src="'. $this->_WEBLINKS_URL .'/' .$file. '" type="text/javascript" ></script>' . "\n";
	return $text;
}

function _build_visit_js()
{
	$weblinks_url = $this->_WEBLINKS_URL;

	$text = <<< END_OF_TEXT
/* hardlink */
function weblinks_hardlink( link, lid )
{
	link.href = "$weblinks_url/visit.php?lid=" + lid;
	return true;
}
END_OF_TEXT;

	return $text."\n";
}

function _build_iframe_js()
{
	$WINDOW_WIDTH  = '800';
	$WINDOW_HEIGHT = '850';
	$IFRAME_WIDTH  = '100%';
	$IFRAME_HEIGHT = '700px';

	$window_url = $this->_WEBLINKS_URL .'/gm_get_location.php?mode=opener';
	$iframe_url = $this->_WEBLINKS_URL .'/gm_get_location.php?mode=parent';
	$lang_disp_off = _WEBLINKS_GM_DISP_OFF;

	$text = <<< END_OF_TEXT
/* google map */
function weblinks_gm_window_open()
{
    var options = "width=$WINDOW_WIDTH, height=$WINDOW_HEIGHT, toolbar=no, location=yes, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, copyhistory=no";
    window.open("$window_url", "weblinks_gm_window", options);
}
function weblinks_gm_disp_on()
{
	var iframe = '<a href="#google_map_desc" onclick="weblinks_gm_disp_off()">[ $lang_disp_off ]</a>';
	iframe += '<br /><br />';
	iframe += '<iframe src="$iframe_url" width="$IFRAME_WIDTH" height="$IFRAME_HEIGHT" frameborder="0" scrolling="yes"></iframe>';
	document.getElementById("weblinks_gm_iframe").innerHTML = iframe;
}
function weblinks_gm_disp_off()
{
	document.getElementById("weblinks_gm_iframe").innerHTML = '';
}
END_OF_TEXT;

	return $text."\n";
}

function _envelop_script( $content )
{
	$text = <<< END_OF_TEXT
<script type="text/javascript">
//<![CDATA[
$content
//]]>
</script>
END_OF_TEXT;

	return $text."\n";
}

//--------------------------------------------------------
// xoops template
//--------------------------------------------------------
// some block use xoops_module_header
function _assign_xoops_module_header( $var )
{
	global $xoopsTpl;
	$xoopsTpl->assign(
		'xoops_module_header', 
		$var."\n".$xoopsTpl->get_template_vars('xoops_module_header')
	);
}

function _assign_weblinks_module_header( $var )
{
	global $xoopsTpl;
	$xoopsTpl->assign( 'weblinks_module_header', $var );
}

//--------------------------------------------------------
// common with webphoto
//--------------------------------------------------------
function _build_once_google_server_js()
{
	if ( ! $this->_conf['gm_use'] ) {
		return null;
	}
	if ( ! $this->_check_google_server_js() ) {
		return null;
	}
	return $this->_build_google_server_js();
}

function _check_google_server_js()
{
	return happy_linux_check_once_gmap_api();
}

function _build_google_server_js()
{
	return happy_linux_build_gmap_api( $this->_conf['gm_apikey'], $this->_GOOGLE_MAP_HL );
}

// --- class end ---
}

// === class end ===
}

?>