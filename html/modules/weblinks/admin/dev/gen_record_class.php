<?php
// $Id: gen_record_class.php,v 1.1 2011/12/29 14:32:57 ohwada Exp $

// 2008-02-17 K.OHWADA
// print_blue_bold()

// 2007-10-30 K.OHWADA
// comment for dhtml

// 2007-09-01 K.OHWADA
// build_link_record_array_from_param()

// 2007-04-08 K.OHWADA
// gm_type

// 2007-03-25 K.OHWADA
// album_id

// 2007-03-01 K.OHWADA
// forum_id comment_use 
// user can use textarea1

//================================================================
// WebLinks Module
// 2006-09-20 K.OHWADA
//================================================================

//---------------------------------------------------------
// build_link_record_from_param
//
// $mode_dhtml
//   0: dohtml, etc = 0
//   1: dohtml, etc = 1
//   2: dohtml, etc = random
//
// $flag_uid
//   false: uid = system uid
//   true:  uid = random
//
// $rssc_lid_flag_update
//   false: rssc_lid_flag_update = 0
//   true:  rssc_lid_flag_update = 1
//---------------------------------------------------------

//=========================================================
// class weblinks_gen_record
//=========================================================
class weblinks_gen_record extends weblinks_dev_handler
{
	var $_GM_PRECISION = 0.000000000001;
	var $_MAX_CAT = 50;
	var $_WIDTH   = 20;
	var $_HEIGHT  = 27;
	var $_SLASHED_TEXT;

	var $_strings;
	var $_system;

	var $_mid;
	var $_is_xoops_guest;

	var $_com_id_arr     = array();
	var $_com_itemid_arr = array();

	var $_DEBUG_PRINT;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_gen_record()
{
	$this->weblinks_dev_handler();
	$this->set_debug_db_sql(   false );
	$this->set_debug_db_error( true );

	$this->_strings =& happy_linux_strings::getInstance();
	$this->_system  =& happy_linux_system::getInstance();

	$this->_mid = $this->_system->get_mid();
	$this->_is_xoops_guest = $this->_system->is_guest();

	$this->_SLASHED_TEXT = ' <h1>h1</h1> '.addslashes( addslashes( ' \ " '." ' " ) );
}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new weblinks_gen_record();
	}
	return $instance;
}

//---------------------------------------------------------
// category table
//---------------------------------------------------------
// --- category table ---
//  cid int(5)
//  pid int(5)
//  title varchar(50)
//  imgurl varchar(150)

function gen_category($MAX_CAT, $MAX_PARENT=0)
{
	echo "<h4>generete category table</h4>\n";

	if ($MAX_CAT == 0)
	{
		echo "skip <br />\n";
		return;
	}

	srand( (double)microtime()*1000000 );
	$imgurl_dir = XOOPS_URL."/modules/".WEBLINKS_DIRNAME."/images/category/";

// contant
	$pid = 0;

	for ($i=0; $i<$MAX_PARENT; $i++)
	{
// randum data
		$title  = "main_". $this->get_randum_title();
		$imgurl = $this->get_randum_category_image();
		$orders = rand(1, 10);

// ctegory table
		$this->insert_category($pid, $title, $imgurl, $orders);
	}

	echo "<br />\n";

// contant
	$imgurl = '';

	for ($i=0; $i<($MAX_CAT - $MAX_PARENT); $i++)
	{
// randum data
		$title   = "sub_". $this->get_randum_title();
		$max_pid = intval( ($MAX_PARENT + $i) / 2 );
		$pid     = rand(1, $max_pid);
		$orders  = rand(1, 10);

// ctegory table
		$this->insert_category($pid, $title, $imgurl, $orders);
	}
}

//---------------------------------------------------------
// link table
//---------------------------------------------------------
function gen_link($MAX_LINK, $MAX_CAT=0)
{
	echo "<h4>generete link table</h4>\n";

	if ($MAX_LINK == 0)
	{
		echo "skip <br />\n";
		return;
	}

	srand( (double)microtime()*1000000 );

	for ($i=0; $i<$MAX_LINK; $i++)
	{
		$newid = $this->insert_randum_link();

		$catnum = rand(1,3);
		for ($j=0; $j<$catnum; $j++)
		{
			$cid = rand(1, $MAX_CAT);
			$this->insert_catlink($cid, $newid);
		}
	}
}

//---------------------------------------------------------
// votedata table
//---------------------------------------------------------
// --- votedata table ---
//  ratingid int(11)
//  lid int(11)
//  ratinguser int(11)
//  rating tinyint(3)
//  ratinghostname varchar(60)
//  ratingtimestamp int(10)

function gen_votedata($MAX_VOTE, $MAX_LINK=0)
{
	echo "<h4>generete votedata table</h4>\n";

	if ($MAX_VOTE == 0)
	{
		echo "skip <br />\n";
		return;
	}

	srand( (double)microtime()*1000000 );

// table name
	$votedata_table = $this->prefix("votedata");
	$link_table     = $this->prefix("link");

	for ($i=0; $i<$MAX_VOTE; $i++)
	{
// randum data
		$lid = rand(1, $MAX_LINK);
		$ratinguser = rand(1, 10);
		$rating     = rand(0, 10);
		$ratinghostname  = $this->get_randum_ip();
		$ratingtimestamp = $this->get_randum_time();

// votedata table
		$this->insert_votedata($lid, $ratinguser, $rating, $ratinghostname, $ratingtimestamp);
	}

	echo "<br />\n";

	$rows2 =& $this->get_votedata_rows_groupby_lid();

	foreach ( $rows2 as $row2 )
	{
		$lid   = $row2['lid'];
		$count = $row2['c'];
		$sum   = $row2['s'];

		$this->update_link_rating_by_lid($sum, $count, $lid);
	}
}

//---------------------------------------------------------
// xoopscomments table
//---------------------------------------------------------
// com_id   mediumint(8)
// com_pid  mediumint(8)
// com_rootid  mediumint(8)
// com_modid   smallint(5)
// com_itemid  mediumint(8)
// com_icon    varchar(25)
// com_created  int(10)
// com_modified int(10)
// com_uid    mediumint(8)
// com_ip     varchar(15)
// com_title  varchar(255)
// com_text   text
// com_sig    tinyint(1)
// com_status tinyint(1)
// com_exparams  varchar(255)
// dohtml   tinyint(1)
// dosmiley tinyint(1)
// doxcode  tinyint(1)
// doimage  tinyint(1)
// dobr     tinyint(1)

function gen_comment( $MAX_COM, $MAX_LINK=0 )
{
	echo "<h4>generete xoopscomments table</h4>\n";

	if ($MAX_COM == 0)
	{
		echo "skip <br />\n";
		return;
	}

	srand( (double)microtime()*1000000 );

// table name
	$link_table = $this->prefix("link");

	$this->gen_comment_list( $this->_mid, $MAX_COM, $MAX_LINK );

	echo "<br />\n";

	$rows =& $this->get_comment_rows( $this->_mid );
	foreach ( $rows as $row )
	{
		$lid      = $row['com_itemid'];
		$comments = $row['c'];

		$this->update_link_comments( $lid, $comments );
	}
}

function gen_comment_list( $mid, $MAX_COM, $MAX_ITEMID )
{
	$this->_com_id_arr     = array();
	$this->_com_itemid_arr = array();

	for ($i=0; $i<$MAX_COM; $i++)
	{
		$this->create_randum_comment( $i, $mid, $MAX_ITEMID );
	}
}

//---------------------------------------------------------
// build_link_record
//---------------------------------------------------------
function &build_link_record( $title, $flag_uid, $mode_dhtml, $flag_rssc_lid )
{
	$param = array(
		'title'         => $title,
		'flag_uid'      => $flag_uid,
		'mode_dhtml'    => $mode_dhtml,
		'flag_rssc_lid' => $flag_rssc_lid,
	);

	$ret =& $this->build_link_record_from_param( $param );
	return $ret;
}

function &build_link_record_from_param( &$param )
{
	$flag_rssc_lid = $this->get_from_array($param, 'flag_rssc_lid');

	$arr1 =& $this->build_link_record_array_from_param( $param );

	$cid_arr =& $this->get_randum_cid_array();

	list($time_publish_year, $time_publish_month, $time_publish_day, $time_publish_hour, $time_publish_min, $time_publish_sec)
		= $this->_strings->split_time_ymd( $arr1['time_publish'] );
	list($time_expire_year, $time_expire_month, $time_expire_day, $time_expire_hour, $time_expire_min, $time_expire_sec)
		= $this->_strings->split_time_ymd( $arr1['time_expire'] );

	$time_update_flag_update = 0;
	$time_publish_flag       = 0;
	$time_expire_flag        = 0;

	$rssc_lid_flag_update = 0;
	if ($flag_rssc_lid)
	{
		$rssc_lid_flag_update = 1;
	}

	$arr2 = array(
    	'cid'    => $cid_arr,

// time
		'time_publish_flag'  => $time_publish_flag,
		'time_publish_year'  => $time_publish_year,
		'time_publish_month' => $time_publish_month,
		'time_publish_day'   => $time_publish_day,
		'time_publish_hour'  => $time_publish_hour,
		'time_publish_min'   => $time_publish_min,
		'time_publish_sec'   => $time_publish_sec,
		'time_expire_flag'   => $time_expire_flag,
		'time_expire_year'   => $time_expire_year,
		'time_expire_month'  => $time_expire_month,
		'time_expire_day'    => $time_expire_day,
		'time_expire_hour'   => $time_expire_hour,
		'time_expire_min'    => $time_expire_min,
		'time_expire_sec'    => $time_expire_sec,
		'time_update_flag_update' => $time_update_flag_update,

// rssc_lid
 		'rssc_lid_flag_update'  => $rssc_lid_flag_update,

// dhtml
  		'weblinks_description' => $arr1['description'],
    	'weblinks_textarea1'   => $arr1['textarea1'],

// passwd
		'passwd_md5' => md5( $arr1['passwd'] ),
	 	'passwd_new' => '',
		'passwd_2'   => '',
	);

	$arr3 = array_merge($arr1, $arr2);
	return $arr3;
}

function &build_link_record_array_from_param( &$param )
{
	$title         = $this->get_from_array($param, 'title');
	$flag_uid      = $this->get_from_array($param, 'flag_uid');
	$mode_dhtml    = $this->get_from_array($param, 'mode_dhtml');

// common
	$url     = 'http://'. $title .'/';
	$rss_url = $url . $this->get_randum_title() . '.xml';
	$banner  = $this->get_randum_banner();
	$mail    = $this->get_randum_title() . '@' . $title . '.exsample.com';

// text
	$slashed_title = $title . $this->_SLASHED_TEXT;
	$name     = 'name_'.    $slashed_title;
	$company  = 'company_'. $slashed_title;
	$state    = 'state_'.   $slashed_title;
	$city     = 'city_'.    $slashed_title;
	$addr     = 'addr_'.    $slashed_title;
	$addr2    = 'addr2_'.   $slashed_title;
	$zip      = 'zip_'.     $slashed_title;
	$tel      = 'tel_'.     $slashed_title;
	$fax      = 'fax_'.     $slashed_title;
	$etc1     = 'etc1_'.    $slashed_title;
	$etc2     = 'etc2_'.    $slashed_title;
	$etc3     = 'etc3_'.    $slashed_title;
	$etc4     = 'etc4_'.    $slashed_title;
	$etc5     = 'etc5_'.    $slashed_title;

// textarea
	$slashed_textarea = "\n".$title."\n".$this->get_randum_number_06()."\n".$this->_SLASHED_TEXT."\n";

	$usercomment  = 'usercomment'  . $slashed_textarea; 

// dhtml
	$slashed_dhtml = "\n".$title."\n".$this->get_randum_number_06()."\n".$this->_SLASHED_TEXT."\n"; 
	$description  = 'description'  . $slashed_dhtml . $this->get_randum_dhtml();
	$textarea1    = 'textarea1'    . $slashed_dhtml . $this->get_randum_dhtml();
	$textarea2    = 'textarea2'    . $slashed_dhtml . $this->get_randum_dhtml();
	$admincomment = 'admincomment' . $slashed_dhtml . $this->get_randum_dhtml(); 

// passwd
	$passwd     = xoops_makepass();
//	$passwd_md5 = md5($passwd);

// integer
	$lid       = rand(10,100);
	$hits      = rand(10,100);
	$votes     = rand(10,100);
	$comments  = rand(10,100);
	$broken    = rand(10,100);
	$width     = rand(10,100);
	$height    = rand(10,100);
	$rating    = rand(10,100)/10;

	$nameflag  = 1;
	$mailflag  = 1;
	$request   = 1;
	$recommend = 1;
	$mutual    = 1;
	$rss_flag  = 2;	// rss

	$map_use = 1;
	list($gm_latitude, $gm_longitude, $gm_zoom, $gm_type)
		= $this->get_randum_gm_param();

	if ($flag_uid)
	{
		$uid = rand(10,100);
	}
	else
	{
		$uid = $this->_system->get_uid();
	}

	switch ($mode_dhtml)
	{
		case 1:
			$dohtml    = 1;
			$dosmiley  = 1;
			$doxcode   = 1;
			$doimage   = 1;
			$dobr      = 1;
			$dohtml1   = 1;
			$dosmiley1 = 1;
			$doxcode1  = 1;
			$doimage1  = 1;
			$dobr1     = 1;
			break;

		case 2:
			$dohtml    = rand(0,1);
			$dosmiley  = rand(0,1);
			$doxcode   = rand(0,1);
			$doimage   = rand(0,1);
			$dobr      = rand(0,1);
			$dohtml1   = rand(0,1);
			$dosmiley1 = rand(0,1);
			$doxcode1  = rand(0,1);
			$doimage1  = rand(0,1);
			$dobr1     = rand(0,1);
			break;

		case 0:
		default:
			$dohtml    = 0;
			$dosmiley  = 0;
			$doxcode   = 0;
			$doimage   = 0;
			$dobr      = 0;
			$dohtml1   = 0;
			$dosmiley1 = 0;
			$doxcode1  = 0;
			$doimage1  = 0;
			$dobr1     = 0;
			break;
	}

	list($time_create, $time_update)
		 = $this->get_randum_create_time();

	$time_publish  = time() - rand(0,10000);
	$time_expire   = time() + rand(0,10000);
	$rssc_lid      = rand(10,100);

	$forum_id    = 0;
	$comment_use = 1;
	$album_id    = 0;

	$arr = array(
	   	'lid'    => $lid,
    	'title'  => $title,
    	'uid'    => $uid,
    	'url'    => $url,
	   	'recommend' => $recommend,
		'mutual'    => $mutual,
    	'banner'    => $banner,
    	'rss_url'   => $rss_url,
    	'rss_flag'  => $rss_flag,
    	'name'      => $name,
    	'nameflag'  => $nameflag,
    	'mail'      => $mail,
    	'mailflag'  => $mailflag,
    	'company'   => $company,
    	'zip'       => $zip,
    	'state'     => $state,
    	'city'      => $city,
    	'addr'      => $addr,
    	'addr2'     => $addr2,
    	'tel'       => $tel,
    	'fax'       => $fax,
    	'etc1'      => $etc1,
    	'etc2'      => $etc2,
    	'etc3'      => $etc3,
    	'etc4'      => $etc4,
    	'etc5'      => $etc5,
    	'usercomment'  => $usercomment,
    	'admincomment' => $admincomment,
		'map_use'      => $map_use,
		'gm_latitude'  => $gm_latitude,
		'gm_longitude' => $gm_longitude,
		'gm_zoom'      => $gm_zoom,
		'gm_type'      => $gm_type,
		'dohtml'    => $dohtml,
    	'dosmiley'  => $dosmiley,
    	'doxcode'   => $doxcode,
    	'doimage'   => $doimage,
    	'dobr'      => $dobr,
    	'dohtml1'   => $dohtml1,
    	'dosmiley1' => $dosmiley1,
    	'doxcode1'  => $doxcode1,
    	'doimage1'  => $doimage1,
    	'dobr1'     => $dobr1,
		'hits'       => $hits,
		'rating'     => $rating,
		'votes'      => $votes,
		'comments'   => $comments,
		'broken'     => $broken,
		'width'      => $width,
		'height'     => $height,
		'cids'       => '',
		'search'     => '',

// time
		'time_create'        => $time_create,
		'time_update'        => $time_update,
		'time_publish'       => $time_publish,
		'time_expire'        => $time_expire,

// rssc_lid
		'rssc_lid'              => $rssc_lid,

// dhtml
  		'description' => $description,
    	'textarea1'   => $textarea1,
    	'textarea2'   => $textarea2,

// passwd
 		'passwd'     => $passwd,

		'forum_id'    => $forum_id,
		'comment_use' => $comment_use,
		'album_id'    => $album_id,

// not use
		'mark'       => '',
		'rss_xml'    => '',
		'rss_update' => 0,
		'aux_int_1'  => 0,
		'aux_int_2'  => 0,
		'aux_text_1' => '',
		'aux_text_2' => '',
	);

	$ret =& $this->assign_link( $arr );
	return $ret;
}

//---------------------------------------------------------
// get randum value
//---------------------------------------------------------
function get_randum_category_image()
{
	$imgurl_dir = XOOPS_URL."/modules/".WEBLINKS_DIRNAME."/images/category";
	$imgurl = $imgurl_dir .'/'. $this->get_randum_image();
	return $imgurl;
}

function get_randum_banner( $num=0 )
{
	$banner_dir = XOOPS_URL."/modules/".WEBLINKS_DIRNAME."/images/link";
	$banner = '';

// once at $num times
	if (( $num == 0 )||( rand(0, $num) == 0 ))
	{
		$banner = $banner_dir .'/'. $this->get_randum_image();
	}

	return $banner;
}

function get_randum_image()
{
	$image = sprintf( "%01d", rand(0, 9) ) . ".gif";
	return $image;
}

function get_randum_create_time()
{
	$time  = time();
	$rand1 = rand(0, 365*24*60*60);	// 1 year
	$rand2 = rand(0, intval( $rand1/2 ) );
	$time_create = $time - $rand1;
	$time_update = $time - $rand2;

	return array($time_create, $time_update);
}

function get_randum_mark()
{
	$mark = 0;
// once at 10 times
	if ( rand(0, 9) == 9 )
	{
		$mark = 1;
	}
	return $mark;
}

function get_randum_passwd_md5()
{
	return md5( xoops_makepass() );
}

function get_randum_title()
{
	$title = $this->get_randum_char() . $this->get_randum_number_06();
	return $title;
}

function get_randum_time()
{
	$time = time() - rand(0, 365*24*60*60);	// 1 year
	return $time;
}

function get_randum_ip()
{
	$ip = "192.168.1." . rand(1,255);
	return $ip;
}

function get_randum_cid_array()
{
	$arr = array();
	$i = 0;
	for ($j=0; $j<100; $j++)
	{
		$cid = rand(1, $this->_MAX_CAT);
		if ( !in_array($cid, $arr) )
		{
			$arr[] = $cid;
			$i ++;
		}
		if ($i>3)
		{
			break;
		}
	}
	return $arr;
}

function get_randum_gm_param()
{
	$gm_latitude  = 34.64933466571561 + rand(100,1000000)/1000000;;
	$gm_longitude = 135.0 + rand(100,1000000)/1000000;
	$gm_zoom      = sprintf( "%02d", rand(10,14) );
	$gm_type      = rand(0,2);

    return array($gm_latitude, $gm_longitude, $gm_zoom, $gm_type);
}

function get_randum_dhtml()
{
	$text  = "<h2>". $this->get_randum_number_04() ."</h2>\n";
	$text .= "[b]". $this->get_randum_number_04() ."[/b]\n";
	$text .= "[img]". $this->get_randum_banner() ."[/img]\n";
	$text .= " :-D \n";
	return $text;
}

function get_randum_char()
{
	return chr( rand(97,122) );
}

function get_randum_number_04()
{
	return sprintf( "%04d", rand(0,9999) );
}

function get_randum_number_06()
{
	return sprintf( "%06d", rand(0,999999) );
}

//---------------------------------------------------------
// print
//---------------------------------------------------------
function print_msg( $msg, $flag_sanitize=true )
{
	if ( is_array($msg) )
	{
		foreach ( $msg as $k => $v )
		{
			echo $k . " : \n";
			$this->print_msg( $v );
		}
	}
	else
	{
		if ( $flag_sanitize )
		{
			$msg = htmlspecialchars( $msg );
		}
		echo $msg . "<br />\n";
	}
}

function print_debug( $msg, $flag_sanitize=true )
{
	if ( $this->_DEBUG_PRINT )
	{
		$this->print_msg( $msg, $flag_sanitize );
	}
}

function print_error( $msg, $flag_sanitize=true )
{
	if ( $msg )
	{
		if ( $flag_sanitize )
		{
			$msg = htmlspecialchars( $msg );
		}
		echo '<span style="color: #ff0000;">' . $msg . "</span><br />\n";
	}
}

function print_box($title, $msg)
{
	echo $title ."<br />\n";
	echo '<div style="border-width: 1px; border-style: solid; border-color: #808080;">';
	echo $msg;
	echo "</div><br />\n";
}

function print_blue_bold( $msg, $flag_sanitize=true )
{
	if ( $msg )
	{
		if ( $flag_sanitize )
		{
			$msg = htmlspecialchars( $msg );
		}
		echo '<span style="color:#0000ff; font-weight:bold">' . $msg . "</span><br />\n";
	}
}

//---------------------------------------------------------
// utility
//---------------------------------------------------------
function set_debug_print($val)
{
	$this->_DEBUG_PRINT = (bool)$val;
}

function get_from_array(&$arr, $key)
{
	$val = false;
	if ( isset($arr[$key]) )
	{
		$val = $arr[$key];
	}
	return $val;
}

function print_param(&$arr)
{
	echo "<table>\n";
	foreach ($arr as $k => $v)
	{
		echo "<tr><td>$k</td><td>$v</td></tr>\n";
	}
	echo "</table>\n";
}

// --- class end ---
}

?>