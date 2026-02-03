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
        initGostAccordion();
        initVacanciesAccordion();
        initForm();
        initHeroSlider();
        initExpertsSlider();
        initNewsSlider();
        initSearch();
        initMobileMenu();
        initScrollToTop();
        initRegionSwitcher();
        initRegistrySearch();
        // initInteractiveMap(); // Карта теперь статичная PNG
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
     * Инициализация аккордеона групп ГОСТов
     */
    function initGostAccordion() {
        const gostGroups = document.querySelectorAll('.gost-group');

        if (!gostGroups.length) {
            return;
        }

        gostGroups.forEach(function(group) {
            const header = group.querySelector('.gost-group__header');
            const content = group.querySelector('.gost-group__content');
            const toggle = group.querySelector('.gost-group__toggle');

            if (!header || !content) {
                return;
            }

            header.addEventListener('click', function() {
                const wasOpen = group.classList.contains('is-open');

                // Закрываем все группы
                gostGroups.forEach(function(otherGroup) {
                    const otherContent = otherGroup.querySelector('.gost-group__content');
                    const otherToggle = otherGroup.querySelector('.gost-group__toggle');

                    otherGroup.classList.remove('is-open');
                    if (otherContent) {
                        otherContent.style.maxHeight = null;
                    }
                    if (otherToggle) {
                        otherToggle.setAttribute('aria-expanded', 'false');
                    }
                });

                // Открываем текущую группу, если она была закрыта
                if (!wasOpen) {
                    group.classList.add('is-open');
                    if (toggle) {
                        toggle.setAttribute('aria-expanded', 'true');
                    }
                    content.style.maxHeight = content.scrollHeight + 'px';
                }
            });
        });

        // Инициализация: открываем первую группу
        const firstOpenGroup = document.querySelector('.gost-group.is-open');
        if (firstOpenGroup) {
            const firstContent = firstOpenGroup.querySelector('.gost-group__content');
            if (firstContent) {
                firstContent.style.maxHeight = firstContent.scrollHeight + 'px';
            }
        }
    }

    /**
     * Инициализация аккордеона вакансий
     */
    function initVacanciesAccordion() {
        const accordions = document.querySelectorAll('.vacancy-accordion');

        if (!accordions.length) {
            return;
        }

        accordions.forEach(function(accordion) {
            const header = accordion.querySelector('.vacancy-accordion__header');
            const content = accordion.querySelector('.vacancy-accordion__content');

            if (!header || !content) {
                return;
            }

            header.addEventListener('click', function() {
                const wasOpen = accordion.classList.contains('is-open');

                // Переключаем состояние текущего аккордеона
                if (wasOpen) {
                    accordion.classList.remove('is-open');
                    header.setAttribute('aria-expanded', 'false');
                    content.style.maxHeight = null;
                } else {
                    accordion.classList.add('is-open');
                    header.setAttribute('aria-expanded', 'true');
                    content.style.maxHeight = content.scrollHeight + 'px';
                }
            });
        });

        // Инициализация: открываем первый элемент в каждой карточке вакансии
        const vacancyCards = document.querySelectorAll('.vacancy-card');
        vacancyCards.forEach(function(card) {
            const firstOpen = card.querySelector('.vacancy-accordion.is-open');
            if (firstOpen) {
                const firstContent = firstOpen.querySelector('.vacancy-accordion__content');
                if (firstContent) {
                    firstContent.style.maxHeight = firstContent.scrollHeight + 'px';
                }
            }
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
     * Инициализация слайдера Hero-секции
     * Автоматическая смена изображений с fade-эффектом
     */
    function initHeroSlider() {
        const slider = document.querySelector('.hero__slider');

        if (!slider) {
            return;
        }

        const slides = slider.querySelectorAll('.hero__slide');
        const prevBtn = slider.querySelector('.hero__nav--prev');
        const nextBtn = slider.querySelector('.hero__nav--next');

        // Если только один слайд — слайдер не нужен
        if (slides.length <= 1) {
            return;
        }

        let currentIndex = 0;
        let intervalId = null;
        const autoplayDelay = 4500; // 4.5 секунды между слайдами

        // Переключение на конкретный слайд
        function goToSlide(index) {
            // Убираем активный класс у всех
            slides.forEach(function(slide) {
                slide.classList.remove('is-active');
            });

            // Добавляем активный класс нужному слайду
            currentIndex = index;
            slides[currentIndex].classList.add('is-active');
        }

        // Следующий слайд
        function nextSlide() {
            const nextIndex = (currentIndex + 1) % slides.length;
            goToSlide(nextIndex);
        }

        // Предыдущий слайд
        function prevSlide() {
            const prevIndex = (currentIndex - 1 + slides.length) % slides.length;
            goToSlide(prevIndex);
        }

        // Запуск автопрокрутки
        function startAutoplay() {
            if (intervalId) {
                clearInterval(intervalId);
            }
            intervalId = setInterval(nextSlide, autoplayDelay);
        }

        // Остановка автопрокрутки
        function stopAutoplay() {
            if (intervalId) {
                clearInterval(intervalId);
                intervalId = null;
            }
        }

        // Клик по невидимым кнопкам навигации
        if (prevBtn) {
            prevBtn.addEventListener('click', function() {
                prevSlide();
                startAutoplay(); // Перезапускаем таймер
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', function() {
                nextSlide();
                startAutoplay(); // Перезапускаем таймер
            });
        }

        // Пауза при наведении на слайдер
        slider.addEventListener('mouseenter', stopAutoplay);
        slider.addEventListener('mouseleave', startAutoplay);

        // Запускаем автопрокрутку
        startAutoplay();
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
     * Инициализация переключателя регионов в хедере
     */
    function initRegionSwitcher() {
        const switcher = document.querySelector('.region-switcher');
        const toggle = document.querySelector('.region-switcher__toggle');
        const dropdown = document.querySelector('.region-switcher__dropdown');

        if (!switcher || !toggle) {
            return;
        }

        // Открытие/закрытие по клику на кнопку
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            const isOpen = switcher.classList.contains('is-open');

            if (isOpen) {
                closeRegionSwitcher();
            } else {
                openRegionSwitcher();
            }
        });

        // Закрытие по клику вне переключателя
        document.addEventListener('click', function(e) {
            if (!switcher.contains(e.target)) {
                closeRegionSwitcher();
            }
        });

        // Закрытие по Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && switcher.classList.contains('is-open')) {
                closeRegionSwitcher();
            }
        });

        function openRegionSwitcher() {
            switcher.classList.add('is-open');
            toggle.setAttribute('aria-expanded', 'true');
        }

        function closeRegionSwitcher() {
            switcher.classList.remove('is-open');
            toggle.setAttribute('aria-expanded', 'false');
        }
    }

    /**
     * Инициализация SVG карты России
     */
    function initInteractiveMap() {
        const mapContainer = document.querySelector('.russia-map');
        const tooltip = document.getElementById('russiaMapTooltip');

        if (!mapContainer || !tooltip) {
            return;
        }

        const regions = mapContainer.querySelectorAll('.russia-map__region');

        if (!regions.length) {
            return;
        }

        // Обработка наведения на регион
        regions.forEach(function(region) {
            region.addEventListener('mouseenter', function() {
                const regionName = region.getAttribute('data-name');
                if (regionName) {
                    tooltip.textContent = regionName;
                    tooltip.classList.add('is-visible');
                }
            });

            region.addEventListener('mouseleave', function() {
                tooltip.classList.remove('is-visible');
            });

            region.addEventListener('mousemove', function(e) {
                const containerRect = mapContainer.getBoundingClientRect();
                const x = e.clientX - containerRect.left;
                const y = e.clientY - containerRect.top;

                tooltip.style.left = x + 'px';
                tooltip.style.top = y + 'px';
            });
        });
    }

    /**
     * Инициализация кнопки "Наверх"
     */
    function initScrollToTop() {
        const scrollToTopBtn = document.getElementById('scrollToTop');

        if (!scrollToTopBtn) {
            return;
        }

        // Показываем/скрываем кнопку при скролле
        function toggleScrollBtn() {
            if (window.scrollY > 400) {
                scrollToTopBtn.classList.add('is-visible');
            } else {
                scrollToTopBtn.classList.remove('is-visible');
            }
        }

        // Слушаем скролл с throttle для производительности
        let ticking = false;
        window.addEventListener('scroll', function() {
            if (!ticking) {
                window.requestAnimationFrame(function() {
                    toggleScrollBtn();
                    ticking = false;
                });
                ticking = true;
            }
        });

        // Клик по кнопке — плавный скролл наверх
        scrollToTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Проверяем начальное состояние
        toggleScrollBtn();
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

    /**
     * Инициализация поиска в реестре сертификатов
     */
    function initRegistrySearch() {
        const searchForms = document.querySelectorAll('.registry-search-form');

        if (!searchForms.length) {
            return;
        }

        searchForms.forEach(function(form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                handleRegistrySearch(form);
            });

            // Поиск при нажатии на иконку
            const searchIcon = form.querySelector('.registry-search-form__search-icon');
            if (searchIcon) {
                searchIcon.addEventListener('click', function() {
                    handleRegistrySearch(form);
                });
            }

            // Поиск при нажатии Enter в поле ввода
            const input = form.querySelector('.registry-search-form__input');
            if (input) {
                input.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        handleRegistrySearch(form);
                    }
                });
            }
        });
    }

    /**
     * Обработка AJAX-поиска сертификатов
     *
     * @param {HTMLFormElement} form Форма поиска
     */
    function handleRegistrySearch(form) {
        const registryType = form.getAttribute('data-registry-type');
        const input = form.querySelector('.registry-search-form__input');
        const resultsContainer = document.getElementById('results-' + registryType);

        if (!input || !resultsContainer) {
            return;
        }

        const query = input.value.trim();

        if (!query) {
            showRegistryError(resultsContainer, 'Введите данные для поиска');
            return;
        }

        if (query.length < 3) {
            showRegistryError(resultsContainer, 'Введите минимум 3 символа');
            return;
        }

        // Получаем nonce
        const nonceField = form.querySelector('[name="registry_nonce_' + registryType + '"]');
        const nonce = nonceField ? nonceField.value : '';

        // Показываем лоадер
        showRegistryLoader(resultsContainer);

        // Создаём данные для запроса
        const formData = new FormData();
        formData.append('action', 'gociss_search_certificates');
        formData.append('query', query);
        formData.append('registry_type', registryType);
        formData.append('nonce', nonce);

        // Отправляем AJAX запрос
        fetch(gocissAjax.ajaxurl, {
            method: 'POST',
            body: formData
        })
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            if (data.success) {
                showRegistryResults(resultsContainer, data.data.results, data.data.count);
            } else {
                showRegistryError(resultsContainer, data.data.message || 'Ничего не найдено');
            }
        })
        .catch(function(error) {
            showRegistryError(resultsContainer, 'Произошла ошибка. Попробуйте позже.');
            console.error('Registry search error:', error);
        });
    }

    /**
     * Показать лоадер в результатах
     *
     * @param {HTMLElement} container Контейнер результатов
     */
    function showRegistryLoader(container) {
        const loader = container.querySelector('.registry-search-results__loader');
        const error = container.querySelector('.registry-search-results__error');
        const count = container.querySelector('.registry-search-results__count');
        const cards = container.querySelector('.registry-search-results__cards');

        if (loader) loader.style.display = 'flex';
        if (error) error.style.display = 'none';
        if (count) count.style.display = 'none';
        if (cards) cards.innerHTML = '';
    }

    /**
     * Показать ошибку в результатах
     *
     * @param {HTMLElement} container Контейнер результатов
     * @param {string} message Сообщение об ошибке
     */
    function showRegistryError(container, message) {
        const loader = container.querySelector('.registry-search-results__loader');
        const error = container.querySelector('.registry-search-results__error');
        const count = container.querySelector('.registry-search-results__count');
        const cards = container.querySelector('.registry-search-results__cards');

        if (loader) loader.style.display = 'none';
        if (error) {
            error.style.display = 'block';
            error.textContent = message;
        }
        if (count) count.style.display = 'none';
        if (cards) cards.innerHTML = '';
    }

    /**
     * Показать результаты поиска
     *
     * @param {HTMLElement} container Контейнер результатов
     * @param {Array} results Массив результатов
     * @param {number} totalCount Количество найденных
     */
    function showRegistryResults(container, results, totalCount) {
        const loader = container.querySelector('.registry-search-results__loader');
        const error = container.querySelector('.registry-search-results__error');
        const countEl = container.querySelector('.registry-search-results__count');
        const cards = container.querySelector('.registry-search-results__cards');

        if (loader) loader.style.display = 'none';
        if (error) error.style.display = 'none';

        // Показываем количество
        if (countEl) {
            countEl.style.display = 'block';
            countEl.textContent = 'Найдено: ' + totalCount + ' ' + getResultsWord(totalCount);
        }

        // Рендерим карточки
        if (cards) {
            cards.innerHTML = results.map(renderCertificateCard).join('');
        }
    }

    /**
     * Рендер карточки сертификата
     *
     * @param {Object} cert Данные сертификата
     * @return {string} HTML карточки
     */
    function renderCertificateCard(cert) {
        return `
            <div class="registry-card">
                <div class="registry-card__header">
                    <h3 class="registry-card__company">${escapeHtml(cert.company)}</h3>
                    <span class="registry-card__status ${cert.status_class}">${escapeHtml(cert.status_label)}</span>
                </div>
                <div class="registry-card__body">
                    <div class="registry-card__row">
                        <span class="registry-card__label">ИНН:</span>
                        <span class="registry-card__value">${escapeHtml(cert.inn)}</span>
                    </div>
                    <div class="registry-card__row">
                        <span class="registry-card__label">Сертификат:</span>
                        <span class="registry-card__value">${escapeHtml(cert.type)}</span>
                    </div>
                    <div class="registry-card__row">
                        <span class="registry-card__label">Рег. номер:</span>
                        <span class="registry-card__value">${escapeHtml(cert.number)}</span>
                    </div>
                    <div class="registry-card__row">
                        <span class="registry-card__label">Период действия:</span>
                        <span class="registry-card__value">${escapeHtml(cert.date_start)} — ${escapeHtml(cert.date_end)}</span>
                    </div>
                </div>
            </div>
        `;
    }

    /**
     * Экранирование HTML
     *
     * @param {string} text Текст для экранирования
     * @return {string} Экранированный текст
     */
    function escapeHtml(text) {
        if (!text) return '';
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    /**
     * Склонение слова "сертификат"
     *
     * @param {number} count Количество
     * @return {string} Слово в правильной форме
     */
    function getResultsWord(count) {
        const lastDigit = count % 10;
        const lastTwoDigits = count % 100;

        if (lastTwoDigits >= 11 && lastTwoDigits <= 19) {
            return 'сертификатов';
        }

        if (lastDigit === 1) {
            return 'сертификат';
        }

        if (lastDigit >= 2 && lastDigit <= 4) {
            return 'сертификата';
        }

        return 'сертификатов';
    }
})();
