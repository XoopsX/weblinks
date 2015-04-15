<?php
// $Id: bulk_manage.php,v 1.3 2012/04/09 10:20:04 ohwada Exp $

// 2012-04-02 K.OHWADA
// use camma by \2c
// use \n in textarea1,2
// comment_handler
// rssc_add.php
// link_geocoding.php

// 2010-04-28 K.OHWADA
// $_FLAG_LINK_INSERT;

// 2008-03-04 K.OHWADA
// set time_publish

// 2007-12-24 K.OHWADA
// BUG : not set search field

// 2007-12-16 K.OHWADA
// build_selbox_top()
// BUG: cannot register in TOP when exist

// 2007-11-01 K.OHWADA
// weblinks_admin_print_footer()

// 2007-09-20 K.OHWADA
// Fatal error: Class 'weblinks_link_edit_base_handler' not found
// admin_header_link.php

// 2007-08-01 K.OHWADA
// add_link_optional

// 2007-05-18 K.OHWADA
// BUG: set 0 in comment_use

// 2007-03-25 K.OHWADA
// small change

// 2007-03-01 K.OHWADA
// hack for multi site

// 2006-10-12 K.OHWADA
// BUG 4318: cannot register bulk links.

// 2006-09-20 K.OHWADA
// use happy_linux
// use XoopsGTicket

// 2006-05-15 K.OHWADA
// new handler
// use token ticket

//=========================================================
// WebLinks Module
// 2006-05-15 K.OHWADA
//=========================================================

include 'admin_header.php';
include 'admin_header_link.php';

//=========================================================
// class admin_bulk_manage
//=========================================================
class admin_bulk_manage extends happy_linux_error
{
// handlder
	var $_link_edit_handler;
	var $_link_handler;
	var $_category_handler;
	var $_catlink_handler;
	var $_comment_handler;

	var $_post;
	var $_strings;
	var $_bulk_form;

// local variable
	var $_xoops_uid;
	var $_split_pattern = ',';

	var $_field_array = array();
	var $_field_count = 0;

	var $_flag_check_url  = false;
	var $_flag_check_desc = false;

	var $_FIELD_NAME_ADDTIONAL_ARRAY = 
			array('str_time_publish', 'str_time_expire');

// debug
	var $_FLAG_LINK_INSERT     = true;
	var $_FLAG_CATLINK_INSERT  = true;
	var $_FLAG_CAT_TITLE_CHECK = true;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_bulk_manage()
{
	$this->happy_linux_error();

// handlder
	$this->_link_edit_handler =& weblinks_get_handler( 'link_edit', WEBLINKS_DIRNAME );
	$this->_link_handler      =& weblinks_get_handler( 'link',      WEBLINKS_DIRNAME );
	$this->_category_handler  =& weblinks_get_handler( 'category',  WEBLINKS_DIRNAME );
	$this->_catlink_handler   =& weblinks_get_handler( 'catlink',   WEBLINKS_DIRNAME );
	$this->_comment_handler   =& weblinks_get_handler( 'comment',   WEBLINKS_DIRNAME );

	$this->_post      =& happy_linux_post::getInstance();
	$this->_strings   =& happy_linux_strings::getInstance();

	$this->_bulk_form =& admin_bulk_form::getInstance();

	$this->_xoops_uid = $this->get_xoops_uid();

// BUG : not set search field
	$this->_init();
}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_bulk_manage();
	}
	return $instance;
}

function get_xoops_uid()
{
	global $xoopsUser;
	return $xoopsUser->getVar('uid');
}

//=========================================================
// public
//=========================================================
//---------------------------------------------------------
// POST param
//---------------------------------------------------------
function get_post_op()
{
	return $this->_post->get_post_get('op');
}

function get_post_file()
{
	return $this->_post->get_post('file');
}

function get_post_cid()
{
	return $this->_post->get_post_int('cid');
}

function get_post_catlist()
{
	return $this->_post->get_post_text_split('catlist');
}

function get_post_linklist()
{
	return $this->_post->get_post_text_split('linklist');
}

function get_post_comment_list()
{
	return $this->_post->get_post_text_split('commentlist');
}

function get_post_check_url()
{
	return $this->_post->get_post_int('check_url');
}

function get_post_check_desc()
{
	return $this->_post->get_post_int('check_desc');
}

//---------------------------------------------------------
// init
//---------------------------------------------------------
function _init()
{
	$this->_category_handler->load();
}

//---------------------------------------------------------
// print
//---------------------------------------------------------
function print_menu()
{
	$script = xoops_getenv('PHP_SELF');

	$script_cat       = $script.'?op=form_cat';
	$script_link      = $script.'?op=form_link';
	$script_link_opt  = $script.'?op=form_link_optional';
	$script_file_cat  = $script.'?op=form_file_cat';
	$script_file_link = $script.'?op=form_file_link';
	$script_comment   = $script.'?op=form_comment';

	echo "<h3>". _AM_WEBLINKS_BULK_IMPORT ."</h3>\n";
	echo "<ul>\n";
	echo "<li><a href='$script_cat'>".       _AM_WEBLINKS_BULK_CAT ."</a><br /><br /></li>\n";
	echo "<li><a href='$script_link'>".      _AM_WEBLINKS_BULK_LINK ." (". _AM_WEBLINKS_BULK_LINK_DSC10 ." )</a><br /><br /></li>\n";
	echo "<li><a href='$script_link_opt'>".  _AM_WEBLINKS_BULK_LINK ." (". _AM_WEBLINKS_BULK_LINK_DSC20 ." )</a><br /><br /></li>\n";
	echo "<li><a href='$script_comment'>".       _AM_WEBLINKS_BULK_COMMENT ."</a><br /><br /></li>\n";
	echo "<li><a href='rssc_add.php'>".  _AM_WEBLINKS_TITLE_RSSC_ADD ."</a><br /><br /></li>\n";
	echo "<li><a href='link_geocoding.php'>".  _AM_WEBLINKS_GEO_ADD ."</a><br /><br /></li>\n";
//	echo "<li><a href='$script_file_cat'>".  _AM_WEBLINKS_BULK_CAT ."</a><br /><br /></li>\n";
//	echo "<li><a href='$script_file_link'>". _AM_WEBLINKS_BULK_LINK ."</a><br /><br /></li>\n";
	echo "</ul>\n";
	echo _AM_WEBLINKS_BULK_DSC1 ."<br /><br />\n";
}

function print_form_file($title, $dsc, $file, $op)
{
	$this->_print_title( $title );

	if ( !file_exists($file) )
	{
		$this->_print_error("file not exists: $file");
		return false;
	}

	echo $dsc."<br />\n";
	$this->_bulk_form->print_file_in_form($file);
	$this->_bulk_form->print_form_exec($file, $op);
}

function print_setting_file($file)
{
	$file_html = $this->_sanitize_text($file);

?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=<?php echo _CHARSET; ?>" />
<title><?php echo $file_html; ?></title>
</head>
<body>
<h3><?php echo $file_html; ?></h3>
<?php

	if ( file_exists($file) )
	{
		$this->_bulk_form->print_file_in_form($file);
	}
	else
	{
		$this->_print_error("file not exists: $file");
	}

?>
<br />
<input value='CLOSE' type='button' onclick='javascript:window.close();' />
</head>
</html>
<?php

}

function print_form_category($file)
{
	$selbox = $this->_build_selbox_top(1);
	$this->_bulk_form->print_form_category($file, $selbox);
}

function print_form_link($file)
{
	$this->_bulk_form->print_form_link($file);
}

function print_form_link_optional($file)
{
	$this->_bulk_form->print_form_link_optional($file);
}

function print_form_comment($file)
{
	$this->_bulk_form->print_form_comment($file);
}


//---------------------------------------------------------
// add category & link
//---------------------------------------------------------
function check_lines($lines)
{
	$count = count($lines);
	if ($count == 0) {
		return false;
	}
 	if ( ($count == 1) && empty($lines[0]) ) {
		return false;
	}
	return true;
}

function add_cat($cid, $line_arr)
{
	echo "<h4>". _AM_WEBLINKS_BULK_CAT ."</h4>\n";

// proc lines
	$ret = $this->_proc_cat($cid, $line_arr);
	if ( !$ret )
	{
		echo "<br />\n";
		$this->_print_error( _AM_WEBLINKS_BULK_ERROR_FINISH );
	}

	echo "<br />\n";
	echo "<h4>". _WLS_NEWCATADDED ."</h4>\n";
}

function add_link($line_arr)
{
	echo "<h4>". _AM_WEBLINKS_BULK_LINK ."</h4>\n";

	$ret = $this->_proc_link($line_arr);
	if ( !$ret )
	{
		echo "<br />\n";
		$this->_print_error( _AM_WEBLINKS_BULK_ERROR_FINISH );
	}

	echo "<br />\n";
	echo "<h4>". _WLS_NEWLINKADDED ."</h4>\n";
}

function add_link_optional($line_arr)
{
	echo "<h4>". _AM_WEBLINKS_BULK_LINK ."</h4>\n";

	$ret = $this->_proc_link_optinal($line_arr);
	if ( !$ret )
	{
		echo "<br />\n";
		$this->_print_error( _AM_WEBLINKS_BULK_ERROR_FINISH );
	}

	echo "<br />\n";
	echo "<h4>". _WLS_NEWLINKADDED ."</h4>\n";
}

function add_comment($line_arr)
{
	echo "<h4>". _AM_WEBLINKS_BULK_COMMENT ."</h4>\n";

// proc lines
	$ret = $this->_proc_comment($line_arr);
	if ( !$ret )
	{
		echo "<br />\n";
		$this->_print_error( _AM_WEBLINKS_BULK_ERROR_FINISH );
	}

	echo "<br />\n";
	echo "<h4>". _AM_WEBLINKS_COMMENT_ADDED ."</h4>\n";
}

//---------------------------------------------------------
// file category & link
//---------------------------------------------------------
function file_cat($file)
{
	$this->_print_title( _AM_WEBLINKS_BULK_CAT );

	if ( !file_exists($file) )
	{
		$this->_print_error("file not exists: $file");
		return false;
	}

	$line_arr = file($file);

// parent category
	$this->set_split_pattern("\t");

	$line = array_shift($line_arr);
	$line = trim($line);

	list($depth, $arr) = $this->_get_cat($line);

	if ( !$this->_check_cat($arr) )
	{
		echo "<br />\n";
		echo "<b>". _AM_WEBLINKS_BULK_ERROR_FINISH ."</b><br />\n";
		return;
	}

	$cid = $this->_get_cid_by_title( $arr['title'] );
	if ( $cid == -1 )
	{
		echo "<br />\n";
		echo "<b>". _AM_WEBLINKS_BULK_ERROR_FINISH ."</b><br />\n";
		return;
	}

// proc lines
	$ret = $this->_proc_cat($cid, $line_arr);
	if ( !$ret )
	{
		echo "<br />\n";
		$this->_print_error( _AM_WEBLINKS_BULK_ERROR_FINISH );
	}

	echo "<br />\n";
	echo "<b>". _WLS_NEWCATADDED ."</b><br />\n";
	echo "<hr />\n";
}

function file_link($file)
{
	$this->_print_title( _AM_WEBLINKS_BULK_LINK );

	if ( !file_exists($file) )
	{
		$this->_print_error("file not exists: $file");
		return false;
	}

	$line_arr = file($file);

	$this->set_split_pattern("\t");

	$ret = $this->_proc_link($line_arr);
	if ( !$ret )
	{
		echo "<br />\n";
		$this->_print_error( _AM_WEBLINKS_BULK_ERROR_FINISH );
	}

	echo "<br />\n";
	echo "<b>". _WLS_NEWLINKADDED ."</b><br />\n";
	echo "<hr />\n";
}

//=========================================================
// private
//=========================================================
//---------------------------------------------------------
// category
//---------------------------------------------------------
function _proc_cat($pid_first, $line_arr)
{
// category
	$pid_arr    = array();
	$pid_arr[0] = $pid_first;
	$pid        = $pid_first;
	$depth_prev = 0;

	foreach ($line_arr as $line)
	{
		$line = trim($line);
	 	if (empty($line))  continue;

		list($depth, $arr) = $this->_get_cat($line);

	 	if ( !$this->_check_cat($arr) )
	 	{
	 		continue;
		}

// under one level, or above level
		if ( ( $depth == ($depth_prev + 1) ) || ( $depth < $depth_prev ) )
		{
			$pid = $pid_arr[$depth];
		}
// under two or more level
		elseif ( $depth > $depth_prev )
		{
			$this->_print_error( _AM_WEBLINKS_BULK_ERROR_LAYER );
			return false;
		}

		$newid = $this->_insert_cat($pid, $arr);
		if ( !$newid )
		{
			return false;
		}

		$pid_arr[$depth+1] = $newid;
		$depth_prev        = $depth;
	}

	return true;
}

function _get_cat($line)
{
	$depth = 0;
	$arrow = '';
	$title = '';

	if ( preg_match ("/^>/", $line) )
	{
		list($arrow, $title) = preg_split("/\s+/", $line, 2);
		$depth = substr_count($arrow, ">");
	}
	else
	{
		$title = $line;
	}

	echo $this->_str_trim_html("$arrow $title");
	echo "<br />\n";

	$arr = array(
		'title'       => $title,
	);

	return array($depth, $arr);
}

function _check_cat($arr)
{
	if ( !isset($arr['title']) || empty($arr['title']) )
	{
		$this->_print_error( _NO_TITLE );
		return false;
	}

	return true;
}

function _insert_cat($pid, $arr)
{
	$pid = intval($pid);
	if ( $pid < 0 )
	{
		$this->_print_error( _AM_WEBLINKS_BULK_ERROR_PID );
		return false;
	}

	$arr['pid']   = $pid;
	$arr['lflag'] = 1;

	$obj =& $this->_category_handler->create();

// BUG 4318: cannot register bulk links.
// Fatal error: Call to undefined method weblinks_category::assign_vars_post()
	$obj->setVars( $arr, true );

	$newid = $this->_category_handler->insert($obj);
	if ( !$newid )
	{
		$this->_print_error( $this->_category_handler->getErrors(1) );
		return false;
	}

	return $newid;
}

function _get_cid_by_title($title)
{
	$cid_arr =& $this->_category_handler->get_cid_array_by_title($title);

	$count   = count($cid_arr);
	$title_s = $this->_str_trim_html($title);

	if ( is_array($cid_arr) && ($count == 1))
	{
		return $cid_arr[0];
	}
	elseif ($count > 1)
	{
		$this->_print_error( _MANY_MATCH_RECORD.": ".$title_s );
//		echo "$err_html <br />\n";
		return -1;
	}

	if ( !is_array($cid_arr) || ($count == 0))
	{
		$cid_arr2 =& $this->_category_handler->get_cid_array_by_title_like($title);
		$count2   = count($cid_arr2);

		if ( is_array($cid_arr2) && ($count2 == 1))
		{
			return $cid_arr2[0];
		}
		elseif ($count2 > 1)
		{
			$this->_print_error( _MANY_MATCH_RECORD.": ".$title_s );
//			echo "$err_html <br />\n";
			return -1;
		}
	}

// BUG: cannot register in TOP when exist
	if ( $title == WEBLINKS_C_CAT_TOP )
	{	return 0;	}

	$this->_print_error( _NO_MATCH_RECORD.": ".$title_s );
//	echo "$err_html <br />\n";
	return -1;

}

function _build_selbox_top()
{
	$selbox = $this->_category_handler->build_selbox_top( 0, 1, "cid", '' );
	return $selbox;
}

//---------------------------------------------------------
// fixed link
// order of filed is fixed
// title, url, description
//---------------------------------------------------------
function _proc_link($line_arr)
{
	$this->_flag_check_url  = $this->get_post_check_url();
	$this->_flag_check_desc = $this->get_post_check_desc();

	$flag_line = 0;
	$cid       = -1;	// dummy

	foreach ($line_arr as $line)
	{
		$line = trim($line);

// blank
		if (empty($line))  continue;

// pause
		if ( $this->_check_line_pause($line) )
		{
			echo "<br />\n";
			$flag_line = 0;
		}

// category
		elseif ($flag_line == 0)
		{
			$category_title = $line;

			if ( !$this->_check_cat(array('title' => $category_title)) )
			{
				return false;
			}

			$cid = $this->_get_cid_by_title($category_title);
			if ( $this->_FLAG_CAT_TITLE_CHECK && ( $cid == -1 ))
			{
				return false;
			}

			echo "$cid: $category_title <br />\n";
			$flag_line = 1;
		}

// link
		elseif ($flag_line == 1)
		{
			$link_arr = $this->_get_link($line);

		 	if ( !$this->_check_link($link_arr) )
		 	{
		 		continue;
			}

			$ret = $this->_insert_link($cid, $link_arr);
			if ( !$ret )
			{
				return false;
			}
		}
 		else
		{
			$this->_print_error("system error");
			return false;
		}

	}

	return true;
}

function _get_link($line)
{
	$title = '';
	$url   = '';
	$description = '';

	list($title, $url, $description) = $this->_split_line($line);

	$str = "$title, $url, $description";
	echo $this->_str_trim_html($str);
	echo "<br />\n";

	$description = $this->_convert_str_to_crlf($description);

// BUG: set 0 in comment_use
	$obj =& $this->_link_handler->create();
	$arr =& $obj->gets();
	$arr['title']       = $title;
	$arr['url']         = $url;
	$arr['description'] = $description;

	return $arr;
}

function _check_link($arr)
{
	if ( !isset($arr['title']) || empty($arr['title']) )
	{
		$this->_print_error( _NO_TITLE );
		return false;
	}

	if ( $this->_flag_check_url )
	{
		if ( !isset($arr['url']) || empty($arr['url']) )
		{
			$this->_print_error( _NO_URL );
			return false;
		}
	}

	if ( $this->_flag_check_desc )
	{
		if ( !isset($arr['description']) || empty($arr['description']) )
		{
			$this->_print_error( _NO_DESCRIPTION );
			return false;
		}
	}

 	return true;
}

function _insert_link($cid, $arr)
{
	$cid = intval($cid);

	if ( $cid <= 0 )
	{
		$this->_print_error( _AM_WEBLINKS_BULK_ERROR_CID );
		return false;
	}

// BUG : not set search field
	$arr['cid'] = array( $cid );

// BUG 4318: cannot register bulk links.
// Fatal error: Call to undefined method weblinks_link_edit_handler::add_link_to_link()
	$link_obj =& $this->_link_edit_handler->create_add_link_by_arr( $arr, true, false );

// set time_publish
	if ( isset( $arr['time_publish'] ) )
	{
		$time_publish = intval( $arr['time_publish'] );
		if ( $time_publish > 0 )
		{
			$link_obj->setVar( 'time_publish', $time_publish );
		}
	}
	if ( isset( $arr['time_expire'] ) )
	{
		$time_expire = intval( $arr['time_expire'] );
		if ( $time_expire > 0 )
		{
			$link_obj->setVar( 'time_expire', $time_expire );
		}
	}

	if ( $this->_FLAG_LINK_INSERT ) {
		$newid = $this->_link_handler->insert($link_obj);
		if ( !$newid )
		{
			$this->_print_errors( $this->_link_handler->getErrors(1) );
			return false;
		}
	}

// catlink_obj
	$catlink_obj =& $this->_catlink_handler->create();
	$catlink_obj->setVar('cid', $cid );
	$catlink_obj->setVar('lid', $newid );

	if ( $this->_FLAG_CATLINK_INSERT ) {
		$ret = $this->_catlink_handler->insert($catlink_obj);
		if ( !$ret )
		{
			$this->_print_error( $this->_catlink_handler->getErrors(1) );
			return false;
		}
	}

 	return true;
}

//---------------------------------------------------------
// optinal link
// user can specify the name and rder of fields
// ex) 'title', 'url', 'description', 'addr'
//---------------------------------------------------------
function _proc_link_optinal($line_arr)
{
	$this->_flag_check_url  = $this->get_post_check_url();
	$this->_flag_check_desc = $this->get_post_check_desc();

	$flag_line = -1;	// field name
	$cid       = -1;	// dummy

	foreach ($line_arr as $line)
	{
		$line = trim($line);

// blank
		if (empty($line))  continue;

// pause
		if ( $this->_check_line_pause($line) )
		{
			echo "<br />\n";
			$flag_line = 0;
		}

// category
		elseif ($flag_line == 0)
		{
			$category_title = $line;

			if ( !$this->_check_cat(array('title' => $category_title)) )
			{
				return false;
			}

			$cid = $this->_get_cid_by_title($category_title);
			if ( $cid == -1 )
			{
				return false;
			}

			echo "$cid: $category_title <br />\n";
			$flag_line = 1;
		}

// link
		elseif ($flag_line == 1)
		{
			$link_arr = $this->_get_link_optinal($line);

		 	if ( !$this->_check_link($link_arr) )
		 	{
		 		continue;
			}

			$ret = $this->_insert_link($cid, $link_arr);
			if ( !$ret )
			{
				return false;
			}
		}

// field name
		elseif ($flag_line == -1)
		{
			$this->_field_array =& $this->_split_line($line);
			$this->_field_count = count($this->_field_array);

			if ( !$this->_check_field($this->_field_array) )
		 	{
				return false;
			}
		}
 		else
		{
			$this->_print_error("system error");
			return false;
		}

	}

	return true;
}

function _get_link_optinal($line)
{
	$title = '';
	$url   = '';
	$description = '';

	$link_arr = array();
	$temp_arr =& $this->_split_line($line);

	for ( $i = 0; $i < $this->_field_count; $i++ )
	{
		if ( isset($temp_arr[$i]) )
		{
			$link_arr[ $this->_field_array[$i] ] = $temp_arr[$i];
		}
	}

// set time_publish
	if ( isset( $link_arr['str_time_publish'] ) )
	{
		$link_arr['time_publish'] = strtotime( $link_arr['str_time_publish'] );
	}
	if ( isset( $link_arr['str_time_expire'] ) )
	{
		$link_arr['time_expire'] = strtotime( $link_arr['str_time_expire'] );
	}

	if ( isset($link_arr['title']) )
	{
		$title = $link_arr['title'];
	}
	if ( isset($link_arr['url']) )
	{
		$url = $link_arr['url'];
	}
	if ( isset($link_arr['description']) )
	{
		$description = $link_arr['description'];
		$link_arr['description'] = $this->_convert_str_to_crlf($description);
	}
	if ( isset($link_arr['description']) )
	{
		$description = $link_arr['description'];
		$link_arr['description'] = $this->_convert_str_to_crlf($description);
	}
	if ( isset($link_arr['textarea1']) )
	{
		$link_arr['textarea1'] = $this->_convert_str_to_crlf( $link_arr['textarea1'] );
	}
	if ( isset($link_arr['textarea2']) )
	{
		$link_arr['textarea2'] = $this->_convert_str_to_crlf( $link_arr['textarea2'] );
	}

	$str = "$title, $url, $description";
	echo $this->_str_trim_html($str);
	echo "<br />\n";

	$obj =& $this->_link_handler->create();
	$obj->setVars( $link_arr );
	$obj_arr =& $obj->gets();
	return $obj_arr;
}

function _check_field( $arr )
{
	$this->_link_handler->get_field_meta_name_array();
	$field_name_array =& $this->_link_handler->get_field_name_array();

	$field_arr = array_merge( $field_name_array, $this->_FIELD_NAME_ADDTIONAL_ARRAY );

	foreach ( $arr as $field )
	{
		if ( !in_array($field, $field_arr) )
		{
			$msg = 'not defined field name : ' . $field;
			$this->_print_error( $msg );
			return false;
		}
	}

 	return true;
}

//---------------------------------------------------------
// comment
//---------------------------------------------------------
function _proc_comment($line_arr)
{
	foreach ($line_arr as $line)
	{
		$line = trim($line);
	 	if (empty($line))  continue;

		list($link_title, $uid, $com_title, $com_text) = $this->_split_line($line);

		$str = "$link_title, $uid, $com_title, $com_text";
		echo $this->_str_trim_html($str);
		echo "<br />\n";

		if ( empty($link_title) ) {
			$this->_print_error( "no link title" );
			return false;
		}

		if ( empty($com_text) ) {
			$this->_print_error( "no comment text" );
			return false;
		}

		$link_title_s = $this->_str_trim_html($link_title);

		$lid = $this->_link_handler->get_lid_by_title($link_title);
		if ( $lid == -1 ) {
			$this->_print_error( _NO_MATCH_RECORD.": ".$link_title_s );
			return false;
		} elseif (($lid == -2)||($lid == -3)) {
			$this->_print_error( _MANY_MATCH_RECORD.": ".$link_title_s );
			return false;
		}

		$uid = intval($uid);
		if ( empty($uid) || ($uid <= 0) ) {
			$uid = $this->_xoops_uid ;
		}
		if ( empty($com_title) ) {
			$com_title = 'Re:'.$link_title ;
		}

		$com_text = $this->_convert_str_to_crlf($com_text);

		$newid = $this->_comment_handler->insert_comment_by_lid(
			$lid, $uid, $com_title, $com_text);
		if ( !$newid ) {
			$error = $this->_comment_handler->get_error();
			$this->_print_error( $error );
			return false;
		}
	}

	return true;
}

//-----------------------------------------------
// check or split line
//-----------------------------------------------
function _check_line_pause($line)
{
	if ( preg_match ("/^---/", $line) )
	{
		return true;
	}

	return false;
}

function &_split_line($line)
{
	$item_arr = split($this->_split_pattern, $line);

	foreach ($item_arr as $key => $item)
	{
		$item_arr[$key] = $this->_convert_str_to_camma( trim($item) );

	}

	return $item_arr;
}

function set_split_pattern($value)
{
	$this->_split_pattern = $value;
}

//-----------------------------------------------
// convert strings
//-----------------------------------------------
function _str_trim_html($str, $max=100)
{
	$str = $this->_strings->shorten_text($str, $max);
	$str = $this->_sanitize_text($str);
	return $str;
}

function _convert_str_to_crlf($str)
{
	$str = $this->_strings->convert_str_to_crlf($str);
	return $str;
}

function _convert_str_to_camma($str)
{
	$str = str_replace('\2c', ',', $str);
	return $str;
}

function _sanitize_text($str)
{
	$str = htmlspecialchars($str, ENT_QUOTES);
	return $str;
}

//-----------------------------------------------
// print
//-----------------------------------------------
function _print_title($title)
{
	echo $this->_bulk_form->_build_html_title($title);
}

function _print_error($msg)
{
	echo $this->_bulk_form->build_html_red($msg);
}

//---------------------------------------------------------
// token ticket
//---------------------------------------------------------
function check_token()
{
	$ret = $this->_bulk_form->check_token();
	return $ret;
}


// --- class end ---
}


//=========================================================
// class admin_bulk_form
//=========================================================
class admin_bulk_form extends happy_linux_form
{
	var $ROWS = 40;
	var $COLS = 80;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_bulk_form()
{
	$this->happy_linux_form();
}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_bulk_form();
	}
	return $instance;
}

//---------------------------------------------------------
// public
//---------------------------------------------------------
function print_form_category($file, $selbox)
{
	echo $this->_build_table_begin( _AM_WEBLINKS_BULK_CAT );

// add category
	echo $this->build_form_begin( 'add_cat' );
	echo $this->build_token();
	echo $this->build_html_input_hidden('op', 'add_cat');

	echo "&nbsp;"._WLS_IN."&nbsp;".$selbox."<br /><br />\n";
	echo _AM_WEBLINKS_BULK_CAT_DSC1."<br />\n";
	echo _AM_WEBLINKS_BULK_CAT_DSC2."<br />\n";
	echo _AM_WEBLINKS_BULK_SAMPLE."<br /><br />\n";

	echo $this->build_html_textarea('catlist', '', $this->ROWS, $this->COLS );
	echo "<br />\n";
	echo $this->build_html_input_submit('submit', _ADD );
	echo $this->build_html_input_button_cancel('cancel', _BACK );
	echo $this->build_form_end();

// view file 
	$this->_print_view_file('view_cat', $file);

	echo $this->_build_table_end();

}

function print_form_link($file)
{
	$msg = _AM_WEBLINKS_BULK_LINK ." ( ". _AM_WEBLINKS_BULK_LINK_DSC10 ." )";
	echo $this->_build_table_begin( $msg );

// add link
	echo $this->build_form_begin( 'add_link' );
	echo $this->build_token();
	echo $this->build_html_input_hidden('op', 'add_link');

	echo _AM_WEBLINKS_BULK_LINK_DSC1."<br />\n";
	echo _AM_WEBLINKS_BULK_LINK_DSC2."<br />\n";
	echo _AM_WEBLINKS_BULK_LINK_DSC3."<br />\n";
	echo _AM_WEBLINKS_BULK_SAMPLE."<br /><br />\n";

	echo $this->build_html_textarea('linklist', '',  $this->ROWS, $this->COLS );
	echo "<br />\n";
	echo $this->build_html_input_checkbox('check_url', 1, 'checked');
	echo _AM_WEBLINKS_BULK_CHECK_URL ."<br />\n";
	echo $this->build_html_input_checkbox('check_desc', 1, 'checked');
	echo _AM_WEBLINKS_BULK_CHECK_DESCRIPTION ."<br />\n";
	echo "<br />\n";
	echo $this->build_html_input_submit('submit', _ADD );
	echo $this->build_html_input_button_cancel('cancel', _BACK );
	echo $this->build_form_end();

// view file 
	$this->_print_view_file('view_link', $file);

	echo $this->_build_table_end();

}

function print_form_link_optional($file)
{
	$msg = _AM_WEBLINKS_BULK_LINK ." ( ". _AM_WEBLINKS_BULK_LINK_DSC20 ." )";
	echo $this->_build_table_begin( $msg );

// add link
	echo $this->build_form_begin( 'add_link_optional' );
	echo $this->build_token();
	echo $this->build_html_input_hidden('op', 'add_link_optional');

	echo _AM_WEBLINKS_BULK_LINK_DSC21."<br />\n";
	echo _AM_WEBLINKS_BULK_LINK_DSC23."<br /><br />\n";
	echo _AM_WEBLINKS_BULK_LINK_DSC22."<br />\n";
	echo _AM_WEBLINKS_BULK_LINK_DSC1."<br />\n";
	echo _AM_WEBLINKS_BULK_LINK_DSC24."<br />\n";
	echo _AM_WEBLINKS_BULK_LINK_DSC3."<br /><br />\n";
	echo _AM_WEBLINKS_BULK_SAMPLE."<br /><br />\n";

	echo $this->build_html_textarea('linklist', '',  $this->ROWS, $this->COLS );
	echo "<br />\n";
	echo $this->build_html_input_checkbox('check_url', 1, 'checked');
	echo _AM_WEBLINKS_BULK_CHECK_URL ."<br />\n";
	echo $this->build_html_input_checkbox('check_desc', 1, 'checked');
	echo _AM_WEBLINKS_BULK_CHECK_DESCRIPTION ."<br />\n";
	echo "<br />\n";
	echo $this->build_html_input_submit('submit', _ADD );
	echo $this->build_html_input_button_cancel('cancel', _BACK );
	echo $this->build_form_end();

// view file 
	$this->_print_view_file('view_link', $file);

	echo $this->_build_table_end();

}

function print_form_comment($file)
{
	echo $this->_build_table_begin( _AM_WEBLINKS_BULK_COMMENT );

// add category
	echo $this->build_form_begin( 'add_comment' );
	echo $this->build_token();
	echo $this->build_html_input_hidden('op', 'add_comment');

	echo _AM_WEBLINKS_BULK_COMMENT_DSC1."<br />\n";
	echo _AM_WEBLINKS_BULK_SAMPLE."<br /><br />\n";

	echo $this->build_html_textarea('commentlist', '', $this->ROWS, $this->COLS );
	echo "<br />\n";
	echo $this->build_html_input_submit('submit', _ADD );
	echo $this->build_html_input_button_cancel('cancel', _BACK );
	echo $this->build_form_end();

// view file 
	$this->_print_view_file('view_comment', $file);

	echo $this->_build_table_end();

}

function print_file_in_form($file, $rows=40, $cols=80 )
{
	echo "<form>\n";
	echo "<textarea rows='".$rows."' cols='".$cols."'>\n";

	readfile($file);

	echo "\n</textarea>\n";
	echo "</form>\n";
}

function print_form_exec($file, $op, $button='')
{
	if (empty($button))
	{
		$button = _HAPPY_LINUX_EXECUTE;
	}

	echo $this->build_form_begin( 'add_link' );
	echo $this->build_token();
	echo $this->build_html_input_hidden('op',   $op);
	echo $this->build_html_input_hidden('file', $file);
	echo $this->build_html_input_submit('submit', $button );
	echo $this->build_html_input_button_cancel('cancel', _BACK );

}

//---------------------------------------------------------
// private
//---------------------------------------------------------
function _print_view_file($form_name, $file)
{
	$action = '';
	$extra  = 'target="_blank"';

	echo $this->build_form_begin( $form_name, $action, 'post', '', $extra );
	echo $this->build_html_input_hidden('op',  'view');
	echo $this->build_html_input_hidden('file', $file);
	echo $this->build_html_input_submit('submit', _HAPPY_LINUX_SAMPLE );
	echo $this->build_form_end();

}

function _build_table_begin( $title )
{
	$text  = "<table width='100%' border='0' cellspacing='1' class='outer'>\n";
	$text .= "<tr class='odd'><td>\n";
	$text .= $this->_build_html_title($title);
	return $text;
}

function _build_table_end()
{
	$text = "</td></tr></table><br />\n";
	return $text;
}

function _build_html_title($title)
{
	$text = "<h4>$title</h4>\n";
	return $text;
}

// --- class end ---
}


//=========================================================
// main start
//=========================================================
// hack for multi site
weblinks_admin_multi_disable_feature();

$XOOPS_LANGUAGE = $xoopsConfig['language'];

// for local
$FILE_CAT = WEBLINKS_ROOT_PATH."/language/".$XOOPS_LANGUAGE."/bulk/cat_cvs.txt";
if ( !file_exists( $FILE_CAT ) ) 
{
	$FILE_CAT = WEBLINKS_ROOT_PATH."/language/english/bulk/cat_cvs.txt";
}

$FILE_LINK = WEBLINKS_ROOT_PATH."/language/".$XOOPS_LANGUAGE."/bulk/link_cvs.txt";
if ( !file_exists( $FILE_LINK ) ) 
{
	$FILE_LINK = WEBLINKS_ROOT_PATH."/language/english/bulk/link_cvs.txt";
}

$FILE_LINK_2 = WEBLINKS_ROOT_PATH."/language/".$XOOPS_LANGUAGE."/bulk/link_cvs_2.txt";
if ( !file_exists( $FILE_LINK_2 ) ) 
{
	$FILE_LINK_2 = WEBLINKS_ROOT_PATH."/language/english/bulk/link_cvs_2.txt";
}

$FILE_FILE_CAT = WEBLINKS_ROOT_PATH."/language/".$XOOPS_LANGUAGE."/bulk/cat_tab.txt";
if ( !file_exists( $FILE_FILE_CAT ) ) 
{
	$FILE_FILE_CAT = WEBLINKS_ROOT_PATH."/language/english/bulk/cat_tab.txt";
}

$FILE_FILE_LINK = WEBLINKS_ROOT_PATH."/language/".$XOOPS_LANGUAGE."/bulk/link_tab.txt";
if ( !file_exists( $FILE_FILE_LINK ) ) 
{
	$FILE_FILE_LINK = WEBLINKS_ROOT_PATH."/language/english/bulk/link_tab.txt";
}

$FILE_COMMENT = WEBLINKS_ROOT_PATH."/language/".$XOOPS_LANGUAGE."/bulk/comment_cvs.txt";
if ( !file_exists( $FILE_COMMENT ) ) 
{
	$FILE_COMMENT = WEBLINKS_ROOT_PATH."/language/english/bulk/comment_cvs.txt";
}

$bulk_manage =& admin_bulk_manage::getInstance();

$op   = $bulk_manage->get_post_op();
$file = $bulk_manage->get_post_file();
 
switch ($op)
{
	case 'view':
		$bulk_manage->print_setting_file( $file );
		exit();
		break;

	case 'add_cat':
		if( !( $bulk_manage->check_token() ) ) 
		{
			redirect_header( "bulk_manage.php", 5, "Token Error");
			exit();
		}

		$cid       = $bulk_manage->get_post_cid();
		$cat_lines = $bulk_manage->get_post_catlist();

		if ( ! $bulk_manage->check_lines($cat_lines) )
		{
			redirect_header("bulk_manage.php", 2, _NO_CATEGORY);
			exit();
		}

		xoops_cp_header();
		weblinks_admin_print_bread( _AM_WEBLINKS_BULK_IMPORT, 'bulk_manage.php', _AM_WEBLINKS_BULK_CAT );
		$bulk_manage->add_cat($cid, $cat_lines);
		break;

	case 'add_link':
		if( !( $bulk_manage->check_token() ) ) 
		{
			redirect_header( "bulk_manage.php", 5, "Token Error");
			exit();
		}

		$link_lines = $bulk_manage->get_post_linklist();

		if ( ! $bulk_manage->check_lines($link_lines) )
		{
			redirect_header("index.php", 2, _NO_LINK);
			exit();
		}

		xoops_cp_header();
		weblinks_admin_print_bread( _AM_WEBLINKS_BULK_IMPORT, 'bulk_manage.php', _AM_WEBLINKS_BULK_LINK );
		$bulk_manage->add_link($link_lines);
		break;

	case 'add_link_optional':
		if( !( $bulk_manage->check_token() ) ) 
		{
			redirect_header( "bulk_manage.php", 5, "Token Error");
			exit();
		}

		$link_lines = $bulk_manage->get_post_linklist();

		if ( ! $bulk_manage->check_lines($link_lines) )
		{
			redirect_header("index.php", 2, _NO_LINK);
			exit();
		}

		xoops_cp_header();
		weblinks_admin_print_bread( _AM_WEBLINKS_BULK_IMPORT, 'bulk_manage.php', _AM_WEBLINKS_BULK_LINK );
		$bulk_manage->add_link_optional($link_lines);
		break;

	case 'add_comment':
		if( !( $bulk_manage->check_token() ) ) 
		{
			redirect_header( "bulk_manage.php", 5, "Token Error");
			exit();
		}

		$comment_lines = $bulk_manage->get_post_comment_list();

		if ( ! $bulk_manage->check_lines($comment_lines) )
		{
			redirect_header("bulk_manage.php", 2, _AM_WEBLINKS_NO_COMMENT);
			exit();
		}

		xoops_cp_header();
		weblinks_admin_print_bread( _AM_WEBLINKS_BULK_IMPORT, 'bulk_manage.php', _AM_WEBLINKS_BULK_COMMENT );
		$bulk_manage->add_comment($comment_lines);
		break;

	case 'file_cat':
		xoops_cp_header();
		$bulk_manage->file_cat($file);
		break;

	case 'file_link':
		xoops_cp_header();
		$bulk_manage->file_link($file);
		break;

	case 'form_link':
		xoops_cp_header();
		weblinks_admin_print_header();
		weblinks_admin_print_menu();
		$bulk_manage->print_menu();
		$bulk_manage->print_form_link( $FILE_LINK );
		break;

	case 'form_link_optional':
		xoops_cp_header();
		weblinks_admin_print_header();
		weblinks_admin_print_menu();
		$bulk_manage->print_menu();
		$bulk_manage->print_form_link_optional( $FILE_LINK_2 );
		break;

	case 'form_file_cat':
		xoops_cp_header();
		weblinks_admin_print_header();
		weblinks_admin_print_menu();
		echo "<h3>". _AM_WEBLINKS_BULK_IMPORT ."</h3>\n";
		$bulk_manage->print_form_file($TITLE_FILE_CAT, $DESC_FILE_CAT, $FILE_FILE_CAT, 'file_cat');
		break;

	case 'form_file_link':
		xoops_cp_header();
		weblinks_admin_print_header();
		weblinks_admin_print_menu();
		echo "<h3>". _AM_WEBLINKS_BULK_IMPORT ."</h3>\n";
		$bulk_manage->print_form_file($TITLE_FILE_LINK, $DESC_FILE_LINK, $FILE_FILE_LINK, 'file_link');
		break;

	case 'form_comment':
		xoops_cp_header();
		weblinks_admin_print_header();
		weblinks_admin_print_menu();
		$bulk_manage->print_menu();
		$bulk_manage->print_form_comment( $FILE_COMMENT );
		break;

	case 'form_cat':
	case 'menu':
	default:
		xoops_cp_header();
		weblinks_admin_print_header();
		weblinks_admin_print_menu();
		$bulk_manage->print_menu();
		$bulk_manage->print_form_category( $FILE_CAT );
		break;	
}

weblinks_admin_print_footer();
xoops_cp_footer();
exit();
// --- end of main ---

?>