<?php
/**
 * Шапка сайта
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">

	<header id="masthead" class="site-header">
		<!-- Верхняя часть header (белый фон) -->
		<div class="header-top">
			<div class="container">
				<div class="header-top__content">
					<!-- Логотип -->
					<div class="header-top__logo">
						<?php if ( has_custom_logo() ) : ?>
							<?php the_custom_logo(); ?>
						<?php else : ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo">
							<div class="site-logo__icon">
								<svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
									<circle cx="24" cy="24" r="24" fill="#1e3a5f"/>
									<text x="24" y="28" text-anchor="middle" fill="white" font-size="12" font-weight="bold">ГЦ</text>
								</svg>
							</div>
							<div class="site-logo__text-wrap">
								<span class="site-logo__text">ГоЦИСС</span>
								<span class="site-logo__tagline">Головной центр испытаний,<br>сертификации и стандартизации</span>
							</div>
						</a>
						<?php endif; ?>
					</div>

				<!-- Локация / Переключатель региона -->
				<?php
				$current_region = function_exists( 'gociss_get_current_region' ) ? gociss_get_current_region() : null;
				$all_regions    = function_exists( 'gociss_get_all_regions' ) ? gociss_get_all_regions() : array();
				$region_name    = $current_region ? $current_region->name : 'Санкт-Петербург';
				?>
				<div class="header-top__location region-switcher">
					<button class="region-switcher__toggle" type="button" aria-expanded="false" aria-haspopup="true">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/ui_pin[blue].svg' ); ?>" alt="" class="location-icon" width="16" height="16">
						<div class="location-content">
							<span class="location-text"><?php echo esc_html( $region_name ); ?></span>
							<span class="location-note">Работаем по всей России</span>
						</div>
						<svg class="region-switcher__arrow" width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</button>
					<?php if ( ! empty( $all_regions ) ) : ?>
					<div class="region-switcher__dropdown">
						<div class="region-switcher__list">
							<?php foreach ( $all_regions as $region ) : ?>
								<?php
								$is_current = $current_region && $current_region->term_id === $region->term_id;

								// Формируем URL для региона
								$current_post = get_queried_object();
								$is_service_page = false;

								// Проверяем, это ли страница услуги
								if ( $current_post && isset( $current_post->post_type ) && $current_post->post_type === 'gociss_service' ) {
									$is_service_page = true;
								} elseif ( is_singular( 'gociss_service' ) ) {
									$is_service_page = true;
								}

								if ( $is_service_page && function_exists( 'gociss_get_service_region_url' ) ) {
									// Для страницы услуги - URL с регионом
									$service_id = is_object( $current_post ) && isset( $current_post->ID ) ? $current_post->ID : get_the_ID();
									$region_url = gociss_get_service_region_url( $service_id, $region->slug );
								} else {
									// Для других страниц - сохраняем выбор региона в cookie
									$current_url = home_url( add_query_arg( array(), $_SERVER['REQUEST_URI'] ) );
									$region_url  = add_query_arg( 'gociss_set_region', $region->slug, $current_url );
								}

								$item_class = 'region-switcher__item' . ( $is_current ? ' is-current' : '' );
								?>
								<a href="<?php echo esc_url( $region_url ); ?>" class="<?php echo esc_attr( $item_class ); ?>">
									<?php echo esc_html( $region->name ); ?>
									<?php if ( $is_current ) : ?>
										<svg class="region-switcher__check" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M3 8L6.5 11.5L13 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>
									<?php endif; ?>
								</a>
							<?php endforeach; ?>
						</div>
					</div>
					<?php endif; ?>

				<!-- Тултип подтверждения региона при первом визите -->
				<div class="region-tooltip" id="regionTooltip" style="display: none;">
					<div class="region-tooltip__arrow"></div>
					<p class="region-tooltip__text">Ваш город — <strong><?php echo esc_html( $region_name ); ?></strong>?</p>
					<div class="region-tooltip__actions">
						<button class="region-tooltip__btn region-tooltip__btn--yes" type="button">Да</button>
						<button class="region-tooltip__btn region-tooltip__btn--no" type="button">Выбрать другой</button>
					</div>
				</div>
				</div>

					<!-- Главное меню -->
					<nav class="header-top__nav">
						<?php
						wp_nav_menu(
							array(
								'theme_location'  => 'primary',
								'menu_id'         => 'primary-menu',
								'container'       => false,
								'menu_class'      => 'header-top__menu',
								'fallback_cb'     => function() {
									?>
									<ul class="header-top__menu">
										<li><a href="<?php echo esc_url( home_url( '/o-kompanii/' ) ); ?>">О компании</a></li>
										<li><a href="<?php echo esc_url( home_url( '/akkreditaciya/' ) ); ?>">Аккредитация</a></li>
										<li><a href="<?php echo esc_url( home_url( '/reestr/' ) ); ?>">Реестры</a></li>
										<li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Блог</a></li>
										<li><a href="<?php echo esc_url( home_url( '/kontakty/' ) ); ?>">Контакты</a></li>
									</ul>
									<?php
								},
							)
						);
						?>
					</nav>

				<!-- Контакты и кнопка -->
				<div class="header-top__contacts">
					<div class="header-top__phone-wrap">
						<button class="header-top__search" aria-label="<?php esc_attr_e( 'Поиск', 'gociss' ); ?>" type="button">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/ui_zoom[blue].svg' ); ?>" alt="<?php esc_attr_e( 'Поиск', 'gociss' ); ?>" width="24" height="24">
						</button>
						<div>
							<a href="tel:+78005510236" class="header-top__phone">+7 (800) 551-02-36</a>
							<a href="mailto:info@gociss.ru" class="header-top__email-text">info@gociss.ru</a>
						</div>
					</div>
					<button type="button" class="btn btn--primary js-open-callback-popup">Заказать звонок</button>
				</div>

					<!-- Кнопка мобильного меню -->
					<button class="header-mobile-toggle" aria-label="<?php esc_attr_e( 'Меню', 'gociss' ); ?>" type="button">
						<span class="header-mobile-toggle__icon"></span>
					</button>
				</div>

				<!-- Кнопка "Заказать звонок" для мобильных (внизу) -->
				<div class="header-top__mobile-button">
					<button type="button" class="btn btn--primary js-open-callback-popup">Заказать звонок</button>
				</div>
			</div>
		</div>

		<!-- Меню услуг (тёмно-синий фон) -->
		<div class="header-services is-collapsed">
			<div class="container">
				<!-- Кнопка для открытия/закрытия меню на мобильных -->
				<button class="header-services__toggle" aria-label="<?php esc_attr_e( 'Показать меню услуг', 'gociss' ); ?>" type="button">
					<span class="header-services__toggle-text">
						<span class="header-services__text">Все услуги</span>
					</span>
					<span class="header-services__toggle-icon"></span>
				</button>
			<nav class="header-services__nav">
					<?php
					// Меню услуг — настраивается в Внешний вид → Меню → «Меню услуг (синяя панель)»
					// Иконки задаются через CSS-классы пунктов: icon-ham, icon-iso, icon-grad, icon-pack, icon-user, icon-file
					wp_nav_menu(
						array(
							'theme_location' => 'services',
							'container'      => false,
							'items_wrap'     => '%3$s',
							'walker'         => new Gociss_Services_Walker(),
							'link_class'     => 'header-services__item',
							'icon_class'     => 'header-services__icon',
							'text_class'     => 'header-services__text',
							'fallback_cb'    => 'gociss_services_menu_fallback',
						)
					);
					?>
				</nav>
			</div>
		</div>

		<!-- Мобильное меню -->
		<div class="header-mobile-menu">
			<div class="header-mobile-menu__overlay"></div>
			<div class="header-mobile-menu__content">
				<button class="header-mobile-menu__close" aria-label="<?php esc_attr_e( 'Закрыть меню', 'gociss' ); ?>" type="button">
					<span class="header-mobile-menu__close-icon"></span>
				</button>

				<!-- Логотип в мобильном меню -->
				<div class="header-mobile-menu__logo">
					<?php if ( has_custom_logo() ) : ?>
						<?php the_custom_logo(); ?>
					<?php else : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo">
						<div class="site-logo__icon">
							<svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
								<circle cx="24" cy="24" r="24" fill="#1e3a5f"/>
								<text x="24" y="28" text-anchor="middle" fill="white" font-size="12" font-weight="bold">ГЦ</text>
							</svg>
						</div>
						<div class="site-logo__text-wrap">
							<span class="site-logo__text">ГоЦИСС</span>
							<span class="site-logo__tagline">Головной центр испытаний,<br>сертификации и стандартизации</span>
						</div>
					</a>
					<?php endif; ?>
				</div>

				<nav class="header-mobile-menu__nav">
					<?php
					wp_nav_menu(
						array(
							'theme_location'  => 'primary',
							'menu_id'         => 'mobile-menu',
							'container'       => false,
							'menu_class'      => 'header-mobile-menu__list',
							'fallback_cb'     => function() {
								?>
								<ul class="header-mobile-menu__list">
									<li><a href="<?php echo esc_url( home_url( '/o-kompanii/' ) ); ?>">О компании</a></li>
									<li><a href="<?php echo esc_url( home_url( '/akkreditaciya/' ) ); ?>">Аккредитация</a></li>
									<li><a href="<?php echo esc_url( home_url( '/reestr/' ) ); ?>">Реестры</a></li>
									<li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Блог</a></li>
									<li><a href="<?php echo esc_url( home_url( '/kontakty/' ) ); ?>">Контакты</a></li>
								</ul>
								<?php
							},
						)
					);
					?>
				</nav>

				<!-- Меню услуг в мобильном меню -->
				<div class="header-mobile-menu__services">
					<h3 class="header-mobile-menu__services-title">Услуги</h3>
					<nav class="header-mobile-menu__services-nav">
						<?php
						// Мобильная версия — то же меню услуг, другие CSS-классы
						wp_nav_menu(
							array(
								'theme_location' => 'services',
								'container'      => false,
								'items_wrap'     => '%3$s',
								'walker'         => new Gociss_Services_Walker(),
								'link_class'     => 'header-mobile-menu__services-item',
								'icon_class'     => 'header-mobile-menu__services-icon',
								'text_class'     => '',
								'fallback_cb'    => 'gociss_services_menu_fallback_mobile',
							)
						);
						?>
					</nav>
				</div>

				<div class="header-mobile-menu__contacts">
					<a href="tel:+78005510236" class="header-mobile-menu__phone">+7 (800) 551-02-36</a>
					<a href="mailto:info@gociss.ru" class="header-mobile-menu__email">info@gociss.ru</a>
					<button type="button" class="btn btn--primary js-open-callback-popup">Заказать звонок</button>
				</div>
			</div>
		</div>
	</header>

	<main id="main" class="site-main">



