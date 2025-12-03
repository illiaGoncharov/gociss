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

