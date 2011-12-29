<?php
// $Id: newbbex_162.php,v 1.1 2011/12/29 14:32:59 ohwada Exp $

//=========================================================
// WebLinks Module
// for NewBBex 1.62 <http://xoops.instant-zero.com/>
// 2008-09-08 Eparcyl92
//=========================================================
if( !function_exists( 'weblinks_plugin_forums_newbbex_162' ) ) 
{
function &weblinks_plugin_forums_newbbex_162()
{
	global $xoopsDB;
	$DEBUG = false;
	if( defined('WEBLINKS_DEBUG_ERROR') ) 
	{	$DEBUG = WEBLINKS_DEBUG_ERROR;	}
	$false = false;
	$arr   = array();
	$sql = "SELECT * FROM " . $xoopsDB->prefix("bbex_forums") . " ORDER BY forum_id";
	$res = $xoopsDB->query( $sql );
	if ( !$res )
	{
		if ( $DEBUG )
		{	echo $xoopsDB->error();	}
		return $false;
	}
	while ( $row = $xoopsDB->fetchArray($res) )
	{
		$arr[ $row['forum_id'] ] = $row['forum_name'];
	}
	return $arr;
}
function &weblinks_plugin_threads_newbbex_162( $opts )
{
	global $xoopsDB;
	$myts =& MyTextSanitizer::getInstance();
	$DEBUG = false;
	if( defined('WEBLINKS_DEBUG_ERROR') ) 
	{	$DEBUG = WEBLINKS_DEBUG_ERROR;	}
	$URL_MOD = XOOPS_URL."/modules/newbbex";
	$false   = false;
	$arr     = array();
	$forum_id_in  = isset( $opts['forum_id'] )     ? intval( $opts['forum_id'] )     : 0;
	$thread_limit = isset( $opts['thread_limit'] ) ? intval( $opts['thread_limit'] ) : 1;
	$thread_start = isset( $opts['thread_start'] ) ? intval( $opts['thread_start'] ) : 0;
	$post_limit   = isset( $opts['post_limit'] )   ? intval( $opts['post_limit'] )   : 1;
	$post_start   = isset( $opts['post_start'] )   ? intval( $opts['post_start'] )   : 0;
	$post_order   = isset( $opts['post_order'] )   ? $opts['post_order']             : 'DESC';
	if ($forum_id_in == 0)
	{	return $false;	}
	$sql1  = "SELECT * FROM " . $xoopsDB->prefix("bbex_forums");
	$res1  = $xoopsDB->query( $sql1 );
	if ( !$res1 )
	{
		if ( $DEBUG )
		{	echo $xoopsDB->error();	}
		return $false;
	}
	$forum_title = array();
	while ($row1 = $xoopsDB->fetchArray($res1)) 
	{
		$forum_title[ $row1['forum_id'] ] = $row1['forum_name'];
	}
	$arr['forum_id']    = 0;
	$arr['forum_title'] = '';
	$arr['forum_link']  = '';
	if ($forum_id_in != WEBLINKS_PLUGIN_ALL)
	{
		$arr['forum_id']    = $forum_id_in;
		$arr['forum_title'] = $forum_title[ $forum_id_in ];
		$arr['forum_link']  = $URL_MOD.'/viewforum.php?forum='.$forum_id_in;
	}
	$sql2  = "SELECT * FROM " . $xoopsDB->prefix("bbex_topics");
	if ($forum_id_in != WEBLINKS_PLUGIN_ALL)
	{
		$sql2 .= " WHERE forum_id=".intval($forum_id_in);
	}
	$sql2 .= " ORDER BY topic_time ".$post_order;
	$res2  = $xoopsDB->query( $sql2, $thread_limit, $thread_start );
	if ( !$res2 )
	{
		if ( $DEBUG )
		{	echo $xoopsDB->error();	}
		return $false;
	}
	while ( $row2 = $xoopsDB->fetchArray($res2) )
	{
		$thread_arr = array();
		$forum_id   = $row2['forum_id'];
		$topic_id   = $row2['topic_id'];
		$topic_link = $URL_MOD.'/viewtopic.php?forum='.$forum_id.'&amp;topic_id='.$topic_id;
		$thread_arr['forum_id']     = $forum_id;
		$thread_arr['forum_title']  = $forum_title[ $forum_id ];
		$thread_arr['forum_link']   = $URL_MOD.'/viewforum.php?forum='.$forum_id;
		$thread_arr['thread_id']     = $topic_id;
		$thread_arr['thread_link']   = $topic_link;
		$thread_arr['thread_title']  = $row2['topic_title'];
		$thread_arr['thread_time']   = $row2['topic_time'];
		$thread_arr['thread_time_s'] = formatTimestamp($row2['topic_time'], "s");
		$sql3  = "SELECT * FROM " . $xoopsDB->prefix("bbex_posts") . " p, ";
		$sql3 .= $xoopsDB->prefix('bbex_posts_text')." pt ";
		$sql3 .= " WHERE p.forum_id=".intval($forum_id);
		$sql3 .= " AND p.topic_id=".intval($topic_id);
		$sql3 .= " AND p.post_id=pt.post_id ";
		$sql3 .= " ORDER BY p.post_time DESC";
		$res3  = $xoopsDB->query( $sql3, $post_limit, $post_start );
		if ( !$res3 && $DEBUG )
		{	echo $xoopsDB->error();	}
		while ( $row3 = $xoopsDB->fetchArray($res3) )
		{
			$post_arr = array();
			$post_id  = $row3['post_id'];
			$post_arr['post_id']     = $post_id;
			$post_arr['post_link']   = $topic_link.'&amp;post_id='.$post_id."#forumpost".$post_id;
			$post_arr['post_title']  = $row3['subject'];
			$post_arr['post_time']   = $row3['post_time'];
			$post_arr['post_time_s'] = formatTimestamp($row3['post_time'], "s");
			$html   = 1;
			$smiley = 1;
			$xcode  = 1;
			$br     = 1;
			$image  = 1;
			if ( $row3['nohtml'] )   $html   = 0;
			if ( $row3['nosmiley'] ) $smiley = 0;

			$post_arr['post_text'] = 
				$myts->makeTareaData4Show($row3['post_text'], $html, $smiley, $xcode, $image, $br);
			$thread_arr['posts'][ $post_id ] = $post_arr;
		}
		$arr['threads'][$topic_id] = $thread_arr;
	}
	return $arr;
}
}
?>