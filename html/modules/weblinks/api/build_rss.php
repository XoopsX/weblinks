<?php
// $Id: build_rss.php,v 1.1 2011/12/29 14:32:40 ohwada Exp $

// 2008-02-17 K.OHWADA
// weblinks_link_view_basic.php

//=========================================================
// WebLinks Module
// 2007-10-10 K.OHWADA
//=========================================================

//---------------------------------------------------------
// happy_linux
//---------------------------------------------------------
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/api/rss_builder.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/plugin.php';

//---------------------------------------------------------
// whatsnew
//---------------------------------------------------------
if( !isset($WEBLINKS_DIRNAME) )
{
	$WEBLINKS_DIRNAME = basename( dirname( dirname( __FILE__ ) ) );
}

include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/class/weblinks_link_view_basic.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/class/weblinks_link_view.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/class/weblinks_build_rss_handler.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/class/weblinks_htmlout.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$WEBLINKS_DIRNAME.'/htmlout/weblinks_htmlout_base.php';

?>