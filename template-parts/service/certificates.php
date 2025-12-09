<?php
/**
 * Секция примеров сертификатов
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Получаем данные из ACF
$certs_title    = function_exists( 'get_field' ) ? get_field( 'gociss_service_certs_title' ) : '';
$certs_subtitle = function_exists( 'get_field' ) ? get_field( 'gociss_service_certs_subtitle' ) : '';

// Собираем карточки из отдельных group полей (от 0 до 4)
$certs_items = array();
for ( $i = 1; $i <= 4; $i++ ) {
	$cert = function_exists( 'get_field' ) ? get_field( 'gociss_service_cert_card_' . $i ) : null;
	if ( $cert && ! empty( $cert['title'] ) ) {
		$certs_items[] = $cert;
	}
}

// Заглушки для заголовков
if ( ! $certs_title ) {
	$certs_title = 'Примеры сертификатов';
}
if ( ! $certs_subtitle ) {
	$certs_subtitle = 'Образцы сертификатов ISO 45001 различных типов';
}

// Дефолтные карточки если ничего не заполнено
if ( empty( $certs_items ) ) {
	$certs_items = array(
		array(
			'image'       => '',
			'badge_text'  => 'Добровольная сертификация',
			'badge_color' => '#0052CC',
			'title'       => 'Система добровольной сертификации',
			'description' => 'Сертификат в системе добровольной сертификации менеджмента качества, зарегистрированной в Росстандарте',
			'price'       => '15 000 ₽',
		),
		array(
			'image'       => '',
			'badge_text'  => 'Аккредитация ФСА',
			'badge_color' => '#7C3AED',
			'title'       => 'Аккредитованный ФСА',
			'description' => 'Сертификат органа по сертификации, аккредитованного в Федеральной службе по аккредитации',
			'price'       => 'от 40 000 ₽',
		),
		array(
			'image'       => '',
			'badge_text'  => 'Аккредитация IAF',
			'badge_color' => '#EA580C',
			'title'       => 'Международная аккредитация',
			'description' => 'Сертификат с аккредитацией IAF (International Accreditation Forum) - международное признание',
			'price'       => 'от 60 000 ₽',
		),
	);
}
?>

<section class="service-certs" id="certificates">
	<div class="container">
		<?php if ( $certs_title ) : ?>
			<h2 class="service-certs__title"><?php echo esc_html( $certs_title ); ?></h2>
		<?php endif; ?>

		<?php if ( $certs_subtitle ) : ?>
			<p class="service-certs__subtitle"><?php echo esc_html( $certs_subtitle ); ?></p>
		<?php endif; ?>

		<div class="service-certs__grid">
			<?php foreach ( $certs_items as $cert ) : ?>
				<div class="service-certs__card">
					<!-- Изображение с бейджем -->
					<div class="service-certs__card-image">
						<?php if ( ! empty( $cert['image'] ) && ! empty( $cert['image']['url'] ) ) : ?>
							<img src="<?php echo esc_url( $cert['image']['url'] ); ?>" alt="<?php echo esc_attr( $cert['title'] ?? '' ); ?>">
						<?php else : ?>
							<div class="service-certs__card-placeholder"></div>
						<?php endif; ?>

					<?php
					// Бейдж показываем если есть текст
					$badge_text  = isset( $cert['badge_text'] ) ? trim( $cert['badge_text'] ) : '';
					$badge_color = isset( $cert['badge_color'] ) && ! empty( $cert['badge_color'] ) ? $cert['badge_color'] : '#0052CC';
					if ( $badge_text ) :
					?>
						<span class="service-certs__card-badge" style="background-color: <?php echo esc_attr( $badge_color ); ?>;">
							<?php echo esc_html( $badge_text ); ?>
						</span>
					<?php endif; ?>
					</div>

					<!-- Контент -->
					<div class="service-certs__card-content">
						<?php if ( ! empty( $cert['title'] ) ) : ?>
							<h3 class="service-certs__card-title"><?php echo esc_html( $cert['title'] ); ?></h3>
						<?php endif; ?>

						<?php if ( ! empty( $cert['description'] ) ) : ?>
							<p class="service-certs__card-description"><?php echo esc_html( $cert['description'] ); ?></p>
						<?php endif; ?>

						<?php if ( ! empty( $cert['price'] ) ) : ?>
							<div class="service-certs__card-price" style="color: <?php echo esc_attr( $badge_color ); ?>;">
								<?php echo esc_html( $cert['price'] ); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
