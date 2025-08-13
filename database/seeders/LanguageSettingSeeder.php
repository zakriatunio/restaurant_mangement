<?php

namespace Database\Seeders;

use App\Models\LanguageSetting;
use App\Observers\LanguageSettingObserver;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSettingSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LanguageSetting::insert(LanguageSetting::LANGUAGES);

        new LanguageSettingObserver();

    }

}
