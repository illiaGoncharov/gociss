<?php
/**
 * Hero секция для страницы услуги (Custom Post Type)
 * Поддерживает мультирегиональность
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Получаем данные из ACF (поля для кастомного типа записей)
$service_banner     = function_exists( 'get_field' ) ? get_field( 'gociss_service_hero_image' ) : '';
$service_subtitle   = function_exists( 'get_field' ) ? get_field( 'gociss_service_hero_subtitle' ) : '';
$service_short_desc = function_exists( 'get_field' ) ? get_field( 'gociss_service_short_desc' ) : '';

// Мультирегиональность: получаем текущий регион из URL
$current_region = function_exists( 'gociss_get_current_region' ) ? gociss_get_current_region() : null;
$region_name    = $current_region ? $current_region->name : '';

// Получаем категории услуги для breadcrumbs
$service_terms = get_the_terms( get_the_ID(), 'gociss_service_cat' );
$primary_term  = null;
$parent_term   = null;
if ( $service_terms && ! is_wp_error( $service_terms ) ) {
	// Берем первую категорию
	$primary_term = $service_terms[0];
	// Проверяем, есть ли родительская категория
	if ( $primary_term->parent > 0 ) {
		$parent_term = get_term( $primary_term->parent, 'gociss_service_cat' );
	}
}

// Формируем заголовок с учётом региона
// Сначала проверяем региональный заголовок, потом автогенерацию
$regional_hero_title = '';
if ( $current_region && function_exists( 'get_field' ) ) {
	$regional_hero_title = get_field( 'gociss_region_hero_title', 'term_' . $current_region->term_id );
}

if ( ! empty( $regional_hero_title ) ) {
	// Используем полностью кастомный региональный заголовок
	$hero_title = $regional_hero_title;
} else {
	// Получаем название региона в предложном падеже
	$region_prepositional = '';
	if ( $current_region && function_exists( 'get_field' ) ) {
		$region_prepositional = get_field( 'gociss_region_name_prepositional', 'term_' . $current_region->term_id );
	}
	// Если не заполнено ACF поле — используем маппинг популярных городов
	if ( empty( $region_prepositional ) && $region_name ) {
		$cities_map = array(
			'Санкт-Петербург' => 'Санкт-Петербурге',
			'Москва'          => 'Москве',
			'Новосибирск'     => 'Новосибирске',
			'Екатеринбург'    => 'Екатеринбурге',
			'Казань'          => 'Казани',
			'Нижний Новгород' => 'Нижнем Новгороде',
			'Челябинск'       => 'Челябинске',
			'Самара'          => 'Самаре',
			'Омск'            => 'Омске',
			'Ростов-на-Дону'  => 'Ростове-на-Дону',
			'Уфа'             => 'Уфе',
			'Красноярск'      => 'Красноярске',
			'Краснодар'       => 'Краснодаре',
			'Воронеж'         => 'Воронеже',
			'Пермь'           => 'Перми',
			'Волгоград'       => 'Волгограде',
		);
		$region_prepositional = isset( $cities_map[ $region_name ] ) ? $cities_map[ $region_name ] : $region_name;
	}

	// Формируем заголовок
	if ( $region_prepositional ) {
		$hero_title = get_the_title() . ' в ' . $region_prepositional . ' в аккредитованном органе<br>без посредников и переплат';
	} else {
		$hero_title = get_the_title() . ' в аккредитованном органе<br>без посредников и переплат';
	}
}

// Проверяем региональный подзаголовок
$regional_hero_subtitle = '';
if ( $current_region && function_exists( 'get_field' ) ) {
	$regional_hero_subtitle = get_field( 'gociss_region_hero_subtitle', 'term_' . $current_region->term_id );
}
if ( ! empty( $regional_hero_subtitle ) ) {
	$service_subtitle = $regional_hero_subtitle;
}

$hero_bullets = array(
	'Государственная аккредитация',
	'Официальное оформление',
	'Короткие сроки получения',
	'Работаем по всей России',
);

$hero_btn_primary = array(
	'text' => 'Обратный звонок',
	'url'  => '#form',
);

$hero_btn_secondary = array(
	'text' => 'Рассчитать стоимость',
	'url'  => '#pricing',
);

// URL баннера для фона
$banner_url = '';
if ( $service_banner && ! empty( $service_banner['url'] ) ) {
	$banner_url = $service_banner['url'];
}
?>

<!-- Баннер -->
<section class="service-banner">
	<!-- Breadcrumb -->
	<div class="container">
		<nav class="breadcrumbs" aria-label="Хлебные крошки">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a>
			<span class="breadcrumbs__separator">/</span>
			<a href="<?php echo esc_url( get_post_type_archive_link( 'gociss_service' ) ); ?>">Услуги</a>
			<?php if ( $parent_term && ! is_wp_error( $parent_term ) ) : ?>
				<span class="breadcrumbs__separator">/</span>
				<a href="<?php echo esc_url( get_term_link( $parent_term ) ); ?>"><?php echo esc_html( $parent_term->name ); ?></a>
			<?php endif; ?>
		<?php if ( $primary_term && ! is_wp_error( $primary_term ) ) : ?>
			<span class="breadcrumbs__separator">/</span>
			<a href="<?php echo esc_url( get_term_link( $primary_term ) ); ?>"><?php echo esc_html( $primary_term->name ); ?></a>
		<?php endif; ?>
		<span class="breadcrumbs__separator">/</span>
		<?php if ( $current_region ) : ?>
			<a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
			<span class="breadcrumbs__separator">/</span>
			<span class="breadcrumbs__current"><?php echo esc_html( $current_region->name ); ?></span>
		<?php else : ?>
			<span class="breadcrumbs__current"><?php echo esc_html( get_the_title() ); ?></span>
		<?php endif; ?>
	</nav>
	</div>

	<!-- Hero баннер с фоновым изображением и контентом (на всю ширину) -->
	<div class="service-banner__hero" <?php echo $banner_url ? 'style="background-image: url(' . esc_url( $banner_url ) . ');"' : ''; ?>>
		<div class="container">
			<div class="service-banner__hero-content">
				<!-- Заголовок -->
				<h1 class="service-banner__title"><?php echo wp_kses_post( $hero_title ); ?></h1>

				<?php if ( $service_subtitle ) : ?>
					<p class="service-banner__subtitle"><?php echo esc_html( $service_subtitle ); ?></p>
				<?php endif; ?>

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

