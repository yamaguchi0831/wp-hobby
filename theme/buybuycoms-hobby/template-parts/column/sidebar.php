<?php
/**
 * Shared sidebar for column archive and single templates.
 *
 * @package BuyBuyComs_Hobby
 */

$column_sidebar_prefix = isset( $args['class_prefix'] ) ? $args['class_prefix'] : 'hb-archive-column';
$allowed_prefixes      = array( 'hb-archive-column', 'hb-single-column' );

if ( ! in_array( $column_sidebar_prefix, $allowed_prefixes, true ) ) {
	$column_sidebar_prefix = 'hb-archive-column';
}

$column_post_ids = get_posts(
	array(
		'post_type'      => 'column',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'fields'         => 'ids',
		'no_found_rows'  => true,
	)
);

$column_latest_query = new WP_Query(
	array(
		'post_type'           => 'column',
		'post_status'         => 'publish',
		'posts_per_page'      => 3,
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	)
);

$column_popular_query = new WP_Query(
	array(
		'post_type'           => 'column',
		'post_status'         => 'publish',
		'posts_per_page'      => 3,
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
		'meta_key'            => 'column-featured-order',
		'meta_query'          => array(
			array(
				'key'     => 'column-featured',
				'value'   => '1',
				'compare' => '=',
			),
		),
		'orderby'             => array(
			'meta_value_num' => 'ASC',
			'date'           => 'DESC',
		),
	)
);

$column_genre_terms = array();
$column_tag_terms   = array();

if ( $column_post_ids && taxonomy_exists( 'genre' ) ) {
	$column_genre_terms = get_terms(
		array(
			'taxonomy'   => 'genre',
			'hide_empty' => true,
			'object_ids' => $column_post_ids,
			'orderby'    => 'name',
			'order'      => 'ASC',
		)
	);

	if ( is_wp_error( $column_genre_terms ) ) {
		$column_genre_terms = array();
	}
}

if ( $column_post_ids && taxonomy_exists( 'column-tag' ) ) {
	$column_tag_terms = get_terms(
		array(
			'taxonomy'   => 'column-tag',
			'hide_empty' => true,
			'object_ids' => $column_post_ids,
			'orderby'    => 'name',
			'order'      => 'ASC',
		)
	);

	if ( is_wp_error( $column_tag_terms ) ) {
		$column_tag_terms = array();
	}
}
?>

<aside class="<?php echo esc_attr( $column_sidebar_prefix . '__p-sidebar' ); ?>" aria-label="サイドバー">
	<?php if ( $column_latest_query->have_posts() ) : ?>
		<section class="<?php echo esc_attr( $column_sidebar_prefix . '__p-widget' ); ?>">
			<div class="<?php echo esc_attr( $column_sidebar_prefix . '__p-widget-inner' ); ?>">
				<h2 class="<?php echo esc_attr( $column_sidebar_prefix . '__p-widget-title' ); ?>">新着記事</h2>
				<ul class="<?php echo esc_attr( $column_sidebar_prefix . '__p-post-list' ); ?>" role="list">
					<?php while ( $column_latest_query->have_posts() ) : ?>
						<?php $column_latest_query->the_post(); ?>
						<li>
							<a class="<?php echo esc_attr( $column_sidebar_prefix . '__p-post-link' ); ?>" href="<?php the_permalink(); ?>">
								<span class="<?php echo esc_attr( $column_sidebar_prefix . '__p-post-thumb' ); ?>">
									<?php if ( has_post_thumbnail() ) : ?>
										<?php the_post_thumbnail( 'thumbnail', array( 'loading' => 'lazy' ) ); ?>
									<?php else : ?>
										<img
											class="<?php echo esc_attr( $column_sidebar_prefix . '__p-no-image' ); ?>"
											src="<?php echo esc_url( get_theme_file_uri( '/images/no-image-column.png' ) ); ?>"
											alt=""
											width="800"
											height="600"
											loading="lazy"
										/>
									<?php endif; ?>
								</span>
								<span class="<?php echo esc_attr( $column_sidebar_prefix . '__p-post-body' ); ?>">
									<span class="<?php echo esc_attr( $column_sidebar_prefix . '__p-post-title' ); ?>"><?php the_title(); ?></span>
									<time
										class="<?php echo esc_attr( $column_sidebar_prefix . '__p-post-date' ); ?>"
										datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"
									>
										<?php echo esc_html( get_the_date( 'Y年n月j日' ) ); ?>
									</time>
								</span>
							</a>
						</li>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				</ul>
			</div>
		</section>
	<?php endif; ?>

	<?php if ( $column_popular_query->have_posts() ) : ?>
		<section class="<?php echo esc_attr( $column_sidebar_prefix . '__p-widget' ); ?>">
			<div class="<?php echo esc_attr( $column_sidebar_prefix . '__p-widget-inner' ); ?>">
				<h2 class="<?php echo esc_attr( $column_sidebar_prefix . '__p-widget-title' ); ?>">人気記事</h2>
				<ul class="<?php echo esc_attr( $column_sidebar_prefix . '__p-post-list' ); ?>" role="list">
					<?php while ( $column_popular_query->have_posts() ) : ?>
						<?php $column_popular_query->the_post(); ?>
						<li>
							<a class="<?php echo esc_attr( $column_sidebar_prefix . '__p-post-link' ); ?>" href="<?php the_permalink(); ?>">
								<span class="<?php echo esc_attr( $column_sidebar_prefix . '__p-post-thumb' ); ?>">
									<?php if ( has_post_thumbnail() ) : ?>
										<?php the_post_thumbnail( 'thumbnail', array( 'loading' => 'lazy' ) ); ?>
									<?php else : ?>
										<img
											class="<?php echo esc_attr( $column_sidebar_prefix . '__p-no-image' ); ?>"
											src="<?php echo esc_url( get_theme_file_uri( '/images/no-image-column.png' ) ); ?>"
											alt=""
											width="800"
											height="600"
											loading="lazy"
										/>
									<?php endif; ?>
								</span>
								<span class="<?php echo esc_attr( $column_sidebar_prefix . '__p-post-body' ); ?>">
									<span class="<?php echo esc_attr( $column_sidebar_prefix . '__p-post-title' ); ?>"><?php the_title(); ?></span>
								</span>
							</a>
						</li>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				</ul>
			</div>
		</section>
	<?php endif; ?>

	<?php if ( $column_genre_terms ) : ?>
		<section class="<?php echo esc_attr( $column_sidebar_prefix . '__p-widget' ); ?>">
			<div class="<?php echo esc_attr( $column_sidebar_prefix . '__p-widget-inner' ); ?>">
				<h2 class="<?php echo esc_attr( $column_sidebar_prefix . '__p-widget-title' ); ?>">カテゴリ</h2>
				<ul class="<?php echo esc_attr( $column_sidebar_prefix . '__p-link-list' ); ?>" role="list">
					<?php foreach ( $column_genre_terms as $column_genre_term ) : ?>
						<?php $column_genre_link = get_term_link( $column_genre_term ); ?>
						<?php if ( ! is_wp_error( $column_genre_link ) ) : ?>
							<li>
								<a href="<?php echo esc_url( $column_genre_link ); ?>">
									<?php echo esc_html( $column_genre_term->name ); ?>
								</a>
							</li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			</div>
		</section>
	<?php endif; ?>

	<?php if ( $column_tag_terms ) : ?>
		<section class="<?php echo esc_attr( $column_sidebar_prefix . '__p-widget' ); ?>">
			<div class="<?php echo esc_attr( $column_sidebar_prefix . '__p-widget-inner' ); ?>">
				<h2 class="<?php echo esc_attr( $column_sidebar_prefix . '__p-widget-title' ); ?>">タグ</h2>
				<ul class="<?php echo esc_attr( $column_sidebar_prefix . '__p-tag-list' ); ?>" role="list">
					<?php foreach ( $column_tag_terms as $column_tag_term ) : ?>
						<?php $column_tag_link = get_term_link( $column_tag_term ); ?>
						<?php if ( ! is_wp_error( $column_tag_link ) ) : ?>
							<li>
								<a
									class="<?php echo esc_attr( $column_sidebar_prefix . '__p-tag-link' ); ?>"
									href="<?php echo esc_url( $column_tag_link ); ?>"
								>
									<?php echo esc_html( $column_tag_term->name ); ?>
								</a>
							</li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			</div>
		</section>
	<?php endif; ?>
</aside>
