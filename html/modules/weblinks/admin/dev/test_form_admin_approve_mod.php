<?php
// $Id: test_form_admin_approve_mod.php,v 1.1 2011/12/29 14:32:58 ohwada Exp $

// 2007-09-20 K.OHWADA
// build_rss_url()

//=========================================================
// WebLinks Module
// 2007-09-01 K.OHWADA
//=========================================================

//---------------------------------------------------------
// test parameter
//---------------------------------------------------------

$LID = 0;

//---------------------------------------------------------

include_once 'dev_header.php';
include_once 'test_form_class.php';
include_once 'test_form_admin_class.php';
include_once 'test_form_approve_class.php';

$test =& weblinks_test_form_approve::getInstance();

$is_link_owner = false;

dev_header();
echo "<h3>test form: admin approve modification link</h3>\n";

$LID = $test->get_post_lid();
if ( empty($LID) )
{
	$test->print_form_lid();
	dev_footer();
}

echo "lid: <b>". $LID ."</b> <br />\n";
echo "admin: ".$test->get_admin_uname()."<br />\n";

if ( $test->is_link_owner($LID) )
{
	$is_link_owner = true;
	echo "user: <b>".$test->get_user_uname()."</b> is owner <br />\n";
}
else
{
	echo "user: <b>".$test->get_user_uname()."</b> is not owner <br />\n";
}

$list_url  = WEBLINKS_URL.'/admin/link_list.php?sortid=0';

//---------------------------------------------------------
// modify & approve
//---------------------------------------------------------
echo "<h4>scenario 1: modify & approve: no banner, no perfomance, no rss, not nofify</h4>\n";


//$test->set_debug_print_form( true );
//$/test->set_debug_print_form_value( true );
//$test->set_debug_print_submit( true );

$test->update_config_by_name( 'cat_path',  0 );
$test->update_config_by_name( 'cat_count', 0 );
$test->update_config_by_name_array( 'auth_modify',      array(1,2) );
$test->update_config_by_name_array( 'auth_modify_auto', array(1) );

$title = $test->get_randum_title();
$param = array(
	'lid'      => $LID,
	'title'    => $title,
	'banner'   => '',
	'rss_url'  => '',
	'rss_flag' => 0,
	'notify'   => 0,
	'return'   => 'modify request link',
);

$ret = $test->user_modify_link_with_login( $param );
if ( !$ret )
{
	dev_footer();
}

$msg = 'approve mod link';
$ret = $test->admin_approve_mod_with_login();
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
	echo "modify & approve mod link: ".$title." <br /><br />\n";
}
else
{
	echo "Error: approve link failed: <br /><hr />\n";
	echo $test->get_body() ."<br /><br />\n";
	dev_footer();
}

$test->logout();

//---------------------------------------------------------
// modify & approve
//---------------------------------------------------------
echo "<h4>scenario 2: modify & approve: banner, perfomance, rss, nofify</h4>\n";

$test->update_config_by_name( 'cat_count', 1 );

$title = $test->get_randum_title();
$param = array(
	'lid'      => $LID,
	'title'    => $title,
	'banner'   => $test->get_randum_banner( 0 ),
	'rss_url'  => $test->build_rss_url( 14 ),
	'rss_flag' => 2,	// rss
	'notify'   => 1,	// nofity
	'return'   => 'modify request link',
);

$ret = $test->user_modify_link_with_login( $param );
if ( !$ret )
{
	dev_footer();
}

$ret = $test->admin_approve_mod_with_login();
if ( !$ret )
{
	dev_footer();
}

$msg = 'notify approve mod link';
$ret = $test->admin_approve_mod_send_notify();
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

	if ( !$test->match_return_msg( $msg ) )
	{
		$msg = 'refresh';
		$ret = $test->admin_mod_link_refresh();
		if ( !$ret )
		{
			dev_footer();
		}
	}
}
else
{
	echo "Skip this test: RSSC module is not installed <br />\n";
}

if ( $test->check_msg_and_link( $msg ) )
{
	echo "<h4>Success !</h4>\n";
	echo "modify & approve mod link: ".$title." <br /><br />\n";
}
else
{
	echo "Error: approve link failed: <br /><hr />\n";
	echo $test->get_body() ."<br /><br />\n";
	dev_footer();
}

$test->logout();

//---------------------------------------------------------
// modify & refuse
//---------------------------------------------------------
echo "<h4>scenario 3: modify & refuse</h4>\n";

//$test->set_debug_print( true );

$title = $test->get_randum_title();
$param = array(
	'lid'      => $LID,
	'title'    => $title,
	'banner'   => '',
	'rss_url'  => '',
	'rss_flag' => 0,
	'notify'   => 1,	// nofity
	'return'   => 'modify request link',
);

$ret = $test->user_modify_link_with_login( $param );
if ( !$ret )
{
	dev_footer();
}

$ret = $test->admin_refuse_mod_with_login();
if ( !$ret )
{
	dev_footer();
}

$ret = $test->admin_refuse_mod_send_notify();
if ( !$ret )
{
	dev_footer();
}

if ( $test->match_return_msg( 'notify refuse mod link' ) )
{
	echo "<h4>Success !</h4>\n";
	echo "modify & refuse mod link: ".$title." <br /><br />\n";
}
else
{
	echo "Error: refuse mod link failed: <br /><hr />\n";
	echo $test->get_body() ."<br /><br />\n";
	dev_footer();
}

$test->logout();

//---------------------------------------------------------
echo '<a href="'.$list_url.'" target="_blank" >goto link list</a>'."<br />\n";
dev_footer();
// --- end of main ---

?>