<?php
/**
 * Google Click Identifier handling.
 *
 * @package BuyBuyComs_Hobby
 */

/**
 * Return a GCLID value safe for cookie storage and email output.
 *
 * Normal GCLID values are preserved as received. Control characters are
 * removed to prevent cookie and email-header injection.
 *
 * @param mixed $value Candidate GCLID value.
 * @return string
 */
function buybuycoms_hobby_sanitize_gclid( $value ) {
	if ( ! is_string( $value ) ) {
		return '';
	}

	$sanitized = preg_replace( '/[\r\n\x00]/', '', $value );

	return is_string( $sanitized ) ? $sanitized : '';
}

/**
 * Return the stored GCLID cookie value.
 *
 * @return string
 */
function buybuycoms_hobby_get_gclid() {
	if ( ! isset( $_COOKIE['buybuycoms_hobby_gclid'] ) || ! is_string( $_COOKIE['buybuycoms_hobby_gclid'] ) ) {
		return '';
	}

	return buybuycoms_hobby_sanitize_gclid( $_COOKIE['buybuycoms_hobby_gclid'] );
}

/**
 * Store a GCLID query parameter for 90 days when it is present.
 *
 * @return void
 */
function buybuycoms_hobby_store_gclid() {
	if ( ! isset( $_GET['gclid'] ) || ! is_string( $_GET['gclid'] ) ) {
		return;
	}

	$gclid = buybuycoms_hobby_sanitize_gclid( wp_unslash( $_GET['gclid'] ) );
	if ( '' === $gclid || headers_sent() ) {
		return;
	}

	setcookie(
		'buybuycoms_hobby_gclid',
		$gclid,
		array(
			'expires'  => time() + ( 90 * DAY_IN_SECONDS ),
			'path'     => '/',
			'secure'   => is_ssl(),
			'httponly' => false,
			'samesite' => 'Lax',
		)
	);

	$_COOKIE['buybuycoms_hobby_gclid'] = $gclid;
}
add_action( 'init', 'buybuycoms_hobby_store_gclid' );
