<?php
// $Id: rssc_add.php,v 1.2 2012/04/10 18:52:29 ohwada Exp $

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
	var $_db;
	var $_system_class;
	var $_html_class;
	var $_rss_utility;
	var $_rssc_edit_handler;

	var $_table_link;

	var $_error = null;

	var $_LIMIT = 50;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function rssc_add( $dirname )
{
	$this->_db =& Database::getInstance();

	$this->_table_link = $this->_db->prefix( $dirname.'_link' );

	$this->_system_class =& happy_linux_system::getInstance();
	$this->_html_class   =& happy_linux_html::getInstance();

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

	$sql   = "SELECT count(*) FROM ".$this->_table_link;
	$total = $this->get_count_by_sql($sql);

	$this->print_title();

	switch ($op) 
	{
		case "link_to_rssc":
			$this->link_to_rssc($total);
			break;

		case 'main':
		default:
			$this->form_next_link($total, 0);
		break;
	}
}

function print_title()
{
	$paths   = array();
	$paths[] = array(
		'name' => $this->_system_class->get_module_name(),
		'url'  => 'index.php',
	);
	$paths[] = array(
		'name' => _AM_WEBLINKS_TITLE_RSSC_MANAGE,
		'url'  => 'rssc_manage.php',
	);
	$paths[] = array(
		'name' => _AM_WEBLINKS_TITLE_LINK_GEOCODING
	);

	echo $this->_html_class->build_html_bread_crumb( $paths );

	echo "<h3>"._AM_WEBLINKS_TITLE_RSSC_ADD."</h3>\n";
	echo _AM_WEBLINKS_TITLE_RSSC_ADD_DSC;
	echo "<br /><br />\n";
}

function link_to_rssc($total)
{
	$offset = 0;
	if ( isset($_POST['offset']) )  $offset = $_POST['offset'];

	$start = $offset + 1;
	$next  = $offset + $this->_LIMIT;

	echo "Excute $start - $next th link <br /><br />";

	$sql  = "SELECT * FROM ".$this->_table_link." ORDER BY lid";
	$rows = $this->get_rows_by_sql( $sql, $this->_LIMIT, $offset );

	foreach ( $rows as $row ) {

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
		$this->form_next_link($total, $next);
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

function form_next_link($total, $next)
{
	$action = xoops_getenv('PHP_SELF');
	$submit = "GO next $this->_LIMIT links";
	$next2  = $next + $this->_LIMIT;

$text = <<<EOF
<br />
<hr>
<h4>excute link table</h4>
There are $total links <br />
$next - $next2 th link<br />
<br />
<form action="$action" method="post">
<input type="hidden" name="op" value="link_to_rssc">
<input type="hidden" name="offset" value="$next">
<input type="submit" value="$submit">
</form>
EOF;

	echo $text;

}

function finish()
{
	echo "<br /><hr>\n";
	echo "<h4>FINISHED</h4>\n";
	echo "<a href='index.php'>GOTO Admin Menu</a><br />\n";
}

//---------------------------------------------------------
// sql
//---------------------------------------------------------
function get_count_by_sql($sql)
{
	$res = $this->_db->query($sql);
	if ( !$res ) {
		if ( $this->_DEBUG ) {
			echo $sql;
			echo $this->_db->error();
		}
		return 0;
	}

	$array = $this->_db->fetchRow( $res );
	$count = intval( $array[0] );

	$this->_db->freeRecordSet($res);
	return $count;
}

function get_rows_by_sql($sql, $limit=0, $offset=0)
{
	$res = $this->_db->query($sql, $limit, $offset);
	if ( !$res ) {	
		if ( $this->_DEBUG ) {
			echo $sql;
			echo $this->_db->error();
		}
		return false;	
	}

	$arr = array();
	while ( $row = $this->_db->fetchArray($res) ) {
		$arr[] = $row;
	}

	$this->_db->freeRecordSet($res);
	return $arr;
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