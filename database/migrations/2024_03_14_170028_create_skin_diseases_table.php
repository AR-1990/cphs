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
        Schema::create('skin_diseases', function (Blueprint $table) {
            $table->id();
            $table->integer('form_id')->nullable();
            $table->integer('GnInfoId');
            $table->string('Rashes')->nullable();
            $table->string('OnsetOfRashes')->nullable();
            $table->string('Site')->nullable();
            $table->string('StartedFrom')->nullable();
            $table->string('Itching')->nullable();
            $table->string('Fever')->nullable();
            $table->string('Coryza')->nullable();
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
        Schema::dropIfExists('skin_diseases');
    }
};
