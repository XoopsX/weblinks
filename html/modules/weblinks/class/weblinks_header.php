<?php
// $Id: weblinks_header.php,v 1.2 2012/04/09 10:20:05 ohwada Exp $

// 2012-04-02 K.OHWADA
// remove gmap_api.php

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

public static function &getInstance( $dirname )
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
function _build_module_header()
{
	$text  = $this->_build_weblinks_css();
	$text .= $this->_build_map_jp_css();
	$text .= $this->_envelop_script( $this->_build_visit_js() );
	return $text;
}

function _build_module_header_submit()
{
	$temp  = $this->_build_visit_js();

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

// --- class end ---
}

// === class end ===
}

?>