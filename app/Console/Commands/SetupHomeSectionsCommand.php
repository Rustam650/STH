<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class SetupHomeSectionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:setup-home-sections';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup home sections functionality with all requirements';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Starting setup of home sections functionality...');
        
        // Шаг 1: Проверка и выполнение миграции
        $this->info('Step 1: Checking and running migration...');
        if (!Schema::hasTable('home_sections')) {
            $this->info('Running migration for home_sections table...');
            Artisan::call('migrate', [
                '--path' => 'database/migrations/2024_01_01_000000_create_home_sections_table.php'
            ]);
            $this->info('Migration completed.');
        } else {
            $this->info('Table home_sections already exists.');
        }
        
        // Шаг 2: Проверка и создание символической ссылки для хранилища
        $this->info('Step 2: Creating storage symbolic link...');
        if (!file_exists(public_path('storage'))) {
            $this->info('Creating symlink...');
            Artisan::call('storage:link');
            $this->info('Symlink created.');
        } else {
            $this->info('Symlink already exists.');
        }
        
        // Шаг 3: Создание директории для изображений
        $this->info('Step 3: Creating home sections directory...');
        $directory = storage_path('app/public/home_sections');
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
            $this->info('Directory created: ' . $directory);
        } else {
            $this->info('Directory already exists: ' . $directory);
        }
        
        // Шаг 4: Добавление демо-данных, если таблица пуста
        $this->info('Step 4: Adding demo data if needed...');
        if (Schema::hasTable('home_sections')) {
            $count = \DB::table('home_sections')->count();
            if ($count === 0) {
                $this->info('Adding demo sections...');
                Artisan::call('db:seed', ['--class' => 'Database\Seeders\HomeSectionSeeder']);
                $this->info('Demo data added.');
            } else {
                $this->info('Table already has data. Skipping demo data.');
            }
        }
        
        $this->info('Setup completed successfully!');
    }
}
