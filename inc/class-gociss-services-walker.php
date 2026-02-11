<?php
/**
 * Кастомный Walker для меню услуг (синяя панель)
 *
 * Выводит плоские <a> теги вместо стандартной <ul><li> структуры.
 * Поддерживает иконки через CSS-классы пунктов меню:
 *   icon-ham, icon-iso, icon-grad, icon-pack, icon-user, icon-file
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Walker для синего меню услуг в header
 */
class Gociss_Services_Walker extends Walker_Nav_Menu {

	/**
	 * Карта CSS-классов → файлов иконок
	 *
	 * @var array
	 */
	private $icon_map = array(
		'icon-ham'  => 'ui_ham[white].svg',
		'icon-iso'  => 'ui_iso[white].svg',
		'icon-grad' => 'ui_grad[white].svg',
		'icon-pack' => 'ui_pack[white].svg',
		'icon-user' => 'ui_user[white].svg',
		'icon-file' => 'ui_file[white].svg',
	);

	/**
	 * Не выводим открывающий <ul> для подменю — подменю не поддерживается
	 */
	public function start_lvl( &$output, $depth = 0, $args = null ) {}

	/**
	 * Не выводим закрывающий </ul> для подменю
	 */
	public function end_lvl( &$output, $depth = 0, $args = null ) {}

	/**
	 * Выводим пункт меню как <a> тег
	 *
	 * @param string   $output HTML-вывод.
	 * @param WP_Post  $item   Объект пункта меню.
	 * @param int      $depth  Глубина вложенности.
	 * @param stdClass $args   Аргументы wp_nav_menu().
	 * @param int      $id     ID элемента.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		// Только верхний уровень
		if ( $depth > 0 ) {
			return;
		}

		$args = (object) $args;

		// CSS-классы из настроек wp_nav_menu() — для разных вариантов (десктоп / мобайл)
		$link_class = isset( $args->link_class ) ? $args->link_class : 'header-services__item';
		$icon_class = isset( $args->icon_class ) ? $args->icon_class : 'header-services__icon';
		$text_class = isset( $args->text_class ) ? $args->text_class : 'header-services__text';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		// Определяем иконку по CSS-классу пункта меню
		$icon_file = '';
		foreach ( $this->icon_map as $css_class => $file ) {
			if ( in_array( $css_class, $classes, true ) ) {
				$icon_file = $file;
				break;
			}
		}

		// Дополнительный CSS-класс для пункта «Все услуги» (с icon-ham)
		$extra_class = '';
		if ( in_array( 'icon-ham', $classes, true ) ) {
			$extra_class = ' ' . $link_class . '--all';
		}

		// Собираем HTML
		$output .= '<a href="' . esc_url( $item->url ) . '" class="' . esc_attr( $link_class . $extra_class ) . '">';

		if ( $icon_file ) {
			$output .= '<img src="' . esc_url( get_template_directory_uri() . '/assets/images/' . $icon_file ) . '" alt="" class="' . esc_attr( $icon_class ) . '" width="16" height="16">';
		}

		if ( $text_class ) {
			$output .= '<span class="' . esc_attr( $text_class ) . '">' . esc_html( $item->title ) . '</span>';
		} else {
			$output .= '<span>' . esc_html( $item->title ) . '</span>';
		}

		$output .= '</a>';
	}

	/**
	 * Не выводим закрывающий тег — всё закрыто в start_el
	 */
	public function end_el( &$output, $item, $depth = 0, $args = null ) {}
}
