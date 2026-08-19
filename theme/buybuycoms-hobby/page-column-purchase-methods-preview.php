<?php
/**
 * Template Name: コラム用買取方法コンポーネント確認
 *
 * @package BuyBuyComs_Hobby
 */

get_header();
?>

<main id="main-content">
  <section class="hb__l-section" aria-labelledby="hb-column-methods-preview-title">
    <div class="hb__l-container">
      <article class="hb-column-methods-preview__p-article">
        <h1 class="hb-column-methods-preview__p-title" id="hb-column-methods-preview-title">
          <?php esc_html_e( 'コラム用・買取方法コンポーネント確認', 'buybuycoms-hobby' ); ?>
        </h1>
        <p class="hb-column-methods-preview__p-lead">
          <?php esc_html_e( 'コラム本文の最大幅635pxを想定した表示です。', 'buybuycoms-hobby' ); ?>
        </p>
        <?php
        get_template_part(
          'template-parts/common/purchase-methods',
          null,
          array(
            'variant'  => 'column-tabs',
            'instance' => 'column-tabs-preview',
          )
        );
        ?>
        <section class="hb-column-methods-preview__p-alternative" aria-labelledby="hb-column-methods-preview-alternative-title">
          <h2 class="hb-column-methods-preview__p-alternative-title" id="hb-column-methods-preview-alternative-title">
            <?php esc_html_e( 'カード一覧優先パターン', 'buybuycoms-hobby' ); ?>
          </h2>
          <p class="hb-column-methods-preview__p-lead">
            <?php esc_html_e( '親ボックスの幅が450px未満になった場合のみ、タブ表示へ切り替わります。', 'buybuycoms-hobby' ); ?>
          </p>
          <?php
          get_template_part(
            'template-parts/common/purchase-methods',
            null,
            array(
              'variant'  => 'column-auto-tabs',
              'instance' => 'column-auto-tabs-preview',
            )
          );
          ?>
        </section>
      </article>
    </div>
  </section>
</main>

<?php get_footer();
