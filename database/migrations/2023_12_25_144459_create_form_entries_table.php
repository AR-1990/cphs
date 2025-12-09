<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_entries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lname');
            $table->string('gender')->nullable();
            $table->string('school')->nullable();
            $table->string('city')->nullable();
            $table->string('area')->nullable();
            $table->datetime('dob')->nullable();
            $table->integer('age')->nullable();
            $table->string('phone')->nullable();
            $table->string('medical_condition')->nullable();
            $table->string('grno')->nullable();
            $table->string('address')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('enterby')->nullable();
            $table->string('duration')->nullable();
            $table->string('bmiresult')->nullable();
            $table->string('systolicresult')->nullable();
            $table->string('diastolicresult')->nullable();

            $table->tinyInteger('Follow_up_Date_flag')->default(0)->comment('0=no, 1=Yes');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_entries');
    }
};
