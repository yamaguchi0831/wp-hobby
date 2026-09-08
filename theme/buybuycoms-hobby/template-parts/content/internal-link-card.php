<?php
/**
 * Internal link card.
 *
 * @package BuyBuyComs_Hobby
 */

$content_type = isset( $args['content_type'] ) ? sanitize_key( $args['content_type'] ) : '';
$content_id   = isset( $args['content_id'] ) ? absint( $args['content_id'] ) : 0;

if ( ! $content_id ) {
	return;
}

$link        = '';
$title       = '';
$description = '';
$button_text = '';
$image_html  = '';

if ( 'genre' === $content_type ) {
	$genre_term = get_term( $content_id, 'genre' );

	if ( ! $genre_term || is_wp_error( $genre_term ) ) {
		return;
	}

	$link        = get_term_link( $genre_term );
	$title       = $genre_term->name . 'をまとめて高価買取';
	$description = buybuycoms_hobby_get_internal_link_card_genre_description( $genre_term );
	$button_text = $genre_term->name . 'の買取ページを見る';
	$image_html  = buybuycoms_hobby_get_internal_link_card_genre_image( $genre_term );
} elseif ( 'column' === $content_type ) {
	$column = get_post( $content_id );

	if ( ! $column || 'column' !== $column->post_type || 'publish' !== $column->post_status ) {
		return;
	}

	$link        = get_permalink( $column );
	$title       = get_the_title( $column );
	$description = buybuycoms_hobby_get_internal_link_card_column_description( $column );
	$button_text = '詳細をみる';
	$image_id    = get_post_thumbnail_id( $column );
	$image_html  = $image_id
		? wp_get_attachment_image( $image_id, 'large', false, array( 'alt' => $title ) )
		: '<img src="https://placehold.co/600x450?text=No+Image" alt="">';
}

if ( is_wp_error( $link ) || '' === $link || '' === $title || '' === $image_html ) {
	return;
}
?>
<a class="hb__p-internal-link-card" href="<?php echo esc_url( $link ); ?>">
	<figure class="hb__p-internal-link-card__image">
		<?php echo wp_kses_post( $image_html ); ?>
	</figure>
	<span class="hb__p-internal-link-card__body">
		<span class="hb__p-internal-link-card__title"><?php echo esc_html( $title ); ?></span>
		<?php if ( '' !== $description ) : ?>
			<span class="hb__p-internal-link-card__description"><?php echo esc_html( $description ); ?></span>
		<?php endif; ?>
		<span class="hb__p-internal-link-card__divider" aria-hidden="true"></span>
		<span class="hb__p-internal-link-card__button"><?php echo esc_html( $button_text ); ?></span>
	</span>
</a>
