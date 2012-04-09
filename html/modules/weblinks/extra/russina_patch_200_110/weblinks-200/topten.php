<?php
// $Id: topten.php,v 1.1 2012/04/09 10:20:05 ohwada Exp $

// 2008-02-17 K.OHWADA
// pagerank
// title: lang_site_popular

// 2007-11-01 K.OHWADA
// happy_linux_get_memory_usage_mb()

// 2007-08-01 K.OHWADA
// weblinks_header

// 2007-07-14 K.OHWADA
// use_highlight

// 2007-03-01 K.OHWADA
// execution_time
// get_topten_list()

// 2006-10-01 K.OHWADA
// small change _get_rankings_each()

// 2006-10-01 K.OHWADA
// use happy_linux

// 2006-05-15 K.OHWADA
// add class weblinks_topten()
// use new handler

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication

//================================================================
// WebLinks Module
// view top ten
// 2004/01/23 K.OHWADA
//================================================================

include "header.php";


//=========================================================
// class weblinks_topten
//=========================================================
class weblinks_topten
{
	var $_DIRNAME; 
 
	var $_link_view_handler;
	var $_template;
	var $_post;

	var $_conf;
	var $_conf_topten_style;
	var $_conf_topten_cats;
	var $_conf_topten_links;

	var $_title;
	var $_sort_name;
	var $_sort_db;
	var $_error = '';
	var $_post_rate = 0;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_topten( $dirname )
{
	$this->_DIRNAME = $dirname; 

	$config_basic_handler     =& weblinks_get_handler( 'config2_basic',  $dirname );
	$this->_link_view_handler =& weblinks_get_handler( 'link_view',      $dirname );

	$this->_template  =& weblinks_template::getInstance( $dirname );
	$this->_post      =& happy_linux_post::getInstance();

	$this->_conf = $config_basic_handler->get_conf();
}

function &getInstance( $dirname )
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new weblinks_topten( $dirname );
	}
	return $instance;
}

//---------------------------------------------------------
// get_template_name
//---------------------------------------------------------
function get_template_name()
{
	if ( $this->_conf['topten_style'] )
	{
		$template = $this->_DIRNAME . '_topten_mixed.html';
	}
	else
	{
		$template = $this->_DIRNAME . '_topten.html';
	}

	return $template;
}

//---------------------------------------------------------
// get GET & POST
//---------------------------------------------------------
function get_get_rate()
{
	$this->_post_rate = $this->_post->get_get_int('rate');

	if( $this->_post_rate == 1 )
	{
		$this->_title     = $this->_conf['lang_site_highrate'];
		$this->_sort_name = _WLS_RATING;
		$this->_sort_db   = 'rating';
	}
	elseif( $this->_post_rate == 2 )
	{
		$this->_title     = $this->_conf['lang_site_pagerank'];
		$this->_sort_name = _WEBLINKS_PAGERANK;
		$this->_sort_db   = 'pagerank';
	}
	else
	{
		$this->_title     = $this->_conf['lang_site_popular'];
		$this->_sort_name = _WLS_HITS;
		$this->_sort_db   = 'hits';
	}

}

function get_topten_title()
{
	$title = sprintf(_WLS_TOPTEN_TITLE, $this->_title, $this->_conf['topten_links'] );
	return $title;
}
/* CDS Patch. Weblinks. 2.00. 7. BOF */
function get_topten_title_simple()
{
	return $this->_title;
}
function get_sort_db()
{
	return $this->_sort_db;
}
/* CDS Patch. Weblinks. 2.00. 7. EOF */

function get_sort_name()
{
	return $this->_sort_name;
}

function get_conf()
{
	return $this->_conf;
}

//---------------------------------------------------------
// get_rankings
//---------------------------------------------------------
function get_rankings()
{
	$links_list   = array();
	$rankings     = array();

	$this->_link_view_handler->init();

	if ( $this->_conf['topten_style'] )
	{
		$links_list =& $this->_get_rankings_mixed();
	}
	else
	{
		$rankings =& $this->_get_rankings_each();
	}

	return array($links_list, $rankings);
}

function &_get_rankings_each()
{
	$arr =& $this->_link_view_handler->get_topten_list(
		$this->_conf['topten_cats'], $this->_get_orderby(), $this->_conf['topten_links'] );

	if ( ! $this->_link_view_handler->returnExistError() )
	{
		$this->_error = $this->_link_view_handler->getErrors(1);
	}

	return $arr;
}

function &_get_rankings_mixed()
{
	$links =& $this->_link_view_handler->get_link_list_orderby(
		$this->_get_orderby(), $this->_conf['topten_links'] );
	return $links;
}

function _get_orderby()
{
	$ret = $this->_sort_db.' DESC, lid DESC';
	return $ret;
}

function get_error()
{
	return $this->_error;
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
	return $this->_link_view_handler->set_keyword_array( $arr );
}

// --- class end ---
}

//=========================================================
// main
//=========================================================

$weblinks_template =& weblinks_template::getInstance( WEBLINKS_DIRNAME );
$weblinks_topten   =& weblinks_topten::getInstance(   WEBLINKS_DIRNAME );
$weblinks_header   =& weblinks_header::getInstance(   WEBLINKS_DIRNAME );

// --- template start ---
// xoopsOption[template_main] should be defined before including header.php
$xoopsOption['template_main'] = $weblinks_topten->get_template_name();
include XOOPS_ROOT_PATH.'/header.php';

$conf = $weblinks_topten->get_conf();

$weblinks_template->set_keyword_by_request();
$keyword_array       =& $weblinks_template->get_keyword_array();
$keywords_urlencoded =  $weblinks_template->get_keywords_urlencode();

$weblinks_topten->set_highlight( $conf['use_highlight'] );
$weblinks_topten->set_keyword_array( $keyword_array );

$weblinks_header->assign_module_header();

//generates top 10 charts by rating and hits for each main category
$weblinks_template->set_keyword_array( $keyword_array );
$weblinks_template->assignIndex();
$weblinks_template->assignHeader();
$weblinks_template->assignDisplayLink();
$weblinks_template->assignSearch(); 

$weblinks_topten->get_get_rate();
$topten_title = $weblinks_topten->get_topten_title();
/* CDS Patch. Weblinks. 2.00. 7. BOF */
$topten_title_simple = $weblinks_topten->get_topten_title_simple();
$sort_db = $weblinks_topten->get_sort_db();
/* CDS Patch. Weblinks. 2.00. 7. EOF */
$sort_name    = $weblinks_topten->get_sort_name();
list($links, $rankings) = $weblinks_topten->get_rankings();
$topten_error = $weblinks_topten->get_error();

$template_links_list = $weblinks_template->fetch_links_list( $links );

$i = 0;
$template_rankings = array();
foreach ($rankings as $rank)
{
	$template_rankings[$i]['cid']   = $rank['cid'];
	$template_rankings[$i]['title'] = $rank['title'];
/* CDS Patch. Weblinks. 2.00. 7. BOF */
	$template_rankings[$i]['title_simple'] = $rank['title_simple'];
/* CDS Patch. Weblinks. 2.00. 7. BOF */
	$template_rankings[$i]['links_list'] = $weblinks_template->fetch_links_list( $rank['links'] );
	$i ++;
}

$xoopsTpl->assign('keywords',            $keywords_urlencoded);
$xoopsTpl->assign('lang_topten_title',   $topten_title);
/* CDS Patch. Weblinks. 2.00. 7. BOF */
$xoopsTpl->assign('lang_topten_title_simple',   $topten_title_simple);
$xoopsTpl->assign('sort_db',   $sort_db);
/* CDS Patch. Weblinks. 2.00. 7. EOF */
$xoopsTpl->assign('lang_sortby',         $sort_name);
$xoopsTpl->assign('lang_topten_error',   $topten_error);
$xoopsTpl->assign('weblinks_links_list', $template_links_list);
$xoopsTpl->assign('rankings',            $template_rankings);

$xoopsTpl->assign('execution_time', happy_linux_get_execution_time() );
$xoopsTpl->assign('memory_usage',   happy_linux_get_memory_usage_mb() );
include XOOPS_ROOT_PATH.'/footer.php';
exit();
// --- main end ---


?>