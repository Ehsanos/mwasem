<?php

namespace App\Http\Controllers;

use App\Http\Resources\SliderResource;
use App\Models\Slider;

class SliderController extends Controller
{
    public function index()
    {
        $allSliders = Slider::with('media')->where('is_active', true)->get();

        return
            response()->json([
                'data' => SliderResource::collection($allSliders),
                'status' => 'success',
                'message' => 'all Sliders '
            ], 200);


    }

}
