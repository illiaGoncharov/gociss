<?php
/**
 * Template Name: Аккредитация
 *
 * Шаблон страницы "Аккредитация"
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main class="accreditation-page">
	<!-- Хлебные крошки -->
	<section class="breadcrumbs">
		<div class="container">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a>
			<span class="breadcrumbs__separator">&rarr;</span>
			<span class="breadcrumbs__current">Аккредитация</span>
		</div>
	</section>

	<?php
	// Подключаем все секции страницы "Аккредитация"
	get_template_part( 'template-parts/accreditation/hero' );
	get_template_part( 'template-parts/accreditation/info' );
	get_template_part( 'template-parts/accreditation/certificate' );
	get_template_part( 'template-parts/geography' );
	get_template_part( 'template-parts/form' );
	?>
</main>

<?php
get_footer();

