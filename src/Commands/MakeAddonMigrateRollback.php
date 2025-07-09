<?php

namespace CMSAddonCommands\Commands;

use Illuminate\Console\Command;

class MakeAddonMigrateRollback extends Command
{
    protected $signature = 'addon:migrate:rollback {addon}';
    protected $description = 'Rollback the last batch of migrations for a specific Addon';

    public function handle()
    {
        $addon = $this->argument('addon');
        $migrationPath = base_path("app/Addons/{$addon}/database/migrations");

        if (!is_dir($migrationPath)) {
            $this->error("No migration folder found for Addon: {$addon}");
            return 1;
        }

        $this->call('migrate:rollback', [
            '--path' => str_replace(base_path() . '/', '', $migrationPath),
            '--force' => true,
        ]);
        $this->info("Addon migrations rolled back for: {$addon}");
        return 0;
    }
}

