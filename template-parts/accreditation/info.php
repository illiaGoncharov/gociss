<?php
/**
 * Секция "О нашей аккредитации"
 * Карточка с мятно-зеленым градиентом слева, иконками и логотипами
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ACF поля
$info_title    = function_exists( 'get_field' ) ? get_field( 'gociss_accred_page_info_title' ) : '';
$info_text     = function_exists( 'get_field' ) ? get_field( 'gociss_accred_page_info_text' ) : '';
$info_date     = function_exists( 'get_field' ) ? get_field( 'gociss_accred_page_info_date' ) : '';
$info_btn_text = function_exists( 'get_field' ) ? get_field( 'gociss_accred_page_info_btn_text' ) : '';
$info_btn_url  = function_exists( 'get_field' ) ? get_field( 'gociss_accred_page_info_btn_url' ) : '';
$info_logo1    = function_exists( 'get_field' ) ? get_field( 'gociss_accred_page_info_logo1' ) : '';
$info_logo2    = function_exists( 'get_field' ) ? get_field( 'gociss_accred_page_info_logo2' ) : '';

// Заглушки
if ( ! $info_title ) {
	$info_title = 'О нашей аккредитации';
}
if ( ! $info_text ) {
	$info_text = 'Наш центр подтверждения соответствия ГоЦИСС, в отличие от многих других, имеет <a href="https://pub.fsa.gov.ru/ral/view/8579/accreditation" target="_blank" rel="noopener noreferrer">официальную государственную аккредитацию в Росаккредитации</a> (аттестат аккредитации №&nbsp;RA.RU.13СМ43&nbsp;), что гарантирует признание оформляемых документов во всех структурах и органах.';
}
if ( ! $info_date ) {
	$info_date = '17.04.2015';
}
if ( ! $info_btn_text ) {
	$info_btn_text = 'Перейти в карточку в реестре';
}
if ( ! $info_btn_url ) {
	$info_btn_url = 'https://pub.fsa.gov.ru/ral/view/8579/accreditation';
}

// Логотип (один файл с обоими логотипами)
$logos_url = get_template_directory_uri() . '/assets/images/accreditation/acc-logos.png';
?>

<section class="accred-info">
	<div class="container">
		<div class="accred-info__card">
			<div class="accred-info__body">
				<div class="accred-info__content">
					<!-- Заголовок с иконкой -->
					<h2 class="accred-info__title">
						<span class="accred-info__icon accred-info__icon--blue">
							<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
								<circle cx="12" cy="12" r="10"/>
								<path d="M12 16v-4"/>
								<path d="M12 8h.01"/>
							</svg>
						</span>
						<?php echo esc_html( $info_title ); ?>
					</h2>

					<!-- Основной текст -->
					<div class="accred-info__text">
						<?php echo wp_kses_post( $info_text ); ?>
					</div>

					<!-- Дата -->
					<div class="accred-info__date">
						<span class="accred-info__icon accred-info__icon--green">
							<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
								<rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
								<line x1="16" y1="2" x2="16" y2="6"/>
								<line x1="8" y1="2" x2="8" y2="6"/>
								<line x1="3" y1="10" x2="21" y2="10"/>
							</svg>
						</span>
						<span>Дата внесения в реестр сведений об аккредитованном лице: <strong><?php echo esc_html( $info_date ); ?></strong></span>
					</div>

					<!-- Кнопка -->
					<a href="<?php echo esc_url( $info_btn_url ); ?>" target="_blank" rel="noopener noreferrer" class="accred-info__btn">
						<?php echo esc_html( $info_btn_text ); ?>
					</a>
				</div>

				<!-- Логотипы -->
				<div class="accred-info__logos">
					<img src="<?php echo esc_url( $logos_url ); ?>" alt="Аккредитация Росаккредитации и ISO 17021">
				</div>
			</div>
		</div>
	</div>
</section>

