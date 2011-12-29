<?php
// $Id: weblinks_link_check_handler.php,v 1.1 2011/12/29 14:33:04 ohwada Exp $

// 2008-02-17 K.OHWADA
// divid to weblinks_check_base.php

// 2008-02-16 K.OHWADA
// show timeout
// get_microtime()

// 2007-10-10 K.OHWADA
// happy_linux_get_singleton

// 2007-09-20 K.OHWADA
// PHP5.2: Non-static method xxx::getInstance() should not be called statically
// use link_bin_handler
// not use locate_factory

// 2007-06-10 K.OHWADA
// happy_linux_bin_file

// 2007-03-01 K.OHWADA
// small change check()
// small change get_no_check()

// 2006-10-05 K.OHWADA
// use happy_linux
// remove refresh_link() refresh_site()
// use weblinks_locate_factory

// 2006-05-15 K.OHWADA
// use new handler

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication

//=========================================================
// WebLinks Module
// 2004-10-20 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('weblinks_link_check_handler') ) 
{

//=========================================================
// class weblinks_link_check_handler
// this class is used by command line
//=========================================================
class weblinks_link_check_handler extends weblinks_link_check_base
{
	var $_remote_file;
	var $_bin_file;

	var $_flag_broken   = false;	// view broken colum

	var $_TIMEOUT_CONNECT = 0;	// 30 sec  ( snoopy default )
	var $_TIMEOUT_READ    = 0;	// disable ( snoopy default )

	var $_link_broken_count = 0;
	var $_link_broken_arr   = array();
	var $_link_broken       = null;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_link_check_handler( $dirname )
{
	$this->weblinks_link_check_base( $dirname );

// Non-static method xxx::getInstance() should not be called statically
	$this->_remote_file =& happy_linux_get_singleton( 'remote_file' );
	$this->_bin_file    =& happy_linux_get_singleton( 'bin_file' );

	$this->_remote_file->set_snoopy_timeout_connect( $this->_TIMEOUT_CONNECT );
	$this->_remote_file->set_snoopy_timeout_read(    $this->_TIMEOUT_READ );

	$this->_TITLE = _WEBLINKS_ADMIN_LINK_BROKEN_CHECK;
}

//---------------------------------------------------------
// public
//---------------------------------------------------------
function check( $limit=0, $offset=0 )
{
	$this->_link_broken_count = 0;
	$this->_link_broken_arr   = array();

	$this->_execute( $limit, $offset );
}

function _loop( &$row )
{
	$lid   = $row['lid'];
	$title = $row['title'];
	$url   = $row['url'];

	$check_start = $this->_get_microtime();
	$ret         = $this->_check_url( $url );
	$check_time  = $this->_get_microtime() - $check_start;

	if ( $this->_flag_echo_lid )
	{
		echo '-'.sprintf("%6.3f", $check_time);
	}

	if ( !$ret )
	{
		$this->_countup_link_broken( $lid );
		$this->_link_broken_count ++;
		$this->_link_broken_arr[] = array($lid, $title, $url, $check_time);
	}
}

function set_flag_broken($value)
{
	$this->_flag_broken = (bool)$value;
}

function get_num_link_broken()
{
	return $this->_link_broken_count;
}

//---------------------------------------------------------
// print HTML for check
//---------------------------------------------------------
function _get_link_broken_list()
{
	$text = '';

	if ( $this->_link_broken_count )
	{
		$text .= $this->_get_check_table_start();

		foreach ($this->_link_broken_arr as $broken)
		{
			list($lid, $title, $url, $check_time) = $broken;
    		$text .= $this->_get_check_table_line($lid, $title, $url, $check_time);
		}

		$text .= $this->_get_table_end();

		$this->_link_broken = '<font color="red">'. $this->_link_broken_count .'</font>';
	}
	else
	{
		$this->_link_broken = $this->_link_broken_count;
	}

	return $text;
}

function _get_link_broken_line()
{
	$text  = '<tr><td>' ._WEBLINKS_ADMIN_LINK_NUM_BROKEN .'</td>';
	$text .= '<td>'. $this->_link_broken .' '. _WEBLINKS_ADMIN_NUM. '</td></tr>'."\n";
	return $text;
}

function _get_check_table_start()
{
	$text  = _WEBLINKS_ADMIN_LINK_BROKEN_CHECK_NOTICE;
	$text .= _WEBLINKS_ADMIN_LINK_BROKEN_CHECK_GOOGLE;
	$text .= "<br />\n";
	$text .= '<table border="1"><tr>';
	$text .= '<th align="center">'. _WLS_LINKID .'</th>';
	$text .= '<th align="center">'. _WLS_SITETITLE. '</th>';
	$text .= '<th align="center">'. _WLS_SITEURL. '</th>';
	$text .= '<th align="center">'. 'timeout'. '</th>';

	if ($this->_flag_broken)
	{	$text .= '<th align="center">'. _WEBLINKS_ADMIN_BROKEN .'</th>';	}

	$text .= '</tr>'."\n";

	return $text;
}

function _get_check_table_line($lid, $title, $url, $check_time, $broken='')
{
	$link_id = sprintf("%03d",$lid);

	$modlink = XOOPS_URL.'/modules/'.$this->_DIRNAME.'/admin/link_manage.php?op=modLink&lid='.$lid;
	$title   = htmlspecialchars($title);
	$google_url = $this->_build_google_search_url($title);

	$text  = '<tr>';
	$text .= '<td><a href="'. $modlink    .'" target="_blank">'. $link_id .'</a></td>';
	$text .= '<td><a href="'. $google_url .'" target="_blank">'. $title.'</a></td>';
	$text .= '<td><a href="'. $url        .'" target="_blank">'. $url .'</a></td>';
	$text .= '<td>'. sprintf("%6.3f", $check_time) .'</td>';

	if ($this->_flag_broken)
	{	$text .= '<td>'. $broken .'</td>';	}

	$text .= '</tr>'."\n";

	return $text;
}

function _get_table_end()
{
	return "</table><br />\n";
}

function _build_google_search_url( $query )
{
	$query = happy_linux_convert_to_utf8($query);
	$query = urlencode($query);
	$url = 'http://www.google.com/search?hl='. _LANGCODE .'&q='.$query;
	return $url;
}

//---------------------------------------------------------
// happy_linux_bin_file
//---------------------------------------------------------
function open_bin( $filename )
{
	return $this->_bin_file->open_bin( $filename, 'w' );
}

function close_bin( $flag_chmod )
{
	$this->_bin_file->close_bin( $flag_chmod );
}

function set_flag_write( $val )
{
	$this->_bin_file->set_flag_write( $val );
}

function _write_data( $data )
{
	$this->_bin_file->write_bin( $data );
}

//---------------------------------------------------------
// happy_linux_remote_file
//---------------------------------------------------------
function _check_url( $url )
{
	return $this->_remote_file->check_url( $url );
}

// --- class end ---
}

// === class end ===
}

?>