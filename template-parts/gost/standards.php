<?php
/**
 * Секция стандартов для страницы ГОСТов
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Получаем заголовок секции из ACF
$section_title = function_exists( 'get_field' ) ? get_field( 'gociss_gost_section_title' ) : '';

if ( empty( $section_title ) ) {
	$section_title = 'Основные стандарты ИСО';
}

// Собираем группы стандартов из ACF (до 6 групп)
$groups = array();
for ( $g = 1; $g <= 6; $g++ ) {
	$group_name = function_exists( 'get_field' ) ? get_field( 'gociss_gost_group_' . $g . '_name' ) : '';
	
	if ( empty( $group_name ) ) {
		continue;
	}
	
	$group = array(
		'icon'        => function_exists( 'get_field' ) ? get_field( 'gociss_gost_group_' . $g . '_icon' ) : '',
		'name'        => $group_name,
		'description' => function_exists( 'get_field' ) ? get_field( 'gociss_gost_group_' . $g . '_description' ) : '',
		'standards'   => array(),
	);
	
	// Собираем стандарты группы (до 10 стандартов)
	for ( $s = 1; $s <= 10; $s++ ) {
		$std_name = function_exists( 'get_field' ) ? get_field( 'gociss_gost_group_' . $g . '_std_' . $s . '_name' ) : '';
		
		if ( empty( $std_name ) ) {
			continue;
		}
		
		$group['standards'][] = array(
			'name'        => $std_name,
			'description' => function_exists( 'get_field' ) ? get_field( 'gociss_gost_group_' . $g . '_std_' . $s . '_description' ) : '',
			'file'        => function_exists( 'get_field' ) ? get_field( 'gociss_gost_group_' . $g . '_std_' . $s . '_file' ) : '',
		);
	}
	
	$groups[] = $group;
}

// Демо-данные, если ACF пуст
if ( empty( $groups ) ) {
	$groups = array(
		array(
			'icon'        => '',
			'name'        => 'ИСО 9000 - Менеджмент качества',
			'description' => 'Системы менеджмента качества - требования и руководящие указания',
			'standards'   => array(
				array(
					'name'        => 'ГОСТ Р ИСО 9001-2015',
					'description' => 'Системы менеджмента качества. Требования',
					'file'        => '',
				),
				array(
					'name'        => 'ГОСТ Р ИСО 9000-2015',
					'description' => 'Системы менеджмента качества. Основные положения и словарь',
					'file'        => '',
				),
				array(
					'name'        => 'ГОСТ ИСО 9004-2010',
					'description' => 'Менеджмент для достижения устойчивого успеха организации',
					'file'        => '',
				),
				array(
					'name'        => 'ГОСТ ИСО 19011-2012',
					'description' => 'Руководящие указания по аудиту систем менеджмента',
					'file'        => '',
				),
			),
		),
		array(
			'icon'        => '',
			'name'        => 'ИСО 14000 - Экологический менеджмент',
			'description' => 'Системы экологического менеджмента и оценка воздействия на окружающую среду',
			'standards'   => array(
				array(
					'name'        => 'ГОСТ Р ИСО 14001-2016',
					'description' => 'Системы экологического менеджмента. Требования и руководство по применению',
					'file'        => '',
				),
				array(
					'name'        => 'ГОСТ Р ИСО 14004-2017',
					'description' => 'Системы экологического менеджмента. Руководящие указания',
					'file'        => '',
				),
				array(
					'name'        => 'ГОСТ Р ИСО 14040-2010',
					'description' => 'Экологический менеджмент. Оценка жизненного цикла. Принципы и структура',
					'file'        => '',
				),
				array(
					'name'        => 'ГОСТ Р ИСО 14044-2007',
					'description' => 'Экологический менеджмент. Оценка жизненного цикла. Требования и рекомендации',
					'file'        => '',
				),
				array(
					'name'        => 'ГОСТ Р ИСО 14050-2009',
					'description' => 'Экологический менеджмент. Словарь',
					'file'        => '',
				),
			),
		),
		array(
			'icon'        => '',
			'name'        => 'ИСО 45001 - Охрана труда',
			'description' => 'Системы менеджмента безопасности и охраны труда',
			'standards'   => array(
				array(
					'name'        => 'ГОСТ Р ИСО 45001-2020',
					'description' => 'Системы менеджмента безопасности труда и охраны здоровья. Требования',
					'file'        => '',
				),
				array(
					'name'        => 'ГОСТ 12.0.230-2007',
					'description' => 'Система стандартов безопасности труда. Системы управления охраной труда',
					'file'        => '',
				),
				array(
					'name'        => 'ГОСТ 12.0.230.1-2015',
					'description' => 'Системы управления охраной труда. Руководство по применению',
					'file'        => '',
				),
			),
		),
		array(
			'icon'        => '',
			'name'        => 'ИСО 27000 - Информационная безопасность',
			'description' => 'Системы менеджмента информационной безопасности',
			'standards'   => array(
				array(
					'name'        => 'ГОСТ Р ИСО/МЭК 27001-2021',
					'description' => 'Информационная безопасность. Системы менеджмента. Требования',
					'file'        => '',
				),
				array(
					'name'        => 'ГОСТ Р ИСО/МЭК 27002-2021',
					'description' => 'Информационная безопасность. Практические правила',
					'file'        => '',
				),
				array(
					'name'        => 'ГОСТ Р ИСО/МЭК 27005-2010',
					'description' => 'Информационная безопасность. Управление рисками',
					'file'        => '',
				),
				array(
					'name'        => 'ГОСТ Р ИСО/МЭК 27017-2021',
					'description' => 'Информационная безопасность для облачных сервисов',
					'file'        => '',
				),
			),
		),
	);
}

// Иконки для групп (SVG по умолчанию)
$default_icons = array(
	'<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" stroke="currentColor" stroke-width="2"/><path d="M19.4 15C19.1277 15.6171 19.2583 16.3378 19.73 16.82L19.79 16.88C20.1656 17.2551 20.3766 17.7642 20.3766 18.295C20.3766 18.8258 20.1656 19.3349 19.79 19.71C19.4149 20.0856 18.9058 20.2966 18.375 20.2966C17.8442 20.2966 17.3351 20.0856 16.96 19.71L16.9 19.65C16.4178 19.1783 15.6971 19.0477 15.08 19.32C14.4755 19.5791 14.0826 20.1724 14.08 20.83V21C14.08 22.1046 13.1846 23 12.08 23C10.9754 23 10.08 22.1046 10.08 21V20.91C10.0642 20.2327 9.63587 19.6339 9 19.4C8.38291 19.1277 7.66219 19.2583 7.18 19.73L7.12 19.79C6.74486 20.1656 6.23582 20.3766 5.705 20.3766C5.17418 20.3766 4.66514 20.1656 4.29 19.79C3.91445 19.4149 3.70343 18.9058 3.70343 18.375C3.70343 17.8442 3.91445 17.3351 4.29 16.96L4.35 16.9C4.82167 16.4178 4.95231 15.6971 4.68 15.08C4.42093 14.4755 3.82764 14.0826 3.17 14.08H3C1.89543 14.08 1 13.1846 1 12.08C1 10.9754 1.89543 10.08 3 10.08H3.09C3.76733 10.0642 4.36613 9.63587 4.6 9C4.87231 8.38291 4.74167 7.66219 4.27 7.18L4.21 7.12C3.83445 6.74486 3.62343 6.23582 3.62343 5.705C3.62343 5.17418 3.83445 4.66514 4.21 4.29C4.58514 3.91445 5.09418 3.70343 5.625 3.70343C6.15582 3.70343 6.66486 3.91445 7.04 4.29L7.1 4.35C7.58219 4.82167 8.30291 4.95231 8.92 4.68H9C9.60447 4.42093 9.99738 3.82764 10 3.17V3C10 1.89543 10.8954 1 12 1C13.1046 1 14 1.89543 14 3V3.09C14.0026 3.74764 14.3955 4.34093 15 4.6C15.6171 4.87231 16.3378 4.74167 16.82 4.27L16.88 4.21C17.2551 3.83445 17.7642 3.62343 18.295 3.62343C18.8258 3.62343 19.3349 3.83445 19.71 4.21C20.0856 4.58514 20.2966 5.09418 20.2966 5.625C20.2966 6.15582 20.0856 6.66486 19.71 7.04L19.65 7.1C19.1783 7.58219 19.0477 8.30291 19.32 8.92V9C19.5791 9.60447 20.1724 9.99738 20.83 10H21C22.1046 10 23 10.8954 23 12C23 13.1046 22.1046 14 21 14H20.91C20.2524 14.0026 19.6591 14.3955 19.4 15Z" stroke="currentColor" stroke-width="2"/></svg>',
	'<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="currentColor" stroke-width="2"/><path d="M12 6V12L16 14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>',
	'<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9 11L12 14L22 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M21 12V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
	'<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 22C12 22 20 18 20 12V5L12 2L4 5V12C4 18 12 22 12 22Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
	'<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M14 2V8H20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M16 13H8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M16 17H8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M10 9H9H8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
	'<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M22 11.08V12C21.9988 14.1564 21.3005 16.2547 20.0093 17.9818C18.7182 19.709 16.9033 20.9725 14.8354 21.5839C12.7674 22.1953 10.5573 22.1219 8.53447 21.3746C6.51168 20.6273 4.78465 19.2461 3.61096 17.4371C2.43727 15.628 1.87979 13.4881 2.02168 11.3363C2.16356 9.18455 2.99721 7.13631 4.39828 5.49706C5.79935 3.85781 7.69279 2.71537 9.79619 2.24013C11.8996 1.7649 14.1003 1.98232 16.07 2.85999" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M22 4L12 14.01L9 11.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
);

/**
 * Склонение слова "стандарт"
 */
function gociss_gost_pluralize_standard( $count ) {
	$count = abs( $count ) % 100;
	$num   = $count % 10;
	
	if ( $count > 10 && $count < 20 ) {
		return $count . ' стандартов';
	}
	if ( $num > 1 && $num < 5 ) {
		return $count . ' стандарта';
	}
	if ( 1 === $num ) {
		return $count . ' стандарт';
	}
	return $count . ' стандартов';
}
?>

<section class="gost-standards">
	<div class="container">
		<h2 class="gost-standards__title"><?php echo esc_html( $section_title ); ?></h2>

		<div class="gost-standards__list">
			<?php
			$index = 0;
			foreach ( $groups as $group ) :
				$index++;
				$is_open      = ( 1 === $index ) ? 'is-open' : '';
				$std_count    = count( $group['standards'] );
				$icon_svg     = '';
				
				// Используем иконку из ACF или дефолтную
				if ( ! empty( $group['icon'] ) && isset( $group['icon']['url'] ) ) {
					$icon_svg = '<img src="' . esc_url( $group['icon']['url'] ) . '" alt="" class="gost-group__icon-img">';
				} else {
					$icon_svg = isset( $default_icons[ $index - 1 ] ) ? $default_icons[ $index - 1 ] : $default_icons[0];
				}
				?>
				<div class="gost-group <?php echo esc_attr( $is_open ); ?>">
					<div class="gost-group__header">
						<div class="gost-group__icon">
							<?php echo $icon_svg; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</div>
						<div class="gost-group__info">
							<h3 class="gost-group__name"><?php echo esc_html( $group['name'] ); ?></h3>
							<?php if ( ! empty( $group['description'] ) ) : ?>
								<p class="gost-group__description"><?php echo esc_html( $group['description'] ); ?></p>
							<?php endif; ?>
							<span class="gost-group__count"><?php echo esc_html( gociss_gost_pluralize_standard( $std_count ) ); ?></span>
						</div>
						<button class="gost-group__toggle" aria-expanded="<?php echo ( 1 === $index ) ? 'true' : 'false'; ?>">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M6 9L12 15L18 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</button>
					</div>
					
					<div class="gost-group__content">
						<div class="gost-group__standards">
							<?php foreach ( $group['standards'] as $standard ) : ?>
								<div class="gost-item">
									<div class="gost-item__info">
										<h4 class="gost-item__name"><?php echo esc_html( $standard['name'] ); ?></h4>
										<?php if ( ! empty( $standard['description'] ) ) : ?>
											<p class="gost-item__description"><?php echo esc_html( $standard['description'] ); ?></p>
										<?php endif; ?>
									</div>
									<div class="gost-item__action">
										<?php if ( ! empty( $standard['file'] ) && isset( $standard['file']['url'] ) ) : ?>
											<a href="<?php echo esc_url( $standard['file']['url'] ); ?>" 
											   class="btn btn--outline-primary btn--sm" 
											   download 
											   target="_blank">
												Скачать
											</a>
										<?php else : ?>
											<button class="btn btn--outline-primary btn--sm" disabled title="Файл недоступен">
												Скачать
											</button>
										<?php endif; ?>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>


