<?php
// $Id: admin.php,v 1.3 2012/04/10 18:52:29 ohwada Exp $

// 2008-02-17 K.OHWADA
// htmlout

// 2007-12-09 K.OHWADA
// remove _WEBLINKS_ADMIN_CHECK
// add AM_WEBLINKS_D3FORUM_VIEW

// 2007-11-01 K.OHWADA
// _AM_WEBLINKS_GM_MARKER_WIDTH

// 2007-09-01 K.OHWADA
// nofitication
// change _WEBLINKS_LINK_APPROVED _AM_WEBLINKS_USE_HITS

// 2007-08-01 K.OHWADA
// config 0

// 2007-07-14 K.OHWADA
// highlight

// 2007-06-10 K.OHWADA
// d3forum

// 2007-04-08 K.OHWADA
// _AM_WEBLINKS_CAT_DESC_MODE

// 2007-03-25 K.OHWADA
// _AM_WEBLINKS_UPDATE_CAT_IMAGE_SIZE

// 2007-02-20 K.OHWADA
// performance

// 2006-12-11 K.OHWADA
// _AM_WEBLINKS_TIME_PUBLISH

// 2006-10-05 K.OHWADA
// _AM_WEBLINKS_MODULE_CONFIG_3
// google map

// 2006-05-15 K.OHWADA
// weblinks ver 1.1
// _AM_WEBLINKS_INDEX_DESC, etc

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module duplication

//=========================================================
// WebLinks Module
// language for admin
// 2004-10-20 K.OHWADA
//=========================================================

// --- define language begin ---
if( !defined('WEBLINKS_LANG_AM_LOADED') ) 
{

define('WEBLINKS_LANG_AM_LOADED', 1);

define("_WEBLINKS_ADMIN_INDEX","Admin Index");

// BUG 2931: unmatch popup menu 'preference' and index menu 'module setting'
define("_WEBLINKS_ADMIN_MODULE_CONFIG_1","Module Configuration 1 (Preferences)");

define("_WEBLINKS_ADMIN_MODULE_CONFIG_2","Module Configuration 2");
//define("_WEBLINKS_ADMIN_ADDMODDEL_CATEGORY","Add, Modify, and Delete Categories");
define("_WEBLINKS_ADMIN_ADD_LINK","Add New Link");
define("_WEBLINKS_ADMIN_OTHERFUNC","Other Functions");
define("_WEBLINKS_ADMIN_GOTO_ADMIN_INDEX","Go To Admin Index");

//======	config.php 	======
// Access Authority
define('_WEBLINKS_ADMIN_AUTH','Permissions');
define('_WEBLINKS_ADMIN_AUTH_TEXT', 'The administrator has all management authority');
define('_WEBLINKS_AUTH_SUBMIT','Can submit a new link');
define('_WEBLINKS_AUTH_SUBMIT_DSC','Specify the groups allowed to submit a new link');
define('_WEBLINKS_AUTH_SUBMIT_AUTO','Can automatically approve newly submitted links');
define('_WEBLINKS_AUTH_SUBMIT_AUTO_DSC','Specify the groups whose links submissions are automatically approved');
define('_WEBLINKS_AUTH_MODIFY','Can modify');
define('_WEBLINKS_AUTH_MODIFY_DSC','Specify the groups allowed to submit link modification requests');
define('_WEBLINKS_AUTH_MODIFY_AUTO','Can approve link modifications');
define('_WEBLINKS_AUTH_MODIFY_AUTO_DSC','Specify the groups allowed to approve link modification requests');
define('_WEBLINKS_AUTH_RATELINK','Can rate a link');
define('_WEBLINKS_AUTH_RATELINK_DSC',"Specify the groups allowed to rate a link.<br />This feature only works when users are allowed to rate links.");
define('_WEBLINKS_USE_PASSWD','Use Password Authentication when modifying a link');
define('_WEBLINKS_USE_PASSWD_DSC','Displays a Password Authentication field when YES is selected, <br />for groups that are not allowed to submit/approve modification requests. ');
define('_WEBLINKS_USE_RATELINK','Allow ratings');
define('_WEBLINKS_USE_RATELINK_DSC',"YES allows users to rate links.");
define('_WEBLINKS_AUTH_UPDATED', 'Permissions Updated');


// RSS/ATOM
define('_WEBLINKS_ADMIN_RSS','RSS/ATOM Feeds settings');
define('_WEBLINKS_RSS_MODE_AUTO','Auto update RSS/ATOM feeds');
define('_WEBLINKS_RSS_MODE_AUTO_DSC', "YES performs 'Auto Discovery of RSS/ATOM url' and 'auto update' if RSS/ATOM links are included in the link submission. ");
define('_WEBLINKS_RSS_MODE_DATA','Data of RSS/ATOM to show');
define('_WEBLINKS_RSS_MODE_DATA_DSC', "ATOM FEED, uses the data in the Atom feed table after parsing. <br />XML uses the data from the link table before parsing. <br />Some data may not be saved in atomfeed table after filtering. ");
define('_WEBLINKS_RSS_CACHE','Cache time of RSS/ATOM feeds');
define('_WEBLINKS_RSS_CACHE_DSC', 'Measured in hours.');
define('_WEBLINKS_RSS_LIMIT','The maximum number of RSS/ATOM feeds');
define('_WEBLINKS_RSS_LIMIT_DSC', 'Enter the maximum number of RSS/ATOM feeds saved in atomfeed table<br />Old data will be cleared if this value is exceeded. <br />0 is unlimited. ');
define('_WEBLINKS_RSS_SITE','RSS search site');
define('_WEBLINKS_RSS_SITE_DSC',"Enter a list of RSS url of RSS search site. <br />Separate each entry with a new line when specifying more than one. <br />Don't enter ATOM url. ");
define('_WEBLINKS_RSS_BLACK','Black list of RSS/ATOM url');
define('_WEBLINKS_RSS_BLACK_DSC','Enter a list of urls to refuse when collecting RSS/ATOM feeds. <br />Separate each entry with a new line when specifying more than one. <br />You can use regular PERL expressions. ');
define('_WEBLINKS_RSS_WHITE','White list of RSS/ATOM url');
define('_WEBLINKS_RSS_WHITE_DSC','Enter list of urls to collect when matching with a blacklist. <br />Separate each entry with a new line when specifying more than one. <br />You can use regular PERL expression. ');
define('_WEBLINKS_RSS_URL_CHECK', 'There are some link urls matching the blacklist. ');
define('_WEBLINKS_RSS_URL_CHECK_DSC', 'Please copy and paste from the lower white list to a registration form, if necessary. ');
define('_WEBLINKS_RSS_UPDATED', 'RSS/ATOM settings updated');


// RSS/ATOM
define('_WEBLINKS_ADMIN_RSS_VIEW','RSS/ATOM Feeds view settings');
define('_WEBLINKS_RSS_MODE_TITLE','Use HTML tags in the title');
define('_WEBLINKS_RSS_MODE_TITLE_DSC', "YES displays HTML tags in the link's title, if title has HTML tags. <br />NO strips HTML tags from the title. ");
define('_WEBLINKS_RSS_MODE_CONTENT','Use HTML tags in the content');
define('_WEBLINKS_RSS_MODE_CONTENT_DSC', "YES displays the link's content with HTML tag, if content has HTML tag. <br />NO strips all HTML tags from the displayed content. ");
define('_WEBLINKS_RSS_NEW','Select the maximum number of "new RSS/ATOM feeds" displayed on top page');
define('_WEBLINKS_RSS_NEW_DSC', 'Enter the maximum number of new RSS/ATOM feeds to be displayed in the Main page.');
define('_WEBLINKS_RSS_PERPAGE','Select the maximum number of RSS/ATOM feeds to be displayed on the Link Detail page and RSS/ATOM page');
define('_WEBLINKS_RSS_PERPAGE_DSC', 'Enter the maximum number of RSS/ATOM feeds to be shown on the RSS/ATOM page. ');
define('_WEBLINKS_RSS_NUM_CONTENT','Number of feeds displaying content');
define('_WEBLINKS_RSS_NUM_CONTENT_DSC', 'Enter the number of feeds displaying the content of RSS/ATOM feeds on the Link detail page. <br />A summary is displayed on the remaining feeds. ');
define('_WEBLINKS_RSS_MAX_CONTENT','Maximum number of characters used for RSS/ATOM feed content');
define('_WEBLINKS_RSS_MAX_CONTENT_DSC', 'Enter the maximum number of characters to be used for RSS/ATOM feed content in RSS/ATOM page.  <br />To be used when "Use of HTML tag of the contents" is "yes." ');
define('_WEBLINKS_RSS_MAX_SUMMARY','Maximum number of characters used for RSS/ATOM feed summary');
define('_WEBLINKS_RSS_MAX_SUMMARY_DSC', 'Enter the maximum number of characters to be used for RSS/ATOM feed summary in the Main page. ');


// use link field
define('_WEBLINKS_ADMIN_POST','Link fields settings');
define('_WEBLINKS_ADMIN_POST_TEXT_1', "Don't Use means the field will not be displayed on the submission form. ");
define('_WEBLINKS_ADMIN_POST_TEXT_2', "Use means that the field will be shown on the submission for allowing submitter the option to enter data into the field or not ");
define('_WEBLINKS_ADMIN_POST_TEXT_3', "Iindispensable means the field MUST be filled in. ");
define('_WEBLINKS_NO_USE',"Don't use");
define('_WEBLINKS_USE','Use');
define('_WEBLINKS_INDISPENSABLE','Indispensable');
define('_WEBLINKS_TYPE_DESC','Use XOOPS DHTML text box for submissions');
define('_WEBLINKS_TYPE_DESC_DSC', 'NO uses a normal text box.<br />YES uses XOOPS DHTML-type text boxes for the submission form. ');
define('_WEBLINKS_CHECK_DOUBLE','Accept submission of existing links');
define('_WEBLINKS_CHECK_DOUBLE_DSC', 'NO allows registration of existing links. <br /> YES checks whether the same link already exists in the database. ');
define('_WEBLINKS_POST_UPDATED', 'Link Field settings updated');

// cateogry
define('_WEBLINKS_ADMIN_CAT_SET','Category Settings');
define('_WEBLINKS_CAT_SEL', 'Maximum number of categories a user may select for submitted links');
define('_WEBLINKS_CAT_SEL_DSC', 'Enter the maximum number of categories a user can select to categorize submitted links');
define('_WEBLINKS_CAT_SUB','Number of sub categories to display');
define('_WEBLINKS_CAT_SUB_DSC','Set number of sub category displayed on the category list displayed on the top page');
define('_WEBLINKS_CAT_IMG_MODE','Select category image');
define('_WEBLINKS_CAT_IMG_MODE_DSC', 'NONE no image. <br />Folder.gif shows folder.gif. <br />Setting Image show ssetting image of each category. ');
//define("_WEBLINKS_CAT_IMG_MODE_0","NONE");
define("_WEBLINKS_CAT_IMG_MODE_1","folder.gif");
define("_WEBLINKS_CAT_IMG_MODE_2","Setting Image");
define('_WEBLINKS_CAT_IMG_WIDTH','Maximum width of a category image');
define('_WEBLINKS_CAT_IMG_HEIGHT','Maximum height of a category image');
define('_WEBLINKS_CAT_IMG_SIZE_DSC','Use when selecting "Setting Image". ');
define('_WEBLINKS_CAT_UPDATED', 'Category Settings Updated');


//======	cateogry_list.php 	======
define("_WEBLINKS_ADMIN_CATEGORY_MANAGE","Category Management");
define("_WEBLINKS_ADMIN_CATEGORY_LIST","Category List");
//define("_WEBLINKS_ORDER_ID"," Listed by ID");
define("_WEBLINKS_ORDER_TREE"," Listed by tree");
define("_WEBLINKS_CAT_ORDER","Category Order");
define("_WEBLINKS_THERE_ARE_CATEGORY","There are <b>%s</b> categories in the database");
define("_WEBLINKS_ADMIN_CATEGORY_NOTICE_1","Click <b>category ID</b> to edit a specific category. ");
define("_WEBLINKS_ADMIN_CATEGORY_NOTICE_2","Click <b>Parent category</b> or <b>Title</b>, to show category list order. ");
define("_WEBLINKS_NO_CATEGORY","There is no corresponding category. ");
define("_WEBLINKS_NUM_SUBCAT","Number of sub category");
define('_WEBLINKS_ORDERS_UPDATED', 'Updated order of category');

//======	cateogry_manage.php 	======
define("_WEBLINKS_IMGURL_MAIN","URL of category image");
define("_WEBLINKS_IMGURL_MAIN_DSC1","Optional. <br />Image sizes are adjusted automatically");
//define("_WEBLINKS_IMGURL_MAIN_DSC2","Images are for the main category only. ");

//======	link_list.php 	======
define("_WEBLINKS_ADMIN_LINK_MANAGE","Link Management");
define("_WEBLINKS_ADMIN_LINK_LIST","Link list");
define("_WEBLINKS_ADMIN_LINK_BROKEN","Broken Link List");
define("_WEBLINKS_ADMIN_LINK_ALL_ASC","List of all links (Listed by old ID) ");
define("_WEBLINKS_ADMIN_LINK_ALL_DESC","List of all links (Listed by new ID) ");
define("_WEBLINKS_ADMIN_LINK_NOURL","List of the links that URL is not set up");
define("_WEBLINKS_COUNT_BROKEN","Broken link count");
define("_WEBLINKS_NO_LINK","There is no corresponding link. ");
define("_WEBLINKS_ADMIN_PRESENT_SAVE","Data saved in database shown here. ");

//======	link_manage.php 	======
//define("_WEBLINKS_USERID","User ID");
//define("_WEBLINKS_CREATE","Created");

//======	link_broken_check.php 	======
define("_WEBLINKS_ADMIN_LINK_CHECK_UPDATE","Link check and update");
define("_WEBLINKS_ADMIN_LINK_BROKEN_CHECK","Broken Link Check");
define("_WEBLINKS_ADMIN_BROKEN_CHECK","Check");
define("_WEBLINKS_ADMIN_BROKEN_RESULT","Check Results");
define("_WEBLINKS_ADMIN_LINK_BROKEN_CHECK_CAUTION","A timeout may occur, if there are many broken links. <br />If so, please change the numerical value of limit and offset. <br />limit= 0, or No Restrictions.");
define("_WEBLINKS_ADMIN_LINK_BROKEN_CHECK_NOTICE","Clicking the <b>link ID</b> opens a link modification page. <br /><b>Website URL</b> will take you to the link's web site when clicked. <br />");
define("_WEBLINKS_ADMIN_LINK_BROKEN_CHECK_GOOGLE","Google Search will open when clicking <b>website title</b>. <br />");
define("_WEBLINKS_ADMIN_LIMIT","Maximum of links to check (limit)");
define("_WEBLINKS_ADMIN_OFFSET","Offset (offset)");
//define("_WEBLINKS_ADMIN_CHECK","CHECK");
define("_WEBLINKS_ADMIN_TIME_START","Start time");
define("_WEBLINKS_ADMIN_TIME_END","Finish time");
define("_WEBLINKS_ADMIN_TIME_ELAPSE","Elapse time");
define("_WEBLINKS_ADMIN_LINK_NUM_ALL","All links");
define("_WEBLINKS_ADMIN_LINK_NUM_CHECK","Checked links");
define("_WEBLINKS_ADMIN_LINK_NUM_BROKEN","Broken links");
define("_WEBLINKS_ADMIN_NUM","links");
define("_WEBLINKS_ADMIN_MIN_SEC","%s min %s sec");
define("_WEBLINKS_ADMIN_CHECK_NEXT","Check next %s links");
//define("_WEBLINKS_ADMIN_RSS_REFRESH_NOTE","Simultaneously execute an Auto Discovery of RSS/ATOM urls ");

//======	rss_manage.php 	======
define("_WEBLINKS_ADMIN_RSS_MANAGE","RSS/ATOM feed Management");
define("_WEBLINKS_ADMIN_RSS_REFRESH","Refresh RSS/ATOM");
define("_WEBLINKS_ADMIN_RSS_REFRESH_LINK","Refresh link data cache");
define("_WEBLINKS_ADMIN_RSS_REFRESH_SITE","Refresh RSS search site cache");
define("_WEBLINKS_ADMIN_NUM_REFRESH_RSS_URL","Number of RSS/ATOM urls refreshed");
define("_WEBLINKS_ADMIN_NUM_REFRESH_RSS_SITE","Number of RSS/ATOM sites refreshed url");
define("_WEBLINKS_ADMIN_NUM_REFRESH_ATOM_SITE","Number of RSS/ATOM site refreshed");
define("_WEBLINKS_ADMIN_NUM_REFRESH_ATOMFEED","Number of RSS/ATOM feeds refreshed");
define("_WEBLINKS_ADMIN_RSS_CACHE_CLEAR","Clear cache RSS/ATOM feed");
define("_WEBLINKS_RSS_CLEAR_NUM","Clear cache of RSS/ATOM feed by order of date, if more than the specified number of feeds in Module Configuration 1.");
define("_WEBLINKS_RSS_NUMBER","Number of feeds");
define("_WEBLINKS_RSS_CLEAR_LID","Clear cache of specified link IDs");
define("_WEBLINKS_RSS_CLEAR_ALL","Clear all cache");
define("_WEBLINKS_NUM_RSS_CLEAR_LINK","Number of RSS/ATOM cache cleared");
define("_WEBLINKS_NUM_RSS_CLEAR_ATOMFEED","Number of ATOM/RSS feed cleared");

//======	user_list.php 	======
define("_WEBLINKS_ADMIN_USER_MANAGE", "User Management");
define("_WEBLINKS_ADMIN_USER_EMAIL", "List of the users with Email addresses");
define("_WEBLINKS_ADMIN_USER_LINK", "List of the registrated users withe link information");
define("_WEBLINKS_ADMIN_USER_NOLINK", "List of the registrated users with no link information");
define("_WEBLINKS_ADMIN_USER_EMAIL_DSC", "Show only one Email address if duplicated");
//define("_WEBLINKS_ADMIN_USER_LINK_DSC", 'Use "Send Message to Users" of XOOPS core');
//define("_WEBLINKS_USER_ALL", " (all) ");
//define("_WEBLINKS_USER_MAX", " (each %s persons) ");
define("_WEBLINKS_THERE_ARE_USER", "<b>%s</b> users found");
define("_WEBLINKS_USER_NUM", "Show from %s th person to %s th person.");
define("_WEBLINKS_USER_NOFOUND", "No Users Found");
define("_WEBLINKS_UID_EMAIL", "Email address of submitter");

//======	mail_users.php 	======
define("_WEBLINKS_ADMIN_SENDMAIL", "Send Email");
define("_WEBLINKS_THERE_ARE_EMAIL","There are <b>%s</b> e-mails");
define("_WEBLINKS_SEND_NUM", "Send email form %s th person to %s th person");
//define("_WEBLINKS_SEND_NEXT","Send next %s emails");
//define("_WEBLINKS_SUBJECT_FROM", "Information from %s");
//define("_WEBLINKS_HELLO", "Hello %s");
define("_WEBLINKS_MAIL_TAGS1","{W_NAME} will print user name");
define("_WEBLINKS_MAIL_TAGS2","{W_EMAIL} will print user email");
define("_WEBLINKS_MAIL_TAGS3","{W_LID} will print user link-id");

// general
//define('_WEBLINKS_WEBMASTER', 'Webmaster');
define('_WEBLINKS_SUBMITTER', 'Submitter');
//define("_WEBLINKS_MID","Modify ID");
define("_WEBLINKS_UPDATE","UPDATE");
define("_WEBLINKS_SET_DEFAULT","Set default");
define("_WEBLINKS_CLEAR","CLEAR");
define("_WEBLINKS_CHECK","CHECK");
define("_WEBLINKS_NON","Noting to do");
//define("_WEBLINKS_SENDMAIL", "SEND Email");

// 2005-08-09
// BUG 2827: RSS refresh: Invalid argument supplied for foreach()
define("_WEBLINKS_ADMIN_NO_LINK_BROKEN_CHECK","There is no link to check");
define("_WEBLINKS_ADMIN_NO_RSS_REFRESH","There is no link to update RSS");

// 2005-10-20
define("_WEBLINKS_LINK_APPROVED", "[{X_SITENAME}] {X_MODULE}: Your submit link is approved");
define("_WEBLINKS_LINK_REFUSED",  "[{X_SITENAME}] {X_MODULE}: Your submit link is refused");

// 2006-05-15
define('_AM_WEBLINKS_INDEX_DESC','Main Page Introductory Text');
define('_AM_WEBLINKS_INDEX_DESC_DSC', 'You can use this section to display some descriptive or introductory text. HTML is allowed.');
define('_AM_WEBLINKS_INDEX_DESC_DEFAULT', '<div align="center" style="color: #0000ff">Here is where your page introduction goes.<br />You can edit it at "Module Configuration 2".<br /></div>');

define('_AM_WEBLINKS_ADD_CATEGORY', 'Add New Category');
define('_AM_WEBLINKS_ERROR_SOME', 'There are some error messages');
define('_AM_WEBLINKS_LIST_ID_ASC',  'Listed by Old ID');
define('_AM_WEBLINKS_LIST_ID_DESC', 'Listed by New ID');

// config
//define('_AM_WEBLINKS_WARNING_NOT_WRITABLE','The directory is not writeable');

define('_AM_WEBLINKS_CONF_LINK','Link Configuration');
define('_AM_WEBLINKS_CONF_LINK_IMAGE','Link Image Configuration');
define('_AM_WEBLINKS_CONF_VIEW','View Configuration');
define('_AM_WEBLINKS_CONF_TOPTEN','TopTen Configuration');
define('_AM_WEBLINKS_CONF_SEARCH','Seach Configuration');

define('_AM_WEBLINKS_USE_BROKENLINK','Broken Link Reports');
define('_AM_WEBLINKS_USE_BROKENLINK_DSC','YES allows users to report a broken link');
define('_AM_WEBLINKS_USE_HITS','Countup hits when jump to site');
define('_AM_WEBLINKS_USE_HITS_DSC','YES enables to countup link hits counter when jump to site');
define('_AM_WEBLINKS_USE_PASSWD','Password authentication');
define('_AM_WEBLINKS_USE_PASSWD_DSC','YES, <b>anoymous user</b> can modify a link with password authentication.<br />NO, <br />password field is not displayed.');
define('_AM_WEBLINKS_PASSWD_MIN','Minimum length of password required');
define('_AM_WEBLINKS_POST_TEXT', 'The administrator has all management authority');
define('_AM_WEBLINKS_AUTH_DOHTML', 'Permission to use HTML tags');
define('_AM_WEBLINKS_AUTH_DOHTML_DSC', 'Specify the groups allowed to use HTML tags');
define('_AM_WEBLINKS_AUTH_DOSMILEY', 'Permission to use smiley icons');
define('_AM_WEBLINKS_AUTH_DOSMILEY_DSC', 'Specify the groups allowed to use smiley icons');
define('_AM_WEBLINKS_AUTH_DOXCODE', 'Permission to use XOOPS codes');
define('_AM_WEBLINKS_AUTH_DOXCODE_DSC', 'Specify the groups allowed to use XOOPS codes');
define('_AM_WEBLINKS_AUTH_DOIMAGE', 'Permission to use images');
define('_AM_WEBLINKS_AUTH_DOIMAGE_DSC', 'Specify the groups allowed to use images');
define('_AM_WEBLINKS_AUTH_DOBR', 'Permission to use linebreaks');
define('_AM_WEBLINKS_AUTH_DOBR_DSC', 'Specify the groups allowed to use linebreak');
define('_AM_WEBLINKS_SHOW_CATLIST','Show category list in submenu');
define('_AM_WEBLINKS_SHOW_CATLIST_DSC','YES show top category list in submenu');
define('_AM_WEBLINKS_VIEW_URL','URL view style');
define('_AM_WEBLINKS_VIEW_URL_DSC','NONE <br />no url or &lt;a&gt; tag is displayed.<br />Indirect<br /> displays visit.php in href field instead of URL. <br />Direct <br />Displays url in href field, JavaScript in onmousedown field and hits is counted via JavaScript.');
define('_AM_WEBLINKS_VIEW_URL_0','NONE');
define('_AM_WEBLINKS_VIEW_URL_1','Indirect url');
define('_AM_WEBLINKS_VIEW_URL_2','Direct url');
define('_AM_WEBLINKS_RECOMMEND_PRI','Priority of Recommended Sites');
define('_AM_WEBLINKS_RECOMMEND_PRI_DSC','NONE <br />Not display.<br />Normal <br />Recommended sites are displayed in the header.<br />Higher <br />Displays Recommended sites at the top of each respective category.');
define('_AM_WEBLINKS_MUTUAL_PRI','Priority of Reciprocal Sites');
define('_AM_WEBLINKS_MUTUAL_PRI_DSC','NONE <br />Not display.<br />Normal <br />Recommended sites are displayed in the header.<br />Higher <br />Displays Recommended sites at the top of each respective category.');
define('_AM_WEBLINKS_PRI_0','NONE');
define('_AM_WEBLINKS_PRI_1','Normal');
define('_AM_WEBLINKS_PRI_2','Higher');
define('_AM_WEBLINKS_LINK_IMAGE_AUTO','Auto update Banner image size');
define('_AM_WEBLINKS_LINK_IMAGE_AUTO_DSC', "YES <br />update Banner image size automatically.");
define('_AM_WEBLINKS_RSS_USE','Use RSS feed');
define('_AM_WEBLINKS_RSS_USE_DSC','YES <br />Get and display RSS/ATOM feed.');

// bulk import
define('_AM_WEBLINKS_BULK_IMPORT','Bulk Import');
define('_AM_WEBLINKS_BULK_IMPORT_FILE','Bulk Import by File');
define('_AM_WEBLINKS_BULK_CAT','Bulk Import of Categories');
define('_AM_WEBLINKS_BULK_CAT_DSC1','Describe categories');
define('_AM_WEBLINKS_BULK_CAT_DSC2','Use left arrow parenthesis (>) at the beginning of the category to define a category as a sub category.');
define('_AM_WEBLINKS_BULK_LINK','Bulk Import of Links');
define('_AM_WEBLINKS_BULK_LINK_DSC1', 'Input a category on the 1st line.');
define('_AM_WEBLINKS_BULK_LINK_DSC2', 'Describe link title, URL, and explanation divided by a comma(,) on the 2nd line.');
define('_AM_WEBLINKS_BULK_LINK_DSC3', 'Use dashes to separate links horizontal bar (---) .');
define('_AM_WEBLINKS_BULK_ERROR_LAYER','Specified two or more under layers at the category tree structure. This need clarification G.S.');
define('_AM_WEBLINKS_BULK_ERROR_CID','Wrong category ID');
define('_AM_WEBLINKS_BULK_ERROR_PID','Wrong parent category ID');
define('_AM_WEBLINKS_BULK_ERROR_FINISH','An error halted the operation');

// command
//define('_AM_WEBLINKS_CREATE_CONFIG', 'Create Config File');
//define('_AM_WEBLINKS_TEST_EXEC', 'Test execute for %s');

// === 2006-10-05 ===
// menu
define('_AM_WEBLINKS_MODULE_CONFIG_3','Module Configuration 3');
define('_AM_WEBLINKS_MODULE_CONFIG_4','Module Configuration 4');
define('_AM_WEBLINKS_VOTE_LIST', 'Vote List');
define('_AM_WEBLINKS_CATLINK_LIST', 'Categorized Link List');
//define('_AM_WEBLINKS_COMMAND_MANAGE', 'Command Management');
define('_AM_WEBLINKS_TABLE_MANAGE',  'DB Table Management');
define('_AM_WEBLINKS_IMPORT_MANAGE', 'Import Management');
define('_AM_WEBLINKS_EXPORT_MANAGE', 'Export Management');

// config
define('_AM_WEBLINKS_MODULE_CONFIG_DESC_2','Auth, Cat, etc');
define('_AM_WEBLINKS_MODULE_CONFIG_DESC_3','Link');
define('_AM_WEBLINKS_MODULE_CONFIG_DESC_4','RSS, Forum, Map');
define('_AM_WEBLINKS_LINK_REGISTER','Link settings: Description');

// bin configuration
//define('_AM_WEBLINKS_FORM_BIN', 'Command Config');
//define('_AM_WEBLINKS_FORM_BIN_DESC', 'It is used on bin command');
//define('_AM_WEBLINKS_CONF_BIN_PASS','Password');
//define('_AM_WEBLINKS_CONF_BIN_PASS_DESC','');
//define('_AM_WEBLINKS_CONF_BIN_SEND','Send Mail');
//define('_AM_WEBLINKS_CONF_BIN_SEND_DESC','');
//define('_AM_WEBLINKS_CONF_BIN_MAILTO','Email to send');
//define('_AM_WEBLINKS_CONF_BIN_MAILTO_DESC','');

// rssc
//define('_AM_WEBLINKS_RSS_DIRNAME','RSSC Module Dirname');
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
define('_AM_WEBLINKS_CONF_LOCATE','Locate Configuration');
define('_AM_WEBLINKS_CONF_COUNTRY_CODE','Country Code');
define('_AM_WEBLINKS_CONF_COUNTRY_CODE_DESC', 'Enter ccTLDs code <br/> <a href="http://www.iana.org/cctld/cctld-whois.htm" target="_blank">IANA: Country-Code Top-Level Domains</a>');
define('_AM_WEBLINKS_CONF_RENEW_COUNTRY_CODE_DESC', 'Refresh the item which relates to the country code. <br/> The item with the <span style="color:#0000ff;">#</span> mark');
define('_AM_WEBLINKS_RENEW', 'Renew');

// map
define('_AM_WEBLINKS_CONF_MAP','Map Site Configuretaion');
define('_AM_WEBLINKS_CONF_MAP_USE','Use Map Site');
define('_AM_WEBLINKS_CONF_MAP_TEMPLATE','Template of Map Site');
define('_AM_WEBLINKS_CONF_MAP_TEMPLATE_DESC','Enter template file name in template/map/ directory');

// google map: hacked by wye <http://never-ever.info/>
define('_AM_WEBLINKS_CONF_GOOGLE_MAP','Google Maps Configuration');
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
define('_AM_WEBLINKS_CONF_GOOGLE_SEARCH','Google Search Confirmation');
define('_AM_WEBLINKS_CONF_GOOGLE_SERVER','Server Name');
define('_AM_WEBLINKS_CONF_GOOGLE_LANG',  'Language Code');

// template
//define('_AM_WEBLINKS_CONF_TEMPLATE','Clear cache of Templates');
define('_AM_WEBLINKS_CONF_TEMPLATE_DESC','MUST execute, when changing template files in template/parts/ template/xml/ and template/map/ directory');

// === 2006-12-11 ===
// link item
//define('_AM_WEBLINKS_TIME_PUBLISH','Set the publication time');
//define('_AM_WEBLINKS_TIME_PUBLISH_DESC','If you do not check it, published time will become undated');
//define('_AM_WEBLINKS_TIME_EXPIRE','Set expiration time');
//define('_AM_WEBLINKS_TIME_EXPIRE_DESC','If you do not check it, expired setting will become undated');
define('_AM_WEBLINKS_LINK_TIME_PUBLISH_BEFORE','Link list before Publish time');
define('_AM_WEBLINKS_LINK_TIME_EXPIRE_AFTER',  'Link list after Expired time');

define('_AM_WEBLINKS_SERVER_ENV','Server Enviroment ');
define('_AM_WEBLINKS_DEBUG_CONF','Debug Vairables');
define('_AM_WEBLINKS_ALL_GREEN','All Green');

// === 2007-02-20 ===
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

define('_AM_WEBLINKS_CONF_LINK_GUEST','Guest Link Register Configuration');
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
//define('_AM_WEBLINKS_FORUM_SEL', 'Select Forum module');
define('_AM_WEBLINKS_FORUM_THREAD_LIMIT', 'Number of Showing Thread');
define('_AM_WEBLINKS_FORUM_POST_LIMIT', 'Number of Showing Post in each Thread');
define('_AM_WEBLINKS_FORUM_POST_ORDER', 'Order of Post');
define('_AM_WEBLINKS_FORUM_POST_ORDER_0', 'Older post date');
define('_AM_WEBLINKS_FORUM_POST_ORDER_1', 'Newer post date');
//define('_AM_WEBLINKS_FORUM_INSTALLED',     'Forum module ( %s ) ver %s is installed');
//define('_AM_WEBLINKS_FORUM_NOT_INSTALLED', 'Forum module ( %s ) is not installed');

// === 2007-03-25 ===
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
//define('_AM_WEBLINKS_ALBUM_SEL', 'Select Album module');
define('_AM_WEBLINKS_ALBUM_LIMIT', 'Number of Showing Phots');
define('_AM_WEBLINKS_WHEN_OMIT', 'Process when omit');

define('_AM_WEBLINKS_MODULE_INSTALLED',     '%s module ( %s ) ver %s is installed');
define('_AM_WEBLINKS_MODULE_NOT_INSTALLED', '%s module ( %s ) is not installed');

// === 2007-04-08 ===
define('_AM_WEBLINKS_CAT_DESC_MODE',  'Show Description');
define('_AM_WEBLINKS_CAT_SHOW_FORUM', 'Show Forum');
define('_AM_WEBLINKS_CAT_SHOW_ALBUM', 'Show Album');
define('_AM_WEBLINKS_MODE_SETTING',   'Setting value');
define('_AM_WEBLINKS_MODE_OMIT_PARENT', 'Same as parent category when omit');

// === 2007-06-10 ===
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

// === 2007-07-14 ===
// highlight
define('_AM_WEBLINKS_USE_HIGHLIGHT', 'Use keyword Highlight');
define('_AM_WEBLINKS_CHECK_MAIL', 'Check Email Format');
define('_AM_WEBLINKS_CHECK_MAIL_DSC', 'NO allows any format. <br /> YES checks that email format is like abc@efg.com when register link. ');
//define('_AM_WEBLINKS_NO_EMAIL', 'Not Set Email Address');

// === 2007-08-01 ===
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
define('_AM_WEBLINKS_GM_GEOCODE_KIND',  '[Search] Kind of Geocode');
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

// === 2007-09-01 ===
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
define('_AM_WEBLINKS_LINK_IMG_THUMB_DSC', 'show the WEB site thumbnail instead of the link image, <br />using the thumbnail web service, <br />if not set the link image.');
define('_AM_WEBLINKS_LINK_IMG_NON', 'none');
//define('_AM_WEBLINKS_LINK_IMG_MOZSHOT', 'Use <a href="http://mozshot.nemui.org/" target="_blank">MozShot</a>');
//define('_AM_WEBLINKS_LINK_IMG_SIMPLEAPI', 'Use <a href="http://img.simpleapi.net/" target="_blank">SimpleAPI</a>');

// === 2007-11-01 ===
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

// === 2007-12-09 ===
define("_AM_WEBLINKS_D3FORUM_VIEW", "The view type of the comment");

// === 2008-02-17 ===
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

// === 2012-03-01 ===


define('_AM_WEBLINKS_BULK_COMMENT','Bulk Registation of Comment');
define('_AM_WEBLINKS_BULK_COMMENT_DSC1','describe the title of link, uid, the title of comment, and the text of commentwith comma(,) separate<br />uid is omissible. substitute with uid of administrator.<br/ >the title of comment is omissible. substitute with the title of link.');
define('_AM_WEBLINKS_NO_COMMENT','No comment');
define('_AM_WEBLINKS_COMMENT_ADDED','Added comment');
define('_AM_WEBLINKS_BULK_DSC1','<br />describe \2c instead of comma.<br/ >describe \n instead of new-line.');


//---------------------------------------------------------
// 2012-04-02 v2.10
//---------------------------------------------------------
define('_AM_WEBLINKS_VIEW_URL_SUMMARY','Select URL');
define('_AM_WEBLINKS_VIEW_URL_SUMMARY_DSC','apply when select summary in category, recommended site, etc.');
define('_AM_WEBLINKS_VIEW_URL_SUMMARY_0','url of original site');
define('_AM_WEBLINKS_VIEW_URL_SUMMARY_1','singlelink of Weblinks');

define('_AM_WEBLINKS_RSSC_MANAGE','RSSC Manage');
define('_AM_WEBLINKS_RSSC_ARCHIVE','RSSC Archive Manage');
define('_AM_WEBLINKS_RSSC_ADD','Add RSS URL in Link');
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
// --- define language begin ---

?>