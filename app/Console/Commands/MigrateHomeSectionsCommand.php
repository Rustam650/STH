<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class MigrateHomeSectionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:home-sections';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run migration for home_sections table';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Starting migration for home_sections table...');
        
        try {
            if (Schema::hasTable('home_sections')) {
                $this->info('Table home_sections already exists. Skipping migration.');
            } else {
                $this->info('Running migration...');
                Artisan::call('migrate', [
                    '--path' => 'database/migrations/2024_01_01_000000_create_home_sections_table.php'
                ]);
                
                $output = Artisan::output();
                $this->info($output);
                
                if (Schema::hasTable('home_sections')) {
                    $this->info('Table home_sections successfully created!');
                } else {
                    $this->error('Failed to create home_sections table. Please check your database connection.');
                }
            }
        } catch (\Exception $e) {
            $this->error('Error during migration: ' . $e->getMessage());
            $this->error('Stack trace: ' . $e->getTraceAsString());
        }
    }
}
