<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UniversitySeeder extends Seeder
{
    public function run()
    {
        // 🟢 Universities
        $json = file_get_contents(database_path('data/university.json'));
        $universities = json_decode($json, true);

        DB::table('universities')->truncate();
        DB::table('universities')->insert($universities);

        // 🟢 Degree Types
        DB::table('degree_types')->truncate();
        DB::table('degree_types')->insert([
            [
                'name_ar' => 'بكالوريوس',
                'name_en' => 'Bachelor',
            ],
            [
                'name_ar' => 'ماجستير',
                'name_en' => 'Master',
            ],
            [
                'name_ar' => 'دكتوراه',
                'name_en' => 'Doctorate',
            ],
        ]);
    }
}
