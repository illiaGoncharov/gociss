<?php
/**
 * Форма обратной связи
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<section class="contact-form" id="form">
	<div class="container">
		<div class="contact-form__header">
			<a href="#form" class="contact-form__link">Связаться с нами</a>
			<h2 class="contact-form__title">Оставить заявку</h2>
			<p class="contact-form__description">
				Заполните форму, и наш эксперт свяжется с вами в течение 30 минут
			</p>
		</div>

		<form class="contact-form__form" id="gociss-contact-form" method="post">
			<?php wp_nonce_field( 'gociss_contact_form', 'gociss_contact_nonce' ); ?>

			<div class="contact-form__row">
				<div class="contact-form__field">
					<label for="gociss-name" class="contact-form__label">
						Ваше имя <span class="required">*</span>
					</label>
					<input
						type="text"
						id="gociss-name"
						name="gociss_name"
						class="contact-form__input"
						required
					/>
				</div>

				<div class="contact-form__field">
					<label for="gociss-company" class="contact-form__label">
						Название компании
					</label>
					<input
						type="text"
						id="gociss-company"
						name="gociss_company"
						class="contact-form__input"
					/>
				</div>
			</div>

			<div class="contact-form__row">
				<div class="contact-form__field">
					<label for="gociss-phone" class="contact-form__label">
						Телефон <span class="required">*</span>
					</label>
					<input
						type="tel"
						id="gociss-phone"
						name="gociss_phone"
						class="contact-form__input"
						required
					/>
				</div>

				<div class="contact-form__field">
					<label for="gociss-email" class="contact-form__label">
						Email <span class="required">*</span>
					</label>
					<input
						type="email"
						id="gociss-email"
						name="gociss_email"
						class="contact-form__input"
						required
					/>
				</div>
			</div>

			<div class="contact-form__field">
				<label for="gociss-service" class="contact-form__label">
					Тип услуги
				</label>
				<select id="gociss-service" name="gociss_service" class="contact-form__select">
					<option value="">Выберите тип услуги</option>
					<option value="iso">Сертификация ISO</option>
					<option value="reputation">Опыт и репутация</option>
					<option value="product">Сертификация продукции</option>
					<option value="personnel">Сертификация персонала</option>
					<option value="voluntary">Добровольная сертификация</option>
					<option value="training">Учебный центр</option>
				</select>
			</div>

			<div class="contact-form__field">
				<label class="contact-form__checkbox">
					<input
						type="checkbox"
						name="gociss_consent"
						required
					/>
					<span>Я согласен с политикой обработки персональных данных</span>
				</label>
			</div>

			<div class="contact-form__submit">
				<button type="submit" class="btn btn--primary">Отправить заявку</button>
			</div>

			<div class="contact-form__message" id="gociss-form-message"></div>
		</form>
	</div>
</section>



