<?php
/**
 * Шаблон главной страницы (лендинг)
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<?php
// Подключаем все секции лендинга
get_template_part( 'template-parts/hero' );
get_template_part( 'template-parts/stats' );
get_template_part( 'template-parts/services' );
get_template_part( 'template-parts/advantages' );
get_template_part( 'template-parts/experts' );
get_template_part( 'template-parts/news' );
get_template_part( 'template-parts/faq' );
get_template_part( 'template-parts/cta' );
get_template_part( 'template-parts/form' );
?>

<?php
get_footer();



