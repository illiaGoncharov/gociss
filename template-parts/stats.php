<?php
/**
 * Секция статистики
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$stats = get_field( 'gociss_hero_stats' );

if ( ! $stats ) {
	return;
}
?>

<section class="stats">
	<div class="container">
		<h2 class="stats__title">Работа компании в цифрах</h2>
		<p class="stats__subtitle">Наши достижения говорят сами за себя</p>

		<div class="stats__grid">
			<?php foreach ( $stats as $stat ) : ?>
				<div class="stats__item">
					<span class="stats__number"><?php echo esc_html( $stat['number'] ); ?></span>
					<span class="stats__label"><?php echo esc_html( $stat['label'] ); ?></span>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>



