<?php
// $Id: admin_config_class.php,v 1.1 2011/12/29 14:32:52 ohwada Exp $

// 2008-02-17 K.OHWADA
// print_menu_7()

// 2007-11-11 K.OHWADA
// divid to admin_config_store_class.php
// divid to admin_config_menu_class.php
// rss_cache_clear
// build_lib_box_button_style()
// show country_code in select form

// 2007-09-01 K.OHWADA
// use_hits_singlelink

// 2007-08-01 K.OHWADA
// print_menu_5()

// 2007-06-10 K.OHWADA
// d3forum
// weblinks_config2_form

// 2007-03-25 K.OHWADA
// print_module_installed_by_conf()

// 2007-02-20 K.OHWADA
// renew config table
// print_forum_installed_by_conf()

// 2006-10-01 K.OHWADA
// use happy_linux
// use XoopsGTicket
// google map
// add renew_config() template_clear()

// 2006-05-15 K.OHWADA
// change for weblinks

//=========================================================
// WebLinks Module
// 2006-05-15 K.OHWADA
//================================================================

//================================================================
// class admin_config_form
//================================================================
class admin_config_form extends weblinks_config2_form
{
// handler
	var $_linkitem_form;
	var $_system;
	var $_dir;
	var $_menu;

// local
	var $_line_count = 0;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_config_form()
{
	$this->weblinks_config2_form( WEBLINKS_DIRNAME );
	$this->set_lib_box_div_class(        'weblinks_confirm' );
	$this->set_lib_box_span_title_class( 'weblinks_confirm_title' );

	$this->_linkitem_form  =& weblinks_linkitem_form::getInstance( WEBLINKS_DIRNAME );
	$this->_system =& happy_linux_system::getInstance();
	$this->_dir    =& happy_linux_dir::getInstance();
	$this->_menu   =& admin_config_menu::getInstance();

// init
	$this->load();
}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_config_form();
	}
	return $instance;
}

//---------------------------------------------------------
// init
//---------------------------------------------------------
function init_form()
{
//	$this->load();
}

//---------------------------------------------------------
// print
//---------------------------------------------------------
function print_menu_2()
{
	$this->_menu->print_menu_2();
}

function print_menu_3()
{
	$this->_menu->print_menu_3();
}

function print_menu_4()
{
	$this->_menu->print_menu_4();
}

function print_menu_5()
{
	$this->_menu->print_menu_5();
}

function print_menu_6()
{
	$this->_menu->print_menu_6();
}

function print_menu_7()
{
	$this->_menu->print_menu_7();
}

//---------------------------------------------------------
// show_auth
//---------------------------------------------------------
function show_form_auth($form_title)
{
	list($list_1, $list_2) = $this->get_group_list();

	$this->print_top('weblinks_config_auth', $form_title);

	$this->print_auth('auth_submit',      $list_1);
	$this->print_auth('auth_submit_auto', $list_1);
	$this->print_auth('auth_modify',      $list_2);
	$this->print_auth('auth_modify_auto', $list_2);
	$this->print_auth('auth_delete',      $list_2);
	$this->print_auth('auth_delete_auto', $list_2);
	$this->print_auth('auth_ratelink',    $list_1);

	$this->print_yesno('system_post_rate');
	$this->print_yesno('system_post_link');
	$this->print_yesno('use_brokenlink');

	$this->print_form_bottom();
}

function show_form_link_register($form_title)
{
	list($list_1, $list_2) = $this->get_group_list();

	$this->print_top('weblinks_config_link_register', $form_title);

	$this->print_auth('auth_dohtml',   $list_1);
	$this->print_auth('auth_dosmiley', $list_1);
	$this->print_auth('auth_doxcode',  $list_1);
	$this->print_auth('auth_doimage',  $list_1);
	$this->print_auth('auth_dobr',     $list_1);
	$this->print_yesno('type_desc');
	$this->print_text('desc_length');

	$this->print_form_bottom();
}

function show_form_link_register_1($form_title)
{
	list($list_1, $list_2) = $this->get_group_list();

	$this->print_top('weblinks_config_link_register_1', $form_title);

	$this->print_auth('auth_dohtml_1',   $list_1);
	$this->print_auth('auth_dosmiley_1', $list_1);
	$this->print_auth('auth_doxcode_1',  $list_1);
	$this->print_auth('auth_doimage_1',  $list_1);
	$this->print_auth('auth_dobr_1',     $list_1);
	$this->print_yesno('type_desc_1');
	$this->print_text('desc_length_1');

	$this->print_form_bottom();
}

function get_group_list()
{
	$member_handler =& xoops_gethandler('member');
	$group_list = $member_handler->getGroupList();

	$list_1 = array();
	foreach ( $group_list as $k => $v )
	{
		$list_1[$v] = $k;
	}

	$list_2 = $list_1;
	$list_2[ _WEBLINKS_AUTH_UID ]    = WEBLINKS_ID_AUTH_UID;
	$list_2[ _WEBLINKS_AUTH_PASSWD ] = WEBLINKS_ID_AUTH_PASSWD;

	return array($list_1, $list_2);
}

function print_top($form_name, $form_title)
{
	echo $this->build_form_begin($form_name);
	echo $this->build_token();
	echo $this->build_html_input_hidden('op', 'save');

	echo "<table class='outer' width='100%' ><tr>";
	echo "<th align='left' colspan='2'>".$form_title."</th>";
	echo "</tr>\n";
}

function print_auth($name, $opt)
{
	$cap  = $this->build_conf_caption_by_name($name);

	$id    = $this->get_by_name($name, 'conf_id');
	$value = $this->get_by_name($name, 'value');
	$size  = count($opt);

	$show   = $this->build_html_select_multiple($name, $value, $opt, $size);
	$show  .= $this->build_conf_hidden($id);

	echo "<tr>";
	echo "<td class='head'>$cap</td>";
	echo "<td class='odd'>$show</td>";
	echo "</tr>\n";
}

function print_yesno($name)
{
	$cap  = $this->build_conf_caption_by_name($name);
	$show = $this->build_conf_radio_yesno_by_name($name);

	echo "<tr>";
	echo "<td class='head'>$cap</td>";
	echo "<td class='odd'>$show</td>";
	echo "</tr>\n";
}

function print_text($name)
{
	$cap  = $this->build_conf_caption_by_name($name);
	$show = $this->build_conf_textbox_by_name($name);

	echo "<tr>";
	echo "<td class='head'>$cap</td>";
	echo "<td class='odd'>$show</td>";
	echo "</tr>\n";
}

//---------------------------------------------------------
// show_form_linkitem
//---------------------------------------------------------
function show_form_linkitem( $title )
{
	$this->_linkitem_form->show( $title );
}

//---------------------------------------------------------
// show_country_code
//---------------------------------------------------------
function show_form_country_code( $title )
{
	$dirname =  'modules/happy_linux/locate/';
	$dir_arr =& $this->_dir->get_dirs_in_dir( $dirname, false, true );

	$opts = array();
	foreach ( $dir_arr as $dir )
	{
		if ( file_exists( XOOPS_ROOT_PATH.'/'.$dirname.'/'.$dir.'/local.php' ) )
		{
			$opts[ $dir ] = $dir;
		}
	}

	$cap1  = $this->build_conf_caption_by_name('country_code');
	$show1 = $this->build_conf_select_by_name( 'country_code', $opts );
	$cap2  = $this->build_form_caption('', _AM_WEBLINKS_CONF_RENEW_COUNTRY_CODE_DESC);

	echo '<table class="outer" width="100%" ><tr>';
	echo '<th align="left" colspan="2">'.$title."</th>";
	echo "</tr>\n";
	echo '<tr><td class="head">'.$cap1."</td>\n";
	echo '<td class="odd">';
	echo $this->build_form_begin('country_code');
	echo $this->build_token();
	echo $this->build_html_input_hidden('op', 'save');
	echo $show1;
	echo "<br /><br />\n";
	echo $this->build_html_input_submit( 'submit', _WEBLINKS_UPDATE );
	echo $this->build_form_end();
	echo "</td></tr>\n";
	echo '<tr><td class="head">'.$cap2."</td>\n";
	echo '<td class="odd">';
	echo $this->build_form_begin('renew');
	echo $this->build_token();
	echo $this->build_html_input_hidden('op', 'renew');
	echo $this->build_html_input_submit('submit', _AM_WEBLINKS_RENEW );
	echo $this->build_form_end();
	echo "</td></tr></table>\n";
	echo "<br />\n";
}

//---------------------------------------------------------
// show form rss cache clear
//---------------------------------------------------------
function show_form_rss_cache_clear( $title )
{
	echo $this->build_lib_box_button_style( $title, _HAPPY_LINUX_CONF_RSS_CACHE_CLEAR_DESC, 'rss_cache_clear', _HAPPY_LINUX_CLEAR );
	echo "<br />\n";
}

function show_form_template_compiled_clear( $title )
{
	echo $this->build_lib_box_button_style( $title, _AM_WEBLINKS_CONF_TEMPLATE_DESC, 'template_compiled_clear', _HAPPY_LINUX_CLEAR );
	echo "<br />\n";
}

//---------------------------------------------------------
// print html
//---------------------------------------------------------
function print_form_bottom()
{
	echo "<tr class='foot' ><td></td><td colspan='3'>";
	echo $this->build_html_input_submit( 'submit', _WEBLINKS_UPDATE );
	echo "</td></tr></table>\n";
	echo $this->build_form_end();
	echo "<br />\n";
}

//---------------------------------------------------------
// print html
// not use in weblinks
//---------------------------------------------------------
function print_top2($form_name, $name1, $name2)
{
	echo $this->build_form_begin($form_name);
	echo $this->build_token();
	echo $this->build_html_input_hidden('op', 'save');

	echo "<table class='outer' width='100%' ><tr>";
	echo "<th align='center'>"._AM_RSSC_CONF_NAME."</th>";
	echo "<th align='center'>".$name1."</th>";
	echo "<th align='center'>".$name2."</th>";
	echo "</tr>\n";
}

function print_top3($form_name, $name1, $name2, $name3)
{
	echo $this->build_form_begin($form_name);
	echo $this->build_token();
	echo $this->build_html_input_hidden('op', 'save');

	echo "<table class='outer' width='100%' ><tr>";
	echo "<th align='center'>"._AM_RSSC_CONF_NAME."</th>";
	echo "<th align='center'>".$name1."</th>";
	echo "<th align='center'>".$name2."</th>";
	echo "<th align='center'>".$name3."</th>";
	echo "</tr>\n";
}

function print_form_even_odd()
{
	if ($this->_line_count % 2 == 0) 
	{
		$class = 'even';
	}
	else 
	{
		$class = 'odd';
	}

	$this->_line_count ++;

	echo "<tr class='$class'>";
}

function print_two($name1, $name2='')
{
	if ( $name1 )
	{
		$title_show = $this->build_conf_caption_by_name($name1);
	}
	else
	{
		$title_show = $this->build_conf_caption_by_name($name2);
	}

	$name1_show = $this->build_conf_textbox_by_name($name1);
	$name2_show = $this->build_conf_textbox_by_name($name2);

	$this->print_form_even_odd();
	echo "<td>$title_show</td>";
	echo "<td align='right'>$name1_show</td>";
	echo "<td align='right'>$name2_show</td></tr>\n";

}

function print_three($name1, $name2='', $name3='')
{
	if ( $name1 )
	{
		$title_show = $this->build_conf_caption_by_name($name1);
	}
	elseif ( $name2 )
	{
		$title_show = $this->build_conf_caption_by_name($name2);
	}
	else
	{
		$title_show = $this->build_conf_caption_by_name($name3);
	}

	$name1_show = $this->build_conf_textbox_by_name($name1);
	$name2_show = $this->build_conf_textbox_by_name($name2);
	$name3_show = $this->build_conf_textbox_by_name($name3);

	$this->print_form_even_odd();
	echo "<td>$title_show</td>";
	echo "<td align='right'>$name1_show</td>";
	echo "<td align='right'>$name2_show</td>";
	echo "<td align='right'>$name3_show</td></tr>\n";

}

function print_sel2($name1, $name2='')
{
	$title_show = $this->build_conf_caption_by_name($name1);
	$name1_show = $this->build_conf_radio_select_by_name($name1);
	$name2_show = $this->build_conf_radio_select_by_name($name2);

	$this->print_form_even_odd();
	echo "<td>$title_show</td>";
	echo "<td align='left'>$name1_show</td>";
	echo "<td align='left'>$name2_show</td></tr>\n";

}

function print_sel3($name1, $name2='', $name3='')
{
	$title_show = $this->build_conf_caption_by_name($name1);
	$name1_show = $this->build_conf_radio_select_by_name($name1);
	$name2_show = $this->build_conf_radio_select_by_name($name2);
	$name3_show = $this->build_conf_radio_select_by_name($name3);

	$this->print_form_even_odd();
	echo "<td>$title_show</td>";
	echo "<td align='left'>$name1_show</td>";
	echo "<td align='left'>$name2_show</td>";
	echo "<td align='left'>$name3_show</td></tr>\n";

}

function print_form_conf_checkbox($name)
{
	$this->print_form_even_odd();

	$name_show = $this->build_conf_yseno_checkbox_by_name($name);
	$this->print_conf_line($name, $name_show);
}

function print_form_conf_radio($name)
{
	$this->print_form_even_odd();

	$title_show = $this->build_conf_caption_by_name($name);
	$name_show  = $this->build_conf_radio_select_by_name($name);

	echo "<td></td><td>$title_show</td><td></td><td></td>";
	echo "<td align='left' colspan='2'>$name_show</td>";
	echo "<td></td></tr>\n";
}

function print_conf_line($name, $name1_show, $name2_show='')
{
	$title_show = $this->build_conf_caption_by_name($name);

	echo "<td></td><td>$title_show</td><td></td><td></td>";
	echo "<td align='right'>$name1_show</td><td></td>";
	echo "<td align='right'>$name2_show</td></tr>\n";
}

function print_msg($title)
{
	echo "<h4>$title</h4>\n";
}

function print_error($title, $msg)
{
	echo "<h3><font color='red'>$title</font></h3>\n";
	echo "$msg<br /><br />\n";
}

//---------------------------------------------------------
// module installed
//---------------------------------------------------------
function print_rssc_module_installed()
{
	if( WEBLINKS_RSSC_EXIST )
	{
// check rssc version
		if ( RSSC_VERSION < WEBLINKS_RSSC_VERSION )
		{
			$msg = sprintf( _WEBLINKS_RSSC_REQUIRE, WEBLINKS_RSSC_VERSION );
			xoops_error( $msg );
		}
		else
		{
			$msg = sprintf( _WEBLINKS_RSSC_INSTALLED, WEBLINKS_RSSC_DIRNAME, RSSC_VERSION );
			echo '<h4 style="color: #0000ff;">'.$msg."</h4>\n";
		}
	}
	elseif( WEBLINKS_RSSC_DIRNAME != '-' )
	{
		$msg = sprintf( _WEBLINKS_RSSC_NOT_INSTALLED, WEBLINKS_RSSC_DIRNAME );
		xoops_error( $msg );
	}
}

function print_d3forum_module_installed()
{
	$dirname = $this->_config_define_handler->get_by_name('d3forum_dirname', 'value');
	$this->print_module_installed( $dirname, 'd3forum' );
}

function print_module_installed_by_conf( $kind, $conf_name )
{
	$dirname = $this->_config_define_handler->get_by_name( $conf_name, 'value' );
	$this->print_module_installed( $dirname, $kind );
}

function print_module_installed( $dirname, $kind )
{
	if ( $dirname && ( $dirname != '-' ) )
	{
		$module = $this->_system->get_module_by_dirname( $dirname );
		if ( is_object($module) )
		{
			$version = sprintf( "%6.2f", ($module->getVar('version')/100) );
			$msg = sprintf( _AM_WEBLINKS_MODULE_INSTALLED, $kind, $dirname, $version );
			echo '<h4 style="color: #0000ff;">'.$msg."</h4>\n";
		}
		else
		{
			$msg = sprintf( _AM_WEBLINKS_MODULE_NOT_INSTALLED, $kind, $dirname );
			xoops_error( $msg );
		}
	}
}

// --- class end ---
}

?>