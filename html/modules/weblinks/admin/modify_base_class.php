<?php
// $Id: modify_base_class.php,v 1.1 2011/12/29 14:32:56 ohwada Exp $

// 2007-11-01 K.OHWADA
// set_edit_handler()
// set_flag_execute_time()
// WEBLINKS_OP_APPROVE_NEW

// 2007-09-20 K.OHWADA
// BUG: Use of undefined constant _AM_WEBLINKS_WAITING_DEL

// 2007-09-10 K.OHWADA
// general revision
// rename modify_manage_class -> modify_base_class
// divid to modify_new_class
// divid to modify_mod_class

// 2007-09-01 K.OHWADA
// notification to each category
// weblinks_mail_form

// 2007-07-31 K.OHWADA
// BUG 4672: cannot delete link in "New Links Waiting for Validation"

// 2007-07-19 K.OHWADA
// Fatal error: Call to undefined method weblinks_link_form_check_handler::get_error_msg_modlink()

// 2007-06-01 K.OHWADA
// BUG: forget header

// 2006-12-03 K.OHWADA
// small change _print_approve_new_preview()

// 2006-09-20 K.OHWADA
// use happy_linux
// use rssc WEBLINKS_RSSC_USE
// use XoopsGTicket

// 2006-07-01 K.OHWADA
// BUG 4085: Fatal error: Call to undefined function: weblinks_page_frame_basic()

// 2006-05-15 K.OHWADA
// new handler

// 2006-03-15 K.OHWADA
// BUG 3743: fatal error ocucred when six or more links waiting to apoval

// 2005-10-20 K.OHWADA
// REQ 3028: send apoval email to anonymous user
// add send_approved_to_anonymous()
// add send_refused_to_user() 

// 2005-09-27 K.OHWADA
// BUG 3031: timeout occurs if many waiting links
// add function list_xxx_link_xxx() print_xxx()

// 2005-01-20 K.OHWADA
// getErrorMsgAddLink

// 2004-12-14 K.OHWADA
// change caller index.php -> link_manage.php 

// 2004-10-20 K.OHWADA
// URL-less mode
// bug fix: approve notify mail dont send

//=========================================================
// admin modify
// 2006-09-01 K.OHWADA
//=========================================================

//=========================================================
// class admin_modify_base
//=========================================================
class admin_modify_base extends happy_linux_manage
{
	var $_config_handler;
	var $_edit_handler;
	var $_link_form_handler;
	var $_check_handler;
	var $_rssc_manage;
	var $_post;
	var $_mail_send;
	var $_mail_form;
	var $_mail_template;

	var $_conf;

// local
	var $_mid    = null;
	var $_lid    = null;
	var $_newid  = null;
	var $_email  = null;
	var $_uname  = null;

	var $_DEBUG_MODIFY_DELETE = true;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_modify_base()
{
	$this->happy_linux_manage( WEBLINKS_DIRNAME );
	$this->set_handler(      'modify',                WEBLINKS_DIRNAME, 'weblinks' );
	$this->set_form_handler( 'link_form_mod_approve', WEBLINKS_DIRNAME, 'weblinks' );

	$this->set_id_name( 'mid' );
	$this->set_flag_execute_time( true );

	$this->_config_handler =& weblinks_get_handler('config2_basic',   WEBLINKS_DIRNAME );
	$this->_check_handler  =& weblinks_get_handler('link_form_check', WEBLINKS_DIRNAME );
	$this->_mail_template  =& happy_linux_mail_template::getInstance( WEBLINKS_DIRNAME );
	$this->_mail_form      =& happy_linux_mail_form::getInstance();
	$this->_mail_send      =& happy_linux_mail_send::getInstance();
	$this->_post           =& happy_linux_post::getInstance();

	if ( WEBLINKS_RSSC_USE )
	{
		$this->_rssc_manage =& admin_rssc_manage::getInstance();
	}

	$this->_conf =& $this->_config_handler->get_conf();
}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_modify_base();
	}
	return $instance;
}

function set_edit_handler( $table )
{
	$this->_edit_handler =& weblinks_get_handler( $table, WEBLINKS_DIRNAME );
}

//---------------------------------------------------------
// POST param
//---------------------------------------------------------
function get_post_mid()
{
	return $this->_post->get_post_get_int('mid');
}

function get_post_lid()
{
	return $this->_post->get_post_get_int('lid');
}

function get_post_rss_flag()
{
	return $this->_post->get_post_get_int('rss_flag');
}

function get_post_skip()
{
	return $this->_post->get_post_text('skip');
}

//---------------------------------------------------------
// modify table
//---------------------------------------------------------
function _delete_modify()
{
	$ret = $this->_handler->delete( $this->_obj );
	if ( !$ret )
	{
		return $false;
	}
	return true;
}

//---------------------------------------------------------
// notification common
//---------------------------------------------------------
function _check_notification()
{
	$notify = $this->_obj->get('notify');
	$email  = $this->_get_user_email();

// has email and notify
	if ( $email && $notify ) {
		return true;
	}
	return false;
}

function _get_user_email()
{
	$email = null;
	$uname = null;

// judge base on modify record
	$uid   = $this->_obj->get('muid');
	$title = $this->_obj->get('title');
	$mail  = $this->_obj->get('mail');
	$name  = $this->_obj->get('name');

	if ( $uid )
	{
		$user  =& $this->_system->get_user_by_uid( $uid );
		$email =  isset($user['email']) ? $user['email'] : null;
		$uname =  isset($user['uname']) ? $user['uname'] : null;
	}
	else
	{
		$email = $mail;
		if ( $name ) {
			$uname = $name;
		} else {
			$uname = $title;
		}
	}

	$this->_email = $email;
	$this->_uname = $uname;

	return $email;
}

function _print_notification_form_common( $mode )
{
	$title    = null;
	$bread_op = null;
	$op       = null;
	$lid      = null;

	switch ( $mode )
	{
		case WEBLINKS_OP_APPROVE_MOD:	// approve_mod
			$title    = _WLS_MODREQUESTS;
			$bread_op = 'list_mod';
			$op       = 'send_approve_mod';
			$lid      = $this->_obj->get('lid');
			break;

		case WEBLINKS_OP_APPROVE_DEL:	// approve_del

// Use of undefined constant _AM_WEBLINKS_WAITING_DEL
			$title    = _AM_WEBLINKS_DEL_REQS;

			$bread_op = 'list_del';
			$op       = 'send_approve_del';
			$lid      = $this->_obj->get('lid');
			break;

		case 'refuse_new':
			$title    = _AM_WEBLINKS_APPROVE;
			$bread_op = 'list_new';
			$op       = 'send_refuse_new';
			break;

		case 'refuse_mod':
			$title    = _WLS_MODREQUESTS;
			$bread_op = 'list_mod';
			$op       = 'send_refuse_mod';
			break;

		case 'refuse_del':
			$title    = _AM_WEBLINKS_DEL_REQS;
			$bread_op = 'list_del';
			$op       = 'send_refuse_del';
			break;

		case WEBLINKS_OP_APPROVE_NEW:	// approve_new
		default:
			$title    = _AM_WEBLINKS_APPROVE;
			$bread_op = 'list_new';
			$op       = 'send_approve_new';
			$lid      = $this->_newid;
			break;
	}

	list($subject, $body) = $this->_build_subject_body_common( $mode );

// new value for rssc
	$hidden_list = array(
		'lid'      => $lid,
		'title'    => $this->_post->get_post_text('title'),
		'url'      => $this->_post->get_post_url('url'),
		'rss_url'  => $this->_post->get_post_url('rss_url'),
		'rss_flag' => $this->_post->get_post_int('rss_flag'),
	);

	$param = array(
		'op'          => $op,
		'users_label' => $this->_mail_form->build_to_email_input( $this->_email ),
		'subject'     => $subject,
		'body'        => $body,
		'body_rows'   => 20,
		'hidden_list' => $hidden_list,
		'flag_skip'   => true,
	);

	$this->_print_cp_header();
	$this->_print_bread_op( $title, $bread_op );
	echo "<br /><br />\n";
	$this->_mail_form->print_form( $param );
	$this->_print_cp_footer();
}

function _build_subject_body_common( $mode )
{
	switch ( $mode )
	{
		case WEBLINKS_OP_APPROVE_MOD:	// approve_mod
			$template    =  'link_mod_approve_notify.tpl';
			$subject_org =  _AM_WEBLINKS_SUBJ_LINK_MOD_APPROVED;
			$tags        =& $this->_build_tags_approve_mod();
			break;

		case WEBLINKS_OP_APPROVE_DEL:	// approve_del
			$template    =  'link_del_approve_notify.tpl';
			$subject_org =  _AM_WEBLINKS_SUBJ_LINK_DEL_APPROVED;
			$tags        =& $this->_build_tags_approve_del();
			break;

		case 'refuse_new':
			$template    =  'link_refused_notify.tpl';
			$subject_org =  _WEBLINKS_LINK_REFUSED;
			$tags        =& $this->_build_tags_refuse_new();
			break;

		case 'refuse_mod':
			$template    =  'link_mod_refuse_notify.tpl';
			$subject_org =  _AM_WEBLINKS_SUBJ_LINK_MOD_REFUSED;
			$tags        =& $this->_build_tags_refuse_mod();
			break;

		case 'refuse_del':
			$template    =  'link_del_refuse_notify.tpl';
			$subject_org =  _AM_WEBLINKS_SUBJ_LINK_DEL_REFUSED;
			$tags        =& $this->_build_tags_refuse_del();
			break;

		case WEBLINKS_OP_APPROVE_NEW:	// approve_new
		default:
			$template    =  'link_approve_notify.tpl';
			$subject_org =  _WEBLINKS_LINK_APPROVED;
			$tags        =& $this->_build_tags_approve_new();
			break;
	}

	$this->_mail_template->init_tags();
	$this->_mail_template->merge_tags( $tags );
	$this->_mail_template->assign( 'X_UNAME', $this->_uname );
	$body    = $this->_mail_template->replace_tags_by_template( $template );
	$subject = $this->_mail_template->replace_tags( $subject_org );

	return array($subject, $body);
}

function &_build_tags_approve_new()
{
	$tags = array();
	$tags['LINK_NAME'] = $this->_post->get_post_text('title');
	$tags['LINK_URL']  = $this->_build_singlelink( $this->_newid );
	return $tags;
}

function &_build_tags_approve_mod()
{
	$tags = array();
	$tags['LINK_NAME'] = $this->_post->get_post_text('title');
	$tags['LINK_URL']  = $this->_build_singlelink( $this->_obj->get('lid') );
	return $tags;
}

function &_build_tags_approve_del()
{
	$tags = array();
	$tags['SITE_NAME'] = $this->_obj->get('title');
	$tags['SITE_URL']  = $this->_obj->get('url');
	return $tags;
}

function &_build_tags_refuse_new()
{
	$tags = array();
	$tags['SITE_NAME'] = $this->_obj->get('title');
	$tags['SITE_URL']  = $this->_obj->get('url');
	return $tags;
}

function &_build_tags_refuse_mod()
{
	$tags = array();
	$tags['LINK_NAME'] = $this->_obj->get('title');
	$tags['LINK_URL']  = $this->_build_singlelink( $this->_obj->get('lid') );
	return $tags;
}

function &_build_tags_refuse_del()
{
	$tags = array();
	$tags['LINK_NAME'] = $this->_obj->get('title');
	$tags['LINK_URL']  = $this->_build_singlelink( $this->_obj->get('lid') );
	return $tags;
}

function &_build_singlelink( $lid )
{
	$text = XOOPS_URL .'/modules/'. $this->_DIRNAME . '/singlelink.php?lid=' . $lid;
	return $text;
}

//---------------------------------------------------------
// redirect URL
//---------------------------------------------------------
function _get_redirect_at_new()
{
	$total = $this->_handler->get_count_new();
	$ret   = $this->_get_redirect_common( $total, 'list_new' );
	return $ret;
}

function _get_redirect_at_mod()
{
	$total = $this->_handler->get_count_mod();
	$ret   = $this->_get_redirect_common( $total, 'list_mod' );
	return $ret;
}

function _get_redirect_at_del()
{
	$total = $this->_handler->get_count_del();
	$ret   = $this->_get_redirect_common( $total, 'list_del' );
	return $ret;
}

function _get_redirect_common( $total, $op )
{
	$ret = 'link_list.php';
	if ($total > 0)
	{
		$ret  = 'link_manage.php?op='. $op;
		$ret .= $this->_get_redirect_by_mid();
	}
	return $ret;
}

function _get_redirect_by_mid()
{
	$mid = $this->get_post_mid();
	$ret = '';
	$obj =& $this->_handler->get( $mid );
	if ( is_object($obj) )
	{
		$ret = '&amp;mid='.$mid;
	}
	return $ret;
}

//---------------------------------------------------------
// edit_handler
//---------------------------------------------------------
function build_comment( $msg )
{
	return $this->_edit_handler->build_comment( $msg );
}

//---------------------------------------------------------
// private print
//---------------------------------------------------------
function _print_menu()
{
	weblinks_admin_print_header();
	weblinks_admin_print_menu();
}

// --- class end ---
}

?>