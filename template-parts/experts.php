<?php
/**
 * Секция экспертов (из кастомного типа записи gociss_expert)
 * Порядок управляется через menu_order или плагин Simple Custom Post Order
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$experts_title    = function_exists( 'get_field' ) ? get_field( 'gociss_experts_title' ) : '';
$experts_subtitle = function_exists( 'get_field' ) ? get_field( 'gociss_experts_subtitle' ) : '';
$experts_count    = function_exists( 'get_field' ) ? get_field( 'gociss_experts_count' ) : 5;

if ( ! $experts_title ) {
	$experts_title = 'Наши ведущие эксперты';
}
if ( ! $experts_subtitle ) {
	$experts_subtitle = 'Команда профессионалов с международной аккредитацией и многолетним опытом';
}
if ( ! $experts_count ) {
	$experts_count = 5;
}

// Получаем экспертов из кастомного типа записи
$experts_query = new WP_Query(
	array(
		'post_type'      => 'gociss_expert',
		'posts_per_page' => $experts_count,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
		'post_status'    => 'publish',
	)
);

$experts = array();

if ( $experts_query->have_posts() ) {
	while ( $experts_query->have_posts() ) {
		$experts_query->the_post();
		
		$photo      = get_post_thumbnail_id() ? array( 'ID' => get_post_thumbnail_id() ) : null;
		$position   = function_exists( 'get_field' ) ? get_field( 'gociss_expert_position' ) : '';
		$experience = function_exists( 'get_field' ) ? get_field( 'gociss_expert_experience' ) : '';
		
		$experts[] = array(
			'photo'      => $photo,
			'name'       => get_the_title(),
			'position'   => $position,
			'experience' => $experience,
		);
	}
	wp_reset_postdata();
}

// Заглушки, если нет данных
if ( empty( $experts ) ) {
	$experts = array(
		array( 'name' => 'Мышеловский Сергей Вячеславович', 'position' => 'Генеральный директор', 'experience' => '12 лет опыта, более 500 проектов ISO 9001, 14001, 45001' ),
		array( 'name' => 'Иванов Алексей Петрович', 'position' => 'Ведущий аудитор', 'experience' => '10 лет опыта, специализация ISO 9001, ISO 14001' ),
		array( 'name' => 'Петрова Елена Сергеевна', 'position' => 'Эксперт по сертификации', 'experience' => '8 лет опыта, более 300 проектов' ),
		array( 'name' => 'Сидоров Николай Иванович', 'position' => 'Технический директор', 'experience' => '15 лет опыта в области сертификации' ),
		array( 'name' => 'Козлова Марина Андреевна', 'position' => 'Руководитель отдела', 'experience' => '7 лет опыта, ISO 45001, ISO 27001' ),
	);
}

$experts_to_show = $experts;
?>

<section class="experts" id="experts">
	<div class="container">
		<h2 class="experts__title"><?php echo esc_html( $experts_title ); ?></h2>
		<p class="experts__subtitle"><?php echo esc_html( $experts_subtitle ); ?></p>

		<div class="experts__slider">
			<button class="experts__nav experts__nav--prev" aria-label="Предыдущий">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</button>

			<div class="experts__track">
				<div class="experts__grid">
					<?php foreach ( $experts_to_show as $expert ) : ?>
						<div class="experts__item">
							<div class="experts__photo">
								<?php if ( ! empty( $expert['photo'] ) && ! empty( $expert['photo']['ID'] ) ) : ?>
									<?php
									echo wp_get_attachment_image(
										$expert['photo']['ID'],
										'gociss-expert',
										false,
										array(
											'alt'   => esc_attr( $expert['name'] ),
											'class' => 'experts__photo-img',
										)
									);
									?>
								<?php else : ?>
									<div class="experts__photo-placeholder"></div>
								<?php endif; ?>
							</div>
							<h3 class="experts__name"><?php echo esc_html( $expert['name'] ); ?></h3>
							<?php if ( ! empty( $expert['position'] ) ) : ?>
								<p class="experts__position"><?php echo esc_html( $expert['position'] ); ?></p>
							<?php endif; ?>
							<?php if ( ! empty( $expert['experience'] ) ) : ?>
								<p class="experts__experience"><?php echo esc_html( $expert['experience'] ); ?></p>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
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
