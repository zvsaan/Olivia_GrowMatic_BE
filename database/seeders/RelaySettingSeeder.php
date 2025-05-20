<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RelaySetting;

class RelaySettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RelaySetting::create([
            'mode' => 'otomatis',     // atau 'manual'
            'status_relay' => false,  // false = mati
        ]);

         RelaySetting::create([
            'mode' => 'manual',
            'status_relay' => true,
        ]);
    }
}
