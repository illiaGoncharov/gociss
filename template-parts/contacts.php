<?php
/**
 * Секция контактов
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Получаем данные из ACF
$title         = function_exists( 'get_field' ) ? get_field( 'gociss_contacts_title' ) : '';
$org_name      = function_exists( 'get_field' ) ? get_field( 'gociss_contacts_org_name' ) : '';
$requisites    = function_exists( 'get_field' ) ? get_field( 'gociss_contacts_requisites_pdf' ) : '';
$address_label = function_exists( 'get_field' ) ? get_field( 'gociss_contacts_address_label' ) : '';
$address       = function_exists( 'get_field' ) ? get_field( 'gociss_contacts_address' ) : '';
$data_label    = function_exists( 'get_field' ) ? get_field( 'gociss_contacts_data_label' ) : '';
$email         = function_exists( 'get_field' ) ? get_field( 'gociss_contacts_email' ) : '';
$phone         = function_exists( 'get_field' ) ? get_field( 'gociss_contacts_phone' ) : '';
$map_embed     = function_exists( 'get_field' ) ? get_field( 'gociss_contacts_map_embed' ) : '';

// Значения по умолчанию
if ( ! $title ) {
	$title = 'Контакты';
}
if ( ! $org_name ) {
	$org_name = 'Автономная некоммерческая организация "Головной центр испытаний, сертификации и стандартизации"';
}
if ( ! $address_label ) {
	$address_label = 'Адрес офиса:';
}
if ( ! $address ) {
	$address = 'г. Санкт-Петербург, ул. Парковая, дом 4, литера Д, офис 255';
}
if ( ! $data_label ) {
	$data_label = 'Контактные данные:';
}
if ( ! $email ) {
	$email = 'info@gociss.ru';
}
if ( ! $phone ) {
	$phone = '+7 (800) 551-02-36';
}
?>

<section class="contacts" id="contacts">
	<div class="container">
		<h1 class="contacts__title"><?php echo esc_html( $title ); ?></h1>

		<div class="contacts__wrapper">
			<div class="contacts__info">
				<!-- Карточка организации -->
				<div class="contacts__card contacts__card--org">
					<p class="contacts__org-name"><?php echo esc_html( $org_name ); ?></p>
					<?php if ( $requisites && ! empty( $requisites['url'] ) ) : ?>
						<a href="<?php echo esc_url( $requisites['url'] ); ?>" class="contacts__btn" target="_blank" rel="noopener noreferrer">
							Скачать реквизиты
						</a>
					<?php else : ?>
						<a href="#" class="contacts__btn">Скачать реквизиты</a>
					<?php endif; ?>
				</div>

				<!-- Адрес -->
				<div class="contacts__card contacts__card--address">
					<span class="contacts__label"><?php echo esc_html( $address_label ); ?></span>
					<p class="contacts__value"><?php echo esc_html( $address ); ?></p>
				</div>

				<!-- Контактные данные -->
				<div class="contacts__card contacts__card--data">
					<span class="contacts__label"><?php echo esc_html( $data_label ); ?></span>
					<a href="mailto:<?php echo esc_attr( $email ); ?>" class="contacts__link contacts__link--email"><?php echo esc_html( $email ); ?></a>
					<a href="tel:<?php echo esc_attr( preg_replace( '/[^+0-9]/', '', $phone ) ); ?>" class="contacts__link contacts__link--phone"><?php echo esc_html( $phone ); ?></a>
				</div>
			</div>
		</div>

		<!-- Яндекс Карта -->
		<div class="contacts__map">
			<?php if ( $map_embed ) : ?>
				<?php
				// Выводим код карты без экранирования (iframe/script)
				echo $map_embed; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				?>
			<?php else : ?>
				<!-- Заглушка карты -->
				<div class="contacts__map-placeholder"></div>
			<?php endif; ?>
		</div>

		<!-- Яндекс виджет рейтинга -->
		<?php
		$yandex_widget = function_exists( 'get_field' ) ? get_field( 'gociss_contacts_yandex_widget' ) : '';
		if ( $yandex_widget ) :
		?>
		<div class="contacts__yandex-widget">
			<?php
			// Выводим виджет без экранирования (iframe)
			echo $yandex_widget; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			?>
		</div>
		<?php endif; ?>
	</div>
</section>

