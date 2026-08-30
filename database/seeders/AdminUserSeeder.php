<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $admins = [
            [
                'name'     => 'Unique Khanal',
                'email'    => 'uniquekhanal2020@gmail.com',
                'password' => 'ChangeThisPassword1!',
            ],
            [
                'name'     => 'Unique Khanal',
                'email'    => 'uniquekhanal2080@ims.edu.np',
                'password' => 'ChangeThisPassword2!',
            ],
        ];

        foreach ($admins as $admin) {
            User::updateOrCreate(
                ['email' => $admin['email']],
                [
                    'name'              => $admin['name'],
                    'password'          => Hash::make($admin['password']),
                    'role'              => 'admin',
                    'email_verified_at' => now(),
                ]
            );
        }
    }
}