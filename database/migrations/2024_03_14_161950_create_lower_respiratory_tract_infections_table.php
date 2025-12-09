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
        Schema::create('lower_respiratory_tract_infections', function (Blueprint $table) {
            $table->id();
            $table->integer('form_id')->nullable();
            $table->integer('GnInfoId');
            $table->string('SputumColor')->nullable();
            $table->string('SputumQuantity')->nullable();
            $table->string('Brasky')->nullable();
            $table->string('Whooping')->nullable();
            $table->string('BloodInSputum')->nullable();
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
        Schema::dropIfExists('lower_respiratory_tract_infections');
    }
};
