<?php
// $Id: gen_mylinks.php,v 1.2 2011/12/29 19:54:56 ohwada Exp $

//================================================================
// WebLinks Module
// 2006-09-20 K.OHWADA
//================================================================

// ---------------------------------------------------------------
// 2011-12-29 K.OHWADA
// PHP 5.3 : Assigning the return value of new by reference is now deprecated.
// ---------------------------------------------------------------

include_once 'dev_header.php';

//=========================================================
// class dev_genarate_mylinks
//=========================================================
class weblinks_genarate_mylinks extends weblinks_gen_record
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_genarate_mylinks()
{
	$this->weblinks_gen_record();
}

//---------------------------------------------------------
// category table
//---------------------------------------------------------
//  cid int(5)
//  pid int(5)
//  title varchar(50)
//  imgurl varchar(150)

function gen_mylinks_category( $MAX_CAT, $MAX_PARENT )
{
	echo "<h4>generete category table</h4>\n";
	srand( (double)microtime()*1000000 );
	$imgurl_dir = XOOPS_URL."/modules/mylinks/images/category/";

// contant
	$pid = 0;

	for ($i=0; $i<$MAX_PARENT; $i++)
	{
// randum data
		$title  = "main_". $this->get_randum_title();
		$imgurl = $imgurl_dir . sprintf( "%01d", rand(0, 9) ) . ".gif";

// category table
		$this->insert_mylinks_category($pid, $title, $imgurl);
	}

//$newid = $this->getInsertId();

	echo "<br>";

// contant
		$imgurl = '';

	for ($i=0; $i<($MAX_CAT - $MAX_PARENT); $i++)
	{
// randum data
		$title  = "sub_". $this->get_randum_title();
		$max_pid = intval( ($MAX_PARENT + $i) / 2 );
		$pid     = rand(1, $max_pid);

// ctegory table
		$this->insert_mylinks_category($pid, $title, $imgurl);
	}
}

function insert_mylinks_category($pid, $title, $imgurl)
{
	$category_table = $this->db_prefix("mylinks_cat");

// category table
	$sql  = "INSERT INTO $category_table ";
	$sql .= "(pid, title, imgurl)";
	$sql .= "VALUES ";
	$sql .= "($pid, '$title', '$imgurl')";

	$this->query($sql);
}

//---------------------------------------------------------
// link table
//---------------------------------------------------------
// --- link table ---
//  lid int(11)
//  cid int(5)
//  title varchar(100)
//  url varchar(250)
//  logourl varchar(60)
//  submitter int(11)
//  status tinyint(2)
//  date int(10)
//  hits int(11)
//  rating double(6,4)
//  votes int(11)
//  comments int(11)

// --- mylinks_text table ---
//  lid int(11)
//  description text

function gen_mylinks_link( $MAX_LINK, $MAX_CAT )
{
	echo "<h4>generete link table</h4>\n";
	srand( (double)microtime()*1000000 );

// table name
	$link_table = $this->db_prefix("mylinks_links");
	$text_table = $this->db_prefix("mylinks_text");

// constant
	$rating   = 0;
	$votes    = 0;
	$comments = 0;
	$status   = 1;

	for ($i=0; $i<$MAX_LINK; $i++)
	{
// randum data
		$cid       = rand(1, $MAX_CAT);
		$submitter = rand(0, 10);
		$hits      = rand(0, 100);
		$title     = $this->get_randum_title();
		$logourl   = $this->get_randum_image();
		$date      = $this->get_randum_time();

// other
		$url    = "http://$title/";
		$desc   = "$title\n $date\n";

// link table
		$sql  = "INSERT INTO $link_table (";
		$sql .= "cid, submitter, title, url, ";
		$sql .= "date, status, ";
		$sql .= "hits, rating, votes, comments, ";
		$sql .= "logourl";
		$sql .= ") VALUES (";
		$sql .= "$cid, $submitter, '$title', '$url', ";
		$sql .= "$date, $status, ";
		$sql .= "$hits, $rating, $votes, $comments, ";
		$sql .= "'$logourl'";
		$sql .= ")";
		$this->query($sql);
		$newid  = $this->getInsertId();

// text table
		$sql2  = "INSERT INTO $text_table (";
		$sql2 .= "lid, description";
		$sql2 .= ") VALUES (";
		$sql2 .= "$newid, '$desc'";
		$sql2 .= ")";
		$this->query($sql2);

	}
}

//---------------------------------------------------------
// votedata table
//---------------------------------------------------------
//  ratingid int(11)
//  lid int(11)
//  ratinguser int(11)
//  rating tinyint(3)
//  ratinghostname varchar(60)
//  ratingtimestamp int(10)

function gen_mylinks_votedata( $MAX_VOTE, $MAX_LINK )
{
	echo "<h4>generete votedata table</h4>\n";
	srand( (double)microtime()*1000000 );

// table name
	$votedata_table = $this->db_prefix("mylinks_votedata");
	$link_table     = $this->db_prefix("mylinks_links");

	for ($i=0; $i<$MAX_VOTE; $i++)
	{
// randum data
		$lid = rand(1, $MAX_LINK);
		$ratinguser = rand(1, 10);
		$rating     = rand(0, 10);
		$ratinghostname  = $this->get_randum_ip();
		$ratingtimestamp = $this->get_randum_time();

// votedata table
		$sql  = "INSERT INTO $votedata_table ";
		$sql .= "(lid, ratinguser, rating, ratinghostname, ratingtimestamp)";
		$sql .= "VALUES ";
		$sql .= "($lid, $ratinguser, $rating, '$ratinghostname', $ratingtimestamp)";
		$this->query($sql);
	}

	echo "<br>";

	$sql2  = "SELECT lid, count(lid) as c, sum(rating) as s FROM $votedata_table GROUP BY lid ";
	$rows2 =& $this->get_rows_by_sql($sql2);

	foreach ( $rows2 as $row2 )
	{
		$lid   = $row2['lid'];
		$count = $row2['c'];
		$sum   = $row2['s'];

		$rating = $sum / $count;

		$sql = "UPDATE $link_table SET rating=$rating, votes=$count WHERE lid=$lid";
		$this->query($sql);
	}
}

//---------------------------------------------------------
// xoopscomments table
//---------------------------------------------------------
function gen_mylinks_comment( $MAX_COM, $MAX_LINK  )
{
	echo "<h4>generete xoopscomments table</h4>\n";
	srand( (double)microtime()*1000000 );

	$mid = $this->get_mid_by_dirname( "mylinks" );

// table name
	$link_table = $this->db_prefix("mylinks_links");

	$this->gen_comment_list( $mid, $MAX_COM, $MAX_LINK );

	echo "<br />\n";

	$rows =& $this->get_comment_rows( $mid );
	foreach ( $rows as $row )
	{
		$itemid = $row['com_itemid'];
		$count  = $row['c'];

		$sql= "UPDATE $link_table SET comments=$count WHERE lid=$itemid";
		$this->query($sql);
	}
}

// --- class end ---
}

//=========================================================
// main
//=========================================================
$genarete = new weblinks_genarate_mylinks();

dev_header();

$MYLINKS_DIRNAME = "mylinks";
$MAX_CAT    = 10;
$MAX_PARENT = 3;
$MAX_LINK   = 100;
$MAX_VOTE   = 30;
$MAX_COM    = 30;

echo "<h3>generete mylinks table data</h3>\n";

if ( !$genarete->is_exist_module( $MYLINKS_DIRNAME ) )
{
	$msg = $MYLINKS_DIRNAME." module is not installed \n";
	echo '<h1 style="color: #ff0000; ">'.$msg."</h1>\n";
	dev_footer();
	exit();
}

$genarete->gen_mylinks_category( $MAX_CAT,  $MAX_PARENT );
$genarete->gen_mylinks_link(     $MAX_LINK, $MAX_CAT );
$genarete->gen_mylinks_votedata( $MAX_VOTE, $MAX_VOTE/4 );
$genarete->gen_mylinks_comment(  $MAX_COM,  $MAX_COM/4 );

echo "<h3>end</h3>";
dev_footer();
// =====

?>