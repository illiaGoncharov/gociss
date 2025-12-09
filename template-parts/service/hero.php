<?php
/**
 * Hero секция страницы услуги
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Получаем данные из ACF
$service_label       = function_exists( 'get_field' ) ? get_field( 'gociss_service_label' ) : '';
$service_title       = function_exists( 'get_field' ) ? get_field( 'gociss_service_title' ) : '';
$service_description = function_exists( 'get_field' ) ? get_field( 'gociss_service_description' ) : '';
$service_image       = function_exists( 'get_field' ) ? get_field( 'gociss_service_image' ) : '';
$service_advantages  = function_exists( 'get_field' ) ? get_field( 'gociss_service_advantages' ) : '';

// Заглушки
if ( ! $service_title ) {
	$service_title = get_the_title();
}
if ( ! $service_description ) {
	$service_description = 'Профессиональная сертификация для вашего бизнеса с гарантией качества и соблюдением всех требований законодательства.';
}

// Получаем данные для breadcrumb
$parent_page = get_post( wp_get_post_parent_id( get_the_ID() ) );
?>

<section class="service-hero">
	<div class="container">
		<!-- Breadcrumb -->
		<nav class="service-hero__breadcrumb" aria-label="Хлебные крошки">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a>
			<span class="service-hero__breadcrumb-sep">/</span>
			<?php if ( $parent_page && $parent_page->ID ) : ?>
				<a href="<?php echo esc_url( get_permalink( $parent_page->ID ) ); ?>"><?php echo esc_html( $parent_page->post_title ); ?></a>
				<span class="service-hero__breadcrumb-sep">/</span>
			<?php else : ?>
				<a href="#">Услуги</a>
				<span class="service-hero__breadcrumb-sep">/</span>
			<?php endif; ?>
			<span class="service-hero__breadcrumb-current"><?php echo esc_html( get_the_title() ); ?></span>
		</nav>

		<div class="service-hero__content">
			<div class="service-hero__text">
				<?php if ( $service_label ) : ?>
					<span class="service-hero__label"><?php echo esc_html( $service_label ); ?></span>
				<?php endif; ?>

				<h1 class="service-hero__title"><?php echo esc_html( $service_title ); ?></h1>

				<?php if ( $service_description ) : ?>
					<div class="service-hero__description"><?php echo wp_kses_post( $service_description ); ?></div>
				<?php endif; ?>

				<!-- Преимущества услуги -->
				<?php if ( $service_advantages && is_array( $service_advantages ) && count( $service_advantages ) > 0 ) : ?>
					<div class="service-hero__advantages">
						<?php foreach ( $service_advantages as $advantage ) : ?>
							<div class="service-hero__advantage">
								<div class="service-hero__advantage-icon">
									<?php if ( ! empty( $advantage['icon'] ) && ! empty( $advantage['icon']['ID'] ) ) : ?>
										<?php
										echo wp_get_attachment_image(
											$advantage['icon']['ID'],
											'thumbnail',
											false,
											array( 'alt' => esc_attr( $advantage['icon']['alt'] ?? '' ) )
										);
										?>
									<?php else : ?>
										<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>
									<?php endif; ?>
								</div>
								<?php if ( ! empty( $advantage['text'] ) ) : ?>
									<span class="service-hero__advantage-text"><?php echo esc_html( $advantage['text'] ); ?></span>
								<?php endif; ?>
							</div>
						<?php endforeach; ?>
					</div>
				<?php else : ?>
					<!-- Заглушки преимуществ -->
					<div class="service-hero__advantages">
						<div class="service-hero__advantage">
							<div class="service-hero__advantage-icon">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							</div>
							<span class="service-hero__advantage-text">Международный стандарт безопасности</span>
						</div>
						<div class="service-hero__advantage">
							<div class="service-hero__advantage-icon">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							</div>
							<span class="service-hero__advantage-text">Уникальный номер в едином реестре сертификатов ФССП</span>
						</div>
						<div class="service-hero__advantage">
							<div class="service-hero__advantage-icon">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							</div>
							<span class="service-hero__advantage-text">Регистрация в реестре государственной аккредитации</span>
						</div>
						<div class="service-hero__advantage">
							<div class="service-hero__advantage-icon">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							</div>
							<span class="service-hero__advantage-text">Рекомендательный знак сертификации ФССП</span>
						</div>
					</div>
				<?php endif; ?>
			</div>

			<div class="service-hero__image">
				<?php if ( $service_image && ! empty( $service_image['ID'] ) ) : ?>
					<?php
					echo wp_get_attachment_image(
						$service_image['ID'],
						'large',
						false,
						array(
							'alt'   => esc_attr( $service_image['alt'] ?? $service_title ),
							'class' => 'service-hero__img',
						)
					);
					?>
				<?php else : ?>
					<div class="service-hero__placeholder">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/service/service.png' ); ?>" alt="<?php echo esc_attr( $service_title ); ?>" class="service-hero__img">
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
