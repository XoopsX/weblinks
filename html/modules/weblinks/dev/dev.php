<?php
// $Id: dev.php,v 1.1 2011/12/29 14:33:00 ohwada Exp $

//================================================================
// WebLinks Module
// 2006-12-10 K.OHWADA
//================================================================

include_once 'dev_header.php';

dev_header();

echo "<h3>Development</h3>\n";
echo '<h4 style="color: #0000ff;">Warnig</h4>'."\n";
echo "The following programs overwrite MySQL tables. <br />\n";
echo "Use only in Development enviroment. <br /><br />\n";

echo "<h4>Test Class</h4>\n";
echo '- <a href="test_class_link_save_user.php">test class: link_save</a>'."<br /><br />\n";
echo '- <a href="test_class_modify_save_user.php">test class: modify_save</a>'."<br /><br />\n";

dev_footer();

?>