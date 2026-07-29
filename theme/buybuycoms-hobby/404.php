<?php
/**
 * Not-found page.
 *
 * @package BuyBuyComs_Hobby
 */

get_header();
?>
<main id="main-content" class="hb__l-section">
	<div class="hb__l-container hb__p-empty">
		<h1>404</h1>
		<p><?php esc_html_e( 'お探しのページは見つかりませんでした。', 'buybuycoms-hobby' ); ?></p>
		<a class="hb__c-btn hb__c-btn--primary" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php esc_html_e( 'トップページへ戻る', 'buybuycoms-hobby' ); ?>
		</a>
	</div>
</main>
<?php
get_footer();
