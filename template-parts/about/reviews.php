<?php
/**
 * Секция "Отзывы клиентов" для страницы О компании
 * Переиспользует данные из service/reviews.php (общие отзывы)
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Используем общие ACF поля отзывов (как на странице услуги)
$reviews_title    = function_exists( 'get_field' ) ? get_field( 'gociss_service_reviews_title' ) : '';
$reviews_subtitle = function_exists( 'get_field' ) ? get_field( 'gociss_service_reviews_subtitle' ) : '';

// Собираем отзывы из общих полей (gociss_service_review_*)
$reviews_items = array();
for ( $i = 1; $i <= 6; $i++ ) {
	$review = function_exists( 'get_field' ) ? get_field( 'gociss_service_review_' . $i ) : null;
	if ( $review && ( ! empty( $review['text'] ) || ! empty( $review['author'] ) ) ) {
		$reviews_items[] = $review;
	}
}

// Заглушки для заголовков
if ( ! $reviews_title ) {
	$reviews_title = 'Отзывы клиентов';
}
if ( ! $reviews_subtitle ) {
	$reviews_subtitle = 'Что говорят клиенты о нашей работе';
}

// Дефолтные отзывы если ничего не заполнено
if ( empty( $reviews_items ) ) {
	$reviews_items = array(
		array(
			'company'  => 'ООО "Металлург"',
			'author'   => 'Иванов Сергей Петрович',
			'position' => 'Генеральный директор',
			'text'     => 'Благодарим ГоЦИСС за профессиональную работу по сертификации нашей продукции. Все было выполнено в срок и на высшем уровне качества.',
			'image'    => '',
		),
		array(
			'company'  => 'АО "УралСталь"',
			'author'   => 'Петров Андрей Николаевич',
			'position' => 'Директор по качеству',
			'text'     => 'Сотрудничаем с ГоЦИСС уже более 5 лет. Всегда довольны качеством услуг и оперативностью выполнения заказов. Рекомендуем!',
			'image'    => '',
		),
		array(
			'company'  => 'ЗАО "ТехноПласт"',
			'author'   => 'Сидорова Мария Ивановна',
			'position' => 'Руководитель отдела сертификации',
			'text'     => 'Рекомендую ГоЦИСС всем, кто ищет надежного партнера для сертификации. Профессиональный подход и внимание к деталям.',
			'image'    => '',
		),
	);
}
?>

<section class="service-reviews" id="reviews">
	<div class="container">
		<?php if ( $reviews_title ) : ?>
			<h2 class="service-reviews__title"><?php echo esc_html( $reviews_title ); ?></h2>
		<?php endif; ?>

		<?php if ( $reviews_subtitle ) : ?>
			<p class="service-reviews__subtitle"><?php echo esc_html( $reviews_subtitle ); ?></p>
		<?php endif; ?>

		<div class="service-reviews__slider">
			<button class="service-reviews__nav service-reviews__nav--prev" aria-label="Предыдущий отзыв">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</button>

			<div class="service-reviews__track">
				<div class="service-reviews__grid">
					<?php foreach ( $reviews_items as $review ) : ?>
						<div class="service-reviews__card">
							<!-- Компания -->
							<?php if ( ! empty( $review['company'] ) ) : ?>
								<div class="service-reviews__company"><?php echo esc_html( $review['company'] ); ?></div>
							<?php endif; ?>

							<!-- Автор и должность -->
							<?php if ( ! empty( $review['author'] ) ) : ?>
								<div class="service-reviews__author-name"><?php echo esc_html( $review['author'] ); ?></div>
							<?php endif; ?>
							<?php if ( ! empty( $review['position'] ) ) : ?>
								<div class="service-reviews__author-position"><?php echo esc_html( $review['position'] ); ?></div>
							<?php endif; ?>

							<!-- Текст отзыва -->
							<?php if ( ! empty( $review['text'] ) ) : ?>
								<p class="service-reviews__text"><?php echo esc_html( $review['text'] ); ?></p>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>

			<button class="service-reviews__nav service-reviews__nav--next" aria-label="Следующий отзыв">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</button>
		</div>
	</div>
</section>

