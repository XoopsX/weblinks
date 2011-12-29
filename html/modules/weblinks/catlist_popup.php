<?php
// $Id: catlist_popup.php,v 1.1 2011/12/29 14:32:29 ohwada Exp $

// 2006-09-20 K.OHWADA
// use happy_linux

// 2006-05-15 K.OHWADA
// new handler

// 2004-11-28 K.OHWADA
// write fair, delete unnecessary comments

// 2004/08/10 K.OHWADA
// use class weblinksCatlink
// enable to install this module two or more. 

//================================================================
// WebLinks Module
// popup category list
// 2004/01/14 K.OHWADA
//================================================================

include "header.php";

$weblinks_view_handler =& weblinks_get_handler( 'link_view', WEBLINKS_DIRNAME );

xoops_header(false);
echo "</head><body>";
echo "<br />\n";
echo '<h3 align="center">'._WLS_CATLIST."</h3>";
echo "<hr />\n";
echo '<table align="center"><tr><td>';

// --- category list ---
$weblinks_view_handler->init();
$catlist = $weblinks_view_handler->get_all_catlist();

foreach ($catlist as $cat) 
{
	$url = WEBLINKS_URL.'/viewcat.php?cid='.$cat['cid'];
	echo "<a href='".$url."' target='_blank'><b>".$cat['path']."</b></a>&nbsp;(".$cat['count'].")<br />\n";
}

echo "</td></tr></table>\n";
echo "<hr />\n";
echo "<div style='text-align:center;'><input value='"._CLOSE."' type='button' onclick='javascript:window.close();' /></div>";
echo "<br />\n";

xoops_footer();

?>