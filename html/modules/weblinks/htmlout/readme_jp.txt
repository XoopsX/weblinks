$Id: readme_jp.txt,v 1.1 2011/12/29 14:32:32 ohwada Exp $

=================================================
HTML出力プラグインの作り方
=================================================

プラグイン名を "foobar" とします

1. プラグインの記述例

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
	// ここは英語の説明文
	return "this is foobar description";
}

function execute_plugin()
{
	$content = $this->get_item_by_key( 'content' );
	$converted = xxx;	// ここに変換処理を書く
	$this->set_item_by_key( 'content', $converted );
	return true;
}

} // class の終わり
} // class_exists の終わり
-----

2. 日本語の説明文の記述例

htmlout/language/japanese/foobar.php
-----
$PLUGIN_DESCRIPTION = "これは foobar の説明文です";
-----
