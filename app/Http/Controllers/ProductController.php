<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use  App\Models\Product;

class ProductController extends Controller
{

    public function index()
    {

        $all = Product::where('is_active', true)
            ->with('media')
            ->paginate(10);

        return response()->json(
            [
                'status' => 'success',
                'message' => 'return  Products successfully!',
                'data' => ProductResource::collection($all),
            ]);


    }

    public function show($id)
    {
        $product = Product::where('id',$id)
            ->with('user')
            ->first();

            $imgs=optional($product)->getMedia('products')??collect();


            if ($product==null){
                return response()->json(
                    [
                        'status' => 'failed',
                        'message' => 'Data is Empty!',

                    ],404);
            }

          return response()->json(
        [
            'status' => 'success',
            'message' => 'return  Products successfully!',

            'data' => $product,
            'imgs'=>$imgs

        ],200);

    }


}
