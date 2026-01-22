<?php
/**
 * Template Name: Реестр сертификатов
 *
 * Шаблон страницы реестра с поиском по сертификатам
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main class="registry-page">
	<!-- Хлебные крошки -->
	<section class="breadcrumbs">
		<div class="container">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a>
		</div>
	</section>

	<!-- Заголовок -->
	<section class="registry-hero">
		<div class="container">
			<h1 class="registry-hero__title">Реестр сертификатов</h1>
			<p class="registry-hero__description">
				Найдите необходимые сертификаты в нашей базе данных. Выберите подходящую категорию и введите данные для поиска.
			</p>
		</div>
	</section>

	<!-- Блоки поиска -->
	<section class="registry-search-section">
		<div class="container">
			<div class="registry-search-grid">
				<?php
				// Блок 1: Системы менеджмента, услуги, НОКС
				get_template_part(
					'template-parts/registry-search',
					null,
					array(
						'registry_type' => 'management',
						'title'         => 'Реестр сертификатов',
						'subtitle'      => 'Системы менеджмента, услуги, НОКС',
						'placeholder'   => 'Поиск',
						'hint'          => 'Введите учетный номер или ИНН (ОГРНИП) организации',
					)
				);

				// Блок 2: Персонал
				get_template_part(
					'template-parts/registry-search',
					null,
					array(
						'registry_type' => 'personnel',
						'title'         => 'Реестр сертификатов',
						'subtitle'      => 'Персонал',
						'placeholder'   => 'Поиск',
						'hint'          => 'Введите номер сертификата соответствия или учетный номер',
					)
				);

				// Блок 3: Опыт и деловая репутация
				get_template_part(
					'template-parts/registry-search',
					null,
					array(
						'registry_type' => 'reputation',
						'title'         => 'Реестр сертификатов',
						'subtitle'      => 'Опыт и деловая репутация',
						'placeholder'   => 'Поиск',
						'hint'          => 'Введите ИНН, ОГРНИП',
					)
				);
				?>
			</div>
		</div>
	</section>

	<!-- Форма обратной связи -->
	<?php get_template_part( 'template-parts/form' ); ?>
</main>

<?php
get_footer();

