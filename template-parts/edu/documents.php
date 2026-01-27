<?php
/**
 * Секция "Документы, оформляемые по результатам обучения"
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Получаем данные из ACF
$doc1_title = function_exists( 'get_field' ) ? get_field( 'gociss_edu_doc1_title' ) : '';
$doc1_text  = function_exists( 'get_field' ) ? get_field( 'gociss_edu_doc1_text' ) : '';
$doc1_image = function_exists( 'get_field' ) ? get_field( 'gociss_edu_doc1_image' ) : '';

$doc2_title = function_exists( 'get_field' ) ? get_field( 'gociss_edu_doc2_title' ) : '';
$doc2_text  = function_exists( 'get_field' ) ? get_field( 'gociss_edu_doc2_text' ) : '';
$doc2_image = function_exists( 'get_field' ) ? get_field( 'gociss_edu_doc2_image' ) : '';

// Значения по умолчанию
if ( empty( $doc1_title ) ) {
	$doc1_title = 'Удостоверение о повышении квалификации';
}
if ( empty( $doc1_text ) ) {
	$doc1_text = 'По окончании обучения участники курса получают удостоверение о повышении квалификации, выданное на основании лицензии на право осуществления образовательной деятельности, регистрационный номер лицензии Л035-01271-78/01059514 от 14.02.2024. Сведения о выданных удостоверениях вносятся в реестр ФИС ФРДО.';
}

if ( empty( $doc2_title ) ) {
	$doc2_title = 'Персональный сертификат соответствия';
}
if ( empty( $doc2_text ) ) {
	$doc2_text = 'Участники курса повышения квалификации, успешно освоившие программу, получают сертификат соответствия установленным требованиям в Системе сертификации, зарегистрированной в Федеральном агентстве по техническому регулированию и метрологии (Росстандарт). Регистрационный № Системы: РОСС RU.И3960.04АТАС.';
}

$documents = array(
	array(
		'title' => $doc1_title,
		'text'  => $doc1_text,
		'image' => $doc1_image,
	),
	array(
		'title' => $doc2_title,
		'text'  => $doc2_text,
		'image' => $doc2_image,
	),
);
?>

<section class="edu-documents">
	<div class="container">
		<h2 class="edu-documents__title">Документы, оформляемые по результатам обучения</h2>

		<div class="edu-documents__grid">
			<?php foreach ( $documents as $doc ) : ?>
				<div class="edu-documents__item">
					<div class="edu-documents__content">
						<h3 class="edu-documents__item-title"><?php echo esc_html( $doc['title'] ); ?></h3>
						<p class="edu-documents__item-desc"><?php echo esc_html( $doc['text'] ); ?></p>
					</div>
					<?php if ( $doc['image'] && isset( $doc['image']['url'] ) ) : ?>
						<div class="edu-documents__image">
							<img src="<?php echo esc_url( $doc['image']['url'] ); ?>" alt="<?php echo esc_attr( $doc['title'] ); ?>">
						</div>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
