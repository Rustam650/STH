<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class UpdateUserRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:role {email} {role}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Обновить роль пользователя по email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $role = $this->argument('role');

        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("Пользователь с email {$email} не найден.");
            return 1;
        }

        $user->role = $role;
        $user->save();

        $this->info("Роль пользователя {$email} успешно обновлена на {$role}.");
        
        return 0;
    }
}
