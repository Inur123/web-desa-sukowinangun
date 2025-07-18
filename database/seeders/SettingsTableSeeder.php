<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    public function run()
    {
        // Data default untuk pengaturan
        $settings = [
            [
                'key' => 'admin_whatsapp_number',
                'value' => '6285850512135' // Nomor default
            ],
            [
                'key' => 'fonnte_api_token',
                'value' => env('FONNTE_API_TOKEN', 'MycRkN86FX9SaMaknEBw')
            ]
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}
