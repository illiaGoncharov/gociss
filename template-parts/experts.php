<?php
/**
 * Секция экспертов (слайдер)
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$experts_title    = function_exists( 'get_field' ) ? get_field( 'gociss_experts_title' ) : '';
$experts_subtitle = function_exists( 'get_field' ) ? get_field( 'gociss_experts_subtitle' ) : '';
$experts_items    = function_exists( 'get_field' ) ? get_field( 'gociss_experts_items' ) : '';

// Заглушки
if ( ! $experts_title ) {
	$experts_title = 'Наши ведущие эксперты';
}
if ( ! $experts_subtitle ) {
	$experts_subtitle = 'Команда профессионалов с международной аккредитацией и многолетним опытом';
}
?>

<section class="experts" id="experts">
	<div class="container">
		<?php if ( $experts_title ) : ?>
			<h2 class="experts__title"><?php echo esc_html( $experts_title ); ?></h2>
		<?php endif; ?>

		<?php if ( $experts_subtitle ) : ?>
			<p class="experts__subtitle"><?php echo esc_html( $experts_subtitle ); ?></p>
		<?php endif; ?>

		<div class="experts__slider">
			<button class="experts__nav experts__nav--prev" aria-label="Предыдущий">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</button>

			<div class="experts__track">
				<div class="experts__grid">
					<?php if ( $experts_items && is_array( $experts_items ) && count( $experts_items ) > 0 ) : ?>
						<?php foreach ( $experts_items as $expert ) : ?>
							<div class="experts__item">
								<div class="experts__photo">
									<?php if ( ! empty( $expert['photo'] ) && ! empty( $expert['photo']['url'] ) ) : ?>
										<img src="<?php echo esc_url( $expert['photo']['url'] ); ?>" alt="<?php echo esc_attr( $expert['name'] ?? '' ); ?>">
									<?php else : ?>
										<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/expert-placeholder.jpg' ); ?>" alt="Эксперт">
									<?php endif; ?>
								</div>
								<?php if ( ! empty( $expert['name'] ) ) : ?>
									<h3 class="experts__name"><?php echo esc_html( $expert['name'] ); ?></h3>
								<?php endif; ?>
								<?php if ( ! empty( $expert['position'] ) ) : ?>
									<p class="experts__position"><?php echo esc_html( $expert['position'] ); ?></p>
								<?php endif; ?>
								<?php if ( ! empty( $expert['experience'] ) ) : ?>
									<p class="experts__experience"><?php echo esc_html( $expert['experience'] ); ?></p>
								<?php endif; ?>
							</div>
						<?php endforeach; ?>
					<?php else : ?>
						<!-- Заглушки экспертов -->
						<?php for ( $i = 1; $i <= 5; $i++ ) : ?>
							<div class="experts__item">
								<div class="experts__photo">
									<div class="experts__photo-placeholder"></div>
								</div>
								<h3 class="experts__name">Мышеловский Сергей Вячеславович</h3>
								<p class="experts__position">Генеральный директор</p>
								<p class="experts__experience">12 лет опыта, более 500 проектов ISO 9001, 14001, 45001</p>
							</div>
						<?php endfor; ?>
					<?php endif; ?>
				</div>
			</div>

			<button class="experts__nav experts__nav--next" aria-label="Следующий">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</button>
		</div>
	</div>
</section>


