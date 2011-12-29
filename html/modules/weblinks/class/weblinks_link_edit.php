<?php
// $Id: weblinks_link_edit.php,v 1.1 2011/12/29 14:33:04 ohwada Exp $

// 2007-10-30 K.OHWADA
// weblinks_auth

// 2007-09-20 K.OHWADA
// rssc_lid_flag_update

// 2007-09-10 K.OHWADA
// show notify in build_modify()
// BUG: not show rss_opt in modify preview
// BUG: show usercomment if not owner

// 2007-03-01 K.OHWADA
// divid from weblinks_link_view_edit

//=========================================================
// WebLinks Module
// 2007-03-01 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('weblinks_link_edit') ) 
{

//=========================================================
// class weblinks_link_edit
//=========================================================
class weblinks_link_edit extends happy_linux_basic
{
	var $_DIRNAME;

// class
	var $_config_handler;
	var $_link_handler;
	var $_catlink_handler;
	var $_link_view;
	var $_auth;
	var $_rssc_handler;

	var $_system;
	var $_post;

	var $_link_obj;

// conf
	var $_conf_desc_option;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_link_edit( $dirname )
{
	$this->happy_linux_basic();

	$this->_DIRNAME = $dirname;

	$this->_config_handler  =& weblinks_get_handler('config2_basic',  $dirname );
	$this->_link_handler    =& weblinks_get_handler('link',           $dirname );
	$this->_catlink_handler =& weblinks_get_handler('catlink',        $dirname );
	$this->_link_view       =& weblinks_link_view::getInstance( $dirname );
	$this->_auth            =& weblinks_auth::getInstance( $dirname );
	$this->_rssc_handler    =& weblinks_get_handler('rssc',          $dirname );

	$this->_system =& happy_linux_system::getInstance();
	$this->_post   =& happy_linux_post::getInstance();

	$this->_conf_desc_option = $this->_auth->has_auth_desc_option();

}

//---------------------------------------------------------
// set object
//---------------------------------------------------------
function set_object( &$obj )
{
	$this->_link_obj =& $obj;
}

//---------------------------------------------------------
// submit
//---------------------------------------------------------
function build_submit()
{
	$link_obj =& $this->_link_handler->create();
	$this->set_object($link_obj);
	$this->set_vars( $link_obj->getVarAll('s') );

// user param
	$user = $this->_system->get_user_param();
	$this->set('uid',   $user['uid'] );
	$this->set('name',  $user['uname'] );
	$this->set('mail',  $user['email'] );

	$this->build_submit_cid_arr();
	$this->set('notify', 1);
	$this->build_password_by_post();
	$this->build_submit_rss_url();
	$this->build_rss_opt();
}

function build_submit_cid_arr()
{
	$cid_arr = array();
	if ( isset($_GET['cid']) )
	{
		$cid_arr = array($_GET['cid']);
	}
	$this->set('cid_arr', $cid_arr);
}

function build_submit_rss_url()
{
	$rss_flag  = 0;
	if ( WEBLINKS_RSSC_USE ) {
		$rss_flag = $this->_rssc_handler->get_rss_flag_default();
	}

	$this->set('rss_url',  '');
	$this->set('rss_flag', $rss_flag);

}

function build_rss_opt()
{
	$rss_opt  = array();
	if ( WEBLINKS_RSSC_USE ) {
		$rss_opt = $this->_rssc_handler->get_rss_opt();
	}
	$this->set('rss_opt', $rss_opt);
}

function build_password_by_post()
{
	$passwd_new = $this->_post->get_post_text('passwd_new');
	$passwd_2   = $this->_post->get_post_text('passwd_2');

	list($passwd_old, $flag_passwd, $flag_code)
		= $this->_post->get_post_get_passwd_old();

	$this->set('passwd_new',  $passwd_new);
	$this->set('passwd_2',    $passwd_2);
	$this->set('passwd_old',  $passwd_old);
}

//---------------------------------------------------------
// submit preview
//---------------------------------------------------------
function build_submit_preview()
{
	$link_obj =& $this->_link_handler->create();
	$this->set_object($link_obj);

	$this->build_preview_by_post();
	$this->build_password_by_post();
	$this->build_rss_url_by_post();
}

function build_preview_by_post()
{
	$save_obj =& new weblinks_link_save( $this->_DIRNAME );
	$save_obj->assign_add_object( $_POST );
	$this->set_vars( $save_obj->getVarAll('f') );
	$this->set('cid_arr',  $save_obj->get_cid_array() );
	$this->set('notify',   $this->_post->get_post_int('notify') );

// BUG: not show rss_opt in modify preview
	$this->build_rss_opt();
}

function build_rss_url_by_post()
{
	$rss_flag = $this->_post->get_post_int('rss_flag');
	$rss_url  = $this->_post->get_post_url('rss_url');
	$rss_url  = $this->sanitize_url($rss_url);

	$this->set('rss_flag', $rss_flag );
	$this->set('rss_url',  $rss_url );

}

//---------------------------------------------------------
// admin modify
//---------------------------------------------------------
function build_modify($lid, $flag_owner=false)
{
	$this->set_vars( $this->_link_obj->getVarAll('e') );

// hidden value, when NOT owner
	if ( !$flag_owner )
	{
		$this->build_name_edit_for_others();
		$this->build_mail_edit_for_others();
		$this->build_usercomment_edit_for_others();
	}

	$this->build_modify_cid_arr_by_lid($lid);
	$this->set('notify', 1);
	$this->build_password_by_post();
	$this->build_modify_rss_url();
	$this->build_rss_opt();

}

function build_name_edit_for_others()
{
	$nameflag = $this->_link_obj->get('nameflag');

	$name_edit     = '';
	$nameflag_edit = 0;

	if ($nameflag == 1)
	{
		$name_edit     = $this->_link_obj->getVar('name');
		$nameflag_edit = 1;
	}

// Notice [PHP]: Undefined variable: name
	$this->set('name',     $name_edit);
	$this->set('nameflag', $nameflag_edit);
}

// Fatal error: Call to undefined method weblinks_link_edit::build_mail_edit_for_others()
function build_mail_edit_for_others()
{
	$mailflag = $this->_link_obj->get('mailflag');

	$mail_edit     = '';
	$mailflag_edit = 0;

	if ($mailflag == 1)
	{
		$mail_edit     =  $this->_link_obj->getVar('mail');
		$mailflag_edit = 1;
	}

// Notice [PHP]: Undefined variable: mail
	$this->set('mail',     $mail_edit);
	$this->set('mailflag', $mailflag_edit);
}

// BUG: show usercomment if not owner
function build_usercomment_edit_for_others()
{
	$this->set('usercomment', '');
}

function build_modify_cid_arr_by_lid($lid)
{
	$cid_arr   = $this->_catlink_handler->get_cid_array_by_lid($lid);
	$this->set('cid_arr', $cid_arr);
}

function build_modify_rss_url()
{
	$rssc_lid = $this->_link_obj->get('rssc_lid');
	list($flag, $url, $url_s) = 
		$this->_link_view->build_rss_url_by_rssc_lid( $rssc_lid );

	$this->set('rss_flag',   $flag);
	$this->set('rss_url',    $url );
	$this->set('rss_url_s',  $url_s );

}

//---------------------------------------------------------
// modify preview
//---------------------------------------------------------
function build_modify_preview()
{
	$this->build_preview_by_post();
	$this->build_password_by_post();
	$this->build_rss_url_by_post();
}

//---------------------------------------------------------
// admin submit
//---------------------------------------------------------
function build_admin_submit()
{
	$this->build_submit();
}

//---------------------------------------------------------
// admin submit preview
//---------------------------------------------------------
function build_admin_submit_preview()
{
	$link_obj =& $this->_link_handler->create();
	$this->set_object($link_obj);
	$this->build_admin_preview_by_post();

	$this->build_rss_url_by_post();
}

function build_admin_preview_by_post()
{
	$this->build_preview_by_post();
	$this->build_desc_disp();
	$this->set('time_update_flag_update', $this->_post->get_post_int('time_update_flag_update') );
	$this->set('rssc_lid_flag_update',    $this->_post->get_post_int('rssc_lid_flag_update') );
	$this->set('rssc_lid',                $this->_post->get_post_int('rssc_lid') );
}

function build_desc_disp()
{
	$this->set('description_disp',  $this->_link_obj->description_disp() );
	$this->set('textarea1_disp',    $this->_link_obj->textarea1_disp() );
	$this->set('textarea2_disp',    $this->_link_obj->textarea2_disp() );
}

//---------------------------------------------------------
// admin modify
//---------------------------------------------------------
function build_admin_modify($lid)
{
	$this->set_vars( $this->_link_obj->getVarAll('e') );

	$this->build_desc_disp();
	$this->build_modify_cid_arr_by_lid($lid);
	$this->set('time_update_flag_update', 0);

	$this->build_modify_rss_url();
	$this->build_rss_opt();

}

//---------------------------------------------------------
// admin modify preview
//---------------------------------------------------------
function build_admin_modify_preview()
{
	$this->build_admin_preview_by_post();
	$this->build_admin_modify_preview_uid();
}

function build_admin_modify_preview_uid()
{
	if ( $muid = $this->_link_obj->is_set('muid') )
	{
		$muid = $this->_link_obj->get('muid');
		$this->set('uid', $muid);
	}
}

//---------------------------------------------------------
// admin approve
//---------------------------------------------------------
function build_admin_approve()
{
	$this->set_vars( $this->_link_obj->getVarAll('e') );

	$this->build_admin_approve_cid_arr();
	$this->build_admin_approve_uid();

	$this->set('time_update_flag_update', 1);
	$this->set('approve',    1);

	$this->build_rss_opt();
}

function build_admin_approve_cid_arr()
{
	$cid_arr =& $this->_link_obj->cid_array();
	$this->set('cid_arr', $cid_arr);
}

function build_admin_approve_uid()
{
	$muid = $this->_link_obj->get('muid');
	$this->set('uid', $muid);
}

//---------------------------------------------------------
// admin approve preview
//---------------------------------------------------------
function build_admin_approve_preview()
{
	$this->build_admin_preview_by_post();
	$this->set('approve', 1);
}

//---------------------------------------------------------
// admin approve modify
//---------------------------------------------------------
function build_admin_approve_modify()
{
	$this->set_vars( $this->_link_obj->getVarAll('e') );

	$this->build_desc_disp();
	$this->build_admin_approve_cid_arr();
	$this->build_admin_approve_uid();

	$this->set('time_update_flag_update', 1);
	$this->set('approve',    1);

	$this->build_rss_opt();
}

//---------------------------------------------------------
// admin approve modify preview
//---------------------------------------------------------
function build_admin_approve_modify_preview()
{
	$this->build_admin_preview_by_post();
	$this->set('approve', 1);
}

//---------------------------------------------------------
// build_preview
//---------------------------------------------------------
function build_preview_for_template( $cid_arr )
{
	$this->_link_view->set_vars( $this->_link_obj->getVarAll() );
	$this->_link_view->build_show();
	$arr =& $this->_link_view->get_vars();

	list($show_catpaths, $catpaths) =
		$this->_link_view->build_catpaths_by_cid_array( $cid_arr );

// set value
	$this->set_vars( $arr );
	$this->set('show_catpaths', $show_catpaths);
	$this->set('catpaths',      $catpaths);

// dont show
	$this->set('mail_subject', '');
	$this->set('mail_body',    '');
	$this->set('name',         '');
	$this->set('mail',         '');
	$this->set('passwd',       '');
	$this->set('search',       '');
	$this->set('rss_xml',      '');
	$this->set('usercomment',  '');
}

// --- class end ---
}

// === class end ===
}

?>