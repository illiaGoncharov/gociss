# Docker окружение для локальной разработки

Это руководство поможет настроить локальное окружение разработки с помощью Docker.

## Требования

- Docker Desktop установлен и запущен
- Docker Compose (входит в Docker Desktop)
- Минимум 2GB свободной RAM
- Порты 8080, 8081, 3306 свободны

## Быстрый старт

### Первый запуск

```bash
# 1. Клонируй репозиторий (если еще не клонирован)
git clone https://github.com/твой-username/gociss-theme.git
cd gociss-theme

# 2. Запусти Docker окружение
make up
# или
docker-compose up -d

# 3. Подожди 10-15 секунд (БД инициализируется)

# 4. Открой сайт в браузере
open http://localhost:8080
# или просто перейди на http://localhost:8080

# 5. Установи WordPress через браузер:
#    - Выбери язык
#    - Заполни данные (любые, для разработки)
#    - Запомни логин и пароль
```

### Вариант 1: Использование Makefile (Рекомендуется)

В проекте есть Makefile для удобной работы:

```bash
# Запустить окружение
make up

# Просмотр логов
make logs

# Остановка контейнеров
make down

# Войти в контейнер WordPress
make shell

# Выполнить WP-CLI команду
make wp CMD="plugin list"

# Создать резервную копию БД
make db-backup

# Показать все команды
make help
```

### Вариант 2: Прямые команды Docker Compose

```bash
# Запустить все контейнеры
docker-compose up -d

# Просмотр логов
docker-compose logs -f

# Остановка контейнеров
docker-compose down

# Остановка с удалением volumes (очистка БД)
docker-compose down -v
```

### 2. Первый запуск WordPress

1. Открой браузер и перейди на `http://localhost:8080`
2. Выбери язык установки
3. Заполни данные:
   - **Название сайта:** ГоЦИСС
   - **Имя пользователя:** admin (или своё)
   - **Пароль:** придумай надёжный пароль
   - **Email:** твой email
4. Нажми "Установить WordPress"

### 3. Активация темы

1. Зайди в админку: `http://localhost:8080/wp-admin`
2. Перейди в **Внешний вид → Темы**
3. Активируй тему "ГоЦИСС"

### 4. Установка плагинов

1. Перейди в **Плагины → Добавить новый**
2. Установи и активируй:
   - Advanced Custom Fields (ACF)
   - Polylang (если нужна мультиязычность)

## Структура контейнеров

### WordPress контейнер

- **Порт:** 8080
- **URL:** http://localhost:8080
- **Админка:** http://localhost:8080/wp-admin
- **Монтируется:** только тема `gociss-theme`

### MySQL контейнер

- **Порт:** 3306
- **База данных:** gociss_db
- **Пользователь:** gociss_user
- **Пароль:** gociss_password
- **Root пароль:** root_password

### phpMyAdmin контейнер

- **Порт:** 8081
- **URL:** http://localhost:8081
- **Логин:** root
- **Пароль:** root_password

## Полезные команды

### Работа с контейнерами

```bash
# Просмотр запущенных контейнеров
docker-compose ps

# Просмотр логов WordPress
docker-compose logs wordpress

# Просмотр логов БД
docker-compose logs db

# Перезапуск контейнера
docker-compose restart wordpress

# Выполнение команды в контейнере
docker-compose exec wordpress bash
docker-compose exec wordpress wp --info
```

### Работа с WordPress CLI

```bash
# Войти в контейнер WordPress
docker-compose exec wordpress bash

# Использовать WP-CLI
docker-compose exec wordpress wp plugin list
docker-compose exec wordpress wp theme list
docker-compose exec wordpress wp core update
```

### Работа с базой данных

```bash
# Подключиться к MySQL через контейнер
docker-compose exec db mysql -u gociss_user -pgociss_password gociss_db

# Или использовать phpMyAdmin
# Открой http://localhost:8081 в браузере
```

## Настройка

### Изменение портов

Если порты 8080, 8081 или 3306 заняты, измени их в `docker-compose.yml`:

```yaml
ports:
  - "8080:80"  # Измени 8080 на другой порт
```

### Изменение паролей БД

1. Создай файл `.env` на основе `.env.example`
2. Измени пароли в `.env`
3. Обнови `docker-compose.yml` для использования переменных из `.env`

Или измени напрямую в `docker-compose.yml`:

```yaml
environment:
  MYSQL_PASSWORD: твой_пароль
```

### Добавление дополнительных плагинов

Есть два способа:

**Способ 1: Через админку WordPress**
- Просто установи плагины через интерфейс
- Они сохранятся в volume `wp_plugins`

**Способ 2: Через WP-CLI**
```bash
docker-compose exec wordpress wp plugin install polylang --activate
```

## Отладка

### Просмотр логов

```bash
# Все логи
docker-compose logs

# Логи WordPress
docker-compose logs wordpress

# Логи в реальном времени
docker-compose logs -f wordpress
```

### Логи WordPress

Логи WordPress сохраняются в контейнере. Чтобы их посмотреть:

```bash
docker-compose exec wordpress tail -f /var/www/html/wp-content/debug.log
```

### Проверка подключения к БД

```bash
# Проверить, что БД доступна
docker-compose exec wordpress wp db check
```

## Резервное копирование

### Экспорт базы данных

```bash
# Через WP-CLI
docker-compose exec wordpress wp db export backup.sql

# Или через mysqldump
docker-compose exec db mysqldump -u gociss_user -pgociss_password gociss_db > backup.sql
```

### Импорт базы данных

```bash
# Через WP-CLI
docker-compose exec wordpress wp db import backup.sql

# Или через mysql
docker-compose exec -T db mysql -u gociss_user -pgociss_password gociss_db < backup.sql
```

## Решение проблем

### Контейнеры не запускаются

```bash
# Проверь логи
docker-compose logs

# Проверь, не заняты ли порты
lsof -i :8080
lsof -i :3306

# Пересоздай контейнеры
docker-compose down
docker-compose up -d
```

### WordPress не подключается к БД

1. Убедись, что контейнер `db` запущен: `docker-compose ps`
2. Проверь логи БД: `docker-compose logs db`
3. Проверь переменные окружения в `docker-compose.yml`
4. Подожди 10-15 секунд после запуска (БД нужно время на инициализацию)

### Изменения в теме не отображаются

1. Очисти кеш браузера (Ctrl+Shift+R)
2. Проверь, что файлы смонтированы правильно:
   ```bash
   docker-compose exec wordpress ls -la /var/www/html/wp-content/themes/
   ```
3. Перезапусти контейнер WordPress:
   ```bash
   docker-compose restart wordpress
   ```

### Ошибки прав доступа

```bash
# Исправь права в контейнере
docker-compose exec wordpress chown -R www-data:www-data /var/www/html/wp-content
docker-compose exec wordpress chmod -R 755 /var/www/html/wp-content
```

## Производительность

### Оптимизация для разработки

В `docker-compose.yml` уже включена отладка:
```yaml
WORDPRESS_DEBUG: 1
WORDPRESS_DEBUG_LOG: 1
WORDPRESS_DEBUG_DISPLAY: 0
```

Для продакшена отключи отладку:
```yaml
WORDPRESS_DEBUG: 0
```

### Увеличение лимитов PHP

Если нужно увеличить лимиты памяти или времени выполнения, создай `php.ini` и смонтируй его в контейнер.

## Очистка

### Удаление всех данных

```bash
# Остановить и удалить контейнеры и volumes
docker-compose down -v

# Удалить все неиспользуемые образы
docker system prune -a
```

### Сохранение данных

Volumes сохраняют данные между перезапусками. Если нужно сохранить данные:

```bash
# Экспорт volume
docker run --rm -v gociss_db_data:/data -v $(pwd):/backup alpine tar czf /backup/db_backup.tar.gz /data
```

## Полезные ссылки

- [Docker документация](https://docs.docker.com/)
- [Docker Compose документация](https://docs.docker.com/compose/)
- [WordPress Docker образ](https://hub.docker.com/_/wordpress)
- [MySQL Docker образ](https://hub.docker.com/_/mysql)

## Альтернативы

Если Docker не подходит, можно использовать:
- **Local by Flywheel** - готовое решение для WordPress
- **XAMPP** - традиционный локальный сервер
- **MAMP** - для macOS
- **Laravel Valet** - для macOS (требует Homebrew)

