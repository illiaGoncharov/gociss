<?php
/**
 * Секция преимуществ
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$advantages_title    = function_exists( 'get_field' ) ? get_field( 'gociss_advantages_title' ) : '';
$advantages_subtitle = function_exists( 'get_field' ) ? get_field( 'gociss_advantages_subtitle' ) : '';
$advantages_items    = function_exists( 'get_field' ) ? get_field( 'gociss_advantages_items' ) : '';

// Заглушки
if ( ! $advantages_title ) {
	$advantages_title = 'Наши конкурентные преимущества';
}
if ( ! $advantages_subtitle ) {
	$advantages_subtitle = 'Почему клиенты выбирают именно нас для решения задач сертификации';
}
?>

<section class="advantages">
	<div class="container">
		<?php if ( $advantages_title ) : ?>
			<h2 class="advantages__title"><?php echo esc_html( $advantages_title ); ?></h2>
		<?php endif; ?>

		<?php if ( $advantages_subtitle ) : ?>
			<p class="advantages__subtitle"><?php echo esc_html( $advantages_subtitle ); ?></p>
		<?php endif; ?>

		<div class="advantages__grid">
			<?php if ( $advantages_items && is_array( $advantages_items ) && count( $advantages_items ) > 0 ) : ?>
				<?php foreach ( $advantages_items as $advantage ) : ?>
				<div class="advantages__item">
					<?php if ( ! empty( $advantage['icon'] ) ) : ?>
						<div class="advantages__icon">
							<?php
							echo wp_get_attachment_image(
								$advantage['icon']['ID'],
								'thumbnail',
								false,
								array(
									'alt' => esc_attr( $advantage['icon']['alt'] ),
								)
							);
							?>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $advantage['text'] ) ) : ?>
						<p class="advantages__text"><?php echo esc_html( $advantage['text'] ); ?></p>
					<?php endif; ?>
				</div>
				<?php endforeach; ?>
			<?php else : ?>
				<!-- Заглушки преимуществ -->
				<div class="advantages__item">
					<div class="advantages__icon">🏢</div>
					<p class="advantages__text">Наличие государственной аккредитации (Росаккредитация)</p>
				</div>
				<div class="advantages__item">
					<div class="advantages__icon">📖</div>
					<p class="advantages__text">Законность оформляемых заключений и сертификатов СМК</p>
				</div>
				<div class="advantages__item">
					<div class="advantages__icon">✅</div>
					<p class="advantages__text">Стабильно высокое качество работ по подтверждению ИСО</p>
				</div>
				<div class="advantages__item">
					<div class="advantages__icon">🔍</div>
					<p class="advantages__text">Объективность и достоверность предоставляемых сведений</p>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>



