<?php
/**
 * Секция "Наши партнёры" для страницы О компании
 * Карточки с иконкой + название
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ACF поля
$partners_title    = function_exists( 'get_field' ) ? get_field( 'gociss_about_partners_title' ) : '';
$partners_subtitle = function_exists( 'get_field' ) ? get_field( 'gociss_about_partners_subtitle' ) : '';

// Заглушки
if ( ! $partners_title ) {
	$partners_title = 'Наши партнёры';
}
if ( ! $partners_subtitle ) {
	$partners_subtitle = 'Мы сотрудничаем с ведущими организациями и компаниями различных отраслей';
}

// Партнёры с иконками (заглушки)
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

<section class="about-partners" id="partners">
	<div class="container">
		<?php if ( $partners_title ) : ?>
			<h2 class="about-partners__title"><?php echo esc_html( $partners_title ); ?></h2>
		<?php endif; ?>

		<?php if ( $partners_subtitle ) : ?>
			<p class="about-partners__subtitle"><?php echo esc_html( $partners_subtitle ); ?></p>
		<?php endif; ?>

		<div class="about-partners__grid">
			<?php foreach ( $partners_to_show as $partner ) : ?>
				<div class="about-partners__card">
					<span class="about-partners__card-icon">
						<?php if ( ! empty( $partner['icon'] ) ) : ?>
							<?php echo $partner['icon']; ?>
						<?php endif; ?>
					</span>
					<span class="about-partners__card-name"><?php echo esc_html( $partner['name'] ); ?></span>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

