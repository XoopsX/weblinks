<?php
// $Id: my11_to_web09.php,v 1.1 2011/12/29 14:32:54 ohwada Exp $

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication

//=========================================================
// WebLinks Module
// transfer from mylinks 1.1 to weblinks 0.9
// 2005-01-20 K.OHWADA
//================================================================

include '../../../mainfile.php';
include '../../../include/cp_header.php';

global $xoopsDB, $xoopsUser, $xoopsModule;
xoops_cp_header();

$LIMIT = 100;

$flag = false;
if ($xoopsUser && $xoopsUser->isAdmin($xoopsModule->mid())) 
{	$flag = true;	}

if (!$flag)
{
	echo "<font color=red>you are not admin</font><br />";
	xoops_cp_footer();
	exit();
}

$op = 'main';
if ( isset($_POST['op']) )  $op = $_POST['op'];

// dir name
$MODULE_DIRNAME = $xoopsModule->dirname();
$MODULE_ROOT    = XOOPS_ROOT_PATH."/modules/".$MODULE_DIRNAME;
$MODULE_URL     = XOOPS_URL."/modules/".$MODULE_DIRNAME;

echo "<h3>Transfer DB mylinks v1.1 to weblinks v0.9</h3>\n";

switch ($op) 
{
case "trans_image":
	trans_image();
	break;

case "trans_category":
	trans_category();
	break;

case "trans_link":
	trans_link();
	break;

case "trans_votedate":
	trans_votedate();
	break;

case "trans_comment":
	trans_comment();
	break;

case "create":
	create();
	echo "<br /><hr>";
	first_step();
	break;

case 'main':
default:
	first_step();
	break;

}

xoops_cp_footer();
exit();


function first_step()
{
	global $LIMIT;

	$action = xoops_getenv('PHP_SELF');

?>
<br />
There are 4 steps. <br />
1. transfer shot images <br />
2. transfer category table <br />
3. transfer link table <br />
   excute each <?php echo $LIMIT; ?> links at a time <br />
4. transfer votedate table <br />
5. transfer comment table <br />
<br />
Preparation <br />
Please enable to be writable of cache directory. <br />
<br />
Nitice <br />
This program don't transfer modify and broken table. <br />
<br />
<h4>STEP 1 : transfer shot images</h4>
<form action='<?php echo $action; ?>' method='post'>
<input type='hidden' name='op' value='trans_image'>
<input type='submit' value='GO STEP 1'>
</form>
<br />
<h4>STEP 0 : initalize</h4>
Drop and create tables.<br />
If you want to redo <br />
<br />
<form action='<?php echo $action; ?>' method='post'>
<input type='hidden' name='op' value='create'>
<input type='submit' value='GO STEP 0'>
</form>
<?php

}

function trans_image()
{
	echo "<h4>STEP 1 : transfer shot images</h4>\n";

	$shots_dir_my  = XOOPS_ROOT_PATH."/modules/mylinks/images/shots/";

//	$shots_dir_web = XOOPS_ROOT_PATH."/modules/weblinks/images/shots/";
	$shots_dir_web = $MODULE_ROOT."/images/shots/";

	$file_arr = array();

	$dir = opendir($shots_dir_my);
	while ($file = readdir($dir) )
	{
		if ( $file == 'index.html' ) continue; 

		$file_full = $shots_dir_my.$file;
		if ( !is_file($file_full) )  continue;

		$file_arr[] = $file;
	}

	$count = count($file_arr);
	echo "There are $count images <br /><br />\n";

	$error_flag = false;

	if ($count > 0)
	{
		if ( is_writable($shots_dir_web) )
		{
			foreach ($file_arr as $file)
			{
				$file_source = $shots_dir_my.$file;
				$file_dest   = $shots_dir_web.$file;
			
				if (copy($file_source, $file_dest)) 
				{
					echo "$file_source -> $file_dest <br />\n";
				}
				else
				{
					echo "$file: <font color='red'>copy failed : $file_source</font><br />\n";
					$error_flag = true;
				}
			}
		}
		else
		{
			echo "<font color='red'>not writable: $shots_dir_web</font><br />\n";
			$error_flag = true;
		}
	}

	if ($error_flag)
	{
		echo "<h4><font color='red'>some images failed</font></h4>\n";
		echo "Plaese copy manualy <br />\n";
	}

	$action = xoops_getenv('PHP_SELF');

?>
<br />
<hr>
<h4>STEP 2 : transfer category table</h4>
<form action='<?php echo $action; ?>' method='post'>
<input type='hidden' name='op' value='trans_category'>
<input type='submit' value='GO STEP 2'>
</form>
<?php

}

function trans_category()
{
// === category table ===
// --- mylinks ---
//  cid int(5)
//  pid int(5)
//  title varchar(50)
//  imgurl varchar(150)

// --- weblinks ---
//  cid int(5)
//  pid int(5)
//  title varchar(50)
//  imgurl varchar(255)
//
//  lflag tinyint(2)
//  orders int(4)

	global $xoopsDB;
	global $cat_title_arr;

	global $MODULE_DIRNAME;
	$table_category = $xoopsDB->prefix( $MODULE_DIRNAME.'_category' );

	echo "<h4>STEP 2 : transfer category table</h4>";
	$sql1 = "SELECT * FROM ".$xoopsDB->prefix("mylinks_cat")." ORDER BY cid";
	$res1 = sql_exec($sql1);

	$total = $xoopsDB->getRowsNum($res1);

	echo "There are $total categorys <br /><br />\n";

	global $cat_title_arr;
	$cat_title_arr = array();

	while ($row = $xoopsDB->fetchArray($res1))
	{
		$cid    = $row['cid'];
		$pid    = $row['pid'];
		$title  = addslashes( $row['title'] );
		$imgurl = addslashes( $row['imgurl'] );

		echo "$cid: $title <br />";

		$cat_title_arr[$cid] = $title;

		$sql  = "INSERT INTO ".$table_category." (";
		$sql .= "cid, pid, title, imgurl, lflag, orders";
		$sql .= ") VALUES (";
		$sql .= "$cid, $pid, '$title', '$imgurl', 1, 1";
		$sql .= ")";

		sql_exec($sql);
	}

	$action = xoops_getenv('PHP_SELF');

?>
<br />
<hr>
<h4>STEP 3 : transfer link table</h4>
<form action='<?php echo $action; ?>' method='post'>
<input type='hidden' name='op' value='trans_link'>
<input type='hidden' name='offset' value='0'>
<input type='submit' value='GO STEP 3'>
</form>
<?php

}


function trans_link()
{
// === link & text table ===
// --- mylinks ---
// --- link table ---
//  lid int(11)
//  cid int(5) => multi
//  title varchar(100)
//  url varchar(250)
//  logourl varchar(60)
//  submitter int(11)
//  status tinyint(2) => not use
//  date int(10)
//  hits int(11)
//  rating double(6,4)
//  votes int(11)
//  comments int(11)

// --- mylinks_text table ---
//  lid int(11)
//  description text
  
// --- weblinks ---
//  lid int(11)
//  cids  varchar(100) : use catlink
//  title varchar(100)
//  url varchar(255)
//  banner varchar(255) : full url
//  uid int(5) : submitter
//  time_create int(10)
//  time_update int(10)
//  hits int(11)
//  rating double(6,4)
//  votes int(11)
//  comments int(11)
//  description text
//
//  search text default
//  passwd varchar(255)
//
//  name varchar(255)
//  nameflag tinyint(2)
//  mail varchar(255)
//  mailflag tinyint(2)
//  company varchar(255)
//  addr varchar(255)
//  tel varchar(255)
//  admincomment text
//  width  int(5)
//  height int(5)
//  recommend tinyint(2)
//  mutual    tinyint(2)
//  broken int(11)
//  rss_url  varchar(255)
//  rss_flag tinyint(3)
//  rss_xml  mediumtext
//  rss_update int(10)
//  usercomment text
//  zip    varchar(100)
//  state  varchar(100)
//  city   varchar(100)
//  addr2  varchar(255)
//  fax    varchar(255)

	global $xoopsDB;
	global $LIMIT;
	global $cat_title_arr;

	echo "<h4>STEP 3: link table</h3>";

	global $MODULE_DIRNAME;
	$table_link = $xoopsDB->prefix( $MODULE_DIRNAME.'_link' );

	global $MODULE_URL;
	$shots_url_web = $MODULE_URL."/images/shots/";

	$offset = 0;
	if ( isset($_POST['offset']) )  $offset = $_POST['offset'];
	$next = $offset + $LIMIT;

	$table = $xoopsDB->prefix("mylinks_links");
	$sql1  = "SELECT count(*) FROM $table";
	$res1  = sql_exec($sql1);
	$row1  = $xoopsDB->fetchRow($res1);
	$total = $row1[0];

	echo "There are $total links <br />\n";
	echo "Transfer $offset - $next th link <br /><br />";

	$sql2 = "SELECT * FROM $table ORDER BY lid";
	$res2 = sql_exec($sql2, $LIMIT, $offset);

	while ($row = $xoopsDB->fetchArray($res2))
	{
		$lid      = $row['lid'];
		$uid      = $row['submitter'];
		$cid      = $row['cid'];
		$url      = $row['url'];
		$hits     = $row['hits'];
		$rating   = $row['rating'];
		$votes    = $row['votes'];
		$logourl  = $row['logourl'];
		$comments = $row['comments']; 
		$time_create = $row['date'];
		$time_update = $time_create;

		$title = addslashes( $row['title'] );

		$banner = '';
		$width  = 0;
		$height = 0;

		if ($logourl)
		{
			$banner = $shots_url_web.$logourl;
			$size   = GetImageSize($banner);

			if ($size)
			{
				$width  = (int)$size[0];
				$height = (int)$size[1];
			}
			else
			{
				echo "<font color='red'>image size error: $banner</font><br />";
			}

			$banner = addslashes( $banner );
		}

		$desc = get_desc($lid);
		$desc = addslashes( $desc );

		$cat    = addslashes( $cat_title_arr[$cid] );
		$search = "$url $title $cat $desc";

		$passwd = md5(rand(10000000,99999999));

		echo "$lid: $title <br />";

		$sql  = "INSERT INTO ".$table_link." (";
		$sql .= "lid, uid, title, url, description, ";
		$sql .= "search, passwd, time_create, time_update, ";
		$sql .= "hits, rating, votes, comments, ";
		$sql .= "banner, width, height";
		$sql .= ") VALUES (";
		$sql .= "$lid, $uid, '$title', '$url', '$desc', ";
		$sql .= "'$search', '$passwd', $time_create, $time_update, ";
		$sql .= "$hits, $rating, $votes, $comments, ";
		$sql .= "'$banner', $width, $height";
		$sql .= ")";

		sql_exec($sql);

		insert_catlink($cid, $lid);
	}

	if ( $total > $next )
	{
		form_next_link($next);
	}
	else
	{
		form_votedate();
	}

}

function get_desc($lid)
{
	global $xoopsDB;

	$sql  = "SELECT * FROM ".$xoopsDB->prefix("mylinks_text")." WHERE lid=$lid";
	$res  = sql_exec($sql);
	$row  = $xoopsDB->fetchArray( $res );
	$desc = $row['description'];
	
	return $desc;
}

function insert_catlink($cid, $lid)
{
	global $xoopsDB;

	global $MODULE_DIRNAME;
	$table_catlink = $xoopsDB->prefix( $MODULE_DIRNAME.'_catlink' );

	$sql  = "INSERT INTO ".$table_catlink." (";
	$sql .= "cid, lid";
	$sql .= ") VALUES (";
	$sql .= "$cid, $lid";
	$sql .= ")";

	sql_exec($sql);
}

function form_next_link($next)
{
	global $LIMIT;

	$action = xoops_getenv('PHP_SELF');
	$submit = "GO next $LIMIT links";
	$next2  = $next + $LIMIT;

?>
<br />
<hr>
<h4>STEP 3 : transfer link table</h4>
Transfer <?php echo $next; ?> - <?php echo $next2; ?> th link<br />
<br />
<form action='<?php echo $action; ?>' method='post'>
<input type='hidden' name='op' value='trans_link'>
<input type='hidden' name='offset' value='<?php echo $next; ?>'>
<input type='submit' value='<?php echo $submit; ?>'>
</form>
<?php

}

function form_votedate()
{
	$action = xoops_getenv('PHP_SELF');

?>
<br />
<hr>
<h4>STEP 4 : transfer votedate table</h4>
<form action='<?php echo $action; ?>' method='post'>
<input type='hidden' name='op' value='trans_votedate'>
<input type='submit' value='GO STEP 4'>
</form>
<?php

}

function trans_votedate()
{
	global $xoopsDB;

	global $MODULE_DIRNAME;
	$table_votedata = $xoopsDB->prefix( $MODULE_DIRNAME.'_votedata' );

	echo "<h4>STEP 4 : tansfer votedata table</h4>";

	$sql  = "INSERT INTO ".$table_votedata." ";
	$sql .= "SELECT * FROM ".$xoopsDB->prefix("mylinks_votedata")."";
	sql_exec($sql);

	$action = xoops_getenv('PHP_SELF');
	$submit = "excute";

?>
<br />
<hr>
<h4>STEP 5 : transfer comment table</h4>
<form action='<?php echo $action; ?>' method='post'>
<input type='hidden' name='op' value='trans_comment'>
<input type='submit' value='GO STEP 5'>
</form>
<?php

}


function trans_comment()
{
	global $xoopsDB;
	global $xoopsModule;

	echo "<h4>STEP 5 : tansfer comment table</h4>";

// table name
	$table_com  = $xoopsDB->prefix("xoopscomments");

// module id
	$module_handler =& xoops_gethandler('module');
	$module         =& $module_handler->getByDirname('mylinks');
	$mid_my         = $module->getVar('mid');

	$com_id_arr = array();

// constant
	$com_modid = $xoopsModule->getVar('mid');

	$sql1 = "SELECT * FROM $table_com WHERE com_modid=$mid_my ORDER BY com_id ";
	$res1 = sql_exec($sql1);

	$total = $xoopsDB->getRowsNum($res1);

	echo "There are $total comments <br /><br />\n";

	while ( $row1 = $xoopsDB->fetchArray($res1) )
	{
		$com_id       = $row1['com_id'];
		$com_pid      = $row1['com_pid'];
		$com_icon     = $row1['com_icon'];
		$com_sig      = $row1['com_sig'];
		$com_status   = $row1['com_status'];
		$com_exparams = $row1['com_exparams'];
		$com_itemid   = $row1['com_itemid'];
		$com_uid      = $row1['com_uid'];
		$com_ip       = $row1['com_ip'];
		$com_title    = $row1['com_title'];
		$com_text     = $row1['com_text'];
		$com_created  = $row1['com_created'];
		$com_modified = $row1['com_modified'];

		$dohtml   = $row1['dohtml'];
		$dosmiley = $row1['dosmiley'];
		$doxcode  = $row1['doxcode'];
		$doimage  = $row1['doimage'];
		$dobr     = $row1['dobr'];

		echo "$com_id: $com_title <br />";

// xoopscomments table
		$sql  = "INSERT INTO $table_com ";
		$sql .= "(com_modid, com_itemid, com_icon, com_created, com_modified, com_uid, com_ip, com_title, com_text, com_sig, com_status, com_exparams, dohtml, dosmiley, doxcode, doimage, dobr)";
		$sql .= "VALUES ";
		$sql .= "($com_modid, $com_itemid, '$com_icon', $com_created, $com_modified, $com_uid, '$com_ip', '$com_title', '$com_text', $com_sig, $com_status, '$com_exparams', $dohtml, $dosmiley, $doxcode, $doimage, $dobr)";

		sql_exec($sql);

		$newid = $xoopsDB->getInsertId();

		$com_id_new     = $newid;
		$com_rootid_new = $newid;
		$com_pid_new    = 0;

		if ( $com_pid )
		{
			if ( isset( $com_id_arr[$com_pid] ) )
			{
				$com_rootid_new = $com_id_arr[$com_pid]['com_rootid_new'];
				$com_pid_new    = $com_id_arr[$com_pid]['com_id_new'];
			}
			else
			{
				echo "<font color='red'>pid convert error: $com_id </font><br />";
			}
		}

		$sql  = "UPDATE $table_com SET ";
		$sql .= "com_rootid=$com_rootid_new, ";
		$sql .= "com_pid=$com_pid_new ";
		$sql .= "WHERE com_id=$com_id_new";

		sql_exec($sql);

		$com_id_arr[$com_id]['com_id_new']     = $com_id_new;
		$com_id_arr[$com_id]['com_rootid_new'] = $com_rootid_new;
	}

	echo "<br /><hr>\n";
	echo "<h4>FINISHED</h4>\n";
	echo "<a href='index.php'>GOTO Admin Menu</a><br />\n";

}

function create()
{
	global $xoopsDB;
	global $MODULE_DIRNAME;

	$table1 = $xoopsDB->prefix( $MODULE_DIRNAME."_category" );
	$table2 = $xoopsDB->prefix( $MODULE_DIRNAME."_link" );
	$table3 = $xoopsDB->prefix( $MODULE_DIRNAME."_catlink" );
	$table4 = $xoopsDB->prefix( $MODULE_DIRNAME."_votedata" );

	delete_table($table1);
	delete_table($table2);
	delete_table($table3);
	delete_table($table4);

	create_category($table1);
	create_link($table2);
	create_catlink($table3);
	create_votedata($table4);

	clear_comment();
}

function delete_table($table)
{
	$sql = "DROP TABLE $table";
	sql_exec($sql);
}

function create_category($table)
{
	echo "<h4>create category table</h4>\n";

$sql = "
CREATE TABLE $table (
  cid int(5) unsigned NOT NULL auto_increment,
  pid int(5) unsigned NOT NULL default '0',
  title varchar(50) NOT NULL default '',
  imgurl varchar(255) NOT NULL default '',
  cflag tinyint(2) NOT NULL default '0',
  lflag tinyint(2) NOT NULL default '0',
  tflag tinyint(2) NOT NULL default '0',
  displayimg int(10) NOT NULL default '0',
  description text NOT NULL default '',
  catdescription text NOT NULL default '',
  catfooter text NOT NULL default '',
  groupid varchar(255) default NULL,
  orders int(4) NOT NULL default '1',
  editaccess varchar(255) NOT NULL default '1 2 3',
  PRIMARY KEY  (cid),
  KEY pid (pid)
) TYPE=MyISAM
";

	sql_exec($sql);
}

function create_link($table)
{
	echo "<h4>create link table</h4>\n";

$sql = "
CREATE TABLE $table (
  lid int(11) unsigned NOT NULL auto_increment,
  uid int(5) unsigned NOT NULL default '0',
  cids  varchar(100) NOT NULL default '',
  title varchar(100) NOT NULL default '',
  url varchar(255) NOT NULL default '',
  banner varchar(255) NOT NULL default '',
  description text default NULL,
  name varchar(255) default NULL,
  nameflag tinyint(2) NOT NULL default '0',
  mail varchar(255) default NULL,
  mailflag tinyint(2) NOT NULL default '0',
  company varchar(255) default NULL,
  addr varchar(255) default NULL,
  tel varchar(255) default NULL,
  search text default NULL,
  passwd varchar(255) default NULL,
  admincomment text default NULL,
  mark char(3) default NULL,
  time_create int(10) NOT NULL default '0',
  time_update int(10) NOT NULL default '0',
  hits int(11) unsigned NOT NULL default '0',
  rating double(6,4) NOT NULL default '0.0000',
  votes int(11) unsigned NOT NULL default '0',
  comments int(11) unsigned NOT NULL default '0',
  width  int(5) unsigned NOT NULL default '0',
  height int(5) unsigned NOT NULL default '0',
  recommend tinyint(2) NOT NULL default '0',
  mutual    tinyint(2) NOT NULL default '0',
  broken int(11) unsigned NOT NULL default '0',
  rss_url  varchar(255) NOT NULL default '',
  rss_flag tinyint(3) NOT NULL default '0',
  rss_xml  mediumtext NOT NULL default '',
  rss_update int(10) NOT NULL default'0',
  usercomment text default NULL,
  zip    varchar(100) default NULL,
  state  varchar(100) default NULL,
  city   varchar(100) default NULL,
  addr2  varchar(255) default NULL,
  fax    varchar(255) default NULL,
  PRIMARY KEY  (lid),
  KEY uid (uid),
  KEY cids (cids),
  KEY title (title(40))
) TYPE=MyISAM
";

	sql_exec($sql);
}


function create_catlink($table)
{
	echo "<h4>create catlink table</h4>\n";

$sql = "
CREATE TABLE $table (
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

function create_votedata($table)
{
	echo "<h4>create votedata table</h4>\n";

$sql = "
CREATE TABLE $table (
  ratingid int(11) unsigned NOT NULL auto_increment,
  lid int(11) unsigned NOT NULL default '0',
  ratinguser int(11) unsigned NOT NULL default '0',
  rating tinyint(3) unsigned NOT NULL default '0',
  ratinghostname varchar(60) NOT NULL default '',
  ratingtimestamp int(10) NOT NULL default '0',
  PRIMARY KEY  (ratingid),
  KEY ratinguser (ratinguser),
  KEY ratinghostname (ratinghostname)
) TYPE=MyISAM
";

	sql_exec($sql);
}


function clear_comment()
{
	global $xoopsDB;
	global $xoopsModule;

	echo "<h4>clear comment table</h4>";

// table name
	$table_com = $xoopsDB->prefix("xoopscomments");

// constant
	$mid = $xoopsModule->getVar('mid');

	$sql = "DELETE FROM $table_com WHERE com_modid=$mid ";
	$res = sql_exec($sql);
}

function sql_exec($sql, $limit=0, $offset=0)
{ 
	global $xoopsDB;

	$ret = $xoopsDB->queryF($sql, $limit, $offset);
	if ($ret != false ) { return $ret; }

	$error = $xoopsDB->error();
	echo "<font color=red>$sql<br />$error</font><br />";

	return false;
}

?>
