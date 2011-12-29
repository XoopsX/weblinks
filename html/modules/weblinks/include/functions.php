<?php
// $Id: functions.php,v 1.1 2011/12/29 14:32:34 ohwada Exp $

// 2007-09-10 K.OHWADA
// weblinks_get_config()

//=========================================================
// WebLinks Module
// 2007-02-20 K.OHWADA
//=========================================================

// --- weblinks_functions begin ---
if( !function_exists( 'weblinks_get_handler' ) ) 
{

function &weblinks_get_handler($name=null, $module_dir=null)
{
	return happy_linux_get_handler($name, $module_dir, 'weblinks');
}

//---------------------------------------------------------
// for block
//---------------------------------------------------------
function &weblinks_get_config( $DIRNAME ) 
{
	global $xoopsDB;

	$table = $xoopsDB->prefix( $DIRNAME.'_config2' );

	$arr = array();

	$sql = 'SELECT * FROM '. $table .' ORDER BY conf_id ASC';
	$res = $xoopsDB->query($sql, 0, 0);
	if ( !$res )
	{
		return $arr;
	}

	while ($row = $xoopsDB->fetchArray($res)) 
	{
		$arr[ $row['conf_name'] ] = $row['conf_value'];
	}

	return $arr;
}

function weblinks_get_where_public( $conf_broken, $prefix='' ) 
{
	$broken       = $prefix.'broken';
	$time_publish = $prefix.'time_publish';
	$time_expire  = $prefix.'time_expire';

	$time   = time();
	$where  =    ' ( '. $broken .' = 0 OR '. $broken .' < '. $conf_broken .' ) ';
	$where .= 'AND ( '. $time_publish. ' = 0 OR '. $time_publish .' < '. $time .' ) ';
	$where .= 'AND ( '. $time_expire . ' = 0 OR '. $time_expire  .' > '. $time .' ) ';
	return $where;
}

//---------------------------------------------------------
// hack for multi site
//---------------------------------------------------------
// admin/admin_functions.php
function weblinks_multi_is_english_site()
{
	global $xoopsConfig;

	if( defined('WEBLINKS_FLAG_MULTI_SITE') && WEBLINKS_FLAG_MULTI_SITE &&
	    ($xoopsConfig['language'] == 'english') )
	{
		return true;
	}
	return false;
}

// caller: class/link.php
function weblinks_multi_is_japanese_site()
{
	global $xoopsConfig;

	if( defined('WEBLINKS_FLAG_MULTI_SITE') && WEBLINKS_FLAG_MULTI_SITE &&
	    ($xoopsConfig['language'] == 'japanese') )
	{
		return true;
	}
	return false;
}

// caller: include/search.inc.php 
function weblinks_multi_get_table_name($dirname, $table, $flag=true)
{
	if ( $flag && 
	     defined('WEBLINKS_FLAG_MULTI_SITE') && WEBLINKS_FLAG_MULTI_SITE &&
	     defined('WEBLINKS_DB_PREFIX') && WEBLINKS_DB_PREFIX )
	{
		$prefix = WEBLINKS_DB_PREFIX;
	}
	else
	{
		$prefix = XOOPS_DB_PREFIX;
	}

	$val = $prefix . '_' . $dirname . '_' . $table;
	return $val;
}

}
// --- weblinks_functions end ---

?>