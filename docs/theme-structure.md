# Архитектура темы

Этот документ описывает структуру темы и принципы её организации.

## Структура файлов

```
wp-content/themes/gociss-theme/
├── assets/              # Статические файлы
│   ├── css/            # Стили
│   ├── js/             # JavaScript
│   ├── images/         # Изображения
│   └── fonts/          # Шрифты
├── inc/                # PHP файлы с логикой
│   ├── acf-fields.php  # Регистрация ACF полей
│   ├── custom-post-types.php  # Кастомные типы записей
│   ├── enqueue.php     # Подключение стилей и скриптов
│   ├── form-handler.php # Обработка форм
│   └── theme-setup.php # Настройка темы
├── template-parts/     # Части шаблонов
│   ├── hero.php        # Hero секция
│   ├── services.php    # Секция услуг
│   ├── stats.php       # Статистика
│   ├── advantages.php  # Преимущества
│   ├── experts.php     # Эксперты
│   ├── news.php        # Новости
│   ├── faq.php         # FAQ
│   ├── cta.php         # Призыв к действию
│   ├── form.php        # Форма обратной связи
│   └── content.php     # Шаблон контента
├── functions.php       # Главный файл темы
├── header.php          # Шапка сайта
├── footer.php          # Подвал сайта
├── index.php           # Главный шаблон
├── page-front.php      # Шаблон главной страницы
└── style.css           # Информация о теме
```

## Основные файлы

### functions.php

Главный файл темы. Подключает все остальные файлы из папки `inc/`. Здесь определяются константы темы.

### header.php и footer.php

Шапка и подвал сайта. Используются на всех страницах через функции `get_header()` и `get_footer()`.

### index.php

Главный шаблон. Определяет, какой контент показывать в зависимости от типа страницы.

### page-front.php

Шаблон для главной страницы (лендинга). Подключает все секции через `get_template_part()`.

## Папка inc/

Содержит всю логику темы, разделённую по файлам:

- **theme-setup.php** - настройки темы (меню, поддержка функций WordPress)
- **enqueue.php** - подключение CSS и JS файлов
- **acf-fields.php** - регистрация групп полей ACF
- **custom-post-types.php** - регистрация кастомных типов записей (например, "Эксперты")
- **form-handler.php** - обработка AJAX запросов форм

## Папка template-parts/

Содержит переиспользуемые части шаблонов. Каждая секция лендинга вынесена в отдельный файл:

- **hero.php** - главная секция с заголовком и CTA
- **services.php** - сетка услуг
- **stats.php** - статистика компании
- **advantages.php** - конкурентные преимущества
- **experts.php** - слайдер экспертов
- **news.php** - последние новости
- **faq.php** - часто задаваемые вопросы
- **cta.php** - призыв к действию
- **form.php** - форма обратной связи

## Папка assets/

Статические файлы:

- **css/** - все стили темы
- **js/** - JavaScript файлы
- **images/** - изображения темы (логотипы, иконки)
- **fonts/** - кастомные шрифты (если используются)

## Принципы организации

### Разделение ответственности

Каждый файл отвечает за свою область:
- Шаблоны только выводят данные
- Логика находится в `inc/`
- Стили и скрипты в `assets/`

### Переиспользование

Части шаблонов вынесены в `template-parts/` для переиспользования на разных страницах.

### Именование

- Файлы: kebab-case (например, `acf-fields.php`)
- Функции: snake_case с префиксом `gociss_` (например, `gociss_enqueue_scripts()`)
- CSS классы: BEM методология (например, `hero__title`)

## Как добавить новую секцию

1. Создай файл в `template-parts/`, например `template-parts/new-section.php`
2. Добавь ACF поля в `inc/acf-fields.php` (если нужны)
3. Подключи секцию в `page-front.php` через `get_template_part('template-parts/new-section')`
4. Добавь стили в `assets/css/style.css`
5. При необходимости добавь JavaScript в `assets/js/main.js`

## Работа с данными

Все данные для секций хранятся в ACF полях. Чтобы получить данные:

```php
$field_value = get_field('gociss_field_name');
```

Для репитеров:

```php
$items = get_field('gociss_repeater_name');
if ($items) {
    foreach ($items as $item) {
        echo $item['sub_field_name'];
    }
}
```

## Безопасность

Всегда экранируй вывод:

```php
echo esc_html($variable);        // Для текста
echo esc_attr($variable);        // Для атрибутов
echo esc_url($variable);         // Для URL
echo wp_kses_post($variable);    // Для HTML контента
```

Всегда санитизируй ввод:

```php
$clean = sanitize_text_field($_POST['field']);
$clean = sanitize_email($_POST['email']);
```



