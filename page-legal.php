<?php
/**
 * Template Name: Юридическая страница
 *
 * Шаблон для страниц: Политика конфиденциальности, Пользовательское соглашение,
 * Обработка персональных данных, Политика cookies и т.п.
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main class="legal-page">
	<div class="container">
		<!-- Хлебные крошки -->
		<nav class="breadcrumbs" aria-label="Хлебные крошки">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a>
			<span class="breadcrumbs__separator">→</span>
			<span class="breadcrumbs__current"><?php the_title(); ?></span>
		</nav>

		<article class="legal-page__content">
			<header class="legal-page__header">
				<h1 class="legal-page__title"><?php the_title(); ?></h1>
				<?php if ( get_the_modified_date() ) : ?>
				<p class="legal-page__updated">
					Последнее обновление: <?php echo get_the_modified_date( 'd.m.Y' ); ?>
				</p>
				<?php endif; ?>
			</header>

			<div class="legal-page__body">
				<?php
				while ( have_posts() ) :
					the_post();
					the_content();
				endwhile;
				?>
			</div>

			<footer class="legal-page__footer">
				<p>Если у вас есть вопросы относительно данного документа, свяжитесь с нами:</p>
				<ul>
					<li>Email: <a href="mailto:info@gociss.ru">info@gociss.ru</a></li>
					<li>Телефон: <a href="tel:+78005510236">+7 (800) 551-02-36</a></li>
				</ul>
			</footer>
		</article>

		<!-- Ссылки на другие правовые страницы -->
		<aside class="legal-page__related">
			<h3 class="legal-page__related-title">Другие документы</h3>
			<ul class="legal-page__related-list">
				<?php
				$legal_pages = array(
					'privacy-policy' => 'Политика конфиденциальности',
					'terms'          => 'Пользовательское соглашение',
					'personal-data'  => 'Обработка персональных данных',
					'cookie-policy'  => 'Политика cookies',
				);

				$current_slug = get_post_field( 'post_name', get_post() );

				foreach ( $legal_pages as $slug => $title ) :
					if ( $slug === $current_slug ) {
						continue;
					}
					$page = get_page_by_path( $slug );
					if ( $page ) :
				?>
					<li>
						<a href="<?php echo esc_url( get_permalink( $page->ID ) ); ?>">
							<?php echo esc_html( $title ); ?>
						</a>
					</li>
				<?php
					endif;
				endforeach;
				?>
			</ul>
		</aside>
	</div>
</main>

<?php get_footer(); ?>


