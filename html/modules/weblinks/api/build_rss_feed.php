<?php
// $Id: build_rss_feed.php,v 1.1 2011/12/29 14:32:40 ohwada Exp $

// 2008-01-10 K.OHWADA
// Fatal error: Call to a member function on a non-object in weblinks_rssc_view_handler.php

//=========================================================
// WebLinks Module
// 2007-10-10 K.OHWADA
//=========================================================

//---------------------------------------------------------
// rssc
//---------------------------------------------------------
include_once WEBLINKS_RSSC_ROOT_PATH.'/api/rss_builder.php';

//---------------------------------------------------------
// weblinks
//---------------------------------------------------------
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_build_rss_feed_handler.php';

?>