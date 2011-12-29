<?php
// $Id: my11_to_web05.php,v 1.1 2011/12/29 14:32:56 ohwada Exp $

//================================================================
// porting from mylinks to weblinks
// 2004/01/14 K.OHWADA
//================================================================

include '../../../mainfile.php';
include '../../../include/cp_header.php';

global $xoopsDB,$xoopsUser,$xoopsModule;
xoops_cp_header();

$flag = false;
if ($xoopsUser && $xoopsUser->isAdmin($xoopsModule->mid())) 
{	$flag = true;	}

if (!$flag)
{
	echo "<font color=red>you are not admin</font><br>";
	xoops_cp_footer();
	exit();
}

// --- category table ---
echo "<h3>category table</h3>";
$sql1 = "SELECT * FROM ".$xoopsDB->prefix("mylinks_cat")." ORDER BY cid";
$result1 = sql_exec($sql1);

$category = array();

while ($row = $xoopsDB->fetchArray($result1))
{
	$cid    = $row['cid'];
	$pid    = $row['pid'];
	$title  = addslashes($row['title']);
	$banner = addslashes($row['imgurl']);

	echo "$cid: $title <br>";

	$category[$cid] = $title;

	$sql  = "INSERT INTO ".$xoopsDB->prefix("weblinks_category")." (";
	$sql .= "cid, pid, title, imgurl, cflag, lflag";
	$sql .= ") VALUES (";
	$sql .= "$cid, $pid, '$title', '$imgurl', 1, 1";
	$sql .= ")";

	sql_exec($sql);
}

// --- link table ---
echo "<h3>link table</h3>";
$sql2 = "SELECT * FROM ".$xoopsDB->prefix("mylinks_links")." ORDER BY lid";
$result2 = sql_exec($sql2);

$shots_url = XOOPS_URL."/modules/".$xoopsModule->dirname()."/images/shots/";

while ($row = $xoopsDB->fetchArray($result2))
{
	$lid    = $row['lid'];
	$uid    = $row['submitter'];
	$cid    = $row['cid'];
	$url    = $row['url'];
	$title  = addslashes($row['title']);
	$time_create = $row['date'];
	$time_update = $time_create;
	$hits     = $row['hits'];
	$rating   = $row['rating'];
	$votes    = $row['votes'];
	$comments = $row['comments']; 
	$passwd = md5(rand(10000000,99999999));
	$cids   = "&$cid&";

	$banner = $shots_url.$row['logourl'];
	$banner = addslashes($banner);

	$category[$cid] = $title;

	$sql3 = "SELECT * FROM ".$xoopsDB->prefix("mylinks_text")." WHERE lid=$lid";
	$result3 = sql_exec($sql3);
	$row3    = $xoopsDB->fetchArray($result3);
	$desc    = $row3['description'];
	$description = addslashes($desc);

	$cat    = addslashes($category[$cid]);
	$search = "$url $title $cat $description";

	$desc = substr($desc,0,100);
	echo "$lid: $title: $desc <br>";

	$sql  = "INSERT INTO ".$xoopsDB->prefix("weblinks_link")." (";
	$sql .= "lid, uid, cids, title, url, banner, description, ";
	$sql .= "search, passwd, time_create, time_update, ";
	$sql .= "hits, rating, votes, comments";
	$sql .= ") VALUES (";
	$sql .= "$lid, $uid, '$cids', '$title', '$url', '$banner', '$description', ";
	$sql .= "'$search', '$passwd', $time_create, $time_update, ";
	$sql .= "$hits, $rating, $votes, $comments";
	$sql .= ")";

	sql_exec($sql);
}

// --- votedata table ---
echo "<h3>votedata table</h3>";
$sql4  = "INSERT INTO ".$xoopsDB->prefix("weblinks_votedata")." ";
$sql4 .= "SELECT * FROM ".$xoopsDB->prefix("mylinks_votedata")."";
sql_exec($sql4);

echo "<h3>end</h3>";
xoops_cp_footer();
exit();


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
