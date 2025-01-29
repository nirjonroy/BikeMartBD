<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index(){
       $slider = Slider::where('status', 1)->get();
       return response()->json([
        'success' => true,
        'data' => $slider,
    ], 200);
    }
}
