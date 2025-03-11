<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateStorageLinkCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storage:create-link';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a symbolic link from public/storage to storage/app/public';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Creating symbolic link for storage...');
        
        try {
            $target = storage_path('app/public');
            $link = public_path('storage');
            
            if (file_exists($link)) {
                $this->info('The "public/storage" link already exists.');
                return;
            }
            
            if (File::exists($link)) {
                // Если это файл или директория (не симлинк), удалить
                if (!is_link($link)) {
                    File::deleteDirectory($link);
                    $this->info('Removed existing directory at ' . $link);
                }
            }
            
            if (symlink($target, $link)) {
                $this->info('The [' . $target . '] directory has been linked to [' . $link . ']');
            } else {
                $this->error('Could not create symbolic link from [' . $target . '] to [' . $link . ']');
                
                if (PHP_OS_FAMILY === 'Windows') {
                    $this->warn('On Windows, you may need to run this command with administrator privileges.');
                }
            }
        } catch (\Exception $e) {
            $this->error('Error creating symbolic link: ' . $e->getMessage());
        }
    }
}
