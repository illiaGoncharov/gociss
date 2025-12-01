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
						<svg class="location-icon" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M8 0C4.7 0 2 2.7 2 6c0 4.5 6 10 6 10s6-5.5 6-10c0-3.3-2.7-6-6-6zm0 8c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" fill="currentColor"/>
						</svg>
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
							<a href="tel:+78005510236" class="header-top__phone">+7 (800) 551-02-36</a>
							<a href="mailto:info@gociss.ru" class="header-top__email-text">info@gociss.ru</a>
						</div>
						<button class="header-top__search" aria-label="<?php esc_attr_e( 'Поиск', 'gociss' ); ?>">
							<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M9 17A8 8 0 109 1a8 8 0 000 16zM19 19l-4.35-4.35" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</button>
						<a href="#callback" class="btn btn--primary">Заказать звонок</a>
					</div>
				</div>
			</div>
		</div>

		<!-- Меню услуг (тёмно-синий фон) -->
		<div class="header-services">
			<div class="container">
				<nav class="header-services__nav">
					<a href="#services" class="header-services__item header-services__item--all">
						<svg class="header-services__icon" width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
							<path d="M0 3h16v2H0V3zm0 4h16v2H0V7zm0 4h16v2H0v-2z"/>
						</svg>
						<span class="header-services__text">Все услуги</span>
					</a>
					<a href="#iso" class="header-services__item">
						<svg class="header-services__icon" width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
							<path d="M4 0h8l4 4v12H0V0h4zm7 1H5v4H1v10h14V5h-4V1z"/>
						</svg>
						<span class="header-services__text">Сертификация ISO</span>
					</a>
					<a href="#reputation" class="header-services__item">
						<svg class="header-services__icon" width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
							<path d="M8 0l2.5 5 5.5.8-4 3.9.9 5.3L8 12.5 3.1 15l.9-5.3-4-3.9L5.5 5z"/>
						</svg>
						<span class="header-services__text">Опыт и репутация</span>
					</a>
					<a href="#product" class="header-services__item">
						<svg class="header-services__icon" width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
							<path d="M0 2h16v12H0V2zm1 1v10h14V3H1z"/>
						</svg>
						<span class="header-services__text">Сертификация продукции</span>
					</a>
					<a href="#personnel" class="header-services__item">
						<svg class="header-services__icon" width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
							<path d="M8 8a4 4 0 100-8 4 4 0 000 8zm0 2c-4 0-8 2-8 4v2h16v-2c0-2-4-4-8-4z"/>
						</svg>
						<span class="header-services__text">Сертификация персонала</span>
					</a>
					<a href="#voluntary" class="header-services__item">
						<svg class="header-services__icon" width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
							<path d="M2 0h12v16H2V0zm1 1v14h10V1H3zm2 3h6v1H5V4zm0 3h6v1H5V7zm0 3h4v1H5v-1z"/>
						</svg>
						<span class="header-services__text">Добровольная сертификация</span>
					</a>
					<a href="#training" class="header-services__item">
						<svg class="header-services__icon" width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
							<path d="M8 0L0 4l8 4 8-4-8-4zM0 8l8 4 8-4v2l-8 4-8-4V8z"/>
						</svg>
						<span class="header-services__text">Учебный центр</span>
					</a>
				</nav>
			</div>
		</div>
	</header>

	<main id="main" class="site-main">



