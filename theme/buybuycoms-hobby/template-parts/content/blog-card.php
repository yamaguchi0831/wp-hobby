<?php
/**
 * Static first-stage template part: blog-card.
 *
 * @package BuyBuyComs_Hobby
 */
?>
<a class="hb__p-blog-card" href="<?php echo esc_url( home_url( '/genre-list/' ) ); ?>">
  <figure class="hb__p-blog-card__image">
    <img
      src="<?php echo esc_url( get_theme_file_uri( '/images/genre/mv_gandamu.webp' ) ); ?>"
      alt="ガンプラ買取のイメージ"
      width="1000"
      height="750"
    />
  </figure>
  <span class="hb__p-blog-card__body">
    <span class="hb__p-blog-card__title">XXXXをまとめて高価買取</span>
    <span class="hb__p-blog-card__text">
      ココにテキストが入りますココにテキストが入ります
    </span>
    <span class="hb__p-blog-card__divider" aria-hidden="true"></span>
    <span class="hb__p-blog-card__button">[genre]の買取ページを見る</span>
  </span>
</a>
