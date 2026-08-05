<?php
/**
 * Static first-stage template generated from pages/page-flow.html.
 *
 * @package BuyBuyComs_Hobby
 */
/*
Template Name: Purchase Flow
*/
?>
<?php get_header(); ?>

    <main id="main-content">
      <section class="hb__p-subpage-title" aria-label="買取方法">
        <div class="hb__l-container hb__p-subpage-title__inner">
          <h1 class="hb__p-subpage-title__heading">買取方法</h1>
        </div>
      </section>
      <div class="hb__l-container">
      <?php buybuycoms_hobby_breadcrumb(); ?>
      </div>

      <section class="hb__l-section hb-flow__p-lead">
        <div class="hb__l-container--sm hb-flow__p-lead__inner">
          <figure class="hb-flow__p-lead__image">
            <img
              src="<?php echo esc_url( get_theme_file_uri( '/images/flow-hobby-collection.webp' ) ); ?>"
              alt="ロボットや鉄道模型、カードなどを箱にまとめたホビー用品とスタッフ"
              width="800"
              height="600"
              loading="eager"
              decoding="async"
            />
          </figure>
          <div class="hb-flow__p-lead__body">
            <p class="hb-flow__p-lead__text">
              売買コムズでは、ホビーの量やお住まいの地域、ご希望の進め方に合わせて、
              宅配買取・出張買取・店頭買取の3つの方法からお選びいただけます。
            </p>
            <ul class="hb-flow__p-lead__quotes">
              <li>「大量にあるけど運べない」</li>
              <li>「箱に詰めてまとめて送りたい」</li>
              <li>「近くなので直接持ち込みたい」</li>
            </ul>
            <p class="hb-flow__p-lead__text">
              そんな状況に合わせて、無理なくご利用いただける買取方法をご案内します。
            </p>
          </div>
        </div>
      </section>

      <section class="hb__l-section hb__p-method" id="method">
        <div class="hb__l-container">
          <div class="hb-flow__p-section-head">
            <h2 class="hb-flow__p-section-head__title">3つの買取方法</h2>
            <p class="hb-flow__p-section-head__lead">
              量・距離・進め方に合わせて、使いやすい方法を選べます。
            </p>
          </div>
          <?php get_template_part( 'template-parts/common/purchase-methods' ); ?>
        </div>
      </section>

      <section class="hb__l-section hb__p-flows" id="flows">
        <div class="hb__l-container hb__p-flow">
          <header class="hb__c-section-head hb__c-section-head--center">
            <span class="hb__c-section-head__kicker">How it works</span>
            <h2 class="hb__c-section-head__title">
              買取の <span class="hb__c-hl">流れ</span>
            </h2>
            <p class="hb__c-section-head__lead">
              量・距離・進め方に合わせて選べる3つの方法を、タブで確認できます。
            </p>
          </header>

          <?php get_template_part( 'template-parts/common/flow-tab' ); ?>
        </div>
      </section>
      <!-- ============================== 最近の買取実績 ============================== -->
      <section class="hb__l-section" id="cases">
        <div class="hb__l-container">
          <header class="hb__c-section-head hb__c-section-head--center">
            <span class="hb__c-section-head__kicker">Cases</span>
            <h2 class="hb__c-section-head__title">
              最近の <span class="hb__c-hl">買取実績</span>
            </h2>
            <p class="hb__c-section-head__lead">
              どんなコレクションが、どんな金額になったのか。実例をご紹介します。
            </p>
          </header>

          <?php get_template_part( 'template-parts/common/purchase-records' ); ?>

          <div class="hb__c-section-more">
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="hb__c-btn hb__c-btn--ghost"
              >買取実績をもっと見る →</a
            >
          </div>
        </div>
      </section>

      <!-- ============================== 買取価格の目安 ============================== -->
      <section class="hb__l-section hb__l-section--soft" id="prices">
        <div class="hb__l-container--sm">
          <header class="hb__c-section-head hb__c-section-head--center">
            <span class="hb__c-section-head__kicker">Top prices</span>
            <h2 class="hb__c-section-head__title">
              買取価格の <span class="hb__c-hl">目安</span>
            </h2>
            <p class="hb__c-section-head__lead">
              代表的な高価買取アイテムの相場をご紹介します。
            </p>
          </header>

          <?php get_template_part( 'template-parts/common/purchase-price-table' ); ?>
        </div>
      </section>

      <!-- ============================== お客様の声 ============================== -->
      <?php
      ob_start();
      get_template_part( 'template-parts/common/customer-reviews' );
      $flow_reviews_markup = trim( ob_get_clean() );
      ?>
      <?php if ( '' !== $flow_reviews_markup ) : ?>
        <section class="hb__l-section" id="reviews">
          <div class="hb__l-container">
            <header class="hb__c-section-head hb__c-section-head--center">
              <span class="hb__c-section-head__kicker">Reviews</span>
              <h2 class="hb__c-section-head__title">
                お客様の <span class="hb__c-hl">声</span>
              </h2>
              <p class="hb__c-section-head__lead">
                実際にご利用いただいたお客様からのレビューです。
              </p>
            </header>

            <?php echo wp_kses_post( $flow_reviews_markup ); ?>
          </div>
        </section>
      <?php endif; ?>

      <!-- ============================== よくある質問 ============================== -->
      <section class="hb__l-section hb__l-section--soft" id="faq">
        <div class="hb__l-container--sm">
          <header class="hb__c-section-head hb__c-section-head--center">
            <span class="hb__c-section-head__kicker">FAQ</span>
            <h2 class="hb__c-section-head__title">
              よくある <span class="hb__c-hl">質問</span>
            </h2>
          </header>

          <div class="hb-faq__p-faq-list">
            <article class="hb-faq__p-faq-item">
              <button
                class="hb-faq__p-faq-question"
                type="button"
                aria-expanded="false"
              >
                <span class="hb-faq__p-faq-icon hb-faq__p-faq-icon--q">Q</span>
                <span>送料・査定料・返送料は本当に無料ですか？</span>
                <span class="hb-faq__p-faq-toggle">＋</span>
              </button>
              <div class="hb-faq__p-faq-answer">
                <span class="hb-faq__p-faq-icon hb-faq__p-faq-icon--a">A</span>
                <div class="hb-faq__p-faq-answer-body">
                  <p class="hb-faq__p-faq-text">
                    はい、すべて無料です。査定金額にご納得いただけず返送される場合も、返送料は当社負担です。
                    「とりあえず査定だけ」というご相談も大歓迎ですので、お気軽にお申込みください。
                  </p>
                </div>
                <?php get_template_part( 'template-parts/common/parts-cta' ); ?>
              </div>
            </article>

            <article class="hb-faq__p-faq-item">
              <button
                class="hb-faq__p-faq-question"
                type="button"
                aria-expanded="false"
              >
                <span class="hb-faq__p-faq-icon hb-faq__p-faq-icon--q">Q</span>
                <span>箱なし・付属品なしでも買取してもらえますか？</span>
                <span class="hb-faq__p-faq-toggle">＋</span>
              </button>
              <div class="hb-faq__p-faq-answer">
                <span class="hb-faq__p-faq-icon hb-faq__p-faq-icon--a">A</span>
                <div class="hb-faq__p-faq-answer-body">
                  <p class="hb-faq__p-faq-text">
                    買取可能です。ただし、箱・説明書・付属品が揃っているほうが査定金額は高くなる傾向にあります。
                    状態に不安がある場合も、ひとまず査定にお出しください。1点ずつ丁寧に査定いたします。
                  </p>
                </div>
                <?php get_template_part( 'template-parts/common/parts-cta' ); ?>
              </div>
            </article>

            <article class="hb-faq__p-faq-item">
              <button
                class="hb-faq__p-faq-question"
                type="button"
                aria-expanded="false"
              >
                <span class="hb-faq__p-faq-icon hb-faq__p-faq-icon--q">Q</span>
                <span>何点から買取してもらえますか？</span>
                <span class="hb-faq__p-faq-toggle">＋</span>
              </button>
              <div class="hb-faq__p-faq-answer">
                <span class="hb-faq__p-faq-icon hb-faq__p-faq-icon--a">A</span>
                <div class="hb-faq__p-faq-answer-body">
                  <p class="hb-faq__p-faq-text">
                    1点からお預かりいたします。逆に、段ボール30箱以上の大量買取にも対応可能ですので、
                    量を気にせずまとめてお送りください。
                  </p>
                </div>
                <?php get_template_part( 'template-parts/common/parts-cta' ); ?>
              </div>
            </article>

            <article class="hb-faq__p-faq-item">
              <button
                class="hb-faq__p-faq-question"
                type="button"
                aria-expanded="false"
              >
                <span class="hb-faq__p-faq-icon hb-faq__p-faq-icon--q">Q</span>
                <span>入金までどのくらいかかりますか？</span>
                <span class="hb-faq__p-faq-toggle">＋</span>
              </button>
              <div class="hb-faq__p-faq-answer">
                <span class="hb-faq__p-faq-icon hb-faq__p-faq-icon--a">A</span>
                <div class="hb-faq__p-faq-answer-body">
                  <p class="hb-faq__p-faq-text">
                    商品到着から最短当日に査定、ご承諾いただいたあと最短1営業日でお振込みします。
                    点数が多い場合は2〜3営業日いただくことがあります。
                  </p>
                </div>
                <?php get_template_part( 'template-parts/common/parts-cta' ); ?>
              </div>
            </article>

            <article class="hb-faq__p-faq-item">
              <button
                class="hb-faq__p-faq-question"
                type="button"
                aria-expanded="false"
              >
                <span class="hb-faq__p-faq-icon hb-faq__p-faq-icon--q">Q</span>
                <span>査定金額に納得できない場合はどうなりますか？</span>
                <span class="hb-faq__p-faq-toggle">＋</span>
              </button>
              <div class="hb-faq__p-faq-answer">
                <span class="hb-faq__p-faq-icon hb-faq__p-faq-icon--a">A</span>
                <div class="hb-faq__p-faq-answer-body">
                  <p class="hb-faq__p-faq-text">
                    キャンセル可能です。当社負担で全品を元の状態でご返送いたします。
                    キャンセル料・返送料はかかりません。
                  </p>
                </div>
                <?php get_template_part( 'template-parts/common/parts-cta' ); ?>
              </div>
            </article>

            <article class="hb-faq__p-faq-item">
              <button
                class="hb-faq__p-faq-question"
                type="button"
                aria-expanded="false"
              >
                <span class="hb-faq__p-faq-icon hb-faq__p-faq-icon--q">Q</span>
                <span>個人情報はどのように管理されていますか？</span>
                <span class="hb-faq__p-faq-toggle">＋</span>
              </button>
              <div class="hb-faq__p-faq-answer">
                <span class="hb-faq__p-faq-icon hb-faq__p-faq-icon--a">A</span>
                <div class="hb-faq__p-faq-answer-body">
                  <p class="hb-faq__p-faq-text">
                    SSL通信による暗号化、および古物営業法に基づく管理を徹底しています。
                    お客様情報を第三者に開示・販売することは一切ありません。
                  </p>
                </div>
                <?php get_template_part( 'template-parts/common/parts-cta' ); ?>
              </div>
            </article>
          </div>
        </div>
      </section>
    </main>

    <?php get_template_part( 'template-parts/common/footer-cta' ); ?>
    <?php get_footer(); ?>
