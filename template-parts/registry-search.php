<?php
/**
 * Template Part: Блок поиска в реестре
 *
 * @package Gociss
 *
 * @var array $args {
 *     @type string $registry_type Тип реестра (management, personnel, reputation)
 *     @type string $title         Заголовок блока
 *     @type string $subtitle      Подзаголовок
 *     @type string $placeholder   Placeholder для поля поиска
 *     @type string $hint          Подсказка под полем
 * }
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Получаем параметры из $args
$registry_type = isset( $args['registry_type'] ) ? $args['registry_type'] : 'management';
$title         = isset( $args['title'] ) ? $args['title'] : 'Реестр сертификатов';
$subtitle      = isset( $args['subtitle'] ) ? $args['subtitle'] : '';
$placeholder   = isset( $args['placeholder'] ) ? $args['placeholder'] : 'Поиск';
$hint          = isset( $args['hint'] ) ? $args['hint'] : '';

// Уникальный ID для формы
$form_id = 'registry-search-' . $registry_type;
?>

<div class="registry-search-block" data-registry-type="<?php echo esc_attr( $registry_type ); ?>">
	<div class="registry-search-block__header">
		<h2 class="registry-search-block__title"><?php echo esc_html( $title ); ?></h2>
		<?php if ( $subtitle ) : ?>
			<p class="registry-search-block__subtitle"><?php echo esc_html( $subtitle ); ?></p>
		<?php endif; ?>
	</div>

	<form class="registry-search-form" id="<?php echo esc_attr( $form_id ); ?>" data-registry-type="<?php echo esc_attr( $registry_type ); ?>">
		<div class="registry-search-form__input-wrapper">
			<input
				type="text"
				class="registry-search-form__input"
				name="search_query"
				placeholder="<?php echo esc_attr( $placeholder ); ?>"
				autocomplete="off"
			>
			<button type="button" class="registry-search-form__search-icon" aria-label="Искать">
				<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M9 17C13.4183 17 17 13.4183 17 9C17 4.58172 13.4183 1 9 1C4.58172 1 1 4.58172 1 9C1 13.4183 4.58172 17 9 17Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M19 19L14.65 14.65" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</button>
		</div>
		<?php if ( $hint ) : ?>
			<p class="registry-search-form__hint"><?php echo esc_html( $hint ); ?></p>
		<?php endif; ?>

		<?php wp_nonce_field( 'gociss_certificate_search', 'registry_nonce_' . $registry_type ); ?>

		<button type="submit" class="registry-search-form__submit btn btn--primary">
			Найти сертификат
		</button>
	</form>

	<!-- Область для результатов -->
	<div class="registry-search-results" id="results-<?php echo esc_attr( $registry_type ); ?>">
		<!-- Лоадер -->
		<div class="registry-search-results__loader" style="display: none;">
			<div class="registry-search-results__spinner"></div>
			<span>Поиск...</span>
		</div>

		<!-- Сообщение об ошибке -->
		<div class="registry-search-results__error" style="display: none;"></div>

		<!-- Количество результатов -->
		<div class="registry-search-results__count" style="display: none;"></div>

		<!-- Карточки результатов -->
		<div class="registry-search-results__cards"></div>
	</div>
</div>

