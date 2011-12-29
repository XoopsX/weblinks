<?php
// $Id: test_form_admin_add_category.php,v 1.1 2011/12/29 14:32:57 ohwada Exp $

// 2007-02-20 K.OHWADA
// performance mode

//=========================================================
// WebLinks Module
// 2006-09-20 K.OHWADA
//=========================================================

include_once 'dev_header.php';
include_once 'test_form_class.php';

$test =& weblinks_test_form::getInstance();

dev_header();
echo "<h3>test form: admin add category</h3>\n";
echo "admin: ".$test->get_admin_uname()."<br />\n";

$list_url     = WEBLINKS_URL.'/admin/category_list.php?sortid=1';

$ret = $test->login_admin();
if ( !$ret )
{
	dev_footer();
}

//---------------------------------------------------------
// scenario 1: performance off
//---------------------------------------------------------
echo "<h4>scenario 1: performance off</h4>\n";

$mode  = 0;
$title = "main_". $test->get_randum_title();

$ret = $test->admin_add_cat_add_cat($title, $mode);
if ( !$ret )
{
	dev_footer();
}

if ( $test->match_return_msg( 'add record' ) )
{
	echo "<h4>Success !</h4>\n";
	echo "add category: ".$title." <br /><br />\n";
}
else
{
	echo "Error: add_category form failed: <br /><hr />\n";
	echo $test->get_body() ."<br />\n";
}

//---------------------------------------------------------
// scenario 2: performance on
//---------------------------------------------------------
echo "<h4>scenario 2: performance on</h4>\n";

$mode  = 1;
$title = "main_". $test->get_randum_title();

$ret = $test->admin_add_cat_add_cat($title, $mode);
if ( !$ret )
{
	dev_footer();
}

$ret = $test->admin_add_cat_update_path();
if ( !$ret )
{
	dev_footer();
}

if ( $test->match_return_msg( 'update path' ) )
{
	echo "<h4>Success !</h4>\n";
	echo "add category: ".$title." <br /><br />\n";
}
else
{
	echo "Error: add_category form failed: <br /><hr />\n";
	echo $test->get_body() ."<br />\n";
}

echo '<a href="'.$list_url.'" target="_blank" >goto cateogry list</a>'."<br />\n";
dev_footer();
// --- end of main ---

?>