<?php
// $Id: weblinks_link_view_handler.php,v 1.1 2012/04/09 10:21:09 ohwada Exp $

// 2008-10-18 K.OHWADA
// Notice [PHP]: Only variable references should be returned by reference

// 2008-02-17 K.OHWADA
// weblinks_htmlout
// gmap

// 2007-11-11 K.OHWADA
// divid to weblinks_cat_view_handler

// 2007-09-20 K.OHWADA
// not use happy_linux_remote_image

// 2007-09-01 K.OHWADA
// get_owner_list_by_uid()

// 2007-08-01 K.OHWADA
// get_link_list_create()

// 2007-06-10 K.OHWADA
// link_catlink_basic_handler
// get_forum_threads_for_cat() etc

// 2007-04-08 K.OHWADA
// use get_desc_disp() get_album_photos()

// 2007-03-25 K.OHWADA
// get_cat_album_photos_by_cid()
// get_cat_gm_value_by_cid()

// 2007-03-08 K.OHWADA
// change get_category_by_cid() get_category_list_by_pid()
// remove build_category_image_link()

// 2007-03-01 K.OHWADA
// happy_linux_time
// category_basic_handler
// expand subcategories
// cat_count in get_all_link_count_by_cid()
// get_cat_forum_threads()

// 2007-02-04 K.OHWADA
// BUG 4477: topten is unlimited

// 2006-12-10 K.OHWADA
// add build_sql_where_exclude()
// change get_link_count_by_cid()

// 2006-10-14 K.OHWADA
// add get_link_list_by_where(), get_cid_array_patent_children(), build_selbox()

// 2006-10-01 K.OHWADA
// use happy_linux
// weblinks_criteria_compo -> criteriaCompo
// highlight_keyword
// add get_link_by_obj()
// add get_objects_by_sql() : remove get_link_list_by_sq()

// 2006-07-22 K.OHWADA
// BUG 4152: not show catpath in link list

// 2006-05-15 K.OHWADA
// this is new file
// use new handler

//=========================================================
// WebLinks Module
// 2006-05-15 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('weblinks_link_view_handler') ) 
{

//=========================================================
// class weblinks_link_view_handler
//=========================================================
class weblinks_link_view_handler extends weblinks_cat_view_handler
{
	var $_link_view;
	var $_plugin;
	var $_htmlout;

	var $_system;
	var $_form;
	var $_time;

// system
	var $_system_is_admin;
	var $_system_uid;

// keyword
	var $_flag_highlight = false;
	var $_keyword_array  = array();

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_link_view_handler( $dirname )
{
	$this->weblinks_cat_view_handler( $dirname );

	$this->_plugin    =& weblinks_plugin::getInstance(    $dirname );
	$this->_htmlout   =& weblinks_htmlout::getInstance(   $dirname );
	$this->_link_view =& weblinks_link_view::getInstance( $dirname );

	$this->_system    =& happy_linux_system::getInstance();
	$this->_form      =& happy_linux_form::getInstance();
	$this->_time      =& happy_linux_time::getInstance();

	$this->_system_is_admin = $this->_system->is_module_admin();
	$this->_system_uid      = $this->_system->get_uid();

	$this->_htmlout->add_plugin_line( 'htmlout', $this->_conf['htmlout'] );

}

//=========================================================
// public
//=========================================================
//---------------------------------------------------------
// get link item
//---------------------------------------------------------
// singlelink
function get_link_rssc_lid($lid)
{
	return $this->_link_handler->get_rssc_lid($lid);
}

//---------------------------------------------------------
// link list for index
//---------------------------------------------------------
// index
function &get_link_list_latest($limit=0, $start=0)
{
	if ( $this->get_debug_print_time() )
	{
		$happy_linux_time =& happy_linux_time::getInstance();
		$happy_linux_time->print_lap_time( "weblinks_link_basic_handler: latest" );
	}

	$arr =& $this->_link_handler->get_lid_array_latest($limit, $start);
	$list =& $this->_get_link_list_by_lid_array( $arr );

	if ( $this->get_debug_print_time() )
	{
		$happy_linux_time->print_lap_time();
	}

	return $list;
}

// index
function &get_link_list_create($limit=0, $start=0)
{
	$orderby = 'time_create DESC, lid DESC';
	$arr =& $this->_link_handler->get_lid_array_orderby($orderby, $limit, $start);
	$list =& $this->_get_link_list_by_lid_array( $arr );
	return $list;
}

// index
function &get_owner_list_by_uid( $uid, $limit=0, $start=0 )
{
	$arr  =& $this->_link_handler->get_lid_array_by_uid( $uid, $limit, $start );
	$list =& $this->_get_link_list_by_lid_array( $arr );
	return $list;
}

//---------------------------------------------------------
// link list for viewcat
//---------------------------------------------------------
// viewcat
function &get_link_list_by_cid_sort($cid, $sort, $limit=0, $start=0)
{
	$lid_arr   =& $this->get_lid_array_by_cid_sort($cid, $sort, $limit, $start);
	$link_list =& $this->_get_link_list_by_lid_array($lid_arr);
	return $link_list;
}

// viewcat
function &get_link_all_child_list_latest_by_cid($cid, $limit=0, $start=0)
{
	$orderby   = 'time_update DESC';
	$lid_arr   =& $this->get_lid_array_all_child_by_cid_orderby($cid, $orderby, $limit, $start);
	$link_list =& $this->_get_link_list_by_lid_array($lid_arr);
	return $link_list;
}

//---------------------------------------------------------
// link list for top ten
//---------------------------------------------------------
// topten
function &get_link_list_orderby($orderby, $limit=0, $start=0)
{
// BUG: topten is unlimited
	$arr  =& $this->_link_handler->get_lid_array_orderby($orderby, $limit, $start);
	$list =& $this->_get_link_list_by_lid_array($arr);
	return $list;
}

// topten
function &get_topten_list($topten_cats, $orderby, $limit=0, $start=0)
{
	$this->_clear_errors();

	$i = 0;
	$rank_arr = array();
	$cid_arr  = $this->get_cid_array_by_pid(0);

	if ( count($cid_arr) > $topten_cats )
	{
		$this->_set_errors( sprintf(_WLS_TOPTEN_ERROR, $topten_cats) );
	}

	foreach ($cid_arr as $cid)
	{
		$ctitle_s = $this->get_cat_title($cid, 's');

// get all child cat ids for a given cat id
		$links =& $this->_get_link_parent_child_list_by_cid_orderby($cid, $orderby, $limit, $start);

		$rank_arr[$i]['cid']   = $cid;
		$rank_arr[$i]['title'] = sprintf(_WLS_TOPTEN_TITLE, $ctitle_s, $limit);
/* CDS Patch. Weblinks. 2.00. 7. BOF */
		$rank_arr[$i]['title_simple'] = $ctitle_s;
/* CDS Patch. Weblinks. 2.00. 7. EOF */
		$rank_arr[$i]['links'] = $links;

		$i++;
		if ($i >= $topten_cats ) break;
	}

	return $rank_arr;
}

function &_get_link_parent_child_list_by_cid_orderby($cid, $orderby, $limit=0, $start=0)
{
	$lid_arr   =& $this->get_lid_array_parent_child_by_cid_orderby($cid, $orderby, $limit, $start);

//print_r($lid_arr);

	$link_list =& $this->_get_link_list_by_lid_array($lid_arr);

//print_r($link_list);
	
	return $link_list;
}

//---------------------------------------------------------
// link list for viewmark
//---------------------------------------------------------
// viewmark
function &get_link_by_mark_sort($mark, $sort, $limit=0, $start=0)
{
	$orderby = 'lid ASC';
	if ( isset($sort['sort']) && isset($sort['order']) )
	{
		$orderby = $sort['sort'].' '.$sort['order'];
	}

	if ($mark == 'rss')
	{
		$arr =& $this->_link_handler->get_lid_array_rss_by_orderby($orderby, $limit, $start);
	}
	elseif ($mark == 'gmap')
	{
		$arr =& $this->_link_handler->get_lid_array_gmap_by_orderby($orderby, $limit, $start);
	}
	else
	{
		$arr =& $this->_link_handler->get_lid_array_by_mark_orderby($mark, $orderby, $limit, $start);
	}

	$list =& $this->_get_link_list_by_lid_array($arr);
	return $list;
}

function get_gmap_kml_page( $total, $limit )
{
	return $this->_link_handler->get_gmap_kml_page( $total, $limit );
}

//---------------------------------------------------------
// link list for search
//---------------------------------------------------------
// search
function &get_link_list_by_cid_array_where_orderby( &$cid_arr, $where, $orderby, $limit=0, $start=0 )
{
	$arr  =& $this->get_lid_array_by_cid_array_where_orderby( $cid_arr, $where, $orderby, $limit, $start );
	$list =& $this->_get_link_list_by_lid_array( $arr );
	return $list;
}

// search
function &get_link_list_by_where( $where, $limit=0, $start=0 )
{
	$arr  =& $this->_link_handler->get_lid_array_by_where($where, $limit, $start);
	$list =& $this->_get_link_list_by_lid_array( $arr );
	return $list;
}

// search
function build_sql_where_exclude()
{
	return $this->_link_handler->build_sql_where_exclude();
}

// search
function build_sql_where_exclude_join()
{
	return $this->_link_handler->build_sql_where_exclude_join();
}

//---------------------------------------------------------
// single link
//---------------------------------------------------------
// singlelink
function &get_link_by_lid($lid)
{
	return $this->_get_link_by_lid($lid);
}

//---------------------------------------------------------
// forum threads
//---------------------------------------------------------
// viewcat
function &get_cat_forum_threads_by_cid($cid)
{
	$forum_id = $this->get_cat_forum_id_by_cid( $cid );

	$opts = array(
		'forum_id'     => $forum_id, 
		'dirname'      => $this->_conf['cat_forum_dirname'], 
		'thread_limit' => $this->_conf['cat_forum_thread_limit'], 
		'post_limit'   => $this->_conf['cat_forum_post_limit'], 
		'post_order'   => $this->_get_forum_post_order('cat_forum_post_order'),
	);

	$arr =& $this->_plugin->get_forum_threads_for_cat( $opts );
	return $arr;
}

// singlelink
function &get_link_forum_threads_by_lid($lid)
{
	$forum_id = $this->_link_handler->get_forum_id($lid);

	$opts = array(
		'forum_id'     => $forum_id, 
		'dirname'      => $this->_conf['link_forum_dirname'], 
		'thread_limit' => $this->_conf['link_forum_thread_limit'], 
		'post_limit'   => $this->_conf['link_forum_post_limit'], 
		'post_order'   => $this->_get_forum_post_order('link_forum_post_order'),
	);

	$arr =& $this->_plugin->get_forum_threads_for_link( $opts );
	return $arr;
}

function _get_forum_post_order($conf_name)
{
	$post_order_num = $this->_conf[ $conf_name ];
	switch ($post_order_num)
	{
		case 1:
			$post_order = 'DESC';
			break;

		case 0:
		default:
			$post_order = 'ASC';
			break;
	}
	return $post_order;
}

//---------------------------------------------------------
// album photos
//---------------------------------------------------------
// viewcat
function &get_cat_album_photos_by_cid($cid)
{
	$album_id = $this->get_cat_album_id_by_cid( $cid );

	$opts = array(
		'album_id'    => $album_id, 
		'dirname'     => $this->_conf['cat_album_dirname'], 
		'album_limit' => $this->_conf['cat_album_limit'], 
	);

	$arr =& $this->_plugin->get_album_photos_for_cat( $opts );
	return $arr;
}

// singlelink
function &get_link_album_photos_by_lid($lid)
{
	$album_id = $this->_link_handler->get_album_id($lid);

	$opts = array(
		'album_id'    => $album_id, 
		'dirname'     => $this->_conf['link_album_dirname'], 
		'album_limit' => $this->_conf['link_album_limit'], 
	);

	$arr =& $this->_plugin->get_album_photos_for_link( $opts );
	return $arr;
}

//---------------------------------------------------------
// get GET & POST
//---------------------------------------------------------
function get_get_lid()
{
	return $this->_post->get_get_int('lid');
}

function get_get_cid()
{
	return $this->_post->get_get_int('cid');
}

//---------------------------------------------------------
// get property
//---------------------------------------------------------
function is_admin()
{
	return $this->_system_is_admin;
}

function get_system_uid()
{
	return $this->_system_uid;
}

//---------------------------------------------------------
// set keyword property
//---------------------------------------------------------
function set_highlight( $value )
{
	$this->_flag_highlight = (bool)$value;
}

function set_keyword_array( &$arr )
{
	if ( is_array($arr) && count($arr) )
	{
		$this->_keyword_array =& $arr;
	}
}

//=========================================================
// private
//=========================================================
function &_get_link_list_by_lid_array( $lid_arr )
{
	$arr = array();
	if ( is_array($lid_arr) && ( count($lid_arr) > 0 ) )
	{
		foreach ($lid_arr as $lid)
		{
			$arr[] = $this->_get_link_by_lid( $lid );
		}
	}
	return $arr;
}

// Notice [PHP]: Only variable references should be returned by reference
function &_get_link_by_lid( $lid )
{
// not use return references
	$arr1 = $this->_link_view->get_show_by_lid( $lid, $this->_flag_highlight, $this->_keyword_array );
	$arr2 = $this->_htmlout->execute( $arr1 );
	return $arr1;
}

// --- class end ---
}

// === class end ===
}

?>