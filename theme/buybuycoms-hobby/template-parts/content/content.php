<?php
/**
 * Default post/page content.
 *
 * @package BuyBuyComs_Hobby
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'hb__p-entry' ); ?>>
	<header class="hb__p-entry__header">
		<?php the_title( '<h1 class="hb__p-entry__title">', '</h1>' ); ?>
	</header>

	<?php if ( has_post_thumbnail() ) : ?>
		<figure class="hb__p-entry__thumbnail">
			<?php the_post_thumbnail( 'large' ); ?>
		</figure>
	<?php endif; ?>

	<div class="hb__p-entry__content">
		<?php
		the_content();
		wp_link_pages();
		?>
	</div>
</article>
