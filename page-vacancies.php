<?php
/**
 * Template Name: Вакансии
 *
 * Шаблон страницы с вакансиями компании
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main class="vacancies-page">
	<!-- Хлебные крошки -->
	<nav class="breadcrumbs" aria-label="Хлебные крошки">
		<div class="container">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a>
			<span class="breadcrumbs__separator">→</span>
			<span class="breadcrumbs__current">Вакансии</span>
		</div>
	</nav>

	<!-- Hero секция -->
	<?php get_template_part( 'template-parts/vacancies/hero' ); ?>

	<!-- Список вакансий -->
	<?php get_template_part( 'template-parts/vacancies/list' ); ?>
</main>

<?php
get_footer();


