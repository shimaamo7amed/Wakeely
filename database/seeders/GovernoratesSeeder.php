<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GovernoratesSeeder extends Seeder
{
    public function run()
    {
        try {
            $json = file_get_contents(database_path('data/governorates.json'));
            $data = json_decode($json, true);

            foreach ($data as $item) {
                DB::table('governorates')->insert([
                    'country_id' => 51,
                    'name_ar' => $item['name_ar'],
                    'name_en' => $item['name_en'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

        } catch (\Throwable $e) {
            dd($e->getMessage());
        }
    }
}
