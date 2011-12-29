<?php
// $Id: test_form_admin_class.php,v 1.1 2011/12/29 14:32:56 ohwada Exp $

// 2008-02-17 K.OHWADA
// print_error()

// 2007-10-30 K.OHWADA
// change build_form_rssc()

// 2007-09-01 K.OHWADA
// divid from test_form_class.php

//=========================================================
// WebLinks Module
// 2006-09-20 K.OHWADA
//=========================================================

//=========================================================
// class weblinks_test_form_admin
//=========================================================
class weblinks_test_form_admin extends weblinks_test_form
{
	var $_admin_cat_url;
	var $_admin_link_url;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_test_form_admin()
{
	$this->weblinks_test_form();

	$this->_admin_cat_url   = WEBLINKS_URL.'/admin/category_manage.php';
	$this->_admin_link_url  = WEBLINKS_URL.'/admin/link_manage.php';
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new weblinks_test_form_admin();
	}
	return $instance;
}

//---------------------------------------------------------
// admin add link
//---------------------------------------------------------
function admin_add_link( &$param )
{
	$title = isset($param['title']) ? $param['title'] : null;

	$ret = $this->fetch_form( $this->_admin_link_url );
	if ( !$ret )
	{
		return false;
	}

	$param['op']  = 'add_table';
	$param['lid'] = 0;
	$form =& $this->build_link_form( $param );

	$ret = $this->submit_form( $this->_admin_link_url, $form );
	if ( !$ret )
	{
		return false;
	}

	return true;
}

function admin_add_link_add_banner( )
{
	return $this->_admin_banner();
}

function admin_add_link_update_cat()
{
	return $this->_admin_update_cat();
}

function admin_add_link_add_rssc()
{
	return $this->_admin_rssc();
}

function admin_add_link_refresh()
{
	return $this->_admin_refresh();
}

function _admin_banner( )
{
	$form_values = $this->get_form_values();
	if ( !isset($form_values['lid']) )
	{
		$this->print_error( "Error: cannot get lid " );
		echo $this->get_body() ."<br /><br />\n";
		return false;
	}

	$this->_lid = $form_values['lid'];
	$form =& $this->build_form_banner( $form_values );

	$ret = $this->submit_form( $form['action'], $form );
	if ( !$ret )
	{
		return false;
	}
	return true;

}

function _admin_update_cat()
{
	$form_values = $this->get_form_values();
	if ( !isset($form_values['lid']) )
	{
		$this->print_error( "Error: cannot get lid " );
		echo $this->get_body() ."<br /><br />\n";
		return false;
	}

	$form =& $this->build_form_update_cat( $form_values );

	$ret = $this->submit_form( $form['action'], $form );
	if ( !$ret )
	{
		return false;
	}
	return true;
}

function _admin_rssc()
{
	if ( !$this->is_exist_rssc_module() )
	{
		echo "Skip this test: RSSC module is not installed <br />\n";
		return true;
	}

	$form_values = $this->get_form_values();
	if ( !isset($form_values['link_lid']) )
	{
		$this->print_error( "Error: cannot get lid " );
		echo $this->get_body() ."<br /><br />\n";
		return false;
	}

	$form =& $this->build_form_rssc( $form_values );

	$ret = $this->submit_form( $form['action'], $form );
	if ( !$ret )
	{
		return false;
	}
	return true;
}

function _admin_refresh()
{
	if ( !$this->is_exist_rssc_module() )
	{
		echo "Skip this test: RSSC module is not installed <br />\n";
		return true;
	}

	$form_values = $this->get_form_values();
	if ( !isset($form_values['link_lid']) )
	{
		$this->print_error( "Error: cannot get lid " );
		echo $this->get_body() ."<br /><br />\n";
		return false;
	}

	$form =& $this->build_form_refresh( $form_values );

	$ret = $this->submit_form( $form['action'], $form );
	if ( !$ret )
	{
		return false;
	}
	return true;
}

//---------------------------------------------------------
// admin mod link
//---------------------------------------------------------
function admin_mod_link( $param )
{
	$lid   = isset($param['lid'])   ? $param['lid']   : 0;
	$title = isset($param['title']) ? $param['title'] : null;

	$this->_lid = $lid;

	$link_form_url = $this->_admin_link_url.'?lid='.$lid;

	$ret = $this->fetch_form( $link_form_url );
	if ( !$ret )
	{
		$this->print_error( "Error: admin modify link: fetch form " );
		return false;
	}

	$param['op'] = 'mod_table';

	$form =& $this->build_link_form( $param );

	$ret = $this->submit_form($this->_admin_link_url, $form);
	if ( !$ret )
	{
		$this->print_error( "Error: admin modify link: submit form " );
		return false;
	}

	return true;
}

function admin_mod_link_mod_banner( )
{
	return $this->_admin_banner();
}

function admin_mod_link_update_cat()
{
	return $this->_admin_update_cat();
}

function admin_mod_link_mod_rssc()
{
	return $this->_admin_rssc();
}

function admin_mod_link_refresh()
{
	return $this->_admin_refresh();
}

//---------------------------------------------------------
// admin del link
//---------------------------------------------------------
function admin_del_link( $param )
{
	$lid   = isset($param['lid'])   ? $param['lid']   : 0;

	$this->_lid = $lid;

	$link_form_url = $this->_admin_link_url.'?lid='.$lid;

	$ret = $this->fetch_form( $link_form_url );
	if ( !$ret )
	{
		$this->print_error( "Error: admin delete link: fetch form " );
		return false;
	}

	$param['op'] = 'del_form';

	$form =& $this->build_link_form( $param );

	$ret = $this->submit_form($this->_admin_link_url, $form);
	if ( !$ret )
	{
		$this->print_error( "Error: admin delete link: submit form " );
		return false;
	}

	return true;
}

function admin_del_confirm( )
{
	$form_values = $this->get_form_values();
	if ( !isset($form_values['lid']) )
	{
		$this->print_error( "Error: cannot get lid " );
		echo $this->get_body() ."<br /><br />\n";
		return false;
	}

	$this->_lid = $form_values['lid'];
	$form =& $this->build_form_del_confirm( $form_values );

	$ret = $this->submit_form( $form['action'], $form );
	if ( !$ret )
	{
		return false;
	}
	return true;

}

function admin_del_link_update_cat()
{
	return $this->_admin_update_cat();
}

//---------------------------------------------------------
// build form
//---------------------------------------------------------
function &build_form_banner( $v )
{
	$arr =& $this->assign_link( $v );
	$arr['action']         = 'http://localhost' . $v['action'];
	$arr['XOOPS_G_TICKET'] = $v['XOOPS_G_TICKET'];
	$arr['op']             = $v['op'];
	$arr['op_mode']        = $v['op_mode'];
	return $arr;
}

function &build_form_update_cat( $v )
{
	$arr =& $this->assign_link( $v );
	$arr['action']         = 'http://localhost' . $v['action'];
	$arr['XOOPS_G_TICKET'] = $v['XOOPS_G_TICKET'];
	$arr['op']             = $v['op'];
	$arr['op_mode']        = $v['op_mode'];
	return $arr;
}

function &build_form_rssc( $v )
{
	$rdf_url  = isset($v['rdf_url'])  ? $v['rdf_url']  : '';
	$rss_url  = isset($v['rss_url'])  ? $v['rss_url']  : '';
	$atom_url = isset($v['atom_url']) ? $v['atom_url'] : '';

	$arr = array(
		'action'           => WEBLINKS_URL .'/admin/'. $v['action'],
		'XOOPS_G_TICKET'   => $v['XOOPS_G_TICKET'],
		'op'               => $v['op'],
		'op_mode'          => $v['op_mode'],
		'link_lid'         => $v['link_lid'],
		'rssc_lid'         => $v['rssc_lid'],
		'title'            => $v['title'],
		'url'              => $v['url'],
		'rss_flag'         => $v['rss_flag'],
		'rdf_url'          => $rdf_url,
		'atom_url'         => $atom_url,
		'rss_url'          => $rss_url,
		'show_rss_url'     => $rss_url,
	);
	return $arr;
}

function &build_form_refresh( $v )
{
	$arr = array(
		'action'           => 'http://localhost'. $v['action'],
		'XOOPS_G_TICKET'   => $v['XOOPS_G_TICKET'],
		'op'               => $v['op'],
		'op_mode'          => $v['op_mode'],
		'rssc_lid'         => $v['rssc_lid'],
	);
	return $arr;
}

function &build_form_del_confirm( $v )
{
	$arr =& $this->assign_link( $v );
	$arr['action']         = 'http://localhost' . $v['action'];
	$arr['XOOPS_G_TICKET'] = $v['XOOPS_G_TICKET'];
	$arr['op']             = $v['op'];
	return $arr;
}

//---------------------------------------------------------
// admin add category
//---------------------------------------------------------
function admin_add_cat_add_cat($title, $mode)
{
	$this->update_config_by_name( 'cat_path',  $mode );
	$this->update_config_by_name( 'cat_count', $mode );

// fetch_form
	$ret = $this->fetch_form($this->_admin_cat_url);
	if ( !$ret )
	{
		return false;
	}

// build_form
	$ticket = $this->get_ticket();
	$imgurl = $this->get_randum_category_image();

	$cat_form = array(
    	'XOOPS_G_TICKET' => $ticket,
    	'op'     => 'add_table',
    	'title'  => $title,
    	'lflag'  => 1,
    	'orders' => 0,
    	'pid'    => 0,
    	'imgurl' => $imgurl,
	);

// submit_form
	$ret = $this->submit_form($this->_admin_cat_url, $cat_form);
	if ( !$ret )
	{
		return false;
	}
	
	return true;
}

function admin_add_cat_update_path()
{
// build_form
	$ticket = $this->get_ticket();

	$cat_form = array(
    	'XOOPS_G_TICKET' => $ticket,
    	'op'     => 'update_path',
	);

	$ret = $this->submit_form($this->_admin_cat_url, $cat_form);
	if ( !$ret )
	{
		return false;
	}

	return true;
}

// --- class end ---
}

?>