<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImagePathMediaPathSize extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    // DB::statement('ALTER TABLE `businesses` MODIFY `image_path` VARCHAR(20556)');
    // DB::statement('ALTER TABLE `people` MODIFY `avatar` VARCHAR(20556)');
    // DB::statement('ALTER TABLE `people` MODIFY `spouse_name` VARCHAR(20556)');
    // DB::statement('ALTER TABLE `people` MODIFY `spouse_avatar` VARCHAR(20556)');
    // DB::statement('ALTER TABLE `jobs` MODIFY `image_path` VARCHAR(20556)');
    // DB::statement('ALTER TABLE `people_history` MODIFY `image_path` VARCHAR(20556)');
    // DB::statement('ALTER TABLE `people_history` MODIFY `media_path` VARCHAR(20556)');
    // DB::statement('ALTER TABLE `event` MODIFY `event_title_image_path` VARCHAR(20556)');
    // DB::statement('ALTER TABLE `event` MODIFY `media_path` VARCHAR(20556)');
    // DB::statement('ALTER TABLE `notice` MODIFY `notice_title_image_path` VARCHAR(20556)');
    // DB::statement('ALTER TABLE `notice` MODIFY `media_path` VARCHAR(20556)');
    // DB::statement('ALTER TABLE `family_origin` MODIFY `media_path` VARCHAR(20556)');
    // DB::statement('ALTER TABLE `family_origin` MODIFY `image_path` VARCHAR(20556)');
   
        Schema::table('businesses', function (Blueprint $table) {
            $table->longText('image_path')->change();          
        });
        Schema::table('people', function (Blueprint $table) {
            // $table->longText('avatar')->change();
            $table->longText('spouse_name')->change();
            $table->longText('spouse_avatar')->change();
        });
        Schema::table('jobs', function (Blueprint $table) {
            $table->longText('image_path')->change();
        });
        Schema::table('people_history', function (Blueprint $table) {
            $table->longText('image_path')->change();
            $table->longText('media_path')->change();
        });
        Schema::table('event', function (Blueprint $table) {
            $table->longText('event_title_image_path')->change();
            $table->longText('media_path')->change();
        });
        Schema::table('notice', function (Blueprint $table) {
            $table->longText('notice_title_image_path')->change();
            $table->longText('media_path')->change();
        });
        Schema::table('family_origin', function (Blueprint $table) {
            $table->longText('media_path')->change();
            $table->longText('image_path')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
