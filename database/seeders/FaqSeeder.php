<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            ['question' => 'Diaqnostika pulsuzdurmu?',             'answer' => 'Bəli, diaqnostika tamamilə pulsuzdur. Usta gəlir, texnikanı yoxlayır, problemi müəyyən edir. Yalnız siz razı olduqdan sonra təmir başlanır. Əgər imtina etsəniz heç bir ödəniş tələb edilmir.'],
            ['question' => 'Neçə saat ərzində usta gəlir?',        'answer' => 'Sifarişdən sonra usta adətən 1-2 saata qədər evinizə gəlir. Fövqəladə hallarda (su sızması, qaz problemi) prioritet verilir və daha qısa müddətdə gəliş təmin edilir.'],
            ['question' => 'Zəmanət nə qədər müddətinə verilir?',  'answer' => 'Bütün təmir işlərinin üzərinə 12 aylıq yazılı zəmanət verilir. Zəmanət müddəti ərzində eyni xərab yenidən baş verərsə pulsuz aradan qaldırılır.'],
            ['question' => 'Hansı ödəniş üsulları qəbul olunur?',  'answer' => 'Nağd pul, bank kartı (Visa/Mastercard), bank köçürməsi qəbul edilir. Ödəniş yalnız iş tamamlandıqdan sonra aparılır.'],
            ['question' => 'Orijinal ehtiyat hissəsi istifadə olunurmu?', 'answer' => 'Bəli, yalnız orijinal ehtiyat hissələrindən istifadə edirik. Hər bir hissənin zəmanəti var.'],
            ['question' => 'Həftə sonları xidmət göstərilirmi?',   'answer' => 'Bəli, həftənin 7 günü, hər gün saat 08:00-dan 22:00-dək xidmət göstəririk.'],
        ];

        foreach ($faqs as $i => $data) {
            Faq::updateOrCreate(
                ['question' => $data['question']],
                array_merge($data, ['is_active' => true, 'sort_order' => $i + 1])
            );
        }
    }
}
