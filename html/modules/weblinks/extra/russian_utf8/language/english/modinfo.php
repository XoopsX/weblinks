<?php
// $Id: modinfo.php,v 1.1 2012/04/09 10:21:09 ohwada Exp $

// 2008-02-17
// remove _MI_WEBLINKS_SMNAME1

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
define("_MI_WEBLINKS_NAME","Web Links");

// A brief description of this module
define("_MI_WEBLINKS_DESC","Creates a web links directory where users can search/submit/rate various web sites.");

// Names of blocks for this module (Not all module have blocks)
define("_MI_WEBLINKS_BNAME1","Recent Links");
define("_MI_WEBLINKS_BNAME2","Top Links");
define("_MI_WEBLINKS_BNAME3","Popular Links");

// Sub menu titles
//define("_MI_WEBLINKS_SMNAME1","Submit");
//define("_MI_WEBLINKS_SMNAME2","Popular Site");
//define("_MI_WEBLINKS_SMNAME3","Top Rated Site");

// Names of admin menu items
define("_MI_WEBLINKS_ADMENU1","Module Configuration 2");
define("_MI_WEBLINKS_ADMENU2","Category Management");
define("_MI_WEBLINKS_ADMENU3","Link Management");
define("_MI_WEBLINKS_ADMENU4","Add New Link");
define("_MI_WEBLINKS_ADMENU5","New Links Waiting for Validation");
define("_MI_WEBLINKS_ADMENU6","Modified Links Waiting for Validation");
define("_MI_WEBLINKS_ADMENU7","Broken Link Reports");
//define("_MI_WEBLINKS_ADMENU8","Link Checker");

//-------------------------------------
// Title of config items
// Description of each config items
//-------------------------------------
define('_MI_WEBLINKS_POPULAR', 'Select the number of hits for links to be marked as popular');
define('_MI_WEBLINKS_POPULARDSC', 'Enter the minimum number of hits to show "POPULAR" icon. <br />  If 0, no icon is shown. ');
define('_MI_WEBLINKS_NEWLINKS', 'Select the maximum number of new links displayed on top page');

//define('_MI_WEBLINKS_NEWLINKSDSC', 'Enter the maximum number of links to be displayed in the "New Links" block. ');
define('_MI_WEBLINKS_NEWLINKSDSC', 'Enter the maximum number of links to be displayed in the Main page. ');

define('_MI_WEBLINKS_PERPAGE', 'Select the maximum number of links displayed in each page');
define('_MI_WEBLINKS_PERPAGEDSC', 'Enter the maximum number of links to be shown with details per page');

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
define('_MI_WEBLINKS_GLOBAL_NOTIFY', 'Global');
define('_MI_WEBLINKS_GLOBAL_NOTIFYDSC', 'Global links notification options.');

define('_MI_WEBLINKS_CATEGORY_NOTIFY', 'Category');
define('_MI_WEBLINKS_CATEGORY_NOTIFYDSC', 'Notification options that apply to the current link category.');

define('_MI_WEBLINKS_LINK_NOTIFY', 'Link');
define('_MI_WEBLINKS_LINK_NOTIFYDSC', 'Notification options that aply to the current link.');

define('_MI_WEBLINKS_GLOBAL_NEWCATEGORY_NOTIFY', 'New Category');
define('_MI_WEBLINKS_GLOBAL_NEWCATEGORY_NOTIFYCAP', 'Notify me when a new link category is created.');
define('_MI_WEBLINKS_GLOBAL_NEWCATEGORY_NOTIFYDSC', 'Receive notification when a new link category is created.');
define('_MI_WEBLINKS_GLOBAL_NEWCATEGORY_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : New link category');

define('_MI_WEBLINKS_GLOBAL_LINKMODIFY_NOTIFY', '[Admin] Modify / Delete Link Requested');
define('_MI_WEBLINKS_GLOBAL_LINKMODIFY_NOTIFYCAP', '[Admin] Notify me of any link modification / deletion request.');
define('_MI_WEBLINKS_GLOBAL_LINKMODIFY_NOTIFYDSC', 'Receive notification when any link modification / deletion request is submitted.');
define('_MI_WEBLINKS_GLOBAL_LINKMODIFY_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : Link Modification / deletion Requested');

define('_MI_WEBLINKS_GLOBAL_LINKBROKEN_NOTIFY', '[Admin] Broken Link Submitted');
define('_MI_WEBLINKS_GLOBAL_LINKBROKEN_NOTIFYCAP', '[Admin] Notify me of any broken link report.');
define('_MI_WEBLINKS_GLOBAL_LINKBROKEN_NOTIFYDSC', 'Receive notification when any broken link report is submitted.');
define('_MI_WEBLINKS_GLOBAL_LINKBROKEN_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : Broken Link Reported');

define('_MI_WEBLINKS_GLOBAL_LINKSUBMIT_NOTIFY', '[Admin] New Link Submitted');
define('_MI_WEBLINKS_GLOBAL_LINKSUBMIT_NOTIFYCAP', '[Admin] Notify me when any new link is submitted (awaiting approval).');
define('_MI_WEBLINKS_GLOBAL_LINKSUBMIT_NOTIFYDSC', 'Receive notification when any new link is submitted (awaiting approval).');
define('_MI_WEBLINKS_GLOBAL_LINKSUBMIT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : New link submitted');

define('_MI_WEBLINKS_GLOBAL_NEWLINK_NOTIFY', 'New Link');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_NOTIFYCAP', 'Notify me when any new link is posted.');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_NOTIFYDSC', 'Receive notification when any new link is posted.');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : New link');

define('_MI_WEBLINKS_CATEGORY_LINKSUBMIT_NOTIFY', '[Admin] New Link Submitted');
define('_MI_WEBLINKS_CATEGORY_LINKSUBMIT_NOTIFYCAP', '[Admin] Notify me when a new link is submitted (awaiting approval) to the current category.');
define('_MI_WEBLINKS_CATEGORY_LINKSUBMIT_NOTIFYDSC', 'Receive notification when a new link is submitted (awaiting approval) to the current category.');
define('_MI_WEBLINKS_CATEGORY_LINKSUBMIT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : New link submitted in category');

define('_MI_WEBLINKS_CATEGORY_NEWLINK_NOTIFY', 'New Link');
define('_MI_WEBLINKS_CATEGORY_NEWLINK_NOTIFYCAP', 'Notify me when a new link is posted to the current category.');
define('_MI_WEBLINKS_CATEGORY_NEWLINK_NOTIFYDSC', 'Receive notification when a new link is posted to the current category.');
define('_MI_WEBLINKS_CATEGORY_NEWLINK_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : New link in category');

//define('_MI_WEBLINKS_LINK_APPROVE_NOTIFY', 'Link Approved');
//define('_MI_WEBLINKS_LINK_APPROVE_NOTIFYCAP', 'Notify me when this link is approved.');
//define('_MI_WEBLINKS_LINK_APPROVE_NOTIFYDSC', 'Receive notification when this link is approved.');
//define('_MI_WEBLINKS_LINK_APPROVE_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} : Your submit link is approved');


//---------------------------------------------------------
// weblinks
//---------------------------------------------------------
// === Names of blocks for this module ===
define("_MI_WEBLINKS_BNAME4","Web links Category list");
define("_MI_WEBLINKS_BNAME5","Latest RSS/ATOM feeds of Web links");
define("_MI_WEBLINKS_BNAME6","Show blog of Web links");

//-------------------------------------
// Title of config items
//-------------------------------------
define('_MI_WEBLINKS_LOGOSHOW','Display the module logo image');
define('_MI_WEBLINKS_LOGOSHOWDSC', 'Select "YES" to display the module logo image.');

define('_MI_WEBLINKS_TITLESHOW','Display the module title');
define('_MI_WEBLINKS_TITLESHOWDSC', 'Select "YES" to display the module title');

define('_MI_WEBLINKS_NEWDAYS', 'Select the number of days for links to be marked as new');
define('_MI_WEBLINKS_NEWDAYS_DSC', 'Enter the number of hits to show "NEW" icon. <br /> If 0, no icon is displayed. ');

define('_MI_WEBLINKS_DESCSHORT', 'Maximum number of characters used for link list explanation ');
define('_MI_WEBLINKS_DESCSHORTDSC', 'Enter the maximum number of characters to be used for link list explanation. ');

define('_MI_WEBLINKS_ORDERBY', 'Default value of sort on link detail display');
define('_MI_WEBLINKS_ORDERBYDSC', 'Enter default value of sort on link detail display.');
define("_MI_WEBLINKS_ORDERBY0","Title (A to Z)");
define("_MI_WEBLINKS_ORDERBY1","Title (Z to A)");
define("_MI_WEBLINKS_ORDERBY2","Date (Registration in ascending order)");
define("_MI_WEBLINKS_ORDERBY3","Date (Registration in descending order)");
define("_MI_WEBLINKS_ORDERBY4","Rating (ascending order)");
define("_MI_WEBLINKS_ORDERBY5","Rating (descending order)");
define("_MI_WEBLINKS_ORDERBY6","Popularity (ascending order)");
define("_MI_WEBLINKS_ORDERBY7","Popularity (descending order)");
	define("_MI_WEBLINKS_ORDERBY8","Time Published (Old Links Listed First)");
	define("_MI_WEBLINKS_ORDERBY9","Time Published (New Links Listed First)");

define('_MI_WEBLINKS_SEARCH_LINKS','Number of links displayed on a search result page');
define('_MI_WEBLINKS_SEARCH_LINKSDSC', 'Enter the maximum number of links to be displayed on a search result page');

define('_MI_WEBLINKS_SEARCH_MIN', 'Minimum number of letters for a search keyword');
define('_MI_WEBLINKS_SEARCH_MINDSC', 'Enter the minimum number of characters for a search keyword ');

define('_MI_WEBLINKS_USEFRAMES', 'Would you like to display the linked page within a frame?');
define('_MI_WEBLINKS_USEFRAMEDSC', 'Choose whether to display target link page inside a frame');

define('_MI_WEBLINKS_BROKEN','Number of Broken Link reports to stop a display');
define('_MI_WEBLINKS_BROKENDSC', 'Enter the number of Broken Link Reports to stop a display. <br /> When below this value, it will be regarded as a temporary error, and nothing will be done. <br />When over this value the link will no longer be displayed.');

define('_MI_WEBLINKS_LISTIMAGE_USE','Use link images for a link list');
define('_MI_WEBLINKS_LISTIMAGE_WIDTH','Maximum width of a link image');
define('_MI_WEBLINKS_LISTIMAGE_HEIGHT','Maximum length of a link image');
define('_MI_WEBLINKS_LISTIMAGE_USEDSC', 'Select "YES" to show link images when displaying a list of links');

define('_MI_WEBLINKS_LINKIMAGE_USE','Use link images for link details display');
define('_MI_WEBLINKS_LINKIMAGE_WIDTH','Maximum width of an image for link details display');
define('_MI_WEBLINKS_LINKIMAGE_HEIGHT','Maximum length of an image for link details display');
define('_MI_WEBLINKS_LINKIMAGE_USEDSC', 'Select "YES" to show link images when link details are displayed.');

// 2005-10-20 K.OHWADA
define('_MI_WEBLINKS_TOPTEN_STYLE','Style of topten');
define('_MI_WEBLINKS_TOPTEN_STYLE_DSC', 'Select style in "Popular Site" and "Top Rated Site". ');
define('_MI_WEBLINKS_TOPTEN_STYLE_0','Each top category');
define('_MI_WEBLINKS_TOPTEN_STYLE_1','Mixed: All categories');

define('_MI_WEBLINKS_TOPTEN_LINKS', 'The maximum number of topten links');
define('_MI_WEBLINKS_TOPTEN_LINKS_DSC', 'Enter the maximum number of links to be displayed in "Popular Site" and "Top Rated Site". ');

define('_MI_WEBLINKS_TOPTEN_CATS','The maximum number of categories in topten');
define('_MI_WEBLINKS_TOPTEN_CATS_DSC', 'Enter the maximum number of categories  to be displayed in "Popular Site" and "Top Rated Site". <br />timeout occurs, if too many top categories are selected');

// 2006-03-26
// REQ 3807: Main Page Introductory Text
//define('_MI_WEBLINKS_INDEX_DESC','Main Page Introductory Text');
//define('_MI_WEBLINKS_INDEX_DESC_DSC', 'You can use this section to display some descriptive or introductory text. HTML is allowed.');
//define('_MI_WEBLINKS_INDEX_DESC_DEFAULT', '<div align="center"><font color="blue">Here is where your page introduction goes.<br />You can edit it at "Module Configuration 2".</font><br /></div>');

// 2006-05-15
define('_MI_WEBLINKS_ADMENU0', 'Index');

// 2006-11-03
// random block
define('_MI_WEBLINKS_BNAME_RANDOM',  'Random Link');
define('_MI_WEBLINKS_BNAME_GENERIC', 'Genric Link Block');

// 2007-04-08
define('_MI_WEBLINKS_BNAME_RANDOM_PHOTO', 'Random Photo');

// 2007-09-01
// notification: new_link_admin
define('_MI_WEBLINKS_GLOBAL_NEWLINK_ADMIN', '[Admin] New Link (with the comment for admin)');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_ADMIN_CAP', '[Admin] Notify me when any new link is posted (with the comment the admin)');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_ADMIN_DSC', 'Receive notification when any new link is posted (with the comment for admin)');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_ADMIN_SBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : New Link');

// notification: new_link_comment
define('_MI_WEBLINKS_GLOBAL_NEWLINK_COMMENT', '[Admin] New Link (if entered the comment for admin)');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_COMMENT_CAP', '[Admin] Notify me when any new link is posted (if entered the comment the admin)');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_COMMENT_DSC', 'Receive notification when any new link is posted (if entered the comment for admin)');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_COMMENT_SBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : New Link)');

}
// --- define language begin ---

?>