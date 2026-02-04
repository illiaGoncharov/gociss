<?php
/**
 * Шаблон страницы категории услуг
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

// Текущая категория
$current_term = get_queried_object();
$cat_icon     = function_exists( 'get_field' ) ? get_field( 'gociss_service_cat_icon', 'gociss_service_cat_' . $current_term->term_id ) : null;
$cat_desc     = function_exists( 'get_field' ) ? get_field( 'gociss_service_cat_desc', 'gociss_service_cat_' . $current_term->term_id ) : '';

// Получаем подкатегории текущей категории (оптимизированный запрос)
$child_categories = get_terms(
	array(
		'taxonomy'               => 'gociss_service_cat',
		'hide_empty'             => false,
		'parent'                 => $current_term->term_id,
		'orderby'                => 'menu_order',
		'order'                  => 'ASC',
		'update_term_meta_cache' => true,
	)
);

// Получаем родительскую категорию (если есть)
$parent_term = null;
if ( $current_term->parent > 0 ) {
	$parent_term = get_term( $current_term->parent, 'gociss_service_cat' );
}
?>

<main class="services-archive services-archive--category">
	<div class="container">
		<!-- Хлебные крошки -->
		<nav class="breadcrumbs" aria-label="Хлебные крошки">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a>
			<span class="breadcrumbs__separator">→</span>
			<a href="<?php echo esc_url( get_post_type_archive_link( 'gociss_service' ) ); ?>">Услуги</a>
			<?php if ( $parent_term && ! is_wp_error( $parent_term ) ) : ?>
				<span class="breadcrumbs__separator">→</span>
				<a href="<?php echo esc_url( get_term_link( $parent_term ) ); ?>"><?php echo esc_html( $parent_term->name ); ?></a>
			<?php endif; ?>
			<span class="breadcrumbs__separator">→</span>
			<span class="breadcrumbs__current"><?php echo esc_html( $current_term->name ); ?></span>
		</nav>

		<!-- Заголовок категории -->
		<div class="services-archive__header">
			<?php if ( $cat_icon && ! empty( $cat_icon['url'] ) ) : ?>
				<div class="services-archive__icon">
					<img src="<?php echo esc_url( $cat_icon['url'] ); ?>" alt="<?php echo esc_attr( $current_term->name ); ?>">
				</div>
			<?php endif; ?>
			<h1 class="services-archive__title"><?php echo esc_html( $current_term->name ); ?></h1>
			<?php if ( $cat_desc || $current_term->description ) : ?>
				<p class="services-archive__subtitle"><?php echo esc_html( $cat_desc ? $cat_desc : $current_term->description ); ?></p>
			<?php endif; ?>
		</div>

		<!-- Подкатегории (если есть) -->
		<?php if ( ! empty( $child_categories ) && ! is_wp_error( $child_categories ) ) : ?>
			<section class="services-archive__section">
				<h2 class="services-archive__section-title">Подвиды сертификации</h2>
				<div class="services-archive__grid services-archive__grid--subcategories">
					<?php foreach ( $child_categories as $subcategory ) : ?>
						<?php
						$subcat_icon = function_exists( 'get_field' ) ? get_field( 'gociss_service_cat_icon', 'gociss_service_cat_' . $subcategory->term_id ) : null;
						$subcat_desc = function_exists( 'get_field' ) ? get_field( 'gociss_service_cat_desc', 'gociss_service_cat_' . $subcategory->term_id ) : '';
						?>
						<article class="service-card service-card--subcategory">
							<div class="service-card__icon">
								<?php if ( $subcat_icon && ! empty( $subcat_icon['url'] ) ) : ?>
									<img src="<?php echo esc_url( $subcat_icon['url'] ); ?>" alt="<?php echo esc_attr( $subcategory->name ); ?>">
								<?php else : ?>
									<svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
										<rect width="48" height="48" rx="8" fill="#F3F4F6"/>
										<path d="M16 32V16H22L24 18H32V32H16Z" stroke="#6B7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>
								<?php endif; ?>
							</div>
							<h3 class="service-card__title"><?php echo esc_html( $subcategory->name ); ?></h3>
							<p class="service-card__description">
								<?php
								if ( $subcat_desc ) {
									echo esc_html( $subcat_desc );
								} elseif ( $subcategory->description ) {
									echo esc_html( $subcategory->description );
								}
								?>
							</p>
							<a href="<?php echo esc_url( get_term_link( $subcategory ) ); ?>" class="service-card__link">
								Подробнее
								<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M3 8H13M13 8L8 3M13 8L8 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							</a>
						</article>
					<?php endforeach; ?>
				</div>
			</section>
		<?php endif; ?>

		<!-- Услуги в категории -->
		<?php if ( have_posts() ) : ?>
			<section class="services-archive__section services-archive__section--services">
				<h2 class="services-archive__section-title">
					<?php
					/* translators: %s: category name */
					printf( esc_html__( 'Услуги в категории "%s"', 'gociss' ), esc_html( $current_term->name ) );
					?>
				</h2>
				<div class="services-archive__grid">
					<?php
					while ( have_posts() ) :
						the_post();
						$service_icon = function_exists( 'get_field' ) ? get_field( 'gociss_service_icon' ) : null;
						$service_desc = function_exists( 'get_field' ) ? get_field( 'gociss_service_short_desc' ) : '';
						?>
						<article class="service-card">
							<div class="service-card__icon">
								<?php if ( $service_icon && ! empty( $service_icon['url'] ) ) : ?>
									<img src="<?php echo esc_url( $service_icon['url'] ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
								<?php elseif ( has_post_thumbnail() ) : ?>
									<?php the_post_thumbnail( 'gociss-service-icon' ); ?>
								<?php else : ?>
									<svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
										<rect width="64" height="64" rx="12" fill="#E8F0FE"/>
										<path d="M20 44V20H28L32 24H44V44H20Z" stroke="#0052CC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>
								<?php endif; ?>
							</div>
							<h3 class="service-card__title"><?php the_title(); ?></h3>
							<p class="service-card__description">
								<?php
								if ( $service_desc ) {
									echo esc_html( $service_desc );
								} elseif ( has_excerpt() ) {
									echo esc_html( get_the_excerpt() );
								}
								?>
							</p>
							<a href="<?php the_permalink(); ?>" class="service-card__link">
								Подробнее
								<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M3 8H13M13 8L8 3M13 8L8 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							</a>
						</article>
					<?php endwhile; ?>
				</div>
			</section>
			<?php wp_reset_postdata(); ?>
		<?php elseif ( empty( $child_categories ) ) : ?>
			<div class="services-archive__empty">
				<p><?php esc_html_e( 'В данной категории пока нет услуг.', 'gociss' ); ?></p>
				<a href="<?php echo esc_url( get_post_type_archive_link( 'gociss_service' ) ); ?>" class="btn btn--primary">
					<?php esc_html_e( 'Все услуги', 'gociss' ); ?>
				</a>
			</div>
		<?php endif; ?>
	</div>
</main>

<?php get_footer(); ?>

