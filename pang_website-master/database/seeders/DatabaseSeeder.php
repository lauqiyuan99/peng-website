<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PeopleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(VariableSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(BusinessSeeder::class);
        $this->call(JobSeeder::class);       
        $this->call(PeopleHistory::class);
        $this->call(Family_OriginSeeder::class);
    }
}
