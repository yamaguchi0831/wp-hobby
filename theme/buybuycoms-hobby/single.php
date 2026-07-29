<?php
/**
 * Static first-stage template generated from pages/single-info.html.
 *
 * @package BuyBuyComs_Hobby
 */
?>
<?php get_header(); ?>

    <main id="main-content">
      <section class="hb__p-subpage-title" aria-label="お知らせ詳細">
        <div class="hb__l-container hb__p-subpage-title__inner">
          <h1 class="hb__p-subpage-title__heading">お知らせ</h1>
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
            <li class="hb__p-subpage-title__breadcrumb-item">
              <a
                class="hb__p-subpage-title__breadcrumb-link"
                href="<?php echo esc_url( home_url( '/info/' ) ); ?>"
                >お知らせ一覧</a
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
              宅配買取の梱包キット受付をリニューアルしました
            </li>
          </ol>
        </nav>
      </div>

      <section class="hb__l-section hb__l-section--pt-sm" aria-label="お知らせ本文">
        <article class="hb__l-container hb-single-info__p-article">
          <div class="hb-single-info__p-meta">
            <time class="hb-single-info__p-date" datetime="2026-06-18"
              >2026.06.18</time
            >
            <span class="hb-single-info__p-category">お知らせ</span>
            <span class="hb-single-info__p-category">買取情報</span>
          </div>

          <h1 class="hb-single-info__p-title">
            宅配買取の梱包キット受付をリニューアルしました
          </h1>

          <figure class="hb-single-info__p-hero">
            <img
              src="https://placehold.co/960x540/eef3ee/33423a?text=Information"
              alt="お知らせのメイン画像"
              width="960"
              height="540"
            />
          </figure>

          <div class="hb-single-info__p-body">
            <p>
              いつもバイバイコムズ ホビー買取をご利用いただきありがとうございます。宅配買取をよりスムーズにご利用いただけるよう、梱包キット受付の導線をリニューアルしました。
            </p>
            <p>
              お申し込み時に、売りたいお品物の量やサイズに合わせて必要な箱数を選びやすくしています。ガンプラ、フィギュア、鉄道模型、レトロゲームなど、まとめて送りたいコレクションにも対応しやすい内容です。
            </p>

            <h2>変更内容</h2>
            <p>
              申込フォーム内の項目を整理し、初めての方でも迷わず入力できるようにしました。査定料・送料・返送料はこれまで通り無料です。
            </p>
            <p>
              今後も、安心してコレクション整理をご相談いただけるよう、サービス改善を続けてまいります。
            </p>
          </div>

          <div class="hb-single-info__p-back">
            <a class="hb-single-info__p-back-link" href="<?php echo esc_url( home_url( '/info/' ) ); ?>">
              お知らせ一覧に戻る
            </a>
          </div>
        </article>
      </section>

      <?php get_template_part( 'template-parts/common/footer-cta' ); ?>
    </main>

    <?php get_footer(); ?>
