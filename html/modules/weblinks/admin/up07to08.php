<?php
// $Id: up07to08.php,v 1.1 2011/12/29 14:32:54 ohwada Exp $

//================================================================
// version up 0.7 to 0.8
// 2004-10-20 K.OHWADA
//================================================================

include '../../../mainfile.php';
include '../../../include/cp_header.php';

global $xoopsDB,$xoopsUser,$xoopsModule;
xoops_cp_header();

echo "<h4>update v0.7 to v0.8</h4>\n";

// check permission
$flag = false;
if ($xoopsUser && $xoopsUser->isAdmin($xoopsModule->mid())) 
{	$flag = true;	}

if (!$flag)
{
	echo "<font color=red>you are not admin</font><br>";
	xoops_cp_footer();
	exit();
}

$op = '';
if ( isset($_POST['op']) )  $op = $_POST['op'];

if ($op != 'excute')
{
	print_form_start();
	xoops_cp_footer();
	exit();
}

// table name
$MODULE_DIRNAME = $xoopsModule->dirname();
$table_link     = $MODULE_DIRNAME."_link";
$table_link     = $xoopsDB->prefix($table_link);
$table_modify   = $MODULE_DIRNAME."_modify";
$table_modify   = $xoopsDB->prefix($table_modify);

// --- link table ---
echo "<h4>add column to link table</h4>\n";

$sql  = "ALTER TABLE $table_link ADD COLUMN ";
$sql .= "recommend tinyint(2) NOT NULL default '0'";
sql_exec($sql);

$sql  = "ALTER TABLE $table_link ADD COLUMN ";
$sql .= "mutual tinyint(2) NOT NULL default '0'";
sql_exec($sql);

$sql  = "ALTER TABLE $table_link ADD COLUMN ";
$sql .= "broken int(11) unsigned NOT NULL default '0'";
sql_exec($sql);

$sql  = "ALTER TABLE $table_link ADD COLUMN ";
$sql .= "rss_url  varchar(255) NOT NULL default ''";
sql_exec($sql);

$sql  = "ALTER TABLE $table_link ADD COLUMN ";
$sql .= "rss_flag tinyint(3) NOT NULL default '0'";
sql_exec($sql);

$sql  = "ALTER TABLE $table_link ADD COLUMN ";
$sql .= "rss_xml  text NOT NULL default ''";
sql_exec($sql);

$sql  = "ALTER TABLE $table_link ADD COLUMN ";
$sql .= "rss_update int(10) NOT NULL default'0'";
sql_exec($sql);

$sql  = "ALTER TABLE $table_link ADD COLUMN ";
$sql .= "usercomment text default NULL";
sql_exec($sql);

echo "<h4>add column to modify table</h4>\n";

$sql  = "ALTER TABLE $table_modify ADD COLUMN ";
$sql .= "recommend tinyint(2) NOT NULL default '0'";
sql_exec($sql);

$sql  = "ALTER TABLE $table_modify ADD COLUMN ";
$sql .= "mutual tinyint(2) NOT NULL default '0'";
sql_exec($sql);

$sql  = "ALTER TABLE $table_modify ADD COLUMN ";
$sql .= "broken int(11) unsigned NOT NULL default '0'";
sql_exec($sql);

$sql  = "ALTER TABLE $table_modify ADD COLUMN ";
$sql .= "rss_url  varchar(255) NOT NULL default ''";
sql_exec($sql);

$sql  = "ALTER TABLE $table_modify ADD COLUMN ";
$sql .= "rss_flag tinyint(3) NOT NULL default '0'";
sql_exec($sql);

$sql  = "ALTER TABLE $table_modify ADD COLUMN ";
$sql .= "rss_xml  text NOT NULL default ''";
sql_exec($sql);

$sql  = "ALTER TABLE $table_modify ADD COLUMN ";
$sql .= "rss_update int(10) NOT NULL default'0'";
sql_exec($sql);

$sql  = "ALTER TABLE $table_modify ADD COLUMN ";
$sql .= "usercomment text default NULL";
sql_exec($sql);

echo "<h4>end</h4>\n";
echo "<a href='index.php'>goto admin index</a><br>\n";
xoops_cp_footer();
exit();


function print_form_start()
{

	$action = xoops_getenv('PHP_SELF');

?>
<h4><font color='blue'>Warnig</font></h4>
Excute only once, after update. <br />
This program overwrite MySQL tables. <br />
<br />
<form action='<?php echo $action; ?>' method='post'>
<input type='hidden' name='op' value='excute'>
<input type='submit' value='EXCUTE'>
</form>
<?php

}

function sql_exec($sql)
{ 
	global $xoopsDB;

	$ret = $xoopsDB->queryF($sql);
	if ($ret != false ) { return $ret; }

	$error = $xoopsDB->error();
	echo "<font color='red'>$sql<br>$error</font><br>";

	return false;
}

?>