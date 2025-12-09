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
define( 'GOCISS_THEME_VERSION', '1.1.1' );
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
