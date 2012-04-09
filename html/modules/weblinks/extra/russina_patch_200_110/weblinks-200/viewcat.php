<?php
// $Id: viewcat.php,v 1.1 2012/04/09 10:20:05 ohwada Exp $

// 2009-02-16 K.OHWADA
// Notice [PHP]: Only variables should be assigned by reference

// 2007-11-11 K.OHWADA
// happy_linux_get_memory_usage_mb()
// happy_linux_keyword

// 2007-08-01 K.OHWADA
// weblinks_gmap
// weblinks_map_jp

// 2007-07-14 K.OHWADA
// use_highlight

// 2007-06-10 K.OHWADA
// cat_cols

// 2007-04-08 K.OHWADA
// change fetch_gm_list()

// 2007-04-02 K.OHWADA
// Notice [PHP]: Undefined index: newlinks

// 2007-03-31 K.OHWADA
// Notice [PHP]: Only variables should be assigned by reference

// 2007-03-25 K.OHWADA
// class weblinks_viewcat
// get_cat_gm_value_by_cid()

// 2007-03-18 wye & K.OHWADA
// google map

// 2007-03-01 K.OHWADA
// assign weblinks_category_navi
// assign weblinks_forum_list
// expand subcategories
// execution_time
// BUG: wrong link count

// 2006-10-14 K.OHWADA
// search with category

// 2006-10-01 K.OHWADA
// use happy_linux
// show image in sub cat

// 2006-05-15 K.OHWADA
// add weblinks_viewcat_main()
// use new handler

// 2006-03-15 K.OHWADA
// use weblinks_pagenavi::getInstance()

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication

//================================================================
// WebLinks Module
// view category and link
// 2004/01/23 K.OHWADA
//================================================================

include 'header.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/pagenavi.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_pagenavi_menu.php';

//=========================================================
// class weblinks_viewcat
//=========================================================
class weblinks_viewcat
{
	var $_config_handler;
	var $_link_view_handler;
	var $_template;
	var $_gmap;
	var $_map_jp;
	var $_class_keyword;

	var $_conf;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_viewcat( $dirname )
{
	$this->_config_handler     =& weblinks_get_handler( 'config2_basic',  $dirname );
	$this->_link_view_handler  =& weblinks_get_handler( 'link_view',      $dirname  );
	$this->_template  =& weblinks_template::getInstance( $dirname );
	$this->_gmap      =& weblinks_gmap::getInstance(     $dirname );
	$this->_map_jp    =& weblinks_map_jp::getInstance(   $dirname );

	$this->_class_keyword =& happy_linux_keyword::getInstance();

	$this->_conf =& $this->_config_handler->get_conf();
}

function &getInstance( $dirname )
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new weblinks_viewcat( $dirname );
	}
	return $instance;
}

//---------------------------------------------------------
// function
//---------------------------------------------------------
function &get_category()
{
	$cid = $this->_link_view_handler->get_get_cid();

	$this->_link_view_handler->init();

	$flag_catpath      = true;
	$flag_parent_image = false;
	$flag_parent_desc  = false;

	if ( $this->_conf['cat_img_mode'] == 3 )
	{
		$flag_parent_image = true;
	}

	if ( $this->_conf['cat_desc_mode'] == 2 )
	{
		$flag_parent_desc = true;
	}

	$category =& $this->_link_view_handler->get_category_by_cid( $cid, $flag_catpath, $flag_parent_image, $flag_parent_desc );

	return $category;
}

function &build( &$category, &$keyword_array )
{
	$show_category_navi = false;
	$category_navi      = '';
	$show_links         = false;
	$links_full         = '';
/* CDS Patch. Weblinks. 2.00. 8. BOF */
	$links_full_list    = '';
/* CDS Patch. Weblinks. 2.00. 8. EOF */
	$show_linklist      = false;
	$links_list         = '';
	$show_gm_list       = false;
	$gm_list            = '';
	$show_forum_list    = false;
	$forum_list         = '';
	$show_photo_list    = false;
	$photo_list         = '';
	$show_desc_disp     = false;
	$map_jp             = '';
	$show_map_jp        = false;

	$this->_link_view_handler->set_highlight( $this->_conf['use_highlight'] );
	$this->_link_view_handler->set_keyword_array( $keyword_array );
	$keywords_urlencoded = $this->_class_keyword->urlencode_from_array( $keyword_array );

// --- category list ---
	$cid = $category['cid'];

	$flag_catpath = 0;
	$category_list =& $this->_link_view_handler->get_category_list_by_pid($cid, $flag_catpath, $this->_conf['cat_sub'], $this->_conf['cat_sub_mode'] );

	if ( is_array($category_list) && count($category_list) )
	{
		$show_category_navi = true;
		$category_navi = $this->_template->fetch_category_navi( $category_list, $this->_conf['cat_img_mode'], $this->_conf['cat_cols'], $keywords_urlencoded );
	}

// --- map jp ---
	if ( $this->_conf['map_jp_show_cat'] )
	{
		$show_map_jp = true;
		$map_jp      = $this->_map_jp->fetch_template();
	}

// --- link list ---
	$total = $this->_link_view_handler->get_top_link_count_by_cid($cid);

	if ( $total > 0 )
	{
		$show_links = true;
		$link_list =& $this->get_linklist_self( $total, $cid, $keywords_urlencoded );

		if ( $this->_conf['view_style_cat'] )
		{
			$links_full = $this->_template->fetch_links_full( $link_list );
/* CDS Patch. Weblinks. 2.00. 8. BOF */
			$links_full_list = $this->_template->fetch_links_full_list($link_list);
/* CDS Patch. Weblinks. 2.00. 8. EOF */
		}
		else
		{
			$links_full = $this->_template->fetch_links_list( $link_list );
		}
	}
	else
	{
		$link_list =& $this->_link_view_handler->get_link_all_child_list_latest_by_cid($cid, $this->_conf['perpage']);

		if ( is_array($link_list) && count($link_list) )
		{
			$show_linklist = true;
			$links_list    = $this->_template->fetch_links_list( $link_list );
		}
	}

	if ( $this->_conf['cat_desc_mode'] && $category['desc_disp'])
	{
		$show_desc_disp = true;
	}

// --- google map ---
	if ( $this->_conf['gm_use'] && $this->_conf['cat_show_gm'] && is_array($link_list) && count($link_list) )
	{
		$gm_value =& $this->_link_view_handler->get_cat_gm_value_by_cid( $cid );

		if ( isset($gm_value['show_gm']) && $gm_value['show_gm'] )
		{
			$show_gm_list = true;
			$gm_list = $this->_gmap->fetch_list( $link_list, $gm_value, 'weblinks_gm_map_index' );
		}
	}

// --- forum_list ---
	if ( $this->_conf['cat_show_forum'] )
	{
		$threads =& $this->_link_view_handler->get_cat_forum_threads_by_cid($cid);
		if ( is_array($threads) && count($threads) )
		{
			$show_forum_list = true;
			$forum_list      = $this->_template->fetch_forum_list( $threads );
		}
	}

// --- album_list ---
	if ( $this->_conf['cat_show_album'] )
	{
		$photos =& $this->_link_view_handler->get_cat_album_photos_by_cid($cid);
		if ( is_array($photos) && count($photos) )
		{
			$show_photo_list = true;
			$photo_list      = $this->_template->fetch_photo_list( $photos );
		}
	}

	$arr = array(
		'category'           => $category,
		'title_s'            => $category['title_s'],
		'catpath'            => $category['catpath'],
		'show_category_navi' => $show_category_navi,
		'category_navi'      => $category_navi,
		'show_links'         => $show_links,
		'links_full'         => $links_full,
/* CDS Patch. Weblinks. 2.00. 8. BOF */
		'links_full_list'    => $links_full_list,
/* CDS Patch. Weblinks. 2.00. 8. EOF */
		'show_linklist'      => $show_linklist,
		'links_list'         => $links_list,
		'show_gm_list'       => $show_gm_list,
		'gm_list'            => $gm_list,
		'show_forum_list'    => $show_forum_list,
		'forum_list'         => $forum_list,
		'show_photo_list'    => $show_photo_list,
		'photo_list'         => $photo_list,
		'cat_img_mode'       => $this->_conf['cat_img_mode'],
		'show_desc_disp'     => $show_desc_disp,
		'show_map_jp'        => $show_map_jp,
		'map_jp'             => $map_jp,
	);

	return $arr;
}

// Notice [PHP]: Only variables should be assigned by reference
function &get_linklist_self( $total, $cid, $keywords )
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

	$link_list =& $this->_link_view_handler->get_link_list_by_cid_sort($cid, $sort, $this->_conf['perpage'], $start);

	$script = WEBLINKS_URL.'/viewcat.php?cid='.$cid;
	if ( $keywords )
	{
		$script .= '&amp;keywords='. $keywords;
	}
	$pagenavi->assign_navi($xoopsTpl, $script);

	return $link_list;
}

// --- class end ---
}

//=========================================================
// main
//=========================================================
$weblinks_viewcat   =& weblinks_viewcat::getInstance(  WEBLINKS_DIRNAME );
$weblinks_template  =& weblinks_template::getInstance( WEBLINKS_DIRNAME );
$weblinks_header    =& weblinks_header::getInstance(   WEBLINKS_DIRNAME );

$category =& $weblinks_viewcat->get_category();
if ( !$category )
{
	redirect_header("index.php", 2, _WLS_NOMATCH);
	exit();
}

// --- template start ---
// xoopsOption[template_main] should be defined before including header.php
$xoopsOption['template_main'] = WEBLINKS_DIRNAME."_viewcat.html";
include XOOPS_ROOT_PATH.'/header.php';

$weblinks_template->set_keyword_by_request();

// Notice [PHP]: Only variables should be assigned by reference
$keyword_array       =  $weblinks_template->get_keyword_array();

$keywords_urlencoded =  $weblinks_template->get_keywords_urlencode();

$weblinks_header->assign_module_header( true );
$weblinks_template->assignPageTitle( $category['title_s'], false );
$weblinks_template->assignIndex();
$weblinks_template->assignHeader();
$weblinks_template->assignDisplayLink();

$arr =& $weblinks_viewcat->build( $category, $keyword_array );

// search form
$show_mark = 0;
$show_cat  = 1;
$show_br1  = 1;
$show_br2  = 1;
$subcat    = 1; 
$weblinks_template->assignSearch( $show_mark, $show_cat, $show_br1, $show_br2, $subcat ); 

$xoopsTpl->assign('category',               $category );
$xoopsTpl->assign('catpath',                $arr['catpath'] );
$xoopsTpl->assign('show_category_navi',     $arr['show_category_navi'] );
$xoopsTpl->assign('weblinks_category_navi', $arr['category_navi'] );
$xoopsTpl->assign('show_links',             $arr['show_links'] );
$xoopsTpl->assign('weblinks_links_full',    $arr['links_full'] );
/* CDS Patch. Weblinks. 2.00. 8. BOF */
$xoopsTpl->assign('weblinks_links_full_list',    $arr['links_full_list'] );
/* CDS Patch. Weblinks. 2.00. 8. EOF */
$xoopsTpl->assign('show_linklist',          $arr['show_linklist'] );
$xoopsTpl->assign('weblinks_links_list',    $arr['links_list'] );
$xoopsTpl->assign('show_gm_list',           $arr['show_gm_list'] );
$xoopsTpl->assign('weblinks_gm_list',       $arr['gm_list'] );
$xoopsTpl->assign('show_forum_list',        $arr['show_forum_list'] );
$xoopsTpl->assign('weblinks_forum_list',    $arr['forum_list'] );
$xoopsTpl->assign('show_forum_list',        $arr['show_forum_list'] );
$xoopsTpl->assign('weblinks_photo_list',    $arr['photo_list'] );
$xoopsTpl->assign('show_photo_list',        $arr['show_photo_list'] );
$xoopsTpl->assign('category_image_mode',    $arr['cat_img_mode'] );
$xoopsTpl->assign('show_desc_disp',         $arr['show_desc_disp'] );
$xoopsTpl->assign('show_map_jp',            $arr['show_map_jp'] );
$xoopsTpl->assign('weblinks_map_jp',        $arr['map_jp'] );

$xoopsTpl->assign('keywords',            $keywords_urlencoded );
$xoopsTpl->assign('lang_latest_forum',   _WEBLINKS_LATEST_FORUM);

$xoopsTpl->assign('execution_time', happy_linux_get_execution_time() );
$xoopsTpl->assign('memory_usage',   happy_linux_get_memory_usage_mb() );
include XOOPS_ROOT_PATH.'/footer.php';
exit();
// -- main end ---

?>