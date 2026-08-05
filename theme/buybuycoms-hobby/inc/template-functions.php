<?php
/**
 * Template helpers and fallbacks.
 *
 * @package BuyBuyComs_Hobby
 */

/**
 * Output the default primary navigation when no menu has been assigned.
 *
 * @return void
 */
function buybuycoms_hobby_primary_menu_fallback() {
	$column_archive_url = get_post_type_archive_link( 'column' );
	$links = array(
		home_url( '/flow/' )       => __( '買取方法', 'buybuycoms-hobby' ),
		home_url( '/reason/' )     => __( '選ばれる理由', 'buybuycoms-hobby' ),
		home_url( '/genre-list/' ) => __( 'カテゴリー一覧', 'buybuycoms-hobby' ),
		$column_archive_url ?: home_url( '/column/' ) => __( 'コラム', 'buybuycoms-hobby' ),
		home_url( '/faq/' )        => __( 'よくある質問', 'buybuycoms-hobby' ),
		home_url( '/company/' )    => __( '会社概要', 'buybuycoms-hobby' ),
	);

	echo '<ul class="hb__p-header__nav-list">';
	foreach ( $links as $url => $label ) {
		printf(
			'<li><a href="%1$s">%2$s</a></li>',
			esc_url( $url ),
			esc_html( $label )
		);
	}
	echo '</ul>';
}

/**
 * Set the number of column posts shown on each archive page.
 *
 * @param WP_Query $query Current query.
 * @return void
 */
function buybuycoms_hobby_column_archive_posts_per_page( $query ) {
	if ( is_admin() || ! $query->is_main_query() || ! $query->is_post_type_archive( 'column' ) ) {
		return;
	}

	$query->set( 'posts_per_page', 10 );
}
add_action( 'pre_get_posts', 'buybuycoms_hobby_column_archive_posts_per_page' );

/**
 * Sort genre terms by the genre-order term meta.
 *
 * Terms without an order are placed after ordered terms. Terms with the same
 * order are sorted by name.
 *
 * @param WP_Term[] $genre_terms Genre terms.
 * @return WP_Term[]
 */
function buybuycoms_hobby_sort_genre_terms( $genre_terms ) {
	usort(
		$genre_terms,
		static function ( $first_term, $second_term ) {
			$first_order      = get_term_meta( $first_term->term_id, 'genre-order', true );
			$second_order     = get_term_meta( $second_term->term_id, 'genre-order', true );
			$first_has_order  = '' !== trim( (string) $first_order );
			$second_has_order = '' !== trim( (string) $second_order );

			if ( $first_has_order && $second_has_order ) {
				$order_comparison = (float) $first_order <=> (float) $second_order;

				if ( 0 !== $order_comparison ) {
					return $order_comparison;
				}
			} elseif ( $first_has_order ) {
				return -1;
			} elseif ( $second_has_order ) {
				return 1;
			}

			return strnatcasecmp( $first_term->name, $second_term->name );
		}
	);

	return $genre_terms;
}

/**
 * Output breadcrumbs for the current WordPress request.
 *
 * @param string $nav_class Navigation class name.
 * @param string $list_class List class name.
 * @return void
 */
function buybuycoms_hobby_breadcrumb( $nav_class = 'hb__p-subpage-title__breadcrumb-area', $list_class = 'hb__l-container hb__p-subpage-title__breadcrumb', $item_class = 'hb__p-subpage-title__breadcrumb-item', $link_class = 'hb__p-subpage-title__breadcrumb-link', $current_class = 'hb__p-subpage-title__breadcrumb-current', $separator_class = 'hb__p-subpage-title__breadcrumb-separator' ) {
	$items = array(
		array(
			'label' => __( 'TOP', 'buybuycoms-hobby' ),
			'url'   => home_url( '/' ),
		),
	);

	if ( is_home() ) {
		$posts_page_id = (int) get_option( 'page_for_posts' );
		$items[]       = array(
			'label' => $posts_page_id ? get_the_title( $posts_page_id ) : __( 'お知らせ', 'buybuycoms-hobby' ),
		);
	} elseif ( is_post_type_archive() ) {
		$post_type = get_queried_object();
		$items[]   = array(
			'label' => $post_type instanceof WP_Post_Type ? $post_type->labels->name : get_the_archive_title(),
		);
	} elseif ( is_tax() || is_category() || is_tag() ) {
		$term = get_queried_object();
		if ( $term instanceof WP_Term ) {
			$ancestor_ids = array_reverse( get_ancestors( $term->term_id, $term->taxonomy, 'taxonomy' ) );
			foreach ( $ancestor_ids as $ancestor_id ) {
				$ancestor = get_term( $ancestor_id, $term->taxonomy );
				if ( $ancestor instanceof WP_Term ) {
					$items[] = array(
						'label' => $ancestor->name,
						'url'   => get_term_link( $ancestor ),
					);
				}
			}
			$items[] = array( 'label' => $term->name );
		}
	} elseif ( is_singular() ) {
		$post = get_queried_object();
		if ( $post instanceof WP_Post ) {
			if ( 'page' === $post->post_type ) {
				$ancestor_ids = array_reverse( get_post_ancestors( $post ) );
				foreach ( $ancestor_ids as $ancestor_id ) {
					$items[] = array(
						'label' => get_the_title( $ancestor_id ),
						'url'   => get_permalink( $ancestor_id ),
					);
				}
			} elseif ( 'post' === $post->post_type ) {
				$posts_page_id = (int) get_option( 'page_for_posts' );
				$items[]       = array(
					'label' => $posts_page_id ? get_the_title( $posts_page_id ) : __( 'お知らせ', 'buybuycoms-hobby' ),
					'url'   => $posts_page_id ? get_permalink( $posts_page_id ) : home_url( '/' ),
				);
			} else {
				$post_type = get_post_type_object( $post->post_type );
				$archive   = get_post_type_archive_link( $post->post_type );
				if ( $post_type instanceof WP_Post_Type && $archive ) {
					$items[] = array(
						'label' => $post_type->labels->name,
						'url'   => $archive,
					);
				}
			}
			$items[] = array( 'label' => get_the_title( $post ) );
		}
	} elseif ( is_search() ) {
		$items[] = array( 'label' => sprintf( __( '「%s」の検索結果', 'buybuycoms-hobby' ), get_search_query() ) );
	} elseif ( is_404() ) {
		$items[] = array( 'label' => __( 'ページが見つかりません', 'buybuycoms-hobby' ) );
	}
	$last_index = count( $items ) - 1;
	?>
	<nav class="<?php echo esc_attr( $nav_class ); ?>" aria-label="<?php esc_attr_e( 'パンくずリスト', 'buybuycoms-hobby' ); ?>">
		<ol class="<?php echo esc_attr( $list_class ); ?>">
			<?php foreach ( $items as $index => $item ) : ?>
				<?php if ( 0 !== $index ) : ?>
					<li class="<?php echo esc_attr( $separator_class ); ?>" aria-hidden="true">&gt;</li>
				<?php endif; ?>
				<li class="<?php echo esc_attr( $index === $last_index ? $current_class : $item_class ); ?>"<?php echo $index === $last_index ? ' aria-current="page"' : ''; ?>>
					<?php if ( ! empty( $item['url'] ) && $index !== $last_index ) : ?>
						<a class="<?php echo esc_attr( $link_class ); ?>" href="<?php echo esc_url( $item['url'] ); ?>"><?php echo esc_html( $item['label'] ); ?></a>
					<?php else : ?>
						<?php echo esc_html( $item['label'] ); ?>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
		</ol>
	</nav>
	<?php
}

/**
 * Output the static branded logo.
 *
 * @return void
 */
function buybuycoms_hobby_brand() {
	?>
	<a class="hb__c-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<span class="hb__c-brand__mark" aria-hidden="true">
			<img
				src="<?php echo esc_url( get_theme_file_uri( '/images/logomark.png' ) ); ?>"
				alt=""
				class="hb__c-brand__mark-img"
			/>
		</span>
		<span class="hb__c-brand__text">
			<span class="hb__c-brand__name">売買コムズ</span>
			<span class="hb__c-brand__sub">hobbyベース</span>
		</span>
	</a>
	<?php
}
