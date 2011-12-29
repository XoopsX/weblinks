<?php
// $Id: weblinks_config2_form.php,v 1.1 2011/12/29 14:33:09 ohwada Exp $

// 2007-10-10 K.OHWADA
// extra_link_img_thumb

// 2007-09-10 K.OHWADA
// extra_rssc_dirname_list

//================================================================
// WebLinks Module
// 2007-06-10 K.OHWADA
//================================================================

// === class begin ===
if( !class_exists('weblinks_config2_form') ) 
{

//=========================================================
// class weblinks_config2_form
//=========================================================
class weblinks_config2_form extends happy_linux_config_form
{
	var $_DIRNAME;

// class
	var $_plugin;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_config2_form( $dirname )
{
	$this->_DIRNAME = $dirname;

	$this->happy_linux_config_form();

	$define =& weblinks_config2_define::getInstance(  $dirname );
	$this->set_config_handler('config2',  $dirname, 'weblinks');
	$this->set_config_define( $define );

	$this->_plugin =& weblinks_plugin::getInstance( $dirname );
}

function &getInstance( $dirname )
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new weblinks_config2_form( $dirname );
	}
	return $instance;
}

//---------------------------------------------------------
// build config
//---------------------------------------------------------
function build_conf_extra_func( $config )
{
	$formtype  = $config['formtype'];
	$valuetype = $config['valuetype'];
	$name      = $config['name'];
	$value     = $config['value'];
	$options   = $config['options'];
	$value_s   = $this->sanitize_text( $value );

	switch ( $formtype ) 
	{
		case 'extra_dirname_list':
			$ele = $this->_build_conf_extra_dirname_list( $config );
			break;

		case 'extra_rssc_dirname_list':
			$ele = $this->_build_conf_extra_rssc_dirname_list( $config );
			break;

		case 'extra_forum_plugin':
			$ele = $this->_build_conf_extra_forum_plugin( $config );
			break;

		case 'extra_album_plugin':
			$ele = $this->_build_conf_extra_album_plugin( $config );
			break;

		case 'extra_d3forum_plugin':
			$ele = $this->_build_conf_extra_d3forum_plugin( $config );
			break;

		case 'extra_d3forum_forum_id':
			$ele = $this->_build_conf_extra_d3forum_forum_id( $config );
			break;

		case 'extra_link_img_thumb':
			$ele = $this->_build_conf_extra_link_img_thumb( $config );
			break;

		default:
			$ele = $this->build_html_input_text( $name, $value_s );
			break;
	}

	return $ele;
}

function _build_conf_extra_dirname_list( $config )
{
	$name  =  $config['name'];
	$value =  $config['value'];

//	$options   =& $this->_get_conf_options_dirname_list( $value );

	$param = array(
		'dirname_except'  => $this->_DIRNAME,
		'none_flag'       => true,
		'dirname_default' => $value,
	);

	$modules =& $this->_system->get_module_list( $param );
	$options =& $this->_system->get_dirname_list( $modules, $param );

	return $this->build_html_select( $name, $value, $options );
}

function _build_conf_extra_rssc_dirname_list( $config )
{
	$name  =  $config['name'];
	$value =  $config['value'];

	$param = array(
		'dirname_except'  => $this->_DIRNAME,
		'file'            => 'include/rssc_version.php',
		'none_flag'       => true,
		'dirname_default' => $value,
	);

	$modules =& $this->_system->get_module_list( $param );
	$options =& $this->_system->get_dirname_list( $modules, $param );

	return $this->build_html_select( $name, $value, $options );
}

function &xxxxx_get_conf_options_dirname_list( $dirname )
{
	$criteria = new CriteriaCompo();
	$criteria->add( new Criteria('isactive', '1', '=') );
	$module_handler =& xoops_gethandler('module');
	$objs           =& $module_handler->getObjects( $criteria );

	$arr1 = array(
		'0' => '---',
	);

	foreach ( $objs as $obj )
	{
		$arr1[ $obj->getVar('dirname') ] = $obj->getVar('dirname') .': '. $obj->getVar('name');
	}

	if ( !empty($dirname) && !isset($arr1[ $dirname ]) )
	{
		$arr1[ $dirname ] = $dirname .': '. $dirname .' module';
	}

	asort( $arr1 );
	reset( $arr1 );
	$arr2 = array_flip( $arr1 );

	return $arr2;
}

function _build_conf_extra_forum_plugin( $config )
{
	$name     =  $config['name'];
	$value    =  $config['value'];
	$options  =& $this->_plugin->get_config_options('forum');

	return $this->build_html_select( $name, $value, $options );
}

function _build_conf_extra_album_plugin( $config )
{
	$name     =  $config['name'];
	$value    =  $config['value'];
	$options  =& $this->_plugin->get_config_options('album');

	return $this->build_html_select( $name, $value, $options );
}

function _build_conf_extra_d3forum_plugin( $config )
{
	$name      =  $config['name'];
	$value     =  $config['value'];
	$options   =& $this->_plugin->get_config_options('d3forum');

	return $this->build_html_select( $name, $value, $options );
}

function _build_conf_extra_d3forum_forum_id( $config )
{
	$name     =  $config['name'];
	$value    =  $config['value'];
	$options  =& $this->_plugin->get_options_for_d3forum();

	return $this->build_html_select( $name, $value, $options );
}

function _build_conf_extra_link_img_thumb( $config )
{
	$banner_handler =& weblinks_get_handler('banner', $this->_DIRNAME );

	$name      =  $config['name'];
	$value     =  $config['value'];
	$options   =& $banner_handler->get_thumb_options();

	return $this->build_html_input_radio_select( $name, $value, $options, '<br />', false );
}

// --- class end ---
}

// === class end ===
}

?>