# Design QA: スマホ固定CTA

- Source visual truth: `C:\Users\pc\AppData\Local\Temp\codex-clipboard-f324a866-d806-4ccf-ae71-ae191116fa87.png`
- Implementation screenshot: `C:\Users\pc\Documents\work\wp-theme_coms-hobby\design-qa-mobile-fixed-cta.png`
- Focused comparison: `C:\Users\pc\Documents\work\wp-theme_coms-hobby\design-qa-mobile-fixed-cta-comparison.png`
- State: トップページ、スマホ用固定CTA表示、通常状態
- Source pixels: 581 × 215 px（比較では電話CTAを除いた上段 581 × 106 pxを使用）
- Implementation pixels: 347 × 580 px
- Browser viewport: 362 × 606 CSS px、devicePixelRatio 1.25
- Density normalization: 比較画像では両CTA領域を幅581pxへ揃えた

## Full-view comparison evidence

- 固定CTAは画面下端に固定され、コンテンツの閲覧中も表示される。
- WEB査定とLINE査定を2分割で横並びにし、参考画像から電話CTAを除いた構成を再現した。
- 本文末尾がCTAの背面へ隠れないよう、モバイル時の`body`へ固定領域分の下余白を設定した。
- PC幅1024pxでは固定CTAが`display: none`、`body`下余白が`0px`であることを確認した。

## Focused region comparison evidence

- `design-qa-mobile-fixed-cta-comparison.png`で、参考画像の上段CTAと実装CTAを同一幅に正規化して比較した。
- 文言、2分割構成、角丸、白文字、LINEアイコンの配置は参考画像と一致する。
- 色はユーザー指定を優先し、WEB査定を既存トークン`--hb-color-brand-orange`、LINEを`--hb-color-line`へ意図的に変更した。

## Required fidelity surfaces

- Fonts and typography: 既存の`Noto Sans JP`、caption/bodyトークン、太字を使用。2行構成と折り返しを確認した。
- Spacing and layout rhythm: 左右8px、ボタン間8px、ボタン高56px、固定領域高72px。セーフエリアと本文下余白を確認した。
- Colors and visual tokens: 既存CTAと共通の`--hb-gradient-cta-orange`、`--hb-gradient-cta-line`を使用。ブラウザの計算済みスタイルでも双方の縦グラデーションを確認した。
- Image quality and asset fidelity: 既存の白色LINE SVGを再利用し、拡大時も鮮明。新規の代替図形は作成していない。
- Copy and content: 「カンタン1分！／無料でWEB査定」「24時間受付OK！／LINEで査定する」を確認した。

## Comparison history

1. 初回比較
   - Finding [P2]: 固定領域が参考画像より高く、LINEアイコンが小さく見えた。
   - Fix: ボタン最小高を64pxから52pxへ、固定領域実測を72pxへ調整。LINEアイコン枠を32pxから40pxへ拡大した。
2. 再比較
   - Post-fix evidence: `design-qa-mobile-fixed-cta-comparison.png`で高さの比率とアイコンの視認性が改善し、P0/P1/P2の差異が残っていないことを確認した。
3. 既存CTAとのグラデーション統一
   - Refinement: オレンジとLINEの既存CTAグラデーションを共通トークン化し、固定CTAにも適用した。
   - Post-fix evidence: ブラウザの計算済み`background-image`と更新後の比較画像で、自然な縦方向の濃淡を確認した。

## Interaction and console checks

- WEB査定ボタンから`pages/page-contact.html`へ遷移することを確認した。
- LINEボタンのリンク先が`https://line.me/R/ti/p/@081xadbs`であることを確認した。
- クリーンな390 × 844 CSS pxの再読み込みでブラウザコンソールエラーが0件であることを確認した。
- 390px幅でフォームページは固定CTAが非表示かつ`body`下余白が0px、トップページは固定CTAが表示され`body`下余白が76pxであることを確認した。

## Findings

- P0/P1/P2の未解決事項なし。
- 参考画像のピンクはユーザー指定により既存CTAのオレンジへ置換しているため、意図した差異として扱う。

## Follow-up polish

- 実機のiPhone/Androidで、`safe-area-inset-bottom`とブラウザUI表示時の下端位置を最終確認するとより確実。

final result: passed
