<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AttributeSeeder extends Seeder
{
    public function run()
    {
        DB::table('attributes')->insert([
            [
                'name' => 'Диагональ',
                'code' => 'diagonal',
                'filter' => 'y',
            ],
            [
                'name' => 'Диск',
                'code' => 'disk',
                'filter' => 'y',
            ],
        ]);
    }
}
