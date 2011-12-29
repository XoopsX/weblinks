<?php
// $Id: rss_build_manage.php,v 1.1 2011/12/29 14:32:53 ohwada Exp $

// 2007-11-01 K.OHWADA
// weblinks_admin_print_footer()

//=========================================================
// WebLinks Module
// 2007-10-10 K.OHWADA
//=========================================================

include 'admin_header.php';
include 'admin_header_config.php';

// class
$config_form  =& admin_config_form::getInstance();
$config_store =& admin_config_store::getInstance();

$op = $config_form->get_post_get_op();

if ($op == 'rss_cache_clear')
{
	if( !$config_form->check_token() ) 
	{
		xoops_cp_header();
		$config_form->print_xoops_token_error();
	}
	else
	{
		$config_store->rss_cache_clear();
		redirect_header("rss_build_manage.php", 1, _HAPPY_LINUX_CLEARED );
	}
}
else
{
	xoops_cp_header();
}

$config_store->print_style_sheet();

weblinks_admin_print_header();
weblinks_admin_print_menu();

admin_print_build_menu();

echo "<h4>"._HAPPY_LINUX_CONF_RSS_CACHE_CLEAR."</h4>\n";
$config_form->show_form_rss_cache_clear( _HAPPY_LINUX_CONF_RSS_CACHE_CLEAR );

weblinks_admin_print_footer();
xoops_cp_footer();
exit();
// --- main end ---


function admin_print_build_menu()
{

?>
<h3><?php echo _HAPPY_LINUX_CONF_RSS_MANAGE; ?></h3>
<?php echo _HAPPY_LINUX_CONF_RSS_MANAGE_DESC; ?><br /><br />
<table border="1">
<tr><td>
</td><th class="weblinks_rss_build_manage">
  <?php echo _AM_WEBLINKS_RSS_SITE; ?>
</th><th class="weblinks_rss_build_manage">
  <?php echo _AM_WEBLINKS_RSS_FEED; ?>
</th></tr>
<tr><td class="weblinks_rss_build_manage">
  <a href="build_rss.php?mode=rdf" target="_blank">
  <img src="<?php echo WEBLINKS_URL; ?>/images/rdf.png"></a>
</td><td class="weblinks_rss_build_manage">
  <a href="build_rss.php?mode=rdf" target="_blank">
  <?php echo _HAPPY_LINUX_CONF_DEBUG_RDF; ?></a>
</td><td class="weblinks_rss_build_manage">
  <a href="build_rss.php?type=feed&mode=rdf" target="_blank">
  <?php echo _HAPPY_LINUX_CONF_DEBUG_RDF; ?></a>
</td></tr>
<tr><td class="weblinks_rss_build_manage">
  <a href="build_rss.php?mode=rss" target="_blank">
  <img src="<?php echo WEBLINKS_URL; ?>/images/rss.png"></a>
</td><td class="weblinks_rss_build_manage">
  <a href="build_rss.php?mode=rss" target="_blank">
  <?php echo _HAPPY_LINUX_CONF_DEBUG_RSS; ?></a>
</td><td class="weblinks_rss_build_manage">
  <a href="build_rss.php?type=feed&mode=rss" target="_blank">
  <?php echo _HAPPY_LINUX_CONF_DEBUG_RSS; ?></a>
</td></tr>
<tr><td class="weblinks_rss_build_manage">
  <a href="build_rss.php?mode=atom" target="_blank">
  <img src="<?php echo WEBLINKS_URL; ?>/images/atom.png"></a>
</td><td class="weblinks_rss_build_manage">
  <a href="build_rss.php?mode=atom" target="_blank">
  <?php echo _HAPPY_LINUX_CONF_DEBUG_ATOM; ?></a>
</td><td class="weblinks_rss_build_manage">
  <a href="build_rss.php?type=feed&mode=atom" target="_blank">
  <?php echo _HAPPY_LINUX_CONF_DEBUG_ATOM; ?></a>
</td></tr>
</table>
<?php

}

?>