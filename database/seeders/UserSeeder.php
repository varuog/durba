<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use DB;
use Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::statement("SET FOREIGN_KEY_CHECKS = 0");
        //User::truncate();
        $user = new User([
            //'user_type' => 1,
            'first_name' => 'Super Admin',
            'last_name' => 'Super Admin',
            'email' => 'superadmin@mailinator.com',
            'password' => Hash::make('12345678'),
            'status' => 'active',
        ]);
        $user->save();
        $user->assign('Super Admin');

        $user = new User([
            //'user_type' => 1,
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@mailinator.com',
            'password' => Hash::make('12345678'),
            'status' => 'active',
        ]);
        $user->save();
        $user->assign('Admin');


        $user = new User([
            //'user_type' => 1,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'johndoe@mailinator.com',
            'password' => Hash::make('12345678'),
            'status' => 'active',
        ]);
        $user->save();
        $user->assign('User');

        $user = new User([
            //'user_type' => 1,
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'email' => 'jane@mailinator.com',
            'password' => Hash::make('12345678'),
            'status' => 'active',
        ]);
        $user->save();
        $user->assign('User');

    }
}
