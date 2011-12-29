<?php
// $Id: weblinks_template.php,v 1.1 2011/12/29 14:33:07 ohwada Exp $

// 2009-03-07 K.OHWADA
// Smarty error: unable to read resource: d3forum_comment.html

// 2009-01-25 K.OHWADA
// album_cols in fetch_photo_list()

// 2008-12-20 K.OHWADA
// _get_custom_file()

// 2008-03-12 K.OHWADA
// _create_xoops_tpl()

// 2008-02-17 K.OHWADA
// _assign_config_name()

// 2007-11-11 K.OHWADA
// happy_linux_keyword
// weblinks_auth
// weblinks_link_count_handler
// remove linkitem_handler->init()
// lang_goto_admin

// 2007-08-01 K.OHWADA
// meet W3C
// move fetch_gm_list() to weblinks_gmap

// 2007-06-10 K.OHWADA
// rssc_view_handler
// fetch_d3forum_comment()

// 2007-04-08 K.OHWADA
// change fetch_gm_list()

// 2007-03-25 K.OHWADA
// fetch_photo_list()
// change assignHeader()

// 2007-03-18 K.OHWADA
// fetch_gm_list() fetch_gm_single()

// 2007-03-01 K.OHWADA
// linkitem_basic_handler
// link_basic_handler
// fetch_category_navi()
// fetch_forum_list()

// 2006-12-10 K.OHWADA
// add _assign_linkitem_name()

// 2006-10-14 K.OHWADA
// add assignSearch()

// 2006-10-05 K.OHWADA
// use happy_linux
// use rssc WEBLINKS_RSSC_USE
// google map
// add fetch_link_map()
// use weblinks_locate_factory

// 2006-07-30 K.OHWADA
// BUG 4169: not show total in index

// 2006-05-15 K.OHWADA
// use new handler

// 2006-03-26 K.OHWADA
// REQ 3807: Description in main page

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication
// move from include/functions

//================================================================
// WebLinks Module
// 2004/01/23 K.OHWADA
//================================================================

//---------------------------------------------------------
// TODO
// global $xoopsTpl
// class language_convert get_country()
//---------------------------------------------------------

// === class begin ===
if( !class_exists('weblinks_template') ) 
{

//=========================================================
// class weblinks_template
//=========================================================
class weblinks_template
{
// handler
	var $_config_handler;
	var $_linkitem_handler;
	var $_category_handler;
	var $_link_count_handler;
	var $_rssc_handler;
	var $_menu;
	var $_auth;
	var $_system;
	var $_post;
	var $_strings;
	var $_class_keyword;

// dirname
	var $_DIRNAME;
	var $_dir_templates ;

// system variable
	var $_module_name;
	var $_xoops_language;
	var $_is_module_admin;
	var $_is_japanese;
	var $_happy_linux_url;

// local variable
	var $_time_start = 0;
	var $_time_prev  = 0;

// config
	var $_conf;

	var $_total_site_recommend;
	var $_total_site_mutual;
	var $_total_site_gmap;
	var $_total_site_rss;
	var $_total_feed;

// keyword
	var $_keyword_array      = array();
	var $_keywords_urlencode = null;
	var $_keyword_query      = null;

// meet W3C
	var $_SELECTED = 'selected="selected"';
	var $_CHECKED  = 'checked="checked"';

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_template( $dirname )
{
	$this->_DIRNAME = $dirname ;

// handler
	$this->_config_handler     =& weblinks_get_handler( 'config2_basic',  $dirname );
	$this->_linkitem_handler   =& weblinks_get_handler( 'linkitem_basic', $dirname );
	$this->_category_handler   =& weblinks_get_handler( 'category_basic', $dirname );
	$this->_link_count_handler =& weblinks_get_handler( 'link_count',     $dirname );
	$this->_rssc_handler       =& weblinks_get_handler( 'rssc_view',      $dirname );

	$this->_menu     =& weblinks_menu::getInstance( $dirname );
	$this->_auth     =& weblinks_auth::getInstance( $dirname );
	$this->_system   =& happy_linux_system::getInstance();
	$this->_post     =& happy_linux_post::getInstance();
	$this->_strings  =& happy_linux_strings::getInstance();
	$this->_class_keyword =& happy_linux_keyword::getInstance();

	$this->_conf = $this->_config_handler->get_conf();
	$conf_map_template = $this->_conf['map_template'];

// system
	$this->_module_name     = $this->_system->get_module_name();
	$this->_xoops_language  = $this->_system->get_language();
	$this->_is_module_admin = $this->_system->is_module_admin();
	$this->_is_japanese     = $this->_system->is_japanese();

// template
	$this->_dir_templates = XOOPS_ROOT_PATH . '/modules/' . $dirname . '/templates';

}

function &getInstance( $dirname )
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new weblinks_template( $dirname );
	}

	return $instance;
}

//-------------------------------------------------------------------
// assign template
//-------------------------------------------------------------------
function assignPageTitle( $title, $format=true )
{
	global $xoopsTpl;

	$module_name = htmlspecialchars($this->_module_name, ENT_QUOTES);

	if ($format)
	{
		$title = htmlspecialchars($title, ENT_QUOTES);
	}

	$pagetitle = $module_name.' - '.$title;
	$xoopsTpl->assign('xoops_pagetitle', $pagetitle);
}

function assignIndex()
{
	global $xoopsTpl;
	$this->_assign_header_common( $xoopsTpl );
}

function assignHeader( $description=null )
{
	global $xoopsTpl;
	$this->load_total();

	$header   = $this->fetch_header( $description );
	$guidance = $this->fetch_guidance();

	$xoopsTpl->assign('weblinks_header',      $header);
	$xoopsTpl->assign('weblinks_guidance',    $guidance);

// BUG: not show total in index
	$this->_assign_header_total( $xoopsTpl );
}

function assignSearch( $show_mark=0, $show_cat=0, $show_br1=0, $show_br2=0, $subcat=0  )
{
	global $xoopsTpl;

	$this->_assign_search_common( $xoopsTpl );

	$text = $this->fetch_search_form( $show_mark, $show_cat, $show_br1, $show_br2, $subcat );
	$xoopsTpl->assign('weblinks_search_form', $text);

}

function assignDisplayLink()
{
	global $xoopsTpl;
	$this->_assign_link_common( $xoopsTpl );
}

function fetch_header( $description=null )
{
	$tpl =& $this->_create_xoops_tpl();

	$this->_assign_header_common( $tpl );
	$this->_assign_header_total(  $tpl );

	$tpl->assign( 'keywords',   $this->_keywords_urlencode );
	$tpl->assign( 'index_desc', $description );

	$text = $tpl->fetch( $this->_get_parts_file( 'weblinks_header.html' ) );
	return $text;
}

function fetch_guidance()
{
	$tpl =& $this->_create_xoops_tpl();

	$this->_assign_header_common( $tpl );
	$this->_assign_header_total(  $tpl );

	$tpl->assign( 'keywords', $this->_keywords_urlencode );

	$text = $tpl->fetch( $this->_get_parts_file( 'weblinks_guidance.html' ) );
	return $text;
}

function fetch_search_form( $show_mark=0, $show_cat=0, $show_br1=0, $show_br2=0, $subcat=0 )
{
	$tpl =& $this->_create_xoops_tpl();

	$selbox = '';
	$cid    = $this->_post->get_get_int('cid');
	$mark   = $this->_post->get_get_text('mark');

	if ( $subcat == 0 )
	{
		$subcat = $this->_post->get_get_int('subcat');
	}

	$andor = $this->_post->get_get_text('andor');
	if ( ( $andor != 'OR' ) && ( $andor != 'exact' ) )
	{
		$andor = 'AND';
	}

	if ( $show_cat )
	{
		$selbox = $this->_build_cat_selbox( $cid );
	}

	$this->_assign_header_common( $tpl );
	$this->_assign_search_common( $tpl );

	$tpl->assign('show_mark', $show_mark );
	$tpl->assign('show_cat',  $show_cat );
	$tpl->assign('show_br1',  $show_br1 );
	$tpl->assign('show_br2',  $show_br2 );

	$tpl->assign('search_query',      htmlspecialchars($this->_keyword_query, ENT_QUOTES) );
	$tpl->assign('search_selected',   $this->_get_search_selected( $andor, $mark ) );
	$tpl->assign('search_checked',    $this->_get_search_checked( $subcat ) );
	$tpl->assign('search_cat_selbox', $selbox);

	$text = $tpl->fetch( $this->_get_parts_file( 'weblinks_search_form.html' ) );
	return $text;
}

function fetch_link_single( &$link )
{
	$tpl =& $this->_create_xoops_tpl();

	$link['map'] = $this->fetch_link_map( $link );

	$this->_assign_link_common( $tpl );

	$tpl->assign('link',     $link);
	$tpl->assign('keywords', $this->_keywords_urlencode );

	$text = $tpl->fetch( $this->_get_parts_file( 'weblinks_link_single.html' ) );
	return $text;
}

function fetch_link_map( &$link )
{
	$conf_map_template = $this->_conf['map_template'];

	$text = '';
	if ( $conf_map_template )
	{
		$tpl =& $this->_create_xoops_tpl();

		$this->_assign_link_common( $tpl );
		$tpl->assign('link', $link);
		$text = $tpl->fetch( 
			$this->_get_custom_file( 'map', $conf_map_template ) );
	}
	return $text;
}

function fetch_links_full( &$links )
{
	$text = '';
	foreach ($links as $link) 
	{
		$text .= $this->fetch_link_single( $link );
	}
	return $text;
}

function fetch_links_list( &$links )
{
	$tpl =& $this->_create_xoops_tpl();

	$this->_assign_link_common( $tpl );
	$tpl->assign('keywords', $this->_keywords_urlencode );

	if ( is_array($links) )
	{
		foreach ($links as $link) 
		{
			$tpl->append('links', $link);
		}
	}

	$text = $tpl->fetch( $this->_get_parts_file( 'weblinks_links_list.html' ) );
	return $text;
}

function fetch_category_navi( &$categories, $image_mode, $cols, $keywords )
{
// min is 1
	$cols  = intval($cols);
	if ($cols < 1)
	{
		$cols = 1;
	}

// min is 1
	$width = intval(100/$cols) - 1;
	if ($width < 1)
	{
		$width = 1;
	}

	$count = count($categories);
	$cols_remainder =& $this->build_remainder_array( $this->calc_remainder( $count, $cols ) );

	$tpl =& $this->_create_xoops_tpl();

	$tpl->assign( 'xoops_url', XOOPS_URL );
	$tpl->assign( 'dirname',   $this->_DIRNAME );
	$tpl->assign( 'keywords',  $keywords);
	$tpl->assign( 'category_cols',       $cols );
	$tpl->assign( 'category_width',      $width );
	$tpl->assign( 'category_image_mode', $image_mode );
	$tpl->assign( 'main_categories',     $categories );
	$tpl->assign( 'cols_remainder',      $cols_remainder );

	$text = $tpl->fetch( $this->_get_parts_file( 'weblinks_category_navi.html' ) );
	return $text;
}

function fetch_forum_list( &$threads )
{
	$tpl =& $this->_create_xoops_tpl();

	$tpl->assign('lang_forum',  _WEBLINKS_FORUM);
	$tpl->assign('lang_thread', _WEBLINKS_THREAD);
	$tpl->assign('forum_threads', $threads);

	$text = $tpl->fetch( $this->_get_parts_file( 'weblinks_forum_list.html' ) );
	return $text;
}

function fetch_photo_list( &$photos )
{
	$tpl =& $this->_create_xoops_tpl();

	$tpl->assign('album_photos', $photos);
	$tpl->assign('album_cols',   3);

	$text = $tpl->fetch( $this->_get_parts_file( 'weblinks_photo_list.html' ) );
	return $text;
}

function fetch_d3forum_comment( $id, $subject )
{
	$text = '';
	if ( $this->_conf['d3forum_plugin'] )
	{
		$tpl =& $this->_create_xoops_tpl();

		$tpl->assign('d3forum_dirname',  $this->_conf['d3forum_dirname'] );
		$tpl->assign('d3forum_forum_id', $this->_conf['d3forum_forum_id'] );
		$tpl->assign('d3forum_view',     $this->_conf['d3forum_view'] );
		$tpl->assign('d3forum_id',       $id );
		$tpl->assign('d3forum_subject',  $subject );

// Smarty error: unable to read resource: d3forum_comment.html
		$text = $tpl->fetch( $this->_get_parts_file( 'weblinks_d3forum_comment.html' ) );
	}
	return $text;
}

function calc_remainder( $num, $max )
{
// exsample $max=3
// 0 -> 0
// 1 -> 2
// 2 -> 1
// 3 -> 0
// 4 -> 2
// 5 -> 1
// 6 -> 0

	$remainder = $max - ($num % $max);
	if ( $remainder >= $max )
	{
		$remainder = 0;
	}
	return $remainder;
}

function &build_remainder_array( $num )
{
	$arr = array();
	if ( $num > 0 )
	{
		for ($i=0; $i<$num; $i++)
		{
			$arr[] = '';
		}
	}
	return $arr;
}

//=========================================================
// private
//=========================================================
function &_create_xoops_tpl()
{
	global $xoopsUser, $xoopsUserIsAdmin, $xoopsModule;

	$tpl = new XoopsTpl();

// header.php
	$tpl->assign('xoops_requesturi', htmlspecialchars($GLOBALS['xoopsRequestUri'], ENT_QUOTES) );

	if ( is_object($xoopsUser) ) 
	{
		$tpl->assign( array(
			'xoops_isuser'  => true,
			'xoops_userid'  => $xoopsUser->getVar('uid'),
			'xoops_uname'   => $xoopsUser->getVar('uname'),
			'xoops_isadmin' => $xoopsUserIsAdmin,
		));
	}

	if ( is_object($xoopsModule) )
	{
		$tpl->assign( array(
			'xoops_modulename' => $xoopsModule->getVar('name'),
			'xoops_dirname'    => $xoopsModule->getVar('dirname'),
		));
	}

	return $tpl;
}

function _assign_header_common( &$tpl )
{
	$this->_assign_config_name( $tpl );

	$show_site_rss  = false;
	$show_atomfeed  = false;

	if ( WEBLINKS_RSSC_USE )
	{
		$show_site_rss = true;
		$show_atomfeed = true;
	}

// system parameter
	$tpl->assign('xoops_url',       XOOPS_URL );
	$tpl->assign('xoops_language',  $this->_xoops_language );
	$tpl->assign('is_module_admin', $this->_is_module_admin );
	$tpl->assign('is_japanese',     $this->_is_japanese );
	$tpl->assign('module_name',     $this->_module_name );
	$tpl->assign('dirname',         $this->_DIRNAME );

// menu show
	$tpl->assign('show_submit',        $this->_menu->show_submit() );
	$tpl->assign('show_site_popular',  $this->_menu->show_hits() );
	$tpl->assign('show_site_higtrate', $this->_menu->show_rating() );
	$tpl->assign('show_site_pagerank', $this->_conf['use_pagerank'] );

// config
	$tpl->assign('logoshow',            $this->_conf['logoshow'] );
	$tpl->assign('titleshow',           $this->_conf['titleshow'] );
	$tpl->assign('show_site_recommend', $this->_conf['recommend_pri'] );
	$tpl->assign('show_site_mutual',    $this->_conf['mutual_pri'] );
	$tpl->assign('show_site_gmap',      $this->_conf['gm_use'] );
	$tpl->assign('show_site_rss',       $show_site_rss );
	$tpl->assign('show_atomfeed',       $show_atomfeed );

// REQ 3110: Add in this category
	if ( isset($_GET['cid']) )
	{
		$tpl->assign('cid', intval($_GET['cid']) );
	}

// --- lang ---
	$tpl->assign('lang_home',       _HAPPY_LINUX_HOME);
	$tpl->assign('lang_goto_admin', _HAPPY_LINUX_GOTO_ADMIN);
	$tpl->assign('lang_nomatch',    _WLS_NOMATCH);

// index.php
	$tpl->assign('lang_new_sitelist',   _WLS_NEW_SITELIST);
	$tpl->assign('lang_new_atomfeed',   _WLS_NEW_ATOMFEED);

// java script
	$tpl->assign('lang_js_invalid',     _WEBLINKS_JAVASCRIPT_INVALID );


}

function _assign_header_total( &$tpl )
{
	$total_site_topten    = "top".intval( $this->_conf['topten_links'] );

	$tpl->assign('total_site_recommend', $this->_total_site_recommend);
	$tpl->assign('total_site_mutual',    $this->_total_site_mutual);
	$tpl->assign('total_site_gmap',      $this->_total_site_gmap);
	$tpl->assign('total_site_rss',       $this->_total_site_rss);
	$tpl->assign('total_atomfeed',       $this->_total_feed);

// BUG 3111: timeout occurs in popular site if many top categories
	$tpl->assign('total_site_topten', $total_site_topten);
}

function _assign_search_common( &$tpl )
{
	$tpl->assign('search_google_server', $this->_conf['google_server'] );

// --- lang ---
	$tpl->assign('lang_search_search',  _SR_SEARCH);
	$tpl->assign('lang_search_all',     _SR_ALL);
	$tpl->assign('lang_search_any',     _SR_ANY);
	$tpl->assign('lang_search_exact',   _SR_EXACT);
	$tpl->assign('lang_search_result',  _SR_SEARCHRESULTS);
	$tpl->assign('lang_search_showall', _SR_SHOWALLR);
	$tpl->assign('lang_search_prev',    _SR_PREVIOUS);
	$tpl->assign('lang_search_next',    _SR_NEXT);
	$tpl->assign('lang_search_keyword', _SR_KEYWORDS.':');
	$tpl->assign('lang_search_ignore',  sprintf(_SR_IGNOREDWORDS, $this->_conf['search_min']) );

	$tpl->assign('lang_search_google',      _HAPPY_LINUX_SEARCH_GOOGLE );
	$tpl->assign('lang_search_with_subcat', _HAPPY_LINUX_SEARCH_WITH_SUBCAT );
	$tpl->assign('lang_search_not_select',  _HAPPY_LINUX_SEARCH_NOT_SELECT);
	$tpl->assign('lang_search_candidate',   _HAPPY_LINUX_SEARCH_CANDICATE );
}

function _get_search_selected( $andor, $mark )
{
	$selected = array();

	if ($andor == 'exact') 
	{
		$selected['exact'] = $this->_SELECTED;
	}
	elseif ($andor == 'OR')
	{
		$selected['or'] = $this->_SELECTED;
	}
	else
	{
		$selected['and'] = $this->_SELECTED;
	}

	if ($mark == 'recommend') 
	{
		$selected['recommend'] = $this->_SELECTED;
	}
	elseif ($mark == 'mutual')
	{
		$selected['mutual'] = $this->_SELECTED;
	}

	return $selected;
}

function _get_search_checked( $subcat )
{
	$checked = array();

	if ($subcat == 1) 
	{
		$checked['subcat'] = $this->_CHECKED;
	}

	return $checked;
}

function _assign_link_common( &$tpl )
{
	$this->_assign_config_name( $tpl );
	$this->_assign_linkitem_name( $tpl );

	$show_atomfeed = 0;
	if ( WEBLINKS_RSSC_USE )
	{
		$show_atomfeed = 1;
	}

// system parameter
	$tpl->assign('xoops_url',       XOOPS_URL );
	$tpl->assign('xoops_language',  $this->_xoops_language );
	$tpl->assign('is_japanese',     $this->_is_japanese );
	$tpl->assign('is_module_admin', $this->_system->is_module_admin() );
	$tpl->assign('module_name',     $this->_module_name );
	$tpl->assign('country_code',    $this->_conf['country_code'] );
	$tpl->assign('flag_map_use',    $this->_conf['map_use'] );
	$tpl->assign('dirname',         $this->_DIRNAME );

// show ratelink
	$show_ratelink = false;
	$show_rating   = false;
	if ( $this->_menu->show_rating() )
	{
		$show_rating = true;

		$has_auth_ratelink = $this->_auth->has_auth_ratelink();
		if ( $has_auth_ratelink )
		{
			$show_ratelink = true;
		}
	}

// menu show
	$tpl->assign('show_hits',       $this->_menu->show_hits() );
	$tpl->assign('show_rating',     $show_rating );
	$tpl->assign('show_ratelink',   $show_ratelink );
	$tpl->assign('show_atomfeed',   $show_atomfeed );
	$tpl->assign('show_brokenlink', $this->_conf['use_brokenlink'] );

// index
	$tpl->assign('lang_more',            _WLS_MORE);
	$tpl->assign('lang_site_new',        _WLS_SITE_NEW);
	$tpl->assign('lang_site_update',     _WLS_SITE_UPDATE);

// singlelink
	$tpl->assign('lang_visit' ,          _WLS_VISIT);
	$tpl->assign('lang_promoter',        _WLS_PROMOTER);
	$tpl->assign('lang_modify',          _WLS_MODIFY);
	$tpl->assign('lang_editthislink' ,   _WLS_EDITTHISLINK);
	$tpl->assign('lang_ratethissite',    _WLS_RATETHISSITE);
	$tpl->assign('lang_reportbroken',    _WLS_REPORTBROKEN);
	$tpl->assign('lang_tellafriend',     _WLS_TELLAFRIEND);

	$tpl->assign('lang_comments',      _COMMENTS );
	$tpl->assign('lang_print',         _HAPPY_LINUX_PRINT);
	$tpl->assign('lang_pssword',       _US_PASSWORD );

	$tpl->assign('lang_site_title',     _WLS_SITETITLE );
	$tpl->assign('lang_site_url',       _WLS_SITEURL );
	$tpl->assign('lang_lastupdate',     _WLS_LASTUPDATE );
	$tpl->assign('lang_category',       _WLS_CATEGORY );
	$tpl->assign('lang_linkid',         _WLS_LINKID );
	$tpl->assign('lang_banner_url',     _WLS_BANNERURL );
	$tpl->assign('lang_rss_url',        _WLS_RSS_URL );
	$tpl->assign('lang_name',           _WLS_NAME );
	$tpl->assign('lang_email',          _WLS_EMAIL );
	$tpl->assign('lang_company',        _WLS_COMPANY );
	$tpl->assign('lang_zip',            _WLS_ZIP );
	$tpl->assign('lang_state',          _WLS_STATE );
	$tpl->assign('lang_city',           _WLS_CITY );
	$tpl->assign('lang_addr',           _WLS_ADDR );
	$tpl->assign('lang_addr2',          _WLS_ADDR2 );
	$tpl->assign('lang_tel',            _WLS_TEL );
	$tpl->assign('lang_fax',            _WLS_FAX );
	$tpl->assign('lang_hits',           _WLS_HITS );
	$tpl->assign('lang_rating',         _WLS_RATING );
	$tpl->assign('lang_votes',          _WLS_VOTE );
	$tpl->assign('lang_options',        _WLS_OPTIONS );
	$tpl->assign('lang_description',    _WLS_DESCRIPTION );
	$tpl->assign('lang_user_comment',   _WLS_USER_COMMENT );
	$tpl->assign('lang_admin_commnet',  _WLS_ADMINCOMMENT );
	$tpl->assign('lang_broken_counter', _WLS_BROKEN_COUNTER );

	$tpl->assign('lang_mid',           _WEBLINKS_MID );
	$tpl->assign('lang_userid',        _WEBLINKS_USERID );
	$tpl->assign('lang_rssc_lid',      _WEBLINKS_RSSC_LID );
	$tpl->assign('lang_create',        _WEBLINKS_CREATE );
	$tpl->assign('lang_time_publish',  _WEBLINKS_TIME_PUBLISH );
	$tpl->assign('lang_time_expire',   _WEBLINKS_TIME_EXPIRE );
	$tpl->assign('lang_map_use',       _WEBLINKS_MAP_USE );
	$tpl->assign('lang_etc',           _WEBLINKS_ETC );
	$tpl->assign('lang_textarea',      _WEBLINKS_TEXTAREA );
	$tpl->assign('lang_gm_latitude',   _WEBLINKS_GM_LATITUDE );
	$tpl->assign('lang_gm_longitude',  _WEBLINKS_GM_LONGITUDE );
	$tpl->assign('lang_gm_zoom',       _WEBLINKS_GM_ZOOM );

// banner
	$tpl->assign('link_image_use', $this->_conf['link_image_use'] );
	$tpl->assign('list_image_use', $this->_conf['list_image_use'] );

}

//---------------------------------------------------------
// config_handler
//---------------------------------------------------------
function _assign_config_name( &$tpl )
{
	foreach ( $this->_conf as $k => $v )
	{
// match
		if ( strpos( $k, 'lang_' ) === 0 )
		{
			$name  = htmlspecialchars( $k, ENT_QUOTES);
			$value = htmlspecialchars( $v, ENT_QUOTES);
			$tpl->assign($name, $value);
		}
	}
}

//---------------------------------------------------------
// linkitem_handler
//---------------------------------------------------------
function _assign_linkitem_name( &$tpl )
{
	$conf =& $this->_linkitem_handler->get_conf();
	foreach ($conf as $k => $v)
	{
		$name  = htmlspecialchars('lang_link_'.$k, ENT_QUOTES);
		$value = htmlspecialchars($v,              ENT_QUOTES);
		$tpl->assign($name, $value);
	}
}

//---------------------------------------------------------
// category_handler
//---------------------------------------------------------
function _build_cat_selbox( $cid )
{
	$this->_category_handler->load_once();
	$selbox = $this->_category_handler->build_selbox( $cid, 1, "cid", '', _HAPPY_LINUX_SEARCH_NOT_SELECT, 0 );
	return $selbox;
}

//-------------------------------------------------------------------
// link_handler rssc_handler
//-------------------------------------------------------------------
function load_total()
{
	$this->_total_site_recommend = $this->_link_count_handler->get_link_count_by_mark('recommend');
	$this->_total_site_mutual    = $this->_link_count_handler->get_link_count_by_mark('mutual');
	$this->_total_site_gmap      = $this->_link_count_handler->get_link_count_by_mark('gmap');
	$this->_total_site_rss       = $this->_link_count_handler->get_link_count_by_mark('rss');
	$this->_total_feed           = $this->_rssc_handler->get_feed_count();
}

//---------------------------------------------------------
// set keyword property
//---------------------------------------------------------
function set_keyword_by_request()
{
	$this->set_keyword_array( $this->_class_keyword->get_keyword_array_by_request() );
}

function set_keyword_array( &$arr )
{
	if ( is_array($arr) && count($arr) )
	{
		$this->_keyword_array =& $arr;
		$this->set_keywords_urlencode( $this->_class_keyword->urlencode_from_array( $arr ) );
		$this->set_keyword_query(      $this->_class_keyword->convert_array_to_str( $arr ) );
	}
}

function set_keywords_urlencode( $val )
{
	$this->_keywords_urlencode = $val;
}

function set_keyword_query( $val )
{
	$this->_keyword_query = $val;
}

function get_keyword_array()
{
	return $this->_keyword_array;
}

function get_keywords_urlencode()
{
	return $this->_class_keyword->urlencode_from_array( $this->_keyword_array );
}

//---------------------------------------------------------
// template parts file
//---------------------------------------------------------
function _get_parts_file( $name )
{
	return $this->_get_custom_file( 'parts', $name ) ;
}

function _get_custom_file( $dir, $name )
{
	$file_orig   = $this->_dir_templates .'/'. $dir .'/' . $name ;
	$file_custom = $this->_dir_templates .'/customs/'    . $name ;

	if ( file_exists($file_custom) ) {
		return $file_custom ;
	}

	return $file_orig ;
}

// --- class end ---
}

// === class end ===
}

?>