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
        Schema::create('recent_changes_or_concerns', function (Blueprint $table) {
            $table->id();
            $table->integer('form_id')->nullable();
            $table->integer('GnInfoId')->nullable();
            $table->string('Description')->nullable();
            $table->string('Onset')->nullable();
            $table->string('Duration')->nullable();
            $table->string('Severity')->nullable();
            $table->string('RelievingFactor')->nullable();
            $table->string('AssociatedSymptoms')->nullable();
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
        Schema::dropIfExists('recent_changes_or_concerns');
    }
};
