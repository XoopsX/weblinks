<?php
// $Id: test_form_admin_mod_link.php,v 1.1 2011/12/29 14:32:57 ohwada Exp $

// 2007-09-20 K.OHWADA
// build_rss_url()

//=========================================================
// WebLinks Module
// 2007-09-01 K.OHWADA
//=========================================================

//---------------------------------------------------------
// TODO
// control 'rssc no action' & 'refresh'
//---------------------------------------------------------

//---------------------------------------------------------
// test parameter
//---------------------------------------------------------

$LID = 0;

//---------------------------------------------------------

include_once 'dev_header.php';
include_once 'test_form_class.php';
include_once 'test_form_admin_class.php';

$test =& weblinks_test_form_admin::getInstance();

dev_header();
echo "<h3>test form: admin mod link</h3>\n";

$LID = $test->get_post_lid();
if ( empty($LID) )
{
	$test->print_form_lid();
	dev_footer();
}

echo "lid:   ". $LID ."<br />\n";
echo "admin: ". $test->get_admin_uname() ."<br />\n";

$link_url = WEBLINKS_URL.'/admin/link_manage.php';
$list_url = WEBLINKS_URL.'/admin/link_list.php?sortid=0';

$ret = $test->login_admin();
if ( !$ret )
{
	dev_footer();
}

//---------------------------------------------------------
// scenario 1: no banner, no performance, no rss
//---------------------------------------------------------
echo "<h4>scenario 1: no banner, no performance, no rss</h4>\n";

$test->update_config_by_name( 'cat_path',  0 );
$test->update_config_by_name( 'cat_count', 0 );

$title = $test->get_randum_title();
$param = array(
	'lid'       => $LID,
	'title'     => $title,
	'banner'    => '',
	'rss_url'   => '',
	'rss_flag'  => 0,
	'rss_flag'  => 0,
);

$msg = 'admin mod link';
$ret = $test->admin_mod_link( $param );
if ( !$ret )
{
	dev_footer();
}

if ( $test->is_exist_rssc_module() )
{
	$msg = 'rssc no action';
	$ret = $test->admin_mod_link_mod_rssc();
	if ( !$ret )
	{
		dev_footer();
	}
}

if ( $test->check_msg_and_link( $msg ) )
{
	echo "<h4>Success !</h4>\n";
	echo "mod link: ".$title." <br /><br />\n";
}
else
{
	echo "Error: admin mod link failed: <br /><hr />\n";
	echo $test->get_body() ."<br />\n";
	dev_footer();
}

//---------------------------------------------------------
// scenario 2: banner, no performance, no rss
//---------------------------------------------------------
echo "<h4>scenario 2: banner, no performance, no rss</h4>\n";

$title = $test->get_randum_title();
$param = array(
	'lid'      => $LID,
	'title'    => $title,
	'banner'   => $test->get_randum_banner( 0 ),
	'rss_url'  => '',
	'rss_flag' => 0,
);

$ret = $test->admin_mod_link( $param );
if ( !$ret )
{
	dev_footer();
}

$msg = 'mod banner';
$ret = $test->admin_mod_link_mod_banner();
if ( !$ret )
{
	dev_footer();
}

if ( $test->is_exist_rssc_module() )
{
	$msg = 'rssc no action';
	$ret = $test->admin_mod_link_mod_rssc();
	if ( !$ret )
	{
		dev_footer();
	}
}

if ( $test->check_msg_and_link( $msg ) )
{
	echo "<h4>Success !</h4>\n";
	echo "admin mod link: ".$title." <br /><br />\n";

}
else
{
	echo "Error: mod link form failed: <br /><hr />\n";
	echo $test->get_body() ."<br /><br />\n";
	dev_footer();
}

//---------------------------------------------------------
// scenario 3: banner, performance, no rss
//---------------------------------------------------------
echo "<h4>scenario 3: banner, performance, no rss</h4>\n";

$test->update_config_by_name( 'cat_count', 1 );

$title = $test->get_randum_title();
$param = array(
	'lid'      => $LID,
	'title'    => $title,
	'banner'   => $test->get_randum_banner( 0 ),
	'rss_url'  => '',
	'rss_flag' => 0,
);

$ret = $test->admin_mod_link( $param );
if ( !$ret )
{
	dev_footer();
}

$ret = $test->admin_mod_link_mod_banner();
if ( !$ret )
{
	dev_footer();
}

$msg = 'update cat';
$ret = $test->admin_mod_link_update_cat();
if ( !$ret )
{
	dev_footer();
}

if ( $test->is_exist_rssc_module() )
{
	$msg = 'rssc no action';
	$ret = $test->admin_mod_link_mod_rssc();
	if ( !$ret )
	{
		dev_footer();
	}
}

if ( $test->check_msg_and_link( $msg ) )
{
	echo "<h4>Success !</h4>\n";
	echo "admin mod link: ".$title." <br /><br />\n";

}
else
{
	echo "Error: mod link form failed: <br /><hr />\n";
	echo $test->get_body() ."<br /><br />\n";
	dev_footer();
}

//---------------------------------------------------------
// scenario 4: banner, no performance, rss
//---------------------------------------------------------
echo "<h4>scenario 4: banner, no performance, rss</h4>\n";

$test->update_config_by_name( 'cat_count', 0 );

$title = $test->get_randum_title();
$param = array(
	'lid'      => $LID,
	'title'    => $title,
	'banner'   => $test->get_randum_banner( 0 ),
	'rss_url'  => $test->build_rss_url( 3 ),
	'rss_flag' => 2,	// rss
);

if ( $test->is_exist_rssc_module() )
{
	$test->update_config_by_name( 'rss_use', 1 );

	$ret = $test->admin_mod_link( $param );
	if ( !$ret )
	{
		dev_footer();
	}

	$ret = $test->admin_mod_link_mod_banner();
	if ( !$ret )
	{
		dev_footer();
	}

	$msg = 'rssc no action';
	$ret = $test->admin_mod_link_mod_rssc();
	if ( !$ret )
	{
		dev_footer();
	}

	if ( !$test->match_return_msg( $msg ) )
	{
		$msg = 'refresh';
		$ret = $test->admin_mod_link_refresh();
		if ( !$ret )
		{
			dev_footer();
		}
	}

	if ( $test->check_msg_and_link( $msg ) )
	{
		echo "<h4>Success !</h4>\n";
		echo "mod link: ".$title." <br /><br />\n";
	}
	else
	{
		echo "Error: mod link form failed: <br /><hr />\n";
		echo $test->get_body() ."<br /><br />\n";
		dev_footer();
	}
}
else
{
	echo "Skip this test: RSSC module is not installed <br />\n";
}

//---------------------------------------------------------
// scenario 5: banner, performance, rss
//---------------------------------------------------------
echo "<h4>scenario 5: banner, performance, rss</h4>\n";

$test->update_config_by_name( 'cat_count', 1 );

$title = $test->get_randum_title();
$param = array(
	'lid'      => $LID,
	'title'    => $title,
	'banner'   => $test->get_randum_banner( 0 ),
	'rss_url'  => $test->build_rss_url( 4 ),
	'rss_flag' => 2,	// rss
);

if ( $test->is_exist_rssc_module() )
{
	$ret = $test->admin_mod_link( $param );
	if ( !$ret )
	{
		dev_footer();
	}

	$ret = $test->admin_mod_link_mod_banner();
	if ( !$ret )
	{
		dev_footer();
	}

	$ret = $test->admin_mod_link_update_cat();
	if ( !$ret )
	{
		dev_footer();
	}

	$msg = 'rssc no action';
	$ret = $test->admin_mod_link_mod_rssc();
	if ( !$ret )
	{
		dev_footer();
	}

	if ( !$test->match_return_msg( $msg ) )
	{
		$msg = 'refresh';
		$ret = $test->admin_mod_link_refresh();
		if ( !$ret )
		{
			dev_footer();
		}
	}

	if ( $test->check_msg_and_link( $msg ) )
	{
		echo "<h4>Success !</h4>\n";
		echo "mod link: ".$title." <br /><br />\n";
	}
	else
	{
		echo "Error: mod link form failed: <br /><hr />\n";
		echo $test->get_body() ."<br /><br />\n";
		dev_footer();
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