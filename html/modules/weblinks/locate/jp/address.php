<?php
// $Id: address.php,v 1.1 2012/04/10 11:24:42 ohwada Exp $

//=========================================================
// WebLinks Module
// 2012-04-02 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('weblinks_address_jp') ) 
{

//=========================================================
// class weblinks_address_jp
// Japan (JP)
//=========================================================
class weblinks_address_jp
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_address_jp()
{
	// dummy
}

//---------------------------------------------------------
// function
//---------------------------------------------------------
function build_address( $state, $city, $addr )
{
	$state = trim($state);
	$city  = trim($city);
	$addr  = trim($addr);

	if ( empty($state) && empty($city) && empty($addr) ) {
		return '';
	}

// Japanse style: state city addr
	$str = $state.$city.$addr;

	return $str;
}

// --- class end ---
}

// === class end ===
}

?>