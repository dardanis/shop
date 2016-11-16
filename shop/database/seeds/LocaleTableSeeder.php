<?php

use App\Locale;
use Illuminate\Database\Seeder;

class LocaleTableSeeder extends Seeder
{
    public function run()
    {
        $languages = ['en', 'fr', 'de'];

        foreach ($languages as $language)
        {
            Locale::create(compact('language'));
        }
    }
}
