<?php
// $Id: get_location.php,v 1.2 2012/04/10 11:24:42 ohwada Exp $

//=========================================================
// WebLinks Module
// 2012-04-02 K.OHWADA
//=========================================================

include 'header.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_address.php';

//=========================================================
// class weblinks_get_location
//=========================================================
class weblinks_get_location
{
	var $_link_handler;
	var $_cat_handler;
	var $_conf_handler;
	var $_api_class;

	var $_conf;

// weblinks config
	var $_ELE_ID_PARENT_LATITUDE  = "gm_latitude";
	var $_ELE_ID_PARENT_LONGITUDE = "gm_longitude";
	var $_ELE_ID_PARENT_ZOOM      = "gm_zoom";
	var $_ELE_ID_PARENT_ADDRESS   = "gm_location";

	var $_DIRNAME;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_get_location( $dirname )
{
	$this->_DIRNAME = $dirname;

	$this->_link_handler =& weblinks_get_handler( 'link_basic', $dirname );
	$this->_cat_handler  =& weblinks_get_handler( 'category_basic', $dirname );
	$this->_conf_handler =& weblinks_get_handler( 'config2_basic', $dirname );

	$this->_conf_handler->init();
	$this->_conf = $this->_conf_handler->get_conf();
}

public static function &getInstance( $dirname )
{
	static $instance;
	if (!isset($instance)) {
		$instance = new weblinks_get_location( $dirname );
	}
	return $instance;
}

//---------------------------------------------------------
// main
//---------------------------------------------------------
function main()
{
	$webmap3_dirname = $this->_conf['webmap3_dirname'];
	require XOOPS_ROOT_PATH . '/modules/'.$webmap3_dirname.'/include/api.php';
	if ( ! class_exists('webmap3_api_get_location') ) {
		echo $this->error();
		return false;
	}

	list( $flag, $lat, $lng, $zoom, $addr ) = $this->get_latlng();

	$api_class =& webmap3_api_get_location::getSingleton( $webmap3_dirname );

	$api_class->set_latitude(  $lat );
	$api_class->set_longitude( $lng );
	$api_class->set_zoom(      $zoom );
	$api_class->set_address(   $addr );
	$api_class->set_use_center_marker( $flag );
	$api_class->set_ele_id_parent_latitude(  $this->_ELE_ID_PARENT_LATITUDE );
	$api_class->set_ele_id_parent_longitude( $this->_ELE_ID_PARENT_LONGITUDE );
	$api_class->set_ele_id_parent_zoom(      $this->_ELE_ID_PARENT_ZOOM );
	$api_class->set_ele_id_parent_address(   $this->_ELE_ID_PARENT_ADDRESS );
	$api_class->display_get_location();

	return true;
}

function get_latlng()
{
	$flag = false;
	$lat  = $this->_conf['gm_latitude'];
	$lng  = $this->_conf['gm_longitude'];
	$zoom = $this->_conf['gm_zoom'];
	$addr = $this->_conf['gm_location'];

	$lid = isset($_GET['lid']) ? intval($_GET['lid']) : 0;
	$cid = isset($_GET['cid']) ? intval($_GET['cid']) : 0;

	if ( $lid > 0 ) {
		$row = $this->_link_handler->get_row_by_id( $lid );
		if ( is_array($row) ) {
			if ( $row['gm_zoom'] > 0 ) {
				$flag = true;
				$lat  = $row['gm_latitude'];
				$lng  = $row['gm_longitude'];
				$zoom = $row['gm_zoom'];
			}

			$temp = $this->build_address( 
				$row['state'], $row['city'], $row['addr'] );
			if ( $temp != '' ) {
				$addr = $temp;
			}
		}

	} elseif ( $cid > 0 ) {
		$row = $this->_cat_handler->get_row_by_id( $cid );
		if ( is_array($row) ) {
			if ( $row['gm_zoom'] > 0 ) {
				$flag = true;
				$lat  = $row['gm_latitude'];
				$lng  = $row['gm_longitude'];
				$zoom = $row['gm_zoom'];
			}
			if ( $row['gm_location'] != '' ) {
				$addr = $row['gm_location'];
			}
		}
	}

	return array( $flag, $lat, $lng, $zoom, $addr );
}

function build_address( $state, $city, $addr )
{
	$address_class =& weblinks_address::getInstance( $this->_DIRNAME );
	$locate_class  =& $address_class->get_instance_locate();
	return $locate_class->build_address( $state, $city, $addr );
}

function error()
{

$text = <<<EOF
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>get location</title>
</head>
<body>
<h3>get location</h3>
<h4 style="color: #ff0000;">require WEBMAP3 module</h4>
</body>
</html>
EOF;

	return $text;
}

// --- class end ---
}

//=========================================================
// main
//=========================================================
$manage =& weblinks_get_location::getInstance( WEBLINKS_DIRNAME );
$manage->main();
exit();

?>