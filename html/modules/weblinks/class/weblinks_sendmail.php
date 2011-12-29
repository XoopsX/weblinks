<?php
// $Id: weblinks_sendmail.php,v 1.1 2011/12/29 14:33:07 ohwada Exp $

// 2007-08-25 K.OHWADA
// change send_newlink_to_admin()

// 2007-07-19 K.OHWADA
// disable to format error message to html
// send( true ) getErrors( false )

// 2006-09-20 K.OHWADA
// use happy_linux

// 2006-05-15 K.OHWADA
// this is new file

//================================================================
// WebLinks Module
// 2006-05-15 K.OHWADA
//================================================================

//---------------------------------------------------------
// TODO
// get_dir_mail_template()  same as mailer
//---------------------------------------------------------

// === class begin ===
if( !class_exists('weblinks_sendmail') ) 
{

//=========================================================
// class weblinks_sendmail
//=========================================================
class weblinks_sendmail extends happy_linux_error
{
	var $_FLAG_EVENT_USER      = true;	// send email to user
	var $_FLAG_EVENT_ANONYMOUS = true;	// send email to anonymous

	var $_system;
	var $_post;

	var $DIRNAME;
	var $SITENAME;
	var $SITEURL;
	var $ADMINMAIL;
	var $_WEBLINK_URL;
	var $_uname;
	var $_remote_addr;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_sendmail( $dirname )
{
	$this->happy_linux_error();

	$this->_system =& happy_linux_system::getInstance();
	$this->_post   =& happy_linux_post::getInstance();

	$this->DIRNAME   = $dirname;
	$this->SITENAME  = $this->_system->get_sitename();
	$this->ADMINMAIL = $this->_system->get_adminmail();
	$this->SITEURL      = XOOPS_URL . '/';
	$this->_WEBLINK_URL = XOOPS_URL . '/modules/' . $dirname;

	$this->_uname       = $this->_system->get_uname();
	$this->_remote_addr = xoops_getenv("REMOTE_ADDR");

}

function &getInstance( $dirname )
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new weblinks_sendmail( $dirname );
	}
	return $instance;
}

//-------------------------------------------------------------------
// get_dir_mail_template
// REQ 3028: send apoval email to anonymous user
// move from submit_form.php
//-------------------------------------------------------------------
function get_dir_mail_template($file_tpl) 
{
	$WEBLINKS_ROOT_PATH = XOOPS_ROOT_PATH.'/modules/'.$this->DIRNAME;
	$LANGUAGE = $this->_system->get_language();

	$dir_tpl_lang = $WEBLINKS_ROOT_PATH.'/language/'.$LANGUAGE.'/mail_template/';

	if ( file_exists( $dir_tpl_lang.$file_tpl ) )
	{
		return $dir_tpl_lang;
	}
	else
	{
		$dir = $WEBLINKS_ROOT_PATH.'/language/english/mail_template/';
		return $dir;
	}
}

//---------------------------------------------------------
// send mail
//---------------------------------------------------------
function send_passwd_to_user( $email, $name, $lid, $passwd ) 
{
	$entry = WEBLINKS_URL."/modlink.php?lid=$lid&code=$passwd";

	$file_tpl = 'lostpass.tpl';
	$dir_tpl  = $this->get_dir_mail_template($file_tpl);

	$xoopsMailer =& getMailer();
	$xoopsMailer->useMail();
	$xoopsMailer->setTemplateDir( $dir_tpl );
	$xoopsMailer->setTemplate( $file_tpl );
	$xoopsMailer->assign("SITENAME",  $this->SITENAME );
	$xoopsMailer->assign("ADMINMAIL", $this->ADMINMAIL );
	$xoopsMailer->assign("SITEURL",   $this->SITEURL );
	$xoopsMailer->assign("IP",    $this->_remote_addr);
	$xoopsMailer->assign("NAME",  $name);
	$xoopsMailer->assign("ENTRY", $entry);
	$xoopsMailer->setToEmails(  $email);
	$xoopsMailer->setFromEmail( $this->ADMINMAIL );
	$xoopsMailer->setFromName(  $this->SITENAME );
	$xoopsMailer->setSubject( sprintf(_US_NEWPWDREQ, $this->SITENAME) );

	$ret = $xoopsMailer->send( true );
	if ( !$ret )
	{
		$this->_set_errors( $xoopsMailer->getErrors( false ) );
		return false;
	}

	return true;
}

//---------------------------------------------------------
// REQ 3028: send new link email to admin
// Notification of new wating link to admn
// added by SnAKes
//---------------------------------------------------------
function send_newlink_to_admin( $newid ) 
{
	$file_tpl = 'link_waiting_notify_admin.tpl';
	$dir_tpl  = $this->get_dir_mail_template($file_tpl);

	$waiting_url = $this->_WEBLINK_URL . '/admin/link_manage.php?op=list_new&mid=' . $newid;

	$title = $this->_post->get_post_text('title');
	$url   = $this->_post->get_post_text('url');
	$mail  = $this->_post->get_post_text('mail');

	$xoopsMailer =& getMailer();
	$xoopsMailer->useMail();
	$xoopsMailer->assign('WAITINGLINKS_URL', $waiting_url );
	$xoopsMailer->assign('SITE_NAME',  $title );
	$xoopsMailer->assign('SITE_URL',   $url );
	$xoopsMailer->assign('SITE_EMAIL', $mail );
	$xoopsMailer->assign('UNAME', '');
	$xoopsMailer->assign('ULINK', '');
	$xoopsMailer->setTemplateDir($dir_tpl);
	$xoopsMailer->setTemplate($file_tpl);
	$xoopsMailer->setFromEmail( $this->ADMINMAIL );
	$xoopsMailer->setFromName(  $this->SITENAME );
	$xoopsMailer->setToEmails(  $this->ADMINMAIL );
	$xoopsMailer->setSubject(_WLS_LINKSWAITING);

	$ret = $xoopsMailer->send( true );
	if ( !$ret )
	{
		$this->_set_errors( $xoopsMailer->getErrors( false ) );
		return false;
	}

	return $ret;
}

//---------------------------------------------------------
// REQ 3028: send apoval email to anonymous user
// Notification to anonymous users
// added by SnAKes
//---------------------------------------------------------
function send_approved_to_anonymous(&$tags) 
{
	$file_tpl = "link_approve_notify_anon.tpl";
	$dir_tpl  = $this->get_dir_mail_template($file_tpl);

	$mail  = $this->_post->get_post_text('mail');

	$xoopsMailer =& getMailer();
	$xoopsMailer->useMail();

	if ( is_array($tags) )
	{
		foreach ($tags as $k=>$v) 
		{
			$xoopsMailer->assign($k, preg_replace("/&/i", '&', $v));
		}
	}

	$xoopsMailer->assign("UNAME", '');
	$xoopsMailer->assign("ULINK", '');
	$xoopsMailer->setTemplateDir($dir_tpl);
	$xoopsMailer->setTemplate($file_tpl);
	$xoopsMailer->setFromEmail( $this->ADMINMAIL );
	$xoopsMailer->setFromName(  $this->SITENAME );
	$xoopsMailer->setToEmails( $mail );
	$xoopsMailer->setSubject(_WEBLINKS_LINK_APPROVED);

	$ret = $xoopsMailer->send( true );

	if ( !$ret )
	{
		$this->_set_errors( $xoopsMailer->getErrors( false ) );
		return false;
	}

	return $ret;
}

//---------------------------------------------------------
// REQ 3028: send apoval email to anonymous user
// Notification of refusal to registered user and anonymous user
// added by SnAKes
// TODO: user can choice recieve email or PM
//---------------------------------------------------------
function send_refused_to_user() 
{
	$uid   = $this->_post->get_post_int('uid');
	$title = $this->_post->get_post_text('title');
	$url   = $this->_post->get_post_text('url');
	$mail  = $this->_post->get_post_text('mail');

	if( $this->_FLAG_EVENT_USER && $uid )
	{
		$mailto = $this->_system->get_email_by_uid( $uid );
	}
	elseif( $this->_FLAG_EVENT_ANONYMOUS && ($uid == 0) && !empty($mail) )
	{
		$mailto = $mail;
	}
	else
	{
		return false;
	}

	$file_tpl = "link_refused_notify.tpl";
	$dir_tpl  = $this->get_dir_mail_template($file_tpl);

	$xoopsMailer =& getMailer();
	$xoopsMailer->useMail();
	$xoopsMailer->assign("SITE_URL",  $url );
	$xoopsMailer->assign("SITE_NAME", $title );
	$xoopsMailer->assign("UNAME", '');
	$xoopsMailer->assign("ULINK", '');
	$xoopsMailer->setTemplateDir($dir_tpl);
	$xoopsMailer->setTemplate($file_tpl);
	$xoopsMailer->setFromEmail( $this->ADMINMAIL );
	$xoopsMailer->setFromName(  $this->SITENAME );
	$xoopsMailer->setToEmails(  $mailto );
	$xoopsMailer->setSubject(_WEBLINKS_LINK_REFUSED);

	$ret = $xoopsMailer->send( true );

	if ( !$ret )
	{
		$this->_set_errors( $xoopsMailer->getErrors( false ) );
		return false;
	}

	return $ret;
}

// --- class end ---
}

// === class end ===
}

?>