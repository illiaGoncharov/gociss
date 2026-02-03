<?php
/**
 * Template Part: Карточка сертификата в результатах поиска
 *
 * Этот шаблон используется как reference для JavaScript рендеринга.
 * Фактическое отображение происходит через JS.
 *
 * @package Gociss
 *
 * Структура данных карточки (для JS):
 * {
 *     id: int,
 *     inn: string,
 *     company: string,
 *     number: string,
 *     type: string,
 *     date_start: string,
 *     date_end: string,
 *     status: string,
 *     status_label: string,
 *     status_class: string
 * }
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<!-- Пример HTML структуры карточки (используется JS для рендеринга) -->
<!--
<div class="registry-card">
	<div class="registry-card__header">
		<h3 class="registry-card__company">ООО "Название компании"</h3>
		<span class="registry-card__status registry-card__status--active">Действует</span>
	</div>
	<div class="registry-card__body">
		<div class="registry-card__row">
			<span class="registry-card__label">ИНН:</span>
			<span class="registry-card__value">7714038980</span>
		</div>
		<div class="registry-card__row">
			<span class="registry-card__label">Сертификат:</span>
			<span class="registry-card__value">ISO 9001:2015</span>
		</div>
		<div class="registry-card__row">
			<span class="registry-card__label">Рег. номер:</span>
			<span class="registry-card__value">СМК-001234</span>
		</div>
		<div class="registry-card__row">
			<span class="registry-card__label">Период действия:</span>
			<span class="registry-card__value">15.03.2024 — 14.03.2027</span>
		</div>
	</div>
</div>
-->

<?php
/**
 * JavaScript шаблон для карточки
 * Используется функцией gocissRenderCertificateCard() в main.js
 */
?>
<script type="text/template" id="registry-card-template">
<div class="registry-card">
	<div class="registry-card__header">
		<h3 class="registry-card__company">{{company}}</h3>
		<span class="registry-card__status {{status_class}}">{{status_label}}</span>
	</div>
	<div class="registry-card__body">
		<div class="registry-card__row">
			<span class="registry-card__label">ИНН:</span>
			<span class="registry-card__value">{{inn}}</span>
		</div>
		<div class="registry-card__row">
			<span class="registry-card__label">Сертификат:</span>
			<span class="registry-card__value">{{type}}</span>
		</div>
		<div class="registry-card__row">
			<span class="registry-card__label">Рег. номер:</span>
			<span class="registry-card__value">{{number}}</span>
		</div>
		<div class="registry-card__row">
			<span class="registry-card__label">Период действия:</span>
			<span class="registry-card__value">{{date_start}} — {{date_end}}</span>
		</div>
	</div>
</div>
</script>


