<?php
/**
 * Секция "Наши партнёры" для страницы услуги — слайдер
 * На основе template-parts/about/partners.php, но вместо grid — горизонтальный слайдер
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$partners_title    = function_exists( 'get_field' ) ? get_field( 'gociss_about_partners_title' ) : '';
$partners_subtitle = function_exists( 'get_field' ) ? get_field( 'gociss_about_partners_subtitle' ) : '';

if ( ! $partners_title ) {
	$partners_title = 'Наши партнёры';
}
if ( ! $partners_subtitle ) {
	$partners_subtitle = 'Мы сотрудничаем с ведущими организациями и компаниями различных отраслей';
}

// Заглушки партнёров с иконками
$default_partners = array(
	array(
		'name' => 'Газпром',
		'icon' => '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="2" y="4" width="6" height="12" rx="1" stroke="currentColor" stroke-width="1.5"/><rect x="10" y="2" width="6" height="14" rx="1" stroke="currentColor" stroke-width="1.5"/><path d="M5 8V12M13 6V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>',
	),
	array(
		'name' => 'Роснефть',
		'icon' => '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="3" y="6" width="5" height="10" rx="1" stroke="currentColor" stroke-width="1.5"/><path d="M8 10H12M12 6V14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><circle cx="14" cy="10" r="3" stroke="currentColor" stroke-width="1.5"/></svg>',
	),
	array(
		'name' => 'Россети',
		'icon' => '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 2L14 8H6L10 2Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/><path d="M10 8V18M6 12H14M4 16H16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>',
	),
	array(
		'name' => 'Норникель',
		'icon' => '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 2V6M10 14V18M6 10H2M18 10H14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><circle cx="10" cy="10" r="4" stroke="currentColor" stroke-width="1.5"/><path d="M10 6V14M6 10H14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>',
	),
	array(
		'name' => 'АВТОВАЗ',
		'icon' => '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="2" y="8" width="16" height="6" rx="2" stroke="currentColor" stroke-width="1.5"/><circle cx="5" cy="14" r="2" stroke="currentColor" stroke-width="1.5"/><circle cx="15" cy="14" r="2" stroke="currentColor" stroke-width="1.5"/><path d="M4 8L6 4H14L16 8" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/></svg>',
	),
	array(
		'name' => 'Сбербанк',
		'icon' => '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="10" cy="10" r="7" stroke="currentColor" stroke-width="1.5"/><path d="M7 10L9.5 12.5L13 7.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
	),
	array(
		'name' => 'РЖД',
		'icon' => '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="3" y="6" width="14" height="8" rx="1" stroke="currentColor" stroke-width="1.5"/><circle cx="7" cy="14" r="1.5" stroke="currentColor" stroke-width="1.5"/><circle cx="13" cy="14" r="1.5" stroke="currentColor" stroke-width="1.5"/><path d="M2 10H18" stroke="currentColor" stroke-width="1.5"/></svg>',
	),
	array(
		'name' => 'Лукойл',
		'icon' => '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 3C10 3 5 8 5 12C5 14.7614 7.23858 17 10 17C12.7614 17 15 14.7614 15 12C15 8 10 3 10 3Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/></svg>',
	),
);

// Попытка получить партнёров из ACF
$partners_items = array();
for ( $i = 1; $i <= 8; $i++ ) {
	$partner = function_exists( 'get_field' ) ? get_field( 'gociss_about_partner_' . $i ) : null;
	if ( $partner && ! empty( $partner['name'] ) ) {
		$partners_items[] = $partner;
	}
}

$partners_to_show = count( $partners_items ) > 0 ? $partners_items : $default_partners;
?>

<section class="service-partners-slider" id="service-partners">
	<div class="container">
		<h2 class="service-partners-slider__title"><?php echo esc_html( $partners_title ); ?></h2>
		<p class="service-partners-slider__subtitle"><?php echo esc_html( $partners_subtitle ); ?></p>

		<div class="service-partners-slider__slider">
			<button class="service-partners-slider__nav service-partners-slider__nav--prev" aria-label="Предыдущий">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</button>

			<div class="service-partners-slider__track">
				<div class="service-partners-slider__grid">
					<?php foreach ( $partners_to_show as $partner ) : ?>
						<div class="service-partners-slider__card">
							<span class="service-partners-slider__card-icon">
								<?php if ( ! empty( $partner['icon'] ) ) : ?>
									<?php echo $partner['icon']; ?>
								<?php endif; ?>
							</span>
							<span class="service-partners-slider__card-name"><?php echo esc_html( $partner['name'] ); ?></span>
						</div>
					<?php endforeach; ?>
				</div>
			</div>

			<button class="service-partners-slider__nav service-partners-slider__nav--next" aria-label="Следующий">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</button>
		</div>
	</div>
</section>
