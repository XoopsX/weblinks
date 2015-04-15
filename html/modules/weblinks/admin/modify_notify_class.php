<?php
// $Id: modify_notify_class.php,v 1.1 2011/12/29 14:32:53 ohwada Exp $

// 2007-11-01 K.OHWADA
// $this->set_edit_handler();
// _AM_WEBLINKS_DEL_REQ_DELETED

//=========================================================
// admin modify
// 2007-09-10 K.OHWADA
//=========================================================

//=========================================================
// class admin_modify_notify
//=========================================================
class admin_modify_notify extends admin_modify_base
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_modify_notify()
{
	$this->admin_modify_base();
	$this->set_edit_handler( 'link_edit_base' );
}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_modify_notify();
	}
	return $instance;
}

//---------------------------------------------------------
// send_approve_new
//---------------------------------------------------------
function send_approve_new()
{
	if ( !$this->_check_token() )
	{
		redirect_header("link_list.php", 5, "Token Error");
		exit();
	}

	$this->_convert_post_hidden();

	if ( !$this->get_post_skip() )
	{
		$this->_send_mail();
	}

	$rss_flag = $this->get_post_rss_flag();
	$lid      = $this->get_post_lid();

	if ( WEBLINKS_RSSC_USE && $rss_flag )
	{
		$this->_rssc_manage->add_link( $lid, 'approve_new' );
		exit();
	}
	else
	{
		$msg  = _WLS_NEWLINKADDED;
		$msg .= $this->build_comment( 'notify approve new link' );	// for test form
		redirect_header( $this->_get_redirect_at_new(), 1, $msg );
		exit();
	}
}

//---------------------------------------------------------
// send_refuse_new
//---------------------------------------------------------
function send_refuse_new()
{
	if ( !$this->_check_token() )
	{
		redirect_header("link_list.php", 5, "Token Error");
		exit();
	}

	$this->_convert_post_hidden();

	if ( !$this->get_post_skip() )
	{
		$this->_send_mail();
	}

	$msg  = _WLS_LINKDELETED;
	$msg .= $this->build_comment( 'notify refuse new link' );	// for test form
	redirect_header( $this->_get_redirect_at_new(), 1, $msg );
}

//---------------------------------------------------------
// send_approve_mod
//---------------------------------------------------------
function send_approve_mod()
{
	if ( !$this->_check_token() )
	{
		redirect_header("link_list.php", 5, "Token Error");
		exit();
	}

	$this->_convert_post_hidden();

	if ( !$this->get_post_skip() )
	{
		$this->_send_mail();
	}

	if ( WEBLINKS_RSSC_USE )
	{
		$this->_rssc_manage->mod_link( 'approve_mod' );
		exit();
	}
	else
	{
		$msg  = _WLS_DBUPDATED;
		$msg .= $this->build_comment( 'notify approve mod link' );	// for test form
		redirect_header( $this->_get_redirect_at_mod(), 1, $msg );
		exit();
	}

}

//---------------------------------------------------------
// send_refuse_mod
//---------------------------------------------------------
function send_refuse_mod()
{
	if ( !$this->_check_token() )
	{
		redirect_header("link_list.php", 5, "Token Error");
		exit();
	}

	$this->_convert_post_hidden();

	if ( !$this->get_post_skip() )
	{
		$this->_send_mail();
	}

	$msg  = _WLS_MODREQDELETED;
	$msg .= $this->build_comment( 'notify refuse mod link' );	// for test form
	redirect_header( $this->_get_redirect_at_mod(), 1, $msg );

}

//---------------------------------------------------------
// send_approve_del
//---------------------------------------------------------
function send_approve_del()
{
	if ( !$this->_check_token() )
	{
		redirect_header("link_list.php", 5, "Token Error");
		exit();
	}

	$this->_convert_post_hidden();

	if ( !$this->get_post_skip() )
	{
		$this->_send_mail();
	}

	$msg  = _WLS_DBUPDATED;
	$msg .= $this->build_comment( 'notify approve del link' );	// for test form
	redirect_header( $this->_get_redirect_at_del(), 1, $msg );
	exit();

}

//---------------------------------------------------------
// send_refuse_del
//---------------------------------------------------------
function send_refuse_del()
{
	if ( !$this->_check_token() )
	{
		redirect_header("link_list.php", 5, "Token Error");
		exit();
	}

	$this->_convert_post_hidden();

	if ( !$this->get_post_skip() )
	{
		$this->_send_mail();
	}

	$msg  = _AM_WEBLINKS_DEL_REQ_DELETED;
	$msg .= $this->build_comment( 'notify refuse del link' );	// for test form
	redirect_header( $this->_get_redirect_at_del(), 1, $msg );

}

//---------------------------------------------------------
// notification common
//--------------------------------------------------------
function _notify_submitter_common( $mode )
{
	list($subject, $body) = $this->_build_subject_body_common( $mode );

	$param = array(
		'to_email'   => $this->_email,
		'subject'    => $subject,
		'body'       => $body,
	);

	$ret = $this->_mail_send->send( $param );
	if ( !$ret )
	{
		$this->_set_errors( $this->_mail_send->getErrors() );
		return false;
	}

	$this->_set_log( $this->_mail_send->getLogs() );
	return true;
}

function _convert_post_hidden()
{
// _hidden_xxx -> xxx
	foreach ( $_POST as $k => $v )
	{
		if ( preg_match("/^_hidden_(.*)/", $k, $matches) )
		{
			$key = $matches[1];
			if ( !isset($_POST[$key]) )
			{
				$_POST[$key] = $v;
			}
		}
	}
}

function _send_mail()
{
	$ret = $this->_mail_send->send_email_by_post( true );
	if ( !$ret )
	{
		$this->_set_errors( $this->_mail_send->getErrors() );
		return false;
	}

	$this->_set_log( $this->_mail_send->getLogs() );
	return true;
}

// --- class end ---
}

?>