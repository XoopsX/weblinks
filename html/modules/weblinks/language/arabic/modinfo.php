<?php
// $Id: modinfo.php,v 1.1 2011/12/29 14:32:44 ohwada Exp $

// 2007-12-09
// remove _MI_WEBLINKS_LINK_APPROVE_NOTIFYSBJ

// 2007-09-01
// notification: new_link_admin

// 2007-08-25
// small change _MI_WEBLINKS_GLOBAL_LINKSUBMIT_NOTIFY

// 2007-04-08
// _MI_WEBLINKS_BNAME_RANDOM_IMAGE

// 2006-11-03 hiro
// random block

// 2006-05-15 K.OHWADA
// weblinks ver 1.1
// add _MI_WEBLINKS_ADMENU0

// 2006-03-26 K.OHWADA
// REQ 3807: Description in main page
// _MI_WEBLINKS_INDEX_DESC

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication

//=========================================================
// WebLinks Module
// language for Module Info
// 2004-10-24 K.OHWADA
//=========================================================

// --- define language begin ---
if( !defined('WEBLINKS_LANG_MI_LOADED') )
{

define('WEBLINKS_LANG_MI_LOADED', 1);

//---------------------------------------------------------
// same as mylinks
//---------------------------------------------------------
// The name of this module
define("_MI_WEBLINKS_NAME","Ïáíá ÇáãæÇÞÚ");

// A brief description of this module
define("_MI_WEBLINKS_DESC","ÇäÔÇÁ Ïáíá ãæÇÞÚ Ýí ãæÞÚß íãßä ÇÚÖÇÁ æÒæÇÑ ãæÞÚß Ýí ÇáÈÍË æÊÞííã ÇáãæÇÞÚ ÈäÓÈ ãÎÊáÝÉ , æíãßäß ÇíÖÇ ãä ÊÈÇÏá ÇáÇÚáÇäÇÊ æÇáÑæÇÈØ Èíä ÇáãæÇÞÚ.");

// Names of blocks for this module (Not all module have blocks)
define("_MI_WEBLINKS_BNAME1","ÂÎÑ ÇáãæÇÞÚ");
define("_MI_WEBLINKS_BNAME2","ÃÝÖá ÇáãæÇÞÚ");
define("_MI_WEBLINKS_BNAME3","ÇáãæÇÞÚ ÇáÃßËÑ ÒíÇÑÉ");

// Sub menu titles
define("_MI_WEBLINKS_SMNAME1","ÃÑÓá ãæÞÚ");
define("_MI_WEBLINKS_SMNAME2","ÇáãæÇÞÚ ÇáÃßËÑ ÒíÇÑÉ");
define("_MI_WEBLINKS_SMNAME3","ÃÝÖá ÇáãæÇÞÚ ÊÞííã");

// Names of admin menu items
define("_MI_WEBLINKS_ADMENU1","ÎíÇÑÇÊ ÇáÈÑäÇãÌ 2");
define("_MI_WEBLINKS_ADMENU2","ÅÏÇÑÉ ÇáÃÞÓÇã");
define("_MI_WEBLINKS_ADMENU3","ÅÏÇÑÉ ÇáÑæÇÈØ");
define("_MI_WEBLINKS_ADMENU4","ÃÖÝ ÑÇÈØ ÌÏíÏ");
define("_MI_WEBLINKS_ADMENU5","ÑæÇÈØ ÌÏíÏÉ ÊäÊÙÑ ÇáãæÇÝÞÉ");
define("_MI_WEBLINKS_ADMENU6","ÑæÇÈØ ãÚÏáÉ ÊäÊÙÑ ÇáãæÇÝÞÉ");
define("_MI_WEBLINKS_ADMENU7","ÊÞÇÑíÑ ÑæÇÈØ áÇ ÊÚãá");
//define("_MI_WEBLINKS_ADMENU8","Link Checker");

//-------------------------------------
// Title of config items
// Description of each config items
//-------------------------------------
define('_MI_WEBLINKS_POPULAR', 'ÅÎÊÑ ÚÏÏ ÇáÒíÇÑÇÊ ááÑæÇÈØ ÇáÊí ÓÊÄÔÑ (ÃßËÑ ÒíÇÑÉ).');
define('_MI_WEBLINKS_POPULARDSC', 'ÅÏÎá ÇáÚÏÏ ÇáÃÏäì ááÒíÇÑÇÊ áÊÙåÑ ÃíÞæäÉ "ÃßËÑ ÒíÇÑÉ". <br /> ÅÐÇ ßÇäÊ ÇáÞíãÉ 0¡ áä ÊÙåÑ ÇáÃíÞæäÉ. ');
define('_MI_WEBLINKS_NEWLINKS', 'ÅÏÎá ÇáÍÏ ÇáÃÞÕì ááÑæÇÈØ ÇáÊí ÓÊÚÑÖ Ýí ÃÚáì ÇáÕÝÍÉ.');

//define('_MI_WEBLINKS_NEWLINKSDSC', 'Enter the maximum number of links to be displayed in the "New Links" block. ');
define('_MI_WEBLINKS_NEWLINKSDSC', 'ÅÏÎá ÇáÍÏ ÇáÃÞÕì ááÑæÇÈØ ÇáÊí ÓÊÚÑÖ Ýí ÇáÕÝÍÉ ÇáÑÆíÓíÉ. ');

define('_MI_WEBLINKS_PERPAGE', 'ÅÏÎá ÇáÍÏ ÇáÃÞÕì ááÑæÇÈØ ÇáÊí ÓÊÚÑÖ Ýí ßá ÕÝÍÉ.');
define('_MI_WEBLINKS_PERPAGEDSC', 'ÅÏÎá ÇáÍÏ ÇáÃÞÕì ááÑæÇÈØ ÇáÊí ÓÊÚÑÖ Ýí ßá ÕÝÍÉ ãÚ ÇáæÕÝ');

//define('_MI_WEBLINKS_USESHOTS', 'Select yes to display screenshot images for each link');
//define('_MI_WEBLINKS_USESHOTSDSC', '');
//define('_MI_WEBLINKS_SHOTWIDTH', 'Maximum allowed width of each screenshot image');
//define('_MI_WEBLINKS_SHOTWIDTHDSC', '');

//define('_MI_WEBLINKS_ANONPOST','Allow anonymous users to post links?');
//define('_MI_WEBLINKS_AUTOAPPROVE','Auto approve new links without admin intervention?');
//define('_MI_WEBLINKS_AUTOAPPROVEDSC','');

//-------------------------------------
// Text for notifications
//-------------------------------------
define('_MI_WEBLINKS_GLOBAL_NOTIFY', 'ÇáÚÇã');
define('_MI_WEBLINKS_GLOBAL_NOTIFYDSC', 'ÎíÇÑÇÊ ÊÈáíÛÇÊ ÇáÑæÇÈØ ÇáÚÇãÉ.');

define('_MI_WEBLINKS_CATEGORY_NOTIFY', 'ÇáÞÓã');
define('_MI_WEBLINKS_CATEGORY_NOTIFYDSC', 'ÎíÇÑÇÊ ÇáÊÈáíÛÇÊ ÇáÊí ÊÞÏã Åáì ÞÓã ÇáÑÇÈØ ÇáÍÇáí.');

define('_MI_WEBLINKS_LINK_NOTIFY', 'ÑÇÈØ');
define('_MI_WEBLINKS_LINK_NOTIFYDSC', 'ÎíÇÑÇÊ ÇáÊÈáíÛÇÊ ÇáÊí ÊÞÏã Åáì ÇáÑÇÈØ ÇáÍÇáí.');

define('_MI_WEBLINKS_GLOBAL_NEWCATEGORY_NOTIFY', 'ÞÓã ÌÏíÏ');
define('_MI_WEBLINKS_GLOBAL_NEWCATEGORY_NOTIFYCAP', 'ÊÈáíÛí Ýí ÍÇáÉ ÇäÔÇÁ ÞÓã ÌÏíÏ.');
define('_MI_WEBLINKS_GLOBAL_NEWCATEGORY_NOTIFYDSC', 'ÇÓÊÞÈÇá ÊÈáíÛ Ýí ÍÇáÉ ÇäÔÇÁ ÞÓã ÌÏíÏ.');
define('_MI_WEBLINKS_GLOBAL_NEWCATEGORY_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} ÊÈáíÛ Âáí : ÞÓã ÌÏíÏ');

define('_MI_WEBLINKS_GLOBAL_LINKMODIFY_NOTIFY', '[ÇáÃÏãä] ØáÈ ÊÚÏíá / ÍÐÝ ÑÇÈØ .');
define('_MI_WEBLINKS_GLOBAL_LINKMODIFY_NOTIFYCAP', ' [ÇáÃÏãä] ÊÈáíÛí Ýí ÍÇáÉ ØáÈ ÊÚÏíá / ÍÐÝ ÑÇÈØ.');
define('_MI_WEBLINKS_GLOBAL_LINKMODIFY_NOTIFYDSC', 'ÅÓÊáÇã ÊÈáíÛ ÚäÏ Ãí ØáÈ ÊÚÏíá æÕáÉ / ÍÐÝ ãÞÏã.');
define('_MI_WEBLINKS_GLOBAL_LINKMODIFY_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} ÊÈáíÛ Âáí : ØáÈ ÊÚÏíá ÑÇÈØ / ÍÐÝ ');

define('_MI_WEBLINKS_GLOBAL_LINKBROKEN_NOTIFY', '[ÇáÃÏãä] ÇÓÊÞÈÇá ÑÇÈØ áÇ íÚãá.');
define('_MI_WEBLINKS_GLOBAL_LINKBROKEN_NOTIFYCAP', '[ÇáÃÏãä] ÊÈáíÛí Úä Ãí ÊÞÑíÑ ÑÇÈØ áÇ íÚãá.');
define('_MI_WEBLINKS_GLOBAL_LINKBROKEN_NOTIFYDSC', 'ÅÓÊáÇã ÊÈáíÛ ÚäÏ ÊÞÏíã Ãí ÊÞÑíÑ ÑÇÈØ áÇ íÚãá.');
define('_MI_WEBLINKS_GLOBAL_LINKBROKEN_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} ÊÈáíÛ Âáí : ÊÞÑíÑ ÑÇÈØ áÇ íÚãá.');

define('_MI_WEBLINKS_GLOBAL_LINKSUBMIT_NOTIFY', '[ÇáÃÏãä] æÕáÉ ÌÏíÏÉ ãÞÏãÉ.');
define('_MI_WEBLINKS_GLOBAL_LINKSUBMIT_NOTIFYCAP', '[ÇáÃÏãä] ÊÈáíÛí ÚäÏ ÇÑÓÇá ÑÇÈØ ÌÏíÏ (ÈÇäÊÙÇÑ ÇáãæÇÝÞÉ).');
define('_MI_WEBLINKS_GLOBAL_LINKSUBMIT_NOTIFYDSC', 'ÅÓÊáÇã ÊÈáíÛ ÚäÏ ÇÓÊÞÈÇá ÑÇÈØ ÌÏíÏ ãÞÏã (ÈÇäÊÙÇÑ ÇáãæÇÝÞÉ).');
define('_MI_WEBLINKS_GLOBAL_LINKSUBMIT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} ÊÈáíÛ Âáí : ÅÓÊáÇã ÑÇÈØ ÌÏíÏ.');

define('_MI_WEBLINKS_GLOBAL_NEWLINK_NOTIFY', 'ÑÇÈØ ÌÏíÏ');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_NOTIFYCAP', 'ÊÈáíÛí ÚäÏ ÅÖÇÝÉ ÑÇÈØ ÌÏíÏ.');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_NOTIFYDSC', 'ÅÓÊáÇã ÊÈáíÛ ÚäÏ ÅÖÇÝÉ ÑÇÈØ ÌÏíÏ.');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} ÊÈáíÛ Âáí : ÑÇÈØ ÌÏíÏ.');

define('_MI_WEBLINKS_CATEGORY_LINKSUBMIT_NOTIFY', '[ÇáÃÏãä] æÕáÉ ÌÏíÏÉ ãÞÏãÉ.');
define('_MI_WEBLINKS_CATEGORY_LINKSUBMIT_NOTIFYCAP', '[ÇáÃÏãä] ÊÈáíÛí ÚäÏ ÊÞÏíã ÑÇÈØ ÌÏíÏ (ÈÇäÊÙÇÑ ÇáãæÇÝÞÉ) Åáì ÇáÞÓã ÇáÍÇáí.');
define('_MI_WEBLINKS_CATEGORY_LINKSUBMIT_NOTIFYDSC', 'ÅÓÊáÇã ÊÈáíÛ ÚäÏ ÊÞÏíã ÑÇÈØ ÌÏíÏ (ÈÇäÊÙÇÑ ÇáãæÇÝÞÉ) Åáì ÇáÞÓã ÇáÍÇáí.');
define('_MI_WEBLINKS_CATEGORY_LINKSUBMIT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} ÊÈáíÛ Âáí : ÑÇÈØ ÌÏíÏ Ýí ÇáÞÓã.');

define('_MI_WEBLINKS_CATEGORY_NEWLINK_NOTIFY', 'ÑÇÈØ ÌÏíÏ');
define('_MI_WEBLINKS_CATEGORY_NEWLINK_NOTIFYCAP', 'ÊÈáíÛí ÚäÏ ÅÖÇÝÉ ÑÇÈØ ÌÏíÏ  Ýí ÇáÞÓã ÇáÍÇáí.');
define('_MI_WEBLINKS_CATEGORY_NEWLINK_NOTIFYDSC', 'ÅÓÊáÇã ÊÈáíÛ ÚäÏ ÅÖÇÝÉ ÑÇÈØ ÌÏíÏ  Ýí ÇáÞÓã ÇáÍÇáí.');
define('_MI_WEBLINKS_CATEGORY_NEWLINK_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} ÊÈáíÛ Âáí : ÑÇÈØ ÌÏíÏ Ýí ÇáÞÓã');

//define('_MI_WEBLINKS_LINK_APPROVE_NOTIFY', 'Link Approved');
//define('_MI_WEBLINKS_LINK_APPROVE_NOTIFYCAP', 'Notify me when this link is approved.');
//define('_MI_WEBLINKS_LINK_APPROVE_NOTIFYDSC', 'Receive notification when this link is approved.');
define('_MI_WEBLINKS_LINK_APPROVE_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} : ÊãÊ ÇáãæÇÝÞÉ Úáì ÑÇÈØ ãæÞÚß');


//---------------------------------------------------------
// weblinks
//---------------------------------------------------------
// === Names of blocks for this module ===
define("_MI_WEBLINKS_BNAME4","ÞÇÆãÉ ÇÞÓÇã ÇáãæÇÞÚ");
define("_MI_WEBLINKS_BNAME5","ÂÎÑ RSS/ATOM feeds ãä ÇáãæÇÞÚ");
define("_MI_WEBLINKS_BNAME6","ÚÑÖ ÇáÈáæÛ áÑÇÈØ ÇáãæÞÚ");

//-------------------------------------
// Title of config items
//-------------------------------------
define('_MI_WEBLINKS_LOGOSHOW','ÚÑÖ ÕæÑÉ ÇáÈÑäÇãÌ');
define('_MI_WEBLINKS_LOGOSHOWDSC', 'ÃÎÊÑ "äÚã" áÚÑÖ ÕæÑÉ ÇáÈÑäÇãÌ');

define('_MI_WEBLINKS_TITLESHOW','ÚÑÖ ÚäæÇä ÇáÈÑäÇãÌ');
define('_MI_WEBLINKS_TITLESHOWDSC', 'ÃÎÊÑ "äÚã" áÚÑÖ ÚäæÇä ÇáÈÑäÇãÌ');

define('_MI_WEBLINKS_NEWDAYS', 'ÅÎÊÑ ÚÏÏ ÇáÃíÇã ááÑæÇÈØ ÇáøÊí ÓÊÄÔøÑ ßÌÏíÏÉ');
define('_MI_WEBLINKS_NEWDAYS_DSC', 'ÅÏÎá ÚÏÏ ÇáÒíÇÑÇÊ áÚÑÖ ÇíÞæäÉ "ÌÏíÏÉ". <br /> ÅÐÇ 0¡ áä ÊÚÑÖ ÇáÃíÞæäÉ .');

define('_MI_WEBLINKS_DESCSHORT', 'ÇáÚÏÏ ÇáÃÞÕì ááÍÑæÝ ÇáãÓÊÎÏãÉ Ýí æÕÝ ÇáÑæÇÈØ');
define('_MI_WEBLINKS_DESCSHORTDSC', 'ÃÏÎá ÇáÚÏÏ ÇáÃÞÕì ááÍÑæÝ ÇáãÓÊÎÏãÉ Ýí æÕÝ ÇáÑæÇÈØ');

define('_MI_WEBLINKS_ORDERBY', 'ØÑíÞÉ ÚÑÖ ÇáÊÑÊíÈ ÇáÃÝÊÑÇÖíÉ');
define('_MI_WEBLINKS_ORDERBYDSC', 'ÃÏÎá ØÑíÞÉ ÚÑÖ ÇáÊÑÊíÈ ÇáÃÝÊÑÇÖíÉ .');
define("_MI_WEBLINKS_ORDERBY0","ÇáÚäæÇä (Ç Çáì í)");
define("_MI_WEBLINKS_ORDERBY1","ÇáÚäæÇä (í Çáì Ç)");
define("_MI_WEBLINKS_ORDERBY2","ÇáÊÇÑíÎ (ÊÓÌíá Ýí ÇáÊÑÊíÈ ÊÕÇÚÏíÇ)");
define("_MI_WEBLINKS_ORDERBY3","ÇáÊÇÑíÎ (ÊÓÌíá Ýí ÇáÊÑÊíÈ ÊäÇÒáíÇ)");
define("_MI_WEBLINKS_ORDERBY4","ÇáÊÞííã (ÊÑÊíÈ ÊÕÇÚÏí)");
define("_MI_WEBLINKS_ORDERBY5","ÇáÊÞííã (ÊÑÊíÈ ÊäÇÒáí)");
define("_MI_WEBLINKS_ORDERBY6","ÇáÃßËÑ ÒíÇÑÉ (ÊÑÊíÈ ÊÕÇÚÏí)");
define("_MI_WEBLINKS_ORDERBY7","ÇáÃßËÑ ÒíÇÑÉ (ÊÑÊíÈ ÊäÇÒáí)");

define('_MI_WEBLINKS_SEARCH_LINKS','ÚÏÏ ÇáÑæÇÈØ Ýí äÊÇÆÌ ÇáÈÍË');
define('_MI_WEBLINKS_SEARCH_LINKSDSC', 'ÇÏÎá  ÚÏÏ ÇáÑæÇÈØ Ýí äÊÇÆÌ ÇáÈÍË');

define('_MI_WEBLINKS_SEARCH_MIN', 'ÃÞá ÚÏÏ ãä ÇáÍÑæÝ Ýí ÇáßáãÉ Ýí ÇáÈÍË');
define('_MI_WEBLINKS_SEARCH_MINDSC', 'ÇÏÎá ÃÞá ÚÏÏ ãä ÇáÍÑæÝ Ýí ÇáßáãÉ Ýí ÇáÈÍË ');

define('_MI_WEBLINKS_USEFRAMES', 'åá ÊæÏ Ãä ÊÚÑÖ ÑÇÈØ ÇáÕÝÍÉ Öãä ÅØÇÑ ãæÞÚß ¿');
define('_MI_WEBLINKS_USEFRAMEDSC', 'ÃÎÊÑ "äÚã" ááÚÑÖ');

define('_MI_WEBLINKS_BROKEN','ÚÏÏ ÊÞÇÑíÑ ÇáÑæÇÈØ ÇáÊí áÇ ÊÚãá áÊæÞÝ ÚÑÖ ÇáãÒíÏ ãäåÇ');
define('_MI_WEBLINKS_BROKENDSC', 'ÇÏÎá ÚÏÏ ÊÞÇÑíÑ ÇáÑæÇÈØ ÇáÊí áÇ ÊÚãá áÊæÞÝ ÚÑÖ ÇáãÒíÏ ãäåÇ. <br /> When below this value, it will be regarded as a temporary error, and nothing will be done. <br />When over this value the link will no longer be displayed.');

define('_MI_WEBLINKS_LISTIMAGE_USE','ÚÑÖ ÕæÑÉ ÇáãæÞÚ Ýí ÇáÕÝÍÉ ÇáÑÆíÓíÉ ááÈÑäÇãÌ');
define('_MI_WEBLINKS_LISTIMAGE_WIDTH','ÇÞÕì ÚÑÖ ááÕæÑÉ');
define('_MI_WEBLINKS_LISTIMAGE_HEIGHT','ÇÞÕì Øæá ááÕæÑÉ');
define('_MI_WEBLINKS_LISTIMAGE_USEDSC', 'ÃÎÊÑ "äÚã" áÚÑÖ ÕæÑÉ ÇáãæÞÚ Ýí ÇáÕÝÍÉ ÇáÑÆíÓíÉ ááÈÑäÇãÌ');

define('_MI_WEBLINKS_LINKIMAGE_USE','ÚÑÖ ÕæÑÉ ÇáãæÞÚ ÏÇÎá ÇáÞÓã');
define('_MI_WEBLINKS_LINKIMAGE_WIDTH','ÇÞÕì ÚÑÖ ááÕæÑÉ');
define('_MI_WEBLINKS_LINKIMAGE_HEIGHT','ÇÞÕì Øæá ááÕæÑÉ');
define('_MI_WEBLINKS_LINKIMAGE_USEDSC', 'ÃÎÊÑ "äÚã" áÚÑÖ ÕæÑÉ ÇáãæÞÚ ÏÇÎá ÇáÞÓã');

// 2005-10-20 K.OHWADA
define('_MI_WEBLINKS_TOPTEN_STYLE','ØÑíÞÉ ÚÑÖ ÇáÚÔÑ ÇáÃæÇÆá');
define('_MI_WEBLINKS_TOPTEN_STYLE_DSC', 'ÃÎÊÑ ØÑíÞÉ ÇáÚÑÖ Ýí "ÇáãæÇÞÚ ÇáÃßËÑ ÒíÇÑÉ "æ" ÇáãæÇÞÚ ÇáÃßËÑ ÊÞííã".');
define('_MI_WEBLINKS_TOPTEN_STYLE_0','ßá ÞÓã æÃÝÖá ÚÔÑ');
define('_MI_WEBLINKS_TOPTEN_STYLE_1','ãä ÌãíÚ ÇáÃÞÓÇã');

define('_MI_WEBLINKS_TOPTEN_LINKS', 'ÃÞÕì ÚÏÏ ãä ÇáãæÇÞÚ Ýí ÇáÚÔÑ ÇáÃæÇÆá');
define('_MI_WEBLINKS_TOPTEN_LINKS_DSC', 'ÇßÊÈ ÇáÚÏÏ ÇáÃÞÕì ááãæÇÞÚ ÇáÊí ÓÊÚÑÖ Ýí "ÇáÃßËÑ ÒíÇÑÉ "æ" ÃÝÖá ÊÞííã".');

define('_MI_WEBLINKS_TOPTEN_CATS','ÃÞÕì ÚÏÏ ãä ÇáÃÞÓÇã Ýí ÇáÚÔÑ ÇáÃæÇÆá');
define('_MI_WEBLINKS_TOPTEN_CATS_DSC', 'ÅÏÎá ÇáÚÏÏ ÇáÃÞÕì ááÃÞÓÇã ÇáÊí ÓÊÚÑÖ Ýí"ÇáãæÇÞÚ ÇáÃßËÑ ÒíÇÑÉ "æ"ÇáãæÇÞÚ ÃÝÖá ÊÞííã". <br /> ÇäÊåÇÁ ÇáæÞÊ ããßä íÍÏË¡ ÅÐÇ ßÇä åäÇß ÇÞÓÇã ÑÆíÓíÉ ãÍÏÏå.');

// 2006-03-26
// REQ 3807: Main Page Introductory Text
//define('_MI_WEBLINKS_INDEX_DESC','Main Page Introductory Text');
//define('_MI_WEBLINKS_INDEX_DESC_DSC', 'You can use this section to display some descriptive or introductory text. HTML is allowed.');
//define('_MI_WEBLINKS_INDEX_DESC_DEFAULT', '<div align="center"><font color="blue">Here is where your page introduction goes.<br />You can edit it at "Module Configuration 2".</font><br /></div>');

// 2006-05-15
define('_MI_WEBLINKS_ADMENU0', 'ÇáÑÆíÓíÉ');

// 2006-11-03
// random block
define('_MI_WEBLINKS_BNAME_RANDOM',  'ãæÞÚ ÚÔæÇÆí');
define('_MI_WEBLINKS_BNAME_GENERIC', 'Genric Link Block');

// 2007-04-08
define('_MI_WEBLINKS_BNAME_RANDOM_PHOTO', 'ÕæÑÉ ÚÔæÇÆíÉ');

// 2007-09-01
// notification: new_link_admin
define('_MI_WEBLINKS_GLOBAL_NEWLINK_ADMIN', '[ÇáÃÏãä] ÑÇÈØ ÌÏíÏ (ãÚ ÇáÊÚáíÞ ááÃÏãä) .');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_ADMIN_CAP', '[ÇáÃÏãä] ÊÈáíÛí Úä Ãí ÑÇÈØ ÌÏíÏ ãÑÓá (ãÚ ÇáÊÚáíÞ¡ ááÃÏãä) .');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_ADMIN_DSC', 'ÅÓÊáÇã ÊÈáíÛ Úä Ãí ÑÇÈØ ÌÏíÏ ãÑÓá (ãÚ ÇáÊÚáíÞ¡ ááÃÏãä) .');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_ADMIN_SBJ', '[{X_SITENAME}] {X_MODULE} ÊÈáíÛ Âáí : ÑÇÈØ ÌÏíÏ');

// notification: new_link_comment
define('_MI_WEBLINKS_GLOBAL_NEWLINK_COMMENT', '[ÇáÃÏãä] ÑÇÈØ ÌÏíÏ (ÅÐÇ ÏÎá ÇáÊÚáíÞ ÇáÃÏãä) .');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_COMMENT_CAP', '[ÇáÃÏãä] ÊÈáíÛí ÚäÏ ÅÖÇÝÉ ÑÇÈØ ÌÏíÏ (ÅÐÇ ÏÎá ÇáÊÚáíÞ¡ ÇáÃÏãä).');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_COMMENT_DSC', 'ÅÓÊáÇã ÊÚáíÞ ÚäÏ ÅÖÇÝÉ ÑÇÈØ ÌÏíÏ (ÅÐÇ ÏÎá ÇáÊÚáíÞ¡ ÇáÃÏãä)');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_COMMENT_SBJ', '[{X_SITENAME}] {X_MODULE} ÊÈáíÛ Âáí : ÑÇÈØ ÌÏíÏ)');

}
// --- define language begin ---

?>