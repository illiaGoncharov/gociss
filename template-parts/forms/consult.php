<?php
/**
 * Форма 2: "Готовы проконсультировать" (сквозная коммерческая)
 * Цель Метрики: est-voprosy-skvoznaya
 *
 * Использование: get_template_part( 'template-parts/forms/consult' );
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Данные из настроек (Внешний вид → Формы) или ACF Options
$consult_shortcode = function_exists( 'gociss_form_option' ) ? gociss_form_option( 'gociss_form_consult_shortcode' ) : get_option( 'gociss_form_consult_shortcode', '' );
$consult_photo     = function_exists( 'gociss_form_option' ) ? gociss_form_option( 'gociss_form_consult_photo' ) : get_option( 'gociss_form_consult_photo', '' );
$consult_name      = function_exists( 'gociss_form_option' ) ? gociss_form_option( 'gociss_form_consult_name' ) : get_option( 'gociss_form_consult_name', '' );

// Fallback имени
if ( ! $consult_name ) {
	$consult_name = 'Специалист-консультант';
}

// Проверяем наличие фото: если указан URL — показываем, если нет — скрываем блок консультанта
$show_consultant = false;
if ( $consult_photo ) {
	$show_consultant = true;
} else {
	// Проверяем наличие fallback-файла в теме
	$fallback_path = get_template_directory() . '/assets/images/forms/consultant.jpg';
	if ( file_exists( $fallback_path ) ) {
		$consult_photo   = get_template_directory_uri() . '/assets/images/forms/consultant.jpg';
		$show_consultant = true;
	}
}

// Название услуги для скрытого поля
$service_name = '';
if ( is_singular( 'gociss_service' ) || is_page() ) {
	$service_name = get_the_title();
}
?>

<section class="form-consult" id="consult-form-section">
	<div class="container">
		<div class="form-consult__wrapper<?php echo $show_consultant ? '' : ' form-consult__wrapper--no-photo'; ?>">
			<?php if ( $show_consultant ) : ?>
			<div class="form-consult__consultant">
				<div class="form-consult__photo">
					<img src="<?php echo esc_url( $consult_photo ); ?>" alt="<?php echo esc_attr( $consult_name ); ?>">
				</div>
				<span class="form-consult__role"><?php echo esc_html( $consult_name ); ?></span>
			</div>
			<?php endif; ?>

			<div class="form-consult__content">
				<h3 class="form-consult__title">Есть вопросы? Готовы проконсультировать</h3>

				<div class="form-consult__form-wrapper form-consult__form" data-service-name="<?php echo esc_attr( $service_name ); ?>">
					<?php
					if ( $consult_shortcode ) {
						echo do_shortcode( $consult_shortcode );
					} else {
						echo '<p style="color: #6B7280; font-size: 14px;">Укажите шорткод формы в <strong>Внешний вид → Формы → Готовы проконсультировать</strong></p>';
					}
					?>
				</div>
			</div>
		</div>
	</div>
</section>
