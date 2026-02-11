<?php
/**
 * Автоматическое создание страниц при активации темы
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Создание главной страницы при активации темы
 */
function gociss_create_front_page() {
	// Проверяем, существует ли уже страница "Главная"
	$front_page = get_page_by_title( 'Главная' );

	if ( ! $front_page ) {
		// Создаём страницу "Главная"
		$page_data = array(
			'post_title'    => 'Главная',
			'post_name'     => 'glavnaya',
			'post_content'  => '',
			'post_status'   => 'publish',
			'post_type'     => 'page',
			'post_author'   => 1,
		);

		$page_id = wp_insert_post( $page_data );

		if ( $page_id ) {
			// Устанавливаем шаблон страницы
			update_post_meta( $page_id, '_wp_page_template', 'page-front.php' );

			// Устанавливаем как главную страницу
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $page_id );
		}
	} else {
		// Если страница уже существует, обновляем настройки
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page->ID );
		update_post_meta( $front_page->ID, '_wp_page_template', 'page-front.php' );
	}
}
add_action( 'after_switch_theme', 'gociss_create_front_page' );

/**
 * Создание главной страницы вручную (можно вызвать из админки)
 */
function gociss_create_front_page_manual() {
	gociss_create_front_page();
	return 'Главная страница создана!';
}

/**
 * Создание всех страниц для меню при активации темы
 */
function gociss_create_menu_pages() {
	// Список страниц для создания
	$pages = array(
		array(
			'title'    => 'О компании',
			'slug'     => 'o-kompanii',
			'template' => '',
			'content'  => '<!-- Контент страницы "О компании" -->',
		),
		array(
			'title'    => 'Аккредитация',
			'slug'     => 'akkreditaciya',
			'template' => '',
			'content'  => '<!-- Контент страницы "Аккредитация" -->',
		),
		array(
			'title'    => 'Реестры',
			'slug'     => 'reestr',
			'template' => 'page-reestr.php',
			'content'  => '',
		),
		array(
			'title'    => 'Блог',
			'slug'     => 'blog',
			'template' => '',
			'content'  => '<!-- Страница блога - редирект на архив статей -->',
		),
		array(
			'title'    => 'Контакты',
			'slug'     => 'kontakty',
			'template' => '',
			'content'  => '<!-- Контент страницы "Контакты" -->',
		),
	);

	$created_pages = array();

	foreach ( $pages as $page_info ) {
		// Проверяем, существует ли страница
		$existing_page = get_page_by_path( $page_info['slug'] );

		if ( ! $existing_page ) {
			$page_data = array(
				'post_title'   => $page_info['title'],
				'post_name'    => $page_info['slug'],
				'post_content' => $page_info['content'],
				'post_status'  => 'publish',
				'post_type'    => 'page',
				'post_author'  => 1,
			);

			$page_id = wp_insert_post( $page_data );

			if ( $page_id && ! empty( $page_info['template'] ) ) {
				update_post_meta( $page_id, '_wp_page_template', $page_info['template'] );
			}

			if ( $page_id ) {
				$created_pages[ $page_info['slug'] ] = $page_id;
			}
		} else {
			$created_pages[ $page_info['slug'] ] = $existing_page->ID;

			// Обновляем шаблон если указан (принудительно)
			if ( ! empty( $page_info['template'] ) ) {
				update_post_meta( $existing_page->ID, '_wp_page_template', $page_info['template'] );
			}
		}

		// Дополнительная проверка для страницы реестра
		if ( $page_info['slug'] === 'reestr' ) {
			$reestr_page_id = isset( $created_pages['reestr'] ) ? $created_pages['reestr'] : null;
			if ( $reestr_page_id ) {
				update_post_meta( $reestr_page_id, '_wp_page_template', 'page-reestr.php' );
			}
		}
	}

	return $created_pages;
}
add_action( 'after_switch_theme', 'gociss_create_menu_pages' );

/**
 * Создание главного меню при активации темы
 */
function gociss_create_primary_menu() {
	// Проверяем, есть ли уже меню
	$menu_name   = 'Главное меню';
	$menu_exists = wp_get_nav_menu_object( $menu_name );

	// Если меню существует - удаляем старые пункты и создаём заново
	if ( $menu_exists ) {
		$menu_id = $menu_exists->term_id;
		// Удаляем все пункты меню
		$menu_items = wp_get_nav_menu_items( $menu_id );
		if ( $menu_items ) {
			foreach ( $menu_items as $item ) {
				wp_delete_post( $item->ID, true );
			}
		}
	} else {
		// Создаём новое меню
		$menu_id = wp_create_nav_menu( $menu_name );
		if ( is_wp_error( $menu_id ) ) {
			return;
		}
	}

	// Создаём меню
	$menu_id = wp_create_nav_menu( $menu_name );

	if ( is_wp_error( $menu_id ) ) {
		return;
	}

	// Получаем страницы
	$about_page    = get_page_by_path( 'o-kompanii' );
	$accred_page   = get_page_by_path( 'akkreditaciya' );
	$registry_page = get_page_by_path( 'reestr' );
	$contacts_page = get_page_by_path( 'kontakty' );

	// Добавляем пункты меню
	if ( $about_page ) {
		wp_update_nav_menu_item(
			$menu_id,
			0,
			array(
				'menu-item-title'     => 'О компании',
				'menu-item-object'    => 'page',
				'menu-item-object-id' => $about_page->ID,
				'menu-item-type'      => 'post_type',
				'menu-item-status'    => 'publish',
				'menu-item-position'  => 1,
			)
		);
	}

	if ( $accred_page ) {
		wp_update_nav_menu_item(
			$menu_id,
			0,
			array(
				'menu-item-title'     => 'Аккредитация',
				'menu-item-object'    => 'page',
				'menu-item-object-id' => $accred_page->ID,
				'menu-item-type'      => 'post_type',
				'menu-item-status'    => 'publish',
				'menu-item-position'  => 2,
			)
		);
	}

	if ( $registry_page ) {
		wp_update_nav_menu_item(
			$menu_id,
			0,
			array(
				'menu-item-title'     => 'Реестры',
				'menu-item-object'    => 'page',
				'menu-item-object-id' => $registry_page->ID,
				'menu-item-type'      => 'post_type',
				'menu-item-status'    => 'publish',
				'menu-item-position'  => 3,
			)
		);
	}

	// Блог — страница с редиректом на архив статей
	$blog_page = get_page_by_path( 'blog' );
	if ( $blog_page ) {
		wp_update_nav_menu_item(
			$menu_id,
			0,
			array(
				'menu-item-title'     => 'Блог',
				'menu-item-object'    => 'page',
				'menu-item-object-id' => $blog_page->ID,
				'menu-item-type'      => 'post_type',
				'menu-item-status'    => 'publish',
				'menu-item-position'  => 4,
			)
		);
	}

	if ( $contacts_page ) {
		wp_update_nav_menu_item(
			$menu_id,
			0,
			array(
				'menu-item-title'     => 'Контакты',
				'menu-item-object'    => 'page',
				'menu-item-object-id' => $contacts_page->ID,
				'menu-item-type'      => 'post_type',
				'menu-item-status'    => 'publish',
				'menu-item-position'  => 5,
			)
		);
	}

	// Привязываем меню к позиции primary
	$locations = get_theme_mod( 'nav_menu_locations' );
	$locations['primary'] = $menu_id;
	set_theme_mod( 'nav_menu_locations', $locations );
}
add_action( 'after_switch_theme', 'gociss_create_primary_menu', 20 );

/**
 * Создание меню услуг (синяя панель) при активации темы
 *
 * Пункты добавляются как произвольные ссылки.
 * Иконки задаются через CSS-классы: icon-ham, icon-iso, icon-grad, icon-pack, icon-user, icon-file
 * Если страница ещё не создана — ссылка будет вести на 404, пока страница не появится.
 */
function gociss_create_services_menu() {
	$menu_name   = 'Меню услуг';
	$menu_exists = wp_get_nav_menu_object( $menu_name );

	// Если меню уже существует — не трогаем (пользователь мог настроить)
	if ( $menu_exists ) {
		// Просто привязываем к позиции, если ещё не привязано
		$locations = get_theme_mod( 'nav_menu_locations' );
		if ( empty( $locations['services'] ) ) {
			$locations['services'] = $menu_exists->term_id;
			set_theme_mod( 'nav_menu_locations', $locations );
		}
		return;
	}

	$menu_id = wp_create_nav_menu( $menu_name );

	if ( is_wp_error( $menu_id ) ) {
		return;
	}

	$service_archive = get_post_type_archive_link( 'gociss_service' );
	if ( ! $service_archive ) {
		$service_archive = home_url( '/uslugi/' );
	}

	// Получаем категории из единого источника (theme-setup.php)
	$nav_categories = gociss_get_nav_service_categories();

	// Формируем пункты меню: «Все услуги» + категории + «Учебный центр»
	$default_items = array(
		array(
			'title'   => 'Все услуги',
			'url'     => $service_archive,
			'classes' => array( 'icon-ham' ),
			'order'   => 1,
		),
	);

	$order = 2;
	foreach ( $nav_categories as $cat ) {
		// Ищем реальную категорию в БД, если нет — fallback на ожидаемый URL (404)
		$cat_url = gociss_get_service_cat_url( $cat['names'], $cat['slugs'], $cat['slugs'][0] );

		$default_items[] = array(
			'title'   => $cat['label'],
			'url'     => $cat_url,
			'classes' => array( $cat['icon'] ),
			'order'   => $order,
		);
		$order++;
	}

	$default_items[] = array(
		'title'   => 'Учебный центр',
		'url'     => home_url( '/edu/' ),
		'classes' => array( 'icon-file' ),
		'order'   => $order,
	);

	foreach ( $default_items as $item ) {
		wp_update_nav_menu_item(
			$menu_id,
			0,
			array(
				'menu-item-title'    => $item['title'],
				'menu-item-url'      => $item['url'],
				'menu-item-type'     => 'custom',
				'menu-item-status'   => 'publish',
				'menu-item-position' => $item['order'],
				'menu-item-classes'  => implode( ' ', $item['classes'] ),
			)
		);
	}

	// Привязываем меню к позиции services
	$locations = get_theme_mod( 'nav_menu_locations' );
	$locations['services'] = $menu_id;
	set_theme_mod( 'nav_menu_locations', $locations );
}
add_action( 'after_switch_theme', 'gociss_create_services_menu', 25 );

/**
 * Создание страниц и меню вручную (однократный запуск)
 * Вызывается при первой загрузке если страницы не созданы
 */
function gociss_maybe_create_pages_and_menu() {
	// Проверяем, созданы ли страницы (версия 1.2.3 для принудительного запуска)
	$version = get_option( 'gociss_pages_created' );

	// Проверяем, существуют ли все нужные страницы
	$required_pages = array( 'o-kompanii', 'akkreditaciya', 'reestr', 'blog', 'kontakty' );
	$all_exist = true;

	foreach ( $required_pages as $slug ) {
		$page = get_page_by_path( $slug );
		if ( ! $page ) {
			$all_exist = false;
			break;
		}
	}

	// Если версия совпадает И все страницы существуют - выходим
	if ( $version === '1.2.3' && $all_exist ) {
		return;
	}

	// Создаём страницы
	$created = gociss_create_menu_pages();

	// Создаём меню (даже если оно уже существует - обновим)
	gociss_create_primary_menu();

	// Создаём меню услуг (синяя панель), если ещё нет
	gociss_create_services_menu();

	// Принудительно обновляем шаблон для страницы реестра
	$reestr_page = get_page_by_path( 'reestr' );
	if ( $reestr_page ) {
		update_post_meta( $reestr_page->ID, '_wp_page_template', 'page-reestr.php' );
	}

	// Отмечаем что страницы созданы
	update_option( 'gociss_pages_created', '1.2.3' );
}
add_action( 'init', 'gociss_maybe_create_pages_and_menu', 100 );

