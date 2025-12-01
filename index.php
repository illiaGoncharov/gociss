<?php
/**
 * Главный шаблон
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<?php
// Если это главная страница, используем шаблон лендинга
if ( is_front_page() ) {
	get_template_part( 'template-parts/content', 'front' );
} else {
	// Обычный контент
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			get_template_part( 'template-parts/content', get_post_type() );
		}
	} else {
		get_template_part( 'template-parts/content', 'none' );
	}
}
?>

<?php
get_footer();



