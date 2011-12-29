<?php
// $Id: broken_list.php,v 1.1 2011/12/29 14:32:53 ohwada Exp $

// 2007-11-01 K.OHWADA
// weblinks_admin_print_footer()

// 2006-09-20 K.OHWADA
// this new file

//================================================================
// WebLinks Module
// 2006-09-20 K.OHWADA
//================================================================

include 'admin_header.php';
include 'admin_header_list.php';

//=========================================================
// class admin_broken_list
//=========================================================
class admin_broken_list extends happy_linux_page_frame
{
	var $_link_handler;

	var $_system;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_broken_list()
{
	$this->happy_linux_page_frame();
	$this->set_handler('broken', WEBLINKS_DIRNAME, 'weblinks');
	$this->set_id_name('bid');
	$this->set_lang_title( _WLS_BROKENREPORTS );
	$this->set_lang_no_item( _WLS_NOBROKEN );
	$this->set_flag_form(true);
	$this->set_form_name('broken');
	$this->set_action('broken_manage.php');
	$this->set_operation('del_all');
	$this->set_submit_colspan(0, 2, 5);
	$this->set_lang_submit_value( _DELETE );

	$this->_link_handler =& weblinks_get_handler( 'link', WEBLINKS_DIRNAME );

	$this->_system =& happy_linux_system::getInstance();

}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_broken_list();
	}
	return $instance;
}

//---------------------------------------------------------
// handler
//---------------------------------------------------------
function &_get_table_header()
{
	$arr = array(
		$this->build_form_js_checkall(),
		'bid',
		_WLS_LINKID,
		_WLS_SITETITLE,
		_WLS_REPORTER,
		_WLS_IP,
		_WLS_LINKSUBMITTER,
	);

	return $arr;
}

function &_get_cols(&$obj)
{
	$bid    = $obj->get('bid');
	$lid    = $obj->get('lid');
	$sender = $obj->getVar('sender');
	$ip     = $obj->getVar('ip');
	$uname  = $obj->get_uname();
	$email  = $obj->get_email();

	$checkbox = $this->build_form_js_checkbox($bid);

	$flag_link_exist = false;
	$title_s = '';
	$url_s   = '';
	$uid     = '';

	$link_obj =& $this->_link_handler->get($lid);
	if ( is_object($link_obj) )
	{
		$flag_link_exist = true;
		$title_s = $link_obj->getVar('title', 's');
		$url_s   = $link_obj->getVar('url',   's');
		$uid     = $link_obj->get('uid');
	}

	$user_param = $this->_system->get_user_by_uid( $uid );
	$owner      = $user_param['uname'];
	$owneremail = $user_param['email'];

	$jump_broken = 'broken_manage.php?op=mod_form&bid=';
	$jump_link   = 'link_manage.php?op=mod_form&lid=';
	$link_broken = $this->_build_page_id_link_by_obj( $obj, 'bid', $jump_broken);
	$link_link   = $this->_build_page_id_link_by_obj( $obj, 'lid', $jump_link);

	if ($flag_link_exist)
   	{
   		$title = '<a href="'.$url_s.'" target="_blank">'.$title_s.'</a>';
   	}
   	else
   	{
   		$title = _WLS_ERRORNOLINK;
   	}
   		
	if ( $email && $uname ) 
	{
		$sender = '<a href="mailto:'.$email.'">'.$uname.'</a>';
	}
	elseif ( empty($sender) )
	{
		$sender = '---';
	}

	if ( $owneremail && $owner ) 
	{
		$owner = '<a href="mailto:'.$owneremail.'">'.$owner.'</a>';
	}

	$arr = array(
		$checkbox,
		$link_broken,
		$link_link,
		$title,
		$sender,
		$ip,
		$owner,
	);

	return $arr;
}

// --- class end ---
}

//=========================================================
// main
//=========================================================
xoops_cp_header();
weblinks_admin_print_header();
weblinks_admin_print_menu();

$list =& admin_broken_list::getInstance();
$list->_show();

weblinks_admin_print_footer();
xoops_cp_footer();
exit();
// --- end of main ---

?>