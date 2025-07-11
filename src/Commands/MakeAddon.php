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
        $addonPath = base_path('app/addons/' . $name);

        if ($filesystem->exists($addonPath)) {
            $this->error('Addon already exists!');
            return 1;
        }

        // Create addon base directory
        $filesystem->makeDirectory($addonPath, 0755, true);
        // Create subdirectories (Controllers, Models, Migrations, etc.)
        $filesystem->makeDirectory($addonPath . '/Controllers', 0755, true);
        $filesystem->makeDirectory($addonPath . '/Models', 0755, true);
        $filesystem->makeDirectory($addonPath . '/database/migrations', 0755, true);
        $filesystem->makeDirectory($addonPath . '/routes', 0755, true);
        $filesystem->makeDirectory($addonPath . '/views', 0755, true);

        // Create a detailed composer.json file for the addon
        $composerJson = [
            'name' => strtolower($name),
            'description' => $name . ' addon',
            'type' => 'library',
            'license' => 'MIT',
            'authors' => [
                [
                    'name' => $name,
                    'email' => 'your.email@example.com'
                ]
            ],
            'nickname' => $name,
            'required_system_version' => '1.0',
            'is_default' => 1,
            'version' => '1.0.0',
            'required_addons' => null
        ];
        $filesystem->put($addonPath . '/composer.json', json_encode($composerJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

        // Create Activator.php with dynamic namespace
        $activatorNamespace = 'App\\Addons\\' . $name;
        $activatorClass = "<?php\n\nnamespace $activatorNamespace;\n\nclass Activator\n{\n    public function activate()\n    {\n\n    }\n\n    public function deactivate()\n    {\n\n    }\n\n    public function delete()\n    {\n\n    }\n}\n";
        $filesystem->put($addonPath . '/Activator.php', $activatorClass);

        // Create ServiceProvider file with dynamic class and namespace
        $serviceProviderClassName = $name . 'ServiceProvider';
        $serviceProviderNamespace = 'App\\Addons\\' . $name;
        $serviceProviderContent = "<?php\n\nnamespace $serviceProviderNamespace;\n\nuse App\\Addons\\CMSAuth\\Utils\\Utilities;\nuse App\\Lib\\Admin\\Sidenav;\nuse Illuminate\\Support\\ServiceProvider;\n\nclass $serviceProviderClassName extends ServiceProvider\n{\n    public function register()\n    {\n\n    }\n\n    public function boot()\n    {\n        \n    }\n}\n";
        $filesystem->put($addonPath . '/' . $serviceProviderClassName . '.php', $serviceProviderContent);

        $this->info('Addon created successfully!');
        return 0;
    }
}
