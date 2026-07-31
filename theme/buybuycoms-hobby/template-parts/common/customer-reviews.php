<?php
/**
 * Context-aware customer review cards.
 *
 * Shows the latest reviews across all genres by default. On a genre archive or
 * a singular post assigned to genre terms, reviews are limited to that genre
 * context.
 *
 * @package BuyBuyComs_Hobby
 */

$review_query_args = array(
	'post_type'           => 'review',
	'post_status'         => 'publish',
	'posts_per_page'      => 3,
	'orderby'             => 'date',
	'order'               => 'DESC',
	'ignore_sticky_posts' => true,
	'no_found_rows'       => true,
);
$review_genre_ids = array();

if ( is_tax( 'genre' ) ) {
	$queried_genre = get_queried_object();

	if ( $queried_genre instanceof WP_Term ) {
		$review_genre_ids = array( (int) $queried_genre->term_id );
	}
} elseif ( is_singular() ) {
	$context_genres = get_the_terms( get_queried_object_id(), 'genre' );

	if ( ! is_wp_error( $context_genres ) && $context_genres ) {
		$review_genre_ids = array_map( 'intval', wp_list_pluck( $context_genres, 'term_id' ) );
	}
}

if ( $review_genre_ids ) {
	$review_query_args['tax_query'] = array(
		array(
			'taxonomy'         => 'genre',
			'field'            => 'term_id',
			'terms'            => $review_genre_ids,
			'operator'         => 'IN',
			'include_children' => is_tax( 'genre' ),
		),
	);
}

$reviews = new WP_Query( $review_query_args );

if ( ! $reviews->have_posts() ) {
	return;
}

$get_review_field = static function ( $field_name, $post_id ) {
	$value = function_exists( 'get_field' ) ? get_field( $field_name, $post_id ) : false;

	if ( false === $value || '' === $value || null === $value ) {
		$value = get_post_meta( $post_id, $field_name, true );
	}

	return $value;
};

?>
<div class="hb__p-reviews">
	<?php while ( $reviews->have_posts() ) : ?>
		<?php
		$reviews->the_post();

		$review_id      = get_the_ID();
		$review_age     = trim( (string) $get_review_field( 'review-age', $review_id ) );
		$review_job     = trim( (string) $get_review_field( 'review-job', $review_id ) );
		$review_star    = min( 5, max( 0, absint( $get_review_field( 'review-star', $review_id ) ) ) );
		$review_meta    = array_values( array_filter( array( $review_age, $review_job ) ) );
		$review_content = get_post_field( 'post_content', $review_id );
		?>
		<article <?php post_class( 'hb__p-review' ); ?>>
			<header class="hb__p-review__head">
				<?php if ( has_post_thumbnail( $review_id ) ) : ?>
					<?php
					echo wp_kses_post(
						get_the_post_thumbnail(
							$review_id,
							'thumbnail',
							array(
								'class' => 'hb__p-review__avatar',
							)
						)
					);
					?>
				<?php else : ?>
					<img
						class="hb__p-review__avatar"
						src="<?php echo esc_url( get_theme_file_uri( '/images/icon/review-default-avatar.png' ) ); ?>"
						alt=""
						width="64"
						height="64"
					/>
				<?php endif; ?>
				<div class="hb__p-review__profile">
					<h3 class="hb__p-review__name"><?php the_title(); ?></h3>
					<?php if ( $review_meta ) : ?>
						<p class="hb__p-review__meta">
							<?php echo esc_html( implode( '・', $review_meta ) ); ?>
						</p>
					<?php endif; ?>
				</div>
			</header>

			<?php if ( 0 < $review_star ) : ?>
				<div
					class="hb__p-review__stars"
					aria-label="<?php echo esc_attr( sprintf( '星%d', $review_star ) ); ?>"
				>
					<span aria-hidden="true"><?php echo esc_html( str_repeat( '★', $review_star ) ); ?></span>
				</div>
			<?php endif; ?>

			<?php if ( '' !== trim( wp_strip_all_tags( $review_content ) ) ) : ?>
				<div class="hb__p-review__text">
					<?php the_content(); ?>
				</div>
			<?php endif; ?>
		</article>
	<?php endwhile; ?>
</div>
<?php wp_reset_postdata(); ?>
