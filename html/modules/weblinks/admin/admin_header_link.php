<?php
// $Id: admin_header_link.php,v 1.2 2012/04/09 10:20:04 ohwada Exp $

// 2012-04-02 K.OHWADA
// weblinks_block_view.php

// 2008-02-17 K.OHWADA
// weblinks_link_view_basic.php

// 2007-11-01 K.OHWADA
// weblinks_link_count_handler.php

//=========================================================
// WebLinks Module
// 2007-09-20 K.OHWADA
//=========================================================

// Fatal error: Class 'weblinks_link_edit_base_handler' not found
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_notification.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_count_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_cat_view_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_block_view.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_view_basic.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_view.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_view_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_edit.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_edit_base_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_add_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_mod_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_del_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_req_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_edit_handler.php';

?>