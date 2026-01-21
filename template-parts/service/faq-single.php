<?php
/**
 * Секция FAQ для страницы услуги
 * Поддерживает региональные значения
 *
 * Использует 8 индивидуальных полей ACF с fallback на региональные
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Получаем заголовки с учётом региона
$faq_title = function_exists( 'gociss_get_regional_field' )
	? gociss_get_regional_field( 'gociss_region_faq_title', '', 'Часто задаваемые вопросы' )
	: 'Часто задаваемые вопросы';

$faq_subtitle = function_exists( 'gociss_get_regional_field' )
	? gociss_get_regional_field( 'gociss_region_faq_subtitle', '', 'Ответы на вопросы по данной услуге' )
	: 'Ответы на вопросы по данной услуге';

// Получаем текущий регион
$current_region = function_exists( 'gociss_get_current_region' ) ? gociss_get_current_region() : null;

// Собираем FAQ из 8 индивидуальных полей с учётом региона
$faq_items = array();
for ( $i = 1; $i <= 8; $i++ ) {
	$question = '';
	$answer   = '';

	// Сначала проверяем региональные FAQ
	if ( $current_region && function_exists( 'get_field' ) ) {
		$regional_question = get_field( 'gociss_region_faq_' . $i . '_question', 'term_' . $current_region->term_id );
		$regional_answer   = get_field( 'gociss_region_faq_' . $i . '_answer', 'term_' . $current_region->term_id );

		if ( ! empty( $regional_question ) ) {
			$question = $regional_question;
			$answer   = $regional_answer;
		}
	}

	// Fallback на общие FAQ из услуги
	if ( empty( $question ) && function_exists( 'get_field' ) ) {
		$question = get_field( 'gociss_sfaq_' . $i . '_question' );
		$answer   = get_field( 'gociss_sfaq_' . $i . '_answer' );
	}

	// Достаточно вопроса — ответ может быть пустым
	if ( ! empty( $question ) ) {
		$faq_items[] = array(
			'question' => $question,
			'answer'   => ! empty( $answer ) ? $answer : 'Ответ скоро появится.',
		);
	}
}

// Заглушки вопросов для услуги (если ничего не заполнено)
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

// Используем реальные данные или заглушки
$display_items = ! empty( $faq_items ) ? $faq_items : $default_faqs;
?>

<section class="faq" id="faq">
	<div class="container">
		<h2 class="faq__title"><?php echo esc_html( $faq_title ); ?></h2>
		<p class="faq__subtitle"><?php echo esc_html( $faq_subtitle ); ?></p>

		<div class="faq__list">
			<?php
			$index = 0;
			foreach ( $display_items as $faq_item ) :
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
							<p><?php echo wp_kses_post( $faq_item['answer'] ); ?></p>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
