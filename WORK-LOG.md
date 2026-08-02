# 作業ログ

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
