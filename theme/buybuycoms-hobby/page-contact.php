<?php
/**
 * Static first-stage template generated from pages/page-contact.html.
 *
 * @package BuyBuyComs_Hobby
 */
/*
Template Name: Contact
*/

$requested_purchase_type = filter_input( INPUT_GET, 'type', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
$requested_purchase_type = in_array( $requested_purchase_type, array( 'takuhai', 'shuccho', 'mochikomi' ), true ) ? $requested_purchase_type : '';
?>
<!-- ============================== HEADER ============================== -->
    <?php get_header(); ?>

    <main id="main-content">
      <section class="hb__p-subpage-title" aria-label="買取お申し込みフォーム">
        <div class="hb__l-container hb__p-subpage-title__inner">
          <h1 class="hb__p-subpage-title__heading">買取お申し込みフォーム</h1>
        </div>
      </section>
      <div class="hb__l-container">
      <?php buybuycoms_hobby_breadcrumb(); ?>
      </div>

      <section class="hb__l-section hb__p-form-shell" id="purchase-form">
        <div class="hb__l-container">
          <form
            class="hb__p-form"
            id="hb-purchase-form"
            action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>"
            method="post"
            novalidate
          >
            <input type="hidden" name="action" value="buybuycoms_hobby_contact" />
            <?php wp_nonce_field( 'buybuycoms_hobby_contact', 'buybuycoms_hobby_contact_nonce' ); ?>
            <div class="hb__p-form__honeypot" aria-hidden="true">
              <label for="hb-contact-website">Webサイト</label>
              <input id="hb-contact-website" type="text" name="website" tabindex="-1" autocomplete="off" />
            </div>
            <?php if ( 'error' === filter_input( INPUT_GET, 'contact_status', FILTER_SANITIZE_FULL_SPECIAL_CHARS ) ) : ?>
              <p class="hb__p-form__alert" role="alert">送信できませんでした。入力内容を確認して、時間をおいてもう一度お試しください。</p>
            <?php elseif ( 'rate_limited' === filter_input( INPUT_GET, 'contact_status', FILTER_SANITIZE_FULL_SPECIAL_CHARS ) ) : ?>
              <p class="hb__p-form__alert" role="alert">短時間に複数回送信されたため、一時的に送信を制限しています。10分ほど時間をおいて再度お試しください。</p>
            <?php elseif ( 'sent' === filter_input( INPUT_GET, 'contact_status', FILTER_SANITIZE_FULL_SPECIAL_CHARS ) ) : ?>
              <p class="hb__p-form__alert" role="status">お問い合わせを受け付けました。自動返信メールをご確認ください。</p>
            <?php endif; ?>
            <section class="hb__p-form__block" data-block="method">
              <div class="hb__p-form__head">
                <h2 class="hb__p-form__title">買取方法を選択してください</h2>
                <p class="hb__p-form__note">
                  まず最初にご希望の買取方法をお選びください。
                </p>
              </div>

              <div class="hb__p-form__method-grid">
                <label class="hb__p-form__choice">
                  <input
                    type="radio"
                    name="purchase_type"
                    value="takuhai"
                    required
                    <?php checked( 'takuhai', $requested_purchase_type ); ?>
                  />
                  <span class="hb__p-form__choice-body">
                    <span class="hb__p-form__choice-title">宅配買取</span>
                    <span class="hb__p-form__choice-text"
                      >箱に詰めて送るだけ。全国からご利用いただけます。</span
                    >
                  </span>
                </label>

                <label class="hb__p-form__choice">
                  <input
                    type="radio"
                    name="purchase_type"
                    value="shuccho"
                    required
                    <?php checked( 'shuccho', $requested_purchase_type ); ?>
                  />
                  <span class="hb__p-form__choice-body">
                    <span class="hb__p-form__choice-title">出張買取</span>
                    <span class="hb__p-form__choice-text"
                      >大量のホビー品をスタッフが訪問してお預かりします。</span
                    >
                  </span>
                </label>

                <label class="hb__p-form__choice">
                  <input
                    type="radio"
                    name="purchase_type"
                    value="mochikomi"
                    required
                    <?php checked( 'mochikomi', $requested_purchase_type ); ?>
                  />
                  <span class="hb__p-form__choice-body">
                    <span class="hb__p-form__choice-title">店頭買取</span>
                    <span class="hb__p-form__choice-text"
                      >店頭へ直接お持ち込み。希望日時を選んで申し込めます。</span
                    >
                  </span>
                </label>
              </div>
            </section>

            <section class="hb__p-form__block" data-block="takuhai-qty" hidden>
              <div class="hb__p-form__head">
                <h2 class="hb__p-form__title">
                  宅配買取の点数を選択してください
                </h2>
              </div>
              <div class="hb__p-form__radio-list">
                <label class="hb__p-form__choice">
                  <input type="radio" name="takuhai_qty" value="under" />
                  <span class="hb__p-form__choice-body">
                    <span class="hb__p-form__choice-title">9点以下</span>
                    <span class="hb__p-form__choice-text"
                      >商品点数が9点以下の場合は、まずはお電話またはLINEでご連絡ください。</span
                    >
                  </span>
                </label>
                <label class="hb__p-form__choice">
                  <input type="radio" name="takuhai_qty" value="over" />
                  <span class="hb__p-form__choice-body">
                    <span class="hb__p-form__choice-title">10点以上</span>
                    <span class="hb__p-form__choice-text"
                      >フォームからそのままお申し込みいただけます。</span
                    >
                  </span>
                </label>
              </div>
            </section>

            <section class="hb__p-form__block" data-block="shuccho-qty" hidden>
              <div class="hb__p-form__head">
                <h2 class="hb__p-form__title">
                  出張買取の量を選択してください
                </h2>
              </div>
              <div class="hb__p-form__radio-list">
                <label class="hb__p-form__choice">
                  <input type="radio" name="shuccho_qty" value="under" />
                  <span class="hb__p-form__choice-body">
                    <span class="hb__p-form__choice-title"
                      >段ボール4箱以下</span
                    >
                    <span class="hb__p-form__choice-text"
                      >宅配買取または店頭買取をご利用ください</span
                    >
                  </span>
                </label>
                <label class="hb__p-form__choice">
                  <input type="radio" name="shuccho_qty" value="over" />
                  <span class="hb__p-form__choice-body">
                    <span class="hb__p-form__choice-title"
                      >段ボール5箱以上</span
                    >
                    <span class="hb__p-form__choice-text"
                      >出張買取のご利用条件に該当します。一軒家まるごとなどの場合はご相談くださいませ</span
                    >
                  </span>
                </label>
              </div>
            </section>

            <section class="hb__p-form__block" data-block="box-prep" hidden>
              <div class="hb__p-form__head">
                <h2 class="hb__p-form__title">
                  段ボールの準備方法を選択してください
                </h2>
              </div>
              <div class="hb__p-form__radio-list">
                <label class="hb__p-form__choice">
                  <input type="radio" name="box_prep" value="self" />
                  <span class="hb__p-form__choice-body">
                    <span class="hb__p-form__choice-title">自分で用意する</span>
                    <span class="hb__p-form__choice-text"
                      >お手元の段ボールに商品を梱包してください。</span
                    >
                  </span>
                </label>
                <label class="hb__p-form__choice">
                  <input type="radio" name="box_prep" value="kit" />
                  <span class="hb__p-form__choice-body">
                    <span class="hb__p-form__choice-title"
                      >買取キットを請求する</span
                    >
                    <span class="hb__p-form__choice-text"
                      >必要な段ボールを無料でお届けします。</span
                    >
                  </span>
                </label>
              </div>
            </section>

            <section class="hb__p-form__block" data-block="kit" hidden>
              <div class="hb__p-form__head">
                <h2 class="hb__p-form__title">
                  段ボールのサイズと枚数を選択してください
                </h2>
                <p class="hb__p-form__note">
                  各サイズ5枚まで、合計20枚まで選択できます。
                </p>
              </div>
              <picture class="hb__p-form__kit-image">
                <source
                  srcset="../images/box-sizes-sp.webp"
                  media="(max-width: 767px)"
                />
                <img
                  src="<?php echo esc_url( get_theme_file_uri( '/images/box-sizes.webp' ) ); ?>"
                  alt="段ボールサイズ一覧"
                  loading="lazy"
                />
              </picture>
              <div class="hb__p-form__kit-grid">
                <label class="hb__p-form__kit-row">
                  <span>
                    <span class="hb__p-form__kit-name">Sサイズ</span>
                    <span class="hb__p-form__kit-dim"
                      >幅40cm × 奥行30cm × 高さ30cm</span
                    >
                  </span>
                  <select name="box_s" aria-label="Sサイズの枚数">
                    <option value="0">0枚</option>
                    <option value="1">1枚</option>
                    <option value="2">2枚</option>
                    <option value="3">3枚</option>
                    <option value="4">4枚</option>
                    <option value="5">5枚</option>
                  </select>
                </label>
                <label class="hb__p-form__kit-row">
                  <span>
                    <span class="hb__p-form__kit-name">Mサイズ</span>
                    <span class="hb__p-form__kit-dim"
                      >幅50cm × 奥行30cm × 高さ40cm</span
                    >
                  </span>
                  <select name="box_m" aria-label="Mサイズの枚数">
                    <option value="0">0枚</option>
                    <option value="1">1枚</option>
                    <option value="2">2枚</option>
                    <option value="3">3枚</option>
                    <option value="4">4枚</option>
                    <option value="5">5枚</option>
                  </select>
                </label>
                <label class="hb__p-form__kit-row">
                  <span>
                    <span class="hb__p-form__kit-name">Lサイズ</span>
                    <span class="hb__p-form__kit-dim"
                      >幅60cm × 奥行40cm × 高さ40cm</span
                    >
                  </span>
                  <select name="box_l" aria-label="Lサイズの枚数">
                    <option value="0">0枚</option>
                    <option value="1">1枚</option>
                    <option value="2">2枚</option>
                    <option value="3">3枚</option>
                    <option value="4">4枚</option>
                    <option value="5">5枚</option>
                  </select>
                </label>
                <label class="hb__p-form__kit-row">
                  <span>
                    <span class="hb__p-form__kit-name">LLサイズ</span>
                    <span class="hb__p-form__kit-dim"
                      >幅65cm × 奥行55cm × 高さ40cm</span
                    >
                  </span>
                  <select name="box_ll" aria-label="LLサイズの枚数">
                    <option value="0">0枚</option>
                    <option value="1">1枚</option>
                    <option value="2">2枚</option>
                    <option value="3">3枚</option>
                    <option value="4">4枚</option>
                    <option value="5">5枚</option>
                  </select>
                </label>
              </div>
            </section>

            <section class="hb__p-form__block" data-block="shuccho-date" hidden>
              <div class="hb__p-form__head">
                <h2 class="hb__p-form__title">
                  出張希望日時を入力してください
                </h2>
                <p class="hb__p-form__note">
                  第1希望の日付は必須です。時間帯・第2希望・第3希望は任意です。
                </p>
              </div>
              <div class="hb__p-form__fields">
                <div class="hb__p-form__wish-row">
                  <span class="hb__p-form__wish-label"
                    >第1希望 <span class="hb__p-form__required">必須</span></span
                  >
                  <input
                    type="date"
                    name="shuccho_date_1"
                    aria-label="出張第1希望日付"
                    required
                  />
                  <select name="shuccho_time_1" aria-label="出張第1希望時間帯">
                    <option value="">時間帯を選択</option>
                    <option value="10:00-11:00">10時〜11時</option>
                    <option value="11:00-12:00">11時〜12時</option>
                    <option value="12:00-13:00">12時〜13時</option>
                    <option value="13:00-14:00">13時〜14時</option>
                    <option value="14:00-15:00">14時〜15時</option>
                    <option value="15:00-16:00">15時〜16時</option>
                  </select>
                </div>
                <div class="hb__p-form__wish-row">
                  <span class="hb__p-form__wish-label">第2希望</span>
                  <input
                    type="date"
                    name="shuccho_date_2"
                    aria-label="出張第2希望日付"
                  />
                  <select name="shuccho_time_2" aria-label="出張第2希望時間帯">
                    <option value="">時間帯を選択</option>
                    <option value="10:00-11:00">10時〜11時</option>
                    <option value="11:00-12:00">11時〜12時</option>
                    <option value="12:00-13:00">12時〜13時</option>
                    <option value="13:00-14:00">13時〜14時</option>
                    <option value="14:00-15:00">14時〜15時</option>
                    <option value="15:00-16:00">15時〜16時</option>
                  </select>
                </div>
                <div class="hb__p-form__wish-row">
                  <span class="hb__p-form__wish-label">第3希望</span>
                  <input
                    type="date"
                    name="shuccho_date_3"
                    aria-label="出張第3希望日付"
                  />
                  <select name="shuccho_time_3" aria-label="出張第3希望時間帯">
                    <option value="">時間帯を選択</option>
                    <option value="10:00-11:00">10時〜11時</option>
                    <option value="11:00-12:00">11時〜12時</option>
                    <option value="12:00-13:00">12時〜13時</option>
                    <option value="13:00-14:00">13時〜14時</option>
                    <option value="14:00-15:00">14時〜15時</option>
                    <option value="15:00-16:00">15時〜16時</option>
                  </select>
                </div>
              </div>
            </section>

            <section
              class="hb__p-form__block"
              data-block="mochikomi-date"
              hidden
            >
              <div class="hb__p-form__head">
                <h2 class="hb__p-form__title">
                  店頭買取の希望日時を入力してください
                </h2>
                <p class="hb__p-form__note">
                  すべて任意です。ご希望がある場合のみ入力してください。
                </p>
              </div>
              <div class="hb__p-form__fields">
                <div class="hb__p-form__wish-row">
                  <span class="hb__p-form__wish-label">第1希望</span>
                  <input
                    type="date"
                    name="mochikomi_date_1"
                    aria-label="持込第1希望日付"
                  />
                  <select
                    name="mochikomi_time_1"
                    aria-label="持込第1希望時間帯"
                  >
                    <option value="">時間帯を選択</option>
                    <option value="10:00-11:00">10時〜11時</option>
                    <option value="11:00-12:00">11時〜12時</option>
                    <option value="12:00-13:00">12時〜13時</option>
                    <option value="13:00-14:00">13時〜14時</option>
                    <option value="14:00-15:00">14時〜15時</option>
                    <option value="15:00-16:00">15時〜16時</option>
                  </select>
                </div>
                <div class="hb__p-form__wish-row">
                  <span class="hb__p-form__wish-label">第2希望</span>
                  <input
                    type="date"
                    name="mochikomi_date_2"
                    aria-label="持込第2希望日付"
                  />
                  <select
                    name="mochikomi_time_2"
                    aria-label="持込第2希望時間帯"
                  >
                    <option value="">時間帯を選択</option>
                    <option value="10:00-11:00">10時〜11時</option>
                    <option value="11:00-12:00">11時〜12時</option>
                    <option value="12:00-13:00">12時〜13時</option>
                    <option value="13:00-14:00">13時〜14時</option>
                    <option value="14:00-15:00">14時〜15時</option>
                    <option value="15:00-16:00">15時〜16時</option>
                  </select>
                </div>
                <div class="hb__p-form__wish-row">
                  <span class="hb__p-form__wish-label">第3希望</span>
                  <input
                    type="date"
                    name="mochikomi_date_3"
                    aria-label="持込第3希望日付"
                  />
                  <select
                    name="mochikomi_time_3"
                    aria-label="持込第3希望時間帯"
                  >
                    <option value="">時間帯を選択</option>
                    <option value="10:00-11:00">10時〜11時</option>
                    <option value="11:00-12:00">11時〜12時</option>
                    <option value="12:00-13:00">12時〜13時</option>
                    <option value="13:00-14:00">13時〜14時</option>
                    <option value="14:00-15:00">14時〜15時</option>
                    <option value="15:00-16:00">15時〜16時</option>
                  </select>
                </div>
              </div>
            </section>

            <section class="hb__p-form__block" data-block="customer" hidden>
              <div class="hb__p-form__head">
                <h2 class="hb__p-form__title">お客様情報を入力してください</h2>
              </div>

              <div class="hb__p-form__fields">
                <div>
                  <label class="hb__p-form__label" for="customer-name">
                    お名前
                    <span class="hb__p-form__required">必須</span>
                  </label>
                  <input
                    id="customer-name"
                    type="text"
                    name="customer_name"
                    autocomplete="name"
                    required
                  />
                </div>
                <div>
                  <label class="hb__p-form__label" for="customer-email">
                    メールアドレス
                    <span class="hb__p-form__required">必須</span>
                  </label>
                  <input
                    id="customer-email"
                    type="email"
                    name="customer_email"
                    autocomplete="email"
                    aria-describedby="customer-email-error"
                    required
                  />
                  <span
                    class="hb__p-form__field-error"
                    id="customer-email-error"
                    data-field-error="customer_email"
                    hidden
                  ></span>
                </div>
                <div>
                  <label class="hb__p-form__label" for="customer-postal-code">
                    郵便番号
                    <span class="hb__p-form__required">必須</span>
                  </label>
                  <input
                    id="customer-postal-code"
                    type="text"
                    name="customer_postal_code"
                    autocomplete="postal-code"
                    inputmode="numeric"
                    maxlength="7"
                    placeholder="例：1000001"
                    aria-describedby="customer-postal-code-status customer-postal-code-error"
                    required
                  />
                  <p class="hb__p-form__postal-status" id="customer-postal-code-status" aria-live="polite" hidden></p>
                  <span
                    class="hb__p-form__field-error"
                    id="customer-postal-code-error"
                    data-field-error="customer_postal_code"
                    hidden
                  ></span>
                </div>
                <div>
                  <label class="hb__p-form__label" for="customer-address-locality">
                    都道府県・市区町村
                    <span class="hb__p-form__required">必須</span>
                  </label>
                  <input
                    id="customer-address-locality"
                    type="text"
                    name="customer_address_locality"
                    autocomplete="address-level1"
                    placeholder="郵便番号から自動入力されます"
                    required
                  />
                </div>
                <div>
                  <label class="hb__p-form__label" for="customer-address-street">
                    番地
                    <span class="hb__p-form__required">必須</span>
                  </label>
                  <input
                    id="customer-address-street"
                    type="text"
                    name="customer_address_street"
                    autocomplete="address-line1"
                    required
                  />
                </div>
                <div>
                  <label class="hb__p-form__label" for="customer-address-building">建物名・部屋番号</label>
                  <input
                    id="customer-address-building"
                    type="text"
                    name="customer_address_building"
                    autocomplete="address-line2"
                  />
                </div>
                <div>
                  <label class="hb__p-form__label" for="customer-tel">
                    電話番号
                    <span class="hb__p-form__required">必須</span>
                  </label>
                  <input
                    id="customer-tel"
                    type="tel"
                    name="customer_tel"
                    autocomplete="tel"
                    aria-describedby="customer-tel-error"
                    required
                  />
                  <span
                    class="hb__p-form__field-error"
                    id="customer-tel-error"
                    data-field-error="customer_tel"
                    hidden
                  ></span>
                </div>
                <div>
                  <label class="hb__p-form__label" for="customer-message"
                    >備考</label
                  >
                  <textarea
                    id="customer-message"
                    name="message"
                    placeholder="ご希望の買取方法を選択すると、記入例が表示されます。"
                  ></textarea>
                </div>
              </div>

              <div class="hb__p-form__notes-box">
                <div class="hb__p-form__label">注意事項</div>
                <ul class="hb__p-form__notes-list" data-notes="takuhai">
                  <li>未成年の方のご利用はできません。</li>
                  <li>商品点数によっては査定に数日を要する場合があります。</li>
                  <li>査定合計5,000円未満時、送料無料対象外です。</li>
                  <li>
                    プラモデルの完成品は品物の特性上、買取キャンセルおよび返送対応を致しかねます。
                  </li>
                  <li>
                    <a class="hb__p-form__notes-link" href="<?php echo esc_url( home_url( '/privacy/' ) ); ?>">プライバシーポリシー<img class="hb__p-form__notes-link-icon" src="<?php echo esc_url( get_theme_file_uri( '/images/icon/icon-link.svg' ) ); ?>" alt="" /></a>・利用規約
                  </li>
                </ul>
                <ul class="hb__p-form__notes-list" data-notes="shuccho" hidden>
                  <li>未成年の方のご利用はできません。</li>
                  <li>商品点数によっては当店へ持ち帰り後の査定となります。</li>
                  <li>訪問可能点数は段ボール5箱分以上からのお伺いです。</li>
                  <li>出張エリアは関西圏のみとなります。</li>
                  <li>
                    <a class="hb__p-form__notes-link" href="<?php echo esc_url( home_url( '/privacy/' ) ); ?>">プライバシーポリシー<img class="hb__p-form__notes-link-icon" src="<?php echo esc_url( get_theme_file_uri( '/images/icon/icon-link.svg' ) ); ?>" alt="" /></a>・利用規約
                  </li>
                </ul>
                <ul
                  class="hb__p-form__notes-list"
                  data-notes="mochikomi"
                  hidden
                >
                  <li>未成年の方のご利用はできません。</li>
                  <li>
                    商品点数によっては当店へお預けいただき後日振込になります。
                  </li>
                  <li>
                    買取ができない商品はお持ち帰りいただく場合があります。
                  </li>
                  <li>
                    <a class="hb__p-form__notes-link" href="<?php echo esc_url( home_url( '/privacy/' ) ); ?>">プライバシーポリシー<img class="hb__p-form__notes-link-icon" src="<?php echo esc_url( get_theme_file_uri( '/images/icon/icon-link.svg' ) ); ?>" alt="" /></a>・利用規約
                  </li>
                </ul>
              </div>

              <label class="hb__p-form__agree">
                <input
                  type="checkbox"
                  name="agreement"
                  value="agree"
                  required
                />
                <span class="hb__p-form__agree-text">注意事項とプライバシーポリシー・利用規約に同意します</span>
              </label>

              <div class="hb__p-form__actions">
                <p class="hb__p-form__alert" data-alert hidden></p>
                <button
                  class="hb__c-btn hb__c-btn--primary hb__c-btn--lg hb__p-form__submit"
                  type="submit"
                  disabled
                >
                  この内容で申し込む
                </button>
              </div>
            </section>
          </form>
        </div>
      </section>
    </main>

    <div
      class="hb__p-form-modal"
      data-modal
      hidden
      role="dialog"
      aria-modal="true"
      aria-labelledby="form-modal-title"
    >
      <div class="hb__p-form-modal__box">
        <h2
          class="hb__p-form-modal__title"
          id="form-modal-title"
          data-modal-title
        ></h2>
        <div class="hb__p-form-modal__body" data-modal-body></div>
        <div class="hb__p-form-modal__actions" data-modal-actions></div>
      </div>
    </div>

    <?php get_footer(); ?>
