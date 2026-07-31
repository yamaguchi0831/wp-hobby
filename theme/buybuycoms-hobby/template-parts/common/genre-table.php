<?php
/**
 * Genre term cards.
 *
 * @package BuyBuyComs_Hobby
 */

$genre_terms = get_terms(
	array(
		'taxonomy'   => 'genre',
		'hide_empty' => false,
	)
);

if ( is_wp_error( $genre_terms ) || empty( $genre_terms ) ) {
	return;
}
?>
<div class="hb__p-categories">
	<?php foreach ( $genre_terms as $genre_term ) : ?>
		<?php
		$genre_link = get_term_link( $genre_term );

		if ( is_wp_error( $genre_link ) ) {
			continue;
		}

		$genre_context = 'genre_' . $genre_term->term_id;
		$genre_thumb   = function_exists( 'get_field' )
			? get_field( 'genre-thumb', $genre_context )
			: get_term_meta( $genre_term->term_id, 'genre-thumb', true );
		$genre_excerpt = function_exists( 'get_field' )
			? get_field( 'genre-excerpt', $genre_context )
			: get_term_meta( $genre_term->term_id, 'genre-excerpt', true );
		$genre_image   = '';
		$genre_alt     = $genre_term->name;

		if ( is_array( $genre_thumb ) ) {
			$genre_image_id = ! empty( $genre_thumb['ID'] )
				? absint( $genre_thumb['ID'] )
				: ( ! empty( $genre_thumb['id'] ) ? absint( $genre_thumb['id'] ) : 0 );

			if ( $genre_image_id ) {
				$genre_image = wp_get_attachment_image(
					$genre_image_id,
					'medium',
					false,
					array(
						'class' => 'hb__p-cat__image',
						'alt'   => ! empty( $genre_thumb['alt'] ) ? $genre_thumb['alt'] : $genre_alt,
					)
				);
			} elseif ( ! empty( $genre_thumb['url'] ) ) {
				$genre_image = sprintf(
					'<img class="hb__p-cat__image" src="%1$s" alt="%2$s" loading="lazy" />',
					esc_url( $genre_thumb['url'] ),
					esc_attr( ! empty( $genre_thumb['alt'] ) ? $genre_thumb['alt'] : $genre_alt )
				);
			}
		} elseif ( is_numeric( $genre_thumb ) ) {
			$genre_image = wp_get_attachment_image(
				absint( $genre_thumb ),
				'medium',
				false,
				array(
					'class' => 'hb__p-cat__image',
					'alt'   => $genre_alt,
				)
			);
		} elseif ( is_string( $genre_thumb ) && '' !== trim( $genre_thumb ) ) {
			$genre_image = sprintf(
				'<img class="hb__p-cat__image" src="%1$s" alt="%2$s" loading="lazy" />',
				esc_url( $genre_thumb ),
				esc_attr( $genre_alt )
			);
		}
		?>
		<a href="<?php echo esc_url( $genre_link ); ?>" class="hb__p-cat">
			<?php if ( $genre_image ) : ?>
				<?php echo wp_kses_post( $genre_image ); ?>
			<?php else : ?>
				<span class="hb__p-cat__image hb__p-cat__image--empty" aria-hidden="true"></span>
			<?php endif; ?>
			<div class="hb__p-cat__foot">
				<span><?php echo esc_html( $genre_term->name ); ?></span>
				<span class="hb__p-cat__chev" aria-hidden="true">›</span>
			</div>
			<?php if ( '' !== trim( (string) $genre_excerpt ) ) : ?>
				<span class="hb__p-cat__sub"><?php echo esc_html( $genre_excerpt ); ?></span>
			<?php endif; ?>
		</a>
	<?php endforeach; ?>
</div>
