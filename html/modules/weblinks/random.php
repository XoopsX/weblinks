<?php
// $Id: random.php,v 1.1 2011/12/29 14:32:29 ohwada Exp $

// 2007-09-01 K.OHWADA
// mode_random_jump

// 2007-03-01 K.OHWADA
// header.php
// weblinks_link_basic
// WEBLINK_URL

// 2006-09-20 K.OHWADA
// use happy_linux

// 2006-05-15 K.OHWADA
// new handler

// 2005-09-01 K.OHWADA
// BUG 2929: random jump becomes an infinite loop

//=========================================================
// random jump
// 2004-10-20 K.OHWADA
//=========================================================

include "header.php";

$weblinks_config_handler =& weblinks_get_handler( 'config2_basic',  WEBLINKS_DIRNAME );
$weblinks_link_handler   =& weblinks_get_handler( 'link_basic',  WEBLINKS_DIRNAME );

$conf    = $weblinks_config_handler->get_conf();
$lid_arr = $weblinks_link_handler->get_lid_array_by_random(1);

// jump this site, if no data
if ( count($lid_arr) == 0 )
{
	redirect_header(WEBLINKS_URL, 3, _WLS_NOMATCH);
}

$lid = intval( $lid_arr[0] );

if ( $conf['mode_random_jump'] == 1 ) 
{
	$url_s = WEBLINKS_URL . '/singlelink.php?lid=' . $lid;
}
else 
{
	if ( $conf['use_hits'] )
	{
		$weblinks_link_handler->countup_hits($lid);
	}
	$url_s = $weblinks_link_handler->get_url($lid, 's');
}

// jump this site, if no url
if ( empty($url_s) )
{
	redirect_header(WEBLINKS_URL, 3, _WLS_NOMATCH);
}

?>
<html><head>
<meta http-equiv="Refresh" content="0; URL=<?php echo $url_s; ?>">
</head>
<body></body>
</html>
<?php

exit();

?>