<?php
/**
 * Настройка темы
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Инициализация темы
 */
function gociss_theme_setup() {
	// Поддержка переводов
	load_theme_textdomain( 'gociss', GOCISS_THEME_PATH . '/languages' );

	// Поддержка автоматических title тегов
	add_theme_support( 'title-tag' );

	// Поддержка миниатюр записей
	add_theme_support( 'post-thumbnails' );

	// Кастомные размеры изображений
	add_image_size( 'gociss-hero', 1200, 600, true );
	add_image_size( 'gociss-service', 400, 300, true );
	add_image_size( 'gociss-expert', 300, 300, true );
	add_image_size( 'gociss-news', 600, 400, true );

	// Регистрация меню
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Основное меню', 'gociss' ),
			'footer'  => esc_html__( 'Меню в футере', 'gociss' ),
		)
	);

	// Поддержка HTML5
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Отключение Gutenberg
	add_filter( 'use_block_editor_for_post', '__return_false', 10 );
	add_filter( 'use_block_editor_for_post_type', '__return_false', 10 );

	// Отключение стилей Gutenberg
	add_action( 'wp_enqueue_scripts', 'gociss_disable_gutenberg_styles', 100 );
}
add_action( 'after_setup_theme', 'gociss_theme_setup' );

/**
 * Отключение стилей Gutenberg
 */
function gociss_disable_gutenberg_styles() {
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'wc-block-style' );
}

/**
 * Настройка ширины контента
 */
function gociss_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'gociss_content_width', 1200 );
}
add_action( 'after_setup_theme', 'gociss_content_width', 0 );



