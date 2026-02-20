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
        Schema::create('student_biodata', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('GRNo')->nullable();
            $table->string('class')->nullable();
            $table->date('dob')->nullable();
            $table->string('B_Form_Number')->nullable();
            $table->integer('age')->nullable();
            $table->integer('designation')->nullable();
            $table->string('gender')->nullable();
            $table->string('School_Name')->nullable();
            $table->string('Emergency_Contact_Number')->nullable(); /* Emergency contact field added*/

            $table->string('Contact_Number')->nullable();
            $table->string('type_of_encounter')->nullable();
            $table->tinyInteger('MedicalHistoryType')->default(0)->comment("3=PsychologistHistoryAssessmentSection,1=SchoolHealthPhysician,NutritionistHistoryEvaluationSection=2");
            $table->tinyInteger('status')->default(1)->comment("0=inactive,1=active");
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);
            $table->integer('deleted')->default(0)->comment('0=not deleted,1=deleted');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->integer('Follow_up_Required')->default(0)->comment('0=not deleted,1=deleted');
            $table->integer('Follow_up_Date_flag')->default(2)->comment('0= if Follow-up Required yes and Follow-up Date blank, 1= if Follow-up Required yes and Follow-up Date not blank,2=if Follow-up Required no ');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_biodata');
    }
};
