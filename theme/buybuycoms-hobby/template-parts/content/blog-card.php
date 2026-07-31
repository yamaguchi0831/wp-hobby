<?php
/**
 * Static first-stage template part: blog-card.
 *
 * @package BuyBuyComs_Hobby
 */

$genre_term = isset( $args['genre_term'] ) && $args['genre_term'] instanceof WP_Term
  ? $args['genre_term']
  : null;

if ( ! $genre_term ) {
  return;
}

$genre_link = get_term_link( $genre_term );

if ( is_wp_error( $genre_link ) ) {
  return;
}

$genre_context = $genre_term->taxonomy . '_' . $genre_term->term_id;
$genre_text     = function_exists( 'get_field' )
  ? get_field( 'genre-text-for-card', $genre_context )
  : get_term_meta( $genre_term->term_id, 'genre-text-for-card', true );
?>
<a class="hb__p-blog-card" href="<?php echo esc_url( $genre_link ); ?>">
  <figure class="hb__p-blog-card__image">
    <img
      src="<?php echo esc_url( get_theme_file_uri( '/images/genre/mv_gandamu.webp' ) ); ?>"
      alt="<?php echo esc_attr( $genre_term->name . '買取のイメージ' ); ?>"
      width="1000"
      height="750"
    />
  </figure>
  <span class="hb__p-blog-card__body">
    <span class="hb__p-blog-card__title"><?php echo esc_html( $genre_term->name ); ?>をまとめて高価買取</span>
    <?php if ( $genre_text ) : ?>
    <span class="hb__p-blog-card__text">
      <?php echo esc_html( $genre_text ); ?>
    </span>
    <?php endif; ?>
    <span class="hb__p-blog-card__divider" aria-hidden="true"></span>
    <span class="hb__p-blog-card__button"><?php echo esc_html( $genre_term->name ); ?>の買取ページを見る</span>
  </span>
</a>
