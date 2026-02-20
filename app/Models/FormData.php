<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormData extends Model
{
    
    use HasFactory;

    public function form_entry () {
        return $this->belongsTo(form_entry::class,'entry_id');
    }
}
