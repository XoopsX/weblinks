<?php
// $Id: link_manage.php,v 1.2 2012/04/09 10:20:04 ohwada Exp $

// 2012-04-02 K.OHWADA
// weblinks_webmap

// 2008-02-17 K.OHWADA
// weblinks_link_view_basic.php
// BUG : Fatal error: Undefined class name 'happy_linux_keyword' in weblinks_template.php

// 2007-11-20 K.OHWADA
// BUG : Fatal error: Undefined class name 'happy_linux_keyword' in weblinks_template.php

// 2007-11-11 K.OHWADA
// _include_link_add()
// WEBLINKS_OP_APPROVE_NEW

// 2007-09-20 K.OHWADA
// admin_header_link.php

// 2007-09-10 K.OHWADA
// general revision

// 2007-09-06 K.OHWADA
// BUG 4698: undefined method weblinks_link_edit_handler::build_tags_addlink()
// _notification_add_link()

// 2007-05-18 K.OHWADA
// get_error_msg_addlink() -> get_errors_addlink()
// get_error_msg_modlink() -> get_errors_modlink()

// 2007-03-01 K.OHWADA
// weblinks_link_view.php
// weblinks_link_edit.php
// hack for multi site
// add forum_id comment_use field
// update_cat()

// 2006-12-03 K.OHWADA
// Fatal error: Call to undefined method admin_link_manage::_print_mod_table_error()

// 2006-10-14 K.OHWADA
// use _AM_WEBLINKS_ADD_BANNER
// show _WLS_NEWLINKADDED in blue

// 2006-10-05 K.OHWADA
// use happy_linux
// use rssc WEBLINKS_RSSC_USE
// move delVote to votadata_manage

// 2006-05-15 K.OHWADA
// new handler
// add class admin_link_manage
// use token ticket

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication

//=========================================================
// WebLinks Module
// admin link manage
// divid this file from index.php
// 2004/01/14 K.OHWADA
//=========================================================

include 'admin_header_min.php';

include_once XOOPS_ROOT_PATH.'/class/xoopstree.php';
include_once XOOPS_ROOT_PATH.'/class/xoopsformloader.php';
include_once XOOPS_ROOT_PATH.'/class/template.php';

include_once XOOPS_ROOT_PATH.'/modules/happy_linux/api/remote_image.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/post.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/highlight.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/html.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/form.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/form_lib.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/object.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/object_validater.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/object_handler.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/manage.php';

//include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/browser.php';
//include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/search.php';
//include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/pagenavi.php';
//include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/page_frame.php';

include_once WEBLINKS_ROOT_PATH.'/plugins/d3forum_sel.php';
include_once WEBLINKS_ROOT_PATH.'/plugins/forum_sel.php';
include_once WEBLINKS_ROOT_PATH.'/plugins/album_sel.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_plugin.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_menu.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_auth.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_header.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_block_view.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_block_webmap.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_webmap.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_notification.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_view_basic.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_view.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_edit.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_edit_base_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_form_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_form_admin_handler.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_form_check_handler.php';

if ( WEBLINKS_RSSC_USE )
{
	include_once WEBLINKS_RSSC_ROOT_PATH.'/api/lang_main.php';
	include_once WEBLINKS_RSSC_ROOT_PATH.'/api/view.php';
	include_once WEBLINKS_RSSC_ROOT_PATH.'/api/refresh.php';
	include_once WEBLINKS_RSSC_ROOT_PATH.'/api/manage.php';

	include_once WEBLINKS_ROOT_PATH.'/class/weblinks_rssc_handler.php';
	include_once WEBLINKS_ROOT_PATH.'/admin/rssc_manage_class.php';
}

//=========================================================
// class admin_link_manage
//=========================================================
class admin_link_menu
{
	var $_category_handler;
	var $_link_add;
	var $_link_mod;
	var $_link_del;
	var $_link_clone;
	var $_modify_new;
	var $_modify_mod;
	var $_modify_del;
	var $_modify_notify;
	var $_rssc_manage;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_link_menu()
{
	$this->_category_handler =& weblinks_get_handler( 'category', WEBLINKS_DIRNAME );
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_link_menu();
	}
	return $instance;
}

//---------------------------------------------------------
// POST param
//---------------------------------------------------------
function get_post_op()
{
	$op = 'main';
	if     ( isset($_POST['del_link']) )     $op = 'del_link';
	elseif ( isset($_POST['delete_link']) )  $op = 'del_link';
	elseif ( isset($_POST['del_form']) )     $op = 'del_form';
	elseif ( isset($_POST['refuse_new']) )   $op = 'refuse_new';
	elseif ( isset($_POST['refuse_mod']) )   $op = 'refuse_mod';
	elseif ( isset($_POST['refuse_del']) )   $op = 'refuse_del';
	elseif ( isset($_POST['clone_link']) )   $op = 'clone_link';
	elseif ( isset($_POST['clone_module']) ) $op = 'clone_module';
	elseif ( isset($_POST['ignore']) )       $op = 'ignore';
	elseif ( isset($_POST['cancel']) )       $op = 'cancel';
	elseif ( isset($_POST['op']) )           $op = $_POST['op'];
	elseif ( isset($_GET['op']) )            $op = $_GET['op'];
	return $op;
}

//---------------------------------------------------------
// init
//---------------------------------------------------------
function init()
{
	$this->_category_handler->load();
}

//---------------------------------------------------------
// add link
//---------------------------------------------------------
function _include_link_add()
{
	include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_add_handler.php';
	include_once WEBLINKS_ROOT_PATH.'/admin/link_base_class.php';
	include_once WEBLINKS_ROOT_PATH.'/admin/link_add_class.php';

	$this->_link_add =& admin_link_add::getInstance();
}

function add_form()
{
	$this->_include_link_add();
	$this->_link_add->add_form();
}

function add_link()
{
	$this->_include_link_add();
	$this->_link_add->add_link();
}

function add_banner()
{
	$this->_include_link_add();
	$this->_link_add->add_banner();
}

function update_cat_form()
{
	$this->_include_link_add();
	$this->_link_add->update_cat_form();
}

function update_cat()
{
	$this->_include_link_add();
	$this->_link_add->update_cat();
}

//---------------------------------------------------------
// mod link
//---------------------------------------------------------
function _include_link_mod()
{
	include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/pagenavi.php';
	include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/page_frame.php';
	include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_mod_handler.php';
	include_once WEBLINKS_ROOT_PATH.'/class/weblinks_votedata_handler.php';
	include_once WEBLINKS_ROOT_PATH.'/admin/link_base_class.php';
	include_once WEBLINKS_ROOT_PATH.'/admin/link_mod_class.php';
	include_once WEBLINKS_ROOT_PATH.'/admin/votedata_list_class.php';

	$this->_link_mod =& admin_link_mod::getInstance();
}

function mod_form()
{
	$this->_include_link_mod();
	$this->_link_mod->mod_form();
}

function mod_link()
{
	$this->_include_link_mod();
	$this->_link_mod->mod_link();
}

function mod_banner()
{
	$this->_include_link_mod();
	$this->_link_mod->mod_banner();
}

//---------------------------------------------------------
// del link
//---------------------------------------------------------
function _include_link_del()
{
	$this->_include_template();

	include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_del_handler.php';
	include_once WEBLINKS_ROOT_PATH.'/admin/link_base_class.php';
	include_once WEBLINKS_ROOT_PATH.'/admin/link_del_class.php';

	$this->_link_del =& admin_link_del::getInstance();
}

function _include_template()
{
// BUG : Fatal error: Undefined class name 'happy_linux_keyword' in weblinks_template.php
	include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/keyword.php';
	include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/browser.php';

	include_once WEBLINKS_ROOT_PATH.'/class/weblinks_template.php';
}

function del_form()
{
	$this->_include_link_del();
	$this->_link_del->del_form();
}

function del_link()
{
	$this->_include_link_del();
	$this->_link_del->del_link();
}

//---------------------------------------------------------
// clone link
//---------------------------------------------------------
function _include_link_clone()
{
	include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_add_handler.php';
	include_once WEBLINKS_ROOT_PATH.'/admin/link_base_class.php';
	include_once WEBLINKS_ROOT_PATH.'/admin/link_add_class.php';
	include_once WEBLINKS_ROOT_PATH.'/admin/link_clone_class.php';

	$this->_link_clone =& admin_link_clone::getInstance();
}

function clone_link()
{
	$this->_include_link_clone();
	$this->_link_clone->clone_link();
}

function clone_module()
{
	$this->_include_link_clone();
	$this->_link_clone->clone_module();
}

function clone_module_to()
{
	$this->_include_link_clone();
	$this->_link_clone->clone_module_to();
}

function clone_module_from()
{
	$this->_include_link_clone();
	$this->_link_clone->clone_module_from();
}

//---------------------------------------------------------
// rssc manage
//---------------------------------------------------------
function _include_rssc_manage()
{
	$this->_rssc_manage =& admin_rssc_manage::getInstance();
}

function add_rssc()
{
	$this->_include_rssc_manage();
	$this->_rssc_manage->add_rssc();
}

function mod_rssc()
{
	$this->_include_rssc_manage();
	$this->_rssc_manage->mod_rssc();
}

function refresh_rssc()
{
	$this->_include_rssc_manage();
	$this->_rssc_manage->refresh_link();
}

//---------------------------------------------------------
// modify new
//---------------------------------------------------------
function _include_modify_new()
{
	include_once WEBLINKS_ROOT_PATH.'/class/weblinks_modify.php';
	include_once WEBLINKS_ROOT_PATH.'/class/weblinks_modify_handler.php';
	include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_add_handler.php';
	include_once WEBLINKS_ROOT_PATH.'/admin/admin_header_mail.php';
	include_once WEBLINKS_ROOT_PATH.'/admin/link_base_class.php';
	include_once WEBLINKS_ROOT_PATH.'/admin/link_add_class.php';
	include_once WEBLINKS_ROOT_PATH.'/admin/modify_base_class.php';
	include_once WEBLINKS_ROOT_PATH.'/admin/modify_new_class.php';

	$this->_modify_new =& admin_modify_new::getInstance();
}

function list_new()
{
	$this->_include_modify_new();
	$this->_modify_new->list_new();
}

function approve_new()
{
	$this->_include_modify_new();
	$this->_modify_new->approve_new();
}

function refuse_new()
{
	$this->_include_modify_new();
	$this->_modify_new->refuse_new();
}

//---------------------------------------------------------
// modify mod
//---------------------------------------------------------
function _include_modify_mod()
{
	include_once WEBLINKS_ROOT_PATH.'/class/weblinks_modify.php';
	include_once WEBLINKS_ROOT_PATH.'/class/weblinks_modify_handler.php';
	include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_mod_handler.php';
	include_once WEBLINKS_ROOT_PATH.'/admin/admin_header_mail.php';
	include_once WEBLINKS_ROOT_PATH.'/admin/link_base_class.php';
	include_once WEBLINKS_ROOT_PATH.'/admin/link_mod_class.php';
	include_once WEBLINKS_ROOT_PATH.'/admin/modify_base_class.php';
	include_once WEBLINKS_ROOT_PATH.'/admin/modify_mod_class.php';

	$this->_modify_mod =& admin_modify_mod::getInstance();
}

function list_mod()
{
	$this->_include_modify_mod();
	$this->_modify_mod->list_mod();
}

function approve_mod()
{
	$this->_include_modify_mod();
	$this->_modify_mod->approve_mod();
}

function refuse_mod()
{
	$this->_include_modify_mod();
	$this->_modify_mod->refuse_mod();
}

//---------------------------------------------------------
// modify del
//---------------------------------------------------------
function _include_modify_del()
{
	$this->_include_template();

	include_once WEBLINKS_ROOT_PATH.'/class/weblinks_modify.php';
	include_once WEBLINKS_ROOT_PATH.'/class/weblinks_modify_handler.php';
	include_once WEBLINKS_ROOT_PATH.'/class/weblinks_link_del_handler.php';
	include_once WEBLINKS_ROOT_PATH.'/admin/admin_header_mail.php';
	include_once WEBLINKS_ROOT_PATH.'/admin/link_base_class.php';
	include_once WEBLINKS_ROOT_PATH.'/admin/link_del_class.php';
	include_once WEBLINKS_ROOT_PATH.'/admin/modify_base_class.php';
	include_once WEBLINKS_ROOT_PATH.'/admin/modify_del_class.php';

	$this->_modify_del =& admin_modify_del::getInstance();
}

function list_del()
{
	$this->_include_modify_del();
	$this->_modify_del->list_del();
}

function approve_del_confirm()
{
	$this->_include_modify_del();
	$this->_modify_del->approve_del_confirm();
}

function approve_del()
{
	$this->_include_modify_del();
	$this->_modify_del->approve_del();
}

function refuse_del()
{
	$this->_include_modify_del();
	$this->_modify_del->refuse_del();
}

//---------------------------------------------------------
// modify del
//---------------------------------------------------------
function _include_modify_notify()
{
	include_once WEBLINKS_ROOT_PATH.'/admin/modify_base_class.php';
	include_once WEBLINKS_ROOT_PATH.'/admin/modify_notify_class.php';
	include_once WEBLINKS_ROOT_PATH.'/admin/admin_header_mail.php';

	$this->_modify_notify =& admin_modify_notify::getInstance();
}

function send_approve_new()
{
	$this->_include_modify_notify();
	$this->_modify_notify->send_approve_new();
}

function send_refuse_new()
{
	$this->_include_modify_notify();
	$this->_modify_notify->send_refuse_new();
}

function send_approve_mod()
{
	$this->_include_modify_notify();
	$this->_modify_notify->send_approve_mod();
}

function send_refuse_mod()
{
	$this->_include_modify_notify();
	$this->_modify_notify->send_refuse_mod();
}

function send_approve_del()
{
	$this->_include_modify_notify();
	$this->_modify_notify->send_approve_del();
}

function send_refuse_del()
{
	$this->_include_modify_notify();
	$this->_modify_notify->send_refuse_del();
}

// --- class end ---
}

//=========================================================
// main
//=========================================================
// hack for multi site
weblinks_admin_multi_redirect_jp_site();

$manage =& admin_link_menu::getInstance();

$op = $manage->get_post_op();

// start
$manage->init();

switch ($op) 
{
case 'addLinkS':
case 'add_link':
case 'add_table':
	$manage->add_link();
	break;

case 'modLink':
case 'mod_form':
	$manage->mod_form();
	break;

case 'modLinkS':
case 'mod_link':
case 'mod_table':
	$manage->mod_link();
	break;

case 'add_banner':
	$manage->add_banner();
	break;

case 'mod_banner':
	$manage->mod_banner();
	break;

case 'del_form';
	$manage->del_form();
	break;

case 'delLink':
case 'delete_link';
case 'del_link';
case 'del_table';
	$manage->del_link();
	break;

case 'clone_link';
	$manage->clone_link();
	break;

case 'clone_module';
	$manage->clone_module();
	break;

case 'clone_module_to';
	$manage->clone_module_to();
	break;

case 'clone_module_from';
	$manage->clone_module_from();
	break;

case 'update_cat_form':
	$manage->update_cat_form();
	break;

case 'update_cat':
	$manage->update_cat();
	break;

case 'add_rssc':
	$manage->add_rssc();
	break;

case 'mod_rssc':
	$manage->mod_rssc();
	break;

case 'refresh_link':
	$manage->refresh_rssc();
	break;

case 'listNewLinks':
case 'list_new':
	$manage->list_new();
	break;

case WEBLINKS_OP_APPROVE_NEW:	// approve_new
	$manage->approve_new();
	break;

case 'delNewLink':
case 'delete_new';
case 'del_new';
case 'refuse_new';
	$manage->refuse_new();
	break;

case 'listModReq':
case 'list_mod':
	$manage->list_mod();
	break;

case WEBLINKS_OP_APPROVE_MOD:	// approve_mod
	$manage->approve_mod();
	break;

case 'ignore';
case 'ignoreModReq':
case 'del_mod':
case 'refuse_mod';
	$manage->refuse_mod();
	break;

case 'list_del':
	$manage->list_del();
	break;

case 'approve_del_confirm':
	$manage->approve_del_confirm();
	break;

case WEBLINKS_OP_APPROVE_DEL:	// approve_del
	$manage->approve_del();
	break;

case 'refuse_del';
	$manage->refuse_del();
	break;

case 'send_approve_new':
	$manage->send_approve_new();
	break;

case 'send_refuse_new':
	$manage->send_refuse_new();
	break;

case 'send_approve_mod':
	$manage->send_approve_mod();
	break;

case 'send_refuse_mod':
	$manage->send_refuse_mod();
	break;

case 'send_approve_del':
	$manage->send_approve_del();
	break;

case 'send_refuse_del':
	$manage->send_refuse_del();
	break;

case 'main':
case 'add_form':
default:
	$manage->add_form();
	break;

}

exit();
// --- end of main ---

?>