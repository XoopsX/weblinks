<?php
// $Id: main.php,v 1.2 2012/04/09 10:20:05 ohwada Exp $

// 2008-02-17 K.OHWADA
// pagerank, pagerank_update

// 2007-12-09 K.OHWADA
// remove _WEBLINKS_DISPLAY_SUMMARY

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

// 2006-11-04 wye & K.OHWADA
// google map: JP inverse Geocoder
// google map inline mode

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
// language for main
// 2004-10-24 K.OHWADA
// Japanese UTF-8
//=========================================================

// --- define language begin ---
if( !defined('WEBLINKS_LANG_MB_LOADED') ) 
{

define('WEBLINKS_LANG_MB_LOADED', 1);

//---------------------------------------------------------
// same as mylinks
//---------------------------------------------------------

//======	 singlelink.php	======
define("_WLS_CATEGORY","カテゴリ");
define("_WLS_HITS","ヒット数");
define("_WLS_RATING","評価");
define("_WLS_VOTE","投票数");
define("_WLS_ONEVOTE","投票数 1");
define("_WLS_NUMVOTES","投票数 %s ");
define("_WLS_RATETHISSITE","このサイトを評価する");
define("_WLS_REPORTBROKEN","リンク切れ報告");
define("_WLS_TELLAFRIEND","友達に紹介");
define("_WLS_EDITTHISLINK","このリンクを編集");
define("_WLS_MODIFY","修正");

//======	submit.php	======
//define("_WLS_SUBMITLINKHEAD","リンクフォームを登録");
define("_WLS_SUBMITLINKHEAD","新規リンクを登録する");
define("_WLS_SUBMITONCE","同一のリンク先は１回しか登録できません。");
define("_WLS_DONTABUSE","あなたのユーザ名とIP アドレスは記録されますので、悪戯などはお止めください。");
define("_WLS_TAKESHOT","あなたのウェブサイトのスクリーンショットを取るかもしれません。");
define("_WLS_ALLPENDING","リンク情報は一旦 <b>仮登録</b> され、スタッフによる確認後公開されます。<br />リンク登録に時間がかかる場合があるかもしれませんが予めご了承ください。");
//define("_WLS_WHENAPPROVED","リンク情報は、当サイトスタッフによる承認後に正式掲載となることをご了承ください。");
define("_WLS_RECEIVED","ウェブサイト情報を受付けました。ありがとうございます。");

//======	modlink.php	======
//define("_WLS_REQUESTMOD","リンク修正リクエスト");
define("_WLS_REQUESTMOD","リンクを修正する");
define("_WLS_THANKSFORINFO","情報をありがとうございます。いただいたリクエストはすぐに調査します。");


define("_WLS_THANKSFORHELP","このディレクトリ維持にご協力いただきありがとうございます。");
define("_WLS_FORSECURITY","セキュリティーの為に一時的にあなたのユーザ名とIPアドレスを記録させていただきます。");

define("_WLS_SEARCHFOR","検索"); //-no use
define("_WLS_ANY","どれか");
define("_WLS_SEARCH","検索");

//define("_WLS_MAIN","メイン");

define("_WLS_SUBMITLINK","リンク登録");
define("_WLS_POPULAR","人気");
define("_WLS_TOPRATED","トップレート");

define("_WLS_NEWTHISWEEK","今週の最新サイト");
define("_WLS_UPTHISWEEK","今週の更新サイト");

define("_WLS_POPULARITYLTOM","人気 (ヒット数の少ない順)");
define("_WLS_POPULARITYMTOL","人気 (ヒット数の多い順)");
define("_WLS_TITLEATOZ","タイトル (A to Z)");
define("_WLS_TITLEZTOA","タイトル (Z to A)");
define("_WLS_DATEOLD","日付 (登録日の古い順)");
define("_WLS_DATENEW","日付 (登録日の新しい順)");
define("_WLS_RATINGLTOH","評価 (評価の低い順)");
define("_WLS_RATINGHTOL","評価 (評価の高い順)");

//define("_WLS_NOSHOTS","スクリーンショットなし");
//define("_WLS_DESCRIPTIONC","説明：");
//define("_WLS_EMAILC","Ｅメールアドレス: ");
//define("_WLS_CATEGORYC","カテゴリ: ");
//define("_WLS_LASTUPDATEC","最終更新日: ");
//define("_WLS_HITSC","ヒット数: ");
//define("_WLS_RATINGC","評価: ");

define("_WLS_THEREARE","現在データベースには<b>%s</b>件のリンクが登録されています。");
define("_WLS_LATESTLIST","最新リスト");

//define("_WLS_LINKID","リンク ID: ");
//define("_WLS_SITETITLE","ウェブサイト名: ");
//define("_WLS_SITEURL","ウェブサイト URL: ");
//define("_WLS_OPTIONS", 'オプション：');
define("_WLS_LINKID","リンク ID");
define("_WLS_SITETITLE","ウェブサイト名");
define("_WLS_SITEURL","ウェブサイト URL");
define("_WLS_OPTIONS", 'オプション');
define("_WLS_NOTIFYAPPROVE", 'このリンクが承認あるいは拒否された場合に通知する');
//define("_WLS_SHOTIMAGE","スクリーンショット画像: ");
define("_WLS_SENDREQUEST","リクエストを送る");

define("_WLS_VOTEAPPRE","あなたの投票が反映されます。");
define("_WLS_THANKURATE","%sにご協力ありがとうございます。");
define("_WLS_VOTEFROMYOU","あなたの投票は他のユーザがリンクする時の判断基準に役立ちます。");
define("_WLS_VOTEONCE","同一サイトに対して投票できるのは１回限りとさせていただきます。");
define("_WLS_RATINGSCALE","評価を1～10の間からお選びください。数字が大きいほど評価が高いことを示します。");
define("_WLS_BEOBJECTIVE","公正な判断による投票をお願い致します");
define("_WLS_DONOTVOTE","自分自身のサイトに対しての投票はできません。");
define("_WLS_RATEIT","評価する");

define("_WLS_INTRESTLINK","%sでの興味深いウェブサイトリンク");  // %s is your site name
define("_WLS_INTLINKFOUND","%sにてとても興味深いウェブサイトを見つけました。");  // %s is your site name

define("_WLS_RANK","順位");
define("_WLS_TOP10","%s トップ 10"); // %s is a link category title

define("_WLS_SEARCHRESULTS","検索結果: <b>%s</b>:"); // %s is search keywords
define("_WLS_SORTBY","ソート順:");
define("_WLS_TITLE","タイトル");
define("_WLS_DATE","日付");
define("_WLS_POPULARITY","人気");
define("_WLS_CURSORTEDBY","現在のソート順サイト: %s");
define("_WLS_PREVIOUS","前のページ");
define("_WLS_NEXT","次のページ");
define("_WLS_NOMATCH","一致するデータは見つかりませんでした。");

define("_WLS_SUBMIT","送信");
define("_WLS_CANCEL","中止");

define("_WLS_ALREADYREPORTED","あなたからのリンク切れの報告は既に受け付けました。");
define("_WLS_MUSTREGFIRST","申し訳ございませんがあなたはこのページにはアクセスできません。<br />まず登録されるか、ログインして下さい。");
define("_WLS_NORATING","評価が選択されていません。");
define("_WLS_CANTVOTEOWN","あなたが登録したリンクには投票できません。<br />投票は全て記録され調査されます。");
define("_WLS_VOTEONCE2","申し訳ありませんが、同一リンク情報への投票は一回限りとさせていただいています。");

//%%%%%%	Admin	  %%%%%

define("_WLS_WEBLINKSCONF","リンク集管理");
define("_WLS_GENERALSET","一般設定");
//define("_WLS_ADDMODDELETE","カテゴリおよびリンク情報の追加／修正／削除");
define("_WLS_LINKSWAITING","承認待ちの新規リンク");
define("_WLS_MODREQUESTS","承認待ちの修正リンク");
define("_WLS_BROKENREPORTS","リンク切れ報告");

//define("_WLS_SUBMITTER","投稿者: ");
define("_WLS_SUBMITTER","投稿者");

define("_WLS_VISIT","訪問");

//define("_WLS_SHOTMUST","スクリーンショット画像は %s ディレクトリ下のファイル名で指定して下さい。 (例. shot.gif). もし画像ファイルがない場合は空白にしておいて下さい。");
define("_WLS_LINKIMAGEMUST","リンク画像は %s ディレクトリ下のファイル名で指定して下さい。 (例. shot.gif). もし画像ファイルがない場合は空白にしておいて下さい。");

define("_WLS_APPROVE","承認する");
define("_WLS_DELETE","削除");
define("_WLS_NOSUBMITTED","新しいリンク登録の申請はありません。");
define("_WLS_ADDMAIN","メインカテゴリ追加");
define("_WLS_TITLEC","タイトル: ");
define("_WLS_IMGURL","カテゴリ画像URL（オプションです。画像ファイルの高さは自動的に50ピクセルに調整されます。メインカテゴリ用）：");
define("_WLS_ADD","追加");
define("_WLS_ADDSUB","サブカテゴリ追加");
define("_WLS_IN","親カテゴリ：");
define("_WLS_ADDNEWLINK","新規リンクの追加");
define("_WLS_MODCAT","カテゴリ修正");
define("_WLS_MODLINK","リンク修正");
define("_WLS_TOTALVOTES","リンクの投票数 (投票数の合計: %s)");
define("_WLS_USERTOTALVOTES","登録ユーザによる評価数 (投票数の合計: %s)");
define("_WLS_ANONTOTALVOTES","未登録ユーザによる評価数 (投票数の合計: %s)");
define("_WLS_USER","ユーザ");
define("_WLS_IP","IP アドレス");
define("_WLS_USERAVG","ユーザの平均評価点");
define("_WLS_TOTALRATE","総評数");
define("_WLS_NOREGVOTES","登録ユーザによる評価はありません");
define("_WLS_NOUNREGVOTES","未登録ユーザによる評価はありません");
define("_WLS_VOTEDELETED","投票データは削除されました。");
define("_WLS_NOBROKEN","リンク切れ報告はありません。");
define("_WLS_IGNOREDESC","無視する (<b>リンク切れ報告</b>を削除し、報告を無視する)");
define("_WLS_DELETEDESC","削除する (<b>報告にあったウェブサイトのデータ</b>と<b>リンク切れ報告</b>を削除する)");
define("_WLS_REPORTER","送信者：");

define("_WLS_IGNORE","拒否する");
define("_WLS_LINKDELETED","リンク情報を削除しました。");
define("_WLS_BROKENDELETED","リンク切れ報告を削除しました。");
//define("_WLS_USERMODREQ","リンク修正リクエストユーザ");
define("_WLS_ORIGINAL","修正前");
define("_WLS_PROPOSED","修正後");
define("_WLS_OWNER","リンク情報提供者");
define("_WLS_NOMODREQ","リンク修正リクエストはありません。");
define("_WLS_DBUPDATED","データベースを更新しました。");
define("_WLS_MODREQDELETED","修正リクエストを削除しました。");
define("_WLS_IMGURLMAIN","カテゴリ画像URL（オプションです。画像ファイルの高さは自動的に50ピクセルに調整されます。メインカテゴリ用）：");
define("_WLS_PARENT","親カテゴリ:");
define("_WLS_SAVE","変更を保存");
define("_WLS_CATDELETED","カテゴリを削除しました。");
define("_WLS_WARNING","注意: 本当にこのカテゴリ及びそれに関連するリンク、コメントを削除しますか？");
define("_WLS_YES","はい");
define("_WLS_NO","いいえ");
define("_WLS_NEWCATADDED","カテゴリを追加しました。");

define("_WLS_NEWLINKADDED","新しいリンクはデータベースに追加されました。");
define("_WLS_YOURLINK","Your link submitted at %s"); //[MADA]
define("_WLS_YOUCANBROWSE","%sのリンク集にて様々なウェブサイトのリンク情報をご覧になれます。");
define("_WLS_HELLO","%sさん、こんにちは");
define("_WLS_WEAPPROVED","あなたからのウェブリンクのデータベースへのリンク登録申請は承認されました。");
define("_WLS_THANKSSUBMIT","リンク登録申請ありがとうございます。");
define("_WLS_ISAPPROVED","あなたからのリンク登録申請は承認されました。");


//---------------------------------------------------------
// weblinks
//---------------------------------------------------------

//======	index.php	======
// guidance bar
define("_WLS_SUBMIT_NEW_LINK","登録する");
define("_WLS_SITE_NEW","新着サイト");
define("_WLS_SITE_UPDATE","更新サイト");
define("_WLS_SITE_POPULAR","人気サイト");
define("_WLS_SITE_HIGHRATE","高評価サイト");
define("_WLS_SITE_RECOMMEND","おすすめサイト");
define("_WLS_SITE_MUTUAL","相互リンクサイト");
define("_WLS_SITE_RANDOM","ランダムジャンプ");
define("_WLS_NEW_SITELIST","新着 サイト");
define("_WLS_NEW_ATOMFEED","新着 RSS/ATOM");
define("_WLS_SITE_RSS","RSS/ATOM 対応サイト");
define("_WLS_ATOMFEED","RSS/ATOM 記事");

define("_WLS_LASTUPDATE","最終更新日");
define("_WLS_MORE","もっと詳しく");

//======	 singlelink.php	======
define("_WLS_DESCRIPTION","説明");
define("_WLS_PROMOTER","主催者");
define("_WLS_ZIP","郵便番号");
define("_WLS_ADDR","住所");
define("_WLS_TEL","電話番号");
define("_WLS_FAX","FAX番号");

//======	 submit.php	======
define("_WLS_BANNERURL","バナーのURL");
define("_WLS_NAME","名前・ハンドル名");
define("_WLS_EMAIL","Ｅメールアドレス");
define("_WLS_COMPANY","会社名・団体名");
define("_WLS_STATE","都道府県");
define("_WLS_CITY","市町村");
define("_WLS_ADDR2","ビル名など");
define("_WLS_PUBLIC","公開する");
define("_WLS_NOTPUBLIC","公開しない");
define("_WLS_NOTSELECT","指定しない");
define("_WLS_SUBMIT_INDISPENSABLE","星印(<b>*</b>)は、必須項目です。");
define("_WLS_SUBMIT_USER_COMMENT","「管理者へのコメント」はご意見・ご要望などお使いください。<br />この欄はWEBには表示されません。<br />「相互リンク」をご希望の場合は、当サイトがリンクされている貴方のサイトのURLをご記入ください。");
define("_WLS_USER_COMMENT","管理者へのコメント");
define("_WLS_NOT_DISPLAY","この欄はWEBには表示されません");

//======	modlink.php	======
define("_WLS_MODIFYAPPROVED","あなたからのリンク変更申請は承認されました。");
define("_WLS_MODIFY_NOT_OWNER","あなたがリンク情報の登録者であるかどうかを自動的には判断できませんでした。");
define("_WLS_MODIFY_PENDING","リンク情報の修正は一旦 <b>仮登録</b> され、スタッフによる確認後公開されます。<br />リンク修正に時間がかかる場合があるかもしれませんが予めご了承ください。");
define("_WLS_LINKSUBMITTER","リンク情報提供者：");

//======	user.php	======
define('_WLS_PLEASEPASSWORD','パスワードを入力してください');
define('_WLS_REGSTERED','登録ユーザー');
define('_WLS_REGSTERED_DSC','リンク情報の提供者でなくとも、修正できます。<br />管理者が確認後に掲載されます。');
define('_WLS_EMAILNOTFOUND','メールアドレスが一致しませんでした。');

// error message
define("_WLS_ERROR_FILL", "エラー: %s を入力して下さい。");
define("_WLS_ERROR_ILLEGAL","エラー: %s の形式が不正です");
define("_WLS_ERROR_CID",  "エラー: カテゴリを選択してください");
define("_WLS_ERROR_URL_EXIST","エラー: そのリンクは既にデータベースに登録されています。");
define("_WLS_WARNING_URL_EXIST","警告: 類似のリンクがデータベースに登録されています。");
define("_WLS_ERRORNOLINK","エラー: 該当するリンクはありません");

//define("_WLS_ERROR_TITLE", "エラー: タイトルを入力して下さい。");
//define("_WLS_ERROR_DESC",  "エラー: 説明を入力して下さい。");
//define("_WLS_ERROR_NAME",  "エラー: 名前を入力してください");
//define("_WLS_ERROR_MAIL",  "エラー: Ｅメールアドレスを入力してください");
//define("_WLS_ERROR_URL",   "エラー: URLを入力してください");
//define("_WLS_ERROR_URLILLEGAL","エラー: URLの形式が不正です");
//define("_WLS_ERROR_BANNERILLEGAL","エラー: バナーURLの形式が不正です");

define("_WLS_CATLIST","カテゴリ一覧");
define("_WLS_LINKIMAGE","リンク画像: ");
define("_WLS_CATEGORYID","カテゴリ ID: ");
define("_WLS_TIMEUPDATE","更新する");
define("_WLS_NOTTIMEUPDATE","更新しない");
define("_WLS_LINKFLAG","この下にリンクを作る");
define("_WLS_NOTLINKFLAG","この下にリンクを作らない");

//define("_WLS_ADDMODCATEGORY","カテゴリの追加／修正／削除");
//define("_WLS_ADDMODLINK","リンクの追加／修正／削除");
//define("_WLS_ADDMODLINK","新規リンクの追加");

define("_WLS_GOTOADMIN","管理者画面に移動します");

// category delete
define("_WLS_DELCAT","カテゴリ削除");
define("_WLS_SUBCATEGORY","サブカテゴリ");
define("_WLS_SUBCATEGORY_NON","サブカテゴリ なし");
define("_WLS_LINK_BELONG","関連するリンク");
define("_WLS_LINK_BELONG_NUMBER","関連するリンク数");
define("_WLS_LINK_BELONG_NON","関連するリンク なし");
define("_WLS_LINK_MAYBE_DELETE","削除されるリンク");
define("_WLS_LINK_MAYBE_DELETE_DSC","サブカテゴリがある場合は、正確な予想が出来ません。 これ以外にも削除されるリンクがあると思われます。");
define("_WLS_LINK_DELETE_NON","削除されるリンク なし");
define("_WLS_CATEGORY_LINK_DELETE_EXCUTE","カテゴリと関連するリンクを削除します");
define("_WLS_CATEGORY_LINK_DELETED","カテゴリと関連するリンクを削除しました");
define("_WLS_CATEGORY_DELETED","削除したカテゴリ");
define("_WLS_LINK_DELETED","削除したリンク");

define("_WLS_ERROR_CATEGORY","エラー: カテゴリが指定されていない");
define("_WLS_ERROR_MAX_SUBCAT","エラー: 一回で削除できるカテゴリ数を超えています");
define("_WLS_ERROR_MAX_LINK_BELONG","エラー: 一回で削除できる関連するリンク数を超えています");
define("_WLS_ERROR_MAX_LINK_DEL","エラー: 一回で削除できるリンク数を超えています");

// recommend site, mutual site
define("_WLS_MARK","マーク");
define("_WLS_ADMINCOMMENT","管理者のコメント");

// broken link check
define("_WLS_BROKEN_COUNTER","リンク切れカウンタ");

// RSS/ATOM URL
define("_WLS_RSS_URL","RSS/ATOMのURL");
define("_WLS_RSS_URL_0","未使用");
define("_WLS_RSS_URL_1","RSS形式");
define("_WLS_RSS_URL_2","ATOM形式");
define("_WLS_RSS_URL_3","自動検出");

define("_WLS_ATOMFEED_DISTRIBUTE","ここに表示されている RSS/ATOM 記事を RSS と ATOM で配信しています。");
define("_WLS_ATOMFEED_FIREFOX","<a href='http://www.mozilla-japan.org/products/firefox/' target='_blank'>Firefox</a> をご利用の方はこのページをブックマークすると、配信内容がご覧になれます。");

// 2005-10-20
define("_WLS_EMAIL_APPROVE","承認されると通知します");
define("_WLS_TOPTEN_TITLE","%s トップ %u");
// %s is a link category title
// %u is number of links
define("_WLS_TOPTEN_ERROR", "トップ・カテゴリが多すぎます。 %u 個で表示を打ち切りました。");
// %u is munber of categories

// 2006-05-15
define('_WEBLINKS_MID','修正 ID');
define('_WEBLINKS_USERID','ユーザ ID');
define('_WEBLINKS_CREATE','登録日');

// conflict with rssc
//define('_HOME',  'ホーム');
//define('_SAVE',  '保存');
//define('_SAVED', '保存した');
//define('_CREATE', '生成');
//define('_CREATED','生成した');
//define('_FINISH',   '終了');
//define('_FINISHED', '終了した');
//define('_EXECUTE', '実行');
//define('_EXECUTED','実行した');
//define('_PRINT','印刷');
//define('_SAMPLE','見本');

define('_NO_MATCH_RECORD','該当するレコードが存在しません');
define('_MANY_MATCH_RECORD','該当するレコードが２つ以上 存在します');
define('_NO_CATEGORY', 'カテゴリがない');
define('_NO_LINK', 'リンクがない');
define('_NO_TITLE', 'タイトルがない');
define('_NO_URL', 'URLがない');
define('_NO_DESCRIPTION','説明がない');

//define('_GOTO_MAIN',   'メイン･ページ へ');
//define('_GOTO_MODULE', 'モジュール へ');

// config
//define('_WEBLINKS_INIT_NOT', '設定テーブルが初期化されていない');
//define('_WEBLINKS_INIT_EXEC', '設定テーブルを初期化する');
//define('_WEBLINKS_VERSION_NOT','バージョン %s ではない');
//define('_WEBLINKS_UPGRADE_EXEC','設定テーブルをアップグレードする');

// html tag
define('_WEBLINKS_OPTIONS', 'オプション');
//define('_WEBLINKS_DISPLAY_SUMMARY', '概要を表示する');
define('_WEBLINKS_DOHTML', ' HTML タグを有効にする');
define('_WEBLINKS_DOIMAGE', ' 画像を有効にする');
define('_WEBLINKS_DOBREAK', ' 改行を有効にする');
define('_WEBLINKS_DOSMILEY', ' スマイリーアイコンを有効にする');
define('_WEBLINKS_DOXCODE', ' XOOPS コードを有効にする');

define('_WEBLINKS_PASSWORD_INCORRECT','パスワードが正しくない');
define('_WEBLINKS_ETC', 'その他');
define('_WEBLINKS_AUTH_UID',    'ユーザID 一致');
define('_WEBLINKS_AUTH_PASSWD', 'パスワード 一致');
define('_WEBLINKS_BANNER_SIZE', 'バナーのサイズ');

// === 2006-10-01 ===
// conflict with rssc
//if( !defined('_SAVE') ) 
//{
//	define('_HOME', 'ホーム');
//	define('_SAVE', '保存');
//	define('_SAVED','保存した');
//	define('_CREATE', '生成');
//	define('_CREATED','生成した');
//	define('_EXECUTE', '実行');
//	define('_EXECUTED','実行した');
//}

define('_WEBLINKS_MAP_USE', '地図アイコンの表示');

// rssc
define('_WEBLINKS_RSS_MODE',  'RSS モード');
define('_WEBLINKS_RSSC_LID',  'RSSC Lid');
define('_WEBLINKS_RSSC_NOT_INSTALLED', 'RSSC モジュール ( %s ) はインストールされていない');
define('_WEBLINKS_RSSC_INSTALLED',     'RSSC モジュール ( %s ) ver %s はインストールされている');
define('_WEBLINKS_RSSC_REQUIRE',       'RSSC モジュール ver %s かそれ以降が必要です');
define('_WEBLINKS_GOTO_SINGLELINK', 'リンク詳細へ');

// warnig
define('_WEBLINKS_WARN_NOT_READ_URL', '警告: URL が読み出せない');
define('_WEBLINKS_WARN_BANNER_NOT_GET_SIZE', '警告: バナーサイズが取得できない');

// google map: hacked by wye <http://never-ever.info/>
define('_WEBLINKS_GM_LATITUDE',  '緯度');
define('_WEBLINKS_GM_LONGITUDE', '経度');
define('_WEBLINKS_GM_ZOOM', 'ズーム・レベル');
//define('_WEBLINKS_GM_LATITUDE_DESC',  '-90(南緯) から +90(北緯) ');
//define('_WEBLINKS_GM_LONGITUDE_DESC', '-180(西経) から +180(東経)');
//define('_WEBLINKS_GM_ZOOM_DESC', '0 から +17');
define('_WEBLINKS_GM_GET_LOCATION', 'GoogleMaps で位置情報を取得する');
//define('_WEBLINKS_GM_GET_BUTTON', '位置情報を取得する');
define('_WEBLINKS_GM_DEFAULT_LOCATION', '省略時の位置');
define('_WEBLINKS_GM_CURRENT_LOCATION', '現在の位置');

// === 2006-11-04 ===
// google map inline mode
define('_WEBLINKS_GOOGLE_MAPS', 'Google Maps');
define('_WEBLINKS_JAVASCRIPT_INVALID', '貴方のブラウザでは JavaScript が使用できません');
define('_WEBLINKS_GM_NOT_COMPATIBLE', '貴方のブラウザでは GoogleMaps を表示できません');
define('_WEBLINKS_GM_NEW_WINDOW', '新しいウィンドに表示する');
define('_WEBLINKS_GM_INLINE',   'インラインで表示する');
define('_WEBLINKS_GM_DISP_OFF', '表示を消す');

// google map: inverse Geocoder
define('_WEBLINKS_GM_GET_LATITUDE', '緯度・経度を取得する');
define('_WEBLINKS_GM_GET_ADDR', '住所を取得する');

// === 2006-12-11 ===
// google map: Geocode
define('_WEBLINKS_GM_SEARCH_MAP_FROM_ADDRESS', '住所から地図を検索する');
define('_WEBLINKS_GM_NO_MATCH_PLACE', '該当する場所がない');
define('_WEBLINKS_GM_JP_SEARCH_MAP_FROM_ADDRESS', '住所から地図を検索する(東大版)');
define('_WEBLINKS_GM_JP_TOKYO_AC_GEOCODE', '東京大学 CSISシンプルジオコーディング実験');
define('_WEBLINKS_GM_JP_MLIT_ISJ', '国土交通省 街区レベル位置参照情報');

// link item
define('_WEBLINKS_TIME_PUBLISH', '発行日');
define('_WEBLINKS_TIME_EXPIRE',  '終了日');
define('_WEBLINKS_TEXTAREA',     'Textarea');

define('_WEBLINKS_WARN_TIME_PUBLISH', '発行日がまだ来ていない');
define('_WEBLINKS_WARN_TIME_EXPIRE',  '終了日を過ぎている');
define('_WEBLINKS_WARN_BROKEN', 'リンク切れの可能性がある');

// === 2007-02-20 ===
// forum
define('_WEBLINKS_LATEST_FORUM', '最新のフォーラム');
define('_WEBLINKS_FORUM',  'フォーラム');
define('_WEBLINKS_THREAD', 'スレッド');
define('_WEBLINKS_POST',   '投稿');
define('_WEBLINKS_FORUM_ID',  'フォーラム番号');
define('_WEBLINKS_FORUM_SEL', 'フォーラムの選択');
define('_WEBLINKS_COMMENT_USE',  'XOOPSコメントを使用する');

// aux
define('_WEBLINKS_CAT_AUX_TEXT_1', 'aux_text_1');
define('_WEBLINKS_CAT_AUX_TEXT_2', 'aux_text_2');
define('_WEBLINKS_CAT_AUX_INT_1',  'aux_int_1');
define('_WEBLINKS_CAT_AUX_INT_2',  'aux_int_2');

// captcha
define('_WEBLINKS_CAPTCHA', '画像認証');
define('_WEBLINKS_CAPTCHA_DESC', 'スパム対策');
define('_WEBLINKS_ERROR_CAPTCHA','エラー: 画像認証が一致しない');
define('_WEBLINKS_ERROR', 'エラー');

// hack for multi site
define('_WEBLINKS_CAT_TITLE_JP', '日本語 タイトル');
define('_WEBLINKS_DISABLE_FEATURE', 'この機能は使用できません');
define('_WEBLINKS_REDIRECT_JP_SITE', '日本語サイトにジャンプします');

// === 2007-03-25 ===
define('_WEBLINKS_ALBUM_ID',  'アルバム番号');
define('_WEBLINKS_ALBUM_SEL', 'アルバムの選択');

// === 2007-04-08 ===
define('_WEBLINKS_GM_TYPE',  'Google Map Type');
define('_WEBLINKS_GM_TYPE_MAP',       '地図');
define('_WEBLINKS_GM_TYPE_SATELLITE', '衛星写真');
define('_WEBLINKS_GM_TYPE_HYBRID',    '地図+写真');

// === 2007-08-01 ===
define('_WEBLINKS_GM_CURRENT_ADDRESS', '現在の住所');
define('_WEBLINKS_GM_SEARCH_LIST', '検索結果の一覧');

// === 2007-09-01 ===
// waiting list
define('_WEBLINKS_ADMIN_WAITING_LIST', '管理者の承認待ちリスト');
define('_WEBLINKS_USER_WAITING_LIST',  'あなたの承認待ちリスト');
define('_WEBLINKS_USER_OWNER_LIST',    'あなたの登録リスト');

// submit form
define('_WEBLINKS_TIME_PUBLISH_SET','発行日を設定する');
define('_WEBLINKS_TIME_PUBLISH_DESC','設定しないときは、常に表示される');
define('_WEBLINKS_TIME_EXPIRE_SET','終了日を設定する');
define('_WEBLINKS_TIME_EXPIRE_DESC','設定しないときは、常に表示される');
define('_WEBLINKS_DEL_LINK_CONFIRM','削除しますか');
define('_WEBLINKS_DEL_LINK_REASON', '削除理由');

// === 2007-11-01 ===
define('_WEBLINKS_ERROR_LENGTH', "エラー: %s の文字数を %s 文字以下にして下さい");

// === 2008-02-17 ===
// linkitem
define('_WEBLINKS_PAGERANK', 'ページランク');
define('_WEBLINKS_PAGERANK_UPDATE', 'ページランク更新時刻');
define('_WEBLINKS_GM_KML_DEBUG', 'KML のデバック表示');

// gmap
define('_WEBLINKS_SITE_GMAP', 'GoogleMaps 対応サイト');
define('_WEBLINKS_KML_LIST',  'KML 一覧');
define('_WEBLINKS_KML_LIST_DESC', 'KML をダウンロードして、GoogleEarth で見る');
define('_WEBLINKS_KML_PERPAGE', '分割する件数');

// pagerank
define('_WEBLINKS_SITE_PAGERANK', '高 PageRank サイト');

//---------------------------------------------------------
// 2012-04-02 v2.10
//---------------------------------------------------------
// webmap3
define('_WEBLINKS_WEBMAP3_NOT_INSTALLED', 'WEBMAP3 モジュール ( %s ) はインストールされていない');
define('_WEBLINKS_WEBMAP3_INSTALLED',     'WEBMAP3 モジュール ( %s ) ver %s はインストールされている');
define('_WEBLINKS_WEBMAP3_REQUIRE',       'WEBMAP3 モジュール ver %s かそれ以降が必要です');

// google map
define('_WEBLINKS_GM_LOCATION', '場所');
define('_WEBLINKS_GM_ICON', 'Googleアイコン');

}
// --- define language end ---

?>