<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ApplicationInstall extends Command
{
    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'app:install';

    /**
     * The console command description.
     * @var string
     */
    protected $description = 'Application installation.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->callSilent('storage:link');

        $this->makeDirectories();
    }

    /**
     * Create directories.
     * @return void
     */
    protected function makeDirectories()
    {
        $directories = $this->directories();

        foreach ($directories as $dir) {
            $path = storage_path('app/public/');
            $directory = $path . $dir;
            if (! file_exists($directory)) {
                $this->laravel->make('files')
                    ->makeDirectory($directory);
            }
        }
    }

    /**
     * Get the directory list.
     * @return array
     */
    protected function directories()
    {
        return ['avatars', 'images', 'files'];
    }

}
