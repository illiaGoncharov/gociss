<?php
/**
 * Кастомизация поиска WordPress
 *
 * - Сортировка результатов: услуги → FAQ → статьи → страницы → остальное
 * - Расширение поиска на ACF-поля (wp_postmeta)
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Сортировка результатов поиска по типу записи:
 * gociss_service первыми, затем gociss_faq, gociss_article, page
 */
function gociss_search_orderby( $orderby, $query ) {
	if ( ! is_admin() && $query->is_main_query() && $query->is_search() ) {
		global $wpdb;

		$orderby = "FIELD({$wpdb->posts}.post_type, 'gociss_service', 'gociss_faq', 'gociss_article', 'page', 'post') ASC, {$wpdb->posts}.post_title ASC";
	}

	return $orderby;
}
add_filter( 'posts_orderby', 'gociss_search_orderby', 10, 2 );

/**
 * Расширение поиска на ACF-поля (wp_postmeta)
 *
 * Добавляет JOIN к wp_postmeta, чтобы WordPress искал
 * также в мета-полях (ACF-данные хранятся там)
 */
function gociss_search_join( $join, $query ) {
	if ( ! is_admin() && $query->is_main_query() && $query->is_search() ) {
		global $wpdb;

		$join .= " LEFT JOIN {$wpdb->postmeta} AS gociss_pm ON ({$wpdb->posts}.ID = gociss_pm.post_id)";
	}

	return $join;
}
add_filter( 'posts_join', 'gociss_search_join', 10, 2 );

/**
 * Расширение WHERE-условия поиска для meta_value
 */
function gociss_search_where( $where, $query ) {
	if ( ! is_admin() && $query->is_main_query() && $query->is_search() ) {
		global $wpdb;

		$search_term = $query->get( 's' );
		if ( ! empty( $search_term ) ) {
			$like = '%' . $wpdb->esc_like( $search_term ) . '%';

			$where = preg_replace(
				"/\(\s*{$wpdb->posts}\.post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
				"({$wpdb->posts}.post_title LIKE $1) OR (gociss_pm.meta_value LIKE '" . esc_sql( $like ) . "')",
				$where
			);
		}
	}

	return $where;
}
add_filter( 'posts_where', 'gociss_search_where', 10, 2 );

/**
 * Убираем дубликаты из результатов поиска
 * (один пост может иметь несколько мета-полей)
 */
function gociss_search_distinct( $distinct, $query ) {
	if ( ! is_admin() && $query->is_main_query() && $query->is_search() ) {
		return 'DISTINCT';
	}

	return $distinct;
}
add_filter( 'posts_distinct', 'gociss_search_distinct', 10, 2 );
