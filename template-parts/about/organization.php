<?php
/**
 * Секция "Об организации"
 * Текст слева + фото здания справа
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ACF поля
$org_title   = function_exists( 'get_field' ) ? get_field( 'gociss_about_org_title' ) : '';
$org_content = function_exists( 'get_field' ) ? get_field( 'gociss_about_org_content' ) : '';
$org_image   = function_exists( 'get_field' ) ? get_field( 'gociss_about_org_image' ) : '';

// Заглушки
if ( ! $org_title ) {
	$org_title = 'Об организации';
}
if ( ! $org_content ) {
	$org_content = '<p>Автономная некоммерческая организация "Головной центр испытаний, сертификации и стандартизации" (ГоЦИСС) является преемником Всесоюзного научно-исследовательского института сертификации.</p>
<p>Организация "Государственный центр испытаний и сертификации" (ГоЦИСС) была учреждена в форме акционерного общества открытого типа в соответствии с Государственной программой приватизации государственных и муниципальных предприятий на 1992 год.</p>
<p>ГоЦИСС обеспечивает основную деятельность менеджмента качества продукции. Координация проводится централизованно, без посредников.</p>
<p>Фонд и области.</p>';
}
?>

<section class="about-org" id="organization">
	<div class="container">
		<div class="about-org__grid">
			<div class="about-org__content">
				<?php if ( $org_title ) : ?>
					<h2 class="about-org__title"><?php echo esc_html( $org_title ); ?></h2>
				<?php endif; ?>

				<div class="about-org__text">
					<?php echo wp_kses_post( $org_content ); ?>
				</div>
			</div>

			<div class="about-org__image">
				<?php if ( $org_image && isset( $org_image['url'] ) ) : ?>
					<img src="<?php echo esc_url( $org_image['url'] ); ?>" alt="<?php echo esc_attr( $org_image['alt'] ?? $org_title ); ?>">
				<?php else : ?>
					<!-- Placeholder -->
					<div class="about-org__placeholder">
						<span>📷</span>
						<span>Фото организации</span>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

