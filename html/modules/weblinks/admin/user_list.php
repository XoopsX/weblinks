<?php
// $Id: user_list.php,v 1.1 2011/12/29 14:32:55 ohwada Exp $

// 2007-11-01 K.OHWADA
// set_flag_execute_time()

// 2007-07-16 K.OHWADA
// XC 2.1
// _print_form_begin()

// 2007-05-06 K.OHWADA
// BUG 4565: cannot show user manage, when too many links or users
// use weblinks_users_link_handler.php
// remove init() get_uid_list() 
// remove _get_lid_array_with_email() _get_uid_list_with_use() _get_uid_list_without_use()
// NOT use user_name() user_mail()

// 2006-12-10 K.OHWADA
// use user_name() user_mail()

// 2006-09-20 K.OHWADA
// use happy_linux

// 2006-05-15 K.OHWADA
// new handler
// add class admin_user_list

// 2006-03-15 K.OHWADA
// use weblinks_pagenavi_basic::getInstance()

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication

//================================================================
// WebLinks Module
// user list
// 2005-01-20 K.OHWADA
//================================================================

include 'admin_header.php';
include 'admin_header_list.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_users_link_handler.php';

//=========================================================
// class admin_user_list
//=========================================================
class admin_user_list extends happy_linux_page_frame
{
	var $_MAX_USER = 50;

	var $_users_link_handler;
	var $_system;

	var $_total_lid_array_with_email = 0;
	var $_total_uid_with_use         = 0;
	var $_total_uid_without_use      = 0;

	var $_lid_array_with_email = array();
	var $_uid_list_with_use    = array();
	var $_uid_list_without_use = array();

	var $_logo_img;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_user_list()
{
	$this->happy_linux_page_frame();
	$this->set_handler('link', WEBLINKS_DIRNAME, 'weblinks');
	$this->set_id_name('lid');
	$this->set_max_sortid(3);
	$this->set_perpage($this->_MAX_USER);
	$this->set_flag_alternate(1);
	$this->set_lang_no_item( _WEBLINKS_USER_NOFOUND );
	$this->set_lang_submit_value( _WEBLINKS_ADMIN_SENDMAIL );
	$this->set_flag_form(true);
	$this->set_form_name('user_list');
	$this->set_action('mail_user.php');
	$this->set_operation('send');
	$this->set_flag_execute_time( true );

	$this->_users_link_handler =& weblinks_get_handler('users_link',   WEBLINKS_DIRNAME );
	$this->_system =& happy_linux_system::getInstance();

	$logo_url = XOOPS_URL.'/images/icons/email.gif';
	$this->_logo_img = $this->build_html_img_tag($logo_url, 0, 0, 0, 'mailto');
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_user_list();
	}
	return $instance;
}

//---------------------------------------------------------
// handler
//---------------------------------------------------------
function &_get_table_header()
{
	$input = $this->build_form_js_checkall();

	switch ($this->_sortid)
	{
		case 1:
		case 2:
			$arr = array(
				$input,
				_WLS_NAME,
				_WLS_SITETITLE,
				_WLS_EMAIL,
			);
			break;

		case 0:
		default:
			$arr = array(
				$input,
				_WLS_LINKID,
				_WLS_SITETITLE,
				_WLS_NAME,
				_WLS_EMAIL,
				_WEBLINKS_SUBMITTER,
				_WEBLINKS_UID_EMAIL,
			);
			break;
	}

	return $arr;
}

function _get_total()
{
	$this->_total_with_email      = $this->_handler->get_count_with_email();
	$this->_total_uid_with_use    = $this->_users_link_handler->get_uid_count_with_use();
	$this->_total_uid_without_use = $this->_users_link_handler->get_uid_count_without_use();

	switch ($this->_sortid)
	{
		case 1:
			$total = $this->_total_uid_with_use;
			break;

		case 2:
			$total = $this->_total_uid_without_use;
			break;

		case 0:
		default:
			$total = $this->_total_with_email;
			break;
	}

	return $total;
}

function &_get_items($limit=0, $start=0)
{
	switch ($this->_sortid)
	{
		case 1:
			$lines =& $this->_users_link_handler->get_uid_list_with_use($limit, $start);
			break;

		case 2:
			$lines =& $this->_users_link_handler->get_uid_list_without_use($limit, $start);
			break;

		case 0:
		default:
			$lines =& $this->_handler->get_objects_with_email($limit, $start);
			break;
	}

	return $lines;
}

function &_get_cols(&$line)
{
	switch ($this->_sortid)
	{
		case 1:
		case 2:
			$arr =& $this->_get_cols_uid($line);
			break;

		case 0:
		default:
			$arr =& $this->_get_cols_lid($line);
			break;
	}

	return $arr;
}

function &_get_cols_lid( &$obj )
{
	$submitter_p = '---';

	$lid     = $obj->getVar('lid',   'n');
	$uid     = $obj->getVar('uid',   'n');
	$name_s  = $obj->getVar('name',  's');
	$mail_s  = $obj->getVar('mail',  's');

	$jump_lid = 'link_manage.php?op=modLink&lid=';
	$input_p  = $this->build_form_js_checkbox($lid);
	$linkid_p = $this->_build_page_id_link_by_obj($obj, 'lid', $jump_lid);
	$title_p  = $this->_build_page_name_link_by_obj($obj, 'url', 'title', '_blank');
	$email_p  = $this->build_xoops_mailto_with_logo($mail_s);

	if ( empty($name_s) )
	{
		$name_s= '---';
	}

	$system_name = '';
	$system_mail = '';
	$submitter_p = '---';
	$user_mail_p = '';

	if ($uid > 0)
	{
		$system_name = $this->_system->get_uname_by_uid( $uid );
		$system_mail = $this->_system->get_email_by_uid( $uid );
		$submitter_p = $this->build_xoops_url_userinfo($uid, $system_name);
		$user_mail_p = $this->build_xoops_mailto_with_logo($system_mail);
	}

	$arr = array(
		$input_p,
		$linkid_p,
		$title_p,
		$name_s,
		$email_p,
		$submitter_p,
		$user_mail_p,
	);

	return $arr;
}

function &_get_cols_uid(&$line)
{
	$uid = $line;

	$user = $this->_system->get_user_by_uid( $uid );

	$uname_s = $this->sanitize_text( $user['uname'] );
	$email_s = $this->sanitize_text( $user['email'] );

	$objs = $this->_handler->get_objects_by_uid($uid);

	$lid_list = '';

	if ( count($objs) > 0 )
	{
		foreach ( $objs as $obj )
		{
			$lid         = $obj->getVar('lid');
			$title_s     = $obj->getVar('title');
			$modlink_url = "link_manage.php?op=modLink&lid=".$lid;

			$lid_list .= $this->build_html_a_href_name($modlink_url, $title_s);
			$lid_list .= "<br />\n";
		}
	}

	$input_p  = $this->build_form_js_checkbox($uid);
	$input_p .= $this->_build_uname($uid, $uname_s);

	$submitter_p = $this->build_xoops_url_userinfo($uid, $uname_s);
	$email_p     = $this->build_xoops_mailto_with_logo($email_s);

	$arr = array(
		$input_p,
		$submitter_p,
		$lid_list,
		$email_p,
	);

	return $arr;
}

function _build_uname($uid, $uname_s)
{
	$input = "<input type='hidden' name='memberslist_uname[".$uid."]' id='memberslist_uname[]' value='".$uname_s."' />";
	return $input;
}


//---------------------------------------------------------
// print
//---------------------------------------------------------
function _print_top()
{
	switch ($this->_sortid)
	{
		case 1:
			$title   = _WEBLINKS_ADMIN_USER_LINK;
			$desc    = '';
			break;

		case 2:
			$title   = _WEBLINKS_ADMIN_USER_NOLINK;
			$desc    = '';
			break;

		case 0:
		default:
			$title = _WEBLINKS_ADMIN_USER_EMAIL;
			$desc  = _WEBLINKS_ADMIN_USER_EMAIL_DSC;
			break;
	}

	echo "<h4>"._WEBLINKS_ADMIN_USER_MANAGE."</h4>\n";

	echo "<table width='80%' border='0' cellspacing='1' class='outer'>";
	echo "<tr class='odd'><td>";
	echo "<ul>\n";
	echo "<li><a href='user_list.php?sortid=0'>"._WEBLINKS_ADMIN_USER_EMAIL."</a> (".$this->_total_with_email.") </li>\n";
	echo "<li><a href='user_list.php?sortid=1'>"._WEBLINKS_ADMIN_USER_LINK."</a> (".$this->_total_uid_with_use.") </li>\n";
	echo "<li><a href='user_list.php?sortid=2'>"._WEBLINKS_ADMIN_USER_NOLINK."</a> (".$this->_total_uid_without_use.") </li>\n";
	echo "<ul/>\n";
	echo"</td></tr></table>\n";
	echo"<br /><br />\n";

	echo "<h4>$title</h4>\n";
	echo "$desc<br /><br />\n";
}

function _main_proc_extra()
{
	printf(_WEBLINKS_THERE_ARE_USER, $this->_total);
	echo "<br />\n";
	printf(_WEBLINKS_USER_NUM, $this->_start + 1, $this->_end);
	echo "<br /><br />\n";
}

function _print_form_begin()
{
	switch ($this->_sortid)
	{
		case 1:
		case 2:
			$op = 'form_user';
			break;

		case 0:
		default:
			$op = 'form_link';
			break;
	}

	echo $this->build_form_begin('memberslist', 'mail_users.php');
	echo $this->build_html_input_hidden('op', $op);
	echo $this->build_token();
}

function _print_table_submit()
{
	switch ($this->_sortid)
	{
		case 1:
		case 2:
			$colspan = 2;
			break;

		case 0:
		default:
			$colspan = 5;
			break;
	}

	echo $this->_build_page_submit(0, 2, $colspan);
}

// --- class end ---
}


//=========================================================
// main
//=========================================================
xoops_cp_header();

weblinks_admin_print_header();
weblinks_admin_print_menu();

$list =& admin_user_list::getInstance();
$list->_show();

xoops_cp_footer();
exit();
// --- end of main ---

?>