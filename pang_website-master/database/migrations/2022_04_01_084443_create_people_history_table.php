<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people_history', function (Blueprint $table) {
            $table->id();
            $table->string('history_name')->nullable();
            $table->longText('description')->nullable();
            $table->string('media_path')->nullable();
            $table->string('image_path')->nullable();
            $table->unsignedBigInteger('people_id')->nullable();
            $table->date('incident_date');
            $table->string('status')->default('pending');
            $table->timestamps();
            $table->foreign('people_id')->references('id')->on('people')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people_history');
    }
}
