<?php
/**
 * Секция FAQ (универсальная)
 *
 * Читает вопросы из Relationship-поля gociss_faq_items (записи CPT FAQ).
 * Если поле пусто — показывает заглушки.
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$faq_title    = function_exists( 'get_field' ) ? get_field( 'gociss_faq_title' ) : '';
$faq_subtitle = function_exists( 'get_field' ) ? get_field( 'gociss_faq_subtitle' ) : '';

if ( ! $faq_title ) {
	$faq_title = 'Часто задаваемые вопросы';
}
if ( ! $faq_subtitle ) {
	$faq_subtitle = 'Ответы на самые популярные вопросы о сертификации';
}

// Читаем выбранные FAQ из Relationship-поля
$faqs          = array();
$faq_relations = function_exists( 'get_field' ) ? get_field( 'gociss_faq_items' ) : null;

if ( ! empty( $faq_relations ) && is_array( $faq_relations ) ) {
	foreach ( $faq_relations as $faq_post ) {
		if ( is_object( $faq_post ) && ! empty( $faq_post->post_title ) ) {
			$faqs[] = array(
				'question' => $faq_post->post_title,
				'answer'   => apply_filters( 'the_content', $faq_post->post_content ),
			);
		}
	}
}

// Заглушки, если нет данных
$default_faqs = array(
	array(
		'question' => 'Сколько времени занимает получение сертификата ISO 9001?',
		'answer'   => 'Стандартный срок получения сертификата ISO 9001 составляет от 30 до 45 рабочих дней с момента подачи полного пакета документов. Этот срок включает проведение документарного аудита, аудита на месте и оформление сертификата. При необходимости мы можем организовать экспресс-сертификацию за 15-20 дней.',
	),
	array(
		'question' => 'Какие документы необходимы для сертификации продукции?',
		'answer'   => 'Для сертификации продукции необходимы: учредительные документы организации, технические условия или ГОСТ на продукцию, паспорт изделия, руководство по эксплуатации, протоколы испытаний (при наличии). Точный перечень зависит от типа продукции и применяемого технического регламента.',
	),
	array(
		'question' => 'Сколько стоит сертификация и от чего зависит цена?',
		'answer'   => 'Стоимость сертификации зависит от типа сертификата, сложности системы менеджмента, размера организации и срочности. Мы предоставляем бесплатную предварительную консультацию и расчет стоимости.',
	),
	array(
		'question' => 'Действительны ли ваши сертификаты на всей территории России?',
		'answer'   => 'Да, все выдаваемые нами сертификаты имеют полную юридическую силу на всей территории Российской Федерации и признаются всеми государственными органами и коммерческими организациями.',
	),
	array(
		'question' => 'Можно ли продлить действие сертификата?',
		'answer'   => 'Да, мы осуществляем продление (ресертификацию) сертификатов. Рекомендуем обращаться за продлением за 2-3 месяца до истечения срока действия текущего сертификата.',
	),
	array(
		'question' => 'Что делать, если продукция не прошла сертификацию?',
		'answer'   => 'Если продукция не соответствует требованиям, наши эксперты помогут выявить причины несоответствия и разработать план корректирующих мероприятий для успешного прохождения повторной сертификации.',
	),
);

$faqs_to_show = ! empty( $faqs ) ? $faqs : $default_faqs;
?>

<section class="faq" id="faq">
	<div class="container">
		<h2 class="faq__title"><?php echo esc_html( $faq_title ); ?></h2>
		<p class="faq__subtitle"><?php echo esc_html( $faq_subtitle ); ?></p>

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
							<?php echo wp_kses_post( $faq_item['answer'] ); ?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
