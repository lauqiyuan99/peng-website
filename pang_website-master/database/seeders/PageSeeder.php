<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 30; $i++) {
            DB::table('pages')->insert([
                'title' => Str::random(10),
                'url' => 'www.google.com',
                'ranking' => 1,
                'is_publish' => 'y',
                'description' =>'Summer Note',
                'year' => 2022,
                'img_path'=>'img',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
    }
}
