<?php
/**
 * Шаблон для пустого контента
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<section class="no-results not-found">
	<div class="container">
		<header class="page-header">
			<h1 class="page-title"><?php esc_html_e( 'Ничего не найдено', 'gociss' ); ?></h1>
		</header>

		<div class="page-content">
			<p><?php esc_html_e( 'К сожалению, ничего не найдено. Попробуйте поискать снова.', 'gociss' ); ?></p>
			<?php get_search_form(); ?>
		</div>
	</div>
</section>



