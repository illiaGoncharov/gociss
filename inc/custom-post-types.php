<?php
/**
 * Регистрация кастомных типов записей
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Регистрация типа записи "Эксперты"
 */
function gociss_register_expert_post_type() {
	$labels = array(
		'name'                  => _x( 'Эксперты', 'Post Type General Name', 'gociss' ),
		'singular_name'         => _x( 'Эксперт', 'Post Type Singular Name', 'gociss' ),
		'menu_name'             => __( 'Эксперты', 'gociss' ),
		'name_admin_bar'        => __( 'Эксперт', 'gociss' ),
		'archives'              => __( 'Архив экспертов', 'gociss' ),
		'attributes'            => __( 'Атрибуты эксперта', 'gociss' ),
		'parent_item_colon'     => __( 'Родительский эксперт:', 'gociss' ),
		'all_items'             => __( 'Все эксперты', 'gociss' ),
		'add_new_item'          => __( 'Добавить нового эксперта', 'gociss' ),
		'add_new'               => __( 'Добавить нового', 'gociss' ),
		'new_item'              => __( 'Новый эксперт', 'gociss' ),
		'edit_item'             => __( 'Редактировать эксперта', 'gociss' ),
		'update_item'           => __( 'Обновить эксперта', 'gociss' ),
		'view_item'             => __( 'Просмотреть эксперта', 'gociss' ),
		'view_items'            => __( 'Просмотреть экспертов', 'gociss' ),
		'search_items'          => __( 'Искать экспертов', 'gociss' ),
		'not_found'             => __( 'Не найдено', 'gociss' ),
		'not_found_in_trash'    => __( 'Не найдено в корзине', 'gociss' ),
	);

	$args = array(
		'label'                 => __( 'Эксперт', 'gociss' ),
		'description'           => __( 'Эксперты компании', 'gociss' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-groups',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => false,
	);

	register_post_type( 'gociss_expert', $args );
}
add_action( 'init', 'gociss_register_expert_post_type', 0 );

/**
 * Регистрация ACF полей для типа записи "Эксперты"
 */
function gociss_register_expert_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group(
		array(
			'key'                   => 'group_gociss_expert',
			'title'                 => 'Данные эксперта',
			'fields'                => array(
				array(
					'key'               => 'field_gociss_expert_position',
					'label'             => 'Должность',
					'name'              => 'gociss_expert_position',
					'type'              => 'text',
				),
				array(
					'key'               => 'field_gociss_expert_experience',
					'label'             => 'Опыт',
					'name'              => 'gociss_expert_experience',
					'type'              => 'textarea',
					'instructions'      => 'Например: "12 лет опыта, более 500 проектов ISO 9001, 14001, 45001"',
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'gociss_expert',
					),
				),
			),
		)
	);
}
add_action( 'acf/init', 'gociss_register_expert_acf_fields' );

/**
 * Регистрация типа записи "Услуги"
 */
function gociss_register_service_post_type() {
	$labels = array(
		'name'                  => _x( 'Услуги', 'Post Type General Name', 'gociss' ),
		'singular_name'         => _x( 'Услуга', 'Post Type Singular Name', 'gociss' ),
		'menu_name'             => __( 'Услуги', 'gociss' ),
		'name_admin_bar'        => __( 'Услуга', 'gociss' ),
		'archives'              => __( 'Виды сертификации', 'gociss' ),
		'attributes'            => __( 'Атрибуты услуги', 'gociss' ),
		'parent_item_colon'     => __( 'Родительская услуга:', 'gociss' ),
		'all_items'             => __( 'Все услуги', 'gociss' ),
		'add_new_item'          => __( 'Добавить новую услугу', 'gociss' ),
		'add_new'               => __( 'Добавить новую', 'gociss' ),
		'new_item'              => __( 'Новая услуга', 'gociss' ),
		'edit_item'             => __( 'Редактировать услугу', 'gociss' ),
		'update_item'           => __( 'Обновить услугу', 'gociss' ),
		'view_item'             => __( 'Просмотреть услугу', 'gociss' ),
		'view_items'            => __( 'Просмотреть услуги', 'gociss' ),
		'search_items'          => __( 'Искать услуги', 'gociss' ),
		'not_found'             => __( 'Услуги не найдены', 'gociss' ),
		'not_found_in_trash'    => __( 'Не найдено в корзине', 'gociss' ),
		'featured_image'        => __( 'Изображение услуги', 'gociss' ),
		'set_featured_image'    => __( 'Установить изображение', 'gociss' ),
		'remove_featured_image' => __( 'Удалить изображение', 'gociss' ),
		'use_featured_image'    => __( 'Использовать как изображение услуги', 'gociss' ),
	);

	$args = array(
		'label'                 => __( 'Услуга', 'gociss' ),
		'description'           => __( 'Услуги компании по сертификации', 'gociss' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'taxonomies'            => array( 'gociss_service_cat' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 6,
		'menu_icon'             => 'dashicons-media-document',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => 'uslugi',
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => false,
		'rewrite'               => false, // Отключаем стандартный rewrite, используем кастомные правила
	);

	register_post_type( 'gociss_service', $args );
}
add_action( 'init', 'gociss_register_service_post_type', 0 );

/**
 * Регистрация таксономии "Категории услуг"
 */
function gociss_register_service_category_taxonomy() {
	$labels = array(
		'name'                       => _x( 'Категории услуг', 'Taxonomy General Name', 'gociss' ),
		'singular_name'              => _x( 'Категория услуг', 'Taxonomy Singular Name', 'gociss' ),
		'menu_name'                  => __( 'Категории', 'gociss' ),
		'all_items'                  => __( 'Все категории', 'gociss' ),
		'parent_item'                => __( 'Родительская категория', 'gociss' ),
		'parent_item_colon'          => __( 'Родительская категория:', 'gociss' ),
		'new_item_name'              => __( 'Новая категория', 'gociss' ),
		'add_new_item'               => __( 'Добавить категорию', 'gociss' ),
		'edit_item'                  => __( 'Редактировать категорию', 'gociss' ),
		'update_item'                => __( 'Обновить категорию', 'gociss' ),
		'view_item'                  => __( 'Просмотреть категорию', 'gociss' ),
		'separate_items_with_commas' => __( 'Разделяйте категории запятыми', 'gociss' ),
		'add_or_remove_items'        => __( 'Добавить или удалить категории', 'gociss' ),
		'choose_from_most_used'      => __( 'Выбрать из популярных', 'gociss' ),
		'popular_items'              => __( 'Популярные категории', 'gociss' ),
		'search_items'               => __( 'Искать категории', 'gociss' ),
		'not_found'                  => __( 'Категории не найдены', 'gociss' ),
		'no_terms'                   => __( 'Нет категорий', 'gociss' ),
		'items_list'                 => __( 'Список категорий', 'gociss' ),
		'items_list_navigation'      => __( 'Навигация по категориям', 'gociss' ),
	);

	$args = array(
		'labels'            => $labels,
		'hierarchical'      => true, // Иерархическая таксономия (как категории)
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => false,
		'show_in_rest'      => false,
		'rewrite'           => array(
			'slug'         => 'uslugi/category',
			'with_front'   => false,
			'hierarchical' => true,
		),
	);

	register_taxonomy( 'gociss_service_cat', array( 'gociss_service' ), $args );
}
add_action( 'init', 'gociss_register_service_category_taxonomy', 0 );

/**
 * Регистрация типа записи "FAQ"
 */
function gociss_register_faq_post_type() {
	$labels = array(
		'name'                  => _x( 'FAQ', 'Post Type General Name', 'gociss' ),
		'singular_name'         => _x( 'Вопрос FAQ', 'Post Type Singular Name', 'gociss' ),
		'menu_name'             => __( 'FAQ', 'gociss' ),
		'name_admin_bar'        => __( 'Вопрос FAQ', 'gociss' ),
		'archives'              => __( 'Вопрос-ответ', 'gociss' ),
		'all_items'             => __( 'Все вопросы', 'gociss' ),
		'add_new_item'          => __( 'Добавить вопрос', 'gociss' ),
		'add_new'               => __( 'Добавить вопрос', 'gociss' ),
		'new_item'              => __( 'Новый вопрос', 'gociss' ),
		'edit_item'             => __( 'Редактировать вопрос', 'gociss' ),
		'update_item'           => __( 'Обновить вопрос', 'gociss' ),
		'view_item'             => __( 'Просмотреть вопрос', 'gociss' ),
		'search_items'          => __( 'Искать вопросы', 'gociss' ),
		'not_found'             => __( 'Вопросы не найдены', 'gociss' ),
		'not_found_in_trash'    => __( 'Не найдено в корзине', 'gociss' ),
	);

	$args = array(
		'label'                 => __( 'FAQ', 'gociss' ),
		'description'           => __( 'Часто задаваемые вопросы', 'gociss' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor' ),
		'taxonomies'            => array( 'gociss_faq_cat' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 7,
		'menu_icon'             => 'dashicons-format-chat',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => 'vopros-otvet',
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => false,
		'rewrite'               => array(
			'slug'       => 'vopros-otvet',
			'with_front' => false,
		),
	);

	register_post_type( 'gociss_faq', $args );
}
add_action( 'init', 'gociss_register_faq_post_type', 0 );

/**
 * Регистрация таксономии "Категории FAQ"
 */
function gociss_register_faq_category_taxonomy() {
	$labels = array(
		'name'                       => _x( 'Категории FAQ', 'Taxonomy General Name', 'gociss' ),
		'singular_name'              => _x( 'Категория FAQ', 'Taxonomy Singular Name', 'gociss' ),
		'menu_name'                  => __( 'Категории FAQ', 'gociss' ),
		'all_items'                  => __( 'Все категории', 'gociss' ),
		'parent_item'                => __( 'Родительская категория', 'gociss' ),
		'parent_item_colon'          => __( 'Родительская категория:', 'gociss' ),
		'new_item_name'              => __( 'Новая категория', 'gociss' ),
		'add_new_item'               => __( 'Добавить категорию', 'gociss' ),
		'edit_item'                  => __( 'Редактировать категорию', 'gociss' ),
		'update_item'                => __( 'Обновить категорию', 'gociss' ),
		'view_item'                  => __( 'Просмотреть категорию', 'gociss' ),
		'search_items'               => __( 'Искать категории', 'gociss' ),
		'not_found'                  => __( 'Категории не найдены', 'gociss' ),
	);

	$args = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => false,
		'show_in_rest'      => false,
		'rewrite'           => array(
			'slug'         => 'vopros-otvet/category',
			'with_front'   => false,
			'hierarchical' => true,
		),
	);

	register_taxonomy( 'gociss_faq_cat', array( 'gociss_faq' ), $args );
}
add_action( 'init', 'gociss_register_faq_category_taxonomy', 0 );

/**
 * Регистрация таксономии "Регионы" для мультирегиональности
 * URL: /uslugi/{услуга}/{регион}
 */
function gociss_register_region_taxonomy() {
	$labels = array(
		'name'                       => _x( 'Регионы', 'Taxonomy General Name', 'gociss' ),
		'singular_name'              => _x( 'Регион', 'Taxonomy Singular Name', 'gociss' ),
		'menu_name'                  => __( 'Регионы', 'gociss' ),
		'all_items'                  => __( 'Все регионы', 'gociss' ),
		'new_item_name'              => __( 'Новый регион', 'gociss' ),
		'add_new_item'               => __( 'Добавить регион', 'gociss' ),
		'edit_item'                  => __( 'Редактировать регион', 'gociss' ),
		'update_item'                => __( 'Обновить регион', 'gociss' ),
		'view_item'                  => __( 'Просмотреть регион', 'gociss' ),
		'search_items'               => __( 'Искать регионы', 'gociss' ),
		'not_found'                  => __( 'Регионы не найдены', 'gociss' ),
	);

	$args = array(
		'labels'            => $labels,
		'hierarchical'      => false,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => false,
		'show_in_rest'      => false,
		'rewrite'           => false, // Отключаем стандартный rewrite
	);

	register_taxonomy( 'gociss_region', array( 'gociss_service' ), $args );
}
add_action( 'init', 'gociss_register_region_taxonomy', 0 );

/**
 * Добавляем query var для региона
 */
function gociss_add_region_query_var( $vars ) {
	$vars[] = 'gociss_region';
	return $vars;
}
add_filter( 'query_vars', 'gociss_add_region_query_var' );

/**
 * Обработка выбора региона через параметр URL
 * Сохраняет выбранный регион в cookie
 */
function gociss_handle_region_selection() {
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended
	if ( isset( $_GET['gociss_set_region'] ) ) {
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$region_slug = sanitize_text_field( wp_unslash( $_GET['gociss_set_region'] ) );

		// Проверяем, что такой регион существует
		$region = get_term_by( 'slug', $region_slug, 'gociss_region' );
		if ( $region && ! is_wp_error( $region ) ) {
			// Сохраняем в cookie на 30 дней
			setcookie( 'gociss_selected_region', $region_slug, time() + ( 30 * DAY_IN_SECONDS ), '/' );

			// Редирект на текущую страницу без параметра
			$redirect_url = remove_query_arg( 'gociss_set_region' );
			wp_safe_redirect( $redirect_url );
			exit;
		}
	}
}
add_action( 'template_redirect', 'gociss_handle_region_selection' );

/**
 * Получить выбранный регион из cookie (для страниц без региона в URL)
 *
 * @return WP_Term|null Объект региона или null
 */
function gociss_get_selected_region_from_cookie() {
	if ( isset( $_COOKIE['gociss_selected_region'] ) ) {
		$region_slug = sanitize_text_field( wp_unslash( $_COOKIE['gociss_selected_region'] ) );
		$region      = get_term_by( 'slug', $region_slug, 'gociss_region' );
		if ( $region && ! is_wp_error( $region ) ) {
			return $region;
		}
	}
	return null;
}

/**
 * Создаём базовые регионы при активации темы
 */
function gociss_create_default_regions() {
	$regions = array(
		'spb'          => 'Санкт-Петербург',
		'moscow'       => 'Москва',
		'kazan'        => 'Казань',
		'novosibirsk'  => 'Новосибирск',
		'ekaterinburg' => 'Екатеринбург',
		'krasnodar'    => 'Краснодар',
		'samara'       => 'Самара',
		'nizhny'       => 'Нижний Новгород',
		'chelyabinsk'  => 'Челябинск',
		'rostov'       => 'Ростов-на-Дону',
	);

	foreach ( $regions as $slug => $name ) {
		if ( ! term_exists( $slug, 'gociss_region' ) ) {
			wp_insert_term( $name, 'gociss_region', array( 'slug' => $slug ) );
		}
	}
}
add_action( 'after_switch_theme', 'gociss_create_default_regions' );
add_action( 'init', 'gociss_create_default_regions', 99 );

/**
 * Фильтр для генерации правильных permalink услуг
 * URL формат: /{service-slug}/ вместо /uslugi/{service-slug}/
 */
function gociss_service_permalink( $post_link, $post ) {
	if ( $post->post_type !== 'gociss_service' ) {
		return $post_link;
	}

	return home_url( '/' . $post->post_name . '/' );
}
add_filter( 'post_type_link', 'gociss_service_permalink', 10, 2 );

/**
 * Хелпер: получить URL услуги для конкретного региона
 * URL формат: /{service-slug}/{region-slug}/
 * Например: /iso-45001/spb/
 *
 * @param int|WP_Post $service ID или объект услуги
 * @param string $region_slug Slug региона
 * @return string URL
 */
function gociss_get_service_region_url( $service, $region_slug ) {
	$service = get_post( $service );
	if ( ! $service || $service->post_type !== 'gociss_service' ) {
		return '';
	}

	return home_url( '/' . $service->post_name . '/' . $region_slug . '/' );
}

/**
 * Хелпер: получить текущий регион из URL или cookie
 *
 * @param bool $url_only Если true - проверяет только URL, игнорирует cookie
 * @return WP_Term|null Объект региона или null
 */
function gociss_get_current_region( $url_only = false ) {
	// Сначала проверяем регион в URL (для страниц услуг)
	$region_slug = get_query_var( 'gociss_region' );
	if ( ! empty( $region_slug ) ) {
		$region = get_term_by( 'slug', $region_slug, 'gociss_region' );
		if ( $region && ! is_wp_error( $region ) ) {
			return $region;
		}
	}

	// Если не нашли в URL и разрешено проверять cookie
	if ( ! $url_only && function_exists( 'gociss_get_selected_region_from_cookie' ) ) {
		return gociss_get_selected_region_from_cookie();
	}

	return null;
}

/**
 * Хелпер: получить значение поля с учётом региона
 * Сначала проверяет региональное значение, если пусто - возвращает общее из услуги
 *
 * @param string $region_field_name Название поля в регионе (например: gociss_region_pricing_title)
 * @param string $service_field_name Название поля в услуге (например: gociss_service_pricing_title)
 * @param mixed  $default Значение по умолчанию, если оба поля пусты
 * @return mixed Значение поля
 */
function gociss_get_regional_field( $region_field_name, $service_field_name = '', $default = '' ) {
	if ( ! function_exists( 'get_field' ) ) {
		return $default;
	}

	$region = gociss_get_current_region();

	// Если есть регион - проверяем региональное значение
	// ACF использует формат 'term_ID' для полей таксономий
	if ( $region ) {
		$regional_value = get_field( $region_field_name, 'term_' . $region->term_id );
		if ( ! empty( $regional_value ) ) {
			return $regional_value;
		}
	}

	// Fallback на значение из услуги
	if ( ! empty( $service_field_name ) ) {
		$service_value = get_field( $service_field_name );
		if ( ! empty( $service_value ) ) {
			return $service_value;
		}
	}

	return $default;
}

/**
 * Хелпер: получить все регионы для переключателя
 *
 * @return array Массив объектов регионов
 */
function gociss_get_all_regions() {
	$regions = get_terms(
		array(
			'taxonomy'   => 'gociss_region',
			'hide_empty' => false,
			'orderby'    => 'name',
			'order'      => 'ASC',
		)
	);

	return ( $regions && ! is_wp_error( $regions ) ) ? $regions : array();
}

/**
 * Хелпер: получить URL текущей страницы для другого региона
 *
 * @param string $region_slug Slug региона
 * @return string URL
 */
function gociss_get_current_page_region_url( $region_slug ) {
	// Если это страница услуги
	if ( is_singular( 'gociss_service' ) ) {
		return gociss_get_service_region_url( get_the_ID(), $region_slug );
	}

	// Для других страниц - просто добавляем регион к текущему URL
	$current_url = get_permalink();
	return trailingslashit( $current_url ) . $region_slug . '/';
}

/**
 * Rewrite правила для мультирегиональности
 * URL: /{service}/ и /{service}/{region}/
 * Например: /iso-45001/ и /iso-45001/spb/
 */
function gociss_add_service_rewrite_rules() {
	// Правило для региональных страниц: /{service}/{region}/
	add_rewrite_rule(
		'^([^/]+)/([^/]+)/?$',
		'index.php?gociss_service_check=$matches[1]&gociss_region=$matches[2]',
		'top'
	);

	// Правило для обычных страниц услуг: /{service}/
	add_rewrite_rule(
		'^([^/]+)/?$',
		'index.php?gociss_service_check=$matches[1]',
		'top'
	);
}
add_action( 'init', 'gociss_add_service_rewrite_rules', 99 );

/**
 * Добавляем query var для проверки услуги
 */
function gociss_add_service_check_query_var( $vars ) {
	$vars[] = 'gociss_service_check';
	return $vars;
}
add_filter( 'query_vars', 'gociss_add_service_check_query_var' );

/**
 * Request filter для проверки и конвертации URL услуги
 * Проверяет, является ли slug услугой, и если да - устанавливает правильные query vars
 */
function gociss_parse_service_request( $query_vars ) {
	// Проверяем, есть ли наш специальный query var
	if ( empty( $query_vars['gociss_service_check'] ) ) {
		return $query_vars;
	}

	$slug = $query_vars['gociss_service_check'];

	// Сначала проверяем, не является ли это обычной страницей
	$page = get_page_by_path( $slug, OBJECT, 'page' );
	if ( $page && $page->post_status === 'publish' ) {
		// Это страница! Устанавливаем query vars для страницы
		unset( $query_vars['gociss_service_check'] );
		$query_vars['page'] = '';
		$query_vars['pagename'] = $slug;
		return $query_vars;
	}

	// Проверяем, существует ли услуга с таким slug
	$service = get_page_by_path( $slug, OBJECT, 'gociss_service' );

	if ( $service && $service->post_status === 'publish' ) {
		// Это услуга! Устанавливаем правильные query vars
		unset( $query_vars['gociss_service_check'] );
		$query_vars['gociss_service'] = $slug;
		$query_vars['post_type'] = 'gociss_service';
		$query_vars['name'] = $slug;
	} else {
		// Не услуга и не страница - убираем наш query var
		unset( $query_vars['gociss_service_check'] );
	}

	return $query_vars;
}
add_filter( 'request', 'gociss_parse_service_request' );

/**
 * Регистрация типа записи "Статьи"
 */
function gociss_register_article_post_type() {
	$labels = array(
		'name'                  => _x( 'Статьи', 'Post Type General Name', 'gociss' ),
		'singular_name'         => _x( 'Статья', 'Post Type Singular Name', 'gociss' ),
		'menu_name'             => __( 'Статьи', 'gociss' ),
		'name_admin_bar'        => __( 'Статья', 'gociss' ),
		'archives'              => __( 'Все статьи', 'gociss' ),
		'all_items'             => __( 'Все статьи', 'gociss' ),
		'add_new_item'          => __( 'Добавить статью', 'gociss' ),
		'add_new'               => __( 'Добавить статью', 'gociss' ),
		'new_item'              => __( 'Новая статья', 'gociss' ),
		'edit_item'             => __( 'Редактировать статью', 'gociss' ),
		'update_item'           => __( 'Обновить статью', 'gociss' ),
		'view_item'             => __( 'Просмотреть статью', 'gociss' ),
		'search_items'          => __( 'Искать статьи', 'gociss' ),
		'not_found'             => __( 'Статьи не найдены', 'gociss' ),
		'not_found_in_trash'    => __( 'Не найдено в корзине', 'gociss' ),
		'featured_image'        => __( 'Изображение статьи', 'gociss' ),
		'set_featured_image'    => __( 'Установить изображение', 'gociss' ),
		'remove_featured_image' => __( 'Удалить изображение', 'gociss' ),
		'use_featured_image'    => __( 'Использовать как изображение статьи', 'gociss' ),
	);

	$args = array(
		'label'                 => __( 'Статья', 'gociss' ),
		'description'           => __( 'Информационные статьи для SEO', 'gociss' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'author' ),
		'taxonomies'            => array( 'gociss_article_cat' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 8,
		'menu_icon'             => 'dashicons-media-text',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => 'stati',
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => false,
		'rewrite'               => array(
			'slug'       => 'stati',
			'with_front' => false,
		),
	);

	register_post_type( 'gociss_article', $args );
}
add_action( 'init', 'gociss_register_article_post_type', 0 );

/**
 * Регистрация таксономии "Категории статей"
 */
function gociss_register_article_category_taxonomy() {
	$labels = array(
		'name'                       => _x( 'Категории статей', 'Taxonomy General Name', 'gociss' ),
		'singular_name'              => _x( 'Категория статей', 'Taxonomy Singular Name', 'gociss' ),
		'menu_name'                  => __( 'Категории', 'gociss' ),
		'all_items'                  => __( 'Все категории', 'gociss' ),
		'parent_item'                => __( 'Родительская категория', 'gociss' ),
		'parent_item_colon'          => __( 'Родительская категория:', 'gociss' ),
		'new_item_name'              => __( 'Новая категория', 'gociss' ),
		'add_new_item'               => __( 'Добавить категорию', 'gociss' ),
		'edit_item'                  => __( 'Редактировать категорию', 'gociss' ),
		'update_item'                => __( 'Обновить категорию', 'gociss' ),
		'view_item'                  => __( 'Просмотреть категорию', 'gociss' ),
		'search_items'               => __( 'Искать категории', 'gociss' ),
		'not_found'                  => __( 'Категории не найдены', 'gociss' ),
	);

	$args = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => false,
		'show_in_rest'      => false,
		'rewrite'           => array(
			'slug'         => 'stati/category',
			'with_front'   => false,
			'hierarchical' => true,
		),
	);

	register_taxonomy( 'gociss_article_cat', array( 'gociss_article' ), $args );
}
add_action( 'init', 'gociss_register_article_category_taxonomy', 0 );

/**
 * Регистрация таксономии "Контекст FAQ"
 * Для привязки вопросов к главной странице или конкретным услугам
 */
function gociss_register_faq_context_taxonomy() {
	$labels = array(
		'name'                       => _x( 'Контекст FAQ', 'Taxonomy General Name', 'gociss' ),
		'singular_name'              => _x( 'Контекст', 'Taxonomy Singular Name', 'gociss' ),
		'menu_name'                  => __( 'Контекст', 'gociss' ),
		'all_items'                  => __( 'Все контексты', 'gociss' ),
		'new_item_name'              => __( 'Новый контекст', 'gociss' ),
		'add_new_item'               => __( 'Добавить контекст', 'gociss' ),
		'edit_item'                  => __( 'Редактировать контекст', 'gociss' ),
		'update_item'                => __( 'Обновить контекст', 'gociss' ),
		'view_item'                  => __( 'Просмотреть контекст', 'gociss' ),
		'search_items'               => __( 'Искать контексты', 'gociss' ),
		'not_found'                  => __( 'Контексты не найдены', 'gociss' ),
	);

	$args = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => false,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => false,
		'show_tagcloud'     => false,
		'show_in_rest'      => false,
	);

	register_taxonomy( 'gociss_faq_context', array( 'gociss_faq' ), $args );
}
add_action( 'init', 'gociss_register_faq_context_taxonomy', 0 );

/**
 * Создать базовые контексты FAQ при активации темы
 */
function gociss_create_default_faq_contexts() {
	// Создаём контекст "Главная страница" если его нет
	if ( ! term_exists( 'homepage', 'gociss_faq_context' ) ) {
		wp_insert_term(
			'Главная страница',
			'gociss_faq_context',
			array( 'slug' => 'homepage' )
		);
	}
}
add_action( 'after_switch_theme', 'gociss_create_default_faq_contexts' );
add_action( 'init', 'gociss_create_default_faq_contexts', 99 );

/**
 * Автоматически создавать контекст FAQ при создании услуги
 */
function gociss_create_faq_context_for_service( $post_id, $post, $update ) {
	// Только для новых услуг
	if ( $update || $post->post_type !== 'gociss_service' ) {
		return;
	}

	// Создаём термин с slug = ID услуги
	$term_slug = 'service-' . $post_id;
	$term_name = 'Услуга: ' . $post->post_title;

	if ( ! term_exists( $term_slug, 'gociss_faq_context' ) ) {
		wp_insert_term(
			$term_name,
			'gociss_faq_context',
			array( 'slug' => $term_slug )
		);
	}
}
add_action( 'wp_insert_post', 'gociss_create_faq_context_for_service', 10, 3 );

/**
 * Обновить название контекста FAQ при обновлении услуги
 */
function gociss_update_faq_context_for_service( $post_id, $post, $update ) {
	if ( ! $update || $post->post_type !== 'gociss_service' ) {
		return;
	}

	$term_slug = 'service-' . $post_id;
	$term = get_term_by( 'slug', $term_slug, 'gociss_faq_context' );

	if ( $term ) {
		wp_update_term(
			$term->term_id,
			'gociss_faq_context',
			array( 'name' => 'Услуга: ' . $post->post_title )
		);
	}
}
add_action( 'wp_insert_post', 'gociss_update_faq_context_for_service', 10, 3 );

/**
 * Сброс правил перезаписи при активации темы
 * Необходимо для корректной работы URL услуг
 */
function gociss_flush_rewrite_rules_on_activation() {
	gociss_register_service_post_type();
	gociss_register_service_category_taxonomy();
	gociss_register_region_taxonomy();
	gociss_add_service_rewrite_rules();
	gociss_register_faq_post_type();
	gociss_register_faq_category_taxonomy();
	gociss_register_faq_context_taxonomy();
	gociss_register_article_post_type();
	gociss_register_article_category_taxonomy();
	gociss_register_certificate_post_type();
	gociss_register_certificate_type_taxonomy();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'gociss_flush_rewrite_rules_on_activation' );

/**
 * Сброс rewrite rules при сохранении услуги (для обновления региональных URL)
 */
function gociss_flush_rewrite_on_service_save( $post_id, $post, $update ) {
	if ( $post->post_type !== 'gociss_service' ) {
		return;
	}

	// Отложенный сброс для избежания проблем с производительностью
	if ( ! wp_next_scheduled( 'gociss_delayed_flush_rewrite' ) ) {
		wp_schedule_single_event( time() + 5, 'gociss_delayed_flush_rewrite' );
	}
}
add_action( 'save_post', 'gociss_flush_rewrite_on_service_save', 10, 3 );

/**
 * Выполнение отложенного сброса rewrite rules
 */
function gociss_do_delayed_flush_rewrite() {
	flush_rewrite_rules();
}
add_action( 'gociss_delayed_flush_rewrite', 'gociss_do_delayed_flush_rewrite' );

/**
 * Регистрация типа записи "Реестр сертификатов"
 */
function gociss_register_certificate_post_type() {
	$labels = array(
		'name'                  => _x( 'Реестр сертификатов', 'Post Type General Name', 'gociss' ),
		'singular_name'         => _x( 'Сертификат', 'Post Type Singular Name', 'gociss' ),
		'menu_name'             => __( 'Реестр', 'gociss' ),
		'name_admin_bar'        => __( 'Сертификат', 'gociss' ),
		'archives'              => __( 'Реестр сертификатов', 'gociss' ),
		'all_items'             => __( 'Все сертификаты', 'gociss' ),
		'add_new_item'          => __( 'Добавить сертификат', 'gociss' ),
		'add_new'               => __( 'Добавить сертификат', 'gociss' ),
		'new_item'              => __( 'Новый сертификат', 'gociss' ),
		'edit_item'             => __( 'Редактировать сертификат', 'gociss' ),
		'update_item'           => __( 'Обновить сертификат', 'gociss' ),
		'view_item'             => __( 'Просмотреть сертификат', 'gociss' ),
		'view_items'            => __( 'Просмотреть сертификаты', 'gociss' ),
		'search_items'          => __( 'Искать сертификаты', 'gociss' ),
		'not_found'             => __( 'Сертификаты не найдены', 'gociss' ),
		'not_found_in_trash'    => __( 'Не найдено в корзине', 'gociss' ),
	);

	$args = array(
		'label'                 => __( 'Сертификат', 'gociss' ),
		'description'           => __( 'Реестр выданных сертификатов и удостоверений', 'gociss' ),
		'labels'                => $labels,
		'supports'              => array( 'title' ),
		'taxonomies'            => array( 'gociss_certificate_type' ),
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 9,
		'menu_icon'             => 'dashicons-awards',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => false,
		'capability_type'       => 'post',
		'show_in_rest'          => false,
	);

	register_post_type( 'gociss_certificate', $args );
}
add_action( 'init', 'gociss_register_certificate_post_type', 0 );

/**
 * Регистрация таксономии "Вид реестра" для сертификатов
 */
function gociss_register_certificate_type_taxonomy() {
	$labels = array(
		'name'                       => _x( 'Виды реестра', 'Taxonomy General Name', 'gociss' ),
		'singular_name'              => _x( 'Вид реестра', 'Taxonomy Singular Name', 'gociss' ),
		'menu_name'                  => __( 'Виды реестра', 'gociss' ),
		'all_items'                  => __( 'Все виды', 'gociss' ),
		'new_item_name'              => __( 'Новый вид', 'gociss' ),
		'add_new_item'               => __( 'Добавить вид', 'gociss' ),
		'edit_item'                  => __( 'Редактировать вид', 'gociss' ),
		'update_item'                => __( 'Обновить вид', 'gociss' ),
		'view_item'                  => __( 'Просмотреть вид', 'gociss' ),
		'search_items'               => __( 'Искать виды', 'gociss' ),
		'not_found'                  => __( 'Виды не найдены', 'gociss' ),
	);

	$args = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => false,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => false,
		'show_tagcloud'     => false,
		'show_in_rest'      => false,
	);

	register_taxonomy( 'gociss_certificate_type', array( 'gociss_certificate' ), $args );
}
add_action( 'init', 'gociss_register_certificate_type_taxonomy', 0 );

/**
 * Создать базовые виды реестра при активации темы
 */
function gociss_create_default_certificate_types() {
	$types = array(
		'management' => 'Системы менеджмента, услуги, НОКС',
		'personnel'  => 'Персонал',
		'reputation' => 'Опыт и деловая репутация',
	);

	foreach ( $types as $slug => $name ) {
		if ( ! term_exists( $slug, 'gociss_certificate_type' ) ) {
			wp_insert_term( $name, 'gociss_certificate_type', array( 'slug' => $slug ) );
		}
	}
}
add_action( 'after_switch_theme', 'gociss_create_default_certificate_types' );
add_action( 'init', 'gociss_create_default_certificate_types', 99 );

/**
 * Регистрация типа записи "Курсы" (Учебный центр)
 */
function gociss_register_course_post_type() {
	$labels = array(
		'name'                  => _x( 'Курсы', 'Post Type General Name', 'gociss' ),
		'singular_name'         => _x( 'Курс', 'Post Type Singular Name', 'gociss' ),
		'menu_name'             => __( 'Учебный центр', 'gociss' ),
		'name_admin_bar'        => __( 'Курс', 'gociss' ),
		'archives'              => __( 'Курсы и программы', 'gociss' ),
		'all_items'             => __( 'Все курсы', 'gociss' ),
		'add_new_item'          => __( 'Добавить курс', 'gociss' ),
		'add_new'               => __( 'Добавить курс', 'gociss' ),
		'new_item'              => __( 'Новый курс', 'gociss' ),
		'edit_item'             => __( 'Редактировать курс', 'gociss' ),
		'update_item'           => __( 'Обновить курс', 'gociss' ),
		'view_item'             => __( 'Просмотреть курс', 'gociss' ),
		'view_items'            => __( 'Просмотреть курсы', 'gociss' ),
		'search_items'          => __( 'Искать курсы', 'gociss' ),
		'not_found'             => __( 'Курсы не найдены', 'gociss' ),
		'not_found_in_trash'    => __( 'Не найдено в корзине', 'gociss' ),
	);

	$args = array(
		'label'                 => __( 'Курс', 'gociss' ),
		'description'           => __( 'Курсы и образовательные программы учебного центра', 'gociss' ),
		'labels'                => $labels,
		'supports'              => array( 'title' ),
		'taxonomies'            => array( 'gociss_course_cat' ),
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 10,
		'menu_icon'             => 'dashicons-welcome-learn-more',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => false,
		'capability_type'       => 'post',
		'show_in_rest'          => false,
	);

	register_post_type( 'gociss_course', $args );
}
add_action( 'init', 'gociss_register_course_post_type', 0 );

/**
 * Регистрация таксономии "Категории курсов"
 */
function gociss_register_course_category_taxonomy() {
	$labels = array(
		'name'                       => _x( 'Категории курсов', 'Taxonomy General Name', 'gociss' ),
		'singular_name'              => _x( 'Категория курса', 'Taxonomy Singular Name', 'gociss' ),
		'menu_name'                  => __( 'Категории', 'gociss' ),
		'all_items'                  => __( 'Все категории', 'gociss' ),
		'new_item_name'              => __( 'Новая категория', 'gociss' ),
		'add_new_item'               => __( 'Добавить категорию', 'gociss' ),
		'edit_item'                  => __( 'Редактировать категорию', 'gociss' ),
		'update_item'                => __( 'Обновить категорию', 'gociss' ),
		'view_item'                  => __( 'Просмотреть категорию', 'gociss' ),
		'search_items'               => __( 'Искать категории', 'gociss' ),
		'not_found'                  => __( 'Категории не найдены', 'gociss' ),
	);

	$args = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => false,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => false,
		'show_tagcloud'     => false,
		'show_in_rest'      => false,
	);

	register_taxonomy( 'gociss_course_cat', array( 'gociss_course' ), $args );
}
add_action( 'init', 'gociss_register_course_category_taxonomy', 0 );

/**
 * Создать фиксированные категории курсов при активации темы
 */
function gociss_create_default_course_categories() {
	$categories = array(
		'iso-9001-14001-45001' => 'ISO 9001, ISO 14001, ISO 45001',
		'iso-22000-haccp'      => 'ISO 22000 / ХАССП',
		'internal-audit'       => 'Внутренний аудит',
		'other-standards'      => 'Другие стандарты',
	);

	foreach ( $categories as $slug => $name ) {
		if ( ! term_exists( $slug, 'gociss_course_cat' ) ) {
			wp_insert_term( $name, 'gociss_course_cat', array( 'slug' => $slug ) );
		}
	}
}
add_action( 'after_switch_theme', 'gociss_create_default_course_categories' );
add_action( 'init', 'gociss_create_default_course_categories', 99 );

