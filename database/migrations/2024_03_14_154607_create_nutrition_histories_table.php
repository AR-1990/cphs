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
        Schema::create('nutrition_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('form_id')->nullable();
            $table->integer('GnInfoId');
            $table->string('BreakfastIfYes')->nullable();
            $table->string('RotiTheyEat')->nullable();
            $table->string('Lunch')->nullable();
            $table->string('SkipMeals')->nullable();
            $table->string('MealPreferences')->nullable();
            $table->string('FoodAllergies')->nullable();
            $table->string('DietaryRestrictions')->nullable();
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
        Schema::dropIfExists('nutrition_histories');
    }
};
