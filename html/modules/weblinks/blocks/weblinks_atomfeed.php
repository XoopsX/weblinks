<?php
// $Id: weblinks_atomfeed.php,v 1.1 2011/12/29 14:32:32 ohwada Exp $

// 2007-08-01 K.OHWADA
// multibyte.php

// 2006-09-20 K.OHWADA
// rssc

// 2006-05-15 K.OHWADA
// change $moduel_url to $dirname

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication

//=========================================================
// WebLinks Module
// 2004-11-28 K.OHWADA
//=========================================================

include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/sanitize.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/multibyte.php';

// --- block function begin ---
if( !function_exists( 'b_weblinks_atom_show' ) ) 
{

//---------------------------------------------------------
// $options
// [0] module directory name (weblinks)
// [1] the display number of atomfeed (10)
// [2] max of title length (25)
// [3] max of summary      (100)
//---------------------------------------------------------

function b_weblinks_atom_show($options) 
{
	global $xoopsDB;

	$DIRNAME = empty( $options[0] ) ? basename( dirname( dirname( __FILE__ ) ) ) : $options[0];
	$limit       = $options[1];
	$max_title   = $options[2] - 1 ;
	$max_summary = $options[3] - 1 ;

	$table_config = $xoopsDB->prefix( $DIRNAME."_config2" );

// config
	$sql = 'SELECT * FROM '.$table_config.' ORDER BY conf_id ASC';

	$res = $xoopsDB->query($sql, 0, 0);
	if ( !$res )
	{
		return false;
	}

	while ($row = $xoopsDB->fetchArray($res)) 
	{
		$conf[ $row['conf_name'] ] = $row['conf_value'];
	}

	$rss_dirname = $conf['rss_dirname'];
	$rss_use     = $conf['rss_use'];

	$block = array();
	$block["lang_more"]  = _MB_WEBLINKS_MORE;
	$block["dirname"]    = $DIRNAME;

// check exist rssc module
	$module_handler =& xoops_gethandler('module');
	$module =& $module_handler->getByDirname( $rss_dirname );
	if ( !is_object($module) )
	{
		$block['feed_show']  = 0;
		$block['lang_error'] = 'rssc not installed';
		return $block;
	}

	if ( !$rss_use )
	{
		$block['feed_show']  = 0;
		$block['lang_error'] = _MB_WEBLINKS_NO_ATOMFEED;
		return $block;
	}

	$table_rssc_feed = $xoopsDB->prefix( $rss_dirname."_feed" );

	$DAY    = 3;
	$future = time() + $DAY*24*3600;
	$order  = 'updated_unix DESC, fid DESC';

// mid
	$mid = 0;
	$module =& $module_handler->getByDirname( $DIRNAME );
	if ( is_object($module) )
	{
		$mid = $module->getVar('mid');
	}

	$sql  = 'SELECT * FROM '.$table_rssc_feed;
	$sql .= ' WHERE updated_unix <'.$future;
	$sql .= ' AND published_unix <'.$future;

	if ($mid)
	{
		$sql .= ' AND mid ='.$mid;
	}

	$sql .= ' ORDER BY '.$order;

	$res = $xoopsDB->query($sql, $limit, 0);
	$num = $xoopsDB->getRowsNum($res);

// no atomfeed
	if ( $num == 0 )
	{
		$block['feed_show']  = 0;
		$block['lang_error'] = _MB_WEBLINKS_NO_ATOMFEED;
		return $block;
	}

	while( $row = $xoopsDB->fetchArray($res) )
	{
		$site_title    = $row['site_title'];
		$site_url      = $row['site_link'];
		$title         = $row['title'];
		$url           = $row['link'];
		$content       = $row['content'];
		$time_modified = $row['updated_unix'];
	
		$feed = array();

// site_title
		if (strlen( $site_title ) > $max_title) 
		{
			$site_title = happy_linux_mb_build_summary( $site_title, $max_title );
		}
		elseif ( empty($site_title) )
		{
			$site_title = "---";
		}

// title
		if (strlen( $title ) > $max_title) 
		{
			$title = happy_linux_mb_build_summary( $title, $max_title );
		}
		elseif ( empty($title) )
		{
			$title = "---";
		}

// summary
		$summary = happy_linux_mb_build_summary( $content, $max_summary );

// date
		$date = '';

		if ( $time_modified ) 
		{
			$date = formatTimestamp($time_modified, "s");
		}

		$feed['date']       = $date;
		$feed['site_url']   = happy_linux_sanitize_url($site_url);
		$feed['url']        = happy_linux_sanitize_url($url);
		$feed['site_title'] = happy_linux_sanitize_text( $site_title );
		$feed['title']      = happy_linux_sanitize_text( $title );
		$feed['summary']    = happy_linux_sanitize_text( $summary );

		$block['feeds'][] = $feed;
	}

	return $block;
}

function b_weblinks_atom_edit($options) 
{
	$DIRNAME = empty( $options[0] ) ? basename( dirname( dirname( __FILE__ ) ) ) : $options[0];

	$form  = "Module Directory: &nbsp;";
	$form .= "$DIRNAME &nbsp;";
	$form .= "<input type='hidden' name='options[0]' value='".$DIRNAME."' />&nbsp; <br />";

	$form .= ""._MB_WEBLINKS_NUM_FEED."&nbsp;";
	$form .= "<input type='text' name='options[1]' value='".$options[1]."' />&nbsp;"._MB_WEBLINKS_LINKS."<br />";

	$form .= ""._MB_WEBLINKS_NUM_TITLE."&nbsp;";
	$form .= "<input type='text' name='options[2]' value='".$options[2]."' />&nbsp;"._MB_WEBLINKS_LENGTH."<br />";

	$form .= ""._MB_WEBLINKS_NUM_SUMMARY."&nbsp;";
	$form .= "<input type='text' name='options[3]' value='".$options[3]."' />&nbsp;"._MB_WEBLINKS_LENGTH."";

	return $form;
}


//---------------------------------------------------------
// $options
// [0] module directory name (weblinks)
// [1] link id (0)
// [2] the display number of atomfeed (10)
// [3] the display number of content  (1)
// [4] max of summary  (200)
//---------------------------------------------------------

function b_weblinks_blog_show($options) 
{
	global $xoopsDB;

	$DIRNAME = empty( $options[0] ) ? basename( dirname( dirname( __FILE__ ) ) ) : $options[0];
	$lid         = intval( $options[1] );
	$limit       = intval( $options[2] );
	$num_content = intval( $options[3] );
	$max_summary = intval( $options[4] ) - 1 ;

	$table_config = $xoopsDB->prefix( $DIRNAME."_config2" );
	$table_link   = $xoopsDB->prefix( $DIRNAME."_link" );

// config
	$sql = 'SELECT * FROM '.$table_config.' ORDER BY conf_id ASC';

	$res = $xoopsDB->query($sql, 0, 0);
	if ( !$res )
	{
		return false;
	}

	while ($row = $xoopsDB->fetchArray($res)) 
	{
		$conf[ $row['conf_name'] ] = $row['conf_value'];
	}

	$rss_dirname = $conf['rss_dirname'];
	$rss_use     = $conf['rss_use'];

	$block = array();

// check exist rssc module
	$module_handler =& xoops_gethandler('module');
	$module =& $module_handler->getByDirname( $rss_dirname );
	if ( !is_object($module) )
	{
		$block['feed_show']  = 0;
		$block['lang_error'] = 'rssc not installed';
		return $block;
	}

	if ( !$rss_use )
	{
		$block['feed_show']  = 0;
		$block['lang_error'] = _MB_WEBLINKS_NO_ATOMFEED;
		return $block;
	}

	$table_rssc_feed = $xoopsDB->prefix( $rss_dirname."_feed" );

// no link id
	if ($lid == 0)
	{
		$block['feed_show']  = 0;
		$block['lang_error'] = _MB_WEBLINKS_NO_LINK_ID;
		return $block;
	}

	$sql1 = "SELECT * FROM ".$table_link." WHERE lid=".$lid;
	$res1 = $xoopsDB->query($sql1);
	if (!$res1)
	{
		$block['feed_show']  = 0;
		$block['lang_error'] = _MB_WEBLINKS_NO_ATOMFEED;
		return $block;
	}

	$row1 = $xoopsDB->fetchArray($res1);
	$rssc_lid = $row1['rssc_lid'];
	if ($rssc_lid == 0)
	{
		$block['feed_show']  = 0;
		$block['lang_error'] = _MB_WEBLINKS_NO_ATOMFEED;
		return $block;
	}

	$DAY    = 3;
	$future = time() + $DAY*24*3600;
	$order  = 'updated_unix DESC, fid DESC';

	$sql2  = 'SELECT * FROM '.$table_rssc_feed;
	$sql2 .= ' WHERE updated_unix <'.$future;
	$sql2 .= ' AND published_unix <'.$future;
	$sql2 .= ' AND lid ='.$rssc_lid;
	$sql2 .= ' ORDER BY '.$order;

	$res2 = $xoopsDB->query($sql2, $limit, 0);
	$num  = $xoopsDB->getRowsNum($res2);

// no atomfeed
	if ( $num == 0 )
	{
		$block['feed_show']  = 0;
		$block['lang_error'] = _MB_WEBLINKS_NO_ATOMFEED;
		return $block;
	}

	$i = 0;
	while( $row = $xoopsDB->fetchArray($res2) )
	{
		$site_title    = $row['site_title'];
		$site_url      = $row['site_link'];
		$title         = $row['title'];
		$url           = $row['link'];
		$content       = $row['content'];
		$time_modified = $row['updated_unix'];

		$feed = array();

// title
		if ( empty($title) )
		{
			$title = "---";
		}

// summary
		$summary = happy_linux_mb_build_summary( $content, $max_summary );

// date
		$date = '';

		if ( $time_modified ) 
		{
			$date = formatTimestamp($time_modified, "m");
		}

		$feed['content'] = $content;
		$feed['date']    = $date;
		$feed['url']     = happy_linux_sanitize_url($url);
		$feed['title']   = happy_linux_sanitize_text( $title );
		$feed['summary'] = happy_linux_sanitize_text( $summary );

		$i ++;
		$block['feeds'][] = $feed;
	}

	if ( empty($site_title) )
	{
		$site_title = "---";
	}

	$block['feed_show']   = 1;
	$block['num_content'] = $num_content;
	$block['site_url']    = happy_linux_sanitize_url($site_url);
	$block['site_title']  = happy_linux_sanitize_text( $site_title );

	return $block;
}

function b_weblinks_blog_edit($options) 
{
	$DIRNAME = empty( $options[0] ) ? basename( dirname( dirname( __FILE__ ) ) ) : $options[0];

	$form  = "Module Directory: &nbsp;";
	$form .= "$DIRNAME &nbsp;";
	$form .= "<input type='hidden' name='options[0]' value='".$DIRNAME."' />&nbsp; <br />";

	$form .= ""._MB_WEBLINKS_LINK_ID."&nbsp;";
	$form .= "<input type='text' name='options[1]' value='".$options[1]."' />&nbsp; <br />";

	$form .= ""._MB_WEBLINKS_NUM_FEED."&nbsp;";
	$form .= "<input type='text' name='options[2]' value='".$options[2]."' />&nbsp;"._MB_WEBLINKS_LINKS."<br />";

	$form .= ""._MB_WEBLINKS_NUM_CONTENT."&nbsp;";
	$form .= "<input type='text' name='options[3]' value='".$options[3]."' />&nbsp;"._MB_WEBLINKS_LINKS."<br />";

	$form .= ""._MB_WEBLINKS_NUM_SUMMARY."&nbsp;";
	$form .= "<input type='text' name='options[4]' value='".$options[4]."' />&nbsp;"._MB_WEBLINKS_LENGTH."";

	return $form;
}

// --- block function begin end ---
}

?>