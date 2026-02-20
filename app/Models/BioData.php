<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BioData extends Model
{
    // Specify which attributes are mass assignable
    protected $fillable = [
        'name',
        'guardianname',
        'gender',
        'school',
        'city',
        'area',
        'dob',
        'age',
        'Emergency_Contact_Number',
        'Gr_Number',
        'Any_Known_Medical_Condition',
        'Address',
        'Blood_group',
        'bio_data_comment',
    ];

    // You can also specify any attributes that should be cast to specific types
    protected $casts = [
        'dob' => 'date',
        'age' => 'integer',
    ];
}
