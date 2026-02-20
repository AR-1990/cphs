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
        Schema::create('sleep_routines', function (Blueprint $table) {
            $table->id();
            $table->integer('form_id')->nullable();
            $table->integer('GnInfoId');
            $table->string('BedTime')->nullable();
            $table->string('SleepDuration')->nullable();
            $table->string('SleepQuality')->nullable();
            $table->string('BedtimeRoutine')->nullable();
            $table->string('DaytimeNaps')->nullable();
            $table->string('SnoringOrBreathing')->nullable();
            $table->string('RestlessnessDuringSleep')->nullable();
            $table->string('SleepEnvironment')->nullable();
            $table->string('SleepRelatedBehaviors')->nullable();
            $table->string('AffectingSleep')->nullable();
            $table->string('ImpactingSleep')->nullable();
            $table->string('Enuresis')->nullable();
            $table->string('ImmunizationHistory')->nullable();
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
        Schema::dropIfExists('sleep_routines');
    }
};
