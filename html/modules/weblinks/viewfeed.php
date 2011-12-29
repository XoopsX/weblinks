<?php
// $Id: viewfeed.php,v 1.1 2011/12/29 14:32:29 ohwada Exp $

// 2007-11-01 K.OHWADA
// happy_linux_get_memory_usage_mb()

// 2007-08-01 K.OHWADA
// weblinks_header

// 2007-06-01 K.OHWADA
// rssc_view_handler

// 2007-03-01 K.OHWADA
// execution_time

// 2006-10-01 K.OHWADA
// use happy_linux
// use rssc WEBLINKS_RSSC_EXIST

// 2006-05-15 K.OHWADA
// add weblinks_viewfeed_main()
// use new handler

// 2006-03-15 K.OHWADA
// use weblinks_pagenavi_basic::getInstance()

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication

//================================================================
// WebLinks Module
// view atom feed
// 2004-11-28 K.OHWADA
//================================================================

include 'header.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/pagenavi.php';

$weblinks_template =& weblinks_template::getInstance( WEBLINKS_DIRNAME );
$weblinks_header   =& weblinks_header::getInstance(   WEBLINKS_DIRNAME );
$weblinks_viewfeed =& weblinks_viewfeed::getInstance();

if ( ! WEBLINKS_RSSC_EXIST )
{
	$msg = sprintf( _WEBLINKS_RSSC_NOT_INSTALLED, WEBLINKS_RSSC_DIRNAME );
	redirect_header('index.php', 5, $msg);
}

// --- template start ---
// xoopsOption[template_main] should be defined before including header.php
$xoopsOption['template_main'] = WEBLINKS_DIRNAME."_viewfeed.html";
include XOOPS_ROOT_PATH.'/header.php';

// rss/atom auto discovery
$xoopsTpl->assign('xoops_rss',  'modules/'.WEBLINKS_DIRNAME.'/rss.php' );
$xoopsTpl->assign('xoops_atom', 'modules/'.WEBLINKS_DIRNAME.'/atom.php' );
$xoopsTpl->assign('lang_atomfeed_distribute', _WLS_ATOMFEED_DISTRIBUTE);

$weblinks_template->set_keyword_by_request();
$keyword_array       =& $weblinks_template->get_keyword_array();
$keywords_urlencoded =  $weblinks_template->get_keywords_urlencode();

$weblinks_header->assign_module_header();
$weblinks_template->assignIndex();
$weblinks_template->assignDisplayLink();
$weblinks_template->assignHeader();
$weblinks_template->assignSearch(); 

$xoopsTpl->assign('keywords', $keywords_urlencoded);

$total = $weblinks_viewfeed->get_total();
$xoopsTpl->assign('total_atomfeed', $total);

if ($total > 0)
{
	$xoopsTpl->assign('show_feeds', true);

	$feed_list =& $weblinks_viewfeed->get_feed_list( $keyword_array );
	foreach ($feed_list as $feed) 
	{
		$xoopsTpl->append('feeds', $feed);
	}

	if ($total > 1)
	{
		$navi = $weblinks_viewfeed->get_navi( $keywords_urlencoded );
		$xoopsTpl->assign('page_navi', $navi);
	}
}

$xoopsTpl->assign('execution_time', happy_linux_get_execution_time() );
$xoopsTpl->assign('memory_usage',   happy_linux_get_memory_usage_mb() );
include XOOPS_ROOT_PATH.'/footer.php';
exit();
// --- main end ---


//=========================================================
// class weblinks_viewfeed
//=========================================================
class weblinks_viewfeed
{
	var $_rssc_handler;
	var $_pagenavi;

	var $_conf;
	var $_total = 0;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_viewfeed()
{
	$config_handler  =& weblinks_get_handler( 'config2_basic', WEBLINKS_DIRNAME );
	$this->_conf = $config_handler->get_conf();

	$this->_pagenavi =& happy_linux_pagenavi::getInstance();

	$this->_rssc_handler =& weblinks_get_handler( 'rssc_view', WEBLINKS_DIRNAME );
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new weblinks_viewfeed();
	}
	return $instance;
}

//---------------------------------------------------------
// count
//---------------------------------------------------------
function get_total()
{
	$this->_total = $this->_rssc_handler->get_feed_count();
	return $this->_total;
}

//---------------------------------------------------------
// feed_list
//---------------------------------------------------------
function &get_feed_list( &$keyword_array )
{
	$feed_list = array();

	$conf_rss_perpage = $this->_conf['rss_perpage'];

	$this->_pagenavi->setPerpage( $conf_rss_perpage );
	$this->_pagenavi->setTotal( $this->_total );

	$this->_pagenavi->getGetPage();
	$start = $this->_pagenavi->calcStart();

	$this->_rssc_handler->set_feed_flag_title_html(   $this->_conf['rss_mode_title'] );
	$this->_rssc_handler->set_feed_flag_content_html( $this->_conf['rss_mode_content'] );
	$this->_rssc_handler->set_feed_max_content(       $this->_conf['rss_max_content'] );
	$this->_rssc_handler->set_feed_max_summary(       $this->_conf['rss_max_summary'] );
	$this->_rssc_handler->set_feed_highlight(         $this->_conf['use_highlight'] );
	$this->_rssc_handler->set_feed_keyword_array(     $keyword_array );

	$feed_list =& $this->_rssc_handler->get_feed_list_latest($conf_rss_perpage, $start);

	return $feed_list;
}

function get_navi( $keywords )
{
	$script = WEBLINKS_URL.'/viewfeed.php';
	if ( $keywords )
	{
		$script .= '?keywords='. $keywords;
	}
	$navi = $this->_pagenavi->build( $script );
	return $navi;
}

// --- class end ---
}

?>