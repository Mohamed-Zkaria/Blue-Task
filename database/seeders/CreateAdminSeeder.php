<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
               'name'=>'admin',
               'email'=>'admin@admin.com',
                'is_admin'=>'1',
               'password'=> Hash::make('adminadmin'),
            ],
            [
               'name'=>'User',
               'email'=>'user@user.com',
                'is_admin'=>'0',
               'password'=> Hash::make('useruser'),
            ],
        ];
  
        foreach ($user as $key => $value) {
            User::create($value);
        }

    }
}
