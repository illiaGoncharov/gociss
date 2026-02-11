<?php
/**
 * Форма 4: "Онлайн заявка" вертикальная (боковая колонка)
 * Цель Метрики: onlayn-zayavka-vertikalnaya
 *
 * Использование: get_template_part( 'template-parts/forms/application-vertical' );
 * С кастомным названием: get_template_part( 'template-parts/forms/application-vertical', null, array( 'service_name' => 'ISO 9001' ) );
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Шорткод из настроек (Внешний вид → Формы) или ACF Options
$vertical_shortcode = function_exists( 'gociss_form_option' ) ? gociss_form_option( 'gociss_form_vertical_shortcode' ) : get_option( 'gociss_form_vertical_shortcode', '' );

// Название услуги — приоритет: параметр → заголовок страницы
$service_name = '';
if ( isset( $args['service_name'] ) && ! empty( $args['service_name'] ) ) {
	$service_name = $args['service_name'];
} elseif ( is_singular( 'gociss_service' ) || is_page() ) {
	$service_name = get_the_title();
}
?>

<div class="form-application-vertical" id="application-vertical-section">
	<div class="form-application-vertical__card">
		<h3 class="form-application-vertical__title">Онлайн заявка</h3>

		<?php if ( $service_name ) : ?>
			<div class="form-application-vertical__service">
				<span class="form-application-vertical__service-name"><?php echo esc_html( $service_name ); ?></span>
			</div>
		<?php endif; ?>

		<div class="form-application-vertical__form-wrapper form-application-vertical__form" data-service-name="<?php echo esc_attr( $service_name ); ?>">
			<?php
			if ( $vertical_shortcode ) {
				echo do_shortcode( $vertical_shortcode );
			} else {
				echo '<p style="color: #6B7280; font-size: 14px;">Укажите шорткод формы в <strong>Внешний вид → Формы → Онлайн заявка вертикальная</strong></p>';
			}
			?>
		</div>
	</div>
</div>
