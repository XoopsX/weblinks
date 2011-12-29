<?php
// $Id: waiting.php,v 1.1 2011/12/29 14:32:40 ohwada Exp $

//================================================================
// WebLinks Module
// for waiting block
// 2007-09-01 K.OHWADA
//================================================================

// dir name
$WEBLINKS_DIRNAME = basename( dirname( dirname( __FILE__ ) ) );

global $xoopsConfig;
$XOOPS_LANGUAGE = $xoopsConfig['language'];

include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/include/waiting.plugin.php';

// waiting.php
if ( file_exists(XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/language/'.$XOOPS_LANGUAGE.'/waiting.php') ) 
{
	include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/language/'.$XOOPS_LANGUAGE.'/waiting.php';
}
else
{
	include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/language/english/waiting.php';
}

?>