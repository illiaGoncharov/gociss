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
		'rewrite'               => array(
			'slug'       => 'uslugi',
			'with_front' => false,
		),
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
 * Сброс правил перезаписи при активации темы
 * Необходимо для корректной работы URL услуг
 */
function gociss_flush_rewrite_rules_on_activation() {
	gociss_register_service_post_type();
	gociss_register_service_category_taxonomy();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'gociss_flush_rewrite_rules_on_activation' );

