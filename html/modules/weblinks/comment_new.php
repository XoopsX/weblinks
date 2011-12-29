<?php
// $Id: comment_new.php,v 1.1 2011/12/29 14:32:27 ohwada Exp $

// 2007-03-01 K.OHWADA
// header.php
// weblinks_link_basic

// 2006-09-20 K.OHWADA
// use happy_linux

// 2006-05-15 K.OHWADA
// use new handler

// 2005-09-04 K.OHWADA
// BUG 2932: dont work correctly when register_long_arrays = off

// 2004-11-28 K.OHWADA
// write fair, delete unnecessary comments

// 2004/08/10 K.OHWADA
// enable to install this module two or more. 

//================================================================
// comment new
// use class weblinksLink
// 2004/01/14 K.OHWADA
//================================================================

include "header.php";

$weblinks_link_handler =& weblinks_get_handler( 'link_basic', WEBLINKS_DIRNAME );

// BUG 2932: dont work correctly when register_long_arrays = off
$com_itemid = 0;
if ( isset($_GET['com_itemid']) )
{
	$com_itemid = intval( $_GET['com_itemid'] );
}

if ($com_itemid > 0) 
{
// Get link title
	$com_replytitle = $weblinks_link_handler->get_title($com_itemid);

	include XOOPS_ROOT_PATH.'/include/comment_new.php';
}

exit();
// -----

?>