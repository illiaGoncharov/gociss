<?php
/**
 * Форма 3: "Остались вопросы" (компактная горизонтальная)
 * Цель Метрики: ostalis-voprosy-skvoznaya
 *
 * Использование: get_template_part( 'template-parts/forms/callback-simple' );
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Шорткод из настроек (Внешний вид → Формы) или ACF Options
$callback_shortcode = function_exists( 'gociss_form_option' ) ? gociss_form_option( 'gociss_form_callback_shortcode' ) : get_option( 'gociss_form_callback_shortcode', '' );

// Название услуги для скрытого поля
$service_name = '';
if ( is_singular( 'gociss_service' ) || is_page() ) {
	$service_name = get_the_title();
}
?>

<section class="form-callback-simple" id="callback-simple-section">
	<div class="container">
		<div class="form-callback-simple__wrapper">
			<h3 class="form-callback-simple__title">Остались вопросы? Оставьте номер и мы перезвоним</h3>

			<div class="form-callback-simple__form-wrapper form-callback-simple__form" data-service-name="<?php echo esc_attr( $service_name ); ?>">
				<?php
				if ( $callback_shortcode ) {
					echo do_shortcode( $callback_shortcode );
				} else {
					echo '<p style="color: #6B7280; font-size: 14px;">Укажите шорткод формы в <strong>Внешний вид → Формы → Остались вопросы</strong></p>';
				}
				?>
			</div>
		</div>
	</div>
</section>
