<?php
// $Id: weblinks_linkitem_handler.php,v 1.1 2011/12/29 14:33:05 ohwada Exp $

// 2007-11-24 K.OHWADA
// move create_table() to weblinks_install.php

// 2007-02-20 K.OHWADA
// add description field
// add_column_table_140()

// 2006-09-20 K.OHWADA
// use happy_linux
// add get_cache_by_itemid() get_cache_by_name()

// 2006-06-11 K.OHWADA
// BUG 4032 : cannot create table in MySQL 3.23

// 2006-05-15 K.OHWADA
// this is new file
// use new handler

//================================================================
// WebLinks Module
// this file contain 2 class
//   weblinks_linkitem 
//   weblinks_linkitem_handler
// 2006-05-15 K.OHWADA
//================================================================


// === class begin ===
if( !class_exists('weblinks_linkitem_handler') ) 
{

//================================================================
// class weblinks_linkitem
//================================================================
class weblinks_linkitem extends happy_linux_object
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_linkitem()
{
	$this->happy_linux_object();

	$this->initVar('id',          XOBJ_DTYPE_INT, 0, false);
	$this->initVar('item_id',     XOBJ_DTYPE_INT, 0, true);
	$this->initVar('name',        XOBJ_DTYPE_TXTBOX, null, true,  255);
	$this->initVar('title',       XOBJ_DTYPE_TXTBOX, null, false, 255);
	$this->initVar('user_mode',   XOBJ_DTYPE_INT,   0);
	$this->initVar('aux_int_1',   XOBJ_DTYPE_INT,   0);
	$this->initVar('aux_int_2',   XOBJ_DTYPE_INT,   0);
	$this->initVar('aux_text_1',  XOBJ_DTYPE_TXTBOX, null, false, 255);
	$this->initVar('aux_text_2',  XOBJ_DTYPE_TXTBOX, null, false, 255);
	$this->initVar('description', XOBJ_DTYPE_TXTAREA);

}

// --- class end ---
}

//================================================================
// class weblinks_linkitem_handler
//================================================================
class weblinks_linkitem_handler extends happy_linux_object_handler
{
	var $_cached_by_itemid = array();
	var $_cached_by_name   = array();

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_linkitem_handler( $dirname )
{
	$this->happy_linux_object_handler( $dirname, 'linkitem', 'item_id', 'weblinks_linkitem' );

	$this->set_debug_db_sql(   WEBLINKS_DEBUG_LINKITEM_SQL );
	$this->set_debug_db_error( WEBLINKS_DEBUG_ERROR );

}

//---------------------------------------------------------
// basic function
//---------------------------------------------------------
function _build_insert_sql(&$obj)
{
	foreach ($obj->gets() as $k => $v) 
	{	${$k} = $v;	}

	$sql  = 'INSERT INTO '.$this->_table.' (';
	$sql .= 'item_id, ';
	$sql .= 'name, ';
	$sql .= 'title, ';
	$sql .= 'user_mode, ';
	$sql .= 'aux_int_1, ';
	$sql .= 'aux_int_2, ';
	$sql .= 'aux_text_1, ';
	$sql .= 'aux_text_2, ';
	$sql .= 'description ';
	$sql .= ') VALUES (';
	$sql .= intval($item_id).', ';
	$sql .= $this->quote($name).', ';
	$sql .= $this->quote($title).', ';
	$sql .= intval($user_mode).', ';
	$sql .= intval($aux_int_1).', ';
	$sql .= intval($aux_int_2).', ';
	$sql .= $this->quote($aux_text_1).', ';
	$sql .= $this->quote($aux_text_2).', ';
	$sql .= $this->quote($description).' ';
	$sql .= ')';

	return $sql;
}

function _build_update_sql(&$obj)
{
	foreach ($obj->gets() as $k => $v) 
	{	${$k} = $v;	}

	$sql = 'UPDATE '.$this->_table.' SET ';
	$sql .= 'name='.$this->quote($name).', ';
	$sql .= 'title='.$this->quote($title).', ';
	$sql .= 'user_mode='.intval($user_mode).', ';
	$sql .= 'aux_int_1='.intval($aux_int_1).', ';
	$sql .= 'aux_int_2='.intval($aux_int_2).', ';
	$sql .= 'aux_text_1='.$this->quote($aux_text_1).', ';
	$sql .= 'aux_text_2='.$this->quote($aux_text_2).', ';
	$sql .= 'description='.$this->quote($description).' ';
	$sql .= 'WHERE item_id='.intval($item_id);

	return $sql;
}

//---------------------------------------------------------
// load
//---------------------------------------------------------
function load_once()
{
	static $flag_init_load;
	if ( !isset($flag_init_load) ) 
	{
		$flag_init_load = 1;
		$this->load();
	}
	return $this->_cached_by_itemid;
}

function load()
{
	$this->_cached_by_itemid = array();
	$this->_cached_by_name   = array();

	$objs = $this->getObjects();
	foreach ($objs as $obj)
	{
		$arr = $obj->getVarAll('n');
		$this->_cached_by_itemid[ $arr['item_id'] ] = $arr;
		$this->_cached_by_name[   $arr['name'] ]    = $arr;
	}
}

//---------------------------------------------------------
// get_cache
//---------------------------------------------------------
function &get_cache_array_by_itemid()
{
	return $this->_cached_by_itemid;
}

function &get_cache_array_by_name()
{
	return $this->_cached_by_name;
}

function get_cache_by_itemid($id)
{
	if ( isset( $this->_cached_by_itemid[$id] ) )
	{
		$val = $this->_cached_by_itemid[$id];
		return $val;
	}

	return false;
}

function get_cache_by_itemid_key($id, $key)
{
	if ( isset( $this->_cached_by_itemid[$id][$key] ) )
	{
		$val = $this->_cached_by_itemid[$id][$key];
		return $val;
	}

	return false;
}

function get_cache_by_name($name)
{
	if ( isset( $this->_cached_by_name[$name] ) )
	{
		$val = $this->_cached_by_name[$name];
		return $val;
	}

	return false;
}

function get_cache_by_name_key($name, $key)
{
	if ( isset( $this->_cached_by_name[$name][$key] ) )
	{
		$val = $this->_cached_by_name[$name][$key];
		return $val;
	}

	return false;
}

//---------------------------------------------------------
// get object
//---------------------------------------------------------
function &get_by_itemid($id)
{
	$obj  = false;

	$sql   = 'SELECT * FROM '. $this->_table .' WHERE item_id='.intval($id);
	$objs  =& $this->get_objects_by_sql($sql);
	$count = count($objs);

	if ( $count <= 0 )
	{	return $obj;	}

	if ( $count > 1  )  
	{
		$this->_set_errors( $this->_table.' : too many matched' );
	}

	if ( isset($objs[0]) && is_object($objs[0]) )
	{
		$obj =& $objs[0];
	}

	return $obj;
}

// --- class end ---
}

// === class end ===
}

?>