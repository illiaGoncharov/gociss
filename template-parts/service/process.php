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

// Собираем шаги из отдельных group полей
$process_steps = array();
for ( $i = 1; $i <= 8; $i++ ) {
	$step = function_exists( 'get_field' ) ? get_field( 'gociss_service_process_step_' . $i ) : null;
	if ( $step && ! empty( $step['title'] ) ) {
		$process_steps[] = $step;
	}
}

// Заглушки
if ( ! $process_title ) {
	$process_title = 'Процесс получения сертификата';
}
if ( ! $process_subtitle ) {
	$process_subtitle = 'Полная схема сертификации в 8 этапов';
}

// Иконки по умолчанию из папки service/process
$default_icons = array(
	get_template_directory_uri() . '/assets/images/service/process/Rectangle.png',
	get_template_directory_uri() . '/assets/images/service/process/Rectangle-1.png',
	get_template_directory_uri() . '/assets/images/service/process/Rectangle-2.png',
	get_template_directory_uri() . '/assets/images/service/process/Rectangle-3.png',
	get_template_directory_uri() . '/assets/images/service/process/Rectangle-4.png',
	get_template_directory_uri() . '/assets/images/service/process/Rectangle-5.png',
	get_template_directory_uri() . '/assets/images/service/process/Rectangle-6.png',
	get_template_directory_uri() . '/assets/images/service/process/Rectangle-7.png',
);

// Заглушки шагов если ACF не заполнен
if ( empty( $process_steps ) ) {
	$process_steps = array(
		array(
			'title'       => 'Оформление заявки',
			'description' => 'Подача заявки на сертификацию с указанием области применения',
		),
		array(
			'title'       => 'Заключение договора',
			'description' => 'Подписание договора на проведение работ по сертификации',
		),
		array(
			'title'       => 'Проверка документов',
			'description' => 'Анализ документации системы управления охраной труда',
		),
		array(
			'title'       => 'Проведение аудита',
			'description' => 'Выездная проверка соответствия требованиям стандарта',
		),
		array(
			'title'       => 'Регистрация',
			'description' => 'Регистрация сертификата в установленном порядке',
		),
		array(
			'title'       => 'Инспекционный контроль №1',
			'description' => 'Первая плановая проверка через 12 месяцев',
		),
		array(
			'title'       => 'Инспекционный контроль №2',
			'description' => 'Вторая плановая проверка через 24 месяца',
		),
		array(
			'title'       => 'Ресертификация СМК',
			'description' => 'Подтверждение соответствия через 3 года',
		),
	);
}
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
			$step_index = 0;
			foreach ( $process_steps as $step ) :
				?>
				<div class="service-process__step">
					<div class="service-process__step-icon">
						<?php if ( ! empty( $step['icon'] ) && ! empty( $step['icon']['url'] ) ) : ?>
							<img src="<?php echo esc_url( $step['icon']['url'] ); ?>" alt="">
						<?php else : ?>
							<img src="<?php echo esc_url( $default_icons[ $step_index % 8 ] ); ?>" alt="">
						<?php endif; ?>
					</div>

					<?php if ( ! empty( $step['title'] ) ) : ?>
						<h3 class="service-process__step-title"><?php echo esc_html( $step['title'] ); ?></h3>
					<?php endif; ?>

					<?php if ( ! empty( $step['description'] ) ) : ?>
						<p class="service-process__step-description"><?php echo esc_html( $step['description'] ); ?></p>
					<?php endif; ?>
				</div>
				<?php
				$step_index++;
			endforeach;
			?>
		</div>
	</div>
</section>
