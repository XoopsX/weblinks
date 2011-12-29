<?php
// $Id: test_class_user_class.php,v 1.1 2011/12/29 14:32:59 ohwada Exp $

// 2007-10-30 K.OHWADA
// comment for mode_user_perm

// 2007-09-01 K.OHWADA
// v1.70: user can change time_publish
// user can change rss_url

// 2007-05-18 K.OHWADA
// gm_type

// 2007-02-20 K.OHWADA
// user can use textarea1

//=========================================================
// WebLinks Module
// 2006-12-10 K.OHWADA
//=========================================================

//---------------------------------------------------------
// $mode_user_perm
//   0: auth_dohtml , etc = ADMIN
//      linkitem url, etc = 0
//   1: auth_dohtml , etc = ADMIN and ( USERS or ANONYMOUS )
//      linkitem url, etc = 1
//---------------------------------------------------------

//=========================================================
// class weblinks_test_class_user
//=========================================================
class weblinks_test_class_user extends weblinks_test_class
{
	var $_config_handler;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_test_class_user()
{
	$this->weblinks_test_class();

	$this->set_debug_db_sql( false );

	$this->_config_handler =& weblinks_get_handler( 'config2_basic', WEBLINKS_DIRNAME );
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new weblinks_test_class_user();
	}
	return $instance;
}

//---------------------------------------------------------
// user mode
//---------------------------------------------------------
function print_user_mode()
{
	$user = 'unknown';
	if ( $this->_system->is_guest() )
	{
		$user = 'guest';
	}
	if ( $this->_system->is_user() )
	{
		$user = 'login user';
	}
	if ( $this->_system->is_module_admin() )
	{
		$user = '<span style="color:#ff0000;">module admin</span>';
	}
	echo "user mode: $user <br />\n";
}

//---------------------------------------------------------
// user add link
//---------------------------------------------------------
function test_user_add_link( &$param_user )
{
	$flag = false;

	$mode_user_perm    = $this->get_from_array($param_user, 'mode_user_perm');
	$mode_passwd_guest = $this->get_from_array($param_user, 'mode_passwd_guest');
	$mode_dhtml        = $this->get_from_array($param_user, 'mode_dhtml');

	$not_gpc     = 0;
	$flag_banner = 1;
	$mode_passwd = $this->get_permit_mode_passwd($mode_passwd_guest);

	$param_user['mode_passwd'] = $mode_passwd;

	$this->set_permit_config(   $mode_user_perm );
	$this->set_permit_linkitem( $mode_user_perm );

	$obj =& $this->create_link_save();

	list($inputs, $expects) 
		= $this->build_input_expect_user( $obj->gets(), $param_user );

	$excludes =& $this->build_excludes( $mode_passwd );

	$times = array('time_create', 'time_update');

	$obj->assign_add_object( $inputs, $not_gpc, $flag_banner );

	echo "<br /><br />\n";

	$ret = $this->check_match( $obj->gets(), $expects, $times, $excludes );

	if ( $this->_flag_print_detail )
	{
		echo "<br />\n";
		$this->print_box('description', $obj->description_disp() );
	}

	return $ret;
}

//---------------------------------------------------------
// user mod link
//---------------------------------------------------------
function test_user_mod_link( &$param_user )
{
	$flag = false;

	$mode_user_perm    = $this->get_from_array($param_user, 'mode_user_perm');
	$mode_passwd_guest = $this->get_from_array($param_user, 'mode_passwd_guest');
	$mode_dhtml        = $this->get_from_array($param_user, 'mode_dhtml');

	$not_gpc     = false;
	$flag_banner = true;
	$mode_passwd = $this->get_permit_mode_passwd($mode_passwd_guest);

	$param_user['mode_passwd'] = $mode_passwd;

	$this->set_permit_config(   $mode_user_perm );
	$this->set_permit_linkitem( $mode_user_perm );

	$saves =& $this->build_saves();

	$obj =& $this->create_link_save();
	$obj->assignVars( $saves );

	list($inputs, $expects) 
		= $this->build_input_expect_user( $obj->gets(), $param_user );

	$expects['time_create'] = $saves['time_create'];

	if ( $mode_user_perm == 0 )
	{
		$expects['width']  = $this->_WIDTH;
		$expects['height'] = $this->_HEIGHT;
	}

	if ($mode_passwd == 0)
	{
		$expects['passwd'] = $saves['passwd'];
	}

	$excludes =& $this->build_excludes(1);

	$times = array('time_update');

	$obj->assign_mod_object( $inputs, $not_gpc, $flag_banner );

	echo "<br /><br />\n";

	$ret = $this->check_match( $obj->gets(), $expects, $times, $excludes );

	if ( $this->_flag_print_detail )
	{
		echo "<br />\n";
		$this->print_box('description', $obj->description_disp() );
	}

	return $ret;
}

//---------------------------------------------------------
// user add modify
//---------------------------------------------------------
function test_user_add_modify( &$param_user )
{
	$flag = false;

	$mode_user_perm    = $this->get_from_array($param_user, 'mode_user_perm');
	$mode_passwd_guest = $this->get_from_array($param_user, 'mode_passwd_guest');
	$mode_dhtml        = $this->get_from_array($param_user, 'mode_dhtml');

	$modify_mode = 0;
	$mode_passwd = $this->get_permit_mode_passwd($mode_passwd_guest);

	$param_user['modify_mode'] = $modify_mode;
	$param_user['mode_passwd'] = $mode_passwd;

	$this->set_permit_config(   $mode_user_perm );
	$this->set_permit_linkitem( $mode_user_perm );

	$obj =& $this->create_modify_save();

	list($inputs, $expects) 
		= $this->build_input_expect_user_modify( $obj->gets(), $param_user );

	$excludes =& $this->build_excludes( $mode_passwd );

	$times = array('time_create', 'time_update');

	$obj->assign_add_object( $inputs, $modify_mode );

	echo "<br /><br />\n";

	$ret = $this->check_match( $obj->gets(), $expects, $times, $excludes );

	if ( $this->_flag_print_detail )
	{
		echo "<br />\n";
		$this->print_box('description', $obj->description_disp() );
	}

	return $ret;
}

//---------------------------------------------------------
// user mod modify
//---------------------------------------------------------
function test_user_mod_modify( $param_user )
{
	$flag = false;

	$mode_user_perm    = $this->get_from_array($param_user, 'mode_user_perm');
	$mode_passwd_guest = $this->get_from_array($param_user, 'mode_passwd_guest');
	$mode_dhtml        = $this->get_from_array($param_user, 'mode_dhtml');

	$modify_mode = 1;
	$mode_passwd = $this->get_permit_mode_passwd($mode_passwd_guest);

	$param_user['modify_mode'] = $modify_mode;
	$param_user['mode_passwd'] = $mode_passwd;

	$this->set_permit_config(   $mode_user_perm );
	$this->set_permit_linkitem( $mode_user_perm );

	$saves =& $this->build_saves();

	$obj =& $this->create_modify_save();
	$obj->assignVars( $saves );

	list($inputs, $expects) 
		= $this->build_input_expect_user_modify( $obj->gets(), $param_user );

	$expects['time_create'] = $saves['time_create'];

	$excludes =& $this->build_excludes( $mode_passwd );

	$times = array('time_update');

	$obj->assign_add_object( $inputs, $modify_mode );

	echo "<br /><br />\n";

	$ret = $this->check_match( $obj->gets(), $expects, $times, $excludes );

	if ( $this->_flag_print_detail )
	{
		echo "<br />\n";
		$this->print_box('description', $obj->description_disp() );
	}

	return $ret;
}

//---------------------------------------------------------
// build_input_expect
//---------------------------------------------------------
function build_input_expect_user( &$saves, &$param_user )
{
	$not_gpc       = false;
	$flag_banner   = true;
	$flag_uid      = 0;
	$flag_time     = 1;
	$flag_rssc_lid = 0;

	$mode_user_perm = $this->get_from_array($param_user, 'mode_user_perm');
	$mode_dhtml     = $this->get_from_array($param_user, 'mode_dhtml');
	$mode_passwd    = $this->get_from_array($param_user, 'mode_passwd');

	$param = array(
		'not_gpc'       => $not_gpc,
		'flag_uid'      => $flag_uid,
		'flag_banner'   => $flag_banner,
		'flag_time'     => $flag_time,
		'mode_dhtml'    => $mode_dhtml,
		'mode_passwd'   => $mode_passwd,
		'flag_rssc_lid' => $flag_rssc_lid,
	);

	list($inputs, $expects) 
		= $this->build_input_expect($param);

	if ( $mode_user_perm == 0 )
	{
		$expects['url']          = $saves['url'];
		$expects['banner']       = $saves['banner'];
		$expects['description']  = $saves['description'];
		$expects['name']         = $saves['name'];
		$expects['nameflag']     = $saves['nameflag'];
		$expects['mail']         = $saves['mail'];
		$expects['mailflag']     = $saves['mailflag'];
		$expects['company']      = $saves['company'];
		$expects['addr']         = $saves['addr'];
		$expects['tel']          = $saves['tel']; 
		$expects['usercomment']  = $saves['usercomment'];
		$expects['zip']          = $saves['zip'];
		$expects['state']        = $saves['state']; 
		$expects['city']         = $saves['city'];
		$expects['addr2']        = $saves['addr2']; 
		$expects['fax']          = $saves['fax'];
		$expects['etc1']         = $saves['etc1'];
		$expects['etc2']         = $saves['etc2'];
		$expects['etc3']         = $saves['etc3'];
		$expects['etc4']         = $saves['etc4'];
		$expects['etc5']         = $saves['etc5'];
		$expects['gm_latitude']  = $saves['gm_latitude'];
		$expects['gm_longitude'] = $saves['gm_longitude'];
		$expects['gm_zoom']      = $saves['gm_zoom'];
		$expects['gm_type']      = $saves['gm_type'];
		$expects['textarea1']    = $saves['textarea1'];
		$expects['textarea2']    = $saves['textarea2'];
		$expects['dohtml']       = $saves['dohtml'];
		$expects['dosmiley']     = $saves['dosmiley'];
		$expects['doxcode']      = $saves['doxcode'];
		$expects['doimage']      = $saves['doimage'];
		$expects['dobr']         = $saves['dobr'];
		$expects['dohtml1']      = $saves['dohtml1'];
		$expects['dosmiley1']    = $saves['dosmiley1'];
		$expects['doxcode1']     = $saves['doxcode1'];
		$expects['doimage1']     = $saves['doimage1'];
		$expects['dobr1']        = $saves['dobr1'];

// v1.70: user can change
		$expects['time_publish'] = $saves['time_publish'];
		$expects['time_expire']  = $saves['time_expire'];

// modify dont have width
		if ( isset($saves['width']) )
		{
			$expects['width']  = $saves['width'];
			$expects['height'] = $saves['height'];
		}
	}

// user can not change
	$expects['hits']         = $saves['hits'];
	$expects['rating']       = $saves['rating'];
	$expects['votes']        = $saves['votes'];
	$expects['comments']     = $saves['comments'];
	$expects['recommend']    = $saves['recommend'];
	$expects['mutual']       = $saves['mutual'];
	$expects['broken']       = $saves['broken'];
	$expects['rssc_lid']     = $saves['rssc_lid'];
	$expects['rss_url']      = $saves['rss_url'];
	$expects['rss_flag']     = $saves['rss_flag'];
	$expects['admincomment'] = $saves['admincomment'];

	return array($inputs, $expects);
}

function build_input_expect_user_modify( &$saves, $param_user )
{
	$mode_user_perm = $this->get_from_array($param_user, 'mode_user_perm');
	$modify_mode    = $this->get_from_array($param_user, 'modify_mode');

	list($inputs, $expects) 
		= $this->build_input_expect_user( $saves, $param_user );

	$inputs['mode']   = $modify_mode;
	$inputs['notify'] = 1;
	$inputs['mid']    = rand(10,100);
	$inputs['muid']   = rand(10,100);

	$expects['mode']   = $modify_mode;
	$expects['notify'] = 1;
	$expects['mid']    = 0;
	$expects['muid']   = $this->_system->get_uid();
	$expects['cids']   = serialize( $inputs['cid'] );

// user can change
	if ( $mode_user_perm > 0 )
	{
		$expects['rss_url']      = $inputs['rss_url'];
		$expects['rss_flag']     = $inputs['rss_flag'];
	}

	return array($inputs, $expects);
}

//---------------------------------------------------------
// set_permit
//---------------------------------------------------------
function get_permit_mode_passwd($mode)
{
	if ( $mode && !$this->_is_xoops_guest )
	{
		$mode = 0;
	}
	return $mode;
}

function set_permit_config($mode)
{
	if ($mode)
	{
		if ( $this->_is_xoops_guest )
		{
			$perm = array(XOOPS_GROUP_ADMIN, XOOPS_GROUP_ANONYMOUS);
		}
		else
		{
			$perm = array(XOOPS_GROUP_ADMIN, XOOPS_GROUP_USERS);
		}
	}
	else
	{
		$perm = array(XOOPS_GROUP_ADMIN);
	}

	$this->update_config_by_name_array( 'auth_dohtml',     $perm );
	$this->update_config_by_name_array( 'auth_dosmiley',   $perm );
	$this->update_config_by_name_array( 'auth_doxcode',    $perm );
	$this->update_config_by_name_array( 'auth_doimage',    $perm );
	$this->update_config_by_name_array( 'auth_dobr',       $perm );
	$this->update_config_by_name_array( 'auth_dohtml_1',   $perm );
	$this->update_config_by_name_array( 'auth_dosmiley_1', $perm );
	$this->update_config_by_name_array( 'auth_doxcode_1',  $perm );
	$this->update_config_by_name_array( 'auth_doimage_1',  $perm );
	$this->update_config_by_name_array( 'auth_dobr_1',     $perm );
	$this->update_config_by_name_array( 'use_passwd',      $mode );

// reload config
	$this->_config_handler->load_config();

}

function set_permit_linkitem($use)
{
	$this->update_linkitem_user_mode_by_name( 'url',          $use );
	$this->update_linkitem_user_mode_by_name( 'description',  $use );
	$this->update_linkitem_user_mode_by_name( 'banner',       $use );
	$this->update_linkitem_user_mode_by_name( 'rss_url',      $use );
	$this->update_linkitem_user_mode_by_name( 'name',         $use );
	$this->update_linkitem_user_mode_by_name( 'mail',         $use );
	$this->update_linkitem_user_mode_by_name( 'company',      $use );
	$this->update_linkitem_user_mode_by_name( 'zip',          $use );
	$this->update_linkitem_user_mode_by_name( 'state',        $use );
	$this->update_linkitem_user_mode_by_name( 'city',         $use );
	$this->update_linkitem_user_mode_by_name( 'addr',         $use );
	$this->update_linkitem_user_mode_by_name( 'addr2',        $use );
	$this->update_linkitem_user_mode_by_name( 'tel',          $use );
	$this->update_linkitem_user_mode_by_name( 'fax',          $use );
	$this->update_linkitem_user_mode_by_name( 'map_use',      $use );
	$this->update_linkitem_user_mode_by_name( 'gm_latitude',  $use );
	$this->update_linkitem_user_mode_by_name( 'gm_longitude', $use );
	$this->update_linkitem_user_mode_by_name( 'gm_zoom',      $use );
	$this->update_linkitem_user_mode_by_name( 'gm_type',      $use );
	$this->update_linkitem_user_mode_by_name( 'etc1',         $use );
	$this->update_linkitem_user_mode_by_name( 'etc2',         $use );
	$this->update_linkitem_user_mode_by_name( 'etc3',         $use );
	$this->update_linkitem_user_mode_by_name( 'etc4',         $use );
	$this->update_linkitem_user_mode_by_name( 'etc5',         $use );
	$this->update_linkitem_user_mode_by_name( 'textarea1',    $use );
	$this->update_linkitem_user_mode_by_name( 'textarea2',    $use );
	$this->update_linkitem_user_mode_by_name( 'usercomment',  $use );

// v1.70: user can change
	$this->update_linkitem_user_mode_by_name( 'time_publish',  $use );
	$this->update_linkitem_user_mode_by_name( 'time_expire',   $use );

}

// --- class end ---
}

?>