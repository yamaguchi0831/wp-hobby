# 第1段階テーマ化 検証状況

更新日: 2026-07-29

## 完了

- クラシックテーマの基本ファイルを作成
- `wp_head()`、`wp_body_open()`、`wp_footer()`を実装
- `language_attributes()`、`body_class()`、タイトルサポートを実装
- CSSとJavaScriptをenqueue
- ヘッダーとフッターをPHP出力へ移行
- 静的コンポーネントをテンプレートパーツへ移行
- 15種類の静的参照画面をPHPテンプレートへ移行
- PHPファイルからインラインCSS・JavaScriptを除去
- `include-components.js` と `[data-hb-include]` の依存を除去
- テーマ内アセットを `get_theme_file_uri()` で参照
- PHP構文検査を実施
- 汎用ページ、アーカイブ、検索、404の空状態を実装

## Localで確認予定

- テーマの有効化
- 各固定ページのslugとテンプレート選択
- PC・モバイルの静的HTMLとの表示比較
- CSS・JavaScript・画像の404
- ブラウザコンソールエラー
- FAQ、タブ、フォームUIの操作
- キーボード操作とフォーカス表示
- `WP_DEBUG`、PHP Warning、Notice、Deprecated
- WordPress管理バー表示時のレイアウト

## 次段階

- CPT、タクソノミー、カスタムフィールドの仕様確定
- メインビジュアル画像の動的化
- 買取実績テーブルの動的化
- 一覧、詳細、関連記事をWordPressループへ接続
- フォーム送信機能の採用方式を確定
- エディター表示と公開画面の比較
- `THEME-COMPLETION-CHECKLIST.md` の全項目確認
