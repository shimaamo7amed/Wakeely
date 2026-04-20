<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaPracticeSeeder extends Seeder
{
    public function run()
    {
        $json = file_get_contents(database_path('data/area_practice.json'));
        $areas = json_decode($json, true)['areas_of_practice'];

        DB::table('areas_of_practice')->truncate();
        DB::table('areas_of_practice')->insert($areas);
    }
}
