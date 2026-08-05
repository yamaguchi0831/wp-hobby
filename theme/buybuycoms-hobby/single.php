<?php
/**
 * Single announcement template.
 *
 * @package BuyBuyComs_Hobby
 */

get_header();

$posts_page_id  = (int) get_option( 'page_for_posts' );
$posts_page_url = $posts_page_id ? get_permalink( $posts_page_id ) : home_url( '/info/' );
?>

<main id="main-content">
	<section class="hb__p-subpage-title" aria-label="お知らせ詳細">
		<div class="hb__l-container hb__p-subpage-title__inner">
			<h1 class="hb__p-subpage-title__heading">お知らせ</h1>
		</div>
	</section>

	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>

		<div class="hb__l-container">
      <?php buybuycoms_hobby_breadcrumb(); ?>
		</div>

		<section class="hb__l-section hb__l-section--pt-sm" aria-label="お知らせ本文">
			<article <?php post_class( 'hb__l-container hb-single-info__p-article' ); ?>>
				<div class="hb-single-info__p-meta">
					<time
						class="hb-single-info__p-date"
						datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"
					><?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?></time>

					<?php $post_categories = get_the_category(); ?>
					<?php foreach ( $post_categories as $post_category ) : ?>
						<span class="hb-single-info__p-category"><?php echo esc_html( $post_category->name ); ?></span>
					<?php endforeach; ?>
				</div>

				<h1 class="hb-single-info__p-title"><?php the_title(); ?></h1>

				<?php if ( has_post_thumbnail() ) : ?>
					<figure class="hb-single-info__p-hero">
						<?php
						the_post_thumbnail(
							'large',
							array(
								'loading' => 'eager',
							)
						);
						?>
					</figure>
				<?php endif; ?>

				<div class="hb-single-info__p-body">
					<?php the_content(); ?>
				</div>

				<?php
				wp_link_pages(
					array(
						'before' => '<nav class="hb-single-info__p-content-pages" aria-label="' . esc_attr__( '記事内ページ', 'buybuycoms-hobby' ) . '">',
						'after'  => '</nav>',
					)
				);
				?>

				<div class="hb-single-info__p-back">
					<a class="hb-single-info__p-back-link" href="<?php echo esc_url( $posts_page_url ); ?>">
						お知らせ一覧に戻る
					</a>
				</div>
			</article>
		</section>
	<?php endwhile; ?>

	<?php get_template_part( 'template-parts/common/footer-cta' ); ?>
</main>

<?php get_footer(); ?>
