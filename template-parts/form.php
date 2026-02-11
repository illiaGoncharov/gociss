<?php
/**
 * Форма обратной связи — диспетчер вариантов
 *
 * Логика:
 * 1. Проверяем ACF-поле gociss_form_variant на странице
 * 2. Если variant != 'default' — рендерим кастомный шаблон
 * 3. Если 'default' или пусто — рендерим основную форму .contact-form
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Определяем вариант формы из ACF (или default)
$form_variant = function_exists( 'get_field' ) ? get_field( 'gociss_form_variant' ) : '';
if ( ! $form_variant ) {
	$form_variant = 'default';
}

// Кастомные варианты — рендерим соответствующий шаблон и выходим
switch ( $form_variant ) {
	case 'consult':
		get_template_part( 'template-parts/forms/consult' );
		return;

	case 'callback':
		get_template_part( 'template-parts/forms/callback-simple' );
		return;

	case 'vertical':
		get_template_part( 'template-parts/forms/application-vertical' );
		return;

	case 'horizontal':
		get_template_part( 'template-parts/forms/application-horizontal' );
		return;
}

// === Вариант «По умолчанию» — основная форма .contact-form ===

// Данные из ACF страницы (менеджер может переопределить)
$form_label       = function_exists( 'get_field' ) ? get_field( 'gociss_form_label' ) : '';
$form_title       = function_exists( 'get_field' ) ? get_field( 'gociss_form_title' ) : '';
$form_description = function_exists( 'get_field' ) ? get_field( 'gociss_form_description' ) : '';
$form_shortcode   = function_exists( 'get_field' ) ? get_field( 'gociss_form_shortcode' ) : '';

// Fallback: настройки темы → старый ключ → хардкод формы «Главная»
if ( ! $form_shortcode ) {
	$form_shortcode = function_exists( 'gociss_form_option' ) ? gociss_form_option( 'gociss_form_default_shortcode' ) : get_option( 'gociss_form_default_shortcode', '' );
}
if ( ! $form_shortcode ) {
	// Совместимость: старый ключ из предыдущей версии настроек
	$form_shortcode = function_exists( 'gociss_form_option' ) ? gociss_form_option( 'gociss_form_consult_shortcode' ) : get_option( 'gociss_form_consult_shortcode', '' );
}

// Заглушки текстов
if ( ! $form_label ) {
	$form_label = 'Связаться с нами';
}
if ( ! $form_title ) {
	$form_title = 'Оставить заявку';
}
if ( ! $form_description ) {
	$form_description = 'Заполните форму, и наш эксперт свяжется с вами в течение 30 минут';
}
?>

<section class="contact-form" id="form">
	<div class="container">
		<div class="contact-form__header">
			<?php if ( $form_label ) : ?>
				<span class="contact-form__label"><?php echo esc_html( $form_label ); ?></span>
			<?php endif; ?>

			<?php if ( $form_title ) : ?>
				<h2 class="contact-form__title"><?php echo esc_html( $form_title ); ?></h2>
			<?php endif; ?>

			<?php if ( $form_description ) : ?>
				<p class="contact-form__description"><?php echo esc_html( $form_description ); ?></p>
			<?php endif; ?>
		</div>

		<div class="contact-form__wrapper">
			<?php
			if ( $form_shortcode ) {
				echo do_shortcode( $form_shortcode );
			}
			?>
		</div>
	</div>
</section>
