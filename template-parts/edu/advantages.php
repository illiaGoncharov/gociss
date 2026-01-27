<?php
/**
 * Секция "Преимущества" для страницы Учебного центра
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Получаем данные из ACF
$adv_title    = function_exists( 'get_field' ) ? get_field( 'gociss_edu_adv_title' ) : '';
$adv_subtitle = function_exists( 'get_field' ) ? get_field( 'gociss_edu_adv_subtitle' ) : '';

// Значения по умолчанию
if ( empty( $adv_title ) ) {
	$adv_title = 'Наши конкурентные преимущества';
}
if ( empty( $adv_subtitle ) ) {
	$adv_subtitle = 'Почему клиенты выбирают именно нас для решения задач сертификации';
}

// Собираем преимущества
$advantages = array();
$default_texts = array(
	'Наличие государственной аккредитации (Росаккредитация)',
	'Законность оформленных заключений и сертификатов СМК',
	'Стабильно высокое качество работ по подтверждению ИСО',
	'Объективность и достоверность предоставленных сведений',
	'Отсутствие государственных пошлин за оказываемые услуги',
	'Оперативная доставка документов по всем субъектам РФ',
);

for ( $i = 1; $i <= 6; $i++ ) {
	$icon = function_exists( 'get_field' ) ? get_field( 'gociss_edu_adv' . $i . '_icon' ) : '';
	$text = function_exists( 'get_field' ) ? get_field( 'gociss_edu_adv' . $i . '_text' ) : '';

	if ( empty( $text ) ) {
		$text = $default_texts[ $i - 1 ];
	}

	$advantages[] = array(
		'icon' => $icon,
		'text' => $text,
	);
}

// Дефолтные SVG иконки
$default_icons = array(
	'<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/></svg>',
	'<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/></svg>',
	'<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>',
	'<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>',
	'<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>',
	'<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>',
);
?>

<section class="edu-advantages">
	<div class="container">
		<div class="edu-advantages__header">
			<h2 class="edu-advantages__title"><?php echo esc_html( $adv_title ); ?></h2>
			<p class="edu-advantages__subtitle"><?php echo esc_html( $adv_subtitle ); ?></p>
		</div>

		<div class="edu-advantages__grid">
			<?php foreach ( $advantages as $index => $advantage ) : ?>
				<div class="edu-advantages__item">
					<div class="edu-advantages__icon">
						<?php if ( $advantage['icon'] && isset( $advantage['icon']['url'] ) ) : ?>
							<img src="<?php echo esc_url( $advantage['icon']['url'] ); ?>" alt="" width="32" height="32">
						<?php else : ?>
							<?php echo $default_icons[ $index ]; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<?php endif; ?>
					</div>
					<p class="edu-advantages__text"><?php echo esc_html( $advantage['text'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
