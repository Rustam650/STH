<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DatabaseMonitorCommand extends Command
{
    protected $signature = 'db:monitor';
    protected $description = 'Monitor database connection and status';

    public function handle()
    {
        $this->info('Проверка подключения к базе данных...');

        try {
            // Проверка подключения
            DB::connection()->getPdo();
            $this->info('✓ Подключение к базе данных успешно');
            $this->info('Database: ' . DB::connection()->getDatabaseName());
            
            // Проверка таблиц
            $tables = DB::select('SHOW TABLES');
            $this->info('Существующие таблицы:');
            foreach ($tables as $table) {
                $tableName = array_values((array)$table)[0];
                $count = DB::table($tableName)->count();
                $this->info("- {$tableName}: {$count} записей");
            }

            return 0;
        } catch (\Exception $e) {
            $this->error('✗ Ошибка подключения к базе данных:');
            $this->error($e->getMessage());
            return 1;
        }
    }
} 