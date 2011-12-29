<?php
// $Id: rssc_manage_class.php,v 1.1 2011/12/29 14:32:54 ohwada Exp $

// 2007-11-01 K.OHWADA
// WEBLINKS_OP_APPROVE_NEW

// 2007-09-10 K.OHWADA
// build_comment()
// _WLS_ERRORNOLINK in mod_link()

// 2006-10-14 K.OHWADA
// show _WLS_NEWLINKADDED in blue

// 2006-10-05 K.OHWADA
// this is new file
// use rssc WEBLINKS_RSSC_USE

//=========================================================
// WebLinks Module
// 2006-10-05 K.OHWADA
//=========================================================

//=========================================================
// class admin_rssc_manage
//=========================================================
class admin_rssc_manage extends happy_linux_manage
{
	var $_link_obj;
	var $_rssc_link_obj;

	var $_rssc_newid = 0;

	var $_param_msg = null;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_rssc_manage()
{
	$this->happy_linux_manage( WEBLINKS_DIRNAME );
	$this->set_handler( 'rssc', WEBLINKS_DIRNAME, 'weblinks' );
	$this->set_id_name( 'lid' );

	$this->_link_handler =& weblinks_get_handler('link',      WEBLINKS_DIRNAME );
	$this->_form         =& weblinks_rssc_form::getInstance();

}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_rssc_manage();
	}
	return $instance;
}

//---------------------------------------------------------
// POST param
//---------------------------------------------------------
function get_post_op()
{
	$op = 'main';
	if     ( isset($_POST['del_link']) )     $op = 'del_link';
	elseif ( isset($_POST['delete_link']) )  $op = 'del_link';
	elseif ( isset($_POST['delete_new']) )   $op = 'delete_new';
	elseif ( isset($_POST['ignore']) )       $op = 'ignore';
	elseif ( isset($_POST['cancel']) )       $op = 'cancel';
	elseif ( isset($_POST['op']) )           $op = $_POST['op'];
	elseif ( isset($_GET['op']) )            $op = $_GET['op'];
	return $op;
}

function get_post_lid()
{
	$lid = 0;
	if     ( isset($_POST['link_lid']) )  $lid = $_POST['link_lid'];
	elseif ( isset($_POST['lid']) )       $lid = $_POST['lid'];
	elseif ( isset($_GET['lid']) )        $lid = $_GET['lid'];
	return intval($lid);
}

function get_post_mid()
{
	return $this->_post->get_post_get_int('mid');
}

function get_post_rssc_lid()
{
	return $this->_post->get_post_get_int('rssc_lid');
}

function get_post_rss_flag()
{
	return $this->_post->get_post_get_int('rss_flag');
}

function get_post_op_mode()
{
	return $this->_post->get_post_get_text('op_mode');
}

//---------------------------------------------------------
// add_link
//---------------------------------------------------------
function add_link( $lid, $op_mode )
{
	$this->_print_cp_header();
	$this->_print_bread_add_link($op_mode);

	echo '<h4 style="color: #0000ff;">'._WLS_NEWLINKADDED."</h4>\n";
	echo "<hr />\n";
	echo "<h4>"._AM_WEBLINKS_ADD_RSSC."</h4>\n";

	if ( $this->_exec_add_link( $lid ) )
	{
		$this->_show_form_add_rssc( $lid, $op_mode );
	}
	else
	{
		$this->_print_db_error(1);
	}

	$this->_print_cp_footer();
}

function _exec_add_link( $lid )
{
// create object
	$rssc_obj =& $this->_handler->create_new_rssc_obj( $lid );

// discover result
	$this->_print_discover_result( $rssc_obj );

// if already exist in rssc module
	$rssc_lid = $this->_handler->check_get_rssc_exist_lid( $rssc_obj );
	if ( $rssc_lid )
	{

// --- update existed rssc_lid to link ---	
		$ret = $this->_link_handler->update_rssc_lid( $lid, $rssc_lid );
		if ( !$ret )
		{
			$this->_set_errors( $this->_link_handler->getErrors() );
			return false;	// db error
		}

// print already message
		$this->_print_link_already();
	}

	return true;
}


//---------------------------------------------------------
// add_rssc
//---------------------------------------------------------
function add_rssc()
{
	if( !$this->_check_token() ) 
	{
		redirect_header("link_list.php", 3, "Token Error");
		exit();
	}

	$op_mode = $this->get_post_op_mode();

	if ( WEBLINKS_RSSC_USE )
	{
		$this->_exec_add_rssc( $op_mode );
	}
	else
	{
		$this->_print_cp_header();
		$this->_print_bread_add_link( $op_mode );
		echo "<h4> No Action </h4>\n";
		$this->_print_cp_footer();
	}

}

function _exec_add_rssc( $op_mode )
{
	$lid = $this->get_post_lid();

	$code = $this->_exec_add_rssc_detail( $lid, $op_mode );
	switch ($code)
	{
		case RSSC_CODE_DISCOVER_FAILED;
			redirect_header('link_list.php?sortid=1', 3, _RSSC_DISCOVER_FAILED);
			exit();

		case RSSC_CODE_LINK_ALREADY:
			redirect_header('link_list.php?sortid=1', 3, _RSSC_LINK_ALREADY);
			exit();

		case WEBLINKS_CODE_RSSC_NOT_FIND_PARAM:
			redirect_header('link_list.php?sortid=1', 1, _WLS_NEWLINKADDED);
			exit();
	}

	$this->_print_cp_header();
	$this->_print_bread_add_link( $op_mode );

	switch ($code)
	{
		case 0:
			$this->_show_form_refresh_link( $lid, $this->_rssc_newid, $op_mode );
			break;

		case WEBLINKS_CODE_DB_ERROR:
		case RSSC_CODE_DB_ERROR:
			$this->_print_db_error(1);
			break;

		default:
			$this->_print_rssc_error( $code );
			$this->_show_form_add_rssc( $lid, $op_mode );
			break;
	}

	$this->_print_cp_footer();
}

function _exec_add_rssc_detail( $lid, $op_mode )
{
// create object
	$rssc_obj =& $this->_handler->create_new_rssc_obj( $lid, 'add_rssc' );

// check
	if ( !$this->_check_input_param( $rssc_obj ) )
	{
		return WEBLINKS_CODE_PARAM_ERROR;
	}

	$code = $rssc_obj->check_necessary_param();
	if ( $code != 0 )
	{
		return $code;
	}

// if already exist in rssc module
	$rssc_lid = $this->_handler->check_get_rssc_exist_lid( $rssc_obj );
	if ( $rssc_lid )
	{

// --- update existed rssc_lid to link ---
		$ret = $this->_link_handler->update_rssc_lid( $lid, $rssc_lid );
		if ( !$ret )
		{
			$this->_set_errors( $this->_link_handler->getErrors() );
			return WEBLINKS_CODE_DB_ERROR;
		}

// print already message
		return RSSC_CODE_LINK_ALREADY;
	}

// === add new record to rssc link table ===
	$rssc_newid = $this->_handler->add_link( $rssc_obj );
	if ( !$rssc_newid )
	{
		$this->_set_errors( $this->_handler->getErrors() );
		return WEBLINKS_CODE_DB_ERROR;
	}

// --- update new rssc_lid to link ---
	$ret = $this->_link_handler->update_rssc_lid( $lid, $rssc_newid );
	if ( !$ret )
	{
		$this->_set_errors( $this->_link_handler->getErrors() );
		return WEBLINKS_CODE_DB_ERROR;
	}

	$this->_rssc_newid = $rssc_newid;
	return 0;
}

function _check_input_param( &$rssc_obj )
{
// check post paramter
	$ret = $this->_handler->check_post_param( $rssc_obj );
	if ( !$ret )
	{
		$this->_set_errors( $this->_handler->getErrors() );
		return false;
	}
	return true;
}

function _print_rssc_error( $code )
{
	switch ( $code )
	{
		case WEBLINKS_CODE_DB_ERROR:
		case RSSC_CODE_DB_ERROR:
			$this->_print_db_error(1);
			break;

		case RSSC_CODE_LINK_NOT_EXIST:
			xoops_error( _RSSC_LINK_NOT_EXIST );
			$this->_print_error(1);
			echo "<br />\n";
			break;

		case RSSC_CODE_DISCOVER_SUCCEEDED:
			echo "<h4>"._RSSC_DISCOVER_SUCCEEDED."</h4>\n";
			break;

		case RSSC_CODE_DISCOVER_FAILED:
			xoops_error( _RSSC_DISCOVER_FAILED );
			echo "<br />\n";
			break;

		case RSSC_CODE_LINK_ALREADY:
			$this->_print_link_already();
			break;

		case WEBLINKS_CODE_PARAM_ERROR:
		default:
			echo "<hr />\n";
			echo $this->getErrors(1);
			echo "<hr />\n";
			break;

	}

	return 0;
}

//---------------------------------------------------------
// mod_form
//---------------------------------------------------------
function check_mod_form( &$link_obj )
{
	$lid      = $link_obj->get('lid');
	$rssc_lid = $link_obj->get('rssc_lid');

	if ( $rssc_lid == 0 )
	{
		return 0;	// not set value
	}

	$rssc_link_obj =& $this->_handler->get_rssc_link( $rssc_lid );
	if ( !is_object($rssc_link_obj) )
	{
		xoops_error( _RSSC_LINK_NOT_EXIST );
		echo "<br />\n";
		return RSSC_CODE_LINK_NOT_EXIST;
	}

// create 
	$rssc_obj =& $this->_handler->create_exist_rssc_obj_by_lid( $lid );

// if more same links in rssc module
	$rssc_lid = $this->_handler->check_get_rssc_exist_lid( $rssc_obj );
	if ( $rssc_lid )
	{

// print already message
		$this->_print_link_more();
		return RSSC_CODE_LINK_EXIST_MORE;
	}

	return 0;
}

//---------------------------------------------------------
// mod_link
//---------------------------------------------------------
function mod_link( $op_mode )
{
	$lid = $this->get_post_lid();
	if ( !$this->_get_link_obj( $lid ) )
	{
		redirect_header("link_list.php", 3, _WLS_ERRORNOLINK);
		exit();
	}

	$this->_print_cp_header();
	$this->_print_bread_add_link($op_mode);

	echo '<h4 style="color: #0000ff;">'._WLS_DBUPDATED."</h4>\n";
	echo "<hr />\n";
	echo "<h4>"._AM_WEBLINKS_MOD_RSSC."</h4>\n";

	if ( $this->_exec_mod_link( $lid ) )
	{
		$this->_show_form_add_rssc( $lid, $op_mode );
	}
	else
	{
		$this->_print_db_error(1);
	}

	$this->_print_cp_footer();
}

function _exec_mod_link( $lid )
{
// create object
	$rssc_obj =& $this->_handler->create_rssc_obj_by_lid( $lid );

// discover result
	$this->_print_discover_result( $rssc_obj );

	$saved_rssc_lid   = $this->_link_obj->get('rssc_lid');
	$current_rssc_lid = $rssc_obj->get('rssc_lid');

// when not set rssc_lid
	if ( ($saved_rssc_lid == 0 )&&( $current_rssc_lid == 0 ))
	{
// if already exist in rssc module
		$rssc_lid = $this->_handler->check_get_rssc_exist_lid( $rssc_obj );
		if ( $rssc_lid )
		{
// --- update existed rssc_lid to link ---
			$ret = $this->_link_handler->update_rssc_lid( $lid, $rssc_lid );
			if ( !$ret )
			{
				$this->_set_errors( $this->_link_handler->getErrors() );
				return false;	// db error
			}

// print already message
			$this->_print_link_already();
		}
	}

	return true;
}

//---------------------------------------------------------
// mod_rssc
//---------------------------------------------------------
function mod_rssc()
{
	$lid = $this->get_post_lid();
	if ( !$this->_get_link_obj( $lid ) )
	{
		redirect_header("link_list.php", 3, _WLS_ERRORNOLINK);
		exit();
	}

	if( !$this->_check_token() ) 
	{
		redirect_header("link_list.php", 3, "Token Error");
		exit();
	}

	$op_mode = $this->get_post_op_mode();

	if ( WEBLINKS_RSSC_USE )
	{
		$this->_exec_mod_rssc($op_mode);
		exit();
	}
	else
	{
		$this->_print_cp_header();
		$this->_print_bread_add_link($op_mode);
		echo "<h4> No Action </h4>\n";
		$this->_print_cp_footer();
	}

}

function _exec_mod_rssc($op_mode)
{
	$lid  = $this->get_post_lid();
	$code = $this->_exec_mod_rssc_detail( $lid );

	switch ($code)
	{
		case RSSC_CODE_DISCOVER_FAILED;
			redirect_header('link_list.php', 3, _RSSC_DISCOVER_FAILED);
			exit();

		case RSSC_CODE_LINK_ALREADY:
			redirect_header('link_list.php', 3, _RSSC_LINK_ALREADY);
			exit();

		case WEBLINKS_CODE_RSSC_NOT_FIND_PARAM:
		case 0:
			$msg  = _WLS_DBUPDATED;
			$msg .= $this->build_comment( 'rssc no action' );	// for test form
			redirect_header('link_list.php', 1, $msg);
			exit();
	}

	$this->_print_cp_header();
	$this->_print_bread_add_link($op_mode);

	switch ($code)
	{
		case WEBLINKS_CODE_ADD_RSSC_SUCCEEDED:
			$this->_show_form_refresh_link( $lid, $this->_rssc_newid, $op_mode );
			break;

		case RSSC_CODE_LINK_NOT_EXIST:
			$this->_print_rssc_error( $code );
			break;

		case WEBLINKS_CODE_DB_ERROR:
		case RSSC_CODE_DB_ERROR:
			$this->_print_db_error(1);
			break;

		default:
			$this->_print_rssc_error( $code );
			$this->_show_form_add_rssc( $lid, $op_mode );
			break;
	}

	$this->_print_cp_footer();
}

function _exec_mod_rssc_detail( $lid )
{
	$link_obj =& $this->_get_link_obj( $lid );

// create object
	$rssc_obj =& $this->_handler->create_rssc_obj_by_lid( $lid, 'add_rssc' );

// check
	if ( !$this->_check_input_param( $rssc_obj ) )
	{
		return WEBLINKS_CODE_PARAM_ERROR;
	}

	$saved_rssc_lid   = $link_obj->get('rssc_lid');
	$current_rssc_lid = $rssc_obj->get('rssc_lid');

// when not set rssc_lid
	if (( $saved_rssc_lid == 0 )&&( $current_rssc_lid == 0 ))
	{

// if already exist in rssc module
		$rssc_lid = $this->_handler->check_get_rssc_exist_lid( $rssc_obj );
		if ( $rssc_lid )
		{
// --- update existed rssc_lid to link ---
			$ret = $this->_link_handler->update_rssc_lid( $lid, $rssc_lid );
			if ( !$ret )
			{
				$this->_set_errors( $this->_link_handler->getErrors() );
				return WEBLINKS_CODE_DB_ERROR;
			}

			return RSSC_CODE_LINK_ALREADY;
		}

		$code = $rssc_obj->check_necessary_param( 'add' );
		if ( $code != 0 )
		{
			return $code;
		}

// === add new record to rssc link table ===
		$rssc_newid = $this->_handler->add_link( $rssc_obj );
		if ( !$rssc_newid )
		{
			$this->_set_errors( $this->_handler->getErrors() );
			return WEBLINKS_CODE_DB_ERROR;
		}

// --- update new rssc_lid to link ---
		$ret = $this->_link_handler->update_rssc_lid( $lid, $rssc_newid );
		if ( !$ret )
		{
			$this->_set_errors( $this->_link_handler->getErrors() );
			return WEBLINKS_CODE_DB_ERROR;
		}

		$this->_rssc_newid = $rssc_newid;
		return WEBLINKS_CODE_ADD_RSSC_SUCCEEDED;
	}

// when set rssc_lid, and not change the setting.
	elseif (( $saved_rssc_lid )&&( $current_rssc_lid == $saved_rssc_lid ))
	{
		$code = $rssc_obj->check_necessary_param( 'mod' );
		if ( $code != 0 )
		{
			return $code;
		}

// === modify record into rssc link table ===
		$ret = $this->_handler->mod_link( $rssc_obj );
		if ( !$ret )
		{
			$this->_set_errors(  $this->_handler->getErrors() );
			return $this->_handler->getErrorCode();
		}
	}

	return 0;
}

//---------------------------------------------------------
// refresh_link
//---------------------------------------------------------
function refresh_link()
{
	if ( !$this->_get_rssc_link_obj() )
	{
		redirect_header( 'link_list.php', 3, $this->_LANG_ERR_NO_RECORD );
		exit();
	}

	if( !$this->_check_token() ) 
	{
		redirect_header("link_list.php", 3, "Token Error");
		exit();
	}

	$op_mode = $this->get_post_op_mode();

	if ( WEBLINKS_RSSC_USE )
	{
		$this->_exec_refresh_link($op_mode);
		exit();
	}
	else
	{
		$this->_print_cp_header();
		$this->_print_bread_refresh_link($op_mode);
		echo "<h4> No Action </h4>\n";
		$this->_print_cp_footer();
		exit();
	}
}

function _exec_refresh_link($op_mode)
{
	$lid      = $this->get_post_lid();
	$rssc_lid = $this->get_post_rssc_lid();

// === refresh rss feeds ===
	$code = $this->_handler->refresh_link_for_add_link( $rssc_lid );
	switch ( $code )
	{
		case 0:
			$msg  = _RSSC_REFRESH_LINK_FINISHED;
			$msg .= $this->build_comment( 'refresh' );	// for test form
			redirect_header('link_list.php?sortid=1', 1, $msg);
			exit();
			break;

		case RSSC_CODE_PARSE_MSG:
			$msg  = _RSSC_REFRESH_LINK_FINISHED;
			$msg .= "<br /><br />";
			$msg .= $this->_handler->get_parse_result();
			redirect_header('link_list.php?sortid=1', 3, $msg);
			exit();
			break;
	}

	switch ( $code )
	{
		case RSSC_CODE_DB_ERROR:
			$this->_error_title = "DB Error";
			break;

		case RSSC_CODE_PARSE_NOT_READ_XML_URL:
			$this->_error_title = _RSSC_PARSE_NOT_READ_XML_URL;
			break;

		case RSSC_CODE_PARSE_FAILED:
			$this->_error_title = _RSSC_PARSE_FAILED;
			break;

		case RSSC_CODE_REFRESH_ERROR:
			$this->_error_title = _RSSC_REFRESH_ERROR;
			break;

		default:
			$this->_error_title = "Error";
			break;
	}

	$this->_set_errors( $this->_handler->getErrors() );

	switch ($op_mode)
	{
		case 'mod_link':
		case WEBLINKS_OP_APPROVE_MOD:	// approve_mod
			$list_url = 'link_list.php?sortid=0';
			break;

		case 'add_link':
		case WEBLINKS_OP_APPROVE_NEW:	// approve_new
		default:
			$list_url = 'link_list.php?sortid=1';
			break;
	}

	$mod_url = 'link_manage.php?op=mod_form&amp;lid='.$lid;

	$this->_print_cp_header();
	$this->_print_bread_refresh_link($op_mode);
	echo $this->_print_error(1);
	echo "<br /><hr /><br />\n";
	echo '- <a href="'.$list_url.'">'._WEBLINKS_ADMIN_LINK_LIST."</a><br />\n";
	echo '- <a href="'.$mod_url.'">'. _WLS_MODLINK. "</a><br />\n";
	$this->_print_cp_footer();
}

//---------------------------------------------------------
// print message
//---------------------------------------------------------
function _print_discover_result( &$rssc_obj )
{
// discover result
	$code = $rssc_obj->get('auto_code');
	switch ( $code )
	{
		case RSSC_CODE_DISCOVER_SUCCEEDED:
			echo "<h4>"._RSSC_DISCOVER_SUCCEEDED."</h4>\n";
			break;

		case RSSC_CODE_DISCOVER_FAILED:
			xoops_error( _RSSC_DISCOVER_FAILED );
			echo "<br />\n";
			break;
	}
}

function _print_link_already()
{
	$msg = $this->_handler->get_exist_list_msg();
	if ( $msg )
	{
		xoops_error( _RSSC_LINK_ALREADY );
		echo "<br />\n";
		echo $msg;
		echo "<br />\n";
	}
}

function _print_link_more()
{
	$msg = $this->_handler->get_exist_list_msg();
	if ( $msg )
	{
		xoops_error( _RSSC_LINK_EXIST_MORE );
		echo "<br />\n";
		echo $msg;
		echo "<br />\n";
	}
}

//---------------------------------------------------------
// print bread
//---------------------------------------------------------
function _print_bread_add_link($op_mode)
{
	$lid = $this->get_post_lid();

	switch ($op_mode)
	{
		case 'mod_link':
			$name1 = _WLS_MODLINK;
			$url1   = 'link_manage.php?op=mod_form&amp;lid='.$lid;
			$name2 = _AM_WEBLINKS_MOD_RSSC;
			break;

		case WEBLINKS_OP_APPROVE_NEW:	// approve_new
			$name1 = _AM_WEBLINKS_APPROVE;
			$url1   = '';
			$name2 = _AM_WEBLINKS_ADD_RSSC;
			break;

		case WEBLINKS_OP_APPROVE_MOD:	// approve_mod
			$name1 = _AM_WEBLINKS_APPROVE_MOD;
			$url1   = '';
			$name2 = _AM_WEBLINKS_MOD_RSSC;
			break;

		case 'add_link':
		default:
			$name1 = _WEBLINKS_ADMIN_ADD_LINK;
			$url1   = 'link_manage.php?op=add_form';
			$name2 = _AM_WEBLINKS_ADD_RSSC;
			break;
	}

	$this->_print_bread_common($name1, $url1, $name2);
}

function _print_bread_refresh_link($op_mode)
{

	$lid = $this->get_post_lid();

	switch ($op_mode)
	{
		case 'mod_link':
			$name1 = _WLS_MODLINK;
			$url1  = 'link_manage.php?op=mod_form&amp;lid='.$lid;
			break;

		case WEBLINKS_OP_APPROVE_NEW:	// approve_new
			$name1 = _AM_WEBLINKS_APPROVE;
			$url1  = '';
			break;

		case WEBLINKS_OP_APPROVE_MOD:	// approve_mod
			$name1 = _AM_WEBLINKS_APPROVE_MOD;
			$url1  = '';
			break;

		case 'add_link':
		default:
			$name1 = _WEBLINKS_ADMIN_ADD_LINK;
			$url1  = 'link_manage.php?op=add_form';
			break;
	}

	$name2 = _AM_WEBLINKS_REFRESH_RSSC;

	$this->_print_bread_common($name1, $url1, $name2);
}

function _print_bread_common($name1, $url1, $name2)
{
	$arr = array(
		array(
			'name' => $this->_system->get_module_name(),
			'url'  => 'index.php',
		),
		array(
			'name' => $name1,
			'url'  => $url1,
		),
		array(
			'name' => $name2,
		),
	);

	echo $this->_build_html_bread_crumb( $arr );
	$this->_print_title($name1);

}

//---------------------------------------------------------
// check POST param & set error
//---------------------------------------------------------
function build_comment($str)
{
	$text = ' <!-- weblinks : '.$str.' -->'."\n";
	return $text;
}

//---------------------------------------------------------
// handler
//---------------------------------------------------------
function _get_link_obj( $lid )
{
	$obj =& $this->_link_handler->get($lid);
	if ( is_object($obj) ) 
	{
		$this->_link_obj =& $obj;
	}
	return $obj;
}

function _get_rssc_link_obj()
{
	$rssc_lid = $this->get_post_rssc_lid();
	$obj =& $this->_handler->get_rssc_link($rssc_lid);
	if ( is_object($obj) ) 
	{
		$this->_rssc_link_obj =& $obj;
	}
	return $obj;
}

//---------------------------------------------------------
// show rssc form
//---------------------------------------------------------
function _show_form_add_rssc( $lid, $op_mode )
{
	$rssc_obj =& $this->_handler->create_rssc_obj_by_lid( $lid );
	$this->_form->show_add_rssc( $rssc_obj, $op_mode );
}

function _show_form_refresh_link( $lid, $rssc_lid, $op_mode )
{
	$this->_form->show_refresh_link( $lid, $rssc_lid, $op_mode );
}

function _build_html_bread_crumb( $arr )
{
	return $this->_form->build_html_bread_crumb( $arr );
}

//---------------------------------------------------------
// private print
//---------------------------------------------------------
function _print_menu()
{
	weblinks_admin_print_header();
	weblinks_admin_print_menu();
}

// --- class end ---
}

?>