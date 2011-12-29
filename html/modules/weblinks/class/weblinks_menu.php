<?php
// $Id: weblinks_menu.php,v 1.1 2011/12/29 14:33:05 ohwada Exp $

// 2008-02-17 K.OHWADA
// get_lang_sumit()

// 2007-09-01 K.OHWADA
// use_hits_singlelink

// 2007-02-20 K.OHWADA
// hack for multi site
// hack for multi language

// 2006-10-30 K.OHWADA
// BUG 4344: Error message: Table 'weblinks_config2' doesn't exist
// add exists_table()

// 2006-05-15 K.OHWADA
// this is new file

//=========================================================
// WebLinks Module
// 2006-05-15 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('weblinks_menu') ) 
{

//=========================================================
// class weblinks_menu
// this class is used by xoops_version.php
// this class handle MySQL table directly
// this class does not use another class
//=========================================================
class weblinks_menu
{
// class instance
	var $_db;

	var $_table_config;
	var $_table_category;

// variable
	var $_config_cached;

	var $_flag_replace  = false;
	var $_replace_cat_title = 'aux_text_1';

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_menu( $dirname )
{
// class instance
	$this->_db =& Database::getInstance();

	$this->_table_config   = $this->_db->prefix( $dirname.'_config2' );

// hack for multi language
	$this->_table_category = weblinks_multi_get_table_name($dirname, 'category');
	if ( weblinks_multi_is_japanese_site() )
	{
		$this->_flag_replace = true;
	}

	$this->load();
}

function &getInstance( $dirname )
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new weblinks_menu( $dirname );
	}

	return $instance;
}

//=========================================================
// function for MySQL table
//=========================================================
function load()
{
	static $flag_init_load;

	if ( !isset($flag_init_load) ) 
	{
		$flag_init_load = 1;

		$arr =& $this->get_config();

		if ( isset( $arr['auth_submit'] ) )
		{
			$arr['auth_submit_arr'] = unserialize( $arr['auth_submit'] );
		}

		$this->_config_cached = $arr;
	}
}

function get_by_name($name)
{
	if ( isset( $this->_config_cached[$name] ) )
	{
		$ret = $this->_config_cached[$name];
		return $ret;
	}

	return false;
}

//---------------------------------------------------------
// get from DB
//---------------------------------------------------------
function &get_config()
{
	$arr = array();

// BUG 4344: Error message: Table 'weblinks_config2' doesn't exist
	if ( $this->exists_table( $this->_table_config ) )
	{
		$sql = 'SELECT * FROM '.$this->_table_config.' ORDER BY conf_id ASC';
		$res = $this->_db->query( $sql );

		while ( $row = $this->_db->fetchArray($res) )
		{
			$arr[ $row['conf_name'] ] = $row['conf_value'];
		}
	}

	return $arr;
}

function &get_top_category()
{
	$arr = array();

	$sql = 'SELECT * FROM '.$this->_table_category.' WHERE pid=0 ORDER BY orders, cid';
	$res = $this->_db->query( $sql );

	while ( $row = $this->_db->fetchArray($res) )
	{

// hack for multi language
		if ( $this->_flag_replace )
		{
			$title_multi = $row[ $this->_replace_cat_title ];
			if ( $title_multi )
			{
				$row['title'] = $title_multi;
			}
		}

		$arr[] = $row;
	}
	return $arr;
}

//---------------------------------------------------------
// exists table
//---------------------------------------------------------
function exists_table($table)
{
	$sql = "SHOW TABLES";

	$res = $this->_db->queryF($sql); 
	if ( !$res ) 
	{	return false;	}

	$table_name = strtolower( $table );

	while ($myrow = $this->_db->fetchRow($res)) 
	{
		$name = strtolower( $myrow[0] );

		if ( $name == $table_name )
		{
			return true;
		}
	}

	return false;
}

//---------------------------------------------------------
// get param
//---------------------------------------------------------
function show_submit()
{
	return $this->get_perm_submit();
}

function show_hits()
{
	if ( $this->get_by_name('use_hits') || $this->get_by_name('use_hits_singlelink') )
	{
		return true;
	}
	return false;
}

function show_rating()
{
	return $this->get_by_name('use_ratelink');
}

function &get_catlist()
{
	$arr = array();
	if ( $this->get_by_name('show_catlist') )
	{
		$arr =& $this->get_top_category();
	}
	return $arr;
}

function get_lang_sumit()
{
	return $this->get_by_name('lang_submitlink');
}

function get_lang_hits()
{
	return $this->get_by_name('lang_site_popular');
}

function get_lang_rating()
{
	return $this->get_by_name('lang_site_highrate');
}

//---------------------------------------------------------
// permission
//---------------------------------------------------------
function get_perm_submit()
{
	if ( $this->is_xoops_module_admin() )
	{
		return true;
	}

	$auth_arr = $this->get_by_name('auth_submit_arr');
	if ( !is_array($auth_arr) )
	{
		return false;
	}

	$groups = $this->get_xoops_groups();

	if ( array_intersect( $auth_arr, $groups ) )
	{
		return true;
	}

	return false;
}

//---------------------------------------------------------
// xoops system parameter
//---------------------------------------------------------
function is_xoops_module_admin()
{
	global $xoopsUser, $xoopsModule;

	if ( is_object($xoopsUser) && is_object($xoopsModule) )
	{
		if ( $xoopsUser->isAdmin( $xoopsModule->mid() )) 
		{
			return true;
		}
	}

	return false;
}

function get_xoops_groups()
{
	global $xoopsUser;
	$groups = array();

	if ( is_object($xoopsUser) )
	{
		$groups = $xoopsUser->getGroups();
	}
	else
	{
		$groups = array( XOOPS_GROUP_ANONYMOUS );
	}

	return $groups;
}

// --- class end ---
}

// === class end ===
}

?>