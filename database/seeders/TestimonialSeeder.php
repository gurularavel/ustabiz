<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            ['name' => 'Elnur Həsənov',   'avatar_initial' => 'E', 'stars' => 5, 'date' => '12 yanvar 2024',  'text' => 'Soyuducum xarab olmuşdu, zəng etdim və 1.5 saata usta gəldi. Problemi tez tapdı və həll etdi. Qiymət də çox münasib idi.'],
            ['name' => 'Lalə Məmmədova',  'avatar_initial' => 'L', 'stars' => 5, 'date' => '8 fevral 2024',   'text' => 'Paltar maşınım su axıdırdı. Usta gəlib diaqnostika etdi, problem 1 saata həll olundu. Zəmanət verdilər. Çox məmnunam!'],
            ['name' => 'Rauf Əliyev',     'avatar_initial' => 'R', 'stars' => 5, 'date' => '3 mart 2024',     'text' => 'Kondisionerin qazı bitmişdi. Operator çox mehriban danışdı. Usta vaxtında gəldi, işi keyfiyyətli gördü.'],
            ['name' => 'Sevinc Quliyeva', 'avatar_initial' => 'S', 'stars' => 5, 'date' => '18 mart 2024',    'text' => 'Qazanım bənd idi. Sabah 10:00-da zəng etdim, 12:00-da usta evdə idi. 45 dəqiqəyə problemi aradan qaldırdı.'],
            ['name' => 'Nigar Babayeva',  'avatar_initial' => 'N', 'stars' => 5, 'date' => '25 aprel 2024',   'text' => 'Televizorum açılmırdı. Usta gəlib kontakt xərabını tapdı, həll etdi. 6 ay sonra hələ problem yoxdur!'],
            ['name' => 'Kənan Rüstəmov',  'avatar_initial' => 'K', 'stars' => 5, 'date' => '2 may 2024',      'text' => 'Mətbəx ocağım alovlanmırdı. Elə həmin gün usta gəldi. Elektrik bölməsinin problemi imiş. İndi mükəmməl işləyir!'],
        ];

        foreach ($testimonials as $i => $data) {
            Testimonial::updateOrCreate(
                ['name' => $data['name']],
                array_merge($data, ['is_active' => true, 'sort_order' => $i + 1])
            );
        }
    }
}
