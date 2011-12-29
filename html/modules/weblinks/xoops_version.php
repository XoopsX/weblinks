<?php
// $Id: xoops_version.php,v 1.1 2011/12/29 14:32:27 ohwada Exp $

// 2008-02-17 K.OHWADA
// sub menu: get_lang_sumit()
// block: change options

// 2007-11-11 K.OHWADA
// onInstall, onUpdate
// block: change options

// 2007-09-01 K.OHWADA
// add    notification: new_link_admin
// remove notification: approve

// 2007-08-25 K.OHWADA
// remove singlelink.php from category bookmark

// 2007-08-01 K.OHWADA
// google map in top and rate block

// 2007-04-08 K.OHWADA
// block photo

// 2007-03-25 K.OHWADA
// change blocks 1 param

// 2007-02-20 K.OHWADA
// weblinks_constant.php

// 2006-11-03 hiro
// random link block

// 2006-10-01 K.OHWADA
// remove header.html rss_build.html

// 2006-05-15 K.OHWADA
// v1.10
// use new handler
// use weblinks_version.php weblinks_menu.php
// move Config Settings to config table
// add template print.html

// 2006-05-14 K.OHWADA
// v1.02

// 2006-03-26
// REQ 3807: Description in main page

// 2006-03-15 K.OHWADA
// BUG 3746: show submenu incorrectly
// add $name_ext

// 2006-01-15 K.OHWADA
// weblinks ver 1.0
// module depulication

//================================================================
// WebLinks Module
// xoops_version.php
// 2004/01/23 K.OHWADA
//================================================================

$WEBLINKS_DIRNAME   = basename( dirname( __FILE__ ) );
$WEBLINKS_ROOT_PATH = XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME;
$WEBLINKS_URL       = XOOPS_URL.'/modules/'.$WEBLINKS_DIRNAME;

if( ! preg_match( '/^(\D+)(\d*)$/' , $WEBLINKS_DIRNAME , $regs ) ) echo ( "invalid dirname: " . htmlspecialchars( $WEBLINKS_DIRNAME ) ) ;
$WEBLINKS_NUMBER = $regs[2] === '' ? '' : intval( $regs[2] ) ;

include_once $WEBLINKS_ROOT_PATH.'/include/weblinks_version.php';
include_once $WEBLINKS_ROOT_PATH.'/include/weblinks_constant.php';
include_once $WEBLINKS_ROOT_PATH.'/include/functions.php';
include_once $WEBLINKS_ROOT_PATH.'/class/weblinks_menu.php';

$menu =& weblinks_menu::getInstance( $WEBLINKS_DIRNAME );

if ( $regs[1] == 'weblinks' )
{
	$name_ext = ' '.$WEBLINKS_NUMBER;
}
else
{
	$name_ext = ':'.$WEBLINKS_DIRNAME;
}

$modversion['version'] = WEBLINKS_VERSION;

$modversion['name'] = _MI_WEBLINKS_NAME.$name_ext;
$modversion['description'] = _MI_WEBLINKS_DESC;
$modversion['author'] = 'Kenichi OHWADA<br />( http://linux2.ohwada.net/ )';
$modversion['credits'] = '';
$modversion['help'] = '';
$modversion['license'] = "GPL see LICENSE";
$modversion['official'] = 0;
$modversion['image'] = 'images/'.$WEBLINKS_DIRNAME.'_slogo.png';
$modversion['dirname'] = $WEBLINKS_DIRNAME;

// All tables should not have any prefix!
$modversion['sqlfile']['mysql'] = 'sql/'.$WEBLINKS_DIRNAME.'.sql';

// -- Tables created by sql file (without prefix!) ---
$modversion['tables'][0] = $WEBLINKS_DIRNAME."_category";
$modversion['tables'][1] = $WEBLINKS_DIRNAME."_link";
$modversion['tables'][2] = $WEBLINKS_DIRNAME."_modify";
$modversion['tables'][3] = $WEBLINKS_DIRNAME."_broken";
$modversion['tables'][4] = $WEBLINKS_DIRNAME."_votedata";
$modversion['tables'][5] = $WEBLINKS_DIRNAME."_catlink";
$modversion['tables'][6] = $WEBLINKS_DIRNAME."_atomfeed";
$modversion['tables'][7] = $WEBLINKS_DIRNAME."_config";
$modversion['tables'][8] = $WEBLINKS_DIRNAME."_config2";
$modversion['tables'][9] = $WEBLINKS_DIRNAME."_linkitem";

// Admin things
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu'] = "admin/menu.php";

// Menu
$modversion['hasMain'] = 1;
$i = 1;

if ( $menu->show_submit() )
{
	$modversion['sub'][$i]['name'] = $menu->get_lang_sumit();
	$modversion['sub'][$i]['url'] = "submit.php";
	$i ++;
}

if ( $menu->show_hits() )
{
	$modversion['sub'][$i]['name'] = $menu->get_lang_hits();
	$modversion['sub'][$i]['url'] = "topten.php?hit=1";
	$i ++;
}

if ( $menu->show_rating() )
{
	$modversion['sub'][$i]['name'] = $menu->get_lang_rating();
	$modversion['sub'][$i]['url'] = "topten.php?rate=1";
	$i ++;
}

// Submenu
// BUG 3746: show submenu incorrectly

$catlist =& $menu->get_catlist();
foreach ($catlist as $cat)
{
	$title = htmlspecialchars( $cat['title'], ENT_QUOTES );
	$cid   = intval( $cat['cid'] );
	$modversion['sub'][$i]['name'] = " - ".$title;
	$modversion['sub'][$i]['url'] = "viewcat.php?cid=".$cid."";
	$i ++;
}


//---------------------------------------------------------
// Comments
//---------------------------------------------------------
// Comments
$modversion['hasComments'] = 1;
$modversion['comments']['itemName'] = 'lid';
$modversion['comments']['pageName'] = 'singlelink.php';
$modversion['comments']['extraParams'] = array('cid');

// Comment callback functions
$modversion['comments']['callbackFile'] = 'include/comment_functions.php';
$modversion['comments']['callback']['approve'] = $WEBLINKS_DIRNAME."_com_approve";
$modversion['comments']['callback']['update']  = 'weblinks_com_update';

//---------------------------------------------------------
//  Search 
//---------------------------------------------------------
$modversion['hasSearch'] = 1;
$modversion['search']['file'] = "include/search.inc.php";
$modversion['search']['func'] = $WEBLINKS_DIRNAME."_search";

//---------------------------------------------------------
//  Blocks 
//---------------------------------------------------------
$modversion['blocks'][1]['file'] = "weblinks_top.php";
$modversion['blocks'][1]['name'] = _MI_WEBLINKS_BNAME1.$name_ext;
$modversion['blocks'][1]['description'] = "Shows recently added web links";
$modversion['blocks'][1]['show_func'] = 'b_weblinks_top_show';
$modversion['blocks'][1]['edit_func'] = 'b_weblinks_top_edit';
$modversion['blocks'][1]['template']  = $WEBLINKS_DIRNAME."_block_new.html";
$modversion['blocks'][1]['options'] = 
	$WEBLINKS_DIRNAME."|time_update|10|30|0|0|7|0|50|50|0|0|0|0|300|1000|100|-1|200|1|1";

$modversion['blocks'][2]['file'] = "weblinks_top.php";
$modversion['blocks'][2]['name'] = _MI_WEBLINKS_BNAME2.$name_ext;
$modversion['blocks'][2]['description'] = "Shows most visited web links";
$modversion['blocks'][2]['show_func'] = 'b_weblinks_top_show';
$modversion['blocks'][2]['edit_func'] = 'b_weblinks_top_edit';
$modversion['blocks'][2]['template']  = $WEBLINKS_DIRNAME."_block_top.html";
$modversion['blocks'][2]['options'] = 
	$WEBLINKS_DIRNAME."|hits|10|30|0|0|7|0|50|50|0|0|0|0|300|1000|100|-1|200|1|1";

// add rating block
$modversion['blocks'][3]['file'] = "weblinks_top.php";
$modversion['blocks'][3]['name'] = _MI_WEBLINKS_BNAME3.$name_ext;
$modversion['blocks'][3]['description'] = "Shows most rating web links";
$modversion['blocks'][3]['show_func'] = 'b_weblinks_top_show';
$modversion['blocks'][3]['edit_func'] = 'b_weblinks_top_edit';
$modversion['blocks'][3]['template']  = $WEBLINKS_DIRNAME."_block_rate.html";
$modversion['blocks'][3]['options'] = 
	$WEBLINKS_DIRNAME."|rating|10|30|0|0|7|0|50|50|0|0|0|0|300|1000|100|-1|200|1|1";

// add category list block by Ryuji
$modversion['blocks'][4]['file'] = "weblinks_catlist.php";
$modversion['blocks'][4]['name'] = _MI_WEBLINKS_BNAME4.$name_ext;
$modversion['blocks'][4]['description'] = "Shows category list";
$modversion['blocks'][4]['show_func'] = 'b_weblinks_catlist_show';
$modversion['blocks'][4]['edit_func'] = 'b_weblinks_catlist_edit';
$modversion['blocks'][4]['template']  = $WEBLINKS_DIRNAME."_block_catlist.html";
$modversion['blocks'][4]['options'] = $WEBLINKS_DIRNAME."|5|1|100|50";

// atomfeed
$modversion['blocks'][5]['file'] = "weblinks_atomfeed.php";
$modversion['blocks'][5]['name'] = _MI_WEBLINKS_BNAME5.$name_ext;
$modversion['blocks'][5]['description'] = "Shows new atom feed";
$modversion['blocks'][5]['show_func'] = 'b_weblinks_atom_show';
$modversion['blocks'][5]['edit_func'] = 'b_weblinks_atom_edit';
$modversion['blocks'][5]['template']  = $WEBLINKS_DIRNAME."_block_atom.html";
$modversion['blocks'][5]['options'] = $WEBLINKS_DIRNAME."|10|40|100";

$modversion['blocks'][6]['file'] = "weblinks_atomfeed.php";
$modversion['blocks'][6]['name'] = _MI_WEBLINKS_BNAME6.$name_ext;
$modversion['blocks'][6]['description'] = "Shows blog";
$modversion['blocks'][6]['show_func'] = 'b_weblinks_blog_show';
$modversion['blocks'][6]['edit_func'] = 'b_weblinks_blog_edit';
$modversion['blocks'][6]['template']  = $WEBLINKS_DIRNAME."_block_blog.html";
$modversion['blocks'][6]['options'] = $WEBLINKS_DIRNAME."|0|10|1|200";

// added by hiro
// generic random_link
$modversion['blocks'][7]['file'] = "weblinks_top.php";
$modversion['blocks'][7]['name'] = _MI_WEBLINKS_BNAME_RANDOM.$name_ext;
$modversion['blocks'][7]['description'] = "Shows Random links";
$modversion['blocks'][7]['show_func'] = "b_weblinks_generic_show";
$modversion['blocks'][7]['edit_func'] = "b_weblinks_generic_edit";
$modversion['blocks'][7]['template']  = $WEBLINKS_DIRNAME."_block_random.html";
$modversion['blocks'][7]['options'] = 
	$WEBLINKS_DIRNAME."|5|30|0|0|0|0|50|50|0|1|1|0|1|-|1|lid|ASC|0|0|0|0|300|1000|100|-1|200";

// generic leatest
$modversion['blocks'][8]['file'] = "weblinks_top.php";
$modversion['blocks'][8]['name'] = _MI_WEBLINKS_BNAME_GENERIC.$name_ext;
$modversion['blocks'][8]['description'] = "Shows Gernric links";
$modversion['blocks'][8]['show_func'] = "b_weblinks_generic_show";
$modversion['blocks'][8]['edit_func'] = "b_weblinks_generic_edit";
$modversion['blocks'][8]['template']  = $WEBLINKS_DIRNAME."_block_generic.html";
$modversion['blocks'][8]['options'] = 
	$WEBLINKS_DIRNAME."|10|30|0|0|7|0|50|50|1|0|0|0|1|-|0|time_update|DESC|0|0|0|0|300|1000|100|-1|200";

// photo
$modversion['blocks'][9]['file'] = "weblinks_plugin.php";
$modversion['blocks'][9]['name'] = _MI_WEBLINKS_BNAME_RANDOM_PHOTO.$name_ext;
$modversion['blocks'][9]['description'] = "Shows Photos";
$modversion['blocks'][9]['show_func'] = "b_weblinks_photo_show";
$modversion['blocks'][9]['edit_func'] = "b_weblinks_photo_edit";
$modversion['blocks'][9]['template']  = $WEBLINKS_DIRNAME."_block_photo.html";
$modversion['blocks'][9]['options'] = $WEBLINKS_DIRNAME."|1";

//---------------------------------------------------------
// Templates
//---------------------------------------------------------
$modversion['templates'][1]['file'] = $WEBLINKS_DIRNAME."_index.html";
$modversion['templates'][1]['description'] = '';
$modversion['templates'][2]['file'] = $WEBLINKS_DIRNAME."_viewcat.html";
$modversion['templates'][2]['description'] = '';
$modversion['templates'][3]['file'] = $WEBLINKS_DIRNAME."_singlelink.html";
$modversion['templates'][3]['description'] = '';
$modversion['templates'][4]['file'] = $WEBLINKS_DIRNAME."_topten.html";
$modversion['templates'][4]['description'] = '';
$modversion['templates'][5]['file'] = $WEBLINKS_DIRNAME."_ratelink.html";
$modversion['templates'][5]['description'] = '';
$modversion['templates'][6]['file'] = $WEBLINKS_DIRNAME."_brokenlink.html";
$modversion['templates'][6]['description'] = '';
$modversion['templates'][7]['file'] = $WEBLINKS_DIRNAME."_catlist.html";
$modversion['templates'][7]['description'] = '';
$modversion['templates'][8]['file'] = $WEBLINKS_DIRNAME."_search.html";
$modversion['templates'][8]['description'] = '';
$modversion['templates'][9]['file'] = $WEBLINKS_DIRNAME."_passwd.html";
$modversion['templates'][9]['description'] = '';
$modversion['templates'][10]['file'] = $WEBLINKS_DIRNAME."_viewmark.html";
$modversion['templates'][10]['description'] = '';
$modversion['templates'][11]['file'] = $WEBLINKS_DIRNAME."_viewfeed.html";
$modversion['templates'][11]['description'] = '';

// BUG 3111: timeout occurs in popular site if many top categories
$modversion['templates'][12]['file'] = $WEBLINKS_DIRNAME."_topten_mixed.html";
$modversion['templates'][12]['description'] = '';

// v1.10
$modversion['templates'][13]['file'] = $WEBLINKS_DIRNAME."_print.html";
$modversion['templates'][13]['description'] = '';


//---------------------------------------------------------
// Config Settings
// move Config Settings to config table
//---------------------------------------------------------


//---------------------------------------------------------
// Notification
//---------------------------------------------------------
$modversion['hasNotification'] = 1;
$modversion['notification']['lookup_file'] = 'include/notification.inc.php';
$modversion['notification']['lookup_func'] = $WEBLINKS_DIRNAME."_notify_iteminfo";

$modversion['notification']['category'][1]['name'] = 'global';
$modversion['notification']['category'][1]['title'] = _MI_WEBLINKS_GLOBAL_NOTIFY;
$modversion['notification']['category'][1]['description'] = _MI_WEBLINKS_GLOBAL_NOTIFYDSC;

//$modversion['notification']['category'][1]['subscribe_from'] = array('index.php','viewcat.php','singlelink.php');
$modversion['notification']['category'][1]['subscribe_from'] = array('index.php','viewcat.php','singlelink.php', 'notification_manage.php');

// remove singlelink.php from category bookmark
$modversion['notification']['category'][2]['name'] = 'category';
$modversion['notification']['category'][2]['title'] = _MI_WEBLINKS_CATEGORY_NOTIFY;
$modversion['notification']['category'][2]['description'] = _MI_WEBLINKS_CATEGORY_NOTIFYDSC;
$modversion['notification']['category'][2]['subscribe_from'] = 'viewcat.php';
$modversion['notification']['category'][2]['item_name'] = 'cid';
$modversion['notification']['category'][2]['allow_bookmark'] = 1;

$modversion['notification']['category'][3]['name'] = 'link';
$modversion['notification']['category'][3]['title'] = _MI_WEBLINKS_LINK_NOTIFY;
$modversion['notification']['category'][3]['description'] = _MI_WEBLINKS_LINK_NOTIFYDSC;
$modversion['notification']['category'][3]['subscribe_from'] = 'singlelink.php';
$modversion['notification']['category'][3]['item_name'] = 'lid';
$modversion['notification']['category'][3]['allow_bookmark'] = 1;

$modversion['notification']['event'][1]['name'] = 'new_category';
$modversion['notification']['event'][1]['category'] = 'global';
$modversion['notification']['event'][1]['title'] = _MI_WEBLINKS_GLOBAL_NEWCATEGORY_NOTIFY;
$modversion['notification']['event'][1]['caption'] = _MI_WEBLINKS_GLOBAL_NEWCATEGORY_NOTIFYCAP;
$modversion['notification']['event'][1]['description'] = _MI_WEBLINKS_GLOBAL_NEWCATEGORY_NOTIFYDSC;
$modversion['notification']['event'][1]['mail_template'] = 'global_newcategory_notify';
$modversion['notification']['event'][1]['mail_subject'] = _MI_WEBLINKS_GLOBAL_NEWCATEGORY_NOTIFYSBJ;

$modversion['notification']['event'][2]['name'] = 'link_modify';
$modversion['notification']['event'][2]['category'] = 'global';
$modversion['notification']['event'][2]['admin_only'] = 1;
$modversion['notification']['event'][2]['title'] = _MI_WEBLINKS_GLOBAL_LINKMODIFY_NOTIFY;
$modversion['notification']['event'][2]['caption'] = _MI_WEBLINKS_GLOBAL_LINKMODIFY_NOTIFYCAP;
$modversion['notification']['event'][2]['description'] = _MI_WEBLINKS_GLOBAL_LINKMODIFY_NOTIFYDSC;
$modversion['notification']['event'][2]['mail_template'] = 'global_linkmodify_notify';
$modversion['notification']['event'][2]['mail_subject'] = _MI_WEBLINKS_GLOBAL_LINKMODIFY_NOTIFYSBJ;

$modversion['notification']['event'][3]['name'] = 'link_broken';
$modversion['notification']['event'][3]['category'] = 'global';
$modversion['notification']['event'][3]['admin_only'] = 1;
$modversion['notification']['event'][3]['title'] = _MI_WEBLINKS_GLOBAL_LINKBROKEN_NOTIFY;
$modversion['notification']['event'][3]['caption'] = _MI_WEBLINKS_GLOBAL_LINKBROKEN_NOTIFYCAP;
$modversion['notification']['event'][3]['description'] = _MI_WEBLINKS_GLOBAL_LINKBROKEN_NOTIFYDSC;
$modversion['notification']['event'][3]['mail_template'] = 'global_linkbroken_notify';
$modversion['notification']['event'][3]['mail_subject'] = _MI_WEBLINKS_GLOBAL_LINKBROKEN_NOTIFYSBJ;

$modversion['notification']['event'][4]['name'] = 'link_submit';
$modversion['notification']['event'][4]['category'] = 'global';
$modversion['notification']['event'][4]['admin_only'] = 1;
$modversion['notification']['event'][4]['title'] = _MI_WEBLINKS_GLOBAL_LINKSUBMIT_NOTIFY;
$modversion['notification']['event'][4]['caption'] = _MI_WEBLINKS_GLOBAL_LINKSUBMIT_NOTIFYCAP;
$modversion['notification']['event'][4]['description'] = _MI_WEBLINKS_GLOBAL_LINKSUBMIT_NOTIFYDSC;
$modversion['notification']['event'][4]['mail_template'] = 'global_linksubmit_notify';
$modversion['notification']['event'][4]['mail_subject'] = _MI_WEBLINKS_GLOBAL_LINKSUBMIT_NOTIFYSBJ;

$modversion['notification']['event'][5]['name'] = 'new_link';
$modversion['notification']['event'][5]['category'] = 'global';
$modversion['notification']['event'][5]['title'] = _MI_WEBLINKS_GLOBAL_NEWLINK_NOTIFY;
$modversion['notification']['event'][5]['caption'] = _MI_WEBLINKS_GLOBAL_NEWLINK_NOTIFYCAP;
$modversion['notification']['event'][5]['description'] = _MI_WEBLINKS_GLOBAL_NEWLINK_NOTIFYDSC;
$modversion['notification']['event'][5]['mail_template'] = 'global_newlink_notify';
$modversion['notification']['event'][5]['mail_subject'] = _MI_WEBLINKS_GLOBAL_NEWLINK_NOTIFYSBJ;

$modversion['notification']['event'][6]['name'] = 'link_submit';
$modversion['notification']['event'][6]['category'] = 'category';
$modversion['notification']['event'][6]['admin_only'] = 1;
$modversion['notification']['event'][6]['title'] = _MI_WEBLINKS_CATEGORY_LINKSUBMIT_NOTIFY;
$modversion['notification']['event'][6]['caption'] = _MI_WEBLINKS_CATEGORY_LINKSUBMIT_NOTIFYCAP;
$modversion['notification']['event'][6]['description'] = _MI_WEBLINKS_CATEGORY_LINKSUBMIT_NOTIFYDSC;
$modversion['notification']['event'][6]['mail_template'] = 'category_linksubmit_notify';
$modversion['notification']['event'][6]['mail_subject'] = _MI_WEBLINKS_CATEGORY_LINKSUBMIT_NOTIFYSBJ;

$modversion['notification']['event'][7]['name'] = 'new_link';
$modversion['notification']['event'][7]['category'] = 'category';
$modversion['notification']['event'][7]['title'] = _MI_WEBLINKS_CATEGORY_NEWLINK_NOTIFY;
$modversion['notification']['event'][7]['caption'] = _MI_WEBLINKS_CATEGORY_NEWLINK_NOTIFYCAP;
$modversion['notification']['event'][7]['description'] = _MI_WEBLINKS_CATEGORY_NEWLINK_NOTIFYDSC;
$modversion['notification']['event'][7]['mail_template'] = 'category_newlink_notify';
$modversion['notification']['event'][7]['mail_subject'] = _MI_WEBLINKS_CATEGORY_NEWLINK_NOTIFYSBJ;

//$modversion['notification']['event'][8]['name'] = 'approve';
//$modversion['notification']['event'][8]['category'] = 'link';
//$modversion['notification']['event'][8]['invisible'] = 1;
//$modversion['notification']['event'][8]['title'] = _MI_WEBLINKS_LINK_APPROVE_NOTIFY;
//$modversion['notification']['event'][8]['caption'] = _MI_WEBLINKS_LINK_APPROVE_NOTIFYCAP;
//$modversion['notification']['event'][8]['description'] = _MI_WEBLINKS_LINK_APPROVE_NOTIFYDSC;
//$modversion['notification']['event'][8]['mail_template'] = 'link_approve_notify';
//$modversion['notification']['event'][8]['mail_subject'] = _MI_WEBLINKS_LINK_APPROVE_NOTIFYSBJ;

// notification: new_link_admin
$modversion['notification']['event'][9]['name'] = 'new_link_admin';
$modversion['notification']['event'][9]['category'] = 'global';
$modversion['notification']['event'][9]['admin_only'] = 1;
$modversion['notification']['event'][9]['title'] = _MI_WEBLINKS_GLOBAL_NEWLINK_ADMIN;
$modversion['notification']['event'][9]['caption'] = _MI_WEBLINKS_GLOBAL_NEWLINK_ADMIN_CAP;
$modversion['notification']['event'][9]['description'] = _MI_WEBLINKS_GLOBAL_NEWLINK_ADMIN_DSC;
$modversion['notification']['event'][9]['mail_template'] = 'global_newlink_admin_notify';
$modversion['notification']['event'][9]['mail_subject'] = _MI_WEBLINKS_GLOBAL_NEWLINK_ADMIN_SBJ;

$modversion['notification']['event'][10]['name'] = 'new_link_comment';
$modversion['notification']['event'][10]['category'] = 'global';
$modversion['notification']['event'][10]['admin_only'] = 1;
$modversion['notification']['event'][10]['title'] = _MI_WEBLINKS_GLOBAL_NEWLINK_COMMENT;
$modversion['notification']['event'][10]['caption'] = _MI_WEBLINKS_GLOBAL_NEWLINK_COMMENT_CAP;
$modversion['notification']['event'][10]['description'] = _MI_WEBLINKS_GLOBAL_NEWLINK_COMMENT_DSC;
$modversion['notification']['event'][10]['mail_template'] = 'global_newlink_admin_notify';
$modversion['notification']['event'][10]['mail_subject'] = _MI_WEBLINKS_GLOBAL_NEWLINK_COMMENT_SBJ;

// onInstall, onUpdate, onUninstall
$modversion['onInstall'] = 'oninstall.php';
$modversion['onUpdate']  = 'oninstall.php';

?>