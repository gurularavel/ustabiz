<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        $partners = ['Samsung', 'LG', 'Bosch', 'Arçelik', 'Siemens', 'Indesit', 'Whirlpool', 'Mitsubishi', 'Electrolux', 'Beko', 'Vestel', 'Gorenje'];

        foreach ($partners as $i => $name) {
            Partner::updateOrCreate(
                ['name' => $name],
                ['is_active' => true, 'sort_order' => $i + 1]
            );
        }
    }
}
