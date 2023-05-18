<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    public function run()
    {
        User::findOrFail(1)->role()->associate(1)->save();
        User::findOrFail(2)->role()->associate(2)->save();
        User::findOrFail(3)->role()->associate(2)->save();
        User::findOrFail(4)->role()->associate(2)->save();
        User::findOrFail(5)->role()->associate(2)->save();
    }
}
