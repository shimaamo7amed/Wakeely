<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubAssociationsSeeder extends Seeder
{
    public function run()
    {
        $json = file_get_contents(database_path('data/sub-associations.json'));
        $subAssociations = json_decode($json, true)['sub_associations'];

        DB::table('sub_associations')->truncate();
        DB::table('sub_associations')->insert($subAssociations);
    }
}
