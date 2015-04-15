<?php
// $Id: search.php,v 1.1 2012/04/09 10:20:05 ohwada Exp $

// 2007-11-01 K.OHWADA
// happy_linux_get_memory_usage_mb()
// BUG: NOT succeed cid 

// 2007-09-20 K.OHWADA
// PHP5.2
// getInstance()

// 2007-08-01 K.OHWADA
// weblinks_header

// 2007-07-14 K.OHWADA
// use_highlight

// 2007-07-14 K.OHWADA:
// BUG 4637: dont work OR search

// 2007-06-01 K.OHWADA
// rssc_view_handler

// 2007-03-01 K.OHWADA
// happy_linux_time

// 2006-12-10 K.OHWADA
// use build_sql_where_exclude

// 2006-10-14 K.OHWADA
// show google search
// search with category, mark
// search in rssc
// show execution time

// 2006-10-01 K.OHWADA
// use happy_linux
// fazzy search

// 2006-07-23 K.OHWADA
// BUG 4153: not show catpath in search

// 2006-05-15 K.OHWADA
// add class weblinks_search()
// use class weblinks_pagenavi
// use new handler

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication

//================================================================
// WebLinks Module
// search
// porting from system
// 2004/01/14 K.OHWADA
//================================================================

include 'header.php';

//=========================================================
// class weblinks_search
//=========================================================
class weblinks_search extends happy_linux_search
{
	var $_link_view_handler;
	var $_rssc_handler;
	var $_pagenavi;

// config
	var $_conf;

	var $_post_cid    = 0;
	var $_post_subcat = 0;
	var $_post_mark   = '';

	var $_link_query_array;
	var $_link_where;
	var $_feed_where;
	var $_start = 0;
	var $_cid_arr = array();

	var $_orderby = 'time_update DESC';

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_search( $dirname )
{
	$this->happy_linux_search();
	$this->set_lang_zenkaku(_HAPPY_LINUX_ZENKAKU);
	$this->set_lang_hankaku(_HAPPY_LINUX_HANKAKU);

	$this->_link_view_handler =& weblinks_get_handler( 'link_view',     $dirname );
	$this->_rssc_handler      =& weblinks_get_handler( 'rssc_view',     $dirname );
	$config_handler           =& weblinks_get_handler( 'config2_basic', $dirname );

	$this->_pagenavi =& happy_linux_pagenavi::getInstance();

	$this->_conf = $config_handler->get_conf();

	$this->set_min_keyword( $this->_conf['search_min'] );
}

public static function &getInstance( $dirname )
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new weblinks_search( $dirname );
	}
	return $instance;
}

//---------------------------------------------------------
// get $_POST & $_GET
//---------------------------------------------------------
// BUG 4637: dont work OR search
function get_post_get()
{
	$this->get_post_get_action();
	$this->get_post_get_query();
	$this->get_post_get_andor();
	$this->get_post_get_uid();
	$this->get_post_get_mid();
	$this->get_post_get_start();
	$this->get_post_get_mids();
	$this->get_post_get_showcontext();
	$this->get_post_get_mark();
	$this->get_post_get_cid();
	$this->get_post_get_subcat();
}

function get_post_get_mark()
{
	$this->_post_mark = $this->_post->get_post_get_text('mark');
	return $this->_post_mark;
}

function get_post_get_cid()
{
	$this->_post_cid = $this->_post->get_post_get_int('cid');
	return $this->_post_cid;
}

function get_post_get_subcat()
{
	$this->_post_subcat = $this->_post->get_post_get_int('subcat');
	return $this->_post_subcat;
}

//---------------------------------------------------------
// get param
//---------------------------------------------------------
function get_conf()
{
	return $this->_conf;
}

//---------------------------------------------------------
// link handler
//---------------------------------------------------------
function get_link_total()
{
	$code = $this->check_build_sql_query_array();
	switch ($code)
	{
		case HAPPY_LINUX_SEARCH_CODE_SQL_NO_CAN:
		case HAPPY_LINUX_SEARCH_CODE_SQL_MERGE:
			$this->_build_sql_search($this->_sql_query_array, null, $this->_sql_andor);
			$this->_link_query_array = $this->_sql_query_array;
			break;

		case HAPPY_LINUX_SEARCH_CODE_SQL_CAN:
			$this->_build_sql_search($this->_query_array, $this->_candidate_keyword_array, $this->_mode_andor);
			$this->_link_query_array = $this->_query_array;
			break;
	}

	$this->_total = $this->_get_link_count();
	return $this->_total;
}

function get_link_list()
{
	$navi = '';

	$search_links = $this->_conf['search_links'];
	$this->_pagenavi->setPerpage( $search_links );
	$this->_pagenavi->setTotal(   $this->_total );

	$this->_pagenavi->getGetPage();
	$start = $this->_pagenavi->calcStart();
	$this->_start = $start;

	$this->_link_view_handler->set_keyword_array( $this->_merged_query_array );

// BUG: not show catpath in search
	$this->_link_view_handler->init();
	$link_list =& $this->_get_link_list($search_links, $start);

// next page
	if ( $this->_total > $search_links )
	{
		$script = $this->_build_script();
		$navi   = $this->_pagenavi->build($script);
	}

	return array($link_list, $navi);
}

function _build_script()
{
	$script  = WEBLINKS_URL.'/search.php?action=results';
	$script .= '&amp;query='.$this->get_query_urlencode();
	$script .= '&amp;andor='.$this->get_andor();

// BUG: NOT succeed cid 
	if ( $this->_post_mark )
	{
		$script .= '&amp;mark='.$this->_post_mark;
	}
	if ( $this->_post_cid )
	{
		$script .= '&amp;cid='.$this->_post_cid;
	}
	if ( $this->_post_subcat )
	{
		$script .= '&amp;subcat='.$this->_post_subcat;
	}
	return $script;
}

function _build_sql_search($query_array1, $query_array2=null, $andor='AND')
{
	$where  = '';
	$where1 = '';

	$where_single = $this->build_single_double_where('search', $query_array1, $query_array2, $andor);

	if ( $this->_post_cid  )
	{
		$where .= $this->_link_view_handler->build_sql_where_exclude_join();

		$where_single_2 = $this->build_single_double_where('l.search', $query_array1, $query_array2, $andor);
		if ( $where_single_2 )
		{
			$where .= ' AND '.$where_single_2;
		}

		if ( $this->_post_mark )
		{
			$where .= ' AND l.'.$this->_post_mark.'=1';
		}
	}
	else
	{
		$where .= $this->_link_view_handler->build_sql_where_exclude();

		if ( $where_single )
		{
			$where .= ' AND '.$where_single;
		}

		if ( $this->_post_mark )
		{
			$where .= ' AND '.$this->_post_mark.'=1';
		}
	}

	$this->_link_where = $where;
	$this->_feed_where = $where_single;
}

function _get_link_count()
{
	if ( $this->_post_cid )
	{
		if ($this->_post_subcat )
		{
			$this->_cid_arr =& $this->_link_view_handler->get_cid_array_patent_children( $this->_post_cid );
		}
		else
		{
			$this->_cid_arr = array( $this->_post_cid );
		}

		$total = $this->_link_view_handler->get_link_count_by_cid_array_where($this->_cid_arr, $this->_link_where);
	}
	else
	{
		$total = $this->_link_view_handler->get_link_count_by_where( $this->_link_where );
	}

	return $total;
}

function &_get_link_list($limit, $start)
{
	if ( $this->_post_cid )
	{
		$link_list =& $this->_link_view_handler->get_link_list_by_cid_array_where_orderby($this->_cid_arr, $this->_link_where, $this->_orderby, $limit, $start);
	}
	else
	{
		$link_list =& $this->_link_view_handler->get_link_list_by_where($this->_link_where, $limit, $start);
	}

	return $link_list;
}

//---------------------------------------------------------
// rssc handler
//---------------------------------------------------------
function get_feed_count()
{
	$count = $this->_rssc_handler->get_feed_count_by_where( $this->_feed_where );
	return $count;
}

function &get_feeds()
{
	$this->_rssc_handler->set_feed_max_summary( $this->_conf['rss_max_summary'] );

	$feeds =& $this->_rssc_handler->get_feeds_by_where( $this->_feed_where, $this->_sql_query_array, $this->_conf['search_links'], $this->_start );
	return $feeds;
}

//---------------------------------------------------------
// set keyword property
//---------------------------------------------------------
function set_highlight($value)
{
	$this->_link_view_handler->set_highlight($value);
}

function set_keyword_array( &$arr )
{
	$this->_link_view_handler->set_keyword_array( $arr );
}

// --- class end ---
}


//================================================================
// main
//================================================================

$weblinks_template =& weblinks_template::getInstance( WEBLINKS_DIRNAME );
$weblinks_header   =& weblinks_header::getInstance(   WEBLINKS_DIRNAME );
$weblinks_search   =& weblinks_search::getInstance(   WEBLINKS_DIRNAME );

// --- template start ---
// xoopsOption[template_main] should be defined before including header.php
$xoopsOption['template_main'] = WEBLINKS_DIRNAME."_search.html";
include XOOPS_ROOT_PATH.'/header.php';

// config
$conf = $weblinks_search->get_conf();

// not use extract
$weblinks_search->get_post_get();
$action = $weblinks_search->get_action();
$query  = $weblinks_search->get_query();

$weblinks_header->assign_module_header();

// default
$weblinks_template->assignIndex();
$weblinks_template->assignHeader();
$weblinks_template->assignDisplayLink();

// search form
$show_mark = 1;
$show_cat  = 1;
$show_br1  = 1;
$show_br2  = 1;
$weblinks_template->set_keyword_query( $query ); 
$weblinks_template->assignSearch( $show_mark, $show_cat, $show_br1, $show_br2 ); 

$xoopsTpl->assign('lang_atomfeed', _WLS_ATOMFEED);

if ($action == 'search')
{
	$xoopsTpl->assign('search_show', 0);
	$xoopsTpl->assign('search_not_show_result', '');

	include XOOPS_ROOT_PATH."/footer.php";
	exit();
}

// if no query
// REQ 2933: easy to understand error message
if ( $query == '' ) 
{
	$xoopsTpl->assign('search_show', 0);
	$xoopsTpl->assign('search_not_show_result', _SR_PLZENTER);

	include XOOPS_ROOT_PATH."/footer.php";
	exit();
}

$ret = $weblinks_search->parse_query();

// if no query
// REQ 2933: easy to understand error message
if ( !$ret ) 
{
	$xoopsTpl->assign('search_show', 0);
	$xoopsTpl->assign('search_not_show_result', sprintf( _SR_KEYTOOSHORT, $conf['search_min'] ) );

	include XOOPS_ROOT_PATH."/footer.php";
	exit();
}

$query_array      = $weblinks_search->get_query_array();
$merged_urlencode = $weblinks_search->get_merged_urlencode();

// keyword
$weblinks_template->set_keyword_array( $query_array );
$weblinks_template->assignIndex();
$weblinks_template->assignHeader();
$weblinks_template->assignDisplayLink();

$xoopsTpl->assign('search_show', 1);

$xoopsTpl->assign('search_keywords',             $weblinks_search->get_query_array() );
$xoopsTpl->assign('search_ignores',              $weblinks_search->get_ignore_array() );
$xoopsTpl->assign('search_candidates',           $weblinks_search->get_candidate_array() );
$xoopsTpl->assign('search_show_ignore',          $weblinks_search->get_count_ignore_array() );
$xoopsTpl->assign('search_show_candidate',       $weblinks_search->get_count_candidate_array() );
$xoopsTpl->assign('search_query_utf8_urlencode', $weblinks_search->get_query_utf8_urlencode() );
$xoopsTpl->assign('search_merged_urlencode',     $merged_urlencode );

$weblinks_search->set_highlight( $conf['use_highlight'] );
$weblinks_search->set_keyword_array( $query_array );

$total = $weblinks_search->get_link_total();

if ($total > 0)
{
	list($links, $navi) = $weblinks_search->get_link_list();
	$links_list = $weblinks_template->fetch_links_list( $links );

	$xoopsTpl->assign('search_found_show', 1);
	$xoopsTpl->assign('search_found', sprintf(_SR_FOUND, $total));
/* CDS Patch. Weblinks. 2.00. 7. BOF */
	$xoopsTpl->assign('search_found_count', $total);
/* CDS Patch. Weblinks. 2.00. 7. EOF */
	$xoopsTpl->assign('weblinks_links_list', $links_list);
	$xoopsTpl->assign('page_navi', $navi);
}
else
{
// no match data
	$xoopsTpl->assign('search_found_show', 0);
	$xoopsTpl->assign('search_not_found_result', _SR_NOMATCH);	
}

// --- rss feed ---
$feed_show   = 0;
$feed_found  = '';
/* CDS Patch. Weblinks. 2.00. 7. BOF */
$feed_found_count  = '';
/* CDS Patch. Weblinks. 2.00. 7. EOF */
$feed_reason = '';

if ( WEBLINKS_RSSC_USE )
{
	$count = $weblinks_search->get_feed_count();

	if ($count > 0) 
	{
		$feed_show  = 1;
		$feed_found = sprintf(_SR_FOUND, $count);
/* CDS Patch. Weblinks. 2.00. 7. BOF */
		$feed_found_count = $count;
/* CDS Patch. Weblinks. 2.00. 7. EOF */
		$feeds =& $weblinks_search->get_feeds();

		foreach ($feeds as $feed) 
		{
			$xoopsTpl->append('feeds', $feed);
		}
	}
	else
	{
		$feed_show = 2;
		$feed_reason = _SR_NOMATCH;
	}
}

$xoopsTpl->assign('feed_show',   $feed_show);
$xoopsTpl->assign('feed_found',  $feed_found);
/* CDS Patch. Weblinks. 2.00. 7. BOF */
$xoopsTpl->assign('feed_found_count',  $feed_found_count);
/* CDS Patch. Weblinks. 2.00. 7. EOF */
$xoopsTpl->assign('feed_reason', $feed_reason);

$xoopsTpl->assign('execution_time', happy_linux_get_execution_time() );
$xoopsTpl->assign('memory_usage',   happy_linux_get_memory_usage_mb() );
include XOOPS_ROOT_PATH."/footer.php";
exit();
// --- main end ---

?>