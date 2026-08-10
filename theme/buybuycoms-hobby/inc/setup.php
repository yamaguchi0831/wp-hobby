<?php
/**
 * Theme setup.
 *
 * @package BuyBuyComs_Hobby
 */

/**
 * Register theme supports and menus.
 *
 * @return void
 */
function buybuycoms_hobby_setup() {
	load_theme_textdomain( 'buybuycoms-hobby', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'editor-styles' );
	add_editor_style(
		array(
			'asset/css/tokens.css',
			'asset/css/editor-style.css',
		)
	);
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 80,
			'width'       => 240,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	register_nav_menus(
		array(
			'primary' => __( 'グローバルナビ', 'buybuycoms-hobby' ),
			'footer'  => __( 'フッターナビ', 'buybuycoms-hobby' ),
		)
	);
}
add_action( 'after_setup_theme', 'buybuycoms_hobby_setup' );

/**
 * Hide the comments menu from the WordPress admin navigation.
 *
 * @return void
 */
function buybuycoms_hobby_hide_comments_menu() {
	remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'buybuycoms_hobby_hide_comments_menu', 999 );
