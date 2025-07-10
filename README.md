# CMSAddonCommands Package

This package provides Laravel Artisan commands to help you quickly scaffold and manage Addon modules for your CMS project. You can use these commands to generate models, controllers, and migrations inside your Addon structure, similar to native Laravel commands.

## Installation

Install via Composer:

```
composer require amdadulshakib/cmsaddoncommands
```

## Usage

All commands are available via Artisan. Replace `{AddonName}` with your Addon name and `{ClassName}` with your desired class name.

### 1. Create a New Addon

**Command:**
```
php artisan make:addon {AddonName}
```
**Example:**
```
php artisan make:addon Blog
```

---

### 2. Create a Model (with optional migration)

**Command:**
```
php artisan addon:model {AddonName} {ModelName}
```
**With migration:**
```
php artisan addon:model {AddonName} {ModelName} -m
```
**Example:**
```
php artisan addon:model Blog Post -m
```

---

### 3. Create a Controller

**Command:**
```
php artisan addon:controller {AddonName} {ControllerName}
```
**Example:**
```
php artisan addon:controller Blog PostController
```

---

### 4. Create a Migration

**Command:**
```
php artisan addon:migration {AddonName} {MigrationName}
```
**Example:**
```
php artisan addon:migration Blog create_posts_table
```

---

### 5. Run Addon Migrations

**Command:**
```
php artisan addon:migrate {AddonName}
```
**Example:**
```
php artisan addon:migrate Blog
```

---

### 6. Rollback Addon Migrations

**Command:**
```
php artisan addon:migrate:rollback {AddonName}
```
**Example:**
```
php artisan addon:migrate:rollback Blog
```

---

## Notes

- All generated files will be placed inside your Addon's folder (e.g., `addons/Blog/Models/`, `Controllers/`, `Migrations/`, `Views/`).
- These commands are intended for developer use only. You can remove the package after development if you want to keep your production environment clean.

## License

MIT