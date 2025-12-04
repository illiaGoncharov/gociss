<?php
/**
 * Форма обратной связи (Contact Form 7)
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$form_label       = function_exists( 'get_field' ) ? get_field( 'gociss_form_label' ) : '';
$form_title       = function_exists( 'get_field' ) ? get_field( 'gociss_form_title' ) : '';
$form_description = function_exists( 'get_field' ) ? get_field( 'gociss_form_description' ) : '';
$form_shortcode   = function_exists( 'get_field' ) ? get_field( 'gociss_form_shortcode' ) : '';

// Заглушки
if ( ! $form_label ) {
	$form_label = 'Связаться с нами';
}
if ( ! $form_title ) {
	$form_title = 'Оставить заявку';
}
if ( ! $form_description ) {
	$form_description = 'Заполните форму, и наш эксперт свяжется с вами в течение 30 минут';
}
if ( ! $form_shortcode ) {
	$form_shortcode = '[contact-form-7 id="274d127" title="Контактная Форма Главная"]';
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
			// Выводим Contact Form 7
			if ( $form_shortcode ) {
				echo do_shortcode( $form_shortcode );
			}
			?>
			</div>
	</div>
</section>


