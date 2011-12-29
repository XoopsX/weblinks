<?php
// $Id: blocks.php,v 1.1 2011/12/29 14:32:48 ohwada Exp $

// 2008-02-17 K.OHWADA
// _MB_WEBLINKS_GM_CONTROL

// 2007-10-10 K.OHWADA
// _MB_WEBLINKS_GM_MARKER_WIDTH

// 2007-08-01 K.OHWADA
// _MB_WEBLINKS_CAT_TITLE_LENGTH

// 2007-04-08
// _MB_WEBLINKS_PHOTOS

// 2007-03-25 K.OHWADA
// google map

// 2006-11-03 hiro
// random block

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication

//=========================================================
// WebLinks Module
// language for Blocks
//=========================================================

// --- define language begin ---
if( !defined('WEBLINKS_LANG_BL_LOADED') ) 
{

define('WEBLINKS_LANG_BL_LOADED', 1);
// top.html
define("_MB_WEBLINKS_DISP","Display");
define("_MB_WEBLINKS_LINKS","Links");
define("_MB_WEBLINKS_CHARS","Length of the title");
define("_MB_WEBLINKS_LENGTH"," Characters");
define("_MB_WEBLINKS_NEWDAYS","Days of new link");
define("_MB_WEBLINKS_DAYS"," Days");
define("_MB_WEBLINKS_POPULAR","Hits of popular link");
define("_MB_WEBLINKS_HITS"," Hits");
define("_MB_WEBLINKS_PIXEL"," Pixel");
define("_MB_WEBLINKS_RATING","Rating");
define("_MB_WEBLINKS_VOTES","Votes");
define("_MB_WEBLINKS_COMMENTS","Comments");

// catlist.html
define('_MB_WEBLINKS_TOTAL_LINKS',"Total");
define("_MB_WEBLINKS_IMAGE_MODE","Select category image");
define("_MB_WEBLINKS_IMAGE_MODE_0","NONE");
define("_MB_WEBLINKS_IMAGE_MODE_1","folder.gif");
define("_MB_WEBLINKS_IMAGE_MODE_2","Setting Image");
define('_MB_WEBLINKS_MAX_WIDTH',"Max width of image");
define('_MB_WEBLINKS_WIDTH_DEFAULT',"Default width of image");
define("_MB_WEBLINKS_DISPSUB","Max number of subcatgories");

// atom feed
define("_MB_WEBLINKS_NUM_FEED","Number of feeds");
define("_MB_WEBLINKS_NUM_TITLE","Length of the title");
define("_MB_WEBLINKS_NUM_SUMMARY","Length of the summary");
define("_MB_WEBLINKS_NUM_CONTENT","Number of feeds which display content");
define("_MB_WEBLINKS_LINK_ID","Link ID");
define("_MB_WEBLINKS_NO_LINK_ID","You forgot to inputt the link ID");
define("_MB_WEBLINKS_NO_ATOMFEED","There is no corresponding feed");
define("_MB_WEBLINKS_MORE","More Details");

// 2006-11-03
// random block
define('_MB_WEBLINKS_MAX_DESC','Max length of the descrption');
define('_MB_WEBLINKS_SHOW_DATE', 'Showing date');
define('_MB_WEBLINKS_MODE_URL','Showing style of URL');
define('_MB_WEBLINKS_MODE_URL_SINGLE','singlelink.php');
define('_MB_WEBLINKS_MODE_URL_VISIT','visit.php');
define('_MB_WEBLINKS_MODE_URL_DIRECT','Showing URL directly');
define('_MB_WEBLINKS_URL_EMPTY','Empty URL');
define('_MB_WEBLINKS_URL_EMPTY_INCLUDE','Include empty URL');
define('_MB_WEBLINKS_URL_EMPTY_EXCLUDE','Exclude empty URL');
define('_MB_WEBLINKS_CATEGORY','Category');
define('_MB_WEBLINKS_WITH_SUBCAT','With sub categories');
define('_MB_WEBLINKS_MODE','Link Mode');
define('_MB_WEBLINKS_RECOMMEND','Recommned site');
define('_MB_WEBLINKS_MUTUAL','Reciprocal site');
define('_MB_WEBLINKS_RANDOM','Random sort');
define('_MB_WEBLINKS_ORDER','Order');
define('_MB_WEBLINKS_ORDER_DESC','Valid when "Random sort" is No');
define('_MB_WEBLINKS_TIME_UPDATE','Time update');
define('_MB_WEBLINKS_TIME_CREATE','Time create');
define('_MB_WEBLINKS_TITLE','Title');
define('_MB_WEBLINKS_ASC', 'Ascent');
define('_MB_WEBLINKS_DESC','Decent');

// === 2007-03-25 ===
// google map
define('_MB_WEBLINKS_GM_MODE','GoogleMap Mode');
define('_MB_WEBLINKS_GM_MODE_DSC','0:Not show, 1:Default, 2:Following value');
define('_MB_WEBLINKS_GM_LATITUDE','Latitude');
define('_MB_WEBLINKS_GM_LONGITUDE','Longitude');
define('_MB_WEBLINKS_GM_ZOOM','Zoom');
define('_MB_WEBLINKS_GM_HEIGHT','Height of Map size');
define('_MB_WEBLINKS_GM_TIMEOUT','Delay time for drawing');
define('_MB_WEBLINKS_GM_TIMEOUT_DSC','msec  -1:window.onload');

// 2007-04-08
define('_MB_WEBLINKS_PHOTOS', 'Number of Photos');

// === 2007-08-01 ===
define('_MB_WEBLINKS_CAT_TITLE_LENGTH','Length of Category Title');
define('_MB_WEBLINKS_GM_DESC_LENGTH','Length of Content in map marker');
define('_MB_WEBLINKS_GM_WORDWRAP','Length of wordwrap in map marker');

// === 2007-10-10 ===
define('_MB_WEBLINKS_GM_MARKER_WIDTH','Width of map marker');

// === 2008-02-17 ===
define('_MB_WEBLINKS_GM_CONTROL','Map Control');
define('_MB_WEBLINKS_GM_CONTROL_DSC','0:Not show, 1:Show');
define('_MB_WEBLINKS_GM_TYPE_CONTROL','Map Type Control');

}
// --- define language end ---

?>