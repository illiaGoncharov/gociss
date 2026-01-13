<?php
/**
 * Секция преимуществ (фиксированные поля ACF)
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$advantages_title    = function_exists( 'get_field' ) ? get_field( 'gociss_advantages_title' ) : '';
$advantages_subtitle = function_exists( 'get_field' ) ? get_field( 'gociss_advantages_subtitle' ) : '';

if ( ! $advantages_title ) {
	$advantages_title = 'Наши конкурентные преимущества';
}
if ( ! $advantages_subtitle ) {
	$advantages_subtitle = 'Почему клиенты выбирают именно нас для решения задач сертификации';
}

// Собираем преимущества из фиксированных полей
$advantages = array();
for ( $i = 1; $i <= 8; $i++ ) {
	$icon = function_exists( 'get_field' ) ? get_field( 'gociss_advantage_' . $i . '_icon' ) : null;
	$text = function_exists( 'get_field' ) ? get_field( 'gociss_advantage_' . $i . '_text' ) : '';

	if ( $text ) {
		$advantages[] = array(
			'icon' => $icon,
			'text' => $text,
		);
	}
}

// Заглушки, если нет данных
$default_advantages = array(
	array( 'text' => 'Наличие государственной аккредитации (Росаккредитация)' ),
	array( 'text' => 'Законность оформляемых заключений и сертификатов СМК' ),
	array( 'text' => 'Стабильно высокое качество работ по подтверждению ИСО' ),
	array( 'text' => 'Объективность и достоверность предоставляемых сведений' ),
	array( 'text' => 'Отсутствие посредников и переплат за оказываемые услуги' ),
	array( 'text' => 'Оперативная доставка документов по всем субъектам РФ' ),
);

$advantages_to_show = ! empty( $advantages ) ? $advantages : $default_advantages;
?>

<section class="advantages">
	<div class="container">
		<h2 class="advantages__title"><?php echo esc_html( $advantages_title ); ?></h2>
		<p class="advantages__subtitle"><?php echo esc_html( $advantages_subtitle ); ?></p>

		<div class="advantages__grid">
			<?php
			$icon_index = 1;
			foreach ( $advantages_to_show as $advantage ) :
				?>
				<div class="advantages__item">
					<div class="advantages__icon">
						<?php if ( ! empty( $advantage['icon'] ) && ! empty( $advantage['icon']['ID'] ) ) : ?>
							<?php
							echo wp_get_attachment_image(
								$advantage['icon']['ID'],
								'thumbnail',
								false,
								array( 'alt' => '' )
							);
							?>
						<?php else : ?>
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/advantages/' . $icon_index . '.svg' ); ?>" alt="">
						<?php endif; ?>
					</div>
					<p class="advantages__text"><?php echo esc_html( $advantage['text'] ); ?></p>
				</div>
				<?php
				$icon_index++;
			endforeach;
			?>
		</div>
	</div>
</section>
