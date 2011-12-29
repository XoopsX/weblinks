<?php
// $Id: album_sel.php,v 1.1 2011/12/29 14:32:59 ohwada Exp $

// 2009-02-01 K.OHWADA
// webphoto_120

// 2007-08-01 K.OHWADA
// module duplication

//================================================================
// WebLinks Module
// 2007-03-25 K.OHWADA
//================================================================

// --- functions begin ---
if( !function_exists( 'weblinks_plugin_album_sel' ) ) 
{

function &weblinks_plugin_album_sel() 
{
	$sel = array();

	$sel[1]['name']         = 'myalbum_287';
	$sel[1]['dirname']      = 'myalbum';
	$sel[1]['description']  = 'myalbum v2.87';

	$sel[2]['name']         = 'webphoto_120';
	$sel[2]['dirname']      = 'webphoto';
	$sel[2]['description']  = 'webphoto v1.20';

	return $sel;
}

}
// --- functions end ---

?>