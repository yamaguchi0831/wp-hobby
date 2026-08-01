<?php
/**
 * Context-aware purchase record cards.
 *
 * Shows the latest purchase records by default. On a genre archive or a
 * singular post assigned to genre terms, records are limited to that context.
 *
 * @package BuyBuyComs_Hobby
 */

$posts_per_page = isset( $args['posts_per_page'] ) ? max( 1, absint( $args['posts_per_page'] ) ) : 8;
$initial_visible = isset( $args['initial_visible'] ) ? absint( $args['initial_visible'] ) : 0;
$grid_id         = isset( $args['grid_id'] ) ? sanitize_html_class( $args['grid_id'] ) : '';
$post_ids        = isset( $args['post_ids'] ) && is_array( $args['post_ids'] ) ? array_values( array_filter( array_map( 'absint', $args['post_ids'] ) ) ) : array();
$all_post_ids    = isset( $args['all_post_ids'] ) && is_array( $args['all_post_ids'] ) ? array_values( array_filter( array_map( 'absint', $args['all_post_ids'] ) ) ) : array();
$filter_term_ids_by_post_id = isset( $args['filter_term_ids_by_post_id'] ) && is_array( $args['filter_term_ids_by_post_id'] ) ? $args['filter_term_ids_by_post_id'] : array();

$purchase_record_query_args = array(
	'post_type'           => 'purchase-record',
	'post_status'         => 'publish',
	'posts_per_page'      => $posts_per_page,
	'orderby'             => 'date',
	'order'               => 'DESC',
	'ignore_sticky_posts' => true,
	'no_found_rows'       => true,
);
$purchase_record_genre_ids  = array();

if ( $post_ids ) {
	$purchase_record_query_args['post__in']       = $post_ids;
	$purchase_record_query_args['posts_per_page'] = count( $post_ids );
} elseif ( is_tax( 'genre' ) ) {
	$queried_genre = get_queried_object();

	if ( $queried_genre instanceof WP_Term ) {
		$purchase_record_genre_ids = array( (int) $queried_genre->term_id );
	}
} elseif ( is_singular() ) {
	$context_genres = get_the_terms( get_queried_object_id(), 'genre' );

	if ( ! is_wp_error( $context_genres ) && $context_genres ) {
		$purchase_record_genre_ids = array_map( 'intval', wp_list_pluck( $context_genres, 'term_id' ) );
	}
}

if ( $purchase_record_genre_ids ) {
	$purchase_record_query_args['tax_query'] = array(
		array(
			'taxonomy'         => 'genre',
			'field'            => 'term_id',
			'terms'            => $purchase_record_genre_ids,
			'operator'         => 'IN',
			'include_children' => is_tax( 'genre' ),
		),
	);
}

$purchase_records = new WP_Query( $purchase_record_query_args );

if ( ! $purchase_records->have_posts() ) {
	return;
}

$get_purchase_record_field = static function ( $field_name, $post_id ) {
	$value = function_exists( 'get_field' ) ? get_field( $field_name, $post_id ) : false;

	if ( false === $value || '' === $value || null === $value ) {
		$value = get_post_meta( $post_id, $field_name, true );
	}

	return $value;
};

$format_purchase_record_price = static function ( $price ) {
	$price = trim( (string) $price );

	if ( '' === $price ) {
		return '';
	}

	$numeric_price = str_replace( array( ',', '￥', '¥', '円', ' ' ), '', $price );

	if ( ctype_digit( $numeric_price ) ) {
		return number_format_i18n( (int) $numeric_price ) . '円';
	}

	return $price;
};
?>
<div
	class="hb__p-cases-grid"
	<?php if ( $grid_id ) : ?>id="<?php echo esc_attr( $grid_id ); ?>"<?php endif; ?>
	<?php if ( 0 < $initial_visible ) : ?>
		data-hb-purchase-records
		data-hb-initial-visible="<?php echo esc_attr( (string) $initial_visible ); ?>"
	<?php endif; ?>
>
	<?php while ( $purchase_records->have_posts() ) : ?>
		<?php
		$purchase_records->the_post();

		$purchase_record_id      = get_the_ID();
		$item_image              = $get_purchase_record_field( 'item-image', $purchase_record_id );
		$item_excerpt            = $get_purchase_record_field( 'item-excerpt', $purchase_record_id );
		$item_purchase_date      = $get_purchase_record_field( 'item-purchase-date', $purchase_record_id );
		$item_price              = $get_purchase_record_field( 'item-price', $purchase_record_id );
		$item_image_markup       = '';
		$item_image_fallback_alt = get_the_title();

		if ( is_array( $item_image ) ) {
			$item_image_id = ! empty( $item_image['ID'] )
				? absint( $item_image['ID'] )
				: ( ! empty( $item_image['id'] ) ? absint( $item_image['id'] ) : 0 );

			if ( $item_image_id ) {
				$item_image_markup = wp_get_attachment_image(
					$item_image_id,
					'medium_large',
					false,
					array(
						'class' => 'hb__p-cases-image',
						'alt'   => ! empty( $item_image['alt'] ) ? $item_image['alt'] : $item_image_fallback_alt,
					)
				);
			} elseif ( ! empty( $item_image['url'] ) ) {
				$item_image_markup = sprintf(
					'<img class="hb__p-cases-image" src="%1$s" alt="%2$s" loading="lazy" />',
					esc_url( $item_image['url'] ),
					esc_attr( ! empty( $item_image['alt'] ) ? $item_image['alt'] : $item_image_fallback_alt )
				);
			}
		} elseif ( is_numeric( $item_image ) ) {
			$item_image_markup = wp_get_attachment_image(
				absint( $item_image ),
				'medium_large',
				false,
				array(
					'class' => 'hb__p-cases-image',
					'alt'   => $item_image_fallback_alt,
				)
			);
		} elseif ( is_string( $item_image ) && '' !== trim( $item_image ) ) {
			$item_image_markup = sprintf(
				'<img class="hb__p-cases-image" src="%1$s" alt="%2$s" loading="lazy" />',
				esc_url( $item_image ),
				esc_attr( $item_image_fallback_alt )
			);
		}

		$price = $format_purchase_record_price( $item_price );
		$filter_term_ids = isset( $filter_term_ids_by_post_id[ $purchase_record_id ] ) && is_array( $filter_term_ids_by_post_id[ $purchase_record_id ] )
			? array_values( array_filter( array_map( 'absint', $filter_term_ids_by_post_id[ $purchase_record_id ] ) ) )
			: array();
		?>
		<article
			class="hb__p-cases-card"
			<?php if ( $all_post_ids || $filter_term_ids ) : ?>
				data-hb-purchase-record-card
				data-hb-purchase-record-all="<?php echo in_array( $purchase_record_id, $all_post_ids, true ) ? 'true' : 'false'; ?>"
				data-hb-purchase-record-terms="<?php echo esc_attr( implode( ' ', $filter_term_ids ) ); ?>"
			<?php endif; ?>
		>
			<?php if ( $item_image_markup ) : ?>
				<a
					class="hb__p-cases-image-link"
					href="<?php the_permalink(); ?>"
					aria-label="<?php echo esc_attr( get_the_title() ); ?>"
				>
					<?php echo wp_kses_post( $item_image_markup ); ?>
				</a>
			<?php else : ?>
				<span class="hb__p-cases-image hb__p-cases-image--empty" aria-hidden="true"></span>
			<?php endif; ?>
			<div class="hb__p-cases-body">
				<h3 class="hb__p-cases-title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h3>
				<?php if ( '' !== trim( (string) $item_excerpt ) || '' !== trim( (string) $item_purchase_date ) ) : ?>
					<p class="hb__p-cases-text">
						<?php if ( '' !== trim( (string) $item_excerpt ) ) : ?>
							<?php echo esc_html( $item_excerpt ); ?>
						<?php endif; ?>
						<?php if ( '' !== trim( (string) $item_excerpt ) && '' !== trim( (string) $item_purchase_date ) ) : ?>
							<br />
						<?php endif; ?>
						<?php if ( '' !== trim( (string) $item_purchase_date ) ) : ?>
							<?php echo esc_html( $item_purchase_date ); ?>
						<?php endif; ?>
					</p>
				<?php endif; ?>
				<div class="hb__p-cases-foot">
					<?php if ( '' !== $price ) : ?>
						<span class="hb__p-cases-price"><?php echo esc_html( $price ); ?></span>
					<?php endif; ?>
					<a
						class="hb__c-btn hb__c-btn--primary hb__p-cases-button"
						href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"
					>査定を申し込む</a>
				</div>
			</div>
		</article>
	<?php endwhile; ?>
</div>
<?php wp_reset_postdata(); ?>
