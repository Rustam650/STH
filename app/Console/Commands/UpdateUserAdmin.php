<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class UpdateUserAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:admin {email} {is_admin}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Обновить поле is_admin пользователя по email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $isAdmin = $this->argument('is_admin');
        
        // Преобразуем строковое значение в булево
        $isAdminBool = filter_var($isAdmin, FILTER_VALIDATE_BOOLEAN);

        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("Пользователь с email {$email} не найден.");
            return 1;
        }

        $user->is_admin = $isAdminBool;
        $user->save();

        $this->info("Поле is_admin пользователя {$email} успешно обновлено на " . ($isAdminBool ? 'true' : 'false') . ".");
        
        return 0;
    }
}
