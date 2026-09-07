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
 * Return the image markup for an internal link card genre.
 *
 * @param WP_Term $genre_term Genre term.
 * @return string
 */
function buybuycoms_hobby_get_internal_link_card_genre_image( $genre_term ) {
	$context  = 'genre_' . $genre_term->term_id;
	$genre_mv = function_exists( 'get_field' )
		? get_field( 'genre-mv', $context )
		: get_term_meta( $genre_term->term_id, 'genre-mv', true );
	$alt      = $genre_term->name . '買取のイメージ';

	if ( is_array( $genre_mv ) && ! empty( $genre_mv['ID'] ) ) {
		return wp_get_attachment_image(
			(int) $genre_mv['ID'],
			'large',
			false,
			array( 'alt' => ! empty( $genre_mv['alt'] ) ? $genre_mv['alt'] : $alt )
		);
	}

	if ( is_numeric( $genre_mv ) ) {
		return wp_get_attachment_image( (int) $genre_mv, 'large', false, array( 'alt' => $alt ) );
	}

	if ( is_array( $genre_mv ) && ! empty( $genre_mv['url'] ) ) {
		return sprintf(
			'<img src="%1$s" alt="%2$s">',
			esc_url( $genre_mv['url'] ),
			esc_attr( ! empty( $genre_mv['alt'] ) ? $genre_mv['alt'] : $alt )
		);
	}

	if ( is_string( $genre_mv ) && '' !== $genre_mv ) {
		return sprintf( '<img src="%1$s" alt="%2$s">', esc_url( $genre_mv ), esc_attr( $alt ) );
	}

	return '<img src="https://placehold.co/600x450?text=No+Image" alt="">';
}

/**
 * Return a shortened, post-specific AIOSEO description for an internal link card.
 *
 * @param WP_Post $column Column post object.
 * @return string
 */
function buybuycoms_hobby_get_internal_link_card_column_description( $column ) {
	if ( ! $column instanceof WP_Post ) {
		return '';
	}

	$description = '';

	if ( function_exists( 'aioseo' ) ) {
		$aioseo = aioseo();

		if (
			isset( $aioseo->meta, $aioseo->meta->metaData, $aioseo->meta->description ) &&
			method_exists( $aioseo->meta->metaData, 'getMetaData' ) &&
			method_exists( $aioseo->meta->description, 'getPostDescription' )
		) {
			$meta_data = $aioseo->meta->metaData->getMetaData( $column );

			if ( $meta_data && ! empty( $meta_data->description ) ) {
				$description = $aioseo->meta->description->getPostDescription( $column );
			}
		}
	}

	if ( '' === $description ) {
		foreach ( array( '_aioseo_description', 'aioseo_description', '_aioseop_description' ) as $meta_key ) {
			$description = get_post_meta( $column->ID, $meta_key, true );

			if ( is_string( $description ) && '' !== $description ) {
				break;
			}
		}
	}

	$description = is_string( $description ) ? $description : '';
	$description = html_entity_decode( wp_strip_all_tags( $description ), ENT_QUOTES, get_bloginfo( 'charset' ) );
	$description = preg_replace( '/\s+/u', ' ', $description );
	$description = is_string( $description ) ? trim( $description ) : '';

	if ( '' === $description ) {
		return '';
	}

	if ( function_exists( 'mb_strlen' ) && function_exists( 'mb_substr' ) && mb_strlen( $description, 'UTF-8' ) > 50 ) {
		return mb_substr( $description, 0, 50, 'UTF-8' ) . '…';
	}

	$characters = preg_split( '//u', $description, -1, PREG_SPLIT_NO_EMPTY );

	if ( is_array( $characters ) && count( $characters ) > 50 ) {
		return implode( '', array_slice( $characters, 0, 50 ) ) . '…';
	}

	return $description;
}

/**
 * Render the internal link card block.
 *
 * @param array<string, mixed> $attributes Block attributes.
 * @return string
 */
function buybuycoms_hobby_render_internal_link_card_block( $attributes ) {
	$content_type = isset( $attributes['contentType'] ) ? sanitize_key( $attributes['contentType'] ) : 'genre';
	$content_id   = isset( $attributes['contentId'] ) ? absint( $attributes['contentId'] ) : 0;

	if ( ! in_array( $content_type, array( 'genre', 'column' ), true ) || ! $content_id ) {
		return '';
	}

	ob_start();
	get_template_part(
		'template-parts/content/internal-link-card',
		null,
		array(
			'content_type' => $content_type,
			'content_id'   => $content_id,
		)
	);

	return (string) ob_get_clean();
}

/**
 * Return selectable internal link card content for the block editor.
 *
 * @param WP_REST_Request $request REST request.
 * @return WP_REST_Response
 */
function buybuycoms_hobby_get_internal_link_card_options( $request ) {
	$content_type = sanitize_key( (string) $request->get_param( 'content_type' ) );
	$options      = array();

	if ( 'genre' === $content_type ) {
		$terms = get_terms(
			array(
				'taxonomy'   => 'genre',
				'hide_empty' => false,
				'orderby'    => 'name',
				'order'      => 'ASC',
			)
		);

		if ( ! is_wp_error( $terms ) ) {
			foreach ( $terms as $term ) {
				$options[] = array(
					'value' => (string) $term->term_id,
					'label' => $term->name,
				);
			}
		}
	} elseif ( 'column' === $content_type ) {
		$columns = get_posts(
			array(
				'post_type'      => 'column',
				'post_status'    => 'publish',
				'posts_per_page' => -1,
				'orderby'        => 'title',
				'order'          => 'ASC',
			)
		);

		foreach ( $columns as $column ) {
			$options[] = array(
				'value' => (string) $column->ID,
				'label' => get_the_title( $column ),
			);
		}
	}

	return rest_ensure_response( $options );
}

/**
 * Register the internal link card editor endpoint.
 *
 * @return void
 */
function buybuycoms_hobby_register_internal_link_card_rest_route() {
	register_rest_route(
		'buybuycoms-hobby/v1',
		'/internal-link-card-options',
		array(
			'methods'             => WP_REST_Server::READABLE,
			'callback'            => 'buybuycoms_hobby_get_internal_link_card_options',
			'permission_callback' => static function () {
				return current_user_can( 'edit_posts' );
			},
			'args'                => array(
				'content_type' => array(
					'required'          => true,
					'sanitize_callback' => 'sanitize_key',
					'validate_callback' => static function ( $value ) {
						return in_array( $value, array( 'genre', 'column' ), true );
					},
				),
			),
		)
	);
}
add_action( 'rest_api_init', 'buybuycoms_hobby_register_internal_link_card_rest_route' );

/**
 * Register custom editor blocks.
 *
 * @return void
 */
function buybuycoms_hobby_register_blocks() {
	$script_path = '/asset/js/blocks/column-purchase-methods.js';
	$internal_link_card_script_path = '/asset/js/blocks/internal-link-card.js';

	wp_register_script(
		'buybuycoms-hobby-column-purchase-methods-block',
		get_theme_file_uri( $script_path ),
		array( 'wp-blocks', 'wp-block-editor', 'wp-element', 'wp-i18n', 'wp-server-side-render' ),
		buybuycoms_hobby_asset_version( $script_path ),
		true
	);

	wp_register_script(
		'buybuycoms-hobby-internal-link-card-block',
		get_theme_file_uri( $internal_link_card_script_path ),
		array( 'wp-api-fetch', 'wp-block-editor', 'wp-blocks', 'wp-components', 'wp-element', 'wp-i18n', 'wp-server-side-render' ),
		buybuycoms_hobby_asset_version( $internal_link_card_script_path ),
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

	register_block_type(
		'buybuycoms-hobby/internal-link-card',
		array(
			'api_version'     => 2,
			'editor_script'   => 'buybuycoms-hobby-internal-link-card-block',
			'render_callback' => 'buybuycoms_hobby_render_internal_link_card_block',
			'attributes'      => array(
				'contentType' => array(
					'type'    => 'string',
					'default' => 'genre',
				),
				'contentId'   => array(
					'type'    => 'number',
					'default' => 0,
				),
			),
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
