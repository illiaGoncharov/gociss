<?php
/**
 * Подключение стилей и скриптов
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Подключение стилей
 */
function gociss_enqueue_styles() {
	// Основной стиль темы
	wp_enqueue_style(
		'gociss-style',
		GOCISS_THEME_URI . '/assets/css/style.css',
		array(),
		GOCISS_THEME_VERSION
	);
}
add_action( 'wp_enqueue_scripts', 'gociss_enqueue_styles' );

/**
 * Подключение скриптов
 */
function gociss_enqueue_scripts() {
	// Основной скрипт темы
	wp_enqueue_script(
		'gociss-script',
		GOCISS_THEME_URI . '/assets/js/main.js',
		array(),
		GOCISS_THEME_VERSION,
		true
	);

	// Локализация для AJAX
	wp_localize_script(
		'gociss-script',
		'gocissAjax',
		array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'gociss-nonce' ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'gociss_enqueue_scripts' );

/**
 * Подключение стилей и скриптов в админке
 */
function gociss_admin_enqueue_scripts( $hook ) {
	// Подключаем стили для админки
	wp_enqueue_style(
		'gociss-admin-style',
		GOCISS_THEME_URI . '/assets/css/admin.css',
		array(),
		GOCISS_THEME_VERSION
	);

	// Подключаем jQuery UI Sortable для drag-and-drop
	wp_enqueue_script( 'jquery-ui-sortable' );

	// Подключаем админ скрипт
	wp_enqueue_script(
		'gociss-admin-script',
		GOCISS_THEME_URI . '/assets/js/admin.js',
		array( 'jquery', 'jquery-ui-sortable' ),
		GOCISS_THEME_VERSION,
		true
	);

	// Локализация для AJAX
	wp_localize_script(
		'gociss-admin-script',
		'gocissAdmin',
		array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'gociss-admin-nonce' ),
		)
	);
}
add_action( 'admin_enqueue_scripts', 'gociss_admin_enqueue_scripts' );

/**
 * AJAX обработчик для сохранения порядка экспертов
 */
function gociss_save_experts_order() {
	// Проверяем nonce
	if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'gociss-admin-nonce' ) ) {
		wp_send_json_error( 'Invalid nonce' );
	}

	// Проверяем права
	if ( ! current_user_can( 'edit_posts' ) ) {
		wp_send_json_error( 'Permission denied' );
	}

	// Получаем порядок
	$order = isset( $_POST['order'] ) ? $_POST['order'] : array();

	if ( empty( $order ) ) {
		wp_send_json_error( 'Empty order' );
	}

	// Сохраняем порядок для каждого эксперта
	foreach ( $order as $item ) {
		$post_id  = intval( $item['id'] );
		$position = intval( $item['position'] );

		wp_update_post(
			array(
				'ID'         => $post_id,
				'menu_order' => $position,
			)
		);

		// Также обновляем ACF поле
		if ( function_exists( 'update_field' ) ) {
			update_field( 'gociss_expert_order', $position, $post_id );
		}
	}

	wp_send_json_success( 'Order saved' );
}
add_action( 'wp_ajax_gociss_save_experts_order', 'gociss_save_experts_order' );

