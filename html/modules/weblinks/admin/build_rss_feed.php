<?php
// $Id: build_rss_feed.php,v 1.1 2011/12/29 14:32:51 ohwada Exp $

//=========================================================
// WebLinks Module
// 2007-10-10 K.OHWADA
//=========================================================

include 'admin_header.php';

include_once WEBLINKS_ROOT_PATH.'/api/build_rss_feed.php';

$builder =& weblinks_get_handler( 'build_rss_feed', WEBLINKS_DIRNAME );
$post    =& happy_linux_post::getInstance();

$mode  = $post->get_get_text('mode');

$builder->set_view_goto_title( _HAPPY_LINUX_CONF_RSS_MANAGE );
$builder->set_view_goto_url( WEBLINKS_URL.'/admin/rss_build_manage.php' );
$builder->view_for_weblinks( $mode );

exit();
// --- main end ---

?>