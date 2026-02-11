<?php
/**
 * Форма 1: Попап "Есть вопросы" (шапка/подвал)
 * Цель Метрики: est-voprosy-knopka-v-shapke-podvale
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Шорткод и картинка из настроек (Внешний вид → Формы) или ACF Options
$popup_shortcode = function_exists( 'gociss_form_option' ) ? gociss_form_option( 'gociss_form_popup_shortcode' ) : get_option( 'gociss_form_popup_shortcode', '' );
$popup_image     = function_exists( 'gociss_form_option' ) ? gociss_form_option( 'gociss_form_popup_image' ) : get_option( 'gociss_form_popup_image', '' );

// Проверяем, реально ли существует картинка (если это URL из настроек — показываем)
$show_image = false;
if ( $popup_image ) {
	$show_image = true;
}
?>

<div class="form-popup" id="callbackPopup" aria-hidden="true">
	<div class="form-popup__overlay"></div>
	<div class="form-popup__container">
		<button type="button" class="form-popup__close" aria-label="<?php esc_attr_e( 'Закрыть', 'gociss' ); ?>">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>
		</button>

		<div class="form-popup__content">
			<div class="form-popup__info">
				<h3 class="form-popup__title">ЕСТЬ ВОПРОСЫ?</h3>
				<p class="form-popup__subtitle">Готовы проконсультировать!</p>

				<div class="form-popup__form-wrapper form-popup__form">
					<?php
					if ( $popup_shortcode ) {
						echo do_shortcode( $popup_shortcode );
					} else {
						echo '<p style="color: rgba(255,255,255,0.7); font-size: 14px;">Укажите шорткод формы в <strong>Внешний вид → Формы → Попап</strong></p>';
					}
					?>
				</div>
			</div>

			<?php if ( $show_image ) : ?>
			<div class="form-popup__image">
				<img src="<?php echo esc_url( $popup_image ); ?>" alt="<?php esc_attr_e( 'Консультант', 'gociss' ); ?>">
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>
