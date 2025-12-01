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



