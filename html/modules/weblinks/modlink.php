<?php
// $Id: modlink.php,v 1.1 2011/12/29 14:32:28 ohwada Exp $

// 2007-11-01 K.OHWADA
// BUG: no action when click modify
// change check_access()
// get_token_pair()
// happy_linux_get_memory_usage_mb()

// 2007-09-20 K.OHWADA
// PHP5.2
// getInstance()
// use set_flag_auth_modify_auto()

// 2007-09-10 K.OHWADA
// general revision
// user can delete link

// 2007-08-25 K.OHWADA
// modify_list.php?sortid=2 -> link_manage.php?op=list_mod

// 2007-08-01 K.OHWADA
// weblinks_header
// index.php?op=listModReq -> modify_list.php?sortid=2

// 2007-06-18 K.OHWADA
// header_oh.php
// add WEBLINKS_URL in redirect_header

// 2007-05-18 K.OHWADA
// get_error_msg_modlink() -> get_errors_modlink()

// 2007-03-01 K.OHWADA
// weblinks_link_handler.php
// update_category_link_count()

// 2006-12-10 K.OHWADA
// use weblinks_modify

// 2006-09-20 K.OHWADA
// use happy_linux
// use rssc WEBLINKS_RSSC_USE

// 2006-05-15 K.OHWADA
// add class weblinks_modlink()
// new handler
// use token ticket
// dont use global

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication

//================================================================
// WebLinks Module
// 2004/01/23 K.OHWADA
//================================================================

include 'header_edit.php';

//=========================================================
// class weblinks_modlink
//=========================================================
class weblinks_modlink extends happy_linux_error
{
	var $_config_handler;
	var $_link_edit_handler;
	var $_link_form_handler;
	var $_link_check_handler;

	var $_auth;
	var $_header;
	var $_template;
	var $_system;
	var $_post;

// config
	var $_conf;

// system
	var $_system_is_module_admin;
	var $_system_is_user;
	var $_system_uid;
	var $_system_module_name;

	var $_auth_param             = null;
	var $_has_auth_modify_permit = false;
	var $_has_auth_modify_auto   = false;
	var $_has_auth_delete_permit = false;
	var $_is_owner               = false;
	var $_flag_passwd_incorrect  = false;

// link record
	var $_lid;
	var $_link_title_s;

// error
	var $_banner_error_code = 0;
	var $_rssc_error_code   = 0;
	var $_flag_error        = 0;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_modlink( $dirname )
{
	$this->happy_linux_error();
	$this->set_debug_print_error( WEBLINKS_DEBUG_ERROR );

	$this->_config_handler     =& weblinks_get_handler( 'config2_basic',   $dirname );
	$this->_link_edit_handler  =& weblinks_get_handler( 'link_edit',       $dirname );
	$this->_link_form_handler  =& weblinks_get_handler( 'link_form',       $dirname );
	$this->_link_check_handler =& weblinks_get_handler( 'link_form_check', $dirname );

	$this->_auth     =& weblinks_auth::getInstance(     $dirname );
	$this->_header   =& weblinks_header::getInstance(   $dirname );
	$this->_template =& weblinks_template::getInstance( $dirname );
	$this->_system   =& happy_linux_system::getInstance();
	$this->_post     =& happy_linux_post::getInstance();

	$this->_conf = $this->_config_handler->get_conf();

	$this->_system_is_module_admin = $this->_system->is_module_admin();
	$this->_system_is_user         = $this->_system->is_user();
	$this->_system_uid             = $this->_system->get_uid();
	$this->_system_module_name     = $this->_system->get_module_name();

}

function &getInstance( $dirname )
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new weblinks_modlink( $dirname );
	}
	return $instance;
}

//---------------------------------------------------------
// init & get obj
//---------------------------------------------------------
function get_post_op()
{
	$op = '';
	if     (isset($_POST['submit']))          $op = 'submit';
	elseif (isset($_POST['preview']))         $op = 'preview';
	elseif (isset($_POST['delete']))          $op = 'delete';
	elseif (isset($_POST['confirm_submit']))  $op = 'delete';
	elseif (isset($_POST['op']))              $op = $_POST['op'];

	return $op;
}

function get_post_get_lid()
{
	$this->_lid = $this->_post->get_post_get_int('lid');
	return $this->_lid;
}

//---------------------------------------------------------
// check_access
//---------------------------------------------------------
function check_access()
{

// admin
	if ( $this->_system_is_module_admin )
	{
		return 'goto_admin';
	}

	$obj =& $this->_link_edit_handler->get($this->_lid);

	if ( !is_object($obj) )
	{
		return 'no_record';
	}

	$this->_link_title_s = $obj->getVar('title', 's');
	$rec_uid             = $obj->get('uid');
	$rec_passwd          = $obj->get('passwd');

// check publish
	if ( !$this->_system->is_user( $rec_uid ) &&
		( $obj->is_warn_time_publish() || $obj->is_warn_time_expire() ) )
	{
		return 'not_publish';
	}

	$auth =& $this->_auth->get_auth_modify( $rec_uid, $rec_passwd );
	$this->_auth_param             =& $auth;
	$this->_has_auth_modify_permit =  $auth['has_auth_modify_permit'];
	$this->_has_auth_modify_auto   =  $auth['has_auth_modify_auto'];
	$this->_has_auth_delete_permit =  $auth['has_auth_delete_permit'];
	$this->_is_owner               =  $auth['is_owner'];
	$this->_flag_passwd_incorrect  =  $auth['flag_passwd_incorrect'];
	$code                          =  $auth['code'];

	if ( $code == 'permit' ) 
	{
		$this->_link_edit_handler->init();
	}

	return $code;
}

//---------------------------------------------------------
// modify_form
//---------------------------------------------------------
function print_modify_form()
{
	$this->print_modify_header();
	$this->print_modify_comment();

	$this->show_user_form( 'modify', $this->_lid );
}

function show_user_form( $form_mode, $lid )
{
// show notify for user, no action for guest
	$mode_notify = 0;
	if ( !$this->_has_auth_modify_auto && $this->_system_is_user ) 
	{
		$mode_notify = 2;
	}

	$this->_link_form_handler->set_mode_notify( $mode_notify );
	$this->_link_form_handler->set_flag_owner( $this->_is_owner );
	$this->_link_form_handler->set_flag_auth_modify_auto( $this->_has_auth_modify_auto );
	$this->_link_form_handler->set_flag_button_del( $this->_has_auth_delete_permit );
	$this->_link_form_handler->show_user_form( $form_mode, $lid );
}

//---------------------------------------------------------
// preview
//---------------------------------------------------------
function print_preview()
{
	$this->print_modify_header();
	echo "<hr />\n";
	echo "<h4>"._PREVIEW."</h4>\n";

// check form
	if ( !$this->_link_check_handler->check_form_modlink_by_post( $this->_is_owner, $this->_has_auth_modify_auto ) ) 
	{
		echo '<div class="weblinks_submit_error">';
		echo $this->_link_check_handler->get_errors_modlink('s');
		echo "</div>\n";
		echo "<br />\n";
    }

	$arr_preview = $this->_link_edit_handler->build_modify_preview( $this->_lid );

// check preview error
	if ( !$this->_link_edit_handler->check_preview_result() )
	{
		echo $this->_link_edit_handler->get_error_msg_preview();
		echo "<br />\n";
	}

	echo $this->_template->fetch_link_single( $arr_preview );

	echo "<hr />\n";
	$this->print_modify_comment();

	$this->show_user_form('modify_preview', $this->_lid);

}

//---------------------------------------------------------
// del form
//---------------------------------------------------------
function check_show_del_confirm_form()
{
	if ( $this->_post->get_post_int('confirm') )
	{
		return false;
	}
	return true;
}

function print_del_confirm_form()
{
	$this->print_modify_header();
	echo $this->_link_edit_handler->build_show_link( $this->_lid );
	$this->_link_form_handler->show_del_confirm_form( $this->_lid );
}

function check_show_del_reason_form()
{
	if ( $this->_post->get_post_text('reason') )
	{
		return false;
	}
	return true;
}

function print_del_reason_form()
{
	$this->print_modify_header();
	echo $this->_link_edit_handler->build_show_link( $this->_lid );
	echo "<br />\n";

	if ( $this->_post->get_post_int('confirm') )
	{
		echo '<div class="weblinks_submit_error">';
		echo sprintf( _WLS_ERROR_FILL, _WEBLINKS_DEL_LINK_REASON );
		echo "</div>\n";
		echo "<br />\n";
	}

	$this->_link_form_handler->show_del_reason_form( $this->_lid );
}

//---------------------------------------------------------
// modify
//---------------------------------------------------------
function check_form()
{
	$this->_flag_error = 0;
	if( !$this->_link_edit_handler->check_token() ) 
	{
		$this->_flag_error = 1;
		return false;
	}
	if ( !$this->_link_check_handler->check_form_modlink_by_post( $this->_is_owner, $this->_has_auth_modify_auto ) )
	{
		$this->_flag_error = 2;
		return false;
	}
	return true;
}

function print_form_with_error()
{
	$this->print_modify_header();

	if ( $this->_flag_error == 1 )
	{
		echo "<br />\n";
		xoops_error( "Token Error" );
		echo "<br />\n";
	}

	if ( $this->_flag_error == 2 )
	{
		echo '<div class="weblinks_submit_error">';
		echo $this->_link_check_handler->get_errors_modlink('s');
		echo "</div>\n";
		echo "<br />\n";
	}

	$this->print_modify_comment();

	$this->show_user_form('modify_preview', $this->_lid);
}

function modify_auto_approve()
{
	$ret = $this->_link_edit_handler->user_mod_link( $this->_lid );
	if ( !$ret )
	{
		$this->_set_errors( $this->_link_edit_handler->getErrors() );
		return false;
	}
	$this->_banner_error_code = $this->_link_edit_handler->get_banner_error_code();
	$this->_rssc_error_code   = $this->_link_edit_handler->get_rssc_error_code();
	return true;
}

function modify_admin_approve()
{
	$newid = $this->_link_edit_handler->user_modify_admin_approve();
	if ( !$newid )
	{
		$this->_set_errors( $this->_link_edit_handler->getErrors() );
		return false;
	}
	return $newid;
}

//---------------------------------------------------------
// delete
//---------------------------------------------------------
function delete_auto_approve()
{
	$ret = $this->_link_edit_handler->user_del_link( $this->_lid );
	if ( !$ret )
	{
		$this->_set_errors( $this->_link_edit_handler->getErrors() );
		return false;
	}
	return true;
}

function delete_admin_approve()
{
	$newid = $this->_link_edit_handler->user_delete_admin_approve();
	if ( !$newid )
	{
		$this->_set_errors( $this->_link_edit_handler->getErrors() );
		return false;
	}
	return $newid;
}

//---------------------------------------------------------
// print
//---------------------------------------------------------
function print_modify_header()
{
	$this->_header->assign_module_header_submit();

	echo $this->_header->get_module_header_submit();
	echo '&nbsp;';
	echo '<a href="'.XOOPS_URL.'/">'._HAPPY_LINUX_HOME.'</a> &gt;&gt;';
	echo '<a href="'.WEBLINKS_URL.'/">'.$this->_system_module_name.'</a> &gt;&gt;';
	echo '<a href="'.WEBLINKS_URL.'/singlelink.php?lid='.$this->_lid.'">'.$this->_link_title_s.'</a> &gt;&gt;';
	echo '<span class="weblinks_bold">'._WLS_MODIFY.'</span><br /><br />'."\n";
}

function print_modify_comment()
{
	echo '<div style="width: 100%; margin: 5px; padding: 5px;">'."\n";

	echo $this->_conf['modlink_main'];
	if ( !$this->_has_auth_modify_auto )
	{
		echo $this->_conf['modlink_pending'];
		if ( !$this->_is_owner )
		{
			echo $this->_conf['modlink_not_owner'];
		}
	}

	echo "</div><br />\n";
}

//---------------------------------------------------------
// get parameter
//---------------------------------------------------------
function &get_auth_param()
{
	return $this->_auth_param;
}

//---------------------------------------------------------
// get_mod_link_msg
//---------------------------------------------------------
function get_mod_link_msg()
{
	$msg = '';

	if ( $this->_banner_error_code )
	{
		$msg .= _WEBLINKS_WARN_BANNER_NOT_GET_SIZE."<br />\n";
	}

	switch ( $this->_rssc_error_code )
	{
		case RSSC_CODE_DISCOVER_FAILED:
			$msg .= _RSSC_DISCOVER_FAILED."<br />\n";
			break;

		case RSSC_CODE_PARSE_FAILED:
			$msg .= _RSSC_PARSE_FAILED."<br />\n";
			break;

		case RSSC_CODE_PARSE_NOT_READ_XML_URL:
			$msg .= _RSSC_PARSE_NOT_READ_XML_URL."<br />\n";
			break;
	}

	return $msg;
}

//---------------------------------------------------------
// utility
//---------------------------------------------------------
function build_comment($str)
{
	return $this->_link_edit_handler->build_comment($str);
}

//---------------------------------------------------------
// password form
//---------------------------------------------------------
function print_form_password()
{
	global $xoopsTpl, $xoopsConfig;

	list($token_name, $token_value) = $this->_link_edit_handler->get_token_pair();

	$weblinks_template =& weblinks_template::getInstance( WEBLINKS_DIRNAME );
	$weblinks_header   =& weblinks_header::getInstance(   WEBLINKS_DIRNAME );

	$weblinks_header->assign_module_header();
	$weblinks_template->assignIndex();

	$xoopsTpl->assign('lang_requestmod',      _WLS_REQUESTMOD);
	$xoopsTpl->assign('lang_password',        _US_PASSWORD);
	$xoopsTpl->assign('lang_submitter',       _WLS_LINKSUBMITTER);
	$xoopsTpl->assign('lang_pleasepassword',  _WLS_PLEASEPASSWORD);
	$xoopsTpl->assign('lang_registered_dsc',  _WLS_REGSTERED_DSC);
	$xoopsTpl->assign('lang_lostpassword',    _US_LOSTPASSWORD);
	$xoopsTpl->assign('lang_noproblem',       _US_NOPROBLEM);
	$xoopsTpl->assign('lang_youremail',       _US_YOUREMAIL);
	$xoopsTpl->assign('lang_sendpassword',    _US_SENDPASSWORD);
	$xoopsTpl->assign('lang_modify',          _WLS_MODIFY);
	$xoopsTpl->assign('lang_cancel',          _CANCEL);
	$xoopsTpl->assign('lang_password_incorrect',  _WEBLINKS_PASSWORD_INCORRECT);
	$xoopsTpl->assign('lang_anonymous',       $xoopsConfig['anonymous'] );
	$xoopsTpl->assign('lid',            $this->_lid );
	$xoopsTpl->assign('link_title',     $this->_link_title_s );
	$xoopsTpl->assign('incorrect_show', $this->_flag_passwd_incorrect );
	$xoopsTpl->assign('request_show',   $this->_has_auth_modify_permit );
	$xoopsTpl->assign('token_name',     $token_name );
	$xoopsTpl->assign('token_value',    $token_value );
}

// --- class end ---
}


//=========================================================
// main
//=========================================================
$weblinks_modlink =& weblinks_modlink::getInstance( WEBLINKS_DIRNAME );

$url_index = WEBLINKS_URL . '/index.php';

// start
$op  = $weblinks_modlink->get_post_op();
$lid = $weblinks_modlink->get_post_get_lid();

// check permit
$check = $weblinks_modlink->check_access();

if ( $check == 'not_permit' ) 
{
	$msg  = _NOPERM;
	$msg .= $weblinks_modlink->build_comment("not permit");	// for test form
	redirect_header( $url_index, 2, $msg);
	exit();
}

if ( $check == 'show_login' ) 
{
	$msg  = _WLS_MUSTREGFIRST;
	$msg .= $weblinks_modlink->build_comment("not user");	// for test form
	redirect_header( XOOPS_URL.'/user.php', 2, $msg);
	exit();
}

if ( $check == 'no_record' ) 
{
	redirect_header( $url_index, 2, _WLS_NOMATCH);
	exit();
}

if ( $check == 'not_publish' ) 
{
	redirect_header('index.php', 2, _WLS_NOMATCH);
	exit();
}

if ( $check == 'goto_admin' )
{
// add WEBLINKS_URL
	$url = WEBLINKS_URL. '/admin/link_manage.php?op=modLink&amp;lid='. $lid;
	redirect_header($url, 2, _WLS_GOTOADMIN);	
	exit();
}

$auth_arr =& $weblinks_modlink->get_auth_param();
$is_owner               = $auth_arr['is_owner'];
$has_auth_modify_permit = $auth_arr['has_auth_modify_permit'];
$has_auth_modify_auto   = $auth_arr['has_auth_modify_auto'];
$has_auth_delete_permit = $auth_arr['has_auth_delete_permit'];
$has_auth_delete_auto   = $auth_arr['has_auth_delete_auto'];
$flag_passwd_incorrect  = $auth_arr['flag_passwd_incorrect'];

if ( $check == 'show_password' )
{
	$xoopsOption['template_main'] = WEBLINKS_DIRNAME."_passwd.html";
	include XOOPS_ROOT_PATH."/header.php";
	$weblinks_modlink->print_form_password();
	include XOOPS_ROOT_PATH.'/footer.php';
	exit();
}

$url_singlelink = WEBLINKS_URL .'/singlelink.php?lid='. $lid;

// save to DB
if ($op == 'submit') 
{
	if ( !$weblinks_modlink->check_form() ) 
	{
		include XOOPS_ROOT_PATH."/header.php";
		$weblinks_modlink->print_form_with_error();
		include XOOPS_ROOT_PATH.'/footer.php';
		exit();
    }

// auto modify approve
	if ( $has_auth_modify_auto )
	{
		$ret = $weblinks_modlink->modify_auto_approve();
		if (!$ret)
		{
			redirect_header($url_singlelink, 3, "DB Error");
			exit();
		}

// redirect to single link
		$msg  = _WLS_MODIFYAPPROVED . "<br />\n";
		$msg2 = $weblinks_modlink->get_mod_link_msg();
		$time = $happy_linux_time->get_elapse_time();
		if ( $msg2 )
		{
			$msg .= "<br />\n";
			$msg .= "$msg2 <br />\n";
			$msg .= "$time sec";
			redirect_header($url_singlelink, 3, $msg);
		}

		$msg .= "$time sec <br />\n";
		$msg .= $weblinks_modlink->build_comment("modify approve link");	// for test form
		redirect_header($url_singlelink, 2, $msg);
		exit();
	}

// modify approve
	else
	{
		$modify_newid = $weblinks_modlink->modify_admin_approve();
		if ( !$modify_newid )
		{
			redirect_header($url_singlelink, 3, "DB Error");
			exit();
		}

		$com  = 'modify request link [' . $modify_newid . ']';
		$msg  = _WLS_THANKSFORINFO;
		$msg .= $weblinks_modlink->build_comment( $com );	// for test form
		redirect_header( $url_singlelink, 2, $msg );
		exit();
	}
}

elseif ($op == 'delete')
{
	if ( !$has_auth_delete_permit )
	{
		$msg  = _NOPERM;
		$msg .= $weblinks_modlink->build_comment("not permit");	// for test form
		redirect_header( $url_singlelink, 2, $msg);
		exit();
	}

// auto modify approve
	if ( $has_auth_delete_auto )
	{
		if ( $weblinks_modlink->check_show_del_confirm_form() )
		{
			include XOOPS_ROOT_PATH."/header.php";
			$weblinks_modlink->print_del_confirm_form();
			include XOOPS_ROOT_PATH.'/footer.php';
			exit();
		}

		$ret = $weblinks_modlink->delete_auto_approve();
		if (!$ret)
		{
			redirect_header($url_singlelink, 3, "DB Error");
			exit();
		}

// redirect to single link
		$time = $happy_linux_time->get_elapse_time();
		$msg  = _WLS_MODIFYAPPROVED . "<br />\n";
		$msg .= "$time sec <br />\n";
		$msg .= $weblinks_modlink->build_comment("delete approve link");	// for test form
		redirect_header( $url_index, 2, $msg );
		exit();
	}

// modify approve
	else
	{
		if ( $weblinks_modlink->check_show_del_reason_form() )
		{
			include XOOPS_ROOT_PATH."/header.php";
			$weblinks_modlink->print_del_reason_form();
			include XOOPS_ROOT_PATH.'/footer.php';
			exit();
		}

		$modify_newid = $weblinks_modlink->delete_admin_approve();
		if ( !$modify_newid )
		{
			redirect_header($url_singlelink, 3, "DB Error");
			exit();
		}

		$com  = 'delete request link [' . $modify_newid . ']';
		$msg  = _WLS_THANKSFORINFO;
		$msg .= $weblinks_modlink->build_comment( $com );	// for test form
		redirect_header($url_singlelink, 2, $msg);
		exit();
	}
}

// preview mode
elseif ($op == 'preview')
{
	include XOOPS_ROOT_PATH."/header.php";
	$weblinks_modlink->print_preview();
}

// modify form
else 
{
	include XOOPS_ROOT_PATH."/header.php";
	$weblinks_modlink->print_modify_form();
}

echo "<br /><hr />\n";
echo $happy_linux_time->build_elapse_time()."<br />\n";
if ( WEBLINKS_DEBUG_MEMORY )
{
	echo happy_linux_build_memory_usage_mb()."<br />\n";
}
include XOOPS_ROOT_PATH.'/footer.php';
exit();
// --- end of main ---

?>