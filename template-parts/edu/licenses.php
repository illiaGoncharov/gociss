<?php
/**
 * Секция "Лицензии и аккредитация"
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Получаем данные из ACF
$fis_title = function_exists( 'get_field' ) ? get_field( 'gociss_edu_fis_title' ) : '';
$fis_text  = function_exists( 'get_field' ) ? get_field( 'gociss_edu_fis_text' ) : '';
$fis_link  = function_exists( 'get_field' ) ? get_field( 'gociss_edu_fis_link' ) : '';

$lic1_title  = function_exists( 'get_field' ) ? get_field( 'gociss_edu_lic1_title' ) : '';
$lic1_text   = function_exists( 'get_field' ) ? get_field( 'gociss_edu_lic1_text' ) : '';
$lic1_number = function_exists( 'get_field' ) ? get_field( 'gociss_edu_lic1_number' ) : '';
$lic1_file   = function_exists( 'get_field' ) ? get_field( 'gociss_edu_lic1_file' ) : '';
$lic1_image  = function_exists( 'get_field' ) ? get_field( 'gociss_edu_lic1_image' ) : '';

$lic2_title  = function_exists( 'get_field' ) ? get_field( 'gociss_edu_lic2_title' ) : '';
$lic2_text   = function_exists( 'get_field' ) ? get_field( 'gociss_edu_lic2_text' ) : '';
$lic2_number = function_exists( 'get_field' ) ? get_field( 'gociss_edu_lic2_number' ) : '';
$lic2_file   = function_exists( 'get_field' ) ? get_field( 'gociss_edu_lic2_file' ) : '';
$lic2_image  = function_exists( 'get_field' ) ? get_field( 'gociss_edu_lic2_image' ) : '';

// Значения по умолчанию
if ( empty( $fis_title ) ) {
	$fis_title = 'Документы об образовании вносятся в ФИС ФРДО';
}
if ( empty( $fis_text ) ) {
	$fis_text = 'После выдачи документов об образовании, сведения о них вносятся в реестры федеральной информационной системы «Федеральный реестр сведений о документах об образовании и (или) о квалификации, документах об обучении» (ФИС ФРДО).';
}
if ( empty( $fis_link ) ) {
	$fis_link = 'https://obrnadzor.gov.ru/';
}

if ( empty( $lic1_title ) ) {
	$lic1_title = 'Государственная лицензия на ДПО';
}
if ( empty( $lic1_text ) ) {
	$lic1_text = 'Лицензия на образовательную деятельность выдана Автономной некоммерческой организации дополнительного профессионального образования в соответствии с законодательством РФ Комитетом по образованию Санкт-Петербурга.';
}
if ( empty( $lic1_number ) ) {
	$lic1_number = '№ 3456 от 15.03.2019';
}

if ( empty( $lic2_title ) ) {
	$lic2_title = 'Государственная лицензия Федеральной службы по аккредитации';
}
if ( empty( $lic2_text ) ) {
	$lic2_text = 'Обучение проводят действующие эксперты органа по сертификации аккредитованного Федеральной службой по аккредитации (Росаккредитация), имеющие огромный практический опыт.';
}
if ( empty( $lic2_number ) ) {
	$lic2_number = 'Аттестат аккредитации ОС ИСМ ГоЦИСС № RA.RU.13СМ43';
}
?>

<section class="edu-licenses">
	<div class="container">
		<h2 class="edu-licenses__title">Лицензии и аккредитация</h2>

		<!-- Блок ФИС ФРДО -->
		<div class="edu-licenses__fis-frdo">
			<div class="edu-licenses__fis-icon">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
					<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
					<polyline points="14 2 14 8 20 8"/>
					<line x1="16" y1="13" x2="8" y2="13"/>
					<line x1="16" y1="17" x2="8" y2="17"/>
					<polyline points="10 9 9 9 8 9"/>
				</svg>
			</div>
			<div class="edu-licenses__fis-content">
				<h3 class="edu-licenses__fis-title"><?php echo esc_html( $fis_title ); ?></h3>
				<p class="edu-licenses__fis-desc"><?php echo esc_html( $fis_text ); ?></p>
			</div>
			<a href="<?php echo esc_url( $fis_link ); ?>" target="_blank" rel="noopener noreferrer" class="edu-licenses__fis-link">
				Проверить в реестре
				<svg width="16" height="16" viewBox="0 0 16 16" fill="none">
					<path d="M6 3H3V13H13V10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
					<path d="M9 2H14V7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M14 2L7 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
				</svg>
			</a>
		</div>

		<!-- Карточки лицензий -->
		<div class="edu-licenses__grid">
			<!-- Лицензия 1 -->
			<div class="edu-licenses__card">
				<div class="edu-licenses__card-icon edu-licenses__card-icon--check">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
						<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
						<polyline points="22 4 12 14.01 9 11.01"/>
					</svg>
				</div>
				<h3 class="edu-licenses__card-title"><?php echo esc_html( $lic1_title ); ?></h3>
				<p class="edu-licenses__card-desc"><?php echo esc_html( $lic1_text ); ?></p>
				<p class="edu-licenses__card-number">
					<span>Регистрационный номер лицензии</span>
					<?php echo esc_html( $lic1_number ); ?>
				</p>
				<?php if ( $lic1_file && isset( $lic1_file['url'] ) ) : ?>
					<a href="<?php echo esc_url( $lic1_file['url'] ); ?>" target="_blank" rel="noopener noreferrer" class="edu-licenses__card-link">
						Скачать реестровую выписку →
					</a>
				<?php else : ?>
					<a href="#" class="edu-licenses__card-link">Скачать реестровую выписку →</a>
				<?php endif; ?>
			</div>

			<!-- Лицензия 2 -->
			<div class="edu-licenses__card">
				<div class="edu-licenses__card-icon edu-licenses__card-icon--location">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
						<circle cx="12" cy="10" r="3"/>
						<path d="M12 21.7C17.3 17 20 13 20 10a8 8 0 1 0-16 0c0 3 2.7 7 8 11.7z"/>
					</svg>
				</div>
				<h3 class="edu-licenses__card-title"><?php echo esc_html( $lic2_title ); ?></h3>
				<p class="edu-licenses__card-desc"><?php echo esc_html( $lic2_text ); ?></p>
				<p class="edu-licenses__card-number">
					<span><?php echo esc_html( $lic2_number ); ?></span>
				</p>
				<?php if ( $lic2_file && isset( $lic2_file['url'] ) ) : ?>
					<a href="<?php echo esc_url( $lic2_file['url'] ); ?>" target="_blank" rel="noopener noreferrer" class="edu-licenses__card-link">
						Скачать аттестат →
					</a>
				<?php else : ?>
					<a href="#" class="edu-licenses__card-link">Скачать аттестат →</a>
				<?php endif; ?>
			</div>
		</div>

		<!-- Изображения документов -->
		<?php if ( ( $lic1_image && isset( $lic1_image['url'] ) ) || ( $lic2_image && isset( $lic2_image['url'] ) ) ) : ?>
			<div class="edu-licenses__images">
				<?php if ( $lic1_image && isset( $lic1_image['url'] ) ) : ?>
					<div class="edu-licenses__image-card">
						<img src="<?php echo esc_url( $lic1_image['url'] ); ?>" alt="<?php echo esc_attr( $lic1_title ); ?>">
					</div>
				<?php endif; ?>
				<?php if ( $lic2_image && isset( $lic2_image['url'] ) ) : ?>
					<div class="edu-licenses__image-card">
						<img src="<?php echo esc_url( $lic2_image['url'] ); ?>" alt="<?php echo esc_attr( $lic2_title ); ?>">
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
