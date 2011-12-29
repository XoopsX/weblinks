<?php
// $Id: ratelink.php,v 1.1 2011/12/29 14:32:29 ohwada Exp $

// 2007-11-24 K.OHWADA
// check the min of rating

// 2007-10-30 K.OHWADA
// weblinks_auth
// get_token_pair()

// 2007-09-20 K.OHWADA
// PHP5.2
// getInstance()

// 2007-08-01 K.OHWADA
// weblinks_header

// 2007-06-01 K.OHWADA
// header_oh.php

// 2007-03-01 K.OHWADA
// weblinks_link_handler
// system_post_rate

// 2006-10-01 K.OHWADA
// use happy_linux

// 2006-08-29 K.OHWADA
// REQ: countup xoops post count

// 2006-05-15 K.OHWADA
// add weblinks_ratelink()
// use new handler
// use token ticket

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication

//================================================================
// WebLinks Module
// rate link
// 2004/01/23 K.OHWADA
//================================================================

include 'header_oh.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_votedata_handler.php';


//=========================================================
// class weblinks_ratelink
//=========================================================
class weblinks_ratelink extends happy_linux_error
{
	var $_ALLOW_INCREMENT_POST = false;
	var $_MIN_RATING =  1;
	var $_MAX_RATING = 10;

	var $_config_handler;
	var $_link_handler;
	var $_votedata_handler;
	var $_auth;
	var $_system;
	var $_post;
	var $_form;

	var $_conf;

	var $_post_rating;

	var $_sitename;
	var $_system_is_user;
	var $_system_uid;

	var $_remote_addr;

	var $_title_s;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_ratelink( $dirname )
{
	$this->happy_linux_error();
	$this->set_debug_print_error( WEBLINKS_DEBUG_ERROR );

	$this->_config_handler   =& weblinks_get_handler( 'config2_basic', $dirname );
	$this->_link_handler     =& weblinks_get_handler( 'link',          $dirname );
	$this->_votedata_handler =& weblinks_get_handler( 'votedata',      $dirname );
	$this->_auth             =& weblinks_auth::getInstance( $dirname );

	$this->_system =& happy_linux_system::getInstance();
	$this->_post   =& happy_linux_post::getInstance();
	$this->_form   =& happy_linux_form::getInstance();
}

function &getInstance( $dirname )
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new weblinks_ratelink( $dirname );
	}
	return $instance;
}

function init()
{
	$this->_conf = $this->_config_handler->get_conf();

	$this->_post_rating = $this->_post->get_post('rating');

	$this->_sitename        = $this->_system->get_sitename();
	$this->_system_is_user  = $this->_system->is_user();
	$this->_system_uid      = $this->_system->get_uid();

	$this->_remote_addr = getenv("REMOTE_ADDR");
}

//---------------------------------------------------------
// get POST
//---------------------------------------------------------
function get_post_submit()
{
	$ret = $this->_post->get_post('submit');
	return $ret;
}

function get_post_get_lid()
{
	$ret = $this->_post->get_post_get_int('lid');
	return $ret;
}

//---------------------------------------------------------
// check_access
//---------------------------------------------------------
function check_access($lid)
{
	$has_auth_ratelink = $this->_auth->has_auth_ratelink();

// not use
	if ( !$this->_conf['use_ratelink'] ) 
	{
		return -1;
	}

// not permit
	if ( !$has_auth_ratelink ) 
	{
		if ( $this->_system_is_user ) 
		{
			return -2;
		}
// anonymous
		else
		{
			return -3;
		}
	}

	if ( ! $this->_link_handler->is_exist($lid) )
	{
		return -4;
	}

	$this->_title_s =  $this->_link_handler->get_title($lid, 's');
	return 0;
}

function get_title()
{
	return $this->_title_s;
}

//---------------------------------------------------------
// rate_link
//---------------------------------------------------------
function check_rate_link( $lid )
{

//Make sure only 1 anonymous from an IP in a single day.
	$ANON_WATIONG_DAYS = 1;

// Check if Rating is Null
   	if ($this->_post_rating == "--") 
   	{
   		return -11;
   	}

// Check if Link POSTER is voting (UNLESS Anonymous users allowed to post)
   	if ( $this->_system_is_user ) 
   	{
		$obj =& $this->_link_handler->get($lid);
		$uid = $obj->getVar('uid');

		if ( $this->_system->is_owner($uid) ) 
		{
			return -12;
		}

		$check = $this->_votedata_handler->check_by_lid_uid($lid, $this->_system_uid);
		if ( $check ) 
		{
			return -13;
		}

   	}
   	else 
   	{
// Check if ANONYMOUS user is trying to vote more than once per day.
		$yesterday = (time()-(86400 * $ANON_WATIONG_DAYS));

		$anonvotecount = $this->_votedata_handler->get_count_by_lid_ip_time($lid, $this->_remote_addr, $yesterday);
   		if ($anonvotecount > 0) 
   		{
			return -14;
       	}
   	}

	return 0;	// OK
}

function rate_link( $lid )
{
	$rating = intval($this->_post_rating);

// check the min of rating
	if ($rating < $this->_MIN_RATING )
	{
		$rating = $this->_MIN_RATING;
	}

	if ($rating > $this->_MAX_RATING )
	{
		$rating = $this->_MAX_RATING;
	}

// Add to Line Item Rate to DB.
	$votedata_obj =& $this->_votedata_handler->create();
	$votedata_obj->setVar('lid',             $lid );
	$votedata_obj->setVar('rating',          $rating );
	$votedata_obj->setVar('ratinguser',      $this->_system_uid );
	$votedata_obj->setVar('ratinghostname',  $this->_remote_addr );
	$votedata_obj->setVar('ratingtimestamp', time() );

	$ret = $this->_votedata_handler->insert($votedata_obj);
	if ( !$ret )
	{
		$this->_set_errors( $this->_votedata_handler->getErrors() );
		return false;
	}

// Calculate Score & Add to Summary (for quick retrieval & sorting) to DB.
	list($votesDB, $finalrating) = $this->_votedata_handler->calc_rating_by_lid($lid);

	$ret = $this->_link_handler->update_rating($lid, $finalrating, $votesDB);
	if ( !$ret )
	{
		$this->_set_errors( $this->_link_handler->getErrors() );
		return false;
	}

// REQ: countup xoops post count
	global $xoopsUser;
	if ( $this->_conf['system_post_rate'] && is_object($xoopsUser) ) 
	{
		$xoopsUser->incrementPost();
	}

	return true;

}

function get_msg_success()
{
	$msg  = _WLS_VOTEAPPRE."<br />";
	$msg .= sprintf( _WLS_THANKURATE, $this->_sitename );
	return $msg;
}


//---------------------------------------------------------
// token
//---------------------------------------------------------
function check_token()
{
	return $this->_form->check_token();
}

function &get_token_pair()
{
	return $this->_form->get_token_pair();
}

// --- class end ---
}


//=========================================================
// main
//=========================================================

$weblinks_template  =& weblinks_template::getInstance( WEBLINKS_DIRNAME );
$weblinks_header    =& weblinks_header::getInstance(   WEBLINKS_DIRNAME );
$weblinks_ratelink  =& weblinks_ratelink::getInstance( WEBLINKS_DIRNAME );

// BUG 2932: dont work correctly when register_long_arrays = off
$submit = $weblinks_ratelink->get_post_submit();
$lid    = $weblinks_ratelink->get_post_get_lid();

$url_singlelink = 'singlelink.php?lid='.$lid;

$weblinks_ratelink->init();
$check = $weblinks_ratelink->check_access($lid);

if (( $check == -1 )||( $check == -2 )) 
{
	redirect_header($url_singlelink, 3, _NOPERM);
	exit();
}

if ( $check == -3 ) 
{
	redirect_header(XOOPS_URL."/user.php", 3, _WLS_MUSTREGFIRST);
	exit();
}

if ( $check == -4 ) 
{
	redirect_header("index.php", 3, _WLS_ERRORNOLINK);
	exit();
}


if ( $submit ) 
{
	if ( !( $weblinks_ratelink->check_token() ) )
	{
		redirect_header($url_singlelink, 3, "Token Error");
		exit();
	}

	$check = $weblinks_ratelink->check_rate_link($lid);

   	if ($check == -11) 
   	{
		redirect_header("ratelink.php?lid=$lid", 5, _WLS_NORATING);
		exit();
   	}

	if ( $check == -12 ) 
	{
		redirect_header($url_singlelink, 5, _WLS_CANTVOTEOWN);
		exit();
	}

	if (( $check == -13 )||( $check == -14 )) 
	{
		redirect_header($url_singlelink, 5, _WLS_VOTEONCE2);
		exit();
	}

	$ret = $weblinks_ratelink->rate_link($lid);
	if ( !$ret )
	{
		redirect_header($url_singlelink, 5, "DB Error");
		exit();
	}

	$msg = $weblinks_ratelink->get_msg_success();
	redirect_header($url_singlelink, 1, $msg);
	exit();

}
else 
{
// --- template start ---
// xoopsOption[template_main] should be defined before including header.php
	$xoopsOption['template_main'] = WEBLINKS_DIRNAME."_ratelink.html";
	include XOOPS_ROOT_PATH.'/header.php';

	$title_s = $weblinks_ratelink->get_title();
	list($token_name, $token_value) = $weblinks_ratelink->get_token_pair();

	$weblinks_header->assign_module_header();
	$weblinks_template->assignIndex();

	$xoopsTpl->assign('lang_ratethissite', _WLS_RATETHISSITE);
	$xoopsTpl->assign('lang_voteonce',     _WLS_VOTEONCE);
	$xoopsTpl->assign('lang_ratingscale',  _WLS_RATINGSCALE);
	$xoopsTpl->assign('lang_beobjective',  _WLS_BEOBJECTIVE);
	$xoopsTpl->assign('lang_donotvote',    _WLS_DONOTVOTE);
	$xoopsTpl->assign('lang_rateit',       _WLS_RATEIT);
	$xoopsTpl->assign('lang_cancel',       _CANCEL);

	$xoopsTpl->assign('link_id',     $lid);
	$xoopsTpl->assign('link_title',  $title_s);
	$xoopsTpl->assign('token_name',  $token_name);
	$xoopsTpl->assign('token_value', $token_value);

	include XOOPS_ROOT_PATH.'/footer.php';
}

exit();
// --- end of main ---

?>