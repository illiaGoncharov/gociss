<?php
/**
 * Секция услуг (фиксированные поля ACF)
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$services_title    = function_exists( 'get_field' ) ? get_field( 'gociss_services_title' ) : '';
$services_subtitle = function_exists( 'get_field' ) ? get_field( 'gociss_services_subtitle' ) : '';

if ( ! $services_title ) {
	$services_title = 'Ключевые направления';
}
if ( ! $services_subtitle ) {
	$services_subtitle = 'Полный спектр сертификационных услуг для различных отраслей и стандартов качества';
}

// Собираем услуги из фиксированных полей
$services = array();
for ( $i = 1; $i <= 8; $i++ ) {
	$icon  = function_exists( 'get_field' ) ? get_field( 'gociss_service_' . $i . '_icon' ) : null;
	$title = function_exists( 'get_field' ) ? get_field( 'gociss_service_' . $i . '_title' ) : '';
	$desc  = function_exists( 'get_field' ) ? get_field( 'gociss_service_' . $i . '_desc' ) : '';
	$link  = function_exists( 'get_field' ) ? get_field( 'gociss_service_' . $i . '_link' ) : '';

	if ( $title ) {
		$services[] = array(
			'icon'  => $icon,
			'title' => $title,
			'desc'  => $desc,
			'link'  => $link,
		);
	}
}

// Заглушки, если нет данных
$default_services = array(
	array( 'title' => 'Сертификация ISO', 'desc' => 'ISO 9001, ISO 14001, ISO 45001, ISO 27001 и другие международные стандарты качества' ),
	array( 'title' => 'Оценка опыта и деловой репутации', 'desc' => 'Экспертная оценка квалификации участников закупок для государственных и коммерческих тендеров' ),
	array( 'title' => 'Сертификация продукции ТР ТС/ ЕАЭС', 'desc' => 'Обязательная сертификация и декларирование соответствия техническим регламентам ЕАЭС' ),
	array( 'title' => 'Сертификация персонала', 'desc' => 'Подтверждение профессиональной компетентности специалистов в различных областях деятельности' ),
	array( 'title' => 'Регистрация систем добровольной сертификации', 'desc' => 'Создание и регистрация собственных систем добровольной сертификации в Росаккредитации' ),
	array( 'title' => 'Учебный центр', 'desc' => 'Обучение и повышение квалификации специалистов по стандартам качества и сертификации' ),
);

$services_to_show = ! empty( $services ) ? $services : $default_services;
?>

<section class="services" id="services">
	<div class="container">
		<h2 class="services__title"><?php echo esc_html( $services_title ); ?></h2>
		<p class="services__subtitle"><?php echo esc_html( $services_subtitle ); ?></p>

		<div class="services__grid">
			<?php
			$icon_index = 1;
			foreach ( $services_to_show as $service ) :
				?>
				<div class="services__item">
					<div class="services__icon">
						<?php if ( ! empty( $service['icon'] ) && ! empty( $service['icon']['ID'] ) ) : ?>
							<?php
							echo wp_get_attachment_image(
								$service['icon']['ID'],
								'thumbnail',
								false,
								array( 'alt' => esc_attr( $service['title'] ) )
							);
							?>
						<?php else : ?>
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/directions/' . $icon_index . '.svg' ); ?>" alt="">
						<?php endif; ?>
					</div>

					<h3 class="services__item-title"><?php echo esc_html( $service['title'] ); ?></h3>

					<?php if ( ! empty( $service['desc'] ) ) : ?>
						<p class="services__item-description"><?php echo esc_html( $service['desc'] ); ?></p>
					<?php endif; ?>

					<?php if ( ! empty( $service['link'] ) ) : ?>
						<a href="<?php echo esc_url( $service['link'] ); ?>" class="services__item-link">Подробнее →</a>
					<?php else : ?>
						<a href="#" class="services__item-link">Подробнее →</a>
					<?php endif; ?>
				</div>
				<?php
				$icon_index++;
			endforeach;
			?>
		</div>

		<div class="services__footer">
			<a href="<?php echo esc_url( get_post_type_archive_link( 'gociss_service' ) ?: '#services' ); ?>" class="btn">Посмотреть все услуги →</a>
		</div>
	</div>
</section>
