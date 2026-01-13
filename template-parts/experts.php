<?php
/**
 * Секция экспертов (фиксированные поля ACF)
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$experts_title    = function_exists( 'get_field' ) ? get_field( 'gociss_experts_title' ) : '';
$experts_subtitle = function_exists( 'get_field' ) ? get_field( 'gociss_experts_subtitle' ) : '';

if ( ! $experts_title ) {
	$experts_title = 'Наши ведущие эксперты';
}
if ( ! $experts_subtitle ) {
	$experts_subtitle = 'Команда профессионалов с международной аккредитацией и многолетним опытом';
}

// Собираем экспертов из фиксированных полей
$experts = array();
for ( $i = 1; $i <= 8; $i++ ) {
	$photo      = function_exists( 'get_field' ) ? get_field( 'gociss_expert_' . $i . '_photo' ) : null;
	$name       = function_exists( 'get_field' ) ? get_field( 'gociss_expert_' . $i . '_name' ) : '';
	$position   = function_exists( 'get_field' ) ? get_field( 'gociss_expert_' . $i . '_position' ) : '';
	$experience = function_exists( 'get_field' ) ? get_field( 'gociss_expert_' . $i . '_experience' ) : '';

	if ( $name ) {
		$experts[] = array(
			'photo'      => $photo,
			'name'       => $name,
			'position'   => $position,
			'experience' => $experience,
		);
	}
}

// Заглушки, если нет данных
$default_experts = array(
	array( 'name' => 'Мышеловский Сергей Вячеславович', 'position' => 'Генеральный директор', 'experience' => '12 лет опыта, более 500 проектов ISO 9001, 14001, 45001' ),
	array( 'name' => 'Иванов Алексей Петрович', 'position' => 'Ведущий аудитор', 'experience' => '10 лет опыта, специализация ISO 9001, ISO 14001' ),
	array( 'name' => 'Петрова Елена Сергеевна', 'position' => 'Эксперт по сертификации', 'experience' => '8 лет опыта, более 300 проектов' ),
	array( 'name' => 'Сидоров Николай Иванович', 'position' => 'Технический директор', 'experience' => '15 лет опыта в области сертификации' ),
	array( 'name' => 'Козлова Марина Андреевна', 'position' => 'Руководитель отдела', 'experience' => '7 лет опыта, ISO 45001, ISO 27001' ),
);

$experts_to_show = ! empty( $experts ) ? $experts : $default_experts;
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
