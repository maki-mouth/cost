<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => '食費'],
            ['name' => '日用品'],
            ['name' => '交通費'],
            ['name' => '趣味・娯楽'],
            ['name' => 'その他'],
        ]);
    }
}
