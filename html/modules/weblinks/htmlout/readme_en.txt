$Id: readme_en.txt,v 1.1 2011/12/29 14:32:32 ohwada Exp $

=================================================
how to make HTML output plugin
=================================================

"foobar" is exsample plugin name

1. exsapmple for plugin

htmlout/foobar.php
------
if( !class_exists('weblinks_htmlout_foobar') ) 
{

class weblinks_htmlout_foobar extends weblinks_htmlout_base
{

function weblinks_htmlout_foobar( $dirname )
{
	$this->weblinks_htmlout_base( $dirname );
}

function description()
{
	// write in English
	return "this is foobar description";
}

function execute_plugin()
{
	$content = $this->get_item_by_key( 'content' );
	$converted = xxx;	// please write your proccess
	$this->set_item_by_key( 'content', $converted );
	return true;
}

} // class end
} // class_exists end
-----

2. exsapmple for plugin description in local language

htmlout/language/LOCAL_LANGUAGE_NAME/foobar.php
-----
// write in local language
$PLUGIN_DESCRIPTION = "xxx";
-----
