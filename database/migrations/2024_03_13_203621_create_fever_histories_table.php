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
        Schema::create('fever_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('form_id')->nullable();
            $table->integer('GnInfoId');
            $table->string('temperature')->nullable();
            $table->string('Description_of_fever')->nullable();
            $table->string('Onset_Duration')->nullable();
            $table->string('Duration')->nullable();
            $table->string('PatternOfFever')->nullable();
            $table->string('AssociatedSymptoms')->nullable();
            $table->string('RecentExposuresOrTravel')->nullable();
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
        Schema::dropIfExists('fever_histories');
    }
};
