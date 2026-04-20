<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesSeeder extends Seeder
{
    public function run()
    {
        $json = file_get_contents(database_path('data/countries.json'));
        $countries = json_decode($json, true);

        
        foreach ($countries as $country) {

            $code = strtolower($country['code']);

            DB::table('countries')->updateOrInsert(
                ['code' => $country['code']],
                [
                    'name_ar' => $country['arabic'],
                    'name_en' => $country['english'],
                    'flag'    => "https://flagcdn.com/w320/{$code}.png",
                    'region'  => $country['region'] ?? null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

    }
}