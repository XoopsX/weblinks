<?php
// $Id: gen_all_table.php,v 1.1 2011/12/29 14:32:58 ohwada Exp $

//================================================================
// WebLinks Module
// 2006-09-20 K.OHWADA
//================================================================

include_once 'dev_header.php';

$genarete =& new weblinks_gen_record();

dev_header();

$MAX_CAT    = 10;
$MAX_PARENT = 3;
$MAX_LINK   = 100;
$MAX_VOTE   = 30;
$MAX_COM    = 30;

echo "<h3>generete table data</h3>\n";

$genarete->gen_category( $MAX_CAT,  $MAX_PARENT );
$genarete->gen_link(     $MAX_LINK, $MAX_CAT );
$genarete->gen_votedata( $MAX_VOTE, $MAX_VOTE/4 );
$genarete->gen_comment(  $MAX_COM,  $MAX_COM/4 );

echo "<h3>end</h3>";
dev_footer();
// =====

?>