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
$certs_title       = function_exists( 'get_field' ) ? get_field( 'gociss_service_certs_title' ) : '';
$certs_subtitle    = function_exists( 'get_field' ) ? get_field( 'gociss_service_certs_subtitle' ) : '';
$certs_items       = function_exists( 'get_field' ) ? get_field( 'gociss_service_certs_items' ) : '';
$certs_description = function_exists( 'get_field' ) ? get_field( 'gociss_service_certs_description' ) : '';

// Заглушки
if ( ! $certs_title ) {
	$certs_title = 'Примеры сертификатов';
}
if ( ! $certs_subtitle ) {
	$certs_subtitle = 'Образцы сертификатов ISO 45001, оформленных нашим органом';
}
?>

<section class="service-certificates" id="certificates">
	<div class="container">
		<?php if ( $certs_title ) : ?>
			<h2 class="service-certificates__title"><?php echo esc_html( $certs_title ); ?></h2>
		<?php endif; ?>

		<?php if ( $certs_subtitle ) : ?>
			<p class="service-certificates__subtitle"><?php echo esc_html( $certs_subtitle ); ?></p>
		<?php endif; ?>

		<div class="service-certificates__content">
			<!-- Главное изображение сертификата -->
			<div class="service-certificates__main">
				<?php if ( $certs_items && is_array( $certs_items ) && ! empty( $certs_items[0]['image'] ) ) : ?>
					<?php
					echo wp_get_attachment_image(
						$certs_items[0]['image']['ID'],
						'large',
						false,
						array(
							'alt'   => esc_attr( $certs_items[0]['image']['alt'] ?? 'Сертификат' ),
							'class' => 'service-certificates__main-img',
						)
					);
					?>
				<?php else : ?>
					<div class="service-certificates__placeholder">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/sertificate.png' ); ?>" alt="Пример сертификата" class="service-certificates__main-img">
					</div>
				<?php endif; ?>
			</div>

			<!-- Боковая панель с дополнительными сертификатами и описанием -->
			<div class="service-certificates__sidebar">
				<!-- Миниатюры сертификатов -->
				<?php if ( $certs_items && is_array( $certs_items ) && count( $certs_items ) > 1 ) : ?>
					<div class="service-certificates__thumbnails">
						<?php
						$thumb_index = 0;
						foreach ( $certs_items as $cert ) :
							if ( $thumb_index === 0 ) {
								$thumb_index++;
								continue; // Пропускаем первый, он в main
							}
							if ( ! empty( $cert['image'] ) && ! empty( $cert['image']['ID'] ) ) :
								?>
								<div class="service-certificates__thumb">
									<?php
									echo wp_get_attachment_image(
										$cert['image']['ID'],
										'medium',
										false,
										array(
											'alt'   => esc_attr( $cert['image']['alt'] ?? 'Сертификат' ),
											'class' => 'service-certificates__thumb-img',
										)
									);
									?>
									<?php if ( ! empty( $cert['caption'] ) ) : ?>
										<span class="service-certificates__thumb-caption"><?php echo esc_html( $cert['caption'] ); ?></span>
									<?php endif; ?>
								</div>
								<?php
							endif;
							$thumb_index++;
						endforeach;
						?>
					</div>
				<?php else : ?>
					<!-- Заглушки миниатюр -->
					<div class="service-certificates__thumbnails">
						<div class="service-certificates__thumb">
							<div class="service-certificates__thumb-placeholder">
								<span>Образец 2022</span>
							</div>
						</div>
						<div class="service-certificates__thumb">
							<div class="service-certificates__thumb-placeholder">
								<span>Образец 2023</span>
							</div>
						</div>
					</div>
				<?php endif; ?>

				<!-- Описание под миниатюрами -->
				<?php if ( $certs_description ) : ?>
					<div class="service-certificates__description">
						<?php echo wp_kses_post( $certs_description ); ?>
					</div>
				<?php else : ?>
					<div class="service-certificates__description">
						<p><strong>Что должен содержать сертификат:</strong></p>
						<ul>
							<li>Уникальный регистрационный номер</li>
							<li>Наименование и адрес организации</li>
							<li>Область сертификации</li>
							<li>Дату выдачи и срок действия</li>
							<li>Печать и подпись органа сертификации</li>
						</ul>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
