<?php
// $Id: feed_atom.php,v 1.1 2011/12/29 14:32:29 ohwada Exp $

// 2007-10-10 K.OHWADA
// weblinks_build_rss_feed

// 2007-06-01 K.OHWADA
// rssc_view_handler
// api/rss_builder.php

// 2006-09-20 K.OHWADA
// this is new file
// porting from rssc_build_atom
// use rssc WEBLINKS_RSSC_EXIST

//=========================================================
// WebLinks Module
// 2006-09-20 K.OHWADA
//=========================================================

include 'header.php';

if ( WEBLINKS_RSSC_EXIST )
{
	include_once WEBLINKS_ROOT_PATH.'/api/build_rss_feed.php';

	$weblinks_builder =& weblinks_get_handler( 'build_rss_feed', WEBLINKS_DIRNAME );
	$weblinks_builder->build_for_weblinks( 'atom' );

}
else
{
	$msg = sprintf( _WEBLINKS_RSSC_NOT_INSTALLED, WEBLINKS_RSSC_DIRNAME );
	redirect_header('index.php', 5, $msg);
}

exit();
// --- main end ---

?>