<?php
/**
 * Hero секция страницы "О компании"
 * Фото здания с белым blur-оверлеем + хлебные крошки
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ACF поля
$hero_image       = function_exists( 'get_field' ) ? get_field( 'gociss_about_hero_image' ) : '';
$hero_title       = function_exists( 'get_field' ) ? get_field( 'gociss_about_hero_title' ) : '';
$hero_description = function_exists( 'get_field' ) ? get_field( 'gociss_about_hero_description' ) : '';

// Заглушки
if ( ! $hero_title ) {
	$hero_title = 'О компании';
}
if ( ! $hero_description ) {
	$hero_description = 'Ведущая сертификационная компания с многолетним опытом работы в области подтверждения соответствия и качества продукции';
}

// Фоновое изображение
$bg_style = '';
if ( $hero_image && isset( $hero_image['url'] ) ) {
	$bg_style = 'background-image: url(' . esc_url( $hero_image['url'] ) . ');';
}
?>

<section class="about-hero" <?php echo $bg_style ? 'style="' . esc_attr( $bg_style ) . '"' : ''; ?>>
	<div class="about-hero__overlay"></div>
	<div class="container">
		<!-- Хлебные крошки -->
		<nav class="about-hero__breadcrumbs">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a>
			<span class="about-hero__breadcrumbs-sep">→</span>
			<span class="about-hero__breadcrumbs-current">О компании</span>
		</nav>

		<div class="about-hero__content">
			<h1 class="about-hero__title"><?php echo esc_html( $hero_title ); ?></h1>
			<?php if ( $hero_description ) : ?>
				<p class="about-hero__description"><?php echo esc_html( $hero_description ); ?></p>
			<?php endif; ?>
		</div>
	</div>
</section>

