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

				<!-- Локация -->
				<div class="header-top__location">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/ui_pin[blue].svg' ); ?>" alt="" class="location-icon" width="16" height="16">
					<div class="location-content">
						<span class="location-text">Санкт-Петербург</span>
						<span class="location-note">Работаем по всей России</span>
					</div>
				</div>

					<!-- Главное меню -->
					<nav class="header-top__nav">
						<?php
						if ( has_nav_menu( 'primary' ) ) {
							wp_nav_menu(
								array(
									'theme_location' => 'primary',
									'menu_id'        => 'primary-menu',
									'container'      => false,
									'menu_class'     => 'header-top__menu',
								)
							);
						} else {
							?>
							<ul class="header-top__menu">
								<li><a href="#about">О компании</a></li>
								<li><a href="#accreditation">Аккредитация</a></li>
								<li><a href="#registers">Реестры</a></li>
								<li><a href="#blog">Блог</a></li>
								<li><a href="#contacts">Контакты</a></li>
							</ul>
							<?php
						}
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
					<a href="#callback" class="btn btn--primary">Заказать звонок</a>
				</div>

					<!-- Кнопка мобильного меню -->
					<button class="header-mobile-toggle" aria-label="<?php esc_attr_e( 'Меню', 'gociss' ); ?>" type="button">
						<span class="header-mobile-toggle__icon"></span>
					</button>
				</div>

				<!-- Кнопка "Заказать звонок" для мобильных (внизу) -->
				<div class="header-top__mobile-button">
					<a href="#callback" class="btn btn--primary">Заказать звонок</a>
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
					<a href="#services" class="header-services__item header-services__item--all">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/ui_ham[white].svg' ); ?>" alt="" class="header-services__icon" width="16" height="16">
						<span class="header-services__text">Все услуги</span>
					</a>
					<a href="#iso" class="header-services__item">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/ui_iso[white].svg' ); ?>" alt="" class="header-services__icon" width="16" height="16">
						<span class="header-services__text">Сертификация ISO</span>
					</a>
					<a href="#reputation" class="header-services__item">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/ui_grad[white].svg' ); ?>" alt="" class="header-services__icon" width="16" height="16">
						<span class="header-services__text">Опыт и репутация</span>
					</a>
					<a href="#product" class="header-services__item">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/ui_pack[white].svg' ); ?>" alt="" class="header-services__icon" width="16" height="16">
						<span class="header-services__text">Сертификация продукции</span>
					</a>
					<a href="#personnel" class="header-services__item">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/ui_user[white].svg' ); ?>" alt="" class="header-services__icon" width="16" height="16">
						<span class="header-services__text">Сертификация персонала</span>
					</a>
					<a href="#voluntary" class="header-services__item">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/ui_file[white].svg' ); ?>" alt="" class="header-services__icon" width="16" height="16">
						<span class="header-services__text">Добровольная сертификация</span>
					</a>
					<a href="#training" class="header-services__item">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/ui_file[white].svg' ); ?>" alt="" class="header-services__icon" width="16" height="16">
						<span class="header-services__text">Учебный центр</span>
					</a>
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
					if ( has_nav_menu( 'primary' ) ) {
						wp_nav_menu(
							array(
								'theme_location' => 'primary',
								'menu_id'        => 'mobile-menu',
								'container'      => false,
								'menu_class'     => 'header-mobile-menu__list',
							)
						);
					} else {
						?>
						<ul class="header-mobile-menu__list">
							<li><a href="#about">О компании</a></li>
							<li><a href="#accreditation">Аккредитация</a></li>
							<li><a href="#registers">Реестры</a></li>
							<li><a href="#blog">Блог</a></li>
							<li><a href="#contacts">Контакты</a></li>
						</ul>
						<?php
					}
					?>
				</nav>

				<!-- Меню услуг в мобильном меню -->
				<div class="header-mobile-menu__services">
					<h3 class="header-mobile-menu__services-title">Услуги</h3>
					<nav class="header-mobile-menu__services-nav">
						<a href="#services" class="header-mobile-menu__services-item">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/ui_ham[white].svg' ); ?>" alt="" class="header-mobile-menu__services-icon" width="16" height="16">
							<span>Все услуги</span>
						</a>
						<a href="#iso" class="header-mobile-menu__services-item">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/ui_iso[white].svg' ); ?>" alt="" class="header-mobile-menu__services-icon" width="16" height="16">
							<span>Сертификация ISO</span>
						</a>
						<a href="#reputation" class="header-mobile-menu__services-item">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/ui_grad[white].svg' ); ?>" alt="" class="header-mobile-menu__services-icon" width="16" height="16">
							<span>Опыт и репутация</span>
						</a>
						<a href="#product" class="header-mobile-menu__services-item">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/ui_pack[white].svg' ); ?>" alt="" class="header-mobile-menu__services-icon" width="16" height="16">
							<span>Сертификация продукции</span>
						</a>
						<a href="#personnel" class="header-mobile-menu__services-item">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/ui_user[white].svg' ); ?>" alt="" class="header-mobile-menu__services-icon" width="16" height="16">
							<span>Сертификация персонала</span>
						</a>
						<a href="#voluntary" class="header-mobile-menu__services-item">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/ui_file[white].svg' ); ?>" alt="" class="header-mobile-menu__services-icon" width="16" height="16">
							<span>Добровольная сертификация</span>
						</a>
						<a href="#training" class="header-mobile-menu__services-item">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/ui_file[white].svg' ); ?>" alt="" class="header-mobile-menu__services-icon" width="16" height="16">
							<span>Учебный центр</span>
						</a>
					</nav>
				</div>

				<div class="header-mobile-menu__contacts">
					<a href="tel:+78005510236" class="header-mobile-menu__phone">+7 (800) 551-02-36</a>
					<a href="mailto:info@gociss.ru" class="header-mobile-menu__email">info@gociss.ru</a>
					<a href="#callback" class="btn btn--primary">Заказать звонок</a>
				</div>
			</div>
		</div>
	</header>

	<main id="main" class="site-main">



