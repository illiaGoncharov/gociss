<?php
/**
 * Секция примера сертификата с расшифровкой пунктов
 * Отображает изображение сертификата с нумерованными метками и их описание
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Получаем данные из ACF
$cert_title       = function_exists( 'get_field' ) ? get_field( 'gociss_service_cert_title' ) : '';
$cert_description = function_exists( 'get_field' ) ? get_field( 'gociss_service_cert_description' ) : '';
$cert_btn_text    = function_exists( 'get_field' ) ? get_field( 'gociss_service_cert_btn_text' ) : '';
$cert_image          = function_exists( 'get_field' ) ? get_field( 'gociss_service_cert_image' ) : null;
$cert_form_raw       = function_exists( 'get_field' ) ? get_field( 'gociss_service_cert_form_shortcode' ) : '';
$cert_form_shortcode = function_exists( 'gociss_get_cf7_shortcode' ) ? gociss_get_cf7_shortcode( $cert_form_raw ) : $cert_form_raw;

// Собираем пункты расшифровки
$cert_points = array();
for ( $i = 1; $i <= 4; $i++ ) {
	$point = function_exists( 'get_field' ) ? get_field( 'gociss_service_cert_point_' . $i ) : null;
	if ( $point && ! empty( $point['title'] ) ) {
		$cert_points[] = $point;
	}
}

// Если нет ни описания, ни изображения, ни пунктов, ни формы — не показываем секцию
if ( empty( $cert_description ) && empty( $cert_image ) && empty( $cert_points ) && empty( $cert_form_shortcode ) ) {
	return;
}

// Заголовок по умолчанию — название услуги
if ( ! $cert_title ) {
	$cert_title = get_the_title();
}

// Текст кнопки по умолчанию
if ( ! $cert_btn_text ) {
	$cert_btn_text = 'Бесплатная консультация';
}
?>

<section class="service-cert-example" id="certificate-example">
	<div class="container">
		<div class="service-cert-example__content">
			<!-- Левая колонка: текст -->
			<div class="service-cert-example__text">
				<h2 class="service-cert-example__title"><?php echo wp_kses_post( $cert_title ); ?></h2>

				<?php if ( $cert_description ) : ?>
					<div class="service-cert-example__description">
						<?php echo wp_kses_post( $cert_description ); ?>
					</div>
				<?php endif; ?>

				<a href="#form" class="service-cert-example__btn">
					<?php echo esc_html( $cert_btn_text ); ?>
				</a>
			</div>

			<!-- Правая колонка: изображение сертификата -->
			<?php if ( $cert_image && ! empty( $cert_image['url'] ) ) : ?>
				<div class="service-cert-example__image">
					<img
						src="<?php echo esc_url( $cert_image['url'] ); ?>"
						alt="<?php echo esc_attr( $cert_image['alt'] ?? $cert_title ); ?>"
						class="service-cert-example__cert-img"
					>
				</div>
			<?php endif; ?>
		</div>

		<!-- Блоки с расшифровкой пунктов -->
		<?php if ( ! empty( $cert_points ) ) : ?>
			<div class="service-cert-example__points">
				<?php foreach ( $cert_points as $index => $point ) : ?>
					<div class="service-cert-example__point">
						<span class="service-cert-example__point-number"><?php echo esc_html( $index + 1 ); ?></span>
						<div class="service-cert-example__point-content">
							<h3 class="service-cert-example__point-title"><?php echo esc_html( $point['title'] ); ?></h3>
							<?php if ( ! empty( $point['description'] ) ) : ?>
								<p class="service-cert-example__point-desc"><?php echo esc_html( $point['description'] ); ?></p>
							<?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<?php if ( ! empty( $cert_form_shortcode ) ) : ?>
			<?php
			$cert_form_title = function_exists( 'get_field' ) ? get_field( 'gociss_service_cert_form_title' ) : '';
			if ( ! $cert_form_title ) {
				$cert_form_title = 'Оставить заявку';
			}
			?>
			<div class="service-cert-example__form">
				<?php
				get_template_part( 'template-parts/forms/embedded-consult', null, array(
					'shortcode' => $cert_form_shortcode,
					'title'     => $cert_form_title,
					'form_id'   => $cert_form_raw,
				) );
				?>
			</div>
		<?php endif; ?>
	</div>
</section>



