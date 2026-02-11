<?php
/**
 * Хелпер-функции для FAQ
 *
 * Утилитарные функции для работы с FAQ записями.
 * Привязка FAQ к страницам осуществляется через ACF Relationship-поле.
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Получить массив FAQ-элементов из массива WP_Post объектов
 *
 * Используется для преобразования результата get_field() (Relationship)
 * в унифицированный формат ['question' => ..., 'answer' => ...].
 *
 * @param array|null $posts Массив WP_Post объектов из Relationship-поля.
 * @return array Массив [ ['question' => ..., 'answer' => ...], ... ]
 */
function gociss_parse_faq_relationship( $posts ) {
	$items = array();

	if ( empty( $posts ) || ! is_array( $posts ) ) {
		return $items;
	}

	foreach ( $posts as $faq_post ) {
		if ( is_object( $faq_post ) && ! empty( $faq_post->post_title ) ) {
			$items[] = array(
				'question' => $faq_post->post_title,
				'answer'   => apply_filters( 'the_content', $faq_post->post_content ),
			);
		}
	}

	return $items;
}
