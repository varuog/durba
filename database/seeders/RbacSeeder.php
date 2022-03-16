<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Bouncer;

class RbacSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        * Roles
        */
        $admin = Bouncer::role()->firstOrCreate([
            'name' => User::ROLE_SUPERADMIN,
            'title' => 'Super Administrator',
        ]);
        $admin = Bouncer::role()->firstOrCreate([
            'name' =>  User::ROLE_ADMIN,
            'title' => 'Administrator',
        ]);
        $admin = Bouncer::role()->firstOrCreate([
            'name' =>  User::ROLE_DELIVERY_AGENT,
            'title' => 'Delivery Agent',
        ]);
        $admin = Bouncer::role()->firstOrCreate([
            'name' =>  User::ROLE_CUSTOMER,
            'title' => 'Customer',
        ]);
        $admin = Bouncer::role()->firstOrCreate([
            'name' =>  User::ROLE_RETAIL,
            'title' => 'Retail',
        ]);

        /**
         * Abbilities
         */
        Bouncer::ability()->firstOrCreate([
            'name' => 'add-to-cart',
            'title' => 'Add to Cart',
            'module' => 'cart',
        ]);
        Bouncer::ability()->firstOrCreate([
            'name' => 'remove-cart',
            'title' => 'Remove Cart',
            'module' => 'cart',
        ]);

        Bouncer::ability()->firstOrCreate([
            'name' => 'assign-role',
            'title' => 'Assign Role',
            'module' => 'user',
        ]);
        Bouncer::ability()->firstOrCreate([
            'name' => 'revoke-role',
            'title' => 'Revoke Role',
            'module' => 'user',
        ]);

        Bouncer::ability()->firstOrCreate([
            'name' => 'place-order',
            'title' => 'Place order',
            'module' => 'order',
        ]);

        /**
         * Assignments
         */
        Bouncer::allow('superadmin')->everything();
    }
}
