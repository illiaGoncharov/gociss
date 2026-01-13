<?php
/**
 * Hero секция для страницы услуги (Custom Post Type)
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Получаем данные из ACF (поля для кастомного типа записей)
$service_banner     = function_exists( 'get_field' ) ? get_field( 'gociss_service_hero_image' ) : '';
$service_subtitle   = function_exists( 'get_field' ) ? get_field( 'gociss_service_hero_subtitle' ) : '';
$service_short_desc = function_exists( 'get_field' ) ? get_field( 'gociss_service_short_desc' ) : '';

// Получаем категории услуги для breadcrumbs
$service_terms = get_the_terms( get_the_ID(), 'gociss_service_cat' );
$primary_term  = null;
$parent_term   = null;
if ( $service_terms && ! is_wp_error( $service_terms ) ) {
	// Берем первую категорию
	$primary_term = $service_terms[0];
	// Проверяем, есть ли родительская категория
	if ( $primary_term->parent > 0 ) {
		$parent_term = get_term( $primary_term->parent, 'gociss_service_cat' );
	}
}

// Заглушки
$hero_title = get_the_title() . ' в аккредитованном органе<br>без посредников и переплат';

$hero_bullets = array(
	'Государственная аккредитация',
	'Официальное оформление',
	'Короткие сроки получения',
	'Работаем по всей России',
);

$hero_btn_primary = array(
	'text' => 'Обратный звонок',
	'url'  => '#form',
);

$hero_btn_secondary = array(
	'text' => 'Рассчитать стоимость',
	'url'  => '#pricing',
);

// URL баннера для фона
$banner_url = '';
if ( $service_banner && ! empty( $service_banner['url'] ) ) {
	$banner_url = $service_banner['url'];
}
?>

<!-- Баннер -->
<section class="service-banner">
	<!-- Breadcrumb -->
	<div class="container">
		<nav class="breadcrumbs" aria-label="Хлебные крошки">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a>
			<span class="breadcrumbs__separator">/</span>
			<a href="<?php echo esc_url( get_post_type_archive_link( 'gociss_service' ) ); ?>">Услуги</a>
			<?php if ( $parent_term && ! is_wp_error( $parent_term ) ) : ?>
				<span class="breadcrumbs__separator">/</span>
				<a href="<?php echo esc_url( get_term_link( $parent_term ) ); ?>"><?php echo esc_html( $parent_term->name ); ?></a>
			<?php endif; ?>
			<?php if ( $primary_term && ! is_wp_error( $primary_term ) ) : ?>
				<span class="breadcrumbs__separator">/</span>
				<a href="<?php echo esc_url( get_term_link( $primary_term ) ); ?>"><?php echo esc_html( $primary_term->name ); ?></a>
			<?php endif; ?>
			<span class="breadcrumbs__separator">/</span>
			<span class="breadcrumbs__current"><?php echo esc_html( get_the_title() ); ?></span>
		</nav>
	</div>

	<!-- Hero баннер с фоновым изображением и контентом (на всю ширину) -->
	<div class="service-banner__hero" <?php echo $banner_url ? 'style="background-image: url(' . esc_url( $banner_url ) . ');"' : ''; ?>>
		<div class="container">
			<div class="service-banner__hero-content">
				<!-- Заголовок -->
				<h1 class="service-banner__title"><?php echo wp_kses_post( $hero_title ); ?></h1>

				<?php if ( $service_subtitle ) : ?>
					<p class="service-banner__subtitle"><?php echo esc_html( $service_subtitle ); ?></p>
				<?php endif; ?>

				<!-- Буллеты -->
				<?php if ( ! empty( $hero_bullets ) ) : ?>
					<ul class="service-banner__bullets">
						<?php foreach ( $hero_bullets as $bullet ) : ?>
							<li class="service-banner__bullet"><?php echo esc_html( $bullet ); ?></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>

				<!-- Кнопки -->
				<div class="service-banner__buttons">
					<?php if ( ! empty( $hero_btn_primary['text'] ) ) : ?>
						<a href="<?php echo esc_url( $hero_btn_primary['url'] ?? '#form' ); ?>" class="service-banner__btn service-banner__btn--primary">
							<?php echo esc_html( $hero_btn_primary['text'] ); ?>
						</a>
					<?php endif; ?>

					<?php if ( ! empty( $hero_btn_secondary['text'] ) ) : ?>
						<a href="<?php echo esc_url( $hero_btn_secondary['url'] ?? '#pricing' ); ?>" class="service-banner__btn service-banner__btn--secondary">
							<?php echo esc_html( $hero_btn_secondary['text'] ); ?>
						</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Секция описания -->
<?php if ( $service_short_desc || has_excerpt() ) : ?>
<section class="service-about">
	<div class="container">
		<div class="service-about__content">
			<div class="service-about__text">
				<h2 class="service-about__title"><?php echo esc_html( get_the_title() ); ?></h2>

				<div class="service-about__description">
					<?php
					if ( $service_short_desc ) {
						echo wp_kses_post( $service_short_desc );
					} elseif ( has_excerpt() ) {
						echo wp_kses_post( get_the_excerpt() );
					}
					?>
				</div>

				<a href="#form" class="service-about__btn">
					Бесплатная консультация
				</a>
			</div>

			<?php if ( has_post_thumbnail() ) : ?>
			<div class="service-about__image">
				<?php the_post_thumbnail( 'large', array( 'class' => 'service-about__cert-img' ) ); ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>
<?php endif; ?>

