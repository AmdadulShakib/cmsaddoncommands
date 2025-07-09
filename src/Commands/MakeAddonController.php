<?php

namespace CMSAddonCommands\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;

class MakeAddonController extends Command
{
    protected $signature = 'addon:controller {addon} {name}';
    protected $description = 'Create a new Controller class inside a specific Addon';

    public function handle()
    {
        $addon = $this->argument('addon');
        $name = $this->argument('name');
        $addonPath = base_path("app/Addons/{$addon}/Controllers");
        $file = $addonPath . "/{$name}.php";

        if (!is_dir($addonPath)) {
            mkdir($addonPath, 0777, true);
        }

        if (file_exists($file)) {
            $this->error('Controller already exists!');
            return 1;
        }

        $namespace = "App\\Addons\\{$addon}\\Controllers";
        $stub = "<?php\n\nnamespace {$namespace};\n\nuse App\\Http\\Controllers\\Controller;\n\nclass {$name} extends Controller\n{\n    //\n}\n";
        file_put_contents($file, $stub);
        $this->info("Controller created: {$file}");
        return 0;
    }
}

