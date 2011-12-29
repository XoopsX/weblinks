<?php
// $Id: websitethumbnails.php,v 1.1 2011/12/29 14:32:32 ohwada Exp $

//=========================================================
// WebLinks Module
// 2007-10-10 K.OHWADA
//=========================================================

// === function begin ===
if( !function_exists('weblinks_thumb_websitethumbnails') ) 
{

//=========================================================
// thumbnail web service
//=========================================================
function &weblinks_thumb_websitethumbnails( $url )
{
	$arr = array(
		'name'   => 'website thumbnails',
		'url'    => 'http://www.websitethumbnails.net/',
		'image'  => 'http://www.websitethumbnails.net/view.php?url=' . $url,
		'width'  => 120,
		'height' =>  90,
	);
	return $arr;
}

// === fucntion end ===
}

?>