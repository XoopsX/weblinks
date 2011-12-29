<?php
// $Id: kml.php,v 1.1 2011/12/29 14:32:32 ohwada Exp $

//=========================================================
// WebLinks Module
// 2008-02-17 K.OHWADA
//=========================================================

$WEBLINKS_DIRNAME = basename( dirname( dirname( __FILE__ ) ) );

include '../../../mainfile.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/api/build_kml.php';

//=========================================================
// main
//=========================================================
$weblinks_config_handler =& weblinks_get_handler( 'config2_basic', $WEBLINKS_DIRNAME );
$weblinks_config_handler->init();

$weblinks_build_handler =& weblinks_get_handler( 'build_kml', $WEBLINKS_DIRNAME );
$weblinks_build_handler->build();

exit();
// --- main end ---

?>