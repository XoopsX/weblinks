<?php
// $Id: main.php,v 1.1 2011/12/29 14:32:44 ohwada Exp $

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

//======         singlelink.php        ======
define("_WLS_CATEGORY","ÇáŞÓã");
define("_WLS_HITS","ÇáÒíÇÑÇÊ");
define("_WLS_RATING","ÇáÊŞííã");
define("_WLS_VOTE","ÇáÊÕæíÊ");
define("_WLS_ONEVOTE","ÕæÊ æÇÍÏ");
define("_WLS_NUMVOTES","%s ÕæÊ");
define("_WLS_RATETHISSITE","Şííã åĞÇ ÇáãæŞÚ");
define("_WLS_REPORTBROKEN","ÇÎÈÑäÇ Úä æÕáÉ áÇ ÊÚãá");
define("_WLS_TELLAFRIEND","ÃÎÈÑ ÕÏíŞ");
define("_WLS_EDITTHISLINK","ÊÚÏíá åĞÇ ÇáÑÇÈØ");
define("_WLS_MODIFY","ÊÚÏíá");

//======        submit.php        ======
define("_WLS_SUBMITLINKHEAD","ÇÑÓÇá ÑÇÈØ ÌÏíÏÉ");
define("_WLS_SUBMITONCE","ÃÑÓá ãæŞÚß ãÑÉ æÇÍÏÉ");
define("_WLS_DONTABUSE","Êã ÍİÙ ÇáÇÓã ãÚ ÇáÇí Èí ÑÌÇÁ áÇ ÊÔÛá ÇáäÙÇã.");
define("_WLS_TAKESHOT","Óæİ äÃÎĞ ÕæÑÉ ãÕÛÑÉ Úä ÇáãæŞÚ æÓæİ ÊÍÊÇÌ Çáí ÚÏÉ ÇíÇã áÇÖÇİÊåÇ Çáí ŞÇÚÏÉ ÇáÈíÇäÇÊ.");
define("_WLS_ALLPENDING","Óæİ íÊã ÇáÊÍŞíŞ ãä ÇáÑÇÈØ ŞÈá ÇáäÔÑ ");
//define("_WLS_WHENAPPROVED","Óæİ äÑÓá áß Çãíá İí ÍÇáÉ ÇáãæÇİŞÉ.");
define("_WLS_RECEIVED","áŞÏ ÊáŞíäÇ ãÚáæãÇÊ ãæŞÚß ÔßÑÇ áß!");

//======        modlink.php        ======
define("_WLS_REQUESTMOD","ØáÈ İí ÊÚÏíá ÑÇÈØ");
define("_WLS_THANKSFORINFO","ÔßÑÇ áåĞí ÇáãÚáæãÇÊ , Óæİ äÑì ØáÈß İí ÃŞÕÑ æŞÊ.");


define("_WLS_THANKSFORHELP","ÔßÑÇ ááãÓÇÚÏÉ áÅÈŞÇÁ ÓáÇãÉ åĞÇ ÇáÏáíá.");
define("_WLS_FORSECURITY","áÃÓÈÇÈ ÃãäíÉ ÇáÇÓã æÚäæÇä Âí Èí áÏíß ÓíÊã ÊÓÌíáåÇ ÈÔßá ãÄŞÊ.");

define("_WLS_SEARCHFOR","ÈÍË Úä"); //-no use
define("_WLS_ANY","Ãí");
define("_WLS_SEARCH","ÈÍË");

//define("_WLS_MAIN","Main");
define("_WLS_SUBMITLINK","ÃÑÓá ÑÇÈØ");
define("_WLS_POPULAR","ÇáãÔåæÑ");
define("_WLS_TOPRATED","ÃİÖá ÊŞííã");

define("_WLS_NEWTHISWEEK","ÌÏíÏ ÇáÃÓÈæÚ");
define("_WLS_UPTHISWEEK","ÍÏíË åĞÇ ÇáÃÓÈæÚ");

define("_WLS_POPULARITYLTOM","ÇáÃßËÑ ÒíÇÑÉ (ÃŞá Åáì ÃßËÑ ÒíÇÑÇÊ)");
define("_WLS_POPULARITYMTOL","ÇáÃßËÑ ÒíÇÑÉ (ÃßËÑ Åáì ÃŞá ÒíÇÑÇÊ)");
define("_WLS_TITLEATOZ","ÇáÚäæÇä (Ç Çáì í)");
define("_WLS_TITLEZTOA","ÇáÚäæÇä (í Çáì Ç)");
define("_WLS_DATEOLD","ÇáÊÇÑíÎ (ÇáÑæÇÈØ ÇáŞÏíãÉ ÃæáÇ)");
define("_WLS_DATENEW","ÇáÊÇÑíÎ (ÇáÑæÇÈØ ÇáÌÏíÏÉ ÃæáÇ)");
define("_WLS_RATINGLTOH","ÇáÊŞíã (ãä ÇáÃŞá Åáì ÇáÃÚáì)");
define("_WLS_RATINGHTOL","ÇáÊŞííã (ãä ÇáÃÚáì Åáì ÇáÃŞá)");

//define("_WLS_NOSHOTS","áÇ íæÌÏ ÕæÑÉ ãÊæİÑÉ");
//define("_WLS_DESCRIPTIONC","ÇáæÕİ: ");
//define("_WLS_EMAILC","ÇáÈÑíÏ: ");
//define("_WLS_CATEGORYC","ÇáŞÓã: ");
//define("_WLS_LASTUPDATEC","ÂÎÑ ÊÍÏíË: ");
//define("_WLS_HITSC","ÇáÒíÇÑÇÊ: ");
//define("_WLS_RATINGC","ÇáÊŞíã: ");

define("_WLS_THEREARE","åäÇß <b> %s </b> ãæÇŞÚ İí ŞÇÚÏÉ ÇáÈíÇäÇÊ");
define("_WLS_LATESTLIST","ÂÎÑ ÇáäÊÇÆÌ");

//define("_WLS_LINKID","ÑŞã ÇáæÕáÉ: ");
//define("_WLS_SITETITLE","ÇÓã ÇáãæŞÚ: ");
//define("_WLS_SITEURL","ÚäæÇä ÇáãæŞÚ: ");
//define("_WLS_OPTIONS","ÎíÇÑÇÊ: ");
define("_WLS_LINKID","ÑŞã ÇáÑÇÈØ");
define("_WLS_SITETITLE","ÅÓã ÇáãæŞÚ");
define("_WLS_SITEURL","ÚäæÇä ÇáãæŞÚ");
define("_WLS_OPTIONS","ÎíÇÑÇÊ");

define("_WLS_NOTIFYAPPROVE", "ÊÈáíÛí ãÊì íÊã ÇáãæÇİŞÉ Úáì ÇáÑÇÈØ");
//define("_WLS_SHOTIMAGE","ÕæÑÉ ãÕÛÑÉ: ");
define("_WLS_SENDREQUEST","ÃÑÓá ØáÈ");

define("_WLS_VOTEAPPRE","ÔßÑÇ Úáí ÇáÊÕæíÊ");
define("_WLS_THANKURATE","ÔßÑÇ áß áÊŞíã åĞÇ ÇáãæŞÚ %s.");
define("_WLS_VOTEFROMYOU","ãÓÇåãÉ ÇáÇÚÖÇÁ  äİÓß ÇäÊ Óæİ ÓÊÓÇÚÏ ÇáÒæÇÑ Úáí ÊŞÑíÑ Ãí ÑÇÈØ íÎÊÇÑæäÉ.");
define("_WLS_VOTEONCE","ÑÌÇÁ áÇ ÊŞííã ÇáãæŞÚ ÃßËÑ ãä ãÑÉ");
define("_WLS_RATINGSCALE","Åä ãŞíÇÓ ÇáÊŞííãÇÊ ãä 1 Çáì 10¡ ÈÜ1 íßæä ÓíøÆ æ10 íßæä ããÊÇÒ.");
define("_WLS_BEOBJECTIVE","ÑÌÇÁ ßä åÏÇİ¡ ÅĞÇ ÇÓÊáã ßá æÇÍÏ  1 Ãæ  10¡ ÈÚÖ ÇáÊŞííãÇÊ áíÓÊ ãİíÏÉ ÌÏÇ.");
define("_WLS_DONOTVOTE","áÇ ÊÕæøÊ áÕÇáÍß ÇáÔÎÕí.");
define("_WLS_RATEIT","ŞííãÉ!");

define("_WLS_INTRESTLINK","ÑÇÈØ ãæŞÚ ãİíÏÉ İí %s");  // %s is your site name
define("_WLS_INTLINKFOUND","åäÇ ÑÇÈØ ãæŞÚ æíÈ ãİíÏ æÌÏÊ İí %s");  // %s is your site name

define("_WLS_RANK","ÇáÊÑÊíÈ");
define("_WLS_TOP10","%s Top 10"); // %s is a link category title

define("_WLS_SEARCHRESULTS","äÊÇÆÌ ÇáÈÍË Úä <b>%s</b>:"); // %s is search keywords
define("_WLS_SORTBY","ÊÑÊíÈ ÍÓÈ:");
define("_WLS_TITLE","ÇáÚäæÇä");
define("_WLS_DATE","ÇáÊÇÑíÎ");
define("_WLS_POPULARITY","ÇáÃßËÑ ÒíÇÑÉ");
define("_WLS_CURSORTEDBY","ÇáãæÇŞÚ ãÑÊøÈÉ ÍÇáíÇ ÍÓÈ: %s");
define("_WLS_PREVIOUS","ÇáÓÇÈŞ");
define("_WLS_NEXT","ÇáÊÇáí");
define("_WLS_NOMATCH","áÇ íæÌÏ ÇáßËíÑ Úä ÈÍËß");

define("_WLS_SUBMIT","ÇÑÓÇá");
define("_WLS_CANCEL","ÇáÛÇÁ");

define("_WLS_ALREADYREPORTED","áŞÏ ŞÏãÊ ÊŞÑíÑÇ ãÓÈŞÇ Úä åĞÇ ÇáÇãÑ");
define("_WLS_MUSTREGFIRST","ÂÓİ¡ áíÓ áÏíß ÊÕÑíÍ áÅÏÇÁ åĞå ÇáÚãáíÉ. <br /> ÑÌÇÁ ÓÌøá Ãæ ÇÏÎá ÃæáÇ!");
define("_WLS_NORATING","áÇ íæÌÏ ÊŞíã ãÍÏÏ");
define("_WLS_CANTVOTEOWN"," áÇ íãßäß ÇáÊÕæíÊ Úáì ãæŞÚß. <br /> ßáø ÇáÃÕæÇÊ ÊÓÌøá æÊÑÇÌÚ.");
define("_WLS_VOTEONCE2","ÕæøÊ áÕÇáÍ ÇáãæŞÚ ãÑÉ æÇÍÏÉ. <br /> ßáø ÇáÃÕæÇÊ ÊÓÌøá æÊÑÇÌÚ.");

//%%%%%%        Admin          %%%%%

define("_WLS_WEBLINKSCONF","ÎíÇÑÇÊ ÑæÇÈØ ÇáæíÈ");
define("_WLS_GENERALSET","ÎíÇÑÇÊ ÇáÑæÇÈØ ÇáÚÇãÉ");
//define("_WLS_ADDMODDELETE","Add, Modify, and Delete Categories/Links");
define("_WLS_LINKSWAITING","ÇáÑæÇÈØ ÇáÌÏíÏÉ ÇáÊí ÊäÊÙÑ ÇáãæÇİŞÉ");
define("_WLS_MODREQUESTS","ÇáÑæÇÈØ ÇáãÚÏáÉ ÇáÊí ÊäÊÙÑ ÇáãæÇİŞÉ");
define("_WLS_BROKENREPORTS","ÊŞÇÑíÑ ÇáÑæÇÈØ ÇáÊí áÇ ÊÚãá");

//define("_WLS_SUBMITTER","Submitter: ");
define("_WLS_SUBMITTER","ÇáãÑÓá");

define("_WLS_VISIT","ÒíÇÑÉ");

//define("_WLS_SHOTMUST","Screenshot image must be a valid image file under %s directory (ex. shot.gif). Leave it blank if no image file.");
define("_WLS_LINKIMAGEMUST"," ÅÏÎá ÇÓã ãáİ æÕáÉ ÇáÕæÑÉ ÊÍÊ Ïáíá %s . (ãËÇá Úáì Ğáß: - shot.gif) ÇÊÑß ÇáÍŞá İÇÑÛ ÅĞÇ áíÓ åäÇß ãáİ ááÕæÑÉ.");

define("_WLS_APPROVE","ãæÇİŞÉ");
define("_WLS_DELETE","ÍĞİ");
define("_WLS_NOSUBMITTED","áÇ íæÌÏ ÑæÇÈØ ãÑÓáÉ ÌÏíÏÉ.");
define("_WLS_ADDMAIN","ÃÖİ ŞÓã ÑÆíÓí");
define("_WLS_TITLEC","ÇáÚäæÇä: ");
define("_WLS_IMGURL","ÚäæÇä ÇáÕæÑÉ (ÅÑÊİÇÚ ÇáÕæÑÉ Óæİ íÚÇÏ ÊÍÌíãÉ Çáí 50): ");
define("_WLS_ADD","ÃÖİ");
define("_WLS_ADDSUB","ÇÖİ ŞÓã İÑÚí");
define("_WLS_IN","İí");
define("_WLS_ADDNEWLINK","ÅÖÇİÉ ÑÇÈØ ÌÏíÏÉ");
define("_WLS_MODCAT","ÊÚÏíá ŞÓã");
define("_WLS_MODLINK","ÊÚÏíá ãæŞÚ");
define("_WLS_TOTALVOTES","ÃÕæÇÊ ÇáÑæÇÈØ (ãÌãæÚ ÇáÊÕæíÊÇÊ: %s)");
define("_WLS_USERTOTALVOTES","ÃÕæÇÊ ÇáÃÚÖÇÁ ÇáãÓÌáíä (ãÌãæÚ ÇáÊÕæíÊÇÊ: %s)");
define("_WLS_ANONTOTALVOTES","ÃÕæÇÊ ÇáÒæÇÑ (ãÌãæÚ ÇáÊÕæíÊÇÊ: %s)");
define("_WLS_USER","ÚÖæ");
define("_WLS_IP","ÑŞã ÇáÃí Èí");
define("_WLS_USERAVG","ãÊæÓØ ÇáÊŞíã");
define("_WLS_TOTALRATE","ãÌãæÚ ÇáÊŞíã");
define("_WLS_NOREGVOTES","áÇ íæÌÏ ÃÚÖÇ ãÕæÊíä");
define("_WLS_NOUNREGVOTES","áÇ íæÌÏ ÒæÇÑ ãÕæÊíä");
define("_WLS_VOTEDELETED","ÈíÇäÇÊ ÇáÊÕæíÊ ÍĞİÊ.");
define("_WLS_NOBROKEN","áÇ íæÌÏ ÊŞÇÑíÑ Úä ÑæÇÈØ áÇ ÊÚãá.");
define("_WLS_IGNOREDESC","Ãåãá (ÃåãÇá ÇáÊŞÑíÑ æÍĞİ İŞØ <b> ÊŞÑíÑ ÇáÑæÇÈØ ÇáÊí áÇ ÊÚãá </b>) ");
define("_WLS_DELETEDESC","ÅÍĞİ (ÍĞİ <b> ÈíÇäÇÊ ÇáãæŞÚ ÇáãõÈáÛ ÚäåÇ </b> æ<b> ÊŞÇÑíÑ ÇáÑæÇÈØ ÇáÊí áÇ ÊÚãá </b> ááÑÇÈØ.)");
define("_WLS_REPORTER","ÊŞÑíÑ ãÑÓá");

define("_WLS_IGNORE","ÑİÖ");
define("_WLS_LINKDELETED","ÍĞİ ÇáÑÇÈØ.");
define("_WLS_BROKENDELETED","ÊŞÑíÑ Úä ÇáÑÇÈØ ÇáĞí áÇ íÚãá ÍĞİ.");
//define("_WLS_USERMODREQ","User Link Modification Requests");
define("_WLS_ORIGINAL","ÃÕáí");
define("_WLS_PROPOSED","íŞÊÑÍ");
define("_WLS_OWNER","ÇáãÇáß");
define("_WLS_NOMODREQ","áÇ íæÌÏ ØáÈ ÊÚÏíá ÑÇÈØ.");
define("_WLS_DBUPDATED","Êã ÊÍÏíË ŞÇÚÏÉ ÇáÈíÇäÇÊ ÈäÌÇÍ!");
define("_WLS_MODREQDELETED","ØáÈ ÊÚÏíá ÍõĞİ.");
define("_WLS_IMGURLMAIN","ÚäæÇä ÇáÕæÑÉ ( ÅÎÊíÇÑíÉ: æİŞØ ááÃŞÓÇã ÇáÑÆíÓíÉ. ÅÑÊİÇÚ ÕæÑÉ ÓíÚÇÏ ÊÍÌíãÉ Çáì 50):");
define("_WLS_PARENT","ÇáŞÓã ÇáÑÆíÓí");
define("_WLS_SAVE","ÍİÙ ÇáÊÛíÑÇÊ");
define("_WLS_CATDELETED","ÇáŞÓã ÍĞİ.");
define("_WLS_WARNING","ÊÍĞíÑ: åá ÃäÊ ãÊÃßÏ ÈÃä ÊÍĞİ åĞÇ ÇáŞÓã æßá ÇáÑæÇÈØ æÊÚáíŞÇÊåÇ¿");
define("_WLS_YES","äÚã");
define("_WLS_NO","áÇ");
define("_WLS_NEWCATADDED","Êã ÅÖÇİÉ ÇáŞÓã ÈäÌÇÍ!");
//define("_WLS_ERROREXIST","ERROR: The Link you provided is already in the database!");
//define("_WLS_ERRORTITLE","ERROR: You need to enter a TITLE!");
//define("_WLS_ERRORDESC","ERROR: You need to enter a DESCRIPTION!");
define("_WLS_NEWLINKADDED","ÅÖÇİÊ ÑÇÈØ ÌÏíÏÉ Åáì ŞÇÚÏÉ ÇáÈíÇäÇÊ.");
define("_WLS_YOURLINK","ÑÇÈØ ãæŞÚß İí %s");
define("_WLS_YOUCANBROWSE"," íãßä Ãä ÊÊÕİÍ ÑæÇÈØ ãæŞÚäÇ İí %s");
define("_WLS_HELLO","Hello %s");
define("_WLS_WEAPPROVED","áŞÏ ÊãÊ ÇáãæÇİŞÉ Úáí ÑÇÈØ ÇáãæŞÚ");
define("_WLS_THANKSSUBMIT","ÔßÑÇ áÅÑÓÇáß!");
define("_WLS_ISAPPROVED","áŞÏ ÊãÊ ÇáãæÇİŞÉ Úáí ÇáÑÇÈØ");


//---------------------------------------------------------
// weblinks
//---------------------------------------------------------

//======        index.php        ======
// guidance bar
define("_WLS_SUBMIT_NEW_LINK","ÃÖİ ãæŞÚß");
define("_WLS_SITE_POPULAR","ÇáãæÇŞÚ ÇáÃßËÑ ÒíÇÑÉ");
define("_WLS_SITE_HIGHRATE","ÃİÖá ÇáãæÇŞÚ ÇáãŞíãÉ");
define("_WLS_SITE_NEW","ÂÎÑ ÇáãæÇŞÚ");
define("_WLS_SITE_UPDATE","ÊÍÏíÏË ÇáãæŞÚ");

// corrected typo
define("_WLS_SITE_RECOMMEND","ãæÇŞÚ íäÕÍ İíåÇ");

// BUG 3032: "mutual site" is not suitable English
define("_WLS_SITE_MUTUAL","ÇáãæÇŞÚ ÇáãÊÈÇÏáÉ");

define("_WLS_SITE_RANDOM","ãæŞÚ ÚÔæÇÆí");
define("_WLS_NEW_SITELIST","ÂÎÑ ãæŞÚ");
define("_WLS_NEW_ATOMFEED","Latest RSS/ATOM Feed");
define("_WLS_SITE_RSS","RSS/ATOM Site");
define("_WLS_ATOMFEED","RSS/ATOM Feed");

define("_WLS_LASTUPDATE","ÂÎÑ ÊÍÏíÏË");
define("_WLS_MORE","ãÒíÏ ãä ÇáÊİÇÕíá");

//======         singlelink.php        ======
define("_WLS_DESCRIPTION","ÇáæÕİ");
define("_WLS_PROMOTER","ÇáäÇÔÑ");
define("_WLS_ZIP","ÇáÑãÒ ÇáÈÑíÏí");
define("_WLS_ADDR","ÇáÚäæÇä");
define("_WLS_TEL","ÑŞã ÇáÊáİæä");
define("_WLS_FAX","ÚÏÏ ÇáäÓÎÉ");

//======         submit.php        ======
define("_WLS_BANNERURL","ÚäæÇä ÇáÈäÑ");
define("_WLS_NAME","ÇáÃÓã");
define("_WLS_EMAIL","ÇáÈÑíÏ");
define("_WLS_COMPANY","ÔÑßÉ / ãäÙãÉ");
define("_WLS_STATE","ÇáæáÇíÉ");
define("_WLS_CITY","ÇáãÏíäÉ");
define("_WLS_ADDR2","ÚäæÇä 2");
define("_WLS_PUBLIC","äÔÑ");
define("_WLS_NOTPUBLIC","ÚÏã äÔÑ");
define("_WLS_NOTSELECT","áíÓ ãÍÏøÏ");
define("_WLS_SUBMIT_INDISPENSABLE","ÚáÇãÉ ÇáäÌãÉ ' <b> * </b> ' íÚäí ÅÌÈÇÑíÉ.");
define("_WLS_SUBMIT_USER_COMMENT",'"ÅÑÓÇá Åáì ÇáÅÏÇÑÉ  <br /> åĞÇ ÇáÚãæÏ áä íÚÑÖ Úáì ÇáæíÈ. <br /> ÑÌÇÁ ÇßÊÈ ÚäæÇä ãæŞÚß ÍíË íæÌÏ ÑÇÈØ ãæŞÚäÇ¡ ÇĞÇ ßäÊ  ÊÑíÏ Úãá "ÊÈÇÏá ãæÇŞÚ".');
define("_WLS_USER_COMMENT","ÊÚáíŞ ááÃÏãä");
define("_WLS_NOT_DISPLAY","åĞÇ ÇáÚãæÏ áä íÚÑÖ Úáì ÇáæíÈ.");

//======        modlink.php        ======
define("_WLS_MODIFYAPPROVED","ÊãÊ ÇáãæÇİŞÉ Úáí ÊÚÏíá ãæŞÚß ");
define("_WLS_MODIFY_NOT_OWNER","ÑÌÇÁ ÅÖãä ÈÃäøß ÇáÔÎÕ ÇáĞí ŞÏøã ÇáÑÇÈØ ÇáÃÕáí.");
define("_WLS_MODIFY_PENDING","ÊÚÏíá ãæŞÚ ãÓÌá. Óæİ íÊã ÇáäÔÑ ÈÚÏ ÇáÊÍŞŞ ãä ÇáÑÇÈØ.");
define("_WLS_LINKSUBMITTER","ÑæÇÈØ ãÑÓáÉ");

//======        user.php        ======
define('_WLS_PLEASEPASSWORD','ÇÏÎá ÇáÑŞã ÇáÓÑí');
define('_WLS_REGSTERED','ÚÖæ ãÓÌá');
define('_WLS_REGSTERED_DSC','Ãí ÔÎÕ íãßä Ãä íÚÏá ãÚáæãÇÊ ÑÇÈØ. <br /> ãÓÄæá ÇáãæŞÚ ÓíÏŞŞ ÇáÊÚÏíá ŞÈá ÇáäÔÑ.');
define('_WLS_EMAILNOTFOUND',"ÇáÑÌÇÁ ÇáÊÃßÏ ãä ÇáÈÑíÏ");


// error message
define("_WLS_ERROR_FILL", "ÎØÃ: ÏÎæá %s");
define("_WLS_ERROR_ILLEGAL","ÎØÃ: ÇáÕíÛÉ ÎÇØÆÉ %s");
define("_WLS_ERROR_CID",  "ÎØÃ: ÊÍÏíÏ ÇáŞÓã");
define("_WLS_ERROR_URL_EXIST","ÎØÃ: ÇáãæŞÚ ãÓÌáÉ ãä Şíá. ");
define("_WLS_WARNING_URL_EXIST","ÊÍĞíÑ: Êã ÊÓÌíá ãæŞÚ ãÔÇÈÉ ãä ŞÈá. ");
define("_WLS_ERRORNOLINK","ÎØÃ: áã íÊã ÇáÚËæÑ Úáì ÇáãæŞÚ");


define("_WLS_CATLIST","ŞÇÆãÉ ÇáÃŞÓÇã");
define("_WLS_LINKIMAGE","æÕáÉ ÇáÕæÑÉ: ");
//define("_WLS_USERID","ÑŞã ÇáÚÖæ: ");
define("_WLS_CATEGORYID","ÑŞã ÇáŞÓã: ");
//define("_WLS_CREATEC","ÊÇÑíÎ ÇáÊÓÌíá: ");
define("_WLS_TIMEUPDATE","ÊÍÏíË");
define("_WLS_NOTTIMEUPDATE","ÚÏã ÇáÊÍÏíË");
define("_WLS_LINKFLAG","ÊÓÌíá ãæÇŞÚ İí åĞÇ ÇáŞÓã");
define("_WLS_NOTLINKFLAG","ÚÏã ÊÓÌíá ãæÇŞÚ İí åĞÇ ÇáŞÓã");
define("_WLS_GOTOADMIN","ÇáĞåÇÈ Çáí ÕİÍÉ ÇáÃÏãä");

// category delete
define("_WLS_DELCAT","ÍĞİ ÇáŞÓã");
define("_WLS_SUBCATEGORY","ŞÓã İÑÚí");
define("_WLS_SUBCATEGORY_NON","áÇ íæÌÏ ŞÓã İÑÚí");
define("_WLS_LINK_BELONG","ãæŞÚ ãÊÈÇÏáÉ");
define("_WLS_LINK_BELONG_NUMBER","ÚÏÏ ÇáÑæÇÈØ ÇáãÊÈÇÏáÉ");
define("_WLS_LINK_BELONG_NON","áÇ íæÌÏ ÑæÇÈØ ãÊÈÇÏáÉ");
define("_WLS_LINK_MAYBE_DELETE","ÑæÇÈØ ÓÊÍĞİ");
define("_WLS_LINK_MAYBE_DELETE_DSC","äÊÇÆÌ ÇáÚãáíÉ ŞÏ ÊÎÊáİ ÅĞÇ åäÇß ÃŞÓÇã İÑÚíÉ . ÇáÑæÇÈØ ÇáÃÎÑì ŞÏ ÊÍĞİ.");
define("_WLS_LINK_DELETE_NON","áÇ íæÌÏ ÑæÇÈØ áÍĞİåÇ");
define("_WLS_CATEGORY_LINK_DELETE_EXCUTE","ÍĞİ ÇáŞÓã ãÚ ÇáÑæÇÈØ");
define("_WLS_CATEGORY_LINK_DELETED","Êã ÍĞİ ÇáŞÓã ãÚ ÇáÑæÇÈØ.");
define("_WLS_CATEGORY_DELETED","ÇáÃŞÓÇã ÍĞİÊ");
define("_WLS_LINK_DELETED","ÇáÑæÇÈØ ÍĞİÊ");

define("_WLS_ERROR_CATEGORY","ÎØÃ: áã íÊã ÊÍÏíÏ ÇáŞÓã");
define("_WLS_ERROR_MAX_SUBCAT","ÎØÃ: ÚÏÏ ÇáÃŞÓÇã ÇáãÍÏÏÉ ÊÌÇæÒ ÇáÍÏ ÇáÃÚáì áíÊã ÍĞİåÇ İí ÇáæŞÊ");
define("_WLS_ERROR_MAX_LINK_BELONG","ÎØÃ: ÚÏÏ ÇáÑæÇÈØ ÇáãÊÈÇÏáÉ ÊÌÇæÒ ÇáÍÏ ÇáÃÚáì áíÊã ÍĞİåÇ İí ÇáæŞÊ");
define("_WLS_ERROR_MAX_LINK_DEL","ÎØÃ: ÚÏÏ ÇáÑæÇÈØ ÇáãÍÏÏÉ ÊÌÇæÒ ÇáÍÏ ÇáÃÚáì áßí íÍĞİ İí ÇáæŞÊ");

// recommend site, mutual site
define("_WLS_MARK","ÚáÇãÉ");
define("_WLS_ADMINCOMMENT","ÊÚáíŞ ÇáÃÏãä");

// broken link check
define("_WLS_BROKEN_COUNTER","ÚÏÇÏ ÇáÑÇÈØ áÇ íÚãá");

// RSS/ATOM URL
define("_WLS_RSS_URL","URL of RSS/ATOM");
define("_WLS_RSS_URL_0","ÚÏã ÅÓÊÚãÇá");
define("_WLS_RSS_URL_1","RSS type");
define("_WLS_RSS_URL_2","ATOM type");
define("_WLS_RSS_URL_3","ÅÓÊßÔÇİ Âáí");

define("_WLS_ATOMFEED_DISTRIBUTE","Distributing RSS/ATOM feeds displayed here.");
define("_WLS_ATOMFEED_FIREFOX","If you use <a href='http://www.mozilla.org/products/firefox/' target='_blank'>Firefox</a>, bookmark this page, to browse our RSS/ATOM feed. ");

// 2005-10-20
define("_WLS_EMAIL_APPROVE","ÊÈáíŞí İí ÍÇáÉ ÇáãæÇİŞÉ");
define("_WLS_TOPTEN_TITLE","%s Top %u");
// %s is a link category title
// %u is number of links
define("_WLS_TOPTEN_ERROR", "åäÇß ÇáßËíÑ ãä ÇáÃŞÓÇã ÇáÑÆíÓíÉ. ÇäÙÑ ÍÓÈ %u");
// %u is munber of categories

// 2006-04-02
define('_WEBLINKS_MID', 'ÊÚÏíá ÑŞã');
define('_WEBLINKS_USERID', 'ÑŞã ÇáÚÖæ');
define('_WEBLINKS_CREATE', 'ÇäÔÃÊ');

// conflict with rssc
//define('_HOME',  'Home');
//define('_SAVE',  'Save');
//define('_SAVED', 'Saved');
//define('_CREATE', 'Create');
//define('_CREATED','Created');
define('_FINISH',   'ÇáäåÇíÉ');
define('_FINISHED', 'íäåí');
//define('_EXECUTE', 'Execute');
//define('_EXECUTED','Executed');
define('_PRINT','ØÈÇÚÉ');
define('_SAMPLE','ÚíäÉ');

define('_NO_MATCH_RECORD','áÇ íÌæÌÏ ÓÌáÇÊ ãÊÔÇÈÉ');
define('_MANY_MATCH_RECORD','íæÌÏ ÅËäÇä Ãæ ÃßËÑ ÓÌáÇÊ ãÊÔÇÈÉ ');
define('_NO_CATEGORY', 'áÇ íæÌÏ ŞÓã');
define('_NO_LINK', 'áÇ íæÌÏ ÑÇÈØ');
define('_NO_TITLE', 'áÇ íæÌÏ ÚäæÇä');
define('_NO_URL', 'áÇ íæÌÏ ãæŞÚ');
define('_NO_DESCRIPTION','áÇ íæÌÏ æÕİ');

define('_GOTO_MAIN',   'ÇáĞåÇÈ Çáí ÇáÑÆíÓíÉ');
define('_GOTO_MODULE', 'ÇáĞåÇÈ Çáí ÇáÈÑäÇãÌ');

// config
define('_WEBLINKS_INIT_NOT', 'áã ÊÔÛá ÎíÇÑÇÊ ÇáÌÏæá');
define('_WEBLINKS_INIT_EXEC', 'ÎíÇÑÇÊ ÇáÌÏæá ÔÛáÊ');
define('_WEBLINKS_VERSION_NOT','This module is not version  %s yet. Update now');
define('_WEBLINKS_UPGRADE_EXEC','ÊØæíÑ ÎíÇÑÇÊ ÇáÌÏæá');

// html tag
define('_WEBLINKS_OPTIONS', 'ÎíÇÑÇÊ');
define('_WEBLINKS_DOHTML', ' ÊİÚíá ÃßæÇÏ html ');
define('_WEBLINKS_DOIMAGE', 'ÊİÚíá ÇáÕæÑ');
define('_WEBLINKS_DOBREAK', ' ÊİÚíá ÇáİŞÑÉ');
define('_WEBLINKS_DOSMILEY', ' ÊİÚíá ÇáÃÈÊÓÇãÇÊ');
define('_WEBLINKS_DOXCODE', 'ÊİÚíá ÃßæÇÏ xoops');

define('_WEBLINKS_PASSWORD_INCORRECT','ÇáÑŞã ÇáÓÑí ÎØÃ');
define('_WEBLINKS_ETC', 'etc');
define('_WEBLINKS_AUTH_UID',    'User ID Match');
define('_WEBLINKS_AUTH_PASSWD', 'Password Match');
define('_WEBLINKS_BANNER_SIZE', 'ãŞÇÓ ÇáÈäÑ');

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

define('_WEBLINKS_MAP_USE', 'ÅÓÊÚãÇá ÇíŞæäÉ ÇáÎÑíØÉ');

// rssc
define('_WEBLINKS_RSSC_LID',  'RSSC Lid');
define('_WEBLINKS_RSS_MODE',  'RSS Mode');
define('_WEBLINKS_RSSC_NOT_INSTALLED', 'RSSC module ( %s ) is not installed');
define('_WEBLINKS_RSSC_INSTALLED',     'RSSC module ( %s ) ver %s is installed');
define('_WEBLINKS_RSSC_REQUIRE', 'Requires RSSC module ver %s or later');
define('_WEBLINKS_GOTO_SINGLELINK', 'ÇáĞåÇÈ Çáì ãÚáæãÇÊ ÇáÑÇÈØ');

// warnig
define('_WEBLINKS_WARN_NOT_READ_URL', 'ÊÍĞíÑ: ÛíÑ ŞÇÏÑ Úáì ŞÑÇÁÉ ÇáÚäæÇä');
define('_WEBLINKS_WARN_BANNER_NOT_GET_SIZE', 'ÊÍĞíÑ: ÛíÑ ŞÇÏÑ Úáì ÌáÈ ãŞÇÓÇÊ ÇáÈäÑ');

// google map: hacked by wye <http://never-ever.info/>
define('_WEBLINKS_GM_LATITUDE',  'ÎØ ÇáÚÑÖ');
define('_WEBLINKS_GM_LONGITUDE', 'ÎØ ÇáØæá');
define('_WEBLINKS_GM_ZOOM',      'ãÓÊæì ÇáÊŞÑíÈ');
define('_WEBLINKS_GM_GET_LOCATION', 'Åä ãÚáæãÇÊ ÇáãæŞÚ ãßÊÓÈÉ ãÚ ÎÑÇÆØ ÌæÌá');
//define('_WEBLINKS_GM_GET_BUTTON', 'Get Latitude/Longitude/Zoom');
define('_WEBLINKS_GM_DEFAULT_LOCATION', 'ÇáãæŞÚ ÇáÃİÊÑÇÖí');
define('_WEBLINKS_GM_CURRENT_LOCATION', 'ÇáãæŞÚ ÇáÍÇáí');

// === 2006-11-04 ===
// google map inline mode
define('_WEBLINKS_GOOGLE_MAPS', 'ÎÑÇÆØ ÌæÌá');
define('_WEBLINKS_JAVASCRIPT_INVALID', 'ãÊÕİÍß áÇ íÏÚã ÌÇİÇ ÓßÑíÊ');
define('_WEBLINKS_GM_NOT_COMPATIBLE',  'ãÊÕİÍß áÇ íãßäå ÇÓÊÎÏÇã Çæ áÇ íÏÚã ÎÑíØÉ ÌæÌá');
define('_WEBLINKS_GM_NEW_WINDOW', 'ÚÑÖ İí äÇİĞå ÌÏíÏÉ');
define('_WEBLINKS_GM_INLINE',   'ÚÑÖ İí äİÓ ÇáÕİÍÉ');
define('_WEBLINKS_GM_DISP_OFF', 'ÊÚØíá ÇáÚÑÖ');

// google map: inverse Geocoder
define('_WEBLINKS_GM_GET_LATITUDE', 'Get Latitude/Longitude/Zoom');
define('_WEBLINKS_GM_GET_ADDR', 'ÇÍÖÑ ÇáÚäæÇä');

// === 2006-12-11 ===
// google map: Geocode
define('_WEBLINKS_GM_SEARCH_MAP_FROM_ADDRESS', 'ÈÍË ÇáÎÑíØÉ ãä ÇáÚäæÇä');
define('_WEBLINKS_GM_NO_MATCH_PLACE', 'áíÓ åäÇß ãßÇä áãÌÇÑÇÉ ÇáÚäæÇä');
define('_WEBLINKS_GM_JP_SEARCH_MAP_FROM_ADDRESS', 'Search Map from the address in Japan');
define('_WEBLINKS_GM_JP_TOKYO_AC_GEOCODE', 'Japan Tokyo University');
define('_WEBLINKS_GM_JP_MLIT_ISJ', 'Japan Ministry of Land Infrastructure and Transport');

// link item
define('_WEBLINKS_TIME_PUBLISH', 'ÊÇÑíÎ ÇáäÔÑ');
define('_WEBLINKS_TIME_EXPIRE',  'ÊÇÑíÎ ÇáÃäÊåÇÁ');
define('_WEBLINKS_TEXTAREA',     'ßÊÇÈÉ äÕ');

define('_WEBLINKS_WARN_TIME_PUBLISH', 'áã íÍä æŞÊ ÇáÇäÊåÇÁ');
define('_WEBLINKS_WARN_TIME_EXPIRE',  'ÇäŞÖÇÁ ÇáæŞÊ ÇáãäÊåí');
define('_WEBLINKS_WARN_BROKEN', 'ããßä ÇáÑÇÈØ áÇ íÚãá');

// === 2007-02-20 ===
// forum
define('_WEBLINKS_LATEST_FORUM', 'Leatest Forum');
define('_WEBLINKS_FORUM',  'ÇáãäÊÏì');
define('_WEBLINKS_THREAD', 'Thead');
define('_WEBLINKS_POST',   'Post');
define('_WEBLINKS_FORUM_ID',  'ÑŞã ÇáãäÊÏì');
define('_WEBLINKS_FORUM_SEL', 'ÊÍÏíÏ ÇáãäÊÏì');
define('_WEBLINKS_COMMENT_USE',  'ÇÓÊÚãÇá ÊÚáíŞ xoops');

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
define('_WEBLINKS_ALBUM_ID',  'ÑŞã ÇáÃáÈæã');
define('_WEBLINKS_ALBUM_SEL', 'ÊÍÏíÏ ÇáÃáÈæã');

// === 2007-04-08 ===
define('_WEBLINKS_GM_TYPE',  'äæÚ ÎÑíØÉ ÌæÌá');
define('_WEBLINKS_GM_TYPE_MAP',       'ÎÑíØÉ');
define('_WEBLINKS_GM_TYPE_SATELLITE', 'ÓÊáÇíÊ');
define('_WEBLINKS_GM_TYPE_HYBRID',    'Hybrid');

// === 2007-08-01 ===
define('_WEBLINKS_GM_CURRENT_ADDRESS', 'ÇáÚäæÇä ÇáÍÇáí');
define('_WEBLINKS_GM_SEARCH_LIST', 'ŞÇÆãÉ äÊíÌÉ ÇáÈÍË');

// === 2007-09-01 ===
// waiting list
define('_WEBLINKS_ADMIN_WAITING_LIST', "ŞÇÆãÉ ÅäÊÙÇÑ ÇáÃÏãä");
define('_WEBLINKS_USER_WAITING_LIST',  'ŞÇÆãÉ ÅäÊÙÇÑß');
define('_WEBLINKS_USER_OWNER_LIST',    'ŞÇÆãÉ ãæÇŞÚß');

// submit form
define('_WEBLINKS_TIME_PUBLISH_SET', 'ÍÏÏ æŞÊ ÇáäÔÑ');
define('_WEBLINKS_TIME_PUBLISH_DESC','ÇĞÇ áã ÊÍÏÏ æŞÊ ÇáäÔÑ , Óæİ ÊäÔÑ Úáí ÇáİæÑ');
define('_WEBLINKS_TIME_EXPIRE_SET',  'ÍÏÏ ÇäÊåÇÁ ÇáäÔÑ');
define('_WEBLINKS_TIME_EXPIRE_DESC', 'ÇĞÇ áã ÊÍÏÏ ÇäÊåÇÁ ÇáäÔÑ , Óæİ áä ÊäÊåí');
define('_WEBLINKS_DEL_LINK_CONFIRM','ÊÃßíÏ ÇáÍĞİ');
define('_WEBLINKS_DEL_LINK_REASON', 'ÓÈÈ ÇáÍĞİ');

// === 2007-11-01 ===
define('_WEBLINKS_ERROR_LENGTH', "Error: %s must be less than %s characters");

}
// --- define language end ---

?>