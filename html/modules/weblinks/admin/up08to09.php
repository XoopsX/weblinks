<?php
// $Id: up08to09.php,v 1.1 2011/12/29 14:32:56 ohwada Exp $

// 2005-01-20 K.OHWADA
// add rss_mode_title, rss_mode_content
// add zip, state, city, addr2, fax

//================================================================
// version up 0.8 to 0.9
// 2004-11-24 K.OHWADA
//================================================================

include '../../../mainfile.php';
include '../../../include/cp_header.php';

global $xoopsDB, $xoopsUser, $xoopsModule;
xoops_cp_header();

echo "<h4>update v0.8 to v0.9</h4>\n";

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
$table_link     = $xoopsDB->prefix( $MODULE_DIRNAME."_link" );
$table_modify   = $xoopsDB->prefix( $MODULE_DIRNAME."_modify" );
$table_atomfeed = $xoopsDB->prefix( $MODULE_DIRNAME."_atomfeed" );
$table_config   = $xoopsDB->prefix( $MODULE_DIRNAME."_config" );


// --- config table ---
echo "<h4>create config table</h4>";
delete_table($table_config);
create_config($table_config);

// --- atomfeed table ---
echo "<h4>create atomfeed table</h4>";
//delete_table($table_atomfeed);
create_atomfeed($table_atomfeed);

// --- link table ---
echo "<h4>modify link_table</h4>\n";
alter_link($table_link);

// --- modify table ---
echo "<h4>modify modify_table</h4>\n";
alter_link($table_modify);

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


function delete_table($table)
{
	$sql = "DROP TABLE $table";
	sql_exec($sql);
}

function create_config($table_config)
{

$sql1 = "
CREATE TABLE $table_config (
  auth_submit      varchar(255) NOT NULL default '',
  auth_submit_auto varchar(255) NOT NULL default '',
  auth_modify      varchar(255) NOT NULL default '',
  auth_modify_auto varchar(255) NOT NULL default '',
  auth_ratelink    varchar(255) NOT NULL default '',
  use_passwd     tinyint(2) unsigned NOT NULL default '0',
  use_ratelink   tinyint(2) unsigned NOT NULL default '0',
  rss_mode_auto    tinyint(2) unsigned NOT NULL default '0',
  rss_mode_data    tinyint(2) unsigned NOT NULL default '0',
  rss_mode_title   tinyint(2) unsigned NOT NULL default '0',
  rss_mode_content tinyint(2) unsigned NOT NULL default '0',
  rss_cache_time   int(10) unsigned NOT NULL default '0',
  rss_limit        int(10) unsigned NOT NULL default '0',
  rss_new          int(10) unsigned NOT NULL default '0',
  rss_perpage      int(10) unsigned NOT NULL default '0',
  rss_num_content  int(10) unsigned NOT NULL default '0',
  rss_max_content  int(10) unsigned NOT NULL default '0',
  rss_max_summary  int(10) unsigned NOT NULL default '0',
  rss_site       text default NULL,
  rss_black      text default NULL,
  rss_white      text default NULL,
  post_title     tinyint(4) unsigned NOT NULL default '0',
  post_category  tinyint(4) unsigned NOT NULL default '0',
  post_url       tinyint(4) unsigned NOT NULL default '0',
  post_desc      tinyint(4) unsigned NOT NULL default '0',
  post_banner    tinyint(4) unsigned NOT NULL default '0',
  post_rss_url   tinyint(4) unsigned NOT NULL default '0',
  post_name      tinyint(4) unsigned NOT NULL default '0',
  post_mail      tinyint(4) unsigned NOT NULL default '0',
  post_company   tinyint(4) unsigned NOT NULL default '0',
  post_zip       tinyint(4) unsigned NOT NULL default '0',
  post_state     tinyint(4) unsigned NOT NULL default '0',
  post_city      tinyint(4) unsigned NOT NULL default '0',
  post_addr      tinyint(4) unsigned NOT NULL default '0',
  post_addr2     tinyint(4) unsigned NOT NULL default '0',
  post_tel       tinyint(4) unsigned NOT NULL default '0',
  post_fax       tinyint(4) unsigned NOT NULL default '0',
  post_passwd    tinyint(4) unsigned NOT NULL default '0',
  post_usercomment tinyint(4) unsigned NOT NULL default '0',
  type_desc    tinyint(2) unsigned NOT NULL default '0',
  check_double tinyint(2) unsigned NOT NULL default '0',
  cat_sel        int(10) unsigned NOT NULL default '0',
  cat_sub        int(10) unsigned NOT NULL default '0',
  cat_img_mode   tinyint(2) unsigned NOT NULL default '0',
  cat_img_width  int(10) unsigned NOT NULL default '0',
  cat_img_height int(10) unsigned NOT NULL default '0'
) TYPE=MyISAM
";

	$sql2 = "INSERT INTO $table_config VALUES ('&1&', '&1&', '&1&', '&1&', '&1&2&3&', 1, 1, 1, 0, 0, 0, 24, 1000, 10, 10, 1, 1000, 200, '', '', '', 2, 2, 2, 2, 1, 1, 1, 1, 1, 0, 0, 0, 1, 0, 1, 0, 1, 1, 1, 1, 4, 5, 1, 150, 100)";

	sql_exec($sql1);
	sql_exec($sql2);
}

function create_atomfeed($table_atomfeed)
{

$sql = "
CREATE TABLE $table_atomfeed (
  aid int(11) unsigned NOT NULL auto_increment,
  lid int(11) unsigned NOT NULL default '0',
  site_title varchar(100) NOT NULL default '',
  site_url   varchar(255) NOT NULL default '',
  title varchar(100) NOT NULL default '',
  url   varchar(255) NOT NULL default '',
  entry_id   varchar(255) NOT NULL default '',
  guid       varchar(255) NOT NULL default '',
  time_modified int(10) NOT NULL default '0',
  time_issued   int(10) NOT NULL default '0',
  time_created  int(10) NOT NULL default '0',
  author_name  varchar(100) NOT NULL default '',
  author_url   varchar(255) NOT NULL default '',
  author_email varchar(255) default NULL,
  content text default NULL,
  PRIMARY KEY  (aid),
  KEY url (url),
  KEY modified (time_modified)
) TYPE=MyISAM
";

	sql_exec($sql);
}

function alter_link($table)
{
	$sql  = "ALTER TABLE $table ADD COLUMN ";
	$sql .= "zip varchar(100) default NULL";
	sql_exec($sql);

	$sql  = "ALTER TABLE $table ADD COLUMN ";
	$sql .= "state varchar(100) default NULL";
	sql_exec($sql);

	$sql  = "ALTER TABLE $table ADD COLUMN ";
	$sql .= "city varchar(100) default NULL";
	sql_exec($sql);

	$sql  = "ALTER TABLE $table ADD COLUMN ";
	$sql .= "addr2 varchar(255) default NULL";
	sql_exec($sql);

	$sql  = "ALTER TABLE $table ADD COLUMN ";
	$sql .= "fax varchar(255) default NULL";
	sql_exec($sql);

	$sql  = "ALTER TABLE $table MODIFY ";
	$sql .= "rss_xml mediumtext NOT NULL default ''";
	sql_exec($sql);

}

?>