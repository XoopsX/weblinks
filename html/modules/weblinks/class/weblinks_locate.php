<?php
// $Id: weblinks_locate.php,v 1.1 2011/12/29 14:33:07 ohwada Exp $

// 2007-11-11 K.OHWADA
// set_config_google_server( $val )

// 2006-12-17 K.OHWADA
// BUG 4417: singleton done not work correctly
// change weblinks_get_value()

// 2006-10-05 K.OHWADA
// this is new file

//=========================================================
// Happy Linux Framework Module
// 2006-10-01 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('weblinks_locate') ) 
{

//=========================================================
// class weblinks_locate
//=========================================================
class weblinks_locate_base extends happy_linux_locate_base
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_locate_base()
{
	$this->happy_linux_locate_base();
}


// --- class end ---
}

//=========================================================
// class weblinks_locate_factory
//=========================================================
class weblinks_locate_factory extends happy_linux_locate_factory
{
	var $_config_google_server = null;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_locate_factory( $dirname )
{
	$this->happy_linux_locate_factory();
	$this->set_dirname( $dirname );



//	$this->set_config_handler( weblinks_get_handler( 'config2_basic', $dirname ) );



}

function &getInstance( $dirname )
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new weblinks_locate_factory( $dirname );
	}
	return $instance;
}

//---------------------------------------------------------
// init
//---------------------------------------------------------
function weblinks_init()
{
	static $init;
	if (!isset($init)) 
	{
		$init = true;
		$arr =& $this->weblinks_get_value( 'config' );
		$this->array_merge($arr);
	}
}

//---------------------------------------------------------
// get value
//---------------------------------------------------------
function &weblinks_get_value( $mode='config' )
{
	switch ($mode)
	{
		case 'config':
			$code = $this->get_config_country_code();
			break;

		case 'default':
			$code = $this->get_language_country_code();
			break;

		default:
			$code = $this->get_defualt_contry_code();
			break;
	}

	$instance1 =& $this->get_instance( $code );
	$instance2 =& $this->get_instance( $code, 'weblinks', $this->get_dirname() );

	$arr1 =& $instance1->get_vars();
	$arr2 =& $instance2->get_vars();
	$arr_out = array_merge($arr1, $arr2);

	return $arr_out;
}

//---------------------------------------------------------
// function
//---------------------------------------------------------
function set_config_google_server( $val )
{
	$this->_config_google_server = $val;
}

function weblinks_build_google_search_url( $query )
{
	return $this->build_google_search_url( $query, $this->_config_google_server );
}

// --- class end ---
}

// === class end ===
}

?>