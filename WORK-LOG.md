# 作業ログ

日をまたぐ作業をスムーズに再開するため、各作業の終了時に要点だけを記録します。
細かな変更履歴はGitに任せ、このログには判断内容、進捗、未完了事項、次の着手点を残します。

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
