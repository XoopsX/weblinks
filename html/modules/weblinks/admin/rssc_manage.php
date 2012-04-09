<?php
// $Id: rssc_manage.php,v 1.1 2012/04/09 10:23:37 ohwada Exp $

//=========================================================
// WebLinks Module
// 2012-04-02 K.OHWADA
//=========================================================

include 'admin_header_min.php';

// ===  main ===
if ( WEBLINKS_RSSC_EXIST && WEBLINKS_RSSC_USE ) {
	$handler =& happy_linux_basic_handler::getInstance( WEBLINKS_DIRNAME );
	$total_feed = $handler->get_count_by_tablename( 'feed', WEBLINKS_RSSC_DIRNAME );
	$url_rssc_archive = WEBLINKS_RSSC_URL.'/admin/archive_manage.php';
} else {
	$total_feed = 0;
	$url_rssc_archive = '';
}

xoops_cp_header();
weblinks_admin_print_menu();

echo "<h3>". _AM_WEBLINKS_TITLE_RSSC_MANAGE ."</h3>\n";

echo "<ul>\n";
echo "<li><a href='rssc_add.php'>".  _AM_WEBLINKS_TITLE_RSSC_ADD ."</a><br /><br /></li>\n";

// --- RSSC arcive ---
echo "<li>";

if ( $url_rssc_archive ) {
	echo "<a href='$url_rssc_archive'>";
}

echo _AM_WEBLINKS_TITLE_RSSC_ARCHIVE. " ($total_feed) ";

if ( $url_rssc_archive ) {
	echo "</a>";
}

echo "<br /><br /></li>\n";
// --- RSSC arcive end ---

echo "</ul>\n";

xoops_cp_footer();
exit();
// === end of main ===

?>