<?php
// $Id: catlist.php,v 1.1 2011/12/29 14:32:31 ohwada Exp $

// 2007-11-01 K.OHWADA
// cat_view_handler
// happy_linux_get_memory_usage_mb()

// 2007-08-01 K.OHWADA
// weblinks_header

// 2007-03-01 K.OHWADA
// execution_time

// 2006-10-01 K.OHWADA
// use happy_linux

// 2006-05-15 K.OHWADA
// new handler

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication

//================================================================
// WebLinks Module
// category list
// 2004/01/14 K.OHWADA
//================================================================

include "header.php";

$weblinks_view_handler =& weblinks_get_handler( 'cat_view', WEBLINKS_DIRNAME );
$weblinks_template =& weblinks_template::getInstance( WEBLINKS_DIRNAME );
$weblinks_header   =& weblinks_header::getInstance(   WEBLINKS_DIRNAME );

//---------------------------------------------------------
// main
//---------------------------------------------------------
// --- template start ---
// xoopsOption[template_main] should be defined before including header.php
$xoopsOption['template_main'] = WEBLINKS_DIRNAME."_catlist.html";
include XOOPS_ROOT_PATH.'/header.php';

$weblinks_template->set_keyword_by_request();
$keyword_array       =& $weblinks_template->get_keyword_array();
$keywords_urlencoded =  $weblinks_template->get_keywords_urlencode();

// Index
$weblinks_header->assign_module_header();
$weblinks_template->assignIndex();
$weblinks_template->assignHeader();
$weblinks_template->assignSearch();

$xoopsTpl->assign('keywords', $keywords_urlencoded);

// --- category list ---
$weblinks_view_handler->init();
$catlist = $weblinks_view_handler->get_all_catlist();

foreach ($catlist as $cat) 
{
	$xoopsTpl->append('categories', $cat);

}

$xoopsTpl->assign('execution_time', happy_linux_get_execution_time() );
$xoopsTpl->assign('memory_usage',   happy_linux_get_memory_usage_mb() );
include XOOPS_ROOT_PATH.'/footer.php';
exit();
// --- main end ---

?>