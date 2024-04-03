<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobCategory = [
            'consumer', 'industrial', 'construction',
            'finance', 'technology', 'properties',
            'plantation', 'healthcare', 'transportation',
            'reits', 'telecommunications', 'utilities',
            'energy' 
        ];

        for ($i=0; $i < 30; $i++) {
            DB::table('jobs')->insert([
                'name' => '工作 '.$i,
                'description' => 'This field is description',
                'note' => 'This field is note',
                'image_path' => 'noimage.jpg',
                'category' => $jobCategory[random_int(0, 12)],
                'salary' => 'RM 1500',
                'background' => 'Sample background data',
                'address' => 'No 1, Address 3. Taman bangsar',
                'posted_on' => date('Y-m-d H:i:s'),
                'is_publish' => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
        
    }
}
