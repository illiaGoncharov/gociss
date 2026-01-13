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

	// Группа полей для секции Эксперты
	acf_add_local_field_group(
		array(
			'key'                   => 'group_gociss_experts',
			'title'                 => 'Секция Эксперты',
			'fields'                => array(
				array(
					'key'               => 'field_gociss_experts_title',
					'label'             => 'Заголовок',
					'name'              => 'gociss_experts_title',
					'type'              => 'text',
					'default_value'     => 'Наши ведущие эксперты',
				),
				array(
					'key'               => 'field_gociss_experts_subtitle',
					'label'             => 'Подзаголовок',
					'name'              => 'gociss_experts_subtitle',
					'type'              => 'textarea',
					'default_value'     => 'Команда профессионалов с международной аккредитацией и многолетним опытом',
				),
				array(
					'key'               => 'field_gociss_experts_items',
					'label'             => 'Эксперты',
					'name'              => 'gociss_experts_items',
					'type'              => 'repeater',
					'layout'            => 'block',
					'button_label'      => 'Добавить эксперта',
					'sub_fields'        => array(
						array(
							'key'           => 'field_gociss_experts_photo',
							'label'         => 'Фото',
							'name'          => 'photo',
							'type'          => 'image',
							'return_format' => 'array',
							'preview_size'  => 'medium',
							'instructions'  => 'Рекомендуемый размер: 320x320px',
						),
						array(
							'key'   => 'field_gociss_experts_name',
							'label' => 'ФИО',
							'name'  => 'name',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_experts_position',
							'label' => 'Должность',
							'name'  => 'position',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_experts_experience',
							'label' => 'Опыт/Описание',
							'name'  => 'experience',
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

	// Секция FAQ для страницы услуги (переиспользуем поля)
	acf_add_local_field_group(
		array(
			'key'                   => 'group_gociss_service_faq',
			'title'                 => 'Услуга: FAQ',
			'fields'                => array(
				array(
					'key'               => 'field_gociss_service_faq_title',
					'label'             => 'Заголовок',
					'name'              => 'gociss_faq_title',
					'type'              => 'text',
					'default_value'     => 'Часто задаваемые вопросы',
				),
				array(
					'key'               => 'field_gociss_service_faq_subtitle',
					'label'             => 'Подзаголовок',
					'name'              => 'gociss_faq_subtitle',
					'type'              => 'textarea',
				),
				array(
					'key'               => 'field_gociss_service_faq_items',
					'label'             => 'Вопросы',
					'name'              => 'gociss_faq_items',
					'type'              => 'repeater',
					'layout'            => 'block',
					'sub_fields'        => array(
						array(
							'key'   => 'field_gociss_service_faq_question',
							'label' => 'Вопрос',
							'name'  => 'question',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_service_faq_answer',
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
						'value'    => 'page-service.php',
					),
				),
			),
			'menu_order'            => 6,
		)
	);

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

	// FAQ для услуги (отдельно от главной страницы)
	acf_add_local_field_group(
		array(
			'key'                   => 'group_gociss_service_faq_new',
			'title'                 => 'FAQ услуги',
			'fields'                => array(
				array(
					'key'               => 'field_gociss_service_faq_title_new',
					'label'             => 'Заголовок',
					'name'              => 'gociss_service_faq_title',
					'type'              => 'text',
					'default_value'     => 'Часто задаваемые вопросы',
				),
				array(
					'key'               => 'field_gociss_service_faq_subtitle_new',
					'label'             => 'Подзаголовок',
					'name'              => 'gociss_service_faq_subtitle',
					'type'              => 'textarea',
				),
				array(
					'key'               => 'field_gociss_service_faq_items_new',
					'label'             => 'Вопросы',
					'name'              => 'gociss_service_faq_items',
					'type'              => 'repeater',
					'layout'            => 'block',
					'sub_fields'        => array(
						array(
							'key'   => 'field_gociss_service_faq_question_new',
							'label' => 'Вопрос',
							'name'  => 'question',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_service_faq_answer_new',
							'label' => 'Ответ',
							'name'  => 'answer',
							'type'  => 'wysiwyg',
							'toolbar' => 'basic',
							'media_upload' => 0,
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

