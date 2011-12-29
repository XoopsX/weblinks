<?php
// $Id: mylinks110_to_weblinks120.php,v 1.1 2011/12/29 14:32:54 ohwada Exp $

// 2007-05-06 K.OHWADA
// BUG 4562: Fatal error
// Fatal error: Class 'weblinks_link_view' not found in weblinks_link_view_handler.php
// Fatal error: Call to undefined method weblinks_link_edit_handler::build_search()

// 2006-09-20 K.OHWADA
// this new file
// based on my11_to_web09.php

//================================================================
// WebLinks Module
// 2006-09-20 K.OHWADA
//================================================================

// system files
include 'admin_header.php';

//=========================================================
// class admin_import_mylinks
//=========================================================
class admin_import_mylinks extends happy_linux_basic_handler
{
	var $_MYLINKS_DIRNAME = 'mylinks';
	var $_LIMIT = 100;

	var $_weblinks_category_handler;
	var $_weblinks_link_handler;
	var $_weblinks_catlink_handler;
	var $_weblinks_votedata_handler;
	var $_weblinks_votedata_table;

	var $_mylinks_cat_table;
	var $_mylinks_links_table;
	var $_mylinks_text_table;
	var $_mylinks_votedata_table;

	var $_xoopscomments_table;

	var $_weblinks_mid;
	var $_mylinks_mid;

	var $_weblinks_shots_url;
	var $_weblinks_shots_dir;
	var $_mylinks_shots_dir;

	var $_form;
	var $_system;
	var $_strings;

// post
	var $_op;
	var $_limit;
	var $_offset;
	var $_next;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_import_mylinks()
{
	$this->happy_linux_basic_handler( WEBLINKS_DIRNAME );
	$this->set_debug_db_error( 1 );
	$this->set_debug_db_sql(   0 );

	$this->_system  =& happy_linux_system::getInstance();
	$this->_post    =& happy_linux_post::getInstance();
	$this->_form    =& happy_linux_form_lib::getInstance();

	$this->_weblinks_category_handler  =& weblinks_get_handler( 'category',  WEBLINKS_DIRNAME );
	$this->_weblinks_link_handler      =& weblinks_get_handler( 'link',      WEBLINKS_DIRNAME );
	$this->_weblinks_catlink_handler   =& weblinks_get_handler( 'catlink',   WEBLINKS_DIRNAME );
	$this->_weblinks_votedata_handler  =& weblinks_get_handler( 'votedata',  WEBLINKS_DIRNAME );
	$this->_weblinks_votedata_table    = $this->prefix( 'votedata' );

	$this->_weblinks_category_handler->set_debug_db_error( 1 );
	$this->_weblinks_link_handler->set_debug_db_error( 1 );
	$this->_weblinks_catlink_handler->set_debug_db_error( 1 );
	$this->_weblinks_votedata_handler->set_debug_db_error( 1 );

	$this->_mylinks_cat_table      = $this->db_prefix( 'mylinks_cat' );
	$this->_mylinks_links_table    = $this->db_prefix( 'mylinks_links' );
	$this->_mylinks_text_table     = $this->db_prefix( 'mylinks_text' );
	$this->_mylinks_votedata_table = $this->db_prefix( 'mylinks_votedata' );
	$this->_xoopscomments_table    = $this->db_prefix( 'xoopscomments' );

	$this->_weblinks_shots_url = WEBLINKS_URL."/images/shots/";
	$this->_weblinks_shots_dir = WEBLINKS_ROOT_PATH."/images/shots/";
	$this->_mylinks_shots_dir  = XOOPS_ROOT_PATH."/modules/".$this->_MYLINKS_DIRNAME."/images/shots/";

	$this->_weblinks_mid = $this->_system->get_mid();
	$this->_mylinks_mid  = $this->_system->get_mid_by_dirname( $this->_MYLINKS_DIRNAME );

}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_import_mylinks();
	}

	return $instance;
}

//---------------------------------------------------------
// POST
//---------------------------------------------------------
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
// menu
//---------------------------------------------------------
function menu()
{

?>
<br />
There are 4 steps. <br />
1. import shot images <br />
2. import category table <br />
3. import link table <br />
4. import votedate table <br />
5. import comment table <br />
excute each <?php echo $this->_LIMIT; ?> records at a time <br />
<br />
Preparation <br />
Please enable to be writable of cache directory. <br />
<br />
Nitice <br />
This program don't import modify and broken table. <br />
<h4 style="color:#ff0000;">Warnig</h4>
Excute only once, after install. <br />
This program overwrite MySQL tables. <br />
<?php

	$this->_form_image();
	$this->_form_re_create();

}

//---------------------------------------------------------
// import_images
//---------------------------------------------------------
function import_image()
{
	echo "<h4>STEP 1: import shot images</h4>\n";

	$this->_mylinks_shots_dir  = XOOPS_ROOT_PATH."/modules/".$this->_MYLINKS_DIRNAME."/images/shots/";
	$this->_weblinks_shots_dir = WEBLINKS_ROOT_PATH."/images/shots/";

	$file_arr = array();

	$dir = opendir($this->_mylinks_shots_dir);
	while ($file = readdir($dir) )
	{
		if ( $file == 'index.html' ) continue; 

		$file_full = $this->_mylinks_shots_dir.$file;
		if ( !is_file($file_full) )  continue;

		$file_arr[] = $file;
	}

	$count = count($file_arr);
	echo "There are $count images <br /><br />\n";

	$error_flag = false;

	if ($count > 0)
	{
		if ( is_writable($this->_weblinks_shots_dir) )
		{
			foreach ($file_arr as $file)
			{
				$file_source = $this->_mylinks_shots_dir.$file;
				$file_dest   = $this->_weblinks_shots_dir.$file;
			
				if (copy($file_source, $file_dest)) 
				{
					echo "$file_source -> $file_dest <br />\n";
				}
				else
				{
					echo "$file: <font color='red'>copy failed : $file_source</font><br />\n";
					$error_flag = true;
				}
			}
		}
		else
		{
			echo "<font color='red'>not writable: $this->_weblinks_shots_dir</font><br />\n";
			$error_flag = true;
		}
	}

	if ($error_flag)
	{
		echo "<h4><font color='red'>some images failed</font></h4>\n";
		echo "Plaese copy manualy <br />\n";
	}

	$this->_form_category();

}

//---------------------------------------------------------
// import_category
//---------------------------------------------------------
function import_category()
{
// === category table ===
// --- mylinks ---
//  cid int(5)
//  pid int(5)
//  title  varchar(50)
//  imgurl varchar(150)

// --- weblinks ---
//  cid int(5)
//  pid int(5)
//  title  varchar(50)
//  imgurl varchar(255)
//
//  cflag tinyint(2)        : not use
//  lflag tinyint(2)
//  tflag tinyint(2)        : not use
//  displayimg int(10)      : not use
//  description text        : not use
//  catdescription text     : not use
//  catfooter text          : not use
//  groupid varchar(255)    : not use
//  orders int(4)
//  editaccess varchar(255) : not use

	echo "<h4>STEP 2 : import category table</h4>";
	$sql1  =  "SELECT * FROM ".$this->_mylinks_cat_table." ORDER BY cid";
	$rows1 =& $this->get_rows_by_sql($sql1);
	$total =  count($rows1);

	echo "There are $total categorys in mylinks<br /><br />\n";

	$lflag  = 1;
	$orders = 1;

	foreach ($rows1 as $row)
	{
		$cid    = $row['cid'];
		$pid    = $row['pid'];
		$title  = $row['title'];
		$imgurl = $row['imgurl'];

		echo "$cid: $title <br />";

		$obj =& $this->_weblinks_category_handler->create();
		$obj->set('cid',    $cid);
		$obj->set('pid',    $pid);
		$obj->set('title',  $title);
		$obj->set('imgurl', $imgurl);
		$obj->set('lflag',  $lflag);
		$obj->set('orders', $orders);

		$sql2 = $this->_weblinks_category_handler->_build_insert_sql($obj, true);
		$res2 = $this->_weblinks_category_handler->query($sql2);
	}

	$this->_form_link();
}

//---------------------------------------------------------
// import_link
//---------------------------------------------------------
function import_link()
{
// === link & text table ===
// --- mylinks ---
// --- link table ---
//  lid int(11)
//  cid int(5) => multi
//  title varchar(100)
//  url varchar(250)
//  logourl varchar(60)
//  submitter int(11)
//  status tinyint(2) => not use
//  date int(10)
//  hits int(11)
//  rating double(6,4)
//  votes int(11)
//  comments int(11)

// --- mylinks_text table ---
//  lid int(11)
//  description text
  
// --- weblinks ---
//  lid int(11)
//  cids  varchar(100) : use catlink
//  title varchar(100)
//  url varchar(255)
//  banner varchar(255) : full url
//  uid int(5) : submitter
//  time_create int(10)
//  time_update int(10)
//  hits int(11)
//  rating double(6,4)
//  votes int(11)
//  comments int(11)
//  description text
//
//  search text default
//  passwd varchar(255)
//
//  name varchar(255)
//  nameflag tinyint(2)
//  mail varchar(255)
//  mailflag tinyint(2)
//  company varchar(255)
//  addr varchar(255)
//  tel varchar(255)
//  admincomment text
//  width  int(5)
//  height int(5)
//  recommend tinyint(2)
//  mutual    tinyint(2)
//  broken int(11)
//  rss_url  varchar(255)
//  rss_flag tinyint(3)
//  rss_xml  mediumtext
//  rss_update int(10)
//  usercomment text
//  zip    varchar(100)
//  state  varchar(100)
//  city   varchar(100)
//  addr2  varchar(255)
//  fax    varchar(255)

	$offset = $this->get_post_offset();

	$sql1  =  "SELECT count(*) FROM ".$this->_mylinks_links_table;
	$total =& $this->get_count_by_sql($sql1);

	$sql2  =  "SELECT * FROM ".$this->_mylinks_links_table." ORDER BY lid";
	$rows2 =& $this->get_rows_by_sql($sql2, $this->_LIMIT, $offset);

	$next   = $this->_next;
	if ( $this->_next > $total )
	{
		$next = $total;
	}

	echo "<h4>STEP 3: link table</h4>\n";
	echo "There are $total links in mylinks<br />\n";
	echo "Import $offset - $next th link <br /><br />";

// init category list
	$this->_weblinks_category_handler->load();

	foreach ($rows2 as $row)
	{
		$lid         = $row['lid'];
		$uid         = $row['submitter'];
		$cid         = $row['cid'];
		$title       = $row['title'];
		$url         = $row['url'];
		$hits        = $row['hits'];
		$rating      = $row['rating'];
		$votes       = $row['votes'];
		$comments    = $row['comments']; 
		$time_create = $row['date'];
		$time_update = $time_create;
		$logourl     = $row['logourl'];

		echo "$lid: $title <br />";

		$cid_arr = array($cid);
		$banner  = '';
		$width   = 0;
		$height  = 0;

		if ($logourl)
		{
			$banner       = $this->_weblinks_shots_url.$logourl;
			$banner_local = $this->_weblinks_shots_dir.$logourl;
			$size         = GetImageSize($banner_local);

			if ($size)
			{
				$width  = intval( $size[0] );
				$height = intval( $size[1] );
			}
			else
			{
				echo "<font color='red'>image size error: $banner</font><br />";
			}
		}

		$description = $this->get_mylinks_description($lid);
		$passwd = md5( xoops_makepass() );

// new object
		$obj =& new weblinks_link_save( WEBLINKS_DIRNAME );

		$obj->set('lid',         $lid);
		$obj->set('uid',         $uid);
		$obj->set('title',       $title);
		$obj->set('url',         $url);
		$obj->set('hits',        $hits);
		$obj->set('rating',      $rating);
		$obj->set('votes',       $votes);
		$obj->set('comments',    $comments);
		$obj->set('time_create', $time_create);
		$obj->set('time_update', $time_update);
		$obj->set('banner',      $banner);
		$obj->set('width',       $width);
		$obj->set('height',      $height);
		$obj->set('description', $description);
		$obj->set('passwd',      $passwd);

// search
		$search = $obj->build_search( $cid_arr );
		$obj->setVar('search', $search);

		$sql2 = $this->_weblinks_link_handler->_build_insert_sql($obj, true);
		$res2 = $this->_weblinks_link_handler->query($sql2);

		$res3 = $this->_weblinks_catlink_handler->add_link_by_lid_cid_array($lid, array($cid) );
	}

	if ( $total > $next )
	{
		$this->_form_next_link($next);
	}
	else
	{
		$this->_form_votedate();
	}

}

function get_mylinks_description($lid)
{
	$sql  =  "SELECT * FROM ".$this->_mylinks_text_table." WHERE lid=".$lid;
	$row  =& $this->get_row_by_sql($sql);
	$desc =  $row['description'];
	return $desc;
}

//---------------------------------------------------------
// import_votedate
//---------------------------------------------------------
function import_votedate()
{
	echo "<h4>STEP 4 : import votedata table</h4>";

	$sql  = "INSERT INTO ".$this->_weblinks_votedata_table." ";
	$sql .= "SELECT * FROM ".$this->_mylinks_votedata_table."";
	$this->query($sql);

	$this->_form_comment();
}

//---------------------------------------------------------
// import_comment
//---------------------------------------------------------
function import_comment()
{
	echo "<h4>STEP 5 : import xoopscomments table</h4>";

	$com_id_arr = array();

	$sql1  = "SELECT * FROM ".$this->_xoopscomments_table." ";
	$sql1 .= "WHERE com_modid=".$this->_mylinks_mid." ";
	$sql1 .= "ORDER BY com_id ";
	$rows1 = & $this->get_rows_by_sql($sql1);
	$total = count($rows1);

	echo "There are $total comments <br /><br />\n";

	foreach ( $rows1 as $row )
	{
		$com_id       = $row['com_id'];
		$com_pid      = $row['com_pid'];
		$com_icon     = $row['com_icon'];
		$com_sig      = $row['com_sig'];
		$com_status   = $row['com_status'];
		$com_exparams = $row['com_exparams'];
		$com_itemid   = $row['com_itemid'];
		$com_uid      = $row['com_uid'];
		$com_ip       = $row['com_ip'];
		$com_title    = $row['com_title'];
		$com_text     = $row['com_text'];
		$com_created  = $row['com_created'];
		$com_modified = $row['com_modified'];
		$dohtml       = $row['dohtml'];
		$dosmiley     = $row['dosmiley'];
		$doxcode      = $row['doxcode'];
		$doimage      = $row['doimage'];
		$dobr         = $row['dobr'];

		echo "$com_id: $com_title <br />";

// xoopscomments table
		$sql2  = "INSERT INTO ".$this->_xoopscomments_table." (";
		$sql2 .= "com_modid, com_itemid, com_icon, com_created, com_modified, com_uid, com_ip, com_title, com_text, com_sig, com_status, com_exparams, dohtml, dosmiley, doxcode, doimage, dobr";
		$sql2 .= ") VALUES (";
		$sql2 .= $this->_weblinks_mid.", ";
		$sql2 .= "$com_itemid, '$com_icon', $com_created, $com_modified, $com_uid, '$com_ip', '$com_title', '$com_text', $com_sig, $com_status, '$com_exparams', $dohtml, $dosmiley, $doxcode, $doimage, $dobr";
		$sql2 .= ")";

		$this->query($sql2);
		$newid = $this->_db->getInsertId();

		$com_id_new     = $newid;
		$com_rootid_new = $newid;
		$com_pid_new    = 0;

		if ( $com_pid )
		{
			if ( isset( $com_id_arr[$com_pid] ) )
			{
				$com_rootid_new = $com_id_arr[$com_pid]['com_rootid_new'];
				$com_pid_new    = $com_id_arr[$com_pid]['com_id_new'];
			}
			else
			{
				echo "<font color='red'>pid convert error: $com_id </font><br />";
			}
		}

		$sql3  = "UPDATE ".$this->_xoopscomments_table." SET ";
		$sql3 .= "com_rootid=".$com_rootid_new.", ";
		$sql3 .= "com_pid=".$com_pid_new." ";
		$sql3 .= "WHERE com_id=".$com_id_new;

		$this->query($sql3);

		$com_id_arr[$com_id]['com_id_new']     = $com_id_new;
		$com_id_arr[$com_id]['com_rootid_new'] = $com_rootid_new;
	}

	$this->_print_finish();
}

//---------------------------------------------------------
// re_create
//---------------------------------------------------------
function re_create()
{
	echo "<h4>drop & create category table</h4>";
	$magic = $this->_weblinks_category_handler->get_magic_word();
	$this->_weblinks_category_handler->drop_table( $magic );
	$this->_weblinks_category_handler->create_table();

	echo "<h4>drop & create link table</h4>";
	$magic = $this->_weblinks_link_handler->get_magic_word();
	$this->_weblinks_link_handler->drop_table( $magic );
	$this->_weblinks_link_handler->create_table();

	echo "<h4>drop & create votedata table</h4>";
	$magic = $this->_weblinks_votedata_handler->get_magic_word();
	$this->_weblinks_votedata_handler->drop_table( $magic );
	$this->_weblinks_votedata_handler->create_table();

	echo "<h4>clean catlink table</h4>";
	$magic = $this->_weblinks_catlink_handler->get_magic_word();
	$this->_weblinks_catlink_handler->clean_table( $magic );

	echo "<h4>clear xoopscomments table</h4>";
	$this->clear_comment();
	
	$this->_print_finish();
}

function clear_comment()
{
	$sql = "DELETE FROM ".$this->_xoopscomments_table." WHERE com_modid=".$this->_weblinks_mid;
	$res = $this->query($sql);
}

//---------------------------------------------------------
// source module
//---------------------------------------------------------
function exist_source_module()
{
	if ( $this->_mylinks_mid )
	{
		return true;
	}
	return false;
}

function get_source_msg_not_installed()
{
	$msg = $this->_MYLINKS_DIRNAME." module is not installed \n";
	return $msg;
}

//---------------------------------------------------------
// form
//---------------------------------------------------------
function _print_finish()
{
	echo "<br /><hr />\n";
	echo "<h4>FINISHED</h4>\n";
	echo '<a href="index.php">GOTO Admin Menu</a>'."<br />\n";
}

function _form_re_create()
{
	$title  = 'STEP 0 : initalize';
	$op     = 're_create';
	$submit = 'GO STEP 0';

	echo "<h4>".$title."</h4>\n";
	echo "Drop and create tables.<br />\n";
	echo "If you want to redo <br />\n";
	$this->_print_form_next($title, $op, $submit);
}

function _form_image()
{
	$title  = 'STEP 1 : shot images';
	$op     = 'import_image';
	$submit = 'GO STEP 1';

	echo "<h4>".$title."</h4>\n";
	$this->_print_form_next($title, $op, $submit);
}

function _form_category()
{
	$title  = 'STEP 2 : import category table';
	$op     = 'import_category';
	$submit = 'GO STEP 2';

	echo "<h4>".$title."</h4>\n";
	$this->_print_form_next($title, $op, $submit);
}

function _form_link()
{
	$title  = 'STEP 3 : import link table';
	$op     = 'import_link';
	$submit = 'GO STEP 3';

	echo "<h4>".$title."</h4>\n";
	$this->_print_form_next($title, $op, $submit);
}

function _form_next_link($offset)
{
	$title  = 'STEP 3 : import link table';
	$submit = "GO next ".$this->_LIMIT." links";
	$op     = 'import_link';

	echo "<br /><hr />\n";
	echo "<h4>".$title."</h4>\n";
	$this->_print_form_next($title, $op, $submit, $offset);
}

function _form_votedate()
{
	$title  = 'STEP 4 : import votedate table';
	$op     = 'import_votedate';
	$submit = 'GO STEP 4';

	echo "<h4>".$title."</h4>\n";
	$this->_print_form_next($title, $op, $submit);
}

function _form_comment()
{
	$title  = 'STEP 5 : import comment table';
	$op     = 'import_comment';
	$submit = 'GO STEP 5';

	echo "<h4>".$title."</h4>\n";
	$this->_print_form_next($title, $op, $submit);
}

function _print_form_next($title, $op, $submit, $offset=0)
{
	echo "<br /><hr />\n";
	echo "<h4>".$title."</h4>\n";

	if ($offset)
	{
		$next = $offset + $this->_LIMIT;
		echo "Import ".$offset." - ".$next." th record<br />\n";
	}

// show form
	$limit  = 0;
	$desc   = '';
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

//=========================================================
// main
//=========================================================
xoops_cp_header();

$import =& admin_import_mylinks::getInstance();

weblinks_admin_print_bread( _AM_WEBLINKS_IMPORT_MANAGE, 'import_manage.php', 'mylinks' );
echo "<h3>".'Imort from mylinks module'."</h3>\n";
echo "Import DB mylinks 1.10 to weblinks 1.20 or later <br /><br />\n";

if( !$import->exist_source_module() ) 
{
	xoops_error( $import->get_source_msg_not_installed() );
	xoops_cp_footer();
	exit();
}

$op = $import->get_post_op();

switch ($op) 
{
case "import_image":
	if( !$import->check_token() ) 
	{
		xoops_error("Token Error");
	}
	else
	{
		$import->import_image();
	}
	break;

case "import_category":
	if( !$import->check_token() ) 
	{
		xoops_error("Token Error");
	}
	else
	{
		$import->import_category();
	}
	break;

case "import_link":
	if( !$import->check_token() ) 
	{
		xoops_error("Token Error");
	}
	else
	{
		$import->import_link();
	}
	break;

case "import_votedate":
	if( !$import->check_token() ) 
	{
		xoops_error("Token Error");
	}
	else
	{
		$import->import_votedate();
	}
	break;

case "import_comment":
	if( !$import->check_token() ) 
	{
		xoops_error("Token Error");
	}
	else
	{
		$import->import_comment();
	}
	break;

case "re_create":
	if( !$import->check_token() ) 
	{
		xoops_error("Token Error");
	}
	else
	{
		$import->re_create();
	}
	break;

case 'menu':
default:
	$import->menu();
	break;

}

xoops_cp_footer();
exit();

?>