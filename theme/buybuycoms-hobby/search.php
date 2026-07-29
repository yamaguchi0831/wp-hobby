<?php
/**
 * Search results.
 *
 * @package BuyBuyComs_Hobby
 */

get_header();
?>
<main id="main-content" class="hb__l-section">
	<div class="hb__l-container">
		<h1>
			<?php
			printf(
				/* translators: %s: search query. */
				esc_html__( '「%s」の検索結果', 'buybuycoms-hobby' ),
				esc_html( get_search_query() )
			);
			?>
		</h1>
		<?php
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/content/content' );
			}
			the_posts_pagination();
		} else {
			get_template_part( 'template-parts/content/content-none' );
		}
		?>
	</div>
</main>
<?php
get_footer();
