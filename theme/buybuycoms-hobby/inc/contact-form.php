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
		'admin_subject'    => '[site_name] お問い合わせ',
		'admin_body'       => "お問い合わせを受け付けました。\n\nお名前：[customer-name]\nメールアドレス：[mailaddress]\n住所：[address]\n電話番号：[telephone]\n買取方法：[inq-type]\n買取点数・物量：[purchase-quantity]\nダンボールの準備：[box-preparation]\n希望ダンボール：Sサイズ：[box-s] / Mサイズ：[box-m] / Lサイズ：[box-l] / LLサイズ：[box-ll]\n第1希望日：[preferred-date-1]\n第1希望時間：[preferred-time-1]\n第2希望日：[preferred-date-2]\n第2希望時間：[preferred-time-2]\n第3希望日：[preferred-date-3]\n第3希望時間：[preferred-time-3]\n\nお問い合わせ内容：\n[body]",
		'auto_reply_subject' => '[site_name] お問い合わせありがとうございます',
		'auto_reply_body'  => "[customer-name]様\n\nお問い合わせありがとうございます。\n内容を確認のうえ、担当者よりご連絡いたします。\n\n--------------------\nお名前：[customer-name]\nメールアドレス：[mailaddress]\n電話番号：[telephone]\n住所：[address]\n買取方法：[inq-type]\n\nお問い合わせ内容\n[body]",
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

	if ( ! isset( $saved['auto_reply_body'] ) && isset( $saved['auto_reply'] ) && is_string( $saved['auto_reply'] ) ) {
		$saved['auto_reply_body'] = $saved['auto_reply'];
	}
	if ( isset( $saved['admin_body'] ) && $legacy_admin_body === str_replace( "\r\n", "\n", $saved['admin_body'] ) ) {
		unset( $saved['admin_body'] );
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

	if ( ! is_email( $recipient ) ) {
		add_settings_error( 'buybuycoms_hobby_contact_settings', 'invalid-recipient', __( '送信先メールアドレスを正しく入力してください。', 'buybuycoms-hobby' ) );
		$recipient = $defaults['recipient'];
	}

	return array(
		'recipient'          => $recipient,
		'admin_subject'      => isset( $settings['admin_subject'] ) ? sanitize_text_field( wp_unslash( $settings['admin_subject'] ) ) : $defaults['admin_subject'],
		'admin_body'         => isset( $settings['admin_body'] ) ? sanitize_textarea_field( wp_unslash( $settings['admin_body'] ) ) : $defaults['admin_body'],
		'auto_reply_subject' => isset( $settings['auto_reply_subject'] ) ? sanitize_text_field( wp_unslash( $settings['auto_reply_subject'] ) ) : $defaults['auto_reply_subject'],
		'auto_reply_body'    => isset( $settings['auto_reply_body'] ) ? sanitize_textarea_field( wp_unslash( $settings['auto_reply_body'] ) ) : $defaults['auto_reply_body'],
		'redirect_page_id' => isset( $settings['redirect_page_id'] ) ? (string) absint( $settings['redirect_page_id'] ) : '',
	);
}

/**
 * Add the contact-form settings page.
 *
 * @return void
 */
function buybuycoms_hobby_add_contact_settings_page() {
	add_menu_page(
		__( 'お問い合わせフォーム', 'buybuycoms-hobby' ),
		__( 'お問い合わせフォーム', 'buybuycoms-hobby' ),
		'manage_options',
		'buybuycoms-hobby-contact',
		'buybuycoms_hobby_render_contact_settings_page',
		'dashicons-email-alt',
		59
	);
}
add_action( 'admin_menu', 'buybuycoms_hobby_add_contact_settings_page' );

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
					<th scope="row"><label for="hb-contact-admin-body"><?php esc_html_e( '管理者宛メールの本文', 'buybuycoms-hobby' ); ?></label></th>
					<td>
						<?php buybuycoms_hobby_contact_render_mail_tags(); ?>
						<textarea class="large-text" id="hb-contact-admin-body" name="buybuycoms_hobby_contact_settings[admin_body]" rows="14" required><?php echo esc_textarea( $settings['admin_body'] ); ?></textarea>
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
 * Return a string length without requiring a specific WordPress version.
 *
 * @param string $value Text to measure.
 * @return int
 */
function buybuycoms_hobby_contact_string_length( $value ) {
	return function_exists( 'mb_strlen' ) ? mb_strlen( $value, 'UTF-8' ) : strlen( $value );
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
		'address'       => sanitize_text_field( buybuycoms_hobby_contact_post_value( $raw, 'customer_address' ) ),
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
		'' === $values['address'] || buybuycoms_hobby_contact_string_length( $values['address'] ) > 255 ||
		! preg_match( '/^0\\d{9,10}$/', $telephone ) ||
		buybuycoms_hobby_contact_string_length( $values['message'] ) > 4000 ||
		'agree' !== buybuycoms_hobby_contact_post_value( $raw, 'agreement' )
	) {
		buybuycoms_hobby_contact_redirect_error( 'error' );
	}
	$values['tel'] = $telephone;
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

	$details = array();
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

	$labels = array( 'takuhai' => '宅配買取', 'shuccho' => '出張買取', 'mochikomi' => '持込買取' );
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

	$settings = buybuycoms_hobby_contact_settings();
	$headers  = array( 'Content-Type: text/plain; charset=UTF-8', 'Reply-To: ' . $values['email'] );
	$sent     = wp_mail(
		$settings['recipient'],
		buybuycoms_hobby_contact_replace_placeholders( $settings['admin_subject'], $values ),
		buybuycoms_hobby_contact_replace_placeholders( $settings['admin_body'], $values ),
		$headers
	);

	if ( ! $sent ) {
		buybuycoms_hobby_contact_redirect_error( 'error' );
	}

	set_transient( $rate_key, (int) get_transient( $rate_key ) + 1, 10 * MINUTE_IN_SECONDS );
	wp_mail(
		$values['email'],
		buybuycoms_hobby_contact_replace_placeholders( $settings['auto_reply_subject'], $values ),
		buybuycoms_hobby_contact_replace_placeholders( $settings['auto_reply_body'], $values ),
		array( 'Content-Type: text/plain; charset=UTF-8' )
	);

	$redirect = (int) $settings['redirect_page_id'] ? get_permalink( (int) $settings['redirect_page_id'] ) : buybuycoms_hobby_contact_page_url();
	wp_safe_redirect( add_query_arg( 'contact_status', 'sent', $redirect ? $redirect : buybuycoms_hobby_contact_page_url() ), 303 );
	exit;
}
add_action( 'admin_post_nopriv_buybuycoms_hobby_contact', 'buybuycoms_hobby_handle_contact_form' );
add_action( 'admin_post_buybuycoms_hobby_contact', 'buybuycoms_hobby_handle_contact_form' );
