<?php
/**
 * Site footer.
 *
 * @package BuyBuyComs_Hobby
 */
?>
<footer class="hb__l-footer" data-screen-label="Footer">
	<div class="hb__l-container hb__p-footer">
		<div class="hb__p-footer__brand">
			<?php buybuycoms_hobby_brand(); ?>
			<p class="hb__p-footer__about">
				ホビー・コレクター品専門の買取サービス。<br>
				箱に詰めて送るだけ。送料・査定料すべて無料。
			</p>
			<p class="hb__p-footer__addr">
				〒660-0085 兵庫県尼崎市元浜町4-88<br>
				Tel:<a href="tel:0120371147">0120-37-1147</a>/受付9:00～19:00
			</p>
		</div>

		<div class="hb__p-footer__col">
			<h2 class="hb__p-footer__col-title">サービス</h2>
			<ul class="hb__p-footer__list" role="list">
				<li><a href="<?php echo esc_url( home_url( '/flow/#takuhai-flow' ) ); ?>">宅配買取</a></li>
				<li><a href="<?php echo esc_url( home_url( '/flow/#shuccho-flow' ) ); ?>">出張買取</a></li>
				<li><a href="<?php echo esc_url( home_url( '/flow/#store-flow' ) ); ?>">店頭買取</a></li>
				<li><a href="<?php echo esc_url( home_url( '/flow/' ) ); ?>">買取の流れ</a></li>
			</ul>
		</div>

		<div class="hb__p-footer__col">
			<h2 class="hb__p-footer__col-title">買取品目</h2>
			<ul class="hb__p-footer__list" role="list">
				<li><a href="<?php echo esc_url( home_url( '/genre-list/' ) ); ?>">フィギュア</a></li>
				<li><a href="<?php echo esc_url( home_url( '/genre-list/' ) ); ?>">プラモデル</a></li>
				<li><a href="<?php echo esc_url( home_url( '/genre-list/' ) ); ?>">レトロゲーム</a></li>
				<li><a href="<?php echo esc_url( home_url( '/genre-list/' ) ); ?>">トレーディングカード</a></li>
			</ul>
		</div>

		<div class="hb__p-footer__col">
			<h2 class="hb__p-footer__col-title">サポート</h2>
			<?php
			if ( has_nav_menu( 'footer' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'container'      => false,
						'menu_class'     => 'hb__p-footer__list',
						'depth'          => 1,
					)
				);
			} else {
				?>
				<ul class="hb__p-footer__list" role="list">
					<li><a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>">よくある質問</a></li>
					<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">お問い合わせ</a></li>
					<li><a href="<?php echo esc_url( home_url( '/info/' ) ); ?>">お知らせ</a></li>
					<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">サイトトップ</a></li>
				</ul>
				<?php
			}
			?>
		</div>

		<div class="hb__p-footer__col">
			<h2 class="hb__p-footer__col-title">会社情報</h2>
			<ul class="hb__p-footer__list" role="list">
				<li><a href="<?php echo esc_url( home_url( '/company/' ) ); ?>">会社概要</a></li>
				<li><a href="<?php echo esc_url( home_url( '/privacy/' ) ); ?>">プライバシーポリシー</a></li>
				<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">お問い合わせ</a></li>
			</ul>
		</div>
	</div>

	<div class="hb__p-footer__legal">
		<div class="hb__l-container hb__p-footer__legal-inner">
			<span>兵庫県公安委員会 第631331400008号</span>
			<span class="hb__p-footer__dot" aria-hidden="true"></span>
			<span>Copyright © 2013-2026 byebyecoms all rights reserved.</span>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
