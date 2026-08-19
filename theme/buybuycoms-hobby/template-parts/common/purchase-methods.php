<?php
/**
 * Static first-stage template part: purchase-methods.
 *
 * @package BuyBuyComs_Hobby
 */

$purchase_methods_variant = isset( $args['variant'] ) && in_array( $args['variant'], array( 'column-tabs', 'column-auto-tabs' ), true ) ? $args['variant'] : 'default';
$purchase_methods_class   = 'hb__p-method-ui hb__p-method--tabs';
$purchase_methods_instance = isset( $args['instance'] ) ? sanitize_key( $args['instance'] ) : 'default';

if ( '' === $purchase_methods_instance ) {
	$purchase_methods_instance = 'default';
}

$purchase_methods_title_id = 'hb-column-methods-title-' . $purchase_methods_instance;

if ( 'default' !== $purchase_methods_variant ) {
	$purchase_methods_class .= ' hb__p-method-ui--' . $purchase_methods_variant;
}
?>
<?php if ( 'default' !== $purchase_methods_variant ) : ?>
  <section class="hb__p-column-methods" aria-labelledby="<?php echo esc_attr( $purchase_methods_title_id ); ?>">
    <h2 class="hb__p-column-methods__title" id="<?php echo esc_attr( $purchase_methods_title_id ); ?>">
      <?php esc_html_e( 'あなたに合わせて選べる、3つの買取方法', 'buybuycoms-hobby' ); ?>
    </h2>
<?php endif; ?>
<div class="<?php echo esc_attr( $purchase_methods_class ); ?>">
  <div class="hb__p-method-tabs" role="tablist" aria-label="買取方法を選択">
    <button
      class="hb__p-method-tab hb__is-active"
      type="button"
      role="tab"
      id="method-tab-takuhai-<?php echo esc_attr( $purchase_methods_instance ); ?>"
      aria-controls="method-panel-takuhai-<?php echo esc_attr( $purchase_methods_instance ); ?>"
      aria-selected="true"
      data-method-tab="takuhai"
    >
      宅配買取
    </button>
    <button
      class="hb__p-method-tab"
      type="button"
      role="tab"
      id="method-tab-shuccho-<?php echo esc_attr( $purchase_methods_instance ); ?>"
      aria-controls="method-panel-shuccho-<?php echo esc_attr( $purchase_methods_instance ); ?>"
      aria-selected="false"
      data-method-tab="shuccho"
    >
      出張買取
    </button>
    <button
      class="hb__p-method-tab"
      type="button"
      role="tab"
      id="method-tab-store-<?php echo esc_attr( $purchase_methods_instance ); ?>"
      aria-controls="method-panel-store-<?php echo esc_attr( $purchase_methods_instance ); ?>"
      aria-selected="false"
      data-method-tab="store"
    >
      店頭買取
    </button>
  </div>
  <div class="hb__p-method-grid">
    <article
      class="hb__p-method-card hb__is-active"
      id="method-panel-takuhai-<?php echo esc_attr( $purchase_methods_instance ); ?>"
      role="tabpanel"
      aria-labelledby="method-tab-takuhai-<?php echo esc_attr( $purchase_methods_instance ); ?>"
      data-method-panel="takuhai"
    >
      <figure class="hb__p-method-image">
        <img
          src="<?php echo esc_url( get_theme_file_uri( '/images/1.takuhai.webp' ) ); ?>"
          alt="宅配買取のイメージ"
        />
        <span class="hb__p-method-badge">おすすめ</span>
      </figure>
      <h3 class="hb__p-method-title">宅配買取</h3>
      <p class="hb__p-method-text">
        ご自宅から段ボールに詰めて発送するだけ。手間なく全国どこからでもご利用いただけます。
      </p>
      <ul class="hb__p-method-list">
        <li>送料・梱包材無料</li>
        <li>買取キットの発送も可能</li>
        <li>10点以上から受付</li>
      </ul>
      <div class="hb__p-method-action">
        <a class="hb__c-btn hb__c-btn--ghost" href="<?php echo esc_url( add_query_arg( 'type', 'takuhai', home_url( '/contact/' ) ) ); ?>"
          >宅配買取はこちら</a
        >
      </div>
    </article>
    <article
      class="hb__p-method-card"
      id="method-panel-shuccho-<?php echo esc_attr( $purchase_methods_instance ); ?>"
      role="tabpanel"
      aria-labelledby="method-tab-shuccho-<?php echo esc_attr( $purchase_methods_instance ); ?>"
      data-method-panel="shuccho"
    >
      <figure class="hb__p-method-image">
        <img
          src="<?php echo esc_url( get_theme_file_uri( '/images/2.shucchou.webp' ) ); ?>"
          alt="出張買取のイメージ"
        />
      </figure>
      <h3 class="hb__p-method-title">出張買取</h3>
      <p class="hb__p-method-text">
        スタッフがご自宅まで直接お伺いします。大量にある場合や重い商品でも安心してご利用いただけます。
      </p>
      <ul class="hb__p-method-list">
        <li>出張料・査定料無料</li>
        <li>段ボール5箱以上から</li>
        <li>ご希望日時に対応</li>
      </ul>
      <div class="hb__p-method-action">
        <a class="hb__c-btn hb__c-btn--ghost" href="<?php echo esc_url( add_query_arg( 'type', 'shuccho', home_url( '/contact/' ) ) ); ?>"
          >出張買取はこちら</a
        >
      </div>
    </article>
    <article
      class="hb__p-method-card"
      id="method-panel-store-<?php echo esc_attr( $purchase_methods_instance ); ?>"
      role="tabpanel"
      aria-labelledby="method-tab-store-<?php echo esc_attr( $purchase_methods_instance ); ?>"
      data-method-panel="store"
    >
      <figure class="hb__p-method-image">
        <img
          src="<?php echo esc_url( get_theme_file_uri( '/images/3.tentou.webp' ) ); ?>"
          alt="持ち込み買取のイメージ"
        />
      </figure>
      <h3 class="hb__p-method-title">持ち込み買取</h3>
      <p class="hb__p-method-text">
        店頭へお持ち込みいただくと、その場でスピーディに査定・お支払いいたします。
      </p>
      <ul class="hb__p-method-list">
        <li>即日現金払い</li>
        <li>点数制限なし</li>
        <li>事前予約で待ち時間短縮</li>
      </ul>
      <div class="hb__p-method-action">
        <a class="hb__c-btn hb__c-btn--ghost" href="<?php echo esc_url( add_query_arg( 'type', 'mochikomi', home_url( '/contact/' ) ) ); ?>"
          >持ち込み買取はこちら</a
        >
      </div>
    </article>
  </div>
</div>
<?php if ( 'default' !== $purchase_methods_variant ) : ?>
  </section>
<?php endif; ?>
