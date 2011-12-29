<?php
// $Id: test_class_modify_save_user.php,v 1.1 2011/12/29 14:33:00 ohwada Exp $

// 2007-02-20 K.OHWADA
// user can use textarea1

//=========================================================
// WebLinks Module
// 2006-12-10 K.OHWADA
//=========================================================

include_once 'dev_header.php';

$test =& weblinks_test_class_user::getInstance();

dev_header();
echo "<h3>test class: modify_save</h3>\n";
echo "magic_quotes_gpc: ". get_magic_quotes_gpc() ."<br />\n";
$test->print_user_mode();

//---------------------------------------------------------
// scenario 1: user add modify object
//---------------------------------------------------------
echo "<h4>scenario 1: user add modify object: mode 1 </h4>\n";

$param = array(
	'mode_user_perm'    => 0,
	'mode_passwd_guest' => 0,
	'mode_dhtml'        => 0,
);

$test->print_param($param);

$ret = $test->test_user_add_modify( $param );
if (!$ret)
{
	echo "Error: failed: <br /><hr />\n";
	dev_footer();
}

//---------------------------------------------------------
echo "<h4>scenario 2: user add modify object: mode 2 </h4>\n";

$param = array(
	'mode_user_perm'    => 1,
	'mode_passwd_guest' => 0,
	'mode_dhtml'        => 0,
);

$test->print_param($param);

$ret = $test->test_user_add_modify( $param );
if (!$ret)
{
	echo "Error: failed: <br /><hr />\n";
	dev_footer();
}

//---------------------------------------------------------
echo "<h4>scenario 3: user add modify object: mode 3 </h4>\n";

$param = array(
	'mode_user_perm'    => 1,
	'mode_passwd_guest' => 1,
	'mode_dhtml'        => 1,
);

$test->print_param($param);

$ret = $test->test_user_add_modify( $param );
if (!$ret)
{
	echo "Error: failed: <br /><hr />\n";
	dev_footer();
}

//---------------------------------------------------------
// scenario 4: user mod modify object
//---------------------------------------------------------
echo "<h4>scenario 4: user mod modify object: mode 1 </h4>\n";

$param = array(
	'mode_user_perm'    => 0,
	'mode_passwd_guest' => 0,
	'mode_dhtml'        => 0,
);

$test->print_param($param);

$ret = $test->test_user_mod_modify( $param );
if (!$ret)
{
	echo "Error: failed: <br /><hr />\n";
	dev_footer();
}

//---------------------------------------------------------
echo "<h4>scenario 5: user mod modify object: mode 2 </h4>\n";

$param = array(
	'mode_user_perm'    => 1,
	'mode_passwd_guest' => 0,
	'mode_dhtml'        => 0,
);

$test->print_param($param);

$ret = $test->test_user_mod_modify( $param );
if (!$ret)
{
	echo "Error: failed: <br /><hr />\n";
	dev_footer();
}

//---------------------------------------------------------
echo "<h4>scenario 6: user mod modify object: mode 3 </h4>\n";

$param = array(
	'mode_user_perm'    => 1,
	'mode_passwd_guest' => 1,
	'mode_dhtml'        => 1,
);

$test->print_param($param);

$ret = $test->test_user_mod_modify( $param );
if (!$ret)
{
	echo "Error: failed: <br /><hr />\n";
	dev_footer();
}

echo "<h4>Test OK !</h4>\n";

dev_footer();
// --- end of main ---

?>