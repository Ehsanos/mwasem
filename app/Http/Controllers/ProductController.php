<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaginationResource;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(Request $request)
    {

        $all = Product::with('media')
            ->where('is_active', true)
            ->when(isset($request->q), function ($q) use ($request) {
                return $q->where('name', 'like', "%" . $request->q . "%")->orWhere('description', 'LIKE', '%' . $request->q . "%");
            })
            ->when(isset($request->category_id), function ($q) use ($request) {
                return $q->where("category_id", $request->category_id);
            })
            ->paginate(2);


        return response()->json(
            [
                'status' => 'success',
                'data' => ProductResource::collection($all),
                "pagination" => new PaginationResource($all),
            ]);


    }

    public function show($id)
    {
        $product = Product::where('id', $id)
            ->with('user')
            ->first();

        $imgs = optional($product)->getMedia('products') ?? collect();


        if ($product == null) {
            return response()->json(
                [
                    'status' => 'failed',
                    'message' => 'Data is Empty!',

                ], 404);
        }

        return response()->json(
            [
                'status' => 'success',
                'message' => 'return  Products successfully!',

                'data' => $product,
                'imgs' => $imgs

            ], 200);

    }


}
