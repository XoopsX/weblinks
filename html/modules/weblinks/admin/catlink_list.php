<?php
// $Id: catlink_list.php,v 1.1 2011/12/29 14:32:53 ohwada Exp $

// 2007-11-01 K.OHWADA
// set_flag_execute_time()

// 2006-09-20 K.OHWADA
// this new file

//================================================================
// WebLinks Module
// 2006-09-20 K.OHWADA
//================================================================

include 'admin_header.php';
include 'admin_header_list.php';

//=========================================================
// class admin_catlink_list
//=========================================================
class admin_catlink_list extends happy_linux_page_frame
{
	var $_category_handler;
	var $_link_handler;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_catlink_list()
{
	$this->happy_linux_page_frame();
	$this->set_handler('catlink', WEBLINKS_DIRNAME, 'weblinks');
	$this->set_id_name('jid');
	$this->set_lang_title('catlink list');
	$this->set_flag_execute_time( true );

	$this->_category_handler =& weblinks_get_handler( 'category', WEBLINKS_DIRNAME );
	$this->_link_handler     =& weblinks_get_handler( 'link',     WEBLINKS_DIRNAME );
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_catlink_list();
	}
	return $instance;
}

//---------------------------------------------------------
// handler
//---------------------------------------------------------
function &_get_table_header()
{
	$arr = array(
		'jid',
		_WLS_CATEGORYID,
		_WLS_TITLEC,
		_WLS_LINKID,
		_WLS_SITETITLE,
	);

	return $arr;
}

function &_get_cols(&$obj)
{
	$jid = $obj->get('jid');
	$cid = $obj->get('cid');
	$lid = $obj->get('lid');

	$cat_title_s  = '';
	$link_title_s = '';

	$cat_obj =& $this->_category_handler->get($cid);
	if ( is_object($cat_obj) )
	{
		$cat_title_s = $cat_obj->getVar('title', 's');
	}

	$link_obj =& $this->_link_handler->get($lid);
	if ( is_object($link_obj) )
	{
		$link_title_s = $link_obj->getVar('title', 's');
	}

	$jump_catlink = 'catlink_manage.php?op=mod_form&jid=';
	$jump_cat     = 'category_manage.php?op=mod_form&cid=';
	$jump_link    = 'link_manage.php?op=mod_form&lid=';
	$link_catlink = $this->_build_page_id_link_by_obj( $obj, 'jid', $jump_catlink);
	$link_cat     = $this->_build_page_id_link_by_obj( $obj, 'cid', $jump_cat);
	$link_link    = $this->_build_page_id_link_by_obj( $obj, 'lid', $jump_link);

	$arr = array(
		$link_catlink,
		$link_cat,
		$cat_title_s,
		$link_link,
		$link_title_s,
	);

	return $arr;
}

// --- class end ---
}

//=========================================================
// main
//=========================================================
xoops_cp_header();
weblinks_admin_print_header();
weblinks_admin_print_menu();

$list =& admin_catlink_list::getInstance();
$list->_show();

xoops_cp_footer();
exit();
// --- end of main ---

?>