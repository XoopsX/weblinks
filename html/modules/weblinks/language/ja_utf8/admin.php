<?php
// $Id: admin.php,v 1.2 2012/04/09 10:20:05 ohwada Exp $

// 2008-02-17 K.OHWADA
// htmlout

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

// 2006-10-25 K.OHWADA
// 誤字訂正

// 2006-10-05 K.OHWADA
// _AM_WEBLINKS_MODULE_CONFIG_3
// google map

// weblinks ver 1.1
// _AM_WEBLINKS_INDEX_DESC, etc

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication

//=========================================================
// WebLinks Module
// language for admin
// 2004-10-24 K.OHWADA
// Japanese UTF-8
//=========================================================

// --- define language begin ---
if( !defined('WEBLINKS_LANG_AM_LOADED') ) 
{

define('WEBLINKS_LANG_AM_LOADED', 1);

define("_WEBLINKS_ADMIN_INDEX","管理者目次");

// BUG 2931: unmatch popup menu 'prefrence' and index menu 'module setting'
define("_WEBLINKS_ADMIN_MODULE_CONFIG_1","モジュールの設定１<br />(一般設定) ");

define("_WEBLINKS_ADMIN_MODULE_CONFIG_2","モジュールの設定２");
//define("_WEBLINKS_ADMIN_ADDMODDEL_CATEGORY","カテゴリの追加／修正／削除");
define("_WEBLINKS_ADMIN_ADD_LINK","新規リンクの追加");
define("_WEBLINKS_ADMIN_OTHERFUNC","その他の機能");
define("_WEBLINKS_ADMIN_GOTO_ADMIN_INDEX","管理者目次へ");

//======	config.php 	======
// アクセス権限
define('_WEBLINKS_ADMIN_AUTH','アクセス権限の設定');
define('_WEBLINKS_ADMIN_AUTH_TEXT', 'サイト管理者は全ての管理権限を持っている');
define('_WEBLINKS_AUTH_SUBMIT','新規リンク登録の権限');
define('_WEBLINKS_AUTH_SUBMIT_DSC','新規リンクを登録する権限を与えられるグループを指定する');
define('_WEBLINKS_AUTH_SUBMIT_AUTO','新規リンク登録の自動承認の権限');
define('_WEBLINKS_AUTH_SUBMIT_AUTO_DSC','新規リンクを登録したときに自動承認される権限を与えられるグループを指定する');
define('_WEBLINKS_AUTH_MODIFY','リンク編集の権限');
define('_WEBLINKS_AUTH_MODIFY_DSC','リンクを編集する権限を与えられるグループを指定する');
define('_WEBLINKS_AUTH_MODIFY_AUTO','リンク編集の自動承認の権限');
define('_WEBLINKS_AUTH_MODIFY_AUTO_DSC','リンクを編集したときに自動承認される権限を与えられるグループを指定する');
define('_WEBLINKS_AUTH_RATELINK','サイト評価の権限');
define('_WEBLINKS_AUTH_RATELINK_DSC','サイトを評価する権限を与えられるグループを指定する<br />「サイト評価を使用する」が「はい」の場合に有効です。');
define('_WEBLINKS_USE_PASSWD','リンク編集時のパスワード認証');
define('_WEBLINKS_USE_PASSWD_DSC','「はい」を選択すると、<br />リンク編集時に自動承認の権限が与えられていない場合は、<br />パスワード認証画面が表示されます。');
define('_WEBLINKS_USE_RATELINK','サイト評価を使用する');
define('_WEBLINKS_USE_RATELINK_DSC','「はい」を選択すると、<br />「このサイトを評価する」と「評価」結果を表示します。');
define('_WEBLINKS_AUTH_UPDATED', 'アクセス権限を更新した');

// RSS/ATOM
define('_WEBLINKS_ADMIN_RSS','RSS/ATOMの設定');
//define('_WEBLINKS_RSS_POST','RSS/ATOMのURLの投稿を許可する');
//define('_WEBLINKS_RSS_POST_DSC','「はい」を選択すると、RSS/ATOMのURLの投稿欄を表示します。');
define('_WEBLINKS_RSS_MODE_AUTO','RSS/ATOM記事の自動更新');
define('_WEBLINKS_RSS_MODE_AUTO_DSC', '「はい」を選択すると、詳細表示のときにRSS/ATOMのURLの自動検出と記事の自動更新を実行します。');
define('_WEBLINKS_RSS_MODE_DATA','表示するRSS/ATOMのデータ');
define('_WEBLINKS_RSS_MODE_DATA_DSC', '「ATOM FEED」を選択すると、atomfeedテーブルにある構文解析後のデータを使用します。<br />「XML」を選択すると、linkテーブルにある構文解析前のXMLデータを使用します。<br />atomfeedテーブルは、フィルタ処理が入っているので、全てのデータが保存されていないことがあります。');
define('_WEBLINKS_RSS_CACHE','RSS/ATOMのキャッシュ時間');
define('_WEBLINKS_RSS_CACHE_DSC', '設定値は１時間単位です。');
define('_WEBLINKS_RSS_LIMIT','RSS/ATOM記事の最大の件数');
define('_WEBLINKS_RSS_LIMIT_DSC', 'atomfeed テーブルに格納するRSS/ATOM記事の最大の件数を指定する<br />この値を超えると日付の古い方からクリアされる。<br />0 は制限なし。');
define('_WEBLINKS_RSS_SITE','RSS検索サイト');
define('_WEBLINKS_RSS_SITE_DSC','RSS検索サイトのRSSのURLの一覧を指定する。<br />複数指定するときは改行で区切る。<br />ATOMのURLは指定できない。');
define('_WEBLINKS_RSS_BLACK','RSS/ATOMのブラックリスト');
define('_WEBLINKS_RSS_BLACK_DSC','RSS/ATOMから記事を収集するときに拒否するURLの一覧を指定する。<br />複数指定するときは改行で区切る。<br />perl形式の正規表現が使用できる');
define('_WEBLINKS_RSS_WHITE','RSS/ATOMのホワイトリスト');
define('_WEBLINKS_RSS_WHITE_DSC','ブラックリストに一致した場合でも登録するURLの一覧を指定する。<br />複数指定するときは改行で区切る。<br />perl形式の正規表現が使用できる');
define('_WEBLINKS_RSS_URL_CHECK', 'リンク情報のURLに、ブラックリストと一致するものがあります。');
define('_WEBLINKS_RSS_URL_CHECK_DSC', '必要であれば、下段のホワイトリストの内容を、登録フォームにコピー＆ペーストしてください。');
define('_WEBLINKS_RSS_UPDATED', 'RSS/ATOMの設定を更新した');


// RSS/ATOM view
define('_WEBLINKS_ADMIN_RSS_VIEW','RSS/ATOMの表示の設定');
define('_WEBLINKS_RSS_MODE_TITLE','タイトルのHTMLタグの表示');
define('_WEBLINKS_RSS_MODE_TITLE_DSC', '「はい」を選択すると、HTMLタグがあるときは、そのまま表示する。<br />「いいえ」を選択すると、HTMLタグを削除して表示する。');
define('_WEBLINKS_RSS_MODE_CONTENT','本文のHTMLタグの表示');
define('_WEBLINKS_RSS_MODE_CONTENT_DSC', '「はい」を選択すると、HTMLタグがあるときは、そのまま表示する。<br />「いいえ」を選択すると、HTMLタグを削除して表示する。');
define('_WEBLINKS_RSS_NEW','「新着RSS/ATOM記事」を表示する件数
');
define('_WEBLINKS_RSS_NEW_DSC', 'トップページに「新着RSS/ATOM記事」を表示する最大件数を指定してください。。');
define('_WEBLINKS_RSS_PERPAGE','RSS/ATOM記事を１ページ毎に表示する件数
');
define('_WEBLINKS_RSS_PERPAGE_DSC', 'リンク詳細ページとRSS/ATOM記事ページで１ページあたりに表示する最大件数を指定してください。');
define('_WEBLINKS_RSS_NUM_CONTENT','RSS/ATOM記事に本文を表示する件数');
define('_WEBLINKS_RSS_NUM_CONTENT_DSC', 'リンク詳細ページにRSS/ATOM記事の本文を表示する記事数を指定してください。<br />その件数以上の記事には要約を表示する。');
define('_WEBLINKS_RSS_MAX_CONTENT','RSS/ATOM記事の最大文字数');
define('_WEBLINKS_RSS_MAX_CONTENT_DSC', 'RSS/ATOM記事のページでRSS/ATOM記事を表示する最大文字数を指定してください。<br />「本文のHTMLタグの表示」が「いいえ」のときに有効です。');
define('_WEBLINKS_RSS_MAX_SUMMARY','RSS/ATOM記事の要約の最大文字数');
define('_WEBLINKS_RSS_MAX_SUMMARY_DSC', 'トップページでRSS/ATOM記事の要約を表示する最大文字数を指定してください。');


// use link field
define('_WEBLINKS_ADMIN_POST','リンク登録項目の設定');
define('_WEBLINKS_ADMIN_POST_TEXT_1', '「未使用」を選択すると、ユーザー投稿欄に表示しません。');
define('_WEBLINKS_ADMIN_POST_TEXT_2', '「使用」を選択すると、ユーザー投稿欄に表示します。');
define('_WEBLINKS_ADMIN_POST_TEXT_3', '「必須」を選択すると、ユーザー投稿欄に表示し、必須項目となります。');
define('_WEBLINKS_NO_USE','未使用');
define('_WEBLINKS_USE','使用');
define('_WEBLINKS_INDISPENSABLE','必須');
define('_WEBLINKS_TYPE_DESC','登録フォームの説明欄の形式');
define('_WEBLINKS_TYPE_DESC_DSC', '「いいえ」を選択すると、通常のテキストボックスが使用します。<br />「はい」を選択すると、XOOPSのDHTML形式を使用します。');
define('_WEBLINKS_CHECK_DOUBLE','同じリンク先の登録をチェックする');
define('_WEBLINKS_CHECK_DOUBLE_DSC', '「いいえ」を選択すると、同じリンク先が登録できます。<br />「はい」を選択すると、同じリンク先が登録されていないかチェックします。');
define('_WEBLINKS_POST_UPDATED', 'リンク登録項目の設定を更新した');

// cateogry
define('_WEBLINKS_ADMIN_CAT_SET','カテゴリの設定');
define('_WEBLINKS_CAT_SEL', '選択できるカテゴリの最大数');
define('_WEBLINKS_CAT_SEL_DSC', '１つのリンクが選択できるカテゴリの最大数を指定してください。');
define('_WEBLINKS_CAT_SUB','サブカテゴリの最大表示数');

//define('_WEBLINKS_CAT_SUB_DSC','トップページのカテゴリ一覧表示において、サブカテゴリの最大表示数を指定してください。');
define('_WEBLINKS_CAT_SUB_DSC','カテゴリページにおいて、２つ下のカテゴリ (サブカテゴリ) を表示するときの、最大表示数を指定する<br /><b>0</b> は表示しない<br /><b>-1</b> は制限なし');

define('_WEBLINKS_CAT_IMG_MODE','カテゴリ表示のカテゴリ画像の指定');
define('_WEBLINKS_CAT_IMG_MODE_DSC', '「なし」のときは、画像を表示しない。<br />「folder.gif」のときは、folder.gif を表示する。<br />「設定した画像」のときは、カテゴリ毎に設定された画像を表示する。');
//define("_WEBLINKS_CAT_IMG_MODE_0","なし");
define("_WEBLINKS_CAT_IMG_MODE_1","folder.gif");
define("_WEBLINKS_CAT_IMG_MODE_2","設定した画像");
define('_WEBLINKS_CAT_IMG_WIDTH','カテゴリ表示の画像幅の最大値');
define('_WEBLINKS_CAT_IMG_HEIGHT','カテゴリ表示の画像高の最大値');
define('_WEBLINKS_CAT_IMG_SIZE_DSC','「設定した画像」のときに有効。');
define('_WEBLINKS_CAT_UPDATED', 'カテゴリの設定を更新した');


//======	cateogry_list.php 	======
define("_WEBLINKS_ADMIN_CATEGORY_MANAGE","カテゴリ管理");
define("_WEBLINKS_ADMIN_CATEGORY_LIST","カテゴリ一覧");
//define("_WEBLINKS_ORDER_ID","ID 順");
define("_WEBLINKS_ORDER_TREE","ツリー順");
define("_WEBLINKS_CAT_ORDER","カテゴリの並び順");
define("_WEBLINKS_THERE_ARE_CATEGORY","現在データベースには <b>%s</b> 件のカテゴリが登録されています。");
define("_WEBLINKS_ADMIN_CATEGORY_NOTICE_1","<b>カテゴリID</b> をクリックすると、カテゴリ修正のページが開きます。");
define("_WEBLINKS_ADMIN_CATEGORY_NOTICE_2","<b>親カテゴリ</b> あるいは <b>タイトル</b> をクリックすると、そのカテゴリの並び順が開きます。");
define("_WEBLINKS_NO_CATEGORY","該当するカテゴリはありません");
define("_WEBLINKS_NUM_SUBCAT","サブカテゴリ数");
define('_WEBLINKS_ORDERS_UPDATED', 'カテゴリの並び順を更新した');

//======	cateogry_manage.php 	======
define("_WEBLINKS_IMGURL_MAIN","カテゴリ画像URL");
define("_WEBLINKS_IMGURL_MAIN_DSC1","オプションです。<br />画像ファイルの大きさは自動的に調整されます。");
//define("_WEBLINKS_IMGURL_MAIN_DSC2","メイン・カテゴリで有効です。");

//======	link_list.php 	======
define("_WEBLINKS_ADMIN_LINK_MANAGE","リンク管理");
define("_WEBLINKS_ADMIN_LINK_LIST","リンク一覧");
define("_WEBLINKS_ADMIN_LINK_BROKEN","リンク切れの一覧表示");
define("_WEBLINKS_ADMIN_LINK_ALL_ASC","全てのリンクの一覧表示（ID 順）");
define("_WEBLINKS_ADMIN_LINK_ALL_DESC","全てのリンクの一覧表示（ID 逆順）");
define("_WEBLINKS_ADMIN_LINK_NOURL","URLが設定されていないリンクの一覧表示");
define("_WEBLINKS_COUNT_BROKEN","リンク切れ回数");
define("_WEBLINKS_NO_LINK","該当するリンク情報はありません");
define("_WEBLINKS_ADMIN_PRESENT_SAVE","ここに表示されているのは、現在保存されているデータです。");

//======	link_manage.php 	======
//define("_WEBLINKS_USERID","ユーザ ID");
//define("_WEBLINKS_CREATE","登録日");

//======	link_broken_check.php 	======
define("_WEBLINKS_ADMIN_LINK_CHECK_UPDATE","リンクの検査と更新");
define("_WEBLINKS_ADMIN_LINK_BROKEN_CHECK","リンク切れの検査");
define("_WEBLINKS_ADMIN_BROKEN_CHECK","検査");
define("_WEBLINKS_ADMIN_BROKEN_RESULT","検査結果");
define("_WEBLINKS_ADMIN_LINK_BROKEN_CHECK_CAUTION","リンク数が多いと、タイムアウトすることがあります。<br />そのときは、limit と offset の数値を変更してください。<br />limit=0 は制限なしです。<br />");
define("_WEBLINKS_ADMIN_LINK_BROKEN_CHECK_NOTICE","<b>リンクID</b> をクリックすると、リンク修正のページが開きます。<br /><b>ウェブサイトURL</b> をクリックすると、該当するURLが開きます。<br />");
define("_WEBLINKS_ADMIN_LINK_BROKEN_CHECK_GOOGLE","<b>ウェブサイト名</b> をクリックすると、google検索が開きます。<br />");
define("_WEBLINKS_ADMIN_LIMIT","リンク数の上限(limit)");
define("_WEBLINKS_ADMIN_OFFSET","オフセット(offset)");
define("_WEBLINKS_ADMIN_TIME_START","開始時刻");
define("_WEBLINKS_ADMIN_TIME_END","終了時刻");
define("_WEBLINKS_ADMIN_TIME_ELAPSE","経過時間");
define("_WEBLINKS_ADMIN_LINK_NUM_ALL","全リンク数");
define("_WEBLINKS_ADMIN_LINK_NUM_CHECK","検査したリンク数");
define("_WEBLINKS_ADMIN_LINK_NUM_BROKEN","リンク切れのリンク数");
define("_WEBLINKS_ADMIN_NUM","件");
define("_WEBLINKS_ADMIN_MIN_SEC","%s 分 %s 秒");
define("_WEBLINKS_ADMIN_CHECK_NEXT","次の %s 件を検査する");
//define("_WEBLINKS_ADMIN_RSS_REFRESH_NOTE","同時にRSS/ATOMの自動検出を行います");

//======	rss_manage.php 	======
define("_WEBLINKS_ADMIN_RSS_MANAGE","RSS/ATOM管理");
define("_WEBLINKS_ADMIN_RSS_REFRESH","RSS/ATOMのキャッシュ更新");
define("_WEBLINKS_ADMIN_RSS_REFRESH_LINK","リンク情報のキャッシュ更新");
define("_WEBLINKS_ADMIN_RSS_REFRESH_SITE","RSS検索サイトのキャッシュ更新");
define("_WEBLINKS_ADMIN_NUM_REFRESH_RSS_URL","更新したRSS/ATOMのURL数");
define("_WEBLINKS_ADMIN_NUM_REFRESH_RSS_SITE","更新したRSS/ATOMのサイト数");
define("_WEBLINKS_ADMIN_NUM_REFRESH_ATOM_SITE","更新したATOM FEEDのサイト数");
define("_WEBLINKS_ADMIN_NUM_REFRESH_ATOMFEED","更新したATOM FEEDの記事数");
define("_WEBLINKS_ADMIN_RSS_CACHE_CLEAR","RSS/ATOMのキャッシュ・クリア");
define("_WEBLINKS_RSS_CLEAR_NUM","指定した件数以上ならば、日付の古い順にクリアする");
define("_WEBLINKS_RSS_NUMBER","件数");
define("_WEBLINKS_RSS_CLEAR_LID","リンクIDを指定してクリアする");
define("_WEBLINKS_RSS_CLEAR_ALL","全てクリアする");
define("_WEBLINKS_NUM_RSS_CLEAR_LINK","クリアしたRSS/ATOMのキャッシュ");
define("_WEBLINKS_NUM_RSS_CLEAR_ATOMFEED","クリアしたRSS/ATOM記事の数");

//======	user_list.php 	======
define("_WEBLINKS_ADMIN_USER_MANAGE", "ユーザ管理");
define("_WEBLINKS_ADMIN_USER_EMAIL", "Ｅメールアドレスを持つユーザの一覧");
define("_WEBLINKS_ADMIN_USER_LINK", "リンク情報を登録している登録ユーザの一覧");
define("_WEBLINKS_ADMIN_USER_NOLINK", "リンク情報を登録していない登録ユーザの一覧");
define("_WEBLINKS_ADMIN_USER_EMAIL_DSC", "重複しているＥメールアドレスは１つだけ表示されます");
//define("_WEBLINKS_ADMIN_USER_LINK_DSC", "XOOPSコアの「メッセージの送信」を使用します");
//define("_WEBLINKS_USER_ALL", "（全て）");
//define("_WEBLINKS_USER_MAX", "（ %s 人毎）");
define("_WEBLINKS_THERE_ARE_USER", "<b>%s</b> 人のユーザが見つかりました");
define("_WEBLINKS_USER_NUM", "%s 人目から %s 人目までを表示します");
define("_WEBLINKS_USER_NOFOUND", "条件に合うユーザが見つかりませんでした");
define("_WEBLINKS_UID_EMAIL", "投稿者のＥメールアドレス");

//======	mail_users.php 	======
define("_WEBLINKS_ADMIN_SENDMAIL", "Ｅメールの送信");
define("_WEBLINKS_THERE_ARE_EMAIL","<b>%s</b> 人宛のＥメールがあります");
define("_WEBLINKS_SEND_NUM", "%s 人目から %s 人目までを送信します");
//define("_WEBLINKS_SEND_NEXT","次の %s 件を送信する");
//define("_WEBLINKS_SUBJECT_FROM", "%s からのお知らせ");
//define("_WEBLINKS_HELLO", "%s さん こんにちは");
define("_WEBLINKS_MAIL_TAGS1","{W_NAME} はユーザ名を表示します");
define("_WEBLINKS_MAIL_TAGS2","{W_EMAIL} はユーザのメールアドレスを表示します");
define("_WEBLINKS_MAIL_TAGS3","{W_LID} はリンクIDを表示します");

// general
//define('_WEBLINKS_WEBMASTER', 'WEB管理者');
define('_WEBLINKS_SUBMITTER', '投稿者');
//define("_WEBLINKS_MID","修正 ID");
define("_WEBLINKS_UPDATE","更新");
define("_WEBLINKS_SET_DEFAULT","デフォルト値を設定する");
define("_WEBLINKS_CLEAR","クリア");
define("_WEBLINKS_CHECK","検査");
define("_WEBLINKS_NON","何もしない");
//define("_WEBLINKS_SENDMAIL", "Ｅメールを送信する");

// 2005-08-09
// BUG 2827: RSS refresh: Invalid argument supplied for foreach()
define("_WEBLINKS_ADMIN_NO_LINK_BROKEN_CHECK","検査するリンクがない");
define("_WEBLINKS_ADMIN_NO_RSS_REFRESH","更新するリンクがない");

// 2005-10-20
define("_WEBLINKS_LINK_APPROVED", "[{X_SITENAME}] {X_MODULE}: リンク登録依頼が承認されました");
define("_WEBLINKS_LINK_REFUSED",  "[{X_SITENAME}] {X_MODULE}: リンク登録依頼が拒否されました");

// 2006-05-15
define('_AM_WEBLINKS_INDEX_DESC','メインページの説明');
define('_AM_WEBLINKS_INDEX_DESC_DSC', 'メインページに表示するときは、説明文を指定してください。');
define('_AM_WEBLINKS_INDEX_DESC_DEFAULT', '<div align="center" style="color: #0000ff">ここには説明文を表示します。<br />説明文は「モジュールの設定２」にて編集できます。<br /></div>');

// category
define('_AM_WEBLINKS_ADD_CATEGORY', '新規カテゴリの追加');
define('_AM_WEBLINKS_ERROR_SOME', 'いくつかエラー・メッセージがあります');
define('_AM_WEBLINKS_LIST_ID_ASC',  'ID 正順');
define('_AM_WEBLINKS_LIST_ID_DESC', 'ID 逆順');

// config
//define('_AM_WEBLINKS_WARNING_NOT_WRITABLE','デイレクトリの書込み許可がない');

define('_AM_WEBLINKS_CONF_LINK','リンク情報の設定');
define('_AM_WEBLINKS_CONF_LINK_IMAGE','リンク画像の設定');
define('_AM_WEBLINKS_CONF_VIEW','表示の設定');
define('_AM_WEBLINKS_CONF_TOPTEN','トップ10の設定');
define('_AM_WEBLINKS_CONF_SEARCH','検索の設定');
define('_AM_WEBLINKS_USE_BROKENLINK','「リンク切れ報告」の使用');
define('_AM_WEBLINKS_USE_BROKENLINK_DSC','「はい」を選択すると、<br />「リンク切れ報告」が使用できます');
define('_AM_WEBLINKS_USE_HITS','ジャンプの "ヒット数" の使用');
define('_AM_WEBLINKS_USE_HITS_DSC','「はい」を選択すると、<br />登録されたサイトにジャンプするときに、"ヒット数" がカウントアップされます');
define('_AM_WEBLINKS_USE_PASSWD','パスワードの権限');
define('_AM_WEBLINKS_USE_PASSWD_DSC','「はい」を選択すると、<br /><b>ゲスト</b> はパスワード認証によりリンクの変更ができます。<br />「いいえ」を選択すると、<br />パスワード欄は表示されない。');
define('_AM_WEBLINKS_PASSWD_MIN','パスワードの最小の文字数');
define('_AM_WEBLINKS_POST_TEXT', 'サイト管理者は全ての管理権限を持っている');
define('_AM_WEBLINKS_AUTH_DOHTML', 'HTMLタグの権限');
define('_AM_WEBLINKS_AUTH_DOHTML_DSC', 'HTMLタグを使用する権限を与えられるグループを指定する');
define('_AM_WEBLINKS_AUTH_DOSMILEY', 'スマイリーアイコンの権限');
define('_AM_WEBLINKS_AUTH_DOSMILEY_DSC', 'スマイリーアイコンを使用する権限を与えられるグループを指定する');
define('_AM_WEBLINKS_AUTH_DOXCODE', 'XOOPSコードの権限');
define('_AM_WEBLINKS_AUTH_DOXCODE_DSC', 'XOOPSコードを使用する権限を与えられるグループを指定する');
define('_AM_WEBLINKS_AUTH_DOIMAGE', '画像の権限');
define('_AM_WEBLINKS_AUTH_DOIMAGE_DSC', '画像を使用する権限を与えられるグループを指定する');
define('_AM_WEBLINKS_AUTH_DOBR', '改行の権限');
define('_AM_WEBLINKS_AUTH_DOBR_DSC', '改行を使用する権限を与えられるグループを指定する');
define('_AM_WEBLINKS_SHOW_CATLIST','サブメニューへのカテゴリ一覧の表示');
define('_AM_WEBLINKS_SHOW_CATLIST_DSC','「はい」を選択すると、<br />サブメニューにカテゴリ一覧を表示する');
define('_AM_WEBLINKS_VIEW_URL','URLの表示形式');
define('_AM_WEBLINKS_VIEW_URL_DSC','「非表示」を選択すると、<br />URL は &lt;a&gt; タグに表示されない。<br />「間接表示」を選択すると、<br />href 属性に URLではなく、visit.php を表示する。<br />「直接表示」を選択すると、<br />href 属性に URL を表示し、onmousedown 属性に JavaScript を表示し、JavaScript を経由してヒット数をカウントする。<br />');
define('_AM_WEBLINKS_VIEW_URL_0','非表示');
define('_AM_WEBLINKS_VIEW_URL_1','間接表示');
define('_AM_WEBLINKS_VIEW_URL_2','直接表示');
define('_AM_WEBLINKS_RECOMMEND_PRI','「おすすめサイト」の優先度');
define('_AM_WEBLINKS_RECOMMEND_PRI_DSC','「非表示」を選択すると、表示されない。<br />「通常」を選択すると、メニュー・バーに表示する。<br />「優先」を選択すると、カテゴリ毎に上位に表示される。');
define('_AM_WEBLINKS_MUTUAL_PRI','「相互リンク」の優先度');
define('_AM_WEBLINKS_MUTUAL_PRI_DSC','「非表示」を選択すると、表示されない。<br />「通常」を選択すると、メニュー・バーに表示する。<br />「優先」を選択すると、カテゴリ毎に上位に表示される。');
define('_AM_WEBLINKS_PRI_0','未使用');
define('_AM_WEBLINKS_PRI_1','通常');
define('_AM_WEBLINKS_PRI_2','優先');
define('_AM_WEBLINKS_LINK_IMAGE_AUTO','バナー・サイズの自動取得');
define('_AM_WEBLINKS_LINK_IMAGE_AUTO_DSC', '「はい」を選択すると、<br />バナー・サイズが登録・変更時に取得できなかった場合に、リンク一覧やリンク詳細を表示するときに、再度 自動的に取得する。<br />');
define('_AM_WEBLINKS_RSS_USE','RSS 記事の使用');
define('_AM_WEBLINKS_RSS_USE_DSC','「はい」を選択すると、<br />RSS/ATOM 記事を取得し表示する');

// bulk import
define('_AM_WEBLINKS_BULK_IMPORT','一括登録');
define('_AM_WEBLINKS_BULK_IMPORT_FILE','ファイルからの一括登録のデモ');
define('_AM_WEBLINKS_BULK_CAT','カテゴリ一括登録');
define('_AM_WEBLINKS_BULK_CAT_DSC1','カテゴリ を記述する');
define('_AM_WEBLINKS_BULK_CAT_DSC2','子カテゴリは、行頭に左矢印括弧(>)を記述する');
define('_AM_WEBLINKS_BULK_LINK','リンク一括登録');
define('_AM_WEBLINKS_BULK_LINK_DSC1','１行目に、カテゴリ を記述する');
define('_AM_WEBLINKS_BULK_LINK_DSC2','２行目以降に、タイトル, URL, 説明 をカンマ(,)で区切って記述する');
define('_AM_WEBLINKS_BULK_LINK_DSC3','横棒 (---) で区切ると、繰返して指定できる');
define('_AM_WEBLINKS_BULK_ERROR_LAYER','カテゴリの階層構造で２段階以上 下を指定しています');
define('_AM_WEBLINKS_BULK_ERROR_CID','カテゴリ番号が正しくない');
define('_AM_WEBLINKS_BULK_ERROR_PID','親のカテゴリ番号が正しくない');
define('_AM_WEBLINKS_BULK_ERROR_FINISH','エラーにより終了した');

// command
//define('_AM_WEBLINKS_CREATE_CONFIG', '設定ファイルの生成');
//define('_AM_WEBLINKS_TEST_EXEC', 'テスト実行 %s');

// === 2006-10-05 ===
// menu
define('_AM_WEBLINKS_MODULE_CONFIG_3','モジュールの設定３');
define('_AM_WEBLINKS_MODULE_CONFIG_4','モジュールの設定４');
define('_AM_WEBLINKS_VOTE_LIST', '投票一覧');
define('_AM_WEBLINKS_CATLINK_LIST', 'CatLink 一覧');
//define('_AM_WEBLINKS_COMMAND_MANAGE', 'コマンド管理');
define('_AM_WEBLINKS_TABLE_MANAGE',  'DBテーブル管理');
define('_AM_WEBLINKS_IMPORT_MANAGE', 'インポート管理');
define('_AM_WEBLINKS_EXPORT_MANAGE', 'エキスポート管理');

// config
define('_AM_WEBLINKS_MODULE_CONFIG_DESC_2','権限、カテゴリ、他');
define('_AM_WEBLINKS_MODULE_CONFIG_DESC_3','リンク');
define('_AM_WEBLINKS_MODULE_CONFIG_DESC_4','RSS、フォーラム，地図');
define('_AM_WEBLINKS_LINK_REGISTER','リンク登録: 説明 (description) の設定');

// bin configuration
//define('_AM_WEBLINKS_FORM_BIN', 'コマンド設定');
//define('_AM_WEBLINKS_FORM_BIN_DESC', 'bin コマンドに使用する');
//define('_AM_WEBLINKS_CONF_BIN_PASS','パスワード');
//define('_AM_WEBLINKS_CONF_BIN_PASS_DESC','');
//define('_AM_WEBLINKS_CONF_BIN_SEND','メールを送信する');
//define('_AM_WEBLINKS_CONF_BIN_SEND_DESC','');
//define('_AM_WEBLINKS_CONF_BIN_MAILTO','メール送信先');
//define('_AM_WEBLINKS_CONF_BIN_MAILTO_DESC','');

// rssc
//define('_AM_WEBLINKS_RSS_DIRNAME','RSSCモジュールのDirname');
//define('_AM_WEBLINKS_RSS_DIRNAME_DESC','');

// link manage
define('_AM_WEBLINKS_DEL_LINK', 'リンク削除');
define('_AM_WEBLINKS_ADD_RSSC', 'RSSCモジュールへのリンク追加');
define('_AM_WEBLINKS_MOD_RSSC', 'RSSCモジュールのリンク変更');
define('_AM_WEBLINKS_REFRESH_RSSC', 'RSSCモジュールのRSS更新');
define('_AM_WEBLINKS_APPROVE',     'リンク追加の承認');
define('_AM_WEBLINKS_APPROVE_MOD', 'リンク変更の承認');
define('_AM_WEBLINKS_RSSC_LID_SAVED', 'RSSC lid を保存した');
define('_AM_WEBLINKS_GOTO_LINK_LIST', 'リンク一覧へ');
define('_AM_WEBLINKS_GOTO_LINK_EDIT', 'リンク変更へ');
define('_AM_WEBLINKS_ADD_BANNER', 'バナーの画像サイズの追加');
define('_AM_WEBLINKS_MOD_BANNER', 'バナーの画像サイズの変更');

// vote list
define('_AM_WEBLINKS_VOTE_USER', '登録ユーザの投票');
define('_AM_WEBLINKS_VOTE_ANON', 'ゲストの投票');

// locate
define('_AM_WEBLINKS_CONF_LOCATE','場所の設定');
define('_AM_WEBLINKS_CONF_COUNTRY_CODE','国コード');
define('_AM_WEBLINKS_CONF_COUNTRY_CODE_DESC', 'ccTLDs を入力する <br/> <a href="http://www.iana.org/cctld/cctld-whois.htm" target="_blank">IANA: Country-Code Top-Level Domains</a>');
define('_AM_WEBLINKS_CONF_RENEW_COUNTRY_CODE_DESC', '国コードに関連する項目を再設定する<br/> <span style="color:#0000ff;">#</span> 印がついている項目');
define('_AM_WEBLINKS_RENEW', '再設定');

// map
define('_AM_WEBLINKS_CONF_MAP','地図サイトの設定');
define('_AM_WEBLINKS_CONF_MAP_USE','地図サイトを使用する');
define('_AM_WEBLINKS_CONF_MAP_TEMPLATE','地図サイトのテンプレート');
define('_AM_WEBLINKS_CONF_MAP_TEMPLATE_DESC','template/map/ ディレクトリにあるテンプレート・ファイルを指定する');

// google map: hacked by wye <http://never-ever.info/>
define('_AM_WEBLINKS_CONF_GOOGLE_MAP','Google Maps の設定');
define('_AM_WEBLINKS_CONF_GM_USE','Google Maps を使用する');
define('_AM_WEBLINKS_CONF_GM_APIKEY','Google Maps API key');
define('_AM_WEBLINKS_CONF_GM_APIKEY_DESC', 'GoogleMapsを利用する場合は <br /> <a href="http://www.google.com/apis/maps/signup.html" target="_blank">http://www.google.com/apis/maps/signup.html</a> で <br /> API key を取得してください' );
define('_AM_WEBLINKS_CONF_GM_SERVER','サーバー名');
define('_AM_WEBLINKS_CONF_GM_LANG',  '言語コード');
define('_AM_WEBLINKS_CONF_GM_LOCATION', '省略時の場所名');
define('_AM_WEBLINKS_CONF_GM_LATITUDE', '省略時の緯度');
define('_AM_WEBLINKS_CONF_GM_LONGITUDE','省略時の経度');
define('_AM_WEBLINKS_CONF_GM_ZOOM',     '省略時のズームレベル');

// google search
define('_AM_WEBLINKS_CONF_GOOGLE_SEARCH','Google 検索の設定');
define('_AM_WEBLINKS_CONF_GOOGLE_SERVER','サーバー名');
define('_AM_WEBLINKS_CONF_GOOGLE_LANG',  '言語コード');

// template
//define('_AM_WEBLINKS_CONF_TEMPLATE','テンプレートのキャッシュ・クリア');
define('_AM_WEBLINKS_CONF_TEMPLATE_DESC','template/parts/ template/xml/ template/map/ ディレクトリにあるテンプレートを変更したときには、実行すること');

// === 2006-12-11 ===
// link item
//define('_AM_WEBLINKS_TIME_PUBLISH','発行日を設定する');
//define('_AM_WEBLINKS_TIME_PUBLISH_DESC','設定しないときは、常に表示される');
//define('_AM_WEBLINKS_TIME_EXPIRE','終了日を設定する');
//define('_AM_WEBLINKS_TIME_EXPIRE_DESC','設定しないときは、常に表示される');
define('_AM_WEBLINKS_LINK_TIME_PUBLISH_BEFORE','発行日以前のリンク一覧');
define('_AM_WEBLINKS_LINK_TIME_EXPIRE_AFTER','終了日以降のリンク一覧');

define('_AM_WEBLINKS_SERVER_ENV','サーバー環境変数');
define('_AM_WEBLINKS_DEBUG_CONF','デバック変数');
define('_AM_WEBLINKS_ALL_GREEN','全て正常');

// === 2007-02-20 ===
// performance
define('_AM_WEBLINKS_UPDATE_CAT_PATH','パス・ツリー情報の更新');
define('_AM_WEBLINKS_UPDATE_CAT_COUNT','カテゴリのリンク数の更新');
define('_AM_WEBLINKS_CAT_COUNT_UPDATED','カテゴリのリンク数を更新した');

// config
define('_AM_WEBLINKS_SYSTEM_POST_LINK','リンク登録時の投稿数');
define('_AM_WEBLINKS_SYSTEM_POST_LINK_DSC','「はい」を選択すると、<br />リンクを登録したときに、XOOPSユーザの投稿数をカウントアップします。');
define('_AM_WEBLINKS_SYSTEM_POST_RATE','評価時の投稿数');
define('_AM_WEBLINKS_SYSTEM_POST_RATE_DSC','「はい」を選択すると、<br />評価をしたときに、XOOPSユーザの投稿数をカウントアップします。');

define('_AM_WEBLINKS_VIEW_STYLE_CAT','カテゴリ・ページの表示形式');
define('_AM_WEBLINKS_VIEW_STYLE_MARK','おすすめサイト・ページの表示形式');
define('_AM_WEBLINKS_VIEW_STYLE_MARK_DSC','おすすめサイト、相互リンクサイト、RSS/ATOM 対応サイト に適用される');
define('_AM_WEBLINKS_VIEW_STYLE_0','概要');
define('_AM_WEBLINKS_VIEW_STYLE_1','詳細');

define('_AM_WEBLINKS_CONF_PERFORMANCE','性能向上');
define('_AM_WEBLINKS_CONF_PERFORMANCE_DSC','性能向上のために、表示するときに必要な情報を事前に計算し、データベースに格納します<br />初めて使用するときは、「カテゴリ一覧」->「パス・ツリー情報の更新」を実行すること');
define('_AM_WEBLINKS_CAT_PATH','カテゴリのパス・ツリー情報');
define('_AM_WEBLINKS_CAT_PATH_DSC','「はい」を選択すると、<br />カテゴリのパス・ツリー情報を事前に計算し、カテゴリ・テーブルに格納します。<br />「いいえ」を選択すると、<br />表示するときに計算します。');
define('_AM_WEBLINKS_CAT_COUNT','カテゴリのリンク数');
define('_AM_WEBLINKS_CAT_COUNT_DSC','「はい」を選択すると、<br />カテゴリ毎のリンク数を事前に計算し、カテゴリ・テーブルに格納します。<br />「いいえ」を選択すると、<br />表示するときに計算します。');

define('_AM_WEBLINKS_POST_TEXT_4', '管理者の投稿画面には全ての項目が表示される');
define('_AM_WEBLINKS_LINK_REGISTER_1', 'リンク登録: textarea1 の設定');

define('_AM_WEBLINKS_CONF_LINK_GUEST','ゲストのリンク登録項目の設定');
define('_AM_WEBLINKS_USE_CAPTCHA','CAPTCHA (画像認証) を使用する');
define('_AM_WEBLINKS_USE_CAPTCHA_DSC','CAPTCHA は画像認証によるスパム対策です。<br />使用するには、Captcha モジュールが必要です。<br />「はい」を選択すると、<br /><b>ゲスト</b> のときはリンクの登録と変更時に CAPTCHA を使用します。<br />「いいえ」を選択すると、<br />CAPTCHA 欄は表示されない。');
define('_AM_WEBLINKS_CAPTCHA_FINDED',     'Captcha モジュール ver %s が見つかりました');
define('_AM_WEBLINKS_CAPTCHA_NOT_FINDED', 'Captcha モジュールは見つかりません');

define('_AM_WEBLINKS_CONF_SUBMIT',   '登録フォームの説明');
define('_AM_WEBLINKS_SUBMIT_MAIN',   '新規登録の説明１');
define('_AM_WEBLINKS_SUBMIT_PENDING','新規登録の説明２');
define('_AM_WEBLINKS_SUBMIT_DOUBLE', '新規登録の説明３');
define('_AM_WEBLINKS_SUBMIT_MAIN_DSC',   '常に表示される');
define('_AM_WEBLINKS_SUBMIT_PENDING_DSC','「管理者が承認する」モードのときに表示される');
define('_AM_WEBLINKS_SUBMIT_DOUBLE_DSC', '「同じリンク先の登録をチェックする」モードのときに表示される');

define('_AM_WEBLINKS_MODLINK_MAIN',     'リンク変更の説明１');
define('_AM_WEBLINKS_MODLINK_PENDING',  'リンク変更の説明２');
define('_AM_WEBLINKS_MODLINK_NOT_OWNER','リンク変更の説明３');
define('_AM_WEBLINKS_MODLINK_NOT_OWNER_DSC','「管理者が承認する」モードで、投稿者でないときに、表示される');

define('_AM_WEBLINKS_CONF_CAT_FORUM', 'カテゴリのフォーラム表示');
define('_AM_WEBLINKS_CONF_LINK_FORUM', 'リンクのフォーラム表示');
//define('_AM_WEBLINKS_FORUM_SEL', 'フォーラム・モジュールの選択');
define('_AM_WEBLINKS_FORUM_THREAD_LIMIT', '表示するスレッド数');
define('_AM_WEBLINKS_FORUM_POST_LIMIT', '表示するスレッド毎の投稿数');
define('_AM_WEBLINKS_FORUM_POST_ORDER', '投稿の並び順');
define('_AM_WEBLINKS_FORUM_POST_ORDER_0', '投稿日の古い順');
define('_AM_WEBLINKS_FORUM_POST_ORDER_1', '投稿日の新しい順');
//define('_AM_WEBLINKS_FORUM_INSTALLED',     'フォーラム・モジュール ( %s ) ver %s はインストールされている');
//define('_AM_WEBLINKS_FORUM_NOT_INSTALLED', 'フォーラム・モジュール ( %s ) はインストールされていない');

// === 2007-03-25 ===
define('_AM_WEBLINKS_UPDATE_CAT_IMAGE_SIZE','カテゴリの画像サイズの更新');

define('_AM_WEBLINKS_CONF_INDEX', 'トップページの設定');
define('_AM_WEBLINKS_CONF_INDEX_GM_MODE', 'Google Map モード');

define('_AM_WEBLINKS_CAT_SHOW_GM',   'Google Map の表示');
define('_AM_WEBLINKS_MODE_NON',       '表示しない');
define('_AM_WEBLINKS_MODE_DEFAULT',   'デフォルトの設定値');
define('_AM_WEBLINKS_MODE_PARENT',    '親カテゴリと同じ');
define('_AM_WEBLINKS_MODE_FOLLOWING', '下記の設定値');

define('_AM_WEBLINKS_CONF_CAT_ALBUM',  'カテゴリのアルバム表示');
define('_AM_WEBLINKS_CONF_LINK_ALBUM', 'リンクのアルバム表示');
//define('_AM_WEBLINKS_ALBUM_SEL', 'アルバム・モジュールの選択');
define('_AM_WEBLINKS_ALBUM_LIMIT', '表示する写真の数');
define('_AM_WEBLINKS_WHEN_OMIT', '省略時の処理');
define('_AM_WEBLINKS_MODULE_INSTALLED',     '%s モジュール ( %s ) ver %s はインストールされている');
define('_AM_WEBLINKS_MODULE_NOT_INSTALLED', '%s モジュール ( %s ) はインストールされていない');

// === 2007-04-08 ===
define('_AM_WEBLINKS_CAT_DESC_MODE',  '説明の表示');
define('_AM_WEBLINKS_CAT_SHOW_FORUM', 'フォーラムの表示');
define('_AM_WEBLINKS_CAT_SHOW_ALBUM', 'アルバムの表示');
define('_AM_WEBLINKS_MODE_SETTING',   '設定した内容');
define('_AM_WEBLINKS_MODE_OMIT_PARENT', '省略時は親カテゴリと同じ');

// === 2007-06-10 ===
// d3forum
define('_AM_WEBLINKS_CONF_D3FORUM', 'd3forum モジュールのコメント統合');
define('_AM_WEBLINKS_PLUGIN_SEL',   'プラグインの選択');
define('_AM_WEBLINKS_DIRNAME_SEL',  'モジュールの選択');
define('_AM_WEBLINKS_D3FORUM_VIEW', 'コメントの表示方法');

// category
define('_AM_WEBLINKS_CAT_PATH_STYLE', 'カテゴリパスの表示形式');

// category page
define('_AM_WEBLINKS_CONF_CAT_PAGE', 'カテゴリぺージの設定');
define('_AM_WEBLINKS_CAT_COLS', 'カテゴリ表示の横の列数');
define('_AM_WEBLINKS_CAT_COLS_DESC', 'カテゴリページにおいて、１つ下のカテゴリを表示するときの、横の列数 (column) を指定する');
define('_AM_WEBLINKS_CAT_SUB_MODE', 'サブカテゴリの表示範囲');
define('_AM_WEBLINKS_CAT_SUB_MODE_1', '１つ下のカテゴリのみ');
define('_AM_WEBLINKS_CAT_SUB_MODE_2', '２つ下以降のカテゴリを含める');

// === 2007-07-14 ===
// highlight
define('_AM_WEBLINKS_USE_HIGHLIGHT', 'キーワード・ハイライトを使用する');
define('_AM_WEBLINKS_CHECK_MAIL', 'メールの形式をチェックする');
define('_AM_WEBLINKS_CHECK_MAIL_DSC', '「はい」を選択すると、登録するメールアドレスが abc@efg.com のような形式であるかチェックします。');
//define('_AM_WEBLINKS_NO_EMAIL', 'メールアドレスが設定されていない');

// === 2007-08-01 ===
// config
define('_AM_WEBLINKS_MODULE_CONFIG_0','モジュールの設定');
define('_AM_WEBLINKS_MODULE_CONFIG_DESC_0','目次');
define('_AM_WEBLINKS_MODULE_CONFIG_5','モジュールの設定５');
define('_AM_WEBLINKS_MODULE_CONFIG_DESC_5','リンク登録項目');
define('_AM_WEBLINKS_MODULE_CONFIG_6','モジュールの設定６');
define('_AM_WEBLINKS_MODULE_CONFIG_DESC_6','Google Map');

// google map
define('_AM_WEBLINKS_GM_MAP_CONT',  'マップ・コントロール');
define('_AM_WEBLINKS_GM_MAP_CONT_DESC',  'GLargeMapControl, GSmallMapControl, GSmallZoomControl');
define('_AM_WEBLINKS_GM_MAP_CONT_NON',   '表示しない');
define('_AM_WEBLINKS_GM_MAP_CONT_LARGE', '大きいコントロール: Large');
define('_AM_WEBLINKS_GM_MAP_CONT_SMALL', '小さいコントロール: Small');
define('_AM_WEBLINKS_GM_MAP_CONT_ZOOM',  'ズーム: Zoom');
define('_AM_WEBLINKS_GM_USE_TYPE_CONT',  '地図形式ボタンを使用する');
define('_AM_WEBLINKS_GM_USE_TYPE_CONT_DESC',  'GMapTypeControl');
define('_AM_WEBLINKS_GM_USE_SCALE_CONT',  '距離表示を使用する');
define('_AM_WEBLINKS_GM_USE_SCALE_CONT_DESC',  'GScaleControl');
define('_AM_WEBLINKS_GM_USE_OVERVIEW_CONT',  '右下の小さい地図を使用する');
define('_AM_WEBLINKS_GM_USE_OVERVIEW_CONT_DESC',  'GOverviewMapControl');
define('_AM_WEBLINKS_GM_MAP_TYPE', '[検索] 地図の形式');
define('_AM_WEBLINKS_GM_MAP_TYPE_DESC', 'GMapType');
define('_AM_WEBLINKS_GM_GEOCODE_KIND',  '[検索] ジオコードの種類');
define('_AM_WEBLINKS_GM_GEOCODE_KIND_DESC',  '住所から緯度・経度を検索する<br /><b>単一の検索</b><br />GClientGeocoder - getLatLng<br /><b>複数の検索</b><br />GClientGeocoder - getLocations');
define('_AM_WEBLINKS_GM_GEOCODE_KIND_LATLNG', '単一の検索: getLatLng');
define('_AM_WEBLINKS_GM_GEOCODE_KIND_LOCATIONS',   '複数の検索: getLocations');
define('_AM_WEBLINKS_GM_USE_GEOCODE_TOKYO',  '[検索][日本] 東京大学 CSIS を使用する');
define('_AM_WEBLINKS_GM_USE_GEOCODE_TOKYO_DESC',  '日本でのみ有効<br />住所から緯度・経度を検索する<br /><a href="http://pc035.tkl.iis.u-tokyo.ac.jp/~sagara/geocode/" target="_blank">東京大学 シンプルジオコーディング実験</a>');
define('_AM_WEBLINKS_GM_USE_NISHIOKA',  '[検索][日本] 逆ジオコードを使用する');
define('_AM_WEBLINKS_GM_USE_NISHIOKA_DESC',  '日本でのみ有効<br />緯度・経度から住所を検索する<br /><a href="http://nishioka.sakura.ne.jp/google/" target="_blank">http://nishioka.sakura.ne.jp/google/</a>');
define('_AM_WEBLINKS_GM_TITLE_LENGTH',  '[Marker] タイトルの文字数');
define('_AM_WEBLINKS_GM_TITLE_LENGTH_DESC',  'マーカーに表示するタイトルの文字数<br /><b>-1</b> は制限なし');
define('_AM_WEBLINKS_GM_DESC_LENGTH',  '[Marker] 本文の文字数');
define('_AM_WEBLINKS_GM_DESC_LENGTH_DESC',  'マーカーに表示する本文の文字数<br /><b>-1</b> は制限なし');
define('_AM_WEBLINKS_GM_WORDWRAP',  '[Marker] 本文の１行の文字数');
define('_AM_WEBLINKS_GM_WORDWRAP_DESC',  'マーカーに表示する本文の１行あたり (wordwrap) の文字数<br /><b>-1</b> は制限なし');
define('_AM_WEBLINKS_GM_USE_CENTER_MARKER',  '[Marker] 中心マーカーを表示する');
define('_AM_WEBLINKS_GM_USE_CENTER_MARKER_DESC',  'トップページとカテゴリぺージにて、中心位置にマーカーを表示する');

// map jp
define('_AM_WEBLINKS_MAP_JP_MANAGE', '日本地図の設定');

// column
define('_AM_WEBLINKS_COLUMN_MANAGE', 'カラム管理');
define('_AM_WEBLINKS_COLUMN_MANAGE_DESC', 'link テーブルと modify テーブルに etc カラムを追加する');
define('_AM_WEBLINKS_COLUMN_MANAGE_NOT_USE', '使用できません');
define('_AM_WEBLINKS_THERE_ARE_COLUMN', 'link テーブルに <b>%s</b> 件の etc カラムがあります');
define('_AM_WEBLINKS_COLUMN_NUM', '追加する etc カラム数');
define('_AM_WEBLINKS_COLUMN_BIGGER_USE', '使用する etc カラム数が link テーブルのカラム数より多い');
define('_AM_WEBLINKS_COLUMN_UNMATCH',  'link テーブルと modify テーブルのカラムが一致しない');
define('_AM_WEBLINKS_PHPMYADMIN',  'phpMyAdmin などの管理ツールで修正してください');
define('_AM_WEBLINKS_LINK_NUM_ETC', '使用する etc カラム数');

// latest
define('_AM_WEBLINKS_INDEX_MODE_LATEST', '新着サイトの並び順');
define('_AM_WEBLINKS_INDEX_MODE_LATEST_UPDATE', '更新日の新しい順');
define('_AM_WEBLINKS_INDEX_MODE_LATEST_CREATE', '登録日の新しい順');

// header
define('_AM_WEBLINKS_CONF_HTML_STYLE', 'HTML 表記に関する設定');
define('_AM_WEBLINKS_HEADER_MODE', 'xoops module header を使用する');
define('_AM_WEBLINKS_HEADER_MODE_DESC', '「いいえ」のときは、スタイルシートと Javascript の指定を body タグ内に表示します<br />「はい」のときは、xoops module header を使用して、header タグ内に表示します<br />テーマによっては使用できないものがあります');

// bulk
define('_AM_WEBLINKS_BULK_SAMPLE','[見本]をクリックすると、見本が見れます');
define('_AM_WEBLINKS_BULK_LINK_DSC10','登録項目は固定');
define('_AM_WEBLINKS_BULK_LINK_DSC20','管理者が登録項目を指定する');
define('_AM_WEBLINKS_BULK_LINK_DSC21','第１段落');
define('_AM_WEBLINKS_BULK_LINK_DSC22','第２段落 以降');
define('_AM_WEBLINKS_BULK_LINK_DSC23','１行目に、登録項目名 を記述する<br />横棒(---)で区切る');
define('_AM_WEBLINKS_BULK_LINK_DSC24','２行目以降に、第１段落で指定した順番に、登録内容をカンマ(,)で区切って記述する');
define('_AM_WEBLINKS_BULK_CHECK_URL','URLが設定されているか検査する');
define('_AM_WEBLINKS_BULK_CHECK_DESCRIPTION','説明文が設定されているか検査する');

// === 2007-09-01 ===
// auth
define('_AM_WEBLINKS_AUTH_DELETE','リンク削除の権限');
define('_AM_WEBLINKS_AUTH_DELETE_DSC','リンクを削除する権限を与えられるグループを指定する');
define('_AM_WEBLINKS_AUTH_DELETE_AUTO','リンク削除の自動承認の権限');
define('_AM_WEBLINKS_AUTH_DELETE_AUTO_DSC','リンクを削除したときに自動承認される権限を与えられるグループを指定する');

// nofitication
define('_AM_WEBLINKS_NOTIFICATION_MANAGE', 'イベント通知の設定');
define('_AM_WEBLINKS_NOTIFICATION_MANAGE_DESC', 'モジュール管理者 別の設定です<br />モジュールのトップページと同じものです');
define('_AM_WEBLINKS_NOTIFICATION_MANAGE_NOT_USE', 'XOOPS のバージョンによっては使用できません');
define('_AM_WEBLINKS_NOTIFICATION_MANAGE_PLEASE', 'その場合は、モジュールのトップページを使用してください');
define('_AM_WEBLINKS_SUBJ_LINK_MOD_APPROVED', '[{X_SITENAME}] {X_MODULE}: リンク修正依頼が承認されました');
define('_AM_WEBLINKS_SUBJ_LINK_MOD_REFUSED',  '[{X_SITENAME}] {X_MODULE}: リンク修正依頼が拒否されました');
define('_AM_WEBLINKS_SUBJ_LINK_DEL_APPROVED', '[{X_SITENAME}] {X_MODULE}: リンク削除依頼が承認されました');
define('_AM_WEBLINKS_SUBJ_LINK_DEL_REFUSED',  '[{X_SITENAME}] {X_MODULE}: リンク削除依頼が拒否されました');

// config
define('_AM_WEBLINKS_ADMIN_WAITING_SHOW', '管理者の承認待ちリストを表示する');
define('_AM_WEBLINKS_USER_WAITING_NUM',  'ユーザの承認待ちリストの件数');
define('_AM_WEBLINKS_USER_OWNER_NUM',   'ユーザの登録リストの件数');
define('_AM_WEBLINKS_USE_HITS_SINGLELINK','リンク詳細の "ヒット数" の使用');
define('_AM_WEBLINKS_USE_HITS_SINGLELINK_DSC','「ジャンプの "ヒット数" の使用」が「はい」のときに有効<br />「はい」を選択すると、<br />リンク詳細 singlelink を表示したときに、ヒット数 がカウントアップされます');
define('_AM_WEBLINKS_MODE_RANDOM', 'ランダムジャンプの飛び先');
define('_AM_WEBLINKS_MODE_RANDOM_URL', '登録されたサイトのURL');
define('_AM_WEBLINKS_MODE_RANDOM_SINGLE', 'モジュール内のsinglelink');

// request list
define('_AM_WEBLINKS_DEL_REQS', '承認待ちの削除リンク');
define('_AM_WEBLINKS_NO_DEL_REQ','リンク削除リクエストはありません');
define('_AM_WEBLINKS_DEL_REQ_DELETED','削除リクエストを削除しました');

// link list
define('_AM_WEBLINKS_LINK_USERCOMMENT_DESC','管理者宛コメントのあるリンク一覧 (ID逆順)');

// clone
define('_AM_WEBLINKS_CLONE_LINK', 'リンクの複製');
define('_AM_WEBLINKS_CLONE_MODULE', '他のモジュールへのリンクの複製');
define('_AM_WEBLINKS_CLONE_CONFIRM', '複製しますか');
define('_AM_WEBLINKS_NO_MODULE', '該当するモジュールがない');

// link form
define('_AM_WEBLINKS_MODIFIED', '変更あり');
define('_AM_WEBLINKS_CHECK_CONFIRM', '確認した');
define('_AM_WEBLINKS_WARN_CONFIRM', '注意: %s の「確認した」にチェックしてください');
define('_AM_WEBLINKS_RSSC_LID_EXIST_MORE', '同じ「RSSC ID」を持つ複数のリンクが見つかりました');

// web shot
define('_AM_WEBLINKS_LINK_IMG_THUMB', 'リンク画像の代替');
define('_AM_WEBLINKS_LINK_IMG_THUMB_DSC', 'リンク画像が設定されていないときに、サムネイル WEB サービスを利用して、
WEBサイトのサムネイルを表示する');
define('_AM_WEBLINKS_LINK_IMG_NON', 'なし');
//define('_AM_WEBLINKS_LINK_IMG_MOZSHOT', '<a href="http://mozshot.nemui.org/" target="_blank">MozShot</a> を利用する');
//define('_AM_WEBLINKS_LINK_IMG_SIMPLEAPI', '<a href="http://img.simpleapi.net/" target="_blank">SimpleAPI</a> を利用する');

// === 2007-11-01 ===
// google map
define('_AM_WEBLINKS_GM_MARKER_WIDTH',  '[Marker] 横幅 (pixel)');
define('_AM_WEBLINKS_GM_MARKER_WIDTH_DESC',  'マーカーの吹出しの横幅<br /><b>-1</b> は指定なし');
define('_AM_WEBLINKS_LINK_IMG_USE', '%s を利用する');

define('_AM_WEBLINKS_RSS_SITE', 'サイトの表示');
define('_AM_WEBLINKS_RSS_FEED', 'RSS記事の表示');

// nameflag mainflag
define('_AM_WEBLINKS_CONF_LINK_USER','ユーザのリンク登録項目の設定');
define('_AM_WEBLINKS_USER_NAMEFLAG','名前表示 nameflag の選択');
define('_AM_WEBLINKS_USER_MAILFLAG','メール表示 mailflag の選択');
define('_AM_WEBLINKS_USER_NAME_MAIL_FLAG_DESC','ユーザが登録する場合の初期値<br />管理者は変更できる');
define('_AM_WEBLINKS_USER_NAME_MAIL_FLAG_SEL','ユーザが選択する');

// description length
define('_AM_WEBLINKS_DESC_LENGTH', '文字数の制限');
define('_AM_WEBLINKS_DESC_LENGTH_DSC', '<b>-1</b> あるいは 管理者は 64KB 制限<br />');

// === 2008-02-17 ===
// config
define('_AM_WEBLINKS_MODULE_CONFIG_7','モジュールの設定７');
define('_AM_WEBLINKS_MODULE_CONFIG_DESC_7','メニュー');
define('_AM_WEBLINKS_CONF_MENU', 'メニューの表示');
define('_AM_WEBLINKS_CONF_MENU_DESC', 'メニューの表示に関連する設定');
define('_AM_WEBLINKS_CONF_TITLE','メニューのタイトル');

// htmlout
define('_AM_WEBLINKS_OUTPUT_PLUGIN_MANAGE', '出力プラグイン管理');
define('_AM_WEBLINKS_HTMLOUT', 'HTML 出力プラグイン');
define('_AM_WEBLINKS_RSSOUT',  'RSS 出力プラグイン');
define('_AM_WEBLINKS_KMLOUT',  'KML 出力プラグイン');

// pagerank
define('_AM_WEBLINKS_LINK_CHECK_MANAGE', 'リンク検査管理');
define('_AM_WEBLINKS_USE_PAGERANK', 'PageRank の表示');
define('_AM_WEBLINKS_USE_PAGERANK_DESC', '「表示する」を選択すると、<br />メニュー・バーとリンク概要とリンク詳細に表示する。');
define('_AM_WEBLINKS_USE_PAGERANK_NON',   '表示しない');
define('_AM_WEBLINKS_USE_PAGERANK_SHOW',  '表示する');
define('_AM_WEBLINKS_USE_PAGERANK_CACHE', '取得した PageRank をキャッシュして、表示する');

// kml
define('_AM_WEBLINKS_KML_USE', 'KML の表示');

//---------------------------------------------------------
// 2012-04-02 v2.10
//---------------------------------------------------------
define('_AM_WEBLINKS_VIEW_URL_SUMMARY','概要のリンク先');
define('_AM_WEBLINKS_VIEW_URL_SUMMARY_DSC','カテゴリ、おすすめサイトなどで、概要 を選択したときに適用される');
define('_AM_WEBLINKS_VIEW_URL_SUMMARY_0','サイトのurl');
define('_AM_WEBLINKS_VIEW_URL_SUMMARY_1','Weblinksのsinglelink');

define('_AM_WEBLINKS_TITLE_RSSC_MANAGE','RSSC 管理');
define('_AM_WEBLINKS_TITLE_RSSC_ARCHIVE','RSSC アーカイブ管理');
define('_AM_WEBLINKS_TITLE_RSSC_ADD','リンクに RSS URL を追加する');

define('_AM_WEBLINKS_BULK_COMMENT','コメント一括登録');
define('_AM_WEBLINKS_BULK_COMMENT_DSC1','リンクのタイトル, uid, コメントのタイトル, コメントの本文 をカンマ(,)で区切って記述する<br />uid は省略可。管理者のuid で代用される<br/ >コメントのタイトル は省略可。リンクのタイトル で代用される');
define('_AM_WEBLINKS_NO_COMMENT','コメントがない');
define('_AM_WEBLINKS_COMMENT_ADDED','コメントを追加した');
define('_AM_WEBLINKS_BULK_DSC1','カンマと改行を特別な記法で記述できます<br />カンマ(,)は \2c と記述する<br/ >改行は \n と記述する');

define('_AM_WEBLINKS_TITLE_LINK_GEOCODING','リンクの緯度・経度の一覧');
define('_AM_WEBLINKS_TITLE_LINK_GEOCODING_DSC','住所から緯度・経度を検索します<br />すでに登録されているものは検索されません<br />検索結果は<span style="color:#0000ff">青字</span>で表示されます<br />検索できなかったときは<span style="color:#ff0000">赤字</span>で表示されます');
define('_AM_WEBLINKS_SEARCHED_ADDRESS','検索された住所');
define('_AM_WEBLINKS_GOTO_NEXT_PAGE','次のページへ');
define('_AM_WEBLINKS_LAST_PAGE','ここは最後のページです');
define('_AM_WEBLINKS_GEO_ADD','リンクに緯度・経度を追加する');

define('_AM_WEBLINKS_TITLE_LINK_CSV','リンク情報をCSV形式でダウンロードする');

define('_AM_WEBLINKS_GM_LOCATION_DSC', '緯度・経度の場所を示すメモ');

}
// --- define language end ---

?>