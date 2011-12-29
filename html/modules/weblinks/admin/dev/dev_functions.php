<?php
// $Id: dev_functions.php,v 1.1 2011/12/29 14:32:57 ohwada Exp $

//================================================================
// WebLinks Module
// 2006-09-20 K.OHWADA
//================================================================
function dev_header( $title=null )
{
	global $xoopsConfig, $xoopsModule;

	header ('Content-Type:text/html; charset='._CHARSET);

	$module_name   = $xoopsModule->getVar('name');
	$module_name_s = htmlspecialchars($module_name, ENT_QUOTES);

	if ( empty($title) )
	{
		$title = $module_name_s.': Devlopment';
	}

	echo "<!DOCTYPE html PUBLIC '//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>\n";
	echo '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="'._LANGCODE.'" lang="'._LANGCODE.'">'."\n";
	echo "<head>\n";
	echo '<meta http-equiv="content-type" content="text/html; charset='._CHARSET.'" />'."\n";
    echo "<title>".$title."</title>\n";
	echo "</head><body>\n";
	echo "<br />\n";
	echo '<a href="../../index.php">'.$module_name_s.'</a> &lt;&lt; ';
	echo '<a href="../index.php">Admin</a> &lt;&lt; ';
	echo '<a href="index.php">Dev</a>'."<br /><br />\n";
	echo "<hr /><br />\n";
}

function dev_footer()
{
	echo "<br /><hr />\n";
	echo '- <a href="index.php">goto Dev index</a>'."<br />\n";
	echo '- <a href="../index.php">goto Admin index</a>'."<br />\n";
	echo "</head></html>\n";
	exit();
}

?>