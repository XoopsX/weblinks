<?php
// $Id: weblinks_link_form_mod_approve_handler.php,v 1.1 2011/12/29 14:33:10 ohwada Exp $

// 2007-11-01
// WEBLINKS_OP_APPROVE_MOD

// 2007-09-20 K.OHWADA
// BUG: Use of undefined constant _AM_WEBLINKS_WAITING_DEL

// 2007-09-01 K.OHWADA
// divid from weblinks_link_form_admin_handler.php
// add_approve_check_confirm()

//=========================================================
// WebLinks Module
// 2006-10-05 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('weblinks_link_form_mod_approve_handler') ) 
{

//=========================================================
// class weblinks_link_form_mod_approve_handler
//=========================================================
class weblinks_link_form_mod_approve_handler extends weblinks_link_form_admin_handler
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_link_form_mod_approve_handler( $dirname )
{
	$this->weblinks_link_form_admin_handler( $dirname );
}

//---------------------------------------------------------
// show_admin_mod_approve_form
//---------------------------------------------------------
function show_admin_mod_approve_form($form_mode, $mid=0)
{
	$this->_form_mode = $form_mode;
	$this->_mid       = $mid;

	$this->init();
	$this->begin_admin_form();

	$linkitem_arr = $this->_load_define();

	$form_title   = _WLS_MODREQUESTS;
	$submit_value = _WLS_APPROVE;
	$op           =  WEBLINKS_OP_APPROVE_MOD;	// approve_mod
	$button_name  = 'refuse_mod';
	$button_value = _WLS_IGNORE;

	switch ($form_mode)
	{
		case 'preview':
			$edit_obj =& $this->get_edit_modify( $mid );
			if ( !is_object($edit_obj) )
			{
				echo "no modify record mid=$mid <br />\n";
				return false;
			}
			$edit_obj->build_admin_approve_modify_preview();
			break;

		case WEBLINKS_OP_APPROVE_MOD:	// approve_mod
		default:
			$edit_obj =& $this->get_edit_modify( $mid );
			if ( !is_object($edit_obj) )
			{
				echo "no modify record mid=$mid <br />\n";
				return false;
			}
			$edit_obj->build_admin_approve_modify();
			break;
	}

	$edit_obj->set('mid', $mid);
	$this->set_obj( $edit_obj );

	$lid = $edit_obj->get('lid');
	$saved_obj =& $this->get_edit( $lid );
	if ( !is_object($saved_obj) )
	{
		echo "no link record lid=$lid <br />\n";
		return false;
	}

	$saved_obj->build_admin_modify( $lid );
	$this->set_saved_obj( $saved_obj );

	foreach ($linkitem_arr as $id => $linkitem )
	{
		$form  = $linkitem['admin_form'];

		switch ($form)
		{
			case 'hidden':
				$this->add_hidden_by_id($id);
				break;

			case 'text':
				$this->add_text_by_id($id);
				$this->add_admin_text_saved($id);
				break;

			case 'textarea':
				$this->add_textarea_by_id($id);
				$this->add_admin_textarea_saved($id);
				break;

			case 'dhtml':
				$this->add_user_dhtml_by_id($id);
				$this->add_admin_textarea_saved($id);
				break;

			case 'checkbox':
				$this->add_checkbox_by_id($id);
				$this->add_admin_checkbox_saved($id);
				break;

			case 'yesno':
				$this->add_yesno_by_id($id);
				$this->add_admin_yesno_saved($id);
				break;

			case 'url':
				$this->add_url_by_id($id);
				$this->add_admin_url_saved($id);
				break;

			case 'mid':
				$this->add_admin_id($id);
				break;

			case 'lid':
				$this->add_admin_id($id);
				break;

			case 'uid':
				$this->add_admin_uid($id);
				$this->add_admin_uid_saved($id);
				$this->add_approve_check_confirm($id);
				break;

			case 'time_create':
				$this->add_admin_time_create($id);
				break;

			case 'time_update':
				$this->add_admin_time_update($id);
				break;

			case 'time_publish':
				$this->add_time_publish($id);
				$this->add_admin_time_saved($id);
				break;

			case 'time_expire':
				$this->add_time_expire($id);
				$this->add_admin_time_saved($id);
				break;

			case 'cat':
				$this->add_cat_by_id($id);
				$this->add_admin_cat_saved($id);
				break;

			case 'admincomment':
				$this->add_admin_admincomment_saved($id);
				break;

			case 'banner':
				$this->add_admin_banner($id);
				$this->add_admin_banner_saved($id);
				break;

			case 'rss_url':
				$this->add_rss_url_by_id($id);
				$this->add_admin_rss_url_saved($id);
				break;

			case 'name':
				$this->add_name_by_id($id);
				$this->add_admin_name_saved($id);
				$this->add_approve_check_confirm($id);
				break;

			case 'mail':
				$this->add_mail_by_id($id);
				$this->add_admin_mail_saved($id);
				$this->add_approve_check_confirm($id);
				break;

			case 'passwd':
				$this->add_admin_passwd_approve($id);
				break;

// google map
			case 'gm_latitude':
				$this->add_gm_latitude_by_id($id);
				$this->add_admin_text_saved($id);
				break;

// forum_id
			case 'forum_id':
				$this->add_admin_forum_id($id);
				$this->add_admin_forum_id_saved($id);
				break;

// album_id
			case 'album_id':
				$this->add_admin_album_id($id);
				$this->add_admin_album_id_saved($id);
				break;

			case 'notify':
			case 'none':
			default:
				break;
		}
	}

// print form
	$button = $this->_build_button( $submit_value, $button_name, $button_value );
	$this->_print_form( $form_title, $op, $button );
	return true;
}

//---------------------------------------------------------
// get cache
//---------------------------------------------------------
function _modified_msg($id)
{
	$text = null;
	if ( !$this->_compare_saved($id) )
	{
		$text = $this->_build_modified_msg();
	}
	return $text;
}

function _build_modified_msg()
{
	$text = '<div class="weblinks_form_modified">'. _AM_WEBLINKS_MODIFIED. '</div>'."\n";
	return $text;
}

function _compare_saved($id)
{
	if ( isset($this->_linkitem_arr[$id]) )
	{
		$linkitem    = $this->_linkitem_arr[$id];
		$name        = $linkitem['name'];
		$user_value  = $this->get_obj_var($name, 'n');
		$saved_value = $this->get_saved_obj_var($name, 'n');

		if ( $user_value == $saved_value )
		{	return true;	}
	}
	return false;
}

//---------------------------------------------------------
// admin original item
//---------------------------------------------------------
function add_admin_text_saved($id)
{
	list( $cap, $name, $saved_value, $opt, $admin_form, $mode ) = $this->get_saved_param($id);
	$text  = $this->_modified_msg($id);
	$text .= $this->_build_value_when_empty( $saved_value );
	$this->add_buff( '', $text );
}

function add_admin_uid_saved($id)
{
	list( $cap, $name, $saved_value, $opt, $admin_form, $mode ) = $this->get_saved_param($id);

	$link_uname = $this->build_user_link_uname_by_uid($saved_value);
	$link_email = $this->build_user_link_email_by_uid($saved_value);
	$text  = $this->_modified_msg($id);
	$text .= $saved_value ."&nbsp;&nbsp;". $link_uname ."&nbsp;&nbsp;". $link_email;
	$cap   =  $this->_build_caption( _WLS_OWNER );

	$this->add_label($cap, $text);
}

function add_admin_checkbox_saved($id)
{
	list( $cap, $name, $saved_value, $opt, $admin_form, $mode ) = $this->get_saved_param($id);
	$text  = $this->_modified_msg($id);
	$text .= $this->_build_value_checked( $saved_value, $opt );
	$this->add_buff( '', $text );
}

function add_admin_yesno_saved($id)
{
	list( $cap, $name, $saved_value, $opt, $admin_form, $mode ) = $this->get_saved_param($id);
	$opt_yesno =& $this->get_form_radio_yesno_options();
	$text  = $this->_modified_msg($id);
	$text .= $this->_build_value_checked( $saved_value, $opt_yesno );
	$this->add_buff( '', $text );
}

function add_admin_url_saved($id)
{
	list( $cap, $name, $saved_value, $opt, $admin_form, $mode ) = $this->get_saved_param($id);
	$text  = $this->_modified_msg($id);
	$text .= $saved_value;
	$text .= $this->build_edit_visit($saved_value);
	$this->add_buff( '', $text );
}

function add_admin_banner_saved($id)
{
	list( $cap, $name, $saved_value, $opt, $admin_form, $mode ) = $this->get_saved_param($id);

	$width  = $this->get_saved_obj_var('width');
	$height = $this->get_saved_obj_var('height');

	if ($saved_value)
	{
		$text  = $saved_value;
		$text .= $this->build_edit_visit($saved_value);
		$text .= "<br />\n";
		$text .= $this->build_html_img_tag($saved_value, $width, $height, 0, 'banner');
	}
	else
	{
		$text = '---';
	}

	$this->add_buff( '', $text );
}

function add_admin_rss_url_saved($id)
{
	list( $cap, $name, $saved_value, $opt, $admin_form, $mode ) = $this->get_saved_param($id);

	$name2  = 'rss_flag';
	$value2 = $this->get_obj_var($name2);
	$opt2   = $this->_get_options_by_name($name2);

	$text  = $this->_modified_msg($id);
	if ($saved_value)
	{
		$text .= $saved_value;
		$text .= $this->build_edit_visit($saved_value);
	}
	else
	{
		$text .= '---';
	}

	$text .= "<br />\n";
	$text .= $this->_build_value_checked( $value2, $opt2 );
	$this->add_buff( '', $text );
}

function add_admin_name_saved($id)
{
	list( $cap, $name, $saved_value, $opt, $admin_form, $mode ) = $this->get_saved_param($id);
	$this->add_admin_name_mail_saved($id, $saved_value, 'nameflag');
}

function add_admin_mail_saved($id)
{
	list( $cap, $name, $saved_value, $opt, $admin_form, $mode ) = $this->get_saved_param($id);
	$this->add_admin_name_mail_saved($id, $saved_value, 'mailflag');
}

function add_admin_name_mail_saved($id, $value1, $name2)
{
	$value2 = $this->get_obj_var($name2);
	$opt2   = $this->_get_options_by_name($name2);

	$text  = $this->_modified_msg($id);
	$text .= $this->_build_value_when_empty($value1)."<br />";
	$text .= $this->_build_value_checked($value2, $opt2);
	$this->add_buff( '', $text );
}

function add_admin_time_saved($id)
{
	list( $cap, $name, $saved_value, $opt, $admin_form, $mode ) = $this->get_saved_param($id);

	$text = $this->_modified_msg($id);
	if ( $saved_value ) {
		$text .= formatTimestamp($saved_value, 'l');
	} else {
		$text .= '---';
	}

	$this->add_buff( '', $text );
}

function add_admin_textarea_saved($id)
{
	list( $cap, $name, $saved_value, $opt, $admin_form, $mode ) = $this->get_saved_param($id);

	$text = $this->_modified_msg($id);
	if ( $saved_value == '') {
		$text .= '---';
	} else {
		$text .= $this->_build_show_textarea($saved_value, 1);
	}

	$this->add_buff( '', $text );
}

function add_admin_admincomment_saved($id)
{
	list( $cap, $name, $saved_value, $opt, $admin_form, $mode ) = $this->get_saved_param($id);

	$text  = $this->_modified_msg($id);
	$text .= _WEBLINKS_ADMIN_PRESENT_SAVE."<br />\n";
	$text .= $this->build_html_textarea($name, $saved_value, $this->TEXTAREA_ROW, $this->TEXTAREA_COL);
	$this->add_buff( $cap, $text );
}

function add_admin_cat_saved($id)
{
	$flag_modified = false;
	$user_cid_arr  = $this->get_obj_var('cid_arr');
	$saved_cid_arr = $this->get_saved_obj_var('cid_arr');

	$catpath= '';
	foreach ( $saved_cid_arr as $cid )
	{
		$catpath .= $this->_category_handler->build_cat_path($cid, 's');
		$catpath .= "<br />\n";
		if ( !in_array($cid, $user_cid_arr) )
		{
			$flag_modified = true;
		}
	}

	$text = '';
	if ( $flag_modified ) 
	{
		$text .= $this->_build_modified_msg();
	}
	$text .= $catpath;

	$this->add_buff( '', $text );
}

function add_admin_forum_id_saved($id)
{
	list( $cap, $name, $saved_value, $opt, $admin_form, $mode ) = $this->get_saved_param($id);

	$forums = $this->_plugin->get_categories_for_link_forum();

	$text  = $this->_modified_msg($id);
	if ( isset($forums[$saved_value]) ) {
		$text .= $forums[$saved_value];
	} else {
		$text .= '---';
	}

	$this->add_buff( '', $text );
}

function add_admin_album_id_saved($id)
{
	list( $cap, $name, $saved_value, $opt, $admin_form, $mode ) = $this->get_saved_param($id);

	$albums = $this->_plugin->get_categories_for_link_album();

	$text  = $this->_modified_msg($id);
	if ( isset($albums[$saved_value]) ) {
		$text .= $albums[$saved_value];
	} else {
		$text .= '---';
	}

	$this->add_buff( '', $text );
}

//---------------------------------------------------------
// approve
//---------------------------------------------------------
function add_approve_check_confirm($id)
{
	list( $cap, $name, $saved_value, $opt, $admin_form, $mode ) = $this->get_saved_param($id);

	$checked_value = 1;
	$confirm_name  = $name.'_confirm';
	$confirm_value = $this->_post->get_post_int( $confirm_name );
	$checked = $this->build_html_checked( $checked_value, $confirm_value );

	$text  = $this->build_html_input_checkbox( $confirm_name, $checked_value, $checked );
	$text .= ' <span style="color:#0000ff;" >'. _AM_WEBLINKS_CHECK_CONFIRM .'</span>';
	$this->add_buff( '', $text );
}

//---------------------------------------------------------
// delete form
//---------------------------------------------------------
function show_admin_approve_del_form( &$modify_obj )
{
	$mid    = $modify_obj->get('mid');
	$reason = $modify_obj->getVar('usercomment', 's');

// --- form start---
	echo $this->build_form_begin( 'aprrove_form' );
	echo $this->build_token();
	echo $this->build_html_input_hidden('op', 'approve_del_confirm' );
	echo $this->build_html_input_hidden('mid', $mid );

	echo $this->build_form_table_begin();

// BUG: Use of undefined constant _AM_WEBLINKS_WAITING_DEL
	echo $this->build_form_table_title( _AM_WEBLINKS_DEL_REQS );

	echo $this->build_form_table_line( 'reason', $reason );

	$button = $this->_build_button( _WLS_APPROVE, 'refuse_del', _WLS_IGNORE );
	echo $this->build_form_table_line('', $button, 'foot', 'foot');

	echo $this->build_form_table_end();
	echo $this->build_form_end();
// --- form end ---

}

// --- class end ---
}

// === class end ===
}

?>