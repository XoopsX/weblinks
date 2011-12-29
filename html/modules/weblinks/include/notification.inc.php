<?php
// $Id: notification.inc.php,v 1.1 2011/12/29 14:32:35 ohwada Exp $

// 2007-08-25 K.OHWADA
// BUG: not show category title

// 2007-02-20 K.OHWADA
// hack for multi site

// 2006-05-15 K.OHWADA
// change $weblinks_dirname to capital letter

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication

//================================================================
// WebLinks Module
// notification
// 2004/01/14 K.OHWADA
//================================================================

$WEBLINKS_DIRNAME = basename( dirname( dirname( __FILE__ ) ) );

include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/include/functions.php';

// --- eval begin ---
eval( '

function '.$WEBLINKS_DIRNAME.'_notify_iteminfo( $category, $item_id )
{
	return weblinks_notify_iteminfo_base( "'.$WEBLINKS_DIRNAME.'" , $category, $item_id ) ;
}

' );
// --- eval end ---

// === weblinks_notify_iteminfo_base begin ===
if( !function_exists( 'weblinks_notify_iteminfo_base' ) ) 
{

//---------------------------------------------------------
// function
//---------------------------------------------------------
function weblinks_notify_iteminfo_base($dirname, $category, $item_id)
{
	global $xoopsModule, $xoopsModuleConfig, $xoopsConfig;
	global $xoopsDB;

// hack for multi site
// BUG: not show category title
	$table_category = weblinks_multi_get_table_name($dirname, 'category');
	$table_link     = weblinks_multi_get_table_name($dirname, 'link');

	if ( empty($xoopsModule) || $xoopsModule->getVar('dirname') != $dirname ) 
	{
		$module_handler =& xoops_gethandler('module');
		$module =& $module_handler->getByDirname($dirname);

		$config_handler =& xoops_gethandler('config');
		$config =& $config_handler->getConfigsByCat(0, $module->getVar('mid'));
	}
	else 
	{
		$module =& $xoopsModule;
		$config =& $xoopsModuleConfig;
	}

	if ($category=='global') 
	{
		$item['name'] = '';
		$item['url']  = '';
		return $item;
	}

	if ($category=='category') 
	{
// Assume we have a valid category id
		$sql = "SELECT * FROM $table_category WHERE cid=$item_id";
		$row = $xoopsDB->fetchArray( $xoopsDB->query($sql) );

		$item['name'] = $row['title'];
		$item['url']  = XOOPS_URL."/modules/".$dirname."/viewcat.php?cid=".$item_id;

		return $item;
	}

	if ($category=='link') 
	{
// Assume we have a valid link id
		$sql = "SELECT * FROM $table_link WHERE lid=$item_id";
		$row = $xoopsDB->fetchArray( $xoopsDB->query($sql) );

		$item['name'] = $row['title'];
		$item['url']  = XOOPS_URL."/modules/".$dirname."/singlelink.php?lid=".$item_id;

		return $item;
	}
}

// === weblinks_notify_iteminfo_base begin ===
}

?>