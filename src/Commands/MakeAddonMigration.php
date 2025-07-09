<?php

namespace CMSAddonCommands\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Date;

class MakeAddonMigration extends Command
{
    protected $signature = 'addon:migration {addon} {name}';
    protected $description = 'Create a new migration file inside a specific Addon';

    public function handle()
    {
        $addon = $this->argument('addon');
        $name = $this->argument('name');
        $timestamp = date('Y_m_d_His');
        $migrationName = $timestamp . '_' . Str::snake($name) . '.php';
        $addonPath = base_path("app/Addons/{$addon}/database/migrations");
        $file = $addonPath . "/{$migrationName}";

        if (!is_dir($addonPath)) {
            mkdir($addonPath, 0777, true);
        }

        if (file_exists($file)) {
            $this->error('Migration already exists!');
            return 1;
        }

        $stub = '<?php

use Illuminate\\Database\\Migrations\\Migration;
use Illuminate\\Database\\Schema\\Blueprint;
use Illuminate\\Support\\Facades\\Schema;

return new class extends Migration {
    public function up()
    {
        // Schema::create(\'table_name\', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        // });
    }

    public function down()
    {
        // Schema::dropIfExists(\'table_name\');
    }
};
';
        file_put_contents($file, $stub);
        $this->info("Migration created: {$file}");
        return 0;
    }
}
