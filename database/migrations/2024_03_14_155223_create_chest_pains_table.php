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
        Schema::create('chest_pains', function (Blueprint $table) {
            $table->id();  
            $table->integer('form_id')->nullable();
            $table->integer('GnInfoId');
            $table->string('Onset')->nullable();
            $table->string('Duration')->nullable();
            $table->string('Severity')->nullable();
            $table->string('Location')->nullable();
            $table->string('Palpitations')->nullable();
            $table->string('FaintingSyncope')->nullable();
            $table->string('Cyanosis')->nullable();
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
        Schema::dropIfExists('chest_pains');
    }
};
