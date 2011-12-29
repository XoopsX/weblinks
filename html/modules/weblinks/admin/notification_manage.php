<?php
// $Id: notification_manage.php,v 1.1 2011/12/29 14:32:55 ohwada Exp $

// 2007-11-01 K.OHWADA
// weblinks_admin_print_footer()

//=========================================================
// WebLinks Module
// 2007-09-01 K.OHWADA
//=========================================================

include 'admin_header.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/api/admin.php';

//=========================================================
// class admin_notification_manage
//=========================================================
class admin_notification_manage
{
	var $_DIRNAME = WEBLINKS_DIRNAME;

	var $_admin;

	var $_TEMPLATE = 'db:system_notification_select.html';

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_notification_manage()
{
	$this->_admin =& happy_linux_admin::getInstance();
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_notification_manage();
	}
	return $instance;
}

//---------------------------------------------------------
// show form
//---------------------------------------------------------
function show_form()
{
	echo $this->build_style();
	echo $this->fetch_template();
}

function fetch_template()
{
	$xoopsTpl = new XoopsTpl();

	global $xoopsConfig, $xoopsModule, $xoopsUser;
	include XOOPS_ROOT_PATH . '/include/notification_select.php';

	$text = $xoopsTpl->fetch( $this->_TEMPLATE );
	return $text;
}

function build_style()
{
	$text = <<<END_OF_TEXT
<style type="text/css">
table.outer
{
	width: 100%;
}
</style>
END_OF_TEXT;

	return $text;
}

function print_xoops_version()
{
	$url = XOOPS_URL . '/modules/'. $this->_DIRNAME .'/index.php';

	$this->_admin->_preload_file();

	$ver = $this->_admin->_judge_version();
	switch ( $ver )
	{
		case 'xoops_cube_21':
			$ret = false;
			break;

		case 'xoops_22':
			$ret = false;
			break;

		case 'xoops_20':
		default:
			$ret = true;
			break;
	}

	echo "<br />\n";
	echo _AM_WEBLINKS_NOTIFICATION_MANAGE_NOT_USE . "<br />\n";
	echo '<a href="'.$url.'">'._AM_WEBLINKS_NOTIFICATION_MANAGE_PLEASE.'</a><br />'."\n";
	echo "<br />\n";

	$this->_admin->_print_judge( $ver );

	return $ret;
}

// --- class end ---
}

//=========================================================
// main
//=========================================================
$manage =& admin_notification_manage::getInstance();

xoops_cp_header();
weblinks_admin_print_header();
weblinks_admin_print_menu();

echo "<h3>"._AM_WEBLINKS_NOTIFICATION_MANAGE."</h3>\n";
echo _AM_WEBLINKS_NOTIFICATION_MANAGE_DESC."<br />\n";

$ret = $manage->print_xoops_version();
if ( $ret )
{
	$manage->show_form();
}

weblinks_admin_print_footer();
xoops_cp_footer();
exit();

?>