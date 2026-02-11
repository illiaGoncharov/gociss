<?php
/**
 * Подвал сайта
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

	</main><!-- #main -->

	<footer id="colophon" class="site-footer">
		<div class="container">
			<div class="site-footer__main">
				<!-- Колонка 1: Логотип и описание -->
				<div class="site-footer__column site-footer__column--logo">
					<div class="site-footer__logo">
						<?php
						$footer_logo = function_exists( 'get_field' ) ? get_field( 'gociss_footer_logo', 'option' ) : '';
						$logo_url = $footer_logo ? esc_url( $footer_logo ) : esc_url( get_template_directory_uri() . '/assets/images/logo[white].svg' );
						?>
						<img src="<?php echo $logo_url; ?>" alt="<?php bloginfo( 'name' ); ?>" class="site-footer__logo-img">
					</div>
					<p class="site-footer__description">Профессиональные<br>сертификационные услуги для<br>бизнеса. Более 15 лет опыта на<br>рынке.</p>
					<div class="site-footer__certifications">
						<?php
						$cert_image = function_exists( 'get_field' ) ? get_field( 'gociss_footer_cert_image', 'option' ) : '';

						if ( $cert_image ) {
							?>
							<div class="site-footer__certification">
								<img src="<?php echo esc_url( $cert_image ); ?>" alt="Сертификат" class="site-footer__certification-img">
							</div>
							<?php
						} else {
							// Fallback значение по умолчанию
							?>
							<div class="site-footer__certification">
								<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/iso[color].png' ); ?>" alt="Сертификат" class="site-footer__certification-img">
							</div>
							<?php
						}
						?>
					</div>
				</div>

				<!-- Колонка 2: Услуги -->
				<div class="site-footer__column site-footer__column--services">
					<h3 class="site-footer__column-title">Услуги</h3>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer-services',
							'menu_id'        => 'footer-services-menu',
							'container'      => false,
							'menu_class'     => 'site-footer__menu',
							'depth'          => 1,
					'fallback_cb'    => function() {
						$footer_archive = get_post_type_archive_link( 'gociss_service' );
						$nav_categories = gociss_get_nav_service_categories();
						?>
						<ul class="site-footer__menu">
							<?php foreach ( $nav_categories as $fc ) :
								$fc_link = gociss_get_service_cat_url( $fc['names'], $fc['slugs'], $fc['slugs'][0] );
							?>
								<li><a href="<?php echo esc_url( $fc_link ); ?>"><?php echo esc_html( $fc['label'] ); ?></a></li>
							<?php endforeach; ?>
							<li><a href="<?php echo esc_url( home_url( '/edu/' ) ); ?>">Учебный центр</a></li>
							<li><a href="<?php echo esc_url( $footer_archive ); ?>">Все услуги</a></li>
						</ul>
						<?php
					},
						)
					);
					?>
				</div>

				<!-- Колонка 3: Информация -->
				<div class="site-footer__column site-footer__column--info">
					<h3 class="site-footer__column-title">Информация</h3>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer-info',
							'menu_id'        => 'footer-info-menu',
							'container'      => false,
							'menu_class'     => 'site-footer__menu',
							'depth'          => 1,
							'fallback_cb'    => function() {
								?>
								<ul class="site-footer__menu">
									<li><a href="<?php echo esc_url( home_url( '/reestr/' ) ); ?>">Реестры</a></li>
									<li><a href="<?php echo esc_url( get_post_type_archive_link( 'gociss_article' ) ); ?>">Блог</a></li>
									<li><a href="<?php echo esc_url( gociss_get_page_url_by_template( 'page-gost.php' ) ); ?>">ГОСТы</a></li>
									<li><a href="<?php echo esc_url( get_post_type_archive_link( 'gociss_faq' ) ); ?>">Вопрос-ответ</a></li>
								</ul>
								<?php
							},
						)
					);
					?>
				</div>

				<!-- Колонка 4: Компания -->
				<div class="site-footer__column site-footer__column--company">
					<h3 class="site-footer__column-title">Компания</h3>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer-company',
							'menu_id'        => 'footer-company-menu',
							'container'      => false,
							'menu_class'     => 'site-footer__menu',
							'depth'          => 1,
							'fallback_cb'    => function() {
								?>
								<ul class="site-footer__menu">
									<li><a href="<?php echo esc_url( home_url( '/o-kompanii/' ) ); ?>">О компании</a></li>
									<li><a href="<?php echo esc_url( home_url( '/akkreditaciya/' ) ); ?>">Аккредитация</a></li>
									<li><a href="<?php echo esc_url( home_url( '/kontakty/' ) ); ?>">Контакты</a></li>
									<li><a href="<?php echo esc_url( home_url( '/vakansii/' ) ); ?>">Вакансии</a></li>
								</ul>
								<?php
							},
						)
					);
					?>
				</div>

				<!-- Колонка 5: Контакты -->
				<div class="site-footer__column site-footer__column--contacts">
					<h3 class="site-footer__column-title">РАБОТАЕМ ПО ВСЕЙ РОССИИ</h3>
					<div class="site-footer__contact-item">
						<span class="site-footer__contact-label">Адрес головного офиса</span>
						<div class="site-footer__contact-value">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/ui_pin[grey].svg' ); ?>" alt="" class="site-footer__contact-icon">
							<span>Санкт-Петербург, ул. Парковая, 4, лит Д, оф 255</span>
						</div>
					</div>
					<div class="site-footer__contact-item">
						<div class="site-footer__contact-value">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/ui_phone[grey].svg' ); ?>" alt="" class="site-footer__contact-icon">
							<a href="tel:+78005510236" class="site-footer__contact-link">+7 (800) 551-02-36</a>
						</div>
					</div>
					<div class="site-footer__contact-item">
						<div class="site-footer__contact-value">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/ui_letter[grey].svg' ); ?>" alt="" class="site-footer__contact-icon">
							<a href="mailto:info@gociss.ru" class="site-footer__contact-link">info@gociss.ru</a>
						</div>
					</div>
					<div class="site-footer__social">
						<a href="#" class="site-footer__social-link" aria-label="Telegram">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/social_tg.svg' ); ?>" alt="Telegram">
						</a>
						<a href="#" class="site-footer__social-link" aria-label="WhatsApp">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/social_wu.svg' ); ?>" alt="WhatsApp">
						</a>
					</div>
				</div>
			</div>

			<!-- Нижняя часть футера -->
			<div class="site-footer__bottom">
				<div class="site-footer__bottom-content">
					<p class="site-footer__copyright">&copy; <?php echo esc_html( date( 'Y' ) ); ?></p>
					<p class="site-footer__legal">Материалы, размещенные на сайте, носят информационный характер и ни при каких условиях не являются публичной офертой, определяемой положениями ст. 437 Гражданского кодекса РФ</p>
					<div class="site-footer__legal-links">
						<a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>" class="site-footer__legal-link">Политика конфиденциальности</a>
						<a href="<?php echo esc_url( home_url( '/terms/' ) ); ?>" class="site-footer__legal-link">Пользовательское соглашение</a>
					</div>
					<p class="site-footer__developer">
						Разработано <a href="https://join-site.ru" target="_blank" rel="noopener noreferrer">join-site.ru</a>
					</p>
				</div>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<!-- Кнопка "Наверх" -->
<button type="button" class="scroll-to-top" id="scrollToTop" aria-label="Наверх">
	<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M12 19V5M12 5L5 12M12 5L19 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
	</svg>
</button>

<?php
// Глобальный попап "Есть вопросы" для шапки/подвала
get_template_part( 'template-parts/forms/popup-callback' );
?>

<?php wp_footer(); ?>

</body>
</html>



