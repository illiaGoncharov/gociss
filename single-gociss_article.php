<?php
/**
 * Шаблон одной статьи
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();

	$article_cats = get_the_terms( get_the_ID(), 'gociss_article_cat' );
	$primary_cat  = $article_cats && ! is_wp_error( $article_cats ) ? $article_cats[0] : null;
?>

<article class="article-single">
	<div class="container">
		<!-- Breadcrumbs -->
		<nav class="breadcrumbs" aria-label="Хлебные крошки">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a>
			<span class="breadcrumbs__separator">→</span>
			<a href="<?php echo esc_url( get_post_type_archive_link( 'gociss_article' ) ); ?>">Блог</a>
			<?php if ( $primary_cat ) : ?>
				<span class="breadcrumbs__separator">→</span>
				<a href="<?php echo esc_url( get_term_link( $primary_cat ) ); ?>"><?php echo esc_html( $primary_cat->name ); ?></a>
			<?php endif; ?>
			<span class="breadcrumbs__separator">→</span>
			<span class="breadcrumbs__current"><?php the_title(); ?></span>
		</nav>

		<!-- Заголовок -->
		<header class="article-single__header">
			<?php if ( $article_cats && ! is_wp_error( $article_cats ) ) : ?>
			<div class="article-single__categories">
				<?php foreach ( $article_cats as $cat ) : ?>
					<a href="<?php echo esc_url( get_term_link( $cat ) ); ?>" class="article-single__category">
						<?php echo esc_html( $cat->name ); ?>
					</a>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>

			<h1 class="article-single__title"><?php the_title(); ?></h1>

			<div class="article-single__meta">
				<span class="article-single__date">
					<svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<rect x="3" y="4" width="18" height="18" rx="2" stroke="currentColor" stroke-width="2"/>
						<line x1="16" y1="2" x2="16" y2="6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
						<line x1="8" y1="2" x2="8" y2="6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
						<line x1="3" y1="10" x2="21" y2="10" stroke="currentColor" stroke-width="2"/>
					</svg>
					<?php echo get_the_date( 'd.m.Y' ); ?>
				</span>
				<?php
				// Время чтения (примерно 200 слов в минуту)
				$content    = get_the_content();
				$word_count = str_word_count( wp_strip_all_tags( $content ) );
				$read_time  = max( 1, ceil( $word_count / 200 ) );
				?>
				<span class="article-single__read-time">
					<svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
						<polyline points="12,6 12,12 16,14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
					<?php echo esc_html( $read_time ); ?> мин чтения
				</span>
			</div>
		</header>

		<!-- Изображение -->
		<?php if ( has_post_thumbnail() ) : ?>
		<div class="article-single__image">
			<?php the_post_thumbnail( 'large', array( 'class' => 'article-single__img' ) ); ?>
		</div>
		<?php endif; ?>

		<!-- Контент -->
		<div class="article-single__content">
			<?php the_content(); ?>
		</div>

		<!-- Навигация между статьями -->
		<nav class="article-single__nav">
			<?php
			$prev_post = get_previous_post();
			$next_post = get_next_post();
			?>
			<?php if ( $prev_post ) : ?>
			<a href="<?php echo esc_url( get_permalink( $prev_post ) ); ?>" class="article-single__nav-item article-single__nav-item--prev">
				<span class="article-single__nav-label">← Предыдущая статья</span>
				<span class="article-single__nav-title"><?php echo esc_html( $prev_post->post_title ); ?></span>
			</a>
			<?php endif; ?>

			<?php if ( $next_post ) : ?>
			<a href="<?php echo esc_url( get_permalink( $next_post ) ); ?>" class="article-single__nav-item article-single__nav-item--next">
				<span class="article-single__nav-label">Следующая статья →</span>
				<span class="article-single__nav-title"><?php echo esc_html( $next_post->post_title ); ?></span>
			</a>
			<?php endif; ?>
		</nav>

		<!-- Похожие статьи -->
		<?php
		$related_args = array(
			'post_type'      => 'gociss_article',
			'posts_per_page' => 3,
			'post__not_in'   => array( get_the_ID() ),
			'orderby'        => 'rand',
			'no_found_rows'  => true,
		);

		if ( $primary_cat ) {
			$related_args['tax_query'] = array(
				array(
					'taxonomy' => 'gociss_article_cat',
					'field'    => 'term_id',
					'terms'    => $primary_cat->term_id,
				),
			);
		}

		$related_query = new WP_Query( $related_args );

		if ( $related_query->have_posts() ) :
		?>
		<section class="article-single__related">
			<h2 class="article-single__related-title">Похожие статьи</h2>
			<div class="article-single__related-grid">
				<?php
				while ( $related_query->have_posts() ) :
					$related_query->the_post();
				?>
				<article class="article-card article-card--small">
					<?php if ( has_post_thumbnail() ) : ?>
					<a href="<?php the_permalink(); ?>" class="article-card__image">
						<?php the_post_thumbnail( 'medium', array( 'class' => 'article-card__img' ) ); ?>
					</a>
					<?php endif; ?>

					<div class="article-card__content">
						<h3 class="article-card__title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h3>
						<span class="article-card__date"><?php echo get_the_date( 'd.m.Y' ); ?></span>
					</div>
				</article>
				<?php endwhile; ?>
			</div>
		</section>
		<?php
		wp_reset_postdata();
		endif;
		?>

		<!-- CTA блок -->
		<div class="article-single__cta">
			<div class="article-single__cta-content">
				<h3 class="article-single__cta-title">Нужна помощь с сертификацией?</h3>
				<p class="article-single__cta-text">Наши эксперты помогут разобраться во всех тонкостях процесса</p>
			</div>
			<a href="<?php echo esc_url( home_url( '/#form' ) ); ?>" class="btn btn--primary">Получить консультацию</a>
		</div>
	</div>
</article>

<?php endwhile; ?>

<?php get_footer(); ?>






