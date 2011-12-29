<?php
// $Id: test_class_link_save.php,v 1.1 2011/12/29 14:32:57 ohwada Exp $

// 2007-03-01 K.OHWADA
// user & admin can not change hits

//=========================================================
// WebLinks Module
// 2006-12-10 K.OHWADA
//=========================================================

include_once 'dev_header.php';
include_once 'dev_class_header.php';
include_once 'test_class_class.php';

$test =& weblinks_test_class::getInstance();

dev_header();
echo "<h3>test class: link_save</h3>\n";
echo "magic_quotes_gpc: ". get_magic_quotes_gpc() ."<br />\n";

//---------------------------------------------------------
// scenario 1: admin add object
//---------------------------------------------------------
echo "<h4>scenario 1: admin add object: no param </h4>\n";

$param = array(
	'not_gpc'       => 0,
	'flag_banner'   => 0,
	'flag_time'     => 0,
	'mode_dhtml'    => 0,
	'mode_passwd'   => 0,
);

$test->print_param($param);

$ret = $test->test_admin_add_link($param);
if (!$ret)
{
	echo "Error: failed: <br /><hr />\n";
	dev_footer();
}

//---------------------------------------------------------
echo "<h4>scenario 2: admin add object: all param </h4>\n";

$param = array(
	'not_gpc'       => 1,
	'flag_banner'   => 1,
	'flag_time'     => 1,
	'mode_dhtml'    => 1,
	'mode_passwd'   => 1,	// add pass
);

$test->print_param($param);

$ret = $test->test_admin_add_link($param);
if (!$ret)
{
	echo "Error: failed: <br /><hr />\n";
	dev_footer();
}

//---------------------------------------------------------
echo "<h4>scenario 3: admin add object: approve </h4>\n";

$param = array(
	'not_gpc'       => 0,
	'flag_banner'   => 0,
	'flag_time'     => 1,
	'mode_dhtml'    => 1,
	'mode_passwd'   => 2,	// approve pass
);

$test->print_param($param);

$ret = $test->test_admin_add_link($param);
if (!$ret)
{
	echo "Error: failed: <br /><hr />\n";
	dev_footer();
}

//---------------------------------------------------------
// scenario 4: admin mod object
//---------------------------------------------------------
echo "<h4>scenario 4: admin mod object: no param </h4>\n";

$param = array(
	'flag_banner'   => 0,
	'flag_time'     => 0,
	'mode_dhtml'    => 0,
	'mode_passwd'   => 0,
	'flag_rssc_lid' => 0,
);

$test->print_param($param);

$ret = $test->test_admin_mod_link($param);
if (!$ret)
{
	echo "Error: failed: <br /><hr />\n";
	dev_footer();
}

//---------------------------------------------------------
echo "<h4>scenario 5: admin mod object: all param </h4>\n";

$param = array(
	'flag_banner'   => 1,
	'flag_time'     => 1,
	'mode_dhtml'    => 1,
	'mode_passwd'   => 1,	// mod pass
	'flag_rssc_lid' => 1,
);

$test->print_param($param);

$ret = $test->test_admin_mod_link($param);
if (!$ret)
{
	echo "Error: failed: <br /><hr />\n";
	dev_footer();
}

//---------------------------------------------------------
echo "<h4>scenario 6: admin mod object: approve </h4>\n";

$param = array(
	'flag_banner'   => 0,
	'flag_time'     => 1,
	'mode_dhtml'    => 2,
	'mode_passwd'   => 3,	// approve pass
	'flag_rssc_lid' => 1,
);

$test->print_param($param);

$ret = $test->test_admin_mod_link($param);
if (!$ret)
{
	echo "Error: failed: <br /><hr />\n";
	dev_footer();
}

echo "<h4>Test OK !</h4>\n";

dev_footer();
// --- end of main ---

?>