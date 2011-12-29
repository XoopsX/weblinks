<?php
// $Id: weblinks_pagerank_handler.php,v 1.1 2011/12/29 14:33:05 ohwada Exp $

//=========================================================
// WebLinks Module
// 2008-02-17 K.OHWADA
//=========================================================

//=========================================================
// class weblinks_pagerank_handler
//=========================================================

// === class begin ===
if( !class_exists('weblinks_pagerank_handler') ) 
{

class weblinks_pagerank_handler extends happy_linux_error
{
	var $_DIRNAME;

	var $_link_handler;
	var $_pagerank;

	var $_CACHE_TIME_LONG  = 0;
	var $_CACHE_TIME_SHORT = 0;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_pagerank_handler( $dirname )
{
	$this->_DIRNAME = $dirname;

	$this->_link_handler =& weblinks_get_handler( 'link_basic', $dirname );
	$this->_pagerank     =& happy_linux_get_singleton( 'pagerank' );

	$this->_CACHE_TIME_LONG  = 30*24*60*60;	// one month
	$this->_CACHE_TIME_SHORT =    24*60*60;	// one day
}

//---------------------------------------------------------
// public
//---------------------------------------------------------
function get_page_rank( $lid, $flag_cache=true, $flag_force=false )
{
	$row = $this->_link_handler->get_cache_by_lid( $lid );
	if ( !is_array($row) || !count($row) )
	{	return 0;	}

	$url             = $row['url'];
	$pagerank        = $row['pagerank'];
	$pagerank_update = $row['pagerank_update'];

	$pr = $pagerank;

	if ( $flag_force || 
	   ( $flag_cache && !$this->_check_time( $pagerank, $pagerank_update ) ) )
	{
		$pr = $this->get_page_rank_from_google( $url, $pagerank );
		$this->_update( $lid, $pr );
	}

	if ( $pr < _HAPPY_LINUX_PAGERANK_C_MIN ) { $pr =  _HAPPY_LINUX_PAGERANK_C_MIN; }
	if ( $pr > _HAPPY_LINUX_PAGERANK_C_MAX ) { $pr = _HAPPY_LINUX_PAGERANK_C_MAX; }

	return intval($pr);
}

function get_page_rank_from_google( $url, $pr_prev )
{
	$pr = $this->_pagerank->get_page_rank( $url );
	switch ( $pr ) 
	{
		case _HAPPY_LINUX_PAGERANK_C_CONN:
			$this->_set_errors( $this->_pagerank->errstr );
			break;

		case _HAPPY_LINUX_PAGERANK_C_RANK:
			$this->_set_errors( $this->_pagerank->google_url );
			$this->_set_errors( $this->_pagerank->contents );
			break;
	}

// probably temporary error
	if (( $pr < _HAPPY_LINUX_PAGERANK_C_MIN )&&( $pr_prev > _HAPPY_LINUX_PAGERANK_C_MIN ))
	{
		$pr = $pr_prev;
	}

	return $pr;
}

function _check_time( $pagerank, $pagerank_update )
{
	$cache_time = $this->_CACHE_TIME_LONG;
	if ( $pagerank < _HAPPY_LINUX_PAGERANK_C_MIN )
	{
		$cache_time = $this->_CACHE_TIME_SHORT;
	}

	if ( time() < ( $pagerank_update + $cache_time ) )
	{	return true;	}

	return false;
}

function _update( $lid, $pr )
{
	$ret = $this->_link_handler->update_pagerank( $lid, $pr, time() );
	if ( !$ret )
	{
		$this->_set_errors( $this->_link_handler->getErrors('n') );
	}
}

// --- class end ---
}

// === class end ===
}


?>