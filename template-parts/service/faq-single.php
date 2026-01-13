<?php
/**
 * Секция FAQ для страницы услуги (Custom Post Type)
 *
 * Использует отдельные ACF поля для услуг: gociss_service_faq_*
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$faq_title    = function_exists( 'get_field' ) ? get_field( 'gociss_service_faq_title' ) : '';
$faq_subtitle = function_exists( 'get_field' ) ? get_field( 'gociss_service_faq_subtitle' ) : '';
$faq_items    = function_exists( 'get_field' ) ? get_field( 'gociss_service_faq_items' ) : '';

// Заглушки
if ( ! $faq_title ) {
	$faq_title = 'Часто задаваемые вопросы';
}
if ( ! $faq_subtitle ) {
	$faq_subtitle = 'Ответы на вопросы по данной услуге';
}

// Заглушки вопросов для услуги
$default_faqs = array(
	array(
		'question' => 'Какие документы нужны для получения сертификата?',
		'answer'   => 'Для сертификации необходимы: учредительные документы организации, технические условия или ГОСТ на продукцию, паспорт изделия. Точный перечень зависит от типа сертификации.',
	),
	array(
		'question' => 'Сколько времени занимает процесс сертификации?',
		'answer'   => 'Стандартный срок составляет от 30 до 45 рабочих дней с момента подачи полного пакета документов. При необходимости возможна экспресс-сертификация.',
	),
	array(
		'question' => 'Какова стоимость сертификации?',
		'answer'   => 'Стоимость зависит от типа сертификата, сложности продукции и срочности. Мы предоставляем бесплатную консультацию и расчет стоимости.',
	),
	array(
		'question' => 'Действителен ли сертификат на всей территории России?',
		'answer'   => 'Да, все выдаваемые нами сертификаты имеют полную юридическую силу на всей территории Российской Федерации.',
	),
);

$faqs_to_show = ( $faq_items && is_array( $faq_items ) && count( $faq_items ) > 0 ) ? $faq_items : $default_faqs;

// Если нет вопросов, не показываем секцию
if ( empty( $faqs_to_show ) ) {
	return;
}
?>

<section class="faq" id="faq">
	<div class="container">
		<?php if ( $faq_title ) : ?>
			<h2 class="faq__title"><?php echo esc_html( $faq_title ); ?></h2>
		<?php endif; ?>

		<?php if ( $faq_subtitle ) : ?>
			<p class="faq__subtitle"><?php echo esc_html( $faq_subtitle ); ?></p>
		<?php endif; ?>

		<div class="faq__list">
			<?php
			$index = 0;
			foreach ( $faqs_to_show as $faq_item ) :
				$index++;
				$is_open = ( 1 === $index ) ? 'is-open' : '';
				?>
				<div class="faq__item <?php echo esc_attr( $is_open ); ?>">
					<button class="faq__question" aria-expanded="<?php echo ( 1 === $index ) ? 'true' : 'false'; ?>">
						<span class="faq__question-text"><?php echo esc_html( $faq_item['question'] ); ?></span>
						<span class="faq__icon">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M6 9L12 15L18 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</span>
					</button>
					<div class="faq__answer">
						<div class="faq__answer-inner">
							<?php if ( isset( $faq_item['answer'] ) ) : ?>
								<?php echo wp_kses_post( $faq_item['answer'] ); ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

