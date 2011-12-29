<?php
// $Id: weblinks_cat_view_handler.php,v 1.1 2011/12/29 14:33:07 ohwada Exp $

// 2007-11-11 K.OHWADA
// divid from weblinks_link_view_handler

//=========================================================
// WebLinks Module
// 2006-05-15 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('weblinks_cat_view_handler') ) 
{

//=========================================================
// class weblinks_cat_view_handler
//=========================================================
class weblinks_cat_view_handler extends weblinks_link_count_handler
{
	var $_strings;
	var $_post;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_cat_view_handler( $dirname )
{
	$this->weblinks_link_count_handler( $dirname );

	$this->_strings =& happy_linux_strings::getInstance();
	$this->_post    =& happy_linux_post::getInstance();
}

//=========================================================
// public
//=========================================================
//---------------------------------------------------------
// get category
//---------------------------------------------------------
// viewcat
function &get_category_by_cid( $cid, $flag_catpath=false, $flag_parent_image=false, $flag_parent_desc=false )
{
	$arr =& $this->_category_handler->get_cache($cid);

	$catpath = '';
	if ($flag_catpath)
	{
		$catpath = $this->_category_handler->get_parent_path($cid);
	}

	if ( $flag_parent_image && empty($arr['imgurl']) )
	{
		$parent =& $this->_category_handler->get_parent_imgurl_size($cid);
		$arr['imgurl']          = $parent['imgurl'];
		$arr['img_show_width']  = $parent['img_show_width'];
		$arr['img_show_height'] = $parent['img_show_height'];
	}

	$desc_disp = '';
	if ( $arr['description'] )
	{
		$desc_disp = $this->_category_handler->get_desc_disp($cid);
	}
	elseif ( $flag_parent_desc )
	{
		$desc_disp = $this->_category_handler->get_parent_desc_disp($cid);
	}

	$arr['title_s']    = $this->_strings->sanitize_text( $arr['title']);
	$arr['imgurl_s']   = $this->_strings->sanitize_url(  $arr['imgurl'] );
	$arr['link_count'] = $this->get_all_link_count_by_cid($cid);
	$arr['catpath']    = $catpath;
	$arr['desc_disp']  = $desc_disp;

	return $arr;
}

// topten
function get_cat_title($cid, $format)
{
	return $this->_category_handler->get_title($cid, $format);
}

//---------------------------------------------------------
// cid array
//---------------------------------------------------------
// topten
function &get_cid_array_by_pid( $pid )
{
	return $this->_category_handler->get_cid_array_by_pid( $pid );
}

// index
function &get_category_list_by_pid($pid, $flag_catpath=0, $sub_num=-1, $sub_mode=1)
{
	if ($pid == 0)
	{
		$cid_arr = $this->_category_handler->get_cid_array_by_pid($pid);
	}
	else
	{
		$cid_arr = $this->_category_handler->get_cid_child_array_from_cache_by_cid($pid);
	}

	$arr = array();

	foreach ($cid_arr as $cid)
	{
		$temp_arr =& $this->get_category_by_cid($cid, $flag_catpath);

// admin can change the display number of subcategory 
		$temp_arr['sub_categories'] =
			$this->_category_handler->build_sub_categories($cid, $sub_num, $sub_mode);

		$arr[] = $temp_arr;
	}

	return $arr;
}

//---------------------------------------------------------
// category path
//---------------------------------------------------------
// singlelink
function &get_catpath_array_by_lid($lid)
{
	$cid_arr = $this->_catlink_handler->get_cid_array_by_lid($lid);
	$catpath_arr = array();

	foreach ($cid_arr as $cid)
	{
		if ( $this->_category_handler->cache_exists($cid) )
		{
			$catpath_arr[] =& $this->_category_handler->get_parent_path($cid);
		}
	}

	return $catpath_arr;
}

// catlist
function get_all_catlist()
{
	$tree_array = $this->_category_handler->get_tree();

	$catlist = array();

	foreach ($tree_array as $cid) 
	{
		$catlist[] = array(
			'cid'   => $cid,
			'count' => $this->get_all_link_count_by_cid( $cid ),
			'path'  => $this->_category_handler->build_cat_path($cid, 's'),
		);
	}

	return $catlist;
}

//---------------------------------------------------------
// google map
//---------------------------------------------------------
// viewcat
function &get_cat_gm_value_by_cid( $cid )
{
	$arr =& $this->_get_gm_value_null();

	if ( !$this->_conf['gm_use'] )
	{	return $arr;	}

	$cache =& $this->_category_handler->get_gm_value($cid);

	if ( !isset($cache['gm_mode']) )
	{	return $arr;	}

	switch( $cache['gm_mode'] )
	{
	// config
		case 1:
			$arr =& $this->_get_gm_value_conf();
			break;

	// parent
		case 2:
			$arr =& $this->_get_cat_parent_gm_value_by_cid($cid);
			break;

	// self
		case 3:
			$arr =& $cache;
			$arr['show_gm'] = true;
			break;

	// not show
		case 0:
		default:
			break;
	}

	return $arr;
}

//---------------------------------------------------------
// lid array
//---------------------------------------------------------
// viewcat
function &get_lid_array_by_cid_sort($cid, $sort, $limit=0, $start=0)
{
	$sort_arr = array();

	if ( $this->_conf['recommend_pri'] == 2 )
	{
		$sort_arr[] = 'recommend DESC';
	}

	if ( $this->_conf['mutual_pri'] == 2 )
	{
		$sort_arr[] = 'mutual DESC';
	}

	if ( isset($sort['sort']) && isset($sort['order']) )
	{
		$sort_arr[] = $sort['sort'].' '.$sort['order'];
	}
	else
	{
		$sort_arr[] = 'lid ASC';
	}

	$orderby = implode(',', $sort_arr);

	$lid_arr =& $this->_link_catlink_handler->get_lid_array_by_cid_orderby($cid, $orderby, $limit, $start);
	return $lid_arr;
}

// viewcat
function &get_lid_array_all_child_by_cid_orderby($cid, $orderby, $limit=0, $start=0)
{
	$cid_arr =& $this->_category_handler->getAllChildId($cid);
	$lid_arr =& $this->_link_catlink_handler->get_lid_array_by_cid_array_orderby($cid_arr, $orderby, $limit, $start);
	return $lid_arr;
}

// topten
function &get_lid_array_parent_child_by_cid_orderby($cid, $orderby, $limit=0, $start=0)
{
	$cid_arr =& $this->get_cid_array_patent_children($cid);
	$lid_arr =& $this->_link_catlink_handler->get_lid_array_by_cid_array_orderby($cid_arr, $orderby, $limit, $start);
	return $lid_arr;
}

// search
function &get_lid_array_by_cid_array_where_orderby( &$cid_arr, $where, $orderby, $limit=0, $start=0 )
{
	return $this->_link_catlink_handler->get_lid_array_by_cid_array_where_orderby( $cid_arr, $where, $orderby, $limit, $start );
}

//---------------------------------------------------------
// forum threads
//---------------------------------------------------------
// viewcat
function &get_cat_forum_id_by_cid($cid)
{
	$forum_id = $this->_category_handler->get_forum_id($cid);

// same parent
	if (($this->_conf['cat_forum_mode'] == 1)&&($forum_id == 0))
	{
		$forum_id = $this->_category_handler->get_parent_forum_id($cid);
	}

	return $forum_id;
}

//---------------------------------------------------------
// album photos
//---------------------------------------------------------
// viewcat
function &get_cat_album_photos_by_cid($cid)
{
	$album_id = $this->_category_handler->get_album_id($cid);

// same parent
	if (($this->_conf['cat_album_mode'] == 1)&&($album_id == 0))
	{
		$album_id = $this->_category_handler->get_parent_album_id($cid);
	}

	$opts = array(
		'album_id'    => $album_id, 
		'dirname'     => $this->_conf['cat_album_dirname'], 
		'album_limit' => $this->_conf['cat_album_limit'], 
	);

	$arr =& $this->_plugin->get_album_photos_for_cat( $opts );
	return $arr;
}

// viewcat
function &get_cat_album_id_by_cid($cid)
{
	$album_id = $this->_category_handler->get_album_id($cid);

// same parent
	if (($this->_conf['cat_album_mode'] == 1)&&($album_id == 0))
	{
		$album_id = $this->_category_handler->get_parent_album_id($cid);
	}

	return $album_id;
}

//=========================================================
// private
//=========================================================
//---------------------------------------------------------
// google map
//---------------------------------------------------------
function &_get_cat_parent_gm_value_by_cid( $cid )
{
	$arr =& $this->_get_gm_value_null();

	if ( !$this->_conf['gm_use'] )
	{	return $arr;	}

	$cache =& $this->_category_handler->get_parent_gm_value($cid);

	if ( !isset($cache['gm_mode']) )
	{	return $arr;	}

	switch( $cache['gm_mode'] )
	{
	// config
		case 1:
			$arr =& $this->_get_gm_value_conf();
			break;

	// self
		case 3:
			$arr =& $cache;
			$arr['show_gm'] = true;
			break;

	// not show
		case 0:
	// parent
		case 2:
		default:
			break;
	}

	return $arr;
}

function &_get_gm_value_null()
{
	$arr = array(
		'show_gm'      => false,
		'gm_latitude'  => null,
		'gm_longitude' => null,
		'gm_zoom'      => null,
	);
	return $arr;
}

function &_get_gm_value_conf()
{
	$arr = array(
		'show_gm'      => true,
		'gm_latitude'  => $this->_conf['gm_latitude'],
		'gm_longitude' => $this->_conf['gm_longitude'],
		'gm_zoom'      => $this->_conf['gm_zoom'],
	);
	return $arr;
}

// --- class end ---
}

// === class end ===
}

?>