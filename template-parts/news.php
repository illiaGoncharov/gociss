<?php
/**
 * Секция новостей
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$news_query = new WP_Query(
	array(
		'post_type'      => 'post',
		'posts_per_page' => 4,
		'orderby'        => 'date',
		'order'          => 'DESC',
	)
);

if ( ! $news_query->have_posts() ) {
	return;
}
?>

<section class="news">
	<div class="container">
		<h2 class="news__title">Новости и статьи</h2>
		<p class="news__subtitle">Актуальная информация о сертификации и изменениях в законодательстве</p>

		<div class="news__grid">
			<?php
			while ( $news_query->have_posts() ) {
				$news_query->the_post();
				?>
				<article class="news__item">
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="news__image">
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail( 'gociss-news' ); ?>
							</a>
						</div>
					<?php endif; ?>

					<div class="news__content">
						<time class="news__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
							<?php echo esc_html( get_the_date( 'd F Y' ) ); ?>
						</time>

						<h3 class="news__title-item">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h3>

						<?php if ( has_excerpt() ) : ?>
							<p class="news__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
						<?php endif; ?>

						<a href="<?php the_permalink(); ?>" class="news__link">Читать далее →</a>
					</div>
				</article>
				<?php
			}
			wp_reset_postdata();
			?>
		</div>

		<div class="news__footer">
			<a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>" class="btn btn--primary">
				Посмотреть блог →
			</a>
		</div>
	</div>
</section>



