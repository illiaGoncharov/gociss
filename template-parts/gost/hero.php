<?php
/**
 * Hero секция для страницы ГОСТов
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Получаем данные из ACF
$hero_title    = function_exists( 'get_field' ) ? get_field( 'gociss_gost_hero_title' ) : '';
$hero_subtitle = function_exists( 'get_field' ) ? get_field( 'gociss_gost_hero_subtitle' ) : '';
$hero_image    = function_exists( 'get_field' ) ? get_field( 'gociss_gost_hero_image' ) : '';

// Значения по умолчанию
if ( empty( $hero_title ) ) {
	$hero_title = 'Нормативная база ГОСТов';
}
if ( empty( $hero_subtitle ) ) {
	$hero_subtitle = 'Полная база государственных стандартов качества для обеспечения соответствия продукции и услуг требованиям безопасности и качества';
}

// Фоновое изображение
$bg_style = '';
if ( $hero_image && isset( $hero_image['url'] ) ) {
	$bg_style = 'background-image: url(' . esc_url( $hero_image['url'] ) . ');';
}
?>

<section class="gost-hero" <?php echo $bg_style ? 'style="' . esc_attr( $bg_style ) . '"' : ''; ?>>
	<div class="gost-hero__overlay"></div>
	<div class="container">
		<div class="gost-hero__content">
			<h1 class="gost-hero__title"><?php echo esc_html( $hero_title ); ?></h1>
			<?php if ( $hero_subtitle ) : ?>
				<p class="gost-hero__subtitle"><?php echo esc_html( $hero_subtitle ); ?></p>
			<?php endif; ?>
		</div>
	</div>
</section>


