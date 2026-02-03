<?php
/**
 * Обработчик реестра сертификатов
 * AJAX-поиск и автоматическое обновление статусов
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * AJAX обработчик поиска сертификатов
 */
function gociss_search_certificates() {
	// Проверка nonce
	if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'gociss_certificate_search' ) ) {
		wp_send_json_error( array( 'message' => 'Ошибка безопасности. Обновите страницу.' ) );
	}

	// Получение и санитизация данных
	$search_query = isset( $_POST['query'] ) ? sanitize_text_field( wp_unslash( $_POST['query'] ) ) : '';
	$registry_type = isset( $_POST['registry_type'] ) ? sanitize_text_field( wp_unslash( $_POST['registry_type'] ) ) : '';

	if ( empty( $search_query ) ) {
		wp_send_json_error( array( 'message' => 'Введите данные для поиска' ) );
	}

	// Минимальная длина запроса
	if ( strlen( $search_query ) < 3 ) {
		wp_send_json_error( array( 'message' => 'Введите минимум 3 символа' ) );
	}

	// Аргументы запроса
	$args = array(
		'post_type'      => 'gociss_certificate',
		'posts_per_page' => 50,
		'post_status'    => 'publish',
		'meta_query'     => array(
			'relation' => 'OR',
			array(
				'key'     => 'gociss_cert_inn',
				'value'   => $search_query,
				'compare' => 'LIKE',
			),
			array(
				'key'     => 'gociss_cert_company',
				'value'   => $search_query,
				'compare' => 'LIKE',
			),
			array(
				'key'     => 'gociss_cert_number',
				'value'   => $search_query,
				'compare' => 'LIKE',
			),
		),
	);

	// Фильтр по типу реестра
	if ( ! empty( $registry_type ) ) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'gociss_certificate_type',
				'field'    => 'slug',
				'terms'    => $registry_type,
			),
		);
	}

	$query = new WP_Query( $args );

	if ( ! $query->have_posts() ) {
		wp_send_json_error( array( 'message' => 'Сертификаты не найдены' ) );
	}

	$results = array();

	while ( $query->have_posts() ) {
		$query->the_post();
		$post_id = get_the_ID();

		// Получаем данные сертификата
		$status = get_field( 'gociss_cert_status', $post_id );
		$date_end = get_field( 'gociss_cert_date_end', $post_id );

		$results[] = array(
			'id'         => $post_id,
			'inn'        => get_field( 'gociss_cert_inn', $post_id ),
			'company'    => get_field( 'gociss_cert_company', $post_id ),
			'number'     => get_field( 'gociss_cert_number', $post_id ),
			'type'       => get_field( 'gociss_cert_type', $post_id ),
			'date_start' => gociss_format_cert_date( get_field( 'gociss_cert_date_start', $post_id ) ),
			'date_end'   => gociss_format_cert_date( $date_end ),
			'status'     => $status,
			'status_label' => gociss_get_status_label( $status ),
			'status_class' => gociss_get_status_class( $status ),
		);
	}

	wp_reset_postdata();

	wp_send_json_success( array(
		'results' => $results,
		'count'   => count( $results ),
	) );
}
add_action( 'wp_ajax_gociss_search_certificates', 'gociss_search_certificates' );
add_action( 'wp_ajax_nopriv_gociss_search_certificates', 'gociss_search_certificates' );

/**
 * Форматирование даты сертификата
 *
 * @param string $date Дата в формате Y-m-d
 * @return string Дата в формате d.m.Y
 */
function gociss_format_cert_date( $date ) {
	if ( empty( $date ) ) {
		return '';
	}
	$timestamp = strtotime( $date );
	return $timestamp ? date_i18n( 'd.m.Y', $timestamp ) : $date;
}

/**
 * Получить человекочитаемый статус
 *
 * @param string $status Код статуса
 * @return string Название статуса
 */
function gociss_get_status_label( $status ) {
	$labels = array(
		'active'    => 'Действует',
		'expired'   => 'Не действует',
		'suspended' => 'Приостановлен',
		'renewed'   => 'Продлён',
	);
	return isset( $labels[ $status ] ) ? $labels[ $status ] : $status;
}

/**
 * Получить CSS класс для статуса
 *
 * @param string $status Код статуса
 * @return string CSS класс
 */
function gociss_get_status_class( $status ) {
	$classes = array(
		'active'    => 'registry-card__status--active',
		'expired'   => 'registry-card__status--expired',
		'suspended' => 'registry-card__status--suspended',
		'renewed'   => 'registry-card__status--renewed',
	);
	return isset( $classes[ $status ] ) ? $classes[ $status ] : '';
}

/**
 * Автоматическое обновление статусов сертификатов при сохранении
 *
 * @param int $post_id ID записи
 */
function gociss_update_certificate_status_on_save( $post_id ) {
	// Проверяем тип записи
	if ( get_post_type( $post_id ) !== 'gociss_certificate' ) {
		return;
	}

	// Избегаем бесконечного цикла
	remove_action( 'acf/save_post', 'gociss_update_certificate_status_on_save', 20 );

	// Проверяем, включено ли ручное управление
	$manual = get_field( 'gociss_cert_status_manual', $post_id );
	if ( $manual ) {
		add_action( 'acf/save_post', 'gociss_update_certificate_status_on_save', 20 );
		return;
	}

	// Получаем дату окончания и текущий статус
	$date_end = get_field( 'gociss_cert_date_end', $post_id );
	$current_status = get_field( 'gociss_cert_status', $post_id );

	if ( empty( $date_end ) ) {
		add_action( 'acf/save_post', 'gociss_update_certificate_status_on_save', 20 );
		return;
	}

	$end_timestamp = strtotime( $date_end );
	$today = strtotime( 'today' );

	// Если срок истёк и статус не "expired" - обновляем
	if ( $end_timestamp < $today && $current_status !== 'expired' ) {
		update_field( 'gociss_cert_status', 'expired', $post_id );
	}

	add_action( 'acf/save_post', 'gociss_update_certificate_status_on_save', 20 );
}
add_action( 'acf/save_post', 'gociss_update_certificate_status_on_save', 20 );

/**
 * Регистрация cron события для обновления статусов
 */
function gociss_schedule_certificate_status_update() {
	if ( ! wp_next_scheduled( 'gociss_daily_certificate_status_check' ) ) {
		wp_schedule_event( time(), 'daily', 'gociss_daily_certificate_status_check' );
	}
}
add_action( 'init', 'gociss_schedule_certificate_status_update' );

/**
 * Ежедневная проверка и обновление статусов сертификатов
 */
function gociss_check_certificate_statuses() {
	$args = array(
		'post_type'      => 'gociss_certificate',
		'posts_per_page' => -1,
		'post_status'    => 'publish',
		'meta_query'     => array(
			'relation' => 'AND',
			array(
				'key'     => 'gociss_cert_status_manual',
				'value'   => '1',
				'compare' => '!=',
			),
			array(
				'key'     => 'gociss_cert_status',
				'value'   => 'expired',
				'compare' => '!=',
			),
		),
	);

	$query = new WP_Query( $args );

	if ( ! $query->have_posts() ) {
		return;
	}

	$today = strtotime( 'today' );

	while ( $query->have_posts() ) {
		$query->the_post();
		$post_id = get_the_ID();
		$date_end = get_field( 'gociss_cert_date_end', $post_id );

		if ( empty( $date_end ) ) {
			continue;
		}

		$end_timestamp = strtotime( $date_end );

		// Если срок истёк - обновляем статус
		if ( $end_timestamp < $today ) {
			update_field( 'gociss_cert_status', 'expired', $post_id );
		}
	}

	wp_reset_postdata();
}
add_action( 'gociss_daily_certificate_status_check', 'gociss_check_certificate_statuses' );

/**
 * Удаление cron события при деактивации темы
 */
function gociss_deactivate_certificate_cron() {
	$timestamp = wp_next_scheduled( 'gociss_daily_certificate_status_check' );
	if ( $timestamp ) {
		wp_unschedule_event( $timestamp, 'gociss_daily_certificate_status_check' );
	}
}
add_action( 'switch_theme', 'gociss_deactivate_certificate_cron' );

/**
 * Добавление колонок в админке для сертификатов
 *
 * @param array $columns Массив колонок
 * @return array
 */
function gociss_certificate_admin_columns( $columns ) {
	$new_columns = array();
	$new_columns['cb'] = $columns['cb'];
	$new_columns['title'] = $columns['title'];
	$new_columns['cert_inn'] = __( 'ИНН', 'gociss' );
	$new_columns['cert_company'] = __( 'Компания', 'gociss' );
	$new_columns['cert_number'] = __( 'Номер', 'gociss' );
	$new_columns['cert_status'] = __( 'Статус', 'gociss' );
	$new_columns['cert_date_end'] = __( 'Действует до', 'gociss' );
	$new_columns['taxonomy-gociss_certificate_type'] = __( 'Вид реестра', 'gociss' );
	$new_columns['date'] = $columns['date'];

	return $new_columns;
}
add_filter( 'manage_gociss_certificate_posts_columns', 'gociss_certificate_admin_columns' );

/**
 * Заполнение кастомных колонок в админке
 *
 * @param string $column Название колонки
 * @param int    $post_id ID записи
 */
function gociss_certificate_admin_column_content( $column, $post_id ) {
	switch ( $column ) {
		case 'cert_inn':
			echo esc_html( get_field( 'gociss_cert_inn', $post_id ) );
			break;
		case 'cert_company':
			echo esc_html( get_field( 'gociss_cert_company', $post_id ) );
			break;
		case 'cert_number':
			echo esc_html( get_field( 'gociss_cert_number', $post_id ) );
			break;
		case 'cert_status':
			$status = get_field( 'gociss_cert_status', $post_id );
			$manual = get_field( 'gociss_cert_status_manual', $post_id );
			$label = gociss_get_status_label( $status );
			$class = $status === 'active' || $status === 'renewed' ? 'green' : ( $status === 'suspended' ? 'orange' : 'red' );
			echo '<span style="color: ' . esc_attr( $class === 'green' ? '#22c55e' : ( $class === 'orange' ? '#f59e0b' : '#ef4444' ) ) . '; font-weight: 500;">' . esc_html( $label ) . '</span>';
			if ( $manual ) {
				echo ' <span style="color: #6b7280; font-size: 11px;">(ручн.)</span>';
			}
			break;
		case 'cert_date_end':
			$date_end = get_field( 'gociss_cert_date_end', $post_id );
			echo esc_html( gociss_format_cert_date( $date_end ) );
			break;
	}
}
add_action( 'manage_gociss_certificate_posts_custom_column', 'gociss_certificate_admin_column_content', 10, 2 );

/**
 * Сортировка по колонкам в админке
 *
 * @param array $columns Массив сортируемых колонок
 * @return array
 */
function gociss_certificate_sortable_columns( $columns ) {
	$columns['cert_inn'] = 'cert_inn';
	$columns['cert_company'] = 'cert_company';
	$columns['cert_date_end'] = 'cert_date_end';
	return $columns;
}
add_filter( 'manage_edit-gociss_certificate_sortable_columns', 'gociss_certificate_sortable_columns' );

/**
 * Обработка сортировки по кастомным колонкам
 *
 * @param WP_Query $query Объект запроса
 */
function gociss_certificate_orderby( $query ) {
	if ( ! is_admin() || ! $query->is_main_query() ) {
		return;
	}

	if ( $query->get( 'post_type' ) !== 'gociss_certificate' ) {
		return;
	}

	$orderby = $query->get( 'orderby' );

	switch ( $orderby ) {
		case 'cert_inn':
			$query->set( 'meta_key', 'gociss_cert_inn' );
			$query->set( 'orderby', 'meta_value' );
			break;
		case 'cert_company':
			$query->set( 'meta_key', 'gociss_cert_company' );
			$query->set( 'orderby', 'meta_value' );
			break;
		case 'cert_date_end':
			$query->set( 'meta_key', 'gociss_cert_date_end' );
			$query->set( 'orderby', 'meta_value' );
			break;
	}
}
add_action( 'pre_get_posts', 'gociss_certificate_orderby' );


