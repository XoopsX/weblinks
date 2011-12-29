<?php
// $Id: link_check.php,v 1.1 2011/12/29 14:32:59 ohwada Exp $

// 2007-06-01 K.OHWADA
// command parameter: limit offset

// 2006-09-10 K.OHWADA
// use happy_linux

// 2006-05-15 K.OHWADA
// new handler

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication

//=========================================================
// WebLinks Module
// link check
// this program must be run by Command Line Interface mode.
// 2004-10-20 K.OHWADA
//=========================================================

//---------------------------------------------------------
// php -q -f XOOPS/modules/weblinks/bin/link_check.php  pass
// php -q -f XOOPS/modules/weblinks/bin/link_check.php -pass=pass [ -limit=0 -offset=0  -echo ]
//---------------------------------------------------------

//---------------------------------------------------------
// environment
//---------------------------------------------------------
$WEBLINKS_PATH    = dirname( dirname( __FILE__ ) );
$WEBLINKS_DIRNAME = basename( $WEBLINKS_PATH );
$XOOPS_ROOT_PATH  = dirname( dirname( $WEBLINKS_PATH ) );

//---------------------------------------------------------
// main
//---------------------------------------------------------
include $XOOPS_ROOT_PATH."/modules/".$WEBLINKS_DIRNAME."/bin/bin_api.php";

$link_check = new bin_link_check( $WEBLINKS_DIRNAME );
$link_check->check();

exit();

?>