# 作業ログ

## 2026-09-03 最近の買取実績カード画像を全体表示へ変更

- 状態: 完了
- 実施内容: 最近の買取実績セクションで使う共通カードのサムネイルを、アスペクト比を維持したまま4:3の画像エリア内へ最大サイズで収める表示へ変更。`object-fit: cover` によるトリミングを廃止し、画像エリアの背景を #f3f3f3 に設定した。
- 主な変更ファイル: `theme/buybuycoms-hobby/asset/css/tokens.css`、`theme/buybuycoms-hobby/asset/css/component.css`、`WORK-LOG.md`
- 未完了事項: WordPress実行環境で、縦長・横長の買取実績画像を含むカード表示確認。
- 次回の着手点: 最近の買取実績セクションで画像全体が見えることをPC・モバイルで確認する。

## 2026-09-03 コラム詳細のジャンルリンクカード画像を全体表示へ変更

- 状態: 完了
- 実施内容: コラム詳細下部の「◯◯をまとめて高価買取」ジャンルリンクカードで、画像エリアを4:3に固定し、サムネイルをアスペクト比を維持したまま最大サイズで収める表示へ変更。`object-fit: cover` によるトリミングを廃止し、横組み時の画像エリアはカード高の中央へ揃える。
- 主な変更ファイル: `theme/buybuycoms-hobby/asset/css/component.css`、`WORK-LOG.md`
- 未完了事項: WordPress実行環境で、縦長・横長のジャンル画像を含む表示確認。
- 次回の着手点: コラム詳細ページをPC・モバイルで確認し、画像エリア内でサムネイル全体が見えることを確認する。

## 2026-08-04 ヘッダー・フッターロゴのテキストを固定化

- 状態: 完了
- 実施内容: 共通ロゴのサービス名とサブテキストを、WordPressのサイトタイトル・キャッチフレーズ設定ではなく「売買コムズ」「hobbyベース」の固定文言へ変更。カスタムロゴ設定による差し替えも使用せず、ヘッダーとフッターで同じロゴ表示を維持する。
- 主な変更ファイル: `theme/buybuycoms-hobby/inc/template-functions.php`、`WORK-LOG.md`
- 未完了事項: WordPress実画面でヘッダー・フッターのロゴ表示確認。
- 次回の着手点: サイトタイトル・キャッチフレーズやカスタムロゴを変更しても、ロゴの表示文言が変わらないことを確認する。

## 2026-08-04 お問い合わせフォームの管理メニュー名を短縮

- 状態: 完了
- 実施内容: 管理画面のトップレベルメニュー表記を「お問い合わせフォーム」から「問合せフォーム」へ変更。設定画面のページタイトルは従来表記を維持した。
- 主な変更ファイル: `theme/buybuycoms-hobby/inc/contact-form.php`、`WORK-LOG.md`
- 未完了事項: WordPress管理画面でのメニュー表記確認。
- 次回の着手点: 管理画面を再読み込みし、外観の直前に「問合せフォーム」と表示されることを確認する。

## 2026-08-04 purchase-price CSVからの新規作成に対応

- 状態: 実装完了（WordPress実機での新規作成確認は未実施）
- 実施内容: `post_id` が空欄のCSV行を新規 `purchase-price` として公開作成できるよう拡張。タイトルと既存genreを必須とし、同名投稿、CSV内の新規タイトル重複、存在しないgenreを検証。確認画面で新規／更新を区別し、新規作成失敗時は同じ処理内で作成済みの投稿を取り消す。
- 主な変更ファイル: `theme/buybuycoms-hobby/inc/purchase-price-csv.php`、`theme/buybuycoms-hobby/README.md`、`WORK-LOG.md`
- 未完了事項: 新規1件・複数件、既存更新との混在、複数genre、同名タイトル、存在しないgenre、作成失敗時の実環境確認。
- 次回の着手点: DBバックアップ後、post_id空欄のテスト行を追加したCSVを検証・確定し、投稿、genre、ACF値、公開画面を確認する。

## 2026-08-04 purchase-price CSVへgenre列を追加

- 状態: 実装完了（WordPress実機でのCSV確認は未実施）
- 実施内容: CSVダウンロード、アップロード検証、確認表へ `genre` 列を追加。複数ジャンルは名前を安定順に並べて ` | ` で区切る。genreは参照・照合項目とし、CSVからは更新せず、投稿ID・タイトルと同様にDBとの不一致を検出する。
- 主な変更ファイル: `theme/buybuycoms-hobby/inc/purchase-price-csv.php`、`WORK-LOG.md`
- 未完了事項: ジャンルなし・単一・複数ジャンルのCSV出力と再アップロード確認。
- 次回の着手点: 管理画面から新形式CSVを再ダウンロードし、genre列を変更せずに検証・更新できることを確認する。

## 2026-08-04 purchase-priceのCSV一括更新機能を実装

- 状態: 実装完了（WordPress実機での入出力確認は未実施）
- 実施内容: 管理画面に「買取価格CSV」を追加し、`purchase-price` の投稿ID、タイトル、genre、買取強化フラグ、最小価格、最大価格をUTF-8 BOM付きCSVで出力可能化。アップロード時は投稿ID・タイトル・genre・投稿タイプ・重複・列・フラグ・価格範囲・最小最大の整合性を全件検証し、確認後に3つのカスタムフィールドだけを一括更新する二段階処理を実装。エラーが1件でもあればDBへ反映しない。
- 主な変更ファイル: `theme/buybuycoms-hobby/inc/purchase-price-csv.php`、`theme/buybuycoms-hobby/functions.php`、`WORK-LOG.md`
- 未完了事項: WordPress実環境でのCSVダウンロード、Excel編集、UTF-8／Excel由来CSVのアップロード、エラー表示、確定更新、ACF画面への反映確認。CSVからの新規作成は今回の対象外。
- 次回の着手点: バックアップ取得後、正常CSVと価格範囲外・ID不一致・タイトル不一致・重複ID・最小最大逆転の各CSVで検証する。

## 2026-08-04 お問い合わせメールを項目別タグへ対応

- 状態: 実装完了（WordPress実機でのメール表示確認は未実施）
- 実施内容: `[details]` にまとめていた買取方法別の入力値を、数量、段ボール準備、S〜LLサイズ、希望日時の個別メールタグとして利用可能化。CF7風のメールタグ一覧を管理画面へ表示し、既定の管理者宛本文を「見出し：値」形式へ変更。既存の旧タグと `[details]` は互換性のため維持した。
- 主な変更ファイル: `theme/buybuycoms-hobby/inc/contact-form.php`、`WORK-LOG.md`
- 未完了事項: 宅配・出張・持込それぞれのテスト送信と、空の任意項目を含むメール表示の確認。
- 次回の着手点: 管理画面でタグ一覧と本文保存を確認後、3種類の買取方法で管理者宛・入力者宛メールを確認する。

## 2026-08-04 お問い合わせフォーム設定を独立メニューへ移動

- 状態: 完了
- 実施内容: 管理画面の「外観」配下にあった「お問い合わせフォーム」をトップレベルメニューへ変更し、「外観」の直前に表示される位置へ移動。既存の権限、設定画面、保存処理は維持した。
- 主な変更ファイル: `theme/buybuycoms-hobby/inc/contact-form.php`、`WORK-LOG.md`
- 未完了事項: WordPress管理画面でメニュー位置、アイコン、設定保存を実画面確認する。
- 次回の着手点: 管理者権限で「お問い合わせフォーム」が「外観」の1つ上に表示され、既存設定を保存できることを確認する。

## 2026-08-04 現状に合わせて進捗資料を更新

- 状態: 完了
- 実施内容: 7月31日時点で止まっていたテーマREADMEと進捗資料を、買取実績・価格表・ジャンルフィルター・お問い合わせ送信機能の実装状況へ同期。完了チェックリストの検証日と備考も更新し、実装済み項目と実環境での確認待ちを区別した。
- 主な変更ファイル: `theme/buybuycoms-hobby/README.md`、`theme/buybuycoms-hobby/PHASE-1-STATUS.md`、`THEME-COMPLETION-CHECKLIST.md`、`WORK-LOG.md`
- 未完了事項: WordPress実環境での境界値、SMTPメール配送、PC・モバイル、複数ブラウザ、公開前確認。
- 次回の着手点: `THEME-COMPLETION-CHECKLIST.md` に沿ってLocal実画面の未確認項目を消化する。

日をまたぐ作業をスムーズに再開するため、各作業の終了時に要点だけを記録します。
細かな変更履歴はGitに任せ、このログには判断内容、進捗、未完了事項、次の着手点を残します。

## 2026-07-31 お客様の声セクションの空状態対応

- 状態: 完了
- 実施内容: お客様の声の共通パーツを先にレンダリングし、該当する `review` 投稿が0件の場合は見出しや余白を含むセクション全体を出力しないよう変更。トップ、買取方法、ジャンル一覧、買取実績一覧、買取実績詳細へ適用し、対応済みのジャンルページと挙動を統一。
- 主な変更ファイル: `theme/buybuycoms-hobby/front-page.php`、`theme/buybuycoms-hobby/page-flow.php`、`theme/buybuycoms-hobby/page-genre-list.php`、`theme/buybuycoms-hobby/archive-purchase-record.php`、`theme/buybuycoms-hobby/single-purchase-record.php`
- 未完了事項: WordPress実画面でレビュー0件・1件以上、ジャンル一致・不一致の各状態を確認。
- 次回の着手点: 全レビュー非公開時と、詳細ページのジャンルに一致するレビューがない状態で、`#reviews` セクションがHTMLへ出力されないことを確認する。

## 記録形式

```md
## YYYY-MM-DD：作業名

- 状態：完了／作業中／保留
- 実施：行ったこと
- 変更：主な変更ファイル（変更がない場合は「なし」）
- 未完了：残っていること（ない場合は「なし」）
- 次回：次に着手すること
```

## 2026-07-31：作業ログ運用の開始

- 状態：完了
- 実施：今後の作業ごとに簡単な進捗記録を残す方針を決定
- 変更：`WORK-LOG.md`、`AGENTS.md`
- 未完了：なし
- 次回：次の実作業終了時に、その進捗と再開地点を追記する

## 2026-07-31：取り扱い品目カードのDB接続

- 状態：完了
- 実施：`genre` の全タームを取得し、画像 `genre-thumb`、ターム名、説明文 `genre-excerpt` からカードを動的生成
- 変更：`template-parts/common/genre-table.php`、`asset/css/component.css`
- 未完了：実際のWordPress環境におけるタームデータと表示の確認
- 次回：TOPでカード数、画像、リンク、未設定項目の表示を確認する

## 2026-07-31：TOP買取実績カードのDB接続

- 状態：完了
- 実施：`purchase-record` の最新8件を取得し、画像、タイトル、説明、買取日・エリア、下限・上限金額をカードへ接続
- 変更：`template-parts/front/purchase-records.php`、`front-page.php`、`asset/css/component.css`
- 未完了：実際のWordPress環境における投稿データと表示の確認
- 次回：TOPで8件表示、画像、詳細リンク、金額未入力時の `ASK` 表示を確認する

## 2026-07-31：TOP買取実績カードの詳細リンク追加

- 状態：完了
- 実施：買取実績カードの画像とタイトルから各 `purchase-record` 詳細ページへ移動できるように設定
- 変更：`template-parts/front/purchase-records.php`、`asset/css/component.css`
- 未完了：実際のWordPress環境におけるリンク動作の確認
- 次回：TOPで画像・タイトルの両方から正しい詳細ページへ移動できるか確認する

## 2026-07-31：お知らせ一覧のDB接続

- 状態：完了
- 実施：通常投稿のメインクエリを使い、公開日、カテゴリー、タイトル、詳細リンク、ページネーション、0件表示を動的化
- 変更：`home.php`、`asset/css/page-static.css`
- 未完了：WordPressの投稿ページ設定後に一覧・ページ送りを確認
- 次回：`info` を投稿ページに指定し、投稿件数と2ページ目以降の表示を確認する

## 2026-07-31：お知らせ詳細のDB接続

- 状態：完了
- 実施：通常投稿のタイトル、公開日、カテゴリー、本文、アイキャッチ画像を詳細テンプレートへ接続
- 変更：`single.php`
- 未完了：WordPress環境で本文ブロックとアイキャッチ有無の表示確認
- 次回：画像あり・なしの投稿を開き、本文、パンくず、一覧へ戻るリンクを確認する

## 2026-07-31：ヘッダーメニューへコラムを追加

- 状態：完了
- 実施：「カテゴリー一覧」と「よくある質問」の間に、`column` 投稿タイプのアーカイブへ移動する「コラム」を追加
- 変更：`inc/template-functions.php`、`components/header.html`
- 未完了：管理画面で独自メニューを割り当てている場合は、そのメニューにも同項目の追加が必要
- 次回：ヘッダーの表示順とコラム一覧への遷移をWordPress環境で確認する

## 2026-07-31：コラム一覧と新着記事のDB接続

- 状態：完了
- 実施：`column` の一覧をメインクエリへ接続し、1ページ10件、ページネーション、最新3件の新着記事、0件表示を実装
- 変更：`archive-column.php`、`inc/template-functions.php`、`asset/css/page-static.css`
- 未完了：WordPress環境で11件以上のページ送りと新着記事の表示確認
- 次回：アイキャッチ有無、genreラベル、抜粋、2ページ目、新着記事リンクを確認する

## 2026-07-31：コラム用no-image画像の生成と設定

- 状態：完了
- 実施：サイト配色に合わせたホビー系の汎用画像を生成し、コラム一覧・新着記事のアイキャッチ未設定時に表示
- 変更：`images/no-image-column.png`、`archive-column.php`、`asset/css/page-static.css`
- 未完了：WordPress環境で画像の表示サイズと読み込みを確認
- 次回：アイキャッチ未設定の記事を一覧と新着記事で確認する

## 2026-07-31：一般的なno-image画像を生成

- 状態：完了
- 実施：参考画像の簡潔さを踏まえ、一般的な画像アイコンと「NO IMAGE」表記によるオリジナル素材を生成して800×600pxへ調整
- 変更：`images/no-image-column.png`、`archive-column.php`、`asset/css/page-static.css`
- 未完了：WordPress環境で一覧・新着記事の表示確認
- 次回：画像全体が切れずに表示されているか確認する

## 2026-07-31：コラムのカテゴリ・タグブロックをDB接続

- 状態：完了
- 実施：公開済み`column`投稿に紐づく`genre`と`column-tag`のみを取得し、各タームアーカイブへのリンクを表示
- 変更：`archive-column.php`
- 未完了：WordPress環境でタームリンクと絞り込み先の表示確認
- 次回：記事あり・なしのタームを用意し、ブロックの表示条件とリンク先を確認する

## 2026-07-31：コラム人気記事を手動選定方式へ変更

- 状態：完了
- 実施：既存ACFの`column-featured`が有効な公開記事を、`column-featured-order`の数値が小さい順に最大3件表示
- 変更：`archive-column.php`
- 未完了：WordPress環境でACFの保存値と表示順を確認
- 次回：対象0件でボックス全体が非表示になり、対象記事が指定順で表示されることを確認する

## 2026-07-31：コラム一覧カードの抜粋を接続

- 状態：完了
- 実施：各カードの説明文を`column`投稿のWordPress標準「抜粋」へ接続し、未入力時は説明文要素を非表示
- 変更：`archive-column.php`
- 未完了：WordPress環境で抜粋入力済み・未入力の記事表示を確認
- 次回：一覧カードに管理画面の抜粋だけが表示され、本文から自動生成されないことを確認する

## 2026-07-31：コラム詳細ページとgenreリンクカードをDB接続

- 状態：完了
- 実施：`column`のタイトル、所属`genre`、アイキャッチ、本文、更新日を詳細ページへ接続。本文下カードを先頭の所属`genre`のアーカイブ、ターム名、`genre-text-for-card`へ接続
- 変更：`single-column.php`、`template-parts/content/blog-card.php`
- 未完了：WordPress環境で記事本文、アイキャッチ有無、複数genre、ACFタームフィールドの表示確認
- 次回：genre設定あり・なしの記事で、詳細表示とリンクカードの表示条件・リンク先を確認する

## 2026-07-31：コラム詳細の関連記事をDB接続

- 状態：完了
- 実施：表示中の記事を除外し、同じ`genre`に属する公開コラムをランダムで最大3件表示。対象0件では関連記事セクション全体を非表示
- 変更：`single-column.php`、`asset/css/page-static.css`
- 未完了：WordPress環境で同一genreの記事数別表示とランダム取得を確認
- 次回：関連記事0～3件、複数genre、アイキャッチ未設定の記事で表示とリンク先を確認する

## 2026-07-31：コラムサイドバーを共通パーツ化

- 状態：完了
- 実施：新着記事、ACF選定の人気記事、記事が存在する`genre`、`column-tag`を取得するサイドバーを共通化し、コラム一覧・詳細の両方で使用
- 変更：`template-parts/column/sidebar.php`、`archive-column.php`、`single-column.php`、`asset/css/page-static.css`
- 確認：ローカルWordPressの一覧・詳細で新着、人気、カテゴリ、タグと各リンクを確認。詳細ページの関連記事2件とコンソールエラーなしも確認
- 未完了：対象データ0件時の各ブロック非表示とモバイル表示の確認
- 次回：空データとアイキャッチ未設定の記事を用意し、非表示条件とno-image表示を確認する

## 2026-07-31：進捗資料と完了チェックリストを更新

- 状態：完了
- 実施：通常投稿・コラムのDB接続状況とLocal確認結果を進捗資料へ反映し、リポジトリ上で確認できたテーマ基盤、必須フック、静的HTML移植、テンプレート、enqueue関連の完了項目をチェック
- 変更：`theme/buybuycoms-hobby/PHASE-1-STATUS.md`、`theme/buybuycoms-hobby/README.md`、`THEME-COMPLETION-CHECKLIST.md`、`WORK-LOG.md`
- 未完了：CPT・タクソノミー・ACFの登録主体と運用資料、空データ・画像未設定・ページネーション・モバイル・WP_DEBUG・複数ブラウザ・公開前検証
- 次回：Localで境界値とモバイル表示を確認し、検証結果に対応するチェック項目を更新する

## 2026-07-31：TOP買取実績カードの価格表示を単一金額へ変更

- 状態：完了
- 実施：価格データを`item-min-price`・`item-max-price`の範囲表示から`item-price`の単一金額へ切り替え、数値を桁区切り付きの「XX円」で中央表示。未入力時は価格要素を非表示
- 変更：`template-parts/front/purchase-records.php`、`asset/css/component.css`、`WORK-LOG.md`
- 未完了：Localで`item-price`入力済み・未入力の表示とカード幅ごとの中央揃えを確認
- 次回：数値入力時の「XX円」、未入力時の価格非表示、PC・モバイルの中央揃えを確認する

## 2026-07-31：買取実績詳細のメイン画像をDB接続

- 状態：完了
- 実施：詳細ページの固定プレースホルダー画像を`purchase-record`の`item-image`へ接続し、ACFの画像配列・添付ID・URL形式に対応。未入力時は空の画像枠を表示
- 変更：`single-purchase-record.php`、`asset/css/page-static.css`、`WORK-LOG.md`
- 未完了：Localで画像の各返り値形式、代替テキスト、未入力時、PC・モバイルの表示を確認
- 次回：実データの`item-image`を設定し、画像比率と未入力時のレイアウトを確認する

## 2026-07-31：買取実績詳細の主要情報をDB接続

- 状態：完了
- 実施：詳細ページのタイトルを投稿タイトル、タイトル下を`genre`ターム、金額を`item-price`、スタッフコメントを投稿内容へ接続。元の「MG」ラベル位置には、紐づく`genre`のうち親を持つ小カテゴリをすべて個別表示。複数genreは読点区切り、金額・投稿内容の未入力時は対応する表示を非表示
- 変更：`single-purchase-record.php`、`asset/css/page-static.css`、`WORK-LOG.md`
- 未完了：Localで親・子genre、複数の小カテゴリ、金額・本文の入力有無、本文ブロックの表示を確認
- 次回：実データでタイトル、親・子genre、小カテゴリラベル、金額、本文と各未入力状態を確認する

## 2026-07-31：お客様の声の共通パーツをDB接続

- 状態：完了
- 実施：共通テンプレートパーツで`review`の最新3件を取得。タイトル、`review-age`、`review-job`、`review-star`、投稿内容、アイキャッチを接続。アイキャッチ未設定時は、参考イメージを基に新規生成した汎用人物アイコンを表示。トップ等は全口コミ、`genre`アーカイブは表示中のジャンル、genreが紐づく詳細ページは同じジャンルに絞り込み。ジャンルページへ該当口コミがある場合だけ共通パーツを表示するセクションを追加
- 変更：`template-parts/common/customer-reviews.php`、`front-page.php`、`taxonomy-genre.php`、`asset/css/component.css`、`images/icon/review-default-avatar.png`、`WORK-LOG.md`
- 未完了：Localでアイキャッチあり・なし、全件表示、親・子genreアーカイブ、買取事例詳細、該当0件、各フィールド未入力、星数境界値、PC・モバイル表示を確認
- 次回：ジャンルが異なる口コミと買取事例を用意し、アイキャッチのフォールバック、各ページの最新3件と絞り込み条件を確認する

## 2026-07-31：買取実績カードをジャンル対応の共通パーツ化

- 状態：完了
- 実施：トップ用のDB接続済み買取実績カードを共通パーツへ昇格。通常ページは全実績、`genre`アーカイブは表示中のジャンル、genreが紐づく詳細ページは同じジャンルに絞り、最新8件を表示
- 変更：`template-parts/common/purchase-records.php`、`front-page.php`、`taxonomy-genre.php`、`single-purchase-record.php`、`WORK-LOG.md`
- 未完了：Localでトップ、親・子genre、複数genreの事例詳細、該当0件、8件超の表示を確認
- 次回：複数ジャンルの買取実績を用意し、各ページの絞り込みと最新順を確認する

## 2026-07-31：ジャンル一覧ページの買取実績を20件表示

- 状態：完了
- 実施：ジャンル一覧ページでは全ジャンルの最新買取実績を最大20件取得し、初期8件・「もっと見る」で残りを展開。実績が8件以下の場合はボタンを非表示。公開済み買取実績が存在するgenreだけを抽出し、各ジャンルページへのタグリンクを表示
- 変更：`page-genre-list.php`、`template-parts/common/purchase-records.php`、`asset/js/pages/page-genre-list.js`、`inc/enqueue.php`、`asset/css/page-static.css`、`WORK-LOG.md`
- 未完了：Localで実績0件・8件・9件・20件以上、genreなし投稿、親・子genre、タグリンク、JavaScript無効時を確認
- 次回：20件以上のテストデータで初期8件、残り12件、最新順、存在するgenreだけのタグ表示を確認する
## 2026-07-31 買取実績ジャンルタグの取得修正

- 状態: 完了
- 実施内容: ジャンル一覧ページの買取実績タグについて、公開中の全 `purchase-record` に紐づく `genre` を一括取得し、タームIDで重複を除外してすべて表示する方式へ変更。サンプルデータの設定ミスと判明したため、投稿ごとの個別取得処理は取り消した。
- 主な変更ファイル: `theme/buybuycoms-hobby/page-genre-list.php`
- 未完了事項: WordPress実データを使用した表示件数の最終確認。
- 次回の着手点: 公開中の買取実績に複数ジャンルを割り当てた状態で、各ジャンルタグとリンクを実画面確認する。
## 2026-07-31 買取実績ジャンルタグの表示順対応

- 状態: 完了
- 実施内容: ジャンル一覧ページの買取実績タグを、`genre` タームの `genre-order` の数値が小さい順に表示するよう変更。未入力は入力済みタームの後ろ、同値は名前順とした。
- 主な変更ファイル: `theme/buybuycoms-hobby/page-genre-list.php`
- 未完了事項: WordPress実データでの表示順の最終確認。
- 次回の着手点: 各ジャンルへ異なる `genre-order` を設定し、画面上の並び順を確認する。
## 2026-07-31 買取品目カードの表示順対応

- 状態: 完了
- 実施内容: 共通の買取品目カードを `genre-order` の数値が小さい順に表示。ジャンルタグとカードで同じ並び順関数を使用する構成へ整理。
- 主な変更ファイル: `theme/buybuycoms-hobby/inc/template-functions.php`、`theme/buybuycoms-hobby/template-parts/common/genre-table.php`、`theme/buybuycoms-hobby/page-genre-list.php`
- 未完了事項: WordPress実データでの表示順の最終確認。
- 次回の着手点: トップページ、ジャンル一覧、その他の買取品目セクションで同じ順番になることを確認する。
## 2026-07-31 買取価格の目安をDB接続

- 状態: 完了
- 実施内容: `purchase-price` の公開データを `genre` ごとに表示。`genre-purchase-table-flag` が有効なジャンルだけを `genre-order` 順で出力し、`genre-purchase-table-number-of-display` をジャンルごとの上限に適用（未入力時は10件）。商品名は投稿タイトル、買取強化中バッジ、`product-min-price`、`product-max-price`を各フィールドへ接続し、両価格未入力時は `ASK` と表示。
- 主な変更ファイル: `theme/buybuycoms-hobby/template-parts/common/purchase-price-table.php`
- 未完了事項: WordPress実データでの表示内容と各ジャンルの件数上限の最終確認。
- 次回の着手点: フラグ有無、表示件数、片側価格未入力、両価格未入力の各状態を実画面確認する。
## 2026-07-31 選ばれる理由ページの買取実績をDB接続

- 状態: 完了
- 実施内容: `/reason/` の買取実績を旧固定パーツから、トップページと同じ `purchase-record` DB接続済み共通パーツへ変更。
- 主な変更ファイル: `theme/buybuycoms-hobby/page-reason.php`
- 未完了事項: WordPress実画面での最終表示確認。
- 次回の着手点: `/reason/` で最新の買取実績が最大8件表示されることを確認する。
## 2026-07-31 買取の流れページの買取実績をDB接続

- 状態: 完了
- 実施内容: `/flow/` の買取実績を旧固定パーツから、トップページと同じ `purchase-record` DB接続済み共通パーツへ変更。
- 主な変更ファイル: `theme/buybuycoms-hobby/page-flow.php`
- 未完了事項: WordPress実画面での最終表示確認。
- 次回の着手点: `/flow/` で最新の買取実績が最大8件表示されることを確認する。
## 2026-07-31 買取の流れページの価格目安をDB接続

- 状態: 完了
- 実施内容: `/flow/` の固定表示だった買取価格の目安を、トップページと同じ `purchase-price` DB接続済み共通パーツへ変更。
- 主な変更ファイル: `theme/buybuycoms-hobby/page-flow.php`
- 未完了事項: WordPress実画面での最終表示確認。
- 次回の着手点: `/flow/` でジャンル順、表示件数、価格、バッジがトップページと一致することを確認する。
## 2026-07-31 買取価格表のジャンル導線を共通化

- 状態: 完了
- 実施内容: 買取価格表の各ジャンル末尾へ「ジャンル名をもっと見る」ボタンを追加し、該当ジャンルページへ接続。flow専用だったボタンCSSを共通パーツ用クラスへ移行。
- 主な変更ファイル: `theme/buybuycoms-hobby/template-parts/common/purchase-price-table.php`、`theme/buybuycoms-hobby/asset/css/component.css`、`theme/buybuycoms-hobby/asset/css/page-static.css`
- 未完了事項: WordPress実画面でのボタン表示とリンク先の最終確認。
- 次回の着手点: トップ、flow、reason等で各ジャンルボタンが正しいジャンルページへ遷移することを確認する。
## 2026-07-31 ジャンルページの買取価格相場を限定表示

- 状態: 完了
- 実施内容: `genre` ページでは現在のジャンルに紐づく `purchase-price` のみ表示し、`genre-purchase-table-flag` の値は参照しないよう変更。対象データが0件の場合は「買取価格相場」セクション全体を非表示化。
- 主な変更ファイル: `theme/buybuycoms-hobby/template-parts/common/purchase-price-table.php`、`theme/buybuycoms-hobby/taxonomy-genre.php`
- 未完了事項: WordPress実画面でのジャンル別表示と0件時の最終確認。
- 次回の着手点: フラグ未設定でもデータがあるジャンル、データが0件のジャンルの双方を確認する。
## 2026-07-31 ジャンル価格表の段階表示

- 状態: 完了
- 実施内容: `genre` ページではジャンルリンクボタンを非表示化し、価格データを初期10件表示へ変更。11件以上の場合のみ「もっと見る」を表示し、クリックで残りを一括表示する挙動を追加。
- 主な変更ファイル: `theme/buybuycoms-hobby/template-parts/common/purchase-price-table.php`、`theme/buybuycoms-hobby/asset/js/pages/taxonomy-genre.js`、`theme/buybuycoms-hobby/asset/css/component.css`
- 未完了事項: WordPress実画面で10件以下・11件以上の両状態を最終確認。
- 次回の着手点: 10件以下でボタンが出ないこと、11件以上で展開後にボタンが消えることを確認する。
## 2026-07-31 買取実績セクションの共通パーツ化

- 状態: 完了
- 実施内容: `/genre-list/` の見出し、実績が存在するジャンルへの導線、最新20件、初期8件と「もっと見る」を含む買取実績セクションを共通テンプレートパーツへ切り出し、買取事例詳細ページでも使用。詳細ページでは投稿に紐づく `genre` と同じジャンルの実績を表示。段階表示のJavaScriptとセクションCSSを共有アセットへ移行。
- 主な変更ファイル: `theme/buybuycoms-hobby/template-parts/common/purchase-records-section.php`、`theme/buybuycoms-hobby/page-genre-list.php`、`theme/buybuycoms-hobby/single-purchase-record.php`、`theme/buybuycoms-hobby/asset/css/component.css`、`theme/buybuycoms-hobby/asset/js/component.js`、`theme/buybuycoms-hobby/inc/enqueue.php`
- 未完了事項: WordPress実画面で `/genre-list/` と買取事例詳細の表示、同一ジャンルへの絞り込み、8件以下・9件以上の段階表示を確認。
- 次回の着手点: 複数ジャンルの買取実績を用意し、両ページのジャンルリンク、カード件数、「もっと見る」の表示と展開をPC・モバイルで確認する。

## 2026-08-01：買取品目一覧の買取実績をジャンルでフィルター化

- 状態：完了
- 実施：`/genre-list/` のジャンル導線を遷移リンクからフィルターボタンへ変更。全件（最新20件）または各ジャンル（ジャンルごとに最新20件）を切り替え、各状態で初期8件・「もっと見る」による残り表示となるよう実装。
- 変更：`theme/buybuycoms-hobby/page-genre-list.php`、`theme/buybuycoms-hobby/template-parts/common/purchase-records-section.php`、`theme/buybuycoms-hobby/template-parts/common/purchase-records.php`、`theme/buybuycoms-hobby/asset/js/component.js`、`WORK-LOG.md`
- 未完了：Localで全件・各ジャンルの20件上限、8件／9件／20件、複数ジャンルが付いた投稿、0件、キーボード操作、PC・モバイルの表示を確認。
- 次回の着手点：複数ジャンルを設定した`purchase-record`で、選択ボタンの状態、対象カード、もっと見るの再表示を実画面で確認する。

## 2026-08-01：買取実績フィルターの全件表記を変更

- 状態：完了
- 実施：`/genre-list/` の買取実績フィルターで、全件表示ボタンの文言を「すべて」から「ALL」へ変更。
- 変更：`theme/buybuycoms-hobby/template-parts/common/purchase-records-section.php`、`WORK-LOG.md`
- 未完了：Localで表記とフィルター動作を確認。
- 次回の着手点：全件・ジャンル選択時のカード表示と「もっと見る」を実画面で確認する。

## 2026-08-01：買取実績詳細の関連実績をジャンルフィルターへ統一

- 状態：完了
- 実施：買取実績詳細ページでも`/genre-list/`と同じフィルター付き共通パーツを利用するよう統一。詳細投稿に設定されたgenreを並び順の先頭から初期選択し、同ジャンルの買取実績を初期表示するよう変更。
- 変更：`theme/buybuycoms-hobby/single-purchase-record.php`、`theme/buybuycoms-hobby/template-parts/common/purchase-records-section.php`、`theme/buybuycoms-hobby/template-parts/common/purchase-records.php`、`theme/buybuycoms-hobby/asset/js/component.js`、`WORK-LOG.md`
- 未完了：Localでジャンルあり・なし、複数ジャンル、各ジャンルの20件上限、初期8件ともっと見るを確認。
- 次回の着手点：詳細投稿のgenreと初期選択されたフィルターボタン、表示カードが一致することを実画面で確認する。

## 2026-08-01：買取方法ページのリード画像を差し替え

- 状態：完了
- 実施：`/flow/`のプレースホルダーを、提供されたホビー用品のドット絵へ差し替え。4:3表示枠向けに構図を保持した`800×600`のWebP（約87KB）へ最適化し、テーマ内アセットとして参照。
- 変更：`theme/buybuycoms-hobby/images/flow-hobby-collection.webp`、`theme/buybuycoms-hobby/page-flow.php`、`WORK-LOG.md`
- 未完了：LocalでPC・モバイル表示、画像の読み込み、レイアウトシフトがないことを確認。
- 次回の着手点：`/flow/`のリード画像が4:3枠内で切れずに表示されることを実画面で確認する。
## 2026-08-02 お問い合わせフォームの送信・管理機能を実装

- 状態: 実装完了（WordPress実機でのメール配送確認は未実施）
- 実施内容: `/contact/` の確認用JavaScript停止処理を実送信へ切り替え、nonce、ハニーポット、入力値の許可リスト・サーバー側検証、送信回数制限、固定送信先、Reply-To、303リダイレクトを追加。外観を維持したまま、テーマ設定画面で送信先・差し込み可能な自動返信文面・送信後の固定ページを管理できるようにした。
- 主な変更ファイル: `theme/buybuycoms-hobby/inc/contact-form.php`、`theme/buybuycoms-hobby/functions.php`、`theme/buybuycoms-hobby/page-contact.php`、`theme/buybuycoms-hobby/asset/js/pages/page-contact.js`、`theme/buybuycoms-hobby/asset/css/page-static.css`
- 未完了事項: SMTP等のメール配送設定と、WordPress実機での送信・自動返信・リダイレクトの確認。
- 次回の着手点: 本番と同等のメール送信環境で、管理画面の設定値ごとに送信試験を行う。

## 2026-08-02 静的確認ページの旧送信ポップアップを同期

- 状態: 完了
- 実施内容: 静的確認用 `pages/page-contact.html` にだけ残っていた、送信を停止する旧ポップアップ処理を削除。WordPressテーマ側のフォーム送信フローと矛盾しない状態にした。
- 主な変更ファイル: `pages/page-contact.html`、`WORK-LOG.md`
- 未完了事項: 静的HTMLはWordPressのnonce・送信エンドポイントを持たないため、メール送信の実機確認はテーマをWordPress環境で有効化して行う。
- 次回の着手点: `/contact/` をWordPress環境から開き、SMTP設定を含めた送信試験を行う。

## 2026-08-02 お問い合わせフォームのWordPress互換性を修正

- 状態: 完了
- 実施内容: Local環境で未定義だった `wp_strlen()` を、PHP標準／mbstringを使うテーマ内ヘルパーへ置換した。
- 主な変更ファイル: `theme/buybuycoms-hobby/inc/contact-form.php`、`WORK-LOG.md`
- 未完了事項: Local環境でのメール送信・自動返信・リダイレクトの実機確認。
- 次回の着手点: キャッシュを更新して再送信し、配送設定を確認する。

## 2026-08-02 お問い合わせメールを送信先別に編集可能化

- 状態: 完了
- 実施内容: 管理者宛・入力者宛それぞれに、独立した件名と本文の設定を追加。送信時には管理者宛に1通、入力者宛に1通を送信するよう明示した。旧自動返信文面の設定値は入力者宛本文へ自動的に引き継ぐ。
- 主な変更ファイル: `theme/buybuycoms-hobby/inc/contact-form.php`、`WORK-LOG.md`
- 未完了事項: Local環境のメール受信箱で両メールの配送確認。
- 次回の着手点: 「外観 → お問い合わせフォーム」で件名・本文を保存後、テスト送信する。

## 2026-08-02 お問い合わせメールの宅配買取値を日本語化

- 状態: 完了
- 実施内容: 管理者宛メールに出力する内部値を、`over` は「点数OK」、`self` は「自分で用意する」、`kit` は「買取キット希望」へ変換した。
- 主な変更ファイル: `theme/buybuycoms-hobby/inc/contact-form.php`、`WORK-LOG.md`
- 未完了事項: Local環境でのメール表示確認。
- 次回の着手点: 宅配買取の各分岐でテスト送信する。

## 2026-08-02 お問い合わせフォームのテスト送信制限を調整

- 状態: 完了
- 実施内容: Localでの連続テスト時に送信不能となったため、送信回数制限を10分間3回から10回へ調整。制限中は専用メッセージを表示する。
- 主な変更ファイル: `theme/buybuycoms-hobby/inc/contact-form.php`、`theme/buybuycoms-hobby/page-contact.php`、`WORK-LOG.md`
- 未完了事項: Local環境での再送信確認。
- 次回の着手点: 管理者宛・入力者宛の両メールが届くか確認する。

## 2026-08-02 お問い合わせメールの物量ラベルを変更

- 状態: 完了
- 実施内容: 宅配買取メールの「宅配買取の箱数」を「物量チェック」へ変更した。
- 主な変更ファイル: `theme/buybuycoms-hobby/inc/contact-form.php`、`WORK-LOG.md`
- 未完了事項: Local環境でのメール表示確認。
- 次回の着手点: 宅配買取のテスト送信で表示を確認する。

## 2026-08-05 お問い合わせ完了ページを追加

- 状態: 完了
- 実施内容: お問い合わせ送信後に表示する `thanks` 固定ページ用テンプレートを追加。添付キャラクターを横幅120pxで配置し、既存トークンを使った案内・メール受信設定・電話案内・トップへ戻る導線を実装した。送信後の遷移先が管理画面で未指定の場合は、スラッグ `thanks` の固定ページを自動選択する。
- 主な変更ファイル: `theme/buybuycoms-hobby/page-thanks.php`、`theme/buybuycoms-hobby/asset/css/page-static.css`、`theme/buybuycoms-hobby/inc/contact-form.php`、`theme/buybuycoms-hobby/images/thanks-character.webp`、`WORK-LOG.md`
- 未完了事項: WordPress管理画面でスラッグ `thanks` の固定ページを作成し、実際の送信後遷移を確認する。ローカルサイトは現在接続できず表示確認は未実施。
- 次回の着手点: Localを起動後、PC・モバイル表示とフォーム送信後の遷移を確認する。

## 2026-08-05 お問い合わせ完了ページの文言と表示を調整

- 状態: 完了
- 実施内容: 自動返信メールが届かない場合の案内文を削除。メール受信設定案内ブロックの左枠線を削除し、完了見出しはスマホ幅のみ「お問い合わせ」の後で改行するよう調整した。
- 主な変更ファイル: `theme/buybuycoms-hobby/page-thanks.php`、`theme/buybuycoms-hobby/asset/css/page-static.css`、`WORK-LOG.md`
- 未完了事項: Localを起動してPC・モバイル表示を確認する。
- 次回の着手点: 送信後遷移と完了ページの表示を実機確認する。

## 2026-08-05 パンくずリストを動的化

- 状態: 完了
- 実施内容: テンプレートにベタ書きされていたパンくずを共通関数へ置き換えた。現在の固定ページ階層、投稿一覧・詳細、カスタム投稿タイプアーカイブ・詳細、タクソノミー階層、検索結果、404ページに応じてWordPressのデータから表示する。
- 主な変更ファイル: `theme/buybuycoms-hobby/inc/template-functions.php`、各テンプレートファイル、`WORK-LOG.md`
- 未完了事項: Localを起動して主要ページの表示を確認する。
- 次回の着手点: トップ階層・親子固定ページ・コラム詳細・ジャンル詳細のパンくずを実機確認する。

## 2026-08-05 フッターの許認可番号を更新

- 状態: 完了
- 実施内容: フッター最下部の許認可番号を「兵庫県公安委員会 第631331400008号」へ変更した。
- 主な変更ファイル: `theme/buybuycoms-hobby/footer.php`、`WORK-LOG.md`
- 未完了事項: Localでの表示確認。
- 次回の着手点: 送信後遷移と完了ページの表示を実機確認する。

## 2026-08-05 CTAのLINE査定リンクを更新

- 状態: 完了
- 実施内容: 共通CTAの「LINEで査定する」リンク先をLINE公式アカウントの指定URLへ変更した。
- 主な変更ファイル: `theme/buybuycoms-hobby/template-parts/common/parts-cta.php`、`WORK-LOG.md`
- 未完了事項: Localでのリンク遷移確認。
- 次回の着手点: CTAからLINE公式アカウントへ遷移することを確認する。

## 2026-08-05 パンくずコンテナの背景色を追加

- 状態: 完了
- 実施内容: パンくずリストの `.hb__l-container` に白背景を追加し、親要素と同じ背景色を明示した。
- 主な変更ファイル: `theme/buybuycoms-hobby/asset/css/base.css`、`WORK-LOG.md`
- 未完了事項: Localでの表示確認。
- 次回の着手点: 各ページのパンくず背景を実機確認する。

## 2026-08-05 選ばれる理由ページのリンク先を修正

- 状態: 完了
- 実施内容: `reason/` の「よくあるご質問について」をFAQページへ、「LINE査定はこちら」をLINE公式アカウントへリンクした。
- 主な変更ファイル: `theme/buybuycoms-hobby/page-reason.php`、`WORK-LOG.md`
- 未完了事項: Localでのリンク遷移確認。
- 次回の着手点: FAQページとLINE公式アカウントへの遷移を確認する。

## 2026-08-05 選ばれる理由ページからの宅配買取フォーム遷移を追加

- 状態: 完了
- 実施内容: `reason/` の「買取方法はこちら」と「宅配買取はこちら」を、宅配買取が初期選択されたお問い合わせフォームへリンクした。
- 主な変更ファイル: `theme/buybuycoms-hobby/page-reason.php`、`WORK-LOG.md`
- 未完了事項: Localでのフォーム初期選択確認。
- 次回の着手点: 両リンクから宅配買取が選択済みで表示されることを確認する。

## 2026-08-05 選ばれる理由ページからのフォーム初期選択を修正

- 状態: 完了
- 実施内容: 「買取方法はこちら」は通常の`/contact/`へ戻した。「宅配買取はこちら」は`type=takuhai`を付けて遷移し、フォーム側ではPHPとJavaScriptの両方で宅配買取を初期選択するようにした。
- 主な変更ファイル: `theme/buybuycoms-hobby/page-reason.php`、`theme/buybuycoms-hobby/page-contact.php`、`theme/buybuycoms-hobby/asset/js/pages/page-contact.js`、`WORK-LOG.md`
- 未完了事項: Localでの表示確認。
- 次回の着手点: 宅配買取リンクからの初期選択とフォーム表示を実機確認する。

## 2026-08-05 買取方法別リンクのフォーム遷移を追加

- 状態: 完了
- 実施内容: 共通の「3つの買取方法」セクションにある宅配・出張・持ち込み買取の各リンクを、該当する買取方法が初期選択されたお問い合わせフォームへ変更した。
- 主な変更ファイル: `theme/buybuycoms-hobby/template-parts/common/purchase-methods.php`、`WORK-LOG.md`
- 未完了事項: Localでの各買取方法の初期選択確認。
- 次回の着手点: 宅配・出張・持ち込みの各リンクからフォーム表示を確認する。

## 2026-08-05 買取の流れセクションのフォーム遷移を確認・統一

- 状態: 完了
- 実施内容: 買取の流れにある宅配・出張・店頭買取の申込みリンクを、各方法が初期選択されたお問い合わせフォームへ遷移するWordPress標準のURL生成へ統一した。
- 主な変更ファイル: `theme/buybuycoms-hobby/template-parts/common/flow-tab.php`、`WORK-LOG.md`
- 未完了事項: Localでの各買取方法の初期選択確認。
- 次回の着手点: 各フロータブの申込みリンクからフォーム表示を確認する。
# 2026-08-10 taxonomy-genreの指定セクションを非表示

- 状態: 完了
- 実施内容: 「買取強化中のアイテム」と「対応メーカー、シリーズ一覧」を、テンプレートから出力しないようにしました。再表示が必要になった場合は、該当する条件分岐を有効化します。
- 主な変更ファイル: `theme/buybuycoms-hobby/taxonomy-genre.php`、`WORK-LOG.md`
- 未完了事項: WordPress実行環境での画面確認
- 次回の着手点: taxonomy-genreの各ジャンルページで、指定2セクションが表示されないことを確認する。

## 2026-08-10 genreカードの強化中バッジを追加

- 状態: 完了
- 実施内容: カスタムタクソノミー `genre` の真偽フィールド `genre-badge1-flag` が真のカードにのみ、左上へ「強化中」バッジを表示するようにしました。バッジはオレンジ背景・白字・14px太字のピル型です。
- 主な変更ファイル: `theme/buybuycoms-hobby/template-parts/common/genre-table.php`、`theme/buybuycoms-hobby/asset/css/component.css`、`WORK-LOG.md`
- 未完了事項: WordPress実行環境で、フィールドが真・偽の各ジャンルの表示確認
- 次回の着手点: トップページなど `genre-table` を利用するページでバッジ表示を確認する。

## 2026-08-10 問い合わせ自動返信の送信者名を変更

- 状態: 完了
- 実施内容: 問い合わせフォームの自動返信メールのみ、送信者名を「売買コムズ hobbyベース」に変更しました。差出人メールアドレスは既存のWordPressまたはSMTP設定を維持します。
- 主な変更ファイル: `theme/buybuycoms-hobby/inc/contact-form.php`、`WORK-LOG.md`
- 未完了事項: 本番SMTP設定での実メール受信確認
- 次回の着手点: 問い合わせを1件送信し、受信メールの差出人名を確認する。

## 2026-08-10 問い合わせ自動返信の送信者名を管理画面で設定可能化

- 状態: 完了
- 実施内容: 「お問い合わせフォーム」設定画面に、入力者宛メールの送信者名入力欄を追加しました。未入力時は「売買コムズ hobbyベース」を使用します。
- 主な変更ファイル: `theme/buybuycoms-hobby/inc/contact-form.php`、`WORK-LOG.md`
- 未完了事項: 本番管理画面での保存・メール受信確認
- 次回の着手点: 送信者名を変更して問い合わせを送信し、反映を確認する。

## 2026-08-10 管理画面メニューからコメントを非表示

- 状態: 完了
- 実施内容: WordPress管理画面の左メニューから「コメント」を非表示にしました。コメント機能や既存データは削除していません。
- 主な変更ファイル: `theme/buybuycoms-hobby/inc/setup.php`、`WORK-LOG.md`
- 未完了事項: 本番管理画面での表示確認
- 次回の着手点: 管理画面にログインし、コメントメニューが表示されないことを確認する。

## 2026-08-19 ヘッダー・フッターロゴの表記を統一

- 状態: 完了
- 実施内容: 共通ブランド出力の表記を「hobbyベース」から「Hobbyベース」へ変更し、ヘッダーとフッターのロゴ表記を統一した。
- 主な変更ファイル: `theme/buybuycoms-hobby/inc/template-functions.php`、`WORK-LOG.md`
- 未完了事項: WordPress実行環境での表示確認。
- 次回の着手点: ヘッダーとフッターで「Hobbyベース」と表示されることを確認する。

## 2026-08-19 お客様の声カードの最大幅を調整

- 状態: 完了
- 実施内容: お客様の声セクションの各カードへ最大幅 `325px` を設定し、表示幅が余る画面ではカードをグリッド内で中央配置するようにした。
- 主な変更ファイル: `asset/css/component.css`、`theme/buybuycoms-hobby/asset/css/component.css`、`WORK-LOG.md`
- 未完了事項: PC・モバイルの実表示確認。
- 次回の着手点: 各ページのお客様の声セクションで、カード幅と中央配置を確認する。

## 2026-08-19 電話番号の自動リンク化を無効化

- 状態: 完了
- 実施内容: 共通ヘッダーに `format-detection` の電話番号自動検出を無効化するmetaタグを追加し、WordPressテーマの全公開ページへ適用した。
- 主な変更ファイル: `theme/buybuycoms-hobby/header.php`、`WORK-LOG.md`
- 未完了事項: iOS Safariでの表示確認。
- 次回の着手点: 電話番号テキストが意図しない自動リンクにならないことを確認する。

## 2026-08-19 メインビジュアルCTAの遷移先を更新

- 状態: 完了
- 実施内容: TOPページとジャンル詳細ページのメインビジュアルにある「無料査定を申し込む」を `/contact/` へ、「LINEで写真査定する」をLINE公式アカウントへ遷移するよう変更した。
- 主な変更ファイル: `theme/buybuycoms-hobby/front-page.php`、`theme/buybuycoms-hobby/taxonomy-genre.php`、`WORK-LOG.md`
- 未完了事項: WordPress実行環境での各CTA遷移確認。
- 次回の着手点: TOPページとジャンル詳細ページのメインビジュアルから、指定URLへ遷移することを確認する。

## 2026-08-19 フッターCTAのLINE査定リンクを更新

- 状態: 完了
- 実施内容: フッターCTA内の「LINEで写真査定する」ボタンを、指定のLINE公式アカウントURLへ変更した。
- 主な変更ファイル: `theme/buybuycoms-hobby/template-parts/common/footer-cta.php`、`WORK-LOG.md`
- 未完了事項: WordPress実行環境でのリンク遷移確認。
- 次回の着手点: フッターCTAのLINE査定ボタンから、指定URLへ遷移することを確認する。

## 2026-08-19 お問い合わせ完了ページのメールリンクを削除

- 状態: 完了
- 実施内容: `/thanks/` ページに表示するメールアドレスから `mailto:` リンクを外し、テキスト表示へ変更した。
- 主な変更ファイル: `theme/buybuycoms-hobby/page-thanks.php`、`WORK-LOG.md`
- 未完了事項: WordPress実行環境での表示確認。
- 次回の着手点: `/thanks/` ページでメールアドレスがリンクにならないことを確認する。

## 2026-08-19 宅配買取の少量時モーダル文言を更新

- 状態: 完了
- 実施内容: 宅配買取で「9点以下」を選択した際のモーダルについて、タイトルと本文の「商品点数が10点未満の場合」を「商品点数が9点以下の場合」へ変更した。
- 主な変更ファイル: `theme/buybuycoms-hobby/asset/js/pages/page-contact.js`、`WORK-LOG.md`
- 未完了事項: WordPress実行環境でのモーダル表示確認。
- 次回の着手点: 宅配買取・9点以下を選択し、モーダルのタイトルと本文を確認する。

## 2026-08-19 フォーム同意文のプライバシーポリシーをリンク化

- 状態: 完了
- 実施内容: フォーム下部の同意文にある「プライバシーポリシー」を `/privacy/` へのテキストリンクに変更し、添付のリンクアイコンを右側に配置した。キーボードフォーカス時の視認性も追加した。
- 主な変更ファイル: `theme/buybuycoms-hobby/page-contact.php`、`theme/buybuycoms-hobby/asset/css/page-static.css`、`theme/buybuycoms-hobby/images/icon/icon-link.svg`、`WORK-LOG.md`
- 未完了事項: WordPress実行環境でのリンク遷移・PC／モバイル表示確認。
- 次回の着手点: 同意文のリンクとアイコン、チェックボックス操作が自然に機能することを確認する。

## 2026-08-19 フォームに郵便番号検索と分割住所入力を追加

- 状態: 完了
- 実施内容: お客様情報に郵便番号、都道府県・市区町村、番地、建物名・部屋番号を追加。郵便番号7桁入力時はzipcloud APIで町域まで含む住所を自動入力し、失敗時は手入力できるようにした。サーバー側の入力検証、管理者宛・自動返信メール、メールタグも分割住所へ対応した。
- 主な変更ファイル: `theme/buybuycoms-hobby/page-contact.php`、`theme/buybuycoms-hobby/asset/js/pages/page-contact.js`、`theme/buybuycoms-hobby/asset/css/page-static.css`、`theme/buybuycoms-hobby/inc/contact-form.php`、`WORK-LOG.md`
- 未完了事項: WordPress実行環境での郵便番号検索、送信、管理者宛・自動返信メールの実機確認。
- 次回の着手点: 有効・無効郵便番号、住所の手入力、住所未入力、メール本文の各住所項目を確認する。

## 2026-08-19 郵便番号欄の表示幅を調整

- 状態: 完了
- 実施内容: お問い合わせフォームの郵便番号入力欄だけを `8em` 幅にし、他の入力欄の全幅表示は維持した。
- 主な変更ファイル: `theme/buybuycoms-hobby/asset/css/page-static.css`、`WORK-LOG.md`
- 未完了事項: ブラウザでの最終表示確認。
- 次回の着手点: 郵便番号入力欄がPC・モバイルで意図した幅になっていることを確認する。

## 2026-08-19 郵便番号欄を縦並びへ調整

- 状態: 完了
- 実施内容: 郵便番号入力欄をブロック要素に変更し、ラベルの下に表示されるようにした。
- 主な変更ファイル: `theme/buybuycoms-hobby/asset/css/page-static.css`、`WORK-LOG.md`
- 未完了事項: ブラウザでの最終表示確認。
- 次回の着手点: 郵便番号入力欄がラベルの下に表示されることをPC・モバイルで確認する。

## 2026-08-19 郵便番号欄の幅を再調整

- 状態: 完了
- 実施内容: 郵便番号欄のプレースホルダーが見切れないよう、入力欄の幅を `8em` から `10em` へ変更した。
- 主な変更ファイル: `theme/buybuycoms-hobby/asset/css/page-static.css`、`WORK-LOG.md`
- 未完了事項: ブラウザでの最終表示確認。
- 次回の着手点: 郵便番号のプレースホルダーがPC・モバイルで見切れないことを確認する。

## 2026-08-19 本番環境での郵便番号検索の動作条件を確認

- 状態: 確認完了
- 実施内容: お問い合わせページで郵便番号検索用JavaScriptがenqueueされることを確認。zipcloud APIは7桁郵便番号と住所フィールドを提供し、API応答に`Access-Control-Allow-Origin: *`が付くことを確認した。
- 主な変更ファイル: `WORK-LOG.md`
- 未完了事項: 本番環境での実機確認。
- 次回の着手点: 本番公開後に、有効な郵便番号で住所が自動入力されることを確認する。

## 2026-08-19 買取価格CSVの最低金額を変更

- 状態: 完了
- 実施内容: 買取価格CSV一括更新・新規登録の入力可能な最低金額を1,000円から50円へ変更し、管理画面の注意書きとバリデーションエラー文も更新した。
- 主な変更ファイル: `theme/buybuycoms-hobby/inc/purchase-price-csv.php`、`WORK-LOG.md`
- 未完了事項: WordPress管理画面でのCSV実機確認。
- 次回の着手点: 50円、49円、空欄（ASK）のCSVをそれぞれ検証する。

## 2026-08-19 買取実績カードに地域表示を追加

- 状態: 完了
- 実施内容: 買取実績カードに投稿日時を `Y/n/j` 形式で表示し、直後にカスタムフィールド `item-purchase-date` の値と「で買取」を続ける表示へ変更した。
- 主な変更ファイル: `theme/buybuycoms-hobby/template-parts/common/purchase-records.php`、`WORK-LOG.md`
- 未完了事項: WordPress実行環境での実データ表示確認。
- 次回の着手点: `item-purchase-date` に都道府県を設定した実績カードが「2026/7/27 千葉県で買取」と表示されることを確認する。

## 2026-08-19 買取実績カードの地域フィールドを訂正

- 状態: 完了
- 実施内容: 買取地域の取得元を誤っていた `item-purchase-date` から、正しいカスタムフィールド `item-purchase-area` へ変更した。
- 主な変更ファイル: `theme/buybuycoms-hobby/template-parts/common/purchase-records.php`、`WORK-LOG.md`
- 未完了事項: WordPress実行環境での実データ表示確認。
- 次回の着手点: `item-purchase-area` に都道府県を設定した実績カードが「2026/7/27 千葉県で買取」と表示されることを確認する。

## 2026-08-19 買取実績詳細の日時・地域表示を動的化

- 状態: 完了
- 実施内容: 買取実績詳細の固定文言を、`item-purchase-date` と `item-purchase-area` のカスタムフィールドによる「日付 地域で宅配買取」表示へ変更した。
- 主な変更ファイル: `theme/buybuycoms-hobby/single-purchase-record.php`、`WORK-LOG.md`
- 未完了事項: WordPress実行環境での実データ表示確認。
- 次回の着手点: 両フィールドを設定した買取実績詳細で表示内容を確認する。

## 2026-08-19 コラム用の買取方法コンポーネント確認ページを追加

- 状態: 完了
- 実施内容: TOPで利用している買取方法パーツにコラム用バリエーションを追加。635px幅ではタブ＋選択中のカード1枚を表示し、見出しをコラム本文と同じ左ボーダー形式にした。確認用ページテンプレートも追加した。
- 主な変更ファイル: `theme/buybuycoms-hobby/template-parts/common/purchase-methods.php`、`theme/buybuycoms-hobby/asset/css/component.css`、`theme/buybuycoms-hobby/asset/css/page-static.css`、`theme/buybuycoms-hobby/page-column-purchase-methods-preview.php`、`WORK-LOG.md`
- 未完了事項: WordPress実行環境でのPC・モバイル表示確認。
- 次回の着手点: 固定ページへ「コラム用買取方法コンポーネント確認」テンプレートを設定し、カード幅とタブ操作を確認する。

## 2026-08-19 コラム用買取方法コンポーネントの表示パターンを追加

- 状態: 完了
- 実施内容: 常時タブ表示パターンの最大幅を400pxにして中央揃えへ変更。あわせて、親ボックス幅が450px未満の場合だけタブ表示に切り替わるカード一覧優先パターンを確認ページへ追加した。
- 主な変更ファイル: `theme/buybuycoms-hobby/template-parts/common/purchase-methods.php`、`theme/buybuycoms-hobby/asset/css/component.css`、`theme/buybuycoms-hobby/page-column-purchase-methods-preview.php`、`theme/buybuycoms-hobby/asset/css/page-static.css`、`WORK-LOG.md`
- 未完了事項: WordPress実行環境でのPC・モバイル表示確認。
- 次回の着手点: 確認ページで400pxのタブ表示と、450px境界での一覧・タブ切替を確認する。

## 2026-08-19 カード一覧優先パターンを3列表示へ変更

- 状態: 完了
- 実施内容: コラム用のカード一覧優先パターンで、親ボックス幅が450px以上の場合は買取方法カードを横3列で表示するように変更した。450px未満では従来どおりタブ＋1枚表示へ切り替わる。
- 主な変更ファイル: `theme/buybuycoms-hobby/asset/css/component.css`、`WORK-LOG.md`
- 未完了事項: WordPress実行環境での境界幅表示確認。
- 次回の着手点: 確認ページで450px以上の3列表示と、450px未満のタブ表示を確認する。

## 2026-08-19 コラム用買取方法の細幅3列カードを調整

- 状態: 完了
- 実施内容: 450px以上の3列表示時だけ、カード間隔・内側余白・文字サイズを細幅向けに調整し、本文・リスト・ボタンの折返しを許可した。縦長でも内容が切れずに表示されるようにした。
- 主な変更ファイル: `theme/buybuycoms-hobby/asset/css/component.css`、`WORK-LOG.md`
- 未完了事項: WordPress実行環境での3列表示の視覚確認。
- 次回の着手点: 450px以上でカード内テキストとボタンが切れず、450px未満でタブ表示に切り替わることを確認する。

## 2026-08-19 コラム用買取方法を動的ブロックとして登録

- 状態: 完了
- 実施内容: ブロックエディターから挿入できる「買取方法（コラム用）」動的ブロックを追加。公開画面では既存の `column-auto-tabs` コンポーネントをPHPで出力し、編集画面では同じコンポーネントをプレビュー表示する。
- 主な変更ファイル: `theme/buybuycoms-hobby/inc/blocks.php`、`theme/buybuycoms-hobby/asset/js/blocks/column-purchase-methods.js`、`theme/buybuycoms-hobby/functions.php`、`WORK-LOG.md`
- 未完了事項: WordPress管理画面でのブロック挿入・公開画面でのタブ操作確認。
- 次回の着手点: コラム投稿編集画面で「買取方法（コラム用）」を挿入し、プレビューと公開画面の表示を確認する。

## 2026-08-21 買取方法カードの見た目と名称を統一

- 状態: 完了
- 実施内容: 共通の「3つの買取方法」カードから宅配買取だけに設定されていた緑の枠線を削除し、他カードと統一した。あわせて、表示名・代替テキスト・導線ラベルを「持ち込み買取」から「店頭買取」へ変更した。
- 主な変更ファイル: `theme/buybuycoms-hobby/template-parts/common/purchase-methods.php`、`theme/buybuycoms-hobby/asset/css/component.css`、`components/purchase-methods.html`、`asset/css/component.css`、`WORK-LOG.md`
- 未完了事項: WordPress実行環境でのTOPページと`/flow/`ページの表示確認。
- 次回の着手点: 3枚のカードが同じ枠線で表示され、店頭買取の文言が反映されていることを確認する。

## 2026-08-23 プロジェクト状態の確認

- 状態: 確認完了
- 実施内容: 静的参照データ、WordPressテーマ、テーマ化計画、完了チェックリスト、直近の作業履歴を確認した。テーマ基盤と対象画面の移植は完了している一方、実環境・境界値・公開前検証と運用仕様の文書化が残っている。
- 主な変更ファイル: `WORK-LOG.md`
- 未完了事項: SMTPを含むフォーム実機確認、主要画面のPC・モバイル表示、空データ・ページネーション・未入力データ、`WP_DEBUG`、エディター表示、公開前チェックリストの確認。
- 次回の着手点: WordPress実行環境で主要導線とフォームを確認し、残る運用仕様を確定・文書化する。

## 2026-08-23 出張買取の第1希望日時を必須化

- 状態: 完了
- 実施内容: 出張買取では第1希望の日付のみ必須とし、時間帯および第2・第3希望は任意に変更した。ブラウザ側とサーバー側の両方で第1希望日を検証する。
- 主な変更ファイル: `theme/buybuycoms-hobby/page-contact.php`、`theme/buybuycoms-hobby/asset/js/pages/page-contact.js`、`theme/buybuycoms-hobby/inc/contact-form.php`、`WORK-LOG.md`
- 未完了事項: WordPress実行環境で、時間帯未選択でも第1希望日を入力すれば送信できることを確認する。
- 次回の着手点: 出張買取を選択し、第1希望日の未入力時と入力時のバリデーションを確認する。

## 2026-08-23 出張買取の第1希望日に必須バッジを追加

- 状態: 完了
- 実施内容: 出張買取の第1希望ラベルへ、既存のお名前欄と同じ「必須」バッジを追加した。
- 主な変更ファイル: `theme/buybuycoms-hobby/page-contact.php`、`WORK-LOG.md`
- 未完了事項: WordPress実行環境での視覚確認。
- 次回の着手点: 出張買取選択時に必須バッジと入力欄の表示を確認する。

## 2026-08-23 お問い合わせメールの差出人名を統一

- 状態: 完了
- 実施内容: 管理者宛メールと入力者宛の自動返信メールの差出人名を「売買コムズ ホビーベース」に統一した。管理者宛メールの返信先は、フォームへ入力されたメールアドレスを継続して使用する。
- 主な変更ファイル: `theme/buybuycoms-hobby/inc/contact-form.php`、`WORK-LOG.md`
- 未完了事項: SMTPを経由した実メールで、差出人名と返信先が表示・動作するかの確認。
- 次回の着手点: フォームを送信し、管理者宛メールの返信操作が入力者のメールアドレスへ向くことを確認する。

## 2026-08-23 郵便番号の入力中バリデーションを抑制

- 状態: 完了
- 実施内容: 郵便番号が7桁未満の間は入力中にエラーを表示せず、入力欄から離れた時にだけエラーを表示するよう変更した。7桁入力後の住所自動検索は維持している。
- 主な変更ファイル: `theme/buybuycoms-hobby/asset/js/pages/page-contact.js`、`WORK-LOG.md`
- 未完了事項: ブラウザでの操作確認。
- 次回の着手点: 郵便番号を途中まで入力した時、7桁入力した時、入力欄から離れた時の表示を確認する。

## 2026-08-23 管理者宛メールのお申込内容を買取方法別に切替

- 状態: 実装中
- 実施内容: 管理者宛メールの共通本文へ `[detail]` を配置し、宅配（ダンボール必要／不要）・出張・店頭の4種類のお申込内容だけを送信時に切り替える設計へ変更。管理画面では共通本文を1か所、各お申込内容をタブで編集できるようにした。
- 主な変更ファイル: `theme/buybuycoms-hobby/inc/contact-form.php`、`theme/buybuycoms-hobby/asset/js/admin/contact-form-settings.js`、`WORK-LOG.md`
- 未完了事項: WordPress管理画面と実メールでの表示・切替確認。
- 次回の着手点: 4つの買取方法でテスト送信し、`[detail]` だけが切り替わることを確認する。

## 2026-08-23 お問い合わせのご依頼番号を自動採番

- 状態: 完了
- 実施内容: ご依頼番号をサイト全体で重複しない連番として自動採番する処理を追加。初回は1000000、以降はフォーム送信ごとに1ずつ増加し、管理者宛メールの `[request-number]` に差し込む。
- 主な変更ファイル: `theme/buybuycoms-hobby/inc/contact-form.php`、`WORK-LOG.md`
- 未完了事項: WordPress実行環境で、連続送信時の番号増分とメール表示の確認。
- 次回の着手点: テスト送信を2回行い、1000000、1000001の順にご依頼番号が出力されることを確認する。

## 2026-08-23 買取方法別メール文面の差し込みを修正

- 状態: 完了
- 実施内容: 買取方法を表示名へ変換した後に詳細テンプレートを参照していたため、`[detail]` が空になる不具合を修正。変換前のテンプレートキーを保持して参照するよう変更し、入力者宛メールの既定本文にも `[detail]` を追加した。
- 主な変更ファイル: `theme/buybuycoms-hobby/inc/contact-form.php`、`WORK-LOG.md`
- 未完了事項: WordPress実行環境で4種類の買取方法別メールを確認。
- 次回の着手点: 各買取方法でテスト送信し、管理者宛・入力者宛メールの `[detail]` が置換されることを確認する。
## 2026-08-25 Google Tag Managerを設定

- 状態: 完了
- 実施内容: コンテナID `GTM-5BPG8RCN` のGoogle Tag Managerスニペットを共通ヘッダーに追加。head内の上部へスクリプトを、開始bodyタグ直後へnoscript iframeを配置し、全公開ページで読み込まれるようにした。
- 主な変更ファイル: `theme/buybuycoms-hobby/header.php`、`WORK-LOG.md`
- 未完了事項: WordPress実行環境でGTMプレビューおよびタグ配信を確認する。
- 次回の着手点: GTMのプレビュー機能で対象ページへの接続とイベント受信を確認する。

## 2026-08-27 お問い合わせフォームのプライバシーポリシーリンクを移動

- 状態: 完了
- 実施内容: 送信ボタン直前の同意文からプライバシーポリシーのリンクとリンクアイコンを削除し、注意事項リスト内の「プライバシーポリシー」へ正しいURLとリンクアイコンを設定した。
- 主な変更ファイル: `theme/buybuycoms-hobby/page-contact.php`、`theme/buybuycoms-hobby/asset/css/page-static.css`、`WORK-LOG.md`
- 未完了事項: WordPress実行環境での表示確認。
- 次回の着手点: 各買取方法の注意事項に、プライバシーポリシーリンクとアイコンが表示されることを確認する。

## 2026-08-27 お問い合わせメールへ依頼番号付きMessage-IDを設定

- 状態: 完了
- 実施内容: 各お問い合わせの管理者宛メールと自動返信メールに、依頼番号を含む個別のMessage-IDと `X-Contact-Request-Number` ヘッダーを設定した。両メールのMessage-IDは重複しないよう区別している。
- 主な変更ファイル: `theme/buybuycoms-hobby/inc/contact-form.php`、`WORK-LOG.md`
- 未完了事項: SMTPを設定したWordPress実行環境でのメールヘッダーとGmailスレッド表示の確認。
- 次回の着手点: 管理者宛件名へ `[request-number]` を設定し、テスト送信で各メールのMessage-IDとGmail上のスレッドを確認する。

## 2026-08-27 Google広告用GCLIDの取得・保持・メール連携を追加

- 状態: 完了
- 実施内容: 全ページでURLの`gclid`を90日間・Path `/`・SameSite=LaxのファーストパーティCookieへ保存し、申込フォームのhidden項目へ設定する処理を追加。管理者宛メールで使える`[GCLID]`と`[application-date]`を追加し、未取得時はGCLIDを`ID:なし`として出力する。
- 主な変更ファイル: `theme/buybuycoms-hobby/inc/gclid.php`、`theme/buybuycoms-hobby/asset/js/gclid.js`、`theme/buybuycoms-hobby/inc/contact-form.php`、`theme/buybuycoms-hobby/inc/enqueue.php`、`theme/buybuycoms-hobby/page-contact.php`、`WORK-LOG.md`
- 未完了事項: WordPress実行環境とGmailでのCookie・hidden項目・メールタグの実機確認。
- 次回の着手点: `?gclid=`付きURLからフォーム送信を行い、Cookie保存期間と管理者メールのGCLID・申込日時を確認する。

## 2026-08-27 お問い合わせメールの送信元アドレスを固定

- 状態: 完了
- 実施内容: 申込みフォームが送る管理者宛メールと自動返信メールの送信元アドレスを `info@byebyecoms.com` に固定した。フォーム外のWordPressメールには影響しない。
- 主な変更ファイル: `theme/buybuycoms-hobby/inc/contact-form.php`、`WORK-LOG.md`
- 未完了事項: SMTP実行環境でのFromヘッダーと配送可否の確認。
- 次回の着手点: テスト送信後にGmailのメッセージソースでFromが `info@byebyecoms.com` となっていることを確認する。

## 2026-08-27 申込完了時のGoogle Tag Managerコンバージョンイベントを追加

- 状態: 完了
- 実施内容: 管理者宛メールの送信成功後、完了画面への303リダイレクトに一度だけ利用できるトークンを付与。遷移先でのみ `buyback_complete` をdataLayerへ送信し、買取方法に応じて `delivery`、`home_visit`、`store` を設定する。
- 主な変更ファイル: `theme/buybuycoms-hobby/inc/contact-form.php`、`theme/buybuycoms-hobby/inc/enqueue.php`、`theme/buybuycoms-hobby/asset/js/buyback-complete.js`、`WORK-LOG.md`
- 未完了事項: GTMプレビューとGA4 DebugViewでの実機確認。
- 次回の着手点: 各買取方法でテスト送信し、完了画面でイベントが1回だけ発火することを確認する。

## 2026-08-27 Localテーマのジャンクションを復旧

- 状態: 完了
- 実施内容: 通常ディレクトリへ置き換わっていたLocal側テーマを作業フォルダへ復元し、Localのテーマパスを作業フォルダへのジャンクションとして再作成した。既存のLocalテーマはバックアップとして退避した。
- 主な変更ファイル: `theme/buybuycoms-hobby/`、`WORK-LOG.md`
- 未完了事項: 各機能の実機操作確認。
- 次回の着手点: Localでフォーム送信、メール、GTMイベントを確認する。

## 2026-09-01 買取事例カードの日付をカスタムフィールドへ接続

- 状態: 完了
- 実施内容: 買取事例カードの日付表示を投稿公開日ではなく、カスタムフィールド `item-purchase-date` を優先して表示するよう修正した。ACFの保存形式（`Ymd`）を含む日付は `Y/n/j` に整形し、未入力または解釈できない値の場合は安全に投稿公開日または入力値へフォールバックする。
- 主な変更ファイル: `theme/buybuycoms-hobby/template-parts/common/purchase-records.php`、`WORK-LOG.md`
- 未完了事項: WordPress実行環境で、入力した買取日が一覧・関連実績・トップの買取事例セクションへ表示されることを確認する。
- 次回の着手点: `item-purchase-date` を設定した買取実績を複数用意し、日付表示と並び順を確認する。

## 2026-09-01 フッターの著作権表記を更新

- 状態: 完了
- 実施内容: フッターの著作権表記を「Copyright © 2013-2026 byebyecoms all rights reserved.」へ変更した。
- 主な変更ファイル: `theme/buybuycoms-hobby/footer.php`、`WORK-LOG.md`
- 未完了事項: WordPress実行環境での表示確認。
- 次回の着手点: フッターの著作権表記が全ページで指定どおり表示されることを確認する。

## 2026-09-01 ヘッダーメニューの品目一覧表記を更新

- 状態: 完了
- 実施内容: ヘッダーのグローバルナビゲーションにある「カテゴリー一覧」を「買取品目一覧」へ変更した。メニュー未割当時のフォールバックと、管理画面で割り当てたプライマリメニューの両方で表示を統一する。
- 主な変更ファイル: `theme/buybuycoms-hobby/inc/template-functions.php`、`WORK-LOG.md`
- 未完了事項: WordPress実行環境での表示確認。
- 次回の着手点: PC・モバイルのヘッダーで「買取品目一覧」と表示され、リンク先が従来どおり `genre-list` ページであることを確認する。
