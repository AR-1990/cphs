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
        Schema::create('form_step_fields', function (Blueprint $table) {
            $table->id();
            $table->integer('form_step_id');
            $table->string('type');
            $table->string('name');
            $table->string('label');
            $table->string('element_class');
            $table->string('element_id');
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
        Schema::dropIfExists('form_step_fields');
    }
};
