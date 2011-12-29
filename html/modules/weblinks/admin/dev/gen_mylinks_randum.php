<?php
// $Id: gen_mylinks_randum.php,v 1.1 2011/12/29 14:32:58 ohwada Exp $

// 2007-03-07 K.OHWADA
// divid to gen_mylinks_class.php

//================================================================
// WebLinks Module
// 2006-09-20 K.OHWADA
//================================================================

include_once 'dev_header.php';
include_once 'gen_mylinks_class.php';

$genarete =& new weblinks_gen_mylinks();

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

?>