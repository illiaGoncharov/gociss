<?php
/**
 * Секция "Основные цели компании"
 * Светло-синий фон, белые карточки с иконками
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ACF поля
$goals_title    = function_exists( 'get_field' ) ? get_field( 'gociss_about_goals_title' ) : '';
$goals_subtitle = function_exists( 'get_field' ) ? get_field( 'gociss_about_goals_subtitle' ) : '';

// Заглушки
if ( ! $goals_title ) {
	$goals_title = 'Основные цели компании';
}
if ( ! $goals_subtitle ) {
	$goals_subtitle = 'Наша миссия заключается в обеспечении высочайшего качества сертификационных услуг и содействии развитию бизнеса наших клиентов';
}

// Карточки целей (заглушки)
$goals_cards = array(
	array(
		'icon'  => '<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="16" cy="16" r="12" stroke="#0052CC" stroke-width="2"/><path d="M16 4V6M16 26V28M4 16H6M26 16H28" stroke="#0052CC" stroke-width="2" stroke-linecap="round"/><circle cx="16" cy="16" r="4" stroke="#0052CC" stroke-width="2"/></svg>',
		'title' => 'Реализации политики Российской Федерации в области сертификации и стандартизации',
	),
	array(
		'icon'  => '<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16 4L20 12L28 13L22 19L24 28L16 24L8 28L10 19L4 13L12 12L16 4Z" stroke="#0052CC" stroke-width="2" stroke-linejoin="round"/></svg>',
		'title' => 'Повышение конкурентоспособности организаций, как на внутреннем, так и на международном рынке товаров и услуг',
	),
	array(
		'icon'  => '<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8 16L14 22L24 10" stroke="#0052CC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><rect x="4" y="4" width="24" height="24" rx="4" stroke="#0052CC" stroke-width="2"/></svg>',
		'title' => 'Оказание высококвалифицированных услуг организациям и учреждениям в области подтверждения соответствия',
	),
);

// Попытка получить карточки из ACF
for ( $i = 1; $i <= 3; $i++ ) {
	$card = function_exists( 'get_field' ) ? get_field( 'gociss_about_goal_' . $i ) : null;
	if ( $card && ! empty( $card['title'] ) ) {
		$goals_cards[ $i - 1 ]['title'] = $card['title'];
		if ( ! empty( $card['icon'] ) ) {
			$goals_cards[ $i - 1 ]['icon'] = $card['icon'];
		}
	}
}
?>

<section class="about-goals" id="goals">
	<div class="container">
		<?php if ( $goals_title ) : ?>
			<h2 class="about-goals__title"><?php echo esc_html( $goals_title ); ?></h2>
		<?php endif; ?>

		<?php if ( $goals_subtitle ) : ?>
			<p class="about-goals__subtitle"><?php echo esc_html( $goals_subtitle ); ?></p>
		<?php endif; ?>

		<div class="about-goals__grid">
			<?php foreach ( $goals_cards as $card ) : ?>
				<div class="about-goals__card">
					<div class="about-goals__card-icon">
						<?php echo $card['icon']; ?>
					</div>
					<p class="about-goals__card-title"><?php echo esc_html( $card['title'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

