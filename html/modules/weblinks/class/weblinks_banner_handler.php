<?php
// $Id: weblinks_banner_handler.php,v 1.1 2011/12/29 14:33:04 ohwada Exp $

// 2008-01-10 K.OHWADA
// Warning [PHP]: fopen(): failed to open stream: No such file or directory

// 2007-11-01 K.OHWADA
// init_dir_work()
// get_thumb_options()
// Only variables should be assigned by reference

// 2007-09-20 K.OHWADA
// get_cat_image_size()

// 2007-09-10 K.OHWADA
// support mozshot simpleapi

// 2007-05-06 K.OHWADA
// remove image_list_width

// 2007-03-01 K.OHWADA
// change build_show_image

//=========================================================
// WebLinks Module
// 2006-12-10 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('weblinks_banner_handler') ) 
{

//=========================================================
// class weblinks_banner_handler
//=========================================================
class weblinks_banner_handler extends happy_linux_error
{
	var $_DIRNAME;
	var $_DIR_THUMBS;

	var $_config_handler;
	var $_link_handler;
	var $_remote_image;
	var $_image_size;
	var $_strings;
	var $_class_dir;

	var $_conf;

	var $_web_size = array(
		'link_width'  => 0,
		'link_height' => 0,
		'list_width'  => 0,
		'list_height' => 0,
	);

	var $_dir_work;

//-----------------------------------------------
// This is for lower compatibility of mylinks
//-----------------------------------------------
	var $_DIR_SHOTS;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_banner_handler( $dirname )
{
	$this->happy_linux_error();

	$this->_DIRNAME    = $dirname;
	$this->_DIR_THUMBS = '/modules/'.$dirname.'/thumbs';
	$this->_DIR_SHOTS  = '/modules/'.$dirname.'/images/shots';

	$this->_config_handler =& weblinks_get_handler('config2_basic', $dirname );
	$this->_link_handler   =& weblinks_get_handler( 'link_basic',   $dirname );
	$this->_remote_image   =& happy_linux_remote_image::getInstance();
	$this->_image_size     =& happy_linux_image_size::getInstance();
	$this->_strings        =& happy_linux_strings::getInstance();
	$this->_class_dir      =& happy_linux_dir::getInstance();

	$this->_dir_work = $this->_class_dir->init_dir_work();
	$this->_remote_image->set_dir_work( $this->_dir_work );

	$this->_conf =& $this->_config_handler->get_conf();

// if init config
	if ( isset($this->_conf['link_img_thumb']) )
	{
		$this->_init_web_size();
	}
}

//---------------------------------------------------------
// get param
//---------------------------------------------------------
function get_dir_work()
{
	return $this->_dir_work;
}

//---------------------------------------------------------
// show banner
//---------------------------------------------------------
function &build_show_image_web( $banner, $width, $height, $url )
{
	$arr1 =& $this->build_show_image( $banner, $width, $height );

	$image_url         = $arr1['image_url'];
	$image_link_width  = $arr1['image_link_width'];
	$image_link_height = $arr1['image_link_height'];
	$image_list_width  = $arr1['image_list_width'];
	$image_list_height = $arr1['image_list_height'];

	if ( empty($image_url) && $url )
	{
		$image_url = $this->_build_web_url( $url );
		if ( $image_url ) 
		{
			$image_url = $this->_strings->sanitize_url($image_url);
			$image_link_width  = $this->_web_size['link_width'];
			$image_link_height = $this->_web_size['link_height'];
			$image_list_width  = $this->_web_size['list_width'];
			$image_list_height = $this->_web_size['list_height'];
		}
	}

	$arr2 = array(
		'image_url'          => $image_url,
		'image_link_width'   => $image_link_width,
		'image_link_height'  => $image_link_height,
		'image_list_width'   => $image_list_width,
		'image_list_height'  => $image_list_height,
	);

	return $arr2;
}

function &build_show_image( $banner, $width, $height )
{
	$image_url    = '';
	$link_width   = 0;
	$link_height  = 0;
	$list_width   = 0;
	$list_height  = 0;

	if ( $banner )
	{
		$image_url = $this->_assume_banner_url($banner);

// size exist
		if ( $width && $height )
		{
			$arr1 =& $this->_adjust_size( $width, $height );
			$link_width  = $arr1['link_width'];
			$link_height = $arr1['link_height'];
			$list_width  = $arr1['list_width'];
			$list_height = $arr1['list_height'];
		}

		$image_url = $this->_strings->sanitize_url($image_url);
	}

	$arr2 = array(
		'image_url'          => $image_url,
		'image_link_width'   => $link_width,
		'image_link_height'  => $link_height,
		'image_list_width'   => $list_width,
		'image_list_height'  => $list_height,
	);

	return $arr2;
}

function _assume_banner_url($banner)
{
	if ( empty($banner) ) { return $banner; }

// URL style: "http://" or "https://"
	$url = $banner;
	if ( preg_match("|^https?://|", $url) )
	{
		return $url;
	}

// abbreviated style
	$url  = XOOPS_URL       . $banner;
	$file = XOOPS_ROOT_PATH . $banner;

// if exist 
// fopen(): failed to open stream: No such file or directory
	if ( file_exists( $file ) )
	{
		$fp = fopen($file, "r");
		if ( $fp )
		{
			fclose( $fp );
			return $url;
		}
	}

// mylinks style
	$url  = XOOPS_URL       . $this->_DIR_SHOTS .'/'. $banner;
	$file = XOOPS_ROOT_PATH . $this->_DIR_SHOTS .'/'. $banner;

// if exist 
	if ( file_exists( $file ) )
	{
		$fp = fopen($file, "r");
		if ($fp)
		{
			fclose( $fp );
			return $url;
		}
	}

	return false;
}

function &_adjust_size( $width, $height )
{
	list ($list_width, $list_height) 
		= $this->_image_size->adjust_size($width, $height, $this->_conf['list_image_width'], $this->_conf['list_image_height'] );

	list ($link_width, $link_height) 
		= $this->_image_size->adjust_size($width, $height, $this->_conf['link_image_width'], $this->_conf['link_image_height'] );

	$arr = array(
		'link_width'   => $link_width,
		'link_height'  => $link_height,
		'list_width'   => $list_width,
		'list_height'  => $list_height,
	);

	return $arr;
}

//---------------------------------------------------------
// get banner size
//---------------------------------------------------------
function &get_remote_banner_size( $banner )
{
	$size = array(0, 0, 0, '');

	if ( empty($banner) )
	{
		return $size;
	}

	$url = $this->_assume_banner_url($banner);

	$size =& $this->_remote_image->get_image_size($url);
	if ( !$size )
	{
		$this->_set_error_code( $this->_remote_image->getErrorCode() );
		$this->_set_errors(     $this->_remote_image->getErrors() );
	}

	return $size;
}

//---------------------------------------------------------
// get category image size
//---------------------------------------------------------
function &get_cat_image_size( $url )
{
	$false = false;

	if ( empty($url) || ($url == "http://") || ($url == "https://")  )
	{
		return $false;
	}

	$size =& $this->_remote_image->get_image_size( $url );
	if ( !$size )
	{
		$this->_set_error_code( $this->_remote_image->getErrorCode() );
		$this->_set_errors(     $this->_remote_image->getErrors() );
		return $false;
	}

	list( $orig_width, $orig_height ) = $size;

	list( $show_width, $show_height ) = 
		$this->_image_size->adjust_size( $orig_width, $orig_height, $this->_conf['cat_img_width'], $this->_conf['cat_img_height'] );

	$arr = array(
		'orig_width'  => $orig_width,
		'orig_height' => $orig_height,
		'show_width'  => $show_width,
		'show_height' => $show_height,
	);

	return $arr;
}

//---------------------------------------------------------
// web thumbnail
//---------------------------------------------------------
function get_thumb_options()
{
	$opts = array();
	$opts['non'] = _AM_WEBLINKS_LINK_IMG_NON;

	$files =& $this->_class_dir->get_files_in_dir( $this->_DIR_THUMBS, 'php' );

	foreach ( $files as $file )
	{
		$key =  str_replace( '.php', '', $file );
		$arr =& $this->_exec_plugin( $key );
		if ( isset($arr['name']) && isset($arr['url']) )
		{
			$str = '<a href="'.$arr['url'].'" target="_blank">'.$arr['name'].'</a>';
			$opts[ $key ] = sprintf( _AM_WEBLINKS_LINK_IMG_USE, $str );
		}
	}

	$arr2 = array_flip( $opts );
	return $arr2;
}

function _init_web_size()
{
	$arr =& $this->_get_web_size();
	if ( is_array($arr) && count($arr) )
	{
		$this->_web_size =& $arr;
	}
}

// Only variables should be assigned by reference
function &_get_web_size()
{
	$arr2 = null;
	if ( $this->_conf['link_img_thumb'] != 'non' )
	{
		$arr1 =& $this->_exec_plugin( $this->_conf['link_img_thumb'] );
		if ( is_array($arr1) && isset($arr1['width']) && isset($arr1['height']) )
		{
			$arr2 =& $this->_adjust_size( $arr1['width'], $arr1['height'] );
		}
	}
	return $arr2;
}

function _build_web_url( $url )
{
	$image = '';
	if ( $this->_conf['link_img_thumb'] != 'non' )
	{
		$arr =& $this->_exec_plugin( $this->_conf['link_img_thumb'], $url );
		if ( is_array($arr) && isset($arr['image']) )
		{
			$image = $arr['image'];
		}
	}
	return $image;
}

function &_exec_plugin( $key, $url='' )
{
	$file = $this->_DIR_THUMBS.'/'.$key.'.php';
	$func = 'weblinks_thumb_'.  $key;

	$arr  = array();

	if ( file_exists( XOOPS_ROOT_PATH.'/'.$file ) ) {
		include_once XOOPS_ROOT_PATH.'/'.$file;
	} else {
		return $arr;
	}

	if ( function_exists($func) )
	{
		$arr =& $func( $url );
	}

	return $arr;
}

// --- class end ---
}

// === class end ===
}

?>