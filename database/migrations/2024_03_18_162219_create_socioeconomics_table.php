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
        Schema::create('socioeconomics', function (Blueprint $table) {
            $table->id();
            $table->integer('form_id')->nullable();
            $table->integer('GnInfoId');
            $table->string('Water')->nullable();
            $table->string('Milk')->nullable();
            $table->string('Rooms')->nullable();
            $table->string('AnySick people at home')->nullable();
            $table->string('infectious_disease')->nullable();
            $table->string('FatherOccupation')->nullable();
            $table->string('DDX')->nullable();
            $table->string('NoteToPrincipal')->nullable();
            $table->string('NoteToParent')->nullable();
            $table->string('Picture')->nullable();
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
        Schema::dropIfExists('socioeconomics');
    }
};
