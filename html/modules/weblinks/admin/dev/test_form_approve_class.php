<?php
// $Id: test_form_approve_class.php,v 1.1 2011/12/29 14:32:57 ohwada Exp $

// 2008-02-17 K.OHWADA
// print_error()

//=========================================================
// WebLinks Module
// 2007-09-01 K.OHWADA
//=========================================================

//=========================================================
// class weblinks_test_form_approve
//=========================================================
class weblinks_test_form_approve extends weblinks_test_form_admin
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_test_form_approve()
{
	$this->weblinks_test_form_admin();

	$this->_admin_approve_new_url = WEBLINKS_URL.'/admin/link_manage.php?op=list_new&mid=';
	$this->_admin_approve_mod_url = WEBLINKS_URL.'/admin/link_manage.php?op=list_mod&mid=';
	$this->_admin_approve_del_url = WEBLINKS_URL.'/admin/link_manage.php?op=list_del&mid=';
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new weblinks_test_form_approve();
	}
	return $instance;
}

//---------------------------------------------------------
// approve new link
//---------------------------------------------------------
function admin_approve_new_with_login( $mid=null )
{
	$ret = $this->login_admin();
	if ( !$ret )	{	return false;	}

	$ret = $this->admin_fetch_approve_new( $mid );
	if ( !$ret )	{	return false;	}

	$ret = $this->admin_approve_new( false );
	if ( !$ret )	{	return false;	}

	return true;
}

function admin_fetch_approve_new( $mid=null )
{
	if ( empty($mid) )
	{
		$mid = $this->get_newid();
	}

	$ret = $this->fetch_form( $this->_admin_approve_new_url.$mid );
	if ( !$ret )	{	return false;	}

	return true;
}

function admin_approve_new( $flag_refuse_new=false )
{
	$form_values = $this->get_form_values();

	if ( !isset($form_values['mid']) )
	{
		$this->print_error( "Error: cannot get mid " );
		echo $this->get_body() ."<br /><br />\n";
		return false;
	}

	$form =& $this->build_form_admin_modify( $form_values );

	if ( $flag_refuse_new )
	{
		$form['refuse_new'] = 'refuse_new';
	}

	$ret = $this->submit_form( $form['action'], $form );
	if ( !$ret )	{	return false;	}

	return true;
}

function admin_approve_new_send_notify()
{
	return $this->_admin_approve_send_notify();
}

function _admin_approve_send_notify()
{
	$form_values = $this->get_form_values();
	if ( !isset($form_values['_hidden_lid']) )
	{
		$this->print_error( "Error: cannot get lid " );
		echo $this->get_body() ."<br /><br />\n";
		return false;
	}

	$this->_lid = $form_values['_hidden_lid'];

	$form =& $this->build_form_approve_notify( $form_values );

	$ret = $this->submit_form( $form['action'], $form );
	if ( !$ret )	{	return false;	}

	return true;
}

function admin_add_link_add_rssc_from_post()
{
	if ( !$this->is_exist_rssc_module() )
	{
		echo "Skip this test: RSSC module is not installed <br />\n";
		return true;
	}

	$this->update_config_by_name( 'rss_use', 1 );

	$form_values = $this->get_form_values();
	if ( !isset($form_values['link_lid']) )
	{
		$this->print_error( "Error: cannot get lid " );
		echo $this->get_body() ."<br /><br />\n";
		return false;
	}

	$form =& $this->build_form_rssc( $form_values );

	$ret = $this->submit_form( $form['action'], $form );
	if ( !$ret )	{	return false;	}

	return true;
}

function admin_add_link_refresh()
{
	$form_values = $this->get_form_values();
	if ( !isset($form_values['rssc_lid']) )
	{
		$this->print_error( "Error: cannot get rssc_lid " );
		echo $this->get_body() ."<br /><br />\n";
		return false;
	}

	$form =& $this->build_form_refresh( $form_values );

	$ret = $this->submit_form( $form['action'], $form );
	if ( !$ret )	{	return false;	}

	return true;
}

//---------------------------------------------------------
// refuse new link
//---------------------------------------------------------
function admin_refuse_new_with_login( $mid=null )
{
	$ret = $this->login_admin();
	if ( !$ret )	{	return false;	}

	$ret = $this->admin_fetch_approve_new( $mid );
	if ( !$ret )	{	return false;	}

	$ret = $this->admin_approve_new( true );
	if ( !$ret )	{	return false;	}

	return true;
}

function admin_refuse_new_send_notify()
{
	return $this->_admin_refuse_send_notify();
}

function _admin_refuse_send_notify()
{
	$form_values = $this->get_form_values();
	if ( !isset($form_values['to_email']) )
	{
		$this->print_error( "Error: cannot get to_email " );
		echo $this->get_body() ."<br /><br />\n";
		return false;
	}

	$form =& $this->build_form_refuse_notify( $form_values );

	$ret = $this->submit_form( $form['action'], $form );
	if ( !$ret )	{	return false;	}

	return true;
}

//---------------------------------------------------------
// approve mod link
//---------------------------------------------------------
function admin_approve_mod_with_login( $mid=null )
{
	$ret = $this->login_admin();
	if ( !$ret )	{	return false;	}

	$ret = $this->admin_fetch_approve_mod( $mid );
	if ( !$ret )	{	return false;	}

	$ret = $this->admin_approve_mod( false );
	if ( !$ret )	{	return false;	}

	return true;
}

function admin_fetch_approve_mod( $mid=null )
{
	if ( empty($mid) )
	{
		$mid = $this->get_newid();
	}

	$ret = $this->fetch_form( $this->_admin_approve_mod_url.$mid );
	if ( !$ret )	{	return false;	}

	return true;
}

function admin_approve_mod( $flag_ignore=false )
{
	$form_values = $this->get_form_values();
	if ( !isset($form_values['mid']) )
	{
		$this->print_error( "Error: cannot get mid " );
		echo $this->get_body() ."<br /><br />\n";
		return false;
	}

	$form =& $this->build_form_admin_modify( $form_values );

	if ( $flag_ignore )
	{
		$form['ignore'] = 'ignore';
	}

	$ret = $this->submit_form( $form['action'], $form );
	if ( !$ret )	{	return false;	}

	return true;
}

function admin_approve_mod_send_notify()
{
	return $this->_admin_approve_send_notify();
}

//---------------------------------------------------------
// refuse mod link
//---------------------------------------------------------
function admin_refuse_mod_with_login( $mid=null )
{
	$ret = $this->login_admin();
	if ( !$ret )	{	return false;	}

	$ret = $this->admin_fetch_approve_mod( $mid );
	if ( !$ret )	{	return false;	}

	$ret = $this->admin_approve_mod( true );
	if ( !$ret )	{	return false;	}

	return true;
}

function admin_refuse_mod_send_notify()
{
	return $this->_admin_refuse_send_notify();
}


//---------------------------------------------------------
// approve del link
//---------------------------------------------------------
function admin_approve_del_with_login( $mid=null )
{
	$ret = $this->login_admin();
	if ( !$ret )	{	return false;	}

	$ret = $this->admin_fetch_approve_del( $mid );
	if ( !$ret )	{	return false;	}

	$ret = $this->admin_approve_del( false );
	if ( !$ret )	{	return false;	}

	return true;
}

function admin_fetch_approve_del( $mid=null )
{
//	echo "admin_fetch_approve_del <br />\n";

	if ( empty($mid) )
	{
		$mid = $this->get_newid();
	}

	$ret = $this->fetch_form( $this->_admin_approve_del_url.$mid );
	if ( !$ret )	{	return false;	}

	return true;
}

function admin_approve_del( $flag_ignore=false )
{
//	echo "admin_approve_del <br />\n";

	$form_values = $this->get_form_values();
	if ( !isset($form_values['mid']) )
	{
		echo " admin_approve_del <br />\n";
		$this->print_error( "Error: cannot get mid " );
		echo $this->get_body() ."<br /><br />\n";
		return false;
	}

	$form =& $this->build_form_admin_delete( $form_values );

	if ( $flag_ignore )
	{
		$form['refuse_del'] = 'refuse_del';
	}

	$ret = $this->submit_form( $form['action'], $form );
	if ( !$ret )	{	return false;	}

	return true;
}

function admin_approve_del_confirm( )
{
	$form_values = $this->get_form_values();
	if ( !isset($form_values['mid']) )
	{
		echo " admin_approve_del_confirm <br />\n";
		$this->print_error( "Error: cannot get mid " );
		echo $this->get_body() ."<br /><br />\n";
		return false;
	}

	$this->_mid = $form_values['mid'];
	$form =& $this->build_form_approve_del_confirm( $form_values );

	$ret = $this->submit_form( $form['action'], $form );
	if ( !$ret )
	{
		return false;
	}
	return true;

}

function admin_approve_del_send_notify()
{
	return $this->_admin_approve_send_notify();
}

//---------------------------------------------------------
// refuse del link
//---------------------------------------------------------
function admin_refuse_del_with_login( $mid=null )
{
//	echo "admin_refuse_del_with_login <br />\n";

	$ret = $this->login_admin();
	if ( !$ret )	{	return false;	}

	$ret = $this->admin_fetch_approve_del( $mid );
	if ( !$ret )	{	return false;	}

	$ret = $this->admin_approve_del( true );
	if ( !$ret )	{	return false;	}

	return true;
}

function admin_refuse_del_send_notify()
{
	return $this->_admin_refuse_send_notify();
}

//---------------------------------------------------------
// build form
//---------------------------------------------------------
function &build_form_admin_modify( $v )
{
	if ( !isset($v['description']) && isset($v['weblinks_description']) )
	{
		$v['description'] = $v['weblinks_description'];
	}
	if ( !isset($v['textarea1']) && isset($v['weblinks_textarea1']) )
	{
		$v['textarea1'] = $v['weblinks_textarea1'];
	}

	if ( empty($v['description']) )
	{
		$v['description'] = "description \n" . $this->get_randum_title() ."\n" . $this->get_randum_dhtml();
	}

	if ( !isset($v['title']) || empty($v['title']) )
	{
		$v['title'] = $this->_build_form_array['title'];
	}

	$arr =& $this->assign_modify( $v );

	$arr['weblinks_description'] = $arr['description'];
	$arr['weblinks_textarea1']   = $arr['textarea1'];

	$arr['action']               = 'http://localhost' . $v['action'];
	$arr['XOOPS_G_TICKET']       = $v['XOOPS_G_TICKET'];
	$arr['op']                   = $v['op'];
	$arr['cid']                  = $v['cid_arr'];
	$arr['time_publish_year']    = $v['time_publish_year'];
	$arr['time_publish_month']   = $v['time_publish_month'];
	$arr['time_publish_day']     = $v['time_publish_day'];
	$arr['time_publish_hour']    = $v['time_publish_hour'];
	$arr['time_publish_min']     = $v['time_publish_min'];
	$arr['time_expire_year']     = $v['time_expire_year'];
	$arr['time_expire_month']    = $v['time_expire_month'];
	$arr['time_expire_day']      = $v['time_expire_day'];
	$arr['time_expire_hour']     = $v['time_expire_hour'];
	$arr['time_expire_min']      = $v['time_expire_min'];
	$arr['time_update_flag_update'] = $v['time_update_flag_update'];

	$arr['time_publish_flag'] = isset($v['time_publish_flag']) ? $v['time_publish_flag'] : 0;
	$arr['time_expire_flag']  = isset($v['time_expire_flag'])  ? $v['time_expire_flag']  : 0;

	$arr['uid_confirm']  = 1;
	$arr['name_confirm'] = 1;
	$arr['mail_confirm'] = 1;

	return $arr;
}

function &build_form_approve_notify( $v )
{
	$_hidden_lid      = isset($v['_hidden_lid'])      ? intval($v['_hidden_lid'])      : 0;
	$_hidden_rss_flag = isset($v['_hidden_rss_flag']) ? intval($v['_hidden_rss_flag']) : 0;
	$_hidden_title    = isset($v['_hidden_title'])    ? $v['_hidden_title']   : '';
	$_hidden_url      = isset($v['_hidden_url'])      ? $v['_hidden_url']     : '';
	$_hidden_rss_url  = isset($v['_hidden_rss_url'])  ? $v['_hidden_rss_url'] : '';

	$arr = array(
		'action'           => 'http://localhost' . $v['action'],
		'XOOPS_G_TICKET'   => $v['XOOPS_G_TICKET'],
		'op'               => $v['op'],
		'_hidden_lid'      => $_hidden_lid,
		'_hidden_rss_flag' => $_hidden_rss_flag,
		'_hidden_title'    => $_hidden_title,
		'_hidden_url'      => $_hidden_url,
		'_hidden_rss_url'  => $_hidden_rss_url,
		'to_email'         => $v['to_email'],
		'from_name'        => $v['from_name'],
		'from_email'       => $v['from_email'],
		'subject'          => $v['subject'],
		'body'             => $v['body'],
	);

	return $arr;
}

function &build_form_refuse_notify( $v )
{
	$arr = array(
		'action'           => 'http://localhost' . $v['action'],
		'XOOPS_G_TICKET'   => $v['XOOPS_G_TICKET'],
		'op'               => $v['op'],
		'to_email'         => $v['to_email'],
		'from_name'        => $v['from_name'],
		'from_email'       => $v['from_email'],
		'subject'          => $v['subject'],
		'body'             => $v['body'],
	);

	return $arr;
}

function &build_form_admin_delete( $v )
{
	$arr = array(
		'action'           => 'http://localhost' . $v['action'],
		'XOOPS_G_TICKET'   => $v['XOOPS_G_TICKET'],
		'op'               => $v['op'],
		'mid'              => $v['mid'],
	);

	return $arr;
}

function &build_form_approve_del_confirm( $v )
{
	$arr = array(
		'action'           => 'http://localhost' . $v['action'],
		'XOOPS_G_TICKET'   => $v['XOOPS_G_TICKET'],
		'op'               => $v['op'],
		'mid'              => $v['mid'],
	);

	return $arr;
}

// --- class end ---
}

?>