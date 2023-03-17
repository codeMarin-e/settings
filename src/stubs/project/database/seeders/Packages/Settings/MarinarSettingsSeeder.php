<?php
namespace Database\Seeders\Packages\Settings;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class MarinarSettingsSeeder extends Seeder {

    public function run() {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        Permission::upsert([
            ['guard_name' => 'admin', 'name' => 'settings.view'],
            ['guard_name' => 'admin', 'name' => 'settings.update'],
        ], ['guard_name','name']);
    }
}
