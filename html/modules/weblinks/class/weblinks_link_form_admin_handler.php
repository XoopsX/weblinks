<?php
// $Id: weblinks_link_form_admin_handler.php,v 1.2 2012/04/09 10:20:05 ohwada Exp $

// 2012-04-02 K.OHWADA
// weblinks_webmap

// 2008-02-17 K.OHWADA
// add_admin_gm_kml()
// change build_edit_url_with_visit()
// add_admin_time_create -> add_admin_time

// 2007-11-01
// WEBLINKS_OP_APPROVE_NEW

// 2007-09-20 K.OHWADA
// rssc_lid_flag_update in show_admin_banner_form()

// 2007-09-01 K.OHWADA
// divid to weblinks_link_form_mod_approve_handler.php
// BUG: $edit_obj->get('mid', $mid) => $edit_obj->set('mid', $mid);
// REQ 4514: user can set time_publish

// 2007-08-01 K.OHWADA
// weblinks_header

// 2007-06-10 K.OHWADA
// d3forum
// change add_admin_forum_id()

// 2007-03-31 K.OHWADA
// BUG 4533: dont show album selceter in admin form

// 2007-03-25 K.OHWADA
// add_admin_album_id()
// change add_admin_forum_id()

// 2007-02-20 K.OHWADA
// user can use textarea1
// add_admin_forum_id()
// show_admin_update_cat_form()

// 2006-12-10 K.OHWADA
// add add_admin_time() add_admin_dhtml_textarea()

// 2006-10-14 K.OHWADA
// use _AM_WEBLINKS_ADD_BANNER

// 2006-10-05 K.OHWADA
// this is new file
// use rssc WEBLINKS_RSSC_USE
// divid from weblinks_link_form_handler
// google map

//=========================================================
// WebLinks Module
// 2006-10-05 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('weblinks_link_form_admin_handler') ) 
{

//=========================================================
// class weblinks_link_form_admin_handler
//=========================================================
class weblinks_link_form_admin_handler extends weblinks_link_form_handler
{
	var $_header;
	var $_plugin;
	var $_saved_obj = null;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_link_form_admin_handler( $dirname )
{
	$this->weblinks_link_form_handler( $dirname );
	$this->_header  =& weblinks_header::getInstance( $dirname );
	$this->_plugin  =& weblinks_plugin::getInstance( $dirname );
}

//---------------------------------------------------------
// init
//---------------------------------------------------------
function begin_admin_form()
{
	$this->clear_local();
	$this->set_flag_owner( true );
	$this->_flag_admin_caption = true;
	$this->_flag_url_visit = 1;
	$this->_mode_banner_size = 0;

	$this->_conf_dhtml_option = array(
		'dohtml'    => true,
		'dosmiley'  => true,
		'doxcode'   => true,
		'doimage'   => true,
		'dobr'      => true,
		'dohtml1'   => true,
		'dosmiley1' => true,
		'doxcode1'  => true,
		'doimage1'  => true,
		'dobr1'     => true,
	);

// print header
	echo $this->_header->build_module_header_submit();
}

//---------------------------------------------------------
// show_admin_form
//---------------------------------------------------------
function show_admin_form($form_mode, $id=0)
{
	$this->_form_mode = $form_mode;
	$this->_id        = $id;

	$this->init();
	$this->begin_admin_form();

// webmap
	$ret = $this->_webmap_class->init_form();
	if ( $ret == 1 ) {
		$this->_flag_webmap = true;
		$this->_webmap_class->set_lid( $id );
		$this->_webmap_class->set_display_url();
		echo $this->_webmap_class->get_form_js( false );

	} elseif ( $ret == -1 ) {
		xoops_error( $this->_webmap_class->get_init_error() );
	}

	$linkitem_arr = $this->_load_define();

	$lid = 0;
	$mid = 0;
	$desc_disp      = '';
	$flag_label     = false;
	$flag_broken    = false;
	$button_name    = '';
	$button_value   = '';
	$button_name_2  = '';
	$button_value_2 = '';
	$button_name_3  = '';
	$button_value_3 = '';

// password
	$passwd_new = $this->_post->get_post_text('passwd_new');
	$passwd_2   = $this->_post->get_post_text('passwd_2');

	switch ($form_mode)
	{
		case 'modify':
		case 'modify_preview':
			$form_title     = _WLS_MODLINK;
			$submit_value   = _WLS_MODIFY;
			$op             = 'modLinkS';
			$button_name    = 'del_form';
			$button_value   = _DELETE;
			$button_name_2  = 'clone_link';
			$button_value_2 = _AM_WEBLINKS_CLONE_LINK;
			$button_name_3  = 'clone_module';
			$button_value_3 = _AM_WEBLINKS_CLONE_MODULE;
			$flag_broken    = true;
			$flag_label     = true;
			break;

		case  WEBLINKS_OP_APPROVE_NEW:	// approve_new
		case 'approve_preview':
			$form_title   = _WLS_MODREQUESTS;
			$submit_value = _WLS_APPROVE;
			$op           =  WEBLINKS_OP_APPROVE_NEW;	// approve_new
			$button_name  = 'refuse_new';
			$button_value = _WLS_IGNORE;
			break;

		case 'submit':
		case 'submit_preview':
		default:
			$form_title   = _WLS_ADDNEWLINK;
			$submit_value = _WLS_ADD;
			$op           = 'addLinkS';
			$button_name  = '';
			$button_value = '';
			break;
	}

	switch ($form_mode)
	{
		case 'modify':
			$lid = intval($id);
			$edit_obj =& $this->get_edit( $lid );
			if ( !is_object($edit_obj) )
			{
				echo "no link record lid=$lid <br />\n";
				return false;
			}
			$edit_obj->build_admin_modify($lid);
			break;

		case  WEBLINKS_OP_APPROVE_NEW:	// approve_new
			$mid = intval($id);
			$edit_obj =& $this->get_edit_modify( $mid );
			if ( !is_object($edit_obj) )
			{
				echo "no modify record mid=$mid <br />\n";
				return false;
			}
			$edit_obj->build_admin_approve();
			break;

		case 'submit_preview':
			$edit_obj =& $this->create_edit();
			$edit_obj->build_admin_submit_preview();
			break;

		case 'modify_preview':
			$lid = $this->_post->get_post_int('lid');
			$edit_obj =& $this->get_edit( $lid );
			if ( !is_object($edit_obj) )
			{
				echo "no link record lid=$lid <br />\n";
				return false;
			}
			$edit_obj->build_admin_modify_preview();
			break;

		case 'approve_preview':
			$mid = $this->_post->get_post_int('mid');
			$edit_obj =& $this->get_edit_modify( $mid );
			if ( !is_object($edit_obj) )
			{
				echo "no modify record mid=$mid <br />\n";
				return false;
			}
			$edit_obj->build_admin_approve_preview();
			break;

		case 'submit':
		default:
			$edit_obj =& $this->create_edit();
			$edit_obj->build_admin_submit();
			break;
	}

	$edit_obj->set('lid', $lid);
	$edit_obj->set('mid', $mid);
	$this->set_obj( $edit_obj );

	switch ($form_mode)
	{
		case 'modify':
		case  WEBLINKS_OP_APPROVE_NEW:	// approve_new
			$cid_arr = $this->get_obj_var('cid_arr');
			if ( !is_array($cid_arr) || !count($cid_arr) )
			{
				xoops_error("No Category");
				echo "<br />\n";
			}
			break;
	}

	switch ($form_mode)
	{
		case 'modify':
		case 'modify_preview':
			$url   = '../singlelink.php?lid='.$lid;
			$title = $this->get_obj_var('title');
			echo '<a href="'.$url.'">'._WEBLINKS_GOTO_SINGLELINK.': '.$title."</a><br /><br />\n";
			break;
	}

	foreach ($linkitem_arr as $id => $linkitem )
	{
		$form  = $linkitem['admin_form'];

		switch ($form)
		{
			case 'break_line':
				$this->add_break_line_by_id($id);
				break;

			case 'hidden':
				$this->add_hidden_by_id($id);
				break;

			case 'label':
				if ( $flag_label )
				{
					$this->add_label_by_id($id);
				}
				break;

			case 'label_float':
				if ( $flag_label )
				{
					$this->add_label_float_by_id($id);
				}
				break;

			case 'text':
				$this->add_text_by_id($id);
				break;

			case 'textarea':
			case 'admincomment':
				$this->add_textarea_by_id($id);
				break;

			case 'dhtml':
				$this->add_dhtml_by_id($id);
				break;

			case 'url':
				$this->add_url_by_id($id);
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

			case 'mid':
				$this->add_admin_id($id);
				break;

			case 'lid':
				$this->add_admin_id($id);
				break;

			case 'uid':
				$this->add_admin_uid($id);
				break;

			case 'label_time':
				$this->add_admin_label_time($id);
				break;

			case 'time_update':
				$this->add_admin_time_update($id);
				break;

			case 'time_publish':
				$this->add_time_publish($id);
				break;

			case 'time_expire':
				$this->add_time_expire($id);
				break;

			case 'cat':
				$this->add_cat_by_id($id);
				break;

			case 'broken':
				if ($flag_broken)
				{
					$this->add_admin_broken($id);
				}
				break;

			case 'banner':
				$this->add_admin_banner($id);
				break;

			case 'banner_size':
				$this->add_admin_banner_size($id);
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

			case 'passwd':
				$this->add_admin_passwd($id);
				break;

// rssc
			case 'rssc_lid':
				if ( WEBLINKS_RSSC_USE )
				{
					$this->add_admin_rssc_lid($id);
				}
				break;

// google map
			case 'gm_latitude':
				$this->add_gm_latitude_by_id($id);
				break;

			case 'gm_icon':
				$this->add_gm_icon_by_id($id);
				break;

			case 'gm_kml':
				$this->add_admin_gm_kml($id);
				break;

// forum_id
			case 'forum_id':
				$this->add_admin_forum_id($id);
				break;

// album_id
			case 'album_id':
				$this->add_admin_album_id($id);
				break;

			case 'notify':
			case 'none':
			default:
				break;
		}
	}

// print form
	$button  = $this->_build_button( $submit_value, $button_name, $button_value );
	$button2 = '';
	if ( $button_name_2 )
	{
		$button2 .= $this->build_html_input_submit( $button_name_2, $button_value_2 );
	}
	if ( $button_name_3 )
	{
		$button2 .= ' '.$this->build_html_input_submit( $button_name_3, $button_value_3 );
	}
	$this->_print_form( $form_title, $op, $button, $button2 );

	return true;
}

//---------------------------------------------------------
// get cache
//---------------------------------------------------------
function set_saved_obj(&$obj)
{
	$this->_saved_obj = $obj;
}

function get_saved_obj_var($key, $format='s')
{
	$val = $this->_saved_obj->getVar($key, $format);
	return $val;
}

function get_admin_param($id)
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
		$form  = $linkitem['admin_form'];
		$mode  = $linkitem['user_mode'];
		$opt   = $linkitem['options'];
		$cap   = $this->_build_caption_by_itemid($id);
		$value = $this->get_obj_var($name);
	}

	return array( $cap, $name, $value, $opt, $form, $mode );
}

function get_saved_param($id)
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
		$form  = $linkitem['admin_form'];
		$mode  = $linkitem['user_mode'];
		$opt   = $linkitem['options'];
		$cap   = $this->_build_caption_by_itemid($id);
		$value = $this->get_saved_obj_var($name);
	}

	return array( $cap, $name, $value, $opt, $form, $mode );
}

//---------------------------------------------------------
// link item
//---------------------------------------------------------
function add_admin_label_time($id)
{
	list( $cap, $name, $value, $opt, $admin_form, $mode ) = $this->get_admin_param($id);

	$text = '---';
	if ($value)
	{
		$text = formatTimestamp($value, 'l');
	}
	$this->add_buff( $cap, $text );
}

function add_admin_id($id)
{
	list( $cap, $name, $value, $opt, $admin_form, $mode ) = $this->get_admin_param($id);

	if ($value > 0)
	{
		$id_s = "<b>".$value."</b>";
		$this->add_label_by_id($id);
		$this->add_hidden_by_id($id);
	}
}

function add_admin_uid($id)
{
	list( $cap, $name, $value, $opt, $admin_form, $mode ) = $this->get_admin_param($id);

	$this->add_text_by_id($id);

	$link_uname = $this->build_user_link_uname_by_uid( $value );
	$link_email = $this->build_user_link_email_by_uid( $value );
	$value2 = $link_uname."&nbsp;&nbsp;".$link_email;
	$cap2  =  $this->_build_caption( _WLS_SUBMITTER );
	$text2 = $this->_build_value_when_empty( $value2 );
	$this->add_buff($cap2, $text2);
}

function add_admin_time_update($id)
{
	list( $cap, $name, $value, $opt, $admin_form, $mode ) = $this->get_admin_param($id);

	$text = '---';
	if ($value)
	{
		$name2 = 'time_update_flag_update';
		$val2  = $this->get_obj_var($name2);
		$text  = formatTimestamp($value, 'l');
		$text .= "<br />\n";
		$text .= $this->build_html_input_radio_select($name2, $val2, $opt);
	}
	$this->add_buff( $cap, $text );
}

function add_admin_broken($id)
{
	list( $cap, $name, $value, $opt, $admin_form, $mode ) = $this->get_admin_param($id);

	$text = $this->build_html_input_text($name, $value, $this->TEXT_SIZE, $this->TEXT_MAX);

	$lid = $this->get_obj_var('lid');
	$broken_count = $this->_broken_handler->get_count_by_lid($lid);
	if ( $broken_count )
	{
		$text .= "<br />\n";
		$text .= $this->build_html_highlight(' Broken Report');
	}

	$this->add_buff( $cap, $text );
}

function add_admin_banner($id)
{
	list( $cap, $name, $value, $opt, $admin_form, $mode ) = $this->get_admin_param($id);

	$width  = $this->get_obj_var('width');
	$height = $this->get_obj_var('height');
	$text   = $this->build_edit_url_with_visit( $name, $value, $this->URL_SIZE, $this->URL_MAX );

	if ($value)
	{
		$text .= "<br />\n";
		$text .= $this->build_html_img_tag($value, $width, $height, 0, 'banner');
	}

	$this->add_buff( $cap, $text );
}

function add_admin_banner_size($id)
{
	if ( $this->_mode_banner_size )
	{
		$this->add_text_by_id($id);
	}
	else
	{
		$this->add_label_by_id($id);
	}
}

function add_admin_gm_kml($id)
{
	list( $cap, $name, $value, $opt, $admin_form, $mode ) = $this->get_admin_param($id);

	$text = '';

	if ( ( $this->get_obj_var('gm_latitude')  != 0 ) ||
	     ( $this->get_obj_var('gm_longitude') != 0 ) ||
	     ( $this->get_obj_var('gm_zoom')      != 0 ) )
	{
		$lid   = $this->get_obj_var('lid');
		$url   = $this->_WEBLINKS_URL.'/admin/build_kml.php?lid='.$lid;
		$title = $this->_get_define_by_itemid($id, 'title');
		$text  = $this->build_html_a_href_name($url, $title, '_target' );
	}

	$this->add_label( $cap, $text );
}

function add_admin_rssc_lid($id)
{
	list( $cap, $name, $value, $opt, $admin_form, $mode ) = $this->get_admin_param($id);

	switch ($this->_form_mode)
	{
		case 'modify':
		case 'modify_preview':
		case  WEBLINKS_OP_APPROVE_NEW:	// approve_new
		case 'approve_preview':
			$cap1  = $this->_build_caption( _RSSC_RSSC_LID );
			$text1 = $this->build_html_input_text($name, $value, $this->TEXT_SIZE, $this->TEXT_MAX);
			if ( $value )
			{
				$url = WEBLINKS_RSSC_URL.'/admin/link_manage.php?op=mod_form&lid='.$value;
				$name2 = _RSSC_GOTO_RSSC_ADMIN_LINK;
				$text1 .= '<br />'.$this->build_html_a_href_name($url, $name2);
			}
			$this->add_buff( $cap1, $text1 );

			$name2 = 'rssc_lid_flag_update';
			$cap2  = $this->_build_caption( _RSSC_RSSC_LID_UPDATE );
			$text2 = $this->build_form_radio_yesno($name2, $this->get_obj_var($name2) );
			$this->add_buff( $cap2, $text2 );
			break;

		case 'submit':
		case 'submit_preview':
		default:
			break;
	}
}

function add_admin_forum_id($id)
{
	list( $cap, $name, $value, $opt, $form, $mode ) = $this->get_user_param($id);

	$options = $this->_plugin->get_options_for_link_forum();
	$text    = $this->build_html_select( $name, $value, $options );

	$dirname = $this->_config_handler->get_module_name( 'link_forum_dirname' );
	if ( $dirname )
	{
		$text .= ' in '.$dirname;
	}

	$this->add_buff( $cap, $text );
}

function add_admin_album_id($id)
{
	list( $cap, $name, $value, $opt, $form, $mode ) = $this->get_user_param($id);

// BUG 4533: dont show album selceter in admin form
	$options = $this->_plugin->get_options_for_link_album();

	$text    = $this->build_html_select( $name, $value, $options );

	$dirname = $this->_config_handler->get_module_name( 'link_album_dirname' );
	if ( $dirname )
	{
		$text .= ' in '.$dirname;
	}

	$this->add_buff( $cap, $text );
}

//---------------------------------------------------------
// build passwd
//---------------------------------------------------------
function add_admin_passwd($id)
{
	list( $cap, $name, $value, $opt, $admin_form, $mode ) = $this->get_admin_param($id);

	switch ($this->_form_mode)
	{
		case 'modify':
		case 'modify_preview':
			$this->add_passwd_mod_1( $id );
			break;

		case  WEBLINKS_OP_APPROVE_NEW:	// approve_new
		case 'approve_preview':
			$this->add_admin_passwd_approve( $id );
			break;

		case 'submit':
		case 'submit_preview':
		default:
			$this->add_admin_passwd_new( $id );
			break;
	}
}

function add_admin_passwd_new($id)
{
	list( $cap, $name, $value, $opt, $admin_form, $mode ) = $this->get_admin_param($id);
	$text1 = $this->make_passwd_by_name( 'passwd_new' );
	$text2 = $this->make_passwd_by_name( 'passwd_2' );
	$this->add_buff( $cap, $text1.' '.$text2 );
}

function add_admin_passwd_approve($id)
{
	list( $cap, $name, $value, $opt, $admin_form, $mode ) = $this->get_admin_param($id);
	$name = 'passwd_md5';
	$this->add_hidden( $name, $value );
}

//---------------------------------------------------------
// admin image
//---------------------------------------------------------
function show_admin_banner_form( $lid, $width, $height, $op_mode )
{
	switch ($op_mode)
	{
		case 'mod_banner':
		case 'mod_banner_preview':
			$form_title = _AM_WEBLINKS_MOD_BANNER;
			$op         = 'mod_banner';
			$url_cancel = 'link_list.php';
			break;

		case 'add_banner':
		case 'add_banner_preview':
		default:
			$form_title = _AM_WEBLINKS_ADD_BANNER;
			$op         = 'add_banner';
			$url_cancel = 'link_list.php?sortid=1';
			break;
	}

	$obj =& $this->create_edit();
	$obj->build_admin_submit_preview();

	$this->set_obj( $obj );

	$banner = $obj->get('banner');

// --- form start---
	echo $this->build_form_begin( 'add_image' );
	echo $this->build_token();
	echo $this->build_html_input_hidden('op',       $op );
	echo $this->build_html_input_hidden('op_mode',  $op_mode );
	echo $this->build_html_input_hidden('lid',      $lid );
	echo $this->build_html_input_hidden('title',    $this->sanitize_text( $obj->get('title') ) );
	echo $this->build_html_input_hidden('url',      $this->sanitize_url(  $obj->get('url') ) );
	echo $this->build_html_input_hidden('rss_url',  $this->sanitize_url(  $obj->get('rss_url') ) );
	echo $this->build_html_input_hidden('rss_flag', $obj->get('rss_flag') );
	echo $this->build_html_input_hidden('rssc_lid', $obj->get('rssc_lid') );
	echo $this->build_html_input_hidden('rssc_lid_flag_update', $obj->get('rssc_lid_flag_update') );

	echo $this->build_form_table_begin();
	echo $this->build_form_table_title( $form_title );

	echo $this->build_form_table_line(_WLS_LINKID, $lid);
	echo $this->build_obj_table_label(_WLS_SITETITLE, 'title');

	$ele_banner = $this->build_edit_url_with_visit( 'banner', $banner, $this->URL_SIZE, $this->URL_MAX );

	if ($banner)
	{
		$ele_banner .= "<br /><br />\n";
		$ele_banner .= $this->build_html_img_tag($banner, $width, $height, 0, 'banner');
	}

	echo $this->build_form_table_line(_WLS_BANNERURL, $ele_banner);

	echo $this->build_form_table_text('width',  'width',  $width);
	echo $this->build_form_table_text('height', 'height', $height);

	$ele_submit   = $this->build_html_input_submit('submit', _HAPPY_LINUX_EXECUTE );
	$ele_skip     = $this->build_html_input_submit('skip',   _HAPPY_LINUX_SKIP_TO_NEXT );
	$ele_cancel   = $this->build_html_input_button_location('cancel', _CANCEL, $url_cancel);
	$ele_button   = $ele_submit.' '.$ele_skip.' '.$ele_cancel;
	echo $this->build_form_table_line('', $ele_button, 'foot', 'foot');

	echo $this->build_form_table_end();
	echo $this->build_form_end();
// --- form end ---

}

//---------------------------------------------------------
// admin category link count
//---------------------------------------------------------
function show_admin_update_cat_form( $lid, $op_mode )
{
	$url_cancel = 'link_list.php';

	$obj =& $this->create_edit();
	$obj->build_admin_submit_preview();

	$this->set_obj( $obj );

// --- form start---
	echo $this->build_form_begin( 'update_cat' );
	echo $this->build_token();
	echo $this->build_html_input_hidden('op',       'update_cat' );
	echo $this->build_html_input_hidden('op_mode',  $op_mode );
	echo $this->build_html_input_hidden('lid',      $lid );
	echo $this->build_html_input_hidden('title',    $this->sanitize_text( $obj->get('title') ) );
	echo $this->build_html_input_hidden('url',      $this->sanitize_url(  $obj->get('url') ) );
	echo $this->build_html_input_hidden('rss_url',  $this->sanitize_url(  $obj->get('rss_url') ) );
	echo $this->build_html_input_hidden('rss_flag', $obj->get('rss_flag') );
	echo $this->build_html_input_hidden('rssc_lid', $obj->get('rssc_lid') );
	echo $this->build_html_input_hidden('rssc_lid_flag_update', $obj->get('rssc_lid_flag_update') );

	echo $this->build_form_table_begin();
	echo $this->build_form_table_title( _AM_WEBLINKS_UPDATE_CAT_COUNT );

	$ele_submit   = $this->build_html_input_submit('submit', _HAPPY_LINUX_EXECUTE );
	$ele_skip     = $this->build_html_input_submit('skip',   _HAPPY_LINUX_SKIP_TO_NEXT );
	$ele_cancel   = $this->build_html_input_button_location('cancel', _CANCEL, $url_cancel);
	$ele_button   = $ele_submit.' '.$ele_skip.' '.$ele_cancel;
	echo $this->build_form_table_line('', $ele_button, 'foot', 'foot');

	echo $this->build_form_table_end();
	echo $this->build_form_end();
// --- form end ---

}

//---------------------------------------------------------
// admin clone module
//---------------------------------------------------------
function show_admin_clone_module_form( $lid )
{
	$url_cancel = 'link_list.php';

// --- form start---
	echo $this->build_form_begin( 'clone_module' );
	echo $this->build_token();
	echo $this->build_html_input_hidden('op',  'clone_module_to' );
	echo $this->build_html_input_hidden('lid', $lid );

	echo $this->build_form_table_begin();
	echo $this->build_form_table_title( _AM_WEBLINKS_CLONE_MODULE );

	$module_opts =& $this->_get_weblinks_module_list();
	if ( is_array($module_opts) && count($module_opts) )
	{
		$ele = $this->build_html_select( 'dirname', 0, $module_opts );
	}
	else
	{
		$ele = '<span style="color:#ff0000;">'. _AM_WEBLINKS_NO_MODULE .'</span>';
	}
	echo $this->build_form_table_line( _AM_WEBLINKS_DIRNAME_SEL, $ele );

	$ele_submit   = $this->build_html_input_submit('submit', _HAPPY_LINUX_EXECUTE );
	$ele_cancel   = $this->build_html_input_button_location('cancel', _CANCEL, $url_cancel);
	$ele_button   = $ele_submit.' '.$ele_cancel;
	echo $this->build_form_table_line('', $ele_button, 'foot', 'foot');

	echo $this->build_form_table_end();
	echo $this->build_form_end();
// --- form end ---

}

function show_admin_clone_module_confirm_form( $lid, $dirname )
{
	$action = xoops_getenv('PHP_SELF');
	list( $name, $val ) = $this->get_token();

	$hiddens = array(
		'op'     => 'clone_module_from',
		'from'   => $this->_system->get_mid(),
		'lid'    => $lid,
		$name    => $val,
	); 

	xoops_confirm( $hiddens, $action, _AM_WEBLINKS_CLONE_CONFIRM, _YES, false );

}

function &_get_weblinks_module_list()
{
	$param = array(
		'dirname_except'  => $this->_DIRNAME,
		'file'            => 'include/weblinks_version.php',
	);

	$modules  =& $this->_system->get_module_list( $param );
	$dirnames =& $this->_system->get_dirname_list( $modules, $param );

	return $dirnames;
}

// --- class end ---
}

// === class end ===
}

?>