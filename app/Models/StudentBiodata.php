<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentBiodata extends Model
{
    use HasFactory;

    protected $table = 'student_biodata';
    

     public function school_health_physicians () {
        return $this->belongsTo(SchoolHealthPhysician::class, 'id', 'StudentBiodataId')->where('deleted',0);
    }

     public function nutritionist_history_evaluation_sections () {
        return $this->belongsTo(NutritionistHistoryEvaluationSection::class, 'id', 'StudentBiodataId')->where('deleted',0);
    }
    public function psychologist_history_assessment_sections () {
        return $this->belongsTo(PsychologistHistoryAssessmentSection::class, 'id', 'StudentBiodataId')->where('deleted',0);
    }
}
