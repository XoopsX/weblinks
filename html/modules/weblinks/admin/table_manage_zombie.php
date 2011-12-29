<?php
// $Id: table_manage_zombie.php,v 1.1 2011/12/29 14:32:56 ohwada Exp $

// 2007-11-24 K.OHWADA
// divid from table_manage.php

// 2007-11-01 K.OHWADA
// weblinks_admin_print_footer()

// 2007-10-10 K.OHWADA
// xoops block table

// 2007-02-20 K.OHWADA
// hack for multi site
// show_clean_xml()

// 2006-09-20 K.OHWADA
// use happy_linux

// 2006-05-15 K.OHWADA
// use weblinks_db_basic_base

// 2005-10-14 K.OHWADA
// corresponding to too many links

//================================================================
// WebLinks Module
// check table validation
// 2005-01-20 K.OHWADA
//================================================================

include 'admin_header.php';
include_once WEBLINKS_ROOT_PATH.'/admin/table_manage_zombie_class.php';

//================================================================
// main
//================================================================
// hack for multi site
weblinks_admin_multi_disable_feature();

$manage =& admin_table_manage_zombie::getInstance();

$op = $manage->get_post_param();

xoops_cp_header();

switch ($op) 
{
case 'check_all':
	$manage->check_all();
	break;

case 'check_link_in_catlink':
	$manage->check_link_in_catlink();
	break;

case 'check_cat_in_catlink':
	$manage->check_cat_in_catlink();
	break;

case 'check_catlink_in_link':
	$manage->check_catlink_in_link();
	break;

case 'check_catlink_in_cat':
	$manage->check_catlink_in_cat();
	break;

case "del_link_from_link":
	$manage->del_link_from_link();
	break;

case "del_link_from_catlink":
	$manage->del_link_from_catlink();
	break;

case "del_cat_from_catlink":
	$manage->del_cat_from_catlink();
	break;

case 'menu':
default:
	$manage->menu();
	break;

}

weblinks_admin_print_footer();
xoops_cp_footer();
exit();
// --- main end ---

?>