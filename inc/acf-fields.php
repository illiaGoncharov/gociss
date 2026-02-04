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
 * Путь для сохранения JSON полей ACF
 */
function gociss_acf_json_save_point( $path ) {
	return get_stylesheet_directory() . '/acf-json';
}
add_filter( 'acf/settings/save_json', 'gociss_acf_json_save_point' );

/**
 * Путь для загрузки JSON полей ACF
 */
function gociss_acf_json_load_point( $paths ) {
	unset( $paths[0] );
	$paths[] = get_stylesheet_directory() . '/acf-json';
	return $paths;
}
add_filter( 'acf/settings/load_json', 'gociss_acf_json_load_point' );

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
			'fields'                => 			array(
				array(
					'key'               => 'field_gociss_hero_label',
					'label'             => 'Метка',
					'name'              => 'gociss_hero_label',
					'type'              => 'text',
					'default_value'     => 'Аккредитованный орган по сертификации',
				),
				array(
					'key'               => 'field_gociss_hero_label_url',
					'label'             => 'Ссылка для метки',
					'name'              => 'gociss_hero_label_url',
					'type'              => 'url',
					'instructions'      => 'Если заполнено, метка станет кликабельной ссылкой. Например: https://aq-spb.ru/akr/',
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
				// Слайды для карусели (отдельные поля image вместо gallery для бесплатной версии ACF)
				array(
					'key'               => 'field_gociss_hero_slide_1',
					'label'             => 'Слайд 1',
					'name'              => 'gociss_hero_slide_1',
					'type'              => 'image',
					'instructions'      => 'Рекомендуемый размер: 600x400px',
					'return_format'     => 'array',
					'preview_size'      => 'medium',
					'library'           => 'all',
				),
				array(
					'key'               => 'field_gociss_hero_slide_2',
					'label'             => 'Слайд 2',
					'name'              => 'gociss_hero_slide_2',
					'type'              => 'image',
					'instructions'      => 'Рекомендуемый размер: 600x400px',
					'return_format'     => 'array',
					'preview_size'      => 'medium',
					'library'           => 'all',
				),
				array(
					'key'               => 'field_gociss_hero_slide_3',
					'label'             => 'Слайд 3',
					'name'              => 'gociss_hero_slide_3',
					'type'              => 'image',
					'instructions'      => 'Рекомендуемый размер: 600x400px',
					'return_format'     => 'array',
					'preview_size'      => 'medium',
					'library'           => 'all',
				),
				array(
					'key'               => 'field_gociss_hero_slide_4',
					'label'             => 'Слайд 4 (опционально)',
					'name'              => 'gociss_hero_slide_4',
					'type'              => 'image',
					'instructions'      => 'Рекомендуемый размер: 600x400px',
					'return_format'     => 'array',
					'preview_size'      => 'medium',
					'library'           => 'all',
				),
				array(
					'key'               => 'field_gociss_hero_slide_5',
					'label'             => 'Слайд 5 (опционально)',
					'name'              => 'gociss_hero_slide_5',
					'type'              => 'image',
					'instructions'      => 'Рекомендуемый размер: 600x400px',
					'return_format'     => 'array',
					'preview_size'      => 'medium',
					'library'           => 'all',
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
				// Статистика hero скрыта, репитер удалён
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

	// Услуги теперь управляются через CPT gociss_service
	// См. Админка → Услуги

	// Группа полей "Секция Услуги" - 8 фиксированных услуг
	$services_fields = array(
		array(
			'key'           => 'field_gociss_services_title_fixed',
			'label'         => 'Заголовок секции',
			'name'          => 'gociss_services_title',
			'type'          => 'text',
			'default_value' => 'Ключевые направления',
		),
		array(
			'key'           => 'field_gociss_services_subtitle_fixed',
			'label'         => 'Подзаголовок секции',
			'name'          => 'gociss_services_subtitle',
			'type'          => 'textarea',
			'rows'          => 2,
		),
	);

	// Генерируем 8 услуг
	for ( $i = 1; $i <= 8; $i++ ) {
		$services_fields[] = array(
			'key'          => 'field_gociss_service_' . $i . '_title',
			'label'        => '▼ Услуга ' . $i . ' (клик чтобы открыть)',
			'name'         => 'gociss_service_' . $i . '_title',
			'type'         => 'text',
			'instructions' => 'Заполните заголовок, чтобы услуга отображалась',
			'wrapper'      => array( 'class' => 'gociss-collapsible-header' ),
		);
		$services_fields[] = array(
			'key'           => 'field_gociss_service_' . $i . '_icon',
			'label'         => 'Иконка',
			'name'          => 'gociss_service_' . $i . '_icon',
			'type'          => 'image',
			'return_format' => 'array',
			'preview_size'  => 'thumbnail',
			'wrapper'       => array( 'class' => 'gociss-collapsible-content' ),
		);
		$services_fields[] = array(
			'key'     => 'field_gociss_service_' . $i . '_desc',
			'label'   => 'Описание',
			'name'    => 'gociss_service_' . $i . '_desc',
			'type'    => 'textarea',
			'rows'    => 2,
			'wrapper' => array( 'class' => 'gociss-collapsible-content' ),
		);
		$services_fields[] = array(
			'key'     => 'field_gociss_service_' . $i . '_link',
			'label'   => 'Ссылка',
			'name'    => 'gociss_service_' . $i . '_link',
			'type'    => 'url',
			'wrapper' => array( 'class' => 'gociss-collapsible-content gociss-collapsible-last' ),
		);
	}

	acf_add_local_field_group(
		array(
			'key'        => 'group_gociss_services_fixed',
			'title'      => 'Секция Услуги (8 шт)',
			'fields'     => $services_fields,
			'location'   => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-front.php',
					),
				),
			),
			'menu_order' => 2,
		)
	);

	// Группа полей "Секция Преимущества" - 6 фиксированных преимуществ
	acf_add_local_field_group(
		array(
			'key'                   => 'group_gociss_advantages_fixed',
			'title'                 => 'Секция Преимущества',
			'fields'                => array(
				array(
					'key'           => 'field_gociss_advantages_title_fixed',
					'label'         => 'Заголовок секции',
					'name'          => 'gociss_advantages_title',
					'type'          => 'text',
					'default_value' => 'Наши конкурентные преимущества',
				),
				array(
					'key'           => 'field_gociss_advantages_subtitle_fixed',
					'label'         => 'Подзаголовок секции',
					'name'          => 'gociss_advantages_subtitle',
					'type'          => 'textarea',
				),
				// Преимущество 1
				array(
					'key'   => 'field_gociss_advantage_1_icon',
					'label' => 'Преимущество 1: Иконка',
					'name'  => 'gociss_advantage_1_icon',
					'type'  => 'image',
					'return_format' => 'array',
					'preview_size'  => 'thumbnail',
				),
						array(
					'key'   => 'field_gociss_advantage_1_text',
					'label' => 'Преимущество 1: Текст',
					'name'  => 'gociss_advantage_1_text',
					'type'  => 'textarea',
					'rows'  => 2,
				),
				// Преимущество 2
				array(
					'key'   => 'field_gociss_advantage_2_icon',
					'label' => 'Преимущество 2: Иконка',
					'name'  => 'gociss_advantage_2_icon',
							'type'  => 'image',
					'return_format' => 'array',
					'preview_size'  => 'thumbnail',
						),
						array(
					'key'   => 'field_gociss_advantage_2_text',
					'label' => 'Преимущество 2: Текст',
					'name'  => 'gociss_advantage_2_text',
							'type'  => 'textarea',
					'rows'  => 2,
				),
				// Преимущество 3
				array(
					'key'   => 'field_gociss_advantage_3_icon',
					'label' => 'Преимущество 3: Иконка',
					'name'  => 'gociss_advantage_3_icon',
					'type'  => 'image',
					'return_format' => 'array',
					'preview_size'  => 'thumbnail',
				),
				array(
					'key'   => 'field_gociss_advantage_3_text',
					'label' => 'Преимущество 3: Текст',
					'name'  => 'gociss_advantage_3_text',
					'type'  => 'textarea',
					'rows'  => 2,
				),
				// Преимущество 4
				array(
					'key'   => 'field_gociss_advantage_4_icon',
					'label' => 'Преимущество 4: Иконка',
					'name'  => 'gociss_advantage_4_icon',
					'type'  => 'image',
					'return_format' => 'array',
					'preview_size'  => 'thumbnail',
				),
				array(
					'key'   => 'field_gociss_advantage_4_text',
					'label' => 'Преимущество 4: Текст',
					'name'  => 'gociss_advantage_4_text',
					'type'  => 'textarea',
					'rows'  => 2,
				),
				// Преимущество 5
				array(
					'key'   => 'field_gociss_advantage_5_icon',
					'label' => 'Преимущество 5: Иконка',
					'name'  => 'gociss_advantage_5_icon',
					'type'  => 'image',
					'return_format' => 'array',
					'preview_size'  => 'thumbnail',
				),
				array(
					'key'   => 'field_gociss_advantage_5_text',
					'label' => 'Преимущество 5: Текст',
					'name'  => 'gociss_advantage_5_text',
					'type'  => 'textarea',
					'rows'  => 2,
				),
				// Преимущество 6
				array(
					'key'   => 'field_gociss_advantage_6_icon',
					'label' => 'Преимущество 6: Иконка',
					'name'  => 'gociss_advantage_6_icon',
					'type'  => 'image',
					'return_format' => 'array',
					'preview_size'  => 'thumbnail',
				),
				array(
					'key'   => 'field_gociss_advantage_6_text',
					'label' => 'Преимущество 6: Текст',
					'name'  => 'gociss_advantage_6_text',
					'type'  => 'textarea',
					'rows'  => 2,
				),
				// Преимущество 7
				array(
					'key'   => 'field_gociss_advantage_7_icon',
					'label' => 'Преимущество 7: Иконка',
					'name'  => 'gociss_advantage_7_icon',
					'type'  => 'image',
					'return_format' => 'array',
					'preview_size'  => 'thumbnail',
				),
				array(
					'key'   => 'field_gociss_advantage_7_text',
					'label' => 'Преимущество 7: Текст',
					'name'  => 'gociss_advantage_7_text',
					'type'  => 'textarea',
					'rows'  => 2,
				),
				// Преимущество 8
				array(
					'key'   => 'field_gociss_advantage_8_icon',
					'label' => 'Преимущество 8: Иконка',
					'name'  => 'gociss_advantage_8_icon',
					'type'  => 'image',
					'return_format' => 'array',
					'preview_size'  => 'thumbnail',
				),
				array(
					'key'   => 'field_gociss_advantage_8_text',
					'label' => 'Преимущество 8: Текст',
					'name'  => 'gociss_advantage_8_text',
					'type'  => 'textarea',
					'rows'  => 2,
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
			'menu_order'            => 3,
		)
	);

	// Группа полей "Секция Эксперты" - 5 фиксированных экспертов
	acf_add_local_field_group(
		array(
			'key'                   => 'group_gociss_experts_fixed',
			'title'                 => 'Секция Эксперты',
			'fields'                => array(
				array(
					'key'           => 'field_gociss_experts_title_fixed',
					'label'         => 'Заголовок секции',
					'name'          => 'gociss_experts_title',
					'type'          => 'text',
					'default_value' => 'Наши ведущие эксперты',
				),
				array(
					'key'           => 'field_gociss_experts_subtitle_fixed',
					'label'         => 'Подзаголовок секции',
					'name'          => 'gociss_experts_subtitle',
					'type'          => 'textarea',
				),
				// Эксперт 1
				array(
					'key'           => 'field_gociss_expert_1_photo',
					'label'         => 'Эксперт 1: Фото',
					'name'          => 'gociss_expert_1_photo',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'medium',
				),
						array(
					'key'   => 'field_gociss_expert_1_name',
					'label' => 'Эксперт 1: ФИО',
					'name'  => 'gociss_expert_1_name',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_gociss_expert_1_position',
					'label' => 'Эксперт 1: Должность',
					'name'  => 'gociss_expert_1_position',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_gociss_expert_1_experience',
					'label' => 'Эксперт 1: Опыт',
					'name'  => 'gociss_expert_1_experience',
					'type'  => 'textarea',
					'rows'  => 2,
				),
				// Эксперт 2
				array(
					'key'           => 'field_gociss_expert_2_photo',
					'label'         => 'Эксперт 2: Фото',
					'name'          => 'gociss_expert_2_photo',
							'type'          => 'image',
							'return_format' => 'array',
							'preview_size'  => 'medium',
						),
						array(
					'key'   => 'field_gociss_expert_2_name',
					'label' => 'Эксперт 2: ФИО',
					'name'  => 'gociss_expert_2_name',
							'type'  => 'text',
						),
						array(
					'key'   => 'field_gociss_expert_2_position',
					'label' => 'Эксперт 2: Должность',
					'name'  => 'gociss_expert_2_position',
							'type'  => 'text',
						),
						array(
					'key'   => 'field_gociss_expert_2_experience',
					'label' => 'Эксперт 2: Опыт',
					'name'  => 'gociss_expert_2_experience',
							'type'  => 'textarea',
							'rows'  => 2,
						),
				// Эксперт 3
				array(
					'key'           => 'field_gociss_expert_3_photo',
					'label'         => 'Эксперт 3: Фото',
					'name'          => 'gociss_expert_3_photo',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'medium',
				),
				array(
					'key'   => 'field_gociss_expert_3_name',
					'label' => 'Эксперт 3: ФИО',
					'name'  => 'gociss_expert_3_name',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_gociss_expert_3_position',
					'label' => 'Эксперт 3: Должность',
					'name'  => 'gociss_expert_3_position',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_gociss_expert_3_experience',
					'label' => 'Эксперт 3: Опыт',
					'name'  => 'gociss_expert_3_experience',
					'type'  => 'textarea',
					'rows'  => 2,
				),
				// Эксперт 4
				array(
					'key'           => 'field_gociss_expert_4_photo',
					'label'         => 'Эксперт 4: Фото',
					'name'          => 'gociss_expert_4_photo',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'medium',
				),
				array(
					'key'   => 'field_gociss_expert_4_name',
					'label' => 'Эксперт 4: ФИО',
					'name'  => 'gociss_expert_4_name',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_gociss_expert_4_position',
					'label' => 'Эксперт 4: Должность',
					'name'  => 'gociss_expert_4_position',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_gociss_expert_4_experience',
					'label' => 'Эксперт 4: Опыт',
					'name'  => 'gociss_expert_4_experience',
					'type'  => 'textarea',
					'rows'  => 2,
				),
				// Эксперт 5
				array(
					'key'           => 'field_gociss_expert_5_photo',
					'label'         => 'Эксперт 5: Фото',
					'name'          => 'gociss_expert_5_photo',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'medium',
				),
				array(
					'key'   => 'field_gociss_expert_5_name',
					'label' => 'Эксперт 5: ФИО',
					'name'  => 'gociss_expert_5_name',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_gociss_expert_5_position',
					'label' => 'Эксперт 5: Должность',
					'name'  => 'gociss_expert_5_position',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_gociss_expert_5_experience',
					'label' => 'Эксперт 5: Опыт',
					'name'  => 'gociss_expert_5_experience',
					'type'  => 'textarea',
					'rows'  => 2,
				),
				// Эксперт 6
				array(
					'key'           => 'field_gociss_expert_6_photo',
					'label'         => 'Эксперт 6: Фото',
					'name'          => 'gociss_expert_6_photo',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'medium',
				),
				array(
					'key'   => 'field_gociss_expert_6_name',
					'label' => 'Эксперт 6: ФИО',
					'name'  => 'gociss_expert_6_name',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_gociss_expert_6_position',
					'label' => 'Эксперт 6: Должность',
					'name'  => 'gociss_expert_6_position',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_gociss_expert_6_experience',
					'label' => 'Эксперт 6: Опыт',
					'name'  => 'gociss_expert_6_experience',
					'type'  => 'textarea',
					'rows'  => 2,
				),
				// Эксперт 7
				array(
					'key'           => 'field_gociss_expert_7_photo',
					'label'         => 'Эксперт 7: Фото',
					'name'          => 'gociss_expert_7_photo',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'medium',
				),
				array(
					'key'   => 'field_gociss_expert_7_name',
					'label' => 'Эксперт 7: ФИО',
					'name'  => 'gociss_expert_7_name',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_gociss_expert_7_position',
					'label' => 'Эксперт 7: Должность',
					'name'  => 'gociss_expert_7_position',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_gociss_expert_7_experience',
					'label' => 'Эксперт 7: Опыт',
					'name'  => 'gociss_expert_7_experience',
					'type'  => 'textarea',
					'rows'  => 2,
				),
				// Эксперт 8
				array(
					'key'           => 'field_gociss_expert_8_photo',
					'label'         => 'Эксперт 8: Фото',
					'name'          => 'gociss_expert_8_photo',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'medium',
				),
				array(
					'key'   => 'field_gociss_expert_8_name',
					'label' => 'Эксперт 8: ФИО',
					'name'  => 'gociss_expert_8_name',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_gociss_expert_8_position',
					'label' => 'Эксперт 8: Должность',
					'name'  => 'gociss_expert_8_position',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_gociss_expert_8_experience',
					'label' => 'Эксперт 8: Опыт',
					'name'  => 'gociss_expert_8_experience',
					'type'  => 'textarea',
					'rows'  => 2,
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
			'menu_order'            => 4,
		)
	);

	// Группа полей "Секция FAQ" - 6 фиксированных вопросов
	acf_add_local_field_group(
		array(
			'key'                   => 'group_gociss_faq_fixed',
			'title'                 => 'Секция FAQ',
			'fields'                => array(
				array(
					'key'           => 'field_gociss_faq_title_fixed',
					'label'         => 'Заголовок секции',
					'name'          => 'gociss_faq_title',
					'type'          => 'text',
					'default_value' => 'Часто задаваемые вопросы',
				),
				array(
					'key'           => 'field_gociss_faq_subtitle_fixed',
					'label'         => 'Подзаголовок секции',
					'name'          => 'gociss_faq_subtitle',
					'type'          => 'textarea',
				),
				// Вопрос 1
				array(
					'key'   => 'field_gociss_faq_1_question',
					'label' => 'Вопрос 1',
					'name'  => 'gociss_faq_1_question',
					'type'  => 'text',
				),
						array(
					'key'   => 'field_gociss_faq_1_answer',
					'label' => 'Ответ 1',
					'name'  => 'gociss_faq_1_answer',
					'type'  => 'wysiwyg',
					'toolbar' => 'basic',
					'media_upload' => 0,
				),
				// Вопрос 2
				array(
					'key'   => 'field_gociss_faq_2_question',
					'label' => 'Вопрос 2',
					'name'  => 'gociss_faq_2_question',
							'type'  => 'text',
						),
						array(
					'key'   => 'field_gociss_faq_2_answer',
					'label' => 'Ответ 2',
					'name'  => 'gociss_faq_2_answer',
							'type'  => 'wysiwyg',
					'toolbar' => 'basic',
					'media_upload' => 0,
				),
				// Вопрос 3
				array(
					'key'   => 'field_gociss_faq_3_question',
					'label' => 'Вопрос 3',
					'name'  => 'gociss_faq_3_question',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_gociss_faq_3_answer',
					'label' => 'Ответ 3',
					'name'  => 'gociss_faq_3_answer',
					'type'  => 'wysiwyg',
					'toolbar' => 'basic',
					'media_upload' => 0,
				),
				// Вопрос 4
				array(
					'key'   => 'field_gociss_faq_4_question',
					'label' => 'Вопрос 4',
					'name'  => 'gociss_faq_4_question',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_gociss_faq_4_answer',
					'label' => 'Ответ 4',
					'name'  => 'gociss_faq_4_answer',
					'type'  => 'wysiwyg',
					'toolbar' => 'basic',
					'media_upload' => 0,
				),
				// Вопрос 5
				array(
					'key'   => 'field_gociss_faq_5_question',
					'label' => 'Вопрос 5',
					'name'  => 'gociss_faq_5_question',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_gociss_faq_5_answer',
					'label' => 'Ответ 5',
					'name'  => 'gociss_faq_5_answer',
					'type'  => 'wysiwyg',
					'toolbar' => 'basic',
					'media_upload' => 0,
				),
				// Вопрос 6
				array(
					'key'   => 'field_gociss_faq_6_question',
					'label' => 'Вопрос 6',
					'name'  => 'gociss_faq_6_question',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_gociss_faq_6_answer',
					'label' => 'Ответ 6',
					'name'  => 'gociss_faq_6_answer',
					'type'  => 'wysiwyg',
					'toolbar' => 'basic',
					'media_upload' => 0,
				),
				// Вопрос 7
				array(
					'key'   => 'field_gociss_faq_7_question',
					'label' => 'Вопрос 7',
					'name'  => 'gociss_faq_7_question',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_gociss_faq_7_answer',
					'label' => 'Ответ 7',
					'name'  => 'gociss_faq_7_answer',
					'type'  => 'wysiwyg',
					'toolbar' => 'basic',
					'media_upload' => 0,
				),
				// Вопрос 8
				array(
					'key'   => 'field_gociss_faq_8_question',
					'label' => 'Вопрос 8',
					'name'  => 'gociss_faq_8_question',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_gociss_faq_8_answer',
					'label' => 'Ответ 8',
					'name'  => 'gociss_faq_8_answer',
					'type'  => 'wysiwyg',
					'toolbar' => 'basic',
					'media_upload' => 0,
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
			'menu_order'            => 5,
		)
	);

	// Группа полей для секции Новости
	acf_add_local_field_group(
		array(
			'key'                   => 'group_gociss_news',
			'title'                 => 'Секция Новости',
			'fields'                => array(
				array(
					'key'               => 'field_gociss_news_title',
					'label'             => 'Заголовок',
					'name'              => 'gociss_news_title',
					'type'              => 'text',
					'default_value'     => 'Новости и статьи',
				),
				array(
					'key'               => 'field_gociss_news_subtitle',
					'label'             => 'Подзаголовок',
					'name'              => 'gociss_news_subtitle',
					'type'              => 'textarea',
					'default_value'     => 'Актуальная информация о сертификации и изменениях в законодательстве',
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
			'menu_order'            => 7,
		)
	);

	// Группа полей для секции География (карта России)
	acf_add_local_field_group(
		array(
			'key'                   => 'group_gociss_geography',
			'title'                 => 'Секция География (карта России)',
			'fields'                => array(
				array(
					'key'               => 'field_gociss_geo_title',
					'label'             => 'Заголовок',
					'name'              => 'gociss_geo_title',
					'type'              => 'text',
					'default_value'     => 'РАБОТАЕМ ПО ВСЕЙ РОССИИ',
				),
				array(
					'key'               => 'field_gociss_geo_btn',
					'label'             => 'Кнопка',
					'name'              => 'gociss_geo_btn',
					'type'              => 'group',
					'sub_fields'        => array(
						array(
							'key'   => 'field_gociss_geo_btn_text',
							'label' => 'Текст',
							'name'  => 'text',
							'type'  => 'text',
							'default_value' => 'ПОЗВОНИТЬ НАМ',
						),
						array(
							'key'   => 'field_gociss_geo_btn_url',
							'label' => 'Ссылка',
							'name'  => 'url',
							'type'  => 'url',
							'default_value' => 'tel:+74951234567',
						),
					),
				),
				array(
					'key'               => 'field_gociss_geo_map',
					'label'             => 'Карта России',
					'name'              => 'gociss_geo_map',
					'type'              => 'image',
					'instructions'      => 'Загрузите изображение карты России. Рекомендуемый размер: 800x500px',
					'return_format'     => 'array',
					'preview_size'      => 'medium',
					'library'           => 'all',
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
			'menu_order'            => 8,
		)
	);

	// Группа полей для секции Форма
	acf_add_local_field_group(
		array(
			'key'                   => 'group_gociss_form',
			'title'                 => 'Секция Форма обратной связи',
			'fields'                => array(
				array(
					'key'               => 'field_gociss_form_label',
					'label'             => 'Метка',
					'name'              => 'gociss_form_label',
					'type'              => 'text',
					'default_value'     => 'Связаться с нами',
				),
				array(
					'key'               => 'field_gociss_form_title',
					'label'             => 'Заголовок',
					'name'              => 'gociss_form_title',
					'type'              => 'text',
					'default_value'     => 'Оставить заявку',
				),
				array(
					'key'               => 'field_gociss_form_description',
					'label'             => 'Описание',
					'name'              => 'gociss_form_description',
					'type'              => 'textarea',
					'default_value'     => 'Заполните форму, и наш эксперт свяжется с вами в течение 30 минут',
				),
				array(
					'key'               => 'field_gociss_form_shortcode',
					'label'             => 'Шорткод Contact Form 7',
					'name'              => 'gociss_form_shortcode',
					'type'              => 'text',
					'instructions'      => 'Вставьте шорткод формы Contact Form 7, например: [contact-form-7 id="274d127" title="Контактная Форма Главная"]',
					'default_value'     => '[contact-form-7 id="274d127" title="Контактная Форма Главная"]',
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
			'menu_order'            => 10,
		)
	);

	// Группа полей для секции CTA
	acf_add_local_field_group(
		array(
			'key'                   => 'group_gociss_cta',
			'title'                 => 'Секция CTA (Призыв к действию)',
			'fields'                => array(
				array(
					'key'               => 'field_gociss_cta_label',
					'label'             => 'Метка',
					'name'              => 'gociss_cta_label',
					'type'              => 'text',
					'default_value'     => 'Начните прямо сейчас',
				),
				array(
					'key'               => 'field_gociss_cta_title',
					'label'             => 'Заголовок',
					'name'              => 'gociss_cta_title',
					'type'              => 'text',
					'default_value'     => 'Готовы начать сертификацию?',
				),
				array(
					'key'               => 'field_gociss_cta_description',
					'label'             => 'Описание',
					'name'              => 'gociss_cta_description',
					'type'              => 'textarea',
					'default_value'     => 'Получите бесплатную консультацию эксперта и узнайте точные сроки и стоимость сертификации для вашего продукта',
				),
				array(
					'key'               => 'field_gociss_cta_btn_primary',
					'label'             => 'Кнопка с рамкой',
					'name'              => 'gociss_cta_btn_primary',
					'type'              => 'group',
					'sub_fields'        => array(
						array(
							'key'   => 'field_gociss_cta_btn_primary_text',
							'label' => 'Текст',
							'name'  => 'text',
							'type'  => 'text',
							'default_value' => 'Получить консультацию',
						),
						array(
							'key'   => 'field_gociss_cta_btn_primary_url',
							'label' => 'Ссылка',
							'name'  => 'url',
							'type'  => 'url',
						),
					),
				),
				array(
					'key'               => 'field_gociss_cta_btn_secondary',
					'label'             => 'Кнопка залитая',
					'name'              => 'gociss_cta_btn_secondary',
					'type'              => 'group',
					'sub_fields'        => array(
						array(
							'key'   => 'field_gociss_cta_btn_secondary_text',
							'label' => 'Текст',
							'name'  => 'text',
							'type'  => 'text',
							'default_value' => 'Заказать обратный звонок',
						),
						array(
							'key'   => 'field_gociss_cta_btn_secondary_url',
							'label' => 'Ссылка',
							'name'  => 'url',
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

	// Группа полей для секции Партнёры
	acf_add_local_field_group(
		array(
			'key'                   => 'group_gociss_partners',
			'title'                 => 'Секция Партнёры и ресурсы',
			'fields'                => array(
				array(
					'key'               => 'field_gociss_partners_actions',
					'label'             => 'Быстрые действия',
					'name'              => 'gociss_partners_actions',
					'type'              => 'repeater',
					'layout'            => 'block',
					'button_label'      => 'Добавить действие',
					'max'               => 5,
					'min'               => 3,
					'sub_fields'        => array(
						array(
							'key'           => 'field_gociss_partners_action_icon',
							'label'         => 'Иконка',
							'name'          => 'icon_image',
							'type'          => 'image',
							'return_format' => 'array',
							'preview_size'  => 'thumbnail',
							'instructions'  => 'Рекомендуемый размер: 48x48px, формат SVG или PNG. Если не загружено, будет использована иконка из папки pre-footer',
						),
						array(
							'key'           => 'field_gociss_partners_action_icon_file',
							'label'         => 'Имя файла иконки (если не загружено)',
							'name'          => 'icon',
							'type'          => 'text',
							'instructions'  => 'Имя файла из папки pre-footer (например: zay_w.png.png, oper_w.png.png, phone_w.png.png)',
							'default_value' => 'zay_w.png.png',
						),
						array(
							'key'           => 'field_gociss_partners_action_title',
							'label'         => 'Название',
							'name'          => 'title',
							'type'          => 'text',
							'required'      => 0,
							'default_value' => 'Заявка на почту',
						),
						array(
							'key'           => 'field_gociss_partners_action_url',
							'label'         => 'Ссылка',
							'name'          => 'url',
							'type'          => 'text',
							'required'      => 0,
							'instructions'  => 'Можно использовать: http://, https://, mailto:, tel:',
							'default_value' => 'mailto:info@gociss.ru',
							'placeholder'   => 'mailto:info@gociss.ru или tel:+74951234567',
						),
					),
					'default_value'     => array(
						array(
							'icon'  => 'zay_w.png.png',
							'title' => 'Заявка на почту',
							'url'   => 'mailto:info@gociss.ru',
						),
						array(
							'icon'  => 'oper_w.png.png',
							'title' => 'Консультация',
							'url'   => '#form',
						),
						array(
							'icon'  => 'phone_w.png.png',
							'title' => 'Звонок',
							'url'   => 'tel:+74951234567',
						),
					),
				),
				array(
					'key'               => 'field_gociss_partners_items',
					'label'             => 'Партнёры/Ресурсы',
					'name'              => 'gociss_partners_items',
					'type'              => 'repeater',
					'layout'            => 'block',
					'button_label'      => 'Добавить партнёра',
					'sub_fields'        => array(
						array(
							'key'           => 'field_gociss_partners_item_image',
							'label'         => 'Изображение',
							'name'          => 'image',
							'type'          => 'image',
							'return_format' => 'array',
							'preview_size'  => 'medium',
							'instructions'  => 'Загрузите изображение карточки партнёра. Рекомендуемый размер: 300x80px',
						),
						array(
							'key'           => 'field_gociss_partners_item_title',
							'label'         => 'Название',
							'name'          => 'title',
							'type'          => 'text',
							'required'      => 0,
							'default_value' => 'Партнёр',
						),
						array(
							'key'           => 'field_gociss_partners_item_url',
							'label'         => 'Ссылка',
							'name'          => 'url',
							'type'          => 'url',
							'required'      => 0,
							'default_value' => 'https://',
						),
					),
					'default_value'     => array(
						array(
							'title' => 'Правительство РФ',
							'url'   => 'https://government.ru/',
						),
						array(
							'title' => 'Министерство экономического развития РФ',
							'url'   => 'https://www.economy.gov.ru/',
						),
						array(
							'title' => 'Федеральная служба по аккредитации',
							'url'   => 'https://fsa.gov.ru/',
						),
						array(
							'title' => 'ЕИС закупки',
							'url'   => 'https://zakupki.gov.ru/',
						),
						array(
							'title' => 'МИНПРОМТОРГ',
							'url'   => 'https://minpromtorg.gov.ru/',
						),
						array(
							'title' => 'РОССТАНДАРТ',
							'url'   => 'https://www.rst.gov.ru/',
						),
						array(
							'title' => 'ГОСУСЛУГИ',
							'url'   => 'https://www.gosuslugi.ru/',
						),
						array(
							'title' => 'ЧЕСТНЫЙ ЗНАК',
							'url'   => 'https://chestnyznak.ru/',
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
			'menu_order'            => 12,
		)
	);

	// Группа полей для настроек футера
	acf_add_local_field_group(
		array(
			'key'                   => 'group_gociss_footer',
			'title'                 => 'Настройки футера',
			'fields'                => array(
				array(
					'key'               => 'field_gociss_footer_logo',
					'label'             => 'Логотип футера',
					'name'              => 'gociss_footer_logo',
					'type'              => 'image',
					'return_format'     => 'url',
					'preview_size'      => 'medium',
				),
				array(
					'key'               => 'field_gociss_footer_cert_image',
					'label'             => 'Изображение сертификата',
					'name'              => 'gociss_footer_cert_image',
					'type'              => 'image',
					'return_format'     => 'url',
					'preview_size'      => 'medium',
				),
				array(
					'key'               => 'field_gociss_footer_cert_text',
					'label'             => 'Текст сертификата',
					'name'              => 'gociss_footer_cert_text',
					'type'              => 'textarea',
					'rows'              => 3,
					'placeholder'       => 'RA.RU.13CM43',
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'options_page',
						'operator' => '==',
						'value'    => 'acf-options',
					),
				),
			),
		)
	);

	// ======================================================================
	// ГРУППЫ ПОЛЕЙ ДЛЯ ШАБЛОНА "СТРАНИЦА УСЛУГИ" (page-service.php)
	// ======================================================================

	// Hero секция страницы услуги (баннер + описание + поинты)
	acf_add_local_field_group(
		array(
			'key'                   => 'group_gociss_service_hero',
			'title'                 => 'Услуга: Hero секция',
			'fields'                => array(
				// Баннер на всю ширину
				array(
					'key'               => 'field_gociss_service_banner',
					'label'             => 'Баннер (фото на всю ширину)',
					'name'              => 'gociss_service_banner',
					'type'              => 'image',
					'instructions'      => 'Большое фото для баннера сверху. Рекомендуемый размер: 1920x700px',
					'return_format'     => 'array',
					'preview_size'      => 'large',
				),
				// Заголовок на баннере
				array(
					'key'               => 'field_gociss_service_hero_title',
					'label'             => 'Заголовок на баннере',
					'name'              => 'gociss_service_hero_title',
					'type'              => 'textarea',
					'rows'              => 3,
					'instructions'      => 'Заголовок поверх баннера. Можно использовать &lt;br&gt; для переноса строки. Если не заполнено, используется название страницы.',
				),
				// Буллет 1
				array(
					'key'               => 'field_gociss_service_hero_bullet_1',
					'label'             => 'Буллет 1',
					'name'              => 'gociss_service_hero_bullet_1',
					'type'              => 'text',
					'default_value'     => 'Государственная аккредитация',
				),
				// Буллет 2
				array(
					'key'               => 'field_gociss_service_hero_bullet_2',
					'label'             => 'Буллет 2',
					'name'              => 'gociss_service_hero_bullet_2',
					'type'              => 'text',
					'default_value'     => 'Официальное оформление',
				),
				// Буллет 3
				array(
					'key'               => 'field_gociss_service_hero_bullet_3',
					'label'             => 'Буллет 3',
					'name'              => 'gociss_service_hero_bullet_3',
					'type'              => 'text',
					'default_value'     => 'Короткие сроки получения',
				),
				// Буллет 4
				array(
					'key'               => 'field_gociss_service_hero_bullet_4',
					'label'             => 'Буллет 4',
					'name'              => 'gociss_service_hero_bullet_4',
					'type'              => 'text',
					'default_value'     => 'Работаем по всей России',
				),
				// Буллет 5 (опционально)
				array(
					'key'               => 'field_gociss_service_hero_bullet_5',
					'label'             => 'Буллет 5 (опционально)',
					'name'              => 'gociss_service_hero_bullet_5',
					'type'              => 'text',
				),
				// Буллет 6 (опционально)
				array(
					'key'               => 'field_gociss_service_hero_bullet_6',
					'label'             => 'Буллет 6 (опционально)',
					'name'              => 'gociss_service_hero_bullet_6',
					'type'              => 'text',
				),
				// Основная кнопка
				array(
					'key'               => 'field_gociss_service_hero_btn_primary',
					'label'             => 'Основная кнопка (залитая)',
					'name'              => 'gociss_service_hero_btn_primary',
					'type'              => 'group',
					'sub_fields'        => array(
						array(
							'key'   => 'field_gociss_service_hero_btn_primary_text',
							'label' => 'Текст',
							'name'  => 'text',
							'type'  => 'text',
							'default_value' => 'Обратный звонок',
						),
						array(
							'key'   => 'field_gociss_service_hero_btn_primary_url',
							'label' => 'Ссылка',
							'name'  => 'url',
							'type'  => 'text',
							'default_value' => '#form',
						),
					),
				),
				// Вторичная кнопка
				array(
					'key'               => 'field_gociss_service_hero_btn_secondary',
					'label'             => 'Вторичная кнопка (с рамкой)',
					'name'              => 'gociss_service_hero_btn_secondary',
					'type'              => 'group',
					'sub_fields'        => array(
						array(
							'key'   => 'field_gociss_service_hero_btn_secondary_text',
							'label' => 'Текст',
							'name'  => 'text',
							'type'  => 'text',
							'default_value' => 'Рассчитать стоимость',
						),
						array(
							'key'   => 'field_gociss_service_hero_btn_secondary_url',
							'label' => 'Ссылка',
							'name'  => 'url',
							'type'  => 'text',
							'default_value' => '#pricing',
						),
					),
				),
				// Заголовок услуги (для секции описания ниже)
				array(
					'key'               => 'field_gociss_service_title',
					'label'             => 'Заголовок секции описания',
					'name'              => 'gociss_service_title',
					'type'              => 'text',
					'instructions'      => 'Заголовок для секции описания под баннером. Если не заполнено, используется название страницы',
				),
				// Описание услуги (несколько абзацев)
				array(
					'key'               => 'field_gociss_service_description',
					'label'             => 'Описание услуги',
					'name'              => 'gociss_service_description',
					'type'              => 'wysiwyg',
					'toolbar'           => 'basic',
					'media_upload'      => 0,
					'instructions'      => 'Текст описания, который отображается слева от картинки сертификата',
				),
				// Текст кнопки консультации
				array(
					'key'               => 'field_gociss_service_btn_text',
					'label'             => 'Текст кнопки',
					'name'              => 'gociss_service_btn_text',
					'type'              => 'text',
					'default_value'     => 'Бесплатная консультация',
					'instructions'      => 'Кнопка ведёт на форму обратной связи (#form)',
				),
				// Изображение сертификата с поинтами
				array(
					'key'               => 'field_gociss_service_cert_image',
					'label'             => 'Изображение сертификата с поинтами',
					'name'              => 'gociss_service_cert_image',
					'type'              => 'image',
					'instructions'      => 'Картинка сертификата с нумерованными метками. Рекомендуемый размер: 400x550px',
					'return_format'     => 'array',
					'preview_size'      => 'medium',
				),
				// Поинт 1
				array(
					'key'          => 'field_gociss_service_point_1',
					'label'        => 'Пункт 1',
					'name'         => 'gociss_service_point_1',
					'type'         => 'group',
					'layout'       => 'block',
					'sub_fields'   => array(
						array(
							'key'   => 'field_gociss_service_point_1_title',
							'label' => 'Заголовок',
							'name'  => 'title',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_service_point_1_desc',
							'label' => 'Описание',
							'name'  => 'description',
							'type'  => 'textarea',
							'rows'  => 2,
						),
					),
				),
				// Поинт 2
				array(
					'key'          => 'field_gociss_service_point_2',
					'label'        => 'Пункт 2',
					'name'         => 'gociss_service_point_2',
					'type'         => 'group',
					'layout'       => 'block',
					'sub_fields'   => array(
						array(
							'key'   => 'field_gociss_service_point_2_title',
							'label' => 'Заголовок',
							'name'  => 'title',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_service_point_2_desc',
							'label' => 'Описание',
							'name'  => 'description',
							'type'  => 'textarea',
							'rows'  => 2,
						),
					),
				),
				// Поинт 3
				array(
					'key'          => 'field_gociss_service_point_3',
					'label'        => 'Пункт 3',
					'name'         => 'gociss_service_point_3',
					'type'         => 'group',
					'layout'       => 'block',
					'sub_fields'   => array(
						array(
							'key'   => 'field_gociss_service_point_3_title',
							'label' => 'Заголовок',
							'name'  => 'title',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_service_point_3_desc',
							'label' => 'Описание',
							'name'  => 'description',
							'type'  => 'textarea',
							'rows'  => 2,
						),
					),
				),
				// Поинт 4
				array(
					'key'          => 'field_gociss_service_point_4',
					'label'        => 'Пункт 4',
					'name'         => 'gociss_service_point_4',
					'type'         => 'group',
					'layout'       => 'block',
					'sub_fields'   => array(
						array(
							'key'   => 'field_gociss_service_point_4_title',
							'label' => 'Заголовок',
							'name'  => 'title',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_service_point_4_desc',
							'label' => 'Описание',
							'name'  => 'description',
							'type'  => 'textarea',
							'rows'  => 2,
						),
					),
				),
				// Поинт 5 (опционально)
				array(
					'key'          => 'field_gociss_service_point_5',
					'label'        => 'Пункт 5 (опционально)',
					'name'         => 'gociss_service_point_5',
					'type'         => 'group',
					'layout'       => 'block',
					'sub_fields'   => array(
						array(
							'key'   => 'field_gociss_service_point_5_title',
							'label' => 'Заголовок',
							'name'  => 'title',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_service_point_5_desc',
							'label' => 'Описание',
							'name'  => 'description',
							'type'  => 'textarea',
							'rows'  => 2,
						),
					),
				),
				// Поинт 6 (опционально)
				array(
					'key'          => 'field_gociss_service_point_6',
					'label'        => 'Пункт 6 (опционально)',
					'name'         => 'gociss_service_point_6',
					'type'         => 'group',
					'layout'       => 'block',
					'sub_fields'   => array(
						array(
							'key'   => 'field_gociss_service_point_6_title',
							'label' => 'Заголовок',
							'name'  => 'title',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_service_point_6_desc',
							'label' => 'Описание',
							'name'  => 'description',
							'type'  => 'textarea',
							'rows'  => 2,
						),
					),
				),
				// Поинт 7 (опционально)
				array(
					'key'          => 'field_gociss_service_point_7',
					'label'        => 'Пункт 7 (опционально)',
					'name'         => 'gociss_service_point_7',
					'type'         => 'group',
					'layout'       => 'block',
					'sub_fields'   => array(
						array(
							'key'   => 'field_gociss_service_point_7_title',
							'label' => 'Заголовок',
							'name'  => 'title',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_service_point_7_desc',
							'label' => 'Описание',
							'name'  => 'description',
							'type'  => 'textarea',
							'rows'  => 2,
						),
					),
				),
				// Поинт 8 (опционально)
				array(
					'key'          => 'field_gociss_service_point_8',
					'label'        => 'Пункт 8 (опционально)',
					'name'         => 'gociss_service_point_8',
					'type'         => 'group',
					'layout'       => 'block',
					'sub_fields'   => array(
						array(
							'key'   => 'field_gociss_service_point_8_title',
							'label' => 'Заголовок',
							'name'  => 'title',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_service_point_8_desc',
							'label' => 'Описание',
							'name'  => 'description',
							'type'  => 'textarea',
							'rows'  => 2,
						),
					),
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-service.php',
					),
				),
			),
			'menu_order'            => 0,
		)
	);

	// Секция стоимости
	acf_add_local_field_group(
		array(
			'key'                   => 'group_gociss_service_pricing',
			'title'                 => 'Услуга: Стоимость',
			'fields'                => array(
				array(
					'key'               => 'field_gociss_service_pricing_title',
					'label'             => 'Заголовок',
					'name'              => 'gociss_service_pricing_title',
					'type'              => 'text',
					'default_value'     => 'Стоимость сертификации',
				),
				array(
					'key'               => 'field_gociss_service_pricing_subtitle',
					'label'             => 'Подзаголовок',
					'name'              => 'gociss_service_pricing_subtitle',
					'type'              => 'textarea',
					'rows'              => 2,
					'default_value'     => 'Выберите подходящий вариант сертификации',
				),
				// Карточка 1
				array(
					'key'          => 'field_gociss_service_pricing_card_1',
					'label'        => 'Карточка 1',
					'name'         => 'gociss_service_pricing_card_1',
					'type'         => 'group',
					'layout'       => 'block',
					'sub_fields'   => array(
						array(
							'key'           => 'field_gociss_service_pricing_card_1_icon',
							'label'         => 'Иконка',
							'name'          => 'icon',
							'type'          => 'image',
							'return_format' => 'array',
							'preview_size'  => 'thumbnail',
						),
						array(
							'key'   => 'field_gociss_service_pricing_card_1_title',
							'label' => 'Название',
							'name'  => 'title',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_service_pricing_card_1_desc',
							'label' => 'Описание',
							'name'  => 'description',
							'type'  => 'textarea',
							'rows'  => 2,
						),
						array(
							'key'          => 'field_gociss_service_pricing_card_1_price',
							'label'        => 'Цена',
							'name'         => 'price',
							'type'         => 'text',
							'instructions' => 'Например: "от 15 000 ₽" или "Бесплатно"',
						),
						array(
							'key'           => 'field_gociss_service_pricing_card_1_btn_text',
							'label'         => 'Текст кнопки',
							'name'          => 'button_text',
							'type'          => 'text',
							'default_value' => 'Заказать',
						),
						array(
							'key'           => 'field_gociss_service_pricing_card_1_btn_url',
							'label'         => 'Ссылка кнопки',
							'name'          => 'button_url',
							'type'          => 'text',
							'default_value' => '#form',
						),
					),
				),
				// Карточка 2
				array(
					'key'          => 'field_gociss_service_pricing_card_2',
					'label'        => 'Карточка 2',
					'name'         => 'gociss_service_pricing_card_2',
					'type'         => 'group',
					'layout'       => 'block',
					'sub_fields'   => array(
						array(
							'key'           => 'field_gociss_service_pricing_card_2_icon',
							'label'         => 'Иконка',
							'name'          => 'icon',
							'type'          => 'image',
							'return_format' => 'array',
							'preview_size'  => 'thumbnail',
						),
						array(
							'key'   => 'field_gociss_service_pricing_card_2_title',
							'label' => 'Название',
							'name'  => 'title',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_service_pricing_card_2_desc',
							'label' => 'Описание',
							'name'  => 'description',
							'type'  => 'textarea',
							'rows'  => 2,
						),
						array(
							'key'          => 'field_gociss_service_pricing_card_2_price',
							'label'        => 'Цена',
							'name'         => 'price',
							'type'         => 'text',
							'instructions' => 'Например: "от 15 000 ₽" или "Бесплатно"',
						),
						array(
							'key'           => 'field_gociss_service_pricing_card_2_btn_text',
							'label'         => 'Текст кнопки',
							'name'          => 'button_text',
							'type'          => 'text',
							'default_value' => 'Заказать',
						),
						array(
							'key'           => 'field_gociss_service_pricing_card_2_btn_url',
							'label'         => 'Ссылка кнопки',
							'name'          => 'button_url',
							'type'          => 'text',
							'default_value' => '#form',
						),
					),
				),
				// Карточка 3
				array(
					'key'          => 'field_gociss_service_pricing_card_3',
					'label'        => 'Карточка 3',
					'name'         => 'gociss_service_pricing_card_3',
					'type'         => 'group',
					'layout'       => 'block',
					'sub_fields'   => array(
						array(
							'key'           => 'field_gociss_service_pricing_card_3_icon',
							'label'         => 'Иконка',
							'name'          => 'icon',
							'type'          => 'image',
							'return_format' => 'array',
							'preview_size'  => 'thumbnail',
						),
						array(
							'key'   => 'field_gociss_service_pricing_card_3_title',
							'label' => 'Название',
							'name'  => 'title',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_service_pricing_card_3_desc',
							'label' => 'Описание',
							'name'  => 'description',
							'type'  => 'textarea',
							'rows'  => 2,
						),
						array(
							'key'          => 'field_gociss_service_pricing_card_3_price',
							'label'        => 'Цена',
							'name'         => 'price',
							'type'         => 'text',
							'instructions' => 'Например: "от 15 000 ₽" или "Бесплатно"',
						),
						array(
							'key'           => 'field_gociss_service_pricing_card_3_btn_text',
							'label'         => 'Текст кнопки',
							'name'          => 'button_text',
							'type'          => 'text',
							'default_value' => 'Заказать',
						),
						array(
							'key'           => 'field_gociss_service_pricing_card_3_btn_url',
							'label'         => 'Ссылка кнопки',
							'name'          => 'button_url',
							'type'          => 'text',
							'default_value' => '#form',
						),
					),
				),
				// Карточка 4
				array(
					'key'          => 'field_gociss_service_pricing_card_4',
					'label'        => 'Карточка 4',
					'name'         => 'gociss_service_pricing_card_4',
					'type'         => 'group',
					'layout'       => 'block',
					'sub_fields'   => array(
						array(
							'key'           => 'field_gociss_service_pricing_card_4_icon',
							'label'         => 'Иконка',
							'name'          => 'icon',
							'type'          => 'image',
							'return_format' => 'array',
							'preview_size'  => 'thumbnail',
						),
						array(
							'key'   => 'field_gociss_service_pricing_card_4_title',
							'label' => 'Название',
							'name'  => 'title',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_service_pricing_card_4_desc',
							'label' => 'Описание',
							'name'  => 'description',
							'type'  => 'textarea',
							'rows'  => 2,
						),
						array(
							'key'          => 'field_gociss_service_pricing_card_4_price',
							'label'        => 'Цена',
							'name'         => 'price',
							'type'         => 'text',
							'instructions' => 'Например: "от 15 000 ₽" или "Бесплатно"',
						),
						array(
							'key'           => 'field_gociss_service_pricing_card_4_btn_text',
							'label'         => 'Текст кнопки',
							'name'          => 'button_text',
							'type'          => 'text',
							'default_value' => 'Заказать',
						),
						array(
							'key'           => 'field_gociss_service_pricing_card_4_btn_url',
							'label'         => 'Ссылка кнопки',
							'name'          => 'button_url',
							'type'          => 'text',
							'default_value' => '#form',
						),
					),
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-service.php',
					),
				),
			),
			'menu_order'            => 1,
		)
	);

	// Секция процесса
	acf_add_local_field_group(
		array(
			'key'                   => 'group_gociss_service_process',
			'title'                 => 'Услуга: Процесс получения',
			'fields'                => array(
				array(
					'key'               => 'field_gociss_service_process_title',
					'label'             => 'Заголовок',
					'name'              => 'gociss_service_process_title',
					'type'              => 'text',
					'default_value'     => 'Процесс получения сертификата',
				),
				array(
					'key'               => 'field_gociss_service_process_subtitle',
					'label'             => 'Подзаголовок',
					'name'              => 'gociss_service_process_subtitle',
					'type'              => 'textarea',
					'rows'              => 2,
					'default_value'     => 'Полная схема сертификации в 8 этапов',
				),
				// Шаг 1
				array(
					'key'        => 'field_gociss_service_process_step_1',
					'label'      => 'Шаг 1',
					'name'       => 'gociss_service_process_step_1',
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'           => 'field_gociss_service_process_step_1_icon',
							'label'         => 'Иконка',
							'name'          => 'icon',
							'type'          => 'image',
							'return_format' => 'array',
						),
						array(
							'key'   => 'field_gociss_service_process_step_1_title',
							'label' => 'Название',
							'name'  => 'title',
							'type'  => 'text',
						),
						array(
							'key'  => 'field_gociss_service_process_step_1_desc',
							'label' => 'Описание',
							'name'  => 'description',
							'type'  => 'textarea',
							'rows'  => 2,
						),
					),
				),
				// Шаг 2
				array(
					'key'        => 'field_gociss_service_process_step_2',
					'label'      => 'Шаг 2',
					'name'       => 'gociss_service_process_step_2',
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'           => 'field_gociss_service_process_step_2_icon',
							'label'         => 'Иконка',
							'name'          => 'icon',
							'type'          => 'image',
							'return_format' => 'array',
						),
						array(
							'key'   => 'field_gociss_service_process_step_2_title',
							'label' => 'Название',
							'name'  => 'title',
							'type'  => 'text',
						),
						array(
							'key'  => 'field_gociss_service_process_step_2_desc',
							'label' => 'Описание',
							'name'  => 'description',
							'type'  => 'textarea',
							'rows'  => 2,
						),
					),
				),
				// Шаг 3
				array(
					'key'        => 'field_gociss_service_process_step_3',
					'label'      => 'Шаг 3',
					'name'       => 'gociss_service_process_step_3',
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'           => 'field_gociss_service_process_step_3_icon',
							'label'         => 'Иконка',
							'name'          => 'icon',
							'type'          => 'image',
							'return_format' => 'array',
						),
						array(
							'key'   => 'field_gociss_service_process_step_3_title',
							'label' => 'Название',
							'name'  => 'title',
							'type'  => 'text',
						),
						array(
							'key'  => 'field_gociss_service_process_step_3_desc',
							'label' => 'Описание',
							'name'  => 'description',
							'type'  => 'textarea',
							'rows'  => 2,
						),
					),
				),
				// Шаг 4
				array(
					'key'        => 'field_gociss_service_process_step_4',
					'label'      => 'Шаг 4',
					'name'       => 'gociss_service_process_step_4',
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'           => 'field_gociss_service_process_step_4_icon',
							'label'         => 'Иконка',
							'name'          => 'icon',
							'type'          => 'image',
							'return_format' => 'array',
						),
						array(
							'key'   => 'field_gociss_service_process_step_4_title',
							'label' => 'Название',
							'name'  => 'title',
							'type'  => 'text',
						),
						array(
							'key'  => 'field_gociss_service_process_step_4_desc',
							'label' => 'Описание',
							'name'  => 'description',
							'type'  => 'textarea',
							'rows'  => 2,
						),
					),
				),
				// Шаг 5
				array(
					'key'        => 'field_gociss_service_process_step_5',
					'label'      => 'Шаг 5',
					'name'       => 'gociss_service_process_step_5',
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'           => 'field_gociss_service_process_step_5_icon',
							'label'         => 'Иконка',
							'name'          => 'icon',
							'type'          => 'image',
							'return_format' => 'array',
						),
						array(
							'key'   => 'field_gociss_service_process_step_5_title',
							'label' => 'Название',
							'name'  => 'title',
							'type'  => 'text',
						),
						array(
							'key'  => 'field_gociss_service_process_step_5_desc',
							'label' => 'Описание',
							'name'  => 'description',
							'type'  => 'textarea',
							'rows'  => 2,
						),
					),
				),
				// Шаг 6
				array(
					'key'        => 'field_gociss_service_process_step_6',
					'label'      => 'Шаг 6',
					'name'       => 'gociss_service_process_step_6',
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'           => 'field_gociss_service_process_step_6_icon',
							'label'         => 'Иконка',
							'name'          => 'icon',
							'type'          => 'image',
							'return_format' => 'array',
						),
						array(
							'key'   => 'field_gociss_service_process_step_6_title',
							'label' => 'Название',
							'name'  => 'title',
							'type'  => 'text',
						),
						array(
							'key'  => 'field_gociss_service_process_step_6_desc',
							'label' => 'Описание',
							'name'  => 'description',
							'type'  => 'textarea',
							'rows'  => 2,
						),
					),
				),
				// Шаг 7
				array(
					'key'        => 'field_gociss_service_process_step_7',
					'label'      => 'Шаг 7',
					'name'       => 'gociss_service_process_step_7',
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'           => 'field_gociss_service_process_step_7_icon',
							'label'         => 'Иконка',
							'name'          => 'icon',
							'type'          => 'image',
							'return_format' => 'array',
						),
						array(
							'key'   => 'field_gociss_service_process_step_7_title',
							'label' => 'Название',
							'name'  => 'title',
							'type'  => 'text',
						),
						array(
							'key'  => 'field_gociss_service_process_step_7_desc',
							'label' => 'Описание',
							'name'  => 'description',
							'type'  => 'textarea',
							'rows'  => 2,
						),
					),
				),
				// Шаг 8
				array(
					'key'        => 'field_gociss_service_process_step_8',
					'label'      => 'Шаг 8',
					'name'       => 'gociss_service_process_step_8',
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'           => 'field_gociss_service_process_step_8_icon',
							'label'         => 'Иконка',
							'name'          => 'icon',
							'type'          => 'image',
							'return_format' => 'array',
						),
						array(
							'key'   => 'field_gociss_service_process_step_8_title',
							'label' => 'Название',
							'name'  => 'title',
							'type'  => 'text',
						),
						array(
							'key'  => 'field_gociss_service_process_step_8_desc',
							'label' => 'Описание',
							'name'  => 'description',
							'type'  => 'textarea',
							'rows'  => 2,
						),
					),
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-service.php',
					),
				),
			),
			'menu_order'            => 2,
		)
	);

	// Секция примеров сертификатов
	acf_add_local_field_group(
		array(
			'key'                   => 'group_gociss_service_certs',
			'title'                 => 'Услуга: Примеры сертификатов',
			'fields'                => array(
				array(
					'key'               => 'field_gociss_service_certs_title',
					'label'             => 'Заголовок',
					'name'              => 'gociss_service_certs_title',
					'type'              => 'text',
					'default_value'     => 'Примеры сертификатов',
				),
				array(
					'key'               => 'field_gociss_service_certs_subtitle',
					'label'             => 'Подзаголовок',
					'name'              => 'gociss_service_certs_subtitle',
					'type'              => 'textarea',
					'rows'              => 2,
					'default_value'     => 'Образцы сертификатов ISO 45001 различных типов',
				),
				// Карточка 1
				array(
					'key'        => 'field_gociss_service_cert_card_1',
					'label'      => 'Сертификат 1',
					'name'       => 'gociss_service_cert_card_1',
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'           => 'field_gociss_service_cert_card_1_image',
							'label'         => 'Изображение',
							'name'          => 'image',
							'type'          => 'image',
							'return_format' => 'array',
						),
						array(
							'key'          => 'field_gociss_service_cert_card_1_badge_text',
							'label'        => 'Текст бейджа',
							'name'         => 'badge_text',
							'type'         => 'text',
							'placeholder'  => 'Добровольная сертификация',
						),
						array(
							'key'          => 'field_gociss_service_cert_card_1_badge_color',
							'label'        => 'Цвет бейджа',
							'name'         => 'badge_color',
							'type'         => 'color_picker',
							'default_value' => '#0052CC',
						),
						array(
							'key'   => 'field_gociss_service_cert_card_1_title',
							'label' => 'Заголовок',
							'name'  => 'title',
							'type'  => 'text',
						),
						array(
							'key'  => 'field_gociss_service_cert_card_1_desc',
							'label' => 'Описание',
							'name'  => 'description',
							'type'  => 'textarea',
							'rows'  => 2,
						),
						array(
							'key'   => 'field_gociss_service_cert_card_1_price',
							'label' => 'Цена',
							'name'  => 'price',
							'type'  => 'text',
							'placeholder' => '15 000 ₽',
						),
					),
				),
				// Карточка 2
				array(
					'key'        => 'field_gociss_service_cert_card_2',
					'label'      => 'Сертификат 2',
					'name'       => 'gociss_service_cert_card_2',
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'           => 'field_gociss_service_cert_card_2_image',
							'label'         => 'Изображение',
							'name'          => 'image',
							'type'          => 'image',
							'return_format' => 'array',
						),
						array(
							'key'          => 'field_gociss_service_cert_card_2_badge_text',
							'label'        => 'Текст бейджа',
							'name'         => 'badge_text',
							'type'         => 'text',
							'placeholder'  => 'Аккредитация ФСА',
						),
						array(
							'key'          => 'field_gociss_service_cert_card_2_badge_color',
							'label'        => 'Цвет бейджа',
							'name'         => 'badge_color',
							'type'         => 'color_picker',
							'default_value' => '#7C3AED',
						),
						array(
							'key'   => 'field_gociss_service_cert_card_2_title',
							'label' => 'Заголовок',
							'name'  => 'title',
							'type'  => 'text',
						),
						array(
							'key'  => 'field_gociss_service_cert_card_2_desc',
							'label' => 'Описание',
							'name'  => 'description',
							'type'  => 'textarea',
							'rows'  => 2,
						),
						array(
							'key'   => 'field_gociss_service_cert_card_2_price',
							'label' => 'Цена',
							'name'  => 'price',
							'type'  => 'text',
							'placeholder' => 'от 40 000 ₽',
						),
					),
				),
				// Карточка 3
				array(
					'key'        => 'field_gociss_service_cert_card_3',
					'label'      => 'Сертификат 3',
					'name'       => 'gociss_service_cert_card_3',
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'           => 'field_gociss_service_cert_card_3_image',
							'label'         => 'Изображение',
							'name'          => 'image',
							'type'          => 'image',
							'return_format' => 'array',
						),
						array(
							'key'          => 'field_gociss_service_cert_card_3_badge_text',
							'label'        => 'Текст бейджа',
							'name'         => 'badge_text',
							'type'         => 'text',
							'placeholder'  => 'Аккредитация IAF',
						),
						array(
							'key'          => 'field_gociss_service_cert_card_3_badge_color',
							'label'        => 'Цвет бейджа',
							'name'         => 'badge_color',
							'type'         => 'color_picker',
							'default_value' => '#EA580C',
						),
						array(
							'key'   => 'field_gociss_service_cert_card_3_title',
							'label' => 'Заголовок',
							'name'  => 'title',
							'type'  => 'text',
						),
						array(
							'key'  => 'field_gociss_service_cert_card_3_desc',
							'label' => 'Описание',
							'name'  => 'description',
							'type'  => 'textarea',
							'rows'  => 2,
						),
						array(
							'key'   => 'field_gociss_service_cert_card_3_price',
							'label' => 'Цена',
							'name'  => 'price',
							'type'  => 'text',
							'placeholder' => 'от 60 000 ₽',
						),
					),
				),
				// Карточка 4
				array(
					'key'        => 'field_gociss_service_cert_card_4',
					'label'      => 'Сертификат 4',
					'name'       => 'gociss_service_cert_card_4',
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'           => 'field_gociss_service_cert_card_4_image',
							'label'         => 'Изображение',
							'name'          => 'image',
							'type'          => 'image',
							'return_format' => 'array',
						),
						array(
							'key'          => 'field_gociss_service_cert_card_4_badge_text',
							'label'        => 'Текст бейджа',
							'name'         => 'badge_text',
							'type'         => 'text',
						),
						array(
							'key'          => 'field_gociss_service_cert_card_4_badge_color',
							'label'        => 'Цвет бейджа',
							'name'         => 'badge_color',
							'type'         => 'color_picker',
							'default_value' => '#16A34A',
						),
						array(
							'key'   => 'field_gociss_service_cert_card_4_title',
							'label' => 'Заголовок',
							'name'  => 'title',
							'type'  => 'text',
						),
						array(
							'key'  => 'field_gociss_service_cert_card_4_desc',
							'label' => 'Описание',
							'name'  => 'description',
							'type'  => 'textarea',
							'rows'  => 2,
						),
						array(
							'key'   => 'field_gociss_service_cert_card_4_price',
							'label' => 'Цена',
							'name'  => 'price',
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
						'value'    => 'page-service.php',
					),
				),
			),
			'menu_order'            => 3,
		)
	);

	// Секция отзывов (до 6 отзывов через group поля)
	acf_add_local_field_group(
		array(
			'key'                   => 'group_gociss_service_reviews',
			'title'                 => 'Услуга: Отзывы клиентов',
			'fields'                => array(
				array(
					'key'               => 'field_gociss_service_reviews_title',
					'label'             => 'Заголовок',
					'name'              => 'gociss_service_reviews_title',
					'type'              => 'text',
					'default_value'     => 'Отзывы клиентов',
				),
				array(
					'key'               => 'field_gociss_service_reviews_subtitle',
					'label'             => 'Подзаголовок',
					'name'              => 'gociss_service_reviews_subtitle',
					'type'              => 'textarea',
					'rows'              => 2,
					'default_value'     => 'Что говорят наши клиенты о нашей работе',
				),
				// Отзыв 1
				array(
					'key'        => 'field_gociss_service_review_1',
					'label'      => 'Отзыв 1',
					'name'       => 'gociss_service_review_1',
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'   => 'field_gociss_service_review_1_company',
							'label' => 'Компания',
							'name'  => 'company',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_service_review_1_author',
							'label' => 'Имя автора',
							'name'  => 'author',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_service_review_1_position',
							'label' => 'Должность',
							'name'  => 'position',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_service_review_1_text',
							'label' => 'Текст отзыва',
							'name'  => 'text',
							'type'  => 'textarea',
							'rows'  => 4,
						),
						array(
							'key'           => 'field_gociss_service_review_1_rating',
							'label'         => 'Рейтинг (1-5)',
							'name'          => 'rating',
							'type'          => 'number',
							'min'           => 1,
							'max'           => 5,
							'default_value' => 5,
						),
						array(
							'key'           => 'field_gociss_service_review_1_image',
							'label'         => 'Фото автора',
							'name'          => 'image',
							'type'          => 'image',
							'return_format' => 'array',
						),
					),
				),
				// Отзыв 2
				array(
					'key'        => 'field_gociss_service_review_2',
					'label'      => 'Отзыв 2',
					'name'       => 'gociss_service_review_2',
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'   => 'field_gociss_service_review_2_company',
							'label' => 'Компания',
							'name'  => 'company',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_service_review_2_author',
							'label' => 'Имя автора',
							'name'  => 'author',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_service_review_2_position',
							'label' => 'Должность',
							'name'  => 'position',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_service_review_2_text',
							'label' => 'Текст отзыва',
							'name'  => 'text',
							'type'  => 'textarea',
							'rows'  => 4,
						),
						array(
							'key'           => 'field_gociss_service_review_2_rating',
							'label'         => 'Рейтинг (1-5)',
							'name'          => 'rating',
							'type'          => 'number',
							'min'           => 1,
							'max'           => 5,
							'default_value' => 5,
						),
						array(
							'key'           => 'field_gociss_service_review_2_image',
							'label'         => 'Фото автора',
							'name'          => 'image',
							'type'          => 'image',
							'return_format' => 'array',
						),
					),
				),
				// Отзыв 3
				array(
					'key'        => 'field_gociss_service_review_3',
					'label'      => 'Отзыв 3',
					'name'       => 'gociss_service_review_3',
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'   => 'field_gociss_service_review_3_company',
							'label' => 'Компания',
							'name'  => 'company',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_service_review_3_author',
							'label' => 'Имя автора',
							'name'  => 'author',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_service_review_3_position',
							'label' => 'Должность',
							'name'  => 'position',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_service_review_3_text',
							'label' => 'Текст отзыва',
							'name'  => 'text',
							'type'  => 'textarea',
							'rows'  => 4,
						),
						array(
							'key'           => 'field_gociss_service_review_3_rating',
							'label'         => 'Рейтинг (1-5)',
							'name'          => 'rating',
							'type'          => 'number',
							'min'           => 1,
							'max'           => 5,
							'default_value' => 5,
						),
						array(
							'key'           => 'field_gociss_service_review_3_image',
							'label'         => 'Фото автора',
							'name'          => 'image',
							'type'          => 'image',
							'return_format' => 'array',
						),
					),
				),
				// Отзыв 4
				array(
					'key'        => 'field_gociss_service_review_4',
					'label'      => 'Отзыв 4',
					'name'       => 'gociss_service_review_4',
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'   => 'field_gociss_service_review_4_company',
							'label' => 'Компания',
							'name'  => 'company',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_service_review_4_author',
							'label' => 'Имя автора',
							'name'  => 'author',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_service_review_4_position',
							'label' => 'Должность',
							'name'  => 'position',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_service_review_4_text',
							'label' => 'Текст отзыва',
							'name'  => 'text',
							'type'  => 'textarea',
							'rows'  => 4,
						),
						array(
							'key'           => 'field_gociss_service_review_4_rating',
							'label'         => 'Рейтинг (1-5)',
							'name'          => 'rating',
							'type'          => 'number',
							'min'           => 1,
							'max'           => 5,
							'default_value' => 5,
						),
						array(
							'key'           => 'field_gociss_service_review_4_image',
							'label'         => 'Фото автора',
							'name'          => 'image',
							'type'          => 'image',
							'return_format' => 'array',
						),
					),
				),
				// Отзыв 5
				array(
					'key'        => 'field_gociss_service_review_5',
					'label'      => 'Отзыв 5',
					'name'       => 'gociss_service_review_5',
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'   => 'field_gociss_service_review_5_company',
							'label' => 'Компания',
							'name'  => 'company',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_service_review_5_author',
							'label' => 'Имя автора',
							'name'  => 'author',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_service_review_5_position',
							'label' => 'Должность',
							'name'  => 'position',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_service_review_5_text',
							'label' => 'Текст отзыва',
							'name'  => 'text',
							'type'  => 'textarea',
							'rows'  => 4,
						),
						array(
							'key'           => 'field_gociss_service_review_5_rating',
							'label'         => 'Рейтинг (1-5)',
							'name'          => 'rating',
							'type'          => 'number',
							'min'           => 1,
							'max'           => 5,
							'default_value' => 5,
						),
						array(
							'key'           => 'field_gociss_service_review_5_image',
							'label'         => 'Фото автора',
							'name'          => 'image',
							'type'          => 'image',
							'return_format' => 'array',
						),
					),
				),
				// Отзыв 6
				array(
					'key'        => 'field_gociss_service_review_6',
					'label'      => 'Отзыв 6',
					'name'       => 'gociss_service_review_6',
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'   => 'field_gociss_service_review_6_company',
							'label' => 'Компания',
							'name'  => 'company',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_service_review_6_author',
							'label' => 'Имя автора',
							'name'  => 'author',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_service_review_6_position',
							'label' => 'Должность',
							'name'  => 'position',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_service_review_6_text',
							'label' => 'Текст отзыва',
							'name'  => 'text',
							'type'  => 'textarea',
							'rows'  => 4,
						),
						array(
							'key'           => 'field_gociss_service_review_6_rating',
							'label'         => 'Рейтинг (1-5)',
							'name'          => 'rating',
							'type'          => 'number',
							'min'           => 1,
							'max'           => 5,
							'default_value' => 5,
						),
						array(
							'key'           => 'field_gociss_service_review_6_image',
							'label'         => 'Фото автора',
							'name'          => 'image',
							'type'          => 'image',
							'return_format' => 'array',
						),
					),
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-service.php',
					),
				),
			),
			'menu_order'            => 4,
		)
	);

	// Секция CTA для страницы услуги (переиспользуем поля с главной)
	acf_add_local_field_group(
		array(
			'key'                   => 'group_gociss_service_cta',
			'title'                 => 'Услуга: CTA секция',
			'fields'                => array(
				array(
					'key'               => 'field_gociss_service_cta_label',
					'label'             => 'Метка',
					'name'              => 'gociss_cta_label',
					'type'              => 'text',
					'default_value'     => 'Начните прямо сейчас',
				),
				array(
					'key'               => 'field_gociss_service_cta_title',
					'label'             => 'Заголовок',
					'name'              => 'gociss_cta_title',
					'type'              => 'text',
					'default_value'     => 'Готовы начать сертификацию?',
				),
				array(
					'key'               => 'field_gociss_service_cta_description',
					'label'             => 'Описание',
					'name'              => 'gociss_cta_description',
					'type'              => 'textarea',
					'default_value'     => 'Получите бесплатную консультацию эксперта и узнайте точные сроки и стоимость сертификации для вашего продукта',
				),
				array(
					'key'               => 'field_gociss_service_cta_btn_primary',
					'label'             => 'Кнопка с рамкой',
					'name'              => 'gociss_cta_btn_primary',
					'type'              => 'group',
					'sub_fields'        => array(
						array(
							'key'   => 'field_gociss_service_cta_btn_primary_text',
							'label' => 'Текст',
							'name'  => 'text',
							'type'  => 'text',
							'default_value' => 'Получить консультацию',
						),
						array(
							'key'   => 'field_gociss_service_cta_btn_primary_url',
							'label' => 'Ссылка',
							'name'  => 'url',
							'type'  => 'url',
						),
					),
				),
				array(
					'key'               => 'field_gociss_service_cta_btn_secondary',
					'label'             => 'Кнопка залитая',
					'name'              => 'gociss_cta_btn_secondary',
					'type'              => 'group',
					'sub_fields'        => array(
						array(
							'key'   => 'field_gociss_service_cta_btn_secondary_text',
							'label' => 'Текст',
							'name'  => 'text',
							'type'  => 'text',
							'default_value' => 'Заказать обратный звонок',
						),
						array(
							'key'   => 'field_gociss_service_cta_btn_secondary_url',
							'label' => 'Ссылка',
							'name'  => 'url',
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
						'value'    => 'page-service.php',
					),
				),
			),
			'menu_order'            => 5,
		)
	);

	// FAQ для page-service.php теперь управляется через CPT gociss_faq

	// Секция формы для страницы услуги
	acf_add_local_field_group(
		array(
			'key'                   => 'group_gociss_service_form',
			'title'                 => 'Услуга: Форма обратной связи',
			'fields'                => array(
				array(
					'key'               => 'field_gociss_service_form_label',
					'label'             => 'Метка',
					'name'              => 'gociss_form_label',
					'type'              => 'text',
					'default_value'     => 'Связаться с нами',
				),
				array(
					'key'               => 'field_gociss_service_form_title',
					'label'             => 'Заголовок',
					'name'              => 'gociss_form_title',
					'type'              => 'text',
					'default_value'     => 'Оставить заявку',
				),
				array(
					'key'               => 'field_gociss_service_form_description',
					'label'             => 'Описание',
					'name'              => 'gociss_form_description',
					'type'              => 'textarea',
					'default_value'     => 'Заполните форму, и наш эксперт свяжется с вами в течение 30 минут',
				),
				array(
					'key'               => 'field_gociss_service_form_shortcode',
					'label'             => 'Шорткод Contact Form 7',
					'name'              => 'gociss_form_shortcode',
					'type'              => 'text',
					'instructions'      => 'Вставьте шорткод формы Contact Form 7',
					'default_value'     => '[contact-form-7 id="274d127" title="Контактная Форма Главная"]',
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-service.php',
					),
				),
			),
			'menu_order'            => 10,
		)
	);
}
add_action( 'acf/init', 'gociss_register_acf_fields' );

/**
 * Кастомная валидация для поля ссылки действий (принимает tel: и mailto:)
 */
function gociss_validate_action_url( $valid, $value, $field, $input ) {
	// Применяем только к полю действий (проверяем родительское поле)
	if ( strpos( $input, 'gociss_partners_actions' ) === false ) {
		return $valid;
	}

	// Пропускаем, если поле пустое (не required)
	if ( empty( $value ) ) {
		return $valid;
	}

	// Проверяем, что это валидный URL, mailto: или tel:
	if ( filter_var( $value, FILTER_VALIDATE_URL ) !== false ) {
		return $valid;
	}

	if ( preg_match( '/^mailto:/i', $value ) ) {
		$email = str_replace( 'mailto:', '', $value );
		if ( filter_var( $email, FILTER_VALIDATE_EMAIL ) !== false ) {
			return $valid;
		}
	}

	if ( preg_match( '/^tel:/i', $value ) ) {
		return $valid;
	}

	// Если это якорная ссылка
	if ( preg_match( '/^#/', $value ) ) {
		return $valid;
	}

	// Если дошли сюда и valid был true, возвращаем ошибку
	if ( $valid === true ) {
		return __( 'Значение должно быть допустимым URL, mailto: или tel:', 'gociss' );
	}

	return $valid;
}
add_filter( 'acf/validate_value/name=url', 'gociss_validate_action_url', 10, 4 );

/**
 * Регистрация ACF полей для типа записей "Услуги"
 */
function gociss_register_service_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	// Основные поля услуги
	acf_add_local_field_group(
		array(
			'key'                   => 'group_gociss_service_main',
			'title'                 => 'Данные услуги',
			'fields'                => array(
				array(
					'key'               => 'field_gociss_service_icon',
					'label'             => 'Иконка услуги',
					'name'              => 'gociss_service_icon',
					'type'              => 'image',
					'instructions'      => 'SVG или PNG иконка для отображения в архиве услуг. Рекомендуемый размер: 64x64px',
					'return_format'     => 'array',
					'preview_size'      => 'thumbnail',
					'library'           => 'all',
					'mime_types'        => 'svg,png',
				),
				array(
					'key'               => 'field_gociss_service_short_desc',
					'label'             => 'Краткое описание',
					'name'              => 'gociss_service_short_desc',
					'type'              => 'textarea',
					'instructions'      => 'Краткое описание для карточки услуги в архиве (2-3 предложения)',
					'rows'              => 3,
				),
				array(
					'key'               => 'field_gociss_service_hero_image',
					'label'             => 'Изображение для hero-секции',
					'name'              => 'gociss_service_hero_image',
					'type'              => 'image',
					'instructions'      => 'Изображение для отображения на странице услуги',
					'return_format'     => 'array',
					'preview_size'      => 'medium',
					'library'           => 'all',
				),
				array(
					'key'               => 'field_gociss_service_hero_subtitle',
					'label'             => 'Подзаголовок hero-секции',
					'name'              => 'gociss_service_hero_subtitle',
					'type'              => 'text',
					'instructions'      => 'Например: "Комплексная поддержка на всех этапах"',
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'gociss_service',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
		)
	);

	// Секция аккредитации для услуг
	acf_add_local_field_group(
		array(
			'key'                   => 'group_gociss_service_accreditation',
			'title'                 => 'Секция "Аккредитация"',
			'fields'                => array(
				array(
					'key'               => 'field_gociss_accreditation_show',
					'label'             => 'Показать секцию аккредитации',
					'name'              => 'gociss_accreditation_show',
					'type'              => 'true_false',
					'instructions'      => 'Включите, чтобы отобразить секцию аккредитации на странице услуги',
					'default_value'     => 0,
					'ui'                => 1,
				),
				array(
					'key'               => 'field_gociss_accreditation_title',
					'label'             => 'Заголовок секции',
					'name'              => 'gociss_accreditation_title',
					'type'              => 'text',
					'default_value'     => 'Аккредитация',
					'conditional_logic' => array(
						array(
							array(
								'field'    => 'field_gociss_accreditation_show',
								'operator' => '==',
								'value'    => '1',
							),
						),
					),
				),
				array(
					'key'               => 'field_gociss_accreditation_info_blocks',
					'label'             => 'Информационные блоки',
					'name'              => 'gociss_accreditation_info_blocks',
					'type'              => 'repeater',
					'instructions'      => '4 информационных блока с заголовком и описанием',
					'layout'            => 'block',
					'min'               => 0,
					'max'               => 4,
					'sub_fields'        => array(
						array(
							'key'   => 'field_gociss_accreditation_info_title',
							'label' => 'Заголовок блока',
							'name'  => 'title',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_accreditation_info_desc',
							'label' => 'Описание',
							'name'  => 'description',
							'type'  => 'textarea',
							'rows'  => 3,
						),
					),
					'conditional_logic' => array(
						array(
							array(
								'field'    => 'field_gociss_accreditation_show',
								'operator' => '==',
								'value'    => '1',
							),
						),
					),
				),
				array(
					'key'               => 'field_gociss_accreditation_cert_image',
					'label'             => 'Изображение сертификата',
					'name'              => 'gociss_accreditation_cert_image',
					'type'              => 'image',
					'instructions'      => 'Изображение аттестата аккредитации',
					'return_format'     => 'array',
					'preview_size'      => 'medium',
					'library'           => 'all',
					'conditional_logic' => array(
						array(
							array(
								'field'    => 'field_gociss_accreditation_show',
								'operator' => '==',
								'value'    => '1',
							),
						),
					),
				),
				array(
					'key'               => 'field_gociss_accreditation_text',
					'label'             => 'Текст описания аккредитации',
					'name'              => 'gociss_accreditation_text',
					'type'              => 'wysiwyg',
					'instructions'      => 'Текст с информацией об аккредитации (номер аттестата, дата и т.д.)',
					'toolbar'           => 'basic',
					'media_upload'      => 0,
					'conditional_logic' => array(
						array(
							array(
								'field'    => 'field_gociss_accreditation_show',
								'operator' => '==',
								'value'    => '1',
							),
						),
					),
				),
				array(
					'key'               => 'field_gociss_accreditation_button_text',
					'label'             => 'Текст кнопки',
					'name'              => 'gociss_accreditation_button_text',
					'type'              => 'text',
					'default_value'     => 'Заказать звонок',
					'conditional_logic' => array(
						array(
							array(
								'field'    => 'field_gociss_accreditation_show',
								'operator' => '==',
								'value'    => '1',
							),
						),
					),
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'gociss_service',
					),
				),
			),
			'menu_order'            => 1,
			'position'              => 'normal',
			'style'                 => 'default',
		)
	);

	// FAQ для страницы услуги (8 вопросов)
	$service_faq_fields = array();
	for ( $i = 1; $i <= 8; $i++ ) {
		$service_faq_fields[] = array(
			'key'          => 'field_gociss_sfaq_' . $i . '_question',
			'label'        => 'Вопрос ' . $i,
			'name'         => 'gociss_sfaq_' . $i . '_question',
			'type'         => 'text',
			'instructions' => 'Заполните вопрос, чтобы он отображался',
		);
		$service_faq_fields[] = array(
			'key'          => 'field_gociss_sfaq_' . $i . '_answer',
			'label'        => 'Ответ ' . $i,
			'name'         => 'gociss_sfaq_' . $i . '_answer',
			'type'         => 'textarea',
			'rows'         => 4,
		);
	}

	acf_add_local_field_group(
		array(
			'key'                   => 'group_gociss_service_faq_fixed',
			'title'                 => 'FAQ услуги',
			'fields'                => $service_faq_fields,
			'location'              => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'gociss_service',
					),
				),
			),
			'menu_order'            => 80,
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
		)
	);

	// Секция "Пример сертификата с расшифровкой" для услуги
	acf_add_local_field_group(
		array(
			'key'                   => 'group_gociss_service_cert_example',
			'title'                 => 'Секция "Пример сертификата"',
			'fields'                => array(
				array(
					'key'               => 'field_gociss_service_cert_title',
					'label'             => 'Заголовок секции',
					'name'              => 'gociss_service_cert_title',
					'type'              => 'text',
					'instructions'      => 'Например: "Сертификат ISO 45001". Если не заполнено, используется название услуги',
				),
				array(
					'key'               => 'field_gociss_service_cert_description',
					'label'             => 'Описание сертификата',
					'name'              => 'gociss_service_cert_description',
					'type'              => 'wysiwyg',
					'instructions'      => 'Текстовое описание сертификата (несколько абзацев)',
					'toolbar'           => 'basic',
					'media_upload'      => 0,
				),
				array(
					'key'               => 'field_gociss_service_cert_btn_text',
					'label'             => 'Текст кнопки',
					'name'              => 'gociss_service_cert_btn_text',
					'type'              => 'text',
					'default_value'     => 'Бесплатная консультация',
					'instructions'      => 'Кнопка ведёт на форму (#form)',
				),
				array(
					'key'               => 'field_gociss_service_cert_image',
					'label'             => 'Изображение сертификата с метками',
					'name'              => 'gociss_service_cert_image',
					'type'              => 'image',
					'instructions'      => 'Изображение сертификата с нумерованными метками (1, 2, 3, 4). Рекомендуемый размер: 400x550px',
					'return_format'     => 'array',
					'preview_size'      => 'medium',
				),
				// Пункт 1
				array(
					'key'          => 'field_gociss_service_cert_point_1',
					'label'        => 'Пункт 1',
					'name'         => 'gociss_service_cert_point_1',
					'type'         => 'group',
					'layout'       => 'block',
					'sub_fields'   => array(
						array(
							'key'   => 'field_gociss_service_cert_point_1_title',
							'label' => 'Заголовок',
							'name'  => 'title',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_service_cert_point_1_desc',
							'label' => 'Описание',
							'name'  => 'description',
							'type'  => 'textarea',
							'rows'  => 3,
						),
					),
				),
				// Пункт 2
				array(
					'key'          => 'field_gociss_service_cert_point_2',
					'label'        => 'Пункт 2',
					'name'         => 'gociss_service_cert_point_2',
					'type'         => 'group',
					'layout'       => 'block',
					'sub_fields'   => array(
						array(
							'key'   => 'field_gociss_service_cert_point_2_title',
							'label' => 'Заголовок',
							'name'  => 'title',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_service_cert_point_2_desc',
							'label' => 'Описание',
							'name'  => 'description',
							'type'  => 'textarea',
							'rows'  => 3,
						),
					),
				),
				// Пункт 3
				array(
					'key'          => 'field_gociss_service_cert_point_3',
					'label'        => 'Пункт 3',
					'name'         => 'gociss_service_cert_point_3',
					'type'         => 'group',
					'layout'       => 'block',
					'sub_fields'   => array(
						array(
							'key'   => 'field_gociss_service_cert_point_3_title',
							'label' => 'Заголовок',
							'name'  => 'title',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_service_cert_point_3_desc',
							'label' => 'Описание',
							'name'  => 'description',
							'type'  => 'textarea',
							'rows'  => 3,
						),
					),
				),
				// Пункт 4
				array(
					'key'          => 'field_gociss_service_cert_point_4',
					'label'        => 'Пункт 4',
					'name'         => 'gociss_service_cert_point_4',
					'type'         => 'group',
					'layout'       => 'block',
					'sub_fields'   => array(
						array(
							'key'   => 'field_gociss_service_cert_point_4_title',
							'label' => 'Заголовок',
							'name'  => 'title',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_service_cert_point_4_desc',
							'label' => 'Описание',
							'name'  => 'description',
							'type'  => 'textarea',
							'rows'  => 3,
						),
					),
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'gociss_service',
					),
				),
			),
			'menu_order'            => 2,
			'position'              => 'normal',
			'style'                 => 'default',
		)
	);

	// ACF поля для категорий услуг
	acf_add_local_field_group(
		array(
			'key'                   => 'group_gociss_service_cat',
			'title'                 => 'Настройки категории',
			'fields'                => array(
				array(
					'key'               => 'field_gociss_service_cat_icon',
					'label'             => 'Иконка категории',
					'name'              => 'gociss_service_cat_icon',
					'type'              => 'image',
					'instructions'      => 'SVG или PNG иконка для отображения в архиве. Рекомендуемый размер: 64x64px',
					'return_format'     => 'array',
					'preview_size'      => 'thumbnail',
					'library'           => 'all',
					'mime_types'        => 'svg,png',
				),
				array(
					'key'               => 'field_gociss_service_cat_desc',
					'label'             => 'Описание категории',
					'name'              => 'gociss_service_cat_desc',
					'type'              => 'textarea',
					'instructions'      => 'Краткое описание для карточки категории',
					'rows'              => 3,
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'taxonomy',
						'operator' => '==',
						'value'    => 'gociss_service_cat',
					),
				),
			),
		)
	);
}
add_action( 'acf/init', 'gociss_register_service_acf_fields' );

/**
 * Регистрация ACF полей для таксономии "Регионы" (мультирегиональность)
 * Эти поля позволяют переопределить контент секций для конкретного региона
 */
function gociss_register_region_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	// Региональные настройки контента
	acf_add_local_field_group(
		array(
			'key'                   => 'group_gociss_region_content',
			'title'                 => 'Региональные настройки контента',
			'fields'                => array(
				// ========== ОСНОВНЫЕ НАСТРОЙКИ ==========
				array(
					'key'          => 'field_gociss_region_general_tab',
					'label'        => 'Общие',
					'name'         => '',
					'type'         => 'tab',
					'placement'    => 'top',
				),
				array(
					'key'          => 'field_gociss_region_name_prepositional',
					'label'        => 'Название в предложном падеже',
					'name'         => 'gociss_region_name_prepositional',
					'type'         => 'text',
					'instructions' => 'Например: "Санкт-Петербурге", "Москве", "Новосибирске". Используется в заголовках вида "в [городе]"',
				),
				// ========== HERO СЕКЦИЯ ==========
				array(
					'key'          => 'field_gociss_region_hero_tab',
					'label'        => 'Hero секция',
					'name'         => '',
					'type'         => 'tab',
					'placement'    => 'top',
				),
				array(
					'key'          => 'field_gociss_region_hero_title',
					'label'        => 'Заголовок Hero',
					'name'         => 'gociss_region_hero_title',
					'type'         => 'text',
					'instructions' => 'Оставьте пустым, чтобы использовать заголовок из услуги',
				),
				array(
					'key'          => 'field_gociss_region_hero_subtitle',
					'label'        => 'Подзаголовок Hero',
					'name'         => 'gociss_region_hero_subtitle',
					'type'         => 'textarea',
					'rows'         => 2,
					'instructions' => 'Оставьте пустым, чтобы использовать подзаголовок из услуги',
				),

				// ========== PRICING СЕКЦИЯ ==========
				array(
					'key'          => 'field_gociss_region_pricing_tab',
					'label'        => 'Цены',
					'name'         => '',
					'type'         => 'tab',
					'placement'    => 'top',
				),
				array(
					'key'          => 'field_gociss_region_pricing_title',
					'label'        => 'Заголовок секции цен',
					'name'         => 'gociss_region_pricing_title',
					'type'         => 'text',
					'instructions' => 'Например: "Стоимость сертификации в Москве"',
				),
				array(
					'key'          => 'field_gociss_region_pricing_subtitle',
					'label'        => 'Подзаголовок секции цен',
					'name'         => 'gociss_region_pricing_subtitle',
					'type'         => 'textarea',
					'rows'         => 2,
				),
				// Цены - карточка 1
				array(
					'key'          => 'field_gociss_region_price_1',
					'label'        => 'Цена карточки 1',
					'name'         => 'gociss_region_price_1',
					'type'         => 'text',
					'instructions' => 'Например: "от 18 000 ₽". Оставьте пустым для общей цены',
				),
				// Цены - карточка 2
				array(
					'key'          => 'field_gociss_region_price_2',
					'label'        => 'Цена карточки 2',
					'name'         => 'gociss_region_price_2',
					'type'         => 'text',
				),
				// Цены - карточка 3
				array(
					'key'          => 'field_gociss_region_price_3',
					'label'        => 'Цена карточки 3',
					'name'         => 'gociss_region_price_3',
					'type'         => 'text',
				),
				// Цены - карточка 4
				array(
					'key'          => 'field_gociss_region_price_4',
					'label'        => 'Цена карточки 4',
					'name'         => 'gociss_region_price_4',
					'type'         => 'text',
				),

				// ========== PROCESS СЕКЦИЯ ==========
				array(
					'key'          => 'field_gociss_region_process_tab',
					'label'        => 'Процесс',
					'name'         => '',
					'type'         => 'tab',
					'placement'    => 'top',
				),
				array(
					'key'          => 'field_gociss_region_process_title',
					'label'        => 'Заголовок секции процесса',
					'name'         => 'gociss_region_process_title',
					'type'         => 'text',
				),
				array(
					'key'          => 'field_gociss_region_process_subtitle',
					'label'        => 'Подзаголовок секции процесса',
					'name'         => 'gociss_region_process_subtitle',
					'type'         => 'textarea',
					'rows'         => 2,
				),

				// ========== FAQ СЕКЦИЯ ==========
				array(
					'key'          => 'field_gociss_region_faq_tab',
					'label'        => 'FAQ',
					'name'         => '',
					'type'         => 'tab',
					'placement'    => 'top',
				),
				array(
					'key'          => 'field_gociss_region_faq_title',
					'label'        => 'Заголовок секции FAQ',
					'name'         => 'gociss_region_faq_title',
					'type'         => 'text',
				),
				array(
					'key'          => 'field_gociss_region_faq_subtitle',
					'label'        => 'Подзаголовок секции FAQ',
					'name'         => 'gociss_region_faq_subtitle',
					'type'         => 'textarea',
					'rows'         => 2,
				),
				// FAQ вопросы 1-8
				array(
					'key'          => 'field_gociss_region_faq_1_q',
					'label'        => 'Вопрос 1',
					'name'         => 'gociss_region_faq_1_question',
					'type'         => 'text',
					'instructions' => 'Региональный вопрос. Оставьте пустым для общего',
				),
				array(
					'key'          => 'field_gociss_region_faq_1_a',
					'label'        => 'Ответ 1',
					'name'         => 'gociss_region_faq_1_answer',
					'type'         => 'textarea',
					'rows'         => 3,
				),
				array(
					'key'          => 'field_gociss_region_faq_2_q',
					'label'        => 'Вопрос 2',
					'name'         => 'gociss_region_faq_2_question',
					'type'         => 'text',
				),
				array(
					'key'          => 'field_gociss_region_faq_2_a',
					'label'        => 'Ответ 2',
					'name'         => 'gociss_region_faq_2_answer',
					'type'         => 'textarea',
					'rows'         => 3,
				),
				array(
					'key'          => 'field_gociss_region_faq_3_q',
					'label'        => 'Вопрос 3',
					'name'         => 'gociss_region_faq_3_question',
					'type'         => 'text',
				),
				array(
					'key'          => 'field_gociss_region_faq_3_a',
					'label'        => 'Ответ 3',
					'name'         => 'gociss_region_faq_3_answer',
					'type'         => 'textarea',
					'rows'         => 3,
				),
				array(
					'key'          => 'field_gociss_region_faq_4_q',
					'label'        => 'Вопрос 4',
					'name'         => 'gociss_region_faq_4_question',
					'type'         => 'text',
				),
				array(
					'key'          => 'field_gociss_region_faq_4_a',
					'label'        => 'Ответ 4',
					'name'         => 'gociss_region_faq_4_answer',
					'type'         => 'textarea',
					'rows'         => 3,
				),
				array(
					'key'          => 'field_gociss_region_faq_5_q',
					'label'        => 'Вопрос 5',
					'name'         => 'gociss_region_faq_5_question',
					'type'         => 'text',
				),
				array(
					'key'          => 'field_gociss_region_faq_5_a',
					'label'        => 'Ответ 5',
					'name'         => 'gociss_region_faq_5_answer',
					'type'         => 'textarea',
					'rows'         => 3,
				),
				array(
					'key'          => 'field_gociss_region_faq_6_q',
					'label'        => 'Вопрос 6',
					'name'         => 'gociss_region_faq_6_question',
					'type'         => 'text',
				),
				array(
					'key'          => 'field_gociss_region_faq_6_a',
					'label'        => 'Ответ 6',
					'name'         => 'gociss_region_faq_6_answer',
					'type'         => 'textarea',
					'rows'         => 3,
				),
				array(
					'key'          => 'field_gociss_region_faq_7_q',
					'label'        => 'Вопрос 7',
					'name'         => 'gociss_region_faq_7_question',
					'type'         => 'text',
				),
				array(
					'key'          => 'field_gociss_region_faq_7_a',
					'label'        => 'Ответ 7',
					'name'         => 'gociss_region_faq_7_answer',
					'type'         => 'textarea',
					'rows'         => 3,
				),
				array(
					'key'          => 'field_gociss_region_faq_8_q',
					'label'        => 'Вопрос 8',
					'name'         => 'gociss_region_faq_8_question',
					'type'         => 'text',
				),
				array(
					'key'          => 'field_gociss_region_faq_8_a',
					'label'        => 'Ответ 8',
					'name'         => 'gociss_region_faq_8_answer',
					'type'         => 'textarea',
					'rows'         => 3,
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'taxonomy',
						'operator' => '==',
						'value'    => 'gociss_region',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
		)
	);
}
add_action( 'acf/init', 'gociss_register_region_acf_fields' );

/**
 * Регистрация ACF полей для реестра сертификатов
 */
function gociss_register_certificate_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group(
		array(
			'key'                   => 'group_gociss_certificate',
			'title'                 => 'Данные сертификата',
			'fields'                => array(
				array(
					'key'          => 'field_gociss_cert_inn',
					'label'        => 'ИНН организации',
					'name'         => 'gociss_cert_inn',
					'type'         => 'text',
					'instructions' => 'ИНН или ОГРНИП организации',
					'required'     => 1,
				),
				array(
					'key'          => 'field_gociss_cert_company',
					'label'        => 'Название компании',
					'name'         => 'gociss_cert_company',
					'type'         => 'text',
					'instructions' => 'Полное название организации',
					'required'     => 1,
				),
				array(
					'key'          => 'field_gociss_cert_number',
					'label'        => 'Номер сертификата',
					'name'         => 'gociss_cert_number',
					'type'         => 'text',
					'instructions' => 'Регистрационный номер сертификата/удостоверения',
					'required'     => 1,
				),
				array(
					'key'          => 'field_gociss_cert_type',
					'label'        => 'Вид сертификата',
					'name'         => 'gociss_cert_type',
					'type'         => 'text',
					'instructions' => 'Например: ISO 9001:2015, ISO 14001:2015',
					'required'     => 1,
				),
				array(
					'key'          => 'field_gociss_cert_date_start',
					'label'        => 'Дата регистрации',
					'name'         => 'gociss_cert_date_start',
					'type'         => 'date_picker',
					'instructions' => 'Дата выдачи сертификата',
					'required'     => 1,
					'display_format' => 'd.m.Y',
					'return_format'  => 'Y-m-d',
					'first_day'      => 1,
				),
				array(
					'key'          => 'field_gociss_cert_date_end',
					'label'        => 'Срок действия',
					'name'         => 'gociss_cert_date_end',
					'type'         => 'date_picker',
					'instructions' => 'Дата окончания действия сертификата',
					'required'     => 1,
					'display_format' => 'd.m.Y',
					'return_format'  => 'Y-m-d',
					'first_day'      => 1,
				),
				array(
					'key'           => 'field_gociss_cert_status',
					'label'         => 'Статус',
					'name'          => 'gociss_cert_status',
					'type'          => 'select',
					'instructions'  => 'Текущий статус сертификата. Если ручное управление выключено — статус обновляется автоматически.',
					'required'      => 1,
					'choices'       => array(
						'active'    => 'Действует',
						'expired'   => 'Не действует',
						'suspended' => 'Приостановлен',
						'renewed'   => 'Продлён',
					),
					'default_value' => 'active',
				),
				array(
					'key'          => 'field_gociss_cert_status_manual',
					'label'        => 'Ручное управление статусом',
					'name'         => 'gociss_cert_status_manual',
					'type'         => 'true_false',
					'instructions' => 'Включите, чтобы статус не менялся автоматически при истечении срока действия',
					'ui'           => 1,
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'gociss_certificate',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
		)
	);
}
add_action( 'acf/init', 'gociss_register_certificate_acf_fields' );

/**
 * Регистрация страницы настроек ACF
 */
function gociss_add_options_page() {
	if ( function_exists( 'acf_add_options_page' ) ) {
		acf_add_options_page(
			array(
				'page_title' => 'Настройки темы',
				'menu_title' => 'Настройки темы',
				'menu_slug'  => 'acf-options',
				'capability' => 'edit_posts',
			)
		);
	}
}
add_action( 'acf/init', 'gociss_add_options_page' );

/**
 * Регистрация ACF полей для типа записи "Курсы"
 */
function gociss_register_course_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group(
		array(
			'key'                   => 'group_gociss_course',
			'title'                 => 'Данные курса',
			'fields'                => array(
				array(
					'key'           => 'field_gociss_course_date_type',
					'label'         => 'Тип даты проведения',
					'name'          => 'gociss_course_date_type',
					'type'          => 'select',
					'instructions'  => 'Выберите, как указать дату проведения курса',
					'required'      => 1,
					'choices'       => array(
						'range'     => 'Диапазон дат',
						'on_demand' => 'По мере набора групп',
					),
					'default_value' => 'range',
				),
				array(
					'key'               => 'field_gociss_course_date_start',
					'label'             => 'Дата начала',
					'name'              => 'gociss_course_date_start',
					'type'              => 'date_picker',
					'instructions'      => 'Дата начала курса',
					'display_format'    => 'd.m.Y',
					'return_format'     => 'Y-m-d',
					'conditional_logic' => array(
						array(
							array(
								'field'    => 'field_gociss_course_date_type',
								'operator' => '==',
								'value'    => 'range',
							),
						),
					),
				),
				array(
					'key'               => 'field_gociss_course_date_end',
					'label'             => 'Дата окончания',
					'name'              => 'gociss_course_date_end',
					'type'              => 'date_picker',
					'instructions'      => 'Дата окончания курса',
					'display_format'    => 'd.m.Y',
					'return_format'     => 'Y-m-d',
					'conditional_logic' => array(
						array(
							array(
								'field'    => 'field_gociss_course_date_type',
								'operator' => '==',
								'value'    => 'range',
							),
						),
					),
				),
				array(
					'key'          => 'field_gociss_course_price',
					'label'        => 'Стоимость',
					'name'         => 'gociss_course_price',
					'type'         => 'number',
					'instructions' => 'Стоимость курса в рублях',
					'append'       => '₽',
				),
				array(
					'key'           => 'field_gociss_course_pdf',
					'label'         => 'PDF с подробной информацией',
					'name'          => 'gociss_course_pdf',
					'type'          => 'file',
					'instructions'  => 'Загрузите PDF-файл с программой курса. При клике на название курса откроется этот файл.',
					'return_format' => 'array',
					'library'       => 'all',
					'mime_types'    => 'pdf',
				),
				array(
					'key'           => 'field_gociss_course_status',
					'label'         => 'Статус курса',
					'name'          => 'gociss_course_status',
					'type'          => 'select',
					'instructions'  => 'Выберите статус курса',
					'choices'       => array(
						'active'   => 'Активный (можно записаться)',
						'finished' => 'Завершён',
					),
					'default_value' => 'active',
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'gociss_course',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
		)
	);
}
add_action( 'acf/init', 'gociss_register_course_acf_fields' );

/**
 * Регистрация ACF полей для страницы "Учебный центр"
 */
function gociss_register_edu_page_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group(
		array(
			'key'                   => 'group_gociss_edu_page',
			'title'                 => 'Настройки страницы Учебного центра',
			'fields'                => array(
				// === HERO СЕКЦИЯ ===
				array(
					'key'   => 'field_gociss_edu_hero_tab',
					'label' => 'Hero секция',
					'name'  => '',
					'type'  => 'tab',
				),
				array(
					'key'           => 'field_gociss_edu_hero_title',
					'label'         => 'Заголовок',
					'name'          => 'gociss_edu_hero_title',
					'type'          => 'text',
					'default_value' => 'Учебный центр',
				),
				array(
					'key'           => 'field_gociss_edu_hero_subtitle',
					'label'         => 'Подзаголовок',
					'name'          => 'gociss_edu_hero_subtitle',
					'type'          => 'textarea',
					'rows'          => 2,
					'default_value' => 'Дополнительное профессиональное образование в области управления качеством',
				),
				array(
					'key'           => 'field_gociss_edu_hero_bullet_1',
					'label'         => 'Пункт 1',
					'name'          => 'gociss_edu_hero_bullet_1',
					'type'          => 'text',
					'default_value' => 'Аккредитованные эксперты',
				),
				array(
					'key'           => 'field_gociss_edu_hero_bullet_2',
					'label'         => 'Пункт 2',
					'name'          => 'gociss_edu_hero_bullet_2',
					'type'          => 'text',
					'default_value' => 'Лицензированные программы',
				),
				array(
					'key'           => 'field_gociss_edu_hero_bullet_3',
					'label'         => 'Пункт 3',
					'name'          => 'gociss_edu_hero_bullet_3',
					'type'          => 'text',
					'default_value' => 'Лицензия Л035-01271-78/01059514',
				),
				array(
					'key'           => 'field_gociss_edu_hero_btn_text',
					'label'         => 'Текст кнопки',
					'name'          => 'gociss_edu_hero_btn_text',
					'type'          => 'text',
					'default_value' => 'Выбрать курс',
				),
				array(
					'key'           => 'field_gociss_edu_hero_image',
					'label'         => 'Фоновое изображение',
					'name'          => 'gociss_edu_hero_image',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'medium',
					'instructions'  => 'Рекомендуемый размер: 1200x400px',
				),

				// === ДОКУМЕНТЫ ===
				array(
					'key'   => 'field_gociss_edu_docs_tab',
					'label' => 'Документы обучения',
					'name'  => '',
					'type'  => 'tab',
				),
				array(
					'key'           => 'field_gociss_edu_doc1_title',
					'label'         => 'Документ 1: Заголовок',
					'name'          => 'gociss_edu_doc1_title',
					'type'          => 'text',
					'default_value' => 'Удостоверение о повышении квалификации',
				),
				array(
					'key'           => 'field_gociss_edu_doc1_text',
					'label'         => 'Документ 1: Описание',
					'name'          => 'gociss_edu_doc1_text',
					'type'          => 'textarea',
					'rows'          => 4,
				),
				array(
					'key'           => 'field_gociss_edu_doc1_image',
					'label'         => 'Документ 1: Изображение',
					'name'          => 'gociss_edu_doc1_image',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'medium',
				),
				array(
					'key'           => 'field_gociss_edu_doc2_title',
					'label'         => 'Документ 2: Заголовок',
					'name'          => 'gociss_edu_doc2_title',
					'type'          => 'text',
					'default_value' => 'Персональный сертификат соответствия',
				),
				array(
					'key'           => 'field_gociss_edu_doc2_text',
					'label'         => 'Документ 2: Описание',
					'name'          => 'gociss_edu_doc2_text',
					'type'          => 'textarea',
					'rows'          => 4,
				),
				array(
					'key'           => 'field_gociss_edu_doc2_image',
					'label'         => 'Документ 2: Изображение',
					'name'          => 'gociss_edu_doc2_image',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'medium',
				),

				// === ЛИЦЕНЗИИ ===
				array(
					'key'   => 'field_gociss_edu_licenses_tab',
					'label' => 'Лицензии',
					'name'  => '',
					'type'  => 'tab',
				),
				array(
					'key'           => 'field_gociss_edu_fis_title',
					'label'         => 'ФИС ФРДО: Заголовок',
					'name'          => 'gociss_edu_fis_title',
					'type'          => 'text',
					'default_value' => 'Документы об образовании вносятся в ФИС ФРДО',
				),
				array(
					'key'  => 'field_gociss_edu_fis_text',
					'label' => 'ФИС ФРДО: Описание',
					'name'  => 'gociss_edu_fis_text',
					'type'  => 'textarea',
					'rows'  => 3,
				),
				array(
					'key'           => 'field_gociss_edu_fis_link',
					'label'         => 'ФИС ФРДО: Ссылка на реестр',
					'name'          => 'gociss_edu_fis_link',
					'type'          => 'url',
				),
				array(
					'key'           => 'field_gociss_edu_lic1_title',
					'label'         => 'Лицензия 1: Заголовок',
					'name'          => 'gociss_edu_lic1_title',
					'type'          => 'text',
					'default_value' => 'Государственная лицензия на ДПО',
				),
				array(
					'key'  => 'field_gociss_edu_lic1_text',
					'label' => 'Лицензия 1: Описание',
					'name'  => 'gociss_edu_lic1_text',
					'type'  => 'textarea',
					'rows'  => 3,
				),
				array(
					'key'   => 'field_gociss_edu_lic1_number',
					'label' => 'Лицензия 1: Номер',
					'name'  => 'gociss_edu_lic1_number',
					'type'  => 'text',
				),
				array(
					'key'           => 'field_gociss_edu_lic1_file',
					'label'         => 'Лицензия 1: PDF файл',
					'name'          => 'gociss_edu_lic1_file',
					'type'          => 'file',
					'return_format' => 'array',
					'mime_types'    => 'pdf',
				),
				array(
					'key'           => 'field_gociss_edu_lic1_image',
					'label'         => 'Лицензия 1: Изображение',
					'name'          => 'gociss_edu_lic1_image',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'medium',
				),
				array(
					'key'           => 'field_gociss_edu_lic2_title',
					'label'         => 'Лицензия 2: Заголовок',
					'name'          => 'gociss_edu_lic2_title',
					'type'          => 'text',
					'default_value' => 'Государственная лицензия Федеральной службы по аккредитации',
				),
				array(
					'key'  => 'field_gociss_edu_lic2_text',
					'label' => 'Лицензия 2: Описание',
					'name'  => 'gociss_edu_lic2_text',
					'type'  => 'textarea',
					'rows'  => 3,
				),
				array(
					'key'   => 'field_gociss_edu_lic2_number',
					'label' => 'Лицензия 2: Номер',
					'name'  => 'gociss_edu_lic2_number',
					'type'  => 'text',
				),
				array(
					'key'           => 'field_gociss_edu_lic2_file',
					'label'         => 'Лицензия 2: PDF файл',
					'name'          => 'gociss_edu_lic2_file',
					'type'          => 'file',
					'return_format' => 'array',
					'mime_types'    => 'pdf',
				),
				array(
					'key'           => 'field_gociss_edu_lic2_image',
					'label'         => 'Лицензия 2: Изображение',
					'name'          => 'gociss_edu_lic2_image',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'medium',
				),

				// === ПРЕИМУЩЕСТВА ===
				array(
					'key'   => 'field_gociss_edu_adv_tab',
					'label' => 'Преимущества',
					'name'  => '',
					'type'  => 'tab',
				),
				array(
					'key'           => 'field_gociss_edu_adv_title',
					'label'         => 'Заголовок секции',
					'name'          => 'gociss_edu_adv_title',
					'type'          => 'text',
					'default_value' => 'Наши конкурентные преимущества',
				),
				array(
					'key'           => 'field_gociss_edu_adv_subtitle',
					'label'         => 'Подзаголовок секции',
					'name'          => 'gociss_edu_adv_subtitle',
					'type'          => 'text',
					'default_value' => 'Почему клиенты выбирают именно нас для решения задач сертификации',
				),
				array(
					'key'           => 'field_gociss_edu_adv1_icon',
					'label'         => 'Преимущество 1: Иконка',
					'name'          => 'gociss_edu_adv1_icon',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'thumbnail',
				),
				array(
					'key'           => 'field_gociss_edu_adv1_text',
					'label'         => 'Преимущество 1: Текст',
					'name'          => 'gociss_edu_adv1_text',
					'type'          => 'text',
					'default_value' => 'Наличие государственной аккредитации (Росаккредитация)',
				),
				array(
					'key'           => 'field_gociss_edu_adv2_icon',
					'label'         => 'Преимущество 2: Иконка',
					'name'          => 'gociss_edu_adv2_icon',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'thumbnail',
				),
				array(
					'key'           => 'field_gociss_edu_adv2_text',
					'label'         => 'Преимущество 2: Текст',
					'name'          => 'gociss_edu_adv2_text',
					'type'          => 'text',
					'default_value' => 'Законность оформленных заключений и сертификатов СМК',
				),
				array(
					'key'           => 'field_gociss_edu_adv3_icon',
					'label'         => 'Преимущество 3: Иконка',
					'name'          => 'gociss_edu_adv3_icon',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'thumbnail',
				),
				array(
					'key'           => 'field_gociss_edu_adv3_text',
					'label'         => 'Преимущество 3: Текст',
					'name'          => 'gociss_edu_adv3_text',
					'type'          => 'text',
					'default_value' => 'Стабильно высокое качество работ по подтверждению ИСО',
				),
				array(
					'key'           => 'field_gociss_edu_adv4_icon',
					'label'         => 'Преимущество 4: Иконка',
					'name'          => 'gociss_edu_adv4_icon',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'thumbnail',
				),
				array(
					'key'           => 'field_gociss_edu_adv4_text',
					'label'         => 'Преимущество 4: Текст',
					'name'          => 'gociss_edu_adv4_text',
					'type'          => 'text',
					'default_value' => 'Объективность и достоверность предоставленных сведений',
				),
				array(
					'key'           => 'field_gociss_edu_adv5_icon',
					'label'         => 'Преимущество 5: Иконка',
					'name'          => 'gociss_edu_adv5_icon',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'thumbnail',
				),
				array(
					'key'           => 'field_gociss_edu_adv5_text',
					'label'         => 'Преимущество 5: Текст',
					'name'          => 'gociss_edu_adv5_text',
					'type'          => 'text',
					'default_value' => 'Отсутствие государственных пошлин за оказываемые услуги',
				),
				array(
					'key'           => 'field_gociss_edu_adv6_icon',
					'label'         => 'Преимущество 6: Иконка',
					'name'          => 'gociss_edu_adv6_icon',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'thumbnail',
				),
				array(
					'key'           => 'field_gociss_edu_adv6_text',
					'label'         => 'Преимущество 6: Текст',
					'name'          => 'gociss_edu_adv6_text',
					'type'          => 'text',
					'default_value' => 'Оперативная доставка документов по всем субъектам РФ',
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-edu.php',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
		)
	);
}
add_action( 'acf/init', 'gociss_register_edu_page_acf_fields' );

/**
 * Регистрация ACF полей для страницы Контакты
 */
function gociss_register_contacts_page_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group(
		array(
			'key'                   => 'group_gociss_contacts_page',
			'title'                 => 'Настройки страницы Контакты',
			'fields'                => array(
				// Заголовок секции
				array(
					'key'           => 'field_gociss_contacts_title',
					'label'         => 'Заголовок',
					'name'          => 'gociss_contacts_title',
					'type'          => 'text',
					'default_value' => 'Контакты',
				),
				// Название организации
				array(
					'key'           => 'field_gociss_contacts_org_name',
					'label'         => 'Название организации',
					'name'          => 'gociss_contacts_org_name',
					'type'          => 'textarea',
					'rows'          => 2,
					'default_value' => 'Автономная некоммерческая организация "Головной центр испытаний, сертификации и стандартизации"',
				),
				// PDF реквизитов
				array(
					'key'           => 'field_gociss_contacts_requisites_pdf',
					'label'         => 'PDF реквизитов',
					'name'          => 'gociss_contacts_requisites_pdf',
					'type'          => 'file',
					'instructions'  => 'Загрузите PDF файл с реквизитами организации',
					'return_format' => 'array',
					'library'       => 'all',
					'mime_types'    => 'pdf',
				),
				// Адрес офиса
				array(
					'key'           => 'field_gociss_contacts_address_label',
					'label'         => 'Метка адреса',
					'name'          => 'gociss_contacts_address_label',
					'type'          => 'text',
					'default_value' => 'Адрес офиса:',
				),
				array(
					'key'           => 'field_gociss_contacts_address',
					'label'         => 'Адрес офиса',
					'name'          => 'gociss_contacts_address',
					'type'          => 'textarea',
					'rows'          => 2,
					'default_value' => 'г. Санкт-Петербург, ул. Парковая, дом 4, литера Д, офис 255',
				),
				// Контактные данные
				array(
					'key'           => 'field_gociss_contacts_data_label',
					'label'         => 'Метка контактных данных',
					'name'          => 'gociss_contacts_data_label',
					'type'          => 'text',
					'default_value' => 'Контактные данные:',
				),
				array(
					'key'           => 'field_gociss_contacts_email',
					'label'         => 'Email',
					'name'          => 'gociss_contacts_email',
					'type'          => 'email',
					'default_value' => 'info@gociss.ru',
				),
				array(
					'key'           => 'field_gociss_contacts_phone',
					'label'         => 'Телефон',
					'name'          => 'gociss_contacts_phone',
					'type'          => 'text',
					'default_value' => '+7 (800) 551-02-36',
				),
				// Яндекс Карта
				array(
					'key'          => 'field_gociss_contacts_map_embed',
					'label'        => 'Код Яндекс Карты',
					'name'         => 'gociss_contacts_map_embed',
					'type'         => 'textarea',
					'instructions' => 'Вставьте код карты из конструктора Яндекс Карт (constructor.yandex.ru). Можно использовать iframe или script.',
					'rows'         => 6,
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-contacts.php',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
		)
	);
}
add_action( 'acf/init', 'gociss_register_contacts_page_acf_fields' );

/**
 * Регистрация ACF полей для страницы ГОСТов
 */
function gociss_register_gost_page_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	// Поля для групп стандартов
	$group_fields = array(
		// Hero секция
		array(
			'key'   => 'field_gociss_gost_hero_tab',
			'label' => 'Hero секция',
			'name'  => '',
			'type'  => 'tab',
		),
		array(
			'key'           => 'field_gociss_gost_hero_title',
			'label'         => 'Заголовок',
			'name'          => 'gociss_gost_hero_title',
			'type'          => 'text',
			'default_value' => 'Нормативная база ГОСТов',
		),
		array(
			'key'           => 'field_gociss_gost_hero_subtitle',
			'label'         => 'Подзаголовок',
			'name'          => 'gociss_gost_hero_subtitle',
			'type'          => 'textarea',
			'rows'          => 2,
			'default_value' => 'Полная база государственных стандартов качества для обеспечения соответствия продукции и услуг требованиям безопасности и качества',
		),
		array(
			'key'           => 'field_gociss_gost_hero_image',
			'label'         => 'Фоновое изображение',
			'name'          => 'gociss_gost_hero_image',
			'type'          => 'image',
			'instructions'  => 'Рекомендуемый размер: 1920x400px',
			'return_format' => 'array',
			'preview_size'  => 'medium',
			'library'       => 'all',
		),
		// Секция стандартов
		array(
			'key'   => 'field_gociss_gost_section_tab',
			'label' => 'Секция стандартов',
			'name'  => '',
			'type'  => 'tab',
		),
		array(
			'key'           => 'field_gociss_gost_section_title',
			'label'         => 'Заголовок секции',
			'name'          => 'gociss_gost_section_title',
			'type'          => 'text',
			'default_value' => 'Основные стандарты ИСО',
		),
	);

	// Генерируем поля для 6 групп стандартов
	for ( $g = 1; $g <= 6; $g++ ) {
		$group_fields[] = array(
			'key'   => 'field_gociss_gost_group_' . $g . '_tab',
			'label' => 'Группа ' . $g,
			'name'  => '',
			'type'  => 'tab',
		);
		$group_fields[] = array(
			'key'          => 'field_gociss_gost_group_' . $g . '_icon',
			'label'        => 'Иконка группы',
			'name'         => 'gociss_gost_group_' . $g . '_icon',
			'type'         => 'image',
			'instructions' => 'SVG или PNG, рекомендуемый размер: 48x48px',
			'return_format' => 'array',
			'preview_size' => 'thumbnail',
			'library'      => 'all',
		);
		$group_fields[] = array(
			'key'   => 'field_gociss_gost_group_' . $g . '_name',
			'label' => 'Название группы',
			'name'  => 'gociss_gost_group_' . $g . '_name',
			'type'  => 'text',
		);
		$group_fields[] = array(
			'key'   => 'field_gociss_gost_group_' . $g . '_description',
			'label' => 'Описание группы',
			'name'  => 'gociss_gost_group_' . $g . '_description',
			'type'  => 'textarea',
			'rows'  => 2,
		);

		// 10 стандартов в каждой группе
		for ( $s = 1; $s <= 10; $s++ ) {
			$group_fields[] = array(
				'key'   => 'field_gociss_gost_group_' . $g . '_std_' . $s . '_name',
				'label' => 'Стандарт ' . $s . ' - Название',
				'name'  => 'gociss_gost_group_' . $g . '_std_' . $s . '_name',
				'type'  => 'text',
				'wrapper' => array(
					'width' => '40',
				),
			);
			$group_fields[] = array(
				'key'   => 'field_gociss_gost_group_' . $g . '_std_' . $s . '_description',
				'label' => 'Стандарт ' . $s . ' - Описание',
				'name'  => 'gociss_gost_group_' . $g . '_std_' . $s . '_description',
				'type'  => 'text',
				'wrapper' => array(
					'width' => '40',
				),
			);
			$group_fields[] = array(
				'key'           => 'field_gociss_gost_group_' . $g . '_std_' . $s . '_file',
				'label'         => 'Стандарт ' . $s . ' - Файл',
				'name'          => 'gociss_gost_group_' . $g . '_std_' . $s . '_file',
				'type'          => 'file',
				'return_format' => 'array',
				'library'       => 'all',
				'mime_types'    => 'pdf,doc,docx',
				'wrapper'       => array(
					'width' => '20',
				),
			);
		}
	}

	acf_add_local_field_group(
		array(
			'key'                   => 'group_gociss_gost_page',
			'title'                 => 'Страница ГОСТов',
			'fields'                => $group_fields,
			'location'              => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-gost.php',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
		)
	);
}
add_action( 'acf/init', 'gociss_register_gost_page_acf_fields' );

/**
 * Регистрация ACF полей для страницы "Вакансии"
 */
function gociss_register_vacancies_page_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	$vacancies_fields = array();

	// === HERO СЕКЦИЯ ===
	$vacancies_fields[] = array(
		'key'   => 'field_gociss_vacancies_hero_tab',
		'label' => 'Hero секция',
		'name'  => '',
		'type'  => 'tab',
	);
	$vacancies_fields[] = array(
		'key'           => 'field_gociss_vacancies_hero_title',
		'label'         => 'Заголовок',
		'name'          => 'gociss_vacancies_hero_title',
		'type'          => 'text',
		'default_value' => 'Вакансии',
	);
	$vacancies_fields[] = array(
		'key'           => 'field_gociss_vacancies_hero_description',
		'label'         => 'Описание',
		'name'          => 'gociss_vacancies_hero_description',
		'type'          => 'text',
		'default_value' => 'По вопросам трудоустройства обращаться:',
	);
	$vacancies_fields[] = array(
		'key'           => 'field_gociss_vacancies_hero_phone',
		'label'         => 'Телефон отдела кадров',
		'name'          => 'gociss_vacancies_hero_phone',
		'type'          => 'text',
		'default_value' => 'Отдел кадров 388-69-03',
	);
	$vacancies_fields[] = array(
		'key'           => 'field_gociss_vacancies_hero_image',
		'label'         => 'Фоновое изображение',
		'name'          => 'gociss_vacancies_hero_image',
		'type'          => 'image',
		'return_format' => 'array',
		'preview_size'  => 'medium',
		'instructions'  => 'Рекомендуемый размер: 1440x300px',
	);

	// === ВАКАНСИИ (5 штук) ===
	for ( $i = 1; $i <= 5; $i++ ) {
		$vacancies_fields[] = array(
			'key'   => 'field_gociss_vacancy_' . $i . '_tab',
			'label' => 'Вакансия ' . $i,
			'name'  => '',
			'type'  => 'tab',
		);
		$vacancies_fields[] = array(
			'key'          => 'field_gociss_vacancy_' . $i . '_title',
			'label'        => 'Название вакансии',
			'name'         => 'gociss_vacancy_' . $i . '_title',
			'type'         => 'text',
			'instructions' => 'Оставьте пустым, чтобы скрыть эту вакансию',
		);
		$vacancies_fields[] = array(
			'key'          => 'field_gociss_vacancy_' . $i . '_requirements',
			'label'        => 'Требования к кандидату',
			'name'         => 'gociss_vacancy_' . $i . '_requirements',
			'type'         => 'textarea',
			'rows'         => 8,
			'instructions' => 'Каждое требование с новой строки, начинайте с • или -',
		);
		$vacancies_fields[] = array(
			'key'          => 'field_gociss_vacancy_' . $i . '_qualities',
			'label'        => 'Личностные качества',
			'name'         => 'gociss_vacancy_' . $i . '_qualities',
			'type'         => 'textarea',
			'rows'         => 4,
			'instructions' => 'Каждое качество с новой строки',
		);
		$vacancies_fields[] = array(
			'key'          => 'field_gociss_vacancy_' . $i . '_conditions',
			'label'        => 'Условия',
			'name'         => 'gociss_vacancy_' . $i . '_conditions',
			'type'         => 'textarea',
			'rows'         => 4,
			'instructions' => 'Каждое условие с новой строки',
		);
		$vacancies_fields[] = array(
			'key'   => 'field_gociss_vacancy_' . $i . '_salary',
			'label' => 'Заработная плата',
			'name'  => 'gociss_vacancy_' . $i . '_salary',
			'type'  => 'text',
		);
	}

	// === CTA КНОПКА ===
	$vacancies_fields[] = array(
		'key'   => 'field_gociss_vacancies_cta_tab',
		'label' => 'Кнопка CTA',
		'name'  => '',
		'type'  => 'tab',
	);
	$vacancies_fields[] = array(
		'key'           => 'field_gociss_vacancies_cta_text',
		'label'         => 'Текст кнопки',
		'name'          => 'gociss_vacancies_cta_text',
		'type'          => 'text',
		'default_value' => 'Оставить заявку',
	);
	$vacancies_fields[] = array(
		'key'           => 'field_gociss_vacancies_cta_url',
		'label'         => 'Ссылка кнопки',
		'name'          => 'gociss_vacancies_cta_url',
		'type'          => 'url',
		'instructions'  => 'Например: #contact-form или ссылка на форму',
	);

	acf_add_local_field_group(
		array(
			'key'                   => 'group_gociss_vacancies_page',
			'title'                 => 'Страница Вакансий',
			'fields'                => $vacancies_fields,
			'location'              => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-vacancies.php',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
		)
	);
}
add_action( 'acf/init', 'gociss_register_vacancies_page_acf_fields' );

/**
 * ACF поля для страницы "О компании"
 */
function gociss_register_about_page_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	$about_fields = array();

	// === HERO СЕКЦИЯ ===
	$about_fields[] = array(
		'key'   => 'field_gociss_about_hero_tab',
		'label' => 'Hero секция',
		'name'  => '',
		'type'  => 'tab',
	);
	$about_fields[] = array(
		'key'           => 'field_gociss_about_hero_image',
		'label'         => 'Фоновое изображение',
		'name'          => 'gociss_about_hero_image',
		'type'          => 'image',
		'instructions'  => 'Рекомендуемый размер: 1920x400px. Фото здания или офиса.',
		'return_format' => 'array',
		'preview_size'  => 'medium',
	);
	$about_fields[] = array(
		'key'           => 'field_gociss_about_hero_title',
		'label'         => 'Заголовок',
		'name'          => 'gociss_about_hero_title',
		'type'          => 'text',
		'default_value' => 'О компании',
	);
	$about_fields[] = array(
		'key'           => 'field_gociss_about_hero_description',
		'label'         => 'Описание',
		'name'          => 'gociss_about_hero_description',
		'type'          => 'textarea',
		'rows'          => 3,
		'default_value' => 'Ведущая сертификационная компания с многолетним опытом работы в области подтверждения соответствия и качества продукции',
	);

	// === ОБ ОРГАНИЗАЦИИ ===
	$about_fields[] = array(
		'key'   => 'field_gociss_about_org_tab',
		'label' => 'Об организации',
		'name'  => '',
		'type'  => 'tab',
	);
	$about_fields[] = array(
		'key'           => 'field_gociss_about_org_title',
		'label'         => 'Заголовок секции',
		'name'          => 'gociss_about_org_title',
		'type'          => 'text',
		'default_value' => 'Об организации',
	);
	$about_fields[] = array(
		'key'          => 'field_gociss_about_org_content',
		'label'        => 'Текст об организации',
		'name'         => 'gociss_about_org_content',
		'type'         => 'wysiwyg',
		'tabs'         => 'all',
		'toolbar'      => 'full',
		'media_upload' => 0,
	);
	$about_fields[] = array(
		'key'           => 'field_gociss_about_org_image',
		'label'         => 'Фото организации',
		'name'          => 'gociss_about_org_image',
		'type'          => 'image',
		'instructions'  => 'Рекомендуемый размер: 600x400px',
		'return_format' => 'array',
		'preview_size'  => 'medium',
	);

	// === ПРИЗНАНИЕ И ЛЕГИТИМНОСТЬ ===
	$about_fields[] = array(
		'key'   => 'field_gociss_about_accred_tab',
		'label' => 'Признание и легитимность',
		'name'  => '',
		'type'  => 'tab',
	);
	$about_fields[] = array(
		'key'           => 'field_gociss_about_accred_title',
		'label'         => 'Заголовок секции',
		'name'          => 'gociss_about_accred_title',
		'type'          => 'text',
		'default_value' => 'Признание и легитимность',
	);
	$about_fields[] = array(
		'key'           => 'field_gociss_about_accred_subtitle',
		'label'         => 'Подзаголовок',
		'name'          => 'gociss_about_accred_subtitle',
		'type'          => 'textarea',
		'rows'          => 2,
		'default_value' => 'Наша компания аккредитована ведущими международными организациями',
	);

	// Карточки аккредитации (3 штуки)
	for ( $i = 1; $i <= 3; $i++ ) {
		$about_fields[] = array(
			'key'   => 'field_gociss_about_accred_card_' . $i,
			'label' => 'Карточка ' . $i,
			'name'  => 'gociss_about_accred_card_' . $i,
			'type'  => 'group',
			'layout' => 'block',
			'sub_fields' => array(
				array(
					'key'   => 'field_gociss_about_accred_card_' . $i . '_title',
					'label' => 'Заголовок',
					'name'  => 'title',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_gociss_about_accred_card_' . $i . '_description',
					'label' => 'Описание',
					'name'  => 'description',
					'type'  => 'textarea',
					'rows'  => 3,
				),
				array(
					'key'   => 'field_gociss_about_accred_card_' . $i . '_link_text',
					'label' => 'Текст ссылки',
					'name'  => 'link_text',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_gociss_about_accred_card_' . $i . '_link_url',
					'label' => 'URL ссылки',
					'name'  => 'link_url',
					'type'  => 'url',
				),
			),
		);
	}

	// === ОСНОВНЫЕ ЦЕЛИ ===
	$about_fields[] = array(
		'key'   => 'field_gociss_about_goals_tab',
		'label' => 'Основные цели',
		'name'  => '',
		'type'  => 'tab',
	);
	$about_fields[] = array(
		'key'           => 'field_gociss_about_goals_title',
		'label'         => 'Заголовок секции',
		'name'          => 'gociss_about_goals_title',
		'type'          => 'text',
		'default_value' => 'Основные цели компании',
	);
	$about_fields[] = array(
		'key'           => 'field_gociss_about_goals_subtitle',
		'label'         => 'Подзаголовок',
		'name'          => 'gociss_about_goals_subtitle',
		'type'          => 'textarea',
		'rows'          => 2,
	);

	// Цели (3 штуки)
	for ( $i = 1; $i <= 3; $i++ ) {
		$about_fields[] = array(
			'key'   => 'field_gociss_about_goal_' . $i,
			'label' => 'Цель ' . $i,
			'name'  => 'gociss_about_goal_' . $i,
			'type'  => 'group',
			'layout' => 'block',
			'sub_fields' => array(
				array(
					'key'   => 'field_gociss_about_goal_' . $i . '_title',
					'label' => 'Текст цели',
					'name'  => 'title',
					'type'  => 'textarea',
					'rows'  => 3,
				),
			),
		);
	}

	// === ПАРТНЁРЫ ===
	$about_fields[] = array(
		'key'   => 'field_gociss_about_partners_tab',
		'label' => 'Партнёры',
		'name'  => '',
		'type'  => 'tab',
	);
	$about_fields[] = array(
		'key'           => 'field_gociss_about_partners_title',
		'label'         => 'Заголовок секции',
		'name'          => 'gociss_about_partners_title',
		'type'          => 'text',
		'default_value' => 'Наши партнёры',
	);
	$about_fields[] = array(
		'key'           => 'field_gociss_about_partners_subtitle',
		'label'         => 'Подзаголовок',
		'name'          => 'gociss_about_partners_subtitle',
		'type'          => 'textarea',
		'rows'          => 2,
	);

	// Названия партнёров (до 8)
	for ( $i = 1; $i <= 8; $i++ ) {
		$about_fields[] = array(
			'key'          => 'field_gociss_about_partner_' . $i,
			'label'        => 'Партнёр ' . $i,
			'name'         => 'gociss_about_partner_' . $i,
			'type'         => 'group',
			'layout'       => 'block',
			'sub_fields'   => array(
				array(
					'key'   => 'field_gociss_about_partner_' . $i . '_name',
					'label' => 'Название компании',
					'name'  => 'name',
					'type'  => 'text',
				),
			),
		);
	}

	// === ОТЗЫВЫ (используются общие поля из страницы услуги) ===
	// Отзывы редактируются на странице услуги (gociss_service_review_*)

	// === ДОКУМЕНТЫ ===
	$about_fields[] = array(
		'key'   => 'field_gociss_about_docs_tab',
		'label' => 'Документы',
		'name'  => '',
		'type'  => 'tab',
	);
	$about_fields[] = array(
		'key'           => 'field_gociss_about_docs_title',
		'label'         => 'Заголовок секции',
		'name'          => 'gociss_about_docs_title',
		'type'          => 'text',
		'default_value' => 'Документы',
	);
	$about_fields[] = array(
		'key'           => 'field_gociss_about_docs_subtitle',
		'label'         => 'Подзаголовок',
		'name'          => 'gociss_about_docs_subtitle',
		'type'          => 'text',
		'default_value' => 'Наши документы',
	);

	// Галерея документов (отдельные image поля для бесплатной версии ACF)
	for ( $i = 1; $i <= 6; $i++ ) {
		$about_fields[] = array(
			'key'           => 'field_gociss_about_doc_' . $i,
			'label'         => 'Документ ' . $i,
			'name'          => 'gociss_about_doc_' . $i,
			'type'          => 'image',
			'instructions'  => 'Изображение сертификата/документа',
			'return_format' => 'array',
			'preview_size'  => 'medium',
		);
	}

	acf_add_local_field_group(
		array(
			'key'                   => 'group_gociss_about_page',
			'title'                 => 'Страница О компании',
			'fields'                => $about_fields,
			'location'              => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-about.php',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
		)
	);
}
add_action( 'acf/init', 'gociss_register_about_page_acf_fields' );

/**
 * ACF поля для страницы "Аккредитация"
 */
function gociss_register_accreditation_page_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	$accred_fields = array(
		// ===== Hero секция =====
		array(
			'key'   => 'field_gociss_accred_page_hero_tab',
			'label' => 'Hero секция',
			'type'  => 'tab',
		),
		array(
			'key'          => 'field_gociss_accred_page_hero_title',
			'label'        => 'Заголовок',
			'name'         => 'gociss_accred_page_hero_title',
			'type'         => 'text',
			'instructions' => 'Главный заголовок страницы',
			'placeholder'  => 'Информация об аккредитации',
		),
		array(
			'key'          => 'field_gociss_accred_page_hero_subtitle',
			'label'        => 'Подзаголовок',
			'name'         => 'gociss_accred_page_hero_subtitle',
			'type'         => 'textarea',
			'instructions' => 'Описание под заголовком',
			'rows'         => 2,
		),
		array(
			'key'           => 'field_gociss_accred_page_hero_image',
			'label'         => 'Фоновое изображение',
			'name'          => 'gociss_accred_page_hero_image',
			'type'          => 'image',
			'instructions'  => 'Фото для фона Hero секции (с белым blur-оверлеем)',
			'return_format' => 'array',
			'preview_size'  => 'medium',
		),

		// ===== Секция "О нашей аккредитации" =====
		array(
			'key'   => 'field_gociss_accred_page_info_tab',
			'label' => 'О нашей аккредитации',
			'type'  => 'tab',
		),
		array(
			'key'         => 'field_gociss_accred_page_info_title',
			'label'       => 'Заголовок карточки',
			'name'        => 'gociss_accred_page_info_title',
			'type'        => 'text',
			'placeholder' => 'О нашей аккредитации',
		),
		array(
			'key'          => 'field_gociss_accred_page_info_text',
			'label'        => 'Текст описания',
			'name'         => 'gociss_accred_page_info_text',
			'type'         => 'wysiwyg',
			'instructions' => 'Основной текст с возможностью добавить ссылки',
			'toolbar'      => 'basic',
			'media_upload' => 0,
		),
		array(
			'key'          => 'field_gociss_accred_page_info_date',
			'label'        => 'Дата внесения в реестр',
			'name'         => 'gociss_accred_page_info_date',
			'type'         => 'text',
			'placeholder'  => '17.04.2015',
			'instructions' => 'Дата в формате ДД.ММ.ГГГГ',
		),
		array(
			'key'         => 'field_gociss_accred_page_info_btn_text',
			'label'       => 'Текст кнопки',
			'name'        => 'gociss_accred_page_info_btn_text',
			'type'        => 'text',
			'placeholder' => 'Перейти в карточку в реестре',
		),
		array(
			'key'          => 'field_gociss_accred_page_info_btn_url',
			'label'        => 'Ссылка кнопки',
			'name'         => 'gociss_accred_page_info_btn_url',
			'type'         => 'url',
			'instructions' => 'Ссылка на карточку в реестре Росаккредитации',
		),
		array(
			'key'           => 'field_gociss_accred_page_info_logo1',
			'label'         => 'Логотип 1 (Росаккредитация)',
			'name'          => 'gociss_accred_page_info_logo1',
			'type'          => 'image',
			'return_format' => 'array',
			'preview_size'  => 'thumbnail',
		),
		array(
			'key'           => 'field_gociss_accred_page_info_logo2',
			'label'         => 'Логотип 2 (ISO)',
			'name'          => 'gociss_accred_page_info_logo2',
			'type'          => 'image',
			'return_format' => 'array',
			'preview_size'  => 'thumbnail',
		),

		// ===== Секция "Аттестат аккредитации" =====
		array(
			'key'   => 'field_gociss_accred_page_cert_tab',
			'label' => 'Аттестат аккредитации',
			'type'  => 'tab',
		),
		array(
			'key'         => 'field_gociss_accred_page_cert_title',
			'label'       => 'Заголовок секции',
			'name'        => 'gociss_accred_page_cert_title',
			'type'        => 'text',
			'placeholder' => 'Аттестат аккредитации',
		),
		array(
			'key'           => 'field_gociss_accred_page_cert_image',
			'label'         => 'Изображение аттестата',
			'name'          => 'gociss_accred_page_cert_image',
			'type'          => 'image',
			'instructions'  => 'Скан/фото аттестата аккредитации',
			'return_format' => 'array',
			'preview_size'  => 'medium',
		),
		array(
			'key'         => 'field_gociss_accred_page_cert_number',
			'label'       => 'Номер аттестата',
			'name'        => 'gociss_accred_page_cert_number',
			'type'        => 'text',
			'placeholder' => 'RA.RU.13СМ43',
		),
		array(
			'key'         => 'field_gociss_accred_page_cert_org',
			'label'       => 'Орган аккредитации',
			'name'        => 'gociss_accred_page_cert_org',
			'type'        => 'text',
			'placeholder' => 'Федеральная служба по аккредитации (Росаккредитация)',
		),
		array(
			'key'         => 'field_gociss_accred_page_cert_date',
			'label'       => 'Дата аккредитации',
			'name'        => 'gociss_accred_page_cert_date',
			'type'        => 'text',
			'placeholder' => '17 апреля 2015 года',
		),
		array(
			'key'         => 'field_gociss_accred_page_cert_status',
			'label'       => 'Статус',
			'name'        => 'gociss_accred_page_cert_status',
			'type'        => 'text',
			'placeholder' => 'Действующая аккредитация',
		),
		array(
			'key'          => 'field_gociss_accred_page_cert_note',
			'label'        => 'Примечание',
			'name'         => 'gociss_accred_page_cert_note',
			'type'         => 'textarea',
			'instructions' => 'Текст в голубой плашке внизу',
			'rows'         => 3,
		),
	);

	acf_add_local_field_group(
		array(
			'key'                   => 'group_gociss_accred_page',
			'title'                 => 'Страница Аккредитация',
			'fields'                => $accred_fields,
			'location'              => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-accreditation.php',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
		)
	);
}
add_action( 'acf/init', 'gociss_register_accreditation_page_acf_fields' );

