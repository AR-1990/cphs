<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aids extends Model
{
    // Explicitly define the table if it's not following the Laravel convention
    protected $table = 'aids';

    
     // Specify which attributes are mass assignable
     protected $fillable = [
        'DoctorID',
        'Reason',
        'Aids',
        'form_entry_id',
        'status',
        'created_by',
        'updated_by',
        'deleted',
    ];

}
