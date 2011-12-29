<?php
// $Id: viewmark.php,v 1.1 2011/12/29 14:32:29 ohwada Exp $

// 2008-02-17 K.OHWADA
// class weblinks_viewmark
// gmap
// title: lang_site_recommend

// 2007-11-01 K.OHWADA
// happy_linux_get_memory_usage_mb()

// 2007-08-01 K.OHWADA
// weblinks_header

// 2007-07-14 K.OHWADA
// use_highlight

// 2007-03-01 K.OHWADA
// execution_time
// view_style_mark

// 2006-10-14 K.OHWADA
// search with mark

// 2006-10-01 K.OHWADA
// use happy_linux
// use assignHeader

// 2006-07-30 K.OHWADA
// BUG 4168: not show catpath in viewmark

// 2006-05-15 K.OHWADA
// add weblinks_viewmark_main()
// use new handler

// 2006-03-15 K.OHWADA
// use weblinks_pagenavi::getInstance()

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication

//================================================================
// WebLinks Module
// view link by mark ( mutual site, recommend site )
// 2004-10-20 K.OHWADA
//================================================================

include 'header.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/pagenavi.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_pagenavi_menu.php';

//=========================================================
// class weblinks_viewmark
//=========================================================
class weblinks_viewmark
{
	var $_config_handler;
	var $_link_view_handler;
	var $_template;
	var $_class_keyword;
	var $_post;

	var $_conf;

	var $_KML_LIMIT_DEFAULT = WEBLINKS_C_KML_PERPAGE;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_viewmark( $dirname )
{
	$this->_config_handler    =& weblinks_get_handler( 'config2_basic',  $dirname );
	$this->_link_view_handler =& weblinks_get_handler( 'link_view',      $dirname );
	$this->_template          =& weblinks_template::getInstance(         $dirname );

	$this->_class_keyword =& happy_linux_keyword::getInstance();
	$this->_post          =& happy_linux_post::getInstance();

	$this->_conf =& $this->_config_handler->get_conf();
}

function &getInstance( $dirname )
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new weblinks_viewmark( $dirname );
	}
	return $instance;
}

function build( $keyword_array )
{
	$show_links    = false;
	$links         = null;
	$show_kml_list = false;
	$kml_list      = null;
	$kml_list_desc = null;

	$kml_perpage = $this->_post->get_get_int('kml_perpage', $this->_KML_LIMIT_DEFAULT);

	$this->_link_view_handler->init();
	$this->_link_view_handler->set_highlight( $this->_conf['use_highlight'] );
	$this->_link_view_handler->set_keyword_array( $keyword_array );
	$keywords_urlencoded = $this->_class_keyword->urlencode_from_array( $keyword_array );

	list( $mark, $show_mark, $title ) = $this->_get_mark();

	$total = $this->_link_view_handler->get_link_count_by_mark( $mark );
	$thereare = sprintf(_WLS_THEREARE, $total);

	if ( $total > 0 )
	{
		$show_links = true;
		$links = $this->_get_links( $total, $mark, $keywords_urlencoded );

		if ($mark == 'gmap')
		{
			$show_kml_list  = true;
			$kml_list       = $this->_get_kml_list( $total, $kml_perpage );
		}
	}

	$arr = array(
		'lang_title'    => $title,
		'lang_thereare' => $thereare,
		'mark'          => $mark,
		'total'         => $total,
		'links'         => $links,
		'kml_list'      => $kml_list,
		'kml_perpage'   => $kml_perpage,
		'show_mark'     => $show_mark,
		'show_links'    => $show_links,
		'show_kml_list' => $show_kml_list,
	);

	return $arr;
}

function _get_mark()
{
	$show_mark = false;

	$mark = $this->_post->get_get_text('mark');
	switch ( $mark )
	{
		case 'rss':
			$title = $this->_conf['lang_site_rss'];
			break;
	
		case 'gmap':
			$title = $this->_conf['lang_site_gmap'];
			break;

		case 'mutual':
			$title = $this->_conf['lang_site_mutual'];
			$show_mark = true;
			break;

		case 'recommend':
		default:
			$mark = 'recommend';
			$title = $this->_conf['lang_site_recommend'];
			$show_mark = true;
	}

	return array( $mark, $show_mark, $title );
}

function _get_links( $total, $mark, $keywords )
{
	global $xoopsTpl;

	$pagenavi =& weblinks_pagenavi_menu::getInstance();

	$pagenavi->setPerpage(         $this->_conf['perpage'] );
	$pagenavi->set_sortid_default( $this->_conf['orderby'] );
	$pagenavi->setTotal($total);

	$pagenavi->getGetPage();
	$pagenavi->getGetSortid();
	$start = $pagenavi->calcStart();
	$sort  = $pagenavi->get_sort();

// link list
	$link_list =& $this->_link_view_handler->get_link_by_mark_sort($mark, $sort, $this->_conf['perpage'], $start);

	if ( $this->_conf['view_style_mark'] )
	{
		$links_full = $this->_template->fetch_links_full( $link_list );
	}
	else
	{
		$links_full = $this->_template->fetch_links_list( $link_list );
	}

	$script = WEBLINKS_URL.'/viewmark.php?mark='.$mark;
	if ( $keywords )
	{
		$script .= '&amp;keywords='. $keywords;
	}
	$pagenavi->assign_navi($xoopsTpl, $script);

	return $links_full;
}

function _get_kml_list( $total, $perpage )
{
	$max_page = $this->_link_view_handler->get_gmap_kml_page( $total, $perpage );

	$kml_list = array();
	for ( $i=1; $i <= $max_page; $i++ )
	{
		$kml_list[]['page'] = $i;
	}

	return $kml_list;
}

// --- class end ---
}

//=========================================================
// main
//=========================================================

$weblinks_viewmark =& weblinks_viewmark::getInstance( WEBLINKS_DIRNAME );
$weblinks_template =& weblinks_template::getInstance( WEBLINKS_DIRNAME );
$weblinks_header   =& weblinks_header::getInstance(   WEBLINKS_DIRNAME );

// --- template start ---
// xoopsOption[template_main] should be defined before including header.php
$xoopsOption['template_main'] = WEBLINKS_DIRNAME."_viewmark.html";
include XOOPS_ROOT_PATH.'/header.php';

$weblinks_template->set_keyword_by_request();
$keyword_array       =& $weblinks_template->get_keyword_array();
$keywords_urlencoded =  $weblinks_template->get_keywords_urlencode();

$weblinks_header->assign_module_header();
$weblinks_template->assignIndex();
$weblinks_template->assignHeader();
$weblinks_template->assignDisplayLink();

$arr = $weblinks_viewmark->build( $keyword_array );

// search form
$show_cat  = 0;
$show_br1  = 1;
$show_br2  = 1;
$weblinks_template->assignSearch( $arr['show_mark'], $show_cat, $show_br1, $show_br2 ); 

$xoopsTpl->assign('lang_kml_list',      _WEBLINKS_KML_LIST);
$xoopsTpl->assign('lang_kml_list_desc', _WEBLINKS_KML_LIST_DESC);
$xoopsTpl->assign('lang_kml_perpage',   _WEBLINKS_KML_PERPAGE);
$xoopsTpl->assign('lang_execute',       _HAPPY_LINUX_EXECUTE);
$xoopsTpl->assign('keywords',           $keywords_urlencoded);

$xoopsTpl->assign('lang_mark_title',     $arr['lang_title']);
$xoopsTpl->assign('lang_thereare',       $arr['lang_thereare']);
$xoopsTpl->assign('mark',                $arr['mark']);
$xoopsTpl->assign('mark_total',          $arr['total']);
$xoopsTpl->assign('show_links',          $arr['show_links']);
$xoopsTpl->assign('weblinks_links_full', $arr['links']);
$xoopsTpl->assign('show_kml_list',       $arr['show_kml_list']);
$xoopsTpl->assign('kml_list',            $arr['kml_list']);
$xoopsTpl->assign('kml_perpage',         $arr['kml_perpage']);

$xoopsTpl->assign('execution_time', happy_linux_get_execution_time() );
$xoopsTpl->assign('memory_usage',   happy_linux_get_memory_usage_mb() );
include XOOPS_ROOT_PATH.'/footer.php';
exit();
// --- main end ---


?>