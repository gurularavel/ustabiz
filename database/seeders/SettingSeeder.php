<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Contact
            'phone'         => '(050) 555-20-26',
            'address'       => 'H. Zərdabi 78V, Bakı, Azərbaycan',
            'email'         => 'info@ustam.az',
            'working_hours' => 'Hər gün: 08:00 – 22:00',
            'facebook_url'  => '#',
            'instagram_url' => '#',
            'whatsapp_url'  => '#',
            'youtube_url'   => '#',

            // Hero
            'hero_label'         => 'Bakıda №1 Texnika Təmiri',
            'hero_title'         => 'Evinizin texnikası',
            'hero_title_span'    => 'etibarlı əllərdədir',
            'hero_desc'          => 'Soyuducu, paltar maşını, kondisioner, qazan, televizor — bütün ev texnikaları üçün peşəkar təmir xidməti. Pulsuz diaqnostika · 12 ay zəmanət · 2 saata usta.',
            'hero_stat1_value'   => '15 000+',
            'hero_stat1_label'   => 'Müştəri',
            'hero_stat2_value'   => '12 il',
            'hero_stat2_label'   => 'Təcrübə',
            'hero_stat3_value'   => '98%',
            'hero_stat3_label'   => 'Müvəffəqiyyət',
            'hero_trust_count'   => '240+',
            'hero_form_title'    => 'Usta Çağır',
            'hero_form_subtitle' => 'Pulsuz diaqnostika + 12 ay zəmanət',

            // About page
            'about_hero_title'   => 'Haqqımızda',
            'about_hero_desc'    => '2012-ci ildən Bakıda fəaliyyət göstərən, ev texnikası təmirinin etibarlı ünvanı.',
            'about_story_label'  => '📖 Hekayəmiz',
            'about_story_title'  => '12 illik etimad',
            'about_story_content'=> '<p>USTAM.AZ 2012-ci ildə 3 nəfərlik kiçik bir komanda ilə fəaliyyətə başladı. Bu gün 50-dən çox sertifikatlı usta, 15 000-dən çox razı müştəri və Bakının bütün rayonlarını əhatə edən xidmət şəbəkəmiz var.</p><p style="margin-top:16px">Bizim üçün hər sifariş yalnız bir iş deyil — bu, müştərimizin evinə olan hörmətimizdir. Orijinal hissələr, yazılı zəmanət, şəffaf qiymətlər — bunlar sadəcə söz deyil, bizim prinsiplərimizdir.</p>',
            'about_value1_icon'  => '🏆',
            'about_value1_title' => 'Keyfiyyət',
            'about_value1_text'  => 'Hər işdə peşəkarlıq standartlarına riayət edirik',
            'about_value2_icon'  => '🤝',
            'about_value2_title' => 'Etimad',
            'about_value2_text'  => 'Şəffaf qiymətlər, gizli ödəniş yoxdur',
            'about_value3_icon'  => '🚀',
            'about_value3_title' => 'Sürət',
            'about_value3_text'  => '2 saata usta, günün istənilən saatında',
            'about_stat1_value'  => '15 000+',
            'about_stat1_label'  => 'Xidmət göstərilən müştəri',
            'about_stat2_value'  => '50+',
            'about_stat2_label'  => 'Sertifikatlı usta',
            'about_stat3_value'  => '12 il',
            'about_stat3_label'  => 'Bazar təcrübəsi',
            'about_stat4_value'  => '98%',
            'about_stat4_label'  => 'Müştəri məmnuniyyəti',
            'about_team_title'   => 'Peşəkar komandamız',
            'about_team_desc'    => 'Hər usta öz sahəsinin mütəxəssisidir. Minimum 4 il iş təcrübəsi tələb edirik.',
            'about_team1_emoji'  => '🧑‍🔧',
            'about_team1_name'   => 'Murad Əliyev',
            'about_team1_role'   => 'Soyuducu mütəxəssisi',
            'about_team1_exp'    => '8 il təcrübə · Samsung, LG, Bosch',
            'about_team2_emoji'  => '👨‍🔧',
            'about_team2_name'   => 'Tural Həsənov',
            'about_team2_role'   => 'Kondisioner mütəxəssisi',
            'about_team2_exp'    => '6 il təcrübə · Mitsubishi, Daikin',
            'about_team3_emoji'  => '🧑‍🔧',
            'about_team3_name'   => 'Rauf Babayev',
            'about_team3_role'   => 'Paltar maşını mütəxəssisi',
            'about_team3_exp'    => '7 il təcrübə · Arçelik, Indesit, Bosch',
            'about_team4_emoji'  => '👨‍🔧',
            'about_team4_name'   => 'Elnur Quliyev',
            'about_team4_role'   => 'Qazan/Santexnika mütəxəssisi',
            'about_team4_exp'    => '5 il təcrübə · Baxi, Viessmann',
            'about_cta_title'    => 'Bizimlə əlaqə saxlayın',
            'about_cta_desc'     => 'Texnikanız üçün peşəkar yardıma ehtiyacınız varsa, biz buradayıq.',
        ];

        foreach ($settings as $key => $value) {
            Setting::set($key, $value);
        }
    }
}
