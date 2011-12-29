<?php
// $Id: import_manage.php,v 1.1 2011/12/29 14:32:53 ohwada Exp $

// 2007-11-01 K.OHWADA
// weblinks_admin_print_footer()

// 2007-05-06 K.OHWADA
// for v1.40

// 2007-02-20 K.OHWADA
// hack for multi site

// 2006-09-20 K.OHWADA
// this is new file
// porting from other.php

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

echo "<h3>"._AM_WEBLINKS_IMPORT_MANAGE."</h3>\n";
echo '<h4 style="color:#ff0000;">Warnig</h4>'."\n";
echo "Excute only once, after install. <br />\n";
echo "The following programs overwrite MySQL tables. <br />\n";
echo "<br />\n";
echo '<a href="mylinks110_to_weblinks120.php">Import DB from mylinks v1.1 to weblinks v1.2 or later</a>'."<br />\n";

weblinks_admin_print_footer();
xoops_cp_footer();
exit();
?>