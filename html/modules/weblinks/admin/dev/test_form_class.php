<?php
// $Id: test_form_class.php,v 1.2 2011/12/29 19:54:56 ohwada Exp $

//=========================================================
// WebLinks Module
// 2006-09-20 K.OHWADA
//=========================================================

// ---------------------------------------------------------------
// 2011-12-29 K.OHWADA
// PHP 5.3 : ereg
// 2008-02-17 K.OHWADA
// disable pagerank
// check_config_rss_use()
// print_error()
// 2007-10-30 K.OHWADA
// divid to test_form_guest_class.php
// 2007-09-20 K.OHWADA
// geust modify link
// 2007-09-01 K.OHWADA
// get_form_values()
// 2007-05-18 K.OHWADA
// XC 2.1
// 2007-02-20 K.OHWADA
// admin_add_cat_add_cat()
// performance mode
// 2006-12-10 K.OHWADA
// use build_link_record
// ---------------------------------------------------------------

include_once 'htmlparser.inc.php';
include_once 'test_form_parser_class.php';

//=========================================================
// class weblinks_test_form
//=========================================================
class weblinks_test_form extends weblinks_gen_record
{
	var $_UNAME_ADMIN  = 'admin';
	var $_PASS_ADMIN   = 'admin';
	var $_UNAME_USER   = 'tester';
	var $_PASS_USER    = 'tester';
	var $_UNAME_OTHER  = 'tester2';
	var $_PASS_OTHER   = 'tester2';

	var $_snoopy;
	var $_form_parser;

	var $_user_submit_url;
	var $_user_modify_url;

	var $_lid   = null;
	var $_newid = null;
	var $_build_form_array = null;

	var $_flag_print_body = true;

	var $_DEBUG_PRINT_SUBMIT       = false;
	var $_DEBUG_PRINT_FORM_VALUE   = false;
	var $_DEBUG_PRINT_RESULT_LEVEL = 0;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_test_form()
{
	$this->weblinks_gen_record();

	$this->_snoopy      = new Snoopy();
	$this->_form_parser = new weblinks_test_form_parser();

	$this->_user_submit_url = WEBLINKS_URL.'/submit.php';
	$this->_user_modify_url = WEBLINKS_URL.'/modlink.php';

// disable pagerank
	$this->update_config_by_name( 'use_pagerank', 0 );
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new weblinks_test_form();
	}
	return $instance;
}

//---------------------------------------------------------
// login
//---------------------------------------------------------
function login_admin()
{
	$ret = $this->login($this->_UNAME_ADMIN, $this->_PASS_ADMIN);
	return $ret;
}

function login_user()
{
	$ret = $this->login($this->_UNAME_USER, $this->_PASS_USER);
	return $ret;
}

function login_other()
{
	$ret = $this->login($this->_UNAME_OTHER, $this->_PASS_OTHER);
	return $ret;
}

function login($uname, $pass)
{
	echo " login $uname <br />\n";

	$url = XOOPS_URL.'/user.php';

	$form = array(
		'uname' => $uname,
		'pass'  => $pass,
		'op'    => 'login',
	);

	$ret = $this->_snoopy->submit($url, $form);
	if ( !$ret )
	{
		$this->print_error( "Error: cannnot connect login form: $url " );
		$this->print_body();
		return false;
	}

	$ret = $this->match_result( _US_INCORRECTLOGIN );
	if ( $ret )
	{
		$this->print_error( "Error: user name is worng: <b>$uname</b> " );
		$this->print_body();
		return false;
	}

	$ret = $this->get_cookies();
	return $ret;
}

function logout( $flag=true )
{
	$url = XOOPS_URL.'/user.php?op=logout';
	$this->fetch($url);

	if ( $flag )
	{
		$ret = $this->match_result( _US_LOGGEDOUT );
		if ( !$ret )
		{
			$this->print_error( "Error: cannot logout" );
			$this->print_body();
			return false;
		}
	}

	$ret = $this->get_cookies();
	return $ret;
}

function get_cookies()
{
	$this->_snoopy->setcookies();
	$cookies = $this->_snoopy->cookies;
	if ( !is_array($cookies) || (count($cookies) == 0) )
	{
		$this->print_error( "Error: login failed: cannot get cookie" );
		$this->print_body();
		return false;
	}
	return $cookies;
}

function check_config_rss_use()
{
	if ( $this->get_config_by_name('rss_use') == 0 )
	{
		$this->print_error( "not set config : rss_use" ); 
		return false;
	}
	return true;
}

//---------------------------------------------------------
// fetch_form
//---------------------------------------------------------
function fetch($url)
{
	$ret = $this->_snoopy->fetch($url);
	if ( !$ret )
	{
		$this->print_error( "Error: cannnot fetch : $url " ); 
		$this->print_body();
		return false;
	}
	return true;
}

function fetch_form($url)
{
	$this->print_debug( "fetch_form($url)" );

	$ret = $this->_snoopy->fetchform($url);
	if ( !$ret )
	{
		$this->print_error( "Error: cannnot fetch form : $url " ); 
		$this->print_body();
		return false;
	}
	return true;
}

//---------------------------------------------------------
// get_form_values
//---------------------------------------------------------
function &get_form_values( $result=null )
{
	if (empty($result))
	{
		$result = $this->_snoopy->results;
	}

	if ( $this->_DEBUG_PRINT_RESULT_LEVEL > 0 )
	{
		$res = $result;
		if ( $this->_DEBUG_PRINT_RESULT_LEVEL == 2 )
		{
			$res = $this->get_body();
		}
		elseif ( $this->_DEBUG_PRINT_RESULT_LEVEL == 3 )
		{
			$res = htmlspecialchars( $result );
			$res = nl2br( $res );
		}

		echo "<hr />\n";
		echo "<b>result</b><br />\n";
		echo $res;
		echo "<hr />\n";
	}

	$arr =& $this->_form_parser->parse( $result );

	if ( $this->_DEBUG_PRINT_FORM_VALUE )
	{
		echo "<b>get_form_values</b><br />\n";
		$this->print_msg( $arr );
		echo "<br />\n";
	}

	return $arr;
}

//---------------------------------------------------------
// get ticket
// < input type="hidden" name="XOOPS_G_TICKET" value="e1c3d9c1ece8114441b7ac68e90e429b" />
//---------------------------------------------------------
function get_ticket( $result=null )
{
	$val = $this->get_hidden_value( 'XOOPS_G_TICKET', $result );
	if ( !$val )
	{
		$this->print_error( "Error: cannot get ticket " ); 
		$this->print_body();
		return false;
	}
	return $val;
}

//---------------------------------------------------------
// get_hidden_value
// < input type="hidden" name="lid" id="lid" value="155" />
//---------------------------------------------------------
function get_hidden_value( $name, $result=null )
{
	if (empty($result))
	{
		$result = $this->_snoopy->results;
	}

	$pattern = '<\/?input[\s+]type="hidden"[\s+]name="'.$name.'".*value="(\w+)"[\s+]/>';
	$pattern = "'$pattern'Usi";

	preg_match($pattern, $result, $match);

	if ( isset($match[1]) && $match[1] )
	{
		$val = $match[1];
		return $val;
	}

	return false;
}

//---------------------------------------------------------
// submit_form
//---------------------------------------------------------
function submit_form( $url, $form )
{
	if ( $this->_DEBUG_PRINT_SUBMIT )
	{
		echo "submit_form: $url <br />\n";
		$this->print_msg( $form );
		echo "<br />\n";
	}

	$this->_snoopy->referer = $url;

	$ret = $this->_snoopy->submit($url, $form);
	if ( !$ret )
	{
		$this->print_error( "Error: cannnot submit form: $url " ); 
		$this->print_body();
		return false;
	}
	return true;
}

//---------------------------------------------------------
// get_results
//---------------------------------------------------------
function get_results()
{
	return $this->_snoopy->results;
}

function get_body( $result=null )
{
	if (empty($result))
	{
		$result = $this->_snoopy->results;
	}

	$str = preg_replace("/^.*<body[^>]*>/i", "", $result);
	$str = preg_replace("/</body>.*$/i",     "", $str);
	return $str;
}

function print_body( $flag_print=false, $result=null )
{
	if ( $flag_print || $this->_flag_print_body )
	{
		echo "<hr />\n";
		echo $this->get_body( $result );
		echo "<hr />\n";
	}
}

function match_result($str, $result=null)
{
	if (empty($result))
	{
		$result = $this->_snoopy->results;
	}

	$pattern = '/' . preg_quote($str) . '/';
	if ( preg_match( $pattern, $result ) )
	{
		return true;
	}
	return false;
}

function match_return_msg($str, $result=null)
{
	if (empty($result))
	{
		$result = $this->_snoopy->results;
	}

	list( $msg, $newid ) = $this->get_return_msg( $result );

	$pattern = '/' . preg_quote($str) . '/';

	if ( preg_match( $pattern, $msg ) )
	{
		if ( $newid )
		{
			$this->_newid = $newid;
		}
		return true;
	}

	return false;
}

function get_return_msg( $result=null )
{
	if (empty($result))
	{
		$result = $this->_snoopy->results;
	}

	$msg   = null;
	$newid = null;

	$pattern1 = '/<!-- weblinks : (.*) \[(\d+)\] -->/';
	$pattern2 = '/<!-- weblinks : (.*) -->/';

	if ( preg_match( $pattern1, $result, $match1 ) )
	{
		$msg   = $match1[1];
		$newid = $match1[2];
	}
	elseif ( preg_match( $pattern2, $result, $match2 ) )
	{
		$msg = $match2[1];
	}

	return array( $msg, $newid );
}

function get_newid()
{
	return $this->_newid;
}

//---------------------------------------------------------
// set param
//---------------------------------------------------------
function set_admin_uname_pass( $uname, $pass )
{
	$this->_UNAME_ADMIN = $uname;
	$this->_PASS_ADMIN  = $pass;
}

function set_user_uname_pass( $uname, $pass )
{
	$this->_UNAME_USER = $uanme;
	$this->_PASS_USER  = $pass;
}

function get_admin_uname()
{
	return $this->_UNAME_ADMIN;
}

function get_user_uname()
{
	return $this->_UNAME_USER;
}

function get_other_uname()
{
	return $this->_UNAME_OTHER;
}

function set_debug_print_submit( $val )
{
	$this->_DEBUG_PRINT_SUBMIT = (bool)$val;
}

function set_debug_print_result_level( $val )
{
	$this->_DEBUG_PRINT_RESULT_LEVEL = intval($val);
}

function set_debug_print_form_value( $val )
{
	$this->_DEBUG_PRINT_FORM_VALUE = (bool)$val;
}

//---------------------------------------------------------
// user submit
//---------------------------------------------------------
function user_submit_link_with_login( $param )
{
	$ret = $this->login_user();
	if ( !$ret )	{	return false;	}

	$ret = $this->user_submit_link( $param );
	if ( !$ret )	{	return false;	}

	$ret = $this->logout();
	if ( !$ret )	{	return false;	}

	return true;
}

function user_submit_link( &$param )
{
	$ret = $this->fetch_form( $this->_user_submit_url );
	if ( !$ret )	{	return false;	}

	$param['lid'] = 0;
	$form = $this->build_link_form( $param );

	$ret = $this->submit_form( $this->_user_submit_url, $form );
	if ( !$ret )	{	return false;	}

	$this->_newid = null;
	if ( isset($param['return']) )
	{
		if ( !$this->match_return_msg( $param['return'] ) )
		{
			$this->print_error( "Error: submit link failed: " ); 
			echo "<hr />\n";
			echo $this->get_body() ."<br /><br />\n";
			return false;
		}
		if ( empty( $this->_newid ) )
		{
			$this->print_error( "Error: submit link failed: cannot get newid " ); 
			echo "<hr />\n";
			echo $this->get_body() ."<br /><br />\n";
			return false;
		}
	}

	return true;
}

//---------------------------------------------------------
// user modify
//---------------------------------------------------------
function user_modify_link_with_login( $param )
{
	$ret = $this->login_user();
	if ( !$ret )	{	return false;	}

	$ret = $this->user_modify_link( $param );
	if ( !$ret )	{	return false;	}

	$ret = $this->logout();
	if ( !$ret )	{	return false;	}

	return true;
}

function user_modify_link( &$param )
{
	$lid = isset($param['lid']) ? $param['lid'] : 0;

	$this->_lid = $lid;

	$link_form_url = $this->_user_modify_url.'?lid='.$lid;
	$ret = $this->fetch_form($link_form_url);
	if ( !$ret )	{	return false;	}

	$form = $this->build_link_form( $param );

	$ret = $this->submit_form($this->_user_modify_url, $form);
	if ( !$ret )	{	return false;	}

	$this->_newid = null;
	if ( isset($param['return']) )
	{
		if ( !$this->match_return_msg( $param['return'] ) )
		{
			$this->print_error( "Error: modify link failed: " ); 
			echo "<hr />\n";
			echo $this->get_body() ."<br /><br />\n";
			return false;
		}
		if ( empty( $this->_newid ) )
		{
			$this->print_error( "Error: modify link failed: cannot get newid " ); 
			echo "<hr />\n";
			echo $this->get_body() ."<br /><br />\n";
			return false;
		}
	}

	return true;
}

function is_link_owner_other($lid, $uname=null)
{
	if ( empty($uname) )
	{
		$uname = $this->_UNAME_OTHER;
	}
	$ret = $this->is_link_owner($lid, $uname);
	return $ret;
}

function is_link_owner($lid, $uname=null)
{
	$link_uid = 0;
	$row =& $this->get_link($lid);
	if ( is_array($row) && isset($row['uid']) )
	{
		$link_uid = $row['uid'];
	}

	if ( empty($uname) )
	{
		$uname = $this->_UNAME_USER;
	}

	$user =& $this->_system->get_user_by_uname( $uname );
	$uname_uid = $user['uid'];

	if ( $link_uid && ( $link_uid == $uname_uid ) )
	{
		return true;
	}
	return false;
}

function get_post_lid()
{
	$lid = null;
	if ( isset($_POST['lid']) )
	{
		$lid = intval($_POST['lid']);
	}
	return $lid;
}

function get_post_passwd()
{
	$passwd = null;
	if ( isset($_POST['passwd']) )
	{
		$passwd = $_POST['passwd'];
	}
	return $passwd;
}

function print_form_lid( $flag_pass=false )
{
	echo '<form method="post">';
	echo 'lid <input type="text" name="lid"> ';

	if ( $flag_pass )
	{
		echo '<br />';
		echo 'passwd <input type="text" name="passwd"> ';
		echo '<br />';
	}

	echo '<input type="submit" name="submit">';
	echo '</form>';
}

//---------------------------------------------------------
// user delete
//---------------------------------------------------------
function user_delete_link_with_login( $param )
{
//	echo "user_delete_link_with_login <br />\n";

	$ret = $this->login_user();
	if ( !$ret )	{	return false;	}

	$ret = $this->user_delete_link( $param );
	if ( !$ret )	{	return false;	}

	$ret = $this->user_delete_reason();
	if ( !$ret )	{	return false;	}

	$this->_newid = null;
	if ( isset($param['return']) )
	{
		if ( !$this->match_return_msg( $param['return'] ) )
		{
			$this->print_error( "Error: delete link failed: msg unmatch " ); 
			echo "<hr />\n";
			echo $this->get_body() ."<br /><br />\n";
			return false;
		}
		if ( empty( $this->_newid ) )
		{
			$this->print_error( "Error: delete link failed: cannot get newid " ); 
			echo "<hr />\n";
			echo $this->get_body() ."<br /><br />\n";
			return false;
		}
	}

	$ret = $this->logout();
	if ( !$ret )	{	return false;	}

	return true;
}

function user_delete_link( &$param )
{
	$lid = isset($param['lid']) ? $param['lid'] : 0;

	$this->_lid = $lid;

	$link_form_url = $this->_user_modify_url.'?lid='.$lid;

	$ret = $this->fetch_form($link_form_url);
	if ( !$ret )	{	return false;	}

	$form_values = $this->get_form_values();
	if ( !isset($form_values['lid']) )
	{
		$this->print_error( "Error: cannot get lid " ); 
		echo $this->get_body() ."<br /><br />\n";
		return false;
	}

// post op=delete
	$form = $this->build_form_del( $form_values );

	$ret = $this->submit_form( $form['action'], $form );
	if ( !$ret )	{	return false;	}

	return true;
}

function user_delete_reason()
{
	$form_values = $this->get_form_values();
	if ( !isset($form_values['lid']) )
	{
		$this->print_error( "Error: cannot get lid " ); 
		echo $this->get_body() ."<br /><br />\n";
		return false;
	}

	$form = $this->build_form_del_reason( $form_values );

	$ret = $this->submit_form( $form['action'], $form );
	if ( !$ret )	{	return false;	}

	return true;
}

function user_delete_confirm()
{
	$form_values = $this->get_form_values();
	if ( !isset($form_values['lid']) )
	{
		$this->print_error( "Error: cannot get lid " ); 
		echo $this->get_body() ."<br /><br />\n";
		return false;
	}

	$form = $this->build_form_del_confirm( $form_values );

	$ret = $this->submit_form( $form['action'], $form );
	if ( !$ret )	{	return false;	}

	return true;
}

//---------------------------------------------------------
// build_link_form
//---------------------------------------------------------
function &build_link_form( &$param )
{
	$op       = isset($param['op'])       ? $param['op']       : null;
	$lid      = isset($param['lid'])      ? $param['lid']      : 0;
	$name     = isset($param['name'])     ? $param['name']     : null;
	$title    = isset($param['title'])    ? $param['title']    : null;
	$banner   = isset($param['banner'])   ? $param['banner']   : null;
	$rss_flag = isset($param['rss_flag']) ? $param['rss_flag'] : 0;
	$rss_url  = isset($param['rss_url'])  ? $param['rss_url']  : null;
	$passwd   = isset($param['passwd'])   ? $param['passwd']   : null;
	$request  = isset($param['request'])  ? $param['request']  : null;
	$notify   = isset($param['notify'])   ? $param['notify']   : 0;

	$param['flag_uid']      = 0;	// system param;
	$param['mode_dhtml']    = 1;	// all 1
	$param['flag_rssc_lid'] = 0;	// not update

	$arr =& $this->build_link_record_from_param( $param );

	$arr['submit']         = 'submit';
	$arr['XOOPS_G_TICKET'] = $this->get_ticket();

	$arr['op']         = $op;
	$arr['lid']        = $lid;
	$arr['banner']     = $banner;
	$arr['rss_url']    = $rss_url;
	$arr['rss_flag']   = $rss_flag;
	$arr['notify']     = $notify;
	$arr['request']    = $request;

	if ( $passwd )
	{
    	$arr['passwd_new'] = $passwd;
    	$arr['passwd_2']   = $passwd;
    	$arr['passwd_old'] = $passwd;
	}
	else
	{
    	$arr['passwd_new'] = $arr['passwd'];
    	$arr['passwd_2']   = $arr['passwd'];
    	$arr['passwd_old'] = $arr['passwd'];
	}

	$this->_build_form_array =& $arr;
	return $arr;
}

function &build_form_del( $v )
{
	$notify   = isset($v['notify'])   ? $v['notify']   : 0;

	$arr = array(
		'action'          => 'http://localhost' . $v['action'],
		'XOOPS_G_TICKET'  => $v['XOOPS_G_TICKET'],
		'delete'          => 'delete',
		'lid'             => $v['lid'],
		'notify'          => $notify,
	);

	return $arr;
}

function &build_form_del_reason( $v )
{
	$notify     = isset($v['notify'])     ? $v['notify']     : 0;
	$confirm    = isset($v['confirm'])    ? $v['confirm']    : 0;
	$passwd_old = isset($v['passwd_old']) ? $v['passwd_old'] : null;
	$request    = isset($v['request'])    ? $v['request']    : 0;

	$reason  = "reason\n".$this->get_randum_title();

	$arr = array(
		'action'          => 'http://localhost' . $v['action'],
		'XOOPS_G_TICKET'  => $v['XOOPS_G_TICKET'],
		'op'              => $v['op'],
		'lid'             => $v['lid'],
		'confirm'         => $confirm,
		'notify'          => $notify,
		'reason'          => $reason,
		'passwd_old'      => $passwd_old,
		'request'         => $request,
	);

	return $arr;
}

function &build_form_del_confirm( $v )
{
	$passwd_old = isset($v['passwd_old']) ? $v['passwd_old'] : null;
	$request    = isset($v['request'])    ? $v['request']    : 0;

	$arr = array(
		'action'          => 'http://localhost' . $v['action'],
		'XOOPS_G_TICKET'  => $v['XOOPS_G_TICKET'],
		'op'              => $v['op'],
		'lid'             => $v['lid'],
		'confirm'         => $v['confirm'],
		'passwd_old'      => $passwd_old,
		'request'         => $request,
	);

	return $arr;
}

function build_rss_url( $id )
{
	$text =  WEBLINKS_URL.'/dev/rss.php?id='.$id;
	return $text;
}

//---------------------------------------------------------
// compare check
//---------------------------------------------------------
function check_msg_and_new_link( $str )
{
	if ( $this->match_return_msg( $str ) )
	{
// newid is set by match_return_msg()
		return $this->check_link( $this->_newid, $this->_build_form_array );
	}

	$this->print_error( "Error: ummatch return msg : ". $str ); 
	return false;
}

function check_msg_and_link( $str )
{
	if ( $this->match_return_msg( $str ) )
	{
		return $this->check_link( $this->_lid, $this->_build_form_array );
	}

	$this->print_error( "Error: ummatch return msg : ". $str ); 
	return false;
}

function check_link( $lid, $expect )
{
	$row =& $this->get_link( $lid );
	if ( is_array($row) )
	{
		if ( $row['title'] != $expect['title']  )
		{
			$msg = "ummatch title: ".$row['title']." != ". $expect['title'];
			$this->print_error( $msg ); 
			return false;
		}
		if ( $row['banner'] != $expect['banner']  )
		{
			$msg = "ummatch banner: ".$row['banner']." != ". $expect['banner'];
			$this->print_error( $msg ); 
			return false;
		}
		if ( $this->is_exist_rssc_module() && $expect['rss_flag'] )
		{
			return $this->check_rssc_link( $row['rssc_lid'], $expect );
		}
		return true;
	}

	echo "no link : lid = ". $lid ."<br />\n";
	return false;
}

function check_rssc_link( $rssc_lid, $expect )
{
	$row =& $this->get_rssc_link( $rssc_lid );
	if ( is_array($row) )
	{
		if ( $row['rss_url'] != $expect['rss_url']  )
		{
			$msg = "ummatch rss_url: ".$row['rss_url']." != ". $expect['rss_url'];
			$this->print_error( $msg ); 
			return false;
		}
		return $this->check_rssc_feed( $rssc_lid );
	}

	echo "no rssc link : rssc_lid = ". $rssc_lid ."<br />\n";
	return false;
}

function check_rssc_feed( $rssc_lid )
{
	if ( $this->get_rssc_feed_count_by_rssc_link( $rssc_lid ) )
	{
		return true;
	}
	$this->print_error( "no rssc feed : rssc_lid = ". $rssc_lid ); 
	return false;
}

function check_link_title( $lid, $title )
{
	$row =& $this->get_link( $lid );
	if ( is_array($row) )
	{
		if ( $title == $row['title'] )
		{
			return true;
		}
	}
	return false;
}

//---------------------------------------------------------
// RSSC module
//---------------------------------------------------------
function is_exist_rssc_module()
{
	return $this->is_exist_module( $this->get_config_by_name( 'rss_dirname' ) );
}

// --- class end ---
}

?>