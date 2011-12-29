<?php
// $Id: blocks.php,v 1.1 2011/12/29 14:32:46 ohwada Exp $

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
// 2004-10-24 K.OHWADA
// 有朋自遠方来
//=========================================================

// --- define language begin ---
if( !defined('WEBLINKS_LANG_BL_LOADED') ) 
{

define('WEBLINKS_LANG_BL_LOADED', 1);

// top.html
define('_MB_WEBLINKS_DISP','表示リンク数');
define('_MB_WEBLINKS_LINKS',' 件');
define('_MB_WEBLINKS_CHARS','表示リンク名の長さ');
define('_MB_WEBLINKS_LENGTH',' バイト');
define('_MB_WEBLINKS_NEWDAYS','新着リンクの日数');
define('_MB_WEBLINKS_DAYS',' 日');
define('_MB_WEBLINKS_POPULAR','人気リンクのヒット数');
define('_MB_WEBLINKS_HITS',' ヒット数');
define('_MB_WEBLINKS_PIXEL',' ピクセル');
define('_MB_WEBLINKS_RATING','評価');
define('_MB_WEBLINKS_VOTES','投票数');
define('_MB_WEBLINKS_COMMENTS','コメント');

// catlist.html
define('_MB_WEBLINKS_TOTAL_LINKS','総登録リンク数');
define('_MB_WEBLINKS_IMAGE_MODE','カテゴリ画像の選択');
define('_MB_WEBLINKS_IMAGE_MODE_0','なし');
define('_MB_WEBLINKS_IMAGE_MODE_1','folder.gif');
define('_MB_WEBLINKS_IMAGE_MODE_2','設定した画像');
define('_MB_WEBLINKS_MAX_WIDTH','画像の最大表示幅');
define('_MB_WEBLINKS_WIDTH_DEFAULT','画像のデフォルト表示幅');

// by Tom
define('_MB_WEBLINKS_DISPSUB','サブカテゴリの最大表示数：');

// atom feed
define('_MB_WEBLINKS_NUM_FEED','表示記事数');
define('_MB_WEBLINKS_NUM_TITLE','タイトルの長さ');
define('_MB_WEBLINKS_NUM_SUMMARY','要約の長さ');
define('_MB_WEBLINKS_NUM_CONTENT','本文を表示する記事数');
define('_MB_WEBLINKS_LINK_ID','リンクID');
define('_MB_WEBLINKS_NO_LINK_ID','リンクIDが選択されていない');
define('_MB_WEBLINKS_NO_ATOMFEED','該当する記事がない');
define('_MB_WEBLINKS_MORE','もっと詳しく');

// 2006-11-03 added by hiro
// random block
define('_MB_WEBLINKS_MAX_DESC','本文の文字数');
define('_MB_WEBLINKS_SHOW_DATE','日付けを表示する');
define('_MB_WEBLINKS_MODE_URL','URLの表示方法');
define('_MB_WEBLINKS_MODE_URL_SINGLE','singlelink.php');
define('_MB_WEBLINKS_MODE_URL_VISIT','visit.php');
define('_MB_WEBLINKS_MODE_URL_DIRECT','URLを直接表示');
define('_MB_WEBLINKS_URL_EMPTY','空のURL');
define('_MB_WEBLINKS_URL_EMPTY_INCLUDE','空のURLを含む');
define('_MB_WEBLINKS_URL_EMPTY_EXCLUDE','空のURLを除外する');
define('_MB_WEBLINKS_CATEGORY','カテゴリ指定');
define('_MB_WEBLINKS_WITH_SUBCAT','サブカテゴリも含む');
define('_MB_WEBLINKS_MODE','リンク・モード');
define('_MB_WEBLINKS_RECOMMEND','おすすめサイト');
define('_MB_WEBLINKS_MUTUAL','相互リンクサイト');
define('_MB_WEBLINKS_RANDOM','リンクをランダムに表示する');
define('_MB_WEBLINKS_ORDER','表示のソート順');
define('_MB_WEBLINKS_ORDER_DESC','「リンクをランダムに表示する」が「いいえ」のときに有効');
define('_MB_WEBLINKS_TIME_UPDATE','更新日');
define('_MB_WEBLINKS_TIME_CREATE','登録日');
define('_MB_WEBLINKS_TITLE','タイトル');
define('_MB_WEBLINKS_ASC','昇順');
define('_MB_WEBLINKS_DESC','降順');

// === 2007-03-25 ===
// google map
define('_MB_WEBLINKS_GM_MODE','GoogleMap モード');
define('_MB_WEBLINKS_GM_MODE_DSC','0:非表示, 1:デフォルト, 2:下記の設定値');
define('_MB_WEBLINKS_GM_LATITUDE','緯度');
define('_MB_WEBLINKS_GM_LONGITUDE','経度');
define('_MB_WEBLINKS_GM_ZOOM','ズーム');
define('_MB_WEBLINKS_GM_HEIGHT','表示の高さ');
define('_MB_WEBLINKS_GM_TIMEOUT','表示の遅延時間');
define('_MB_WEBLINKS_GM_TIMEOUT_DSC','ミリ秒  -1:window.onload');

// 2007-04-08
define('_MB_WEBLINKS_PHOTOS', '写真の枚数');

// === 2007-08-01 ===
define('_MB_WEBLINKS_CAT_TITLE_LENGTH','カテゴリ・タイトルの文字数');
define('_MB_WEBLINKS_GM_DESC_LENGTH','mapの本文の文字数');
define('_MB_WEBLINKS_GM_WORDWRAP','mapのwordwrapの文字数');

// === 2007-10-10 ===
define('_MB_WEBLINKS_GM_MARKER_WIDTH','mapのマーカーの横幅');

// === 2008-02-17 ===
define('_MB_WEBLINKS_GM_CONTROL','mapのマップ・コントロール');
define('_MB_WEBLINKS_GM_CONTROL_DSC','0:非表示, 1:表示');
define('_MB_WEBLINKS_GM_TYPE_CONTROL','mapの地図形式ボタン');

}
// --- define language end ---

?>