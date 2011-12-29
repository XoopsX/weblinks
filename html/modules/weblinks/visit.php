<?php
// $Id: visit.php,v 1.1 2011/12/29 14:32:29 ohwada Exp $

// 2008-07-25 K.OHWADA
// BUG: cannot use &amp; for location

// 2007-12-15 K.OHWADA
// meta Refresh => header

// 2007-05-12 K.OHWADA
// constant $ROWS

// 2007-03-01 K.OHWADA
// header.php
// weblinks_link_basic
// $conf_use_hits

// 2006-09-20 K.OHWADA
// use happy_linux

// 2006-05-15 K.OHWADA
// use new handler

// 2005-09-04 K.OHWADA
// BUG 2932: dont work correctly when register_long_arrays = off

// 2004-11-28 K.OHWADA
// write fair, delete unnecessary comments

// 2004/08/10 K.OHWADA
// enable to install this module two or more. 

//================================================================
// visit website and count up
// use class weblinksLink
// 2004/01/14 K.OHWADA
//================================================================

include 'header.php';

$weblinks_config_handler =& weblinks_get_handler( 'config2_basic', WEBLINKS_DIRNAME );
$weblinks_link_handler   =& weblinks_get_handler( 'link_basic',    WEBLINKS_DIRNAME );

$weblinks_post   =& happy_linux_post::getInstance();
$weblinks_system =& happy_linux_system::getInstance();

// constant
$ROWS = '70px,100%';
$COLS = '*';
$FLAG_REDIRECT = true;

$conf =& $weblinks_config_handler->get_conf();
$conf_use_hits = $conf['use_hits'];
$conf_frame    = $conf['frame'];

// BUG 2932: dont work correctly when register_long_arrays = off
$lid = $weblinks_post->get_get_int('lid');
$op  = $weblinks_post->get_get_text('op');

$url   = $weblinks_link_handler->get_url($lid, 'n');
$url_s = happy_linux_sanitize_url( $url );
$url_u = happy_linux_undo_htmlspecialchars( $url );

// jump this site, if no url
if ( empty($url) )
{
	redirect_header("index.php", 3, _WLS_NOMATCH);
	exit();
}

if ( $conf_use_hits )
{
	$weblinks_link_handler->countup_hits($lid);
}

$sitename = $weblinks_system->get_sitename();

if ( $conf_frame == 1 ) 
{
	header('Content-Type:text/html; charset='._CHARSET);
	header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header('Cache-Control: no-store, no-cache, must-revalidate');
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	echo "<html><head>
		<title>".$sitename."</title>
		</head>
		<frameset rows='".$ROWS."' cols='".$COLS."' border='0' frameborder='0' framespacing='0' >
		<frame src='myheader.php?lid=$lid' frame name='xoopshead' scrolling='no' target='main' Noresize>
		<frame src='".$url_s."' frame name='main' scrolling='auto' target='Main'>
		</frameset></html>";
}
elseif ( $FLAG_REDIRECT ) 
{
// BUG: cannot use &amp; for location
	header( 'Location: '.$url_u );
	exit();
}
else 
{
	echo "<html><head><meta http-equiv=\"Refresh\" content=\"0; URL=".$url_s."\"></meta></head><body></body></html>";
}

exit();

?>