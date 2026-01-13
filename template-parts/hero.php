<?php
/**
 * Hero секция
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Проверяем наличие ACF перед использованием
$hero_label         = function_exists( 'get_field' ) ? get_field( 'gociss_hero_label' ) : '';
$hero_title         = function_exists( 'get_field' ) ? get_field( 'gociss_hero_title' ) : '';
$hero_description   = function_exists( 'get_field' ) ? get_field( 'gociss_hero_description' ) : '';
$hero_btn_primary   = function_exists( 'get_field' ) ? get_field( 'gociss_hero_btn_primary' ) : '';
$hero_btn_secondary = function_exists( 'get_field' ) ? get_field( 'gociss_hero_btn_secondary' ) : '';
$hero_stats         = function_exists( 'get_field' ) ? get_field( 'gociss_hero_stats' ) : '';

// Собираем слайды из отдельных полей image в массив
$hero_gallery = array();
if ( function_exists( 'get_field' ) ) {
	for ( $i = 1; $i <= 5; $i++ ) {
		$slide = get_field( 'gociss_hero_slide_' . $i );
		if ( $slide && ! empty( $slide['ID'] ) ) {
			$hero_gallery[] = $slide;
		}
	}
}

// Заглушки, если ACF поля не заполнены
if ( ! $hero_title ) {
	$hero_title = 'Профессиональная сертификация для вашего бизнеса';
}
if ( ! $hero_description ) {
	$hero_description = 'Помогаем компаниям получить международные и национальные сертификаты качества. Работаем с 1997 года, 5000+ успешных проектов, аккредитованные эксперты.';
}
if ( ! $hero_label ) {
	$hero_label = 'Аккредитованный орган по сертификации';
}
?>

<section class="hero">
	<div class="container">
		<div class="hero__content">
			<div class="hero__text">
				<?php if ( $hero_label ) : ?>
					<span class="hero__label"><?php echo esc_html( $hero_label ); ?></span>
				<?php endif; ?>

				<h1 class="hero__title"><?php echo esc_html( $hero_title ); ?></h1>

				<?php if ( $hero_description ) : ?>
					<p class="hero__description"><?php echo esc_html( $hero_description ); ?></p>
				<?php endif; ?>

				<div class="hero__buttons">
					<?php if ( $hero_btn_primary && ! empty( $hero_btn_primary['text'] ) ) : ?>
						<a href="<?php echo esc_url( $hero_btn_primary['url'] ); ?>" class="btn btn--primary">
							<?php echo esc_html( $hero_btn_primary['text'] ); ?>
						</a>
					<?php else : ?>
						<a href="#form" class="btn btn--primary">Бесплатная консультация</a>
					<?php endif; ?>

					<?php if ( $hero_btn_secondary && ! empty( $hero_btn_secondary['text'] ) ) : ?>
						<a href="<?php echo esc_url( $hero_btn_secondary['url'] ); ?>" class="btn btn--secondary">
							<?php echo esc_html( $hero_btn_secondary['text'] ); ?>
						</a>
					<?php else : ?>
						<a href="#calculator" class="btn btn--secondary">Рассчитать стоимость</a>
					<?php endif; ?>
				</div>

				<?php if ( $hero_stats && is_array( $hero_stats ) && count( $hero_stats ) > 0 ) : ?>
					<div class="hero__stats">
						<?php foreach ( $hero_stats as $stat ) : ?>
							<div class="hero__stat">
								<span class="hero__stat-number"><?php echo esc_html( $stat['number'] ); ?></span>
								<span class="hero__stat-label"><?php echo esc_html( $stat['label'] ); ?></span>
							</div>
						<?php endforeach; ?>
					</div>
				<?php else : ?>
					<div class="hero__stats">
						<div class="hero__stat">
							<span class="hero__stat-number">5000+</span>
							<span class="hero__stat-label">Выданных сертификатов</span>
						</div>
						<div class="hero__stat">
							<span class="hero__stat-number">15+</span>
							<span class="hero__stat-label">Лет на рынке</span>
						</div>
						<div class="hero__stat">
							<span class="hero__stat-number">1200+</span>
							<span class="hero__stat-label">Клиентов</span>
						</div>
					</div>
				<?php endif; ?>
			</div>

			<div class="hero__image">
				<?php if ( $hero_gallery && is_array( $hero_gallery ) && count( $hero_gallery ) > 0 ) : ?>
					<!-- Слайдер изображений -->
					<div class="hero__slider" data-slider="hero">
						<?php if ( count( $hero_gallery ) > 1 ) : ?>
							<!-- Невидимая кликабельная зона слева -->
							<button type="button" class="hero__nav hero__nav--prev" aria-label="Предыдущий слайд"></button>
						<?php endif; ?>

						<div class="hero__slides">
							<?php foreach ( $hero_gallery as $index => $image ) : ?>
								<div class="hero__slide<?php echo 0 === $index ? ' is-active' : ''; ?>">
									<?php
									echo wp_get_attachment_image(
										$image['ID'],
										'gociss-hero',
										false,
										array(
											'alt'   => esc_attr( $image['alt'] ),
											'class' => 'hero__img',
										)
									);
									?>
								</div>
							<?php endforeach; ?>
						</div>

						<?php if ( count( $hero_gallery ) > 1 ) : ?>
							<!-- Невидимая кликабельная зона справа -->
							<button type="button" class="hero__nav hero__nav--next" aria-label="Следующий слайд"></button>
						<?php endif; ?>
					</div>
				<?php else : ?>
					<!-- Placeholder для изображения (загрузите через ACF) -->
					<div class="hero__placeholder">
						<div class="hero__placeholder-inner">
							<span class="hero__placeholder-icon">🖼️</span>
							<span class="hero__placeholder-text">Изображения для слайдера<br><small>Загрузите через ACF</small></span>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>



