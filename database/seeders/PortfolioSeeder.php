<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['title' => 'Samsung soyuducu kompressor dəyişimi',   'description' => 'R600a qazı dolduruldu, yeni kompressor quraşdırıldı. 12 ay zəmanət verildi.'],
            ['title' => 'LG paltaryuyan maşın nasos təmiri',      'description' => 'Su axıtma nasosunun dəyişdirilməsi, filtr yuyuldu, 2 saata hazır edildi.'],
            ['title' => 'Bosch qabyuyan maşın proqramlaşdırma',   'description' => 'Elektron platanın proqramlaşdırılması və tam sınaqdan keçirilməsi.'],
            ['title' => 'Kondisioner qaz doldurulması',           'description' => 'R410A qazı dolduruldu, filtr dəyişdirildi, tam diaqnostika aparıldı.'],
            ['title' => 'Samsung plazma TV ekran təmiri',         'description' => 'Ekran qüsurunun aradan qaldırılması, backlighting dəyişimi.'],
            ['title' => 'Arçelik çamaşır maşını qapı kilidi',    'description' => 'Qapı kilidinin dəyişdirilməsi, tam yoxlama aparıldı, müştəri məmnun qaldı.'],
        ];

        foreach ($items as $i => $item) {
            Portfolio::create(array_merge($item, [
                'youtube_url' => null,
                'is_active'   => true,
                'sort_order'  => $i,
            ]));
        }
    }
}
