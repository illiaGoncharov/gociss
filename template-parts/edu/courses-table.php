<?php
/**
 * Таблица курсов для страницы Учебного центра
 * С табами категорий и статусом курса
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Получаем все категории курсов
$categories = get_terms(
	array(
		'taxonomy'   => 'gociss_course_cat',
		'hide_empty' => true,
		'orderby'    => 'name',
		'order'      => 'ASC',
	)
);

// Получаем курсы
$courses_query = new WP_Query(
	array(
		'post_type'      => 'gociss_course',
		'posts_per_page' => -1,
		'post_status'    => 'publish',
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
	)
);
?>

<section class="edu-courses" id="courses">
	<div class="container">
		<h2 class="edu-courses__title">Курсы и образовательные программы</h2>

		<?php if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) : ?>
			<!-- Табы категорий -->
			<div class="edu-courses__tabs">
				<button class="edu-courses__tab edu-courses__tab--active" data-category="all">
					Все программы
				</button>
				<?php foreach ( $categories as $category ) : ?>
					<button class="edu-courses__tab" data-category="<?php echo esc_attr( $category->slug ); ?>">
						<?php echo esc_html( $category->name ); ?>
					</button>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<?php if ( $courses_query->have_posts() ) : ?>
			<div class="edu-courses__table-wrapper">
				<table class="edu-courses__table">
					<thead>
						<tr>
							<th>Название программы</th>
							<th>Дата проведения</th>
							<th>Стоимость</th>
							<th>Действие</th>
						</tr>
					</thead>
					<tbody>
						<?php
						while ( $courses_query->have_posts() ) :
							$courses_query->the_post();
							$course_id = get_the_ID();

							// Получаем категории курса для фильтрации
							$course_terms = get_the_terms( $course_id, 'gociss_course_cat' );
							$term_slugs   = array();
							if ( $course_terms && ! is_wp_error( $course_terms ) ) {
								foreach ( $course_terms as $term ) {
									$term_slugs[] = $term->slug;
								}
							}
							$data_categories = implode( ' ', $term_slugs );

							// Получаем ACF поля
							$date_type  = function_exists( 'get_field' ) ? get_field( 'gociss_course_date_type', $course_id ) : 'range';
							$date_start = function_exists( 'get_field' ) ? get_field( 'gociss_course_date_start', $course_id ) : '';
							$date_end   = function_exists( 'get_field' ) ? get_field( 'gociss_course_date_end', $course_id ) : '';
							$price      = function_exists( 'get_field' ) ? get_field( 'gociss_course_price', $course_id ) : '';
							$pdf        = function_exists( 'get_field' ) ? get_field( 'gociss_course_pdf', $course_id ) : '';
							$status     = function_exists( 'get_field' ) ? get_field( 'gociss_course_status', $course_id ) : 'active';

							// Форматирование даты
							if ( 'on_demand' === $date_type ) {
								$date_display = 'по мере набора групп';
							} elseif ( $date_start && $date_end ) {
								$date_display = date_i18n( 'd.m.Y', strtotime( $date_start ) ) . '-' . date_i18n( 'd.m.Y', strtotime( $date_end ) );
							} elseif ( $date_start ) {
								$date_display = date_i18n( 'd.m.Y', strtotime( $date_start ) );
							} else {
								$date_display = 'Уточняйте';
							}

							// Форматирование цены
							$price_display = $price ? number_format( $price, 0, '', ' ' ) . ' ₽' : 'По запросу';

							// URL для PDF
							$pdf_url = ( $pdf && isset( $pdf['url'] ) ) ? $pdf['url'] : '';

							// Статус курса
							$is_finished = ( 'finished' === $status );
							?>
							<tr data-categories="<?php echo esc_attr( $data_categories ); ?>">
								<td class="edu-courses__name-cell">
									<?php the_title(); ?>
								</td>
								<td class="edu-courses__date-cell">
									<?php echo esc_html( $date_display ); ?>
								</td>
								<td class="edu-courses__price-cell">
									<?php echo esc_html( $price_display ); ?>
								</td>
								<td class="edu-courses__actions-cell">
									<?php if ( $pdf_url ) : ?>
										<a href="<?php echo esc_url( $pdf_url ); ?>" target="_blank" rel="noopener noreferrer" class="edu-courses__btn edu-courses__btn--pdf">
											Скачать PDF
										</a>
									<?php endif; ?>
									<?php if ( $is_finished ) : ?>
										<span class="edu-courses__btn edu-courses__btn--finished">
											Завершено
										</span>
									<?php else : ?>
										<a href="#form" class="edu-courses__btn edu-courses__btn--order">
											Записаться
										</a>
									<?php endif; ?>
								</td>
							</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
			<?php wp_reset_postdata(); ?>

			<!-- Кнопка "Показать больше" -->
			<div class="edu-courses__more">
				<button class="edu-courses__more-btn" id="edu-show-more">
					Показать больше
				</button>
			</div>
		<?php else : ?>
			<p class="edu-courses__empty">Курсы скоро появятся. Оставьте заявку, и мы свяжемся с вами.</p>
		<?php endif; ?>
	</div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
	// Фильтрация по табам
	const tabs = document.querySelectorAll('.edu-courses__tab');
	const rows = document.querySelectorAll('.edu-courses__table tbody tr');

	tabs.forEach(function(tab) {
		tab.addEventListener('click', function() {
			// Активный таб
			tabs.forEach(t => t.classList.remove('edu-courses__tab--active'));
			this.classList.add('edu-courses__tab--active');

			const category = this.dataset.category;

			rows.forEach(function(row) {
				if (category === 'all') {
					row.style.display = '';
				} else {
					const rowCategories = row.dataset.categories || '';
					if (rowCategories.includes(category)) {
						row.style.display = '';
					} else {
						row.style.display = 'none';
					}
				}
			});
		});
	});

	// Показать больше (пока просто заглушка)
	const showMoreBtn = document.getElementById('edu-show-more');
	if (showMoreBtn) {
		// Скрываем кнопку если курсов мало
		if (rows.length <= 10) {
			showMoreBtn.style.display = 'none';
		}
	}
});
</script>
