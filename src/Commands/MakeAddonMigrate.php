<?php

namespace CMSAddonCommands\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Migrations\Migrator;
use Illuminate\Filesystem\Filesystem;

class MakeAddonMigrate extends Command
{
    protected $signature = 'addon:migrate {addon}';
    protected $description = 'Run the migrations for a specific Addon';

    public function handle()
    {
        $addon = $this->argument('addon');
        $migrationPath = base_path("app/Addons/{$addon}/database/migrations");

        if (!is_dir($migrationPath)) {
            $this->error("No migration folder found for Addon: {$addon}");
            return 1;
        }

        // Check if there are any migration files
        $files = glob($migrationPath . '/*.php');
        if (empty($files)) {
            $this->info("No migration files found for Addon: {$addon}");
            return 0;
        }

        $relativePath = str_replace(base_path() . DIRECTORY_SEPARATOR, '', $migrationPath);
        $relativePath = str_replace('\\', '/', $relativePath); // Ensure forward slashes for Laravel

        $this->call('migrate', [
            '--path' => $relativePath,
            '--force' => true,
        ]);

        $this->info("Addon migrations run for: {$addon}");
        return 0;
    }
}