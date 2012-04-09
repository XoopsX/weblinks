<?php
// $Id: main.php,v 1.2 2012/04/09 10:20:05 ohwada Exp $

// 2008-02-17 K.OHWADA
// pagerank, pagerank_update

// 2007-11-01 K.OHWADA
// _WEBLINKS_ERROR_LENGTH
// remove _WEBLINKS_INIT_NOT

// 2007-09-01 K.OHWADA
// waiting list
// change _WLS_NOTIFYAPPROVE

// 2007-08-01 K.OHWADA
// _WEBLINKS_GM_CURRENT_ADDRESS
// <br> => <br />

// 2007-04-08 K.OHWADA
// _WEBLINKS_GM_TYPE

// 2007-03-25 K.OHWADA
// _WEBLINKS_ALBUM_ID

// 2007-02-20 K.OHWADA
// forum

// 2007-01-20 K.OHWADA
// _WEBLINKS_CAT_AUX_TEXT_1

// 2006-12-11 K.OHWADA
// google map: googleGeocode
// _WEBLINKS_TIME_PUBLISH

// 2006-11-26 K.OHWADA
// google map: JP Geocode

// 2006-11-04 K.OHWADA
// google map: JP inverse Geocoder
// google map: inline mode

// 2006-10-01 K.OHWADA
// conflict with rssc
// add _WEBLINKS_RSSC_LID
// google map

// 2006-05-15 K.OHWADA
// weblinks ver 1.1
// _WEBLINKS_MID, etc

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication

//=========================================================
// WebLinks Module
// language main
// 2004-10-24 K.OHWADA
//=========================================================

// --- define language begin ---
if( !defined('WEBLINKS_LANG_MB_LOADED') ) 
{

define('WEBLINKS_LANG_MB_LOADED', 1);

//---------------------------------------------------------
// same as mylinks
//---------------------------------------------------------

//======	 singlelink.php	======
define("_WLS_CATEGORY","Category");
define("_WLS_HITS","Hits");
define("_WLS_RATING","Rating");
define("_WLS_VOTE","Vote");
define("_WLS_ONEVOTE","1 vote");
define("_WLS_NUMVOTES","%s votes");
define("_WLS_RATETHISSITE","Rate this Site");
define("_WLS_REPORTBROKEN","Report Broken Link");
define("_WLS_TELLAFRIEND","Tell a Friend");
define("_WLS_EDITTHISLINK","Edit This Link");
define("_WLS_MODIFY","Modify");

//======	submit.php	======
define("_WLS_SUBMITLINKHEAD","Submit New Link");
define("_WLS_SUBMITONCE","Submit your link only once.");
define("_WLS_DONTABUSE","Username and IP are recorded, so please don't abuse the system.");
define("_WLS_TAKESHOT","We will take a screen shot of your website and it may take several days for your website link to be added to our database.");
define("_WLS_ALLPENDING","Link submission registered and will be published after verification. ");
//define("_WLS_WHENAPPROVED","You'll receive an E-mail when it's approved.");
define("_WLS_RECEIVED","We received your Website information. Thanks!");

//======	modlink.php	======
define("_WLS_REQUESTMOD","Link Modification Request");
define("_WLS_THANKSFORINFO","Thanks for the information. We'll look into your request shortly.");


define("_WLS_THANKSFORHELP","Thank you for helping to maintain this directory's integrity.");
define("_WLS_FORSECURITY","For security reasons your user name and IP address will also be temporarily recorded.");

define("_WLS_SEARCHFOR","Search for"); //-no use
define("_WLS_ANY","ANY");
define("_WLS_SEARCH","Search");

//define("_WLS_MAIN","Main");
define("_WLS_SUBMITLINK","Submit Link");
define("_WLS_POPULAR","Popular");
define("_WLS_TOPRATED","Top Rated");

define("_WLS_NEWTHISWEEK","New this week");
define("_WLS_UPTHISWEEK","Updated this week");

define("_WLS_POPULARITYLTOM","Popularity (Least to Most Hits)");
define("_WLS_POPULARITYMTOL","Popularity (Most to Least Hits)");
define("_WLS_TITLEATOZ","Title (A to Z)");
define("_WLS_TITLEZTOA","Title (Z to A)");
define("_WLS_DATEOLD","Date (Old Links Listed First)");
define("_WLS_DATENEW","Date (New Links Listed First)");
define("_WLS_RATINGLTOH","Rating (Lowest Score to Highest Score)");
define("_WLS_RATINGHTOL","Rating (Highest Score to Lowest Score)");

//define("_WLS_NOSHOTS","No Screenshots Available");
//define("_WLS_DESCRIPTIONC","Description: ");
//define("_WLS_EMAILC","Email: ");
//define("_WLS_CATEGORYC","Category: ");
//define("_WLS_LASTUPDATEC","Last Update: ");
//define("_WLS_HITSC","Hits: ");
//define("_WLS_RATINGC","Rating: ");

define("_WLS_THEREARE","There are <b>%s</b> Links in our Database");
define("_WLS_LATESTLIST","Latest Listings");

//define("_WLS_LINKID","Link ID: ");
//define("_WLS_SITETITLE","Website Title: ");
//define("_WLS_SITEURL","Website URL: ");
//define("_WLS_OPTIONS","Options: ");
define("_WLS_LINKID","Link ID");
define("_WLS_SITETITLE","Website Title");
define("_WLS_SITEURL","Website URL");
define("_WLS_OPTIONS","Options");

define("_WLS_NOTIFYAPPROVE", "Notify me when this link is approved or refused");
//define("_WLS_SHOTIMAGE","Screenshot Img: ");
define("_WLS_SENDREQUEST","Send Request");

define("_WLS_VOTEAPPRE","Your vote is appreciated.");
define("_WLS_THANKURATE","Thank you for taking the time to rate a site here at %s.");
define("_WLS_VOTEFROMYOU","Input from users such as yourself will help other visitors better decide which link to choose.");
define("_WLS_VOTEONCE","Please do not vote for the same resource more than once.");
define("_WLS_RATINGSCALE","The scale is 1 - 10, with 1 being poor and 10 being excellent.");
define("_WLS_BEOBJECTIVE","Please be objective, if everyone receives a 1 or a 10, the ratings aren't very useful.");
define("_WLS_DONOTVOTE","Do not vote for your own resource.");
define("_WLS_RATEIT","Rate It!");

define("_WLS_INTRESTLINK","Interesting Website Link at %s");  // %s is your site name
define("_WLS_INTLINKFOUND","Here is an interesting website link I have found at %s");  // %s is your site name

define("_WLS_RANK","Rank");
define("_WLS_TOP10","%s Top 10"); // %s is a link category title

define("_WLS_SEARCHRESULTS","Search results for <b>%s</b>:"); // %s is search keywords
define("_WLS_SORTBY","Sort by:");
define("_WLS_TITLE","Title");
define("_WLS_DATE","Date");
define("_WLS_POPULARITY","Popularity");
define("_WLS_CURSORTEDBY","Sites currently sorted by: %s");
define("_WLS_PREVIOUS","Previous");
define("_WLS_NEXT","Next");
define("_WLS_NOMATCH","No matches found for your query");

define("_WLS_SUBMIT","Submit");
define("_WLS_CANCEL","Cancel");

define("_WLS_ALREADYREPORTED","You have already submitted a broken report for this resource.");
define("_WLS_MUSTREGFIRST","Sorry, you don't have permission to perform this action.<br />Please register or login first!");
define("_WLS_NORATING","No rating selected.");
define("_WLS_CANTVOTEOWN","You cannot vote on the resource you submitted.<br />All votes are logged and reviewed.");
define("_WLS_VOTEONCE2","Vote for the selected resource only once.<br />All votes are logged and reviewed.");

//%%%%%%	Admin	  %%%%%

define("_WLS_WEBLINKSCONF","Web Links Configuration");
define("_WLS_GENERALSET","Web Links General Settings");
//define("_WLS_ADDMODDELETE","Add, Modify, and Delete Categories/Links");
define("_WLS_LINKSWAITING","New Links Waiting for Validation");
define("_WLS_MODREQUESTS","Modified Links Waiting for Validation");
define("_WLS_BROKENREPORTS","Broken Link Reports");

//define("_WLS_SUBMITTER","Submitter: ");
define("_WLS_SUBMITTER","Submitter");

define("_WLS_VISIT","Visit");

//define("_WLS_SHOTMUST","Screenshot image must be a valid image file under %s directory (ex. shot.gif). Leave it blank if no image file.");
define("_WLS_LINKIMAGEMUST"," Enter link image fie name under %s directory. (e.g. shot.gif) Leave the field blank if there is no image file. ");

define("_WLS_APPROVE","Approve");
define("_WLS_DELETE","Delete");
define("_WLS_NOSUBMITTED","No New Submitted Links.");
define("_WLS_ADDMAIN","Add a MAIN Category");
define("_WLS_TITLEC","Title: ");
define("_WLS_IMGURL","Image URL (OPTIONAL Image height will be resized to 50): ");
define("_WLS_ADD","Add");
define("_WLS_ADDSUB","Add a SUB-Category");
define("_WLS_IN","in");
define("_WLS_ADDNEWLINK","Add a New Link");
define("_WLS_MODCAT","Modify Category");
define("_WLS_MODLINK","Modify Link");
define("_WLS_TOTALVOTES","Link Votes (total votes: %s)");
define("_WLS_USERTOTALVOTES","Registered User Votes (total votes: %s)");
define("_WLS_ANONTOTALVOTES","Anonymous User Votes (total votes: %s)");
define("_WLS_USER","User");
define("_WLS_IP","IP Address");
define("_WLS_USERAVG","User AVG Rating");
define("_WLS_TOTALRATE","Total Ratings");
define("_WLS_NOREGVOTES","No Registered User Votes");
define("_WLS_NOUNREGVOTES","No Unregistered User Votes");
define("_WLS_VOTEDELETED","Vote data deleted.");
define("_WLS_NOBROKEN","No reported broken links.");
define("_WLS_IGNOREDESC","Ignore (Ignores the report and only deletes the <b>broken link report</b>)");
define("_WLS_DELETEDESC","Delete (Deletes <b>the reported website data</b> and <b>broken link reports</b> for the link.)");
define("_WLS_REPORTER","Report Sender");

define("_WLS_IGNORE","Refuse");
define("_WLS_LINKDELETED","Link Deleted.");
define("_WLS_BROKENDELETED","Broken link report deleted.");
//define("_WLS_USERMODREQ","User Link Modification Requests");
define("_WLS_ORIGINAL","Original");
define("_WLS_PROPOSED","Proposed");
define("_WLS_OWNER","Owner");
define("_WLS_NOMODREQ","No Link Modification Request.");
define("_WLS_DBUPDATED","Database Updated Successfully!");
define("_WLS_MODREQDELETED","Modification Request Deleted.");
define("_WLS_IMGURLMAIN","Image URL (OPTIONAL and Only valid for main categories. Image height will be resized to 50): ");
define("_WLS_PARENT","Parent Category:");
define("_WLS_SAVE","Save Changes");
define("_WLS_CATDELETED","Category Deleted.");
define("_WLS_WARNING","WARNING: Are you sure you want to delete this Category and ALL of its Links and Comments?");
define("_WLS_YES","Yes");
define("_WLS_NO","No");
define("_WLS_NEWCATADDED","New Category Added Successfully!");
//define("_WLS_ERROREXIST","ERROR: The Link you provided is already in the database!");
//define("_WLS_ERRORTITLE","ERROR: You need to enter a TITLE!");
//define("_WLS_ERRORDESC","ERROR: You need to enter a DESCRIPTION!");
define("_WLS_NEWLINKADDED","New Link added to the Database.");
define("_WLS_YOURLINK","Your Website Link at %s");
define("_WLS_YOUCANBROWSE","You can browse our web links at %s");
define("_WLS_HELLO","Hello %s");
define("_WLS_WEAPPROVED","We approved your link submission to our web links database.");
define("_WLS_THANKSSUBMIT","Thanks for your submission!");
define("_WLS_ISAPPROVED","We approved your link submission");


//---------------------------------------------------------
// weblinks
//---------------------------------------------------------

//======	index.php	======
// guidance bar
define("_WLS_SUBMIT_NEW_LINK","Submit New Link");
define("_WLS_SITE_POPULAR","Popular site");
define("_WLS_SITE_HIGHRATE","Top rated site");
define("_WLS_SITE_NEW","Latest site");
define("_WLS_SITE_UPDATE","Updated site");

// corrected typo
define("_WLS_SITE_RECOMMEND","Recommend site");

// BUG 3032: "mutual site" is not suitable English
define("_WLS_SITE_MUTUAL","Reciprocal site");

define("_WLS_SITE_RANDOM","Random Site");
define("_WLS_NEW_SITELIST","Latest Site");
define("_WLS_NEW_ATOMFEED","Latest RSS/ATOM Feed");
define("_WLS_SITE_RSS","RSS/ATOM Site");
define("_WLS_ATOMFEED","RSS/ATOM Feed");

define("_WLS_LASTUPDATE","Last Update");
define("_WLS_MORE","More Details");

//======	 singlelink.php	======
define("_WLS_DESCRIPTION","Description");
define("_WLS_PROMOTER","Promote");
define("_WLS_ZIP","Zip code");
define("_WLS_ADDR","Address");
define("_WLS_TEL","Telephone Number");
define("_WLS_FAX","Facsimile Number");

//======	 submit.php	======
define("_WLS_BANNERURL","Banner URL");
define("_WLS_NAME","Name");
define("_WLS_EMAIL","Email");
define("_WLS_COMPANY","Company/Organization");
define("_WLS_STATE","State");
define("_WLS_CITY","City");
define("_WLS_ADDR2","Address 2");
define("_WLS_PUBLIC","Publish");
define("_WLS_NOTPUBLIC","Do Not Publish");
define("_WLS_NOTSELECT","Not Specified");
define("_WLS_SUBMIT_INDISPENSABLE","Star mark '<b>*</b>' means an indispensable item.");
define("_WLS_SUBMIT_USER_COMMENT",'"Comment to Admin" should use an opinion, request, etc.<br />This column is not displayed on WEB.<br />Please fill in URL of your site where is linked to this site, when you want to mark "Reciprocal link".');
define("_WLS_USER_COMMENT","Comment to Admin");
define("_WLS_NOT_DISPLAY","This column is not displayed on WEB.");

//======	modlink.php	======
define("_WLS_MODIFYAPPROVED","Your link modification application has been approved. ");
define("_WLS_MODIFY_NOT_OWNER","Please ensure that you are the person that submitted the original link.");
define("_WLS_MODIFY_PENDING","Link Modification recorded. It will be published after verification.");
define("_WLS_LINKSUBMITTER","Link Submitter");

//======	user.php	======
define('_WLS_PLEASEPASSWORD','Enter your password');
define('_WLS_REGSTERED','Registered User');
define('_WLS_REGSTERED_DSC','Anybody can modify link information. <br />Webmaster will check the modification before posting.');
define('_WLS_EMAILNOTFOUND',"E-mail address didn't match.");


// error message
define("_WLS_ERROR_FILL", "Error: Enter %s");
define("_WLS_ERROR_ILLEGAL","Error: Wrong format %s");
define("_WLS_ERROR_CID",  "Error: Select category");
define("_WLS_ERROR_URL_EXIST","Error: The link has already been registered. ");
define("_WLS_WARNING_URL_EXIST","Warning: A similar link has bee already registered. ");
define("_WLS_ERRORNOLINK","Error: No such link found");


define("_WLS_CATLIST","Category List");
define("_WLS_LINKIMAGE","Link Image: ");
//define("_WLS_USERID","User ID: ");
define("_WLS_CATEGORYID","Category ID: ");
//define("_WLS_CREATEC","Registration Date: ");
define("_WLS_TIMEUPDATE","Update");
define("_WLS_NOTTIMEUPDATE","Do Not Update");
define("_WLS_LINKFLAG","Create a link under this ");
define("_WLS_NOTLINKFLAG","Do Not create a link under this");
define("_WLS_GOTOADMIN","Go to Admin Page");

// category delete
define("_WLS_DELCAT","Delete Category");
define("_WLS_SUBCATEGORY","Subcategory");
define("_WLS_SUBCATEGORY_NON","No Subcategory");
define("_WLS_LINK_BELONG","Related Links");
define("_WLS_LINK_BELONG_NUMBER","Number of related links");
define("_WLS_LINK_BELONG_NON","No related links");
define("_WLS_LINK_MAYBE_DELETE","Links to be deleted");
define("_WLS_LINK_MAYBE_DELETE_DSC","Results of the operation may differ if there are subcategories. Some other links may be deleted. ");
define("_WLS_LINK_DELETE_NON","No links to be deleted");
define("_WLS_CATEGORY_LINK_DELETE_EXCUTE","Delete category and related links");
define("_WLS_CATEGORY_LINK_DELETED","Category and related links have been deleted.");
define("_WLS_CATEGORY_DELETED","Deleted Categories");
define("_WLS_LINK_DELETED","Deleted Links");

define("_WLS_ERROR_CATEGORY","Error: Category is not selected");
define("_WLS_ERROR_MAX_SUBCAT","Error: Number of selected categories exceeds the maximum to be deleted at a time");
define("_WLS_ERROR_MAX_LINK_BELONG","Error: Number of selected related links exceeds the maximum to be deleted at a time. ");
define("_WLS_ERROR_MAX_LINK_DEL","Error: Number of selected links exceeds the maximum to be deleted at a time.");

// recommend site, mutual site
define("_WLS_MARK","mark");
define("_WLS_ADMINCOMMENT","admin comment");

// broken link check
define("_WLS_BROKEN_COUNTER","Broken Link Counter");

// RSS/ATOM URL
define("_WLS_RSS_URL","URL of RSS/ATOM");
define("_WLS_RSS_URL_0","no use");
define("_WLS_RSS_URL_1","RSS type");
define("_WLS_RSS_URL_2","ATOM type");
define("_WLS_RSS_URL_3","auto discovery");

define("_WLS_ATOMFEED_DISTRIBUTE","Distributing RSS/ATOM feeds displayed here.");
define("_WLS_ATOMFEED_FIREFOX","If you use <a href='http://www.mozilla.org/products/firefox/' target='_blank'>Firefox</a>, bookmark this page, to browse our RSS/ATOM feed. ");

// 2005-10-20
define("_WLS_EMAIL_APPROVE","Notify if approved");
define("_WLS_TOPTEN_TITLE","%s Top %u");
// %s is a link category title
// %u is number of links
define("_WLS_TOPTEN_ERROR", "There are too many top categories. stopped to show by %u");
// %u is munber of categories

// 2006-04-02
define('_WEBLINKS_MID', 'Modify ID');
define('_WEBLINKS_USERID', 'User ID');
define('_WEBLINKS_CREATE', 'Created');

// conflict with rssc
//define('_HOME',  'Home');
//define('_SAVE',  'Save');
//define('_SAVED', 'Saved');
//define('_CREATE', 'Create');
//define('_CREATED','Created');
//define('_FINISH',   'Finish');
//define('_FINISHED', 'Finished');
//define('_EXECUTE', 'Execute');
//define('_EXECUTED','Executed');
//define('_PRINT','Print');
//define('_SAMPLE','Sample');

define('_NO_MATCH_RECORD','There are no matching record');
define('_MANY_MATCH_RECORD','There are two or more matched records');
define('_NO_CATEGORY', 'No Category');	
define('_NO_LINK', 'No Link');
define('_NO_TITLE', 'No Title');
define('_NO_URL', 'No URL');
define('_NO_DESCRIPTION','No Description');

//define('_GOTO_MAIN',   'Go to Main');
//define('_GOTO_MODULE', 'Go to Module');

// config
//define('_WEBLINKS_INIT_NOT', 'The config table is not initialized');
//define('_WEBLINKS_INIT_EXEC', 'Config Table Initialized');
//define('_WEBLINKS_VERSION_NOT','This module is not version  %s yet. Update now');
//define('_WEBLINKS_UPGRADE_EXEC','Upgrade the config table');

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

// === 2006-10-01 ===
// conflict with rssc
//if( !defined('_SAVE') ) 
//{
//	define('_HOME',  'Home');
//	define('_SAVE',  'Save');
//	define('_SAVED', 'Saved');
//	define('_CREATE', 'Create');
//	define('_CREATED','Created');
//	define('_EXECUTE', 'Execute');
//	define('_EXECUTED','Executed');
//}

define('_WEBLINKS_MAP_USE', 'Use Map Icon');

// rssc
define('_WEBLINKS_RSSC_LID',  'RSSC Lid');
define('_WEBLINKS_RSS_MODE',  'RSS Mode');
define('_WEBLINKS_RSSC_NOT_INSTALLED', 'RSSC module ( %s ) is not installed');
define('_WEBLINKS_RSSC_INSTALLED',     'RSSC module ( %s ) ver %s is installed');
define('_WEBLINKS_RSSC_REQUIRE', 'Requires RSSC module ver %s or later');
define('_WEBLINKS_GOTO_SINGLELINK', 'GOTO Link Info');

// warnig
define('_WEBLINKS_WARN_NOT_READ_URL', 'Warning: Cannnot read url');
define('_WEBLINKS_WARN_BANNER_NOT_GET_SIZE', 'Warning: cannnot get banner size');

// google map: hacked by wye <http://never-ever.info/>
define('_WEBLINKS_GM_LATITUDE',  'Latitude');
define('_WEBLINKS_GM_LONGITUDE', 'Longitude');
define('_WEBLINKS_GM_ZOOM',      'Zoom Level');
define('_WEBLINKS_GM_GET_LOCATION', 'The location information is acquired with GoogleMaps');
//define('_WEBLINKS_GM_GET_BUTTON', 'Get Latitude/Longitude/Zoom');
define('_WEBLINKS_GM_DEFAULT_LOCATION', 'Default Location');
define('_WEBLINKS_GM_CURRENT_LOCATION', 'Current Location');

// === 2006-11-04 ===
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

// === 2006-12-11 ===
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

// === 2007-02-20 ===
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

// === 2007-03-25 ===
define('_WEBLINKS_ALBUM_ID',  'Album ID');
define('_WEBLINKS_ALBUM_SEL', 'Album Select');

// === 2007-04-08 ===
define('_WEBLINKS_GM_TYPE',  'Google Map Type');
define('_WEBLINKS_GM_TYPE_MAP',       'Map');
define('_WEBLINKS_GM_TYPE_SATELLITE', 'Satellite');
define('_WEBLINKS_GM_TYPE_HYBRID',    'Hybrid');

// === 2007-08-01 ===
define('_WEBLINKS_GM_CURRENT_ADDRESS', 'Current Address');
define('_WEBLINKS_GM_SEARCH_LIST', 'Search Results List');

// === 2007-09-01 ===
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

// === 2007-11-01 ===
define('_WEBLINKS_ERROR_LENGTH', "Error: %s must be less than %s characters");

// === 2008-02-17 ===
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

//---------------------------------------------------------
// 2012-04-02 v2.10
//---------------------------------------------------------
// webmap3
define('_WEBLINKS_WEBMAP3_NOT_INSTALLED', 'NOT installed WEBMAP3 module ( %s ) ');
define('_WEBLINKS_WEBMAP3_INSTALLED',     'Installed WEBMAP3 module ( %s ) ver %s ');
define('_WEBLINKS_WEBMAP3_REQUIRE',       'Require WEBMAP3 module ver %s or later');

// google map
define('_WEBLINKS_GM_LOCATION', 'Location');
define('_WEBLINKS_GM_ICON', 'Google Icon');

}
// --- define language end ---

?>