<?php
/**
 * Секция партнёров и ресурсов
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$partners_actions = function_exists( 'get_field' ) ? get_field( 'gociss_partners_actions' ) : '';
$partners_items   = function_exists( 'get_field' ) ? get_field( 'gociss_partners_items' ) : '';

// Заглушки действий
$default_actions = array(
	array(
		'icon'  => 'zay_w.png.png',
		'title' => 'Заявка на почту',
		'url'   => 'mailto:info@gociss.ru',
	),
	array(
		'icon'  => 'oper_w.png.png',
		'title' => 'Консультация',
		'url'   => '#form',
	),
	array(
		'icon'  => 'phone_w.png.png',
		'title' => 'Звонок',
		'url'   => 'tel:+74951234567',
	),
);

// Заглушки партнёров
$default_partners = array(
	array(
		'title' => 'Правительство РФ',
		'url'   => 'https://government.ru/',
	),
	array(
		'title' => 'Министерство экономического развития РФ',
		'url'   => 'https://www.economy.gov.ru/',
	),
	array(
		'title' => 'Федеральная служба по аккредитации',
		'url'   => 'https://fsa.gov.ru/',
	),
	array(
		'title' => 'ЕИС закупки',
		'url'   => 'https://zakupki.gov.ru/',
	),
	array(
		'title' => 'МИНПРОМТОРГ',
		'url'   => 'https://minpromtorg.gov.ru/',
	),
	array(
		'title' => 'РОССТАНДАРТ',
		'url'   => 'https://www.rst.gov.ru/',
	),
	array(
		'title' => 'ГОСУСЛУГИ',
		'url'   => 'https://www.gosuslugi.ru/',
	),
	array(
		'title' => 'ЧЕСТНЫЙ ЗНАК',
		'url'   => 'https://chestnyznak.ru/',
	),
);

$actions_to_show  = ( $partners_actions && is_array( $partners_actions ) && count( $partners_actions ) > 0 ) ? $partners_actions : $default_actions;
$partners_to_show = ( $partners_items && is_array( $partners_items ) && count( $partners_items ) > 0 ) ? $partners_items : $default_partners;
?>

<section class="partners" id="partners">
	<div class="container">
		<!-- Быстрые действия -->
		<div class="partners__actions">
			<?php foreach ( $actions_to_show as $action ) : ?>
				<a href="<?php echo esc_url( $action['url'] ?? '#' ); ?>" class="partners__action">
					<div class="partners__action-icon">
						<?php if ( ! empty( $action['icon_image'] ) && ! empty( $action['icon_image']['url'] ) ) : ?>
							<img src="<?php echo esc_url( $action['icon_image']['url'] ); ?>" alt="<?php echo esc_attr( $action['title'] ?? '' ); ?>">
						<?php else : ?>
							<?php
							$icon_file = $action['icon'] ?? 'zay_w.png.png';
							$icon_path = get_template_directory_uri() . '/assets/images/pre-footer/' . $icon_file;
							?>
							<img src="<?php echo esc_url( $icon_path ); ?>" alt="<?php echo esc_attr( $action['title'] ?? '' ); ?>">
						<?php endif; ?>
					</div>
					<span class="partners__action-title"><?php echo esc_html( $action['title'] ?? '' ); ?></span>
				</a>
			<?php endforeach; ?>
		</div>

		<!-- Сетка партнёров -->
		<div class="partners__grid">
			<?php
			$index = 0;
			foreach ( $partners_to_show as $partner ) :
				$index++;
			?>
				<a href="<?php echo esc_url( $partner['url'] ?? '#' ); ?>" class="partners__item" target="_blank" rel="noopener noreferrer">
					<?php if ( ! empty( $partner['image'] ) && ! empty( $partner['image']['url'] ) ) : ?>
						<img src="<?php echo esc_url( $partner['image']['url'] ); ?>" alt="<?php echo esc_attr( $partner['title'] ?? '' ); ?>">
					<?php else : ?>
						<!-- Placeholder -->
						<div class="partners__item-placeholder">
							<span><?php echo esc_html( $partner['title'] ?? 'Партнёр ' . $index ); ?></span>
						</div>
					<?php endif; ?>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>



