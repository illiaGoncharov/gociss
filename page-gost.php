<?php
/**
 * Template Name: ГОСТы
 *
 * Шаблон страницы с нормативной базой ГОСТов
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main class="gost-page">
	<!-- Хлебные крошки -->
	<section class="breadcrumbs">
		<div class="container">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a>
			<span class="breadcrumbs__separator">&rarr;</span>
			<span class="breadcrumbs__current">ГОСТы</span>
		</div>
	</section>

	<!-- Hero секция -->
	<?php get_template_part( 'template-parts/gost/hero' ); ?>

	<!-- Секция стандартов -->
	<?php get_template_part( 'template-parts/gost/standards' ); ?>
</main>

<?php
get_footer();

