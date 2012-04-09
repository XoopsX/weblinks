<?php
// $Id: category_manage.php,v 1.2 2012/04/09 10:20:04 ohwada Exp $

// 2012-04-02 K.OHWADA
// weblinks_webmap

// 2007-12-16 K.OHWADA
// build_selbox_top()

// 2007-11-01 K.OHWADA
// link_vote_del_handler
// set_flag_execute_time()

// 2007-09-20 K.OHWADA
// admin_header_link.php
// banner_handler

// 2007-09-01 K.OHWADA
// link_edit_handler -> link_edit_base_handler

// 2007-08-01 K.OHWADA
// weblinks_gmap

// 2007-06-10 K.OHWADA
// link_catlink_basic_handler
// get_options_for_cat_forum()

// 2007-05-12 K.OHWADA
// Notice [PHP]: Use of undefined constant imgurl

// 2007-04-08 K.OHWADA
// gm_type, description

// 2007-04-02 K.OHWADA
// Fatal error: Call to undefined function: print_warnig()
// Fatal error: Call to undefined function: _get_image_size()

// 2007-03-25 K.OHWADA
// update_image_size()
// remove del_cat() in admin_form_category 

// 2007-02-20 K.OHWADA
// hack for multi site
// add forum_id field, etc
// update_path()

// 2006-11-18 K.OHWADA
// small change _save()

// 2006-09-20 K.OHWADA
// use happy_linux
// use XoopsGTicket

// 2006-09-18 K.OHWADA
// support xoops protector

// 2006-05-15 K.OHWADA
// new handler
// add class admin_category_manage
// use token ticket

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication

//=========================================================
// WebLinks Module
// admin category manage
// 2004/01/14 K.OHWADA
//=========================================================

include 'admin_header.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_block_webmap.php';
include_once WEBLINKS_ROOT_PATH.'/class/weblinks_webmap.php';

//=========================================================
// class admin_category_manage
//=========================================================
class admin_category_manage extends happy_linux_manage
{
// class
	var $_config_handler;
	var $_link_vote_handler;
	var $_link_handler;
	var $_catlink_handler;
	var $_link_catlink_handler;

	var $_strings;
	var $_time_class;

	var $_cat_obj;

	var $_conf;
	var $_conf_cat_path_count;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_category_manage()
{
	$this->happy_linux_manage( WEBLINKS_DIRNAME );

	$this->set_handler( 'category', WEBLINKS_DIRNAME, 'weblinks' );
	$this->set_id_name( 'cid' );
	$this->set_form_class( 'admin_form_category' );
	$this->set_script(   'category_manage.php' );
	$this->set_redirect( 'category_list.php', 'category_list.php?sortid=1' );
	$this->set_title( _AM_WEBLINKS_ADD_CATEGORY, _WLS_MODCAT, _WLS_DELCAT );
	$this->set_err_no_record( _WEBLINKS_NO_CATEGORY );
	$this->set_module_dirname( 'weblinks' );
	$this->set_flag_execute_time( true );

	$this->_config_handler       =& weblinks_get_handler( 'config2_basic', WEBLINKS_DIRNAME );
	$this->_link_vote_handler    =& weblinks_get_handler('link_vote_del',  WEBLINKS_DIRNAME);
	$this->_link_handler         =& weblinks_get_handler('link',           WEBLINKS_DIRNAME);
	$this->_catlink_handler      =& weblinks_get_handler('catlink',        WEBLINKS_DIRNAME);
	$this->_banner_handler       =& weblinks_get_handler('banner',         WEBLINKS_DIRNAME );
	$this->_link_catlink_handler =& weblinks_get_handler('link_catlink_basic', WEBLINKS_DIRNAME );

	$this->_strings    =& happy_linux_strings::getInstance();
	$this->_time_class =& happy_linux_time::getInstance();

	$this->_conf = $this->_config_handler->get_conf();
	if ( $this->_conf['cat_path'] || $this->_conf['cat_count'] )
	{
		$this->_conf_cat_path_count = true;
	}
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_category_manage();
	}
	return $instance;
}


//---------------------------------------------------------
// POST param
//---------------------------------------------------------
function get_post_op()
{
	$op = 'main';
	if     ( isset($_POST['del_cat']) )    $op = 'del_cat';
	elseif ( isset($_POST['delete']) )     $op = 'del_cat';
	elseif ( isset($_POST['op']) )         $op = $_POST['op'];
	elseif ( isset($_GET['op']) )          $op = $_GET['op'];
	return $op;
}

//---------------------------------------------------------
// init
//---------------------------------------------------------
function init()
{
	$this->_handler->load();
}

//---------------------------------------------------------
// main_add_form()
//---------------------------------------------------------
function add_form()
{
	$this->_main_add_form();
}

function _print_add_form()
{
	$obj =& $this->_handler->create();
	$obj->set('lflag', 1);
	$this->_form->_show_add($obj);
	return true;
}

//---------------------------------------------------------
// main_add_table()
//---------------------------------------------------------
function add_table()
{
	$this->_main_add_table( true );
}

function _main_add_table( $check_flag=false )
{
	if ( !$this->_check_token() || !$this->_check_add_table() )
	{
		$this->_print_add_preview();
		exit();
	}

	if ( $this->_exec_add_table() )
	{
		if ( $this->_conf_cat_path_count )
		{
			$this->_print_update_path_form( 'add' );
			exit();
		}

		$msg  = $this->_LANG_MSG_ADD;
		$msg .= $this->_build_comment('add record');	// for test form
		redirect_header($this->_redirect_desc, 1, $msg );
		exit();
	}
	else
	{
		$this->_print_add_db_error();
		exit();
	}

}

function _check_add_table()
{
	$this->_clear_errors();

// support xoops protector
	if ( !$this->_post->is_post_set('pid') )
	{
		$this->_set_errors( _WLS_ERROR_CATEGORY );
	}

	$this->_check_fill_by_post('title',  _WLS_TITLEC);
	$this->_check_url_by_post( 'imgurl', _WEBLINKS_IMGURL_MAIN, false);

	return $this->returnExistError();
}

function _exec_add_table()
{
	$title = $this->_post->get_post_text('title');

	$obj =& $this->_handler->create();
	$obj->set_vars_by_post();
	$obj->set_pid_by_post();
	$obj->set_desc_by_post();

// Notice [PHP]: Use of undefined constant imgurl
	$imgurl = $obj->get('imgurl');

	if ($imgurl)
	{
		list($orig_width, $orig_height, $show_width, $show_height) =
			$this->_get_image_size( $imgurl );

		$obj->setVar('img_orig_width',  $orig_width);
		$obj->setVar('img_orig_height', $orig_height);
		$obj->setVar('img_show_width',  $show_width);
		$obj->setVar('img_show_height', $show_height);
	}

	$newid = $this->_handler->insert($obj);
	if ( !$newid )
	{
		$this->_set_errors( $this->_handler->getErrors() );
		return false;
	}

	$tags = array();
	$tags['CATEGORY_NAME'] = $title;
	$tags['CATEGORY_URL'] = WEBLINKS_URL.'/viewcat.php?cid='.$newid;
	$notification_handler =& xoops_gethandler('notification');
	$notification_handler->triggerEvent('global', 0, 'new_category', $tags);

	return true;
}

//---------------------------------------------------------
// main_mod_form()
//---------------------------------------------------------
function mod_form()
{
	$this->_main_mod_form();
}

//---------------------------------------------------------
// main_mod_table()
//---------------------------------------------------------
function mod_table()
{
	$this->_main_mod_table();
}

function _main_mod_table( $check_flag=false )
{
	if ( !$this->_get_obj() )
	{
		redirect_header( $this->_redirect_asc, 3, $this->_LANG_ERR_NO_RECORD );
		exit();
	}

	if ( !$this->_check_token() || !$this->_check_mod_table() )
	{
		$this->_print_mod_preview();
		exit();
	}

	if ( $this->_exec_mod_table() )
	{
		if ( $this->_conf_cat_path_count )
		{
			$this->_print_update_path_form( 'mod' );
			exit();
		}

		$msg  = $this->_LANG_MSG_MOD;
		$msg .= $this->_build_comment('mod record');	// for test form
		redirect_header($this->_redirect_asc, 1, $msg);
		exit();
	}
	else
	{
		$this->_print_mod_db_error();
		exit();
	}
}

function _check_mod_table()
{
	return $this->_check_add_table();
}

function _exec_mod_table()
{
	$orig_width  = 0;
	$orig_height = 0;
	$show_width  = 0;
	$show_height = 0;

	$this->_modid = $this->_get_post_get_id();

	$obj =& $this->_obj;
	$obj->set_vars_by_post();
	$obj->set_desc_by_post();

// Notice [PHP]: Use of undefined constant imgurl
	$imgurl = $obj->get('imgurl');

	if ($imgurl)
	{
		list($orig_width, $orig_height, $show_width, $show_height) =
			$this->_get_image_size( $imgurl );
	}

	$obj->setVar('img_orig_width',  $orig_width);
	$obj->setVar('img_orig_height', $orig_height);
	$obj->setVar('img_show_width',  $show_width);
	$obj->setVar('img_show_height', $show_height);

	if ( !$this->_handler->update( $obj ) ) 
	{
		$this->_set_errors( $this->_LANG_FAIL_MOD );
		$this->_set_errors( $this->_handler->getErrors() );
		return false;
	}
	return true;
}

//---------------------------------------------------------
// main_del_table()
//---------------------------------------------------------
function del_cat()
{
	if ( !$this->_get_obj() )
	{
		redirect_header( 'category_list.php', 3, _WEBLINKS_NO_CATEGORY );
		exit();
	}

	if ( !$this->_check_token() )
	{
		redirect_header( $this->_build_script_mod_form(), 3, "Token Error");
		exit();
	}

	$cid = $this->_post->get_post_int('cid');
	$ok  = $this->_post->get_post_int('ok');

	$this->_print_cp_header();
	$this->_print_bread_op( _WLS_DELCAT );
	$this->_print_title(    _WLS_DELCAT );

	$MAX_SUBCAT_DEL  = 4;
	$MAX_LINK_BELONG = 10;
	$MAX_LINK_DEL    = 10;

    if ( $ok == 1 ) 
	{
		echo "<h3>"._WLS_DELCAT."</h3>\n";
	}
	else
	{
		echo "<h3 style='color: #0000ff'>"._WLS_WARNING."</h3>\n";
	}

// The specified category
	echo "<h4>"._WLS_CATEGORY."</h4>\n";

	$title_s = $this->_obj->getVar('title', 's');
	echo "$cid: $title_s <br />\n";

// sub categories
	echo "<h4>"._WLS_SUBCATEGORY."</h4>\n";

	$sub_arr   = $this->_handler->getAllChildId($cid);

	$sub_count = count($sub_arr);
	if ($sub_count > 0)
	{
		foreach ($sub_arr as $sub) 
		{
			$obj2 = $this->_handler->get($sub);
			$title_s = $obj2->getVar('title', 's');
			echo "$sub: $title_s <br />\n";
		}
	}
	else
	{
		echo _WLS_SUBCATEGORY_NON."<br />\n";
	}

// limit over
	if ($sub_count > $MAX_SUBCAT_DEL)
	{
		echo "<br />\n";
		echo $this->_form->build_html_highlight( _WLS_ERROR_MAX_SUBCAT );
		echo " ($MAX_SUBCAT_DEL) <br />\n";
		echo "<hr />\n";
		$this->_print_cp_footer_with_goto_list();
		exit();
	}

// all link belonging to this category
	echo "<h4>"._WLS_LINK_BELONG."</h4>\n";

	$cid_arr    = array_merge( array($cid), $sub_arr );
	$lid_arr    = $this->_catlink_handler->get_lid_array_by_cid_array($cid_arr);
	$cid_count  = count($cid_arr);
	$link_count = count($lid_arr);
	$link_del_count = 0;

	if ($link_count > 0)
	{
		echo _WLS_LINK_BELONG_NUMBER.": ".count($lid_arr)."<br />\n";
		echo "<h4>"._WLS_LINK_MAYBE_DELETE."</h4>\n";

		if ($cid_count > 0)
		{
			echo _WLS_LINK_MAYBE_DELETE_DSC."<br /><br />\n";
		}

		foreach ($lid_arr as $lid)
		{

// get the number of the categories belonging to this link 
			$num = $this->_catlink_handler->get_count_by_lid($lid);

// the link belongs only to this category
			if ($num == 1)
			{
				$link_obj = $this->_link_handler->get($lid);

				if ( is_object($link_obj) )
				{
					$link_title_s = $link_obj->getVar('title', 's');
					echo "link: $lid: $link_title_s <br />\n";
				}
				else
				{
					$msg = "link not exist lid = $lid";
					$this->print_error($msg);
				}

				$link_del_count ++;
			}
		}

		if ($link_del_count == 0)
		{
			echo $this->_form->build_html_highlight( _WLS_LINK_DELETE_NON, '#0000ff' );
		}
	}
	else
	{
		echo _WLS_LINK_BELONG_NON."<br />\n";
	}

// limit over
	if ($link_del_count > $MAX_LINK_DEL)
	{
		echo "<br />\n";
		echo $this->_form->build_html_highlight( _WLS_ERROR_MAX_LINK_DEL );
		echo " ($MAX_LINK_DEL) <br />\n";
		echo "<hr />\n";
		$this->_print_cp_footer_with_goto_list();
		exit();
	}

// limit over
	if ($link_count > $MAX_LINK_BELONG)
	{
		echo "<br />\n";
		echo $this->_form->build_html_highlight( _WLS_ERROR_MAX_LINK_BELONG );
		echo " ($MAX_LINK_BELONG) <br />\n";
		echo "<hr />\n";
		$this->_print_cp_footer_with_goto_list();
		exit();
	}

// excute
    if ( $ok == 1 ) 
    {
		echo "<br /><hr />\n";
		echo "<h4>"._WLS_CATEGORY_LINK_DELETE_EXCUTE."</h4>\n";

		$flag_error = false;

// sub category
		foreach ($sub_arr as $sub) 
		{
			$ret = $this->_exec_del_cat( $sub );
			if ( !$ret )
			{	$flag_error = true;	}
		}

		$ret = $this->_exec_del_cat($cid);
		if ( !$ret )
		{	$flag_error = true;	}

		echo "<h4>"._WLS_CATEGORY_LINK_DELETED."</h4>\n";

		if ($flag_error)
		{
			$this->print_error( _AM_WEBLINKS_ERROR_SOME );
		}

		echo "<hr />\n";

		if ( $this->_conf_cat_path_count )
		{
			$this->_form->update_path();
		}

		$this->_print_cp_footer_with_goto_list();
		return;
	}

// confirm
	else 
	{
		$this->_form->del_cat_ok($cid);
		xoops_cp_footer();
 		return;
    }

	xoops_cp_footer();	// dummy
}

function _exec_del_cat($cid)
{
	$flag_error = false;

	$mid = $this->_system->get_mid();

// get the link id is belonging to this category 
	$lid_arr = $this->_catlink_handler->get_lid_array_by_cid($cid);

	foreach ($lid_arr as $lid)
	{

// get the number of the categories belonging to this link 
		$num = $this->_catlink_handler->get_count_by_lid($lid);

// delete this link, if it belongs only to this category
		if ($num == 1)
		{
			$link_obj = $this->_link_handler->get($lid);

			if ( is_object($link_obj) )
			{
				$title_s = $link_obj->getVar('title', 's');
				echo "$lid: $title_s <br />\n";
			}
			else
			{
				$flag_error = true;
				$msg = "link not exist lid = $lid ";
				$this->print_error($msg);
			}

// BUG 3095: the number of links does not change, if delete link
			$ret = $this->_link_vote_handler->del_link_vote_comm_by_lid($lid);
			if (!$ret)
			{
				$flag_error = true;
				$msg = $this->_link_vote_handler->getErrors(1);
				$this->print_error($msg);
			}
		}
	}

// delete category
	$obj = $this->_handler->get($cid);

	if ( is_object($obj) )
	{
		$title_s = $obj->getVar('title', 's');
		echo _WLS_CATEGORY_DELETED.": $cid: $title_s <br />\n";

		$ret = $this->_handler->delete($obj);
		if (!$ret)
		{
			$flag_error = true;
			$msg = $this->_handler->getErrors(1);
			$this->print_error($msg);
		}
	}
	else
	{
		$flag_error = true;
		$msg = "category not exist cid = $cid ";
		$this->print_error($msg);
	}

// delete comments & notifications
	xoops_notification_deletebyitem( $mid, 'category', $cid );

	if ( $flag_error ) { return false; }
	return true;
}

function _print_cp_footer_with_goto_list()
{
		echo "<br />\n";
		echo '- <a href="category_list.php">'._WEBLINKS_ADMIN_CATEGORY_LIST."</a><br />\n";
		xoops_cp_footer();
}

//---------------------------------------------------------
// reorder_cat
//---------------------------------------------------------
function reorder_cat()
{
	$pid = $this->_post->get_post_get_int('pid');
	$url = 'category_list.php?sortid=3&amp;pid='.$pid;

	if( !( $this->_check_token() ) ) 
	{
		redirect_header( $url, 3, "Token Error");
		exit();
	}

	if ( $this->_exec_reorder_cat() )
	{
		redirect_header( $url, 1, _WEBLINKS_ORDERS_UPDATED);
		exit();
	}

	xoops_cp_header();
	$this->_print_bread_op( _WLS_DELCAT );
	$this->_print_title(    _WLS_DELCAT );
	xoops_error("DB Error");
	echo $this->getErrors(1);
	xoops_cp_footer();
}

function _exec_reorder_cat()
{
	$this->_clear_errors();

	$order_arr = $this->_post->get_post('orders');

	foreach ($order_arr as $key => $value)
	{
		$cid    = intval($key);
		$orders = intval($value);
		$obj =& $this->_handler->get($cid);

		if ( is_object($obj) )
		{
			$obj->setVar('orders', $orders);

			$ret = $this->_handler->update($obj);
			if (!$ret)
			{
				$this->_set_error( $this->_handler->getErrors(1) );
			}
		}
		else
		{
			$msg = "category not exist cid = $cid ";
			$this->_set_error($msg);
		}
	}

	return $this->returnExistError();
}

//---------------------------------------------------------
// update_path
//---------------------------------------------------------
function update_path_form()
{
	$this->_print_update_path_form( 'update_path' );
}

function _print_update_path_form( $op_mode )
{
	$name = _AM_WEBLINKS_UPDATE_CAT_PATH;

	switch ($op_mode)
	{
		case 'add':
			$title = _AM_WEBLINKS_ADD_CATEGORY;
			$op    = 'add_form';
			break;

		case 'mod':
			$title = _WLS_MODCAT;
			$op    = 'mod_form';
			break;

		default:
		case 'update_path':
			$title = _AM_WEBLINKS_UPDATE_CAT_PATH;
			$op    = 'update_path_form';
			$name  = '';
			break;
	}

	$this->_print_cp_header();
	$this->_print_bread_op( $title, $op, $name );
	$this->_print_title( _AM_WEBLINKS_UPDATE_CAT_PATH );
	$this->_form->update_path();
	$this->_print_cp_footer();
}

function update_path()
{
	$url_end = 'category_list.php';
	$url_err = 'category_manage.php?op=update_path_form';

	if( !( $this->_check_token() ) ) 
	{
		redirect_header( $url_err, 3, "Token Error");
		exit();
	}

	if ( $this->_exec_update_path() )
	{
		$time = $this->_time_class->get_elapse_time();
		$msg  = _WLS_DBUPDATED." : $time sec ";
		$msg .= $this->_build_comment('update path');	// for test form
		redirect_header( $url_end, 1, $msg );
		exit();
	}

	xoops_cp_header();
	$this->_print_bread_op( _AM_WEBLINKS_UPDATE_CAT_PATH );
	$this->_print_title(    _AM_WEBLINKS_UPDATE_CAT_PATH );
	xoops_error("DB Error");
	echo $this->getErrors(1);
	xoops_cp_footer();
}

function _exec_update_path()
{
	$this->_handler->build_tree();

	foreach ( $this->_handler->get_cat_info_array() as $cid => $info ) 
	{
		if ($cid == 0) continue;

		$tree   = $info['tree'];
		$parent = implode( '|', $info['parent']);
		$child  = implode( '|', $info['child']);
		$count  = 0;

		$arr   =& $this->_handler->get_parent_and_all_child_id($cid);
		$count =  $this->_link_catlink_handler->get_count_by_cid_array($arr);

		$obj =& $this->_handler->get($cid);
		$obj->setVar('tree_order',  $tree);
		$obj->setVar('cids_parent', $parent);
		$obj->setVar('cids_child',  $child);
		$obj->setVar('link_count',  $count);

		$ret =  $this->_handler->update($obj);
		if (!$ret)
		{
			$this->_set_errors( $this->_handler->getErrors() );
		}
	}

	return $this->returnExistError();
}

//---------------------------------------------------------
// update_image_size
//---------------------------------------------------------
function update_image_size_form()
{
	$this->_print_cp_header();
	$this->_print_bread_op( _AM_WEBLINKS_UPDATE_CAT_IMAGE_SIZE, 'update_image_size_form' );
	$this->_print_title( _AM_WEBLINKS_UPDATE_CAT_IMAGE_SIZE );
	$this->_form->update_image_size();
	$this->_print_cp_footer();
}

function update_image_size()
{
	$url_end = 'category_list.php';
	$url_err = 'category_manage.php?op=update_image_size_form';

	if( !( $this->_check_token() ) ) 
	{
		redirect_header( $url_err, 3, "Token Error");
		exit();
	}

	if ( $this->_exec_update_image_size() )
	{
		$time = $this->_time_class->get_elapse_time();
		$msg  = _WLS_DBUPDATED." : $time sec ";
		$msg .= $this->_build_comment('update image size');	// for test form
		redirect_header( $url_end, 1, $msg );
		exit();
	}

	xoops_cp_header();
	$this->_print_bread_op( _AM_WEBLINKS_UPDATE_CAT_IMAGE_SIZE );
	$this->_print_title(    _AM_WEBLINKS_UPDATE_CAT_IMAGE_SIZE );
	xoops_error("DB Error");
	echo $this->getErrors(1);
	xoops_cp_footer();
}

function _exec_update_image_size()
{
	$list =& $this->_handler->getList();

	foreach ( $list as $cid ) 
	{
		$obj =& $this->_handler->get($cid);

		$imgurl = $obj->get('imgurl');
		if ( empty($imgurl) )  continue;

		list($orig_width, $orig_height, $show_width, $show_height) =
			$this->_get_image_size( $imgurl );

		if (( $orig_width == 0 )||( $orig_height == 0 ))  continue;

		$obj->setVar('img_orig_width',  $orig_width);
		$obj->setVar('img_orig_height', $orig_height);
		$obj->setVar('img_show_width',  $show_width);
		$obj->setVar('img_show_height', $show_height);

		$ret =  $this->_handler->update($obj);
		if (!$ret)
		{
			$this->_set_errors( $this->_handler->getErrors() );
		}

		unset($obj);
	}

	return $this->returnExistError();
}

//---------------------------------------------------------
// banner handler
//---------------------------------------------------------
function _get_image_size($url)
{
	$size = $this->_banner_handler->get_cat_image_size( $url );
	if ( !$size )
	{	return array( 0, 0, 0, 0 );	}

	$arr = array(
		$size['orig_width'],
		$size['orig_height'],
		$size['show_width'],
		$size['show_height'],
	);

	return $arr;
}

//---------------------------------------------------------
// form test
//---------------------------------------------------------
function test()
{
	$arr = array(
    	'cid'    => 0,
    	'title'  => 'TEST',
    	'lflag'  => 1,
    	'orders' => 0,
    	'pid'    => 0,
    	'imgurl' => 'http://TEST/',
	);

	xoops_cp_header();
	$obj =& $this->_handler->create();
	$obj->assignVars($arr);
	$this->_form->_show_add_preview($obj);
	xoops_cp_footer();
}

//---------------------------------------------------------
// private print
//---------------------------------------------------------
function _print_menu()
{
	weblinks_admin_print_header();
	weblinks_admin_print_menu();
}

// --- class end ---
}

//=========================================================
// class admin_form_category
//=========================================================
class admin_form_category extends happy_linux_form
{
	var $_handler;
	var $_config_handle;
	var $_plugin;
	var $_header;
	var $_webmap_class;

	var	$_flag_webmap = false;

// hack for multi site
	var $_flag_show_aux_int_1  = false;
	var $_flag_show_aux_int_2  = false;
	var $_flag_show_aux_text_1 = false;
	var $_flag_show_aux_text_2 = false;
	var $_aux_text_1 = _WEBLINKS_CAT_AUX_TEXT_1;
	var $_aux_text_2 = _WEBLINKS_CAT_AUX_TEXT_2;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_form_category()
{
	$this->happy_linux_form();

	$this->_handler           =& weblinks_get_handler('category',       WEBLINKS_DIRNAME );
	$this->_config_handler    =& weblinks_get_handler('config2_basic',  WEBLINKS_DIRNAME );
	$this->_plugin       =& weblinks_plugin::getInstance( WEBLINKS_DIRNAME );
	$this->_header       =& weblinks_header::getInstance( WEBLINKS_DIRNAME );
	$this->_webmap_class =& weblinks_webmap::getInstance( WEBLINKS_DIRNAME );

// hack for multi site
	if ( weblinks_multi_is_japanese_site() )
	{
		$this->_flag_show_aux_text_1 = true;
		$this->_aux_text_1 = _WEBLINKS_CAT_TITLE_JP;
	}

}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_form_category();
	}
	return $instance;
}

//---------------------------------------------------------
// show category
//---------------------------------------------------------
function _show(&$obj, $extra=null, $show_mode=0 )
{
	$cid = $obj->getVar('cid', 'e');

	echo $this->_header->build_module_header_submit();

	$ret = $this->_webmap_class->init_form();
	if ( $ret == 1 ) {
		$this->_flag_webmap = true;
		$this->_webmap_class->set_cid( $cid );
		$this->_webmap_class->set_display_url();
		echo $this->_webmap_class->get_form_js( false );

	} elseif ( $ret == -1 ) {
		xoops_error( $this->_webmap_class->get_init_error() );
	}

	switch ($show_mode) 
	{
		case HAPPY_LINUX_MODE_MOD:
		case HAPPY_LINUX_MODE_MOD_PREVIEW:
			$show_mode  = HAPPY_LINUX_MODE_MOD;
			$form_title = _WLS_MODCAT;
			$op         = 'mod_table';
			$button_val = _WLS_MODIFY;
			break;

		case HAPPY_LINUX_MODE_ADD:
		case HAPPY_LINUX_MODE_ADD_PREVIEW:
		default:
			$form_title = _AM_WEBLINKS_ADD_CATEGORY;
			$op         = 'add_table';
			$button_val = _WLS_ADD;
			break;
	}

	$this->set_obj($obj);

	$selbox = $this->_handler->build_selbox_top( $obj->get('pid'), 1, 'pid', '' );

	$forum_opt = $this->_plugin->get_options_for_cat_forum();
	$forum_sel = $this->build_html_select('forum_id', $obj->get('forum_id'), $forum_opt );
	$forum_dirname = $this->_config_handler->get_module_name( 'cat_forum_dirname' );
	if ( $forum_dirname )
	{
		$forum_sel .= ' in '.$forum_dirname;
	}

	$album_opt = $this->_plugin->get_options_for_cat_album();
	$album_sel = $this->build_html_select('album_id', $obj->get('album_id'), $album_opt );
	$album_dirname = $this->_config_handler->get_module_name( 'cat_album_dirname' );
	if ( $album_dirname )
	{
		$album_sel .= ' in '.$album_dirname;
	}

	$desc     = $this->_build_cat_desc( $obj );
	$desc_opt = $this->_build_cat_desc_opt( $obj );

	echo $this->build_form_begin( 'modCat' );
	echo $this->build_token();
	echo $this->build_html_input_hidden('op',  $op);
	echo $this->build_html_input_hidden('cid', $cid);
	echo $this->build_form_table_begin();
	echo $this->build_form_table_title( $form_title );

	if ( $show_mode == HAPPY_LINUX_MODE_MOD )
	{
		echo $this->build_form_table_line( _WLS_CATEGORYID, '<b>'.$cid.'</b>');
	}

	echo $this->build_obj_table_text( _WLS_TITLEC, 'title' );
	echo $this->_build_cat_lflag(  $obj->getVar('lflag') );
	echo $this->build_obj_table_text( _WEBLINKS_CAT_ORDER, 'orders' );
	echo $this->build_form_table_line( _WLS_PARENT, $selbox);
	echo $this->build_form_table_line( _WEBLINKS_FORUM_SEL, $forum_sel);
	echo $this->build_form_table_line( _WEBLINKS_ALBUM_SEL, $album_sel);
	echo $this->_build_cat_gm_mode(  $obj->get('gm_mode') );

	if ( $this->_flag_webmap ) {
		$cap_gm_location = $this->build_form_caption( _WEBLINKS_GM_LOCATION, _AM_WEBLINKS_GM_LOCATION_DSC );

		echo $this->build_form_table_line( '', $this->_webmap_class->build_form_desc() );
		echo $this->_build_cat_gm();
		echo $this->build_obj_table_text( $cap_gm_location,       'gm_location' );
		echo $this->build_obj_table_text( _WEBLINKS_GM_LATITUDE,  'gm_latitude' );
		echo $this->build_obj_table_text( _WEBLINKS_GM_LONGITUDE, 'gm_longitude' );
		echo $this->build_obj_table_text( _WEBLINKS_GM_ZOOM,      'gm_zoom' );
		echo $this->_build_cat_gm_type(  $obj->get('gm_type') );
		echo $this->_build_cat_gm_icon(  $obj->get('gm_icon') );
	}

	echo $this->build_form_table_line( _WLS_DESCRIPTION, $desc );
	echo $this->build_form_table_line( _WEBLINKS_OPTIONS, $desc_opt );
	echo $this->_build_cat_imgurl( $obj );

	if ( $this->_flag_show_aux_int_1 )
	{
		echo $this->build_obj_table_text( _WEBLINKS_CAT_AUX_INT_1,  'aux_int_1' );
	}

	if ( $this->_flag_show_aux_int_2 )
	{
		echo $this->build_obj_table_text( _WEBLINKS_CAT_AUX_INT_2,  'aux_int_2' );
	}

	if ( $this->_flag_show_aux_text_1 )
	{
		echo $this->build_obj_table_text( $this->_aux_text_1, 'aux_text_1' );
	}

	if ( $this->_flag_show_aux_text_2 )
	{
		echo $this->build_obj_table_text( $this->_aux_text_1, 'aux_text_2' );
	}

	$button = $this->build_html_input_submit('post', $button_val);
	if ( $show_mode == HAPPY_LINUX_MODE_MOD )
	{
		$button .= ' '.$this->build_html_input_submit('delete', _DELETE);
		$button .= ' '.$this->build_html_input_button_cancel('cancel', _CANCEL);
	}
	echo $this->build_form_table_line('', $button, 'foot', 'foot');

	echo $this->build_form_table_end();
	echo $this->build_form_end();

}

function del_cat_ok($cid)
{
	echo $this->build_form_begin( 'delCat' );
	echo $this->build_token();
	echo $this->build_html_input_hidden('op',  'delCat');
	echo $this->build_html_input_hidden('ok',  1);
	echo $this->build_html_input_hidden('cid', $cid);
	echo $this->build_form_table_begin();
	echo $this->build_form_table_title(  _WLS_DELCAT );

	$button  = $this->build_html_input_submit('post', _DELETE);
	$button .= ' '.$this->build_html_input_button_cancel('cancel', _CANCEL);
	echo $this->build_form_table_line('', $button, 'foot', 'foot');

	echo $this->build_form_table_end();
	echo $this->build_form_end();
}

function _build_cat_lflag( $value=1 )
{
	$opt = array(
		_WLS_NOTLINKFLAG => 0,
		_WLS_LINKFLAG    => 1,
		);

	$ele = $this->build_form_table_radio_select('', 'lflag', $value, $opt);
	return $ele;
}

function _build_cat_gm_mode( $value )
{
	$opt = array(
		_AM_WEBLINKS_MODE_NON       => 0,
		_AM_WEBLINKS_MODE_DEFAULT   => 1,
		_AM_WEBLINKS_MODE_PARENT    => 2,
		_AM_WEBLINKS_MODE_FOLLOWING => 3,
		);

	$ele = $this->build_form_table_radio_select(_AM_WEBLINKS_CAT_SHOW_GM, 'gm_mode', $value, $opt);
	return $ele;
}

function _build_cat_gm_type( $value )
{
	$opt = array(
		_WEBLINKS_GM_TYPE_MAP       => 0,
		_WEBLINKS_GM_TYPE_SATELLITE => 1,
		_WEBLINKS_GM_TYPE_HYBRID    => 2,
		);

	$ele = $this->build_form_table_radio_select(_WEBLINKS_GM_TYPE, 'gm_type', $value, $opt);
	return $ele;
}

function _build_cat_gm_icon( $value )
{
	$text = $this->_webmap_class->build_ele_icon( $value );
	$ele = $this->build_form_table_line( _WEBLINKS_GM_ICON, $text );
	return $ele;
}

function _build_cat_gm()
{
	$text  = $this->build_html_tr_tag_begin('left', 'top');
	$text .= $this->build_html_td_tag_begin('', '', 2, '', 'odd');
	$text .= $this->_webmap_class->build_form_iframe();
	$text .= $this->build_html_td_tag_end();
	$text .= $this->build_html_tr_tag_end();
	return $text;
}

function _build_cat_desc( &$obj )
{
	$name_dhtml = 'weblinks_description';
	$value      = $obj->getVar('description', 'n');
	$rows       = 10;
	$cols       = 50;

	$text = $this->build_form_dhtml_textarea( $name_dhtml, $value, $rows, $cols );
	return $text;
}

function _build_cat_desc_opt( &$obj )
{
	$text  = $this->_build_cat_opt( $obj, 'dohtml' );
	$text .= $this->_build_cat_opt( $obj, 'dosmiley' );
	$text .= $this->_build_cat_opt( $obj, 'doxcode' );
	$text .= $this->_build_cat_opt( $obj, 'doimage' );

	$name  = 'dobr';
	$value = $obj->getVar($name, 'n');
	$options = array(
		_WEBLINKS_DOBREAK => 1,
	);
	$text .= $this->build_html_input_checkbox_select($name, $value, $options);

	return $text;
}

function _build_cat_opt( &$obj, $name )
{
	$value      = $obj->getVar($name, 'n');
	$const_name = '_WEBLINKS_'.strtoupper($name);
	$const      = constant($const_name);
	$options = array(
		$const => 1,
	);

	$text  = $this->build_html_input_checkbox_select($name, $value, $options);
	$text .= "<br />\n";
	return $text;
}

function _build_cat_imgurl( &$obj )
{
	$imgurl      = $obj->getVar('imgurl', 'e');
	$orig_width  = $obj->getVar('img_orig_width');
	$orig_height = $obj->getVar('img_orig_height');
	$show_width  = $obj->getVar('img_show_width');
	$show_height = $obj->getVar('img_show_height');

	$imgurl_desc = _WEBLINKS_IMGURL_MAIN_DSC1;

	$imgurl_disp = $imgurl;
	if ( empty($imgurl_disp) )
	{
		$imgurl_disp = 'http://';
	}

	$imgurl_cap  = $this->build_form_caption( _WEBLINKS_IMGURL_MAIN, $imgurl_desc );
	$imgurl_text = $this->build_html_input_text('imgurl', $imgurl_disp, 100, 255);

	$text  = $this->build_html_tr_tag_begin('left', 'top');
	$text .= $this->build_html_td_tag_begin('left', '', 2, '', 'head');
	$text .= $this->substute_blank($imgurl_cap);
	$text .= $this->build_html_td_tag_end();
	$text .= $this->build_html_tr_tag_end();
	$text .= $this->build_html_td_tag_begin('left', '', 2, '', 'odd');
	$text .= $this->substute_blank($imgurl_text);

	if ( $imgurl )
	{
		$text .= "<br /><br />\n";
		$text .= $this->build_html_img_tag($imgurl, $show_width, $show_height, 0, 'category image');
		$text .= "<br />\n";
		$text .= $orig_width.' x '.$orig_height;
		$text .= "<br />\n";
	}

	$text .= $this->build_html_td_tag_end();
	$text .= $this->build_html_tr_tag_end();

	return $text;
}

//---------------------------------------------------------
// update_path
//---------------------------------------------------------
function update_path()
{
	echo $this->build_form_begin( 'update_path' );
	echo $this->build_token();
	echo $this->build_html_input_hidden('op', 'update_path');
	echo $this->build_form_table_begin();
	echo $this->build_form_table_title( _AM_WEBLINKS_UPDATE_CAT_PATH );
	echo $this->build_form_table_submit( '', 'submit', _HAPPY_LINUX_EXECUTE );
	echo $this->build_form_table_end();
	echo $this->build_form_end();
}

//---------------------------------------------------------
// update_image_size
//---------------------------------------------------------
function update_image_size()
{
	echo $this->build_form_begin( 'update_image_size' );
	echo $this->build_token();
	echo $this->build_html_input_hidden('op', 'update_image_size');
	echo $this->build_form_table_begin();
	echo $this->build_form_table_title( _AM_WEBLINKS_UPDATE_CAT_IMAGE_SIZE );
	echo $this->build_form_table_submit( '', 'submit', _HAPPY_LINUX_EXECUTE );
	echo $this->build_form_table_end();
	echo $this->build_form_end();
}

// --- class end ---
}

//=========================================================
// main
//=========================================================
// hack for multi site
weblinks_admin_multi_redirect_jp_site();

$manage =& admin_category_manage::getInstance();

$manage->init();
$op = $manage->get_post_op();

switch ($op) 
{
case 'addCat':
case 'add_table':
	$manage->add_table();
	break;

case 'modCat':
case 'mod_form':
	$manage->mod_form();
	break;

case 'modCatS':
case 'mod_table':
	$manage->mod_table();
	break;

case 'delCat':
case 'delete':
case 'del_cat':
	$manage->del_cat();
	break;

case 'reorderCat':
case 'reorder_cat':
	$manage->reorder_cat();
	break;

case 'update_path_form':
	$manage->update_path_form();
	break;

case 'update_path':
	$manage->update_path();
	break;

case 'update_image_size_form':
	$manage->update_image_size_form();
	break;

case 'update_image_size':
	$manage->update_image_size();
	break;

case 'test':
	$manage->test();
	break;

case 'main':
case 'add_form':
default:
	$manage->add_form();
	break;
}

exit();
// --- end of main ---

?>