<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
                [
                    'slug' => 'enable_email_notification',
                    'title' => 'Enable Email Notification',
                    'type' => 'boolean',
                    'default_value' => '1'
                ]
                ,[
                    'slug' => 'enable_push_notification',
                    'title' => 'Enable Push Notification',
                    'type' => 'boolean',
                    'default_value' => '1'
                ]
            ];

        Setting::insert($settings);
    }
}
