<?php
/**
 * Секция призыва к действию
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$cta_label       = function_exists( 'get_field' ) ? get_field( 'gociss_cta_label' ) : '';
$cta_title       = function_exists( 'get_field' ) ? get_field( 'gociss_cta_title' ) : '';
$cta_description = function_exists( 'get_field' ) ? get_field( 'gociss_cta_description' ) : '';
$cta_btn_primary = function_exists( 'get_field' ) ? get_field( 'gociss_cta_btn_primary' ) : '';
$cta_btn_secondary = function_exists( 'get_field' ) ? get_field( 'gociss_cta_btn_secondary' ) : '';

// Заглушки
if ( ! $cta_label ) {
	$cta_label = 'Начните прямо сейчас';
}
if ( ! $cta_title ) {
	$cta_title = 'Готовы начать сертификацию?';
}
if ( ! $cta_description ) {
	$cta_description = 'Получите бесплатную консультацию эксперта и узнайте точные сроки и стоимость сертификации для вашего продукта';
}
?>

<section class="cta" id="cta">
	<div class="container">
		<div class="cta__content">
			<?php if ( $cta_label ) : ?>
				<span class="cta__label">
					<span class="cta__label-dot"></span>
					<?php echo esc_html( $cta_label ); ?>
				</span>
			<?php endif; ?>

			<?php if ( $cta_title ) : ?>
				<h2 class="cta__title"><?php echo esc_html( $cta_title ); ?></h2>
			<?php endif; ?>

			<?php if ( $cta_description ) : ?>
				<p class="cta__description"><?php echo esc_html( $cta_description ); ?></p>
			<?php endif; ?>

			<div class="cta__buttons">
				<?php if ( $cta_btn_primary && ! empty( $cta_btn_primary['text'] ) ) : ?>
					<a href="<?php echo esc_url( $cta_btn_primary['url'] ); ?>" class="cta__btn cta__btn--outline">
						<?php echo esc_html( $cta_btn_primary['text'] ); ?>
					</a>
				<?php else : ?>
					<a href="#form" class="cta__btn cta__btn--outline">Получить консультацию</a>
				<?php endif; ?>

				<?php if ( $cta_btn_secondary && ! empty( $cta_btn_secondary['text'] ) ) : ?>
					<a href="<?php echo esc_url( $cta_btn_secondary['url'] ); ?>" class="cta__btn cta__btn--filled">
						<?php echo esc_html( $cta_btn_secondary['text'] ); ?>
					</a>
				<?php else : ?>
					<a href="#callback" class="cta__btn cta__btn--filled">Заказать обратный звонок</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>


