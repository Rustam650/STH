<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CheckUserRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:check {email?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Проверить роль пользователя по email или вывести список всех пользователей';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');

        if ($email) {
            $user = User::where('email', $email)->first();

            if (!$user) {
                $this->error("Пользователь с email {$email} не найден.");
                return 1;
            }

            $this->info("Информация о пользователе:");
            $this->table(
                ['ID', 'Имя', 'Email', 'Роль', 'is_admin', 'isAdmin()'],
                [
                    [
                        $user->id,
                        $user->name,
                        $user->email,
                        $user->role,
                        $user->is_admin ? 'true' : 'false',
                        $user->isAdmin() ? 'true' : 'false',
                    ]
                ]
            );
        } else {
            $users = User::all();
            
            $this->info("Список всех пользователей:");
            $this->table(
                ['ID', 'Имя', 'Email', 'Роль', 'is_admin', 'isAdmin()'],
                $users->map(function ($user) {
                    return [
                        $user->id,
                        $user->name,
                        $user->email,
                        $user->role,
                        $user->is_admin ? 'true' : 'false',
                        $user->isAdmin() ? 'true' : 'false',
                    ];
                })
            );
        }
        
        return 0;
    }
}
