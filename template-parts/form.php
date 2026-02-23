<?php
/**
 * Форма обратной связи — диспетчер вариантов
 *
 * Приоритет:
 * 1. Шорткод (gociss_form_shortcode) — если заполнен, рендерим его напрямую
 * 2. Вариант формы (gociss_form_variant) — ID формы CF7, дизайн по названию
 * 3. Основная форма из настроек темы (fallback)
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// === Приоритет 1: пользовательский шорткод ===
$form_shortcode = function_exists( 'get_field' ) ? get_field( 'gociss_form_shortcode' ) : '';

if ( $form_shortcode ) {
	echo do_shortcode( $form_shortcode );
	return;
}

// === Приоритет 2: выбор формы из списка CF7 ===
$form_variant_raw = function_exists( 'get_field' ) ? get_field( 'gociss_form_variant' ) : '';

$legacy_keys = array( 'consult', 'callback', 'vertical', 'horizontal' );

if ( in_array( $form_variant_raw, $legacy_keys, true ) ) {
	$design       = $form_variant_raw;
	$cf7_shortcode = '';
} elseif ( $form_variant_raw && is_numeric( $form_variant_raw ) ) {
	$design        = function_exists( 'gociss_detect_form_design' )
		? gociss_detect_form_design( (int) $form_variant_raw )
		: 'default';
	$cf7_shortcode = function_exists( 'gociss_get_cf7_shortcode' )
		? gociss_get_cf7_shortcode( $form_variant_raw )
		: '';
} else {
	$design        = 'default';
	$cf7_shortcode = '';
}

$template_args = array( 'cf7_shortcode' => $cf7_shortcode );

switch ( $design ) {
	case 'consult':
		get_template_part( 'template-parts/forms/consult', null, $template_args );
		return;

	case 'callback':
		get_template_part( 'template-parts/forms/callback-simple', null, $template_args );
		return;

	case 'vertical':
		get_template_part( 'template-parts/forms/application-vertical', null, $template_args );
		return;

	case 'horizontal':
		get_template_part( 'template-parts/forms/application-horizontal', null, $template_args );
		return;
}

// === Приоритет 3: основная форма (дизайн «По умолчанию») ===

$form_label       = function_exists( 'get_field' ) ? get_field( 'gociss_form_label' ) : '';
$form_title       = function_exists( 'get_field' ) ? get_field( 'gociss_form_title' ) : '';
$form_description = function_exists( 'get_field' ) ? get_field( 'gociss_form_description' ) : '';

$default_shortcode = $cf7_shortcode;

if ( ! $default_shortcode ) {
	$default_shortcode = function_exists( 'gociss_form_option' ) ? gociss_form_option( 'gociss_form_default_shortcode' ) : get_option( 'gociss_form_default_shortcode', '' );
}
if ( ! $default_shortcode ) {
	$default_shortcode = function_exists( 'gociss_form_option' ) ? gociss_form_option( 'gociss_form_consult_shortcode' ) : get_option( 'gociss_form_consult_shortcode', '' );
}

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
			if ( $default_shortcode ) {
				echo do_shortcode( $default_shortcode );
			}
			?>
		</div>
	</div>
</section>
