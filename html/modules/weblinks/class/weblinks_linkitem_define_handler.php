<?php
// $Id: weblinks_linkitem_define_handler.php,v 1.2 2012/04/09 10:20:05 ohwada Exp $

//	 $config[66]['name']        = 'gm_icon';

// 2008-02-17 K.OHWADA
// pagerank, pagerank_update in link, modify
// gm_kml

// 2007-09-01 K.OHWADA
// time_publish, time_expire: save_mode 2 -> 1
// notify: admin_form none -> hidden
// usercomment: textarea -> usercomment

// 2007-08-01 K.OHWADA
// admin can add etc column

// 2007-04-08 K.OHWADA
// gm_type

// 2007-03-25 K.OHWADA
// album_id

// 2007-02-20 K.OHWADA
// renew linkitem
// forum_id captcha

// 2007-02-04 K.OHWADA
// BUG 4476: reset hits rating votes commnets in modify link by admin

// 2006-12-10 K.OHWADA
// add data_type save_mode search_mode
// add time_publish textarea1
// add get_save_mode_list() get_search_list()

// 2006-10-01 K.OHWADA
// renewal order
// use rssc
// add rssc_lid
// google map

// 2006-05-15 K.OHWADA
// this is new file
// use new handler

//================================================================
// WebLinks Module
// this file contain 2 class
//   weblinks_linkitem_define
//   weblinks_linkitem_define_handler
// 2006-05-15 K.OHWADA
//================================================================

// === class begin ===
if( !class_exists('weblinks_linkitem_define_handler') ) 
{

//=========================================================
// class weblinks_linkitem_define
//=========================================================
class weblinks_linkitem_define
{
// user_mode
//   0: not use
//   1: use
//   2: indispensable
//
// conf_form
//   0: not show
//   1: show
//   2: fixed
//
// save_mode
//   0: admin & user cannot save 
//   1: admin & user can save
//   2: admin can save, user cannot

	var $_cached = array();

	var $_num_etc = WEBLINKS_LINK_NUM_ETC;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_linkitem_define( $dirname )
{
	if ( WEBLINKS_USE_LINK_NUM_ETC )
	{
		$config_handler =& weblinks_get_handler('config2_basic', $dirname );
		$conf =& $config_handler->get_conf();
		if ( is_array($conf) && (count($conf) > 0) )
		{
			$this->set_num_etc( $conf['link_num_etc'] );
		}
	}
}

function &getInstance( $dirname )
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new weblinks_linkitem_define( $dirname );
	}
	return $instance;
}

//---------------------------------------------------------
// function
//---------------------------------------------------------
function &get_define()
{

//---------------------------------------------------------
// basic config
// admin can change some field
//---------------------------------------------------------
	 $config[1]['name']       = 'mid';
	 $config[1]['title']      = _WEBLINKS_MID;
	 $config[1]['user_mode']  = 1;
	 $config[1]['user_form']  = 'mid';
	 $config[1]['admin_form'] = 'mid';
	 $config[1]['conf_form']  = 0;

// save in create record
	 $config[2]['name']       = 'lid';
	 $config[2]['title']      = _WLS_LINKID;
	 $config[2]['user_mode']  = 1;
	 $config[2]['user_form']  = 'lid';
	 $config[2]['admin_form'] = 'lid';
	 $config[2]['conf_form']  = 0;
	 $config[2]['save_mode']  = 1;

	 $config[3]['name']       = 'rssc_lid';
	 $config[3]['title']      = _WEBLINKS_RSSC_LID;
	 $config[3]['user_mode']  = 1;
	 $config[3]['user_form']  = 'none';
	 $config[3]['admin_form'] = 'rssc_lid';
	 $config[3]['conf_form']  = 0;

	 $config[4]['name']       = 'uid';
	 $config[4]['title']      = _WEBLINKS_USERID;
	 $config[4]['user_mode']  = 0;
	 $config[4]['user_form']  = 'none';
	 $config[4]['admin_form'] = 'uid';
	 $config[4]['conf_form']  = 0;

// save in create record
	 $config[5]['name']       = 'time_create';
	 $config[5]['title']      = _WEBLINKS_CREATE;
	 $config[5]['user_mode']  = 0;
	 $config[5]['admin_form'] = 'label_time';
	 $config[5]['conf_form']  = 0;

	 $config[6]['name']       = 'time_update';
	 $config[6]['title']      = _WLS_LASTUPDATE;
	 $config[6]['user_mode']  = 0;
	 $config[6]['user_form']  = 'none';
	 $config[6]['admin_form'] = 'time_update';
	 $config[6]['conf_form']  = 2;
	 $config[6]['options']    = array(
		_WLS_NOTTIMEUPDATE => 0,
		_WLS_TIMEUPDATE    => 1
	);

//---------------------------------------------------------
// admin can change
//---------------------------------------------------------
	 $config[13]['name']       = 'recommend';
	 $config[13]['title']      = _WLS_SITE_RECOMMEND;
	 $config[13]['user_mode']  = 0;
	 $config[13]['user_form']  = 'none';
	 $config[13]['admin_form'] = 'checkbox';
	 $config[13]['data_type']  = 'int_checkbox';
	 $config[13]['conf_form']  = 0;
	 $config[13]['save_mode']  = 2;
	 $config[13]['options']     = array(
		_WLS_SITE_RECOMMEND => 1,
	);

	 $config[14]['name']       = 'mutual';
	 $config[14]['title']      = _WLS_SITE_MUTUAL;
	 $config[14]['user_mode']  = 0;
	 $config[14]['user_form']  = 'none';
	 $config[14]['admin_form'] = 'checkbox';
	 $config[14]['data_type']  = 'int_checkbox';
	 $config[14]['conf_form']  = 0;
 	 $config[14]['save_mode']  = 2;
	 $config[14]['options']     = array(
		_WLS_SITE_MUTUAL => 1,
	);

// not use
	 $config[15]['name']       = 'cids';
	 $config[15]['title']      = _WLS_CATEGORY;

//---------------------------------------------------------
// user can change
//---------------------------------------------------------
	 $config[20]['name']       = '20';
	 $config[20]['admin_form'] = 'break_line';

	 $config[11]['name']        = 'time_publish';
	 $config[11]['title']       = _WEBLINKS_TIME_PUBLISH;
	 $config[11]['user_mode']   = 0;
	 $config[11]['user_form']   = 'time_publish';
	 $config[11]['admin_form']  = 'time_publish';
	 $config[11]['conf_form']   = 1;
	 $config[11]['data_type']  = 'int_time_select';
	 $config[11]['save_mode']   = 1;

	 $config[12]['name']        = 'time_expire';
	 $config[12]['title']       = _WEBLINKS_TIME_EXPIRE;
	 $config[12]['user_mode']   = 0;
	 $config[12]['user_form']   = 'time_expire';
	 $config[12]['admin_form']  = 'time_expire';
	 $config[12]['conf_form']   = 1;
	 $config[12]['data_type']  = 'int_time_select';
	 $config[12]['save_mode']   = 1;

	 $config[21]['name']        = 'title';
	 $config[21]['title']       = _WLS_SITETITLE;
	 $config[21]['user_mode']   = 2;
	 $config[21]['user_form']   = 'text';
	 $config[21]['admin_form']  = 'text';
	 $config[21]['conf_form']   = 2;
	 $config[21]['save_mode']   = 1;
	 $config[21]['search_mode'] = 1;

	 $config[22]['name']       = 'cat';
	 $config[22]['title']      = _WLS_CATEGORY;
	 $config[22]['user_mode']  = 2;
	 $config[22]['user_form']  = 'cat';
	 $config[22]['admin_form'] = 'cat';
	 $config[22]['conf_form']  = 2;

	 $config[23]['name']        = 'url';
	 $config[23]['title']       = _WLS_SITEURL;
	 $config[23]['user_mode']   = 2;
	 $config[23]['user_form']   = 'url';
	 $config[23]['admin_form']  = 'url';
	 $config[23]['conf_form']   = 1;
	 $config[23]['save_mode']   = 1;
	 $config[23]['search_mode'] = 1;

// description
	 $config[31]['name']       = 'description';
	 $config[31]['title']      = _WLS_DESCRIPTION;
	 $config[31]['user_mode']  = 2;
	 $config[31]['user_form']  = 'user_dhtml';
	 $config[31]['admin_form'] = 'dhtml';
	 $config[31]['conf_form']  = 1;
	 $config[31]['save_mode']  = 1;

	 $config[32]['name']       = 'dohtml';
	 $config[32]['title']      = 'dohtml';
	 $config[32]['user_mode']  = 0;
	 $config[32]['user_form']  = 'none';
	 $config[32]['admin_form'] = 'none';
	 $config[32]['data_type']  = 'int_checkbox';
	 $config[32]['conf_form']  = 0;
	 $config[32]['options']    = array(
		_WEBLINKS_DOHTML => 1,
	);

	 $config[33]['name']       = 'dosmiley';
	 $config[33]['title']      = 'dosmiley';
	 $config[33]['user_mode']  = 0;
	 $config[33]['user_form']  = 'none';
	 $config[33]['admin_form'] = 'none';
	 $config[33]['data_type']  = 'int_checkbox';
	 $config[33]['conf_form']  = 0;
	 $config[33]['options']    = array(
		_WEBLINKS_DOSMILEY => 1,
	);

	 $config[34]['name']       = 'doxcode';
	 $config[34]['title']      = 'doxcode';
	 $config[34]['user_mode']  = 0;
	 $config[34]['user_form']  = 'none';
	 $config[34]['admin_form'] = 'none';
	 $config[34]['data_type']  = 'int_checkbox';
	 $config[34]['conf_form']  = 0;
	 $config[34]['options']    = array(
		_WEBLINKS_DOXCODE => 1,
	);

	 $config[35]['name']       = 'doimage';
	 $config[35]['title']      = 'doimage';
	 $config[35]['user_mode']  = 0;
	 $config[35]['user_form']  = 'none';
	 $config[35]['admin_form'] = 'none';
	 $config[35]['data_type']  = 'int_checkbox';
	 $config[35]['conf_form']  = 0;
	 $config[35]['options']    = array(
		_WEBLINKS_DOIMAGE => 1,
	);

	 $config[36]['name']       = 'dobr';
	 $config[36]['title']      = 'dobr';
	 $config[36]['user_mode']  = 0;
	 $config[36]['user_form']  = 'none';
	 $config[36]['admin_form'] = 'none';
	 $config[36]['data_type']  = 'int_checkbox';
	 $config[36]['conf_form']  = 0;
	 $config[36]['options']    = array(
		_WEBLINKS_DOBREAK => 1,
	);

	 $config[41]['name']       = 'banner';
	 $config[41]['title']      = _WLS_BANNERURL;
	 $config[41]['user_mode']  = 1;
	 $config[41]['user_form']  = 'url';
	 $config[41]['admin_form'] = 'banner';
	 $config[41]['conf_form']  = 1;
	 $config[41]['save_mode']  = 1;

	 $config[42]['name']       = 'width';
	 $config[42]['title']      = 'width';
	 $config[42]['user_mode']  = 0;
	 $config[42]['user_form']  = 'none';
	 $config[42]['admin_form'] = 'banner_size';
	 $config[42]['conf_form']  = 0;

	 $config[43]['name']       = 'height';
	 $config[43]['title']      = 'height';
	 $config[43]['user_mode']  = 0;
	 $config[43]['user_form']  = 'none';
	 $config[43]['admin_form'] = 'banner_size';
	 $config[43]['conf_form']  = 0;

	 $config[44]['name']       = 'rss_url';
	 $config[44]['title']      = _WLS_RSS_URL;
	 $config[44]['user_mode']  = 1;
	 $config[44]['user_form']  = 'rss_url';
	 $config[44]['admin_form'] = 'rss_url';
	 $config[44]['conf_form']  = 1;

	 $config[45]['name']       = 'rss_flag';
	 $config[45]['title']      = 'rss_flag';
	 $config[45]['user_mode']  = 1;
	 $config[45]['user_form']  = 'none';
	 $config[45]['admin_form'] = 'none';
	 $config[45]['conf_form']  = 0;
	 $config[45]['options']    = array(
		_WLS_RSS_URL_0 => 0,
		_WLS_RSS_URL_2 => 2,
		_WLS_RSS_URL_1 => 1,
		_WLS_RSS_URL_3 => 3,
	);

	 $config[46]['name']       = 'name';
	 $config[46]['title']      = _WLS_NAME;
	 $config[46]['user_mode']  = 1;
	 $config[46]['user_form']  = 'name';
	 $config[46]['admin_form'] = 'name';
	 $config[46]['conf_form']  = 1;
	 $config[46]['save_mode']  = 1;

	 $config[47]['name']       = 'nameflag';
	 $config[47]['title']      = 'nameflag';
	 $config[47]['user_mode']  = 0;
	 $config[47]['user_form']  = 'none';
	 $config[47]['admin_form'] = 'none';
	 $config[47]['conf_form']  = 0;
	 $config[47]['save_mode']  = 1;
	 $config[47]['options']    = array(
		_WLS_NOTPUBLIC => 0,
		_WLS_PUBLIC    => 1,
	);

	 $config[48]['name']       = 'mail';
	 $config[48]['title']      = _WLS_EMAIL;
	 $config[48]['user_mode']  = 1;
	 $config[48]['user_form']  = 'mail';
	 $config[48]['admin_form'] = 'mail';
	 $config[48]['conf_form']  = 1;
	 $config[48]['save_mode']  = 1;

	 $config[49]['name']       = 'mailflag';
	 $config[49]['title']      = 'mailflag';
	 $config[49]['user_mode']  = 0;
	 $config[49]['user_form']  = 'none';
	 $config[49]['admin_form'] = 'none';
	 $config[49]['conf_form']  = 0;
	 $config[49]['save_mode']  = 1;
	 $config[49]['options']    = array(
		_WLS_NOTPUBLIC => 0,
		_WLS_PUBLIC    => 1,
	);

	 $config[51]['name']        = 'company';
	 $config[51]['title']       = _WLS_COMPANY;
	 $config[51]['user_mode']   = 1;
	 $config[51]['user_form']   = 'text';
	 $config[51]['admin_form']  = 'text';
	 $config[51]['conf_form']   = 1;
	 $config[51]['save_mode']   = 1;
	 $config[51]['search_mode'] = 1;

	 $config[52]['name']        = 'zip';
	 $config[52]['title']       = _WLS_ZIP;
	 $config[52]['user_mode']   = 1;
	 $config[52]['user_form']   = 'text';
	 $config[52]['admin_form']  = 'text';
	 $config[52]['conf_form']   = 1;
	 $config[52]['save_mode']   = 1;
	 $config[52]['search_mode'] = 1;

	 $config[53]['name']        = 'state';
	 $config[53]['title']       = _WLS_STATE;
	 $config[53]['user_mode']   = 1;
	 $config[53]['user_form']   = 'text';
	 $config[53]['admin_form']  = 'text';
	 $config[53]['conf_form']   = 1;
	 $config[53]['save_mode']   = 1;
	 $config[53]['search_mode'] = 1;

	 $config[54]['name']        = 'city';
	 $config[54]['title']       = _WLS_CITY;
	 $config[54]['user_mode']   = 1;
	 $config[54]['user_form']   = 'text';
	 $config[54]['admin_form']  = 'text';
	 $config[54]['conf_form']   = 1;
	 $config[54]['save_mode']   = 1;
	 $config[54]['search_mode'] = 1;

	 $config[55]['name']        = 'addr';
	 $config[55]['title']       = _WLS_ADDR;
	 $config[55]['user_mode']   = 1;
	 $config[55]['user_form']   = 'text';
	 $config[55]['admin_form']  = 'text';
	 $config[55]['conf_form']   = 1;
	 $config[55]['save_mode']   = 1;
	 $config[55]['search_mode'] = 1;

	 $config[56]['name']        = 'addr2';
	 $config[56]['title']       = _WLS_ADDR2;
	 $config[56]['user_mode']   = 1;
	 $config[56]['user_form']   = 'text';
	 $config[56]['admin_form']  = 'text';
	 $config[56]['conf_form']   = 1;
	 $config[56]['save_mode']   = 1;
	 $config[56]['search_mode'] = 1;

	 $config[57]['name']        = 'tel';
	 $config[57]['title']       = _WLS_TEL;
	 $config[57]['user_mode']   = 1;
	 $config[57]['user_form']   = 'text';
	 $config[57]['admin_form']  = 'text';
	 $config[57]['conf_form']   = 1;
	 $config[57]['save_mode']   = 1;
	 $config[57]['search_mode'] = 1;

	 $config[58]['name']        = 'fax';
	 $config[58]['title']       = _WLS_FAX;
	 $config[58]['user_mode']   = 1;
	 $config[58]['user_form']   = 'text';
	 $config[58]['admin_form']  = 'text';
	 $config[58]['conf_form']   = 1;
	 $config[58]['save_mode']   = 1;
	 $config[58]['search_mode'] = 1;

	 $config[59]['name']       = 'map_use';
	 $config[59]['title']      = _WEBLINKS_MAP_USE;
	 $config[59]['user_mode']  = 1;
	 $config[59]['user_form']  = 'yesno';
	 $config[59]['admin_form'] = 'yesno';
	 $config[59]['conf_form']  = 1;
	 $config[59]['save_mode']  = 1;

// google map: hacked by wye
	 $config[61]['name']        = 'gm_latitude';
	 $config[61]['title']       = _WEBLINKS_GM_LATITUDE;
	 $config[61]['user_mode']   = 0;
	 $config[61]['user_form']   = 'gm_latitude';
	 $config[61]['admin_form']  = 'gm_latitude';
	 $config[61]['conf_form']   = 1;
	 $config[61]['save_mode']   = 1;

	 $config[62]['name']        = 'gm_longitude';
	 $config[62]['title']       = _WEBLINKS_GM_LONGITUDE;
	 $config[62]['user_mode']   = 0;
	 $config[62]['user_form']   = 'text';
	 $config[62]['admin_form']  = 'text';
	 $config[62]['conf_form']   = 1;
	 $config[62]['save_mode']   = 1;

	 $config[63]['name']        = 'gm_zoom';
	 $config[63]['title']       = _WEBLINKS_GM_ZOOM;
	 $config[63]['user_mode']   = 0;
	 $config[63]['user_form']   = 'text';
	 $config[63]['admin_form']  = 'text';
	 $config[63]['conf_form']   = 1;
	 $config[63]['save_mode']   = 1;

	 $config[64]['name']        = 'gm_type';
	 $config[64]['title']       = _WEBLINKS_GM_TYPE;
	 $config[64]['user_mode']   = 0;
	 $config[64]['user_form']   = 'radio';
	 $config[64]['admin_form']  = 'radio';
	 $config[64]['conf_form']   = 1;
	 $config[64]['save_mode']   = 1;
	 $config[64]['options']    = array(
		_WEBLINKS_GM_TYPE_MAP       => 0,
		_WEBLINKS_GM_TYPE_SATELLITE => 1,
		_WEBLINKS_GM_TYPE_HYBRID    => 2,
	);

	 $config[66]['name']        = 'gm_icon';
	 $config[66]['title']       = _WEBLINKS_GM_ICON;
	 $config[66]['user_mode']   = 0;
	 $config[66]['user_form']   = 'gm_icon';
	 $config[66]['admin_form']  = 'gm_icon';
	 $config[66]['conf_form']   = 1;
	 $config[66]['save_mode']   = 1;

// virtual item for additional
	 $config[65]['name']        = 'gm_kml';
	 $config[65]['title']       = _WEBLINKS_GM_KML_DEBUG;
	 $config[65]['user_mode']   = 0;
	 $config[65]['user_form']   = 'none';
	 $config[65]['admin_form']  = 'gm_kml';
	 $config[65]['conf_form']   = 0;
	 $config[65]['save_mode']   = 0;

// etc1 .. etci
	if ( $this->_num_etc > 0 )
	{
		for ($i = 1; $i <= $this->_num_etc; $i++)
		{
			$num = 200 + $i;
			$config[$num]['name']        = 'etc'.$i;
	 		$config[$num]['title']       = _WEBLINKS_ETC.' '.$i;
	 		$config[$num]['user_mode']   = 0;
	 		$config[$num]['user_form']   = 'text';
	 		$config[$num]['admin_form']  = 'text';
	 		$config[$num]['conf_form']   = 1;
	 		$config[$num]['save_mode']   = 1;
	 		$config[$num]['search_mode'] = 1;
		}
	}

// textarea1
	 $config[81]['name']       = 'textarea1';
	 $config[81]['title']      = _WEBLINKS_TEXTAREA.' 1';;
	 $config[81]['user_mode']  = 0;
	 $config[81]['user_form']  = 'user_dhtml';
	 $config[81]['admin_form'] = 'dhtml';
	 $config[81]['conf_form']  = 1;
	 $config[81]['save_mode']  = 1;

	 $config[82]['name']       = 'dohtml1';
	 $config[82]['title']      = 'dohtml1';
	 $config[82]['user_mode']  = 0;
	 $config[82]['user_form']  = 'none';
	 $config[82]['admin_form'] = 'none';
	 $config[82]['data_type']  = 'int_checkbox';
	 $config[82]['conf_form']  = 0;
	 $config[82]['options']    = array(
		_WEBLINKS_DOHTML => 1,
	);

	 $config[83]['name']       = 'dosmiley1';
	 $config[83]['title']      = 'dosmiley1';
	 $config[83]['user_mode']  = 0;
	 $config[83]['user_form']  = 'none';
	 $config[83]['admin_form'] = 'none';
	 $config[83]['data_type']  = 'int_checkbox';
	 $config[83]['conf_form']  = 0;
	 $config[83]['options']    = array(
		_WEBLINKS_DOSMILEY => 1,
	);

	 $config[84]['name']       = 'doxcode1';
	 $config[84]['title']      = 'doxcode1';
	 $config[84]['user_mode']  = 0;
	 $config[84]['user_form']  = 'none';
	 $config[84]['admin_form'] = 'none';
	 $config[84]['data_type']  = 'int_checkbox';
	 $config[84]['conf_form']  = 0;
	 $config[84]['options']    = array(
		_WEBLINKS_DOXCODE => 1,
	);

	 $config[85]['name']       = 'doimage1';
	 $config[85]['title']      = 'doimage1';
	 $config[85]['user_mode']  = 0;
	 $config[85]['user_form']  = 'none';
	 $config[85]['admin_form'] = 'none';
	 $config[85]['data_type']  = 'int_checkbox';
	 $config[85]['conf_form']  = 0;
	 $config[85]['options']    = array(
		_WEBLINKS_DOIMAGE => 1,
	);

	 $config[86]['name']       = 'dobr1';
	 $config[86]['title']      = 'dobr1';
	 $config[86]['user_mode']  = 0;
	 $config[86]['user_form']  = 'none';
	 $config[86]['admin_form'] = 'none';
	 $config[86]['data_type']  = 'checkbox';
	 $config[86]['conf_form']  = 0;
	 $config[86]['options']    = array(
		_WEBLINKS_DOBREAK => 1,
	);

	 $config[91]['name']       = 'textarea2';
	 $config[91]['title']      = _WEBLINKS_TEXTAREA.' 2';;
	 $config[91]['user_mode']  = 0;
	 $config[91]['user_form']  = 'textarea';
	 $config[91]['admin_form'] = 'textarea';
	 $config[91]['conf_form']  = 1;
	 $config[91]['save_mode']  = 1;
	 $config[91]['order']      = 65;

	 $config[101]['name']        = 'usercomment';
	 $config[101]['title']       = _WLS_USER_COMMENT;
	 $config[101]['description'] = _WLS_NOT_DISPLAY;
	 $config[101]['user_mode']   = 1;
	 $config[101]['user_form']   = 'usercomment';
	 $config[101]['admin_form']  = 'textarea';
	 $config[101]['conf_form']   = 1;
	 $config[101]['save_mode']   = 1;

	 $config[102]['name']        = 'passwd';
	 $config[102]['title']       = _US_PASSWORD;
	 $config[102]['user_mode']   = 1;
	 $config[102]['user_form']   = 'passwd';
	 $config[102]['admin_form']  = 'passwd';
	 $config[102]['conf_form']   = 2;

	 $config[103]['name']        = 'captcha';
	 $config[103]['title']       = _WEBLINKS_CAPTCHA;
	 $config[103]['description'] = _WEBLINKS_CAPTCHA_DESC;
	 $config[103]['user_mode']   = 1;
	 $config[103]['user_form']   = 'captcha';
	 $config[103]['admin_form']  = 'none';
	 $config[103]['conf_form']   = 2;

	 $config[104]['name']        = 'notify';
	 $config[104]['title']       = _WLS_OPTIONS;
	 $config[104]['user_mode']   = 1;
	 $config[104]['user_form']   = 'notify';
	 $config[104]['admin_form']  = 'hidden';
	 $config[104]['conf_form']   = 0;
	 $config[104]['options']     = array(
		_WLS_NOTIFYAPPROVE => 1,
	);

//---------------------------------------------------------
// admin can change
//---------------------------------------------------------
	 $config[110]['name']       = '110';
	 $config[110]['admin_form'] = 'break_line';

	 $config[111]['name']       = 'broken';
	 $config[111]['title']      = _WLS_BROKEN_COUNTER;
	 $config[111]['user_mode']  = 0;
	 $config[111]['user_form']  = 'none';
	 $config[111]['admin_form'] = 'broken';
	 $config[111]['conf_form']  = 0;
	 $config[111]['save_mode']  = 2;

	 $config[112]['name']        = 'comment_use';
	 $config[112]['title']       = _WEBLINKS_COMMENT_USE;
	 $config[112]['user_mode']   = 0;
	 $config[112]['user_form']   = 'none';
	 $config[112]['admin_form']  = 'yesno';
	 $config[112]['conf_form']   = 0;
	 $config[112]['save_mode']   = 1;

	 $config[113]['name']        = 'forum_id';
	 $config[113]['title']       = _WEBLINKS_FORUM_SEL;
	 $config[113]['user_mode']   = 0;
	 $config[113]['user_form']   = 'none';
	 $config[113]['admin_form']  = 'forum_id';
	 $config[113]['conf_form']   = 0;
	 $config[113]['save_mode']   = 1;

	 $config[115]['name']        = 'album_id';
	 $config[115]['title']       = _WEBLINKS_ALBUM_SEL;
	 $config[115]['user_mode']   = 0;
	 $config[115]['user_form']   = 'none';
	 $config[115]['admin_form']  = 'album_id';
	 $config[115]['conf_form']   = 0;
	 $config[115]['save_mode']   = 1;

	 $config[114]['name']        = 'admincomment';
	 $config[114]['title']       = _WLS_ADMINCOMMENT;
	 $config[114]['user_mode']   = 0;
	 $config[114]['user_form']   = 'none';
	 $config[114]['admin_form']  = 'admincomment';
	 $config[114]['conf_form']   = 2;
	 $config[114]['save_mode']   = 1;
	 $config[114]['search_mode'] = 1;

//---------------------------------------------------------
// admin show only
// program create automatically
//---------------------------------------------------------
// BUG 4476: reset hits rating votes commnets in modify link by admin
	 $config[121]['name']       = 'hits';
	 $config[121]['title']      = _WLS_HITS;
	 $config[121]['user_mode']  = 0;
	 $config[121]['user_form']  = 'none';
	 $config[121]['admin_form'] = 'label';
	 $config[121]['conf_form']  = 2;

	 $config[122]['name']       = 'rating';
	 $config[122]['title']      = _WLS_RATING;
	 $config[122]['user_mode']  = 0;
	 $config[122]['user_form']  = 'none';
	 $config[122]['admin_form'] = 'label_float';
	 $config[122]['conf_form']  = 2;

	 $config[123]['name']       = 'votes';
	 $config[123]['title']      = _WLS_VOTE;
	 $config[123]['user_mode']  = 0;
	 $config[123]['user_form']  = 'none';
	 $config[123]['admin_form'] = 'label_float';
	 $config[123]['conf_form']  = 2;

	 $config[124]['name']       = 'comments';
	 $config[124]['title']      = _COMMENTS;
	 $config[124]['user_mode']  = 0;
	 $config[124]['user_form']  = 'none';
	 $config[124]['admin_form'] = 'label';
	 $config[124]['conf_form']  = 2;

	 $config[125]['name']       = 'pagerank';
	 $config[125]['title']      = _WEBLINKS_PAGERANK;
	 $config[125]['user_mode']  = 0;
	 $config[125]['user_form']  = 'none';
	 $config[125]['admin_form'] = 'label';
	 $config[125]['conf_form']  = 2;

	 $config[126]['name']       = 'pagerank_update';
	 $config[126]['title']      = _WEBLINKS_PAGERANK_UPDATE;
	 $config[126]['user_mode']  = 0;
	 $config[126]['user_form']  = 'none';
	 $config[126]['admin_form'] = 'label_time';
	 $config[126]['conf_form']  = 2;

//---------------------------------------------------------
// not show
//---------------------------------------------------------
	 $config[131]['name']       = 'search';
	 $config[131]['title']      = 'search';

	 $config[132]['name']       = 'mark';
	 $config[132]['title']      = 'mark';

	 $config[133]['name']       = 'rss_xml';
	 $config[133]['title']      = 'rss_xml';

	 $config[134]['name']       = 'rss_update';
	 $config[134]['title']      = 'rss_update';

	 $config[135]['name']       = 'approve';
	 $config[135]['title']      = 'approve';

	 $config[141]['name']       = 'aux_int_1';
	 $config[141]['title']      = 'aux_int_1';

	 $config[142]['name']       = 'aux_int_2';
	 $config[142]['title']      = 'aux_int_2';

	 $config[143]['name']       = 'aux_text_1';
	 $config[143]['title']      = 'aux_text_1';

	 $config[144]['name']       = 'aux_text_2';
	 $config[144]['title']      = 'aux_text_2';

// dummy for renewal
	 $config[151]['name']       = 'renew_1';
	 $config[151]['title']      = 'renew_1';

//---------------------------------------------------------
// others
// 200: etc1 ... etci
//---------------------------------------------------------

	return $config;
}

//---------------------------------------------------------
// load
//---------------------------------------------------------
function load()
{
	$this->_cached = $this->get_define();
	return $this->_cached;
}

function get_cache_by_itemid_key($id, $key)
{
	if ( isset( $this->_cached[$id][$key] ) )
	{
		$val = $this->_cached[$id][$key];
		return $val;
	}

	return false;
}

//---------------------------------------------------------
// set param
//---------------------------------------------------------
function set_num_etc($val)
{
	$val = intval($val);
	if ($val < 0)
	{
		$val = 0;
	}
	$this->_num_etc = $val;
}

// --- class end ---
}


//=========================================================
// class weblinks_linkitem_define_handler
//=========================================================
class weblinks_linkitem_define_handler
{
	var $_linkitem_handler; 
	var $_linkitem_define;

// cache
	var $_cached_by_itemid = array();
	var $_cached_by_name   = array();

	var $_is_module_admin;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_linkitem_define_handler( $dirname )
{
	$this->_linkitem_handler =& weblinks_get_handler('linkitem', $dirname );
	$this->_linkitem_define  =& weblinks_linkitem_define::getInstance( $dirname );

	$system =& happy_linux_system::getInstance();
	$this->_is_module_admin = $system->is_module_admin();
}

function &getInstance( $dirname )
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new weblinks_linkitem_define_handler( $dirname );
	}
	return $instance;
}

//---------------------------------------------------------
// load
//---------------------------------------------------------
function &load()
{
	$def_arr = $this->_linkitem_define->load();
	$this->_linkitem_handler->load();

	$this->_cached_by_itemid = array();
	$this->_cached_by_name   = array();

	foreach ($def_arr as $id => $def )
	{
		$name        = $this->_linkitem_define->get_cache_by_itemid_key($id, 'name');
		$title_def   = $this->_linkitem_define->get_cache_by_itemid_key($id, 'title');
		$user_form   = $this->_linkitem_define->get_cache_by_itemid_key($id, 'user_form');
		$admin_form  = $this->_linkitem_define->get_cache_by_itemid_key($id, 'admin_form');
		$conf_form   = $this->_linkitem_define->get_cache_by_itemid_key($id, 'conf_form');
		$save_mode   = $this->_linkitem_define->get_cache_by_itemid_key($id, 'save_mode');
		$search_mode = $this->_linkitem_define->get_cache_by_itemid_key($id, 'search_mode');
		$data_type   = $this->_linkitem_define->get_cache_by_itemid_key($id, 'data_type');
		$opt         = $this->_linkitem_define->get_cache_by_itemid_key($id, 'options');
		$title       = $this->_linkitem_handler->get_cache_by_itemid_key($id, 'title');
		$user_mode   = $this->_linkitem_handler->get_cache_by_itemid_key($id, 'user_mode');
		$desc        = $this->_linkitem_handler->get_cache_by_itemid_key($id, 'description');

		$arr = array(
			'item_id'     => $id,
			'name'        => $name,
			'title'       => htmlspecialchars($title, ENT_QUOTES),
	 		'user_mode'   => $user_mode,
			'title_def'   => $title_def,
			'description' => $desc,
	 		'user_form'   => $user_form,
	 		'admin_form'  => $admin_form,
	 		'conf_form'   => $conf_form,
	 		'user_mode'   => $user_mode,
	 		'save_mode'   => $save_mode,
	 		'search_mode' => $search_mode,
	 		'data_type'   => $data_type,
	 		'options'     => $opt,
		);

		$this->_cached_by_itemid[ $id ] = $arr;
		$this->_cached_by_name[ $name ] = $arr;
	}

	return $this->_cached_by_itemid;

}

//---------------------------------------------------------
// get cache
//---------------------------------------------------------
function &get_cached_by_itemid()
{
	return $this->_cached_by_itemid;
}

function &get_cached_by_name()
{
	return $this->_cached_by_name;
}

function get_by_itemid($id, $key)
{
	if ( isset( $this->_cached_by_itemid[$id][$key] ) )
	{
		$val = $this->_cached_by_itemid[$id][$key];
		return $val;
	}

	return false;
}

function get_by_name($name, $key)
{
	if ( isset( $this->_cached_by_name[$name][$key] ) )
	{
		$val = $this->_cached_by_name[$name][$key];
		return $val;
	}

	return false;
}

function build_caption_by_itemid($id, $flag=0, $extra='')
{
	$mode      = $this->get_by_itemid($id, 'user_mode');
	$title     = $this->get_by_itemid($id, 'title');
	$title_def = $this->get_by_itemid($id, 'title_def');
	$desc      = $this->get_by_itemid($id, 'description');
	$cap       = $this->build_caption($title, $desc, $title_def, $mode, $flag, $extra);
	return $cap;
}

function build_caption($title, $desc='', $title_def='', $mode=0, $flag=0, $extra='')
{
	if ($mode == 2)
	{
		$cap = "<span style='font-weight:bold;'> * $title * </span>";
	}
	else
	{
		$cap = "<span style='font-weight:normal;'>".$title."</span>";
	}

	if ( $flag &&( $title != $title_def ) )
	{
		$cap .= "<br />\n";
		$cap .= "<span style='font-weight:normal;'> ( ".$title_def." ) </span>";
	}

	if ( $extra )
	{
		$cap .= "<br />\n";
		$cap .= "<span style='font-weight:normal;'>".$extra."</span>";
	}

	if ($desc)
	{
		$cap .= "<br /><br />\n";
		$cap .= "<span style='font-weight:normal;'>".$desc."</span>";
	}

	return $cap;
}

function &get_save_mode_list()
{
	$list = array();

	foreach ($this->_cached_by_name as $name => $item)
	{
		$flag = false;

		if ( ($item['save_mode'] == 1) && ( ($item['user_mode'] > 0)||$this->_is_module_admin) )
		{
			$flag = true;
		}
		elseif ( ($item['save_mode'] == 2) && $this->_is_module_admin )
		{
			$flag = true;
		}

		$list[$name] = $flag;
	}

	$list['nameflag'] = $list['name'];
	$list['mailflag'] = $list['mail'];
	$list['width']    = $list['banner'];
	$list['height']   = $list['banner'];

	return $list;
}

function &get_search_list()
{
	$list = array();
	foreach ($this->_cached_by_name as $name => $item)
	{
		if ( $item['search_mode'] )
		{
			$list[$name] = true;
		}
	}
	return $list;
}

// --- class end ---
}

// === class end ===
}

?>