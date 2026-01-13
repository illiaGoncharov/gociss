<?php
/**
 * Hero секция страницы услуги
 *
 * Структура:
 * 1. Breadcrumb над баннером
 * 2. Баннер с фоновым изображением + контент поверх (заголовок, буллеты, кнопки)
 * 3. Секция описания с текстом и картинкой сертификата
 * 4. Секция нумерованных поинтов
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

// Поля для hero-баннера
$hero_title       = function_exists( 'get_field' ) ? get_field( 'gociss_service_hero_title' ) : '';
$hero_btn_primary = function_exists( 'get_field' ) ? get_field( 'gociss_service_hero_btn_primary' ) : '';
$hero_btn_secondary = function_exists( 'get_field' ) ? get_field( 'gociss_service_hero_btn_secondary' ) : '';

// Собираем буллеты
$hero_bullets = array();
for ( $i = 1; $i <= 6; $i++ ) {
	$bullet = function_exists( 'get_field' ) ? get_field( 'gociss_service_hero_bullet_' . $i ) : '';
	if ( ! empty( $bullet ) ) {
		$hero_bullets[] = $bullet;
	}
}

// Собираем поинты из отдельных group полей (для секции ниже)
$service_points = array();
for ( $i = 1; $i <= 8; $i++ ) {
	$point = function_exists( 'get_field' ) ? get_field( 'gociss_service_point_' . $i ) : null;
	if ( $point && ! empty( $point['title'] ) ) {
		$service_points[] = $point;
	}
}

// Заглушки для hero-баннера
if ( ! $hero_title ) {
	$hero_title = get_the_title() . ' в аккредитованном органе<br>без посредников и переплат';
}
if ( empty( $hero_bullets ) ) {
	$hero_bullets = array(
		'Государственная аккредитация',
		'Официальное оформление',
		'Короткие сроки получения',
		'Работаем по всей России',
	);
}
if ( empty( $hero_btn_primary['text'] ) ) {
	$hero_btn_primary = array(
		'text' => 'Обратный звонок',
		'url'  => '#form',
	);
}
if ( empty( $hero_btn_secondary['text'] ) ) {
	$hero_btn_secondary = array(
		'text' => 'Рассчитать стоимость',
		'url'  => '#pricing',
	);
}

// Заглушки для секции описания
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

// Определяем количество колонок для поинтов
$points_count   = count( $service_points );
$points_columns = ( $points_count > 4 ) ? 4 : $points_count;

// URL баннера для фона
$banner_url = '';
if ( $service_banner && ! empty( $service_banner['url'] ) ) {
	$banner_url = $service_banner['url'];
}
?>

<!-- Баннер -->
<section class="service-banner">
	<div class="container">
		<!-- Breadcrumb -->
		<nav class="service-banner__breadcrumb" aria-label="Хлебные крошки">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a>
			<span class="service-banner__breadcrumb-sep">→</span>
			<a href="<?php echo esc_url( home_url( '/uslugi/' ) ); ?>">Услуги</a>
			<span class="service-banner__breadcrumb-sep">→</span>
			<span class="service-banner__breadcrumb-current"><?php echo esc_html( get_the_title() ); ?></span>
		</nav>

		<!-- Hero баннер с фоновым изображением и контентом -->
		<div class="service-banner__hero" <?php echo $banner_url ? 'style="background-image: url(' . esc_url( $banner_url ) . ');"' : ''; ?>>
			<div class="service-banner__hero-content">
				<!-- Заголовок -->
				<h1 class="service-banner__title"><?php echo wp_kses_post( $hero_title ); ?></h1>

				<!-- Буллеты -->
				<?php if ( ! empty( $hero_bullets ) ) : ?>
					<ul class="service-banner__bullets">
						<?php foreach ( $hero_bullets as $bullet ) : ?>
							<li class="service-banner__bullet"><?php echo esc_html( $bullet ); ?></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>

				<!-- Кнопки -->
				<div class="service-banner__buttons">
					<?php if ( ! empty( $hero_btn_primary['text'] ) ) : ?>
						<a href="<?php echo esc_url( $hero_btn_primary['url'] ?? '#form' ); ?>" class="service-banner__btn service-banner__btn--primary">
							<?php echo esc_html( $hero_btn_primary['text'] ); ?>
						</a>
					<?php endif; ?>

					<?php if ( ! empty( $hero_btn_secondary['text'] ) ) : ?>
						<a href="<?php echo esc_url( $hero_btn_secondary['url'] ?? '#pricing' ); ?>" class="service-banner__btn service-banner__btn--secondary">
							<?php echo esc_html( $hero_btn_secondary['text'] ); ?>
						</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Секция описания с текстом и картинкой сертификата -->
<section class="service-about">
	<div class="container">
		<div class="service-about__content">
			<!-- Левая часть: текст -->
			<div class="service-about__text">
				<h2 class="service-about__title"><?php echo esc_html( $service_title ); ?></h2>

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
