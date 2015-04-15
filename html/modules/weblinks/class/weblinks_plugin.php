<?php
// $Id: weblinks_plugin.php,v 1.1 2011/12/29 14:33:06 ohwada Exp $

// 2008-01-18 K.OHWADA
// BUG: not show same category name

// 2007-11-05 K.OHWADA
// Fatal error: Call to undefined method build_plugin_func() in blocks/weblinks_plugin.php

// 2007-07-14 K.OHWADA
// BUG 4640: Call to undefined function: get_selecter_by_id() in blocks/weblinks_plugin.php

// 2007-06-10 K.OHWADA
// d3forum
// get_options_common()

// 2007-04-08 K.OHWADA
// get_album_photos() get_selecter_by_id()

// 2007-03-25 K.OHWADA
// get_config_options() etc

//=========================================================
// WebLinks Module
// 2007-02-20 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('weblinks_plugin') ) 
{

define('WEBLINKS_PLUGIN_ALL',  '-1');
define('WEBLINKS_PLUGIN_NONE', '-2');

//=========================================================
// class weblinks_plugin
//=========================================================
class weblinks_plugin
{
	var $_DIRNAME;
	var $_conf;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_plugin($dirname)
{
	$this->_DIRNAME = $dirname;

	$config_handler =& weblinks_get_handler( 'config2_basic',  $dirname );
	$this->_conf    =& $config_handler->get_conf();
}

public static function &getInstance($dirname)
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new weblinks_plugin($dirname);
	}
	return $instance;
}

//---------------------------------------------------------
// public: selecter 
//---------------------------------------------------------
// config2_form
function &get_config_options( $sel_kind )
{
	$arr2    = array();
	$arr2[0] = '---';

	$arr1 =& $this->_exec_selecter( $sel_kind );

	if ( is_array($arr1) && count($arr1) )
	{
		foreach ($arr1 as $k => $v)
		{
			$arr2[$k] = $v['description'];
		}
	}

	$arr3 = array_flip($arr2);
	return $arr3;
}

//---------------------------------------------------------
// public: get category options 
//---------------------------------------------------------
// category_manage
function &get_options_for_cat_forum()
{
	$arr =& $this->_get_options_common( 'forum', 'forums', 'cat_forum_sel', 'cat_forum_dirname' );
	return $arr;
}

function &get_options_for_cat_album()
{
	$arr =& $this->_get_options_common( 'album', 'albums', 'cat_album_sel', 'cat_album_dirname' );
	return $arr;
}

// config2_form
function &get_options_for_d3forum()
{
	$arr =& $this->_get_options_common( 'd3forum', 'forums', 'd3forum_plugin', 'd3forum_dirname', true, false );
	return $arr;
}

// link_form_admin_handler
function &get_options_for_link_forum()
{
	$arr1 =& $this->get_categories_for_link_forum();
	$arr2 =  array_flip($arr1);
	return $arr2;
}

function &get_options_for_link_album()
{
	$arr1 =& $this->get_categories_for_link_album();
	$arr2 =  array_flip($arr1);
	return $arr2;
}

function &get_categories_for_link_forum()
{
	$arr =& $this->_get_categories_common( 'forum', 'forums', 'link_forum_sel', 'link_forum_dirname' );
	return $arr;
}

function &get_categories_for_link_album()
{
	$arr =& $this->_get_categories_common( 'album', 'albums', 'link_album_sel', 'link_album_dirname' );
	return $arr;
}

//---------------------------------------------------------
// public: forum threads, album_photos 
//---------------------------------------------------------
// link_view_handler
function &get_forum_threads_for_cat( $options=null )
{
	$arr =& $this->_exec_plugin_common( 'forum', 'threads', 'cat_forum_sel', $options );
	return $arr;
}

function &get_forum_threads_for_link( $options=null )
{
	$arr =& $this->_exec_plugin_common( 'forum', 'threads', 'link_forum_sel', $options );
	return $arr;
}

function &get_album_photos_for_cat( $options=null )
{
	$arr =& $this->_get_album_photos_common( 'cat_album_sel', $options );
	return $arr;
}

function &get_album_photos_for_link( $options=null )
{
	$arr =& $this->_get_album_photos_common( 'link_album_sel', $options );
	return $arr;
}

//---------------------------------------------------------
// public: block
//---------------------------------------------------------
// BUG 4640: Call to undefined function: get_selecter_by_id() in blocks/weblinks_plugin.php
function &get_selecter_by_id( $sel_kind, $sel_id )
{
	$val =  false;
	$arr =& $this->_exec_selecter( $sel_kind );
	if ( isset($arr[$sel_id]) )
	{
		$val =& $arr[$sel_id];
	}
	return $val;
}

//---------------------------------------------------------
// selecter 
//---------------------------------------------------------
function _get_filename_by_conf( $sel_kind, $plugin_sel_name )
{
	$name = $this->_get_value_by_conf_key( $sel_kind, $plugin_sel_name, 'name' );
	return $name;
}

function _get_value_by_conf_key( $sel_kind, $conf_name, $key )
{
	$val =  false;
	$sel_id =  $this->_get_conf_value_by_name( $conf_name );
	if ( $sel_id )
	{
		$arr =& $this->get_selecter_by_id( $sel_kind, $sel_id );
		if ( isset($arr[$key]) )
		{
			$val = $arr[$key];
		}
	}
	return $val;
}

function &_exec_selecter( $sel_kind )
{
	$func_sel = 'weblinks_plugin_' . $sel_kind . '_sel';
	$val =& $func_sel();
	return $val;
}

function _get_conf_value_by_name( $conf_name )
{
	if ( isset($this->_conf[$conf_name]) )
	{
		return $this->_conf[$conf_name];
	}
	return false;
}

//---------------------------------------------------------
// each plugin 
//---------------------------------------------------------
function &_get_options_common( $sel_kind, $plugin_kind, $conf_name, $conf_name_dirname, $flag_zero=true, $flag_all=true )
{
	$arr1 =& $this->_get_categories_common( $sel_kind, $plugin_kind, $conf_name, $conf_name_dirname, $flag_zero, $flag_all );
	$arr2 =  array_flip($arr1);
	return $arr2;
}

function &_get_categories_common( $sel_kind, $plugin_kind, $conf_name, $conf_name_dirname, $flag_zero=true, $flag_all=true )
{
	$options = array(
		'dirname' => $this->_get_conf_value_by_name( $conf_name_dirname ),
	);

	$arr =& $this->_get_categories_by_conf( $sel_kind, $plugin_kind, $conf_name, $options, $flag_zero, $flag_all );
	return $arr;
}

function &_get_categories_by_conf( $sel_kind, $plugin_kind, $conf_name, $options, $flag_zero=false, $flag_all=false )
{
	$filename = $this->_get_filename_by_conf( $sel_kind, $conf_name );
	$func     = $this->build_plugin_func( $plugin_kind, $filename );

	$arr =& $this->_get_categories_by_filename( $filename, $func, $options, $flag_zero, $flag_all );
	return $arr;
}

function &_get_categories_by_filename( $filename, $func, $options, $flag_zero=false, $flag_all=false )
{
	$arr2 = array();
	if ( $flag_zero )
	{
		$arr2[0] = '---';
	};

	$arr1 =& $this->exec_plugin( $filename, $func, $options );
	if ( is_array($arr1) && count($arr1) )
	{
		if ( $flag_all )
		{
			$arr2[ WEBLINKS_PLUGIN_ALL ] = 'ALL';
		}
		foreach ($arr1 as $k => $v)
		{
// BUG: not show same category name
// add category id
			$arr2[$k] = $k.': '.$v;
		}
	};

	return $arr2;
}

function &_exec_plugin_common( $sel_kind, $plugin_kind, $plugin_sel_name, $options=null )
{
	$filename = $this->_get_filename_by_conf( $sel_kind, $plugin_sel_name );
	$func     = $this->build_plugin_func( $plugin_kind, $filename );
	$arr =& $this->exec_plugin( $filename, $func, $options );
	return $arr;
}

// Fatal error: Call to undefined method build_plugin_func() in blocks/weblinks_plugin.php
function build_plugin_func( $plugin_kind, $filename )
{
	$func = 'weblinks_plugin_' . $plugin_kind . '_' . $filename;
	return $func;
}

function &exec_plugin( $filename, $func, $options=null )
{
	$file = '/modules/'.$this->_DIRNAME.'/plugins/'.$filename.'.php';
	$arr  = array();

	if ( file_exists( XOOPS_ROOT_PATH.'/'.$file ) )
	{
		include_once XOOPS_ROOT_PATH.'/'.$file;
	}
	else
	{
		return $arr;
	}

	if ( function_exists($func) )
	{
		$arr =& $func( $options );
	}

	return $arr;
}

//---------------------------------------------------------
// album_photos 
//---------------------------------------------------------
function &_get_album_photos_common( $plugin_sel_name, $opts=null )
{
	$dirname     = isset( $opts['dirname'] )      ? $opts['dirname']                : '';
	$width       = isset( $opts['width'] )        ? intval( $opts['width'] )        : 140;
	$album_limit = isset( $opts['album_limit'] )  ? intval( $opts['album_limit'] )  : 1;
	$album_id    = isset( $opts['album_id'] )     ? intval( $opts['album_id'] )     : 0;
	$mode_sub    = isset( $opts['mode_sub'] )     ? intval( $opts['mode_sub'] )     : 1;
	$cycle       = isset( $opts['cycle'] )        ? intval( $opts['cycle'] )        : 60;
	$cols        = isset( $opts['cols'] )         ? intval( $opts['cols'] )         : 3;

	$options = array(
		'dirname'      => $dirname,
		'width'        => $width,
		'album_limit'  => $album_limit,
		'album_id'     => $album_id,
		'mode_sub'     => $mode_sub,
		'cycle'        => $cycle,
		'cols'         => $cols,
	);

	$arr =& $this->_exec_plugin_common( 'album', 'photos', $plugin_sel_name, $options );
	return $arr;
}

// --- class end ---
}

// === class end ===
}

?>