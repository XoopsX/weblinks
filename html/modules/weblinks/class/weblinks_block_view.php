<?php
// $Id: weblinks_block_view.php,v 1.1 2012/04/09 10:23:37 ohwada Exp $

//=========================================================
// WebLinks Module
// 2012-04-02 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('weblinks_block_view') ) 
{

//=========================================================
// class weblinks_block_view
//=========================================================
class weblinks_block_view extends happy_linux_basic
{
	var $_myts;

	var $_params = array();

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_block_view()
{
	$this->happy_linux_basic();
	$this->_myts =& MyTextSanitizer::getInstance();
}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) {
		$instance = new weblinks_block_view();
	}
	return $instance;
}

//---------------------------------------------------------
// function
//---------------------------------------------------------
function set_multi() 
{
// hack for multi language
	$this->set('title_multi',    $this->get('title') );
	$this->set('desc_multi',     $this->get('description') );
	$this->set('dohtml_multi',   $this->get('dohtml') );
	$this->set('dosmiley_multi', $this->get('dosmiley') );
	$this->set('doxcode_multi',  $this->get('doxcode') );
	$this->set('doimage_multi',  $this->get('doimage') );
	$this->set('dobr_multi',     $this->get('dobr') );

	if ( isset($this->_params['is_japanese_site']) && 
	     $this->_params['is_japanese_site'] ) {

		if ( $this->get('etc1') ) {
			$this->set('title_multi', $this->get('etc1') );
		}
		if ( $this->get('textarea1') ) {
			$this->set('desc_multi',     $this->get('textarea1') );
			$this->set('dohtml_multi',   $this->get('dohtml1') );
			$this->set('dosmiley_multi', $this->get('dosmiley1') );
			$this->set('doxcode_multi',  $this->get('doxcode1') );
			$this->set('doimage_multi',  $this->get('doimage1') );
			$this->set('dobr_multi',     $this->get('dobr1') );
		}
	}
}

function get_description_disp() 
{
	$disp = $this->display_textarea( 
		$this->get('desc_multi'), 
		$this->get('dohtml_multi'), 
		$this->get('dosmiley_multi'), 
		$this->get('doxcode_multi'), 
		$this->get('doimage_multi'),
		$this->get('dobr_multi') );
	return $disp;
}

function get_votes_disp() 
{
	$votes = $this->get('votes');
	if ($votes == 1) {
		$disp = _WLS_ONEVOTE;
	} else {
		$disp = sprintf(_WLS_NUMVOTES, $votes);
	}
	return $disp;
}

function get_rating_disp() 
{
	$disp = number_format( $this->get('rating'), 2 );
	return $disp;
}

function get_name_disp() 
{
	$disp = '';
	if ( $this->get('nameflag') && $this->get('name') ) {
		$disp = $this->get('name');
	}
	return $this->sanitize_text( $disp );
}

function get_mail_disp() 
{
	$disp = '';
	if ( $this->get('mailflag') && $this->get('mail') ) {
		$disp = $this->get('mail');
	}
	return $this->sanitize_text( $disp );
}

function get_show_popular() 
{
	$popular = $this->get_param('popular');
	if (( $popular > 0 )&&( $this->get('hits') >= $popular )) {
		return true;
	}
	return false;
}

function get_show_new_update() 
{
	$newdays     = $this->get_param('newdays');
	$show_new    = false;
	$show_update = false;

	if ( $newdays > 0) {
		$startdate = (time()-(86400 * $newdays));

		if ( $startdate < $this->get('time_create') ) {
			$show_new = true;

		} elseif ( $startdate < $this->get('time_update') ) {
			$show_update = true;
		}
	}

	return array($show_new, $show_update);
}

//---------------------------------------------------------
// for block
//---------------------------------------------------------
function get_block_title_disp() 
{
	$title_length = $this->get_param('title_length');
	$show_title = false;
	$title_disp = '';

	if ( $title_length != 0) {
		$show_title = true;
		$title_disp = $this->build_summary( 
			$this->get('title_multi'), $title_length );
	}

	return array( $show_title, $title_disp );
}

function get_block_desc_disp() 
{
	$desc_length  = $this->get_param('desc_length');
	$show_desc  = false;
	$desc_short = '';

// description
	$desc_html = $this->get_description_disp();

	if ( $desc_length != 0 ) {
		$show_desc  = true;
		$desc_short = $this->build_summary( $desc_html, $desc_length );
	}

	return array( $show_desc, $desc_short, $desc_html );
}

function get_block_banner_disp() 
{
	$max_width     = $this->get_param('max_width');
	$width_default = $this->get_param('width_default');
	$show_banner   = false;
	$width_row     = $this->get('width');
	$banner_width  = $width_row;

	if ( ($max_width > 0) && $this->get('banner') ) {
		$show_banner = true;

		if ($width_row > $max_width) {
			$banner_width = $max_width;
		}

		if (($width_row == 0) && ($width_default > 0)) {
			$banner_width = $width_default;
		}
	}

	return array($show_banner, $banner_width);
}

function get_block_hits_disp() 
{
	$order = $this->get_param('order');

// rating
	$rating_disp = $this->get_rating_disp();

// old style
	$hits_disp = $this->get('hits');
	if ($order == "rating") {
		$hits_disp = $rating_disp ;
	}

	return array( $hits_disp, $rating_disp );
}

//---------------------------------------------------------
// set & get
//---------------------------------------------------------
function set_params($v)
{
	$this->_params = $v;
}

function get_param($k)
{
	if ( isset($this->_params[$k]) ){
		return $this->_params[$k];
	}
	return false;
}

//---------------------------------------------------------
// MyTextSanitizer
//---------------------------------------------------------
function display_textarea($desc, $dohtml, $dosmiley, $doxcode, $doimage, $dobr)
{
	return $this->_myts->displayTarea($desc, $dohtml, $dosmiley, $doxcode, $doimage, $dobr);
}

// --- class end ---
}

// === class end ===
}

?>