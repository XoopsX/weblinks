<?php
// $Id: weblinks_link_view_basic.php.\040ORIGINAL\0402.00.php,v 1.1 2012/04/09 10:21:09 ohwada Exp $

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
class weblinks_link_view_basic extends happy_linux_basic
{
	var $_DIRNAME;
	var $_WEBLINKS_URL;

// handler
	var $_config_handler;
	var $_link_handler;

// class
	var $_myts;
	var $_system;

// local
	var $_conf;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_link_view_basic( $dirname )
{
	$this->happy_linux_basic();

	$this->_DIRNAME = $dirname;
	$this->_WEBLINKS_URL = XOOPS_URL.'/modules/'.$dirname;

	$this->_config_handler       =& weblinks_get_handler('config2_basic',      $dirname );
	$this->_link_handler         =& weblinks_get_handler('link_basic',         $dirname );

	$this->_myts         =& MyTextSanitizer::getInstance();
	$this->_system       =& happy_linux_system::getInstance();

	$this->_conf = $this->_config_handler->get_conf();

// for Japanese
	$this->set_is_japanese( $this->_system->is_japanese() );
}

public static function &getInstance($dirname)
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
// dont show
	$this->set('passwd',      '');
	$this->set('search',      '');
	$this->set('rss_url',     '');
	$this->set('rss_xml',     '');
	$this->set('usercomment', '');

// sanitize
	$this->_set_sanitize_all();

	$desc = $this->_build_description_disp();

	$this->_set_textarea1_disp();
	$this->_set_textarea2_disp();
	$this->_set_admincomment_disp();

	$this->_set_name_mail_disp();
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

// new update
	$flag_new    = false;
	$flag_update = false;

	if ( $this->_conf['newdays'] > 0 )
	{
		$startdate = time() - (86400 * $this->_conf['newdays'] );
		if ( $startdate < $time_create ) 
		{
			$flag_new = true;
		}
		elseif ( $startdate < $time_update )
		{
			$flag_update = true;
		}
	}

	$this->set('flag_new',    $flag_new);
	$this->set('flag_update', $flag_update);

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
	$flag_url = false;
	if ( $this->get('url') && $this->_conf['view_url'] )
	{
		$flag_url = $this->_conf['view_url'];
	}

	$this->set('flag_url', $flag_url);

// votes
	$votes = $this->get('votes');
	if ($votes == 1) 
	{
		$votes_disp = _WLS_ONEVOTE;
	} 
	else
	{
		$votes_disp = sprintf(_WLS_NUMVOTES, $votes);
	}

	$this->set('votes_disp', $votes_disp);

// rating
	$DECIMALS = 2;
	$rating_disp = number_format($this->get('rating'), $DECIMALS);

	$this->set('rating_disp', $rating_disp );

// hits
	$flag_pop = false;
	if ( ( $this->_conf['popular'] > 0 ) &&
         ( $this->get('hits') >= $this->_conf['popular'] ) )
	{
		$flag_pop = true;
	}

	$this->set('flag_pop', $flag_pop);

// google map
	$this->_set_gmap();

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

function _build_description_disp()
{
	$context  = $this->get('description');
	$dohtml   = $this->get('dohtml');
	$dosmiley = $this->get('dosmiley');
	$doxcode  = $this->get('doxcode');
	$doimage  = $this->get('doimage');
	$dobr     = $this->get('dobr');
	$str = $this->_myts->displayTarea($context, $dohtml, $dosmiley, $doxcode, $doimage, $dobr);

	$this->set('description_disp', $str );
	return $str;
}

function _set_textarea1_disp()
{
	$context  = $this->get('textarea1');
	$dohtml   = $this->get('dohtml1');
	$dosmiley = $this->get('dosmiley1');
	$doxcode  = $this->get('doxcode1');
	$doimage  = $this->get('doimage1');
	$dobr     = $this->get('dobr1');
	$str = $this->_myts->displayTarea($context, $dohtml, $dosmiley, $doxcode, $doimage, $dobr);

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
	$str = $this->_myts->displayTarea($context, $dohtml, $dosmiley, $doxcode, $doimage, $dobr);

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
	$str = $this->_myts->displayTarea($context, $dohtml, $dosmiley, $doxcode, $doimage, $dobr);

	$this->set('admincomment_disp', $str );
}

function _set_name_mail_disp()
{
	$name_disp = $this->_build_name_mail_common( $this->get('name'), $this->get('nameflag') );
	$mail_disp = $this->_build_name_mail_common( $this->get('mail'), $this->get('mailflag') );

	if ( empty($name_disp) && $mail_disp )
	{
		$name_disp = 'Email';
	}

	$this->set('name_disp',  $name_disp );
	$this->set('mail_disp',  $mail_disp );
}

function _build_name_mail_common( $value, $flag )
{
	$str = null;
	if ($flag)
	{
		$str = $this->sanitize_text($value);
	}
	return $str;
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
// google map
//---------------------------------------------------------
function _set_gmap()
{
	$this->_set_gm_desc_wrap();
	$this->_set_gm_title();
	$this->_set_gm_type();
	$this->_set_gm_use();

	$link = $this->_build_single_link();

	$info_single = $this->_build_gmap_info( $this->get('url'), true );
	$info_list   = $this->_build_gmap_info( $this->_build_single_link() );

	$this->set('gm_info_single', $info_single);
	$this->set('gm_info_list',   $info_list);

}

function _build_gmap_info( $url, $flag_target=false )
{
	$gm_title_s   = $this->get('gm_title_s');
	$gm_desc_wrap = $this->get('gm_desc_wrap');

	$url_s = $this->sanitize_url( $url );

	$target = '';
	if ( $flag_target )
	{
		$target = 'target="_blank"';
	}

	$desc  = '<a href="'. $url_s .'" '. $target .'>';
	$desc .= '<b>'. $gm_title_s .'</b>';
	$desc .= '</a><br />';
	$desc .= '<font size="-2">'. $gm_desc_wrap .'</font>';

	$info = $desc;
	if ( $this->_conf['gm_marker_width'] > 0 ) 
	{
		$info  = '<div style="width:'. $this->_conf['gm_marker_width'] .'px">';
		$info .= $desc;
		$info .= '</div>';
	}

	return $info;
}

function _set_gm_desc_wrap()
{
	$str = $this->_build_gm_desc( $this->get('description_disp') );
	$str = $this->sanitize_text($str);

	if ( $this->_conf['gm_wordwrap'] > 0 )
	{
		$str = wordwrap( $str, $this->_conf['gm_wordwrap'], "<br />" );
	}

	$this->set('gm_desc_wrap', $str);
}

function _set_gm_title()
{
	$str = $this->get('title');

	$length = $this->_conf['gm_title_length'];

	if (( $length > 0 )&&( strlen($str) > $length ))
	{
		$str = $this->shorten_text($str, $length );
	}
	elseif ( $length == 0 )
	{
		$str = '';
	}

	$this->set('gm_title',   $str);
	$this->set('gm_title_s', $this->sanitize_text($str) );
}

function _set_gm_type()
{
	$gm_type = $this->get('gm_type');

	$gm_type_str = '';
	if ( $gm_type == 1 ) {
		$gm_type_str = 'satellite';
	} elseif ( $gm_type == 2 ) {
		$gm_type_str = 'hybrid';
	}

	$this->set('gm_type_str', $gm_type_str);
}

function _set_gm_use()
{
	$flag_gm_use  = false;
	$flag_kml_use = false;

	if ( $this->_check_gm_set() )
	{
		if ( $this->_conf['gm_use'] && $this->_conf['gm_apikey'] ) 
		{
			$flag_gm_use = true;
		}
		if ( $this->_conf['kml_use'] ) 
		{
			$flag_kml_use = true;
		}
	}

	$this->set('flag_gm_use',  $flag_gm_use);
	$this->set('flag_kml_use', $flag_kml_use);
}

function _check_gm_set()
{
	if ( $this->get('gm_latitude')  != 0 ) { return true; }
	if ( $this->get('gm_longitude') != 0 ) { return true; }
	if ( $this->get('gm_zoom')      != 0 ) { return true; }
	return false;
}

function _build_gm_desc( $str )
{
	$str = $this->add_space_after_punctuation($str);
	$str = $this->replace_return_to_space($str);
	$str = $this->strip_space($str);
	$str = $this->strip_tags_for_text($str);

	$length = $this->_conf['gm_desc_length'];
	if (( $length > 0 )&&( strlen($str) > $length ))
	{
		$str = $this->shorten_text($str, $length );
	}
	elseif ( $length == 0 )
	{
		$str = '';
	}

	return $str;
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
	$summary = $this->_build_gm_desc( $this->_build_description_disp() );
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