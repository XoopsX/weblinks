<?php
// $Id: weblinks_link_view_basic.php,v 1.2 2012/04/09 10:20:05 ohwada Exp $

// 2012-04-02 K.OHWADA
// weblinks_block_view
// mode_url_summary

// 2010-03-15 K.OHWADA
// _set_gm_marker()

// 2008-02-17 K.OHWADA
// divid from weblinks_link_view.php
// get_kml_by_lid()

//=========================================================
// WebLinks Module
// 2007-03-01 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('weblinks_link_view_basic') ) 
{

//=========================================================
// class weblinks_link_view_basic
//=========================================================
class weblinks_link_view_basic extends weblinks_block_view
{
	var $_DIRNAME;
	var $_WEBLINKS_URL;

// handler
	var $_config_handler;
	var $_link_handler;
	var $_block_class;

// class
	var $_system;

// local
	var $_conf;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_link_view_basic( $dirname )
{
	$this->weblinks_block_view();

	$this->_DIRNAME = $dirname;
	$this->_WEBLINKS_URL = XOOPS_URL.'/modules/'.$dirname;

	$this->_config_handler       =& weblinks_get_handler('config2_basic',      $dirname );
	$this->_link_handler         =& weblinks_get_handler('link_basic',         $dirname );

	$this->_system      =& happy_linux_system::getInstance();
	$this->_block_class =& weblinks_block_view::getInstance();

	$this->_conf = $this->_config_handler->get_conf();

// for Japanese
	$this->set_is_japanese( $this->_system->is_japanese() );
}

function &getInstance($dirname)
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new weblinks_link_view_basic($dirname);
	}
	return $instance;
}

//---------------------------------------------------------
// main
//---------------------------------------------------------
function &get_show_basic_by_lid( $lid )
{
	$show =  false;
	$row  =& $this->_link_handler->get_cache_by_lid($lid);
	if ( is_array($row) && count($row) )
	{
		$this->set_vars( $row );
		$this->build_show_basic();
		$show =& $this->get_vars();
	}
	return $show;
}

function build_show_basic()
{
	$this->set_params( $this->_conf );
	$this->set_multi();

// dont show
	$this->set('passwd',      '');
	$this->set('search',      '');
	$this->set('rss_url',     '');
	$this->set('rss_xml',     '');
	$this->set('usercomment', '');

// sanitize
	$this->_set_sanitize_all();

// pop votes rating
	$this->set('flag_pop',    $this->get_show_popular() );
	$this->set('votes_disp',  $this->get_votes_disp() );
	$this->set('rating_disp', $this->get_rating_disp() );

// new update
	list( $flag_new, $flag_update) = $this->get_show_new_update();
	$this->set('flag_new',    $flag_new);
	$this->set('flag_update', $flag_update);

// name mail
	$name_disp = $this->get_name_disp();
	$mail_disp = $this->get_mail_disp();

	if ( empty($name_disp) && $mail_disp ) {
		$name_disp = 'Email';
	}

	$this->set('name_disp',  $name_disp );
	$this->set('mail_disp',  $mail_disp );

// description
	$desc = $this->get_description_disp();
	$this->set('description_disp', $desc );

	$this->_set_textarea1_disp();
	$this->_set_textarea2_disp();
	$this->_set_admincomment_disp();

	$this->_set_array_addr_urlencode();

	$this->_set_warning();

	$this->set('flag_recommend', $this->get('recommend') );
	$this->set('flag_mutual',    $this->get('mutual') );

// time_create
	$time_create = $this->get('time_create');
	$this->set('create_long',   formatTimestamp($time_create, 'l') );
	$this->set('create_middle', formatTimestamp($time_create, 'm') );
	$this->set('create_short',  formatTimestamp($time_create, 's') );
	$this->set('create_mysql',  formatTimestamp($time_create, 'mysql') );

// time_update
	$time_update = $this->get('time_update');
	$this->set('update_long',   formatTimestamp($time_update, 'l') );
	$this->set('update_middle', formatTimestamp($time_update, 'm') );
	$this->set('update_short',  formatTimestamp($time_update, 's') );
	$this->set('update_mysql',  formatTimestamp($time_update, '_mysql') );

// is_owner
	$this->set('is_owner', $this->_system->is_owner( $this->get('uid') ) );

// time_publish
// Warning : date(): Windows does not support dates prior to ...
	$time_publish = $this->get('time_publish');

	$time_publish_long   = null;
	$time_publish_middle = null;
	$time_publish_short  = null;

	if ( $time_publish > 0 )
	{
		$time_publish_long   = formatTimestamp($time_publish, 'l');
		$time_publish_middle = formatTimestamp($time_publish, 'm');
		$time_publish_short  = formatTimestamp($time_publish, 's');
	}

	$this->set('time_publish_long',   $time_publish_long );
	$this->set('time_publish_middle', $time_publish_middle );
	$this->set('time_publish_short',  $time_publish_short );

// time_expire
// Warning : date(): Windows does not support dates prior to ...
	$time_expire = $this->get('time_expire');

	$time_expire_long   = null;
	$time_expire_middle = null;
	$time_expire_short  = null;

	if ( $time_expire > 0 )
	{
		$time_expire_long   = formatTimestamp($time_expire, 'l');
		$time_expire_middle = formatTimestamp($time_expire, 'm');
		$time_expire_short  = formatTimestamp($time_expire, 's');
	}

	$this->set('time_expire_long',   $time_expire_long );
	$this->set('time_expire_middle', $time_expire_middle );
	$this->set('time_expire_short',  $time_expire_short );

// url
	$flag_url         = 0;
	$mode_url_summary = 0;
	if ( $this->get('url') && $this->_conf['view_url'] )
	{
		$flag_url = $this->_conf['view_url'];
	}

	if ( $this->_conf['view_url_summary'] ) {
		$mode_url_summary = 3;
	} else {
		$mode_url_summary = $flag_url;
	}

	$this->set('flag_url',         $flag_url);
	$this->set('mode_url_summary', $mode_url_summary);


// admin
	$flag_admin = false;
	if ( $this->_system->is_module_admin() )
	{
		$flag_admin = true;
	}

	$this->set('flag_admin', $flag_admin);

// dont show
	$this->set('name',   '');
	$this->set('name_s', '');
	$this->set('mail',   '');
	$this->set('mail_s', '');
}

//---------------------------------------------------------
// set & build
//---------------------------------------------------------
function _build_single_link()
{
	return $this->_build_single_link_by_lid( $this->get('lid') );
}

function _build_single_link_by_lid( $lid )
{
	$link = $this->_WEBLINKS_URL.'/singlelink.php?lid='.$lid;
	return $link;
}

function _set_sanitize_all()
{
// MUST copy
	$arr = $this->get_vars();

	foreach ( $arr as $k => $v )
	{
// if NOT same item
		if ( !preg_match("/_s$/", $k) && !is_array($v) )
		{
			$name = $k.'_s';
			$val  = $this->sanitize_text($v);
			$this->set($name, $val);
		}
	}

	$this->set('url_s',     $this->sanitize_url($this->get('url')) );
	$this->set('banner_s',  $this->sanitize_url($this->get('banner')) );

}

function _set_textarea1_disp()
{
	$context  = $this->get('textarea1');
	$dohtml   = $this->get('dohtml1');
	$dosmiley = $this->get('dosmiley1');
	$doxcode  = $this->get('doxcode1');
	$doimage  = $this->get('doimage1');
	$dobr     = $this->get('dobr1');
	$str = $this->display_textarea($context, $dohtml, $dosmiley, $doxcode, $doimage, $dobr);

	$this->set('textarea1_disp', $str );
}

function _set_textarea2_disp()
{
	$context  = $this->get('textarea2');
	$dohtml   = 0;
	$dosmiley = 1;
	$doxcode  = 1;
	$doimage  = 1;
	$dobr     = 1;
	$str = $this->display_textarea($context, $dohtml, $dosmiley, $doxcode, $doimage, $dobr);

	$this->set('textarea2_disp', $str );
}

function _set_admincomment_disp()
{
	$context  = $this->get('admincomment');
	$dohtml   = 0;
	$dosmiley = 1;
	$doxcode  = 1;
	$doimage  = 1;
	$dobr     = 1;
	$str = $this->display_textarea($context, $dohtml, $dosmiley, $doxcode, $doimage, $dobr);

	$this->set('admincomment_disp', $str );
}

function _set_array_addr_urlencode()
{
// Mapfan disregards a space or subsequent ones. 

	$zip   = $this->get('zip');
	$state = $this->get('state');
	$city  = $this->get('city');
	$addr  = $this->get('addr');
	$addr2 = $this->get('addr2');

	$flag_addr         = 0;
	$en_join           = '';
	$jp_join           = '';
	$en_urlencode      = '';
	$jp_urlencode      = '';
	$en_utf8_urlencode = '';
	$jp_utf8_urlencode = '';
	$en_csz            = '';
	$en_csz_urlencode  = '';

	if ( $state || $city || $addr || $addr2 )
	{
		$flag_addr = 1;	
	}

	if ( $city && $state && $zip)
	{
		$en_csz = $city.', '.$state.' '.$zip;
	}
	elseif ( $city && $state)
	{
		$en_csz = $city.', '.$state;
	}
	elseif ( $city && $zip)
	{
		$en_csz = $city.', '.$zip;
	}

	$en_csz_urlencode = urlencode( $en_csz );

	if ( $state || $city || $addr)
	{
		$en_join = $addr.' '.$en_csz;
		$jp_join = $state . $city . $addr;
		$en_utf8 = happy_linux_convert_to_utf8($en_join);
		$jp_utf8 = happy_linux_convert_to_utf8($jp_join);
		$en_urlencode      = urlencode( $en_join );
		$jp_urlencode      = urlencode( $jp_join );
		$en_utf8_urlencode = urlencode( $en_utf8 );
		$jp_utf8_urlencode = urlencode( $jp_utf8 );
	}

	$this->set('flag_addr'              , $flag_addr);
	$this->set('addr_urlencode'         , urlencode( $addr ) );
	$this->set('addr2_urlencode'        , urlencode( $addr2 ) );
	$this->set('city_urlencode'         , urlencode( $city ) );
	$this->set('state_urlencode'        , urlencode( $state ) );
	$this->set('zip_urlencode'          , urlencode( $zip ) );
	$this->set('addr_utf8_urlencode'    , urlencode( happy_linux_convert_to_utf8( $addr ) ) );
	$this->set('addr2_utf8_urlencode'   , urlencode( happy_linux_convert_to_utf8( $addr2 ) ) );
	$this->set('city_utf8_urlencode'    , urlencode( happy_linux_convert_to_utf8( $city ) ) );
	$this->set('state_utf8_urlencode'   , urlencode( happy_linux_convert_to_utf8( $state ) ) );
	$this->set('zip_utf8_urlencode'     , urlencode( happy_linux_convert_to_utf8( $zip ) ) );
	$this->set('addr_en_join'           , $en_join);
	$this->set('addr_jp_join'           , $jp_join);
	$this->set('addr_en_urlencode'      , $en_urlencode);
	$this->set('addr_jp_urlencode'      , $jp_urlencode);
	$this->set('addr_en_utf8_urlencode' , $en_utf8_urlencode);
	$this->set('addr_jp_utf8_urlencode' , $jp_utf8_urlencode);
	$this->set('addr_en_csz'            , $en_csz);
	$this->set('addr_en_csz_urlencode'  , $en_csz_urlencode);

}

//---------------------------------------------------------
// warning
//---------------------------------------------------------
function _set_warning()
{
	$this->set('warn_time_publish', $this->_is_warn_time_publish() );
	$this->set('warn_time_expire',  $this->_is_warn_time_expire() );
	$this->set('warn_broken',       $this->_is_warn_broken() );
}

function _is_warn_time_publish()
{
	if (( $this->get('time_publish') == 0 )||( $this->get('time_publish') < time() ))
	{	return false;	}
	return true;
}

function _is_warn_time_expire()
{
	if (( $this->get('time_expire') == 0 )||( $this->get('time_expire') > time() ))
	{	return false;	}
	return true;
}

function _is_warn_broken()
{
	if (( $this->get('broken') == 0 )||( $this->get('broken') < $this->_conf['broken_threshold'] ))
	{	return false;	}
	return true;
}

//---------------------------------------------------------
// google map kml
//---------------------------------------------------------
function get_kml_by_lid( $lid )
{
// not use return references
	$show = false;
	$row  = $this->_link_handler->get_cache_by_lid($lid);
	if ( is_array($row) && count($row) )
	{
		$this->set_vars( $row );
		$this->build_kml();
		$show = $this->get_vars();
	}
	return $show;
}

function build_kml()
{
	$this->set( 'kml_name',        $this->get('title') );
	$this->set( 'kml_latitude',    $this->get('gm_latitude') );
	$this->set( 'kml_longitude',   $this->get('gm_longitude') );
	$this->set( 'kml_description', $this->_build_kml_desc() );
}

function _build_kml_desc()
{
	$summary = $this->build_summary( 
		$this->get_description_disp(), $this->_conf['gm_desc_length'] );

	$url_s   = $this->sanitize_url( $this->get('url') );
	$link_s  = $this->sanitize_url( $this->_build_single_link() );

	$text = '';

	if ( $url_s )
	{
		$text .= '<a href="'. $url_s. '">'.$url_s.'</a>';
		$text .= "<br /><br />\n";
	}

	$text .= $summary;
	$text .= "<br /><br />\n";

	$text .= 'from ';
	$text .= '<a href="'. $link_s. '">'. $this->_system->get_sitename() .'</a>';
	$text .= "<br />\n";

	return $text;
}

// --- class end ---
}

// === class end ===
}

?>