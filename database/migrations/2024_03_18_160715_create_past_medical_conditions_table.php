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
        Schema::create('past_medical_conditions', function (Blueprint $table) {
            $table->id();
            $table->integer('form_id')->nullable();
            $table->integer('GnInfoId');
            $table->string('LongTermHealthConditions')->nullable();
            $table->string('longterm_health_other')->nullable();
            $table->string('AccidentOrInjuries')->nullable();
            $table->string('Surgeries')->nullable();
            $table->string('AnyCurrentMdications')->nullable();
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
        Schema::dropIfExists('past_medical_conditions');
    }
};
