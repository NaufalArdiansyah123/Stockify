<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
   public function run()
{
    \App\Models\Setting::create([
        'app_name' => 'Stockify',
        'logo' => null,
    ]);
}

}
