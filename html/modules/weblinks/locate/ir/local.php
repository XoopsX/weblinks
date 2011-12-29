<?php
// $Id: local.php,v 1.1 2011/12/29 14:32:32 ohwada Exp $

//=========================================================
// WebLinks Module
// 2006-10-17 K.OHWADA
//=========================================================

//---------------------------------------------------------
// for Iran user
// I dont verficate in Iran mode
// please correct the actual status.
// and post in the support forum
//---------------------------------------------------------

// === class begin ===
if( !class_exists('weblinks_locate_ir') ) 
{

//=========================================================
// class weblinks_locate_ir
// Iran (ir)
//=========================================================
class weblinks_locate_ir extends weblinks_locate_base
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_locate_ir()
{
	$this->weblinks_locate_base();

// yahoo does not support in Iran
// and then substitue in USA
	$arr = array(
		'weblinks_map_template' => 'weblinks_us_yahoo.html'
	);

	$this->array_merge($arr);
}

// --- class end ---
}

// === class end ===
}

?>