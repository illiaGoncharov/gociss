# WordPress тема для ГоЦИСС

Кастомная тема WordPress для сайта Головного центра испытаний, сертификации и стандартизации.

## Быстрый старт

1. Установи WordPress
2. Скопируй тему в `wp-content/themes/gociss-theme/`
3. Активируй тему в админке WordPress
4. Установи и активируй плагин Advanced Custom Fields (ACF)
5. Создай главную страницу и выбери шаблон "Главная страница"

## Структура проекта

```
├── wp-content/themes/gociss-theme/  # Тема WordPress
├── .github/workflows/               # GitHub Actions для деплоя
├── docs/                            # Документация
└── README.md                        # Этот файл
```

## Быстрый старт

```bash
# 1. Клонируй репозиторий
git clone https://github.com/твой-username/gociss-theme.git
cd gociss-theme

# 2. Запусти Docker
make up

# 3. Установи WordPress
make install

# 4. Открой http://localhost:8080
```

Подробная инструкция в [QUICKSTART.md](QUICKSTART.md)

## Документация

Вся документация находится в папке `/docs`:

- [Начальная настройка](docs/setup.md)
- [Docker окружение](docs/docker-setup.md) - локальная разработка
- [GitHub репозиторий](docs/github-setup.md) - настройка версионирования
- [Мультиязычность и мультирегиональность](docs/multilingual.md) - Polylang/WPML, поддомены vs директории
- [Архитектура темы](docs/theme-structure.md)
- [Работа с ACF](docs/acf-guide.md)
- [Деплой на Бегет](docs/deployment.md)
- [Процесс разработки](docs/development.md)
- [Решение проблем](docs/troubleshooting.md)

## Технологии

- WordPress 6.0+
- PHP 8.0+
- Advanced Custom Fields (ACF)
- Vanilla JavaScript
- CSS3

## Разработка

### Локальное окружение с Docker

```bash
# Запустить окружение
docker-compose up -d

# Открыть сайт
open http://localhost:8080
```

Подробнее в [документации по Docker](docs/docker-setup.md).

### Установка зависимостей

```bash
npm install
```

### Проверка кода

```bash
npm run lint
```

## Деплой

Деплой происходит автоматически при пуше в ветку `main` через GitHub Actions.

Подробнее в [документации по деплою](docs/deployment.md).

## Лицензия

GPL v2 or later

