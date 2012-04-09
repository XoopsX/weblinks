<?php
// $Id: rssc_lid_mod.php,v 1.1 2012/04/09 10:23:37 ohwada Exp $

//=========================================================
// WebLinks Module
// 2012-03-01 K.OHWADA
//=========================================================

//-------------------------------
// TODO
// $_POST['title'] = $title;
//-------------------------------

class rssc_lid_mod
{
	var $_LIMIT = 200;

	var $_db;

	var $_table_link;
	var $_table_rssc_link;

	var $_RSSC_DIRNAME = 'rssc';

function rssc_lid_mod( $dirname )
{
	global $xoopsDB;

	$this->_db = $xoopsDB;

	$this->_table_link = $this->_db->prefix( $dirname.'_link' );
	$this->_table_rssc_link = $this->_db->prefix( $this->_RSSC_DIRNAME.'_link' );

	$this->_rss_utility =& happy_linux_rss_utility::getInstance();
	$this->_rssc_edit_handler =& weblinks_get_handler( 'rssc_edit', $dirname );
}

function check_admin()
{
	global $xoopsUser, $xoopsModule;

	if ($xoopsUser && $xoopsUser->isAdmin($xoopsModule->mid())) {	
		return true;	
	}
	return false;
}

function main()
{
	$op = 'main';
	if ( isset($_POST['op']) ) $op = $_POST['op'];

	echo "<h3>rssc_lid_mod</h3>\n";

	switch ($op) 
	{
		case "clear_rssc_lid":
			echo "<h4>clear_rssc_lid</h4>";
			$this->clear_rssc_lid();
			$this->form_next_link(0);
			break;

		case "rssc_to_link":
			$this->rssc_to_link();
			break;

		case 'main':
		default:
			$this->form_clear();
		break;
	}
}

function rssc_to_link()
{
	echo "<h4>rssc link table</h4>";

	$offset = 0;
	if ( isset($_POST['offset']) )  $offset = $_POST['offset'];
	$next = $offset + $this->_LIMIT;

	$sql1  = "SELECT count(*) FROM ".$this->_table_rssc_link;
	$res1  = $this->sql_exec($sql1);
	$row1  = $this->_db->fetchRow($res1);
	$total = $row1[0];

	echo "There are $total rssc links <br />\n";
	echo "Transfer $offset - $next th link <br /><br />";

	$sql2 = "SELECT * FROM ".$this->_table_rssc_link." ORDER BY lid";
	$res2 = $this->sql_exec($sql2, $this->_LIMIT, $offset);

	while ($row = $this->_db->fetchArray($res2))
	{
		$lid   = $row['lid'];
		$title = $row['title'];
		$p1    = $row['p1'];

		$ret = $this->mod_rssc_lid( $p1, $lid );
		if ( $ret ) {
			echo "$lid : modified link <br />\n";
		}
	}

	if ( $total > $next ) {
		$this->form_next_link($next);
	} else {
		$this->finish();
	}

}

function clear_rssc_lid()
{
	$sql  = "UPDATE ".$this->_table_link;
	$sql .= " SET rssc_lid=0";

	return $this->sql_exec($sql);

//	echo " $sql <br>\n";
//	return true;
}

function mod_rssc_lid( $weblinks_lid, $rssc_lid )
{
	$sql  = "UPDATE ".$this->_table_link;
	$sql .= " SET rssc_lid=". $rssc_lid;
	$sql .= " WHERE lid=".$weblinks_lid;


	return $this->sql_exec($sql);

//	echo " $sql <br>\n";
//	return true;
}

function sql_exec($sql, $limit=0, $offset=0)
{ 
	$ret = $this->_db->queryF($sql, $limit, $offset);
	if ($ret != false ) { return $ret; }

	$error = $this->_db->error();
	echo "<font color=red>$sql<br />$error</font><br />";

	return false;
}

function form_clear()
{
	$action = xoops_getenv('PHP_SELF');

?>
<br />
<hr>
<h4>clear rssc_lid</h4>
<br />
<form action='<?php echo $action; ?>' method='post'>
<input type='hidden' name='op' value='clear_rssc_lid'>
<input type='submit' value='Clear'>
</form>
<?php

}

function form_next_link($next)
{
	$action = xoops_getenv('PHP_SELF');
	$submit = "GO next $this->_LIMIT links";
	$next2  = $next + $this->_LIMIT;
?>
<br />
<hr>
<h4>next link table</h4>
<?php echo $next; ?> - <?php echo $next2; ?> th link<br />
<br />
<form action='<?php echo $action; ?>' method='post'>
<input type='hidden' name='op' value='rssc_to_link'>
<input type='hidden' name='offset' value='<?php echo $next; ?>'>
<input type='submit' value='<?php echo $submit; ?>'>
</form>
<?php

}

function finish()
{
	echo "<br /><hr>\n";
	echo "<h4>FINISHED</h4>\n";
	echo "<a href='index.php'>GOTO Admin Menu</a><br />\n";
}

// --- class end ---
}

include 'admin_header.php';

if ( WEBLINKS_RSSC_USE ) {
	include_once WEBLINKS_RSSC_ROOT_PATH.'/api/lang_main.php';
	include_once WEBLINKS_RSSC_ROOT_PATH.'/api/view.php';
	include_once WEBLINKS_RSSC_ROOT_PATH.'/api/refresh.php';
	include_once WEBLINKS_RSSC_ROOT_PATH.'/api/manage.php';

	include_once WEBLINKS_ROOT_PATH.'/class/weblinks_rssc_handler.php';
	include_once WEBLINKS_ROOT_PATH.'/admin/rssc_manage_class.php';
}

xoops_cp_header();

if ( WEBLINKS_RSSC_USE ) {
	$rssc = new rssc_lid_mod( WEBLINKS_DIRNAME );

	if ( $rssc->check_admin() ) {
		$rssc->main();

	} else {
		xoops_error( 'you are not admin' );
	}

} else {
	xoops_error( 'require rssc module' );
}

xoops_cp_footer();
exit();

?>