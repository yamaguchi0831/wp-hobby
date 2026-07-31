<?php
/**
 * Posts page template for announcements.
 *
 * @package BuyBuyComs_Hobby
 */

get_header();
?>

<main id="main-content">
	<section class="hb__p-subpage-title" aria-label="お知らせ一覧">
		<div class="hb__l-container hb__p-subpage-title__inner">
			<h1 class="hb__p-subpage-title__heading">お知らせ一覧</h1>
		</div>
	</section>

	<div class="hb__l-container">
		<nav class="hb__p-subpage-title__breadcrumb-area" aria-label="パンくずリスト">
			<ol class="hb__l-container hb__p-subpage-title__breadcrumb">
				<li class="hb__p-subpage-title__breadcrumb-item">
					<a class="hb__p-subpage-title__breadcrumb-link" href="<?php echo esc_url( home_url( '/' ) ); ?>">TOP</a>
				</li>
				<li class="hb__p-subpage-title__breadcrumb-separator" aria-hidden="true">&gt;</li>
				<li class="hb__p-subpage-title__breadcrumb-current" aria-current="page">お知らせ一覧</li>
			</ol>
		</nav>
	</div>

	<section class="hb__l-section" aria-label="お知らせ一覧">
		<div class="hb__l-container">
			<?php if ( have_posts() ) : ?>
				<ul class="hb-archive-info__p-list" role="list">
					<?php while ( have_posts() ) : ?>
						<?php
						the_post();
						$post_categories = get_the_category();
						$category_name   = ! empty( $post_categories )
							? $post_categories[0]->name
							: __( 'お知らせ', 'buybuycoms-hobby' );
						?>
						<li class="hb-archive-info__p-item">
							<a class="hb-archive-info__p-link" href="<?php the_permalink(); ?>">
								<time
									class="hb-archive-info__p-date"
									datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"
								><?php echo esc_html( get_the_date( 'Y-m-d' ) ); ?></time>
								<span class="hb-archive-info__p-category"><?php echo esc_html( $category_name ); ?></span>
								<span class="hb-archive-info__p-title"><?php the_title(); ?></span>
							</a>
						</li>
					<?php endwhile; ?>
				</ul>

				<?php
				$pagination_links = paginate_links(
					array(
						'current'   => max( 1, get_query_var( 'paged' ) ),
						'total'     => $GLOBALS['wp_query']->max_num_pages,
						'type'      => 'array',
						'prev_text' => '<span aria-hidden="true">‹</span><span class="screen-reader-text">' . esc_html__( '前のページ', 'buybuycoms-hobby' ) . '</span>',
						'next_text' => '<span aria-hidden="true">›</span><span class="screen-reader-text">' . esc_html__( '次のページ', 'buybuycoms-hobby' ) . '</span>',
					)
				);
				?>

				<?php if ( $pagination_links ) : ?>
					<nav aria-label="お知らせページ送り">
						<ol class="hb-archive-info__p-pagination">
							<?php foreach ( $pagination_links as $pagination_link ) : ?>
								<li><?php echo wp_kses_post( $pagination_link ); ?></li>
							<?php endforeach; ?>
						</ol>
					</nav>
				<?php endif; ?>
			<?php else : ?>
				<p class="hb-archive-info__p-empty"><?php esc_html_e( '現在、お知らせはありません。', 'buybuycoms-hobby' ); ?></p>
			<?php endif; ?>
		</div>
	</section>

	<?php get_template_part( 'template-parts/common/footer-cta' ); ?>
</main>

<?php get_footer(); ?>
