<?php
/**
 * Секция "Признание и легитимность"
 * 3 карточки с аккредитацией
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ACF поля
$accred_title    = function_exists( 'get_field' ) ? get_field( 'gociss_about_accred_title' ) : '';
$accred_subtitle = function_exists( 'get_field' ) ? get_field( 'gociss_about_accred_subtitle' ) : '';

// Заглушки
if ( ! $accred_title ) {
	$accred_title = 'Признание и легитимность';
}
if ( ! $accred_subtitle ) {
	$accred_subtitle = 'Наша компания аккредитована ведущими международными организациями и имеет все необходимые лицензии для проведения сертификации';
}

// Карточки аккредитации (заглушки)
$accred_cards = array(
	array(
		'icon'        => get_template_directory_uri() . '/assets/images/about/Vector.png',
		'title'       => 'Аккредитация Росаккредитации',
		'description' => 'Аттестат аккредитации № RA.RU.21CT50 на право проведения работ по сертификации систем менеджмента',
		'link_text'   => 'Действует до 15.03.2027',
		'link_url'    => '#',
	),
	array(
		'icon'        => get_template_directory_uri() . '/assets/images/about/Vector-1.png',
		'title'       => 'ISO/IEC 17021-1',
		'description' => 'Соответствие международному стандарту для органов, проводящих аудит и сертификацию систем менеджмента',
		'link_text'   => 'Сертификат № 2024-ISO-001',
		'link_url'    => '#',
	),
	array(
		'icon'        => get_template_directory_uri() . '/assets/images/about/Vector-2.png',
		'title'       => 'Международное признание',
		'description' => 'Член IAF (International Accreditation Forum) и участник соглашений о взаимном признании',
		'link_text'   => 'Членство с 2015 года',
		'link_url'    => '#',
	),
);

// Попытка получить карточки из ACF
for ( $i = 1; $i <= 3; $i++ ) {
	$card = function_exists( 'get_field' ) ? get_field( 'gociss_about_accred_card_' . $i ) : null;
	if ( $card && ! empty( $card['title'] ) ) {
		$accred_cards[ $i - 1 ] = array_merge( $accred_cards[ $i - 1 ], $card );
	}
}
?>

<section class="about-accred" id="accreditation">
	<div class="container">
		<?php if ( $accred_title ) : ?>
			<h2 class="about-accred__title"><?php echo esc_html( $accred_title ); ?></h2>
		<?php endif; ?>

		<?php if ( $accred_subtitle ) : ?>
			<p class="about-accred__subtitle"><?php echo esc_html( $accred_subtitle ); ?></p>
		<?php endif; ?>

		<div class="about-accred__grid">
			<?php foreach ( $accred_cards as $card ) : ?>
				<div class="about-accred__card">
					<div class="about-accred__card-icon">
						<?php if ( is_string( $card['icon'] ) && strpos( $card['icon'], 'http' ) === 0 || strpos( $card['icon'], '/' ) === 0 ) : ?>
							<img src="<?php echo esc_url( $card['icon'] ); ?>" alt="">
						<?php else : ?>
							<?php echo $card['icon']; ?>
						<?php endif; ?>
					</div>
					<h3 class="about-accred__card-title"><?php echo esc_html( $card['title'] ); ?></h3>
					<p class="about-accred__card-description"><?php echo esc_html( $card['description'] ); ?></p>
					<?php if ( ! empty( $card['link_text'] ) ) : ?>
						<?php if ( ! empty( $card['link_url'] ) && $card['link_url'] !== '#' ) : ?>
							<a href="<?php echo esc_url( $card['link_url'] ); ?>" class="about-accred__card-link">
								<?php echo esc_html( $card['link_text'] ); ?>
							</a>
						<?php else : ?>
							<span class="about-accred__card-link"><?php echo esc_html( $card['link_text'] ); ?></span>
						<?php endif; ?>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

