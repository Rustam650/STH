<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateHomeSectionsDirectoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storage:create-home-sections-directory';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the directory for home sections images';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Creating home_sections directory in storage...');
        
        try {
            $directory = storage_path('app/public/home_sections');
            
            if (File::exists($directory)) {
                $this->info('Directory already exists: ' . $directory);
                return;
            }
            
            File::makeDirectory($directory, 0755, true);
            $this->info('Directory created successfully: ' . $directory);
            
            // Создаем дефолтное изображение для использования при отсутствии загруженных
            $defaultImagePath = $directory . '/default-bg.jpg';
            if (!File::exists($defaultImagePath)) {
                // Проверяем существование изображения в public/images
                $sourceImagePath = public_path('images/default-bg.jpg');
                
                if (File::exists($sourceImagePath)) {
                    File::copy($sourceImagePath, $defaultImagePath);
                    $this->info('Default background image copied to ' . $defaultImagePath);
                } else {
                    // Создаем пустое изображение если нет исходного
                    $this->info('No default image found at ' . $sourceImagePath);
                    $this->info('Please upload a default background image manually.');
                }
            }
        } catch (\Exception $e) {
            $this->error('Error creating home_sections directory: ' . $e->getMessage());
        }
    }
}
