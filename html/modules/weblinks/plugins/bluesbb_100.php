<?php
// $Id: bluesbb_100.php,v 1.1 2011/12/29 14:32:59 ohwada Exp $

// 2007-11-26 K.OHWADA
// BUG : not show when all forum

// 2007-08-01 K.OHWADA
// module duplication

// 2007-05-06 K.OHWADA
// BUG 4563: forum_id is array in singlelink
// use option parameter

//=========================================================
// WebLinks Module
// for BluesBB 1.00 <http://www.bluish.jp/>
// 2007-02-20 K.OHWADA
//=========================================================

// --- functions begin ---
if( !function_exists( 'weblinks_plugin_forums_bluesbb_100' ) ) 
{

function &weblinks_plugin_forums_bluesbb_100()
{
	global $xoopsDB;

	$DEBUG = false;
	if( defined('WEBLINKS_DEBUG_ERROR') ) 
	{	$DEBUG = WEBLINKS_DEBUG_ERROR;	}

	$false = false;
	$arr   = array();

	$sql = "SELECT * FROM " . $xoopsDB->prefix("bluesbb_topic") . " ORDER BY topic_id";

	$res = $xoopsDB->query( $sql );
	if ( !$res )
	{
		if ( $DEBUG )
		{	echo $xoopsDB->error();	}
		return $false;
	}

	while ( $row = $xoopsDB->fetchArray($res) )
	{
		$arr[ $row['topic_id'] ] = $row['topic_name'];
	}

	return $arr;
}

function &weblinks_plugin_threads_bluesbb_100( $opts )
{
	global $xoopsDB;
	(method_exists('MyTextSanitizer', 'sGetInstance') and $myts =& MyTextSanitizer::sGetInstance()) || $myts =& MyTextSanitizer::getInstance();

	$DEBUG = false;
	if( defined('WEBLINKS_DEBUG_ERROR') ) 
	{	$DEBUG = WEBLINKS_DEBUG_ERROR;	}

	$URL_MOD = XOOPS_URL."/modules/bluesbb";
	$false   = false;
	$arr     = array();

// option parameter
	$forum_id_in  = isset( $opts['forum_id'] )     ? intval( $opts['forum_id'] )     : 0;
	$thread_limit = isset( $opts['thread_limit'] ) ? intval( $opts['thread_limit'] ) : 1;
	$thread_start = isset( $opts['thread_start'] ) ? intval( $opts['thread_start'] ) : 0;
	$post_limit   = isset( $opts['post_limit'] )   ? intval( $opts['post_limit'] )   : 1;
	$post_start   = isset( $opts['post_start'] )   ? intval( $opts['post_start'] )   : 0;
	$post_order   = isset( $opts['post_order'] )   ? $opts['post_order']             : 'DESC';

	if ($forum_id_in == 0)
	{	return $false;	}

// forum name
	$sql1  = "SELECT * FROM " . $xoopsDB->prefix("bluesbb_topic");

// BUG : not show when all forum
	if ($forum_id_in != WEBLINKS_PLUGIN_ALL) 
	{
		$sql1 .= " WHERE topic_id=".intval($forum_id_in);
	}

	$res1 = $xoopsDB->query( $sql1 );
	if ( !$res1 )
	{
		if ( $DEBUG )
		{	echo $xoopsDB->error();	}
		return $false;
	}

	$forum_title_arr = array();
	$topic_style_arr = array();
	while ($row1 = $xoopsDB->fetchArray($res1)) 
	{
		$forum_title_arr[ $row1['topic_id'] ] = $row1['topic_name'];
		$topic_style_arr[ $row1['topic_id'] ] = $row1['topic_style'];
	}

// specify forum
	$arr['forum_id']    = 0;
	$arr['forum_title'] = '';
	$arr['forum_link']  = '';
	if ($forum_id_in != WEBLINKS_PLUGIN_ALL)
	{
		$arr['forum_id']    = $forum_id_in;
		$arr['forum_title'] = $forum_title_arr[ $forum_id_in ];
		$arr['forum_link']  = $URL_MOD.'/topic.php?top='.$forum_id_in;
	}

// latest topics
	$sql2  = "SELECT * FROM " . $xoopsDB->prefix("bluesbb");
	$sql2 .= " WHERE res_id = 0 ";
	if ($forum_id_in != WEBLINKS_PLUGIN_ALL)
	{
		$sql2 .= " AND topic_id=".intval($forum_id_in);
	}
	$sql2 .= " ORDER BY post_time ".$post_order;

	$res2  = $xoopsDB->query( $sql2, $thread_limit, $thread_start );
	if ( !$res2 )
	{
		if ( $DEBUG )
		{	echo $xoopsDB->error();	}
		return $false;
	}

	while ( $row2 = $xoopsDB->fetchArray($res2) )
	{
		$thread_arr  = array();
		$topic_id    = $row2['topic_id'];
		$thread_id   = $row2['thread_id'];

		$topic_style = $topic_style_arr[ $topic_id ];
		$thread_link = $URL_MOD.'/thread.php?thr='.$thread_id."&amp;sty=".$topic_style;

		$thread_arr['forum_id']     = $topic_id;
		$thread_arr['forum_title']  = $forum_title_arr[ $topic_id ];
		$thread_arr['forum_link']   = $URL_MOD.'/topic.php?top='.$topic_id;

		$thread_arr['thread_id']     = $thread_id;
		$thread_arr['thread_link']   = $thread_link;
		$thread_arr['thread_title']  = $row2['title'];
		$thread_arr['thread_time']   = $row2['res_time'];
		$thread_arr['thread_time_s'] = formatTimestamp($row2['res_time'], "s");

// latest posts
		$sql3  = "SELECT * FROM " . $xoopsDB->prefix("bluesbb");
		$sql3 .= " WHERE thread_id=".intval($thread_id);
		$sql3 .= " AND topic_id=".intval($topic_id);
		$sql3 .= " ORDER BY post_time DESC";

		$res3  = $xoopsDB->query( $sql3, $post_limit, $post_start );
		if ( !$res3 && $DEBUG )
		{	echo $xoopsDB->error();	}

		while ( $row3 = $xoopsDB->fetchArray($res3) )
		{
			$post_arr = array();
			$post_id  = $row3['post_id'];
			$res_id   = $row3['res_id'];

			$lt = '';
			switch($topic_style) 
			{
				case "1":
					$lt = 'l50#p'.$post_id;
					break;

				case "2":
					$lt = ++$res_id;
					break;

				case "3":
					$lt = $post_id;
					break;
			}

			$post_arr['post_id']     = $post_id;
			$post_arr['post_link']   = $thread_link.'&amp;num='.$lt;
			$post_arr['post_title']  = $row3['title'];
			$post_arr['post_time']   = $row3['post_time'];
			$post_arr['post_time_s'] = formatTimestamp($row3['post_time'], "s");

// text
			$post_arr['post_text'] = 
				$myts->makeTareaData4Show($row3['message'], 0);

			$thread_arr['posts'][ $post_id ] = $post_arr;
		}

		$arr['threads'][$thread_id] = $thread_arr;
	}

	return $arr;
}

}
// --- functions end ---

?>