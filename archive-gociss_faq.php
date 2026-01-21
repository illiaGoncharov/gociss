<?php
/**
 * Архив FAQ - страница "Вопрос-ответ"
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

// Получаем все категории FAQ
$faq_categories = get_terms(
	array(
		'taxonomy'   => 'gociss_faq_cat',
		'hide_empty' => true,
		'parent'     => 0,
	)
);
?>

<section class="faq-archive">
	<div class="container">
		<!-- Breadcrumbs -->
		<nav class="breadcrumbs" aria-label="Хлебные крошки">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a>
			<span class="breadcrumbs__separator">→</span>
			<span class="breadcrumbs__current">Вопрос-ответ</span>
		</nav>

		<!-- Заголовок -->
		<div class="faq-archive__header">
			<h1 class="faq-archive__title">Вопрос-ответ</h1>
			<p class="faq-archive__subtitle">Ответы на часто задаваемые вопросы о сертификации</p>
		</div>

		<?php if ( $faq_categories && ! is_wp_error( $faq_categories ) ) : ?>
			<!-- Категории FAQ -->
			<?php foreach ( $faq_categories as $category ) : ?>
				<?php
				// Получаем вопросы этой категории
				$faq_query = new WP_Query(
					array(
						'post_type'      => 'gociss_faq',
						'posts_per_page' => -1,
						'orderby'        => 'menu_order title',
						'order'          => 'ASC',
						'tax_query'      => array(
							array(
								'taxonomy' => 'gociss_faq_cat',
								'field'    => 'term_id',
								'terms'    => $category->term_id,
							),
						),
						'no_found_rows'          => true,
						'update_post_meta_cache' => false,
						'update_post_term_cache' => false,
					)
				);

				if ( $faq_query->have_posts() ) :
				?>
				<div class="faq-archive__category">
					<h2 class="faq-archive__category-title"><?php echo esc_html( $category->name ); ?></h2>

					<?php if ( $category->description ) : ?>
						<p class="faq-archive__category-desc"><?php echo esc_html( $category->description ); ?></p>
					<?php endif; ?>

					<div class="faq__list">
						<?php
						$first = true;
						while ( $faq_query->have_posts() ) :
							$faq_query->the_post();
						?>
							<div class="faq__item <?php echo $first ? 'is-open' : ''; ?>">
								<button class="faq__question" aria-expanded="<?php echo $first ? 'true' : 'false'; ?>">
									<?php the_title(); ?>
									<span class="faq__icon"></span>
								</button>
								<div class="faq__answer">
									<div class="faq__answer-inner">
										<?php the_content(); ?>
									</div>
								</div>
							</div>
						<?php
							$first = false;
						endwhile;
						wp_reset_postdata();
						?>
					</div>
				</div>
				<?php endif; ?>
			<?php endforeach; ?>

		<?php else : ?>
			<?php
			// Если нет категорий, показываем все вопросы
			$faq_query = new WP_Query(
				array(
					'post_type'      => 'gociss_faq',
					'posts_per_page' => -1,
					'orderby'        => 'menu_order title',
					'order'          => 'ASC',
					'no_found_rows'          => true,
					'update_post_meta_cache' => false,
					'update_post_term_cache' => false,
				)
			);

			if ( $faq_query->have_posts() ) :
			?>
			<div class="faq__list">
				<?php
				$first = true;
				while ( $faq_query->have_posts() ) :
					$faq_query->the_post();
				?>
					<div class="faq__item <?php echo $first ? 'is-open' : ''; ?>">
						<button class="faq__question" aria-expanded="<?php echo $first ? 'true' : 'false'; ?>">
							<?php the_title(); ?>
							<span class="faq__icon"></span>
						</button>
						<div class="faq__answer">
							<div class="faq__answer-inner">
								<?php the_content(); ?>
							</div>
						</div>
					</div>
				<?php
					$first = false;
				endwhile;
				wp_reset_postdata();
				?>
			</div>
			<?php else : ?>
				<div class="faq-archive__empty">
					<p>Вопросы пока не добавлены.</p>
				</div>
			<?php endif; ?>
		<?php endif; ?>

		<!-- CTA блок -->
		<div class="faq-archive__cta">
			<div class="faq-archive__cta-content">
				<h3 class="faq-archive__cta-title">Не нашли ответ на свой вопрос?</h3>
				<p class="faq-archive__cta-text">Свяжитесь с нами — мы с радостью поможем разобраться в любом вопросе сертификации</p>
			</div>
			<a href="<?php echo esc_url( home_url( '/#form' ) ); ?>" class="btn btn--primary">Задать вопрос</a>
		</div>
	</div>
</section>

<?php get_footer(); ?>




