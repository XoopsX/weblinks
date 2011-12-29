<?php
// $Id: weblinks_build_rss_handler.php,v 1.1 2011/12/29 14:33:03 ohwada Exp $

// 2008-02-17 K.OHWADA
// weblinks_htmlout

// 2007-10-10 K.OHWADA
// build_for_link()
// _date_rfc822()

// 2007-07-20 K.OHWADA
// georss
// set_param()

// 2007-03-01 K.OHWADA
// link_basic_handler

// 2006-09-20 K.OHWADA
// this is new file
// porting from rssc_build_rssc

//=========================================================
// WebLinks Module
// 2006-09-20 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('weblinks_build_rss_handler') ) 
{

//=========================================================
// class weblinks_build_rss_handler
//=========================================================
class weblinks_build_rss_handler extends happy_linux_build_rss
{
	var $_MAX_ITEMS = 20;
	var $_DIRNAME;

	var $_config_handler;
	var $_link_handler;
	var $_link_view;
	var $_htmlout;

	var $_conf;

	var $_param = array();

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_build_rss_handler( $dirname )
{
	$this->_DIRNAME = $dirname;

	$DIR_XML = XOOPS_ROOT_PATH.'/modules/'.$dirname.'/templates/xml';

	$this->happy_linux_build_rss();
	$this->set_rdf_template(  $DIR_XML.'/weblinks_build_rdf.html' );
	$this->set_rss_template(  $DIR_XML.'/weblinks_build_rss.html' );
	$this->set_atom_template( $DIR_XML.'/weblinks_build_atom.html' );
	$this->set_generator(  'XOOPS WebLinks' );
	$this->set_category(   'WebLinks' );
	$this->set_rdf_title(  'WebLinks: RDF Feeds' );
	$this->set_rss_title(  'WebLinks: RSS Feeds' );
	$this->set_atom_title( 'WebLinks: ATOM Feeds' );
	$this->set_flag_default_timezone( true );
	$this->set_cache_time_guest( $this->_CACHE_TIME_ONE_HOUR );

	$this->_config_handler =& weblinks_get_handler('config2_basic',  $dirname );
	$this->_link_handler   =& weblinks_get_handler( 'link_basic',    $dirname );
	$this->_link_view      =& weblinks_link_view::getInstance( $dirname );
	$this->_htmlout        =& weblinks_htmlout::getInstance(   $dirname );

	$this->_conf = $this->_config_handler->get_conf();
	$this->_htmlout->add_plugin_line( 'rssout', $this->_conf['rssout'] );
}

//---------------------------------------------------------
// public
//---------------------------------------------------------
function build_for_link()
{
	$link = isset($_GET['link']) ? $_GET['link'] : null;

	$param = array(
		'link' => $link,
	);

	$this->_set_param( $param );

	$this->build( 'rss' );
}

function build( $mode )
{
	$this->set_mode( $mode );
	$this->build_rss();
}

function view( $mode )
{
	$this->set_mode( $mode );
	$this->view_rss();
}

//---------------------------------------------------------
// $_GET param
//---------------------------------------------------------
function _set_param( $param )
{
	if ( is_array($param) )
	{
		$this->_param = $param;
	}
}

function _match_param( $key, $val )
{
	if ( isset($this->_param[$key]) && ($this->_param[$key] == $val) )
	{
		return true;
	}
	return false;
}

//---------------------------------------------------------
// link handler
//---------------------------------------------------------
function &_get_latest()
{
	$lid_arr =& $this->_link_handler->get_lid_array_latest( $this->_MAX_ITEMS );

	$arr = array();
	if ( is_array($lid_arr) && ( count($lid_arr) > 0 ) )
	{
		foreach ($lid_arr as $lid)
		{
			$arr[] = $this->_get_rss_by_lid( $lid );
		}
	}
	return $arr;
}

function _get_rss_by_lid( $lid )
{
// not use return references
	$arr1 = $this->_link_view->get_rss_by_lid( $lid );
	$arr2 = $this->_htmlout->execute( $arr1 );
	$arr3 = $arr2;
	foreach ( $arr2 as $k => $v )
	{
// match
		if ( strpos( $k, 'rss_' ) === 0 )
		{
			$name = str_replace( 'rss_', '', $k );
			$arr3[ $name ] = $v;
		}
	}
	return $arr3;
}

//=========================================================
// override into build_rss
//=========================================================
function &_get_items()
{
	return $this->_get_latest();
}

//---------------------------------------------------------
// RDF
//---------------------------------------------------------
function &_build_rdf_item( &$item )
{
	$ret =& $this->_build_rdf_item_default( $item );
	return $ret;
}

//---------------------------------------------------------
// RSS
//---------------------------------------------------------
function &_build_rss_item( &$item )
{
	$ret =& $this->_build_rss_item_default( $item );
	return $ret;
}

//---------------------------------------------------------
// ATOM
//---------------------------------------------------------
function &_build_atom_entry( &$entry )
{
	$ret =& $this->_build_atom_entry_default( $entry );
	return $ret;
}

//---------------------------------------------------------
// common
//---------------------------------------------------------
function &_build_common_item( &$item )
{
// title content 
	$title_xml   = $this->_build_xml_title(   $item['title'] );
	$content_xml = $this->_build_xml_content( $item['content'] );
	$sum_xml     = $this->_build_xml_summary( $item['content'], 0, 0 );

	$category_xml    = $this->_xml( $item['category'] );
	$author_name_xml = $this->_xml( $item['author_name'] );

	$published_unix  = intval( $item['time_create'] );
	$updated_unix    = intval( $item['time_update'] );
	$published_rfc822_xml  = $this->_xml( $this->_date_rfc822(  $published_unix ) );
	$updated_rfc822_xml    = $this->_xml( $this->_date_rfc822(  $updated_unix ) );
	$published_iso8601_xml = $this->_xml( $this->_date_iso8601( $published_unix ) );
	$updated_iso8601_xml   = $this->_xml( $this->_date_iso8601( $updated_unix ) );

// geo rss
	$lat  = null;
	$long = null;
	if (( $item['gm_latitude'] != 0 )||( $item['gm_longitude'] != 0 )||( $item['gm_zoom'] != 0 ))
	{
		$lat  = floatval( $item['gm_latitude'] );
		$long = floatval( $item['gm_longitude'] );
	}

// show original URL if link=source
	if ( $this->_match_param('link', 'source' ) && $item['url'] ) 
	{
		$link_xml = $this->_xml_url( $item['url'] );
	}
// this site singlink
	else 
	{
		$link_xml = $this->_xml_url( $item['link'] );
	}

	$ret = array(
		'link'              => $link_xml,
		'guid'              => $link_xml,
		'entry_id'          => '',
		'author_uri'        => $this->_xml_url( $item['author_uri'] ),
		'author_email'      => $this->_xml(     $item['author_email'] ),
		'author_name'       => $author_name_xml,
		'title'             => $title_xml,
		'summary'           => $sum_xml,
		'description'       => $sum_xml,
		'content'           => $content_xml,
		'category'          => $category_xml,
		'published_unix'    => $published_unix,  // unixtime
		'updated_unix'      => $updated_unix,    // unixtime
		'published_rfc822'  => $published_rfc822_xml,
		'date_rfc822'       => $published_rfc822_xml,
		'updated_rfc822'    => $updated_rfc822_xml,
		'published_iso8601' => $published_iso8601_xml,
		'date_iso8601'      => $published_iso8601_xml,
		'updated_iso8601'   => $updated_iso8601_xml,
		'dc_subject'        => $category_xml,
		'dc_creator'        => $author_name_xml,
		'dc_date'           => $published_iso8601_xml,
		'content_encoded'   => $content_xml,
		'geo_lat'           => $lat,
		'geo_long'          => $long,
	);

	return $ret;
}

// --- class end ---
}

// === class end ===
}

?>