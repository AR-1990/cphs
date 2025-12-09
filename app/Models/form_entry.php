<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class form_entry extends Model
{
    use HasFactory;

    public function school () {
        return $this->belongsTo(School::class,'school');
    }
    public function city () {
        return $this->belongsTo(City::class,'city');
    }
    public function area () {
        return $this->belongsTo(Area::class,'area');
    }
    public function filled_by () {
        return $this->belongsTo(User::class,'enterby');
    }
}
