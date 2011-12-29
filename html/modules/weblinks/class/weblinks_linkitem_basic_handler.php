<?php
// $Id: weblinks_linkitem_basic_handler.php,v 1.1 2011/12/29 14:33:10 ohwada Exp $

// 2007-10-30 K.OHWADA
// _has_conf_cached()

// 2007-03-01 K.OHWADA
// divid from weblinks_linkitem_handler

//================================================================
// WebLinks Module
// 2007-03-01 K.OHWADA
//================================================================

// === class begin ===
if( !class_exists('weblinks_linkitem_basic_handler') ) 
{

//================================================================
// class weblinks_linkitem_basic_handler
//================================================================
class weblinks_linkitem_basic_handler extends happy_linux_basic_handler
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_linkitem_basic_handler( $dirname )
{
	$this->happy_linux_basic_handler( $dirname );
	$this->set_table_name('linkitem');
	$this->set_id_name('item_id');

	$this->set_conf_id_name('item_id');
	$this->set_conf_name_name('name');
	$this->set_conf_value_name('title');

	$this->set_debug_db_sql(     WEBLINKS_DEBUG_LINKITEM_BASIC_SQL );
	$this->set_debug_db_error(   WEBLINKS_DEBUG_ERROR );
	$this->set_debug_print_time( WEBLINKS_DEBUG_TIME );
}

//---------------------------------------------------------
// load
// caller: weblinks_template, weblinks_gmap
//---------------------------------------------------------
function init()
{
	if ( !$this->_has_conf_cached() )
	{
		$this->load_config();
	}
}

function load_config()
{
	if ( $this->get_debug_print_time() )
	{
		$happy_linux_time =& happy_linux_time::getInstance();
		$happy_linux_time->print_lap_time( "weblinks_linkitem_basic_handler" );
	}

	$this->_get_config_data();

	if ( $this->get_debug_print_time() )
	{
		$happy_linux_time->print_lap_time();
	}
}

// --- class end ---
}

// === class end ===
}

?>