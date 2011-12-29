<?php
// $Id: test_class_class.php,v 1.1 2011/12/29 14:32:57 ohwada Exp $

// 2007-11-01 K.OHWADA
// approve_new

// 2007-03-01 K.OHWADA
// user can use textarea1
// user & admin can not change hits

//=========================================================
// WebLinks Module
// 2006-09-20 K.OHWADA
//=========================================================

//---------------------------------------------------------
// $mode_passwd
//   0: default password
//   1: add password
//   2: approve password
//   3: approve request password
//---------------------------------------------------------

//=========================================================
// class weblinks_test_class
//=========================================================
class weblinks_test_class extends weblinks_gen_record
{
	var $_flag_print_detail = false;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_test_class()
{
	$this->weblinks_gen_record();
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new weblinks_test_class();
	}
	return $instance;
}

//---------------------------------------------------------
// create new object
//---------------------------------------------------------
function &create_link_save($isNew = true)
{
	$obj =& new weblinks_link_save( WEBLINKS_DIRNAME );
	if ($isNew)
	{	$obj->setNew();	}
	return $obj;
}

function &create_modify_save($isNew = true)
{
	$obj =& new weblinks_modify_save( WEBLINKS_DIRNAME );
	if ($isNew)
	{	$obj->setNew();	}
	return $obj;
}

//---------------------------------------------------------
// admin add link
//---------------------------------------------------------
function test_admin_add_link( &$param )
{
	$flag = false;

	$not_gpc       = $this->get_from_array($param, 'not_gpc');
	$flag_banner   = $this->get_from_array($param, 'flag_banner');
	$flag_time     = $this->get_from_array($param, 'flag_time');
	$mode_dhtml    = $this->get_from_array($param, 'mode_dhtml');
	$mode_passwd   = $this->get_from_array($param, 'mode_passwd');

	$param['flag_uid']      = 1;
	$param['flag_rssc_lid'] = 0;

	list($inputs, $expects) 
		= $this->build_input_expect($param);

	$expects['rssc_lid'] = 0;

	$excludes =& $this->build_excludes($mode_passwd);

	$times = array('time_create', 'time_update');

	$obj =& $this->create_link_save();
	$obj->assign_add_object( $inputs, $not_gpc, $flag_banner );

	echo "<br /><br />\n";

	$ret = $this->check_match( $obj->gets(), $expects, $times, $excludes );

	if ( $this->_flag_print_detail )
	{
		echo "<br />\n";
		$this->print_box('description', $obj->description_disp() );
		$this->print_box('textarea1',   $obj->textarea1_disp() );
		$this->print_box('textarea2',   $obj->textarea2_disp() );
	}

	return $ret;
}

//---------------------------------------------------------
// admin mod link
//---------------------------------------------------------
function test_admin_mod_link( &$param )
{
	$flag    = false;
	$times   = null;
	$not_gpc = 0; 

	$flag_banner   = $this->get_from_array($param, 'flag_banner');
	$flag_time     = $this->get_from_array($param, 'flag_time');
	$mode_dhtml    = $this->get_from_array($param, 'mode_dhtml');
	$mode_passwd   = $this->get_from_array($param, 'mode_passwd');
	$flag_rssc_lid = $this->get_from_array($param, 'flag_rssc_lid');

	$param['not_gpc']  = $not_gpc;
	$param['flag_uid'] = 1;

	$saves =& $this->build_saves();

	list($inputs, $expects) 
		= $this->build_input_expect($param);

	$expects['time_update'] = $saves['time_update'];
	$expects['rss_url']     = $saves['rss_url'];
	$expects['rss_flag']    = $saves['rss_flag'];

// user & admin can not chnage
	$expects['time_create'] = $saves['time_create'];
	$expects['hits']        = $saves['hits'];
	$expects['rating']      = $saves['rating'];
	$expects['votes']       = $saves['votes'];
	$expects['comments']    = $saves['comments'];

	if ( $flag_time )
	{
		$times[] = 'time_update';
	}
	else
	{
		$expects['time_update'] = $saves['time_update'];
	}

	if ($mode_passwd == 0)
	{
		$expects['passwd'] = $saves['passwd'];
	}

	if ( !$flag_rssc_lid )
	{
		$expects['rssc_lid'] = $saves['rssc_lid'];
	}

	$excludes =& $this->build_excludes(1);

	$obj =& $this->create_link_save();
	$obj->setVars( $saves );
	$obj->assign_mod_object( $inputs, $not_gpc, $flag_banner );

	echo "<br /><br />\n";

	$ret = $this->check_match( $obj->gets(), $expects, $times, $excludes );

	if ( $this->_flag_print_detail )
	{
		echo "<br />\n";
		$this->print_box('description', $obj->description_disp() );
		$this->print_box('textarea1',   $obj->textarea1_disp() );
		$this->print_box('textarea2',   $obj->textarea2_disp() );
	}

	return $ret;
}

//---------------------------------------------------------
// check_match
//---------------------------------------------------------
function check_match( &$results, &$expects, &$times=null , &$excludes=null )
{
	$flag_result = false;

	foreach( $results as $k => $v )
	{
		$flag = false;
		$msg = $k.': '.$v;
		$msg = htmlspecialchars($msg, ENT_QUOTES);

		if ( is_array($excludes) && in_array($k, $excludes) )
		{
			if ( $this->_flag_print_detail )
			{
				$msg = '<b>skip</b> '.$msg;
				$this->print_msg( $msg );
			}
			continue;	
		}

		$e = $expects[$k];

		if ( is_array($times) && in_array($k, $times) )
		{
			$time = time();
			$time_before = $time - 10;	// 10 sec before
			if (($v < $time_before) || ($v > $time))
			{
				$msg = 'unmtach time '.$msg.' =! '.$time;
				$msg = htmlspecialchars($msg, ENT_QUOTES);
				$this->print_error( $msg );
				$flag = true;
			}
		}
		else
		{
			switch ($k)
			{
				case 'gm_latitude':
				case 'gm_longitude':
					if (($v < ($e - $this->_GM_PRECISION)) || ($v > ($e + $this->_GM_PRECISION)))
					{
						$msg = 'unmtach time '.$msg.' =! '.$time;
						$msg = htmlspecialchars($msg, ENT_QUOTES);
						$this->print_error( $msg );
						$flag = true;
					}
					break;

				default:
					if ($v != $e)
					{
						$msg = 'unmtach '.$msg.' =! '.$e;
						$msg = htmlspecialchars($msg, ENT_QUOTES);
						$this->print_error( $msg );
						$flag = true;
					}
					break;
			}
		}

		if ( $flag )
		{
			$flag_result = true;
		}
		else
		{
			if ( $this->_flag_print_detail )
			{
				$this->print_msg( $msg );
			}
		}
	}

	if ( $flag_result )
	{	return false;	}

	return true;
}

//---------------------------------------------------------
// build_input_expect
//---------------------------------------------------------
function build_input_expect( &$param )
{
	$not_gpc       = $this->get_from_array($param, 'not_gpc');
	$flag_banner   = $this->get_from_array($param, 'flag_banner');
	$flag_uid      = $this->get_from_array($param, 'flag_uid');
	$flag_time     = $this->get_from_array($param, 'flag_time');
	$mode_dhtml    = $this->get_from_array($param, 'mode_dhtml');
	$mode_passwd   = $this->get_from_array($param, 'mode_passwd');
	$flag_rssc_lid = $this->get_from_array($param, 'flag_rssc_lid');

	$param['title'] = $this->get_randum_title();

	$inputs =& $this->build_link_record_from_param( $param );

	$temp =& $inputs;
	$temp['description']  = $inputs['weblinks_description'];
	$temp['textarea1']    = $inputs['weblinks_textarea1'];
	$temp['rss_url']      = '';
	$temp['rss_flag']     = 0;

// user & admin can not change
	$temp['hits']     = 0;
	$temp['rating']   = 0;
	$temp['votes']    = 0;
	$temp['comments'] = 0;

	if ( $flag_banner )
	{
		$inputs['width']  = $this->_WIDTH;
		$inputs['height'] = $this->_HEIGHT;
		$temp['width']    = $this->_WIDTH;
		$temp['height']   = $this->_HEIGHT;
	}
	else
	{
		$inputs['width']  = 0;
		$inputs['height'] = 0;
		$temp['width']    = 0;
		$temp['height']   = 0;
	}

	if ( $flag_time )
	{
		$inputs['time_update_flag_update'] = 1;
		$inputs['time_publish_flag']       = 1;
		$inputs['time_expire_flag']        = 1;
	}
	else
	{
		$temp['time_publish'] = 0;
		$temp['time_expire']  = 0;
	}

	switch ($mode_passwd)
	{
// add password
		case 1:
			$inputs['passwd_new'] = $inputs['passwd'];
			$temp['passwd']       = $inputs['passwd_md5'];
			break;

// approve password
		case 2:
			$inputs['op']   = 'approve_new';
			$temp['passwd'] = $inputs['passwd_md5'];
			break;

// approve request password
		case 3:
			$inputs['op']   = 'approve_mod';
			$temp['passwd'] = $inputs['passwd_md5'];
			break;

// default password
		case 0:
		default:
			break;
	}

	if ( !$not_gpc ) 
	{
		$expects =& $this->_strings->strip_slashes_array_gpc($temp);
	}
	else
	{
		$expects =& $temp;
	}

	return array($inputs, $expects);
}

function &build_saves()
{
	$param = array(
		'title'         => $this->get_randum_title(),
		'flag_uid'      => 1,
		'mode_dhtml'    => 2,
		'flag_rssc_lid' => false,
	);

	$saves =& $this->build_link_record_from_param( $param );

	$saves['description']  = $saves['weblinks_description'];
	$saves['textarea1']    = $saves['weblinks_textarea1'];
	$saves['passwd']       = xoops_makepass();

	return $saves;
}

function &build_excludes($mode_passwd=0)
{
	$excludes = array('search');

	switch ($mode_passwd)
	{
// add password
		case 1:
// approve password
		case 2:
			break;

// default password
		case 0:
		default:
			$excludes[]  = 'passwd';
			break;
	}

	return $excludes;
}

// --- class end ---
}

?>