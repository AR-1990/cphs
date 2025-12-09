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
        Schema::create('personal_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('form_id')->nullable();
            $table->integer('GnInfoId');
            $table->string('LifestyleHabits')->nullable();
            $table->string('CurrentMedications')->nullable();
            $table->string('sports')->nullable();
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
        Schema::dropIfExists('personal_histories');
    }
};
