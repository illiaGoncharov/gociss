<?php
/**
 * Шаблон архива услуг
 *
 * Страница "Виды сертификации" с категориями и подвидами услуг
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

// Оптимизированный запрос: получаем все категории за один запрос
$all_categories = get_terms(
	array(
		'taxonomy'               => 'gociss_service_cat',
		'hide_empty'             => false,
		'orderby'                => 'menu_order',
		'order'                  => 'ASC',
		'update_term_meta_cache' => true, // Кеширование мета-данных
	)
);

// Разделяем на родительские и дочерние категории
$parent_categories = array();
$child_categories  = array();

if ( ! empty( $all_categories ) && ! is_wp_error( $all_categories ) ) {
	foreach ( $all_categories as $category ) {
		if ( 0 === $category->parent ) {
			$parent_categories[] = $category;
		} else {
			$child_categories[] = $category;
		}
	}
}
?>

<main class="services-archive">
	<div class="container">
		<!-- Заголовок страницы -->
		<div class="services-archive__header">
			<h1 class="services-archive__title">Виды сертификации</h1>
			<p class="services-archive__subtitle">Полный спектр сертификационных услуг для различных отраслей и стандартов качества</p>
		</div>

		<!-- Основные категории -->
		<?php if ( ! empty( $parent_categories ) && ! is_wp_error( $parent_categories ) ) : ?>
			<section class="services-archive__section">
				<h2 class="services-archive__section-title">Основные категории</h2>
				<div class="services-archive__grid">
					<?php foreach ( $parent_categories as $category ) : ?>
						<?php
						$cat_icon_url = gociss_resolve_service_cat_icon( $category->term_id, 'archive' );
						$cat_desc     = function_exists( 'get_field' ) ? get_field( 'gociss_service_cat_desc', 'gociss_service_cat_' . $category->term_id ) : '';
						?>
						<article class="service-card">
							<div class="service-card__icon">
								<?php if ( $cat_icon_url ) : ?>
									<img src="<?php echo esc_url( $cat_icon_url ); ?>" alt="<?php echo esc_attr( $category->name ); ?>">
								<?php else : ?>
									<svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
										<rect width="64" height="64" rx="12" fill="#E8F0FE"/>
										<path d="M20 44V20H28L32 24H44V44H20Z" stroke="#0052CC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>
								<?php endif; ?>
							</div>
							<h3 class="service-card__title"><?php echo esc_html( $category->name ); ?></h3>
							<p class="service-card__description">
								<?php
								if ( $cat_desc ) {
									echo esc_html( $cat_desc );
								} elseif ( $category->description ) {
									echo esc_html( $category->description );
								} else {
									echo esc_html__( 'Профессиональная сертификация по данному направлению', 'gociss' );
								}
								?>
							</p>
							<a href="<?php echo esc_url( get_term_link( $category ) ); ?>" class="service-card__link">
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

		<!-- Подвиды (подкатегории) -->
		<?php if ( ! empty( $child_categories ) && ! is_wp_error( $child_categories ) ) : ?>
			<section class="services-archive__section services-archive__section--subcategories">
				<h2 class="services-archive__section-title">Подвиды сертификации</h2>
				<div class="services-archive__grid services-archive__grid--subcategories">
					<?php foreach ( $child_categories as $subcategory ) : ?>
						<?php
						$subcat_icon_url = gociss_resolve_service_cat_icon( $subcategory->term_id, 'archive' );
						$subcat_desc     = function_exists( 'get_field' ) ? get_field( 'gociss_service_cat_desc', 'gociss_service_cat_' . $subcategory->term_id ) : '';
						$parent_term     = get_term( $subcategory->parent, 'gociss_service_cat' );
						?>
						<article class="service-card service-card--subcategory">
							<div class="service-card__icon">
								<?php if ( $subcat_icon_url ) : ?>
									<img src="<?php echo esc_url( $subcat_icon_url ); ?>" alt="<?php echo esc_attr( $subcategory->name ); ?>">
								<?php else : ?>
									<svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
										<rect width="48" height="48" rx="8" fill="#F3F4F6"/>
										<path d="M16 32V16H22L24 18H32V32H16Z" stroke="#6B7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>
								<?php endif; ?>
							</div>
							<?php if ( $parent_term && ! is_wp_error( $parent_term ) ) : ?>
								<span class="service-card__parent"><?php echo esc_html( $parent_term->name ); ?></span>
							<?php endif; ?>
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

		<!-- Все услуги (если есть) -->
		<?php if ( have_posts() ) : ?>
			<section class="services-archive__section services-archive__section--services">
				<h2 class="services-archive__section-title">Все услуги</h2>
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
		<?php endif; ?>
	</div>
</main>

<?php get_footer(); ?>

