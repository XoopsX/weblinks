<?php
// $Id: weblinks_top.php,v 1.1 2012/04/09 10:21:09 ohwada Exp $

// 2010-01-24 K.OHWADA
// name mail

// 2008-02-17 K.OHWADA
// google map type control

// 2007-12-16 K.OHWADA
// not show TOP in build_selbox

// 2007-10-10 K.OHWADA
// block.inc.php
// gm_marker_width

// 2007-09-10 K.OHWADA
// weblinks_get_config()

// 2007-08-11 K.OHWADA
// BUG 4680: dont work radio button

// 2007-08-01 K.OHWADA
// google map in b_weblinks_generic_show()
// happy_linux_sanitize_url()
// time_create

// 2007-06-01 K.OHWADA
// Notice [PHP]: Undefined offset: 8

// 2007-04-08 K.OHWADA
// latest & recommend link

// 2007-03-25 wye & K.OHWADA
// google map

// 2007-03-17 K.OHWADA
// BUG 4508: Fatal error: Call to undefined function: weblinks_get_handler() in blocks/weblinks_top.php

// 2006-11-03 hiro <http://ishinomaki.cc/>
// add b_weblinks_generic_show()

// 2006-05-15 K.OHWADA
// change $moduel_url to $dirname

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication

//=========================================================
// WebLinks Module
// 2004/01/14 K.OHWADA
//=========================================================

$WEBLINKS_DIRNAME = basename( dirname( dirname( __FILE__ ) ) );

include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/sanitize.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/multibyte.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/include/weblinks_constant.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/include/functions.php';

// --- block function begin ---
if( !function_exists( 'b_weblinks_top_show' ) ) 
{

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

function b_weblinks_top_show($options) 
{
	$SHOW_RECOMMEND  = false;
	$LIMIT_RECOMMEND = 3;

	global $xoopsDB;

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

// time_create
	if (($order != 'hits')&&($order != 'rating')&&($order != 'time_create'))
	{
		$order = 'time_update';
	}

	$link_param = array(
		'order'            => $order,
		'title_length'     => $title_length,
		'cat_title_length' => $cat_title_length,
		'desc_length'      => $desc_length,
		'newdays'          => $newdays,
		'popular'          => $popular,
		'max_width'        => $max_width,
		'width_default'    => $width_default,
		'gm_desc_length'   => $gm_desc_length,
		'gm_wordwrap'      => $gm_wordwrap,

// hack for multi language
		'is_japanese_site' => weblinks_multi_is_japanese_site(),
	);

	$lid_array = array();

	$block = array();
	$block['dirname']       = $DIRNAME;
	$block['lang_hits']     = _MB_WEBLINKS_HITS;
	$block['lang_rating']   = _MB_WEBLINKS_RATING;
	$block['lang_votes']    = _MB_WEBLINKS_VOTES;
	$block['lang_comments'] = _MB_WEBLINKS_COMMENTS;
	$block['lang_more']     = _MB_WEBLINKS_MORE;

// hack for multi site
	$table_link     = weblinks_multi_get_table_name( $DIRNAME, 'link' );
	$table_category = weblinks_multi_get_table_name( $DIRNAME, 'category' );
	$table_catlink  = weblinks_multi_get_table_name( $DIRNAME, 'catlink' );

	$gm_name = $DIRNAME . '_b_' .$order;

// config
	$conf =& weblinks_get_config( $DIRNAME );
	if ( !isset($conf['broken_threshold']) )
	{	return $block;	}

// where
	$where1 = weblinks_get_where_public( $conf['broken_threshold'] );

	$sql1  = "SELECT * FROM ".$table_link;
	$sql1 .= " WHERE ".$where1;
	$sql1 .= " ORDER BY ".$order." DESC";

	$res1 = $xoopsDB->query($sql1, $limit, 0);
	if ( !$res1 ) 
	{	return $block;	}

	while( $row1 = $xoopsDB->fetchArray($res1) )
	{
		$lid = $row1['lid'];
		$lid_array[] =  $lid;

		$cid       = 0;
		$cat_title = '';
		if ( $cat_title_length != 0 )
		{
			$cid       = b_weblinks_get_cid_in_catlink(    $table_catlink,  $lid );
			$cat_title = b_weblinks_get_title_in_category( $table_category, $cid );
		}

		$arr              =& $row1;
		$arr['cid']       =  $cid;
		$arr['cat_title'] =  $cat_title;

		$link =& b_weblinks_build_link($arr, $link_param);
		$block['links'][]    = $link;
		$block['gm_links'][] = $link;
	}

// randum recommend link
	if ( $SHOW_RECOMMEND && $LIMIT_RECOMMEND )
	{
		$where3  = $where1;
		$where3 .= 'AND ( recommend = 1 ) ';
		$sql3  = "SELECT * FROM ".$table_link;
		$sql3 .= " WHERE ".$where3;
		$sql3 .= " ORDER BY rand()";

		$res3 = $xoopsDB->query($sql3, $LIMIT_RECOMMEND, 0);
		if ( !$res3 ) 
		{	return $block;	}

		while( $row3 = $xoopsDB->fetchArray($res3) )
		{
			$link =& b_weblinks_build_link($row3, $link_param);
			$block['recommend_links'][] = $link;

// not in latest link
			if ( !in_array($row3['lid'], $lid_array) )
			{
				$block['gm_links'][] = $link;
			}
		}
	}

	$block['show_recommend'] = $SHOW_RECOMMEND;

// google map
	$gm_param = array(
		'gm_mode'      => $gm_mode,
		'gm_latitude'  => $gm_latitude,
		'gm_longitude' => $gm_longitude,
		'gm_zoom'      => $gm_zoom,
	);

	$gm_arr =& b_weblinks_build_gmap( $gm_param, $conf );

	$block['gm_server']       = $conf['gm_server'];
	$block['gm_apikey']       = $conf['gm_apikey'];
	$block['show_gmap']       = $gm_arr['show_gmap'];
	$block['gm_load_server']  = $gm_arr['gm_load_server'];
	$block['gm_load_block']   = $gm_arr['gm_load_block'];
	$block['gm_latitude']     = $gm_arr['gm_latitude'];
	$block['gm_longitude']    = $gm_arr['gm_longitude'];
	$block['gm_zoom']         = $gm_arr['gm_zoom'];
	$block['gm_height']       = $gm_height;
	$block['gm_timeout']      = $gm_timeout;
	$block['gm_name']         = $gm_name;
	$block['gm_marker_width'] = $gm_marker_width;
	$block['gm_control']      = $gm_control;
	$block['gm_type_control'] = $gm_type_control;

	$gmap = '';
	if ( $gm_arr['show_gmap'] )
	{
		$gmap = b_weblinks_fetch_gmap_template( $block );
	}
	$block['gmap'] = $gmap;

	return $block;
}

function b_weblinks_top_edit($options) 
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
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_GM_DESC_LENGTH;
	$form .= "</td><td>";
	$form .= '<input type="text" name="options[16]" value="'. $gm_desc_length .'" />'."\n";
	$form .= "&nbsp;". _MB_WEBLINKS_LENGTH  ."\n";
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_GM_WORDWRAP;
	$form .= "</td><td>";
	$form .= '<input type="text" name="options[17]" value="'. $gm_wordwrap .'" />'."\n";
	$form .= "&nbsp;". _MB_WEBLINKS_LENGTH  ."\n";
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_GM_MARKER_WIDTH;
	$form .= "</td><td>";
	$form .= '<input type="text" name="options[18]" value="'. $gm_marker_width .'" />'."\n";
	$form .= "&nbsp;". _MB_WEBLINKS_PIXEL ."\n";
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_GM_CONTROL;
	$form .= "</td><td>";
	$form .= '<input type="text" name="options[19]" value="'. $gm_control .'" />'."\n";
	$form .= _MB_WEBLINKS_GM_CONTROL_DSC;
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_GM_TYPE_CONTROL;
	$form .= "</td><td>";
	$form .= '<input type="text" name="options[20]" value="'. $gm_type_control .'" />'."\n";
	$form .= _MB_WEBLINKS_GM_CONTROL_DSC;
	$form .= "</td></tr></table>\n";
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

function b_weblinks_generic_show($options) 
{
	include_once XOOPS_ROOT_PATH.'/class/xoopstree.php';

	global $xoopsDB;
	$myts =& MyTextSanitizer::getInstance();

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

	if (($order != 'time_update')&&($order != 'time_create')&&($order != 'hits')&&($order != 'rating')&&($order != 'title'))
	{
		$order = 'lid';
	}

	if ($sort != 'DESC')
	{
		$sort = 'ASC';
	}

	if (($mode_link != 'recommend')&&($mode_link != 'mutual'))
	{
		$mode_link = '';
	}

	$show_title = 1;
	if ($title_length == 0)
	{
		$show_title = 0;
	}

	$table_link     = $xoopsDB->prefix( $DIRNAME."_link" );
	$table_category = $xoopsDB->prefix( $DIRNAME."_category" );
	$table_catlink  = $xoopsDB->prefix( $DIRNAME."_catlink" );

	$gm_name = $DIRNAME . '_b_g_' .$order;

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

	$link_param = array(
		'order'            => $order,
		'title_length'     => $title_length,
		'desc_length'      => $desc_length,
		'cat_title_length' => $cat_title_length,
		'newdays'          => $newdays,
		'popular'          => $popular,
		'max_width'        => $max_width,
		'width_default'    => $width_default,
		'gm_desc_length'   => $gm_desc_length,
		'gm_wordwrap'      => $gm_wordwrap,
	);

// config
	$conf =& weblinks_get_config( $DIRNAME );
	if ( !isset($conf['broken_threshold']) )
	{	return $block;	}

// sql
	$sql_link      = "SELECT l.* FROM ".$table_link." l ";
	$sql_catlink   = '';

	$where_link    = weblinks_get_where_public( $conf['broken_threshold'], 'l.' );
	$where_catlink = '';
	$where_mode    = '';

// url empty
	if ($flag_url_empty == 1)
	{
		$where_link .= "AND l.url != '' ";
	}

// all categories ( not specify )
	if (($cid == 0)&&($flag_subcat == 1))
	{
		$sql_catlink   = '';
		$where_catlink = '';
	}

// specify category
	else
	{
		$sql_catlink  = $table_catlink." cl ON l.lid=cl.lid ";

// parent category only
		if ($flag_subcat == 0)
		{
			$where_catlink = "cl.cid=".$cid." ";
		}

// parent and all children categories
		else
		{
			$cattree = new XoopsTree($table_category, 'cid', 'pid');
			$cid_array = array();
			$cid_array = $cattree->getAllChildId($cid);

			if (count($cid_array) == 0)
			{
				$cids = $cid;
			}
			else
			{
				array_push($cid_array, $cid);	// with parent
				$cids = implode(',', $cid_array);
			}

			$where_catlink = "cl.cid IN(".$cids.") ";
		}
	}

	if ($mode_link)
	{
		$where_mode = $mode_link."=1 ";
	}

// random mode
	if ( $flag_random )
	{
		$sql_orderby = "rand()";
	}
// normal mode
	elseif ($order != '' && $sort != '')
	{
		$sql_orderby = "l.".$order." ".$sort;
	}

// build sql
	$sql = $sql_link;

	if ( $sql_catlink )
	{
		$sql .= " INNER JOIN ".$sql_catlink;
	}

	$sql .= "WHERE ".$where_link;

	if ( $where_catlink )
	{
		$sql .= " AND ".$where_catlink;
	}

	if ( $where_mode )
	{
		$sql .= " AND ".$where_mode;
	}

	if ( $sql_orderby )
	{
		$sql .= " ORDER BY ".$sql_orderby;
	}

	$result = $xoopsDB->query($sql, $limit);
	if ( !$result ) 
	{
//		echo $xoopsDB->error();
		return $block;
	}

	while ($row = $xoopsDB->fetchArray($result))
	{
		$lid = $row['lid'];

		$cid       = 0;
		$cat_title = '';
		if ( $cat_title_length != 0 )
		{
			$cid       = b_weblinks_get_cid_in_catlink(    $table_catlink,  $lid );
			$cat_title = b_weblinks_get_title_in_category( $table_category, $cid );
		}

		$arr              =& $row;
		$arr['cid']       =  $cid;
		$arr['cat_title'] =  $cat_title;

		$link =& b_weblinks_build_link($arr, $link_param);
		$block['links'][]    = $link;
		$block['gm_links'][] = $link;
	}

// google map
	$gm_param = array(
		'gm_mode'      => $gm_mode,
		'gm_latitude'  => $gm_latitude,
		'gm_longitude' => $gm_longitude,
		'gm_zoom'      => $gm_zoom,
	);

	$gm_arr =& b_weblinks_build_gmap( $gm_param, $conf );

	$block['gm_server']       = $conf['gm_server'];
	$block['gm_apikey']       = $conf['gm_apikey'];
	$block['show_gmap']       = $gm_arr['show_gmap'];
	$block['gm_load_server']  = $gm_arr['gm_load_server'];
	$block['gm_load_block']   = $gm_arr['gm_load_block'];
	$block['gm_latitude']     = $gm_arr['gm_latitude'];
	$block['gm_longitude']    = $gm_arr['gm_longitude'];
	$block['gm_zoom']         = $gm_arr['gm_zoom'];
	$block['gm_height']       = $gm_height;
	$block['gm_timeout']      = $gm_timeout;
	$block['gm_name']         = $gm_name;
	$block['gm_marker_width'] = $gm_marker_width;
	$block['gm_control']      = $gm_control;
	$block['gm_type_control'] = $gm_type_control;

	$gmap = '';
	if ( $gm_arr['show_gmap'] )
	{
		$gmap = b_weblinks_fetch_gmap_template( $block );
	}
	$block['gmap'] = $gmap;

	return $block;
}

function b_weblinks_generic_edit($options)
{
// BUG 4508: Fatal error: Call to undefined function: weblinks_get_handler()

// base on W3C
	$SELECTED = 'selected="selected"';
	$CHECKED  = 'checked="checked"';

	global $xoopsDB;

	$DIRNAME = empty( $options[0] ) ? basename( dirname( dirname( __FILE__ ) ) ) : $options[0];
	$WEBLINKS_ROOT_PATH = XOOPS_ROOT_PATH.'/modules/'.$DIRNAME;

	include_once XOOPS_ROOT_PATH.'/class/xoopstree.php';
	include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/functions.php';
	include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/error.php';
	include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/strings.php';
	include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/system.php';
	include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/basic_handler.php';
	include_once $WEBLINKS_ROOT_PATH.'/include/weblinks_constant.php';
	include_once $WEBLINKS_ROOT_PATH.'/include/functions.php';
	include_once $WEBLINKS_ROOT_PATH.'/class/weblinks_config2_basic_handler.php';
	include_once $WEBLINKS_ROOT_PATH.'/class/weblinks_category_basic_handler.php';

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
	if ( $show_date == 1 )
	{
		$date_checked_1 = $CHECKED;
	}
	else
	{
		$date_checked_0 = $CHECKED;
	}

// mode url
	$url_sel_0 = '';
	$url_sel_1 = '';
	$url_sel_2 = '';
	if ( $show_mode_url == 1 )
	{
		$url_sel_1 = $SELECTED;
	}
	elseif ( $show_mode_url == 2 )
	{
		$url_sel_2 = $SELECTED;
	}
	else
	{
		$url_sel_0 = $SELECTED;
	}

// url empty
	$empty_checked_0 = '';
	$empty_checked_1 = '';
	if ( $flag_url_empty == 1 )
	{
		$empty_checked_1 = $CHECKED ;
	}
	else
	{
		$empty_checked_0 = $CHECKED ;
	}

// category
	$selbox = $category_handler->build_selbox( $cid, 1, "options[12]" );

// sub category
	$subcat_checked_0 = '';
	$subcat_checked_1 = '';
	if ( $flag_subcat == 1 )
	{
		$subcat_checked_1 = $CHECKED ;
	}
	else
	{
		$subcat_checked_0 = $CHECKED ;
	}

// mode
	$mode_sel_recommend = '';
	$mode_sel_mutual    = '';
	if ( $mode_link == 'recommend' )
	{
		$mode_sel_recommend = $SELECTED;
	}
	elseif ( $mode_link == 'mutual' )
	{
		$mode_sel_mutual = $SELECTED;
	}

// random
	$random_checked_0 = '';
	$random_checked_1 = '';
	if ( $flag_random == 1 )
	{
		$random_checked_1 = $CHECKED ;
	}
	else
	{
		$random_checked_0 = $CHECKED ;
	}

// order
	$order_sel_lid    = '';
	$order_sel_update = '';
	$order_sel_create = '';
	$order_sel_hits   = '';
	$order_sel_rating = '';
	$order_sel_title  = '';
	if ( $order == 'time_update' )
	{
		$order_sel_update = $SELECTED;
	}
	elseif ( $order == 'time_create' )
	{
		$order_sel_create = $SELECTED;
	}
	elseif ( $order == 'hits' )
	{
		$order_sel_hits = $SELECTED;
	}
	elseif ( $order == 'rating' )
	{
		$order_sel_rating = $SELECTED;
	}
	elseif ( $order == 'title' )
	{
		$order_sel_title = $SELECTED;
	}
	else
	{
		$order_sel_lid = $SELECTED;
	}

// sort
	$sort_sel_asc  = '';
	$sort_sel_desc = '';
	if ( $sort == 'DESC' )
	{
		$sort_sel_desc = $SELECTED;
	}
	else
	{
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
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_GM_DESC_LENGTH;
	$form .= "</td><td>";
	$form .= '<input type="text" name="options[24]" value="'. $gm_desc_length .'" />'."\n";
	$form .= "&nbsp;". _MB_WEBLINKS_LENGTH  ."\n";
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_GM_WORDWRAP;
	$form .= "</td><td>";
	$form .= '<input type="text" name="options[25]" value="'. $gm_wordwrap .'" />'."\n";
	$form .= "&nbsp;". _MB_WEBLINKS_LENGTH  ."\n";
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_GM_MARKER_WIDTH;
	$form .= "</td><td>";
	$form .= '<input type="text" name="options[26]" value="'. $gm_marker_width .'" />'."\n";
	$form .= "&nbsp;". _MB_WEBLINKS_PIXEL ."\n";
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_GM_CONTROL;
	$form .= "</td><td>";
	$form .= '<input type="text" name="options[27]" value="'. $gm_control .'" />'."\n";
	$form .= _MB_WEBLINKS_GM_CONTROL_DSC;
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_GM_TYPE_CONTROL;
	$form .= "</td><td>";
	$form .= '<input type="text" name="options[28]" value="'. $gm_type_control .'" />'."\n";
	$form .= _MB_WEBLINKS_GM_CONTROL_DSC;
	$form .= "</td></tr></table>\n";
	return $form;
}

//---------------------------------------------------------
// config table
//---------------------------------------------------------
function b_weblinks_get_cid_in_catlink( $table_catlink, $lid ) 
{
	global $xoopsDB;

	$cid  = 0;
	if ( empty($lid) )
	{	return $cid;	}

	$sql  = "SELECT cid FROM " . $table_catlink;
	$sql .= " WHERE lid=" . $lid;
	$sql .= " ORDER BY cid ASC";
	$res = $xoopsDB->query($sql, 1, 0);
	if ( $res ) 
	{
		$row = $xoopsDB->fetchArray($res);
		$cid = $row['cid'];
	}
	return $cid;
}

function b_weblinks_get_title_in_category( $table_category, $cid ) 
{
	global $xoopsDB;

	$title = '';
	if ( empty($cid) )
	{	return $title;	}

	$sql  = "SELECT title FROM " . $table_category;
	$sql .= " WHERE cid=" . $cid;
	$res = $xoopsDB->query($sql, 1, 0);
	if ( $res ) 
	{
		$row = $xoopsDB->fetchArray($res);
		$title = $row['title'];
	}
	return $title;
}

//---------------------------------------------------------
// utility
//---------------------------------------------------------
function &b_weblinks_build_link( &$row, &$param ) 
{
	$myts =& MyTextSanitizer::getInstance();

	$order            = $param['order'];
	$title_length     = $param['title_length'];
	$cat_title_length = $param['cat_title_length'];
	$desc_length      = $param['desc_length'];
	$newdays          = $param['newdays'];
	$popular          = $param['popular'];
	$max_width        = $param['max_width'];
	$width_default    = $param['width_default'];
	$gm_desc_length   = $param['gm_desc_length'];
	$gm_wordwrap      = $param['gm_wordwrap'];

	$lid         = $row['lid'];
	$title       = $row['title'];
	$url         = $row['url'];
	$banner      = $row['banner'];
	$width       = $row['width'];
	$height      = $row['height'];
	$hits        = $row['hits'];
	$rating      = $row['rating'];
	$votes       = $row['votes'];
	$comments    = $row['comments'];
	$desc        = $row['description'];
	$dohtml      = $row['dohtml'];
	$dosmiley    = $row['dosmiley'];
	$doxcode     = $row['doxcode'];
	$doimage     = $row['doimage'];
	$dobr        = $row['dobr'];
	$time_create = $row['time_create'];
	$time_update = $row['time_update'];

// google map
	$gm_latitude  = $row['gm_latitude'];
	$gm_longitude = $row['gm_longitude'];
	$gm_zoom      = $row['gm_zoom'];

// category
	$cid       = $row['cid'];
	$cat_title = $row['cat_title'];

	$show_title     = false;
	$show_desc      = false;
	$show_banner    = false;
	$show_new       = false;
	$show_update    = false;
	$show_popular   = false;
	$show_cat_title = false;
	$show_gm_desc   = false;
	$flag_gm_use    = false;

	$title_s      = '';
	$cat_title_s  = '';
	$desc_short   = '';
	$gm_desc_wrap = '';

// hack for multi language
	if ( isset($param['is_japanese_site']) && $param['is_japanese_site'] )
	{
		if ( $row['etc1'] )
		{
			$title = $row['etc1'];
		}
		if ( $row['textarea1'] )
		{
			$context  = $row['textarea1'];
			$dohtml   = $row['dohtml1'];
			$dosmiley = $row['dosmiley1'];
			$doxcode  = $row['doxcode1'];
			$doimage  = $row['doimage1'];
			$dobr     = $row['dobr1'];
		}
	}

	if ( (($gm_latitude != 0)||($gm_longitude != 0)||($gm_zoom != 0)) )
	{
		$flag_gm_use = true;
	}

	$rates = sprintf("%.1f", $rating);

// title
	if ( $title_length != 0)
	{
		$show_title = true;
		$title_s = b_weblinks_build_summary( $title, $title_length );
	}

	if ( $cat_title_length != 0)
	{
		$show_cat_title = true;
		$cat_title_s = b_weblinks_build_summary( $cat_title, $cat_title_length );
	}

// description
	$desc_html = $myts->displayTarea($desc, $dohtml, $dosmiley, $doxcode, $doimage, $dobr);

	if ( $desc_length != 0 )
	{
		$show_desc  = true;
		$desc_short = b_weblinks_build_summary( $desc_html, $desc_length );
	}

	if ( $gm_desc_length != 0 )
	{
		$show_gm_desc = true;
		$gm_desc_wrap = b_weblinks_build_summary( $desc_html, $gm_desc_length );

		if ( $gm_wordwrap > 0 )
		{
			$gm_desc_wrap = wordwrap( $gm_desc_wrap, $gm_wordwrap, "<br />" );
		}
	}

// banner image
	if ( ($max_width > 0) && $banner )
	{
		$show_banner = true;

		if ($width > $max_width)
		{
			$width = $max_width;
		}

		if (($width == 0) && ($width_default > 0))
		{
			$width = $width_default;
		}
	}

// new & update image
	if ( $newdays > 0)
	{
		$startdate = (time()-(86400 * $newdays));

		if ( $startdate < $time_create ) {
			$show_new = true;
		} elseif ( $startdate < $time_update ) {
			$show_update = true;
		}
	}

// popular image
	if (( $popular > 0 )&&( $row['hits'] >= $popular ))
	{
		$show_popular = true;
	}

// old style
	if ($order == "rating")
	{
		$hits = $rates;
	}

// name mail
	$name = '';
	if ( $row['nameflag'] && $row['name'] ) {
		$name = $row['name'];
	}

	$mail = '';
	if ( $row['mailflag'] && $row['mail'] ) {
		$mail = $row['mail'];
	}

	$link = array(
		'id'          => $lid,
		'lid'         => $lid,
		'cid'         => $cid,
		'hits'        => $hits,
		'votes'       => $votes,
		'comments'    => $comments,
		'width'       => $width,
		'url'         => happy_linux_sanitize_url($url),
		'banner'      => happy_linux_sanitize_url($banner),
		'date'        => formatTimestamp($time_update, 's'),
		'rates'       => $rates,
		'title'       => $title_s,
		'cat_title'   => $cat_title_s,
		'desc_html'   => $desc_html,
		'description' => $desc_short,
		'desc_short'  => $desc_short,

		'name'        => $name,
		'mail'        => $mail,

		'show_title'     => $show_title,
		'show_cat_title' => $show_cat_title,
		'show_desc'      => $show_desc,
		'show_banner'    => $show_banner,
		'show_new'       => $show_new,
		'show_update'    => $show_update,
		'show_pop'       => $show_popular,

// google map
		'gm_latitude'   => $gm_latitude,
		'gm_longitude'  => $gm_longitude,
		'gm_zoom'       => $gm_zoom,
		'gm_desc_wrap'  => $gm_desc_wrap,
		'show_gm_desc'  => $show_gm_desc,
		'flag_gm_use'   => $flag_gm_use,
	);

	return $link;
}

// max: 0=none -1=unlimited
function b_weblinks_build_summary( $str, $max ) 
{
	$text = happy_linux_mb_build_summary( $str, $max );
	$text = happy_linux_sanitize_text( $text );
	return $text;
}

//---------------------------------------------------------
// gmap
//---------------------------------------------------------
function &b_weblinks_build_gmap( &$param, &$conf ) 
{
	$show_gmap      = false;
	$gm_load_server = false;
	$gm_load_block  = false;

	$gm_mode      = $param['gm_mode'];
	$gm_latitude  = $param['gm_latitude'];
	$gm_longitude = $param['gm_longitude'];
	$gm_zoom      = $param['gm_zoom'];

	if ( $gm_mode && $conf['gm_use'] )
	{
		$show_gmap = true;
	}

// set flag, when not load server
	if ( $show_gmap )
	{
		if ( !defined('WEBLINKS_GM_SERVER_LOADED') )
		{
			define('WEBLINKS_GM_SERVER_LOADED', 1 );
			$gm_load_server = true;
		}

		if ( !defined('WEBLINKS_GM_BLOCK_LOADED') )
		{
			define('WEBLINKS_GM_BLOCK_LOADED', 1 );
			$gm_load_block = true;
		}
	}

// use config value
	if ( $gm_mode == 1 )
	{
		$gm_latitude  = $conf['gm_latitude'];
		$gm_longitude = $conf['gm_longitude'];
		$gm_zoom      = $conf['gm_zoom'];
	}

	$arr = array(
		'show_gmap'      => $show_gmap,
		'gm_load_server' => $gm_load_server,
		'gm_load_block'  => $gm_load_block,
		'gm_latitude'    => $gm_latitude,
		'gm_longitude'   => $gm_longitude,
		'gm_zoom'        => $gm_zoom,
	);

	return $arr;
}

function b_weblinks_fetch_gmap_template( $block ) 
{
	$dirname = $block['dirname'];

/* CDS Patch. Weblinks. 2.00. 1. BOF */
	global $xoopsConfig;
	$dir_theme = XOOPS_THEME_PATH.'/'.$xoopsConfig['theme_set'] .'/modules/' . $dirname . '/parts';
	if (file_exists($dir_theme . '/weblinks_gm_block.html'))
	{
		$template = $dir_theme . '/weblinks_gm_block.html';
	}
	else
	{
		$template = XOOPS_ROOT_PATH .'/modules/'. $block['dirname'] .'/templates/parts/weblinks_gm_block.html';
	}
/* CDS Patch. Weblinks. 2.00. 1. EOF */

	$tpl = new XoopsTpl();
	$tpl->assign('xoops_url',  XOOPS_URL );
	$tpl->assign('block',      $block );
	$text = $tpl->fetch( $template );
	return $text;
}

// --- block function begin end ---
}

?>