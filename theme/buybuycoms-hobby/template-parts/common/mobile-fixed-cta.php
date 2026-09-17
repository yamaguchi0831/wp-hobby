<?php
/**
 * Mobile fixed CTA.
 *
 * @package BuyBuyComs_Hobby
 */

if ( is_page( 'contact' ) || is_page_template( 'page-contact.php' ) ) {
	return;
}
?>
<aside class="hb__p-mobile-fixed-cta" aria-label="<?php esc_attr_e( '無料査定メニュー', 'buybuycoms-hobby' ); ?>">
	<div class="hb__p-mobile-fixed-cta__inner">
		<a class="hb__p-mobile-fixed-cta__button hb__p-mobile-fixed-cta__button--web" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
			<span class="hb__p-mobile-fixed-cta__eyebrow"><?php esc_html_e( 'カンタン1分！', 'buybuycoms-hobby' ); ?></span>
			<span class="hb__p-mobile-fixed-cta__label"><?php esc_html_e( '無料でWEB査定', 'buybuycoms-hobby' ); ?></span>
		</a>
		<a class="hb__p-mobile-fixed-cta__button hb__p-mobile-fixed-cta__button--line" href="<?php echo esc_url( 'https://line.me/R/ti/p/@081xadbs' ); ?>">
			<img class="hb__p-mobile-fixed-cta__icon" src="<?php echo esc_url( get_theme_file_uri( '/images/icon/icon-cta_line.svg' ) ); ?>" alt="">
			<span class="hb__p-mobile-fixed-cta__copy">
				<span class="hb__p-mobile-fixed-cta__eyebrow"><?php esc_html_e( '24時間受付OK！', 'buybuycoms-hobby' ); ?></span>
				<span class="hb__p-mobile-fixed-cta__label"><?php esc_html_e( 'LINEで査定する', 'buybuycoms-hobby' ); ?></span>
			</span>
		</a>
	</div>
</aside>
