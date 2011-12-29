<?php
// $Id: gen_child_category.php,v 1.1 2011/12/29 14:32:58 ohwada Exp $

// 2007-10-30 K.OHWADA
// PHP5.2: Assigning the return value of new by reference is deprecated

//================================================================
// WebLinks Module
// 2007-03-07 K.OHWADA
//================================================================

include_once 'dev_header.php';

// PHP5.2: Assigning the return value of new by reference is deprecated
$genarete = new weblinks_gen_record();

dev_header();

$PID_START = 0;
$MAX_CAT   = 10;
$MAX_PID   = 10;

echo "<h3>generete child category</h3>\n";
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

for ($j=0; $j<$MAX_PID; $j++)
{
	$pid = $PID_START + $j;

	for ($i=1; $i<=$MAX_CAT; $i++)
	{
// category table
		$title  = $pid.": ".$genarete->get_randum_title();
		$imgurl = $genarete->get_randum_category_image();
		$orders = 0;
		$cid = $genarete->insert_category($pid, $title, $imgurl, $orders);

// link table
		$lid = $genarete->insert_randum_link();

// catlink table
		$genarete->insert_catlink($cid, $lid);
	}
}

echo "<h3>end</h3>";
echo "$MAX_CAT categories in cateogry $PID_START <br>\n";

dev_footer();
// =====

?>