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
        Schema::create('general_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('form_id')->nullable();
            $table->string('GrNo')->nullable();
            $table->string('name')->nullable();
            $table->string('class')->nullable();
            $table->string('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('BloodGroup')->nullable();
            $table->string('contact')->nullable();
            $table->string('email')->nullable();
            $table->string('emergency_name')->nullable();
            $table->string('emergency_relationship')->nullable();
            $table->string('emergency_contact')->nullable();
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
        Schema::dropIfExists('general_infos');
    }
};
