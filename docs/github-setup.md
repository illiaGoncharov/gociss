# Настройка GitHub репозитория для темы

Это руководство поможет создать и настроить GitHub репозиторий только для темы WordPress.

## Структура репозитория

Репозиторий должен содержать только файлы темы:

```
gociss-theme/
├── wp-content/themes/gociss-theme/  # Сама тема
├── .github/workflows/               # GitHub Actions для деплоя
├── docs/                            # Документация
├── docker-compose.yml               # Docker для локальной разработки
├── Makefile                         # Команды для работы
├── .gitignore                       # Исключения для Git
├── .cursorrules                     # Правила для Cursor
├── package.json                     # Зависимости для линтеров
└── README.md                        # Описание проекта
```

## Создание репозитория

### Шаг 1: Создать репозиторий на GitHub

1. Зайди на GitHub.com
2. Нажми **New repository**
3. Заполни:
   - **Repository name:** `gociss-theme` (или `gociss-wordpress-theme`)
   - **Description:** WordPress тема для ГоЦИСС
   - **Visibility:** Private (или Public, если нужно)
   - **НЕ добавляй** README, .gitignore, license (у нас уже есть)
4. Нажми **Create repository**

### Шаг 2: Инициализация Git в проекте

```bash
# Перейди в папку проекта
cd /path/to/gociss

# Инициализируй Git (если еще не инициализирован)
git init

# Добавь все файлы
git add .

# Первый коммит
git commit -m "Initial commit: WordPress тема ГоЦИСС"

# Добавь удаленный репозиторий (замени URL на свой)
git remote add origin https://github.com/твой-username/gociss-theme.git

# Отправь код на GitHub
git branch -M main
git push -u origin main
```

### Шаг 3: Настройка секретов для деплоя

Если используешь автоматический деплой через GitHub Actions:

1. Перейди в настройки репозитория: **Settings → Secrets and variables → Actions**
2. Добавь секреты:
   - `BEGET_FTP_HOST` - адрес FTP сервера
   - `BEGET_FTP_USER` - логин FTP
   - `BEGET_FTP_PASSWORD` - пароль FTP

## Что коммитить, а что нет

### ✅ Коммитим:

- Всю папку `wp-content/themes/gociss-theme/`
- Конфигурационные файлы (`.gitignore`, `docker-compose.yml`, `package.json`)
- Документацию в `docs/`
- GitHub Actions workflows в `.github/`
- `.cursorrules`
- `README.md`, `Makefile`

### ❌ НЕ коммитим:

- WordPress core (wp-admin, wp-includes, wp-*.php)
- Плагины из `wp-content/plugins/`
- Загруженные файлы из `wp-content/uploads/`
- `wp-config.php` (содержит пароли)
- `.env` файлы
- `node_modules/`
- Логи и временные файлы

## Рабочий процесс

### Первый запуск через Docker

```bash
# Клонируй репозиторий
git clone https://github.com/твой-username/gociss-theme.git
cd gociss-theme

# Запусти Docker окружение
make up
# или
docker-compose up -d

# Открой сайт
open http://localhost:8080
```

### Ежедневная работа

```bash
# Получить обновления
git pull origin main

# Создать ветку для новой функции
git checkout -b feature/название-функции

# Внести изменения, протестировать локально через Docker
make up
# ... работа ...

# Закоммитить изменения
git add .
git commit -m "Описание изменений"

# Отправить на GitHub
git push origin feature/название-функции

# Создать Pull Request на GitHub
```

### После слияния Pull Request

```bash
# Вернуться в main
git checkout main

# Получить обновления
git pull origin main

# Удалить локальную ветку
git branch -d feature/название-функции
```

## Настройка .gitignore

Файл `.gitignore` уже настроен правильно. Он исключает:
- WordPress core
- Плагины
- Загруженные файлы
- Конфигурационные файлы с паролями
- Временные файлы

## Структура коммитов

Используй понятные сообщения коммитов:

```bash
# Хорошо
git commit -m "Добавлена секция отзывов на главной странице"
git commit -m "Исправлена ошибка в форме обратной связи"
git commit -m "Обновлены стили для мобильной версии"

# Плохо
git commit -m "Изменения"
git commit -m "fix"
git commit -m "update"
```

## Ветвление

Рекомендуемая структура веток:

- `main` - основная ветка, всегда рабочая версия
- `develop` - ветка разработки (опционально)
- `feature/название` - новая функция
- `fix/название` - исправление бага
- `hotfix/название` - срочное исправление

## Защита ветки main

Рекомендуется настроить защиту ветки `main`:

1. Перейди в **Settings → Branches**
2. Добавь правило для `main`:
   - ✅ Require pull request reviews before merging
   - ✅ Require status checks to pass before merging
   - ✅ Do not allow bypassing the above settings

## Полезные команды Git

```bash
# Просмотр статуса
git status

# Просмотр изменений
git diff

# Просмотр истории
git log --oneline -10

# Отмена изменений в файле
git checkout -- файл.php

# Отмена последнего коммита (локально)
git reset --soft HEAD~1

# Создание тега версии
git tag -a v1.0.0 -m "Версия 1.0.0"
git push origin v1.0.0
```

## Релизы и версионирование

Для релизов используй теги:

```bash
# Создать тег версии
git tag -a v1.0.0 -m "Релиз версии 1.0.0"

# Отправить тег на GitHub
git push origin v1.0.0
```

На GitHub можно создать Release:
1. Перейди в **Releases → Create a new release**
2. Выбери тег
3. Заполни описание изменений
4. Прикрепи файлы (если нужно)

## Интеграция с GitHub Actions

GitHub Actions автоматически:
- Проверяет код при создании Pull Request
- Деплоит тему на сервер при пуше в `main`

Настройка описана в [документации по деплою](deployment.md).

## Полезные ссылки

- [Git документация](https://git-scm.com/doc)
- [GitHub Guides](https://guides.github.com/)
- [Git Flow](https://www.atlassian.com/git/tutorials/comparing-workflows/gitflow-workflow)

