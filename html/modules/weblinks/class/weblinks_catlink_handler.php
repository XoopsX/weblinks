<?php
// $Id: weblinks_catlink_handler.php,v 1.1 2011/12/29 14:33:06 ohwada Exp $

// 2007-03-01 K.OHWADA
// divid to weblinks_catlink_basic_handler
// hack for multi site

// 2006-09-20 K.OHWADA
// use happy_linux

// 2006-05-15 K.OHWADA
// new handler
// not use weblinks_module_base

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication

//=========================================================
// WebLinks Module
// this file contain 2 class
//   weblinks_catlink 
//   weblinks_catlink_handler
// 2004/08/10 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('weblinks_catlink_handler') ) 
{

//=========================================================
// class weblinks_catlink
//=========================================================
class weblinks_catlink extends happy_linux_object
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_catlink()
{
	$this->happy_linux_object();

	$this->initVar('jid', XOBJ_DTYPE_INT, 0, false);
	$this->initVar('cid', XOBJ_DTYPE_INT, 0, false);
	$this->initVar('lid', XOBJ_DTYPE_INT, 0, false);

}

// --- class end ---
}

//=========================================================
// class weblinks_catlink_handler
//=========================================================
class weblinks_catlink_handler extends happy_linux_object_handler
{
	var $_catlink_basic_handler;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_catlink_handler( $dirname )
{
	$this->happy_linux_object_handler( $dirname, 'catlink', 'jid', 'weblinks_catlink' );

	$this->set_debug_db_sql(   WEBLINKS_DEBUG_CATLINK_SQL );
	$this->set_debug_db_error( WEBLINKS_DEBUG_ERROR );

// hack for multi site
	if ( WEBLINKS_FLAG_MULTI_SITE )
	{
		$this->renew_prefix( WEBLINKS_DB_PREFIX );
	}

	$this->_catlink_basic_handler =& weblinks_get_handler( 'catlink_basic',    $dirname );

}

//---------------------------------------------------------
// basic function
//---------------------------------------------------------
function _build_insert_sql(&$obj)
{
	foreach ($obj->gets() as $k => $v) 
	{	${$k} = $v;	}

	$sql  = 'INSERT INTO '.$this->_table.' (';
	$sql .= 'cid, ';
	$sql .= 'lid ';
	$sql .= ') VALUES ( ';
	$sql .= intval($cid).', ';
	$sql .= intval($lid).' ';
	$sql .= ')';

	return $sql;
}

function _build_update_sql(&$obj)
{
	foreach ($obj->gets() as $k => $v) 
	{	${$k} = $v;	}

	$sql = 'UPDATE '.$this->_table.' SET ';
	$sql .= 'cid='.intval($cid).', ';
	$sql .= 'lid='.intval($lid).' ';
	$sql .= 'WHERE jid='.intval($jid);
	return $sql;
}

//---------------------------------------------------------
// insert
//---------------------------------------------------------
function add_link_by_lid_cid_array($lid, $cid_arr)
{
	$this->_clear_errors();

	$lid = intval($lid);

	foreach ($cid_arr as $cid)
	{
		$obj =& $this->create();
		$obj->setVar('cid', $cid );
		$obj->setVar('lid', $lid );
		$this->insert($obj);
		unset($obj);
	}

	return $this->returnExistError();
}

//---------------------------------------------------------
// delete
//---------------------------------------------------------
function delete_by_cid($cid, $force=false)
{
	$sql = 'DELETE FROM '.$this->_table.' WHERE cid='.intval($cid);

	if ( !$this->query($sql, 0, 0, $force) )
	{	return false;	}

	return true;
}

function delete_by_lid($lid, $force=false)
{
	$sql = 'DELETE FROM '.$this->_table.' WHERE lid='.intval($lid);

	if ( !$this->query($sql, 0, 0, $force) )
	{	return false;	}

	return true;
}

//---------------------------------------------------------
// get count
//---------------------------------------------------------
function get_count_by_cid($cid)
{
	$cid = intval($cid);
	$criteria = new CriteriaCompo();
	$criteria->add( new criteria('cid', $cid, '=') );
	$count = $this->getCount($criteria);
	return $count;
}

function get_count_by_lid($lid)
{
	$lid = intval($lid);
	$criteria = new CriteriaCompo();
	$criteria->add( new criteria('lid', $lid, '=') );
	$count = $this->getCount($criteria);
	return $count;
}

function get_count_by_cid_array($cid_arr)
{
	$sql  = "SELECT COUNT(DISTINCT lid) c FROM " . $this->_table;
	$sql .= $this->_build_where_by_cid_array($cid_arr);
	$num  = $this->get_count_by_sql($sql);
	return $num;
}

function _build_where_by_cid_array($cid_arr)
{
	$where = '';
	if ( is_array($cid_arr) && count($cid_arr) )
	{
		$count = count($cid_arr);
		$where = " WHERE ( cid=".intval($cid_arr[0]);
		for ( $i=1; $i<$count; $i++ )
		{
			$where .= " OR cid=".intval($cid_arr[$i]);
		}
		$where .= " )";
	}
	return $where;
}

//---------------------------------------------------------
// get objects
//---------------------------------------------------------
function &get_objects_by_cid($cid, $limit=0, $offset=0)
{
	$cid = intval($cid);
	$criteria = new CriteriaCompo();
	$criteria->add( new criteria('cid', $cid, '=') );
	$criteria->setStart($offset);
	$criteria->setLimit($limit);
	$objs =& $this->getObjects($criteria);
	return $objs;
}

function &get_objects_by_lid($lid, $limit=0, $offset=0)
{
	$lid = intval($lid);
	$criteria = new CriteriaCompo();
	$criteria->add( new criteria('lid', $lid, '=') );
	$criteria->setStart($offset);
	$criteria->setLimit($limit);
	$objs =& $this->getObjects($criteria);
	return $objs;
}

//---------------------------------------------------------
// get link list
//---------------------------------------------------------
function &get_lid_array_by_cid($cid, $limit=0, $offset=0)
{
	$cid  =  intval($cid);
	$objs =& $this->get_objects_by_cid($cid, $limit, $offset);
	$lid_arr = array();

	if ( count($objs) > 0 )
	{
		foreach ($objs as $obj)
		{
			if ( is_object($obj) )
			{
				$lid_arr[] = $obj->get('lid');
			}
		}
	}

	return $lid_arr;
}

function &get_lid_array_by_cid_array($cid_arr)
{
	$sql  = "SELECT DISTINCT lid FROM " . $this->_table;
	$sql .= $this->_build_where_by_cid_array($cid_arr);
	$arr  =& $this->get_first_rows_by_sql($sql);
	return $arr;
}

//=========================================================
// catlink_basic_handler
//=========================================================
function &get_cid_array_by_lid($lid, $limit=0, $offset=0)
{
	$arr =& $this->_catlink_basic_handler->get_cid_array_by_lid($lid, $limit=0, $offset=0);
	return $arr;
}

// --- class end ---
}

// === class end ===
}

?>