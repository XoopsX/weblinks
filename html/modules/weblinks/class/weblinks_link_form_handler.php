<?php
// $Id: weblinks_link_form_handler.php,v 1.2 2011/12/29 19:54:56 ohwada Exp $

// 2011-12-29 K.OHWADA
// PHP 5.3 : Assigning the return value of new by reference is now deprecated.

// 2008-03-12 K.OHWADA
// BUG: guest cannot set new password when use password reminder

// 2008-02-17 K.OHWADA
// change build_edit_url_with_visit()

// 2007-11-01 K.OHWADA
// weblinks_auth
// change request from int to text
// build_nameflag_mailflag()

// 2007-09-20 K.OHWADA
// add passwd in show_del_confirm_form()
// flag_usercomment_indispensable

// 2007-09-01 K.OHWADA
// user can delete link
// REQ 4514: user can set time_publish
// build_button() add_time_publish()

// 2007-08-01 K.OHWADA
// weblinks_gmap

// 2007-03-25 K.OHWADA
// BUG 4520: dont work newline in textarea

// 2007-02-20 K.OHWADA
// user can use textarea1
// add add_captcha()

// 2006-12-10 K.OHWADA
// use build_form_dhtml_textarea()

// 2006-11-04 wye & K.OHWADA
// google map: inverse Geocoder
// google map: inline mode

// 2006-10-15 wye & K.OHWADA
// BUG 4313: same browser like opera cannot show gm_get_location.php

// 2006-10-01 K.OHWADA
// use happy_linux
// use rssc WEBLINKS_RSSC_USE
// get_link_by_name() -> get_obj_var()
// add _get_options_by_name()
// google map

// 2006-05-15 K.OHWADA
// this is new file
// use new handler
// include class/submit.php

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication
// move from include/submit_form.php

//=========================================================
// WebLinks Module
// 2006-05-15 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('weblinks_link_form_handler') ) 
{

//=========================================================
// class weblinks_link_form_handler
//=========================================================
class weblinks_link_form_handler extends happy_linux_form_lib
{
	var $_DIRNAME;
	var $_WEBLINKS_URL;

	var $TEXT_SIZE    =  50;
	var $TEXT_MAX     = 255;
	var $URL_SIZE     =  70;
	var $URL_MAX      = 255;
	var $PASSWD_SIZE  =  20;
	var $PASSWD_MAX   = 100;
	var $TEXTAREA_ROW =   5;
	var $TEXTAREA_COL =  60;
	var $DHTML_ROW    =  15;
	var $DHTML_COL    =  60;

	var $IMG_CHECKED;
	var $IMG_NO_CHECKED;

	var $_config_handler;
	var $_link_handler;
	var $_modify_handler;
	var $_category_handler;
	var $_catlink_handler;
	var $_broken_handler;
	var $_linkitem_define_handler;

	var $_auth;
	var $_gmap;
	var $_system;
	var $_post;

// config
	var $_conf;

// set parameter
	var $_flag_owner            = false;
	var $_flag_auth_modify_auto = false;
	var $_mode_notify_show      = 0;
	var $_flag_button_del       = false;

// local
	var $_buff          = array();
	var $_buff_hidden   = array();

	var $_flag_usercomment_indispensable = false;
	var $_flag_admin_caption = false;
	var $_flag_url_visit   = 0;
	var $_flag_desc_type   = 1;
	var $_mode_banner_size = 0;

	var $_conf_dhtml_option = array();

	var $_vars = null;

	var $_linkitem_arr = null;
	var $_form_mode = null;
	var $_lid       = 0;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_link_form_handler( $dirname )
{
	$this->happy_linux_form_lib();

	$this->_DIRNAME      = $dirname;
	$this->_WEBLINKS_URL = XOOPS_URL .'/modules/'. $dirname;

	$this->_config_handler   =& weblinks_get_handler( 'config2_basic', $dirname );
	$this->_link_handler     =& weblinks_get_handler( 'link',          $dirname );
	$this->_modify_handler   =& weblinks_get_handler( 'modify',        $dirname );
	$this->_category_handler =& weblinks_get_handler( 'category',      $dirname );
	$this->_catlink_handler  =& weblinks_get_handler( 'catlink',       $dirname );
	$this->_broken_handler   =& weblinks_get_handler( 'broken',        $dirname );
	$this->_linkitem_define_handler =& weblinks_get_handler( 'linkitem_define',  $dirname );

	$this->_auth    =& weblinks_auth::getInstance( $dirname );
	$this->_gmap    =& weblinks_gmap::getInstance( $dirname );
	$this->_system  =& happy_linux_system::getInstance();
	$this->_post    =& happy_linux_post::getInstance();

	$this->_conf = $this->_config_handler->get_conf();

	$image_checked   = $this->_WEBLINKS_URL .'/images/checked.gif';
	$image_nochecked = $this->_WEBLINKS_URL .'/images/nochecked.gif';
	$this->IMG_CHECKED    = '<img src="'. $image_checked   .'" border="0" alt="checked" />';
	$this->IMG_NO_CHECKED = '<img src="'. $image_nochecked .'" border="0" alt="nochecked" />';
}

//---------------------------------------------------------
// init
//---------------------------------------------------------
function init()
{
	$this->_category_handler->load();
}

function clear_local()
{
	$this->_buff          = array();
	$this->_buff_hidden   = array();

	$this->_flag_admin_caption = false;
	$this->_flag_url_visit   = 0;
	$this->_flag_desc_type   = 1;
}

function begin_form()
{
	$this->clear_local();
}

//---------------------------------------------------------
// dhtml param
//---------------------------------------------------------
function get_link_dhtml_size( $name )
{
	$row = $this->DHTML_ROW;
	$col = $this->DHTML_COL;

	return array($row, $col);
}

//---------------------------------------------------------
// show_user_form
//---------------------------------------------------------
function show_user_form($form_mode, $lid=0)
{

	$this->_form_mode = $form_mode;
	$this->_lid       = $lid;

	$this->init();
	$this->begin_form();

	$linkitem_arr = $this->_load_define();

	$this->_conf_dhtml_option = $this->_auth->has_auth_desc_option();

// password
	list($passwd_old, $flag_passwd, $flag_code)
		= $this->_post->get_post_get_passwd_old();

// request
	$request = $this->_post->get_post_text('request');

// BUG: guest cannot set new password when use password reminder
	if ( empty($request) && $flag_code )
	{
		$request = 'password';
	}

	switch ($form_mode)
	{
		case 'modify':
		case 'modify_preview':
			$form_title   = _WLS_REQUESTMOD;
			$submit_value = _EDIT;

// not owner and not auto
			if ( !$this->_flag_owner && !$this->_flag_auth_modify_auto )
			{
				$this->_flag_usercomment_indispensable = true;
			}
			break;

		case 'submit':
		case 'submit_preview':
		default:
			$form_title   = _WLS_SUBMITLINKHEAD;
			$submit_value = _REGISTER;
			break;
	}

	switch ($form_mode)
	{
		case 'modify':
			$edit_obj =& $this->get_edit( $lid );
			if ( !is_object($edit_obj) )
			{
				echo "no link record lid=$lid <br />\n";
				return false;
			}
			$edit_obj->build_modify($lid, $this->_flag_owner);
			break;

		case 'submit_preview':
			$edit_obj =& $this->create_edit();
			$edit_obj->build_submit_preview();
			break;

		case 'modify_preview':
			$lid = $this->_post->get_post_int('lid');
			$edit_obj =& $this->get_edit( $lid );
			if ( !is_object($edit_obj) )
			{
				echo "no link record lid=$lid <br />\n";
				return false;
			}
			$edit_obj->build_modify_preview();
			break;

		case 'submit':
		default:
			$edit_obj =& $this->create_edit();
			$edit_obj->build_submit();
			break;
	}

	$edit_obj->set('lid', $lid);
	$this->set_obj( $edit_obj );

	$this->add_hidden('request', $request );

	foreach ($linkitem_arr as $id => $linkitem )
	{
		$form  = $linkitem['user_form'];
		$mode  = $linkitem['user_mode'];

		if ($mode == 0)
		{
			$form = 'none';
		}

		switch ($form)
		{
			case 'break_line':
				$this->add_break_line_by_id($id);
				break;

			case 'hidden':
				$this->add_hidden_by_id($id);
				break;

			case 'text':
				$this->add_text_by_id($id);
				break;

			case 'textarea':
				$this->add_textarea_by_id($id);
				break;

			case 'user_dhtml':
				$this->add_user_dhtml_by_id($id);
				break;

			case 'radio':
				$this->add_radio_by_id($id);
				break;

			case 'checkbox':
				$this->add_checkbox_by_id($id);
				break;

			case 'yesno':
				$this->add_yesno_by_id($id);
				break;

			case 'url':
				$this->add_url_by_id($id);
				break;

			case 'lid':
				$this->add_lid_by_id($id);
				break;

			case 'cat':
				$this->add_cat_by_id($id);
				break;

			case 'rss_url':
				$this->add_rss_url_by_id($id);
				break;

			case 'name':
				$this->add_name_by_id($id);
				break;

			case 'mail':
				$this->add_mail_by_id($id);
				break;

			case 'usercomment':
				$this->add_usercomment_by_id($id);
				break;

			case 'passwd':
				$this->add_passwd_by_id($id);
				break;

			case 'notify':
				$this->add_notify_by_id($id);
				break;

// google map
			case 'gm_latitude':
				$this->add_gm_latitude_by_id($id);
				break;

// captcha
			case 'captcha':
				$this->add_captcha_by_id($id);
				break;

// time_publish
			case 'time_publish':
				$this->add_time_publish($id);
				break;

			case 'time_expire':
				$this->add_time_expire($id);
				break;

			case 'none':
			default:
				break;
		}
	}

// print form
	$button_1 = $this->_build_button( $submit_value, 'preview', _PREVIEW );

	$button_2 = null;
	if ( $this->_flag_button_del )
	{
		$button_2 = $this->build_html_input_submit( 'delete', _DELETE );
	}

	$this->_print_form( $form_title, 'save', $button_1, $button_2 );
	return true;

}

function _print_form( $form_title, $op, $button, $button_2=null )
{
	echo $this->build_form_begin();
	echo $this->build_token();
	echo $this->build_html_input_hidden('op', $op);

	$this->display_hidden();

	echo $this->build_form_table_begin();
	echo $this->build_form_table_title( $form_title );

	$this->display();

	echo $this->build_form_table_line('', $button, 'foot', 'foot');

	if ( $button_2 )
	{
		echo $this->build_form_table_line('', $button_2, 'foot', 'foot');
	}

	echo $this->build_form_table_end();
	echo $this->build_form_end();

}

function _build_button( $submit_value, $button_name, $button_value )
{
	$button1 = $this->build_html_input_submit('submit', $submit_value );
	$button2 = '';
	if ( $button_name )
	{
		$button2 = $this->build_html_input_submit( $button_name, $button_value );
	}
	$button3 = $this->build_html_input_button_cancel('cancel', _CANCEL);
	$button  = $button1.' '.$button2.' '.$button3;
	return $button;
}

//---------------------------------------------------------
// edit object
//---------------------------------------------------------
function &create_edit()
{
	$edit_obj = new weblinks_link_edit( $this->_DIRNAME );
	return $edit_obj;
}

function &get_edit($lid)
{
	$obj =& $this->_link_handler->get($lid);
	if ( !is_object($obj) )
	{
		$false = false;
		return $false;
	}

	$edit_obj =& $this->create_edit();
	$edit_obj->set_object($obj);
	return $edit_obj;
}

function &get_edit_modify($mid)
{
	$obj =& $this->_modify_handler->get($mid);
	if ( !is_object($obj) )
	{
		$false = false;
		return $false;
	}

	$edit_obj =& $this->create_edit();
	$edit_obj->set_object($obj);

	return $edit_obj;
}


//---------------------------------------------------------
// set buffer
//---------------------------------------------------------
function clear_tray()
{
	$this->_tray = array();
}

function add_tray_checkbox($name)
{
	$value   = $this->get_obj_var($name);
	$options = $this->_get_options_by_name($name);
	$this->_tray[] = $this->build_html_input_checkbox_select($name, $value, $options);
}

function get_tray()
{
	$text = '';

	foreach ($this->_tray as $tray)
	{
		$text .= $tray."<br />\n";
	}

	return $text;
}

function clear_buff()
{
	$this->_buff        = array();
	$this->_buff_hidden = array();
}

function add_buff($cap, $text, $flag_two_column=true)
{
	$this->_buff[] = array($cap, $text, $flag_two_column);
}

function add_buff_hidden($text)
{
	$this->_buff_hidden[] = $text;
}

function display()
{
	foreach ($this->_buff as $arr)
	{
		list($cap, $text, $flag_two_column) = $arr;
		
		if ($flag_two_column)
		{
			echo $this->build_form_table_line($cap, $text);
		}
		else
		{
			echo $this->display_line($text);
		}
	}
}

function display_hidden()
{
	foreach ($this->_buff_hidden as $text)
	{
		echo $text."\n";
	}
}

function display_line($val)
{
	$text  = '<tr align="left" valign="top"><td class="odd" colspan="2">'."\n";
	$text .= $val;
	$text .= "\n</td></tr>\n";
	return $text;
}

function get_user_param($id)
{
	$name  = null;
	$form  = null;
	$mode  = null;
	$opt   = null;
	$cap   = null;
	$value = null;

	if ( isset($this->_linkitem_arr[$id]) )
	{
		$linkitem = $this->_linkitem_arr[$id];
		$name  = $linkitem['name'];
		$form  = $linkitem['user_form'];
		$mode  = $linkitem['user_mode'];
		$opt   = $linkitem['options'];
		$cap   = $this->_build_caption_by_itemid($id);

// BUG 4520: dont work newline in textarea
		$value = $this->get_obj_var($name, 'n');
	}

	return array( $cap, $name, $value, $opt, $form, $mode );
}

//---------------------------------------------------------
// link item
//---------------------------------------------------------
function add_break_line_by_id($id)
{
	$this->add_buff( '', '', false );
}

function add_hidden_by_id($id)
{
	list( $cap, $name, $value, $opt, $form, $mode ) = $this->get_user_param($id);
	$this->add_hidden($name, $value);
}

function add_hidden($name, $value)
{
	$text = $this->build_html_input_hidden($name, $value);
	$this->add_buff_hidden( $text );
}

function add_label_by_id($id)
{
	list( $cap, $name, $value, $opt, $form, $mode ) = $this->get_user_param($id);
	$this->add_label( $cap, $value );
}

function add_label( $cap, $value )
{
	$text = $this->_build_value_when_empty( $value );
	$this->add_buff( $cap, $text );
}

function add_label_float_by_id($id)
{
	list( $cap, $name, $value, $opt, $form, $mode ) = $this->get_user_param($id);
	$text = number_format($value, 2);
	$this->add_buff( $cap, $text );
}

function add_text_by_id($id)
{
	list( $cap, $name, $value, $opt, $form, $mode ) = $this->get_user_param($id);
	$text = $this->build_html_input_text($name, $value, $this->TEXT_SIZE, $this->TEXT_MAX);
	$this->add_buff( $cap, $text );
}

function add_url_by_id($id)
{
	list( $cap, $name, $value, $opt, $form, $mode ) = $this->get_user_param($id);
	$text = $this->build_edit_url_with_visit($name, $value, $this->URL_SIZE, $this->URL_MAX);
	$this->add_buff( $cap, $text );
}

function add_textarea_by_id($id)
{
	list( $cap, $name, $value, $opt, $form, $mode ) = $this->get_user_param($id);
	$text = $this->build_html_textarea($name, $value, $this->TEXTAREA_ROW, $this->TEXTAREA_COL);
	$this->add_buff( $cap, $text );
}

function add_radio_by_id($id)
{
	list( $cap, $name, $value, $opt, $form, $mode ) = $this->get_user_param($id);
	$text = $this->build_html_input_radio_select($name, $value, $opt);
	$this->add_buff( $cap, $text );
}

function add_checkbox_by_id($id)
{
	list( $cap, $name, $value, $opt, $form, $mode ) = $this->get_user_param($id);
	$text = $this->build_html_input_checkbox_select($name, $value, $opt);
	$this->add_buff( $cap, $text );
}

function add_yesno_by_id($id)
{
	list( $cap, $name, $value, $opt, $form, $mode ) = $this->get_user_param($id);
	$text = $this->build_form_radio_yesno($name, $value);
	$this->add_buff( $cap, $text );
}

function add_lid_by_id($id)
{
	list( $cap, $name, $value, $opt, $form, $mode ) = $this->get_user_param($id);
	if ($value > 0)
	{
		$this->add_hidden($name, $value);
	}
}

function add_cat_by_id($id)
{
	list( $cap, $name, $value, $opt, $form, $mode ) = $this->get_user_param($id);
	$cid_arr = $this->get_obj_var('cid_arr');

	$file_popup = XOOPS_URL.'/modules/'.$this->_DIRNAME.'/catlist_popup.php';
	$onclick    = $this->build_xoops_openWithSelfMain($file_popup, "help", 400, 500);

	$text  = '<a href="#catlist" onclick="'.$onclick.'">'._WLS_CATLIST."</a><br />\n";
	$text .= $this->_category_handler->build_selbox_multi( $cid_arr );

	$this->add_buff( $cap, $text );
}

function add_rss_url_by_id($id)
{
	list( $cap, $name, $value, $opt, $form, $mode ) = $this->get_user_param($id);

	if ( WEBLINKS_RSSC_USE )
	{
		$rss_flag = $this->get_obj_var('rss_flag');
		$rss_opt  = $this->get_obj_var('rss_opt');

		$text  = $this->build_edit_url_with_visit('rss_url', $value, $this->URL_SIZE, $this->URL_MAX);
		$text .= "<br />\n";
		$text .= $this->build_html_input_radio_select('rss_flag', $rss_flag, $rss_opt);

		$this->add_buff( $cap, $text );
	}
}

function add_notify_by_id($id)
{
	if ( $this->_mode_notify_show == 1 ) 
	{
		$this->add_hidden_by_id($id);
	}
	elseif ( $this->_mode_notify_show == 2 ) 
	{
		$this->add_checkbox_by_id($id);
	}
}

function add_usercomment_by_id($id)
{
	list( $cap, $name, $value, $opt, $form, $mode ) = $this->get_user_param($id);
	$text = $this->build_html_textarea($name, $value, $this->TEXTAREA_ROW, $this->TEXTAREA_COL);

	if ( $this->_flag_usercomment_indispensable )
	{
		$title = $this->_get_define_by_itemid($id, 'title');
		$desc  = $this->_get_define_by_itemid($id, 'desc');
		$def   = '';
		$mode  = 2;
		$cap   = $this->_build_caption( $title, $desc, $def, $mode );
	}

	$this->add_buff( $cap, $text );
}

//---------------------------------------------------------
// name mail
//---------------------------------------------------------
function add_name_by_id($id)
{
	list( $cap, $name, $value, $opt, $form, $mode ) = $this->get_user_param($id);

	$text  = $this->build_html_input_text($name, $value, $this->TEXT_SIZE, $this->TEXT_MAX);
	$text .= $this->build_nameflag_mailflag('nameflag', $this->_conf['user_nameflag'] );

	$this->add_buff( $cap, $text );
}

function add_mail_by_id($id)
{
	list( $cap, $name, $value, $opt, $form, $mode ) = $this->get_user_param($id);

	$extra = '';
	if ( !$this->_system->is_user() )
	{
		$extra = "("._WLS_EMAIL_APPROVE.")";
	}

	$cap1  = $this->_build_caption_by_itemid($id, $extra);
	$text  = $this->build_html_input_text($name, $value, $this->TEXT_SIZE, $this->TEXT_MAX);
	$text .= $this->build_nameflag_mailflag('mailflag', $this->_conf['user_mailflag'] );

	$this->add_buff( $cap1, $text );
}

function build_nameflag_mailflag( $name, $mode )
{
	$text  = '';

	switch( $mode )
	{
		case 0:
			$this->add_hidden($name, 0);
			break;

		case 1:
			$this->add_hidden($name, 1);
			break;

		case 2:
		default:
			$value = $this->get_obj_var($name);
			$opt   = $this->_get_options_by_name($name);
			$text .= "<br />\n";
			$text .= $this->build_html_input_radio_select($name, $value, $opt);
			break;
	}

	return $text;
}

//---------------------------------------------------------
// build dhtml
//---------------------------------------------------------
function add_user_dhtml_by_id($id)
{
	list( $cap, $name, $value, $opt, $form, $mode ) = $this->get_user_param($id);

	$ext = $this->parse_tail_figure( $name );

	if ( $this->get_link_dhtml_type($ext) )
	{
		$this->add_dhtml_by_id($id);
	}
	else
	{
		$name_dhtml = $this->build_link_dhtml_name( $name );
		list($row, $col) = $this->get_link_dhtml_size( $name );

		$text = $this->build_html_textarea( $name_dhtml, $value, $row, $col );
		$this->add_buff( $cap, $text );

		$this->add_link_dhtml_options_hidden( $ext );
	}
}

function add_dhtml_by_id($id)
{
	list( $cap, $name, $value, $opt, $form, $mode ) = $this->get_user_param($id);

	$ext = $this->parse_tail_figure( $name );
	$name_dhtml = $this->build_link_dhtml_name( $name );
	list($row, $col) = $this->get_link_dhtml_size( $name );

	$text1 = $this->build_form_dhtml_textarea( $name_dhtml, $value, $row, $col );
	$this->add_buff( $cap, $text1 );

	$text2 = $this->build_link_dhtml_options( $ext );
	$this->add_buff( '', $text2 );

// BUG 4520: dont work newline in textarea
	$dhtml_disp = $this->get_obj_var( $name.'_disp', 'n' );
	if ( $dhtml_disp )
	{
		$text3 = $this->_build_show_textarea( $dhtml_disp );
		$this->add_buff( '', $text3 );
	}
}

function get_link_dhtml_type( $ext )
{
	$type = 0;	// default
	$name = 'type_desc';

	if ($ext)
	{
		$name = 'type_desc_'. $ext;
	}

	if ( isset($this->_conf[$name]) )
	{
		$type = $this->_conf[$name];
	}

	return $type;
}

function build_link_dhtml_name( $name )
{
// avoid the conflict of dhtml name
	$name_dhtml = 'weblinks_'.$name;
	return $name_dhtml;
}

function build_link_dhtml_options( $ext )
{
	$this->clear_tray();
	$this->add_dhtml_option_single( 'dohtml'.  $ext );
	$this->add_dhtml_option_single( 'dosmiley'.$ext );
	$this->add_dhtml_option_single( 'doxcode'. $ext );
	$this->add_dhtml_option_single( 'doimage'. $ext );
	$this->add_dhtml_option_single( 'dobr'.    $ext );
	$text = $this->get_tray();
	return $text;
}

function add_link_dhtml_options_hidden( $ext )
{

	$this->add_dhtml_option_hidden( 'dohtml'.  $ext );
	$this->add_dhtml_option_hidden( 'dosmiley'.$ext );
	$this->add_dhtml_option_hidden( 'doxcode'. $ext );
	$this->add_dhtml_option_hidden( 'doimage'. $ext );
	$this->add_dhtml_option_hidden( 'dobr'.    $ext );
}

function add_dhtml_option_hidden( $name )
{
	if ( isset($this->_conf_dhtml_option[$name]) && $this->_conf_dhtml_option[$name] )
	{
		$this->add_hidden($name, 1);
	}
}

function add_dhtml_option_single( $name )
{
	if ( isset($this->_conf_dhtml_option[$name]) && $this->_conf_dhtml_option[$name] )
	{
		$this->add_tray_checkbox( $name );
	}
}

//---------------------------------------------------------
// build google map
//---------------------------------------------------------
// google map: hacked by wye
function add_gm_latitude_by_id($id)
{
	list( $cap, $name, $value, $opt, $form, $mode ) = $this->get_user_param($id);

	$cap2 = $this->_build_caption( _WEBLINKS_GOOGLE_MAPS );
	$this->add_buff( $cap2, $this->build_gm_desc() );
	$this->add_buff( '',    $this->build_gm_iframe(), false );

	$text1 = $this->build_html_input_text($name, $value, $this->TEXT_SIZE, $this->TEXT_MAX);
	$this->add_buff( $cap, $text1 );
}

function build_gm_desc()
{
	$text = $this->_gmap->build_form_desc();
	return $text;
}

function build_gm_iframe()
{
	$text = $this->_gmap->build_form_iframe();
	return $text;
}

//---------------------------------------------------------
// build passwd
//---------------------------------------------------------
function add_passwd_by_id($id)
{
// no action, if NOT guest
	if ( !$this->_conf['use_passwd'] || !$this->_system->is_guest() )
	{
		return;
	}

	switch ( $this->_form_mode )
	{
		case 'modify':
		case 'modify_preview':
// if owner
			if ( $this->_flag_owner )
			{
				$this->add_passwd_mod_1( $id );
				$this->add_passwd_mod_2( $id );
			}
			break;

		case 'submit':
		case 'submit_preview':
		default:
			$this->add_passwd_new_1( $id );
			$this->add_passwd_new_2( $id );
			break;
	}
}

function add_passwd_new_1( $id )
{
	$title = $this->_get_define_by_itemid($id, 'title');
	$desc  = $this->_get_define_by_itemid($id, 'description');
	$cap   = $this->_build_caption( $title, $desc,    '', 2 );
	$text  = $this->make_passwd_by_name( 'passwd_new' );
	$this->add_buff( $cap, $text );
}

function add_passwd_new_2( $id )
{
	$cap  = $this->_build_caption( _US_VERIFYPASS, '', '', 2 );
	$text = $this->make_passwd_by_name( 'passwd_2' );
	$this->add_buff( $cap, $text );
}

function add_passwd_mod_1( $id )
{
	$cap   = $this->_build_caption_by_itemid($id, _US_TYPEPASSTWICE );
	$text1 = $this->make_passwd_by_name( 'passwd_new' );
	$text2 = $this->make_passwd_by_name( 'passwd_2' );
	$this->add_buff( $cap, $text1.' '.$text2 );
}

function add_passwd_mod_2( $id )
{
	$name = 'passwd_old';

	list($passwd_old, $flag_passwd, $flag_code)
		= $this->_post->get_post_get_passwd_old();

	$this->add_hidden( $name, $passwd_old );
}

function make_passwd_by_name($name)
{
	$value = '';
	$text  = $this->build_html_input_password($name, $value, $this->PASSWD_SIZE, $this->PASSWD_MAX);
	return $text;
}

//---------------------------------------------------------
// captcha
//---------------------------------------------------------
function add_captcha_by_id($id)
{
// no action, if NOT guest
	if ( !$this->_conf['use_captcha'] || !$this->_system->is_guest() || !file_exists(XOOPS_ROOT_PATH.'/modules/captcha/include/api.php') ) 
	{
		return;
	}

	$title = $this->_get_define_by_itemid($id, 'title');
	$desc  = $this->_get_define_by_itemid($id, 'description');
	$cap   = $this->_build_caption( $title, $desc,    '', 2 );

	include_once XOOPS_ROOT_PATH.'/modules/captcha/include/api.php';
	$captcha_api =& captcha_api::getInstance();
	$this->add_buff( $cap, $captcha_api->make_img_input() );
}

//---------------------------------------------------------
// time_publish
//---------------------------------------------------------
function add_time_publish($id)
{
	$this->add_formated_time($id, _WEBLINKS_TIME_PUBLISH_SET, _WEBLINKS_TIME_PUBLISH_DESC);
}

function add_time_expire($id)
{
	$this->add_formated_time($id, _WEBLINKS_TIME_EXPIRE_SET, _WEBLINKS_TIME_EXPIRE_DESC);
}

function add_formated_time($id, $title, $desc)
{
	list( $cap, $name, $value, $opt, $form, $mode ) = $this->get_user_param($id);

	$checked = '';
	if ($value)
	{
		$checked = 'checked';
	}

	$text  = $this->build_html_input_checkbox($name.'_flag', 1, $checked);
	$text .= $title;
	$text .= ': <span style="font-size: 80%;">';
	$text .= $desc;
	$text .= "</span><br />\n";
	$text .= $this->build_form_select_time($name, $value);
	$this->add_buff( $cap, $text );

	$this->add_hidden( $name.'_unix', $value );
}

//---------------------------------------------------------
// build item
//---------------------------------------------------------
function _build_show_textarea($value, $flag=0)
{
	$text  = '<table border="1" bordercolor="black" cellpadding="0" cellspacing="0" width="100%">';
	$text .= "<tr><td>\n";

	if ($flag)
	{
		$text .= "<pre>";
	}

	$text .= $value;

	if ($flag)
	{
		$text .= "</pre>";
	}

	$text .= "</td></tr></table>\n";
	return $text;
}

function _build_value_checked($value, $opt_arr, $highlight='' )
{
	$text = '';

	foreach ( $opt_arr as $opt_key => $opt_value )
	{
		if ( $value == $opt_value)
		{
			if ($highlight === $value)
			{
				$text .= $this->IMG_CHECKED;
				$text .= ' <span style="color: #ff0000; font-weight: bold">'. $opt_key .'</span>';
			}
			else
			{
				$text .= $this->IMG_CHECKED." ".$opt_key;
			}
		}
		else
		{
			$text .= $this->IMG_NO_CHECKED." <s>".$opt_key."</s>";
		}

		$text .= " ";
	}

	return $text;
}

function _build_value_when_empty( $value )
{
	if ( $value == '')
	{
		return '---';
	}

	return $value;
}

//---------------------------------------------------------
// delete form
//---------------------------------------------------------
function show_del_confirm_form( $lid, $mid=0, $op='delete' )
{
	$action = xoops_getenv('PHP_SELF');
	list( $name, $val ) = $this->get_token();

	$request    = $this->_post->get_post_text('request');
	$passwd_old = $this->_post->get_post_text('passwd_old');

	$hiddens = array(
		'op'      => $op,
		'lid'     => $lid,
		'confirm' => 1,
		$name     => $val,
	); 

	if ( $mid )
	{
		$hiddens['mid'] = $mid;
	}
	if ( $request )
	{
		$hiddens['request'] = $request;
	}
	if ( $passwd_old )
	{
		$hiddens['passwd_old'] = $passwd_old;
	}

	xoops_confirm( $hiddens, $action, _WEBLINKS_DEL_LINK_CONFIRM, _YES, false );
}

function show_del_reason_form( $lid )
{
	$request    = $this->_post->get_post_text('request');
	$passwd_old = $this->_post->get_post_text('passwd_old');

	$url_cancel = $this->_WEBLINKS_URL. '/singlelink.php?lid='. $lid;

// --- form start---
	echo $this->build_form_begin( 'reason_form' );
	echo $this->build_token();
	echo $this->build_html_input_hidden('op',      'delete' );
	echo $this->build_html_input_hidden('confirm', 1 );
	echo $this->build_html_input_hidden('lid',     $lid );
	echo $this->build_html_input_hidden('notify',  $this->_post->get_post_int('notify') );

	if ( $request )
	{
		echo $this->build_html_input_hidden('request',  $request );
	}
	if ( $passwd_old )
	{
		echo $this->build_html_input_hidden('passwd_old',  $passwd_old );
	}

	echo $this->build_form_table_begin();
	echo $this->build_form_table_title( _WEBLINKS_DEL_LINK_CONFIRM );

	$cap  = $this->_build_caption( _WEBLINKS_DEL_LINK_REASON, '', '', 2 );
	$text = $this->build_html_textarea('reason', '', $this->TEXTAREA_ROW, $this->TEXTAREA_COL);
	echo $this->build_form_table_line( $cap, $text );

	$ele_submit   = $this->build_html_input_submit('delete', _HAPPY_LINUX_EXECUTE );
	$ele_cancel   = $this->build_html_input_button_location('cancel', _CANCEL, $url_cancel);
	$ele_button   = $ele_submit.' '.$ele_cancel;
	echo $this->build_form_table_line('', $ele_button, 'foot', 'foot');

	echo $this->build_form_table_end();
	echo $this->build_form_end();
// --- form end ---

}

//---------------------------------------------------------
// user_link
//---------------------------------------------------------
function build_user_link_uname_by_uid($uid)
{
	$uname = $this->_system->get_uname_by_uid( $uid );
	$link_uname = $uname;

	if ($uid != 0)
	{
		$url = XOOPS_URL.'/userinfo.php?uid='.$uid;
		$link_uname = $this->build_html_a_href_name( $url, $uname, '_blank' );
	}

	return $link_uname;
}

function build_user_link_email_by_uid($uid)
{
	$email = $this->_system->get_email_by_uid( $uid );
	$link_email = '';

	if ( ($uid != 0) && $email )
	{
		$link_email = $this->build_html_a_href_email( $email, '', '_blank' );
	}

	return $link_email;
}

//---------------------------------------------------------
// linkitem_define_handler
//---------------------------------------------------------
function _load_define()
{
	$this->_linkitem_arr =& $this->_linkitem_define_handler->load();
	return $this->_linkitem_arr;
}

function _get_name_by_itemid($id)
{
	$val = $this->_linkitem_define_handler->get_by_itemid($id, 'name');
	return $val;
}

function _get_define_by_itemid($id, $key)
{
	$val = $this->_linkitem_define_handler->get_by_itemid($id, $key);
	return $val;
}

function _get_options_by_name($name)
{
	$val = $this->_linkitem_define_handler->get_by_name($name, 'options');
	return $val;
}

function _get_define_by_name($name, $key)
{
	$val = $this->_linkitem_define_handler->get_by_name($name, $key);
	return $val;
}

function _build_caption_by_itemid($id, $extra='')
{
	$val = $this->_linkitem_define_handler->build_caption_by_itemid($id, $this->_flag_admin_caption, $extra);
	return $val;
}

function _build_caption( $title, $desc='', $title_def='', $mode=0, $flag=0, $extra='' )
{
	$val = $this->_linkitem_define_handler->build_caption( $title, $desc, $title_def, $mode, $flag, $extra );
	return $val;
}

//---------------------------------------------------------
// set parameter
//---------------------------------------------------------
function set_mode_notify($value)
{
	$this->_mode_notify_show = intval($value);
}

function set_flag_owner($value)
{
	$this->_flag_owner = (bool)$value;
}

function set_flag_auth_modify_auto($value)
{
	$this->_flag_auth_modify_auto = (bool)$value;
}

function set_flag_button_del($value)
{
	$this->_flag_button_del = (bool)$value;
}

// --- class end ---
}

// === class end ===
}

?>