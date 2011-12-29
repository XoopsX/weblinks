<?php
// $Id: weblinks_linkitem_store_handler.php,v 1.1 2011/12/29 14:33:09 ohwada Exp $

// 2007-08-01 K.OHWADA
// admin can add etc column
// set_num_etc()

// 2007-02-20 K.OHWADA
// add description field
// add_column_table_140()

// 2006-09-20 K.OHWADA
// use happy_linux
// add upgrade() clean()

// 2006-05-15 K.OHWADA
// this is new file
// use new handler

//================================================================
// WebLinks Module
// this file contain 2 class
//   weblinks_linkitem_form
//   weblinks_linkitem_store_handler
// 2006-05-15 K.OHWADA
//================================================================

// === class begin ===
if( !class_exists('weblinks_linkitem_store_handler') ) 
{

//=========================================================
// class weblinks_linkitem_form
//=========================================================
class weblinks_linkitem_form extends happy_linux_form
{
	var $_linkitem_define_handler;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_linkitem_form( $dirname )
{
	$this->happy_linux_form();

	$this->_linkitem_define_handler =& weblinks_get_handler( 'linkitem_define', $dirname );
	$this->set_form_name( 'weblinks_linkitem' );

}

function &getInstance( $dirname )
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new weblinks_linkitem_form( $dirname );
	}

	return $instance;
}

//---------------------------------------------------------
// main function
//---------------------------------------------------------
function show($form_title)
{
	$ROWS = 1;
	$COLS = 50;
	$SIZE = 50;

	$linkitem_arr = $this->_linkitem_define_handler->load();

// form start
	echo $this->build_form_begin();
	echo $this->build_token();
	echo $this->build_html_input_hidden('op', 'save');
	echo $this->build_html_input_hidden('save_linkitem', 1);
	echo $this->build_form_table_begin();
	echo $this->make_table3_title( $form_title );

	$options = array(
		_WEBLINKS_NO_USE        => 0,
		_WEBLINKS_USE           => 1,
		_WEBLINKS_INDISPENSABLE => 2,
	);

// list from config array
	foreach ($linkitem_arr as $item_id => $linkitem) 
	{
		$name      = $linkitem['name'];
		$conf_form = $linkitem['conf_form'];
		$title     = $linkitem['title'];
		$user_mode = $linkitem['user_mode'];
		$desc      = $linkitem['description'];

		if ( $conf_form == 0 )  { continue; }

		$name_d  = $name;
		$name_d .= $this->build_html_input_hidden("item_ids[]", $item_id);

		$ele1  = $this->build_html_input_text("title[$item_id]", $title, $SIZE);
		$ele1 .= "<br />\n";
		$ele1 .= $this->build_html_textarea("description[$item_id]", $desc, $ROWS, $COLS);

		if ( $conf_form == 2 )
		{
			$ele2 = $this->get_option_name($user_mode, $options);
		}
		else
		{
			$ele2 = $this->build_html_input_radio_select("user_mode[$item_id]", $user_mode, $options);
		}

		echo $this->make_table3_line($name_d, $ele1, $ele2);
	}

	$button = $this->build_html_input_submit('submit', _WEBLINKS_UPDATE );

	echo $this->make_table3_submit($button);
	echo $this->build_form_table_end();
	echo $this->build_form_end();

// form end

}

//---------------------------------------------------------
// make table form
//---------------------------------------------------------
function make_table3_title($title)
{
	$text  = $this->build_form_table_title($title, 3);
	return $text;
}

function make_table3_line($title, $ele1, $ele2)
{
	$text  = "<tr valign='top' align='left'>";
	$text .= $this->build_form_td_class($title, 'head');
	$text .= $this->build_form_td_class($ele1,  'odd');
	$text .= $this->build_form_td_class($ele2,  'odd');
	$text .= "</tr>\n";
	return $text;
}

function make_table3_submit($button)
{
	$text  = "<tr valign='top' align='left'>";
	$text .= $this->build_form_td_class('', 'foot');
	$text .= $this->build_html_td_tag_begin('center', '', 2, '', 'foot');
	$text .= $this->substute_blank($button);
	$text .= $this->build_html_td_tag_end();

	$text .= "</tr>\n";
	return $text;
}

function get_option_name($value, $options)
{
	foreach ($options as $opt_name => $opt_val)
	{
		if ( isset($value) && ( $value == $opt_val ) )
		{
			return $opt_name;
		}
	}

	return '';
}

// --- class end ---
}

//================================================================
// class weblinks_linkitem_store_handler
//================================================================
class weblinks_linkitem_store_handler extends happy_linux_error
{
	var $_handler;
	var $_define;
	var $_post;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_linkitem_store_handler( $dirname )
{
	$this->happy_linux_error();

	$this->_handler        =& weblinks_get_handler('linkitem',        $dirname );
	$this->_define_handler =& weblinks_get_handler('linkitem_define', $dirname );
	$this->_define         =& weblinks_linkitem_define::getInstance( $dirname );

	$this->_post    =& happy_linux_post::getInstance();
}

//---------------------------------------------------------
// init config
//---------------------------------------------------------
function init()
{
	$this->_clear_errors();

	$define_arr = $this->_define->get_define();

// list from Define
	foreach ($define_arr as $item_id => $def) 
	{
		$name = $def['name'];

		$title = '';
		if ( isset($def['title']) )
		{
			$title = $def['title'];
		}

		$user_mode = '';
		if ( isset($def['user_mode']) )
		{
			$user_mode = $def['user_mode'];
		}

		$description = '';
		if ( isset($def['description']) )
		{
			$description = $def['description'];
		}

		$obj =& $this->_handler->create();
		$obj->setVar('item_id',     $item_id);
		$obj->setVar('name',        $name);
		$obj->setVar('title',       $title);
		$obj->setVar('user_mode',   $user_mode);
		$obj->setVar('description', $description);

		$ret = $this->_handler->insert($obj);
		if ( !$ret )
		{
			$flag_error = true;
			$this->_set_errors( $this->_handler->getErrors() );
		}

		unset($obj);
	}

	return $this->returnExistError();
}

//---------------------------------------------------------
// upgrade config
//---------------------------------------------------------
function upgrade()
{
	$this->_clear_errors();

	$define_arr = $this->_define->get_define();

// list from Define
	foreach ($define_arr as $item_id => $def) 
	{
		$obj =& $this->_handler->get_by_itemid($item_id);
		if ( is_object($obj) )  continue;

// insert, when not in MySQL
		$name = $def['name'];

		$title = '';
		if ( isset($def['title']) )
		{
			$title = $def['title'];
		}

		$user_mode = '';
		if ( isset($def['user_mode']) )
		{
			$user_mode = $def['user_mode'];
		}

		$description = '';
		if ( isset($def['description']) )
		{
			$description = $def['description'];
		}

		$obj =& $this->_handler->create();
		$obj->setVar('item_id',     $item_id);
		$obj->setVar('name',        $name);
		$obj->setVar('title',       $title);
		$obj->setVar('user_mode',   $user_mode);
		$obj->setVar('description', $description);

		$ret = $this->_handler->insert($obj);
		if ( !$ret )
		{
			$this->_set_errors( $this->_handler->getErrors() );
		}

		unset($obj);
	}

	return $this->returnExistError();
}

//---------------------------------------------------------
// save config
//---------------------------------------------------------
function save()
{
	$this->_clear_errors();

	$itemid_arr = $this->_post->get_post_array_int('item_ids');
	$mode_arr   = $this->_post->get_post_array_int('user_mode');
	$title_arr  = $this->_post->get_post_array_text('title');
	$desc_arr   = $this->_post->get_post_array_text('description');

	$count = count($itemid_arr);
	if ($count <= 0)  return true;	// no action

// list from POST 
	for ( $i=0; $i<$count; $i++ ) 
	{
		$itemid = $itemid_arr[$i];

		$obj =& $this->_handler->get_by_itemid($itemid);
		if ( !is_object($obj) )  continue;

		$title_current = $obj->getVar('title');
		$mode_current  = $obj->getVar('user_mode');
		$desc_current  = $obj->getVar('description');

		$title = '';
		$mode  = 0;

		if ( isset( $title_arr[$itemid] ) )
		{
			$title = $title_arr[$itemid];
			$obj->setVar('title', $title);
		}

		if ( isset( $mode_arr[$itemid] ) )
		{
			$mode = $mode_arr[$itemid];
			$obj->setVar('user_mode',  $mode);
		}

		if ( isset( $desc_arr[$itemid] ) )
		{
			$desc = $desc_arr[$itemid];
			$obj->setVar('description',  $desc);
		}

		if (( $title != $title_current )||( $mode != $mode_current )||( $desc != $desc_current ))
		{
			$ret = $this->_handler->update($obj);
			if ( !$ret )
			{
				$flag_error = true;
				$this->_set_errors( $this->_handler->getErrors() );
			}
		}

		unset($obj);
	}

	return $this->returnExistError();
}

//---------------------------------------------------------
// linkitem_handler
//---------------------------------------------------------
function load()
{
	$this->_handler->load();
}

function existsTable()
{
	$ret = $this->_handler->existsTable();
	return $ret;
}

function getCount()
{
	$count = $this->_handler->getCount();
	return $count;
}

function create_table()
{
	$ret = $this->_handler->create_table();
	if ( !$ret )
	{
		$this->_set_errors( $this->_handler->getErrors() );
	}

	return $ret;
}

function clean_table()
{
	$magic = $this->_handler->get_magic_word();
	$ret = $this->_handler->clean_table( $magic );
	if ( !$ret )
	{
		$this->_set_errors( $this->_handler->getErrors() );
	}

	return $ret;
}

function check_exist_by_name($name)
{
	$arr = $this->_handler->get_cache_by_name($name);
	if ( is_array($arr) && count($arr) )
	{
		return true;
	}
	return false;
}

//---------------------------------------------------------
// add_column_table
//---------------------------------------------------------
function check_version_140()
{
	$ret = $this->_handler->check_version_140();
	return $ret;
}

function add_column_table_140()
{
	$ret = $this->_handler->add_column_table_140();
	return $ret;
}

//---------------------------------------------------------
// set param
//---------------------------------------------------------
function set_num_etc($val)
{
	$this->_define->set_num_etc($val);
}

// --- class end ---
}

// === class end ===
}

?>