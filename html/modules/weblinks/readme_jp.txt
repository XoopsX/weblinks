$Id: readme_jp.txt,v 1.5 2012/04/09 10:20:04 ohwada Exp $

=================================================
Version: 2.10
Date:   2012-04-02
Author: Kenichi OHWADA
URL:    http://linux.ohwada.jp/
Email:  webmaster@ohwada.jp
=================================================

● 変更内容
1. Google Maps API V3 対応
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=1271&forum=5

(1) WEBMAP3 モジュールが必要です。

(2) カテゴリ単位、リンク単位にマーカーのアイコンが指定できます。
http://linux.ohwada.jp/modules/newbb/viewtopic.php?forum=5&topic_id=1150

(3) 任意のアイコンを設定できます。
WEBMAP3 モジュールの機能です。
http://linux.ohwada.jp/modules/newbb/viewtopic.php?forum=5&topic_id=848

2. 管理者の設定に url 選択を追加した
タイトルのハイパーリンクに、
元のサイトと Weblinks のsinglelink.php との選択ができる
http://linux.ohwada.jp/modules/newbb/viewtopic.php?forum=5&topic_id=1198

3. 登録できるURLの文字数を255バイトから64Kバイトに変更した
http://linux.ohwada.jp/modules/newbb/viewtopic.php?forum=5&topic_id=1279

4. 一括登録に下記の機能を追加した
(1) フォーム画面からコメントを一括登録する
(2) 登録済のリンクの URL からから RSS URL を検索して、自動で登録する
(3) 登録済のリンクの住所から緯度・経度を検索して、半自動で登録する
(4) \2c という記法でカンマを記述できるようにした
(5) textarea1,2 にて改行(\n)を記述できるようにした

5. 言語ファイル
(1) ロシア語 ( CP1251 & UTF-8 ) を追加した
language ディレクトリの他に extra ディレクトリにも置いている
多謝 Anthony xoops-org.ru 


● テーブル構造
1. link, modify テーブル
(1) 下記の項目を追加した
gm_icon : Google Maps Icon
(2) 下記の項目の属性を varchar から text に変更した
url 

2. category テーブル
(1) 下記の項目を追加した
gm_icon : Google Maps Icon
gm_location : memo of location


=================================================
Version: 2.00
Date:   2011-12-29
=================================================

● 変更内容
1. PHP 5.3 対応
PHP 5.3.x で推奨されない機能 を修正した
http://www.php.net/manual/ja/migration53.deprecated.php
(1) ereg
(2) new の返り値を参照で代入すること

2. MySQL 5.5 対応
(1) TYPE=MyISAM -> ENGINE=MyISAM

3. リンク切れ一覧にて、broken の多い順にする。

4. バグ修正
(1) typo in weblinks_link_single.html
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=1085&forum=5


=================================================
Version: 1.95
Date:   2009-04-02
=================================================

● 変更内容
(1) ブラジル語 1.94
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=451&forum=2

(2) バグ対策
Smarty error: unable to read resource: d3forum_comment.html
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=448&forum=2


=================================================
Version: 1.94
Date:   2009-02-01
=================================================

● 変更内容
(1) アルバムの選択に Webphoto を追加した
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=911&forum=5

(2) webphoto との競合を修正した
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=913&forum=13


=================================================
Version: 1.93
Date:   2009-01-04
=================================================

● 変更内容
(1) バージョン xx ではない
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=861&forum=5

(2) ドイツ語のメールテンプレート更新


=================================================
Version: 1.92
Date:   2008-10-18
=================================================

● 変更内容
1. Newbbex 用のプラグインの追加
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=423&forum=2

2. ペルシャ語の更新
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=424&forum=2

3. バグ対策
(1) URL に & が含まれていると &amp; になる
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=831&forum=5

(2) Notice in weblinks_link_view_handler.php
http://xoopscube.jp/modules/xhnewbb/viewtopic.php?topic_id=5862


=================================================
Version: 1.91
Date:   2008-04-12
=================================================

● 変更内容
1. テンプレートにて $xoops_isuser を使用する
http://linux.ohwada.jp/modules/newbb/viewtopic.php?forum=5&topic_id=792

2. URL記載のないリンクのページランクを表示しない
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=794&forum=5

3. バグ対策
(1) パスワード・リクエストのあとで、パスワードが変更できない
http://linux.ohwada.jp/modules/newbb/viewtopic.php?forum=5&topic_id=791


=================================================
Version: 1.90
Date:   2008-03-05
=================================================

● 変更内容
1. 出力プラグインを追加した
1.1 仕様面
1.1.1 フックの位置
DBから読み出して、共通の処理を行った後

1.1.2 プラグインの連結
UNIX パイプのように指定する
-----
plugin_a | plugin_b | plugin_c
-----

1.1.3 プラグインへのパラメータ指定
関数のパラメータのように指定する
-----
plugin_a ( param_a, param_b, param_c )
-----

1.2 実装面
1.2.1 プラグインの見本を用意した
(1) pagerank
(2) gamp_sample
(3) rss_sample
(4) kml_sample

1.2.2 管理者画面を追加した
(1) 出力プラグイン管理
- HTML 出力プラグインの設定
- RSS  出力プラグインの設定
- KML  出力プラグインの設定
- プラグイン一覧
- プラグインのテスト

2. Google PageRank に対応した
http://linux2.ohwada.net/modules/newbb/viewtopic.php?forum=2&topic_id=383

(1)「高 PageRank サイト」を追加した
(2) リンク概要とリンク詳細に 緑のバーを表示した
(3) 表示する際に、自動的に取得する
(4) サーバーの負荷を低減するために、取得した PageRank を DB にキャッシュした。
登録内容を登録・変更したときには、再取得される
(5) 管理者画面の「リンク検査管理」に「PageRank Update」を追加した

(6) 注意
Google の公式なサービスではありません。
将来的には動作しないこともあります。

ツールバーなしの PageRank 
http://www.google.com/support/toolbar/bin/answer.py?answer=9156&topic=11773
現在のところ、PageRank 機能は Google ツールバーでのみ提供しています。 

3. Google KML に対応した
http://linux.ohwada.jp/modules/newbb/viewtopic.php?forum=5&topic_id=770

(1) 「GoogleMaps 対応サイト」を追加し、「KML 一覧」を表示した
(2) プラグインにより、カスタマイズを可能にした
プラグインの見本 kml_sample
(3) kml ディレクトリを追加し、.htaccess に下記を記述した
-----
addType application/vnd.google-earth.kml+xml .kml
-----

4. 管理者画面に「モジュールの設定７(メニュー)」を追加した
http://linux2.ohwada.net/modules/newbb/viewtopic.php?forum=2&topic_id=362

(1) メニューの表示に関連する設定項目を集約した
(2) メニューのタイトルを変更可能にした

5. カテゴリ名の文字数を 50 文字から 255 文字に変更した
http://linux2.ohwada.net/modules/newbb/viewtopic.php?forum=2&topic_id=364

6. 登録画面の入力欄の横の長さの設定を変更した
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=382&forum=2

7. ブロックにて GoogleMaps の地図形式ボタンを表示しないオプションを追加した
http://linux.ohwada.jp/modules/newbb/viewtopic.php?forum=5&topic_id=730

8. 管理者画面のリンク一括登録にて、発行日を設定できるように変更した
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=790&forum=5

9. 言語ファイル
(1) アラビア語 更新
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=351&forum=2

(2) ペルシア語 更新
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=387&forum=2

10. バグ修正
(1) 承認待ちの削除リンクにて、fatal error


● テーブル構造
(1) link, modify テーブル
下記の項目を追加した
pagerank : Google PageRank
pagerank_update : PageRank 更新時刻

(2) category テーブル
属性を変更した
title : varchar(50) -> varchar(255)


● テンプレート
下記のテンプレートを追加した
- weblinks_build_kml


● 要求事項
(1) Happy_linux モジュール v1.40 が必要です。
(2) RSS 機能を使用するときは、rssc モジュール v0.80 が必要です。
(3) memory_limit が 16 MB 以上必要です。


● アップデート
(1) weblinks ディレクトリ以下のファイルを上書きする。

(2) XOOPS 管理画面より、weblinks モジュールのアップデートをする。
weblinks のアップデート・スクリプトも同時に実行される。

(3) PageRank
今回のバージョンより PageRank を追加した
アップデートしただけでは、PageRank の値が DB に入っていない。
「リンク検査管理」の「Update PageRank」を実行のこと

(4) 管理画面の「DBテーブル管理」を実行する。
不整合のないことを確認する。


=================================================
Version: 1.85
Date:   2008-02-16
=================================================

● 変更内容
1. Google Maps API のバージョンアップに伴い、下記の機能追加を行った
(1)「地図形式ボタン」に「地形」を追加した
(2) [検索] 地図の形式 を削除した

2. インストール処理を変更した
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=767&forum=8

3. テンプレート変数 xoops_module_heade を変更した
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=772&forum=9

4. リンク切れ検査にタイムアウト時間を表示した
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=381&forum=2

5. バグ修正
(1) 地図の形式 (GMapType) の初期値を衛星写真にすると、灰色の地が表示される
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=634&forum=5

(2) グーグルロゴのリンク先が違う


=================================================
Version: 1.84
Date:   2008-01-18
=================================================

● 変更内容
1. 言語
ドイツ語 更新

2. バグ対策
(1) Only variables should be assigned by reference
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=758&forum=5

(2) アルバムにて、同じカテゴリ名が表示されない
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=763&forum=5

(3) Fatal error: Call to a member function on a non-object in weblinks_rssc_view_handler.php
(4) fopen(): failed to open stream: No such file or directory in weblinks_banner_handler.php


=================================================
Version: 1.83
Date:   2007-12-29
=================================================

● 変更内容
1. バグ対策
(1) 要約表示にて、スマイリーアイコンが表示されない
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=746&forum=5

(2) 団体名、住所などが「検索」フィールドに設定されない
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=754&forum=5

すでに登録されている「検索」フィールドを修正するツールを添付しました。
管理者画面の「DBテーブル管理」に一番下にある「Rebuild search field」を実行ください。
「検索」フィールドのみが再設定されます。


=================================================
Version: 1.82
Date:   2007-12-16
=================================================

● 変更内容
1. リダイレクトの方法を header() に変更した
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=742&forum=5

2. バグ対策
(1) カテゴリのパンくずにて a タグが閉じてていない
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=737&forum=5

(2) 一括登録にて、TOP にリンクが登録できない
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=740&forum=5

(3) RSSC へのエクスポートにて、Fatal エラー
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=741&forum=5

(4) 1.31 から update できない
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=366&forum=2


=================================================
Version: 1.81
Date:   2007-11-26
=================================================

● 変更内容
1. DBテーブル管理
config テーブルの検査などを追加した

2. バグ対策
(1) プレビューできない
http://linux.ohwada.jp/modules/newbb/viewtopic.php?forum=5&topic_id=721

(2) リンクが削除できない
http://linux.ohwada.jp/modules/newbb/viewtopic.php?forum=5&topic_id=729

(3) マイナスの投票が出来る
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=359&forum=2

(4) TEXT 型のカラムには DEFAULT 値は設定できない
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=732&forum=5

(5) ランダム写真ブロックで fatal エラー
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=734&forum=5

(6) 印刷表示のとき、BBコードが変換されない


=================================================
Version: 1.80
Date:   2007-11-11
=================================================

● 変更内容
1. RSS キャッシュ
(1) サーバーの負荷低減のため、ゲストモードのときだけ、キャッシュした。
(2) 管理者画面にキャッシュ・クリアを設けた。

2. onInstall onUpdate に対応した

3. メモリ使用量
(1) メモリ使用量を 16MB 程度に低減した
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=716&forum=5

(2) メモリ使用量を表示した

4. サムネイル・サービスに http://www.websitethumbnails.net/ を追加した
http://linux2.ohwada.net/modules/newbb/viewtopic.php?forum=2&topic_id=339

5. オプションを追加した
(1) Google マップのマーカーの横幅を指定する
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=705&forum=5

(2) 説明文の文字数を制限する
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=347&forum=2

(3) 必ず名前を表示する
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=349&forum=2

6. キーワード
(1) Google 検索 と Yahoo 検索 から来たときには、検索キーワードをハイライトする
(2) feed 記事もハイライトする
(3) 検索キーワードがないときは、URL に keywords クエリを表示しない

7. 要約作成時に日本語句読点の後ろに空白文字を追加する
8. モジュール管理を追加した
9. xoops block table の検査を追加した

10. 言語
(1) イタリア語を追加した
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=337&forum=2

(2) アラビア語を追加した
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=351&forum=2

(3) スペイン語を更新した
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=344&forum=2

(4) ペルシャ語を更新した
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=343&forum=2

11. バグ対策
(1) ゲストがリンクを変更できない
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=342&forum=2

(2) fatal error in blocks/weblinks_plugin.php
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=718&forum=2

(3) 日本地図のリンク数が表示されない
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=722&forum=5

(4) ゲストがパスワードを登録できない
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=725&forum=5

(5) 検索ページにて、ページ渡りで cid が引き継がれない
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=727&forum=5

(6) rssc モジュールへのデータ・エキスポートが出来ない


● 要求事項
(1) Happy_linux モジュール v1.20 が必要です。
(2) RSS機能を使用するときは、rssc モジュール v0.70 が必要です。
(3) memory_limit が 16 MB 以上必要です。

● アップデート
(1) weblinks ディレクトリ以下のファイルを上書きする。

(2) XOOPS 管理画面より、weblinks モジュールのアップデートをする。
今回のバージョンより、onUpdate に対応したので、
weblinks のアップデート・スクリプトも同時に実行される。

(3) 管理画面の「DBテーブル管理」を実行する。
不整合のないことを確認する。
XOOPS Cube 2.1 や XOOPS 2.2 では、
モジュール・アップデートはブロックのオプションを変更しません


=================================================
Version: 1.71
Date:   2007-09-23
=================================================

● 変更内容
1. バナー画像の一時保管ディレクトリ
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=694&forum=5

(1) /tmp が open_basedir に含まれるか検査した
(2) 管理者が preload にて任意のディレクトリを指定できる
(3) 管理者画面にて、書込み可能かを検査し表示する

2. PHP 5.2 対応
(1) E_STRICT レベルのエラーを潰した
(2) コマンドライン・モードのDB処理を変更した

3. バグ対策
(1) [4705] 一括登録にて fatal error
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=4705&group_id=1199&atid=971

(2) [4707] weblinks_config2_basic_handler.php: Only variables should be assigned by reference
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=4707&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=691&forum=5

(3) 印刷が表示できない
http://linux.ohwada.jp/modules/newbb/viewtopic.php?forum=5&topic_id=696

(4) リンク切れ管理にて fatal error
(5) 削除依頼の承認ができない
(6) ゲストが自分のリンクを削除できない


=================================================
Version: 1.70
Date:   2007-09-16
=================================================

● 変更内容
1. リンク登録・変更・削除を大幅に改訂した

1.1 ユーザにリンクを削除する権限を追加した
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=638&forum=5

1.2 [4514] ユーザに発行日・完了日を設定する権限を追加した
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=290&forum=2

ユーザは、発行日前であれば、リンクを閲覧できないが。
自分のリンクであれば、発行日前でも、閲覧できるようにした。

1.3 リンク登録のときに、「管理者宛てコメント」を管理者へ通知する
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=459&forum=5

(1) ユーザ用に加えて、管理者用のイベント通知を追加した

- 新規リンクが掲載された場合に通知する
- [管理者] 新規リンクが掲載された場合に通知する (管理者宛コメントも表示)
- [管理者] 新規リンクが掲載された場合に通知する (管理者宛コメントの記載あり)

(2) 管理者画面にて、「管理者宛てコメント」のあるリンクをリンク一覧に表示した

(3) 管理者画面にて、リンク登録をした場合に、
発行日前であるものは、イベント通知を行わない

1.4 [4068] 管理者に通知するか否かを選択する
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=171&forum=2

登録ユーザのときは、XOOPS本体のイベント通知を利用し、
ゲストのときは、独自にメール通知を実装していた。
メール通知を廃止して、イベント通知に一本化した。

- [管理者] 新規リンク (承認待ち) の投稿があった場合に通知する
- [管理者] リンク修正のリクエストがあった場合に通知する

1.5 [3418] リンク登録・変更・削除の承諾・拒否のメールに理由を記入する
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=121&forum=2

(1) 登録ユーザのときは、XOOPS本体のイベント通知を利用し、
ゲストのときは、独自にメール通知を実装していた。
イベント通知の利用を廃止して、独自のメール通知に一本化した。

(2) 明示的に、メール・フォームを表示した。

(3) リンク登録に加えて、リンク変更・削除のメール文を追加した
- link_mod_approve_notify.tpl
- link_mod_refuse_notify.tpl
- link_del_approve_notify.tpl
- link_del_refuse_notify.tpl

1.6 リンクの複製
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=684&forum=5

(1) リンクの複製 を追加した:
(2) 他のモジュールへのリンクの複製 を追加した

1.7 リンク修正申請

(1) ユーザが申請するときに、「管理者へのコメント」を必須とした
(2) 承認画面にて、変更箇所をハイライトした
(3) uid mail name の変更には、明示的な確認を必要とした

1.8 承認待ちリスト
(1) 投稿したユーザに対して、登録されたリンクの一覧をトップページに表示した
(2) 申請したユーザに対して、承認待ちのリンクの一覧をトップページに表示した
(3) 管理者用に承認待ちの数をトップページに表示した
(4) 管理者は、リストを表示する否かの選択ができる
(5) XOOPS本体の「承認待ちブロック」に weblinks を追加するための API を新設した
(6) waiting モジュール用のプラグインを新設した

1.9 管理者メニューに「イベント通知の設定」を追加した

1.10 開発者向けに、テストシナリオを追加した

2. サムネイル WEB サービス
(1) 下記のサムネイル・サービスに対応した
- http://mozshot.nemui.org/
- http://img.simpleapi.net/

(2) リンク画像が設定されていないときに、サムネイル WEB サービスを利用して、
WEBサイトのサムネイルを表示する

3. オプション追加
(1) [3030] ランダムリンクのジャンプ先を、URL か 詳細ページ が選択する
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=101&forum=2
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=680&forum=5

(2) [4359] 詳細ページの閲覧にて、ヒット数をカウントする
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=249&forum=2

4. バグ対策
(1) グローバル検索にて、発行日前でも表示される
(2) ユーザのリンク登録にて、同じ RSS URL があるときでも、
RSSC モジュールに新たにレコードが追加される


● 要求事項
(1) Happy_linux モジュール v1.10 が必要です。
(2) RSS機能を使用するときは、rssc モジュール v0.61 が必要です。


● アップデート
(1) weblinks ディレクトリ以下のファイルを上書きする。

(2) XOOPS 管理画面より、weblinks モジュールのアップデートをする。
テンプレートとイベント通知を変更したので、必ず実施のこと。

(3) weblinks 管理画面より、設定テーブルをアップデートする。
設定テーブルが最新版に対応していないときは、メッセージが出ます。

(4) weblinks 管理画面 の「モジュールの設定１（一般設定）」にて、
「特定イベントを有効にする」にて、追加された２つのイベントを有効にする
- [管理者] 新規リンクが掲載された場合に通知する (管理者宛コメントも表示)
- [管理者] 新規リンクが掲載された場合に通知する (管理者宛コメントの記載あり)


=================================================
Version: 1.62
Date:   2007-09-15
Author: Kenichi OHWADA
URL:    http://linux.ohwada.jp/
Email:  webmaster@ohwada.jp
=================================================

● 変更内容
バグ修正
(1) 4698: 管理者がリンク登録時に fatal error になる
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=4698&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=687&forum=5

(2) 4702: ユーザがリンク登録時に fatal error になる
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=4702&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=689&forum=5


=================================================
Version: 1.61
Date:   2007-09-01
=================================================

● 変更内容
機能追加
1. RSS/ATOMのURL
(1) 管理者が「必須」に設定したときでも、
ユーザが「未使用」を選択すれば、入力されているかどうかを検査しない

(2) 管理者承認モードにて、デフォルトの「自動検出」が選択されていれば、
RSS Auto Discovry を実行して、rss_url と rss_flag を設定する。
自動承認モードのときは、従来から実行している

2. バグ修正
(1) 4680: ブロックの「日付表示」のラジオボタンが機能しない
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=4680&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=663&forum=5

(2) 4688: IE6のとき、JavaScript エラーになる
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4688&group_id=1409&atid=1786
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=667&forum=12

(3) 4689: singlelink にて、RSS/ATOM記事の表示件数が制限されない
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4689&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=669&forum=5

(4) 4690: 管理者承認モードにて、rss_url が設定されない
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4690&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=670&forum=5

(5) 4693: 新規リンクの「イベント通知」が行われない
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4693&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=674&forum=5

(6) リンク修正の「イベント通知」のリンク先が誤っている
(7) カテゴリのブックマークにて、名称(カテゴリ名)が表示されない
(8) カテゴリ別のイベント通知が、設定したカテゴリのうち１つしか通知されない


=================================================
Version: 1.60
Date:   2007-08-05
=================================================

● 変更内容
1. MySQL 4.1/5.x の対応
http://linux.ohwada.jp/modules/newbb/viewtopic.php?forum=9&topic_id=631
日本語では、MySQL の文字コードは ujis (EUC-JP) に固定にしていた。
管理者が happy_linux/preload/charset.php を設置して、任意の文字コードが指定できるように変更した。

2. Google Map
(1) テンプレート から javascript を分離して js ファイルを新設した
- weblinks_gmap.js
- weblinks_gmap_block.js
- weblinks_gmap_location.js
(2) map control などのオプションを追加した
(3) リンク情報のマーカーに本文の要約を表示した
(4) geocode の結果をマーカーで表示した

3. 新着リンク
更新日順か登録日順かを選択するオプションを追加した

4. HTML スタイル
(1) W3C 準拠に変更した
主なページは W3C Markup Validator のチェックを通した
http://validator.w3.org/

(2) xoops moduel header
xoops moduel header を使用して、
header タグ内に スタイルシートと javascript を表示するオプションを追加した

5. ブロック
(1) カテゴリを表示するオプションを追加した
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=4651&group_id=1199&atid=974

(2) 本文の要約を表示するオプションを追加した
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=315&forum=5

(3) ブロックに google map を表示するオプションを追加した
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=507&forum=5

6. 一括登録
(1) 管理者が登録項目を指定する機能を追加した
(2) 見本に都道府県庁を追加した

7. 日本地図の追加
日本でのみ有効
地図上の県名をクリックすると、該当するカテゴリにジャンプする

8. 多言語
(1) ドイツ語を変更した
(2) ドイツ国を追加した
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=323&forum=2

9. etc 項目の拡張
開発者向けです
link テーブルと modify テーブルに etc カラムを追加するための仕組みを用意した

10. 管理者画面
(1) メニューの詳細を表示する「モジュールの設定」を追加した
(2) 「リンク登録項目」を分離して「モジュールの設定５」を追加した
(3) 「Google Map」を分離して「モジュールの設定６」を追加した
(4) 「日本地図の設定」を追加した
(5) 「カラム管理」を追加した

11. バグ対策
(1) 承認待ちの新規リンクが承認しても消えない
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=658&forum=5
(2) 「リンク切れの報告」に該当するURLがない


● テンプレート
下記のテンプレートを追加した
- weblinks_gm_location
- weblinks_gm_block
- weblinks_map_jp


● 要求事項
(1) Happy_linux モジュール v1.00 が必要です。
(2) RSS機能を使用するときは、rssc モジュール v0.60 が必要です。


● アップデート
(1) weblinks ディレクトリ以下のファイルを上書きする。

(2) XOOPS管理画面より、weblinks モジュールのアップデートをする。
テンプレートを変更したので必ず実施のこと。

(3) weblinksモジュールの管理画面より、設定テーブルをアップデートする。
設定テーブルが最新版に対応していないときは、メッセージが出ます。

(4) Weblinks管理画面より、「モジュールの設定」の「 テンプレートのキャッシュ・クリア」を行う。
テンプレートを変更したので必ず実施のこと。

(5) Weblinks管理画面 もしくは XOOPS管理画面より、ブロック管理にて、ブロックのパラメータを修正する。
XOOPS バージョンによっては モジュールのアップデートでは変更が反映されないことがある。


=================================================
Version: 1.51
Date:   2007-07-20
=================================================

● 変更内容
1. XC 2.1 に対応した
(1) メール送信を system モジュールに依存をしないようにした
(2) メールの形式のチェックした
(3) 言語ファイルを mailusers.php を追加した

2. GeoRss に対応した

3. バグ対策
(1) 4637: OR検索が機能しない
(2) 4640: undefined function: get_selecter_by_id()
(3) 4644: キーワード・ハイライトを無効にするオプション
(4) 4647: キーワード "abc" が "abccc" に一致する
(5) undefined method get_error_msg_modlink()
(6) IEのとき 検索からの記事がハイライトしない


=================================================
Version: 1.50
Date:   2007-07-01
=================================================

● 変更内容
1. RSSCモジュール (v0.60) の変更に合わせて、修正した

2. 性能向上
(1) 表示のときは、全面的に object handler の使用を止めた
(2) ２つのクラスを新設した
- weblinks_link_catlink_basic_handler
- weblinks_rssc_view_handler

3. コマンドラインに分割実行するオプションを追加した
オプションは下記の形式です
-----
php -q -f XOOPS/modules/weblinks/bin/link_check.php  pass
php -q -f XOOPS/modules/weblinks/bin/link_check.php -pass=pass [ -limit=0 -offset=0  -echo ]
-----

4. 管理者画面にブロック管理を追加した
(1) XOOPS のメジャー・バージョンによる違いの吸収
XOOPS 2.0 / 2.1 / 2.2 に対応したメニューを表示する
バージョン判定を自動的に行い、10秒後の自動的にページを移動する

(2) GIJOE さんの myblocksadmin を採用した
xoops 2.0 系で有効です

5. d3forum モジュールとの連携
5.1 d3forum 用のプラグインを追加した
他のフォーラム・モジュールと同様に、カテゴリ・ページ毎とリンク・ページ毎に、フォーラム・モジュールの投稿の内容を表示する

5.2 d3forum のコメント統合に対応した
使用方法
1) d3forum モジュールにコメント統合用のフォーラムを作成する
2) 「フォーラム編集」の「コメント統合時の参照方法」に、
"weblinks::weblinksD3commentContent::"
と記入して保存する。
3) weblinks の「モジュール設定４」の「d3forum モジュールのコメント統合」の
「プラグインの選択」「モジュールの選択」を指定して、更新する
4) 「フォーラムの選択」「コメントの表示方法」を指定して、更新する。

6. カテゴリの表示
6.1 カテゴリパスの表示形式
オプションを追加した
http://linux2.ohwada.net/modules/newbb/viewtopic.php?viewmode=flat&topic_id=284&forum=2

6.2 サブカテゴリの表示範囲
オプションを追加した

7. 多言語
(1) 日本語 UTF-8 ファイルを追加した
(2) 日本語特有の処理をするための言語ファイル名に jp_utf8 を追加した

8. バグ修正
(1) SQL文のパッケージング
http://linux.ohwada.jp/modules/newbb/viewtopic.php?forum=5&topic_id=635
(2) 「承認待ちの新規リンク」で header が抜けていた
(3) Notice : Undefined offset: 8 in file blocks/weblinks_top.php


● テンプレート
下記のテンプレートを追加した
- weblinks_d3forum_comment


● 要求事項
(1) Happy_linux モジュール v0.90 が必要です。
(2) RSS機能を使用するときは、rssc モジュール v0.60 が必要です。


● アップデート
(1) weblinks ディレクトリ以下のファイルを上書きする。

(2) XOOPS管理画面より、weblinks モジュールのアップデートをする。
テンプレートを変更したので必ず実施のこと。

(3) weblinksモジュールの管理画面より、設定テーブルをアップデートする。
設定テーブルが最新版に対応していないときは、メッセージが出ます。

(4) Weblinks管理画面より、「モジュールの設定２」の「 テンプレートのキャッシュ・クリア」を行う。
テンプレートを変更したので必ず実施のこと。


=================================================
Version: 1.44
Date:   2007-05-19
=================================================

● 変更内容
1. XOOPS Cube 2.1 対応
管理者画面の「ユーザ管理」にて、メールを送信するには、system モジュールが必要です。
それ以外は、system モジュールがなくとも、動作します。

2. バグ修正
(1) 一括登録のとき、xoopsコメントが未使用になる
(2) リンク登録・変更のとき、エラーメッセージにエスケープされたHTMLタグが表示される

● 要求事項
Happy_linux モジュール v0.8 が必要です。


=================================================
Version: 1.43
Date:   2007-05-12
=================================================

● 変更内容
1. バグ修正
(1) 4562: インポート管理にて、Fatal エラーになる
(2) 4563: singlelink にて forum_id が array 形式になる
(3) 4564: RSSCモジュールが存在しないときに、「RSCCモジュールを使用する」にすると、Fatal エラーになる
(4) 4565: リンク数やユーザ数が多いと、ユーザ管理が表示されない
(5) バナー画像が表示枠からはみだす
(6) リンク切れの一覧表示にて、ページ送りできない
(7) Notice [PHP]: Use of undefined constant album_id - assumed 'album_id' in file class/weblinks_category_handler.php
(8) Notice [PHP]: Use of undefined constant WLS_ERROR_ILLEGAL in file class/weblinks_link_form_check_handler.php
(9) Notice [PHP]: Use of undefined constant imgurl in file admin/category_manage.php
(10) Notice [PHP]: Undefined variable: dirname in myheader.php


=================================================
Version: 1.42
Date:   2007-04-09
=================================================

これはベータ版です。
安定版は、v0.97 と V1.31 です。

● 変更内容
1. 機能追加
(1) GoogleMap の初期状態として 「地図」「航空写真」を選択できるようにした。
(2) カテゴリごとに説明欄を設けた。
(3) アルバム表示にてサブカテゴリも対象にした
(4) アルバム表示のブロックを追加した

2. バグ修正
(1) 4533: dont show album selceter in admin form
(2) Fatal error: print_warnig() in category_manage.php
(3) always all forums in newbb_200.php

● テーブル構造
(1) category テーブルに下記の項目を追加した
  gm_type dohtml dosmiley doxcode doimage dobr
(2) link と modify テーブルに下記の項目を追加した
  gm_type

● テンプレート
(1) 下記のテンプレートを追加した
  weblinks_block_photo

● アップデート
v1.40 と同じ


=================================================
Version: 1.41
Date:   2007-03-25
=================================================

これはベータ版です。
今回の変更点は、「性能向上」と「GoogleMapの拡充」です。
安定版は、v0.97 と V1.31 です。


● 変更内容
1. 性能向上
(1) カテゴリの画像情報があるとき、サイズ情報を事前に取得し、データベースに格納する。

2. GoogleMapの拡充
(1) トップ・ページとカテゴリ・ページ毎に、GoogleMapを表示する
(2) そのページにあるリンクを地図上のマーカーで表示する
(3) カテゴリ・ページ毎に地図の中心を指定する

3. アルバム・モジュールとの連携
下記のオプョンを追加した
(1) カテゴリ・ページ毎とリンク・ページ毎に、アルバム・モジュールの写真を表示する

4. 多言語
ペルシャ語 v1.40 に対応

5. バグ修正
(1) 4506: expired links not listed in admin
(2) 4507: Fatal error: getallchildid() in category_manage.php
(3) 4508: Fatal error: weblinks_get_handler() in weblinks_top.php
(4) 4509: JavaScript error in gm_get_location.php
(5) 4519: Fatal error: get_cid_array_by_title() in bulk_manage.php
(6) 4520: dont work newline in textarea


● テーブル構造
(1) category テーブルに下記の項目を追加した
  album_id, img_orig_width, img_orig_height, img_show_width, img_show_height
  gm_mode, gm_latitude, gm_longitude, gm_zoom
(2) link と modify テーブルに下記の項目を追加した
  album_id

● テンプレート
(1) 下記のテンプレートを追加した
  album_list

● アップデート
v1.40 と同じ


=================================================
Version: 1.40
Date:   2007-03-04
=================================================

これはベータ版です。
今回の変更点は、「性能向上」と「フォーラム・モジュールとの連携」です。
安定版は、v0.97 と V1.31 です。


● 変更内容
1. 性能向上
 下記のオプョンを追加した
(1) 性能向上のために、表示するときに必要な情報を事前に計算し、データベースに格納する。
(2) カテゴリ情報などのメモリ上の格納形式を XoopsObject から 連想配列に変更した。

2. フォーラム・モジュールとの連携
下記のオプョンを追加した
(1) カテゴリ・ページ毎とリンク・ページ毎に、フォーラム・モジュールの投稿の内容を表示する
(2) プラグインにより、フォーラム・モジュールの種類を拡張する
対応しているモジュール Newbb 1.00、Newbb 2.02、BluesBB 1.00
(3) リンク・ページ毎にXOOPSコメントを使用する/しないを選択する

3. captchaモジュールとの連携
下記のオプョンを追加した
(1) ゲストがリンクを登録・変更するときに、captcha(画像認証)を使用する

4. XOOPSユーザの投稿数
下記のオプョンを追加した
(1) リンクを登録したときに、XOOPSユーザの投稿数をカウントアップする
(2) 評価をしたときに、XOOPSユーザの投稿数をカウントアップする

5. 表示
下記のオプョンを追加した
(1) カテゴリ・ページ、おすすめサイト、相互リンクサイト、RSS/ATOM 対応サイトにて、
リンク情報の表示形式として、概要/詳細を選択する

6. ユーザの登録画面
下記のオプョンを追加した
(1) ユーザが textarea1 と textarea2 を使用にする
(2) 登録項目ごとの説明を編集する
(3) 登録フォームの上段の説明を編集する

7. マルチサイト
ハックとして、日・英 切替えに対応した


● テーブル構造
(1) category テーブルに下記の項目を追加した
  forum_id, tree_order, cids_parent, cids_child, link_count, link_update,
  aux_int_1, aux_int_2, aux_text_1, aux_text_2

(2) link と modify テーブルに下記の項目を追加した
  forum_id, comment_use

(3) linkitem テーブルに下記の項目を追加した
  description


● テンプレート
(1) 下記のテンプレートを追加した
  category_navi, forum_list
(2) テンプレート変数に、サブ・カテゴリの要素を割当てた


● 要求事項
(1) happy_linux モジュールが必須です。
(2) RSS機能を使用するときは、rssc モジュールが必要です。
(3) フォーラム機能を使用するときは、フォーラム・モジュールが必要です。
(4) captcha機能を使用するときは、captcha モジュールが必要です。


● アップデート
(1) weblinks ディレクトリ以下のファイルを上書きする。

(2) XOOPS管理画面より、weblinksモジュールのアップデートをする。
テンプレートを変更したので必ず実施のこと。

(3) weblinksモジュールの管理画面より、設定テーブルをアップデートする。
設定テーブルが最新版に対応していないときは、メッセージが出ます。

【注意】
config2 と linkitem テーブルは初期化され、元の値は破壊されます。
必要に応じて、値を再設定してください。

(4) Weblinks管理画面より、「モジュールの設定２」の「 テンプレートのキャッシュ・クリア」を行う。
テンプレートを変更したので必ず実施のこと。

(5) v1.30 以降でRSS機能を使用している場合
「DBテーブル管理」->「Clear xml in link table」を実行すること
不要なデータである link テーブルの rss_xml 項目の内容が消去される
メモリ使用量が節約される

(6) 「性能向上」機能を使用する場合
設定したあとで、「カテゴリ一覧」->「パス・ツリー情報の更新」を実行すること
必要なデータが作成される


● 注意
ほぼ全てのファイルを変更しています。
データベースのテーブル構造も若干変更しています。
大きな問題はないはずですが、小さな問題はあると思います。
何か問題が出ても、自分でなんとか出来る人のみお使いください。
バグ報告やバグ解決などは歓迎します。


● TODO
性能向上を施したので、構造的な変更は、終了した（はず）。
以降は、バックログを順次 折り込むつもりです。


=================================================
Version: 1.31
Date:   2007-02-20
=================================================

● 変更内容
1. バグの修正
(1) 4476: reset hits rating votes commnets in modify link by admin
(2) 4477: topten is unlimited
(3) 4495: Fatal error: Call to undefined method weblinks_link_edit::build_mail_edit_for_others()


=================================================
Version: 1.30
Date:   2006-12-17
=================================================

これはベータ版です。
今回の変更点は、「発行日・終了日とテキストボックスの追加」です。
これらの機能が不要な場合は v0.97 あるいは V1.22 をお使いください。


● 変更内容
1. Google Maps
(1) リンク登録時に ジオコーダーを追加した
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=559&forum=5

2. リンク登録項目
(1) 発行日と終了日を追加した。
管理者だけが登録できます。
http://xoopscube.jp/modules/newbb/viewtopic.php?topic_id=8647&forum=17

(2) テキストボックス (textarea) を２つ追加した。
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=529&forum=5
管理者だけが登録できます。
textarea1 は HTMLやオプションの指定ができます。
textarea2 は HTMLは使えません。

3. 管理者画面
(1) リンク一覧に 発行日以前と終了日以降を追加した。

4. 言語
(1) ドイツ語ファイルを更新した
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=232&forum=2

5. 地域
(1) イラン (ir) を追加した

6. 内部構造
(1) データベースへの保存方法を変更した。
データベースに保存するオブジェクトを加工するために、
link_save と modify_save の２つのクラスを追加した。
(2) 開発者向けに 上記のクラスのテストケースを作成した

7. バグの修正
(1) 4417: language singleton done not work correctly
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=4417&group_id=1199&atid=971
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=256&forum=2


● テーブル構造
(1) link, modify テーブル
下記の項目を追加した
time_publish : 発行日
time_expire  : 終了日
textarea1    : テキスト項目
textarea2    : テキスト項目
dohtml1      : textarea1 の書式オプション
dosmiley1    : textarea1 の書式オプション
doxcode1     : textarea1 の書式オプション
doimage1     : textarea1 の書式オプション
dobr1        : textarea1 の書式オプション

● 要求事項
(1) happy_linux モジュールが必須です。
(2) RSS機能を使用するときは、rssc モジュールが必要です。

● アップデート
テンプレートを変更したので、下記を実施のこと。
(1) XOOPS管理画面より、weblinksモジュールのアップデートをする。
(2) Weblinks管理画面より、「モジュールの設定２」の「 テンプレートのキャッシュ・クリア」を行う。

● 注意
大きな問題はないはずですが、小さな問題はあると思います。
何か問題が出ても、自分でなんとか出来る人のみお使いください。
バグ報告やバグ解決などは歓迎します。

● TODO
スケーラビリティの改善。


=================================================
Version: 1.22
Date:   2006-11-08
Author: Kenichi OHWADA
URL:    http://linux.ohwada.jp/
Email:  webmaster@ohwada.jp
=================================================

これはベータ版です。
今回の変更点は、「RSSCモジュールとの連携」です。
これらの機能が不要な場合は v0.97 あるいは V1.13 をお使いください。


● 変更内容
1. Google Maps
(1) リンク登録時に インライン表示を追加した
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=534&forum=5
(2) 日本語版にて、逆ジオコーダーを追加した
http://linux.ohwada.jp/modules/newbb/viewtopic.php?viewmode=flat&topic_id=547&forum=5
(3) ブラウザのチェックを追加した
JavaScript GoogleMaps を使用できるか

2. ブロック
(1) 汎用表示ブロックを追加した
(2) ランダム表示ブロックを追加した
http://linux.ohwada.jp/modules/newbb/viewtopic.php?viewmode=flat&topic_id=537&forum=5

3. 英語ファイルの修正
http://linux2.ohwada.net/modules/newbb/viewtopic.php?viewmode=flat&topic_id=241&forum=2

4. バグ修正
(1) 4342: 英語版にて、100文字以上で fatal error
happy_linux モジュールを修正した
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4342&group_id=1199&atid=971
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=245&forum=2

(2) 4344: Table 'weblinks_config2' doesn't exist
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4344&group_id=1199&atid=971
http://linux2.ohwada.net/modules/newbb/viewtopic.php?viewmode=flat&topic_id=232&forum=2

(3) 4349: IE のとき 印刷画面で google map を表示しない
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4349&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?viewmode=flat&topic_id=542&forum=5


● アップデート
(1) テンプレートを変更したので、下記を実施のこと。
XOOPS管理画面より、weblinksモジュールのアップデートをする。
(2) happy_linux モジュール 0.32 が必要です。


=================================================
Version: 1.21
Date:   2006-10-14
=================================================

これはベータ版です。
今回の変更点は、「RSSCモジュールとの連携」です。
これらの機能が不要な場合は v0.97 あるいは V1.13 をお使いください。

● 変更内容
1. GoogleMaps
(1) マーカーをクリックすると、 Google サイトを開くようにした
(2) 印刷画面にマップの表示を追加した

2. 検索機能を拡充した
(1) カテゴリ毎や、「おすすめサイト」「相互リンクサイト」での、絞込み検索を追加した
(2) RSS記事の検索を追加した
(3) Googleサイトへのリンクを追加した
(4) 実行時間を表示した

3. バグ修正
(1) 4312: visit.php にて、Fatal error
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4312&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?viewmode=flat&topic_id=532&forum=5

(2) 4313: GoogleMaps の位置情報取得が文字化けする
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4313&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=534&forum=5

(3) 4318: 一括登録にて、Fatal error
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4318&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=536&forum=5

(4) 「同じリンク先の登録をチェックする」が効かない
(5) ２重にハイライトする

● アップデート
テンプレートを変更したので、下記を実施のこと。
(1) XOOPS管理画面より、weblinksモジュールのアップデートをする。
(2) Weblinks管理画面より、「モジュールの設定２」の「 テンプレートのキャッシュ・クリア」を行う。


=================================================
Version: 1.20
Date:   2006-10-07
=================================================

これはベータ版です。
今回の変更点は、「RSSCモジュールとの連携」です。
これらの機能が不要な場合は v0.97 あるいは V1.13 をお使いください。

● 大きな変更
1. happy_linux モジュール
rssc モジュールと共通の処理を happy_linux モジュールに集約した。
この「weblinks」モジュールを使用するには、happy_linux モジュールが必要となります。

2. rssc モジュール
rssc モジュールとの連携機能を追加した
RSS の収集・保存などの機能は rssc モジュールを利用します。

2.1 操作
RSS機能を使用するときは、管理者画面にて「RSS記事の使用」を「はい」に設定する。
全ての操作は weblinks モジュールを介して行われます。
利用者は rssc モジュールを使用していることを意識する必要はない。

2.2 RSSCモジュールの連携機能を利用したことにより、下記の点が改良されています。
(1) RSSパーサーに magpie を採用した
(2) <title> と <dc:title> を区別した
http://linux.ohwada.jp/modules/newbb/viewtopic.php?viewmode=flat&topic_id=457&forum=5
(3) <enclosure> を解析し、podcasting に対応した

2.3 従来との互換のために、下記の機能は残した (v1.13以前)。
RSSCモジュールにも同様な機能があるので、そちらを使用することを推奨します。
(1)「リンク集の新着RSS/ATOM記事」ブロック
(2)「リンク集のblog表示」ブロック
(3) カスタム・ブロックにてblogを表示する (include/atomfeed.inc.php)

2.4 下記のコマンドは廃止した
RSSCモジュールに同様な機能があるので、そちらを使用ください。
(1) bin/refresh_link.php
(2) bin/refresh_site.php

2.5 課題
２つのモジュールを連携したことにより、
モジュール間に不整合が発生することがあります。

(1) rssc にてリンクを削除した
rssc 側にてリンクを削除しても、weblinks 側は削除されません。
weblinks 側では、リンクがあるのに、
RSSフィード が表示されないという不具合が発生します。

この不具合は、管理者が修正することで、解決します。
rssc 側にて 削除したリンクを再度 登録してください。
weblinks 側にて、登録したリンクのIDに変更してください。

(2) rssc にて同じ「RSS URL」が複数存在する。
weblinks 側にて間違った「RSS URL」のリンクを追加すると、
rssc 側にも間違ったリンクが追加されます。
その後「RSS URL」を修正すると、
rssc 側も修正されます。
修正した「RSS URL」が、
rssc 側に存在していた場合に、
rssc 側にて同じ「RSS URL」が複数存在することになります。

rssc 側では、
リンクAを更新したときには、RSSフィードはリンクAに属するものとして追加され、
リンクBを更新したときには、RSSフィードはリンクBに属するものとして追加されます。
また同じRSSフィードは追加しないという仕組みになっています。
そのため、リンクAには、RSSフィード1,3,5が属して、
リンクBには、RSSフィード2,4,6が属するようになります。

weblinks 側では、リンクAとリンクBのいずれに表示しても、
RSSフィード1,2,3,4,5,6が表示されるのが理想的な姿ですが、
現状では、リンクAではRSSフィード1,3,5のみが表示されるという不具合が発生します。

この不具合は、管理者が修正することで、解決します。
weblinks 側 と rssc 側の両方で、重複しているリンクを削除してください。


● 機能追加
1. 検索
(1) Amethyst Blue にて配布している検索モジュールに対応して、検索結果に本文を表示した
http://www.suin.jp/

(2) 検索結果のキーワードをハイライト表示した
SmartSection を参考にした。

(3) ゆらぎ検索 を追加した（日本語のみ）
Amethyst Blue にて配布している検索モジュールを参考にした
- 半角英数のとき 全角英数も検索対象にする
- 全角英数のとき 半角英数も検索対象にする
- 半角カタカナのとき 全角カタカナと全角ひらがなも検索対象にする
- 全角カタカナのとき 半角カタカナと全角ひらがなも検索対象にする
- 全角ひらがなのとき 半角カタカナと全角ひらがなも検索対象にする

2. Google Map の表示を追加した
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=413&forum=5
詳細表示画面 (singlelink.php) にて、Google Map が表示される。

設定方法１：初期設定
(1) 「Google Maps API Key」を取得する。
(2) 管理画面にて 取得した Key を入力する

設定方法２：リンクごと
(1) リンク登録時に、緯度・経度の情報を入力する
緯度・経度の情報は、世界地図から表示したい場所を選択すると、自動的に抽出される。

3. 地図サイトへのリンク・ボタン
これは、従来からある機能です。
3.1 地図サイトを選択できるようにした。
これ以外を希望するときは、対応するテンプレートを作成すること
- 日本 Yahoo
- 日本 Mapfan
- 日本 Google
3.2 リンク表示のテンプレートから、地図アイコンの部分の独立し、別のテンプレートにした。
3.3 リンクごとに、地図アイコンを表示する/しないのオプションを追加した
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=3819&group_id=1199&atid=974

4. サブカテゴリも画像を表示した
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=194&forum=2

5. １ページに表示する件数に75と100を追加した
http://linux2.ohwada.net/modules/newbb/viewtopic.php?viewmode=flat&topic_id=139&forum=2

6. 最新のリンク情報を RDF/RSS/ATOM 形式にて配信した

7. 管理者画面
7.1 管理者画面のメニューに、下記を追加した
(1) モジュールの設定３ (リンク)
(2) モジュールの設定４ (RSS)
(3) 投票一覧
(4) CatLink 一覧
(5) コマンド管理 (bin/link_check.php)
(6) DBテーブル管理 (ゾンビ検査、rsscモジュールとの整合性検査)
(7) インポート管理 (mylinks)
(8) エキポート管理 (rssc)

7.2 リンクの登録・変更手順を 下記の３段階に分割し、検査を強化した
(1) リンク情報の登録
-  URLへの接続が出来るか(リンク切れでない)を確認した (プレビュー時)
(2) バナー画像の登録
-  バナー画像のサイズが取得し、出来ないときはその旨を表示した
(3) RSS情報の登録 
- RSS URLの自動検出を行い、出来ないときはその旨を表示した
- DB中に同じ「RDF/RSS/ATOM URL」があるかを検査し、あるときはその旨を表示した
- RSS URLの内容を解析し、出来ないときはその旨を表示した

7.3 テーブルの管理画面にて、「パンくず」を表示した

8. コマンド実行 (bin/link_check.php) にパスワードを追加した
下記の形式となる
-----
php4 -q -f /home/***/html/modules/weblinks/bin/link_check.php PASSWORD
-----

9. セッションチケット・クラス (XoopsGTicket) を採用した
Peak にて配布している Tinyd から流用した

10. 地域選択 (Locate) の仕組みを実験的に導入した。
言語と国・地域を独立に選択する仕組みです。
従来は、英語だと米国と決めうちしていた。
英国など任意の国を選択できるようになる。
http://linux2.ohwada.net/modules/newbb/viewtopic.php?viewmode=flat&topic_id=77&forum=2

10.1 国コードに IANA のccTLDs を採用した
今回 用意したのは、日本(jp)、米国(us)、英国(uk) の３つです。

10.2 設定方法
英語版では、米国がデフォルトです。
英国に変更するには、
まず、「国コード」に「uk」を入力し、「更新」ボタンを押す。
次に、「再設定」ボタンを押す。

11. 開発者向けに下記の機能を新設した
(1) DBテーブルにテスト用のデータを生成する
(2) リンクの登録・変更のフォームをhttp経由でテストする


● テーブル構造
(1) atomfeed テーブルの使用を廃止した
下位互換性のためにテーブル自体は残っている

(2) link, modify テーブル
下記の項目を追加した
map_use  : 地図アイコンの表示
rssc_lid : rsscモジュールのLinkID
gm_xxx   : Google Maps 関連
aux_xxx  : 将来の予備

● テンプレート
(1) templates ディレクトリ
parts と xml サブ・ディレクトリに一部のテンプレートを移動した

(2) parts サブ・ディレクトリ を新設した
template_main で使われる主テンプレートの部品となるテンプレートを置いた
weblinks_header.html の ヘッダーと 検索フォーム を別ファイルにした
http://linux.ohwada.jp/modules/newbb/viewtopic.php?viewmode=flat&topic_id=529&forum=5

(3) map サブ・ディレクトリ を新設した
地図サイトへのリンク・ボタンのテンプレートを置いた

(4) xml サブ・ディレクトリ を新設した
RSSフィード表示のテンプレートを置いた


● 要求事項
(1) happy_linux モジュールが必須です。
(2) RSS機能を使用するときは、rssc モジュールが必要です。


● アップデート
(1) weblinks ディレクトリ以下のファイルを上書きする。

いくつかファイルでファイル名が変更されています。
上書きでは古いファイルが削除されずに残りますが、
運用には支障はありません。
気になる人は、いったんファイルのバックアップを取ってから、
ファイルを削除して、新しいファイルに置き換えてください。

(2) XOOPS管理画面より、weblinksモジュールのアップデートをする。
テンプレートを変更したので必ず実施のこと。

(3) weblinksモジュールの管理画面より、設定テーブルをアップデートする。
設定テーブルが最新版に対応していないときは、メッセージが出ます。

注意：
linkitem table は初期化され、元の値は破壊されます。
必要に応じて、値を再設定してください。

(4) RSS機能を使用する場合
(4-1) 管理画面の「モジュールの設定４」を実行する。
「rsscモジュールのDirname」と「RSS 記事の使用」を設定する

(4-2) 管理画面の「エキスポート管理」を実行する。
weblinks のDBデータを rssc モジュールにコピーします

(5) 管理画面の「DBテーブル管理」を実行する。
不整合のないことを確認する。


● 注意
ほぼ全てのファイルを変更しています。
データベースのテーブル構造も若干変更しています。
大きな問題はないはずですが、小さな問題はあると思います。
何か問題が出ても、自分でなんとか出来る人のみお使いください。
バグ報告やバグ解決などは歓迎します。


● TODO
今回で、基本構造に関する変更は、終了した（はず）。
以降は、バックログを順次 折り込むつもりです。


● 謝辞
下記の方々に感謝します。
- Search モジュールを開発された suin さん
- Tinyd モジュールを開発された GIJOE さん
- SmartSection モジュールを開発された SmartFactory のメンバーの方
- Google Maps のハックをされた wye さん


=================================================
Version: 1.13
Date:   2006-09-24
=================================================

● 主な変更内容
これはベータ版です。
今回の変更は、「説明文にHTMLタグを使用可能にした」などの機能追加と、
データベース操作に関する実装方法の変更です。
これらの機能が不要な場合は v0.97 をお使いください。

● バグ修正
(1) 4261: xoops protector と併用すると、カテゴリの登録ができない
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4261&group_id=1199&atid=971

(2) 4278: メインページにリンク一覧を表示しないを設定できない
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4278&group_id=1199&atid=971

(3) 4279: Undefined index: rss_num in file singlelink.php
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4279&group_id=1199&atid=971


=================================================
Version: 1.12
Date:   2006-09-16
=================================================

● 主な変更内容
これはベータ版です。
今回の変更は、「説明文にHTMLタグを使用可能にした」などの機能追加と、
データベース操作に関する実装方法の変更です。
これらの機能が不要な場合は v0.97 をお使いください。

● バグ修正
(1) 4164: リンク情報へのコメント投稿のコメント数表示ができない
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4164&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=505&forum=5

(2) 4168: 「おすすめサイト」「相互リンクサイト」「RSS/ATOM 対応サイト」にてカテゴリが表示されない
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4168&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?viewmode=flat&topic_id=508&forum=5

(3) 4169: RSS/ATOM対応サイトの登録数が表示されない
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4169&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?viewmode=flat&topic_id=508&forum=5

(4) singlelink にて古い feed がクリアされない
http://linux.ohwada.jp/modules/newbb/viewtopic.php?viewmode=flat&topic_id=509&forum=5

(5) カテゴリ名 が２回サニタイズされる


=================================================
Version: 1.11
Date:   2006-07-23
=================================================

● 主な変更内容
これはベータ版です。
今回の変更は、「説明文にHTMLタグを使用可能にした」などの機能追加と、
データベース操作に関する実装方法の変更です。
これらの機能が不要な場合は v0.97 をお使いください。

● バグ修正
(1) 4029: テーブル名が間違っている
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4029&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=464&forum=5

(2) 4030: 「相互リンク」「おすすめサイト」のマークが修正できない
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4030&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?viewmode=flat&topic_id=471&forum=5

(3) 4032 : テーブルが作成できない
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4032&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=464&forum=5

(4) 4060: コマンドラインの実行が10リンクに制限される
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4060&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?viewmode=flat&topic_id=474&forum=5

(5) 4085: 「承認待ちの新規リンク」にて Fatal error
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4085&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?viewmode=flat&topic_id=482&forum=5

(6) 4130: 「おすすめサイト」が表示されない
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4130&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=492&forum=5

(7) 4152 : メインにてカテゴリが表示されない
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4152&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?viewmode=flat&topic_id=488&forum=5

(8) 4153: 検索結果にカテゴリが表示されない
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4153&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=497&forum=5

(9) 4154: 管理者画面にて更新日の更新しないが効かない
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=4154&group_id=1199&atid=971


=================================================
Version: 1.10
Date:   2006-05-24
=================================================

● 主な変更内容
これはベータ版です。
今回の変更は、「説明文にHTMLタグを使用可能にした」などの機能追加と、
データベース操作に関する実装方法の変更です。
これらの機能が不要な場合は v0.97 をお使いください。

１．下記のオプションを追加した
(1) 説明文にHTMLタグを使用可能にした
3023 can use HTML tag in content
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=3023&group_id=1199&atid=974
http://linux2.ohwada.net/modules/newbb/viewtopic.php?viewmode=flat&topic_id=74&forum=2

(2) 説明文にXOOPSコードを使用する/しないを選択可能にした
http://linux.ohwada.jp/modules/newbb/viewtopic.php?viewmode=flat&topic_id=454&forum=5

(3) RSS/ATOM記事を表示する/しないを選択可能にした
3027 Remove RSS
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=3027&group_id=1199&atid=974
http://linux2.ohwada.net/modules/newbb/viewtopic.php?post_id=274&topic_id=90&forum=2
http://linux.ohwada.jp/modules/newbb/viewtopic.php?viewmode=flat&topic_id=178&forum=5

(4) サブメニューにカテゴリ一覧を表示する/しないを選択可能にした
3515 dont show sub menu in man menu
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=3515&group_id=1199&atid=974
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=132&forum=2

(5) メインページにリンク一覧を表示する/しないを選択可能にした
3802 show NO link list on the top page
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=3802&group_id=1199&atid=974
http://linux2.ohwada.net/modules/newbb/viewtopic.php?viewmode=flat&topic_id=142&forum=2

(6) 「おすすめサイト」「相互リンク」を上位に表示する/しないを選択可能にした
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=336&forum=5

(7) 「リンク切れ報告」の使用する/しないを選択可能にした

(8) 「ヒット数」の使用する/しないを選択可能にした

(9) URLの表示形式を「間接表示」と「直接表示」を選択可能にした。
「間接表示」では、URLではなく、visit.php を表示する。
「直接表示」では、URLを表示し、JavaScript を経由してヒット数をカウントする。

(10) バナー・サイズを自動的に取得する/しないを選択可能にした。

２．リンク情報の登録・変更
(11) ゲストがパスワードを登録・変更することを可能にした

(12) ゲストの編集権限をパスワードで判定し、権限の無いゲストには編集画面を開かせないようにした
Anonymous user modify its own link
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=3419&group_id=1199&atid=974
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=121&forum=2

(13) 権限が無い場合は、「登録」「修正」ボタンを表示しないようにした
http://linux.ohwada.jp/modules/newbb/viewtopic.php?viewmode=flat&topic_id=388&forum=5

(14) リンク登録・変更時の項目名を変更可能にした
http://linux.ohwada.jp/modules/newbb/viewtopic.php?viewmode=flat&topic_id=261&forum=5

３．管理画面
(15) 管理画面のメニュー表示を一新した。

(16) 管理画面にカテゴリとリンクの一括登録を追加した
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=68&forum=5

４．テンプレート
(16) スタイルシートを採用した
(17) table タグを div タグに置き換えた
(18) ブレッド・クラムを追加した

５．その他
(19) 「印刷」ぺージを追加した

(20) title と url を255文字まで拡張した
3026 long title over 50 chars
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=3026&group_id=1199&atid=974
http://linux2.ohwada.net/modules/newbb/viewtopic.php?viewmode=flat&topic_id=87&forum=2

６．言語
(21) ドイツ語 (v0.90 対応)
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=168&forum=2


● データベース操作に関する実装方法の変更
従来のコードは、機能追加を繰り返したために、論理構造が複雑なスパゲッティ状態になっていました。
全面的にコードを書き直しました。
(1) データベース操作に関して、オブジェクト・クラスとハンドラ・クラスに分離しました。
(2) リンク情報に関して、直接的なデータベース操作と、情報の表示と登録・変更に必要な加工処理を、別のクラスに分離しました。
(3) クラスの相互関係が、クラスAからクラスBを呼び出し、クラスBからクラスAを呼び出すというように
複雑になっていた部分がありましたが、これを整理しました。


● アップデート
(1) weblinks ディレクトリ以下のファイルを上書きする。

多くのファイルでファイル名が変更されています。
上書きでは古いファイルが削除されずに残りますが、
運用には支障はありません。
気になる人は、いったんファイルのバックアップを取ってから、
ファイルを削除して、新しいファイルに置き換えてください。

(2) XOOPS管理画面より、weblinksモジュールのアップデートをする。
テンプレートを変更したので必ず実施のこと。

(3) weblinksモジュールの管理画面より、設定テーブルをアップデートする。
設定テーブルが最新版に対応していないときは、メッセージが出ます。

(4) 必要に応じて、テンプレートを変更する。
テンプレートの仕組みを変更しました。
テンプレートをカスタマイズして運用している場合は、
テンプレートの再カスタマイズが必要です。


● 注意
ほぼ全てのファイルを変更しています。
データベースのテーブル構造も若干変更しています。
大きな問題はないはずですが、小さな問題はあると思います。
何か問題が出ても、自分でなんとか出来る人のみお使いください。
バグ報告やバグ解決などは歓迎します。


● TODO
次の変更は「RSS Center モジュール」との連動を予定しています。


=================================================
Version: 1.02
Date:   2006-05-14
=================================================

● 主な変更内容
これは「モジュール複製」のベータ版です。
「モジュール複製」が不要な場合は v0.97 をお使いください。

バグ修正
(1) 3858 Fatal error when allow_url_fopen = off 
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=3858&group_id=1199&atid=971

(2) 3859 Parse error in atomfeed.inc.php 
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=3859&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=441&forum=5

(3) 3860 mysql error when guest report broken link
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=3860&group_id=1199&atid=971
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=154&forum=2

(4) 3922 Fatal error when use category image 
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=3922&group_id=1199&atid=971
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=161&forum=2


=================================================
Version: 1.01
Date:   2006-03-26
=================================================

● 主な変更内容
これは「モジュール複製」のベータ版です。
「モジュール複製」が不要な場合は v0.97 をお使いください。

要望
(1) REQ 3807: メインページに説明を表示する
Description in main page
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=3807&group_id=1199&atid=974

バグ修正
(1) 3743: 承認待ちのリンクが６つ以上のとき、fatal error が発生する
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=3743&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=427&forum=5

(2) 3746: サブメニューが正しく表示されない
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=3746&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=429&forum=5

(3) 3799: リンク切れにて Fatal error が発生する 
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=3799&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=433&forum=5

=================================================
Version: 1.00
Date:   2006-01-15
=================================================

● 主な変更内容
これはベータ版です。
今回の変更は「モジュール複製」の機能追加だけです。
TinyD モジュールなどで実装されているものと同じ機能です。
用意されているモジュール名は "weblinks"  "weblinks0" "weblinks1" "weblinks2" の４つです。

「モジュール複製」が不要な場合は v0.97 をお使いください。

● アップデート
(1) weblinks ディレクトリ以下のファイルを上書きする。

多くのファイルでファイル名が変更されています。
上書きでは古いファイルが削除されずに残りますが、
運用には支障はありません。
気になる人は、いったんファイルのバックアップを取ってから、
ファイルを削除して、新しいファイルに置き換えてください。

(2) XOOPS管理画面より、weblinksモジュールのアップデートをする。
テンプレートを変更したので必ず実施のこと。

(3) 必要に応じて、テンプレートを変更する。
テンプレートの仕組みを変更しました。
テンプレートをカスタマイズして運用している場合は、
テンプレートの再カスタマイズが必要です。

● 注意
ほぼ全てのファイルを変更しています。
データベース構造は変更していません。
大きな問題はないはずですが、小さな問題はあると思います。
何か問題が出ても、自分でなんとか出来る人のみお使いください。
バグ報告やバグ解決などは歓迎します。

● TODO
次の変更は「RSS Center モジュール」との連動を予定しています。


=================================================
Version: 0.97
Date:   2006-01-14
Author: Kenichi OHWADA
URL:    http://linux.ohwada.jp/
Email:  webmaster@ohwada.jp
=================================================

要望
(1) 3226: ATOM 1.0 の解析
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=3226&group_id=1199&atid=974
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=380&forum=5


バグ修正
(1) 3429: リンク誤り admin/link_broken_check.php
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=3429&group_id=1199&atid=971

(2) 3429: ソート誤り admin/link_list.php
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=3430&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?viewmode=flat&topic_id=399&forum=5


下記の言語パックを追加した
(1) スペイン語 新規 0.96対応
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=126&forum=2

(2) フランス語 更新 0.96対応
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=127&forum=2


=================================================
Version: 0.96
Date:   2005-11-20
=================================================

要望
(1) 3196: ダイレクト・リンク
snakes 氏によるハック
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=3196&group_id=1199&atid=974
http://www.xoops.org/modules/newbb/viewtopic.php?viewmode=flat&topic_id=42078&forum=15

バグ修正
(1) 3209: typo X-Mailer
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=3209&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?viewmode=flat&topic_id=378&forum=5


=================================================
Version: 0.95
Date:   2005-10-28
=================================================

要望
(1) 3028: ゲストに承認メールを送る
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=3028&group_id=1199&atid=974
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=107&forum=2
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=109&forum=2

(2) 3110: カテゴリから新規するときに、カテゴリを付加する
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=3110&group_id=1199&atid=974
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=112&start=0#forumpost374


バグ修正
(1) 3031: 承認待ちが多いと、タイムアウトする
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=3031&group_id=1199&atid=971
http://linux2.ohwada.net/modules/newbb/viewtopic.php?viewmode=flat&topic_id=106&forum=2
http://linux.ohwada.jp/modules/newbb/viewtopic.php?viewmode=flat&topic_id=351&forum=5

(2) 3032: "mutual site" は適切な英語ではない
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=3032&group_id=1199&atid=971
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=96&forum=2

(3) 3095: リンク切れ削除時に、表示件数が減らない
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=3095&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=342&forum=5

(4) 3106: RSSが相対リンクのときに、検出できない
http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=3106&group_id=1199&atid=971
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=108&forum=2

(5) 3108: allow_url_fopen = off にて、動作しない
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=3108&group_id=1199&atid=971
http://linux.ohwada.jp/modules/newbb/viewtopic.php?viewmode=flat&topic_id=349&forum=5

(6) 3111: カテゴリが多いと、人気リンクがタイムアウトする
http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=3111&group_id=1199&atid=971
http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=106&forum=2


追加・変更したファイル
xoops_version.php
submit.php
topten.php
admin/admin_functions.php
admin/admin_header.php
admin/broken.php
admin/category_manage.php
admin/link_manage.php
admin/modify.php
admin/table_check.php
class/class.rss_atom_parser_base.php
class/table_modify.php
class/remote_file.php
class/rss_atom_collect.php
include/function.php
include/submit_form.php
templates/weblinks_topten.html
templates/weblinks_topten_mixed.html
templates/weblinks_header.html

language/english/admin.php
language/english/main.php
language/english/modinfo.php
language/english/mail_template/link_approve_notify_anon.tpl
language/english/mail_template/link_refusued_notify.tpl
language/english/mail_template/link_wating_notify.tpl

language/japanese/admin.php
language/japanese/main.php
language/japanese/modinfo.php
language/japanese/mail_template/link_approve_notify_anon.tpl
language/japanese/mail_template/link_refusued_notify.tpl
language/japanese/mail_template/link_wating_notify.tpl


=================================================
Version: 0.94
Date:   2005-09-06
=================================================

要望
(1) 2933 検索画面のエラーが分かりにくい
  http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=319&forum=5

バグ修正
(1) 2863 「モジュールの設定２」にて、Fatal error となり、「RSS/ATOMの設定」が表示されない。
  http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=310&forum=5

(2) 2929 リンクを登録せずにランダムジャンプをすると、無限ループする
  http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=317&forum=5

(3) 2931 ポップアップメニューとメニューで表示が一致していない
  http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=318&forum=5

(4) 2932 register_long_arrays = off のとき動作しない
  http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=326&forum=5

(5) 2946 allow_url_fopen = off のとき動作しない


=================================================
Version: 0.93
Date:   2005-08-09
=================================================

バグ修正
(1) 2790 RSS/ATOM 対応サイトが表示されない
  http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=294&forum=5

(2) 2793 致命エラーが表示される _print_sql_error()
  http://dev.xoops.org/modules/xfmod/tracker/?func=detail&aid=2793&group_id=1199&atid=971

(3) 2827 RSS/ATOMのキャッシュ更新にて、Warning エラーが出る
  Invalid argument supplied for foreach() 
  http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=301&forum=5

(4) 2828 リンク登録フォームが正しく表示されない
  http://dev.xoops.org/modules/xfmod/tracker/index.php?func=detail&aid=2828&group_id=1199&atid=971


=================================================
Version: 0.92
Date:   2005-07-18
=================================================

バグ修正
(1) 2150 リンク変更が出来ない
  http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=186&forum=5
(2) 2158,2290 リンク切れのとき非表示がならない
  http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=190&forum=5
(3) 2300 パラメータが0のとき、全てのサブカテゴリを表示する。
  http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=195&forum=5
(4) 2402,2410 管理者画面でページナビが正しく動かない
  http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=203&forum=5
(5) 2409 ゲストがリンクの評価をできない
  http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=70&forum=2
(6) 2670,2698 PHP5のとき redeclare エラーがでる。
(7) 2707 説明にBBコードが表示される 
  http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=260&forum=5
(8) 2772 このリンクが承認された場合に通知するにしてもメールが届かない
  http://linux.ohwada.jp/modules/newbb/viewtopic.php?topic_id=283&forum=5
(9) 2773 リンク修正のとき _WLS_MODIFY が表示されない

変更
(1) admin/tool に検証用のプログラムを追加した
(2) doc に マニュアルを追加した

下記の言語パックを追加した
(1) フランス語
(2) ペルシャ語
  http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=53&forum=2
(3) ポルトガル語(ブラジル)
  http://linux2.ohwada.net/modules/newbb/viewtopic.php?topic_id=76&forum=2


=================================================
Version: 0.91
Date:   2005-02-03
=================================================

バグ修正
(1) class/weblinks_pagenavi.php にて Call-time pass-by-reference の警告が出る
(2) 地図サイト Mapfan へのリンクが出来ない
(3) テンプレートにて W3C Validator へ対応していないところがあった

変更
(1) 「RSS/ATOM記事の自動更新」をいいえにすると、
  詳細表示のときに RSS/ATOM記事の自動検出と自動更新も行わないようにした。
  次バージョンでは、モードを細かく設定できるようにする予定。

=================================================
Version: 0.9
Date:   2005-01-20
=================================================

本モジュールは、mylinks をベースに大幅に機能追加したものです。
mylinks に対して上位互換性があります。

● 0.89版 からの主な変更点

１．セキュリテイ
allow_url_fopen off に対応した。
cache ディレクトリを書込み可能にしてください。
画像サイズを取得する際に、画像データを一時的に格納します。


２．RSS/ATOM
２．１ RSS/ATOMの自動検出
表示は未使用だが機能は自動検出だったが、
未使用 と 自動検出 を設けて、
登録・変更のときに選択できるようにした。

２．２ 不備なRSSへの対応
(1) タイトルがないものは、「---」を表示するようにした。
(2) 時刻が未来のものは、表示するときに、３日以上未来のものを省くようにした。

２．３ 表示
RSS/ATOM記事のページを RSS自動検出に対応した。
Firefox のRSSモードに対応した。

現行のXOOPSでは使用できません。
対処方法は「XOOPSコアの変更が必要なところ」を読んでください。

２．４ ブロック
新着RSS/ATOM記事に、RSSとATOMのアイコンを追加した。

２．５ 管理者画面
下記を追加した

(1) HTMLタグの有効・無効
初期値は無効。
従来は有効だったので、バージョンアップのときは設定変更してください。

(2) 保管する記事の数の上限
初期値は 1000。

(3) BulkFeedなどRSS検索サイト
初期値は空欄。
デフォルト値を選択すると、キーワード「xoops」が設定される。


３．リンク登録・変更
(1) 項目毎に 未使用・使用・必須を選択できるようにした。

(2) 郵便番号、都道府県、市町村を追加した。
バージョンアップのときは、初期値は未使用となります。


４．表示とテンプレート
(1) HTMLのTITLEタグに、カテゴリ名やリンクのタイトル名を表示した。

(2) モジュールのタイトルを、言語ファイルから管理者が設定したものに変更した。

(3) NEWマークを表示する日数を指定できるようにした。
０を指定すると、NEWマークを表示しない。

(4) 下段に表示するページ・ナビを、最大10ページに制限した。
10ページを超えたときは、前後10ページを表示する。

(5) テンプレート weblinks_serachform.html を廃止して、
weblinks_header.html を追加した。

(6) リンク表示のテンプレートに、サイトのURLをアサインした。
現行では使用していない。

(7) W3C Validator に合格するようにした
http://validator.w3.org/

５．ブロック
(1) 高評価リンクのテンプレートを追加した。
人気リンクと同じテンプレートだったが、別にした。
バージョンアップのときは、正しく設定できないことがあります。
対処方法は「バージョンアップにより従来と変わるところ」を読んでください。

(3) 新着リンクにて、リンク画像を表示するようにした。

(4) 新着リンクのパラメータに、NEWマークを表示する日数と、POPULARマークを表示するヒット数を追加した。

(5）新着リンクのテンプレートに、サイトのURLとコメント数をアサインした。
現行では使用していない。


６．管理者画面
６．１ メール送信機能を追加した
Ｅメールアドレスを登録してあるリンク情報の一覧を表示する。
そのユーザに対して、メールを送信する。

メールのタイトルが文字化けすることがあります。
対処方法は「XOOPSコアの変更が必要なところ」を読んでください。

６．２ テーブルの整合性をチェックする機能を追加した
link, category, callink テーブル間の整合を検査する


７．英語版に対応した
７．１ 英語の言語ファイルを追加した

７．２ 言語ファイルでは対応できないもの
(1) 住所の並び
日本式は 都道府県など大きなほうから、英語式はストリ−トなど小さい方から表示する。テンプレートに２種類を記述して使用言語で選択した。

(2) 地図サイトへのリンク方法、
http://search.map.yahoo.co.jp/ と http://maps.yahoo.com/ では異なる。
yahoo.co.jp では住所だけでよいが。
yahoo.com では、ZIPコード、州、市 を別に指名する必要がある。
登録するリンク情報にそれらを追加した。
テンプレートに２種類を記述して使用言語で選択した。

(3) 検索サイト
http://googole.co.jp/ と http://googole.com/ のように言語により異なる。
言語別ファイルで対応した。

(4) RSS検索サイト
日本では、BulkFeed など検索結果をRSS配信するサイトがある。
http://bulkfeeds.net/

英語では、その種のものが見つからなかった。
初期値は空欄とした。
デフォルト値を選択したときに、使用言語で設定するようにした。


８．実装
下記のファイルを追加した
class/class.image_size.php
class/remote_file.php
class/weblinks_pagenavi.php
class/weblinks_mailer.php
admin/user_list.php
admin/mail_users.php
admin/table_check.php
admin/my11_to_web09.php


９．バグ修正
(1) リンクを削除するときに、callinkテーブルから削除する処理が漏れていた
(2) RSS配信の時刻が ATOM形式 だった
(3) HOTマークが表示されない
(4) RSS/ATOM記事の更新後に表示されるリンク修正のURLが正しくない
(5) weblinks_topten.html などの誤記


● インストール
(1) 解凍すると、「weblinks」というディレクトリが出来る。
(2) XOOPS管理画面より、モジュールのインストールをする。

● コマンドライン
コマンドラインは、cron から定期的に実行することを想定しています。
不要であれば、bin ディレクトリを削除してください。

コマンドラインから「リンク切れ検査」などを実行する場合は。

(1) cache ディレクトリ を書き込み可能にする。

(2) Weblinksの管理者画面より、「その他の機能」 -> 「create config file for bin」 を実行する。

(3) 下記のプログラム・ファイルの $XOOPS_ROOT_PATH を自分の環境に合わせて変更する。
・bin/link_check.php
・bin/rss_refresh_link.php
・bin/rss_refresh_site.php

(4) 注意
このプログラムは誰もが実行できます。
悪戯されたくなければ、プログラム名を変更し、cron のユーザにだけ実行権限を与えてください。


● XOOPSコアの変更が必要なところ
(1) XOOPS を RSS自動検出 に対応する
拙作の XOOPS header.php ハック版を併用ください。

viewfeed.php 40行目にある下記のコメントをはずしてください。
-----
//$xoopsTpl->assign('lang_atomfeed_firefox', _WLS_ATOMFEED_FIREFOX);
-----

(2) メールのタイトルが文字化けする
XOOPSのバグに起因するものです。
拙作の XOOPS xoopsmultimailer.php ハック版を併用ください。


● mylinks からの移行
移行ツールを用意した。

(1) mylinks のテーブルを整理する
(2) weblinks の cache ディレクトリを書込み可能にする
(3) weblinks の管理者画面より、「その他の機能」 -> 「transfer DB mylinks v1.1 to weblinks v0.9」 を実行する。

下記のものがコピーされます。
・スナップショット画像
・category テーブル
・links テーブル
・votedata テーブル
・XOOPSの comments テーブルから mylinks のもの

下記のものはコピーされません。
・modify テーブル
・broken テーブル

(4) 互換性のないところ
mylinks では スナップショット画像 の登録は、スナップショット用のディレクトリにある画像から選択する方式になっていました。
weblinks ではURLを指定する方式に変更しました。
mylinks から移行した画像の指定は
「http://***/modules/weblinks/images/shots/xxx」
のようになります。
移行ツールでは自動的に変換します。


● バージョンアップ手順
１．モジュールのアップデート
(1) データベースを変更するので、事前に「バックアップ」してください。
(2) 解凍すると、「weblinks」というディレクトリが出来る。
(3) XOOPS管理画面より、モジュールのアップデートをする。

(4) データベースのアップデート
Weblinksの管理者画面より、「その他の機能」 -> 「update v0.8 to v0.9」 を実行する。
- config テーブルを削除・追加する
- atomfeed テーブルを追加する
- link テーブルの rss_xml を text から mediumtext に変更する

v0.89、v0.891 からバージョンアップする場合も実行してください。
エラー・メッセージが出ますが、すでに変更されている項目ですので、無視してください。


● バージョンアップにより従来と変わるところ
１．config テーブルを上書する

２．RSS/ATOM記事のHTMLタグは、初期値では無効となる。

３．高評価リンクが、正しく表示できないことがある。
XOOPSのバグに起因するものです。
対処方法は１つあります。

３．１ 対処１
従来通りに人気リンクと同じテンプレート使用する。

xoops_version.php の 155行目を変更する

変更前
-----
//$modversion['blocks'][3]['template']  = $MODULE_DIRNAME."_block_top.html";
$modversion['blocks'][3]['template']  = $MODULE_DIRNAME."_block_rate.html";
-----

変更後
-----
$modversion['blocks'][3]['template']  = $MODULE_DIRNAME."_block_top.html";
//$modversion['blocks'][3]['template']  = $MODULE_DIRNAME."_block_rate.html";
-----

３．２ 対処２
XOOPSの tplfile テーブルを修正する。

(1) モジュールのアップデートの際に表示される下記のメッセージから、
高評価リンクのBlock IDを確認する。
-----
Rebuilding blocks...
  Block 高評価リンク updated. Block ID: xxx
-----

(2) tplfile テーブル から tpl_refid 項目が Block ID と一致するレコードを選択して、
tpl_file 項目を weblinks_block_top.html から weblinks_block_rate.html に変更する


=================================================
Version: 0.89
Date:   2004-12-23
Author: Kenichi OHWADA
URL:    http://linux.ohwada.jp/
Email:  webmaster@ohwada.jp
=================================================

● 0.8版 からの主な変更点
１．RSS/ATOM
１．１ RSS/ATOM 対応サイト を追加した

１．２ RSS/ATOM 記事 を追加した
テーブル atomfeed を追加した
日付の新しい順から表示する
表示しているRSS/ATOM 記事を、再度 RSSとATOM で配信します。

１．３ ブロック
(1) 新着RSS/ATOM記事のブロックを追加した

(2) blog表示のブロックを追加した
特定のリンク(blog)のRSS/ATOM記事を表示する

(3) カスタム・ブロック用にblog表示を追加した
カスタム・ブロックから
includes/atomfeed.in.php
を呼び出す

１．４ 管理者画面
(1) RSS/ATOM記事の更新を追加した
RSS/ATOM 対応サイトを巡回して、RSS/ATOM記事を更新する。

(2) RSS/ATOMのキャッシュ・クリアを追加した
管理者だけが使用できます。
全てか、特定のリンクの、キャッシュをクリアする。

(3) リンク切れの検査
同時に、RSS/ATOMの自動検出を行うようにした

１．５ コマンドライン・モード
(1) RSS/ATOM記事の更新を追加した

(2) リンク切れの検査
同時に、RSS/ATOMの自動検出を行うようにした


２．リンク登録・変更
プレビューを追加した


３．管理者画面
３．１ モジュールの設定２を追加した
(1) アクセス権限の設定を追加した
「サイトを評価する」権限を追加した。
「新規リンク登録」と「リンク変更」の権限の設定方法を変更した。

(2) RSS/ATOMの設定を追加した
ブラックリストとホワイトリストを追加した

３．２ カテゴリの管理を追加した
(1) 下記を表示する
- ID 順
- ツリー順
- カテゴリの並び順

(2) カテゴリの並び順の変更を追加した

３．３ リンクの管理を追加した
(1) 下記を表示する
- 全てのリンクの一覧表示（ID 順）
- 全てのリンクの一覧表示（ID 逆順）
- URLが設定されていないリンクの一覧表示 

(2) リンクの変更･削除へのメニューを追加した


４．テーブル
(1) config テーブルを追加した
(2) atomfeed テーブルを追加した

(3) link テーブル
rss_xml を text から mediumtext に変更した


５．実装方法
実装方法を大きく変更した

(1) 下記のクラスを追加した
- module_base.php
- table_config.php
- table_atomfeed.php
- table_link_base.php
- rss_atom_builder.php
- xoops_form_extend.php

(2) テーブル操作のクラスを module_base.php から継承するようにした


=================================================
Version: 0.81
Date:   2004-11-19
=================================================
バグ修正
(1) ATOMの日付が表示されない。
(2) topten.phpで「評価」が表示しない。
(3) リンク登録時に「管理者へのコメント」が保存されてない。
(4) リンク登録時に URLが80文字で制限される。
(5) weblinks_singlelink.html に不要な </div> がある。
(6) 管理者画面のポップアップ・メニューが古い。 

変更
(1) 各カテゴリにて、勧めサイトと相互サイトを上位に表示する。
(2) リンク一覧でも、BBコードが使用できるようにした。
(3) 一般設定の「カテゴリ表示にカテゴリ画像を使用する」の初期値を「いいえ」にした。


=================================================
Version: 0.8
Date:   2004-10-24
=================================================

本モジュールは、mylinks を大幅に変更したものです。
このバージョンでは、mylinks と互換性がありません。
機能的には、myklinks と yomi-search の中間くらいです。

● 0.7版 からの主な変更点
１．おすすめサイトと相互リンクサイトを追加した
管理者だけが使用できます。
yomi-search と同様の機能です。

２．ランダムジャンプを追加した
yomi-search と同様の機能です。

３．リンク切れ検査を追加した
３．１ リンク切れ検査
管理者だけが使用できます。
リンク切れであれば、リンク・テーブルの「リンク切れカウンタ」を更新します。
カウンタの数値が規定値になると、リンクの表示を止めます。

３．２ リンク切れ一覧表示
管理者だけが使用できます。
一覧表示から、リンク修正、WEBサイト名のgoogle検索、ウェブサイトURLの表示が出来ます。

３．３ コマンドライン・モード
コマンドラインからリンク切れ検査が実行できます。

４．RSS/ATOMのURL を追加した
４．１ RSS/ATOMのURL
登録項目に RSS/ATOMのURL を追加した。
リンク詳細表示のときに、RSS/ATOM を解析して表示する。

４．２ 「RSS/ATOM Auto Discovery」に対応した
登録されたリンクが「RSS/ATOM Auto Discovery」に対応してると、
リンク詳細表示のときに、RSS/ATOMのURL を自動検出し、
RSS/ATOM を解析して表示する。

５．地図サイトへのリンクを追加した
住所が登録されているときは、地図サイト（yahoo）へのリンクが表示されます。

６．URLなしモードを追加した
リンク先のない住所録としても使えます。

７．スタイル関連
カテゴリー・パスの表示スタイルを、テンプレートにて、変更可能にした。

８．Ryuji さん寄贈のハック
(1) カテゴリ一覧ブロックを新設した
  サブカテゴリの表示件数が設定可能

９．Tom_G3X さん寄贈のハック
(1) Submenu に第一階層のカテゴリを表示する
(2) メインのカテゴリ一覧にて、サブカテゴリの表示件数を設定可能にする

１０．英語版の対応
cb750さんの寄贈の言語パックを追加した

１１．バグ修正
(1) 管理者画面の「リンク一覧表示にリンク画像を使用する」と「リンク詳細表示にリンク画像を使用する」が個別に設定できない。
(2) 新規登録の「このリンクが承認された場合に通知する」が動作しない。 


● バージョンアップ手順
(1) データベースを変更するので、事前に「バックアップ」してください。
(2) 解凍すると、「weblinks」というディレクトリが出来る。
(3) XOOPS管理画面より、モジュール・インストールをしてください。

(4) Weblinksの管理者画面より、「その他の機能」 -> 「update v0.7 to v0.8」 を実行する。
- link テーブルに recommend, mutual, その他の項目が追加される。

(5) コマンドラインから「リンク切れ検査」を実行する場合
cache ディレクトリィ を書き込み可能にする。
Weblinksの管理者画面より、「その他の機能」 -> 「create config file for bin」 を実行する。
bin/link_check.php の $XOOPS_ROOT_PATH を自分の環境に合わせて変更する。


=================================================
Version: 0.71
Date:   2004/08/18
=================================================
パッチ
(1) カテゴリが削除できないバグを修正した
(2) カテゴリを削除するときに、一緒に削除できるサブカテゴリ数とリンク数に制限を設けた
(3) 「カテゴリの追加／修正／削除」に削除のメニューを追加した


=================================================
Version: 0.7
Date:   2004/08/10
=================================================

本モジュールは、mylinks を大幅に変更したものです。
このバージョンでは、mylinks と互換性がありません。
機能的には、myklinks と yomi-search の中間くらいです。

● 0.6版 からの主な変更点
１．性能改善
１．１ カテゴリとリンクの関連付け
機能には変更がないが、実装方法を変更した。
従来は、link テーブルにカテゴリ情報を持っていた。
今回は、catlink テーブルを新設し、
カテゴリとリンクの関連付けを行った。
リンク数1000件で、表示速度が約２倍になった。

１．２ バナー画像の画像サイズ
従来は、表示するときに、リモートから毎回取得していた。
１件取得するのに、0.5秒程度かかっていた。
今回は、リンク情報の登録・変更時に link テーブル内に格納した。
10件で、表示速度が５秒程度 短縮された。

２．このモジュールを２つ以上インストールする
デバック用途です。
なるべく少ない変更で出来るようにした。
ほぼ全てのファイルに変更があります。

３．リンク登録・変更の画面
３．１ テンプレート から XoopsThemeForm に変更した。
プログラムとテンプレートの両方を変更するのが面倒になったため。
登録・変更の画面を変更するというニーズは少ないと思う。

３．２ プレビュー・モード
作りかけで中断した。
プログラムに痕跡が残っています。

４．ブロック
(1) 人気ブロックを追加した。

(2) 「新着マーク」を表示した。
「人気マーク」は表示すると、五月蝿かったので、コメント化してある。

「XOOPS入門」にある龍司さんの plugin を使う方がスマートかも。

５．同じリンク先の投稿を許可するモードを新設した

６．下記のバグを修正した
(1)「友達に紹介」が文字化けするを対策した。
複数言語対応のクラスを新設した
「友達に教える」でEUC-SJIS変換を行った

(2) １つのリンクに同じカテゴリが重複して登録できる 
重複チェックを追加した。

(3) 高評価ブロックが正常に動作しない 

● バージョンアップ手順
(1) データベースを変更するので、事前に「バックアップ」してください。
(2) 解凍すると、「weblinks」というディレクトリが出来る。
(3) XOOPS管理画面より、モジュール・インストールをしてください。

(4) admin/up06to07.php を実行する。
- catlink テーブルが作成される。
- link テーブルに画像サイズの項目が追加される。

● 注意
大規模な変更になったので、デグレしているかも。(^^;

まだ 0.7版という未完成版です。
私の設定環境では、順調に稼動しています。
それ以外の設定環境は、きちんとデバックしていません。
何か問題が出ても、自分でなんとか出来る人のみお使いください。
バグ報告やバグ解決のフィードバックは歓迎します。


=================================================
Version: 0.6
Date:   2004/01/24
=================================================

● 0.5からの主な変更点
１．リンクの新規登録
ゲストは管理者承認で、登録者は自動承認という設定を可能とした。

２．リンクの変更登録
ゲストは変更不可で、登録者は管理者承認で、投稿者は自動承認という設定を可能とした。

３．mylinks で出来て、weblinks で出来なかった下記の２項目に対応した。
・管理者がスクリーンショット画面を登録する 
・登録者は認証なしで変更画面になる

４．下記のバグを修正した
・「このサイトを評価する」が反映されない 
・登録変更時にスマイル・マークが反映されない
・１つのリンクのカテゴリが４つ登録されているとき、
カテゴリ数の設定値を３に減らすと、４つのうち１つが変更できなくなる。 
・viewcat.php で該当する記事がないときは、最新記事を表示するはずだが、
記事が１つのときは、表示しない。
・登録時にＥメールアドレスの公開する・公開しないが反映されない  

●注意
前回と同じように、0.6版という未完成版です。
私の設定環境では、順調に稼動しています。
それ以外の設定環境は、きちんとデバックしていません。
何か問題が出ても、自分でなんとか出来る人のみお使いください。
バグ報告やバグ解決のフィードバックは歓迎します。


=================================================
Version: 0.5
Date:   2004/01/14
=================================================
●仕様上の主な変更点
１．1つのリンクが選択できるカテゴリ数
　任意の数が可能。デフォルトは４。 

２．リンク画像
　利用者がバナー画像を登録できる。

３．リンクの項目
　名前、メルアド、住所、電話番号を追加した。 

４．利用者が意識しないリンクの項目
４．１　パスワード
　登録・変更時の自動的に暗号化パスワードが付加される。
　利用者は意識しない。
　管理者も平文パスワードは分からない。
　忘れたときの問合せ時は、新しいパスワードを再発行する。

４．２　サーチ
　各項目から検索対象となるテキストを結合する 

５．最新記事の表示
　index.php で最新記事を表示するとき、要約した形式で表示する。
　viewcat.php で該当する記事がないときは、最新記事を表示する。

６．登録変更
６．１　変更権限の判定
　uid認証とパスワード認証を追加した。
　uid認証とは、リンク・データ毎のuidと一致するか。
　パスワード認証とは、リンク・データ毎のパスワードと一致するか。

　最初に、uid認証を行います。
　管理者ならば、管理者変更画面へ。
　一致すれば、投稿者とみなし、変更画面へ。
　不一致ならば、パスワード入力画面へ。

　次に、パスワード認証を行います。
　一致すれば、変更画面へ。
　不一致ならば、再度パスワード入力画面へ。

　パスワードを忘れたときは、問合せができます。

６．２ 自動承認
　変更要求に対し、管理者を介在しない自動承認を追加しました。

●実装上の主な変更点
１．クラス関数
SQLに関するところをクラス関数にまとめました。
ソースを読む人には分かりやすくなったと思います。

●mylinks との互換性
現バージョンは、いろいろな点で、mylinks と互換性がありません。
完全な上位互換は考えていませんが、なるべく機能互換を保つつもりです。

１．mylinks で出来て、weblinks で出来ないこと
・管理者がスクリーンショット画面を登録する 
・登録者は認証なしで変更画面になる

２．バグも残っています。
・「このサイトを評価する」が反映されない 
・登録変更時にスマイル・マークが反映されない 
・新規登録の「このリンクが承認された場合に通知する」が動作しない 

３．mylinks からの移行ツール
admin/porting.php を実行すると、
mylinks のDBの中身が weblinks にコピーされる

●インストール手順
解凍すると、「weblinks-05」というディレクトリが出来る。
これを、「weblinks」に変更する。
その後、XOOPS管理画面より、モジュール・インストールをしてください。

●注意
今回は0.5版という未完成版です。
いちおう、私の設定環境では、順調に稼動しています。
それ以外の設定環境は、きちんとデバックしていません。
何か問題が出ても、自分でなんとか出来る人のみお使いください。
バグ報告やバグ解決のフィードバックは歓迎します。

