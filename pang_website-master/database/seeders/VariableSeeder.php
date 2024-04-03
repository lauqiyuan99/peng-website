<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VariableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('variables')->insert([
            'key' => 'primary-colour',
            'value' => '#F08080',
        ]);

        DB::table('variables')->insert([
            'key' => 'second-colour',
            'value' => '#FF0000',
        ]);

        DB::table('variables')->insert([
            'key' => 'background-colour',
            'value' => '#FFFFFF',
        ]);

        DB::table('variables')->insert([
            'key' => 'top-banner-image',
            'value' => 'image/test.jpg',
        ]);

        DB::table('variables')->insert([
            'key' => 'main-background-image',
            'value' => 'image/test.jpg',
        ]);

        DB::table('variables')->insert([
            'key' => 'facebook-label',
            'value' => '彭氏公会 facebook',
        ]);

        DB::table('variables')->insert([
            'key' => 'facebook-link',
            'value' => 'https://www.facebook.com/friends',
        ]);

        DB::table('variables')->insert([
            'key' => 'email-label',
            'value' => '彭氏公会 email',
        ]);

        DB::table('variables')->insert([
            'key' => 'email-link',
            'value' => 'messager.com/123',
        ]);

        DB::table('variables')->insert([
            'key' => 'whatsapp-label',
            'value' => '彭氏公会 whatsapp',
        ]);

        DB::table('variables')->insert([
            'key' => 'whatsapp-link',
            'value' => 'whatsapp.com/123',
        ]);
    }
}
