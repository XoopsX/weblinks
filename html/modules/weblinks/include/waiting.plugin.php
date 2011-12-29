<?php
// $Id: waiting.plugin.php,v 1.1 2011/12/29 14:32:32 ohwada Exp $

//=========================================================
// WebLinks Module
// for waiting plugin
// 2007-09-01 K.OHWADA
//=========================================================

$WEBLINKS_DIRNAME = basename( dirname( dirname( __FILE__ ) ) );

// --- eval begin ---
eval( '

function b_waiting_'.$WEBLINKS_DIRNAME.'()
{
	return b_waiting_weblinks_base( "'.$WEBLINKS_DIRNAME.'" ) ;
}

function '.$WEBLINKS_DIRNAME.'_waiting_waitings()
{
	return weblinks_waiting_waitings_base( "'.$WEBLINKS_DIRNAME.'" ) ;
}

function '.$WEBLINKS_DIRNAME.'_waiting_modreqs()
{
	return weblinks_waiting_modreqs_base( "'.$WEBLINKS_DIRNAME.'" ) ;
}

function '.$WEBLINKS_DIRNAME.'_waiting_delreqs()
{
	return weblinks_waiting_modreqs_base( "'.$WEBLINKS_DIRNAME.'" ) ;
}

function '.$WEBLINKS_DIRNAME.'_waiting_brokens()
{
	return weblinks_waiting_brokens_base( "'.$WEBLINKS_DIRNAME.'" ) ;
}

function '.$WEBLINKS_DIRNAME.'_admin_waiting()
{
	return weblinks_admin_waiting_base( "'.$WEBLINKS_DIRNAME.'" ) ;
}

function '.$WEBLINKS_DIRNAME.'_user_waiting( $uid, $limit=0, $offset=0 )
{
	return weblinks_user_waiting_base( "'.$WEBLINKS_DIRNAME.'", $uid, $limit, $offset ) ;
}

' );
// --- eval end ---


// === weblinks_waiting_base begin ===
if( !function_exists( 'b_waiting_weblinks_base' ) ) 
{

function &b_waiting_weblinks_base( $dirname )
{
	$arr    = array();
	$arr[0] = weblinks_waiting_waitings_base( $dirname );
	$arr[1] = weblinks_waiting_modreqs_base(  $dirname );
	$arr[2] = weblinks_waiting_delreqs_base(  $dirname );
	$arr[3] = weblinks_waiting_brokens_base(  $dirname );
	return $arr;
}

function &weblinks_waiting_waitings_base( $dirname )
{
	$arr = array();

	$WEBLINKS_URL = XOOPS_URL.'/modules/'.$dirname;

	$xoopsDB =& Database::getInstance();
	$table_modify = $xoopsDB->prefix( $dirname."_modify" );

	$sql = "SELECT COUNT(*) FROM ".$table_modify." WHERE mode=0";

	$res = $xoopsDB->query( $sql );
	if ( $res ) 
	{
		list( $count ) = $xoopsDB->fetchRow( $res );
		$arr['adminlink']     = $WEBLINKS_URL.'/admin/modify_list.php?op=list_new';
		$arr['pendingnum']    = $count;
		$arr['lang_linkname'] = _WEBLINKS_PI_WAITING_WAITINGS;
	}

	return $arr;
}

function &weblinks_waiting_modreqs_base( $dirname )
{
	$arr = array();

	$WEBLINKS_URL = XOOPS_URL.'/modules/'.$dirname;

	$xoopsDB =& Database::getInstance();
	$table_modify = $xoopsDB->prefix( $dirname."_modify" );

	$sql = "SELECT COUNT(*) FROM ".$table_modify." WHERE mode=1";

	$res = $xoopsDB->query( $sql );
	if ( $res ) 
	{
		list( $count ) = $xoopsDB->fetchRow( $res );
		$arr['adminlink']     = $WEBLINKS_URL.'/admin/modify_list.php?op=list_mod';
		$arr['pendingnum']    = $count;
		$arr['lang_linkname'] = _WEBLINKS_PI_WAITING_MODREQS;
	}

	return $arr;
}

function &weblinks_waiting_delreqs_base( $dirname )
{
	$arr = array();

	$WEBLINKS_URL = XOOPS_URL.'/modules/'.$dirname;

	$xoopsDB =& Database::getInstance();
	$table_modify = $xoopsDB->prefix( $dirname."_modify" );

	$sql = "SELECT COUNT(*) FROM ".$table_modify." WHERE mode=2";

	$res = $xoopsDB->query( $sql );
	if ( $res ) 
	{
		list( $count ) = $xoopsDB->fetchRow( $res );
		$arr['adminlink']     = $WEBLINKS_URL.'/admin/modify_list.php?op=list_del';
		$arr['pendingnum']    = $count;
		$arr['lang_linkname'] = _WEBLINKS_PI_WAITING_DELREQS;
	}

	return $arr;
}

function &weblinks_waiting_brokens_base( $dirname )
{
	$arr = array();

	$WEBLINKS_URL = XOOPS_URL.'/modules/'.$dirname;

	$xoopsDB =& Database::getInstance();
	$table_broken = $xoopsDB->prefix( $dirname."_broken" );

	$sql = "SELECT COUNT(*) FROM ".$table_broken;

	$res = $xoopsDB->query( $sql );
	if ( $res ) 
	{
		list( $count ) = $xoopsDB->fetchRow( $res );
		$arr['adminlink']     = $WEBLINKS_URL.'/admin/broken_list.php';
		$arr['pendingnum']    = $count;
		$arr['lang_linkname'] = _WEBLINKS_PI_WAITING_BROKENS;
	}

	return $arr;
}

function &weblinks_admin_waiting_base( $dirname )
{
	return b_waiting_weblinks_base( $dirname );
}

function &weblinks_user_waiting_base( $dirname, $uid, $limit=0, $offset=0 )
{
	$xoopsDB =& Database::getInstance();
	$table_modify = $xoopsDB->prefix( $dirname."_modify");

	$sql  = 'SELECT * FROM '.$table_modify;
	$sql .= ' WHERE muid='.intval($uid);
	$sql .= ' ORDER BY mid';

	$res = $xoopsDB->query( $sql, $limit, $offset );
	if ( !$res )
	{
		$false = false;
		return $false;
	}

	$arr = array();
	while ( $row = $xoopsDB->fetchArray($res) ) 
	{
		$arr[] = $row;
	}
	return $arr;
}

// === weblinks_waiting_base end ===
}

?>