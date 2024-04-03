<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Family_Origin;
use Illuminate\Database\Seeder;

class Family_OriginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <=9; $i++) {
        Family_Origin::create([
            'media_path' => 'video.mp4',
            'family_origin_content' => '彭姓渊源内容',
            // 'particular_year' => Carbon::createFromDate('1999', '9',1)->format('F Y'),  
            'particular_year' => Carbon::createFromDate('199'.$i, $i, 1),   
            'image_path' => 'noimage.jpg'    
        ]);
    }
    }
}
