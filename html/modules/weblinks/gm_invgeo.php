<?php
// $Id: gm_invgeo.php,v 1.1 2011/12/29 14:32:28 ohwada Exp $

//================================================================
// WebLinks Module
// inverse Geocoder: <http://nishioka.sakura.ne.jp/>
// 2006-11-04 wye <http://never-ever.info/>
//================================================================

//----------------------------------------------------------------
// http://nishioka.sakura.ne.jp/google/ws.php?lon=137.243183&lat=35.091722&format=simple
//----------------------------------------------------------------

include_once '../../mainfile.php' ;
include_once XOOPS_ROOT_PATH .'/class/snoopy.php' ;
include_once XOOPS_ROOT_PATH .'/modules/happy_linux/include/multibyte.php';

$snoopy = new Snoopy;

// Akashi Muncipal Planetaruim: Akashi, Japan
$lon = 34.649334665716;
$lat = 135.0;
if ( isset($_GET['lon']) && isset($_GET['lat']) )
{
	$lon = floatval( $_GET['lon'] );
	$lat = floatval( $_GET['lat'] );
}

$url = "http://nishioka.sakura.ne.jp/google/ws.php".
	"?lon=". $lon .
	"&lat=". $lat.
	"&format=simple".
	"&version=0.1";

// null result
$xml = <<<END_OF_TEXT
<?xml version="1.0" encoding="UTF-8" ?>
<geometry>
</geometry>
END_OF_TEXT;

if ( $snoopy->fetch( $url ) )
{
	$xml = $snoopy->results;
}

happy_linux_http_output('pass');
header('Content-type: application/xml;charset=utf-8');
echo $xml;
exit();

?>