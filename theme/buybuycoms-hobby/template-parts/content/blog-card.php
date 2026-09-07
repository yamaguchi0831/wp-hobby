<?php
/**
 * Backward-compatible alias for the internal link card.
 *
 * @package BuyBuyComs_Hobby
 */

$genre_term = isset( $args['genre_term'] ) && $args['genre_term'] instanceof WP_Term ? $args['genre_term'] : null;

if ( ! $genre_term ) {
	return;
}

get_template_part(
	'template-parts/content/internal-link-card',
	null,
	array(
		'content_type' => 'genre',
		'content_id'   => $genre_term->term_id,
	)
);
