<?php
/**
 * Секция "Благодарственные письма" для страницы О компании
 * Слайдер со сканами писем от клиентов
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ACF поля
$letters_title = function_exists( 'get_field' ) ? get_field( 'gociss_about_letters_title' ) : '';

// Собираем письма из отдельных image полей
$letters = array();
for ( $i = 1; $i <= 8; $i++ ) {
	$letter = function_exists( 'get_field' ) ? get_field( 'gociss_about_letter_' . $i ) : null;
	if ( $letter && ! empty( $letter['ID'] ) ) {
		$letters[] = $letter;
	}
}

// Заглушка заголовка
if ( ! $letters_title ) {
	$letters_title = 'Благодарственные письма';
}

// Не отображаем секцию, если нет ни одного письма
if ( empty( $letters ) ) {
	return;
}
?>

<section class="about-letters" id="letters">
	<div class="container">
		<h2 class="about-letters__title"><?php echo esc_html( $letters_title ); ?></h2>

		<div class="about-letters__slider">
			<button class="about-letters__nav about-letters__nav--prev" aria-label="Предыдущее письмо" disabled>
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</button>

			<div class="about-letters__track">
				<div class="about-letters__grid">
					<?php foreach ( $letters as $letter ) : ?>
						<div class="about-letters__item">
							<?php
							echo wp_get_attachment_image(
								$letter['ID'],
								'large',
								false,
								array(
									'alt'   => esc_attr( $letter['alt'] ?? $letters_title ),
									'class' => 'about-letters__img',
								)
							);
							?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>

			<button class="about-letters__nav about-letters__nav--next" aria-label="Следующее письмо">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</button>
		</div>
	</div>
</section>

