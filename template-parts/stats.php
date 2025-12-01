<?php
/**
 * Секция статистики
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$stats = function_exists( 'get_field' ) ? get_field( 'gociss_hero_stats' ) : '';

// Показываем секцию даже без данных (с заглушками)
?>

<section class="stats">
	<div class="container">
		<h2 class="stats__title">Работа компании в цифрах</h2>
		<p class="stats__subtitle">Наши достижения говорят сами за себя</p>

		<div class="stats__grid">
			<?php if ( $stats && is_array( $stats ) && count( $stats ) > 0 ) : ?>
				<?php foreach ( $stats as $stat ) : ?>
					<div class="stats__item">
						<span class="stats__number"><?php echo esc_html( $stat['number'] ); ?></span>
						<span class="stats__label"><?php echo esc_html( $stat['label'] ); ?></span>
					</div>
				<?php endforeach; ?>
			<?php else : ?>
				<!-- Заглушки статистики -->
				<div class="stats__item">
					<span class="stats__number">5000+</span>
					<span class="stats__label">Выданных сертификатов</span>
				</div>
				<div class="stats__item">
					<span class="stats__number">15+</span>
					<span class="stats__label">Лет на рынке</span>
				</div>
				<div class="stats__item">
					<span class="stats__number">1200+</span>
					<span class="stats__label">Довольных клиентов</span>
				</div>
				<div class="stats__item">
					<span class="stats__number">45</span>
					<span class="stats__label">Аккредитованных экспертов</span>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>



