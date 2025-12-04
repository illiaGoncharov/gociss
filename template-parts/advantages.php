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
				<?php
				$icon_index = 1;
				foreach ( $advantages_items as $advantage ) :
				?>
				<div class="advantages__item">
					<div class="advantages__icon">
						<?php if ( ! empty( $advantage['icon'] ) && ! empty( $advantage['icon']['ID'] ) ) : ?>
							<?php
							echo wp_get_attachment_image(
								$advantage['icon']['ID'],
								'thumbnail',
								false,
								array(
									'alt' => esc_attr( $advantage['icon']['alt'] ?? '' ),
								)
							);
							?>
						<?php else : ?>
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/advantages/' . $icon_index . '.svg' ); ?>" alt="">
						<?php endif; ?>
					</div>

					<?php if ( ! empty( $advantage['text'] ) ) : ?>
						<p class="advantages__text"><?php echo esc_html( $advantage['text'] ); ?></p>
					<?php endif; ?>
				</div>
				<?php
				$icon_index++;
				endforeach;
				?>
			<?php else : ?>
				<!-- Заглушки преимуществ -->
				<div class="advantages__item">
					<div class="advantages__icon">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/advantages/1.svg' ); ?>" alt="">
					</div>
					<p class="advantages__text">Наличие государственной аккредитации (Росаккредитация)</p>
				</div>
				<div class="advantages__item">
					<div class="advantages__icon">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/advantages/2.svg' ); ?>" alt="">
					</div>
					<p class="advantages__text">Законность оформляемых заключений и сертификатов СМК</p>
				</div>
				<div class="advantages__item">
					<div class="advantages__icon">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/advantages/3.svg' ); ?>" alt="">
					</div>
					<p class="advantages__text">Стабильно высокое качество работ по подтверждению ИСО</p>
				</div>
				<div class="advantages__item">
					<div class="advantages__icon">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/advantages/4.svg' ); ?>" alt="">
					</div>
					<p class="advantages__text">Объективность и достоверность предоставляемых сведений</p>
				</div>
				<div class="advantages__item">
					<div class="advantages__icon">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/advantages/5.svg' ); ?>" alt="">
					</div>
					<p class="advantages__text">Отсутствие посредников и переплат за оказываемые услуги</p>
				</div>
				<div class="advantages__item">
					<div class="advantages__icon">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/advantages/6.svg' ); ?>" alt="">
					</div>
					<p class="advantages__text">Оперативная доставка документов по всем субъектам РФ</p>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>



