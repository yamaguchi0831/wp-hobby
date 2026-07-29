<?php
/**
 * Default page template.
 *
 * @package BuyBuyComs_Hobby
 */

get_header();
?>
<main id="main-content" class="hb__l-section">
	<div class="hb__l-container">
		<?php
		while ( have_posts() ) {
			the_post();
			get_template_part( 'template-parts/content/content' );
		}
		?>
	</div>
</main>
<?php
get_footer();
