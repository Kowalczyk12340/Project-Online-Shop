<?php

namespace Database\Seeders\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersSeeder extends Seeder 
{
    public function run()
    {
        $user = User::create([
            'name' => 'Marcin Administrator',
            'email' => 'marcin.admin@kowalczyk.com',
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'password' => Hash::make('marcingrafik1#'),
        ]);

        $adminRole = Role::findByName(config('app.admin_role'));
        if(isset($adminRole)) {
            $user->assignRole($adminRole);
        }

        $user = User::create([
            'name' => 'Renata Administrator',
            'email' => 'renata.admin@kowalczyk.com',
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'password' => Hash::make('marcingrafik1#'),
        ]);

        $adminRole = Role::findByName(config('app.admin_role'));
        if(isset($adminRole)) {
            $user->assignRole($adminRole);
        }

        $user = User::create([
            'name' => 'Marcin Kowalczyk',
            'email' => 'marcin.kowalczyk@kowalczyk.com',
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'password' => Hash::make('marcingrafik1#'),
        ]);

        $userRole = Role::findByName(config('app.user_role'));
        if(isset($userRole)) {
            $user->assignRole($userRole);
        }

        $user = User::create([
            'name' => 'Renata Kowalczyk',
            'email' => 'renata.kowalczyk@kowalczyk.com',
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'password' => Hash::make('marcingrafik1#'),
        ]);

        $userRole = Role::findByName(config('app.user_role'));
        if(isset($userRole)) {
            $user->assignRole($userRole);
        }

        $user = User::create([
            'name' => 'Tomasz Kowalczyk',
            'email' => 'tomasz.kowalczyk@kowalczyk.com',
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'password' => Hash::make('marcingrafik1#'),
        ]);

        $userRole = Role::findByName(config('app.user_role'));
        if(isset($userRole)) {
            $user->assignRole($userRole);
        }
    }
}