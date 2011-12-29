<?php
// $Id: test_form_admin_add_link.php,v 1.1 2011/12/29 14:32:58 ohwada Exp $

// 2008-02-17 K.OHWADA
// check_config_rss_use()

// 2007-09-20 K.OHWADA
// build_rss_url()

// 2007-09-01 K.OHWADA
// change admin_add_link()

// weblinks_test_form_admin
// 'admin add link'

// 2007-05-18 K.OHWADA
// is_exist_rssc_module()

// 2007-02-20 K.OHWADA
// performance mode

//=========================================================
// WebLinks Module
// 2006-09-20 K.OHWADA
//=========================================================

include_once 'dev_header.php';
include_once 'test_form_class.php';
include_once 'test_form_admin_class.php';

$test =& weblinks_test_form_admin::getInstance();

dev_header();
echo "<h3>test form: admin add link</h3>\n";
echo "admin: ".$test->get_admin_uname()."<br />\n";

$link_url = WEBLINKS_URL.'/admin/link_manage.php';
$list_url = WEBLINKS_URL.'/admin/link_list.php?sortid=1';

$ret = $test->login_admin();
if ( !$ret )
{
	dev_footer();
}

$test->check_config_rss_use();

//---------------------------------------------------------
// scenario 1: no banner, , no perfomance, no rss
//---------------------------------------------------------
echo "<h4>scenario 1: no banner, no perfomance, no rss</h4>\n";

$test->update_config_by_name( 'cat_count', 0 );

$title = $test->get_randum_title();
$param = array(
	'title'    => $title,
	'banner'   => '',
	'rss_url'  => '',
	'rss_flag' => 0,
);

$ret = $test->admin_add_link( $param );
if ( !$ret )
{
	dev_footer();
}

if ( $test->check_msg_and_new_link( 'admin add link' ) )
{
	echo "<h4>Success !</h4>\n";
	echo "add link: ".$title." <br /><br />\n";
}
else
{
	echo "Error: add link form failed: <br /><hr />\n";
	echo $test->get_body() ."<br />\n";
}

//---------------------------------------------------------
// scenario 2: banner, no perfomance, no rss
//---------------------------------------------------------
echo "<h4>scenario 2: banner, no perfomance, no rss</h4>\n";

$title = $test->get_randum_title();
$param = array(
	'title'    => $title,
	'banner'   => $test->get_randum_banner( 0 ),
	'rss_url'  => '',
	'rss_flag' => 0,
);

$ret = $test->admin_add_link( $param );
if ( !$ret )
{
	dev_footer();
}

$ret = $test->admin_add_link_add_banner();
if ( !$ret )
{
	dev_footer();
}

if ( $test->check_msg_and_link( 'add banner' ) )
{
	echo "<h4>Success !</h4>\n";
	echo "add link: ".$title." <br /><br />\n";

}
else
{
	echo "Error: add link form failed: <br /><hr />\n";
	echo $test->get_body() ."<br /><br />\n";
}

//---------------------------------------------------------
// scenario 3: banner, perfomance, no rss
//---------------------------------------------------------
echo "<h4>scenario 3: banner, perfomance, no rss</h4>\n";

$test->update_config_by_name( 'cat_count', 1 );

$title = $test->get_randum_title();
$param = array(
	'title'    => $title,
	'banner'   => $test->get_randum_banner( 0 ),
	'rss_url'  => '',
	'rss_flag' => 0,
);

$ret = $test->admin_add_link( $param );
if ( !$ret )
{
	dev_footer();
}

$ret = $test->admin_add_link_add_banner();
if ( !$ret )
{
	dev_footer();
}

$ret = $test->admin_add_link_update_cat();
if ( !$ret )
{
	dev_footer();
}

if ( $test->check_msg_and_link( 'update cat' ) )
{
	echo "<h4>Success !</h4>\n";
	echo "add link: ".$title." <br /><br />\n";

}
else
{
	echo "Error: add link form failed: <br /><hr />\n";
	echo $test->get_body() ."<br /><br />\n";
}

//---------------------------------------------------------
// scenario 4: banner, no perfomance, rss
//---------------------------------------------------------
echo "<h4>scenario 4: banner, no perfomance, rss</h4>\n";

$test->update_config_by_name( 'cat_count', 0 );

$title = $test->get_randum_title();
$param = array(
	'title'    => $title,
	'banner'   => $test->get_randum_banner( 0 ),
	'rss_url'  => $test->build_rss_url( 1 ),
	'rss_flag' => 2,	// rss
);

if ( $test->is_exist_rssc_module() )
{
	$ret = $test->admin_add_link( $param );
	if ( !$ret )
	{
		dev_footer();
	}

	$ret = $test->admin_add_link_add_banner();
	if ( !$ret )
	{
		dev_footer();
	}

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
		echo "add link: ".$title." <br /><br />\n";
	}
	else
	{
		echo "Error: add link form failed: <br /><hr />\n";
		echo $test->get_body() ."<br /><br />\n";
	}
}
else
{
	echo "Skip this test: RSSC module is not installed <br />\n";
}

//---------------------------------------------------------
// scenario 5: banner, perfomance, rss
//---------------------------------------------------------
echo "<h4>scenario 5: banner, perfomance, rss</h4>\n";

$test->update_config_by_name( 'cat_count', 1 );

$title = $test->get_randum_title();
$param = array(
	'title'    => $title,
	'banner'   => $test->get_randum_banner( 0 ),
	'rss_url'  => $test->build_rss_url( 2 ),
	'rss_flag' => 2,	// rss
);

if ( $test->is_exist_rssc_module() )
{
	$ret = $test->admin_add_link( $param );
	if ( !$ret )
	{
		dev_footer();
	}

	$ret = $test->admin_add_link_add_banner();
	if ( !$ret )
	{
		dev_footer();
	}

	$ret = $test->admin_add_link_update_cat();
	if ( !$ret )
	{
		dev_footer();
	}

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
		echo "add link: ".$title." <br /><br />\n";
	}
	else
	{
		echo "Error: add link form failed: <br /><hr />\n";
		echo $test->get_body() ."<br /><br />\n";
	}
}
else
{
	echo "Skip this test: RSSC module is not installed <br />\n";
}

//---------------------------------------------------------
echo '<a href="'.$list_url.'" target="_blank" >goto link list</a>'."<br />\n";
dev_footer();
// --- end of main ---

?>