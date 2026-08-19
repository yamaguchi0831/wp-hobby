<?php
/**
 * Thank-you page displayed after a contact-form submission.
 *
 * @package BuyBuyComs_Hobby
 */

get_header();
?>

<main id="main-content" class="hb-thanks">
	<section class="hb__l-section hb-thanks__section">
		<div class="hb__l-container hb-thanks__container">
			<div class="hb-thanks__hero">
				<img
					class="hb-thanks__character"
					src="<?php echo esc_url( get_theme_file_uri( '/images/thanks-character.webp' ) ); ?>"
					alt=""
					width="120"
					height="197"
					decoding="async"
				>
				<h1 class="hb-thanks__title">お問い合わせ<span class="hb-thanks__mobile-break"><br></span>ありがとうございました</h1>
			</div>

			<div class="hb-thanks__content">
				<p>ご登録のメールアドレス宛に、受付内容の自動返信メールをお送りしています。<br>内容を確認のうえ、担当者より1～2営業日以内にご連絡いたします。</p>

				<div class="hb-thanks__notice">
					<p>※以下の場合、当店からのメールが届かない事がございます。</p>
					<ul>
						<li>メールアドレスに誤りがある（「.」と「,」の間違い、文字が全角、など）</li>
						<li>迷惑メールフォルダに振り分けられている</li>
						<li>携帯のキャリアメールで、パソコンからのメールをブロックしている</li>
						<li>ドメイン指定受信・アドレス指定受信を設定している</li>
					</ul>
				</div>

				<p>お心当たりのある方は、迷惑メールフォルダをご確認いただくとともに、下記のメールを受信できるよう設定をお願いします。</p>

				<dl class="hb-thanks__contact-details">
					<div>
						<dt>ドメイン</dt>
						<dd>@byebyecoms.com</dd>
					</div>
					<div>
						<dt>メールアドレス</dt>
						<dd>info@byebyecoms.com</dd>
					</div>
				</dl>

				<p>それでも解決しない場合は、直接以下までご連絡下さい。</p>
				<p class="hb-thanks__telephone"><a href="tel:0120371147">TEL 0120-37-1147</a><span>（9時～20時）</span></p>
			</div>

			<div class="hb-thanks__action">
				<a class="hb__c-btn hb__c-btn--primary hb__c-btn--lg" href="<?php echo esc_url( home_url( '/' ) ); ?>">TOPへ戻る</a>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>
