<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;

class GeneralController extends Controller
{

    public function getAreasByCity(Request $request)
    {
        return  json_encode(Area::where('city_id',$request->city_id)->get());
    }
}
