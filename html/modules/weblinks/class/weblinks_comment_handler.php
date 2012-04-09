<?php
// $Id: weblinks_comment_handler.php,v 1.1 2012/04/09 10:23:37 ohwada Exp $

//=========================================================
// WebLinks Module
// 2012-04-02 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('weblinks_comment_handler') ) 
{

include_once XOOPS_ROOT_PATH.'/include/comment_constants.php';

//=========================================================
// class weblinks_comment_handler
//=========================================================
class weblinks_comment_handler 
{
	var $_db;
	var $_comment_handler;
	var $_member_handler;
	var $_mid;
	var $_remote_addr;
	var $_error;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_comment_handler()
{
	global $xoopsModule;

	$this->_db =& Database::getInstance();
    $this->_comment_handler =& xoops_gethandler('comment');
	$this->_member_handler  =& xoops_gethandler('member');
	$this->_mid = $xoopsModule->getVar('mid');

	$this->_remote_addr = xoops_getenv('REMOTE_ADDR');
}

function insert_comment_by_lid($lid, $uid, $title, $text)
{
	$this->_error = '';

	$time = time();

	$com_itemid   = $lid;
	$com_uid      = $uid;
	$com_title    = $title;
	$com_text     = $text;
	$com_exparams = 'cid=&';

	$com_modid    = $this->_mid;
	$com_ip       = $this->_remote_addr;
	$com_pid      = 0;
	$com_rootid   = 0;
	$com_icon     = '';

	$dohtml   = 0;
	$dosmiley = 1;
	$doxcode  = 1;
	$doimage  = 1;
	$dobr     = 1;

	$comment = $this->_comment_handler->create();
	$comment->setVar('com_created',  $time);
    $comment->setVar('com_modified', $time);
	$comment->setVar('com_status', XOOPS_COMMENT_ACTIVE );
    $comment->setVar('com_modid', $com_modid);
	$comment->setVar('com_ip', $com_ip);
	$comment->setVar('com_pid', $com_pid);
	$comment->setVar('com_itemid', $com_itemid);
	$comment->setVar('com_rootid', $com_rootid);
	$comment->setVar('com_uid', $com_uid);
    $comment->setVar('com_title', $com_title);
    $comment->setVar('com_text', $com_text);
    $comment->setVar('com_icon', $com_icon);
    $comment->setVar('com_exparams', $extra_params);
    $comment->setVar('dohtml', $dohtml);
    $comment->setVar('dosmiley', $dosmiley);
    $comment->setVar('doxcode', $doxcode);
    $comment->setVar('doimage', $doimage);
    $comment->setVar('dobr', $dobr);

	$ret = $this->_comment_handler->insert($comment);
	if ( !$ret ) {
		$this->_error = $this->_db->error();
		return false;
	}

	$newcid = $comment->getVar('com_id');
	$ret = $this->_comment_handler->updateByField($comment, 'com_rootid', $newcid);
	if ( !$ret ) {
		$this->_error = $this->_db->error();
		$this->_comment_handler->delete($comment);
		return false;
	}

	// increment user post if needed
	$poster =& $this->_member_handler->getUser($com_uid);
	if (is_object($poster)) {
		$this->_member_handler->updateUserByField($poster, 'posts', $poster->getVar('posts') + 1);
	}

	return $newcid;
}

function get_error()
{
	return $this->_error ;
}

// --- class end ---
}

// === class end ===
}

?>