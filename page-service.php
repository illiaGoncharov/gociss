<?php
/**
 * Template Name: Страница услуги
 *
 * Шаблон для страницы отдельной услуги
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<?php
// Подключаем все секции страницы услуги
get_template_part( 'template-parts/service/hero' );

// Секция аккредитации (если включена)
$show_accreditation = function_exists( 'get_field' ) ? get_field( 'gociss_accreditation_show' ) : false;
if ( $show_accreditation ) {
	get_template_part( 'template-parts/service/accreditation' );
}

get_template_part( 'template-parts/service/pricing' );
get_template_part( 'template-parts/service/process' );
get_template_part( 'template-parts/service/certificates' );
get_template_part( 'template-parts/cta' );
get_template_part( 'template-parts/service/reviews' );
get_template_part( 'template-parts/faq' );
get_template_part( 'template-parts/news' );
get_template_part( 'template-parts/geography' );
get_template_part( 'template-parts/form' );
get_template_part( 'template-parts/partners' );
?>

<?php
get_footer();



