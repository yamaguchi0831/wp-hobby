<?php
/**
 * Static first-stage template part: parts-cta.
 *
 * @package BuyBuyComs_Hobby
 */
?>
<section class="hb__p-parts-cta" aria-label="無料査定の申し込み">
  <div class="hb__p-parts-cta__inner">
    <div class="hb__p-parts-cta__channels">
      <a
        class="hb__p-parts-cta__ch hb__p-parts-cta__ch--form"
        href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"
      >
        <span class="hb__p-parts-cta__icon">
          <img src="<?php echo esc_url( get_theme_file_uri( '/images/icon/cta-ican01.svg' ) ); ?>" alt="" />
        </span>
        <span class="hb__p-parts-cta__content">
          <span class="hb__p-parts-cta__heading">買取を依頼する</span>
          <span class="hb__p-parts-cta__text"
            >買取方法は3種類！<br />24時間受付中！</span
          >
        </span>
        <span class="hb__p-parts-cta__button">
          <span class="hb__p-parts-cta__button-text"
            >無料査定を<span class="hb__p-parts-cta__pc-break"><br /></span
            >申し込む</span
          >
          <span class="hb__p-parts-cta__arrow" aria-hidden="true"></span>
        </span>
      </a>
      <a class="hb__p-parts-cta__ch hb__p-parts-cta__ch--line" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
        <span class="hb__p-parts-cta__icon">
          <img src="<?php echo esc_url( get_theme_file_uri( '/images/icon/cta-ican02.svg' ) ); ?>" alt="" />
        </span>
        <span class="hb__p-parts-cta__content">
          <span class="hb__p-parts-cta__heading">LINEで写真査定する</span>
          <span class="hb__p-parts-cta__text"
            >写真を撮って送るだけ！<br />24時間受付中！</span
          >
        </span>
        <span class="hb__p-parts-cta__button">
          <span class="hb__p-parts-cta__button-text"
            >LINEで<span class="hb__p-parts-cta__pc-break"><br /></span
            >査定する</span
          >
          <span class="hb__p-parts-cta__arrow" aria-hidden="true"></span>
        </span>
      </a>
    </div>
  </div>
</section>
