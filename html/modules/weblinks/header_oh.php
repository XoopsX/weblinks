<?php
// $Id: header_oh.php,v 1.1 2011/12/29 14:32:29 ohwada Exp $

// 2007-09-01 K.OHWADA
// mail_template

//================================================================
// WebLinks Module
// this header for object_handler
// singlelink.php print.php brokenlink.php ratelink.php lostpass.php
// submit.php modlink.php 
// 2007-06-01 K.OHWADA
//================================================================

include 'header.php';

//---------------------------------------------------------
// happy_linux
//---------------------------------------------------------
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/object.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/object_validater.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/object_handler.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/mail_template.php';

//---------------------------------------------------------
// weblinks
//---------------------------------------------------------
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_handler.php';

?>