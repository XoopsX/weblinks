<?php
// $Id: weblinks_link_view.php,v 1.3 2012/04/10 18:52:29 ohwada Exp $

// 2012-04-02 K.OHWADA
// weblinks_webmap

// 2008-03-30 K.OHWADA
// show when url is fill

// 2008-02-17 K.OHWADA
// divid to weblinks_link_view_basic.php
// _set_pagerank()

// 2007-12-22 K.OHWADA
// BUG: not show smile icon

// 2007-10-30 K.OHWADA
// add_space_after_punctuation()
// weblinks_auth

// 2007-09-20 K.OHWADA
// not use $_DIR_SHOTS

// 2007-09-10 K.OHWADA
// set_warning()
// support mozshot simpleapi

// 2007-08-01 K.OHWADA
// _set_gm_desc_wrap()

// 2007-06-01 K.OHWADA
// rssc_view_handler

// 2007-05-06 K.OHWADA
// image_link_show image_list_show

// 2007-03-21 K.OHWADA
// time_expire_long

// 2007-03-07 K.OHWADA
// Warning [PHP]: date(): Windows does not support dates prior to midnight (00:00:00), January 1, 1970

// 2007-03-01 K.OHWADA
// divid from weblinks_link_view_edit

//=========================================================
// WebLinks Module
// 2007-03-01 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('weblinks_link_view') ) 
{

//=========================================================
// class weblinks_link_view
//=========================================================
class weblinks_link_view extends weblinks_link_view_basic
{

// handler
	var $_category_handler;
	var $_catlink_handler;
	var $_link_catlink_handler;
	var $_banner_handler;
	var $_pagerank_handler;
	var $_rssc_handler;
	var $_auth;
	var $_webmap_class;

	var $_lang;
	var $_highlight;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_link_view( $dirname )
{
	$this->weblinks_link_view_basic( $dirname );

	$this->_category_handler     =& weblinks_get_handler('category_basic',     $dirname );
	$this->_catlink_handler      =& weblinks_get_handler('catlink_basic',      $dirname );
	$this->_banner_handler       =& weblinks_get_handler('banner',             $dirname );
	$this->_pagerank_handler     =& weblinks_get_handler('pagerank',           $dirname );
	$this->_rssc_handler         =& weblinks_get_handler('rssc_view',          $dirname );
	$this->_auth                 =& weblinks_auth::getInstance( $dirname );
	$this->_webmap_class         =& weblinks_webmap::getInstance( $dirname );

	$this->_lang      =& happy_linux_language_factory::getInstance();
	$this->_highlight =& happy_linux_highlight::getInstance();

	$this->_highlight->set_replace_callback( 'happy_linux_highlighter_by_class' );
	$this->_highlight->set_class( 'weblinks_highlight' );

}

function &getInstance($dirname)
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new weblinks_link_view($dirname);
	}
	return $instance;
}

//---------------------------------------------------------
// main
//---------------------------------------------------------
function get_show_by_lid( $lid, $flag_highlight=false, $keyword_array=null  )
{
// not use return references
	$show = false;
	$row  = $this->_link_handler->get_cache_by_lid($lid);
	if ( is_array($row) && count($row) )
	{
		$this->set_vars( $row );
		$this->build_show( $flag_highlight, $keyword_array );
		$show = $this->get_vars();
	}
	return $show;
}

function build_show( $flag_highlight=false, $keyword_array=null )
{
	$this->build_show_basic();

// highlight
	$desc = $this->get('description_disp');
	$this->_set_highlight_desc(  $desc, $flag_highlight, $keyword_array );
	$this->_set_highlight_short( $desc, $flag_highlight, $keyword_array );

// lid
	$this->_set_link_categories();
	$this->_set_link_mail();

	$this->_set_link_image();
	$this->_set_pagerank();
	$this->_set_show_modify();
	$this->_set_link_rss_url();

	$this->_set_gm_use();
}

//---------------------------------------------------------
// auth class
//---------------------------------------------------------
function _set_show_modify()
{
	$show_modify = $this->_auth->show_modify( $this->get('uid') );
	$this->set('show_modify', $show_modify );
}

//---------------------------------------------------------
// catlink_handler
//---------------------------------------------------------
function _set_link_categories()
{
	$lid = $this->get('lid');
	$cid_arr = $this->_catlink_handler->get_cid_array_by_lid( $lid );
	$this->set_catpaths_by_cid_array( $cid_arr );

	if ( $this->check_lat_lng_zoom() ) {
		$this->set_google_icon_by_cid_array( $cid_arr );
	}
}

//---------------------------------------------------------
// category_handler
//---------------------------------------------------------
function set_catpaths_by_cid_array( $cid_arr )
{
	$show_catpaths = false;
	$catpaths      = null;

	if ( is_array($cid_arr) && count($cid_arr) ) {
		$catpaths =& $this->_category_handler->build_parent_path_multi($cid_arr);
		if ( is_array($catpaths) && count($catpaths) ){
			$show_catpaths = true;
		}
	}

	$this->set('show_catpaths', $show_catpaths);
	$this->set('catpaths',      $catpaths);
}

//---------------------------------------------------------
// banner_handler
//---------------------------------------------------------
function _set_link_image()
{
	$arr =& $this->_banner_handler->build_show_image_web
		( $this->get('banner'), $this->get('width'), $this->get('height'), $this->get('url') );

	$image_url         = $arr['image_url'];
	$image_link_width  = $arr['image_link_width'];
	$image_link_height = $arr['image_link_height'];
	$image_list_width  = $arr['image_list_width'];
	$image_list_height = $arr['image_list_height'];
	$image_link_show   = false;
	$image_list_show   = false;

	if ( $this->_conf['link_image_use'] && $image_url )
	{
		$image_link_show = true;
	}

	if ( $this->_conf['list_image_use'] && $image_url )
	{
		$image_list_show = true;
	}

	$this->set('image_url',          $image_url );
	$this->set('image_link_width',   $image_link_width );
	$this->set('image_link_height',  $image_link_height );
	$this->set('image_list_width',   $image_list_width );
	$this->set('image_list_height',  $image_list_height );
	$this->set('image_link_show',    $image_link_show);
	$this->set('image_list_show',    $image_list_show);
}

//---------------------------------------------------------
// pagerank_handler
//---------------------------------------------------------
function _set_pagerank()
{
	$flag_cache    = false;
	$show_pagerank = false;
	$pagerank      = 0;

// show when url is fill
	if ( ( $this->_conf['use_pagerank'] > 0 ) && $this->get('url') )
	{
		if ( $this->_conf['use_pagerank'] == 2 )
		{
			$flag_cache = true;
		}
		$show_pagerank = true;
		$pagerank = $this->_pagerank_handler->get_page_rank( $this->get('lid'), $flag_cache );
	}

	$this->set('show_pagerank', $show_pagerank);
	$this->set('pagerank',      $pagerank);
}

//---------------------------------------------------------
// rssc_handler
//---------------------------------------------------------
function _set_link_rss_url()
{
	list($flag, $url, $url_s) =
		$this->build_rss_url_by_rssc_lid( $this->get('rssc_lid') );

	$this->set('rss_flag',   $flag);
	$this->set('rss_url',    $url );
	$this->set('rss_url_s',  $url_s );
}

function build_rss_url_by_rssc_lid( $rssc_lid )
{
	$flag  = 0;
	$url   = '';
	$url_s = '';
	if ( WEBLINKS_RSSC_USE && $rssc_lid )
	{
		$row =& $this->_rssc_handler->get_rssc_link_by_rssc_lid($rssc_lid);
		$flag  = $row['mode'];
		$url   = $row['url_xml'];
		$url_s = $row['url_xml_s'];
	}
	return array($flag, $url, $url_s);
}

//---------------------------------------------------------
// class highlight
//---------------------------------------------------------
function _set_highlight_desc( $text, $flag_highlight=false, $keyword_array=null  )
{
	if ( $flag_highlight )
	{
		$text = $this->_highlight->build_highlight_keyword_array($text, $keyword_array);
	}
	$this->set('desc_disp', $text);
}

function _set_highlight_short( $text, $flag_highlight=false, $keyword_array=null  )
{
// BUG: not show  smile icon
// no action, if under limit
	if ( strlen($text) > $this->_conf['descshort'] )
	{
		$text = $this->add_space_after_punctuation($text);
		$text = $this->replace_return_to_space($text);
		$text = $this->strip_space($text);
		$text = $this->strip_tags_for_text($text);
		$text = $this->shorten_text($text, $this->_conf['descshort'], $keyword_array );
		$text = $this->sanitize_text($text);
	}

	if ( $flag_highlight )
	{
		$text = $this->_highlight->build_highlight_keyword_array($text, $keyword_array);
	}

	$this->set('desc_short', $text);
}

//---------------------------------------------------------
// class language
//---------------------------------------------------------
function _set_link_mail()
{
	$lid = $this->get('lid');

	$mail_subject = '';
	$mail_body    = '';

	if ($lid)
	{
		list($mail_subject, $mail_body) 
			= $this->build_link_mail_by_lid($lid);
	}

	$this->set('mail_subject', $mail_subject);
	$this->set('mail_body',    $mail_body);
}

// myheader.php
function build_link_mail_by_lid($lid)
{
	$sitename = $this->_system->get_sitename();
	$subject  = sprintf(_WLS_INTRESTLINK,  $sitename);
	$body     = sprintf(_WLS_INTLINKFOUND, $sitename).": ";
	$body    .= $this->_build_single_link_by_lid($lid);

// --- effective only in Japanese environment ---
// convert EUC-JP to SJIS
	$subject = $this->_lang->convert_telafriend_subject($subject);
	$body    = $this->_lang->convert_telafriend_body($body);

	$subject = rawurlencode($subject);
	$body    = rawurlencode($body);

	return array($subject, $body);
}

//---------------------------------------------------------
// google map
//---------------------------------------------------------
function check_webmap_dirname()
{
	$dirname = $this->_conf['webmap3_dirname'];
	$use     = $this->_conf['gm_use'];

	$ret = $this->_webmap_class->check_webmap_dirname( $dirname );
	if ( !$ret ) {
		return false;
	}
	if ( ! $use ) {
		return false;
	}
	return true;
}

function check_lat_lng_zoom()
{
	$ret = $this->_webmap_class->check_lat_lng_zoom( 
		$this->get('gm_latitude'), 
		$this->get('gm_longitude'), 
		$this->get('gm_zoom') );

	$this->set('google_use', $ret);
	return $ret;
}

function _set_gm_use()
{
	$flag_gm_use  = false;
	$flag_kml_use = false;

	if ( $this->get('google_use') )
	{
		if ( $this->check_webmap_dirname() ){
			$flag_gm_use = true;
		}
		if ( $this->_conf['kml_use'] ) {
			$flag_kml_use = true;
		}
	}

	$this->set('flag_gm_use',  $flag_gm_use);
	$this->set('flag_kml_use', $flag_kml_use);
}

function set_google_icon_by_cid_array( $cid_arr )
{
	$icon = $this->find_google_icon( $cid_arr );
	$this->set('google_icon', $icon);
}

function find_google_icon( $cid_arr )
{
// find in link
	$gm_icon = $this->get('gm_icon');
	if ( $gm_icon > 0 ) {
		return $gm_icon;
	}

// find in category
	$gm_icon = $this->_category_handler->find_gm_icon_by_cid_array( $cid_arr );
	if ( $gm_icon > 0 ) {
		return $gm_icon;
	}

// not find
	return 0;
}

//=========================================================
// for rss
//=========================================================
function get_rss_by_lid( $lid, $flag_user=false )
{
// not use return references
	$show = false;
	$row  = $this->_link_handler->get_cache_by_lid($lid);
	if ( is_array($row) && count($row) )
	{
		$this->set_vars( $row );
		$this->build_rss( $flag_user );
		$show = $this->get_vars();
	}
	return $show;
}

function build_rss( $flag_user=false )
{
	$lid = $this->get('lid');
	$uid = $this->get('uid');

	$link    = $this->_build_single_link_by_lid($lid);
	$content = $this->get_description_disp();

// author_name
	$author_name  = '';
	$author_email = '';
	$author_uri   = '';

	if ( $flag_user && $uid )
	{
		$user = $this->_system->get_user_by_uid( $uid );
		$author_name  = $user['uname'];
		$author_email = $user['email'];
		$author_uri   = $user['url'];
	}

// category
	$category = '';

	$cid_arr =& $this->_catlink_handler->get_cid_array_by_lid($lid);
	if ( isset($cid_arr[0]) )
	{
		$cid = intval($cid_arr[0]);
		$this->_category_handler->get_cache_row($cid);
		$category = $this->_category_handler->get_title($cid, 'n');
	}

	$this->set('rss_link',         $link );
	$this->set('rss_content',      $content );
	$this->set('rss_author_name',  $author_name);
	$this->set('rss_author_email', $author_email);
	$this->set('rss_author_uri',   $author_uri);
	$this->set('rss_category',     $category);
}

// --- class end ---
}

// === class end ===
}

?>