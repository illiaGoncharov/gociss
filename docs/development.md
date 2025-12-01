# Процесс разработки

Этот документ описывает рабочий процесс разработки темы.

## Начало работы

### Клонирование репозитория

```bash
git clone <url-репозитория>
cd gociss
```

### Установка зависимостей

```bash
# Установка Node.js зависимостей для линтеров
npm install
```

## Рабочий процесс с Git

### Основные команды

```bash
# Проверка статуса
git status

# Добавление файлов
git add .

# Коммит изменений
git commit -m "Описание изменений"

# Отправка на GitHub
git push origin main

# Получение обновлений
git pull origin main
```

### Создание ветки для новой функции

```bash
# Создание новой ветки
git checkout -b feature/название-функции

# Работа над изменениями
# ... вноси изменения ...

# Коммит
git add .
git commit -m "Добавлена новая функция"

# Отправка ветки на GitHub
git push origin feature/название-функции

# Создание Pull Request на GitHub
# После слияния можно вернуться в main
git checkout main
git pull origin main
```

## Локальная разработка

### Настройка локального окружения

1. Установи локальный сервер (XAMPP, MAMP, Local by Flywheel)
2. Создай базу данных MySQL
3. Установи WordPress
4. Скопируй тему в `wp-content/themes/`
5. Активируй тему в админке

### Полезные плагины для разработки

- **Query Monitor** - отладка запросов к БД
- **Debug Bar** - информация о работе WordPress
- **Show Current Template** - показывает используемый шаблон

### Включение отладки

В файле `wp-config.php` добавь:

```php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
```

Логи будут сохраняться в `wp-content/debug.log`.

## Проверка кода

### Запуск линтеров

```bash
# Проверка JavaScript
npm run lint:js

# Проверка CSS
npm run lint:css

# Проверка всего
npm run lint
```

### Исправление ошибок

Линтеры покажут ошибки и предупреждения. Исправь их перед коммитом.

### PHP CodeSniffer

Для проверки PHP кода (требуется установка через Composer):

```bash
# Установка (один раз)
composer global require squizlabs/php_codesniffer
composer global require wp-coding-standards/wpcs

# Проверка
phpcs --standard=phpcs.xml wp-content/themes/gociss-theme/
```

## Добавление новой функции

### Шаг 1: Планирование

Определи:
- Что нужно сделать?
- Какие файлы нужно изменить?
- Нужны ли новые ACF поля?
- Нужны ли новые стили/скрипты?

### Шаг 2: Создание ветки

```bash
git checkout -b feature/название-функции
```

### Шаг 3: Разработка

1. Внеси изменения в код
2. Протестируй локально
3. Проверь код линтерами
4. Убедись, что всё работает

### Шаг 4: Коммит

```bash
git add .
git commit -m "Описание изменений"
```

Сообщения коммитов должны быть понятными:
- ✅ Хорошо: "Добавлена секция отзывов на главной странице"
- ❌ Плохо: "Изменения"

### Шаг 5: Push и Pull Request

```bash
git push origin feature/название-функции
```

Создай Pull Request на GitHub для ревью кода.

## Работа с ACF

### Добавление нового поля

1. Открой `inc/acf-fields.php`
2. Найди нужную группу полей
3. Добавь новое поле в массив `fields`
4. Используй поле в шаблоне через `get_field()`

### Пример добавления поля

```php
array(
    'key'   => 'field_gociss_new_field',
    'label' => 'Новое поле',
    'name'  => 'gociss_new_field',
    'type'  => 'text',
),
```

## Работа со стилями

### Структура CSS

Все стили в `assets/css/style.css`. Используй CSS переменные для цветов и размеров.

### Добавление новых стилей

1. Определи, к какой секции относятся стили
2. Добавь стили в соответствующий раздел файла
3. Используй BEM методологию для классов
4. Проверь адаптивность на мобильных устройствах

### Пример структуры классов

```css
/* Блок */
.section {
    /* стили блока */
}

/* Элемент */
.section__title {
    /* стили элемента */
}

/* Модификатор */
.section--dark {
    /* стили модификатора */
}
```

## Работа с JavaScript

### Структура JS

Основной файл: `assets/js/main.js`. Код организован в функции.

### Добавление новой функции

1. Создай функцию в `main.js`
2. Вызови её в `DOMContentLoaded` событии
3. Используй `gocissAjax` для AJAX запросов

### Пример

```javascript
function initNewFeature() {
    const element = document.querySelector('.new-feature');
    if (!element) return;
    
    // логика функции
}

// Инициализация
document.addEventListener('DOMContentLoaded', function() {
    initNewFeature();
});
```

## Тестирование

### Что тестировать

1. **Функциональность** - всё работает как задумано?
2. **Адаптивность** - сайт выглядит хорошо на мобильных?
3. **Совместимость** - работает в разных браузерах?
4. **Производительность** - страница загружается быстро?

### Инструменты для тестирования

- **Chrome DevTools** - отладка и проверка адаптивности
- **Lighthouse** - проверка производительности
- **BrowserStack** - тестирование в разных браузерах

## Отладка

### Частые проблемы

**Белый экран:**
- Проверь `wp-content/debug.log`
- Включи `WP_DEBUG` в `wp-config.php`

**Стили не применяются:**
- Очисти кеш браузера (Ctrl+Shift+R)
- Проверь, что файлы подключены в `inc/enqueue.php`

**ACF поля не отображаются:**
- Убедись, что плагин ACF активирован
- Проверь, что поля зарегистрированы в `inc/acf-fields.php`
- Убедись, что используешь правильные имена полей

## Полезные ресурсы

- [WordPress Codex](https://codex.wordpress.org/)
- [WordPress Developer Handbook](https://developer.wordpress.org/)
- [ACF Documentation](https://www.advancedcustomfields.com/resources/)
- [MDN Web Docs](https://developer.mozilla.org/)



