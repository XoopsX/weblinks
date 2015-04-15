<?php
// $Id: weblinks_notification.php,v 1.1 2011/12/29 14:33:06 ohwada Exp $

// 2007-09-10 K.OHWADA
// move from submit.php and modlink.php

//=========================================================
// WebLinks Module
// 2007-09-10 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('weblinks_notification') ) 
{

//=========================================================
// class weblinks_notification
//=========================================================
class weblinks_notification extends happy_linux_error
{
	var $_WEBLINKS_URL;

	var $_link_handler;
	var $_notification_handler;

// input
	var $_newid    = null;
	var $_save_obj = null;

// local
	var $_tags = null;

// constant
	var $_MAX_DESCRIPTION = 200;
	var $_MAX_USERCOMMENT = 200;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_notification( $dirname )
{
	$this->happy_linux_error();

	$this->_WEBLINKS_URL = XOOPS_URL . '/modules/' . $dirname;

	$this->_category_handler     =& weblinks_get_handler( 'category', $dirname );
	$this->_notification_handler =& xoops_gethandler('notification');
}

public static function &getInstance( $dirname )
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new weblinks_notification( $dirname );
	}
	return $instance;
}

//---------------------------------------------------------
// notification
//---------------------------------------------------------
function notify_newlink( $newid, &$obj, &$cid_array )
{
	$this->_newid     =  $newid;
	$this->_save_obj  =& $obj; 

	$tags =& $this->build_tags_newlink();
	$this->_notification_handler->triggerEvent('global', 0, 'new_link', $tags);

	foreach ( $cid_array as $cid )
	{
		$tags =& $this->build_tags_newlink( $cid );
		$this->_notification_handler->triggerEvent('category', $cid, 'new_link', $tags);
	}
}

function notify_newlink_admin( $newid, &$obj, &$cid_array )
{
	$this->_newid     =  $newid;
	$this->_save_obj  =& $obj; 
   
	$tags =& $this->_build_tags_newlink_admin();
	$this->_notification_handler->triggerEvent('global', 0, 'new_link_admin', $tags);

	if ( $obj->get('usercomment') )
	{
		$this->_notification_handler->triggerEvent('global', 0, 'new_link_comment', $tags);
	}
}

function notify_link_submit( $newid, &$obj, &$cid_array )
{
	$this->_newid     =  $newid;
	$this->_save_obj  =& $obj; 

	$tags =& $this->_build_tags_linksubmit();
	$this->_notification_handler->triggerEvent('global', 0, 'link_submit', $tags);

	foreach ( $cid_array as $cid )
	{
		$tags =& $this->_build_tags_linksubmit( $cid );
		$this->_notification_handler->triggerEvent('category', $cid, 'link_submit', $tags);
	}
}

function notify_link_modify( $newid, &$obj, &$cid_array )
{
	$this->_newid     =  $newid;
	$this->_save_obj  =& $obj; 

	$tags = array();
	$tags['MODIFYREPORTS_URL'] = WEBLINKS_URL . '/admin/link_manage.php?op=list_mod&mid=' . $newid;

	$this->_notification_handler->triggerEvent('global', 0, 'link_modify', $tags);
}

function notify_link_delete( $newid, &$obj, &$cid_array )
{
	$this->_newid     =  $newid;
	$this->_save_obj  =& $obj; 

	$tags = array();
	$tags['MODIFYREPORTS_URL'] = WEBLINKS_URL . '/admin/link_manage.php?op=list_del&mid=' . $newid;

	$this->_notification_handler->triggerEvent('global', 0, 'link_modify', $tags);
}

//---------------------------------------------------------
// event tags
//---------------------------------------------------------
function &build_tags_newlink( $cid=0 )
{
	$tags =& $this->_build_tags_newlink_once();
	if ( !is_array($tags) )
	{
		return $tags;
	}

	if ($cid)
	{
		$tags['CATEGORY_NAME'] = $this->_category_handler->get_title( $cid );
		$tags['CATEGORY_URL']  = $this->_WEBLINKS_URL . '/viewcat.php?cid=' . $cid;
	}

	return $tags;
}

function &_build_tags_newlink_admin()
{
	$tags =& $this->_build_tags_newlink_once();
	if ( !is_array($tags) )
	{
		return $tags;
	}

	$tags['LINK_USERCOMMENT'] = $this->_save_obj->usercomment_short( $this->_MAX_USERCOMMENT );
	return $tags;
}

function &_build_tags_linksubmit( $cid=0 )
{
	$tags =& $this->_build_tags_linksubmit_once();
	if ( !is_array($tags) )
	{
		return $tags;
	}

	if ( $cid )
	{
		$tags['CATEGORY_NAME'] = $this->_category_handler->get_title( $cid );
		$tags['CATEGORY_URL']  = $this->_WEBLINKS_URL . '/viewcat.php?cid=' . $cid;
	}

	return $tags;
}

function &build_tags_link_mod()
{
	$tags = array();
	$tags['LINK_NAME'] = $this->_save_obj->get('title');
	$tags['LINK_URL']  = $this->_WEBLINKS_URL . '/singlelink.php?lid=' . $this->_save_obj->get('lid');
	return $tags;
}

function &_build_tags_newlink_once()
{
	if ( $this->_tags )
	{
		return $this->_tags;
	}

	if ( !is_object( $this->_save_obj ) )
	{
		$false = false;
		return $false;
	}

	$tags = array();
	$tags['LINK_NAME']        = $this->_save_obj->get('title');
	$tags['LINK_DESCRIPTION'] = $this->_save_obj->description_short( $this->_MAX_DESCRIPTION );
	$tags['LINK_URL']         = $this->_WEBLINKS_URL . '/singlelink.php?lid=' . $this->_newid;

	$this->_tags =& $tags;
	return $tags;
}

function &_build_tags_linksubmit_once()
{
	if ( $this->_tags )
	{
		return $this->_tags;
	}

	if ( !is_object( $this->_save_obj ) )
	{
		$false = false;
		return $false;
	}

	$tags = array();
	$tags['LINK_NAME']        = $this->_save_obj->get('title');
	$tags['LINK_DESCRIPTION'] = $this->_save_obj->description_short( $this->_MAX_DESCRIPTION );
	$tags['LINK_USERCOMMENT'] = $this->_save_obj->usercomment_short( $this->_MAX_USERCOMMENT );
	$tags['WAITINGLINKS_URL'] = $this->_WEBLINKS_URL . '/admin/link_manage.php?op=list_new&mid=' . $this->_newid;

	$this->_tags =& $tags;
	return $tags;
}

// --- class end ---
}

// === class end ===
}

?>