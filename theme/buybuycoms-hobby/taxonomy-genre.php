<?php
/**
 * Static first-stage template generated from pages/taxonomy-genre.html.
 *
 * @package BuyBuyComs_Hobby
 */
?>
<?php get_header(); ?>

<?php
$genre_term    = get_queried_object();
$genre_term_id = $genre_term instanceof WP_Term ? $genre_term->term_id : 0;
$genre_context = $genre_term_id ? 'genre_' . $genre_term_id : '';

$genre_get_field = static function ( $field_name, $fallback = '' ) use ( $genre_context, $genre_term_id ) {
	$value = false;

	if ( $genre_context && function_exists( 'get_field' ) ) {
		$value = get_field( $field_name, $genre_context );
	}

	if ( ( false === $value || '' === $value || null === $value ) && $genre_term_id ) {
		$value = get_term_meta( $genre_term_id, $field_name, true );
	}

	return ( false === $value || '' === $value || null === $value ) ? $fallback : $value;
};

$genre_title      = $genre_term instanceof WP_Term ? $genre_term->name : 'XXXXX買取';
$genre_copy_text  = $genre_get_field( 'genre-copy-text', 'XXXも、XXXも' );
$genre_subtext1   = $genre_get_field( 'genre-subtext1', 'ココにテキストが入ります' );
$genre_subtext2   = $genre_get_field( 'genre-subtext2', 'ココにテキストが入ります' );
$genre_badge_text = $genre_get_field( 'genre-badge-text', "TEXT\nTEXTTEXT\nTEXT" );
$genre_mv         = $genre_get_field( 'genre-mv' );
$genre_mv_url     = get_theme_file_uri( '/images/mv01.webp' );
$genre_mv_alt     = $genre_title . 'のイメージ';
$genre_faq_json   = $genre_get_field( 'genre-faq' );
$genre_faq_items  = array();

if ( is_array( $genre_mv ) ) {
	$genre_mv_url = ! empty( $genre_mv['url'] ) ? $genre_mv['url'] : $genre_mv_url;
	$genre_mv_alt = ! empty( $genre_mv['alt'] ) ? $genre_mv['alt'] : $genre_mv_alt;
} elseif ( is_numeric( $genre_mv ) ) {
	$genre_mv_id  = (int) $genre_mv;
	$genre_mv_url = wp_get_attachment_image_url( $genre_mv_id, 'full' ) ?: $genre_mv_url;
	$genre_mv_alt = get_post_meta( $genre_mv_id, '_wp_attachment_image_alt', true ) ?: $genre_mv_alt;
} elseif ( is_string( $genre_mv ) && '' !== $genre_mv ) {
	$genre_mv_url = $genre_mv;
}

if ( is_string( $genre_faq_json ) && '' !== trim( $genre_faq_json ) ) {
	$genre_faq_data = json_decode( $genre_faq_json, true );

	if ( JSON_ERROR_NONE === json_last_error() && is_array( $genre_faq_data ) ) {
		foreach ( $genre_faq_data as $genre_faq_item ) {
			if ( ! is_array( $genre_faq_item ) ) {
				continue;
			}

			$genre_faq_question = isset( $genre_faq_item['question'] )
				? trim( wp_strip_all_tags( (string) $genre_faq_item['question'] ) )
				: '';
			$genre_faq_answer   = isset( $genre_faq_item['answer'] )
				? trim( wp_strip_all_tags( (string) $genre_faq_item['answer'] ) )
				: '';

			if ( '' === $genre_faq_question || '' === $genre_faq_answer ) {
				continue;
			}

			$genre_faq_items[] = array(
				'question' => $genre_faq_question,
				'answer'   => $genre_faq_answer,
			);
		}
	}
}
?>

    <main id="main-content">
      <section class="hb-item-genre__p-hero" data-screen-label="02 Hero">
        <div class="hb-item-genre__p-hero__bg" aria-hidden="true"></div>
        <div class="hb__l-container hb-item-genre__p-hero__inner">
          <div class="hb-item-genre__p-hero__copy">
            <div class="hb-item-genre__p-hero__ribbon">
              <strong><?php echo esc_html( sprintf( '%s買取', $genre_title ) ); ?></strong>
            </div>
            <p class="hb-item-genre__p-hero__subcopy"><?php echo esc_html( $genre_copy_text ); ?></p>
            <h1 class="hb-item-genre__p-hero__title">
              <span>
                <em class="hb-item-genre__p-hero__title-accent">まとめて</em
                >高く
              </span>
              <span>買取ります！</span>
            </h1>
            <div class="hb-item-genre__p-hero__badge">
              <?php echo nl2br( esc_html( $genre_badge_text ) ); ?>
            </div>
            <p class="hb-item-genre__p-hero__lead">
              <span><?php echo esc_html( $genre_subtext1 ); ?></span>
              <span><?php echo esc_html( $genre_subtext2 ); ?></span>
            </p>
          </div>

          <div class="hb-item-genre__p-hero__visual">
            <img
              class="hb-item-genre__p-hero__visual-img"
              src="<?php echo esc_url( $genre_mv_url ); ?>"
              alt="<?php echo esc_attr( $genre_mv_alt ); ?>"
              width="980"
              height="720"
            />
          </div>

          <div class="hb-item-genre__p-hero__action">
            <div class="hb-item-genre__p-hero__ctas">
              <a
                href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"
                class="hb-item-genre__p-hero__cta hb-item-genre__p-hero__cta--primary"
              >
                <img
                  src="<?php echo esc_url( get_theme_file_uri( '/images/icon/icon-cta_satei.svg' ) ); ?>"
                  alt=""
                  width="40"
                  height="40"
                />
                <span>無料査定を申し込む</span>
                <span
                  class="hb-item-genre__p-hero__cta-arrow"
                  aria-hidden="true"
                  >›</span
                >
              </a>
              <a
                href="<?php echo esc_url( 'https://line.me/R/ti/p/@081xadbs' ); ?>"
                class="hb-item-genre__p-hero__cta hb-item-genre__p-hero__cta--line"
              >
                <img
                  src="<?php echo esc_url( get_theme_file_uri( '/images/icon/icon-cta_line.svg' ) ); ?>"
                  alt=""
                  width="40"
                  height="40"
                />
                <span>LINEで写真査定する</span>
                <span
                  class="hb-item-genre__p-hero__cta-arrow"
                  aria-hidden="true"
                  >›</span
                >
              </a>
            </div>
          </div>
        </div>
      </section>

      <div class="hb__l-container">
      <?php buybuycoms_hobby_breadcrumb(); ?>
      </div>

      <section class="hb__l-section hb-item-genre__p-results" id="results">
        <div class="hb__l-container">
          <div class="hb-item-genre__p-section-head">
            <h2 class="hb-item-genre__p-section-title">買取価格実績</h2>
          </div>
          <?php get_template_part( 'template-parts/common/purchase-records' ); ?>
        </div>
      </section>

      <div class="hb__l-container">
        <?php get_template_part( 'template-parts/common/parts-cta' ); ?>
      </div>

      <section class="hb__l-section hb-item-genre__p-recommend" id="recommend">
        <div class="hb__l-container">
          <div class="hb-item-genre__p-recommend-inner">
            <div class="hb-item-genre__p-section-head">
              <h2 class="hb-item-genre__p-section-title">
                こんな方にご利用いただいております！
              </h2>
            </div>
            <ul class="hb-item-genre__p-recommend-list">
              <li class="hb-item-genre__p-recommend-item">
                <img src="<?php echo esc_url( get_theme_file_uri( '/images/type01.webp' ) ); ?>" alt="" />
                <span>手軽にすばやく売りたい</span>
              </li>
              <li class="hb-item-genre__p-recommend-item">
                <img src="<?php echo esc_url( get_theme_file_uri( '/images/type02.webp' ) ); ?>" alt="" />
                <span>フリマで出品が面倒、トラブルが不安</span>
              </li>
              <li class="hb-item-genre__p-recommend-item">
                <img src="<?php echo esc_url( get_theme_file_uri( '/images/type03.webp' ) ); ?>" alt="" />
                <span>コレクションをまとめて整理したい</span>
              </li>
              <li class="hb-item-genre__p-recommend-item">
                <img src="<?php echo esc_url( get_theme_file_uri( '/images/type04.webp' ) ); ?>" alt="" />
                <span>鑑定のプロにしっかり査定してもらいたい</span>
              </li>
            </ul>
          </div>
        </div>
      </section>

      <section class="hb__l-section hb-item-genre__p-solution" id="solution">
        <div class="hb__l-container">
          <div class="hb-item-genre__p-section-head">
            <h2 class="hb-item-genre__p-section-title">
              安心して任せられる6つのポイント
            </h2>
          </div>
          <div class="hb-item-genre__p-solution-grid">
            <article class="hb-item-genre__p-solution-card">
              <span class="hb-item-genre__p-solution-number">01</span>
              <figure class="hb-item-genre__p-solution-image">
                <img src="<?php echo esc_url( get_theme_file_uri( '/images/ans01.webp' ) ); ?>" alt="買取キットのイメージ" />
              </figure>
              <h3 class="hb-item-genre__p-card-title">
                買取キットを無料でプレゼント！
              </h3>
              <p class="hb-item-genre__p-card-text">
                全国対応の買取キットで、売りたいものを箱に詰めるだけでOK！何箱でも無料で進呈いたします。
              </p>
            </article>
            <article class="hb-item-genre__p-solution-card">
              <span class="hb-item-genre__p-solution-number">02</span>
              <figure class="hb-item-genre__p-solution-image">
                <img src="<?php echo esc_url( get_theme_file_uri( '/images/ans02.webp' ) ); ?>" alt="集荷手配のイメージ" />
              </figure>
              <h3 class="hb-item-genre__p-card-title">
                集荷の手配も代行します！
              </h3>
              <p class="hb-item-genre__p-card-text">
                ご自宅まで集荷スタッフが引き取りに伺いますのでわずらわしい手続きは不要です。
              </p>
            </article>
            <article class="hb-item-genre__p-solution-card">
              <span class="hb-item-genre__p-solution-number">03</span>
              <figure class="hb-item-genre__p-solution-image">
                <img src="<?php echo esc_url( get_theme_file_uri( '/images/ans03.webp' ) ); ?>" alt="事前査定のイメージ" />
              </figure>
              <h3 class="hb-item-genre__p-card-title">事前査定もOK！</h3>
              <p class="hb-item-genre__p-card-text">
                モデルを伝えるだけで査定が可能！査定後のキャンセルもOK！安心してご依頼いただけます。
              </p>
            </article>
            <article class="hb-item-genre__p-solution-card">
              <span class="hb-item-genre__p-solution-number">04</span>
              <figure class="hb-item-genre__p-solution-image">
                <img src="<?php echo esc_url( get_theme_file_uri( '/images/ans04.webp' ) ); ?>" alt="大量買取のイメージ" />
              </figure>
              <h3 class="hb-item-genre__p-card-title">大量大歓迎！</h3>
              <p class="hb-item-genre__p-card-text">
                数が多い場合でも、おまとめアップ査定でお得に売却が可能。ジャンルを問わず幅広く買取いたします。
              </p>
            </article>
            <article class="hb-item-genre__p-solution-card">
              <span class="hb-item-genre__p-solution-number">05</span>
              <figure class="hb-item-genre__p-solution-image">
                <img
                  src="<?php echo esc_url( get_theme_file_uri( '/images/ans05.webp' ) ); ?>"
                  alt="専門バイヤーの査定イメージ"
                />
              </figure>
              <h3 class="hb-item-genre__p-card-title">査定のプロのみが鑑定</h3>
              <p class="hb-item-genre__p-card-text">
                ホビーの知識を持つ専門バイヤーのみが査定を担当。相場や希少性を正確に評価します。
              </p>
            </article>
            <article class="hb-item-genre__p-solution-card">
              <span class="hb-item-genre__p-solution-number">06</span>
              <figure class="hb-item-genre__p-solution-image">
                <img
                  src="<?php echo esc_url( get_theme_file_uri( '/images/ans06.webp' ) ); ?>"
                  alt="コレクション整理のイメージ"
                />
              </figure>
              <h3 class="hb-item-genre__p-card-title">
                生前整理・遺品整理も対応
              </h3>
              <p class="hb-item-genre__p-card-text">
                大切なコレクションを1点1点、真心を込めて査定いたします。
              </p>
            </article>
          </div>
        </div>
      </section>

      <div class="hb__l-container">
        <?php get_template_part( 'template-parts/common/parts-cta' ); ?>
      </div>

      <section class="hb__l-section hb__p-method" id="method">
        <div class="hb__l-container">
          <div class="hb-item-genre__p-section-head">
            <h2 class="hb-item-genre__p-section-title">選べる3つの買取方法</h2>
          </div>
          <?php get_template_part( 'template-parts/common/purchase-methods' ); ?>
        </div>
      </section>

      <?php if ( false ) : // 買取強化中のアイテムは非表示。 ?>
      <section class="hb__l-section hb-item-genre__p-featured" id="featured">
        <div class="hb__l-container">
          <div class="hb-item-genre__p-section-head">
            <h2 class="hb-item-genre__p-section-title">
              買取強化中の<span class="hb__c-hl">アイテム</span>
            </h2>
            <p class="hb-item-genre__p-lead">
              2026年5月時点で相場が高騰中・需要が高いシリーズです。お手元にあれば、ぜひお売りください。
            </p>
          </div>
          <div class="hb-item-genre__p-featured-grid">
            <article class="hb-item-genre__p-featured-card">
              <figure class="hb-item-genre__p-featured-image">
                <img
                  src="https://placehold.co/640x480/eef3ee/5f6f66?text=S.H.Figuarts"
                  alt="S.H.Figuartsのイメージ"
                />
                <span class="hb-item-genre__p-featured-badge">買取強化中</span>
              </figure>
              <div class="hb-item-genre__p-featured-body">
                <h3 class="hb-item-genre__p-featured-title">S.H.Figuarts</h3>
                <a
                  class="hb-item-genre__p-featured-link"
                  href="#price"
                  aria-label="S.H.Figuartsの詳細を見る"
                  >›</a
                >
              </div>
            </article>
            <article class="hb-item-genre__p-featured-card">
              <figure class="hb-item-genre__p-featured-image">
                <img
                  src="https://placehold.co/640x480/eef3ee/5f6f66?text=METAL+BUILD"
                  alt="METAL BUILDのイメージ"
                />
                <span class="hb-item-genre__p-featured-badge">買取強化中</span>
              </figure>
              <div class="hb-item-genre__p-featured-body">
                <h3 class="hb-item-genre__p-featured-title">METAL BUILD</h3>
                <a
                  class="hb-item-genre__p-featured-link"
                  href="#price"
                  aria-label="METAL BUILDの詳細を見る"
                  >›</a
                >
              </div>
            </article>
            <article class="hb-item-genre__p-featured-card">
              <figure class="hb-item-genre__p-featured-image">
                <img
                  src="https://placehold.co/640x480/eef3ee/5f6f66?text=Nendoroid"
                  alt="ねんどろいどのイメージ"
                />
                <span class="hb-item-genre__p-featured-badge">買取強化中</span>
              </figure>
              <div class="hb-item-genre__p-featured-body">
                <h3 class="hb-item-genre__p-featured-title">ねんどろいど</h3>
                <a
                  class="hb-item-genre__p-featured-link"
                  href="#price"
                  aria-label="ねんどろいどの詳細を見る"
                  >›</a
                >
              </div>
            </article>
            <article class="hb-item-genre__p-featured-card">
              <figure class="hb-item-genre__p-featured-image">
                <img
                  src="https://placehold.co/640x480/eef3ee/5f6f66?text=figma"
                  alt="figmaのイメージ"
                />
                <span class="hb-item-genre__p-featured-badge">買取強化中</span>
              </figure>
              <div class="hb-item-genre__p-featured-body">
                <h3 class="hb-item-genre__p-featured-title">figma</h3>
                <a
                  class="hb-item-genre__p-featured-link"
                  href="#price"
                  aria-label="figmaの詳細を見る"
                  >›</a
                >
              </div>
            </article>
            <article class="hb-item-genre__p-featured-card">
              <figure class="hb-item-genre__p-featured-image">
                <img
                  src="https://placehold.co/640x480/eef3ee/5f6f66?text=Ichiban+Kuji"
                  alt="一番くじフィギュアのイメージ"
                />
                <span class="hb-item-genre__p-featured-badge">買取強化中</span>
              </figure>
              <div class="hb-item-genre__p-featured-body">
                <h3 class="hb-item-genre__p-featured-title">
                  一番くじフィギュア
                </h3>
                <a
                  class="hb-item-genre__p-featured-link"
                  href="#price"
                  aria-label="一番くじフィギュアの詳細を見る"
                  >›</a
                >
              </div>
            </article>
            <article class="hb-item-genre__p-featured-card">
              <figure class="hb-item-genre__p-featured-image">
                <img
                  src="https://placehold.co/640x480/eef3ee/5f6f66?text=Chogokin"
                  alt="超合金のイメージ"
                />
                <span class="hb-item-genre__p-featured-badge">買取強化中</span>
              </figure>
              <div class="hb-item-genre__p-featured-body">
                <h3 class="hb-item-genre__p-featured-title">超合金</h3>
                <a
                  class="hb-item-genre__p-featured-link"
                  href="#price"
                  aria-label="超合金の詳細を見る"
                  >›</a
                >
              </div>
            </article>
            <article class="hb-item-genre__p-featured-card">
              <figure class="hb-item-genre__p-featured-image">
                <img
                  src="https://placehold.co/640x480/eef3ee/5f6f66?text=Prize"
                  alt="プライズフィギュアのイメージ"
                />
                <span class="hb-item-genre__p-featured-badge">買取強化中</span>
              </figure>
              <div class="hb-item-genre__p-featured-body">
                <h3 class="hb-item-genre__p-featured-title">
                  プライズフィギュア
                </h3>
                <a
                  class="hb-item-genre__p-featured-link"
                  href="#price"
                  aria-label="プライズフィギュアの詳細を見る"
                  >›</a
                >
              </div>
            </article>
            <article class="hb-item-genre__p-featured-card">
              <figure class="hb-item-genre__p-featured-image">
                <img
                  src="https://placehold.co/640x480/eef3ee/5f6f66?text=Gunpla"
                  alt="ガンプラのイメージ"
                />
                <span class="hb-item-genre__p-featured-badge">買取強化中</span>
              </figure>
              <div class="hb-item-genre__p-featured-body">
                <h3 class="hb-item-genre__p-featured-title">ガンプラ</h3>
                <a
                  class="hb-item-genre__p-featured-link"
                  href="#price"
                  aria-label="ガンプラの詳細を見る"
                  >›</a
                >
              </div>
            </article>
          </div>
        </div>
      </section>
      <?php endif; ?>

      <div class="hb__l-container">
        <?php get_template_part( 'template-parts/common/parts-cta' ); ?>
      </div>

      <section class="hb__l-section hb-item-genre__p-condition" id="condition">
        <div class="hb__l-container hb-item-genre__p-split">
          <figure class="hb-item-genre__p-split-image">
            <img
              src="<?php echo esc_url( get_theme_file_uri( '/images/condition02.webp' ) ); ?>"
              alt="さまざまな状態のホビー品のイメージ"
            />
          </figure>
          <div class="hb-item-genre__p-split-body">
            <h2 class="hb-item-genre__p-split-title">
              こんな状態でも買取可能です
            </h2>
            <p class="hb-item-genre__p-lead">
              新品未開封はもちろん、開封済み・箱なし・付属品なし・パーツ欠品・経年劣化のあるものまで、フィギュアならどんな状態でもまずは査定にお出しください。専門バイヤーが再販・パーツ取りの観点まで含めて1点ずつ価値を見極めます。
            </p>
            <ul class="hb-item-genre__p-ok-list">
              <li class="hb-item-genre__p-ok-item">
                <span class="hb-item-genre__p-ok-badge">OK</span>
                <span>新品・未開封・シュリンク付きOK</span>
              </li>
              <li class="hb-item-genre__p-ok-item">
                <span class="hb-item-genre__p-ok-badge">OK</span>
                <span>開封済み・展示品OK</span>
              </li>
              <li class="hb-item-genre__p-ok-item">
                <span class="hb-item-genre__p-ok-badge">OK</span>
                <span>外箱なし・本体のみOK</span>
              </li>
              <li class="hb-item-genre__p-ok-item">
                <span class="hb-item-genre__p-ok-badge">OK</span>
                <span>付属品・パーツ一部欠品OK</span>
              </li>
              <li class="hb-item-genre__p-ok-item">
                <span class="hb-item-genre__p-ok-badge">OK</span>
                <span>経年劣化・色褪せ・黄ばみOK</span>
              </li>
            </ul>
          </div>
        </div>
      </section>

      <section class="hb__l-section hb-item-genre__p-tips" id="tips">
        <div class="hb__l-container">
          <div class="hb-item-genre__p-split-body">
            <h2 class="hb-item-genre__p-split-title">
              <?php echo esc_html( sprintf( '%sを高く売るコツ', $genre_title ) ); ?>
            </h2>
            <ol class="hb-item-genre__p-tip-list">
              <li class="hb-item-genre__p-tip-item">
                <figure class="hb-item-genre__p-tip-image">
                  <img src="<?php echo esc_url( get_theme_file_uri( '/images/1.shinpin.webp' ) ); ?>" alt="" />
                </figure>
                <div class="hb-item-genre__p-tip-body">
                  <span class="hb-item-genre__p-tip-number">1</span>
                  <h3 class="hb-item-genre__p-tip-title">新品のまま売る</h3>
                  <p class="hb-item-genre__p-card-text">
                    パッケージ未開封の商品が一番高く売れます。開封されていてもパーツが未使用であれば査定額アップに繋がります。
                  </p>
                </div>
              </li>
              <li class="hb-item-genre__p-tip-item">
                <figure class="hb-item-genre__p-tip-image">
                  <img src="<?php echo esc_url( get_theme_file_uri( '/images/2.hako.webp' ) ); ?>" alt="" />
                </figure>
                <div class="hb-item-genre__p-tip-body">
                  <span class="hb-item-genre__p-tip-number">2</span>
                  <h3 class="hb-item-genre__p-tip-title">
                    外箱・付属品はすべて揃える
                  </h3>
                  <p class="hb-item-genre__p-card-text">
                    ブリスター・台座・差し替えパーツ・購入特典まで、揃っているほど査定額は上がります。
                  </p>
                </div>
              </li>
              <li class="hb-item-genre__p-tip-item">
                <figure class="hb-item-genre__p-tip-image">
                  <img src="<?php echo esc_url( get_theme_file_uri( '/images/3.hayame.webp' ) ); ?>" alt="" />
                </figure>
                <div class="hb-item-genre__p-tip-body">
                  <span class="hb-item-genre__p-tip-number">3</span>
                  <h3 class="hb-item-genre__p-tip-title">
                    相場が高いうちに早めに売る
                  </h3>
                  <p class="hb-item-genre__p-card-text">
                    市場相場は流行・話題性で大きく変動します。「もう飾らないかも」「入れ替えようかな」と思った時が売り時。LINEで画像を送るだけで事前査定も可能です。
                  </p>
                </div>
              </li>
              <li class="hb-item-genre__p-tip-item">
                <figure class="hb-item-genre__p-tip-image">
                  <img src="<?php echo esc_url( get_theme_file_uri( '/images/4.omatome.webp' ) ); ?>" alt="" />
                </figure>
                <div class="hb-item-genre__p-tip-body">
                  <span class="hb-item-genre__p-tip-number">4</span>
                  <h3 class="hb-item-genre__p-tip-title">
                    まとめ売りで査定額アップ！
                  </h3>
                  <p class="hb-item-genre__p-card-text">
                    2点からでもおまとめアップ査定が適用され、単体で売るよりもお得に売却が可能です。数が増えれば料率もアップします。
                  </p>
                </div>
              </li>
            </ol>
          </div>
        </div>
      </section>

      <div class="hb__l-container">
        <?php get_template_part( 'template-parts/common/parts-cta' ); ?>
      </div>

      <?php
      ob_start();
      get_template_part( 'template-parts/common/purchase-price-table' );
      $genre_purchase_price_markup = trim( ob_get_clean() );
      ?>
      <?php if ( $genre_purchase_price_markup ) : ?>
        <section class="hb__l-section hb-item-genre__p-price" id="price">
          <div class="hb__l-container">
            <div class="hb-item-genre__p-section-head">
              <h2 class="hb-item-genre__p-section-title">買取価格相場</h2>
            </div>
            <?php echo $genre_purchase_price_markup; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
          </div>
        </section>
      <?php endif; ?>

      <?php if ( false ) : // 対応メーカー、シリーズ一覧は非表示。 ?>
      <section class="hb__l-section hb-item-genre__p-maker" id="maker">
        <div class="hb__l-container">
          <div class="hb-item-genre__p-section-head">
            <h2 class="hb-item-genre__p-section-title">
              対応メーカー、シリーズ一覧
            </h2>
          </div>
          <dl class="hb-item-genre__p-maker-list">
            <div class="hb-item-genre__p-maker-row">
              <dt class="hb-item-genre__p-maker-term">主要メーカー</dt>
              <dd class="hb-item-genre__p-maker-rule" aria-hidden="true"></dd>
              <dd class="hb-item-genre__p-maker-tags">
                <span class="hb-item-genre__p-maker-tag">海洋堂</span>
                <span class="hb-item-genre__p-maker-tag">バンダイ</span>
                <span class="hb-item-genre__p-maker-tag"
                  >マックスファクトリー</span
                >
                <span class="hb-item-genre__p-maker-tag">メガハウス</span>
              </dd>
            </div>
            <div class="hb-item-genre__p-maker-row">
              <dt class="hb-item-genre__p-maker-term">バンダイ系シリーズ</dt>
              <dd class="hb-item-genre__p-maker-rule" aria-hidden="true"></dd>
              <dd class="hb-item-genre__p-maker-tags">
                <span class="hb-item-genre__p-maker-tag">S.H.Figuarts</span>
                <span class="hb-item-genre__p-maker-tag">METAL BUILD</span>
                <span class="hb-item-genre__p-maker-tag">ROBOT魂</span>
              </dd>
            </div>
          </dl>
        </div>
      </section>
      <?php endif; ?>

      <?php
      ob_start();
      get_template_part( 'template-parts/common/customer-reviews' );
      $genre_reviews_markup = trim( ob_get_clean() );
      ?>
      <?php if ( '' !== $genre_reviews_markup ) : ?>
        <section class="hb__l-section hb-item-genre__p-reviews" id="reviews">
          <div class="hb__l-container">
            <div class="hb-item-genre__p-section-head">
              <h2 class="hb-item-genre__p-section-title">お客様の声</h2>
            </div>
            <?php echo wp_kses_post( $genre_reviews_markup ); ?>
          </div>
        </section>
      <?php endif; ?>

      <section class="hb__l-section hb-item-genre__p-faq" id="faq">
        <div class="hb__l-container">
          <div class="hb-item-genre__p-section-head">
            <h2 class="hb-item-genre__p-section-title">買取のよくある質問</h2>
          </div>
          <div class="hb-item-genre__p-faq-list" id="genre-faq-list">
            <?php if ( $genre_faq_items ) : ?>
              <?php foreach ( $genre_faq_items as $genre_faq_index => $genre_faq_item ) : ?>
                <article
                  class="hb-item-genre__p-faq-item"
                  <?php if ( $genre_faq_index >= 5 ) : ?>hidden<?php endif; ?>
                >
                  <button
                    class="hb-item-genre__p-faq-question"
                    type="button"
                    aria-expanded="false"
                  >
                    <span class="hb-item-genre__p-faq-icon hb-item-genre__p-faq-icon--q">Q</span>
                    <span><?php echo esc_html( $genre_faq_item['question'] ); ?></span>
                    <span class="hb-item-genre__p-faq-toggle">＋</span>
                  </button>
                  <div class="hb-item-genre__p-faq-answer">
                    <span class="hb-item-genre__p-faq-icon hb-item-genre__p-faq-icon--a">A</span>
                    <p class="hb-item-genre__p-card-text">
                      <?php echo wp_kses_post( nl2br( esc_html( $genre_faq_item['answer'] ) ) ); ?>
                    </p>
                    <?php get_template_part( 'template-parts/common/parts-cta' ); ?>
                  </div>
                </article>
              <?php endforeach; ?>
            <?php else : ?>
              <p class="hb-item-genre__p-card-text">よくある質問がありません</p>
            <?php endif; ?>
          </div>
          <?php if ( count( $genre_faq_items ) > 5 ) : ?>
            <div class="hb-item-genre__p-faq-more">
              <button
                class="hb__c-btn hb__c-btn--ghost"
                type="button"
                data-hb-genre-faq-more
                aria-controls="genre-faq-list"
                aria-expanded="false"
              >
                もっと見る
              </button>
            </div>
          <?php endif; ?>
        </div>
      </section>
    </main>

    <?php get_template_part( 'template-parts/common/footer-cta' ); ?>
    <?php get_footer(); ?>
