<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('avatar')->nullable();
            $table->string('spouse_name')->nullable();
            $table->string('spouse_avatar')->nullable();
            $table->string('gender');
            $table->string('negeri');
            $table->string('state')->nullable();
            $table->string('nationality');
            $table->date('dob_date');
            $table->date('dead_date')->nullable();
            $table->string('era');
            $table->string('seniority');
            $table->string('family')->nullable();
            $table->string('status')->default('pending');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('people')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
        Schema::dropIfExists('persons');
    }
}
