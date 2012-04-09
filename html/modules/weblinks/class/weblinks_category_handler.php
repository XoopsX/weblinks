<?php
// $Id: weblinks_category_handler.php,v 1.3 2012/04/09 10:20:04 ohwada Exp $

//	$this->initVar('gm_icon',      XOBJ_DTYPE_INT,   0, false );
//	$this->initVar('gm_location',  XOBJ_DTYPE_TXTBOX, null, false, 255);

// 2010-10-28 K.OHWADA
// get_cid_array_by_title_like()

// 2007-12-16 K.OHWADA
// build_selbox_top()

// 2007-11-01 K.OHWADA
// divid to weblinks_category_def_handler

// 2007-05-06 K.OHWADA
// Notice [PHP]: Use of undefined constant album_id - assumed 'album_id'

// 2007-04-08 K.OHWADA
// gm_type dohtml etc 
// set_desc_by_post()

// 2007-03-25 K.OHWADA
// album_id img_orig_width gm_latitude etc

// 2007-03-24 K.OHWADA
// BUG 4519: Fatal error: Call to undefined function: get_cid_array_by_title()

// 2007-03-17 K.OHWADA
// BUG 4507: Fatal error: Call to undefined function: getallchildid()

// 2007-03-01 K.OHWADA
// divid to category_basic_handler
// hack for multi site
// hack for multi language
// add forum_id field, etc

// 2006-11-04 K.OHWADA
// small change

// 2006-10-14 K.OHWADA
// add get_parent_and_all_child_id()

// 2006-09-20 K.OHWADA
// use happy_linux
// add build_cat_path() get_cache_var_title()

// 2006-08-07 K.OHWADA
// bug: category is html sanitized twice in edit form

// 2006-05-15 K.OHWADA
// new handler
// not use weblinks_module_base
// NOT use another class

// 2006-05-12 K.OHWADA
// BUG 3922: Fatal error when use category image

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication

//=========================================================
// WebLinks Module
// this file contain 2 class
//   weblinks_category 
//   weblinks_category_handler
// 2004/01/14 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('weblinks_category_handler') ) 
{
	define('WEBLINKS_C_CAT_TOP', 'TOP');

//=========================================================
// class weblinks_category
//=========================================================
class weblinks_category extends happy_linux_object
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_category()
{
	$this->happy_linux_object();

	$this->initVar('cid',    XOBJ_DTYPE_INT, 0, false);
	$this->initVar('pid',    XOBJ_DTYPE_INT, 0, false);
	$this->initVar('title',  XOBJ_DTYPE_TXTBOX, null, false, 255);
	$this->initVar('imgurl', XOBJ_DTYPE_URL,    null, false, 255);
	$this->initVar('cflag',      XOBJ_DTYPE_INT, 0, false);
	$this->initVar('lflag',      XOBJ_DTYPE_INT, 0, false);
	$this->initVar('tflag',      XOBJ_DTYPE_INT, 0);
	$this->initVar('displayimg', XOBJ_DTYPE_INT, 0);
	$this->initVar('description',    XOBJ_DTYPE_TXTAREA);
	$this->initVar('catdescription', XOBJ_DTYPE_TXTAREA);
	$this->initVar('catfooter',      XOBJ_DTYPE_TXTAREA);
	$this->initVar('groupid',     XOBJ_DTYPE_TXTBOX, null, false, 255);
	$this->initVar('orders',      XOBJ_DTYPE_INT,   0);
	$this->initVar('editaccess',  XOBJ_DTYPE_TXTBOX, null, false, 255);

	$this->initVar('forum_id',    XOBJ_DTYPE_INT,   0);
	$this->initVar('tree_order',  XOBJ_DTYPE_INT,   0);
	$this->initVar('cids_parent', XOBJ_DTYPE_TXTAREA);
	$this->initVar('cids_child',  XOBJ_DTYPE_TXTAREA);
	$this->initVar('link_count',  XOBJ_DTYPE_INT,   0);
	$this->initVar('link_update', XOBJ_DTYPE_INT,   0);

// aux
	$this->initVar('aux_int_1',  XOBJ_DTYPE_INT,   0);
	$this->initVar('aux_int_2',  XOBJ_DTYPE_INT,   0);
	$this->initVar('aux_text_1', XOBJ_DTYPE_TXTBOX, null, false, 255);
	$this->initVar('aux_text_2', XOBJ_DTYPE_TXTBOX, null, false, 255);

	$this->initVar('album_id',     XOBJ_DTYPE_INT,   0);

// image size
	$this->initVar('img_orig_width',  XOBJ_DTYPE_INT,   0);
	$this->initVar('img_orig_height', XOBJ_DTYPE_INT,   0);
	$this->initVar('img_show_width',  XOBJ_DTYPE_INT,   0);
	$this->initVar('img_show_height', XOBJ_DTYPE_INT,   0);

// google map
	$this->initVar('gm_mode',      XOBJ_DTYPE_INT,   1, false );
	$this->initVar('gm_latitude',  XOBJ_DTYPE_FLOAT, 0, false );
	$this->initVar('gm_longitude', XOBJ_DTYPE_FLOAT, 0, false );
	$this->initVar('gm_zoom',      XOBJ_DTYPE_INT,   0, false );
	$this->initVar('gm_type',      XOBJ_DTYPE_INT,   0, false );
	$this->initVar('gm_icon',      XOBJ_DTYPE_INT,   0, false );
	$this->initVar('gm_location',  XOBJ_DTYPE_TXTBOX, null, false, 255);

// dhtml
	$this->initVar('dohtml',   XOBJ_DTYPE_INT, 0, false);
	$this->initVar('dosmiley', XOBJ_DTYPE_INT, 1, false);
	$this->initVar('doxcode',  XOBJ_DTYPE_INT, 1, false);
	$this->initVar('doimage',  XOBJ_DTYPE_INT, 1, false);
	$this->initVar('dobr',     XOBJ_DTYPE_INT, 1, false);

}

//---------------------------------------------------------
// set var
//---------------------------------------------------------
function set_vars_by_post()
{
	$this->setVars( $_POST );
}

function set_pid_by_post()
{
	if ( isset($_POST['pid']) )
	{
		$this->setVar('pid', intval($_POST['pid']) );
	}
	elseif ( isset($_POST['cid']) )
	{
		$this->setVar('pid', intval($_POST['cid']) );
	}
}

function set_desc_by_post()
{
	$this->setVar('description', $_POST['weblinks_description'] );
	$this->set_var_checkbox_by_global_post( 'dohtml' );
	$this->set_var_checkbox_by_global_post( 'dosmiley' );
	$this->set_var_checkbox_by_global_post( 'doxcode' );
	$this->set_var_checkbox_by_global_post( 'doimage' );
	$this->set_var_checkbox_by_global_post( 'dobr' );
}

// --- class end ---
}

//=========================================================
// class table_category
//=========================================================
class weblinks_category_handler extends happy_linux_object_handler
{
// class
	var $_category_basic_handler;
	var $_tree;
	var $_strings;

// config
	var $_conf;

// cache
	var $_cached_objs    = array();
	var $_tree_array     = array();
	var $_cat_info_array = array();
	var $_total_count    = 0;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_category_handler( $dirname )
{
	$this->happy_linux_object_handler( $dirname, 'category', 'cid', 'weblinks_category' );

	$this->set_debug_db_sql(   WEBLINKS_DEBUG_CATEGORY_SQL );
	$this->set_debug_db_error( WEBLINKS_DEBUG_ERROR );

// hack for multi site
	if ( WEBLINKS_FLAG_MULTI_SITE )
	{
		$this->renew_prefix( WEBLINKS_DB_PREFIX );
	}

	$this->_tree = new XoopsTree($this->_table, "cid", "pid");

	$config_basic_handler          =& weblinks_get_handler( 'config2_basic',  $dirname );
	$this->_category_basic_handler =& weblinks_get_handler( 'category_basic', $dirname );
	$this->_strings                =& happy_linux_strings::getInstance();

	$this->_conf = $config_basic_handler->get_conf();
}

//---------------------------------------------------------
// basic function
// $flag_cid : for import from mylinks
//---------------------------------------------------------
function _build_insert_sql(&$obj, $flag_cid=false)
{
	foreach ($obj->gets() as $k => $v) 
	{	${$k} = $v;	}

	$sql  = 'INSERT INTO '.$this->_table.' (';

	if ( $flag_cid )
	{
		$sql .= 'cid, ';
	}

	$sql .= 'pid, ';
	$sql .= 'title, ';
	$sql .= 'imgurl, ';
	$sql .= 'cflag, ';
	$sql .= 'lflag, ';
	$sql .= 'tflag, ';
	$sql .= 'displayimg, ';
	$sql .= 'description, ';
	$sql .= 'catdescription, ';
	$sql .= 'catfooter, ';
	$sql .= 'groupid, ';
	$sql .= 'orders, ';
	$sql .= 'editaccess, ';

	$sql .= 'forum_id, ';
	$sql .= 'tree_order, ';
	$sql .= 'cids_parent, ';
	$sql .= 'cids_child, ';
	$sql .= 'link_count, ';
	$sql .= 'link_update, ';

// aux
	$sql .= 'aux_int_1, ';
	$sql .= 'aux_int_2, ';
	$sql .= 'aux_text_1, ';
	$sql .= 'aux_text_2, ';

	$sql .= 'album_id, ';

// image size
	$sql .= 'img_orig_width, ';
	$sql .= 'img_orig_height, ';
	$sql .= 'img_show_width, ';
	$sql .= 'img_show_height, ';

// google map
	$sql .= 'gm_mode, ';
	$sql .= 'gm_latitude, ';
	$sql .= 'gm_longitude, ';
	$sql .= 'gm_zoom, ';
	$sql .= 'gm_type, ';
	$sql .= 'gm_icon, ';
	$sql .= 'gm_location, ';

// dhtml
	$sql .= 'dohtml, ';
	$sql .= 'dosmiley, ';
	$sql .= 'doxcode, ';
	$sql .= 'doimage, ';
	$sql .= 'dobr ';

	$sql .= ') VALUES (';

	if ( $flag_cid )
	{
		$sql .= intval($cid).', ';
	}

	$sql .= intval($pid).', ';
	$sql .= $this->quote($title).', ';
	$sql .= $this->quote($imgurl).', ';
	$sql .= intval($cflag).', ';
	$sql .= intval($lflag).', ';
	$sql .= intval($tflag).', ';
	$sql .= intval($displayimg).', ';
	$sql .= $this->quote($description).', ';
	$sql .= $this->quote($catdescription).', ';
	$sql .= $this->quote($catfooter).', ';
	$sql .= $this->quote($groupid).', ';
	$sql .= intval($orders).', ';
	$sql .= $this->quote($editaccess).', ';

	$sql .= intval($forum_id).', ';
	$sql .= intval($tree_order).', ';
	$sql .= $this->quote($cids_parent).', ';
	$sql .= $this->quote($cids_child).', ';
	$sql .= intval($link_count).', ';
	$sql .= intval($link_update).', ';

// aux
	$sql .= intval($aux_int_1).', ';
	$sql .= intval($aux_int_2).', ';
	$sql .= $this->quote($aux_text_1).', ';
	$sql .= $this->quote($aux_text_2).', ';

// Notice [PHP]: Use of undefined constant album_id - assumed 'album_id'
	$sql .= intval($album_id).', ';

// image size
	$sql .= intval($img_orig_width).', ';
	$sql .= intval($img_orig_height).', ';
	$sql .= intval($img_show_width).', ';
	$sql .= intval($img_show_height).', ';

// google map
	$sql .= intval($gm_mode).', ';
	$sql .= floatval($gm_latitude).', ';
	$sql .= floatval($gm_longitude).', ';
	$sql .= intval($gm_zoom).', ';
	$sql .= intval($gm_type).', ';
	$sql .= intval($gm_icon).', ';
	$sql .= $this->quote($gm_location).', ';

// dhtml
	$sql .= intval($dohtml).', ';
	$sql .= intval($dosmiley).', ';
	$sql .= intval($doxcode).', ';
	$sql .= intval($doimage).', ';
	$sql .= intval($dobr).' ';

	$sql .= ')';

	return $sql;
}

function _build_update_sql(&$obj)
{
	foreach ($obj->gets() as $k => $v) 
	{	${$k} = $v;	}

	$sql  = 'UPDATE '.$this->_table.' SET ';
	$sql .= 'pid='.intval($pid).', ';
	$sql .= 'title='.$this->quote($title).', ';
	$sql .= 'imgurl='.$this->quote($imgurl).', ';
	$sql .= 'cflag='.intval($cflag).', ';
	$sql .= 'lflag='.intval($lflag).', ';
	$sql .= 'tflag='.intval($tflag).', ';
	$sql .= 'displayimg='.intval($displayimg).', ';
	$sql .= 'description='.$this->quote($description).', ';
	$sql .= 'catdescription='.$this->quote($catdescription).', ';
	$sql .= 'catfooter='.$this->quote($catfooter).', ';
	$sql .= 'groupid='.$this->quote($groupid).', ';
	$sql .= 'orders='.intval($orders).', ';
	$sql .= 'editaccess='.$this->quote($editaccess).', ';

	$sql .= 'forum_id='.intval($forum_id).', ';
	$sql .= 'tree_order='.intval($tree_order).', ';
	$sql .= 'cids_parent='.$this->quote($cids_parent).', ';
	$sql .= 'cids_child='.$this->quote($cids_child).', ';
	$sql .= 'link_count='.intval($link_count).', ';
	$sql .= 'link_update='.intval($link_update).', ';

// aux
	$sql .= 'aux_int_1='.intval($aux_int_1).', ';
	$sql .= 'aux_int_2='.intval($aux_int_2).', ';
	$sql .= 'aux_text_1='.$this->quote($aux_text_1).', ';
	$sql .= 'aux_text_2='.$this->quote($aux_text_2).', ';

	$sql .= 'album_id='.intval($album_id).', ';

// image size
	$sql .= 'img_orig_width='.intval($img_orig_width).', ';
	$sql .= 'img_orig_height='.intval($img_orig_height).', ';
	$sql .= 'img_show_width='.intval($img_show_width).', ';
	$sql .= 'img_show_height='.intval($img_show_height).', ';

// google map
	$sql .= 'gm_mode='.intval($gm_mode).', ';
	$sql .= 'gm_latitude='.floatval($gm_latitude).', ';
	$sql .= 'gm_longitude='.floatval($gm_longitude).', ';
	$sql .= 'gm_zoom='.intval($gm_zoom).', ';
	$sql .= 'gm_type='.intval($gm_type).', ';
	$sql .= 'gm_icon='.intval($gm_icon).', ';
	$sql .= 'gm_location='.$this->quote($gm_location).', ';

// dhtml
	$sql .= 'dohtml='.intval($dohtml).', ';
	$sql .= 'dosmiley='.intval($dosmiley).', ';
	$sql .= 'doxcode='.intval($doxcode).', ';
	$sql .= 'doimage='.intval($doimage).', ';
	$sql .= 'dobr='.intval($dobr).' ';

	$sql .= 'WHERE cid='.intval($cid);

	return $sql;
}

//---------------------------------------------------------
// get count
//---------------------------------------------------------
function get_count_by_pid($pid)
{
	$pid = intval($pid);
	$criteria = new CriteriaCompo();
	$criteria->add( new criteria('pid', $pid, '=') );
	$count = $this->getCount($criteria);
	return $count;
}

//---------------------------------------------------------
// get objects
//---------------------------------------------------------
function &get_objects_all($limit=0, $start=0)
{
	$criteria = new CriteriaCompo();
	$criteria->setStart($start);
	$criteria->setLimit($limit);
	$objs =& $this->getObjects($criteria);
	return $objs;
}

function &get_objects_desc($limit=0, $start=0)
{
	$criteria = new CriteriaCompo();
	$criteria->setSort( 'cid DESC' );
	$criteria->setStart($start);
	$criteria->setLimit($limit);
	$objs =& $this->getObjects($criteria);
	return $objs;
}

function &get_objects_by_pid($pid=0, $limit=0, $start=0)
{
	$criteria = new CriteriaCompo();
	$criteria->add( new criteria('pid', $pid, '=') );
	$criteria->setSort( 'orders ASC, cid ASC' );
	$criteria->setStart($start);
	$criteria->setLimit($limit);
	$objs =& $this->getObjects($criteria);
	return $objs;
}

function &get_objects_by_title($title)
{
	$title = addslashes($title);
	$criteria = new CriteriaCompo();
	$criteria->add( new criteria('title', $title, '=') );
	$objs =& $this->getObjects($criteria);
	return $objs;
}

function &get_objects_by_title_like($title)
{
	$title = addslashes($title);
	$criteria = new CriteriaCompo();
	$criteria->add( new criteria('title', '%'.$title.'%', 'LIKE') );
	$objs =& $this->getObjects($criteria);
	return $objs;
}

function &get_objects_tree($limit=0, $start=0)
{
	$limit = intval($limit);
	$start = intval($start);

	$this->build_tree();
	$cid_arr = $this->get_tree($limit, $start);

	$objs = array();

	foreach ($cid_arr as $cid) 
	{
		$objs[] =& $this->get($cid);
	}

	return $objs;
}

//---------------------------------------------------------
// get cid_array
//---------------------------------------------------------
// for bulk_manage.php
// BUG 4519: Fatal error: Call to undefined function: get_cid_array_by_title()
function &get_cid_array_by_title($title)
{
	$cid_arr = array();

	$objs =& $this->get_objects_by_title($title);

	if (count($objs) > 0)
	{
		foreach ($objs as $obj)
		{
			$cid_arr[] = $obj->get('cid');
		}
	}

	return $cid_arr;
}

function &get_cid_array_by_title_like($title)
{
	$cid_arr = array();

	$objs =& $this->get_objects_by_title_like($title);

	if (count($objs) > 0)
	{
		foreach ($objs as $obj)
		{
			$cid_arr[] = $obj->get('cid');
		}
	}

	return $cid_arr;
}

//=========================================================
// category_basic_handler
//=========================================================
function load()
{
	$this->_category_basic_handler->load_once();
}

function build_tree()
{
	$this->_category_basic_handler->build_tree();
}

function &get_tree($limit=0, $start=0)
{
	$ret =& $this->_category_basic_handler->get_tree();
	return $ret;
}

function &get_cat_info_array()
{
	$ret =& $this->_category_basic_handler->get_cat_info_array();
	return $ret;
}

// BUG 4507: Fatal error: Call to undefined function: getallchildid()
function &getAllChildId( $cid, $order="cid" )
{
	$ret =& $this->_category_basic_handler->getAllChildId( $cid, $order );
	return $ret;
}

function &get_parent_and_all_child_id( $cid, $order="cid" )
{
	$ret =& $this->_category_basic_handler->get_parent_and_all_child_id( $cid, $order );
	return $ret;
}

function &get_parent_path($cid)
{
	$ret =& $this->_category_basic_handler->get_parent_path($cid);
	return $ret;
}

function get_cid_depth_from_cache_by_cid($cid)
{
	return $this->_category_basic_handler->get_cid_depth_from_cache_by_cid($cid);
}

function build_cat_path($cid, $format='s')
{
	return $this->_category_basic_handler->build_cat_path($cid, $format);
}

function show_selbox_multi($cid_arr='')
{
	return $this->_category_basic_handler->show_selbox_multi($cid_arr);
}

function build_selbox_top( $preset_id=0, $none=0, $sel_name='', $onchange='' )
{
	return $this->_category_basic_handler->build_selbox( $preset_id, $none, $sel_name, $onchange, WEBLINKS_C_CAT_TOP );
}

function build_selbox($preset_id=0, $none=0, $sel_name='', $onchange='', $none_name='---', $flag=0)
{
	return $this->_category_basic_handler->build_selbox($preset_id, $none, $sel_name, $onchange, $none_name, $flag);
}

function build_selbox_multi( $cid_arr=array() )
{
	return $this->_category_basic_handler->build_selbox_multi($cid_arr);
}

function get_title($cid, $format='s')
{
	return $this->_category_basic_handler->get_title($cid, $format);
}

function get_title_with_top( $cid, $format='s' )
{
	if ( $cid )
	{
		return $this->_category_basic_handler->get_title( $cid, $format );
	}
	return WEBLINKS_C_CAT_TOP;
}

// --- class end ---
}

// === class end ===
}

?>