<?php
/**
 * Секция услуг
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$services_title    = get_field( 'gociss_services_title' );
$services_subtitle = get_field( 'gociss_services_subtitle' );
$services_items    = get_field( 'gociss_services_items' );

if ( ! $services_items ) {
	return;
}
?>

<section class="services" id="services">
	<div class="container">
		<?php if ( $services_title ) : ?>
			<h2 class="services__title"><?php echo esc_html( $services_title ); ?></h2>
		<?php endif; ?>

		<?php if ( $services_subtitle ) : ?>
			<p class="services__subtitle"><?php echo esc_html( $services_subtitle ); ?></p>
		<?php endif; ?>

		<div class="services__grid">
			<?php foreach ( $services_items as $service ) : ?>
				<div class="services__item">
					<?php if ( ! empty( $service['icon'] ) ) : ?>
						<div class="services__icon">
							<?php
							echo wp_get_attachment_image(
								$service['icon']['ID'],
								'thumbnail',
								false,
								array(
									'alt' => esc_attr( $service['icon']['alt'] ),
								)
							);
							?>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $service['title'] ) ) : ?>
						<h3 class="services__item-title"><?php echo esc_html( $service['title'] ); ?></h3>
					<?php endif; ?>

					<?php if ( ! empty( $service['description'] ) ) : ?>
						<p class="services__item-description"><?php echo esc_html( $service['description'] ); ?></p>
					<?php endif; ?>

					<?php if ( ! empty( $service['link'] ) ) : ?>
						<a href="<?php echo esc_url( $service['link'] ); ?>" class="services__item-link">
							Подробнее →
						</a>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>

		<div class="services__footer">
			<a href="#services" class="btn btn--primary">Посмотреть все услуги →</a>
		</div>
	</div>
</section>



