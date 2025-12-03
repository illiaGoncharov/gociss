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
		initSearch();
		initMobileMenu();
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

	/**
	 * Инициализация поиска
	 */
	function initSearch() {
		const searchButton = document.querySelector('.header-top__search');

		if (!searchButton) {
			return;
		}

		// Создаём модальное окно поиска
		const searchModal = document.createElement('div');
		searchModal.className = 'search-modal';
		searchModal.innerHTML = `
			<div class="search-modal__overlay"></div>
			<div class="search-modal__content">
				<button class="search-modal__close" aria-label="Закрыть поиск">&times;</button>
				<form role="search" method="get" class="search-form" action="${window.location.origin}/">
					<label>
						<span class="screen-reader-text">Поиск:</span>
						<input type="search" class="search-field" placeholder="Введите запрос для поиска..." value="" name="s" required>
					</label>
					<button type="submit" class="search-submit">Найти</button>
				</form>
			</div>
		`;
		document.body.appendChild(searchModal);

		const overlay = searchModal.querySelector('.search-modal__overlay');
		const closeButton = searchModal.querySelector('.search-modal__close');
		const searchField = searchModal.querySelector('.search-field');

		// Открытие модального окна
		searchButton.addEventListener('click', function(e) {
			e.preventDefault();
			searchModal.classList.add('is-open');
			setTimeout(function() {
				searchField.focus();
			}, 100);
		});

		// Закрытие модального окна
		function closeSearch() {
			searchModal.classList.remove('is-open');
		}

		if (overlay) {
			overlay.addEventListener('click', closeSearch);
		}

		if (closeButton) {
			closeButton.addEventListener('click', closeSearch);
		}

		// Закрытие по Escape
		document.addEventListener('keydown', function(e) {
			if (e.key === 'Escape' && searchModal.classList.contains('is-open')) {
				closeSearch();
			}
		});
	}

	/**
	 * Инициализация мобильного меню
	 */
	function initMobileMenu() {
		const toggleButton = document.querySelector('.header-mobile-toggle');
		const mobileMenu = document.querySelector('.header-mobile-menu');
		const closeButton = document.querySelector('.header-mobile-menu__close');
		const overlay = document.querySelector('.header-mobile-menu__overlay');

		if (!toggleButton || !mobileMenu) {
			return;
		}

		// Открытие меню
		toggleButton.addEventListener('click', function() {
			mobileMenu.classList.add('is-open');
			document.body.style.overflow = 'hidden';
		});

		// Закрытие меню
		function closeMobileMenu() {
			mobileMenu.classList.remove('is-open');
			document.body.style.overflow = '';
		}

		if (closeButton) {
			closeButton.addEventListener('click', closeMobileMenu);
		}

		if (overlay) {
			overlay.addEventListener('click', closeMobileMenu);
		}

		// Закрытие по Escape
		document.addEventListener('keydown', function(e) {
			if (e.key === 'Escape' && mobileMenu.classList.contains('is-open')) {
				closeMobileMenu();
			}
		});

		// Закрытие меню при клике на ссылки
		const menuLinks = mobileMenu.querySelectorAll('.header-mobile-menu__list a');
		menuLinks.forEach(function(link) {
			link.addEventListener('click', function() {
				closeMobileMenu();
			});
		});
	}
})();

