<?php
// $Id: index.php,v 1.1 2011/12/29 14:32:57 ohwada Exp $

// 2007-09-20 K.OHWADA
// guest modify link

// 2007-09-01 K.OHWADA
// admin approve link

// 2007-05-18 K.OHWADA
// small change

// 2007-05-12 K.OHWADA
// small change

// 2007-03-07 K.OHWADA
// gen_link.php etc

// 2007-02-20 K.OHWADA
// test_form_guest_submit_link.php

//================================================================
// WebLinks Module
// 2006-09-20 K.OHWADA
//================================================================

include_once 'dev_header.php';

dev_header();

echo "<h3>Development</h3>\n";
echo '<h4 style="color: #0000ff;">Warnig</h4>'."\n";
echo "The following programs overwrite MySQL tables. <br />\n";
echo "Use only in Development enviroment. <br /><br />\n";

echo "<h4>Genarate Data</h4>\n";
echo '- <a href="gen_link.php">generete link in one category</a>'."<br /><br />\n";
echo '- <a href="gen_child_category.php">generete child category</a>'."<br /><br />\n";
echo '- <a href="gen_all_table.php">generete all table data</a>'."<br /><br />\n";
echo '- <a href="gen_for_export_rssc.php">generete table data for export rssc</a>'."<br /><br />\n";

echo "<h4>Test Class</h4>\n";
echo '- <a href="test_class_link_save.php">test class: link_save</a>'."<br /><br />\n";

echo "<h4>Test Form</h4>\n";
echo '- <a href="test_form_admin_add_category.php">test form: admin add category</a>'."<br /><br />\n";
echo "<br />\n";

echo '- <a href="test_form_admin_add_link.php">test form: admin add link</a>'."<br /><br />\n";
echo '- <a href="test_form_admin_mod_link.php">test form: admin modify link</a>'."<br /><br />\n";
echo '- <a href="test_form_admin_del_link.php">test form: admin delete link</a>'."<br /><br />\n";
echo "<br />\n";

echo '- <a href="test_form_user_submit_link.php">test form: user submit link</a>'."<br /><br />\n";
echo '- <a href="test_form_user_modify_link.php">test form: user modify link</a>'."<br /><br />\n";
echo '- <a href="test_form_user_delete_link.php">test form: user delete link</a>'."<br /><br />\n";
echo "<br />\n";

echo '- <a href="test_form_guest_submit_link.php">test form: guest submit link</a>'."<br /><br />\n";
echo '- <a href="test_form_guest_modify_link.php">test form: guest modify link</a>'."<br /><br />\n";
echo '- <a href="test_form_guest_delete_link.php">test form: guest delete link</a>'."<br /><br />\n";
echo "<br />\n";

echo '- <a href="test_form_admin_approve_new.php">test form: admin approve new link</a>'."<br /><br />\n";
echo '- <a href="test_form_admin_approve_mod.php">test form: admin approve modify link</a>'."<br /><br />\n";
echo '- <a href="test_form_admin_approve_del.php">test form: admin approve delete link</a>'."<br /><br />\n";
echo "<br />\n";

echo "<h4>Genarate Data for Mylinks</h4>\n";
echo '- <a href="gen_mylinks_link.php">generete mylinks link in one category</a>'."<br /><br />\n";
echo '- <a href="gen_mylinks_child_category.php">generete mylinks child category</a>'."<br /><br />\n";
echo '- <a href="gen_mylinks_randum.php">generete mylinks randum data</a>'."<br /><br />\n";

dev_footer();

?>