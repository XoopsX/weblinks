<?php
// $Id: webphoto_120.php,v 1.1 2011/12/29 14:32:59 ohwada Exp $

//=========================================================
// WebLinks Module
// for weblinks 1.20 <http://linux.ohwada.jp/>
// 2009-02-01 K.OHWADA
//=========================================================

// --- functions begin ---
if( !function_exists( 'weblinks_plugin_albums_webphoto_120' ) ) 
{

function &weblinks_plugin_albums_webphoto_120( $opts )
{
	$ret = weblinks_plugin_webphoto_include( $opts );
	if ( !$ret ) {
		$false = false ;
		return $false ;
	}

	$inc_class =& webphoto_inc_weblinks::getInstance();
	$ret = $inc_class->albums( $opts );
	return $ret ;
}

function &weblinks_plugin_photos_webphoto_120( $opts )
{
	$ret = weblinks_plugin_webphoto_include( $opts );
	if ( !$ret ) {
		$false = false ;
		return $false ;
	}

	$inc_class =& webphoto_inc_weblinks::getInstance();
	$ret = $inc_class->photos( $opts );
	return $ret ;
}

function weblinks_plugin_webphoto_include( $opts )
{
	$DIRNAME = isset( $opts['dirname'] ) ? $opts['dirname'] : 'webphoto';

	$file = XOOPS_ROOT_PATH.'/modules/'.$DIRNAME.'/include/weblinks.inc.php';

	if ( file_exists( $file ) ) {
		include_once  $file ;
		return true;
	} 
	return false ;
}

}
// --- functions end ---

?>