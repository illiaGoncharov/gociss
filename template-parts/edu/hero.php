<?php
/**
 * Hero секция для страницы Учебного центра
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Получаем данные из ACF
$hero_title    = function_exists( 'get_field' ) ? get_field( 'gociss_edu_hero_title' ) : '';
$hero_subtitle = function_exists( 'get_field' ) ? get_field( 'gociss_edu_hero_subtitle' ) : '';
$hero_image    = function_exists( 'get_field' ) ? get_field( 'gociss_edu_hero_image' ) : '';
$btn_text      = function_exists( 'get_field' ) ? get_field( 'gociss_edu_hero_btn_text' ) : '';

// Буллеты
$bullets = array();
for ( $i = 1; $i <= 3; $i++ ) {
	$bullet = function_exists( 'get_field' ) ? get_field( 'gociss_edu_hero_bullet_' . $i ) : '';
	if ( ! empty( $bullet ) ) {
		$bullets[] = $bullet;
	}
}

// Значения по умолчанию
if ( empty( $hero_title ) ) {
	$hero_title = 'Учебный центр';
}
if ( empty( $hero_subtitle ) ) {
	$hero_subtitle = 'Дополнительное профессиональное образование в области управления качеством';
}
if ( empty( $btn_text ) ) {
	$btn_text = 'Выбрать курс';
}
if ( empty( $bullets ) ) {
	$bullets = array(
		'Аккредитованные эксперты',
		'Лицензированные программы',
		'Лицензия Л035-01271-78/01059514',
	);
}

// Фоновое изображение
$bg_style = '';
if ( $hero_image && isset( $hero_image['url'] ) ) {
	$bg_style = 'background-image: url(' . esc_url( $hero_image['url'] ) . ');';
}
?>

<section class="edu-hero" <?php echo $bg_style ? 'style="' . esc_attr( $bg_style ) . '"' : ''; ?>>
	<div class="edu-hero__overlay"></div>
	<div class="container">
		<div class="edu-hero__content">
			<h1 class="edu-hero__title"><?php echo esc_html( $hero_title ); ?></h1>
			<?php if ( $hero_subtitle ) : ?>
				<p class="edu-hero__subtitle"><?php echo esc_html( $hero_subtitle ); ?></p>
			<?php endif; ?>

			<?php if ( ! empty( $bullets ) ) : ?>
				<ul class="edu-hero__bullets">
					<?php foreach ( $bullets as $bullet ) : ?>
						<li class="edu-hero__bullet">
							<span class="edu-hero__bullet-dot"></span>
							<?php echo esc_html( $bullet ); ?>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>

			<div class="edu-hero__actions">
				<a href="#courses" class="btn btn--primary"><?php echo esc_html( $btn_text ); ?></a>
			</div>
		</div>
	</div>
</section>
