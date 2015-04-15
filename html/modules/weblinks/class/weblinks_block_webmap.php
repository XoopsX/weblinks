<?php
// $Id: weblinks_block_webmap.php,v 1.1 2012/04/09 10:23:37 ohwada Exp $

//=========================================================
// WebLinks Module
// 2012-04-02 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('weblinks_block_webmap') ) 
{

//=========================================================
// class weblinks_block_webmap
//=========================================================
class weblinks_block_webmap
{
	var $_map_class;

	var $_url_singlelink;

	var $_STYLE_DEFAULT = 'width:100%; height: border:1px solid #909090; margin-bottom:6px';

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_block_webmap( $dirname )
{
	$this->_url_singlelink = XOOPS_URL .'/modules/'. $dirname .'/singlelink.php';
}

public static function &getSingleton( $dirname )
{
	static $singletons;
	if ( !isset( $singletons[ $dirname ] ) ) {
		$singletons[ $dirname ] = new weblinks_block_webmap( $dirname );
	}
	return $singletons[ $dirname ];
}

//---------------------------------------------------------
// block
//---------------------------------------------------------
function build_map_block( $param )
{
	$dirname      = $param['dirname'];
	$mode         = $param['mode'];
	$name         = $param['name'];
	$style_height = $param['style_height'];
	$links        = $param['links'];
	$conf         = $param['conf'];

	$webmap3_dirname = $conf['webmap3_dirname'];
	$use             = $conf['gm_use'];
	$length	         = $conf['gm_desc_length'];
	$wordwrap        = $conf['gm_wordwrap'];

	if ( !$use ) {
		return false;
	}

	if ( ! $this->check_webmap_dirname( $webmap3_dirname ) ) {
		return false;
	}

	if ( $mode == 0 ) {
		return false;

// use config value
	} elseif ( $mode == 1 ) {
		$latitude  = $conf['gm_latitude'];
		$longitude = $conf['gm_longitude'];
		$zoom      = $conf['gm_zoom'];

	} else {
		$latitude  = $param['latitude'];
		$longitude = $param['longitude'];
		$zoom      = $param['zoom'];
	}

	$show_webmap = false;
	$map_div_id  = $name.'_map';
	$map_func    = $name.'_map_load';
	$style       = 'height:'. $style_height .'px; '. $this->_STYLE_DEFAULT;

	$this->_map_class =& $this->get_map_class( $webmap3_dirname );
	if ( ! is_object($this->_map_class) ) {
		return false;
	}

	$this->_map_class->init();

	$this->_map_class->set_latitude(  $latitude );
	$this->_map_class->set_longitude( $longitude );
	$this->_map_class->set_zoom(      $zoom );

	$this->_map_class->set_info_max(   $length ) ;
	$this->_map_class->set_info_width( $wordwrap ) ;

// head
	$this->_map_class->assign_google_map_js_to_head();
	$this->_map_class->assign_map_js_to_head();
	$this->_map_class->assign_gicon_array_to_head();

	$markers = array();
	if ( is_array($links) && count($links) ){
		foreach ($links as $link) {
			if ( $this->check_latlng_by_link( $link ) ) {
				$show_webmap = true;
				$markers[] = $this->build_marker_block( $link, $conf );
			}
		}
	}

// map
	$this->_map_class->set_map_div_id( $map_div_id ) ;
	$this->_map_class->set_map_func(   $map_func ) ;

	$m_param = $this->_map_class->build_markers( $markers );
	           $this->_map_class->fetch_markers_head( $m_param );

	$arr = array(
		'show_webmap'   => $show_webmap ,
		'webmap_div_id' => $map_div_id ,
		'webmap_func'   => $map_func ,
		'webmap_style'  => $style ,
	);
	return $arr;

}

function check_webmap_dirname( $dirname )
{
	if ( $dirname == '' ) {
		return false;
	}
	if ( $dirname == '-' ) {
		return false;
	}
	if ( $dirname == '---' ) {
		return false;
	}
	return true;
}

function &get_map_class( $webmap_dirname )
{
	$false = false;

	$file = XOOPS_ROOT_PATH.'/modules/'. $webmap_dirname .'/include/api.php' ;
	if ( !file_exists($file) ) {
		return $false;
	}

	include_once $file ;

	if ( !class_exists( 'webmap3_api_map' ) ) {
		return $false;
	}

	$map_class =& webmap3_api_map::getSingleton( $webmap_dirname );
	return $map_class;
}

function build_marker_block( $link, $conf )
{
	return $this->_map_class->build_single_marker(
		$link['gm_latitude'] ,
		$link['gm_longitude'] ,
		$this->build_info_block( $link, $conf ) ,
		$link['google_icon'] 
	);
}

function build_info_block( $link, $conf )
{
	$url   = $this->_url_singlelink .'?lid='. $link['lid'] ;
	$url_s = $this->sanitize( $url );

	$summary = $this->_map_class->build_summary( $link['desc_html'] );

	return $this->build_info( 
		$link['title_disp'], $url_s, $summary, $conf['gm_marker_width'] );
}

function build_info( $title, $url, $summary, $width, $flag_target=false )
{
	$target = '';
	if ( $flag_target ) {
		$target = 'target="_blank"';
	}

	$info  = '<a href="'. $url .'" '. $target .'>';
	$info .= '<span style="font-weight:bold">'. $title .'</span>';
	$info .= '</a><br />';
	$info .= '<span style="font-size:80%">'. $summary .'</span>';

	if ( $width > 0 ) {
    	$info = '<div style="width:'. $width .'px">'. $info .'</div>';
	}

	return $info;
}

function check_latlng_by_link( $link )
{
	return $this->check_lat_lng_zoom( 
		$link['gm_latitude'], $link['gm_longitude'], $link['gm_zoom'] );
}

function check_lat_lng_zoom( $latitude, $longitude, $zoom )
{
	$zoom = intval( $zoom );
	if ( $zoom > 0 ) { return true; }

	$lat = intval( $latitude  * 1000000 );
	$lng = intval( $longitude * 1000000 );

	if ( $lat != 0 ) { return true; }
	if ( $lng != 0 ) { return true; }
	return false;
}

function sanitize( $str ) 
{
	return htmlspecialchars( $str, ENT_QUOTES );
}

// --- class end ---
}

// === class end ===
}

?>