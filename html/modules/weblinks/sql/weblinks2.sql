# $Id: weblinks2.sql,v 1.3 2012/04/09 10:20:06 ohwada Exp $

# 2012-04-02 K.OHWADA
# link modify
#  gm_icon
#  url varchar -> text
# category 
#  gm_icon gm_location 

# 2011-12-29 K.OHWADA
# TYPE=MyISAM -> ENGINE=MyISAM

# 2008-02-17 K.OHWADA
# pagerank, pagerank_update in link, modify
# title in category, varchar(50) -> varchar(255)

# 2007-11-26 K.OHWADA
# BLOB and TEXT columns cannot have DEFAULT values.

# 2007-04-08 K.OHWADA
# gm_type dohtml etc in category
# gm_type in link, modify

# 2007-03-25 K.OHWADA
# album_id img_orig_width gm_latitude etc in category
# album_id in link, modify

# 2007-02-20 K.OHWADA
# forum_id tree_order etc in category
# forum_id in link, modify
# description in linkitem

# 2006-12-10 K.OHWADA
# add time_publish textarea1

# 2006-10-01 K.OHWADA
# use RSSC
# add rssc_lid
# google map

# 2006-06-09 K.OHWADA
# BUG 4029: mistake table name 
# change confitem to linkitem

# 2006-05-15 K.OHWADA
# add table config2 confitem

# 2006-01-01 K.OHWADA
# weblinks ver 1.0
# module depulication

#=========================================================
# SQL: create table
# 2004/01/23 K.OHWADA
#=========================================================

#
# Table structure for table `weblinks_category`
#

CREATE TABLE weblinks_category (
  cid int(5) unsigned NOT NULL auto_increment,
  pid int(5) unsigned NOT NULL default '0',
  title  varchar(255) NOT NULL default '',
  imgurl varchar(255) NOT NULL default '',
  cflag tinyint(2) NOT NULL default '0',
  lflag tinyint(2) NOT NULL default '0',
  tflag tinyint(2) NOT NULL default '0',
  displayimg int(10) NOT NULL default '0',
  description text NOT NULL,
  catdescription text NOT NULL,
  catfooter text NOT NULL,
  groupid varchar(255) default NULL,
  orders int(4) NOT NULL default '1',
  editaccess varchar(255) NOT NULL default '1 2 3',
  forum_id    int(5) default '0',
  tree_order  int(5) default '0',
  cids_parent text NOT NULL,
  cids_child  text NOT NULL,
  link_count  int(5)  default '0',
  link_update int(10) default '0',
  aux_int_1 int(5) default '0',
  aux_int_2 int(5) default '0',
  aux_text_1 varchar(255) default '',
  aux_text_2 varchar(255) default '',
  album_id     int(5) default '0',
  img_orig_width  int(10) unsigned NOT NULL default '0',
  img_orig_height int(10) unsigned NOT NULL default '0',
  img_show_width  int(10) unsigned NOT NULL default '0',
  img_show_height int(10) unsigned NOT NULL default '0',
  gm_mode      tinyint(2) NOT NULL default '0',
  gm_latitude  double(10,8) NOT NULL default '0',
  gm_longitude double(11,8) NOT NULL default '0',
  gm_zoom      tinyint(2) NOT NULL default '0',
  gm_type      tinyint(2) NOT NULL default '0',
  dohtml   tinyint(1) NOT NULL default '0',
  dosmiley tinyint(1) NOT NULL default '1',
  doxcode  tinyint(1) NOT NULL default '1',
  doimage  tinyint(1) NOT NULL default '1',
  dobr     tinyint(1) NOT NULL default '1',
  gm_icon     int(5) default '0',
  gm_location varchar(255) default '',
  PRIMARY KEY  (cid),
  KEY pid (pid),
  KEY orders (orders),
  KEY tree_order (tree_order),
  KEY title (title(10))
) ENGINE=MyISAM;

#
# Table structure for table `weblinks_link`
# add width, height
#

CREATE TABLE weblinks_link (
  lid int(11) unsigned NOT NULL auto_increment,
  uid int(5) unsigned NOT NULL default '0',
  cids   varchar(255) default NULL,
  title  varchar(255) NOT NULL default '',
  url text NOT NULL,
  banner varchar(255) NOT NULL default '',
  description text NOT NULL,
  name varchar(255) default NULL,
  nameflag tinyint(2) NOT NULL default '0',
  mail varchar(255) default NULL,
  mailflag tinyint(2) NOT NULL default '0',
  company varchar(255) default NULL,
  addr varchar(255) default NULL,
  tel varchar(255) default NULL,
  search text NOT NULL,
  passwd varchar(255) default NULL,
  admincomment text NOT NULL,
  mark char(3) default NULL,
  time_create int(10) NOT NULL default '0',
  time_update int(10) NOT NULL default '0',
  hits int(11) unsigned NOT NULL default '0',
  rating double(6,4) NOT NULL default '0.0000',
  votes int(11) unsigned NOT NULL default '0',
  comments int(11) unsigned NOT NULL default '0',
  width  int(5) unsigned NOT NULL default '0',
  height int(5) unsigned NOT NULL default '0',
  recommend tinyint(2) NOT NULL default '0',
  mutual    tinyint(2) NOT NULL default '0',
  broken int(11) unsigned NOT NULL default '0',
  rss_url  varchar(255) NOT NULL default '',
  rss_flag tinyint(3) NOT NULL default '0',
  rss_xml  mediumtext NOT NULL,
  rss_update int(10) NOT NULL default'0',
  usercomment text NOT NULL,
  zip    varchar(255) default NULL,
  state  varchar(255) default NULL,
  city   varchar(255) default NULL,
  addr2  varchar(255) default NULL,
  fax    varchar(255) default NULL,
  dohtml   tinyint(1) NOT NULL default '0',
  dosmiley tinyint(1) NOT NULL default '1',
  doxcode  tinyint(1) NOT NULL default '1',
  doimage  tinyint(1) NOT NULL default '1',
  dobr     tinyint(1) NOT NULL default '1',
  etc1   varchar(255) default NULL,
  etc2   varchar(255) default NULL,
  etc3   varchar(255) default NULL,
  etc4   varchar(255) default NULL,
  etc5   varchar(255) default NULL,
  map_use  tinyint(2)       NOT NULL default '1',
  rssc_lid int(11) unsigned NOT NULL default '0',
  gm_latitude  double(10,8) NOT NULL default '0',
  gm_longitude double(11,8) NOT NULL default '0',
  gm_zoom      tinyint(2) NOT NULL default '0',
  aux_int_1 int(5) default '0',
  aux_int_2 int(5) default '0',
  aux_text_1 varchar(255) default '',
  aux_text_2 varchar(255) default '',
  time_publish int(10) NOT NULL default '0',
  time_expire  int(10) NOT NULL default '0',
  textarea1 text NOT NULL,
  textarea2 text NOT NULL,
  dohtml1   tinyint(1) NOT NULL default '0',
  dosmiley1 tinyint(1) NOT NULL default '1',
  doxcode1  tinyint(1) NOT NULL default '1',
  doimage1  tinyint(1) NOT NULL default '1',
  dobr1     tinyint(1) NOT NULL default '1',
  forum_id  int(5) default '0',
  comment_use tinyint(1) default '1',
  album_id     int(5) default '0',
  gm_type      tinyint(2) NOT NULL default '0',
  pagerank     tinyint(2) NOT NULL default '0',
  pagerank_update int(5) default '0',
  gm_icon  int(5) default '0',
  PRIMARY KEY  (lid),
  KEY uid (uid),
  KEY cids (cids),
  KEY title (title(40)),
  KEY url (url(10)),
  KEY recommend (recommend),
  KEY mutual (mutual),
  KEY rssc_lid (rssc_lid),
  KEY exclude (broken, time_publish, time_expire)
) ENGINE=MyISAM;

#
# Table structure for table `weblinks_modify`
# same as weblinks_link
#

CREATE TABLE weblinks_modify (
  mid int(11) unsigned NOT NULL auto_increment,
  mode tinyint(2) NOT NULL default '0',
  muid int(11) unsigned NOT NULL default '0',
  lid int(11) unsigned NOT NULL default '0',
  uid int(5) unsigned NOT NULL default '0',
  cids   varchar(255) default NULL,
  title  varchar(255) NOT NULL default '',
  url text NOT NULL,
  banner varchar(255) NOT NULL default '',
  description text NOT NULL,
  name varchar(255) default NULL,
  nameflag tinyint(2) NOT NULL default '0',
  mail varchar(255) default NULL,
  mailflag tinyint(2) NOT NULL default '0',
  company varchar(255) default NULL,
  addr varchar(255) default NULL,
  tel varchar(255) default NULL,
  search text NOT NULL,
  passwd varchar(255) default NULL,
  admincomment text NOT NULL,
  mark char(3) default NULL,
  time_create int(10) NOT NULL default '0',
  time_update int(10) NOT NULL default '0',
  hits int(11) unsigned NOT NULL default '0',
  rating double(6,4) NOT NULL default '0.0000',
  votes int(11) unsigned NOT NULL default '0',
  comments int(11) unsigned NOT NULL default '0',
  recommend tinyint(2) NOT NULL default '0',
  mutual    tinyint(2) NOT NULL default '0',
  broken int(11) unsigned NOT NULL default '0',
  rss_url  varchar(255) NOT NULL default '',
  rss_flag tinyint(3) NOT NULL default '0',
  rss_xml  mediumtext NOT NULL, 
  rss_update int(10) NOT NULL default'0',
  usercomment text NOT NULL,
  zip    varchar(255) default NULL,
  state  varchar(255) default NULL,
  city   varchar(255) default NULL,
  addr2  varchar(255) default NULL,
  fax    varchar(255) default NULL,
  dohtml   tinyint(1) NOT NULL default '0',
  dosmiley tinyint(1) NOT NULL default '1',
  doxcode  tinyint(1) NOT NULL default '1',
  doimage  tinyint(1) NOT NULL default '1',
  dobr     tinyint(1) NOT NULL default '1',
  etc1   varchar(255) default NULL,
  etc2   varchar(255) default NULL,
  etc3   varchar(255) default NULL,
  etc4   varchar(255) default NULL,
  etc5   varchar(255) default NULL,
  notify   tinyint(1) NOT NULL default 0,
  rssc_lid int(11) unsigned NOT NULL default '0',
  map_use      tinyint(2) NOT NULL default '0',
  gm_latitude  double(10,8) NOT NULL default '0',
  gm_longitude double(11,8) NOT NULL default '0',
  gm_zoom      tinyint(2) NOT NULL default '0',
  aux_int_1 int(5) default '0',
  aux_int_2 int(5) default '0',
  aux_text_1 varchar(255) default '',
  aux_text_2 varchar(255) default '',
  time_publish int(10) NOT NULL default '0',
  time_expire  int(10) NOT NULL default '0',
  textarea1 text NOT NULL,
  textarea2 text NOT NULL,
  dohtml1   tinyint(1) NOT NULL default '0',
  dosmiley1 tinyint(1) NOT NULL default '1',
  doxcode1  tinyint(1) NOT NULL default '1',
  doimage1  tinyint(1) NOT NULL default '1',
  dobr1     tinyint(1) NOT NULL default '1',
  forum_id  int(5) default '0',
  comment_use tinyint(1) default '1',
  album_id     int(5) default '0',
  gm_type      tinyint(2) NOT NULL default '0',
  pagerank     tinyint(2) NOT NULL default '0',
  pagerank_update int(5) default '0',
  gm_icon  int(5) default '0',
  PRIMARY KEY  (mid)
) ENGINE=MyISAM;

#
# Table structure for table `weblinks_catlink`
#

CREATE TABLE weblinks_catlink (
  jid int(11) unsigned NOT NULL auto_increment,
  cid int(4)  unsigned NOT NULL default '0',
  lid int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (jid),
  KEY lid (lid),
  KEY cid (cid)
) ENGINE=MyISAM;

#
# Table structure for table `weblinks_broken`
# same column as `mylinks_broken`
#

CREATE TABLE weblinks_broken (
  bid int(5) NOT NULL auto_increment,
  lid int(11) unsigned NOT NULL default '0',
  sender int(11) unsigned NOT NULL default '0',
  ip varchar(20) NOT NULL default '',
  PRIMARY KEY  (bid),
  KEY lid (lid),
  KEY sender (sender),
  KEY ip (ip)
) ENGINE=MyISAM;

#
# Table structure for table `weblinks_votedata`
# same as `mylinks_votedata`
#

CREATE TABLE weblinks_votedata (
  ratingid int(11) unsigned NOT NULL auto_increment,
  lid int(11) unsigned NOT NULL default '0',
  ratinguser int(11) unsigned NOT NULL default '0',
  rating tinyint(3) unsigned NOT NULL default '0',
  ratinghostname varchar(60) NOT NULL default '',
  ratingtimestamp int(10) NOT NULL default '0',
  PRIMARY KEY  (ratingid),
  KEY ratinguser (ratinguser),
  KEY ratinghostname (ratinghostname)
) ENGINE=MyISAM;

#
# Table structure for table `weblinks_atomfeed`
#

CREATE TABLE weblinks_atomfeed (
  aid int(11) unsigned NOT NULL auto_increment,
  lid int(11) unsigned NOT NULL default '0',
  site_title varchar(100) NOT NULL default '',
  site_url   varchar(255) NOT NULL default '',
  title varchar(100) NOT NULL default '',
  url   varchar(255) NOT NULL default '',
  entry_id   varchar(255) NOT NULL default '',
  guid       varchar(255) NOT NULL default '',
  time_modified int(10) NOT NULL default '0',
  time_issued   int(10) NOT NULL default '0',
  time_created  int(10) NOT NULL default '0',
  author_name  varchar(100) NOT NULL default '',
  author_url   varchar(255) NOT NULL default '',
  author_email varchar(255) default NULL,
  content text NOT NULL,
  PRIMARY KEY  (aid),
  KEY url (url),
  KEY modified (time_modified)
) ENGINE=MyISAM;

#
# Table structure for table `weblinks_config`
#

CREATE TABLE weblinks_config (
  auth_submit      varchar(255) NOT NULL default '',
  auth_submit_auto varchar(255) NOT NULL default '',
  auth_modify      varchar(255) NOT NULL default '',
  auth_modify_auto varchar(255) NOT NULL default '',
  auth_ratelink    varchar(255) NOT NULL default '',
  use_passwd     tinyint(2) unsigned NOT NULL default '0',
  use_ratelink   tinyint(2) unsigned NOT NULL default '0',
  rss_mode_auto    tinyint(2) unsigned NOT NULL default '0',
  rss_mode_data    tinyint(2) unsigned NOT NULL default '0',
  rss_mode_title   tinyint(2) unsigned NOT NULL default '0',
  rss_mode_content tinyint(2) unsigned NOT NULL default '0',
  rss_cache_time   int(10) unsigned NOT NULL default '0',
  rss_limit        int(10) unsigned NOT NULL default '0',
  rss_new          int(10) unsigned NOT NULL default '0',
  rss_perpage      int(10) unsigned NOT NULL default '0',
  rss_num_content  int(10) unsigned NOT NULL default '0',
  rss_max_content  int(10) unsigned NOT NULL default '0',
  rss_max_summary  int(10) unsigned NOT NULL default '0',
  rss_site       text NOT NULL,
  rss_black      text NOT NULL,
  rss_white      text NOT NULL,
  post_title     tinyint(4) unsigned NOT NULL default '0',
  post_category  tinyint(4) unsigned NOT NULL default '0',
  post_url       tinyint(4) unsigned NOT NULL default '0',
  post_desc      tinyint(4) unsigned NOT NULL default '0',
  post_banner    tinyint(4) unsigned NOT NULL default '0',
  post_rss_url   tinyint(4) unsigned NOT NULL default '0',
  post_name      tinyint(4) unsigned NOT NULL default '0',
  post_mail      tinyint(4) unsigned NOT NULL default '0',
  post_company   tinyint(4) unsigned NOT NULL default '0',
  post_zip       tinyint(4) unsigned NOT NULL default '0',
  post_state     tinyint(4) unsigned NOT NULL default '0',
  post_city      tinyint(4) unsigned NOT NULL default '0',
  post_addr      tinyint(4) unsigned NOT NULL default '0',
  post_addr2     tinyint(4) unsigned NOT NULL default '0',
  post_tel       tinyint(4) unsigned NOT NULL default '0',
  post_fax       tinyint(4) unsigned NOT NULL default '0',
  post_passwd    tinyint(4) unsigned NOT NULL default '0',
  post_usercomment tinyint(4) unsigned NOT NULL default '0',
  type_desc    tinyint(2) unsigned NOT NULL default '0',
  check_double tinyint(2) unsigned NOT NULL default '0',
  cat_sel        int(10) unsigned NOT NULL default '0',
  cat_sub        int(10) unsigned NOT NULL default '0',
  cat_img_mode   tinyint(4) unsigned NOT NULL default '0',
  cat_img_width  int(10) unsigned NOT NULL default '0',
  cat_img_height int(10) unsigned NOT NULL default '0'
) ENGINE=MyISAM;

#
# Table structure for table `weblinks_config2`
# modify from system `config`
#

CREATE TABLE weblinks_config2 (
  id      smallint(5) unsigned NOT NULL auto_increment,
  conf_id smallint(5) unsigned NOT NULL default 0,
  conf_name      varchar(255) NOT NULL default '',
  conf_valuetype varchar(255) NOT NULL default '',
  conf_value text NOT NULL,
  aux_int_1 int(5) default '0',
  aux_int_2 int(5) default '0',
  aux_text_1 varchar(255) default '',
  aux_text_2 varchar(255) default '',
  PRIMARY KEY (id),
  KEY conf_id (conf_id)
) ENGINE=MyISAM;

#
# Table structure for table `weblinks_linkitem`
#

CREATE TABLE weblinks_linkitem (
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
) ENGINE=MyISAM;

