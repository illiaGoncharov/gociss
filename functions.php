<?php
/**
 * Основной файл темы ГоЦИСС
 *
 * @package Gociss
 */

// Безопасность: предотвращаем прямой доступ
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Константы темы
define( 'GOCISS_THEME_VERSION', '1.2.5' );

// Временный код для сброса rewrite rules (удалить после первой загрузки)
if ( get_option( 'gociss_rewrite_version' ) !== '1.2.5' ) {
	add_action( 'init', function() {
		flush_rewrite_rules();
		update_option( 'gociss_rewrite_version', '1.2.5' );
	}, 999 );
}
define( 'GOCISS_THEME_PATH', get_template_directory() );
define( 'GOCISS_THEME_URI', get_template_directory_uri() );

/**
 * Подключение файлов темы
 */
require_once GOCISS_THEME_PATH . '/inc/theme-setup.php';
require_once GOCISS_THEME_PATH . '/inc/enqueue.php';
require_once GOCISS_THEME_PATH . '/inc/acf-fields.php';
require_once GOCISS_THEME_PATH . '/inc/custom-post-types.php';
require_once GOCISS_THEME_PATH . '/inc/form-handler.php';
require_once GOCISS_THEME_PATH . '/inc/create-front-page.php';
require_once GOCISS_THEME_PATH . '/inc/certificate-handler.php';
require_once GOCISS_THEME_PATH . '/inc/term-order.php';
require_once GOCISS_THEME_PATH . '/inc/legal-pages.php';
require_once GOCISS_THEME_PATH . '/inc/faq-helpers.php';
require_once GOCISS_THEME_PATH . '/inc/class-gociss-services-walker.php';
require_once GOCISS_THEME_PATH . '/inc/forms-options-page.php';

/**
 * Отключение проверки обновлений WordPress для локальной разработки
 * Убирает предупреждения о невозможности подключения к WordPress.org
 */
add_filter( 'pre_site_transient_update_core', '__return_null' );
add_filter( 'pre_site_transient_update_plugins', '__return_null' );
add_filter( 'pre_site_transient_update_themes', '__return_null' );
add_filter( 'automatic_updater_disabled', '__return_true' );
add_filter( 'auto_update_core', '__return_false' );
add_filter( 'wp_auto_update_core', '__return_false' );
add_filter( 'allow_major_auto_core_updates', '__return_false' );
add_filter( 'allow_minor_auto_core_updates', '__return_false' );
add_filter( 'allow_dev_auto_core_updates', '__return_false' );

/**
 * Подключение скриптов и стилей для админки
 */
function gociss_admin_enqueue( $hook ) {
	// Только на страницах редактирования
	if ( ! in_array( $hook, array( 'post.php', 'post-new.php' ), true ) ) {
		return;
	}

	wp_enqueue_style(
		'gociss-admin-css',
		GOCISS_THEME_URI . '/assets/css/admin.css',
		array(),
		GOCISS_THEME_VERSION
	);

	wp_enqueue_script(
		'gociss-admin-js',
		GOCISS_THEME_URI . '/assets/js/admin.js',
		array( 'jquery' ),
		GOCISS_THEME_VERSION,
		true
	);
}
add_action( 'admin_enqueue_scripts', 'gociss_admin_enqueue' );

/**
 * Редирект страницы "Блог" на архив статей
 */
function gociss_redirect_blog_to_articles() {
	if ( is_page( 'blog' ) ) {
		$articles_url = get_post_type_archive_link( 'gociss_article' );
		if ( $articles_url ) {
			wp_safe_redirect( $articles_url, 301 );
			exit;
		}
	}
}
add_action( 'template_redirect', 'gociss_redirect_blog_to_articles' );

/**
 * Принудительная загрузка шаблона для страницы реестра
 */
function gociss_force_reestr_template( $template ) {
	global $post;

	// Проверяем по slug
	if ( is_page( 'reestr' ) || is_page( 'reestry' ) ) {
		$new_template = locate_template( array( 'page-reestr.php' ) );
		if ( ! empty( $new_template ) ) {
			return $new_template;
		}
	}

	// Проверяем по post_name (slug) напрямую
	if ( is_page() && $post ) {
		$slug = $post->post_name;
		if ( in_array( $slug, array( 'reestr', 'reestry', 'реестры', 'реестр' ), true ) ) {
			$new_template = locate_template( array( 'page-reestr.php' ) );
			if ( ! empty( $new_template ) ) {
				return $new_template;
			}
		}
	}

	// Проверяем для предпросмотра
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended
	if ( isset( $_GET['preview'] ) && isset( $_GET['preview_id'] ) ) {
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$preview_id = intval( $_GET['preview_id'] );
		$preview_post = get_post( $preview_id );
		if ( $preview_post && $preview_post->post_type === 'page' ) {
			$slug = $preview_post->post_name;
			if ( in_array( $slug, array( 'reestr', 'reestry', 'реестры', 'реестр' ), true ) ) {
				$new_template = locate_template( array( 'page-reestr.php' ) );
				if ( ! empty( $new_template ) ) {
					return $new_template;
				}
			}
		}
	}

	return $template;
}
add_filter( 'template_include', 'gociss_force_reestr_template', 99 );
