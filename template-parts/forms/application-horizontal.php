<?php
/**
 * Форма 5: "Онлайн заявка" горизонтальная
 * Цель Метрики: onlayn-zayavka-gorizontalnaya
 *
 * Использование: get_template_part( 'template-parts/forms/application-horizontal' );
 * С кастомным названием: get_template_part( 'template-parts/forms/application-horizontal', null, array( 'service_name' => 'ISO 9001' ) );
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Override из диспетчера (form.php передаёт cf7_shortcode выбранной формы)
$horizontal_shortcode = ! empty( $args['cf7_shortcode'] ) ? $args['cf7_shortcode'] : '';

// Fallback: настройки (Внешний вид → Формы)
if ( ! $horizontal_shortcode ) {
	$horizontal_shortcode = function_exists( 'gociss_form_option' ) ? gociss_form_option( 'gociss_form_horizontal_shortcode' ) : get_option( 'gociss_form_horizontal_shortcode', '' );
}

// Название услуги — приоритет: параметр → заголовок страницы
$service_name = '';
if ( isset( $args['service_name'] ) && ! empty( $args['service_name'] ) ) {
	$service_name = $args['service_name'];
} elseif ( is_singular( 'gociss_service' ) || is_page() ) {
	$service_name = get_the_title();
}
?>

<section class="form-application-horizontal" id="application-horizontal-section">
	<div class="container">
		<div class="form-application-horizontal__wrapper">
			<h3 class="form-application-horizontal__title">Онлайн заявка</h3>

			<div class="form-application-horizontal__form-wrapper form-application-horizontal__form" data-service-name="<?php echo esc_attr( $service_name ); ?>">
				<?php
				if ( $horizontal_shortcode ) {
					echo do_shortcode( $horizontal_shortcode );
				} else {
					echo '<p style="color: rgba(255,255,255,0.8); font-size: 14px;">Укажите шорткод формы в <strong>Внешний вид → Формы → Онлайн заявка горизонтальная</strong></p>';
				}
				?>
			</div>
		</div>
	</div>
</section>
