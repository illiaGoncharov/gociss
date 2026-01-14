<?php
/**
 * Архив статей - страница "Статьи"
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

// Получаем все категории статей
$article_categories = get_terms(
	array(
		'taxonomy'   => 'gociss_article_cat',
		'hide_empty' => true,
		'parent'     => 0,
	)
);

// Текущая выбранная категория (если есть)
$current_category = get_query_var( 'gociss_article_cat' );
?>

<section class="articles-archive">
	<div class="container">
		<!-- Breadcrumbs -->
		<nav class="breadcrumbs" aria-label="Хлебные крошки">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a>
			<span class="breadcrumbs__separator">→</span>
			<span class="breadcrumbs__current">Статьи</span>
		</nav>

		<!-- Заголовок -->
		<div class="articles-archive__header">
			<h1 class="articles-archive__title">Статьи</h1>
			<p class="articles-archive__subtitle">Все статьи и информационные материалы о сертификации и стандартах в законодательстве РФ</p>
		</div>

		<!-- Фильтр по категориям -->
		<?php if ( $article_categories && ! is_wp_error( $article_categories ) && count( $article_categories ) > 1 ) : ?>
		<div class="articles-archive__filter">
			<a href="<?php echo esc_url( get_post_type_archive_link( 'gociss_article' ) ); ?>" class="articles-archive__filter-item <?php echo empty( $current_category ) ? 'is-active' : ''; ?>">
				Все статьи
			</a>
			<?php foreach ( $article_categories as $category ) : ?>
				<a href="<?php echo esc_url( get_term_link( $category ) ); ?>" class="articles-archive__filter-item <?php echo $current_category === $category->slug ? 'is-active' : ''; ?>">
					<?php echo esc_html( $category->name ); ?>
				</a>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>

		<!-- Список статей -->
		<?php if ( have_posts() ) : ?>
		<div class="articles-archive__grid">
			<?php
			while ( have_posts() ) :
				the_post();
				$article_cats = get_the_terms( get_the_ID(), 'gociss_article_cat' );
			?>
			<article class="article-card">
				<?php if ( has_post_thumbnail() ) : ?>
				<a href="<?php the_permalink(); ?>" class="article-card__image">
					<?php the_post_thumbnail( 'medium_large', array( 'class' => 'article-card__img' ) ); ?>
				</a>
				<?php else : ?>
				<a href="<?php the_permalink(); ?>" class="article-card__image article-card__image--placeholder">
					<svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M19 3H5C3.89543 3 3 3.89543 3 5V19C3 20.1046 3.89543 21 5 21H19C20.1046 21 21 20.1046 21 19V5C21 3.89543 20.1046 3 19 3Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M8.5 10C9.32843 10 10 9.32843 10 8.5C10 7.67157 9.32843 7 8.5 7C7.67157 7 7 7.67157 7 8.5C7 9.32843 7.67157 10 8.5 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M21 15L16 10L5 21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				</a>
				<?php endif; ?>

				<div class="article-card__content">
					<span class="article-card__date"><?php echo get_the_date( 'd F Y' ); ?></span>

					<h2 class="article-card__title">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h2>

					<?php if ( has_excerpt() || get_the_content() ) : ?>
					<p class="article-card__excerpt"><?php echo wp_trim_words( has_excerpt() ? get_the_excerpt() : get_the_content(), 15 ); ?></p>
					<?php endif; ?>

					<div class="article-card__footer">
						<a href="<?php the_permalink(); ?>" class="article-card__link">Читать далее →</a>
					</div>
				</div>
			</article>
			<?php endwhile; ?>
		</div>

		<!-- Пагинация -->
		<div class="articles-archive__pagination">
			<?php
			the_posts_pagination(
				array(
					'mid_size'  => 2,
					'prev_text' => '← Назад',
					'next_text' => 'Вперед →',
				)
			);
			?>
		</div>

		<?php else : ?>
		<div class="articles-archive__empty">
			<p>Статьи пока не добавлены.</p>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary">На главную</a>
		</div>
		<?php endif; ?>
	</div>
</section>

<?php
// Форма обратной связи
get_template_part( 'template-parts/form' );
?>

<?php get_footer(); ?>

