<?php
// $Id: weblinks_rssc_view_handler.php,v 1.1 2011/12/29 14:33:09 ohwada Exp $

// 2007-11-11 K.OHWADA
// set_feed_keyword_array()

// 2007-08-19 K.OHWADA
// BUG 4689: number of feeds is unlimited in singlelink

// 2007-06-01 K.OHWADA
// divid from weblinks_rssc_handler

//=========================================================
// WebLinks Module
// 2007-06-01 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('weblinks_rssc_view_handler') ) 
{

//=========================================================
// class weblinks_rssc_view_handler
//=========================================================
class weblinks_rssc_view_handler extends happy_linux_error
{
// handler
	var $_rssc_view_handler;

// set variable
	var $_mid;

// input parameter
	var $_feed_order = 'updated_unix DESC, fid DESC';
	var $_feed_start =  0;
	var $_feed_limit = 10;
	var $_feed_flag_sanitize = true;

// sanitize param
	var $_feed_flag_title_html   = false;	// not allow 
	var $_feed_flag_content_html = false;	// not allow
	var $_feed_max_summary = 250;
	var $_feed_max_title   =  -1;	// unlimited
	var $_feed_max_content =  -1;	// unlimited
	var $_feed_keyword_array = array();
	var $_feed_highlight     = false;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_rssc_view_handler( $dirname )
{
	$this->happy_linux_error();

// Fatal error: Call to undefined function: rssc_get_handler()
	if ( WEBLINKS_RSSC_EXIST && function_exists('rssc_get_handler') )
	{
		$this->_rssc_view_handler =& rssc_get_handler('view', WEBLINKS_RSSC_DIRNAME );
	}

	global $xoopsModule;
	if ( is_object($xoopsModule) )
	{
		$this->set_mid( $xoopsModule->getVar('mid') );
	}
}

//---------------------------------------------------------
// link_handler
//---------------------------------------------------------
function &get_rssc_link_by_rssc_lid( $rssc_lid )
{
	$row =& $this->_rssc_view_handler->get_link_by_lid($rssc_lid);
	return $row;
}

//---------------------------------------------------------
// feed_handler
//---------------------------------------------------------
// admin menu
function get_feed_count_all()
{
	$count = $this->_rssc_view_handler->get_feed_count_all();
	return $count;
}

// caller: viewfeed.php class/weblinks_template.php
function get_feed_count()
{
	$count = false;
	if ( WEBLINKS_RSSC_USE )
	{
		$count = $this->_rssc_view_handler->get_feed_count_by_mid($this->_mid);
	}
	return $count;
}

function get_feed_count_by_where( $where )
{
	$count = $this->_rssc_view_handler->get_feed_count_by_where( $where );
	return $count;
}

// caller: index.php viewfeed.php
function &get_feed_list_latest($limit=0, $start=0)
{
	$feeds = false;
	if ( WEBLINKS_RSSC_USE )
	{
		$this->_rssc_view_handler->setFlagSanitize(   $this->_feed_flag_sanitize );
		$this->_rssc_view_handler->set_title_html(    $this->_feed_flag_title_html );
		$this->_rssc_view_handler->set_content_html(  $this->_feed_flag_content_html );
		$this->_rssc_view_handler->set_max_title(     $this->_feed_max_title );
		$this->_rssc_view_handler->set_max_content(   $this->_feed_max_content );
		$this->_rssc_view_handler->set_max_summary(   $this->_feed_max_summary );
		$this->_rssc_view_handler->set_keyword_array( $this->_feed_keyword_array );
		$this->_rssc_view_handler->set_highlight(     $this->_feed_highlight );
		$this->_rssc_view_handler->setFeedLimit( $limit );
		$this->_rssc_view_handler->setFeedStart( $start );
		$feeds =& $this->_rssc_view_handler->get_feed_list_by_mid( $this->_mid );
	}
	return $feeds;
}

function &get_feed_list_latest_by_rssclid($rssc_lid, $limit=0, $start=0)
{
	$this->_rssc_view_handler->setFlagSanitize(   $this->_feed_flag_sanitize );
	$this->_rssc_view_handler->set_title_html(    $this->_feed_flag_title_html );
	$this->_rssc_view_handler->set_content_html(  $this->_feed_flag_content_html );
	$this->_rssc_view_handler->set_max_title(     $this->_feed_max_title );
	$this->_rssc_view_handler->set_max_content(   $this->_feed_max_content );
	$this->_rssc_view_handler->set_max_summary(   $this->_feed_max_summary );
	$this->_rssc_view_handler->set_keyword_array( $this->_feed_keyword_array );
	$this->_rssc_view_handler->set_highlight(     $this->_feed_highlight );

// BUG 4689: number of feeds is unlimited in singlelink
	$feeds =& $this->_rssc_view_handler->get_feeds_by_lid( $rssc_lid, $limit, $start );

	return $feeds;
}

function &get_feeds_by_where( $where, $query_array, $limit=0, $start=0 )
{
	$this->_rssc_view_handler->set_title_html(   $this->_feed_flag_title_html );
	$this->_rssc_view_handler->set_content_html( $this->_feed_flag_content_html );
	$this->_rssc_view_handler->set_max_title(    $this->_feed_max_title );
	$this->_rssc_view_handler->set_max_content(  $this->_feed_max_content );
	$this->_rssc_view_handler->set_max_summary(  $this->_feed_max_summary );
	$this->_rssc_view_handler->set_keyword_array( $query_array);
	$this->_rssc_view_handler->set_highlight( true );

	$feeds =& $this->_rssc_view_handler->get_feeds_by_where( $where, $limit, $start );
	return $feeds;
}

//---------------------------------------------------------
// sanitize property
//---------------------------------------------------------
function set_mid($value)
{
	$this->_mid = intval($value);
}

function set_feed_order($value)
{
	$this->_feed_order = $value;
}

function set_feed_start($value)
{
	$this->_feed_start = intval($value);
}

function set_feed_limit($value)
{
	$this->_feed_limit = intval($value);
}

function set_feed_flag_sanitize($value)
{
	$this->_feed_flag_sanitize = (bool)$value;
}

function set_feed_flag_title_html($value)
{
	$this->_feed_flag_title_html = (bool)$value;
}

function set_feed_flag_content_html($value)
{
	$this->_feed_flag_content_html = (bool)$value;
}

function set_feed_max_title($value)
{
	$this->_feed_max_title = intval($value);
}

function set_feed_max_summary($value)
{
	$this->_feed_max_summary = intval($value);
}

function set_feed_max_content($value)
{
	$this->_feed_max_content = intval($value);
}

function set_feed_keyword_array( &$arr )
{
	if ( is_array($arr) && count($arr) )
	{
		$this->_feed_keyword_array =& $arr;
	}
}

function set_feed_highlight($value)
{
	$this->_feed_highlight = (bool)$value;
}

// --- class end ---
}

// === class end ===
}

?>