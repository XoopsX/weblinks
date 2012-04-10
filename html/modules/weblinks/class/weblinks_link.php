<?php
// $Id: weblinks_link.php,v 1.3 2012/04/10 03:54:50 ohwada Exp $

// 2012-04-02 K.OHWADA
// gm_icon

// 2008-02-17 K.OHWADA
// pagerank, pagerank_update in link, modify
// _set_obj_pagerank();

// change assign_mod_object() clear pagerank update time

// 2007-12-24 K.OHWADA
// BUG : not set search field

// 2007-11-24 K.OHWADA
// _strip_tags()

// 2007-11-01 K.OHWADA
// weblinks_auth
// BUG : not set password
// WEBLINKS_OP_APPROVE_NEW

// 2007-09-10 K.OHWADA
// check_public()

// 2007-09-01 K.OHWADA
// notification to each category
// description_short()

// 2007-08-01 K.OHWADA
// admin can add etc column

// 2007-05-06 K.OHWADA
// BUG 4565: cannot show user manage, when too many links or users
// change user_name() user_mail()

// 2007-04-08 K.OHWADA
// gm_type

// 2007-03-25 K.OHWADA
// album_id

// 2007-03-01 K.OHWADA
// add forum_id comment_use field
// BUG: admin approve wrong password when guest submit
// BUG: cannot use bbcode in admincomment

// 2006-12-10 K.OHWADA
// add link_save class
// use happy_linux_object_validater
// add time_publish textarea1

// 2006-10-12 K.OHWADA
// BUG 4318: cannot register bulk links.
// add set_not_gpc()

// 2006-10-01 K.OHWADA
// divided from weblinks_link_handler
// google map
// change addr_urlencode()

//=========================================================
// WebLinks Module
// this file contain 4 class
//   weblinks_link_base
//   weblinks_link 
//   weblinks_link_save 
//   weblinks_link_validate
// 2006-09-20 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('weblinks_link') ) 
{

//=========================================================
// class weblinks_link_base
//=========================================================
class weblinks_link_base extends happy_linux_object_validater
{

// result
	var $_cid_array = null;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_link_base()
{
	$this->happy_linux_object_validater();
}

//---------------------------------------------------------
// show
//---------------------------------------------------------
function name_disp( $format='s' )
{
	$name = $this->getVar('name', $format);
	$flag = $this->getVar('nameflag');
	$text = $this->name_mail_disp_common( $name, $flag );
	return $text;
}

function mail_disp( $format='s' )
{
	$mail = $this->getVar('mail', $format);
	$flag = $this->getVar('mailflag');
	$text = $this->name_mail_disp_common( $mail, $flag );
	return $text;
}

function name_mail_disp_common( $value, $flag )
{
	$text = null;
	if ($flag)
	{
		$text = $value;
	}
	return $text;
}

function description_disp( $flag_dohtml=true )
{
	$myts =& MyTextSanitizer::getInstance();

	$context  = $this->get('description');
	$dosmiley = $this->get('dosmiley');
	$doxcode  = $this->get('doxcode');
	$doimage  = $this->get('doimage');
	$dobr     = $this->get('dobr');

	$dohtml = 1;
	if ( $flag_dohtml )
	{	$dohtml = $this->get('dohtml');	}

	$text = $myts->displayTarea($context, $dohtml, $dosmiley, $doxcode, $doimage, $dobr);
	return $text;
}

function textarea1_disp( $flag_dohtml=true )
{
	$myts =& MyTextSanitizer::getInstance();

	$context  = $this->get('textarea1');
	$dosmiley = $this->get('dosmiley1');
	$doxcode  = $this->get('doxcode1');
	$doimage  = $this->get('doimage1');
	$dobr     = $this->get('dobr1');

	$dohtml = 1;
	if ( $flag_dohtml )
	{	$dohtml = $this->get('dohtml1');	}

	$text = $myts->displayTarea($context, $dohtml, $dosmiley, $doxcode, $doimage, $dobr);
	return $text;
}

function textarea2_disp( $flag_dohtml=true )
{
	$myts =& MyTextSanitizer::getInstance();

	$context  = $this->get('textarea2');
	$dosmiley = 1;
	$doxcode  = 1;
	$doimage  = 1;
	$dobr     = 1;

	$dohtml = 1;
	if ( $flag_dohtml )
	{	$dohtml = 0;	}

	$text = $myts->displayTarea($context, $dohtml, $dosmiley, $doxcode, $doimage, $dobr);
	return $text;
}

// BUG: cannot use bbcode in admincomment
function admincomment_disp()
{
	$myts =& MyTextSanitizer::getInstance();

	$context  = $this->get('admincomment');
	$dohtml   = 0;
	$dosmiley = 1;
	$doxcode  = 1;
	$doimage  = 1;
	$dobr     = 1;

	$text = $myts->displayTarea($context, $dohtml, $dosmiley, $doxcode, $doimage, $dobr);
	return $text;
}

//---------------------------------------------------------
// short for save
//---------------------------------------------------------
function description_short( $max )
{
	$text = happy_linux_mb_shorten( $this->get('description'), $max );
	return $text;
}

function usercomment_short( $max )
{
	$text = happy_linux_mb_shorten( $this->get('usercomment'), $max );
	return $text;
}

//---------------------------------------------------------
// check
//---------------------------------------------------------
function check_public( $broken )
{
	if ( $this->is_warn_broken( $broken ) || 
	     $this->is_warn_time_publish()    || 
	     $this->is_warn_time_expire() )
	{
		return false;
	}
	return true;
}

function is_warn_broken( $broken )
{
	if (( $this->get('broken') == 0 )||( $this->get('broken') <  $broken ))
	{	return false;	}
	return true;
}

function is_warn_time_publish()
{
	if (( $this->get('time_publish') == 0 )||( $this->get('time_publish') < time() ))
	{	return false;	}
	return true;
}

function is_warn_time_expire()
{
	if (( $this->get('time_expire') == 0 )||( $this->get('time_expire') > time() ))
	{	return false;	}
	return true;
}

//---------------------------------------------------------
// cid array field
//---------------------------------------------------------
function &get_cid_array()
{
	return $this->_cid_array;
}

function &get_cid_array_form_post( &$post )
{
	$this->_cid_array =& $this->_post->get_int_unique_array_without_from_post( $post, 'cid', 0 );
	return $this->_cid_array;
}

// --- class end ---
}

//=========================================================
// class weblinks_link
//=========================================================
class weblinks_link extends weblinks_link_base
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_link()
{
	$this->weblinks_link_base();

	$this->initVar('lid',    XOBJ_DTYPE_INT, 0, false);
	$this->initVar('uid',    XOBJ_DTYPE_INT, 0, false);
	$this->initVar('cids',   XOBJ_DTYPE_TXTBOX, null, false, 255);
	$this->initVar('title',  XOBJ_DTYPE_TXTBOX, null, false, 255);
	$this->initVar('url',    XOBJ_DTYPE_URL_AREA );
	$this->initVar('banner', XOBJ_DTYPE_URL,    null, false, 255);
	$this->initVar('description',  XOBJ_DTYPE_TXTAREA);
	$this->initVar('name',     XOBJ_DTYPE_TXTBOX, null, false, 255);
	$this->initVar('nameflag', XOBJ_DTYPE_INT, 0, false);
	$this->initVar('mail',     XOBJ_DTYPE_TXTBOX, null, false, 255);
	$this->initVar('mailflag', XOBJ_DTYPE_INT, 0, false);
	$this->initVar('company',  XOBJ_DTYPE_TXTBOX, null, false, 255);
	$this->initVar('addr',     XOBJ_DTYPE_TXTBOX, null, false, 255);
	$this->initVar('tel',      XOBJ_DTYPE_TXTBOX, null, false, 255);
	$this->initVar('search',     XOBJ_DTYPE_TXTAREA);
	$this->initVar('passwd',   XOBJ_DTYPE_TXTBOX, null, false, 255);
	$this->initVar('admincomment',   XOBJ_DTYPE_TXTAREA);
	$this->initVar('mark',         XOBJ_DTYPE_TXTBOX, null, false, 255);
	$this->initVar('time_create',  XOBJ_DTYPE_INT, 0, false);
	$this->initVar('time_update',  XOBJ_DTYPE_INT, 0, false);
	$this->initVar('hits',     XOBJ_DTYPE_INT, 0, false);
	$this->initVar('rating',   XOBJ_DTYPE_FLOAT, 0.0, false);
	$this->initVar('votes',    XOBJ_DTYPE_INT, 0, false);
	$this->initVar('comments', XOBJ_DTYPE_INT, 0, false);
	$this->initVar('width',    XOBJ_DTYPE_INT, 0, false);
	$this->initVar('height',   XOBJ_DTYPE_INT, 0, false);
	$this->initVar('recommend',  XOBJ_DTYPE_INT, 0, false);
	$this->initVar('mutual',     XOBJ_DTYPE_INT, 0, false);
	$this->initVar('broken',     XOBJ_DTYPE_INT, 0, false);
	$this->initVar('rss_url',    XOBJ_DTYPE_URL, null, false, 255);
	$this->initVar('rss_flag',   XOBJ_DTYPE_INT, 0, false);
	$this->initVar('rss_xml',    XOBJ_DTYPE_TXTAREA);
	$this->initVar('rss_update', XOBJ_DTYPE_INT, 0, false);
	$this->initVar('usercomment',  XOBJ_DTYPE_TXTAREA);
	$this->initVar('zip',    XOBJ_DTYPE_TXTBOX, null, false, 255);
	$this->initVar('state',  XOBJ_DTYPE_TXTBOX, null, false, 255);
	$this->initVar('city',   XOBJ_DTYPE_TXTBOX, null, false, 255);
	$this->initVar('addr2',  XOBJ_DTYPE_TXTBOX, null, false, 255);
	$this->initVar('fax',    XOBJ_DTYPE_TXTBOX, null, false, 255);

// html
	$this->initVar('dohtml',   XOBJ_DTYPE_INT, 0, false);
	$this->initVar('dosmiley', XOBJ_DTYPE_INT, 1, false);
	$this->initVar('doxcode',  XOBJ_DTYPE_INT, 1, false);
	$this->initVar('doimage',  XOBJ_DTYPE_INT, 1, false);
	$this->initVar('dobr',     XOBJ_DTYPE_INT, 1, false);

// rssc
	$this->initVar('rssc_lid',  XOBJ_DTYPE_INT,   0);
	$this->initVar('map_use',   XOBJ_DTYPE_INT,   1);

// google map: hacked by wye
	$this->initVar('gm_latitude',  XOBJ_DTYPE_FLOAT, 0, false );
	$this->initVar('gm_longitude', XOBJ_DTYPE_FLOAT, 0, false );
	$this->initVar('gm_zoom',      XOBJ_DTYPE_INT,   0, false );
	$this->initVar('gm_type',      XOBJ_DTYPE_INT,   0, false );
	$this->initVar('gm_icon',      XOBJ_DTYPE_INT,   0, false );

// publish
	$this->initVar('time_publish', XOBJ_DTYPE_INT, 0);
	$this->initVar('time_expire',  XOBJ_DTYPE_INT, 0);
	$this->initVar('textarea1',    XOBJ_DTYPE_TXTAREA);
	$this->initVar('textarea2',    XOBJ_DTYPE_TXTAREA);
	$this->initVar('dohtml1',      XOBJ_DTYPE_INT, 0);
	$this->initVar('dosmiley1',    XOBJ_DTYPE_INT, 1);
	$this->initVar('doxcode1',     XOBJ_DTYPE_INT, 1);
	$this->initVar('doimage1',     XOBJ_DTYPE_INT, 1);
	$this->initVar('dobr1',        XOBJ_DTYPE_INT, 1);

// forum
	$this->initVar('forum_id',     XOBJ_DTYPE_INT, 0);
	$this->initVar('comment_use',  XOBJ_DTYPE_INT, 1);

	$this->initVar('album_id',     XOBJ_DTYPE_INT,   0);

// pagerank
	$this->initVar('pagerank',        XOBJ_DTYPE_INT,   0);
	$this->initVar('pagerank_update', XOBJ_DTYPE_INT,   0);

// aux
	$this->initVar('aux_int_1',  XOBJ_DTYPE_INT,   0);
	$this->initVar('aux_int_2',  XOBJ_DTYPE_INT,   0);
	$this->initVar('aux_text_1', XOBJ_DTYPE_TXTBOX, null, false, 255);
	$this->initVar('aux_text_2', XOBJ_DTYPE_TXTBOX, null, false, 255);

// etc1 .. etci
	for ($i = 1; $i <= WEBLINKS_LINK_NUM_ETC; $i++)
	{
		$etc_name = 'etc'. $i;
		$this->initVar($etc_name, XOBJ_DTYPE_TXTBOX, null, false, 255);
	}

}

//---------------------------------------------------------
// for admin/mail_users.php
//---------------------------------------------------------
// select from name title mail
function user_name( $format, $flag_title=true, $flag_mail=true )
{
	$title = $this->get('title');
	$name  = $this->get('name');
	$mail  = $this->get('mail');

	if ( $name )
	{
		$user_name = $name;
	}
	elseif ( $flag_title && $title )
	{
		$user_name = $title;
	}
	elseif ( $flag_mail && $mail )
	{
		$user_name = $mail;
	}

	$user_name = $this->sanitize_format_text($user_name, $format);
	return $user_name;
}

// select from mail system_mail
function user_mail( $format, $flag_system=true )
{
	$uid   = $this->get('uid');
	$mail  = $this->get('mail');

	$system_mail = $this->_system->get_email_by_uid( $uid );

	$user_mail = '';
	if ( $mail )
	{
		$user_mail = $mail;
	}
	elseif ( $flag_system && $uid && $system_mail )
	{
		$user_mail = $system_mail;
	}

	$user_mail = $this->sanitize_format_text($user_mail, $format);
	return $user_mail;
}

// --- class end ---
}


//=========================================================
// class weblinks_link_save
//=========================================================
class weblinks_link_save extends weblinks_link
{
	var $_banner_handler;
	var $_pagerank_handler;
	var $_link_validate;

	var $_search_list;

// result
	var $_banner_error_code = 0;
	var $_banner_errors     = null;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_link_save( $dirname )
{
	$this->weblinks_link();

	$this->_banner_handler   =& weblinks_get_handler( 'banner',      $dirname );
	$this->_pagerank_handler =& weblinks_get_handler( 'pagerank',    $dirname );
	$this->_link_validate    =& weblinks_link_validate::getInstance( $dirname );

// BUG : not set search field
	$this->_link_validate->init();

	$this->_search_list =& $this->_link_validate->get_search_list();
}

//---------------------------------------------------------
// assign add object
// $_POST or bulk
//---------------------------------------------------------
function assign_add_object( &$post, $not_gpc=false, $flag_banner=false, $flag_pagerank=false )
{
	$this->_set_vars_common( $post, $not_gpc );

// set object
	$this->set_object_with_validater();

// time
	$time = time();
	$this->setVar('time_create', $time);
	$this->setVar('time_update', $time);

// passwd
	$this->setVar('passwd', $this->_link_validate->get_passwd_md5_new($post) );

// banner
	if ( $flag_banner )
	{
		$this->_set_obj_banner_size();
	}

	if ( $flag_pagerank )
	{
		$this->_set_obj_pagerank();
	}

// search
	$this->_set_obj_search( $post);
}

//---------------------------------------------------------
// assign mod object
// $_POST or bulk
//---------------------------------------------------------
function assign_mod_object( &$post, $not_gpc=false, $flag_banner=false, $flag_pagerank=false )
{
	$this->_set_vars_common( $post, $not_gpc );

// time_update
	$this->set_validater_value_allow_by_array( $this->get_value_allow_type_time_update_form_post( $post, 'time_update') );

// passwd
	$this->set_validater_value_allow_by_array( $this->_link_validate->get_passwd_md5_mod_array($post) );

// rssc_lid
	$this->set_validater_value_allow_by_array( $this->get_value_allow_type_int_with_flag_update_from_post($post, 'rssc_lid') );

// set object
	$this->set_object_with_validater();

// banner
	if ( $flag_banner )
	{
		$this->_set_obj_banner_size();
	}

	if ( $flag_pagerank )
	{
		$this->_set_obj_pagerank();
	}

// search
	$this->_set_obj_search( $post );
}

//---------------------------------------------------------
// get parameter
//---------------------------------------------------------
function get_banner_error_code()
{
	return $this->_banner_error_code;
}

function get_banner_errors()
{
	return $this->_banner_errors;
}

//---------------------------------------------------------
// assign vars
//---------------------------------------------------------
function _set_vars_common( &$post, $not_gpc=false )
{
	$this->set_validater_name_prefix( 'weblinks' );

	$this->set_validater_conf_array( $this->_link_validate->get_conf_array() );
	$this->merge_validater_allow_list( $this->_link_validate->get_allow_list() );

// post value
	$this->merge_validater_value_list( $this->validate_values_from_post( $post, $not_gpc ) );

// uid
	$this->set_validater_value_allow_by_array( $this->_link_validate->get_uid_array( $post ) );
}

//---------------------------------------------------------
// banner size field
// presuppose to execute set_object_with_validater()
//---------------------------------------------------------
function _set_obj_banner_size()
{
	$banner = $this->get('banner');

// return size zero, if not banner
	$size =& $this->_banner_handler->get_remote_banner_size( $banner );

	if ( is_array($size) && isset($size[0]) && isset($size[1]) )
	{
		$this->setVar('width',  $size[0]);
		$this->setVar('height', $size[1]);
	}
	elseif ( !$size )
	{
		$this->_banner_error_code = $this->_banner_handler->getErrorCode();
		$this->_banner_errors     = $this->_banner_handler->getErrors();
	}
}

//---------------------------------------------------------
// pagerank field
// presuppose to execute set_object_with_validater()
//---------------------------------------------------------
function _set_obj_pagerank()
{
	$pr  = $this->_pagerank_handler->get_page_rank_from_google(
		$this->get('url'), $this->get('pagerank') );

	$this->setVar('pagerank',        $pr );
	$this->setVar('pagerank_update', time() );
}

//---------------------------------------------------------
// search field
// presuppose to execute set_object_with_validater()
//---------------------------------------------------------
function _set_obj_search( &$post)
{
	$cid_arr =& $this->get_cid_array_form_post( $post );
	$search = $this->build_search( $cid_arr );
	$this->setVar('search', $search);
}

// for import_manege
function build_search( &$cid_arr )
{
	$text = '';
	foreach( $this->gets() as $k => $v)
	{
		if ( isset($this->_search_list[$k]) && $this->_search_list[$k] )
		{
			$text .= $v.' ';
		}
	}
	$text .= $this->name_disp('n').' ';
	$text .= $this->mail_disp('n').' ';
	$text .= $this->_strip_tags( $this->description_disp( false ) ).' ';
	$text .= $this->_strip_tags( $this->textarea1_disp(   false ) ).' ';
	$text .= $this->_strip_tags( $this->textarea2_disp(   false ) ).' ';
	$text .= $this->_link_validate->build_search_category( $cid_arr ).' ';

	$search = preg_replace("/\n|\r/",' ',$text);
	return $search;
}

function _strip_tags( $str )
{
	return strip_tags( happy_linux_str_add_space_after_tag( $str ) );
}

// --- class end ---
}

//=========================================================
// class weblinks_link_validate
//=========================================================
class weblinks_link_validate
{
	var $_config_handler;
	var $_category_handler;
	var $_linkitem_define_handler;
	var $_auth;
	var $_system;
	var $_post;

// local
	var $_conf;
	var $_xoops_uid;
	var $_is_xoops_module_admin;
	var $_is_xoops_guest;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_link_validate( $dirname )
{
	$this->_config_handler          =& weblinks_get_handler( 'config2_basic',   $dirname );
	$this->_category_handler        =& weblinks_get_handler( 'category',        $dirname );
	$this->_linkitem_define_handler =& weblinks_get_handler( 'linkitem_define', $dirname );
	$this->_auth                    =& weblinks_auth::getInstance( $dirname );

	$this->_system  =& happy_linux_system::getInstance();
	$this->_post    =& happy_linux_post::getInstance();

	$this->_conf =& $this->_config_handler->get_conf();

	$this->_xoops_uid             = $this->_system->get_uid();
	$this->_is_xoops_module_admin = $this->_system->is_module_admin();
	$this->_is_xoops_guest        = $this->_system->is_guest();
}

function &getInstance( $dirname )
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new weblinks_link_validate( $dirname );
	}

	return $instance;
}

//---------------------------------------------------------
// config
//---------------------------------------------------------
function init()
{
	$this->_linkitem_define_handler->load();
}

function &get_conf_array()
{
	$arr =& $this->_linkitem_define_handler->get_cached_by_name();
	return $arr;
}

function &get_allow_list()
{
	$arr1 =& $this->_linkitem_define_handler->get_save_mode_list();
	$arr2 =& $this->_auth->has_auth_desc_option();
	$arr3 =  array_merge($arr1, $arr2);
	return $arr3;
}

function &get_search_list()
{
	$arr =& $this->_linkitem_define_handler->get_search_list();
	return $arr;
}

//---------------------------------------------------------
// xoops param
//---------------------------------------------------------
function get_xoops_uid()
{
	return $this->_xoops_uid;
}

function is_xoops_module_admin()
{
	return $this->_is_xoops_module_admin;
}

function is_xoops_guest()
{
	return $this->_is_xoops_guest;
}

//---------------------------------------------------------
// uid field
//---------------------------------------------------------
function get_uid_array( &$post )
{
	$uid = $this->get_uid( $post );
	return array('uid', $uid, true);
}

function get_uid( &$post )
{
// default: submitter
	$uid = $this->get_xoops_uid();

// if admin
	if ( $this->is_xoops_module_admin() && isset($post['uid']) )
	{
		$uid = intval($post['uid']);
	}

	return $uid;
}

//---------------------------------------------------------
// passwd field
//---------------------------------------------------------
function get_passwd_md5_new_array( &$post )
{
	$passwd = $this->get_passwd_md5_new( $post );
	return array('passwd', $passwd, 'true');
}

function get_passwd_md5_new( &$post )
{
// admin or guest specify
	if ( $this->_has_passwd() && isset($post['passwd_new']) && $post['passwd_new'] )
	{
		$passwd = $this->_post->get_text_from_post( $post, 'passwd_new');
		$passwd = md5( $passwd );
	}

// admin approve new link
// BUG : not set password
	elseif ( $this->_is_approve_passwd($post, WEBLINKS_OP_APPROVE_NEW) )
	{
		$passwd = $this->_post->get_text_from_post( $post, 'passwd_md5');
	}

// default
	if ( empty($passwd) )
	{
		$passwd = md5( xoops_makepass() );
	}

	return $passwd;
}

function get_passwd_md5_mod_array( &$post )
{
// default
	$passwd = '';
	$allow  = false;

// admin or guest specify
	if ( $this->_has_passwd() && isset($post['passwd_new']) && $post['passwd_new'] )
	{
		$passwd = $this->_post->get_text_from_post( $post, 'passwd_new');
		$passwd = md5( $passwd );
		$allow  = true;
	}

// admin approve mod link
	elseif ( $this->_is_approve_passwd($post, WEBLINKS_OP_APPROVE_MOD) )
	{
		$passwd = $this->_post->get_text_from_post( $post, 'passwd_md5');
		$allow  = true;
	}

	return array('passwd', $passwd, $allow);
}

function _is_approve_passwd( &$post, $op )
{
// BUG: admin approve wrong password when guest submit
	if ( $this->is_xoops_module_admin() && 
	     isset($post['op']) && ($post['op'] == $op) &&
	     isset($post['passwd_md5']) && $post['passwd_md5'] )
	{
		return true;
	}
	return false;
}

function _has_passwd()
{
// admin
	if ( $this->is_xoops_module_admin() )
	{
		return true;
	}
// use passwd & guest
	if ( $this->_conf['use_passwd'] && $this->is_xoops_guest() )
	{
		return true;
	}
	return false;
}

//---------------------------------------------------------
// search field
//---------------------------------------------------------
function build_search_category( &$cid_arr )
{
	$search = '';
	if ( is_array($cid_arr) )
	{
		foreach ($cid_arr as $cid)
		{
			$path_array = $this->_category_handler->get_parent_path($cid);
			foreach ($path_array as $path)
			{
				$search .= $path['title'].' ';
			}
		}
	}
	return $search;
}

// --- class end ---
}

// === class end ===
}

?>