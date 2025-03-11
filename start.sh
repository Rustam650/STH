#!/bin/bash

echo "🚀 Запуск проекта SThill..."

# Проверка наличия PHP
if ! command -v php &> /dev/null; then
    echo "❌ PHP не установлен. Пожалуйста, установите PHP."
    exit 1
fi

# Проверка наличия Composer
if ! command -v composer &> /dev/null; then
    echo "❌ Composer не установлен. Пожалуйста, установите Composer."
    exit 1
fi

echo "📦 Установка зависимостей..."
composer install

echo "🔑 Генерация ключа приложения..."
php artisan key:generate --ansi

echo "📁 Создание символической ссылки для хранилища..."
php artisan storage:link

echo "🗄️ Запуск миграций базы данных..."
php artisan migrate

echo "🌐 Запуск веб-сервера..."
echo "✅ Сайт будет доступен по адресу: http://localhost:8000"
echo "✅ Админ-панель будет доступна по адресу: http://localhost:8000/admin"
php artisan serve
