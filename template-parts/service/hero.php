<?php
/**
 * Hero секция страницы услуги
 *
 * Структура:
 * 1. Breadcrumb + баннер
 * 2. Секция с текстом слева и картинкой сертификата справа
 * 3. Поинты (до 8 штук, если >4 — в 2 ряда)
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Получаем данные из ACF
$service_banner     = function_exists( 'get_field' ) ? get_field( 'gociss_service_banner' ) : '';
$service_title      = function_exists( 'get_field' ) ? get_field( 'gociss_service_title' ) : '';
$service_desc       = function_exists( 'get_field' ) ? get_field( 'gociss_service_description' ) : '';
$service_btn_text   = function_exists( 'get_field' ) ? get_field( 'gociss_service_btn_text' ) : '';
$service_cert_image = function_exists( 'get_field' ) ? get_field( 'gociss_service_cert_image' ) : '';

// Собираем поинты из отдельных group полей
$service_points = array();
for ( $i = 1; $i <= 8; $i++ ) {
	$point = function_exists( 'get_field' ) ? get_field( 'gociss_service_point_' . $i ) : null;
	if ( $point && ! empty( $point['title'] ) ) {
		$service_points[] = $point;
	}
}

// Заглушки
if ( ! $service_title ) {
	$service_title = get_the_title();
}
if ( ! $service_desc ) {
	$service_desc = '<p>Профессиональная сертификация для вашего бизнеса с гарантией качества и соблюдением всех требований законодательства.</p>';
}
if ( ! $service_btn_text ) {
	$service_btn_text = 'Бесплатная консультация';
}

// Заглушки для поинтов
if ( empty( $service_points ) ) {
	$service_points = array(
		array(
			'title'       => 'Наименование стандарта',
			'description' => 'Указание на применяемый стандарт сертификации',
		),
		array(
			'title'       => 'Реквизиты организации',
			'description' => 'Полные данные сертифицированной компании',
		),
		array(
			'title'       => 'Регистрационный номер',
			'description' => 'Уникальный номер в едином реестре',
		),
		array(
			'title'       => 'Срок действия',
			'description' => 'Дата выдачи и окончания срока действия',
		),
	);
}

// Определяем количество колонок
$points_count   = count( $service_points );
$points_columns = ( $points_count > 4 ) ? 4 : $points_count;

// Получаем данные для breadcrumb
$parent_page = get_post( wp_get_post_parent_id( get_the_ID() ) );
?>

<!-- Баннер -->
<section class="service-banner">
	<div class="container">
		<!-- Breadcrumb -->
		<nav class="service-banner__breadcrumb" aria-label="Хлебные крошки">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a>
			<span class="service-banner__breadcrumb-sep">→</span>
			<?php if ( $parent_page && $parent_page->ID ) : ?>
				<a href="<?php echo esc_url( get_permalink( $parent_page->ID ) ); ?>"><?php echo esc_html( $parent_page->post_title ); ?></a>
				<span class="service-banner__breadcrumb-sep">→</span>
			<?php else : ?>
				<a href="#">Услуги</a>
				<span class="service-banner__breadcrumb-sep">→</span>
			<?php endif; ?>
			<span class="service-banner__breadcrumb-current"><?php echo esc_html( get_the_title() ); ?></span>
		</nav>

		<!-- Баннер изображение -->
		<div class="service-banner__image">
			<?php if ( $service_banner && ! empty( $service_banner['ID'] ) ) : ?>
				<?php
				echo wp_get_attachment_image(
					$service_banner['ID'],
					'full',
					false,
					array(
						'alt'   => esc_attr( $service_banner['alt'] ?? $service_title ),
						'class' => 'service-banner__img',
					)
				);
				?>
			<?php else : ?>
				<div class="service-banner__placeholder">
					<span>Загрузите баннер через ACF</span>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>

<!-- Секция описания с текстом и картинкой сертификата -->
<section class="service-about">
	<div class="container">
		<div class="service-about__content">
			<!-- Левая часть: текст -->
			<div class="service-about__text">
				<h1 class="service-about__title"><?php echo esc_html( $service_title ); ?></h1>

				<?php if ( $service_desc ) : ?>
					<div class="service-about__description">
						<?php echo wp_kses_post( $service_desc ); ?>
					</div>
				<?php endif; ?>

			<a href="#form" class="service-about__btn">
				<?php echo esc_html( $service_btn_text ); ?>
			</a>
			</div>

			<!-- Правая часть: картинка сертификата с поинтами -->
			<div class="service-about__image">
				<?php if ( $service_cert_image && ! empty( $service_cert_image['ID'] ) ) : ?>
					<?php
					echo wp_get_attachment_image(
						$service_cert_image['ID'],
						'large',
						false,
						array(
							'alt'   => esc_attr( $service_cert_image['alt'] ?? 'Образец сертификата' ),
							'class' => 'service-about__cert-img',
						)
					);
					?>
				<?php else : ?>
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/sertificate.png' ); ?>" alt="Образец сертификата" class="service-about__cert-img">
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<!-- Секция поинтов -->
<section class="service-points">
	<div class="container">
		<div class="service-points__grid service-points__grid--cols-<?php echo esc_attr( $points_columns ); ?>">
			<?php
			$point_num = 1;
			foreach ( $service_points as $point ) :
				?>
				<div class="service-points__item">
					<div class="service-points__number">
						<?php echo esc_html( $point_num ); ?>
					</div>
					<div class="service-points__content">
						<?php if ( ! empty( $point['title'] ) ) : ?>
							<h3 class="service-points__title"><?php echo esc_html( $point['title'] ); ?></h3>
						<?php endif; ?>
						<?php if ( ! empty( $point['description'] ) ) : ?>
							<p class="service-points__desc"><?php echo esc_html( $point['description'] ); ?></p>
						<?php endif; ?>
					</div>
				</div>
				<?php
				$point_num++;
			endforeach;
			?>
		</div>
	</div>
</section>
