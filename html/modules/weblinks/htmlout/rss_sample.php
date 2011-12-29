<?php
// $Id: rss_sample.php,v 1.1 2011/12/29 14:32:31 ohwada Exp $

//=========================================================
// WebLinks Module
// 2008-02-17 K.OHWADA
//=========================================================

//---------------------------------------------------------
// name: rss_sample
// description: RSS: url in description
// param: none
//---------------------------------------------------------

// === class begin ===
if( !class_exists('weblinks_htmlout_rss_sample') ) 
{

class weblinks_htmlout_rss_sample extends weblinks_htmlout_base
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_htmlout_rss_sample( $dirname )
{
	$this->weblinks_htmlout_base( $dirname );
}

//---------------------------------------------------------
// function
//---------------------------------------------------------
function description()
{
	return 'RSS: url in description';
}

function execute_plugin()
{
	$url       = $this->get('url');
	$desc_disp = $this->get('description_disp');

	$text = '';
	if ( $url )
	{
		$url_s = happy_linux_sanitize_url( $url );
		$text .= '<a href="'. $url_s. '" target="_blank">';
		$text .= $url_s .'</a> <br /><br />';
	}
	$text .= $desc_disp;

	$this->set('rss_content', $text );
	return true;
}

// --- class end ---
}

// === class end ===
}

?>