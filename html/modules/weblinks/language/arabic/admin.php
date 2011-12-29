<?php
// $Id: admin.php,v 1.1 2011/12/29 14:32:45 ohwada Exp $

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

define("_WEBLINKS_ADMIN_INDEX","ÕİÍÉ ÇáÃÏãä");

// BUG 2931: unmatch popup menu 'preference' and index menu 'module setting'
define("_WEBLINKS_ADMIN_MODULE_CONFIG_1","ÎíÇÑÇÊ ÇáÈÑäÇãÌ 1");

define("_WEBLINKS_ADMIN_MODULE_CONFIG_2","ÎíÇÑÇÊ ÇáÈÑäÇãÌ 2");
//define("_WEBLINKS_ADMIN_ADDMODDEL_CATEGORY","Add, Modify, and Delete Categories");
define("_WEBLINKS_ADMIN_ADD_LINK","ÃÖİ ÑÇÈØ ÌÏíÏ");
define("_WEBLINKS_ADMIN_OTHERFUNC","ÇáæÙÇÆİ ÇáÃÎÑì");
define("_WEBLINKS_ADMIN_GOTO_ADMIN_INDEX","ÇáĞåÇÈ Åáì ÕİÍÉ ÇáÃÏãä");

//======        config.php         ======
// Access Authority
define('_WEBLINKS_ADMIN_AUTH','ÇáÊÕÇÑíÍ');
define('_WEBLINKS_ADMIN_AUTH_TEXT', 'ÇáãÏíÑ ÚäÏå ßá ÓáØÉ ÇáÅÏÇÑÉ');
define('_WEBLINKS_AUTH_SUBMIT','íãßä Ãä íÑÓá ÑÇÈØ ÌÏíÏÉ');
define('_WEBLINKS_AUTH_SUBMIT_DSC','ÍÏÏ ÇáãÌãæÚÇÊ ÇáÊí áåÇ ÕáÇÍíÇÊ ÊŞÏíã ÑÇÈØ ÌÏíÏÉ');
define('_WEBLINKS_AUTH_SUBMIT_AUTO','íãßä Ãä ÊæÇİŞ ÊáŞÇÆí ááÑæÇÈØ ÇáÌÏíÏÉ');
define('_WEBLINKS_AUTH_SUBMIT_AUTO_DSC','ÍÏÏ ÇáãÌãæÚÇÊ ÇáÊí ÊæÇİŞ ÊáŞÇÆí Úáì ÇáÑæÇÈØ');
define('_WEBLINKS_AUTH_MODIFY','ÊÓÊØíÚ ÇáÊÚÏíá');
define('_WEBLINKS_AUTH_MODIFY_DSC','ÍÏÏ ÇáãÌãæÚÇÊ ÇáÊí áåÇ ÕáÇÍíÇÊ áÊŞÏíã ØáÈÇÊ ÊÚÏíá ÇáÑÇÈØ');
define('_WEBLINKS_AUTH_MODIFY_AUTO','íãßä Ãä ÊæÇİŞ Úáì ÊÚÏíáÇÊ ÇáÑÇÈØ');
define('_WEBLINKS_AUTH_MODIFY_AUTO_DSC','ÍÏÏ ÇáãÌãæÚÇÊ ÇáÊí áåÇ ÕáÇÍíÇÊ ÇáãæÇİŞÉ Úáì ØáÈÇÊ ÊÚÏíá ÇáÑÇÈØ');
define('_WEBLINKS_AUTH_RATELINK','íãßä Ãä ÊŞíã ÑÇÈØ');
define('_WEBLINKS_AUTH_RATELINK_DSC',"ÍÏÏ ÇáãÌãæÚÇÊ ÇáÊí áåÇ ÕáÇÍíÇÊ ÊŞííã ÑÇÈØ.<br /> ÊÚãá åĞå ÇáãíÒÉ İŞØ ÚäÏ ÊİÚíá ÎíÇÑ ãííÒÉ ÊŞííã ÇáÃÚÖÇÁ");
define('_WEBLINKS_USE_PASSWD','ÊÍŞŞ ãä ßáãÉ ÇáÓÑ ÚäÏ ÊÚÏíá Úáì ÑÇÈØ');
define('_WEBLINKS_USE_PASSWD_DSC','ÚÑÖ ÍŞá ÊÍŞŞ ãä ßáãÉ ÇáÓÑ ÚäÏãÇ íßæä ÎíÇÑ äÚã ãÎÊÇÑ¡ <br /> ááãÌãæÚÇÊ ÇáÊí áíÓ áåÇ ÕáÇÍíÇÊ áÊŞÏíã / ÊÕÏŞ ØáÈÇÊ ÇáÊÚÏíá.');
define('_WEBLINKS_USE_RATELINK','ÓãÇÍ ááÊŞííã');
define('_WEBLINKS_USE_RATELINK_DSC',"äÚã íÓãÍ ááÃÚÖÇÁ áÊŞííã ÇáÑæÇÈØ.");
define('_WEBLINKS_AUTH_UPDATED', 'ÇáÕáÇÍíÇÊ ÍÏËÊ');


// RSS/ATOM
define('_WEBLINKS_ADMIN_RSS','ÎíÇÑÇÊ RSS/ATOM Feeds');
define('_WEBLINKS_RSS_MODE_AUTO','ÊÍÏíË Âáí RSS/ATOM feeds');
define('_WEBLINKS_RSS_MODE_AUTO_DSC', "äÚã 'ÅßÊÔÇİ ÊáŞÇÆí áÚäæÇä RSS/ATOM' æ 'ÊÍÏíË ÊáŞÇÆí' ÇĞÇ ÑæÇÈØ RSS/ATOM ãæÌæÏå ÏÇÎá . ");
define('_WEBLINKS_RSS_MODE_DATA','ÈíÇäÇÊ ÇáÜ RSS/ATOM áÚÑÖåÇ');
define('_WEBLINKS_RSS_MODE_DATA_DSC', "ATOM FEED, uses the data in the Atom feed table after parsing. <br />XML uses the data from the link table before parsing. <br />Some data may not be saved in atomfeed table after filtering. ");
define('_WEBLINKS_RSS_CACHE','æŞÊ ÇáßÇÔ áÜ RSS/ATOM feeds');
define('_WEBLINKS_RSS_CACHE_DSC', 'ãŞÇÓ İí ÇáÓÇÚÇÊ');
define('_WEBLINKS_RSS_LIMIT','ÃßËÑ ÚÏÏ ãä RSS/ATOM feeds');
define('_WEBLINKS_RSS_LIMIT_DSC', 'ÇßÊÈ ÇŞÕì ÚÏÏ ãä RSS/ATOM feeds áÍİÙåÇ İí ÌÏæá ÇáÈÇäÇÊ<br />ÇáÈíÇäÇÊ ÇáŞÏíãÉ Óæİ ÊÍĞİ ÇĞÇ ÊÚÏÇ ÇáŞíãÉ ÇáãÓãæÍ ÈåÇ. <br />0 ÛíÑ ãÍÏæÏ. ');
define('_WEBLINKS_RSS_SITE','RSS search site');
define('_WEBLINKS_RSS_SITE_DSC',"ÇÏÎá ŞÇÆãÉ ÚäÇæíä RSS. <br />ÇİÕá ÈÓØÑ ÌÏíÏ ÇĞÇ ßÇä ÇßËÑ ãä æÇÍÏ. <br />áÇ ÊÏÎá ÚäÇæíä ATOM. ");
define('_WEBLINKS_RSS_BLACK','ÇáŞÇÆãÉ ÇáÓæÏÇÁ ãä ÑæÇÈØ RSS/ATOM');
define('_WEBLINKS_RSS_BLACK_DSC','ÇßÊÈ ŞÇÆãÉ ÚäÇæíä ÇáãæÇŞÚ áÑİÖåÇ ÚäÏ ÌáÈ ãÌãæÚÉ ãä RSS/ATOM feeds . <br />ÅİÕá ßá æÇÍÏÉ ÈÎØ ÌÏíÏ ÚäÏ ÊÍÏíÏ ÃßËÑ ãä æÇÍÏ. <br />íãßä Çä ÊßÊÈ ÈäÙÇã PERL. ');
define('_WEBLINKS_RSS_WHITE','ÇáŞÇÆãÉ ÇáÈíÖÇÁ ãä ÑæÇÈØ RSS/ATOM');
define('_WEBLINKS_RSS_WHITE_DSC','ÇßÊÈ ŞÇÆãÉ ÚäÇæíä ÇáãæÇŞÚ áÌãÚåÇ ÚäÏãÇ ÊÊãÇËá ãÚ ÇáŞÇÆãÉ ÇáÓæÏÇÁ feeds . <br />ÅİÕá ßá æÇÍÏÉ ÈÎØ ÌÏíÏ ÚäÏ ÊÍÏíÏ ÃßËÑ ãä æÇÍÏ. <br />íãßä Çä ÊßÊÈ ÈäÙÇã PERL.  ');
define('_WEBLINKS_RSS_URL_CHECK', 'åäÇß ÈÚÖ ÑæÇÈØ urls ÊÔÈÉ ÇáãæÌæÏå İí ÇáŞÇÆãÉ ÇáÓæÏÇÁ. ');
define('_WEBLINKS_RSS_URL_CHECK_DSC', 'ÑÌÇÁ ÅäÓÎ æÅáÕŞ ãä ÇáŞÇÆãÉ ÇáÈíÖÇÁ Åáì äãæĞÌ ÇáÊÓÌíá¡ ÅĞÇ ßÇä ÖÑæÑí. ');
define('_WEBLINKS_RSS_UPDATED', 'ÊÍÏíË ÎíÇÑÇÊ RSS/ATOM');


// RSS/ATOM
define('_WEBLINKS_ADMIN_RSS_VIEW','ãÔÇåÏÉ ÎíÇÑÇÊ RSS/ATOM Feeds');
define('_WEBLINKS_RSS_MODE_TITLE','ÇÓÊÚãÇá ÊÇÛ HTML İí ÇáÚäæÇä');
define('_WEBLINKS_RSS_MODE_TITLE_DSC', "äÚã ÚÑÖ ÊÇÛ HTML İí ÇáÚäæÇä ÇĞÇ ßÇä íÍÊæí Úáì ÊÇÛ HTML. <br />áÇ ÊÚÑÖ ÊÇÛ HTML. ");
define('_WEBLINKS_RSS_MODE_CONTENT','ÇÓÊÚãÇá ÊÇÛ HTML İí ÇáãÍÊæì');
define('_WEBLINKS_RSS_MODE_CONTENT_DSC', "äÚã ÚÑÖ ÊÇÛ HTML İí ÇáãÍÊæì ÇĞÇ ßÇä íÍÊæí Úáì ÊÇÛ HTML. <br />áÇ ÊÚÑÖ ÊÇÛ HTML. ");
define('_WEBLINKS_RSS_NEW','ÃÎÊÑ ÇŞÕì ÚÏÏ ãä"RSS/ATOM feeds" áÊÚÑÖ İí ÃÚáì ÇáÕİÍÉ');
define('_WEBLINKS_RSS_NEW_DSC', 'ÃßÊÈ ÇŞÕì ÚÏÏ ãä RSS/ATOM feeds áÊÚÑÖ İí ÇáÕİÍÉ ÇáÑÆíÓíÉ.');
define('_WEBLINKS_RSS_PERPAGE','ÅÎÊÑ ÇáÚÏÏ ÇáÃŞÕì á RSS/ATOM feeds áßí ÊÚÑÖ Úáì ÕİÍÉ ÇáÑÈØ æ ÕİÍÉ RSS/ATOM');
define('_WEBLINKS_RSS_PERPAGE_DSC', 'ÃßÊÈ ÇŞÕì ÚÏÏ ãä RSS/ATOM feeds áßí ÊÚÑÖ Úáì ÕİÍÉ RSS/ATOM.');
define('_WEBLINKS_RSS_NUM_CONTENT','ÚÏÏ feeds ÇáÊí ÊÚÑÖ ãÍÊæì');
define('_WEBLINKS_RSS_NUM_CONTENT_DSC', 'ÅÏÎá ÚÏÏ FEED ÇáÊí ÊÚÑÖ ãÍÊæì RSS/ATOM feeds İí ÕİÍÉ ÊİÇÕíá ÇáÑÇÈØ. <br />ÇáÎáÇÕÉ ãÚÑæÖÉ Úáì ÈŞíÉ FEED . ');
define('_WEBLINKS_RSS_MAX_CONTENT','ÇŞÕì ÚÏÏ ãä ÇáÍÑæİ İí ãÍÊæì RSS/ATOM feed');
define('_WEBLINKS_RSS_MAX_CONTENT_DSC', 'ÇßÊÈ ÇŞÕì ÚÏÏ ãä ÇáÍÑæİ áãÍÊæì RSS/ATOM feed ÇáÊí Óæİ ÊÚÑÖ İí ÕİÍÉ RSS/ATOM.  <br />ÊÓÊÚãá ÇĞÇ ßÇä "ÇÓÚãÇá ÊÇÛ HTML İí ÇáãÍÊæì" "äÚã." ');
define('_WEBLINKS_RSS_MAX_SUMMARY','ÇŞÕì ÚÏÏ ãä ÇáÍÑæİ İí ÎáÇÕÉ RSS/ATOM feed');
define('_WEBLINKS_RSS_MAX_SUMMARY_DSC', 'ÇßÊÈ ÇŞÕì ÚÏÏ ãä ÇáÍÑæİ áÎáÇÕÉ RSS/ATOM feed ÇáÊí ÊÚÑÖ İí ÇáÕİÍÉ ÇáÑÆíÓíÉ. ');


// use link field
define('_WEBLINKS_ADMIN_POST','ÇÚÏÇÏÊ ÍŞæá ÇáÊÓÌíá');
define('_WEBLINKS_ADMIN_POST_TEXT_1', "áÇ ÊÓÊÚãá ÍŞæá áä ÊÚÑÖ İí äãæĞÌ ÇáÊÓÌíá. ");
define('_WEBLINKS_ADMIN_POST_TEXT_2', "ÅÓÊÚãá ÇáÍŞæá ÇáãåãÉ.");
define('_WEBLINKS_ADMIN_POST_TEXT_3', "ÇáÍŞæá ÇáÖÑæÑíÉ íÌÈ Çä ÊÚÈÃ. ");
define('_WEBLINKS_NO_USE',"áÇ ÊÓÊÚãá");
define('_WEBLINKS_USE','ÇÓÊÚãá');
define('_WEBLINKS_INDISPENSABLE','ÖÑæÑí');
define('_WEBLINKS_TYPE_DESC','ÅÓÊÚãÇá ãÍÑÑ XOOPS DHTML İí ÇáæÕİ');
define('_WEBLINKS_TYPE_DESC_DSC', '"áÇ" ÅÓÊÚãÇá ÇáãÍÑÑ ÇáÚÇÏí ÈÏæä ÇÏæÇÊ. <br /> "äÚã" ÅÓÊÚãÇá ãÍÑÑ XOOPS DHTML.');
define('_WEBLINKS_CHECK_DOUBLE','ÇáãæÇİŞÉ Úáì ÇÓÊáÇã ÑæÇÈØ ãæÌæÏÉ');
define('_WEBLINKS_CHECK_DOUBLE_DSC', '"áÇ" ÊÚäí ÇáÓãÇÍ ÈÊÓÌíá ÑæÇÈØ ãæÌæÏÉ.<br /> "äÚã" áÇ íÓãÍ ÇĞÇ ßÇä äİÓ ÇáÑÇÈØ ãæÌæÏÉ.');
define('_WEBLINKS_POST_UPDATED', 'ÃãÇßä ÍŞæá ÇáÑÇÈØ ÌÏÏÊ');

// cateogry
define('_WEBLINKS_ADMIN_CAT_SET','ÎíÇÑÇÊ ÇáÃŞÓÇã');
define('_WEBLINKS_CAT_SEL', 'ÚÏÏ ááÃŞÓÇã ÇáÊí íÓÊØíÚ Çä íÎÊÇÑ ãäåÇ ãŞÏã ÇáÑÇÈØ');
define('_WEBLINKS_CAT_SEL_DSC', 'ÃÏÎá ÚÏÏ ÇáÃŞÓÇã ÇáÊí íÓÊØíÚ Çä íÎÊÇÑ ãäåÇ ãŞÏã ÇáãæŞÚ ');
define('_WEBLINKS_CAT_SUB','ÚÏÏ ÚÑÖ ÇáÃŞÓÇã ÇáİÑÚíÉ');
define('_WEBLINKS_CAT_SUB_DSC','ÍÏÏ ÚÏÏ ÇáÃŞÓÇã ÇáİÑÚíÉ ÇáÊí ÊÚÑÖ İí ŞÇÆãÉ ÇáÃŞÓÇã ÃÚáì ÇáÕİÍÉ');
define('_WEBLINKS_CAT_IMG_MODE','ÃÎÊÑ ÕæÑÉ ÇáŞÓã');
define('_WEBLINKS_CAT_IMG_MODE_DSC', '"áÇ ÊÚÑÖ" (ÈÏæä ÕæÑÉ )<br> folder.gif (ÇíŞæäÉ ãÌáÏ)<br>"ÎíÇÑÇÊ ÇáÕæÑÉ" (( ÇáÕæÑÉ ÇáÊí ÇÎÊÑÊåÇ ááŞÓã ) ŞÓã &nbsp;&gt;&gt;ŞÓã ÇáİÑÚí &gt;&gt;)<br>"ÅÑÌÇÚ ÇáÃíŞæäÉ" İí ÍÇáÉ ÏÎæá ÇáŞÓã ((folder.gif) ŞÓã &nbsp;&gt;&gt;ŞÓã ÇáİÑÚí &gt;&gt;) <br> ÇÏÎá Úáí ÇÍÏ ÇáÇŞÓÇã æÛíÑ ãä åäÇ æáÇÍÙ ÇáÊÛíÑ İí ÇáÕæÑÉ ÇáÊí ÇÎÊÑÊåÇ ÇäÊ ááŞÓã');
//define("_WEBLINKS_CAT_IMG_MODE_0","NONE");
define("_WEBLINKS_CAT_IMG_MODE_1","folder.gif");
define("_WEBLINKS_CAT_IMG_MODE_2","ÎíÇÑÇÊ ÇáÕæÑÉ");
define('_WEBLINKS_CAT_IMG_WIDTH','ÃŞÕì ÚÑÖ áÕæÑÉ ÇáŞÓã');
define('_WEBLINKS_CAT_IMG_HEIGHT','ÃŞÕì Øæá áÕæÑÉ ÇáŞÓã');
define('_WEBLINKS_CAT_IMG_SIZE_DSC','íÓÊÚãá ÚäÏ ÊÍÏíÏ "ÎíÇÑÇÊ ÇáÕæÑÉ". ');
define('_WEBLINKS_CAT_UPDATED', 'Êã ÊÍÏíË ÎíÇÑÇÊ ÇáŞÓã');


//======        cateogry_list.php         ======
define("_WEBLINKS_ADMIN_CATEGORY_MANAGE","ÅÏÇÑÉ ÇáŞÓã");
define("_WEBLINKS_ADMIN_CATEGORY_LIST","ŞÇÆãÉ ÇáÃŞÓÇã");
//define("_WEBLINKS_ORDER_ID"," Listed by ID");
define("_WEBLINKS_ORDER_TREE"," ÍÓÈ ÇáãÓÇÑ");
define("_WEBLINKS_CAT_ORDER","ÊÑÊíÈ ÇáŞÓã");
define("_WEBLINKS_THERE_ARE_CATEGORY","íæÌÏ <b> %s </b> ÃŞÓÇã İí ŞÇÚÏÉ ÇáÈíÇäÇÊ");
define("_WEBLINKS_ADMIN_CATEGORY_NOTICE_1","ÃÖÛØ <b> ÑŞã ÇáŞÓã </b> áÊÍÑíÑ ŞÓã ãÚíä. ");
define("_WEBLINKS_ADMIN_CATEGORY_NOTICE_2","ÃÖÛØ <b> ÇáŞÓã ÇáÑÆíÓí</b> Ãæ <b> ÇáÚäæÇä </b>¡ áÊÑì ŞÇÆãÉ ÇáÃŞÓÇã.");
define("_WEBLINKS_NO_CATEGORY","áÇ íæÌÏ ŞÓã ");
define("_WEBLINKS_NUM_SUBCAT","ÚÏÏ ÇáÃŞÓÇã ÇáİÑÚíÉ");
define('_WEBLINKS_ORDERS_UPDATED', 'ÍÏË ÊÑÊíÈ ÇáŞÓã');

//======        cateogry_manage.php         ======
define("_WEBLINKS_IMGURL_MAIN","ãæŞÚ ÕæÑÉ ÇáŞÓã");
define("_WEBLINKS_IMGURL_MAIN_DSC1","ÅÎÊíÇÑí. <br /> ãŞÇÓÇÊ ÇáÕæÑÉ ÊÚÏá ÊáŞÇÆí");
//define("_WEBLINKS_IMGURL_MAIN_DSC2","Images are for the main category only. ");

//======        link_list.php         ======
define("_WEBLINKS_ADMIN_LINK_MANAGE","ÅÏÇÑÉ ÑÇÈØ");
define("_WEBLINKS_ADMIN_LINK_LIST","ŞÇÆãÉ ÇáÑæÇÈØ");
define("_WEBLINKS_ADMIN_LINK_BROKEN","ŞÇÆãÉ ÇáÑæÇÈØ ÇáÊí áÇ ÊÚãá");
define("_WEBLINKS_ADMIN_LINK_ALL_ASC","ÍÓÈ ÇáÑŞã ÇáÇŞÏã");
define("_WEBLINKS_ADMIN_LINK_ALL_DESC","ÍÓÈ ÇáÑŞã ÇáÌÏíÏ");
define("_WEBLINKS_ADMIN_LINK_NOURL","ŞÇÆãÉ ÇáÑæÇÈØ ÇáÊí áã ÊæÖÚ");
define("_WEBLINKS_COUNT_BROKEN","ÃÍÕÇÁ ÇáÑæÇÈØ ÇáÊí áÇ ÊÚãá");
define("_WEBLINKS_NO_LINK","áÇ ÊæÌÏ ÑæÇÈØ. ");
define("_WEBLINKS_ADMIN_PRESENT_SAVE","ÇáÈíÇäÇÊ ÇáãÍİæÙÉ İí ŞÇÚÏÉ ÇáÈíÇäÇÊ ÊÚÑÖ åäÇ. ");

//======        link_manage.php         ======
//define("_WEBLINKS_USERID","User ID");
//define("_WEBLINKS_CREATE","Created");

//======        link_broken_check.php         ======
define("_WEBLINKS_ADMIN_LINK_CHECK_UPDATE","İÍÕ ÑÇÈØ æÊÍÏíËÉ");
define("_WEBLINKS_ADMIN_LINK_BROKEN_CHECK","İÍÕ ÑæÇÈØ áÇ ÊÚãá");
define("_WEBLINKS_ADMIN_BROKEN_CHECK","İÍÕ");
define("_WEBLINKS_ADMIN_BROKEN_RESULT","äÊíÌÉ ÇáİÍÕ");
define("_WEBLINKS_ADMIN_LINK_BROKEN_CHECK_CAUTION","ÇäÊåÇÁ ÇáæŞÊ ŞÏ íÍÏË¡ ÅĞÇ åäÇß ÇáÚÏíÏ ãä ÑæÇÈØ áÇ ÊÚãá. <br /> ÅĞÇ ßÇä ÇáÃãÑ ßĞáß¡ ÑÌÇÁ ÛíÑ ÇáŞíãÉ ÇáÚÏÏíÉ æÇáÈÏÃ. <br /> ÇáŞíãÉ = 0¡ Ãæ ÈÏæä ŞíæÏ.");
define("_WEBLINKS_ADMIN_LINK_BROKEN_CHECK_NOTICE","ÃÖÛØ <b> ÑŞã ÇáãæŞÚ </b> ááÊÚÏíá. <br />  ÃÖÛØ </b><b>ÚäæÇä ÇáãæŞÚ </b> ááĞåÇÈ Åáì ÇáãæŞÚ.<br />");
define("_WEBLINKS_ADMIN_LINK_BROKEN_CHECK_GOOGLE","ÃÖÛØ <b> ÅÓã ÇáãæŞÚ </b>. ááÈÍË Úä ÇáãæŞÚ İí ÌæÌá.<br />");
define("_WEBLINKS_ADMIN_LIMIT","ÃŞÕì ÚÏÏ ãä ÇáÑæÇÈØ áİÍÕåÇ (ãÍÏæÏ)");
define("_WEBLINKS_ADMIN_OFFSET","ÊÈÏÃ ãä");
define("_WEBLINKS_ADMIN_CHECK","İÍÕ");
define("_WEBLINKS_ADMIN_TIME_START","æŞÊ ÇáÈÏÃ");
define("_WEBLINKS_ADMIN_TIME_END","æŞÊ ÇáÃäÊåÇÁ");
define("_WEBLINKS_ADMIN_TIME_ELAPSE","ÅäŞÖì ÇáæŞÊ");
define("_WEBLINKS_ADMIN_LINK_NUM_ALL","ÌãíÚ ÇáÑæÇÈØ");
define("_WEBLINKS_ADMIN_LINK_NUM_CHECK","İÍÕ ÇáÑæÇÈØ");
define("_WEBLINKS_ADMIN_LINK_NUM_BROKEN","ÑæÇÈØ áÇ ÊÚãá");
define("_WEBLINKS_ADMIN_NUM","ÑæÇÈØ");
define("_WEBLINKS_ADMIN_MIN_SEC","%s ÏŞíŞÉ %s ËÇäíÉ");
define("_WEBLINKS_ADMIN_CHECK_NEXT","İÍÕ ÇáÊÇáí %s ÑÇÈØ");
//define("_WEBLINKS_ADMIN_RSS_REFRESH_NOTE","Simultaneously execute an Auto Discovery of RSS/ATOM urls ");

//======        rss_manage.php         ======
define("_WEBLINKS_ADMIN_RSS_MANAGE","ÅÏÇÑÉ RSS/ATOM feed");
define("_WEBLINKS_ADMIN_RSS_REFRESH","ÊÍÏíË RSS/ATOM");
define("_WEBLINKS_ADMIN_RSS_REFRESH_LINK","ÊäÔíØ ÇáßÇÔ áÈíÇäÇÊ ÇáÑæÇÈØ");
define("_WEBLINKS_ADMIN_RSS_REFRESH_SITE","ÊäÔíØ ßÇÔ ãæŞÚ ÈÍË RSS");
define("_WEBLINKS_ADMIN_NUM_REFRESH_RSS_URL","ÚÏÏ ÇáÚäÇæíä ÇáãäÔØÉ áÜ RSS/ATOM");
define("_WEBLINKS_ADMIN_NUM_REFRESH_RSS_SITE","ÚÏÏ ÚäÇæíä ÇáãæÇŞÚ ÇáãäÔØÉ áÜ RSS/ATOM");
define("_WEBLINKS_ADMIN_NUM_REFRESH_ATOM_SITE","ÚÏÏ ÇáãæÇŞÚ ÇáãäÔØÉ áÜ RSS/ATOM");
define("_WEBLINKS_ADMIN_NUM_REFRESH_ATOMFEED","ÚÏÏ FEEDS ÇáãäÔØÉ áÜ RSS/ATOM");
define("_WEBLINKS_ADMIN_RSS_CACHE_CLEAR","ãÓÍ ßÇÔ RSS/ATOM feed");
define("_WEBLINKS_RSS_CLEAR_NUM","Clear cache of RSS/ATOM feed by order of date, if more than the specified number of feeds in Module Configuration 1.");
define("_WEBLINKS_RSS_NUMBER","ÚÏÏ feeds");
define("_WEBLINKS_RSS_CLEAR_LID","ãÓÍ ÇáßÇÔ áæÇÈØ ÇáÇÑŞÇã ");
define("_WEBLINKS_RSS_CLEAR_ALL","ãÓÍ ÌãíÚ ÇáßÇÔ");
define("_WEBLINKS_NUM_RSS_CLEAR_LINK","ÚÏÏ RSS/ATOM ÇáßÇÔ ãÓÍåÇ");
define("_WEBLINKS_NUM_RSS_CLEAR_ATOMFEED","ÚÏÏ ÇáããÓæÍ ãä ATOM/RSS feed ");

//======        user_list.php         ======
define("_WEBLINKS_ADMIN_USER_MANAGE", "ÎíÇÑÇÊ ÇáÚÖæ");
define("_WEBLINKS_ADMIN_USER_EMAIL", "ŞÇÆãÉ ÇáÃÚÖÇÁ ãÚ ÚäÇæíä ÇáÈÑíÏ ÇáÅáßÊÑæäí");
define("_WEBLINKS_ADMIN_USER_LINK", "ŞÇÆãÉ ÇáÃÚÖÇÁ ÇáãÓÌáíä ãÚ ãÚáæãÇÊ ÇáÑÇÈØ");
define("_WEBLINKS_ADMIN_USER_NOLINK", "ŞÇÆãÉ ÇáÃÚÖÇÁ ÇáãÓÌáíä ÈÏæä ãÚáæãÇÊ ÇáÑÇÈØ");
define("_WEBLINKS_ADMIN_USER_EMAIL_DSC", "ÚÑÖ İŞØ ÚäæÇä ÈÑíÏ ÅáßÊÑæäí æÇÍÏ ÅĞÇ ãäÓæÎ");
//define("_WEBLINKS_ADMIN_USER_LINK_DSC", 'Use "Send Message to Users" of XOOPS core');
//define("_WEBLINKS_USER_ALL", " (all) ");
//define("_WEBLINKS_USER_MAX", " (each %s persons) ");
define("_WEBLINKS_THERE_ARE_USER", "<b>%s</b> ÃÚÖÇÁ æÌÏæÇ");
define("_WEBLINKS_USER_NUM", "Show from %s th person to %s th person.");
define("_WEBLINKS_USER_NOFOUND", "áã íÊã ÇáÚËæÑ Úáì ÃÚÖÇÁ");
define("_WEBLINKS_UID_EMAIL", "ÈÑíÏ ÇáãÑÓá");

//======        mail_users.php         ======
define("_WEBLINKS_ADMIN_SENDMAIL", "ÃÑÓá ÈÑíÏ");
define("_WEBLINKS_THERE_ARE_EMAIL","íæÌÏ <b>%s</b> ÈÑíÏ");
define("_WEBLINKS_SEND_NUM", "ÃÑÓá ãä %s Åáì %s  ÔÎÕ");
//define("_WEBLINKS_SEND_NEXT","Send next %s emails");
//define("_WEBLINKS_SUBJECT_FROM", "Information from %s");
//define("_WEBLINKS_HELLO", "Hello %s");
define("_WEBLINKS_MAIL_TAGS1","{W_NAME} ÓíØÈÚ ÇÓã ÇáÚÖæ");
define("_WEBLINKS_MAIL_TAGS2","{W_EMAIL} ÓíØÈÚ ÈÑíÏ ÇáÚÖæ");
define("_WEBLINKS_MAIL_TAGS3","{W_LID} ÓíØÈÚ ÑŞã ÑÇÈØ ÇáÚÖæ");

// general
define('_WEBLINKS_WEBMASTER', 'ÇáãÏíÑ');
define('_WEBLINKS_SUBMITTER', 'ÇáãÑÓá');
//define("_WEBLINKS_MID","Modify ID");
define("_WEBLINKS_UPDATE","ÊÍÏíË");
define("_WEBLINKS_SET_DEFAULT","ÊÍÏíÏ ÇáÃİÊÑÇÖí");
define("_WEBLINKS_CLEAR","ãÓÍ");
define("_WEBLINKS_CHECK","İÍÕ");
define("_WEBLINKS_NON","áÇ íæÌÏ ÔÆ");
define("_WEBLINKS_SENDMAIL", "ÅÑÓÇá ÈÑíÏ");

// 2005-08-09
// BUG 2827: RSS refresh: Invalid argument supplied for foreach()
define("_WEBLINKS_ADMIN_NO_LINK_BROKEN_CHECK","áÇ íæÌÏ ÑæÇÈØ áİÍÕåÇ");
define("_WEBLINKS_ADMIN_NO_RSS_REFRESH","áÇ ÊæÌÏ ÑæÇÈØ ááÊÍÏíË RSS");

// 2005-10-20
define("_WEBLINKS_LINK_APPROVED", "[{X_SITENAME}] {X_MODULE}: ÊãÊ ÇáãæÇİŞÉ Úáì ÇáÑÇÈØ");
define("_WEBLINKS_LINK_REFUSED",  "[{X_SITENAME}] {X_MODULE}: Êã ÑİÖ ÇáÑÇÈØ");

// 2006-05-15
define('_AM_WEBLINKS_INDEX_DESC','äÕø ÇáÕİÍÉ ÇáÑÆíÓíÉ ÇáÊãåíÏí');
define('_AM_WEBLINKS_INDEX_DESC_DSC', 'íãßäß Ãä ÊÓÊÚãá åĞÇ ÇáŞÓã áÚÑÖ ÈÚÖ ÇáäÕ ÇáæÕİí Ãæ ÇáÊãåíÏí. ÇáÅÊÔ Êí Åã Åá ãÓãæÍ ÈåÇ.');
define('_AM_WEBLINKS_INDEX_DESC_DEFAULT', '<div align="center" style="color: #0000ff">åäÇ ãŞÏãÉ ÕİÍÉ Ïáíá ÇáãæÇŞÚ.<br />íãßä ÊÛíÑåÇ ãä ÎáÇá ÎíÇÑÇÊ ÇáÈÑäÇãÌ 2.<br /></div>');

define('_AM_WEBLINKS_ADD_CATEGORY', 'ÃÖİ ŞÓã ÌÏíÏ');
define('_AM_WEBLINKS_ERROR_SOME', 'íæÌÏ ÈÚÖ ÑÓÇÆá ÇáÎØÃ');
define('_AM_WEBLINKS_LIST_ID_ASC',  'ÍÓÈ ÇáÑŞã ÇáÇŞÏã');
define('_AM_WEBLINKS_LIST_ID_DESC', 'ÍÓÈ ÇáÑŞã ÇáÌÏíÏ');

// config
//define('_AM_WEBLINKS_WARNING_NOT_WRITABLE','ÇáÏáíá áÇ íŞÈá ÇáßÊÇíÉ');

define('_AM_WEBLINKS_CONF_LINK','ÎíÇÑÇÊ ÇáÑæÇÈØ');
define('_AM_WEBLINKS_CONF_LINK_IMAGE','ÎíÇÑÇÊ ÑÇÈØ ÇáÕæÑÉ');
define('_AM_WEBLINKS_CONF_VIEW','ÎíÇÑÇÊ ÇáÚÑÖ');
define('_AM_WEBLINKS_CONF_TOPTEN','ÎíÇÑÇÊ ÇáÚÔÑ ÇáÃæÇÆá');
define('_AM_WEBLINKS_CONF_SEARCH','ÎíÇÑÇÊ ÇáÈÍË');

define('_AM_WEBLINKS_USE_BROKENLINK','ÊŞÇÑíÑ ÇáæÕáÇÊ ÇáÊí áÇ ÊÚãá');
define('_AM_WEBLINKS_USE_BROKENLINK_DSC','äÚã ÇáÓãÇÍ ááÃÚÖÇÑ ÈÅÑÓÇá ÊŞÇÑíÑ Úä æÕáÇÊ áÇ ÊÚãá');
define('_AM_WEBLINKS_USE_HITS','ÇÍÓÈ ÇáÒíÇÑÇÊ ÚäÏ ÇáĞåÇÈ ááãæŞÚ');
define('_AM_WEBLINKS_USE_HITS_DSC','äÚã ÇÍÓÈ ÇáÒíÇÑÇÊ ÚäÏ ÇáĞåÇÈ ááãæŞÚ');
define('_AM_WEBLINKS_USE_PASSWD','ÊÍŞíŞ ßáãÉ ÇáÓÑ');
define('_AM_WEBLINKS_USE_PASSWD_DSC','"äÚã"¡ <b> ÇáÒæÇÑ </b> íãßäåã ÊÚÏíá ÇáÑÇÈØ ÈÚÏÏ ÇáÊÍŞŞ ãä ßáãÉ ÇáÓÑ <br /> "áÇ"¡ ÚÏã ÚÑÖ ÍŞá ßáãÉ ÇáÓÑ.');
define('_AM_WEBLINKS_PASSWD_MIN','ÃÏäì Øæá áßáãÉ ÇáÓÑ');
define('_AM_WEBLINKS_POST_TEXT', 'ÇáãÏíÑ ÚäÏå ßá ÇáÕáÇÍíÇÊ');
define('_AM_WEBLINKS_AUTH_DOHTML', 'ÊÕÑíÍ ÈÇÓÊÚãÇá ÈíÇäÇÊ HTML ÊÇÛ');
define('_AM_WEBLINKS_AUTH_DOHTML_DSC', 'ÊÍÏíÏ ÇáãÌãæÚÉ ÇáãÕÑÍ áåÇ ÈÇÓÊÚãÇá HTML ÊÇÛ');
define('_AM_WEBLINKS_AUTH_DOSMILEY', 'ÊÕÑíÍ ÈÇÓÊÚãÇá ÇáÃÈÊÓÇãÇÊ');
define('_AM_WEBLINKS_AUTH_DOSMILEY_DSC', 'ÊÍÏíÏ ÇáãÌãæÚÉ ÇáãÕÑÍ áåÇ ÈÇÓÊÚãÇá ÇáÃÈÊÓÇãÇÊ');
define('_AM_WEBLINKS_AUTH_DOXCODE', 'ÊÕÑíÍ ÈÇÓÊÚãÇá ÇßæÇÏ XOOPS');
define('_AM_WEBLINKS_AUTH_DOXCODE_DSC', 'ÊÍÏíÏ ÇáãÌãæÚÉ ÇáãÕÑÍ áåÇ ÈÇÓÊÚãÇá ÇßæÇÏ XOOPS');
define('_AM_WEBLINKS_AUTH_DOIMAGE', 'ÊÕÑíÍ ÈÇÓÊÚãÇá ÇáÕæÑ');
define('_AM_WEBLINKS_AUTH_DOIMAGE_DSC', 'ÍÏÏ ÇáãÌãæÚÉ ÇáãÕÑÍ áåÇ ÈÇÓÊÚãÇá ÇáÕæÑ');
define('_AM_WEBLINKS_AUTH_DOBR', 'ÊÕÑíÍ ÈÇÓÊÚãÇá ÇáİŞÑÉ');
define('_AM_WEBLINKS_AUTH_DOBR_DSC', 'ÊÍÏíÏ ÇáãÌãæÚÉ ÇáãÕÑÍ áåÇ ÈÇÓÊÚãÇá ÇáİŞÑÉ');
define('_AM_WEBLINKS_SHOW_CATLIST','ÚÑÖ ÇáÃŞÓÇã İí ÇáŞÇÆãÉ ÇáÑÆíÓíÉ');
define('_AM_WEBLINKS_SHOW_CATLIST_DSC','"äÚã"ÚÑÖ ÇáÃŞÓÇã İí ÇáŞÇÆãÉ ÇáÑÆíÓíÉ');
define('_AM_WEBLINKS_VIEW_URL','ØÑíŞÉ ÚÑÖ ÚäæÇä ÇáãæŞÚ');
define('_AM_WEBLINKS_VIEW_URL_DSC','"áÇ ÔíÆ"  ÚÏã ÚÑÖ ÇáÑÇÈØ äåÇÆí. <br /> "ÛíÑ ãÈÇÔÑ" íÚÑÖ ÇáÑÇÈØ ãËÇá visit.php?lid=2   . <br /> "ãÈÇÔÑ" íÚÑÖ ÚäæÇä ÇáãæŞÚ ÚäÏ ãÑæÑ ÇáİÃÑÉ İæŞ ÇáÑÇÈØ (ÌÇİÇ ÓßÑÈÊ).');
define('_AM_WEBLINKS_VIEW_URL_0','áÇ ÔíÁ');
define('_AM_WEBLINKS_VIEW_URL_1','ÛíÑ ãÈÇÔÑÉ');
define('_AM_WEBLINKS_VIEW_URL_2','ãÈÇÔÑÉ');
define('_AM_WEBLINKS_RECOMMEND_PRI','ÃæáæíÉ ÇáãæÇŞÚ ÇáãäÕÍ ÈåÇ');
define('_AM_WEBLINKS_RECOMMEND_PRI_DSC','"áÇ ÔíÆ" áÇ ÊÚÑÖ. <br /> "ÚÇÏí"  İí ÇáÕİÍÉ ÇáÑÆíÓíÉ ááÈÑäÇãÌ. <br /> "ÃÚáì" ÚÑÖ ÇáãæÇŞÚ íäÕÍ İíåÇ İí ÃÚáì ßá ŞÓã.');
define('_AM_WEBLINKS_MUTUAL_PRI','ÃæáæíÉ ÇáãæÇŞÚ ÇáãÊÈÇÏáÉ');
define('_AM_WEBLINKS_MUTUAL_PRI_DSC','"áÇ ÔíÆ"  áÇ ÊÚÑÖ. <br /> "ÚÇÏí"  İí ÇáÕİÍÉ ÇáÑÆíÓíÉ ááÈÑäÇãÌ. <br /> "ÃÚáì"  ÚÑÖ ÇáãæÇŞÚ İí ÃÚáì ßá ÇáÃŞÓÇã.');
define('_AM_WEBLINKS_PRI_0','áÇ ÔíÁ');
define('_AM_WEBLINKS_PRI_1','ÚÇÏí');
define('_AM_WEBLINKS_PRI_2','ÃÚáì');
define('_AM_WEBLINKS_LINK_IMAGE_AUTO','ÊÍÏíË ÊáŞÇÆí áÍÌã ÇáÈäÑ');
define('_AM_WEBLINKS_LINK_IMAGE_AUTO_DSC', "äÚã <br />ÊÍÏíË ÊáŞÇÆí áÍÌã ÇáÈäÑ.");
define('_AM_WEBLINKS_RSS_USE','Use RSS feed');
define('_AM_WEBLINKS_RSS_USE_DSC','YES <br />Get and display RSS/ATOM feed.');

// bulk import
define('_AM_WEBLINKS_BULK_IMPORT','ÅÓÊíÑÇÏ ÚÏÏ ßÈíÑ(ÈÇáÌãáÉ)');
define('_AM_WEBLINKS_BULK_IMPORT_FILE','ÅÓÊíÑÇÏ ãä ãáİ');
define('_AM_WEBLINKS_BULK_CAT','ÅÓÊíÑÇÏ ãä ÇáÃŞÓÇã');
define('_AM_WEBLINKS_BULK_CAT_DSC1','ÊÑÊíÈ ÇáÃŞÓÇã');
define('_AM_WEBLINKS_BULK_CAT_DSC2','ÇÓÊÚãá ÚáÇãÉ ÇáÃŞÊÈÇÓ ÇáíÓÑì (>) İí ÈÏÇíÉ ÇáŞÓã áÊÚÑíİ ÇáŞÓã ßŞÓã İÑÚí');
define('_AM_WEBLINKS_BULK_LINK','ÅÓÊíÑÇÏ ãÚÙã ÇáÑæÇÈØ');
define('_AM_WEBLINKS_BULK_LINK_DSC1', 'ÅÏÎÇá ÇáŞÓã İí Ãæá ÇáÓØÑ');
define('_AM_WEBLINKS_BULK_LINK_DSC2', 'æÕİ ÚäæÇä ÇáãæŞÚ, ÚäæÇä ÇáãæŞÚ, æÇáİÕá Úä ØÑíŞ(,) İí ÇáÓØÑ ÇáËÇäí.');
define('_AM_WEBLINKS_BULK_LINK_DSC3', 'ÃÓÊÚãá (---)  ááİÕá Èíä ÇáãæÇŞÚ.');
define('_AM_WEBLINKS_BULK_ERROR_LAYER','Specified two or more under layers at the category tree structure. This need clarification G.S.');
define('_AM_WEBLINKS_BULK_ERROR_CID','ÎØÃ ÑŞã ÇáŞÓã');
define('_AM_WEBLINKS_BULK_ERROR_PID','ÎØÃ ÑŞã ÇáŞÓã ÇáÑÆíÓí');
define('_AM_WEBLINKS_BULK_ERROR_FINISH','ÍÏË ÎØÃ ÇæŞİ ÇáÚãáíÉ');

// command
//define('_AM_WEBLINKS_CREATE_CONFIG', 'ÃäÔÃ ãáİ ÎíÇÑÇÊ');
//define('_AM_WEBLINKS_TEST_EXEC', 'ÊäİíĞ ÇáÇÎÊÈÇÑ áÜ %s');

// === 2006-10-05 ===
// menu
define('_AM_WEBLINKS_MODULE_CONFIG_3','ÎíÇÑÇÊ ÇáÈÑäÇãÌ 3');
define('_AM_WEBLINKS_MODULE_CONFIG_4','ÎíÇÑÇÊ ÇáÈÑäÇãÌ 4');
define('_AM_WEBLINKS_VOTE_LIST', 'ŞÇÆãÉ ÇáÊÕæíÊÇÊ');
define('_AM_WEBLINKS_CATLINK_LIST', 'ŞÇÆãÉ ÌãíÚ ÇáÑæÇÈØ');
//define('_AM_WEBLINKS_COMMAND_MANAGE', 'ÅÏÇÑÉ ÇáÊäİíĞ');
define('_AM_WEBLINKS_TABLE_MANAGE',  'ÅÏÇÑÉ ŞÇÚÏÉ ÇáÈíÇäÇÊ');
define('_AM_WEBLINKS_IMPORT_MANAGE', 'ÅÏÇÑÉ ÇáÇÓÊíÑÇÏ');
define('_AM_WEBLINKS_EXPORT_MANAGE', 'ÅÏÇÑÉ ÇáÊÕÏíÑ');

// config
define('_AM_WEBLINKS_MODULE_CONFIG_DESC_2','ÇáÊÍŞíŞ, ÇáÇŞÓÇã, ÇáÎ');
define('_AM_WEBLINKS_MODULE_CONFIG_DESC_3','ÑæÇÈØ');
define('_AM_WEBLINKS_MODULE_CONFIG_DESC_4','RSS, ÇáãäÊÏì, ÎÑíØÉ');
define('_AM_WEBLINKS_LINK_REGISTER','ÎíÇÑÇÊ ÇáÑæÇÈØ: ÇáæÕİ (ÚäÏ ÊÓÌíá ãæŞÚ ÌÏíÏ ÎÇäÉ ßÊÇÈÉ ÇáæÕİ)');

// bin configuration
define('_AM_WEBLINKS_FORM_BIN', 'ÎíÇÑÇÊ ÇáÊäİíĞ');
define('_AM_WEBLINKS_FORM_BIN_DESC', 'It is used on bin command');
define('_AM_WEBLINKS_CONF_BIN_PASS','ÇáÑŞã ÇáÓÑí');
//define('_AM_WEBLINKS_CONF_BIN_PASS_DESC','');
define('_AM_WEBLINKS_CONF_BIN_SEND','ÇÑÓÇá ÈÑíÏ');
//define('_AM_WEBLINKS_CONF_BIN_SEND_DESC','');
define('_AM_WEBLINKS_CONF_BIN_MAILTO','ÇáÈÑíÏ áÃÑÓÇáÉ');
//define('_AM_WEBLINKS_CONF_BIN_MAILTO_DESC','');

// rssc
//define('_AM_WEBLINKS_RSS_DIRNAME','RSSC Module Dirname');
//define('_AM_WEBLINKS_RSS_DIRNAME_DESC','');

// link manage
define('_AM_WEBLINKS_DEL_LINK', 'ÍĞİ ÑÇÈØ');
define('_AM_WEBLINKS_ADD_RSSC', 'ÃÖİ ÑÇÈØ Åáì ÈÑäÇãÌ RSSC ');
define('_AM_WEBLINKS_MOD_RSSC', 'ÊÚÏíá ÑÇÈØ İí ÈÑäÇãÌ RSSC');
define('_AM_WEBLINKS_REFRESH_RSSC', 'ÊäÔíØ ÑÇÈØ İí ÈÑäÇãÌ RSSC');
define('_AM_WEBLINKS_APPROVE',     'ÇáãæÇİŞÉ Úáì ÑÇÈØ ÌÏíÏ');
define('_AM_WEBLINKS_APPROVE_MOD', 'ÇáãæÇİŞÉ Úáì ÊÚÏíá ÑÇÈØ');
define('_AM_WEBLINKS_RSSC_LID_SAVED', 'ÍİÙ ÇÑŞÇã ãÑßÒ ÇáÚÇæíä');
define('_AM_WEBLINKS_GOTO_LINK_LIST', 'ÇáĞåÇÈ Åáì ŞÇÆãÉ ÇáÑæÇÈØ');
define('_AM_WEBLINKS_GOTO_LINK_EDIT', 'ÇáĞåÇÈ Åáì ŞÇÆãÉ ÇáÊÚÏíáÇÊ');
define('_AM_WEBLINKS_ADD_BANNER', 'ÇÖİ ÍÌã ÇáÈÇäÑ');
define('_AM_WEBLINKS_MOD_BANNER', 'ãŞÇÓ ÇáÈäÑ');

// vote list
define('_AM_WEBLINKS_VOTE_USER', 'ÊÕæíÊÇÊ ÇáÃÚÖÇÁ');
define('_AM_WEBLINKS_VOTE_ANON', 'ÊÕæíÊÇÊ ÇáÒæÇÑ');

// locate
define('_AM_WEBLINKS_CONF_LOCATE','ÊÍÏíÏ ÇáãæŞÚ');
define('_AM_WEBLINKS_CONF_COUNTRY_CODE','ßæÏ ÇáÏæáÉ');
define('_AM_WEBLINKS_CONF_COUNTRY_CODE_DESC', 'Enter ccTLDs code <br/> <a href="http://www.iana.org/cctld/cctld-whois.htm" target="_blank">IANA: Country-Code Top-Level Domains</a>');
define('_AM_WEBLINKS_CONF_RENEW_COUNTRY_CODE_DESC', 'Refresh the item which relates to the country code. <br/> The item with the <span style="color:#0000ff;">#</span> mark');
define('_AM_WEBLINKS_RENEW', 'ÊÌÏíÏ');

// map
define('_AM_WEBLINKS_CONF_MAP','ÎíÇÑÇÊ ÎÑÇÆØ ÇáãæŞÚ');
define('_AM_WEBLINKS_CONF_MAP_USE','ÊÔÛíá ÎÑÇÆØ ÌæÍá');
define('_AM_WEBLINKS_CONF_MAP_TEMPLATE','ŞÇáÈ ÇáÎÑíØÉ');
define('_AM_WEBLINKS_CONF_MAP_TEMPLATE_DESC','ÅÏÎá ÇÓã ãáİ ÇáŞÇáÈ İí template/map/');

// google map: hacked by wye <http://never-ever.info/>
define('_AM_WEBLINKS_CONF_GOOGLE_MAP','ÎíÇÑÇÊ ÎÑÇÆØ ÌæÍá');
define('_AM_WEBLINKS_CONF_GM_USE','ÊÔÛíá ÎÑÇÆØ ÌæÍá');
define('_AM_WEBLINKS_CONF_GM_APIKEY','Google Maps API key');
define('_AM_WEBLINKS_CONF_GM_APIKEY_DESC', 'Get the API key on <br/> <a href="http://www.google.com/apis/maps/signup.html" target="_blank">http://www.google.com/apis/maps/signup.html</a> <br/> When you use GoogleMaps.' );
define('_AM_WEBLINKS_CONF_GM_SERVER','ÃÓã ÇáÓíÑİÑ');
define('_AM_WEBLINKS_CONF_GM_LANG',  'ßæÏ ÇááÛÉ');
define('_AM_WEBLINKS_CONF_GM_LOCATION', 'ÇáãæŞÚ ÇáÃİÊÑÇÖí');
define('_AM_WEBLINKS_CONF_GM_LATITUDE', 'ÎØø ÇáÚÑÖ ÇáÃİÊÑÇÖí');
define('_AM_WEBLINKS_CONF_GM_LONGITUDE','ÎØø ÇáØæá ÇáÃİÊÑÇÖí');
define('_AM_WEBLINKS_CONF_GM_ZOOM',     'ãÓÊæì ÇáÊŞÑíÈ ÇáÃİÊÑÇÖí');

// google search
define('_AM_WEBLINKS_CONF_GOOGLE_SEARCH','ÊÃßíÏ ÈÍË ÌæÍá');
define('_AM_WEBLINKS_CONF_GOOGLE_SERVER','ÃÓã ÇáÓíÑİÑ');
define('_AM_WEBLINKS_CONF_GOOGLE_LANG',  'ßæÏ ÇááÛÉ');

// template
define('_AM_WEBLINKS_CONF_TEMPLATE','ãÓÍ ßÇÔ ÇáÊãÈáÊ');
define('_AM_WEBLINKS_CONF_TEMPLATE_DESC','íÌÈ Ãä íäİĞ¡ ÚäÏãÇ ÚäÏãÇ íÊã ÊÛíÑ ÇáŞÇáÈ template/parts/ template/xml/ and template/map/ directory');

// === 2006-12-11 ===
// link item
//define('_AM_WEBLINKS_TIME_PUBLISH','Set the publication time');
//define('_AM_WEBLINKS_TIME_PUBLISH_DESC','If you do not check it, published time will become undated');
//define('_AM_WEBLINKS_TIME_EXPIRE','Set expiration time');
//define('_AM_WEBLINKS_TIME_EXPIRE_DESC','If you do not check it, expired setting will become undated');
define('_AM_WEBLINKS_LINK_TIME_PUBLISH_BEFORE','ŞÇÆãÉ ÇáÑæÇÈØ ŞÈá æŞÊ ÇáäÔÑ');
define('_AM_WEBLINKS_LINK_TIME_EXPIRE_AFTER',  'ŞÇÆãÉ ÇáÑæÇÈØ ÈÚÏ ÅäÊåÇÁ ÇáæŞÊ');

define('_AM_WEBLINKS_SERVER_ENV','ÍÇáÉ ÇáÓíÑİÑ ');
define('_AM_WEBLINKS_DEBUG_CONF','ÍÇáÉ ÊÕÍíÍ ÇáÃÎØÇÁ(ÇáãÊÛíÑÇÊ)');
define('_AM_WEBLINKS_ALL_GREEN','ÌãíÚåÇ ÎÖÑÇÁ');

// === 2007-02-20 ===
// performance
define('_AM_WEBLINKS_UPDATE_CAT_PATH','ÊÍÏíË ãÓÇÑ ÇáŞÓã');
define('_AM_WEBLINKS_UPDATE_CAT_COUNT','ÊÍÏíË ÇÍÕÇÁ ÑæÇÈØ ÇáÃŞÓÇã');
define('_AM_WEBLINKS_CAT_COUNT_UPDATED','Êã ÊÍÏíË ãÓÇÑ ÇáŞÓã');

// config
define('_AM_WEBLINKS_SYSTEM_POST_LINK','ÇÍÊÓÇÈ Úä ÅÖÇİÉ ãæŞÚ ÌÏíÏ');
define('_AM_WEBLINKS_SYSTEM_POST_LINK_DSC','"äÚã" ÇÍÊÓÇÈ ÇáÒíÇÑÇÊ Úä ÅÖÇİÉ ãæŞÚ ÌÏíÏ');
define('_AM_WEBLINKS_SYSTEM_POST_RATE','ÇÍÊÓÇÈ ÇáÊŞííã');
define('_AM_WEBLINKS_SYSTEM_POST_RATE_DSC','"äÚã" Óæİ íÊã ÇÍÊÓÇÈ ÇáÒíÇÑÇÊ ÚäÏ ÊŞíã ãæŞÚ');

define('_AM_WEBLINKS_VIEW_STYLE_CAT','ØÑíŞÉ ÚÑÖ ÇáŞÓã');
define('_AM_WEBLINKS_VIEW_STYLE_MARK','ØÑíŞÉ ÚÑÖ "ãæÇŞÚ íäÕÍ İíåÇ" ');
define('_AM_WEBLINKS_VIEW_STYLE_MARK_DSC','ÊØÈíŞ İí ÇáãæÇŞÚ ÇáãäÕÍ ÈåÇ, ÇáãæÇŞÚ ÇáãÊÈÇÏáÉ, ãæÇŞÚ RSS/ATOM');
define('_AM_WEBLINKS_VIEW_STYLE_0','ÇáÎáÇÕÉ');
define('_AM_WEBLINKS_VIEW_STYLE_1','æÕİ ßÇãá');

define('_AM_WEBLINKS_CONF_PERFORMANCE','ÊÍÓíä ÇáÃÏÇÁ');
define('_AM_WEBLINKS_CONF_PERFORMANCE_DSC','ÈÓÈÈ ÊÍÓíä ÇáÃÏÇÁ¡ ÊÍÓÈ ÇáÈíÇäÇÊ ãŞÏãÇ ÚäÏãÇ ÊÚÑÖ¡ æÊÎÒä İí ŞÇÚÏÉ ÇáÈíÇäÇÊ. <br /> ÚäÏãÇ ÅÓÊÚãÇá Ãæá ãÑÉ¡ ÊäİĞ ãä "ŞÇÆãÉ ÇáÃŞÓÇã" -> "ÊÍÏíË ãÓÇÑ ÇáÃŞÓÇã"');
define('_AM_WEBLINKS_CAT_PATH','ãÓÇÑ ÇáŞÓã');
define('_AM_WEBLINKS_CAT_PATH_DSC','"äÚã" íÍÓÈ ãÓÇÑ ÇáŞÓã¡ æíÎÒä İí ÌÏæá ÇáŞÓã. <br /> "áÇ" áÇ íÍÓÈ ÚäÏãÇ íÚÑÖ.');
define('_AM_WEBLINKS_CAT_COUNT','ÅÍÕÇÁ ÑæÇÈØ ÇáŞÓã');
define('_AM_WEBLINKS_CAT_COUNT_DSC','äÚã" íÍÓÈ ÅÍÕÇÁ ÑæÇÈØ¡ æíÎÒä İí ÌÏæá ÇáŞÓã. <br /> "áÇ" áÇ íÍÓÈ ÚäÏãÇ íÚÑÖ.');

define('_AM_WEBLINKS_POST_TEXT_4', 'ÌãíÚ ÇáÍŞæá ÊÚÑÖ İí ÕİÍÉ ÇáÃÏãä');
define('_AM_WEBLINKS_LINK_REGISTER_1','ÎíÇÑÇÊ ÇáÑæÇÈØ: ßÊÇÈÉ ÇáäÕ (ÚäÏ ÊÓÌíá ãæŞÚ ÌÏíÏ ÎÇäÉ ßÊÇÈÉ äÕ)');

define('_AM_WEBLINKS_CONF_LINK_GUEST','ÎíÇÑÇÊ ÈäÏ ÊÓÌíá ÑÇÈØ');
define('_AM_WEBLINKS_USE_CAPTCHA','Use CAPTCHA');
define('_AM_WEBLINKS_USE_CAPTCHA_DSC','CAPTCHA is technique for anti-spam.<br />This feature Need Captcha module.<br />YES, <b>anoymous user</b> must use CAPTCHA when add or modify link.<br />NO does not show CAPTCHA field.');
define('_AM_WEBLINKS_CAPTCHA_FINDED',     'Captcha module ver %s is finded');
define('_AM_WEBLINKS_CAPTCHA_NOT_FINDED', 'ÈÑäÇãÌ Captcha ÛíÑ ãËÈÊ');

define('_AM_WEBLINKS_CONF_SUBMIT', 'æÕİ Ôßá (ãæÌæÏÉ İí ÃÚáì ÇáÕİÍÉ ÚäÏ ÊÓÌíá ãæŞÚ) ÊÓÌíá ãæŞÚ');
define('_AM_WEBLINKS_SUBMIT_MAIN',    'æÕİ ÚäÏ ÅÖÇİÉ ãæŞÚ ÌÏíÏ: 1');
define('_AM_WEBLINKS_SUBMIT_PENDING', 'æÕİ ÚäÏ ÅÖÇİÉ ãæŞÚ ÌÏíÏ: 2');
define('_AM_WEBLINKS_SUBMIT_DOUBLE',  'æÕİ ÚäÏ ÅÖÇİÉ ãæŞÚ ÌÏíÏ: 3');
define('_AM_WEBLINKS_SUBMIT_MAIN_DSC',   'ÊÚÑÖ ÏÇÆãÇ');
define('_AM_WEBLINKS_SUBMIT_PENDING_DSC','ÊÚÑÖ ÚäÏãÇ "ÊÍÊÇÌ Åáì ãæÇİŞÉ ÇáÃÏãä"<br /> ÑÇÌÚ ÎíÇÑÇÊ ÇáÈÑäÇãÌ 2');
define('_AM_WEBLINKS_SUBMIT_DOUBLE_DSC', 'ÊÚÑÖ ÚäÏãÇ Êßæä ÇáãæÇİŞÉ Úáì ÇÓÊáÇã ÑæÇÈØ ãæÌæÏÉ ãİÚáÉ.<br /> ÑÇÌÚ ÎíÇÑÇÊ ÇáÑÇÈØ İí ÇáÇÓİá');

define('_AM_WEBLINKS_MODLINK_MAIN',     'æÕİ ÚäÏ ÊÚÏíá ÑÇÈØ: 1');
define('_AM_WEBLINKS_MODLINK_PENDING',  'æÕİ ÚäÏ ÊÚÏíá ÑÇÈØ: 2');
define('_AM_WEBLINKS_MODLINK_NOT_OWNER','æÕİ ÚäÏ ÊÚÏíá ÑÇÈØ: 3');
define('_AM_WEBLINKS_MODLINK_NOT_OWNER_DSC','ÊÚÑÖ ÚäÏãÇ ÇáÃÏãä íÑíÏ ãæÇİŞÉ');

define('_AM_WEBLINKS_CONF_CAT_FORUM', 'ÚÑÖ ÇáãäÊÏì İí ÇáŞÓã');
define('_AM_WEBLINKS_CONF_LINK_FORUM', 'ÚÑÖ ÇáãäÊÏì İí Ïáíá ÇáãæÇŞÚ');
//define('_AM_WEBLINKS_FORUM_SEL', 'Select Forum module');
define('_AM_WEBLINKS_FORUM_THREAD_LIMIT', 'ÚÏÏ ÇáãæÇÖíÚ');
define('_AM_WEBLINKS_FORUM_POST_LIMIT', 'ÚÏÏ ÇáãÔÇÑßÇÊ İí ÇáãæÖæÚ');
define('_AM_WEBLINKS_FORUM_POST_ORDER', 'ÊÑÊíÈ ÇáãÔÇÑßÇÊ');
define('_AM_WEBLINKS_FORUM_POST_ORDER_0', 'ÇáÃŞÏã');
define('_AM_WEBLINKS_FORUM_POST_ORDER_1', 'ÇáÃÍÏË');
//define('_AM_WEBLINKS_FORUM_INSTALLED',     'Forum module ( %s ) ver %s is installed');
//define('_AM_WEBLINKS_FORUM_NOT_INSTALLED', 'Forum module ( %s ) is not installed');

// === 2007-03-25 ===
define('_AM_WEBLINKS_UPDATE_CAT_IMAGE_SIZE','ÊÍÏíË ãŞÇÓ ÕæÑÉ ÇáŞÓã');

define('_AM_WEBLINKS_CONF_INDEX', 'ÎíÇÑÇÊ ÇáÕİÍÉ ÇáÑÆíÓíÉ');
define('_AM_WEBLINKS_CONF_INDEX_GM_MODE', 'äãØ ÎÑíØÉ ÌæÌá');

define('_AM_WEBLINKS_CAT_SHOW_GM',   'ÚÑÖ ÎÑÇÆØ ÌæÌá');
define('_AM_WEBLINKS_MODE_NON',       'áÇ ÊÚÑÖ');
define('_AM_WEBLINKS_MODE_DEFAULT',   'ÇáÃİÊÑÇÖí');
define('_AM_WEBLINKS_MODE_PARENT',    'äİÓ ÇáŞÓã ÇáÑÆíÓí');
define('_AM_WEBLINKS_MODE_FOLLOWING', 'ÍÓÈ ÇáÃÑŞÇã ÇáãæÌæÏÉ');

define('_AM_WEBLINKS_CONF_CAT_ALBUM',  'ÚÑÖ ÇáÈæã ÇáÕæÑ İí ÇáŞÓã');
define('_AM_WEBLINKS_CONF_LINK_ALBUM', 'ÚÑÖ ÇáÈæã ÇáÕæÑ İí ÇáÏáíá');
//define('_AM_WEBLINKS_ALBUM_SEL', 'Select Album module');
define('_AM_WEBLINKS_ALBUM_LIMIT', 'ÚÏÏ ÇáÕæÑ');
define('_AM_WEBLINKS_WHEN_OMIT', 'Process when omit');

define('_AM_WEBLINKS_MODULE_INSTALLED',     '%s ÈÑäÇãÌ ( %s ) ÇÕÏÇÑ %s ãÑßÈ');
define('_AM_WEBLINKS_MODULE_NOT_INSTALLED', '%s ÈÑäÇãÌ ( %s ) áã íÑßÈ');

// === 2007-04-08 ===
define('_AM_WEBLINKS_CAT_DESC_MODE',  'ÚÑÖ ÇáæÕİ');
define('_AM_WEBLINKS_CAT_SHOW_FORUM', 'ÚÑÖ ÇáãäÊÏì');
define('_AM_WEBLINKS_CAT_SHOW_ALBUM', 'ÚÑÖ ÇáÇáÈæã');
define('_AM_WEBLINKS_MODE_SETTING',   'ÊÍÏíÏ ÇáŞíãÉ');
define('_AM_WEBLINKS_MODE_OMIT_PARENT', 'ÅÑÌÇÚ ÇáÃíŞæäÉ');

// === 2007-06-10 ===
// d3forum
define('_AM_WEBLINKS_CONF_D3FORUM', 'Comment-integration with d3forum module');
define('_AM_WEBLINKS_PLUGIN_SEL',   'ÃÎÊÑ ÇáÅÖÇİÉ');
define('_AM_WEBLINKS_DIRNAME_SEL',  'ÃÎÊÑ ÇáÈÑäÇãÌ');

// category
define('_AM_WEBLINKS_CAT_PATH_STYLE', 'ØÑíŞÉ ÚÑÖ ÇáÃŞÓÇã İí ŞÇÆãÉ ÇáÃŞÓÇã');

// category page
define('_AM_WEBLINKS_CONF_CAT_PAGE', 'ÅÚÏÇÏÊ ÕİÍÉ ÇáŞÓã');
define('_AM_WEBLINKS_CAT_COLS', 'ÚÏÏ ÃÚãÏÉ ÇáÃŞÓÇã İí ÇáÕİÍÉ ÇáÑÆíÓíÉ');
define('_AM_WEBLINKS_CAT_COLS_DESC', 'ÚÏÏ ÃÚãÏÉ ÇáÃŞÓÇã ÇáİÑÚíÉ İí ÇáÕİÍÉ ÇáŞÓã ÇáÑÆíÓí');
define('_AM_WEBLINKS_CAT_SUB_MODE', 'ØÑíŞÉ ÚÑÖ ÇáÃŞÓÇã ÇáİÑÚíÉ<br>áÇ ÊÚÑÖ íÚäí ÚÏã ÚÑÖ ÇáÃŞÓÇã ÇáİÑÚíÉ İí ÇáÑÆíÓíÉ<br>ÚÑÖ ŞÓã İÑÚí æÇÍÏ íÚäí ÚÑÖ ŞÓã İÑÚí ÑÆíÓí æÇÍÏ');
define('_AM_WEBLINKS_CAT_SUB_MODE_1', 'ÚÑÖ ŞÓã İÑÚí æÇÍÏ');
define('_AM_WEBLINKS_CAT_SUB_MODE_2', 'ÚÑÖ ÌãíÚ ÇáÃŞÓÇã');

// === 2007-07-14 ===
// highlight
define('_AM_WEBLINKS_USE_HIGHLIGHT', 'Êáæíä ßáãÉ ÇáÈÍË');
define('_AM_WEBLINKS_CHECK_MAIL', 'İÍÕ ÕíÛÉ ÇáÅíãíá');
define('_AM_WEBLINKS_CHECK_MAIL_DSC', 'áÇ íÓãÍ áÃí ÕíÛÉ. <br /> äÚã íÏŞŞ ÈÃä ÕíÛÉ ÇáÅíãíá ãËá abc@efg.com ÚäÏ ÊÓÌíá ÑÇÈØ.');
//define('_AM_WEBLINKS_NO_EMAIL', 'Not Set Email Address');

// === 2007-08-01 ===
// config
define('_AM_WEBLINKS_MODULE_CONFIG_0','ÎíÇÑÇÊ ÇáÈÑäÇãÌ');
define('_AM_WEBLINKS_MODULE_CONFIG_DESC_0','ÇáÑÆíÓíÉ');
define('_AM_WEBLINKS_MODULE_CONFIG_5','ÎíÇÑÇÊ ÇáÈÑäÇãÌ 5');
define('_AM_WEBLINKS_MODULE_CONFIG_DESC_5','ÍŞæá, äãæĞÌ(Ôßá)ÚäÏ ÊÓÌíá ÇáãæŞÚ');
define('_AM_WEBLINKS_MODULE_CONFIG_6','ÎíÇÑÇÊ ÇáÈÑäÇãÌ 6');
define('_AM_WEBLINKS_MODULE_CONFIG_DESC_6','ÎÑíØÉ ÌæÌá');

// google map
define('_AM_WEBLINKS_GM_MAP_CONT',  'Map Control');
define('_AM_WEBLINKS_GM_MAP_CONT_DESC',  'GLargeMapControl, GSmallMapControl, GSmallZoomControl');
define('_AM_WEBLINKS_GM_MAP_CONT_NON',   'áÇ ÊÚÑÖ');
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
define('_AM_WEBLINKS_GM_GEOCODE_KIND',  '[ŒŸõ] Kind of Geocode');
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
define('_AM_WEBLINKS_INDEX_MODE_LATEST', 'ÍÓÈ ÂÎÑ ÑÇÈØ');
define('_AM_WEBLINKS_INDEX_MODE_LATEST_UPDATE', 'ÊÇÑíÎ ÇáÊÍÏíË');
define('_AM_WEBLINKS_INDEX_MODE_LATEST_CREATE', 'äÇÑíÎ ÇáÃäÔÇÁ');

// header
define('_AM_WEBLINKS_CONF_HTML_STYLE', 'ÎíÇÑÇÊ HTML');
define('_AM_WEBLINKS_HEADER_MODE', 'ÅÓÊÚãÇá xoops åíÏÑ');
define('_AM_WEBLINKS_HEADER_MODE_DESC', '"áÇ"¡Óæİ íÚÑÖ css æÇáÌÇİÇ ÓßÑÈÊ İí body tag <br />  "äÚã"¡ Óæİ ÊÚÑÖ İí body tag <br /> åäÇß ãæÇÖíÚ äİÓåÇ ÇáÊí áÇ íãßä Ãä ÊÓÊÚãá');

// bulk
define('_AM_WEBLINKS_BULK_SAMPLE','íãßäß Çä ÊÑì ÚíäÉ , ÃÖÛØ Úáì ÒÑ ÚíäÉ');
define('_AM_WEBLINKS_BULK_LINK_DSC10','ãæÇŞÚ ËÇÈÊÉ');
define('_AM_WEBLINKS_BULK_LINK_DSC20','ÇáÇÏãä íÍÏÏ ÇáãæÇŞÚ ÇáãÓÌáÉ');
define('_AM_WEBLINKS_BULK_LINK_DSC21','ÇáİŞÑÉ ÇáÃæáì');
define('_AM_WEBLINKS_BULK_LINK_DSC22','ÇáİŞÑÉ ÇáËÇäíÉ¡ æãÊÇÈÚÉ');
define('_AM_WEBLINKS_BULK_LINK_DSC23','ÇßÊÈ ÇáãæÇŞÚ ÇáãÓÌáÉ İí ÇáÓØÑ ÇáÇæá.<br />ÇßÊÈ ÎØ ÇİŞí(---)');
define('_AM_WEBLINKS_BULK_LINK_DSC24','æÕİ ÇáãæÇŞÚ ÇáãÓÌáÉ¡ ÍÓÈ ÇáÊÑÊíÈ İí ÇáÓØÑ ÇáÇæá¡ İÕá ÈÜ(,)æİí ÇáÓØÑ ÇáËÇäí.');
define('_AM_WEBLINKS_BULK_CHECK_URL','İÍÕ ÊÍÏíÏ ÇÓã ÇáãæŞÚ');
define('_AM_WEBLINKS_BULK_CHECK_DESCRIPTION','İÍÕ ÊÍÏíÏ ÇáæÕİ');

// === 2007-09-01 ===
// auth
define('_AM_WEBLINKS_AUTH_DELETE','íÓÊØíÚ ÇáÍĞİ');
define('_AM_WEBLINKS_AUTH_DELETE_DSC','ÍÏøÏ ÇáãÌãæÚÇÊ ÓãÍÊ ÈÇÑÓÇá ØáÈÇÊ ÍĞİ ÇáæÕáÉ');
define('_AM_WEBLINKS_AUTH_DELETE_AUTO','íÓÊØíÚ ÇáãæÇİŞÉ Úáì ÍĞİ ÑÇÈØ');
define('_AM_WEBLINKS_AUTH_DELETE_AUTO_DSC','ÍÏøÏ ÇáãÌãæÚÇÊ ÇáÊí ÓãÍÊ ÇáãæÇİŞÉ Úáì ØáÈÇÊ ÍĞİ ÇáÑÇÈØ');

// nofitication
define('_AM_WEBLINKS_NOTIFICATION_MANAGE', 'ÇÏÇÑÉ ÇáÊÈáíÛÇÊ');
define('_AM_WEBLINKS_NOTIFICATION_MANAGE_DESC', 'ÎíÇÑ áßá ÈÑäÇãÌ ãÏíÑ<br />äİÓ ÇáãæÌæÏ İí ÇÚáì ÇáÕİÍÉ áåĞÇ ÇáÈÑäÇãÌ');
define('_AM_WEBLINKS_NOTIFICATION_MANAGE_NOT_USE', "áÇ íãßä ÇÓÊÚãÇáåÇ İí ÈÚÖ ÇÕÏÇÑÇÊ XOOPS");
define('_AM_WEBLINKS_NOTIFICATION_MANAGE_PLEASE', 'İí åĞå ÇáÍÇáÉ¡ ÑÌÇÁ ÅÓÊÚãá İí ÃÚáì ÇáÕİÍÉ ãä åĞÇ ÇáÈÑäÇãÌ');
define('_AM_WEBLINKS_SUBJ_LINK_MOD_APPROVED', '[{X_SITENAME}] {X_MODULE}: ØáÈ ÊÚÏíáß ãÕÏŞ');
define('_AM_WEBLINKS_SUBJ_LINK_MOD_REFUSED',  '[{X_SITENAME}] {X_MODULE}: ÊØáÈ ÊÚÏíáß ãÑİæÖ');
define('_AM_WEBLINKS_SUBJ_LINK_DEL_APPROVED', '[{X_SITENAME}] {X_MODULE}: ãæÇİŞÉ Úáì ØáÈß ÈÍĞİ ÇáãæŞÚ');
define('_AM_WEBLINKS_SUBJ_LINK_DEL_REFUSED',  '[{X_SITENAME}] {X_MODULE}: ÑİÖ Úáì ØáÈß ÈÍĞİ ÇáãæŞÚ');

// config
define('_AM_WEBLINKS_ADMIN_WAITING_SHOW', 'ÚÑÖ ŞÇÆãÉ ÇäÊÙÇÑ ÇáÇÏãä');
define('_AM_WEBLINKS_USER_WAITING_NUM',   'ÚÏÏ ŞÇÆãÉ ÅäÊÙÇÑ ÃÚÖÇÁ ÇáÑæÇÈØ');
define('_AM_WEBLINKS_USER_OWNER_NUM',     'ÚÑÖ ÚÏÏ ÇáãæÇŞÚ ÇáãÑÓáÉ ãä ÇáÚÖæ İí "ŞÇÆãÉ ãæÇŞÚß"');
define('_AM_WEBLINKS_USE_HITS_SINGLELINK','ÇÍÊÓÇÈ ÇáÒíÇÑÇÊ ÚäÏ ÇáÖÛØ Úáí " ãÒíÏ ãä ÇáÊİÇÕíá"');
define('_AM_WEBLINKS_USE_HITS_SINGLELINK_DSC','"äÚã"ÇÍÊÓÇÈ ÇáÒíÇÑÇÊ ÚäÏ ÇáÖÛØ Úáí " ãÒíÏ ãä ÇáÊİÇÕíá"');
define('_AM_WEBLINKS_MODE_RANDOM', 'ÇáãæŞÚ ÇáÚÔæÇÆí');
define('_AM_WEBLINKS_MODE_RANDOM_URL', 'ÇáĞåÇÈ Çáí ÇáãæŞÚ');
define('_AM_WEBLINKS_MODE_RANDOM_SINGLE', 'ÇáĞåÇÈ Çáí ÕİÍÉ ÇáãæŞÚ İí ÇáÏáíá');

// request list
define('_AM_WEBLINKS_DEL_REQS', 'ÑæÇÈØ ÊäÊÙÑ ÇáÍĞİ');
define('_AM_WEBLINKS_NO_DEL_REQ','áÇ íæÌÏ ØáÈÇÊ áÍĞİ ÇáÑæÇÈØ');
define('_AM_WEBLINKS_DEL_REQ_DELETED','ØáÈ ÇáÍĞİ ÍĞİ');

// link list
define('_AM_WEBLINKS_LINK_USERCOMMENT_DESC','ŞÇÆãÉ ÇáÑæÇÈØ ÈÇáÊÚáíŞ ááÅÏÇÑÉ (ÍÓÈ ÇáÑŞã)');

// clone
define('_AM_WEBLINKS_CLONE_LINK', 'ÅÚÇÏÉ äÓÎ');
define('_AM_WEBLINKS_CLONE_MODULE', 'äÓÎ Åáì ÈÑäÇãÌ ÂÎÑ');
define('_AM_WEBLINKS_CLONE_CONFIRM', 'ÊÃßíÏ ÇáäÓÎ');
define('_AM_WEBLINKS_NO_MODULE', 'áíÓ åäÇß ÈÑäÇãÌ ãØÇÈŞ');

// link form
define('_AM_WEBLINKS_MODIFIED', 'ÚÏá');
define('_AM_WEBLINKS_CHECK_CONFIRM', 'ÃßÏ');
define('_AM_WEBLINKS_WARN_CONFIRM', 'ÊÍĞíÑ: ÏŞŞ ãä "ãÄßÏ" %s');
define('_AM_WEBLINKS_RSSC_LID_EXIST_MORE', 'åäÇß ÑÇÈØ Çæ ÃßËÑ áåã äİÓ ÇáÑŞã "ÑŞã ãÑßÒ ÇáÚäÇæíä"');

// web shot
define('_AM_WEBLINKS_LINK_IMG_THUMB', 'ÕæÑÉ ÇáãæŞÚ');
define('_AM_WEBLINKS_LINK_IMG_THUMB_DSC', 'ÚÑÖ ÕæÑÉ ãÕÛÑÉ ááãæŞÚ¡ <br /> ÈÇÓÊÎÏÇã ãÒæÏ ÇáÎÏãÉ¡ <br /> ÇĞÇ ßÇä áÇ áä ÊÙåÑ ÇáÕæÑÉ ÇáãÕÛÑÉ.');
define('_AM_WEBLINKS_LINK_IMG_NON', 'áÇ');
define('_AM_WEBLINKS_LINK_IMG_MOZSHOT', 'ÇÓÊÚãá ãæŞÚ <a href="http://mozshot.nemui.org/" target="_blank">MozShot</a>');
define('_AM_WEBLINKS_LINK_IMG_SIMPLEAPI', 'ÇÓÊÚãá ãæŞÚ <a href="http://img.simpleapi.net/" target="_blank">SimpleAPI</a>');

// === 2007-11-01 ===
// google map
define('_AM_WEBLINKS_GM_MARKER_WIDTH',  '[Marker] Width (pixel)');
define('_AM_WEBLINKS_GM_MARKER_WIDTH_DESC',  'Width of map marker info<br /><b>-1</b> is unspecifid');
define('_AM_WEBLINKS_LINK_IMG_USE', 'íÓÊÚãá %s');

define('_AM_WEBLINKS_RSS_SITE', 'åĞÇ ÇáãæŞÚ');
define('_AM_WEBLINKS_RSS_FEED', 'RSS feeds');

// nameflag mainflag
define('_AM_WEBLINKS_CONF_LINK_USER','ÎíÇÑ ÑæÇÈØ ÇáÇÚÖÇÁ');
define('_AM_WEBLINKS_USER_NAMEFLAG','Select view of nameflag');
define('_AM_WEBLINKS_USER_MAILFLAG','Select view of mailflag');
define('_AM_WEBLINKS_USER_NAME_MAIL_FLAG_DESC','ÇáŞíãÉ ÇáÇİÊÑÇÖíÉ ÚäÏ ÊÓÌíá ÇáÚÖæ<br />ÇáÇÏãä íÓÊØíÚ Çä íÛíÑ ÇáŞíãÉ');
define('_AM_WEBLINKS_USER_NAME_MAIL_FLAG_SEL','ÃÎÊíÇÑ ÇáÚÖæ');

// description length
define('_AM_WEBLINKS_DESC_LENGTH', 'ÃŞÕì Øæá ãä ÇáÍÑæİ');
define('_AM_WEBLINKS_DESC_LENGTH_DSC', '<b>-1</b> or the admin : 64KB limit<br />');

// === 2007-12-09 ===
define("_AM_WEBLINKS_D3FORUM_VIEW", "ÚÑÖ äæÚ ÇáÇãÑ");

}
// --- define language begin ---

?>