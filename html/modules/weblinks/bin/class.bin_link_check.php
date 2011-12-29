<?php
// $Id: class.bin_link_check.php,v 1.1 2011/12/29 14:32:59 ohwada Exp $

// 2007-09-20 K.OHWADA
// not use config2_basic_handler

// 2007-06-10 K.OHWADA
// command parameter: limit offset

// 2007-05-18 K.OHWADA
// change check()

// 2006-09-10 K.OHWADA
// use happy_linux

// 2006-06-21 K.OHWADA
// BUG 4060: The command line of refreshed sites are limited to 10 sites.

// 2006-05-15 K.OHWADA
// new handler

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication


//=========================================================
// WebLinks Module
// class bin_link_check
// 2004-11-28 K.OHWADA
//=========================================================

class bin_link_check extends happy_linux_bin_base
{
// class
	var $_check;

// constant
	var $_MAILER          = 'XOOPS weblinks';
	var $_TITLE           = _WEBLINKS_ADMIN_LINK_BROKEN_CHECK;
	var $_FILENAME_RESULT = 'cache/link_check.html';

	var $_flag_echo_lid = 0;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function bin_link_check( $dirname )
{
	$this->happy_linux_bin_base( $dirname );
	$this->set_mailer( $this->_MAILER );
	$this->set_filename( 'modules/'.$dirname.'/'.$this->_FILENAME_RESULT );

	$this->_check  =& weblinks_get_handler( 'link_check',  $dirname );

	$this->_goto_admin = _WEBLINKS_ADMIN_GOTO_ADMIN_INDEX;
}

//---------------------------------------------------------
// check link broken
//---------------------------------------------------------
function check()
{
	$conf_data =& $this->_check->get_conf();
	$pass      =  $conf_data['bin_pass'];
	$mailto    =  $conf_data['bin_mailto'];
	$flag_send =  $conf_data['bin_send'];

	$this->set_env_param();

	if ( !$this->check_pass($pass) )
	{
		return false;
	}

	if ( $this->isset_opt('echo') )
	{
		$this->_flag_echo_lid = $this->get_opt('echo');
	}

	$this->_check->set_flag_echo(     $this->_flag_print );
	$this->_check->set_flag_echo_lid( $this->_flag_echo_lid );
	$this->_check->set_flag_write(    $this->_flag_write );

// --- file open ---
	$this->_check->open_bin( $this->get_filename() );
	$this->_check->print_write_data( $this->_get_html_header() );

	$this->_check->check($this->_limit, $this->_offset);

	$this->_check->print_write_data( $this->_get_html_footer() );
	$this->_check->close_bin( $this->_flag_chmod );
// --- file close ---

	if ($flag_send)
	{
		$total_link      = $this->_check->get_total_link();
		$num_link_broken = $this->_check->get_num_link_broken();

// mail
		$text = <<<END_OF_TEXT
total  links: $total_link
broken links: $num_link_broken
END_OF_TEXT;

		$this->_send_mail($mailto, $this->_TITLE, $text);
	}
}

//---------------------------------------------------------
}

?>