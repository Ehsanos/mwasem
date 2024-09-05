<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index(){
        $allSliders=Slider::where('is_active',true)
            ->with('media')
            ->get();

        return
        response()->json([
            'data'=>$allSliders,
            'status'=>'success',
            'message'=>'all Sliders '


        ],200) ;



    }

}
