<?php
// $Id: weblinks_link_vote_del_handler.php,v 1.1 2011/12/29 14:33:07 ohwada Exp $

// 2007-11-01 K.OHWADA
// divid from weblinks_link_edit_handler.php

//=========================================================
// WebLinks Module
// 2006-05-15 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('weblinks_link_vote_del_handler') ) 
{

//=========================================================
// class weblinks_link_vote_del
//=========================================================
class weblinks_link_vote_del_handler extends happy_linux_error
{
	var $_DIRNAME;

	var $_link_handler;
	var $_catlink_handler;
	var $_modify_handler;
	var $_votedata_handler;
	var $_broken_handler;
	var $_system;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_link_vote_del_handler( $dirname )
{
	$this->_DIRNAME = $dirname;

	$this->happy_linux_error();

	$this->_link_handler     =& weblinks_get_handler( 'link',      $dirname );
	$this->_catlink_handler  =& weblinks_get_handler( 'catlink',   $dirname );
	$this->_modify_handler   =& weblinks_get_handler( 'modify',    $dirname );
	$this->_votedata_handler =& weblinks_get_handler( 'votedata',  $dirname );
	$this->_broken_handler   =& weblinks_get_handler( 'broken',    $dirname );

	$this->_system =& happy_linux_system::getInstance();
}

//---------------------------------------------------------
// delete link, modify, votedata, broken, comments, notification
//---------------------------------------------------------
// broken_manage.php
function del_link_vote_comm_catlink_by_lid( $lid )
{
	$this->_clear_errors();

	$ret1 = $this->del_link_vote_comm_by_lid( $lid );

	$ret2 = $this->_catlink_handler->delete_by_lid( $lid );
	if ( !$ret2 )
	{
		$this->_set_errors( $this->_catlink_handler->getErrors() );
	}

	return $this->returnExistError();
}

// category_manage.php
function del_link_vote_comm_by_lid( $lid )
{
	$modid = $this->_system->get_mid();

	$ret1 = $this->_link_handler->delete_by_lid( $lid );
	if ( !$ret1 )
	{
		$this->_set_errors( $this->_link_handler->getErrors() );
	}

	$ret2 = $this->_modify_handler->delete_by_lid( $lid );
	if ( !$ret2 )
	{
		$this->_set_errors( $this->_modify_handler->getErrors() );
	}

	$ret3 = $this->_votedata_handler->delete_by_lid( $lid );
	if ( !$ret3 )
	{
		$this->_set_errors( $this->_votedata_handler->getErrors() );
	}

	$ret4 = $this->_broken_handler->delete_by_lid( $lid );
	if ( !$ret4 )
	{
		$this->_set_errors( $this->_broken_handler->getErrors() );
	}

	xoops_comment_delete( $modid, $lid );
	xoops_notification_deletebyitem ( $modid, 'link', $lid );

	return $this->returnExistError();
}

// --- class end ---
}

// === class end ===
}

?>