<?php
// $Id: table_manage_rssc.php,v 1.1 2011/12/29 14:32:54 ohwada Exp $

// 2007-11-24 K.OHWADA
// weblinks_admin_print_footer()

// 2006-09-20 K.OHWADA
// this is new file
// use rssc WEBLINKS_RSSC_EXIST

//================================================================
// WebLinks Module
// 2006-09-20 K.OHWADA
//================================================================

include 'admin_header.php';

if ( WEBLINKS_RSSC_EXIST )
{
	include_once WEBLINKS_RSSC_ROOT_PATH.'/api/lang_main.php';
	include_once WEBLINKS_RSSC_ROOT_PATH.'/api/view.php';
	include_once WEBLINKS_RSSC_ROOT_PATH.'/api/refresh.php';
	include_once WEBLINKS_RSSC_ROOT_PATH.'/api/manage.php';

	include_once WEBLINKS_ROOT_PATH.'/class/weblinks_rssc_handler.php';
	include_once WEBLINKS_ROOT_PATH.'/admin/rssc_manage_class.php';
}

//================================================================
// class admin_table_manage_rssc
//================================================================
class admin_table_manage_rssc extends happy_linux_basic_handler
{
	var $_LIMIT = 100;

	var $_weblinks_link_handler;
	var $_rssc_link_handler;

	var $_post;
	var $_form;

	var $_op;
	var $_limit;
	var $_offset;
	var $_next;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_table_manage_rssc()
{
	$this->happy_linux_basic_handler( WEBLINKS_DIRNAME );

	$this->set_debug_db_sql(   WEBLINKS_DEBUG_TABLE_CHECK_SQL );
	$this->set_debug_db_error( WEBLINKS_DEBUG_ERROR );

	$this->_weblinks_link_handler =& weblinks_get_handler( 'link',  WEBLINKS_DIRNAME );

	$this->_post    =& happy_linux_post::getInstance();
	$this->_form    =& happy_linux_form_lib::getInstance();

	if ( WEBLINKS_RSSC_EXIST )
	{
		$this->_rssc_link_handler     =& rssc_get_handler(     'link',  WEBLINKS_RSSC_DIRNAME );
	}
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_table_manage_rssc();
	}
	return $instance;
}

//---------------------------------------------------------
// function
//---------------------------------------------------------
function get_post_param()
{
	$op     = $this->get_post_op();
	$offset = $this->get_post_offset();
	return $op;
}

function get_post_op()
{
	$this->_op = $this->_post->get_post_get('op');
	return $this->_op;
}

function get_post_limit()
{
	$this->_limit = $this->_post->get_post_get('limit');
	return $this->_limit;
}

function get_post_offset()
{
	$this->_offset = $this->_post->get_post_get('offset');
	$this->_next   = $this->_offset + $this->_LIMIT;
	return $this->_offset;
}

//---------------------------------------------------------
// check
//---------------------------------------------------------
function menu()
{
	$total_link_all = $this->_weblinks_link_handler->getCount();
	$total_link_rss = $this->_weblinks_link_handler->get_count_rss_flag( false );
	$total_rssc_all = $this->_rssc_link_handler->getCount();

	$title = 'RSSC Check';

	echo "check adjustment of Weblinks link table and RSSC link table <br />\n";
	echo "<br />\n";
	echo "There are <b>".$total_link_all."</b> all links in weblinks<br />\n";
	echo "There are <b>".$total_link_rss."</b> rss links in weblinks<br />\n";
	echo "There are <b>".$total_rssc_all."</b> all links in rssc<br />\n";

	$this->_form_link($title);

}

function check_link()
{
	$title = 'RSSC Check';

	$total_link_rss = $this->_weblinks_link_handler->get_count_rss_flag( false );

	$offset = $this->get_post_offset();

	$next = $this->_next;
	if ( $this->_next > $total_link_rss )
	{
		$next = $total_link_rss;
	}

	echo "There are <b>".$total_link_rss."</b> rss links in weblinks<br />\n";
	echo "Transfer ".$offset." - ".$next." record <br /><br />\n";

	$count_not  = 0;
	$count_more = 0;

	$url_weblinsk_link_manage = 'link_manage.php?op=mod_form&amp;lid=';
	$url_rssc_link_manage = XOOPS_URL.'/modules/'.WEBLINKS_RSSC_DIRNAME.'/admin/link_manage.php?op=mod_form&amp;lid=';

	$weblinks_link_objs =& $this->_weblinks_link_handler->get_objects_rss_flag($this->_LIMIT, $offset);
	foreach ($weblinks_link_objs as $weblinks_link_obj)
	{
		$weblinks_lid   = $weblinks_link_obj->get('lid');
		$weblinks_title = $weblinks_link_obj->get('title');
		$rssc_lid_1     = $weblinks_link_obj->get('rssc_lid');

		if ($rssc_lid_1 == 0)
		{
// no action
			continue;
		}

		$url_1    = $url_weblinsk_link_manage.$weblinks_lid;
		$lid_1s   = sprintf("%03d", $weblinks_lid);
		$href_1   = '<a href="'.$url_1.'" target="_blank">'.$lid_1s.'</a>';
		$title_1s = htmlspecialchars($weblinks_title);

		$rssc_link_obj_1 =& $this->_rssc_link_handler->get( $rssc_lid_1 );
		if ( !is_object($rssc_link_obj_1) )
		{
// not exist
			echo $href_1." : ".$title_1s;
			echo " : <b>not exist in rssc</b> <br />\n";
			$count_not ++;
			continue;
		}

		$rdf_url  = $rssc_link_obj_1->get('rdf_url');
		$rss_url  = $rssc_link_obj_1->get('rss_url');
		$atom_url = $rssc_link_obj_1->get('atom_url');

		$list =& $this->_rssc_link_handler->get_list_by_rssurl( $rdf_url, $rss_url, $atom_url, $rssc_lid_1 );
		if ( is_array($list) && count($list) )
		{
			echo $href_1." : ".$title_1s;
			echo " : <b>same links in rssc</b> <br />\n";
			$count_more ++;

			foreach ($list as $rssc_lid_2)
			{
				$rssc_link_obj_2 =& $this->_rssc_link_handler->get( $rssc_lid_2 );
				if ( is_object($rssc_link_obj_2) )
				{
					$rssc_title_2 = $rssc_link_obj_2->get('title');
					$url_2    = $url_rssc_link_manage.$rssc_lid_2;
					$lid_2s   = sprintf("%03d", $rssc_lid_2);
					$href_2   = '<a href="'.$url_2.'" target="_blank">'.$lid_2s.'</a>';
					$title_2s = htmlspecialchars($rssc_title_2);
					echo " --- ".$href_2." : ".$title_2s."<br />\n";
				}
			}
		}
	}

	echo "<br />\n";
	echo "There are <b>".$count_not."</b> links which not exist in rssc <br />\n";
	echo "There are <b>".$count_more."</b> links which have same links in rssc <br />\n";

	if ( $total_link_rss > $next )
	{
		$this->_form_link($title, $next);
	}
	else
	{
		$this->_print_finish();
	}

}

//---------------------------------------------------------
// print
//---------------------------------------------------------
function _form_link($title, $offset=0)
{
	$op = 'check_link';

	if ($offset)
	{
		$submit = "GO next $this->_LIMIT links";
	}
	else
	{
		$submit = 'GO STEP 4';
	}

	$this->_print_form_next($title, $op, $submit, $offset);

}

function _print_finish()
{
	echo "<br /><hr />\n";
	echo "<h4>FINISHED</h4>\n";
	echo "<a href='index.php'>GOTO Admin Menu</a><br />\n";
}

//---------------------------------------------------------
// form
//---------------------------------------------------------
function _print_form_next($title, $op, $submit, $offset=0)
{
	echo "<br /><hr />\n";
	echo "<h4>".$title."</h4>\n";

	if ($offset)
	{
		$next = $offset + $this->_LIMIT;
		echo "Exmport ".$offset." - ".$next." th record<br />\n";
	}

// show form
	$limit = 0;
	$desc  = '';
	$action = '';
	$text = $this->_form->build_lib_box_limit_offset($title, $desc, $limit, $offset, $op, $submit, $action);
	echo $text;
}

function check_token()
{
	$ret = $this->_form->check_token();
	return $ret;
}

// --- class end ---
}


//================================================================
// main
//================================================================

xoops_cp_header();

$title = 'RSSC Check';
weblinks_admin_print_bread( _AM_WEBLINKS_TABLE_MANAGE, 'table_manage.php', $title );
echo "<h3>". $title ."</h3>\n";

if( ! WEBLINKS_RSSC_USE )
{
	echo '<h4 style="color: #ff0000;"> not set rss_use </h4>';
	xoops_cp_footer();
	exit();
}

if( WEBLINKS_RSSC_EXIST )
{
// check rssc version
	if ( RSSC_VERSION < WEBLINKS_RSSC_VERSION )
	{
		$msg = sprintf( _WEBLINKS_RSSC_REQUIRE, WEBLINKS_RSSC_VERSION );
		xoops_error( $msg );
		xoops_cp_footer();
		exit();
	}
	else
	{
		$msg = sprintf( _WEBLINKS_RSSC_INSTALLED, WEBLINKS_RSSC_DIRNAME, RSSC_VERSION );
		echo '<h4 style="color: #0000ff;">'.$msg."</h4>\n";
	}
}
else
{
	$msg = sprintf( _WEBLINKS_RSSC_NOT_INSTALLED, WEBLINKS_RSSC_DIRNAME );
	xoops_error( $msg );
	xoops_cp_footer();
	exit();
}

$manage =& admin_table_manage_rssc::getInstance();
$op = $manage->get_post_param();

switch ($op) 
{
case 'check_link':
	$manage->check_link();
	break;

case 'menu':
default:
	$manage->menu();
	break;

}

weblinks_admin_print_footer();
xoops_cp_footer();
exit();
// --- main end ---


?>