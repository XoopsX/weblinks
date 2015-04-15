<?php
// $Id: weblinks_htmlout.php,v 1.1 2011/12/29 14:33:10 ohwada Exp $

//=========================================================
// WebLinks Module
// 2008-02-17 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('weblinks_htmlout') ) 
{

//=========================================================
// class word
//=========================================================
class weblinks_htmlout extends happy_linux_plugin
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_htmlout( $dirname )
{
	$this->happy_linux_plugin();
	$this->set_dirname( $dirname );
	$this->set_dir_plugins(      'htmlout' );
	$this->set_prefix_class(     'weblinks_htmlout' );
	$this->set_prefix_func_data( 'weblinks_htmlout_data' );

}

public static function &getInstance( $dirname )
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new weblinks_htmlout( $dirname );
	}
	return $instance;
}

//---------------------------------------------------------
// execute
//---------------------------------------------------------
function execute( $items )
{
// not use return references
	$arr = $items;
	$ret = $this->_execute( $items );
	if ($ret)
	{
		$arr = $this->get_items();
	}
	return $arr;
}

// --- class end ---
}

// === class end ===
}

?>