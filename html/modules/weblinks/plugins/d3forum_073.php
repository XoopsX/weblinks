<?php
// $Id: d3forum_073.php,v 1.1 2011/12/29 14:32:59 ohwada Exp $

// 2007-11-26 K.OHWADA
// Fatal error: Call to a member function getVar() on a non-object
// BUG : not show when all forum

// 2007-08-01 K.OHWADA
// module duplication

//=========================================================
// WebLinks Module
// for d3forum 0.73 <http://xoops.peak.ne.jp/>
// 2007-06-10 K.OHWADA
//=========================================================

// --- functions begin ---
if( !function_exists( 'weblinks_plugin_forums_d3forum_073' ) ) 
{

function &weblinks_plugin_forums_d3forum_073( $opts )
{
	global $xoopsDB;

	$DEBUG = false;
	if( defined('WEBLINKS_DEBUG_ERROR') ) 
	{	$DEBUG = WEBLINKS_DEBUG_ERROR;	}

// option parameter
	$DIRNAME = isset( $opts['dirname'] ) ? $opts['dirname'] : 'd3forum';

	$false = false;
	$arr   = array();

	$table_forums = $xoopsDB->prefix( $DIRNAME.'_forums' );
	$sql = "SELECT * FROM " . $table_forums . " ORDER BY forum_id";

	$res = $xoopsDB->query( $sql );
	if ( !$res )
	{
		if ( $DEBUG )
		{	echo $xoopsDB->error();	}
		return $false;
	}

	while ( $row = $xoopsDB->fetchArray($res) )
	{
		$arr[ $row['forum_id'] ] = $row['forum_title'];
	}

	return $arr;
}

function &weblinks_plugin_threads_d3forum_073( $opts )
{
	global $xoopsDB;
	(method_exists('MyTextSanitizer', 'sGetInstance') and $myts =& MyTextSanitizer::sGetInstance()) || $myts =& MyTextSanitizer::getInstance();

	$DEBUG = false;
	if( defined('WEBLINKS_DEBUG_ERROR') ) 
	{	$DEBUG = WEBLINKS_DEBUG_ERROR;	}

	$false = false;
	$arr   = array();

// option parameter
	$DIRNAME      = isset( $opts['dirname'] )      ? $opts['dirname']                : 'd3forum';
	$forum_id_in  = isset( $opts['forum_id'] )     ? intval( $opts['forum_id'] )     : 0;
	$thread_limit = isset( $opts['thread_limit'] ) ? intval( $opts['thread_limit'] ) : 1;
	$thread_start = isset( $opts['thread_start'] ) ? intval( $opts['thread_start'] ) : 0;
	$post_limit   = isset( $opts['post_limit'] )   ? intval( $opts['post_limit'] )   : 1;
	$post_start   = isset( $opts['post_start'] )   ? intval( $opts['post_start'] )   : 0;
	$post_order   = isset( $opts['post_order'] )   ? $opts['post_order']             : 'DESC';

	if ($forum_id_in == 0)
	{	return $false;	}

	$URL_MOD = XOOPS_URL .'/modules/'. $DIRNAME;

	$module_handler =& xoops_gethandler('module');
	$config_handler =& xoops_gethandler('config');
	$module =& $module_handler->getByDirname( $DIRNAME );

// Fatal error: Call to a member function getVar() on a non-object
	if ( !is_object($module) )
	{	return $false;	}

	$config =& $config_handler->getConfigsByCat(0, $module->getVar('mid'));

	$table_forums = $xoopsDB->prefix( $DIRNAME.'_forums' );
	$table_topics = $xoopsDB->prefix( $DIRNAME.'_topics' );
	$table_posts  = $xoopsDB->prefix( $DIRNAME.'_posts' );

	$pattern     = "/\[quote sitecite=([^\"'<>]*)\]/sU";
	$replacement = '[quote]';

// forum name
	$sql1  = "SELECT * FROM " . $table_forums;

// BUG : not show when all forum
	if ($forum_id_in != WEBLINKS_PLUGIN_ALL) 
	{
		$sql1 .= " WHERE forum_id=".intval($forum_id_in);
	}

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
		$forum_title[ $row1['forum_id'] ] = $row1['forum_title'];
	}

// specify forum
	$arr['forum_id']    = 0;
	$arr['forum_title'] = '';
	$arr['forum_link']  = '';
	if ($forum_id_in != WEBLINKS_PLUGIN_ALL)
	{
		$arr['forum_id']    = $forum_id_in;
		$arr['forum_title'] = $forum_title[ $forum_id_in ];
		$arr['forum_link']  = $URL_MOD.'/index.php?forum_id='.$forum_id_in;
	}

// latest topics
	$sql2  = "SELECT * FROM " . $table_topics;
	if ($forum_id_in != WEBLINKS_PLUGIN_ALL) 
	{
		$sql2 .= " WHERE forum_id=".intval($forum_id_in);
	}
	$sql2 .= " ORDER BY topic_last_post_time ".$post_order;

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
		$topic_link = $URL_MOD.'/index.php?topic_id='.$topic_id;

		$thread_arr['forum_id']     = $forum_id;
		$thread_arr['forum_title']  = $forum_title[ $forum_id ];
		$thread_arr['forum_link']   = $URL_MOD.'/index.php?forum_id='.$forum_id;

		$thread_arr['thread_id']     = $topic_id;
		$thread_arr['thread_link']   = $topic_link;
		$thread_arr['thread_title']  = $row2['topic_title'];
		$thread_arr['thread_time']   = $row2['topic_last_post_time'];
		$thread_arr['thread_time_s'] = formatTimestamp($row2['topic_last_post_time'], "s");

// latest posts
		$sql3  = "SELECT * FROM " . $table_posts;
		$sql3 .= " WHERE topic_id=".intval($topic_id);
		$sql3 .= " ORDER BY post_time DESC";

		$res3  = $xoopsDB->query( $sql3, $post_limit, $post_start );
		if ( !$res3 && $DEBUG )
		{	echo $xoopsDB->error();	}

		while ( $row3 = $xoopsDB->fetchArray($res3) )
		{
			$post_arr = array();
			$post_id  = $row3['post_id'];
			$post_arr['post_id']     = $post_id;
			$post_arr['post_link']   = $topic_link.'#post_id'.$post_id;
			$post_arr['post_title']  = $row3['subject'];
			$post_arr['post_time']   = $row3['post_time'];
			$post_arr['post_time_s'] = formatTimestamp($row3['post_time'], "s");

// text
			$html   = 0;
			$smiley = 0;
			$xcodes = 0;
			$image  = 0;
			$br     = 0;

			if ( $row3['html'] )   $html   = 1;
			if ( $row3['smiley'] ) $smiley = 1;
			if ( $row3['xcode'] )  $xcode  = 1;
			if ( $row3['br'] )     $br     = 1;
			if ( $config['allow_textimg'] )  $image  = 1;

			$desc = preg_replace($pattern, $replacement, $row3['post_text']);
			$post_arr['post_text'] = 
				$myts->makeTareaData4Show($desc, $html, $smiley, $xcode, $image, $br);

			$thread_arr['posts'][ $post_id ] = $post_arr;
		}

		$arr['threads'][$topic_id] = $thread_arr;
	}

	return $arr;
}

}
// --- functions end ---

?>