<?php

namespace Database\Seeders;

use App\Models\Expression;
use Illuminate\Database\Seeder;

class ExpressionSeeder extends Seeder
{
    public function run(): void
    {
        $expressions = [
            ['key' => 'page.title', 'locale' => 'en', 'value' => 'Find Jobs'],
            ['key' => 'page.title', 'locale' => 'pt', 'value' => 'Busca de Vagas'],

            ['key' => 'nav.jobs', 'locale' => 'en', 'value' => 'Job Listings'],
            ['key' => 'nav.jobs', 'locale' => 'pt', 'value' => 'Vagas de Emprego'],

            ['key' => 'nav.salaries', 'locale' => 'en', 'value' => 'Salaries'],
            ['key' => 'nav.salaries', 'locale' => 'pt', 'value' => 'Salários'],

            ['key' => 'nav.companies', 'locale' => 'en', 'value' => 'Companies'],
            ['key' => 'nav.companies', 'locale' => 'pt', 'value' => 'Empresas'],

            ['key' => 'nav.myjobs', 'locale' => 'en', 'value' => 'My Jobs'],
            ['key' => 'nav.myjobs', 'locale' => 'pt', 'value' => 'Minhas Vagas'],

            ['key' => 'nav.postjobs', 'locale' => 'en', 'value' => 'Post a Job'],
            ['key' => 'nav.postjobs', 'locale' => 'pt', 'value' => 'Publique uma Vaga'],

            ['key' => 'nav.logout', 'locale' => 'en', 'value' => 'Log Out'],
            ['key' => 'nav.logout', 'locale' => 'pt', 'value' => 'Desconectar'],

            ['key' => 'nav.login', 'locale' => 'en', 'value' => 'Log In'],
            ['key' => 'nav.login', 'locale' => 'pt', 'value' => 'Logar'],

            ['key' => 'nav.register', 'locale' => 'en', 'value' => 'Sign Up'],
            ['key' => 'nav.register', 'locale' => 'pt', 'value' => 'Criar Conta'],

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
