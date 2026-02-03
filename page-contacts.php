<?php
/**
 * Template Name: Контакты
 *
 * Шаблон страницы контактов с реквизитами и картой
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main class="contacts-page">
	<!-- Хлебные крошки -->
	<section class="breadcrumbs">
		<div class="container">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a>
			<span class="breadcrumbs__separator">/</span>
			<span>Контакты</span>
		</div>
	</section>

	<!-- Секция контактов -->
	<?php get_template_part( 'template-parts/contacts' ); ?>
</main>

<?php
get_footer();


