<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AdminPanel;
use Illuminate\Http\Request;
use App\Models\School;

class Form_entryController extends Controller
{
    public function form_entry()
    {

        return view('admin.form_entry');
    }
}
