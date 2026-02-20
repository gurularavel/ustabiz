<?php

namespace Database\Seeders;

use App\Models\Advantage;
use Illuminate\Database\Seeder;

class AdvantageSeeder extends Seeder
{
    public function run(): void
    {
        $advantages = [
            ['icon' => '💰', 'title' => 'Sərfəli qiymətlər', 'description' => 'Diaqnostika pulsuzdur. Xidmət qiyməti 20 AZN-dən başlayır. Gizli ödəniş yoxdur.'],
            ['icon' => '🏆', 'title' => '12 ay zəmanət',      'description' => 'Bütün təmir işlərinin üzərinə yazılı sənədlə 12 aylıq zəmanət verilir.'],
            ['icon' => '⚙️', 'title' => 'Orijinal hissələr',  'description' => 'Yalnız orijinal ehtiyat hissələri istifadə olunur. Keyfiyyətsiz hissə qəbul edilmir.'],
            ['icon' => '🚀', 'title' => 'Sürətli gəliş',      'description' => 'Sifarişdən sonra 2 saata qədər usta evinizə gəlir. Fövqəladə hallarda daha tez.'],
            ['icon' => '👨‍🔧', 'title' => 'Peşəkar komanda', 'description' => '4+ il təcrübəsi olan sertifikatlı ustalar. Hər usta öz sahəsinin mütəxəssisidir.'],
        ];

        foreach ($advantages as $i => $data) {
            Advantage::updateOrCreate(
                ['title' => $data['title']],
                array_merge($data, ['is_active' => true, 'sort_order' => $i + 1])
            );
        }
    }
}
