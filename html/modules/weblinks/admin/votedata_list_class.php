<?php
// $Id: votedata_list_class.php,v 1.1 2011/12/29 14:32:55 ohwada Exp $

// 2007-02-20 K.OHWADA
// small change _get_cols()

// 2006-09-30 K.OHWADA
// this new file

//================================================================
// WebLinks Module
// 2006-09-20 K.OHWADA
//================================================================

//=========================================================
// class admin_votedata_list
//=========================================================
class admin_votedata_list extends happy_linux_page_frame
{
	var $_link_handler;
	var $_post;

	var $_lid = 0;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_votedata_list()
{
	$this->happy_linux_page_frame();
	$this->set_handler('votedata', WEBLINKS_DIRNAME, 'weblinks');
	$this->set_id_name('ratingid');
	$this->set_max_sortid(3);
	$this->set_submit_colspan(0, 2, 8);
	$this->set_flag_form(true);
	$this->set_form_name('votedata');
	$this->set_action('votedata_manage.php');
	$this->set_operation('del_all');
	$this->set_lang_submit_value( _DELETE );

	$this->_link_handler =& weblinks_get_handler( 'link', WEBLINKS_DIRNAME );

	$this->_post =& happy_linux_post::getInstance();
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_votedata_list();
	}
	return $instance;
}

//---------------------------------------------------------
// init
//---------------------------------------------------------
function _init()
{
	$this->_lid = $this->_post->get_post_get_int('lid');
}

//---------------------------------------------------------
// handler
//---------------------------------------------------------
function &_get_table_header()
{
	$arr1 = array(
		$this->build_form_js_checkall(),
		'ratingid',
		_WLS_LINKID,
		_WLS_SITETITLE,
		_WLS_USER,
		_WLS_IP,
		_WLS_RATING,
		_WLS_USERAVG,
		_WLS_TOTALRATE,
		_WLS_DATE,
	);

	$arr2 = array(
		$this->build_form_js_checkall(),
		'ratingid',
		_WLS_USER,
		_WLS_IP,
		_WLS_RATING,
		_WLS_USERAVG,
		_WLS_TOTALRATE,
		_WLS_DATE,
	);

	switch ($this->_sortid)
	{
		case 2:
		case 3:
			if ( $this->_lid )
			{
				$arr = $arr2;
			}
			else
			{
				$arr = $arr1;
			}
			break;

		case 0:
		case 1:
		default:
			$arr = $arr1;
			break;
	}

	return $arr;
}

function _get_total()
{
	$total_all = $this->_get_total_all();

	switch ($this->_sortid)
	{
		case 2:
			$total = $this->_get_total_user();
			break;

		case 3:
			$total = $this->_get_total_anon();
			break;

		case 0:
		case 1:
		default:
			$total = $total_all;
			break;
	}

	return $total;
}

function _get_total_user()
{
	if ( $this->_lid )
	{
		$total = $this->_handler->get_count_user_by_lid($this->_lid);
	}
	else
	{
		$total = $this->_handler->get_count_user();
	}
	return $total;
}

function _get_total_anon()
{
	if ( $this->_lid )
	{
		$total = $this->_handler->get_count_by_lid_uid($this->_lid, 0);
	}
	else
	{
		$total = $this->_handler->get_count_by_uid(0);
	}
	return $total;
}

function &_get_items($limit=0, $start=0)
{

	switch ($this->_sortid)
	{
		case 1:
			$objs =& $this->_handler->get_objects_desc($limit, $start);
			break;

		case 2:
			if ( $this->_lid )
			{
				$objs =& $this->_handler->get_objects_user_by_lid($this->_lid, $limit, $start);
			}
			else
			{
				$objs =& $this->_handler->get_objects_orderby_uid($limit, $start);
			}
			break;

		case 3:
			if ( $this->_lid )
			{
				$objs =& $this->_handler->get_objects_by_lid_uid($this->_lid, 0, $limit, $start);
			}
			else
			{
				$objs =& $this->_handler->get_objects_anoymous($limit, $start);
			}
			break;

		case 0:
		default:
			$objs =& $this->_handler->get_objects_asc($limit, $start);
			break;
	}

	return $objs;
}

function &_get_cols(&$obj)
{
	$ratingid = $obj->get('ratingid');
	$lid      = $obj->get('lid');

	$ratinguser      = $obj->getVar('ratinguser');
	$rating          = $obj->getVar('rating');
	$ratinghostname  = $obj->getVar('ratinghostname');
	$ratingtimestamp = $obj->getVar('ratingtimestamp');
	$formatted_date  = $obj->get_formatted_timestamp();

	$checkbox = $this->build_form_js_checkbox($ratingid);

	$title_s         = '---';
	$ratingusername  = '---';
	$uservotes       = '---';
	$useravgrating   = '---';

	if ($ratinguser)
	{
		$ratingusername  = $obj->get_uname();
		list($uservotes, $useravgrating) = 
			$this->_handler->calc_rating_by_uid($ratinguser);
	}

	$link_obj =& $this->_link_handler->get($lid);
	if ( is_object($link_obj) )
	{
		$title_s = $link_obj->getVar('title', 's');
	}

	$jump_vote = 'votedata_manage.php?op=mod_form&ratingid=';
	$jump_link = 'link_manage.php?op=mod_form&lid=';
	$link_vote = $this->_build_page_id_link_by_obj( $obj, 'ratingid', $jump_vote);
	$link_link = $this->_build_page_id_link_by_obj( $obj, 'lid', $jump_link);

	$arr1 = array(
		$checkbox,
		$link_vote,
		$link_link,
		$title_s,
		$ratingusername,
		$ratinghostname,
		$rating,
		$useravgrating,
		$uservotes,
		$formatted_date,
	);

	$arr2 = array(
		$checkbox,
		$link_vote,
		$ratingusername,
		$ratinghostname,
		$rating,
		$useravgrating,
		$uservotes,
		$formatted_date,
	);

	switch ($this->_sortid)
	{
		case 2:
		case 3:
			if ( $this->_lid )
			{
				$arr = $arr2;
			}
			else
			{
				$arr = $arr1;
			}
			break;

		case 0:
		case 1:
		default:
			$arr = $arr1;
			break;
	}

	return $arr;
}

//---------------------------------------------------------
// print
//---------------------------------------------------------
function _print_top()
{
	$total_all  = $this->_get_total_all();
	$total      = $this->_get_total();
	$total_user = $this->_get_total_user();
	$total_anon = $this->_get_total_anon();

	echo "<h4>"._AM_WEBLINKS_VOTE_LIST."</h4>\n";
	printf(_WLS_THEREARE, $total_all);
	echo "<br /><br />\n";

	$script_asc  = $this->_get_script_asc();
	$script_desc = $this->_get_script_desc();
	$script_user = $this->_get_script_by_sortid(2);
	$script_anon = $this->_get_script_by_sortid(3);

	echo "<ul>\n";
	echo '<li><a href="'.$script_asc. '">'.$this->_LANG_ID_ASC. "</a> (".$total_all.") <br /><br /></li>\n";
	echo '<li><a href="'.$script_desc.'">'.$this->_LANG_ID_DESC."</a> (".$total_all.") <br /><br /></li>\n";
	echo '<li><a href="'.$script_user.'">'._AM_WEBLINKS_VOTE_USER."</a> (".$total_user.") <br /><br /></li>\n";
	echo '<li><a href="'.$script_anon.'">'._AM_WEBLINKS_VOTE_ANON."</a> (".$total_anon.") <br /><br /></li>\n";
	echo "</ul>\n";
	echo "<br />\n";

	switch ($this->_sortid)
	{
		case 1:
			$title = $this->_LANG_ID_DESC;
			break;

		case 2:
			$title = _AM_WEBLINKS_VOTE_USER;
			break;

		case 3:
			$title = _AM_WEBLINKS_VOTE_ANON;
			break;

		case 0:
		default:
			$title = $this->_LANG_ID_ASC;
			break;
	}

	echo "<h4>".$title."</h4>\n";

	if ( $this->_lid )
	{
		$link_obj =& $this->_link_handler->get( $this->_lid );
		if ( is_object($link_obj) )
		{
			$title     =  $link_obj->get('title');
			$jump_link = 'link_manage.php?op=mod_form&lid='.$this->_lid;
			$text = $this->build_html_a_href_name($jump_link, $title);	// class build_html
			echo $text."<br /><br />\n";
		}
	}
}

//---------------------------------------------------------
// script
//---------------------------------------------------------
function _get_script_asc()
{
	return $this->_get_script_by_sortid(0);
}

function _get_script_desc()
{
	return $this->_get_script_by_sortid(1);
}

function _get_script_by_sortid($sortid)
{
	if ($this->_lid)
	{
		$script = $this->_get_script().'&amp;sortid=';
	}
	else
	{
		$script = $this->_get_script().'?sortid=';
	}
	$script .= $sortid;
	return $script;
}

function _get_script()
{
	$script = 'votedata_list.php';
	if ($this->_lid)
	{
		$script .= '?lid='.$this->_lid;
	}
	return $script;
}

// --- class end ---
}


?>