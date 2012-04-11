<?php
// $Id: compatible.php,v 1.4 2012/04/11 06:00:09 ohwada Exp $

// 2008-02-17 K.OHWADA
// pagerank, pagerank_update

// 2007-11-01 K.OHWADA
// _AM_WEBLINKS_GM_MARKER_WIDTH

// 2007-09-01 K.OHWADA
// waiting list

// 2007-08-01 K.OHWADA
// config 0

// 2007-07-14 K.OHWADA
// highlight

// 2007-06-10 K.OHWADA
// d3forum

// 2007-04-08 K.OHWADA
// _WEBLINKS_GM_TYPE

// 2007-03-25 K.OHWADA
// _WEBLINKS_ALBUM_ID

// 2007-02-20 K.OHWADA
// forum, performance

// 2006-12-11 K.OHWADA
// google map: googleGeocode
// _WEBLINKS_TIME_PUBLISH

// 2006-11-26 K.OHWADA
// google map: JP Geocode

// 2006-11-04 K.OHWADA
// google map: JP inverse Geocoder
// google map: inline mode

// 2006-10-05 K.OHWADA
// add _WEBLINKS_RSSC_LID
// google map

// 2006-05-15 K.OHWADA
// this is new file

//=========================================================
// WebLinks Module
// 2006-05-15 K.OHWADA
//=========================================================

//---------------------------------------------------------
// compatible for v2.10
//---------------------------------------------------------
if( !defined('_WEBLINKS_WEBMAP3_NOT_INSTALLED') ) 
{

// webmap3
define('_WEBLINKS_WEBMAP3_NOT_INSTALLED', 'NOT installed WEBMAP3 module ( %s ) ');
define('_WEBLINKS_WEBMAP3_INSTALLED',     'Installed WEBMAP3 module ( %s ) ver %s ');
define('_WEBLINKS_WEBMAP3_REQUIRE',       'Require WEBMAP3 module ver %s or later');

// google map
define('_WEBLINKS_GM_LOCATION', 'Location');
define('_WEBLINKS_GM_ICON', 'Google Icon');

}

if( !defined('_AM_WEBLINKS_VIEW_URL_SUMMARY') ) 
{

define('_AM_WEBLINKS_VIEW_URL_SUMMARY','Select URL');
define('_AM_WEBLINKS_VIEW_URL_SUMMARY_DSC','apply when select summary in category, recommended site, etc.');
define('_AM_WEBLINKS_VIEW_URL_SUMMARY_0','url of original site');
define('_AM_WEBLINKS_VIEW_URL_SUMMARY_1','singlelink of Weblinks');

define('_AM_WEBLINKS_TITLE_RSSC_MANAGE','RSSC Manage');
define('_AM_WEBLINKS_TITLE_RSSC_ARCHIVE','RSSC Archive Manage');
define('_AM_WEBLINKS_TITLE_RSSC_ADD','Add RSS URL in Link');
define('_AM_WEBLINKS_TITLE_RSSC_ADD_DSC','<b>Caution</b> It takes time, in order to search the url of rss using internet');

define('_AM_WEBLINKS_BULK_COMMENT','Bulk Registation of Comment');
define('_AM_WEBLINKS_BULK_COMMENT_DSC1','describe the title of link, uid, the title of comment, and the text of commentwith comma(,) separate<br />uid is omissible. substitute with uid of administrator.<br/ >the title of comment is omissible. substitute with the title of link.');
define('_AM_WEBLINKS_NO_COMMENT','No comment');
define('_AM_WEBLINKS_COMMENT_ADDED','Added comment');
define('_AM_WEBLINKS_BULK_DSC1','<br />describe \2c instead of comma.<br/ >describe \n instead of new-line.');

define('_AM_WEBLINKS_TITLE_LINK_GEOCODING','List of latitude & longitude');
define('_AM_WEBLINKS_TITLE_LINK_GEOCODING_DSC','Search latitude & longitude from address<br />Dont search link which registed lat & lng<br />Show result in <span style="color:#0000ff">Blue</span><br />Show in <span style="color:#ff0000">Red</span> if cannot search<br /><b>Caution</b> It takes time, in order to search latitude and longitude using internet');
define('_AM_WEBLINKS_SEARCHED_ADDRESS','Searched Address');
define('_AM_WEBLINKS_GOTO_NEXT_PAGE','Goto Next Page');
define('_AM_WEBLINKS_LAST_PAGE','This is last page');
define('_AM_WEBLINKS_GEO_ADD','Add lat & lng into link');

define('_AM_WEBLINKS_TITLE_LINK_CSV','Download links with CSV format');

define('_AM_WEBLINKS_CAT_GM_LOCATION_DSC', 'Memo which notes place');
define('_AM_WEBLINKS_CAT_GM_ICON_DSC', 'The icon of the parent category is inherited at (default)');

}

//---------------------------------------------------------
// compatible for v1.90
//---------------------------------------------------------
if( !defined('_WEBLINKS_PAGERANK') ) 
{
// linkitem
	define('_WEBLINKS_PAGERANK', 'PageRank');
	define('_WEBLINKS_PAGERANK_UPDATE', 'Pagerank Update Time');
	define('_WEBLINKS_GM_KML_DEBUG', 'Debug view of KML');

// gmap
	define('_WEBLINKS_SITE_GMAP', 'GoogleMaps Site');
	define('_WEBLINKS_KML_LIST',  'KML List');
	define('_WEBLINKS_KML_LIST_DESC', 'Download KML and show in GoogleEarth');
	define('_WEBLINKS_KML_PERPAGE', 'The number to divide');

// pagerank
	define('_WEBLINKS_SITE_PAGERANK', 'High PageRank Site');
}

if( !defined('_AM_WEBLINKS_CONF_MENU') ) 
{
// config
	define('_AM_WEBLINKS_MODULE_CONFIG_7','Module Configuration 7');
	define('_AM_WEBLINKS_MODULE_CONFIG_DESC_7','Menu');
	define('_AM_WEBLINKS_CONF_MENU', 'View of Menu');
	define('_AM_WEBLINKS_CONF_MENU_DESC', 'The setting which relates to the view of menu');
	define('_AM_WEBLINKS_CONF_TITLE','Title of Menu');

// htmlout
	define('_AM_WEBLINKS_OUTPUT_PLUGIN_MANAGE', 'HTML Output Plugin Management');
	define('_AM_WEBLINKS_HTMLOUT', 'HTML Output Plugin');
	define('_AM_WEBLINKS_RSSOUT',  'RSS Output Plugin');
	define('_AM_WEBLINKS_KMLOUT',  'KML Output Plugin');

// pagerank
	define('_AM_WEBLINKS_LINK_CHECK_MANAGE', 'Link Check Management');
	define('_AM_WEBLINKS_USE_PAGERANK', 'Show PageRank');
	define('_AM_WEBLINKS_USE_PAGERANK_DESC', '"Show" : show pagerank in menu bar, link list, link single');
	define('_AM_WEBLINKS_USE_PAGERANK_NON',   'Not show');
	define('_AM_WEBLINKS_USE_PAGERANK_SHOW',  'Show');
	define('_AM_WEBLINKS_USE_PAGERANK_CACHE', 'Show using cache of getting PageRank');

// kml
	define('_AM_WEBLINKS_KML_USE', 'Show KML');
}

//---------------------------------------------------------
// compatible for v1.80
//---------------------------------------------------------
if( !defined('_WEBLINKS_ERROR_LENGTH') ) 
{
	define('_WEBLINKS_ERROR_LENGTH', "Error: %s must be less than %s characters");
}

if( !defined('_AM_WEBLINKS_GM_MARKER_WIDTH') ) 
{
// google map
	define('_AM_WEBLINKS_GM_MARKER_WIDTH',  '[Marker] Width (pixel)');
	define('_AM_WEBLINKS_GM_MARKER_WIDTH_DESC',  'Width of map marker info<br /><b>-1</b> is unspecifid');
	define('_AM_WEBLINKS_LINK_IMG_USE', 'Use %s');

	define('_AM_WEBLINKS_RSS_SITE', 'This Site');
	define('_AM_WEBLINKS_RSS_FEED', 'RSS feeds');

// nameflag mainflag
	define('_AM_WEBLINKS_CONF_LINK_USER','User Link Register Configuration');
	define('_AM_WEBLINKS_USER_NAMEFLAG','Select view of nameflag');
	define('_AM_WEBLINKS_USER_MAILFLAG','Select view of mailflag');
	define('_AM_WEBLINKS_USER_NAME_MAIL_FLAG_DESC','The default value when the user register<br />The admin can change value');
	define('_AM_WEBLINKS_USER_NAME_MAIL_FLAG_SEL','The user choice');

// description length
	define('_AM_WEBLINKS_DESC_LENGTH', 'Max length of charcters');
	define('_AM_WEBLINKS_DESC_LENGTH_DSC', '<b>-1</b> or the admin : 64KB limit<br />');
}

//---------------------------------------------------------
// compatible for v1.70
//---------------------------------------------------------
if( !defined('_WEBLINKS_ADMIN_WAITING_LIST') ) 
{
// waiting list
	define('_WEBLINKS_ADMIN_WAITING_LIST', "Admin's waiting list");
	define('_WEBLINKS_USER_WAITING_LIST',  'Your waiting list');
	define('_WEBLINKS_USER_OWNER_LIST',    'Your submitted list');

// submit form
	define('_WEBLINKS_TIME_PUBLISH_SET', 'Set the publication time');
	define('_WEBLINKS_TIME_PUBLISH_DESC','If you do not check it, published time will become undated');
	define('_WEBLINKS_TIME_EXPIRE_SET',  'Set expiration time');
	define('_WEBLINKS_TIME_EXPIRE_DESC', 'If you do not check it, expired setting will become undated');
	define('_WEBLINKS_DEL_LINK_CONFIRM','Confirm to delete');
	define('_WEBLINKS_DEL_LINK_REASON', 'Reason to delete');
}

if( !defined('_AM_WEBLINKS_AUTH_DELETE') ) 
{
// auth
	define('_AM_WEBLINKS_AUTH_DELETE','Can delete');
	define('_AM_WEBLINKS_AUTH_DELETE_DSC','Specify the groups allowed to submit link deletion requests');
	define('_AM_WEBLINKS_AUTH_DELETE_AUTO','Can approve link deletions');
	define('_AM_WEBLINKS_AUTH_DELETE_AUTO_DSC','Specify the groups allowed to approve link deletion requests');

// nofitication
	define('_AM_WEBLINKS_NOTIFICATION_MANAGE', 'Notification Management');
	define('_AM_WEBLINKS_NOTIFICATION_MANAGE_DESC', 'Setting for each module administrator<br />It is the same as the top page of the module');
	define('_AM_WEBLINKS_NOTIFICATION_MANAGE_NOT_USE', "You cannot use in some XOOPS's version");
	define('_AM_WEBLINKS_NOTIFICATION_MANAGE_PLEASE', 'In the case, please use in the top page of this module');
	define('_AM_WEBLINKS_SUBJ_LINK_MOD_APPROVED', '[{X_SITENAME}] {X_MODULE}: Your modification request link is approved');
	define('_AM_WEBLINKS_SUBJ_LINK_MOD_REFUSED',  '[{X_SITENAME}] {X_MODULE}: Your modification request link is refused');
	define('_AM_WEBLINKS_SUBJ_LINK_DEL_APPROVED', '[{X_SITENAME}] {X_MODULE}: Your deletion request link is approved');
	define('_AM_WEBLINKS_SUBJ_LINK_DEL_REFUSED',  '[{X_SITENAME}] {X_MODULE}: Your deletion request link is refused');

// config
	define('_AM_WEBLINKS_ADMIN_WAITING_SHOW', 'Show admin waiting list');
	define('_AM_WEBLINKS_USER_WAITING_NUM',   'Number of links user waiting list');
	define('_AM_WEBLINKS_USER_OWNER_NUM',     'Number of list user submitted list');
	define('_AM_WEBLINKS_USE_HITS_SINGLELINK','Countup hits when show singlelink');
	define('_AM_WEBLINKS_USE_HITS_SINGLELINK_DSC','YES enables to countup link hits counter when show singlelink');
	define('_AM_WEBLINKS_MODE_RANDOM', 'Redirect of random jump');
	define('_AM_WEBLINKS_MODE_RANDOM_URL', 'registered site url');
	define('_AM_WEBLINKS_MODE_RANDOM_SINGLE', 'singlelink in this module');

// request list
	define('_AM_WEBLINKS_DEL_REQS', 'Deletion Links Waiting for Validation');
	define('_AM_WEBLINKS_NO_DEL_REQ','No Link Deletion Request');
	define('_AM_WEBLINKS_DEL_REQ_DELETED','Deletion Request Deleted');

// link list
	define('_AM_WEBLINKS_LINK_USERCOMMENT_DESC','Link list with comment for admin (Listed by new ID)');

// clone
	define('_AM_WEBLINKS_CLONE_LINK', 'Clone');
	define('_AM_WEBLINKS_CLONE_MODULE', 'Clone to other module');
	define('_AM_WEBLINKS_CLONE_CONFIRM', 'Confirm to clone');
	define('_AM_WEBLINKS_NO_MODULE', 'There is no corresponding module');

// link form
	define('_AM_WEBLINKS_MODIFIED', 'Modified');
	define('_AM_WEBLINKS_CHECK_CONFIRM', 'Confrimed');
	define('_AM_WEBLINKS_WARN_CONFIRM', 'Warning: Check to "Confirmed" of %s');
	define('_AM_WEBLINKS_RSSC_LID_EXIST_MORE', 'There are twe or more links which have same "RSSC ID"');

// web shot
	define('_AM_WEBLINKS_LINK_IMG_THUMB', 'The substitution of the link image');
	define('_AM_WEBLINKS_LINK_IMG_THUMB_DSC', 'The substitute image when not set the link image');
	define('_AM_WEBLINKS_LINK_IMG_NON', 'none');
	define('_AM_WEBLINKS_LINK_IMG_MOZSHOT', 'Use <a href="http://mozshot.nemui.org/" target="_blank">MozShot</a>');
	define('_AM_WEBLINKS_LINK_IMG_SIMPLEAPI', 'Use <a href="http://img.simpleapi.net/" target="_blank">SimpleAPI</a>');

}

//---------------------------------------------------------
// compatible for v1.60
//---------------------------------------------------------
if( !defined('_WEBLINKS_GM_CURRENT_ADDRESS') ) 
{
	define('_WEBLINKS_GM_CURRENT_ADDRESS', 'Current Address');
	define('_WEBLINKS_GM_SEARCH_LIST', 'Search Results List');
}

if( !defined('_AM_WEBLINKS_MODULE_CONFIG_0') ) 
{
// config
	define('_AM_WEBLINKS_MODULE_CONFIG_0','Module Configuration');
	define('_AM_WEBLINKS_MODULE_CONFIG_DESC_0','Index');
	define('_AM_WEBLINKS_MODULE_CONFIG_5','Module Configuration 5');
	define('_AM_WEBLINKS_MODULE_CONFIG_DESC_5','Link Register Item');
	define('_AM_WEBLINKS_MODULE_CONFIG_6','Module Configuration 6');
	define('_AM_WEBLINKS_MODULE_CONFIG_DESC_6','Google Map');

// google map
	define('_AM_WEBLINKS_GM_MAP_CONT',  'Map Control');
	define('_AM_WEBLINKS_GM_MAP_CONT_DESC',  'GLargeMapControl, GSmallMapControl, GSmallZoomControl');
	define('_AM_WEBLINKS_GM_MAP_CONT_NON',   'Not show');
	define('_AM_WEBLINKS_GM_MAP_CONT_LARGE', 'Large Control');
	define('_AM_WEBLINKS_GM_MAP_CONT_SMALL', 'Small Control');
	define('_AM_WEBLINKS_GM_MAP_CONT_ZOOM',  'Zoom Control');
	define('_AM_WEBLINKS_GM_USE_TYPE_CONT',  'Use Map Type Control');
	define('_AM_WEBLINKS_GM_USE_TYPE_CONT_DESC',  'GMapTypeControl');
	define('_AM_WEBLINKS_GM_USE_SCALE_CONT',  'Use Scale Control');
	define('_AM_WEBLINKS_GM_USE_SCALE_CONT_DESC',  'GScaleControl');
	define('_AM_WEBLINKS_GM_USE_OVERVIEW_CONT',  'Use Overview Map Control');
	define('_AM_WEBLINKS_GM_USE_OVERVIEW_CONT_DESC',  'GOverviewMapControl');
	define('_AM_WEBLINKS_GM_MAP_TYPE', '[Search] Map Type');
	define('_AM_WEBLINKS_GM_MAP_TYPE_DESC', 'GMapType');
	define('_AM_WEBLINKS_GM_GEOCODE_KIND',  '[åüçı] Kind of Geocode');
	define('_AM_WEBLINKS_GM_GEOCODE_KIND_DESC',  'Search latitude and longitude from address<br /><b>Single Result</b><br />GClientGeocoder - getLatLng<br /><b>More Results</b><br />GClientGeocoder - getLocations');
	define('_AM_WEBLINKS_GM_GEOCODE_KIND_LATLNG', 'Single Result: getLatLng');
	define('_AM_WEBLINKS_GM_GEOCODE_KIND_LOCATIONS',   'More Results: getLocations');
	define('_AM_WEBLINKS_GM_USE_GEOCODE_TOKYO',  '[Search][Japan] Use CSIS');
	define('_AM_WEBLINKS_GM_USE_GEOCODE_TOKYO_DESC',  'Valid in Japan<br />Search latitude and longitude from address');
	define('_AM_WEBLINKS_GM_USE_NISHIOKA',  '[Search][Japan] Use Inverse Geocode');
	define('_AM_WEBLINKS_GM_USE_NISHIOKA_DESC',  'Valid in Japan<br />Search address from latitude and longitude<br /><a href="http://nishioka.sakura.ne.jp/google/" target="_blank">http://nishioka.sakura.ne.jp/google/</a>');
	define('_AM_WEBLINKS_GM_TITLE_LENGTH',  '[Marker] Maximum characters for Title');
	define('_AM_WEBLINKS_GM_TITLE_LENGTH_DESC',  'Maximum number of characters used for Title in the marker<br /><b>-1</b> is unlimited');
	define('_AM_WEBLINKS_GM_DESC_LENGTH',  '[Marker] Maximum characters for Content');
	define('_AM_WEBLINKS_GM_DESC_LENGTH_DESC',  'Maximum number of characters used for Content in the marker<br /><b>-1</b> is unlimited');
	define('_AM_WEBLINKS_GM_WORDWRAP',  '[Marker] Maximum characters for wordwarp');
	define('_AM_WEBLINKS_GM_WORDWRAP_DESC',  'Maximum number of characters used for per line (wordwrap) in the marker<br /><b>-1</b> is unlimited');
	define('_AM_WEBLINKS_GM_USE_CENTER_MARKER',  '[Marker] Show the center marker');
	define('_AM_WEBLINKS_GM_USE_CENTER_MARKER_DESC',  'In Main page and Category page, show the center marker');

// map jp
	define('_AM_WEBLINKS_MAP_JP_MANAGE', 'Japan Map Configuration');

// column
	define('_AM_WEBLINKS_COLUMN_MANAGE', 'Column Management');
	define('_AM_WEBLINKS_COLUMN_MANAGE_DESC', 'Add etc columns in link table and modify table');
	define('_AM_WEBLINKS_COLUMN_MANAGE_NOT_USE', 'Not Use');
	define('_AM_WEBLINKS_THERE_ARE_COLUMN', 'There are <b>%s</b> etc columns in link table');
	define('_AM_WEBLINKS_COLUMN_NUM', 'Number of adding etc columns');
	define('_AM_WEBLINKS_COLUMN_BIGGER_USE', 'The number of the etc columns is bigger than the number in link table');
	define('_AM_WEBLINKS_COLUMN_UNMATCH',  'The columns is unmatch in link table and modify table');
	define('_AM_WEBLINKS_PHPMYADMIN',  'Correct in the management tool like as phpMyAdmin');
	define('_AM_WEBLINKS_LINK_NUM_ETC', 'The number of etc columns');

// latest
	define('_AM_WEBLINKS_INDEX_MODE_LATEST', 'Order of Latest Links');
	define('_AM_WEBLINKS_INDEX_MODE_LATEST_UPDATE', 'Updated Date');
	define('_AM_WEBLINKS_INDEX_MODE_LATEST_CREATE', 'Created Date');

// header
	define('_AM_WEBLINKS_CONF_HTML_STYLE', 'HTML Style Configuration');
	define('_AM_WEBLINKS_HEADER_MODE', 'Use xoops module header');
	define('_AM_WEBLINKS_HEADER_MODE_DESC', 'When "No", show style sheet and Javascript in body tag<br />When "Yes", show them in header tag, using xoops module header<br />there are same themes which can not be used');

// bulk
	define('_AM_WEBLINKS_BULK_SAMPLE','You can see sample, click sample button');
	define('_AM_WEBLINKS_BULK_LINK_DSC10','Register items are fixed');
	define('_AM_WEBLINKS_BULK_LINK_DSC20','Admin specify register items');
	define('_AM_WEBLINKS_BULK_LINK_DSC21','First paragraph');
	define('_AM_WEBLINKS_BULK_LINK_DSC22','Second paragraph, and following');
	define('_AM_WEBLINKS_BULK_LINK_DSC23','Input the register item names on the 1st line.<br />Input horizontal bar (---)');
	define('_AM_WEBLINKS_BULK_LINK_DSC24','Describe the register items, by the order of in the first paragraph, divided by a comma(,) on the 2nd line.');
	define('_AM_WEBLINKS_BULK_CHECK_URL','Check to set URL');
	define('_AM_WEBLINKS_BULK_CHECK_DESCRIPTION','Check to set description');

}

//---------------------------------------------------------
// compatible for v1.51
//---------------------------------------------------------
if( !defined('_AM_WEBLINKS_USE_HIGHLIGHT') ) 
{
// highlight
	define('_AM_WEBLINKS_USE_HIGHLIGHT', 'Use keyword Highlight');
	define('_AM_WEBLINKS_CHECK_MAIL', 'Check Email Format');
	define('_AM_WEBLINKS_CHECK_MAIL_DSC', 'NO allows any format. <br /> YES checks that email format is like abc@efg.com when register link. ');
	define('_AM_WEBLINKS_NO_EMAIL', 'Not Set Email Address');
}

//---------------------------------------------------------
// compatible for v1.50
//---------------------------------------------------------
if( !defined('_AM_WEBLINKS_CONF_D3FORUM') ) 
{
// d3forum
	define('_AM_WEBLINKS_CONF_D3FORUM', 'Comment-integration with d3forum module');
	define('_AM_WEBLINKS_PLUGIN_SEL',   'Plugin Select');
	define('_AM_WEBLINKS_DIRNAME_SEL',  'Module Select');

// category
	define('_AM_WEBLINKS_CAT_PATH_STYLE', 'View Style of Category Path');

// category page
	define('_AM_WEBLINKS_CONF_CAT_PAGE', 'Category Pgae Setting');
	define('_AM_WEBLINKS_CAT_COLS', 'Number of Columns in Categories');
	define('_AM_WEBLINKS_CAT_COLS_DESC', 'In category page, specify the number of the columns, when showing categories under one hierarchy');
	define('_AM_WEBLINKS_CAT_SUB_MODE', 'View Range of Sub Category');
	define('_AM_WEBLINKS_CAT_SUB_MODE_1', 'Only categories under one hierarchy');
	define('_AM_WEBLINKS_CAT_SUB_MODE_2', 'All caategories under one and more hierarchies');

}

//---------------------------------------------------------
// compatible for v1.42
//---------------------------------------------------------
if( !defined('_WEBLINKS_GM_TYPE') ) 
{
	define('_WEBLINKS_GM_TYPE',  'Google Map Type');
	define('_WEBLINKS_GM_TYPE_MAP',       'Map');
	define('_WEBLINKS_GM_TYPE_SATELLITE', 'Satellite');
	define('_WEBLINKS_GM_TYPE_HYBRID',    'Hybrid');
}

if( !defined('_AM_WEBLINKS_CAT_DESC_MODE') ) 
{
	define('_AM_WEBLINKS_CAT_DESC_MODE',  'Show Description');
	define('_AM_WEBLINKS_CAT_SHOW_FORUM', 'Show Forum');
	define('_AM_WEBLINKS_CAT_SHOW_ALBUM', 'Show Album');
	define('_AM_WEBLINKS_MODE_SETTING',   'Setting value');
	define('_AM_WEBLINKS_MODE_OMIT_PARENT', 'Same as parent category when omit');
}

//---------------------------------------------------------
// compatible for v1.41
//---------------------------------------------------------
if( !defined('_WEBLINKS_ALBUM_ID') ) 
{
	define('_WEBLINKS_ALBUM_ID',  'Album ID');
	define('_WEBLINKS_ALBUM_SEL', 'Album Select');
}

if( !defined('_AM_WEBLINKS_UPDATE_CAT_IMAGE_SIZE') ) 
{
	define('_AM_WEBLINKS_UPDATE_CAT_IMAGE_SIZE','Update category image size');

	define('_AM_WEBLINKS_CONF_INDEX', 'Index Page Configuretaion');
	define('_AM_WEBLINKS_CONF_INDEX_GM_MODE', 'Google Map mode');

	define('_AM_WEBLINKS_CAT_SHOW_GM',   'Show Google map');
	define('_AM_WEBLINKS_MODE_NON',       'Not show');
	define('_AM_WEBLINKS_MODE_DEFAULT',   'Default value');
	define('_AM_WEBLINKS_MODE_PARENT',    'Same as parent category');
	define('_AM_WEBLINKS_MODE_FOLLOWING', 'following value');

	define('_AM_WEBLINKS_CONF_CAT_ALBUM',  'View Album in Category');
	define('_AM_WEBLINKS_CONF_LINK_ALBUM', 'View Album in Link');
	define('_AM_WEBLINKS_ALBUM_SEL', 'Select Album module');
	define('_AM_WEBLINKS_ALBUM_LIMIT', 'Number of Showing Phots');
	define('_AM_WEBLINKS_WHEN_OMIT', 'Process when omit');

	define('_AM_WEBLINKS_MODULE_INSTALLED',     '%s module ( %s ) ver %s is installed');
	define('_AM_WEBLINKS_MODULE_NOT_INSTALLED', '%s module ( %s ) is not installed');
}

//---------------------------------------------------------
// compatible for v1.4x
//---------------------------------------------------------
if( !defined('_WEBLINKS_LATEST_FORUM') ) 
{
// forum
	define('_WEBLINKS_LATEST_FORUM', 'Leatest Forum');
	define('_WEBLINKS_FORUM',  'Forum');
	define('_WEBLINKS_THREAD', 'Thead');
	define('_WEBLINKS_POST',   'Post');
	define('_WEBLINKS_FORUM_ID',  'Forum ID');
	define('_WEBLINKS_FORUM_SEL', 'Forum Select');
	define('_WEBLINKS_COMMENT_USE',  'Use XOOPS Comment');

// aux
	define('_WEBLINKS_CAT_AUX_TEXT_1', 'aux_text_1');
	define('_WEBLINKS_CAT_AUX_TEXT_2', 'aux_text_2');
	define('_WEBLINKS_CAT_AUX_INT_1',  'aux_int_1');
	define('_WEBLINKS_CAT_AUX_INT_2',  'aux_int_2');

// captcha
	define('_WEBLINKS_CAPTCHA', 'Captcha');
	define('_WEBLINKS_CAPTCHA_DESC', 'Anti-Spam');
	define('_WEBLINKS_ERROR_CAPTCHA','Error: Unmtach Captcha');
	define('_WEBLINKS_ERROR', 'Error');

// hack for multi site
	define('_WEBLINKS_CAT_TITLE_JP', 'Japanse Title');
	define('_WEBLINKS_DISABLE_FEATURE', 'Disbale this feature');
	define('_WEBLINKS_REDIRECT_JP_SITE', 'Jump to Japanese Site');

}

if( !defined('_AM_WEBLINKS_UPDATE_CAT_PATH') ) 
{
// performance
	define('_AM_WEBLINKS_UPDATE_CAT_PATH','Update category path tree');
	define('_AM_WEBLINKS_UPDATE_CAT_COUNT','Update category link count');
	define('_AM_WEBLINKS_CAT_COUNT_UPDATED','Category path tree updated');

// config
	define('_AM_WEBLINKS_SYSTEM_POST_LINK','Post count when submit link');
	define('_AM_WEBLINKS_SYSTEM_POST_LINK_DSC','YES count up XOOPS user posts when user submit new link. ');
	define('_AM_WEBLINKS_SYSTEM_POST_RATE','Post count when rate link');
	define('_AM_WEBLINKS_SYSTEM_POST_RATE_DSC','YES count up XOOPS user posts when user rate link. ');

	define('_AM_WEBLINKS_VIEW_STYLE_CAT','View style in each category');
	define('_AM_WEBLINKS_VIEW_STYLE_MARK','View style in recommend site');
	define('_AM_WEBLINKS_VIEW_STYLE_MARK_DSC','It apply in Recommend site, Reciprocal site, RSS/ATOM site');
	define('_AM_WEBLINKS_VIEW_STYLE_0','Summary');
	define('_AM_WEBLINKS_VIEW_STYLE_1','Full detail');

	define('_AM_WEBLINKS_CONF_PERFORMANCE','Performance improvement');
	define('_AM_WEBLINKS_CONF_PERFORMANCE_DSC','Because of the performance improvement, it computes necessary data beforehand when showing, and it stores in the database.<br />When using in first time, execute "category list" -> "Update category path tree"');
	define('_AM_WEBLINKS_CAT_PATH','Category path tree');
	define('_AM_WEBLINKS_CAT_PATH_DSC','YES computes the category path tree, and it stores in the category table.<br />NO computes when showing.');
	define('_AM_WEBLINKS_CAT_COUNT','Category link count');
	define('_AM_WEBLINKS_CAT_COUNT_DSC','YES computes the category link count, and it stores in the category table.<br />NO computes when showing.');

	define('_AM_WEBLINKS_POST_TEXT_4', 'All items are displayed in admin page');
	define('_AM_WEBLINKS_LINK_REGISTER_1','Link settings: Textarea1');

	define('_AM_WEBLINKS_CONF_LINK_GUEST','Link Register Item Configuration');
	define('_AM_WEBLINKS_USE_CAPTCHA','Use CAPTCHA');
	define('_AM_WEBLINKS_USE_CAPTCHA_DSC','CAPTCHA is technique for anti-spam.<br />This feature Need Captcha module.<br />YES, <b>anoymous user</b> must use CAPTCHA when add or modify link.<br />NO does not show CAPTCHA field.');
	define('_AM_WEBLINKS_CAPTCHA_FINDED',     'Captcha module ver %s is finded');
	define('_AM_WEBLINKS_CAPTCHA_NOT_FINDED', 'Captcha module is not finded');

	define('_AM_WEBLINKS_CONF_SUBMIT', 'Description of Link Register Form');
	define('_AM_WEBLINKS_SUBMIT_MAIN',    'Description of add new link: 1');
	define('_AM_WEBLINKS_SUBMIT_PENDING', 'Description of add new link: 2');
	define('_AM_WEBLINKS_SUBMIT_DOUBLE',  'Description of add new link: 3');
	define('_AM_WEBLINKS_SUBMIT_MAIN_DSC',   'Show always');
	define('_AM_WEBLINKS_SUBMIT_PENDING_DSC','Show when "admin need approve" mode" mode');
	define('_AM_WEBLINKS_SUBMIT_DOUBLE_DSC', 'Show when "check same link exist" mode');

	define('_AM_WEBLINKS_MODLINK_MAIN',     'Description of modify link: 1');
	define('_AM_WEBLINKS_MODLINK_PENDING',  'Description of modify link: 2');
	define('_AM_WEBLINKS_MODLINK_NOT_OWNER','Description of modify link: 3');
	define('_AM_WEBLINKS_MODLINK_NOT_OWNER_DSC','Show when "admin need approve" mode" mode and not owner');

	define('_AM_WEBLINKS_CONF_CAT_FORUM', 'View Forum in Category');
	define('_AM_WEBLINKS_CONF_LINK_FORUM', 'View Forum in Link');
	define('_AM_WEBLINKS_FORUM_SEL', 'Select Forum module');
	define('_AM_WEBLINKS_FORUM_THREAD_LIMIT', 'Number of Showing Thread');
	define('_AM_WEBLINKS_FORUM_POST_LIMIT', 'Number of Showing Post in each Thread');
	define('_AM_WEBLINKS_FORUM_POST_ORDER', 'Order of Post');
	define('_AM_WEBLINKS_FORUM_POST_ORDER_0', 'Older post date');
	define('_AM_WEBLINKS_FORUM_POST_ORDER_1', 'Newer post date');
	define('_AM_WEBLINKS_FORUM_INSTALLED',     'Forum module ( %s ) ver %s is installed');
	define('_AM_WEBLINKS_FORUM_NOT_INSTALLED', 'Forum module ( %s ) is not installed');

}

//---------------------------------------------------------
// compatible for v1.3x
//---------------------------------------------------------
if( !defined('_WEBLINKS_GM_SEARCH_MAP_FROM_ADDRESS') ) 
{
// google map: Geocode
	define('_WEBLINKS_GM_SEARCH_MAP_FROM_ADDRESS', 'Search Map from the address');
	define('_WEBLINKS_GM_NO_MATCH_PLACE', 'There are no place to match the address');
	define('_WEBLINKS_GM_JP_SEARCH_MAP_FROM_ADDRESS', 'Search Map from the address in Japan');
	define('_WEBLINKS_GM_JP_TOKYO_AC_GEOCODE', 'Japan Tokyo University');
	define('_WEBLINKS_GM_JP_MLIT_ISJ', 'Japan Ministry of Land Infrastructure and Transport');

// link item
	define('_WEBLINKS_TIME_PUBLISH', 'Time Published');
	define('_WEBLINKS_TIME_EXPIRE',  'Time Expire');
	define('_WEBLINKS_TEXTAREA',     'Textarea');

	define('_WEBLINKS_WARN_TIME_PUBLISH', 'The pulish time does not come yet');
	define('_WEBLINKS_WARN_TIME_EXPIRE',  'The expired time is passing');
	define('_WEBLINKS_WARN_BROKEN', 'This link may be broken');
}

if( !defined('_AM_WEBLINKS_LINK_TIME_PUBLISH_BEFORE') ) 
{
// link item
//	define('_AM_WEBLINKS_TIME_PUBLISH','Set the publication time');
//	define('_AM_WEBLINKS_TIME_PUBLISH_DESC','If you do not check it, published time will become undated');
//	define('_AM_WEBLINKS_TIME_EXPIRE','Set expiration time');
//	define('_AM_WEBLINKS_TIME_EXPIRE_DESC','If you do not check it, expired setting will become undated');

	define('_AM_WEBLINKS_LINK_TIME_PUBLISH_BEFORE','Link list before Publish time');
	define('_AM_WEBLINKS_LINK_TIME_EXPIRE_AFTER',  'Link list after Expired time');

	define('_AM_WEBLINKS_SERVER_ENV','Server Enviroment');
	define('_AM_WEBLINKS_DEBUG_CONF','Debug Vairables');
	define('_AM_WEBLINKS_ALL_GREEN','All Green');
}

//---------------------------------------------------------
// compatible for v1.2x
//---------------------------------------------------------
// main
if( !defined('_WEBLINKS_GOOGLE_MAPS') ) 
{
// google map inline mode
	define('_WEBLINKS_GOOGLE_MAPS', 'Google Maps');
	define('_WEBLINKS_JAVASCRIPT_INVALID', 'Your browser cannot use JavaScript');
	define('_WEBLINKS_GM_NOT_COMPATIBLE',  'Your browser cannot use GoogleMaps');
	define('_WEBLINKS_GM_NEW_WINDOW', 'Display in New Window');
	define('_WEBLINKS_GM_INLINE',   'Display Inline');
	define('_WEBLINKS_GM_DISP_OFF', 'Disable display');

// google map: inverse Geocoder
	define('_WEBLINKS_GM_GET_LATITUDE', 'Get Latitude/Longitude/Zoom');
	define('_WEBLINKS_GM_GET_ADDR', 'Get Address');

}

//---------------------------------------------------------
// compatible for v1.1x
//---------------------------------------------------------
// main
if( !defined('_WEBLINKS_MAP_USE') ) 
{
	define('_WEBLINKS_MAP_USE', 'Use Map Icon');

// rssc
	define('_WEBLINKS_RSSC_LID',  'RSSC Lid');
	define('_WEBLINKS_RSS_MODE',  'RSS Mode');
	define('_WEBLINKS_RSSC_NOT_INSTALLED', 'RSSC module ( %s ) is not installed');
	define('_WEBLINKS_RSSC_INSTALLED',     'RSSC module ( %s ) ver %s is installed');
	define('_WEBLINKS_RSSC_REQUIRE', 'Require RSSC module ver %s or later');
	define('_WEBLINKS_GOTO_SINGLELINK', 'GOTO Link Info');

// warnig
	define('_WEBLINKS_WARN_NOT_READ_URL', 'Warinig: cannnot read url');
	define('_WEBLINKS_WARN_BANNER_NOT_GET_SIZE', 'Warinig: cannnot get banner size');

// google map
	define('_WEBLINKS_GM_LATITUDE',  'Latitude');
	define('_WEBLINKS_GM_LONGITUDE', 'Longitude');
	define('_WEBLINKS_GM_ZOOM',      'Zoom Level');
	define('_WEBLINKS_GM_GET_LOCATION', 'The location information is acquired with GoogleMaps');
	define('_WEBLINKS_GM_GET_BUTTON', 'Get Latitude/Longitude/Zoom');
	define('_WEBLINKS_GM_DEFAULT_LOCATION', 'Default Location');
	define('_WEBLINKS_GM_CURRENT_LOCATION', 'Current Location');
}

// admin
if( !defined('_AM_WEBLINKS_MODULE_CONFIG_3') ) 
{
// menu
	define('_AM_WEBLINKS_MODULE_CONFIG_3','Module Configuration 3');
	define('_AM_WEBLINKS_MODULE_CONFIG_4','Module Configuration 4');
	define('_AM_WEBLINKS_VOTE_LIST', 'Vote List');
	define('_AM_WEBLINKS_CATLINK_LIST', 'CatLink List');
	define('_AM_WEBLINKS_COMMAND_MANAGE', 'Command Manage');
	define('_AM_WEBLINKS_TABLE_MANAGE',  'DB Table Manage');
	define('_AM_WEBLINKS_IMPORT_MANAGE', 'Import Manage');
	define('_AM_WEBLINKS_EXPORT_MANAGE', 'Export Manage');

// config
	define('_AM_WEBLINKS_MODULE_CONFIG_DESC_2','Auth, Cat, etc');
	define('_AM_WEBLINKS_MODULE_CONFIG_DESC_3','Link');
	define('_AM_WEBLINKS_MODULE_CONFIG_DESC_4','RSS, Map');
	define('_AM_WEBLINKS_LINK_REGISTER','Setting of link register');

// bin configuration
	define('_AM_WEBLINKS_FORM_BIN', 'Command Config');
	define('_AM_WEBLINKS_FORM_BIN_DESC', 'It is used on bin command');
	define('_AM_WEBLINKS_CONF_BIN_PASS','Password');
	//define('_AM_WEBLINKS_CONF_BIN_PASS_DESC','');
	define('_AM_WEBLINKS_CONF_BIN_SEND','Send Mail');
	//define('_AM_WEBLINKS_CONF_BIN_SEND_DESC','');
	define('_AM_WEBLINKS_CONF_BIN_MAILTO','Email to send');
	//define('_AM_WEBLINKS_CONF_BIN_MAILTO_DESC','');

// rssc
	define('_AM_WEBLINKS_RSS_DIRNAME','RSSC Module Dirname');
	//define('_AM_WEBLINKS_RSS_DIRNAME_DESC','');

// link manage
	define('_AM_WEBLINKS_DEL_LINK', 'Delete link');
	define('_AM_WEBLINKS_ADD_RSSC', 'Add link into RSSC module');
	define('_AM_WEBLINKS_MOD_RSSC', 'Modify link in RSSC module');
	define('_AM_WEBLINKS_REFRESH_RSSC', 'Refresh link in RSSC module');
	define('_AM_WEBLINKS_APPROVE',     'Appove New Link');
	define('_AM_WEBLINKS_APPROVE_MOD', 'Appove Modify RequestLink');
	define('_AM_WEBLINKS_RSSC_LID_SAVED', 'Saved rssc lid');
	define('_AM_WEBLINKS_GOTO_LINK_LIST', 'GOTO link list');
	define('_AM_WEBLINKS_GOTO_LINK_EDIT', 'GOTO link edit');
	define('_AM_WEBLINKS_ADD_BANNER', 'Add banner image size');
	define('_AM_WEBLINKS_MOD_BANNER', 'Mod banner image size');

// vote list
	define('_AM_WEBLINKS_VOTE_USER', 'Registered User Votes');
	define('_AM_WEBLINKS_VOTE_ANON', 'Anonymous User Votes');

// locate
	define('_AM_WEBLINKS_CONF_LOCATE','Locate Configration');
	define('_AM_WEBLINKS_CONF_COUNTRY_CODE','County Code');
	define('_AM_WEBLINKS_CONF_COUNTRY_CODE_DESC', 'Enter ccTLDs code <br/> <a href="http://www.iana.org/cctld/cctld-whois.htm" target="_blank">IANA: Country-Code Top-Level Domains</a>');
	define('_AM_WEBLINKS_CONF_RENEW_COUNTRY_CODE_DESC', 'Renew the item which relates to the country code. <br/> The item with the <span style="color:#0000ff;">#</span> mark');
	define('_AM_WEBLINKS_RENEW', 'Renew');

// map
	define('_AM_WEBLINKS_CONF_MAP','Mps Site Configuretaion');
	define('_AM_WEBLINKS_CONF_MAP_USE','Use Map Site');
	define('_AM_WEBLINKS_CONF_MAP_TEMPLATE','Template of Map Site');
	define('_AM_WEBLINKS_CONF_MAP_TEMPLATE_DESC','Enter template file name in template/map/ directory');

// google map
	define('_AM_WEBLINKS_CONF_GOOGLE_MAP','Google Maps Configration');
	define('_AM_WEBLINKS_CONF_GM_USE','Use Google Maps');
	define('_AM_WEBLINKS_CONF_GM_APIKEY','Google Maps API key');
	define('_AM_WEBLINKS_CONF_GM_APIKEY_DESC', 'Get the API key on <br/> <a href="http://www.google.com/apis/maps/signup.html" target="_blank">http://www.google.com/apis/maps/signup.html</a> <br/> When you use GoogleMaps.' );
	define('_AM_WEBLINKS_CONF_GM_SERVER','Server Name');
	define('_AM_WEBLINKS_CONF_GM_LANG',  'Language Code');
	define('_AM_WEBLINKS_CONF_GM_LOCATION', 'default Location');
	define('_AM_WEBLINKS_CONF_GM_LATITUDE', 'default Latitude');
	define('_AM_WEBLINKS_CONF_GM_LONGITUDE','default Longitude');
	define('_AM_WEBLINKS_CONF_GM_ZOOM',     'default Zoom Level');

// google search
	define('_AM_WEBLINKS_CONF_GOOGLE_SEARCH','Google Search Confiration');
	define('_AM_WEBLINKS_CONF_GOOGLE_SERVER','Server Name');
	define('_AM_WEBLINKS_CONF_GOOGLE_LANG',  'Language Code');

// template
	define('_AM_WEBLINKS_CONF_TEMPLATE','Clear cache of Templates');
	define('_AM_WEBLINKS_CONF_TEMPLATE_DESC','MUST execute, when change template files in template/xml/ and template/map/ directory');

}


//---------------------------------------------------------
// compatible for v1.0x
//---------------------------------------------------------
// main
if( !defined('_WEBLINKS_OPTIONS') ) 
{
//	define('_HOME',  'Home');
//	define('_SAVE',  'Save');
//	define('_SAVED', 'Saved');
//	define('_CREATE', 'Create');
//	define('_CREATED','Created');
//	define('_FINISH',   'Finish');
//	define('_FINISHED', 'Finished');
//	define('_EXECUTE', 'Execute');
//	define('_EXECUTED','Executed');
//	define('_PRINT','Print');
//	define('_SAMPLE','Sample');

	define('_NO_MATCH_RECORD','There are no matched record');
	define('_MANY_MATCH_RECORD','There are two or more matched records');
	define('_NO_CATEGORY', 'No Category');	
	define('_NO_LINK', 'No Link');
	define('_NO_TITLE', 'No Title');
	define('_NO_URL', 'No URL');
	define('_NO_DESCRIPTION','No Description');

//	define('_GOTO_MAIN',   'Goto Main');
//	define('_GOTO_MODULE', 'Goto Module');

// config
//	define('_WEBLINKS_INIT_NOT', 'The config table is not initialized');
//	define('_WEBLINKS_INIT_EXEC', 'Initialized the config table');
//	define('_WEBLINKS_VERSION_NOT','It is not version  %s');
//	define('_WEBLINKS_UPGRADE_EXEC','Upgrad the config table');

// html tag
	define('_WEBLINKS_OPTIONS', 'Options');
	define('_WEBLINKS_DOHTML', ' Enable HTML tags');
	define('_WEBLINKS_DOIMAGE', ' Enable images');
	define('_WEBLINKS_DOBREAK', ' Enable linebreak');
	define('_WEBLINKS_DOSMILEY', ' Enable smiley icons');
	define('_WEBLINKS_DOXCODE', ' Enable XOOPS codes');

	define('_WEBLINKS_PASSWORD_INCORRECT','Incorrect Password');
	define('_WEBLINKS_ETC', 'etc');
	define('_WEBLINKS_AUTH_UID',    'User ID Match');
	define('_WEBLINKS_AUTH_PASSWD', 'Password Match');
	define('_WEBLINKS_BANNER_SIZE', 'Banner Size');

}

// admin
if( !defined('_AM_WEBLINKS_ADD_CATEGORY') ) 
{
// category
	define('_AM_WEBLINKS_ADD_CATEGORY', 'Add New Category');
	define('_AM_WEBLINKS_ERROR_SOME', 'There are some error messages');
	define('_AM_WEBLINKS_LIST_ID_ASC',  'Listed by Old ID');
	define('_AM_WEBLINKS_LIST_ID_DESC', 'Listed by New ID');

// config
	define('_AM_WEBLINKS_WARNING_NOT_WRITABLE','Not writable the directory');
	define('_AM_WEBLINKS_CONF_LINK','Link Configration');
	define('_AM_WEBLINKS_CONF_LINK_IMAGE','Link Image Configration');
	define('_AM_WEBLINKS_CONF_VIEW','View Configration');
	define('_AM_WEBLINKS_CONF_TOPTEN','TopTen Configration');
	define('_AM_WEBLINKS_CONF_SEARCH','Seach Configration');
	define('_AM_WEBLINKS_USE_BROKENLINK','Use to report a broken link');
	define('_AM_WEBLINKS_USE_BROKENLINK_DSC','When select YES, <br />enable to report a broken link');
	define('_AM_WEBLINKS_USE_HITS','Use to countup a link');
	define('_AM_WEBLINKS_USE_HITS_DSC','When select YES, <br />enable to countup a link visit counter');
	define('_AM_WEBLINKS_USE_PASSWD','Password authentication');
	define('_AM_WEBLINKS_USE_PASSWD_DSC','When select YES, <br /><b>anoymous user</b> can modify a link with password authentication.<br />When select NO, <br />password filed is not displayed.');
	define('_AM_WEBLINKS_PASSWD_MIN','Minimum length of password required');
	define('_AM_WEBLINKS_POST_TEXT', 'The administrator has all management authority');
	define('_AM_WEBLINKS_AUTH_DOHTML', 'Authority to use HTML tags');
	define('_AM_WEBLINKS_AUTH_DOHTML_DSC', 'Specify the group which can grant the authority to use HTML tags');
	define('_AM_WEBLINKS_AUTH_DOSMILEY', 'Authority to use smiley icons');
	define('_AM_WEBLINKS_AUTH_DOSMILEY_DSC', 'Specify the group which can grant the authority to use smiley icons');
	define('_AM_WEBLINKS_AUTH_DOXCODE', 'Authority to use XOOPS codes');
	define('_AM_WEBLINKS_AUTH_DOXCODE_DSC', 'Specify the group which can grant the authority to use XOOPS codes');
	define('_AM_WEBLINKS_AUTH_DOIMAGE', 'Authority to use images');
	define('_AM_WEBLINKS_AUTH_DOIMAGE_DSC', 'Specify the group which can grant the authority to use images');
	define('_AM_WEBLINKS_AUTH_DOBR', 'Authority to use linebreak');
	define('_AM_WEBLINKS_AUTH_DOBR_DSC', 'Specify the group which can grant the authority to use linebreak');
	define('_AM_WEBLINKS_SHOW_CATLIST','Show category list in submenu');
	define('_AM_WEBLINKS_SHOW_CATLIST_DSC','When select YES, <br />show top category list in submenu');
	define('_AM_WEBLINKS_VIEW_URL','URL view style');
	define('_AM_WEBLINKS_VIEW_URL_DSC','When select "none", <br />not display url and &lt;a&gt; tag.<br />When select "indirect", <br />display visit.php in href field instead of URL. <br />When select "direct", <br />display url in href field, JavaScript in onmousedown field and hits is counted via JavaScript.');
	define('_AM_WEBLINKS_VIEW_URL_0','none');
	define('_AM_WEBLINKS_VIEW_URL_1','indirect url');
	define('_AM_WEBLINKS_VIEW_URL_2','direct url');
	define('_AM_WEBLINKS_RECOMMEND_PRI','Priority of recommend site');
	define('_AM_WEBLINKS_RECOMMEND_PRI_DSC','When select "none", <br />not display.<br />When select "normal", <br />display in header.<br />When select "higher", <br />display on higher rank in each category.');
	define('_AM_WEBLINKS_MUTUAL_PRI','Priority of reciprocal site');
	define('_AM_WEBLINKS_MUTUAL_PRI_DSC','When select "none", <br />not display.<br />When select "normal", <br />display in header.<br />When select "higher", <br />display on higher rank in each category.');
	define('_AM_WEBLINKS_PRI_0','none');
	define('_AM_WEBLINKS_PRI_1','normal');
	define('_AM_WEBLINKS_PRI_2','higher');
	define('_AM_WEBLINKS_LINK_IMAGE_AUTO','Auto update of Banner image size');
	define('_AM_WEBLINKS_LINK_IMAGE_AUTO_DSC', "When select YES, <br />update Banner image size automatically, when show a link list or a link detail information, if Banner image size is not able to get at registration and change link information.");
	define('_AM_WEBLINKS_RSS_USE','Use RSS feed');
	define('_AM_WEBLINKS_RSS_USE_DSC','When select YES, <br />get and display RSS/ATOM feed.');

// bulk import
	define('_AM_WEBLINKS_BULK_IMPORT','Bulk Import');
	define('_AM_WEBLINKS_BULK_IMPORT_FILE','Bulk Import by File');
	define('_AM_WEBLINKS_BULK_CAT','Bulk Import of Categories');
	define('_AM_WEBLINKS_BULK_CAT_DSC1','Describe categories');
	define('_AM_WEBLINKS_BULK_CAT_DSC2','Describe a child category with a left arrow parenthesis (>) at the head of the line.');
	define('_AM_WEBLINKS_BULK_LINK','Bulk Import of Links');
	define('_AM_WEBLINKS_BULK_LINK_DSC1', 'Describe a category at the 1st line.');
	define('_AM_WEBLINKS_BULK_LINK_DSC2', 'Describe title, URL, and explanation which are divided by comma(,) at after the 2nd line.');
	define('_AM_WEBLINKS_BULK_LINK_DSC3', 'It can specify repeatedly, when describe horizontal bar (---) .');
	define('_AM_WEBLINKS_BULK_ERROR_LAYER','Specified two or more under layers at the category tree structure.');
	define('_AM_WEBLINKS_BULK_ERROR_CID','Wrong category ID');
	define('_AM_WEBLINKS_BULK_ERROR_PID','Wrong parent category ID');
	define('_AM_WEBLINKS_BULK_ERROR_FINISH','Finished by the error');

// command
	define('_AM_WEBLINKS_CREATE_CONFIG', 'Create Config File');
	define('_AM_WEBLINKS_TEST_EXEC', 'Test execute for %s');

}

// these words are added in v1.01 
// rename MI_xx to AM_xx
if( !defined('_AM_WEBLINKS_INDEX_DESC') ) 
{
	define('_AM_WEBLINKS_INDEX_DESC','Description at Main page');
	define('_AM_WEBLINKS_INDEX_DESC_DSC', 'Enter description note, when you want to display at a main page.');
	define('_AM_WEBLINKS_INDEX_DESC_DEFAULT', '<div align="center" style="color: #0000ff">Here are description note.<br />You can edit description note at "Module Configuration 2".<br /></div>');
}

// these words are defined in admin.php 
// use for linkitem_define
if( !defined('_WEBLINKS_MID') ) 
{
	define('_WEBLINKS_MID','Modify ID');
	define('_WEBLINKS_USERID','User ID');
	define('_WEBLINKS_CREATE','Created');
}

// these words are NOT defined in xoops 2.2.3 english
if( !defined('_US_PASSWORD') ) 
{
	define('_US_PASSWORD','Password');
	define('_US_TYPEPASSTWICE','(type a new password twice to change it)');
	define('_US_PASSNOTSAME','Both passwords are different. They must be identical.');
	define('_US_PWDTOOSHORT','Sorry, your password must be at least <b>%s</b> characters long.');
	define('_US_VERIFYPASS','Verify Password');
}

?>