<?php
/**
 * Static first-stage template generated from pages/single-purchase-record.html.
 *
 * @package BuyBuyComs_Hobby
 */

$purchase_record_id = get_the_ID();
$item_image         = function_exists( 'get_field' ) ? get_field( 'item-image', $purchase_record_id ) : false;
$item_price         = function_exists( 'get_field' ) ? get_field( 'item-price', $purchase_record_id ) : false;

if ( false === $item_image || '' === $item_image || null === $item_image ) {
	$item_image = get_post_meta( $purchase_record_id, 'item-image', true );
}

if ( false === $item_price || '' === $item_price || null === $item_price ) {
	$item_price = get_post_meta( $purchase_record_id, 'item-price', true );
}

$item_image_markup = '';
$item_image_alt    = get_the_title( $purchase_record_id );
$price             = '';
$numeric_price     = str_replace( array( ',', '￥', '¥', '円', ' ' ), '', trim( (string) $item_price ) );
$genre_terms       = get_the_terms( $purchase_record_id, 'genre' );
$genre_names       = array();
$small_genre_names = array();
$post_content      = get_post_field( 'post_content', $purchase_record_id );

if ( '' !== $numeric_price && ctype_digit( $numeric_price ) ) {
	$price = number_format_i18n( (int) $numeric_price ) . '円';
} elseif ( '' !== trim( (string) $item_price ) ) {
	$price = trim( (string) $item_price );
}

if ( ! is_wp_error( $genre_terms ) && $genre_terms ) {
	$genre_names = wp_list_pluck( $genre_terms, 'name' );

	foreach ( $genre_terms as $genre_term ) {
		if ( 0 !== (int) $genre_term->parent ) {
			$small_genre_names[] = $genre_term->name;
		}
	}
}

if ( is_array( $item_image ) ) {
	$item_image_id = ! empty( $item_image['ID'] )
		? absint( $item_image['ID'] )
		: ( ! empty( $item_image['id'] ) ? absint( $item_image['id'] ) : 0 );

	if ( $item_image_id ) {
		$item_image_markup = wp_get_attachment_image(
			$item_image_id,
			'large',
			false,
			array(
				'class' => 'hb-single-purchase-record__p-image',
				'alt'   => ! empty( $item_image['alt'] ) ? $item_image['alt'] : $item_image_alt,
			)
		);
	} elseif ( ! empty( $item_image['url'] ) ) {
		$item_image_markup = sprintf(
			'<img class="hb-single-purchase-record__p-image" src="%1$s" alt="%2$s" loading="eager" />',
			esc_url( $item_image['url'] ),
			esc_attr( ! empty( $item_image['alt'] ) ? $item_image['alt'] : $item_image_alt )
		);
	}
} elseif ( is_numeric( $item_image ) ) {
	$item_image_markup = wp_get_attachment_image(
		absint( $item_image ),
		'large',
		false,
		array(
			'class' => 'hb-single-purchase-record__p-image',
			'alt'   => $item_image_alt,
		)
	);
} elseif ( is_string( $item_image ) && '' !== trim( $item_image ) ) {
	$item_image_markup = sprintf(
		'<img class="hb-single-purchase-record__p-image" src="%1$s" alt="%2$s" loading="eager" />',
		esc_url( $item_image ),
		esc_attr( $item_image_alt )
	);
}

get_header();
?>

    <main id="main-content">
      <article class="hb-single-purchase-record__p-detail">
        <div class="hb__l-container">
          <div class="hb-single-purchase-record__p-card">
            <figure class="hb-single-purchase-record__p-image-frame">
              <?php if ( $item_image_markup ) : ?>
                <?php echo wp_kses_post( $item_image_markup ); ?>
              <?php else : ?>
                <span class="hb-single-purchase-record__p-image hb-single-purchase-record__p-image--empty" aria-hidden="true"></span>
              <?php endif; ?>
            </figure>

            <div class="hb-single-purchase-record__p-summary">
              <?php if ( $small_genre_names ) : ?>
                <div class="hb-single-purchase-record__p-labels">
                  <?php foreach ( $small_genre_names as $small_genre_name ) : ?>
                    <span class="hb-single-purchase-record__p-label">
                      <?php echo esc_html( $small_genre_name ); ?>
                    </span>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>
              <h1 class="hb-single-purchase-record__p-title">
                <?php echo esc_html( get_the_title( $purchase_record_id ) ); ?>
              </h1>
              <?php if ( $genre_names ) : ?>
                <span class="hb-single-purchase-record__p-category">
                  <?php echo esc_html( implode( '、', $genre_names ) ); ?>
                </span>
              <?php endif; ?>
              <?php if ( '' !== $price ) : ?>
                <div class="hb-single-purchase-record__p-price-row">
                  <span class="hb-single-purchase-record__p-price-label"
                    >買取価格</span
                  >
                  <span class="hb-single-purchase-record__p-price">
                    <?php echo esc_html( $price ); ?>
                  </span>
                </div>
              <?php endif; ?>
              <p class="hb-single-purchase-record__p-location">
                2026/7/25 神奈川県で宅配買取
              </p>
              <a
                class="hb-single-purchase-record__p-cta"
                href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"
                >査定を申し込む</a
              >
            </div>
          </div>

          <?php if ( '' !== trim( wp_strip_all_tags( $post_content ) ) ) : ?>
            <section
              class="hb-single-purchase-record__p-note"
              aria-labelledby="staff-comment"
            >
              <h2
                class="hb-single-purchase-record__p-note-title"
                id="staff-comment"
              >
                買取スタッフからの一言
              </h2>
              <div class="hb-single-purchase-record__p-note-body">
                <?php the_content(); ?>
              </div>
            </section>
          <?php endif; ?>
          <?php get_template_part( 'template-parts/content/blog-card' ); ?>
        </div>
      </article>

      <div class="hb__l-container hb-single-purchase-record__p-cta-block">
        <?php get_template_part( 'template-parts/common/parts-cta' ); ?>
      </div>

      <?php
      get_template_part(
        'template-parts/common/purchase-records-section',
        null,
        array(
          'grid_id' => 'single-purchase-records',
        )
      );
      ?>

      <div class="hb__l-container hb-single-purchase-record__p-cta-block">
        <?php get_template_part( 'template-parts/common/parts-cta' ); ?>
      </div>

      <section class="hb__l-section hb__l-section--soft" id="genres">
        <div class="hb__l-container">
          <header
            class="hb-single-purchase-record__c-section-head hb-single-purchase-record__c-section-head--center"
          >
            <span class="hb-single-purchase-record__c-section-head__kicker"
              >Genres</span
            >
            <h2 class="hb-single-purchase-record__c-section-head__title">
              幅広い
              <span class="hb-single-purchase-record__c-hl">買取品目</span>
            </h2>
            <p class="hb-single-purchase-record__c-section-head__lead">
              定番ジャンルからコレクター向けアイテムまで、まとめて査定できます。
            </p>
          </header>
          <?php get_template_part( 'template-parts/common/genre-table' ); ?>
        </div>
      </section>

      <section class="hb__l-section" id="methods">
        <div class="hb__l-container">
          <header
            class="hb-single-purchase-record__c-section-head hb-single-purchase-record__c-section-head--center"
          >
            <span class="hb-single-purchase-record__c-section-head__kicker"
              >Methods</span
            >
            <h2 class="hb-single-purchase-record__c-section-head__title">
              あなたに合わせて選べる、<br />
              <span class="hb-single-purchase-record__c-hl">3つの買取方法</span>
            </h2>
            <p class="hb-single-purchase-record__c-section-head__lead">
              量やお住まいの地域、ご希望の進め方に合わせて選べます。
            </p>
          </header>
          <?php get_template_part( 'template-parts/common/purchase-methods' ); ?>
        </div>
      </section>

      <div class="hb__l-container hb-single-purchase-record__p-cta-block">
        <?php get_template_part( 'template-parts/common/parts-cta' ); ?>
      </div>

      <?php
      ob_start();
      get_template_part( 'template-parts/common/customer-reviews' );
      $purchase_record_reviews_markup = trim( ob_get_clean() );
      ?>
      <?php if ( '' !== $purchase_record_reviews_markup ) : ?>
        <section class="hb__l-section hb__l-section--soft" id="reviews">
          <div class="hb__l-container">
            <header
              class="hb-single-purchase-record__c-section-head hb-single-purchase-record__c-section-head--center"
            >
              <span class="hb-single-purchase-record__c-section-head__kicker"
                >Reviews</span
              >
              <h2 class="hb-single-purchase-record__c-section-head__title">
                お客様の
                <span class="hb-single-purchase-record__c-hl">声</span>
              </h2>
              <p class="hb-single-purchase-record__c-section-head__lead">
                実際にご利用いただいたお客様からのレビューです。
              </p>
            </header>
            <?php echo wp_kses_post( $purchase_record_reviews_markup ); ?>
          </div>
        </section>
      <?php endif; ?>

      <section class="hb__l-section" id="faq">
        <div class="hb__l-container">
          <header
            class="hb-single-purchase-record__c-section-head hb-single-purchase-record__c-section-head--center"
          >
            <span class="hb-single-purchase-record__c-section-head__kicker"
              >FAQ</span
            >
            <h2 class="hb-single-purchase-record__c-section-head__title">
              よくある
              <span class="hb-single-purchase-record__c-hl">質問</span>
            </h2>
          </header>

          <div class="hb-single-purchase-record__p-faq-list">
            <article class="hb-single-purchase-record__p-faq-item">
              <button
                class="hb-single-purchase-record__p-faq-question"
                type="button"
                aria-expanded="false"
                data-hb-faq-question
              >
                <span
                  class="hb-single-purchase-record__p-faq-icon hb-single-purchase-record__p-faq-icon--q"
                  >Q</span
                >
                <span>送料・査定料・返送料は本当に無料ですか？</span>
                <span class="hb-single-purchase-record__p-faq-toggle">＋</span>
              </button>
              <div class="hb-single-purchase-record__p-faq-answer">
                <span
                  class="hb-single-purchase-record__p-faq-icon hb-single-purchase-record__p-faq-icon--a"
                  >A</span
                >
                <p class="hb-single-purchase-record__p-faq-text">
                  はい、すべて無料です。査定金額にご納得いただけず返送される場合も、返送料は当社負担です。
                  「とりあえず査定だけ」というご相談も大歓迎ですので、お気軽にお申込みください。
                </p>
                <?php get_template_part( 'template-parts/common/parts-cta' ); ?>
              </div>
            </article>

            <article class="hb-single-purchase-record__p-faq-item">
              <button
                class="hb-single-purchase-record__p-faq-question"
                type="button"
                aria-expanded="false"
                data-hb-faq-question
              >
                <span
                  class="hb-single-purchase-record__p-faq-icon hb-single-purchase-record__p-faq-icon--q"
                  >Q</span
                >
                <span>箱なし・付属品なしでも買取してもらえますか？</span>
                <span class="hb-single-purchase-record__p-faq-toggle">＋</span>
              </button>
              <div class="hb-single-purchase-record__p-faq-answer">
                <span
                  class="hb-single-purchase-record__p-faq-icon hb-single-purchase-record__p-faq-icon--a"
                  >A</span
                >
                <p class="hb-single-purchase-record__p-faq-text">
                  買取可能です。ただし、箱・説明書・付属品が揃っているほうが査定金額は高くなる傾向にあります。
                  状態に不安がある場合も、ひとまず査定にお出しください。1点ずつ丁寧に査定いたします。
                </p>
                <?php get_template_part( 'template-parts/common/parts-cta' ); ?>
              </div>
            </article>

            <article class="hb-single-purchase-record__p-faq-item">
              <button
                class="hb-single-purchase-record__p-faq-question"
                type="button"
                aria-expanded="false"
                data-hb-faq-question
              >
                <span
                  class="hb-single-purchase-record__p-faq-icon hb-single-purchase-record__p-faq-icon--q"
                  >Q</span
                >
                <span>何点から買取してもらえますか？</span>
                <span class="hb-single-purchase-record__p-faq-toggle">＋</span>
              </button>
              <div class="hb-single-purchase-record__p-faq-answer">
                <span
                  class="hb-single-purchase-record__p-faq-icon hb-single-purchase-record__p-faq-icon--a"
                  >A</span
                >
                <p class="hb-single-purchase-record__p-faq-text">
                  1点からお預かりいたします。逆に、段ボール30箱以上の大量買取にも対応可能ですので、
                  量を気にせずまとめてお送りください。
                </p>
                <?php get_template_part( 'template-parts/common/parts-cta' ); ?>
              </div>
            </article>

            <article class="hb-single-purchase-record__p-faq-item">
              <button
                class="hb-single-purchase-record__p-faq-question"
                type="button"
                aria-expanded="false"
                data-hb-faq-question
              >
                <span
                  class="hb-single-purchase-record__p-faq-icon hb-single-purchase-record__p-faq-icon--q"
                  >Q</span
                >
                <span>入金までどのくらいかかりますか？</span>
                <span class="hb-single-purchase-record__p-faq-toggle">＋</span>
              </button>
              <div class="hb-single-purchase-record__p-faq-answer">
                <span
                  class="hb-single-purchase-record__p-faq-icon hb-single-purchase-record__p-faq-icon--a"
                  >A</span
                >
                <p class="hb-single-purchase-record__p-faq-text">
                  商品到着から最短当日に査定、ご承諾いただいたあと最短1営業日でお振込みします。
                  点数が多い場合は2〜3営業日いただくことがあります。
                </p>
                <?php get_template_part( 'template-parts/common/parts-cta' ); ?>
              </div>
            </article>

            <article class="hb-single-purchase-record__p-faq-item">
              <button
                class="hb-single-purchase-record__p-faq-question"
                type="button"
                aria-expanded="false"
                data-hb-faq-question
              >
                <span
                  class="hb-single-purchase-record__p-faq-icon hb-single-purchase-record__p-faq-icon--q"
                  >Q</span
                >
                <span>査定金額に納得できない場合はどうなりますか？</span>
                <span class="hb-single-purchase-record__p-faq-toggle">＋</span>
              </button>
              <div class="hb-single-purchase-record__p-faq-answer">
                <span
                  class="hb-single-purchase-record__p-faq-icon hb-single-purchase-record__p-faq-icon--a"
                  >A</span
                >
                <p class="hb-single-purchase-record__p-faq-text">
                  キャンセル可能です。当社負担で全品を元の状態でご返送いたします。
                  キャンセル料・返送料はかかりません。
                </p>
                <?php get_template_part( 'template-parts/common/parts-cta' ); ?>
              </div>
            </article>

            <article class="hb-single-purchase-record__p-faq-item">
              <button
                class="hb-single-purchase-record__p-faq-question"
                type="button"
                aria-expanded="false"
                data-hb-faq-question
              >
                <span
                  class="hb-single-purchase-record__p-faq-icon hb-single-purchase-record__p-faq-icon--q"
                  >Q</span
                >
                <span>個人情報はどのように管理されていますか？</span>
                <span class="hb-single-purchase-record__p-faq-toggle">＋</span>
              </button>
              <div class="hb-single-purchase-record__p-faq-answer">
                <span
                  class="hb-single-purchase-record__p-faq-icon hb-single-purchase-record__p-faq-icon--a"
                  >A</span
                >
                <p class="hb-single-purchase-record__p-faq-text">
                  SSL通信による暗号化、および古物営業法に基づく管理を徹底しています。
                  お客様情報を第三者に開示・販売することは一切ありません。
                </p>
                <?php get_template_part( 'template-parts/common/parts-cta' ); ?>
              </div>
            </article>
          </div>
        </div>
      </section>

      <?php get_template_part( 'template-parts/common/footer-cta' ); ?>
    </main>

    <?php get_footer(); ?>
