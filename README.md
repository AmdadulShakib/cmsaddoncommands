# CMSAddonCommands Package

This package provides Laravel Artisan commands to help you quickly scaffold and manage Addon modules for your CMS project. You can use these commands to generate models, controllers, and migrations inside your Addon structure, similar to native Laravel commands.

## Installation

Install via Composer:

```
composer require amdadulshakib/cmsaddoncommands
```

## Usage

All commands are available via Artisan. Replace `CMSAuth` with your Addon name and `Test`/`Test2` with your desired class name.

### 1. Create a Model (with optional migration)

```
php artisan addon:model {AddonName} {ModelName}
```

Add `-m` to generate a migration as well:

```
php artisan addon:model {AddonName} {ModelName} -m
```

### Example:

```
php artisan addon:model CMSAuth Test
```

### 2. Create a Controller

```
php artisan addon:controller CMSAuth TestController
```

### 3. Create a Migration

```
php artisan addon:migration CMSAuth create_test_table
```

### 4. Run Addon Migrations

```
php artisan addon:migrate CMSAuth
```

### 5. Rollback Addon Migrations

```
php artisan addon:migrate:rollback CMSAuth
```

## Notes

- All generated files will be placed inside your Addon's folder (e.g., `app/Addons/CMSAuth/Models/`, `Controllers/`, `database/migrations/`).
- These commands are intended for developer use only. You can remove the package after development if you want to keep your production environment clean.

## License

MIT