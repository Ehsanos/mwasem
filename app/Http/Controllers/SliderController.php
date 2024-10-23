<?php

namespace App\Http\Controllers;

use App\Http\Resources\SliderResource;
use App\Models\Setting;
use App\Models\Slider;

class SliderController extends Controller
{
    public function index()
    {
        $allSliders = Slider::with('media')->where('is_active', true)->get();

        return
            response()->json([
                'data' => SliderResource::collection($allSliders),
                "show_slider" => Setting::first()?->show_slider ?? false,
                'status' => 'success',
                'message' => 'all Sliders '
            ], 200);
    }
}
