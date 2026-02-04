<?php
/**
 * Template Name: О компании
 *
 * Шаблон страницы "О компании"
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main class="about-page">
	<!-- Хлебные крошки -->
	<section class="breadcrumbs">
		<div class="container">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a>
			<span class="breadcrumbs__separator">&rarr;</span>
			<span class="breadcrumbs__current">О компании</span>
		</div>
	</section>

<?php
// Подключаем все секции страницы "О компании"
get_template_part( 'template-parts/about/hero' );
get_template_part( 'template-parts/about/organization' );
get_template_part( 'template-parts/about/accreditation' );
get_template_part( 'template-parts/about/goals' );
get_template_part( 'template-parts/geography' );
get_template_part( 'template-parts/about/partners' );
get_template_part( 'template-parts/about/reviews' );
get_template_part( 'template-parts/about/documents' );
get_template_part( 'template-parts/form' );
?>
</main>

<?php
get_footer();

