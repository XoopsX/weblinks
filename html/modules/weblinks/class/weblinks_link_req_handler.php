<?php
// $Id: weblinks_link_req_handler.php,v 1.2 2011/12/29 19:54:56 ohwada Exp $

// 2011-12-29 K.OHWADA
// PHP 5.3 : Assigning the return value of new by reference is now deprecated.

// 2007-11-01 K.OHWADA
// modify_handler

// 2007-09-10 K.OHWADA
// divid from weblinks_link_edit_handler.php

//=========================================================
// WebLinks Module
// 2006-05-15 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('weblinks_link_req_handler') ) 
{

//=========================================================
// class weblinks_link_req_handler
//=========================================================
class weblinks_link_req_handler extends weblinks_link_edit_base_handler
{
	var $_modify_handler;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_link_req_handler( $dirname )
{
	$this->weblinks_link_edit_base_handler( $dirname );

	$this->_modify_handler =& weblinks_get_handler( 'modify',    $dirname );
}

//---------------------------------------------------------
// link request admin_approve
//---------------------------------------------------------
function user_submit_admin_approve()
{
	$newid = $this->_add_modify_record( 0 );
	if ( !$newid )
	{
		return false;
	}

	$this->_notification->notify_link_submit( $newid, $this->_save_obj, $this->_cid_array );

	return $newid;
}

function user_modify_admin_approve()
{
	$newid = $this->_add_modify_record( 1 );
	if ( !$newid )
	{
		return false;
	}

	$this->_notification->notify_link_modify( $newid, $this->_save_obj, $this->_cid_array );

	return $newid;
}

function user_delete_admin_approve()
{
	$newid = $this->_add_modify_record( 2 );
	if ( !$newid )
	{
		return false;
	}

	$this->_notification->notify_link_delete( $newid, $this->_save_obj, $this->_cid_array );

	return $newid;
}

//---------------------------------------------------------
// private
//---------------------------------------------------------
// mode 0: add, 1:mod, 2:del
function _add_modify_record( $mode=0 )
{
	$save_obj =& $this->_create_modify_save();

// mod or del
	if ( $mode )
	{
		$lid = $this->get_post_lid();

		$link_obj = $this->_link_handler->get($lid);
		if ( !is_object($link_obj) )
		{
			$this->_set_errors_not_exist($lid);
			return false;
		}

// not validate
		$save_obj->assignVars( $link_obj->gets() );
	}

	$save_obj->assign_add_object( $_POST, $mode );

	$newid = $this->_modify_handler->insert( $save_obj );
	if ( !$newid )
	{
		$this->_set_errors( $this->_modify_handler->getErrors() );
		return false;
	}

	$this->_newid     =  $newid;
	$this->_save_obj  =& $save_obj;
	$this->_cid_array =& $save_obj->get_cid_array();

	return $newid;
}

function &_create_modify_save($isNew = true)
{
	$obj = new weblinks_modify_save( $this->_DIRNAME );
	if ($isNew)
	{	$obj->setNew();	}
	return $obj;
}

// --- class end ---
}

// === class end ===
}

?>