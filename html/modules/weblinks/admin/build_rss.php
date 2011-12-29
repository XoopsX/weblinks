<?php
// $Id: build_rss.php,v 1.1 2011/12/29 14:32:52 ohwada Exp $

//=========================================================
// WebLinks Module
// 2007-10-10 K.OHWADA
//=========================================================

include 'admin_header.php';

$post =& happy_linux_post::getInstance();
$type = $post->get_get_text('type');
$mode = $post->get_get_text('mode');

if ($type == 'feed')
{
	if ( WEBLINKS_RSSC_EXIST )
	{
		include_once WEBLINKS_ROOT_PATH.'/api/build_rss_feed.php';

		$feed_builder =& weblinks_get_handler( 'build_rss_feed', WEBLINKS_DIRNAME );

		$feed_builder->set_view_goto_title( _HAPPY_LINUX_CONF_RSS_MANAGE );
		$feed_builder->set_view_goto_url( WEBLINKS_URL.'/admin/rss_build_manage.php' );
		$feed_builder->view_for_weblinks( $mode );
	}
}
else
{
	include_once WEBLINKS_ROOT_PATH.'/api/build_rss.php';

	$rss_builder =& weblinks_get_handler( 'build_rss', WEBLINKS_DIRNAME );

	$rss_builder->set_view_goto_title( _HAPPY_LINUX_CONF_RSS_MANAGE );
	$rss_builder->set_view_goto_url( WEBLINKS_URL.'/admin/rss_build_manage.php' );
	$rss_builder->view( $mode );
}

exit();
// --- main end ---

?>