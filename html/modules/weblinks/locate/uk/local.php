<?php
// $Id: local.php,v 1.1 2011/12/29 14:32:32 ohwada Exp $

// 2007-07-28 K.OHWADA
// weblinks_uk_google.html

// 2006-10-05 K.OHWADA
// this is new file

//=========================================================
// WebLinks Module
// 2006-10-05 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('weblinks_locate_uk') ) 
{

//=========================================================
// class weblinks_locate_uk
// United Kingdom (UK)
//=========================================================
class weblinks_locate_uk extends weblinks_locate_base
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_locate_uk()
{
	$this->weblinks_locate_base();

	$arr = array(
		'weblinks_map_template' => 'weblinks_uk_google.html'
	);

	$this->array_merge($arr);
}

// --- class end ---
}

// === class end ===
}

?>