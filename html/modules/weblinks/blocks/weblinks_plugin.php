<?php
// $Id: weblinks_plugin.php,v 1.2 2012/04/10 04:42:04 ohwada Exp $

// 2012-04-02 K.OHWADA
// BUG: not show photo

// 2007-11-28 K.OHWADA
// BUG : not work cat_album_dirname

//=========================================================
// WebLinks Module
// 2007-04-08 K.OHWADA
//=========================================================

// --- block function begin ---
if( !function_exists( 'b_weblinks_photo_show' ) ) 
{

include_once XOOPS_ROOT_PATH.'/class/xoopstree.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/functions.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/system.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/strings.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/error.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/basic_handler.php';

//---------------------------------------------------------
// $options
// [0] module directory name (weblinks)
// [1] number of display photos (1)
//---------------------------------------------------------

function b_weblinks_photo_show($options) 
{
	$SEL_KIND    = 'album';
	$PLUGIN_KIND = 'photos';
	$WIDTH       = 140;	// pixel
	$MODE_SUB    = 1;	// with sub
	$CYCLE       = 60;	// sec
	$SHOW_TITLE  = true;
	$FLAG_WEBLINKS_CAT = true;

	$album_id = 0;	// all category

	global $xoopsDB;

	$DIRNAME = empty( $options[0] ) ? basename( dirname( dirname( __FILE__ ) ) ) : $options[0];
	$limit   = intval($options[1]);

	$WEBLINKS_ROOT_PATH = XOOPS_ROOT_PATH.'/modules/'.$DIRNAME;
	include_once $WEBLINKS_ROOT_PATH.'/include/weblinks_constant.php';
	include_once $WEBLINKS_ROOT_PATH.'/include/functions.php';
	include_once $WEBLINKS_ROOT_PATH.'/class/weblinks_category_basic_handler.php';
	include_once $WEBLINKS_ROOT_PATH.'/class/weblinks_plugin.php';
	include_once $WEBLINKS_ROOT_PATH.'/plugins/album_sel.php';

	$category_handler =& weblinks_get_handler( 'category_basic', $DIRNAME );
	$plugin           =& weblinks_plugin::getInstance( $DIRNAME );

// config
	$table_config = $xoopsDB->prefix( $DIRNAME."_config2" );
	$sql1 = 'SELECT * FROM '. $table_config .' ORDER BY conf_id ASC';
	$res1 = $xoopsDB->query($sql1, 0, 0);
	if ( !$res1 )
	{	return $block;	}

	while ($row1 = $xoopsDB->fetchArray($res1)) 
	{
		$conf[ $row1['conf_name'] ] = $row1['conf_value'];
	}

	$cat_album_sel     = $conf['cat_album_sel'];
	$cat_album_dirname = $conf['cat_album_dirname'];
	$cat_album_mode    = $conf['cat_album_mode'];

// return value
	$block = array();
	$block['dirname']    = $DIRNAME;
	$block['show_title'] = $SHOW_TITLE;

// category in weblinks viewcat
	$url     = xoops_getenv('REQUEST_URI');
	$viewcat = 'modules/' . $DIRNAME . '/viewcat.php';

	if ( $FLAG_WEBLINKS_CAT && strstr($url, $viewcat) )
	{
		$cid = isset($_GET['cid']) ? intval($_GET['cid']) : 0;
		$category_handler->load_once();
		$album_id = $category_handler->get_album_id($cid);

// same parent
		if (($cat_album_mode == 1)&&($album_id == 0))
		{
			$album_id = $category_handler->get_parent_album_id($cid);
		}
	}

	if ($album_id == 0)
	{	$album_id = WEBLINKS_PLUGIN_ALL;	}

	$sel =& $plugin->get_selecter_by_id( $SEL_KIND, $cat_album_sel );
	if (!$sel)
	{	return $block;	}

	$filename = $sel['name'];

	$opts = array(
		'dirname'     => $cat_album_dirname,
		'width'       => $WIDTH,
		'album_limit' => $limit,
		'album_id'    => $album_id,
		'mode_sub'    => $MODE_SUB,
		'cycle'       => $CYCLE,
	);

	$func   =  $plugin->build_plugin_func( $PLUGIN_KIND, $filename );
	$photos =& $plugin->exec_plugin( $filename, $func, $opts );

	$block['album_dirname'] = $cat_album_dirname;

// BUG: not show photo
	$block['photos']        = $photos;

	return $block;
}

function b_weblinks_photo_edit($options) 
{
	$DIRNAME = empty( $options[0] ) ? basename( dirname( dirname( __FILE__ ) ) ) : $options[0];

	$form  = "<table><tr><td>";
	$form .= "Module Directory: ";
	$form .= "</td><td>";
	$form .= $DIRNAME." ";
	$form .= '<input type="hidden" name="options[0]" value="'. $DIRNAME .'" />'."\n";
	$form .= "</td></tr>\n<tr><td>";
	$form .= _MB_WEBLINKS_PHOTOS;
	$form .= "</td><td>";
	$form .= '<input type="text" name="options[1]" value="'. intval($options[1]) .'" />'."\n";
	$form .= "</td></tr></table>\n";
	return $form;
}

// --- block function begin end ---
}

?>