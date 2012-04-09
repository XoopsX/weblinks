<?php
// $Id: rssc_add.php,v 1.1 2012/04/09 10:23:37 ohwada Exp $

//=========================================================
// WebLinks Module
// 2012-04-02 K.OHWADA
//=========================================================

//-------------------------------
// TODO
// $_POST['title'] = $title;
//-------------------------------

include 'admin_header.php';

if ( WEBLINKS_RSSC_USE ) {
	include_once WEBLINKS_RSSC_ROOT_PATH.'/api/lang_main.php';
	include_once WEBLINKS_RSSC_ROOT_PATH.'/api/view.php';
	include_once WEBLINKS_RSSC_ROOT_PATH.'/api/refresh.php';
	include_once WEBLINKS_RSSC_ROOT_PATH.'/api/manage.php';

	include_once WEBLINKS_ROOT_PATH.'/class/weblinks_rssc_handler.php';
	include_once WEBLINKS_ROOT_PATH.'/admin/rssc_manage_class.php';
}

//=========================================================
// class rssc_add
//=========================================================
class rssc_add
{
	var $_LIMIT = 50;

	var $_db;
	var $_rss_utility;
	var $_rssc_edit_handler;

	var $_table_link;

	var $_error = null;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function rssc_add( $dirname )
{
	$this->_db =& Database::getInstance();

	$this->_table_link = $this->_db->prefix( $dirname.'_link' );

	$this->_rss_utility =& happy_linux_rss_utility::getInstance();
	$this->_rssc_edit_handler =& weblinks_get_handler( 'rssc_edit', $dirname );
}

function &getInstance($dirname)
{
	static $instance;
	if (!isset($instance)) {
		$instance = new rssc_add($dirname);
	}
	return $instance;
}

//---------------------------------------------------------
// function
//---------------------------------------------------------
function main()
{
	if ( WEBLINKS_RSSC_USE ) {
		$this->main_execute();

	} else {
		xoops_error( 'require rssc module' );
	}
}

function main_execute()
{
	$op = 'main';
	if ( isset($_POST['op']) ) $op = $_POST['op'];

	echo "<h3>"._AM_WEBLINKS_TITLE_RSSC_ADD."</h3>\n";

	switch ($op) 
	{
		case "link_to_rssc":
			$this->link_to_rssc();
			break;

		case 'main':
		default:
			$this->form_next_link(0);
		break;
	}
}

function link_to_rssc()
{
	echo "<h4>link table</h3>";

	$offset = 0;
	if ( isset($_POST['offset']) )  $offset = $_POST['offset'];
	$next = $offset + $this->_LIMIT;

	$sql1  = "SELECT count(*) FROM ".$this->_table_link;
	$res1  = $this->sql_exec($sql1);
	$row1  = $this->_db->fetchRow($res1);
	$total = $row1[0];

	echo "There are $total links <br />\n";
	echo "Transfer $offset - $next th link <br /><br />";

	$sql2 = "SELECT * FROM ".$this->_table_link." ORDER BY lid";
	$res2 = $this->sql_exec($sql2, $this->_LIMIT, $offset);

	while ($row = $this->_db->fetchArray($res2))
	{
		$lid      = $row['lid'];
		$title    = $row['title'];
		$url      = $row['url'];
		$rssc_lid = $row['rssc_lid'];

		if ( empty($url) ) {
			echo "$lid : skip no url <br />\n";
			continue;
		}

		if ( $rssc_lid ) {
			echo "$lid : skip already rss_lid <br />\n";
			continue;
		}

		$ret = $this->add_rssc( $lid, $title, $url );
		if ( $ret ) {
			echo "$lid : added rssc <br />\n";
		} else {
			echo "$lid : ". $this->_error ."<br />\n";
		}
	}

	if ( $total > $next ) {
		$this->form_next_link($next);
	} else {
		$this->finish();
	}

}

function add_rssc( $lid, $title, $url )
{
	$this->_error = null;

	$ret1 = $this->discovery( $url );
	if ( !$ret1 ) {
		return false;
	}

	// catch in	build_rssc of weblinks_rssc_handler.php
	$_POST['title'] = $title;
	$_POST['url']   = $url;

	$this->_rssc_edit_handler->clear_errors_logs();
	$ret2 = $this->_rssc_edit_handler->add_rssc( $lid );
	switch ( $ret2 ) {
		case 0:
			return true;

		// update_rssc_lid
		case RSSC_CODE_LINK_ALREADY:
			$this->_error = 'link already';
			return false;

		// check_necessary_param
		case RSSC_CODE_DISCOVER_FAILED:
			$this->_error = 'discover failed';
			return false;

		// check_necessary_param
		case WEBLINKS_CODE_RSSC_NOT_FIND_PARAM:
			$this->_error = 'not find param';
			return false;

		// refresh_link
		case RSSC_CODE_PARSE_MSG:
			$this->_error = $this->_rssc_edit_handler->get_parse_result();
			return false;

		// refresh_link
		case RSSC_CODE_PARSE_FAILED:
		case RSSC_CODE_REFRESH_ERROR:
		case WEBLINKS_CODE_DB_ERROR:
		default:
			$error = $this->_rssc_edit_handler->getErrors(1);
			if ( empty($error) ) {
				$error = " error code $ret2 ";
			}
			$this->_error = $error;
			return false;
	}

	return true;
}

function discovery( $url )
{
	$ret = $this->_rss_utility->discover( $url );
	if ( !$ret ) {
		$this->_error = _RSSC_DISCOVER_FAILED;
		return false;
	}

	// catch in	build_rssc of weblinks_rssc_handler.php
	$_POST['rss_flag'] = $this->_rss_utility->get_xml_mode();
	$_POST['rss_url']  = $this->_rss_utility->get_xmlurl_by_mode();
	return true;
}

function sql_exec($sql, $limit=0, $offset=0)
{ 
	$ret = $this->_db->queryF($sql, $limit, $offset);
	if ($ret != false ) { return $ret; }

	$error = $this->_db->error();
	echo "<font color=red>$sql<br />$error</font><br />";

	return false;
}

function form_next_link($next)
{
	$action = xoops_getenv('PHP_SELF');
	$submit = "GO next $this->_LIMIT links";
	$next2  = $next + $this->_LIMIT;

?>
<br />
<hr>
<h4>next link table</h4>
<?php echo $next; ?> - <?php echo $next2; ?> th link<br />
<br />
<form action='<?php echo $action; ?>' method='post'>
<input type='hidden' name='op' value='link_to_rssc'>
<input type='hidden' name='offset' value='<?php echo $next; ?>'>
<input type='submit' value='<?php echo $submit; ?>'>
</form>
<?php

}

function finish()
{
	echo "<br /><hr>\n";
	echo "<h4>FINISHED</h4>\n";
	echo "<a href='index.php'>GOTO Admin Menu</a><br />\n";
}

// --- class end ---
}

//=========================================================
// main
//=========================================================
$rssc =& rssc_add::getInstance( WEBLINKS_DIRNAME );

xoops_cp_header();
$rssc->main();
xoops_cp_footer();
exit();

?>