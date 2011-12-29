<?php
// $Id: modinfo.php,v 1.1 2011/12/29 14:32:46 ohwada Exp $

// 2008-02-17
// remove _MI_WEBLINKS_SMNAME1

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
// 有朋自遠方来
//=========================================================

// --- define language begin ---
if( !defined('WEBLINKS_LANG_MI_LOADED') ) 
{

define('WEBLINKS_LANG_MI_LOADED', 1);

//---------------------------------------------------------
// same as mylinks
//---------------------------------------------------------
// The name of this module
define("_MI_WEBLINKS_NAME","WEBリンク集");

// A brief description of this module
define("_MI_WEBLINKS_DESC","ユーザが自由にリンク情報の登録／修正／評価を行えるセクションを作成します。");

// Names of blocks for this module (Not all module has blocks)
define("_MI_WEBLINKS_BNAME1","新着リンク");
define("_MI_WEBLINKS_BNAME2","人気リンク");
define("_MI_WEBLINKS_BNAME3","高評価リンク");

// Sub menu titles
//define("_MI_WEBLINKS_SMNAME1","登録する");
//define("_MI_WEBLINKS_SMNAME2","人気サイト");
//define("_MI_WEBLINKS_SMNAME3","高評価サイト");

// update of admin menu
define("_MI_WEBLINKS_ADMENU1","モジュールの設定２");
define("_MI_WEBLINKS_ADMENU2","カテゴリの管理");
define("_MI_WEBLINKS_ADMENU3","リンクの管理");
define("_MI_WEBLINKS_ADMENU4","新規リンクの追加");
define("_MI_WEBLINKS_ADMENU5","承認待ちの新規リンク");
define("_MI_WEBLINKS_ADMENU6","承認待ちの修正リンク");
define("_MI_WEBLINKS_ADMENU7","リンク切れ報告");

//-------------------------------------
// Title of config items
// Description of each config items
//-------------------------------------
define('_MI_WEBLINKS_POPULAR','「人気リンク」になるためのヒット数');
define('_MI_WEBLINKS_POPULARDSC', '「POPLUAR」アイコンが表示されるためのヒット数を指定してください。<br />0 を指定すると、アイコンは表示されない。');
define('_MI_WEBLINKS_NEWLINKS','「新着リンク」を表示する件数');
define('_MI_WEBLINKS_NEWLINKSDSC', 'トップページに「新着リンク」を表示する最大件数を指定してください。');
define('_MI_WEBLINKS_PERPAGE','リンク情報を１ページ毎に表示する件数');
define('_MI_WEBLINKS_PERPAGEDSC', 'リンク詳細表示で１ページあたりに表示する最大件数を指定してください。');

//define('_MI_WEBLINKS_ANONPOST','匿名ユーザによるリンク新規登録を許可する');
//define('_MI_WEBLINKS_AUTOAPPROVE','リンク新規登録の自動承認');
//define('_MI_WEBLINKS_AUTOAPPROVEDSC','管理者の承認操作なしで、リンク新規登録の承認を行う場合は、「はい」を選択してください。');

//-------------------------------------
// Text for notifications
//-------------------------------------
define('_MI_WEBLINKS_GLOBAL_NOTIFY', 'モジュール全体');
define('_MI_WEBLINKS_GLOBAL_NOTIFYDSC', 'リンク集モジュール全体における通知オプション');

define('_MI_WEBLINKS_CATEGORY_NOTIFY', '表示中のカテゴリ');
define('_MI_WEBLINKS_CATEGORY_NOTIFYDSC', '表示中のカテゴリに対する通知オプション');

define('_MI_WEBLINKS_LINK_NOTIFY', '表示中のリンク');
define('_MI_WEBLINKS_LINK_NOTIFYDSC', '表示中のリンクに対する通知オプション');

define('_MI_WEBLINKS_GLOBAL_NEWCATEGORY_NOTIFY', '新規カテゴリ');
define('_MI_WEBLINKS_GLOBAL_NEWCATEGORY_NOTIFYCAP', '新規カテゴリが作成された場合に通知する');
define('_MI_WEBLINKS_GLOBAL_NEWCATEGORY_NOTIFYDSC', '新規カテゴリが作成された場合に通知する');
define('_MI_WEBLINKS_GLOBAL_NEWCATEGORY_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} : 新規カテゴリが作成されました（リンク集）');

define('_MI_WEBLINKS_GLOBAL_LINKMODIFY_NOTIFY', '[管理者] リンク修正・削除のリクエスト');
define('_MI_WEBLINKS_GLOBAL_LINKMODIFY_NOTIFYCAP', '[管理者] リンク修正・削除のリクエストがあった場合に通知する');
define('_MI_WEBLINKS_GLOBAL_LINKMODIFY_NOTIFYDSC', 'リンク修正・削除のリクエストがあった場合に通知する');
define('_MI_WEBLINKS_GLOBAL_LINKMODIFY_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE}: リンク修正・削除のリクエストがありました');

define('_MI_WEBLINKS_GLOBAL_LINKBROKEN_NOTIFY', '[管理者] リンク切れ報告');
define('_MI_WEBLINKS_GLOBAL_LINKBROKEN_NOTIFYCAP', '[管理者] リンク切れの報告があった場合に通知する');
define('_MI_WEBLINKS_GLOBAL_LINKBROKEN_NOTIFYDSC', 'リンク切れの報告があった場合に通知する');
define('_MI_WEBLINKS_GLOBAL_LINKBROKEN_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE}: リンク切れの報告がありました');

define('_MI_WEBLINKS_GLOBAL_LINKSUBMIT_NOTIFY', '[管理者] 新規リンクの投稿 (承認待ち) ');
define('_MI_WEBLINKS_GLOBAL_LINKSUBMIT_NOTIFYCAP', '[管理者] 新規リンク (承認待ち) の投稿があった場合に通知する');
define('_MI_WEBLINKS_GLOBAL_LINKSUBMIT_NOTIFYDSC', '新規リンク (承認待ち) の投稿あった場合に通知する');
define('_MI_WEBLINKS_GLOBAL_LINKSUBMIT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE}: 新規リンク (承認待ち) の投稿がありました');

define('_MI_WEBLINKS_GLOBAL_NEWLINK_NOTIFY', '新規リンク掲載');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_NOTIFYCAP', '新規リンクが掲載された場合に通知する');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_NOTIFYDSC', '新規リンクが掲載された場合に通知する');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE}: 新規リンクが掲載されました');

define('_MI_WEBLINKS_CATEGORY_LINKSUBMIT_NOTIFY', '[管理者] 新規リンク投稿（特定カテゴリ） (承認待ち) ');
define('_MI_WEBLINKS_CATEGORY_LINKSUBMIT_NOTIFYCAP', '[管理者] このカテゴリにおいて新規リンク (承認待ち) が投稿された場合に通知する');
define('_MI_WEBLINKS_CATEGORY_LINKSUBMIT_NOTIFYDSC', 'このカテゴリにおいて新規リンク (承認待ち) が投稿された場合に通知する');
define('_MI_WEBLINKS_CATEGORY_LINKSUBMIT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE}: 新規リンク (承認待ち) の投稿がありました');

define('_MI_WEBLINKS_CATEGORY_NEWLINK_NOTIFY', '新規リンク掲載（特定カテゴリ）');
define('_MI_WEBLINKS_CATEGORY_NEWLINK_NOTIFYCAP', 'このカテゴリにおいて新規リンクが掲載された場合に通知する');
define('_MI_WEBLINKS_CATEGORY_NEWLINK_NOTIFYDSC', 'このカテゴリにおいて新規リンクが掲載された場合に通知する');
define('_MI_WEBLINKS_CATEGORY_NEWLINK_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE}: 新規リンクが掲載されました');

//define('_MI_WEBLINKS_LINK_APPROVE_NOTIFY', 'リンク承認');
//define('_MI_WEBLINKS_LINK_APPROVE_NOTIFYCAP', 'このリンクが承認された場合に通知する');
//define('_MI_WEBLINKS_LINK_APPROVE_NOTIFYDSC', 'このリンクが承認された場合に通知する');
//define('_MI_WEBLINKS_LINK_APPROVE_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE}: リンクが承認されました');


//---------------------------------------------------------
// weblinks
//---------------------------------------------------------
// === Names of blocks for this module ===
define("_MI_WEBLINKS_BNAME4","リンク集のカテゴリ一覧");
define("_MI_WEBLINKS_BNAME5","リンク集の新着RSS/ATOM記事");
define("_MI_WEBLINKS_BNAME6","リンク集のblog表示");

//-------------------------------------
// Title of config items
//-------------------------------------
define('_MI_WEBLINKS_LOGOSHOW','モジュールのロゴ画像を表示する');
define('_MI_WEBLINKS_LOGOSHOWDSC', 'モジュールのロゴ画像を表示のときは、「はい」を選択してください。');

define('_MI_WEBLINKS_TITLESHOW','モジュールのタイトル名を表示する');
define('_MI_WEBLINKS_TITLESHOWDSC', 'モジュールのタイトル名を表示のときは、「はい」を選択してください。');

define('_MI_WEBLINKS_NEWDAYS','「新着リンク」になるための日数');
define('_MI_WEBLINKS_NEWDAYS_DSC', '「NEW」アイコンが表示されるための日数を指定してください。<br />0 を指定すると、アイコンは表示されない。');

define('_MI_WEBLINKS_DESCSHORT', 'リンク情報の説明の最大文字数');
define('_MI_WEBLINKS_DESCSHORTDSC', 'リンク一覧表示で説明を表示する最大文字数を指定してください。');

define('_MI_WEBLINKS_ORDERBY', 'リンク情報のソート順のデフォルト値');
define('_MI_WEBLINKS_ORDERBYDSC', 'リンク詳細表示でデフォルトとなるソート順を指定してください。');
define("_MI_WEBLINKS_ORDERBY0","タイトル (A to Z)");
define("_MI_WEBLINKS_ORDERBY1","タイトル (Z to A)");
define("_MI_WEBLINKS_ORDERBY2","日付 (登録日の古い順)");
define("_MI_WEBLINKS_ORDERBY3","日付 (登録日の新しい順)");
define("_MI_WEBLINKS_ORDERBY4","評価 (評価の低い順)");
define("_MI_WEBLINKS_ORDERBY5","評価 (評価の高い順)");
define("_MI_WEBLINKS_ORDERBY6","人気 (ヒット数の少ない順)");
define("_MI_WEBLINKS_ORDERBY7","人気 (ヒット数の多い順)");

define('_MI_WEBLINKS_SEARCH_LINKS','検索結果の１ページ毎に表示する件数');
define('_MI_WEBLINKS_SEARCH_LINKSDSC', '検索結果表示で１ページあたりに表示する最大件数を指定してください。');

define('_MI_WEBLINKS_SEARCH_MIN', '検索のキーワード最低文字数');
define('_MI_WEBLINKS_SEARCH_MINDSC', '検索を行う際に必要なキーワードの最低文字数を指定してください。');

define('_MI_WEBLINKS_USEFRAMES','フレームを使用する');
define('_MI_WEBLINKS_USEFRAMEDSC', 'リンクページをフレーム内に表示するかどうか');

define('_MI_WEBLINKS_BROKEN','表示を止める「リンク切れ」回数');
define('_MI_WEBLINKS_BROKENDSC', 'リンクの表示を止めるための「リンク切れ」回数を指定してください。<br />この数値以下であれば、一時的な障害と見なし、何もしません。<br />この数値以上になれば、固定的な障害と見なし、リンクの表示を止めます');

define('_MI_WEBLINKS_LISTIMAGE_USE','リンク一覧表示にリンク画像を使用する');
define('_MI_WEBLINKS_LISTIMAGE_WIDTH','リンク一覧表示の画像幅の最大値');
define('_MI_WEBLINKS_LISTIMAGE_HEIGHT','リンク一覧表示の画像高の最大値');
define('_MI_WEBLINKS_LISTIMAGE_USEDSC', 'リンク一覧表示のときに、リンク画像を表示する場合は「はい」を選択してください。');

define('_MI_WEBLINKS_LINKIMAGE_USE','リンク詳細表示にリンク画像を使用する');
define('_MI_WEBLINKS_LINKIMAGE_WIDTH','リンク詳細表示の画像幅の最大値');
define('_MI_WEBLINKS_LINKIMAGE_HEIGHT','リンク詳細表示の画像高の最大値');
define('_MI_WEBLINKS_LINKIMAGE_USEDSC', 'リンク詳細表示のときに、リンク画像を表示する場合は「はい」を選択してください。');

// 2005-10-20 K.OHWADA
define('_MI_WEBLINKS_TOPTEN_STYLE','「人気リンク」のスタイル');
define('_MI_WEBLINKS_TOPTEN_STYLE_DSC', '「人気リンク」と「高評価リンク」を表示するスタイルを指定してください。');
define('_MI_WEBLINKS_TOPTEN_STYLE_0','トップ・カテゴリ毎に');
define('_MI_WEBLINKS_TOPTEN_STYLE_1','全てのカテゴリを一緒に');

define('_MI_WEBLINKS_TOPTEN_LINKS','「人気リンク」を表示するリンク数');
define('_MI_WEBLINKS_TOPTEN_LINKS_DSC', '「人気リンク」と「高評価リンク」を表示する最大のリンク件数を指定してください。');

define('_MI_WEBLINKS_TOPTEN_CATS','「人気リンク」を表示するカテゴリ数');
define('_MI_WEBLINKS_TOPTEN_CATS_DSC', '「人気リンク」と「高評価リンク」を表示する最大のカテゴリ数を指定してください。<br />カテゴリ数が多すぎるとタイムアウトします');

// 2006-03-26
// REQ 3807: Description in main page
//define('_MI_WEBLINKS_INDEX_DESC','メインページの説明');
//define('_MI_WEBLINKS_INDEX_DESC_DSC', 'メインページに表示するときは、説明文を指定してください。');
//define('_MI_WEBLINKS_INDEX_DESC_DEFAULT', '<div align="center"><font color="blue">ここには説明文を表示します。<br />説明文は「モジュールの設定１」にて編集できます。</font><br /></div>');

// 2006-05-15
define('_MI_WEBLINKS_ADMENU0', '目次');

// 2006-11-03
// random block
define('_MI_WEBLINKS_BNAME_RANDOM',  'ランダム・リンク');
define('_MI_WEBLINKS_BNAME_GENERIC', '汎用リンク表示');

// 2007-04-08
define('_MI_WEBLINKS_BNAME_RANDOM_PHOTO', 'ランダム写真');

// 2007-09-01
// notification: new_link_admin
define('_MI_WEBLINKS_GLOBAL_NEWLINK_ADMIN', '[管理者] 新規リンク掲載 (管理者宛コメントも表示)');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_ADMIN_CAP', '[管理者] 新規リンクが掲載された場合に通知する (管理者宛コメントも表示)');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_ADMIN_DSC', '新規リンクが掲載された場合に通知する (管理者宛コメントも表示)');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_ADMIN_SBJ', '[{X_SITENAME}] {X_MODULE}: 新規リンクが掲載されました');

// notification: new_link_comment
define('_MI_WEBLINKS_GLOBAL_NEWLINK_COMMENT', '[管理者] 新規リンク掲載 (管理者宛コメントの記載あり)');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_COMMENT_CAP', '[管理者] 新規リンクが掲載された場合に通知する (管理者宛コメントの記載あり)');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_COMMENT_DSC', '新規リンクが掲載された場合に通知する (管理者宛コメントの記載あり)');
define('_MI_WEBLINKS_GLOBAL_NEWLINK_COMMENT_SBJ', '[{X_SITENAME}] {X_MODULE}: 新規リンクが掲載されました');

}
// --- define language begin ---

?>