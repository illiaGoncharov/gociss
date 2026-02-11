<?php
/**
 * Шаблон страницы поиска
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$search_query = get_search_query();
?>

<section class="search-page">
	<div class="container">
		<!-- Breadcrumbs -->
		<nav class="breadcrumbs" aria-label="Хлебные крошки">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a>
			<span class="breadcrumbs__separator">→</span>
			<span class="breadcrumbs__current">Результаты поиска</span>
		</nav>

		<!-- Заголовок -->
		<div class="search-page__header">
			<h1 class="search-page__title">
				<?php if ( $search_query ) : ?>
					Результаты поиска: <span class="search-page__query"><?php echo esc_html( $search_query ); ?></span>
				<?php else : ?>
					Результаты поиска
				<?php endif; ?>
			</h1>
			<?php if ( have_posts() ) : ?>
				<p class="search-page__count">
					Найдено результатов: <?php echo esc_html( $wp_query->found_posts ); ?>
				</p>
			<?php endif; ?>
		</div>

		<!-- Форма поиска -->
		<div class="search-page__form">
			<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<input type="search" class="search-form__input" placeholder="Введите запрос..." value="<?php echo esc_attr( $search_query ); ?>" name="s" />
				<button type="submit" class="search-form__button">
					<svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2"/>
						<path d="M21 21L16.65 16.65" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
					</svg>
					Найти
				</button>
			</form>
		</div>

		<!-- Результаты поиска -->
		<?php if ( have_posts() ) : ?>
		<div class="search-page__results">
			<?php
			while ( have_posts() ) :
				the_post();
				$post_type = get_post_type();
				$post_type_label = '';
				
				// Определяем тип записи для отображения
				switch ( $post_type ) {
					case 'gociss_service':
						$post_type_label = 'Услуга';
						break;
					case 'gociss_article':
						$post_type_label = 'Статья';
						break;
					case 'gociss_faq':
						$post_type_label = 'Вопрос-ответ';
						break;
					case 'page':
						$post_type_label = 'Страница';
						break;
					default:
						$post_type_label = 'Запись';
						break;
				}
			?>
			<article class="search-result">
				<?php if ( has_post_thumbnail() ) : ?>
				<a href="<?php the_permalink(); ?>" class="search-result__image">
					<?php the_post_thumbnail( 'medium', array( 'class' => 'search-result__img' ) ); ?>
				</a>
				<?php endif; ?>

				<div class="search-result__content">
					<span class="search-result__type"><?php echo esc_html( $post_type_label ); ?></span>
					
					<h2 class="search-result__title">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h2>

					<?php if ( has_excerpt() || get_the_content() ) : ?>
					<p class="search-result__excerpt">
						<?php 
						$excerpt = has_excerpt() ? get_the_excerpt() : get_the_content();
						echo wp_trim_words( wp_strip_all_tags( $excerpt ), 30 ); 
						?>
					</p>
					<?php endif; ?>

					<a href="<?php the_permalink(); ?>" class="search-result__link">
						Подробнее →
					</a>
				</div>
			</article>
			<?php endwhile; ?>
		</div>

		<!-- Пагинация -->
		<div class="search-page__pagination">
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
		<!-- Нет результатов -->
		<div class="search-page__empty">
			<svg width="64" height="64" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2"/>
				<path d="M21 21L16.65 16.65" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
			</svg>
			<h2 class="search-page__empty-title">Ничего не найдено</h2>
			<p class="search-page__empty-text">
				<?php if ( $search_query ) : ?>
					По запросу «<?php echo esc_html( $search_query ); ?>» ничего не найдено.<br>
					Попробуйте изменить запрос или воспользуйтесь формой поиска выше.
				<?php else : ?>
					Введите поисковый запрос в форму выше.
				<?php endif; ?>
			</p>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary">На главную</a>
		</div>
		<?php endif; ?>
	</div>
</section>

<?php get_footer(); ?>

