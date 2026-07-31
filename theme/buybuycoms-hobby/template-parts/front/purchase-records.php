<?php
/**
 * Purchase record cards for the front page.
 *
 * @package BuyBuyComs_Hobby
 */

$purchase_records = new WP_Query(
	array(
		'post_type'           => 'purchase-record',
		'post_status'         => 'publish',
		'posts_per_page'      => 8,
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	)
);

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
		return 'ASK';
	}

	$numeric_price = str_replace( ',', '', $price );

	if ( ctype_digit( $numeric_price ) ) {
		return '¥ ' . number_format_i18n( (int) $numeric_price );
	}

	return $price;
};
?>
<div class="hb__p-cases-grid">
	<?php while ( $purchase_records->have_posts() ) : ?>
		<?php
		$purchase_records->the_post();

		$purchase_record_id      = get_the_ID();
		$item_image              = $get_purchase_record_field( 'item-image', $purchase_record_id );
		$item_excerpt            = $get_purchase_record_field( 'item-excerpt', $purchase_record_id );
		$item_purchase_date      = $get_purchase_record_field( 'item-purchase-date', $purchase_record_id );
		$item_min_price          = $get_purchase_record_field( 'item-min-price', $purchase_record_id );
		$item_max_price          = $get_purchase_record_field( 'item-max-price', $purchase_record_id );
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

		$min_price = $format_purchase_record_price( $item_min_price );
		$max_price = $format_purchase_record_price( $item_max_price );
		$price     = 'ASK';

		if ( 'ASK' !== $min_price || 'ASK' !== $max_price ) {
			$price = $min_price . ' ～ ' . $max_price;
		}
		?>
		<article class="hb__p-cases-card">
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
					<span class="hb__p-cases-price"><?php echo esc_html( $price ); ?></span>
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
