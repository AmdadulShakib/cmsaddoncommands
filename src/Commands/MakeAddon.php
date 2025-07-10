<?php

namespace CMSAddonCommands\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeAddon extends Command
{
    protected $signature = 'make:addon {name}';
    protected $description = 'Create a new addon with the necessary folder structure';

    public function handle()
    {
        $name = $this->argument('name');
        $filesystem = new Filesystem();
        $addonPath = base_path('addons/' . $name);

        if ($filesystem->exists($addonPath)) {
            $this->error('Addon already exists!');
            return 1;
        }

        // Create addon base directory
        $filesystem->makeDirectory($addonPath, 0755, true);
        // Create subdirectories (Controllers, Models, Migrations, etc.)
        $filesystem->makeDirectory($addonPath . '/Controllers', 0755, true);
        $filesystem->makeDirectory($addonPath . '/Models', 0755, true);
        $filesystem->makeDirectory($addonPath . '/Migrations', 0755, true);
        $filesystem->makeDirectory($addonPath . '/Views', 0755, true);

        // Optionally, create a basic addon.json or config file
        $filesystem->put($addonPath . '/addon.json', json_encode(['name' => $name, 'created_at' => now()], JSON_PRETTY_PRINT));

        $this->info('Addon created successfully!');
        return 0;
    }
}

