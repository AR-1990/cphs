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
        Schema::create('form_data', function (Blueprint $table) {
            $table->id();
               
               $table->string('entry_id');
               $table->string('key');
               $table->string('value');
               $table->string('if')->nullable();
                  
            // $table->string('gender')->nullable();
            // $table->integer('age')->nullable();
            // $table->datetime('dob')->nullable();
            // $table->string('phone')->nullable();
            // $table->string('medical_condition')->nullable();
            // $table->string('blood_group')->nullable();
            // $table->integer('height')->nullable();
            // $table->integer('weight')->nullable();
            // $table->integer('bmi')->nullable();
            // $table->string('bodytemp')->nullable();
            // $table->string('bodytempunit')->nullable();
            // $table->string('pulse')->nullable();
            // $table->string('bloodpressure')->nullable();
            // $table->string('noramal_posture_gait')->nullable();
            // $table->string('mentalstatus')->nullable();
            // $table->string('jaundice')->nullable();
            // $table->string('anemia')->nullable();
            // $table->string('clubbing')->nullable();
            // $table->string('cyanosis')->nullable();
            // $table->string('skin')->nullable();
            // $table->string('breath')->nullable();
            // $table->string('feel')->nullable();
            // $table->string('friends')->nullable();
            // $table->string('Safe_and_Supported')->nullable();
            // $table->string('lonely')->nullable();
            // $table->string('talk_about')->nullable();
            // $table->string('clean')->nullable();
            // $table->string('Uniform_or_shoe')->nullable();
            // $table->string('Lice_nits')->nullable();
            // $table->string('hygiene_routines_practices')->nullable();
            // $table->string('hair_and_scalp')->nullable();
            // $table->string('hair_distribution')->nullable();
            // $table->string('Snellens_charts')->nullable();
            // $table->string('ocular_alignment')->nullable();
            // $table->string('normal_eye_inspection')->nullable();
            // $table->string('normal_color_vision')->nullable();
            // $table->string('nystagmus')->nullable();
            // $table->string('ears_shape_and_position')->nullable();
            // $table->string('ear_examination')->nullable();
            // $table->string('hearing_test')->nullable();
            // $table->string('inasal_examinaton')->nullable();
            // $table->string('patients_ability')->nullable();
            // $table->string('assess_gingiva')->nullable();
            // $table->string('are_there_dental_caries')->nullable();
            // $table->string('Check_gag_reflex')->nullable();
            // $table->string('tonsils')->nullable();
            // $table->string('normal_speech_development')->nullable();
            // $table->string('any_neck_swelling')->nullable();
            // $table->string('lymph_node')->nullable();
            // $table->string('lymph_node_specify')->nullable();
            // $table->string('any_neck_swelling_specify')->nullable();
            // $table->string('any_visible_chest_deformity')->nullable();
            // $table->string('lung_auscultation')->nullable();
            // $table->string('cardiac_auscultation')->nullable();
            // $table->string('distention_scar_mass')->nullable();
            // $table->string('any_history_of_abdominal_pain')->nullable();
            // $table->string('any_history_of_abdominal_pain_specify')->nullable();
            // $table->string('limitations_range_motion')->nullable();
            // $table->string('limitations_range_motion_specify')->nullable();
            // $table->string('spinal_curvature_assessment')->nullable();
            // $table->string('curvature_spine_resembling')->nullable();
            // $table->string('adams_forward_bend_test')->nullable();
            // $table->string('foot_or_toe_abnormalities')->nullable();
            // $table->string('immunization_card')->nullable();
            // $table->string('being_vaccinated')->nullable();
            // $table->string('BCG_1_dose')->nullable();
            // $table->string('OPV_4_dose')->nullable();
            // $table->string('Pentavalent')->nullable();
            // $table->string('rota')->nullable();
            // $table->string('measles')->nullable();
            // $table->string('never_had_any_vaccination')->nullable();
            // $table->string('toys_jewelry_or_keys')->nullable();
            // $table->string('eat_non_food_items')->nullable();
            // $table->string('job_involves')->nullable();
            // $table->string('hobby_involves')->nullable();
            // $table->string('do_you_have_any_allergies')->nullable();
            // $table->string('do_you_have_any_allergies_specify')->nullable();
            // $table->string('menarche_age')->nullable();
            // $table->string('discomfort_during_urination')->nullable();
            // $table->string('any_menstrual_abnormality')->nullable();
            // $table->string('any_menstrual_abnormality_specify')->nullable();
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
        Schema::dropIfExists('form_data');
    }
};
