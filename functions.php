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
define( 'GOCISS_THEME_VERSION', '1.0.0' );
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

