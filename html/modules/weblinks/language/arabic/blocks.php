<?php
// $Id: blocks.php,v 1.1 2011/12/29 14:32:44 ohwada Exp $

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
define("_MB_WEBLINKS_DISP","Úׁײ");
define("_MB_WEBLINKS_LINKS","ַבׁזַָ״");
define("_MB_WEBLINKS_CHARS","״זב ַבֳ׃ד");
define("_MB_WEBLINKS_LENGTH"," ַבֽׁזÝ");
define("_MB_WEBLINKS_NEWDAYS","ֳםַד ַבַָׁ״ ַבּֿםֿ");
define("_MB_WEBLINKS_DAYS","ַבֳםַד");
define("_MB_WEBLINKS_POPULAR","ׂםַַׁÊ ַבׁזַָ״ ַבֳßֻׁ ׂםַֹׁ");
define("_MB_WEBLINKS_HITS"," ַבַַָׁׂÊ");
define("_MB_WEBLINKS_PIXEL"," ָß׃ב");
define("_MB_WEBLINKS_RATING","ַבÊÞםםד");
define("_MB_WEBLINKS_VOTES","ַבÊױזםÊַÊ");
define("_MB_WEBLINKS_COMMENTS","ַבÊÚבםÞַÊ");

// catlist.html
define('_MB_WEBLINKS_TOTAL_LINKS',"ַבדּדזÚ");
define("_MB_WEBLINKS_IMAGE_MODE","ֳ־Êׁ ױזֹׁ ַבÞ׃ד");
define("_MB_WEBLINKS_IMAGE_MODE_0","בַ װםֶ");
define("_MB_WEBLINKS_IMAGE_MODE_1","folder.gif");
define("_MB_WEBLINKS_IMAGE_MODE_2","־םַַׁÊ ַבױזֹׁ");
define('_MB_WEBLINKS_MAX_WIDTH',"ַבֽֿ ַבֳÞױל בÚׁײ ַבױזֹׁ");
define('_MB_WEBLINKS_WIDTH_DEFAULT',"Úׁײ ַבױזֹׁ ַבֳÝÊַׁײם");
define("_MB_WEBLINKS_DISPSUB","ֳÞױל Úֿֿ דה ַבֳÞ׃ַד ַבÝׁÚםֹ");

// atom feed
define("_MB_WEBLINKS_NUM_FEED","Úֿֿ feeds");
define("_MB_WEBLINKS_NUM_TITLE","״זב ַבÚהזַה");
define("_MB_WEBLINKS_NUM_SUMMARY","״זב ַב־בַױֹ");
define("_MB_WEBLINKS_NUM_CONTENT","Úֿֿ feeds ַבÊם ÊÚׁײ דÚ ַבדֽÊזל");
define("_MB_WEBLINKS_LINK_ID","ׁÞד ַבַָׁ״");
define("_MB_WEBLINKS_NO_LINK_ID","בÞֿ ה׃םÊ ַה ÊßÊָ ׁÞד ַבַָׁ״");
define("_MB_WEBLINKS_NO_ATOMFEED","בם׃ והַß feed ד״ַָÞ");
define("_MB_WEBLINKS_MORE","דׂםֿ דה ַבÊÝַױםב");

// 2006-11-03
// random block
define('_MB_WEBLINKS_MAX_DESC','ֳÞױל ״זב בבזױÝ');
define('_MB_WEBLINKS_SHOW_DATE', 'Úׁײ ַבÊַׁם־');
define('_MB_WEBLINKS_MODE_URL','Úׁײ ַ׃Êַםב Úהזַה ַבדזÞÚ');
define('_MB_WEBLINKS_MODE_URL_SINGLE','singlelink.php');
define('_MB_WEBLINKS_MODE_URL_VISIT','visit.php');
define('_MB_WEBLINKS_MODE_URL_DIRECT','Úׁײ ַבדזÞÚ דַָװֹׁ');
define('_MB_WEBLINKS_URL_EMPTY','Úהזַה ÝַׁÛ');
define('_MB_WEBLINKS_URL_EMPTY_INCLUDE','םÊײדה ַבÚהזַה ַבÝַׁÛ');
define('_MB_WEBLINKS_URL_EMPTY_EXCLUDE','ם׃Êֻהם ַבÚהזַה ַבÝַׁÛ');
define('_MB_WEBLINKS_CATEGORY','ַבÞ׃ד');
define('_MB_WEBLINKS_WITH_SUBCAT','דÚ ַבֳÞ׃ַד ַבÝׁÚםֹ');
define('_MB_WEBLINKS_MODE','הד״ ַבַָׁ״');
define('_MB_WEBLINKS_RECOMMEND','דזÞÚ םהױֽ ָֹ');
define('_MB_WEBLINKS_MUTUAL','דזÞÚ דÊַָֿב ׁזַָ״');
define('_MB_WEBLINKS_RANDOM','ÊׁÊםָ Úװזֶַם');
define('_MB_WEBLINKS_ORDER','ֽ׃ָ');
define('_MB_WEBLINKS_ORDER_DESC','ױֽםֽ Úהֿדַ םßזה "ַבÊׁÊםָ ַבÚװזֶַם" בַ');
define('_MB_WEBLINKS_TIME_UPDATE','זÞÊ ַבÊּֿםֿ');
define('_MB_WEBLINKS_TIME_CREATE','זÞÊ ַבֳהװֱַ');
define('_MB_WEBLINKS_TITLE','ַבÚהזַה');
define('_MB_WEBLINKS_ASC', 'ÊׁÊםָ ÊױַÚֿם');
define('_MB_WEBLINKS_DESC','ÊׁÊםָ  Êהַׂבם');

// === 2007-03-25 ===
// google map
define('_MB_WEBLINKS_GM_MODE','הד״ ־ׁם״ֹ ּזּב');
define('_MB_WEBLINKS_GM_MODE_DSC','0:Úֿד Úׁײ, 1:ַבֳÝÊַׁײם, 2:ֽ׃ָ ַבַׁÞַד');
define('_MB_WEBLINKS_GM_LATITUDE','־״ר ַבÚׁײ');
define('_MB_WEBLINKS_GM_LONGITUDE','־״ר ַב״זב');
define('_MB_WEBLINKS_GM_ZOOM','ַבÊÞׁםָ');
define('_MB_WEBLINKS_GM_HEIGHT','״זב דÞַ׃ ַב־ׁם״ֹ');
define('_MB_WEBLINKS_GM_TIMEOUT','Delay time for drawing');
define('_MB_WEBLINKS_GM_TIMEOUT_DSC','msec  -1:window.onload');

// 2007-04-08
define('_MB_WEBLINKS_PHOTOS', 'Úֿֿ ַבױזׁ');

// === 2007-08-01 ===
define('_MB_WEBLINKS_CAT_TITLE_LENGTH','״זב Úהזַה ַבÞ׃ד');
define('_MB_WEBLINKS_GM_DESC_LENGTH','״זב ַבדֽÊזל Ýם Úבַדֹ ַב־ׁם״ֹ');
define('_MB_WEBLINKS_GM_WORDWRAP','״זב wordwrap Ýם Úבַדֹ ַב־ׁם״ֹ');

// === 2007-10-10 ===
define('_MB_WEBLINKS_GM_MARKER_WIDTH','Width of map marker');

}
// --- define language end ---

?>