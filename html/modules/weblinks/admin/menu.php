<?php
// $Id: menu.php,v 1.1 2011/12/29 14:32:56 ohwada Exp $

// 2007-11-01 K.OHWADA
// small change

// 2006-09-20 K.OHWADA
// small change

// 2005-04-02 K.OHWADA
// change to broken_manage.php

// 2005-01-01 K.OHWADA
// update

// 2004-11-20 K.OHWADA
// update

//================================================================
// admin menu
// divid this file from index.php
// 2004/01/14 K.OHWADA
//================================================================

$adminmenu[1]['title'] = _MI_WEBLINKS_ADMENU0;
$adminmenu[1]['link'] = "admin/index.php";
$adminmenu[2]['title'] = _MI_WEBLINKS_ADMENU1;
$adminmenu[2]['link'] = "admin/index.php";
$adminmenu[3]['title'] = _MI_WEBLINKS_ADMENU2;
$adminmenu[3]['link'] = "admin/category_list.php";
$adminmenu[4]['title'] = _MI_WEBLINKS_ADMENU3;
$adminmenu[4]['link'] = "admin/link_list.php";
$adminmenu[5]['title'] = _MI_WEBLINKS_ADMENU4;
$adminmenu[5]['link'] = "admin/link_manage.php";
$adminmenu[6]['title'] = _MI_WEBLINKS_ADMENU5;
$adminmenu[6]['link'] = "admin/modify_list.php?op=list_new";
$adminmenu[7]['title'] = _MI_WEBLINKS_ADMENU6;
$adminmenu[7]['link'] = "admin/modify_list.php?op=list_mod";
$adminmenu[8]['title'] = _MI_WEBLINKS_ADMENU7;
$adminmenu[8]['link'] = "admin/broken_list.php";

?>