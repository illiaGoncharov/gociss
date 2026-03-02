<?php
/**
 * Секция отзывов клиентов
 * Данные берутся из CPT gociss_review через WP_Query
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Получаем отзывы из CPT, сортируем по menu_order, затем по дате
$reviews_query = new WP_Query(
	array(
		'post_type'      => 'gociss_review',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'orderby'        => array(
			'menu_order' => 'ASC',
			'date'       => 'DESC',
		),
	)
);

$reviews_items = array();

if ( $reviews_query->have_posts() && function_exists( 'get_field' ) ) {
	while ( $reviews_query->have_posts() ) {
		$reviews_query->the_post();

		$reviews_items[] = array(
			'company'  => get_field( 'gociss_review_company' ),
			'author'   => get_field( 'gociss_review_author' ),
			'position' => get_field( 'gociss_review_position' ),
			'text'     => get_field( 'gociss_review_text' ),
			'rating'   => get_field( 'gociss_review_rating' ),
			'image'    => get_field( 'gociss_review_image' ),
		);
	}
	wp_reset_postdata();
}

// Fallback — дефолтные отзывы если CPT пустой
if ( empty( $reviews_items ) ) {
	$reviews_items = array(
		array(
			'company'  => 'ООО "Технопром"',
			'author'   => 'Иванов И.И.',
			'position' => 'Генеральный директор',
			'text'     => 'Благодарим ГоЦИСС за профессиональную работу по сертификации нашей системы менеджмента. Все было выполнено в срок и на высшем уровне.',
			'rating'   => 5,
			'image'    => '',
		),
		array(
			'company'  => 'АО "СтройГарант"',
			'author'   => 'Петров П.П.',
			'position' => 'Директор по качеству',
			'text'     => 'Сотрудничаем с ГоЦИСС уже 5 лет. Всегда довольны качеством услуг и оперативностью выполнения заказов.',
			'rating'   => 5,
			'image'    => '',
		),
		array(
			'company'  => 'ООО "ПищеПром"',
			'author'   => 'Сидорова А.В.',
			'position' => 'Руководитель отдела сертификации',
			'text'     => 'Рекомендую ГоЦИСС всем, кто ищет надежного партнера для сертификации. Профессиональный подход и внимание к деталям.',
			'rating'   => 5,
			'image'    => '',
		),
	);
}
?>

<section class="service-reviews" id="reviews">
	<div class="container">
		<h2 class="service-reviews__title">Отзывы клиентов</h2>
		<p class="service-reviews__subtitle">Что говорят наши клиенты о нашей работе</p>

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
							<?php if ( ! empty( $review['rating'] ) ) : ?>
								<div class="service-reviews__rating">
									<?php for ( $i = 1; $i <= 5; $i++ ) : ?>
										<svg width="20" height="20" viewBox="0 0 20 20" fill="<?php echo $i <= intval( $review['rating'] ) ? '#F59E0B' : '#E5E7EB'; ?>" xmlns="http://www.w3.org/2000/svg">
											<path d="M10 1L12.39 6.26L18 7.27L14 11.14L14.76 17L10 14.27L5.24 17L6 11.14L2 7.27L7.61 6.26L10 1Z"/>
										</svg>
									<?php endfor; ?>
								</div>
							<?php endif; ?>

							<?php if ( ! empty( $review['text'] ) ) : ?>
								<p class="service-reviews__text"><?php echo esc_html( $review['text'] ); ?></p>
							<?php endif; ?>

							<div class="service-reviews__author">
								<?php if ( ! empty( $review['image'] ) && ! empty( $review['image']['ID'] ) ) : ?>
									<div class="service-reviews__author-photo">
										<?php
										echo wp_get_attachment_image(
											$review['image']['ID'],
											'thumbnail',
											false,
											array( 'alt' => esc_attr( $review['author'] ?? '' ) )
										);
										?>
									</div>
								<?php else : ?>
									<div class="service-reviews__author-photo service-reviews__author-photo--placeholder">
										<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>
									</div>
								<?php endif; ?>

								<div class="service-reviews__author-info">
									<?php if ( ! empty( $review['author'] ) ) : ?>
										<span class="service-reviews__author-name"><?php echo esc_html( $review['author'] ); ?></span>
									<?php endif; ?>
									<?php if ( ! empty( $review['position'] ) ) : ?>
										<span class="service-reviews__author-position"><?php echo esc_html( $review['position'] ); ?></span>
									<?php endif; ?>
									<?php if ( ! empty( $review['company'] ) ) : ?>
										<span class="service-reviews__author-company"><?php echo esc_html( $review['company'] ); ?></span>
									<?php endif; ?>
								</div>
							</div>
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
