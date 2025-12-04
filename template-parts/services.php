<?php
/**
 * Секция услуг
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$services_title    = function_exists( 'get_field' ) ? get_field( 'gociss_services_title' ) : '';
$services_subtitle = function_exists( 'get_field' ) ? get_field( 'gociss_services_subtitle' ) : '';
$services_items    = function_exists( 'get_field' ) ? get_field( 'gociss_services_items' ) : '';

// Заглушки
if ( ! $services_title ) {
	$services_title = 'Ключевые направления';
}
if ( ! $services_subtitle ) {
	$services_subtitle = 'Полный спектр сертификационных услуг для различных отраслей и стандартов качества';
}
?>

<section class="services" id="services">
	<div class="container">
		<?php if ( $services_title ) : ?>
			<h2 class="services__title"><?php echo esc_html( $services_title ); ?></h2>
		<?php endif; ?>

		<?php if ( $services_subtitle ) : ?>
			<p class="services__subtitle"><?php echo esc_html( $services_subtitle ); ?></p>
		<?php endif; ?>

		<div class="services__grid">
			<?php if ( $services_items && is_array( $services_items ) && count( $services_items ) > 0 ) : ?>
				<?php
				$icon_index = 1;
				foreach ( $services_items as $service ) :
				?>
				<div class="services__item">
					<?php if ( ! empty( $service['icon'] ) ) : ?>
						<div class="services__icon">
							<?php
							echo wp_get_attachment_image(
								$service['icon']['ID'],
								'thumbnail',
								false,
								array(
									'alt' => esc_attr( $service['icon']['alt'] ),
								)
							);
							?>
						</div>
					<?php else : ?>
						<div class="services__icon">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/directions/' . $icon_index . '.svg' ); ?>" alt="">
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $service['title'] ) ) : ?>
						<h3 class="services__item-title"><?php echo esc_html( $service['title'] ); ?></h3>
					<?php endif; ?>

					<?php if ( ! empty( $service['description'] ) ) : ?>
						<p class="services__item-description"><?php echo esc_html( $service['description'] ); ?></p>
					<?php endif; ?>

					<?php if ( ! empty( $service['link'] ) ) : ?>
						<a href="<?php echo esc_url( $service['link'] ); ?>" class="services__item-link">
							Подробнее →
						</a>
					<?php endif; ?>
				</div>
				<?php
				$icon_index++;
				endforeach;
				?>
			<?php else : ?>
				<!-- Заглушки услуг -->
				<div class="services__item">
					<div class="services__icon">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/directions/1.svg' ); ?>" alt="">
					</div>
					<h3 class="services__item-title">Сертификация ISO</h3>
					<p class="services__item-description">ISO 9001, ISO 14001, ISO 45001, ISO 27001 и другие международные стандарты качества</p>
					<a href="#" class="services__item-link">Подробнее →</a>
				</div>
				<div class="services__item">
					<div class="services__icon">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/directions/2.svg' ); ?>" alt="">
					</div>
					<h3 class="services__item-title">Оценка опыта и деловой репутации</h3>
					<p class="services__item-description">Экспертная оценка квалификации участников закупок для государственных и коммерческих тендеров</p>
					<a href="#" class="services__item-link">Подробнее →</a>
				</div>
				<div class="services__item">
					<div class="services__icon">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/directions/3.svg' ); ?>" alt="">
					</div>
					<h3 class="services__item-title">Сертификация продукции ТР ТС/ ЕАЭС</h3>
					<p class="services__item-description">Обязательная сертификация и декларирование соответствия техническим регламентам ЕАЭС</p>
					<a href="#" class="services__item-link">Подробнее →</a>
				</div>
				<div class="services__item">
					<div class="services__icon">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/directions/4.svg' ); ?>" alt="">
					</div>
					<h3 class="services__item-title">Сертификация персонала</h3>
					<p class="services__item-description">Подтверждение профессиональной компетентности специалистов в различных областях деятельности</p>
					<a href="#" class="services__item-link">Подробнее →</a>
				</div>
				<div class="services__item">
					<div class="services__icon">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/directions/5.svg' ); ?>" alt="">
					</div>
					<h3 class="services__item-title">Регистрация систем добровольной сертификации</h3>
					<p class="services__item-description">Создание и регистрация собственных систем добровольной сертификации в Росаккредитации</p>
					<a href="#" class="services__item-link">Подробнее →</a>
				</div>
				<div class="services__item">
					<div class="services__icon">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/directions/6.svg' ); ?>" alt="">
					</div>
					<h3 class="services__item-title">Учебный центр</h3>
					<p class="services__item-description">Обучение и повышение квалификации специалистов по стандартам качества и сертификации</p>
					<a href="#" class="services__item-link">Подробнее →</a>
				</div>
			<?php endif; ?>
		</div>

		<div class="services__footer">
			<a href="#services" class="btn">Посмотреть все услуги →</a>
		</div>
	</div>
</section>



