<?php
// $Id: votedata_manage.php,v 1.1 2011/12/29 14:32:51 ohwada Exp $

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
// class black manage
//=========================================================
class admin_votedata_manage extends happy_linux_manage
{
	var $_link_handler;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_votedata_manage()
{
	$this->happy_linux_manage( WEBLINKS_DIRNAME );
	$this->set_handler( 'votedata', WEBLINKS_DIRNAME, 'weblinks' );
	$this->set_id_name( 'ratingid' );
	$this->set_form_class( 'admin_form_votedata' );
	$this->set_script(   'votedata_manage.php' );
	$this->set_redirect( 'votedata_list.php', 'votedata_list.php?sortid=1' );
	$this->set_flag_execute_time( true );

	$this->_link_handler  =& weblinks_get_handler('link', WEBLINKS_DIRNAME);

}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_votedata_manage();
	}

	return $instance;
}

//---------------------------------------------------------
// POST GET parameter
//---------------------------------------------------------
function _get_post_list_id()
{
	$arr = false;
	if ( isset($_POST['votedata_id']) )
	{
		$arr = $_POST['votedata_id'];
	}
	elseif ( isset($_POST['votedata_user_id']) )
	{
		$arr = $_POST['votedata_user_id'];
	}
	elseif ( isset($_POST['votedata_anoymous_id']) )
	{
		$arr = $_POST['votedata_anoymous_id'];
	}
	$this->_list_id = $arr;
	return $this->_list_id;
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
	$this->_main_mod_table();
}

function _check_mod_table()
{
	return true;
}

//---------------------------------------------------------
// main_del_table()
//---------------------------------------------------------
function del_table()
{
	$this->_clear_errors();
	$this->_main_del_table();
}

function _exec_del_table()
{

	$ret = $this->_handler->delete( $this->_obj );
	if ( !$ret)
	{
		$this->_set_errors( $this->_handler->getErrors() );
	}

	$lid = $this->_obj->get('lid');
	list($finalrating, $votesDB) = $this->_handler->calc_rating_by_lid($lid);

	$ret = $this->_link_handler->update_rating($lid, $finalrating, $votesDB);
	if ( !$ret)
	{
		$this->_set_errors( $this->_link_handler->getErrors() );
	}

	return $this->returnExistError();
}

function _check_del_table()
{
	return true;
}

//---------------------------------------------------------
// del_all
//---------------------------------------------------------
function del_all()
{
	$this->_main_del_all();
}

function _exec_del_all_each()
{
	$this->_exec_del_table();
}

function _check_del_all()
{
	return true;
}

// --- class end ---
}


//=========================================================
// class admin_form_votedata
//=========================================================
class admin_form_votedata extends happy_linux_form
{
	var $_link_handler;
	var $_system;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_form_votedata()
{
	$this->happy_linux_form();

	$this->_link_handler =& weblinks_get_handler( 'link', WEBLINKS_DIRNAME );
	$this->_system =& happy_linux_system::getInstance();
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_form_votedata();
	}

	return $instance;
}

//---------------------------------------------------------
// show black & white
//---------------------------------------------------------
function _show(&$obj, $extra=null, $mode=0)
{
	$form_title = 'modify votedata';
	$op         = 'mod_table';
	$button_val = _HAPPY_LINUX_MODIFY;

	$this->set_obj($obj);

	$title_s = '';

	$lid = $obj->get('lid');
	$link_obj =& $this->_link_handler->get($lid);
	if ( is_object($link_obj) )
	{
		$title_s = $link_obj->getVar('title', 's');
	}

// form start
	echo $this->build_form_begin();
	echo $this->build_token();
	echo $this->build_html_input_hidden('op', $op);
	echo $this->build_html_input_hidden('ratingid', $obj->get('ratingid') );

	echo $this->build_form_table_begin();
	echo $this->build_form_table_title($form_title);

	echo $this->build_obj_table_label('ratingid', 'ratingid');

	echo $this->build_obj_table_text(_WLS_LINKID, 'lid');
	echo $this->build_form_table_line(_WLS_SITETITLE, $title_s);

	echo $this->build_obj_table_text(_WLS_USER, 'ratinguser');
	echo $this->build_form_table_line('', $obj->get_uname() );

	echo $this->build_obj_table_text(_WLS_IP,  'ratinghostname');
	echo $this->build_obj_table_text(_WLS_RATING, 'rating');
	echo $this->build_obj_table_text(_WLS_DATE, 'ratingtimestamp');
	echo $this->build_form_table_line('', $obj->get_formatted_timestamp() );

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

$manage =& admin_votedata_manage::getInstance();

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