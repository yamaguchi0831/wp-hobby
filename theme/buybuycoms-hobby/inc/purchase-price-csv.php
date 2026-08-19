<?php
/**
 * Purchase-price CSV export and bulk update.
 *
 * @package BuyBuyComs_Hobby
 */

/**
 * Return the required CSV columns.
 *
 * @return array<int, string>
 */
function buybuycoms_hobby_purchase_price_csv_columns() {
	return array(
		'post_id',
		'title',
		'genre',
		'product-buying-flag',
		'product-min-price',
		'product-max-price',
	);
}

/**
 * Return stable, human-readable genre names for a purchase-price post.
 *
 * @param int $post_id Purchase-price post ID.
 * @return string
 */
function buybuycoms_hobby_purchase_price_csv_genres( $post_id ) {
	$terms = get_the_terms( $post_id, 'genre' );

	if ( ! is_array( $terms ) ) {
		return '';
	}

	$names = wp_list_pluck( $terms, 'name' );
	sort( $names, SORT_NATURAL | SORT_FLAG_CASE );

	return implode( ' | ', $names );
}

/**
 * Resolve a CSV genre value to existing genre term IDs.
 *
 * @param string $value         Pipe-delimited genre names.
 * @param bool   $allow_empty   Whether an empty genre is allowed.
 * @return array<int, int>|WP_Error
 */
function buybuycoms_hobby_purchase_price_csv_genre_ids( $value, $allow_empty = false ) {
	$value = trim( $value );

	if ( '' === $value ) {
		return $allow_empty ? array() : new WP_Error( 'genre_required', __( '新規作成ではgenreを1つ以上指定してください。', 'buybuycoms-hobby' ) );
	}

	$names    = array_values( array_unique( array_filter( array_map( 'trim', explode( '|', $value ) ) ) ) );
	$term_ids = array();
	foreach ( $names as $name ) {
		$term = get_term_by( 'name', $name, 'genre' );
		if ( ! $term instanceof WP_Term ) {
			return new WP_Error( 'genre_not_found', sprintf( __( 'genre「%s」が見つかりません。', 'buybuycoms-hobby' ), $name ) );
		}
		$term_ids[] = (int) $term->term_id;
	}

	return $term_ids;
}

/**
 * Add the purchase-price CSV management page.
 *
 * @return void
 */
function buybuycoms_hobby_add_purchase_price_csv_page() {
	add_menu_page(
		__( '買取価格CSV', 'buybuycoms-hobby' ),
		__( '買取価格CSV', 'buybuycoms-hobby' ),
		'manage_options',
		'buybuycoms-hobby-purchase-price-csv',
		'buybuycoms_hobby_render_purchase_price_csv_page',
		'dashicons-media-spreadsheet',
		58
	);
}
add_action( 'admin_menu', 'buybuycoms_hobby_add_purchase_price_csv_page' );

/**
 * Return the transient key used for a user's validation result.
 *
 * @param int    $user_id Current user ID.
 * @param string $token   Validation token.
 * @return string
 */
function buybuycoms_hobby_purchase_price_csv_transient_key( $user_id, $token ) {
	return 'hb_price_csv_' . absint( $user_id ) . '_' . sanitize_key( $token );
}

/**
 * Normalize a buying flag to 1 or 0.
 *
 * @param mixed $value CSV value.
 * @return string|false
 */
function buybuycoms_hobby_purchase_price_csv_flag( $value ) {
	$value = strtolower( trim( (string) $value ) );

	if ( in_array( $value, array( '1', 'true', 'yes', 'on' ), true ) ) {
		return '1';
	}
	if ( in_array( $value, array( '0', 'false', 'no', 'off', '' ), true ) ) {
		return '0';
	}

	return false;
}

/**
 * Normalize and validate a price.
 *
 * Empty prices are allowed because the frontend supports ASK.
 *
 * @param mixed $value CSV value.
 * @return int|string|WP_Error
 */
function buybuycoms_hobby_purchase_price_csv_price( $value ) {
	$value = trim( (string) $value );

	if ( '' === $value ) {
		return '';
	}

	$numeric = preg_replace( '/[,\s￥¥円]/u', '', $value );
	if ( ! is_string( $numeric ) || ! ctype_digit( $numeric ) ) {
		return new WP_Error( 'invalid_price', __( '金額は半角数字で入力してください。', 'buybuycoms-hobby' ) );
	}

	$price = (int) $numeric;
	if ( $price < 50 || $price > 10000000 ) {
		return new WP_Error( 'price_out_of_range', __( '金額は50円以上10,000,000円以下で入力してください。', 'buybuycoms-hobby' ) );
	}

	return $price;
}

/**
 * Convert an uploaded CSV cell to UTF-8.
 *
 * @param string $value Cell value.
 * @return string
 */
function buybuycoms_hobby_purchase_price_csv_to_utf8( $value ) {
	$value = (string) $value;

	if ( function_exists( 'mb_check_encoding' ) && ! mb_check_encoding( $value, 'UTF-8' ) && function_exists( 'mb_convert_encoding' ) ) {
		$value = mb_convert_encoding( $value, 'UTF-8', 'SJIS-win' );
	}

	return $value;
}

/**
 * Return a CSV text length without requiring mbstring.
 *
 * @param string $value Text to measure.
 * @return int
 */
function buybuycoms_hobby_purchase_price_csv_string_length( $value ) {
	return function_exists( 'mb_strlen' ) ? mb_strlen( $value, 'UTF-8' ) : strlen( $value );
}

/**
 * Parse and validate an uploaded purchase-price CSV.
 *
 * @param string $file_path Uploaded temporary file.
 * @return array{rows: array<int, array<string, mixed>>, errors: array<int, string>}
 */
function buybuycoms_hobby_validate_purchase_price_csv( $file_path ) {
	$rows   = array();
	$errors = array();
	$handle = fopen( $file_path, 'rb' ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_operations_fopen

	if ( false === $handle ) {
		return array( 'rows' => array(), 'errors' => array( __( 'CSVファイルを読み込めませんでした。', 'buybuycoms-hobby' ) ) );
	}

	$header = fgetcsv( $handle );
	if ( false === $header ) {
		fclose( $handle ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_operations_fclose
		return array( 'rows' => array(), 'errors' => array( __( 'CSVファイルが空です。', 'buybuycoms-hobby' ) ) );
	}

	$header = array_map( 'buybuycoms_hobby_purchase_price_csv_to_utf8', $header );
	$header[0] = preg_replace( '/^\xEF\xBB\xBF/', '', $header[0] );
	if ( buybuycoms_hobby_purchase_price_csv_columns() !== $header ) {
		$errors[] = __( 'CSVの見出しが正しくありません。管理画面からダウンロードしたCSVを使用してください。', 'buybuycoms-hobby' );
	}

	$seen_ids = array();
	$seen_new_titles = array();
	$line     = 1;
	while ( false !== ( $csv_row = fgetcsv( $handle ) ) ) {
		$line++;
		if ( 5001 < $line ) {
			$errors[] = __( '一度に更新できるデータは5,000件までです。', 'buybuycoms-hobby' );
			break;
		}

		$csv_row = array_map( 'buybuycoms_hobby_purchase_price_csv_to_utf8', $csv_row );
		if ( 1 === count( $csv_row ) && '' === trim( $csv_row[0] ) ) {
			continue;
		}
		if ( count( buybuycoms_hobby_purchase_price_csv_columns() ) !== count( $csv_row ) ) {
			$errors[] = sprintf( __( '%d行目: 列数が正しくありません。', 'buybuycoms-hobby' ), $line );
			continue;
		}

		$data          = array_combine( buybuycoms_hobby_purchase_price_csv_columns(), $csv_row );
		$post_id_value = trim( $data['post_id'] );
		$is_new        = '' === $post_id_value;
		$post_id       = $is_new ? 0 : absint( $post_id_value );
		$title         = trim( $data['title'] );
		$genre         = trim( $data['genre'] );
		$genre_ids     = buybuycoms_hobby_purchase_price_csv_genre_ids( $genre, ! $is_new );

		if ( '' === $title || 200 < buybuycoms_hobby_purchase_price_csv_string_length( $title ) ) {
			$errors[] = sprintf( __( '%d行目: タイトルは1文字以上200文字以下で入力してください。', 'buybuycoms-hobby' ), $line );
			continue;
		}
		if ( is_wp_error( $genre_ids ) ) {
			$errors[] = sprintf( __( '%1$d行目: %2$s', 'buybuycoms-hobby' ), $line, $genre_ids->get_error_message() );
			continue;
		}

		if ( $is_new ) {
			$title_key = function_exists( 'mb_strtolower' ) ? mb_strtolower( $title, 'UTF-8' ) : strtolower( $title );
			if ( isset( $seen_new_titles[ $title_key ] ) ) {
				$errors[] = sprintf( __( '%d行目: 新規作成するタイトル「%s」がCSV内で重複しています。', 'buybuycoms-hobby' ), $line, $title );
				continue;
			}
			$existing = get_posts(
				array(
					'post_type'      => 'purchase-price',
					'post_status'    => 'any',
					'posts_per_page' => 1,
					'title'          => $title,
					'fields'         => 'ids',
				)
			);
			if ( ! empty( $existing ) ) {
				$errors[] = sprintf( __( '%d行目: 同じタイトルのpurchase-priceが既に存在します。', 'buybuycoms-hobby' ), $line );
				continue;
			}
			$seen_new_titles[ $title_key ] = true;
		} else {
			if ( ! ctype_digit( $post_id_value ) ) {
				$errors[] = sprintf( __( '%d行目: post_idは半角数字または新規作成用の空欄にしてください。', 'buybuycoms-hobby' ), $line );
				continue;
			}
			$post = $post_id ? get_post( $post_id ) : null;
			if ( ! $post || 'purchase-price' !== $post->post_type ) {
				$errors[] = sprintf( __( '%d行目: purchase-priceの投稿IDが見つかりません。', 'buybuycoms-hobby' ), $line );
				continue;
			}
			if ( isset( $seen_ids[ $post_id ] ) ) {
				$errors[] = sprintf( __( '%d行目: 投稿ID %d が重複しています。', 'buybuycoms-hobby' ), $line, $post_id );
				continue;
			}
			$seen_ids[ $post_id ] = true;
			if ( $post->post_title !== $title ) {
				$errors[] = sprintf( __( '%d行目: 投稿ID %d のタイトルがデータベースと一致しません。', 'buybuycoms-hobby' ), $line, $post_id );
				continue;
			}
			if ( buybuycoms_hobby_purchase_price_csv_genres( $post_id ) !== $genre ) {
				$errors[] = sprintf( __( '%d行目: 投稿ID %d のgenreがデータベースと一致しません。', 'buybuycoms-hobby' ), $line, $post_id );
				continue;
			}
		}

		$flag = buybuycoms_hobby_purchase_price_csv_flag( $data['product-buying-flag'] );
		if ( false === $flag ) {
			$errors[] = sprintf( __( '%d行目: product-buying-flag は1または0で入力してください。', 'buybuycoms-hobby' ), $line );
			continue;
		}

		$min_price = buybuycoms_hobby_purchase_price_csv_price( $data['product-min-price'] );
		$max_price = buybuycoms_hobby_purchase_price_csv_price( $data['product-max-price'] );
		if ( is_wp_error( $min_price ) ) {
			$errors[] = sprintf( __( '%1$d行目 product-min-price: %2$s', 'buybuycoms-hobby' ), $line, $min_price->get_error_message() );
			continue;
		}
		if ( is_wp_error( $max_price ) ) {
			$errors[] = sprintf( __( '%1$d行目 product-max-price: %2$s', 'buybuycoms-hobby' ), $line, $max_price->get_error_message() );
			continue;
		}
		if ( '' !== $min_price && '' !== $max_price && $min_price > $max_price ) {
			$errors[] = sprintf( __( '%d行目: 最小価格が最大価格を超えています。', 'buybuycoms-hobby' ), $line );
			continue;
		}

		$rows[] = array(
			'action'             => $is_new ? 'create' : 'update',
			'post_id'            => $post_id,
			'title'              => $title,
			'genre'              => $genre,
			'genre_ids'          => $genre_ids,
			'flag'               => $flag,
			'min_price'          => $min_price,
			'max_price'          => $max_price,
			'original_flag'      => $is_new ? '' : (string) get_post_meta( $post_id, 'product-buying-flag', true ),
			'original_min_price' => $is_new ? '' : (string) get_post_meta( $post_id, 'product-min-price', true ),
			'original_max_price' => $is_new ? '' : (string) get_post_meta( $post_id, 'product-max-price', true ),
		);
	}
	fclose( $handle ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_operations_fclose

	if ( empty( $rows ) && empty( $errors ) ) {
		$errors[] = __( '更新対象のデータがありません。', 'buybuycoms-hobby' );
	}

	return array( 'rows' => $rows, 'errors' => $errors );
}

/**
 * Export all purchase-price posts as a UTF-8 BOM CSV.
 *
 * @return never
 */
function buybuycoms_hobby_download_purchase_price_csv() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'この操作を実行する権限がありません。', 'buybuycoms-hobby' ) );
	}
	check_admin_referer( 'buybuycoms_hobby_download_purchase_price_csv' );

	$posts = get_posts(
		array(
			'post_type'      => 'purchase-price',
			'post_status'    => array( 'publish', 'draft', 'pending', 'private' ),
			'posts_per_page' => -1,
			'orderby'        => 'ID',
			'order'          => 'ASC',
		)
	);

	nocache_headers();
	header( 'Content-Type: text/csv; charset=UTF-8' );
	header( 'Content-Disposition: attachment; filename="purchase-price-' . gmdate( 'Ymd-His' ) . '.csv"' );

	$output = fopen( 'php://output', 'wb' ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_operations_fopen
	fwrite( $output, "\xEF\xBB\xBF" ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_operations_fwrite
	fputcsv( $output, buybuycoms_hobby_purchase_price_csv_columns() );
	foreach ( $posts as $post ) {
		fputcsv(
			$output,
			array(
				$post->ID,
				$post->post_title,
				buybuycoms_hobby_purchase_price_csv_genres( $post->ID ),
				buybuycoms_hobby_purchase_price_csv_flag( get_post_meta( $post->ID, 'product-buying-flag', true ) ) ? '1' : '0',
				get_post_meta( $post->ID, 'product-min-price', true ),
				get_post_meta( $post->ID, 'product-max-price', true ),
			)
		);
	}
	fclose( $output ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_operations_fclose
	exit;
}
add_action( 'admin_post_buybuycoms_hobby_download_purchase_price_csv', 'buybuycoms_hobby_download_purchase_price_csv' );

/**
 * Validate an uploaded CSV and redirect to the preview page.
 *
 * @return never
 */
function buybuycoms_hobby_upload_purchase_price_csv() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'この操作を実行する権限がありません。', 'buybuycoms-hobby' ) );
	}
	check_admin_referer( 'buybuycoms_hobby_upload_purchase_price_csv' );

	$file      = isset( $_FILES['purchase_price_csv'] ) && is_array( $_FILES['purchase_price_csv'] ) ? $_FILES['purchase_price_csv'] : array(); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
	$temp_name = isset( $file['tmp_name'] ) && is_string( $file['tmp_name'] ) ? $file['tmp_name'] : '';
	$file_name = isset( $file['name'] ) && is_string( $file['name'] ) ? sanitize_file_name( wp_unslash( $file['name'] ) ) : '';
	if ( UPLOAD_ERR_OK !== ( $file['error'] ?? UPLOAD_ERR_NO_FILE ) || '' === $temp_name || ! is_uploaded_file( $temp_name ) ) {
		wp_safe_redirect( add_query_arg( 'csv_status', 'upload_error', admin_url( 'admin.php?page=buybuycoms-hobby-purchase-price-csv' ) ) );
		exit;
	}
	if ( 'csv' !== strtolower( pathinfo( $file_name, PATHINFO_EXTENSION ) ) ) {
		wp_safe_redirect( add_query_arg( 'csv_status', 'invalid_type', admin_url( 'admin.php?page=buybuycoms-hobby-purchase-price-csv' ) ) );
		exit;
	}
	if ( (int) ( $file['size'] ?? 0 ) > 5 * MB_IN_BYTES ) {
		wp_safe_redirect( add_query_arg( 'csv_status', 'too_large', admin_url( 'admin.php?page=buybuycoms-hobby-purchase-price-csv' ) ) );
		exit;
	}

	$result = buybuycoms_hobby_validate_purchase_price_csv( $temp_name );
	$token  = wp_generate_password( 20, false, false );
	$key    = buybuycoms_hobby_purchase_price_csv_transient_key( get_current_user_id(), $token );
	set_transient( $key, $result, 30 * MINUTE_IN_SECONDS );

	wp_safe_redirect( add_query_arg( 'csv_token', $token, admin_url( 'admin.php?page=buybuycoms-hobby-purchase-price-csv' ) ) );
	exit;
}
add_action( 'admin_post_buybuycoms_hobby_upload_purchase_price_csv', 'buybuycoms_hobby_upload_purchase_price_csv' );

/**
 * Apply a previously validated CSV update.
 *
 * @return never
 */
function buybuycoms_hobby_apply_purchase_price_csv() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'この操作を実行する権限がありません。', 'buybuycoms-hobby' ) );
	}
	check_admin_referer( 'buybuycoms_hobby_apply_purchase_price_csv' );

	$token  = isset( $_POST['csv_token'] ) ? sanitize_key( wp_unslash( $_POST['csv_token'] ) ) : '';
	$key    = buybuycoms_hobby_purchase_price_csv_transient_key( get_current_user_id(), $token );
	$result = get_transient( $key );
	if ( ! is_array( $result ) || ! empty( $result['errors'] ) || empty( $result['rows'] ) ) {
		wp_safe_redirect( add_query_arg( 'csv_status', 'expired', admin_url( 'admin.php?page=buybuycoms-hobby-purchase-price-csv' ) ) );
		exit;
	}

	$updated = 0;
	$created = 0;
	foreach ( $result['rows'] as $row ) {
		if ( 'create' === $row['action'] ) {
			foreach ( $row['genre_ids'] as $term_id ) {
				if ( ! term_exists( $term_id, 'genre' ) ) {
					wp_safe_redirect( add_query_arg( 'csv_status', 'changed', admin_url( 'admin.php?page=buybuycoms-hobby-purchase-price-csv' ) ) );
					exit;
				}
			}
			$existing = get_posts( array( 'post_type' => 'purchase-price', 'post_status' => 'any', 'posts_per_page' => 1, 'title' => $row['title'], 'fields' => 'ids' ) );
			if ( ! empty( $existing ) ) {
				wp_safe_redirect( add_query_arg( 'csv_status', 'changed', admin_url( 'admin.php?page=buybuycoms-hobby-purchase-price-csv' ) ) );
				exit;
			}
			continue;
		}
		$post = get_post( $row['post_id'] );
		$data_changed =
			(string) get_post_meta( $row['post_id'], 'product-buying-flag', true ) !== $row['original_flag'] ||
			(string) get_post_meta( $row['post_id'], 'product-min-price', true ) !== $row['original_min_price'] ||
			(string) get_post_meta( $row['post_id'], 'product-max-price', true ) !== $row['original_max_price'];
		if ( ! $post || 'purchase-price' !== $post->post_type || $post->post_title !== $row['title'] || buybuycoms_hobby_purchase_price_csv_genres( $row['post_id'] ) !== $row['genre'] || $data_changed ) {
			wp_safe_redirect( add_query_arg( 'csv_status', 'changed', admin_url( 'admin.php?page=buybuycoms-hobby-purchase-price-csv' ) ) );
			exit;
		}
	}

	$created_post_ids = array();
	foreach ( $result['rows'] as $index => $row ) {
		if ( 'create' !== $row['action'] ) {
			continue;
		}
		$new_post_id = wp_insert_post(
			array(
				'post_type'   => 'purchase-price',
				'post_status' => 'publish',
				'post_title'  => sanitize_text_field( $row['title'] ),
			),
			true
		);
		if ( is_wp_error( $new_post_id ) ) {
			foreach ( $created_post_ids as $created_post_id ) {
				wp_delete_post( $created_post_id, true );
			}
			wp_safe_redirect( add_query_arg( 'csv_status', 'create_error', admin_url( 'admin.php?page=buybuycoms-hobby-purchase-price-csv' ) ) );
			exit;
		}
		$term_result = wp_set_object_terms( $new_post_id, array_map( 'absint', $row['genre_ids'] ), 'genre', false );
		if ( is_wp_error( $term_result ) ) {
			$created_post_ids[] = $new_post_id;
			foreach ( $created_post_ids as $created_post_id ) {
				wp_delete_post( $created_post_id, true );
			}
			wp_safe_redirect( add_query_arg( 'csv_status', 'create_error', admin_url( 'admin.php?page=buybuycoms-hobby-purchase-price-csv' ) ) );
			exit;
		}
		$result['rows'][ $index ]['post_id'] = $new_post_id;
		$created_post_ids[] = $new_post_id;
		$created++;
	}

	foreach ( $result['rows'] as $row ) {
		update_post_meta( $row['post_id'], 'product-buying-flag', $row['flag'] );
		update_post_meta( $row['post_id'], 'product-min-price', $row['min_price'] );
		update_post_meta( $row['post_id'], 'product-max-price', $row['max_price'] );
		if ( 'update' === $row['action'] ) {
			$updated++;
		}
	}
	delete_transient( $key );

	wp_safe_redirect( add_query_arg( array( 'csv_status' => 'updated', 'updated' => $updated, 'created' => $created ), admin_url( 'admin.php?page=buybuycoms-hobby-purchase-price-csv' ) ) );
	exit;
}
add_action( 'admin_post_buybuycoms_hobby_apply_purchase_price_csv', 'buybuycoms_hobby_apply_purchase_price_csv' );

/**
 * Render the purchase-price CSV management screen.
 *
 * @return void
 */
function buybuycoms_hobby_render_purchase_price_csv_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$status = isset( $_GET['csv_status'] ) ? sanitize_key( wp_unslash( $_GET['csv_status'] ) ) : '';
	$token  = isset( $_GET['csv_token'] ) ? sanitize_key( wp_unslash( $_GET['csv_token'] ) ) : '';
	$result = $token ? get_transient( buybuycoms_hobby_purchase_price_csv_transient_key( get_current_user_id(), $token ) ) : false;
	$download_url = wp_nonce_url(
		admin_url( 'admin-post.php?action=buybuycoms_hobby_download_purchase_price_csv' ),
		'buybuycoms_hobby_download_purchase_price_csv'
	);
	?>
	<div class="wrap">
		<h1><?php esc_html_e( '買取価格CSV一括更新', 'buybuycoms-hobby' ); ?></h1>
		<?php if ( 'updated' === $status ) : ?>
			<div class="notice notice-success"><p><?php echo esc_html( sprintf( __( '買取価格データを%d件更新し、%d件新規作成しました。', 'buybuycoms-hobby' ), absint( $_GET['updated'] ?? 0 ), absint( $_GET['created'] ?? 0 ) ) ); ?></p></div>
		<?php elseif ( 'upload_error' === $status ) : ?>
			<div class="notice notice-error"><p><?php esc_html_e( 'CSVファイルをアップロードできませんでした。', 'buybuycoms-hobby' ); ?></p></div>
		<?php elseif ( 'too_large' === $status ) : ?>
			<div class="notice notice-error"><p><?php esc_html_e( 'CSVファイルは5MB以下にしてください。', 'buybuycoms-hobby' ); ?></p></div>
		<?php elseif ( 'invalid_type' === $status ) : ?>
			<div class="notice notice-error"><p><?php esc_html_e( '拡張子が.csvのファイルを選択してください。', 'buybuycoms-hobby' ); ?></p></div>
		<?php elseif ( 'expired' === $status ) : ?>
			<div class="notice notice-error"><p><?php esc_html_e( '検証結果の有効期限が切れました。CSVを再度アップロードしてください。', 'buybuycoms-hobby' ); ?></p></div>
		<?php elseif ( 'changed' === $status ) : ?>
			<div class="notice notice-error"><p><?php esc_html_e( '検証後に対象データが変更されました。CSVを再度ダウンロードしてやり直してください。', 'buybuycoms-hobby' ); ?></p></div>
		<?php elseif ( 'create_error' === $status ) : ?>
			<div class="notice notice-error"><p><?php esc_html_e( '新規投稿を作成できませんでした。この処理中に作成した投稿は取り消しました。', 'buybuycoms-hobby' ); ?></p></div>
		<?php endif; ?>

		<h2><?php esc_html_e( '1. CSVをダウンロード', 'buybuycoms-hobby' ); ?></h2>
		<p><?php esc_html_e( '現在のpurchase-priceをUTF-8形式で出力します。既存行は金額と買取強化フラグを編集できます。投稿ID、タイトル、genreは照合用のため変更しないでください。', 'buybuycoms-hobby' ); ?></p>
		<p><a class="button button-primary" href="<?php echo esc_url( $download_url ); ?>"><?php esc_html_e( 'CSVをダウンロード', 'buybuycoms-hobby' ); ?></a></p>

		<h2><?php esc_html_e( '2. CSVを検証', 'buybuycoms-hobby' ); ?></h2>
		<p><?php esc_html_e( '新規作成する場合は行を追加し、post_idを空欄にして、タイトル、既存genre名、フラグ、価格を入力してください。複数genreは「 | 」で区切ります。新規投稿は公開状態で作成されます。', 'buybuycoms-hobby' ); ?></p>
		<p><?php esc_html_e( '空欄の価格はASKとして扱います。入力する場合は50円以上10,000,000円以下にしてください。エラーが1件でもあるCSVは更新・新規作成できません。', 'buybuycoms-hobby' ); ?></p>
		<form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" enctype="multipart/form-data" method="post">
			<input type="hidden" name="action" value="buybuycoms_hobby_upload_purchase_price_csv" />
			<?php wp_nonce_field( 'buybuycoms_hobby_upload_purchase_price_csv' ); ?>
			<input type="file" name="purchase_price_csv" accept=".csv,text/csv" required />
			<?php submit_button( __( 'アップロードして検証', 'buybuycoms-hobby' ), 'secondary', 'submit', false ); ?>
		</form>

		<?php if ( is_array( $result ) ) : ?>
			<hr />
			<h2><?php esc_html_e( '3. 検証結果', 'buybuycoms-hobby' ); ?></h2>
			<?php if ( ! empty( $result['errors'] ) ) : ?>
				<div class="notice notice-error inline">
					<p><strong><?php esc_html_e( 'CSVにエラーがあります。データベースは更新されていません。', 'buybuycoms-hobby' ); ?></strong></p>
					<ul>
						<?php foreach ( $result['errors'] as $error ) : ?><li><?php echo esc_html( $error ); ?></li><?php endforeach; ?>
					</ul>
				</div>
			<?php else : ?>
				<div class="notice notice-success inline"><p><?php echo esc_html( sprintf( __( '%d件のデータを検証しました。問題はありません。', 'buybuycoms-hobby' ), count( $result['rows'] ) ) ); ?></p></div>
				<table class="widefat striped">
					<thead><tr><th><?php esc_html_e( '処理', 'buybuycoms-hobby' ); ?></th><th><?php esc_html_e( '投稿ID', 'buybuycoms-hobby' ); ?></th><th><?php esc_html_e( 'タイトル', 'buybuycoms-hobby' ); ?></th><th><?php esc_html_e( 'genre', 'buybuycoms-hobby' ); ?></th><th><?php esc_html_e( '強化中', 'buybuycoms-hobby' ); ?></th><th><?php esc_html_e( '最小価格', 'buybuycoms-hobby' ); ?></th><th><?php esc_html_e( '最大価格', 'buybuycoms-hobby' ); ?></th></tr></thead>
					<tbody>
						<?php foreach ( array_slice( $result['rows'], 0, 100 ) as $row ) : ?>
							<tr><td><?php echo esc_html( 'create' === $row['action'] ? '新規' : '更新' ); ?></td><td><?php echo esc_html( $row['post_id'] ? $row['post_id'] : '新規採番' ); ?></td><td><?php echo esc_html( $row['title'] ); ?></td><td><?php echo esc_html( $row['genre'] ); ?></td><td><?php echo esc_html( '1' === $row['flag'] ? 'ON' : 'OFF' ); ?></td><td><?php echo esc_html( '' === $row['min_price'] ? 'ASK' : number_format_i18n( $row['min_price'] ) ); ?></td><td><?php echo esc_html( '' === $row['max_price'] ? 'ASK' : number_format_i18n( $row['max_price'] ) ); ?></td></tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<?php if ( count( $result['rows'] ) > 100 ) : ?><p><?php esc_html_e( '確認表には先頭100件を表示しています。確定時は検証済みの全件を更新します。', 'buybuycoms-hobby' ); ?></p><?php endif; ?>
				<form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
					<input type="hidden" name="action" value="buybuycoms_hobby_apply_purchase_price_csv" />
					<input type="hidden" name="csv_token" value="<?php echo esc_attr( $token ); ?>" />
					<?php wp_nonce_field( 'buybuycoms_hobby_apply_purchase_price_csv' ); ?>
					<?php submit_button( __( '検証済みデータをDBへ反映', 'buybuycoms-hobby' ), 'primary' ); ?>
				</form>
			<?php endif; ?>
		<?php endif; ?>
	</div>
	<?php
}
