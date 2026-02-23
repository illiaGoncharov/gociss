<?php
/**
 * Встроенная форма с фото консультанта
 *
 * Переиспользуемый блок: фото слева, форма справа.
 * Фото и имя берутся из глобальных настроек (Внешний вид → Формы).
 *
 * Параметры ($args):
 *   - shortcode (string) — CF7-шорткод формы
 *   - title    (string) — заголовок над формой (опционально)
 *
 * Использование:
 *   get_template_part( 'template-parts/forms/embedded-consult', null, array(
 *       'shortcode' => '[contact-form-7 id="123"]',
 *       'title'     => 'Оставить заявку',
 *   ) );
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$shortcode  = ! empty( $args['shortcode'] ) ? $args['shortcode'] : '';
$title      = ! empty( $args['title'] ) ? $args['title'] : '';
$form_id    = ! empty( $args['form_id'] ) ? (int) $args['form_id'] : 0;
$is_consult = ! empty( $args['is_consult'] );

// Fallback: извлекаем ID из шорткода (для старых значений-строк)
if ( ! $form_id && $shortcode && preg_match( '/id=["\']?(\d+)/', $shortcode, $m ) ) {
	$form_id = (int) $m[1];
}

if ( ! $shortcode ) {
	return;
}

// Если флаг не передан явно — определяем по названию CF7-формы
if ( ! $is_consult && $form_id > 0 ) {
	$form_post = get_post( $form_id );
	if ( $form_post ) {
		$title_lower = mb_strtolower( $form_post->post_title );
		$is_consult  = ( mb_strpos( $title_lower, 'консульт' ) !== false
						|| strpos( $title_lower, 'consult' ) !== false );
	}
}

$consult_photo = '';
$consult_name  = '';

if ( $is_consult ) {
	if ( function_exists( 'gociss_form_option' ) ) {
		$consult_photo = gociss_form_option( 'gociss_form_consult_photo' );
		$consult_name  = gociss_form_option( 'gociss_form_consult_name' );
	}

	if ( ! $consult_photo ) {
		$fallback_path = get_template_directory() . '/assets/images/forms/consultant.jpg';
		if ( file_exists( $fallback_path ) ) {
			$consult_photo = get_template_directory_uri() . '/assets/images/forms/consultant.jpg';
		}
	}
}
if ( ! $consult_name ) {
	$consult_name = 'Специалист-консультант';
}
?>

<div class="embedded-form-consult<?php echo $consult_photo ? '' : ' embedded-form-consult--no-photo'; ?>">
	<?php if ( $consult_photo ) : ?>
	<div class="embedded-form-consult__consultant">
		<div class="embedded-form-consult__photo">
			<img src="<?php echo esc_url( $consult_photo ); ?>" alt="<?php echo esc_attr( $consult_name ); ?>">
		</div>
		<span class="embedded-form-consult__role"><?php echo esc_html( $consult_name ); ?></span>
	</div>
	<?php endif; ?>

	<div class="embedded-form-consult__form">
		<?php if ( $title ) : ?>
			<h3 class="embedded-form-consult__title"><?php echo esc_html( $title ); ?></h3>
		<?php endif; ?>
		<?php echo do_shortcode( $shortcode ); ?>
	</div>
</div>
