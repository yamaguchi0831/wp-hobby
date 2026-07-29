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
              買取方法
            </li>
          </ol>
        </nav>
      </div>

      <section class="hb__l-section hb-flow__p-lead">
        <div class="hb__l-container--sm hb-flow__p-lead__inner">
          <figure class="hb-flow__p-lead__image">
            <img
              src="https://placehold.co/800x600/eef3ee/5f6f66?text=Flow+Image"
              alt="箱に入ったホビー品のイメージ"
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

          <?php get_template_part( 'template-parts/common/purchase-cases' ); ?>

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

          <div class="hb-flow__p-prices-ui">
            <div class="hb-flow__p-prices-table">
              <div class="hb-flow__p-price-group">
                <div class="hb-flow__p-price-group-head">フィギュア</div>
                <ul class="hb-flow__p-price-group-list" role="list">
                  <li class="hb-flow__p-price-group-item">
                    <span class="hb-flow__p-price-group-name">
                      グッドスマイルカンパニー / FREEing スケールフィギュア
                    </span>
                    <span
                      class="hb-flow__p-price-group-tag hb-flow__p-price-group-tag--hot"
                    >
                      買取強化中
                    </span>
                    <span class="hb-flow__p-price-group-price">
                      ¥ 8,000 〜 60,000
                    </span>
                  </li>
                  <li class="hb-flow__p-price-group-item">
                    <span class="hb-flow__p-price-group-name">
                      アルター スケールフィギュア
                    </span>
                    <span class="hb-flow__p-price-group-tag"></span>
                    <span class="hb-flow__p-price-group-price">
                      ¥ 5,000 〜 45,000
                    </span>
                  </li>
                  <li class="hb-flow__p-price-group-item">
                    <span class="hb-flow__p-price-group-name">
                      ねんどろいど・figma（廃盤・限定）
                    </span>
                    <span
                      class="hb-flow__p-price-group-tag hb-flow__p-price-group-tag--hot"
                    >
                      買取強化中
                    </span>
                    <span class="hb-flow__p-price-group-price">
                      ¥ 3,000 〜 28,000
                    </span>
                  </li>
                </ul>
                <div class="hb-flow__p-price-group-more">
                  <a class="hb-flow__p-price-group-button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
                    フィギュアをもっと見る
                  </a>
                </div>
              </div>

              <div class="hb-flow__p-price-group">
                <div class="hb-flow__p-price-group-head">プラモデル</div>
                <ul class="hb-flow__p-price-group-list" role="list">
                  <li class="hb-flow__p-price-group-item">
                    <span class="hb-flow__p-price-group-name">
                      PG / RG / MG ガンプラ（未組立）
                    </span>
                    <span
                      class="hb-flow__p-price-group-tag hb-flow__p-price-group-tag--hot"
                    >
                      買取強化中
                    </span>
                    <span class="hb-flow__p-price-group-price">
                      ¥ 1,500 〜 80,000
                    </span>
                  </li>
                  <li class="hb-flow__p-price-group-item">
                    <span class="hb-flow__p-price-group-name">
                      METAL BUILD / METAL ROBOT魂
                    </span>
                    <span class="hb-flow__p-price-group-tag"></span>
                    <span class="hb-flow__p-price-group-price">
                      ¥ 8,000 〜 65,000
                    </span>
                  </li>
                  <li class="hb-flow__p-price-group-item">
                    <span class="hb-flow__p-price-group-name">
                      タミヤ・ハセガワ スケールキット（絶版）
                    </span>
                    <span class="hb-flow__p-price-group-tag"></span>
                    <span class="hb-flow__p-price-group-price">
                      ¥ 3,000 〜 35,000
                    </span>
                  </li>
                </ul>
                <div class="hb-flow__p-price-group-more">
                  <a class="hb-flow__p-price-group-button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
                    プラモデルをもっと見る
                  </a>
                </div>
              </div>

              <div class="hb-flow__p-price-group">
                <div class="hb-flow__p-price-group-head">
                  トレーディングカード
                </div>
                <ul class="hb-flow__p-price-group-list" role="list">
                  <li class="hb-flow__p-price-group-item">
                    <span class="hb-flow__p-price-group-name">
                      ポケモンカード（PSA鑑定品・初版）
                    </span>
                    <span
                      class="hb-flow__p-price-group-tag hb-flow__p-price-group-tag--hot"
                    >
                      買取強化中
                    </span>
                    <span class="hb-flow__p-price-group-price">
                      ¥ 5,000 〜 1,200,000
                    </span>
                  </li>
                  <li class="hb-flow__p-price-group-item">
                    <span class="hb-flow__p-price-group-name">
                      遊戯王（初期・絶版レア）
                    </span>
                    <span
                      class="hb-flow__p-price-group-tag hb-flow__p-price-group-tag--hot"
                    >
                      買取強化中
                    </span>
                    <span class="hb-flow__p-price-group-price">
                      ¥ 3,000 〜 800,000
                    </span>
                  </li>
                  <li class="hb-flow__p-price-group-item">
                    <span class="hb-flow__p-price-group-name">
                      MTG（Reserved List・旧枠）
                    </span>
                    <span class="hb-flow__p-price-group-tag"></span>
                    <span class="hb-flow__p-price-group-price">
                      ¥ 2,000 〜 500,000
                    </span>
                  </li>
                </ul>
                <div class="hb-flow__p-price-group-more">
                  <a class="hb-flow__p-price-group-button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
                    トレーディングカードをもっと見る
                  </a>
                </div>
              </div>

              <div class="hb-flow__p-price-group">
                <div class="hb-flow__p-price-group-head">
                  レトロゲーム・ゲーム機
                </div>
                <ul class="hb-flow__p-price-group-list" role="list">
                  <li class="hb-flow__p-price-group-item">
                    <span class="hb-flow__p-price-group-name">
                      ファミコン・スーパーファミコン ソフト
                    </span>
                    <span class="hb-flow__p-price-group-tag"></span>
                    <span class="hb-flow__p-price-group-price">
                      ¥ 500 〜 80,000
                    </span>
                  </li>
                  <li class="hb-flow__p-price-group-item">
                    <span class="hb-flow__p-price-group-name">
                      NEOGEO ROMカートリッジ
                    </span>
                    <span
                      class="hb-flow__p-price-group-tag hb-flow__p-price-group-tag--hot"
                    >
                      買取強化中
                    </span>
                    <span class="hb-flow__p-price-group-price">
                      ¥ 5,000 〜 250,000
                    </span>
                  </li>
                  <li class="hb-flow__p-price-group-item">
                    <span class="hb-flow__p-price-group-name">
                      PCエンジン / メガドライブ 周辺機器
                    </span>
                    <span class="hb-flow__p-price-group-tag"></span>
                    <span class="hb-flow__p-price-group-price">
                      ¥ 1,000 〜 45,000
                    </span>
                  </li>
                </ul>
                <div class="hb-flow__p-price-group-more">
                  <a class="hb-flow__p-price-group-button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
                    レトロゲーム・ゲーム機をもっと見る
                  </a>
                </div>
              </div>
            </div>
            <p class="hb-flow__p-prices-note">
              <img
                src="https://placehold.co/16x16/f6faf6/5f6f66?text=i"
                alt=""
                width="16"
                height="16"
              />
              表示価格は2026年5月時点の参考価格です。商品の状態・付属品・市場相場により変動します。
            </p>
          </div>
        </div>
      </section>

      <!-- ============================== お客様の声 ============================== -->
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

          <?php get_template_part( 'template-parts/common/customer-reviews' ); ?>
        </div>
      </section>

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
