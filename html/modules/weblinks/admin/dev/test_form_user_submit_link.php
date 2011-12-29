<?php
// $Id: test_form_user_submit_link.php,v 1.1 2011/12/29 14:32:59 ohwada Exp $

// 2007-09-20 K.OHWADA
// build_rss_url()

// 2007-09-01 K.OHWADA
// change user_submit_link()

// 2007-02-20 K.OHWADA
// performance mode

//=========================================================
// WebLinks Module
// 2006-09-20 K.OHWADA
//=========================================================

//---------------------------------------------------------
// TODO
// confirm to store request in modify table
//---------------------------------------------------------

include_once 'dev_header.php';
include_once 'test_form_class.php';

$test =& weblinks_test_form::getInstance();

dev_header();
echo "<h3>test form: user submit link</h3>\n";
echo "user: ".$test->get_user_uname()."<br />\n";

$link_url  = WEBLINKS_URL.'/submit.php';
$list_url  = WEBLINKS_URL.'/admin/link_list.php?sortid=1';

$ret = $test->login_user();
if ( !$ret )
{
	dev_footer();
}

//---------------------------------------------------------
// not permit
//---------------------------------------------------------
echo "<h4>scenario 1: not permit</h4>\n";

$test->update_config_by_name( 'cat_path',  0 );
$test->update_config_by_name( 'cat_count', 0 );
$test->update_config_by_name_array( 'auth_submit',      array(1) );
$test->update_config_by_name_array( 'auth_submit_auto', array(1) );

$ret = $test->fetch( $link_url );
if ( !$ret )
{
	dev_footer();
}

if ( $test->match_return_msg( 'not permit' ) )
{
	echo "<h4>Test OK !</h4>\n";
}
else
{
	echo "Error: test failed to fetch submit form <br /><hr />\n";
	echo $test->get_body() ."<br /><br />\n";
	dev_footer();
}

//---------------------------------------------------------
// permit
//---------------------------------------------------------
echo "<h4>scenario 2: permit</h4>\n";

$test->update_config_by_name_array( 'auth_submit',      array(1,2) );

$title = $test->get_randum_title();
$param = array(
	'title'    => $title,
	'banner'   => $test->get_randum_banner( 0 ),
	'rss_url'  => $test->build_rss_url( 5 ),
	'rss_flag' => 2,	// rss
);

$ret = $test->user_submit_link( $param );
if ( !$ret )
{
	dev_footer();
}

if ( $test->match_return_msg( 'submit request link' ) )
{
	echo "<h4>Success !</h4>\n";
	echo "submit link: ".$title." <br /><br />\n";
}
else
{
	echo "Error: submit link form failed: <br /><hr />\n";
	echo $test->get_body() ."<br /><br />\n";
	dev_footer();
}

//---------------------------------------------------------
// permit & approve
//---------------------------------------------------------
echo "<h4>scenario 3: permit and approve: no banner, no perfomance, no rss</h4>\n";

$test->update_config_by_name_array( 'auth_submit_auto', array(1,2) );

$title = $test->get_randum_title();
$param = array(
	'title'    => $title,
	'banner'   => '',
	'rss_url'  => '',
	'rss_flag' => 0,	// non
);

$ret = $test->user_submit_link( $param );
if ( !$ret )
{
	dev_footer();
}

if ( $test->check_msg_and_new_link( 'submit approve link' ) )
{
	echo "<h4>Success !</h4>\n";
	echo "submit link: ".$title." <br /><br />\n";
}
else
{
	echo "Error: submit link form failed: <br /><hr />\n";
	echo $test->get_body() ."<br /><br />\n";
	dev_footer();
}

//---------------------------------------------------------
// permit & approve
//---------------------------------------------------------
echo "<h4>scenario 4: permit and approve: banner, perfomance, rss</h4>\n";

$test->update_config_by_name( 'cat_count', 1 );

$title = $test->get_randum_title();
$param = array(
	'title'    => $title,
	'banner'   => $test->get_randum_banner( 0 ),
	'rss_url'  => $test->build_rss_url( 6 ),
	'rss_flag' => 2,	// rss
);

$ret = $test->user_submit_link( $param );
if ( !$ret )
{
	dev_footer();
}

if ( $test->check_msg_and_new_link( 'submit approve link' ) )
{
	echo "<h4>Success !</h4>\n";
	echo "submit link: ".$title." <br /><br />\n";
}
else
{
	echo "Error: submit link form failed: <br /><hr />\n";
	echo $test->get_body() ."<br /><br />\n";
	dev_footer();
}

//---------------------------------------------------------
echo '<a href="'.$list_url.'" target="_blank" >goto link list</a>'."<br />\n";
dev_footer();
// --- end of main ---

?>