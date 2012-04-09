<?php
// $Id: gm_get_location.php.\040CDS\040Patch.php,v 1.1 2012/04/09 10:20:05 ohwada Exp $

// 2008-02-12 K.OHWADA
// remove map_type

// 2007-08-01 K.OHWADA
// weblinks_gmap_location.html

// 2007-07-01 K.OHWADA
// is_japanese()

// 2007-03-17 wye
// BUG 4509: JavaScript error

// 2006-12-10 wye & K.OHWADA
// google map: googleGeocode

// 2006-11-22 wye & K.OHWADA
// google map: JP Geocode

// 2006-11-04 wye & K.OHWADA
// google map: JP inverse Geocoder
// google map: inline mode

// 2006-10-15 wye & K.OHWADA
// BUG 4313: in some enviroment, character code is judged by mistake.

//================================================================
// WebLinks Module
// 2006-10-01 wye <http://never-ever.info/>
//================================================================

//---------------------------------------------------------
// myself:     gm_get_location.php
// new window: gm_get_location.php?mode=opener
// inline:     gm_get_location.php?mode=parent
//---------------------------------------------------------

include "header.php";
include_once XOOPS_ROOT_PATH.'/class/template.php';

$config_handler =& weblinks_get_handler( 'config2_basic', WEBLINKS_DIRNAME );
$system         =& happy_linux_system::getInstance();
$post           =& happy_linux_post::getInstance();
$strings        =& happy_linux_strings::getInstance();

$mode = $post->get_get_text('mode');
$conf = $config_handler->get_conf();

$lang_current_address = "current_address";
$lang_search_list = "search_list";

$map_height    = 300;
$show_close    = false;
$show_disp_off = false;

// opener mode
if (( $mode == '' )||( $mode == 'opener' ))
{
	$map_height = 450;
	$show_close = true;
}
elseif ( $mode == 'parent' )
{
	$map_height    = 300;
	$show_disp_off = true;
}

$lang_title_utf8_s  = htmlspecialchars( happy_linux_convert_to_utf8( _WEBLINKS_GM_GET_LOCATION ), ENT_QUOTES);
$gm_location_utf8_s = htmlspecialchars( happy_linux_convert_to_utf8( $conf['gm_location'] ), ENT_QUOTES);

/* CDS Patch. Weblinks. 2.00. 1. BOF */
if (file_exists(XOOPS_THEME_PATH.'/'.$xoopsConfig['theme_set'] .'/modules/' . WEBLINKS_DIRNAME . '/parts' . '/weblinks_gm_location.html'))
{
	$template = XOOPS_THEME_PATH.'/'.$xoopsConfig['theme_set'] .'/modules/' . WEBLINKS_DIRNAME . '/parts' . '/weblinks_gm_location.html';
}
else
{
	$template = XOOPS_ROOT_PATH . '/modules/' . WEBLINKS_DIRNAME . '/templates/parts/weblinks_gm_location.html';
}
/* CDS Patch. Weblinks. 2.00. 1. EOF */

// BUG 4313: in some enviroment, character code is judged by mistake.
happy_linux_http_output('pass');
header ('Content-Type:text/html; charset=UTF-8');

if ( $conf['gm_apikey'] )
{
/* CDS Patch. Weblinks. 2.00. 2. BOF */
	include $GLOBALS['xoops']->path('header.php');
	$tpl = $xoopsTpl;
	//$tpl = new XoopsTpl();
/* CDS Patch. Weblinks. 2.00. 2. EOF */

// java script
	$tpl->assign('gm_server',          $conf['gm_server'] );
	$tpl->assign('gm_apikey',          $conf['gm_apikey'] );
	$tpl->assign('map_control',        $conf['gm_map_control'] );
	$tpl->assign('geocode_kind',       $conf['gm_geocode_kind'] );
	$tpl->assign('default_latitude',   floatval( $conf['gm_latitude'] ) );
	$tpl->assign('default_longitude',  floatval( $conf['gm_longitude'] ) );
	$tpl->assign('default_zoom',       intval( $conf['gm_zoom'] ) );
	$tpl->assign('bool_use_type',          $strings->bool_to_str( $conf['gm_use_type_control'] ) );
	$tpl->assign('bool_use_scale',         $strings->bool_to_str( $conf['gm_use_scale_control'] ) );
	$tpl->assign('bool_use_overview',      $strings->bool_to_str( $conf['gm_use_overview_control'] ) );
	$tpl->assign('bool_use_nishioka_inverse', $strings->bool_to_str( $conf['gm_use_nishioka_inverse'] ) );

	$tpl->assign('xoops_url',         XOOPS_URL );
	$tpl->assign('xoops_langcode',    _LANGCODE );
	$tpl->assign('dirname',           WEBLINKS_DIRNAME );
	$tpl->assign('opener_mode',       $mode );
	$tpl->assign('bool_is_japanese',  $strings->bool_to_str( $system->is_japanese() ) );

	$tpl->assign('lang_not_compatible',  happy_linux_convert_to_utf8( _WEBLINKS_GM_NOT_COMPATIBLE ) );
	$tpl->assign('lang_no_match_place',  happy_linux_convert_to_utf8( _WEBLINKS_GM_NO_MATCH_PLACE ) );
	$tpl->assign('lang_latitude',        happy_linux_convert_to_utf8( _WEBLINKS_GM_LATITUDE ) );
	$tpl->assign('lang_longitude',       happy_linux_convert_to_utf8( _WEBLINKS_GM_LONGITUDE ) );
	$tpl->assign('lang_zoom',            happy_linux_convert_to_utf8( _WEBLINKS_GM_ZOOM ) );

// template
	$tpl->assign('flag_use_geocode_tokyo_univ', $conf['gm_use_geocode_tokyo'] );
	$tpl->assign('flag_use_nishioka_inverse',   $conf['gm_use_nishioka_inverse'] );
	$tpl->assign('show_set_addr_jp',            $conf['gm_use_nishioka_inverse'] );
	$tpl->assign('map_height',        $map_height );
	$tpl->assign('default_location',  $gm_location_utf8_s );
	$tpl->assign('show_close',        $show_close );
	$tpl->assign('show_disp_off',     $show_disp_off );

	$tpl->assign('lang_title',             $lang_title_utf8_s );
	$tpl->assign('lang_close',             happy_linux_convert_to_utf8( _CLOSE ) );
	$tpl->assign('lang_disp_off',          happy_linux_convert_to_utf8( _WEBLINKS_GM_DISP_OFF ) );
	$tpl->assign('lang_get_addr',          happy_linux_convert_to_utf8( _WEBLINKS_GM_GET_ADDR ) );
	$tpl->assign('lang_js_invalid',        happy_linux_convert_to_utf8( _WEBLINKS_JAVASCRIPT_INVALID ) );
	$tpl->assign('lang_jp_tokyo_geocode',  happy_linux_convert_to_utf8( _WEBLINKS_GM_JP_TOKYO_AC_GEOCODE ) );
	$tpl->assign('lang_jp_mlit_isj',       happy_linux_convert_to_utf8( _WEBLINKS_GM_JP_MLIT_ISJ ) );
	$tpl->assign('lang_default_location',  happy_linux_convert_to_utf8( _WEBLINKS_GM_DEFAULT_LOCATION ) );
	$tpl->assign('lang_current_location',  happy_linux_convert_to_utf8( _WEBLINKS_GM_CURRENT_LOCATION ) );
	$tpl->assign('lang_current_address',   happy_linux_convert_to_utf8( _WEBLINKS_GM_CURRENT_ADDRESS ) );
	$tpl->assign('lang_search_list',       happy_linux_convert_to_utf8( _WEBLINKS_GM_SEARCH_LIST ) );
	$tpl->assign('lang_get_latitude',      happy_linux_convert_to_utf8( _WEBLINKS_GM_GET_LATITUDE ) );
	$tpl->assign('lang_search_map_from_addr',    happy_linux_convert_to_utf8( _WEBLINKS_GM_SEARCH_MAP_FROM_ADDRESS ) );
	$tpl->assign('lang_jp_search_map_from_addr', happy_linux_convert_to_utf8( _WEBLINKS_GM_JP_SEARCH_MAP_FROM_ADDRESS ) );

	$tpl->display( $template );
}
else
{

// --- raw HTML begin ---
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>weblinks - <?php echo $lang_title_utf8_s; ?></title>
</head>
<body>
<h3><?php echo $lang_title_utf8_s; ?></h3>
<h4 style="color: #ff0000;">not set google map api key</h4>
</body>
</html>
<?php
// --- raw HTML end ---

}
exit();
?>