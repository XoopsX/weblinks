<?php
// $Id: category_list.php,v 1.1 2011/12/29 14:32:56 ohwada Exp $

// 2007-12-16 K.OHWADA
// get_title_with_top()

// 2007-11-01 K.OHWADA
// set_flag_execute_time()

// 2007-03-25 K.OHWADA
// update_image_size_form

// 2007-03-01 K.OHWADA
// hack for multi site
// show aux_text_1
// update_path

// 2006-09-20 K.OHWADA
// use happy_linux

// 2006-05-15 K.OHWADA
// new handler
// add admin_category_list

// 2006-03-15 K.OHWADA
// use weblinks_pagenavi_basic::getInstance()

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication

//================================================================
// WebLinks Module
// view category list 
// 2004-12-14 K.OHWADA
//================================================================

include 'admin_header.php';
include 'admin_header_list.php';

define('WEBLINKS_CAT_LIST_ID_ASC',  '0');
define('WEBLINKS_CAT_LIST_ID_DESC', '1');
define('WEBLINKS_CAT_LIST_TREE',    '2');
define('WEBLINKS_CAT_LIST_ORDER',   '3');

//=========================================================
// class admin_category_list
//=========================================================
class admin_category_list extends happy_linux_page_frame
{
	var $_post;

// hack for multi site
	var $_flag_show_aux_text_1 = false;
	var $_flag_show_aux_text_2 = false;
	var $_aux_text_1 = _WEBLINKS_CAT_AUX_TEXT_1;
	var $_aux_text_2 = _WEBLINKS_CAT_AUX_TEXT_2;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_category_list()
{
	$this->happy_linux_page_frame();

	$this->set_handler('category', WEBLINKS_DIRNAME, 'weblinks');
	$this->set_id_name('cid');
	$this->set_max_sortid( WEBLINKS_CAT_LIST_ORDER );
	$this->set_form_name('weblinks_cat');
	$this->set_action('category_manage.php');
	$this->set_operation('reorderCat');
	$this->set_lang_no_item( _WEBLINKS_NO_CATEGORY );
	$this->set_flag_execute_time( true );

	$this->_post =& happy_linux_post::getInstance();

// hack for multi site
	if ( weblinks_multi_is_japanese_site() )
	{
		$this->_flag_show_aux_text_1 = true;
		$this->_aux_text_1 = _WEBLINKS_CAT_TITLE_JP;
	}
}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_category_list();
	}
	return $instance;
}

//---------------------------------------------------------
// init
//---------------------------------------------------------
function _init()
{
	$this->_handler->load();
}

//---------------------------------------------------------
// handler
//---------------------------------------------------------
function &_get_table_header()
{
	$arr = array(
		_WLS_CATEGORYID,
		_WLS_PARENT,
		_WLS_TITLEC,
	);

	if ( $this->_flag_show_aux_text_1 )
	{
		$arr[] = $this->_aux_text_1;
	}

	if ( $this->_flag_show_aux_text_2 )
	{
		$arr[]  = $this->_aux_text_2;
	}

	$arr[] = _WEBLINKS_NUM_SUBCAT;

	if ($this->_sortid == WEBLINKS_CAT_LIST_ORDER)
	{
		$arr[] = _WEBLINKS_CAT_ORDER;
	}

	return $arr;
}

function _get_total()
{
	$pid = $this->_get_get_pid();

	switch ($this->_sortid)
	{
		case WEBLINKS_CAT_LIST_ORDER:
			$total = $this->_handler->get_count_by_pid($pid);
			break;

		case WEBLINKS_CAT_LIST_ID_ASC:
		case WEBLINKS_CAT_LIST_ID_DESC:
		case WEBLINKS_CAT_LIST_TREE:
		default:
			$total = $this->_get_total_all();
			break;
	}

	return $total;
}

function _get_get_pid()
{
	$pid = 0;
	if ( isset($_GET['pid']) )  $pid = intval($_GET['pid']);
	return $pid;
}

function &_get_items($limit=0, $start=0)
{
	$pid = $this->_get_get_pid();

	switch ($this->_sortid)
	{
		case WEBLINKS_CAT_LIST_ID_DESC:
			$objs =& $this->_handler->get_objects_desc($limit, $start);
			break;

		case WEBLINKS_CAT_LIST_TREE:
			$objs =& $this->_handler->get_objects_tree($limit, $start);
			break;

		case WEBLINKS_CAT_LIST_ORDER:
			$objs =& $this->_handler->get_objects_by_pid($pid, $limit, $start);
			break;

		case WEBLINKS_CAT_LIST_ID_ASC:
		default:
			$objs =& $this->_handler->get_objects_all($limit, $start);
			break;
	}

	return $objs;
}

function _get_cols(&$obj)
{
	$cid          = $obj->getVar('cid',        'n');
	$pid          = $obj->getVar('pid',        'n');
	$orders       = $obj->getVar('orders',     'n');
	$title_s      = $obj->getVar('title',      's');
	$aux_text_1_s = $obj->getVar('aux_text_1', 's');
	$aux_text_2_s = $obj->getVar('aux_text_2', 's');

	$jump_cid   = "category_manage.php?op=modCat&amp;cid=";
	$jump_pid   = "category_list.php?sortid=".WEBLINKS_CAT_LIST_ORDER."&amp;pid=".$pid;
	$jump_pid_2 = "category_list.php?sortid=".WEBLINKS_CAT_LIST_ORDER."&amp;pid=".$cid;
	$url_view_cid   = WEBLINKS_URL."/viewcat.php?cid=".$cid;
	$url_folder_gif = WEBLINKS_URL."/images/folder.gif";

	$depth   = $this->_handler->get_cid_depth_from_cache_by_cid($cid);
	$depth_d = str_repeat("--", $depth);

	$num_sub  = $this->_handler->get_count_by_pid($cid);
	$ptitle_s = $this->_handler->get_title_with_top( $pid, 's' );

	$link_category = $this->_build_page_id_link_by_obj( $obj, 'cid', $jump_cid);
	$link_ptitle   = $this->build_html_a_href_name($jump_pid,   $ptitle_s);
	$link_title    = $this->build_html_a_href_name($jump_pid_2, $title_s);
	$img_folder    = $this->build_html_img_tag($url_folder_gif, 0, 0, 0, 'folder');
	$view_category = $this->build_html_a_href_name($url_view_cid, $img_folder, '', false);

	$arr = array(
		$view_category.'&nbsp;&nbsp;'.$link_category,
		$link_ptitle,
		$depth_d.'&nbsp;&nbsp;'.$link_title,
	);

	if ( $this->_flag_show_aux_text_1 )
	{
		array_push( $arr, $aux_text_1_s );
	}

	if ( $this->_flag_show_aux_text_2 )
	{
		array_push( $arr, $aux_text_2_s );
	}

	array_push( $arr, $num_sub );

	if ($this->_sortid == WEBLINKS_CAT_LIST_ORDER)
	{
		$ele_orders = $this->build_html_input_text("orders[$cid]", $orders, 5);
		array_push( $arr, $ele_orders );
	}

	return array($arr, $depth);
}

//---------------------------------------------------------
// print
//---------------------------------------------------------
function _print_top()
{
	switch ($this->_sortid)
	{
		case WEBLINKS_CAT_LIST_ID_DESC:
			$title = _AM_WEBLINKS_LIST_ID_DESC;
			break;

		case WEBLINKS_CAT_LIST_TREE:
			$title = _WEBLINKS_ORDER_TREE;
			break;

		case WEBLINKS_CAT_LIST_ORDER:
			$title = _WEBLINKS_CAT_ORDER;
			break;

		case WEBLINKS_CAT_LIST_ID_ASC:
		default:
			$title = _AM_WEBLINKS_LIST_ID_ASC;
			break;
	}

	$total_all = $this->_get_total_all();

	echo "<h4>"._WEBLINKS_ADMIN_CATEGORY_LIST."</h4>\n";
	printf(_WEBLINKS_THERE_ARE_CATEGORY, $total_all);
	echo "<br /><br />\n";

	echo "<table width='80%' border='0' cellspacing='1' class='outer'>";
	echo "<tr class='odd'><td>";
	echo "<li><a href='category_list.php?sortid=0'>"._AM_WEBLINKS_LIST_ID_ASC."</a></li>\n";
	echo "<li><a href='category_list.php?sortid=1'>"._AM_WEBLINKS_LIST_ID_DESC."</a></li>\n";
	echo "<li><a href='category_list.php?sortid=2'>"._WEBLINKS_ORDER_TREE."</a></li>\n";
	echo "<li><a href='category_list.php?sortid=3'>"._WEBLINKS_CAT_ORDER."</a></li>\n";
	echo "<br />\n";
	echo "<li><a href='category_manage.php?op=update_path_form'>"._AM_WEBLINKS_UPDATE_CAT_PATH."</a></li>\n";
	echo "<li><a href='category_manage.php?op=update_image_size_form'>"._AM_WEBLINKS_UPDATE_CAT_IMAGE_SIZE."</a></li>\n";
	echo"</td></tr></table>\n";

	echo "<h4>".$title."</h4>\n";

}

function _print_table_item( &$item )
{
	list($col_arr, $depth) = $this->_get_cols($item);

	if ($this->_sortid == WEBLINKS_CAT_LIST_ORDER)
	{
		$class = '';
	}
	elseif ($depth == 0) 
	{
		$class   = 'head';
	}
	elseif ($depth == 1) 
	{
		$class = 'even';
	}
	else
	{
		$class = 'odd';
	}

	echo "<tr class='$class'>";

	foreach ($col_arr as $col)
	{
		echo $this->_build_page_col_item($col);
	}

	echo "</tr>\n";
}

function _print_form_begin()
{
	if ($this->_sortid == WEBLINKS_CAT_LIST_ORDER)
	{
		$pid = $this->_post->get_post_get_int('pid');
		$this->set_flag_form(1);
		echo $this->_build_page_form_begin();
		echo $this->build_html_input_hidden('pid', $pid);
	}
}

function _print_table_submit()
{

	if ($this->_sortid == WEBLINKS_CAT_LIST_ORDER)
	{
		$colspan = 4;
		if ( $this->_flag_show_aux_text_1 )
		{
			$colspan ++;
		}
		if ( $this->_flag_show_aux_text_2 )
		{
			$colspan ++;
		}

		echo $this->_build_page_submit($colspan, 1, 0);
	}

}

// --- class end ---
}


//=========================================================
// main
//=========================================================
xoops_cp_header();

weblinks_admin_print_header();
weblinks_admin_print_menu();

$list =& admin_category_list::getInstance();
$list->_show();

xoops_cp_footer();
exit();
// --- end of main ---

?>