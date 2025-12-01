/**
 * Основной JavaScript файл темы
 *
 * @package Gociss
 */

(function() {
	'use strict';

	// Инициализация при загрузке DOM
	document.addEventListener('DOMContentLoaded', function() {
		initFAQ();
		initForm();
		initExpertsSlider();
	});

	/**
	 * Инициализация FAQ аккордеона
	 */
	function initFAQ() {
		const faqItems = document.querySelectorAll('.faq__item');
		
		if (!faqItems.length) {
			return;
		}

		faqItems.forEach(function(item) {
			const question = item.querySelector('.faq__question');
			
			if (!question) {
				return;
			}

			question.addEventListener('click', function() {
				const isOpen = item.classList.contains('is-open');
				
				// Закрываем все элементы
				faqItems.forEach(function(otherItem) {
					otherItem.classList.remove('is-open');
					const otherQuestion = otherItem.querySelector('.faq__question');
					if (otherQuestion) {
						otherQuestion.setAttribute('aria-expanded', 'false');
					}
				});

				// Открываем текущий, если он был закрыт
				if (!isOpen) {
					item.classList.add('is-open');
					question.setAttribute('aria-expanded', 'true');
				}
			});
		});
	}

	/**
	 * Инициализация формы обратной связи
	 */
	function initForm() {
		const form = document.getElementById('gociss-contact-form');
		
		if (!form) {
			return;
		}

		form.addEventListener('submit', function(e) {
			e.preventDefault();

			const formData = new FormData(form);
			const messageDiv = document.getElementById('gociss-form-message');

			// Добавляем action для AJAX
			formData.append('action', 'gociss_contact_form');

			// Отправка через AJAX
			fetch(gocissAjax.ajaxurl, {
				method: 'POST',
				body: formData
			})
			.then(function(response) {
				return response.json();
			})
			.then(function(data) {
				if (messageDiv) {
					if (data.success) {
						messageDiv.className = 'contact-form__message contact-form__message--success';
						messageDiv.textContent = data.data.message || 'Спасибо! Ваша заявка отправлена.';
						form.reset();
					} else {
						messageDiv.className = 'contact-form__message contact-form__message--error';
						messageDiv.textContent = data.data.message || 'Произошла ошибка. Попробуйте еще раз.';
					}
				}
			})
			.catch(function(error) {
				if (messageDiv) {
					messageDiv.className = 'contact-form__message contact-form__message--error';
					messageDiv.textContent = 'Произошла ошибка. Попробуйте еще раз.';
				}
				console.error('Form submission error:', error);
			});
		});
	}

	/**
	 * Инициализация слайдера экспертов
	 */
	function initExpertsSlider() {
		const slider = document.querySelector('.experts__slider');
		
		if (!slider) {
			return;
		}

		const prevBtn = slider.querySelector('.experts__nav--prev');
		const nextBtn = slider.querySelector('.experts__nav--next');
		const grid = slider.querySelector('.experts__grid');
		
		if (!prevBtn || !nextBtn || !grid) {
			return;
		}

		let currentIndex = 0;
		const items = grid.querySelectorAll('.experts__item');
		const itemsPerView = 4;

		function updateSlider() {
			const translateX = -currentIndex * (100 / itemsPerView);
			grid.style.transform = `translateX(${translateX}%)`;
		}

		prevBtn.addEventListener('click', function() {
			if (currentIndex > 0) {
				currentIndex--;
				updateSlider();
			}
		});

		nextBtn.addEventListener('click', function() {
			const maxIndex = Math.max(0, items.length - itemsPerView);
			if (currentIndex < maxIndex) {
				currentIndex++;
				updateSlider();
			}
		});
	}
})();

