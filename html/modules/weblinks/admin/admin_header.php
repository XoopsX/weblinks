<?php
// $Id: admin_header.php,v 1.2 2012/04/09 10:20:04 ohwada Exp $

// 2012-04-02 K.OHWADA
// remove weblinks_gmap.php

// 2007-11-01 K.OHWADA
// divid to admin_header_min.php

// 2007-09-20 K.OHWADA
// weblinks_link_bin_handler.php

// 2007-09-01 K.OHWADA
// remove weblinks_mailer.php

// 2007-08-01 K.OHWADA
// weblinks_gmap

// 2007-06-10 K.OHWADA
// api/view.php api/refresh.php
// d3forum_sel.php

// 2007-05-06 K.OHWADA
// BUG 4564: Fatal error, when set rssc_use if not exist RSSC module
// rssc module exists check

// 2007-03-25 K.OHWADA
// album_sel.php

// 2007-02-20 K.OHWADA
// happy_linux_time.php
// weblinks_plugin.php

// 2006-12-10 K.OHWADA
// use object_validater.php

// 2006-10-05 K.OHWADA
// use happy_linux
// config init in here

// 2006-05-15 K.OHWADA
// new handler
// use constant WEBLINKS_ROOT_PATH

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication

//=========================================================
// WebLinks Module
// admin header
// 2004-10-13 K.OHWADA
//=========================================================

include 'admin_header_min.php';

//---------------------------------------------------------
// system
//---------------------------------------------------------
include_once XOOPS_ROOT_PATH.'/class/xoopstree.php';
include_once XOOPS_ROOT_PATH.'/class/xoopsformloader.php';
include_once XOOPS_ROOT_PATH.'/class/template.php';

//---------------------------------------------------------
// happy_linux
//---------------------------------------------------------
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/api/remote_image.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/post.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/html.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/form.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/form_lib.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/object.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/object_validater.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/object_handler.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/pagenavi.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/page_frame.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/manage.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/highlight.php';

//---------------------------------------------------------
// weblinks
//---------------------------------------------------------
include_once WEBLINKS_ROOT_PATH.'/plugins/d3forum_sel.php';
include_once WEBLINKS_ROOT_PATH.'/plugins/forum_sel.php';
include_once WEBLINKS_ROOT_PATH.'/plugins/album_sel.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_plugin.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_auth.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_menu.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_header.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_locate.php';

//---------------------------------------------------------
// linkitem
//---------------------------------------------------------
$weblinks_linkitem_handler =& weblinks_get_handler( 'linkitem_basic', WEBLINKS_DIRNAME );
$weblinks_linkitem_handler->init();

?>