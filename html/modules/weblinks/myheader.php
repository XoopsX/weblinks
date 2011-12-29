<?php
// $Id: myheader.php,v 1.1 2011/12/29 14:32:28 ohwada Exp $

// 2007-05-12 K.OHWADA
// Notice [PHP]: Undefined variable: dirname
// constant $IMAGE_LOGO

// 2007-03-01 K.OHWADA
// header.php
// weblinks_link_basic

// 2006-09-20 K.OHWADA
// use happy_linux

// 2006-05-15 K.OHWADA
// new handler

//================================================================
// Frame Branding
// use class weblinksLink
// 2004/01/14 K.OHWADA
//================================================================

include 'header.php';

$weblinks_link_handler =& weblinks_get_handler( 'link_basic', WEBLINKS_DIRNAME );

// Notice [PHP]: Undefined variable: dirname
$weblinks_link_view    =& weblinks_link_view::getInstance( WEBLINKS_DIRNAME );

$weblinks_post   =& happy_linux_post::getInstance();
$weblinks_system =& happy_linux_system::getInstance();

// constant
$IMAGE_LOGO = XOOPS_URL.'/images/logo.gif';

// BUG 2932: dont work correctly when register_long_arrays = off
$lid   = $weblinks_post->get_get_int('lid');
$url_s = $weblinks_link_handler->get_url($lid, 's');

// jump this site, if no url
if ( empty($url_s) )
{
	redirect_header("index.php", 5, _WLS_NOMATCH);
	exit();
}

list($mail_subject, $mail_body) = $weblinks_link_view->build_link_mail_by_lid($lid);

$sitename = $weblinks_system->get_sitename();

?>
<html><head>
<style><!--
.bg1 { background-color : #E3E4E0;}
.bg2 { background-color : #e5e5e5;}
.bg3 { background-color : #f6f6f6;}
.bg4 { background-color : #f0f0f0;}
.bg5 { background-color : #f8f8f8;}
body { margin-left: 0px;margin-top: 0px;margin-right: 0px;margin-bottom: 0px;font-family: Tahoma, taipei; color;#000000; font-size: 10px; background-color : #2F5376; color: #ffffff;}
a {  font-weight: bold;font-family: Tahoma, taipei; font-size: 10px; text-decoration: none; color: #666666; font-style: normal}
A:hover {  font-weight: bold;text-decoration: underline;  font-family: Tahoma, taipei; font-size: 10px; color: #FF9966; font-style: normal}
td {  font-family: Tahoma, taipei; color: #000000; font-size: 10px;border-top-width : 1px; border-right-width : 1px; border-bottom-width : 1px; border-left-width : 1px;}
img { border:0;}
//--></style>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="150">
<a href="<?php echo XOOPS_URL; ?>" target="_blank">
<img src="<?php echo $IMAGE_LOGO; ?>" alt="logo" /></a>
<td width="100%" align="center">
<table class="bg3" width="95%" cellspacing="2" cellpadding="3" border="0" style="border: #e0e0e0 1px solid;" ><tr>
<td style="border-bottom: #e0e0e0 1px solid;" >
<b><?php echo $sitename; ?></b></td>
</tr>
<tr>
<td class="bg4" align="center"><small>
<a target="_top" href="<?php echo WEBLINKS_URL; ?>/ratelink.php?lid=<?php echo $lid; ?>">
<?php echo _WLS_RATETHISSITE; ?></a>
 | <a target="_top" href="<?php echo WEBLINKS_URL; ?>/modlink.php?lid=<?php echo $lid; ?>">
<?php echo _WLS_MODIFY; ?></a>
 | <a target="_top" href="<?php echo WEBLINKS_URL; ?>/brokenlink.php?lid=<?php echo $lid; ?>">
<?php echo _WLS_REPORTBROKEN; ?></a>
 | <a target="_top" href="mailto:?subject=<?php echo $mail_subject; ?>&body=<?php echo $mail_body;?>">
<?php echo _WLS_TELLAFRIEND; ?></a> | 
<a target="_top" href="<?php echo XOOPS_URL; ?>">
Back to <?php echo $sitename; ?></a>
 | <a target="_top" href="<?php echo $url_s; ?>">Close Frame</a>
</small></td></tr></table>
</td></tr></table>
</body></html>
