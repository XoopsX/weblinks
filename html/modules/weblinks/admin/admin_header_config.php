<?php
// $Id: admin_header_config.php,v 1.1 2011/12/29 14:32:53 ohwada Exp $

// 2007-11-01 K.OHWADA
// weblinks_config2_form.php

//=========================================================
// WebLinks Module
// 2007-09-20 K.OHWADA
//=========================================================

include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/dir.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/config_base_handler.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/config_define_handler.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/config_store_handler.php';

include_once WEBLINKS_ROOT_PATH.'/class/weblinks_config2_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_config2_define_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_config2_form.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_linkitem_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_linkitem_define_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_linkitem_store_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_locate.php';

include_once WEBLINKS_ROOT_PATH.'/admin/admin_config_class.php';
include_once WEBLINKS_ROOT_PATH.'/admin/admin_config_store_class.php';
include_once WEBLINKS_ROOT_PATH.'/admin/admin_config_menu_class.php';

?>