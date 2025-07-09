<?php

namespace CMSAddonCommands\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;

class MakeAddonModel extends Command
{
    protected $signature = 'addon:model {addon} {name} {--m|migration}';
    protected $description = 'Create a new Eloquent model class inside a specific Addon';

    public function handle()
    {
        $addon = $this->argument('addon');
        $name = $this->argument('name');
        $addonPath = base_path("app/Addons/{$addon}/Models");
        $file = $addonPath . "/{$name}.php";

        if (!is_dir($addonPath)) {
            mkdir($addonPath, 0777, true);
        }

        if (file_exists($file)) {
            $this->error('Model already exists!');
            return 1;
        }

        $namespace = "App\\Addons\\{$addon}\\Models";
        $stub = "<?php\n\nnamespace {$namespace};\n\nuse Illuminate\\Database\\Eloquent\\Model;\n\nclass {$name} extends Model\n{\n    //\n}\n";
        file_put_contents($file, $stub);
        $this->info("Model created: {$file}");

        // If --migration or -m flag is set, create migration as well
        if ($this->option('migration')) {
            $migrationPath = base_path("app/Addons/{$addon}/database/migrations");
            if (!is_dir($migrationPath)) {
                mkdir($migrationPath, 0777, true);
            }
            $this->call('addon:migration', [
                'addon' => $addon,
                'name' => 'create_' . Str::snake(Str::pluralStudly($name)) . '_table',
            ]);
        }
        return 0;
    }
}
