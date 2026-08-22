<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class AdminSeeder extends Seeder
{
    public function run()
    {
        // Admin::create([
        //     'name' => 'Super Admin',
        //     'email' => 'admin@gmail.com',
        //     'password' => Hash::make('123456'),
        //     'status' => 'active',
        //     'image' => 'admin.png',  
        // ]);
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('123456'),
                'status' => 1,
                //'identity_image' => 'admin.png',  
            ]
        );
          $user = User::where('email', 'admin@gmail.com')->first();
          $user->assignRole('Admin');
    }
}
