<?php
/**
 * Секция география (карта России)
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$geo_title   = function_exists( 'get_field' ) ? get_field( 'gociss_geo_title' ) : '';
$geo_btn     = function_exists( 'get_field' ) ? get_field( 'gociss_geo_btn' ) : '';
$geo_map     = function_exists( 'get_field' ) ? get_field( 'gociss_geo_map' ) : '';

// Заглушки
if ( ! $geo_title ) {
	$geo_title = 'РАБОТАЕМ ПО ВСЕЙ РОССИИ';
}
?>

<section class="geography" id="geography">
	<div class="container">
		<div class="geography__content">
			<div class="geography__text">
				<h2 class="geography__title"><?php echo esc_html( $geo_title ); ?></h2>

				<?php if ( $geo_btn && ! empty( $geo_btn['text'] ) ) : ?>
					<a href="<?php echo esc_url( $geo_btn['url'] ); ?>" class="geography__btn">
						<?php echo esc_html( $geo_btn['text'] ); ?>
					</a>
				<?php else : ?>
					<a href="tel:+74951234567" class="geography__btn">ПОЗВОНИТЬ НАМ</a>
				<?php endif; ?>
			</div>

			<div class="geography__map">
				<?php if ( $geo_map && ! empty( $geo_map['url'] ) ) : ?>
					<img src="<?php echo esc_url( $geo_map['url'] ); ?>" alt="<?php echo esc_attr( $geo_map['alt'] ?? 'Карта России' ); ?>">
				<?php else : ?>
					<!-- Placeholder для карты -->
					<div class="geography__map-placeholder">
						<span>Загрузите карту через ACF</span>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>




