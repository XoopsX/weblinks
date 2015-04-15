<?php
// $Id: modify_list.php,v 1.1 2011/12/29 14:32:56 ohwada Exp $

// 2007-11-01 K.OHWADA
// weblinks_admin_print_footer()

// 2007-09-01 K.OHWADA
// waiting delele
// _get_op_sortid_array()

// 2006-09-20 K.OHWADA
// this new file

//================================================================
// WebLinks Module
// 2006-09-20 K.OHWADA
//================================================================

include 'admin_header.php';
include 'admin_header_list.php';

include_once WEBLINKS_ROOT_PATH.'/class/weblinks_modify.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_modify_handler.php';

//=========================================================
// class admin_modify_list
//=========================================================
class admin_modify_list extends happy_linux_page_frame
{
	var $_strings;

	var $_total_all = 0;
	var $_total_new = 0;
	var $_total_mod = 0;
	var $_total_del = 0;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_modify_list()
{
	$this->happy_linux_page_frame();
	$this->set_handler('modify', WEBLINKS_DIRNAME, 'weblinks');
	$this->set_id_name('mid');
	$this->set_max_sortid(4);
	$this->set_lang_no_item( _WEBLINKS_NO_LINK );

	$this->_broken_handler =& weblinks_get_handler( 'broken', WEBLINKS_DIRNAME );

	$this->_strings    =& happy_linux_strings::getInstance();
}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_modify_list();
	}
	return $instance;
}

//---------------------------------------------------------
// handler
//---------------------------------------------------------
function &_get_op_sortid_array()
{
	$arr = array(
		'list_asc'  => 0,
		'list_desc' => 1,
		'list_new'  => 2,
		'list_mod'  => 3,
		'list_del'  => 4,
	);
	return $arr;
}

function &_get_table_header()
{
	$arr = array(
		_WEBLINKS_MID,
		_WLS_LINKID,
		_WLS_SITETITLE,
	);

	return $arr;
}

function _get_total()
{
	$this->_total_all = $this->_get_total_all();
	$this->_total_new = $this->_handler->get_count_new();
	$this->_total_mod = $this->_handler->get_count_mod();
	$this->_total_del = $this->_handler->get_count_del();

	switch ($this->_sortid)
	{
		case 1:
			$total = $this->_total_all;
			break;

		case 2:
			$total = $this->_total_new;
			break;

		case 3:
			$total = $this->_total_mod;
			break;

		case 4:
			$total = $this->_total_del;
			break;

		case 0:
		default:
			$total = $this->_total_all;
			break;
	}

	return $total;
}

function &_get_items($limit=0, $start=0)
{
	switch ($this->_sortid)
	{
		case 1:
			$objs =& $this->_handler->get_objects_desc($limit, $start);
			break;

		case 2:
			$objs =& $this->_handler->get_objects_new($limit, $start);
			break;

		case 3:
			$objs =& $this->_handler->get_objects_mod($limit, $start);
			break;

		case 4:
			$objs =& $this->_handler->get_objects_del($limit, $start);
			break;

		case 0:
		default:
			$objs =& $this->_handler->get_objects_asc($limit, $start);
			break;
	}

	return $objs;
}

function &_get_cols(&$obj)
{
	$mid     = $obj->get('mid');
	$lid     = $obj->get('lid');
	$mode    = $obj->get('mode');
	$title_s = $obj->getVar('title', 's');

	if ($mode == 1)
	{
		$jump_mod  = 'link_manage.php?op=list_mod&mid=';
		$jump_link = 'link_manage.php?op=mod_form&lid=';
		$link_link = $this->_build_page_id_link_by_obj( $obj, 'lid', $jump_link);
	}
	else
	{
		$jump_mod  = 'link_manage.php?op=list_new&mid=';
		$link_link = '---';
	}

	switch ($mode)
	{
		case 1:
			$jump_mod  = 'link_manage.php?op=list_mod&mid=';
			$jump_link = 'link_manage.php?op=mod_form&lid=';
			$link_link = $this->_build_page_id_link_by_obj( $obj, 'lid', $jump_link);
			break;

		case 2:
			$jump_mod  = 'link_manage.php?op=list_del&mid=';
			$jump_link = 'link_manage.php?op=mod_form&lid=';
			$link_link = $this->_build_page_id_link_by_obj( $obj, 'lid', $jump_link);
			break;

		case 0:
		default:
			$jump_mod  = 'link_manage.php?op=list_new&mid=';
			$link_link = '---';
			break;
	}

	$link_mod = $this->_build_page_id_link_by_obj( $obj, 'mid', $jump_mod);

	$arr = array(
		$link_mod,
		$link_link,
		$title_s,
	);

	return $arr;
}

//---------------------------------------------------------
// print
//---------------------------------------------------------
function _print_top()
{
	switch ($this->_sortid)
	{
		case 1:
			$title = _WEBLINKS_ADMIN_LINK_ALL_DESC;
			break;

		case 2:
			$title = _WLS_LINKSWAITING;
			break;

		case 3:
			$title = _WLS_MODREQUESTS;
			break;

		case 4:
			$title = _AM_WEBLINKS_DEL_REQS;
			break;

		case 0:
		default:
			$title = _WEBLINKS_ADMIN_LINK_ALL_ASC;
			break;
	}

	$total_all = $this->_total_new;
	$total_new = $this->build_html_highlight_number( $this->_total_new );
	$total_mod = $this->build_html_highlight_number( $this->_total_mod );
	$total_del = $this->build_html_highlight_number( $this->_total_del );

	echo "<h4>"._WEBLINKS_ADMIN_LINK_LIST."</h4>\n";
	printf(_WLS_THEREARE, $total_all);
	echo "<br /><br />\n";

	echo "<table width='80%' border='0' cellspacing='1' class='outer'>";
	echo "<tr class='odd'><td>";
	echo "<li><a href='modify_list.php?sortid=0'>"._WEBLINKS_ADMIN_LINK_ALL_ASC."</a> ($total_all) </li>\n";
	echo "<li><a href='modify_list.php?sortid=1'>"._WEBLINKS_ADMIN_LINK_ALL_DESC."</a> ($total_all) </li>\n";
	echo "<li><a href='modify_list.php?sortid=2'>"._WLS_LINKSWAITING."</a> ($total_new) </li>\n";
	echo "<li><a href='modify_list.php?sortid=3'>"._WLS_MODREQUESTS."</a> ($total_mod) </li>\n";
	echo "<li><a href='modify_list.php?sortid=4'>"._AM_WEBLINKS_DEL_REQS."</a> ($total_del) </li>\n";
	echo"</td></tr></table>\n";

	echo "<h4>".$title."</h4>\n";

	echo "<br />\n";
}

// --- class end ---
}


//=========================================================
// main
//=========================================================
xoops_cp_header();

weblinks_admin_print_header();
weblinks_admin_print_menu();

$list =& admin_modify_list::getInstance();
$list->_show();

weblinks_admin_print_footer();
xoops_cp_footer();
exit();
// --- end of main ---

?>