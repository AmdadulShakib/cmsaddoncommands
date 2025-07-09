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

        $this->call('migrate', [
            '--path' => str_replace(base_path() . '/', '', $migrationPath),
            '--force' => true,
        ]);
        $this->info("Addon migrations run for: {$addon}");
        return 0;
    }
}

