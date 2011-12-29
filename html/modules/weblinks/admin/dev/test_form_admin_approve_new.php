<?php
// $Id: test_form_admin_approve_new.php,v 1.1 2011/12/29 14:32:58 ohwada Exp $

// 2007-09-20 K.OHWADA
// build_rss_url()

//=========================================================
// WebLinks Module
// 2007-09-01 K.OHWADA
//=========================================================

include_once 'dev_header.php';
include_once 'test_form_class.php';
include_once 'test_form_admin_class.php';
include_once 'test_form_approve_class.php';

$test =& weblinks_test_form_approve::getInstance();

dev_header();
echo "<h3>test form: admin approve new link</h3>\n";
echo "admin: ".$test->get_admin_uname()."<br />\n";
echo "user:  ".$test->get_user_uname(). "<br />\n";

$list_url  = WEBLINKS_URL.'/admin/link_list.php?sortid=1';

//---------------------------------------------------------
// submit & approve
//---------------------------------------------------------
echo "<h4>scenario 1: submit & approve: no banner, no perfomance, no rss</h4>\n";

$test->update_config_by_name( 'cat_path',  0 );
$test->update_config_by_name( 'cat_count', 0 );
$test->update_config_by_name_array( 'auth_submit',      array(1,2) );
$test->update_config_by_name_array( 'auth_submit_auto', array(1) );

$title = $test->get_randum_title();
$param = array(
	'title'    => $title,
	'banner'   => '',
	'rss_url'  => '',
	'rss_flag' => 0,
	'notify'   => 0,
	'return'   => 'submit request link',
);

$ret = $test->user_submit_link_with_login( $param );
if ( !$ret )
{
	dev_footer();
}

$ret = $test->admin_approve_new_with_login();
if ( !$ret )
{
	dev_footer();
}

if ( $test->check_msg_and_new_link( 'approve new link' ) )
{
	echo "<h4>Success !</h4>\n";
	echo "submit & approve new link: ".$title." <br /><br />\n";
}
else
{
	echo "Error: approve link failed: <br /><hr />\n";
	echo $test->get_body() ."<br /><br />\n";
	dev_footer();
}

$test->logout();

//---------------------------------------------------------
// submit & approve
//---------------------------------------------------------
echo "<h4>scenario 2: submit & approve: banner, perfomance, rss</h4>\n";

$test->update_config_by_name( 'cat_count', 1 );

$title = $test->get_randum_title();
$param = array(
	'title'    => $title,
	'banner'   => $test->get_randum_banner( 0 ),
	'rss_url'  => $test->build_rss_url( 13 ),
	'rss_flag' => 2,	// rss
	'notify'   => 1,
	'return'   => 'submit request link',
);

$ret = $test->user_submit_link_with_login( $param );
if ( !$ret )
{
	dev_footer();
}

$ret = $test->admin_approve_new_with_login();
if ( !$ret )
{
	dev_footer();
}

$ret = $test->admin_approve_new_send_notify();
if ( !$ret )
{
	dev_footer();
}

if ( $test->is_exist_rssc_module() )
{
	$ret = $test->admin_add_link_add_rssc();
	if ( !$ret )
	{
		dev_footer();
	}

	$ret = $test->admin_add_link_refresh();
	if ( !$ret )
	{
		dev_footer();
	}

	if ( $test->check_msg_and_link( 'refresh' ) )
	{
		echo "<h4>Success !</h4>\n";
		echo "submit & approve new link: ".$title." <br /><br />\n";
	}
	else
	{
		echo "Error: add link form failed: <br /><hr />\n";
		echo $test->get_body() ."<br /><br />\n";
		dev_footer();
	}
}
else
{
	echo "Skip this test: RSSC module is not installed <br />\n";
}

$test->logout();

//---------------------------------------------------------
// submit & refuse
//---------------------------------------------------------
echo "<h4>scenario 3: submit & refuse</h4>\n";

$title = $test->get_randum_title();
$param = array(
	'title'    => $title,
	'banner'   => '',
	'rss_url'  => '',
	'rss_flag' => 0,
	'notify'   => 1,
	'return'   => 'submit request link',
);

$ret = $test->user_submit_link_with_login( $param );
if ( !$ret )
{
	dev_footer();
}

$ret = $test->admin_refuse_new_with_login();
if ( !$ret )
{
	dev_footer();
}

$ret = $test->admin_refuse_new_send_notify();
if ( !$ret )
{
	dev_footer();
}

if ( $test->match_return_msg( 'notify refuse new link' ) )
{
	echo "<h4>Success !</h4>\n";
	echo "submit & refuse new link: ".$title." <br /><br />\n";
}
else
{
	echo "Error: refuse new link failed: <br /><hr />\n";
	echo $test->get_body() ."<br /><br />\n";
	dev_footer();
}

$test->logout();

//---------------------------------------------------------
echo '<a href="'.$list_url.'" target="_blank" >goto link list</a>'."<br />\n";
dev_footer();
// --- end of main ---

?>