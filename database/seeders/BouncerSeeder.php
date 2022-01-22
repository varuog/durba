<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Bouncer;
use Str;

class BouncerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        
        
        $superAdmin = Bouncer::role()->firstOrCreate([
            'name' => 'Super Admin',
            'title' => 'Super Administrator',
            'level' => 1
        ]);

        $admin = Bouncer::role()->firstOrCreate([
            'name' => 'admin',
            'title' => 'Administrator',
            'level' => 2
        ]);

        $user = Bouncer::role()->firstOrCreate([
            'name' => 'User',
            'title' => 'User',
            'level' => 50
        ]);
        
        // Bouncer::allow('admin')->everything();
        // Bouncer::forbid('admin')->toManage(User::class);

        /**
         * Core abilities
         */
        $modules = [
            'global' => [
                'Search Configuration',
                'Add Configuration',
                'Update Configuration',
            ],
            'module' => [
                'Add module',
                'Disable Module',
                'Remove Module',
                'Search Module',
            ],
            'roles' => [
                'Create Role',
                'Create Abilities',
            ],
            'dashboard' => [
                'View Dashboard',
                'Summary KPO',
            ],
            'user' => [               
                'Assign Role',
                'Assign Abilities',
                'Create User',
                'Update User',
                'Deactivate User',
                'Delete User',
                'View User',
                'Update Sensitive',
                'Search User'
            ]
        ];

        foreach($modules as $module => $abilities) {
            foreach($abilities as $module => $ability) {
                Bouncer::ability()->firstOrCreate([
                    'name' => Str::slug($ability),
                    'title' => $ability,
                    'group' => $module,
                ]);
            }
        }

        
        Bouncer::allow($superAdmin)->everything();
        Bouncer::allow($admin)->everything();

        
        Bouncer::allow($user)->to('view-dashboard');
    }
}