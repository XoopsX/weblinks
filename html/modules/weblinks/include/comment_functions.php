<?php
// $Id: comment_functions.php,v 1.1 2011/12/29 14:32:35 ohwada Exp $

// 2007-02-20 K.OHWADA
// hack for multi site

// 2006-07-28 K.OHWADA
// BUG 4164: number of comments is wrong

// 2006-05-15 K.OHWADA
// change $weblinks_dirname to capital letter

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication

//=========================================================
// WebLinks Module
// comment callback functions
// 2004/01/14 K.OHWADA
//================================================================

$WEBLINKS_DIRNAME = basename( dirname( dirname( __FILE__ ) ) );
include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/include/functions.php';

// --- eval begin ---
eval( '

function '.$WEBLINKS_DIRNAME.'_com_update( $lid, $comments )
{
	return weblinks_com_update_base( "'.$WEBLINKS_DIRNAME.'" , $lid, $comments ) ;
}

' );
// --- eval end ---

// === weblinks_com_update_base begin ===
if( !function_exists( 'weblinks_com_update_base' ) ) 
{

function weblinks_com_update_base($dirname, $lid, $comments)
{
	global $xoopsDB;

// hack for multi site
	$table_link = weblinks_multi_get_table_name($dirname, 'link');

	$sql = "UPDATE $table_link SET comments=$comments WHERE lid=$lid";
	$xoopsDB->queryF($sql);
}

function weblinks_com_approve(&$comment)
{
	// notification mail here
}

// === weblinks_com_update_base end ===
}

?>