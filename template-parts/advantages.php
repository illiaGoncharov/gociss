<?php
/**
 * Секция преимуществ
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$advantages_title    = get_field( 'gociss_advantages_title' );
$advantages_subtitle = get_field( 'gociss_advantages_subtitle' );
$advantages_items    = get_field( 'gociss_advantages_items' );

if ( ! $advantages_items ) {
	return;
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
		</div>
	</div>
</section>



