<?php
/**
 * Purchase price guide grouped by genre.
 *
 * @package BuyBuyComs_Hobby
 */

if ( ! post_type_exists( 'purchase-price' ) || ! taxonomy_exists( 'genre' ) ) {
	return;
}

$get_purchase_price_term_field = static function ( $field_name, $term ) {
	$term_context = 'genre_' . $term->term_id;
	$value        = function_exists( 'get_field' ) ? get_field( $field_name, $term_context ) : false;

	if ( false === $value || '' === $value || null === $value ) {
		$value = get_term_meta( $term->term_id, $field_name, true );
	}

	return $value;
};

$get_purchase_price_post_field = static function ( $field_name, $post_id ) {
	$value = function_exists( 'get_field' ) ? get_field( $field_name, $post_id ) : false;

	if ( false === $value || '' === $value || null === $value ) {
		$value = get_post_meta( $post_id, $field_name, true );
	}

	return $value;
};

$is_purchase_price_enabled = static function ( $value ) {
	return in_array(
		strtolower( trim( (string) $value ) ),
		array( '1', 'true', 'yes', 'on' ),
		true
	);
};

$format_purchase_price = static function ( $price ) {
	$price = trim( (string) $price );

	if ( '' === $price ) {
		return '';
	}

	$numeric_price = preg_replace( '/[,\s￥¥円]/u', '', $price );

	if ( is_string( $numeric_price ) && ctype_digit( $numeric_price ) ) {
		return '￥' . number_format_i18n( (int) $numeric_price );
	}

	return $price;
};

$purchase_price_genres = get_terms(
	array(
		'taxonomy'   => 'genre',
		'hide_empty' => false,
	)
);

if ( is_wp_error( $purchase_price_genres ) || empty( $purchase_price_genres ) ) {
	return;
}

$purchase_price_genres = array_values(
	array_filter(
		$purchase_price_genres,
		static function ( $genre_term ) use ( $get_purchase_price_term_field, $is_purchase_price_enabled ) {
			$display_flag = $get_purchase_price_term_field( 'genre-purchase-table-flag', $genre_term );

			return $is_purchase_price_enabled( $display_flag );
		}
	)
);
$purchase_price_genres = buybuycoms_hobby_sort_genre_terms( $purchase_price_genres );

if ( empty( $purchase_price_genres ) ) {
	return;
}

$purchase_price_groups = array();

foreach ( $purchase_price_genres as $purchase_price_genre ) {
	$display_limit_value = $get_purchase_price_term_field(
		'genre-purchase-table-number-of-display',
		$purchase_price_genre
	);
	$display_limit_text  = trim( (string) $display_limit_value );

	if ( '' !== $display_limit_text && 0 === absint( $display_limit_value ) ) {
		continue;
	}

	$purchase_price_query = new WP_Query(
		array(
			'post_type'           => 'purchase-price',
			'post_status'         => 'publish',
			'posts_per_page'      => '' === $display_limit_text ? 10 : absint( $display_limit_value ),
			'orderby'             => 'date',
			'order'               => 'DESC',
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
			'tax_query'           => array(
				array(
					'taxonomy'         => 'genre',
					'field'            => 'term_id',
					'terms'            => array( (int) $purchase_price_genre->term_id ),
					'operator'         => 'IN',
					'include_children' => false,
				),
			),
		)
	);

	if ( ! $purchase_price_query->have_posts() ) {
		continue;
	}

	$purchase_price_groups[] = array(
		'genre' => $purchase_price_genre,
		'query' => $purchase_price_query,
	);
}

if ( empty( $purchase_price_groups ) ) {
	return;
}
?>
<div class="hb__p-prices-ui">
	<div class="hb__p-prices-table">
		<?php foreach ( $purchase_price_groups as $purchase_price_group ) : ?>
			<?php
			$purchase_price_genre = $purchase_price_group['genre'];
			$purchase_price_query = $purchase_price_group['query'];
			?>
			<div class="hb__p-price-group">
				<div class="hb__p-price-group-head">
					<?php echo esc_html( $purchase_price_genre->name ); ?>
				</div>
				<ul class="hb__p-price-group-list" role="list">
					<?php while ( $purchase_price_query->have_posts() ) : ?>
						<?php
						$purchase_price_query->the_post();

						$purchase_price_id   = get_the_ID();
						$product_name        = get_the_title();
						$product_buying_flag = $get_purchase_price_post_field( 'product-buying-flag', $purchase_price_id );
						$product_min_price   = $format_purchase_price(
							$get_purchase_price_post_field( 'product-min-price', $purchase_price_id )
						);
						$product_max_price   = $format_purchase_price(
							$get_purchase_price_post_field( 'product-max-price', $purchase_price_id )
						);

						if ( '' === $product_min_price && '' === $product_max_price ) {
							$product_price = 'ASK';
						} else {
							$product_price = $product_min_price . '～' . $product_max_price;
						}
						?>
						<li class="hb__p-price-group-item">
							<span class="hb__p-price-group-name">
								<?php echo esc_html( $product_name ); ?>
							</span>
							<span
								class="hb__p-price-group-tag<?php echo $is_purchase_price_enabled( $product_buying_flag ) ? ' hb__p-price-group-tag--hot' : ''; ?>"
							>
								<?php if ( $is_purchase_price_enabled( $product_buying_flag ) ) : ?>
									買取強化中
								<?php endif; ?>
							</span>
							<span class="hb__p-price-group-price">
								<?php echo esc_html( $product_price ); ?>
							</span>
						</li>
					<?php endwhile; ?>
				</ul>
				<?php $purchase_price_genre_link = get_term_link( $purchase_price_genre ); ?>
				<?php if ( ! is_wp_error( $purchase_price_genre_link ) ) : ?>
					<div class="hb__p-price-group-more">
						<a
							class="hb__p-price-group-button"
							href="<?php echo esc_url( $purchase_price_genre_link ); ?>"
						>
							<?php echo esc_html( $purchase_price_genre->name ); ?>をもっと見る
						</a>
					</div>
				<?php endif; ?>
			</div>
			<?php wp_reset_postdata(); ?>
		<?php endforeach; ?>
	</div>

	<p class="hb__p-prices-note">
		<img
			src="https://placehold.co/16x16/f6faf6/5f6f66?text=i"
			alt=""
			width="16"
			height="16"
		/>
		時期や在庫状況によって買取価格は変動いたします。
	</p>
</div>
