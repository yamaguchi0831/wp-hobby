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
$enable_genre_filter         = ! empty( $args['enable_genre_filter'] );
$default_genre_id            = isset( $args['default_genre_id'] ) ? absint( $args['default_genre_id'] ) : 0;

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

if ( $default_genre_id && ! in_array( $default_genre_id, wp_list_pluck( $purchase_record_terms, 'term_id' ), true ) ) {
	$default_genre_id = 0;
}

$purchase_record_filter_ids_by_term = array();
$purchase_record_filter_terms_by_id = array();
$purchase_record_all_ids            = array();
$purchase_record_display_ids        = array();

if ( $enable_genre_filter && $purchase_record_ids && $purchase_record_terms ) {
	$purchase_record_relationships = wp_get_object_terms(
		$purchase_record_ids,
		'genre',
		array(
			'fields' => 'all_with_object_id',
		)
	);

	if ( is_wp_error( $purchase_record_relationships ) ) {
		$purchase_record_relationships = array();
	}

	$purchase_record_term_ids_by_post = array();
	foreach ( $purchase_record_relationships as $purchase_record_relationship ) {
		$purchase_record_post_id = absint( $purchase_record_relationship->object_id );
		$purchase_record_term_id = absint( $purchase_record_relationship->term_id );

		if ( $purchase_record_post_id && $purchase_record_term_id ) {
			$purchase_record_term_ids_by_post[ $purchase_record_post_id ][] = $purchase_record_term_id;
		}
	}

	foreach ( $purchase_record_terms as $purchase_record_term ) {
		$purchase_record_filter_ids_by_term[ $purchase_record_term->term_id ] = array();
	}

	foreach ( $purchase_record_ids as $purchase_record_id ) {
		$purchase_record_id = absint( $purchase_record_id );
		$record_term_ids    = isset( $purchase_record_term_ids_by_post[ $purchase_record_id ] )
			? $purchase_record_term_ids_by_post[ $purchase_record_id ]
			: array();

		foreach ( $record_term_ids as $record_term_id ) {
			if ( ! isset( $purchase_record_filter_ids_by_term[ $record_term_id ] ) || 20 <= count( $purchase_record_filter_ids_by_term[ $record_term_id ] ) ) {
				continue;
			}

			$purchase_record_filter_ids_by_term[ $record_term_id ][] = $purchase_record_id;
			$purchase_record_filter_terms_by_id[ $purchase_record_id ][] = $record_term_id;
		}
	}

	$purchase_record_all_ids     = array_slice( $purchase_record_ids, 0, 20 );
	$purchase_record_display_ids = $purchase_record_all_ids;

	foreach ( $purchase_record_filter_ids_by_term as $purchase_record_filter_ids ) {
		$purchase_record_display_ids = array_merge( $purchase_record_display_ids, $purchase_record_filter_ids );
	}

	$purchase_record_display_ids = array_values( array_unique( array_map( 'absint', $purchase_record_display_ids ) ) );
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
				<?php if ( $enable_genre_filter ) : ?>
					<li>
						<button
							class="hb__p-purchase-records-section__filter-link<?php echo $default_genre_id ? '' : ' hb__is-active'; ?>"
							type="button"
							aria-controls="<?php echo esc_attr( $purchase_records_grid_id ); ?>"
							aria-pressed="<?php echo $default_genre_id ? 'false' : 'true'; ?>"
							data-hb-purchase-record-filter
						>
							ALL
						</button>
					</li>
				<?php endif; ?>
				<?php foreach ( $purchase_record_terms as $purchase_record_term ) : ?>
					<li>
						<?php if ( $enable_genre_filter ) : ?>
							<button
								class="hb__p-purchase-records-section__filter-link<?php echo (int) $purchase_record_term->term_id === $default_genre_id ? ' hb__is-active' : ''; ?>"
								type="button"
								aria-controls="<?php echo esc_attr( $purchase_records_grid_id ); ?>"
								aria-pressed="<?php echo (int) $purchase_record_term->term_id === $default_genre_id ? 'true' : 'false'; ?>"
								data-hb-purchase-record-filter="<?php echo esc_attr( (string) $purchase_record_term->term_id ); ?>"
							>
								<?php echo esc_html( $purchase_record_term->name ); ?>
							</button>
						<?php else : ?>
							<?php $purchase_record_term_link = get_term_link( $purchase_record_term ); ?>
							<?php if ( ! is_wp_error( $purchase_record_term_link ) ) : ?>
								<a class="hb__p-purchase-records-section__filter-link" href="<?php echo esc_url( $purchase_record_term_link ); ?>">
									<?php echo esc_html( $purchase_record_term->name ); ?>
								</a>
							<?php endif; ?>
						<?php endif; ?>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>

		<?php
		get_template_part(
			'template-parts/common/purchase-records',
			null,
			array(
				'posts_per_page'                  => 20,
				'initial_visible'                 => 8,
				'grid_id'                         => $purchase_records_grid_id,
				'post_ids'                        => $purchase_record_display_ids,
				'all_post_ids'                    => $purchase_record_all_ids,
				'filter_term_ids_by_post_id'      => $purchase_record_filter_terms_by_id,
				'default_filter_id'               => $default_genre_id,
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
