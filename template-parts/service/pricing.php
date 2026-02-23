<?php
/**
 * Секция стоимости услуги
 * Поддерживает региональные значения
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Получаем данные с учётом региона (региональное значение или fallback на общее)
$pricing_title = '';
if ( function_exists( 'gociss_get_regional_field' ) ) {
	$pricing_title = gociss_get_regional_field( 'gociss_region_pricing_title', 'gociss_service_pricing_title' );
} elseif ( function_exists( 'get_field' ) ) {
	$pricing_title = get_field( 'gociss_service_pricing_title' );
}

$pricing_subtitle = function_exists( 'gociss_get_regional_field' )
	? gociss_get_regional_field( 'gociss_region_pricing_subtitle', 'gociss_service_pricing_subtitle' )
	: ( function_exists( 'get_field' ) ? get_field( 'gociss_service_pricing_subtitle' ) : '' );

$pricing_form_raw       = function_exists( 'get_field' ) ? get_field( 'gociss_service_pricing_form_shortcode' ) : '';
$pricing_form_shortcode = function_exists( 'gociss_get_cf7_shortcode' ) ? gociss_get_cf7_shortcode( $pricing_form_raw ) : $pricing_form_raw;

// Собираем карточки из отдельных group полей
$pricing_items = array();
for ( $i = 1; $i <= 4; $i++ ) {
	$card = function_exists( 'get_field' ) ? get_field( 'gociss_service_pricing_card_' . $i ) : null;
	if ( $card && ! empty( $card['title'] ) ) {
		$pricing_items[] = $card;
	}
}

// Заглушки
if ( ! $pricing_title ) {
	$pricing_title = 'Стоимость сертификации';
}
if ( ! $pricing_subtitle ) {
	$pricing_subtitle = 'Выберите подходящий вариант сертификации ISO 45001';
}

// Иконки по умолчанию из папки service/price (SVG)
$default_icons = array(
	get_template_directory_uri() . '/assets/images/service/price/Vector.svg',
	get_template_directory_uri() . '/assets/images/service/price/Vector-1.svg',
	get_template_directory_uri() . '/assets/images/service/price/Vector-2.svg',
	get_template_directory_uri() . '/assets/images/service/price/Group.svg',
);

// Заглушки для карточек если ACF не заполнен
if ( empty( $pricing_items ) ) {
	$pricing_items = array(
		array(
			'title'       => 'Консультация',
			'description' => 'Предоставление необходимой информации по вариантам и порядку оформления сертификатов',
			'price'       => 'Бесплатно',
			'button_text' => 'Получить консультацию',
			'button_url'  => '#form',
		),
		array(
			'title'       => 'Сертификация ИСО 45001',
			'description' => 'в Системе добровольной сертификации менеджмента качества, зарегистрированной в Росстандарте',
			'price'       => '15 000 ₽',
			'button_text' => 'Заказать',
			'button_url'  => '#form',
		),
		array(
			'title'       => 'Сертификация ИСО 45001',
			'description' => 'в органе по сертификации аккредитованном в Федеральной службе по аккредитации (ФСА)',
			'price'       => 'от 40 000 ₽',
			'button_text' => 'Заказать',
			'button_url'  => '#form',
		),
		array(
			'title'       => 'Сертификация ИСО 45001',
			'description' => 'в органе по сертификации с аккредитацией IAF (International Accreditation Forum)',
			'price'       => 'от 60 000 ₽',
			'button_text' => 'Заказать',
			'button_url'  => '#form',
		),
	);
}
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
			<?php
			$card_index = 0;
			foreach ( $pricing_items as $item ) :
				?>
				<div class="service-pricing__card">
					<!-- Иконка -->
					<div class="service-pricing__card-icon">
						<?php if ( ! empty( $item['icon'] ) && ! empty( $item['icon']['url'] ) ) : ?>
							<img src="<?php echo esc_url( $item['icon']['url'] ); ?>" alt="">
						<?php else : ?>
							<img src="<?php echo esc_url( $default_icons[ $card_index % 4 ] ); ?>" alt="">
						<?php endif; ?>
					</div>

					<!-- Заголовок -->
					<?php if ( ! empty( $item['title'] ) ) : ?>
						<h3 class="service-pricing__card-title"><?php echo esc_html( $item['title'] ); ?></h3>
					<?php endif; ?>

					<!-- Описание -->
					<?php if ( ! empty( $item['description'] ) ) : ?>
						<p class="service-pricing__card-description"><?php echo esc_html( $item['description'] ); ?></p>
					<?php endif; ?>

					<!-- Цена -->
					<?php $display_price = ! empty( $item['price'] ) ? $item['price'] : ''; ?>
					<?php if ( ! empty( $display_price ) ) : ?>
						<div class="service-pricing__card-price"><?php echo esc_html( $display_price ); ?></div>
					<?php endif; ?>

					<!-- Кнопка -->
					<?php
					$btn_text = ! empty( $item['button_text'] ) ? $item['button_text'] : 'Заказать';
					$btn_url  = ! empty( $item['button_url'] ) ? $item['button_url'] : '#form';
					?>
					<a href="<?php echo esc_url( $btn_url ); ?>" class="service-pricing__card-btn">
						<?php echo esc_html( $btn_text ); ?>
					</a>
				</div>
				<?php
				$card_index++;
			endforeach;
			?>
		</div>

		<?php if ( ! empty( $pricing_form_shortcode ) ) : ?>
			<?php
			$pricing_form_title = function_exists( 'get_field' ) ? get_field( 'gociss_service_pricing_form_title' ) : '';
			if ( ! $pricing_form_title ) {
				$pricing_form_title = 'Оставить заявку';
			}
			$pricing_design = 'default';
			if ( $pricing_form_raw && is_numeric( $pricing_form_raw ) && function_exists( 'gociss_detect_form_design' ) ) {
				$pricing_design = gociss_detect_form_design( (int) $pricing_form_raw );
			}
			?>
			<?php
			switch ( $pricing_design ) {
				case 'consult':
					echo '<div class="service-pricing__form">';
					get_template_part( 'template-parts/forms/embedded-consult', null, array(
						'shortcode'  => $pricing_form_shortcode,
						'title'      => $pricing_form_title,
						'form_id'    => $pricing_form_raw,
						'is_consult' => true,
					) );
					echo '</div>';
					break;
				case 'horizontal':
					get_template_part( 'template-parts/forms/application-horizontal', null, array(
						'cf7_shortcode' => $pricing_form_shortcode,
					) );
					break;
				case 'callback':
					get_template_part( 'template-parts/forms/callback-simple', null, array(
						'cf7_shortcode' => $pricing_form_shortcode,
					) );
					break;
				case 'vertical':
					get_template_part( 'template-parts/forms/application-vertical', null, array(
						'cf7_shortcode' => $pricing_form_shortcode,
					) );
					break;
				default:
					echo '<div class="service-pricing__form">';
					get_template_part( 'template-parts/forms/embedded-consult', null, array(
						'shortcode' => $pricing_form_shortcode,
						'title'     => $pricing_form_title,
						'form_id'   => $pricing_form_raw,
					) );
					echo '</div>';
					break;
			}
			?>
		<?php endif; ?>
	</div>
</section>
