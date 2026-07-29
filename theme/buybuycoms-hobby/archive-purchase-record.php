<?php
/**
 * Static first-stage template generated from pages/archive-purchase-record.html.
 *
 * @package BuyBuyComs_Hobby
 */
?>
<?php get_header(); ?>

    <main id="main-content">
      <section class="hb__p-subpage-title" aria-label="買取実績">
        <div class="hb__l-container hb__p-subpage-title__inner">
          <h1 class="hb__p-subpage-title__heading">買取実績</h1>
        </div>
      </section>

      <div class="hb__l-container">
        <nav
          class="hb__p-subpage-title__breadcrumb-area"
          aria-label="パンくずリスト"
        >
          <ol class="hb__l-container hb__p-subpage-title__breadcrumb">
            <li class="hb__p-subpage-title__breadcrumb-item">
              <a
                class="hb__p-subpage-title__breadcrumb-link"
                href="<?php echo esc_url( home_url( '/' ) ); ?>"
                >TOP</a
              >
            </li>
            <li
              class="hb__p-subpage-title__breadcrumb-separator"
              aria-hidden="true"
            >
              &gt;
            </li>
            <li
              class="hb__p-subpage-title__breadcrumb-current"
              aria-current="page"
            >
              買取実績
            </li>
          </ol>
        </nav>
      </div>

      <section class="hb__l-section" id="cases">
        <div class="hb__l-container">
          <header
            class="hb-archive-purchase-record__c-section-head hb-archive-purchase-record__c-section-head--center"
          >
            <span class="hb-archive-purchase-record__c-section-head__kicker"
              >Cases</span
            >
            <h2 class="hb-archive-purchase-record__c-section-head__title">
              最近の
              <span class="hb-archive-purchase-record__c-hl">買取実績</span>
            </h2>
            <p class="hb-archive-purchase-record__c-section-head__lead">
              フィギュア・プラモデル・カードなど、実際にお売りいただいたホビーの一例です。
            </p>
          </header>
          <ul class="hb-archive-purchase-record__p-case-filter" role="list">
            <li>
              <a
                class="hb-archive-purchase-record__p-case-filter-link hb__is-active"
                href="<?php echo esc_url( home_url( '/purchase-record/' ) ); ?>"
                aria-current="page"
                >TOP</a
              >
            </li>
            <li>
              <a class="hb-archive-purchase-record__p-case-filter-link" href="<?php echo esc_url( home_url( '/purchase-record/' ) ); ?>"
                >機動戦士ガンダム</a
              >
            </li>
            <li>
              <a class="hb-archive-purchase-record__p-case-filter-link" href="<?php echo esc_url( home_url( '/purchase-record/' ) ); ?>"
                >超合金/メタルビルド</a
              >
            </li>
            <li>
              <a class="hb-archive-purchase-record__p-case-filter-link" href="<?php echo esc_url( home_url( '/purchase-record/' ) ); ?>"
                >LEGO</a
              >
            </li>
            <li>
              <a class="hb-archive-purchase-record__p-case-filter-link" href="<?php echo esc_url( home_url( '/purchase-record/' ) ); ?>"
                >プラモデル</a
              >
            </li>
            <li>
              <a class="hb-archive-purchase-record__p-case-filter-link" href="<?php echo esc_url( home_url( '/purchase-record/' ) ); ?>"
                >鉄道模型</a
              >
            </li>
            <li>
              <a class="hb-archive-purchase-record__p-case-filter-link" href="<?php echo esc_url( home_url( '/purchase-record/' ) ); ?>"
                >ソフビ</a
              >
            </li>
            <li>
              <a class="hb-archive-purchase-record__p-case-filter-link" href="<?php echo esc_url( home_url( '/purchase-record/' ) ); ?>"
                >特撮グッズ</a
              >
            </li>
            <li>
              <a class="hb-archive-purchase-record__p-case-filter-link" href="<?php echo esc_url( home_url( '/purchase-record/' ) ); ?>"
                >レトロゲーム</a
              >
            </li>
            <li>
              <a class="hb-archive-purchase-record__p-case-filter-link" href="<?php echo esc_url( home_url( '/purchase-record/' ) ); ?>"
                >レトロ玩具/昭和玩具</a
              >
            </li>
            <li>
              <a class="hb-archive-purchase-record__p-case-filter-link" href="<?php echo esc_url( home_url( '/purchase-record/' ) ); ?>"
                >ミニカー</a
              >
            </li>
            <li>
              <a class="hb-archive-purchase-record__p-case-filter-link" href="<?php echo esc_url( home_url( '/purchase-record/' ) ); ?>"
                >フィギュア</a
              >
            </li>
            <li>
              <a class="hb-archive-purchase-record__p-case-filter-link" href="<?php echo esc_url( home_url( '/purchase-record/' ) ); ?>"
                >無線機</a
              >
            </li>
            <li>
              <a class="hb-archive-purchase-record__p-case-filter-link" href="<?php echo esc_url( home_url( '/purchase-record/' ) ); ?>"
                >ディズニー</a
              >
            </li>
            <li>
              <a class="hb-archive-purchase-record__p-case-filter-link" href="<?php echo esc_url( home_url( '/purchase-record/' ) ); ?>"
                >アメトイ</a
              >
            </li>
          </ul>
          <?php get_template_part( 'template-parts/common/purchase-cases' ); ?>
          <div class="hb-archive-purchase-record__p-case-more">
            <a class="hb-archive-purchase-record__p-case-more-link" href="<?php echo esc_url( home_url( '/purchase-record/' ) ); ?>"
              >もっと見る</a
            >
          </div>
        </div>
      </section>

      <div class="hb__l-container hb-archive-purchase-record__p-cta">
        <?php get_template_part( 'template-parts/common/parts-cta' ); ?>
      </div>

      <section class="hb__l-section hb__l-section--soft" id="genres">
        <div class="hb__l-container">
          <header
            class="hb-archive-purchase-record__c-section-head hb-archive-purchase-record__c-section-head--center"
          >
            <span class="hb-archive-purchase-record__c-section-head__kicker"
              >Genres</span
            >
            <h2 class="hb-archive-purchase-record__c-section-head__title">
              幅広い
              <span class="hb-archive-purchase-record__c-hl">買取品目</span>
            </h2>
            <p class="hb-archive-purchase-record__c-section-head__lead">
              定番ジャンルからコレクター向けアイテムまで、まとめて査定できます。
            </p>
          </header>
          <?php get_template_part( 'template-parts/common/genre-table' ); ?>
        </div>
      </section>

      <section class="hb__l-section" id="methods">
        <div class="hb__l-container">
          <header
            class="hb-archive-purchase-record__c-section-head hb-archive-purchase-record__c-section-head--center"
          >
            <span class="hb-archive-purchase-record__c-section-head__kicker"
              >Methods</span
            >
            <h2 class="hb-archive-purchase-record__c-section-head__title">
              あなたに合わせて選べる、<br />
              <span class="hb-archive-purchase-record__c-hl"
                >3つの買取方法</span
              >
            </h2>
            <p class="hb-archive-purchase-record__c-section-head__lead">
              量やお住まいの地域、ご希望の進め方に合わせて選べます。
            </p>
          </header>
          <?php get_template_part( 'template-parts/common/purchase-methods' ); ?>
        </div>
      </section>

      <div class="hb__l-container hb-archive-purchase-record__p-cta">
        <?php get_template_part( 'template-parts/common/parts-cta' ); ?>
      </div>

      <section class="hb__l-section hb__l-section--soft" id="reviews">
        <div class="hb__l-container">
          <header
            class="hb-archive-purchase-record__c-section-head hb-archive-purchase-record__c-section-head--center"
          >
            <span class="hb-archive-purchase-record__c-section-head__kicker"
              >Reviews</span
            >
            <h2 class="hb-archive-purchase-record__c-section-head__title">
              お客様の
              <span class="hb-archive-purchase-record__c-hl">声</span>
            </h2>
            <p class="hb-archive-purchase-record__c-section-head__lead">
              実際にご利用いただいたお客様からのレビューです。
            </p>
          </header>
          <?php get_template_part( 'template-parts/common/customer-reviews' ); ?>
        </div>
      </section>

      <section class="hb__l-section" id="faq">
        <div class="hb__l-container">
          <header
            class="hb-archive-purchase-record__c-section-head hb-archive-purchase-record__c-section-head--center"
          >
            <span class="hb-archive-purchase-record__c-section-head__kicker"
              >FAQ</span
            >
            <h2 class="hb-archive-purchase-record__c-section-head__title">
              よくある
              <span class="hb-archive-purchase-record__c-hl">質問</span>
            </h2>
          </header>

          <div class="hb-archive-purchase-record__p-faq-list">
            <article class="hb-archive-purchase-record__p-faq-item">
              <button
                class="hb-archive-purchase-record__p-faq-question"
                type="button"
                aria-expanded="false"
                data-hb-faq-question
              >
                <span
                  class="hb-archive-purchase-record__p-faq-icon hb-archive-purchase-record__p-faq-icon--q"
                  >Q</span
                >
                <span>送料・査定料・返送料は本当に無料ですか？</span>
                <span class="hb-archive-purchase-record__p-faq-toggle">＋</span>
              </button>
              <div class="hb-archive-purchase-record__p-faq-answer">
                <span
                  class="hb-archive-purchase-record__p-faq-icon hb-archive-purchase-record__p-faq-icon--a"
                  >A</span
                >
                <p class="hb-archive-purchase-record__p-faq-text">
                  はい、すべて無料です。査定金額にご納得いただけず返送される場合も、返送料は当社負担です。
                  「とりあえず査定だけ」というご相談も大歓迎ですので、お気軽にお申込みください。
                </p>
                <?php get_template_part( 'template-parts/common/parts-cta' ); ?>
              </div>
            </article>

            <article class="hb-archive-purchase-record__p-faq-item">
              <button
                class="hb-archive-purchase-record__p-faq-question"
                type="button"
                aria-expanded="false"
                data-hb-faq-question
              >
                <span
                  class="hb-archive-purchase-record__p-faq-icon hb-archive-purchase-record__p-faq-icon--q"
                  >Q</span
                >
                <span>箱なし・付属品なしでも買取してもらえますか？</span>
                <span class="hb-archive-purchase-record__p-faq-toggle">＋</span>
              </button>
              <div class="hb-archive-purchase-record__p-faq-answer">
                <span
                  class="hb-archive-purchase-record__p-faq-icon hb-archive-purchase-record__p-faq-icon--a"
                  >A</span
                >
                <p class="hb-archive-purchase-record__p-faq-text">
                  買取可能です。ただし、箱・説明書・付属品が揃っているほうが査定金額は高くなる傾向にあります。
                  状態に不安がある場合も、ひとまず査定にお出しください。1点ずつ丁寧に査定いたします。
                </p>
                <?php get_template_part( 'template-parts/common/parts-cta' ); ?>
              </div>
            </article>

            <article class="hb-archive-purchase-record__p-faq-item">
              <button
                class="hb-archive-purchase-record__p-faq-question"
                type="button"
                aria-expanded="false"
                data-hb-faq-question
              >
                <span
                  class="hb-archive-purchase-record__p-faq-icon hb-archive-purchase-record__p-faq-icon--q"
                  >Q</span
                >
                <span>何点から買取してもらえますか？</span>
                <span class="hb-archive-purchase-record__p-faq-toggle">＋</span>
              </button>
              <div class="hb-archive-purchase-record__p-faq-answer">
                <span
                  class="hb-archive-purchase-record__p-faq-icon hb-archive-purchase-record__p-faq-icon--a"
                  >A</span
                >
                <p class="hb-archive-purchase-record__p-faq-text">
                  1点からお預かりいたします。逆に、段ボール30箱以上の大量買取にも対応可能ですので、
                  量を気にせずまとめてお送りください。
                </p>
                <?php get_template_part( 'template-parts/common/parts-cta' ); ?>
              </div>
            </article>

            <article class="hb-archive-purchase-record__p-faq-item">
              <button
                class="hb-archive-purchase-record__p-faq-question"
                type="button"
                aria-expanded="false"
                data-hb-faq-question
              >
                <span
                  class="hb-archive-purchase-record__p-faq-icon hb-archive-purchase-record__p-faq-icon--q"
                  >Q</span
                >
                <span>入金までどのくらいかかりますか？</span>
                <span class="hb-archive-purchase-record__p-faq-toggle">＋</span>
              </button>
              <div class="hb-archive-purchase-record__p-faq-answer">
                <span
                  class="hb-archive-purchase-record__p-faq-icon hb-archive-purchase-record__p-faq-icon--a"
                  >A</span
                >
                <p class="hb-archive-purchase-record__p-faq-text">
                  商品到着から最短当日に査定、ご承諾いただいたあと最短1営業日でお振込みします。
                  点数が多い場合は2〜3営業日いただくことがあります。
                </p>
                <?php get_template_part( 'template-parts/common/parts-cta' ); ?>
              </div>
            </article>

            <article class="hb-archive-purchase-record__p-faq-item">
              <button
                class="hb-archive-purchase-record__p-faq-question"
                type="button"
                aria-expanded="false"
                data-hb-faq-question
              >
                <span
                  class="hb-archive-purchase-record__p-faq-icon hb-archive-purchase-record__p-faq-icon--q"
                  >Q</span
                >
                <span>査定金額に納得できない場合はどうなりますか？</span>
                <span class="hb-archive-purchase-record__p-faq-toggle">＋</span>
              </button>
              <div class="hb-archive-purchase-record__p-faq-answer">
                <span
                  class="hb-archive-purchase-record__p-faq-icon hb-archive-purchase-record__p-faq-icon--a"
                  >A</span
                >
                <p class="hb-archive-purchase-record__p-faq-text">
                  キャンセル可能です。当社負担で全品を元の状態でご返送いたします。
                  キャンセル料・返送料はかかりません。
                </p>
                <?php get_template_part( 'template-parts/common/parts-cta' ); ?>
              </div>
            </article>

            <article class="hb-archive-purchase-record__p-faq-item">
              <button
                class="hb-archive-purchase-record__p-faq-question"
                type="button"
                aria-expanded="false"
                data-hb-faq-question
              >
                <span
                  class="hb-archive-purchase-record__p-faq-icon hb-archive-purchase-record__p-faq-icon--q"
                  >Q</span
                >
                <span>個人情報はどのように管理されていますか？</span>
                <span class="hb-archive-purchase-record__p-faq-toggle">＋</span>
              </button>
              <div class="hb-archive-purchase-record__p-faq-answer">
                <span
                  class="hb-archive-purchase-record__p-faq-icon hb-archive-purchase-record__p-faq-icon--a"
                  >A</span
                >
                <p class="hb-archive-purchase-record__p-faq-text">
                  SSL通信による暗号化、および古物営業法に基づく管理を徹底しています。
                  お客様情報を第三者に開示・販売することは一切ありません。
                </p>
                <?php get_template_part( 'template-parts/common/parts-cta' ); ?>
              </div>
            </article>
          </div>
        </div>
      </section>

      <div class="hb__l-container hb-archive-purchase-record__p-cta">
        <?php get_template_part( 'template-parts/common/parts-cta' ); ?>
      </div>
    </main>

    <?php get_footer(); ?>
