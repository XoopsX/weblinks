<?php
// $Id: export_manage.php,v 1.1 2011/12/29 14:32:51 ohwada Exp $

// 2007-11-01 K.OHWADA
// weblinks_admin_print_footer()

// 2007-02-20 K.OHWADA
// v1.80

// 2007-02-20 K.OHWADA
// hack for multi site

// 2006-09-20 K.OHWADA
// this is new file

//================================================================
// WebLinks Module
// 2006-09-20 K.OHWADA
//================================================================

include 'admin_header.php';

// hack for multi site
weblinks_admin_multi_disable_feature();

xoops_cp_header();

weblinks_admin_print_header();
weblinks_admin_print_menu();

echo "<h3>"._AM_WEBLINKS_EXPORT_MANAGE."</h3>\n";
echo '<a href="weblinks180_to_rssc070.php">Export DB weblinks v1.8 into rssc v0.7</a>'."<br />\n";

weblinks_admin_print_footer();
xoops_cp_footer();
exit();
?>