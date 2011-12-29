<?php
// $Id: weblinks_build_rss_feed_handler.php,v 1.1 2011/12/29 14:33:07 ohwada Exp $

// 2007-10-10 K.OHWADA
// divid from feed_rss.php

// 2007-06-01 K.OHWADA
// rssc_view_handler
// api/rss_builder.php

// 2006-09-20 K.OHWADA
// this is new file
// porting from rssc_build_rss
// use rssc WEBLINKS_RSSC_EXIST

//=========================================================
// WebLinks Module
// 2006-09-20 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('weblinks_build_rss_feed_handler') ) 
{

//=========================================================
// class weblinks_build_rss_feed_handler
//=========================================================
class weblinks_build_rss_feed_handler extends rssc_build_rssc
{
	var $_DIRNAME;
	var $_DIR_XML;

	var $_MAX_FEEDS = 20;

	var $_rssc_view_handler;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_build_rss_feed_handler( $dirname )
{
	$DIR_XML = XOOPS_ROOT_PATH.'/modules/'.$dirname.'/templates/xml';

	$this->rssc_build_rssc( $dirname );
	$this->set_rdf_template(  $DIR_XML.'/weblinks_build_feed_rdf.html' );
	$this->set_rss_template(  $DIR_XML.'/weblinks_build_feed_rss.html' );
	$this->set_atom_template( $DIR_XML.'/weblinks_build_feed_atom.html' );
	$this->set_cache_time_guest( $this->_CACHE_TIME_ONE_HOUR );

	$this->_rssc_view_handler =& weblinks_get_handler( 'rssc_view', $dirname );
}

//---------------------------------------------------------
// public
//---------------------------------------------------------
function build_for_weblinks( $mode )
{
	$this->set_mode( $mode );
	$this->build_rss();
}

function view_for_weblinks( $mode )
{
	$this->set_mode( $mode );
	$this->view_rss();
}

//---------------------------------------------------------
// private
//---------------------------------------------------------
function &_get_feeds_for_weblinks()
{
	return $this->_rssc_view_handler->get_feed_list_latest( $this->_MAX_FEEDS );
}

//=========================================================
// override into build_rss
//=========================================================
function &_get_items()
{
	return $this->_get_feeds_for_weblinks();
}

// --- class end ---
}

// === class end ===
}

?>