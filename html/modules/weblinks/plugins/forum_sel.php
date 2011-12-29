<?php
// $Id: forum_sel.php,v 1.1 2011/12/29 14:32:59 ohwada Exp $

// 2008-09-08 Eparcyl92
// added newbbex

// 2007-08-01 K.OHWADA
// module duplication

// 2007-06-10 K.OHWADA
// d3forum

//================================================================
// WebLinks Module
// 2007-02-20 K.OHWADA
//================================================================

// --- functions begin ---
if( !function_exists( 'weblinks_plugin_forum_sel' ) ) 
{

function &weblinks_plugin_forum_sel() 
{
	$sel = array();

	$sel[1]['name']         = 'newbb_100';
	$sel[1]['dirname']      = 'newbb';
	$sel[1]['description']  = 'newbb v1.00';

	$sel[2]['name']         = 'newbb_200';
	$sel[2]['dirname']      = 'newbb';
	$sel[2]['description']  = 'newbb v2.02';

	$sel[3]['name']         = 'bluesbb_100';
	$sel[3]['dirname']      = 'bluesbb';
	$sel[3]['description']  = 'bluesbb v1.00';

	$sel[4]['name']         = 'd3forum_073';
	$sel[4]['dirname']      = 'd3forum';
	$sel[4]['description']  = 'd3forum v0.73';

	$sel[5]['name']         = 'newbbex_162';
	$sel[5]['dirname']      = 'newbbex';
	$sel[5]['description']  = 'newbbex v1.62';

	return $sel;
}

}
// --- functions end ---

?>