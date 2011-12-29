<?php
// $Id: test_form_guest_delete_link.php,v 1.1 2011/12/29 14:32:58 ohwada Exp $

// 2007-10-30 K.OHWADA
// test_form_guest_class.php

//=========================================================
// WebLinks Module
// 2007-09-20 K.OHWADA
//=========================================================

//---------------------------------------------------------
// TODO
// confirm to store request in modify table
//---------------------------------------------------------

//---------------------------------------------------------
// test parameter
//---------------------------------------------------------

$LID = 0;

//---------------------------------------------------------

include_once 'dev_header.php';
include_once 'test_form_class.php';
include_once 'test_form_guest_class.php';

$test =& weblinks_test_form_guest::getInstance();

dev_header();
echo "<h3>test form: guest delete link</h3>\n";

if ( !$test->has_guest_perm() )
{
	$test->print_error('guest has no permission in this module');
	dev_footer();
}

$LID    = $test->get_post_lid();
$PASSWD = $test->get_post_passwd();
if ( empty($LID) )
{
	$test->print_form_lid( true );
	dev_footer();
}

echo "lid   : <b>". $LID ."</b> <br />\n";
echo "passwd: <b>". $PASSWD ."</b> <br />\n";

$link_url  = WEBLINKS_URL.'/modlink.php';
$list_url  = WEBLINKS_URL.'/admin/link_list.php?sortid=1';

$ret = $test->logout( false );
if ( !$ret )
{
	dev_footer();
}

//---------------------------------------------------------
// not permit
//---------------------------------------------------------
echo "<h4>scenario 1: not permit</h4>\n";

$test->update_config_by_name( 'use_passwd',  0 );
$test->update_config_by_name( 'use_captcha', 0 );
$test->update_config_by_name( 'cat_path',    0 );
$test->update_config_by_name( 'cat_count',   0 );
$test->update_config_by_name_array( 'auth_modify',      array(1) );
$test->update_config_by_name_array( 'auth_modify_auto', array(1) );
$test->update_config_by_name_array( 'auth_delete',      array(1) );
$test->update_config_by_name_array( 'auth_delete_auto', array(1) );

$link_form_url = $link_url.'?lid='.$LID;
$ret = $test->fetch( $link_form_url );
if ( !$ret )
{
	dev_footer();
}

if ( $test->match_return_msg( 'not user' ) )
{
	echo "<h4>Test OK !</h4>\n";
}
else
{
	echo "Error: test failed to fetch delete form <br /><hr />\n";
	echo $test->get_body() ."<br /><br />\n";
	dev_footer();
}

//---------------------------------------------------------
// password match
//---------------------------------------------------------
echo "<h4>scenario 2: password match</h4>\n";

$test->update_config_by_name( 'use_passwd', 1 );
$test->update_config_by_name_array( 'auth_modify', array(1, WEBLINKS_ID_AUTH_PASSWD) );
$test->update_config_by_name_array( 'auth_delete', array(1, WEBLINKS_ID_AUTH_PASSWD) );

$title  = $test->get_randum_title();
$param  = array(
	'lid'      => $LID,
	'title'    => $title,
	'banner'   => $test->get_randum_banner( 0 ),
	'rss_url'  => WEBLINKS_URL.'/dev/rss_3.xml',
	'rss_flag' => 2,	// rss
	'passwd'   => $PASSWD,
	'request'  => 'password',
);

$ret = $test->guest_delete_password( $param );
if ( !$ret )
{
	dev_footer();
}

$ret = $test->user_delete_reason();
if ( !$ret )
{
	dev_footer();
}

if ( $test->match_return_msg( 'delete request link' ) )
{
	echo "<h4>Success !</h4>\n";
	echo "delete link: ".$title." <br /><br />\n";
}
else
{
	echo "Error: delete link form failed: <br /><hr />\n";
	echo $test->get_body() ."<br /><br />\n";
	dev_footer();
}

//---------------------------------------------------------
// permit & approve
//---------------------------------------------------------
echo "<h4>scenario 3: permit and approve: </h4>\n";

$test->update_config_by_name( 'cat_count', 1 );
$test->update_config_by_name_array( 'auth_delete_auto', array(1, WEBLINKS_ID_AUTH_PASSWD) );

$title  = $test->get_randum_title();
$param  = array(
	'lid'      => $LID,
	'title'    => $title,
	'banner'   => $test->get_randum_banner( 0 ),
	'rss_url'  => WEBLINKS_URL.'/dev/rss_3.xml',
	'rss_flag' => 2,	// rss
	'passwd'   => $PASSWD,
	'request'  => 'password',
);

$ret = $test->guest_delete_password( $param );
if ( !$ret )
{
	dev_footer();
}

$ret = $test->user_delete_confirm();
if ( !$ret )
{
	dev_footer();
}

if ( $test->match_return_msg( 'delete approve link' ) )
{
	echo "<h4>Success !</h4>\n";
	echo "delete link: ".$title." <br /><br />\n";
}
else
{
	echo "Error: delete link form failed: <br /><hr />\n";
	echo $test->get_body() ."<br /><br />\n";
	dev_footer();
}

//---------------------------------------------------------
echo '<a href="'.$list_url.'" target="_blank" >goto link list</a>'."<br />\n";
dev_footer();
// --- end of main ---

?>