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
 * Output a branded logo with a static fallback.
 *
 * @return void
 */
function buybuycoms_hobby_brand() {
	if ( has_custom_logo() ) {
		the_custom_logo();
		return;
	}
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
			<span class="hb__c-brand__name"><?php bloginfo( 'name' ); ?></span>
			<span class="hb__c-brand__sub"><?php bloginfo( 'description' ); ?></span>
		</span>
	</a>
	<?php
}
