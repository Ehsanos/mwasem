<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index()
    {

        $allCats = Category::with('media')->get();


        return response([

            'data' => CategoryResource::collection($allCats),
            'message' => 'success'

        ], 200);


    }

    public function show($id)
    {

        if ($id != null) {

            $allProductInCategory = Product::where('category_id', $id)
                ->where('is_active', true)
                ->with('media')
                ->get();
            return response()->json([
                'data' => $allProductInCategory,
                'message' => 'success'

            ], 200

            );


        }


    }

}
