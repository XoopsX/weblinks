<?php
// $Id: thumb_mozshot.php,v 1.1 2011/12/29 14:32:59 ohwada Exp $

//=========================================================
// WebLinks Module
// 2007-09-10 K.OHWADA
//=========================================================

// === function begin ===
if( !function_exists('weblinks_thumb_mozshot') ) 
{

//=========================================================
// thumbnail web service
//=========================================================
function &weblinks_thumb_mozshot( $url )
{
	$arr = array(
		'name'   => 'mozshot',
		'image'  => 'http://mozshot.nemui.org/shot?' . $url,
		'width'  => 128,
		'height' => 128,
	);
	return $arr;
}

// === fucntion end ===
}

?>