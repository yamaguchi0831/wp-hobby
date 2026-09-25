<?php
/**
 * Site header.
 *
 * @package BuyBuyComs_Hobby
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-5BPG8RCN');</script>
	<!-- End Google Tag Manager -->
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="format-detection" content="telephone=no">
	<link rel="icon" href="<?php echo esc_url( get_theme_file_uri( '/images/favicon.ico' ) ); ?>" type="image/x-icon" sizes="any">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5BPG8RCN" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
<?php wp_body_open(); ?>
<a class="hb__u-skip-link screen-reader-text" href="#main-content">
	<?php esc_html_e( '本文へ移動', 'buybuycoms-hobby' ); ?>
</a>

<header class="hb__l-header" data-screen-label="01 Header">
	<div class="hb__l-container hb__p-header">
		<?php buybuycoms_hobby_brand(); ?>

		<nav class="hb__p-header__nav" aria-label="<?php esc_attr_e( 'グローバルナビ', 'buybuycoms-hobby' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_id'        => 'hb-primary-menu',
					'menu_class'     => 'hb__p-header__nav-list',
					'fallback_cb'    => 'buybuycoms_hobby_primary_menu_fallback',
					'depth'          => 2,
				)
			);
			?>
		</nav>

		<div class="hb__p-header__cta">
			<a href="tel:0120371147" class="hb__p-header__tel">
				<span class="hb__p-header__tel-label"><?php esc_html_e( '通話無料', 'buybuycoms-hobby' ); ?></span>
				<span class="hb__p-header__tel-num">0120-37-1147</span>
			</a>
			<a
				href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"
				class="hb__c-btn hb__c-btn--primary hb__c-btn--sm"
			>
				<?php esc_html_e( '無料査定を申し込む', 'buybuycoms-hobby' ); ?>
			</a>
		</div>

		<button
			class="hb__p-header__menu-button"
			type="button"
			aria-controls="hb-mobile-menu"
			aria-expanded="false"
			aria-label="<?php esc_attr_e( 'メニューを開く', 'buybuycoms-hobby' ); ?>"
			data-hb-mobile-menu-toggle
		>
			<span class="hb__p-header__menu-icon" aria-hidden="true"></span>
		</button>
	</div>
</header>

<div class="hb__p-header-drawer__overlay" data-hb-mobile-menu-close aria-hidden="true"></div>
<aside
	id="hb-mobile-menu"
	class="hb__p-header-drawer"
	aria-label="<?php esc_attr_e( 'モバイルメニュー', 'buybuycoms-hobby' ); ?>"
	aria-hidden="true"
	inert
>
	<div class="hb__p-header-drawer__header">
		<p class="hb__p-header-drawer__title"><?php esc_html_e( 'メニュー', 'buybuycoms-hobby' ); ?></p>
		<button
			class="hb__p-header-drawer__close"
			type="button"
			data-hb-mobile-menu-close
			aria-label="<?php esc_attr_e( 'メニューを閉じる', 'buybuycoms-hobby' ); ?>"
		>×</button>
	</div>

	<nav class="hb__p-header-drawer__nav" aria-label="<?php esc_attr_e( 'モバイル用グローバルナビ', 'buybuycoms-hobby' ); ?>">
		<?php
		wp_nav_menu(
			array(
				'theme_location'    => 'primary',
				'container'         => false,
				'menu_id'           => 'hb-mobile-menu-list',
				'menu_class'        => 'hb__p-header-drawer__nav-list',
				'fallback_cb'       => 'buybuycoms_hobby_primary_menu_fallback',
				'depth'             => 1,
				'hb_menu_context'   => 'mobile',
			)
		);
		?>
	</nav>

	<div class="hb__p-header-drawer__cta">
		<span><?php esc_html_e( '24時間受付中・査定料無料', 'buybuycoms-hobby' ); ?></span>
		<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
			<?php esc_html_e( '無料査定を申し込む', 'buybuycoms-hobby' ); ?>
		</a>
	</div>
</aside>
