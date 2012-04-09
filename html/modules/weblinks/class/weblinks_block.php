<?php
// $Id: weblinks_block.php,v 1.1 2012/04/09 10:23:37 ohwada Exp $

//=========================================================
// WebLinks Module
// 2012-04-02 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('weblinks_block') ) 
{

//=========================================================
// class weblinks_block
//=========================================================
class weblinks_block extends weblinks_block_view
{
	var $_db;
	var $_webmap_class;

	var $_table_link;
	var $_table_category;
	var $_table_catlink;

	var $_cat_cached = array();

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_block( $dirname )
{
	$this->weblinks_block_view();

	$this->_db =& Database::getInstance();
	$this->_webmap_class =& weblinks_block_webmap::getSingleton( $dirname );

	$this->_table_link     = weblinks_multi_get_table_name( $dirname, 'link' );
	$this->_table_category = weblinks_multi_get_table_name( $dirname, 'category' );
	$this->_table_catlink  = weblinks_multi_get_table_name( $dirname, 'catlink' );

}

function &getSingleton( $dirname )
{
	static $singletons;
	if ( !isset( $singletons[ $dirname ] ) ) {
		$singletons[ $dirname ] = new weblinks_block( $dirname );
	}
	return $singletons[ $dirname ];
}

//---------------------------------------------------------
// $options
// [0] module directory name (weblinks)
// [1] order (time_update/hits/rating)
// [2] number of display links (10)
// [3] max length of title (30)
//       when -1, unlimited
// [4] max length of category title (0)
//       when -1, unlimited
// [5] max length of description (0)
//       when -1, unlimited
// [6] days to show new icon (7)
//       when 0, not show
// [7] hits to show popular icon (0)
//       when 0, not show
// [8] max width of banner image (50)
//       when 0, not show
// [9] default width of banner image (50)
//       when 0, use original size
// [10] google map mode (0)
//       when 0, not show
//       when 1, use config latitude/longitude/zoom
//       when 2, use following value
// [11] google map latitude  (0)
// [12] google map longitude (0)
// [13] google map zoom      (0)
// [14] google map height  (300) px
// [15] google map timeout (1000) msec
//       when -1, use window.onload
// [16] google map max length of description (100)
//       when -1, unlimited
// [17] google map length of wordwrap (30)
//       when -1, unlimited
// [18] google map marker width (150) px
//       when -1, unlimited
// [19] google map control (1)
//       when 0, not show
//       when 1, show (GSmallMapControl)
// [20] google map type control (1)
//       when 0, not show
//       when 1, show
//---------------------------------------------------------
function top_show($options) 
{
	$SHOW_RECOMMEND  = false;
	$LIMIT_RECOMMEND = 3;

	$DIRNAME = empty( $options[0] ) ? basename( dirname( dirname( __FILE__ ) ) ) : $options[0];

	$order            = $options[1];
	$limit            = intval($options[2]);
	$title_length     = intval($options[3]);
	$cat_title_length = intval($options[4]);
	$desc_length      = intval($options[5]);
	$newdays          = intval($options[6]);
	$popular          = intval($options[7]);
	$max_width        = intval($options[8]);
	$width_default    = intval($options[9]);

	$gm_mode         = isset($options[10]) ? intval($options[10])   : 0;
	$gm_latitude     = isset($options[11]) ? floatval($options[11]) : 0;
	$gm_longitude    = isset($options[12]) ? floatval($options[12]) : 0;
	$gm_zoom         = isset($options[13]) ? intval($options[13])   : 0;
	$gm_height       = isset($options[14]) ? intval($options[14])   : 0;
	$gm_timeout      = isset($options[15]) ? intval($options[15])   : 0;

// use config value
//	$gm_desc_length  = isset($options[16]) ? intval($options[16])   : 0;
//	$gm_wordwrap     = isset($options[17]) ? intval($options[17])   : 0;
//	$gm_marker_width = isset($options[18]) ? intval($options[18])   : 0;

// NOT use
//	$gm_control      = isset($options[19]) ? intval($options[19])   : 1;
//	$gm_type_control = isset($options[20]) ? intval($options[20])   : 1;

// time_create
	if (($order != 'hits')&&($order != 'rating')&&($order != 'time_create')) {
		$order = 'time_update';
	}

	$lid_array = array();

	$block = array();
	$block['dirname']       = $DIRNAME;
	$block['lang_hits']     = _MB_WEBLINKS_HITS;
	$block['lang_rating']   = _MB_WEBLINKS_RATING;
	$block['lang_votes']    = _MB_WEBLINKS_VOTES;
	$block['lang_comments'] = _MB_WEBLINKS_COMMENTS;
	$block['lang_more']     = _MB_WEBLINKS_MORE;

	$gm_links      = array();
	$show_webmap   = false;
	$webmap_div_id = '';
	$webmap_func   = '';
	$webmap_style  = '';

// config
	$conf =& weblinks_get_config( $DIRNAME );
	if ( !isset($conf['broken_threshold']) )
	{	return $block;	}

	$broken = $conf['broken_threshold'];

	$link_param = array(
		'order'            => $order,
		'title_length'     => $title_length,
		'cat_title_length' => $cat_title_length,
		'desc_length'      => $desc_length,
		'newdays'          => $newdays,
		'popular'          => $popular,
		'max_width'        => $max_width,
		'width_default'    => $width_default,

// hack for multi language
		'is_japanese_site' => weblinks_multi_is_japanese_site(),
	);

	$rows1 = $this->get_rows_order_in_link( $order, $broken, $limit );
	if ( !is_array($rows1) || !count($rows1) ) {
		return $block;
	}

	foreach ( $rows1 as $row1 ) {
		$lid_array[] = $row1['lid'];
		$link = $this->build_link($row1, $link_param);
		$block['links'][] = $link;

		if ( $link['google_use'] ) {
			$gm_links[] = $link;
		}
	}

// randum recommend link
	if ( $SHOW_RECOMMEND && $LIMIT_RECOMMEND )
	{
		$rows3 = $this->get_rows_recommend_in_link( $broken, $LIMIT_RECOMMEND );
		if ( !is_array($rows3) || !count($rows3) ) {
			return $block;
		}

		foreach ( $rows3 as $row3 ) {
			$link = $thos->build_link($row3, $link_param);
			$block['recommend_links'][] = $link;

// not in latest link
			if ( !in_array($row3['lid'], $lid_array)&& $link['google_use'] ) {
				$gm_links[] = $link;
			}
		}
	}

	$block['show_recommend'] = $SHOW_RECOMMEND;

// google map
	$gm_name  = $DIRNAME . '_b_' .$order;
	$gm_param = array(
		'dirname'      => $DIRNAME ,
		'latitude'     => $gm_latitude,
		'longitude'    => $gm_longitude,
		'zoom'         => $gm_zoom,
		'name'         => $gm_name,
		'mode'         => $gm_mode,
		'style_height' => $gm_height ,
		'links'        => $gm_links ,
		'conf'         => $conf ,
	);

	$webmap_param = $this->_webmap_class->build_map_block( $gm_param );
	if ( is_array($webmap_param) ) {
		$show_webmap   = $webmap_param['show_webmap'];
		$webmap_div_id = $webmap_param['webmap_div_id'];
		$webmap_func   = $webmap_param['webmap_func'];
		$webmap_style  = $webmap_param['webmap_style'];
	}

	$block['show_webmap']    = $show_webmap;
	$block['webmap_div_id']  = $webmap_div_id;
	$block['webmap_func']    = $webmap_func;
	$block['webmap_style']   = $webmap_style;
	$block['webmap_timeout'] = $gm_timeout;

	return $block;
}

function top_edit($options) 
{
	$DIRNAME = empty( $options[0] ) ? basename( dirname( dirname( __FILE__ ) ) ) : $options[0];
	$order            = $options[1];
	$limit            = intval($options[2]);
	$title_length     = intval($options[3]);
	$cat_title_length = intval($options[4]);
	$desc_length      = intval($options[5]);
	$newdays          = intval($options[6]);
	$popular          = intval($options[7]);
	$max_width        = intval($options[8]);
	$width_default    = intval($options[9]);

	$gm_mode         = isset($options[10]) ? intval($options[10])   : 0;
	$gm_latitude     = isset($options[11]) ? floatval($options[11]) : 0;
	$gm_longitude    = isset($options[12]) ? floatval($options[12]) : 0;
	$gm_zoom         = isset($options[13]) ? intval($options[13])   : 0;
	$gm_height       = isset($options[14]) ? intval($options[14])   : 0;
	$gm_timeout      = isset($options[15]) ? intval($options[15])   : 0;
	$gm_desc_length  = isset($options[16]) ? intval($options[16])   : 0;
	$gm_wordwrap     = isset($options[17]) ? intval($options[17])   : 0;
	$gm_marker_width = isset($options[18]) ? intval($options[18])   : 0;
	$gm_control      = isset($options[19]) ? intval($options[19])   : 1;
	$gm_type_control = isset($options[20]) ? intval($options[20])   : 1;

	$form  = "<table><tr><td>";
	$form .= "Module Directory: ";
	$form .= "</td><td>";
	$form .= $DIRNAME." ";
	$form .= '<input type="hidden" name="options[0]" value="'. $DIRNAME .'" />'."\n";
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_ORDER;
	$form .= "</td><td>";
	$form .= $options[1]." ";
	$form .= '<input type="hidden" name="options[1]" value="'. $order .'" />'."\n";
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_DISP;
	$form .= "</td><td>";
	$form .= '<input type="text" name="options[2]" value="'. $limit .'" />'."\n";
	$form .= "&nbsp;". _MB_WEBLINKS_LINKS ."\n";
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_CHARS;
	$form .= "</td><td>";
	$form .= '<input type="text" name="options[3]" value="'. $title_length .'" />'."\n";
	$form .= "&nbsp;". _MB_WEBLINKS_LENGTH  ."\n";
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_CAT_TITLE_LENGTH;
	$form .= "</td><td>";
	$form .= '<input type="text" name="options[4]" value="'. $cat_title_length .'" />'."\n";
	$form .= "&nbsp;". _MB_WEBLINKS_LENGTH  ."\n";
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_MAX_DESC;
	$form .= "</td><td>";
	$form .= '<input type="text" name="options[5]" value="'. $desc_length .'" />'."\n";
	$form .= "&nbsp;". _MB_WEBLINKS_LENGTH  ."\n";
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_NEWDAYS;
	$form .= "</td><td>";
	$form .= '<input type="text" name="options[6]" value="'. $newdays .'" />'."\n";
	$form .= "&nbsp;". _MB_WEBLINKS_DAYS ."\n";
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_POPULAR;
	$form .= "</td><td>";
	$form .= '<input type="text" name="options[7]" value="'. $popular .'" />'."\n";
	$form .= "&nbsp;". _MB_WEBLINKS_HITS ."\n";
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_MAX_WIDTH;
	$form .= "</td><td>";
	$form .= '<input type="text" name="options[8]" value="'. $max_width .'" />'."\n";
	$form .= "&nbsp;". _MB_WEBLINKS_PIXEL ."\n";
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_WIDTH_DEFAULT;
	$form .= "</td><td>";
	$form .= '<input type="text" name="options[9]" value="'. $width_default .'" />'."\n";
	$form .= "&nbsp;". _MB_WEBLINKS_PIXEL ."\n";
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_GM_MODE;
	$form .= "</td><td>";
	$form .= '<input type="text" name="options[10]" value="'. $gm_mode .'" />'."\n";
	$form .= _MB_WEBLINKS_GM_MODE_DSC;
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_GM_LATITUDE;
	$form .= "</td><td>";
	$form .= '<input type="text" name="options[11]" value="'. $gm_latitude .'" />'."\n";
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_GM_LONGITUDE;
	$form .= "</td><td>";
	$form .= '<input type="text" name="options[12]" value="'. $gm_longitude .'" />'."\n";
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_GM_ZOOM;
	$form .= "</td><td>";
	$form .= '<input type="text" name="options[13]" value="'. $gm_zoom .'" />'."\n";
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_GM_HEIGHT;
	$form .= "</td><td>";
	$form .= '<input type="text" name="options[14]" value="'. $gm_height .'" />'."\n";
	$form .= _MB_WEBLINKS_PIXEL;
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_GM_TIMEOUT;
	$form .= "</td><td>";
	$form .= '<input type="text" name="options[15]" value="'. $gm_timeout .'" />'."\n";
	$form .= _MB_WEBLINKS_GM_TIMEOUT_DSC;
	$form .= "</td></tr>\n";

//	$form .= "<tr><td>";
//	$form .= _MB_WEBLINKS_GM_DESC_LENGTH;
//	$form .= "</td><td>";
//	$form .= '<input type="text" name="options[16]" value="'. $gm_desc_length .'" />'."\n";
//	$form .= "&nbsp;". _MB_WEBLINKS_LENGTH  ."\n";
//	$form .= "</td></tr>\n<tr><td>";
//	$form .= _MB_WEBLINKS_GM_WORDWRAP;
//	$form .= "</td><td>";
//	$form .= '<input type="text" name="options[17]" value="'. $gm_wordwrap .'" />'."\n";
//	$form .= "&nbsp;". _MB_WEBLINKS_LENGTH  ."\n";
//	$form .= "</td></tr>\n<tr><td>";
//	$form .= _MB_WEBLINKS_GM_MARKER_WIDTH;
//	$form .= "</td><td>";
//	$form .= '<input type="text" name="options[18]" value="'. $gm_marker_width .'" />'."\n";
//	$form .= "&nbsp;". _MB_WEBLINKS_PIXEL ."\n";
//	$form .= "</td></tr>\n<tr><td>";
//	$form .= _MB_WEBLINKS_GM_CONTROL;
//	$form .= "</td><td>";
//	$form .= '<input type="text" name="options[19]" value="'. $gm_control .'" />'."\n";
//	$form .= _MB_WEBLINKS_GM_CONTROL_DSC;
//	$form .= "</td></tr>\n<tr><td>";
//	$form .= _MB_WEBLINKS_GM_TYPE_CONTROL;
//	$form .= "</td><td>";
//	$form .= '<input type="text" name="options[20]" value="'. $gm_type_control .'" />'."\n";
//	$form .= _MB_WEBLINKS_GM_CONTROL_DSC;
//	$form .= "</td></tr>";

// MUST be described as the turn of a number. 
	$form .= "<tr><td></td><td>\n";
	$form .= '<input type="hidden" name="options[16]" value="'. $gm_desc_length .'" />'."\n";
	$form .= '<input type="hidden" name="options[17]" value="'. $gm_wordwrap .'" />'."\n";
	$form .= '<input type="hidden" name="options[18]" value="'. $gm_marker_width .'" />'."\n";
	$form .= '<input type="hidden" name="options[19]" value="'. $gm_control .'" />'."\n";
	$form .= '<input type="hidden" name="options[20]" value="'. $gm_type_control .'" />'."\n";
	$form .= "</td></tr>\n";

	$form .= "</table>\n";
	return $form;

}

//---------------------------------------------------------
// $options
// [0] module directory name (weblinks)
// [1] number of display links (5)
// [2] max length of title (30)
//       -1: unlimited, 0: not show
// [3] max length of category title (0)
//       when -1, unlimited
// [4] max length of description (0)
//       0: not show
// [5] days to show new icon (0)
//       when 0, not show
// [6] hits to show popular icon (0)
//       when 0, not show
// [7] max width of banner image (50)
//       when 0, not show
// [8] default width of banner image (50)
//       when 0, use original size
// [9] flag of showing date (0)
// [10] mode of showing url (1)
//      0: singlelink.php, 1: visit.php, 2: url of link
// [11] flag of exclude empty url (1)
//      0: include empty url, 1: exclude empty url 
// [12] category id (0)
// [13] flag of sub categories (1)
//       0: without sub, 1: with sub
// [14] mode (-/recommend/mutual)
// [15] flag of random link (1)
//       0: normal, 1: random
//
// following parameter is valid, when flag of random link is normal
// [16] order (lid/time_update/time_create/hits/rating/title)
// [17] sort  (ASC/DESC)
//
// [18] google map mode (0)
//       when 0, not show
//       when 1, use config latitude/longitude/zoom
//       when 2, use following value
// [19] google map latitude  (0)
// [20] google map longitude (0)
// [21] google map zoom      (0)
// [22] google map height  (300) px
// [23] google map timeout (1000) msec
//       when -1, use window.onload
// [24] google map max length of description (100)
//       when -1, unlimited
// [25] google map length of wordwrap (30)
//       when -1, unlimited:
// [26] google map marker width (150) px
//       when -1, unlimited:
// [27] google map control (1)
//       when 0, not show
//       when 1, show (GSmallMapControl)
// [28] google map type control (1)
//       when 0, not show
//       when 1, show
//
// latest: dirname|10|30|0|0|7|0|50|50|1|0|0|0|1|-|0|time_update|DESC|0|0|0|0|300|1000|100|50
// random: dirname|5 |30|0|0|0|0|50|50|0|1|1|0|1|-|1|lid        |ASC|0|0|0|0|300|1000|100|50
//
// 2006-11-03 hiro <http://ishinomaki.cc/>
//---------------------------------------------------------
function generic_show($options) 
{
	$DIRNAME = empty( $options[0] ) ? basename( dirname( dirname( __FILE__ ) ) ) : $options[0];
	$limit            = intval($options[1]);
	$title_length     = intval($options[2]);
	$cat_title_length = intval($options[3]);
	$desc_length      = intval($options[4]);
	$newdays          = intval($options[5]);
	$popular          = intval($options[6]);
	$max_width        = intval($options[7]);
	$width_default    = intval($options[8]);
	$show_date        = intval($options[9]);
	$show_mode_url    = intval($options[10]);
	$flag_url_empty   = intval($options[11]);
	$cid              = intval($options[12]);
	$flag_subcat      = intval($options[13]);
	$mode_link        = $options[14];
	$flag_random      = intval($options[15]);
	$order            = $options[16];
	$sort             = $options[17];

	$gm_mode         = isset($options[18]) ? intval($options[18])   : 0;
	$gm_latitude     = isset($options[19]) ? floatval($options[19]) : 0;
	$gm_longitude    = isset($options[20]) ? floatval($options[20]) : 0;
	$gm_zoom         = isset($options[21]) ? intval($options[21])   : 0;
	$gm_height       = isset($options[22]) ? intval($options[22])   : 0;
	$gm_timeout      = isset($options[23]) ? intval($options[23])   : 0;

// use config value
//	$gm_desc_length  = isset($options[24]) ? intval($options[24])   : 0;
//	$gm_wordwrap     = isset($options[25]) ? intval($options[25])   : 0;
//	$gm_marker_width = isset($options[26]) ? intval($options[26])   : 0;

// NOT use
//	$gm_control      = isset($options[27]) ? intval($options[27])   : 1;
//	$gm_type_control = isset($options[28]) ? intval($options[28])   : 1;

	if (($order != 'time_update')&&
	    ($order != 'time_create')&&
	    ($order != 'hits')&&
	    ($order != 'rating')&&
	    ($order != 'title')) {
		$order = 'lid';
	}

	if ($sort != 'DESC') {
		$sort = 'ASC';
	}

	if (($mode_link != 'recommend')&&($mode_link != 'mutual')) {
		$mode_link = '';
	}

	$show_title = 1;
	if ($title_length == 0) {
		$show_title = 0;
	}

	$gm_links      = array();
	$show_webmap   = false;
	$webmap_div_id = '';
	$webmap_func   = '';
	$webmap_style  = '';

	$block = array();
	$block['dirname']       = $DIRNAME;
	$block['lang_hits']     = _MB_WEBLINKS_HITS;
	$block['lang_rating']   = _MB_WEBLINKS_RATING;
	$block['lang_votes']    = _MB_WEBLINKS_VOTES;
	$block['lang_comments'] = _MB_WEBLINKS_COMMENTS;
	$block['lang_random']   = _MB_WEBLINKS_RANDOM;
	$block['show_title']    = $show_title;
	$block['show_date']     = $show_date;
	$block['show_mode_url'] = $show_mode_url;

// config
	$conf =& weblinks_get_config( $DIRNAME );
	if ( !isset($conf['broken_threshold']) ) {	
		return $block;
	}

	$link_param = array(
		'order'            => $order,
		'title_length'     => $title_length,
		'desc_length'      => $desc_length,
		'cat_title_length' => $cat_title_length,
		'newdays'          => $newdays,
		'popular'          => $popular,
		'max_width'        => $max_width,
		'width_default'    => $width_default,
	);

	$sql_param = array(
		'flag_url_empty' => $flag_url_empty,
		'flag_subcat'    => $flag_subcat,
		'flag_random'    => $flag_random,
		'mode_link'      => $mode_link,
		'cid'            => $cid,
		'order'          => $order,
		'sort'           => $sort,
		'limit'          => $limit,
		'broken'         => $conf['broken_threshold'],
	);

	$rows = $this->get_rows_generic_in_link( $sql_param );
	if ( !is_array($rows) || !count($rows) ) {
		return $block;
	}

	foreach ($rows as $row ) {
		$link = $this->build_link( $row, $link_param );
		$block['links'][] = $link;

		if ( $link['google_use'] ) {
			$gm_links[] = $link;
		}
	}

// google map
	$gm_name  = $DIRNAME . '_b_g_' .$order;
	$gm_param = array(
		'dirname'      => $DIRNAME ,
		'latitude'     => $gm_latitude,
		'longitude'    => $gm_longitude,
		'zoom'         => $gm_zoom,
		'name'         => $gm_name,
		'mode'         => $gm_mode,
		'style_height' => $gm_height ,
		'links'	       => $gm_links ,
		'conf'         => $conf ,
	);

	$webmap_param = $this->_webmap_class->build_map_block( $gm_param );
	if ( is_array($webmap_param) ) {
		$show_webmap   = $webmap_param['show_webmap'];
		$webmap_div_id = $webmap_param['webmap_div_id'];
		$webmap_func   = $webmap_param['webmap_func'];
		$webmap_style  = $webmap_param['webmap_style'];
	}

	$block['show_webmap']    = $show_webmap;
	$block['webmap_div_id']  = $webmap_div_id;
	$block['webmap_func']    = $webmap_func;
	$block['webmap_style']   = $webmap_style;
	$block['webmap_timeout'] = $gm_timeout;

	return $block;
}

function generic_edit($options)
{

// base on W3C
	$SELECTED = 'selected="selected"';
	$CHECKED  = 'checked="checked"';

	$DIRNAME = empty( $options[0] ) ? basename( dirname( dirname( __FILE__ ) ) ) : $options[0];

// config init before get_handler(category)
	$config_handler =& weblinks_get_handler( 'config2_basic',  $DIRNAME );
	$config_handler->init();

	$category_handler =& weblinks_get_handler( 'category_basic', $DIRNAME );
	$category_handler->load_once();

	$DIRNAME = empty( $options[0] ) ? basename( dirname( dirname( __FILE__ ) ) ) : $options[0];
	$limit            = intval($options[1]);
	$title_length     = intval($options[2]);
	$cat_title_length = intval($options[3]);
	$desc_length      = intval($options[4]);
	$newdays          = intval($options[5]);
	$popular          = intval($options[6]);
	$max_width        = intval($options[7]);
	$width_default    = intval($options[8]);
	$show_date        = intval($options[9]);
	$show_mode_url    = intval($options[10]);
	$flag_url_empty   = intval($options[11]);
	$cid              = intval($options[12]);
	$flag_subcat      = intval($options[13]);
	$mode_link        = $options[14];
	$flag_random      = intval($options[15]);
	$order            = $options[16];
	$sort             = $options[17];

	$gm_mode         = isset($options[18]) ? intval($options[18])   : 0;
	$gm_latitude     = isset($options[19]) ? floatval($options[19]) : 0;
	$gm_longitude    = isset($options[20]) ? floatval($options[20]) : 0;
	$gm_zoom         = isset($options[21]) ? intval($options[21])   : 0;
	$gm_height       = isset($options[22]) ? intval($options[22])   : 0;
	$gm_timeout      = isset($options[23]) ? intval($options[23])   : 0;
	$gm_desc_length  = isset($options[24]) ? intval($options[24])   : 0;
	$gm_wordwrap     = isset($options[25]) ? intval($options[25])   : 0;
	$gm_marker_width = isset($options[26]) ? intval($options[26])   : 0;
	$gm_control      = isset($options[27]) ? intval($options[27])   : 1;
	$gm_type_control = isset($options[28]) ? intval($options[28])   : 1;

// show date
	$date_checked_0 = '';
	$date_checked_1 = '';
	if ( $show_date == 1 ) {
		$date_checked_1 = $CHECKED;
	} else {
		$date_checked_0 = $CHECKED;
	}

// mode url
	$url_sel_0 = '';
	$url_sel_1 = '';
	$url_sel_2 = '';
	if ( $show_mode_url == 1 ) {
		$url_sel_1 = $SELECTED;
	} elseif ( $show_mode_url == 2 ) {
		$url_sel_2 = $SELECTED;
	} else {
		$url_sel_0 = $SELECTED;
	}

// url empty
	$empty_checked_0 = '';
	$empty_checked_1 = '';
	if ( $flag_url_empty == 1 ) {
		$empty_checked_1 = $CHECKED ;
	} else {
		$empty_checked_0 = $CHECKED ;
	}

// category
	$selbox = $category_handler->build_selbox( $cid, 1, "options[12]" );

// sub category
	$subcat_checked_0 = '';
	$subcat_checked_1 = '';
	if ( $flag_subcat == 1 ) {
		$subcat_checked_1 = $CHECKED ;
	} else {
		$subcat_checked_0 = $CHECKED ;
	}

// mode
	$mode_sel_recommend = '';
	$mode_sel_mutual    = '';
	if ( $mode_link == 'recommend' ) {
		$mode_sel_recommend = $SELECTED;
	} elseif ( $mode_link == 'mutual' ) {
		$mode_sel_mutual = $SELECTED;
	}

// random
	$random_checked_0 = '';
	$random_checked_1 = '';
	if ( $flag_random == 1 ) {
		$random_checked_1 = $CHECKED ;
	} else {
		$random_checked_0 = $CHECKED ;
	}

// order
	$order_sel_lid    = '';
	$order_sel_update = '';
	$order_sel_create = '';
	$order_sel_hits   = '';
	$order_sel_rating = '';
	$order_sel_title  = '';
	if ( $order == 'time_update' ) {
		$order_sel_update = $SELECTED;
	} elseif ( $order == 'time_create' ) {
		$order_sel_create = $SELECTED;
	} elseif ( $order == 'hits' ) {
		$order_sel_hits = $SELECTED;
	} elseif ( $order == 'rating' ) {
		$order_sel_rating = $SELECTED;
	} elseif ( $order == 'title' ) {
		$order_sel_title = $SELECTED;
	} else {
		$order_sel_lid = $SELECTED;
	}

// sort
	$sort_sel_asc  = '';
	$sort_sel_desc = '';
	if ( $sort == 'DESC' ) {
		$sort_sel_desc = $SELECTED;
	} else {
		$sort_sel_asc = $SELECTED;
	}

	$form  = "<table><tr><td>";
	$form .= "Module Directory ";
	$form .= "</td><td>";
	$form .= $DIRNAME." ";
	$form .= '<input type="hidden" name="options[0]" value="'. $DIRNAME .'" />'."\n";
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_DISP;
	$form .= "</td><td>";
	$form .= '<input type="text" name="options[1]" value="'. $limit .'" />'."\n";
	$form .= "&nbsp;". _MB_WEBLINKS_LINKS ."\n";
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_CHARS;
	$form .= "</td><td>";
	$form .= '<input type="text" name="options[2]" value="'. $title_length .'" />'."\n";
	$form .= "&nbsp;". _MB_WEBLINKS_LENGTH  ."\n";
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_CAT_TITLE_LENGTH;
	$form .= "</td><td>";
	$form .= '<input type="text" name="options[3]" value="'. $cat_title_length .'" />'."\n";
	$form .= "&nbsp;". _MB_WEBLINKS_LENGTH  ."\n";
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_MAX_DESC;
	$form .= "</td><td>";
	$form .= '<input type="text" name="options[4]" value="'. $desc_length .'" />'."\n";
	$form .= "&nbsp;". _MB_WEBLINKS_LENGTH  ."\n";
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_NEWDAYS;
	$form .= "</td><td>";
	$form .= '<input type="text" name="options[5]" value="'. $newdays .'" />'."\n";
	$form .= "&nbsp;". _MB_WEBLINKS_DAYS ."\n";
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_POPULAR;
	$form .= "</td><td>";
	$form .= '<input type="text" name="options[6]" value="'. $popular .'" />'."\n";
	$form .= "&nbsp;". _MB_WEBLINKS_HITS ."\n";
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_MAX_WIDTH;
	$form .= "</td><td>";
	$form .= '<input type="text" name="options[7]" value="'. $max_width .'" />'."\n";
	$form .= "&nbsp;". _MB_WEBLINKS_PIXEL ."\n";
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_WIDTH_DEFAULT;
	$form .= "</td><td>";
	$form .= '<input type="text" name="options[8]" value="'. $width_default .'" />'."\n";
	$form .= "&nbsp;". _MB_WEBLINKS_PIXEL ."\n";
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_SHOW_DATE;
	$form .= "</td><td>";
	$form .= '<input type="radio" name="options[9]" value="1" '. $date_checked_1 .' />'."\n";
	$form .= "&nbsp;". _YES ."\n";

// BUG 4680: dont work radio button
	$form .= '<input type="radio" name="options[9]" value="0" '. $date_checked_0 .' />'."\n";

	$form .= "&nbsp;". _NO ."\n";
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_MODE_URL;
	$form .= "</td><td>";
	$form .= '<select name="options[10]">'."\n";
	$form .= '<option value="0" '. $url_sel_0 .'>';
	$form .= _MB_WEBLINKS_MODE_URL_SINGLE;
	$form .= "</option>\n";
	$form .= '<option value="1" '. $url_sel_1 .'>';
	$form .= _MB_WEBLINKS_MODE_URL_VISIT;
	$form .= "</option>\n";
	$form .= '<option value="2" '. $url_sel_2 .'>';
	$form .= _MB_WEBLINKS_MODE_URL_DIRECT;
	$form .= "</option>\n";
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_URL_EMPTY;
	$form .= "</td><td>";
	$form .= '<input type="radio" name="options[11]" value="0" '. $empty_checked_0 .' />'."\n";
	$form .= "&nbsp;". _MB_WEBLINKS_URL_EMPTY_INCLUDE ."\n";
	$form .= '<input type="radio" name="options[11]" value="1" '. $empty_checked_1 .' />'."\n";
	$form .= "&nbsp;". _MB_WEBLINKS_URL_EMPTY_EXCLUDE ."\n";
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_CATEGORY;
	$form .= "</td><td>";
	$form .= $selbox;
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_WITH_SUBCAT;
	$form .= "</td><td>";
	$form .= '<input type="radio" name="options[13]" value="1" '. $subcat_checked_1 .' />'."\n";
	$form .= "&nbsp;". _YES ."\n";
	$form .= '<input type="radio" name="options[13]" value="0" '. $subcat_checked_0 .' />'."\n";
	$form .= "&nbsp;". _NO ."\n";
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_MODE;
	$form .= "</td><td>";
	$form .= '<select name="options[14]">'."\n";
	$form .= '<option value="-">---</option>'."\n";
	$form .= '<option value="recommend" '. $mode_sel_recommend .'>';
	$form .= _MB_WEBLINKS_RECOMMEND;
	$form .= "</option>\n";
	$form .= '<option value="mutual" '. $mode_sel_mutual .'>';
	$form .= _MB_WEBLINKS_MUTUAL;
	$form .= "</option>\n";
	$form .= "</select>\n";
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_RANDOM;
	$form .= "</td><td>";
	$form .= '<input type="radio" name="options[15]" value="1" '. $random_checked_1 .' />'."\n";
	$form .= "&nbsp;". _YES ."\n";
	$form .= '<input type="radio" name="options[15]" value="0" '. $random_checked_0 .' />'."\n";
	$form .= "&nbsp;". _NO ."\n";
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_ORDER;
	$form .= "</td><td>";
	$form .= _MB_WEBLINKS_ORDER_DESC ."<br />\n";;
	$form .= '<select size="1" name="options[16]">'."\n";
	$form .= '<option value="lid" '. $order_sel_lid .'>';
	$form .= _MB_WEBLINKS_LINK_ID;
	$form .= "</option>\n";
	$form .= '<option value="time_update" '. $order_sel_update .'>';
	$form .= _MB_WEBLINKS_TIME_UPDATE;
	$form .= "</option>\n";
	$form .= '<option value="time_create" '. $order_sel_create .'>';
	$form .= _MB_WEBLINKS_TIME_CREATE;
	$form .= "</option>\n";
	$form .= '<option value="hits" '. $order_sel_hits .'>';
	$form .= _MB_WEBLINKS_HITS;
	$form .= "</option>\n";
	$form .= '<option value="rating" '. $order_sel_rating .'>';
	$form .= _MB_WEBLINKS_RATING;
	$form .= "</option>\n";
	$form .= '<option value="title" '. $order_sel_title .'>';
	$form .= _MB_WEBLINKS_TITLE;
	$form .= "</option>\n";
	$form .= "</select> \n";
	$form .= '<select size="1" name="options[17]">'."\n";
	$form .= '<option value="ASC" '. $sort_sel_asc .'>';
	$form .= _MB_WEBLINKS_ASC;
	$form .= "</option>\n";
	$form .= '<option value="DESC" '. $sort_sel_desc .'>';
	$form .= _MB_WEBLINKS_DESC;
	$form .= "</option>\n";
	$form .= "</select>\n";
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_GM_MODE;
	$form .= "</td><td>";
	$form .= '<input type="text" name="options[18]" value="'. $gm_mode  .'" />'."\n";
	$form .= _MB_WEBLINKS_GM_MODE_DSC;
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_GM_LATITUDE;
	$form .= "</td><td>";
	$form .= '<input type="text" name="options[19]" value="'. $gm_latitude .'" />'."\n";
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_GM_LONGITUDE;
	$form .= "</td><td>";
	$form .= '<input type="text" name="options[20]" value="'. $gm_longitude .'" />'."\n";
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_GM_ZOOM;
	$form .= "</td><td>";
	$form .= '<input type="text" name="options[21]" value="'. $gm_zoom .'" />'."\n";
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_GM_HEIGHT;
	$form .= "</td><td>";
	$form .= '<input type="text" name="options[22]" value="'. $gm_height .'" />'."\n";
	$form .= _MB_WEBLINKS_PIXEL;
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_GM_TIMEOUT;
	$form .= "</td><td>";
	$form .= '<input type="text" name="options[23]" value="'. $gm_timeout .'" />'."\n";
	$form .= _MB_WEBLINKS_GM_TIMEOUT_DSC;
	$form .= "</td></tr>\n";

//	$form .= "<tr><td>";
//	$form .= _MB_WEBLINKS_GM_DESC_LENGTH;
//	$form .= "</td><td>";
//	$form .= '<input type="text" name="options[24]" value="'. $gm_desc_length .'" />'."\n";
//	$form .= "&nbsp;". _MB_WEBLINKS_LENGTH  ."\n";
//	$form .= "</td></tr>\n<tr><td>";
//	$form .= _MB_WEBLINKS_GM_WORDWRAP;
//	$form .= "</td><td>";
//	$form .= '<input type="text" name="options[25]" value="'. $gm_wordwrap .'" />'."\n";
//	$form .= "&nbsp;". _MB_WEBLINKS_LENGTH  ."\n";
//	$form .= "</td></tr>\n<tr><td>";
//	$form .= _MB_WEBLINKS_GM_MARKER_WIDTH;
//	$form .= "</td><td>";
//	$form .= '<input type="text" name="options[26]" value="'. $gm_marker_width .'" />'."\n";
//	$form .= "&nbsp;". _MB_WEBLINKS_PIXEL ."\n";
//	$form .= "</td></tr>\n<tr><td>";
//	$form .= _MB_WEBLINKS_GM_CONTROL;
//	$form .= "</td><td>";
//	$form .= '<input type="text" name="options[27]" value="'. $gm_control .'" />'."\n";
//	$form .= _MB_WEBLINKS_GM_CONTROL_DSC;
//	$form .= "</td></tr>\n<tr><td>";
//	$form .= _MB_WEBLINKS_GM_TYPE_CONTROL;
//	$form .= "</td><td>";
//	$form .= '<input type="text" name="options[28]" value="'. $gm_type_control .'" />'."\n";
//	$form .= _MB_WEBLINKS_GM_CONTROL_DSC;
//	$form .= "</td></tr>";

// MUST be described as the turn of a number. 
	$form .= "<tr><td></td><td>\n";
	$form .= '<input type="hidden" name="options[24]" value="'. $gm_desc_length .'" />'."\n";	
	$form .= '<input type="hidden" name="options[25]" value="'. $gm_wordwrap .'" />'."\n";
	$form .= '<input type="hidden" name="options[26]" value="'. $gm_marker_width .'" />'."\n";
	$form .= '<input type="hidden" name="options[27]" value="'. $gm_control .'" />'."\n";
	$form .= '<input type="hidden" name="options[28]" value="'. $gm_type_control .'" />'."\n";
	$form .= "</td></tr>\n";

	$form .= "</table>\n";
	return $form;
}

//---------------------------------------------------------
// build link
//---------------------------------------------------------
function build_link( $row, $param )
{
	$this->set_vars(   $row );
	$this->set_params( $param );
	$this->set_multi();

	$lid = $row['lid'];

	list( $google_use, $google_cid, $google_icon ) 
		= $this->get_google_use_icon( $row );

	list( $show_cat_title, $cid, $cat_title, $cat_title_disp )
		= $this->get_cat_title_disp( $lid, $google_cid, $param );

	list( $show_title, $title_disp ) = $this->get_block_title_disp();
	list( $show_desc, $desc_short, $desc_html ) = $this->get_block_desc_disp();
	list( $hits_disp, $rating_disp )  = $this->get_block_hits_disp();
	list( $show_banner, $banner_width ) = $this->get_block_banner_disp();
	list( $show_new, $show_update ) = $this->get_show_new_update();

	$arr = array(
		'id'             => $lid,
		'cid'            => $cid,
		'hits_disp'      => $hits_disp,
		'banner_width'   => $banner_width,
		'rating_disp'    => $rating_disp ,
		'title_disp'     => $title_disp,
		'cat_title_disp' => $cat_title_disp,
		'desc_html'      => $desc_html,
		'desc_short'     => $desc_short,
		'google_icon'    => $google_icon,
		'google_use'     => $google_use,
		'url_s'          => $this->sanitize_url( $row['url'] ),
		'banner_s'       => $this->sanitize_url( $row['banner'] ),
		'date_short'     => formatTimestamp( $row['time_update'], 's'),
		'name_disp'      => $this->get_name_disp(),
		'mail_disp'      => $this->get_mail_disp(),

		'show_title'     => $show_title,
		'show_cat_title' => $show_cat_title,
		'show_desc'      => $show_desc,
		'show_banner'    => $show_banner,
		'show_new'       => $show_new,
		'show_update'    => $show_update,
		'show_pop'       => $this->get_show_popular(),
	);

	$link = $row + $arr;
	return $link;
}
//---------------------------------------------------------
// cat title
//---------------------------------------------------------
function get_cat_title_disp( $lid, $google_cid, $param ) 
{
	$cat_title_length = $param['cat_title_length'];

	$show_cat_title = false;
	$cid            = 0;
	$cat_title      = '';
	$cat_title_disp = '';

	if ( $cat_title_length != 0 ) {
		$show_cat_title = true;
		list( $cid, $cat_title ) = $this->get_cat_title( $lid, $google_cid );
		$cat_title_disp = $this->build_summary( $cat_title, $cat_title_length );
	}

	return array( $show_cat_title, $cid, $cat_title, $cat_title_disp );
}

function get_cat_title( $lid, $google_cid )
{
	if ( $google_cid > 0 ) {
		$cid = $google_cid;
	} else {
		$cid = $this->get_cid_in_catlink( $lid );
	}
	$row = $this->get_cached_row_in_category( $cid );
	return array( $cid, $row['title'] );
}

//---------------------------------------------------------
// google map
//---------------------------------------------------------
function get_google_use_icon( $row )
{
	$google_use  = false;
	$google_cid  = 0;
	$google_icon = 0;
	if ( $this->_webmap_class->check_latlng_by_row( $row ) ) {
		$google_use = true;
		list( $google_cid, $google_icon ) = $this->find_google_icon( $row );
	}
	return array( $google_use, $google_cid, $google_icon );
}

function find_google_icon( $link_row )
{
// find in link
	if ( $link_row['gm_icon'] > 0 ) {
		return array( 0, $link_row['gm_icon'] );
	}

	$cid_array = $this->get_cid_array_in_catlink( $link_row['lid'] );
	foreach ($cid_array as $cid) {
		$cat_row = $this->get_cached_row_in_category( $cid );

// find in category
		if ( $cat_row['gm_icon'] > 0 ) {
			return array( $cid, $cat_row['gm_icon'] );
		}
	}

// not find
	return array( 0, 0 );
}

//---------------------------------------------------------
// link table
//---------------------------------------------------------
function get_rows_order_in_link( $order, $broken, $limit ) 
{
	$where = weblinks_get_where_public( $broken );

	$sql  = "SELECT * FROM ".$this->_table_link;
	$sql .= " WHERE ".$where;
	$sql .= " ORDER BY ".$order." DESC";

	return $this->get_rows_by_sql($sql, $limit);
}

function get_rows_recommend_in_link( $broken, $limit ) 
{
	$where  = weblinks_get_where_public( $broken );
	$where .= 'AND ( recommend = 1 ) ';
	
	$sql  = "SELECT * FROM ".$this->_table_link;
	$sql .= " WHERE ".$where;
	$sql .= " ORDER BY rand()";

	return $this->get_rows_by_sql($sql, $limit);
}

function get_rows_generic_in_link( $param ) 
{
	$flag_url_empty = $param['flag_url_empty'];
	$flag_subcat    = $param['flag_subcat'];
	$flag_random    = $param['flag_random'];
	$mode_link      = $param['mode_link'];
	$cid            = $param['cid'];
	$order          = $param['order'];
	$sort           = $param['sort'];
	$broken         = $param['broken'];
	$limit          = $param['limit'];

	$sql_link      = "SELECT l.* FROM ".$this->_table_link." l ";
	$sql_catlink   = '';

	$where_link    = weblinks_get_where_public( $broken, 'l.' );
	$where_catlink = '';
	$where_mode    = '';

// url empty
	if ($flag_url_empty == 1) {
		$where_link .= "AND l.url != '' ";
	}

// all categories ( not specify )
	if (($cid == 0)&&($flag_subcat == 1)) {
		$sql_catlink   = '';
		$where_catlink = '';

// specify category
	} else {
		$sql_catlink  = $this->_table_catlink." cl ON l.lid=cl.lid ";

// parent category only
		if ($flag_subcat == 0) {
			$where_catlink = "cl.cid=".$cid." ";

// parent and all children categories
		} else {
			$cattree = new XoopsTree($this->_table_category, 'cid', 'pid');
			$cid_array = array();
			$cid_array = $cattree->getAllChildId($cid);

			if (count($cid_array) == 0) {
				$cids = $cid;
			} else {
				array_push($cid_array, $cid);	// with parent
				$cids = implode(',', $cid_array);
			}

			$where_catlink = "cl.cid IN(".$cids.") ";
		}
	}

	if ($mode_link) {
		$where_mode = $mode_link."=1 ";
	}

// random mode
	if ( $flag_random ) {
		$sql_orderby = "rand()";

// normal mode
	} elseif ($order != '' && $sort != '') {
		$sql_orderby = "l.".$order." ".$sort;
	}

// build sql
	$sql = $sql_link;

	if ( $sql_catlink ) {
		$sql .= " INNER JOIN ".$sql_catlink;
	}

	$sql .= "WHERE ".$where_link;

	if ( $where_catlink ) {
		$sql .= " AND ".$where_catlink;
	}

	if ( $where_mode ) {
		$sql .= " AND ".$where_mode;
	}

	if ( $sql_orderby ) {
		$sql .= " ORDER BY ".$sql_orderby;
	}

	return $this->get_rows_by_sql($sql, $limit);
}

//---------------------------------------------------------
// catlink table
//---------------------------------------------------------
function get_cid_in_catlink( $lid ) 
{
	$arr = $this->get_cid_array_in_catlink( $lid );
	if ( isset($arr[0]) ) {
		return $arr[0];
	}
	return 0;
}

function get_cid_array_in_catlink( $lid ) 
{
	$cid = 0;
	if ( empty($lid) ) {
		return false;
	}

	$sql  = "SELECT cid FROM " . $this->_table_catlink;
	$sql .= " WHERE lid=" . $lid;
	$sql .= " ORDER BY cid ASC";

	$rows = $this->get_rows_by_sql($sql);
	if ( !is_array($rows) || !count($rows) ) {
		false;
	}

	$arr = array();
	foreach ($rows as $row ) {
		$arr[] = $row['cid'];
	}
	return $arr;
}

//---------------------------------------------------------
// category table
//---------------------------------------------------------
function get_cached_row_in_category( $cid ) 
{
	if ( isset( $this->_cat_cached[ $cid ] ) ) {
		return  $this->_cat_cached[ $cid ];
	}

	$row = $this->get_row_in_category( $cid );
	if ( is_array($row) ) {
		$this->_cat_cached[ $cid ] = $row;
		return $row;
	}

	return null;
}

function get_row_in_category( $cid ) 
{
	if ( empty($cid) ) {	
		return false;	
	}

	$sql  = "SELECT * FROM " . $this->_table_category;
	$sql .= " WHERE cid=" . $cid;

	return $this->get_row_by_sql($sql);
}

//---------------------------------------------------------
// sql
//---------------------------------------------------------
function get_rows_by_sql( $sql, $limit=0, $offset=0 )
{
	$arr = array();

	$res = $this->_db->query( $sql, $limit, $offset );
	if ( !$res ) {
		return false;
	}

	while ( $row = $this->_db->fetchArray($res) ) {
		$arr[] = $row;
	}
	return $arr; 
}

function get_row_by_sql( $sql, $force=false )
{
	$res = $this->_db->query( $sql, 1, 0, $force );
	if ( !$res ) { 
		return false; 
	}

	return $this->_db->fetchArray($res);
}

// --- class end ---
}

// === class end ===
}

?>