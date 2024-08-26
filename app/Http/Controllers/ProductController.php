<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\Product;
class ProductController extends Controller
{

    public function index(){

        $all=Product::where('is_active',true)->get();
        return $all;


    }

    public function show($id)
    {
    $product=Product::find($id)
        ->with('user')
        ->get();



    return $product;

    }



}
