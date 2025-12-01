<?php
/**
 * Автоматическое создание главной страницы при активации темы
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Создание главной страницы при активации темы
 */
function gociss_create_front_page() {
	// Проверяем, существует ли уже страница "Главная"
	$front_page = get_page_by_title( 'Главная' );

	if ( ! $front_page ) {
		// Создаём страницу "Главная"
		$page_data = array(
			'post_title'    => 'Главная',
			'post_name'     => 'glavnaya',
			'post_content'  => '',
			'post_status'   => 'publish',
			'post_type'     => 'page',
			'post_author'   => 1,
		);

		$page_id = wp_insert_post( $page_data );

		if ( $page_id ) {
			// Устанавливаем шаблон страницы
			update_post_meta( $page_id, '_wp_page_template', 'page-front.php' );

			// Устанавливаем как главную страницу
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $page_id );
		}
	} else {
		// Если страница уже существует, обновляем настройки
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page->ID );
		update_post_meta( $front_page->ID, '_wp_page_template', 'page-front.php' );
	}
}
add_action( 'after_switch_theme', 'gociss_create_front_page' );

/**
 * Создание главной страницы вручную (можно вызвать из админки)
 */
function gociss_create_front_page_manual() {
	gociss_create_front_page();
	return 'Главная страница создана!';
}

