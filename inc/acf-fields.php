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
					'label'             => 'Изображение сертификатов',
					'name'              => 'gociss_hero_image',
					'type'              => 'image',
					'instructions'      => 'Загрузите изображение с сертификатами для Hero секции. Рекомендуемый размер: 600x400px',
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

	// Hero секция страницы услуги
	acf_add_local_field_group(
		array(
			'key'                   => 'group_gociss_service_hero',
			'title'                 => 'Услуга: Hero секция',
			'fields'                => array(
				array(
					'key'               => 'field_gociss_service_label',
					'label'             => 'Метка (над заголовком)',
					'name'              => 'gociss_service_label',
					'type'              => 'text',
					'instructions'      => 'Например: "Сертификация систем менеджмента"',
				),
				array(
					'key'               => 'field_gociss_service_title',
					'label'             => 'Заголовок услуги',
					'name'              => 'gociss_service_title',
					'type'              => 'text',
					'instructions'      => 'Если не заполнено, используется название страницы',
				),
				array(
					'key'               => 'field_gociss_service_description',
					'label'             => 'Описание услуги',
					'name'              => 'gociss_service_description',
					'type'              => 'wysiwyg',
					'toolbar'           => 'basic',
					'media_upload'      => 0,
				),
				array(
					'key'               => 'field_gociss_service_image',
					'label'             => 'Изображение',
					'name'              => 'gociss_service_image',
					'type'              => 'image',
					'instructions'      => 'Изображение сертификата или услуги. Рекомендуемый размер: 600x400px',
					'return_format'     => 'array',
					'preview_size'      => 'medium',
				),
				array(
					'key'               => 'field_gociss_service_advantages',
					'label'             => 'Преимущества услуги',
					'name'              => 'gociss_service_advantages',
					'type'              => 'repeater',
					'layout'            => 'block',
					'button_label'      => 'Добавить преимущество',
					'max'               => 6,
					'sub_fields'        => array(
						array(
							'key'           => 'field_gociss_service_adv_icon',
							'label'         => 'Иконка',
							'name'          => 'icon',
							'type'          => 'image',
							'return_format' => 'array',
							'preview_size'  => 'thumbnail',
							'instructions'  => 'SVG или PNG, 24x24px',
						),
						array(
							'key'   => 'field_gociss_service_adv_text',
							'label' => 'Текст преимущества',
							'name'  => 'text',
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
					'default_value'     => 'Все цены указаны для одного юридического лица/ИП',
				),
				array(
					'key'               => 'field_gociss_service_pricing_items',
					'label'             => 'Ценовые карточки',
					'name'              => 'gociss_service_pricing_items',
					'type'              => 'repeater',
					'layout'            => 'block',
					'button_label'      => 'Добавить карточку',
					'max'               => 6,
					'sub_fields'        => array(
						array(
							'key'           => 'field_gociss_service_pricing_icon',
							'label'         => 'Иконка',
							'name'          => 'icon',
							'type'          => 'image',
							'return_format' => 'array',
							'preview_size'  => 'thumbnail',
						),
						array(
							'key'   => 'field_gociss_service_pricing_item_title',
							'label' => 'Название',
							'name'  => 'title',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_service_pricing_item_desc',
							'label' => 'Описание',
							'name'  => 'description',
							'type'  => 'textarea',
							'rows'  => 2,
						),
						array(
							'key'   => 'field_gociss_service_pricing_item_price',
							'label' => 'Цена',
							'name'  => 'price',
							'type'  => 'text',
							'instructions' => 'Например: "от 15 000 ₽" или "Бесплатно"',
						),
						array(
							'key'           => 'field_gociss_service_pricing_item_btn_text',
							'label'         => 'Текст кнопки',
							'name'          => 'button_text',
							'type'          => 'text',
							'default_value' => 'Заказать',
						),
						array(
							'key'           => 'field_gociss_service_pricing_item_btn_url',
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
					'default_value'     => 'Простой путь к сертификации вашей продукции',
				),
				array(
					'key'               => 'field_gociss_service_process_steps',
					'label'             => 'Шаги процесса',
					'name'              => 'gociss_service_process_steps',
					'type'              => 'repeater',
					'layout'            => 'block',
					'button_label'      => 'Добавить шаг',
					'max'               => 8,
					'sub_fields'        => array(
						array(
							'key'           => 'field_gociss_service_process_step_icon',
							'label'         => 'Иконка',
							'name'          => 'icon',
							'type'          => 'image',
							'return_format' => 'array',
							'preview_size'  => 'thumbnail',
						),
						array(
							'key'   => 'field_gociss_service_process_step_title',
							'label' => 'Название шага',
							'name'  => 'title',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_service_process_step_desc',
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
				),
				array(
					'key'               => 'field_gociss_service_certs_items',
					'label'             => 'Сертификаты',
					'name'              => 'gociss_service_certs_items',
					'type'              => 'repeater',
					'layout'            => 'block',
					'button_label'      => 'Добавить сертификат',
					'max'               => 5,
					'sub_fields'        => array(
						array(
							'key'           => 'field_gociss_service_certs_item_image',
							'label'         => 'Изображение',
							'name'          => 'image',
							'type'          => 'image',
							'return_format' => 'array',
							'preview_size'  => 'medium',
							'instructions'  => 'Загрузите изображение сертификата',
						),
						array(
							'key'   => 'field_gociss_service_certs_item_caption',
							'label' => 'Подпись',
							'name'  => 'caption',
							'type'  => 'text',
							'instructions' => 'Например: "Образец 2023"',
						),
					),
				),
				array(
					'key'               => 'field_gociss_service_certs_description',
					'label'             => 'Описание (справа)',
					'name'              => 'gociss_service_certs_description',
					'type'              => 'wysiwyg',
					'toolbar'           => 'basic',
					'media_upload'      => 0,
					'instructions'      => 'Текст с описанием, что должен содержать сертификат',
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

	// Секция отзывов
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
				array(
					'key'               => 'field_gociss_service_reviews_items',
					'label'             => 'Отзывы',
					'name'              => 'gociss_service_reviews_items',
					'type'              => 'repeater',
					'layout'            => 'block',
					'button_label'      => 'Добавить отзыв',
					'sub_fields'        => array(
						array(
							'key'   => 'field_gociss_service_review_company',
							'label' => 'Компания',
							'name'  => 'company',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_service_review_author',
							'label' => 'Имя автора',
							'name'  => 'author',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_service_review_position',
							'label' => 'Должность',
							'name'  => 'position',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_gociss_service_review_text',
							'label' => 'Текст отзыва',
							'name'  => 'text',
							'type'  => 'textarea',
							'rows'  => 4,
						),
						array(
							'key'           => 'field_gociss_service_review_rating',
							'label'         => 'Рейтинг (1-5)',
							'name'          => 'rating',
							'type'          => 'number',
							'min'           => 1,
							'max'           => 5,
							'default_value' => 5,
						),
						array(
							'key'           => 'field_gociss_service_review_image',
							'label'         => 'Фото автора',
							'name'          => 'image',
							'type'          => 'image',
							'return_format' => 'array',
							'preview_size'  => 'thumbnail',
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

