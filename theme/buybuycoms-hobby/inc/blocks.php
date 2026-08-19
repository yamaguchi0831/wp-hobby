<?php
/**
 * Custom block registration.
 *
 * @package BuyBuyComs_Hobby
 */

/**
 * Render the column purchase-methods block.
 *
 * @return string
 */
function buybuycoms_hobby_render_column_purchase_methods_block() {
	static $instance = 0;
	$instance++;

	ob_start();
	get_template_part(
		'template-parts/common/purchase-methods',
		null,
		array(
			'variant'  => 'column-auto-tabs',
			'instance' => 'column-block-' . $instance,
		)
	);

	return (string) ob_get_clean();
}

/**
 * Register custom editor blocks.
 *
 * @return void
 */
function buybuycoms_hobby_register_blocks() {
	$script_path = '/asset/js/blocks/column-purchase-methods.js';

	wp_register_script(
		'buybuycoms-hobby-column-purchase-methods-block',
		get_theme_file_uri( $script_path ),
		array( 'wp-blocks', 'wp-block-editor', 'wp-element', 'wp-i18n', 'wp-server-side-render' ),
		buybuycoms_hobby_asset_version( $script_path ),
		true
	);

	register_block_type(
		'buybuycoms-hobby/column-purchase-methods',
		array(
			'api_version'     => 2,
			'editor_script'   => 'buybuycoms-hobby-column-purchase-methods-block',
			'render_callback' => 'buybuycoms_hobby_render_column_purchase_methods_block',
			'supports'        => array(
				'html' => false,
			),
		)
	);
}
add_action( 'init', 'buybuycoms_hobby_register_blocks' );

/**
 * Load component styling for the block editor preview.
 *
 * @return void
 */
function buybuycoms_hobby_enqueue_block_editor_assets() {
	$style_path = '/asset/css/component.css';

	wp_enqueue_style(
		'buybuycoms-hobby-block-editor-components',
		get_theme_file_uri( $style_path ),
		array(),
		buybuycoms_hobby_asset_version( $style_path )
	);
}
add_action( 'enqueue_block_editor_assets', 'buybuycoms_hobby_enqueue_block_editor_assets' );
