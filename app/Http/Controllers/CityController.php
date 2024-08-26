<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller
{

    public function index()
    {
        $all = City::all();
        return $all;

    }


    public function show($id)
    {

        $allProductsInCity=Product::where('city_id',$id)->get();
        return $allProductsInCity;


    }
}
