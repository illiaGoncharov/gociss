<?php
/**
 * Секция "Аттестат аккредитации"
 * Изображение документа слева + информация справа с цветными иконками
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ACF поля
$cert_title  = function_exists( 'get_field' ) ? get_field( 'gociss_accred_page_cert_title' ) : '';
$cert_image  = function_exists( 'get_field' ) ? get_field( 'gociss_accred_page_cert_image' ) : '';
$cert_number = function_exists( 'get_field' ) ? get_field( 'gociss_accred_page_cert_number' ) : '';
$cert_org    = function_exists( 'get_field' ) ? get_field( 'gociss_accred_page_cert_org' ) : '';
$cert_date   = function_exists( 'get_field' ) ? get_field( 'gociss_accred_page_cert_date' ) : '';
$cert_status = function_exists( 'get_field' ) ? get_field( 'gociss_accred_page_cert_status' ) : '';
$cert_note   = function_exists( 'get_field' ) ? get_field( 'gociss_accred_page_cert_note' ) : '';

// Заглушки
if ( ! $cert_title ) {
	$cert_title = 'Аттестат аккредитации';
}
if ( ! $cert_number ) {
	$cert_number = 'RA.RU.13СМ43';
}
if ( ! $cert_org ) {
	$cert_org = 'Федеральная служба по аккредитации (Росаккредитация)';
}
if ( ! $cert_date ) {
	$cert_date = '17 апреля 2015 года';
}
if ( ! $cert_status ) {
	$cert_status = 'Действующая аккредитация';
}
if ( ! $cert_note ) {
	$cert_note = 'Аттестат аккредитации подтверждает компетентность нашего центра в области сертификации продукции и услуг согласно требованиям российского законодательства.';
}

// Изображение сертификата
$cert_image_url = $cert_image && isset( $cert_image['url'] ) ? $cert_image['url'] : get_template_directory_uri() . '/assets/images/sertificate.png';
?>

<section class="accred-cert">
	<div class="container">
		<h2 class="accred-cert__title"><?php echo esc_html( $cert_title ); ?></h2>

		<div class="accred-cert__grid">
			<!-- Изображение сертификата -->
			<div class="accred-cert__image">
				<div class="accred-cert__image-wrapper">
					<img src="<?php echo esc_url( $cert_image_url ); ?>" alt="<?php echo esc_attr( $cert_title ); ?>">
				</div>
			</div>

			<!-- Информация -->
			<div class="accred-cert__info">
				<!-- Номер аттестата -->
				<div class="accred-cert__item">
					<div class="accred-cert__item-icon accred-cert__item-icon--blue">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
							<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
							<polyline points="14 2 14 8 20 8"/>
							<line x1="16" y1="13" x2="8" y2="13"/>
							<line x1="16" y1="17" x2="8" y2="17"/>
						</svg>
					</div>
					<div class="accred-cert__item-content">
						<span class="accred-cert__item-label">Номер аттестата</span>
						<span class="accred-cert__item-value"><?php echo esc_html( $cert_number ); ?></span>
					</div>
				</div>

				<!-- Орган аккредитации -->
				<div class="accred-cert__item">
					<div class="accred-cert__item-icon accred-cert__item-icon--green">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
							<path d="M3 21h18"/>
							<path d="M5 21V7l8-4v18"/>
							<path d="M19 21V11l-6-4"/>
							<path d="M9 9v.01"/>
							<path d="M9 12v.01"/>
							<path d="M9 15v.01"/>
							<path d="M9 18v.01"/>
						</svg>
					</div>
					<div class="accred-cert__item-content">
						<span class="accred-cert__item-label">Орган аккредитации</span>
						<span class="accred-cert__item-value"><?php echo esc_html( $cert_org ); ?></span>
					</div>
				</div>

				<!-- Дата аккредитации -->
				<div class="accred-cert__item">
					<div class="accred-cert__item-icon accred-cert__item-icon--orange">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
							<rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
							<line x1="16" y1="2" x2="16" y2="6"/>
							<line x1="8" y1="2" x2="8" y2="6"/>
							<line x1="3" y1="10" x2="21" y2="10"/>
						</svg>
					</div>
					<div class="accred-cert__item-content">
						<span class="accred-cert__item-label">Дата аккредитации</span>
						<span class="accred-cert__item-value"><?php echo esc_html( $cert_date ); ?></span>
					</div>
				</div>

				<!-- Статус -->
				<div class="accred-cert__item">
					<div class="accred-cert__item-icon accred-cert__item-icon--red">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
							<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
							<polyline points="22 4 12 14.01 9 11.01"/>
						</svg>
					</div>
					<div class="accred-cert__item-content">
						<span class="accred-cert__item-label">Статус</span>
						<span class="accred-cert__item-value"><?php echo esc_html( $cert_status ); ?></span>
					</div>
				</div>

				<!-- Примечание -->
				<div class="accred-cert__note">
					<?php echo esc_html( $cert_note ); ?>
				</div>
			</div>
		</div>
	</div>
</section>

