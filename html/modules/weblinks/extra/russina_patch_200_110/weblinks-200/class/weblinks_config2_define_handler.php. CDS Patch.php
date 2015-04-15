<?php
// $Id: weblinks_config2_define_handler.php.\040CDS\040Patch.php,v 1.1 2012/04/09 10:21:09 ohwada Exp $

// 2008-02-17 K.OHWADA
// kml_use
// use_pagerank
// lang_main
// htmlout, rssout, kml_out

// 2008-02-12 K.OHWADA
// remove gm_map_type
// change header_mode

// 2008-01-10
// Notice [PHP]: Only variables should be assigned by reference

// 2007-11-11 K.OHWADA
// get_config_country_code()
// gm_marker_width
// user_nameflag

// 2007-09-10 K.OHWADA
// use_hits_singlelink etc

// 2007-08-01 K.OHWADA
// admin can add etc column
// map_jp

// 2007-07-14 K.OHWADA
// use_highlight

// 2007-06-10 K.OHWADA
// d3forum

// 2007-04-08 K.OHWADA
// cat_show_forum

// 2007-03-25 K.OHWADA
// index page
// category & link album

// 2007-02-20 K.OHWADA
// hack for multi site
// renew config table
// weblinks_plugin
// cat_path, etc

// 2006-10-05 K.OHWADA
// use happy_linux rssc
// move weblinks_config2_define_handler
// add rss_dirname, bin_pass
// google map
// country code

// 2006-09-24 K.OHWADA
// BUG 4278: cannot set no link list on the top page

// 2006-05-15 K.OHWADA
// this is new file
// use new handler

//================================================================
// WebLinks Module
// porting form RSSC 
// 2006-05-15 K.OHWADA
//================================================================

define('WEBLINKS_CAT_PATH_STYLE_1', 'style 1 <br />cat1 <br />cat1 : cat2 <br />cat1 : cat2 : cat3');
define('WEBLINKS_CAT_PATH_STYLE_2', 'style 2 <br />cat1 <br />-- cat2 <br />---- cat3');

// === class begin ===
if( !class_exists('weblinks_config2_define_handler') ) 
{

//=========================================================
// class weblinks_config2_define
//=========================================================
class weblinks_config2_define extends happy_linux_config_define_base
{
// class instance
	var $_locate;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_config2_define( $dirname )
{
	$this->happy_linux_config_define_base();

// class instance
	$this->_locate =& weblinks_locate_factory::getInstance( $dirname );

}

public static function &getInstance( $dirname )
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new weblinks_config2_define( $dirname );
	}
	return $instance;
}

//---------------------------------------------------------
// function
// same as xoops_version.php
//---------------------------------------------------------
// Notice [PHP]: Only variables should be assigned by reference
function &get_define()
{
	$SUBMIT_DEFAULT = array(XOOPS_GROUP_ADMIN, XOOPS_GROUP_USERS, XOOPS_GROUP_ANONYMOUS);

	global $xoopsConfig;
	$adminmail = $xoopsConfig['adminmail'];

	$this->_locate->set_config_country_code( $this->get_config_country_code() );
	$default =& $this->_locate->weblinks_get_value( 'default' );
	$cc      =& $this->_locate->weblinks_get_value( 'config' );

//---------------------------------------------------------
// auth
//---------------------------------------------------------
	$config[1]['name']        = 'auth_submit';
	$config[1]['catid']       = '1';
	$config[1]['title']       = '_WEBLINKS_AUTH_SUBMIT';
	$config[1]['description'] = '_WEBLINKS_AUTH_SUBMIT_DSC';
	$config[1]['formtype']    = 'select_multi';
	$config[1]['valuetype']   = 'array';
	$config[1]['default']     = XOOPS_GROUP_ADMIN;

	$config[2]['name']        = 'auth_submit_auto';
	$config[2]['catid']       = 1;
	$config[2]['title']       = '_WEBLINKS_AUTH_SUBMIT_AUTO';
	$config[2]['description'] = '_WEBLINKS_AUTH_SUBMIT_AUTO_DSC';
	$config[2]['formtype']    = 'select_multi';
	$config[2]['valuetype']   = 'array';
	$config[2]['default']     = XOOPS_GROUP_ADMIN;

	$config[3]['name']        = 'auth_modify';
	$config[3]['catid']       = 1;
	$config[3]['title']       = '_WEBLINKS_AUTH_MODIFY';
	$config[3]['description'] = '_WEBLINKS_AUTH_MODIFY_DSC';
	$config[3]['formtype']    = 'select_multi';
	$config[3]['valuetype']   = 'array';
	$config[3]['default']     = XOOPS_GROUP_ADMIN;

	$config[4]['name']        = 'auth_modify_auto';
	$config[4]['catid']       = 1;
	$config[4]['title']       = '_WEBLINKS_AUTH_MODIFY_AUTO';
	$config[4]['description'] = '_WEBLINKS_AUTH_MODIFY_AUTO_DSC';
	$config[4]['formtype']    = 'select_multi';
	$config[4]['valuetype']   = 'array';
	$config[4]['default']     = XOOPS_GROUP_ADMIN;

	$config[5]['name']        = 'auth_ratelink';
	$config[5]['catid']       = 1;
	$config[5]['title']       = '_WEBLINKS_AUTH_RATELINK';
	$config[5]['description'] = '_WEBLINKS_AUTH_RATELINK_DSC';
	$config[5]['formtype']    = 'select_multi';
	$config[5]['valuetype']   = 'array';
	$config[5]['default']     = XOOPS_GROUP_ADMIN;

	$config[7]['name']        = 'system_post_rate';
	$config[7]['catid']       = '1';
	$config[7]['title']       = '_AM_WEBLINKS_SYSTEM_POST_RATE';
	$config[7]['description'] = '_AM_WEBLINKS_SYSTEM_POST_RATE_DSC';
	$config[7]['formtype']    = 'yesno';
	$config[7]['valuetype']   = 'int';
	$config[7]['default']     = 0;

	$config[8]['name']        = 'system_post_link';
	$config[8]['catid']       = '1';
	$config[8]['title']       = '_AM_WEBLINKS_SYSTEM_POST_LINK';
	$config[8]['description'] = '_AM_WEBLINKS_SYSTEM_POST_LINK_DSC';
	$config[8]['formtype']    = 'yesno';
	$config[8]['valuetype']   = 'int';
	$config[8]['default']     = 0;

	$config[9]['name']        = 'use_brokenlink';
	$config[9]['catid']       = 1;
	$config[9]['title']       = '_AM_WEBLINKS_USE_BROKENLINK';
	$config[9]['description'] = '_AM_WEBLINKS_USE_BROKENLINK_DSC';
	$config[9]['formtype']    = 'yesno';
	$config[9]['valuetype']   = 'int';
	$config[9]['default']     = 1;

	$config[13]['name']        = 'auth_delete';
	$config[13]['catid']       = 1;
	$config[13]['title']       = '_AM_WEBLINKS_AUTH_DELETE';
	$config[13]['description'] = '_AM_WEBLINKS_AUTH_DELETE_DSC';
	$config[13]['formtype']    = 'select_multi';
	$config[13]['valuetype']   = 'array';
	$config[13]['default']     = XOOPS_GROUP_ADMIN;

	$config[14]['name']        = 'auth_delete_auto';
	$config[14]['catid']       = 1;
	$config[14]['title']       = '_AM_WEBLINKS_AUTH_DELETE_AUTO';
	$config[14]['description'] = '_AM_WEBLINKS_AUTH_DELETE_AUTO_DSC';
	$config[14]['formtype']    = 'select_multi';
	$config[14]['valuetype']   = 'array';
	$config[14]['default']     = XOOPS_GROUP_ADMIN;

//---------------------------------------------------------
// category
//---------------------------------------------------------
	$config[21]['name']        = 'cat_sel';
	$config[21]['catid']       = '2';
	$config[21]['title']       = '_WEBLINKS_CAT_SEL';
	$config[21]['description'] = '_WEBLINKS_CAT_SEL_DSC';
	$config[21]['formtype']    = 'text';
	$config[21]['valuetype']   = 'int';
	$config[21]['default']     = 4;

	$config[28]['name']        = 'cat_path_style';
	$config[28]['catid']       = '2';
	$config[28]['title']       = '_AM_WEBLINKS_CAT_PATH_STYLE';
	$config[28]['formtype']    = 'radio_nl_non';
	$config[28]['valuetype']   = 'int';
	$config[28]['default']     = 1;
	$config[28]['options']     = array(
		WEBLINKS_CAT_PATH_STYLE_1 => 1,
		WEBLINKS_CAT_PATH_STYLE_2 => 2,
	);

	$config[24]['name']        = 'cat_img_width';
	$config[24]['catid']       = '2';
	$config[24]['title']       = '_WEBLINKS_CAT_IMG_WIDTH';
	$config[24]['description'] = '_WEBLINKS_CAT_IMG_SIZE_DSC';
	$config[24]['formtype']    = 'text';
	$config[24]['valuetype']   = 'int';
	$config[24]['default']     = 150;

	$config[25]['name']        = 'cat_img_height';
	$config[25]['catid']       = '2';
	$config[25]['title']       = '_WEBLINKS_CAT_IMG_HEIGHT';
	$config[25]['description'] = '_WEBLINKS_CAT_IMG_SIZE_DSC';
	$config[25]['formtype']    = 'text';
	$config[25]['valuetype']   = 'int';
	$config[25]['default']     = 100;

//---------------------------------------------------------
// category page
//---------------------------------------------------------
	$config[265]['name']        = 'cat_cols';
	$config[265]['catid']       = '26';
	$config[265]['title']       = '_AM_WEBLINKS_CAT_COLS';
	$config[265]['description'] = '_AM_WEBLINKS_CAT_COLS_DESC';
	$config[265]['formtype']    = 'text';
	$config[265]['valuetype']   = 'int';
	$config[265]['default']     = 3;

	$config[266]['name']        = 'cat_sub_mode';
	$config[266]['catid']       = '26';
	$config[266]['title']       = '_AM_WEBLINKS_CAT_SUB_MODE';
	$config[266]['formtype']    = 'radio';
	$config[266]['valuetype']   = 'int';
	$config[266]['default']     = 1;
	$config[266]['options']     = array(
		_AM_WEBLINKS_MODE_NON       => 0,
		_AM_WEBLINKS_CAT_SUB_MODE_1 => 1,
		_AM_WEBLINKS_CAT_SUB_MODE_2 => 2,
	);

	$config[22]['name']        = 'cat_sub';
	$config[22]['catid']       = '26';
	$config[22]['title']       = '_WEBLINKS_CAT_SUB';
	$config[22]['description'] = '_WEBLINKS_CAT_SUB_DSC';
	$config[22]['formtype']    = 'text';
	$config[22]['valuetype']   = 'int';
	$config[22]['default']     = 5;

	$config[23]['name']        = 'cat_img_mode';
	$config[23]['catid']       = '26';
	$config[23]['title']       = '_WEBLINKS_CAT_IMG_MODE';
	$config[23]['description'] = '_WEBLINKS_CAT_IMG_MODE_DSC';
	$config[23]['formtype']    = 'radio_nl';
	$config[23]['valuetype']   = 'int';
	$config[23]['default']     = 1;
	$config[23]['options']     = array(
		_AM_WEBLINKS_MODE_NON    => 0,
		_WEBLINKS_CAT_IMG_MODE_1 => 1,
		_WEBLINKS_CAT_IMG_MODE_2 => 2,
		_AM_WEBLINKS_MODE_OMIT_PARENT => 3,
	);

	$config[261]['name']        = 'cat_desc_mode';
	$config[261]['catid']       = 26;
	$config[261]['title']       = '_AM_WEBLINKS_CAT_DESC_MODE';
	$config[261]['formtype']    = 'radio';
	$config[261]['valuetype']   = 'int';
	$config[261]['default']     = 1;
	$config[261]['options']     = array(
		_AM_WEBLINKS_MODE_NON     => 0,
		_AM_WEBLINKS_MODE_SETTING => 1,
		_AM_WEBLINKS_MODE_OMIT_PARENT  => 2,
	);

// move to google map
//	$config[29]['name']        = 'cat_show_gm';

	$config[262]['name']        = 'cat_show_forum';
	$config[262]['catid']       = 26;
	$config[262]['title']       = '_AM_WEBLINKS_CAT_SHOW_FORUM';
	$config[262]['formtype']    = 'yesno';
	$config[262]['valuetype']   = 'int';
	$config[262]['default']     = 1;

	$config[263]['name']        = 'cat_show_album';
	$config[263]['catid']       = 26;
	$config[263]['title']       = '_AM_WEBLINKS_CAT_SHOW_ALBUM';
	$config[263]['formtype']    = 'yesno';
	$config[263]['valuetype']   = 'int';
	$config[263]['default']     = 1;


//---------------------------------------------------------
// view
//---------------------------------------------------------
	$config[31]['name']        = 'logoshow';
	$config[31]['catid']       = '3';
	$config[31]['title']       = '_MI_WEBLINKS_LOGOSHOW';
	$config[31]['description'] = '_MI_WEBLINKS_LOGOSHOWDSC';
	$config[31]['formtype']    = 'yesno';
	$config[31]['valuetype']   = 'int';
	$config[31]['default']     = 1;

	$config[32]['name']        = 'titleshow';
	$config[32]['catid']       = '3';
	$config[32]['title']       = '_MI_WEBLINKS_TITLESHOW';
	$config[32]['description'] = '_MI_WEBLINKS_TITLESHOWDSC';
	$config[32]['formtype']    = 'yesno';
	$config[32]['valuetype']   = 'int';
	$config[32]['default']     = 1;

	$config[33]['name']        = 'frame';
	$config[33]['catid']       = '3';
	$config[33]['title']       = '_MI_WEBLINKS_USEFRAMES';
	$config[33]['description'] = '_MI_WEBLINKS_USEFRAMEDSC';
	$config[33]['formtype']    = 'yesno';
	$config[33]['valuetype']   = 'int';
	$config[33]['default']     = 0;

// change to index_description
//	$config[34]['name']        = 'index_desc';

	$config[35]['name']        = 'view_style_cat';
	$config[35]['catid']       = '3';
	$config[35]['title']       = '_AM_WEBLINKS_VIEW_STYLE_CAT';
//	$config[35]['description'] = '_AM_WEBLINKS_VIEW_STYLE_CAT_DSC';
	$config[35]['formtype']    = 'radio';
	$config[35]['valuetype']   = 'int';
	$config[35]['default']     = 1;
	$config[35]['options']     = array(
		_AM_WEBLINKS_VIEW_STYLE_0 => 0,
		_AM_WEBLINKS_VIEW_STYLE_1 => 1
	);

	$config[36]['name']        = 'view_style_mark';
	$config[36]['catid']       = '3';
	$config[36]['title']       = '_AM_WEBLINKS_VIEW_STYLE_MARK';
	$config[36]['description'] = '_AM_WEBLINKS_VIEW_STYLE_MARK_DSC';
	$config[36]['formtype']    = 'radio';
	$config[36]['valuetype']   = 'int';
	$config[36]['default']     = 1;
	$config[36]['options']     = array(
		_AM_WEBLINKS_VIEW_STYLE_0 => 0,
		_AM_WEBLINKS_VIEW_STYLE_1 => 1
	);

//---------------------------------------------------------
// top ten
//---------------------------------------------------------
// BUG 211: timeout occurs in popular site if many top categories
	$config[41]['name']        = 'topten_style';
	$config[41]['catid']       = '4';
	$config[41]['title']       = '_MI_WEBLINKS_TOPTEN_STYLE';
	$config[41]['description'] = '_MI_WEBLINKS_TOPTEN_STYLE_DSC';
	$config[41]['formtype']    = 'radio_nl';
	$config[41]['valuetype']   = 'int';
	$config[41]['default']     = 0;
	$config[41]['options']     = array(
		_MI_WEBLINKS_TOPTEN_STYLE_0 => 0,
		_MI_WEBLINKS_TOPTEN_STYLE_1 => 1
	);

	$config[42]['name']        = 'topten_links';
	$config[42]['catid']       = '4';
	$config[42]['title']       = '_MI_WEBLINKS_TOPTEN_LINKS';
	$config[42]['description'] = '_MI_WEBLINKS_TOPTEN_LINKS_DSC';
	$config[42]['formtype']    = 'textbox';
	$config[42]['valuetype']   = 'int';
	$config[42]['default']     = 10;

	$config[43]['name']        = 'topten_cats';
	$config[43]['catid']       = '4';
	$config[43]['title']       = '_MI_WEBLINKS_TOPTEN_CATS';
	$config[43]['description'] = '_MI_WEBLINKS_TOPTEN_CATS_DSC';
	$config[43]['formtype']    = 'textbox';
	$config[43]['valuetype']   = 'int';
	$config[43]['default']     = 20;

//---------------------------------------------------------
// search
//---------------------------------------------------------
	$config[51]['name']        = 'search_links';
	$config[51]['catid']       = '5';
	$config[51]['title']       = '_MI_WEBLINKS_SEARCH_LINKS';
	$config[51]['description'] = '_MI_WEBLINKS_SEARCH_LINKSDSC';
	$config[51]['formtype']    = 'select';
	$config[51]['valuetype']   = 'int';
	$config[51]['default']     = 20;
	$config[51]['options']     = array(
		'5' => 5, '10' => 10, '15' => 15, '20' => 20, 
		'25' => 25, '1' => 1, '50' => 50
	);

	$config[52]['name']        = 'search_min';
	$config[52]['catid']       = '5';
	$config[52]['title']       = '_MI_WEBLINKS_SEARCH_MIN';
	$config[52]['description'] = '_MI_WEBLINKS_SEARCH_MINDSC';
	$config[52]['formtype']    = 'textbox';
	$config[52]['valuetype']   = 'int';
	$config[52]['default']     = 5;

//---------------------------------------------------------
// performance
//---------------------------------------------------------
	$config[61]['name']        = 'cat_path';
	$config[61]['catid']       = 6;
	$config[61]['title']       = '_AM_WEBLINKS_CAT_PATH';
	$config[61]['description'] = '_AM_WEBLINKS_CAT_PATH_DSC';
	$config[61]['formtype']    = 'yesno';
	$config[61]['valuetype']   = 'int';
	$config[61]['default']     = 0;

	$config[62]['name']        = 'cat_count';
	$config[62]['catid']       = 6;
	$config[62]['title']       = '_AM_WEBLINKS_CAT_COUNT';
	$config[62]['description'] = '_AM_WEBLINKS_CAT_COUNT_DSC';
	$config[62]['formtype']    = 'yesno';
	$config[62]['valuetype']   = 'int';
	$config[62]['default']     = 0;

//---------------------------------------------------------
// bin check
//---------------------------------------------------------
	$config[71]['name']      = 'bin_pass';
	$config[71]['catid']     = 7;
	$config[71]['title']       = '_HAPPY_LINUX_CONF_BIN_PASS';
	$config[71]['formtype']  = 'text';
	$config[71]['valuetype'] = 'text';
	$config[71]['default']   = xoops_makepass();

	$config[72]['name']      = 'bin_send';
	$config[72]['catid']     = 7;
	$config[72]['title']       = '_HAPPY_LINUX_CONF_BIN_SEND';
	$config[72]['formtype']  = 'yesno';
	$config[72]['valuetype'] = 'int';
	$config[72]['default']   = 1;

	$config[73]['name']      = 'bin_mailto';
	$config[73]['catid']     = 7;
	$config[73]['title']       = '_HAPPY_LINUX_CONF_BIN_MAILTO';
	$config[73]['formtype']  = 'text';
	$config[73]['valuetype'] = 'text';
	$config[73]['default']   = $adminmail;

//---------------------------------------------------------
// user submit form: description
//---------------------------------------------------------
	$config[81]['name']        = 'auth_dohtml';
	$config[81]['catid']       = 8;
	$config[81]['title']       = '_AM_WEBLINKS_AUTH_DOHTML';
	$config[81]['description'] = '_AM_WEBLINKS_AUTH_DOHTML_DSC';
	$config[81]['formtype']    = 'select_multi';
	$config[81]['valuetype']   = 'array';
	$config[81]['default']     = XOOPS_GROUP_ADMIN;

	$config[82]['name']        = 'auth_dosmiley';
	$config[82]['catid']       = 8;
	$config[82]['title']       = '_AM_WEBLINKS_AUTH_DOSMILEY';
	$config[82]['description'] = '_AM_WEBLINKS_AUTH_DOSMILEY_DSC';
	$config[82]['formtype']    = 'select_multi';
	$config[82]['valuetype']   = 'array';
	$config[82]['default']     = $SUBMIT_DEFAULT;

	$config[83]['name']        = 'auth_doxcode';
	$config[83]['catid']       = 8;
	$config[83]['title']       = '_AM_WEBLINKS_AUTH_DOXCODE';
	$config[83]['description'] = '_AM_WEBLINKS_AUTH_DOXCODE_DSC';
	$config[83]['formtype']    = 'select_multi';
	$config[83]['valuetype']   = 'array';
	$config[83]['default']     = $SUBMIT_DEFAULT;

	$config[84]['name']        = 'auth_doimage';
	$config[84]['catid']       = 8;
	$config[84]['title']       = '_AM_WEBLINKS_AUTH_DOIMAGE';
	$config[84]['description'] = '_AM_WEBLINKS_AUTH_DOIMAGE_DSC';
	$config[84]['formtype']    = 'select_multi';
	$config[84]['valuetype']   = 'array';
	$config[84]['default']     = $SUBMIT_DEFAULT;

	$config[85]['name']        = 'auth_dobr';
	$config[85]['catid']       = 8;
	$config[85]['title']       = '_AM_WEBLINKS_AUTH_DOBR';
	$config[85]['description'] = '_AM_WEBLINKS_AUTH_DOBR_DSC';
	$config[85]['formtype']    = 'select_multi';
	$config[85]['valuetype']   = 'array';
	$config[85]['default']     = $SUBMIT_DEFAULT;

	$config[86]['name']        = 'type_desc';
	$config[86]['catid']       = 8;
	$config[86]['title']       = '_WEBLINKS_TYPE_DESC';
	$config[86]['description'] = '_WEBLINKS_TYPE_DESC_DSC';
	$config[86]['formtype']    = 'yesno';
	$config[86]['valuetype']   = 'int';
	$config[86]['default']     = 1;

	$config[87]['name']        = 'desc_length';
	$config[87]['catid']       = 8;
	$config[87]['title']       = '_AM_WEBLINKS_DESC_LENGTH';
	$config[87]['description'] = '_AM_WEBLINKS_DESC_LENGTH_DSC';
	$config[87]['formtype']    = 'text';
	$config[87]['valuetype']   = 'int';
	$config[87]['default']     = -1;

//---------------------------------------------------------
// user submit form: textarea1
//---------------------------------------------------------
	$config[91]['name']        = 'auth_dohtml_1';
	$config[91]['catid']       = 9;
	$config[91]['title']       = '_AM_WEBLINKS_AUTH_DOHTML';
	$config[91]['description'] = '_AM_WEBLINKS_AUTH_DOHTML_DSC';
	$config[91]['formtype']    = 'select_multi';
	$config[91]['valuetype']   = 'array';
	$config[91]['default']     = XOOPS_GROUP_ADMIN;

	$config[92]['name']        = 'auth_dosmiley_1';
	$config[92]['catid']       = 9;
	$config[92]['title']       = '_AM_WEBLINKS_AUTH_DOSMILEY';
	$config[92]['description'] = '_AM_WEBLINKS_AUTH_DOSMILEY_DSC';
	$config[92]['formtype']    = 'select_multi';
	$config[92]['valuetype']   = 'array';
	$config[92]['default']     = $SUBMIT_DEFAULT;

	$config[93]['name']        = 'auth_doxcode_1';
	$config[93]['catid']       = 9;
	$config[93]['title']       = '_AM_WEBLINKS_AUTH_DOXCODE';
	$config[93]['description'] = '_AM_WEBLINKS_AUTH_DOXCODE_DSC';
	$config[93]['formtype']    = 'select_multi';
	$config[93]['valuetype']   = 'array';
	$config[93]['default']     = $SUBMIT_DEFAULT;

	$config[94]['name']        = 'auth_doimage_1';
	$config[94]['catid']       = 9;
	$config[94]['title']       = '_AM_WEBLINKS_AUTH_DOIMAGE';
	$config[94]['description'] = '_AM_WEBLINKS_AUTH_DOIMAGE_DSC';
	$config[94]['formtype']    = 'select_multi';
	$config[94]['valuetype']   = 'array';
	$config[94]['default']     = $SUBMIT_DEFAULT;

	$config[95]['name']        = 'auth_dobr_1';
	$config[95]['catid']       = 9;
	$config[95]['title']       = '_AM_WEBLINKS_AUTH_DOBR';
	$config[95]['description'] = '_AM_WEBLINKS_AUTH_DOBR_DSC';
	$config[95]['formtype']    = 'select_multi';
	$config[95]['valuetype']   = 'array';
	$config[95]['default']     = $SUBMIT_DEFAULT;

	$config[96]['name']        = 'type_desc_1';
	$config[96]['catid']       = 9;
	$config[96]['title']       = '_WEBLINKS_TYPE_DESC';
	$config[96]['description'] = '_WEBLINKS_TYPE_DESC_DSC';
	$config[96]['formtype']    = 'yesno';
	$config[96]['valuetype']   = 'int';
	$config[96]['default']     = 1;

	$config[97]['name']        = 'desc_length_1';
	$config[97]['catid']       = 8;
	$config[97]['title']       = '_AM_WEBLINKS_DESC_LENGTH';
	$config[97]['description'] = '_AM_WEBLINKS_DESC_LENGTH_DSC';
	$config[97]['formtype']    = 'text';
	$config[97]['valuetype']   = 'int';
	$config[97]['default']     = -1;

//---------------------------------------------------------
// guest submit form
//---------------------------------------------------------
	$config[101]['name']        = 'use_passwd';
	$config[101]['catid']       = 10;
	$config[101]['title']       = '_AM_WEBLINKS_USE_PASSWD';
	$config[101]['description'] = '_AM_WEBLINKS_USE_PASSWD_DSC';
	$config[101]['formtype']    = 'yesno';
	$config[101]['valuetype']   = 'int';
	$config[101]['default']     = 0;

	$config[102]['name']        = 'passwd_min';
	$config[102]['catid']       = '10';
	$config[102]['title']       = '_AM_WEBLINKS_PASSWD_MIN';
	$config[102]['description'] = '';
	$config[102]['formtype']    = 'text';
	$config[102]['valuetype']   = 'int';
	$config[102]['default']     = 5;

	$config[103]['name']        = 'use_captcha';
	$config[103]['catid']       = 10;
	$config[103]['title']       = '_AM_WEBLINKS_USE_CAPTCHA';
	$config[103]['description'] = '_AM_WEBLINKS_USE_CAPTCHA_DSC';
	$config[103]['formtype']    = 'yesno';
	$config[103]['valuetype']   = 'int';
	$config[103]['default']     = 0;

//---------------------------------------------------------
// user submit form
//---------------------------------------------------------
	$desc_1  = "<ul>\n";
	$desc_1 .= "<li>"._WLS_SUBMIT_INDISPENSABLE."</li>\n";
	$desc_1 .= "<li>"._WLS_DONTABUSE."</li>\n";
	$desc_1 .= "<li>"._WLS_TAKESHOT."</li>\n";
	$desc_1 .= "</ul>\n";

	$desc_2  = "<ul>\n";
	$desc_2 .= "<li>"._WLS_ALLPENDING."</li>\n";
	$desc_2 .= "</ul>\n";

	$desc_3  = "<ul>\n";
	$desc_3 .= "<li>"._WLS_SUBMITONCE."</li>\n";
	$desc_3 .= "</ul>\n";

	$desc_4  = "";

	$desc_5  = "<ul>\n";
	$desc_5 .= "<li>"._WLS_MODIFY_PENDING."</li>\n";
	$desc_5 .= "</ul>\n";

	$desc_6  = "<ul>\n";
	$desc_6 .= "<li>"._WLS_MODIFY_NOT_OWNER."</li>\n";
	$desc_6 .= "</ul>\n";

	$config[111]['name']        = 'submit_main';
	$config[111]['catid']       = '11';
	$config[111]['title']       = '_AM_WEBLINKS_SUBMIT_MAIN';
	$config[111]['description'] = '_AM_WEBLINKS_SUBMIT_MAIN_DSC';
	$config[111]['formtype']    = 'textarea';
	$config[111]['valuetype']   = 'textarea';
	$config[111]['default']     = $desc_1;

	$config[112]['name']        = 'submit_pending';
	$config[112]['catid']       = '11';
	$config[112]['title']       = '_AM_WEBLINKS_SUBMIT_PENDING';
	$config[112]['description'] = '_AM_WEBLINKS_SUBMIT_PENDING_DSC';
	$config[112]['formtype']    = 'textarea';
	$config[112]['valuetype']   = 'textarea';
	$config[112]['default']     = $desc_2;

	$config[113]['name']        = 'submit_double';
	$config[113]['catid']       = '11';
	$config[113]['title']       = '_AM_WEBLINKS_SUBMIT_DOUBLE';
	$config[113]['description'] = '_AM_WEBLINKS_SUBMIT_DOUBLE_DSC';
	$config[113]['formtype']    = 'textarea';
	$config[113]['valuetype']   = 'textarea';
	$config[113]['default']     = $desc_3;

	$config[114]['name']        = 'modlink_main';
	$config[114]['catid']       = '11';
	$config[114]['title']       = '_AM_WEBLINKS_MODLINK_MAIN';
	$config[114]['description'] = '_AM_WEBLINKS_SUBMIT_MAIN_DSC';
	$config[114]['formtype']    = 'textarea';
	$config[114]['valuetype']   = 'textarea';
	$config[114]['default']     = $desc_4;

	$config[115]['name']        = 'modlink_pending';
	$config[115]['catid']       = '11';
	$config[115]['title']       = '_AM_WEBLINKS_MODLINK_PENDING';
	$config[115]['description'] = '_AM_WEBLINKS_SUBMIT_PENDING_DSC';
	$config[115]['formtype']    = 'textarea';
	$config[115]['valuetype']   = 'textarea';
	$config[115]['default']     = $desc_5;

	$config[116]['name']        = 'modlink_not_owner';
	$config[116]['catid']       = '11';
	$config[116]['title']       = '_AM_WEBLINKS_MODLINK_NOT_OWNER';
	$config[116]['description'] = '_AM_WEBLINKS_MODLINK_NOT_OWNER_DSC';
	$config[116]['formtype']    = 'textarea';
	$config[116]['valuetype']   = 'textarea';
	$config[116]['default']     = $desc_6;

//---------------------------------------------------------
// link
//---------------------------------------------------------
	$config[121]['name']        = 'check_double';
	$config[121]['catid']       = 12;
	$config[121]['title']       = '_WEBLINKS_CHECK_DOUBLE';
	$config[121]['description'] = '_WEBLINKS_CHECK_DOUBLE_DSC';
	$config[121]['formtype']    = 'yesno';
	$config[121]['valuetype']   = 'int';
	$config[121]['default']     = 1;

	$config[133]['name']        = 'check_mail';
	$config[133]['catid']       = 12;
	$config[133]['title']       = '_AM_WEBLINKS_CHECK_MAIL';
	$config[133]['description'] = '_AM_WEBLINKS_CHECK_MAIL_DSC';
	$config[133]['formtype']    = 'yesno';
	$config[133]['valuetype']   = 'int';
	$config[133]['default']     = 1;

	$config[122]['name']        = 'popular';
	$config[122]['catid']       = '12';
	$config[122]['title']       = '_MI_WEBLINKS_POPULAR';
	$config[122]['description'] = '_MI_WEBLINKS_POPULARDSC';
	$config[122]['formtype']    = 'textbox';
	$config[122]['valuetype']   = 'int';
	$config[122]['default']     = 100;

	$config[123]['name']        = 'newdays';
	$config[123]['catid']       = '12';
	$config[123]['title']       = '_MI_WEBLINKS_NEWDAYS';
	$config[123]['description'] = '_MI_WEBLINKS_NEWDAYS_DSC';
	$config[123]['formtype']    = 'textbox';
	$config[123]['valuetype']   = 'int';
	$config[123]['default']     = 7;

//	change to index_new_link
//	$config[124]['name']        = 'newlinks';

	$config[125]['name']        = 'perpage';
	$config[125]['catid']       = '12';
	$config[125]['title']       = '_MI_WEBLINKS_PERPAGE';
	$config[125]['description'] = '_MI_WEBLINKS_PERPAGEDSC';
	$config[125]['formtype']    = 'select';
	$config[125]['valuetype']   = 'int';
	$config[125]['default']     = 10;
	$config[125]['options']     = array(
		'5'  => 5,  '10' => 10, '15' => 15, '20'  => 20, 
		'25' => 25, '50' => 50, '75' => 75, '100' => 100,
	);

	$config[126]['name']        = 'descshort';
	$config[126]['catid']       = '12';
	$config[126]['title']       = '_MI_WEBLINKS_DESCSHORT';
	$config[126]['description'] = '_MI_WEBLINKS_DESCSHORTDSC';
	$config[126]['formtype']    = 'textbox';
	$config[126]['valuetype']   = 'int';
	$config[126]['default']     = 100;

	$config[127]['name']        = 'orderby';
	$config[127]['catid']       = '12';
	$config[127]['title']       = '_MI_WEBLINKS_ORDERBY';
	$config[127]['description'] = '_MI_WEBLINKS_ORDERBYDSC';
	$config[127]['formtype']    = 'select';
	$config[127]['valuetype']   = 'int';
	$config[127]['default']     = 0;
	$config[127]['options']     = array(
		_MI_WEBLINKS_ORDERBY0 => 0,
		_MI_WEBLINKS_ORDERBY1 => 1,
		_MI_WEBLINKS_ORDERBY2 => 2,
		_MI_WEBLINKS_ORDERBY3 => 3,
		_MI_WEBLINKS_ORDERBY4 => 4,
		_MI_WEBLINKS_ORDERBY5 => 5,
		_MI_WEBLINKS_ORDERBY6 => 6,
/* CDS Patch. Weblinks. 2.00. 10. BOF */
		_MI_WEBLINKS_ORDERBY7 => 7,
		_MI_WEBLINKS_ORDERBY8 => 8,
		_MI_WEBLINKS_ORDERBY9 => 9
/* CDS Patch. Weblinks. 2.00. 10. EOF */
	);

	$config[128]['name']        = 'broken_threshold';
	$config[128]['catid']       = '12';
	$config[128]['title']       = '_MI_WEBLINKS_BROKEN';
	$config[128]['description'] = '_MI_WEBLINKS_BROKENDSC';
	$config[128]['formtype']    = 'textbox';
	$config[128]['valuetype']   = 'int';
	$config[128]['default']     = WEBLINKS_LINK_BROKEN_DEFAULT;

	$config[129]['name']        = 'view_url';
	$config[129]['catid']       = '12';
	$config[129]['title']       = '_AM_WEBLINKS_VIEW_URL';
	$config[129]['description'] = '_AM_WEBLINKS_VIEW_URL_DSC';
	$config[129]['formtype']    = 'radio';
	$config[129]['valuetype']   = 'int';
	$config[129]['default']     = 2;
	$config[129]['options']     = array(
		_AM_WEBLINKS_VIEW_URL_0 => 0,
		_AM_WEBLINKS_VIEW_URL_1 => 1,
		_AM_WEBLINKS_VIEW_URL_2 => 2,
	);

	$config[134]['name']        = 'use_highlight';
	$config[134]['catid']       = 12;
	$config[134]['title']       = '_AM_WEBLINKS_USE_HIGHLIGHT';
	$config[134]['description'] = '';
	$config[134]['formtype']    = 'yesno';
	$config[134]['valuetype']   = 'int';
	$config[134]['default']     = 1;

	$config[135]['name']        = 'mode_random_jump';
	$config[135]['catid']       = 12;
	$config[135]['title']       = '_AM_WEBLINKS_MODE_RANDOM';
	$config[135]['description'] = '';
	$config[135]['formtype']    = 'radio_nl_non';
	$config[135]['valuetype']   = 'int';
	$config[135]['default']     = 0;
	$config[135]['options']     = array(
		_AM_WEBLINKS_MODE_RANDOM_URL    => 0,
		_AM_WEBLINKS_MODE_RANDOM_SINGLE => 1,
	);

	$config[136]['name']        = 'kml_use';
	$config[136]['catid']       = 12;
	$config[136]['title']       = '_AM_WEBLINKS_KML_USE';
	$config[136]['description'] = '';
	$config[136]['formtype']    = 'yesno';
	$config[136]['valuetype']   = 'int';
	$config[136]['default']     = 1;

//---------------------------------------------------------
// link image
//---------------------------------------------------------
	$config[141]['name']        = 'link_image_auto';
	$config[141]['catid']       = '14';
	$config[141]['title']       = '_AM_WEBLINKS_LINK_IMAGE_AUTO';
	$config[141]['description'] = '_AM_WEBLINKS_LINK_IMAGE_AUTO_DSC';
	$config[141]['formtype']    = 'yesno';
	$config[141]['valuetype']   = 'int';
	$config[141]['default']     = 1;

	$config[142]['name']        = 'link_image_use';
	$config[142]['catid']       = '14';
	$config[142]['title']       = '_MI_WEBLINKS_LINKIMAGE_USE';
	$config[142]['description'] = '_MI_WEBLINKS_LINKIMAGE_USEDSC';
	$config[142]['formtype']    = 'yesno';
	$config[142]['valuetype']   = 'int';
	$config[142]['default']     = 1;

	$config[143]['name']        = 'link_image_width';
	$config[143]['catid']       = '14';
	$config[143]['title']       = '_MI_WEBLINKS_LINKIMAGE_WIDTH';
	$config[143]['description'] = '';
	$config[143]['formtype']    = 'textbox';
	$config[143]['valuetype']   = 'int';
	$config[143]['default']     = 140;

	$config[144]['name']        = 'link_image_height';
	$config[144]['catid']       = '14';
	$config[144]['title']       = '_MI_WEBLINKS_LINKIMAGE_HEIGHT';
	$config[144]['description'] = '';
	$config[144]['formtype']    = 'textbox';
	$config[144]['valuetype']   = 'int';
	$config[144]['default']     = 200;

	$config[145]['name']        = 'list_image_use';
	$config[145]['catid']       = '14';
	$config[145]['title']       = '_MI_WEBLINKS_LISTIMAGE_USE';
	$config[145]['description'] = '_MI_WEBLINKS_LISTIMAGE_USEDSC';
	$config[145]['formtype']    = 'yesno';
	$config[145]['valuetype']   = 'int';
	$config[145]['default']     = 1;

	$config[146]['name']        = 'list_image_width';
	$config[146]['catid']       = '14';
	$config[146]['title']       = '_MI_WEBLINKS_LISTIMAGE_WIDTH';
	$config[146]['description'] = '';
	$config[146]['formtype']    = 'textbox';
	$config[146]['valuetype']   = 'int';
	$config[146]['default']     = 100;

	$config[147]['name']        = 'list_image_height';
	$config[147]['catid']       = '14';
	$config[147]['title']       = '_MI_WEBLINKS_LISTIMAGE_HEIGHT';
	$config[147]['description'] = '';
	$config[147]['formtype']    = 'textbox';
	$config[147]['valuetype']   = 'int';
	$config[147]['default']     = 60;

	$config[148]['name']        = 'link_img_thumb';
	$config[148]['catid']       = '14';
	$config[148]['title']       = '_AM_WEBLINKS_LINK_IMG_THUMB';
	$config[148]['description'] = '_AM_WEBLINKS_LINK_IMG_THUMB_DSC';
	$config[148]['formtype']    = 'extra_link_img_thumb';
	$config[148]['valuetype']   = 'text';
	$config[148]['default']     = 'mozshot';


//---------------------------------------------------------
// rss
//---------------------------------------------------------
	$config[151]['name']        = 'rss_dirname';
	$config[151]['catid']       = '15';
	$config[151]['title']       = '_AM_WEBLINKS_DIRNAME_SEL';
	$config[151]['formtype']    = 'extra_rssc_dirname_list';
	$config[151]['valuetype']   = 'text';
	$config[151]['default']     = 'rssc';

	$config[152]['name']        = 'rss_use';
	$config[152]['catid']       = '15';
	$config[152]['title']       = '_AM_WEBLINKS_RSS_USE';
	$config[152]['description'] = '_AM_WEBLINKS_RSS_USE_DSC';
	$config[152]['formtype']    = 'yesno';
	$config[152]['valuetype']   = 'int';
	$config[152]['default']     = 0;

	$config[153]['name']        = 'rss_mode_auto';
	$config[153]['catid']       = '15';
	$config[153]['title']       = '_WEBLINKS_RSS_MODE_AUTO';
	$config[153]['description'] = '_WEBLINKS_RSS_MODE_AUTO_DSC';
	$config[153]['formtype']    = 'yesno';
	$config[153]['valuetype']   = 'int';
	$config[153]['default']     = 1;

	$config[154]['name']        = 'rss_cache_time';
	$config[154]['catid']       = '15';
	$config[154]['title']       = '_WEBLINKS_RSS_CACHE';
	$config[154]['description'] = '_WEBLINKS_RSS_CACHE_DSC';
	$config[154]['formtype']    = 'text';
	$config[154]['valuetype']   = 'int';
	$config[154]['default']     = 24;

// following features are continued, because of downward compatibility (v1.13).
	$config[155]['name']        = 'rss_site';
	$config[155]['catid']       = '-1';
	$config[155]['title']       = '_WEBLINKS_RSS_SITE';
	$config[155]['description'] = '_WEBLINKS_RSS_SITE_DSC';
	$config[155]['formtype']    = 'textarea';
	$config[155]['valuetype']   = 'text';
	$config[155]['default']     = '';

	$config[156]['name']        = 'rss_black';
	$config[156]['catid']       = '-1';
	$config[156]['title']       = '_WEBLINKS_RSS_BLACK';
	$config[156]['description'] = '_WEBLINKS_RSS_BLACK_DSC';
	$config[156]['formtype']    = 'textarea';
	$config[156]['valuetype']   = 'text';
	$config[156]['default']     = '';

	$config[157]['name']        = 'rss_white';
	$config[157]['catid']       = '-1';
	$config[157]['title']       = '_WEBLINKS_RSS_WHITE';
	$config[157]['description'] = '_WEBLINKS_RSS_WHITE_DSC';
	$config[157]['formtype']    = 'textarea';
	$config[157]['valuetype']   = 'text';
	$config[157]['default']     = '';

// use rssc
//	$config[158]['name']        = 'rss_mode_data';
//	$config[159]['name']        = 'rss_limit';

//---------------------------------------------------------
// rss view
//---------------------------------------------------------
	$config[161]['name']        = 'rss_mode_title';
	$config[161]['catid']       = '16';
	$config[161]['title']       = '_WEBLINKS_RSS_MODE_TITLE';
	$config[161]['description'] = '_WEBLINKS_RSS_MODE_TITLE_DSC';
	$config[161]['formtype']    = 'yesno';
	$config[161]['valuetype']   = 'int';
	$config[161]['default']     = 0;

	$config[162]['name']        = 'rss_mode_content';
	$config[162]['catid']       = '16';
	$config[162]['title']       = '_WEBLINKS_RSS_MODE_CONTENT';
	$config[162]['description'] = '_WEBLINKS_RSS_MODE_CONTENT_DSC';
	$config[162]['formtype']    = 'yesno';
	$config[162]['valuetype']   = 'int';
	$config[162]['default']     = 0;

// change to index_new_rss
//	$config[163]['name']        = 'rss_new';

	$config[164]['name']        = 'rss_perpage';
	$config[164]['catid']       = '16';
	$config[164]['title']       = '_WEBLINKS_RSS_PERPAGE';
	$config[164]['description'] = '_WEBLINKS_RSS_PERPAGE_DSC';
	$config[164]['formtype']    = 'text';
	$config[164]['valuetype']   = 'int';
	$config[164]['default']     = 10;

	$config[165]['name']        = 'rss_num_content';
	$config[165]['catid']       = '16';
	$config[165]['title']       = '_WEBLINKS_RSS_NUM_CONTENT';
	$config[165]['description'] = '_WEBLINKS_RSS_NUM_CONTENT_DSC';
	$config[165]['formtype']    = 'text';
	$config[165]['valuetype']   = 'int';
	$config[165]['default']     = 1;

	$config[166]['name']        = 'rss_max_content';
	$config[166]['catid']       = '16';
	$config[166]['title']       = '_WEBLINKS_RSS_MAX_CONTENT';
	$config[166]['description'] = '_WEBLINKS_RSS_MAX_CONTENT_DSC';
	$config[166]['formtype']    = 'text';
	$config[166]['valuetype']   = 'int';
	$config[166]['default']     = 1000;

	$config[167]['name']        = 'rss_max_summary';
	$config[167]['catid']       = '16';
	$config[167]['title']       = '_WEBLINKS_RSS_MAX_SUMMARY';
	$config[167]['description'] = '_WEBLINKS_RSS_MAX_SUMMARY_DSC';
	$config[167]['formtype']    = 'text';
	$config[167]['valuetype']   = 'int';
	$config[167]['default']     = 200;

//---------------------------------------------------------
// category forum
//---------------------------------------------------------
	$config[171]['name']        = 'cat_forum_sel';
	$config[171]['catid']       = 17;
	$config[171]['title']       = '_AM_WEBLINKS_PLUGIN_SEL';
	$config[171]['formtype']    = 'extra_forum_plugin';
	$config[171]['valuetype']   = 'int';
	$config[171]['default']     = 0;

	$config[176]['name']        = 'cat_forum_dirname';
	$config[176]['catid']       = 17;
	$config[176]['title']       = '_AM_WEBLINKS_DIRNAME_SEL';
	$config[176]['formtype']    = 'extra_dirname_list';
	$config[176]['valuetype']   = 'text';
	$config[176]['default']     = 'newbb';

	$config[172]['name']        = 'cat_forum_thread_limit';
	$config[172]['catid']       = 17;
	$config[172]['title']       = '_AM_WEBLINKS_FORUM_THREAD_LIMIT';
	$config[172]['formtype']    = 'text';
	$config[172]['valuetype']   = 'int';
	$config[172]['default']     = 10;

	$config[173]['name']        = 'cat_forum_post_limit';
	$config[173]['catid']       = 17;
	$config[173]['title']       = '_AM_WEBLINKS_FORUM_POST_LIMIT';
	$config[173]['formtype']    = 'text';
	$config[173]['valuetype']   = 'int';
	$config[173]['default']     = 1;

	$config[174]['name']        = 'cat_forum_post_order';
	$config[174]['catid']       = 17;
	$config[174]['title']       = '_AM_WEBLINKS_FORUM_POST_ORDER';
	$config[174]['formtype']    = 'radio';
	$config[174]['valuetype']   = 'int';
	$config[174]['default']     = 1;
	$config[174]['options']     = array(
		_AM_WEBLINKS_FORUM_POST_ORDER_0 => 0,
		_AM_WEBLINKS_FORUM_POST_ORDER_1 => 1,
	);

	$config[175]['name']        = 'cat_forum_mode';
	$config[175]['catid']       = 17;
	$config[175]['title']       = '_AM_WEBLINKS_WHEN_OMIT';
	$config[175]['formtype']    = 'radio';
	$config[175]['valuetype']   = 'int';
	$config[175]['default']     = 0;
	$config[175]['options']     = array(
		_AM_WEBLINKS_MODE_NON    => 0,
		_AM_WEBLINKS_MODE_PARENT => 1,
	);

//---------------------------------------------------------
// link forum
//---------------------------------------------------------
	$config[181]['name']        = 'link_forum_sel';
	$config[181]['catid']       = 18;
	$config[181]['title']       = '_AM_WEBLINKS_PLUGIN_SEL';
	$config[181]['formtype']    = 'extra_forum_plugin';
	$config[181]['valuetype']   = 'int';
	$config[181]['default']     = 0;

	$config[185]['name']        = 'link_forum_dirname';
	$config[185]['catid']       = 18;
	$config[185]['title']       = '_AM_WEBLINKS_DIRNAME_SEL';
	$config[185]['formtype']    = 'extra_dirname_list';
	$config[185]['valuetype']   = 'text';
	$config[185]['default']     = 'newbb';

	$config[182]['name']        = 'link_forum_thread_limit';
	$config[182]['catid']       = 18;
	$config[182]['title']       = '_AM_WEBLINKS_FORUM_THREAD_LIMIT';
	$config[182]['formtype']    = 'text';
	$config[182]['valuetype']   = 'int';
	$config[182]['default']     = 10;

	$config[183]['name']        = 'link_forum_post_limit';
	$config[183]['catid']       = 18;
	$config[183]['title']       = '_AM_WEBLINKS_FORUM_POST_LIMIT';
	$config[183]['formtype']    = 'text';
	$config[183]['valuetype']   = 'int';
	$config[183]['default']     = 1;

	$config[184]['name']        = 'link_forum_post_order';
	$config[184]['catid']       = 18;
	$config[184]['title']       = '_AM_WEBLINKS_FORUM_POST_ORDER';
	$config[184]['formtype']    = 'radio';
	$config[184]['valuetype']   = 'int';
	$config[184]['default']     = 1;
	$config[184]['options']     = array(
		_AM_WEBLINKS_FORUM_POST_ORDER_0 => 0,
		_AM_WEBLINKS_FORUM_POST_ORDER_1 => 1,
	);

//---------------------------------------------------------
// locate
//---------------------------------------------------------
	$config[191]['name']        = 'country_code';
	$config[191]['catid']       = 19;
	$config[191]['title']       = '_AM_WEBLINKS_CONF_COUNTRY_CODE';
	$config[191]['description'] = '_AM_WEBLINKS_CONF_COUNTRY_CODE_DESC';
	$config[191]['formtype']    = 'text';
	$config[191]['valuetype']   = 'text';
	$config[191]['default']     = $default['country_code'];

//---------------------------------------------------------
// map site
//---------------------------------------------------------
	$config[201]['name']      = 'map_use';
	$config[201]['catid']     = 20;
	$config[201]['title']       = '_AM_WEBLINKS_CONF_MAP_USE';
	$config[201]['formtype']  = 'yesno';
	$config[201]['valuetype'] = 'int';
	$config[201]['default']   = 1;

	$config[202]['name']        = 'map_template';
	$config[202]['catid']       = 20;
	$config[202]['title']       = '_AM_WEBLINKS_CONF_MAP_TEMPLATE';
	$config[202]['description'] = '_AM_WEBLINKS_CONF_MAP_TEMPLATE_DESC';
	$config[202]['formtype']    = 'text';
	$config[202]['valuetype']   = 'text';
	$config[202]['default']     = $default['weblinks_map_template'];
	$config[202]['cc_flag']     = 1;
	$config[202]['cc_value']    = $cc['weblinks_map_template'];

//---------------------------------------------------------
// google map: hacked by wye
//---------------------------------------------------------
	$config[211]['name']        = 'gm_use';
	$config[211]['catid']       = '21';
	$config[211]['title']       = '_AM_WEBLINKS_CONF_GM_USE';
	$config[211]['formtype']    = 'yesno';
	$config[211]['valuetype']   = 'int';
	$config[211]['default']     = 0;

	$config[212]['name']        = 'gm_apikey';
	$config[212]['catid']       = '21';
	$config[212]['title']       = '_AM_WEBLINKS_CONF_GM_APIKEY';
	$config[212]['description'] = '_AM_WEBLINKS_CONF_GM_APIKEY_DESC';
	$config[212]['formtype']    = 'textarea';
	$config[212]['valuetype']   = 'text';
	$config[212]['default']     = '';

	$config[213]['name']        = 'gm_server';
	$config[213]['catid']       = '21';
	$config[213]['title']       = '_AM_WEBLINKS_CONF_GM_SERVER';
	$config[213]['formtype']    = 'text';
	$config[213]['valuetype']   = 'text';
	$config[213]['default']     = $default['gm_server'];
	$config[213]['cc_flag']     = 1;
	$config[213]['cc_value']    = $cc['gm_server'];

	$config[214]['name']        = 'gm_location';
	$config[214]['catid']       = '21';
	$config[214]['title']       = '_AM_WEBLINKS_CONF_GM_LOCATION';
	$config[214]['formtype']    = 'text';
	$config[214]['valuetype']   = 'text';
	$config[214]['default']     = $default['gm_location'];
	$config[214]['cc_flag']     = 1;
	$config[214]['cc_value']    = $cc['gm_location'];

	$config[215]['name']        = 'gm_latitude';
	$config[215]['catid']       = '21';
	$config[215]['title']       = '_AM_WEBLINKS_CONF_GM_LATITUDE';
	$config[215]['formtype']    = 'text';
	$config[215]['valuetype']   = 'float';
	$config[215]['default']     = $default['gm_latitude'];
	$config[215]['cc_flag']     = 1;
	$config[215]['cc_value']    = $cc['gm_latitude'];

	$config[216]['name']        = 'gm_longitude';
	$config[216]['catid']       = '21';
	$config[216]['title']       = '_AM_WEBLINKS_CONF_GM_LONGITUDE';
	$config[216]['formtype']    = 'text';
	$config[216]['valuetype']   = 'float';
	$config[216]['default']     = $default['gm_longitude'];
	$config[216]['cc_flag']     = 1;
	$config[216]['cc_value']    = $cc['gm_longitude'];

	$config[217]['name']        = 'gm_zoom';
	$config[217]['catid']       = '21';
	$config[217]['country']     = 1;
	$config[217]['title']       = '_AM_WEBLINKS_CONF_GM_ZOOM';
	$config[217]['formtype']    = 'text';
	$config[217]['valuetype']   = 'int';
	$config[217]['default']     = $default['gm_zoom'];
	$config[217]['cc_flag']     = 1;
	$config[217]['cc_value']    = $cc['gm_zoom'];

	$config[302]['name']        = 'gm_marker_width';
	$config[302]['catid']       = '21';
	$config[302]['title']       = '_AM_WEBLINKS_GM_MARKER_WIDTH';
	$config[302]['description'] = '_AM_WEBLINKS_GM_MARKER_WIDTH_DESC';
	$config[302]['formtype']    = 'text';
	$config[302]['valuetype']   = 'int';
	$config[302]['default']     = '300';

	$config[218]['name']        = 'gm_title_length';
	$config[218]['catid']       = '21';
	$config[218]['title']       = '_AM_WEBLINKS_GM_TITLE_LENGTH';
	$config[218]['description'] = '_AM_WEBLINKS_GM_TITLE_LENGTH_DESC';
	$config[218]['formtype']    = 'text';
	$config[218]['valuetype']   = 'int';
	$config[218]['default']     = '-1';

	$config[219]['name']        = 'gm_desc_length';
	$config[219]['catid']       = '21';
	$config[219]['title']       = '_AM_WEBLINKS_GM_DESC_LENGTH';
	$config[219]['description'] = '_AM_WEBLINKS_GM_DESC_LENGTH_DESC';
	$config[219]['formtype']    = 'text';
	$config[219]['valuetype']   = 'int';
	$config[219]['default']     = '100';

	$config[291]['name']        = 'gm_wordwrap';
	$config[291]['catid']       = '21';
	$config[291]['title']       = '_AM_WEBLINKS_GM_WORDWRAP';
	$config[291]['description'] = '_AM_WEBLINKS_GM_WORDWRAP_DESC';
	$config[291]['formtype']    = 'text';
	$config[291]['valuetype']   = 'int';
	$config[291]['default']     = '-1';

	$config[292]['name']        = 'gm_use_center_marker';
	$config[292]['catid']       = '21';
	$config[292]['title']       = '_AM_WEBLINKS_GM_USE_CENTER_MARKER';
	$config[292]['description'] = '_AM_WEBLINKS_GM_USE_CENTER_MARKER_DESC';
	$config[292]['formtype']    = 'yesno';
	$config[292]['valuetype']   = 'int';
	$config[292]['default']     = '0';

	$config[293]['name']        = 'gm_map_control';
	$config[293]['catid']       = '21';
	$config[293]['title']       = '_AM_WEBLINKS_GM_MAP_CONT';
	$config[293]['description'] = '_AM_WEBLINKS_GM_MAP_CONT_DESC';
	$config[293]['formtype']    = 'radio_nl_non';
	$config[293]['valuetype']   = 'text';
	$config[293]['default']     = 'small';
	$config[293]['options']     = array(
		_AM_WEBLINKS_GM_MAP_CONT_NON   => 'non',
		_AM_WEBLINKS_GM_MAP_CONT_LARGE => 'large',
		_AM_WEBLINKS_GM_MAP_CONT_SMALL => 'small',
		_AM_WEBLINKS_GM_MAP_CONT_ZOOM  => 'zoom',
	);

	$config[294]['name']        = 'gm_use_type_control';
	$config[294]['catid']       = '21';
	$config[294]['title']       = '_AM_WEBLINKS_GM_USE_TYPE_CONT';
	$config[294]['description'] = '_AM_WEBLINKS_GM_USE_TYPE_CONT_DESC';
	$config[294]['formtype']    = 'yesno';
	$config[294]['valuetype']   = 'int';
	$config[294]['default']     = '1';

	$config[295]['name']        = 'gm_use_scale_control';
	$config[295]['catid']       = '21';
	$config[295]['title']       = '_AM_WEBLINKS_GM_USE_SCALE_CONT';
	$config[295]['description'] = '_AM_WEBLINKS_GM_USE_SCALE_CONT_DESC';
	$config[295]['formtype']    = 'yesno';
	$config[295]['valuetype']   = 'int';
	$config[295]['default']     = '0';

	$config[296]['name']        = 'gm_use_overview_control';
	$config[296]['catid']       = '21';
	$config[296]['title']       = '_AM_WEBLINKS_GM_USE_OVERVIEW_CONT';
	$config[296]['description'] = '_AM_WEBLINKS_GM_USE_OVERVIEW_CONT_DESC';
	$config[296]['formtype']    = 'yesno';
	$config[296]['valuetype']   = 'int';
	$config[296]['default']     = '1';

//	$config[297]['name']        = 'gm_map_type';
//	$config[297]['catid']       = '21';
//	$config[297]['title']       = '_AM_WEBLINKS_GM_MAP_TYPE';
//	$config[297]['description'] = '_AM_WEBLINKS_GM_MAP_TYPE_DESC';
//	$config[297]['formtype']    = 'radio_nl_non';
//	$config[297]['valuetype']   = 'text';
//	$config[297]['default']     = 'normal';
//	$config[297]['options']     = array(
//		_WEBLINKS_GM_TYPE_MAP       => 'normal',
//		_WEBLINKS_GM_TYPE_SATELLITE => 'satellite',
//		_WEBLINKS_GM_TYPE_HYBRID    => 'hybirid',
//	);

	$config[298]['name']        = 'gm_geocode_kind';
	$config[298]['catid']       = '21';
	$config[298]['title']       = '_AM_WEBLINKS_GM_GEOCODE_KIND';
	$config[298]['description'] = '_AM_WEBLINKS_GM_GEOCODE_KIND_DESC';
	$config[298]['formtype']    = 'radio_nl_non';
	$config[298]['valuetype']   = 'text';
	$config[298]['default']     = 'locations';
	$config[298]['options']     = array(
		_AM_WEBLINKS_GM_GEOCODE_KIND_LATLNG     => 'latlng',
		_AM_WEBLINKS_GM_GEOCODE_KIND_LOCATIONS  => 'locations',
	);

	$config[299]['name']        = 'gm_use_geocode_tokyo';
	$config[299]['catid']       = '21';
	$config[299]['title']       = '_AM_WEBLINKS_GM_USE_GEOCODE_TOKYO';
	$config[299]['description'] = '_AM_WEBLINKS_GM_USE_GEOCODE_TOKYO_DESC';
	$config[299]['formtype']    = 'yesno';
	$config[299]['valuetype']   = 'int';
	$config[299]['default']     = '0';

	$config[301]['name']        = 'gm_use_nishioka_inverse';
	$config[301]['catid']       = '21';
	$config[301]['title']       = '_AM_WEBLINKS_GM_USE_NISHIOKA';
	$config[301]['description'] = '_AM_WEBLINKS_GM_USE_NISHIOKA_DESC';
	$config[301]['formtype']    = 'yesno';
	$config[301]['valuetype']   = 'int';
	$config[301]['default']     = '0';

	$config[234]['name']        = 'index_gm_mode';
	$config[234]['catid']       = '29';
	$config[234]['title']       = '_AM_WEBLINKS_CONF_INDEX_GM_MODE';
	$config[234]['formtype']    = 'radio';
	$config[234]['valuetype']   = 'int';
	$config[234]['default']     = 1;
	$config[234]['options']     = array(
		_AM_WEBLINKS_MODE_NON       => 0,
		_AM_WEBLINKS_MODE_DEFAULT   => 1,
		_AM_WEBLINKS_MODE_FOLLOWING => 2,
	);

// move from link
	$config[235]['name']        = 'index_gm_latitude';
	$config[235]['catid']       = '29';
	$config[235]['title']       = '_WEBLINKS_GM_LATITUDE';
	$config[235]['formtype']    = 'text';
	$config[235]['valuetype']   = 'float';
	$config[235]['default']     = $default['gm_latitude'];

	$config[236]['name']        = 'index_gm_longitude';
	$config[236]['catid']       = '29';
	$config[236]['title']       = '_WEBLINKS_GM_LONGITUDE';
	$config[236]['formtype']    = 'text';
	$config[236]['valuetype']   = 'float';
	$config[236]['default']     = $default['gm_longitude'];

	$config[237]['name']        = 'index_gm_zoom';
	$config[237]['catid']       = '29';
	$config[237]['title']       = '_WEBLINKS_GM_ZOOM';
	$config[237]['formtype']    = 'text';
	$config[237]['valuetype']   = 'int';
	$config[237]['default']     = $default['gm_zoom'];

// move from category
	$config[29]['name']        = 'cat_show_gm';
	$config[29]['catid']       = 30;
	$config[29]['title']       = '_AM_WEBLINKS_CAT_SHOW_GM';
	$config[29]['formtype']    = 'yesno';
	$config[29]['valuetype']   = 'int';
	$config[29]['default']     = 1;

//	$config[301]['name']        = 'gm_use_nishioka_inverse';
//	$config[302]['name']        = 'gm_marker_width';

//---------------------------------------------------------
// google search
//---------------------------------------------------------
	$config[221]['name']        = 'google_server';
	$config[221]['catid']       = '22';
	$config[221]['title']       = '_AM_WEBLINKS_CONF_GOOGLE_SERVER';
	$config[221]['formtype']    = 'text';
	$config[221]['valuetype']   = 'text';
	$config[221]['default']     = $default['google_url'];
	$config[221]['cc_flag']     = 1;
	$config[221]['cc_value']    = $cc['google_url'];

//---------------------------------------------------------
// index page
//---------------------------------------------------------
	$config[231]['name']        = 'index_description';
	$config[231]['catid']       = '23';
	$config[231]['title']       = '_AM_WEBLINKS_INDEX_DESC';
//	$config[231]['description'] = '_AM_WEBLINKS_INDEX_DESC_DSC';
	$config[231]['formtype']    = 'textarea';
	$config[231]['valuetype']   = 'textarea';
	$config[231]['default']     = _AM_WEBLINKS_INDEX_DESC_DEFAULT;

	$config[281]['name']        = 'index_cat_cols';
	$config[281]['catid']       = '23';
	$config[281]['title']       = '_AM_WEBLINKS_CAT_COLS';
	$config[281]['formtype']    = 'text';
	$config[281]['valuetype']   = 'int';
	$config[281]['default']     = 3;

	$config[282]['name']        = 'index_cat_sub_mode';
	$config[282]['catid']       = '23';
	$config[282]['title']       = '_AM_WEBLINKS_CAT_SUB_MODE';
	$config[282]['formtype']    = 'radio';
	$config[282]['valuetype']   = 'int';
	$config[282]['default']     = 1;
	$config[282]['options']     = array(
		_AM_WEBLINKS_MODE_NON       => 0,
		_AM_WEBLINKS_CAT_SUB_MODE_1 => 1,
		_AM_WEBLINKS_CAT_SUB_MODE_2 => 2,
	);

	$config[283]['name']        = 'index_cat_sub_num';
	$config[283]['catid']       = '23';
	$config[283]['title']       = '_WEBLINKS_CAT_SUB';
	$config[283]['formtype']    = 'text';
	$config[283]['valuetype']   = 'int';
	$config[283]['default']     = 5;

	$config[284]['name']        = 'index_cat_img_mode';
	$config[284]['catid']       = '23';
	$config[284]['title']       = '_WEBLINKS_CAT_IMG_MODE';
	$config[284]['formtype']    = 'radio';
	$config[284]['valuetype']   = 'int';
	$config[284]['default']     = 1;
	$config[284]['options']     = array(
		_AM_WEBLINKS_MODE_NON    => 0,
		_WEBLINKS_CAT_IMG_MODE_1 => 1,
		_WEBLINKS_CAT_IMG_MODE_2 => 2,
	);

	$config[232]['name']        = 'index_new_link';
	$config[232]['catid']       = '23';
	$config[232]['title']       = '_MI_WEBLINKS_NEWLINKS';
//	$config[232]['description'] = '_MI_WEBLINKS_NEWLINKSDSC';
	$config[232]['formtype']    = 'text';
	$config[232]['valuetype']   = 'int';
	$config[232]['default']     = 10;

	$config[233]['name']        = 'index_new_rss';
	$config[233]['catid']       = '23';
	$config[233]['title']       = '_WEBLINKS_RSS_NEW';
//	$config[233]['description'] = '_WEBLINKS_RSS_NEW_DSC';
	$config[233]['formtype']    = 'text';
	$config[233]['valuetype']   = 'int';
	$config[233]['default']     = 10;

// move to google map
//	$config[234]['name']        = 'index_gm_mode';

	$config[239]['name']        = 'index_mode_latest';
	$config[239]['catid']       = '23';
	$config[239]['title']       = '_AM_WEBLINKS_INDEX_MODE_LATEST';
	$config[239]['formtype']    = 'radio';
	$config[239]['valuetype']   = 'int';
	$config[239]['default']     = 0;
	$config[239]['options']     = array(
		_AM_WEBLINKS_INDEX_MODE_LATEST_UPDATE => 0,
		_AM_WEBLINKS_INDEX_MODE_LATEST_CREATE => 1,
	);

	$config[341]['name']        = 'index_admin_waiting_show';
	$config[341]['catid']       = '23';
	$config[341]['title']       = '_AM_WEBLINKS_ADMIN_WAITING_SHOW';
//	$config[341]['description'] = '';
	$config[341]['formtype']    = 'yesno';
	$config[341]['valuetype']   = 'int';
	$config[341]['default']     = 1;

	$config[342]['name']        = 'index_user_waiting_num';
	$config[342]['catid']       = '23';
	$config[342]['title']       = '_AM_WEBLINKS_USER_WAITING_NUM';
//	$config[342]['description'] = '';
	$config[342]['formtype']    = 'text';
	$config[342]['valuetype']   = 'int';
	$config[342]['default']     = 10;

	$config[343]['name']        = 'index_user_owner_num';
	$config[343]['catid']       = '23';
	$config[343]['title']       = '_AM_WEBLINKS_USER_OWNER_NUM';
//	$config[343]['description'] = '';
	$config[343]['formtype']    = 'text';
	$config[343]['valuetype']   = 'int';
	$config[343]['default']     = 10;

//---------------------------------------------------------
// category album
//---------------------------------------------------------
	$config[241]['name']        = 'cat_album_sel';
	$config[241]['catid']       = 24;
	$config[241]['title']       = '_AM_WEBLINKS_PLUGIN_SEL';
	$config[241]['formtype']    = 'extra_album_plugin';
	$config[241]['valuetype']   = 'int';
	$config[241]['default']     = 0;

	$config[244]['name']        = 'cat_album_dirname';
	$config[244]['catid']       = 24;
	$config[244]['title']       = '_AM_WEBLINKS_DIRNAME_SEL';
	$config[244]['formtype']    = 'extra_dirname_list';
	$config[244]['valuetype']   = 'text';
	$config[244]['default']     = 'myalbum';

	$config[242]['name']        = 'cat_album_limit';
	$config[242]['catid']       = 24;
	$config[242]['title']       = '_AM_WEBLINKS_ALBUM_LIMIT';
	$config[242]['formtype']    = 'text';
	$config[242]['valuetype']   = 'int';
	$config[242]['default']     = 10;

	$config[243]['name']        = 'cat_album_mode';
	$config[243]['catid']       = 24;
	$config[243]['title']       = '_AM_WEBLINKS_WHEN_OMIT';
	$config[243]['formtype']    = 'radio';
	$config[243]['valuetype']   = 'int';
	$config[243]['default']     = 0;
	$config[243]['options']     = array(
		_AM_WEBLINKS_MODE_NON    => 0,
		_AM_WEBLINKS_MODE_PARENT => 1,
	);

//---------------------------------------------------------
// link album
//---------------------------------------------------------
	$config[251]['name']        = 'link_album_sel';
	$config[251]['catid']       = 25;
	$config[251]['title']       = '_AM_WEBLINKS_PLUGIN_SEL';
	$config[251]['formtype']    = 'extra_album_plugin';
	$config[251]['valuetype']   = 'int';
	$config[251]['default']     = 0;

	$config[253]['name']        = 'link_album_dirname';
	$config[253]['catid']       = 25;
	$config[253]['title']       = '_AM_WEBLINKS_DIRNAME_SEL';
	$config[253]['formtype']    = 'extra_dirname_list';
	$config[253]['valuetype']   = 'text';
	$config[253]['default']     = 'myalbum';

	$config[252]['name']        = 'link_album_limit';
	$config[252]['catid']       = 25;
	$config[252]['title']       = '_AM_WEBLINKS_ALBUM_LIMIT';
	$config[252]['formtype']    = 'text';
	$config[252]['valuetype']   = 'int';
	$config[252]['default']     = 10;

//---------------------------------------------------------
// d3forum
//---------------------------------------------------------
	$config[271]['name']        = 'd3forum_plugin';
	$config[271]['catid']       = 27;
	$config[271]['title']       = '_AM_WEBLINKS_PLUGIN_SEL';
	$config[271]['formtype']    = 'extra_d3forum_plugin';
	$config[271]['valuetype']   = 'int';
	$config[271]['default']     = 0;

	$config[272]['name']        = 'd3forum_dirname';
	$config[272]['catid']       = 27;
	$config[272]['title']       = '_AM_WEBLINKS_DIRNAME_SEL';
	$config[272]['formtype']    = 'extra_dirname_list';
	$config[272]['valuetype']   = 'text';
	$config[272]['default']     = 'd3forum';

	$config[273]['name']        = 'd3forum_forum_id';
	$config[273]['catid']       = 27;
	$config[273]['title']       = '_WEBLINKS_FORUM_SEL';
	$config[273]['formtype']    = 'extra_d3forum_forum_id';
	$config[273]['valuetype']   = 'int';
	$config[273]['default']     = 0;

	$config[274]['name']        = 'd3forum_view';
	$config[274]['catid']       = 27;
	$config[274]['title']       = '_AM_WEBLINKS_D3FORUM_VIEW';
	$config[274]['formtype']    = 'radio';
	$config[274]['valuetype']   = 'text';
	$config[274]['default']     = 'listposts_flat';
	$config[274]['options']     = array(
		_FLAT     => 'listposts_flat',
		_THREADED => 'listtopics',
	);

//---------------------------------------------------------
// map_jp
//---------------------------------------------------------
	$config[311]['name']        = 'map_jp_info';
	$config[311]['catid']       = 0;
	$config[311]['title']       = 'map_jp_info';
	$config[311]['formtype']    = 'text';
	$config[311]['valuetype']   = 'array';
	$config[311]['default']     = '';

	$config[312]['name']        = 'map_jp_show_index';
	$config[312]['catid']       = 31;
	$config[312]['title']       = '_AM_WEBLINKS_MAP_JP_SHOW_INDEX';
	$config[312]['formtype']    = 'yesno';
	$config[312]['valuetype']   = 'int';
	$config[312]['default']     = 0;

	$config[313]['name']        = 'map_jp_show_cat';
	$config[313]['catid']       = 31;
	$config[313]['title']       = '_AM_WEBLINKS_MAP_JP_SHOW_CAT';
	$config[313]['formtype']    = 'yesno';
	$config[313]['valuetype']   = 'int';
	$config[313]['default']     = 0;

//---------------------------------------------------------
// link item
//---------------------------------------------------------
	$config[321]['name']        = 'link_num_etc';
	$config[321]['catid']       = 32;
	$config[321]['title']       = '_AM_WEBLINKS_LINK_NUM_ETC';
	$config[321]['formtype']    = 'text';
	$config[321]['valuetype']   = 'int';
	$config[321]['default']     = WEBLINKS_LINK_NUM_ETC;

//---------------------------------------------------------
// html style
//---------------------------------------------------------
	$config[331]['name']        = 'header_mode';
	$config[331]['catid']       = 33;
	$config[331]['title']       = '_AM_WEBLINKS_HEADER_MODE';
	$config[331]['description'] = '_AM_WEBLINKS_HEADER_MODE_DESC';
	$config[331]['formtype']    = 'yesno';
	$config[331]['valuetype']   = 'int';
	$config[331]['default']     = 1;	// show in xoops_module_header

//---------------------------------------------------------
// user submit link
//---------------------------------------------------------
	$config[351]['name']        = 'user_nameflag';
	$config[351]['catid']       = '35';
	$config[351]['title']       = '_AM_WEBLINKS_USER_NAMEFLAG';
	$config[351]['description'] = '_AM_WEBLINKS_USER_NAME_MAIL_FLAG_DESC';
	$config[351]['formtype']    = 'radio';
	$config[351]['valuetype']   = 'int';
	$config[351]['default']     = 2;
	$config[351]['options']     = array(
		_WLS_NOTPUBLIC                        => '0',
		_WLS_PUBLIC                           => '1',
		_AM_WEBLINKS_USER_NAME_MAIL_FLAG_SEL  => '2',
	);

	$config[352]['name']        = 'user_mailflag';
	$config[352]['catid']       = '35';
	$config[352]['title']       = '_AM_WEBLINKS_USER_MAILFLAG';
	$config[352]['description'] = '_AM_WEBLINKS_USER_NAME_MAIL_FLAG_DESC';
	$config[352]['formtype']    = 'radio';
	$config[352]['valuetype']   = 'int';
	$config[352]['default']     = 2;
	$config[352]['options']     = array(
		_WLS_NOTPUBLIC                        => '0',
		_WLS_PUBLIC                           => '1',
		_AM_WEBLINKS_USER_NAME_MAIL_FLAG_SEL  => '2',
	);

//---------------------------------------------------------
// menu
//---------------------------------------------------------
	$config[6]['name']        = 'use_ratelink';
	$config[6]['catid']       = 36;
	$config[6]['title']       = '_WEBLINKS_USE_RATELINK';
	$config[6]['description'] = '_WEBLINKS_USE_RATELINK_DSC';
	$config[6]['formtype']  = 'yesno';
	$config[6]['valuetype'] = 'int';
	$config[6]['default']     = 1;

	$config[11]['name']        = 'use_hits';
	$config[11]['catid']       = 36;
	$config[11]['title']       = '_AM_WEBLINKS_USE_HITS';
	$config[11]['description'] = '_AM_WEBLINKS_USE_HITS_DSC';
	$config[11]['formtype']  = 'yesno';
	$config[11]['valuetype'] = 'int';
	$config[11]['default']     = 1;

	$config[12]['name']        = 'use_hits_singlelink';
	$config[12]['catid']       = 36;
	$config[12]['title']       = '_AM_WEBLINKS_USE_HITS_SINGLELINK';
	$config[12]['description'] = '_AM_WEBLINKS_USE_HITS_SINGLELINK_DSC';
	$config[12]['formtype']    = 'yesno';
	$config[12]['valuetype']   = 'int';
	$config[12]['default']     = 0;

	$config[361]['name']        = 'use_pagerank';
	$config[361]['catid']       = 36;
	$config[361]['title']       = '_AM_WEBLINKS_USE_PAGERANK';
	$config[361]['description'] = '_AM_WEBLINKS_USE_PAGERANK_DESC';
	$config[361]['formtype']    = 'radio_nl_non';
	$config[361]['valuetype']   = 'int';
	$config[361]['default']     = 2;
	$config[361]['options']     = array(
		_AM_WEBLINKS_USE_PAGERANK_NON   => 0,
		_AM_WEBLINKS_USE_PAGERANK_SHOW  => 1,
		_AM_WEBLINKS_USE_PAGERANK_CACHE => 2,
	);

	$config[131]['name']        = 'recommend_pri';
	$config[131]['catid']       = '36';
	$config[131]['title']       = '_AM_WEBLINKS_RECOMMEND_PRI';
	$config[131]['description'] = '_AM_WEBLINKS_RECOMMEND_PRI_DSC';
	$config[131]['formtype']    = 'radio';
	$config[131]['valuetype']   = 'int';
	$config[131]['default']     = 2;
	$config[131]['options']     = array(
		_AM_WEBLINKS_PRI_0 => 0,
		_AM_WEBLINKS_PRI_1 => 1,
		_AM_WEBLINKS_PRI_2 => 2,
	);

	$config[132]['name']        = 'mutual_pri';
	$config[132]['catid']       = '36';
	$config[132]['title']       = '_AM_WEBLINKS_MUTUAL_PRI';
	$config[132]['description'] = '_AM_WEBLINKS_MUTUAL_PRI_DSC';
	$config[132]['formtype']    = 'radio';
	$config[132]['valuetype']   = 'int';
	$config[132]['default']     = 2;
	$config[132]['options']     = array(
		_AM_WEBLINKS_PRI_0 => 0,
		_AM_WEBLINKS_PRI_1 => 1,
		_AM_WEBLINKS_PRI_2 => 2,
	);

	$config[26]['name']        = 'show_catlist';
	$config[26]['catid']       = '36';
	$config[26]['title']       = '_AM_WEBLINKS_SHOW_CATLIST';
	$config[26]['description'] = '_AM_WEBLINKS_SHOW_CATLIST_DSC';
	$config[26]['formtype']    = 'yesno';
	$config[26]['valuetype']   = 'int';
	$config[26]['default']     = 1;

//---------------------------------------------------------
// menu title
//---------------------------------------------------------
	$config[371]['name']        = 'lang_main';
	$config[371]['catid']       = '37';
	$config[371]['title']       = '_HAPPY_LINUX_MAIN';
//	$config[371]['description'] = '';
	$config[371]['formtype']    = 'text';
	$config[371]['valuetype']   = 'text';
	$config[371]['default']     = _HAPPY_LINUX_MAIN;

	$config[372]['name']        = 'lang_submitlink';
	$config[372]['catid']       = '37';
	$config[372]['title']       = '_WLS_SUBMIT_NEW_LINK';
//	$config[372]['description'] = '';
	$config[372]['formtype']    = 'text';
	$config[372]['valuetype']   = 'text';
	$config[372]['default']     = _WLS_SUBMIT_NEW_LINK;

	$config[373]['name']        = 'lang_site_popular';
	$config[373]['catid']       = '37';
	$config[373]['title']       = '_WLS_SITE_POPULAR';
//	$config[373]['description'] = '';
	$config[373]['formtype']    = 'text';
	$config[373]['valuetype']   = 'text';
	$config[373]['default']     = _WLS_SITE_POPULAR;

	$config[374]['name']        = 'lang_site_highrate';
	$config[374]['catid']       = '37';
	$config[374]['title']       = '_WLS_SITE_HIGHRATE';
//	$config[374]['description'] = '';
	$config[374]['formtype']    = 'text';
	$config[374]['valuetype']   = 'text';
	$config[374]['default']     = _WLS_SITE_HIGHRATE;

	$config[375]['name']        = 'lang_site_pagerank';
	$config[375]['catid']       = '37';
	$config[375]['title']       = '_WEBLINKS_SITE_PAGERANK';
//	$config[375]['description'] = '';
	$config[375]['formtype']    = 'text';
	$config[375]['valuetype']   = 'text';
	$config[375]['default']     = _WEBLINKS_SITE_PAGERANK;

	$config[376]['name']        = 'lang_catlist';
	$config[376]['catid']       = '37';
	$config[376]['title']       = '_WLS_CATLIST';
//	$config[376]['description'] = '';
	$config[376]['formtype']    = 'text';
	$config[376]['valuetype']   = 'text';
	$config[376]['default']     = _WLS_CATLIST;

	$config[377]['name']        = 'lang_site_recommend';
	$config[377]['catid']       = '37';
	$config[377]['title']       = '_WLS_SITE_RECOMMEND';
//	$config[377]['description'] = '';
	$config[377]['formtype']    = 'text';
	$config[377]['valuetype']   = 'text';
	$config[377]['default']     = _WLS_SITE_RECOMMEND;

	$config[378]['name']        = 'lang_site_mutual';
	$config[378]['catid']       = '37';
	$config[378]['title']       = '_WLS_SITE_MUTUAL';
//	$config[378]['description'] = '';
	$config[378]['formtype']    = 'text';
	$config[378]['valuetype']   = 'text';
	$config[378]['default']     = _WLS_SITE_MUTUAL;

	$config[379]['name']        = 'lang_site_gmap';
	$config[379]['catid']       = '37';
	$config[379]['title']       = '_WEBLINKS_SITE_GMAP';
//	$config[379]['description'] = '';
	$config[379]['formtype']    = 'text';
	$config[379]['valuetype']   = 'text';
	$config[379]['default']     = _WEBLINKS_SITE_GMAP;

	$config[381]['name']        = 'lang_site_random';
	$config[381]['catid']       = '37';
	$config[381]['title']       = '_WLS_SITE_RANDOM';
//	$config[381]['description'] = '';
	$config[381]['formtype']    = 'text';
	$config[381]['valuetype']   = 'text';
	$config[381]['default']     = _WLS_SITE_RANDOM;

	$config[382]['name']        = 'lang_site_rss';
	$config[382]['catid']       = '37';
	$config[382]['title']       = '_WLS_SITE_RSS';
//	$config[382]['description'] = '';
	$config[382]['formtype']    = 'text';
	$config[382]['valuetype']   = 'text';
	$config[382]['default']     = _WLS_SITE_RSS;

	$config[383]['name']        = 'lang_atomfeed';
	$config[383]['catid']       = '37';
	$config[383]['title']       = '_WLS_ATOMFEED';
//	$config[383]['description'] = '';
	$config[383]['formtype']    = 'text';
	$config[383]['valuetype']   = 'text';
	$config[383]['default']     = _WLS_ATOMFEED;

//---------------------------------------------------------
// htmlout
//---------------------------------------------------------
	$config[391]['name']        = 'htmlout';
	$config[391]['catid']       = '39';
	$config[391]['title']       = '_AM_WEBLINKS_HTMLOUT';
	$config[391]['description'] = '_HAPPY_LINUX_PLUGIN_DESC';
	$config[391]['formtype']    = 'textarea';
	$config[391]['valuetype']   = 'text';
	$config[391]['default']     = '';

//---------------------------------------------------------
// rssout
//---------------------------------------------------------
	$config[401]['name']        = 'rssout';
	$config[401]['catid']       = '40';
	$config[401]['title']       = '_AM_WEBLINKS_RSSOUT';
	$config[401]['description'] = '_HAPPY_LINUX_PLUGIN_DESC';
	$config[401]['formtype']    = 'textarea';
	$config[401]['valuetype']   = 'text';
	$config[401]['default']     = '';

//---------------------------------------------------------
// kmlout
//---------------------------------------------------------
	$config[411]['name']        = 'kmlout';
	$config[411]['catid']       = '41';
	$config[411]['title']       = '_AM_WEBLINKS_KMLOUT';
	$config[411]['description'] = '_HAPPY_LINUX_PLUGIN_DESC';
	$config[411]['formtype']    = 'textarea';
	$config[411]['valuetype']   = 'text';
	$config[411]['default']     = '';

//---------------------------------------------------------
// others
// 260: category
// 280: index
//---------------------------------------------------------
	return $config;
}

//---------------------------------------------------------
// default value
//---------------------------------------------------------
// remove following function
// function get_rss_site()
// function get_rss_black()
// function get_rss_white()


// --- class end ---
}

// === class end ===
}

?>