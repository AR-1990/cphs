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
        Schema::create('school_health_physicians', function (Blueprint $table) {
            $table->id();
            $table->integer('StudentBiodataId')->default(0);
            $table->string('Chief_Complaints1')->nullable();
            $table->string('History_of_Presenting_Complaints1')->nullable();
            $table->string('Review_of_Systems')->nullable();
            $table->string('General')->nullable();
            $table->string('Eyes')->nullable();
            $table->string('Ears_Nose_and_Throat')->nullable();
            $table->string('Teeth')->nullable();
            $table->string('Cardiorespiratory')->nullable();
            $table->string('Gastrointestinal')->nullable();
            $table->string('Genitourinary')->nullable();
            $table->string('Neuromuscular')->nullable();
            $table->string('Endocrine')->nullable();
            $table->string('Hematologic')->nullable();
            $table->string('Rheumatologic')->nullable();
            $table->string('Skin')->nullable();
            $table->string('Investigations_Laboratory_Test_Reports1')->nullable();
            $table->string('Medication_History')->nullable();
            $table->string('Allergies')->nullable();
            $table->string('Past_Medical_History')->nullable();
            $table->string('Past_Surgical_History')->nullable();
            $table->string('Birth_History')->nullable();
            $table->string('Immunizatio_History')->nullable();
            $table->string('Growth_Development_Puberty_changes')->nullable();
            $table->string('Nutrition_History')->nullable();
            $table->string('Family_History1')->nullable();
            $table->string('Personal_Social_History1')->nullable();
            $table->string('Blood_pressure')->nullable();
            $table->string('BloodPressureSystolic')->nullable();
            $table->string('BloodPressureDiastolic')->nullable();

            $table->string('Blood_pressure_result')->nullable();
            $table->string('BloodPressureDiastolicResult')->nullable();
            $table->string('WeightResult')->nullable();
            $table->string('HeightResult')->nullable();
            $table->string('BMIResult')->nullable();

            $table->string('TemperatureResult')->nullable();
            $table->string('PulseResult')->nullable();
            $table->string('RespiratoryRateResult')->nullable();

            $table->string('Temperature')->nullable();
            $table->string('Pulse_rate')->nullable();
            $table->string('Respiratory_Rate')->nullable();
            $table->string('Weight')->nullable();
            $table->string('Height')->nullable();
            $table->string('BMI')->nullable();
            $table->string('General_Appearance')->nullable();
            $table->string('Lymph_Nodes')->nullable();
            $table->string('Head')->nullable();
            $table->string('ENT')->nullable();
            $table->string('Chest')->nullable();
            $table->string('Heart')->nullable();
            $table->string('Abdomen')->nullable();
            $table->string('Extremities')->nullable();
            $table->string('Neurologic_Examination')->nullable();
            $table->string('Problem_List')->nullable();
            $table->string('Impression')->nullable();
            $table->string('Investigations_Recommended')->nullable();
            $table->longText('Provisional_Diagnosis')->nullable();
            $table->string('General_Advice')->nullable();
            $table->string('First_Aid_Given')->nullable();
            $table->string('Follow_up_Required')->nullable();
            $table->string('Reason_for_Follow_up')->nullable();
            $table->string('Follow_up_Date')->nullable();
            $table->longText('internal_referrals')->nullable();
            $table->longText('external_referrals')->nullable();
            $table->string('Reason_for_Referral')->nullable();
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
        Schema::dropIfExists('school_health_physicians');
    }
};
