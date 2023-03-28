<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataSeeders = [
            [
                'category_name' => 'Services',
                'created_At' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_name' => 'Products',
                'created_At' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
        DB::table('categories')->insert($dataSeeders);
    }
}
