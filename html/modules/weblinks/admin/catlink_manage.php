<?php
// $Id: catlink_manage.php,v 1.1 2011/12/29 14:32:56 ohwada Exp $

// 2007-11-01 K.OHWADA
// set_flag_execute_time()

// 2007-02-20 K.OHWADA
// hack for multi site

// 2006-09-20 K.OHWADA
// this new file

//================================================================
// WebLinks Module
// 2006-09-20 K.OHWADA
//================================================================
include 'admin_header.php';

//=========================================================
// class admin_catlink_manage
//=========================================================
class admin_catlink_manage extends happy_linux_manage
{
	var $_category_handler;
	var $_link_handler;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_catlink_manage()
{
	$this->happy_linux_manage( WEBLINKS_DIRNAME );
	$this->set_handler( 'catlink', WEBLINKS_DIRNAME, 'weblinks' );
	$this->set_id_name( 'jid' );
	$this->set_form_class( 'admin_form_catlink' );
	$this->set_script(   'catlink_manage.php' );
	$this->set_redirect( 'catlink_list.php', 'catlink_list.php?sortid=1' );
	$this->set_flag_execute_time( true );

	$this->_category_handler =& weblinks_get_handler( 'category', WEBLINKS_DIRNAME );
	$this->_link_handler     =& weblinks_get_handler( 'link',     WEBLINKS_DIRNAME );

}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_catlink_manage();
	}

	return $instance;
}

//---------------------------------------------------------
// main_mod_form()
//---------------------------------------------------------
function mod_form()
{
	$this->_main_mod_form();
}

//---------------------------------------------------------
// main_mod_table()
//---------------------------------------------------------
function mod_table()
{
	$this->_main_mod_table( true );
}

//---------------------------------------------------------
// main_del_table()
//---------------------------------------------------------
function del_table()
{
	$this->_main_del_table( true );
}

// --- class end ---
}


//=========================================================
// class admin_form_catlink
//=========================================================
class admin_form_catlink extends happy_linux_form
{
	var $_category_handler;
	var $_link_handler;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_form_catlink()
{
	$this->happy_linux_form();

	$this->_category_handler =& weblinks_get_handler( 'category', WEBLINKS_DIRNAME );
	$this->_link_handler     =& weblinks_get_handler( 'link',     WEBLINKS_DIRNAME );

}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_form_catlink();
	}

	return $instance;
}

//---------------------------------------------------------
// show black & white
//---------------------------------------------------------
function _show(&$obj, $extra=null, $mode=0)
{
	$form_title = 'modify catlink';
	$op         = 'mod_table';
	$button_val = _HAPPY_LINUX_MODIFY;

	$this->set_obj($obj);

	$cid = $obj->get('cid');
	$lid = $obj->get('lid');

	$cat_title_s  = '';
	$link_title_s = '';

	$cat_obj =& $this->_category_handler->get($cid);
	if ( is_object($cat_obj) )
	{
		$cat_title_s = $cat_obj->getVar('title', 's');
	}

	$link_obj =& $this->_link_handler->get($lid);
	if ( is_object($link_obj) )
	{
		$link_title_s = $link_obj->getVar('title', 's');
	}

// form start
	echo $this->build_form_begin();
	echo $this->build_token();
	echo $this->build_html_input_hidden('op', $op);
	echo $this->build_html_input_hidden('jid', $obj->get('jid') );

	echo $this->build_form_table_begin();
	echo $this->build_form_table_title($form_title);

	echo $this->build_obj_table_label('jid', 'jid');

	echo $this->build_obj_table_text(_WLS_CATEGORYID, 'cid');
	echo $this->build_form_table_line(_WLS_TITLEC,  $cat_title_s);

	echo $this->build_obj_table_text(_WLS_LINKID, 'lid');
	echo $this->build_form_table_line(_WLS_SITETITLE, $link_title_s);

	$ele_submit = $this->build_html_input_submit('submit', $button_val);
	echo $this->build_form_table_line('', $ele_submit, 'foot', 'foot');

	$ele_del    = $this->build_html_input_submit('del_table', _DELETE);
	$ele_cancel = $this->build_html_input_button_cancel('cancel', _CANCEL);
	echo $this->build_form_table_line('', $ele_del.'  '.$ele_cancel, 'foot', 'foot');

	echo $this->build_form_table_end();
	echo $this->build_form_end();
// --- form end ---

}

// --- class end ---
}

//=========================================================
// main
//=========================================================
// hack for multi site
weblinks_admin_multi_redirect_jp_site();

$manage =& admin_catlink_manage::getInstance();

$op = $manage->_main_get_op();

switch ($op)
{
	case 'mod_form':
		$manage->mod_form();
		break;

	case 'mod_table':
		$manage->mod_table();
		break;

	case 'del_table':
		$manage->del_table();
		break;

	case 'del_all':
		$manage->del_all();
		break;

	default:
		xoops_cp_header();
		echo '<h4>No Action</h4>';
		break;
}

xoops_cp_footer();
exit();
// --- end of main ---

?>