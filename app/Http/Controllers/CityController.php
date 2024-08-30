<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller
{

    public function index()
    {
        $all = City::
        with('media')->get();


        return response([
            'data'=>$all,
            'message'=>'success'

        ],200);

    }


    public function show($id)
    {

        $allProductsInCity=Product::where('city_id',$id)
            ->with('media')
            ->get();
        return response(
            [
                'data'=>$allProductsInCity,
                'message'=>'success'

            ],200

        );


    }
}
