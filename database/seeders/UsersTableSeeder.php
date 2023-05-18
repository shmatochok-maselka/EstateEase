<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
                'phone'          => '',
            ],
            [
                'id'             => 2,
                'name'           => 'Ангеліна Бланяр',
                'email'          => 'lina@gmail.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
                'phone'          => '+380123456789',
            ],
            [
                'id'             => 3,
                'name'           => 'Христина Ворон',
                'email'          => 'kris@gmail.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
                'phone'          => '+380223456789',
            ],
            [
                'id'             => 4,
                'name'           => 'Олеся Оліферчук',
                'email'          => 'olesya@gmail.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
                'phone'          => '+380323456789',
            ],
            [
                'id'             => 5,
                'name'           => 'Андрій Назаренко',
                'email'          => 'andy@gmail.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
                'phone'          => '+380423456789',
            ],
        ];
        User::insert($users);
    }
}
