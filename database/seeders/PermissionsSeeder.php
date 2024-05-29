<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list activities']);
        Permission::create(['name' => 'view activities']);
        Permission::create(['name' => 'create activities']);
        Permission::create(['name' => 'update activities']);
        Permission::create(['name' => 'delete activities']);

        Permission::create(['name' => 'list cities']);
        Permission::create(['name' => 'view cities']);
        Permission::create(['name' => 'create cities']);
        Permission::create(['name' => 'update cities']);
        Permission::create(['name' => 'delete cities']);

        Permission::create(['name' => 'list countries']);
        Permission::create(['name' => 'view countries']);
        Permission::create(['name' => 'create countries']);
        Permission::create(['name' => 'update countries']);
        Permission::create(['name' => 'delete countries']);

        Permission::create(['name' => 'list demandes']);
        Permission::create(['name' => 'view demandes']);
        Permission::create(['name' => 'create demandes']);
        Permission::create(['name' => 'update demandes']);
        Permission::create(['name' => 'delete demandes']);

        Permission::create(['name' => 'list favorites']);
        Permission::create(['name' => 'view favorites']);
        Permission::create(['name' => 'create favorites']);
        Permission::create(['name' => 'update favorites']);
        Permission::create(['name' => 'delete favorites']);

        Permission::create(['name' => 'list menus']);
        Permission::create(['name' => 'view menus']);
        Permission::create(['name' => 'create menus']);
        Permission::create(['name' => 'update menus']);
        Permission::create(['name' => 'delete menus']);

        Permission::create(['name' => 'list menuitems']);
        Permission::create(['name' => 'view menuitems']);
        Permission::create(['name' => 'create menuitems']);
        Permission::create(['name' => 'update menuitems']);
        Permission::create(['name' => 'delete menuitems']);

        Permission::create(['name' => 'list metas']);
        Permission::create(['name' => 'view metas']);
        Permission::create(['name' => 'create metas']);
        Permission::create(['name' => 'update metas']);
        Permission::create(['name' => 'delete metas']);

        Permission::create(['name' => 'list neighborhoods']);
        Permission::create(['name' => 'view neighborhoods']);
        Permission::create(['name' => 'create neighborhoods']);
        Permission::create(['name' => 'update neighborhoods']);
        Permission::create(['name' => 'delete neighborhoods']);

        Permission::create(['name' => 'list pings']);
        Permission::create(['name' => 'view pings']);
        Permission::create(['name' => 'create pings']);
        Permission::create(['name' => 'update pings']);
        Permission::create(['name' => 'delete pings']);

        Permission::create(['name' => 'list promotions']);
        Permission::create(['name' => 'view promotions']);
        Permission::create(['name' => 'create promotions']);
        Permission::create(['name' => 'update promotions']);
        Permission::create(['name' => 'delete promotions']);

        Permission::create(['name' => 'list restaurants']);
        Permission::create(['name' => 'view restaurants']);
        Permission::create(['name' => 'create restaurants']);
        Permission::create(['name' => 'update restaurants']);
        Permission::create(['name' => 'delete restaurants']);

        Permission::create(['name' => 'list reviews']);
        Permission::create(['name' => 'view reviews']);
        Permission::create(['name' => 'create reviews']);
        Permission::create(['name' => 'update reviews']);
        Permission::create(['name' => 'delete reviews']);

        Permission::create(['name' => 'list taxonomies']);
        Permission::create(['name' => 'view taxonomies']);
        Permission::create(['name' => 'create taxonomies']);
        Permission::create(['name' => 'update taxonomies']);
        Permission::create(['name' => 'delete taxonomies']);

        Permission::create(['name' => 'list terms']);
        Permission::create(['name' => 'view terms']);
        Permission::create(['name' => 'create terms']);
        Permission::create(['name' => 'update terms']);
        Permission::create(['name' => 'delete terms']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
