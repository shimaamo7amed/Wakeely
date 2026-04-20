<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Admin\Entities\Model as Admin;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        
// Admin::create([
//     'id' => 1,
//     'uuid' => 'b0a9f8a7-2de7-4e3b-9f6d-6c1f5c0e8a7b',
//     'name' => 'Mohamed Nabil',
//     'short_name' => 'MN',
//     'phone_code' => '20',
//     'country_code' => 'EG',
//     'phone' => '1020515081',
//     'email' => 'info@wakeely.net',
//     'cpr' => null,
//     'birthdate' => null,
//     'gender' => 'M',
//     'accent' => null,
//     'image' => null,
//     'bio' => 'Super Admin of the system',
//     'status' => 1,
//     'password' => Hash::make('!2P6v=lEL7}-'),
//     'code' => Str::random(6),
//     'remember_token' => Str::random(60),
//     'created_at' => Carbon::now(),
//     'updated_at' => Carbon::now(),
// ]);


    // DB::table('bar_association_degrees')->insert([
    //     [
    //         'name_en' => 'First Instance',
    //         'name_ar' => 'ابتدائي',
    //     ],
    //     [
    //         'name_en' => 'Appeal',
    //         'name_ar' => 'استئناف',
    //     ],
    //     [
    //         'name_en' => 'Supreme',
    //         'name_ar' => 'نقض',
    //     ],
    // ]);
    
    // DB::table('reject_reasons')->insert([
    //     [
    //         'key' => 'legal_info',
    //         'name_en' => 'Invalid Data',
    //         'name_ar' => 'البيانات غير دقيقة',
    //         'has_input' => false
    //     ],
    //     [
    //         'key' => 'id_card',
    //         'name_en' => 'ID Card not clear',
    //         'name_ar' => 'الصورة البطاقة مش واضحة',
    //         'has_input' => false
    //     ],
    //     [
    //         'key' => 'legal_card',
    //         'name_en' => 'Legal Card not clear',
    //         'name_ar' => 'الصورة القانونية مش واضحة',
    //         'has_input' => false
    //     ],
    // ]);

    
    // DB::table('years_of_experience')->insert([
    //     ['title' => '5 to 10'],
    //     ['title' => '10 to 15'],
    //     ['title' => '15 to 20'],
    //     ['title' => '20 to 25'],
    //     ['title' => '25+'],

        
    // ]);
    DB::table('tokens')->insert([
        ['point' => 5, 'price' => 100.00, 'created_at' => now(), 'updated_at' => now()],
        ['point' => 10, 'price' => 175.00, 'created_at' => now(), 'updated_at' => now()],
        ['point' => 15, 'price' => 250.00, 'created_at' => now(), 'updated_at' => now()],
        ['point' => 20, 'price' => 300.00, 'created_at' => now(), 'updated_at' => now()],
    ]);




    }
}
