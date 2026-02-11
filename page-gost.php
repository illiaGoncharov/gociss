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
	<nav class="breadcrumbs" aria-label="Хлебные крошки">
		<div class="container">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a>
			<span class="breadcrumbs__separator">→</span>
			<span class="breadcrumbs__current">ГОСТы</span>
		</div>
	</nav>

	<!-- Hero секция -->
	<?php get_template_part( 'template-parts/gost/hero' ); ?>

	<!-- Секция стандартов -->
	<?php get_template_part( 'template-parts/gost/standards' ); ?>
</main>

<?php
get_footer();


