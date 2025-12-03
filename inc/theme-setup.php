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

	// Поддержка кастомного логотипа
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 100,
			'width'       => 400,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	// Кастомные размеры изображений
	add_image_size( 'gociss-hero', 1200, 600, true );
	add_image_size( 'gociss-service', 400, 300, true );
	add_image_size( 'gociss-expert', 300, 300, true );
	add_image_size( 'gociss-news', 600, 400, true );

	// Регистрация меню
	register_nav_menus(
		array(
			'primary'        => esc_html__( 'Основное меню', 'gociss' ),
			'footer'         => esc_html__( 'Меню в футере', 'gociss' ),
			'footer-services' => esc_html__( 'Футер: Услуги', 'gociss' ),
			'footer-info'    => esc_html__( 'Футер: Информация', 'gociss' ),
			'footer-company' => esc_html__( 'Футер: Компания', 'gociss' ),
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
 * Отключение проверки обновлений WordPress (для локальной разработки)
 * Убирает предупреждения о подключении к WordPress.org
 */
function gociss_disable_update_checks() {
	// Отключаем проверку обновлений WordPress
	remove_action( 'admin_init', '_maybe_update_core' );
	remove_action( 'admin_init', '_maybe_update_plugins' );
	remove_action( 'admin_init', '_maybe_update_themes' );

	// Отключаем автоматические проверки обновлений
	add_filter( 'pre_site_transient_update_core', '__return_null' );
	add_filter( 'pre_site_transient_update_plugins', '__return_null' );
	add_filter( 'pre_site_transient_update_themes', '__return_null' );
}
add_action( 'admin_init', 'gociss_disable_update_checks', 1 );

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

/**
 * Разрешение загрузки SVG файлов
 */
function gociss_mime_types( $mimes ) {
	$mimes['svg']  = 'image/svg+xml';
	$mimes['svgz'] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'upload_mimes', 'gociss_mime_types' );

/**
 * Исправление отображения SVG в медиабиблиотеке
 */
function gociss_fix_svg_thumb_display() {
	?>
	<style>
		.attachment-266x266,
		.thumbnail img {
			width: 100% !important;
			height: auto !important;
		}
		.media-icon img[src$=".svg"] {
			width: 100%;
			height: auto;
		}
	</style>
	<?php
}
add_action( 'admin_head', 'gociss_fix_svg_thumb_display' );

/**
 * Санитизация SVG файлов для безопасности
 */
function gociss_sanitize_svg( $file ) {
	if ( $file['type'] === 'image/svg+xml' ) {
		$svg_content = file_get_contents( $file['tmp_name'] );

		// Удаляем потенциально опасные элементы
		$dangerous_tags = array( 'script', 'iframe', 'object', 'embed', 'link' );
		foreach ( $dangerous_tags as $tag ) {
			$svg_content = preg_replace( '/<' . $tag . '[^>]*>.*?<\/' . $tag . '>/is', '', $svg_content );
		}

		// Удаляем опасные атрибуты
		$svg_content = preg_replace( '/on\w+\s*=\s*["\'][^"\']*["\']/i', '', $svg_content );

		file_put_contents( $file['tmp_name'], $svg_content );
	}

	return $file;
}
add_filter( 'wp_handle_upload_prefilter', 'gociss_sanitize_svg' );

/**
 * Исправление прав доступа к директории uploads
 * Обеспечивает возможность создания поддиректорий WordPress
 */
function gociss_fix_uploads_permissions() {
	$upload_dir = wp_upload_dir();
	$base_dir = $upload_dir['basedir'];

	// Убеждаемся, что базовая директория существует и имеет правильные права
	if ( ! file_exists( $base_dir ) ) {
		wp_mkdir_p( $base_dir );
	}

	// Устанавливаем права на запись для директории uploads
	if ( file_exists( $base_dir ) ) {
		@chmod( $base_dir, 0755 );
	}
}
add_action( 'admin_init', 'gociss_fix_uploads_permissions' );

