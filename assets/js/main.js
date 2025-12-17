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
        initNewsSlider();
        initSearch();
        initMobileMenu();
        initInteractiveMap();
        // initServicesMenu(); // Услуги теперь в мобильном меню
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
            const answer = item.querySelector('.faq__answer');

            if (!question || !answer) {
                return;
            }

            question.addEventListener('click', function() {
                const wasOpen = item.classList.contains('is-open');

                // Закрываем все элементы
                faqItems.forEach(function(otherItem) {
                    const otherAnswer = otherItem.querySelector('.faq__answer');
                    const otherQuestion = otherItem.querySelector('.faq__question');

                    otherItem.classList.remove('is-open');
                    if (otherAnswer) {
                        otherAnswer.style.maxHeight = null;
                    }
                    if (otherQuestion) {
                        otherQuestion.setAttribute('aria-expanded', 'false');
                    }
                });

                // Открываем текущий, если он был закрыт
                if (!wasOpen) {
                    item.classList.add('is-open');
                    question.setAttribute('aria-expanded', 'true');
                    answer.style.maxHeight = answer.scrollHeight + 'px';
                }
            });
        });

        // Инициализация: открываем первый элемент
        const firstOpen = document.querySelector('.faq__item.is-open');
        if (firstOpen) {
            const firstAnswer = firstOpen.querySelector('.faq__answer');
            if (firstAnswer) {
                firstAnswer.style.maxHeight = firstAnswer.scrollHeight + 'px';
            }
        }
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
        const track = slider.querySelector('.experts__track');

        if (!prevBtn || !nextBtn || !grid || !track) {
            return;
        }

        let currentIndex = 0;
        const items = grid.querySelectorAll('.experts__item');
        const totalItems = items.length;

        // Определяем количество видимых элементов в зависимости от ширины экрана
        function getItemsPerView() {
            if (window.innerWidth <= 480) return 1;
            if (window.innerWidth <= 768) return 2;
            if (window.innerWidth <= 1024) return 3;
            return 4;
        }

        function getItemWidth() {
            if (items.length === 0) return 0;
            const item = items[0];
            const style = window.getComputedStyle(item);
            const gap = 24; // gap между элементами
            return item.offsetWidth + gap;
        }

        function updateSlider() {
            const itemWidth = getItemWidth();
            const translateX = -currentIndex * itemWidth;
            grid.style.transform = `translateX(${translateX}px)`;
            updateButtons();
        }

        function updateButtons() {
            const itemsPerView = getItemsPerView();
            const maxIndex = Math.max(0, totalItems - itemsPerView);

            prevBtn.disabled = currentIndex <= 0;
            nextBtn.disabled = currentIndex >= maxIndex;
        }

        prevBtn.addEventListener('click', function() {
            if (currentIndex > 0) {
                currentIndex--;
                updateSlider();
            }
        });

        nextBtn.addEventListener('click', function() {
            const itemsPerView = getItemsPerView();
            const maxIndex = Math.max(0, totalItems - itemsPerView);
            if (currentIndex < maxIndex) {
                currentIndex++;
                updateSlider();
            }
        });

        // Обновляем при изменении размера окна
        let resizeTimeout;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(function() {
                const itemsPerView = getItemsPerView();
                const maxIndex = Math.max(0, totalItems - itemsPerView);
                if (currentIndex > maxIndex) {
                    currentIndex = maxIndex;
                }
                updateSlider();
            }, 100);
        });

        // Инициализация
        updateButtons();
    }

    /**
     * Инициализация слайдера новостей
     */
    function initNewsSlider() {
        const slider = document.querySelector('.news__slider');

        if (!slider) {
            return;
        }

        const prevBtn = slider.querySelector('.news__nav--prev');
        const nextBtn = slider.querySelector('.news__nav--next');
        const grid = slider.querySelector('.news__grid');
        const track = slider.querySelector('.news__track');

        if (!prevBtn || !nextBtn || !grid || !track) {
            return;
        }

        let currentIndex = 0;
        const items = grid.querySelectorAll('.news__item');
        const totalItems = items.length;

        function getItemsPerView() {
            if (window.innerWidth <= 480) return 1;
            if (window.innerWidth <= 768) return 2;
            if (window.innerWidth <= 1024) return 3;
            return 4;
        }

        function getItemWidth() {
            if (items.length === 0) return 0;
            const item = items[0];
            const gap = 24;
            return item.offsetWidth + gap;
        }

        function updateSlider() {
            const itemWidth = getItemWidth();
            const translateX = -currentIndex * itemWidth;
            grid.style.transform = `translateX(${translateX}px)`;
            updateButtons();
        }

        function updateButtons() {
            const itemsPerView = getItemsPerView();
            const maxIndex = Math.max(0, totalItems - itemsPerView);

            prevBtn.disabled = currentIndex <= 0;
            nextBtn.disabled = currentIndex >= maxIndex;
        }

        prevBtn.addEventListener('click', function() {
            if (currentIndex > 0) {
                currentIndex--;
                updateSlider();
            }
        });

        nextBtn.addEventListener('click', function() {
            const itemsPerView = getItemsPerView();
            const maxIndex = Math.max(0, totalItems - itemsPerView);
            if (currentIndex < maxIndex) {
                currentIndex++;
                updateSlider();
            }
        });

        let resizeTimeout;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(function() {
                const itemsPerView = getItemsPerView();
                const maxIndex = Math.max(0, totalItems - itemsPerView);
                if (currentIndex > maxIndex) {
                    currentIndex = maxIndex;
                }
                updateSlider();
            }, 100);
        });

        updateButtons();
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
        toggleButton.addEventListener('click', function(e) {
            mobileMenu.classList.add('is-open');
            toggleButton.classList.add('is-active');
            document.body.style.overflow = 'hidden';
        });

        // Закрытие меню
        function closeMobileMenu() {
            mobileMenu.classList.remove('is-open');
            toggleButton.classList.remove('is-active');
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

    /**
     * Инициализация интерактивной карты России
     */
    function initInteractiveMap() {
        const mapContainer = document.getElementById('interactiveMap');
        const mapImage = document.getElementById('interactiveMapImage');
        const tooltip = document.getElementById('mapTooltip');
        const map = document.getElementById('russiaMap');

        if (!mapContainer || !mapImage || !map) {
            return;
        }

        const areas = map.querySelectorAll('area');

        if (!areas.length) {
            return;
        }

        // Обработка наведения на регион
        areas.forEach(function(area) {
            area.addEventListener('mouseenter', function(e) {
                const offset = area.getAttribute('data-offset');
                const regionName = area.getAttribute('alt') || area.getAttribute('title');

                // Изменяем позицию фона для подсветки региона
                if (offset) {
                    mapImage.style.backgroundPosition = '0px ' + offset;
                }

                // Показываем тултип
                if (tooltip && regionName) {
                    tooltip.textContent = regionName;
                    tooltip.classList.add('is-visible');
                }
            });

            area.addEventListener('mouseleave', function() {
                // Возвращаем исходную позицию фона
                mapImage.style.backgroundPosition = '0px 0px';

                // Скрываем тултип
                if (tooltip) {
                    tooltip.classList.remove('is-visible');
                }
            });

            area.addEventListener('mousemove', function(e) {
                if (tooltip) {
                    const containerRect = mapContainer.getBoundingClientRect();
                    const x = e.clientX - containerRect.left;
                    const y = e.clientY - containerRect.top;

                    tooltip.style.left = x + 'px';
                    tooltip.style.top = y + 'px';
                }
            });
        });

        // Масштабирование координат карты при изменении размера окна
        function scaleMapCoords() {
            const originalWidth = 528; // Исходная ширина карты
            const currentWidth = mapImage.offsetWidth;
            const scale = currentWidth / originalWidth;

            areas.forEach(function(area) {
                const originalCoords = area.getAttribute('data-original-coords');

                // Сохраняем исходные координаты при первом вызове
                if (!originalCoords) {
                    area.setAttribute('data-original-coords', area.getAttribute('coords'));
                }

                const coords = (originalCoords || area.getAttribute('coords')).split(',');
                const scaledCoords = coords.map(function(coord) {
                    return Math.round(parseInt(coord, 10) * scale);
                });

                area.setAttribute('coords', scaledCoords.join(','));
            });
        }

        // Масштабируем координаты при загрузке
        if (mapImage.complete) {
            scaleMapCoords();
        } else {
            mapImage.addEventListener('load', scaleMapCoords);
        }

        // Масштабируем при изменении размера окна
        let resizeTimeout;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(scaleMapCoords, 100);
        });
    }

    /**
     * Инициализация выдвижного меню услуг на мобильных
     */
    function initServicesMenu() {
        const servicesMenu = document.querySelector('.header-services');
        const toggleButton = document.querySelector('.header-services__toggle');

        if (!servicesMenu || !toggleButton) {
            return;
        }

        // Переключаем состояние меню при клике на кнопку
        toggleButton.addEventListener('click', function(e) {
            e.preventDefault();
            servicesMenu.classList.toggle('is-collapsed');
        });

        // На десктопе меню всегда развернуто
        function handleResize() {
            if (window.innerWidth > 768) {
                servicesMenu.classList.remove('is-collapsed');
            } else if (!servicesMenu.hasAttribute('data-user-interaction')) {
                servicesMenu.classList.add('is-collapsed');
                servicesMenu.setAttribute('data-user-interaction', 'false');
            }
        }

        // Отмечаем взаимодействие пользователя
        toggleButton.addEventListener('click', function() {
            servicesMenu.setAttribute('data-user-interaction', 'true');
        }, { once: false });

        // Проверяем при загрузке
        handleResize();

        // Проверяем при изменении размера окна
        let resizeTimer;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(handleResize, 250);
        });
    }
})();
