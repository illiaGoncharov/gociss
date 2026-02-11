<?php
/**
 * Страница 404 - Не найдено
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<section class="error-404">
	<div class="container">
		<div class="error-404__content">
			<div class="error-404__code">404</div>
			<h1 class="error-404__title">Страница не найдена</h1>
			<p class="error-404__text">
				К сожалению, запрашиваемая страница не существует или была перемещена.
				Возможно, вы перешли по устаревшей ссылке или допустили ошибку в адресе.
			</p>
			<div class="error-404__actions">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="error-404__btn error-404__btn--primary">
					На главную
				</a>
				<a href="<?php echo esc_url( home_url( '/kontakty/' ) ); ?>" class="error-404__btn error-404__btn--secondary">
					Связаться с нами
				</a>
			</div>
			<div class="error-404__search">
				<p class="error-404__search-label">Или попробуйте найти нужную информацию:</p>
				<form role="search" method="get" class="error-404__search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<input type="search" class="error-404__search-input" placeholder="Поиск по сайту..." value="" name="s" />
					<button type="submit" class="error-404__search-btn">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M21 21L16.65 16.65M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</button>
				</form>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>

