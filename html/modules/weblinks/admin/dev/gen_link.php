<?php
// $Id: gen_link.php,v 1.1 2011/12/29 14:32:59 ohwada Exp $

//================================================================
// WebLinks Module
// 2007-03-07 K.OHWADA
//================================================================

include_once 'dev_header.php';

$genarete =& new weblinks_gen_record();

dev_header();

$CID      = 1;
$MAX_LINK = 1000;

echo "<h3>generete link in one category</h3>\n";
echo "one link in each top category <br>\n";

for ($i=1; $i<=$MAX_LINK; $i++)
{
// link table
	$lid = $genarete->insert_randum_link();

// catlink table
	$genarete->insert_catlink($CID, $lid);
}

echo "<h3>end</h3>";
echo "$MAX_LINK links in category $CID <br>\n";

dev_footer();
// =====

?>