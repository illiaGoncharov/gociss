<?php
/**
 * Hero секция
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$hero_label        = get_field( 'gociss_hero_label' );
$hero_title        = get_field( 'gociss_hero_title' );
$hero_description  = get_field( 'gociss_hero_description' );
$hero_image        = get_field( 'gociss_hero_image' );
$hero_btn_primary = get_field( 'gociss_hero_btn_primary' );
$hero_btn_secondary = get_field( 'gociss_hero_btn_secondary' );
$hero_stats        = get_field( 'gociss_hero_stats' );

if ( ! $hero_title ) {
	return;
}
?>

<section class="hero">
	<div class="container">
		<div class="hero__content">
			<div class="hero__text">
				<?php if ( $hero_label ) : ?>
					<span class="hero__label"><?php echo esc_html( $hero_label ); ?></span>
				<?php endif; ?>

				<h1 class="hero__title"><?php echo esc_html( $hero_title ); ?></h1>

				<?php if ( $hero_description ) : ?>
					<p class="hero__description"><?php echo esc_html( $hero_description ); ?></p>
				<?php endif; ?>

				<div class="hero__buttons">
					<?php if ( $hero_btn_primary && ! empty( $hero_btn_primary['text'] ) ) : ?>
						<a href="<?php echo esc_url( $hero_btn_primary['url'] ); ?>" class="btn btn--primary">
							<?php echo esc_html( $hero_btn_primary['text'] ); ?>
						</a>
					<?php endif; ?>

					<?php if ( $hero_btn_secondary && ! empty( $hero_btn_secondary['text'] ) ) : ?>
						<a href="<?php echo esc_url( $hero_btn_secondary['url'] ); ?>" class="btn btn--secondary">
							<?php echo esc_html( $hero_btn_secondary['text'] ); ?>
						</a>
					<?php endif; ?>
				</div>

				<?php if ( $hero_stats ) : ?>
					<div class="hero__stats">
						<?php foreach ( $hero_stats as $stat ) : ?>
							<div class="hero__stat">
								<span class="hero__stat-number"><?php echo esc_html( $stat['number'] ); ?></span>
								<span class="hero__stat-label"><?php echo esc_html( $stat['label'] ); ?></span>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>

			<?php if ( $hero_image ) : ?>
				<div class="hero__image">
					<?php
					echo wp_get_attachment_image(
						$hero_image['ID'],
						'gociss-hero',
						false,
						array(
							'alt' => esc_attr( $hero_image['alt'] ),
							'class' => 'hero__img',
						)
					);
					?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>



