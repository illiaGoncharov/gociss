<?php
/**
 * Hero секция для страницы Вакансий
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Получаем данные из ACF
$hero_title       = function_exists( 'get_field' ) ? get_field( 'gociss_vacancies_hero_title' ) : '';
$hero_description = function_exists( 'get_field' ) ? get_field( 'gociss_vacancies_hero_description' ) : '';
$hero_phone       = function_exists( 'get_field' ) ? get_field( 'gociss_vacancies_hero_phone' ) : '';
$hero_image       = function_exists( 'get_field' ) ? get_field( 'gociss_vacancies_hero_image' ) : '';

// Значения по умолчанию
if ( empty( $hero_title ) ) {
	$hero_title = 'Вакансии';
}
if ( empty( $hero_description ) ) {
	$hero_description = 'По вопросам трудоустройства обращаться:';
}
if ( empty( $hero_phone ) ) {
	$hero_phone = 'Отдел кадров 388-69-03';
}

// Фоновое изображение
$bg_style = '';
if ( $hero_image && isset( $hero_image['url'] ) ) {
	$bg_style = 'background-image: url(' . esc_url( $hero_image['url'] ) . ');';
}
?>

<section class="vacancies-hero" <?php echo $bg_style ? 'style="' . esc_attr( $bg_style ) . '"' : ''; ?>>
	<div class="vacancies-hero__overlay"></div>
	<div class="container">
		<div class="vacancies-hero__content">
			<h1 class="vacancies-hero__title"><?php echo esc_html( $hero_title ); ?></h1>
			<?php if ( $hero_description ) : ?>
				<p class="vacancies-hero__description"><?php echo esc_html( $hero_description ); ?></p>
			<?php endif; ?>
			<?php if ( $hero_phone ) : ?>
				<p class="vacancies-hero__phone"><?php echo esc_html( $hero_phone ); ?></p>
			<?php endif; ?>
		</div>
	</div>
</section>


