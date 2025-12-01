<?php
/**
 * Регистрация ACF полей
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Регистрация ACF групп полей
 * 
 * Примечание: Этот файл содержит JSON-структуру полей ACF.
 * После активации ACF плагина, поля нужно будет экспортировать
 * из админки и заменить этот код на актуальный.
 */
function gociss_register_acf_fields() {
	// Проверяем, что ACF активен
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	// Группа полей для Hero секции
	acf_add_local_field_group(
		array(
			'key'                   => 'group_gociss_hero',
			'title'                 => 'Hero секция',
			'fields'                => array(
				array(
					'key'               => 'field_gociss_hero_label',
					'label'             => 'Метка',
					'name'              => 'gociss_hero_label',
					'type'              => 'text',
					'default_value'     => 'Аккредитованный орган по сертификации',
				),
				array(
					'key'               => 'field_gociss_hero_title',
					'label'             => 'Заголовок',
					'name'              => 'gociss_hero_title',
					'type'              => 'text',
					'required'          => 1,
				),
				array(
					'key'               => 'field_gociss_hero_description',
					'label'             => 'Описание',
					'name'              => 'gociss_hero_description',
					'type'              => 'textarea',
				),
				array(
					'key'               => 'field_gociss_hero_image',
					'label'             => 'Изображение',
					'name'              => 'gociss_hero_image',
					'type'              => 'image',
					'return_format'     => 'array',
				),
				array(
					'key'               => 'field_gociss_hero_btn_primary',
					'label'             => 'Основная кнопка',
					'name'              => 'gociss_hero_btn_primary',
					'type'              => 'group',
					'sub_fields'        => array(
						array(
							'key'   => 'field_gociss_hero_btn_primary_text',
							'label' => 'Текст',
							'name'  => 'text',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_hero_btn_primary_url',
							'label' => 'Ссылка',
							'name'  => 'url',
							'type'  => 'url',
						),
					),
				),
				array(
					'key'               => 'field_gociss_hero_btn_secondary',
					'label'             => 'Вторичная кнопка',
					'name'              => 'gociss_hero_btn_secondary',
					'type'              => 'group',
					'sub_fields'        => array(
						array(
							'key'   => 'field_gociss_hero_btn_secondary_text',
							'label' => 'Текст',
							'name'  => 'text',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_hero_btn_secondary_url',
							'label' => 'Ссылка',
							'name'  => 'url',
							'type'  => 'url',
						),
					),
				),
				array(
					'key'               => 'field_gociss_hero_stats',
					'label'             => 'Статистика',
					'name'              => 'gociss_hero_stats',
					'type'              => 'repeater',
					'layout'            => 'table',
					'sub_fields'        => array(
						array(
							'key'   => 'field_gociss_hero_stats_number',
							'label' => 'Число',
							'name'  => 'number',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_hero_stats_label',
							'label' => 'Подпись',
							'name'  => 'label',
							'type'  => 'text',
						),
					),
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-front.php',
					),
				),
			),
		)
	);

	// Группа полей для секции Услуги
	acf_add_local_field_group(
		array(
			'key'                   => 'group_gociss_services',
			'title'                 => 'Секция Услуги',
			'fields'                => array(
				array(
					'key'               => 'field_gociss_services_title',
					'label'             => 'Заголовок',
					'name'              => 'gociss_services_title',
					'type'              => 'text',
					'default_value'     => 'Ключевые направления',
				),
				array(
					'key'               => 'field_gociss_services_subtitle',
					'label'             => 'Подзаголовок',
					'name'              => 'gociss_services_subtitle',
					'type'              => 'textarea',
				),
				array(
					'key'               => 'field_gociss_services_items',
					'label'             => 'Услуги',
					'name'              => 'gociss_services_items',
					'type'              => 'repeater',
					'layout'            => 'block',
					'sub_fields'        => array(
						array(
							'key'   => 'field_gociss_services_icon',
							'label' => 'Иконка',
							'name'  => 'icon',
							'type'  => 'image',
						),
						array(
							'key'   => 'field_gociss_services_title',
							'label' => 'Заголовок',
							'name'  => 'title',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_services_description',
							'label' => 'Описание',
							'name'  => 'description',
							'type'  => 'textarea',
						),
						array(
							'key'   => 'field_gociss_services_link',
							'label' => 'Ссылка',
							'name'  => 'link',
							'type'  => 'url',
						),
					),
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-front.php',
					),
				),
			),
		)
	);

	// Группа полей для секции Преимущества
	acf_add_local_field_group(
		array(
			'key'                   => 'group_gociss_advantages',
			'title'                 => 'Секция Преимущества',
			'fields'                => array(
				array(
					'key'               => 'field_gociss_advantages_title',
					'label'             => 'Заголовок',
					'name'              => 'gociss_advantages_title',
					'type'              => 'text',
					'default_value'     => 'Наши конкурентные преимущества',
				),
				array(
					'key'               => 'field_gociss_advantages_subtitle',
					'label'             => 'Подзаголовок',
					'name'              => 'gociss_advantages_subtitle',
					'type'              => 'textarea',
				),
				array(
					'key'               => 'field_gociss_advantages_items',
					'label'             => 'Преимущества',
					'name'              => 'gociss_advantages_items',
					'type'              => 'repeater',
					'layout'            => 'block',
					'sub_fields'        => array(
						array(
							'key'   => 'field_gociss_advantages_icon',
							'label' => 'Иконка',
							'name'  => 'icon',
							'type'  => 'image',
						),
						array(
							'key'   => 'field_gociss_advantages_text',
							'label' => 'Текст',
							'name'  => 'text',
							'type'  => 'textarea',
						),
					),
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-front.php',
					),
				),
			),
		)
	);

	// Группа полей для секции FAQ
	acf_add_local_field_group(
		array(
			'key'                   => 'group_gociss_faq',
			'title'                 => 'Секция FAQ',
			'fields'                => array(
				array(
					'key'               => 'field_gociss_faq_title',
					'label'             => 'Заголовок',
					'name'              => 'gociss_faq_title',
					'type'              => 'text',
					'default_value'     => 'Часто задаваемые вопросы',
				),
				array(
					'key'               => 'field_gociss_faq_subtitle',
					'label'             => 'Подзаголовок',
					'name'              => 'gociss_faq_subtitle',
					'type'              => 'textarea',
				),
				array(
					'key'               => 'field_gociss_faq_items',
					'label'             => 'Вопросы',
					'name'              => 'gociss_faq_items',
					'type'              => 'repeater',
					'layout'            => 'block',
					'sub_fields'        => array(
						array(
							'key'   => 'field_gociss_faq_question',
							'label' => 'Вопрос',
							'name'  => 'question',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_faq_answer',
							'label' => 'Ответ',
							'name'  => 'answer',
							'type'  => 'wysiwyg',
						),
					),
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-front.php',
					),
				),
			),
		)
	);
}
add_action( 'acf/init', 'gociss_register_acf_fields' );



