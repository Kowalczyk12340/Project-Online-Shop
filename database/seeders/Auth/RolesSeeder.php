<?php 

namespace Database\Seeders\Auth;

use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder 
{
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $admin = Role::create(['name' => config('app.admin_role')]);
        $user = Role::create(['name' => config('app.user_role')]);
    }
} 