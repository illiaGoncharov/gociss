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
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Перейти к содержимому', 'gociss' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="header-top">
			<div class="container">
				<div class="header-top__content">
					<div class="header-top__logo">
						<?php if ( has_custom_logo() ) : ?>
							<?php the_custom_logo(); ?>
						<?php else : ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo">
								<span class="site-logo__text">ГоЦИСС</span>
								<span class="site-logo__tagline">Головной центр испытаний, сертификации и стандартизации</span>
							</a>
						<?php endif; ?>
					</div>

					<div class="header-top__location">
						<span class="location-icon"></span>
						<span class="location-text">Санкт-Петербург</span>
						<span class="location-note">Работаем по всей России</span>
					</div>

					<nav class="header-top__nav">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'primary',
								'menu_id'        => 'primary-menu',
								'container'      => false,
							)
						);
						?>
					</nav>

					<div class="header-top__contacts">
						<a href="tel:+78005510236" class="header-top__phone">+7 (800) 551-02-36</a>
						<button class="header-top__search" aria-label="<?php esc_attr_e( 'Поиск', 'gociss' ); ?>"></button>
						<a href="mailto:info@gociss.ru" class="header-top__email" aria-label="<?php esc_attr_e( 'Email', 'gociss' ); ?>"></a>
						<a href="#callback" class="btn btn--primary">Заказать звонок</a>
					</div>
				</div>
			</div>
		</div>

		<div class="header-services">
			<div class="container">
				<nav class="header-services__nav">
					<a href="#services" class="header-services__item">
						<span class="header-services__icon">☰</span>
						<span class="header-services__text">Все услуги</span>
					</a>
					<a href="#iso" class="header-services__item">
						<span class="header-services__icon">📄</span>
						<span class="header-services__text">Сертификация ISO</span>
					</a>
					<a href="#reputation" class="header-services__item">
						<span class="header-services__icon">⭐</span>
						<span class="header-services__text">Опыт и репутация</span>
					</a>
					<a href="#product" class="header-services__item">
						<span class="header-services__icon">📦</span>
						<span class="header-services__text">Сертификация продукции</span>
					</a>
					<a href="#personnel" class="header-services__item">
						<span class="header-services__icon">👤</span>
						<span class="header-services__text">Сертификация персонала</span>
					</a>
					<a href="#voluntary" class="header-services__item">
						<span class="header-services__icon">📋</span>
						<span class="header-services__text">Добровольная сертификация</span>
					</a>
					<a href="#training" class="header-services__item">
						<span class="header-services__icon">🎓</span>
						<span class="header-services__text">Учебный центр</span>
					</a>
				</nav>
			</div>
		</div>
	</header>

	<main id="main" class="site-main">



