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
                'title' => 'Киоски',
                //'slug' => 'testovaya_kategoriya_01',
                'parent_id' => NULL,
            ],
            [
                'title' => 'Софт',
                //'slug' => 'testovaya_kategoriya_02',
                'parent_id' => NULL,
            ],
            [
                'title' => 'Видеостены',
                //'slug' => 'testovaya_kategoriya_03',
                'parent_id' => NULL,
            ],
        ]);
    }
}
