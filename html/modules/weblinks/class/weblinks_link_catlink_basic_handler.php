<?php
// $Id: weblinks_link_catlink_basic_handler.php,v 1.1 2011/12/29 14:33:09 ohwada Exp $

// 2007-11-01 K.OHWADA
// get_count_by_cid_array_where()

// 2007-06-01 K.OHWADA
// change file name and class name
// weblinks_link_catlink_handler -> weblinks_link_catlink_basic_handler
// happy_linux_object_handler -> happy_linux_basic_handler

// 2007-02-20 K.OHWADA
// hack for multi site

// 2006-12-10 K.OHWADA
// use time_publish
// add get_count_by_cid_array()

// 2006-10-14 K.OHWADA
// add get_lid_array_by_cid_array_orderby_where()

// 2006-09-20 K.OHWADA
// use happy_linux
// add get_lid_array_by_cid_array_orderby() : remove get_lid_array_by_cid_array_criteria()

// 2006-05-15 K.OHWADA
// this is new file
// use new handler

//=========================================================
// WebLinks Module
// 2006-05-15 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('weblinks_link_catlink_basic_handler') ) 
{

//=========================================================
// class weblinks_link_catlink_basic_handler
// handling for table_link & table_catlink
//=========================================================
class weblinks_link_catlink_basic_handler extends happy_linux_basic_handler
{
	var $_table_link;
	var $_table_catlink;

// config
	var $_conf_broken;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_link_catlink_basic_handler( $dirname )
{
	$this->happy_linux_basic_handler( $dirname );

	$this->set_debug_db_sql(   WEBLINKS_DEBUG_LINK_CATLINK_BASIC_SQL );
	$this->set_debug_db_error( WEBLINKS_DEBUG_ERROR );

// hack for multi site
	if ( WEBLINKS_FLAG_MULTI_SITE )
	{
		$this->renew_prefix( WEBLINKS_DB_PREFIX );
	}

	$this->_table_link     = $this->prefix( 'link'    );
	$this->_table_catlink  = $this->prefix( 'catlink' );

	$config_basic_handler =& weblinks_get_handler( 'config2_basic', $dirname );

	$conf = $config_basic_handler->get_conf();
	$this->_conf_broken  = $conf['broken_threshold'];

}

//---------------------------------------------------------
// count
//---------------------------------------------------------
function get_count_by_cid( $cid )
{
	$cid_arr = array( $cid );
	return $this->get_count_by_cid_array_where( $cid_arr );
}

function get_count_by_cid_array( &$cid_arr )
{
	return $this->get_count_by_cid_array_where( $cid_arr );
}

// for search
function get_count_by_cid_array_where( &$cid_arr, $where_in=null )
{
	if ( !is_array($cid_arr) || count($cid_arr) == 0 )
	{
		return false;
	}

	$where = $this->_build_where_by_cid_array_where( $cid_arr, $where_in );
	$count = $this->get_count_by_where( $where );
	return $count;
}

function get_count_by_where( $where )
{
	$sql  = 'SELECT COUNT(DISTINCT l.lid) FROM ';
	$sql .= $this->_table_link.' l, ';
	$sql .= $this->_table_catlink.' c ';
	$sql .= ' WHERE '. $where;

	$count = $this->get_count_by_sql($sql);
	return $count;
}

function build_sql_where_strict( &$cid_arr )
{
	$where  = $this->build_sql_where_exclude();
	$where .= ' AND '. $this->build_sql_where_cid_arr( $cid_arr );
	$where .= ' AND l.lid=c.lid';
	return $where;
}

function build_sql_where_exclude()
{
	$time   = time();
	$where  = ' l.broken < '. intval($this->_conf_broken) .' ';
	$where .= 'AND ( l.time_publish = 0 OR l.time_publish <= '. $time .' ) ';
	$where .= 'AND ( l.time_expire = 0 OR l.time_expire > '. $time .' ) ';
	return $where;
}

function build_sql_where_cid_arr( &$cid_arr )
{
	$count = count($cid_arr);

	$where = ' ( c.cid='.$cid_arr[0].' ';
	for ($i=1; $i<$count; $i++)
	{
		$where .= ' OR c.cid='.$cid_arr[$i].' ';
	}
	$where .= ' ) ';
	return $where;
}

function _build_where_by_cid_array_where( &$cid_arr, $where_in=null )
{
	$where = $this->build_sql_where_strict( $cid_arr );
	if ( $where_in )
	{
		$where .= ' AND '.$where_in;
	}
	return $where;
}

//---------------------------------------------------------
// lid list
//---------------------------------------------------------
function &get_lid_array_by_cid_orderby( $cid, $orderby=null, $limit=0, $start=0 )
{
	$cid_arr = array( $cid );
	return $this->get_lid_array_by_cid_array_where_orderby( $cid_arr, null, $orderby, $limit, $start );
}

// for topten
function &get_lid_array_by_cid_array_orderby( &$cid_arr, $orderby=null, $limit=0, $start=0 )
{
	return $this->get_lid_array_by_cid_array_where_orderby( $cid_arr, null, $orderby, $limit, $start );
}

// for search
function &get_lid_array_by_cid_array_where_orderby( &$cid_arr, $where_in=null, $orderby_in=null, $limit=0, $start=0 )
{
	if ( !is_array($cid_arr) || count($cid_arr) == 0 )
	{
		$false = false;
		return $false;
	}

	$where = $this->_build_where_by_cid_array_where( $cid_arr, $where_in );

// orderby
	if ( $orderby_in )
	{
		$orderby = 'l.'.$orderby_in;
	}
	else
	{
		$orderby = 'l.lid ASC';
	}

	$arr =& $this->get_lid_array_by_where_orderby( $where, $orderby, $limit, $start );
	return $arr;
}

function &get_lid_array_by_where_orderby( $where, $orderby, $limit=0, $start=0 )
{
	$sql  = 'SELECT DISTINCT l.lid FROM ';
	$sql .= $this->_table_link.' l, ';
	$sql .= $this->_table_catlink.' c ';
	$sql .= ' WHERE '. $where .' ';
	$sql .= ' ORDER BY '.$orderby;

	$arr =& $this->get_first_row_by_sql($sql, $limit, $start);
	return $arr;
}

// --- class end ---
}

// === class end ===
}

?>