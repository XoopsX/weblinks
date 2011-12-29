<?php
// $Id: gen_mylinks_child_category.php,v 1.1 2011/12/29 14:32:58 ohwada Exp $

//================================================================
// WebLinks Module
// 2007-03-07 K.OHWADA
//================================================================

include_once 'dev_header.php';
include_once 'gen_mylinks_class.php';

$genarete =& new weblinks_gen_mylinks();

dev_header();

$PID_START = 0;
$MAX_CAT   = 10;
$MAX_PID   = 10;

echo "<h3>generete mylinks child category</h3>\n";
echo "one link in each category <br>\n";

if ( isset($_POST['pid']) )
{
	$PID_START = intval($_POST['pid']);
}
else
{
	echo '<form method="post">';
	echo 'pid <input type="text" name="pid"> ';
	echo '<input type="submit" name="submit">';
	echo '</form>';
	dev_footer();
}

$imgurl_dir = XOOPS_URL."/modules/mylinks/images/category/";

for ($j=0; $j<$MAX_PID; $j++)
{
	$pid = $PID_START + $j;

	for ($i=1; $i<=$MAX_CAT; $i++)
	{
// category table
		$cat_title = $pid.": ".$genarete->get_randum_title();
		$imgurl    = $imgurl_dir . sprintf( "%01d", rand(0, 9) ) . ".gif";
		$cid = $genarete->insert_mylinks_category($pid, $cat_title, $imgurl);

// link table
		$link_title = $genarete->get_randum_title();
		$lid = $genarete->insert_mylinks_link( $cid, $link_title );

// text table
		$genarete->insert_mylinks_text( $lid, $link_title );
	}
}

echo "<h3>end</h3>\n";
echo "$MAX_CAT categories in cateogry $PID_START <br>\n";

dev_footer();
// =====

?>