<?php
/**
 * Purchase records section with genre links and progressive disclosure.
 *
 * @package BuyBuyComs_Hobby
 */

$purchase_records_section_id = isset( $args['section_id'] )
	? sanitize_html_class( $args['section_id'] )
	: 'cases';
$purchase_records_grid_id    = isset( $args['grid_id'] )
	? sanitize_html_class( $args['grid_id'] )
	: 'purchase-records-section-grid';
$purchase_records_lead       = isset( $args['lead'] )
	? sanitize_text_field( $args['lead'] )
	: 'フィギュア・プラモデル・カードなど、実際にお売りいただいたホビーの一例です。';

$purchase_record_ids = get_posts(
	array(
		'post_type'              => 'purchase-record',
		'post_status'            => 'publish',
		'posts_per_page'         => -1,
		'fields'                 => 'ids',
		'orderby'                => 'date',
		'order'                  => 'DESC',
		'no_found_rows'          => true,
		'update_post_meta_cache' => false,
		'update_post_term_cache' => false,
	)
);
$purchase_record_terms = $purchase_record_ids
	? wp_get_object_terms(
		$purchase_record_ids,
		'genre',
		array(
			'orderby' => 'name',
			'order'   => 'ASC',
		)
	)
	: array();

if ( is_wp_error( $purchase_record_terms ) ) {
	$purchase_record_terms = array();
} else {
	$purchase_record_terms_by_id = array();

	foreach ( $purchase_record_terms as $purchase_record_term ) {
		$purchase_record_terms_by_id[ $purchase_record_term->term_id ] = $purchase_record_term;
	}

	$purchase_record_terms = array_values( $purchase_record_terms_by_id );
	$purchase_record_terms = buybuycoms_hobby_sort_genre_terms( $purchase_record_terms );
}
?>
<section class="hb__l-section hb__p-purchase-records-section" id="<?php echo esc_attr( $purchase_records_section_id ); ?>">
	<div class="hb__l-container">
		<header class="hb__p-purchase-records-section__head">
			<span class="hb__p-purchase-records-section__kicker">Cases</span>
			<h2 class="hb__p-purchase-records-section__title">
				最近の
				<span class="hb__p-purchase-records-section__highlight">買取実績</span>
			</h2>
			<p class="hb__p-purchase-records-section__lead">
				<?php echo esc_html( $purchase_records_lead ); ?>
			</p>
		</header>

		<?php if ( $purchase_record_terms ) : ?>
			<ul class="hb__p-purchase-records-section__filter" role="list">
				<?php foreach ( $purchase_record_terms as $purchase_record_term ) : ?>
					<?php $purchase_record_term_link = get_term_link( $purchase_record_term ); ?>
					<?php if ( ! is_wp_error( $purchase_record_term_link ) ) : ?>
						<li>
							<a
								class="hb__p-purchase-records-section__filter-link"
								href="<?php echo esc_url( $purchase_record_term_link ); ?>"
							>
								<?php echo esc_html( $purchase_record_term->name ); ?>
							</a>
						</li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>

		<?php
		get_template_part(
			'template-parts/common/purchase-records',
			null,
			array(
				'posts_per_page' => 20,
				'initial_visible' => 8,
				'grid_id'         => $purchase_records_grid_id,
			)
		);
		?>
		<div class="hb__p-purchase-records-section__more">
			<button
				class="hb__p-purchase-records-section__more-button"
				type="button"
				aria-controls="<?php echo esc_attr( $purchase_records_grid_id ); ?>"
				aria-expanded="false"
				data-hb-purchase-record-more
				hidden
			>
				もっと見る
			</button>
		</div>
	</div>
</section>
