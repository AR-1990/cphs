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
        Schema::create('history_of_infections', function (Blueprint $table) {
            $table->id();
            $table->integer('form_id')->nullable();
            $table->integer('GnInfoId');
            $table->string('EpisodesPerMonth')->nullable();
            $table->string('Hospitalisation')->nullable();
            $table->string('GastrointestinalSystem')->nullable();
            $table->string('EndocrineSystem')->nullable();
            $table->string('RenalSystem')->nullable();
            $table->string('KidneyStones')->nullable();
            $table->string('BackPain')->nullable();
            $table->string('UrinaryTractInfections')->nullable();
            $table->string('NeurologicalSystem')->nullable();
            $table->string('Falls')->nullable();
            $table->string('Syncope')->nullable();
            $table->string('MusculoskeletalSystem')->nullable();
            $table->string('BonePainSpecify')->nullable();
            $table->string('HematologicSystem')->nullable();
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
        Schema::dropIfExists('history_of_infections');
    }
};
