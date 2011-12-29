<?php
// $Id: table_manage_zombie_class.php,v 1.1 2011/12/29 14:32:52 ohwada Exp $

// 2007-11-24 K.OHWADA
// divid from table_manage.php

// 2007-11-01 K.OHWADA
// weblinks_admin_print_footer()

// 2007-10-10 K.OHWADA
// xoops block table

// 2007-02-20 K.OHWADA
// hack for multi site
// show_clean_xml()

// 2006-09-20 K.OHWADA
// use happy_linux

// 2006-05-15 K.OHWADA
// use weblinks_db_basic_base

// 2005-10-14 K.OHWADA
// corresponding to too many links

//================================================================
// WebLinks Module
// check table validation
// 2005-01-20 K.OHWADA
//================================================================

//================================================================
// class admin_table_manage_zombie
//================================================================
class admin_table_manage_zombie extends happy_linux_basic_handler
{
	var $FLAG_DEBUG_LINK = 0;

	var $table_link;
	var $table_cat;
	var $table_catlink;

	var $_post;
	var $_system;
	var $_form;

	var $_op;
	var $_limit;
	var $_offset;
	var $_next;

	var $_THIS_TITLE = 'Zombie Check';
	var $_THIS_URL   = 'table_manage_zombie.php';

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_table_manage_zombie()
{
	$this->happy_linux_basic_handler( WEBLINKS_DIRNAME );
	$this->set_debug_db_sql(   WEBLINKS_DEBUG_TABLE_CHECK_SQL );
	$this->set_debug_db_error( WEBLINKS_DEBUG_ERROR );

// hack for multi site
	if ( WEBLINKS_FLAG_MULTI_SITE )
	{
		$this->renew_prefix( WEBLINKS_DB_PREFIX );
	}

// table name
	$this->table_link    = $this->prefix( 'link' );
	$this->table_cat     = $this->prefix( 'category' );
	$this->table_catlink = $this->prefix( 'catlink' );

	$this->_post          =& happy_linux_post::getInstance();
	$this->_system        =& happy_linux_system::getInstance();
	$this->_form          =& admin_table_manage_zombie_form::getInstance();

}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_table_manage_zombie();
	}
	return $instance;
}

//---------------------------------------------------------
// function
//---------------------------------------------------------
function get_post_param()
{
	$op     = $this->get_post_op();
	$limit  = $this->get_post_limit();
	$offset = $this->get_post_offset();
	$this->_next = $limit + $offset;
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
	return $this->_offset;
}

//---------------------------------------------------------
// menu
//---------------------------------------------------------
function menu()
{
	weblinks_admin_print_header();
	weblinks_admin_print_menu();

	echo "<h3>"._AM_WEBLINKS_TABLE_MANAGE."</h3>\n";

	$this->print_menu_zombie( $this->_THIS_URL );
}

function print_menu_zombie( $action )
{
	$submit = 'Goto Zombie Check';

	echo "<h4>". $this->_THIS_TITLE ."</h4>\n";
	echo "check adjustment of link table, category table and catlink table <br />\n";
	echo "<br />\n";

	$total_link      = $this->get_num_from_link();
	$total_cat       = $this->get_num_from_cat();
	$total_catlink   = $this->get_num_from_catlink();
	$num_link_from_catlink = $this->get_num_link_from_catlink();
	$num_cat_from_catlink  = $this->get_num_cat_from_catlink();

?>
<table>
<tr><td>lid of link table    </td><td><?php echo $total_link; ?></td></tr>
<tr><td>lid of catlink table </td><td><?php echo $num_link_from_catlink; ?></td></tr>
<tr><td>cid of category table</td><td><?php echo $total_cat; ?></td></tr>
<tr><td>cid of catlink table </td><td><?php echo $num_cat_from_catlink; ?></td></tr>
<tr><td>records of catlink table </td><td><?php echo $total_catlink; ?></td></tr>
</table>
<br />
<?php

	if ($total_link != $num_link_from_catlink)
	{
		echo "<font color='red'>unmatch number of lids</font><br />\n";
	}

	if ($total_cat < $num_cat_from_catlink)
	{
		echo "<font color='red'>unmatch number of cids</font><br />\n";
	}
	elseif ($total_cat != $num_cat_from_catlink)
	{
		echo "unmatch number of cids, may be OK<br />\n";
	}

	$this->_form->show_zombie_start( $this->_THIS_TITLE, $action );
}

//---------------------------------------------------------
// check
//---------------------------------------------------------
function check_all()
{
	$total_link      = $this->get_num_from_link();
	$total_cat       = $this->get_num_from_cat();
	$total_catlink   = $this->get_num_from_catlink();

	$title = 'check all';
	$this->print_bread( $title );
	echo "<h4>".$title."</h4>\n";

?>
<table>
<tr><td>total link     </td><td><?php echo $total_link; ?></td></tr>
<tr><td>total category </td><td><?php echo $total_cat; ?></td></tr>
<tr><td>total catlink  </td><td><?php echo $total_catlink; ?></td></tr>
</table>
<br />
<?php

	$lid_from_link    = $this->get_lid_from_link();
	$cid_from_cat     = $this->get_cid_from_cat();
	$lid_from_catlink = $this->get_lid_from_catlink();
	$cid_from_catlink = $this->get_cid_from_catlink();

// check zombie link
	$lid_res_arr = $this->check_in_array($lid_from_link, $lid_from_catlink);
	if ( count($lid_res_arr) )
	{
		$this->print_form_del_link_from_catlink($lid_res_arr);
		return;
	}

	echo "OK check lid of link in catlink table<br />\n";

// check zombie category
	$cid_res_arr = $this->check_in_array($cid_from_cat, $cid_from_catlink);
	if ( count($cid_res_arr) )
	{
		$this->print_form_del_cat_from_catlink($cid_res_arr);
		return;
	}

	echo "OK check cid of categoty in catlink table<br />\n";

// check link without category
	$lid_res_arr = $this->check_in_array($lid_from_catlink, $lid_from_link);
	if ( count($lid_res_arr) )
	{
		$this->print_form_del_link($lid_res_arr);
		return;
	}

	echo "OK check lid of catlink in link table<br />\n";

// check link without category
	$cid_res_arr = $this->check_in_array($cid_from_catlink, $cid_from_cat);
	if ( count($cid_res_arr) )
	{
		$this->print_cat_list($cid_res_arr);
		return;
	}

	echo "OK check lid of catlink in link table<br />\n";

	$this->_print_finish();
}

function check_link_in_catlink()
{
	$total_link       = $this->get_num_from_link();
	$total_catlink    = $this->get_num_link_from_catlink();
	$lid_from_link    = $this->get_lid_from_link();
	$lid_from_catlink = $this->get_lid_from_catlink($this->_limit, $this->_offset);

	$title = 'check catlink table';
	$this->print_bread( $title );
	echo "<h4>".$title."</h4>\n";

	echo "check lid of link in catlink table <br />\n";
	echo "total link: $total_link <br />\n";
	echo "$this->_offset -> $this->_next in catlink $total_catlink <br />\n";

// check zombie link
	$lid_res_arr = $this->check_in_array($lid_from_link, $lid_from_catlink);
	if ( count($lid_res_arr) )
	{
		$this->print_form_del_link_from_catlink($lid_res_arr);
		return;
	}

// next
	if (($this->_limit > 0) && ($this->_next < $total_catlink))
	{
		$this->_print_form_next();
	}
	else
	{
		$this->_print_check_next('check_cat_in_catlink');
	}
}

function check_cat_in_catlink()
{
	$total_cat        = $this->get_num_from_cat();
	$total_catlink    = $this->get_num_cat_from_catlink();
	$cid_from_cat     = $this->get_cid_from_cat();
	$cid_from_catlink = $this->get_cid_from_catlink($this->_limit, $this->_offset);

	$title = 'check catlink table';
	$this->print_bread( $title );
	echo "<h4>".$title."</h4>\n";

	echo "check cid of categoty in catlink table <br />\n";
	echo "total category: $total_cat <br />\n";
	echo "$this->_offset -> $this->_next in catlink $total_catlink<br />\n";

// check zombie category
	$cid_res_arr = $this->check_in_array($cid_from_cat, $cid_from_catlink);
	if ( count($cid_res_arr) )
	{
		$this->print_form_del_cat_from_catlink($cid_res_arr);
		return;
	}

// next
	$this->_next = $this->_offset + $this->_limit;
	if (($this->_limit > 0) && ($this->_next < $total_catlink))
	{
		$this->_print_form_next();
	}
	else
	{
		$this->_print_check_next('check_catlink_in_link');
	}
}


function check_catlink_in_link()
{
	$total_link       = $this->get_num_from_link();
	$total_catlink    = $this->get_num_link_from_catlink();
	$lid_from_link    = $this->get_lid_from_link($this->_limit, $this->_offset);
	$lid_from_catlink = $this->get_lid_from_catlink();

	$title = 'check link table';
	$this->print_bread( $title );
	echo "<h4>".$title."</h4>\n";

	echo "check lid of catlink in link table <br />\n";
	echo "total catlink: $total_catlink <br />\n";
	echo "$this->_offset -> $this->_next in link $total_link <br />\n";

// check link without category
	$lid_res_arr = $this->check_in_array($lid_from_catlink, $lid_from_link);
	if ( count($lid_res_arr) )
	{
		$this->print_form_del_link($lid_res_arr);
		return;
	}

// next
	if (($this->_limit > 0) && ($this->_next < $total_link))
	{
		$this->_print_form_next();
	}
	else
	{
		$this->_print_check_next('check_catlink_in_cat');
	}
}

function check_catlink_in_cat()
{
	$total_cat        = $this->get_num_from_cat();
	$total_catlink    = $this->get_num_cat_from_catlink();
	$cid_from_cat     = $this->get_cid_from_cat($this->_limit, $this->_offset);
	$cid_from_catlink = $this->get_cid_from_catlink();

	$title = 'check category table';
	$this->print_bread( $title );
	echo "<h4>".$title."</h4>\n";

	echo "check cid of catlink in category table <br />\n";
	echo "total catlink: $total_catlink <br />\n";
	echo "$this->_offset -> $this->_next in category $total_cat <br />\n";

// check link without category
	$cid_res_arr = $this->check_in_array($cid_from_catlink, $cid_from_cat);
	if ( count($cid_res_arr) )
	{
		$this->print_cat_list($cid_res_arr);
		return;
	}

// next
	if (($this->_limit > 0) && ($this->_next < $total_cat))
	{
		$this->_print_form_next();
	}
	else
	{
		$this->_print_finish();
	}

}

// check id of arr_2 in arr_1
function check_in_array($arr_1, $arr_2)
{
	$arr_3 = array();

	foreach ($arr_2 as $id)
	{
		if ( !in_array($id, $arr_1) )
		{
			$arr_3[] = $id;
		}
	}

	return $arr_3;
}

//---------------------------------------------------------
// delete data from table
//---------------------------------------------------------
function del_link_from_link()
{
	$title = "delete link from link table";
	$this->print_bread( $title );
	echo "<h4>". $title ."</h4>\n";

	$lid_arr = array();
	if ( isset($_POST['lid']) )  $lid_arr = $_POST['lid'];

	foreach ($lid_arr as $lid)
	{
		echo "lid: $lid <br />\n";
		$this->del_link_by_lid($lid);
	}

	$this->_print_check_again_del('check_catlink_in_link');

}

function del_link_from_catlink()
{
	$title = "delete link from catlink table";
	$this->print_bread( $title );
	echo "<h4>". $title ."</h4>\n";

	$lid_arr = array();
	if ( isset($_POST['lid']) )  $lid_arr = $_POST['lid'];

	foreach ($lid_arr as $lid)
	{
		echo "lid: $lid <br />\n";
		$this->del_catlink_by_lid($lid);
	}

	$this->_print_check_again_del('check_link_in_catlink');

}

function del_cat_from_catlink()
{
	$title = "delete category from catlink table";
	$this->print_bread( $title );
	echo "<h4>". $title ."</h4>\n";

	$cid_arr = array();
	if ( isset($_POST['cid']) )  $cid_arr = $_POST['cid'];

	foreach ($cid_arr as $cid)
	{
		echo "cid: $cid <br />\n";
		$this->del_catlink_by_cid($cid);
	}

	$this->_print_check_again_del('check_cat_in_catlink');

}

//---------------------------------------------------------
// SQL function
//---------------------------------------------------------
function get_num_from_link()
{
	$sql = "SELECT count(*) FROM ".$this->table_link;
	$count = $this->get_count_by_sql($sql);
	return $count;
}

function get_num_from_cat()
{
	$sql = "SELECT count(*) FROM ".$this->table_cat;
	return $this->get_count_by_sql($sql);
}

function get_num_from_catlink()
{
	$sql = "SELECT count(*) FROM ".$this->table_catlink;
	$count = $this->get_count_by_sql($sql);
	return $count;
}

function get_num_link_from_catlink()
{
	$num = 0;
	$sql = "SELECT DISTINCT lid FROM ".$this->table_catlink." ORDER BY lid";
	$arr = $this->get_first_row_by_sql($sql);
	if ( is_array($arr) )
	{
		$num = count($arr);
	}
	return $num;
}

function get_num_cat_from_catlink()
{
	$num = 0;
	$sql = "SELECT DISTINCT cid FROM ".$this->table_catlink." ORDER BY cid";
	$arr = $this->get_first_row_by_sql($sql);
	if ( is_array($arr) )
	{
		$num = count($arr);
	}
	return $num;
}

function get_lid_from_link($limit=0, $offset=0)
{
	$sql = "SELECT lid FROM .".$this->table_link." ORDER BY lid";
	$row = $this->get_first_row_by_sql($sql, $limit, $offset);
	return $row;
}

function get_lid_from_catlink($limit=0, $offset=0)
{
	$sql = "SELECT DISTINCT lid FROM ".$this->table_catlink." ORDER BY lid";
	$row = $this->get_first_row_by_sql($sql, $limit, $offset);
	return $row;
}

function get_cid_from_cat($limit=0, $offset=0)
{
	$sql = "SELECT cid FROM .".$this->table_cat." ORDER BY cid";
	$row = $this->get_first_row_by_sql($sql, $limit, $offset);
	return $row;
}

function get_cid_from_catlink($limit=0, $offset=0)
{
	$sql = "SELECT DISTINCT cid FROM ".$this->table_catlink." ORDER BY cid";
	$row = $this->get_first_row_by_sql($sql, $limit, $offset);
	return $row;
}

function get_link_title_by_lid($lid)
{
	$sql = "SELECT title FROM ".$this->table_link." WHERE lid=$lid";
	$row = $this->get_row_by_sql($sql);
	$title = $row['title'];
	return $title;
}

function get_cat_title_by_cid($cid)
{
	$sql = "SELECT title FROM ".$this->table_cat." WHERE cid=$cid";
	$row = $this->get_row_by_sql($sql);
	$title = $row['title'];
	return $title;
}

function del_link_by_lid($lid)
{
	$sql = "DELETE FROM ".$this->table_link." WHERE lid=$lid";
	$this->query($sql);
}

function del_catlink_by_lid($lid)
{
	$sql = "DELETE FROM ".$this->table_catlink." WHERE lid=$lid";
	$this->query($sql);
}

function del_catlink_by_cid($cid)
{
	$sql = "DELETE FROM ".$this->table_catlink." WHERE cid=$cid";
	$this->query($sql);
}

//---------------------------------------------------------
// form
//---------------------------------------------------------
function _print_form_next()
{
	echo "<br />\n";

	$title  = '';
	$desc   = '';
	$submit = 'NEXT '.$this->_limit;
	echo $this->_form->build_lib_box_limit_offset($title, $desc, $this->_limit, $this->_next, $this->_op, $submit);
}

function print_form_del_link_from_catlink($lid_arr)
{
	$count = count($lid_arr);

?>
<br />
<hr />
<h4><font color='red'>ERROR</font></h4>
There are <b><?php echo $count; ?></b> zombie links in catlink table <br />
<br />
<form action='<?php echo $this->_THIS_URL; ?>' method='post'>
<input type='hidden' name='op'     value='del_link_from_catlink'>
<input type='hidden' name='limit'  value='<?php echo $this->_limit; ?>'>
<input type='hidden' name='offset' value='<?php echo $this->_offset; ?>'>
<?php

	foreach($lid_arr as $lid)
	{
		echo "<input type='hidden' name='lid[]' value='$lid'>";
		echo '<a href="'. $this->_build_link_manage($lid).'" target="_blank">';
		echo 'lid: '. sprintf("%03d", $lid);
		echo "</a><br />\n";
	}

	echo "<br />\n";

?>
<br />
<input type='submit' value='DELETE link from catlink'>
</form>
<?php

	$this->_print_finish();

}

function print_form_del_cat_from_catlink($cid_arr)
{
	$count = count($cid_arr);

?>
<br />
<hr />
<h4><font color='red'>ERROR</font></h4>
There are <b><?php echo $count; ?></b> zombie categories in catlink table <br />
<br />
<form action='<?php echo $this->_THIS_URL; ?>' method='post'>
<input type='hidden' name='op'     value='del_cat_from_catlink'>
<input type='hidden' name='limit'  value='<?php echo $this->_limit; ?>'>
<input type='hidden' name='offset' value='<?php echo $this->_offset; ?>'>
<?php

	foreach($cid_arr as $cid)
	{
		echo "<input type='hidden' name='cid[]' value='$cid'>";
		echo "cid: $cid <br />\n";
	}

	echo "<br />\n";

?>
<br />
<input type='submit' value='DELETE category from catlink'>
</form>
<?php

	$this->_print_finish();

}

function print_form_del_link($lid_arr)
{
	$count = count($lid_arr);

?>
<h4><font color='red'>ERROR</font></h4>
There are <b><?php echo $count; ?></b> links without category in link table <br />
<br />
<?php

if ($this->FLAG_DEBUG_LINK)
{
	echo "<form action='$this->_THIS_URL' method='post'>\n";
	echo "<input type='hidden' name='op'     value='del_link_from_link'  />\n";
	echo "<input type='hidden' name='limit'  value='". $this->_limit . "' />\n";
	echo "<input type='hidden' name='offset' value='". $this->_offset ."' />\n";
}

?>
<table border='1'><tr>
<th>link id</th>
<th>title</th>
</tr>
<?php

	foreach($lid_arr as $lid)
	{
		$title = $this->get_link_title_by_lid($lid);

		echo "<tr><td>";
		echo '<a href="'. $this->_build_link_manage($lid).'" target="_blank">';
		echo sprintf("%03d", $lid);
		echo '</a>';
		echo "<input type='hidden' name='lid[]' value='$lid'>";
		echo "</a>";
		echo '<td>'. htmlspecialchars($title). '</td>';
		echo "</tr>\n";
	}

?>
</table>
<br />
<?php

if ($this->FLAG_DEBUG_LINK)
{
	echo "<input type='submit' value='DELETE link form link'>";
	echo "</form>\n";
}

	$this->_print_finish();
}

function print_cat_list($cid_arr)
{
	$count = count($cid_arr);

?>
<h4>Notice</h4>
There are <b><?php echo $count; ?></b> categories without link in category table <br />
<br />
<table border='1'><tr>
<th>category id</th>
<th>title</th>
</tr>
<?php

	foreach($cid_arr as $cid)
	{
		$title = $this->get_cat_title_by_cid($cid);

		echo "<tr><td>";
		echo '<a href="'. $this->_build_category_manage($cid) .'" target="_blank">';
		echo sprintf("%03d", $cid);
		echo '</a></td>';
		echo '<td>'. htmlspecialchars($title) .'</td>';
		echo "</tr>\n";
	}

	echo "</table>\n";
	$this->_print_finish();

}

function _build_category_manage( $cid )
{
	$url = 'category_manage.php?op=mod_form&amp;cid='. intval($cid);
	return $url;
}

function _build_link_manage( $lid )
{
	$url = 'link_manage.php?op=mod_form&amp;lid='. intval( $lid );
	return $url;
}

//---------------------------------------------------------
// print
//---------------------------------------------------------
function _print_check_next($op)
{
	echo "<hr />\n";
	echo "<h4>OK</h4>\n";
	echo '<a href="'. $this->_build_url( $op, $this->_limit, 0 ) .'">';
	echo "GOTO Next</a><br /><br />\n";

	$this->_print_finish( false );
}

function _print_check_again_del($op)
{
	echo "<hr />\n";
	echo "<h4>DELETED</h4>\n";
	echo '<a href="'. $this->_build_url( $op, $this->_limit, $this->_offset ) .'">';
	echo "Check Again</a><br />\n";
}

function _print_finish( $flag=true )
{
	echo "<br />\n";

	if ( $flag )
	{	echo "<hr />\n";	}

	echo '<a href="table_manage_zombie.php">&gt;&gt; Check Again</a>';
	echo "<br /><br />\n";
	echo '<a href="table_manage.php">&gt;&gt; ';
	echo _AM_WEBLINKS_TABLE_MANAGE;
	echo "</a><br />\n";
}

function _build_url( $op, $limit, $offset )
{
	$url = $this->_THIS_URL .'?op='. $op .'&amp;limit='. $limit .'&amp;offset='. $offset;
	return $url;
}

//---------------------------------------------------------
// print_bread
//---------------------------------------------------------
function print_bread( $name='' )
{

	$arr = array(
		array(
			'name' => $this->_system->get_module_name(),
			'url'  => 'index.php',
		),
		array(
			'name' => _AM_WEBLINKS_TABLE_MANAGE,
			'url'  => 'table_manage.php',
		),
		array(
			'name' => $this->_THIS_TITLE,
			'url'  => $this->_THIS_URL,
		),
	);

	if ( $name )
	{
		$arr[] = array(
			'name' => $name,
		);
	}

	echo $this->_form->build_html_bread_crumb( $arr );
}

// --- class end ---
}


//=========================================================
// class admin_table_manage_zombie_form
//=========================================================
class admin_table_manage_zombie_form extends happy_linux_form_lib
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_table_manage_zombie_form()
{
	$this->happy_linux_form_lib();
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_table_manage_zombie_form();
	}
	return $instance;
}

//---------------------------------------------------------
// show form
//---------------------------------------------------------
function show_zombie_start( $title, $action )
{
	echo "When there are many links, timeout may occure.<br />\n";
	echo 'Plaese set limit, and start at "check lid of link in catlink table"'."<br />\n";
	echo "limit = 0 means unlimitd<br />\n";
	echo "<br />\n";

	$opt = array(
		'CHECK ALL'                              => 'check_all',
		'check lid of link in catlink table'     => 'check_link_in_catlink',
		'check cid of category in catlink table' => 'check_cat_in_catlink',
		'check lid of catlink in link table'     => 'check_catlink_in_link',
		'check cid of catlink in cattgory table' => 'check_catlink_in_cat',
	);

// form start
	echo $this->build_form_begin( 'weblinks_zombie', $action );
	echo $this->build_token();
	echo $this->build_html_input_hidden('offset', 0);

	echo $this->build_form_table_begin();
	echo $this->build_form_table_title( $title );

	$ele_op = $this->build_html_input_radio_select('op', 'check_all', $opt, "<br />\n" );
	echo $this->build_form_table_line('op', $ele_op );

	$ele_limit = $this->build_html_input_text('limit', 0);
	echo $this->build_form_table_line('limit', $ele_limit);

	$ele_submit = $this->build_html_input_submit('submit', _HAPPY_LINUX_EXECUTE );
	echo $this->build_form_table_line('', $ele_submit, 'foot', 'foot');

	echo $this->build_form_table_end();
	echo $this->build_form_end();
// --- form end ---

}

// --- class end ---
}

?>