<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            [
                'title' => 'Тестовая категория 01',
                //'slug' => 'testovaya_kategoriya_01',
                'parent_id' => NULL,
            ],
            [
                'title' => 'Тестовая категория 02',
                //'slug' => 'testovaya_kategoriya_02',
                'parent_id' => NULL,
            ],
            [
                'title' => 'Тестовая категория 03',
                //'slug' => 'testovaya_kategoriya_03',
                'parent_id' => NULL,
            ],
        ]);
    }
}
