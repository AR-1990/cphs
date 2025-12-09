<?php

namespace App\Http\Controllers\AdminPanel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\School;

class AdminLocationController extends Controller
{
    public function index()
    {
        return view('admin.location');
    }
}

