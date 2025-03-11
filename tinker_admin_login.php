<?php

/**
 * Этот скрипт нужно выполнить через Tinker: php artisan tinker --execute="require 'tinker_admin_login.php';"
 */

// Найти администратора
$admin = \App\Models\User::where('role', 'admin')->first();

if (!$admin) {
    echo "Администратор не найден. Выполните php artisan db:seed --class=AdminUserSeeder для создания учетной записи админа.\n";
    return;
}

// Проверяем существование таблицы personal_access_tokens перед созданием токена
$hasTokenTable = \Illuminate\Support\Facades\Schema::hasTable('personal_access_tokens');

// Создать токен доступа, если используется Sanctum и таблица существует
if (class_exists('Laravel\Sanctum\Sanctum') && $hasTokenTable) {
    $token = $admin->createToken('admin-token');
    echo "Создан токен доступа:\n{$token->plainTextToken}\n";
} elseif (class_exists('Laravel\Sanctum\Sanctum') && !$hasTokenTable) {
    echo "ВНИМАНИЕ: Таблица personal_access_tokens не существует.\n";
    echo "Выполните команду: php artisan migrate, чтобы создать необходимую таблицу для токенов.\n";
}

echo "Данные для входа в админ-панель:\n";
echo "Email: {$admin->email}\n";
echo "Пароль: admin123 (если не менялся в сидере)\n";

if ($admin->isAdmin()) {
    echo "Статус: администратор\n";
} else {
    echo "ВНИМАНИЕ: Пользователь не имеет роли администратора!\n";
}
