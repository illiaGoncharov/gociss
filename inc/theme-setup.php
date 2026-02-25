<?php
/**
 * Настройка темы
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Инициализация темы
 */
function gociss_theme_setup() {
	// Поддержка переводов
	load_theme_textdomain( 'gociss', GOCISS_THEME_PATH . '/languages' );

	// Поддержка автоматических title тегов
	add_theme_support( 'title-tag' );

	// Поддержка миниатюр записей
	add_theme_support( 'post-thumbnails' );

	// Поддержка кастомного логотипа
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 100,
			'width'       => 400,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	// Кастомные размеры изображений
	add_image_size( 'gociss-hero', 1200, 600, true );
	add_image_size( 'gociss-service', 400, 300, true );
	add_image_size( 'gociss-expert', 230, 300, true ); // Изменено с 300x300 на 230x300
	add_image_size( 'gociss-news', 600, 400, true );
	add_image_size( 'gociss-service-icon', 64, 64, true ); // Иконки услуг в архиве
	add_image_size( 'gociss-accreditation-cert', 400, 550, false ); // Сертификат аккредитации

	// Регистрация меню
	register_nav_menus(
		array(
			'primary'          => esc_html__( 'Основное меню', 'gociss' ),
			'services'         => esc_html__( 'Меню услуг (синяя панель)', 'gociss' ),
			'footer'           => esc_html__( 'Меню в футере', 'gociss' ),
			'footer-services'  => esc_html__( 'Футер: Услуги', 'gociss' ),
			'footer-info'      => esc_html__( 'Футер: Информация', 'gociss' ),
			'footer-company'   => esc_html__( 'Футер: Компания', 'gociss' ),
		)
	);

	// Поддержка HTML5
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Отключение Gutenberg
	add_filter( 'use_block_editor_for_post', '__return_false', 10 );
	add_filter( 'use_block_editor_for_post_type', '__return_false', 10 );

	// Отключение стилей Gutenberg
	add_action( 'wp_enqueue_scripts', 'gociss_disable_gutenberg_styles', 100 );
}
add_action( 'after_setup_theme', 'gociss_theme_setup' );

/**
 * Отключение проверки обновлений WordPress (для локальной разработки)
 * Убирает предупреждения о подключении к WordPress.org
 */
function gociss_disable_update_checks() {
	// Отключаем проверку обновлений WordPress
	remove_action( 'admin_init', '_maybe_update_core' );
	remove_action( 'admin_init', '_maybe_update_plugins' );
	remove_action( 'admin_init', '_maybe_update_themes' );

	// Отключаем автоматические проверки обновлений
	add_filter( 'pre_site_transient_update_core', '__return_null' );
	add_filter( 'pre_site_transient_update_plugins', '__return_null' );
	add_filter( 'pre_site_transient_update_themes', '__return_null' );
}
add_action( 'admin_init', 'gociss_disable_update_checks', 1 );

/**
 * Отключение стилей Gutenberg
 */
function gociss_disable_gutenberg_styles() {
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'wc-block-style' );
}

/**
 * Настройка ширины контента
 */
function gociss_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'gociss_content_width', 1200 );
}
add_action( 'after_setup_theme', 'gociss_content_width', 0 );

/**
 * Разрешение загрузки SVG файлов
 */
function gociss_mime_types( $mimes ) {
	$mimes['svg']  = 'image/svg+xml';
	$mimes['svgz'] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'upload_mimes', 'gociss_mime_types' );

/**
 * Исправление отображения SVG в медиабиблиотеке
 */
function gociss_fix_svg_thumb_display() {
	?>
	<style>
		.attachment-266x266,
		.thumbnail img {
			width: 100% !important;
			height: auto !important;
		}
		.media-icon img[src$=".svg"] {
			width: 100%;
			height: auto;
		}
	</style>
	<?php
}
add_action( 'admin_head', 'gociss_fix_svg_thumb_display' );

/**
 * Санитизация SVG файлов для безопасности
 */
function gociss_sanitize_svg( $file ) {
	if ( $file['type'] === 'image/svg+xml' ) {
		$svg_content = file_get_contents( $file['tmp_name'] );

		// Удаляем потенциально опасные элементы
		$dangerous_tags = array( 'script', 'iframe', 'object', 'embed', 'link' );
		foreach ( $dangerous_tags as $tag ) {
			$svg_content = preg_replace( '/<' . $tag . '[^>]*>.*?<\/' . $tag . '>/is', '', $svg_content );
		}

		// Удаляем опасные атрибуты
		$svg_content = preg_replace( '/on\w+\s*=\s*["\'][^"\']*["\']/i', '', $svg_content );

		file_put_contents( $file['tmp_name'], $svg_content );
	}

	return $file;
}
add_filter( 'wp_handle_upload_prefilter', 'gociss_sanitize_svg' );

/**
 * Исправление прав доступа к директории uploads
 * Обеспечивает возможность создания поддиректорий WordPress
 */
function gociss_fix_uploads_permissions() {
	$upload_dir = wp_upload_dir();
	$base_dir = $upload_dir['basedir'];

	// Убеждаемся, что базовая директория существует и имеет правильные права
	if ( ! file_exists( $base_dir ) ) {
		wp_mkdir_p( $base_dir );
	}

	// Устанавливаем права на запись для директории uploads
	if ( file_exists( $base_dir ) ) {
		@chmod( $base_dir, 0755 );
	}
}
add_action( 'admin_init', 'gociss_fix_uploads_permissions' );

/**
 * Получить URL страницы по шаблону
 *
 * @param string $template Имя файла шаблона (например, 'page-gost.php').
 * @return string URL страницы или home_url() если страница не найдена.
 */
function gociss_get_page_url_by_template( $template ) {
	$pages = get_posts(
		array(
			'post_type'      => 'page',
			'posts_per_page' => 1,
			'meta_key'       => '_wp_page_template',
			'meta_value'     => $template,
			'post_status'    => 'publish',
		)
	);

	if ( ! empty( $pages ) ) {
		return get_permalink( $pages[0]->ID );
	}

	return home_url( '/' );
}

/**
 * Получить хлебные крошки для услуги
 *
 * @param int|null $post_id ID поста (опционально, по умолчанию текущий пост).
 * @return array Массив элементов breadcrumbs с ключами 'title', 'url', 'current'.
 */
function gociss_get_service_breadcrumbs( $post_id = null ) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	$breadcrumbs = array();

	// Главная
	$breadcrumbs[] = array(
		'title'   => __( 'Главная', 'gociss' ),
		'url'     => home_url( '/' ),
		'current' => false,
	);

	// Услуги (архив)
	$breadcrumbs[] = array(
		'title'   => __( 'Услуги', 'gociss' ),
		'url'     => get_post_type_archive_link( 'gociss_service' ),
		'current' => false,
	);

	// Получаем категории услуги
	$service_terms = get_the_terms( $post_id, 'gociss_service_cat' );

	if ( $service_terms && ! is_wp_error( $service_terms ) ) {
		$primary_term = $service_terms[0];

		// Проверяем, есть ли родительская категория
		if ( $primary_term->parent > 0 ) {
			$parent_term = get_term( $primary_term->parent, 'gociss_service_cat' );
			if ( $parent_term && ! is_wp_error( $parent_term ) ) {
				$breadcrumbs[] = array(
					'title'   => $parent_term->name,
					'url'     => get_term_link( $parent_term ),
					'current' => false,
				);
			}
		}

		// Текущая категория
		$breadcrumbs[] = array(
			'title'   => $primary_term->name,
			'url'     => get_term_link( $primary_term ),
			'current' => false,
		);
	}

	// Текущая услуга
	$breadcrumbs[] = array(
		'title'   => get_the_title( $post_id ),
		'url'     => '',
		'current' => true,
	);

	return $breadcrumbs;
}

/**
 * Вывести хлебные крошки HTML
 *
 * @param array $breadcrumbs Массив элементов breadcrumbs.
 * @param string $separator Разделитель между элементами.
 */
function gociss_render_breadcrumbs( $breadcrumbs, $separator = '/' ) {
	if ( empty( $breadcrumbs ) ) {
		return;
	}
	?>
	<nav class="breadcrumbs" aria-label="<?php esc_attr_e( 'Хлебные крошки', 'gociss' ); ?>">
		<?php
		$total = count( $breadcrumbs );
		$i     = 0;
		foreach ( $breadcrumbs as $item ) :
			$i++;
			if ( $item['current'] ) :
				?>
				<span class="breadcrumbs__current"><?php echo esc_html( $item['title'] ); ?></span>
				<?php
			else :
				?>
				<a href="<?php echo esc_url( $item['url'] ); ?>"><?php echo esc_html( $item['title'] ); ?></a>
				<?php if ( $i < $total ) : ?>
					<span class="breadcrumbs__separator"><?php echo esc_html( $separator ); ?></span>
				<?php endif; ?>
				<?php
			endif;
		endforeach;
		?>
	</nav>
	<?php
}

/**
 * URL категории услуг по slug
 *
 * Формирует URL напрямую из slug'а, без обращения к БД.
 * Формат URL задаётся rewrite-правилом таксономии: uslugi/category/{slug}/
 * Категории создаются автоматически в gociss_ensure_service_categories_exist().
 *
 * @param array  $names         Массив возможных имён категории (не используется, сохранён для обратной совместимости).
 * @param array  $slugs         Массив возможных слагов категории.
 * @param string $fallback_slug Основной слаг для формирования URL.
 * @return string URL категории.
 */
function gociss_get_service_cat_url( $names, $slugs, $fallback_slug = '' ) {
	// Пробуем найти реальный терм и использовать get_term_link()
	foreach ( $slugs as $s ) {
		$term = get_term_by( 'slug', $s, 'gociss_service_cat' );
		if ( $term && ! is_wp_error( $term ) ) {
			$link = get_term_link( $term );
			if ( ! is_wp_error( $link ) ) {
				return $link;
			}
		}
	}

	// Fallback: формируем URL вручную
	$slug = $fallback_slug ? $fallback_slug : ( ! empty( $slugs ) ? $slugs[0] : 'unknown' );
	return home_url( '/uslugi/category/' . $slug . '/' );
}

/**
 * Маппинг для одноразовой миграции иконок существующих категорий
 */
function gociss_get_legacy_icon_map() {
	return array(
		'sertifikaciya-sistem-menedzhmenta-kachestva' => array( 'icon' => 'icon-iso', 'order' => 10 ),
		'iso'                                        => array( 'icon' => 'icon-iso', 'order' => 10 ),
		'sertifikaciya-iso'                          => array( 'icon' => 'icon-iso', 'order' => 10 ),
		'opyt-i-reputaciya'                          => array( 'icon' => 'icon-grad', 'order' => 20 ),
		'reputation'                                 => array( 'icon' => 'icon-grad', 'order' => 20 ),
		'sertifikaciya-produkcii'                    => array( 'icon' => 'icon-pack', 'order' => 30 ),
		'product'                                    => array( 'icon' => 'icon-pack', 'order' => 30 ),
		'sertifikaciya-personala'                    => array( 'icon' => 'icon-user', 'order' => 40 ),
		'personnel'                                  => array( 'icon' => 'icon-user', 'order' => 40 ),
		'dobrovolnaya-sertifikaciya'                 => array( 'icon' => 'icon-file', 'order' => 50 ),
		'voluntary'                                  => array( 'icon' => 'icon-file', 'order' => 50 ),
	);
}

/**
 * Одноразовая миграция: проставить ACF-поля иконок и порядка существующим категориям
 */
function gociss_migrate_service_cat_icons() {
	$version = 2; // v2: исправлено имя поля nav_icon
	if ( (int) get_option( 'gociss_service_cat_icons_migrated' ) >= $version ) {
		return;
	}

	if ( ! function_exists( 'update_field' ) ) {
		return;
	}

	$legacy_map = gociss_get_legacy_icon_map();
	$terms      = get_terms(
		array(
			'taxonomy'   => 'gociss_service_cat',
			'hide_empty' => false,
		)
	);

	if ( empty( $terms ) || is_wp_error( $terms ) ) {
		return;
	}

	foreach ( $terms as $term ) {
		$term_acf_id = 'gociss_service_cat_' . $term->term_id;

		if ( isset( $legacy_map[ $term->slug ] ) ) {
			$data = $legacy_map[ $term->slug ];
			update_field( 'gociss_service_cat_nav_icon', $data['icon'], $term_acf_id );
			update_field( 'gociss_service_cat_nav_order', $data['order'], $term_acf_id );
			update_field( 'gociss_service_cat_show_in_nav', 1, $term_acf_id );
		} else {
			update_field( 'gociss_service_cat_nav_icon', 'icon-file', $term_acf_id );
			update_field( 'gociss_service_cat_nav_order', 99, $term_acf_id );
			update_field( 'gociss_service_cat_show_in_nav', 1, $term_acf_id );
		}
	}

	update_option( 'gociss_service_cat_icons_migrated', $version );
}
add_action( 'admin_init', 'gociss_migrate_service_cat_icons' );

/**
 * Динамический массив категорий услуг для навигации
 *
 * Получает top-level термины из таксономии gociss_service_cat,
 * иконки и порядок берёт из ACF-полей.
 *
 * @return array Массив категорий: slug => [ 'term', 'icon', 'label', 'url' ]
 */
function gociss_get_nav_service_categories() {
	$terms = get_terms(
		array(
			'taxonomy'   => 'gociss_service_cat',
			'hide_empty' => false,
			'parent'     => 0,
		)
	);

	if ( empty( $terms ) || is_wp_error( $terms ) ) {
		return array();
	}

	$categories = array();
	foreach ( $terms as $term ) {
		$term_acf_id  = 'gociss_service_cat_' . $term->term_id;
		$show_in_nav  = function_exists( 'get_field' ) ? get_field( 'gociss_service_cat_show_in_nav', $term_acf_id ) : true;

		// Пропускаем скрытые категории
		if ( ! $show_in_nav && $show_in_nav !== null ) {
			continue;
		}

		$icon      = function_exists( 'get_field' ) ? get_field( 'gociss_service_cat_nav_icon', $term_acf_id ) : 'icon-file';
		$nav_order = function_exists( 'get_field' ) ? get_field( 'gociss_service_cat_nav_order', $term_acf_id ) : 0;

		if ( ! $icon ) {
			$icon = 'icon-file';
		}

		$url = get_term_link( $term );
		if ( is_wp_error( $url ) ) {
			$url = home_url( '/uslugi/category/' . $term->slug . '/' );
		}

		$categories[ $term->slug ] = array(
			'term'      => $term,
			'names'     => array( $term->name ),
			'slugs'     => array( $term->slug ),
			'icon'      => $icon,
			'label'     => $term->name,
			'url'       => $url,
			'nav_order' => (int) $nav_order,
		);
	}

	// Сортировка по nav_order, затем по имени
	uasort( $categories, function ( $a, $b ) {
		if ( $a['nav_order'] === $b['nav_order'] ) {
			return strcmp( $a['label'], $b['label'] );
		}
		return $a['nav_order'] - $b['nav_order'];
	});

	return $categories;
}

/**
 * Получить услуги, сгруппированные по категориям таксономии gociss_service_cat
 *
 * Возвращает массив: [ term_slug => [ 'term' => WP_Term, 'services' => [...], ... ] ]
 *
 * @return array
 */
function gociss_get_services_by_category() {
	$result     = array();
	$categories = gociss_get_nav_service_categories();

	foreach ( $categories as $key => $cat_data ) {
		$term = isset( $cat_data['term'] ) ? $cat_data['term'] : null;

		if ( ! $term ) {
			continue;
		}

		$services_query = new WP_Query(
			array(
				'post_type'      => 'gociss_service',
				'posts_per_page' => 10,
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
				'post_status'    => 'publish',
				'tax_query'      => array(
					array(
						'taxonomy' => 'gociss_service_cat',
						'field'    => 'term_id',
						'terms'    => $term->term_id,
					),
				),
			)
		);

		$services = array();
		if ( $services_query->have_posts() ) {
			while ( $services_query->have_posts() ) {
				$services_query->the_post();
				$services[] = array(
					'title' => get_the_title(),
					'url'   => get_permalink(),
				);
			}
			wp_reset_postdata();
		}

		$result[ $key ] = array(
			'term'     => $term,
			'label'    => $cat_data['label'],
			'icon'     => $cat_data['icon'],
			'url'      => $cat_data['url'],
			'services' => $services,
		);
	}

	return $result;
}

/**
 * Маппинг CSS-класса иконки → файл SVG
 *
 * Используется в навигации хедера, мега-меню и ручных пунктах меню.
 *
 * @return array
 */
function gociss_get_icon_map() {
	return array(
		'icon-ham'  => 'ui_ham[white].svg',
		'icon-iso'  => 'ui_iso[white].svg',
		'icon-grad' => 'ui_grad[white].svg',
		'icon-pack' => 'ui_pack[white].svg',
		'icon-user' => 'ui_user[white].svg',
		'icon-file' => 'ui_file[white].svg',
	);
}

/**
 * Динамический рендер меню услуг (десктоп или мобильный вариант)
 *
 * Автоматическая часть: категории из таксономии gociss_service_cat (ACF-поля).
 * Ручная часть: пункты из меню «services», которые не являются gociss_service_cat.
 *
 * @param string $variant 'desktop' или 'mobile'.
 */
function gociss_render_services_nav( $variant = 'desktop' ) {
	$icon_map = gociss_get_icon_map();

	$is_mobile  = ( 'mobile' === $variant );
	$link_class = $is_mobile ? 'header-mobile-menu__services-item' : 'header-services__item';
	$icon_class = $is_mobile ? 'header-mobile-menu__services-icon' : 'header-services__icon';
	$text_class = $is_mobile ? '' : 'header-services__text';

	$categories = gociss_get_nav_service_categories();
	$images_uri = get_template_directory_uri() . '/assets/images/';

	// «Все услуги»
	$all_url     = home_url( '/uslugi/' );
	$all_extra   = $is_mobile ? '' : ' ' . $link_class . '--all';
	$ham_icon    = $icon_map['icon-ham'];

	if ( ! $is_mobile ) {
		// Десктоп: «Все услуги» с мега-меню dropdown
		$mega_data = gociss_get_services_by_category();
		?>
		<div class="header-services__mega-wrap">
			<a href="<?php echo esc_url( $all_url ); ?>" class="<?php echo esc_attr( $link_class . $all_extra ); ?>">
				<img src="<?php echo esc_url( $images_uri . $ham_icon ); ?>" alt="" class="<?php echo esc_attr( $icon_class ); ?>" width="16" height="16">
				<span class="<?php echo esc_attr( $text_class ); ?>">Все услуги</span>
				<svg class="header-services__mega-arrow" width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</a>
			<?php if ( ! empty( $mega_data ) ) : ?>
			<div class="header-services__mega-menu">
				<div class="header-services__mega-categories">
					<?php $first = true; ?>
					<?php foreach ( $mega_data as $key => $cat_group ) : ?>
						<a href="<?php echo esc_url( $cat_group['url'] ); ?>"
						   class="header-services__mega-cat<?php echo $first ? ' is-active' : ''; ?>"
						   data-category="<?php echo esc_attr( $key ); ?>">
							<?php
							$icon_file = isset( $icon_map[ $cat_group['icon'] ] ) ? $icon_map[ $cat_group['icon'] ] : '';
							if ( $icon_file ) :
							?>
								<img src="<?php echo esc_url( $images_uri . $icon_file ); ?>" alt="" width="16" height="16">
							<?php endif; ?>
							<span><?php echo esc_html( $cat_group['label'] ); ?></span>
							<svg class="header-services__mega-cat-arrow" width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M1 1L5 5L1 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</a>
						<?php $first = false; ?>
					<?php endforeach; ?>
				</div>
				<div class="header-services__mega-services">
					<?php $first = true; ?>
					<?php foreach ( $mega_data as $key => $cat_group ) : ?>
						<div class="header-services__mega-list<?php echo $first ? ' is-active' : ''; ?>"
						     data-category="<?php echo esc_attr( $key ); ?>">
							<?php if ( ! empty( $cat_group['services'] ) ) : ?>
								<?php foreach ( $cat_group['services'] as $service ) : ?>
									<a href="<?php echo esc_url( $service['url'] ); ?>" class="header-services__mega-service">
										<?php echo esc_html( $service['title'] ); ?>
									</a>
								<?php endforeach; ?>
							<?php else : ?>
								<span class="header-services__mega-empty">Услуги скоро появятся</span>
							<?php endif; ?>
						</div>
						<?php $first = false; ?>
					<?php endforeach; ?>
				</div>
			</div>
			<?php endif; ?>
		</div>
		<?php
	} else {
		// Мобильная версия: простая ссылка «Все услуги»
		?>
		<a href="<?php echo esc_url( $all_url ); ?>" class="<?php echo esc_attr( $link_class . $all_extra ); ?>">
			<img src="<?php echo esc_url( $images_uri . $ham_icon ); ?>" alt="" class="<?php echo esc_attr( $icon_class ); ?>" width="16" height="16">
			<span>Все услуги</span>
		</a>
		<?php
	}

	// Автоматические категории услуг из таксономии
	foreach ( $categories as $cat ) {
		$icon_file = isset( $icon_map[ $cat['icon'] ] ) ? $icon_map[ $cat['icon'] ] : '';
		?>
		<a href="<?php echo esc_url( $cat['url'] ); ?>" class="<?php echo esc_attr( $link_class ); ?>">
			<?php if ( $icon_file ) : ?>
				<img src="<?php echo esc_url( $images_uri . $icon_file ); ?>" alt="" class="<?php echo esc_attr( $icon_class ); ?>" width="16" height="16">
			<?php endif; ?>
			<?php if ( $text_class ) : ?>
				<span class="<?php echo esc_attr( $text_class ); ?>"><?php echo esc_html( $cat['label'] ); ?></span>
			<?php else : ?>
				<span><?php echo esc_html( $cat['label'] ); ?></span>
			<?php endif; ?>
		</a>
		<?php
	}

	// Ручные пункты из основного меню «services» (всё, что не gociss_service_cat)
	gociss_render_manual_nav_items( 'services', $link_class, $icon_class, $text_class, $icon_map, $images_uri );
}

/**
 * Рендер ручных (не-таксономических) пунктов из WordPress-меню
 *
 * Пропускает пункты, которые являются терминами gociss_service_cat (они рендерятся автоматически).
 * Иконка определяется из meta-поля `_gociss_menu_icon`.
 *
 * @param string $menu_location Локация меню WordPress.
 * @param string $link_class    CSS-класс ссылки.
 * @param string $icon_class    CSS-класс иконки.
 * @param string $text_class    CSS-класс текста (пустая строка для мобильной версии).
 * @param array  $icon_map      Маппинг CSS-класс → файл иконки.
 * @param string $images_uri    URI папки с изображениями.
 */
function gociss_render_manual_nav_items( $menu_location, $link_class, $icon_class, $text_class, $icon_map, $images_uri ) {
	$manual_items = gociss_get_manual_menu_items( $menu_location );
	if ( empty( $manual_items ) ) {
		return;
	}

	foreach ( $manual_items as $item ) {
		$icon_key  = get_post_meta( $item->ID, '_gociss_menu_icon', true );
		$icon_file = isset( $icon_map[ $icon_key ] ) ? $icon_map[ $icon_key ] : '';
		?>
		<a href="<?php echo esc_url( $item->url ); ?>" class="<?php echo esc_attr( $link_class ); ?>">
			<?php if ( $icon_file ) : ?>
				<img src="<?php echo esc_url( $images_uri . $icon_file ); ?>" alt="" class="<?php echo esc_attr( $icon_class ); ?>" width="16" height="16">
			<?php endif; ?>
			<?php if ( $text_class ) : ?>
				<span class="<?php echo esc_attr( $text_class ); ?>"><?php echo esc_html( $item->title ); ?></span>
			<?php else : ?>
				<span><?php echo esc_html( $item->title ); ?></span>
			<?php endif; ?>
		</a>
		<?php
	}
}

/**
 * Fallback для меню услуг (десктоп) — на случай если вызывается из старого кода
 */
function gociss_services_menu_fallback() {
	gociss_render_services_nav( 'desktop' );
}

/**
 * Fallback для меню услуг (мобильное) — на случай если вызывается из старого кода
 */
function gociss_services_menu_fallback_mobile() {
	gociss_render_services_nav( 'mobile' );
}

/**
 * Fallback для колонки «Услуги» в футере
 *
 * Автоматические категории из таксономии + ручные пункты из меню «services».
 */
function gociss_footer_services_fallback() {
	$nav_categories = gociss_get_nav_service_categories();

	// Ручные пункты из основного меню «services» (не-таксономические)
	$manual_items = gociss_get_manual_menu_items( 'services' );
	?>
	<ul class="site-footer__menu">
		<?php foreach ( $nav_categories as $fc ) : ?>
			<li><a href="<?php echo esc_url( $fc['url'] ); ?>"><?php echo esc_html( $fc['label'] ); ?></a></li>
		<?php endforeach; ?>
		<?php foreach ( $manual_items as $item ) : ?>
			<li><a href="<?php echo esc_url( $item->url ); ?>"><?php echo esc_html( $item->title ); ?></a></li>
		<?php endforeach; ?>
		<li><a href="<?php echo esc_url( home_url( '/uslugi/' ) ); ?>">Все услуги</a></li>
	</ul>
	<?php
}

/**
 * AJAX-обработчик для принудительного пересоздания меню услуг
 *
 * Пересоздаёт меню «Меню услуг» (хедер) и «Футер: Услуги» с актуальными URL категорий.
 * Доступно только администраторам.
 */
function gociss_ajax_regenerate_menus() {
	// Проверка прав и nonce
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( 'Недостаточно прав' );
	}

	check_admin_referer( 'gociss_regenerate_menus' );

	// Автосоздание категорий услуг, если их ещё нет в базе
	gociss_ensure_service_categories_exist();

	// Пересоздаём меню с актуальными URL
	if ( function_exists( 'gociss_create_services_menu' ) ) {
		gociss_create_services_menu( true );
	}
	if ( function_exists( 'gociss_create_footer_services_menu' ) ) {
		gociss_create_footer_services_menu( true );
	}

	// Сбрасываем rewrite rules, чтобы новые категории стали доступны без 404
	flush_rewrite_rules();

	// Редирект обратно на страницу меню с уведомлением
	wp_safe_redirect( add_query_arg( 'gociss_menus_updated', '1', admin_url( 'nav-menus.php' ) ) );
	exit;
}

/**
 * Создание категорий услуг (таксономия gociss_service_cat), если их нет в базе
 *
 * Сохранена для обратной совместимости. Категории теперь управляются
 * через админку WordPress (Записи → Категории услуг).
 */
function gociss_ensure_service_categories_exist() {
	// Категории управляются через админку, функция сохранена для совместимости
}
add_action( 'admin_post_gociss_regenerate_menus', 'gociss_ajax_regenerate_menus' );

/**
 * Показываем кнопку «Обновить ссылки меню» на странице Внешний вид → Меню
 */
function gociss_admin_menu_regenerate_notice() {
	$screen = get_current_screen();
	if ( ! $screen || 'nav-menus' !== $screen->id ) {
		return;
	}

	// Уведомление об успешном обновлении
	if ( isset( $_GET['gociss_menus_updated'] ) && '1' === $_GET['gociss_menus_updated'] ) {
		echo '<div class="notice notice-success is-dismissible"><p>Меню услуг (хедер и футер) успешно обновлены с актуальными ссылками на категории.</p></div>';
	}

	// Кнопка для обновления
	$regenerate_url = wp_nonce_url(
		admin_url( 'admin-post.php?action=gociss_regenerate_menus' ),
		'gociss_regenerate_menus'
	);
	echo '<div class="notice notice-info"><p>';
	echo 'Если ссылки в меню услуг ведут не на те страницы — ';
	echo '<a href="' . esc_url( $regenerate_url ) . '" class="button button-small">Обновить ссылки меню услуг</a>';
	echo ' (пересоздаст «Меню услуг» и «Футер: Услуги» с актуальными URL категорий)';
	echo '</p></div>';
}
add_action( 'admin_notices', 'gociss_admin_menu_regenerate_notice' );

/**
 * Dropdown выбора иконки для пунктов WordPress-меню
 *
 * Добавляет поле «Иконка (синяя панель)» в интерфейс редактирования
 * каждого пункта меню. Значение хранится в post meta `_gociss_menu_icon`.
 *
 * @param int      $item_id ID пункта меню.
 * @param WP_Post  $menu_item Объект пункта меню.
 * @param int      $depth Глубина вложенности.
 * @param stdClass $args Аргументы.
 */
function gociss_menu_item_icon_field( $item_id, $menu_item, $depth, $args ) {
	$current = get_post_meta( $item_id, '_gociss_menu_icon', true );
	$icons   = array(
		''          => '— Без иконки —',
		'icon-iso'  => 'ISO (сертификат)',
		'icon-grad' => 'Опыт (шапочка)',
		'icon-pack' => 'Продукция (коробка)',
		'icon-user' => 'Персонал (человек)',
		'icon-file' => 'Документ (файл)',
	);
	?>
	<p class="field-gociss-icon description description-wide">
		<label for="edit-menu-item-gociss-icon-<?php echo esc_attr( $item_id ); ?>">
			Иконка (синяя панель)
			<select id="edit-menu-item-gociss-icon-<?php echo esc_attr( $item_id ); ?>"
			        name="gociss_menu_icon[<?php echo esc_attr( $item_id ); ?>]"
			        class="widefat">
				<?php foreach ( $icons as $value => $label ) : ?>
					<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $current, $value ); ?>>
						<?php echo esc_html( $label ); ?>
					</option>
				<?php endforeach; ?>
			</select>
		</label>
	</p>
	<?php
}
add_action( 'wp_nav_menu_item_custom_fields', 'gociss_menu_item_icon_field', 10, 4 );

/**
 * Сохранение выбранной иконки при обновлении меню
 *
 * @param int   $menu_id         ID меню.
 * @param int   $menu_item_db_id ID пункта меню (post ID).
 * @param array $args            Аргументы пункта меню.
 */
function gociss_save_menu_item_icon( $menu_id, $menu_item_db_id, $args ) {
	if ( isset( $_POST['gociss_menu_icon'][ $menu_item_db_id ] ) ) {
		$icon = sanitize_text_field( wp_unslash( $_POST['gociss_menu_icon'][ $menu_item_db_id ] ) );
		update_post_meta( $menu_item_db_id, '_gociss_menu_icon', $icon );
	}
}
add_action( 'wp_update_nav_menu_item', 'gociss_save_menu_item_icon', 10, 3 );

/**
 * Получение ручных пунктов из WordPress-меню
 *
 * Возвращает пункты, которые НЕ дублируют автоматические категории gociss_service_cat.
 * Фильтрует по типу таксономии И по URL (на случай произвольных ссылок с тем же адресом).
 * Также пропускает пункт «Все услуги» (/uslugi/), т.к. он рендерится кодом отдельно.
 *
 * @param string $menu_location Локация меню.
 * @return array Массив пунктов меню.
 */
function gociss_get_manual_menu_items( $menu_location ) {
	$locations = get_nav_menu_locations();
	if ( empty( $locations[ $menu_location ] ) ) {
		return array();
	}

	$all_items = wp_get_nav_menu_items( $locations[ $menu_location ] );
	if ( empty( $all_items ) ) {
		return array();
	}

	// URL автоматических категорий + «Все услуги» — их пропускаем
	$auto_urls = array( trailingslashit( home_url( '/uslugi/' ) ) );
	$nav_cats  = gociss_get_nav_service_categories();
	foreach ( $nav_cats as $cat ) {
		$auto_urls[] = trailingslashit( $cat['url'] );
	}

	$manual = array();
	foreach ( $all_items as $item ) {
		if ( 'taxonomy' === $item->type && 'gociss_service_cat' === $item->object ) {
			continue;
		}
		if ( in_array( trailingslashit( $item->url ), $auto_urls, true ) ) {
			continue;
		}
		$manual[] = $item;
	}

	return $manual;
}
