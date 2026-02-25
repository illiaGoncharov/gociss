<?php
/**
 * Секция аккредитации для страницы услуги
 *
 * Структура:
 * 1. 4 информационных блока сверху (grid 4 колонки)
 * 2. Основной блок: изображение сертификата + текст + кнопка
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Проверяем, нужно ли показывать секцию
$show_accreditation = function_exists( 'get_field' ) ? get_field( 'gociss_accreditation_show' ) : false;

if ( ! $show_accreditation ) {
	return;
}

// Получаем данные из ACF
$accreditation_title       = function_exists( 'get_field' ) ? get_field( 'gociss_accreditation_title' ) : '';
$accreditation_info_blocks = function_exists( 'get_field' ) ? get_field( 'gociss_accreditation_info_blocks' ) : array();
$accreditation_cert_image  = function_exists( 'get_field' ) ? get_field( 'gociss_accreditation_cert_image' ) : null;
$accreditation_text        = function_exists( 'get_field' ) ? get_field( 'gociss_accreditation_text' ) : '';
$accreditation_button_text = function_exists( 'get_field' ) ? get_field( 'gociss_accreditation_button_text' ) : '';
$accreditation_button_url  = function_exists( 'get_field' ) ? get_field( 'gociss_accreditation_button_url' ) : '';

// Заглушки
if ( ! $accreditation_title ) {
	$accreditation_title = 'Аккредитация';
}

if ( ! $accreditation_button_text ) {
	$accreditation_button_text = 'Заказать звонок';
}
if ( ! $accreditation_button_url ) {
	$accreditation_button_url = '#form';
}

// Заглушки для информационных блоков
if ( empty( $accreditation_info_blocks ) ) {
	$accreditation_info_blocks = array(
		array(
			'title'       => 'Знак национальной системы аккредитации',
			'description' => 'Подтверждает соответствие органа по сертификации требованиям национальной системы аккредитации',
		),
		array(
			'title'       => 'Уникальный номер органа по сертификации',
			'description' => 'Регистрационный номер в едином реестре аккредитованных органов',
		),
		array(
			'title'       => 'Реестровый номер бланка строгой отчётности',
			'description' => 'Номер учета бланка сертификата в государственном реестре',
		),
		array(
			'title'       => 'Регистрационный номер сертификата в ОС ИСМ',
			'description' => 'Номер сертификата в системе органа по сертификации',
		),
	);
}

// Заглушка для текста
if ( ! $accreditation_text ) {
	$accreditation_text = '<p>Орган по сертификации «ГоЦИСС» аккредитован в национальной системе аккредитации. Номер аттестата аккредитации: <strong>RA.RU.13CM43</strong>.</p><p>Аккредитация подтверждает компетентность органа по сертификации и соответствие международным стандартам качества.</p>';
}
?>

<section class="accreditation" id="accreditation">
	<div class="container">
		<!-- Основной блок -->
		<div class="accreditation__main">
			<!-- Изображение сертификата (ссылка на страницу аккредитации) -->
			<div class="accreditation__image">
				<a href="<?php echo esc_url( home_url( '/akkreditaciya/' ) ); ?>" target="_blank" rel="noopener noreferrer">
				<?php if ( $accreditation_cert_image && ! empty( $accreditation_cert_image['ID'] ) ) : ?>
					<?php
					echo wp_get_attachment_image(
						$accreditation_cert_image['ID'],
						'gociss-accreditation-cert',
						false,
						array(
							'alt'   => esc_attr( $accreditation_cert_image['alt'] ?? 'Аттестат аккредитации' ),
							'class' => 'accreditation__cert-img',
						)
					);
					?>
				<?php else : ?>
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/sertificate.png' ); ?>" alt="Аттестат аккредитации" class="accreditation__cert-img">
				<?php endif; ?>
				</a>
			</div>

			<!-- Контент -->
			<div class="accreditation__content">
				<h2 class="accreditation__title"><?php echo esc_html( $accreditation_title ); ?></h2>

				<?php if ( $accreditation_text ) : ?>
					<div class="accreditation__text">
						<?php echo wp_kses_post( $accreditation_text ); ?>
					</div>
				<?php endif; ?>

				<div class="accreditation__button">
					<a href="<?php echo esc_url( $accreditation_button_url ); ?>" class="btn btn--primary">
						<?php echo esc_html( $accreditation_button_text ); ?>
					</a>
				</div>
			</div>
		</div>
	</div>
</section>






