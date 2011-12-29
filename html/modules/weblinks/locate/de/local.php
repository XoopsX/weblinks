<?php
// $Id: local.php,v 1.1 2011/12/29 14:32:32 ohwada Exp $

// 2006-10-05 K.OHWADA
// this is new file

//=========================================================
// WebLinks Module
// 2006-10-05 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('weblinks_locate_de') ) 
{

//=========================================================
// class weblinks_locate_de
// Germany (DE)
//=========================================================
class weblinks_locate_de extends weblinks_locate_base
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_locate_de()
{
	$this->weblinks_locate_base();

	$arr = array(
		'weblinks_map_template' => 'weblinks_de_google.html'
	);

	$this->array_merge($arr);
}

// --- class end ---
}

// === class end ===
}

?>