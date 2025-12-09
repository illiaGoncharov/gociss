<?php
/**
 * Секция стоимости услуги
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Получаем данные из ACF
$pricing_title    = function_exists( 'get_field' ) ? get_field( 'gociss_service_pricing_title' ) : '';
$pricing_subtitle = function_exists( 'get_field' ) ? get_field( 'gociss_service_pricing_subtitle' ) : '';
$pricing_items    = function_exists( 'get_field' ) ? get_field( 'gociss_service_pricing_items' ) : '';

// Заглушки
if ( ! $pricing_title ) {
	$pricing_title = 'Стоимость сертификации';
}
if ( ! $pricing_subtitle ) {
	$pricing_subtitle = 'Все цены указаны для одного юридического лица/ИП';
}

// Заглушки для карточек
$default_pricing = array(
	array(
		'icon'        => '',
		'title'       => 'Консультация',
		'description' => 'Бесплатная первичная консультация',
		'price'       => 'Бесплатно',
		'button_text' => 'Записаться',
		'button_url'  => '#form',
	),
	array(
		'icon'        => '',
		'title'       => 'Сертификация ISO 9001',
		'description' => 'Сертификат сроком на 3 года',
		'price'       => 'от 15 000 ₽',
		'button_text' => 'Заказать',
		'button_url'  => '#form',
	),
	array(
		'icon'        => '',
		'title'       => 'Сертификация ISO 45001',
		'description' => 'Сертификат сроком на 3 года',
		'price'       => 'от 40 000 ₽',
		'button_text' => 'Заказать',
		'button_url'  => '#form',
	),
	array(
		'icon'        => '',
		'title'       => 'Комплексная сертификация',
		'description' => 'ISO 9001 + ISO 45001 + ISO 14001',
		'price'       => 'от 50 000 ₽',
		'button_text' => 'Заказать',
		'button_url'  => '#form',
	),
);

$pricing_to_show = ( $pricing_items && is_array( $pricing_items ) && count( $pricing_items ) > 0 ) ? $pricing_items : $default_pricing;
?>

<section class="service-pricing" id="pricing">
	<div class="container">
		<?php if ( $pricing_title ) : ?>
			<h2 class="service-pricing__title"><?php echo esc_html( $pricing_title ); ?></h2>
		<?php endif; ?>

		<?php if ( $pricing_subtitle ) : ?>
			<p class="service-pricing__subtitle"><?php echo esc_html( $pricing_subtitle ); ?></p>
		<?php endif; ?>

		<div class="service-pricing__grid">
			<?php foreach ( $pricing_to_show as $item ) : ?>
				<div class="service-pricing__card">
					<div class="service-pricing__card-header">
						<?php if ( ! empty( $item['icon'] ) && ! empty( $item['icon']['ID'] ) ) : ?>
							<div class="service-pricing__card-icon">
								<?php
								echo wp_get_attachment_image(
									$item['icon']['ID'],
									'thumbnail',
									false,
									array( 'alt' => '' )
								);
								?>
							</div>
						<?php else : ?>
							<div class="service-pricing__card-icon">
								<svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
									<rect width="48" height="48" rx="8" fill="#EBF4FF"/>
									<path d="M24 16V32M16 24H32" stroke="#0052CC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							</div>
						<?php endif; ?>

						<?php if ( ! empty( $item['title'] ) ) : ?>
							<h3 class="service-pricing__card-title"><?php echo esc_html( $item['title'] ); ?></h3>
						<?php endif; ?>
					</div>

					<?php if ( ! empty( $item['description'] ) ) : ?>
						<p class="service-pricing__card-description"><?php echo esc_html( $item['description'] ); ?></p>
					<?php endif; ?>

					<?php if ( ! empty( $item['price'] ) ) : ?>
						<div class="service-pricing__card-price"><?php echo esc_html( $item['price'] ); ?></div>
					<?php endif; ?>

					<?php
					$btn_text = ! empty( $item['button_text'] ) ? $item['button_text'] : 'Заказать';
					$btn_url  = ! empty( $item['button_url'] ) ? $item['button_url'] : '#form';
					?>
					<a href="<?php echo esc_url( $btn_url ); ?>" class="service-pricing__card-btn">
						<?php echo esc_html( $btn_text ); ?>
					</a>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
