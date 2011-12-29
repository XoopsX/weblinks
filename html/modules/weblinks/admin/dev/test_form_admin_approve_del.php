<?php
// $Id: test_form_admin_approve_del.php,v 1.1 2011/12/29 14:32:57 ohwada Exp $

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
echo "<h3>test form: admin approve deletion link</h3>\n";

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
// delete & refuse
//---------------------------------------------------------
echo "<h4>scenario 1: delete & refuse </h4>\n";

$test->update_config_by_name( 'cat_path',  0 );
$test->update_config_by_name( 'cat_count', 0 );
$test->update_config_by_name_array( 'auth_delete',      array(1,2) );
$test->update_config_by_name_array( 'auth_delete_auto', array(1) );
$test->update_config_by_name_array( 'auth_delete',      array(1,2) );
$test->update_config_by_name_array( 'auth_delete_auto', array(1) );

$param = array(
	'lid'      => $LID,
	'return'   => 'delete request link',
);

$ret = $test->user_delete_link_with_login( $param );
if ( !$ret )
{
	dev_footer();
}

$ret = $test->admin_refuse_del_with_login();
if ( !$ret )
{
	dev_footer();
}

$ret = $test->admin_refuse_del_send_notify();
if ( !$ret )
{
	dev_footer();
}

if ( $test->match_return_msg( 'notify refuse del link' ) )
{
	echo "<h4>Success !</h4>\n";
	echo "delete & refuse del link: <br /><br />\n";
}
else
{
	echo "Error: refuse del link failed: <br /><hr />\n";
	echo $test->get_body() ."<br /><br />\n";
	dev_footer();
}

$test->logout();

//---------------------------------------------------------
// delete & approve
//---------------------------------------------------------
echo "<h4>scenario 2: delete & approve </h4>\n";

$param = array(
	'lid'      => $LID,
	'return'   => 'delete request link',
);

$ret = $test->user_delete_link_with_login( $param );
if ( !$ret )
{
	dev_footer();
}

$ret = $test->admin_approve_del_with_login();
if ( !$ret )
{
	dev_footer();
}

$ret = $test->admin_approve_del_confirm();
if ( !$ret )
{
	dev_footer();
}

$msg = 'notify approve del link';
$ret = $test->admin_approve_del_send_notify();
if ( !$ret )
{
	dev_footer();
}

if ( $test->match_return_msg( $msg ) )
{
	echo "<h4>Success !</h4>\n";
	echo "delete & approve del link: <br /><br />\n";
}
else
{
	echo "Error: approve link failed: <br /><hr />\n";
	echo $test->get_body() ."<br /><br />\n";
	dev_footer();
}

$test->logout();



//---------------------------------------------------------
echo '<a href="'.$list_url.'" target="_blank" >goto link list</a>'."<br />\n";
dev_footer();
// --- end of main ---

?>