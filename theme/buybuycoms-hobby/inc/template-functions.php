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
	$links = array(
		'/flow/'       => __( '買取方法', 'buybuycoms-hobby' ),
		'/reason/'     => __( '選ばれる理由', 'buybuycoms-hobby' ),
		'/genre-list/' => __( 'カテゴリー一覧', 'buybuycoms-hobby' ),
		'/faq/'        => __( 'よくある質問', 'buybuycoms-hobby' ),
		'/company/'    => __( '会社概要', 'buybuycoms-hobby' ),
	);

	echo '<ul class="hb__p-header__nav-list">';
	foreach ( $links as $path => $label ) {
		printf(
			'<li><a href="%1$s">%2$s</a></li>',
			esc_url( home_url( $path ) ),
			esc_html( $label )
		);
	}
	echo '</ul>';
}

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
