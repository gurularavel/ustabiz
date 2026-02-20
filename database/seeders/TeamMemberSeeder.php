<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    public function run(): void
    {
        $members = [
            ['emoji' => '🧑‍🔧', 'name' => 'Murad Əliyev',   'role' => 'Soyuducu mütəxəssisi',         'experience' => '8 il təcrübə · Samsung, LG, Bosch'],
            ['emoji' => '👨‍🔧', 'name' => 'Tural Həsənov',  'role' => 'Kondisioner mütəxəssisi',       'experience' => '6 il təcrübə · Mitsubishi, Daikin'],
            ['emoji' => '🧑‍🔧', 'name' => 'Rauf Babayev',   'role' => 'Paltar maşını mütəxəssisi',     'experience' => '7 il təcrübə · Arçelik, Indesit, Bosch'],
            ['emoji' => '👨‍🔧', 'name' => 'Elnur Quliyev',  'role' => 'Qazan/Santexnika mütəxəssisi',  'experience' => '5 il təcrübə · Baxi, Viessmann'],
        ];

        foreach ($members as $i => $data) {
            TeamMember::updateOrCreate(
                ['name' => $data['name']],
                array_merge($data, ['is_active' => true, 'sort_order' => $i + 1])
            );
        }
    }
}
