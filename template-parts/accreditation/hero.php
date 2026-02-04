<?php
/**
 * Hero секция страницы "Аккредитация"
 * Фото с белым blur-оверлеем
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ACF поля
$hero_image       = function_exists( 'get_field' ) ? get_field( 'gociss_accred_page_hero_image' ) : '';
$hero_title       = function_exists( 'get_field' ) ? get_field( 'gociss_accred_page_hero_title' ) : '';
$hero_description = function_exists( 'get_field' ) ? get_field( 'gociss_accred_page_hero_subtitle' ) : '';

// Заглушки
if ( ! $hero_title ) {
	$hero_title = 'Информация об аккредитации';
}
if ( ! $hero_description ) {
	$hero_description = 'Официальная государственная аккредитация — гарантия качества и надёжности наших услуг';
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
		<div class="about-hero__content">
			<h1 class="about-hero__title"><?php echo esc_html( $hero_title ); ?></h1>
			<?php if ( $hero_description ) : ?>
				<p class="about-hero__description"><?php echo esc_html( $hero_description ); ?></p>
			<?php endif; ?>
		</div>
	</div>
</section>
