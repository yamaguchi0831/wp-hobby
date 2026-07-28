# WordPressクラシックテーマ変換計画

## 1. この文書の目的

この文書は、`pages/` と `components/` で制作した静的HTMLを、後日WordPressクラシックテーマへ変換するための実行計画です。

現時点では変換を実施しません。テーマ化を開始する際は、実装前に必ず本書の「未決定事項」を確認し、ユーザーの承認を得てから作業します。

### 後日Codexへ依頼する際の文例

```txt
AGENTS.md、WP-THEME-CONVERSION-PLAN.md、
THEME-COMPLETION-CHECKLIST.mdを確認してください。
未決定事項を先に整理し、承認を取ってから、
WP-THEME-CONVERSION-PLAN.mdのフェーズ0から
WordPressクラシックテーマ化を開始してください。
```

## 2. 必ず参照するファイル

- `AGENTS.md`: 開発ルール、class命名、静的制作とテーマ化の境界
- `design.md`: デザイン方針
- `asset/css/tokens.css`: デザイントークン
- `THEME-COMPLETION-CHECKLIST.md`: 完成判定
- `pages/*.html`: ページ単位の静的完成見本
- `components/*.html`: 静的制作時の共有パーツ
- `asset/js/include-components.js`: 静的制作専用の部品読込処理
- `asset/js/component.js`: 共通インタラクション

## 3. 変換の基本方針

- PHPテンプレート階層を使うWordPressクラシックテーマとして実装する。
- フルサイト編集を前提とするブロックテーマにはしない。
- 投稿と固定ページの編集にはブロックエディターを利用できるようにする。
- `pages/` と `components/` は静的完成見本として保持する。
- WordPress側は、JavaScriptでHTML部品を取得せずPHPでサーバー側出力する。
- `[data-hb-include]` は `get_header()`、`get_footer()`、`get_template_part()` へ置き換える。
- `include-components.js` は静的制作用とし、WordPressの公開画面では読み込まない。
- 静的HTMLの `<style>` は外部CSSへ移し、PHPテンプレートのhead内に残さない。
- ソースCSSは責務別に管理し、本番読込用CSSは原則1ファイルへまとめる。
- `hb-{page-slug}__*` はページ固有、`hb__*` は共有パーツとして扱う。
- WordPress標準classは無理に `hb` プレフィックスへ変更しない。
- URL、画像、投稿データはWordPress標準APIで出力し、適切にエスケープする。

## 4. 想定サイトマップとテンプレート対応

URL末尾の `/` はWordPressのパーマリンク設定とcanonicalリダイレクトに従います。

| ページ | 想定URL | WordPress上の扱い | 静的参照元 | PHPテンプレート案 |
|---|---|---|---|---|
| TOP | `/` | 固定ページをフロントページに指定 | `pages/front.html` | `front-page.php` |
| 買取方法 | `/flow/` | 固定ページ `flow` | `pages/page-flow.html` | `page-flow.php` |
| カテゴリー一覧 | `/genre-list/` | 固定ページ `genre-list` | `pages/page-genre-list.html` | `page-genre-list.php` |
| よくある質問 | `/faq/` | 固定ページ `faq` | `pages/page-faq.html` | `page-faq.php` |
| 会社概要 | `/company/` | 固定ページ `company` | `pages/page-company.html` | `page-company.php` |
| 選ばれる理由 | `/reason/` | 固定ページ `reason` | `pages/page-reason.html` | `page-reason.php` |
| 査定フォーム | `/contact/` | 固定ページ `contact` | `pages/page-contact.html` | `page-contact.php` |
| プライバシーポリシー | `/privacy/` | 固定ページ `privacy` | `pages/page-privacy.html` | `page-privacy.php` |
| カテゴリーページ | `/genre/{term-slug}/` | 推奨: カスタムタクソノミー `genre` のタームアーカイブ | `pages/taxonomy-genre.html` | `taxonomy-genre.php` |
| 買取実績一覧 | `/purchase-record/` | CPT `purchase-record` のアーカイブ | `pages/archive-purchase-record.html` | `archive-purchase-record.php` |
| 買取実績詳細 | `/purchase-record/{post-slug}/` | CPT `purchase-record` の詳細 | `pages/single-purchase-record.html` | `single-purchase-record.php` |
| お知らせ一覧 | `/info/` | 通常投稿の投稿ページ | `pages/archive-info.html` | `home.php` |
| お知らせ詳細 | `/info/{post-slug}/` | 通常投稿の詳細 | `pages/single-info.html` | `single.php` |
| コラム一覧 | `/column/` | CPT `column` のアーカイブ | `pages/archive-column.html` | `archive-column.php` |
| コラム詳細 | `/column/{post-slug}/` | CPT `column` の詳細 | `pages/single-column.html` | `single-column.php` |

### 共通フォールバック

次のテンプレートも用意し、専用テンプレートがない場合や例外状態に対応します。

- `index.php`
- `page.php`
- `single.php`
- `archive.php`
- `taxonomy.php`
- `search.php`
- `404.php`
- `comments.php`: コメントを使用する場合

## 5. コンテンツモデル

### 固定ページ

管理画面で次の固定ページを作成し、表のslugを設定します。

- TOP
- 買取方法: `flow`
- カテゴリー一覧: `genre-list`
- よくある質問: `faq`
- 会社概要: `company`
- 選ばれる理由: `reason`
- 査定フォーム: `contact`
- プライバシーポリシー: `privacy`
- お知らせ一覧用ページ: `info`

「設定 → 表示設定」で、TOPをホームページ、お知らせ一覧用ページを投稿ページとして指定する案を基本とします。

### 通常投稿「お知らせ」

- 通常投稿は「お知らせ」だけに使用する想定。
- 一覧は `home.php` で `/info/` に表示する。
- 詳細URLを `/info/{post-slug}/` にするため、パーマリンク構造を検討する。
- 通常投稿を将来お知らせ以外にも使う可能性がある場合は、URL設計を再検討する。
- 使用候補: タイトル、本文、抜粋、公開日、アイキャッチ。

### カスタム投稿タイプ `purchase-record`

- 表示名: 買取実績
- 投稿タイプslug: `purchase-record`
- アーカイブURL: `/purchase-record/`
- 詳細URL: `/purchase-record/{post-slug}/`
- ブロックエディターを使う場合は `show_in_rest` を有効にする。
- 使用候補: タイトル、本文、抜粋、アイキャッチ、公開日。
- 商品名、買取価格、商品状態、買取方法等を個別項目にするか、本文ブロックに含めるかを実装前に決める。

### カスタム投稿タイプ `column`

- 表示名: コラム
- 投稿タイプslug: `column`
- アーカイブURL: `/column/`
- 詳細URL: `/column/{post-slug}/`
- ブロックエディターを使う場合は `show_in_rest` を有効にする。
- 使用候補: タイトル、本文、抜粋、アイキャッチ、公開日、投稿者。
- コラム用カテゴリー・タグの必要性を実装前に確認する。

### `genre` の推奨モデル

ページ名称が「カテゴリーページ」であり、静的参照元が `taxonomy-genre.html` のため、第一候補はカスタムタクソノミー `genre` とします。

- タクソノミーslug: `genre`
- URL: `/genre/{term-slug}/`
- テンプレート: `taxonomy-genre.php`
- ターム名、slug、説明をWordPress標準項目として使用する。
- ヒーロー画像、導入文、CTA、価格表等にターム固有データが必要なら、タームメタまたは採用プラグインのタームフィールドで管理する。
- `purchase-record`、`column`、その他どの投稿タイプへ紐付けるかを実装前に確定する。

画像表の「カスタム投稿 `genre`」を文字どおり採用する場合は、CPT `genre` と `single-genre.php` に変更します。実装開始前に必ずどちらかを確定します。

### 投稿タイプ・タクソノミーの登録場所

投稿タイプとタクソノミーはコンテンツ構造であり、テーマ変更後もデータを保持する必要があります。

推奨:

- サイト専用プラグインまたはmu-pluginで登録する。
- テーマは表示用テンプレートだけを担当する。

テーマ内登録を希望する場合:

- `inc/content-types.php` 等へ責務を分ける。
- テーマ変更時に管理画面から投稿が見えなくなるリスクを引き継ぎ資料へ明記する。

## 6. テーマファイル構成案

現在のプロジェクトルートをテーマルートとして使い、`pages/` と `components/` は開発参照用として残す案です。本番配布物から除外するファイルはリリース工程で整理します。

```text
/
├─ style.css
├─ functions.php
├─ theme.json                 # 必要に応じて使用
├─ header.php
├─ footer.php
├─ front-page.php
├─ home.php
├─ page.php
├─ page-flow.php
├─ page-genre-list.php
├─ page-faq.php
├─ page-company.php
├─ page-reason.php
├─ page-contact.php
├─ page-privacy.php
├─ archive.php
├─ archive-purchase-record.php
├─ archive-column.php
├─ single.php
├─ single-purchase-record.php
├─ single-column.php
├─ taxonomy.php
├─ taxonomy-genre.php
├─ search.php
├─ 404.php
├─ index.php
├─ template-parts/
│  ├─ common/
│  ├─ content/
│  └─ loop/
├─ inc/
│  ├─ setup.php
│  ├─ enqueue.php
│  ├─ template-functions.php
│  └─ helpers.php
├─ asset/
│  ├─ css/
│  ├─ js/
│  └─ image/
├─ images/
├─ pages/                     # 静的参照用・本番配布対象外候補
└─ components/                # 静的参照用・本番配布対象外候補
```

## 7. 静的コンポーネントの移植先

| 静的コンポーネント | WordPress側の移植案 | 主な対応 |
|---|---|---|
| `components/header.html` | `header.php` | ロゴ、メニュー、CTAを動的化 |
| `components/footer.html` | `footer.php` | メニュー、会社情報、リンクを動的化 |
| `components/footer-cta.html` | `template-parts/common/footer-cta.php` | URLと文言を設定化するか確認 |
| `components/parts-cta.html` | `template-parts/common/parts-cta.php` | 1ページ複数配置に耐える構造にする |
| `components/blog-card.html` | `template-parts/content/blog-card.php` | 投稿オブジェクトまたはIDを引数で渡す |
| `components/purchase-methods.html` | `template-parts/common/purchase-methods.php` | タブ状態とリンクを確認 |
| `components/purchase-cases.html` | `template-parts/common/purchase-cases.php` | 表示件数と取得元を決める |
| `components/purchase-price-table.html` | `template-parts/common/purchase-price-table.php` | 固定値か管理画面データか決める |
| `components/genre-table.html` | `template-parts/common/genre-table.php` | `genre` のターム一覧から生成するか決める |
| `components/flow-tab.html` | `template-parts/common/flow-tab.php` | タブUIとアンカーURLを確認 |
| `components/customer-reviews.html` | `template-parts/common/customer-reviews.php` | 固定表示か投稿データか決める |

### 移植時のルール

- `get_template_part()` の `$args` で必要な値を渡し、グローバル変数への依存を避ける。
- 同じパーツを1ページ内で複数回使ってもIDが重複しないようにする。
- `components/` 内の相対画像パスとダミーリンクをWordPress関数へ置き換える。
- 共有パーツにページ固有classが含まれる場合、`hb__*` へ整理する。
- 別ページのslugを持つclassを流用している箇所は、共有パーツへ昇格するかページ固有へ戻す。

## 8. CSS変換計画

### ソース管理

既存の責務を維持します。

1. `tokens.css`
2. `reset.css`
3. `base.css`
4. `utility.css`
5. `component.css`
6. `page.css`

### 静的HTML内CSSの移動

- 各 `pages/*.html` の `<style>` を調査する。
- ページ固有ルールは `page.css` へ集約する。
- 共有可能なルールはclass名と責務を確認して `component.css` へ移す。
- 同じルールの重複、上書き順依存、不要な `!important` を整理する。
- `component.css` にあるページ固有セレクタは、共有化または `page.css` への移動を判断する。
- `front.html` と `page-flow.html` 等で流用されている `hb-faq__*` は、共有FAQなら `hb__p-faq__*` 等へ昇格する。

### WordPressでの読込

推奨:

- 管理用のソースCSSは責務別のまま保持する。
- 本番用に1つの `asset/css/theme.css` へビルドする。
- `theme.css` を `wp_enqueue_style()` で読み込む。
- `style.css` はテーマ登録用ヘッダーを持たせ、実CSSの配置はビルド方針に合わせる。

ビルド工程を導入しない場合:

- 既存CSSを上記の依存順でenqueueする。
- CSSの連結に `@import` を使用しない。

ページごとの条件付きCSSはデフォルトで採用しません。完成後にCSS容量と表示速度を計測し、効果がある場合だけ検討します。

## 9. ブロックエディター対応

- `add_theme_support( 'editor-styles' )` を登録する。
- `add_editor_style()` でエディター用CSSを読み込む。
- `asset/css/editor-style.css` を用意する。
- `tokens.css` の色、文字、余白等をエディターでも利用可能にする。
- `.editor-styles-wrapper` のHTML構造を考慮してスコープする。
- 見出し、段落、リンク、リスト、表、引用、画像、キャプション、ボタンを公開画面に近づける。
- フロント用リセットCSSをそのまま管理画面全体へ適用しない。
- 必要に応じて `theme.json` でコンテンツ幅、wide幅、色、文字サイズ、ブロック設定を補助する。
- `theme.json` を使用しても、FSE用テンプレートは作成しない。
- 投稿編集画面と公開画面を同じ実データで比較する。

## 10. JavaScript変換計画

- `include-components.js` はWordPressでenqueueしない。
- `component.js` のFAQ、タブ等はWordPressのPHP出力後にも動作するよう確認する。
- 各ページ末尾のインラインスクリプトを洗い出す。
- 同じFAQ処理等が `component.js` とページ内で重複している場合は統合する。
- ページ固有処理は責務別ファイルへ移すか、共通処理へ安全に統合する。
- DOMが存在しないテンプレートでもエラーにならないようにする。
- 1ページ内に同じパーツが複数あっても正しく動作させる。
- `aria-expanded`、`aria-selected`、`hidden` 等をUI状態と同期させる。
- JavaScriptは `wp_enqueue_script()` で読み込み、必要な依存関係とフッター読込を指定する。

## 11. ヘッダー・フッター・サイト設定

### ヘッダー

- `wp_head()`、`wp_body_open()`、`body_class()` を実装する。
- ロゴを固定テーマ画像にするか、カスタムロゴにするか決める。
- グローバルナビを `wp_nav_menu()` へ変換する。
- 電話番号、査定フォーム、LINEのURLをどこで管理するか決める。
- モバイルメニューとキーボード操作を確認する。

### フッター

- `wp_footer()` を実装する。
- フッターナビを管理画面メニューへ変換する。
- 会社情報、電話番号、営業時間等の管理場所を決める。
- プライバシーポリシーURLは固定文字列でなくWordPressの設定またはページURLから取得する。

## 12. URL・パーマリンク設計

実装前に次を確定します。

- 固定ページslugは画像表のとおりとするか。
- 通常投稿をお知らせ専用とし、パーマリンクを `/info/%postname%/` にするか。
- `/info/` を投稿ページとして設定するか。
- `purchase-record` と `column` の `has_archive` とrewrite slug。
- `genre` をタクソノミーにするかCPTにするか。
- `genre` を紐付ける投稿タイプ。
- タクソノミーとCPTのrewriteが衝突しないか。
- 末尾スラッシュとcanonical URL。
- 旧URLがある場合の301リダイレクト。

rewriteルールのflushを通常アクセスごとに実行しません。登録機能の有効化時または管理画面のパーマリンク更新で行います。

## 13. 動的化の判断

各静的要素を、次のいずれかへ分類します。

1. WordPress標準データ
   - タイトル、本文、抜粋、アイキャッチ、公開日、投稿者、ターム
2. 管理画面から更新する追加データ
   - カスタムフィールド、テーマ設定、タームメタ等
3. テーマ内の固定表示
   - 更新頻度が低い装飾、構造、補助文
4. プラグインが担当する機能
   - フォーム、SEO、構造化データ、業務データ等

すべてをカスタムフィールド化せず、運用者が更新する必要のある項目だけを動的化します。

## 14. 実装フェーズ

### フェーズ0: 着手前確認

- Gitブランチまたは復旧可能なバックアップを用意する。
- WordPress、PHP、必須プラグインのバージョンを記録する。
- 本書の未決定事項をユーザーと確定する。
- テーマの正式名称、slug、テキストドメイン、バージョンを決める。
- テーマ実装先をプロジェクトルートにするか別ディレクトリにするか確定する。
- WordPressローカル環境と確認URLを用意する。

### フェーズ1: コンテンツモデル

- 固定ページを作成する。
- 投稿ページとフロントページを設定する。
- CPT `purchase-record`、`column` を登録する。
- `genre` のモデルを確定して登録する。
- カスタムフィールドが必要な項目を確定する。
- パーマリンクと全URLを管理画面・フロントの両方で確認する。

### フェーズ2: テーマ基盤

- `style.css`、`functions.php`、`index.php` を作成する。
- `inc/` にセットアップ、enqueue、補助関数を分割する。
- テーマサポート、メニュー、画像サイズを登録する。
- CSS、JavaScript、フォントをenqueueする。
- `theme.json` とエディターCSSの採用範囲を実装する。

### フェーズ3: 共通パーツ

- `header.php` と `footer.php` を作成する。
- `components/*.html` を `template-parts/` へ移植する。
- 相対URL、画像パス、ダミーリンクを動的化する。
- 共有classとページ固有classを整理する。
- 共通JavaScriptをPHP出力後のHTMLで確認する。

### フェーズ4: 固定ページ

次の順を基本とし、共通構造を早い段階で確立します。

1. `front-page.php`
2. `page-flow.php`
3. `page-genre-list.php`
4. `page-reason.php`
5. `page-faq.php`
6. `page-company.php`
7. `page-contact.php`
8. `page-privacy.php`

各ページで、静的HTMLとの比較、PC／モバイル、リンク、未入力状態を確認してから次へ進みます。

### フェーズ5: 投稿一覧・詳細

1. 通常投稿: `home.php` と `single.php`
2. 買取実績: `archive-purchase-record.php` と `single-purchase-record.php`
3. コラム: `archive-column.php` と `single-column.php`
4. genre: `taxonomy-genre.php` または確定した代替テンプレート

一覧0件、1件、多数、ページネーション、画像なし、長いタイトルを確認します。

### フェーズ6: CSS・JavaScript整理

- 全静的ページのインラインCSSを移動する。
- 全インラインJavaScriptを移動・統合する。
- CSSの重複とclass責務を整理する。
- 本番用CSSバンドルを作成するか、enqueue順を確定する。
- ブロックエディターCSSを公開画面と比較する。
- コンソールエラーとアセット404を解消する。

### フェーズ7: フォールバックと例外

- `page.php`、`archive.php`、`taxonomy.php`、`index.php` を確認する。
- `search.php`、検索0件、`404.php` を実装する。
- コメントを使用する場合は `comments.php` を実装する。
- 非公開、下書き、予約投稿、パスワード保護を確認する。

### フェーズ8: 完成検証

- `THEME-COMPLETION-CHECKLIST.md` の全項目を確認する。
- `WP_DEBUG` とログを確認する。
- Theme Check、PHP構文、HTML、CSS、JavaScriptを検証する。
- Theme Unit Test Dataまたは同等の境界値データで確認する。
- 管理者・編集者・ログアウト状態で確認する。
- PC、モバイル、対象ブラウザで確認する。
- ユーザーのブラウザで最終表示確認を行う。

### フェーズ9: 配布・公開

- `pages/`、`components/`、開発資料等を本番配布物へ含めるか最終判断する。
- `.git/`、バックアップ、テストデータ、秘密情報を配布物へ含めない。
- テーマバージョンとキャッシュバージョンを更新する。
- バックアップとロールバック手順を用意する。
- ステージングで承認後、本番へ反映する。
- 本番反映後に主要URLをスモークテストする。

## 15. 未決定事項

実装を開始する前に、最低限次を確認します。

- [ ] サイト固有classプレフィックスは、実ファイルどおり `hb` で確定か
- [ ] テーマ名、テーマslug、テキストドメイン
- [ ] テーマファイルをプロジェクトルートへ作るか、専用サブディレクトリへ作るか
- [ ] `genre` はカスタムタクソノミーかCPTか
- [ ] `genre` を紐付ける投稿タイプ
- [ ] 通常投稿は「お知らせ」専用か
- [ ] 通常投稿詳細URLを `/info/{post-slug}/` にするか
- [ ] CPTとタクソノミーをサイト専用プラグインで登録するか、テーマ内で登録するか
- [ ] カスタムフィールドに使用する仕組み
- [ ] 各ページで管理画面から更新可能にする項目
- [ ] 査定フォームを担当するプラグインまたは外部サービス
- [ ] FAQを固定HTML、ブロック、カスタム投稿、繰り返しフィールドのどれで管理するか
- [ ] お客様の声、買取方法、価格表を固定表示にするか管理画面データにするか
- [ ] ロゴ、電話番号、営業時間、CTA URLの管理場所
- [ ] CSSのビルド工程を導入するか
- [ ] `theme.json` の採用範囲
- [ ] 対応するWordPress、PHP、ブラウザの最低バージョン
- [ ] コメント、検索、投稿者ページ、日付別アーカイブの使用有無
- [ ] SEO、パンくず、OGP、構造化データを担当するプラグイン
- [ ] 本番配布物から除外する開発用ファイル

## 16. 完了条件

次をすべて満たした時点で「テーマ化完了」とします。

- 画像表の全URLが意図したWordPressテンプレートで表示される。
- 静的HTMLと比較して、必要な要素、文言、画像、レスポンシブ表示が欠落していない。
- 共通パーツがPHPテンプレートとして再利用され、JavaScriptのHTML読込に依存していない。
- PHPテンプレート内に静的制作用の大量なインラインCSS・JavaScriptが残っていない。
- WordPress管理画面から想定項目を安全に更新できる。
- ブロックエディターで公開画面に近い本文スタイルを確認できる。
- URL、パーマリンク、一覧、詳細、ページネーション、404が正常に動作する。
- セキュリティ、アクセシビリティ、性能、レスポンシブの重大な問題がない。
- `THEME-COMPLETION-CHECKLIST.md` の重大項目がすべて完了している。
- 未対応事項、依存プラグイン、運用手順、公開手順が文書化されている。
