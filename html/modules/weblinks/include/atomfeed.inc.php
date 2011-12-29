<?php
// $Id: atomfeed.inc.php,v 1.1 2011/12/29 14:32:34 ohwada Exp $

// 2006-09-20 K.OHWADA
// use rssc

// 2006-04-13 K.OHWADA
// BUG 3859: Parse error in atomfeed.inc.php
// change the usage of include fucntion

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication

//=========================================================
// WebLinks Module
// view ATOM feed called by custom block
// 2004-11-28 K.OHWADA
//=========================================================

//---------------------------------------------------------
// compatible for old version
// recommend to use rssc/include/view_blog.inc.php
//---------------------------------------------------------

$WEBLINKS_DIRNAME      = basename( dirname( dirname( __FILE__ ) ) );
$WEBLINKS_RSSC_DIRNAME = 'rssc';

// --- eval begin ---
eval( '

function '.$WEBLINKS_DIRNAME.'_view_blog($lid=0, $num_feed=10, $num_content=1, $max_summary=200)
{
	return weblinks_view_blog_base( "'.$WEBLINKS_DIRNAME.'" ,$lid, $num_feed, $num_content, $max_summary);
}

' );
// --- eval end ---


// --- weblinks_view_blog_base begin ---
if( !function_exists( 'weblinks_view_blog_base' ) ) 
{

// happy linux files
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/api/local.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/search.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/server.php';

// rssc files
include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_RSSC_DIRNAME.'/include/view_blog.inc.php';

// weblinks files
include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/include/weblinks_constant.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/include/weblinks_get_handler.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/class/weblinks_link.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/class/weblinks_link_handler.php';

global $xoopsConfig;
$XOOPS_LANGUAGE = $xoopsConfig['language'];


// for blocks.php
if (file_exists( XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/language/'.$XOOPS_LANGUAGE.'/blocks.php' )) 
{
	include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/language/'.$XOOPS_LANGUAGE.'/blocks.php';
}
else
{
	include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/language/english/blocks.php';
}



//include_once XOOPS_ROOT_PATH.'/class/snoopy.php';

//global $xoopsConfig;
//$XOOPS_LANGUAGE = $xoopsConfig['language'];

// file include
//include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/conf.php';	// this line is first
//include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/include/weblinks_get_handler.php';
//include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/class/weblinks_module_base.php';
//include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/class/weblinks_config_handler.php';
//include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/class/weblinks_link_base.php';
//include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/class/weblinks_link_handler.php';
//include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/class/weblinks_atomfeed_handler.php';
//include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/class/weblinks_config_handler.php';
//include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/class/weblinks_language_base.php';
//include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/class/weblinks_image_size.php';
//include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/class/weblinks_remote_file.php';
//include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/class/weblinks_rss_atom_parser_base.php';
//include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/class/weblinks_rss_parser.php';
//include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/class/weblinks_atom_parser.php';
//include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/class/weblinks_rss_atom_collect_handler.php';

// for local language
//if (file_exists( XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/language/'.$XOOPS_LANGUAGE.'/weblinks_language_convert.php' )) 
//{
//	include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/language/'.$XOOPS_LANGUAGE.'/weblinks_language_convert.php';
//}
//else
//{
//	include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/language/english/weblinks_language_convert.php';
//}

// for main.php
//if (file_exists( XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/language/'.$XOOPS_LANGUAGE.'/main.php' )) 
//{
//	include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/language/'.$XOOPS_LANGUAGE.'/main.php';
//}
//else
//{
//	include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/language/english/main.php';
//}

// for blocks.php
//if (file_exists( XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/language/'.$XOOPS_LANGUAGE.'/blocks.php' )) 
//{
//	include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/language/'.$XOOPS_LANGUAGE.'/blocks.php';
//}
//else
//{
//	include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/language/english/blocks.php';
//}

//---------------------------------------------------------
// weblinks_view_blog_base
//---------------------------------------------------------
function weblinks_view_blog_base($DIRNAME, $lid=0, $num_feed=10, $num_content=1, $max_summary=200)
{
	$WEBLINKS_RSSC_DIRNAME = 'rssc';

// check exist rssc module
	$module_handler =& xoops_gethandler('module');
	$module =& $module_handler->getByDirname( $WEBLINKS_RSSC_DIRNAME );
	if ( !is_object($module) )
	{
		echo '<span style="color: #ff0000;">'.'rssc not installed'."</span>\n";
		return;
	}

	if ($lid == 0)
	{
		echo '<span style="color: #ff0000;">'._MB_WEBLINKS_NO_LINK_ID."</span>\n";
		return;
	}

	$link_handler =& weblinks_get_handler( 'link', $DIRNAME );

	$obj =& $link_handler->get($lid);
	if ( !is_object($obj) )
	{
		echo '<span style="color: #ff0000;">'._MB_WEBLINKS_NO_ATOMFEED."</span>\n";
		return;
	}

	$rssc_lid = $obj->get('rssc_lid');
	if ( !$rssc_lid )
	{
		echo '<span style="color: #ff0000;">'._MB_WEBLINKS_NO_ATOMFEED."</span>\n";
		return;
	}

	$options = array(
		'num_feed'    => 10, 
		'num_content' => 1,
		'max_summary' => 200,
	);

	echo rssc_view_blog_base($WEBLINKS_RSSC_DIRNAME, $rssc_lid, $options);

//	$collect =& weblinks_get_handler( 'rss_atom_collect', $dirname );
//		$collect->set_num_feed(     $num_feed );
//		$collect->set_max_summary(  $max_summary );
//		$collect->set_mode_content( 1 );
//		$feeds   = $collect->parse_xml_for_block($lid);
//		$count   = count($feeds);
//		if ( $count == 0 )
//		{
//			echo "<font color='red'>"._MB_WEBLINKS_NO_ATOMFEED."</font>";
//		}
//		else
//		{
//			$site_title = $feeds[0]['site_title'];
//			$site_url   = $feeds[0]['site_url'];
//			echo "<a href='$site_url' target='_blank'>$site_title</a>\n";
//			echo "<ul>";
//			for ($i=0; $i<$count; $i++)
//			{
//				$feed = $feeds[$i];
//				echo "<li>";
//				echo "<a href='${feed['url']}' target='_blank'>${feed['title']}</a>&nbsp;";
//
//  			if ( $feed['date'] )
//  			{
//      				echo "(${feed['date']})&nbsp;";
//				}
//    			echo "<br />\n";
//				if ($i < $num_content)
//				{
//    				if ( $feed['content'] )
//					{
//  //    					echo $feed['content'];
//      	   				echo "<br />\n";
//      				}
//      			}
//      			else	
//				{
//    				if ( $feed['summary'] )
//					{
//      					echo $feed['summary'];
//      	   				echo "<br />\n";
//      				}
//				}
//				echo "<br />\n";
//				echo "</li>\n";
//			}
//		}
//	}

}

// --- weblinks_view_blog_base end ---
}

?>