<?php
// $Id: rss.php,v 1.1 2011/12/29 14:33:00 ohwada Exp $

//=========================================================
// WebLinks Module
// 2007-09-20 K.OHWADA
//=========================================================

include_once 'dev_header.php';

//=========================================================
// main
//=========================================================
$id   = isset($_GET['id']) ? $_GET['id'] : 0;
$host = 'host'.$id;
$file = WEBLINKS_ROOT_PATH. '/dev/rss.xml.tpl';
$tpl  = file_get_contents( $file );
$xml  = str_replace( '{host}', $host, $tpl );

happy_linux_http_output('pass');
header('Content-type: application/xml;charset=utf-8');
echo $xml;
exit();
// --- main end ---

?>