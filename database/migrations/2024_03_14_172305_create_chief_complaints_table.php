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
        Schema::create('chief_complaints', function (Blueprint $table) {
            $table->id();
            $table->integer('form_id')->nullable();
            $table->integer('GnInfoId');
            $table->string('chief_complaint')->nullable();
            $table->string('chef_comlaint_specify')->nullable();
            $table->string('previous_skin_conditions')->nullable();
            $table->string('skincare_products')->nullable();
            $table->string('family_skin_disease')->nullable();
            $table->string('fungal_infections_type')->nullable();
            $table->string('fungal_infections_duration')->nullable();
            $table->string('fungal_previous_treatments')->nullable();
            $table->string('fungal_infections_recurrence')->nullable();
            $table->string('dermatitis_type')->nullable();
            $table->string('dermatitis_triggers')->nullable();
            $table->string('dermatitis_symptoms')->nullable();
            $table->string('dermatitis_previous_treatments')->nullable();
            $table->string('scabies_history')->nullable();
            $table->string('scabies_symptoms')->nullable();
            $table->string('scabies_previous_treatments')->nullable();
            $table->string('herpes_type')->nullable();
            $table->string('herpes_triggers')->nullable();
            $table->string('herpes_location')->nullable();
            $table->string('herpes_pain')->nullable();
            $table->string('herpes_symptoms')->nullable();
            $table->string('herpes_previous_treatments')->nullable();
            $table->string('herpes_current_medication')->nullable();
            $table->string('current_additional_notes')->nullable();
            $table->string('age_first_menstrual')->nullable();
            $table->string('regularity_menstrual')->nullable();
            $table->string('duration_menstrual')->nullable();
            $table->string('amount_menstrual_bleeding')->nullable();
            $table->string('symptoms_menstruation')->nullable();
            $table->string('use_menstrual_products')->nullable();
            $table->string('menstrual_products_specify')->nullable();
            $table->string('history_menstrual_disorder')->nullable();
            $table->string('dysmenorrhea_onset')->nullable();
            $table->string('amenorrhea_duration')->nullable();
            $table->string('menorrhagia_duration')->nullable();
            $table->string('menorrhagia_severity')->nullable();
            $table->string('oligomenorrhea_duration')->nullable();
            $table->string('menstrual_disorder_other')->nullable();


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
        Schema::dropIfExists('chief_complaints');
    }
};
