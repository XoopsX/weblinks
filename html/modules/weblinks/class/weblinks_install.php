<?php
// $Id: weblinks_install.php,v 1.2 2012/04/09 10:20:05 ohwada Exp $

// 2012-04-02 K.OHWADA
// _update_category_210()
// _update_link_210()
// _update_modify_210()

// 2008-12-07 K.OHWADA
// title in category, varchar(255) or varbinary(255)

// 2008-02-17 K.OHWADA
// pagerank, pagerank_update in link, modify
// title in category, varchar(50) -> varchar(255)

// 2007-12-02 K.OHWADA
// _update_linkitem_140()

// 2007-11-26 K.OHWADA
// BLOB and TEXT columns cannot have DEFAULT values.

//=========================================================
// WebLinks Module
// 2007-11-11 K.OHWADA
//=========================================================

if( ! class_exists('weblinks_install') ) 
{

//=========================================================
// class weblinks_install
//=========================================================
class weblinks_install extends happy_linux_module_install
{
	var $_DIRNAME;

	var $_linkitem_define;

	var $_linkitem_table;
	var $_category_table;
	var $_link_table;
	var $_modify_table;

	var $_DEBUG_TRACE = true;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function weblinks_install( $dirname )
{
	$this->_DIRNAME = $dirname;

	$this->happy_linux_module_install();
	$this->set_config_define_class( weblinks_config2_define::getInstance( $dirname ) );
	$this->set_config_table_name( $dirname.'_config2' );

	$this->_linkitem_define =& weblinks_linkitem_define::getInstance( $dirname );

	$this->_linkitem_table = $this->prefix( $dirname.'_linkitem' );
	$this->_category_table = $this->prefix( $dirname.'_category' );
	$this->_link_table     = $this->prefix( $dirname.'_link' );
	$this->_modify_table   = $this->prefix( $dirname.'_modify' );

}

function &getInstance( $dirname )
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new weblinks_install( $dirname );
	}
	return $instance;
}

//---------------------------------------------------------
// public
//---------------------------------------------------------
function check_install()
{
	if ( !$this->check_init_config() )
	{	return false;	}

	if ( !$this->_check_init_linkitem() )
	{	return false;	}

	return true;
}

function install()
{
	$this->init_config();
	$this->set_msg( $this->get_init_config_msg() );

	$this->_init_linkitem();
	$this->set_msg( $this->build_init_msg( $this->_linkitem_table ) );

	return $this->return_flag_error();
}

function check_update()
{
	if ( !$this->exists_config_table() ) {
		$this->_set_error( 'NOT config2 table' );
		return false;
	}

	if ( !$this->exists_table( $this->_linkitem_table ) ) {
		$this->_set_error( 'NOT linkitem table' );
		return false;
	}

	if ( !$this->_check_linkitem_140() ) {
		$this->_set_error( 'NOT linkitem 140' );
		return false;
	}

	if ( !$this->_check_update_linkitem() ) {
		$this->_set_error( 'NOT update linkitem' );
		return false;
	}

	if ( !$this->_check_config2_renew() ) {
		$this->_set_error( 'NOT renew config2' );
		return false;
	}

	if ( !$this->_check_linkitem_renew() ) {
		$this->_set_error( 'NOT nenew linkitem' );
		return false;
	}

	if ( !$this->_check_category_210() ) {
		$this->_set_error( 'NOT category 210' );
		return false;
	}

	if ( !$this->_check_category_190() ) {
		$this->_set_error( 'NOT category 190' );
		return false;
	}

	if ( !$this->_check_category_142() ) {
		$this->_set_error( 'NOT category 142' );
		return false;
	}

	if ( !$this->_check_category_141() ) {
		$this->_set_error( 'NOT category 141' );
		return false;
	}

	if ( !$this->_check_category_140() ) {
		$this->_set_error( 'NOT category 140' );
		return false;
	}

	if ( !$this->_check_link_210() ) {
		$this->_set_error( 'NOT link 210' );
		return false;
	}

	if ( !$this->_check_link_190() ) {
		$this->_set_error( 'NOT link 190' );
		return false;
	}

	if ( !$this->_check_link_142() ) {
		$this->_set_error( 'NOT link 142' );
		return false;
	}

	if ( !$this->_check_link_141() ) {
		$this->_set_error( 'NOT link 141' );
		return false;
	}

	if ( !$this->_check_link_140() ) {
		$this->_set_error( 'NOT link 140' );
		return false;
	}

	if ( !$this->_check_link_130() ) {
		$this->_set_error( 'NOT link 130' );
		return false;
	}

	if ( !$this->_check_link_120() ) {
		$this->_set_error( 'NOT link 120' );
		return false;
	}

	if ( !$this->_check_link_110() ) {
		$this->_set_error( 'NOT link 110' );
		return false;
	}

	if ( !$this->_check_modify_210() ) {
		$this->_set_error( 'NOT modify 210' );
		return false;
	}

	if ( !$this->_check_modify_190() ) {
		$this->_set_error( 'NOT modify 190' );
		return false;
	}

	if ( !$this->_check_modify_142() ) {
		$this->_set_error( 'NOT modify 142' );
		return false;
	}

	if ( !$this->_check_modify_141() ) {
		$this->_set_error( 'NOT modify 141' );
		return false;
	}

	if ( !$this->_check_modify_140() ) {
		$this->_set_error( 'NOT modify 140' );
		return false;
	}

	if ( !$this->_check_modify_130() ) {
		$this->_set_error( 'NOT modify 130' );
		return false;
	}

	if ( !$this->_check_modify_120() ) {
		$this->_set_error( 'NOT modify 120' );
		return false;
	}

	if ( !$this->_check_modify_110() ) {
		$this->_set_error( 'NOT modify 110' );
		return false;
	}

	if ( !$this->check_update_config() ) {
		$this->_set_error( 'NOT update config2' );
		return false;
	}

	return true;
}

function update()
{
	if ( !$this->exists_config_table() )
	{
		$this->clear_error();
		$this->create_config_table();
		$this->set_msg( $this->build_create_config_msg() );
	}

	if ( !$this->exists_table( $this->_linkitem_table ) )
	{
		$this->clear_error();
		$this->_create_linkitem_table();
		$this->set_msg( $this->build_create_msg( $this->_linkitem_table ) );
	}

	$this->check_and_update_table( 'linkitem', '140' );

	if ( !$this->_check_config2_renew() )
	{
		$this->clear_error();
		$this->truncate_table( $this->_config_table );
		$this->set_msg( $this->build_update_msg( $this->_config_table ) );
	}

	if ( !$this->_check_linkitem_renew() )
	{
		$this->clear_error();
		$this->truncate_table( $this->_linkitem_table );
		$this->set_msg( $this->build_update_msg( $this->_linkitem_table ) );
	}

	$this->check_and_update_table( 'category', '210' );
	$this->check_and_update_table( 'category', '140' );
	$this->check_and_update_table( 'category', '141' );
	$this->check_and_update_table( 'category', '142' );
	$this->check_and_update_table( 'category', '190' );

	$this->check_and_update_table( 'link', '210' );
	$this->check_and_update_table( 'link', '110' );
	$this->check_and_update_table( 'link', '120' );
	$this->check_and_update_table( 'link', '130' );
	$this->check_and_update_table( 'link', '140' );
	$this->check_and_update_table( 'link', '141' );
	$this->check_and_update_table( 'link', '142' );
	$this->check_and_update_table( 'link', '190' );

	$this->check_and_update_table( 'modify', '210' );
	$this->check_and_update_table( 'modify', '110' );
	$this->check_and_update_table( 'modify', '120' );
	$this->check_and_update_table( 'modify', '130' );
	$this->check_and_update_table( 'modify', '140' );
	$this->check_and_update_table( 'modify', '141' );
	$this->check_and_update_table( 'modify', '142' );
	$this->check_and_update_table( 'modify', '190' );

	$this->update_config();
	$this->set_msg( $this->get_update_config_msg() );

	$this->_update_linkitem();
	$this->set_msg( $this->build_update_msg( $this->_linkitem_table, $this->_count_insert ) );

	$this->clear_all_template();
	$this->set_msg( $this->build_tpl_msg() );

	return $this->return_flag_error();
}

//---------------------------------------------------------
// config table
//---------------------------------------------------------
function _check_config2_renew()
{
	$name_arr = array( 
		'cat_path'	// v1.40
	);
	return $this->exists_config_item_by_name_array( $name_arr );
}

//---------------------------------------------------------
// linkitem table
//---------------------------------------------------------
function _create_linkitem_table()
{
$sql = "
CREATE TABLE ".$this->_linkitem_table." (
  id      smallint(5) unsigned NOT NULL auto_increment,
  item_id smallint(5) unsigned NOT NULL default 0,
  name      varchar(255) NOT NULL default '',
  title     varchar(255) NOT NULL default '',
  user_mode int(5) default '0',
  aux_int_1 int(5) default '0',
  aux_int_2 int(5) default '0',
  aux_text_1 varchar(255) default '',
  aux_text_2 varchar(255) default '',
  description text NOT NULL,
  PRIMARY KEY (id),
  KEY item_id (item_id)
) TYPE=MyISAM
";

	return $this->query($sql);
}

function _check_init_linkitem()
{
	$sql = 'SELECT count(*) FROM '. $this->_linkitem_table;
	return $this->get_count_by_sql( $sql );
}

function _check_update_linkitem()
{
	$linkitem_arr =& $this->_get_linkitem_name_array();

	foreach ( $this->_linkitem_define->get_define() as $def ) 
	{
		if ( !in_array( $def['name'], $linkitem_arr ) )
		{	return false;	}
	}
	return true;
}

function &_get_linkitem_name_array()
{
	$arr = array();

	$sql = 'SELECT * FROM '.$this->_linkitem_table.' ORDER BY item_id ASC';
	$rows =& $this->get_rows_by_sql($sql);

	if ( is_array($rows) && ( count($rows) > 0 ) )
	{
		foreach ( $rows as $row ) 
		{
			$arr[] = $row['name'];
		}
	}

	return $arr;
}

function _init_linkitem()
{
	$this->clear_error();
	$this->_count_insert = 0;
	$define_arr = $this->_linkitem_define->get_define();

// list from Define
	foreach ($define_arr as $id => $def) 
	{
// insert, when not in MySQL
		$this->_insert_linkitem_by_def( $id, $def );
		$this->_count_insert ++;
	}

	return $this->return_errors();
}

function _update_linkitem()
{
	$this->clear_error();
	$this->_count_insert = 0;
	$define_arr = $this->_linkitem_define->get_define();

// list from Define
	foreach ($define_arr as $id => $def) 
	{
// if exist
		if ( $this->_get_linkitem_count_by_itemid( $id ) )
		{	continue;	}

// insert, when not in MySQL
		$this->_insert_linkitem_by_def( $id, $def );
		$this->_count_insert ++;
	}

	return $this->return_errors();
}

function _insert_linkitem_by_def( $id, &$def )
{
	return $this->_insert_linkitem( $this->_build_linkitem_insert_row( $id, $def ) );
}

function &_build_linkitem_insert_row( $item_id, &$def )
{
//print_r( $def );

	$name = $def['name'];

	$title = '';
	if ( isset($def['title']) )
	{
		$title = $def['title'];
	}

	$user_mode = '';
	if ( isset($def['user_mode']) )
	{
		$user_mode = $def['user_mode'];
	}

	$description = '';
	if ( isset($def['description']) )
	{
		$description = $def['description'];
	}

	$row = array(
		'item_id'     => $item_id,
		'name'        => $name,
		'title'       => $title,
		'user_mode'   => $user_mode,
		'description' => $description,
	);
	
	return $row;
}

function _insert_linkitem( &$row )
{
	return $this->query( $this->_build_insert_linkitem_sql( $row ) );
}

function _build_insert_linkitem_sql( &$row )
{
	$aux_int_1  = 0;
	$aux_int_2  = 0;
	$aux_text_1 = '';
	$aux_text_2 = '';

	foreach ($row as $k => $v) 
	{	${$k} = $v;	}

	$sql  = 'INSERT INTO '.$this->_linkitem_table.' (';
	$sql .= 'item_id, ';
	$sql .= 'name, ';
	$sql .= 'title, ';
	$sql .= 'user_mode, ';
	$sql .= 'description, ';
	$sql .= 'aux_int_1, ';
	$sql .= 'aux_int_2, ';
	$sql .= 'aux_text_1, ';
	$sql .= 'aux_text_2 ';
	$sql .= ') VALUES (';
	$sql .= intval($item_id).', ';
	$sql .= $this->quote($name).', ';
	$sql .= $this->quote($title).', ';
	$sql .= intval($user_mode).', ';
	$sql .= $this->quote($description).', ';
	$sql .= intval($aux_int_1).', ';
	$sql .= intval($aux_int_2).', ';
	$sql .= $this->quote($aux_text_1).', ';
	$sql .= $this->quote($aux_text_2).' ';
	$sql .= ')';

	return $sql;
}

function _get_linkitem_count_by_itemid( $id )
{
	$sql = 'SELECT count(*) FROM '. $this->_linkitem_table .' WHERE item_id='.intval( $id );
	return $this->get_count_by_sql( $sql );
}

function _get_linkitem_count_by_name( $name )
{
	$sql = 'SELECT count(*) FROM '. $this->_linkitem_table .' WHERE name='.$this->quote($name);
	return $this->get_count_by_sql( $sql );
}

function _check_linkitem_renew()
{
	$name_arr = array(
		'map_use',	// 1.20
		'forum_id',	// 1.40.2
		'renew_1'	// 1.60
	);
	return $this->_exists_linkitem_item_by_name_array( $name_arr );
}

function _exists_linkitem_item_by_name_array( &$name_arr )
{
	foreach ( $name_arr as $name )
	{
		$count = $this->_get_linkitem_count_by_name( $name );
		if ( $count == 0 )
		{	return false;	}
	}
	return true;
}

function _check_linkitem_140()
{
	return $this->exists_column( $this->_linkitem_table, 'description' );
}

function _update_linkitem_140()
{
$sql = "
  ALTER TABLE ". $this->_linkitem_table ." ADD COLUMN (
  description text default NULL
)";
	return $this->query($sql);
}

//---------------------------------------------------------
// category table
//---------------------------------------------------------
function _check_category_210()
{
	return $this->exists_column( $this->_category_table, 'gm_icon' );
}

function _check_category_190()
{
	return $this->preg_match_column_type_array( 
		$this->_category_table, 'title', array('varchar(255)', 'varbinary(255)') );
}

function _check_category_142()
{
	return $this->exists_column( $this->_category_table, 'gm_type' );
}

function _check_category_141()
{
	return $this->exists_column( $this->_category_table, 'album_id' );
}

function _check_category_140()
{
	return $this->exists_column( $this->_category_table, 'forum_id' );
}

function _update_category_210()
{
$sql = "
  ALTER TABLE ".$this->_category_table." ADD COLUMN (
  gm_icon     int(5) default '0',
  gm_location varchar(255) default ''
)";

	return $this->query($sql);
}

function _update_category_190()
{
$sql = "
  ALTER TABLE ".$this->_category_table." MODIFY
  title  varchar(255) NOT NULL default ''
";

	return $this->query($sql);
}

function _update_category_142()
{
$sql = "
  ALTER TABLE ".$this->_category_table." ADD COLUMN (
  gm_type  tinyint(2) NOT NULL default '0',
  dohtml   tinyint(1) NOT NULL default '0',
  dosmiley tinyint(1) NOT NULL default '1',
  doxcode  tinyint(1) NOT NULL default '1',
  doimage  tinyint(1) NOT NULL default '1',
  dobr     tinyint(1) NOT NULL default '1'
)";

	return $this->query($sql);
}

function _update_category_141()
{
$sql = "
  ALTER TABLE ".$this->_category_table." ADD COLUMN (
  album_id     int(5) default '0',
  img_orig_width  int(10) unsigned NOT NULL default '0',
  img_orig_height int(10) unsigned NOT NULL default '0',
  img_show_width  int(10) unsigned NOT NULL default '0',
  img_show_height int(10) unsigned NOT NULL default '0',
  gm_mode      tinyint(2) NOT NULL default '0',
  gm_latitude  double(10,8) NOT NULL default '0',
  gm_longitude double(11,8) NOT NULL default '0',
  gm_zoom      tinyint(2) NOT NULL default '0'
)";

	return $this->query($sql);
}

function _update_category_140()
{
$sql = "
  ALTER TABLE ".$this->_category_table." ADD COLUMN (
  forum_id    int(5) default '0',
  tree_order  int(5) default '0',
  cids_parent text NOT NULL,
  cids_child  text NOT NULL,
  link_count  int(5)  default '0',
  link_update int(10) default '0',
  aux_int_1 int(5) default '0',
  aux_int_2 int(5) default '0',
  aux_text_1 varchar(255) default '',
  aux_text_2 varchar(255) default ''
)";

	return $this->query($sql);
}

//---------------------------------------------------------
// link table
//---------------------------------------------------------
function _check_link_210()
{
	return $this->exists_column( $this->_link_table, 'gm_icon' );
}

function _check_link_190()
{
	return $this->exists_column( $this->_link_table, 'pagerank' );
}

function _check_link_142()
{
	return $this->exists_column( $this->_link_table, 'gm_type' );
}

function _check_link_141()
{
	return $this->exists_column( $this->_link_table, 'album_id' );
}

function _check_link_140()
{
	return $this->exists_column( $this->_link_table, 'forum_id' );
}

function _check_link_130()
{
	return $this->exists_column( $this->_link_table, 'time_publish' );
}

function _check_link_120()
{
	return $this->exists_column( $this->_link_table, 'map_use' );
}

function _check_link_110()
{
	return $this->exists_column( $this->_link_table, 'dohtml' );
}

function _update_link_210()
{
$sql1 = "
  ALTER TABLE ".$this->_link_table." ADD COLUMN (
  gm_icon int(5) default '0'
)";
	$ret1 = $this->query($sql1);

$sql2 = "
  ALTER TABLE ".$this->_link_table." MODIFY
    url text NOT NULL
";
	$ret2 = $this->query($sql2);

	return ($ret1 && $ret2);
}

function _update_link_190()
{
$sql = "
  ALTER TABLE ".$this->_link_table." ADD COLUMN (
  pagerank        tinyint(2) NOT NULL default '0',
  pagerank_update int(5) default '0'
)";

	return $this->query($sql);
}

function _update_link_142()
{
$sql = "
  ALTER TABLE ".$this->_link_table." ADD COLUMN (
  gm_type  tinyint(2) default '0'
)";

	return $this->query($sql);
}

function _update_link_141()
{
$sql = "
  ALTER TABLE ".$this->_link_table." ADD COLUMN (
  album_id     int(5) default '0'
)";

	return $this->query($sql);
}

function _update_link_140()
{
$sql = "
  ALTER TABLE ".$this->_link_table." ADD COLUMN (
  forum_id  int(5) default '0',
  comment_use tinyint(1) default '1'
)";

	return $this->query($sql);
}

function _update_link_130()
{
$sql = "
  ALTER TABLE ".$this->_link_table." ADD COLUMN (
  time_publish int(10) NOT NULL default '0',
  time_expire  int(10) NOT NULL default '0',
  textarea1 text NOT NULL,
  textarea2 text NOT NULL,
  dohtml1   tinyint(1) NOT NULL default '0',
  dosmiley1 tinyint(1) NOT NULL default '1',
  doxcode1  tinyint(1) NOT NULL default '1',
  doimage1  tinyint(1) NOT NULL default '1',
  dobr1     tinyint(1) NOT NULL default '1'
)";

	return $this->query($sql);
}

function _update_link_120()
{
$sql = "
  ALTER TABLE ".$this->_link_table." ADD COLUMN (
  map_use  tinyint(2)       NOT NULL default '1',
  rssc_lid int(11) unsigned NOT NULL default '0',
  gm_latitude  double(10,8) NOT NULL default '0',
  gm_longitude double(11,8) NOT NULL default '0',
  gm_zoom      tinyint(2)   NOT NULL default '0',
  aux_int_1 int(5) default '0',
  aux_int_2 int(5) default '0',
  aux_text_1 varchar(255) default '',
  aux_text_2 varchar(255) default ''
)";

	return $this->query($sql);
	return $ret;
}

function _update_link_110()
{
$sql1 = "
  ALTER TABLE ".$this->_link_table." ADD COLUMN (
  dohtml   tinyint(1) NOT NULL default 0,
  dosmiley tinyint(1) NOT NULL default 1,
  doxcode  tinyint(1) NOT NULL default 1,
  doimage  tinyint(1) NOT NULL default 1,
  dobr     tinyint(1) NOT NULL default 1,
  etc1 varchar(255) default NULL,
  etc2 varchar(255) default NULL,
  etc3 varchar(255) default NULL,
  etc4 varchar(255) default NULL,
  etc5 varchar(255) default NULL
)";

	$ret1 = $this->query($sql1);

	$sql2 = "ALTER TABLE ".$this->_link_table." MODIFY cids varchar(255) default NULL ";
	$ret2 = $this->query($sql2);

	$sql3 = "ALTER TABLE ".$this->_link_table." MODIFY title varchar(255) NOT NULL default '' ";
	$ret3 = $this->query($sql3);

	$sql4 = "ALTER TABLE ".$this->_link_table." MODIFY zip varchar(255) default NULL ";
	$ret4 = $this->query($sql4);

	$sql5 = "ALTER TABLE ".$this->_link_table." MODIFY state varchar(255) default NULL ";
	$ret5 = $this->query($sql5);

	$sql6 = "ALTER TABLE ".$this->_link_table." MODIFY city varchar(255) default NULL ";
	$ret6 = $this->query($sql6);

	if ( $ret1 && $ret2 && $ret3 && $ret4 && $ret5 && $ret6 )
	{
		return true;
	}

	return false;
}

//---------------------------------------------------------
// modify table
//---------------------------------------------------------
function _check_modify_210()
{
	return $this->exists_column( $this->_modify_table, 'gm_icon' );
} 

function _check_modify_190()
{
	return $this->exists_column( $this->_modify_table, 'pagerank' );
} 

function _check_modify_142()
{
	return $this->exists_column( $this->_modify_table, 'gm_type' );
}

function _check_modify_141()
{
	return $this->exists_column( $this->_modify_table, 'album_id' );
}

function _check_modify_140()
{
	return $this->exists_column( $this->_modify_table, 'forum_id' );
}

function _check_modify_130()
{
	return $this->exists_column( $this->_modify_table, 'time_publish' );
}

function _check_modify_120()
{
	return $this->exists_column( $this->_modify_table, 'map_use' );
}

function _check_modify_110()
{
	return $this->exists_column( $this->_modify_table, 'dohtml' );
}

function _update_modify_210()
{
$sql1 = "
  ALTER TABLE ".$this->_modify_table." ADD COLUMN (
  gm_icon int(5) default '0'
)";
	$ret1 = $this->query($sql1);

$sql2 = "
  ALTER TABLE ".$this->_modify_table." MODIFY
    url text NOT NULL
";
	$ret2 = $this->query($sql2);
	return ($ret1 && $ret2);
}

function _update_modify_190()
{
$sql = "
  ALTER TABLE ".$this->_modify_table." ADD COLUMN (
  pagerank        tinyint(2) NOT NULL default '0',
  pagerank_update int(5) default '0'
)";

	return $this->query($sql);
}

function _update_modify_142()
{
$sql = "
  ALTER TABLE ".$this->_modify_table." ADD COLUMN (
  gm_type  tinyint(2) default '0'
)";

	return $this->query($sql);
}

function _update_modify_141()
{
$sql = "
  ALTER TABLE ".$this->_modify_table." ADD COLUMN (
  album_id     int(5) default '0'
)";

	return $this->query($sql);
}

function _update_modify_140()
{
$sql = "
  ALTER TABLE ".$this->_modify_table." ADD COLUMN (
  forum_id  int(5) default '0',
  comment_use tinyint(1) default '1'
)";

	return $this->query($sql);
}

function _update_modify_130()
{
$sql = "
  ALTER TABLE ".$this->_modify_table." ADD COLUMN (
  time_publish int(10) NOT NULL default '0',
  time_expire  int(10) NOT NULL default '0',
  textarea1 text NOT NULL,
  textarea2 text NOT NULL,
  dohtml1   tinyint(1) NOT NULL default '0',
  dosmiley1 tinyint(1) NOT NULL default '1',
  doxcode1  tinyint(1) NOT NULL default '1',
  doimage1  tinyint(1) NOT NULL default '1',
  dobr1     tinyint(1) NOT NULL default '1'
)";

	return $this->query($sql);
}

function _update_modify_120()
{
$sql = "
  ALTER TABLE ".$this->_modify_table." ADD COLUMN (
  map_use  tinyint(2)       NOT NULL default '1',
  rssc_lid int(11) unsigned NOT NULL default '0',
  gm_latitude  double(10,8) NOT NULL default '0',
  gm_longitude double(11,8) NOT NULL default '0',
  gm_zoom      tinyint(2)   NOT NULL default '0',
  aux_int_1 int(5) default '0',
  aux_int_2 int(5) default '0',
  aux_text_1 varchar(255) default '',
  aux_text_2 varchar(255) default ''
)";

	return $this->query($sql);
}

function _update_modify_110()
{
$sql1 = "
  ALTER TABLE ".$this->_modify_table." ADD COLUMN (
  dohtml   tinyint(1) NOT NULL default 0,
  dosmiley tinyint(1) NOT NULL default 1,
  doxcode  tinyint(1) NOT NULL default 1,
  doimage  tinyint(1) NOT NULL default 1,
  dobr     tinyint(1) NOT NULL default 1,
  etc1 varchar(255) default NULL,
  etc2 varchar(255) default NULL,
  etc3 varchar(255) default NULL,
  etc4 varchar(255) default NULL,
  etc5 varchar(255) default NULL,
  notify   tinyint(1) NOT NULL default 0
)";

	$ret1 = $this->query($sql1);

	$sql2 = "ALTER TABLE ".$this->_modify_table." MODIFY cids varchar(255) default NULL ";
	$ret2 = $this->query($sql2);

	$sql3 = "ALTER TABLE ".$this->_modify_table." MODIFY title varchar(255) NOT NULL default '' ";
	$ret3 = $this->query($sql3);

	$sql4 = "ALTER TABLE ".$this->_modify_table." MODIFY zip varchar(255) default NULL ";
	$ret4 = $this->query($sql4);

	$sql5 = "ALTER TABLE ".$this->_modify_table." MODIFY state varchar(255) default NULL ";
	$ret5 = $this->query($sql5);

	$sql6 = "ALTER TABLE ".$this->_modify_table." MODIFY city varchar(255) default NULL ";
	$ret6 = $this->query($sql6);

	if ( $ret1 && $ret2 && $ret3 && $ret4 && $ret5 && $ret6 )
	{
		return true;
	}

	return false;
}

//---------------------------------------------------------
// template
//---------------------------------------------------------
function clear_all_template()
{
	$dir_tpl = XOOPS_ROOT_PATH .'/modules/'. $this->_DIRNAME .'/templates';

	$this->clear_error();

	$this->clear_compiled_tpl_by_dir( $dir_tpl .'/parts' );
	$this->clear_compiled_tpl_by_dir( $dir_tpl .'/xml' );
	$this->clear_compiled_tpl_by_dir( $dir_tpl .'/map' );
//	$this->clear_compiled_tpl_by_dir( $dir_tpl .'/customs' );

	return $this->return_errors();
}

// --- class end ---
}

// === class end ===
}

?>