<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogActivity extends Model
{
    use HasFactory;

    protected $table = 'log_activity';


    protected $fillable = [
        'subject', 'url', 'method', 'ip', 'agent', 'user_id','location_details'
    ];

    public function users()
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }

}
