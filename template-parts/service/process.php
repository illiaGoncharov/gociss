<?php
/**
 * Секция процесса получения сертификата
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Получаем данные из ACF
$process_title    = function_exists( 'get_field' ) ? get_field( 'gociss_service_process_title' ) : '';
$process_subtitle = function_exists( 'get_field' ) ? get_field( 'gociss_service_process_subtitle' ) : '';
$process_steps    = function_exists( 'get_field' ) ? get_field( 'gociss_service_process_steps' ) : '';

// Заглушки
if ( ! $process_title ) {
	$process_title = 'Процесс получения сертификата';
}
if ( ! $process_subtitle ) {
	$process_subtitle = 'Простой путь к сертификации вашей продукции';
}

// Заглушки шагов
$default_steps = array(
	array(
		'icon'        => '',
		'title'       => 'Оставьте заявку',
		'description' => 'Заполните форму на сайте или позвоните нам',
	),
	array(
		'icon'        => '',
		'title'       => 'Получите консультацию',
		'description' => 'Наш эксперт ответит на все вопросы по телефону или на встрече',
	),
	array(
		'icon'        => '',
		'title'       => 'Подготовьте документы',
		'description' => 'Мы поможем собрать необходимый пакет документов',
	),
	array(
		'icon'        => '',
		'title'       => 'Проведение аудита',
		'description' => 'Наши эксперты проведут аудит и сформируют отчёт',
	),
	array(
		'icon'        => '',
		'title'       => 'Получите сертификат',
		'description' => 'После успешного аудита вы получите сертификат',
	),
	array(
		'icon'        => '',
		'title'       => 'Инспекционный контроль',
		'description' => 'Ежегодный контроль для поддержания сертификата',
	),
);

$steps_to_show = ( $process_steps && is_array( $process_steps ) && count( $process_steps ) > 0 ) ? $process_steps : $default_steps;
?>

<section class="service-process" id="process">
	<div class="container">
		<?php if ( $process_title ) : ?>
			<h2 class="service-process__title"><?php echo esc_html( $process_title ); ?></h2>
		<?php endif; ?>

		<?php if ( $process_subtitle ) : ?>
			<p class="service-process__subtitle"><?php echo esc_html( $process_subtitle ); ?></p>
		<?php endif; ?>

		<div class="service-process__grid">
			<?php
			$step_num = 1;
			foreach ( $steps_to_show as $step ) :
				?>
				<div class="service-process__step">
					<div class="service-process__step-number"><?php echo esc_html( $step_num ); ?></div>

					<?php if ( ! empty( $step['icon'] ) && ! empty( $step['icon']['ID'] ) ) : ?>
						<div class="service-process__step-icon">
							<?php
							echo wp_get_attachment_image(
								$step['icon']['ID'],
								'thumbnail',
								false,
								array( 'alt' => '' )
							);
							?>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $step['title'] ) ) : ?>
						<h3 class="service-process__step-title"><?php echo esc_html( $step['title'] ); ?></h3>
					<?php endif; ?>

					<?php if ( ! empty( $step['description'] ) ) : ?>
						<p class="service-process__step-description"><?php echo esc_html( $step['description'] ); ?></p>
					<?php endif; ?>
				</div>
				<?php
				$step_num++;
			endforeach;
			?>
		</div>
	</div>
</section>
