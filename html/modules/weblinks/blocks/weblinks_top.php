<?php
// $Id: weblinks_top.php,v 1.2 2012/04/09 10:20:04 ohwada Exp $

// 2012-04-02 K.OHWADA
// weblinks_block

// 2010-01-24 K.OHWADA
// name mail

// 2008-02-17 K.OHWADA
// google map type control

// 2007-12-16 K.OHWADA
// not show TOP in build_selbox

// 2007-10-10 K.OHWADA
// block.inc.php
// gm_marker_width

// 2007-09-10 K.OHWADA
// weblinks_get_config()

// 2007-08-11 K.OHWADA
// BUG 4680: dont work radio button

// 2007-08-01 K.OHWADA
// google map in b_weblinks_generic_show()
// happy_linux_sanitize_url()
// time_create

// 2007-06-01 K.OHWADA
// Notice [PHP]: Undefined offset: 8

// 2007-04-08 K.OHWADA
// latest & recommend link

// 2007-03-25 wye & K.OHWADA
// google map

// 2007-03-17 K.OHWADA
// BUG 4508: Fatal error: Call to undefined function: weblinks_get_handler() in blocks/weblinks_top.php

// 2006-11-03 hiro <http://ishinomaki.cc/>
// add b_weblinks_generic_show()

// 2006-05-15 K.OHWADA
// change $moduel_url to $dirname

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication

//=========================================================
// WebLinks Module
// 2004/01/14 K.OHWADA
//=========================================================

$WEBLINKS_DIRNAME = basename( dirname( dirname( __FILE__ ) ) );

include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/sanitize.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/multibyte.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/strings.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/basic_object.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/include/weblinks_constant.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/include/functions.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/class/weblinks_block_view.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/class/weblinks_block.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/class/weblinks_block_webmap.php';

// --- block function begin ---
if( !function_exists( 'b_weblinks_top_show' ) ) 
{
function b_weblinks_top_show($options) 
{
	$DIRNAME = empty( $options[0] ) ? basename( dirname( dirname( __FILE__ ) ) ) : $options[0];
	$class =& weblinks_block::getSingleton( $DIRNAME );
	return $class->top_show($options);
}

function b_weblinks_top_edit($options) 
{
	$DIRNAME = empty( $options[0] ) ? basename( dirname( dirname( __FILE__ ) ) ) : $options[0];
	$class =& weblinks_block::getSingleton( $DIRNAME );
	return $class->top_edit($options);
}

function b_weblinks_generic_show($options)
{
	$DIRNAME = empty( $options[0] ) ? basename( dirname( dirname( __FILE__ ) ) ) : $options[0];

	include_once XOOPS_ROOT_PATH.'/class/xoopstree.php';

	$class =& weblinks_block::getSingleton( $DIRNAME );
	return $class->generic_show($options);
}

function b_weblinks_generic_edit($options)
{
	$DIRNAME = empty( $options[0] ) ? basename( dirname( dirname( __FILE__ ) ) ) : $options[0];

	$WEBLINKS_ROOT_PATH = XOOPS_ROOT_PATH.'/modules/'.$DIRNAME;

	include_once XOOPS_ROOT_PATH.'/class/xoopstree.php';
	include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/functions.php';
	include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/error.php';
	include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/strings.php';
	include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/system.php';
	include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/basic_handler.php';
	include_once $WEBLINKS_ROOT_PATH.'/include/weblinks_constant.php';
	include_once $WEBLINKS_ROOT_PATH.'/include/functions.php';
	include_once $WEBLINKS_ROOT_PATH.'/class/weblinks_config2_basic_handler.php';
	include_once $WEBLINKS_ROOT_PATH.'/class/weblinks_category_basic_handler.php';

	$class =& weblinks_block::getSingleton( $DIRNAME );
	return $class->generic_edit($options);
}

// --- block function begin end ---
}

?>