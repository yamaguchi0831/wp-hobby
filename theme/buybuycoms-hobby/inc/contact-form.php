<?php
/**
 * Contact form delivery and settings.
 *
 * @package BuyBuyComs_Hobby
 */

/**
 * Return the default contact-form settings.
 *
 * @return array<string, string>
 */
function buybuycoms_hobby_contact_default_settings() {
	return array(
		'recipient'        => get_option( 'admin_email' ),
		'auto_reply_from_name' => '売買コムズ ホビーベース',
		'admin_subject'    => '[site_name] お問い合わせ',
		'admin_body'       => "以下のとおり、お問い合わせを受け付けました。\n--------------------------------------------------\n■お客様情報\nお名前：[customer-name]\nメールアドレス：[mailaddress]\n郵便番号：[postal-code]\n住所：[address]\n電話番号：[telephone]\n\n--------------------------------------------------\n[detail]\n\n--------------------------------------------------\n■お問い合わせ内容\n[body]\n\n--------------------------------------------------\n■ご依頼番号\n[request-number]",
		'admin_detail_takuhai_kit'  => "■お申込内容\n買取方法：[inq-type]\n\n買取点数・物量：[purchase-quantity]\n\nダンボールの準備：必要\n\n希望ダンボール：\n・Sサイズ：[box-s]\n・Mサイズ：[box-m]\n・Lサイズ：[box-l]\n・LLサイズ：[box-ll]",
		'admin_detail_takuhai_self' => "■お申込内容\n買取方法：[inq-type]\n\n買取点数・物量：[purchase-quantity]\n\nダンボールの準備：不要",
		'admin_detail_shuccho'      => "■お申込内容\n買取方法：[inq-type]\n\n■出張買取の希望\n第1希望日：[preferred-date-1]\n第1希望時間：[preferred-time-1]\n\n第2希望日：[preferred-date-2]\n第2希望時間：[preferred-time-2]\n\n第3希望日：[preferred-date-3]\n第3希望時間：[preferred-time-3]",
		'admin_detail_mochikomi'    => "■お申込内容\n買取方法：[inq-type]\n\n■店頭買取の希望\n第1希望日：[preferred-date-1]\n第1希望時間：[preferred-time-1]\n\n第2希望日：[preferred-date-2]\n第2希望時間：[preferred-time-2]\n\n第3希望日：[preferred-date-3]\n第3希望時間：[preferred-time-3]",
		'auto_reply_subject' => '[site_name] お問い合わせありがとうございます',
		'auto_reply_body'  => "[customer-name]様\n\nお問い合わせありがとうございます。\n内容を確認のうえ、担当者よりご連絡いたします。\n\n--------------------\nお名前：[customer-name]\nメールアドレス：[mailaddress]\n郵便番号：[postal-code]\n都道府県・市区町村：[address-locality]\n番地：[address-street]\n建物名・部屋番号：[address-building]\n電話番号：[telephone]\n\n[detail]\n\nお問い合わせ内容\n[body]",
		'redirect_page_id' => '',
	);
}

/**
 * Return saved contact-form settings merged with defaults.
 *
 * @return array<string, string>
 */
function buybuycoms_hobby_contact_settings() {
	$saved = get_option( 'buybuycoms_hobby_contact_settings', array() );
	$saved = is_array( $saved ) ? $saved : array();
	$legacy_admin_body = "お問い合わせを受け付けました。\n\nお名前: [name]\nメールアドレス: [email]\n住所: [address]\n電話番号: [tel]\n買取方法: [purchase_type]\n[details]\n\nお問い合わせ内容:\n[message]";
	$previous_admin_body = "お問い合わせを受け付けました。\n\nお名前：[customer-name]\nメールアドレス：[mailaddress]\n住所：[address]\n電話番号：[telephone]\n買取方法：[inq-type]\n買取点数・物量：[purchase-quantity]\nダンボールの準備：[box-preparation]\n希望ダンボール：Sサイズ：[box-s] / Mサイズ：[box-m] / Lサイズ：[box-l] / LLサイズ：[box-ll]\n第1希望日：[preferred-date-1]\n第1希望時間：[preferred-time-1]\n第2希望日：[preferred-date-2]\n第2希望時間：[preferred-time-2]\n第3希望日：[preferred-date-3]\n第3希望時間：[preferred-time-3]\n\nお問い合わせ内容：\n[body]";
	$previous_auto_reply_body = "[customer-name]様\n\nお問い合わせありがとうございます。\n内容を確認のうえ、担当者よりご連絡いたします。\n\n--------------------\nお名前：[customer-name]\nメールアドレス：[mailaddress]\n電話番号：[telephone]\n住所：[address]\n買取方法：[inq-type]\n\nお問い合わせ内容\n[body]";

	if ( ! isset( $saved['auto_reply_body'] ) && isset( $saved['auto_reply'] ) && is_string( $saved['auto_reply'] ) ) {
		$saved['auto_reply_body'] = $saved['auto_reply'];
	}
	if ( isset( $saved['admin_body'] ) && $legacy_admin_body === str_replace( "\r\n", "\n", $saved['admin_body'] ) ) {
		unset( $saved['admin_body'] );
	}
	if ( isset( $saved['admin_body'] ) && $previous_admin_body === str_replace( "\r\n", "\n", $saved['admin_body'] ) ) {
		unset( $saved['admin_body'] );
	}
	if ( isset( $saved['auto_reply_body'] ) && $previous_auto_reply_body === str_replace( "\r\n", "\n", $saved['auto_reply_body'] ) ) {
		unset( $saved['auto_reply_body'] );
	}
	if ( isset( $saved['auto_reply_from_name'] ) && '売買コムズ hobbyベース' === $saved['auto_reply_from_name'] ) {
		$saved['auto_reply_from_name'] = '売買コムズ ホビーベース';
	}
	if ( isset( $saved['admin_body'] ) && false === strpos( $saved['admin_body'], '[request-number]' ) ) {
		$saved['admin_body'] .= "\n\n--------------------------------------------------\n■ご依頼番号\n[request-number]";
	}

	return wp_parse_args( $saved, buybuycoms_hobby_contact_default_settings() );
}

/**
 * Register contact-form settings.
 *
 * @return void
 */
function buybuycoms_hobby_register_contact_settings() {
	register_setting(
		'buybuycoms_hobby_contact_settings_group',
		'buybuycoms_hobby_contact_settings',
		array(
			'type'              => 'array',
			'sanitize_callback' => 'buybuycoms_hobby_sanitize_contact_settings',
			'default'           => buybuycoms_hobby_contact_default_settings(),
		)
	);
}
add_action( 'admin_init', 'buybuycoms_hobby_register_contact_settings' );

/**
 * Sanitize contact-form settings before saving.
 *
 * @param mixed $settings Submitted settings.
 * @return array<string, string>
 */
function buybuycoms_hobby_sanitize_contact_settings( $settings ) {
	$defaults = buybuycoms_hobby_contact_default_settings();
	$settings = is_array( $settings ) ? $settings : array();
	$recipient = isset( $settings['recipient'] ) ? sanitize_email( wp_unslash( $settings['recipient'] ) ) : '';
	$auto_reply_from_name = isset( $settings['auto_reply_from_name'] ) ? sanitize_text_field( wp_unslash( $settings['auto_reply_from_name'] ) ) : '';

	if ( ! is_email( $recipient ) ) {
		add_settings_error( 'buybuycoms_hobby_contact_settings', 'invalid-recipient', __( '送信先メールアドレスを正しく入力してください。', 'buybuycoms-hobby' ) );
		$recipient = $defaults['recipient'];
	}
	if ( '' === $auto_reply_from_name ) {
		$auto_reply_from_name = $defaults['auto_reply_from_name'];
	}

	$detail_keys = array( 'admin_detail_takuhai_kit', 'admin_detail_takuhai_self', 'admin_detail_shuccho', 'admin_detail_mochikomi' );
	$sanitized_details = array();
	foreach ( $detail_keys as $detail_key ) {
		$sanitized_details[ $detail_key ] = isset( $settings[ $detail_key ] ) ? sanitize_textarea_field( wp_unslash( $settings[ $detail_key ] ) ) : $defaults[ $detail_key ];
	}

	return array_merge( array(
		'recipient'          => $recipient,
		'auto_reply_from_name' => $auto_reply_from_name,
		'admin_subject'      => isset( $settings['admin_subject'] ) ? sanitize_text_field( wp_unslash( $settings['admin_subject'] ) ) : $defaults['admin_subject'],
		'admin_body'         => isset( $settings['admin_body'] ) ? sanitize_textarea_field( wp_unslash( $settings['admin_body'] ) ) : $defaults['admin_body'],
		'auto_reply_subject' => isset( $settings['auto_reply_subject'] ) ? sanitize_text_field( wp_unslash( $settings['auto_reply_subject'] ) ) : $defaults['auto_reply_subject'],
		'auto_reply_body'    => isset( $settings['auto_reply_body'] ) ? sanitize_textarea_field( wp_unslash( $settings['auto_reply_body'] ) ) : $defaults['auto_reply_body'],
		'redirect_page_id' => isset( $settings['redirect_page_id'] ) ? (string) absint( $settings['redirect_page_id'] ) : '',
	), $sanitized_details );
}

/**
 * Add the contact-form settings page.
 *
 * @return void
 */
function buybuycoms_hobby_add_contact_settings_page() {
	add_menu_page(
		__( 'お問い合わせフォーム', 'buybuycoms-hobby' ),
		__( '問合せフォーム', 'buybuycoms-hobby' ),
		'manage_options',
		'buybuycoms-hobby-contact',
		'buybuycoms_hobby_render_contact_settings_page',
		'dashicons-email-alt',
		59
	);
}
add_action( 'admin_menu', 'buybuycoms_hobby_add_contact_settings_page' );

/**
 * Load the contact-form settings interactions only on its settings page.
 *
 * @param string $hook Current admin page hook.
 * @return void
 */
function buybuycoms_hobby_contact_enqueue_admin_assets( $hook ) {
	if ( 'toplevel_page_buybuycoms-hobby-contact' !== $hook ) {
		return;
	}

	$script_path = get_theme_file_path( 'asset/js/admin/contact-form-settings.js' );
	wp_enqueue_script(
		'buybuycoms-hobby-contact-settings',
		get_theme_file_uri( 'asset/js/admin/contact-form-settings.js' ),
		array(),
		file_exists( $script_path ) ? (string) filemtime( $script_path ) : null,
		true
	);
}
add_action( 'admin_enqueue_scripts', 'buybuycoms_hobby_contact_enqueue_admin_assets' );

/**
 * Render the mail tags available in contact email templates.
 *
 * @return void
 */
function buybuycoms_hobby_contact_render_mail_tags() {
	$tags = array(
		'[site_name]',
		'[customer-name]',
		'[mailaddress]',
		'[telephone]',
		'[address]',
		'[postal-code]',
		'[address-locality]',
		'[address-street]',
		'[address-building]',
		'[inq-type]',
		'[purchase-quantity]',
		'[box-preparation]',
		'[box-s]',
		'[box-m]',
		'[box-l]',
		'[box-ll]',
		'[preferred-date-1]',
		'[preferred-time-1]',
		'[preferred-date-2]',
		'[preferred-time-2]',
		'[preferred-date-3]',
		'[preferred-time-3]',
		'[detail]',
		'[request-number]',
		'[body]',
	);
	?>
	<p class="description"><?php esc_html_e( '以下の項目にて、これらのメールタグを利用できます:', 'buybuycoms-hobby' ); ?></p>
	<p>
		<?php foreach ( $tags as $tag ) : ?>
			<code><?php echo esc_html( $tag ); ?></code>
		<?php endforeach; ?>
	</p>
	<?php
}

/**
 * Render the contact-form settings page.
 *
 * @return void
 */
function buybuycoms_hobby_render_contact_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$settings = buybuycoms_hobby_contact_settings();
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'お問い合わせフォーム', 'buybuycoms-hobby' ); ?></h1>
		<?php settings_errors( 'buybuycoms_hobby_contact_settings' ); ?>
		<form action="options.php" method="post">
			<?php settings_fields( 'buybuycoms_hobby_contact_settings_group' ); ?>
			<table class="form-table" role="presentation">
				<tr>
					<th scope="row"><label for="hb-contact-recipient"><?php esc_html_e( 'メールの送信先', 'buybuycoms-hobby' ); ?></label></th>
					<td><input class="regular-text" id="hb-contact-recipient" name="buybuycoms_hobby_contact_settings[recipient]" type="email" value="<?php echo esc_attr( $settings['recipient'] ); ?>" required /></td>
				</tr>
				<tr>
					<th scope="row"><label for="hb-contact-admin-subject"><?php esc_html_e( '管理者宛メールの件名', 'buybuycoms-hobby' ); ?></label></th>
					<td><input class="large-text" id="hb-contact-admin-subject" name="buybuycoms_hobby_contact_settings[admin_subject]" type="text" value="<?php echo esc_attr( $settings['admin_subject'] ); ?>" required /></td>
				</tr>
				<tr>
					<th scope="row"><label for="hb-contact-admin-body"><?php esc_html_e( '管理者宛メールの共通本文', 'buybuycoms-hobby' ); ?></label></th>
					<td>
						<?php buybuycoms_hobby_contact_render_mail_tags(); ?>
						<p class="description"><?php esc_html_e( 'お客様情報・お問い合わせ内容・ご依頼番号を含む共通部分は、ここで編集します。買取方法ごとに切り替えるお申込内容は [detail] で差し込みます。', 'buybuycoms-hobby' ); ?></p>
						<textarea class="large-text" id="hb-contact-admin-body" name="buybuycoms_hobby_contact_settings[admin_body]" rows="14" required><?php echo esc_textarea( $settings['admin_body'] ); ?></textarea>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php esc_html_e( 'お申込内容の文面', 'buybuycoms-hobby' ); ?></th>
					<td data-hb-contact-detail-tabs>
						<p class="description"><?php esc_html_e( '管理者宛メールの [detail] に、選択された買取方法の文面が差し込まれます。', 'buybuycoms-hobby' ); ?></p>
						<p role="tablist" aria-label="<?php esc_attr_e( '買取方法別の申込内容', 'buybuycoms-hobby' ); ?>">
							<button class="button button-primary" type="button" role="tab" aria-selected="true" aria-controls="hb-contact-detail-takuhai-kit" id="hb-contact-tab-takuhai-kit" data-hb-contact-detail-tab="takuhai-kit"><?php esc_html_e( '宅配：ダンボール必要', 'buybuycoms-hobby' ); ?></button>
							<button class="button" type="button" role="tab" aria-selected="false" aria-controls="hb-contact-detail-takuhai-self" id="hb-contact-tab-takuhai-self" data-hb-contact-detail-tab="takuhai-self"><?php esc_html_e( '宅配：ダンボール不要', 'buybuycoms-hobby' ); ?></button>
							<button class="button" type="button" role="tab" aria-selected="false" aria-controls="hb-contact-detail-shuccho" id="hb-contact-tab-shuccho" data-hb-contact-detail-tab="shuccho"><?php esc_html_e( '出張買取', 'buybuycoms-hobby' ); ?></button>
							<button class="button" type="button" role="tab" aria-selected="false" aria-controls="hb-contact-detail-mochikomi" id="hb-contact-tab-mochikomi" data-hb-contact-detail-tab="mochikomi"><?php esc_html_e( '店頭買取', 'buybuycoms-hobby' ); ?></button>
						</p>
						<?php
						$detail_fields = array(
							'takuhai-kit'  => 'admin_detail_takuhai_kit',
							'takuhai-self' => 'admin_detail_takuhai_self',
							'shuccho'      => 'admin_detail_shuccho',
							'mochikomi'    => 'admin_detail_mochikomi',
						);
						foreach ( $detail_fields as $tab => $field ) :
							?>
							<div id="hb-contact-detail-<?php echo esc_attr( $tab ); ?>" role="tabpanel" aria-labelledby="hb-contact-tab-<?php echo esc_attr( $tab ); ?>" data-hb-contact-detail-panel="<?php echo esc_attr( $tab ); ?>"<?php echo 'takuhai-kit' !== $tab ? ' hidden' : ''; ?>>
								<?php buybuycoms_hobby_contact_render_mail_tags(); ?>
								<textarea class="large-text" name="buybuycoms_hobby_contact_settings[<?php echo esc_attr( $field ); ?>]" rows="14" required><?php echo esc_textarea( $settings[ $field ] ); ?></textarea>
							</div>
						<?php endforeach; ?>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="hb-contact-auto-reply-from-name"><?php esc_html_e( '入力者宛メールの送信者名', 'buybuycoms-hobby' ); ?></label></th>
					<td>
						<input class="regular-text" id="hb-contact-auto-reply-from-name" name="buybuycoms_hobby_contact_settings[auto_reply_from_name]" type="text" value="<?php echo esc_attr( $settings['auto_reply_from_name'] ); ?>" required />
						<p class="description"><?php esc_html_e( '入力者宛メールに表示する差出人名です。差出人メールアドレスはWordPressまたはSMTPの設定を使用します。', 'buybuycoms-hobby' ); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="hb-contact-auto-reply-subject"><?php esc_html_e( '入力者宛メールの件名', 'buybuycoms-hobby' ); ?></label></th>
					<td><input class="large-text" id="hb-contact-auto-reply-subject" name="buybuycoms_hobby_contact_settings[auto_reply_subject]" type="text" value="<?php echo esc_attr( $settings['auto_reply_subject'] ); ?>" required /></td>
				</tr>
				<tr>
					<th scope="row"><label for="hb-contact-auto-reply-body"><?php esc_html_e( '入力者宛メールの本文', 'buybuycoms-hobby' ); ?></label></th>
					<td>
						<?php buybuycoms_hobby_contact_render_mail_tags(); ?>
						<textarea class="large-text" id="hb-contact-auto-reply-body" name="buybuycoms_hobby_contact_settings[auto_reply_body]" rows="14" required><?php echo esc_textarea( $settings['auto_reply_body'] ); ?></textarea>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="hb-contact-redirect-page"><?php esc_html_e( '送信後のリダイレクトページ', 'buybuycoms-hobby' ); ?></label></th>
					<td>
						<select id="hb-contact-redirect-page" name="buybuycoms_hobby_contact_settings[redirect_page_id]">
							<option value="0"><?php esc_html_e( 'お問い合わせページに戻る', 'buybuycoms-hobby' ); ?></option>
							<?php foreach ( get_pages() as $page ) : ?>
								<option value="<?php echo esc_attr( $page->ID ); ?>" <?php selected( (int) $settings['redirect_page_id'], $page->ID ); ?>><?php echo esc_html( $page->post_title ); ?></option>
							<?php endforeach; ?>
						</select>
					</td>
				</tr>
			</table>
			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}

/**
 * Get the contact page URL used for safe error redirects.
 *
 * @return string
 */
function buybuycoms_hobby_contact_page_url() {
	$page = get_page_by_path( 'contact' );

	return $page ? get_permalink( $page ) : home_url( '/contact/' );
}

/**
 * Get the thank-you page URL when the corresponding page exists.
 *
 * @return string
 */
function buybuycoms_hobby_thanks_page_url() {
	$page = get_page_by_path( 'thanks' );

	return $page ? get_permalink( $page ) : '';
}

/**
 * Redirect to the contact page with a status, without reflecting submitted data.
 *
 * @param string $status Status identifier.
 * @return never
 */
function buybuycoms_hobby_contact_redirect_error( $status ) {
	wp_safe_redirect( add_query_arg( 'contact_status', $status, buybuycoms_hobby_contact_page_url() ), 303 );
	exit;
}

/**
 * Replace supported placeholders in an auto-reply template.
 *
 * @param string               $template Email template.
 * @param array<string, string> $values Submitted values.
 * @return string
 */
function buybuycoms_hobby_contact_replace_placeholders( $template, $values ) {
	$replacements = array();
	foreach ( $values as $key => $value ) {
		$replacements[ '[' . $key . ']' ] = $value;
	}

	return strtr( $template, $replacements );
}

/**
 * Read a scalar POST value without accepting crafted arrays.
 *
 * @param array<string, mixed> $values Request values.
 * @param string               $key Field name.
 * @return string
 */
function buybuycoms_hobby_contact_post_value( $values, $key ) {
	return isset( $values[ $key ] ) && is_string( $values[ $key ] ) ? $values[ $key ] : '';
}

/**
 * Normalize a Japanese postal code to seven ASCII digits.
 *
 * @param string $postal_code Postal-code input.
 * @return string
 */
function buybuycoms_hobby_contact_normalize_postal_code( $postal_code ) {
	$postal_code = strtr(
		$postal_code,
		array(
			'０' => '0',
			'１' => '1',
			'２' => '2',
			'３' => '3',
			'４' => '4',
			'５' => '5',
			'６' => '6',
			'７' => '7',
			'８' => '8',
			'９' => '9',
		)
	);

	return preg_replace( '/[^0-9]/', '', $postal_code );
}

/**
 * Return a string length without requiring a specific WordPress version.
 *
 * @param string $value Text to measure.
 * @return int
 */
function buybuycoms_hobby_contact_string_length( $value ) {
	return function_exists( 'mb_strlen' ) ? mb_strlen( $value, 'UTF-8' ) : strlen( $value );
}

/**
 * Set the sender name for the contact-form auto-reply only.
 *
 * @return string
 */
function buybuycoms_hobby_contact_auto_reply_from_name() {
	$settings = buybuycoms_hobby_contact_settings();

	return $settings['auto_reply_from_name'];
}

/**
 * Generate the next site-wide contact request number.
 *
 * @return string
 */
function buybuycoms_hobby_contact_next_request_number() {
	global $wpdb;

	$option_name = 'buybuycoms_hobby_contact_request_number';
	$updated = $wpdb->query(
		$wpdb->prepare(
			"UPDATE {$wpdb->options} SET option_value = LAST_INSERT_ID( CAST( option_value AS UNSIGNED ) + 1 ) WHERE option_name = %s",
			$option_name
		)
	);

	if ( 1 === $updated ) {
		return (string) $wpdb->get_var( 'SELECT LAST_INSERT_ID()' );
	}

	if ( add_option( $option_name, '1000000', '', false ) ) {
		return '1000000';
	}

	$wpdb->query(
		$wpdb->prepare(
			"UPDATE {$wpdb->options} SET option_value = LAST_INSERT_ID( CAST( option_value AS UNSIGNED ) + 1 ) WHERE option_name = %s",
			$option_name
		)
	);

	return (string) $wpdb->get_var( 'SELECT LAST_INSERT_ID()' );
}

/**
 * Handle the public contact-form request.
 *
 * @return void
 */
function buybuycoms_hobby_handle_contact_form() {
	if ( 'POST' !== strtoupper( $_SERVER['REQUEST_METHOD'] ?? '' ) ) {
		buybuycoms_hobby_contact_redirect_error( 'error' );
	}

	$raw   = wp_unslash( $_POST );
	$nonce = sanitize_text_field( buybuycoms_hobby_contact_post_value( $raw, 'buybuycoms_hobby_contact_nonce' ) );
	if ( ! wp_verify_nonce( $nonce, 'buybuycoms_hobby_contact' ) ) {
		buybuycoms_hobby_contact_redirect_error( 'error' );
	}

	if ( '' !== buybuycoms_hobby_contact_post_value( $raw, 'website' ) ) {
		buybuycoms_hobby_contact_redirect_error( 'sent' );
	}

	$ip = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '';
	$rate_key = 'hb_contact_rate_' . md5( $ip );
	if ( (int) get_transient( $rate_key ) >= 10 ) {
		buybuycoms_hobby_contact_redirect_error( 'rate_limited' );
	}

	$values = array(
		'name'          => sanitize_text_field( buybuycoms_hobby_contact_post_value( $raw, 'customer_name' ) ),
		'email'         => sanitize_email( buybuycoms_hobby_contact_post_value( $raw, 'customer_email' ) ),
		'postal_code'   => buybuycoms_hobby_contact_normalize_postal_code( buybuycoms_hobby_contact_post_value( $raw, 'customer_postal_code' ) ),
		'address_locality' => sanitize_text_field( buybuycoms_hobby_contact_post_value( $raw, 'customer_address_locality' ) ),
		'address_street' => sanitize_text_field( buybuycoms_hobby_contact_post_value( $raw, 'customer_address_street' ) ),
		'address_building' => sanitize_text_field( buybuycoms_hobby_contact_post_value( $raw, 'customer_address_building' ) ),
		'tel'           => sanitize_text_field( buybuycoms_hobby_contact_post_value( $raw, 'customer_tel' ) ),
		'message'       => sanitize_textarea_field( buybuycoms_hobby_contact_post_value( $raw, 'message' ) ),
		'purchase_type' => sanitize_key( buybuycoms_hobby_contact_post_value( $raw, 'purchase_type' ) ),
	);

	$valid_types = array( 'takuhai', 'shuccho', 'mochikomi' );
	$telephone   = preg_replace( '/[^0-9]/', '', $values['tel'] );
	if (
		! in_array( $values['purchase_type'], $valid_types, true ) ||
		'' === $values['name'] || buybuycoms_hobby_contact_string_length( $values['name'] ) > 100 ||
		! is_email( $values['email'] ) ||
		! preg_match( '/^\d{7}$/', $values['postal_code'] ) ||
		'' === $values['address_locality'] || buybuycoms_hobby_contact_string_length( $values['address_locality'] ) > 255 ||
		'' === $values['address_street'] || buybuycoms_hobby_contact_string_length( $values['address_street'] ) > 255 ||
		buybuycoms_hobby_contact_string_length( $values['address_building'] ) > 255 ||
		! preg_match( '/^0\\d{9,10}$/', $telephone ) ||
		buybuycoms_hobby_contact_string_length( $values['message'] ) > 4000 ||
		'agree' !== buybuycoms_hobby_contact_post_value( $raw, 'agreement' )
	) {
		buybuycoms_hobby_contact_redirect_error( 'error' );
	}
	$values['tel'] = $telephone;
	$values['address'] = implode(
		' ',
		array_filter(
			array(
				'〒' . $values['postal_code'],
				$values['address_locality'],
				$values['address_street'],
				$values['address_building'],
			)
		)
	);
	$values = array_merge(
		$values,
		array(
			'purchase_quantity' => '',
			'box_preparation'    => '',
			'box_s'              => '',
			'box_m'              => '',
			'box_l'              => '',
			'box_ll'             => '',
			'preferred_date_1'   => '',
			'preferred_time_1'   => '',
			'preferred_date_2'   => '',
			'preferred_time_2'   => '',
			'preferred_date_3'   => '',
			'preferred_time_3'   => '',
		)
	);

	$details  = array();
	$box_prep = '';
	if ( 'takuhai' === $values['purchase_type'] ) {
		$quantity = sanitize_key( buybuycoms_hobby_contact_post_value( $raw, 'takuhai_qty' ) );
		$box_prep = sanitize_key( buybuycoms_hobby_contact_post_value( $raw, 'box_prep' ) );
		if ( 'over' !== $quantity || ! in_array( $box_prep, array( 'self', 'kit' ), true ) ) {
			buybuycoms_hobby_contact_redirect_error( 'error' );
		}
		$quantity_labels = array( 'over' => '10点以上' );
		$box_prep_labels = array( 'self' => '自分で用意する', 'kit' => '買取キット希望' );
		$details['物量チェック'] = $quantity_labels[ $quantity ];
		$details['段ボールの用意'] = $box_prep_labels[ $box_prep ];
		$values['purchase_quantity'] = $quantity_labels[ $quantity ];
		$values['box_preparation']    = $box_prep_labels[ $box_prep ];
		if ( 'kit' === $box_prep ) {
			$total = 0;
			foreach ( array( 'box_s', 'box_m', 'box_l', 'box_ll' ) as $size ) {
				$count = absint( buybuycoms_hobby_contact_post_value( $raw, $size ) );
				if ( $count > 5 ) {
					buybuycoms_hobby_contact_redirect_error( 'error' );
				}
				$total += $count;
				$details[ strtoupper( str_replace( 'box_', '', $size ) ) . 'サイズ' ] = (string) $count;
				$values[ $size ] = $count . '枚';
			}
			if ( $total < 1 ) {
				buybuycoms_hobby_contact_redirect_error( 'error' );
			}
		}
	}
	if ( in_array( $values['purchase_type'], array( 'shuccho', 'mochikomi' ), true ) ) {
		if ( 'shuccho' === $values['purchase_type'] ) {
			if ( 'over' !== sanitize_key( buybuycoms_hobby_contact_post_value( $raw, 'shuccho_qty' ) ) ) {
				buybuycoms_hobby_contact_redirect_error( 'error' );
			}
			$values['purchase_quantity'] = '段ボール5箱以上';
		}
		$prefix        = $values['purchase_type'];
		$allowed_times = array( '', '10:00-11:00', '11:00-12:00', '12:00-13:00', '13:00-14:00', '14:00-15:00', '15:00-16:00' );
		for ( $index = 1; $index <= 3; $index++ ) {
			$date = buybuycoms_hobby_contact_post_value( $raw, $prefix . '_date_' . $index );
			$time = buybuycoms_hobby_contact_post_value( $raw, $prefix . '_time_' . $index );
			if ( 'shuccho' === $prefix && 1 === $index && '' === $date ) {
				buybuycoms_hobby_contact_redirect_error( 'error' );
			}
			if ( ( '' !== $date && ! preg_match( '/^\\d{4}-\\d{2}-\\d{2}$/', $date ) ) || ! in_array( $time, $allowed_times, true ) ) {
				buybuycoms_hobby_contact_redirect_error( 'error' );
			}
			if ( '' !== $date || '' !== $time ) {
				$details[ '第' . $index . '希望' ] = trim( $date . ' ' . $time );
			}
			$values[ 'preferred_date_' . $index ] = $date;
			$values[ 'preferred_time_' . $index ] = $time;
		}
	}

	$detail_template_keys = array(
		'takuhai'  => 'kit' === $box_prep ? 'admin_detail_takuhai_kit' : 'admin_detail_takuhai_self',
		'shuccho'  => 'admin_detail_shuccho',
		'mochikomi' => 'admin_detail_mochikomi',
	);
	$detail_template_key = $detail_template_keys[ $values['purchase_type'] ];
	$labels = array( 'takuhai' => '宅配買取', 'shuccho' => '出張買取', 'mochikomi' => '持込買取' );
	$values['inq-type'] = $labels[ $values['purchase_type'] ];
	$settings = buybuycoms_hobby_contact_settings();

	$values['purchase_type'] = $labels[ $values['purchase_type'] ];
	$detail_lines = array();
	foreach ( $details as $label => $detail ) {
		$detail_lines[] = $label . ': ' . $detail;
	}
	$values['details']   = implode( "\n", $detail_lines );
	$values['site_name'] = wp_specialchars_decode( get_bloginfo( 'name' ), ENT_QUOTES );
	$values['customer-name']     = $values['name'];
	$values['mailaddress']       = $values['email'];
	$values['telephone']         = $values['tel'];
	$values['postal-code']       = $values['postal_code'];
	$values['address-locality']  = $values['address_locality'];
	$values['address-street']    = $values['address_street'];
	$values['address-building']  = $values['address_building'];
	$values['inq-type']          = $values['purchase_type'];
	$values['purchase-quantity'] = $values['purchase_quantity'];
	$values['box-preparation']   = $values['box_preparation'];
	$values['box-s']             = $values['box_s'];
	$values['box-m']             = $values['box_m'];
	$values['box-l']             = $values['box_l'];
	$values['box-ll']            = $values['box_ll'];
	$values['preferred-date-1']  = $values['preferred_date_1'];
	$values['preferred-time-1']  = $values['preferred_time_1'];
	$values['preferred-date-2']  = $values['preferred_date_2'];
	$values['preferred-time-2']  = $values['preferred_time_2'];
	$values['preferred-date-3']  = $values['preferred_date_3'];
	$values['preferred-time-3']  = $values['preferred_time_3'];
	$values['body']              = $values['message'];
	$values['request-number']    = buybuycoms_hobby_contact_next_request_number();
	$values['detail']            = buybuycoms_hobby_contact_replace_placeholders( $settings[ $detail_template_key ], $values );

	$headers  = array( 'Content-Type: text/plain; charset=UTF-8', 'Reply-To: ' . $values['email'] );
	add_filter( 'wp_mail_from_name', 'buybuycoms_hobby_contact_auto_reply_from_name' );
	$sent     = wp_mail(
		$settings['recipient'],
		buybuycoms_hobby_contact_replace_placeholders( $settings['admin_subject'], $values ),
		buybuycoms_hobby_contact_replace_placeholders( $settings['admin_body'], $values ),
		$headers
	);

	if ( ! $sent ) {
		remove_filter( 'wp_mail_from_name', 'buybuycoms_hobby_contact_auto_reply_from_name' );
		buybuycoms_hobby_contact_redirect_error( 'error' );
	}

	set_transient( $rate_key, (int) get_transient( $rate_key ) + 1, 10 * MINUTE_IN_SECONDS );
	wp_mail(
		$values['email'],
		buybuycoms_hobby_contact_replace_placeholders( $settings['auto_reply_subject'], $values ),
		buybuycoms_hobby_contact_replace_placeholders( $settings['auto_reply_body'], $values ),
		array( 'Content-Type: text/plain; charset=UTF-8' )
	);
	remove_filter( 'wp_mail_from_name', 'buybuycoms_hobby_contact_auto_reply_from_name' );

	$redirect = (int) $settings['redirect_page_id'] ? get_permalink( (int) $settings['redirect_page_id'] ) : buybuycoms_hobby_thanks_page_url();
	wp_safe_redirect( add_query_arg( 'contact_status', 'sent', $redirect ? $redirect : buybuycoms_hobby_contact_page_url() ), 303 );
	exit;
}
add_action( 'admin_post_nopriv_buybuycoms_hobby_contact', 'buybuycoms_hobby_handle_contact_form' );
add_action( 'admin_post_buybuycoms_hobby_contact', 'buybuycoms_hobby_handle_contact_form' );
