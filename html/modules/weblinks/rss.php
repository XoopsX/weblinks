<?php
// $Id: rss.php,v 1.1 2011/12/29 14:32:29 ohwada Exp $

// 2007-07-20 K.OHWADA
// set_param()

// 2007-06-01 K.OHWADA
// api/rss_builder.php

// 2006-09-20 K.OHWADA
// renewal function: show link 

//=========================================================
// WebLinks Module
// 2006-09-20 K.OHWADA
//=========================================================

include 'header.php';
include_once WEBLINKS_ROOT_PATH.'/api/build_rss.php';

//=========================================================
// main
//=========================================================
$weblinks_build_handler =& weblinks_get_handler( 'build_rss', WEBLINKS_DIRNAME );
$weblinks_build_handler->build_for_link();
exit();
// --- main end ---

?>