<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // reset cahced roles and permission
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        // Permission::create(['name' => 'Show Pengaturan']);
        Permission::create(['name' => 'Show Manajemen Menu']);
        // Permission::create(['name' => 'Show Manajemen Permissions']);
        // Permission::create(['name' => 'Show Manajemen User']);
        // Permission::create(['name' => 'publish posts']);
        // Permission::create(['name' => 'unpublish posts']);

        //create roles and assign existing permissions
        // $writerRole = Role::create(['name' => 'writer']);
        // $writerRole->givePermissionTo('view posts');
        // $writerRole->givePermissionTo('create posts');
        // $writerRole->givePermissionTo('edit posts');
        // $writerRole->givePermissionTo('delete posts');


        // $adminRole = Role::create(['name' => 'admin']);
        // $adminRole->givePermissionTo('view posts');
        // $adminRole->givePermissionTo('create posts');
        // $adminRole->givePermissionTo('edit posts');
        // $adminRole->givePermissionTo('delete posts');
        // $adminRole->givePermissionTo('publish posts');
        // $adminRole->givePermissionTo('unpublish posts');

        // $superadminRole = Role::create(['name' => 'super-admin']);

        // $user = User::factory()->create([
        //     'name' => 'Example user',
        //     'email' => 'writer@qadrlabs.com',
        //     'password' => bcrypt('12345678')
        // ]);
        // $user->assignRole($writerRole);

        // $user = User::factory()->create([
        //     'name' => 'Example admin user',
        //     'email' => 'admin@qadrlabs.com',
        //     'password' => bcrypt('12345678')
        // ]);
        // $user->assignRole($adminRole);

        // $user = User::factory()->create([
        //     'name' => 'Example superadmin user',
        //     'email' => 'superadmin@qadrlabs.com',
        //     'password' => bcrypt('12345678')
        // ]);
        // $user->assignRole($superadminRole);
    }
}
