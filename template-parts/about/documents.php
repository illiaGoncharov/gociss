<?php
/**
 * Секция "Документы" для страницы О компании
 * Галерея сертификатов и документов (отдельные image поля)
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ACF поля
$docs_title    = function_exists( 'get_field' ) ? get_field( 'gociss_about_docs_title' ) : '';
$docs_subtitle = function_exists( 'get_field' ) ? get_field( 'gociss_about_docs_subtitle' ) : '';

// Собираем документы из отдельных image полей
$docs_gallery = array();
for ( $i = 1; $i <= 6; $i++ ) {
	$doc = function_exists( 'get_field' ) ? get_field( 'gociss_about_doc_' . $i ) : null;
	if ( $doc && ! empty( $doc['ID'] ) ) {
		$docs_gallery[] = $doc;
	}
}

// Заглушки
if ( ! $docs_title ) {
	$docs_title = 'Документы';
}
if ( ! $docs_subtitle ) {
	$docs_subtitle = 'Наши документы';
}

// Проверяем наличие галереи
$has_gallery = count( $docs_gallery ) > 0;
?>

<section class="about-docs" id="documents">
	<div class="container">
		<?php if ( $docs_title ) : ?>
			<h2 class="about-docs__title"><?php echo esc_html( $docs_title ); ?></h2>
		<?php endif; ?>

		<?php if ( $docs_subtitle ) : ?>
			<p class="about-docs__subtitle"><?php echo esc_html( $docs_subtitle ); ?></p>
		<?php endif; ?>

		<div class="about-docs__grid">
			<?php if ( $has_gallery ) : ?>
				<?php foreach ( $docs_gallery as $image ) : ?>
					<a href="<?php echo esc_url( $image['url'] ); ?>" class="about-docs__item" data-lightbox="documents">
						<?php
						echo wp_get_attachment_image(
							$image['ID'],
							'medium_large',
							false,
							array(
								'alt'   => esc_attr( $image['alt'] ?? $docs_title ),
								'class' => 'about-docs__img',
							)
						);
						?>
					</a>
				<?php endforeach; ?>
			<?php else : ?>
				<!-- Placeholders если галерея не заполнена -->
				<div class="about-docs__item about-docs__item--placeholder">
					<div class="about-docs__placeholder">
						<span class="about-docs__placeholder-icon">📄</span>
						<span class="about-docs__placeholder-text">Свидетельство</span>
					</div>
				</div>
				<div class="about-docs__item about-docs__item--placeholder">
					<div class="about-docs__placeholder">
						<span class="about-docs__placeholder-icon">📄</span>
						<span class="about-docs__placeholder-text">Сертификат</span>
					</div>
				</div>
				<div class="about-docs__item about-docs__item--placeholder">
					<div class="about-docs__placeholder">
						<span class="about-docs__placeholder-icon">📄</span>
						<span class="about-docs__placeholder-text">Аттестат</span>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>

