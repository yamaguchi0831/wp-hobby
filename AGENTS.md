# AGENTS.md

このプロジェクトは、既存の静的HTMLを基にPHPテンプレート主体のWordPressクラシックテーマを制作するためのものです。
静的HTMLの見た目と情報設計を尊重しつつ、WordPressの標準機能、テンプレート階層、セキュリティ、更新運用に適した実装へ変換します。

## 1. 優先順位

実装時は、次の順に指示を優先します。

1. ユーザーからの具体的な指示
2. 本ファイル `AGENTS.md`
3. デザインに関する判断は `design.md`
4. デザイントークンは `asset/css/tokens.css`
5. WordPressテーマ変換時は `WP-THEME-CONVERSION-PLAN.md`
6. 既存の静的HTML、共通CSS、画像などの実装資産

- WEB要素の新規作成・変更前に、必ず `design.md` と `asset/css/tokens.css` を確認する。
- `design.md` と本ファイルの内容が重なる場合、具体的なデザイン判断は `design.md`、実装ルールは本ファイルを優先する。
- 既存の静的HTMLは完成イメージとコンテンツ構成の参照元として扱い、WordPressテーマの実装先と混同しない。
- WordPressテーマ化へ着手する前に `WP-THEME-CONVERSION-PLAN.md` の未決定事項を確認する。

## 2. プロジェクト内の役割

- `pages/`: 各ページの静的HTML参照データ
- `components/`: 共通パーツの静的HTML参照データ
- `asset/css/`: デザイントークンと共通CSS
- `asset/js/include-components.js`: 静的HTML制作時に `[data-hb-include]` の参照先を `fetch()` して差し込むための開発用JavaScript
- `asset/js/component.js`: タブ、FAQ等の共通インタラクション
- `asset/image/`、`images/`: 既存の画像素材
- WordPressのPHPファイル: 実際にWordPressから読み込まれるテーマ実装

静的HTMLから移植する際は、元データをむやみに削除・上書きしない。ユーザーから指示がない限り、参照用HTMLを残したままPHPテンプレートを作成する。

## 3. 開発フェーズ

本プロジェクトでは、次の2段階を明確に分ける。

### 静的HTML制作フェーズ

- `pages/` 内でページを組み、ブラウザでデザインとレスポンシブ表示を確認する。
- ヘッダー、フッター、CTA、カード等の再利用パーツは `components/` に置く。
- 静的ページでは `[data-hb-include]` と `asset/js/include-components.js` による共通パーツ読込を使用してよい。
- 静的制作中のページ固有CSSは、確認と修正の効率を優先し、各HTMLの `<head>` 内の `<style>` に記述してよい。
- サイト共通CSSと共有コンポーネントCSSは `asset/css/` で管理し、ページ固有CSSと混在させない。
- 静的確認用の相対URL、ダミーリンク、固定文言は、WordPress化時に置換対象として扱う。
- 静的制作フェーズの仕組みを、そのまま本番WordPressの実行方式にしない。

### WordPressテーマ化フェーズ

- PHPテンプレート階層を使用するクラシックテーマへ変換する。
- `components/header.html` は `header.php`、`components/footer.html` は `footer.php` へ移植する。
- その他の `components/*.html` は、責務に応じて `template-parts/` 内のPHPへ移植する。
- `[data-hb-include]` と `include-components.js` によるHTML部品の実行時読込は廃止し、`get_header()`、`get_footer()`、`get_template_part()` 等へ置き換える。
- WordPressテーマではHTML部品をJavaScriptの `fetch()` に依存して表示しない。
- 静的HTMLの `<head>` 内にあるページ固有CSSは、テーマ内の外部CSSファイルへ移す。
- CSSの管理元は、既存どおり `tokens.css`、`reset.css`、`base.css`、`utility.css`、`component.css`、`page.css` の責務で分ける。
- 各HTMLの `<style>` にあるページ固有CSSは、原則として共通の `asset/css/page.css` へ集約し、ページ名入りclassで競合を防ぐ。
- 本番フロントでは、可能であれば上記CSSをビルドして1つの `theme.css` 等にまとめ、1つのスタイルとしてenqueueする。
- ビルド工程を導入しない場合は、既存CSSを依存順に複数enqueueしてよい。`@import` による連結は避ける。
- ページ別CSSの条件付きenqueueは、CSS容量や性能計測から分割効果が見込める場合のみ採用し、デフォルト構成にはしない。
- PHPテンプレートの `<head>`、本文、テンプレートパーツ内へ大量のCSSを直書きしない。
- CSSは `wp_enqueue_style()`、JavaScriptは `wp_enqueue_script()` で読み込む。ページ固有JavaScript等は、必要に応じて条件分岐で読み込む。
- 静的HTML末尾のインラインJavaScriptは、責務別の外部JavaScriptへ移し、重複処理を統合する。
- `include-components.js` は静的制作専用とし、WordPressテーマのフロントではenqueueしない。
- 相対画像パスと静的HTMLへのリンクを、WordPressのURL関数と動的リンクへ置き換える。

## 4. WordPressテーマの基本方針

- PHPテンプレート階層を使用するクラシックテーマとして実装する。
- フルサイト編集を前提とするブロックテーマへ変更しない。
- 投稿・固定ページのブロックエディター対応を行い、エディター用CSSを用意する。
- `theme.json` は、クラシックテーマにおけるブロック設定とエディター／フロントのデザイン整合を補助する目的で必要に応じて使用する。
- WordPress本体、親テーマ、外部プラグインのファイルは変更しない。
- WordPressのテンプレート階層に従い、目的に合うファイルを使用する。
- 共通部分は `header.php`、`footer.php`、`sidebar.php`、`template-parts/` などへ分割する。
- テンプレート内の重複を避け、再利用可能な表示は `get_template_part()` を使用する。
- 機能追加は原則として `functions.php` または責務別に分けた `inc/` 内へ実装する。
- `functions.php` を単なる長大な処理置き場にしない。
- テーマ固有の表示はテーマへ、テーマ変更後も保持すべきデータや業務機能はプラグイン側の責務として判断する。
- WordPress標準APIを優先し、独自実装は必要最小限にする。
- プラグインやカスタムフィールドに依存する場合、存在を決めつけず、現在の採用状況を確認する。依存が必要ならコードとドキュメントの両方で明示する。

## 5. テンプレート変換

静的HTMLは、主に次の対応でWordPress化する。

- `pages/front.html` → `front-page.php`
- `pages/page-*.html` → 固定ページテンプレート、`page-{slug}.php` または `page.php`
- `pages/archive-*.html` → `archive-{post_type}.php` または適切なアーカイブテンプレート
- `pages/single-*.html` → `single-{post_type}.php` または `single.php`
- `pages/taxonomy-*.html` → `taxonomy-{taxonomy}.php` または適切なタクソノミーテンプレート
- `components/header.html` → `header.php`
- `components/footer.html` → `footer.php`
- その他の共通部品 → `template-parts/`

ただし、ファイル名だけで投稿タイプやタクソノミーの仕様を確定しない。既存コード、WordPress管理画面の設計、ユーザー要件を確認してからスラッグとテンプレート名を決める。

移植時は以下を守る。

- 静的HTMLの文言、要素数、見出し階層、class名、表示順を、要件なく変更しない。
- 共通ヘッダー・フッター・CTA・カードなどを各テンプレートへ複製しない。
- 編集可能にすべき内容は、投稿本文、アイキャッチ、メニュー、ウィジェット、カスタムフィールドなど適切なWordPressデータへ置き換える。
- 管理画面から更新する必要がない固定装飾まで、無理に動的化しない。
- URLやアセットパスを静的HTMLの相対パスのまま残さない。

## 6. 必須のWordPress実装

- `header.php` で `wp_head()` を呼び出す。
- `<body>` の直後で `wp_body_open()` を呼び出す。
- `footer.php` で `wp_footer()` を呼び出す。
- HTMLの `lang` 属性などには `language_attributes()` を使用する。
- `<meta charset>` には `bloginfo( 'charset' )` を使用する。
- テーマURLやホームURLをハードコードしない。
- テーマ内アセットのURLには `get_theme_file_uri()` など適切な関数を使用する。
- サイト内URLには `home_url()`、投稿URLには `get_permalink()` など目的に合う関数を使用する。
- CSSとJavaScriptはHTMLへ直書きせず、原則 `wp_enqueue_style()` と `wp_enqueue_script()` で読み込む。
- スクリプトの依存関係、バージョン、フッター読込の要否を明示する。
- WordPressが管理するタイトルを使用し、テンプレートへ固定の `<title>` を記述しない。
- 必要な `add_theme_support()`、メニュー、画像サイズなどはセットアップ用フックで登録する。
- ナビゲーションは原則 `wp_nav_menu()` を使用し、管理画面から運用可能にする。
- 投稿一覧と詳細では、WordPressループとテンプレートタグを使用する。
- ページネーションはWordPress標準関数を優先する。
- アイキャッチが未設定の場合の表示崩れを考慮する。
- 空の投稿一覧、検索結果0件、404、未入力項目などの状態を考慮する。

## 7. PHP・セキュリティ

- PHPはWordPress Coding Standardsを意識し、可読性を優先する。
- 出力時に、文脈に応じて `esc_html()`、`esc_attr()`、`esc_url()`、`wp_kses_post()` などでエスケープする。
- 入力値は保存・処理前に、文脈に応じて `sanitize_text_field()`、`sanitize_email()`、`absint()` などでサニタイズする。
- フォームや更新処理ではnonceを検証する。
- 管理系処理では `current_user_can()` などで権限を確認する。
- `$_GET`、`$_POST`、`$_REQUEST` を未検証のまま使用しない。
- SQLを直接書く必要がある場合は `$wpdb->prepare()` を使用する。ただし、まず `WP_Query` や標準APIで実現できないか検討する。
- `query_posts()` は使用しない。
- 独自の `WP_Query` や `get_posts()` でグローバル投稿データを変更した場合は、必要に応じて `wp_reset_postdata()` を呼ぶ。
- PHPファイル末尾の閉じタグ `?>` は、PHPのみのファイルでは原則省略する。
- デバッグ情報、秘密情報、認証情報をテンプレートやリポジトリへ含めない。
- WordPress、PHP、プラグインのバージョン互換性を、確認せずに断定しない。

## 8. CSS・デザイン

- CSSは `asset/css/tokens.css` のデザイントークンをベースに作成する。
- 共通CSSは `asset/css/reset.css`、`asset/css/base.css`、`asset/css/utility.css`、`asset/css/component.css` を利用する。
- ページ固有CSSは既存の `asset/css/page.css` へ集約し、ページ名入りclassでスコープを分ける。
- ソースCSSは保守しやすい責務別構成を維持し、本番用CSSは可能であれば1ファイルへビルドする。
- コンテンツ幅は最大 `1200px` とする。
- レスポンシブ対応を前提に、モバイルファーストを意識して実装する。
- 指定画像がある場合は `asset/image/` または `images/` 内の既存画像を優先する。
- 指定素材がない画像、イラスト、アイコンは `https://placehold.co` のプレースホルダーで対応する。
- SVGやCSSで無理に仮素材を再現しない。
- 装飾より、可読性、アクセシビリティ、更新運用のしやすさを優先する。

### デザイントークン

- 色、余白、角丸、影、フォントサイズは、既存の `tokens.css` の値を優先する。
- CSSへ同じ値を繰り返し直書きしない。
- 新しいトークンを追加する場合は、既存の命名・スケール・役割との整合性を保つ。
- primary / secondary / tertiary / accent / surface / semantic の役割を外さない。
- グラデーションを多用しない。

### FLOCSS・class命名

- class名はFLOCSSに沿って記述する。
- 既存class名は、明確な理由なく変更しない。
- 本サイト固有のclassプレフィックスは、実ファイルで使用されている `hb` とする。
- 独自に付与するすべてのclass名は、`hb-` または `hb__` で始める。
- サイト共通のFLOCSS classは次の形式とする。
  - Layout: `hb__l-*`
  - Component: `hb__c-*`
  - Project: `hb__p-*`
  - Utility: `hb__u-*`
- ページ固有のclassには `hb-{page-slug}__` プレフィックスを付ける。
  - 例: `hb-privacy__p-document__title`
- 複数ページで再利用する共有パーツにはページ名を含めず、`hb__` プレフィックスを使用する。
  - 例: `hb__p-parts-cta__channels`
- あるページ用に作った要素を他ページでも再利用する場合、別ページのslugを付けたまま流用せず、共有パーツとして `components/` と `hb__*` へ昇格するか、ページごとに責務を分ける。
- 共有CSSファイルにページ固有セレクタを置かず、ページ固有CSSに共有パーツ全体の定義を複製しない。
- JavaScriptの操作対象を示すclassが必要な場合、見た目のclassと責務を分け、既存方針に合わせてフック用命名を使用する。
- WordPressが自動出力する標準classまで無理に独自プレフィックスへ変更しない。

### レイアウト

- 汎用コンテナは `.hb__l-container` を使用する。
- セクション余白は `.hb__l-section` を基本とする。
- 必要に応じて `.hb__l-section--sm`、`.hb__l-section--lg` など既存バリエーションを使用する。
- 共通レイアウトで代用できるものをページ固有CSSで再定義しない。
- `body`、`html`、`*`、`box-sizing`、`font-family` など共通CSSの責務を、個別コンポーネントで重複定義しない。
- モバイル表示で、テキスト、画像、表、フォーム、管理者が入力した長い文字列がはみ出さないようにする。

## 9. JavaScript

- WordPressで読み込むJavaScriptは、既存の `asset/js/` を優先して再利用する。
- `include-components.js` は静的HTML制作専用とし、WordPressテーマでは読み込まない。
- インラインスクリプトを乱立させず、アセットとして管理する。
- DOM要素が存在しないページでもエラーにならないようにする。
- 複数要素に対応し、同一IDの重複を作らない。
- ハンバーガーメニュー、タブ、アコーディオンなどは、キーボード操作と `aria-expanded` 等の状態更新を考慮する。
- WordPressから値を渡す場合は、用途に応じてインラインスクリプト用APIやデータ属性を利用し、PHP文字列を危険な形でJavaScriptへ連結しない。

## 10. アクセシビリティ・HTML

- 見出し階層を保ち、見た目の都合だけで見出しレベルを選ばない。
- ランドマーク要素を適切に使用する。
- 画像には用途に合う代替テキストを設定する。装飾画像は空の `alt` を検討する。
- フォーム部品にはラベルを関連付ける。
- リンクとボタンを用途で使い分ける。
- キーボードフォーカスを視認可能にする。
- 文字と背景のコントラストを確保する。
- 外部ライブラリやWordPressが出力するHTMLを含め、ID重複を避ける。

## 11. 作業手順

1. 対象となる静的HTML、関連コンポーネント、CSS、JavaScript、画像を確認する。
2. WordPressテーマ化時は `WP-THEME-CONVERSION-PLAN.md` を確認し、未決定事項を確定する。
3. WEB要素を変更する場合は `design.md` と `asset/css/tokens.css` を確認する。
4. 静的HTML上で、ページ固有部分と `components/` の共有部分を区別する。
5. 対応するWordPressテンプレート階層と、動的化する項目を整理する。
6. `[data-hb-include]` ごとに、`header.php`、`footer.php`、`template-parts/` の移植先を決める。
7. ページ内の `<style>` とインラインJavaScriptの移動先を決める。
8. classがページ固有 `hb-{page-slug}__*` と共有 `hb__*` に正しく分かれているか確認する。
9. WordPress標準APIを使って実装する。
10. PHP構文、エスケープ、URL、アセット読込、ループ、クエリリセットを確認する。
11. PCとモバイルの両方で表示確認する。
12. WordPress管理画面から内容を変更した場合も崩れないことを確認する。
13. 下記のレビュー項目に沿って自己レビューする。
14. テーマ化完了時は `THEME-COMPLETION-CHECKLIST.md` を使用し、該当項目を確認する。

## 12. 実装後レビュー

### WordPress

- テンプレート階層とファイル名が目的に合っているか。
- `[data-hb-include]` と `include-components.js` がWordPressのフロント表示に残っていないか。
- 静的HTMLのインラインCSS・JavaScriptがPHPテンプレートに持ち込まれていないか。
- `wp_head()`、`wp_body_open()`、`wp_footer()` が適切に呼ばれているか。
- URLやアセットパスがハードコードされていないか。
- CSS・JavaScriptがenqueueされているか。
- 共通パーツが重複していないか。
- ループ、ページネーション、空状態、404が適切か。
- 独自クエリ後の状態復元ができているか。
- 管理画面から入力された長文、未入力、画像未設定に耐えられるか。

### セキュリティ

- 動的出力が文脈に応じてエスケープされているか。
- 入力値がサニタイズされているか。
- 更新処理にnonceと権限確認があるか。
- 秘密情報やデバッグ出力が残っていないか。

### デザイン・CSS

- `design.md` のトーンに沿っているか。
- `tokens.css` の色、余白、角丸、影、フォントサイズを優先しているか。
- FLOCSSと指定プレフィックスに沿っているか。
- ページ固有classが `hb-{page-slug}__*`、共有パーツが `hb__*` に分かれているか。
- 別ページのslugを持つclassを、共有classの代用として流用していないか。
- 共通CSSや `.hb__l-container`、`.hb__l-section` を再利用しているか。
- 同じ指定を重複定義していないか。
- 過度に派手、チラシ的、蛍光色の多用、煽りすぎる表現になっていないか。
- PCとモバイルで余白、CTA位置、横並びから縦並びへの変化が自然か。

### 表示・操作

- 主要なWordPressテンプレートで表示崩れがないか。
- PC表示とモバイル表示の両方を確認したか。
- メニュー、タブ、アコーディオンなど各状態を確認したか。
- キーボード操作とフォーカス表示に問題がないか。
- 見た目の最終確認は、ユーザーが開いているブラウザでの確認を正とする。

## 13. 作業ログ

- 各作業の終了時に、プロジェクト直下の `WORK-LOG.md` へ簡単な記録を追記する。
- 記録には、日付、作業名、状態、実施内容、主な変更ファイル、未完了事項、次回の着手点を含める。
- 細かなファイル変更履歴はGitに任せ、作業ログには判断内容と再開に必要な情報を優先して残す。
- ファイルを変更しない調査・確認作業でも、今後の判断や再開に影響する場合は記録する。

## 14. 完了報告

完了時は、次を簡潔に報告する。

- 作成・変更したテンプレートと機能
- 静的HTMLから動的化した項目
- 実施した検証
- `THEME-COMPLETION-CHECKLIST.md` の確認状況
- 未確認事項、WordPress環境やプラグインに依存する事項
