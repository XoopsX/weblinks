<?php
// $Id: up06to07.php,v 1.1 2011/12/29 14:32:52 ohwada Exp $

//================================================================
// version up 0.6 to 0.7
// 2004/08/10 K.OHWADA
//================================================================

include '../../../mainfile.php';
include '../../../include/cp_header.php';

global $xoopsDB, $xoopsUser, $xoopsModule;
xoops_cp_header();

echo "<h4>update v0.6 to v0.7</h4>\n";

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
$table_catlink  = $MODULE_DIRNAME."_catlink";
$table_catlink  = $xoopsDB->prefix($table_catlink);

// --- catlink table ---
echo "<h3>create catlink table</h3>";
delete_catlink($table_catlink);
create_catlink($table_catlink);

// --- link table ---
echo "<h3>add column link table</h3>";
alter_link($table_link);

// --- link table ---
echo "<h3>read link table</h3>";
$sql2 = "SELECT * FROM $table_link ORDER BY lid";
$result2 = sql_exec($sql2);

while ($row = $xoopsDB->fetchArray($result2))
{
	$lid    = $row['lid'];
	$cids   = $row['cids'];
	$banner = $row['banner'];

	$arr = getCidArray($cids);

	echo "$lid: $cids : $banner : ";

// banner size to link table
	if ($banner)
	{
		if ( !preg_match("/^https?:/",$banner) )
		{
			$banner = XOOPS_ROOT_PATH.$banner;
			echo "$banner : ";
		}

		$size = GetImageSize($banner);
	
		if ($size)
		{
			$width  = (int)$size[0];
			$height = (int)$size[1];

			$sql  = "UPDATE $table_link SET ";
			$sql .= "width=$width, ";
			$sql .= "height=$height ";
			$sql .= "WHERE lid=$lid";
			sql_exec($sql);
		}
		else
		{
			echo "<font color=red>banner connect error</font><br>";
		}
	}

// catlink
	foreach ($arr as $cid)
	{
		echo "$cid ";

		$sql  = "INSERT INTO $table_catlink ";
		$sql .= " (cid, lid) ";
		$sql .= " VALUES ($cid, $lid) ";

		sql_exec($sql);
	}

	echo "<br>\n";
}

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

function delete_catlink($table_catlink)
{
	global $xoopsDB;

	$sql = "DROP TABLE $table_catlink";
	sql_exec($sql);
}

function create_catlink($table_catlink)
{
	global $xoopsDB;

$sql = "
CREATE TABLE $table_catlink (
  jid int(11) unsigned NOT NULL auto_increment,
  cid int(4)  unsigned NOT NULL default '0',
  lid int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (jid),
  KEY lid (lid),
  KEY cid (cid)
) TYPE=MyISAM
";

	sql_exec($sql);
}

function alter_link($table_link)
{
	$sql  = "ALTER TABLE $table_link ADD COLUMN ";
	$sql .= "width  int(5) unsigned NOT NULL default '0'";
	sql_exec($sql);

	$sql  = "ALTER TABLE $table_link ADD COLUMN ";
	$sql .= "height int(5) unsigned NOT NULL default '0'";
	sql_exec($sql);
}

function getCidArray($cids)
{
	$split = split('&',$cids);

	$i = 0;	
	$array = array();
	foreach ($split as $cid)
	{
		if ($cid == '')  continue;
		$array[$i++] = $cid;
	}

	$array = array_unique($array);

	return $array;
}

function sql_exec($sql)
{ 
	global $xoopsDB;

	$ret = $xoopsDB->queryF($sql);
	if ($ret != false ) { return $ret; }

	$error = $xoopsDB->error();
	echo "<font color=red>$sql<br>$error</font><br>";

	return false;
}

?>