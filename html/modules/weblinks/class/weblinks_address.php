<?php
// $Id: weblinks_address.php,v 1.1 2012/04/10 11:24:42 ohwada Exp $

//=========================================================
// WebLinks Module
// 2012-04-02 K.OHWADA
//=========================================================

//---------------------------------------------------------
// TODO
//   migarete with weblinks_locate
//---------------------------------------------------------

// === class begin ===
if( !class_exists('weblinks_address') ) 
{

//=========================================================
// class weblinks_address
//=========================================================
class weblinks_address
{
	var $_DIRNAME;
	var $_PATH;

	var $_county_code;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_address( $dirname )
{
	$this->_DIRNAME = $dirname;

	$this->_PATH = XOOPS_ROOT_PATH.'/modules/'.$dirname;

	$conf_handler =& weblinks_get_handler( 'config2_basic', $dirname );

	$conf_handler->init();
	$conf = $conf_handler->get_conf();
	$this->_county_code = $conf['country_code'];
}

public static function &getInstance( $dirname )
{
	static $instance;
	if (!isset($instance)) {
		$instance = new weblinks_address( $dirname );
	}
	return $instance;
}

//---------------------------------------------------------
// init
//---------------------------------------------------------
function &get_instance_locate()
{
	static $instance_locate;

	if ( isset($instance_locate) ) {
		return $instance_locate;
	}

	$file_default = $this->_PATH .'/locate/us/address.php';
	$file_locate  = $this->_PATH .'/locate/'. $this->_county_code .'/address.php';

	$class_default = 'weblinks_address_us';
	$class_locate  = 'weblinks_address_'. $this->_county_code ;

	$is_locate = false;
	if ( file_exists( $file_locate ) ) {
		$is_locate = true;
	}

	if ( $is_locate ) {
		include_once $file_locate;

		if ( class_exists( $class_locate ) ) {
			$instance_locate = new $class_locate();
			return $instance_locate;
		}
	}

	include_once $file_default;
	$instance_locate = new $class_default();
	return $instance_locate;
}

// --- class end ---
}

// === class end ===
}

?>