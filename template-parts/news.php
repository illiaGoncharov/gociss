<?php
/**
 * Секция новостей (слайдер)
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$news_title    = function_exists( 'get_field' ) ? get_field( 'gociss_news_title' ) : '';
$news_subtitle = function_exists( 'get_field' ) ? get_field( 'gociss_news_subtitle' ) : '';

// Заглушки
if ( ! $news_title ) {
	$news_title = 'Новости и статьи';
}
if ( ! $news_subtitle ) {
	$news_subtitle = 'Актуальная информация о сертификации и изменениях в законодательстве';
}

// Получаем посты из WordPress
$news_query = new WP_Query(
	array(
		'post_type'      => 'post',
		'posts_per_page' => 8,
		'orderby'        => 'date',
		'order'          => 'DESC',
	)
);

$has_posts = $news_query->have_posts();
?>

<section class="news" id="news">
	<div class="container">
		<?php if ( $news_title ) : ?>
			<h2 class="news__title"><?php echo esc_html( $news_title ); ?></h2>
		<?php endif; ?>

		<?php if ( $news_subtitle ) : ?>
			<p class="news__subtitle"><?php echo esc_html( $news_subtitle ); ?></p>
		<?php endif; ?>

		<div class="news__slider">
			<button class="news__nav news__nav--prev" aria-label="Предыдущий">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</button>

			<div class="news__track">
				<div class="news__grid">
					<?php if ( $has_posts ) : ?>
						<?php
						while ( $news_query->have_posts() ) {
							$news_query->the_post();
							?>
							<article class="news__item">
								<div class="news__image">
									<?php if ( has_post_thumbnail() ) : ?>
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail( 'gociss-news' ); ?>
										</a>
									<?php else : ?>
										<a href="<?php the_permalink(); ?>">
											<div class="news__image-placeholder"></div>
										</a>
									<?php endif; ?>
								</div>

								<div class="news__content">
									<time class="news__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
										<?php echo esc_html( get_the_date( 'j F Y' ) ); ?>
									</time>

									<h3 class="news__item-title">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h3>

									<p class="news__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 15, '...' ) ); ?></p>

									<a href="<?php the_permalink(); ?>" class="news__link">Читать далее →</a>
								</div>
							</article>
							<?php
						}
						wp_reset_postdata();
						?>
					<?php else : ?>
						<!-- Заглушки новостей -->
						<article class="news__item">
							<div class="news__image">
								<div class="news__image-placeholder"></div>
							</div>
							<div class="news__content">
								<time class="news__date">15 ноября 2024</time>
								<h3 class="news__item-title">
									<a href="#">Новые требования ISO 9001:2024 - что изменилось</a>
								</h3>
								<p class="news__excerpt">Обзор ключевых изменений в новой версии стандарта ISO 9001 и рекомендации по переходу...</p>
								<a href="#" class="news__link">Читать далее →</a>
							</div>
						</article>
						<article class="news__item">
							<div class="news__image">
								<div class="news__image-placeholder"></div>
							</div>
							<div class="news__content">
								<time class="news__date">12 ноября 2024</time>
								<h3 class="news__item-title">
									<a href="#">Упрощение процедуры регистрации медицинских изделий</a>
								</h3>
								<p class="news__excerpt">Росздравнадзор анонсировал изменения в процедуре регистрации медицинских изделий...</p>
								<a href="#" class="news__link">Читать далее →</a>
							</div>
						</article>
						<article class="news__item">
							<div class="news__image">
								<div class="news__image-placeholder"></div>
							</div>
							<div class="news__content">
								<time class="news__date">12 ноября 2024</time>
								<h3 class="news__item-title">
									<a href="#">Упрощение процедуры регистрации медицинских изделий</a>
								</h3>
								<p class="news__excerpt">Росздравнадзор анонсировал изменения в процедуре регистрации медицинских изделий...</p>
								<a href="#" class="news__link">Читать далее →</a>
							</div>
						</article>
						<article class="news__item">
							<div class="news__image">
								<div class="news__image-placeholder"></div>
							</div>
							<div class="news__content">
								<time class="news__date">8 ноября 2024</time>
								<h3 class="news__item-title">
									<a href="#">ХАССП: обязательные требования для экспорта продукции</a>
								</h3>
								<p class="news__excerpt">Новые требования к системам безопасности пищевой продукции при экспорте...</p>
								<a href="#" class="news__link">Читать далее →</a>
							</div>
						</article>
					<?php endif; ?>
				</div>
			</div>

			<button class="news__nav news__nav--next" aria-label="Следующий">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</button>
		</div>

		<div class="news__footer">
			<a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ?: '#' ); ?>" class="news__btn">
				Посмотреть блог →
			</a>
		</div>
	</div>
</section>


