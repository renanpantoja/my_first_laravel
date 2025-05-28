<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Expression;

class ExpressionSeeder extends Seeder
{
    public function run(): void
    {
        $expressions = [
            ['key' => 'home.jobs', 'locale' => 'en', 'value' => 'Job Listings'],
            ['key' => 'home.jobs', 'locale' => 'pt', 'value' => 'Vagas de Emprego'],

            ['key' => 'nav.salaries', 'locale' => 'en', 'value' => 'Salaries'],
            ['key' => 'nav.salaries', 'locale' => 'pt', 'value' => 'Salários'],

            ['key' => 'nav.companies', 'locale' => 'en', 'value' => 'Companies'],
            ['key' => 'nav.companies', 'locale' => 'pt', 'value' => 'Empresas'],

            ['key' => 'footer.contact', 'locale' => 'en', 'value' => 'Contact'],
            ['key' => 'footer.contact', 'locale' => 'pt', 'value' => 'Contato'],

            ['key' => 'footer.privacy', 'locale' => 'en', 'value' => 'Privacy Policy'],
            ['key' => 'footer.privacy', 'locale' => 'pt', 'value' => 'Política de Privacidade'],
        ];

        foreach ($expressions as $expression) {
            Expression::updateOrCreate(
                [
                    'key' => $expression['key'],
                    'locale' => $expression['locale'],
                ],
                ['value' => $expression['value']]
            );
        }
    }
}
