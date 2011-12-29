<?php
// $Id: link_mod_class.php,v 1.1 2011/12/29 14:32:53 ohwada Exp $

// 2007-11-01 K.OHWADA
// set_edit_handler()

// 2007-09-20 K.OHWADA
// $rssc_lid_flag_update

// 2007-09-10 K.OHWADA
// general revision
// divid from link_manage.php

//=========================================================
// WebLinks Module
// 2004/01/14 K.OHWADA
//=========================================================

//=========================================================
// class admin_link_mod
//=========================================================
class admin_link_mod extends admin_link_base
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_link_mod()
{
	$this->admin_link_base();
	$this->set_edit_handler( 'link_mod' );

	$this->_votedata_handler =& weblinks_get_handler('votedata',  WEBLINKS_DIRNAME);
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_link_mod();
	}
	return $instance;
}

//---------------------------------------------------------
// mod_form
//---------------------------------------------------------
function mod_form()
{
	if ( !$this->_get_obj() )
	{
		redirect_header( 'link_list.php', 2, _WLS_ERRORNOLINK );
		exit();
	}

	$this->_print_cp_header();
	$this->_print_bread_op( _WLS_MODLINK, 'mod_form');
	$this->_print_title(    _WLS_MODLINK );

	if ( WEBLINKS_RSSC_USE )
	{
		$this->_check_rssc_lid();
		$this->_rssc_manage->check_mod_form( $this->_obj );
	}

	$this->_print_mod_form();
	$this->_print_cp_footer();
}

function _print_mod_form()
{
	$MAX_RECORD = 5;

	$lid = $this->get_post_lid();

	$this->_form->show_admin_form('modify', $lid);
	echo "<hr />\n";

	$list =& admin_votedata_list::getInstance();
	$list->set_perpage( $MAX_RECORD );
	$list->set_flag_get_sortid( false );
	$list->set_flag_print_top(  false );
	$list->set_flag_print_navi( false );

	$totalvotes = $this->_votedata_handler->get_count_by_lid($lid);
	echo "<h4>". sprintf(_WLS_TOTALVOTES, $totalvotes). "</h4>\n";

// Show Registered Users Votes
	$votes1 = $this->_votedata_handler->get_count_user_by_lid($lid);
	echo "<h4>". sprintf(_WLS_USERTOTALVOTES, $votes1). "</h4>\n";

	if ($votes1)
	{
		$list->set_form_name('votedata_user');
		$list->_show_by_sortid(2);
	}
	else
	{
		echo "<b>" ._WLS_NOREGVOTES."</b><br />\n";
	}
	
	if ($votes1 > $MAX_RECORD)
	{
		$url = 'votedata_list.php?sortid=2&amp;lid='.$lid;
		echo '<a href="'.$url.'">'. 'more ...' ."</a><br />\n";
	}

// Show Unregistered Users Votes
	$votes2 = $this->_votedata_handler->get_count_by_lid_uid($lid, 0);
	echo "<h4>". sprintf(_WLS_ANONTOTALVOTES, $votes2). "</h4>\n";

    if ( $votes2 )
    { 
		$list->set_form_name('votedata_anoymous');
		$list->_show_by_sortid(3);
    }
    else 
    {
		echo "<b>" ._WLS_NOUNREGVOTES."</b><br />\n";
    }
    
    if ($votes2 > $MAX_RECORD)
	{
		$url = 'votedata_list.php?sortid=3&amp;lid='.$lid;
		echo '<a href="'.$url.'">'. 'more ...' ."</a><br />\n";
	}
}

function _check_rssc_lid()
{
	$lid      = $this->_obj->get('lid');
	$rssc_lid = $this->_obj->get('rssc_lid');
	$objs =& $this->_handler->get_objects_rssc_lid($lid, $rssc_lid);

	if ( is_array($objs) && count($objs) )
	{
		echo '<h4 style="color:#ff0000">'. _AM_WEBLINKS_RSSC_LID_EXIST_MORE ."</h4>\n";
		echo "<ul>\n";
		foreach ( $objs as $obj )
		{
			$title_s = $obj->getVar('title', 's');
			$url     = $this->_build_url_mod_form( $obj->get('lid') );
			echo '<li><a href="'. $url .'">'. $title_s ."</a></li>\n";
		}
		echo "</ul><br />\n";
	}
}

function _build_url_mod_form( $lid )
{
	$url = 'link_manage.php?op=mod_form&amp;lid='.$lid;
	return $url;
}

//---------------------------------------------------------
// mod_link
//---------------------------------------------------------
function mod_link()
{
	$lid = $this->get_post_lid();
	$rssc_lid_flag_update = $this->get_post_rssc_lid_flag_update();

	if ( !$this->_get_obj() )
	{
		redirect_header("link_list.php", 3, _WLS_ERRORNOLINK);
		exit();
	}

	if ( !$this->_check_token() || !$this->_check_mod_link() )
	{
		$this->_print_mod_preview();
		exit();
	}

	if ( $this->_exec_mod_link( $lid ) )
	{
// when set banner
		if ( $this->get_post_banner() )
		{
			$this->_print_mod_banner_form( 'mod_banner' );
			exit();
		}
// when conf_cat_path
		elseif ( $this->_conf['cat_count'] )
		{
			$this->_print_update_cat_form( $lid, 'mod_link' );
			exit();
		}
// when rssc use
		elseif ( WEBLINKS_RSSC_USE && !$rssc_lid_flag_update )
		{
			$this->_rssc_manage->mod_link( 'mod_link' );
			exit();
		}

// finish
		$msg  = _WLS_DBUPDATED;
		$msg .= $this->_build_comment('admin mod link');	// for test form
		redirect_header('link_list.php', 1, $msg);
		exit();
	}
	else
	{
// Fatal error: Call to undefined method admin_link_mod::_print_mod_table_error()
		$this->_print_mod_db_error();
		exit();
	}
}

function _exec_mod_link( $lid )
{
	$ret = $this->_edit_handler->admin_mod_link( $lid );
	if ( $ret )
	{
		$this->_set_errors( $this->_edit_handler->getErrors() );
	}
	return true;
}

function _check_mod_link()
{
	$ret = $this->_check_handler->check_form_modlink_for_owner_by_post();
	if (!$ret)
	{
		$this->_set_errors( $this->_check_handler->get_errors_modlink() );
		return false;
	}
	return true;
}

function _print_mod_preview_form()
{
	$this->_form->show_admin_form('modify_preview');
}

function _print_mod_preview()
{
	$this->_print_cp_header();
	$this->_print_bread_op( $this->_LANG_TITLE_MOD, 'mod_form' );
	$this->_print_title(    $this->_LANG_TITLE_MOD );
	$this->_print_token_error(1);

	if ( $this->_error_title )
	{
		xoops_error( $this->_error_title );
		echo "<br />\n";
	}

	$err  = $this->getErrors(1);
	echo $this->_form->build_html_error_with_style( $err );
	echo "<br />\n";

	$this->_print_mod_preview_form();
	$this->_print_cp_footer();
}


//---------------------------------------------------------
// mod_banner
//---------------------------------------------------------
function _print_mod_banner_form( $op_mode )
{
	$this->_print_cp_header();
	$this->_print_bread_op( $this->_LANG_TITLE_MOD, 'mod_form', _AM_WEBLINKS_MOD_BANNER );

	if ( $op_mode == 'mod_banner' )
	{
		echo '<h4 style="color: #0000ff;">'._WLS_DBUPDATED."</h4>\n";
		echo "<hr />\n";
	}

	$this->_print_title( _AM_WEBLINKS_MOD_BANNER );
	$this->_print_banner_form_common( $this->_lid, $op_mode );
	$this->_print_cp_footer();
}

function mod_banner()
{
	$lid      = $this->get_post_lid();
	$rss_flag = $this->get_post_rss_flag();
	$skip     = $this->get_post_skip();
	$rssc_lid_flag_update = $this->get_post_rssc_lid_flag_update();

	if ( !$this->_check_token() )
	{
		$this->_print_mod_banner_form( 'mod_banner_preview' );
		exit();
	}

	if ( $skip || $this->_exec_banner_common() )
	{
// when conf_cat_path
		if ( $this->_conf['cat_count'] )
		{
			$this->_print_update_cat_form( $lid, 'mod_banner' );
			exit();
		}
// when rssc use
		elseif ( WEBLINKS_RSSC_USE && !$rssc_lid_flag_update )
		{
			$this->_rssc_manage->mod_link( 'mod_link' );
			exit();
		}

// finish
		$msg  = _WLS_DBUPDATED;
		$msg .= $this->_build_comment('mod banner');	// for test form
		redirect_header('link_list.php', 1, $msg);
		exit();
	}
	else
	{
		$this->_print_add_db_error();
		exit();
	}
}

// --- class end ---
}

?>