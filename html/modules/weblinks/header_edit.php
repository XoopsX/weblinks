<?php
// $Id: header_edit.php,v 1.1 2011/12/29 14:32:29 ohwada Exp $

// 2007-09-12 K.OHWADA
// divid from submit.php and modlink.php

//================================================================
// WebLinks Module
// 2004/01/23 K.OHWADA
//================================================================

include 'header_oh.php';

include_once XOOPS_ROOT_PATH.'/include/xoopscodes.php';
include_once XOOPS_ROOT_PATH.'/class/xoopsformloader.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/gtickets.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/html.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/form.php';

include_once WEBLINKS_ROOT_PATH.'/class/weblinks_auth.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_notification.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_modify.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_modify_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_rssc_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_rssc_edit_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_linkitem_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_linkitem_define_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_linkitem_store_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_form_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_form_check_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_edit.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_edit_base_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_add_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_mod_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_del_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_req_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_edit_handler.php';

?>