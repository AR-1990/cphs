<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * php artisan migrate:refresh --path=/database/migrations/2024_05_27_171125_create_nutritionist_history_evaluation_sections_table.php
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nutritionist_history_evaluation_sections', function (Blueprint $table) {
            $table->id();
            $table->integer('StudentBiodataId')->default(0);
            $table->string("height")->nullable();
            $table->string("Weight")->nullable();
            $table->string("BMI")->nullable();
          
            $table->string("HeightResult1")->nullable();
            $table->string("WeightResult1")->nullable();
            $table->string("BMIResult1")->nullable();



            $table->string("MUAC")->nullable();
            $table->string("Ideal_Body_Weight")->nullable();
            $table->string("Physical_Activity_Level")->nullable();
            $table->string("Estimated_Energy_Requirement")->nullable();
            $table->string("Daily_Protein_Requirement")->nullable();
            $table->string("Daily_Carbohydrate_Requirement")->nullable();
            $table->string("Daily_Fat_Requirement")->nullable();
            $table->string("Daily_Fluid_Requirement")->nullable();
            $table->string("Chief_Complaints2")->nullable();
            $table->string("History_of_Presenting_Complains")->nullable();
            $table->string("Past_Medical_History")->nullable();
            $table->string("Medication_Supplements_Allergies_History")->nullable();
            $table->string("Family_History2")->nullable();
            $table->string("Personal_Social_History2")->nullable();
            $table->string("Food_Allergies_and_Intolerances")->nullable();
            $table->string("Appetite")->nullable();
            $table->string("Recent_Weight_Changes_Weight_History")->nullable();
            $table->string("Breakfast")->nullable();
            $table->string("breakfast_detail")->nullable();
            $table->string("Mid_day_Snack")->nullable();
            $table->string("MidDaySnackDetail")->nullable();
            $table->string("Lunch")->nullable();
            $table->string("lunchDetail")->nullable();
            $table->string("Evening_Snack")->nullable();
            $table->string("EveningSnackDetail")->nullable();
            $table->string("Dinner")->nullable();
            $table->string("DinnerDetails")->nullable();
            $table->string("Bed_time_snack")->nullable();
            $table->string("Biochemical_Laboratory_test_Reports")->nullable();
            $table->string("Skin")->nullable();
            $table->string("Eyes")->nullable();
            $table->string("Lips")->nullable();
            $table->string("Nails")->nullable();
            $table->string("Hair")->nullable();
            $table->string("Scalp")->nullable();
            $table->string("Problem_List1")->nullable();
            $table->string("Impression1")->nullable();
            $table->longText("Provisional_Diagnosis1")->nullable();
            $table->string("General_Advice1")->nullable();
            $table->string("diet_breakfast")->nullable();
            $table->string("diet_snack")->nullable();
            $table->string("diet_lunch")->nullable();
            $table->string("diet_dinner")->nullable();
            $table->string("diet_bedtime")->nullable();
            $table->string("Follow_up_Required1")->nullable();
            $table->string("Reason_for_Follow_up1")->nullable();
            $table->string('Follow_up_Date1')->nullable();

            $table->longText("internal_referrals1")->nullable();
            $table->longText("external_referrals1")->nullable();
            $table->string("Reason_for_Referral1")->nullable();
            
            $table->tinyInteger('status')->default(1)->comment("0=inactive,1=active");
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);
            $table->integer('deleted')->default(0)->comment('0=not deleted,1=deleted');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nutritionist_history_evaluation_sections');
    }
};
