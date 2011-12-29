<?php
// $Id: default.php,v 1.1 2011/12/29 14:32:32 ohwada Exp $

//=========================================================
// WebLinks Module
// 2008-02-17 K.OHWADA
//=========================================================

// --- weblinks_htmlout_data_default begin ---
if( !function_exists( 'weblinks_htmlout_data_default' ) ) 
{

function weblinks_htmlout_data_default()
{
	$catpaths = array (
		0 => array (
			0 => array (
				'cid'   => 12,
				'title' => 'Asia',
			),
			1 => array (
				'cid'   => 23,
				'title' => 'Japan',
			),
		),
		1 => array (
			0 => array (
				'cid'   => 13,
				'title' => 'Harbor',
			),
			1 => array (
				'cid'   => 24,
				'title' => 'Yohohama',
			),
		),
	);

	$arr = array (
		'lid'          => '12345',
		'uid'          => '1',
		'cids'         => '',
		'title'        => 'Exsample Site',
		'url'          => 'http://exsample.com/',
		'banner'       => 'http://exsample.com/banner.gif',
		'description'  => 'exsample description',
		'name'         => 'webmaster',
		'nameflag'     => '1',
		'mail'         => 'webmaster@exsample.com',
		'mailflag'     => '1',
		'company'      => 'exsapmle company',
		'addr'         => 'Kannai',
		'tel'          => '123-4567',
		'search'       => '',
		'passwd'       => '',
		'admincomment' => 'exsample admin comment',
		'mark'         => '',
		'time_create'  => '1196585966',
		'time_update'  => '1198624366',
		'hits'         => '12',
		'rating'       => '3.4000',
		'votes'        => '24',
		'comments'     => '4',
		'width'        => '144',
		'height'       => '80',
		'recommend'    => '1',
		'mutual'       => '1',
		'broken'       => '2',
		'rss_url'      => '',
		'rss_flag'     => 0,
		'rss_xml'      => '',
		'rss_update'   => '0',
		'usercomment'  => '',
		'zip'          => '345-0067',
		'state'        => 'Kanagawa',
		'city'         => 'Yokohama',
		'addr2'        => '',
		'fax'          => '123-5678',
		'dohtml'       => '0',
		'dosmiley'     => '1',
		'doxcode'      => '1',
		'doimage'      => '1',
		'dobr'         => '1',
		'etc1'         => 'exsample etc 1',
		'etc2'         => 'exsample etc 2',
		'etc3'         => 'exsample etc 3',
		'etc4'         => 'exsample etc 4',
		'etc5'         => 'exsample etc 5',
		'map_use'      => '0',
		'rssc_lid'     => '0',
		'gm_latitude'  => '35.451581100085086',
		'gm_longitude' => '139.6479034423828',
		'gm_zoom'      => '6',
		'aux_int_1'    => '0',
		'aux_int_2'    => '0',
		'aux_text_1'   => '',
		'aux_text_2'   => '',
		'time_publish' => '0',
		'time_expire'  => '0',
		'textarea1'    => 'exsample textarea 1',
		'textarea2'    => 'exsample textarea 2',
		'dohtml1'      => '0',
		'dosmiley1'    => '1',
		'doxcode1'     => '1',
		'doimage1'     => '1',
		'dobr1'        => '1',
		'forum_id'     => '0',
		'comment_use'  => '1',
		'album_id'     => '0',
		'gm_type'      => '0',
		'pagerank'     => '1',
		'pagerank_update' => '1198634366',
		'catpaths'     => $catpaths,

	);

	return $arr;
}

// --- weblinks_htmlout_data_default end ---
}

?>