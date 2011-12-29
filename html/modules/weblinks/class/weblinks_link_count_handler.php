<?php
// $Id: weblinks_link_count_handler.php,v 1.1 2011/12/29 14:33:04 ohwada Exp $

// 2008-02-17 K.OHWADA
// gmap

// 2007-11-01 K.OHWADA
// divid from weblinks_link_view_handler

//=========================================================
// WebLinks Module
// 2006-05-15 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('weblinks_link_count_handler') ) 
{

//=========================================================
// class weblinks_link_count_handler
// show link count in guidance bar
//=========================================================
class weblinks_link_count_handler extends happy_linux_error
{
	var $_DIRNAME;

	var $_config_handler;
	var $_link_handler;
	var $_category_handler;
	var $_catlink_handler;
	var $_link_catlink_handler;

// local
	var $_conf = array();
	var $_cached_cid  = array();
	var $_cached_mark = array();

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_link_count_handler( $dirname )
{
	$this->happy_linux_error();
	$this->set_debug_print_time( WEBLINKS_DEBUG_TIME );

	$this->_DIRNAME = $dirname;

	$this->_config_handler       =& weblinks_get_handler( 'config2_basic',      $dirname );
	$this->_link_handler         =& weblinks_get_handler( 'link_basic',         $dirname );
	$this->_category_handler     =& weblinks_get_handler( 'category_basic',     $dirname );
	$this->_catlink_handler      =& weblinks_get_handler( 'catlink_basic',      $dirname );
	$this->_link_catlink_handler =& weblinks_get_handler( 'link_catlink_basic', $dirname );

	$this->_conf =& $this->_config_handler->get_conf();

}

//=========================================================
// public
//=========================================================
//---------------------------------------------------------
// init
//---------------------------------------------------------
function init()
{
	$this->_category_handler->load_once();
}

//---------------------------------------------------------
// link count
//---------------------------------------------------------
// index
function get_link_count_public()
{
	if ( isset($this->_cached_mark['public']) )
	{
		return intval( $this->_cached_mark['public'] );
	}

	$count = $this->_link_handler->get_count_public();
	$this->_cached_mark['public'] = $count;
	return $count;
}

// viewmark
function get_link_count_by_mark( $mark )
{
	if ( isset($this->_cached_mark[$mark]) )
	{
		return intval( $this->_cached_mark[$mark] );
	}

	if ( $mark == 'rss' )
	{
		$count = $this->_link_handler->get_count_rss_flag();
	}
	elseif ( $mark == 'gmap' )
	{
		$count = $this->_link_handler->get_count_gmap();
	}
	else
	{
		$count = $this->_link_handler->get_count_by_mark($mark);
	}

	$this->_cached_mark[$mark] = $count;
	return $count;
}

// viewcat
function get_top_link_count_by_cid($cid)
{
	if ( isset($this->_cached_cid[$cid]['top_link_count']) )
	{
		return intval( $this->_cached_cid[$cid]['top_link_count'] );
	}

	$count = $this->_link_catlink_handler->get_count_by_cid( $cid );
	$this->_cached_cid[$cid]['top_link_count'] = $count;
	return $count;
}

// viewcat
function get_all_link_count_by_cid( $cid )
{
	if ( isset($this->_cached_cid[$cid]['all_link_count']) )
	{
		return intval( $this->_cached_cid[$cid]['all_link_count'] );
	}

	if ( $this->_conf['cat_count'] )
	{
		$count = $this->_category_handler->get_link_count($cid);
	}
	else
	{
		$cid_arr =& $this->get_cid_array_patent_children($cid);
		$count   =  $this->_link_catlink_handler->get_count_by_cid_array($cid_arr);
	}

	$this->_cached_cid[$cid]['all_link_count'] = $count;
	return $count;
}

// search
function get_link_count_by_cid_array_where( &$cid_arr, $where )
{
	return $this->_link_catlink_handler->get_count_by_cid_array_where( $cid_arr, $where );
}

// search
function get_link_count_by_where($where)
{
	return $this->_link_handler->get_count_by_where($where);
}

//---------------------------------------------------------
// cid array
//---------------------------------------------------------
function &get_cid_array_patent_children($cid)
{
	return $this->_category_handler->get_parent_and_all_child_id($cid);
}

//---------------------------------------------------------
// config
//---------------------------------------------------------
function get_config()
{
	return $this->_conf;
}

// --- class end ---
}

// === class end ===
}

?>