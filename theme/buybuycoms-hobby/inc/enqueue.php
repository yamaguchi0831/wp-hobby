<?php
/**
 * Front-end assets.
 *
 * @package BuyBuyComs_Hobby
 */

/**
 * Return an asset version based on its modification time.
 *
 * @param string $relative_path Theme-relative path.
 * @return string
 */
function buybuycoms_hobby_asset_version( $relative_path ) {
	$path = get_theme_file_path( $relative_path );

	return file_exists( $path ) ? (string) filemtime( $path ) : wp_get_theme()->get( 'Version' );
}

/**
 * Enqueue front-end styles and scripts.
 *
 * @return void
 */
function buybuycoms_hobby_enqueue_assets() {
	$styles = array(
		'buybuycoms-hobby-tokens'     => '/asset/css/tokens.css',
		'buybuycoms-hobby-reset'      => '/asset/css/reset.css',
		'buybuycoms-hobby-base'       => '/asset/css/base.css',
		'buybuycoms-hobby-utility'    => '/asset/css/utility.css',
		'buybuycoms-hobby-component'  => '/asset/css/component.css',
		'buybuycoms-hobby-page'       => '/asset/css/page.css',
		'buybuycoms-hobby-page-static' => '/asset/css/page-static.css',
	);
	$previous = array();

	foreach ( $styles as $handle => $path ) {
		wp_enqueue_style(
			$handle,
			get_theme_file_uri( $path ),
			$previous,
			buybuycoms_hobby_asset_version( $path )
		);
		$previous = array( $handle );
	}

	wp_enqueue_style(
		'buybuycoms-hobby-fonts',
		'https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700;900&display=swap',
		array(),
		null
	);

	wp_enqueue_script(
		'buybuycoms-hobby-components',
		get_theme_file_uri( '/asset/js/component.js' ),
		array(),
		buybuycoms_hobby_asset_version( '/asset/js/component.js' ),
		true
	);

	$page_script = buybuycoms_hobby_get_page_script();
	if ( $page_script ) {
		wp_enqueue_script(
			'buybuycoms-hobby-page',
			get_theme_file_uri( $page_script ),
			array(),
			buybuycoms_hobby_asset_version( $page_script ),
			true
		);
	}
}
add_action( 'wp_enqueue_scripts', 'buybuycoms_hobby_enqueue_assets' );

/**
 * Resolve the static-stage page script for the current template.
 *
 * @return string
 */
function buybuycoms_hobby_get_page_script() {
	$page_map = array(
		'contact' => array( 'page-contact.php', '/asset/js/pages/page-contact.js' ),
		'faq'     => array( 'page-faq.php', '/asset/js/pages/page-faq.js' ),
		'flow'    => array( 'page-flow.php', '/asset/js/pages/page-flow.js' ),
	);

	foreach ( $page_map as $slug => $page_data ) {
		if ( is_page( $slug ) || is_page_template( $page_data[0] ) ) {
			return $page_data[1];
		}
	}

	if ( is_front_page() ) {
		return '/asset/js/pages/front-page.js';
	}

	if ( is_tax( 'genre' ) ) {
		return '/asset/js/pages/taxonomy-genre.js';
	}

	return '';
}
