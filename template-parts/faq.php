<?php
/**
 * Секция FAQ
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$faq_title    = function_exists( 'get_field' ) ? get_field( 'gociss_faq_title' ) : '';
$faq_subtitle = function_exists( 'get_field' ) ? get_field( 'gociss_faq_subtitle' ) : '';
$faq_items    = function_exists( 'get_field' ) ? get_field( 'gociss_faq_items' ) : '';

// Заглушки
if ( ! $faq_title ) {
	$faq_title = 'Часто задаваемые вопросы';
}
if ( ! $faq_subtitle ) {
	$faq_subtitle = 'Ответы на самые популярные вопросы о сертификации';
}
?>

<section class="faq">
	<div class="container">
		<?php if ( $faq_title ) : ?>
			<h2 class="faq__title"><?php echo esc_html( $faq_title ); ?></h2>
		<?php endif; ?>

		<?php if ( $faq_subtitle ) : ?>
			<p class="faq__subtitle"><?php echo esc_html( $faq_subtitle ); ?></p>
		<?php endif; ?>

		<div class="faq__list">
			<?php if ( $faq_items && is_array( $faq_items ) && count( $faq_items ) > 0 ) : ?>
				<?php
				$index = 0;
				foreach ( $faq_items as $faq_item ) :
				$index++;
				$is_open = ( 1 === $index ) ? 'is-open' : '';
				?>
				<div class="faq__item <?php echo esc_attr( $is_open ); ?>">
					<button class="faq__question" aria-expanded="<?php echo ( 1 === $index ) ? 'true' : 'false'; ?>">
						<span class="faq__question-text"><?php echo esc_html( $faq_item['question'] ); ?></span>
						<span class="faq__icon">▼</span>
					</button>
					<div class="faq__answer">
						<?php echo wp_kses_post( $faq_item['answer'] ); ?>
					</div>
				</div>
				<?php endforeach; ?>
			<?php else : ?>
				<!-- Заглушки FAQ -->
				<div class="faq__item is-open">
					<button class="faq__question" aria-expanded="true">
						<span class="faq__question-text">Сколько времени занимает получение сертификата ISO 9001?</span>
						<span class="faq__icon">▼</span>
					</button>
					<div class="faq__answer">
						<p>Стандартный срок получения сертификата ISO 9001 составляет от 30 до 45 рабочих дней с момента подачи полного пакета документов.</p>
					</div>
				</div>
				<div class="faq__item">
					<button class="faq__question" aria-expanded="false">
						<span class="faq__question-text">Какие документы необходимы для сертификации продукции?</span>
						<span class="faq__icon">▼</span>
					</button>
					<div class="faq__answer">
						<p>Для сертификации продукции необходимы техническая документация, протоколы испытаний и другие документы в зависимости от типа продукции.</p>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>



