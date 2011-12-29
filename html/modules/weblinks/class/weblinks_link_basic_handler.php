<?php
// $Id: weblinks_link_basic_handler.php,v 1.1 2011/12/29 14:33:07 ohwada Exp $

// 2008-02-17 K.OHWADA
// update_pagerank()
// get_count_gmap()

// 2007-11-01 K.OHWADA
// get_count_non_url()

// 2007-09-20 K.OHWADA
// divid to weblinks_link_bin_handler.php

// 2007-09-01 K.OHWADA
// get_lid_array_by_uid()

// 2007-03-25 K.OHWADA
// get_album_id()

// 2007-03-01 K.OHWADA
// divid from weblinks_link_basic_handler

//=========================================================
// WebLinks Module
// 2006-03-01 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('weblinks_link_basic_handler') ) 
{

//=========================================================
// class weblinks_link_basic_handler
//=========================================================
class weblinks_link_basic_handler extends weblinks_link_bin_handler
{
	var $_strings;

	var $_conf;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_link_basic_handler( $dirname )
{
	$this->weblinks_link_bin_handler( $dirname );

	$config_handler =& weblinks_get_handler( 'config2_basic', $dirname );
	$this->_strings =& happy_linux_strings::getInstance();

	$this->_conf    =& $config_handler->get_conf();
}

//---------------------------------------------------------
// update
//---------------------------------------------------------
// singlelink.php
function update_banner_size($lid, $width, $height)
{
	$sql  = 'UPDATE '.$this->_table.' SET ';
	$sql .= ' width='.intval($width).', ';
	$sql .= ' height='.intval($height);
	$sql .= ' WHERE lid='.intval($lid);
	$ret = $this->query($sql);
}

// visit.php
function countup_hits($lid)
{
	$sql = 'UPDATE '.$this->_table.' SET hits = hits+1 WHERE lid='.intval($lid);
	$ret = $this->query($sql);
	return $ret;
}

function update_pagerank($lid, $pagerank, $update)
{
	$sql  = 'UPDATE '.$this->_table.' SET ';
	$sql .= ' pagerank='.intval($pagerank).', ';
	$sql .= ' pagerank_update='.intval($update);
	$sql .= ' WHERE lid='.intval($lid);
	$ret = $this->query($sql);
}

//---------------------------------------------------------
// get row
//---------------------------------------------------------
function &get_cache_by_lid($lid)
{
	$row = false;
	if ( isset($this->_cached[$lid]) )
	{
		$row =& $this->_cached[$lid];
	}
	else
	{
		$row =& $this->get_by_lid($lid);
		if ( is_array($row) && count($row) )
		{
			$this->_cached[$lid] =& $row;
		}
	}
	return $row;
}

function &get_by_lid($lid)
{
	$row =& $this->get_row_by_id($lid);
	if ( $this->_flag_replace && is_array($row) && count($row) )
	{
		$row =& $this->_multi_replace( $row );
	}
	return $row;
}

function &_multi_replace( &$row )
{
	$arr =& $row;
	if ( $row['etc1'] )
	{
		$arr['title'] = $row['etc1'];
	}
	if ( $row['etc2'] )
	{
		$arr['url'] = $row['etc2'];
	}
	if ( $row['etc2'] )
	{
		$arr['mail'] = $row['etc3'];
	}
	if ( $row['textarea1'] )
	{
		$arr['description'] = $row['textarea1'];
		$arr['dohtml']      = $row['dohtml1'];
		$arr['dosmiley']    = $row['dosmiley1'];
		$arr['doxcode']     = $row['doxcode1'];
		$arr['doimage']     = $row['doimage1'];
		$arr['dobr']        = $row['dobr1'];
	}
	return $arr;
}

//---------------------------------------------------------
// get item
//---------------------------------------------------------
// comment_new.php brokenlink.php
function get_title($lid, $format='n')
{
	$val = false;
	$row =& $this->get_cache_by_lid($lid);
	if ( isset($row['title']) )
	{
		$val = $this->_strings->sanitize_format_text( $row['title'] );
	}
	return $val;
}

// visit.php
function get_url($lid, $format='n')
{
	$val = false;
	$row =& $this->get_cache_by_lid($lid);
	if ( isset($row['url']) )
	{
		$val = $this->_strings->sanitize_format_url( $row['url'] );
	}
	return $val;
}

// singlelink.php
function get_forum_id($lid)
{
	$val = false;
	$row =& $this->get_cache_by_lid($lid);
	if ( isset($row['forum_id']) )
	{
		$val = intval( $row['forum_id'] );
	}
	return $val;
}

// singlelink.php
function get_album_id($lid)
{
	$val = false;
	$row =& $this->get_cache_by_lid($lid);
	if ( isset($row['album_id']) )
	{
		$val = intval( $row['album_id'] );
	}
	return $val;
}

// weblinks_rssc_handler.php
function get_rssc_lid($lid)
{
	$val = false;
	$row =& $this->get_cache_by_lid($lid);
	if ( isset($row['rssc_lid']) )
	{
		$val = intval( $row['rssc_lid'] );
	}
	return $val;
}

//---------------------------------------------------------
// get count
//---------------------------------------------------------
function get_count_public()
{
	$where = $this->build_sql_where_exclude();
	$count = $this->get_count_by_where($where);
	return $count;
}

function get_count_by_mark($mark)
{
	$where  = $this->build_sql_where_exclude();
	$where .= 'AND '. $mark. ' = 1 ';
	$count  = $this->get_count_by_where($where);
	return $count;
}

function get_count_rss_flag( $flag_exclude=true )
{
	$where = 'rssc_lid <> 0 ';
	if ($flag_exclude)
	{
		$where .= 'AND '.$this->build_sql_where_exclude();
	}
	$count  = $this->get_count_by_where($where);
	return $count;
}

// admin/index
function get_count_non_url()
{
// XOOPS 2.2.3 dont accept value = ''
	$where = "url = ''";
	$count = $this->get_count_by_where($where);
	return $count;
}

// admin/index
function get_count_broken()
{
	$where = '(broken <> 0 AND broken >= 0)';
	$count = $this->get_count_by_where($where);
	return $count;
}

function build_sql_where_exclude()
{
	$broken = intval( $this->_conf['broken_threshold'] );
	$time   = time();
	$where  =    ' ( broken = 0 OR broken < '. $broken .' ) ';
	$where .= 'AND ( time_publish = 0 OR time_publish < '. $time .' ) ';
	$where .= 'AND ( time_expire = 0 OR time_expire > '. $time .' ) ';
	return $where;
}

function build_sql_where_exclude_join()
{
	$broken = intval( $this->_conf['broken_threshold'] );
	$time   = time();
	$where  =    ' ( l.broken = 0 OR l.broken < '. $broken .' ) ';
	$where .= 'AND ( l.time_publish = 0 OR l.time_publish < '. $time .' ) ';
	$where .= 'AND ( l.time_expire = 0 OR l.time_expire > '. $time .' ) ';
	return $where;
}

function get_count_by_where($where)
{
	$sql = 'SELECT COUNT(*) FROM '.$this->_table.' WHERE '.$where;
	$count = $this->get_count_by_sql($sql);
	return $count;
}

//---------------------------------------------------------
// get gmap count
//---------------------------------------------------------
function get_count_gmap()
{
	$where  = '( gm_latitude <> 0 OR gm_longitude <> 0 OR gm_zoom <> 0 ) ';
	$where .= 'AND '.$this->build_sql_where_exclude();
	$count  = $this->get_count_by_where($where);
	return $count;
}

function get_gmap_kml_page( $total, $limit )
{
	$page = ceil( $total / $limit );
	return $page;
}

//---------------------------------------------------------
// get lid array
//---------------------------------------------------------
// index
function &get_lid_array_latest($limit=0, $offset=0)
{
	$sql  = 'SELECT lid FROM '. $this->_table .' WHERE ';
	$sql .= $this->build_sql_where_exclude();
	$sql .= ' ORDER BY time_update DESC, lid DESC';
	$arr  =& $this->get_first_row_by_sql($sql, $limit, $offset);
	return $arr;
}

// for top ten
function &get_lid_array_orderby($orderby, $limit=0, $start=0)
{
	$sql  = 'SELECT lid FROM '. $this->_table .' WHERE ';
	$sql .= $this->build_sql_where_exclude();
	$sql .= 'ORDER BY '. $orderby;
	$arr  =& $this->get_first_row_by_sql($sql, $limit, $start);
	return $arr;
}

// viewmark
function &get_lid_array_by_mark_orderby($mark, $orderby, $limit=0, $start=0)
{
	if ( empty($orderby) )
	{
		$orderby = 'lid ASC';
	}
	$sql  = 'SELECT lid FROM '. $this->_table .' WHERE ';
	$sql .= $this->build_sql_where_exclude();
	$sql .= 'AND '. $mark. ' = 1 ';
	$sql .= 'ORDER BY '. $orderby;
	$arr  =& $this->get_first_row_by_sql($sql, $limit, $start);
	return $arr;
}

// for rss site
function  &get_lid_array_rss_by_orderby($orderby, $limit=0, $start=0)
{
	if ( empty($orderby) )
	{
		$orderby = 'lid ASC';
	}
	$sql  = 'SELECT lid FROM '. $this->_table .' WHERE ';
	$sql .= $this->build_sql_where_exclude();
	$sql .= 'AND rssc_lid <> 0 ';
	$sql .= 'ORDER BY '. $orderby;
	$arr  =& $this->get_first_row_by_sql($sql, $limit, $start);
	return $arr;
}

function  &get_lid_array_gmap_by_orderby($orderby, $limit=0, $start=0)
{
	if ( empty($orderby) )
	{
		$orderby = 'lid ASC';
	}
	$sql  = 'SELECT lid FROM '. $this->_table .' WHERE ';
	$sql .= $this->build_sql_where_exclude();
	$sql .= 'AND ( gm_latitude <> 0 OR gm_longitude <> 0 OR gm_zoom <> 0 ) ';
	$sql .= 'ORDER BY '. $orderby;
	$arr  =& $this->get_first_row_by_sql($sql, $limit, $start);
	return $arr;
}

// for search
function &get_lid_array_by_where($where, $limit=0, $start=0)
{
	$sql  = 'SELECT lid FROM '.$this->_table.' WHERE '.$where.' ORDER BY time_update DESC';
	$arr  =& $this->get_first_row_by_sql($sql, $limit, $start);
	return $arr;
}

// for randum jump
function &get_lid_array_by_random($limit=0, $start=0)
{
	$sql  = "SELECT lid FROM ". $this->_table ." WHERE ";
	$sql .= $this->build_sql_where_exclude();
	$sql .= "AND url <> '' ";
	$sql .= "ORDER BY rand()";
	$arr  =& $this->get_first_row_by_sql($sql, $limit, $start);
	return $arr;
}

// index.php
function &get_lid_array_by_uid($uid, $limit=0, $start=0)
{
	$sql  = 'SELECT lid FROM '. $this->_table .' WHERE ';
	$sql .= 'uid = '.$uid;
	$sql .= ' ORDER BY time_update DESC';
	$arr  =& $this->get_first_row_by_sql($sql, $limit, $start);
	return $arr;
}

// --- class end ---
}

// === class end ===
}

?>