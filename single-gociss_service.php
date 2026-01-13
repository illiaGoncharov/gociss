<?php
/**
 * Шаблон отдельной услуги (Custom Post Type)
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

// Получаем данные услуги
$service_hero_image    = function_exists( 'get_field' ) ? get_field( 'gociss_service_hero_image' ) : null;
$service_hero_subtitle = function_exists( 'get_field' ) ? get_field( 'gociss_service_hero_subtitle' ) : '';
$show_accreditation    = function_exists( 'get_field' ) ? get_field( 'gociss_accreditation_show' ) : false;

// Получаем категории услуги для breadcrumbs
$service_terms = get_the_terms( get_the_ID(), 'gociss_service_cat' );
$primary_term  = null;
if ( $service_terms && ! is_wp_error( $service_terms ) ) {
	$primary_term = $service_terms[0];
}
?>

<main class="service-single">
	<?php
	// Hero секция для кастомного типа записей
	get_template_part( 'template-parts/service/hero-single' );

	// Секция аккредитации (если включена)
	if ( $show_accreditation ) {
		get_template_part( 'template-parts/service/accreditation' );
	}

	// Секция ценообразования
	get_template_part( 'template-parts/service/pricing' );

	// Процесс сертификации
	get_template_part( 'template-parts/service/process' );

	// Сертификаты
	get_template_part( 'template-parts/service/certificates' );

	// CTA секция
	get_template_part( 'template-parts/cta' );

	// Отзывы
	get_template_part( 'template-parts/service/reviews' );

	// FAQ (использует gociss_service_faq_items для услуг)
	get_template_part( 'template-parts/service/faq-single' );

	// Географический охват
	get_template_part( 'template-parts/geography' );

	// Форма обратной связи
	get_template_part( 'template-parts/form' );

	// Партнеры
	get_template_part( 'template-parts/partners' );
	?>
</main>

<?php get_footer(); ?>

