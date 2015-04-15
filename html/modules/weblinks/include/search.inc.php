<?php
// $Id: search.inc.php,v 1.1 2011/12/29 14:32:34 ohwada Exp $

// 2007-09-10 K.OHWADA
// BUG: can search non public link 
// weblinks_get_config()

// 2007-07-14 K.OHWADA
// urlencode keyword

// 2007-03-01 K.OHWADA
// hack for multi site

// 2006-09-20 K.OHWADA
// show context for suin's search
// highlight_keyword

// 2006-05-15 K.OHWADA
// change $weblinks_dirname to capital letter

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication

//=========================================================
// WebLinks Module
// 2004/01/14 K.OHWADA
//=========================================================

$WEBLINKS_DIRNAME = basename( dirname( dirname( __FILE__ ) ) );

include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/search.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/include/weblinks_constant.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/include/functions.php';

// --- eval begin ---
eval( '

function '.$WEBLINKS_DIRNAME.'_search( $queryarray , $andor , $limit , $offset , $uid )
{
	return weblinks_search_base( "'.$WEBLINKS_DIRNAME.'" , $queryarray , $andor , $limit , $offset , $uid ) ;
}

' );
// --- eval end ---


// === weblinks_search_base begin ===
if( !function_exists( 'weblinks_search_base' ) ) 
{

function weblinks_search_base( $DIRNAME, $queryarray, $andor, $limit, $offset, $uid )
{
	global $xoopsDB;

	(method_exists('MyTextSanitizer', 'sGetInstance') and $myts =& MyTextSanitizer::sGetInstance()) || $myts =& MyTextSanitizer::getInstance();

// hack for multi site
	$table_link = weblinks_multi_get_table_name( $DIRNAME, 'link');

	$ret  = array();

	$conf =& weblinks_get_config( $DIRNAME );
	if ( !isset($conf['broken_threshold']) )
	{	return $ret;	}

// where
	$where = weblinks_get_where_public( $conf['broken_threshold'] );

	if ( $uid != 0 ) 
	{	$where .= ' AND ( uid = '. $uid .' ) ';	}

	$where2 = '';
	$hightlight_key = '';
	$count = count($queryarray);

	if ( is_array($queryarray) && ( $count > 0 ) )
	{
		$keywords = urlencode( implode(' ', $queryarray) );
		$hightlight_key = '&amp;keywords='.$keywords;

		$where2 .= "( search LIKE '%$queryarray[0]%' ";

		for ($i=1; $i<$count; $i++)
		{
			$where2 .= "$andor ";
			$where2 .= "search LIKE '%$queryarray[$i]%' ";
		}

		$where2 .= ") ";
	}

	if ( $where2 )
	{
		$where .= 'AND '.$where2;
	}

// link table
	$sql = "SELECT * FROM $table_link WHERE $where ORDER BY time_update DESC";

	$res = $xoopsDB->query($sql, $limit, $offset);
	if ( !$res )
	{	return $ret;	}

	$i = 0;

	while( $row = $xoopsDB->fetchArray($res) )
	{
		$ret[$i]['link']  = 'singlelink.php?lid='.$row['lid'].$hightlight_key;
		$ret[$i]['title'] = $row['title'];
		$ret[$i]['time']  = $row['time_update'];
		$ret[$i]['uid']   = $row['uid'];
		$ret[$i]['image'] = "images/home.gif";

// show context
		$context  = $row['description'];
		$dohtml   = $row['dohtml'];
		$dosmiley = $row['dosmiley'];
		$doxcode  = $row['doxcode'];
		$doimage  = $row['doimage'];
		$dobr     = $row['dobr'];

// hack for multi language
		if ( weblinks_multi_is_japanese_site() )
		{
			if ( $row['textarea1'] )
			{
				$context  = $row['textarea1'];
				$dohtml   = $row['dohtml1'];
				$dosmiley = $row['dosmiley1'];
				$doxcode  = $row['doxcode1'];
				$doimage  = $row['doimage1'];
				$dobr     = $row['dobr1'];
			}
		}

		$context = $myts->displayTarea($context, $dohtml, $dosmiley, $doxcode, $doimage, $dobr);
		$context = preg_replace("/>/", '> ', $context);
		$context = strip_tags( $context );
		$ret[$i]['context'] = happy_linux_build_search_context($context, $queryarray);

		$i++;
	}

	return $ret;
}

// === weblinks_search_base end ===
}

?>