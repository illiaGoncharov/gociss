<?php
/**
 * Template Name: Учебный центр
 *
 * Шаблон страницы учебного центра с курсами и образовательными программами
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main class="edu-page">
	<!-- Хлебные крошки -->
	<nav class="breadcrumbs" aria-label="Хлебные крошки">
		<div class="container">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a>
			<span class="breadcrumbs__separator">→</span>
			<span class="breadcrumbs__current">Учебный центр</span>
		</div>
	</nav>

	<!-- Hero секция -->
	<?php get_template_part( 'template-parts/edu/hero' ); ?>

	<!-- Таблица курсов -->
	<?php get_template_part( 'template-parts/edu/courses-table' ); ?>

	<!-- Документы по результатам обучения -->
	<?php get_template_part( 'template-parts/edu/documents' ); ?>

	<!-- Лицензии и аккредитация -->
	<?php get_template_part( 'template-parts/edu/licenses' ); ?>

	<!-- Преимущества -->
	<?php get_template_part( 'template-parts/edu/advantages' ); ?>

	<!-- Работаем по всей России -->
	<?php get_template_part( 'template-parts/geography' ); ?>

	<!-- Отзывы клиентов -->
	<?php get_template_part( 'template-parts/service/reviews' ); ?>

	<!-- Форма обратной связи -->
	<?php get_template_part( 'template-parts/form' ); ?>
</main>

<?php
get_footer();

