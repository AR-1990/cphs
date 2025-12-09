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
        Schema::create('abdominal_pain_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('form_id')->nullable();
            $table->integer('GnInfoId');
            $table->string('LocationOfPain')->nullable();
            $table->string('CharacterOfPain')->nullable();
            $table->string('OnsetAndDuration')->nullable();
            $table->string('AggravatingOrRelieving')->nullable();
            $table->string('AssociatedSymptoms')->nullable();
            $table->text('MedicalHistory')->nullable();
            $table->text('previous_episodes')->nullable();
            $table->text('digestive_disorders')->nullable();
            $table->text('dietary_changes_times')->nullable();
            $table->text('dietary_changes_routines')->nullable();
            $table->text('travel_historys')->nullable();
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
        Schema::dropIfExists('abdominal_pain_histories');
    }
};
