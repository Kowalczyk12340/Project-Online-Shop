<?php

namespace Database\Seeders\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder 
{
    public function run()
    {
        User::create([
            'name' => 'Marcin Kowalczyk',
            'email' => 'marcin.kowalczyk@kowalczyk.com',
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'password' => Hash::make('marcingrafik1#'),
        ]);
    }
}