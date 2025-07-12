<?php

namespace CMSAddonCommands;

use Illuminate\Support\ServiceProvider;
use CMSAddonCommands\Commands\MakeAddonController;
use CMSAddonCommands\Commands\MakeAddonMigrate;
use CMSAddonCommands\Commands\MakeAddonMigrateRollback;
use CMSAddonCommands\Commands\MakeAddonMigration;
use CMSAddonCommands\Commands\MakeAddonModel;
*****use CMSAddonCommands\Commands\MakeAddon;

class CMSAddonCommandServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->commands([
            MakeAddon::class,
            MakeAddonController::class,
            MakeAddonMigrate::class,
            MakeAddonMigrateRollback::class,
            MakeAddonMigration::class,
            MakeAddonModel::class,
        ]);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        //
    }
}