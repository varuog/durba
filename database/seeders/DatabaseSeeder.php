<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\DurbaCmsDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            BouncerSeeder::class,
            SettingSeeder::class,
            UserSeeder::class,
            DurbaCmsDatabaseSeeder::class,
            CategorySeeder::class,
        ]);
    }
}
