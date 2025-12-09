<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

     // Specify which attributes are mass assignable
     protected $fillable = [
        'DoctorID',
        'Reason',
        'Prescription',
        'form_entry_id',
        'status',
        'created_by',
        'updated_by',
        'deleted',
    ];
}
