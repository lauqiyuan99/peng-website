<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Type\NullType;

class PeopleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $state = ['johor', 'malacca', 'selangor'];
        $number = ['一', '二', '三'];
        $seniority = ['康', '依', '序'];
        $era = '一';
        $count = 0;
        $familyID = 1;

        for ($parent_id = 0; $parent_id < 3; $parent_id++) {
            for ($i = 0; $i <= $parent_id * 2; $i++) {
                $count++;
                DB::table('people')->insert([
                    'name' => '彭某'.$count,
                    'avatar' => 'noimage.jpg',
                    'spouse_name' => '彭某'.$count.'妻子',
                    'spouse_avatar' => 'noimage.jpg',
                    'gender' => $i % 2 == 0 ? '男' : '女',
                    'negeri' => $state[$parent_id],
                    'state' => null,
                    'nationality' => '马来西亚',
                    'dob_date' => '2000-01-01',
                    'dead_date' => null,
                    'parent_id' => $parent_id == 0 ? null : $parent_id,
                    'era' => '第'.$number[$parent_id].'代',
                    'seniority' => $seniority[$parent_id],
                    'family' => '彭某1的家族',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }

        $familyID = $count + 1;

        for ($parent_id = 0; $parent_id < 3; $parent_id++) {
            for ($i = 0; $i <= $parent_id * 2; $i++) {
                $count++;
                DB::table('people')->insert([
                    'name' => '彭某'.$count,
                    'avatar' => 'noimage.jpg',
                    'spouse_name' => '彭某'.$count.'妻子',
                    'spouse_avatar' => 'noimage.jpg',
                    'gender' => $i % 2 == 0 ? '男' : '女',
                    'negeri' => $state[$parent_id],
                    'state' => null,
                    'nationality' => '马来西亚',
                    'dob_date' => '2000-01-01',
                    'dead_date' => null,
                    'parent_id' => $parent_id == 0 ? null : $parent_id + $familyID - 1,
                    'era' => '第'.$number[$parent_id].'代',
                    'seniority' => $seniority[$parent_id],
                    'family' => '彭某10的家族',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }
    }
}