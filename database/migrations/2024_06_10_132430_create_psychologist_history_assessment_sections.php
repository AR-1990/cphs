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
        Schema::create('psychologist_history_assessment_sections', function (Blueprint $table) {
            $table->id();
            $table->string("Identifying_Personal_Information")->nullable();
            $table->string("Referral_Source")->nullable();
            $table->string("Chief_Complaints3")->nullable();
            $table->string("History_of_Presenting_Complaints1")->nullable();
            $table->string("Investigations_Laboratory_Test_Reports2")->nullable();
            $table->string("Past_Medical_Psychiatric_History")->nullable();
            $table->string("Medication_History_Allergies")->nullable();
            $table->string("Family_History3")->nullable();
            $table->string("Personal_Social_History3")->nullable();
            $table->string("Appearance_Behavior")->nullable();
            $table->string("Attitude_toward_the_examiner")->nullable();
            $table->string("Speech")->nullable();
            $table->string("Mood")->nullable();
            $table->string("Affect")->nullable();
            $table->string("Thought_process_content")->nullable();
            $table->string("Perceptions")->nullable();
            $table->string("Delusions")->nullable();
            $table->string("Cognitive_Function")->nullable();
            $table->string("Insight")->nullable();
            $table->string("Judgement")->nullable();
            $table->string("Impulsivity")->nullable();
            $table->string("Reliability")->nullable();
            $table->string("Problem_List2")->nullable();
            $table->string("Impression2")->nullable();
            $table->longtext("Provisional_Diagnosis2")->nullable();
            $table->string("General_Advice2")->nullable();
            $table->string("Follow_up_Required2")->nullable();
            $table->string("Reason_for_Follow_up2")->nullable();
            $table->date("Follow_up_Date2")->nullable();
            $table->longtext("internal_referrals2")->nullable();
            $table->string("Reason_for_Referral2")->nullable();
            $table->longtext("external_referrals2")->nullable();


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
        Schema::dropIfExists('psychologist_history_assessment_sections');
    }
};
