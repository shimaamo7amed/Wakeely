<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguagesSeeder extends Seeder
{
    public function run()
    {
        DB::table('languages')->truncate();

        DB::table('languages')->insert([
            [
                'name_ar' => 'العربية',
                'name_en' => 'Arabic',
            ],
            [
                'name_ar' => 'الإنجليزية',
                'name_en' => 'English',
            ],
            [
                'name_ar' => 'الإيطالية',
                'name_en' => 'Italian',
            ],
            [
                'name_ar' => 'الفرنسية',
                'name_en' => 'French',
            ],
            [
                'name_ar' => 'الألمانية',
                'name_en' => 'German',
            ],
            [
                'name_ar' => 'الإسبانية',
                'name_en' => 'Spanish',
            ],
            [
                'name_ar' => 'الروسية',
                'name_en' => 'Russian',
            ],
            [
                'name_ar' => 'الصينية',
                'name_en' => 'Chinese',
            ],
            [
                'name_ar' => 'اليابانية',
                'name_en' => 'Japanese',
            ],
            [
                'name_ar' => 'التركية',
                'name_en' => 'Turkish',
            ],
            [
                'name_ar' => 'الفارسية',
                'name_en' => 'Persian',
            ],
            [
                'name_ar' => 'الهندية',
                'name_en' => 'Hindi',
            ],
            [
                'name_ar' => 'الأوردو',
                'name_en' => 'Urdu',
            ],
            [
                'name_ar' => 'البرتغالية',
                'name_en' => 'Portuguese',
            ],
            [
                'name_ar' => 'الكورية',
                'name_en' => 'Korean',
            ],
        ]);
    }
}
