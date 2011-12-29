<?php
// $Id: test_form_user_modify_link.php,v 1.1 2011/12/29 14:32:57 ohwada Exp $

// 2007-09-20 K.OHWADA
// build_rss_url()

// 2007-09-01 K.OHWADA
// change user_modify_link()

// 2007-05-18 K.OHWADA
// XC 2.1

// 2007-03-01 K.OHWADA
// performance mode

//=========================================================
// WebLinks Module
// 2006-09-20 K.OHWADA
//=========================================================

//---------------------------------------------------------
// TODO
// confirm to store request in modify table
//---------------------------------------------------------

//---------------------------------------------------------
// RFC1034 Domain names
// allow: A-Z, a-z, 0-9, -
// deny:  _
//---------------------------------------------------------

//---------------------------------------------------------
// test parameter
//---------------------------------------------------------

$LID = 0;

//---------------------------------------------------------

include_once 'dev_header.php';
include_once 'test_form_class.php';

$is_link_owner = false;

$test =& weblinks_test_form::getInstance();

dev_header();
echo "<h3>test form: user modify link</h3>\n";

$LID = $test->get_post_lid();
if ( empty($LID) )
{
	$test->print_form_lid();
	dev_footer();
}

echo "lid: <b>". $LID ."</b> <br />\n";

if ( $test->is_link_owner($LID) )
{
	$is_link_owner = true;
	echo "user: <b>".$test->get_user_uname()."</b> is owner <br />\n";
}
else
{
	echo "user: <b>".$test->get_user_uname(). '</b> <span style="color:#ff0000;">is not owner</span> <br />'."\n";
}

$link_url  = WEBLINKS_URL.'/modlink.php';
$list_url  = WEBLINKS_URL.'/admin/link_list.php?sortid=0';

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
$test->update_config_by_name_array( 'auth_modify',      array(1) );
$test->update_config_by_name_array( 'auth_modify_auto', array(1) );

$link_form_url = $link_url.'?lid='.$LID;
$ret = $test->fetch( $link_form_url );
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
	echo "Error: test failed to fetch modify form <br />\n";
	$test->print_body( true );
	dev_footer();
}

//---------------------------------------------------------
// permit for registered user
//---------------------------------------------------------
echo "<h4>scenario 2: permit for registered user</h4>\n";

$test->update_config_by_name_array( 'auth_modify',      array(1,2) );

$title = 'req-'.$test->get_randum_title();
$param = array(
	'lid'      => $LID,
	'title'    => $title,
	'banner'   => $test->get_randum_banner( 0 ),
	'rss_url'  => $test->build_rss_url( 7 ),
	'rss_flag' => 2,	// rss
);

$ret = $test->user_modify_link( $param );
if ( !$ret )
{
	dev_footer();
}

if ( $test->match_return_msg( 'modify request link' ) )
{
	echo "<h4>Success !</h4>\n";
	echo "modify link: ".$title." <br /><br />\n";
}
else
{
	echo "Error: modify link form failed: <br />\n";
	$test->print_body( true );
	dev_footer();
}

//---------------------------------------------------------
// permit & approve for owner
//---------------------------------------------------------
echo "<h4>scenario 3: permit and approve for owner: no banner, no perfomance, no rss</h4>\n";

$test->update_config_by_name_array( 'auth_modify',      array(1, WEBLINKS_ID_AUTH_UID) );
$test->update_config_by_name_array( 'auth_modify_auto', array(1, WEBLINKS_ID_AUTH_UID) );

$flag_ok = false;

$title = $test->get_randum_title();
$param = array(
	'lid'      => $LID,
	'title'    => $title,
	'banner'   => '',
	'rss_url'  => '',
	'rss_flag' => 0,	// non
);

if ( $is_link_owner )
{
	$ret = $test->user_modify_link( $param );
	if ( !$ret )
	{
		dev_footer();
	}

	if ( $test->check_msg_and_link( 'modify approve link' ) )
	{
		$flag_ok = true;
		echo "<h4>Success !</h4>\n";
		echo "modify link: ".$title." <br /><br />\n";
	}
}
else
{
	$link_form_url = $link_url.'?lid='.$LID;
	$ret = $test->fetch( $link_form_url );
	if ( !$ret )
	{
		dev_footer();
	}

	if ( $test->match_return_msg( 'not permit' ) )
	{
		$flag_ok = true;
		echo "<h4>Test OK !</h4>\n";
	}
}

if ( !$flag_ok )
{
	echo "Error: modify link form failed: <br />\n";
	$test->print_body( true );
	dev_footer();
}


//---------------------------------------------------------
// permit & approve for owner
//---------------------------------------------------------
echo "<h4>scenario 4: permit and approve for owner: banner, perfomance, rss</h4>\n";

$test->update_config_by_name( 'cat_count', 1 );

$flag_ok = false;

$title = 'mod-'.$test->get_randum_title();
$param = array(
	'lid'      => $LID,
	'title'    => $title,
	'banner'   => $test->get_randum_banner( 0 ),
	'rss_url'  => $test->build_rss_url( 8 ),
	'rss_flag' => 2,	// rss
);

if ( $is_link_owner )
{
	$ret = $test->user_modify_link( $param );
	if ( !$ret )
	{
		dev_footer();
	}

	if ( $test->check_msg_and_link( 'modify approve link' ) )
	{
		$flag_ok = true;
		echo "<h4>Success !</h4>\n";
		echo "modify link: ".$title." <br /><br />\n";
	}
}
else
{
	$link_form_url = $link_url.'?lid='.$LID;
	$ret = $test->fetch( $link_form_url );
	if ( !$ret )
	{
		dev_footer();
	}

	if ( $test->match_return_msg( 'not permit' ) )
	{
		$flag_ok = true;
		echo "<h4>Test OK !</h4>\n";
	}
}

if ( !$flag_ok )
{
	echo "Error: modify link form failed: <br />\n";
	$test->print_body( true );
	dev_footer();
}

//---------------------------------------------------------
// permit & approve for owner
//---------------------------------------------------------
echo "<h4>scenario 5: permit and approve for owner: not owner</h4>\n";

// logout
$ret = $test->logout();
if ( !$ret )
{
	dev_footer();
}

// other user login
$ret = $test->login_other();
if ( !$ret )
{
	dev_footer();
}

$flag_ok = false;

$title = 'mod-'.$test->get_randum_title();
$param = array(
	'lid'      => $LID,
	'title'    => $title,
	'banner'   => $test->get_randum_banner( 0 ),
	'rss_url'  => WEBLINKS_URL.'/dev/rss_4.xml',
	'rss_flag' => 2,	// rss
);

// other user has permission
if ( $test->is_link_owner_other($LID) )
{
	echo "user: <b>".$test->get_other_uname()."</b> is owner <br />\n";

	$ret = $test->user_modify_link( $param );
	if ( !$ret )
	{
		dev_footer();
	}

	if ( $test->check_msg_and_link( 'modify approve link' ) )
	{
		$flag_ok = true;
		echo "<h4>Success !</h4>\n";
		echo "modify link: ".$title." <br /><br />\n";
	}
}
// other user has no permission
else
{
	echo "user: <b>".$test->get_other_uname()."</b> is not owner <br />\n";

	$link_form_url = $link_url.'?lid='.$LID;
	$ret = $test->fetch( $link_form_url );
	if ( !$ret )
	{
		dev_footer();
	}

	if ( $test->match_return_msg( 'not permit' ) )
	{
		$flag_ok = true;
		echo "<h4>Test OK !</h4>\n";
	}
}

if ( !$flag_ok )
{
	echo "Error: modify link form failed: <br />\n";
	$test->print_body( true );
	dev_footer();
}

//---------------------------------------------------------
echo '<a href="'.$list_url.'" target="_blank" >goto link list</a>'."<br />\n";
dev_footer();
// --- end of main ---

?>